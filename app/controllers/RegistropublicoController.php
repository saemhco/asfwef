<?php

class RegistropublicoController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registropublico.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion para agregar colegiado y editar
    public function registroAction($id = null) {


        $this->view->id = $id;
        if ($id != null) {
            $Postulantes = Postulantes::findFirstBycodigo((int) $id);
        } else {
            $Postulantes = Postulantes::findFirstBycodigo(0);
        }

        $this->view->postulantes = $Postulantes;


        //Modelo documentos(a_codigos)        
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //Modelo seguro(a_codigos)
        $seguro = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguro;

         //estado_civil
         $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
         $this->view->estadocivil = $estado_civil;


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

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("p.codigo");
            $datatable->setSelect("p.codigo, p.apellidop, p.apellidom, p.nombres, p.nro_doc, p.telefono, p.celular, p.direccion, p.estado");
            $datatable->setFrom("publico p"); //$datatable->setFrom("colegiados");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("c.estado = 'A'");
            $datatable->setOrderby("p.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar colegiado
    public function saveAction() {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        //         echo '<pre>';
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Postulantes = Postulantes::findFirstBycodigo($id);
                $Postulantes = (!$Postulantes) ? new Publico() : $Postulantes;

                //$Postulantes->codigo = $this->request->getPost("codigo", "int");

                $Postulantes->tipo = 0;
                $Postulantes->apellidop = strtoupper($this->request->getPost("apellidop"));
                $Postulantes->apellidom = strtoupper($this->request->getPost("apellidom"));
                $Postulantes->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("sexo", "int") == "") {
                    $Postulantes->sexo = null;
                } else {
                    $Postulantes->sexo = $this->request->getPost("sexo", "int");
                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Postulantes->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("documento", "int") == "") {
                    $Postulantes->documento = null;
                } else {
                    $Postulantes->documento = $this->request->getPost("documento", "int");
                }


                if ($this->request->getPost("estado_civil", "int") == "") {
                    $Postulantes->estado_civil = null;
                } else {
                    $Postulantes->estado_civil = $this->request->getPost("estado_civil", "int");
                }


                $Postulantes->nro_doc = $this->request->getPost("nro_doc", "string");
                $Postulantes->seguro = $this->request->getPost("seguro", "string");
                $Postulantes->telefono = $this->request->getPost("telefono", "string");
                $Postulantes->celular = $this->request->getPost("celular", "string");
                $Postulantes->email = $this->request->getPost("email", "string");
                $Postulantes->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $Postulantes->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $Postulantes->observaciones = strtoupper($this->request->getPost("observaciones", "string"));

                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {

                    $Postulantes->colegio_publico = 1;
                } else {

                    $Postulantes->colegio_publico = 0;
                }

                $Postulantes->colegio_nombre = strtoupper($this->request->getPost("colegio_nombre", "string"));


                $sitrabaja = $this->request->getPost("sitrabaja", "string");
                if (isset($sitrabaja)) {

                    $Postulantes->sitrabaja = 1;
                } else {

                    $Postulantes->sitrabaja = 0;
                }

                $Postulantes->sitrabaja_nombre = strtoupper($this->request->getPost("sitrabaja_nombre", "string"));

                $sidepende = $this->request->getPost("sidepende", "string");
                if (isset($sidepende)) {

                    $Postulantes->sidepende = 1;
                } else {

                    $Postulantes->sidepende = 0;
                }

                $Postulantes->sidepende_nombre = strtoupper($this->request->getPost("sidepende_nombre", "string"));

                //Ubigeo
                $Postulantes->region = $this->request->getPost("region", "string");
                $Postulantes->provincia = $this->request->getPost("provincia", "string");
                $Postulantes->distrito = $this->request->getPost("distrito", "string");
                $Postulantes->ubigeo = $this->request->getPost("ubigeo", "string");

                //lugar de procedencia
                $Postulantes->region1 = $this->request->getPost("region1", "string");
                $Postulantes->provincia1 = $this->request->getPost("provincia1", "string");
                $Postulantes->distrito1 = $this->request->getPost("distrito1", "string");
                $Postulantes->ubigeo1 = $this->request->getPost("ubigeo1", "string");

                $Postulantes->localidad = $this->request->getPost("localidad", "string");

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $Postulantes->discapacitado = 1;
                } else {

                    $Postulantes->discapacitado = 0;
                }

                $Postulantes->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));


                //$Postulantes->password = $this->request->getPost("password", "string");


                //$password_postulantes = $this->request->getPost("nro_doc", "string");
                //$Postulantes->password = $this->security->hash($password_postulantes);


                $Postulantes->estado = "A";

                //colegio_profesional
                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $Postulantes->colegio_profesional = null;
                } else {
                    $Postulantes->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }

                //colegio_profesional_nro
                $Postulantes->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");


                if ($Postulantes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Postulantes->getMessages());
                } else {


                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen


                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Postulantes->foto)) {
                                        $url_destino = 'adminpanel/imagenes/publico/' . $Postulantes->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.jpg';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $Postulantes->codigo . '.jpg';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Postulantes->foto)) {
                                        $url_destino = 'adminpanel/imagenes/publico/' . $Postulantes->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.png';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $Postulantes->codigo . '.png';
                                        $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . ".png";
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
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Postulantes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.pdf';

                                        $Postulantes->archivo = 'FILE' . '-' . $Postulantes->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE' . '-' . $Postulantes->codigo . '.pdf';

                                        $Postulantes->archivo = 'FILE' . '-' . $Postulantes->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Postulantes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_ruc;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'RUC' . '-' . $Postulantes->nro_ruc . '-' . $temporal_rand . '.pdf';

                                        $Postulantes->archivo_ruc = 'RUC' . '-' . $Postulantes->nro_ruc . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'RUC' . '-' . $Postulantes->nro_ruc . '.pdf';

                                        $Postulantes->archivo_ruc = 'RUC' . '-' . $Postulantes->nro_ruc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_cp") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Postulantes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_cp;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'CP' . '-' . $Postulantes->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $Postulantes->archivo_cp = 'CP' . '-' . $Postulantes->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'CP' . '-' . $Postulantes->nro_doc . '.pdf';

                                        $Postulantes->archivo_cp = 'CP' . '-' . $Postulantes->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }


                            if ($file->getKey() == "archivo_escuela") {

                                if ($_FILES['archivo_escuela']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_escuela']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-CGT' . '-' .$Postulantes->codigo . "." . $extension;
                                       $Postulantes->archivo_escuela = 'FILE-CGT' . '-' .$Postulantes->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_escuela"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Postulantes->save();
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
            $Postulantes = Postulantes::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Postulantes && $Postulantes->estado = 'A') {
                $Postulantes->estado = 'X';
                $Postulantes->save();
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


    //validar docentes registrado
    public function publicoRegistradoAction() {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Postulantes = Postulantes::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($Postulantes) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
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

}
