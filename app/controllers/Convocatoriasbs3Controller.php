<?php

class Convocatoriasbs3Controller extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/convocatoriasbs3.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null, $id_detalle = null) {
        $this->view->id = $id;
        if ($id != null) {
            $convocatoriasbs = ConvocatoriasBs::findFirstByid_convocatoria_bs((int) $id);

            //print($convocatoriasbs->etapa);
            //exit();

            if ($convocatoriasbs->etapa == 3) {
                $activa_btn_docs = 1;
                //print($activa_btn_docs);
                //exit();
            } else {
                $activa_btn_docs = 0;
                ///print($activa_btn_docs);
                //exit();
            }

            $this->view->activa_btn_docs = $activa_btn_docs;
        } else {

            $convocatoriasbs_nuevo = ConvocatoriasBs::count();
            $convocatoriasbs->id_convocatoria_bs = $convocatoriasbs_nuevo + 1;
            $this->view->convocatoriasbs = $convocatoriasbs;
        }

        $this->view->convocatoriasbs = $convocatoriasbs;

        //TipoConvocatoriasbs
        $tipo_convocatoriasbs = TipoConvocatoriasBs::find("estado = 'A' AND numero = 91 ");
        $this->view->tipoconvocatoriasbs = $tipo_convocatoriasbs;


