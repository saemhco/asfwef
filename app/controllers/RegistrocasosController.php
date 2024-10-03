<?php

class RegistrocasosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrocasos.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $casos = FscCasos::findFirstByid_caso((int) $id);
        } else {

            $casos = FscCasos::findFirstByid_caso(0);
        }

        $comisarias = FscComisarias::find("estado = 'A' ORDER BY descripcion");
        $this->view->comisarias = $comisarias;

        $comisarios = FscComisarios::find("estado = 'A' ORDER BY apellidos, nombres DESC");
        $this->view->comisarios = $comisarios;

        $secciones = FscSecciones::find("estado = 'A' ORDER BY descripcion");
        $this->view->secciones = $secciones;

        $this->view->casos = $casos;
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {


            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_caso");
            $datatable->setSelect("id_caso,fecha_caso,comisaria,seccion,descripcion,estado");
            $datatable->setFrom("(SELECT
            public.tbl_fsc_casos.id_caso,
             to_char(public.tbl_fsc_casos.fecha_caso, 'DD/MM/YYYY') AS fecha_caso,
            public.tbl_fsc_comisarias.descripcion AS comisaria,
            public.tbl_fsc_secciones.descripcion AS seccion,
            public.tbl_fsc_casos.descripcion,
            public.tbl_fsc_casos.estado
            FROM
            public.tbl_fsc_casos
            INNER JOIN public.tbl_fsc_comisarias ON public.tbl_fsc_comisarias.id_comisaria = public.tbl_fsc_casos.id_comisaria
            INNER JOIN public.tbl_fsc_secciones ON public.tbl_fsc_secciones.id_seccion = public.tbl_fsc_casos.id_seccion
            WHERE
            public.tbl_fsc_casos.id_fiscal = 1) AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("id_caso");
            $datatable->getJson();
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

                $id = (int) $this->request->getPost("id_caso", "int");
                $model = FscCasos::findFirstByid_caso($id);
                $model = (!$model) ? new FscCasos() : $model;

                if ($this->request->getPost("fecha_caso", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_caso", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_caso = date('Y-m-d', strtotime($fecha_new));
                }

                $model->descripcion = $this->request->getPost("descripcion", "string");
                $model->observaciones = $this->request->getPost("observaciones", "string");

                if ($this->request->getPost("id_comisaria", "int") == "") {
                    $model->id_comisaria = null;
                } else {
                    $model->id_comisaria = $this->request->getPost("id_comisaria", "int");
                }

                if ($this->request->getPost("id_seccion", "int") == "") {
                    $model->id_seccion = null;
                } else {
                    $model->id_seccion = $this->request->getPost("id_seccion", "int");
                }

                if ($this->request->getPost("id_comisario", "int") == "") {
                    $model->id_comisario = null;
                } else {
                    $model->id_comisario = $this->request->getPost("id_comisario", "int");
                }

                $auth = $this->session->get('auth');
                $codigo = $auth["codigo"];
                // print($codigo);
                // exit();
                $model->id_fiscal = $codigo;


                $model->estado = "A";


                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = FscCasos::findFirstByid_caso((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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

    //tbl_fsc_casos_agraviados
    public function datatableAgraviadosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_caso_agraviado");
            $datatable->setSelect("id_caso_agraviado,id_caso, nro_doc, estado");
            $datatable->setFrom("tbl_fsc_casos_agraviados");
            $datatable->setWhere("id_caso = $id");
            $datatable->setOrderby("id_caso_agraviado");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAgraviadosAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_caso_agraviado", "int");
                $model = FscCasosAgraviados::findFirstByid_caso_agraviado($id);
                $model = (!$model) ? new FscCasosAgraviados() : $model;

                $model->id_caso = $this->request->getPost("id_caso", "int");
                $model->nro_doc = $this->request->getPost("nro_doc", "string");
                $model->estado = "A";


                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxAgraviadosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosAgraviados::findFirstByid_caso_agraviado((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAgraviadosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosAgraviados::findFirstByid_caso_agraviado((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
    //

    //tbl_fsc_casos_denunciantes
    public function datatableDenunciantesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_caso_denunciante");
            $datatable->setSelect("id_caso_denunciante,id_caso, nro_doc, estado");
            $datatable->setFrom("tbl_fsc_casos_denunciantes");
            $datatable->setWhere("id_caso = $id");
            $datatable->setOrderby("id_caso_denunciante");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDenunciantesAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_caso_denunciante", "int");
                $model = FscCasosDenunciantes::findFirstByid_caso_denunciante($id);
                $model = (!$model) ? new FscCasosDenunciantes() : $model;

                $model->id_caso = $this->request->getPost("id_caso", "int");
                $model->nro_doc = $this->request->getPost("nro_doc", "string");
                $model->estado = "A";


                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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


    public function getAjaxDenunciantesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosDenunciantes::findFirstByid_caso_denunciante((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarDenunciantesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosDenunciantes::findFirstByid_caso_denunciante((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
    //

    //tbl_fsc_casos_denunciados
    public function datatableDenuncidosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_caso_denunciado");
            $datatable->setSelect("id_caso_denunciado,id_caso, nro_doc, estado");
            $datatable->setFrom("tbl_fsc_casos_denunciados");
            $datatable->setWhere("id_caso = $id");
            $datatable->setOrderby("id_caso_denunciado");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function saveDenuncidosAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_caso_denunciado", "int");
                $model = FscCasosDenunciados::findFirstByid_caso_denunciado($id);
                $model = (!$model) ? new FscCasosDenunciados() : $model;

                $model->id_caso = $this->request->getPost("id_caso", "int");
                $model->nro_doc = $this->request->getPost("nro_doc", "string");
                $model->estado = "A";


                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    
    public function getAjaxDenunciadosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosDenunciados::findFirstByid_caso_denunciado((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarDenunciadosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosDenunciados::findFirstByid_caso_denunciado((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
    //

    public function datatableProvidenciasAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_documento_archivo");
            $datatable->setSelect("public.tbl_web_documentos_archivos.id_documento_archivo,
            public.tbl_web_documentos_archivos.id_documento,
            public.tbl_web_documentos_archivos.titulo,
            to_char( public.tbl_web_documentos_archivos.fecha_hora, 'DD/MM/YYYY' ) AS fecha_hora,
            public.tbl_web_documentos_archivos.archivo,
            public.tbl_web_documentos_archivos.enlace,
            public.tbl_web_documentos_archivos.estado");
            $datatable->setFrom("public.tbl_web_documentos_archivos");
            $datatable->setWhere("public.tbl_web_documentos_archivos.id_documento = $id");
            $datatable->setOrderby("public.tbl_web_documentos_archivos.fecha_hora DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveProvidenciasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_caso_providencia", "int");
                $model = FscCasosProvidencias::findFirstByid_caso_providencia($id);
                $model = (!$model) ? new FscCasosProvidencias() : $model;

                $model->id_documento = $this->request->getPost("id_documento", "int");
                $model->titulo = $this->request->getPost("titulo_archivo", "string");



                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxProvidenciasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosProvidencias::findFirstByid_caso_providencia((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarProvidenciasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = FscCasosProvidencias::findFirstByid_caso_providencia((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
