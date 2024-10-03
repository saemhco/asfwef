<?php

class RegistropantallasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {



        $this->assets->addJs("adminpanel/js/modulos/registropantallas.js?v=" . uniqid());

        $perfil = $this->session->get('auth')["perfil"];
        $this->view->perfil = $perfil;

        //tipo de estabilizadores
        $tipoPantallas = TipoPantallas::find("estado = 'A' AND numero = 96");
        $this->view->tipoPantallas = $tipoPantallas;
    }

    //Datatables recursos
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_pantalla");
            $datatable->setSelect("public.tbl_eqp_pantallas.marca,
            public.tbl_eqp_pantallas.modelo,
            public.tbl_eqp_pantallas.serie,
            public.tbl_eqp_pantallas.color,
            public.a_codigos.nombres,
            public.tbl_eqp_pantallas.id_patrimonial,
            public.tbl_eqp_pantallas.tipo,
            public.tbl_eqp_pantallas.id_pantalla,
            public.tbl_eqp_pantallas.estado,
            public.tbl_eqp_pantallas.caracteristicas,
            public.tbl_eqp_pantallas.observaciones");
            $datatable->setFrom("public.tbl_eqp_pantallas INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_pantallas.tipo");
            $datatable->setWhere("public.a_codigos.numero = 96");
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
                $id = (int) $this->request->getPost("id_pantalla", "int");
                $pantallas = Pantallas::findFirstByid_pantalla($id);
                $pantallas = (!$pantallas) ? new Pantallas() : $pantallas;

                if ($this->request->getPost("tipo", "int") == "") {
                    $pantallas->tipo = null;
                } else {
                    $pantallas->tipo = $this->request->getPost("tipo", "int");
                }

                $pantallas->id_patrimonial = $this->request->getPost("id_patrimonial", "string");
                $pantallas->marca = $this->request->getPost("marca", "string");
                $pantallas->modelo = $this->request->getPost("modelo", "string");
                $pantallas->serie = $this->request->getPost("serie", "string");
                $pantallas->color = $this->request->getPost("color", "string");
                $pantallas->caracteristicas = $this->request->getPost("caracteristicas", "string");
                $pantallas->observaciones = $this->request->getPost("observaciones", "string");
                $pantallas->estado = "A";


                if ($pantallas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($pantallas->getMessages());
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

            $pantallas = Pantallas::findFirstByid_pantalla((int) $this->request->getPost("id_pantalla", "int"));
            if ($pantallas) {
                $this->response->setJsonContent($pantallas->toArray());
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
            $pantallas = Pantallas::findFirstByid_pantalla((int) $this->request->getPost("id_pantalla", "int"));

            //    echo "<pre>";
            //    print_r($_POST);
            //    exit();



            if ($pantallas && $pantallas->estado = 'A') {
                $pantallas->estado = 'X';
                $pantallas->save();
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
