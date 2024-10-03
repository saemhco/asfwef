<?php

class PerfilesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("js/jquery.jstree.js?v=66556");


        $this->assets->addJs("adminpanel/js/modulos/perfiles.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id", "int");
                $Perfil = Perfil::findFirstByid($id);
                $Perfil = (!$Perfil) ? new Perfil() : $Perfil;
                $Perfil->per_descripcion = strtoupper($this->request->getPost("per_descripcion", "string"));
                $Perfil->alias = $this->request->getPost("alias", "string");
                $Perfil->estado = "A";

                if ($Perfil->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Perfil->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->getPost("id") == "") {
                        $modulos = Modulo::find("estado = 'A'");

                        foreach ($modulos as $m) {
                            $perm = new Permiso();
                            $perm->modulo_id = $m->id;
                            $perm->perfil_id = $Perfil->id;
                            $perm->estado = "X";
                            $perm->save();
                        }
                    }
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
            $Perfil = Perfil::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Perfil) {
                $this->response->setJsonContent($Perfil->toArray());
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
            $Perfil = Perfil::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Perfil && $Perfil->estado = 'A') {
                $Perfil->estado = 'X';
                $Perfil->save();
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
            $datatable->setSelect("id,per_descripcion,alias");
            $datatable->setFrom("tbl_seg_perfiles");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("per_descripcion ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
