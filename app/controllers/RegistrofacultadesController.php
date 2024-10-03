<?php

class RegistrofacultadesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {        
       
        $this->assets->addJs("adminpanel/js/modulos/registrofacultades.js?v=". uniqid());
    }
    

    public function registroAction($id = null) {

        $this->assets->addJs("adminpanel/js/modulos/facultades.js?v=" . uniqid() . "");
    }
        
        public function saveAction(){

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "string");              
                $Facultad = Facultades::findFirstByCodigo($id);
                $Facultad = (!$Facultad) ? new Facultades() : $Facultad;
                $Facultad->codigo = strtoupper($this->request->getPost("codigo", "string"));
                $Facultad->descripcion = $this->request->getPost("descripcion", "string");
                $Facultad->abreviatura = $this->request->getPost("abreviatura", "string");
                $Facultad->estado = "A";                       
                
                if($Facultad->save() == false){   
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Facultad->getMessages());
                }else{
                    //Cuando va bien 
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say"=>"yes"));
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
    
    public function getAjaxAction(){
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Facultad = Facultades::findFirstBycodigo((string) $this->request->getPost("id", "string"));
            if ($Facultad) {
                $this->response->setJsonContent($Facultad->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }
    
    public function eliminarAction(){
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Facultad = Facultades::findFirstByCodigo((string) $this->request->getPost("id", "string"));
            if ($Facultad && $Facultad->estado = 'A') {
                $Facultad->estado = 'X';
                $Facultad->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say"=>"yes"));               
                
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say"=>"no"));            
                
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("Codigo");
            $datatable->setSelect("Codigo, descripcion, abreviatura, estado");
            $datatable->setFrom("facultades");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderBy("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
