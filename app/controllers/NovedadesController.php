<?php

class NovedadesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/novedades.js?v=" . uniqid());
    }

    public function saveAction() {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_novedad", "int");
                $Novedades = Novedades::findFirstByid_novedad($id);
                $Novedades = (!$Novedades) ? new Novedades() : $Novedades;

                $Novedades->titulo = $this->request->getPost("titulo", "string");
                $Novedades->descripcion = $this->request->getPost("descripcion", "string");
                $Novedades->autor = $this->request->getPost("autor", "string");
                $Novedades->fecha = date('Y-m-d');
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Novedades->estado = "A";
                } else {
                    $Novedades->estado = "X";
                }

                //comprueba si hay archivos por subir
                if ($this->request->getPost("input-imagen", "string") != "") {
                    $Novedades->imagen = $this->request->getPost("input-imagen", "string");
                } else {
                    
                }

                if ($Novedades->save() == false) {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Novedades->getMessages());
                } else {
                    //Cuando va bien                  
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                    if (in_array($extension, $formatos_imagenes)) {


                                        if (isset($Novedades->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/novedades/' . $Novedades->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/novedades/' . 'IMG' . '-' . $Novedades->id_novedad . '-' . $temporal_rand . "." . $extension;
                                            $Novedades->imagen = 'IMG' . '-' . $Novedades->id_novedad . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/novedades/' . 'IMG' . '-' . $Novedades->id_novedad . '.' . $extension;
                                            $Novedades->imagen = 'IMG' . '-' . $Novedades->id_novedad . '.' . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Novedades->save();
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Novedades = Novedades::findFirstByid_novedad((int) $this->request->getPost("id_novedad", "int"));
            if ($Novedades) {
                $this->response->setJsonContent($Novedades->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Novedades = Novedades::findFirstByid_novedad((int) $this->request->getPost("id_novedad", "int"));
            if ($Novedades && $Novedades->estado = 'A') {
                $Novedades->estado = 'X';
                $Novedades->save();
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

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_novedad");
            $datatable->setSelect("id_novedad,titulo,descripcion, fecha, autor,imagen,estado");
            $datatable->setFrom("tbl_btr_novedades");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
