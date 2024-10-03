<?php

class registroboletinesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroboletines.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $boletines = Boletines::findFirstByid_boletin((int) $id);
        } else {
            $boletines_nuevo = Boletines::count();
            //print($docente_nuevo[0]->codigo); exit();
            $boletines->id_boletin = $boletines_nuevo + 1;
            $this->view->boletines = $boletines;
        }
        $this->view->boletines = $boletines;
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
                $id = (int) $this->request->getPost("id_boletin", "int");
                $Boletines = Boletines::findFirstByid_boletin($id);
                //Valida cuando es nuevo
                $Boletines = (!$Boletines) ? new Boletines() : $Boletines;

                //id_boletin
                $Boletines->id_boletin = $this->request->getPost("id_boletin", "int");

                //titular
                $Boletines->titular = $this->request->getPost("titular", "string");

                //texto_muestra
                //$Boletines->texto_muestra = $this->request->getPost("texto_muestra");
                $Boletines->texto_muestra = $this->request->getPost("texto_muestra", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Boletines->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $Boletines->enlace = $this->request->getPost("enlace", "string");

                //estado
                $Boletines->estado = "A";





                if ($Boletines->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Boletines->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Boletines->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/boletines/' . $Boletines->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/boletines/' . 'IMG' . '-' . $Boletines->id_boletin . '-' . $temporal_rand . '.jpg';
                                        $Boletines->imagen = 'IMG' . '-' . $Boletines->id_boletin . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/boletines/' . 'IMG' . '-' . $Boletines->id_boletin . '.jpg';
                                        $Boletines->imagen = 'IMG' . '-' . $Boletines->id_boletin . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Boletines->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/boletines/' . $Boletines->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/boletines/' . 'IMG' . '-' . $Boletines->id_boletin . '-' . $temporal_rand . '.png';
                                        $Boletines->imagen = 'IMG' . '-' . $Boletines->id_boletin . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/boletines/' . 'IMG' . '-' . $Boletines->id_boletin . '.png';
                                        $Boletines->imagen = 'IMG' . '-' . $Boletines->id_boletin . ".png";
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
                            if ($file->getKey() == "archivo_boletin") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Boletines->archivo)) {
                                        $url_destino = 'adminpanel/archivos/boletines/' . $Boletines->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/boletines/' . 'FILE' . '-' . $Boletines->id_boletin . '-' . $temporal_rand . '.pdf';
                                        $Boletines->archivo = 'FILE' . '-' . $Boletines->id_boletin . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/boletines/' . 'FILE' . '-' . $Boletines->id_boletin . '.pdf';
                                        $Boletines->archivo = 'FILE' . '-' . $Boletines->id_boletin . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Boletines->save();
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
            $datatable->setColumnaId("id_boletin");
            $datatable->setSelect("id_boletin, titular, texto_muestra, fecha_hora, archivo, imagen, enlace, estado");
            $datatable->setFrom("tbl_web_boletines");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_boletin DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Boletines = Boletines::findFirstByid_boletin((int) $this->request->getPost("id", "int"));
            if ($Boletines && $Boletines->estado = 'A') {
                $Boletines->estado = 'X';
                $Boletines->save();
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
