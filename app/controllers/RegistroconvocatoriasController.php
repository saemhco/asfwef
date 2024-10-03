<?php
require_once APP_PATH . '/app/library/pdf.php';
class RegistroconvocatoriasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    //Funcion agregar y editar
    public function registroAction($id = null, $id_detalle = null)
    {
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

        $Pesonal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->personal = $Pesonal;

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.detalles.js?v=" . uniqid());

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.usuarios.detalles.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction()
    {

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

                //titulo
                $Convocatorias->titulo = $this->request->getPost("titulo", "string");

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


                    $hora = $this->request->getPost("hora_boton_inicio", "string");

                    // print("hora: ".$hora);
                    // exit();

                    $Convocatorias->fecha_boton_inicio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                //fecha_boton_fin
                if ($this->request->getPost("fecha_boton_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_boton_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];


                    $hora = $this->request->getPost("hora_boton_fin", "string");
                    $Convocatorias->fecha_boton_fin = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
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
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("conv.id_convocatoria");
            $datatable->setSelect("conv.id_convocatoria, aco.nombres as tipo_resolucion, conv.titulo, conv.texto_muestra, conv.fecha_hora, conv.archivo, conv.imagen, conv.enlace, conv.estado");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("tbl_web_convocatorias conv
                INNER JOIN a_codigos aco ON CAST (conv.tipo AS INTEGER) = aco.codigo
                ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("conv.estado = 'A' AND aco.numero = 72");
            $datatable->setWhere("aco.numero = 72");
            $datatable->setOrderby("conv.id_convocatoria DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
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
    public function datatableArchivosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("conv_detalle.id_convocatoria_detalle");
            $datatable->setSelect("conv_detalle.id_convocatoria_detalle, conv_detalle.titulo, conv_detalle.fecha_hora, conv_detalle.enlace, conv_detalle.archivo, conv_detalle.estado");
            $datatable->setFrom("tbl_web_convocatorias_detalles conv_detalle");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("conv_detalle.id_convocatoria = $id");
            $datatable->setOrderby("conv_detalle.id_convocatoria_detalle DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function savearchivoAction()
    {

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
                //titulo
                $ConvocatoriasDetalles->titulo = $this->request->getPost("titulo_detalle", "string");

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
    public function getAjaxArchivosAction()
    {
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

    public function eliminarDetalleAction()
    {
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
    public function getNuevoPerfilesAction()
    {
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
    public function datatablesPerfilesAction($id)
    {
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
            $datatable->setOrderby("convocatorias_perfiles.nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatablesPerfiles4
    public function datatablesPerfiles4Action($id)
    {
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
            $datatable->setOrderby("convocatorias_perfiles.nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //savePerfiles
    public function savePerfilesAction()
    {

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
                                        $url_destino = 'adminpanel/imagenes/convocatorias_perfiles/' . $ConvocatoriasPerfiles->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/convocatorias_perfiles/' . 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '-' . $temporal_rand . '.jpg';
                                        $ConvocatoriasPerfiles->imagen = 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/convocatorias_perfiles/' . 'IMG' . '-' . $ConvocatoriasPerfiles->convocatoria . '-' . $ConvocatoriasPerfiles->codigo . '.jpg';
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
    public function getAjaxPerfilesAction()
    {
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
    public function eliminarPerfilesAction()
    {
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
    public function perfilesAction($convocatoria)
    {


        $tipoconvocatoria = Convocatorias::findFirstByid_convocatoria((int) $convocatoria);
        $this->view->tipoconvocatoria = $tipoconvocatoria;

        $this->view->convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.perfiles.js?v" . uniqid());
    }

    public function perfiles4Action($convocatoria)
    {


        $tipoconvocatoria = Convocatorias::findFirstByid_convocatoria((int) $convocatoria);
        $this->view->tipoconvocatoria = $tipoconvocatoria;

        $this->view->convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.perfiles4.js?v" . uniqid());
    }

    //------------------------------postulantes---------------------------------
    public function postulantesAction($perfil_puesto, $convocatoria)
    {

        //        $auth = $this->session->get('auth');
        //        echo '<pre>';
        //        print_r($auth);
        //        exit();

        $this->view->perfil_puesto = $perfil_puesto;
        $this->view->convocatoria = $convocatoria;

        //grado
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.postulantes.js?v" . uniqid());

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
    public function datatablePostulaantesAction($perfil, $convocatoria)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, convocatoria, perfil,fullname,anexos, publico,nro_doc, fecha");
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
    public function getAjaxPublicoFormacionAction()
    {
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
    public function datatablePublicoFormacionAction($publico)
    {

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
            $datatable->setWhere("grado.numero = 69 AND formacion.publico = {$publico} AND formacion.estado ='A'");
            $datatable->setOrderby("formacion.fecha_grado DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatablePublicoExcepciones
    public function datatablePublicoExcepcionesAction($publico)
    {

        //print($publico);
        //exit();

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,id_tipo_excepcion,nombre,fecha_excepcion,institucion,archivo,imagen,estado,nro_doc,tipo_publicacion");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_excepciones.codigo,
            public.tbl_web_publico_excepciones.publico,
            public.tbl_web_publico_excepciones.id_tipo_excepcion,
            public.tbl_web_publico_excepciones.nombre,
            to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
            public.tbl_web_publico_excepciones.institucion,
            public.tbl_web_publico_excepciones.archivo,
            public.tbl_web_publico_excepciones.imagen,
            public.tbl_web_publico_excepciones.estado,
            public.tbl_web_publico_excepciones.nro_doc,
            tipodepublicaciones.nombres AS tipo_publicacion
            FROM
            public.tbl_web_publico_excepciones
            INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
            WHERE
            tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_excepcion DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatableCapacitaciones
    public function datatablePublicoCapacitacionesAction($publico)
    {
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

    public function datatablePublicoPublicacionesAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,id_tipo_publicacion,nombre,fecha_publicacion,doi,pais,archivo,imagen,estado,nro_paginas,nro_doc,tipo_publicacion");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_publicaciones.codigo,
            public.tbl_web_publico_publicaciones.publico,
            public.tbl_web_publico_publicaciones.id_tipo_publicacion,
            public.tbl_web_publico_publicaciones.nombre,
            to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
            public.tbl_web_publico_publicaciones.doi,
            public.tbl_web_publico_publicaciones.pais,
            public.tbl_web_publico_publicaciones.archivo,
            public.tbl_web_publico_publicaciones.imagen,
            public.tbl_web_publico_publicaciones.estado,
            public.tbl_web_publico_publicaciones.nro_paginas,
            public.tbl_web_publico_publicaciones.nro_doc,
            tipo_de_publicaciones.nombres AS tipo_publicacion
            FROM
            public.a_codigos AS tipo_de_publicaciones
            INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
            WHERE
            tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_publicacion DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatablePublicoCargosAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_cargo,tipo_institucion,nombre,institucion,fecha_inicio,fecha_fin,archivo, estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_cargos.codigo,
            public.tbl_web_publico_cargos.tipo_institucion,
            public.tbl_web_publico_cargos.nombre,
            public.tbl_web_publico_cargos.institucion,
            public.tbl_web_publico_cargos.fecha_inicio,
            public.tbl_web_publico_cargos.fecha_fin,
            public.tbl_web_publico_cargos.archivo,
            public.tbl_web_publico_cargos.estado,
            tipodecargos.nombres AS tipo_cargo
            FROM
            public.tbl_web_publico_cargos
            INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
            WHERE
            tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatablePublicoMaterialesAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,tipo_material,publico,nombre,fecha,archivo,imagen,estado,id_tipo_material,nro_doc");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_materiales.codigo,
            tipo_de_materiales.nombres AS tipo_material,
            public.tbl_web_publico_materiales.publico,
            public.tbl_web_publico_materiales.id_tipo_material,
            public.tbl_web_publico_materiales.nombre,
            to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_materiales.archivo,
            public.tbl_web_publico_materiales.imagen,
            public.tbl_web_publico_materiales.nro_doc,
            public.tbl_web_publico_materiales.estado
            FROM
            public.a_codigos AS tipo_de_materiales
            INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
            WHERE
            tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatablePublicoIdiomasAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_idioma,publico,id_tipo_idioma,nombre,fecha_inicio,fecha_fin,institucion,pais,id_nivel,horas,creditos,archivo,imagen,nro_doc,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_idiomas.codigo,
            tipodeidiomas.nombres AS tipo_idioma,
            public.tbl_web_publico_idiomas.publico,
            public.tbl_web_publico_idiomas.id_tipo_idioma,
            public.tbl_web_publico_idiomas.nombre,
            public.tbl_web_publico_idiomas.fecha_inicio,
            public.tbl_web_publico_idiomas.fecha_fin,
            public.tbl_web_publico_idiomas.institucion,
            public.tbl_web_publico_idiomas.pais,
            public.tbl_web_publico_idiomas.id_nivel,
            public.tbl_web_publico_idiomas.horas,
            public.tbl_web_publico_idiomas.creditos,
            public.tbl_web_publico_idiomas.archivo,
            public.tbl_web_publico_idiomas.imagen,
            public.tbl_web_publico_idiomas.nro_doc,
            public.tbl_web_publico_idiomas.estado
            FROM
            public.a_codigos AS tipodeidiomas
            INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
            WHERE
            tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function datatablePublicoOfimaticaAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_ofimatica,publico,id_tipo_ofimatica,nombre,fecha_inicio,fecha_fin,institucion,pais,id_nivel,horas,creditos,archivo,imagen,nro_doc,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_ofimaticas.codigo,
            tipodeofimaticas.nombres AS tipo_ofimatica,
            public.tbl_web_publico_ofimaticas.publico,
            public.tbl_web_publico_ofimaticas.id_tipo_ofimatica,
            public.tbl_web_publico_ofimaticas.nombre,
            public.tbl_web_publico_ofimaticas.fecha_inicio,
            public.tbl_web_publico_ofimaticas.fecha_fin,
            public.tbl_web_publico_ofimaticas.institucion,
            public.tbl_web_publico_ofimaticas.pais,
            public.tbl_web_publico_ofimaticas.id_nivel,
            public.tbl_web_publico_ofimaticas.horas,
            public.tbl_web_publico_ofimaticas.creditos,
            public.tbl_web_publico_ofimaticas.archivo,
            public.tbl_web_publico_ofimaticas.imagen,
            public.tbl_web_publico_ofimaticas.nro_doc,
            public.tbl_web_publico_ofimaticas.estado
            FROM
            public.a_codigos AS tipodeofimaticas
            INNER JOIN public.tbl_web_publico_ofimaticas ON tipodeofimaticas.codigo = public.tbl_web_publico_ofimaticas.id_tipo_ofimatica
            WHERE
            tipodeofimaticas.numero = 144 AND public.tbl_web_publico_ofimaticas.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    /* original ratificación felicitaciones
    public function datatablePublicoFelicitacionesAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_reconocimiento,id_publico,id_tipo_reconocimiento,nombre,institucion,fecha_reconocimiento,pais,archivo,imagen,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_reconocimientos.codigo,
            tipodereconocimientos.nombres AS tipo_reconocimiento,
            public.tbl_web_publico_reconocimientos.id_publico,
            public.tbl_web_publico_reconocimientos.id_tipo_reconocimiento,
            public.tbl_web_publico_reconocimientos.nombre,
            public.tbl_web_publico_reconocimientos.institucion,
            public.tbl_web_publico_reconocimientos.fecha_reconocimiento,            
            public.tbl_web_publico_reconocimientos.pais,
            public.tbl_web_publico_reconocimientos.archivo,
            public.tbl_web_publico_reconocimientos.imagen,            
            public.tbl_web_publico_reconocimientos.estado
            FROM
            public.a_codigos AS tipodereconocimientos
            INNER JOIN public.tbl_web_publico_reconocimientos ON tipodereconocimientos.codigo = public.tbl_web_publico_reconocimientos.id_tipo_reconocimiento
            WHERE
            tipodereconocimientos.numero = 137 AND public.tbl_web_publico_reconocimientos.id_publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_reconocimiento DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    */

    /* ditincionesw concurso docente*/
    public function datatablePublicoFelicitacionesAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_reconocimiento,id_publico,nombre,fecha_reconocimiento,archivo,imagen,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_distinciones.codigo,
            tipodistinciones.nombres AS tipo_reconocimiento,
            public.tbl_web_publico_distinciones.publico as id_publico,            
            public.tbl_web_publico_distinciones.nombre,            
            public.tbl_web_publico_distinciones.fecha as fecha_reconocimiento,                        
            public.tbl_web_publico_distinciones.archivo,
            public.tbl_web_publico_distinciones.imagen,            
            public.tbl_web_publico_distinciones.estado
            FROM
            public.a_codigos AS tipodistinciones
            INNER JOIN public.tbl_web_publico_distinciones ON tipodistinciones.codigo = public.tbl_web_publico_distinciones.id_tipo_distincion
            WHERE
            tipodistinciones.numero = 143 AND public.tbl_web_publico_distinciones.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha_reconocimiento DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }



    public function datatablePublicoAsesoriasAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,tipo_grado, publico, id_grado, tesista, fecha, url, archivo, imagen, nro_doc, estado, universidad, tipo_institucion");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_asesorias.codigo,
            tipo_grado.nombres AS tipo_grado,
            public.tbl_web_publico_asesorias.publico,
            public.tbl_web_publico_asesorias.id_grado,
            public.tbl_web_publico_asesorias.tesista,
            to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_asesorias.url,
            public.tbl_web_publico_asesorias.archivo,
            public.tbl_web_publico_asesorias.imagen,
            public.tbl_web_publico_asesorias.nro_doc,
            public.tbl_web_publico_asesorias.estado,
            public.tbl_web_universidades.universidad,
            tipodeinstitucion.nombres AS tipo_institucion
            FROM
            public.tbl_web_publico_asesorias
            INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
            INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
            INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
            WHERE
            tipodeinstitucion.numero = 105 AND
            tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function datatablePublicoExtensionAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,nombre,fecha,archivo,imagen,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_extension.codigo,
            public.tbl_web_publico_extension.publico,
            public.tbl_web_publico_extension.nombre,
            to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_extension.archivo,
            public.tbl_web_publico_extension.imagen,
            public.tbl_web_publico_extension.estado
            FROM
            public.tbl_web_publico_extension
            WHERE
            public.tbl_web_publico_extension.publico = $publico) AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }



    //datatableExperiencia
    public function datatableExperienciaAction($publico)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("experiencia.codigo");
            $datatable->setSelect("experiencia.codigo, experiencia.publico, experiencia.tipo, "
                . "experiencia.cargo, experiencia.fecha_inicio, experiencia.fecha_fin, "
                . "experiencia.tiempo, experiencia.institucion, experiencia.funciones, "
                . "experiencia.archivo, experiencia.imagen, experiencia.estado, tipo.nombres AS nombre_tipo,
                tiposinstituciones.nombres AS tipoinstitucion");
            $datatable->setFrom("tbl_web_publico_experiencia experiencia INNER JOIN a_codigos tipo ON tipo.codigo = experiencia.tipo
            INNER JOIN public.a_codigos AS tiposinstituciones ON tiposinstituciones.codigo = experiencia.tipo_institucion");
            $datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.publico = {$publico} AND tiposinstituciones.numero = 105");
            $datatable->setOrderby("experiencia.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //get funciones campo de Experiencia
    public function getExperienciaFuncionesAction()
    {
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
    public function getPublicoDatosAction()
    {
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
    public function liberarPostulantesAction()
    {

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
    public function saveResultadosConvocatoriaAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = (int) $this->request->getPost("publico", "int");
                $id_convocatoria = (int) $this->request->getPost("convocatoria", "int");


                $ConvocatoriasPublicoResultados = ConvocatoriasPublicoResultados::findFirst("publico = {$id_publico} AND convocatoria = {$id_convocatoria}");

                // print($ConvocatoriasPublicoResultados->publico);
                // exit();

                if ($this->request->getPost("proceso", "int") == "") {
                    $ConvocatoriasPublicoResultados->proceso = null;
                } else {

                    $ConvocatoriasPublicoResultados->proceso = $this->request->getPost("proceso", "int");
                }

                $chk_cv = $this->request->getPost("chk_cv", "string");
                if (isset($chk_cv)) {
                    $ConvocatoriasPublicoResultados->chk_cv = 1;
                } else {
                    $ConvocatoriasPublicoResultados->chk_cv = 0;
                }

                $chk_examen = $this->request->getPost("chk_examen", "string");
                if (isset($chk_examen)) {
                    $ConvocatoriasPublicoResultados->chk_examen = 1;
                } else {
                    $ConvocatoriasPublicoResultados->chk_examen = 0;
                }

                $chk_entrevista = $this->request->getPost("chk_entrevista", "string");
                if (isset($chk_entrevista)) {
                    $ConvocatoriasPublicoResultados->chk_entrevista = 1;
                } else {
                    $ConvocatoriasPublicoResultados->chk_entrevista = 0;
                }

                if ($this->request->getPost("puntaje_cv", "string") == "") {
                    $ConvocatoriasPublicoResultados->puntaje_cv = null;
                } else {

                    $ConvocatoriasPublicoResultados->puntaje_cv = $this->request->getPost("puntaje_cv", "string");
                }

                if ($this->request->getPost("puntaje_examen", "string") == "") {
                    $ConvocatoriasPublicoResultados->puntaje_examen = null;
                } else {

                    $ConvocatoriasPublicoResultados->puntaje_examen = $this->request->getPost("puntaje_examen", "string");
                }

                if ($this->request->getPost("puntaje_entrevista", "string") == "") {
                    $ConvocatoriasPublicoResultados->puntaje_entrevista = null;
                } else {
                    $ConvocatoriasPublicoResultados->puntaje_entrevista = $this->request->getPost("puntaje_entrevista", "string");
                }

                $ConvocatoriasPublicoResultados->observaciones_cv = $this->request->getPost("observaciones_cv", "string");

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

    public function getResultadosConvocatoriasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_publico = (int) $this->request->getPost("publico", "int");
            $id_convocatoria = (int) $this->request->getPost("convocatoria", "int");

            $ConvocatoriasPublicoResultados = ConvocatoriasPublicoResultados::findFirst("publico = {$id_publico} AND convocatoria = {$id_convocatoria}");


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

    public function getResultadosConvocatorias2Action()
    {
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

    public function getResultadosConvocatorias4Action()
    {
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


    public function saveDocumentosGanadorAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $convocatoria = $this->request->getPost("convocatoria", "int");
            //$ConvocatoriasPublico = ConvocatoriasPublico::findFirst((int) $this->request->getPost("convocatoria", "int"));

            $ConvocatoriasPublico = ConvocatoriasPublico::find(
                [
                    "convocatoria = $convocatoria AND proceso = 3",
                ]
            );

            // print("Hola Mundo");
            // exit();

            //    foreach ($ConvocatoriasPublico as $test) {

            //        echo "<pre>";
            //        print_r($test->publico);
            //    }
            //    exit();

            foreach ($ConvocatoriasPublico as $valueCP) {

                // echo '<pre>';
                // print_r($valueCP->publico);
                // exit();
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
                        "publico = {$valueCP->publico} AND estado = 'A'",
                    ]
                );

                foreach ($PublicoFormacion as $valuePF) {
                    // echo '<pre>';
                    // print_r($valuePF->codigo);

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
                        "publico = {$valueCP->publico} AND estado = 'A'",
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
                        "publico = {$valueCP->publico} AND estado = 'A'",
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

    //    public function transferenciaAction() {
    //        $this->view->disable();
    //        if ($this->request->isPost() && $this->request->isAjax()) {
    //
    //            $Publico = Publico::find();
    //            foreach ($Publico as $valuePublico) {
    //                $valuePublico->codigo;
    //
    //                $TablaOrigen = TablaOrigen::find(
    //                                [
    //                                    "publico = {$valuePublico->codigo} AND estado = 'A'"
    //                                ]
    //                );
    //
    //                foreach ($TablaOrigen as $valueTO) {
    //                    //echo '<pre>';
    //                    //print_r($valuePF->codigo);
    //                    $TablaDestino = new TablaDestino();
    //                    $TablaDestino->publico = $valueTO->publico;
    //                    $TablaDestino->tipo = $valueTO->tipo;
    //                    $TablaDestino->cargo = $valueTO->cargo;
    //                    $TablaDestino->fecha_inicio = $valueTO->fecha_inicio;
    //                    $TablaDestino->fecha_fin = $valueTO->fecha_fin;
    //                    $TablaDestino->tiempo = $valueTO->tiempo;
    //                    $TablaDestino->institucion = $valueTO->institucion;
    //
    //                    if ($TablaDestino->save() == false) {
    //                        //print("Error save");
    //                        //exit();
    //                    } else {
    //
    //                        $url_archivo_actual = 'adminpanel/archivos/publico/experiencia1/' . $valueTO->archivo;
    //                        if (file_exists($url_archivo_actual)) {
    //                            //echo "El fichero $nombre_fichero existe";
    //                            $url_archivo_actual = 'adminpanel/archivos/publico/experiencia1/' . $valueTO->archivo;
    //                            $url_archivo_destino = 'adminpanel/archivos/publico/experiencia/' . $valueTO->archivo;
    //                            copy($url_archivo_actual, $url_archivo_destino);
    //                            $TablaDestino->archivo = $valueTO->archivo;
    //                        } else {
    //                            //echo "El fichero $nombre_fichero no existe";
    //                            $TablaDestino->archivo = "";
    //                        }
    //
    //                        $TablaDestino->imagen = $valueTO->imagen;
    //                        $TablaDestino->estado = $valueTO->estado;
    //                        $TablaDestino->funciones = $valueTO->funciones;
    //                        $TablaDestino->nro_doc = $valueTO->nro_doc;
    //                        $TablaDestino->save();
    //                    }
    //                }
    //            }
    //
    //
    //
    //            $this->response->setStatusCode(200, "OK");
    //            $this->response->setJsonContent(array("say" => "yes"));
    //            $this->response->send();
    //        } else {
    //            $this->response->setStatusCode(404);
    //        }
    //    }

    public function saveRegistrarPersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo "<pre>";
            //print_r($_POST);
            //exit();

            $convocatoria = $this->request->getPost("convocatoria", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::find(
                [
                    "convocatoria = {$convocatoria} AND proceso = 3",
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

    public function saveUsuariosDetallesAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_usuario_detalle", "int");
                $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id);
                $UsuariosDetalles = (!$UsuariosDetalles) ? new UsuariosDetalles() : $UsuariosDetalles;

                $UsuariosDetalles->id_usuario = $this->request->getPost("id_usuario", "int");
                $UsuariosDetalles->tabla = "tbl_web_convocatorias";
                $UsuariosDetalles->id_tabla = $this->request->getPost("id_tabla", "int");

                $accion = $this->request->getPost("accion", "string");
                if (isset($accion)) {
                    $UsuariosDetalles->accion = "1";
                } else {
                    $UsuariosDetalles->accion = "0";
                }

                $UsuariosDetalles->estado = "A";
                $UsuariosDetalles->tipo = 3;

                if ($UsuariosDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($UsuariosDetalles->getMessages());
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

    //Editar Usuarios Detalles
    public function getAjaxUsuariosDetallesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = UsuariosDetalles::findFirstByid_usuario_detalle((int) $this->request->getPost("id", "int"));
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

    //Eliminar Usuarios Detalles
    public function eliminarUsuariosDetallesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle((int) $this->request->getPost("id", "int"));

            //            echo '<pre>';
            //            print_r($ConvocatoriasDetalle->id_convocatoria_detalle);
            //            exit();

            if ($UsuariosDetalles && $UsuariosDetalles->estado = 'A') {
                $UsuariosDetalles->estado = 'X';
                $UsuariosDetalles->save();
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

    public function datatableUsuariosDetallesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_usuario_detalle");
            $datatable->setSelect("id_usuario_detalle,apellidos_nombres,estado,id_tabla,accion,tabla,tipo");
            $datatable->setFrom("(SELECT
            usuarios_detalles.id_usuario_detalle AS id_usuario_detalle,
            CONCAT (personal.apellidop, ' ', personal.apellidom, ' ', personal.nombres ) AS apellidos_nombres,
            usuarios_detalles.estado AS estado,
            usuarios_detalles.id_tabla AS id_tabla,
            usuarios_detalles.tabla AS tabla,
            usuarios_detalles.accion AS accion,
            usuarios_detalles.tipo AS tipo
            FROM
            tbl_seg_usuarios_detalles AS usuarios_detalles
            INNER JOIN tbl_web_personal AS personal ON personal.codigo = usuarios_detalles.id_usuario) AS temporal_table");
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_web_convocatorias' AND tipo = 3");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxValidarUsuarioAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));

            //echo '<pre>';
            //print_r($_POST);
            //exit();

            $id_usuario = (int) $this->request->getPost("id_usuario", "int");
            $id_usuario_oculto = (int) $this->request->getPost("id_usuario_oculto", "int");
            $id_tabla = (int) $this->request->getPost("id_tabla", "int");

            if ($id_usuario == $id_usuario_oculto) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_web_convocatorias' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");
                if ($obj) {
                    //print("update:".$obj->update);
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe"));
                    $this->response->send();
                } else {
                    //$this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getArchivosDatosPersonalesAction($publico = null, $datos_personales = null)
    {
        $this->view->disable();
        // print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        // exit();

        //$publico_ganador = Publico::findFirstBycodigo($publico);
        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($datos_personales == "A") {
            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip", ZipArchive::CREATE);
            //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
            //$zip->addEmptyDir($dir);

            if ($publico_file->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo, "1-Datos-" . $publico_file->archivo);
            }

            if ($publico_file->archivo_ruc !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_ruc, "1-Datos-" . $publico_file->archivo_ruc);
            }

            if ($publico_file->archivo_cp !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_cp, "1-Datos-" . $publico_file->archivo_cp);
            }

            if ($publico_file->archivo_dc !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_dc, "1-Datos-" . $publico_file->archivo_dc);
            }

            $zip->close();

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-datos-personales.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
        }
    }
    public function testAction($publico = null, $convocatoria = null, $perfil = null)
    {
        $this->view->disable();

        $zip = new ZipArchive();
        $zip->open("adminpanel/archivos/convocatorias_publico/temporal/datos_completos.zip", ZipArchive::CREATE);

        $publico_file = Publico::findFirstBycodigo($publico);

        $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
            [
                "publico = $publico AND convocatoria = $convocatoria AND perfil = $perfil",
            ]
        );
        /* getArchivosDatosPersonales2*/
        if (true) {
            if (
                $publico_file->archivo_discapacitado !== null ||
                $publico_file->archivo_fa !== null ||
                $publico_file->archivo_dar !== null ||
                $publico_file->archivo_renacyt !== null
            ) {
                if ($publico_file->archivo_discapacitado !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_discapacitado, "1-Datos-" . $publico_file->archivo_discapacitado);
                }
                if ($publico_file->archivo_fa !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_fa, "1-Datos-" . $publico_file->archivo_fa);
                }

                if ($publico_file->archivo_dar !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_dar, "1-Datos-" . $publico_file->archivo_dar);
                }
                if ($publico_file->archivo_renacyt !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_renacyt, "1-Datos-" . $publico_file->archivo_renacyt);
                }
            } else {
                print("No hay archivos existentes");
            }
        }
        /* getArchivosDatosPersonales2*/

        /* getArchivosDatosGenerales*/
        if (true) {
            if ($ConvocatoriasPublico->archivo_solicitud !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_solicitud, "2-Datos-" . $ConvocatoriasPublico->archivo_solicitud);
            }

            if ($ConvocatoriasPublico->archivo_dni !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_dni, "2-Datos-" . $ConvocatoriasPublico->archivo_dni);
            }

            if ($ConvocatoriasPublico->archivo_silabo !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_silabo, "2-Datos-" . $ConvocatoriasPublico->archivo_silabo);
            }

            if ($ConvocatoriasPublico->archivo_dj !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_dj, "2-Datos-" . $ConvocatoriasPublico->archivo_dj);
            }
        }
        /* getArchivosDatosGenerales*/

        /* getArchivosChcti*/
        if (true) {

            if ($ConvocatoriasPublico->archivo_colegiatura !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_colegiatura, "3-Datos-" . $ConvocatoriasPublico->archivo_colegiatura);
            }

            if ($ConvocatoriasPublico->archivo_habilitacion !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_habilitacion, "3-Datos-" . $ConvocatoriasPublico->archivo_habilitacion);
            }

            if ($ConvocatoriasPublico->archivo_cti !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_cti, "3-Datos-" . $ConvocatoriasPublico->archivo_cti);
            }
        }
        /* getArchivosChcti*/

        /* getArchivosExcepciones*/

        if (true) {

            $db = $this->db;
            $sqlQuery = "SELECT
                    public.tbl_web_publico_excepciones.codigo,
                    public.tbl_web_publico_excepciones.publico,
                    public.tbl_web_publico_excepciones.id_tipo_excepcion,
                    public.tbl_web_publico_excepciones.nombre,
                    to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
                    public.tbl_web_publico_excepciones.institucion,
                    public.tbl_web_publico_excepciones.archivo,
                    public.tbl_web_publico_excepciones.imagen,
                    public.tbl_web_publico_excepciones.estado,
                    public.tbl_web_publico_excepciones.nro_doc,
                    tipodepublicaciones.nombres AS tipo_publicacion
                    FROM
                    public.tbl_web_publico_excepciones
                    INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
                    WHERE
                    tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_excepciones.fecha_excepcion DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/excepciones/" . $dataValue->archivo, "4-Excepciones-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosExcepciones*/

        /* getArchivosFormacion2*/

        if (true) {

            $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                        publico_formacion.fecha_grado,
                                                        publico_formacion.archivo
                                                        FROM
                                                        PublicoFormacion publico_formacion
                                                        WHERE
                                                        publico_formacion.estado = 'A'
                                                        AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
            $PublicoFormacionResult = $PublicoFormacionSql->execute();

            $num_file_formacion = 1;
            foreach ($PublicoFormacionResult as $PublicoFormacion) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoFormacion->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "5-Formacion-{$num_file_formacion}-" . $PublicoFormacion->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file_formacion++;
            }
        }
        /* getArchivosFormacion2*/
        /* getArchivosCapacitaciones2*/

        if (true) {


            $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    publico_capacitaciones.fecha_inicio,
                                                    publico_capacitaciones.archivo
                                                    FROM
                                                    PublicoCapacitaciones publico_capacitaciones
                                                    WHERE
                                                    publico_capacitaciones.estado = 'A'
                                                    AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
            $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
                //$ConvocatoriasPublicoFormacion->archivo;

                if ($PublicoCapacitaciones->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "6-Capacitaciones-{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo);
                }
                $num_file_capacitaciones++;
                //test
            }
        }
        /* getArchivosCapacitaciones2*/

        /* getArchivosPublicaciones*/

        if (true) {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_publicaciones.codigo,
            public.tbl_web_publico_publicaciones.publico,
            public.tbl_web_publico_publicaciones.id_tipo_publicacion,
            public.tbl_web_publico_publicaciones.nombre,
            to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
            public.tbl_web_publico_publicaciones.doi,
            public.tbl_web_publico_publicaciones.pais,
            public.tbl_web_publico_publicaciones.archivo,
            public.tbl_web_publico_publicaciones.imagen,
            public.tbl_web_publico_publicaciones.estado,
            public.tbl_web_publico_publicaciones.nro_paginas,
            public.tbl_web_publico_publicaciones.nro_doc,
            tipo_de_publicaciones.nombres AS tipo_publicacion
            FROM
            public.a_codigos AS tipo_de_publicaciones
            INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
            WHERE
            tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_publicaciones.fecha_publicacion DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/publicaciones/" . $dataValue->archivo, "7-Publicaciones-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosPublicaciones*/

        /* getArchivosExperiencia2*/
        if (true) {

            $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                publico_experiencia.fecha_inicio,
                                                publico_experiencia.archivo
                                                FROM
                                                PublicoExperiencia publico_experiencia
                                                WHERE
                                                publico_experiencia.estado = 'A'
                                                AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");
            $PublicoExperienciaResult = $PublicoExperienciaSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoExperiencia->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "8-Experiencia-{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
                }
                $num_file_capacitaciones++;
            }
        }
        /* getArchivosExperiencia2*/

        /* getArchivosCargos*/
        if (true) {
            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_cargos.codigo,
            public.tbl_web_publico_cargos.tipo_institucion,
            public.tbl_web_publico_cargos.nombre,
            public.tbl_web_publico_cargos.institucion,
            public.tbl_web_publico_cargos.fecha_inicio,
            public.tbl_web_publico_cargos.fecha_fin,
            public.tbl_web_publico_cargos.archivo,
            public.tbl_web_publico_cargos.estado,
            tipodecargos.nombres AS tipo_cargo
            FROM
            public.tbl_web_publico_cargos
            INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
            WHERE
            tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.publico = $publico_file->codigo ORDER BY tbl_web_publico_cargos.fecha_fin DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/cargos/" . $dataValue->archivo, "9-Cargos-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosCargos*/

        /* getArchivosMateriales*/
        if (true) {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_materiales.codigo,
            tipo_de_materiales.nombres AS tipo_material,
            public.tbl_web_publico_materiales.publico,
            public.tbl_web_publico_materiales.id_tipo_material,
            public.tbl_web_publico_materiales.nombre,
            to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_materiales.archivo,
            public.tbl_web_publico_materiales.imagen,
            public.tbl_web_publico_materiales.nro_doc,
            public.tbl_web_publico_materiales.estado
            FROM
            public.a_codigos AS tipo_de_materiales
            INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
            WHERE
            tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.publico = $publico_file->codigo ORDER BY tbl_web_publico_materiales.fecha DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/materiales/" . $dataValue->archivo, "10-Materiales-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosMateriales*/

        /* getArchivosIdiomas*/
        if (true) {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_idiomas.codigo,
            tipodeidiomas.nombres AS tipo_idioma,
            public.tbl_web_publico_idiomas.publico,
            public.tbl_web_publico_idiomas.id_tipo_idioma,
            public.tbl_web_publico_idiomas.nombre,
            public.tbl_web_publico_idiomas.fecha_inicio,
            public.tbl_web_publico_idiomas.fecha_fin,
            public.tbl_web_publico_idiomas.institucion,
            public.tbl_web_publico_idiomas.pais,
            public.tbl_web_publico_idiomas.id_nivel,
            public.tbl_web_publico_idiomas.horas,
            public.tbl_web_publico_idiomas.creditos,
            public.tbl_web_publico_idiomas.archivo,
            public.tbl_web_publico_idiomas.imagen,
            public.tbl_web_publico_idiomas.nro_doc,
            public.tbl_web_publico_idiomas.estado
            FROM
            public.a_codigos AS tipodeidiomas
            INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
            WHERE
            tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_idiomas.fecha_fin DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/idiomas/" . $dataValue->archivo, "11-Idiomas-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosIdiomas*/

        /* getArchivosAsesorias*/
        if (true) {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_asesorias.codigo,
            tipo_grado.nombres AS tipo_grado,
            public.tbl_web_publico_asesorias.publico,
            public.tbl_web_publico_asesorias.id_grado,
            public.tbl_web_publico_asesorias.tesista,
            to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_asesorias.url,
            public.tbl_web_publico_asesorias.archivo,
            public.tbl_web_publico_asesorias.imagen,
            public.tbl_web_publico_asesorias.nro_doc,
            public.tbl_web_publico_asesorias.estado,
            public.tbl_web_universidades.universidad,
            tipodeinstitucion.nombres AS tipo_institucion
            FROM
            public.tbl_web_publico_asesorias
            INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
            INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
            INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
            WHERE
            tipodeinstitucion.numero = 105 AND
            tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_asesorias.fecha DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/asesorias/" . $dataValue->archivo, "12-Asesorias-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosAsesorias*/

        /* getArchivosExtension*/

        if (true) {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_extension.codigo,
            public.tbl_web_publico_extension.publico,
            public.tbl_web_publico_extension.nombre,
            to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_extension.archivo,
            public.tbl_web_publico_extension.imagen,
            public.tbl_web_publico_extension.estado
            FROM
            public.tbl_web_publico_extension
            WHERE
            public.tbl_web_publico_extension.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_extension.fecha DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/extension/" . $dataValue->archivo, "13-Extension-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }
        }
        /* getArchivosExtension*/

        $zip->close();

        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=datos_completos.zip");
        readfile("adminpanel/archivos/convocatorias_publico/temporal/datos_completos.zip");
        unlink("adminpanel/archivos/convocatorias_publico/temporal/datos_completos.zip");
    }
    public function getArchivosDatosPersonales2Action($publico = null, $datos_personales = null)
    {
        $this->view->disable();
        // print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        // exit();

        //$publico_ganador = Publico::findFirstBycodigo($publico);
        $publico_file = Publico::findFirstBycodigo($publico);

        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($datos_personales == "A") {
            if (
                $publico_file->archivo_discapacitado !== null ||
                $publico_file->archivo_fa !== null ||
                $publico_file->archivo_dar !== null ||
                $publico_file->archivo_renacyt !== null
            ) {
                $zip = new ZipArchive();
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-datos-personales.zip", ZipArchive::CREATE);
                //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
                //$zip->addEmptyDir($dir);

                if ($publico_file->archivo_discapacitado !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_discapacitado, "1-Datos-" . $publico_file->archivo_discapacitado);
                }

                if ($publico_file->archivo_fa !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_fa, "1-Datos-" . $publico_file->archivo_fa);
                }

                if ($publico_file->archivo_dar !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_dar, "1-Datos-" . $publico_file->archivo_dar);
                }

                if ($publico_file->archivo_renacyt !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_renacyt, "1-Datos-" . $publico_file->archivo_renacyt);
                }

                $zip->close();

                header("Content-type: application/octet-stream");
                header("Content-disposition: attachment; filename={$publico_file->nro_doc}-datos-personales.zip");
                readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
                unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
            } else {
                print("No hay archivos existentes");
            }
        }
    }


    public function getArchivosDatosGeneralesAction($publico = null, $FileDatos = null)
    {
        $this->view->disable();
        // print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        // exit();

        //$publico_ganador = Publico::findFirstBycodigo($publico);
        $publico_file = Publico::findFirstBycodigo($publico);


        // print($publico_file->codigo);
        // exit();

        $convocatoria = Convocatorias::findFirst("activo = 'M'");
        $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
            [
                "publico = $publico AND convocatoria = $convocatoria->id_convocatoria",
            ]
        );

        if ($FileDatos == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-datos-generales.zip", ZipArchive::CREATE);
            //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
            //$zip->addEmptyDir($dir);

            if ($ConvocatoriasPublico->archivo_solicitud !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_solicitud, "2-Datos-" . $ConvocatoriasPublico->archivo_solicitud);
            }

            if ($ConvocatoriasPublico->archivo_dni !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_dni, "2-Datos-" . $ConvocatoriasPublico->archivo_dni);
            }

            if ($ConvocatoriasPublico->archivo_silabo !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_silabo, "2-Datos-" . $ConvocatoriasPublico->archivo_silabo);
            }

            if ($ConvocatoriasPublico->archivo_dj !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_dj, "2-Datos-" . $ConvocatoriasPublico->archivo_dj);
            }

            $zip->close();

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-datos-generales.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-datos-generales.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-datos-generales.zip");
        }
    }

    public function getArchivosChctiAction($publico = null, $FileDatos = null)
    {
        $this->view->disable();
        // print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        // exit();

        //$publico_ganador = Publico::findFirstBycodigo($publico);
        $publico_file = Publico::findFirstBycodigo($publico);


        // print($publico_file->codigo);
        // exit();

        $convocatoria = Convocatorias::findFirst("activo = 'M'");
        $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
            [
                "publico = $publico AND convocatoria = $convocatoria->id_convocatoria",
            ]
        );

        if ($FileDatos == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-c-h-c.zip", ZipArchive::CREATE);
            //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
            //$zip->addEmptyDir($dir);

            if ($ConvocatoriasPublico->archivo_colegiatura !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_colegiatura, "3-Datos-" . $ConvocatoriasPublico->archivo_colegiatura);
            }

            if ($ConvocatoriasPublico->archivo_habilitacion !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_habilitacion, "3-Datos-" . $ConvocatoriasPublico->archivo_habilitacion);
            }

            if ($ConvocatoriasPublico->archivo_cti !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_cti, "3-Datos-" . $ConvocatoriasPublico->archivo_cti);
            }



            $zip->close();

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-c-h-c.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-c-h-c.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-c-h-c.zip");
        }
    }



    public function getArchivosExcepcionesAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-excepciones.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_excepciones.codigo,
            public.tbl_web_publico_excepciones.publico,
            public.tbl_web_publico_excepciones.id_tipo_excepcion,
            public.tbl_web_publico_excepciones.nombre,
            to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
            public.tbl_web_publico_excepciones.institucion,
            public.tbl_web_publico_excepciones.archivo,
            public.tbl_web_publico_excepciones.imagen,
            public.tbl_web_publico_excepciones.estado,
            public.tbl_web_publico_excepciones.nro_doc,
            tipodepublicaciones.nombres AS tipo_publicacion
            FROM
            public.tbl_web_publico_excepciones
            INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
            WHERE
            tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_excepciones.fecha_excepcion DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/excepciones/" . $dataValue->archivo, "4-Excepciones-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-excepciones.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-excepciones.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-excepciones.zip");
        }
    }


    public function getArchivosFormacionAction($publico = null, $formacion = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($formacion == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.fecha_grado,
                                                publico_formacion.archivo
                                                FROM
                                                PublicoFormacion publico_formacion
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
            $PublicoFormacionResult = $PublicoFormacionSql->execute();

            $num_file_formacion = 1;
            foreach ($PublicoFormacionResult as $PublicoFormacion) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoFormacion->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "2-Formacion-{$num_file_formacion}-" . $PublicoFormacion->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file_formacion++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-formacion-academica.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
        }
    }

    public function getArchivosFormacion2Action($publico = null, $formacion = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($formacion == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.fecha_grado,
                                                publico_formacion.archivo
                                                FROM
                                                PublicoFormacion publico_formacion
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
            $PublicoFormacionResult = $PublicoFormacionSql->execute();

            $num_file_formacion = 1;
            foreach ($PublicoFormacionResult as $PublicoFormacion) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoFormacion->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "5-Formacion-{$num_file_formacion}-" . $PublicoFormacion->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file_formacion++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-formacion-academica.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
        }
    }

    //descarga de archivos capacitaciones
    public function getArchivosCapacitacionesAction($publico = null, $capacitaciones = null)
    {
        $this->view->disable();
        // print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        // exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($capacitaciones == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip", ZipArchive::CREATE);

            $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    publico_capacitaciones.fecha_inicio,
                                                    publico_capacitaciones.archivo
                                                    FROM
                                                    PublicoCapacitaciones publico_capacitaciones
                                                    WHERE
                                                    publico_capacitaciones.estado = 'A'
                                                    AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
            $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
                //$ConvocatoriasPublicoFormacion->archivo;

                if ($PublicoCapacitaciones->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "3-Capacitaciones-{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-capacitaciones.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
        }
    }


    public function getArchivosCapacitaciones2Action($publico = null, $capacitaciones = null)
    {
        $this->view->disable();
        // print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        // exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($capacitaciones == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip", ZipArchive::CREATE);

            $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    publico_capacitaciones.fecha_inicio,
                                                    publico_capacitaciones.archivo
                                                    FROM
                                                    PublicoCapacitaciones publico_capacitaciones
                                                    WHERE
                                                    publico_capacitaciones.estado = 'A'
                                                    AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
            $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
                //$ConvocatoriasPublicoFormacion->archivo;

                if ($PublicoCapacitaciones->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "6-Capacitaciones-{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-capacitaciones.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
        }
    }



    public function getArchivosPublicacionesAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-publicaciones.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_publicaciones.codigo,
            public.tbl_web_publico_publicaciones.publico,
            public.tbl_web_publico_publicaciones.id_tipo_publicacion,
            public.tbl_web_publico_publicaciones.nombre,
            to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
            public.tbl_web_publico_publicaciones.doi,
            public.tbl_web_publico_publicaciones.pais,
            public.tbl_web_publico_publicaciones.archivo,
            public.tbl_web_publico_publicaciones.imagen,
            public.tbl_web_publico_publicaciones.estado,
            public.tbl_web_publico_publicaciones.nro_paginas,
            public.tbl_web_publico_publicaciones.nro_doc,
            tipo_de_publicaciones.nombres AS tipo_publicacion
            FROM
            public.a_codigos AS tipo_de_publicaciones
            INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
            WHERE
            tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_publicaciones.fecha_publicacion DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/publicaciones/" . $dataValue->archivo, "7-Publicaciones-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-publicaciones.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-publicaciones.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-publicaciones.zip");
        }
    }

    //descarga de archivos de experiencia
    public function getArchivosExperienciaAction($publico = null, $experiencia = null)
    {
        $this->view->disable();

        $publico_file = Publico::findFirstBycodigo($publico);

        if ($experiencia == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip", ZipArchive::CREATE);

            $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                publico_experiencia.fecha_inicio,
                                                publico_experiencia.archivo
                                                FROM
                                                PublicoExperiencia publico_experiencia
                                                WHERE
                                                publico_experiencia.estado = 'A'
                                                AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");
            $PublicoExperienciaResult = $PublicoExperienciaSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoExperiencia->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "4-Experiencia-{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-experiencia.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
        }
    }


    public function getArchivosExperiencia2Action($publico = null, $experiencia = null)
    {
        $this->view->disable();

        $publico_file = Publico::findFirstBycodigo($publico);

        if ($experiencia == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-experiencia.zip", ZipArchive::CREATE);

            $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                publico_experiencia.fecha_inicio,
                                                publico_experiencia.archivo
                                                FROM
                                                PublicoExperiencia publico_experiencia
                                                WHERE
                                                publico_experiencia.estado = 'A'
                                                AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");
            $PublicoExperienciaResult = $PublicoExperienciaSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoExperiencia->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "8-Experiencia-{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-experiencia.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
        }
    }


    public function getArchivosCargosAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-cargos.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_cargos.codigo,
            public.tbl_web_publico_cargos.tipo_institucion,
            public.tbl_web_publico_cargos.nombre,
            public.tbl_web_publico_cargos.institucion,
            public.tbl_web_publico_cargos.fecha_inicio,
            public.tbl_web_publico_cargos.fecha_fin,
            public.tbl_web_publico_cargos.archivo,
            public.tbl_web_publico_cargos.estado,
            tipodecargos.nombres AS tipo_cargo
            FROM
            public.tbl_web_publico_cargos
            INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
            WHERE
            tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.publico = $publico_file->codigo ORDER BY tbl_web_publico_cargos.fecha_fin DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/cargos/" . $dataValue->archivo, "9-Cargos-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-cargos.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-cargos.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-cargos.zip");
        }
    }


    public function getArchivosMaterialesAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-materiales.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_materiales.codigo,
            tipo_de_materiales.nombres AS tipo_material,
            public.tbl_web_publico_materiales.publico,
            public.tbl_web_publico_materiales.id_tipo_material,
            public.tbl_web_publico_materiales.nombre,
            to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_materiales.archivo,
            public.tbl_web_publico_materiales.imagen,
            public.tbl_web_publico_materiales.nro_doc,
            public.tbl_web_publico_materiales.estado
            FROM
            public.a_codigos AS tipo_de_materiales
            INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
            WHERE
            tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.publico = $publico_file->codigo ORDER BY tbl_web_publico_materiales.fecha DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/materiales/" . $dataValue->archivo, "10-Materiales-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-materiales.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-materiales.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-materiales.zip");
        }
    }

    public function getArchivosIdiomasAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-idiomas.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_idiomas.codigo,
            tipodeidiomas.nombres AS tipo_idioma,
            public.tbl_web_publico_idiomas.publico,
            public.tbl_web_publico_idiomas.id_tipo_idioma,
            public.tbl_web_publico_idiomas.nombre,
            public.tbl_web_publico_idiomas.fecha_inicio,
            public.tbl_web_publico_idiomas.fecha_fin,
            public.tbl_web_publico_idiomas.institucion,
            public.tbl_web_publico_idiomas.pais,
            public.tbl_web_publico_idiomas.id_nivel,
            public.tbl_web_publico_idiomas.horas,
            public.tbl_web_publico_idiomas.creditos,
            public.tbl_web_publico_idiomas.archivo,
            public.tbl_web_publico_idiomas.imagen,
            public.tbl_web_publico_idiomas.nro_doc,
            public.tbl_web_publico_idiomas.estado
            FROM
            public.a_codigos AS tipodeidiomas
            INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
            WHERE
            tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_idiomas.fecha_fin DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/idiomas/" . $dataValue->archivo, "11-Idiomas-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-idiomas.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-idiomas.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-idiomas.zip");
        }
    }

    public function getArchivosAsesoriasAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-asesorias.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_asesorias.codigo,
            tipo_grado.nombres AS tipo_grado,
            public.tbl_web_publico_asesorias.publico,
            public.tbl_web_publico_asesorias.id_grado,
            public.tbl_web_publico_asesorias.tesista,
            to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_asesorias.url,
            public.tbl_web_publico_asesorias.archivo,
            public.tbl_web_publico_asesorias.imagen,
            public.tbl_web_publico_asesorias.nro_doc,
            public.tbl_web_publico_asesorias.estado,
            public.tbl_web_universidades.universidad,
            tipodeinstitucion.nombres AS tipo_institucion
            FROM
            public.tbl_web_publico_asesorias
            INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
            INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
            INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
            WHERE
            tipodeinstitucion.numero = 105 AND
            tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_asesorias.fecha DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/asesorias/" . $dataValue->archivo, "12-Asesorias-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-asesorias.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-asesorias.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-asesorias.zip");
        }
    }

    public function getArchivosExtensionAction($publico = null, $FileDatos = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($FileDatos == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-asesorias.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_extension.codigo,
            public.tbl_web_publico_extension.publico,
            public.tbl_web_publico_extension.nombre,
            to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_extension.archivo,
            public.tbl_web_publico_extension.imagen,
            public.tbl_web_publico_extension.estado
            FROM
            public.tbl_web_publico_extension
            WHERE
            public.tbl_web_publico_extension.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_extension.fecha DESC";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

            $num_file = 1;
            foreach ($data as $dataValue) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($dataValue->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/extension/" . $dataValue->archivo, "13-Extension-{$num_file}-" . $dataValue->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-extension.zip");
            readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-extension.zip");
            unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-extension.zip");
        }
    }

    public function getArchivosAction($publico = null, $id_convocatoria = null)
    {
        $this->view->disable();
        $publico_file = Publico::findFirstBycodigo($publico);




        $zip = new ZipArchive();
        $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-archivos.zip", ZipArchive::CREATE);

        if ($publico_file->archivo !== null) {
            $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo, "1-Datos-" . $publico_file->archivo);
        }

        if ($publico_file->archivo_ruc !== null) {
            $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_ruc, "1-Datos-" . $publico_file->archivo_ruc);
        }

        if ($publico_file->archivo_cp !== null) {
            $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_cp, "1-Datos-" . $publico_file->archivo_cp);
        }

        if ($publico_file->archivo_dc !== null) {
            $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_dc, "1-Datos-" . $publico_file->archivo_dc);
        }

        // //formacion
        $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.fecha_grado,
                                                publico_formacion.archivo
                                                FROM
                                                PublicoFormacion publico_formacion
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
        $PublicoFormacionResult = $PublicoFormacionSql->execute();

        $num_file_formacion = 1;
        foreach ($PublicoFormacionResult as $PublicoFormacion) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($PublicoFormacion->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "2-Formacion-{$num_file_formacion}-" . $PublicoFormacion->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file_formacion++;
        }

        //capacitaciones
        $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
        publico_capacitaciones.fecha_inicio,
        publico_capacitaciones.archivo
        FROM
        PublicoCapacitaciones publico_capacitaciones
        WHERE
        publico_capacitaciones.estado = 'A'
        AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
        $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
        $num_file_capacitaciones = 1;
        foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
            //$ConvocatoriasPublicoFormacion->archivo;

            if ($PublicoCapacitaciones->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "3-Capacitaciones-{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo);
            }
            $num_file_capacitaciones++;
        }

        //experiencia
        $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
        publico_experiencia.fecha_inicio,
        publico_experiencia.archivo
        FROM
        PublicoExperiencia publico_experiencia
        WHERE
        publico_experiencia.estado = 'A'
        AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");

        // print("Sql: " . $PublicoExperienciaSql);
        // exit();



        $PublicoExperienciaResult = $PublicoExperienciaSql->execute();

        $num_file_capacitaciones = 1;
        foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
            //$PublicoExperiencia->archivo;
            if ($PublicoExperiencia->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "4-Experiencia-{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
            }
            $num_file_capacitaciones++;
        }






        // echo '<pre>';
        // print_r("Test:".$id_convocatoria);
        // exit();

        $convocatoriasPublico = ConvocatoriasPublico::findFirst("publico = {$publico} AND convocatoria = {$id_convocatoria}");


        $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $convocatoriasPublico->anexos, "1-Anexo-" . $convocatoriasPublico->anexos);


        $zip->addFile("adminpanel/archivos/convocatorias_publico/cvs/" . $convocatoriasPublico->cv, "1-CV-" . $convocatoriasPublico->cv);

        $zip->close();
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename={$publico_file->nro_doc}-archivos.zip");
        readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-archivos.zip");
        unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-archivos.zip");
    }

    public function getArchivos2Action($publico = null)
    {
        $this->view->disable();
        $convocatoria = Convocatorias::findFirst("activo = 'M'");
        $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
            [
                "publico = $publico AND convocatoria = $convocatoria->id_convocatoria",
            ]
        );





        $publico_file = Publico::findFirstBycodigo($publico);

        $zip = new ZipArchive();
        $zip->open("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-archivos.zip", ZipArchive::CREATE);

        //cv
        $zip->addFile("adminpanel/archivos/convocatorias_publico/cvs/" . $ConvocatoriasPublico->cv, "0-CV-" . $ConvocatoriasPublico->cv);


        if ($publico_file->archivo_discapacitado !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_discapacitado, "1-Datos-" . $publico_file->archivo_discapacitado);
        }

        if ($publico_file->archivo_fa !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_fa, "1-Datos-" . $publico_file->archivo_fa);
        }

        if ($publico_file->archivo_dar !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico" . $publico_file->archivo_dar, "1-Datos-" . $publico_file->archivo_dar);
        }

        if ($publico_file->archivo_renacyt !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $publico_file->archivo_renacyt, "1-Datos-" . $publico_file->archivo_renacyt);
        }

        //datos generales


        if ($ConvocatoriasPublico->archivo_solicitud !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_solicitud, "2-Datos-" . $ConvocatoriasPublico->archivo_solicitud);
        }

        if ($ConvocatoriasPublico->archivo_dni !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_dni, "2-Datos-" . $ConvocatoriasPublico->archivo_dni);
        }

        if ($ConvocatoriasPublico->archivo_silabo !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_silabo, "2-Datos-" . $ConvocatoriasPublico->archivo_silabo);
        }

        if ($ConvocatoriasPublico->archivo_dj !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_dj, "2-Datos-" . $ConvocatoriasPublico->archivo_dj);
        }


        //chc
        if ($ConvocatoriasPublico->archivo_colegiatura !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_colegiatura, "3-Datos-" . $ConvocatoriasPublico->archivo_colegiatura);
        }

        if ($ConvocatoriasPublico->archivo_habilitacion !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_habilitacion, "3-Datos-" . $ConvocatoriasPublico->archivo_habilitacion);
        }

        if ($ConvocatoriasPublico->archivo_cti !== null) {
            $zip->addFile("adminpanel/archivos/convocatorias_publico/" . $ConvocatoriasPublico->archivo_cti, "3-Datos-" . $ConvocatoriasPublico->archivo_cti);
        }


        $db = $this->db;
        $sqlQuery = "SELECT
        public.tbl_web_publico_excepciones.codigo,
        public.tbl_web_publico_excepciones.publico,
        public.tbl_web_publico_excepciones.id_tipo_excepcion,
        public.tbl_web_publico_excepciones.nombre,
        to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
        public.tbl_web_publico_excepciones.institucion,
        public.tbl_web_publico_excepciones.archivo,
        public.tbl_web_publico_excepciones.imagen,
        public.tbl_web_publico_excepciones.estado,
        public.tbl_web_publico_excepciones.nro_doc,
        tipodepublicaciones.nombres AS tipo_publicacion
        FROM
        public.tbl_web_publico_excepciones
        INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
        WHERE
        tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_excepciones.fecha_excepcion DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/excepciones/" . $dataValue->archivo, "4-Excepciones-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }

        //formacion
        $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.fecha_grado,
                                                publico_formacion.archivo
                                                FROM
                                                PublicoFormacion publico_formacion
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
        $PublicoFormacionResult = $PublicoFormacionSql->execute();

        $num_file_formacion = 1;
        foreach ($PublicoFormacionResult as $PublicoFormacion) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($PublicoFormacion->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "5-Formacion-{$num_file_formacion}-" . $PublicoFormacion->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file_formacion++;
        }

        //capacitaciones
        $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
        publico_capacitaciones.fecha_inicio,
        publico_capacitaciones.archivo
        FROM
        PublicoCapacitaciones publico_capacitaciones
        WHERE
        publico_capacitaciones.estado = 'A'
        AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
        $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
        $num_file_capacitaciones = 1;
        foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
            //$ConvocatoriasPublicoFormacion->archivo;

            if ($PublicoCapacitaciones->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "6-Capacitaciones-{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo);
            }
            $num_file_capacitaciones++;
        }



        //publicaciones
        $db = $this->db;
        $sqlQuery = "SELECT
        public.tbl_web_publico_publicaciones.codigo,
        public.tbl_web_publico_publicaciones.publico,
        public.tbl_web_publico_publicaciones.id_tipo_publicacion,
        public.tbl_web_publico_publicaciones.nombre,
        to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
        public.tbl_web_publico_publicaciones.doi,
        public.tbl_web_publico_publicaciones.pais,
        public.tbl_web_publico_publicaciones.archivo,
        public.tbl_web_publico_publicaciones.imagen,
        public.tbl_web_publico_publicaciones.estado,
        public.tbl_web_publico_publicaciones.nro_paginas,
        public.tbl_web_publico_publicaciones.nro_doc,
        tipo_de_publicaciones.nombres AS tipo_publicacion
        FROM
        public.a_codigos AS tipo_de_publicaciones
        INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
        WHERE
        tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_publicaciones.fecha_publicacion DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/publicaciones/" . $dataValue->archivo, "7-Publicaciones-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }

        //experiencia
        $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
        publico_experiencia.fecha_inicio,
        publico_experiencia.archivo
        FROM
        PublicoExperiencia publico_experiencia
        WHERE
        publico_experiencia.estado = 'A'
        AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");
        $PublicoExperienciaResult = $PublicoExperienciaSql->execute();
        $num_file_capacitaciones = 1;
        foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($PublicoExperiencia->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "8-Experiencia-{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
            }
            $num_file_capacitaciones++;
        }


        //cargos
        $db = $this->db;
        $sqlQuery = "SELECT
        public.tbl_web_publico_cargos.codigo,
        public.tbl_web_publico_cargos.tipo_institucion,
        public.tbl_web_publico_cargos.nombre,
        public.tbl_web_publico_cargos.institucion,
        public.tbl_web_publico_cargos.fecha_inicio,
        public.tbl_web_publico_cargos.fecha_fin,
        public.tbl_web_publico_cargos.archivo,
        public.tbl_web_publico_cargos.estado,
        tipodecargos.nombres AS tipo_cargo
        FROM
        public.tbl_web_publico_cargos
        INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
        WHERE
        tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.publico = $publico_file->codigo ORDER BY tbl_web_publico_cargos.fecha_fin DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/cargos/" . $dataValue->archivo, "9-Cargos-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }

        //materiales
        $db = $this->db;
        $sqlQuery = "SELECT
        public.tbl_web_publico_materiales.codigo,
        tipo_de_materiales.nombres AS tipo_material,
        public.tbl_web_publico_materiales.publico,
        public.tbl_web_publico_materiales.id_tipo_material,
        public.tbl_web_publico_materiales.nombre,
        to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
        public.tbl_web_publico_materiales.archivo,
        public.tbl_web_publico_materiales.imagen,
        public.tbl_web_publico_materiales.nro_doc,
        public.tbl_web_publico_materiales.estado
        FROM
        public.a_codigos AS tipo_de_materiales
        INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
        WHERE
        tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.publico = $publico_file->codigo ORDER BY tbl_web_publico_materiales.fecha DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/materiales/" . $dataValue->archivo, "10-Materiales-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }

        //idiomas
        $db = $this->db;
        $sqlQuery = "SELECT
        public.tbl_web_publico_idiomas.codigo,
        tipodeidiomas.nombres AS tipo_idioma,
        public.tbl_web_publico_idiomas.publico,
        public.tbl_web_publico_idiomas.id_tipo_idioma,
        public.tbl_web_publico_idiomas.nombre,
        public.tbl_web_publico_idiomas.fecha_inicio,
        public.tbl_web_publico_idiomas.fecha_fin,
        public.tbl_web_publico_idiomas.institucion,
        public.tbl_web_publico_idiomas.pais,
        public.tbl_web_publico_idiomas.id_nivel,
        public.tbl_web_publico_idiomas.horas,
        public.tbl_web_publico_idiomas.creditos,
        public.tbl_web_publico_idiomas.archivo,
        public.tbl_web_publico_idiomas.imagen,
        public.tbl_web_publico_idiomas.nro_doc,
        public.tbl_web_publico_idiomas.estado
        FROM
        public.a_codigos AS tipodeidiomas
        INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
        WHERE
        tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_idiomas.fecha_fin DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/idiomas/" . $dataValue->archivo, "11-Idiomas-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }

        //asesorias
        $db = $this->db;
        $sqlQuery = "SELECT
        public.tbl_web_publico_asesorias.codigo,
        tipo_grado.nombres AS tipo_grado,
        public.tbl_web_publico_asesorias.publico,
        public.tbl_web_publico_asesorias.id_grado,
        public.tbl_web_publico_asesorias.tesista,
        to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
        public.tbl_web_publico_asesorias.url,
        public.tbl_web_publico_asesorias.archivo,
        public.tbl_web_publico_asesorias.imagen,
        public.tbl_web_publico_asesorias.nro_doc,
        public.tbl_web_publico_asesorias.estado,
        public.tbl_web_universidades.universidad,
        tipodeinstitucion.nombres AS tipo_institucion
        FROM
        public.tbl_web_publico_asesorias
        INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
        INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
        INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
        WHERE
        tipodeinstitucion.numero = 105 AND
        tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_asesorias.fecha DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/asesorias/" . $dataValue->archivo, "12-Asesorias-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }


        //extension
        $db = $this->db;
        $sqlQuery = "SELECT
            public.tbl_web_publico_extension.codigo,
            public.tbl_web_publico_extension.publico,
            public.tbl_web_publico_extension.nombre,
            to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_extension.archivo,
            public.tbl_web_publico_extension.imagen,
            public.tbl_web_publico_extension.estado
            FROM
            public.tbl_web_publico_extension
            WHERE
            public.tbl_web_publico_extension.publico = $publico_file->codigo ORDER BY public.tbl_web_publico_extension.fecha DESC";
        // print($sqlQuery);
        // exit();
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $num_file = 1;
        foreach ($data as $dataValue) {
            //$ConvocatoriasPublicoFormacion->archivo;
            if ($dataValue->archivo !== null) {
                try {
                    $zip->addFile("adminpanel/archivos/publico/extension/" . $dataValue->archivo, "13-Extension-{$num_file}-" . $dataValue->archivo);
                } catch (Exception $ex) {
                    print($ex->getMessage());
                    exit();
                }
            }
            $num_file++;
        }

        $zip->close();
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename={$publico_file->nro_doc}-archivos.zip");
        readfile("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-archivos.zip");
        unlink("adminpanel/archivos/convocatorias_publico/temporal/" . $publico_file->nro_doc . "-archivos.zip");
    }

    public function saveResumencvAction()
    {
        $this->view->disable();
        $convocatoria = $this->request->getPost("convocatoria", "int");
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $ConvocatoriasPublico = ConvocatoriasPublico::find(
                [
                    "convocatoria = $convocatoria"
                ]
            );

            foreach ($ConvocatoriasPublico as $valueCP) {

                $publicoModel = Publico::findFirstBycodigo($valueCP->publico);
                $publico = $publicoModel->codigo;

                // print($publicoModel->foto);
                // exit();

                //-------------------------------------guardarpdf-------------------------------------------------
                $pdf = new PDF();
                $pdf->AddPage();
                $pdf->enablefooter = 'footer2';

                $pdf->SetFont('Arial', 'B', 13.2);
                $pdf->MultiCell(190, 12.2, '    CURRICULUM  VITAE', 0, 'C');
                $pdf->Ln(8);

                $PublicoSql = $this->modelsManager->createQuery("SELECT publico.codigo, publico.tipo, publico.apellidop, publico.apellidom,
            publico.nombres, publico.sexo, publico.fecha_nacimiento, publico.documento, publico.nro_doc, publico.nro_ruc, publico.seguro, publico.telefono,
            publico.celular, publico.email, publico.direccion, publico.ciudad, publico.observaciones, publico.foto, publico.colegio_publico,
            publico.colegio_nombre, publico.sitrabaja, publico.sitrabaja_nombre, publico.sidepende, publico.sidepende_nombre, publico.estado,
            publico.region, publico.provincia, publico.distrito, publico.ubigeo, publico.region1, publico.provincia1, publico.distrito1, publico.ubigeo1,
            publico.localidad, publico.discapacitado, publico.discapacitado_nombre, publico.password, publico.archivo, publico.colegio_profesional,
            publico.colegio_profesional_nro, publico.estado_civil, publico.archivo_cp, publico.archivo_ruc, publico.archivo_dc, publico.sobre_ti, publico.voluntariado,
            publico.expectativas, publico.fecha_emision_dni, tipo_documento.nombres AS nombre_tipo_documento, estado_civil.nombres AS nombre_estado_civil, sexos.nombres AS nombre_sexo,
            regiones.descripcion AS nombre_region, provincias.descripcion AS nombre_provincia, distritos.descripcion AS nombre_distrito, colegio_profesional.nombres AS nombre_colegio_profesional
            FROM Publico publico
            INNER JOIN TipoDocumento tipo_documento ON publico.documento = tipo_documento.codigo
            INNER JOIN EstadoCivil estado_civil ON publico.estado_civil = estado_civil.codigo
            INNER JOIN Sexo sexos ON CAST (publico.sexo AS INTEGER) = sexos.codigo
            INNER JOIN Regiones regiones ON publico.region = regiones.region
            INNER JOIN Provincias provincias ON publico.provincia = provincias.provincia AND publico.region = provincias.region
            INNER JOIN Distritos distritos ON publico.distrito = distritos.distrito AND publico.provincia = distritos.provincia AND publico.region = distritos.region
            INNER JOIN ColegioProfesional colegio_profesional ON publico.colegio_profesional = colegio_profesional.codigo
            WHERE publico.codigo = {$publico} AND tipo_documento.numero = 1 AND estado_civil.numero = 26 AND sexos.numero = 3 AND colegio_profesional.numero = 85");
                $PublicoResult = $PublicoSql->execute();
                foreach ($PublicoResult as $Publico) {

                    // print($Publico->foto);
                    // exit();

                    if ($Publico->foto) {
                        $extension = explode('.', $Publico->foto);
                        // print($extension[1]);
                        // exit();
                        if ($extension[1] !== "png") {
                            $pdf->Image('adminpanel/imagenes/publico/' . $Publico->foto, 90, 25, 30);
                        }
                    }

                    $pdf->Ln(38.2);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(190, 10, "{$Publico->apellidop} {$Publico->apellidom} {$Publico->nombres}", 0, 1, 'C');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->Cell(174, 9, 'DATOS PERSONALES', 0, 0, 'L');
                    $pdf->Ln(10);

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Documento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_tipo_documento}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. Documento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nro_doc}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. RUC ', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nro_ruc}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Email', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->email}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha de nacimiento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $fecha_nacimiento_explode1 = explode(" ", $Publico->fecha_nacimiento);
                    $fecha_nacimiento_explode2 = explode("-", $fecha_nacimiento_explode1[0]);
                    $fecha_nacimiento = $fecha_nacimiento_explode2[2] . "/" . $fecha_nacimiento_explode2[1] . "/" . $fecha_nacimiento_explode2[0];
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$fecha_nacimiento}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Celular', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->celular}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Estado Civil', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_estado_civil}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Sexo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_sexo}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Región', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_region}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Provincia', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_provincia}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Distrito', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_distrito}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Dirección', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->direccion}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Ciudad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->ciudad}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Colegio Profesional', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_colegio_profesional}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. Colegiatura', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->colegio_profesional_nro}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Discapacitado', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    if ($Publico->discapacitado == '1') {
                        $discapacitado = 'SI';
                    } else if ($Publico->discapacitado == '0') {
                        $discapacitado = 'NO';
                    }
                    $pdf->Cell(120, 6, "{$discapacitado}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre discapacidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->discapacitado_nombre}", 0, 1, 'L');
                    $pdf->Ln(4);

                    if ($Publico->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Archivo DNI', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo}", 0, 1, 'L');
                    }

                    if ($Publico->archivo_ruc !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Ficha RUC', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_ruc}", 0, 1, 'L');
                    }

                    if ($Publico->archivo_cp !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Certificado de Habilidad', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_cp}", 0, 1, 'L');
                    }

                    if ($Publico->archivo_dc !== null) {
                        //Certificado de discapacidad:
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Certificado de discapacidad', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);

                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_dc}", 0, 1, 'L');
                    }
                    $pdf->Ln(4);
                }

                $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
            publico_formacion.codigo,
            publico_formacion.publico,
            publico_formacion.grado,
            publico_formacion.nombre,
            publico_formacion.fecha_grado,
            publico_formacion.institucion,
            publico_formacion.pais,
            publico_formacion.archivo,
            publico_formacion.imagen,
            publico_formacion.estado,
            grado_maximo.nombres AS nombre_grado
            FROM
            PublicoFormacion publico_formacion
            INNER JOIN GradoMaximo grado_maximo ON grado_maximo.codigo = publico_formacion.grado
            WHERE
            publico_formacion.estado = 'A'
            AND grado_maximo.numero = 69
            AND publico_formacion.publico = {$publico} ORDER BY publico_formacion.fecha_grado DESC");
                $PublicoFormacionResult = $PublicoFormacionSql->execute();
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'FORMACIÓN ACADÉMICA', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($PublicoFormacionResult as $PublicoFormacion) {
                    //echo '<pre>';
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Grado / Titulo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->nombre_grado}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$PublicoFormacion->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$PublicoFormacion->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f = explode(" ", $PublicoFormacion->fecha_grado);
                    $fotmat_f_f_r = explode("-", $format_f_f[0]);
                    $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                    $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->pais}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->institucion}", 0, 1, 'L');

                    if ($PublicoFormacion->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/formacion/{$PublicoFormacion->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                $ConvocatoriasPublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
            publico_capacitaciones.codigo,
            publico_capacitaciones.publico,
            publico_capacitaciones.capacitacion,
            publico_capacitaciones.nombre,
            publico_capacitaciones.fecha_inicio,
            publico_capacitaciones.fecha_fin,
            publico_capacitaciones.institucion,
            publico_capacitaciones.pais,
            publico_capacitaciones.archivo,
            publico_capacitaciones.imagen,
            publico_capacitaciones.estado,
            capacitaciones.nombres AS nombre_capacitacion,
            publico_capacitaciones.horas,
            publico_capacitaciones.creditos
            FROM
            PublicoCapacitaciones publico_capacitaciones
            INNER JOIN Capacitaciones capacitaciones ON capacitaciones.codigo = publico_capacitaciones.capacitacion
            WHERE
            publico_capacitaciones.estado = 'A'
            AND capacitaciones.numero = 86
            AND publico_capacitaciones.publico = {$publico} ORDER BY publico_capacitaciones.fecha_inicio DESC");
                $ConvocatoriasPublicoCapacitacionesResult = $ConvocatoriasPublicoCapacitacionesSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'CURSOS, DIPLOMADOS O ESPECIALIZACIONES', 0, 0, 'L');
                $pdf->Ln(10);

                foreach ($ConvocatoriasPublicoCapacitacionesResult as $ConvocatoriasPublicoCapacitaciones) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->institucion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Horas', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->horas}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Créditos', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->creditos}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_i_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_inicio);
                    $fotmat_f_i_c_r = explode("-", $format_f_i_c[0]);
                    $fotmat_f_i_c_r_r = $fotmat_f_i_c_r[2] . "/" . $fotmat_f_i_c_r[1] . "/" . $fotmat_f_i_c_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_i_c_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_fin);
                    $fotmat_f_f_c_r = explode("-", $format_f_f_c[0]);
                    $fotmat_f_f_c_r_r = $fotmat_f_f_c_r[2] . "/" . $fotmat_f_f_c_r[1] . "/" . $fotmat_f_f_c_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_f_c_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->pais}", 0, 'L');

                    if ($ConvocatoriasPublicoCapacitaciones->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                        $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 'L');
                    }

                    $pdf->Ln(5);
                }

                $ConvocatoriasPublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                publico_experiencia.codigo,
                publico_experiencia.publico,
                publico_experiencia.tipo,
                publico_experiencia.cargo,
                publico_experiencia.fecha_inicio,
                publico_experiencia.fecha_fin,
                publico_experiencia.tiempo,
                publico_experiencia.institucion,
                publico_experiencia.funciones,
                publico_experiencia.archivo,
                publico_experiencia.imagen,
                publico_experiencia.estado,
                tipo_experiencia_laboral.nombres AS nombre_tipo
                FROM
                PublicoExperiencia publico_experiencia
                INNER JOIN TipoExperienciaLaboral tipo_experiencia_laboral ON tipo_experiencia_laboral.codigo = publico_experiencia.tipo
                WHERE
                publico_experiencia.estado = 'A'
                AND tipo_experiencia_laboral.numero = 87
                AND publico_experiencia.publico = {$publico} ORDER BY publico_experiencia.fecha_inicio DESC");
                $ConvocatoriasPublicoExperienciaResult = $ConvocatoriasPublicoExperienciaSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'EXPERIENCIA LABORAL', 0, 0, 'L');
                $pdf->Ln(10);

                foreach ($ConvocatoriasPublicoExperienciaResult as $ConvocatoriasPublicoExperiencia) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->nombre_tipo}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Institución', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->institucion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Cargo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->cargo}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_i_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_inicio);
                    $fotmat_f_i_e_r = explode("-", $format_f_i_e[0]);
                    $fotmat_f_i_e_r_r = $fotmat_f_i_e_r[2] . "/" . $fotmat_f_i_e_r[1] . "/" . $fotmat_f_i_e_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_i_e_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_fin);
                    $fotmat_f_f_e_r = explode("-", $format_f_f_e[0]);
                    $fotmat_f_f_e_r_r = $fotmat_f_f_e_r[2] . "/" . $fotmat_f_f_e_r[1] . "/" . $fotmat_f_f_e_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_f_e_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tiempo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //
                    $dteStart = new DateTime($ConvocatoriasPublicoExperiencia->fecha_inicio);
                    $dteEnd = new DateTime($ConvocatoriasPublicoExperiencia->fecha_fin);
                    $interval = $dteStart->diff($dteEnd);

                    //print($interval->format('%a'));
                    //exit();

                    $total_meses = ($interval->format('%a')) / 30;
                    $total_meses_result = round($total_meses);

                    //print($total_meses_result);
                    //exit();
                    //
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->tiempo}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$total_meses_result}", 0, 'L');

                    if ($ConvocatoriasPublicoExperiencia->archivo !== null) {

                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                        $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/experiencia/{$ConvocatoriasPublicoExperiencia->archivo}", 0, 'L');
                    }

                    $pdf->Ln(5);
                }

                $ganador = Publico::findFirstBycodigo($publico);

                $pdf->Ln(5);
                $pdf->Cell(100);
                $pdf->Cell(80, 5, '_________________________________________', 0, 0, 'C');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(100);
                $pdf->Cell(80, 5, "{$ganador->apellidop} {$ganador->apellidom} {$ganador->nombres}", 0, 1, 'C');
                $pdf->Cell(100);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(80, 5, "DNI.{$ganador->nro_doc}", 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->Ln(10);

                $idCOnvocatoria = $valueCP->convocatoria;
                $nroDoc = $publicoModel->nro_doc;

                $filename = "adminpanel/archivos/convocatorias_publico/cvs/{$idCOnvocatoria}-CV-{$nroDoc}.pdf";

                $convocatoriasPublicocv = ConvocatoriasPublico::findFirstBypublico($publicoModel->codigo);
                $convocatoriasPublicocv->cv = "{$idCOnvocatoria}-CV-{$nroDoc}.pdf";
                $convocatoriasPublicocv->save();

                //echo "<pre>";
                //print_r($filename);
                $pdf->Output($filename, 'F');
                //----------------------------------------finpdf----------------------------------------------------------
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

    public function generarcvAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $publicoModel = Publico::findFirstBycodigo((int) $this->request->getPost("id_publico", "int"));
            if ($publicoModel && $publicoModel->estado = 'A') {

                $publico = $publicoModel->codigo;

                // print("id_publico: ".$publico);
                // exit();


                // print($publicoModel->foto);
                // exit();

                //-------------------------------------guardarpdf-------------------------------------------------
                $pdf = new PDF();
                $pdf->AddPage();
                $pdf->enablefooter = 'footer2';

                $pdf->SetFont('Arial', 'B', 13.2);
                $pdf->MultiCell(190, 12.2, '    CURRICULUM  VITAE', 0, 'C');
                $pdf->Ln(8);

                $PublicoSql = $this->modelsManager->createQuery("SELECT publico.codigo, publico.tipo, publico.apellidop, publico.apellidom,
    publico.nombres, publico.sexo, publico.fecha_nacimiento, publico.documento, publico.nro_doc, publico.nro_ruc, publico.seguro, publico.telefono,
    publico.celular, publico.email, publico.direccion, publico.ciudad, publico.observaciones, publico.foto, publico.colegio_publico,
    publico.colegio_nombre, publico.sitrabaja, publico.sitrabaja_nombre, publico.sidepende, publico.sidepende_nombre, publico.estado,
    publico.region, publico.provincia, publico.distrito, publico.ubigeo, publico.region1, publico.provincia1, publico.distrito1, publico.ubigeo1,
    publico.localidad, publico.discapacitado, publico.discapacitado_nombre, publico.password, publico.archivo, publico.colegio_profesional,
    publico.colegio_profesional_nro, publico.estado_civil, publico.archivo_cp, publico.archivo_ruc, publico.archivo_dc, publico.sobre_ti, publico.voluntariado,
    publico.expectativas, publico.fecha_emision_dni, tipo_documento.nombres AS nombre_tipo_documento, estado_civil.nombres AS nombre_estado_civil, sexos.nombres AS nombre_sexo,
    regiones.descripcion AS nombre_region, provincias.descripcion AS nombre_provincia, distritos.descripcion AS nombre_distrito, colegio_profesional.nombres AS nombre_colegio_profesional
    FROM Publico publico
    INNER JOIN TipoDocumento tipo_documento ON publico.documento = tipo_documento.codigo
    INNER JOIN EstadoCivil estado_civil ON publico.estado_civil = estado_civil.codigo
    INNER JOIN Sexo sexos ON CAST (publico.sexo AS INTEGER) = sexos.codigo
    INNER JOIN Regiones regiones ON publico.region = regiones.region
    INNER JOIN Provincias provincias ON publico.provincia = provincias.provincia AND publico.region = provincias.region
    INNER JOIN Distritos distritos ON publico.distrito = distritos.distrito AND publico.provincia = distritos.provincia AND publico.region = distritos.region
    INNER JOIN ColegioProfesional colegio_profesional ON publico.colegio_profesional = colegio_profesional.codigo
    WHERE publico.codigo = {$publico} AND tipo_documento.numero = 1 AND estado_civil.numero = 26 AND sexos.numero = 3 AND colegio_profesional.numero = 85");
                $PublicoResult = $PublicoSql->execute();
                foreach ($PublicoResult as $Publico) {

                    // print($Publico->foto);
                    // exit();

                    if ($Publico->foto) {
                        $extension = explode('.', $Publico->foto);
                        // print($extension[1]);
                        // exit();
                        if ($extension[1] !== "png") {
                            $pdf->Image('adminpanel/imagenes/publico/' . $Publico->foto, 90, 25, 30);
                        }
                    }

                    $pdf->Ln(38.2);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(190, 10, "{$Publico->apellidop} {$Publico->apellidom} {$Publico->nombres}", 0, 1, 'C');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->Cell(174, 9, 'DATOS PERSONALES', 0, 0, 'L');
                    $pdf->Ln(10);

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Documento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_tipo_documento}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. Documento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nro_doc}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. RUC ', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nro_ruc}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Email', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->email}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha de nacimiento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $fecha_nacimiento_explode1 = explode(" ", $Publico->fecha_nacimiento);
                    $fecha_nacimiento_explode2 = explode("-", $fecha_nacimiento_explode1[0]);
                    $fecha_nacimiento = $fecha_nacimiento_explode2[2] . "/" . $fecha_nacimiento_explode2[1] . "/" . $fecha_nacimiento_explode2[0];
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$fecha_nacimiento}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Celular', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->celular}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Estado Civil', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_estado_civil}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Sexo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_sexo}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Región', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_region}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Provincia', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_provincia}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Distrito', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_distrito}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Dirección', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->direccion}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Ciudad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->ciudad}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Colegio Profesional', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_colegio_profesional}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. Colegiatura', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->colegio_profesional_nro}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Discapacitado', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    if ($Publico->discapacitado == '1') {
                        $discapacitado = 'SI';
                    } else if ($Publico->discapacitado == '0') {
                        $discapacitado = 'NO';
                    }
                    $pdf->Cell(120, 6, "{$discapacitado}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre discapacidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->discapacitado_nombre}", 0, 1, 'L');
                    $pdf->Ln(4);

                    if ($Publico->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Archivo DNI', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo}", 0, 1, 'L');
                    }

                    if ($Publico->archivo_ruc !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Ficha RUC', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_ruc}", 0, 1, 'L');
                    }

                    if ($Publico->archivo_cp !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Certificado de Habilidad', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_cp}", 0, 1, 'L');
                    }

                    if ($Publico->archivo_dc !== null) {
                        //Certificado de discapacidad:
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace Certificado de discapacidad', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);

                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_dc}", 0, 1, 'L');
                    }
                    $pdf->Ln(4);
                }

                $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
    publico_formacion.codigo,
    publico_formacion.publico,
    publico_formacion.grado,
    publico_formacion.nombre,
    publico_formacion.fecha_grado,
    publico_formacion.institucion,
    publico_formacion.pais,
    publico_formacion.archivo,
    publico_formacion.imagen,
    publico_formacion.estado,
    grado_maximo.nombres AS nombre_grado
    FROM
    PublicoFormacion publico_formacion
    INNER JOIN GradoMaximo grado_maximo ON grado_maximo.codigo = publico_formacion.grado
    WHERE
    publico_formacion.estado = 'A'
    AND grado_maximo.numero = 69
    AND publico_formacion.publico = {$publico} ORDER BY publico_formacion.fecha_grado DESC");
                $PublicoFormacionResult = $PublicoFormacionSql->execute();
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'FORMACIÓN ACADÉMICA', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($PublicoFormacionResult as $PublicoFormacion) {
                    //echo '<pre>';
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Grado / Titulo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->nombre_grado}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$PublicoFormacion->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$PublicoFormacion->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f = explode(" ", $PublicoFormacion->fecha_grado);
                    $fotmat_f_f_r = explode("-", $format_f_f[0]);
                    $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                    $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->pais}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->institucion}", 0, 1, 'L');

                    if ($PublicoFormacion->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/formacion/{$PublicoFormacion->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                $ConvocatoriasPublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
    publico_capacitaciones.codigo,
    publico_capacitaciones.publico,
    publico_capacitaciones.capacitacion,
    publico_capacitaciones.nombre,
    publico_capacitaciones.fecha_inicio,
    publico_capacitaciones.fecha_fin,
    publico_capacitaciones.institucion,
    publico_capacitaciones.pais,
    publico_capacitaciones.archivo,
    publico_capacitaciones.imagen,
    publico_capacitaciones.estado,
    capacitaciones.nombres AS nombre_capacitacion,
    publico_capacitaciones.horas,
    publico_capacitaciones.creditos
    FROM
    PublicoCapacitaciones publico_capacitaciones
    INNER JOIN Capacitaciones capacitaciones ON capacitaciones.codigo = publico_capacitaciones.capacitacion
    WHERE
    publico_capacitaciones.estado = 'A'
    AND capacitaciones.numero = 86
    AND publico_capacitaciones.publico = {$publico} ORDER BY publico_capacitaciones.fecha_inicio DESC");
                $ConvocatoriasPublicoCapacitacionesResult = $ConvocatoriasPublicoCapacitacionesSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'CURSOS, DIPLOMADOS O ESPECIALIZACIONES', 0, 0, 'L');
                $pdf->Ln(10);

                foreach ($ConvocatoriasPublicoCapacitacionesResult as $ConvocatoriasPublicoCapacitaciones) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->institucion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Horas', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->horas}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Créditos', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->creditos}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_i_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_inicio);
                    $fotmat_f_i_c_r = explode("-", $format_f_i_c[0]);
                    $fotmat_f_i_c_r_r = $fotmat_f_i_c_r[2] . "/" . $fotmat_f_i_c_r[1] . "/" . $fotmat_f_i_c_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_i_c_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_fin);
                    $fotmat_f_f_c_r = explode("-", $format_f_f_c[0]);
                    $fotmat_f_f_c_r_r = $fotmat_f_f_c_r[2] . "/" . $fotmat_f_f_c_r[1] . "/" . $fotmat_f_f_c_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_f_c_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->pais}", 0, 'L');

                    if ($ConvocatoriasPublicoCapacitaciones->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                        $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 'L');
                    }

                    $pdf->Ln(5);
                }

                $ConvocatoriasPublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
        publico_experiencia.codigo,
        publico_experiencia.publico,
        publico_experiencia.tipo,
        publico_experiencia.cargo,
        publico_experiencia.fecha_inicio,
        publico_experiencia.fecha_fin,
        publico_experiencia.tiempo,
        publico_experiencia.institucion,
        publico_experiencia.funciones,
        publico_experiencia.archivo,
        publico_experiencia.imagen,
        publico_experiencia.estado,
        tipo_experiencia_laboral.nombres AS nombre_tipo
        FROM
        PublicoExperiencia publico_experiencia
        INNER JOIN TipoExperienciaLaboral tipo_experiencia_laboral ON tipo_experiencia_laboral.codigo = publico_experiencia.tipo
        WHERE
        publico_experiencia.estado = 'A'
        AND tipo_experiencia_laboral.numero = 87
        AND publico_experiencia.publico = {$publico} ORDER BY publico_experiencia.fecha_inicio DESC");
                $ConvocatoriasPublicoExperienciaResult = $ConvocatoriasPublicoExperienciaSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'EXPERIENCIA LABORAL', 0, 0, 'L');
                $pdf->Ln(10);

                foreach ($ConvocatoriasPublicoExperienciaResult as $ConvocatoriasPublicoExperiencia) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->nombre_tipo}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Institución', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->institucion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Cargo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->cargo}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_i_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_inicio);
                    $fotmat_f_i_e_r = explode("-", $format_f_i_e[0]);
                    $fotmat_f_i_e_r_r = $fotmat_f_i_e_r[2] . "/" . $fotmat_f_i_e_r[1] . "/" . $fotmat_f_i_e_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_i_e_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_fin);
                    $fotmat_f_f_e_r = explode("-", $format_f_f_e[0]);
                    $fotmat_f_f_e_r_r = $fotmat_f_f_e_r[2] . "/" . $fotmat_f_f_e_r[1] . "/" . $fotmat_f_f_e_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_f_e_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tiempo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //
                    $dteStart = new DateTime($ConvocatoriasPublicoExperiencia->fecha_inicio);
                    $dteEnd = new DateTime($ConvocatoriasPublicoExperiencia->fecha_fin);
                    $interval = $dteStart->diff($dteEnd);

                    //print($interval->format('%a'));
                    //exit();

                    $total_meses = ($interval->format('%a')) / 30;
                    $total_meses_result = round($total_meses);

                    //print($total_meses_result);
                    //exit();
                    //
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->tiempo}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$total_meses_result}", 0, 'L');

                    if ($ConvocatoriasPublicoExperiencia->archivo !== null) {

                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                        $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/experiencia/{$ConvocatoriasPublicoExperiencia->archivo}", 0, 'L');
                    }

                    $pdf->Ln(5);
                }

                $publicoDatos = Publico::findFirstBycodigo($publico);

                $pdf->Ln(5);
                $pdf->Cell(100);
                $pdf->Cell(80, 5, '_________________________________________', 0, 0, 'C');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(100);
                $pdf->Cell(80, 5, "{$publicoDatos->apellidop} {$publicoDatos->apellidom} {$publicoDatos->nombres}", 0, 1, 'C');
                $pdf->Cell(100);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(80, 5, "DNI.{$publicoDatos->nro_doc}", 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->Ln(10);


                $id_publico = (int) $this->request->getPost("id_publico", "int");
                $id_convocatoria = (int) $this->request->getPost("convocatoria", "int");

                // print($id_publico."-".$id_convocatoria);
                // exit();

                $valueCP = ConvocatoriasPublico::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");



                $idCOnvocatoria = $valueCP->convocatoria;
                $nroDoc = $publicoDatos->nro_doc;

                // print($idCOnvocatoria."-".$nroDoc);
                // exit();

                $filename = "adminpanel/archivos/convocatorias_publico/cvs/{$idCOnvocatoria}-CV-{$nroDoc}.pdf";

                $convocatoriasPublicocv = ConvocatoriasPublico::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");
                $convocatoriasPublicocv->cv = "{$idCOnvocatoria}-CV-{$nroDoc}.pdf";
                // print($convocatoriasPublicocv->cv);
                // exit();
                $convocatoriasPublicocv->save();

                //echo "<pre>";
                //print_r($filename);
                $pdf->Output($filename, 'F');
                //---------------------------------------------------fin generar pdf

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

    public function generarcv2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $publicoModel = Publico::findFirstBycodigo((int) $this->request->getPost("id_publico", "int"));
            if ($publicoModel && $publicoModel->estado = 'A') {

                $publico = $publicoModel->codigo;

                // print("id_publico: ".$publico);
                // exit();


                // print($publicoModel->foto);
                // exit();

                //-------------------------------------guardarpdf-------------------------------------------------
                $pdf = new PDF();
                $pdf->AddPage();
                $pdf->enablefooter = 'footer2';

                $pdf->SetFont('Arial', 'B', 13.2);
                $pdf->MultiCell(190, 12.2, '    CURRICULUM  VITAE', 0, 'C');


                $PublicoSql = $this->modelsManager->createQuery("SELECT publico.codigo,publico.id_bonificacion, publico.nacionalidad,publico.tipo, publico.apellidop, publico.apellidom,
                publico.nombres, publico.sexo, publico.fecha_nacimiento, publico.documento, publico.nro_doc, publico.nro_ruc, publico.seguro, publico.telefono,
                publico.celular, publico.email, publico.direccion, publico.ciudad, publico.observaciones, publico.foto, publico.colegio_publico,
                publico.colegio_nombre, publico.sitrabaja, publico.sitrabaja_nombre, publico.sidepende, publico.sidepende_nombre, publico.estado,
                publico.region, publico.provincia, publico.distrito, publico.ubigeo, publico.region1, publico.provincia1, publico.distrito1, publico.ubigeo1,
                publico.localidad, publico.discapacitado, publico.discapacitado_nombre, publico.password, publico.archivo,publico.estado_civil, publico.archivo_cp, publico.archivo_ruc, publico.archivo_dc, publico.sobre_ti, publico.voluntariado,
                publico.expectativas, publico.fecha_emision_dni, tipo_documento.nombres AS nombre_tipo_documento, estado_civil.nombres AS nombre_estado_civil, sexos.nombres AS nombre_sexo,
                regiones.descripcion AS nombre_region, provincias.descripcion AS nombre_provincia, distritos.descripcion AS nombre_distrito, tipo_bonifiaccion.nombres AS tipo_bonificacion, publico.archivo_discapacitado,
                publico.archivo_fa, publico.archivo_dar, publico.archivo_renacyt
                FROM Publico publico
                INNER JOIN TipoDocumento tipo_documento ON publico.documento = tipo_documento.codigo
                INNER JOIN EstadoCivil estado_civil ON publico.estado_civil = estado_civil.codigo
                INNER JOIN TipoBonificaciones tipo_bonifiaccion ON publico.id_bonificacion = tipo_bonifiaccion.codigo
                INNER JOIN Sexo sexos ON CAST (publico.sexo AS INTEGER) = sexos.codigo
                INNER JOIN Regiones regiones ON publico.region = regiones.region
                INNER JOIN Provincias provincias ON publico.provincia = provincias.provincia AND publico.region = provincias.region
                INNER JOIN Distritos distritos ON publico.distrito = distritos.distrito AND publico.provincia = distritos.provincia AND publico.region = distritos.region
                WHERE publico.codigo = {$publico} AND tipo_documento.numero = 1 AND estado_civil.numero = 26 AND sexos.numero = 3 AND tipo_bonifiaccion.numero = 134");
                $PublicoResult = $PublicoSql->execute();


                foreach ($PublicoResult as $Publico) {


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->Cell(174, 9, 'DATOS PERSONALES', 0, 0, 'L');
                    $pdf->Ln(10);

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Apellidos y Nombres', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(190, 6, "{$Publico->apellidop} {$Publico->apellidom} {$Publico->nombres}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Documento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_tipo_documento}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nro. Documento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nro_doc}", 0, 1, 'L');


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Email', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->email}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha de nacimiento', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $fecha_nacimiento_explode1 = explode(" ", $Publico->fecha_nacimiento);
                    $fecha_nacimiento_explode2 = explode("-", $fecha_nacimiento_explode1[0]);
                    $fecha_nacimiento = $fecha_nacimiento_explode2[2] . "/" . $fecha_nacimiento_explode2[1] . "/" . $fecha_nacimiento_explode2[0];
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$fecha_nacimiento}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Celular', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->celular}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Estado Civil', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_estado_civil}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Sexo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_sexo}", 0, 1, 'L');


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nacionalidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nacionalidad}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Región', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_region}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Provincia', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_provincia}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Distrito', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->nombre_distrito}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Dirección', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->direccion}", 0, 1, 'L');




                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Bonificación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$Publico->tipo_bonificacion}", 0, 1, 'L');

                    if ($Publico->id_bonificacion !== 1) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 6, 'Enlace Bonificación', 0, 0, 'L');
                        $pdf->Cell(14, 6, ':', 0, 0, 'L');
                        $pdf->SetFont('Arial', '', 10);
                    }

                    if ($Publico->id_bonificacion == 2) {
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_discapacitado}", 0, 1, 'L');
                    }

                    if ($Publico->id_bonificacion == 3) {
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_fa}", 0, 1, 'L');
                    }

                    if ($Publico->id_bonificacion == 4) {
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_dar}", 0, 1, 'L');
                    }

                    if ($Publico->id_bonificacion == 5) {
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_renacyt}", 0, 1, 'L');
                    }

                    $pdf->Ln(4);
                }

                $convocatoria = Convocatorias::findFirst("activo = 'M'");
                $convocatoria_m = $convocatoria->id_convocatoria;

                $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                    [
                        "publico = $publico AND convocatoria = $convocatoria_m",
                    ]
                );


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'DATOS GENERALES', 0, 0, 'L');
                $pdf->Ln(10);

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Solicitud de inscripción y postulación (Anexo 03):', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_solicitud}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'DNI vigente:', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_dni}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Sílabo de las asignaturas:', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_silabo}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Declaración Jurada. (Anexo 02):', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_dj}", 0, 1, 'L');



                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'COLEGIATURA, HABILITACIÓN, CTI', 0, 0, 'L');
                $pdf->Ln(10);

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Colegiatura:', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_colegiatura}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Habilitación:', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_habilitacion}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'CTI:', 0, 1, 'L');
                $pdf->Cell(16);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_cti}", 0, 1, 'L');

                //excepciones
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_excepciones.codigo,
                public.tbl_web_publico_excepciones.publico,
                public.tbl_web_publico_excepciones.id_tipo_excepcion,
                public.tbl_web_publico_excepciones.nombre,
                to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
                public.tbl_web_publico_excepciones.institucion,
                public.tbl_web_publico_excepciones.archivo,
                public.tbl_web_publico_excepciones.imagen,
                public.tbl_web_publico_excepciones.estado,
                public.tbl_web_publico_excepciones.nro_doc,
                tipodepublicaciones.nombres AS tipo_publicacion
                FROM
                public.tbl_web_publico_excepciones
                INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
                WHERE
                tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'PARA EVALUAR POR EXCEPCIÓN', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {
                    //echo '<pre>';
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tipo de Excepcion', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tipo_publicacion}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$PublicoFormacion->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f = explode(" ", $dataValue->fecha_excepcion);
                    $fotmat_f_f_r = explode("-", $format_f_f[0]);
                    $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                    $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Institucion', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->institucion}", 0, 1, 'L');



                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/excepciones/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                //formacion
                $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                publico_formacion.codigo,
                publico_formacion.publico,
                publico_formacion.grado,
                publico_formacion.nombre,
                publico_formacion.fecha_grado,
                publico_formacion.institucion,
                publico_formacion.pais,
                publico_formacion.archivo,
                publico_formacion.imagen,
                publico_formacion.estado,
                grado_maximo.nombres AS nombre_grado
                FROM
                PublicoFormacion publico_formacion
                INNER JOIN GradoMaximo grado_maximo ON grado_maximo.codigo = publico_formacion.grado
                WHERE
                publico_formacion.estado = 'A'
                AND grado_maximo.numero = 69
                AND publico_formacion.publico = {$publico} ORDER BY publico_formacion.fecha_grado DESC");
                $PublicoFormacionResult = $PublicoFormacionSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'GRADOS ACADÉMICOS Y TÍTULOS PROFESIONALES', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($PublicoFormacionResult as $PublicoFormacion) {
                    //echo '<pre>';
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Grado / Titulo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->nombre_grado}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$PublicoFormacion->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$PublicoFormacion->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f = explode(" ", $PublicoFormacion->fecha_grado);
                    $fotmat_f_f_r = explode("-", $format_f_f[0]);
                    $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                    $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->pais}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$PublicoFormacion->institucion}", 0, 1, 'L');

                    if ($PublicoFormacion->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/formacion/{$PublicoFormacion->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                //capacitaciones
                $ConvocatoriasPublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                publico_capacitaciones.codigo,
                publico_capacitaciones.publico,
                publico_capacitaciones.capacitacion,
                publico_capacitaciones.nombre,
                publico_capacitaciones.fecha_inicio,
                publico_capacitaciones.fecha_fin,
                publico_capacitaciones.institucion,
                publico_capacitaciones.pais,
                publico_capacitaciones.archivo,
                publico_capacitaciones.imagen,
                publico_capacitaciones.estado,
                capacitaciones.nombres AS nombre_capacitacion,
                publico_capacitaciones.horas,
                publico_capacitaciones.creditos
                FROM
                PublicoCapacitaciones publico_capacitaciones
                INNER JOIN Capacitaciones capacitaciones ON capacitaciones.codigo = publico_capacitaciones.capacitacion
                WHERE
                publico_capacitaciones.estado = 'A'
                AND capacitaciones.numero = 86
                AND publico_capacitaciones.publico = {$publico} ORDER BY publico_capacitaciones.fecha_inicio DESC");
                $ConvocatoriasPublicoCapacitacionesResult = $ConvocatoriasPublicoCapacitacionesSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'ACTUALIZACIONES Y CAPACITACIONES', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($ConvocatoriasPublicoCapacitacionesResult as $ConvocatoriasPublicoCapacitaciones) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->institucion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Horas', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->horas}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Créditos', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->creditos}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_i_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_inicio);
                    $fotmat_f_i_c_r = explode("-", $format_f_i_c[0]);
                    $fotmat_f_i_c_r_r = $fotmat_f_i_c_r[2] . "/" . $fotmat_f_i_c_r[1] . "/" . $fotmat_f_i_c_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_i_c_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_fin);
                    $fotmat_f_f_c_r = explode("-", $format_f_f_c[0]);
                    $fotmat_f_f_c_r_r = $fotmat_f_f_c_r[2] . "/" . $fotmat_f_f_c_r[1] . "/" . $fotmat_f_f_c_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_f_c_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->pais}", 0, 'L');

                    if ($ConvocatoriasPublicoCapacitaciones->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                        $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 'L');
                    }

                    $pdf->Ln(5);
                }

                //publicaciones
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_publicaciones.codigo,
                public.tbl_web_publico_publicaciones.publico,
                public.tbl_web_publico_publicaciones.id_tipo_publicacion,
                public.tbl_web_publico_publicaciones.nombre,
                to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
                public.tbl_web_publico_publicaciones.doi,
                public.tbl_web_publico_publicaciones.pais,
                public.tbl_web_publico_publicaciones.archivo,
                public.tbl_web_publico_publicaciones.imagen,
                public.tbl_web_publico_publicaciones.estado,
                public.tbl_web_publico_publicaciones.nro_paginas,
                public.tbl_web_publico_publicaciones.nro_doc,
                tipo_de_publicaciones.nombres AS tipo_publicacion
                FROM
                public.a_codigos AS tipo_de_publicaciones
                INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
                WHERE
                tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'TRABAJOS DE INVESTIGACIÓN Y PUBLICACIONES', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tipo de Publicacion', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tipo_publicacion}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha Publicacion', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "$dataValue->fecha_publicacion", 0, 1, 'L');

                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/publicaciones/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                //experiencia
                $ConvocatoriasPublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
            publico_experiencia.codigo,
            publico_experiencia.publico,
            publico_experiencia.tipo,
            publico_experiencia.cargo,
            publico_experiencia.fecha_inicio,
            publico_experiencia.fecha_fin,
            publico_experiencia.tiempo,
            publico_experiencia.institucion,
            publico_experiencia.funciones,
            publico_experiencia.archivo,
            publico_experiencia.imagen,
            publico_experiencia.estado,
            tipo_experiencia_laboral.nombres AS nombre_tipo
            FROM
            PublicoExperiencia publico_experiencia
            INNER JOIN TipoExperienciaLaboral tipo_experiencia_laboral ON tipo_experiencia_laboral.codigo = publico_experiencia.tipo
            WHERE
            publico_experiencia.estado = 'A'
            AND tipo_experiencia_laboral.numero = 87
            AND publico_experiencia.publico = {$publico} ORDER BY publico_experiencia.fecha_inicio DESC");
                $ConvocatoriasPublicoExperienciaResult = $ConvocatoriasPublicoExperienciaSql->execute();

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'EXPERIENCIA ACADÉMICA Y PROFESIONAL', 0, 0, 'L');
                $pdf->Ln(10);

                foreach ($ConvocatoriasPublicoExperienciaResult as $ConvocatoriasPublicoExperiencia) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->nombre_tipo}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Institución', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->institucion}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Cargo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->cargo}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_i_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_inicio);
                    $fotmat_f_i_e_r = explode("-", $format_f_i_e[0]);
                    $fotmat_f_i_e_r_r = $fotmat_f_i_e_r[2] . "/" . $fotmat_f_i_e_r[1] . "/" . $fotmat_f_i_e_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_i_e_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $format_f_f_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_fin);
                    $fotmat_f_f_e_r = explode("-", $format_f_f_e[0]);
                    $fotmat_f_f_e_r_r = $fotmat_f_f_e_r[2] . "/" . $fotmat_f_f_e_r[1] . "/" . $fotmat_f_f_e_r[0];
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$fotmat_f_f_e_r_r}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tiempo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    //
                    $dteStart = new DateTime($ConvocatoriasPublicoExperiencia->fecha_inicio);
                    $dteEnd = new DateTime($ConvocatoriasPublicoExperiencia->fecha_fin);
                    $interval = $dteStart->diff($dteEnd);

                    //print($interval->format('%a'));
                    //exit();

                    $total_meses = ($interval->format('%a')) / 30;
                    $total_meses_result = round($total_meses);

                    //print($total_meses_result);
                    //exit();
                    //
                    //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->tiempo}", 0, 1, 'L');
                    $pdf->MultiCell(120, 6, "{$total_meses_result}", 0, 'L');

                    if ($ConvocatoriasPublicoExperiencia->archivo !== null) {

                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                        $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/experiencia/{$ConvocatoriasPublicoExperiencia->archivo}", 0, 'L');
                    }

                    $pdf->Ln(5);
                }

                //cargos
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_cargos.codigo,
                public.tbl_web_publico_cargos.tipo_institucion,
                public.tbl_web_publico_cargos.nombre,
                public.tbl_web_publico_cargos.institucion,
                to_char(public.tbl_web_publico_cargos.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
                to_char(public.tbl_web_publico_cargos.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
                public.tbl_web_publico_cargos.archivo,
                public.tbl_web_publico_cargos.estado,
                tipodecargos.nombres AS tipo_cargo
                FROM
                public.tbl_web_publico_cargos
                INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
                WHERE
                tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'CARGOS DIRECTIVOS O APOYO ADMINISTRATIVO', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tipo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tipo_cargo}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "$dataValue->fecha_inicio", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "$dataValue->fecha_fin", 0, 1, 'L');

                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/cargos/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                //materiales
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_materiales.codigo,
                tipo_de_materiales.nombres AS tipo_material,
                public.tbl_web_publico_materiales.publico,
                public.tbl_web_publico_materiales.id_tipo_material,
                public.tbl_web_publico_materiales.nombre,
                to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
                public.tbl_web_publico_materiales.archivo,
                public.tbl_web_publico_materiales.imagen,
                public.tbl_web_publico_materiales.nro_doc,
                public.tbl_web_publico_materiales.estado
                FROM
                public.a_codigos AS tipo_de_materiales
                INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
                WHERE
                tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'ELABORACIÓN DE MATERIALES DE ENSEÑANZA', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tipo de Material', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tipo_material}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "$dataValue->fecha", 0, 1, 'L');


                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/materiales/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }


                //idiomas
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_idiomas.codigo,
                tipodeidiomas.nombres AS tipo_idioma,
                public.tbl_web_publico_idiomas.publico,
                public.tbl_web_publico_idiomas.id_tipo_idioma,
                public.tbl_web_publico_idiomas.nombre,
                to_char(public.tbl_web_publico_idiomas.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
                to_char(public.tbl_web_publico_idiomas.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
                public.tbl_web_publico_idiomas.institucion,
                public.tbl_web_publico_idiomas.pais,
                public.tbl_web_publico_idiomas.id_nivel,
                public.tbl_web_publico_idiomas.horas,
                public.tbl_web_publico_idiomas.creditos,
                public.tbl_web_publico_idiomas.archivo,
                public.tbl_web_publico_idiomas.imagen,
                public.tbl_web_publico_idiomas.nro_doc,
                public.tbl_web_publico_idiomas.estado
                FROM
                public.a_codigos AS tipodeidiomas
                INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
                WHERE
                tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'CONOCIMIENTO DE IDIOMAS', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tipo', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tipo_idioma}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha Inicio', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "$dataValue->fecha_inicio", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha Fin', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "$dataValue->fecha_fin", 0, 1, 'L');


                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/idiomas/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                //asesorias
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_asesorias.codigo,
                tipo_grado.nombres AS tipo_grado,
                public.tbl_web_publico_asesorias.publico,
                public.tbl_web_publico_asesorias.id_grado,
                public.tbl_web_publico_asesorias.tesista,
                to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
                public.tbl_web_publico_asesorias.url,
                public.tbl_web_publico_asesorias.archivo,
                public.tbl_web_publico_asesorias.imagen,
                public.tbl_web_publico_asesorias.nro_doc,
                public.tbl_web_publico_asesorias.estado,
                public.tbl_web_universidades.universidad,
                tipodeinstitucion.nombres AS tipo_institucion
                FROM
                public.tbl_web_publico_asesorias
                INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
                INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
                INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
                WHERE
                tipodeinstitucion.numero = 105 AND
                tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'ASESORÍA DE TESIS', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Universidades', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->universidad}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Grado', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tipo_grado}", 0, 1, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Tesista', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->tesista}", 0, 1, 'L');


                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->fecha}", 0, 'L');

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Url', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->url}", 0, 'L');



                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/asesorias/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }

                //extension
                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_publico_extension.codigo,
                public.tbl_web_publico_extension.publico,
                public.tbl_web_publico_extension.nombre,
                to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
                public.tbl_web_publico_extension.archivo,
                public.tbl_web_publico_extension.imagen,
                public.tbl_web_publico_extension.estado
                FROM
                public.tbl_web_publico_extension
                WHERE
                public.tbl_web_publico_extension.publico = $publico";
                // print($sqlQuery);
                // exit();
                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'ACTIVIDADES DE PROYECCIÓN SOCIAL Y/O EXTENSIÓN CULTURAL', 0, 0, 'L');
                $pdf->Ln(10);
                foreach ($data as $dataValue) {




                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(120, 6, "{$dataValue->nombre}", 0, 1, 'L');



                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->MultiCell(120, 6, "{$dataValue->fecha}", 0, 'L');



                    if ($dataValue->archivo !== null) {
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                        $pdf->Cell(14, 4, ':', 0, 1, 'L');
                        $pdf->Cell(16);
                        $pdf->SetFont('Arial', '', 8);
                        $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/extension/{$dataValue->archivo}", 0, 1, 'L');
                    }

                    $pdf->Ln(5);
                }



                $publicoDatos = Publico::findFirstBycodigo($publico);

                $pdf->Ln(5);
                $pdf->Cell(100);
                $pdf->Cell(80, 5, '_________________________________________', 0, 0, 'C');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(100);
                $pdf->Cell(80, 5, "{$publicoDatos->apellidop} {$publicoDatos->apellidom} {$publicoDatos->nombres}", 0, 1, 'C');
                $pdf->Cell(100);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(80, 5, "DNI.{$publicoDatos->nro_doc}", 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->Ln(10);

                $valueCP = ConvocatoriasPublico::findFirstBypublico($publicoDatos->codigo);

                $idCOnvocatoria = $valueCP->convocatoria;
                $nroDoc = $publicoDatos->nro_doc;

                $filename = "adminpanel/archivos/convocatorias_publico/cvs/{$idCOnvocatoria}-CV-{$nroDoc}.pdf";

                $convocatoriasPublicocv = ConvocatoriasDocentes::findFirstBypublico($publicoDatos->codigo);
                $convocatoriasPublicocv->cv = "{$idCOnvocatoria}-CV-{$nroDoc}.pdf";
                $convocatoriasPublicocv->save();

                //echo "<pre>";
                //print_r($filename);
                $pdf->Output($filename, 'F');
                //---------------------------------------------------fin generar pdf

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

    public function verificarcvAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {


            //    echo '<pre>';
            //    print_r($_POST);
            //    exit(); 

            $id_publico = (int) $this->request->getPost("id_publico", "int");
            $id_convocatoria = (int) $this->request->getPost("convocatoria", "int");

            $model = ConvocatoriasPublico::findFirst("publico = {$id_publico} AND convocatoria = {$id_convocatoria}");

            // print($model->codigo);
            // exit();

            if ($model && $model->cv !== "" && $model->cv !== null) {
                // print("Tiene CV");
                // exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                // print("No Tiene CV");
                // exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function verificarcv2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //    echo '<pre>';
            //    print_r($_POST);
            //    exit();

            $model = ConvocatoriasPublico::findFirstBypublico((int) $this->request->getPost("id_publico", "int"));
            if ($model->cv !== "" && $model->cv !== null) {
                // print("Tiene CV");
                // exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                // print("No Tiene CV");
                // exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }



    public function postulantes2Action($perfil_puesto, $convocatoria)
    {

        //        $auth = $this->session->get('auth');
        //        echo '<pre>';
        //        print_r($auth);
        //        exit();

        $this->view->perfil_puesto = $perfil_puesto;
        $this->view->convocatoria = $convocatoria;

        //grado
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;


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

        $tipobonificaciones = TipoBonificaciones::find("estado = 'A' AND numero = 134 ORDER BY orden ASC");
        $this->view->tipobonificaciones = $tipobonificaciones;

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.postulantes2.js?v" . uniqid());
    }

    public function datatablePostulaantes2Action($perfil, $convocatoria)
    {
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

    public function postulantes4Action($perfil_puesto, $convocatoria)
    {

        //        $auth = $this->session->get('auth');
        //        echo '<pre>';
        //        print_r($auth);
        //        exit();

        $this->view->perfil_puesto = $perfil_puesto;
        $this->view->convocatoria = $convocatoria;


        //resultado
        $ResultadosConvocatoria = ResultadosConvocatoria::find("estado = 'A' AND numero = 89 ");
        $this->view->resultados_convocatoria = $ResultadosConvocatoria;

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatorias.postulantes4.js?v" . uniqid());
    }

    public function datatablePostulaantes4Action($perfil, $convocatoria)
    {
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
                                    INNER JOIN docentes AS publico ON publico.codigo = convocatorias_publico.publico) AS temporal_table");
            $datatable->setWhere("perfil={$perfil} AND convocatoria = {$convocatoria}");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getPublicoDatosGeneralesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $id_publico = (int) $this->request->getPost("id", "int");
            $convocatoria = (int) $this->request->getPost("convocatoria", "int");

            //$convocatoria_m = Convocatorias::findFirst("activo = 'M'");

            // print($convocatoria);
            // exit();


            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria AND publico = $id_publico",
                ]
            );

            // print($ConvocatoriasPublico->publico);
            // exit();

            if ($ConvocatoriasPublico) {
                $this->response->setJsonContent($ConvocatoriasPublico->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function getPublicoDatosGenerales2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_publico = (int) $this->request->getPost("id", "int");

            $convocatoria_m = Convocatorias::findFirst("estado = 'A' and (etapa = 1 or etapa = 2) and tipo = 2");


            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria_m->id_convocatoria AND publico = $id_publico",
                ]
            );

            if ($ConvocatoriasPublico) {
                $this->response->setJsonContent($ConvocatoriasPublico->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }
}
