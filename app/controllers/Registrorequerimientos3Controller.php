<?php

class Registrorequerimientos3Controller extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrorequerimientos3.js?v=" . uniqid());
    }

    public function indexAction()
    {
        //$this->assets->addJs("Testing");
    }


    public function registroAction($id = null)
    {



        $this->view->id = $id;
        if ($id != null) {
            $requerimientos = RequerimientoServicio3::findFirstByid_req_servicio((int) $id);
            // print($requerimientos->imagen);
            // exit();




        } else {

            $requerimientos = RequerimientoServicio3::findFirstByid_req_servicio(0);
        }
        $this->view->requerimientos = $requerimientos;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $tiposervicio = TipoServicio::find("estado = 'A' AND numero = 129 ORDER BY nombres ASC");
        $this->view->tiposervicio = $tiposervicio;

        $prioridad = Prioridad::find("estado = 'A' AND numero = 53 ORDER BY nombres ASC");
        $this->view->prioridad = $prioridad;

        $areas = Areas::find("estado = 'A'");
        $this->view->areas = $areas;

        $areaPersonalCargo = VConsultaRecursosTic::find(
            [
                "pae_estado = 'A'",
                'order' => 'personal_nombre ASC',
            ]
        );

        // foreach ($areaPersonalCargo as $key => $value) {
        //     echo "<pre>";
        //     print_r("id_personal_area_equipo: ".$value->id_personal_area_equipo);
        // }
        // exit();




        $this->view->area_personal_cargo = $areaPersonalCargo;



        $auth = $this->session->get('auth');

        // echo "<pre>";
        // print_r($auth);
        // exit();


    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];


            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_req_servicio");
            $datatable->setSelect("id_req_servicio, 
            fecha_req, hora_req, tiposervicio,
            prioridad,proceso,estado");
            $datatable->setFrom("(SELECT
            public.tbl_hdt_req_servicios.id_req_servicio,
            to_char(public.tbl_hdt_req_servicios.fecha_req, 'DD/MM/YYYY') AS fecha_req,
            to_char(public.tbl_hdt_req_servicios.hora_req::Time, 'HH12:MI:SS AM') AS hora_req,
            tiposervicios.nombres AS tiposervicio,
            prioridades.nombres AS prioridad,
            procesos.nombres AS proceso,
            public.tbl_hdt_req_servicios.estado
            FROM
            public.tbl_hdt_req_servicios
            INNER JOIN public.a_codigos AS tiposervicios ON tiposervicios.codigo = public.tbl_hdt_req_servicios.id_tipo_servicio
            INNER JOIN public.a_codigos AS prioridades ON prioridades.codigo = public.tbl_hdt_req_servicios.id_prioridad
            INNER JOIN public.tbl_web_personal_areas_equipos ON public.tbl_web_personal_areas_equipos.id_personal_area_equipo = public.tbl_hdt_req_servicios.id_personal_area_equipo
            INNER JOIN public.a_codigos AS procesos ON procesos.codigo = public.tbl_hdt_req_servicios.proceso
            WHERE
            tiposervicios.numero = 129 AND
            prioridades.numero = 53 AND
            procesos.numero = 94 AND
            public.tbl_hdt_req_servicios.id_usuario = $id_usuario) AS temporal_table");
            $datatable->setOrderby("fecha_req DESC");
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
                $id = (int) $this->request->getPost("id_req_servicio", "int");
                $model = RequerimientoServicio3::findFirstByid_req_servicio($id);
                //Valida cuando es nuevo
                $model = (!$model) ? new RequerimientoServicio3() : $model;



                if ($this->request->getPost("id_tipo_servicio", "int") == "") {
                    $model->id_tipo_servicio = null;
                } else {
                    $model->id_tipo_servicio = $this->request->getPost("id_tipo_servicio", "int");
                }

                if ($this->request->getPost("id_prioridad", "int") == "") {
                    $model->id_prioridad = null;
                } else {
                    $model->id_prioridad = $this->request->getPost("id_prioridad", "int");
                }


                $auth = $this->session->get('auth');

                // echo "<pre>";
                // print_r($auth);
                // exit();

                $id_usuario = $auth["codigo"];
                $model->id_usuario = $id_usuario;

                if ($this->request->getPost("id_personal_area_equipo", "int") == "") {
                    $model->id_personal_area_equipo = null;
                } else {
                    $model->id_personal_area_equipo = $this->request->getPost("id_personal_area_equipo", "int");
                }



                $model->descripcion = $this->request->getPost("descripcion", "string");


                $model->fecha_req = date("Y-m-d H:i:s");
                $model->hora_req = date("H:i:s");


                if ($this->request->getPost("id_personal", "int") == "") {
                    $model->id_personal = null;
                } else {
                    $model->id_personal = $this->request->getPost("id_personal", "int");
                }

                
                if ($this->request->getPost("id_area", "int") == "") {
                    $model->id_area = null;
                } else {
                    $model->id_area = $this->request->getPost("id_area", "int");
                }


                $model->proceso = 1;
                $model->estado = "A";





                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                    if (in_array($extension, $formatos_imagenes)) {


                                        if (isset($model->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/requerimientos/' . $model->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/requerimientos/' . 'IMG' . '-' . $model->id_req_servicio . '-' . $temporal_rand . "." . $extension;
                                            $model->imagen = 'IMG' . '-' . $model->id_req_servicio . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/requerimientos/' . 'IMG' . '-' . $model->id_req_servicio . '.' . $extension;
                                            $model->imagen = 'IMG' . '-' . $model->id_req_servicio . '.' . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_requerimiento") {
                                if ($_FILES['archivo_requerimiento']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_requerimiento']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($model->archivo)) {
                                            $url_destino = 'adminpanel/archivos/requerimientos/' . $model->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/requerimientos/' . 'FILE' . '-' . $model->id_req_servicio . '-' . $temporal_rand . "." . $extension;
                                            $model->archivo = 'FILE' . '-' . $model->id_req_servicio . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/requerimientos/' . 'FILE' . '-' . $model->id_req_servicio . "." . $extension;
                                            $model->archivo = 'FILE' . '-' . $model->id_req_servicio . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $model->save();
                    }

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

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = RequerimientoServicio3::findFirstByid_req_servicio((int) $this->request->getPost("id", "int"));
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


    public function getPersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_area = $this->request->getPost("id");

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $db = $this->db;
            $sql = "SELECT
            public.tbl_web_personal_areas.id_personal_area,
            public.tbl_web_personal.codigo AS id_personal,
            public.tbl_web_areas.codigo AS id_area,
            public.tbl_web_areas.nombres AS area_nombre,
            public.tbl_web_personal.apellidop,
            public.tbl_web_personal.apellidom,
            public.tbl_web_personal.nombres
            FROM
            public.tbl_web_personal
            INNER JOIN public.tbl_web_personal_areas ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
            INNER JOIN public.tbl_web_areas ON public.tbl_web_personal_areas.area = public.tbl_web_areas.codigo
            WHERE
            public.tbl_web_areas.codigo = $id_area";
            $data = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);

            // foreach ($data as $key => $value) {
            //     echo "<pre>";
            //     print($value->nombres);
            // }
            // exit();

            $this->response->setJsonContent($data);
            $this->response->send();
        }
    }

    public function getEquiposAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_personal = $this->request->getPost("id");

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $db = $this->db;
            $sql = "SELECT
            public.view_consulta_recursos_tic.id_personal_area,
            public.view_consulta_recursos_tic.id_personal_area_equipo,
            public.view_consulta_recursos_tic.patrimonial,
            public.view_consulta_recursos_tic.tipo_nombre,
            public.view_consulta_recursos_tic.marca,
            public.view_consulta_recursos_tic.modelo,
            public.view_consulta_recursos_tic.serie,
            public.view_consulta_recursos_tic.color,
            public.view_consulta_recursos_tic.id_personal
            FROM
            public.view_consulta_recursos_tic
            WHERE
            public.view_consulta_recursos_tic.id_personal = $id_personal";

            $data = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);

            // foreach ($data as $key => $value) {
            //     echo "<pre>";
            //     print($value->nombres);
            // }
            // exit();

            $this->response->setJsonContent($data);
            $this->response->send();
        }
    }
}
