<?php

class PersonasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('Mantenimiento de Personas');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/personas.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id", "int");
                $Persona = Persona::findFirstByid($id);
                $Persona = (!$Persona) ? new Persona() : $Persona;
                $Persona->nombre = strtoupper($this->request->getPost("nombre", "string"));
                $Persona->email = $this->request->getPost("email", "string");
                $Persona->telefono = $this->request->getPost("telefono", "string");
                $Persona->estado = "A";

                if ($Persona->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Persona->getMessages());
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
            $Persona = Persona::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Persona) {
                $this->response->setJsonContent($Persona->toArray());
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
            $Persona = Persona::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Persona && $Persona->estado = 'A') {
                $Persona->estado = 'X';
                $Persona->save();
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
            $datatable->setColumnaId("id");
            $datatable->setSelect("id,nombre,email,telefono,estado");
            $datatable->setFrom("personas");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
