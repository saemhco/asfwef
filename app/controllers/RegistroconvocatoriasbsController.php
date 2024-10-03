<?php

class RegistroconvocatoriasbsController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatoriasbs.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    //Funcion agregar y editar
    public function registroAction($id = null, $id_detalle = null)
    {
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

            $convocatoriasbs = ConvocatoriasBs::findFirstByid_convocatoria_bs(0);
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

        $Pesonal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->personal = $Pesonal;

        $this->assets->addJs("adminpanel/js/modulos/registroconvocatoriasbs.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroconvocatoriasbs.usuarios.detalles.js?v=" . uniqid());
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
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convbs.id_convocatoria_bs");
            $datatable->setSelect("convbs.id_convocatoria_bs,"
                . "aco.nombres as tipo_resolucion, "
                . "convbs.titulo, convbs.texto_muestra, "
                . "convbs.fecha_hora, convbs.archivo, "
                . "convbs.imagen, convbs.enlace, "
                . "convbs.estado,etapas.nombres AS etapa");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("tbl_web_convocatorias_bs convbs
                INNER JOIN a_codigos aco ON CAST (convbs.tipo AS INTEGER) = aco.codigo
                INNER JOIN a_codigos etapas ON convbs.etapa = etapas.codigo
                ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("convbs.estado = 'A' AND aco.numero = 72");
            $datatable->setWhere("aco.numero = 91 AND etapas.numero = 81");
            $datatable->setOrderby("convbs.id_convocatoria_bs DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
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
    public function datatableArchivosAction($id)
    {
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

    public function savearchivoAction()
    {

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
    public function getAjaxArchivosAction()
    {
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

    public function eliminarDetalleAction()
    {
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

    public function perfilesAction($convocatoria)
    {

        $this->view->convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/registroconvocatoriasbs.perfiles.js?v" . uniqid());
    }

    public function datatablesPerfilesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs_perfil");
            $datatable->setSelect("public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs_perfil, "
                . "public.tbl_web_convocatorias_bs_perfiles.nombre, "
                . "public.tbl_web_convocatorias_bs_perfiles.nombre_corto, "
                . "public.tbl_web_convocatorias_bs_perfiles.estado, "
                . "public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs");
            $datatable->setFrom("public.tbl_web_convocatorias_bs_perfiles");
            $datatable->setWhere("public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs = $id");
            $datatable->setOrderby("public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs_perfil DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxPerfilesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ConvocatoriasbsPerfiles::findFirstByid_convocatoria_bs_perfil((int) $this->request->getPost("id", "int"));
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

    public function savePerfilesAction()
    {

        //    echo '<pre>';
        //    print_r($_POST);
        //    exit();

        //    echo '<pre>';
        //    print_r($_FILES);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_convocatoria_bs_perfil", "int");
                $convocatoriasbsPerfiles = ConvocatoriasbsPerfiles::findFirstByid_convocatoria_bs_perfil($id);
                $convocatoriasbsPerfiles = (!$convocatoriasbsPerfiles) ? new ConvocatoriasbsPerfiles() : $convocatoriasbsPerfiles;

                //codigo
                $convocatoriasbsPerfiles->id_convocatoria_bs_perfil = $this->request->getPost("id_convocatoria_bs_perfil", "int");

                //convocatoria
                $convocatoriasbsPerfiles->id_convocatoria_bs = $this->request->getPost("id_convocatoria_bs", "int");

                //nombre
                $convocatoriasbsPerfiles->nombre = $this->request->getPost("nombre", "string");

                //nombre_corto
                $convocatoriasbsPerfiles->nombre_corto = $this->request->getPost("nombre_corto", "string");

                //condiciones
                $convocatoriasbsPerfiles->condiciones = $this->request->getPost("condiciones");

                //estado
                $convocatoriasbsPerfiles->estado = 'A';

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    //print($fecha_new);
                    //exit();

                    $hora = $this->request->getPost("hora_inicio", "string");
                    $convocatoriasbsPerfiles->fecha_inicio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                //fecha fin
                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_fin", "string");
                    $convocatoriasbsPerfiles->fecha_fin = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                if ($convocatoriasbsPerfiles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($convocatoriasbsPerfiles->getMessages());
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
                                            $url_destino = 'adminpanel/imagenes/convocatoriasbs/' . $convocatoriasbsPerfiles->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/convocatoriasbs_perfiles/' . 'IMG' . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '-' . $temporal_rand . '.' . $extension;
                                            $convocatoriasbsPerfiles->imagen = 'IMG' . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '-' . $temporal_rand . '.' . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/convocatoriasbs_perfiles/' . 'IMG' . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '.' . $extension;
                                            $convocatoriasbsPerfiles->imagen = 'IMG' . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '.' . $extension;
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
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($convocatoriasbsPerfiles->imagen)) {
                                        $url_destino = 'adminpanel/archivos/convocatoriasbs_perfiles/' . $convocatoriasbsPerfiles->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/convocatoriasbs_perfiles/FILE-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '-' . $temporal_rand . '.pdf';
                                        $convocatoriasbsPerfiles->archivo = 'FILE-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/convocatoriasbs_perfiles/FILE-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '.pdf';
                                        $convocatoriasbsPerfiles->archivo = 'FILE-' . $convocatoriasbsPerfiles->id_convocatoria_bs . '-' . $convocatoriasbsPerfiles->id_convocatoria_bs_perfil . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $convocatoriasbsPerfiles->save();
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

        $this->assets->addJs("adminpanel/js/modulos/convocatoriasbs.postulantes.js?v" . uniqid());
    }

    public function datatablePostulaantesAction($perfil, $convocatoria)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_convocatoria_bs_empresa");
            $datatable->setSelect("id_convocatoria_bs_empresa, id_empresa, razon_social,ruc, anexos");
            $datatable->setFrom("(SELECT
            public.tbl_web_convocatorias_bs_empresas.id_convocatoria_bs_empresa,
            public.tbl_btr_empresas.razon_social,
            public.tbl_btr_empresas.ruc,
            public.tbl_web_convocatorias_bs_empresas.anexos,
            public.tbl_web_convocatorias_bs_empresas.id_convocatoria_bs_perfil,
            public.tbl_web_convocatorias_bs_empresas.id_convocatoria_bs,
            public.tbl_web_convocatorias_bs_empresas.id_empresa
            FROM
            public.tbl_web_convocatorias_bs_empresas
            INNER JOIN public.tbl_btr_empresas ON public.tbl_btr_empresas.id_empresa = public.tbl_web_convocatorias_bs_empresas.id_empresa) AS temporal_table");
            $datatable->setWhere("id_convocatoria_bs_perfil={$perfil} AND id_convocatoria_bs = {$convocatoria}");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getResultadosConvocatoriasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $convocatoriasEmpresasResultados = ConvocatoriasbsEmpresasResultados::findFirstByid_empresa((int) $this->request->getPost("id_empresa", "int"));
            if ($convocatoriasEmpresasResultados) {
                $this->response->setJsonContent($convocatoriasEmpresasResultados->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveResultadosConvocatoriabsAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_empresa", "int");

                $convocatoriasEmpresasResultados = ConvocatoriasbsEmpresasResultados::findFirstByid_empresa($id);

                //print($convocatoriasEmpresasResultados->publico);
                //exit();

                $convocatoriasEmpresasResultados->proceso = $this->request->getPost("proceso", "int");

                if ($convocatoriasEmpresasResultados->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($convocatoriasEmpresasResultados->getMessages());
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

    public function eliminarPerfilesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $convocatoriasbsPerfiles = ConvocatoriasbsPerfiles::findFirstByid_convocatoria_bs_perfil((int) $this->request->getPost("id", "int"));

            if ($convocatoriasbsPerfiles && $convocatoriasbsPerfiles->estado = 'A') {
                $convocatoriasbsPerfiles->estado = 'X';
                $convocatoriasbsPerfiles->save();
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
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_web_convocatorias_bs' AND tipo = 3");
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

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_web_convocatorias_bs' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");
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

    public function saveUsuariosDetallesAction()
    {

        //    echo "<pre>";
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_usuario_detalle", "int");
                $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id);
                $UsuariosDetalles = (!$UsuariosDetalles) ? new UsuariosDetalles() : $UsuariosDetalles;

                $UsuariosDetalles->id_usuario = $this->request->getPost("id_usuario", "int");
                $UsuariosDetalles->tabla = "tbl_web_convocatorias_bs";
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

}
