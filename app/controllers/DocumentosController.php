<?php

class DocumentosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/documentos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar Documentos y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $documentos = Documentos::findFirstByid_documento((int) $id);
        } else {


            $documentos_nuevo = Documentos::count();

            //print($docente_nuevo[0]->id_documento); exit();
            $documentos->id_documento = $documentos_nuevo + 1;
            $this->view->documentos = $documentos;
        }
        
        $this->view->documentos = $documentos;
        
        //TipoDocumentos
        $tipo_documento_gestion = TipoDocumentoGestion::find("estado = 'A' AND numero = 90 ORDER BY codigo ");
        $this->view->tipodocumentosgestion = $tipo_documento_gestion;
        
        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_documento");
            $datatable->setSelect("id_documento,descripcion,archivo,estado");
            $datatable->setFrom("tbl_web_documentos");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_documento DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction() {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_documento", "int");
                $Documentos = Documentos::findFirstByid_documento($id);
                //Valida cuando es nuevo
                $Documentos = (!$Documentos) ? new Documentos() : $Documentos;

                //id_documento        
                $Documentos->id_documento = $this->request->getPost("id_documento", "int");

                //descripcion
                $Documentos->descripcion = $this->request->getPost("descripcion", "string");

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
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $documentos = Documentos::findFirstByid_documento((int) $this->request->getPost("id", "int"));
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

}
