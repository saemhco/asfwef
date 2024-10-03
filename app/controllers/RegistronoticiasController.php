<?php

class RegistronoticiasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registronoticias.js?v=" . uniqid());
    }

    public function indexAction() {
        //$this->assets->addJs("Testing");
    }

    //Funcion agregar Noticia y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $noticias = Noticias::findFirstByid_noticia((int) $id);
        } else {

            $noticias_nuevo = Noticias::count();

            //echo '<pre>';
            //print_r($noticias_nuevo);
            //exit();

            $noticias->id_noticia = $noticias_nuevo + 1;
            $this->view->noticias = $noticias;
        }

        $this->view->noticias = $noticias;

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;


        $this->assets->addJs("adminpanel/js/modulos/registronoticias.detalles.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_noticia");
            $datatable->setSelect("id_noticia, titular, texto_muestra, texto_complementario, imagen, fecha_hora, estado");
            $datatable->setFrom("tbl_web_noticias");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_noticia DESC");
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
                $id = (int) $this->request->getPost("id_noticia", "int");
                $Noticias = Noticias::findFirstByid_noticia($id);
                //Valida cuando es nuevo
                $Noticias = (!$Noticias) ? new Noticias() : $Noticias;

                $Noticias->id_noticia = $this->request->getPost("id_noticia", "int");


                $Noticias->titular = $this->request->getPost("titular", "string");
                $Noticias->texto_muestra = $this->request->getPost("texto_muestra", "string");
                //$Noticias->texto_complementario = $this->request->getPost("texto_complementario", "string");
                $Noticias->texto_complementario = $this->request->getPost("texto_complementario");



                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Noticias->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }



                $estado = $this->request->getPost("estado", "string");
//                if (isset($estado)) {
                    $Noticias->estado = "A";
