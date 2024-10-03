<?php

class AdmisionController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //web

    public function indexAction() {
        //Region para ubigeo
        //$semestres = Semestres::find("estado = 'A'");

        $admision = Admision::find(
                        [
                            "estado <> 'X'",
                            'order' => 'codigo DESC'
                        ]
        );
        $this->view->admision = $admision;


        $admision_parametros = Admision::count(
                        [
                            "activo = 'M' OR activo ='P'"
                        ]
        );

        //echo '<pre>';
        //print_r($semestres_parametros);
        //exit();
        $this->view->codigo_parametro = $admision_parametros;

        $admision_m = Admision::findFirst("activo = 'M'");

//        echo '<pre>';
//        print_r("Semestre M:" . $admision_m->descripcion);
//        exit();

        $this->view->admision_m = $admision_m->codigo;

        //$this->view->asignaturas = $semestre_m->asignaturas;

        $admision_p = Admision::findFirst("activo = 'P'");

//        echo '<pre>';
//        print_r("Semestre P:" . $admision_p->descripcion);
//        exit();

        $this->view->admision_p = $admision_p->codigo;


        $this->assets->addJs("adminpanel/js/modulos/admision.js?v=" . uniqid());
    }

    
      public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("admi.codigo");
            $datatable->setSelect("admi.codigo, admi.descripcion, admi.semestre, "
                    . "admi.anio, admi.fecha_hora_ordinario, "
                    . "admi.fecha_hora_extraordinario, admi.lugar_ordinario, "
                    . "admi.lugar_extraordinario, admi.observacion, "
                    . "admi.imagen, admi.archivo, admi.activo, admi.estado, "
                    . "semes.descripcion as nombre_semestre");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("admision admi INNER JOIN semestres semes ON admi.semestre = semes.codigo");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("estado = 'A' OR estado = 'I' OR estado = 'A' ");
            $datatable->setOrderBy("admi.codigo desc");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $admision = Admision::findFirstBycodigo((int) $id);
        } else {

            $admision_nuevo = Admision::count();

            //print($admision_nuevo); exit();

            $admision->codigo = $admision_nuevo + 1;
            $this->view->admision = $admision;
        }

        $this->view->admision = $admision;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        //Modelo Semestre (a_codigos)
        $semestres = Semestres::find("estado <> 'X'");
        $this->view->semestres = $semestres;

        $this->assets->addJs("adminpanel/js/modulos/admision.js?v=" . uniqid());
    }

    public function saveAction() {

//        echo '<pre>';
//        print_r($_POST);
//        exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");

                if ($id === 0) {
                    $id_nuevo = Admision::count();
                    $Admision = Admision::findFirstByCodigo($id_nuevo);
                } else {
                    $Admision = Admision::findFirstByCodigo($id);
                }

                $Admision = (!$Admision) ? new Admision() : $Admision;



                if ($id === 0) {
                    $Admision->codigo = $id_nuevo;
                } else {
                    $Admision->codigo = $id;
                }

                $Admision->descripcion = $this->request->getPost("descripcion", "string");
                $Admision->semestre = $this->request->getPost("semestre", "string");
                $Admision->anio = $this->request->getPost("anio", "string");



                
                if ($this->request->getPost("fecha_hora_ordinario", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_ordinario", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora_inicio = $this->request->getPost("hora_ordinario", "string") ;
                    $Admision->fecha_hora_ordinario = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_inicio));
                }

                //fecha fin
                if ($this->request->getPost("fecha_hora_extraordinario", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_extraordinario", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora_fin = $this->request->getPost("hora_extraordinario", "string");
                    $Admision->fecha_hora_extraordinario = date("Y-m-d H:i:s", strtotime($fecha_new . $hora_fin));
                }

                $Admision->lugar_ordinario = $this->request->getPost("lugar_ordinario", "string");
                $Admision->lugar_extraordinario = $this->request->getPost("lugar_extraordinario", "string");
                $Admision->observacion = $this->request->getPost("observacion", "string");
                $estado = $this->request->getPost("estado_input", "string");
                $Admision->estado = $estado=="true"?"A":"X";
                //$Admision->activo = "";

                if ($Admision->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Admision->getMessages());
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

    public function inscritosAction() {
        $this->assets->addJs("adminpanel/js/modulos/admision.inscritos.js?v=" . uniqid());
    }

    public function datatableInscritosAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("postulante");
            $datatable->setSelect("admin.postulante,admin.modalidad,admin.fecha_inscripcion,admin.tipo_inscripcion, "
                    . "admin.recibo, admin.concepto, admin.fecha_registro, admin.fecha_modificacion, admin.monto, admin.estado, "
                    . "admin.puesto, admin.puntaje, admin.modalidad_ingreso, admin.imagen, admin.carrera1, admin.carrera2,"
                    . "p.apellidop, p.apellidom, p.nombres,p.colegio_publico, p.colegio_nombre, p.nro_doc");
            $datatable->setFrom("admision_postulantes admin INNER JOIN publico p ON admin.postulante = p.codigo"); //$datatable->setFrom("colegiados");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("c.estado = 'A'");
            $datatable->setOrderby("postulante ASC");
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

                $robots = Admision::find();

                // Manipulating a resultset of complete objects
                foreach ($robots as $robot) {
                    $robot->activo = '';
                    $robot->save();
                }


                $admision_actual = (int) $this->request->getPost("admision_actual", "int");
                $admision_anterior = (int) $this->request->getPost("admision_anterior", "int");




                if ($admision_actual) {
                    $admision_m = Admision::findFirstBycodigo($admision_actual);
                    $admision_m = (!$admision_m) ? new Admision() : $admision_m;

                    $admision_m->activo = 'M';
                    $admision_m->estado = "A";

                    //$semestre_m->asignatura_estado = null;
                    //echo "<pre>";
                    //print_r("Testing1");
                    //exit();

                    if ($admision_m->save() == false) {
                        // Cuando hay error
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent($admision_m->getMessages());
                    } else {
                        //Cuando va bien 
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    }
                }

                if ($admision_anterior) {
                    $admision_p = Admision::findFirstBycodigo($admision_anterior);
                    $admision_p = (!$admision_p) ? new Admision() : $admision_p;

                    $admision_p->activo = 'P';
                    $admision_p->estado = "A";

                    //echo "<pre>";
                    //print_r("Testing1");
                    //exit();

                    if ($admision_p->save() == false) {
                        // Cuando hay error
                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent($admision_p->getMessages());
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

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Admision = Admision::findFirstByCodigo((int) $this->request->getPost("id", "int"));
            if ($Admision && $Admision->estado = 'A') {
                $Admision->estado = 'X';
                $Admision->save();
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
