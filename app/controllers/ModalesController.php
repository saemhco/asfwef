<?php

class ModalesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/modales.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $modales = Modales::findFirstByid_modal((int) $id);
        } else {



            $modales_nuevo = Modales::count();

            //print($docente_nuevo[0]->codigo); exit();
            $modales->id_modal = $modales_nuevo + 1;
            $this->view->modales = $modales;
        }

        $this->view->modales = $modales;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
    }

    //Funcion guardar
    public function saveAction() {


//        echo "<pre>";
//        print_r($_POST);
//        exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_modal", "int");
                $Modales = Modales::findFirstByid_modal($id);
                //Valida cuando es nuevo
                $Modales = (!$Modales) ? new Modales() : $Modales;

                //id_modal
                $Modales->id_modal = $this->request->getPost("id_modal", "int");

                //titulo
                $Modales->titulo = $this->request->getPost("titulo", "string");

                $Modales->subtitulo = $this->request->getPost("subtitulo", "string");

                //descripcion
                //$Modales->descripcion = $this->request->getPost("descripcion");
                $Modales->descripcion = $this->request->getPost("descripcion");

                //titulo
                $Modales->tipo = $this->request->getPost("tipo", "int");

                //enlace
                $Modales->enlace = $this->request->getPost("enlace", "string");

                //estado
                //$estado = $this->request->getPost("estado", "string");
//                //if (isset($estado)) {
                    $Modales->estado = "A";
//                } else {
//                    $Modales->estado = "X";
//                }

                //esimagen
                $esimagen = $this->request->getPost("esimagen", "string");
                if (isset($esimagen)) {
                    $Modales->esimagen = "A";
                } else {
                    $Modales->esimagen = "X";
                }

                //orden
                $Modales->orden = $this->request->getPost("orden", "int");


                if ($Modales->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Modales->getMessages());
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

                                    if (isset($Modales->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/modales/' . $Modales->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/modales/' . 'IMG' . '-' . $Modales->id_modal . '-' . $temporal_rand . '.jpg';
                                        $Modales->imagen = 'IMG' . '-' . $Modales->id_modal . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/modales/' . 'IMG' . '-' . $Modales->id_modal . '.jpg';
                                        $Modales->imagen = 'IMG' . '-' . $Modales->id_modal . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Modales->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/modales/' . $Modales->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/modales/' . 'IMG' . '-' . $Modales->id_modal . '-' . $temporal_rand . '.png';
                                        $Modales->imagen = 'IMG' . '-' . $Modales->id_modal . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/modales/' . 'IMG' . '-' . $Modales->id_modal . '.png';
                                        $Modales->imagen = 'IMG' . '-' . $Modales->id_modal . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_modal") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Modales->archivo)) {
                                        $url_destino = 'adminpanel/archivos/modales/' . $Modales->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/modales/' . 'FILE' . '-' . $Modales->id_modal . '-' . $temporal_rand . '.pdf';
                                        $Modales->archivo = 'FILE' . '-' . $Modales->id_modal . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/modales/' . 'FILE' . '-' . $Modales->id_modal . '.pdf';
                                        $Modales->archivo = 'FILE' . '-' . $Modales->id_modal . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Modales->save();
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
            $datatable->setColumnaId("id_modal");
            $datatable->setSelect("id_modal, titulo, subtitulo, descripcion, archivo, imagen, enlace, estado");
            $datatable->setFrom("tbl_web_modales");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_modal DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Modales = Modales::findFirstByid_modal((int) $this->request->getPost("id", "int"));
            if ($Modales && $Modales->estado = 'A') {
                $Modales->estado = 'X';
                $Modales->save();
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
