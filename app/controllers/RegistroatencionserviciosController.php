<?php

class RegistroatencionserviciosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroatencionservicios.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }


    public function registroAction($id = null, $nro_doc = null, $tipo = null)
    {


        $this->view->id = $id;
        if ($id != null) {
            $atenciones = Atenciones::findFirstByid_atencion((int)$id);
            if ($tipo == 1) {
                $alumnos = Alumnos::findFirstBynro_doc("$nro_doc");
                $this->view->paciente = $alumnos;
                $this->view->tipo = $tipo;
            } elseif ($tipo == 2) {
                $docentes = Docentes::findFirstBynro_doc("$nro_doc");
                $this->view->paciente = $docentes;
                $this->view->tipo = $tipo;
            } elseif ($tipo == 3) {
                // print("Personal:".$tipo);
                // exit();
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_personal.codigo,
                public.tbl_web_personal.apellidop,
                public.tbl_web_personal.apellidom,
                public.tbl_web_personal.nombres,
                public.tbl_web_personal.fecha_nacimiento,
                public.tbl_web_personal.sexo,
                public.tbl_web_personal.direccion_actual AS direccion,
                public.tbl_web_personal.lugar_nacimiento AS ciudad,
                public.tbl_web_personal.celular,
                public.tbl_web_personal.telefono_emergencia AS telefono,
                public.tbl_web_personal.email,
                public.tbl_web_personal.email1,
                public.tbl_web_personal.seguro,
                public.tbl_web_personal.documento,
                public.tbl_web_personal.nro_doc,
                public.tbl_web_personal.imagen AS foto
                FROM
                public.tbl_web_personal
                WHERE
                public.tbl_web_personal.nro_doc = '$nro_doc'";
                $personal = $db->fetchOne($sqlQuery, Phalcon\Db::FETCH_OBJ);
                // print($personal->nombres);
                // exit();
                $this->view->paciente = $personal;
                $this->view->tipo = $tipo;
            }
        } else {

            $atenciones = Atenciones::findFirstByid_atencion(0);
            if ($tipo == 1) {
                $alumnos = Alumnos::findFirstBynro_doc("$nro_doc");
                $this->view->paciente = $alumnos;
                $this->view->tipo = $tipo;
            } elseif ($tipo == 2) {
                $docentes = Docentes::findFirstBynro_doc("$nro_doc");
                $this->view->paciente = $docentes;
                $this->view->tipo = $tipo;
            } elseif ($tipo == 3) {
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_personal.codigo,
                public.tbl_web_personal.apellidop,
                public.tbl_web_personal.apellidom,
                public.tbl_web_personal.nombres,
                public.tbl_web_personal.fecha_nacimiento,
                public.tbl_web_personal.sexo,
                public.tbl_web_personal.direccion_actual AS direccion,
                public.tbl_web_personal.lugar_nacimiento AS ciudad,
                public.tbl_web_personal.celular,
                public.tbl_web_personal.telefono_emergencia AS telefono,
                public.tbl_web_personal.email,
                public.tbl_web_personal.email1,
                public.tbl_web_personal.seguro,
                public.tbl_web_personal.documento,
                public.tbl_web_personal.nro_doc,
                public.tbl_web_personal.imagen AS foto
                FROM
                public.tbl_web_personal
                WHERE
                public.tbl_web_personal.nro_doc = '$nro_doc'";
                $personal = $db->fetchOne($sqlQuery, Phalcon\Db::FETCH_OBJ);
                // print($personal->nombres);
                // exit();
                $this->view->paciente = $personal;
                $this->view->tipo = $tipo;
            }
        }
        $this->view->atenciones = $atenciones;

        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguros;

        $documentos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentos = $documentos;

        $servicios = Servicios::find(array("estado = 'A'", "order" => "titular DESC"));
        $this->view->servicios = $servicios;

        $motivos = Motivos::find("estado = 'A' AND numero = 125 ");
        $this->view->motivos = $motivos;

        $personal = Personal::find(array("estado = 'A'", "order" => "apellidop, apellidom, nombres ASC"));
        $this->view->personal = $personal;

        $procesos = Procesos::find("estado = 'A' AND numero = 126 ");
        $this->view->procesos = $procesos;


        $this->assets->addJs("adminpanel/js/modulos/registroatencionservicios.derivacion.servicios.js?v=" . uniqid());
    }

    public function datatableAction($fecha_inicio = null, $fecha_fin = null)
    {

        // print($fecha_inicio."-".$fecha_fin);
        // exit();

        if ($fecha_inicio != 0 and $fecha_fin != 0) {
            $where = "(CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else {
            $where = "";
        }

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_atencion");
            $datatable->setSelect("nro_doc,id_atencion,fecha_atencion,fecha,tipo,tipo_codigo,apellidos_nombre,direccion,telefono,estado");
            $datatable->setFrom("(SELECT
            tbl_dbu_atenciones.id_atencion,
            to_char( tbl_dbu_atenciones.fecha_atencion, 'DD/MM/YYYY' ) AS fecha_atencion,
            tbl_dbu_atenciones.fecha_atencion AS fecha,
            view_dss_pacientes.nro_doc,
            view_dss_pacientes.tipo,
            view_dss_pacientes.tipo_codigo,
            view_dss_pacientes.apellidos_nombre,
            view_dss_pacientes.direccion,
            view_dss_pacientes.telefono,
            tbl_dbu_atenciones.estado
            FROM
            tbl_dbu_atenciones
            INNER JOIN view_dss_pacientes ON view_dss_pacientes.nro_doc = tbl_dbu_atenciones.nro_doc) AS temporal_table");
            $datatable->setWhere("$where");
            $datatable->setOrderby("apellidos_nombre ASC");
            $datatable->setParams($_POST);
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

                $id = (int) $this->request->getPost("id_atencion", "int");
                $atenciones = DbuAtenciones::findFirstByid_atencion($id);
                $atenciones = (!$atenciones) ? new DbuAtenciones() : $atenciones;

                $atenciones->nro_doc = $this->request->getPost("nro_doc", "string");
                if ($this->request->getPost("fecha_atencion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_atencion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $atenciones->fecha_atencion = date('Y-m-d', strtotime($fecha_new));
                }
                $atenciones->descripcion = $this->request->getPost("descripcion", "string");
                $atenciones->observaciones = $this->request->getPost("observaciones", "string");
                $atenciones->estado = "A";

                if ($atenciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($atenciones->getMessages());
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






    public function saveAtencionNuevoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $model = (!$model) ? new DbuAtenciones() : $model;
                $model->nro_doc = $this->request->getPost("nro_doc", "string");
                $model->fecha_atencion = date("Y-m-d H:i:s");
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


    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_atencion = (int) $this->request->getPost("id_atencion", "int");
            $nro_doc = (string) $this->request->getPost("nro_doc", "string");

            $model = DbuAtenciones::findFirst("id_atencion = $id_atencion AND nro_doc = '$nro_doc'");

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

    public function datatableDerivacionServiciosAction($id_atencion)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_derivacion_servicio");
            $datatable->setSelect("id_derivacion_servicio,id_atencion,fecha_derivacion,servicio, motivo,proceso,estado");
            $datatable->setFrom("(SELECT
            public.tbl_dbu_derivacion_servicios.id_derivacion_servicio,
            public.tbl_dbu_derivacion_servicios.id_atencion,
            to_char(tbl_dbu_derivacion_servicios.fecha_derivacion, 'DD/MM/YYYY' ) AS fecha_derivacion,
            public.tbl_web_servicios.titular AS servicio,
            motivos.nombres AS motivo,
            public.tbl_dbu_derivacion_servicios.estado,
            procesos.nombres AS proceso
            FROM
            public.tbl_dbu_atenciones
            INNER JOIN public.tbl_dbu_derivacion_servicios ON public.tbl_dbu_atenciones.id_atencion = public.tbl_dbu_derivacion_servicios.id_atencion
            INNER JOIN public.tbl_web_servicios ON public.tbl_web_servicios.id_servicio = public.tbl_dbu_derivacion_servicios.id_servicio
            INNER JOIN public.a_codigos AS motivos ON motivos.codigo = public.tbl_dbu_derivacion_servicios.id_motivo_dbu
            INNER JOIN public.a_codigos AS procesos ON procesos.codigo = public.tbl_dbu_derivacion_servicios.proceso
            WHERE
            public.tbl_dbu_atenciones.id_atencion = $id_atencion AND
            motivos.numero = 125 AND
            procesos.numero = 126
            ) AS temporal_table");
            $datatable->setOrderby("id_derivacion_servicio ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDerivacionServiciosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_derivacion_servicio", "string");
                $model = DbuDerivacionServicios::findFirstByid_derivacion_servicio((int)$id);
                $model = (!$model) ? new DbuDerivacionServicios() : $model;

                $model->id_atencion = $this->request->getPost("id_atencion", "int");
                if ($this->request->getPost("id_servicio", "int") == "") {
                    $model->id_servicio = null;
                } else {
                    $model->id_servicio = $this->request->getPost("id_servicio", "int");
                }

                if ($this->request->getPost("fecha_derivacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_derivacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    // print("fecha derivacion".$fecha_new);
                    // exit();
                    $model->fecha_derivacion = date('Y-m-d', strtotime($fecha_new));
                }


                
                if ($this->request->getPost("fecha_atencion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_atencion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    // print("fecha atencion".$fecha_new);
                    // exit();
                    $model->fecha_atencion = date('Y-m-d', strtotime($fecha_new));
                }



                if ($this->request->getPost("id_motivo_dbu", "int") == "") {
                    $model->id_motivo_dbu = null;
                } else {
                    $model->id_motivo_dbu = $this->request->getPost("id_motivo_dbu", "int");
                }
                $model->descripcion = $this->request->getPost("descripcion", "string");


                if ($this->request->getPost("id_personal", "int") == "") {
                    $model->id_personal = null;
                } else {
                    $model->id_personal = $this->request->getPost("id_personal", "int");
                }

                if ($this->request->getPost("proceso", "int") == "") {
                    $model->proceso = null;
                } else {
                    $model->proceso = $this->request->getPost("proceso", "int");
                }

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

    public function getAjaxDerivacionServiciosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $model = DbuDerivacionServicios::findFirstByid_derivacion_servicio((int) $this->request->getPost("id", "int"));

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


    public function eliminarDerivacionServiciosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = DbuDerivacionServicios::findFirstByid_derivacion_servicio((int) $this->request->getPost("id", "int"));
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
