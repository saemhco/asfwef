<?php

class Registrocie10Controller extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        //index
        $this->assets->addJs("adminpanel/js/modulos/registrocie10.js?v=" . uniqid());
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_cie10");
            $datatable->setSelect("id_cie10, descripcion,cie10,estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_cie10.id_cie10,
            public.tbl_dss_cie10.descripcion,
            public.tbl_dss_cie10.cie10,
            public.tbl_dss_cie10.estado
            FROM
            public.tbl_dss_cie10) AS temporal_table");
            $datatable->setOrderby("descripcion ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Cie10::findFirstByid_cie10((string) $this->request->getPost("id", "string"));

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
                $id = (int) $this->request->getPost("id_cie10", "string");
                $model = Cie10::findFirstByid_cie10((int)$id);
                $model = (!$model) ? new Cie10() : $model;

                $model->descripcion = $this->request->getPost("descripcion", "string");
                $model->cie10 = $this->request->getPost("cie10", "string");
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
            $model = Cie10::findFirstByid_cie10((string) $this->request->getPost("id", "string"));
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
