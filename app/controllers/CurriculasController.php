<?php

class CurriculasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $curriculas = Carreras::find("estado = 'A'");
        $this->view->carreras = $curriculas;


        $this->assets->addJs("adminpanel/js/modulos/curriculas.js?v=" . uniqid());
    }

    //Datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("cu.codigo");
            $datatable->setSelect("cu.codigo, cu.descripcion, cu.fecha_inicio, cu.fecha_fin, cu.abreviatura, carr.descripcion AS carrera, cu.estado");
            $datatable->setFrom("curriculas cu INNER JOIN carreras as carr ON cu.carrera = carr.codigo");
            //$datatable->setWhere("cu.estado = 'A'");
            $datatable->setOrderBy("cu.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Editar
    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $curricula = Curriculas::findFirstBycodigo((string) $this->request->getPost("id", "string"));

            if ($curricula) {
                $this->response->setJsonContent($curricula->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //Guardar
    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "string");
                $curricula = Curriculas::findFirstBycodigo($id);
                $curricula = (!$curricula) ? new Curriculas() : $curricula;
                //$curricula->codigo = strtoupper($this->request->getPost("codigo", "string"));
                $curricula->descripcion = $this->request->getPost("descripcion", "string");



                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("-", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $curricula->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }


                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("-", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $curricula->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }


                $curricula->abreviatura = $this->request->getPost("abreviatura", "string");
                $curricula->carrera = $this->request->getPost("carrera", "string");


                $curricula->estado = "A";

                if ($curricula->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($curricula->getMessages());
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

    //delete
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $curricula = Curriculas::findFirstBycodigo((string) $this->request->getPost("id", "string"));
            if ($curricula && $curricula->estado = 'A') {
                $curricula->estado = 'X';
                $curricula->save();
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
