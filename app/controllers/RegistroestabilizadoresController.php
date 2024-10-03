<?php

class RegistroestabilizadoresController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {



        $this->assets->addJs("adminpanel/js/modulos/registroestabilizadores.js?v=" . uniqid());

        $perfil = $this->session->get('auth')["perfil"];
        $this->view->perfil = $perfil;

        //tipo de estabilizadores
        $tipoEstabilizadores = TipoEstabilizadores::find("estado = 'A' AND numero = 99");
        $this->view->tipoestabilizadores = $tipoEstabilizadores;
    }

    //Datatables recursos
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_estabilizador");
            $datatable->setSelect("public.tbl_eqp_estabilizadores.marca,
            public.tbl_eqp_estabilizadores.modelo,
            public.tbl_eqp_estabilizadores.serie,
            public.tbl_eqp_estabilizadores.color,
            public.a_codigos.nombres,
            public.tbl_eqp_estabilizadores.id_patrimonial,
            public.tbl_eqp_estabilizadores.tipo,
            public.tbl_eqp_estabilizadores.id_estabilizador,
            public.tbl_eqp_estabilizadores.caracteristicas,
            public.tbl_eqp_estabilizadores.estado,
            public.tbl_eqp_estabilizadores.observaciones");
            $datatable->setFrom("public.tbl_eqp_estabilizadores INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_estabilizadores.tipo");
            $datatable->setWhere("public.a_codigos.numero = 99");
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
                $id = (int) $this->request->getPost("id_estabilizador", "int");
                $estabilizadores = Estabilizadores::findFirstByid_estabilizador($id);
                $estabilizadores = (!$estabilizadores) ? new Estabilizadores() : $estabilizadores;

                if ($this->request->getPost("tipo", "int") == "") {
                    $estabilizadores->tipo = null;
                } else {
                    $estabilizadores->tipo = $this->request->getPost("tipo", "int");
                }

                $estabilizadores->id_patrimonial = $this->request->getPost("id_patrimonial", "string");
                $estabilizadores->marca = $this->request->getPost("marca", "string");
                $estabilizadores->modelo = $this->request->getPost("modelo", "string");
                $estabilizadores->serie = $this->request->getPost("serie", "string");
                $estabilizadores->color = $this->request->getPost("color", "string");
                $estabilizadores->caracteristicas = $this->request->getPost("caracteristicas", "string");
                $estabilizadores->observaciones = $this->request->getPost("observaciones", "string");
                $estabilizadores->estado = "A";


                if ($estabilizadores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($estabilizadores->getMessages());
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

            $estabilizadores = Estabilizadores::findFirstByid_estabilizador((int) $this->request->getPost("id_estabilizador", "int"));
            if ($estabilizadores) {
                $this->response->setJsonContent($estabilizadores->toArray());
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
            $estabilizadores = Estabilizadores::findFirstByid_estabilizador((int) $this->request->getPost("id_estabilizador", "int"));

            //    echo "<pre>";
            //    print_r($_POST);
            //    exit();



            if ($estabilizadores && $estabilizadores->estado = 'A') {
                $estabilizadores->estado = 'X';
                $estabilizadores->save();
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
