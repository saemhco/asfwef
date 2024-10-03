<?php

class RecursosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/recursos.js?v=" . uniqid());

        $perfil = $this->session->get('auth')["perfil"];
        $this->view->perfil = $perfil;
    }



    //Datatables recursos
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_recurso");
            $datatable->setSelect("id_recurso, descripcion, modelo, color, serie, estado");
            $datatable->setFrom("tbl_lib_recursos");
            //$datatable->setWhere("estado = 'A' OR estado = 'R' ");
            $datatable->setOrderby("id_recurso ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Guardar
    public function saveAction() {

    //    echo "<pre>";
    //    print_r($_POST);
    //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_recurso", "int");
                $Recurso = Recursos::findFirstByid_recurso($id);
                $Recurso = (!$Recurso) ? new Recursos() : $Recurso;
            
                $Recurso->descripcion = $this->request->getPost("descripcion", "string");
                $Recurso->modelo = $this->request->getPost("modelo", "string");
                $Recurso->color = $this->request->getPost("color", "string");
                $Recurso->serie = $this->request->getPost("serie", "string");

                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Recurso->estado = "A";
                } else {
                    $Recurso->estado = "X";
                }

                if ($Recurso->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Recurso->getMessages());
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

    //Editar
    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

    //    echo "<pre>";
    //    print_r($_POST);
    //    exit();

            $Recurso = Recursos::findFirstByid_recurso((int) $this->request->getPost("id", "int"));
            if ($Recurso) {
                $this->response->setJsonContent($Recurso->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Recurso = Recursos::findFirstByid_recurso((int) $this->request->getPost("id_recurso", "int"));
            if ($Recurso && $Recurso->estado = 'A') {
                $Recurso->estado = 'X';
                $Recurso->save();
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