        //EtapasConvocatoriasbs
        $etapas_convocatorias = EtapasConvocatorias::find("estado = 'A' AND numero = 81 ");
        $this->view->etapasconvocatorias = $etapas_convocatorias;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $this->assets->addJs("adminpanel/js/modulos/convocatoriasbs.detalles.js?v=" . uniqid());

    }

    //Funcion guardar
    public function saveAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_convocatoria_bs", "int");
                $ConvocatoriasBs = ConvocatoriasBs::findFirstByid_convocatoria_bs($id);
                //Valida cuando es nuevo
                $ConvocatoriasBs = (!$ConvocatoriasBs) ? new Convocatoriasbs() : $ConvocatoriasBs;

                //id_convocatoria_bs
                $ConvocatoriasBs->id_convocatoria_bs = $this->request->getPost("id_convocatoria_bs", "int");

                //fecha_hora
                if ($this->request->getPost("tipo", "int") == "") {
                    $ConvocatoriasBs->tipo = null;
                } else {
                    $ConvocatoriasBs->tipo = $this->request->getPost("tipo", "int");
                }

                if ($this->request->getPost("etapa", "int") == "") {
                    $ConvocatoriasBs->etapa = null;
                } else {
                    $ConvocatoriasBs->etapa = $this->request->getPost("etapa", "int");
                }

                //titular
                $ConvocatoriasBs->titulo = $this->request->getPost("titulo", "string");

                //texto_muestra
                $ConvocatoriasBs->texto_muestra = $this->request->getPost("texto_muestra", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ConvocatoriasBs->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $ConvocatoriasBs->enlace = $this->request->getPost("enlace", "string");

                //estado
                $ConvocatoriasBs->estado = "A";

                //fecha_boton_inicio
                if ($this->request->getPost("fecha_boton_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_boton_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ConvocatoriasBs->fecha_boton_inicio = date('Y-m-d', strtotime($fecha_new));
                }


                //fecha_boton_fin
                if ($this->request->getPost("fecha_boton_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_boton_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ConvocatoriasBs->fecha_boton_fin = date('Y-m-d', strtotime($fecha_new));
                }





                if ($ConvocatoriasBs->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasBs->getMessages());
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


                                        if (isset($ConvocatoriasBs->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/convocatoriasbs/' . $ConvocatoriasBs->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/convocatoriasbs/' . 'IMG' . '-' . $ConvocatoriasBs->id_convocatoria_bs . '-' . $temporal_rand . "." . $extension;
                                            $ConvocatoriasBs->imagen = 'IMG' . '-' . $ConvocatoriasBs->id_convocatoria_bs . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/convocatoriasbs/' . 'IMG' . '-' . $ConvocatoriasBs->id_convocatoria_bs . '.' . $extension;
                                            $ConvocatoriasBs->imagen = 'IMG' . '-' . $ConvocatoriasBs->id_convocatoria_bs . '.' . $extension;
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
                            if ($file->getKey() == "archivo_convocatoria") {
                                if ($_FILES['archivo_convocatoria']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_convocatoria']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasBs->archivo)) {
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs/' . $ConvocatoriasBs->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs/' . 'FILE' . '-' . $ConvocatoriasBs->id_convocatoria_bs . '-' . $temporal_rand . "." . $extension;
                                            $ConvocatoriasBs->archivo = 'FILE' . '-' . $ConvocatoriasBs->id_convocatoria_bs . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs/' . 'FILE' . '-' . $ConvocatoriasBs->id_convocatoria_bs . "." . $extension;
                                            $ConvocatoriasBs->archivo = 'FILE' . '-' . $ConvocatoriasBs->id_convocatoria_bs . "." . $extension;
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

                        $ConvocatoriasBs->save();
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

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convbs.id_convocatoria_bs");
            $datatable->setSelect("convbs.id_convocatoria_bs,"
                    . "aco.nombres as tipo_resolucion, "
                    . "convbs.titulo, convbs.texto_muestra, "
                    . "convbs.fecha_hora, convbs.archivo, "
                    . "convbs.imagen, convbs.enlace, "
                    . "convbs.estado, convbs.etapa");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("tbl_web_convocatorias_bs convbs
                INNER JOIN a_codigos aco ON CAST (convbs.tipo AS INTEGER) = aco.codigo
                ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("convbs.estado = 'A' AND aco.numero = 72");
            $datatable->setWhere("aco.numero = 91");
            $datatable->setOrderby("convbs.id_convocatoria_bs DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Convocatoriasbs = ConvocatoriasBs::findFirstByid_convocatoria_bs((int) $this->request->getPost("id", "int"));

            //echo '<pre>';
            //print_r($Convocatoriasbs->id_convocatoria_bs);
            //exit();

            if ($Convocatoriasbs && $Convocatoriasbs->estado = 'A') {
                $Convocatoriasbs->estado = 'X';
                $Convocatoriasbs->save();
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

    //datatables archivos
    public function datatableArchivosAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convbs_detalle.id_convocatoria_bs_detalle");
            $datatable->setSelect("convbs_detalle.id_convocatoria_bs_detalle, "
                    . "convbs_detalle.titulo, convbs_detalle.fecha_hora, "
                    . "convbs_detalle.enlace, convbs_detalle.archivo, "
                    . "convbs_detalle.estado");
            $datatable->setFrom("tbl_web_convocatorias_bs_detalles convbs_detalle");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            $datatable->setWhere("convbs_detalle.id_convocatoria_bs = $id");
            $datatable->setOrderby("convbs_detalle.id_convocatoria_bs_detalle DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function savearchivoAction() {


//        $info = new SplFileInfo('foo.txt');
//        echo "<pre>";
//        print_r(var_dump($info->getExtension()));
//        exit();
//        
//        
        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_convocatoria_bs_detalle", "int");
                $ConvocatoriasBsDetalles = ConvocatoriasBsDetalles::findFirstByid_convocatoria_bs_detalle($id);
                $ConvocatoriasBsDetalles = (!$ConvocatoriasBsDetalles) ? new ConvocatoriasBsDetalles() : $ConvocatoriasBsDetalles;

//                $ConvocatoriasBsDetalles->id_convocatoria_bs_detalle = $this->request->getPost("id_convocatoria_bs_detalle", "int");
//
//                echo "<pre>";
//                print_r($ConvocatoriasBsDetalles->id_convocatoria_bs_detalle);
//                exit();

                $ConvocatoriasBsDetalles->id_convocatoria_bs = $this->request->getPost("id_convocatoria_bs", "int");
                //titular
                $ConvocatoriasBsDetalles->titulo = $this->request->getPost("titulo_detalle", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_detalle", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_detalle", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ConvocatoriasBsDetalles->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $ConvocatoriasBsDetalles->enlace = $this->request->getPost("enlace_detalle", "string");

                //estado_detalle
                $ConvocatoriasBsDetalles->estado = "A";


                if ($ConvocatoriasBsDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasBsDetalles->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "archivo_convocatoria_bs_detalle") {
                                if ($_FILES['archivo_convocatoria_bs_detalle']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_convocatoria_bs_detalle']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasBsDetalles->archivo)) {
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs/' . $ConvocatoriasBsDetalles->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs/' . 'FILE' . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs_detalle . '-' . $temporal_rand . "." . $extension;
                                            $ConvocatoriasBsDetalles->archivo = 'FILE' . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs_detalle . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs/' . 'FILE' . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs_detalle . "." . $extension;
                                            $ConvocatoriasBsDetalles->archivo = 'FILE' . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs . '-' . $ConvocatoriasBsDetalles->id_convocatoria_bs_detalle . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_convocatoria_detalle") {
                                
                            }
                        }

                        $ConvocatoriasBsDetalles->save();
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

    //Editar archivos
    public function getAjaxArchivosAction() {
//        echo '<pre>';
//        print_r($_POST);
//        exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ConvocatoriasBsDetalles::findFirstByid_convocatoria_bs_detalle((int) $this->request->getPost("id", "int"));
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

    public function eliminarDetalleAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $ConvocatoriasbsDetalle = ConvocatoriasBsDetalles::findFirstByid_convocatoria_bs_detalle((int) $this->request->getPost("id", "int"));

            //echo '<pre>';
            //print_r($ConvocatoriasbsDetalle->id_convocatoria_bs_detalle);
            //exit();

            if ($ConvocatoriasbsDetalle && $ConvocatoriasbsDetalle->estado = 'A') {
                $ConvocatoriasbsDetalle->estado = 'X';
                $ConvocatoriasbsDetalle->save();
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
