<?php

class UsuariosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        //$perfiles = Perfil::find("estado = 'A'");
        $perfiles = Perfil::find(
                        [
                            "estado = 'A'",
                            'order' => 'per_descripcion ASC',
                        ]
        );
        $this->view->perfiles = $perfiles;

        $this->assets->addJs("js/jquery.jstree.js?" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/usuarios.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id", "int");
                $Usuario = Usuario::findFirstByid($id);
                $Usuario = (!$Usuario) ? new Usuario() : $Usuario;
                $Usuario->usu_nombre = strtoupper($this->request->getPost("usu_nombre", "string"));
                $Usuario->usu_usuario = $this->request->getPost("usu_usuario", "string");

                if ($id == "") {

                    $text = $this->request->getPost("usu_clave");
                    $Usuario->usu_clave = $this->security->hash($text);
                } else {

                    $text = $this->request->getPost("usu_clave");

                    $dex_pass = Usuario::findFirstByid($id);
                    $dex_pass = $dex_pass->usu_clave;

                    if ($text == $dex_pass) {
                        // The password is valid
                        $Usuario->usu_clave = $this->security->hash($text);
                    } else {
                        $Usuario->usu_clave = $this->security->hash($text);
                    }
                }

                $Usuario->perfil_id = $this->request->getPost("perfil_id", "int");
                $Usuario->estado = "A";
                $Usuario->usu_fecha = date('Y-m-d H:i:s');

                if ($Usuario->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Usuario->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->getPost("id") == "") {
                        $procesos = Proceso::find("estado = 'A'");

                        foreach ($procesos as $p) {
                            $perm = new Procesousuario();
                            $perm->proceso_id = $p->id;
                            $perm->usuario_id = $Usuario->id;
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
            $Usuario = Usuario::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Usuario) {
                $this->response->setJsonContent($Usuario->toArray());
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
            $Usuario = Usuario::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Usuario && $Usuario->estado = 'A') {
                $Usuario->estado = 'X';
                $Usuario->save();
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
            $datatable->setColumnaId("u.id");
            $datatable->setSelect("u.id, u.usu_nombre, u.usu_usuario, p.per_descripcion as perfil");
            $datatable->setFrom("tbl_seg_usuarios u INNER JOIN tbl_seg_perfiles p ON u.perfil_id = p.id");
            $datatable->setWhere("u.estado = 'A'");
            $datatable->setOrderby("u.usu_nombre,u.usu_usuario,p.per_descripcion ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
