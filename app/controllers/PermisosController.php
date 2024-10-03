<?php

class PermisosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function getPermisosAction() {
        
        error_reporting(0);
        $this->view->disable();
        if ($this->request->isGet() && $this->request->isAjax()) {
            $per_id = (int) $this->request->getQuery('per_id', 'int');
            //print $per_id;exit();
            $permisos = array();
            $PerfilModulo = Permiso::find("perfil_id = {$per_id} AND estado = 'A'  ");
            $PerfilModulo = $PerfilModulo->toArray();
            $ModulosPermitidos = array_column($PerfilModulo, 'modulo_id');
            //print_r($ModulosPermitidos);exit();
            $ModulosPadre = Modulo::find(array("estado = 'A' AND mod_idmodpadre = 0 ", "order" => "mod_orden"));

           // $value = array();
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
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent($permisos);
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }
    
    
    public function actualizarPermisosAction(){
       
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            $modulos_perfiles = $this->request->getPost('permisos');
            foreach ($modulos_perfiles as $value) {
                  $permiso = Permiso::findFirst("modulo_id = {$value['idm']}  AND perfil_id = {$value['idp']} ");
                  
                  //echo "<pre>";                  print_r($permiso);
                  #echo $value['idm'].'-->'.$value['idp'].'--->'.$value['val'].'<br>';
                if(!empty($permiso)) 
                {
                  $permiso->estado = @$value['val'];
                  #print $permiso->estado."<br>";
                  
                    $permiso->save();
                }
                 
                  
//                $this->db->query("UPDATE modulos_perfiles SET estado = '{$value['val']}' WHERE modulo_id = {$value['idm']} and perfil_id = {$value['idp']}");
//                $permiso->find(array('mod_id' => $value['idm'], 'per_id' => $value['idp']));
//                $permiso->estado = $value['val'];
//                $permiso->update();
            }
            //exit();
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say"=>"yes"));
            
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();    
    }
    

}
