<?php

class RegistrolocalesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrolocales.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $Locales = Locales::findFirstBycodigo((int) $id);
        } else {

            $local_nuevo = Locales::count();

            $Locales->codigo = $local_nuevo + 1;
        }

        $this->view->locales = $Locales;
    }

    //Funcion guardar
    public function saveAction() {


//        echo "<pre>";
//        print_r($_POST);
//        exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Locales = Locales::findFirstBycodigo($id);
                //Valida cuando es nuevo
                $Locales = (!$Locales) ? new Locales() : $Locales;

                //codigo
                $Locales->codigo = $this->request->getPost("codigo", "int");

                //nombres
                $Locales->nombres = $this->request->getPost("nombres", "string");

                //descripcion
                $Locales->descripcion = $this->request->getPost("descripcion", "string");

                //direccion
                $Locales->direccion = $this->request->getPost("direccion", "string");

                //abreviatura
                $Locales->abreviatura = $this->request->getPost("abreviatura", "string");

                $Locales->estado = "A";


                if ($Locales->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Locales->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                //$url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->codigo . '.jpg';

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Locales->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->codigo . '-' . $temporal_rand . '.jpg';
                                        $Locales->imagen = 'IMG' . '-' . $Locales->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->codigo . '.jpg';
                                        $Locales->imagen = 'IMG' . '-' . $Locales->codigo . '.jpg';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Locales->imagen = 'IMG' . '-' . $Locales->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Locales->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->codigo . '-' . $temporal_rand . '.png';
                                        $Locales->imagen = 'IMG' . '-' . $Locales->codigo . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/locales/' . 'IMG' . '-' . $Locales->codigo . '.png';
                                        $Locales->imagen = 'IMG' . '-' . $Locales->codigo . '.png';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Locales->imagen = 'IMG' . '-' . $Locales->codigo . ".jpg";
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Locales->archivo)) {

                                        $url_destino = 'adminpanel/archivos/locales/' . $Locales->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }


                                        $url_destino = 'adminpanel/archivos/locales/' . 'FILE' . '-' . $Locales->codigo . '-' . $temporal_rand . '.pdf';


                                        $Locales->archivo = 'FILE' . '-' . $Locales->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/locales/' . 'FILE' . '-' . $Locales->codigo . '.pdf';

                                        $Locales->archivo = 'FILE' . '-' . $Locales->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Locales->save();
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
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, nombres,descripcion,direccion,abreviatura,imagen,archivo,estado");
            $datatable->setFrom("tbl_web_locales");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Locales = Locales::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Locales && $Locales->estado = 'A') {
                $Locales->estado = 'X';
                $Locales->save();
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
