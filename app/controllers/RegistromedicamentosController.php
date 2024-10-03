<?php

class RegistromedicamentosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/registromedicamentos.js?v=" . uniqid());

        $concentraciones = Concentraciones::find("estado = 'A' AND numero = 124");
        $this->view->concentraciones = $concentraciones;

        $formas = Formas::find("estado = 'A' AND numero = 123");
        $this->view->formas = $formas;
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_medicamento");
            $datatable->setSelect("id_medicamento, descripcion,concentracion, forma, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_medicamentos.id_medicamento,
            public.tbl_dss_medicamentos.descripcion,
            public.tbl_dss_medicamentos.id_concentracion,
            public.tbl_dss_medicamentos.id_forma,
            concentraciones.nombres AS concentracion,
            formas.nombres AS forma,
            public.tbl_dss_medicamentos.estado
            FROM
            public.tbl_dss_medicamentos
            INNER JOIN public.a_codigos AS concentraciones ON concentraciones.codigo = public.tbl_dss_medicamentos.id_concentracion
            INNER JOIN public.a_codigos AS formas ON public.tbl_dss_medicamentos.id_forma = formas.codigo
            WHERE
            concentraciones.numero = 124 AND
            formas.numero = 123) AS temporal_table");
            $datatable->setOrderby("id_medicamento ASC");
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
