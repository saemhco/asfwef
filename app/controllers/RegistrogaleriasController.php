<?php

class RegistrogaleriasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrogalerias.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar Noticia y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            //entra cuando va editar
            $galerias = Galerias::findFirstByid_galeria((int) $id);
        } else {
            
            $galerias_nuevo = Galerias::count();

            //print($galerias_nuevo); exit();
            $galerias->id_galeria = $galerias_nuevo + 1;
            $this->view->galerias = $galerias;
        }

        $this->view->galerias = $galerias;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        //galerias.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/registrogalerias.detalles.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_galeria");
            $datatable->setSelect("id_galeria, titular, descripcion, enlace, archivo, imagen, fecha, estado");
            $datatable->setFrom("tbl_web_galerias");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_galeria DESC");
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
                $id = (int) $this->request->getPost("id_galeria", "int");
                $Galerias = Galerias::findFirstByid_galeria($id);
                //Valida cuando es nuevo
                $Galerias = (!$Galerias) ? new Galerias() : $Galerias;

                $Galerias->id_galeria = $this->request->getPost("id_galeria", "int");
                $Galerias->titular = $this->request->getPost("titular", "string");
                $Galerias->descripcion = $this->request->getPost("descripcion");
                $Galerias->enlace = $this->request->getPost("enlace", "string");

                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Galerias->fecha = date('Y-m-d', strtotime($fecha_new));
                }

                $estado = $this->request->getPost("estado", "string");
                //if (isset($estado)) {
                    $Galerias->estado = "A";
