<?php

class RegistroambientesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/registroambientes.js?v" . uniqid());

        $tipo_ambientes_academicos = TipoAmbientesAcademicos::find("estado = 'A' AND numero = 17");
        $this->view->tipo_ambientes_academicos = $tipo_ambientes_academicos;

        $sedes = Sedes::find("estado = 'A' ORDER BY nombres ASC");
        $this->view->sedes = $sedes;
    }

    //new
    public function getNewAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $AmbientesA = AmbientesA::count();

            //echo '<pre>';
            //print_r($AmbientesA);
            //exit();

            if ($AmbientesA >= 0) {

                $id_pk = $AmbientesA + 1;

                $this->response->setJsonContent(array("say" => "si", "pk_aumenta" => $id_pk));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $AmbientesA = AmbientesA::findFirstBycodigo($id);
                //Valida cuando es nuevo
                $AmbientesA = (!$AmbientesA) ? new AmbientesA() : $AmbientesA;

                $AmbientesA->code = $this->request->getPost("code", "string");
                $AmbientesA->codigo = $this->request->getPost("codigo", "int");
                $AmbientesA->tipo = $this->request->getPost("tipo", "int");
                $AmbientesA->descripcion = $this->request->getPost("descripcion", "string");


                $AmbientesA->abreviatura = $this->request->getPost("abreviatura", "string");

                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $AmbientesA->estado = "A";
                } else {
                    $AmbientesA->estado = "X";
                }


                if ($this->request->getPost("id_sede", "int") == "") {
                    $AmbientesA->id_sede = null;
                } else {
                    $AmbientesA->id_sede = $this->request->getPost("id_sede", "int");
                }

                if ($this->request->getPost("id_pabellon", "int") == "") {
                    $AmbientesA->id_pabellon = null;
                } else {
                    $AmbientesA->id_pabellon = $this->request->getPost("id_pabellon", "int");
                }


                if ($AmbientesA->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AmbientesA->getMessages());
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

    public function getAjaxAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $AmbientesA = AmbientesA::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($AmbientesA) {
                $this->response->setJsonContent($AmbientesA->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $AmbientesA = AmbientesA::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($AmbientesA && $AmbientesA->estado = 'A') {
                $AmbientesA->estado = 'X';
                $AmbientesA->save();
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

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("amb.codigo");
            $datatable->setSelect("amb.codigo,t_a_a.nombres as tipo_ambientes_academicos,amb.descripcion,amb.abreviatura,amb.estado,code");
            $datatable->setFrom("ambientes AS amb INNER JOIN a_codigos AS t_a_a ON t_a_a.codigo = amb.tipo");
            $datatable->setWhere("t_a_a.numero = 17");
            $datatable->setOrderby("amb.descripcion ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function getPabellonAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_sede = $this->request->getPost("pk");
            $pabellones = Pabellones::find('id_sede="' . $id_sede . '"');
            $this->response->setJsonContent($pabellones->toArray());
            $this->response->send();
        }
    }
}
