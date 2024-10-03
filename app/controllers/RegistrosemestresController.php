<?php

class RegistrosemestresController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrosemestres.js?v=" . uniqid());
    }

    public function indexAction() {

        //Region para ubigeo
        //$semestres = Semestres::find("estado = 'A'");

        $semestres = Semestres::find(
                        [
                            "estado <> 'X'",
                            'order' => 'codigo DESC'
                        ]
        );
        $this->view->semestres = $semestres;


        $semestres_parametros = Semestres::count(
                        [
                            "activo = 'M' OR activo ='P'"
                        ]
        );

        //echo '<pre>';
        //print_r($semestres_parametros);
        //exit();
        $this->view->codigo_parametro = $semestres_parametros;

        $semestre_m = Semestres::findFirst("activo = 'M'");

        //echo '<pre>';
        //print_r("Semestre M:" . $semestre_m->descripcion);
        //exit();

        $this->view->semestre_m = $semestre_m->codigo;

        $this->view->asignaturas = $semestre_m->asignaturas;

        $semestre_p = Semestres::findFirst("activo = 'P'");

        //echo '<pre>';
        //print_r("Semestre P:" . $semestre_p->descripcion);
        //exit();

        $this->view->semestre_p = $semestre_p->codigo;
    }

    public function saveAction() {

    //    echo '<pre>';
    //    print_r($_POST);
    //    exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");

                if ($id === 0) {
                    $id_nuevo = Semestres::count();
                    $Semestre = Semestres::findFirstByCodigo($id_nuevo);
                } else {
                    $Semestre = Semestres::findFirstByCodigo($id);
                }

                $Semestre = (!$Semestre) ? new Semestres() : $Semestre;



                if ($id === 0) {
                    $Semestre->codigo = $id_nuevo;
                } else {
                    $Semestre->codigo = $id;
                }

                $Semestre->descripcion = $this->request->getPost("descripcion", "string");
                $Semestre->definicion = $this->request->getPost("definicion", "string");
                $Semestre->semestre = $this->request->getPost("semestre", "string");
                $Semestre->anio = $this->request->getPost("anio", "string");




                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_inicio", "string");
                    $Semestre->fecha_inicio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                //fecha fin
                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_fin", "string");
                    $Semestre->fecha_fin = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }



                if ($this->request->getPost("fecha_inicio_notas1", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio_notas1", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_inicio_notas1", "string");
                    $Semestre->fecha_inicio_notas1 = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                if ($this->request->getPost("fecha_fin_notas1", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin_notas1", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_fin_notas1", "string");
                    $Semestre->fecha_fin_notas1 = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                if ($this->request->getPost("fecha_inicio_notas2", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio_notas2", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_inicio_notas2", "string");
                    $Semestre->fecha_inicio_notas2 = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                if ($this->request->getPost("fecha_fin_notas2", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin_notas2", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora_fin_notas2 = $this->request->getPost("hora_fin_notas2", "string");
                    $Semestre->fecha_fin_notas2 = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_fin_notas2));
                }

                if ($this->request->getPost("fecha_inicio_sustitutorio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio_sustitutorio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora_inicio_sustitutorio = $this->request->getPost("hora_inicio_sustitutorio", "string");
                    $Semestre->fecha_inicio_sustitutorio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_inicio_sustitutorio));
                }

                if ($this->request->getPost("fecha_fin_sustitutorio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin_sustitutorio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora_fin_sustitutorio = $this->request->getPost("hora_fin_sustitutorio", "string");
                    $Semestre->fecha_fin_sustitutorio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_fin_sustitutorio));
                }

                //
                if ($this->request->getPost("fecha_inicio_matricula", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio_matricula", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $currentTime = date("H:i:s");

                    $hora_inicio_matricula = $this->request->getPost("hora_inicio_matricula", "string");
                    $Semestre->fecha_inicio_matricula = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_inicio_matricula));
                }

                if ($this->request->getPost("fecha_fin_matricula", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin_matricula", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $currentTime = date("H:i:s");

                    $hora_inicio_matricula = $this->request->getPost("hora_fin_matricula", "string");
                    $Semestre->fecha_fin_matricula = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_inicio_matricula));
                }



                $Semestre->observacion = $this->request->getPost("observacion", "string");
                $Semestre->estado = "A";
                //$Semestre->activo = "";

                if ($this->request->getPost("fecha_inicio_matricula_ex", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio_matricula_ex", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $currentTime = date("H:i:s");

                    //$hora_fecha_inicio_matricula_ex = $this->request->getPost("hora_fecha_inicio_matricula_ex", "string") . ":00";
                    
                    //print($hora_fecha_inicio_matricula_ex);
                    //exit();
                    
                    //$Semestre->fecha_inicio_matricula_ex = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_fecha_inicio_matricula_ex));
                    $Semestre->fecha_inicio_matricula_ex = date("Y-m-d", strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin_matricula_ex", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin_matricula_ex", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $currentTime = date("H:i:s");

                    //$hora_fecha_fin_matricula_ex = $this->request->getPost("hora_fecha_fin_matricula_ex", "string") . ":00";
                    //$Semestre->fecha_fin_matricula_ex = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_fecha_fin_matricula_ex));
                    $Semestre->fecha_fin_matricula_ex = date("Y-m-d", strtotime($fecha_new));
                }




                if ($Semestre->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Semestre->getMessages());
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

    //save paramatros


    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Semestre = Semestres::findFirstByCodigo((int) $this->request->getPost("id", "int"));
            if ($Semestre) {
                $this->response->setJsonContent($Semestre->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Semestre = Semestres::findFirstByCodigo((int) $this->request->getPost("id", "int"));
            if ($Semestre && $Semestre->estado = 'A') {
                $Semestre->estado = 'X';
                $Semestre->save();
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

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, descripcion, definicion, semestre, anio, fecha_inicio, fecha_fin, observacion, activo, estado");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("semestres");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("estado = 'A' OR estado = 'I' OR estado = 'A' ");
            $datatable->setOrderBy("codigo desc");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //save parametros
    public function save_parametrosAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $robots = Semestres::find();

                // Manipulating a resultset of complete objects
                foreach ($robots as $robot) {
                    $robot->activo = '';
                    $robot->save();
                }


                $semestre_matricula = (int) $this->request->getPost("semestre_matricula", "int");
                $semestre_anterior = (int) $this->request->getPost("semestre_anterior", "int");




                if ($semestre_matricula) {
                    $semestre_m = Semestres::findFirstBycodigo($semestre_matricula);
                    $semestre_m = (!$semestre_m) ? new Semestres() : $semestre_m;

                    $semestre_m->activo = 'M';
                    $semestre_m->estado = "A";

                    //$semestre_m->asignatura_estado = null;
                    //echo "<pre>";
                    //print_r("Testing1");
                    //exit();

                    if ($semestre_m->save() == false) {
                        // Cuando hay error
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent($semestre_m->getMessages());
                    } else {
                        //Cuando va bien 
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    }
                }

                if ($semestre_anterior) {
                    $semestre_p = Semestres::findFirstBycodigo($semestre_anterior);
                    $semestre_p = (!$semestre_p) ? new Semestres() : $semestre_p;

                    $semestre_p->activo = 'P';
                    $semestre_p->estado = "A";

                    //echo "<pre>";
                    //print_r("Testing1");
                    //exit();

                    if ($semestre_p->save() == false) {
                        // Cuando hay error
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent($semestre_p->getMessages());
                    } else {
                        //Cuando va bien 
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    }
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

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $semestres = Semestres::findFirstBycodigo((int) $id);
        } else {

            $semestres_nuevo = Semestres::count();

            //print($semestres_nuevo); exit();

            $semestres->codigo = $semestres_nuevo + 1;
            $this->view->semestres = $semestres;
        }

        $this->view->semestres = $semestres;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
    }

}
