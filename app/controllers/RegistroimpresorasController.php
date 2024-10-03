<?php

class RegistroimpresorasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {


        $this->assets->addJs("adminpanel/js/modulos/registroimpresoras.js?v=" . uniqid());

        $perfil = $this->session->get('auth')["perfil"];
        $this->view->perfil = $perfil;

        //tipo de impresoras
        $tipoImpresoras = TipoImpresoras::find("estado = 'A' AND numero = 100");
        $this->view->tipoimpresoras = $tipoImpresoras;
    }

    //Datatables recursos
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_impresora");
            $datatable->setSelect("public.a_codigos.nombres,
            public.tbl_eqp_impresoras.id_impresora,
            public.tbl_eqp_impresoras.marca,
            public.tbl_eqp_impresoras.modelo,
            public.tbl_eqp_impresoras.serie,
            public.tbl_eqp_impresoras.color,
            public.tbl_eqp_impresoras.observaciones,
            public.tbl_eqp_impresoras.caracteristicas,
            public.tbl_eqp_impresoras.id_patrimonial,
            public.tbl_eqp_impresoras.estado");
            $datatable->setFrom("public.a_codigos INNER JOIN public.tbl_eqp_impresoras ON public.a_codigos.codigo = public.tbl_eqp_impresoras.tipo");
            $datatable->setWhere("public.a_codigos.numero = 100");
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
                $id = (int) $this->request->getPost("id_impresora", "int");
                $impresoras = Impresoras::findFirstByid_impresora($id);
                $impresoras = (!$impresoras) ? new Impresoras() : $impresoras;

                if ($this->request->getPost("tipo", "int") == "") {
                    $impresoras->tipo = null;
                } else {
                    $impresoras->tipo = $this->request->getPost("tipo", "int");
                }
                $impresoras->id_patrimonial = $this->request->getPost("id_patrimonial", "string");
                $impresoras->marca = $this->request->getPost("marca", "string");
                $impresoras->modelo = $this->request->getPost("modelo", "string");
                $impresoras->serie = $this->request->getPost("serie", "string");
                $impresoras->color = $this->request->getPost("color", "string");
                $impresoras->mac = $this->request->getPost("mac", "string");
                $impresoras->caracteristicas = $this->request->getPost("caracteristicas", "string");
                $impresoras->observaciones = $this->request->getPost("observaciones", "string");
                $impresoras->estado = "A";


                if ($impresoras->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($impresoras->getMessages());
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

            $impresoras = Impresoras::findFirstByid_impresora((int) $this->request->getPost("id_impresora", "int"));
            if ($impresoras) {
                $this->response->setJsonContent($impresoras->toArray());
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
            $impresoras = Impresoras::findFirstByid_impresora((int) $this->request->getPost("id_impresora", "int"));
            if ($impresoras && $impresoras->estado = 'A') {
                $impresoras->estado = 'X';
                $impresoras->save();
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
