<?php
class RegistroprovidenciasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/registroprovidencias.js?v=" . uniqid());
    }

    public function detalleAction($id) {
        $providencias = FscProvidencias::findFirstByid_providencia($id);
        $this->view->id_providencia = $providencias->id_providencia;
        $this->assets->addJs("adminpanel/js/modulos/registroprovidencias.detalle.js?v=" . uniqid());
    }

    public function saveAction() {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_providencia", "int");
                $model = FscProvidencias::findFirstByid_providencia($id);
                $model = (!$model) ? new FscProvidencias() : $model;

                $model->descripcion = $this->request->getPost("descripcion", "string");
                $estado = $this->request->getPost("estado", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = FscProvidencias::findFirstByid_providencia((int) $this->request->getPost("id_providencia", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
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
            $model = FscProvidencias::findFirstByid_providencia((int) $this->request->getPost("id_providencia", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_providencia");
            $datatable->setSelect("id_providencia, descripcion, estado");
            $datatable->setFrom("tbl_fsc_providencias");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("descripcion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function datatableDetalleAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_providencia_detalle");
            $datatable->setSelect("id_providencia_detalle,id_providencia, descripcion, estado");
            $datatable->setFrom("tbl_fsc_providencias_detalles");
            $datatable->setWhere("id_providencia = $id");
            $datatable->setOrderby("descripcion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function getAjaxDetalleAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = FscProvidenciasDetalles::findFirstByid_providencia_detalle((int) $this->request->getPost("id_providencia_detalle", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarDetalleAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = FscProvidenciasDetalles::findFirstByid_providencia_detalle((int) $this->request->getPost("id_providencia_detalle", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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
