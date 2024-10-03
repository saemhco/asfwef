<?php

class Convocatorias1Controller extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/convocatorias1.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null, $id_detalle = null) {
        $this->view->id = $id;
        if ($id != null) {
            $convocatorias = Convocatorias::findFirstByid_convocatoria((int) $id);

            //print($convocatorias->etapa);
            //exit();

            if ($convocatorias->etapa == 3) {
                $activa_btn_docs = 1;
                //print($activa_btn_docs);
                //exit();
            } else {
                $activa_btn_docs = 0;
                //print($activa_btn_docs);
                //exit();
            }

            $this->view->activa_btn_docs = $activa_btn_docs;
        } else {

            $convocatorias_nuevo = Convocatorias::count();
            $convocatorias->id_convocatoria = $convocatorias_nuevo + 1;
            $this->view->convocatorias = $convocatorias;
        }

        $this->view->convocatorias = $convocatorias;

        //TipoConvocatorias
        $tipo_convocatorias = TipoConvocatorias::find("estado = 'A' AND numero = 72 ");
        $this->view->tipoconvocatorias = $tipo_convocatorias;


        //EtapasConvocatorias
        $etapas_convocatorias = EtapasConvocatorias::find("estado = 'A' AND numero = 81 ");
        $this->view->etapasconvocatorias = $etapas_convocatorias;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $Usuarios = Usuario::find(
                        [
                            "estado = 'A'",
                        //'order' => 'per_descripcion ASC',
                        ]
        );
        $this->view->usuarios = $Usuarios;

        $this->assets->addJs("adminpanel/js/modulos/convocatorias1.detalles.js?v=" . uniqid());

        //$this->assets->addJs("adminpanel/js/modulos/convocatorias.usuarios.detalles.js?v=" . uniqid());
        //perfiles
        //$this->assets->addJs("adminpanel/js/modulos/convocatorias.perfiles.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_convocatoria", "int");
                $Convocatorias = Convocatorias::findFirstByid_convocatoria($id);
                //Valida cuando es nuevo
                $Convocatorias = (!$Convocatorias) ? new Convocatorias() : $Convocatorias;

                //id_convocatoria
                $Convocatorias->id_convocatoria = $this->request->getPost("id_convocatoria", "int");

                //fecha_hora
                if ($this->request->getPost("tipo", "int") == "") {
                    $Convocatorias->tipo = null;
                } else {
                    $Convocatorias->tipo = $this->request->getPost("tipo", "int");
                }

                if ($this->request->getPost("etapa", "int") == "") {
                    $Convocatorias->etapa = null;
                } else {
                    $Convocatorias->etapa = $this->request->getPost("etapa", "int");
                }

                //titular
                $Convocatorias->titular = $this->request->getPost("titular", "string");

