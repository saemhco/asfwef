<?php

class TestimoniosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/testimonios.js?v" . uniqid());
    }


    public function saveAction() {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_testimonio", "int");
                $Testimonios = Testimonios::findFirstByid_testimonio($id);
                $Testimonios = (!$Testimonios) ? new Testimonios() : $Testimonios;

                $Testimonios->titulo = $this->request->getPost("titulo", "string");
                $Testimonios->descripcion = $this->request->getPost("descripcion", "string");
                $Testimonios->fecha = date('Y-m-d');
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Testimonios->estado = "A";
                } else {
                    $Testimonios->estado = "X";
                }

                //comprueba si hay archivos por subir
                if ($this->request->getPost("input-imagen", "string") != "") {
                    $Testimonios->imagen = $this->request->getPost("input-imagen", "string");
                } else {
                    
                }

                if ($Testimonios->save() == false) {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Testimonios->getMessages());
                } else {
                    //Cuando va bien                  
                    if ($this->request->hasFiles() == true) {
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                    if (in_array($extension, $formatos_imagenes)) {


                                        if (isset($Testimonios->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/testimonios/' . $Testimonios->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/testimonios/' . 'IMG' . '-' . $Testimonios->id_testimonio . '-' . $temporal_rand . "." . $extension;
                                            $Testimonios->imagen = 'IMG' . '-' . $Testimonios->id_testimonio . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/testimonios/' . 'IMG' . '-' . $Testimonios->id_testimonio . '.' . $extension;
                                            $Testimonios->imagen = 'IMG' . '-' . $Testimonios->id_testimonio . '.' . $extension;
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

                        $Testimonios->save();
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
            $Testimonios = Testimonios::findFirstByid_testimonio((int) $this->request->getPost("id_testimonio", "int"));
            if ($Testimonios) {
                $this->response->setJsonContent($Testimonios->toArray());
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
            $Testimonios = Testimonios::findFirstBycodigo((int) $this->request->getPost("id_testimonio", "int"));
            if ($Testimonios && $Testimonios->estado = 'A') {
                $Testimonios->estado = 'X';
                $Testimonios->save();
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
            $datatable->setColumnaId("id_testimonio");
            $datatable->setSelect("id_testimonio,titulo,descripcion, fecha ,imagen,estado");
            $datatable->setFrom("tbl_btr_testimonios");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
