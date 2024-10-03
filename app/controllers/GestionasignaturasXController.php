<?php

class GestionasignaturasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //Aca insertamos un comentario para subir
    public function indexAction()
    {
        //print $sem;exit();
        $SemestreM = Semestres::findFirst("activo = 'M'");

        //$verifica = Semestres::findFirst("codigo = {$SemestreM->codigo} AND asignaturas > 0 ");
        //print("Verifica:".$SemestreM->asignaturas);
        //exit();

        if ($SemestreM->asignaturas >= 1) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("gestionasignaturas/asignaturasofertadas");
        }

        $this->assets->addJs("adminpanel/js/modulos/gestionasignaturas.js?v=" . uniqid());
    }

    //asignaturasofertar
    public function asignaturasofertarAction()
    {
        //$auth = $this->session->get('auth');
        /* Calculamos el semestre actual */
        $SemestreM = Semestres::findFirst("activo = 'M'");

        $this->view->semestre = $SemestreM;

        /* Verificamos si ya esta matriculado */
        // buscaremos si ya tiene cursos con su codigo en el semestrea ctual
        //$verifica = Semestres::findFirst("codigo = {$SemestreM->codigo} AND asignaturas > 0 ");
        if ($SemestreM->asignaturas >= 1) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("gestionasignaturas/asignaturasofertadas");
        }

        /* Consulta cursos permitidos para la matricula */
        $cursodispo = $this->modelsManager->createBuilder()
            ->from('Asignaturas')
            ->columns("Asignaturas.codigo as asignatura, "
                . "Asignaturas.nombre, Asignaturas.ciclo, Asignaturas.creditos, Asignaturas.pr1, "
                . "Asignaturas.pr2, Asignaturas.pr3, Asignaturas.prhm, Asignaturas.ht, Asignaturas.hp, "
                . "Asignaturas.tipo, Asignaturas.estado ")
            ->orderBy('Asignaturas.curricula ASC, Asignaturas.ciclo ASC, Asignaturas.codigo')
            ->getQuery()
            ->execute();

        $this->view->cursosdispo = $cursodispo;
        $this->view->totalcursos = count($cursodispo);
        $this->assets->addJs("adminpanel/js/modulos/gestionasignaturas.asignaturasofertar.js?v=" . uniqid());

        /* fin */
    }

    public function saveAsignaturasOfertarAction()
    {

        $this->view->disable();

        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                //Hacemos truncate a la tabla docentes_asignaturas (native sql)
                $semestre = Semestres::findFirst(
                    [
                        "activo = 'M'  ",
                        'order' => 'codigo DESC',
                        'limit' => 1,
                    ]
                );

                $this->db->query("DELETE FROM asignaturas_semestre WHERE semestre = $semestre->codigo");
                $this->db->query("DELETE FROM docentes_asignaturas WHERE semestre = $semestre->codigo");
                $this->db->query("DELETE FROM docentes_asignaturas_detalle WHERE semestre = $semestre->codigo");
                $this->db->query("DELETE FROM asignaturas_semestre_carreras WHERE semestre = $semestre->codigo");
                $this->db->query("DELETE FROM docentes_semestre WHERE semestre = $semestre->codigo");

                //echo $result->numRows();
                //print_r($result->fetchAll());
                // Asignamos la asignatura al docente seleccionado
                foreach ($_POST["codigocursos"] as $key => $value) {
                    //1
                    $asignaturas_semestre = new AsignaturasSemestre();
                    $asignaturas_semestre->asignatura = $value;
                    $asignaturas_semestre->semestre = (integer) $_POST["semestre"];
                    $asignaturas_semestre->estado = 'A';
                    $asignaturas_semestre->save();

                    $Asignaturas = Asignaturas::findFirst("codigo = '{$asignaturas_semestre->asignatura}'");
                    $curricula = $Asignaturas->curricula;

                    $Curricula = Curriculas::findFirst("codigo = '{$curricula}'");
                    $carrera = $Curricula->carrera;

                    //foreach de 1...6
                    $grupos = array(1, 2, 3, 4, 5, 6);
                    foreach ($grupos as $g) {

                        //asignaturas_semestre_carreras
                        $AsignaturasSemestreCarreras = new AsignaturasSemestreCarreras();
                        $AsignaturasSemestreCarreras->semestre = (integer) $_POST["semestre"];
                        $AsignaturasSemestreCarreras->asignatura = $value;
                        $AsignaturasSemestreCarreras->grupo = $g;
                        $AsignaturasSemestreCarreras->carrera = $carrera;
                        $AsignaturasSemestreCarreras->estado = 'A';
                        $AsignaturasSemestreCarreras->save();

                        //2
                        $docentes_asignaturas = new DocentesAsignaturas();
                        $docentes_asignaturas->semestre = (integer) $_POST["semestre"];
                        $docentes_asignaturas->asignatura = $value;
                        $docentes_asignaturas->docente = 0;
                        $docentes_asignaturas->tipo = 1;
                        $docentes_asignaturas->tp = 0;
                        $docentes_asignaturas->v1 = 0;
                        $docentes_asignaturas->v2 = 0;
                        $docentes_asignaturas->v3 = 0;
                        $docentes_asignaturas->nro = 0;
                        $docentes_asignaturas->moodle = 0;
                        $docentes_asignaturas->rol = 0;
                        $docentes_asignaturas->context = 0;

                        if ($g == 1) {
                            $docentes_asignaturas->grupo = $g;
                            $docentes_asignaturas->estado = 'A';
                        } else {
                            $docentes_asignaturas->grupo = $g;
                            $docentes_asignaturas->estado = 'X';
                        }
                        $docentes_asignaturas->save();

                        $subgrupo = array(1, 2);
                        foreach ($subgrupo as $sg) {
                            $docentes_asignaturas_detalle = new DocentesAsignaturasDetalle();
                            $docentes_asignaturas_detalle->semestre = (integer) $_POST["semestre"];
                            $docentes_asignaturas_detalle->asignatura = $value;
                            $docentes_asignaturas_detalle->docente = 0;
                            if ($g == 1) {
                                $docentes_asignaturas_detalle->grupo = $g;
                                $docentes_asignaturas_detalle->estado = 'A';
                            } else {
                                $docentes_asignaturas_detalle->grupo = $g;
                                $docentes_asignaturas_detalle->estado = 'X';
                            }

                            $docentes_asignaturas_detalle->tipo = 1;
                            $docentes_asignaturas_detalle->subgrupo = $sg;
                            $docentes_asignaturas_detalle->modalidad = $sg;
                            $docentes_asignaturas_detalle->save();
                        }
                    }
                    //exit();
                }

                $this->db->query("UPDATE semestres SET asignaturas = 1 WHERE codigo = {$semestre->codigo}");

                //Cuando va bien
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } catch (Exception $ex) {

                //echo '<pre>';
                //print_r("Error");
                //exit();

                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //asignaturasofertadas
    public function asignaturasofertadasAction()
    {

        $auth = $this->session->get('auth');
        $this->view->auth = $auth;

        $docentes = Docentes::find(
            [
                "estado = 'A'",
                'order' => 'apellidop, apellidom, nombres',
            ]
        );
        $this->view->docentes = $docentes;

        $semestre_m = Semestres::findFirst("activo = 'M'");

        $this->view->semestre_m = $semestre_m;

        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->semestres = $semestres;

        $this->assets->addJs("adminpanel/js/modulos/gestionasignaturas.asignaturasofertadas.js?v=" . uniqid());
    }

    public function datatableAsignaturasOfertadasAction($semestreSelect=null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            if ($semestreSelect != 0) {
                //print("Semestre: ".$semestreSelect);
                //exit();

                $where = "AND a_s.semestre = '{$semestreSelect}'";
            } else {
                // print("Llega 0 o vacio");
                // exit();
                $where = "";
            }

            $semestre_m = Semestres::findFirst("activo = 'M'");
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("a.codigo");
            $datatable->setSelect("a.codigo, a.nombre,a_s.semestre,"
                . " a.ciclo, a.creditos, "
                . "a.estado,t_a.nombres AS tipo_asignatura");
            $datatable->setFrom("asignaturas_semestre a_s
                INNER JOIN asignaturas a ON a.codigo = a_s.asignatura
                INNER JOIN a_codigos t_a ON t_a.codigo = a.tipo");
            $datatable->setWhere("t_a.numero = 71 AND a_s.estado = 'A' $where");
            $datatable->setOrderby("a.ciclo, a.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroAction($id)
    {
        $Asignaturas = Asignaturas::findFirstBycodigo((string) $id);
        $semestre = Semestres::findFirst(
            [
                "activo = 'M'  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        //echo '<pre>';
        //print_r($semestre->codigo);
        //exit();

        $semestre_m = $semestre->codigo;
        $this->view->semestre = $semestre_m;

        $this->view->codigo = $id;

        $nombre_asignatura = $Asignaturas->nombre;
        $this->view->asignatura = $nombre_asignatura;

        $ciclo = $Asignaturas->ciclo;
        $this->view->ciclo = $ciclo;

        $creditos = $Asignaturas->creditos;
        $this->view->creditos = $creditos;

        $TipoAsignaturas = TipoAsignaturas::findFirst("numero = 71 AND codigo = '{$Asignaturas->tipo}'");
        $this->view->tipo_asignatura = $TipoAsignaturas->nombres;

        $Ambientes = AmbientesA::find();
        $this->view->ambientes = $Ambientes;

        $Dias = Dias::find("numero = 19 AND estado = 'A'");
        $this->view->dias = $Dias;

        $Horas = Horas::find();
//        foreach ($Horas as $value) {
        //            echo '<pre>';
        //            print_r($value->descripcion);
        //        }
        //        exit();
        $this->view->horas = $Horas;

        $Modalidad = Modalidad::find("estado = 'A' AND numero = 77");
//        foreach ($Modalidad as $value) {
        //            echo '<pre>';
        //            print_r($value->nombres);
        //        }
        //        exit();
        $this->view->modalidades = $Modalidad;

        $Docentes = Docentes::find("estado = 'A'");
        $this->view->docentes = $Docentes;

        $Carreras = Carreras::find("estado = 'A'");
        $this->view->carreras = $Carreras;

        $Actividad = Actividad::find("estado = 'A' AND numero = 55");
//        foreach ($Modalidad as $value) {
        //            echo '<pre>';
        //            print_r($value->nombres);
        //        }
        //        exit();
        $this->view->actividad = $Actividad;

        $this->assets->addJs("adminpanel/js/modulos/gestionasignaturas.asignaturasofertadas.registro.js?v=" . uniqid());
    }

    public function datatableRegistroAction($id, $semestre)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("grupo");
            $datatable->setSelect("semestre,grupo,docente,subgrupo,asignatura,modalidad_nombre,modalidad,numero,nro, subnro,nombre_docente,observacion,estado");
            $datatable->setFrom("( SELECT
                                    d_a_d.semestre AS semestre,
                                    CONCAT ( d.apellidop, ' ', d.apellidom, ' ', d.nombres ) AS nombre_docente,
                                    d_a_d.asignatura,
                                    d_a_d.grupo,
                                    d_a_d.subgrupo,
                                    d_a_d.docente,
                                    d_a_d.tipo,
                                    d_a_d.modalidad,
                                    d_a_d.observacion,
                                    d_a.nro,
                                    d_a_d.subnro,
                                    m.nombres AS modalidad_nombre,
                                    m.numero AS numero,
                                    d_a_d.estado
                                    FROM
                                            docentes_asignaturas_detalle AS d_a_d
                                            INNER JOIN docentes AS d ON d_a_d.docente = d.codigo
                                            INNER JOIN docentes_asignaturas AS d_a ON d_a.semestre = d_a_d.semestre
                                            AND d_a.asignatura = d_a_d.asignatura
                                            AND d_a.grupo = d_a_d.grupo
                                            AND d_a.docente = d_a_d.docente
                                            AND  d_a.tipo = d_a_d.tipo
                                            INNER JOIN a_codigos AS m ON d_a_d.modalidad = m.codigo
                                    WHERE
                                            d.estado = 'A'
                                    ) AS temporal_table");
            $datatable->setWhere("estado = 'A' AND asignatura = '{$id}' AND semestre ={$semestre} AND numero = 55");
            $datatable->setParams($_POST);
            $datatable->setOrderby("grupo,subgrupo, modalidad");
            $datatable->getJson();
        }
    }

    public function saveAsignaturasOfertadasAction($semestreSelect=null)
    {
        //echo '<pre>';
        //print_r($semestreSelect);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $db = $this->db;
            //primer proceso
            $sql_2 = " UPDATE docentes_semestre  set estado = 'X' WHERE semestre = {$semestreSelect}  ";
            $db->fetchOne($sql_2, Phalcon\Db::FETCH_OBJ);

            //select disctic docentes_asignaturas
            $sql3 = $this->modelsManager->createBuilder()
                ->from('DocentesAsignaturas')
                ->columns('DISTINCT DocentesAsignaturas.docente, DocentesAsignaturas.semestre')
                ->where("DocentesAsignaturas.semestre='{$semestreSelect}' AND DocentesAsignaturas.docente > 0")
                ->getQuery()
                ->execute();

            foreach ($sql3 as $sql3_insert) {
                //echo "<pre>";
                //print_r($sql2_insert->docente . '-' . $sql2_insert->semestre . ' ');
                $where = "docente = {$sql3_insert->docente} AND semestre = {$sql3_insert->semestre}";
                $DocentesSemetre = DocentesSemestre::findFirst($where);

                if (!$DocentesSemetre) {
                    $DocentesSemestre = new DocentesSemestre();
                    $DocentesSemestre->semestre = $sql3_insert->semestre;
                    $DocentesSemestre->docente = $sql3_insert->docente;
                    $DocentesSemestre->cargo = 'DOCENTE';
                    $DocentesSemestre->estado = 'A';
                    $DocentesSemestre->save();
                } else {
                //updadate docentes_semetres set estado = A whwre semestre ='m' And docente = codigo docente
                    $sql_4 = " UPDATE docentes_semestre  set estado = 'A'
                    WHERE semestre = $sql3_insert->semestre AND docente = $sql3_insert->docente  ";
                    $db->fetchOne($sql_4, Phalcon\Db::FETCH_OBJ);
                }
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function getGruposAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $codigo = (string) $this->request->getPost("codigo", "string");
            $semestre = (int) $this->request->getPost("semestre", "int");

            //echo '<pre>';
            //print_r("Llega: " . $codigo . "-" . $semestre);
            //exit();

            $DocentesAsignaturas = DocentesAsignaturas::find("semestre = $semestre AND asignatura = '$codigo'");

            /*
            foreach ($DocentesAsignaturas as $test) {

            echo "<pre>";
            print_r($test->grupo . '-' . $test->semestre . '-' . $test->asignatura . '-' . $test->estado);
            }
            exit();
             */

            $this->response->setJsonContent($DocentesAsignaturas->toArray());
            $this->response->send();
        }
    }

    public function savegruposAction()
    {

//echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $key_semestre = (int) $this->request->getPost("key_semestre", "int");
            $key_asignatura = (string) $this->request->getPost("key_asignatura", "string");

            foreach ($_POST["grupos"] as $key_grupo => $value_grupo) {

                $docente = 0;
                foreach ($_POST["select_docente"] as $key_docente => $value_docente) {
# si hay una coincidencia, definimos la variable resutlante como "S"
                    if ($key_grupo == $key_docente) {
                        $docente = $value_docente;
                    }
                }

                $nro_alumnos = 0;
                foreach ($_POST["nro_alumnos"] as $key_nro_alumnos => $value_nro_alumnos) {
# si hay una coincidencia, definimos la variable resutlante como "S"
                    if ($key_grupo == $key_nro_alumnos) {
                        $nro_alumnos = $value_nro_alumnos;
                    }
                }

                $observacion = '';
                foreach ($_POST["observacion"] as $key_observacion => $value_observacion) {
# si hay una coincidencia, definimos la variable resutlante como "S"
                    if ($key_grupo == $key_observacion) {
                        $observacion = $value_observacion;
                    }
                }

                if (isset($_POST["estado"][$key_grupo])) {
                    $estado_update = "A";

//echo"<pre>";
                    //print_r('Muere consulta:' . $estado_update);
                } else {
                    $estado_update = "X";
                    $db1 = $this->db;
                    $sql_delete_h = " DELETE FROM horarios WHERE semestre = {$key_semestre} AND asignatura = '{$key_asignatura}' AND grupo = $value_grupo  ";
                    $db1->fetchOne($sql_delete_h, Phalcon\Db::FETCH_OBJ);
                }

                $db = $this->db;
                $sql_update_d_a = " UPDATE docentes_asignaturas  SET docente = {$docente} ,nro = {$nro_alumnos},observacion = '{$observacion}',estado = '{$estado_update}' "
                    . "WHERE semestre = {$key_semestre} AND asignatura = '{$key_asignatura}' AND grupo = $value_grupo  ";
                $db->fetchOne($sql_update_d_a, Phalcon\Db::FETCH_OBJ);

                $sql_update_d_a_d = " UPDATE docentes_asignaturas_detalle  SET estado = '{$estado_update}', docente =  {$docente}"
                    . "WHERE semestre = {$key_semestre} AND asignatura = '{$key_asignatura}' AND grupo = $value_grupo  ";
                $db->fetchOne($sql_update_d_a_d, Phalcon\Db::FETCH_OBJ);
            }
//exit();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function saveGestionHorariosAction()
    {

//        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $semestre = (int) $this->request->getPost("semestre", "int");
                $ambiente = (int) $this->request->getPost("ambiente", "int");
                $dia = (int) $this->request->getPost("dia", "int");
                $hora = (int) $this->request->getPost("hora", "int");

                $Horarios = Horarios::findFirst(
                    [
                        "semestre = {$semestre} AND ambiente = {$ambiente} AND dia = {$dia} AND hora = {$hora}",
                    ]
                );

//Valida cuando es nuevo
                $Horarios = (!$Horarios) ? new Horarios() : $Horarios;

                $Horarios->semestre = (int) $this->request->getPost("semestre", "int");
                $Horarios->ambiente = (int) $this->request->getPost("ambiente", "int");
                $Horarios->dia = (int) $this->request->getPost("dia", "int");
                $Horarios->hora = (int) $this->request->getPost("hora", "int");
                $Horarios->asignatura = (string) $this->request->getPost("asignatura", "string");
                $Horarios->grupo = (int) $this->request->getPost("grupo", "int");
                $Horarios->subgrupo = (int) $this->request->getPost("subgrupo", "int");

//$Horarios->observaciones = (string) $this->request->getPost("observaciones", "string");
                $Horarios->observaciones = '-';
                $Horarios->estado = "A";

                if ($Horarios->save() == false) {
// Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Horarios->getMessages());
                } else {
//Cuando va bien

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function getRegistroHorarioAction()
    {
//print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $ambiente = (int) $this->request->getPost("ambiente", "int");
            $dia = (int) $this->request->getPost("dia", "int");
            $hora = (int) $this->request->getPost("hora", "int");

            $Horarios = Horarios::findFirst(
                [
                    "semestre = {$semestre} AND ambiente = {$ambiente} AND dia = {$dia} AND hora = {$hora}",
                ]
            );

//echo '<pre>';
            //print_r($Horarios->asignatura);
            //exit();

            if ($Horarios) {

                $codigo_asignatura = $Horarios->asignatura;

                $Asignaturas = Asignaturas::findFirstBycodigo((string) $codigo_asignatura);
                $nombre_asginatura = $Asignaturas->nombre;

                $grupo = $Horarios->grupo;
                $subgrupo = $Horarios->subgrupo;
                $modalidad = $Horarios->modalidad;
                $Modalidades = Modalidad::findFirst(
                    [
                        "estado = 'A'  AND numero = 55 AND codigo = {$modalidad}",
                    ]
                );
                $modalidad_nombre = $Modalidades->nombres;

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes", "codigo_asignatura" => $codigo_asignatura, "nombre_asignatura" => $nombre_asginatura, "grupo" => $grupo, "subgrupo" => $subgrupo, "modalidad" => $modalidad, "modalidad_nombre" => $modalidad_nombre));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
        } else {
            $this->response->setStatusCode(500);
        }
        $this->response->send();
    }

    public function getTableModalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $grupo = (int) $this->request->getPost("grupo", "int");
            $subgrupo = (int) $this->request->getPost("subgrupo", "int");
            //$modalidad = (int) $this->request->getPost("modalidad", "int");
            //echo '<pre>';
            //print_r($semestre . "-" . $asignatura . "-" . $grupo . "-" . $subgrupo . "-" . $modalidad);
            //exit();
            //$Horarios = Horarios::find("semestre = {$semestre} AND asignatura ='{$asignatura}' AND grupo = '{$grupo}' AND subgrupo = '{$subgrupo}' AND modalidad = '{$modalidad}' ");
            //native query
            $sql_horarios = $this->modelsManager->createQuery("SELECT
                        horarios.semestre AS pk_semestre,
                        horarios.ambiente AS pk_ambiente,
                        horarios.dia AS pk_dia,
                        horarios.hora AS pk_hora,
                        ambientes.descripcion AS ambiente,
                        dias.nombres AS dia,
                        horas.descripcion AS hora
                        FROM
                        Horarios AS horarios
                        INNER JOIN Dias AS dias ON dias.codigo = horarios.dia
                        INNER JOIN AmbientesA AS ambientes ON ambientes.codigo = horarios.ambiente
                        INNER JOIN Horas AS horas ON horas.codigo = horarios.hora
                        WHERE
                        dias.numero = 19 AND
                        horarios.semestre ={$semestre} AND horarios.asignatura = '{$asignatura}' AND horarios.grupo = {$grupo} AND horarios.subgrupo = {$subgrupo}");
            $Horarios = $sql_horarios->execute();

//foreach ($Horarios as $test) {
            //echo '<pre>';
            //print_r($test->ambiente . "-" . $test->dia . "-" . $test->hora);
            //}
            //exit();

            $this->response->setJsonContent($Horarios->toArray());
            $this->response->send();
        }
    }

    public function eliminarHorarioAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = $this->request->getPost("semestre", "int");
            $ambiente = $this->request->getPost("ambiente", "int");
            $dia = $this->request->getPost("dia", "int");
            $hora = $this->request->getPost("hora", "int");

//echo '<pre>';
            //print_r("Semestre:".$semestre . "- Ambiente:" . $ambiente . "- Dia:" . $dia . "- Hora" . $hora);
            //exit();

            $this->db->query("DELETE FROM horarios WHERE semestre = {$semestre} AND ambiente = {$ambiente} AND dia = {$dia} AND hora = {$hora} ");
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function getAjaxDocenteAsignaturaDetalleAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $grupo = (int) $this->request->getPost("grupo", "int");
            $subgrupo = (int) $this->request->getPost("subgrupo", "int");

//echo "<pre>";
            //print_r($semestre.$asignatura.$grupo.$subgrupo);
            //exit();

            $DocentesAsignaturasDetalle = DocentesAsignaturasDetalle::findFirst(
                [
                    "semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND subgrupo = {$subgrupo}",
                ]
            );

            if ($DocentesAsignaturasDetalle) {
                $this->response->setJsonContent($DocentesAsignaturasDetalle->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveRegistroAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $pk_parametro = (string) $this->request->getPost("modal_post_parametro", "string");

                $pk_semestre = (int) $this->request->getPost("modal_post_semestre", "int");
                $pk_asignatura = (string) $this->request->getPost("modal_post_asignatura", "string");
                $pk_grupo = (int) $this->request->getPost("modal_post_grupo", "int");
                $pk_subgrupo = (int) $this->request->getPost("modal_post_subgrupo", "int");

                $docente = (int) $this->request->getPost("docente", "int");
                $tipo = 1;
                $observacion = (string) $this->request->getPost("observacion", "string");
                $actividad = (int) $this->request->getPost("actividad", "int");
                $modalidad = (int) $this->request->getPost("modalidad", "int");
                $subnro = (int) $this->request->getPost("subnro", "int");

                $estado_update = "A";

                if ($pk_parametro == 'nuevo') {

                    $db_insert_d_a_d = $this->db;
                    $sql_update_d_a_d = " INSERT INTO docentes_asignaturas_detalle (semestre, asignatura, grupo, subgrupo, docente, tipo, observacion, estado, modalidad,subnro,actividad) "
                        . "VALUES ({$pk_semestre},'{$pk_asignatura}',{$pk_grupo},{$pk_subgrupo},{$docente},{$tipo},'{$observacion}','{$estado_update}',{$modalidad},{$subnro},{$actividad})";
                    $db_insert_d_a_d->fetchOne($sql_update_d_a_d, Phalcon\Db::FETCH_OBJ);
                } else if ($pk_parametro == 'editar') {

                    $db_update = $this->db;
                    $sql_update_d_a_d = " UPDATE docentes_asignaturas_detalle  SET estado = '{$estado_update}', docente = {$docente}, tipo = {$tipo}, observacion = '{$observacion}',modalidad = $modalidad, subnro = $subnro, actividad = $actividad "
                        . "WHERE semestre = {$pk_semestre} AND asignatura = '{$pk_asignatura}' AND grupo = $pk_grupo AND subgrupo = $pk_subgrupo ";
                    $db_update->fetchOne($sql_update_d_a_d, Phalcon\Db::FETCH_OBJ);
                }

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //nuevo
    public function getNewAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $grupo = (int) $this->request->getPost("grupo", "int");

            $DocentesAsignaturasDetalle = DocentesAsignaturasDetalle::count(
                [
                    "semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo}",
                ]
            );

            //echo '<pre>';
            //print_r($DocentesAsignaturasDetalle);
            //exit();

            if ($DocentesAsignaturasDetalle) {

                $subgrupo = $DocentesAsignaturasDetalle + 1;

                $this->response->setJsonContent(array("say" => "yes", "subgrupo" => $subgrupo));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //delete
    public function eliminarAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $grupo = (int) $this->request->getPost("grupo", "int");
            $subgrupo = (int) $this->request->getPost("subgrupo", "int");

            $total_countx = DocentesAsignaturasDetalle::count(
                [
                    "semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo}",
                ]
            );

            //echo '<pre>';
            //print_r("Valor Sub grupo:".$subgrupo."-"."Valor total_count:".$total_countx);
            //exit();

            if ($subgrupo == $total_countx || $subgrupo > 2) {

                //echo '<pre>';
                //print_r("Llega");
                //exit();

                $db_delete_h = $this->db;
                $sql_delete_h = " DELETE FROM horarios WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND subgrupo = {$subgrupo} ";
                $db_delete_h->fetchOne($sql_delete_h, Phalcon\Db::FETCH_OBJ);

                $db_delete_d_a_d = $this->db;
                $sql_delete_d_a_d = " DELETE FROM docentes_asignaturas_detalle WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND subgrupo = {$subgrupo} ";
                $db_delete_d_a_d->fetchOne($sql_delete_d_a_d, Phalcon\Db::FETCH_OBJ);

                $db_delete_a_a_d = $this->db;
                $sql_delete_a_a_d = " DELETE FROM alumnos_asignaturas_detalle WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND subgrupo = {$subgrupo} ";
                $db_delete_a_a_d->fetchOne($sql_delete_a_a_d, Phalcon\Db::FETCH_OBJ);

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //AsignaturasSemestreCarreras
    public function getAsignaturasSemestreCarrerasAction()
    {
        //echo '<pre>';
        //print_r($_POST);
        //exit();
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $grupo = (int) $this->request->getPost("grupo", "int");
            $carrera = (string) $this->request->getPost("carrera", "string");

            $db_select = $this->db;
            $sql_select_a_s_c = " SELECT * FROM asignaturas_semestre_carreras "
                . "WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = $grupo AND carrera = '{$carrera}' ";
            $AsignaturasSemestreCarreras = $db_select->fetchOne($sql_select_a_s_c, Phalcon\Db::FETCH_OBJ);

            //echo '<pre>';
            //print_r($AsignaturasSemestreCarreras->carrera);
            //exit();

            if ($AsignaturasSemestreCarreras) {

                $carrera = $AsignaturasSemestreCarreras->carrera;
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes", "carrera" => $carrera, "grupo" => $grupo));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
        } else {
            $this->response->setStatusCode(500);
        }
        $this->response->send();
    }

    //guarda carrera
    public function saveAsignaturasSemestreCarrerasAction()
    {

//echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $semestre = (int) $this->request->getPost("semestre", "int");
                $asignatura = (string) $this->request->getPost("asignatura", "string");
                $grupo = (int) $this->request->getPost("grupo", "int");
                $carrera = (string) $this->request->getPost("carrera", "string");

                $db_insert_d_a_d = $this->db;
                $sql_update_d_a_d = " INSERT INTO asignaturas_semestre_carreras (semestre, asignatura, grupo, carrera, observacion, estado) "
                    . "VALUES ({$semestre},'{$asignatura}',{$grupo},'{$carrera}','-','A')";
                $db_insert_d_a_d->fetchOne($sql_update_d_a_d, Phalcon\Db::FETCH_OBJ);

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //lista carreras
    public function getTableModalCarreraAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $grupo = (int) $this->request->getPost("grupo", "int");

//echo '<pre>';
            //print_r($semestre . "-" . $asignatura . "-" . $grupo . "-" . $subgrupo . "-" . $modalidad);
            //exit();
            //$Horarios = Horarios::find("semestre = {$semestre} AND asignatura ='{$asignatura}' AND grupo = '{$grupo}' AND subgrupo = '{$subgrupo}' AND modalidad = '{$modalidad}' ");
            //native query
            $sql_a_s_c = $this->modelsManager->createQuery("SELECT
                        a_s_c.semestre AS pk_semestre,
                        a_s_c.asignatura AS pk_asignatura,
                        a_s_c.grupo AS pk_grupo,
                        a_s_c.carrera AS pk_carrera,
                        a_s_c.grupo AS pk_grupo,
                        c.descripcion AS carrera,
                        a.nombre AS asignatura
                        FROM
                        AsignaturasSemestreCarreras AS a_s_c
                        INNER JOIN Asignaturas AS a ON a.codigo = a_s_c.asignatura
                        INNER JOIN Carreras AS c ON c.codigo = a_s_c.carrera
                        WHERE
                        a_s_c.semestre ={$semestre} AND a_s_c.asignatura = '{$asignatura}' AND a_s_c.grupo = {$grupo}");
            $AsignaturasSemestreCarreras = $sql_a_s_c->execute();

            //foreach ($Horarios as $test) {
            //echo '<pre>';
            //print_r($test->ambiente . "-" . $test->dia . "-" . $test->hora);
            //}
            //exit();

            $this->response->setJsonContent($AsignaturasSemestreCarreras->toArray());
            $this->response->send();
        }
    }

    //eliminar carrera
    public function eliminarCarreraAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = $this->request->getPost("semestre", "int");
            $asignatura = $this->request->getPost("asignatura", "string");
            $grupo = $this->request->getPost("grupo", "int");
            $carrera = $this->request->getPost("carrera", "string");

//            echo '<pre>';
            //            print_r("Semestre:".$semestre . "- Asignatura:" . $asignatura . "- Grupo:" . $grupo . "- Carerra:" . $carrera);
            //            exit();

            $this->db->query("DELETE FROM asignaturas_semestre_carreras WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND carrera = '{$carrera}' ");
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function getDocenteHorarioAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //exit();
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $dia = (int) $this->request->getPost("dia", "int");
            $hora = (int) $this->request->getPost("hora", "int");
            $docente = (int) $this->request->getPost("docente", "int");

            //semestre
            $semestre_m = Semestres::findFirst("activo = 'M'");

            $db_select = $this->db;
            $sql_consulta = " SELECT
            public.docentes_asignaturas_detalle.semestre,
            public.docentes_asignaturas_detalle.asignatura,
            public.docentes_asignaturas_detalle.docente,
            public.horarios.dia,
            public.horarios.hora
            FROM
            public.docentes_asignaturas_detalle
            INNER JOIN public.horarios ON public.horarios.semestre = public.docentes_asignaturas_detalle.semestre AND public.horarios.asignatura = public.docentes_asignaturas_detalle.asignatura AND public.horarios.grupo = public.docentes_asignaturas_detalle.grupo AND public.horarios.subgrupo = public.docentes_asignaturas_detalle.subgrupo
            WHERE
            public.horarios.dia = {$dia} AND
            public.horarios.hora = {$hora} AND
            public.docentes_asignaturas_detalle.docente = {$docente} AND
            public.docentes_asignaturas_detalle.estado = 'A' AND
            public.docentes_asignaturas_detalle.semestre = {$semestre_m->codigo} ";
            $sql_resultado = $db_select->fetchOne($sql_consulta, Phalcon\Db::FETCH_OBJ);

            //echo '<pre>';
            //print_r($sql_resultado->docente);
            //exit();

            if ($sql_resultado) {

                $asignatura = $sql_resultado->asignatura;
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes", "asignatura" => $asignatura));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
        } else {
            $this->response->setStatusCode(500);
        }
        $this->response->send();
    }

}
