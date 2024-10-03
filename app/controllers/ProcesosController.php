<?php

class ProcesosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("js/jquery.jstree.js?v=66556");


        $this->assets->addJs("adminpanel/js/modulos/procesos.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id", "int");
                $Proceso = Proceso::findFirstByid($id);
                $Proceso = (!$Proceso) ? new Proceso() : $Proceso;
                $Proceso->proceso = strtoupper($this->request->getPost("proceso", "string"));
                $Proceso->descripcion = strtoupper($this->request->getPost("descripcion", "string"));
                $Proceso->fechareg = date("Y-m-d H:i:s");
                $Proceso->estado = "A";

                if ($Proceso->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Proceso->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->getPost("id") == "") {
                        $usuarios = Usuario::find("estado = 'A'");

                        foreach ($usuarios as $u) {
                            $perm = new Procesousuario();
                            $perm->usuario_id = $u->id;
                            $perm->proceso_id = $Proceso->id;
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
            $Proceso = Proceso::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Proceso) {
                $this->response->setJsonContent($Proceso->toArray());
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
            $Proceso = Proceso::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Proceso && $Proceso->estado = 'A') {
                $Proceso->estado = 'X';
                $Proceso->save();
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
            $datatable->setSelect("id,descripcion,proceso");
            $datatable->setFrom("tbl_seg_procesos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getPermisosAction() {
        
        error_reporting(0);
        $this->view->disable();
        if ($this->request->isGet() && $this->request->isAjax()) {
            $usuario_id = (int) $this->request->getQuery('usuario_id', 'int');
            //print $usuario_id;exit();
            $permisos = array();
            $PerfilModulo = Procesousuario::find("usuario_id = {$usuario_id} AND estado = 'A'  ");
            $PerfilModulo = $PerfilModulo->toArray();
            $ModulosPermitidos = array_column($PerfilModulo, 'proceso_id');
            //print_r($ModulosPermitidos);exit();
            //$ModulosPadre = Modulo::find(array("estado = 'A' AND mod_idmodpadre = 0 ", "order" => "mod_orden"));
            $Procesospermitidos = Proceso::find("estado='A'");
           // $value = array();

            foreach ($Procesospermitidos as $permitido) {
                        $value->data = $permitido->descripcion;
                        $value->attr->id = $permitido->id;
                        
                        //print $hijo->estado."<br>";
                        if (in_array($permitido->id, $ModulosPermitidos))
                            $value->attr->class = "jstree-checked";
                        else
                            $value->attr->class = "jstree-unchecked";

                        //$datoshijos[] = $valueh;

                        $permisos[] = $value;
                        $value = null;

                        //$valueh = null;
            }
            /*
            foreach ($ModulosPadre as $ModuloPadre) {
                $ModulosHijo = Modulo::find(array("estado = 'A' AND mod_idmodpadre = {$ModuloPadre->id}  ", "order" => "mod_orden"));
                $numHijos = $ModulosHijo->count();   
                
                $value->data = $ModuloPadre->mod_descripcion;
                $value->attr->id = $ModuloPadre->id;

                if ($numHijos > 0) {
                    $value->state = "closed";

                    $datoshijos = array();
                    foreach ($ModulosHijo as $hijo) {
                        $valueh->data = $hijo->mod_descripcion;
                        $valueh->attr->id = $hijo->id;
                        
                        //print $hijo->estado."<br>";
                        if (in_array($hijo->id, $ModulosPermitidos))
                            $valueh->attr->class = "jstree-checked";
                        else
                            $valueh->attr->class = "jstree-unchecked";

                        $datoshijos[] = $valueh;

                        $valueh = null;
                    }
                    //exit();
                    $value->children = $datoshijos;
                }else {
                    if (in_array($hijo->id, $ModulosPermitidos)) {
                        $value->attr->class = "jstree-checked";
                    }
                }
                    $permisos[] = $value;
                    $value = null;
            }*/

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent($permisos);
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function actualizarPermisosAction(){
       
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            $modulos_perfiles = $this->request->getPost('permisos');
           // echo '<pre>';
            //print_r($modulos_perfiles);
            //exit();
            
            foreach ($modulos_perfiles as $value) {
                  $permiso = Procesousuario::findFirst("proceso_id = {$value['idm']}  AND usuario_id = {$value['idp']} ");
                  //echo "<pre>";print_r($permiso->proceso_id);exit();
                  $permiso->estado = $value['val'];
                  $permiso->update();
            }
            //exit();
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say"=>"yes"));
            
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();    
    }


    public function getPermisivosAction(){
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
           
            $id = $auth["usuario_id"];
            //$id = 19;
            $permisos = array();
            //$PerfilModulo = Procesousuario::find("usuario_id = {$id} AND estado = 'X'  ");
            //$PerfilModulo = $PerfilModulo->toArray();
            //$ModulosPermitidos = array_column($PerfilModulo, 'proceso_id');
            //print_r($ModulosPermitidos);exit();
            //$ModulosPadre = Modulo::find(array("estado = 'A' AND mod_idmodpadre = 0 ", "order" => "mod_orden"));
            $Procesospermitidos = Proceso::find("estado='A'");
           // $value = array();

            foreach ($Procesospermitidos as $permitido) {
                if (in_array($permitido->id, $ModulosPermitidos)){

                    $permisos[] = $permitido->proceso;
                 }
            }

            if ($permisos) {
                $this->response->setJsonContent($permisos);
                $this->response->send();
            } else {
                $this->response->setJsonContent($permisos);
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }   
}
