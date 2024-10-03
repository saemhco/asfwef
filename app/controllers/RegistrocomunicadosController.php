<?php

class RegistrocomunicadosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrocomunicados.js?v=" . uniqid());
    }

    public function indexAction() {
        //$this->assets->addJs("Testing");
    }

    //Funcion agregar Noticia y editar
    public function registroAction($id = null) {

        $this->view->id = $id;
        if ($id != null) {
            $comunicados = Comunicados::findFirstByid_comunicado((int) $id);
        } else {

            $comunicados = Comunicados::findFirstByid_comunicado(0);
        }
        $this->view->comunicados = $comunicados;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;


    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_comunicado");
            $datatable->setSelect("id_comunicado, titular, texto_muestra, texto_complementario, imagen, fecha_hora, estado");
            $datatable->setFrom("tbl_web_comunicados");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_comunicado DESC");
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
                $id = (int) $this->request->getPost("id_comunicado", "int");
                $model = Comunicados::findFirstByid_comunicado($id);
                //Valida cuando es nuevo
                $model = (!$model) ? new Comunicados() : $model;



                $model->titular = $this->request->getPost("titular", "string");
                $model->texto_muestra = $this->request->getPost("texto_muestra", "string");
                $model->texto_complementario = $this->request->getPost("texto_complementario");



                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }



                $model->estado = "A";





                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

                                    if (isset($model->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/comunicados/' . $model->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/comunicados/' . 'IMG' . '-' . $model->id_comunicado . '-' . $temporal_rand . '.jpg';
                                        $model->imagen = 'IMG' . '-' . $model->id_comunicado . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/comunicados/' . 'IMG' . '-' . $model->id_comunicado . '.jpg';
                                        $model->imagen = 'IMG' . '-' . $model->id_comunicado . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($model->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/comunicados/' . $model->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/comunicados/' . 'IMG' . '-' . $model->id_comunicado . '-' . $temporal_rand . '.png';
                                        $model->imagen = 'IMG' . '-' . $model->id_comunicado . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/comunicados/' . 'IMG' . '-' . $model->id_comunicado . '.png';
                                        $model->imagen = 'IMG' . '-' . $model->id_comunicado . ".png";
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
                                    if (isset($model->archivo)) {

                                        $url_destino = 'adminpanel/archivos/comunicados/' . $model->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/comunicados/' . 'FILE' . '-' . $model->id_comunicado . '-' . $temporal_rand . '.pdf';

                                        $model->archivo = 'FILE' . '-' . $model->id_comunicado . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/comunicados/' . 'FILE' . '-' . $model->id_comunicado . '.pdf';

                                        $model->archivo = 'FILE' . '-' . $model->id_comunicado . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $model->save();
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
            $model = Comunicados::findFirstByid_comunicado((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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
