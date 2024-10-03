<?php
class RegistroencuestasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroencuestas.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function saveAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_encuesta", "int");
                $model = Encuestas::findFirstByid_encuesta($id);

                $model = (!$model) ? new Encuestas() : $model;

                if ($this->request->getPost("id_tipo_encuesta", "int") == "") {
                    $model->id_tipo_encuesta = null;
                } else {
                    $model->id_tipo_encuesta = $this->request->getPost("id_tipo_encuesta", "int");
                }

                if ($this->request->getPost("id_tipo_usuario", "int") == "") {
                    $model->id_tipo_usuario = null;
                } else {
                    $model->id_tipo_usuario = $this->request->getPost("id_tipo_usuario", "int");
                }

                $model->area_responsable = $this->request->getPost("area_responsable", "string");


                $model->descripcion = $this->request->getPost("descripcion", "string");
                $model->indicaciones = $this->request->getPost("indicaciones", "string");
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


    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_encuesta");
            $datatable->setSelect("id_encuesta,tipo_encuesta,descripcion,estado");
            $datatable->setFrom("(SELECT
            public.tbl_enc_encuestas.id_encuesta,
            public.a_codigos.nombres AS tipo_encuesta,
            public.tbl_enc_encuestas.descripcion,
            public.tbl_enc_encuestas.estado
            FROM
            public.tbl_enc_encuestas
            INNER JOIN public.a_codigos ON public.tbl_enc_encuestas.id_tipo_encuesta = public.a_codigos.codigo
            WHERE
            public.a_codigos.numero = 130) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("id_encuesta ASC");
            $datatable->getJson();
        }
    }

    public function registroAction($id = null)
    {

        $this->view->id = $id;
        if ($id != null) {
            $encuestas = Encuestas::findFirstByid_encuesta((int) $id);
        } else {

            $encuestas = Encuestas::findFirstByid_encuesta(0);
        }
        $this->view->encuestas = $encuestas;


        $tipoencuestas = TipoEncuestas::find("estado = 'A' AND numero = 130 ORDER BY nombres ASC");
        $this->view->tipoencuestas = $tipoencuestas;

        $tipousuarios = TipoUsuario::find("estado = 'A' AND numero = 50 ORDER BY nombres ASC");
        // foreach ($tipousuarios as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->nombres);
        // }
        // exit();

        $this->view->tipousuarios = $tipousuarios;



    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Encuestas::findFirstByid_encuesta((int) $this->request->getPost("id", "int"));
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


    public function saveEncuestasPreguntasAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_encuesta_pregunta", "int");
                $model = EncuestasPreguntas::findFirstByid_encuesta_pregunta($id);

                $model = (!$model) ? new EncuestasPreguntas() : $model;

                $model->id_encuesta = $this->request->getPost("id_encuesta", "int");


                if ($this->request->getPost("id_tipo_pregunta", "int") == "") {
                    $model->id_tipo_pregunta = null;
                } else {
                    $model->id_tipo_pregunta = $this->request->getPost("id_tipo_pregunta", "int");
                }

                if ($this->request->getPost("id_tipo_respuesta", "int") == "") {
                    $model->id_tipo_respuesta = null;
                } else {
                    $model->id_tipo_respuesta = $this->request->getPost("id_tipo_respuesta", "int");
                }

                $model->numero = $this->request->getPost("numero", "int");
                $model->descripcion = $this->request->getPost("descripcion", "string");
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

    public function datatableEncuestasPreguntasAction($id_encuesta)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_encuesta_pregunta");
            $datatable->setSelect("id_encuesta_pregunta,id_encuesta,id_tipo_pregunta,tipo_pregunta,
            id_tipo_respuesta,tipo_respuesta,descripcion,numero,estado");
            $datatable->setFrom("(SELECT
            public.tbl_enc_encuestas_preguntas.id_encuesta_pregunta,
            public.tbl_enc_encuestas_preguntas.id_encuesta,
            public.tbl_enc_encuestas_preguntas.id_tipo_pregunta,
            tipo_preguntas.nombres AS tipo_pregunta,
            public.tbl_enc_encuestas_preguntas.id_tipo_respuesta,
            tipo_respuestas.nombres AS tipo_respuesta,
            public.tbl_enc_encuestas_preguntas.descripcion,
            public.tbl_enc_encuestas_preguntas.numero,
            public.tbl_enc_encuestas_preguntas.estado
            FROM
            public.tbl_enc_encuestas_preguntas
            INNER JOIN public.a_codigos AS tipo_preguntas ON tipo_preguntas.codigo = public.tbl_enc_encuestas_preguntas.id_tipo_pregunta
            INNER JOIN public.a_codigos AS tipo_respuestas ON tipo_respuestas.codigo = public.tbl_enc_encuestas_preguntas.id_tipo_respuesta
            WHERE
            tipo_preguntas.numero = 36 AND
            tipo_respuestas.numero = 131 AND id_encuesta = $id_encuesta) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("numero ASC");
            $datatable->getJson();
        }
    }


    public function eliminarEncuestasPreguntasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = EncuestasPreguntas::findFirstByid_encuesta_pregunta((int) $this->request->getPost("id_encuesta_pregunta", "int"));
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

    public function preguntasAction($id_encuesta)
    {
        $this->view->id_encuesta = $id_encuesta;
        $this->assets->addJs("adminpanel/js/modulos/registroencuestas.preguntas.js?v=" . uniqid());
    }

    public function registropreguntasAction($id = null)
    {

        $this->view->id = $id;
        if ($id != null) {
            $preguntas = EncuestasPreguntas::findFirstByid_encuesta_pregunta((int) $id);
        } else {

            $preguntas = EncuestasPreguntas::findFirstByid_encuesta_pregunta(0);
        }
        $this->view->preguntas = $preguntas;

        $tipopreguntas = TipoPreguntas::find("estado = 'A' AND numero = 36 ORDER BY nombres ASC");
        $this->view->tipopreguntas = $tipopreguntas;

        
        $tiporespuestas = TipoRespuestas::find("estado = 'A' AND numero = 131 ORDER BY nombres ASC");
        $this->view->tiporespuestas = $tiporespuestas;

        $this->assets->addJs("adminpanel/js/modulos/registroencuestas.preguntas.respuestas.js?v=" . uniqid());


    }

    public function datatableEncuestasPreguntasRespuestasAction($id_encuesta_pregunta)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_encuesta_respuesta");
            $datatable->setSelect("id_encuesta_respuesta,id_encuesta_pregunta,descripcion,puntaje,estado");
            $datatable->setFrom("(SELECT
            public.tbl_enc_encuestas_respuestas.id_encuesta_respuesta,
            public.tbl_enc_encuestas_respuestas.id_encuesta_pregunta,
            public.tbl_enc_encuestas_respuestas.descripcion,
            public.tbl_enc_encuestas_respuestas.puntaje,
            public.tbl_enc_encuestas_respuestas.estado
            FROM
            public.tbl_enc_encuestas_preguntas
            INNER JOIN public.tbl_enc_encuestas_respuestas ON public.tbl_enc_encuestas_preguntas.id_encuesta_pregunta = public.tbl_enc_encuestas_respuestas.id_encuesta_pregunta
            WHERE
            public.tbl_enc_encuestas_respuestas.id_encuesta_pregunta = $id_encuesta_pregunta) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("id_encuesta_respuesta ASC");
            $datatable->getJson();
        }
    }

    public function saveEncuestasPreguntasRespuestasAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_encuesta_respuesta", "int");
                $model = EncuestasPreguntasRespuestas::findFirstByid_encuesta_respuesta($id);

                $model = (!$model) ? new EncuestasPreguntasRespuestas() : $model;

                $model->id_encuesta_pregunta = $this->request->getPost("id_encuesta_pregunta", "int");
                $model->puntaje = $this->request->getPost("puntaje", "string");
                $model->descripcion = $this->request->getPost("descripcion", "string");
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


    public function getAjaxEncuestasPreguntasPreguntasRespuestasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = EncuestasPreguntasRespuestas::findFirstByid_encuesta_respuesta((int) $this->request->getPost("id_encuesta_respuesta", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    
    public function eliminarEncuestasPreguntasRespuestasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = EncuestasPreguntasRespuestas::findFirstByid_encuesta_respuesta((int) $this->request->getPost("id_encuesta_respuesta", "int"));
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

}