//                } else {
//                    $Noticias->estado = "X";
//                }




                if ($Noticias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Noticias->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            //echo "<pre>";print_r($file->getName());exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Noticias->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/noticias/' . $Noticias->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/noticias/' . 'IMG' . '-' . $Noticias->id_noticia . '-' . $temporal_rand . '.jpg';
                                        $Noticias->imagen = 'IMG' . '-' . $Noticias->id_noticia . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/noticias/' . 'IMG' . '-' . $Noticias->id_noticia . '.jpg';
                                        $Noticias->imagen = 'IMG' . '-' . $Noticias->id_noticia . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Noticias->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/noticias/' . $Noticias->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/noticias/' . 'IMG' . '-' . $Noticias->id_noticia . '-' . $temporal_rand . '.png';
                                        $Noticias->imagen = 'IMG' . '-' . $Noticias->id_noticia . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/noticias/' . 'IMG' . '-' . $Noticias->id_noticia . '.png';
                                        $Noticias->imagen = 'IMG' . '-' . $Noticias->id_noticia . ".png";
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
                            if ($file->getKey() == "archivo_noticia") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Noticias->archivo)) {

                                        $url_destino = 'adminpanel/archivos/noticias/' . $Noticias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/noticias/' . 'FILE' . '-' . $Noticias->id_noticia . '-' . $temporal_rand . '.pdf';

                                        $Noticias->archivo = 'FILE' . '-' . $Noticias->id_noticia . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/noticias/' . 'FILE' . '-' . $Noticias->id_noticia . '.pdf';

                                        $Noticias->archivo = 'FILE' . '-' . $Noticias->id_noticia . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Noticias->save();
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
            $Noticias = Noticias::findFirstByid_noticia((int) $this->request->getPost("id", "int"));
            if ($Noticias && $Noticias->estado = 'A') {
                $Noticias->estado = 'X';
                $Noticias->save();
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
            $datatable->setColumnaId("not_detalle.id_noticia_detalle");
            $datatable->setSelect("not_detalle.id_noticia_detalle, not_detalle.imagen_detalle, not_detalle.titular_detalle, not_detalle.fecha_hora_detalle, not_detalle.enlace_detalle, not_detalle.archivo_detalle, not_detalle.estado_detalle");
            $datatable->setFrom("tbl_web_noticias_detalles not_detalle");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("not_detalle.id_noticia = $id");
            $datatable->setOrderby("not_detalle.id_noticia_detalle DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

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

                $id = (int) $this->request->getPost("id_noticia_detalle", "int");
                $noticiadetalles = NoticiasDetalles::findFirstByid_noticia_detalle($id);
                $noticiadetalles = (!$noticiadetalles) ? new NoticiasDetalles() : $noticiadetalles;

//                $noticiadetalles->id_noticia_detalle = $this->request->getPost("id_noticia_detalle", "int");
//
//                echo "<pre>";
//                print_r($noticiadetalles->id_noticia_detalle);
//                exit();

                $noticiadetalles->id_noticia = $this->request->getPost("id_noticia", "int");
                //titular
                $noticiadetalles->titular_detalle = $this->request->getPost("titular_detalle", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_detalle", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_detalle", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $noticiadetalles->fecha_hora_detalle = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $noticiadetalles->enlace_detalle = $this->request->getPost("enlace_detalle", "string");

                //estado_detalle
                $estado_detalle = $this->request->getPost("estado_detalle", "string");
                if (isset($estado_detalle)) {
                    $noticiadetalles->estado_detalle = "A";
                } else {
                    $noticiadetalles->estado_detalle = "X";
                }


                if ($noticiadetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($noticiadetalles->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_noticia_detalle") {

                                //nombre extension
                                $filex = new SplFileInfo($file->getName());
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($noticiadetalles->imagen_detalle)) {

                                        $url_destino = 'adminpanel/imagenes/noticias_detalles/' . $noticiadetalles->imagen_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/noticias_detalles/' . 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . '-' . $temporal_rand . '.jpg';
                                        $noticiadetalles->imagen_detalle = 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/noticias_detalles/' . 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . '.jpg';
                                        $noticiadetalles->imagen_detalle = 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($noticiadetalles->imagen_detalle)) {

                                        $url_destino = 'adminpanel/imagenes/noticias_detalles/' . $noticiadetalles->imagen_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/noticias_detalles/' . 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . '-' . $temporal_rand . '.png';
                                        $noticiadetalles->imagen_detalle = 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/noticias_detalles/' . 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . '.png';
                                        $noticiadetalles->imagen_detalle = 'IMG' . '-' . $noticiadetalles->id_noticia . '-' . $noticiadetalles->id_noticia_detalle . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                }

                            }

                            //archivo
                            if ($file->getKey() == "archivo_noticia_detalle") {






                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {


                                    if (isset($noticiadetalles->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->archivo_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->enlace_detalle . '-' . $temporal_rand . '.pdf';
                                        $noticiadetalles->archivo_detalle = $noticiadetalles->enlace_detalle . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->enlace_detalle . '.pdf';
                                        $noticiadetalles->archivo_detalle = $noticiadetalles->enlace_detalle . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'doc') {

                                    if (isset($noticiadetalles->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->archivo_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->enlace_detalle . '-' . $temporal_rand . '.doc';
                                        $noticiadetalles->archivo_detalle = $noticiadetalles->enlace_detalle . '-' . $temporal_rand . '.doc';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->enlace_detalle . '.doc';
                                        $noticiadetalles->archivo_detalle = $noticiadetalles->enlace_detalle . '.doc';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'docx') {

                                    if (isset($noticiadetalles->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->archivo_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->enlace_detalle . '-' . $temporal_rand . '.docx';
                                        $noticiadetalles->archivo_detalle = $noticiadetalles->enlace_detalle . '-' . $temporal_rand . '.docx';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/noticias_detalles/' . $noticiadetalles->enlace_detalle . '.docx';
                                        $noticiadetalles->archivo_detalle = $noticiadetalles->enlace_detalle . '.docx';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                        }

                        $noticiadetalles->save();
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

    //editar notricias detalles
    public function getAjaxDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = NoticiasDetalles::findFirstByid_noticia_detalle((int) $this->request->getPost("id", "int"));
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

    //eliminar noticias detalles
    //eliminar
    public function eliminarDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = NoticiasDetalles::findFirstByid_noticia_detalle((int) $this->request->getPost("id", "int"));
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
