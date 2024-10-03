<?php

class RegistrocomputadorasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/registrocomputadoras.js?v=" . uniqid());

        $perfil = $this->session->get('auth')["perfil"];
        $this->view->perfil = $perfil;

        $tipoComputadoras = TipoComputadoras::find("estado = 'A' AND numero = 101");
        $this->view->tipocomputadoras = $tipoComputadoras;
    }

    //Datatables recursos
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_computadora");
            $datatable->setSelect("public.tbl_eqp_computadoras.id_computadora,
            public.tbl_eqp_computadoras.marca,
            public.tbl_eqp_computadoras.modelo,
            public.tbl_eqp_computadoras.serie,
            public.tbl_eqp_computadoras.color,
            public.tbl_eqp_computadoras.estado,
            public.tbl_eqp_computadoras.observaciones,
            public.tbl_eqp_computadoras.id_patrimonial,
            public.tbl_eqp_computadoras.caracteristicas,
            public.a_codigos.nombres");
            $datatable->setFrom("public.tbl_eqp_computadoras
            INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_computadoras.tipo");
            $datatable->setWhere("public.a_codigos.numero = 101");
            $datatable->setOrderby("id_patrimonial ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Guardar
    public function saveAction()
    {

        //    echo "<pre>";
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_computadora", "int");
                $computadoras = Computadoras::findFirstByid_computadora($id);
                $computadoras = (!$computadoras) ? new Computadoras() : $computadoras;

                if ($this->request->getPost("tipo", "int") == "") {
                    $computadoras->tipo = null;
                } else {
                    $computadoras->tipo = $this->request->getPost("tipo", "int");
                }

                $computadoras->id_patrimonial = $this->request->getPost("id_patrimonial", "string");
                $computadoras->marca = $this->request->getPost("marca", "string");
                $computadoras->modelo = $this->request->getPost("modelo", "string");
                $computadoras->serie = $this->request->getPost("serie", "string");
                $computadoras->color = $this->request->getPost("color", "string");
                $computadoras->mac = $this->request->getPost("mac", "string");
                $computadoras->caracteristicas = $this->request->getPost("caracteristicas", "string");
                $computadoras->observaciones = $this->request->getPost("observaciones", "string");
                $computadoras->estado = "A";


                if ($computadoras->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($computadoras->getMessages());
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
    public function getAjaxAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //    echo "<pre>";
            //    print_r($_POST);
            //    exit();

            $computadoras = Computadoras::findFirstByid_computadora((int) $this->request->getPost("id_computadora", "int"));
            if ($computadoras) {
                $this->response->setJsonContent($computadoras->toArray());
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
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $computadoras = Computadoras::findFirstByid_computadora((int) $this->request->getPost("id_computadora", "int"));
            if ($computadoras && $computadoras->estado = 'A') {
                $computadoras->estado = 'X';
                $computadoras->save();
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
