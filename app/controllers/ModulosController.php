<?php

class ModulosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        //$modulos = Modulo::find("estado = 'A' AND mod_idmodpadre = 0 ");
        $modulos = Modulo::find(
                        [
                            "estado = 'A' AND mod_idmodpadre = 0 ",
                            'order' => 'mod_descripcion ASC',
                        ]
        );
        $this->view->modulos = $modulos;
        $this->assets->addJs("adminpanel/js/modulos/modulos.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id", "int");
                $Modulo = Modulo::findFirstByid($id);
                $Modulo = (!$Modulo) ? new Modulo() : $Modulo;
                $Modulo->mod_descripcion = strtoupper($this->request->getPost("mod_descripcion", "string"));
                $Modulo->mod_url = $this->request->getPost("mod_url", "string");
                $Modulo->mod_idmodpadre = $this->request->getPost("mod_idmodpadre", "int");
                $Modulo->mod_icono = $this->request->getPost("mod_icono", "string");
                $Modulo->mod_orden = $this->request->getPost("mod_orden", "int");
                $Modulo->estado = "A";

                if ($Modulo->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Modulo->getMessages());
                } else {
                    if ($this->request->getPost("id") == "") {


                        $perfiles = Perfil::find("estado = 'A'");

                        foreach ($perfiles as $p) {
                            $perm = new Permiso();
                            $perm->modulo_id = $Modulo->id;
                            $perm->perfil_id = $p->id;
                            $perm->estado = "X";
                            $perm->save();
                        }
                    }

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
            $Modulo = Modulo::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Modulo) {
                $this->response->setJsonContent($Modulo->toArray());
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
            $Modulo = Modulo::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Modulo && $Modulo->estado = 'A') {
                $Modulo->estado = 'X';
                $Modulo->save();
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
            $datatable->setColumnaId('id');
            $datatable->setSelect('id,mod_descripcion,mod_url,estado,mod_orden');
            $datatable->setFrom('tbl_seg_modulos');
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("mod_descripcion ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
