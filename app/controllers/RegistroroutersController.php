<?php

class RegistroroutersController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/registrorouters.js?v=" . uniqid());

        $perfil = $this->session->get('auth')["perfil"];
        $this->view->perfil = $perfil;

        //tipo de routers
        $tipoRouters = TipoRouters::find("estado = 'A' AND numero = 95");
        $this->view->tiporouters = $tipoRouters;
    }

    //Datatables recursos
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_router");
            $datatable->setSelect("public.tbl_eqp_routers.marca,
            public.tbl_eqp_routers.modelo,
            public.tbl_eqp_routers.serie,
            public.tbl_eqp_routers.color,
            public.a_codigos.nombres,
            public.tbl_eqp_routers.id_patrimonial,
            public.tbl_eqp_routers.tipo,
            public.tbl_eqp_routers.id_router,
            public.tbl_eqp_routers.estado,
            public.tbl_eqp_routers.caracteristicas,
            public.tbl_eqp_routers.observaciones");
            $datatable->setFrom("public.tbl_eqp_routers INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_eqp_routers.tipo");
            $datatable->setWhere("public.a_codigos.numero = 95");
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
                $id = (int) $this->request->getPost("id_router", "int");
                $routers = Routers::findFirstByid_router($id);
                $routers = (!$routers) ? new Routers() : $routers;

                if ($this->request->getPost("tipo", "int") == "") {
                    $routers->tipo = null;
                } else {
                    $routers->tipo = $this->request->getPost("tipo", "int");
                }

                $routers->id_patrimonial = $this->request->getPost("id_patrimonial", "string");
                $routers->marca = $this->request->getPost("marca", "string");
                $routers->modelo = $this->request->getPost("modelo", "string");
                $routers->serie = $this->request->getPost("serie", "string");
                $routers->color = $this->request->getPost("color", "string");
                $routers->mac = $this->request->getPost("mac", "string");
                $routers->caracteristicas = $this->request->getPost("caracteristicas", "string");
                $routers->observaciones = $this->request->getPost("observaciones", "string");
                $routers->estado = "A";


                if ($routers->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($routers->getMessages());
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

            $routers = Routers::findFirstByid_router((int) $this->request->getPost("id_router", "int"));
            if ($routers) {
                $this->response->setJsonContent($routers->toArray());
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
            $routers = Routers::findFirstByid_router((int) $this->request->getPost("id_router", "int"));

            //    echo "<pre>";
            //    print_r($_POST);
            //    exit();



            if ($routers && $routers->estado = 'A') {
                $routers->estado = 'X';
                $routers->save();
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
