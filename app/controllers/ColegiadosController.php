<?php

class ColegiadosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/colegiados.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion para agregar colegiado y editar
    public function registroAction($id = null) {


        if ($id != null) {
            $colegiados = Colegiados::findFirstBycodigo((int) $id);
        } else {
            //$docentes = Asignaturas::findFirstBycodigo(0);
            $colegiados = Colegiados::findFirstBycodigo(NULL);
        }

        $this->view->colegiados = $colegiados;


        //Modelo documentos(a_codigos)        
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentocolegiados = $tipodocumento;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //Modelo seguro(a_codigos)
        $seguro = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguro;

        //Modelo Capitulos (capitulos)
        $capitulo = Capitulos::find("estado = 'A'");
        $this->view->capitulos = $capitulo;

        //Modelo Consejos (consejos)
        $consejo = Consejos::find("estado = 'A'");
        $this->view->consejos = $consejo;

        //Modelo Regiones (regiones)
        $regiones = Regiones::find("estado = 'A'");
        $this->view->regiones = $regiones;

        //Modelo Provincias (provincias)
        $provincias = Provincias::find("estado = 'A'");
        $this->view->provincias = $provincias;

        //Modelo Distritos (distritos)
        $distrito = Distritos::find("estado = 'A'");
        $this->view->distritos = $distrito;
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("c.codigo");
            $datatable->setSelect("c.codigo, ca.descripcion as capitulo, c.apellidop, c.apellidom, c.nombres, c.nro_documento, c.telefono, c.celular, c.direccion, c.habilitado, c.estado");
            $datatable->setFrom("tbl_cip_colegiados c INNER JOIN tbl_cip_capitulos ca ON c.capitulo = ca.codigo"); //$datatable->setFrom("colegiados");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("c.estado = 'A'");
            $datatable->setOrderby("c.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar colegiado
    public function saveAction() {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Colegiados = Colegiados::findFirstBycodigo($id);
                $Colegiados = (!$Colegiados) ? new Colegiados() : $Colegiados;

                $Colegiados->codigo = $this->request->getPost("codigo", "int");

                $habilitado = $this->request->getPost("habilitado", "int");
                if (isset($habilitado)) {
                    $Colegiados->habilitado = 1;
                } else {
                    $Colegiados->habilitado = 0;
                }

                $vive = $this->request->getPost("vive", "int");
                if (isset($vive)) {
                    $Colegiados->vive = 1;
                } else {
                    $Colegiados->vive = 0;
                }

                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Colegiados->estado = "A";
                } else {

                    //echo '<pre>';
                    //print_r("No ha chequeado");
                    //xit();


                    $Colegiados->estado = "X";
                }



                $Colegiados->sexo = $this->request->getPost("sexo", "string");
                $Colegiados->documento = $this->request->getPost("documento", "int");
                $Colegiados->nro_documento = $this->request->getPost("nro_documento", "string");

                $Colegiados->telefono = $this->request->getPost("telefono", "string");
                $Colegiados->celular = $this->request->getPost("celular", "string");

                $Colegiados->nombres = $this->request->getPost("nombres", "string");
                $Colegiados->apellidop = $this->request->getPost("apellidop", "string");
                $Colegiados->apellidom = $this->request->getPost("apellidom", "string");

                $Colegiados->direccion = $this->request->getPost("direccion", "string");
                $Colegiados->referencia = $this->request->getPost("referencia", "string");
                $Colegiados->ciudad = $this->request->getPost("ciudad", "string");

                $Colegiados->email = $this->request->getPost("email", "string");

                $Colegiados->seguro = $this->request->getPost("seguro", "int");
                $Colegiados->capitulo = $this->request->getPost("capitulo", "int");
                $Colegiados->consejo = $this->request->getPost("consejo", "int");

                $Colegiados->especialidad = $this->request->getPost("especialidad", "string");

                $Colegiados->facebook = $this->request->getPost("facebook", "string");
                $Colegiados->twitter = $this->request->getPost("twitter", "string");
                $Colegiados->red_social_otra = $this->request->getPost("red_social_otra", "string");


                $Colegiados->emprendedor = $this->request->getPost("emprendedor", "string");
                $Colegiados->entidad1 = $this->request->getPost("entidad1", "string");
                $Colegiados->entidad2 = $this->request->getPost("entidad2", "string");
                $Colegiados->entidad3 = $this->request->getPost("entidad3", "string");


                //->Ubigeo
                $Colegiados->region = $this->request->getPost("region");
                $Colegiados->provincia = $this->request->getPost("provincia");
                $Colegiados->distrito = $this->request->getPost("distrito");
                $Colegiados->ubigeo = $this->request->getPost("ubigeo");

                //$Colegiados->nro_dependientes = 1;
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Colegiados->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_cip", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_cip", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Colegiados->fecha_cip = date('Y-m-d', strtotime($fecha_new));
                }


                //fechamod1
                $fecha_modificacion = date('Y-m-d');
                $Colegiados->fecha_mod1 = $fecha_modificacion;


                //$Colegiados->fechamod1 = date('Y-m-d', strtotime($fecha_modificacion));\
                //Sexo
                if ($this->request->getPost("sexo", "int") == "") {
                    $Colegiados->sexo = null;
                } else {
                    $Colegiados->sexo = $this->request->getPost("sexo", "int");
                }


                $Colegiados->observaciones = $this->request->getPost("observaciones", "string");

                //password graba codigo
                //$colegiados_password = $this->request->getPost("codigo", "int");
                //$Colegiados->password = $this->security->hash($colegiados_password);



                if ($Colegiados->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Colegiados->getMessages());
                } else {


                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen


                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "foto") {

                                $filex = new SplFileInfo($file->getName());



                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Colegiados->foto)) {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . $Colegiados->foto;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Colegiados->codigo . '-' . $temporal_rand . '.jpg';
                                        $Colegiados->foto = 'IMG' . '-' . $Colegiados->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Colegiados->codigo . '.jpg';
                                        $Colegiados->foto = 'IMG' . '-' . $Colegiados->codigo . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Colegiados->imagen = $Colegiados->codigo . "-" . $file->getName();
                                        //$Colegiados->imagen = 'IMG' . '-' . $Colegiados->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($Colegiados->foto)) {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . $Colegiados->foto;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Colegiados->codigo . '-' . $temporal_rand . '.png';
                                        $Colegiados->foto = 'IMG' . '-' . $Colegiados->codigo . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Colegiados->codigo . '.png';
                                        $Colegiados->foto = 'IMG' . '-' . $Colegiados->codigo . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Colegiados->imagen = $Colegiados->codigo . "-" . $file->getName();
                                        //$Colegiados->imagen = 'IMG' . '-' . $Colegiados->codigo . ".jpg";
                                    }
                                }
                            }



                            //archivo

                            if ($file->getKey() == "cv") {
                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Colegiados->cv)) {

                                        $url_destino = 'adminpanel/archivos/cv/' . $Colegiados->cv;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/cv/' . 'FILE' . '-' . $Colegiados->codigo . '-' . $temporal_rand . '.pdf';
                                        $Colegiados->cv = 'FILE' . '-' . $Colegiados->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/cv/' . 'FILE' . '-' . $Colegiados->codigo . '.pdf';
                                        $Colegiados->cv = 'FILE' . '-' . $Colegiados->codigo . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $Colegiados->save();
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

    //Funcion para eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Colegiados = Colegiados::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Colegiados && $Colegiados->estado = 'A') {
                $Colegiados->estado = 'X';
                $Colegiados->save();
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

    //validar registro de colegiados
    public function colegiadoRegistradoAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $colegiados = Colegiados::findFirstBycodigo((int) $this->request->getPost("codigo_colegiado", "int"));


            if ($colegiados) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function descargacvAction($id_user) {
        $obj = Colegiados::findFirstBycodigo($id_user);
        $file = $obj->cv;
        $response = new \Phalcon\Http\Response();
        $path = 'adminpanel/archivos/cv/' . $file;
        $filetype = filetype($path);
        $filesize = filesize($path);
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ", "-", $file), true);
        $response->send();
        die();
    }

}
