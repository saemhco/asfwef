<?php

class GestionasistenciasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //Aca insertamos un comentario para subir
    public function indexAction($sem, $asignatura, $grupo, $subgrupo) {
//        echo '<pre>';
//        print_r($sem);
//        exit();
        $semestre_a = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $this->view->semestrea = $semestre_a->codigo;


        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
        $this->view->asignatura = $asignatura;
        //grupo
        $this->view->grupo = $grupo;

        //subgrupo
        $this->view->subgrupo = $subgrupo;

        $this->assets->addJs("adminpanel/js/modulos/gestionasistencias.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction($semestre, $asignatura, $grupo, $subgrupo) {


        //print($semestre . "*" . $asignatura . "*" . $grupo . "*" . $subgrupo);
        //exit();


        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, fecha, tema, observaciones, estado");
            $datatable->setFrom("asistencias_semestre");
            //$datatable->setWhere("(asis.estado = '0' OR asis.estado = '1') AND asis.esanulado <> 1 AND asis.semestre ={$semestre} AND asis.asignatura = '{$asigatura}'");
            $datatable->setWhere("semestre ={$semestre} AND asignatura = '{$asignatura}' AND grupo={$grupo} AND subgrupo={$subgrupo}");
            $datatable->setOrderby("codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function asistenciasAction($sem, $id, $grupo, $subgrupo, $idx = NULL) {

        //Valida registro de asistencia
        if ($idx != null) {
            $AsistenciasSemestre = AsistenciasSemestre::findFirstBycodigo((int) $idx);

            //Lista la vista de asistencias para editar
            $vista_asistencias = Vistaasistencias::find(
                            [
                                "asistencia = '{$idx}' AND semestre='{$sem}'  ",
                                'order' => 'apellidos ASC',
                            ]
            );
            $this->view->vista_asistencias = $vista_asistencias;
            $this->view->asistencias = $AsistenciasSemestre;

            //AlumnosAsistencia
            $AlumnosAsistencia = AlumnosAsistencias::findFirst(
                            [
                                "asistencia = '{$idx}'",
                            ]
            );
            $this->view->alumnos_asistencias = $AlumnosAsistencia;
        } else {
            //Entra aqui para grabar una asistencia nueva
            $AsistenciasSemestre = AsistenciasSemestre::count();

            //print($AsistenciasSemestre+1);
            //exit();

            $codigo = $AsistenciasSemestre + 1;

            //print($codigo);
            //exit();

            $this->view->codigo_count = $codigo;

            $this->view->asistencias = $AsistenciasSemestre;
        }





        $this->session->set('hora', [
            'hora_entrada' => $hora = date("H:i:s")
        ]);



//        echo "<pre>";
//        print_r($_SESSION["hora"]["hora_entrada"]);
//        exit();



        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M' and codigo = {$sem} ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $asignatura = "";
        if ($id != null) {
            $asignatura = Asignaturas::findFirstBycodigo((string) $id);
        }



        //$vista_notas  = Vistanotas::find("semestre = '{$sem}' AND asignatura='{$id}' ");
        $VAsistenciaDetalles = VAsistenciaDetalles::find(
                        [
                            "semestre = '{$sem}' AND asignatura='{$id}' AND grupo = {$grupo} AND subgrupo = {$subgrupo}  ",
                            'order' => 'apellidos ASC',
                        ]
        );

        //grupo y subgrupo
        $AlumnosAsignaturasDetalle = AlumnosAsignaturasDetalle::findFirst(
                        [
                            "semestre = '{$sem}' AND asignatura='{$id}' AND grupo = {$grupo} AND subgrupo = {$subgrupo}  ",
                        ]
        );

        $programa = Curriculas::findFirst(
                        [
                            "codigo = '{$asignatura->curricula}'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );


        $this->view->asignatura = $asignatura;
        $this->view->semestre = $semestre;
        $this->view->programa = $programa;
        $this->view->lista_alumnos = $VAsistenciaDetalles;
        $this->view->grupo = $AlumnosAsignaturasDetalle->grupo;
        $this->view->subgrupo = $AlumnosAsignaturasDetalle->subgrupo;





        $this->view->hora_entrada = $_SESSION["hora"]["hora_entrada"];




        //Modelo seguro(a_codigos)
        $entradas = Entradas::find("numero = 33 AND estado = 'A'");
        $this->view->entradas = $entradas;


        $tipoasistencias = TipoAsistencias::find("numero = 34 AND estado = 'A'");
        $this->view->tipoasistencias = $tipoasistencias;

        //total de estudiantes
        $total_estudiantes = VAsistenciaDetalles::find(
                        [
                            "semestre = '{$sem}' AND asignatura='{$id}' AND grupo = {$grupo} AND subgrupo = {$subgrupo}  ",
                            'order' => 'apellidos ASC',
                        ]
        );
        $this->view->total_estudiantes = count($total_estudiantes);



        $this->assets->addJs("adminpanel/js/modulos/gestionasistencias.asistencias.js?v=" . uniqid());
    }

    //Funcion para guardar asistenecia
    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //echo "<pre>";
                //print_r($_POST);
                //exit();

                $id = (int) $this->request->getPost("codigo", "int");
                $AsistenciasSemestre = AsistenciasSemestre::findFirstBycodigo($id);
                $AsistenciasSemestre = (!$AsistenciasSemestre) ? new AsistenciasSemestre() : $AsistenciasSemestre;

                $AsistenciasSemestre->codigo = $this->request->getPost("codigo", "int");
                $AsistenciasSemestre->semestre = $this->request->getPost("semestre", "string");
                $AsistenciasSemestre->asignatura = $this->request->getPost("asignatura", "string");
                $AsistenciasSemestre->grupo = $this->request->getPost("grupo", "int");
                $AsistenciasSemestre->subgrupo = $this->request->getPost("subgrupo", "int");
                $AsistenciasSemestre->docente = $this->session->get("auth")["codigo"];
                //fecha
                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora", "string") . ":00";
                    $AsistenciasSemestre->fecha = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }
                $AsistenciasSemestre->fecha_real = date('Y-m-d H:i:s');
                $AsistenciasSemestre->tema = $this->request->getPost("tema", "string");
                $AsistenciasSemestre->tipo = $this->request->getPost("tipo", "string");
                $AsistenciasSemestre->observaciones = $this->request->getPost("asistencias_semestre_observaciones", "string");


                $estado = $this->request->getPost("estado", "string");
                if ($estado == 'Abierto') {
                    $AsistenciasSemestre->estado = "1";
                }

                //echo "<pre>";
                //print_r("Wiiiiiiiiiiiiiii");
                //exit();


                if ($AsistenciasSemestre->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AsistenciasSemestre->getMessages());
                } else {

                    //echo "<pre>";
                    //print_r($AsistenciasSemestre->codigo);
                    //exit();
//                    //Cuando va bien

                    foreach ($_POST["alumno"] as $key => $val) {

                        $result = 0;
                        foreach ($_POST["asistio"] as $valueSelected) {
                            # si hay una coincidencia, definimos la variable resutlante como "S"
                            if ($val == $valueSelected) {
                                $result = 1;
                            }
                        }

                        //print($val);


                        $AlumnosAsistencias = new AlumnosAsistencias();
                        $AlumnosAsistencias->asistencia = $AsistenciasSemestre->codigo;
                        $AlumnosAsistencias->alumno = $val;
                        $pp1 = (double) $_POST["detalle"][$key];
                        //$AlumnosAsistencias->asistencia1 = $pp1;
                        $AlumnosAsistencias->asistio = $result;
                        //$AlumnosAsistencias->detalle = $result;
                        $AlumnosAsistencias->detalle = $pp1;
                        $pp2 = $_POST["observaciones"][$key];
                        $AlumnosAsistencias->observaciones = $pp2;
                        $AlumnosAsistencias->semestre = $AsistenciasSemestre->semestre;
                        $AlumnosAsistencias->estado = 'A';
                        $AlumnosAsistencias->save();
                    }
                    //exit();


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

    //Funcion para eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$AsistenciasSemestre = Asistencias::findFirstBycodigo($this->request->getPost("id", "int"));
            $AsistenciasSemestre = AsistenciasSemestre::findFirstBycodigo((int) $this->request->getPost("id", "int"));



            if ($AsistenciasSemestre && $AsistenciasSemestre->estado == "1") {

//                echo "<pre>";
//                print_r("Entro aqui");
//                exit();

                $AsistenciasSemestre->estado = "0";
                $AsistenciasSemestre->save();
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

    //Get provincias

    public function getAsignaturasAction() {

        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $semestre_id = $this->request->getPost("pk");

            //Native query
            //$Distritos = Provincias::find('region="' . $region_id . '"');


            $asignaturas_query = $this->modelsManager->createQuery("SELECT
                    da.semestre AS semestre,
                    da.asignatura as asignatura,
                    cu.abreviatura AS curricula,
                    asi.nombre AS nombre_asignatura,
                    asi.ciclo,
                    asi.ht,
                    asi.hp,
                    ta.nombres AS ta,
                    asi.creditos,
                    d_a_d.grupo,
                    d_a_d.subgrupo
            FROM
                    DocentesAsignaturas da
                    INNER JOIN Asignaturas asi ON asi.codigo = da.asignatura
                    INNER JOIN Curriculas cu ON cu.codigo = asi.curricula
                    INNER JOIN TipoAsignaturas ta ON ta.codigo = asi.tipo
                    INNER JOIN DocentesAsignaturasDetalle d_a_d ON d_a_d.semestre = da.semestre AND d_a_d.asignatura = da.asignatura AND d_a_d.grupo = da.grupo
            WHERE
                    da.semestre = $semestre_id 
                    AND da.docente = $doc_id 
                    AND ta.numero = 6 
            ORDER BY
                    da.asignatura ASC,
                    cu.descripcion ASC,
                    asi.nombre ASC");

            $asignaturas = $asignaturas_query->execute();

//            foreach ($asignaturas as $fua) {
//                echo "<pre>";
//                print_r("ASIGNATURA:" . $fua->asignatura . '-' . $fua->nombre_asignatura . ' - CICLO:' . $fua->ciclo . "- GRUPO:" . $fua->grupo . "- SUBGRUPO:" . $fua->subgrupo . ' - CURRICULA:' . $fua->curricula);
//            }
//            exit();

            $this->response->setJsonContent($asignaturas->toArray());
            $this->response->send();
        }
    }

    //Funcion confirmar
    public function confirmarAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost("codigo", "int");


            $AsistenciasSemestre = AsistenciasSemestre::findFirst("codigo = " . $codigo);
            $AsistenciasSemestre->estado = "2";
            $AsistenciasSemestre->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //Funcion valida estado cerrado
    public function getAjaxAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $AsistenciasSemestre = AsistenciasSemestre::findFirstBycodigo((int) $this->request->getPost("id", "int"));

            //$AsistenciasSemestre = Asistencias::findFirstBycodigo((string) $this->request->getPost("id", "string"));
            if ($AsistenciasSemestre) {
                $this->response->setJsonContent($AsistenciasSemestre->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

}