                //texto_muestra
                $Convocatorias->texto_muestra = $this->request->getPost("texto_muestra", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Convocatorias->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $Convocatorias->enlace = $this->request->getPost("enlace", "string");

                //estado
                $Convocatorias->estado = "A";

                //fecha_boton_inicio
                if ($this->request->getPost("fecha_boton_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_boton_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Convocatorias->fecha_boton_inicio = date('Y-m-d', strtotime($fecha_new));
                }


                //fecha_boton_fin
                if ($this->request->getPost("fecha_boton_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_boton_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Convocatorias->fecha_boton_fin = date('Y-m-d', strtotime($fecha_new));
                }





                if ($Convocatorias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Convocatorias->getMessages());
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


                                        if (isset($Convocatorias->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/convocatorias/' . $Convocatorias->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/convocatorias/' . 'IMG' . '-' . $Convocatorias->id_convocatoria . '-' . $temporal_rand . "." . $extension;
                                            $Convocatorias->imagen = 'IMG' . '-' . $Convocatorias->id_convocatoria . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/convocatorias/' . 'IMG' . '-' . $Convocatorias->id_convocatoria . '.' . $extension;
                                            $Convocatorias->imagen = 'IMG' . '-' . $Convocatorias->id_convocatoria . '.' . $extension;
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

                                        if (isset($Convocatorias->archivo)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias/' . $Convocatorias->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias/' . 'FILE' . '-' . $Convocatorias->id_convocatoria . '-' . $temporal_rand . "." . $extension;
                                            $Convocatorias->archivo = 'FILE' . '-' . $Convocatorias->id_convocatoria . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias/' . 'FILE' . '-' . $Convocatorias->id_convocatoria . "." . $extension;
                                            $Convocatorias->archivo = 'FILE' . '-' . $Convocatorias->id_convocatoria . "." . $extension;
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

                        $Convocatorias->save();
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

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("conv.id_convocatoria");
            $datatable->setSelect("conv.id_convocatoria, aco.nombres as tipo_resolucion, conv.titular, conv.texto_muestra, conv.fecha_hora, conv.archivo, conv.imagen, conv.enlace, conv.estado");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("tbl_web_convocatorias conv
                INNER JOIN a_codigos aco ON CAST (conv.tipo AS INTEGER) = aco.codigo
                INNER JOIN tbl_seg_usuarios_detalles usuarios_detalles ON usuarios_detalles.id_tabla = conv.id_convocatoria");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("conv.estado = 'A' AND aco.numero = 72");
            $datatable->setWhere("aco.numero = 72 AND usuarios_detalles.id_usuario ={$id_usuario} AND usuarios_detalles.tabla = 'tbl_web_convocatorias'");
            //exit();
            $datatable->setOrderby("conv.id_convocatoria DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Convocatorias = Convocatorias::findFirstByid_convocatoria((int) $this->request->getPost("id", "int"));

            //echo '<pre>';
            //print_r($Convocatorias->id_convocatoria);
            //exit();

            if ($Convocatorias && $Convocatorias->estado = 'A') {
                $Convocatorias->estado = 'X';
                $Convocatorias->save();
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
            $datatable->setColumnaId("conv_detalle.id_convocatoria_detalle");
            $datatable->setSelect("conv_detalle.id_convocatoria_detalle, conv_detalle.titular, conv_detalle.fecha_hora, conv_detalle.enlace, conv_detalle.archivo, conv_detalle.estado");
            $datatable->setFrom("tbl_web_convocatorias_detalles conv_detalle");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("conv_detalle.id_convocatoria = $id");
            $datatable->setOrderby("conv_detalle.id_convocatoria_detalle DESC");
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
//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_convocatoria_detalle", "int");
                $ConvocatoriasDetalles = ConvocatoriasDetalles::findFirstByid_convocatoria_detalle($id);
                $ConvocatoriasDetalles = (!$ConvocatoriasDetalles) ? new ConvocatoriasDetalles() : $ConvocatoriasDetalles;

//                $ConvocatoriasDetalles->id_convocatoria_detalle = $this->request->getPost("id_convocatoria_detalle", "int");
//
//                echo "<pre>";
//                print_r($ConvocatoriasDetalles->id_convocatoria_detalle);
//                exit();

                $ConvocatoriasDetalles->id_convocatoria = $this->request->getPost("id_convocatoria", "int");
                //titular
                $ConvocatoriasDetalles->titular = $this->request->getPost("titular_detalle", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_detalle", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_detalle", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ConvocatoriasDetalles->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $ConvocatoriasDetalles->enlace = $this->request->getPost("enlace_detalle", "string");

                //estado_detalle
                $ConvocatoriasDetalles->estado = "A";

                if ($ConvocatoriasDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasDetalles->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "imagen_convocatoria_detalle") {

                                if ($_FILES['imagen_convocatoria_detalle']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_convocatoria_detalle']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        //
                                        if (isset($ConvocatoriasDetalles->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/convocatorias/' . $ConvocatoriasDetalles->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/convocatorias/' . 'IMG' . '-' . $ConvocatoriasDetalles->id_convocatoria . '-' . $ConvocatoriasDetalles->id_convocatoria_detalle . '-' . $temporal_rand . "." . $extension;
                                            $ConvocatoriasDetalles->imagen = 'IMG' . '-' . $ConvocatoriasDetalles->id_convocatoria . '-' . $ConvocatoriasDetalles->id_convocatoria_detalle . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/convocatorias/' . 'IMG' . '-' . $ConvocatoriasDetalles->id_convocatoria . '-' . $ConvocatoriasDetalles->id_convocatoria_detalle . "." . $extension;
                                            $ConvocatoriasDetalles->imagen = 'IMG' . '-' . $ConvocatoriasDetalles->id_convocatoria . '-' . $ConvocatoriasDetalles->id_convocatoria_detalle . "." . $extension;
                                        }
                                        $file->moveTo($url_destino);
                                        //
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_convocatoria_detalle") {
                                if ($_FILES['archivo_convocatoria_detalle']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_convocatoria_detalle']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasDetalles->archivo)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias/' . $ConvocatoriasDetalles->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias/' . $ConvocatoriasDetalles->enlace . '-' . $temporal_rand . "." . $extension;
                                            $ConvocatoriasDetalles->archivo = $ConvocatoriasDetalles->enlace . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias/' . $ConvocatoriasDetalles->enlace . "." . $extension;
                                            $ConvocatoriasDetalles->archivo = $ConvocatoriasDetalles->enlace . "." . $extension;
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

                        $ConvocatoriasDetalles->save();
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
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ConvocatoriasDetalles::findFirstByid_convocatoria_detalle((int) $this->request->getPost("id", "int"));
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
            $ConvocatoriasDetalle = ConvocatoriasDetalles::findFirstByid_convocatoria_detalle((int) $this->request->getPost("id", "int"));

//            echo '<pre>';
//            print_r($ConvocatoriasDetalle->id_convocatoria_detalle);
//            exit();

            if ($ConvocatoriasDetalle && $ConvocatoriasDetalle->estado = 'A') {
                $ConvocatoriasDetalle->estado = 'X';
                $ConvocatoriasDetalle->save();
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

    //nuevo perfiles
    public function getNuevoPerfilesAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$personal = (int) $this->request->getPost("personal", "int");

            $ConvocatoriasPerfiles = ConvocatoriasPerfiles::count();

            //echo '<pre>';
            //print_r($ConvocatoriasPerfiles);
            //exit();

            if ($ConvocatoriasPerfiles >= 0) {

                $codigo = $ConvocatoriasPerfiles + 1;

                $this->response->setJsonContent(array("say" => "yes", "codigo" => $codigo));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //datatablesPerfiles
    public function datatablesPerfilesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias_perfiles.codigo");
            $datatable->setSelect("convocatorias_perfiles.codigo, "
                    . "convocatorias_perfiles.nombre, "
                    . "convocatorias_perfiles.nombre_corto, "
                    . "convocatorias_perfiles.estado, convocatorias_perfiles.convocatoria");
            $datatable->setFrom("tbl_web_convocatorias_perfiles convocatorias_perfiles");
            $datatable->setWhere("convocatorias_perfiles.convocatoria = $id");
            $datatable->setOrderby("convocatorias_perfiles.codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //savePerfiles
    public function savePerfilesAction() {

//        echo '<pre>';
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $ConvocatoriasPerfiles = ConvocatoriasPerfiles::findFirstBycodigo($id);
                $ConvocatoriasPerfiles = (!$ConvocatoriasPerfiles) ? new ConvocatoriasPerfiles() : $ConvocatoriasPerfiles;

                //codigo
                $ConvocatoriasPerfiles->codigo = $this->request->getPost("codigo_perfiles", "int");

                //convocatoria
                $ConvocatoriasPerfiles->convocatoria = $this->request->getPost("convocatoria", "int");

                //nombre
                $ConvocatoriasPerfiles->nombre = $this->request->getPost("nombre", "string");

                //nombre_corto
                $ConvocatoriasPerfiles->nombre_corto = $this->request->getPost("nombre_corto", "string");

                //formacion_academica
                $ConvocatoriasPerfiles->formacion_academica = $this->request->getPost("formacion_academica");

                //experiencia_laboral_general
                $ConvocatoriasPerfiles->experiencia_laboral_general = $this->request->getPost("experiencia_laboral_general");

                //experiencia_laboral_especifica
                $ConvocatoriasPerfiles->experiencia_laboral_especifica = $this->request->getPost("experiencia_laboral_especifica");

                //competencias
                $ConvocatoriasPerfiles->competencias = $this->request->getPost("competencias");

                //diplomados
                $ConvocatoriasPerfiles->diplomados = $this->request->getPost("diplomados");

                //conocimientos_tecnicos
                $ConvocatoriasPerfiles->conocimientos_tecnicos = $this->request->getPost("conocimientos_tecnicos");

                //condiciones_esenciales
                $ConvocatoriasPerfiles->condiciones_esenciales = $this->request->getPost("condiciones_esenciales");

                //funciones
                $ConvocatoriasPerfiles->funciones = $this->request->getPost("funciones");

                //estado
                $ConvocatoriasPerfiles->estado = 'A';

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    //print($fecha_new);
                    //exit();

                    $hora = $this->request->getPost("hora_inicio", "string");
                    $ConvocatoriasPerfiles->fecha_inicio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                //fecha fin
                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_fin", "string");
                    $ConvocatoriasPerfiles->fecha_fin = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }


                if ($ConvocatoriasPerfiles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPerfiles->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "imagen") {


                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {
                                    if (isset($ConvocatoriasPerfiles->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/imagenes_convocatorias_perfiles/' . $ConvocatoriasPerfiles->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Noticias->nombre;
                                        //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Noticias->codigo . "-" . $file->getName();
                                        $url_destino = 'adminpanel/imagenes/imagenes_convocatorias_perfiles/' . 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '-' . $temporal_rand . '.jpg';
                                        $ConvocatoriasPerfiles->imagen = 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/imagenes_convocatorias_perfiles/' . 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '.jpg';
                                        $ConvocatoriasPerfiles->imagen = 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '.jpg';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();


                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($ConvocatoriasPerfiles->imagen)) {
                                        $url_destino = 'adminpanel/archivos/convocatorias_perfiles/' . $ConvocatoriasPerfiles->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/convocatorias_perfiles/FILE-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '-' . $temporal_rand . '.pdf';
                                        $ConvocatoriasPerfiles->archivo = 'FILE-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/convocatorias_perfiles/FILE-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '.pdf';
                                        $ConvocatoriasPerfiles->archivo = 'FILE-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPerfiles->save();
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

    //edit
    public function getAjaxPerfilesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ConvocatoriasPerfiles::findFirstBycodigo((int) $this->request->getPost("id", "int"));
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

    //delete
    public function eliminarPerfilesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $ConvocatoriasPerfiles = ConvocatoriasPerfiles::findFirstBycodigo((int) $this->request->getPost("id", "int"));


            if ($ConvocatoriasPerfiles && $ConvocatoriasPerfiles->estado = 'A') {
                $ConvocatoriasPerfiles->estado = 'X';
                $ConvocatoriasPerfiles->save();
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

    //--------------------------------perfiles----------------------------------
    public function perfilesAction($convocatoria) {

        $this->view->convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/convocatorias.perfiles.js?v" . uniqid());
    }

    //------------------------------postulantes---------------------------------
    public function postulantesAction($perfil_puesto, $convocatoria) {

//        $auth = $this->session->get('auth');
//        echo '<pre>';
//        print_r($auth);
//        exit();

        $this->view->perfil_puesto = $perfil_puesto;
        $this->view->convocatoria = $convocatoria;

        //grado
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;

        $this->assets->addJs("adminpanel/js/modulos/convocatorias.postulantes.js?v" . uniqid());

        //datos personales   
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //resultado
        $ResultadosConvocatoria = ResultadosConvocatoria::find("estado = 'A' AND numero = 89 ");
        $this->view->resultados_convocatoria = $ResultadosConvocatoria;
    }

    //datatablepostulaciones
    public function datatablePostulaantesAction($perfil, $convocatoria) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, convocatoria, perfil,fullname,anexos, publico,nro_doc");
            $datatable->setFrom("(SELECT
                                    convocatorias_publico.codigo AS codigo,convocatorias_publico.convocatoria AS convocatoria,
                                    convocatorias_publico.publico AS publico, convocatorias_publico.perfil AS perfil,
                                    convocatorias_publico.imagen AS imagen, convocatorias_publico.estado AS estado,
                                    convocatorias_publico.fecha AS fecha, convocatorias_publico.anexos AS anexos,
                                    CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS fullname,
                                    publico.nro_doc AS nro_doc
                                    FROM
                                    tbl_web_convocatorias_publico AS convocatorias_publico 
                                    INNER JOIN publico AS publico ON publico.codigo = convocatorias_publico.publico) AS temporal_table");
            $datatable->setWhere("perfil={$perfil} AND convocatoria = {$convocatoria}");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //getAjaxFormacion
    public function getAjaxPublicoFormacionAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoFormacion = PublicoFormacion::findFirstBypublico((int) $this->request->getPost("id", "int"));
            if ($PublicoFormacion) {
                $this->response->setJsonContent($PublicoFormacion->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //datatablePublicoFormacion
    public function datatablePublicoFormacionAction($publico) {

        //print($publico);
        //exit();

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("formacion.codigo");
            $datatable->setSelect("formacion.codigo, formacion.publico, formacion.grado, "
                    . "formacion.nombre, formacion.fecha_grado, formacion.institucion, formacion.pais, "
                    . "formacion.archivo, formacion.imagen, formacion.estado, grado.nombres AS nombre_grado");
            $datatable->setFrom("tbl_web_publico_formacion formacion INNER JOIN a_codigos grado ON grado.codigo = formacion.grado");
            $datatable->setWhere("grado.numero = 69 AND formacion.publico = {$publico}");
            $datatable->setOrderby("formacion.fecha_grado DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatableCapacitaciones
    public function datatablePublicoCapacitacionesAction($publico) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("capacitaciones.codigo");
            $datatable->setSelect("capacitaciones.codigo, capacitaciones.publico, capacitaciones.capacitacion, "
                    . "capacitaciones.nombre, capacitaciones.fecha_inicio, capacitaciones.fecha_fin, capacitaciones.institucion, "
                    . "capacitaciones.pais, capacitaciones.archivo, capacitaciones.imagen, capacitaciones.estado, capacitacion.nombres AS nombre_capacitacion, "
                    . "capacitaciones.horas, capacitaciones.creditos");
            $datatable->setFrom("tbl_web_publico_capacitaciones capacitaciones INNER JOIN a_codigos capacitacion ON capacitacion.codigo = capacitaciones.capacitacion");
            $datatable->setWhere("capacitaciones.estado = 'A' AND capacitacion.numero = 86 AND capacitaciones.publico = {$publico}");
            $datatable->setOrderby("capacitaciones.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatableExperiencia
    public function datatableExperienciaAction($publico) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("experiencia.codigo");
            $datatable->setSelect("experiencia.codigo, experiencia.publico, experiencia.tipo, "
                    . "experiencia.cargo, experiencia.fecha_inicio, experiencia.fecha_fin, "
                    . "experiencia.tiempo, experiencia.institucion, experiencia.funciones, "
                    . "experiencia.archivo, experiencia.imagen, experiencia.estado, tipo.nombres AS nombre_tipo");
            $datatable->setFrom("tbl_web_publico_experiencia experiencia INNER JOIN a_codigos tipo ON tipo.codigo = experiencia.tipo");
            $datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.publico = {$publico}");
            $datatable->setOrderby("experiencia.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //get funciones campo de Experiencia 
    public function getExperienciaFuncionesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExperiencia = PublicoExperiencia::findFirstBypublico((int) $this->request->getPost("id", "int"));
            if ($PublicoExperiencia) {
                $this->response->setJsonContent($PublicoExperiencia->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //get publico datos
    public function getPublicoDatosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Publico = Publico::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Publico) {
                $this->response->setJsonContent($Publico->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //Liberar postulantes
    public function liberarPostulantesAction() {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $convocatoria = (int) $this->request->getPost("convocatoria", "int");

            $db_update_a_s = $this->db;
            $sql_update_a_s = "UPDATE tbl_web_convocatorias_publico SET estado = 5 WHERE convocatoria = {$convocatoria}";
            $db_update_a_s->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);


            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //saveResultadosConvocatoria
    public function saveResultadosConvocatoriaAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("publico", "int");

                $ConvocatoriasPublicoResultados = ConvocatoriasPublicoResultados::findFirstBypublico($id);

                //print($ConvocatoriasPublicoResultados->publico);
                //exit();

                $ConvocatoriasPublicoResultados->proceso = $this->request->getPost("proceso", "int");

                if ($ConvocatoriasPublicoResultados->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublicoResultados->getMessages());
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

    public function getResultadosConvocatoriasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $ConvocatoriasPublicoResultados = ConvocatoriasPublicoResultados::findFirstBypublico((int) $this->request->getPost("publico", "int"));
            if ($ConvocatoriasPublicoResultados) {
                $this->response->setJsonContent($ConvocatoriasPublicoResultados->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveDocumentosGanadorAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo "<pre>";
            //print_r($_POST);
            //exit();

            $convocatoria = $this->request->getPost("convocatoria", "int");
            //$ConvocatoriasPublico = ConvocatoriasPublico::findFirst((int) $this->request->getPost("convocatoria", "int"));

            $ConvocatoriasPublico = ConvocatoriasPublico::find(
                            [
                                "convocatoria = {$convocatoria} AND proceso = 3"
                            ]
            );




//            if ($ConvocatoriasPublico) {
//                print("Tiene Ganadores");
//                exit();
//            } else {
//                print("No existe ganadores");
//                exit();
//            }


            foreach ($ConvocatoriasPublico as $valueCP) {

                //echo '<pre>';
                //print_r($valueCP->publico);
                //exit();
                //consultamos a la tabla : publico para extraer los datos
                $Publico = Publico::findFirstBycodigo($valueCP->publico);


                //Update convocatorias
                $ConvocatoriasPublico = ConvocatoriasPublicoResultados::findFirstBycodigo($valueCP->codigo);

                //convocatoria
                $convocatoria_update = $ConvocatoriasPublico->convocatoria;

                //perfil
                $perfil_update = $ConvocatoriasPublico->perfil;


                $ConvocatoriasPublico->proceso = 3;



                //copy dni
                $url_dni_publico = 'adminpanel/archivos/publico/personales/' . $Publico->archivo;
                $file_dni = new SplFileInfo($Publico->archivo);
                if ($file_dni->getExtension() == 'png') {

                    $url_dni_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DNI-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                    copy($url_dni_publico, $url_dni_publico_destino);
                    $ConvocatoriasPublico->archivo_dni = "FILE-DNI-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                } else if ($file_dni->getExtension() == 'jpg') {

                    $url_dni_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DNI-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                    copy($url_dni_publico, $url_dni_publico_destino);
                    $ConvocatoriasPublico->archivo_dni = "FILE-DNI-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                } else if ($file_dni->getExtension() == 'jpeg') {

                    $url_dni_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DNI-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                    copy($url_dni_publico, $url_dni_publico_destino);
                    $ConvocatoriasPublico->archivo_dni = "FILE-DNI-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                } else if ($file_dni->getExtension() == 'pdf') {
                    $url_dni_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DNI-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                    copy($url_dni_publico, $url_dni_publico_destino);
                    $ConvocatoriasPublico->archivo_dni = "FILE-DNI-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                }


                //copy ruc
                $url_ruc_publico = 'adminpanel/archivos/publico/personales/' . $Publico->archivo_ruc;
                $file_ruc = new SplFileInfo($Publico->archivo_ruc);
                if ($file_ruc->getExtension() == 'png') {

                    $url_ruc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-RUC-' . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                    copy($url_ruc_publico, $url_ruc_publico_destino);
                    $ConvocatoriasPublico->archivo_ruc = "FILE-RUC-" . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                } else if ($file_ruc->getExtension() == 'jpg') {

                    $url_ruc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-RUC-' . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                    copy($url_ruc_publico, $url_ruc_publico_destino);
                    $ConvocatoriasPublico->archivo_ruc = "FILE-RUC-" . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                } else if ($file_ruc->getExtension() == 'jpeg') {

                    $url_ruc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-RUC-' . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                    copy($url_ruc_publico, $url_ruc_publico_destino);
                    $ConvocatoriasPublico->archivo_ruc = "FILE-RUC-" . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                } else if ($file_ruc->getExtension() == 'pdf') {

                    $url_ruc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-RUC-' . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                    copy($url_ruc_publico, $url_ruc_publico_destino);
                    $ConvocatoriasPublico->archivo_ruc = "FILE-RUC-" . $Publico->nro_ruc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                }

                //copy cp
                $url_cp_publico = 'adminpanel/archivos/publico/personales/' . $Publico->archivo_cp;
                $file_cp = new SplFileInfo($Publico->archivo_cp);
                if ($file_cp->getExtension() == 'png') {

                    $url_cp_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-CP-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                    copy($url_cp_publico, $url_cp_publico_destino);
                    $ConvocatoriasPublico->archivo_profesional = "FILE-CP-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                } else if ($file_cp->getExtension() == 'jpg') {

                    $url_cp_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-CP-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                    copy($url_cp_publico, $url_cp_publico_destino);
                    $ConvocatoriasPublico->archivo_profesional = "FILE-CP-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                } else if ($file_cp->getExtension() == 'jpeg') {

                    $url_cp_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-CP-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                    copy($url_cp_publico, $url_cp_publico_destino);
                    $ConvocatoriasPublico->archivo_profesional = "FILE-CP-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                } else if ($file_cp->getExtension() == 'pdf') {

                    $url_cp_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-CP-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                    copy($url_cp_publico, $url_cp_publico_destino);
                    $ConvocatoriasPublico->archivo_profesional = "FILE-CP-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                }


                //copy dc
                $url_dc_publico = 'adminpanel/archivos/publico/personales/' . $Publico->archivo_dc;
                $file_dc = new SplFileInfo($Publico->archivo_dc);
                if ($file_dc->getExtension() == 'png') {

                    $url_dc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DC-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                    copy($url_dc_publico, $url_dc_publico_destino);
                    $ConvocatoriasPublico->archivo_discapacidad = "FILE-DC-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".png";
                } else if ($file_dc->getExtension() == 'jpg') {

                    $url_dc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DC-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                    copy($url_dc_publico, $url_dc_publico_destino);
                    $ConvocatoriasPublico->archivo_discapacidad = "FILE-DC-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpg";
                } else if ($file_dc->getExtension() == 'jpeg') {

                    $url_dc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DC-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                    copy($url_dc_publico, $url_dc_publico_destino);
                    $ConvocatoriasPublico->archivo_discapacidad = "FILE-DC-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".jpeg";
                } else if ($file_dc->getExtension() == 'pdf') {

                    $url_dc_publico_destino = 'adminpanel/archivos/convocatorias/documentos/personales/FILE-DC-' . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                    copy($url_dc_publico, $url_dc_publico_destino);
                    $ConvocatoriasPublico->archivo_discapacidad = "FILE-DC-" . $Publico->nro_doc . "-" . $ConvocatoriasPublico->convocatoria . "-" . $ConvocatoriasPublico->perfil . ".pdf";
                }

                $ConvocatoriasPublico->save();


                //consultamos a PublicoFormacion para extraer el nombre del archivo
                $PublicoFormacion = PublicoFormacion::find(
                                [
                                    "publico = {$valueCP->publico} AND estado = 'A'"
                                ]
                );

                foreach ($PublicoFormacion as $valuePF) {
                    //echo '<pre>';
                    //print_r($valuePF->codigo);


                    $ConvocatoriasPublicoFormacion = new ConvocatoriasPublicoFormacion();
                    $ConvocatoriasPublicoFormacion->publico = $valuePF->publico;
                    $ConvocatoriasPublicoFormacion->grado = $valuePF->grado;
                    $ConvocatoriasPublicoFormacion->nombre = $valuePF->nombre;
                    $ConvocatoriasPublicoFormacion->fecha_grado = $valuePF->fecha_grado;
                    $ConvocatoriasPublicoFormacion->institucion = $valuePF->institucion;
                    $ConvocatoriasPublicoFormacion->pais = $valuePF->pais;

                    if ($ConvocatoriasPublicoFormacion->save() == false) {
                        //print("Error save Formacion");
                        //exit();
                    } else {
                        //sin error
                        //$url_archivo_actual
                        $url_archivo_actual = 'adminpanel/archivos/publico/formacion/' . $valuePF->archivo;
                        $file_formacion = new SplFileInfo($valuePF->archivo);
                        if ($file_formacion->getExtension() == 'png') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/formacion/FILE-' . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".png";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoFormacion->archivo = "FILE-" . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".png";
                        } else if ($file_formacion->getExtension() == 'jpg') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/formacion/FILE-' . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".jpg";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoFormacion->archivo = "FILE-" . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".jpg";
                        } else if ($file_formacion->getExtension() == 'jpeg') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/formacion/FILE-' . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".jpeg";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoFormacion->archivo = "FILE-" . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".jpeg";
                        } else if ($file_formacion->getExtension() == 'pdf') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/formacion/FILE-' . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".pdf";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoFormacion->archivo = "FILE-" . $valuePF->nro_doc . "-" . $ConvocatoriasPublicoFormacion->codigo . ".pdf";
                        }

                        $ConvocatoriasPublicoFormacion->imagen = $valuePF->imagen;
                        $ConvocatoriasPublicoFormacion->estado = $valuePF->estado;
                        $ConvocatoriasPublicoFormacion->nro_doc = $valuePF->nro_doc;
                        //convocatoria
                        $ConvocatoriasPublicoFormacion->convocatoria = $convocatoria_update;
                        //perfil
                        $ConvocatoriasPublicoFormacion->perfil = $perfil_update;


                        $ConvocatoriasPublicoFormacion->save();
                    }
                }

                //consultamos a PublicoCapacitaciones para extraer el nombre del archivo
                $PublicoCapacitaciones = PublicoCapacitaciones::find(
                                [
                                    "publico = {$valueCP->publico} AND estado = 'A'"
                                ]
                );

                foreach ($PublicoCapacitaciones as $valuePC) {
                    //echo '<pre>';
                    //print_r($valuePF->codigo);
                    $ConvocatoriasPublicoCapacitaciones = new ConvocatoriasPublicoCapacitaciones();
                    $ConvocatoriasPublicoCapacitaciones->publico = $valuePC->publico;
                    $ConvocatoriasPublicoCapacitaciones->capacitacion = $valuePC->capacitacion;
                    $ConvocatoriasPublicoCapacitaciones->nombre = $valuePC->nombre;
                    $ConvocatoriasPublicoCapacitaciones->fecha_inicio = $valuePC->fecha_inicio;
                    $ConvocatoriasPublicoCapacitaciones->fecha_fin = $valuePC->fecha_fin;
                    $ConvocatoriasPublicoCapacitaciones->institucion = $valuePC->institucion;
                    $ConvocatoriasPublicoCapacitaciones->pais = $valuePC->pais;


                    if ($ConvocatoriasPublicoCapacitaciones->save() == false) {
                        //print("Error save Capacitaciones");
                        //exit();
                    } else {
                        //sin error
                        //$url_archivo_actual
                        $url_archivo_actual = 'adminpanel/archivos/publico/capacitaciones/' . $valuePC->archivo;
                        $file_capacitaciones = new SplFileInfo($valuePC->archivo);
                        if ($file_capacitaciones->getExtension() == 'png') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/capacitaciones/FILE-' . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".png";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoCapacitaciones->archivo = "FILE-" . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".png";
                        } else if ($file_capacitaciones->getExtension() == 'jpg') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/capacitaciones/FILE-' . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".jpg";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoCapacitaciones->archivo = "FILE-" . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".jpg";
                        } else if ($file_capacitaciones->getExtension() == 'jpeg') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/capacitaciones/FILE-' . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".jpeg";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoCapacitaciones->archivo = "FILE-" . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".jpeg";
                        } else if ($file_capacitaciones->getExtension() == 'pdf') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/capacitaciones/FILE-' . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".pdf";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoCapacitaciones->archivo = "FILE-" . $valuePC->nro_doc . "-" . $ConvocatoriasPublicoCapacitaciones->codigo . ".pdf";
                        }

                        $ConvocatoriasPublicoCapacitaciones->imagen = $valuePC->imagen;
                        $ConvocatoriasPublicoCapacitaciones->estado = $valuePC->estado;
                        $ConvocatoriasPublicoCapacitaciones->horas = $valuePC->horas;
                        $ConvocatoriasPublicoCapacitaciones->creditos = $valuePC->creditos;
                        $ConvocatoriasPublicoCapacitaciones->nro_doc = $valuePC->nro_doc;
                        //convocatoria
                        $ConvocatoriasPublicoCapacitaciones->convocatoria = $convocatoria_update;
                        //perfil
                        $ConvocatoriasPublicoCapacitaciones->perfil = $perfil_update;
                        $ConvocatoriasPublicoCapacitaciones->save();
                    }
                }


                //consultamos a PublicoCapacitaciones para extraer el nombre del archivo
                $PublicoExperiencia = PublicoExperiencia::find(
                                [
                                    "publico = {$valueCP->publico} AND estado = 'A'"
                                ]
                );

                foreach ($PublicoExperiencia as $valuePE) {
                    //echo '<pre>';
                    //print_r($valuePF->codigo);
                    $ConvocatoriasPublicoExperiencia = new ConvocatoriasPublicoExperiencia();
                    $ConvocatoriasPublicoExperiencia->publico = $valuePE->publico;
                    $ConvocatoriasPublicoExperiencia->tipo = $valuePE->tipo;
                    $ConvocatoriasPublicoExperiencia->cargo = $valuePE->cargo;
                    $ConvocatoriasPublicoExperiencia->fecha_inicio = $valuePE->fecha_inicio;
                    $ConvocatoriasPublicoExperiencia->fecha_fin = $valuePE->fecha_fin;
                    $ConvocatoriasPublicoExperiencia->tiempo = $valuePE->tiempo;
                    $ConvocatoriasPublicoExperiencia->institucion = $valuePE->institucion;

                    if ($ConvocatoriasPublicoExperiencia->save() == false) {
                        //print("Error save Experiencia");
                        //exit();
                    } else {
                        //sin error
                        //$url_archivo_actual
                        $url_archivo_actual = 'adminpanel/archivos/publico/experiencia/' . $valuePE->archivo;
                        $file_experiencia = new SplFileInfo($valuePE->archivo);
                        if ($file_experiencia->getExtension() == 'png') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/experiencia/FILE-' . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".png";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoExperiencia->archivo = "FILE-" . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".png";
                        } else if ($file_experiencia->getExtension() == 'jpg') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/experiencia/FILE-' . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".jpg";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoExperiencia->archivo = "FILE-" . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".jpg";
                        } else if ($file_experiencia->getExtension() == 'jpeg') {

                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/experiencia/FILE-' . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".jpeg";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoExperiencia->archivo = "FILE-" . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".jpeg";
                        } else if ($file_experiencia->getExtension() == 'pdf') {
                            $url_archivo_destino = 'adminpanel/archivos/convocatorias/documentos/experiencia/FILE-' . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".pdf";
                            copy($url_archivo_actual, $url_archivo_destino);
                            $ConvocatoriasPublicoExperiencia->archivo = "FILE-" . $valuePE->nro_doc . "-" . $ConvocatoriasPublicoExperiencia->codigo . ".pdf";
                        }

                        $ConvocatoriasPublicoExperiencia->imagen = $valuePE->imagen;
                        $ConvocatoriasPublicoExperiencia->estado = $valuePE->estado;
                        $ConvocatoriasPublicoExperiencia->funciones = $valuePE->funciones;
                        $ConvocatoriasPublicoExperiencia->nro_doc = $valuePE->nro_doc;

                        //convocatoria
                        $ConvocatoriasPublicoExperiencia->convocatoria = $convocatoria_update;
                        //perfil
                        $ConvocatoriasPublicoExperiencia->perfil = $perfil_update;

                        $ConvocatoriasPublicoExperiencia->save();
                    }
                }

                //exit();
            }
            //exit();


            if ($ConvocatoriasPublico) {
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
    public function transferenciaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $Publico = Publico::find();
            foreach ($Publico as $valuePublico) {
                $valuePublico->codigo;

                $TablaOrigen = TablaOrigen::find(
                                [
                                    "publico = {$valuePublico->codigo} AND estado = 'A'"
                                ]
                );

                foreach ($TablaOrigen as $valueTO) {
                    //echo '<pre>';
                    //print_r($valuePF->codigo);
                    $TablaDestino = new TablaDestino();
                    $TablaDestino->publico = $valueTO->publico;
                    $TablaDestino->tipo = $valueTO->tipo;
                    $TablaDestino->cargo = $valueTO->cargo;
                    $TablaDestino->fecha_inicio = $valueTO->fecha_inicio;
                    $TablaDestino->fecha_fin = $valueTO->fecha_fin;
                    $TablaDestino->tiempo = $valueTO->tiempo;
                    $TablaDestino->institucion = $valueTO->institucion;

                    if ($TablaDestino->save() == false) {
                        //print("Error save");
                        //exit();
                    } else {

                        $url_archivo_actual = 'adminpanel/archivos/publico/experiencia1/' . $valueTO->archivo;
                        if (file_exists($url_archivo_actual)) {
                            //echo "El fichero $nombre_fichero existe";
                            $url_archivo_actual = 'adminpanel/archivos/publico/experiencia1/' . $valueTO->archivo;
                            $url_archivo_destino = 'adminpanel/archivos/publico/experiencia/' . $valueTO->archivo;
                            copy($url_archivo_actual, $url_archivo_destino);
                            $TablaDestino->archivo = $valueTO->archivo;
                        } else {
                            //echo "El fichero $nombre_fichero no existe";
                            $TablaDestino->archivo = "";
                        }

                        $TablaDestino->imagen = $valueTO->imagen;
                        $TablaDestino->estado = $valueTO->estado;
                        $TablaDestino->funciones = $valueTO->funciones;
                        $TablaDestino->nro_doc = $valueTO->nro_doc;
                        $TablaDestino->save();
                    }
                }
            }



            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

//

    public function saveRegistrarPersonalAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo "<pre>";
            //print_r($_POST);
            //exit();

            $convocatoria = $this->request->getPost("convocatoria", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::find(
                            [
                                "convocatoria = {$convocatoria} AND proceso = 3"
                            ]
            );

            //$nuevo = 1;
            foreach ($ConvocatoriasPublico as $valueCP) {
                //echo '<pre>';
                //print_r($valueCP->publico);
                $publico = Publico::findFirstBycodigo($valueCP->publico);

                //print_r($publico->nombres."-".$publico->nro_doc."<br>");

                $personal = Personal::findFirstBynro_doc($publico->nro_doc);

                if ($personal) {
                    //print_r($personal->nombres . "<br>");
                } else {
                    //print_r("Inicia save " . $nuevo . "<br>");
                    //$nuevo++;
                    $id_count = Personal::count();
                    $id_personal = $id_count + 1;
                    //print($id_personal);
                    //exit();
                    $Personal = new Personal();
                    $Personal->codigo = $id_personal;
                    $Personal->apellidop = $publico->apellidop;
                    $Personal->apellidom = $publico->apellidom;
                    $Personal->nombres = $publico->nombres;
                    $Personal->fecha_nacimiento = $publico->fecha_nacimiento;
                    $Personal->documento = $publico->documento;
                    $Personal->nro_doc = $publico->nro_doc;
                    $Personal->celular = $publico->celular;
                    $Personal->email = $publico->email;
                    $Personal->direccion_actual = $publico->direccion;
                    $Personal->visible = 1;
                    $Personal->password = $publico->password;
                    $Personal->estado_civil = $publico->estado_civil;
                    $Personal->sexo = $publico->sexo;
                    $Personal->colegio_profesional = $publico->colegio_profesional;
                    $Personal->colegio_profesional_nro = $publico->colegio_profesional_nro;
                    $Personal->archivo = $publico->archivo;
                    $Personal->imagen = $publico->foto;
                    $Personal->estado = "A";
                    $Personal->save();
                }
            }
            //exit();

            if ($ConvocatoriasPublico) {
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

    public function getAjaxPermisoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));

            $id_tabla = (int) $this->request->getPost("id", "int");

            $obj = UsuariosDetalles::findFirst("tabla = 'tbl_web_convocatorias' AND id_tabla = {$id_tabla}");

            if ($obj->update == '1') {
                //print("update:".$obj->update);
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                //$this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }

}
