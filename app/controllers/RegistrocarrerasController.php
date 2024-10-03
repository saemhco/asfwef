<?php

class RegistrocarrerasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrocarreras.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            //editar
            $carreras = Carreras::findFirstBycodigo((string) $id);
            $this->view->carreras = $carreras;
        } else {
            //nuevo
        }

        $facultades = Facultades::find("estado = 'A'");
        $this->view->facultades = $facultades;
    }

    public function saveAction() {
        //echo '<pre>';
        //print_r($_POST);
        //exit();
        
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "string");
                $carrera = Carreras::findFirstBycodigo($id);
                $carrera = (!$carrera) ? new Carreras() : $carrera;
                $carrera->codigo = strtoupper($this->request->getPost("codigo", "string"));
                $carrera->descripcion = $this->request->getPost("descripcion", "string");
                $carrera->facultad = $this->request->getPost("facultad", "string");

                $carrera->grado = $this->request->getPost("grado", "string");
                $carrera->titulo = $this->request->getPost("titulo", "string");
                $carrera->modalidad = $this->request->getPost("modalidad", "string");
                $carrera->duracion = $this->request->getPost("duracion", "string");
                $carrera->perfil = $this->request->getPost("perfil");
                 $carrera->enlace = $this->request->getPost("enlace", "string");

                $carrera->estado = "A";

                if ($carrera->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($carrera->getMessages());
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

                                    if (isset($carrera->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/carreras/' . $carrera->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/carreras/' . 'IMG' . '-' . $carrera->codigo . '-' . $temporal_rand . '.jpg';
                                        $carrera->imagen = 'IMG' . '-' . $carrera->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/carreras/' . 'IMG' . '-' . $carrera->codigo . '.jpg';
                                        $carrera->imagen = 'IMG' . '-' . $carrera->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($carrera->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/carreras/' . $carrera->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/carreras/' . 'IMG' . '-' . $carrera->codigo . '-' . $temporal_rand . '.png';
                                        $carrera->imagen = 'IMG' . '-' . $carrera->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/carreras/' . 'IMG' . '-' . $carrera->codigo . '.png';
                                        $carrera->imagen = 'IMG' . '-' . $carrera->codigo . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $carrera->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $carrera->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo_carrera") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($carrera->archivo)) {

                                        $url_destino = 'adminpanel/archivos/carreras/' . $carrera->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/carreras/' . 'FILE' . '-' . $carrera->codigo . '-' . $temporal_rand . '.pdf';

                                        $carrera->archivo = 'FILE' . '-' . $carrera->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/carreras/' . 'FILE' . '-' . $carrera->codigo . '.pdf';

                                        $carrera->archivo = 'FILE' . '-' . $carrera->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $carrera->save();
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
            $carrera = Carreras::findFirstBycodigo((string) $this->request->getPost("id", "string"));
            if ($carrera) {
                $this->response->setJsonContent($carrera->toArray());
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
            $carrera = Carreras::findFirstByCodigo((string) $this->request->getPost("id", "string"));
            if ($carrera && $carrera->estado = 'A') {
                $carrera->estado = 'X';
                $carrera->save();
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
            $datatable->setColumnaId("c.codigo");
            $datatable->setSelect("c.codigo, c.descripcion as carrera, f.descripcion AS facultad, c.estado, c.imagen, c.archivo");
            $datatable->setFrom("carreras c INNER JOIN facultades as f ON c.facultad = f.codigo");
            //$datatable->setWhere("c.estado = 'A'");
            $datatable->setOrderBy("c.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
