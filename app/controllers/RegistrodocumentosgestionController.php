<?php

class RegistrodocumentosgestionController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrodocumentosgestion.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    //Funcion agregar Documentos y editar
    public function registroAction($id = null)
    {


        $this->view->id = $id;
        if ($id != null) {
            $documentos = Documentosgestion::findFirstByid_documento((int) $id);
        } else {

            $documentos = Documentosgestion::findFirstByid_documento(0);
        }
        $this->view->documentos = $documentos;



        //TipoDocumentos
        $tipo_documento_gestion = TipoDocumentoGestion::find("estado = 'A' AND numero = 90 ORDER BY nombres ASC ");
        $this->view->tipodocumentosgestion = $tipo_documento_gestion;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        //Archivos.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/registrodocumentosgestion.archivos.js?v=" . uniqid());
    //Evaluaciones.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/registrodocumentosgestion.evaluaciones.js?v=" . uniqid());

        $resoluciones = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'titulo DESC',
            ]
        );
        $this->view->resoluciones = $resoluciones;
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        /*
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_documento");
            $datatable->setSelect("tbl_web_documentos.id_documento,tbl_web_documentos.titulo,tbl_web_documentos.archivo,tbl_web_documentos.estado");
            $datatable->setFrom("tbl_web_documentos");            
            $datatable->setOrderby("tbl_web_documentos.id_documento DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
        */
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,fecha,tipo,titulo,archivo,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_documentos.id_documento as codigo,
            tipo_doc.nombres AS tipo,                        
            to_char(public.tbl_web_documentos.fecha_hora, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_documentos.titulo,
            public.tbl_web_documentos.archivo,
            public.tbl_web_documentos.estado            
            FROM
            public.tbl_web_documentos
            INNER JOIN public.a_codigos AS tipo_doc ON tipo_doc.codigo = public.tbl_web_documentos.tipo            
            WHERE
            tipo_doc.numero = 90) AS temporal_table");
            $datatable->setOrderby("codigo DESC");
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

                $id = (int) $this->request->getPost("id_documento", "int");
                $Documentos = Documentosgestion::findFirstByid_documento($id);
                $Documentos = (!$Documentos) ? new Documentosgestion() : $Documentos;

               
                //titulo
                $Documentos->titulo = $this->request->getPost("titulo", "string");

                //referencia
                $Documentos->referencia = $this->request->getPost("referencia", "string");

                //referencia_enlace
                $Documentos->referencia_enlace = $this->request->getPost("referencia_enlace", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Documentos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("orden", "int") == "") {
                    $Documentos->orden = null;
                } else {
                    $Documentos->orden = $this->request->getPost("orden", "int");
                }

                if ($this->request->getPost("tipo", "int") == "") {
                    $Documentos->tipo = null;
                } else {
                    $Documentos->tipo = $this->request->getPost("tipo", "int");
                }

                //enlace
                $Documentos->enlace = $this->request->getPost("enlace", "string");

                $visible = $this->request->getPost("visible", "string");
                
                if (isset($visible)) {
                    $Documentos->visible = 1;
                } else {
                    $Documentos->visible = 0;
                }

                //echo "<pre>";
                //print_r($Documentos->archivo);
                //exit();
                //estado
                $Documentos->estado = "A";

                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $Documentos->id_resolucion = null;
                } else {
                    $Documentos->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($Documentos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Documentos->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Documentos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/documentos/' . $Documentos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/documentos/' . 'IMG' . '-' . $Documentos->id_documento . '-' . $temporal_rand . '.jpg';
                                        $Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . '-' . $temporal_rand . ".jpg";
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/documentos/' . 'IMG' . '-' . $Documentos->id_documento . '.jpg';
                                        $Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Documentos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/documentos/' . $Documentos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/documentos/' . 'IMG' . '-' . $Documentos->id_documento . '-' . $temporal_rand . '.png';
                                        $Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . '-' . $temporal_rand . ".png";
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/documentos/' . 'IMG' . '-' . $Documentos->id_documento . '.png';
                                        $Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . ".jpg";
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_documento") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Documentos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/documentos/' . $Documentos->archivo;

                                        //echo '<pre>';
                                        //print_r($url_destino);
                                        //exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/documentos/' . $Documentos->enlace . '-' . $temporal_rand . '.pdf';
                                        $Documentos->archivo = $Documentos->enlace . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/documentos/' . $Documentos->enlace . '.pdf';
                                        $Documentos->archivo = $Documentos->enlace . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Documentos->imagen = 'IMG' . '-' . $Documentos->id_documento . ".jpg";
                                    }
                                }
                            }
                        }

                        $Documentos->save();
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

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $documentos = Documentosgestion::findFirstByid_documento((int) $this->request->getPost("id", "int"));
            if ($documentos && $documentos->estado = 'A') {
                $documentos->estado = 'X';
                $documentos->save();
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

    public function datatableArchivosAction($id)
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
            public.tbl_web_documentos_archivos.estado,
            public.tbl_web_documentos_archivos.orden");
            $datatable->setFrom("public.tbl_web_documentos_archivos");
            $datatable->setWhere("public.tbl_web_documentos_archivos.id_documento = $id");
            $datatable->setOrderby("public.tbl_web_documentos_archivos.orden DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDocumentosArchivosAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_documento_archivo", "int");
                $documentosArchivos = DocumentosArchivos::findFirstByid_documento_archivo($id);
                $documentosArchivos = (!$documentosArchivos) ? new DocumentosArchivos() : $documentosArchivos;

                $documentosArchivos->id_documento = $this->request->getPost("id_documento", "int");

                $documentosArchivos->titulo = $this->request->getPost("titulo_archivo", "string");

                if ($this->request->getPost("fecha_hora_archivo", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_archivo", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $documentosArchivos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $documentosArchivos->enlace = $this->request->getPost("enlace_archivo", "string");

                $documentosArchivos->orden = $this->request->getPost("orden_archivo", "int");
                $documentosArchivos->estado = "A";

                $visible = $this->request->getPost("visible_archivo", "string");
                if (isset($visible)) {
                    $documentosArchivos->visible = "1";
                } else {
                    $documentosArchivos->visible = "0";
                }


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $documentosArchivos->id_resolucion = null;
                } else {
                    $documentosArchivos->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($documentosArchivos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($documentosArchivos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "documentos_archivo") {

                                if ($_FILES['documentos_archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['documentos_archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($documentosArchivos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/documentos_archivos/' . $documentosArchivos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/documentos_archivos/' . $documentosArchivos->enlace . '-' . $temporal_rand . "." . $extension;
                                            $documentosArchivos->archivo = $documentosArchivos->enlace . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/documentos_archivos/' . $documentosArchivos->enlace . "." . $extension;
                                            $documentosArchivos->archivo = $documentosArchivos->enlace . "." . $extension;
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

                        $documentosArchivos->save();
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

    public function getAjaxDocumentosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocumentosArchivos::findFirstByid_documento_archivo((int) $this->request->getPost("id", "int"));
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

    public function eliminarDocumentosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocumentosArchivos::findFirstByid_documento_archivo((int) $this->request->getPost("id", "int"));
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

    public function datatableEvaluacionesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_documento_evaluacion");
            $datatable->setSelect("public.tbl_web_documentos_evaluaciones.id_documento_evaluacion,
            public.tbl_web_documentos_evaluaciones.id_documento,
            public.tbl_web_documentos_evaluaciones.titulo,
            to_char( public.tbl_web_documentos_evaluaciones.fecha_hora, 'DD/MM/YYYY' ) AS fecha_hora,
            public.tbl_web_documentos_evaluaciones.archivo,
            public.tbl_web_documentos_evaluaciones.enlace,
            public.tbl_web_documentos_evaluaciones.estado");
            $datatable->setFrom("public.tbl_web_documentos_evaluaciones");
            $datatable->setWhere("public.tbl_web_documentos_evaluaciones.id_documento = $id");
            $datatable->setOrderby("public.tbl_web_documentos_evaluaciones.fecha_hora DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDocumentosEvaluacionesAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_documento_evaluacion", "int");
                $documentosEvaluaciones = DocumentosEvaluaciones::findFirstByid_documento_evaluacion($id);
                $documentosEvaluaciones = (!$documentosEvaluaciones) ? new DocumentosEvaluaciones() : $documentosEvaluaciones;

                $documentosEvaluaciones->id_documento = $this->request->getPost("id_documento", "int");

                $documentosEvaluaciones->titulo = $this->request->getPost("titulo_evaluacion", "string");

                if ($this->request->getPost("fecha_hora_evaluacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_evaluacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $documentosEvaluaciones->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $documentosEvaluaciones->enlace = $this->request->getPost("enlace_evaluacion", "string");

                $documentosEvaluaciones->orden = $this->request->getPost("orden_evaluacion", "int");
                $documentosEvaluaciones->estado = "A";

                $visible = $this->request->getPost("visible_evaluacion", "string");
                if (isset($visible)) {
                    $documentosEvaluaciones->visible = "1";
                } else {
                    $documentosEvaluaciones->visible = "0";
                }


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $documentosEvaluaciones->id_resolucion = null;
                } else {
                    $documentosEvaluaciones->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($documentosEvaluaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($documentosEvaluaciones->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "documentos_evaluacion") {

                                if ($_FILES['documentos_evaluacion']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['documentos_evaluacion']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($documentosEvaluaciones->archivo)) {
                                            $url_destino = 'adminpanel/archivos/documentos_evaluaciones/' . $documentosEvaluaciones->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/documentos_evaluaciones/' . $documentosEvaluaciones->enlace . '-' . $temporal_rand . "." . $extension;
                                            $documentosEvaluaciones->archivo = $documentosEvaluaciones->enlace . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/documentos_evaluaciones/' . $documentosEvaluaciones->enlace . "." . $extension;
                                            $documentosEvaluaciones->archivo = $documentosEvaluaciones->enlace . "." . $extension;
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

                        $documentosEvaluaciones->save();
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

    public function getAjaxDocumentosEvaluacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocumentosEvaluaciones::findFirstByid_documento_evaluacion((int) $this->request->getPost("id", "int"));
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

    public function eliminarDocumentosEvaluacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocumentosEvaluaciones::findFirstByid_documento_evaluacion((int) $this->request->getPost("id", "int"));
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