//                } else {
//                    $Galerias->estado = "X";
//                }




                if ($Galerias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Galerias->getMessages());
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

                                //echo '<pre>';
                                //print_r($filex);
                                //exit();

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Galerias->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/galerias/' . $Galerias->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/galerias/' . 'IMG' . '-' . $Galerias->id_galeria . '-' . $temporal_rand . '.jpg';
                                        $Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . '-' . $temporal_rand . '.jpg';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/galerias/' . 'IMG' . '-' . $Galerias->id_galeria . '.jpg';
                                        $Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . '.jpg';
                                    }



                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Galerias->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/galerias/' . $Galerias->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/galerias/' . 'IMG' . '-' . $Galerias->id_galeria . '-' . $temporal_rand . '.png';
                                        $Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . '-' . $temporal_rand . '.png';
                                    }




                                    $url_destino = 'adminpanel/imagenes/galerias/' . 'IMG' . '-' . $Galerias->id_galeria . '.png';
                                    $Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . '.png';

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                }

                                //$file->getName() = $Galerias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Galerias->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo_galeria") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Galerias->archivo)) {

                                        $url_destino = 'adminpanel/archivos/galerias/' . $Galerias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/galerias/' . 'FILE' . '-' . $Galerias->id_galeria . '-' . $temporal_rand . '.pdf';

                                        $Galerias->archivo = 'FILE' . '-' . $Galerias->id_galeria . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/galerias/' . 'FILE' . '-' . $Galerias->id_galeria . '.pdf';

                                        $Galerias->archivo = 'FILE' . '-' . $Galerias->id_galeria . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Galerias->save();
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
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Galerias = Galerias::findFirstByid_galeria((int) $this->request->getPost("id", "int"));
            if ($Galerias && $Galerias->estado = 'A') {
                $Galerias->estado = 'X';
                $Galerias->save();
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

    //Datatables detalle
    public function datatableDetallesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("galerias_detalles.id_galeria_detalle");
            $datatable->setSelect("galerias_detalles.id_galeria_detalle, galerias_detalles.imagen_detalle, galerias_detalles.titular_detalle, galerias_detalles.fecha_hora_detalle, galerias_detalles.enlace_detalle, galerias_detalles.archivo_detalle, galerias_detalles.estado_detalle");
            $datatable->setFrom("tbl_web_galerias_detalles galerias_detalles");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("galerias_detalles.id_galeria = $id");
            $datatable->setOrderby("galerias_detalles.id_galeria_detalle DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //guardar detalles
    public function saveDetallesAction() {


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

                $id = (int) $this->request->getPost("id_galeria_detalle", "int");
                $galeriasdetalles = GaleriasDetalles::findFirstByid_galeria_detalle($id);
                $galeriasdetalles = (!$galeriasdetalles) ? new GaleriasDetalles() : $galeriasdetalles;

//                $galeriasdetalles->id_galeria_detalle = $this->request->getPost("id_galeria_detalle", "int");
//
//                echo "<pre>";
//                print_r($galeriasdetalles->id_galeria_detalle);
//                exit();

                $galeriasdetalles->id_galeria = $this->request->getPost("id_galeria", "int");
                //titular
                $galeriasdetalles->titular_detalle = $this->request->getPost("titular_detalle", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_detalle", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_detalle", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $galeriasdetalles->fecha_hora_detalle = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $galeriasdetalles->enlace_detalle = $this->request->getPost("enlace_detalle", "string");

                //estado_detalle
                $estado_detalle = $this->request->getPost("estado_detalle", "string");
                if (isset($estado_detalle)) {
                    $galeriasdetalles->estado_detalle = "A";
                } else {
                    $galeriasdetalles->estado_detalle = "X";
                }


                if ($galeriasdetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($galeriasdetalles->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "imagen_galeria_detalle") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($galeriasdetalles->imagen_detalle)) {
                                        $url_destino = 'adminpanel/imagenes/galerias_detalles/' . $galeriasdetalles->imagen_detalle;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/galerias_detalles/' . 'IMG' . '-' . $galeriasdetalles->id_galeria .  '-' . $galeriasdetalles->id_galeria_detalle . '-' . $temporal_rand . '.jpg';
                                        $galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . '-' . $temporal_rand . '.jpg';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/galerias_detalles/' . 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . '.jpg';
                                        $galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($galeriasdetalles->imagen_detalle)) {
                                        $url_destino = 'adminpanel/imagenes/galerias_detalles/' . $galeriasdetalles->imagen_detalle;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/galerias_detalles/' . 'IMG' . '-' . $galeriasdetalles->id_galeria .  '-' . $galeriasdetalles->id_galeria_detalle . '-' . $temporal_rand . '.png';
                                        $galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . '-' . $temporal_rand . '.png';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/galerias_detalles/' . 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . '.png';
                                        $galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                //$url_destino = 'adminpanel/imagenes/galerias_detalles/' . 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . '.jpg';
                            }

                            //archivo
                            if ($file->getKey() == "archivo_galeria_detalle") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();


                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($galeriasdetalles->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->archivo_detalle;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->enlace_detalle . '-' . $temporal_rand . '.pdf';
                                        $galeriasdetalles->archivo_detalle = $galeriasdetalles->enlace_detalle . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->enlace_detalle . '.pdf';
                                        $galeriasdetalles->archivo_detalle = $galeriasdetalles->enlace_detalle . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'doc') {
                                    if (isset($galeriasdetalles->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->archivo_detalle;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->enlace_detalle . '-' . $temporal_rand . '.doc';
                                        $galeriasdetalles->archivo_detalle = $galeriasdetalles->enlace_detalle . '-' . $temporal_rand . '.doc';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->enlace_detalle . '.doc';
                                        $galeriasdetalles->archivo_detalle = $galeriasdetalles->enlace_detalle . '.doc';
                                    }
                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'docx') {

                                    if (isset($galeriasdetalles->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->archivo_detalle;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->enlace_detalle . '-' . $temporal_rand . '.docx';
                                        $galeriasdetalles->archivo_detalle = $galeriasdetalles->enlace_detalle . '-' . $temporal_rand . '.docx';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/galerias_detalles/' . $galeriasdetalles->enlace_detalle . '.docx';
                                        $galeriasdetalles->archivo_detalle = $galeriasdetalles->enlace_detalle . '.docx';
                                    }
                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                        }

                        $galeriasdetalles->save();
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

    //editar detalles
    public function getAjaxDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = GaleriasDetalles::findFirstByid_galeria_detalle((int) $this->request->getPost("id", "int"));
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

    //eliminar detalles
    public function eliminarDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = GaleriasDetalles::findFirstByid_galeria_detalle((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado_detalle = 'A') {
                $obj->estado_detalle = 'X';
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
