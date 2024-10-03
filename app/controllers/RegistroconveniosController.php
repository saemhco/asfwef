<?php

class RegistroconveniosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroconvenios.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {

        $this->view->id = $id;
        if ($id != null) {
            $convenios = Convenios::findFirstByid_convenio((int) $id);
        } else {
            $convenios = Convenios::findFirstByid_convenio(0);

        }
        $this->view->convenios = $convenios;



        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;


        $resoluciones = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'id_resolucion ASC',
            ]
        );
        $this->view->resoluciones = $resoluciones;
    }

    //Funcion guardar
    public function saveAction() {


        // echo "<pre>";
        // print_r($_POST);
        // exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_convenio", "int");
                $Convenios = Convenios::findFirstByid_convenio($id);
                $Convenios = (!$Convenios) ? new Convenios() : $Convenios;

                //titulo
                $Convenios->titulo = $this->request->getPost("titulo", "string");

                //Objeto
                $Convenios->objeto = $this->request->getPost("objeto", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Convenios->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_termino
                if ($this->request->getPost("fecha_termino", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_termino", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Convenios->fecha_termino = date('Y-m-d', strtotime($fecha_new));
                }

                //vigencia
                $Convenios->vigencia = $this->request->getPost("vigencia");

                //compromiso
                $Convenios->compromiso = $this->request->getPost("compromiso");

                //entidad_coopeprante
                $Convenios->entidad_cooperante = $this->request->getPost("entidad_cooperante", "string");

                //compromiso_cooperante
                $Convenios->compromiso_cooperante = $this->request->getPost("compromiso_cooperante");

                //suscriptores
                $Convenios->suscriptores = $this->request->getPost("suscriptores", "string");

                //suscriptores
                $Convenios->mecanismos = $this->request->getPost("mecanismos", "string");

                //suscriptores
                $Convenios->enlace = $this->request->getPost("enlace", "string");

                //estado
                $Convenios->estado = "A";



                //referencia
                $Convenios->referencia = $this->request->getPost("referencia", "string");

                //referencia_enlace
                $Convenios->referencia_enlace = $this->request->getPost("referencia_enlace", "string");


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $Convenios->id_resolucion = null;
                } else {
                    $Convenios->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }



                if ($Convenios->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Convenios->getMessages());
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


                                    if (isset($Convenios->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/convenios/' . $Convenios->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/convenios/' . 'IMG' . '-' . $Convenios->id_convenio . '-' . $temporal_rand . '.jpg';
                                        $Convenios->imagen = 'IMG' . '-' . $Convenios->id_convenio . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/convenios/' . 'IMG' . '-' . $Convenios->id_convenio . '.jpg';
                                        $Convenios->imagen = 'IMG' . '-' . $Convenios->id_convenio . '.jpg';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($Convenios->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/convenios/' . $Convenios->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/convenios/' . 'IMG' . '-' . $Convenios->id_convenio . '-' . $temporal_rand . '.png';
                                        $Convenios->imagen = 'IMG' . '-' . $Convenios->id_convenio . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/convenios/' . 'IMG' . '-' . $Convenios->id_convenio . '.png';
                                        $Convenios->imagen = 'IMG' . '-' . $Convenios->id_convenio . '.png';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_convenio") {

                                $filex = new SplFileInfo($file->getName());


                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Convenios->archivo)) {
                                        $url_destino = 'adminpanel/archivos/galerias/' . $Convenios->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/convenios/' . 'FILE' . '-' . $Convenios->id_convenio . '-' . $temporal_rand . '.pdf';
                                        $Convenios->archivo = 'FILE' . '-' . $Convenios->id_convenio . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/convenios/' . 'FILE' . '-' . $Convenios->id_convenio . '.pdf';
                                        $Convenios->archivo = 'FILE' . '-' . $Convenios->id_convenio . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                            }
                        }

                        $Convenios->save();
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
            $datatable->setColumnaId("id_convenio");
            $datatable->setSelect("id_convenio, titulo, objeto, fecha_inicio, fecha_termino, vigencia, compromiso, entidad_cooperante, compromiso_cooperante, suscriptores, mecanismos, archivo, imagen, enlace, estado");
            $datatable->setFrom("tbl_web_convenios");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_convenio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Convenios = Convenios::findFirstByid_convenio((int) $this->request->getPost("id", "int"));
            if ($Convenios && $Convenios->estado = 'A') {
                $Convenios->estado = 'X';
                $Convenios->save();
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
