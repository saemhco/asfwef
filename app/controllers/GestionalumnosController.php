<?php

class GestionalumnosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //index
    public function indexAction($semestre)
    {
        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $semestre;
        $this->assets->addJs("adminpanel/js/modulos/gestionalumnos.js?v=" . uniqid());
    }

    //datatable
    public function datatableAction($semestre)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_alumno");
            $datatable->setSelect("id_alumno,carrera_nombre,alumnos_nombre,nro_doc,celular,semestre,estado");
            $datatable->setFrom("(SELECT PUBLIC
            .alumnos.codigo AS id_alumno,
            PUBLIC.carreras.descripcion AS carrera_nombre,
            CONCAT ( PUBLIC.alumnos.apellidop, ' ', PUBLIC.alumnos.apellidom, ' ', PUBLIC.alumnos.nombres ) AS alumnos_nombre,
            PUBLIC.alumnos.nro_doc,
            PUBLIC.alumnos.celular,
            PUBLIC.alumnos_semestre.semestre AS semestre,
            PUBLIC.alumnos.estado 
            FROM
            PUBLIC.alumnos
            INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
            INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo 
            WHERE
            PUBLIC.alumnos.estado = 'A' 
            AND PUBLIC.alumnos_semestre.semestre =  {$semestre}) AS temporal_table");
            $datatable->setOrderby("alumnos_nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function recordAction($id = null)
    {

        $this->view->id = $id;

        if ($id != null) {
            $alumnos = Alumnos::findFirstBycodigo((int) $id);
        } else {
            //$docentes = Asignaturas::findFirstBycodigo(0);
            $alumnos = Alumnos::findFirstBycodigo(null);
        }

        $carrera = Carreras::findFirstBycodigo($alumnos->carrera);

        $this->view->alumno = $alumnos;
        $this->view->carrera = $carrera;

        /* Calculamos el semestre actual */
        $semestre = Semestres::findFirst(
            [
                "activo = 'M'",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );
        $this->view->semestre = $semestre;
        /* fin semestre */

        /* Calculo de ciclo */
        $ciclo_creditos = CreditosCiclos::find("carrera = '{$alumnos->carrera}'");
        $evalue = array();
        $sum = 0;

        $credinfo = array();
        foreach ($ciclo_creditos as $key => $value) {
            $credinfo[$value->ciclo] = $value->creditos;
            $sum = $sum + (int) $value->creditos;

            $evalue["{$value->ciclo}"][] = $sum;
        }

        #Filtros mario vista
        #AND AlumnosAsignatura.tipo <> 5  AND AlumnosAsignatura.tipo <> 2  AND AlumnosAsignatura.estado='A'
        /* Obteniendo numero de creditos */
        $numero_cre = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturas')
            ->columns('SUM(Asignaturas.creditos) as total')
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
            ->where("AlumnosAsignaturas.alumno ='{$alumnos->codigo}' AND AlumnosAsignaturas.pf > 10 AND AlumnosAsignaturas.tipo <> 5  AND AlumnosAsignaturas.tipo <> 9  AND AlumnosAsignaturas.tipo <> 2  AND AlumnosAsignaturas.estado ='1' ")
        //->orderBy("Noticias.noticia_id DESC")
        //->orderBy("Noticias.fecha_publicacion DESC")
            ->getQuery()
            ->execute();
        $nc = $numero_cre[0]->total;
        //print $nc;exit();

        $this->view->totalcreditos = $nc;

        /* Fin */

        $n_creditos = (int) $nc;
        $ciclo_corresponde = "";

        foreach ($evalue as $key => $value) {
            if ($n_creditos <= $value[0]) {
                if ($ciclo_corresponde == "") {
                    $ciclo_corresponde = $key;
                }
            }
        }

        $this->view->ciclo = $ciclo_corresponde;

        //datatables notas
        $this->assets->addJs("adminpanel/js/modulos/notas.alumnos.js?v=" . uniqid());

        //asignatura
        $asignaturas = $this->modelsManager->createBuilder()
            ->from('Asignaturas')
            ->columns('Asignaturas.codigo,'
                . 'Asignaturas.nombre,'
                . 'Asignaturas.ciclo')
            ->where("Asignaturas.estado ='A' AND SUBSTRING (curricula,1,4) = '0101'")
        //->orderBy("Noticias.noticia_id DESC")
            ->orderBy("Asignaturas.ciclo, Asignaturas.codigo, Asignaturas.nombre")
            ->getQuery()
            ->execute();
        $this->view->asignaturas = $asignaturas;
    }

    //datatable notas.alumnos
    public function datatable_notas_alumnosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("al_a.alumno");
            $datatable->setSelect("al_a.alumno, al_a.semestre, "
                . "al_a.asignatura, al_a.tipo, al_a.veces, "
                . "al_a.pf, al_a.observacion, al_a.estado, "
                . "a.ciclo, a.nombre, tipo.nombres, sem.descripcion");
            $datatable->setFrom("alumnos_asignaturas al_a "
                . "INNER JOIN asignaturas a ON a.codigo = al_a.asignatura"
                . " INNER JOIN a_codigos tipo ON al_a.tipo = tipo.codigo "
                . " INNER JOIN semestres sem ON sem.codigo = al_a.semestre ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("personal_permisos.estado_detalle = 'A' AND personal_permisos.estado_detalle = 'A' AND  personal_permisos.id_area = $id");
            $datatable->setWhere("al_a.alumno = '$id' AND tipo.numero = 9  ");
            $datatable->setOrderby("al_a.semestre, a.ciclo, al_a.asignatura");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //getAjaxNotasAlumnos
    public function getAjaxNotasAlumnosAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $veces = (int) $this->request->getPost("veces", "int");
            $tipo = (int) $this->request->getPost("tipo", "int");

            //echo "<pre>";
            //print_r("Semestre:" . $semestre . "-" . "Asignatura:" . $asignatura . "-" . "Alumno:" . $alumno . "-" . "Veces:" . $veces . "-" . "Tipo:" . $tipo);
            //exit();

            $alumnos_asignaturas = AlumnosAsignaturas::findFirst(
                [
                    "semestre = $semestre AND asignatura = '$asignatura' AND alumno = '$alumno' AND veces = $veces AND tipo = $tipo ",
                ]
            );

            //echo '<pre>';
            //print_r($alumnos_asignaturas->tipo);
            //exit();

            if ($alumnos_asignaturas->tipo == 9) {

                $this->response->setJsonContent($alumnos_asignaturas->toArray());
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $veces = (int) $this->request->getPost("veces", "int");
            $tipo = (int) $this->request->getPost("tipo", "int");

            //echo "<pre>";
            //print_r("Semestre:" . $semestre . "-" . "Asignatura:" . $asignatura . "-" . "Alumno:" . $alumno . "-" . "Veces:" . $veces . "-" . "Tipo:" . $tipo);
            //exit();

            $alumnos_asignaturas = AlumnosAsignaturas::findFirst(
                [
                    "semestre = $semestre AND asignatura = '$asignatura' AND alumno = '$alumno' AND veces = $veces AND tipo = $tipo ",
                ]
            );

            if ($alumnos_asignaturas && $alumnos_asignaturas->estado = '1') {
                $alumnos_asignaturas->estado = '0';
                $alumnos_asignaturas->save();
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

    //encuesta registrada
    public function asignaturaRegistradaAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$alumnos_asignaturas = AlumnosAsignaturas::findFirstByasignatura((string) $this->request->getPost("id", "string"));
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $alumno = (string) $this->request->getPost("alumno", "string");

            //echo '<pre>';
            //print_r("Testing:".$asignatura.'-'.$alumno);
            //exit();

            $alumnos_asignaturas_sql = $this->modelsManager->createQuery("SELECT
            count(*) AS nro
            FROM
            AlumnosAsignaturas
            WHERE AlumnosAsignaturas.alumno = '" . $alumno . "'
            AND AlumnosAsignaturas.asignatura = '" . $asignatura . "'");
            $alumnos_asignaturas = $alumnos_asignaturas_sql->execute();

            foreach ($alumnos_asignaturas as $test) {

                $test->nro;
            }

            if ($test->nro > 0) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                //echo'<pre>';
                //print_r('Si existe');
                //exit();
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                //echo'<pre>';
                //print_r('No existe');
                //exit();
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //asignaturas matriculadas
    public function getAsignaturasMatriculadasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $alumno = (string) $this->request->getPost("alumno", "string");
            $semestre = (int) $this->request->getPost("semestre", "int");

            //print($alumno . "-" . $semestre);
            //exit();

            $AlumnosAsignaturas = $this->modelsManager->createBuilder()
                ->from('AlumnosAsignaturas')
                ->columns('DISTINCT AlumnosAsignaturas.asignatura ,AlumnosAsignaturas.semestre, AlumnosAsignaturas.asignatura, AlumnosAsignaturas.tipo, DocentesAsignaturas.observacion,
                           AlumnosAsignaturas.alumno,TipoMatricula.descripcion ,AlumnosAsignaturas.pf, Asignaturas.nombre, Asignaturas.creditos, Asignaturas.ciclo, AlumnosAsignaturas.grupo,
                           TipoMatricula.nombres AS tipo_matricula')
                ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
                ->join('TipoMatricula', 'TipoMatricula.codigo = AlumnosAsignaturas.tipo')
                ->join('DocentesAsignaturas', 'Asignaturas.codigo = DocentesAsignaturas.asignatura AND DocentesAsignaturas.grupo = AlumnosAsignaturas.grupo')
                ->where("AlumnosAsignaturas.alumno='{$alumno}' AND  AlumnosAsignaturas.semestre = {$semestre} AND TipoMatricula.numero = 9 AND DocentesAsignaturas.semestre = {$semestre}  ")
                ->orderBy('Asignaturas.ciclo ASC,  AlumnosAsignaturas.asignatura')
                ->getQuery()
                ->execute();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent($AlumnosAsignaturas->toArray());
            $this->response->send();
        }
    }

    //guardar ficha de matricula
    public function saveFichaAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $key_semestre = (int) $this->request->getPost("key_semestre", "int");
            $key_alumno = (string) $this->request->getPost("key_alumno", "string");

            foreach ($_POST["asignaturas"] as $key_asignaturas => $value_asignaturas) {

                //tipo de asignatura
                foreach ($_POST["tipo_asignatura"] as $key_tipo_asignatura => $value_tipo_asignatura) {

                    if ($key_asignaturas == $key_tipo_asignatura) {
                        $tipo = $value_tipo_asignatura;
                    }
                }

                //grupos
                foreach ($_POST["grupos"] as $key_grupos => $value_grupos) {

                    if ($key_asignaturas == $key_grupos) {
                        $grupo = $value_grupos;
                    }
                }

                //veces
                foreach ($_POST["veces"] as $key_veces => $value_veces) {

                    if ($key_asignaturas == $key_veces) {
                        $veces = $value_veces;
                    }
                }

                //update a alumnos_asignaturas
                $db_update_a_s = $this->db;
                $sql_update_a_s = " UPDATE alumnos_asignaturas SET tipo = {$tipo}, veces = {$veces} "
                    . "WHERE semestre = {$key_semestre} AND alumno = '{$key_alumno}' AND asignatura ='{$value_asignaturas}' AND grupo = $grupo  ";
                $db_update_a_s->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //restablecer matricula
    public function restablecerMatriculaAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $key_semestre = (int) $this->request->getPost("semestre", "int");
            $key_alumno = (string) $this->request->getPost("alumno", "string");

            //print($key_alumno ."-".$key_semestre);
            //exit();

            $db_delete_a_a_d = $this->db;
            $sql_delete_a_a_d = " DELETE FROM alumnos_asignaturas_detalle WHERE semestre = {$key_semestre} AND alumno = '{$key_alumno}' ";
            $db_delete_a_a_d->fetchOne($sql_delete_a_a_d, Phalcon\Db::FETCH_OBJ);

            $db_delete_a_a = $this->db;
            $sql_delete_a_a = " DELETE FROM alumnos_asignaturas WHERE semestre = {$key_semestre} AND alumno = '{$key_alumno}' ";
            $db_delete_a_a->fetchOne($sql_delete_a_a, Phalcon\Db::FETCH_OBJ);

            $db_delete_a_s = $this->db;
            $sql_delete_a_s = " DELETE FROM alumnos_semestre WHERE semestre = {$key_semestre} AND alumno = '{$key_alumno}' ";
            $db_delete_a_s->fetchOne($sql_delete_a_s, Phalcon\Db::FETCH_OBJ);

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //save requisitos
    public function saverequisitosAction()
    {
        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $key_requisitos_semestre = $this->request->getPost("key_requisitos_semestre", "string");
                $key_requisitos_alumno = $this->request->getPost("key_requisitos_alumno", "string");

                $registros_academicos = $this->request->getPost("registros_academicos", "string");
                if (isset($registros_academicos)) {
                    $sql_registros_academicos = 1;
                } else {
                    $sql_registros_academicos = 0;
                }

                $servicio_salud = $this->request->getPost("servicio_salud", "string");
                if (isset($servicio_salud)) {
                    $sql_servicio_salud = 1;
                } else {
                    $sql_servicio_salud = 0;
                }

                $servicio_social = $this->request->getPost("servicio_social", "string");
                if (isset($servicio_social)) {
                    $sql_servicio_social = 1;
                } else {
                    $sql_servicio_social = 0;
                }

                $servicio_psicopedagogico = $this->request->getPost("servicio_psicopedagogico", "string");
                if (isset($servicio_psicopedagogico)) {
                    $sql_servicio_psicopedagogico = 1;
                } else {
                    $sql_servicio_psicopedagogico = 0;
                }

                $servicio_deportivo = $this->request->getPost("servicio_deportivo", "string");
                if (isset($servicio_deportivo)) {
                    $sql_servicio_deportivo = 1;
                } else {
                    $sql_servicio_deportivo = 0;
                }

                $servicio_cultural = $this->request->getPost("servicio_cultural", "string");
                if (isset($servicio_cultural)) {
                    $sql_servicio_cultural = 1;
                } else {
                    $sql_servicio_cultural = 0;
                }

                $voucher = $this->request->getPost("voucher", "string");
                if (isset($voucher)) {
                    $sql_voucher = 1;
                } else {
                    $sql_voucher = 0;
                }

                $resolucion_matricula_especial = $this->request->getPost("resolucion_matricula_especial", "string");
                if (isset($resolucion_matricula_especial)) {
                    $sql_resolucion_matricula_especial = 1;
                } else {
                    $sql_resolucion_matricula_especial = 0;
                }

                $db_update_a_s = $this->db;
                $sql_update_a_s = " UPDATE alumnos_semestre SET registros_academicos = '{$sql_registros_academicos}', "
                    . "servicio_salud = '{$sql_servicio_salud}', servicio_social = '{$sql_servicio_salud}', "
                    . "servicio_psicopedagogico = '{$sql_servicio_psicopedagogico}', servicio_deportivo ='{$sql_servicio_deportivo}', "
                    . "servicio_cultural = '{$sql_servicio_cultural}',voucher = '{$sql_voucher}', matricula_realizada = '{$sql_matricula_realizada}',"
                    . "resolucion_matricula_especial = '{$sql_resolucion_matricula_especial}' "
                    . "WHERE semestre = {$key_requisitos_semestre} AND alumno = '{$key_requisitos_alumno}' ";
                $db_update_a_s->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);

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

    public function getrequisitosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $alumno = (string) $this->request->getPost("alumno", "string");

            $sql_alumnos_semestres = $this->modelsManager->createQuery("SELECT
                        alumnos_semestre.registros_academicos,
                        alumnos_semestre.servicio_salud,
                        alumnos_semestre.servicio_social,
                        alumnos_semestre.servicio_psicopedagogico,
                        alumnos_semestre.servicio_deportivo,
                        alumnos_semestre.servicio_cultural,
                        alumnos_semestre.voucher,
                        alumnos_semestre.matricula_realizada,
                        alumnos_semestre.resolucion_matricula_especial
                        FROM
                        AlumnosSemestre AS alumnos_semestre
                        WHERE
                        alumnos_semestre.semestre ={$semestre} AND alumnos_semestre.alumno = '{$alumno}' ");
            $AlumnosSemestre = $sql_alumnos_semestres->execute();

//            foreach ($AlumnosSemestre as $test) {
            //                echo '<pre>';
            //                print_r($test->registros_academicos);
            //            }
            //exit();

            $this->response->setJsonContent($AlumnosSemestre->toArray());
            $this->response->send();
        }
    }

    //convalidaciones
    public function convalidacionesAction($id = null)
    {
        $this->view->id = $id;

        if ($id != null) {
            $alumnos = Alumnos::findFirstBycodigo((int) $id);
        } else {
            //$docentes = Asignaturas::findFirstBycodigo(0);
            $alumnos = Alumnos::findFirstBycodigo(null);
        }

        $carrera = Carreras::findFirstBycodigo($alumnos->carrera);

        $this->view->alumno = $alumnos;
        $this->view->carrera = $carrera;

        /* Calculamos el semestre actual */
        $semestre = Semestres::findFirst("activo = 'M'");
        $this->view->semestre = $semestre;
        /* fin semestre */

        #Filtros mario vista
        #AND AlumnosAsignatura.tipo <> 5  AND AlumnosAsignatura.tipo <> 2  AND AlumnosAsignatura.estado='A'
        /* Obteniendo numero de creditos */
        $numero_cre = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturas')
            ->columns('SUM(Asignaturas.creditos) as total')
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
            ->where("AlumnosAsignaturas.alumno ='{$alumnos->codigo}' AND AlumnosAsignaturas.pf > 10 AND AlumnosAsignaturas.tipo <> 5  AND AlumnosAsignaturas.tipo <> 9  AND AlumnosAsignaturas.tipo <> 2  AND AlumnosAsignaturas.estado ='1' ")
        //->orderBy("Noticias.noticia_id DESC")
        //->orderBy("Noticias.fecha_publicacion DESC")
            ->getQuery()
            ->execute();
        $nc = $numero_cre[0]->total;
        //print $nc;exit();

        $this->view->totalcreditos = $nc;

        $AlumnosSemestre = AlumnosSemestre::findFirst(
            [
                "semestre = {$semestre->codigo} AND alumno = '{$alumnos->codigo}' ",
            ]
        );
        $this->view->ciclo = $AlumnosSemestre->ciclo;

        //datatables notas
        //asignatura
        $asignaturas = $this->modelsManager->createBuilder()
            ->from('Asignaturas')
            ->columns('Asignaturas.codigo,'
                . 'Asignaturas.nombre,'
                . 'Asignaturas.ciclo')
            ->where("Asignaturas.estado ='A' AND SUBSTRING (curricula,1,4) = '0101'")
        //->orderBy("Noticias.noticia_id DESC")
            ->orderBy("Asignaturas.ciclo, Asignaturas.codigo, Asignaturas.nombre")
            ->getQuery()
            ->execute();
        $this->view->asignaturas = $asignaturas;

        //js
        $this->assets->addJs("adminpanel/js/modulos/gestionalumnos.convalidaciones.js?v=" . uniqid());
    }

    public function datatable_notas_convalidacionAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("al_a.alumno");
            $datatable->setSelect("al_a.alumno, al_a.semestre, "
                . "al_a.asignatura, al_a.tipo, al_a.veces, "
                . "al_a.pf, al_a.observacion, al_a.estado, "
                . "a.ciclo, a.nombre, tipo.nombres, sem.descripcion");
            $datatable->setFrom("alumnos_asignaturas al_a "
                . "INNER JOIN asignaturas a ON a.codigo = al_a.asignatura"
                . " INNER JOIN a_codigos tipo ON al_a.tipo = tipo.codigo "
                . " INNER JOIN semestres sem ON sem.codigo = al_a.semestre ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("personal_permisos.estado_detalle = 'A' AND personal_permisos.estado_detalle = 'A' AND  personal_permisos.id_area = $id");
            $datatable->setWhere("al_a.alumno = '$id' AND tipo.numero = 9  AND tipo.codigo = 9 ");
            $datatable->setOrderby("al_a.semestre, a.ciclo, al_a.asignatura");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveNotasConvalidacionAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $semestre = (int) $this->request->getPost("semestre", "int");
                $asignatura = (string) $this->request->getPost("asignatura", "string");
                $alumno = (string) $this->request->getPost("alumno", "string");
                $grupo = 1;
                $tipo = 9;

                //echo '<pre>';
                //print_r($id2);
                //exit();
                //$alumnos_asignaturas = Objetivosei::findFirstByid_objetivo_ei($id);

                $alumnos_asignaturas = AlumnosAsignaturas::findFirst(
                    [
                        "semestre = $semestre AND asignatura = '$asignatura' AND alumno = '$alumno' AND grupo = $grupo AND tipo = $tipo ",
                    ]
                );

                //Valida cuando es nuevo
                $alumnos_asignaturas = (!$alumnos_asignaturas) ? new AlumnosAsignaturas() : $alumnos_asignaturas;

                $alumnos_asignaturas->semestre = $this->request->getPost("semestre", "int");
                $alumnos_asignaturas->asignatura = $this->request->getPost("asignatura", "string");
                $alumnos_asignaturas->alumno = $this->request->getPost("alumno", "string");
                $alumnos_asignaturas->veces = 1;

                $alumnos_asignaturas->tipo = 9;

                $alumnos_asignaturas->cerrado = 1;

                //id_objetivo_ei
                $alumnos_asignaturas->pf = $this->request->getPost("pf", "string");

                //nombre
                $alumnos_asignaturas->observacion = $this->request->getPost("observacion", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $alumnos_asignaturas->estado = "A";
                } else {
                    $alumnos_asignaturas->estado = "X";
                }
                //grupo
                $alumnos_asignaturas->grupo = 1;

                if ($alumnos_asignaturas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($alumnos_asignaturas->getMessages());
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

    public function getAjaxNotasConvalidacionAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $veces = (int) $this->request->getPost("veces", "int");
            $tipo = (int) $this->request->getPost("tipo", "int");

            //echo "<pre>";
            //print_r("Semestre:" . $semestre . "-" . "Asignatura:" . $asignatura . "-" . "Alumno:" . $alumno . "-" . "Veces:" . $veces . "-" . "Tipo:" . $tipo);
            //exit();

            $alumnos_asignaturas = AlumnosAsignaturas::findFirst(
                [
                    "semestre = $semestre AND asignatura = '$asignatura' AND alumno = '$alumno' AND veces = $veces AND tipo = $tipo ",
                ]
            );

            //echo '<pre>';
            //print_r($alumnos_asignaturas->tipo);
            //exit();

            if ($alumnos_asignaturas->tipo == 9) {

                $this->response->setJsonContent($alumnos_asignaturas->toArray());
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarconvalidacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = (int) $this->request->getPost("semestre", "int");
            $asignatura = (string) $this->request->getPost("asignatura", "string");
            $alumno = (string) $this->request->getPost("alumno", "string");
            $veces = (int) $this->request->getPost("veces", "int");
            $tipo = (int) $this->request->getPost("tipo", "int");

            //echo "<pre>";
            //print_r("Semestre:" . $semestre . "-" . "Asignatura:" . $asignatura . "-" . "Alumno:" . $alumno . "-" . "Veces:" . $veces . "-" . "Tipo:" . $tipo);
            //exit();

            $alumnos_asignaturas = AlumnosAsignaturas::findFirst(
                [
                    "semestre = $semestre AND asignatura = '$asignatura' AND alumno = '$alumno' AND veces = $veces AND tipo = $tipo ",
                ]
            );

            if ($alumnos_asignaturas && $alumnos_asignaturas->estado = '1') {
                $alumnos_asignaturas->estado = '0';
                $alumnos_asignaturas->save();
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

    public function rectificarAction($semestre, $alumno)
    {
        //alumnos
        $Alumnos = Alumnos::findFirstBycodigo($alumno);
        $this->view->alumno = $Alumnos;

        $AlumnosSemestre = AlumnosSemestre::findFirst(
            [
                "semestre = {$semestre} AND alumno = '{$alumno}' ",
            ]
        );
        //print($AlumnosSemestre->ciclo);
        //exit();

        $this->view->ciclo = $AlumnosSemestre->ciclo;
        $this->view->semestre = $AlumnosSemestre->semestre;

        //cursos disponibles
        $CursosDisponibles = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturasPre')
            ->columns("AlumnosAsignaturasPre.semestre, AlumnosAsignaturasPre.alumno, AlumnosAsignaturasPre.asignatura, "
                . "Asignaturas.nombre, Asignaturas.ciclo, Asignaturas.creditos,Asignaturas.pr1, "
                . "Asignaturas.pr2,Asignaturas.pr3,Asignaturas.prhm, Asignaturas.ht, Asignaturas.hp, TipoAsignaturas.nombres AS tipo_asignatura, "
                . " AlumnosAsignaturasPre.tipo, AlumnosAsignaturasPre.activo, DocentesAsignaturas.observacion, "
                . " DocentesAsignaturas.docente, CONCAT(Docentes.nombres,' ',Docentes.apellidop,' ',Docentes.apellidom) AS docentename, DocentesAsignaturas.grupo")
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturasPre.asignatura')
            ->join('TipoAsignaturas', 'TipoAsignaturas.codigo = Asignaturas.tipo')
            ->join('DocentesAsignaturas', 'DocentesAsignaturas.asignatura = Asignaturas.codigo')
            ->join('AsignaturasSemestreCarreras', 'DocentesAsignaturas.asignatura = AsignaturasSemestreCarreras.asignatura '
                . 'AND DocentesAsignaturas.grupo = AsignaturasSemestreCarreras.grupo ')
            ->join('Docentes', 'Docentes.codigo = DocentesAsignaturas.docente')
            ->where("AlumnosAsignaturasPre.alumno='{$alumno}' AND AlumnosAsignaturasPre.semestre={$semestre}"
                . " AND DocentesAsignaturas.semestre={$semestre} AND DocentesAsignaturas.estado= 'A' "
                . "AND TipoAsignaturas.numero = 71 AND AsignaturasSemestreCarreras.carrera='{$Alumnos->carrera}' "
                . "AND AsignaturasSemestreCarreras.semestre={$semestre} ")
            ->orderBy('Asignaturas.ciclo ASC,  Asignaturas.codigo, DocentesAsignaturas.grupo')
        //->limit(7)
            ->getQuery()
            ->execute();
        $this->view->cursos_disponibles = $CursosDisponibles;

//        foreach ($CursosDisponibles as $value) {
        //            echo '<pre>';
        //            print_r($value->asignatura);
        //        }
        //        exit();

        $AlumnosAsignaturas = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturas')
            ->columns('DISTINCT AlumnosAsignaturas.asignatura ,AlumnosAsignaturas.semestre, AlumnosAsignaturas.asignatura, AlumnosAsignaturas.tipo, DocentesAsignaturas.observacion,
                           AlumnosAsignaturas.alumno,TipoMatricula.descripcion ,AlumnosAsignaturas.pf, Asignaturas.nombre, Asignaturas.creditos, Asignaturas.ciclo, AlumnosAsignaturas.grupo,
                           TipoMatricula.nombres AS tipo_matricula, AlumnosAsignaturas.veces,AlumnosAsignaturas.cerrado ')
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
            ->join('TipoMatricula', 'TipoMatricula.codigo = AlumnosAsignaturas.tipo')
            ->join('DocentesAsignaturas', 'Asignaturas.codigo = DocentesAsignaturas.asignatura AND DocentesAsignaturas.grupo = AlumnosAsignaturas.grupo')
            ->where("AlumnosAsignaturas.alumno='{$alumno}' AND  AlumnosAsignaturas.semestre = {$semestre} AND TipoMatricula.numero = 9 AND DocentesAsignaturas.semestre = {$semestre}  ")
            ->orderBy('Asignaturas.ciclo ASC,  AlumnosAsignaturas.asignatura')
            ->getQuery()
            ->execute();
        $this->view->alumnos_asignaturas = $AlumnosAsignaturas;

        //tipo de asignaturas
        $TipoAasignaturas = TipoAsignaturas::find(
            [
                "estado = 'A' AND numero = 9",
            ]
        );
        $this->view->tipo_asignaturas = $TipoAasignaturas;

        $this->assets->addJs("adminpanel/js/modulos/gestionalumnos.js?v=" . uniqid());
    }

    //
    public function getAlumnosAsignaturasAction()
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
            $alumno = (string) $this->request->getPost("alumno", "string");

//            $db_select = $this->db;
            //            $sql_select_a_s_c = " SELECT * FROM asignaturas_semestre_carreras "
            //                    . "WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = $grupo AND carrera = '{$carrera}' ";
            //            $AsignaturasSemestreCarreras = $db_select->fetchOne($sql_select_a_s_c, Phalcon\Db::FETCH_OBJ);

            $AlumnosAsignaturas = AlumnosAsignaturas::findFirst(
                [
                    "semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND alumno = '{$alumno}' ",
                ]
            );

            //echo '<pre>';
            //print_r($AsignaturasSemestreCarreras->carrera);
            //exit();

            if ($AlumnosAsignaturas) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
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

    //
    //guarda carrera
    public function saveAlumnosAsignaturasAction()
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
                $alumno = (string) $this->request->getPost("alumno", "string");

                //AlumnosAsignaturas
                $AlumnosAsignaturas = new AlumnosAsignaturas();
                $AlumnosAsignaturas->semestre = $semestre;
                $AlumnosAsignaturas->asignatura = $asignatura;
                $AlumnosAsignaturas->grupo = $grupo;
                $AlumnosAsignaturas->alumno = $alumno;
                $AlumnosAsignaturas->tipo = 3;
                $AlumnosAsignaturas->veces = 1;
                $AlumnosAsignaturas->pf = -1;
                $AlumnosAsignaturas->cerrado = 2;
                $AlumnosAsignaturas->estado = 'A';
                $AlumnosAsignaturas->save();

                //AlumnosAsignaturasDetalle
                $subgrupo = array(1, 2);
                foreach ($subgrupo as $sg) {
                    $AlumnosAsignaturasDetalle = new AlumnosAsignaturasDetalle();
                    $AlumnosAsignaturasDetalle->semestre = $AlumnosAsignaturas->semestre;
                    $AlumnosAsignaturasDetalle->asignatura = $AlumnosAsignaturas->asignatura;
                    $AlumnosAsignaturasDetalle->grupo = $AlumnosAsignaturas->grupo;
                    $AlumnosAsignaturasDetalle->alumno = $AlumnosAsignaturas->alumno;
                    $AlumnosAsignaturasDetalle->tipo = $AlumnosAsignaturas->tipo;
                    $AlumnosAsignaturasDetalle->veces = $AlumnosAsignaturas->veces;
                    $AlumnosAsignaturasDetalle->subgrupo = $sg;
                    $AlumnosAsignaturasDetalle->modalidad = $sg;
                    $AlumnosAsignaturasDetalle->cerrado = $AlumnosAsignaturas->cerrado;
                    $AlumnosAsignaturasDetalle->estado = 'A';
                    $AlumnosAsignaturasDetalle->save();
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

    //
    //eliminar carrera
    public function eliminarAlumnosAsignaturasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $semestre = $this->request->getPost("semestre", "int");
            $asignatura = $this->request->getPost("asignatura", "string");
            $grupo = $this->request->getPost("grupo", "int");
            $alumno = $this->request->getPost("alumno", "string");

            //echo '<pre>';
            //print_r("Semestre:" . $semestre . "- Asignatura:" . $asignatura . "- Grupo:" . $grupo . "- Alumno:" . $alumno);
            //exit();

            $db_delete_a_a = $this->db;
            $sql_delete_a_a = " DELETE FROM alumnos_asignaturas WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND alumno = '{$alumno}' ";
            $db_delete_a_a->fetchOne($sql_delete_a_a, Phalcon\Db::FETCH_OBJ);

            $db_delete_a_a_d = $this->db;
            $sql_delete_a_a_d = " DELETE FROM alumnos_asignaturas_detalle WHERE semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo} AND alumno = '{$alumno}' ";
            $db_delete_a_a_d->fetchOne($sql_delete_a_a_d, Phalcon\Db::FETCH_OBJ);

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function registroAction($sem, $id = null)
    {
//        print($sem . "-" . $id);
        //        exit();

        $this->view->semestrea = $sem;
        //nombre del estudiantes
        $Alumnos = Alumnos::findFirstBycodigo($id);
        $estudiante = $Alumnos->apellidom . " " . $Alumnos->apellidop . " " . $Alumnos->nombres;
        $this->view->estudiante = $estudiante;

        $AlumnosSemestre = AlumnosSemestre::findFirst("alumno = '{$id}' AND semestre = {$sem}");

//        print($AlumnosSemestre->alumno);
        //        exit();

        $this->view->alumnos_semestre = $AlumnosSemestre;

        //consejero
        $Consejeros = Docentes::find("estado = 'A' ORDER BY apellidop, apellidom, nombres");
        $this->view->consejeros = $Consejeros;

        //tutores
        $Tutores = Docentes::find("estado = 'A' ORDER BY apellidop, apellidom, nombres");
        $this->view->tutores = $Tutores;

        $this->assets->addJs("adminpanel/js/modulos/gestionalumnos.registro.js?v=" . uniqid());
    }

    //Funcion para guardar alumno
    public function saveRegistroAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("alumno", "string");
                $semestre = (int) $this->request->getPost("semestre", "int");

                //print($id);
                //exit();

                $alumnosSemestre = AlumnosSemestre::findFirst("alumno = '{$id}' AND semestre = {$semestre}");

                //$alumnosSemestre = (!$alumnosSemestre) ? new Alumnos() : $Alumnos;

                //consejero
                if ($this->request->getPost("consejero", "int") == "") {
                    $alumnosSemestre->consejero = null;
                } else {
                    //print("Testing");
                    //exit();
                    $alumnosSemestre->consejero = $this->request->getPost("consejero", "int");
                }

                //fecha_matricula
                if ($this->request->getPost("fecha_matricula", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_matricula", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_matricula = date('Y-m-d', strtotime($fecha_new));
                }

                //nivelacion_s
                $nivelacionS = $this->request->getPost("nivelacion_s", "string");
                if (isset($nivelacionS)) {
                    $alumnosSemestre->nivelacion_s = 1;
                } else {
                    $alumnosSemestre->nivelacion_s = 0;
                }

                //nivelacion
                if ($this->request->getPost("nivelacion", "int") == "") {
                    $alumnosSemestre->nivelacion = null;
                } else {
                    $alumnosSemestre->nivelacion = $this->request->getPost("nivelacion", "int");
                }

                //fecha_nivelacion
                if ($this->request->getPost("fecha_nivelacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nivelacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_nivelacion = date('Y-m-d', strtotime($fecha_new));
                }

                //ampliacion_s
                $ampliacionS = $this->request->getPost("ampliacion_s", "string");
                if (isset($nivelacionS)) {
                    $alumnosSemestre->ampliacion_s = 1;
                } else {
                    $alumnosSemestre->ampliacion_s = 0;
                }

                //ampliacion
                if ($this->request->getPost("ampliacion", "int") == "") {
                    $alumnosSemestre->ampliacion = null;
                } else {
                    $alumnosSemestre->ampliacion = $this->request->getPost("ampliacion", "int");
                }

                //fecha_ampliacion
                if ($this->request->getPost("fecha_ampliacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_ampliacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_ampliacion = date('Y-m-d', strtotime($fecha_new));
                }

                //paralelos_s
                $paralelosS = $this->request->getPost("paralelos_s", "string");
                if (isset($paralelosS)) {
                    $alumnosSemestre->paralelos_s = 1;
                } else {
                    $alumnosSemestre->paralelos_s = 0;
                }

                //paralelos
                if ($this->request->getPost("paralelos", "int") == "") {
                    $alumnosSemestre->paralelos = null;
                } else {
                    $alumnosSemestre->paralelos = $this->request->getPost("paralelos", "int");
                }

                //fecha_paralelo
                if ($this->request->getPost("fecha_paralelo", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_paralelo", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_paralelo = date('Y-m-d', strtotime($fecha_new));
                }

                //rectificacion_s
                $rectificacionS = $this->request->getPost("rectificacion_s", "string");
                if (isset($rectificacionS)) {
                    $alumnosSemestre->rectificacion_s = 1;
                } else {
                    $alumnosSemestre->rectificacion_s = 0;
                }

                //fecha_rectificacion
                if ($this->request->getPost("fecha_rectificacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_rectificacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_rectificacion = date('Y-m-d', strtotime($fecha_new));
                }

                //carne_u_s
                $carneUS = $this->request->getPost("carne_u_s", "string");
                if (isset($carneUS)) {
                    $alumnosSemestre->carne_u_s = 1;
                } else {
                    $alumnosSemestre->carne_u_s = 0;
                }

                //carne_u_r
                $carneUR = $this->request->getPost("carne_u_r", "string");
                if (isset($carneUR)) {
                    $alumnosSemestre->carne_u_r = 1;
                } else {
                    $alumnosSemestre->carne_u_r = 0;
                }

                //es_regular
                $esRegular = $this->request->getPost("es_regular", "string");
                if (isset($esRegular)) {
                    $alumnosSemestre->es_regular = 1;
                } else {
                    $alumnosSemestre->es_regular = 0;
                }

                //matricula_ok
                $matriculaOk = $this->request->getPost("matricula_ok", "string");
                if (isset($matriculaOk)) {
                    $alumnosSemestre->matricula_ok = 1;
                } else {
                    $alumnosSemestre->matricula_ok = 0;
                }

                //a1
                if ($this->request->getPost("a1", "int") == "") {
                    $alumnosSemestre->a1 = null;
                } else {
                    $alumnosSemestre->a1 = $this->request->getPost("a1", "int");
                }

                //a2
                if ($this->request->getPost("a2", "int") == "") {
                    $alumnosSemestre->a2 = null;
                } else {
                    $alumnosSemestre->a2 = $this->request->getPost("a2", "int");
                }

                //a3
                if ($this->request->getPost("a3", "int") == "") {
                    $alumnosSemestre->a3 = null;
                } else {
                    $alumnosSemestre->a3 = $this->request->getPost("a3", "int");
                }

                //a4
                if ($this->request->getPost("a4", "int") == "") {
                    $alumnosSemestre->a4 = null;
                } else {
                    $alumnosSemestre->a4 = $this->request->getPost("a4", "int");
                }

                //a5
                if ($this->request->getPost("a5", "int") == "") {
                    $alumnosSemestre->a5 = null;
                } else {
                    $alumnosSemestre->a5 = $this->request->getPost("a5", "int");
                }

                //a6
                if ($this->request->getPost("a6", "int") == "") {
                    $alumnosSemestre->a6 = null;
                } else {
                    $alumnosSemestre->a6 = $this->request->getPost("a6", "int");
                }

                //a7
                if ($this->request->getPost("a7", "int") == "") {
                    $alumnosSemestre->a7 = null;
                } else {
                    $alumnosSemestre->a7 = $this->request->getPost("a7", "int");
                }

                //a8
                if ($this->request->getPost("a8", "int") == "") {
                    $alumnosSemestre->a8 = null;
                } else {
                    $alumnosSemestre->a8 = $this->request->getPost("a8", "int");
                }

                //a9
                if ($this->request->getPost("a9", "int") == "") {
                    $alumnosSemestre->a9 = null;
                } else {
                    $alumnosSemestre->a9 = $this->request->getPost("a9", "int");
                }

                //a0
                if ($this->request->getPost("a0", "int") == "") {
                    $alumnosSemestre->a0 = null;
                } else {
                    $alumnosSemestre->a0 = $this->request->getPost("a0", "int");
                }

                //ht
                if ($this->request->getPost("ht", "int") == "") {
                    $alumnosSemestre->ht = null;
                } else {
                    $alumnosSemestre->ht = $this->request->getPost("ht", "int");
                }

                //hp
                if ($this->request->getPost("hp", "int") == "") {
                    $alumnosSemestre->hp = null;
                } else {
                    $alumnosSemestre->hp = $this->request->getPost("hp", "int");
                }

                //creditos
                if ($this->request->getPost("creditos", "int") == "") {
                    $alumnosSemestre->creditos = null;
                } else {
                    $alumnosSemestre->creditos = $this->request->getPost("creditos", "int");
                }

                //ciclo
                if ($this->request->getPost("ciclo", "int") == "") {
                    $alumnosSemestre->ciclo = null;
                } else {
                    $alumnosSemestre->ciclo = $this->request->getPost("ciclo", "int");
                }

                //promedio
                $alumnosSemestre->promedio = $this->request->getPost("promedio", "string");

                //tutor
                if ($this->request->getPost("tutor", "int") == "") {
                    $alumnosSemestre->tutor = null;
                } else {
                    $alumnosSemestre->tutor = $this->request->getPost("tutor", "int");
                }

                //estado
                $alumnosSemestre->estado = "A";

                //orden
                if ($this->request->getPost("orden", "int") == "") {
                    $alumnosSemestre->orden = null;
                } else {
                    $alumnosSemestre->orden = $this->request->getPost("orden", "int");
                }

                //registros_academicos
                $registrosAcademicos = $this->request->getPost("registros_academicos", "string");
                if (isset($registrosAcademicos)) {
                    $alumnosSemestre->registros_academicos = 1;
                } else {
                    $alumnosSemestre->registros_academicos = 0;
                }

                //servicio_salud
                $servicioSalud = $this->request->getPost("servicio_salud", "string");
                if (isset($servicioSalud)) {
                    $alumnosSemestre->servicio_salud = 1;
                } else {
                    $alumnosSemestre->servicio_salud = 0;
                }

                //servicio_social
                $servicioSocial = $this->request->getPost("servicio_social", "string");
                if (isset($servicioSocial)) {
                    $alumnosSemestre->servicio_social = 1;
                } else {
                    $alumnosSemestre->servicio_social = 0;
                }

                //servicio_psicopedagogico
                $servicioPsicopedagogico = $this->request->getPost("servicio_psicopedagogico", "string");
                if (isset($servicioPsicopedagogico)) {
                    $alumnosSemestre->servicio_psicopedagogico = 1;
                } else {
                    $alumnosSemestre->servicio_psicopedagogico = 0;
                }

                //servicio_deportivo
                $servicioDeportivo = $this->request->getPost("servicio_deportivo", "string");
                if (isset($servicioDeportivo)) {
                    $alumnosSemestre->servicio_deportivo = 1;
                } else {
                    $alumnosSemestre->servicio_deportivo = 0;
                }

                //servicio_cultural
                $servicioCultural = $this->request->getPost("servicio_cultural", "string");
                if (isset($servicioCultural)) {
                    $alumnosSemestre->servicio_cultural = 1;
                } else {
                    $alumnosSemestre->servicio_cultural = 0;
                }

                //voucher_nro
                $alumnosSemestre->voucher_nro = $this->request->getPost("voucher_nro", "string");

                //fecha_inicio_matricula
                if ($this->request->getPost("fecha_inicio_matricula", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio_matricula", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_inicio_matricula = date('Y-m-d', strtotime($fecha_new));
                }

                //matricula_realizada
                $matriculaRealizada = $this->request->getPost("matricula_realizada", "string");
                if (isset($matriculaRealizada)) {
                    //print("testing");exit();
                    $alumnosSemestre->matricula_realizada = 1;
                } else {
                    $alumnosSemestre->matricula_realizada = 0;
                }

                //resolucion_matricula_especial
                $resolucionMatriculaEspecial = $this->request->getPost("resolucion_matricula_especial", "string");
                if (isset($resolucionMatriculaEspecial)) {
                    $alumnosSemestre->resolucion_matricula_especial = 1;
                } else {
                    $alumnosSemestre->resolucion_matricula_especial = 0;
                }

                //reserva_matricula
                $reservaMatricula = $this->request->getPost("reserva_matricula", "string");
                if (isset($reservaMatricula)) {
                    $alumnosSemestre->reserva_matricula = 1;
                } else {
                    $alumnosSemestre->reserva_matricula = 0;
                }

                //fecha_reserva_matricula
                if ($this->request->getPost("fecha_reserva_matricula", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_reserva_matricula", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $alumnosSemestre->fecha_reserva_matricula = date('Y-m-d', strtotime($fecha_new));
                }

                //promedio_anterior
                $alumnosSemestre->promedio_anterior = $this->request->getPost("promedio_anterior", "string");

                //promedio_acumulado
                $alumnosSemestre->promedio_acumulado = $this->request->getPost("promedio_acumulado", "string");

                //creditos_acumulado
                $creditosAcumulado = $this->request->getPost("creditos_acumulado", "string");
                if (isset($creditosAcumulado)) {
                    $alumnosSemestre->creditos_acumulado = 1;
                } else {
                    $alumnosSemestre->creditos_acumulado = 0;
                }

                //orden_merito_anterior
                $ordenMeritoAnterior = $this->request->getPost("orden_merito_anterior", "string");
                if (isset($ordenMeritoAnterior)) {
                    $alumnosSemestre->orden_merito_anterior = 1;
                } else {
                    $alumnosSemestre->orden_merito_anterior = 0;
                }

                //voucher
                $voucher = $this->request->getPost("voucher", "string");
                if (isset($voucher)) {
                    $alumnosSemestre->voucher = 1;
                } else {
                    $alumnosSemestre->voucher = 0;
                }

                //observacion
                $alumnosSemestre->observacion = $this->request->getPost("observacion", "string");

                //ciclo_promedio
                if ($this->request->getPost("ciclo_promedio", "int") == "") {
                    $alumnosSemestre->ciclo_promedio = null;
                } else {
                    $alumnosSemestre->ciclo_promedio = $this->request->getPost("ciclo_promedio", "int");
                }

                //matricula_extemporanea
                $matriculaExtemporanea = $this->request->getPost("matricula_extemporanea", "string");
                if (isset($matriculaExtemporanea)) {
                    $alumnosSemestre->matricula_extemporanea = 1;
                } else {
                    $alumnosSemestre->matricula_extemporanea = 0;
                }

                if ($alumnosSemestre->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($alumnosSemestre->getMessages());
                } else {

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

    public function savepadreAction()
    {
//        echo "<pre>";
        //        print_r($_POST);
        //        exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo_padres", "int");
                $AlumnosPadres = AlumnosPadres::findFirstBycodigo_padres($id);
                $AlumnosPadres = (!$AlumnosPadres) ? new AlumnosPadres() : $AlumnosPadres;

                $AlumnosPadres->alumno = $this->request->getPost("codigo_alumno", "string");

                //Es principal
                $es_principal = $this->request->getPost("es_principal", "string");
                if (isset($es_principal)) {
                    $AlumnosPadres->es_principal = 1;
                } else {
                    $AlumnosPadres->es_principal = 0;
                }

                $AlumnosPadres->documento_padres = $this->request->getPost("documento_padres", "string");
                $AlumnosPadres->nro_doc_padres = $this->request->getPost("nro_doc_padres", "string");
                $AlumnosPadres->parentesco_padres = $this->request->getPost("parentesco_padres", "string");
                $AlumnosPadres->apellido_paterno_padres = $this->request->getPost("apellido_paterno_padres", "string");
                $AlumnosPadres->apellido_materno_padres = $this->request->getPost("apellido_materno_padres", "string");
                $AlumnosPadres->nombres_padres = $this->request->getPost("nombres_padres", "string");
                $AlumnosPadres->grado_instruccion_padres = $this->request->getPost("grado_instruccion_padres", "string");
                $AlumnosPadres->ingresos_padres = $this->request->getPost("ingresos_padres", "string");
                $AlumnosPadres->edad_padres = $this->request->getPost("edad_padres", "string");
                $AlumnosPadres->sexo_padres = $this->request->getPost("sexo_padres", "string");

                if ($this->request->getPost("fecha_nacimiento_padres", "string") != "") {
                    $fecha_ex = explode("-", $this->request->getPost("fecha_nacimiento_padres", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $AlumnosPadres->fecha_nacimiento_padres = date('Y-m-d', strtotime($fecha_new));
                }

                $AlumnosPadres->estado_civil_padres = $this->request->getPost("estado_civil_padres", "string");
                $AlumnosPadres->ocupacion_padres = $this->request->getPost("ocupacion_padres", "string");
                $AlumnosPadres->observaciones_padres = $this->request->getPost("observaciones_padres", "string");

                //$AlumnosPadres->enfermedad = $this->request->getPost("enfermedad", "string");
                $enfermedad = $this->request->getPost("enfermedad_padres", "string");
                if (isset($enfermedad)) {
                    $AlumnosPadres->enfermedad_padres = 1;
                } else {
                    $AlumnosPadres->enfermedad_padres = 0;
                }

                $AlumnosPadres->enfermedad_nombre_padres = $this->request->getPost("enfermedad_nombre_padres", "string");
                $AlumnosPadres->enfermedad_tiempo_padres = $this->request->getPost("enfermedad_tiempo_padres", "string");

                //$AlumnosPadres->tratamiento = $this->request->getPost("tratamiento", "string");
                $tratamiento = $this->request->getPost("tratamiento_padres", "string");
                if (isset($tratamiento)) {
                    $AlumnosPadres->tratamiento_padres = 1;
                } else {
                    $AlumnosPadres->tratamiento_padres = 0;
                }

                $AlumnosPadres->tratamiento_lugar_padres = $this->request->getPost("tratamiento_lugar_padres", "string");

                //$AlumnosPadres->discapacidad = $this->request->getPost("discapacidad", "string");
                $discapacidad = $this->request->getPost("discapacidad_padres", "string");
                if (isset($discapacidad)) {
                    $AlumnosPadres->discapacidad_padres = 1;
                } else {
                    $AlumnosPadres->discapacidad_padres = 0;
                }

                $AlumnosPadres->discapacidad_nombre_padres = $this->request->getPost("discapacidad_nombre_padres", "string");

                $casa = $this->request->getPost("casa_padres", "string");
                if (isset($casa)) {
                    $AlumnosPadres->casa_padres = 1;
                } else {
                    $AlumnosPadres->casa_padres = 0;
                }

                $camion = $this->request->getPost("camion_padres", "string");
                if (isset($camion)) {
                    $AlumnosPadres->camion_padres = 1;
                } else {
                    $AlumnosPadres->camion_padres = 0;
                }

                $auto = $this->request->getPost("auto_padres", "string");
                if (isset($auto)) {
                    $AlumnosPadres->auto_padres = 1;
                } else {
                    $AlumnosPadres->auto_padres = 0;
                }

                $mototaxi = $this->request->getPost("mototaxi_padres", "string");
                if (isset($mototaxi)) {
                    $AlumnosPadres->mototaxi_padres = 1;
                } else {
                    $AlumnosPadres->mototaxi_padres = 0;
                }

                $predios = $this->request->getPost("predios_padres", "string");
                if (isset($predios)) {
                    $AlumnosPadres->predios_padres = 1;
                } else {
                    $AlumnosPadres->predios_padres = 0;
                }

                $tv = $this->request->getPost("tv_padres", "string");
                if (isset($tv)) {
                    $AlumnosPadres->tv_padres = 1;
                } else {
                    $AlumnosPadres->tv_padres = 0;
                }

                $equipo = $this->request->getPost("equipo_padres", "string");
                if (isset($equipo)) {
                    $AlumnosPadres->equipo_padres = 1;
                } else {
                    $AlumnosPadres->equipo_padres = 0;
                }

                $animales = $this->request->getPost("animales_padres", "string");
                if (isset($animales)) {
                    $AlumnosPadres->animales_padres = 1;
                } else {
                    $AlumnosPadres->animales_padres = 0;
                }

                //$AlumnosPadres->casa = $this->request->getPost("casa", "string");
                //$AlumnosPadres->camion = $this->request->getPost("camion", "string");
                //$AlumnosPadres->auto = $this->request->getPost("auto", "string");
                //$AlumnosPadres->mototaxi = $this->request->getPost("mototaxi", "string");
                //$AlumnosPadres->predios = $this->request->getPost("predios", "string");
                //$AlumnosPadres->tv = $this->request->getPost("tv", "string");
                //$AlumnosPadres->equipo = $this->request->getPost("equipo", "string");
                //$AlumnosPadres->animales = $this->request->getPost("animales", "string");

                $AlumnosPadres->estado = "A";

                if ($AlumnosPadres->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AlumnosPadres->getMessages());
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

    //Datatbles alumnos_padres
    public function datatablePadresAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("ap.codigo_padres");
            $datatable->setSelect("ap.codigo_padres, ap.alumno, p.nombres as parentesco, ap.parentesco_padres,
                     ap.nombres_padres, ap.apellido_paterno_padres, ap.apellido_materno_padres,
                     ap.edad_padres, ap.estado_civil_padres, ap.grado_instruccion_padres,
                     ap.ocupacion_padres, ap.estado, ec.nombres AS estado_civil_padres, gi.nombres AS grado_instruccion_padres");
            $datatable->setFrom("alumnos_padres ap INNER JOIN a_codigos p ON p.codigo = ap.parentesco_padres
                    INNER JOIN a_codigos ec ON ec.codigo = ap.estado_civil_padres
                    INNER JOIN a_codigos AS gi ON gi.codigo = ap.grado_instruccion_padres");
            $datatable->setWhere("ap.estado = 'A' AND alumno = '$id' AND p.numero = 27 AND ec.numero = 26 AND gi.numero = 28");
            $datatable->setOrderby("ap.codigo_padres ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Editar alumnnos_padres
    public function getAjaxPadresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AlumnosPadres::findFirstBycodigo_padres((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //Eliminar Padre
    public function eliminarPadreAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AlumnosPadres::findFirstBycodigo_padres((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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

}
