<?php

class RegistroslidersController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrosliders.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar Sliders y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $sliders = Sliders::findFirstByid_slider((int) $id);
        } else {

            $sliders_nuevo = Sliders::findFirstByid_slider(NULL);

            $sliders_nuevo = Sliders::find([
                        // "estado = 'A' ",
                        "order" => "id_slider DESC",
                        "limit" => 1
            ]);

            //print($docente_nuevo[0]->id_slider); exit();
            $sliders->id_slider = $sliders_nuevo[0]->id_slider + 1;
            $this->view->sliders = $sliders;
        }

        $this->view->sliders = $sliders;
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_slider");
            $datatable->setSelect("id_slider,texto_principal,texto_1,texto_2,imagen,enlace,estado");
            $datatable->setFrom("tbl_web_sliders");
            $datatable->setWhere("estado in ('A','B','C','X')");
            $datatable->setOrderby("id_slider DESC");
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
                $id = (int) $this->request->getPost("id_slider", "int");
                $Sliders = Sliders::findFirstByid_slider($id);
                //Valida cuando es nuevo
                $Sliders = (!$Sliders) ? new Sliders() : $Sliders;

                $Sliders->id_slider = $this->request->getPost("id_slider", "int");

                $Sliders->texto_principal = $this->request->getPost("texto_principal", "string");
                $Sliders->texto_1 = $this->request->getPost("texto_1", "string");
                $Sliders->texto_2 = $this->request->getPost("texto_2", "string");
                $Sliders->enlace = $this->request->getPost("enlace", "string");

                $Sliders->estado = $this->request->getPost("estado", "string");

                /*
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Sliders->estado = "A";
                } else {
                    $Sliders->estado = "X";
                }
                */


                if ($Sliders->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Sliders->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {


                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {
                                    $url_destino = 'adminpanel/imagenes/sliders/' . $Sliders->imagen;

                                    if (file_exists($url_destino)) {
                                        unlink($url_destino);
                                    }

                                    $url_destino = 'adminpanel/imagenes/sliders/' . 'IMG' . '-' . $Sliders->id_slider . '-' . $temporal_rand . '.jpg';
                                    $Sliders->imagen = 'IMG' . '-' . $Sliders->id_slider . '-' . $temporal_rand . ".jpg";
                                } elseif ($filex->getExtension() == 'png') {

                                    $url_destino = 'adminpanel/imagenes/sliders/' . $Sliders->imagen;

                                    if (file_exists($url_destino)) {
                                        unlink($url_destino);
                                    }

                                    $url_destino = 'adminpanel/imagenes/sliders/' . 'IMG' . '-' . $Sliders->id_slider . '-' . $temporal_rand . '.png';
                                    $Sliders->imagen = 'IMG' . '-' . $Sliders->id_slider . '-' . $temporal_rand . ".png";
                                }



                                if (!$file->moveTo($url_destino)) {
                                    
                                } else {
                                    //$Sliders->imagen = $Sliders->id_slider . "-" . $file->getName();
                                    //$Sliders->imagen = 'IMG' . '-' . $Sliders->id_slider . ".jpg";
                                }
                            }
                        }

                        $Sliders->save();
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
            $sliders = Sliders::findFirstByid_slider((int) $this->request->getPost("id", "int"));
            if ($sliders && $sliders->estado = 'A') {
                $sliders->estado = 'X';
                $sliders->save();
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
