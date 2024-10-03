<?php

class RegistrouniversidadesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrouniversidades.js?v=" . uniqid());
    }

    //Aca insertamos un comentario para subir
    public function indexAction()
    {
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_universidad");
            $datatable->setSelect("id_universidad, tipodeinstitucion,universidad,departamento,provincia,dispositivo,fecha_creacion,fecha_licenciamiento,dispositivo_licenciamiento, estado");
            $datatable->setFrom("(
                SELECT
                public.tbl_web_universidades.id_universidad,
                tipodeinstituciones.nombres AS tipodeinstitucion,
                public.tbl_web_universidades.universidad,
                public.tbl_web_universidades.departamento,
                public.tbl_web_universidades.provincia,
                public.tbl_web_universidades.dispositivo,
                to_char(public.tbl_web_universidades.fecha_creacion, 'DD/MM/YYYY') AS fecha_creacion,
                public.tbl_web_universidades.dispositivo_licenciamiento,
                to_char(public.tbl_web_universidades.fecha_licenciamiento, 'DD/MM/YYYY') AS fecha_licenciamiento,
                public.tbl_web_universidades.convenio,
                public.tbl_web_universidades.pais,
                public.tbl_web_universidades.estado
                FROM
                public.tbl_web_universidades
                INNER JOIN public.a_codigos AS tipodeinstituciones ON tipodeinstituciones.codigo = public.tbl_web_universidades.tipo_institucion
                WHERE
                tipodeinstituciones.numero = 105) AS temporal_table");
            $datatable->setOrderby("fecha_creacion DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function registroAction($id = null)
    {

        if ($id != null) {
            $universidades = Universidades::findFirstByid_universidad((int) $id);
        } else {

            $universidades = Universidades::findFirstByid_universidad(NULL);
        }
        $this->view->universidades = $universidades;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105 ORDER BY nombres ASC");
        // foreach ($tipoinstitucion as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->nombres);
        // }
        // exit();
        $this->view->tipoinstitucion = $tipoinstitucion;
    }

    //Funcion para guardar asignatura
    public function saveAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("id", "int");
                $model = Universidades::findFirstByid_universidad($id);
                $model = (!$model) ? new Universidades() : $model;


                if ($this->request->getPost("tipo_institucion", "int") == "") {
                    $model->tipo_institucion = null;
                } else {
                    $model->tipo_institucion = $this->request->getPost("tipo_institucion", "int");
                }

                $model->universidad = $this->request->getPost("universidad", "string");
                $model->departamento = $this->request->getPost("departamento", "string");
                $model->provincia = $this->request->getPost("provincia", "string");
                $model->dispositivo = $this->request->getPost("dispositivo", "string");

                if ($this->request->getPost("fecha_creacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_creacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $model->fecha_creacion = date('Y-m-d', strtotime($fecha_new));
                }

                $model->dispositivo_licenciamiento = $this->request->getPost("dispositivo_licenciamiento", "string");

                if ($this->request->getPost("fecha_licenciamiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_licenciamiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $model->fecha_licenciamiento = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("convenio", "string") == "") {
                    $model->convenio = '0';
                } else {
                    $model->convenio = '1';
                }

                $model->pais = $this->request->getPost("pais", "string");
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

    //Funcion para eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Universidades::findFirstByid_universidad($this->request->getPost("id", "int"));
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
