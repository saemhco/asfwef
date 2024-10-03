<?php

class GestionpacientesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/gestionpacientes.js?v=" . uniqid());

    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("nro_doc");
            $datatable->setSelect("nro_doc,apellidos_nombre,estado");
            $datatable->setFrom("(SELECT distinct view_dss_pacientes.nro_doc,
            view_dss_pacientes.apellidos_nombre,
            tbl_dss_hc.estado
            FROM tbl_dss_hc INNER JOIN view_dss_pacientes ON view_dss_pacientes.nro_doc = tbl_dss_hc.nro_doc) AS temporal_table");
            $datatable->setOrderby("apellidos_nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Medicamentos::findFirstByid_medicamento((int) $this->request->getPost("id", "int"));

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

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_medicamento", "int");
                $model = Medicamentos::findFirstByid_medicamento((int)$id);
                $model = (!$model) ? new Medicamentos() : $model;

                $model->descripcion = $this->request->getPost("descripcion", "string");

                if ($this->request->getPost("id_concentracion", "int") == "") {
                    $model->id_concentracion = null;
                } else {
                    $model->id_concentracion = $this->request->getPost("id_concentracion", "int");
                }

                if ($this->request->getPost("id_forma", "int") == "") {
                    $model->id_forma = null;
                } else {
                    $model->id_forma = $this->request->getPost("id_forma", "int");
                }

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

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Medicamentos::findFirstByid_medicamento((int) $this->request->getPost("id", "int"));
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
