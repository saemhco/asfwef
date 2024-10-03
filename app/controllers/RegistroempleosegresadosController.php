<?php

class RegistroempleosegresadosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/registroempleosegresados.js?v=" . uniqid());

        
        $tipocontratos = TipoContratos::find("estado = 'A' AND numero = 47");
        $this->view->tipocontratos = $tipocontratos;

        $cargos = Cargos::find("estado = 'A' AND numero = 45");
        $this->view->cargos = $cargos;

        $jornadas = Jornadas::find("estado = 'A' AND numero = 46");
        $this->view->jornadas = $jornadas;

        $seeEmpleos = Empresas::find("estado = 'A'");
        $this->view->empresas = $seeEmpleos;

        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;
    }

    public function saveAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        //echo "<pre>";
        //print_r($_FILES);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $id = (int) $this->request->getPost("id_empleo", "int");
                $seeEmpleos = SeeEmpleos::findFirstByid_empleo($id);
                $seeEmpleos = (!$seeEmpleos) ? new SeeEmpleos() : $seeEmpleos;

                $seeEmpleos->id_tipocontrato = $this->request->getPost("id_tipocontrato", "int");
                $seeEmpleos->id_cargo = $this->request->getPost("id_cargo", "int");
                $seeEmpleos->id_jornada = $this->request->getPost("id_jornada", "int");
                $seeEmpleos->id_empresa = $this->request->getPost("id_empresa", "int");

                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $seeEmpleos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $seeEmpleos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $seeEmpleos->titulo = $this->request->getPost("titulo", "string");
                $seeEmpleos->descripcion = $this->request->getPost("descripcion", "string");
                $seeEmpleos->remuneracion = $this->request->getPost("remuneracion", "string");
                $seeEmpleos->ciudad = $this->request->getPost("ciudad", "string");
                $seeEmpleos->ubigeo_id = $this->request->getPost("ubigeo_id", "int");
                $seeEmpleos->region_id = $this->request->getPost("region_id", "string");
                $seeEmpleos->provincia_id = $this->request->getPost("provincia_id", "string");
                $seeEmpleos->distrito_id = $this->request->getPost("distrito_id", "string");

                $auth = $this->session->get('auth');
                $idalumno = $auth["codigo"];

                $seeEmpleos->id_alumno  = $idalumno;
                
                $seeEmpleos->estado = "A";

                if ($seeEmpleos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($seeEmpleos->getMessages());
                } else {
                    //Cuando va bien                  
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_empleo") {
                                if ($_FILES['imagen_empleo']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_empleo']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {
                                        if (isset($seeEmpleos->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/egresados/empleos/' . $seeEmpleos->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/egresados/empleos/' . 'IMG' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                            $seeEmpleos->imagen = 'IMG' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/egresados/empleos/' . 'IMG' . '-' . $seeEmpleos->id_empleo . '.' . $extension;
                                            $seeEmpleos->imagen = 'IMG' . '-' . $seeEmpleos->id_empleo . '.' . $extension;
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
                            if ($file->getKey() == "archivo_empleo") {

                                if ($_FILES['archivo_empleo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_empleo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($seeEmpleos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/egresados/empleos/' . $seeEmpleos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/egresados/empleos/' . 'FILE' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                            $seeEmpleos->archivo = 'FILE' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/egresados/empleos/' . 'FILE' . '-' . $seeEmpleos->id_empleo . "." . $extension;
                                            $seeEmpleos->archivo = 'FILE' . '-' . $seeEmpleos->id_empleo . "." . $extension;
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

                        $seeEmpleos->save();
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


    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $seeEmpleos = SeeEmpleos::findFirstByid_empleo((int) $this->request->getPost("id", "int"));
            if ($seeEmpleos) {
                $this->response->setJsonContent($seeEmpleos->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }



    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $seeEmpleos = SeeEmpleos::findFirstByid_empleo((int) $this->request->getPost("id", "int"));
            if ($seeEmpleos && $seeEmpleos->estado = 'A') {
                $seeEmpleos->estado = 'X';
                $seeEmpleos->save();
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


    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $idalumno = $auth["codigo"];


            // print($idalumno);
            // exit();

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_empleo");
            $datatable->setSelect("id_empleo, fecha_inicio, fecha_fin, titulo, razon_social, tipocontrato, cargo, jornada, ciudad, estado");
            $datatable->setFrom("(SELECT
            public.tbl_see_empleos.id_empleo,
            to_char(public.tbl_see_empleos.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(public.tbl_see_empleos.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            public.tbl_see_empleos.titulo,
            public.tbl_btr_empresas.razon_social,
            tipo_contrato.nombres AS tipocontrato,
            cargos.nombres AS cargo,
            jornadas.nombres AS jornada,
            public.tbl_see_empleos.ciudad,
            public.tbl_see_empleos.estado
            FROM
            public.tbl_see_empleos
            INNER JOIN public.tbl_btr_empresas ON public.tbl_btr_empresas.id_empresa = public.tbl_see_empleos.id_empresa
            INNER JOIN public.a_codigos AS tipo_contrato ON tipo_contrato.codigo = public.tbl_see_empleos.id_tipocontrato
            INNER JOIN public.a_codigos AS cargos ON cargos.codigo = public.tbl_see_empleos.id_cargo
            INNER JOIN public.a_codigos AS jornadas ON jornadas.codigo = public.tbl_see_empleos.id_jornada
            WHERE
            tipo_contrato.numero = 47 AND
            cargos.numero = 45 AND
            jornadas.numero = 46 AND
            public.tbl_see_empleos.id_alumno = '$idalumno') AS temporal_table");
            $datatable->setOrderby("fecha_inicio ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
