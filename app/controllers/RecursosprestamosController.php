<?php

class RecursosprestamosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/recursosprestamos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    public function registroAction() {

    }

    //Datatbles usuarios
    public function datatableusuariosAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, nombres, apellidop, apellidom, perfil, estado");
            $datatable->setFrom("view_lectores");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Datatables computadoras
    public function datatablerecursosAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_recurso");
            $datatable->setSelect("id_recurso, descripcion, modelo, color, serie, estado");
            $datatable->setFrom("tbl_lib_recursos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Guardar datos
    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //echo "<pre>";
                //print_r($_POST);
                //exit();

                $Prestamo_recurso = new RecursosPrestamos();
                $Prestamo_recurso->id_recurso_prestamo = $this->request->getPost("id_recurso_prestamo", "int");

                $Prestamo_recurso->codigos = $this->request->getPost("codigos", "string");


                $Prestamo_recurso->recurso = $this->request->getPost("recurso", "int");

                $recurso_codigo = $this->request->getPost("recurso", "int");



                if ($recurso_codigo !== "") {

                    $pc_reserva = Recursos::findFirstByid_recurso((int) $recurso_codigo);
                    $pc_reserva->estado = "R";
                    $pc_reserva->save();
                }


                //Computadora
                $Prestamo_recurso->descripcion = $this->request->getPost("descripcion", "string");
                $Prestamo_recurso->serie = $this->request->getPost("serie", "string");

                //Pefil
                $tipo_lector = $this->request->getPost("perfil", "int");

                if ($tipo_lector == 3) {
                    $Prestamo_recurso->alumno = 1;
                } else {
                    $Prestamo_recurso->alumno = 0;
                }

                if ($tipo_lector == 4) {
                    $Prestamo_recurso->docente = 1;
                } else {
                    $Prestamo_recurso->docente = 0;
                }

                if ($tipo_lector == 5) {
                    $Prestamo_recurso->publico = 1;
                } else {
                    $Prestamo_recurso->publico = 0;
                }


                $Prestamo_recurso->fecha_prestamo_recurso = date('Y-m-d');

                $Prestamo_recurso->hora_entrada = $this->request->getPost("hora_entrada", "string");


                $Prestamo_recurso->estado = "A";


                if ($Prestamo_recurso->save() == false) {


                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Prestamo_recurso->getMessages());
                } else {

                    //por ser un array no se pone string
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

    //Cargamos el datatable computadoras prestadas
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_recurso_prestamo");
            $datatable->setSelect("id_recurso_prestamo, apellidos_nombres, codigos, tipo_usuario, id_recurso, hora_entrada, fecha_prestamo_recurso, estado");
            $datatable->setFrom("view_prestamos_recursos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_recurso_prestamo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Ver compputadora
    public function aplicaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $prestamopc_id = (int) $this->request->getPost("codigo", "int");
            //$empleo_id = (int)$this->request->getPost("empleo_id", "int");
            //$aplica = $this->request->getPost("aplica", "string");


            $prestamopc = $this->modelsManager->createBuilder()
                    //Instanciamos al modelo "Detallealquiler"
                    ->from('RecursosPrestamos')
                    ->columns('Recursos.descripcion, Recursos.modelo, Recursos.serie')
                    //Se escribe el nombre del Modelo "Libro"
                    ->join('Recursos', 'Recursos.id_recurso = RecursosPrestamos.recurso')
                    ->where("RecursosPrestamos.id_recurso_prestamo =" . $prestamopc_id . "")
                    ->getQuery()
                    ->execute();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("recursos" => $prestamopc->toArray()));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function confirmaAction() {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost("codigo", "int");

            //echo "<pre>";
            //print_r($codigo);
            //exit();

            $Prestamo_recurso = RecursosPrestamosConfirmados::findFirst("id_recurso_prestamo = " . (int) $codigo);
            $Prestamo_recurso->hora_salida = $this->request->getPost("hora_salida", "string");
            $Prestamo_recurso->estado = "C";

            //computadoras
            //print_r($Alquiler);exit();

            $pc_reserva = Recursos::findFirstByid_recurso((int) $Prestamo_recurso->recurso);
            $pc_reserva->estado = "A";
            $pc_reserva->save();

            $Prestamo_recurso->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function getAjaxLectoresRecursosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //llega la captura del ajax mediante el parametro getPost

            $codigo = (string) $this->request->getPost("codigo", "string");
            $perfil = (int) $this->request->getPost("perfil", "int");

            //echo '<pre>';
            //print_r("Codigo:" . $codigo . ' - ' . "Perfil:" . $perfil);
            //exit();

            $Lector = LectoresRecursos::findFirst(
                            [
                                "codigo = '$codigo' AND perfil = $perfil"
                            ]
            );

            //echo '<pre>';
            //print_r($Lector->nombres);
            //exit();

            if ($Lector) {
                $this->response->setJsonContent($Lector->toArray());
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
