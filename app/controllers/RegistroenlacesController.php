<?php

class RegistroenlacesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroenlaces.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $enlaces = Enlaces::findFirstByid_enlace((int) $id);
        } else {

            $enlaces_nuevo = Enlaces::findFirstByid_enlace(NULL);

            $enlaces_nuevo = Enlaces::find([
                        // "estado = 'A' ",
                        "order" => "id_enlace DESC",
                        "limit" => 1
            ]);

            //print($docente_nuevo[0]->codigo); exit();
            $enlaces->id_enlace = $enlaces_nuevo[0]->id_enlace + 1;
            $this->view->enlaces = $enlaces;
        }

        $this->view->enlaces = $enlaces;
    }

    //Funcion guardar
    public function saveAction() {


//        echo "<pre>";
//        print_r($_POST);
//        exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_enlace", "int");
                $Enlaces = Enlaces::findFirstByid_enlace($id);
                //Valida cuando es nuevo
                $Enlaces = (!$Enlaces) ? new Enlaces() : $Enlaces;

                //id_enlace
                $Enlaces->id_enlace = $this->request->getPost("id_enlace", "int");

                //nombre
                $Enlaces->nombre = $this->request->getPost("nombre", "string");

                //url
                $Enlaces->url = $this->request->getPost("url", "string");

                //enlace
                $Enlaces->enlace = $this->request->getPost("enlace", "string");

                //orden
                if ($this->request->getPost("orden", "int") == "") {
                    $Enlaces->orden = null;
                } else {
                    $Enlaces->orden = $this->request->getPost("orden", "int");
                }

                $Enlaces->estado = "A";


                if ($Enlaces->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Enlaces->getMessages());
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

                                    if (isset($Enlaces->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/enlaces/' . 'IMG' . '-' . $Enlaces->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/enlaces/' . 'IMG' . '-' . $Enlaces->id_enlace . '-' . $temporal_rand . '.jpg';
                                        $Enlaces->imagen = 'IMG' . '-' . $Enlaces->id_enlace . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/enlaces/' . 'IMG' . '-' . $Enlaces->id_enlace . '.jpg';
                                        $Enlaces->imagen = 'IMG' . '-' . $Enlaces->id_enlace . '.jpg';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Enlaces->imagen = 'IMG' . '-' . $Enlaces->id_enlace . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Enlaces->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/enlaces/' . 'IMG' . '-' . $Enlaces->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/enlaces/' . 'IMG' . '-' . $Enlaces->id_enlace . '-' . $temporal_rand . '.png';
                                        $Enlaces->imagen = 'IMG' . '-' . $Enlaces->id_enlace . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/enlaces/' . 'IMG' . '-' . $Enlaces->id_enlace . '.png';
                                        $Enlaces->imagen = 'IMG' . '-' . $Enlaces->id_enlace . '.png';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Enlaces->imagen = 'IMG' . '-' . $Enlaces->id_enlace . ".jpg";
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Enlaces->archivo)) {

                                        $url_destino = 'adminpanel/archivos/enlaces/' . $Enlaces->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }


                                        $url_destino = 'adminpanel/archivos/enlaces/' . 'FILE' . '-' . $Enlaces->id_enlace . '-' . $temporal_rand . '.pdf';


                                        $Enlaces->archivo = 'FILE' . '-' . $Enlaces->id_enlace . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/enlaces/' . 'FILE' . '-' . $Enlaces->id_enlace . '.pdf';

                                        $Enlaces->archivo = 'FILE' . '-' . $Enlaces->id_enlace . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Enlaces->save();
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
            $datatable->setColumnaId("id_enlace");
            $datatable->setSelect("id_enlace, nombre, url, imagen, archivo, enlace, orden, estado");
            $datatable->setFrom("tbl_web_enlaces");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("orden ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Enlaces = Enlaces::findFirstByid_enlace((int) $this->request->getPost("id", "int"));
            if ($Enlaces && $Enlaces->estado = 'A') {
                $Enlaces->estado = 'X';
                $Enlaces->save();
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
