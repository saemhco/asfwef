<?php

class GestionconvocatoriasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $this->view->id_publico = $id_publico;
        $this->view->id_publico = $id_publico;
        $convocatorias = Convocatorias::findFirst(NULL);
        $this->view->tabla_convocatoria= $convocatorias;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.js?v" . uniqid());
    }


    public function datosAction()
    {
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico;


        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;


        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.datos.js?v" . uniqid());
    }

    public function datos2Action()
    {
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico;

        //Modelo documentos(a_codigos)
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        $tipobonificaciones = TipoBonificaciones::find("estado = 'A' AND numero = 134 ORDER BY orden ASC");
        $this->view->tipobonificaciones = $tipobonificaciones;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.datos2.js?v" . uniqid());
    }

    public function saveDatos2Action()
    {

        //    echo '<pre>';
        //    print_r($_FILES);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoConvocatorias = PublicoConvocatorias::findFirstBycodigo($id);
                //$PublicoConvocatorias = (!$PublicoConvocatorias) ? new PublicoConvocatorias() : $PublicoConvocatorias;

                $PublicoConvocatorias->codigo = $this->request->getPost("codigo", "int");
                $PublicoConvocatorias->documento = 1;
                //$PublicoConvocatorias->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoConvocatorias->nro_ruc = $this->request->getPost("nro_ruc", "string");
                $PublicoConvocatorias->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoConvocatorias->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoConvocatorias->nombres = strtoupper($this->request->getPost("nombres"));
                $PublicoConvocatorias->email = $this->request->getPost("email", "string");
                $PublicoConvocatorias->tipo = 2;
                $PublicoConvocatorias->celular = $this->request->getPost("celular", "string");

                $PublicoConvocatorias->region = $this->request->getPost("region", "string");
                $PublicoConvocatorias->provincia = $this->request->getPost("provincia", "string");
                $PublicoConvocatorias->distrito = $this->request->getPost("distrito", "string");
                $PublicoConvocatorias->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoConvocatorias->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoConvocatorias->direccion = strtoupper($this->request->getPost("direccion", "string"));

                if ($this->request->getPost("estado_civil", "int") == "") {
                    $PublicoConvocatorias->estado_civil = null;
                } else {
                    $PublicoConvocatorias->estado_civil = $this->request->getPost("estado_civil", "int");
                }

                if ($this->request->getPost("sexo", "int") == "") {
                    $PublicoConvocatorias->sexo = null;
                } else {
                    $PublicoConvocatorias->sexo = $this->request->getPost("sexo", "int");
                }

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $PublicoConvocatorias->discapacitado = 1;
                } else {

                    $PublicoConvocatorias->discapacitado = 0;
                }

                $PublicoConvocatorias->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $PublicoConvocatorias->colegio_profesional = null;
                } else {
                    $PublicoConvocatorias->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }

                $PublicoConvocatorias->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");

                $PublicoConvocatorias->estado = "A";

                $PublicoConvocatorias->nacionalidad = $this->request->getPost("nacionalidad", "string");


                if ($this->request->getPost("id_bonificacion", "int") == "") {
                    $PublicoConvocatorias->id_bonificacion = null;
                } else {
                    $PublicoConvocatorias->id_bonificacion = $this->request->getPost("id_bonificacion", "int");
                }

                if ($PublicoConvocatorias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoConvocatorias->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            if ($file->getKey() == "archivo_discapacitado") {

                                if ($_FILES['archivo_discapacitado']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_discapacitado']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DISCAPACITADO' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_discapacitado = 'FILE-DISCAPACITADO' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_discapacitado"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_dar") {

                                if ($_FILES['archivo_dar']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_dar']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DAR' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_dar = 'FILE-DAR' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_dar"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_fa") {

                                if ($_FILES['archivo_fa']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_fa']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-FA' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_fa = 'FILE-FA' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_fa"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_renacyt") {

                                if ($_FILES['archivo_renacyt']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_renacyt']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-RENACYT' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_renacyt = 'FILE-RENACYT' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_renacyt"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $PublicoConvocatorias->save();
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

    //saveDatos
    public function saveDatosAction()
    {

        //        echo '<pre>';
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoConvocatorias = PublicoConvocatorias::findFirstBycodigo($id);
                //$PublicoConvocatorias = (!$PublicoConvocatorias) ? new PublicoConvocatorias() : $PublicoConvocatorias;

                $PublicoConvocatorias->codigo = $this->request->getPost("codigo", "int");
                $PublicoConvocatorias->documento = 1;
                //$PublicoConvocatorias->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoConvocatorias->nro_ruc = $this->request->getPost("nro_ruc", "string");
                $PublicoConvocatorias->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoConvocatorias->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoConvocatorias->nombres = strtoupper($this->request->getPost("nombres"));
                $PublicoConvocatorias->email = $this->request->getPost("email", "string");
                $PublicoConvocatorias->tipo = 4;
                $PublicoConvocatorias->celular = $this->request->getPost("celular", "string");

                $PublicoConvocatorias->region = $this->request->getPost("region", "string");
                $PublicoConvocatorias->provincia = $this->request->getPost("provincia", "string");
                $PublicoConvocatorias->distrito = $this->request->getPost("distrito", "string");
                $PublicoConvocatorias->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoConvocatorias->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoConvocatorias->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $PublicoConvocatorias->ciudad = strtoupper($this->request->getPost("ciudad", "string"));

                if ($this->request->getPost("estado_civil", "int") == "") {
                    $PublicoConvocatorias->estado_civil = null;
                } else {
                    $PublicoConvocatorias->estado_civil = $this->request->getPost("estado_civil", "int");
                }

                if ($this->request->getPost("sexo", "int") == "") {
                    $PublicoConvocatorias->sexo = null;
                } else {
                    $PublicoConvocatorias->sexo = $this->request->getPost("sexo", "int");
                }

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $PublicoConvocatorias->discapacitado = 1;
                } else {

                    $PublicoConvocatorias->discapacitado = 0;
                }

                $PublicoConvocatorias->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $PublicoConvocatorias->colegio_profesional = null;
                } else {
                    $PublicoConvocatorias->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }

                $PublicoConvocatorias->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");

                $PublicoConvocatorias->estado = "A";

                if ($PublicoConvocatorias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoConvocatorias->getMessages());
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

                                    if (isset($PublicoConvocatorias->foto)) {
                                        $url_destino = 'adminpanel/imagenes/publico/' . $PublicoConvocatorias->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '.jpg';
                                        $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($PublicoConvocatorias->foto)) {
                                        $url_destino = 'adminpanel/imagenes/publico/' . $PublicoConvocatorias->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . '.png';
                                        $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '.png';
                                        $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $PublicoConvocatorias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $PublicoConvocatorias->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PublicoConvocatorias->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DNI' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $PublicoConvocatorias->archivo = 'FILE-DNI' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DNI' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';

                                        $PublicoConvocatorias->archivo = 'FILE-DNI' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PublicoConvocatorias->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo_ruc;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'RUC' . '-' . $PublicoConvocatorias->nro_ruc . '-' . $temporal_rand . '.pdf';

                                        $PublicoConvocatorias->archivo_ruc = 'FILE-RUC' . '-' . $PublicoConvocatorias->nro_ruc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'RUC' . '-' . $PublicoConvocatorias->nro_ruc . '.pdf';

                                        $PublicoConvocatorias->archivo_ruc = 'FILE-RUC' . '-' . $PublicoConvocatorias->nro_ruc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }

                            //archivo_cp
                            if ($file->getKey() == "archivo_cp") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PublicoConvocatorias->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo_cp;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'CP' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $PublicoConvocatorias->archivo_cp = 'FILE-CP' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'CP' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';

                                        $PublicoConvocatorias->archivo_cp = 'FILE-CP' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }

                            //archivo_dc
                            if ($file->getKey() == "archivo_dc") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PublicoConvocatorias->archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo_dc;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DC' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $PublicoConvocatorias->archivo_dc = 'FILE-DC' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DC' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';

                                        $PublicoConvocatorias->archivo_dc = 'FILE-DC' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $PublicoConvocatorias->save();
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

    //------------------------------formacion-----------------------------------
    public function formacionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.formacion.js?v" . uniqid());

        //grado
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;
    }

    //datatableFormacion
    public function datatableFormacionAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("formacion.codigo");
            $datatable->setSelect("formacion.codigo, formacion.publico, formacion.grado, "
                . "formacion.nombre, formacion.fecha_grado, formacion.institucion, formacion.pais, "
                . "formacion.archivo, formacion.imagen, formacion.estado, grado.nombres AS nombre_grado");
            $datatable->setFrom("tbl_web_publico_formacion formacion INNER JOIN a_codigos grado ON grado.codigo = formacion.grado");
            //$datatable->setWhere("formacion.estado = 'A' AND grado.numero = 69 AND formacion.publico = {$publico}");
            $datatable->setWhere("formacion.estado = 'A' AND grado.numero = 69 AND formacion.nro_doc = '{$nro_doc}'");
            $datatable->setOrderby("formacion.fecha_grado DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveFormacion
    public function saveFormacionAction()
    {

        //        echo '<pre>';
        //        print_r($_POST);
        //        exit();
        //        echo "<pre>";
        //        print_r($_FILES['archivo']['name']);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoFormacion = PublicoFormacion::findFirstBycodigo($id);
                $PublicoFormacion = (!$PublicoFormacion) ? new PublicoFormacion() : $PublicoFormacion;

                //publico
                $PublicoFormacion->publico = $this->session->get("auth")["codigo"];

                //grado
                $PublicoFormacion->grado = $this->request->getPost("grado", "int");

                //nombre
                $PublicoFormacion->nombre = $this->request->getPost("nombre", "string");

                //fecha_grado
                if ($this->request->getPost("fecha_grado", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_grado", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoFormacion->fecha_grado = date('Y-m-d', strtotime($fecha_new));
                }

                //institucion
                $PublicoFormacion->institucion = $this->request->getPost("institucion", "string");

                //pais
                $PublicoFormacion->pais = $this->request->getPost("pais", "string");

                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoFormacion->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoFormacion->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                //estado
                $PublicoFormacion->estado = 'A';

                //$Publico = Docentes::findFirstBycodigo($this->session->get("auth")["codigo"]);
                //$PublicoFormacion->nro_doc = $Publico->nro_doc;
                $PublicoFormacion->nro_doc = $this->session->get("auth")["nro_doc"];
                if ($PublicoFormacion->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoFormacion->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoFormacion->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '.pdf';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoFormacion->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '.jpg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoFormacion->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '.jpeg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoFormacion->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoFormacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoFormacion = PublicoFormacion::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoFormacion) {
                $this->response->setJsonContent($PublicoFormacion->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminarPublicoFormacion
    public function eliminarPublicoFormacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoFormacion = PublicoFormacion::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoFormacion && $PublicoFormacion->estado = 'A') {

                //$PublicoFormacion->estado = 'X';
                //$PublicoFormacion->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_formacion", "codigo = {$PublicoFormacion->codigo}");
                $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;
                unlink($url_destino);

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

    //--------------------------capacitaciones-------------------------------------
    public function capacitacionesAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.capacitaciones.js?v" . uniqid());

        //capacitaciones
        $Capacitaciones = Capacitaciones::find("estado = 'A' AND numero = 86 order by orden");
        $this->view->capacitaciones = $Capacitaciones;
    }

    //datatableEspecializaciones
    public function datatableCapacitacionesAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("capacitaciones.codigo");
            $datatable->setSelect("capacitaciones.codigo, capacitaciones.publico, capacitaciones.capacitacion, "
                . "capacitaciones.nombre, capacitaciones.fecha_inicio, capacitaciones.fecha_fin, capacitaciones.institucion, "
                . "capacitaciones.pais, capacitaciones.archivo, capacitaciones.imagen, capacitaciones.estado, capacitacion.nombres AS nombre_capacitacion, "
                . "capacitaciones.horas, capacitaciones.creditos");
            $datatable->setFrom("tbl_web_publico_capacitaciones capacitaciones INNER JOIN a_codigos capacitacion ON capacitacion.codigo = capacitaciones.capacitacion");
            $datatable->setWhere("capacitaciones.estado = 'A' AND capacitacion.numero = 86 AND capacitaciones.nro_doc = '{$nro_doc}'");
            $datatable->setOrderby("capacitaciones.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveEspecializacion
    public function saveCapacitacionesAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoCapacitaciones = PublicoCapacitaciones::findFirstBycodigo($id);
                $PublicoCapacitaciones = (!$PublicoCapacitaciones) ? new PublicoCapacitaciones() : $PublicoCapacitaciones;

                //
                //publico
                $PublicoCapacitaciones->publico = $this->session->get("auth")["codigo"];

                //grado
                $PublicoCapacitaciones->capacitacion = $this->request->getPost("capacitacion", "int");

                //nombre
                $PublicoCapacitaciones->nombre = $this->request->getPost("nombre", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoCapacitaciones->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoCapacitaciones->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //institucion
                $PublicoCapacitaciones->institucion = $this->request->getPost("institucion", "string");

                //pais
                $PublicoCapacitaciones->pais = $this->request->getPost("pais", "string");

                //horas
                $PublicoCapacitaciones->horas = $this->request->getPost("horas", "int");

                //creditos
                if ($this->request->getPost("creditos", "string") == "") {
                    $PublicoCapacitaciones->creditos = null;
                } else {
                    $PublicoCapacitaciones->creditos = $this->request->getPost("creditos", "string");
                }

                //
                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoCapacitaciones->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoCapacitaciones->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
                //
                //estado
                $PublicoCapacitaciones->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoCapacitaciones->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoCapacitaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoCapacitaciones->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();
                                //para archivos pdf
                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoCapacitaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '.pdf';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para imaganes con formato jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoCapacitaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '.jpg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoCapacitaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '.jpeg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoCapacitaciones->save();
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

    //getAjaxEspecializacion
    public function getAjaxPublicoCapacitacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoCapacitaciones = PublicoCapacitaciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoCapacitaciones) {
                $this->response->setJsonContent($PublicoCapacitaciones->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminarEspecializaciones
    public function eliminarPublicoCapacitacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoCapacitaciones = PublicoCapacitaciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoCapacitaciones && $PublicoCapacitaciones->estado = 'A') {

                //$PublicoCapacitaciones->estado = 'X';
                //$PublicoCapacitaciones->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_capacitaciones", "codigo = {$PublicoCapacitaciones->codigo}");
                $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;
                unlink($url_destino);

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

    //-----------------------------experiencia----------------------------------
    public function experienciaAction()
    {
        //especialidad
        $TipoExperienciaLaboral = TipoExperienciaLaboral::find("estado = 'A' AND numero = 87");
        $this->view->tipoexperiencialaboral = $TipoExperienciaLaboral;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.experiencia.js?v" . uniqid());
    }

    //datatableExperiencia
    public function datatableExperienciaAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("experiencia.codigo");
            $datatable->setSelect("experiencia.codigo, experiencia.publico, experiencia.tipo, "
                . "experiencia.cargo, experiencia.fecha_inicio, experiencia.fecha_fin, "
                . "experiencia.tiempo, experiencia.institucion, experiencia.funciones, "
                . "experiencia.archivo, experiencia.imagen, experiencia.estado, tipo.nombres AS nombre_tipo");
            $datatable->setFrom("tbl_web_publico_experiencia experiencia INNER JOIN a_codigos tipo ON tipo.codigo = experiencia.tipo");
            //$datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.publico = {$publico}");
            $datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.nro_doc = '{$nro_doc}'");
            $datatable->setOrderby("experiencia.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveExperiencia
    public function saveExperienciaAction()
    {

        //    echo '<pre>';
        //            print_r($_POST);
        //            exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoExperiencia = PublicoExperiencia::findFirstBycodigo($id);
                $PublicoExperiencia = (!$PublicoExperiencia) ? new PublicoExperiencia() : $PublicoExperiencia;

                //publico
                $PublicoExperiencia->publico = $this->session->get("auth")["codigo"];

                //tipo
                $PublicoExperiencia->tipo = $this->request->getPost("tipo", "int");

                //cargo
                $PublicoExperiencia->cargo = $this->request->getPost("cargo", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoExperiencia->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoExperiencia->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //tiempo
                $PublicoExperiencia->tiempo = 0;
                //institucion
                $PublicoExperiencia->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("tipo_institucion", "int") == "") {
                    $PublicoExperiencia->tipo_institucion = null;
                } else {
                    $PublicoExperiencia->tipo_institucion = $this->request->getPost("tipo_institucion", "int");
                }

                //funciones
                $PublicoExperiencia->funciones = $this->request->getPost("funciones");

                //archivo
                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoExperiencia->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoExperiencia->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
                //estado
                $PublicoExperiencia->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoExperiencia->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoExperiencia->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoExperiencia->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoExperiencia->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '.pdf';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoExperiencia->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '.jpg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoExperiencia->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '.jpeg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoExperiencia->save();
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

    //getAjaxPublicoExperiencia
    public function getAjaxPublicoExperienciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExperiencia = PublicoExperiencia::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExperiencia) {
                $this->response->setJsonContent($PublicoExperiencia->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminarExperiencia
    public function eliminarPublicoExperienciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExperiencia = PublicoExperiencia::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExperiencia && $PublicoExperiencia->estado = 'A') {

                //$PublicoExperiencia->estado = 'X';
                //$PublicoExperiencia->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_experiencia", "codigo = {$PublicoExperiencia->codigo}");
                $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;
                unlink($url_destino);

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

    //-----------------------------convocatorias--------------------------------
    public function convocatoriasAction()
    {

        //echo "<pre>"; print_r($_SESSION);exit();

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico->codigo;

        //$ConvocatoriasPublico = ConvocatoriasPublico::count();
        //$this->view->codigo = $ConvocatoriasPublico + 1;
        //Count PublicoFormacion
        $PublicoFormacion = PublicoFormacion::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_formacion = $PublicoFormacion;

        //Count PublicoCapacitaciones
        $PublicoCapacitaciones = PublicoCapacitaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_capacitaciones = $PublicoCapacitaciones;

        //Count PublicoExperiencia
        $PublicoExperiencia = PublicoExperiencia::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_experiencia = $PublicoExperiencia;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.convocatorias.js?v" . uniqid());
    }

    //datatableConvocatorias
    public function datatableConvocatoriasAction()
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto,convocatorias_perfiles.fecha_inicio, convocatorias_perfiles.fecha_fin, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo");
            $datatable->setFrom("tbl_web_convocatorias convocatorias INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria");
            $datatable->setWhere("convocatorias.etapa = 1 AND convocatorias.tipo = 1");
            $datatable->setOrderby("convocatorias_perfiles.nombre_corto");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //verificar convocatoria
    public function verificarConvocatoriaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $convocatoria = (int) $this->request->getPost("convocatoria", "int");
            $publico = (int) $this->request->getPost("publico", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria AND publico = $publico",
                ]
            );

            if ($ConvocatoriasPublico) {
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

    //save convocatorias
    public function saveConvocatoriasAction()
    {

        //     echo '<pre>';
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //perfil
                $perfil_puesto = $this->request->getPost("perfil", "int");

                //vaalidar fecha
                $ConvocatoriasPerfiles = ConvocatoriasPerfiles::findFirstBycodigo($perfil_puesto);

                $f_i = strtotime(date($ConvocatoriasPerfiles->fecha_inicio));
                $f_f = strtotime(date($ConvocatoriasPerfiles->fecha_fin));
                $f_a = strtotime(date("Y-m-d H:i:s", time()));

                if ($f_a >= $f_i and $f_a <= $f_f) {

                    $ConvocatoriasPublico = (!$ConvocatoriasPublico) ? new ConvocatoriasPublicoCas() : $ConvocatoriasPublico;

                    $ConvocatoriasPublico->convocatoria = $this->request->getPost("convocatoria", "int");

                    //publico
                    $ConvocatoriasPublico->publico = $this->request->getPost("publico", "int");

                    //perfil
                    $ConvocatoriasPublico->perfil = $this->request->getPost("perfil", "int");

                    //fecha_registro
                    $ConvocatoriasPublico->fecha = date("Y-m-d H:i:s");

                    $ConvocatoriasPublico->anexos = $this->request->getPost("input-file", "string");

                    //estado
                    $ConvocatoriasPublico->estado = 1;

                    //proceso
                    $ConvocatoriasPublico->proceso = 0;

                    //campos para email
                    $convocatorias_titular = $this->request->getPost("convocatorias_titular", "string");
                    $convocatoria_perfiles_codigo = $this->request->getPost("convocatoria_perfiles_codigo", "string");
                    $convocatoria_perfiles_nombre = $this->request->getPost("convocatoria_perfiles_nombre", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "fecha_vencida"));
                    $this->response->send();
                    exit();
                }

                if ($ConvocatoriasPublico->save() == false) {

                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            // Enviando email a La empresa
                            $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                            $fecha_format = explode("-", $ConvocatoriasPublico->fecha);
                            $fecha_format_resultado = $fecha_format[2] . "/" . $fecha_format[1] . "/" . $fecha_format[0];

                            $email_destEmail = $this->config->mail->destEmailcv;
                            $text_body = "{$this->config->global->xCiudadIns}, $fecha_format_resultado" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "SOLICITUD DE INSCRIPCIÓN" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Señores:" . '<br>';
                            $text_body .= "COMITÉ DE EVALUACIÓN Y SELECCIÓN DEL {$convocatorias_titular}" . '<br>';
                            $text_body .= "{$this->config->global->xNombreIns}" . '<br>';
                            $text_body .= "Presente." . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Yo, {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}, identificado (a)con DNI N° {$Publico->nro_doc}, con correo electrónico {$Publico->email}, me presento ante ustedes, para exponerle:" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Que, deseo postular al puesto de {$convocatoria_perfiles_codigo} {$convocatoria_perfiles_nombre}. del proceso de $convocatorias_titular, cumpliendo con los requisitos solicitados en el perfil del cargo al cual postulo, para cuyo efecto registré los documentos solicitados en la plataforma virtual de Gestión de Convocatorias para la evaluación correspondiente" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Atentamente." . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "{$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}" . '<br>';

                            //
                            $from = $this->config->mail->from;
                            $mailer = new mailer($this->di);
                            $mailer->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            $mailer->setFrom($from);
                            $mailer->setTo($email_destEmail, $from);
                            $mailer->setBody($text_body);
                            //

                            if ($mailer->send()) {
                                //return true;
                            } else {
                                echo $mailer->getError();
                                echo "error";
                            }

                            // Enviando Email al Usuario

                            $email_usuario = $Publico->email;

                            //print("Beba Army is back:" . $email_usuario);
                            //exit();
                            $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Ud. se ha registrado satisfactoriamente al $convocatorias_titular al puesto: {$convocatoria_perfiles_codigo} {$convocatoria_perfiles_nombre}." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "HA REGISTRADO LOS SIGUIENTE INFORMACIÓN:";
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "- DATOS PERSONALES" . '<br>';
                            $text_body2 .= "- FORMACIÓN PROFESIONAL" . '<br>';
                            $text_body2 .= "- CURSOS / DIPLOMADOS DE CAPACITACIÓN" . '<br>';
                            $text_body2 .= "- EXPERIENCIA PROFESIONAL" . '<br>';
                            $text_body2 .= "- ANEXOS." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Atentamente" . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Comité de Evaluación y Selección.";

                            // $mailer_u = new mailer($this->di);
                            // $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            // $mailer_u->setTo($email_usuario, $email_usuario);
                            // $mailer_u->setBody($text_body2);
                            //
                            $from2 = $this->config->mail->from;
                            $mailer_u = new mailer($this->di);
                            $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            $mailer_u->setFrom($from2);
                            $mailer_u->setTo($email_usuario, $from2);
                            $mailer_u->setBody($text_body2);
                            //
                            if ($mailer_u->send()) {
                                //return true;
                            } else {
                                echo $mailer->getError();
                                echo "error";
                            }

                            //archivo
                            $nro_doc = $Publico->nro_doc;

                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($ConvocatoriasPublico->anexos)) {
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->anexos;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '-' . $temporal_rand . '.pdf';
                                        $ConvocatoriasPublico->anexos = 'ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '.pdf';
                                        $ConvocatoriasPublico->anexos = 'ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'PDF') {

                                    if (isset($ConvocatoriasPublico->anexos)) {
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->anexos;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '-' . $temporal_rand . '.pdf';
                                        $ConvocatoriasPublico->anexos = 'ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '.pdf';
                                        $ConvocatoriasPublico->anexos = 'ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    //------------------------postulaciones-------------------------------------
    public function postulacionesAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.postulaciones.js?v" . uniqid());
    }

    public function postulaciones2Action()
    {

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.postulaciones2.js?v" . uniqid());
    }
    public function postulaciones3Action()
    {

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.postulaciones3.js?v" . uniqid());
    }

    //datatablepostulaciones
    public function datatablepostulacionesAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo, "
                . "convocatorias_publico.fecha, convocatorias_publico.anexos");
            $datatable->setFrom("tbl_web_convocatorias convocatorias "
                . "INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria "
                . "INNER JOIN tbl_web_convocatorias_publico convocatorias_publico ON convocatorias_publico.convocatoria = convocatorias.id_convocatoria "
                . "AND convocatorias_publico.perfil = convocatorias_perfiles.codigo");
            //$datatable->setWhere("convocatorias.etapa = 1 AND convocatorias_publico.publico = {$publico}");
            $datatable->setWhere("convocatorias_publico.publico = {$publico} and convocatorias.tipo = 1");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    public function datatablepostulaciones3Action()
    {
        $publico = $this->session->get("auth")["codigo"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo, "
                . "convocatorias_publico.fecha, convocatorias_publico.anexos");
            $datatable->setFrom("tbl_web_convocatorias convocatorias "
                . "INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria "
                . "INNER JOIN tbl_web_convocatorias_publico convocatorias_publico ON convocatorias_publico.convocatoria = convocatorias.id_convocatoria "
                . "AND convocatorias_publico.perfil = convocatorias_perfiles.codigo");
            //$datatable->setWhere("convocatorias.etapa = 1 AND convocatorias_publico.publico = {$publico}");
            $datatable->setWhere("convocatorias_publico.publico = {$publico} and convocatorias.tipo = 3");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //descarga de archivos de datos personales
    public function getArchivosDatosPersonalesAction($publico = null, $datos_personales = null)
    {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        //$publico_ganador = Publico::findFirstBycodigo($publico);
        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($datos_personales == "A") {
            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip", ZipArchive::CREATE);
            //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
            //$zip->addEmptyDir($dir);

            if ($publico_file->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo, "1-" . $publico_file->archivo);
            }

            if ($publico_file->archivo_ruc !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_ruc, "2-" . $publico_file->archivo_ruc);
            }

            if ($publico_file->archivo_cp !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_cp, "3-" . $publico_file->archivo_cp);
            }

            if ($publico_file->archivo_dc !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_dc, "4-" . $publico_file->archivo_dc);
            }

            $zip->close();

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-datos-personales.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
        }
    }

    //descarga de archivos formacion academica
    public function getArchivosFormacionAction($publico = null, $formacion = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($formacion == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.fecha_grado,
                                                publico_formacion.archivo
                                                FROM
                                                PublicoFormacion publico_formacion
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
            //print($PublicoFormacionSql);
            //exit();
            $PublicoFormacionResult = $PublicoFormacionSql->execute();

            //            foreach ($PublicoFormacionResult as $value) {
            //                echo '<pre>';
            //                print_r($value->archivo);
            //            }
            //            exit();

            $num_file_formacion = 1;
            foreach ($PublicoFormacionResult as $PublicoFormacion) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoFormacion->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "{$num_file_formacion}-" . $PublicoFormacion->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file_formacion++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-formacion-academica.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
        }
    }

    //descarga de archivos capacitaciones
    public function getArchivosCapacitacionesAction($publico = null, $capacitaciones = null)
    {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($capacitaciones == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip", ZipArchive::CREATE);

            $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    publico_capacitaciones.fecha_inicio,
                                                    publico_capacitaciones.archivo
                                                    FROM
                                                    PublicoCapacitaciones publico_capacitaciones
                                                    WHERE
                                                    publico_capacitaciones.estado = 'A'
                                                    AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
            $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
            $num_file_capacitaciones = 1;

            foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoCapacitaciones->archivo !== null) {
                    /*print_r($PublicoCapacitaciones);
                    echo  "adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo.'-->'. "{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo;
                    echo '<br>';*/
                    $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "{$num_file_capacitaciones}-" . $PublicoCapacitaciones->archivo);
                }
                $num_file_capacitaciones++;
            }
           
            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-capacitaciones.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
        }
    }

    //descarga de archivos de experiencia
    public function getArchivosExperienciaAction($publico = null, $experiencia = null)
    {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($experiencia == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip", ZipArchive::CREATE);

            $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                publico_experiencia.fecha_inicio,
                                                publico_experiencia.archivo
                                                FROM
                                                PublicoExperiencia publico_experiencia
                                                WHERE
                                                publico_experiencia.estado = 'A'
                                                AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");
            $PublicoExperienciaResult = $PublicoExperienciaSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoExperiencia->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-experiencia.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
        }
    }

    //

    public function registroreciboAction($id = null)
    {
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 2");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $fechaInicio = strtotime(date($convocatorias->fecha_boton_inicio));
        $fechaFin = strtotime(date($convocatorias->fecha_boton_fin));
        $fechaActual = strtotime(date("Y-m-d H:i:s", time()));

        $auth = $this->session->get('auth');
        $codigo_postulante = $auth["codigo"];

        // print("Fecha Inicio: ".$fechaInicio."<br>");
        // print("Fecha Fin: ".$fechaFin."<br>");
        // print("Fecha Actual: ".$fechaActual);
        // exit();

        $verifica_proceso = ConvocatoriasPublico::findFirst("publico = {$codigo_postulante} AND convocatoria = $convocatorias->id_convocatoria");


        // print("Proceso Recibo: " . $verifica_proceso->codigo);
        // exit();


        if ($verifica_proceso->proceso_recibo === 0) {
            return $this->response->redirect("gestionconvocatorias/inscripcionporverificar");
        }

        if ($verifica_proceso->proceso_recibo === 1) {
            return $this->response->redirect("gestionconvocatorias/inscripcionenverificacion");
        }


        if ($verifica_proceso->proceso_recibo === 3) {


            // print("Proceso: " . $verifica_proceso->proceso_recibo);
            // exit();

            return $this->response->redirect("gestionconvocatorias/inscripcionobservada");
        }

        $verifica_1 = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");


        // print(count($verifica_1));
        // exit();

        if (count($verifica_1) >= 1) {
            //ya esta inscrito , y lo redireccionamos a la ficha de Inscripción :v
            return $this->response->redirect("gestionconvocatorias/cv");
        } else {

            // print("Llega");
            // exit();

            if ($fechaActual >= $fechaInicio and $fechaActual <= $fechaFin) {

                // print("Llega XD");
                // exit();

                $verifica_2 = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");
                // print(count($verifica_2));
                // exit();
                if (count($verifica_2) >= 1) {
                    //ya esta inscrito , y lo redireccionamos a la ficha de Inscripción :v
                    return $this->response->redirect("gestionconvocatorias");
                }
            } else {
                //print("Inscripción no disponible");
                //exit();
                return $this->response->redirect("gestionconvocatorias/nodisponible");
                $fecha_falta = 1;
                $this->view->fecha_falta = $fecha_falta;
            }
        }

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->postulante = $Postulante;

        $categoriaPostulante = CategoriaPostulante::find("estado = 'A' AND numero = 104");
        $this->view->categoriapostulante = $categoriaPostulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $semestres = Semestres::findFirst("activo = 'M'");
        // print($semestres->definicion);
        // exit();
        $this->view->semestre_admision = $semestres;

        //admision m
        $convocatoria = Convocatorias::findFirst("activo = 'M'");

        // print("Codigo admision: ".$convocatoria->id_convocatoria);
        // exit();

        $this->view->convocatoria = $convocatoria;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //tipo
        $tipo = TipoExamen::find("estado = 'A' AND numero = 22");
        $this->view->tipo = $tipo;

        //concepto
        $concepto = Conceptos::find();
        $this->view->conceptos = $concepto;

        //concepto
        $carreras = Carreras::find("estado = 'A' AND codigo <> '0001'");
        $this->view->carreras = $carreras;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;


        $admision = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");

        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.registrorecibo.js?v=" . uniqid());
    }

    public function inscripcion2Action($id = null)
    {
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 2");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $this->view->id_convocatoria = $id_convocatoria;

        $fechaInicio = strtotime(date($convocatorias->fecha_boton_inicio));
        $fechaFin = strtotime(date($convocatorias->fecha_boton_fin));
        $fechaActual = strtotime(date("Y-m-d H:i:s", time()));

        $auth = $this->session->get('auth');
        $codigo_postulante = $auth["codigo"];
        $this->view->id_publico = $codigo_postulante;

        // print("Fecha Inicio: ".$fechaInicio."<br>");
        // print("Fecha Fin: ".$fechaFin."<br>");
        // print("Fecha Actual: ".$fechaActual);
        // exit();

        $verifica_proceso = ConvocatoriasPublico::findFirst("publico = {$codigo_postulante} AND convocatoria = $convocatorias->id_convocatoria");


        // print("Proceso Recibo: " . $convocatorias->id_convocatoria);
        // print("Proceso Recibo: " . $codigo_postulante);
        // exit();


        // if ($verifica_proceso->proceso_recibo === 0) {
        //     return $this->response->redirect("gestionconvocatorias/inscripcionporverificar");
        // }

        if ($verifica_proceso->proceso_recibo === 1) {
            return $this->response->redirect("gestionconvocatorias/inscripcionenverificacion");
        }


        if ($verifica_proceso->proceso_recibo === 3) {


            // print("Proceso: " . $verifica_proceso->proceso_recibo);
            // exit();

            return $this->response->redirect("gestionconvocatorias/inscripcionobservada");
        }

        $verifica_1 = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");


        // print(count($verifica_1));
        // exit();

        if (count($verifica_1) >= 1) {
            $convocatorias = Convocatorias::findFirst(NULL);
            $this->view->tabla_convocatoria= $convocatorias;
            //ya esta inscrito , y lo redireccionamos a la ficha de Inscripción :v
            return $this->response->redirect("gestionconvocatorias/cv2");
        } else {

            // print("Llega");
            // exit();

            if ($fechaActual >= $fechaInicio and $fechaActual <= $fechaFin) {

                // print("Llega XD");
                // exit();

                $verifica_2 = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");
                // print(count($verifica_2));
                // exit();
                if (count($verifica_2) >= 1) {
                    //ya esta inscrito , y lo redireccionamos a la ficha de Inscripción :v
                    return $this->response->redirect("gestionconvocatorias");
                }
            } else {
                //print("Inscripción no disponible");
                //exit();
                return $this->response->redirect("gestionconvocatorias/nodisponible");
                $fecha_falta = 1;
                $this->view->fecha_falta = $fecha_falta;
            }
        }

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->postulante = $Postulante;



        $admision = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");

        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.inscripcion2.js?v=" . uniqid());
    }

    public function inscripcion3Action($id = null)
    {
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 3");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $this->view->id_convocatoria = $id_convocatoria;

        $fechaInicio = strtotime(date($convocatorias->fecha_boton_inicio));
        $fechaFin = strtotime(date($convocatorias->fecha_boton_fin));
        $fechaActual = strtotime(date("Y-m-d H:i:s", time()));

        $auth = $this->session->get('auth');
        $codigo_postulante = $auth["codigo"];
        $this->view->id_publico = $codigo_postulante;

        // print("Fecha Inicio: ".$fechaInicio."<br>");
        // print("Fecha Fin: ".$fechaFin."<br>");
        // print("Fecha Actual: ".$fechaActual);
        // exit();

        $verifica_proceso = ConvocatoriasPublico::findFirst("publico = {$codigo_postulante} AND convocatoria = $convocatorias->id_convocatoria");


        // print("Proceso Recibo: " . $convocatorias->id_convocatoria);
        // print("Proceso Recibo: " . $codigo_postulante);
        // exit();


        // if ($verifica_proceso->proceso_recibo === 0) {
        //     return $this->response->redirect("gestionconvocatorias/inscripcionporverificar");
        // }

        if ($verifica_proceso->proceso_recibo === 1) {
            return $this->response->redirect("gestionconvocatorias/inscripcionenverificacion");
        }


        if ($verifica_proceso->proceso_recibo === 3) {


            // print("Proceso: " . $verifica_proceso->proceso_recibo);
            // exit();

            return $this->response->redirect("gestionconvocatorias/inscripcionobservada");
        }

        $verifica_1 = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");


        // print(count($verifica_1));
        // exit();

        if (count($verifica_1) >= 1) {
            //ya esta inscrito , y lo redireccionamos a la ficha de Inscripción :v
            return $this->response->redirect("gestionconvocatorias/cv3");
        } else {

            // print("Llega");
            // exit();

            if ($fechaActual >= $fechaInicio and $fechaActual <= $fechaFin) {

                // print("Llega XD");
                // exit();

                $verifica_2 = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");
                // print(count($verifica_2));
                // exit();
                if (count($verifica_2) >= 1) {
                    //ya esta inscrito , y lo redireccionamos a la ficha de Inscripción :v
                    return $this->response->redirect("gestionconvocatorias");
                }
            } else {
                //print("Inscripción no disponible");
                //exit();
                return $this->response->redirect("gestionconvocatorias/nodisponible");
                $fecha_falta = 1;
                $this->view->fecha_falta = $fecha_falta;
            }
        }

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->postulante = $Postulante;



        $admision = ConvocatoriasPublico::find("convocatoria = $convocatorias->id_convocatoria AND publico= $codigo_postulante");

        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.inscripcion3.js?v=" . uniqid());
    }
    //nodisponible
    public function nodisponibleAction()
    {
    }

    public function saveInscripcionAction()
    {

        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $convocatoriasPublicoRecibo = ConvocatoriasPublicoRecibo::findFirstBycodigo($id);
                $convocatoriasPublicoRecibo = (!$convocatoriasPublicoRecibo) ? new ConvocatoriasPublicoRecibo() : $convocatoriasPublicoRecibo;

                $convocatoriasPublicoRecibo->publico = $this->request->getPost("postulante", "int");
                $convocatoriasPublicoRecibo->convocatoria = $this->request->getPost("convocatoria", "int");


                $convocatoriasPublicoRecibo->fecha_recibo = date('Y-m-d H:i:s');
                $convocatoriasPublicoRecibo->nro_recibo = $this->request->getPost("recibo", "string");
                $convocatoriasPublicoRecibo->monto_recibo = $this->request->getPost("monto", "string");

                $convocatoriasPublicoRecibo->estado = '0';


                //
                $imagenVoucher = $_FILES['file_index_imagen_name']['name'];
                $formatosImagen = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                $fileImagen = $imagenVoucher;

                $extension = pathinfo($fileImagen, PATHINFO_EXTENSION);

                if (in_array($extension, $formatosImagen)) {
                    $convocatoriasPublicoRecibo->archivo_recibo = $this->request->getPost("imagen_index", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "error_imagen"));
                    $this->response->send();
                    exit();
                }
                //

                $convocatoriasPublicoRecibo->proceso_recibo = 0;

                if ($convocatoriasPublicoRecibo->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($convocatoriasPublicoRecibo->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {

                        // Print the real file names and sizes

                        foreach ($this->request->getUploadedFiles() as $file) {

                            if ($file->getKey() == "file_index_imagen_name") {

                                if ($_FILES['file_index_imagen_name']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['file_index_imagen_name']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        $convocatorias = Convocatorias::findFirst("activo = 'M'");
                                        $url_destino = 'adminpanel/imagenes/convocatorias_publico/recibos/' . $convocatorias->id_convocatoria . '/' . 'IMG' . '-' . $convocatorias->id_convocatoria . "-" . $convocatoriasPublicoRecibo->publico . "." . $extension;
                                        $convocatoriasPublicoRecibo->archivo_recibo = 'IMG' . '-' . $convocatorias->id_convocatoria . "-" . $convocatoriasPublicoRecibo->publico . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $convocatoriasPublicoRecibo->save();
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

    public function saveInscripcion2Action()
    {

        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        //id sesion
        //id_convocatoria


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = (int) $this->request->getPost("id_publico", "int");
                $publico = Publico::findFirstBycodigo((int)$id_publico);

                $convocatoriasPublicoInscripcion2 = new ConvocatoriasPublicoInscripcion2();
                $convocatoriasPublicoInscripcion2->publico = $this->request->getPost("id_publico", "int");
                $convocatoriasPublicoInscripcion2->convocatoria = $this->request->getPost("id_convocatoria", "int");
                $convocatoriasPublicoInscripcion2->fecha = date('Y-m-d H:i:s');
                $convocatoriasPublicoInscripcion2->nro_doc = $publico->nro_doc;
                $convocatoriasPublicoInscripcion2->estado = '0';

                if ($convocatoriasPublicoInscripcion2->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($convocatoriasPublicoInscripcion2->getMessages());
                } else {
                    //Cuando va bien
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

    public function inscripcionporverificarAction($id = null)
    {

        if ($id != null) {
            $Postulante = Publico::findFirstBycodigo((int) $id);
            $this->view->id = $id;
        } else {
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        }

        $codigo_postulante = strlen($Postulante->codigo);

        if ($codigo_postulante == 1) {

            $new_codigo = '00000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 2) {
            $new_codigo = '0000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 3) {
            $new_codigo = '000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 4) {
            $new_codigo = '00' . $Postulante->codigo;
        } elseif ($codigo_postulante == 5) {
            $new_codigo = '0' . $Postulante->codigo;
        }

        $this->view->codigo_postulante = $new_codigo;
        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        //$semestres = Semestres::findFirst("activo = 'M'");
        $convocatoria = Convocatorias::findFirst("activo = 'M'");
        // print($convocatoria->id_convocatoria);
        // exit();
        $this->view->convocatoria = $convocatoria;

        $postulante = $Postulante->codigo;
        $convocatoria_m = $convocatoria->id_convocatoria;

        $admision = ConvocatoriasPublico::findFirst(
            [
                "publico = $postulante AND convocatoria = $convocatoria_m",
            ]
        );

        // print($admision->archivo_recibo);
        // exit();

        $this->view->admision = $admision;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $this->assets->addJs("adminpanel/js/modulos/registropostulantesa.js?v=" . uniqid());
    }

    public function inscripcionenverificacionAction($id = null)
    {

        if ($id != null) {
            $Postulante = Publico::findFirstBycodigo((int) $id);
            $this->view->id = $id;
        } else {
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        }

        $codigo_postulante = strlen($Postulante->codigo);

        if ($codigo_postulante == 1) {

            $new_codigo = '00000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 2) {
            $new_codigo = '0000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 3) {
            $new_codigo = '000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 4) {
            $new_codigo = '00' . $Postulante->codigo;
        } elseif ($codigo_postulante == 5) {
            $new_codigo = '0' . $Postulante->codigo;
        }

        $this->view->codigo_postulante = $new_codigo;
        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        //$semestres = Semestres::findFirst("activo = 'M'");
        $admision_activo = Convocatorias::findFirst("activo = 'M'");
        // print($admision_activo->id_convocatoria);
        // exit();
        $this->view->admision_activo = $admision_activo;

        $postulante = $Postulante->codigo;
        $admision_m = $admision_activo->id_convocatoria;

        $admision = ConvocatoriasPublico::findFirst(
            [
                "publico = $postulante AND convocatoria = $admision_m",
            ]
        );
        $this->view->admision = $admision;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.registrorecibo.js?v=" . uniqid());
    }

    public function inscripcionfinAction($id = null)
    {

        if ($id != null) {
            $Postulante = Publico::findFirstBycodigo((int) $id);
            $this->view->id = $id;
        } else {
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        }

        $codigo_postulante = strlen($Postulante->codigo);

        if ($codigo_postulante == 1) {

            $new_codigo = '00000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 2) {
            $new_codigo = '0000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 3) {
            $new_codigo = '000' . $Postulante->codigo;
        } elseif ($codigo_postulante == 4) {
            $new_codigo = '00' . $Postulante->codigo;
        } elseif ($codigo_postulante == 5) {
            $new_codigo = '0' . $Postulante->codigo;
        }

        $this->view->codigo_postulante = $new_codigo;
        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        //$semestres = Semestres::findFirst("activo = 'M'");
        $admision_activo = Convocatorias::findFirst("activo = 'M'");
        $this->view->admision_activo = $admision_activo;

        $postulante = $Postulante->codigo;
        $admision_m = $admision_activo->id_convocatoria;

        $admision = ConvocatoriasPublico::findFirst(
            [
                "publico = $postulante AND convocatoria = $admision_m",
            ]
        );
        $this->view->admision = $admision;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.registrorecibo.js?v=" . uniqid());
    }

    public function inscripcionobservadaAction($id = null)
    {

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->postulante = $Postulante;

        $categoriaPostulante = CategoriaPostulante::find("estado = 'A' AND numero = 104");
        $this->view->categoriapostulante = $categoriaPostulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $semestres = Semestres::findFirst("activo = 'M'");

        // print($semestres->definicion);
        // exit();

        $this->view->semestre_admision = $semestres;

        //admision m
        $admision_m = Convocatorias::findFirst("activo = 'M'");

        // print("Codigo admision: ".$admision_m->codigo);
        // exit();

        $this->view->admision_m = $admision_m;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $admision = ConvocatoriasPublico::findFirst(
            [
                "publico = $Postulante->codigo AND convocatoria = $admision_m->id_convocatoria",
            ]
        );
        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.registrorecibo.js?v=" . uniqid());
    }


    public function updateInscripcionAction()
    {

        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $convocatoriasPublicoRecibo = ConvocatoriasPublicoRecibo::findFirstBycodigo($id);
                $convocatoriasPublicoRecibo = (!$convocatoriasPublicoRecibo) ? new ConvocatoriasPublicoRecibo() : $convocatoriasPublicoRecibo;

                $convocatoriasPublicoRecibo = (!$convocatoriasPublicoRecibo) ? new ConvocatoriasPublicoRecibo() : $convocatoriasPublicoRecibo;

                $convocatoriasPublicoRecibo->publico = $this->request->getPost("postulante", "int");
                $convocatoriasPublicoRecibo->convocatoria = $this->request->getPost("convocatoria", "int");


                $convocatoriasPublicoRecibo->fecha_recibo = date('Y-m-d H:i:s');
                $convocatoriasPublicoRecibo->nro_recibo = $this->request->getPost("recibo", "string");
                $convocatoriasPublicoRecibo->monto_recibo = $this->request->getPost("monto", "string");


                //
                $imagenVoucher = $_FILES['file_imagen']['name'];
                $formatosImagen = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                $fileImagen = $imagenVoucher;

                $extension = pathinfo($fileImagen, PATHINFO_EXTENSION);

                if (in_array($extension, $formatosImagen)) {
                    $convocatoriasPublicoRecibo->archivo_recibo = $this->request->getPost("imagen_index", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "error_imagen"));
                    $this->response->send();
                    exit();
                }
                //

                $convocatoriasPublicoRecibo->proceso_recibo = 0;

                $convocatoriasPublicoRecibo->estado = '0';


                if ($convocatoriasPublicoRecibo->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($convocatoriasPublicoRecibo->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {

                        // Print the real file names and sizes

                        foreach ($this->request->getUploadedFiles() as $file) {

                            if ($file->getKey() == "file_imagen") {

                                if ($_FILES['file_imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['file_imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        $convocatorias = Convocatorias::findFirst("activo = 'M'");
                                        $url_destino = 'adminpanel/imagenes/convocatorias_publico/recibos/' . $convocatorias->id_convocatoria . '/' . 'IMG' . '-' . $convocatorias->id_convocatoria . "-" . $convocatoriasPublicoRecibo->publico . "." . $extension;
                                        $convocatoriasPublicoRecibo->archivo_recibo = 'IMG' . '-' . $convocatorias->id_convocatoria . "-" . $convocatoriasPublicoRecibo->publico . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $convocatoriasPublicoRecibo->save();
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

    public function cv2Action()
    {
        $convocatoria = Convocatorias::find([
            "estado='A' and tipo=2 and etapa=1",
            'order' => 'id_convocatoria ASC',
        ]);

        $this->view->idcodigo = $this->session->get("auth")["codigo"];

        $this->view->tabla_convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/registrovoucher.js?v=" . uniqid());

    }

    public function bandejadocenteAction()
    {
        $convocatoria = Convocatorias::find([
            "estado='A' and tipo=2 and etapa=1",
            'order' => 'id_convocatoria ASC',
        ]);

        $this->view->idcodigo = $this->session->get("auth")["codigo"];

        $this->view->tabla_convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/gestionconvalidacion.voucher.js?v=" . uniqid());

    }

    public function pagorecibidoAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registrovoucher.js?v=" . uniqid());
    }

    public function datatableValidarPagoAction() {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("voucher");
            $datatable->setSelect("voucher,codigo, convocatoria, fecha, archivo,  estado,  nomestado,nombredocente,nro_doc,mensaje,titulo,fechaatencion");
            $datatable->setFrom("(SELECT * from view_voucherdocente) AS temporal_table");
            $datatable->setParams(["length" => -1]);
            //$datatable->setWhere("perfil ={$perfil}");
            //$datatable->setWhere("perfil = 8 OR perfil= 6");
            $datatable->setOrderby("fecha DESC ");
            $datatable->getJson();
            //print_r($datatable->setSelect());
        }

    }

    public function cv3Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.js?v" . uniqid());
    }

    public function cv4Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.js?v" . uniqid());
    }


    //----------------------cargos---------------------------------------------------------------------
    public function cargosAction()
    {

        $tipocargos = TipoCargos::find("estado = 'A' AND numero = 68 order by nombres");
        $this->view->tipocargos = $tipocargos;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.cargos.js?v" . uniqid());
    }

    //datatableExperiencia
    public function datatableCargosAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_cargo,tipo_institucion,nombre,institucion,fecha_inicio,fecha_fin,archivo, estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_cargos.codigo,
            public.tbl_web_publico_cargos.tipo_institucion,
            public.tbl_web_publico_cargos.nombre,
            public.tbl_web_publico_cargos.institucion,
            public.tbl_web_publico_cargos.fecha_inicio,
            public.tbl_web_publico_cargos.fecha_fin,
            public.tbl_web_publico_cargos.archivo,
            public.tbl_web_publico_cargos.estado,
            tipodecargos.nombres AS tipo_cargo
            FROM
            public.tbl_web_publico_cargos
            INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
            WHERE
            tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveExperiencia
    public function saveCargosAction()
    {

        //    echo '<pre>';
        //            print_r($_POST);
        //            exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoCargos = PublicoCargos::findFirstBycodigo($id);
                $PublicoCargos = (!$PublicoCargos) ? new PublicoCargos() : $PublicoCargos;

                //publico
                $PublicoCargos->publico = $this->session->get("auth")["codigo"];

                //tipo
                $PublicoCargos->id_tipo_cargo = $this->request->getPost("id_tipo_cargo", "int");

                //cargo
                $PublicoCargos->nombre = $this->request->getPost("nombre", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoCargos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoCargos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //tiempo
                $PublicoCargos->tiempo = 0;
                $PublicoCargos->hasta_la_fecha = $this->request->getPost("hasta_la_fecha_value", "string");
                //institucion
                $PublicoCargos->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("tipo_institucion", "int") == "") {
                    $PublicoCargos->tipo_institucion = null;
                } else {
                    $PublicoCargos->tipo_institucion = $this->request->getPost("tipo_institucion", "int");
                }

                //funciones
                $PublicoCargos->funciones = $this->request->getPost("funciones");

                //archivo
                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoCargos->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoCargos->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
                //estado
                $PublicoCargos->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoCargos->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoCargos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoCargos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoCargos->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/cargos/' . $PublicoCargos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/cargos/FILE-' . $PublicoCargos->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoCargos->archivo = 'FILE-' . $PublicoCargos->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/cargos/FILE-' . $PublicoCargos->codigo . '.pdf';
                                        $PublicoCargos->archivo = 'FILE-' . $PublicoCargos->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoCargos->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/cargos/' . $PublicoCargos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/cargos/FILE-' . $PublicoCargos->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoCargos->archivo = 'FILE-' . $PublicoCargos->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/cargos/FILE-' . $PublicoCargos->codigo . '.jpg';
                                        $PublicoCargos->archivo = 'FILE-' . $PublicoCargos->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoCargos->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/cargos/' . $PublicoCargos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/cargos/FILE-' . $PublicoCargos->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoCargos->archivo = 'FILE-' . $PublicoCargos->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/cargos/FILE-' . $PublicoCargos->codigo . '.jpeg';
                                        $PublicoCargos->archivo = 'FILE-' . $PublicoCargos->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoCargos->save();
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

    //getAjaxPublicoExperiencia
    public function getAjaxPublicoCargosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoCargos = PublicoCargos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoCargos) {
                $this->response->setJsonContent($PublicoCargos->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminar Cargos
    public function eliminarPublicoCargosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoCargos = PublicoCargos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoCargos && $PublicoCargos->estado = 'A') {

                //$PublicoCargos->estado = 'X';
                //$PublicoCargos->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_cargos", "codigo = {$PublicoCargos->codigo}");
                $url_destino = 'adminpanel/archivos/publico/cargos/' . $PublicoCargos->archivo;
                unlink($url_destino);

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

    //----------------------------------fin cargos-------------------------------------------------------------------


    //--------------------------idiomas-----------------------------------------------------------------------------
    public function idiomasAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.idiomas.js?v" . uniqid());

        //tipoidiomas
        $tipoidiomas = TipoIdiomas::find("estado = 'A' AND numero = 49 ORDER BY nombres");
        $this->view->tipoidiomas = $tipoidiomas;


        //niveles
        $niveles = Niveles::find("estado = 'A' AND numero = 132 ORDER BY nombres");
        $this->view->niveles = $niveles;
    }

    public function datatableIdiomasAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_idioma,publico,id_tipo_idioma,nombre,fecha_inicio,fecha_fin,institucion,pais,id_nivel,horas,creditos,archivo,imagen,nro_doc,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_idiomas.codigo,
            tipodeidiomas.nombres AS tipo_idioma,
            public.tbl_web_publico_idiomas.publico,
            public.tbl_web_publico_idiomas.id_tipo_idioma,
            public.tbl_web_publico_idiomas.nombre,
            public.tbl_web_publico_idiomas.fecha_inicio,
            public.tbl_web_publico_idiomas.fecha_fin,
            public.tbl_web_publico_idiomas.institucion,
            public.tbl_web_publico_idiomas.pais,
            public.tbl_web_publico_idiomas.id_nivel,
            public.tbl_web_publico_idiomas.horas,
            public.tbl_web_publico_idiomas.creditos,
            public.tbl_web_publico_idiomas.archivo,
            public.tbl_web_publico_idiomas.imagen,
            public.tbl_web_publico_idiomas.nro_doc,
            public.tbl_web_publico_idiomas.estado
            FROM
            public.a_codigos AS tipodeidiomas
            INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
            WHERE
            tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    //saveEspecializacion
    public function saveIdiomasAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoIdiomas = PublicoIdiomas::findFirstBycodigo($id);
                $PublicoIdiomas = (!$PublicoIdiomas) ? new PublicoIdiomas() : $PublicoIdiomas;


                $PublicoIdiomas->publico = $this->session->get("auth")["codigo"];

                if ($this->request->getPost("id_tipo_idioma", "int") == "") {
                    $PublicoIdiomas->id_tipo_idioma = null;
                } else {
                    $PublicoIdiomas->id_tipo_idioma = $this->request->getPost("id_tipo_idioma", "int");
                }

                if ($this->request->getPost("id_nivel", "int") == "") {
                    $PublicoIdiomas->id_nivel = null;
                } else {
                    $PublicoIdiomas->id_nivel = $this->request->getPost("id_nivel", "int");
                }

                $PublicoIdiomas->nombre = $this->request->getPost("nombre", "string");


                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoIdiomas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }


                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoIdiomas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }


                $PublicoIdiomas->institucion = $this->request->getPost("institucion", "string");


                $PublicoIdiomas->pais = $this->request->getPost("pais", "string");


                $PublicoIdiomas->horas = $this->request->getPost("horas", "int");


                if ($this->request->getPost("creditos", "int") == "") {
                    $PublicoIdiomas->creditos = null;
                } else {
                    $PublicoIdiomas->creditos = $this->request->getPost("creditos", "int");
                }


                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoIdiomas->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoIdiomas->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
                //
                //estado
                $PublicoIdiomas->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoIdiomas->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoIdiomas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoIdiomas->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();
                                //para archivos pdf
                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoIdiomas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/' . $PublicoIdiomas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/FILE-' . $PublicoIdiomas->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoIdiomas->archivo = 'FILE-' . $PublicoIdiomas->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/FILE-' . $PublicoIdiomas->codigo . '.pdf';
                                        $PublicoIdiomas->archivo = 'FILE-' . $PublicoIdiomas->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para imaganes con formato jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoIdiomas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/' . $PublicoIdiomas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/FILE-' . $PublicoIdiomas->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoIdiomas->archivo = 'FILE-' . $PublicoIdiomas->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/FILE-' . $PublicoIdiomas->codigo . '.jpg';
                                        $PublicoIdiomas->archivo = 'FILE-' . $PublicoIdiomas->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoIdiomas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/' . $PublicoIdiomas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/FILE-' . $PublicoIdiomas->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoIdiomas->archivo = 'FILE-' . $PublicoIdiomas->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/idiomas/FILE-' . $PublicoIdiomas->codigo . '.jpeg';
                                        $PublicoIdiomas->archivo = 'FILE-' . $PublicoIdiomas->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoIdiomas->save();
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

    //getAjaxEspecializacion
    public function getAjaxPublicoIdiomasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoIdiomas = PublicoIdiomas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoIdiomas) {
                $this->response->setJsonContent($PublicoIdiomas->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminarEspecializaciones
    public function eliminarPublicoIdiomasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoIdiomas = PublicoIdiomas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoIdiomas && $PublicoIdiomas->estado = 'A') {

                //$PublicoIdiomas->estado = 'X';
                //$PublicoIdiomas->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_idiomas", "codigo = {$PublicoIdiomas->codigo}");
                $url_destino = 'adminpanel/archivos/publico/idiomas/' . $PublicoIdiomas->archivo;
                unlink($url_destino);

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

    //--------------------------finidiomas-----------------------------------------------------------------------------

    //---------------------------asesorias-----------------------------------------------------------------------------
    public function asesoriasAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.asesorias.js?v" . uniqid());


        $universidades = Universidades::find("estado = 'A' ORDER BY universidad ASC");
        $this->view->universidades = $universidades;

        $grados = Grados::find("estado = 'A' AND numero = 69 ORDER BY nombres ASC");
        $this->view->grados = $grados;
    }

    //datatableFormacion
    public function datatableAsesoriasAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,tipo_grado, publico, id_grado, tesista, fecha, url, archivo, imagen, nro_doc, estado, universidad, tipo_institucion");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_asesorias.codigo,
            tipo_grado.nombres AS tipo_grado,
            public.tbl_web_publico_asesorias.publico,
            public.tbl_web_publico_asesorias.id_grado,
            public.tbl_web_publico_asesorias.tesista,
            to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_asesorias.url,
            public.tbl_web_publico_asesorias.archivo,
            public.tbl_web_publico_asesorias.imagen,
            public.tbl_web_publico_asesorias.nro_doc,
            public.tbl_web_publico_asesorias.estado,
            public.tbl_web_universidades.universidad,
            tipodeinstitucion.nombres AS tipo_institucion
            FROM
            public.tbl_web_publico_asesorias
            INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
            INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
            INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
            WHERE
            tipodeinstitucion.numero = 105 AND
            tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }



    //saveFormacion
    public function saveAsesoriasAction()
    {

        //        echo '<pre>';
        //        print_r($_POST);
        //        exit();
        //        echo "<pre>";
        //        print_r($_FILES['archivo']['name']);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoAsesorias = PublicoAsesorias::findFirstBycodigo($id);
                $PublicoAsesorias = (!$PublicoAsesorias) ? new PublicoAsesorias() : $PublicoAsesorias;

                $PublicoAsesorias->publico = $this->session->get("auth")["codigo"];

                if ($this->request->getPost("id_universidad", "int") == "") {
                    $PublicoAsesorias->id_universidad = null;
                } else {
                    $PublicoAsesorias->id_universidad = $this->request->getPost("id_universidad", "int");
                }

                if ($this->request->getPost("id_grado", "int") == "") {
                    $PublicoAsesorias->id_grado = null;
                } else {
                    $PublicoAsesorias->id_grado = $this->request->getPost("id_grado", "int");
                }

                $PublicoAsesorias->tesista = $this->request->getPost("tesista", "string");

                if ($this->request->getPost("fecha", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoAsesorias->fecha = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoAsesorias->url = $this->request->getPost("url", "string");


                $PublicoAsesorias->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoAsesorias->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoAsesorias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoAsesorias->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoAsesorias->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/' . $PublicoAsesorias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/FILE-' . $PublicoAsesorias->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoAsesorias->archivo = 'FILE-' . $PublicoAsesorias->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/FILE-' . $PublicoAsesorias->codigo . '.pdf';
                                        $PublicoAsesorias->archivo = 'FILE-' . $PublicoAsesorias->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoAsesorias->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/' . $PublicoAsesorias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/FILE-' . $PublicoAsesorias->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoAsesorias->archivo = 'FILE-' . $PublicoAsesorias->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/FILE-' . $PublicoAsesorias->codigo . '.jpg';
                                        $PublicoAsesorias->archivo = 'FILE-' . $PublicoAsesorias->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoAsesorias->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/' . $PublicoAsesorias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/FILE-' . $PublicoAsesorias->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoAsesorias->archivo = 'FILE-' . $PublicoAsesorias->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/asesorias/FILE-' . $PublicoAsesorias->codigo . '.jpeg';
                                        $PublicoAsesorias->archivo = 'FILE-' . $PublicoAsesorias->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoAsesorias->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoAsesoriasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoAsesorias = PublicoAsesorias::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoAsesorias) {
                $this->response->setJsonContent($PublicoAsesorias->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarPublicoAsesoriasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoAsesorias = PublicoAsesorias::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoAsesorias && $PublicoAsesorias->estado = 'A') {

                //$PublicoAsesorias->estado = 'X';
                //$PublicoAsesorias->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_asesorias", "codigo = {$PublicoAsesorias->codigo}");
                $url_destino = 'adminpanel/archivos/publico/asesorias/' . $PublicoAsesorias->archivo;
                unlink($url_destino);

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

    //-----------------------------------fin asesorias------------------------------------------------------------
    //------------------------------------publicaciones-----------------------------------------------------------
    public function publicacionesAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.publicaciones.js?v" . uniqid());

        $tipopublicaciones = TipoPublicaciones::find("estado = 'A' AND numero = 135 ORDER BY nombres ASC");
        $this->view->tipopublicaciones = $tipopublicaciones;
    }

    //datatableFormacion
    public function datatablePublicacionesAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,id_tipo_publicacion,nombre,fecha_publicacion,doi,pais,archivo,imagen,estado,nro_paginas,nro_doc,tipo_publicacion");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_publicaciones.codigo,
            public.tbl_web_publico_publicaciones.publico,
            public.tbl_web_publico_publicaciones.id_tipo_publicacion,
            public.tbl_web_publico_publicaciones.nombre,
            to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
            public.tbl_web_publico_publicaciones.doi,
            public.tbl_web_publico_publicaciones.pais,
            public.tbl_web_publico_publicaciones.archivo,
            public.tbl_web_publico_publicaciones.imagen,
            public.tbl_web_publico_publicaciones.estado,
            public.tbl_web_publico_publicaciones.nro_paginas,
            public.tbl_web_publico_publicaciones.nro_doc,
            tipo_de_publicaciones.nombres AS tipo_publicacion
            FROM
            public.a_codigos AS tipo_de_publicaciones
            INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
            WHERE
            tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha_publicacion DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveFormacion
    public function savePublicacionesAction()
    {

        //        echo '<pre>';
        //        print_r($_POST);
        //        exit();
        //        echo "<pre>";
        //        print_r($_FILES['archivo']['name']);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoPublicaciones = PublicoPublicaciones::findFirstBycodigo($id);
                $PublicoPublicaciones = (!$PublicoPublicaciones) ? new PublicoPublicaciones() : $PublicoPublicaciones;

                $PublicoPublicaciones->publico = $this->session->get("auth")["codigo"];

                if ($this->request->getPost("id_tipo_publicacion", "int") == "") {
                    $PublicoPublicaciones->id_tipo_publicacion = null;
                } else {
                    $PublicoPublicaciones->id_tipo_publicacion = $this->request->getPost("id_tipo_publicacion", "int");
                }


                $PublicoPublicaciones->nombre = $this->request->getPost("nombre", "string");

                if ($this->request->getPost("fecha_publicacion", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_publicacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoPublicaciones->fecha_publicacion = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoPublicaciones->doi = $this->request->getPost("doi", "string");

                $PublicoPublicaciones->pais = $this->request->getPost("pais", "string");

                if ($this->request->getPost("nro_paginas", "int") == "") {
                    $PublicoPublicaciones->nro_paginas = null;
                } else {
                    $PublicoPublicaciones->nro_paginas = $this->request->getPost("nro_paginas", "int");
                }


                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoPublicaciones->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoPublicaciones->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                //estado
                $PublicoPublicaciones->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoPublicaciones->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoPublicaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoPublicaciones->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoPublicaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/' . $PublicoPublicaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/FILE-' . $PublicoPublicaciones->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoPublicaciones->archivo = 'FILE-' . $PublicoPublicaciones->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/FILE-' . $PublicoPublicaciones->codigo . '.pdf';
                                        $PublicoPublicaciones->archivo = 'FILE-' . $PublicoPublicaciones->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoPublicaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/' . $PublicoPublicaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/FILE-' . $PublicoPublicaciones->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoPublicaciones->archivo = 'FILE-' . $PublicoPublicaciones->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/FILE-' . $PublicoPublicaciones->codigo . '.jpg';
                                        $PublicoPublicaciones->archivo = 'FILE-' . $PublicoPublicaciones->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoPublicaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/' . $PublicoPublicaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/FILE-' . $PublicoPublicaciones->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoPublicaciones->archivo = 'FILE-' . $PublicoPublicaciones->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/publicaciones/FILE-' . $PublicoPublicaciones->codigo . '.jpeg';
                                        $PublicoPublicaciones->archivo = 'FILE-' . $PublicoPublicaciones->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoPublicaciones->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoPublicacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoPublicaciones = PublicoPublicaciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoPublicaciones) {
                $this->response->setJsonContent($PublicoPublicaciones->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarPublicoPublicacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoPublicaciones = PublicoPublicaciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoPublicaciones && $PublicoPublicaciones->estado = 'A') {

                //$PublicoPublicaciones->estado = 'X';
                //$PublicoPublicaciones->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_publicaciones", "codigo = {$PublicoPublicaciones->codigo}");
                $url_destino = 'adminpanel/archivos/publico/publicaciones/' . $PublicoPublicaciones->archivo;
                unlink($url_destino);

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

    //--------------------------------------------fin publicaciones--------------------------------------------------------------------------
    //----------------------------------------------------extension--------------------------------------------------------------------------
    public function extensionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.extension.js?v" . uniqid());
    }

    //datatableFormacion
    public function datatableExtensionAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,nombre,fecha,fecha_fin,archivo,imagen,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_extension.codigo,
            public.tbl_web_publico_extension.publico,
            public.tbl_web_publico_extension.nombre,
            to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
            to_char(public.tbl_web_publico_extension.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            public.tbl_web_publico_extension.archivo,
            public.tbl_web_publico_extension.imagen,
            public.tbl_web_publico_extension.estado
            FROM
            public.tbl_web_publico_extension
            WHERE
            public.tbl_web_publico_extension.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveFormacion
    public function saveExtensionAction()
    {

        //        echo '<pre>';
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoExtension = PublicoExtension::findFirstBycodigo($id);
                $PublicoExtension = (!$PublicoExtension) ? new PublicoExtension() : $PublicoExtension;

                $PublicoExtension->publico = $this->session->get("auth")["codigo"];

                $PublicoExtension->nombre = $this->request->getPost("nombre", "string");

                if ($this->request->getPost("fecha", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoExtension->fecha = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_exf = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_newf = $fecha_exf[2] . "-" . $fecha_exf[1] . "-" . $fecha_exf[0];
                    $PublicoExtension->fecha_fin = date('Y-m-d', strtotime($fecha_newf));
                }



                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoExtension->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoExtension->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                //estado
                $PublicoExtension->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoExtension->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoExtension->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoExtension->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoExtension->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/extension/' . $PublicoExtension->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/extension/FILE-' . $PublicoExtension->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoExtension->archivo = 'FILE-' . $PublicoExtension->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/extension/FILE-' . $PublicoExtension->codigo . '.pdf';
                                        $PublicoExtension->archivo = 'FILE-' . $PublicoExtension->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoExtension->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/extension/' . $PublicoExtension->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/extension/FILE-' . $PublicoExtension->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoExtension->archivo = 'FILE-' . $PublicoExtension->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/extension/FILE-' . $PublicoExtension->codigo . '.jpg';
                                        $PublicoExtension->archivo = 'FILE-' . $PublicoExtension->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoExtension->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/extension/' . $PublicoExtension->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/extension/FILE-' . $PublicoExtension->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoExtension->archivo = 'FILE-' . $PublicoExtension->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/extension/FILE-' . $PublicoExtension->codigo . '.jpeg';
                                        $PublicoExtension->archivo = 'FILE-' . $PublicoExtension->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoExtension->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoExtensionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExtension = PublicoExtension::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExtension) {
                $this->response->setJsonContent($PublicoExtension->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarPublicoExtensionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExtension = PublicoExtension::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExtension && $PublicoExtension->estado = 'A') {

                //$PublicoExtension->estado = 'X';
                //$PublicoExtension->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_extension", "codigo = {$PublicoExtension->codigo}");
                $url_destino = 'adminpanel/archivos/publico/extension/' . $PublicoExtension->archivo;
                unlink($url_destino);

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

    //------------------------------------------fin extension--------------------------------------------------------------

    //-------------------------------------------------distinciones----------------------------------------------------------
    public function distincionesAction()
    {

        $tipodistinciones = TipoDistinciones::find("estado = 'A' AND numero = 143 ORDER BY nombres ASC");
        $this->view->tipodistinciones = $tipodistinciones;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.distinciones.js?v" . uniqid());
    }

    //datatableFormacion
    public function datatableDistincionesAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,tipo_distincion,publico,nombre,fecha,archivo,imagen,estado,id_tipo_distincion,nro_doc");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_distinciones.codigo,
            tipo_de_distinciones.nombres AS tipo_distincion,
            public.tbl_web_publico_distinciones.publico,
            public.tbl_web_publico_distinciones.id_tipo_distincion,
            public.tbl_web_publico_distinciones.nombre,
            to_char(public.tbl_web_publico_distinciones.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_distinciones.archivo,
            public.tbl_web_publico_distinciones.imagen,
            public.tbl_web_publico_distinciones.nro_doc,
            public.tbl_web_publico_distinciones.estado
            FROM
            public.a_codigos AS tipo_de_distinciones
            INNER JOIN public.tbl_web_publico_distinciones ON public.tbl_web_publico_distinciones.id_tipo_distincion = tipo_de_distinciones.codigo
            WHERE
            tipo_de_distinciones.numero = 143 AND public.tbl_web_publico_distinciones.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveFormacion
    public function saveDistincionesAction()
    {

        //    echo '<pre>';
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoDistinciones = PublicoDistinciones::findFirstBycodigo($id);
                $PublicoDistinciones = (!$PublicoDistinciones) ? new PublicoDistinciones() : $PublicoDistinciones;


                if ($this->request->getPost("id_tipo_distincion", "int") == "") {
                    $PublicoDistinciones->id_tipo_distincion = null;
                } else {
                    $PublicoDistinciones->id_tipo_distincion = $this->request->getPost("id_tipo_distincion", "int");
                }


                $PublicoDistinciones->publico = $this->session->get("auth")["codigo"];

                $PublicoDistinciones->nombre = $this->request->getPost("nombre", "string");

                if ($this->request->getPost("fecha", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoDistinciones->fecha = date('Y-m-d', strtotime($fecha_new));
                }



                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoDistinciones->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoDistinciones->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                //estado
                $PublicoDistinciones->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoDistinciones->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoDistinciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoDistinciones->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoDistinciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/' . $PublicoDistinciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/FILE-' . $PublicoDistinciones->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoDistinciones->archivo = 'FILE-' . $PublicoDistinciones->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/FILE-' . $PublicoDistinciones->codigo . '.pdf';
                                        $PublicoDistinciones->archivo = 'FILE-' . $PublicoDistinciones->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoDistinciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/' . $PublicoDistinciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/FILE-' . $PublicoDistinciones->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoDistinciones->archivo = 'FILE-' . $PublicoDistinciones->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/FILE-' . $PublicoDistinciones->codigo . '.jpg';
                                        $PublicoDistinciones->archivo = 'FILE-' . $PublicoDistinciones->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoDistinciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/' . $PublicoDistinciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/FILE-' . $PublicoDistinciones->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoDistinciones->archivo = 'FILE-' . $PublicoDistinciones->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/distinciones/FILE-' . $PublicoDistinciones->codigo . '.jpeg';
                                        $PublicoDistinciones->archivo = 'FILE-' . $PublicoDistinciones->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoDistinciones->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoDistincionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoDistinciones = PublicoDistinciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoDistinciones) {
                $this->response->setJsonContent($PublicoDistinciones->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarPublicoDistincionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoDistinciones = PublicoDistinciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoDistinciones && $PublicoDistinciones->estado = 'A') {

                //$PublicoDistinciones->estado = 'X';
                //$PublicoDistinciones->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_distinciones", "codigo = {$PublicoDistinciones->codigo}");
                $url_destino = 'adminpanel/archivos/publico/distinciones/' . $PublicoDistinciones->archivo;
                unlink($url_destino);

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

    //------------------------------------------fin distinciones--------------------------------------------------------------


    //--------------------------ofimaticas-----------------------------------------------------------------------------
    public function ofimaticasAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.ofimaticas.js?v" . uniqid());

        //tipoofimaticas
        $tipoofimaticas = TipoOfimaticas::find("estado = 'A' AND numero = 144 ORDER BY nombres");
        $this->view->tipoofimaticas = $tipoofimaticas;


        //niveles
        $niveles = Niveles::find("estado = 'A' AND numero = 132 ORDER BY nombres");
        $this->view->niveles = $niveles;
    }

    public function datatableOfimaticasAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, tipo_ofimatica,publico,id_tipo_ofimatica,nombre,fecha_inicio,fecha_fin,institucion,pais,id_nivel,horas,creditos,archivo,imagen,nro_doc,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_ofimaticas.codigo,
            tipodeofimaticas.nombres AS tipo_ofimatica,
            public.tbl_web_publico_ofimaticas.publico,
            public.tbl_web_publico_ofimaticas.id_tipo_ofimatica,
            public.tbl_web_publico_ofimaticas.nombre,
            public.tbl_web_publico_ofimaticas.fecha_inicio,
            public.tbl_web_publico_ofimaticas.fecha_fin,
            public.tbl_web_publico_ofimaticas.institucion,
            public.tbl_web_publico_ofimaticas.pais,
            public.tbl_web_publico_ofimaticas.id_nivel,
            public.tbl_web_publico_ofimaticas.horas,
            public.tbl_web_publico_ofimaticas.creditos,
            public.tbl_web_publico_ofimaticas.archivo,
            public.tbl_web_publico_ofimaticas.imagen,
            public.tbl_web_publico_ofimaticas.nro_doc,
            public.tbl_web_publico_ofimaticas.estado
            FROM
            public.a_codigos AS tipodeofimaticas
            INNER JOIN public.tbl_web_publico_ofimaticas ON tipodeofimaticas.codigo = public.tbl_web_publico_ofimaticas.id_tipo_ofimatica
            WHERE
            tipodeofimaticas.numero = 144 AND public.tbl_web_publico_ofimaticas.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    //saveEspecializacion
    public function saveOfimaticasAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoOfimaticas = PublicoOfimaticas::findFirstBycodigo($id);
                $PublicoOfimaticas = (!$PublicoOfimaticas) ? new PublicoOfimaticas() : $PublicoOfimaticas;


                $PublicoOfimaticas->publico = $this->session->get("auth")["codigo"];

                if ($this->request->getPost("id_tipo_ofimatica", "int") == "") {
                    $PublicoOfimaticas->id_tipo_ofimatica = null;
                } else {
                    $PublicoOfimaticas->id_tipo_ofimatica = $this->request->getPost("id_tipo_ofimatica", "int");
                }

                if ($this->request->getPost("id_nivel", "int") == "") {
                    $PublicoOfimaticas->id_nivel = null;
                } else {
                    $PublicoOfimaticas->id_nivel = $this->request->getPost("id_nivel", "int");
                }

                $PublicoOfimaticas->nombre = $this->request->getPost("nombre", "string");


                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoOfimaticas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }


                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoOfimaticas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }


                $PublicoOfimaticas->institucion = $this->request->getPost("institucion", "string");


                $PublicoOfimaticas->pais = $this->request->getPost("pais", "string");


                $PublicoOfimaticas->horas = $this->request->getPost("horas", "int");


                if ($this->request->getPost("creditos", "string") == "") {
                    $PublicoOfimaticas->creditos = null;
                } else {
                    $PublicoOfimaticas->creditos = $this->request->getPost("creditos", "string");
                }


                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoOfimaticas->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoOfimaticas->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
                //
                //estado
                $PublicoOfimaticas->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoOfimaticas->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoOfimaticas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoOfimaticas->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();
                                //para archivos pdf
                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoOfimaticas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/' . $PublicoOfimaticas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/FILE-' . $PublicoOfimaticas->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoOfimaticas->archivo = 'FILE-' . $PublicoOfimaticas->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/FILE-' . $PublicoOfimaticas->codigo . '.pdf';
                                        $PublicoOfimaticas->archivo = 'FILE-' . $PublicoOfimaticas->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para imaganes con formato jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoOfimaticas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/' . $PublicoOfimaticas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/FILE-' . $PublicoOfimaticas->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoOfimaticas->archivo = 'FILE-' . $PublicoOfimaticas->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/FILE-' . $PublicoOfimaticas->codigo . '.jpg';
                                        $PublicoOfimaticas->archivo = 'FILE-' . $PublicoOfimaticas->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoOfimaticas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/' . $PublicoOfimaticas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/FILE-' . $PublicoOfimaticas->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoOfimaticas->archivo = 'FILE-' . $PublicoOfimaticas->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/ofimaticas/FILE-' . $PublicoOfimaticas->codigo . '.jpeg';
                                        $PublicoOfimaticas->archivo = 'FILE-' . $PublicoOfimaticas->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoOfimaticas->save();
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

    //getAjaxEspecializacion
    public function getAjaxPublicoOfimaticasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoOfimaticas = PublicoOfimaticas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoOfimaticas) {
                $this->response->setJsonContent($PublicoOfimaticas->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminarEspecializaciones
    public function eliminarPublicoOfimaticasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoOfimaticas = PublicoOfimaticas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoOfimaticas && $PublicoOfimaticas->estado = 'A') {

                //$PublicoOfimaticas->estado = 'X';
                //$PublicoOfimaticas->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_ofimaticas", "codigo = {$PublicoOfimaticas->codigo}");
                $url_destino = 'adminpanel/archivos/publico/ofimaticas/' . $PublicoOfimaticas->archivo;
                unlink($url_destino);

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

    //--------------------------finofimaticas-----------------------------------------------------------------------------

    //-------------------------------------------------materiales----------------------------------------------------------
    public function materialesAction()
    {

        $tipomateriales = TipoMateriales::find("estado = 'A' AND numero = 133 ORDER BY nombres ASC");
        $this->view->tipomateriales = $tipomateriales;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.materiales.js?v" . uniqid());
    }

    //datatableFormacion
    public function datatableMaterialesAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,tipo_material,publico,nombre,fecha,archivo,imagen,estado,id_tipo_material,nro_doc");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_materiales.codigo,
            tipo_de_materiales.nombres AS tipo_material,
            public.tbl_web_publico_materiales.publico,
            public.tbl_web_publico_materiales.id_tipo_material,
            public.tbl_web_publico_materiales.nombre,
            to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_materiales.archivo,
            public.tbl_web_publico_materiales.imagen,
            public.tbl_web_publico_materiales.nro_doc,
            public.tbl_web_publico_materiales.estado
            FROM
            public.a_codigos AS tipo_de_materiales
            INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
            WHERE
            tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveFormacion
    public function saveMaterialesAction()
    {

        //    echo '<pre>';
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoMateriales = PublicoMateriales::findFirstBycodigo($id);
                $PublicoMateriales = (!$PublicoMateriales) ? new PublicoMateriales() : $PublicoMateriales;


                if ($this->request->getPost("id_tipo_material", "int") == "") {
                    $PublicoMateriales->id_tipo_material = null;
                } else {
                    $PublicoMateriales->id_tipo_material = $this->request->getPost("id_tipo_material", "int");
                }


                $PublicoMateriales->publico = $this->session->get("auth")["codigo"];

                $PublicoMateriales->nombre = $this->request->getPost("nombre", "string");

                if ($this->request->getPost("fecha", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoMateriales->fecha = date('Y-m-d', strtotime($fecha_new));
                }



                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoMateriales->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoMateriales->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                //estado
                $PublicoMateriales->estado = 'A';

                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoMateriales->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoMateriales->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoMateriales->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoMateriales->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/materiales/' . $PublicoMateriales->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/materiales/FILE-' . $PublicoMateriales->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoMateriales->archivo = 'FILE-' . $PublicoMateriales->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/materiales/FILE-' . $PublicoMateriales->codigo . '.pdf';
                                        $PublicoMateriales->archivo = 'FILE-' . $PublicoMateriales->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoMateriales->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/materiales/' . $PublicoMateriales->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/materiales/FILE-' . $PublicoMateriales->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoMateriales->archivo = 'FILE-' . $PublicoMateriales->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/materiales/FILE-' . $PublicoMateriales->codigo . '.jpg';
                                        $PublicoMateriales->archivo = 'FILE-' . $PublicoMateriales->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoMateriales->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/materiales/' . $PublicoMateriales->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/materiales/FILE-' . $PublicoMateriales->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoMateriales->archivo = 'FILE-' . $PublicoMateriales->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/materiales/FILE-' . $PublicoMateriales->codigo . '.jpeg';
                                        $PublicoMateriales->archivo = 'FILE-' . $PublicoMateriales->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoMateriales->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoMaterialesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoMateriales = PublicoMateriales::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoMateriales) {
                $this->response->setJsonContent($PublicoMateriales->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarPublicoMaterialesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoMateriales = PublicoMateriales::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoMateriales && $PublicoMateriales->estado = 'A') {

                //$PublicoMateriales->estado = 'X';
                //$PublicoMateriales->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_materiales", "codigo = {$PublicoMateriales->codigo}");
                $url_destino = 'adminpanel/archivos/publico/materiales/' . $PublicoMateriales->archivo;
                unlink($url_destino);

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

    //------------------------------------------fin materiales--------------------------------------------------------------


    //-----------------------------convocatorias2--------------------------------
    public function convocatorias2Action()
    {

        //echo "<pre>"; print_r($_SESSION);exit();

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->publico = $Publico->codigo;
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 2");
        $id_convocatoria = $convocatorias->id_convocatoria;
        //$convocatoria_m = Convocatorias::findFirst("activo = 'M'");
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $archivo_solicitud = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_solicitud <> ''",
            ]
        );

        //print("archivo_solicitud: ".$archivo_solicitud);exit();
        $this->view->count_archivo_solicitud = $archivo_solicitud;

        $archivo_silabo = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_silabo <> ''",
            ]
        );

        //print("archivo_silabo: ".$archivo_silabo);exit();
        $this->view->count_archivo_silabo = $archivo_silabo;

        $archivo_dni = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_dni <> ''",
            ]
        );

        //print("archivo_dj: ".$archivo_dni);exit();
        $this->view->count_archivo_dni = $archivo_dni;


        $archivo_dj = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_dj <> ''",
            ]
        );

        //print("archivo_dj: ".$archivo_dj);exit();
        $this->view->count_archivo_dj = $archivo_dj;

        $archivo_colegiatura = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_colegiatura <> ''",
            ]
        );

        // print("archivo_colegiatura: ".$archivo_colegiatura);exit();
        $this->view->count_archivo_colegiatura = $archivo_colegiatura;

        $archivo_habilitacion = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_habilitacion <> ''",
            ]
        );

        //print("archivo_habilitacion: ".$archivo_habilitacion);exit();
        $this->view->count_archivo_habilitacion = $archivo_habilitacion;

        $archivo_cti = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_cti <> ''",
            ]
        );

        //print("archivo_cti: ".$archivo_cti);exit();
        $this->view->count_archivo_cti = $archivo_cti;


        //Count PublicoFormacion
        $PublicoFormacion = PublicoFormacion::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_formacion = $PublicoFormacion;

        //Count PublicoCapacitaciones
        $PublicoCapacitaciones = PublicoCapacitaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_capacitaciones = $PublicoCapacitaciones;

        //Count PublicoExperiencia
        $PublicoExperiencia = PublicoExperiencia::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_experiencia = $PublicoExperiencia;

        //Count PublicoPublicaciones
        $PublicoPublicaciones = PublicoPublicaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_publicaciones = $PublicoPublicaciones;

        //Count PublicoCargos
        $PublicoCargos = PublicoCargos::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_cargos = $PublicoCargos;

        //Count PublicoMateriales
        $PublicoMateriales = PublicoMateriales::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_materiales = $PublicoMateriales;

        //Count PublicoIdiomas
        $PublicoIdiomas = PublicoIdiomas::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_idiomas = $PublicoIdiomas;

        //Count PublicoAsesorias
        $PublicoAsesorias = PublicoAsesorias::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_asesorias = $PublicoAsesorias;

        //Count PublicoExtension
        $PublicoExtension = PublicoExtension::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_extension = $PublicoExtension;


        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.convocatorias2.js?v" . uniqid());
    }
    public function convocatorias3Action()
    {

        //echo "<pre>"; print_r($_SESSION);exit();
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->publico = $Publico->codigo;
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 3");
        $id_convocatoria = $convocatorias->id_convocatoria;
        //$convocatoria_m = Convocatorias::findFirst("activo = 'M'");
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $archivo_solicitud = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_solicitud <> ''",
            ]
        );

        //print("archivo_solicitud: ".$archivo_solicitud);exit();
        $this->view->count_archivo_solicitud = $archivo_solicitud;


        $archivo_datos_generales_anexo_01 = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_solicitud <> ''  ",
            ]
        );
        $this->view->count_datos_generales_anexo_01 = $archivo_datos_generales_anexo_01;

        $archivo_datos_generales_anexo_02 = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND   archivo_dj <> '' ",
            ]
        );
        $this->view->count_datos_generales_anexo_02 = $archivo_datos_generales_anexo_02;

        $archivo_datos_generales_dni = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_dni <> ''  ",
            ]
        );
        $this->view->count_datos_generales_dni = $archivo_datos_generales_dni;


        $archivo_silabo = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_silabo <> '' ",
            ]
        );

        //print("archivo_silabo: ".$archivo_silabo);exit();
        $this->view->count_archivo_silabo = $archivo_silabo;

        $archivo_dni = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_dni <> ''",
            ]
        );

        //print("archivo_dj: ".$archivo_dni);exit();
        $this->view->count_archivo_dni = $archivo_dni;


        $archivo_dj = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_dj <> ''",
            ]
        );

        //print("archivo_dj: ".$archivo_dj);exit();
        $this->view->count_archivo_dj = $archivo_dj;

        $archivo_colegiatura = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_colegiatura <> ''",
            ]
        );

        // print("archivo_colegiatura: ".$archivo_colegiatura);exit();
        $this->view->count_archivo_colegiatura = $archivo_colegiatura;

        $archivo_habilitacion = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_habilitacion <> ''",
            ]
        );

        //print("archivo_habilitacion: ".$archivo_habilitacion);exit();
        $this->view->count_archivo_habilitacion = $archivo_habilitacion;

        $archivo_cti = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_cti <> ''",
            ]
        );

        //print("archivo_cti: ".$archivo_cti);exit();
        $this->view->count_archivo_cti = $archivo_cti;


        //Count PublicoFormacion
        $PublicoFormacion = PublicoFormacion::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_formacion = $PublicoFormacion;

        //Count PublicoCapacitaciones
        $PublicoCapacitaciones = PublicoCapacitaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_capacitaciones = $PublicoCapacitaciones;

        //Count PublicoExperiencia
        $PublicoExperiencia = PublicoExperiencia::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_experiencia = $PublicoExperiencia;

        //Count PublicoPublicaciones
        $PublicoPublicaciones = PublicoPublicaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_publicaciones = $PublicoPublicaciones;

        //Count PublicoCargos
        $PublicoCargos = PublicoCargos::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_cargos = $PublicoCargos;

        //Count PublicoMateriales
        $PublicoMateriales = PublicoMateriales::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_materiales = $PublicoMateriales;

        //Count PublicoIdiomas
        $PublicoIdiomas = PublicoIdiomas::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_idiomas = $PublicoIdiomas;

        //Count PublicoAsesorias
        $PublicoAsesorias = PublicoAsesorias::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_asesorias = $PublicoAsesorias;

        $PublicoPublicaciones = PublicoPublicaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_publicaciones = $PublicoPublicaciones;

        $PublicoReconocimientos = PublicoReconocimientos::count(
            [
                "id_publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_reconocimientos = $PublicoReconocimientos;
        

        
        //Count PublicoExtension
        $PublicoExtension = PublicoExtension::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_extension = $PublicoExtension;


        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.convocatorias3.js?v" . uniqid());
    }
    public function datatableConvocatorias3Action()
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto,convocatorias_perfiles.fecha_inicio, convocatorias_perfiles.fecha_fin, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo");
            $datatable->setFrom("tbl_web_convocatorias convocatorias INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria");
            $datatable->setWhere("convocatorias.etapa = 1 AND convocatorias.tipo = 3");
            $datatable->setOrderby("convocatorias_perfiles.nombre_corto");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    public function datatableConvocatorias2Action()
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto,convocatorias_perfiles.fecha_inicio, convocatorias_perfiles.fecha_fin, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo");
            $datatable->setFrom("tbl_web_convocatorias convocatorias INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria");
            $datatable->setWhere("convocatorias.etapa = 1 AND convocatorias.tipo = 2");
            $datatable->setOrderby("convocatorias_perfiles.nombre_corto");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    public function verificarConvocatoria3Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $convocatoria = (int) $this->request->getPost("convocatoria", "int");
            $publico = (int) $this->request->getPost("publico", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria AND publico = $publico",
                ]
            );

            if ($ConvocatoriasPublico->perfil == null || $ConvocatoriasPublico->perfil == "") {

                // echo '<pre>';
                // print_r("llega");
                // exit();

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
    public function verificarConvocatoria2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $convocatoria = (int) $this->request->getPost("convocatoria", "int");
            $publico = (int) $this->request->getPost("publico", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria AND publico = $publico",
                ]
            );

            if ($ConvocatoriasPublico->perfil == null || $ConvocatoriasPublico->perfil == "") {

                // echo '<pre>';
                // print_r("llega");
                // exit();

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


    public function saveConvocatorias2Action()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //perfil
                $id_publico = (int)$this->request->getPost("id_publico", "int");

                $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 2");
                $id_convocatoria = $convocatorias->id_convocatoria;

                // print($id_publico);
                // exit();

               /* if($id_publico==4096){
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                }*/

                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");

                // print($ConvocatoriasPublico->convocatoria);
                // exit();

                $ConvocatoriasPublico->perfil = $this->request->getPost("id_perfil", "int");

                $ConvocatoriasPublico->fecha = date('Y-m-d H:i:s');

                $ConvocatoriasPublico->estado = 1;

                $ConvocatoriasPublico->proceso = 0;

                //campos para email
                $convocatorias_titular = $this->request->getPost("convocatorias_titular", "string");
                $convocatoria_perfiles_codigo = $this->request->getPost("convocatoria_perfiles_codigo", "string");
                $convocatoria_perfiles_nombre = $this->request->getPost("convocatoria_perfiles_nombre", "string");
                $convocatoria_perfiles_nombre_corto = $this->request->getPost("convocatoria_perfiles_nombre_corto", "string");

                if ($ConvocatoriasPublico->save() == false) {

                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    $temporal_rand = mt_rand(100000, 999999);
                    $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                    $fecha_format = explode("-", $ConvocatoriasPublico->fecha);
                    $fecha_format_resultado = $fecha_format[2] . "/" . $fecha_format[1] . "/" . $fecha_format[0];

                    $email_destEmail = $this->config->mail->destEmailcv;
                    $text_body = "{$this->config->global->xCiudadIns}, $fecha_format_resultado" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "SOLICITUD DE POSTULACIÓN" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Señores:" . '<br>';
                    $text_body .= "COMITÉ DE EVALUACIÓN DEL {$convocatorias_titular}" . '<br>';
                    $text_body .= "{$this->config->global->xNombreIns}" . '<br>';
                    $text_body .= "Presente." . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Yo, {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}, identificado (a)con DNI N° {$Publico->nro_doc}, con correo electrónico {$Publico->email}, me presento ante ustedes, para exponerle:" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Que, deseo postular a la plaza de {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}. del proceso de $convocatorias_titular, cumpliendo con los requisitos solicitados en el perfil del cargo al cual postulo, para cuyo efecto registré los documentos solicitados en la plataforma virtual de Gestión de Convocatorias para la evaluación correspondiente" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Atentamente." . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "{$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}" . '<br>';

                    //
                    $from = $this->config->mail->from;
                    $mailer = new mailer($this->di);
                    $mailer->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                    $mailer->setFrom($from);
                    $mailer->setTo($email_destEmail, $from);
                    $mailer->setBody($text_body);
                    //

                    if ($mailer->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    // Enviando Email al Usuario

                    $email_usuario = $Publico->email;
                    $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Ud. se ha registrado satisfactoriamente a la $convocatorias_titular , la plaza: {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Atentamente" . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "La comisión del concurso.";
                    $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Ud. se ha registrado satisfactoriamente a la $convocatorias_titular , la plaza: {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Atentamente" . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "La comisión del concurso.";

                    $from2 = $this->config->mail->from;
                    $mailer_u = new mailer($this->di);
                    $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                    $mailer_u->setFrom($from2);
                    $mailer_u->setTo($email_usuario, $from2);
                    $mailer_u->setBody($text_body2);
                    //
                    if ($mailer_u->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
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
    public function saveConvocatorias3Action()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();
        ini_set('display_errors', 1);

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                print($this->session->get("auth")["codigo"]);
                //perfil
                $id_publico = (int)$this->request->getPost("id_publico", "int");

                $convocatorias = Convocatorias::findFirst(["estado = 'A' and etapa = 1 and tipo = 3"]);
                $id_convocatoria = $convocatorias->id_convocatoria;


                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");
                // exit();
                $ConvocatoriasPublico->convocatoria = $id_convocatoria;
                $ConvocatoriasPublico->publico = $id_publico;
                $ConvocatoriasPublico->perfil = $this->request->getPost("id_perfil", "int");

                $ConvocatoriasPublico->fecha = date('Y-m-d H:i:s');

                $ConvocatoriasPublico->estado = 1;

                $ConvocatoriasPublico->proceso = 0;

                //campos para email
                $convocatorias_titular = $this->request->getPost("convocatorias_titular", "string");
                $convocatoria_perfiles_codigo = $this->request->getPost("convocatoria_perfiles_codigo", "string");
                $convocatoria_perfiles_nombre = $this->request->getPost("convocatoria_perfiles_nombre", "string");
                $convocatoria_perfiles_nombre_corto = $this->request->getPost("convocatoria_perfiles_nombre_corto", "string");

                if ($ConvocatoriasPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    $temporal_rand = mt_rand(100000, 999999);
                    $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                    $fecha_format = explode("-", $ConvocatoriasPublico->fecha);
                    $fecha_format_resultado = $fecha_format[2] . "/" . $fecha_format[1] . "/" . $fecha_format[0];

                    $email_destEmail = $this->config->mail->destEmailcv;
                    $text_body = "{$this->config->global->xCiudadIns}, $fecha_format_resultado" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "SOLICITUD DE POSTULACIÓN" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Señores:" . '<br>';
                    $text_body .= "COMITÉ DE EVALUACIÓN DEL {$convocatorias_titular}" . '<br>';
                    $text_body .= "{$this->config->global->xNombreIns}" . '<br>';
                    $text_body .= "Presente." . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Yo, {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}, identificado (a)con DNI N° {$Publico->nro_doc}, con correo electrónico {$Publico->email}, me presento ante ustedes, para exponerle:" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Que, deseo postular a la plaza de {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}. del proceso de $convocatorias_titular, cumpliendo con los requisitos solicitados en el perfil del cargo al cual postulo, para cuyo efecto registré los documentos solicitados en la plataforma virtual de Gestión de Convocatorias para la evaluación correspondiente" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Atentamente." . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "{$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}" . '<br>';

                    //
                    $from = $this->config->mail->from;
                    $mailer = new mailer($this->di);
                    $mailer->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                    $mailer->setFrom($from);
                    $mailer->setTo($email_destEmail, $from);
                    $mailer->setBody($text_body);
                    //

                    if ($mailer->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    // Enviando Email al Usuario

                    $email_usuario = $Publico->email;
                    $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Ud. se ha registrado satisfactoriamente a la $convocatorias_titular , la plaza: {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Atentamente" . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "La comisión del concurso.";
                    $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Ud. se ha registrado satisfactoriamente a la $convocatorias_titular , la plaza: {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Atentamente" . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "La comisión del concurso.";

                    $from2 = $this->config->mail->from;
                    $mailer_u = new mailer($this->di);
                    $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                    $mailer_u->setFrom($from2);
                    $mailer_u->setTo($email_usuario, $from2);
                    $mailer_u->setBody($text_body2);
                    //
                    if ($mailer_u->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
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




    public function descargas2Action()
    {
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 2");
        $id_convocatoria = $convocatorias->id_convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.descargas2.js?v" . uniqid());
    }

    public function datatableDescargas2Action()
    {
        $publico = $this->session->get("auth")["codigo"];
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 2");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_convocatoria_descarga");
            $datatable->setSelect("id_convocatoria_descarga,id_convocatoria,titulo,fecha_hora, archivo, estado, imagen,enlace");
            $datatable->setFrom("(SELECT
            public.tbl_web_convocatorias_descargas.titulo,
            to_char(public.tbl_web_convocatorias_descargas.fecha_hora, 'DD/MM/YYYY') AS fecha_hora,
            public.tbl_web_convocatorias_descargas.estado,
            public.tbl_web_convocatorias_descargas.id_convocatoria_descarga,
            public.tbl_web_convocatorias_descargas.id_convocatoria,
            public.tbl_web_convocatorias_descargas.archivo,
            public.tbl_web_convocatorias_descargas.imagen,
            public.tbl_web_convocatorias_descargas.enlace
            FROM
            public.tbl_web_convocatorias_descargas
            INNER JOIN public.tbl_web_convocatorias ON public.tbl_web_convocatorias.id_convocatoria = public.tbl_web_convocatorias_descargas.id_convocatoria
            WHERE public.tbl_web_convocatorias.id_convocatoria = $id_convocatoria) AS temporal_table");
            $datatable->setOrderby("id_convocatoria_descarga DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function descargas3Action()
    {
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 3");
        $id_convocatoria = $convocatorias->id_convocatoria;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.descargas3.js?v" . uniqid());
    }

    public function datatableDescargas3Action()
    {
        $publico = $this->session->get("auth")["codigo"];
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 3");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_convocatoria_descarga");
            $datatable->setSelect("id_convocatoria_descarga,id_convocatoria,titulo,fecha_hora, archivo, estado, imagen,enlace");
            $datatable->setFrom("(SELECT
            public.tbl_web_convocatorias_descargas.titulo,
            to_char(public.tbl_web_convocatorias_descargas.fecha_hora, 'DD/MM/YYYY') AS fecha_hora,
            public.tbl_web_convocatorias_descargas.estado,
            public.tbl_web_convocatorias_descargas.id_convocatoria_descarga,
            public.tbl_web_convocatorias_descargas.id_convocatoria,
            public.tbl_web_convocatorias_descargas.archivo,
            public.tbl_web_convocatorias_descargas.imagen,
            public.tbl_web_convocatorias_descargas.enlace
            FROM
            public.tbl_web_convocatorias_descargas
            INNER JOIN public.tbl_web_convocatorias ON public.tbl_web_convocatorias.id_convocatoria = public.tbl_web_convocatorias_descargas.id_convocatoria
            WHERE public.tbl_web_convocatorias.id_convocatoria = $id_convocatoria) AS temporal_table");
            $datatable->setOrderby("id_convocatoria_descarga DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function descargas4Action()
    {
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 4");
        #print_r($convocatorias);
        #exit;
        $id_convocatoria = $convocatorias->id_convocatoria;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.descargas4.js?v" . uniqid());
    }

    public function datatableDescargas4Action()
    {
        $publico = $this->session->get("auth")["codigo"];
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 4");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_convocatoria_descarga");
            $datatable->setSelect("id_convocatoria_descarga,id_convocatoria,titulo,fecha_hora, archivo, estado, imagen,enlace");
            $datatable->setFrom("(SELECT
            public.tbl_web_convocatorias_descargas.titulo,
            to_char(public.tbl_web_convocatorias_descargas.fecha_hora, 'DD/MM/YYYY') AS fecha_hora,
            public.tbl_web_convocatorias_descargas.estado,
            public.tbl_web_convocatorias_descargas.id_convocatoria_descarga,
            public.tbl_web_convocatorias_descargas.id_convocatoria,
            public.tbl_web_convocatorias_descargas.archivo,
            public.tbl_web_convocatorias_descargas.imagen,
            public.tbl_web_convocatorias_descargas.enlace
            FROM
            public.tbl_web_convocatorias_descargas
            INNER JOIN public.tbl_web_convocatorias ON public.tbl_web_convocatorias.id_convocatoria = public.tbl_web_convocatorias_descargas.id_convocatoria
            WHERE public.tbl_web_convocatorias.id_convocatoria = $id_convocatoria) AS temporal_table");
           # print_r($datatable);
            $datatable->setOrderby("titulo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getDatos2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = Publico::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getBonificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $obj = Publico::findFirstBycodigo((int) $this->request->getPost("id", "int"));

            if ($obj) {

                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function plandeclasesAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.colegiatura2.js?v" . uniqid());
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 2 and etapa = 1");
        $id_convocatoria =  $convocatoria->id_convocatoria;
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }
        $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("nro_doc = '$nro_doc' AND convocatoria = $id_convocatoria");
        $this->view->cp = $ConvocatoriasPublico;
    }

    public function savePlandeclasesAction()
    {

        // echo '<pre>';
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = $this->session->get("auth")["codigo"];
                $Publico = Publico::findFirst("codigo = $id_publico");

                $convocatoria = Convocatorias::findFirst("activo = 'M'");
                $id_convocatoria =  $convocatoria->id_convocatoria;


                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");


                if ($ConvocatoriasPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "archivo_plan") {
                                if ($_FILES['archivo_plan']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_plan']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_plan)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_plan;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/PLN-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_plan = 'PLN-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/PLN-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_plan = 'PLN-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    public function datosgenerales2Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.datosgenerales2.js?v" . uniqid());
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 2 and etapa = 1");
        $id_convocatoria =  $convocatoria->id_convocatoria;
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }
        $this->view->id_convocatoria = $id_convocatoria;

        $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("nro_doc = '$nro_doc' AND convocatoria = $id_convocatoria");
        /*if($id_publico==4096){
            print_r($ConvocatoriasPublico);
            exit;
        }*/
        $this->view->cp = $ConvocatoriasPublico;
    }

    public function saveDatosGenerales2Action()
    {



        // echo '<pre>';
        // print_r($_POST);
        // exit();
        ini_set('display_errors', 1);
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = $this->session->get("auth")["codigo"];

                $Publico = Publico::findFirst("codigo = $id_publico");

                // $convocatoria = Convocatorias::findFirst("activo = 'M'");
                // $id_convocatoria =  $convocatoria->id_convocatoria;

                $id_convocatoria = $this->request->getPost("id_convocatoria", "int");


                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");


                if ($ConvocatoriasPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);


                            if ($file->getKey() == "archivo_solicitud") {
                                if ($_FILES['archivo_solicitud']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_solicitud']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_solicitud)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_solicitud;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_solicitud = 'ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_solicitud = 'ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }


                            if ($file->getKey() == "archivo_dni") {
                                if ($_FILES['archivo_dni']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_dni']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_dni)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_dni;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dni = 'DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dni = 'DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }



                            if ($file->getKey() == "archivo_dni") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Publico->archivo)) {

                                        $url_destino = 'adminpanel/archivos/personales/' . $Publico->archivo_ruc;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/personales/FILE-DNI-' . $Publico->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $Publico->archivo_ruc = 'FILE-DNI' . '-' . $Publico->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/personales/FILE-DNI-' . $Publico->nro_doc . '.pdf';

                                        $Publico->archivo_ruc = 'FILE-DNI-' . $Publico->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }

                            $Publico->save();



                            if ($file->getKey() == "archivo_silabo") {
                                if ($_FILES['archivo_silabo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_silabo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_silabo)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_silabo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_silabo = 'SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_silabo = 'SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_dj") {
                                if ($_FILES['archivo_dj']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_dj']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_dj)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_dj;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dj = 'ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dj = 'ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    public function colegiatura2Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.colegiatura2.js?v" . uniqid());
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 2 and etapa = 1");
        $id_convocatoria =  $convocatoria->id_convocatoria;
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }
        $this->view->id_convocatoria = $id_convocatoria;
        $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("nro_doc = '$nro_doc' AND convocatoria = $id_convocatoria");
        $this->view->cp = $ConvocatoriasPublico;
    }

    public function saveColegiatura2Action()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = $this->session->get("auth")["codigo"];
                $Publico = Publico::findFirst("codigo = $id_publico");

                $id_convocatoria = $this->request->getPost("id_convocatoria", "int");


                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");


                if ($ConvocatoriasPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "archivo_colegiatura") {
                                if ($_FILES['archivo_colegiatura']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_colegiatura']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_colegiatura)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_colegiatura;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/COL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_colegiatura = 'COL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/COL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_colegiatura = 'COL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }


                            if ($file->getKey() == "archivo_habilitacion") {
                                if ($_FILES['archivo_habilitacion']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_habilitacion']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_habilitacion)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_habilitacion;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/HAB-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_habilitacion = 'HAB-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/HAB-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_habilitacion = 'HAB-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_cti") {
                                if ($_FILES['archivo_cti']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_cti']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_cti)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_cti;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/CTI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_cti = 'CTI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/CTI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_cti = 'CTI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    public function datosgenerales3Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.datosgenerales3.js?v" . uniqid());
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 3 and etapa = 1");
        $id_convocatoria =  $convocatoria->id_convocatoria;
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }
        $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");
        $this->view->cp = $ConvocatoriasPublico;
    }

    public function saveDatosGenerales3Action()
    {

        // echo '<pre>';
        // print_r($_FILES);
        // exit();
        //ini_set('display_errors',1);
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = $this->session->get("auth")["codigo"];
                $nro_doc = $this->session->get("auth")["nro_doc"];
                $Publico = Publico::findFirst("codigo = $id_publico");

                $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 3 and etapa = 1");
                $id_convocatoria =  $convocatoria->id_convocatoria;
                if ($id_convocatoria == "") {
                    $id_convocatoria = 0;
                }
                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $id_convocatoria");

                if ($ConvocatoriasPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);


                            if ($file->getKey() == "archivo_solicitud") {
                                if ($_FILES['archivo_solicitud']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_solicitud']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_solicitud)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_solicitud;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_solicitud = 'ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX3' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_solicitud = 'ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }


                            if ($file->getKey() == "archivo_dni") {
                                if ($_FILES['archivo_dni']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_dni']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_dni)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_dni;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dni = 'DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dni = 'DNI-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }



                            if ($file->getKey() == "archivo_dni") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Publico->archivo)) {

                                        $url_destino = 'adminpanel/archivos/personales/' . $Publico->archivo_ruc;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/personales/FILE-DNI-' . $Publico->nro_doc . '-' . $temporal_rand . '.pdf';

                                        $Publico->archivo_ruc = 'FILE-DNI' . '-' . $Publico->nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/personales/FILE-DNI-' . $Publico->nro_doc . '.pdf';

                                        $Publico->archivo_ruc = 'FILE-DNI-' . $Publico->nro_doc . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }

                            $Publico->save();

                            if ($file->getKey() == "archivo_silabo") {
                                if ($_FILES['archivo_silabo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_silabo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_silabo)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_silabo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_silabo = 'SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_silabo = 'SIL-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                            if ($file->getKey() == "archivo_dj") {
                                if ($_FILES['archivo_dj']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_dj']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_dj)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_dj;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dj = 'ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_dj = 'ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    public function datosgenerales4Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.datosgenerales4.js?v" . uniqid());
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 4 and etapa = 1");
        $id_convocatoria =  $convocatoria->id_convocatoria;
        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }
        $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND nro_doc = '$nro_doc' AND convocatoria = $id_convocatoria");
        $this->view->cp = $ConvocatoriasPublico;
    }

    public function saveDatosGenerales4Action()
    {

        //  echo '<pre>';
        //  print_r($_FILES);
        //  exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id_publico = $this->session->get("auth")["codigo"];
                $nro_doc = $this->session->get("auth")["nro_doc"];
                $Publico = Docentes::findFirst("codigo = $id_publico");


                $convocatoria = Convocatorias::findFirst("estado = 'A' and tipo = 4 and etapa = 1");
                $id_convocatoria =  $convocatoria->id_convocatoria;

                //echo '<pre>';
                //print_r("nrodoc: ".$nro_doc." "."id_convocatoria: ".$id_convocatoria);
                //print_r("ConvocatoriasPublico: ".$ConvocatoriasPublico->codigo);
                //exit();

                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("nro_doc = '$nro_doc' AND convocatoria = $id_convocatoria");
                $ConvocatoriasPublico = (!$ConvocatoriasPublico) ? new ConvocatoriasDocentes() : $ConvocatoriasPublico;

                $ConvocatoriasPublico->nro_doc = $nro_doc;
                $ConvocatoriasPublico->convocatoria = $id_convocatoria;
                $ConvocatoriasPublico->publico = $id_publico;
                $ConvocatoriasPublico->estado = "1";


                //echo '<pre>';
                //print_r("nrodoc: ".$nro_doc." "."id_convocatoria: ".$id_convocatoria);
                //print_r("ConvocatoriasPublico: ".$ConvocatoriasPublico->codigo);
                //exit();


                if ($ConvocatoriasPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);


                            if ($file->getKey() == "archivo_solicitud") {
                                if ($_FILES['archivo_solicitud']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_solicitud']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_solicitud)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_solicitud;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX1-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_solicitud = 'ANX1-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX1-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_solicitud = 'ANX1-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }




                            if ($file->getKey() == "archivo_proyecto") {
                                if ($_FILES['archivo_proyecto']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_proyecto']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->archivo_proyecto)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->archivo_proyecto;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->archivo_proyecto = 'ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->archivo_proyecto = 'ANX2-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "carta_cumplir") {
                                if ($_FILES['carta_cumplir']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['carta_cumplir']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->carta_cumplir)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->carta_cumplir;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->carta_cumplir = 'ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->carta_cumplir = 'ANX3-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "carta_presentar") {
                                if ($_FILES['carta_presentar']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['carta_presentar']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->carta_presentar)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->carta_presentar;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX4-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->carta_presentar = 'ANX4-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX4-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->carta_presentar = 'ANX4-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "carta_difundir") {
                                if ($_FILES['carta_difundir']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['carta_difundir']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->carta_difundir)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->carta_difundir;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX5-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->carta_difundir = 'ANX5-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX5-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->carta_difundir = 'ANX5-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "carta_ejecucion") {
                                if ($_FILES['carta_ejecucion']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['carta_ejecucion']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->carta_ejecucion)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->carta_ejecucion;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX6-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->carta_ejecucion = 'ANX6-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX6-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->carta_ejecucion = 'ANX6-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "reporte_similitud") {
                                if ($_FILES['reporte_similitud']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['reporte_similitud']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ConvocatoriasPublico->carta_ejecucion)) {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->carta_ejecucion;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/REPSIM-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                            $ConvocatoriasPublico->carta_ejecucion = 'ANX6-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "-" . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatorias_publico/REPSIM-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                            $ConvocatoriasPublico->carta_ejecucion = 'ANX6-' . $ConvocatoriasPublico->convocatoria . '-' . $Publico->nro_doc . "." . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    //-------------------------------------------------excepciones----------------------------------------------------------
    public function excepcionesAction()
    {

        $tipopublicaciones = TipoPublicaciones::find("estado = 'A' AND numero = 136 ORDER BY nombres ASC");
        $this->view->tipopublicaciones = $tipopublicaciones;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.excepciones.js?v" . uniqid());
    }


    public function datatableExcepcionesAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,id_tipo_excepcion,nombre,fecha_excepcion,institucion,archivo,imagen,estado,nro_doc,tipo_publicacion");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_excepciones.codigo,
            public.tbl_web_publico_excepciones.publico,
            public.tbl_web_publico_excepciones.id_tipo_excepcion,
            public.tbl_web_publico_excepciones.nombre,
            to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
            public.tbl_web_publico_excepciones.institucion,
            public.tbl_web_publico_excepciones.archivo,
            public.tbl_web_publico_excepciones.imagen,
            public.tbl_web_publico_excepciones.estado,
            public.tbl_web_publico_excepciones.nro_doc,
            tipodepublicaciones.nombres AS tipo_publicacion
            FROM
            public.tbl_web_publico_excepciones
            INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
            WHERE
            tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.nro_doc = '$nro_doc') AS temporal_table");
            $datatable->setOrderby("fecha_excepcion DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function saveExcepcionesAction()
    {

        //    echo '<pre>';
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoExcepciones = PublicoExcepciones::findFirstBycodigo($id);
                $PublicoExcepciones = (!$PublicoExcepciones) ? new PublicoExcepciones() : $PublicoExcepciones;


                if ($this->request->getPost("id_tipo_excepcion", "int") == "") {
                    $PublicoExcepciones->id_tipo_excepcion = null;
                } else {
                    $PublicoExcepciones->id_tipo_excepcion = $this->request->getPost("id_tipo_excepcion", "int");
                }


                $PublicoExcepciones->publico = $this->session->get("auth")["codigo"];

                $PublicoExcepciones->nombre = $this->request->getPost("nombre", "string");

                if ($this->request->getPost("fecha_excepcion", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_excepcion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoExcepciones->fecha_excepcion = date('Y-m-d', strtotime($fecha_new));
                }



                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoExcepciones->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoExcepciones->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                $PublicoExcepciones->estado = 'A';

                $PublicoExcepciones->institucion = $this->request->getPost("institucion", "string");


                //$Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoExcepciones->nro_doc = $this->session->get("auth")["nro_doc"];

                if ($PublicoExcepciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoExcepciones->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoExcepciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/' . $PublicoExcepciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/FILE-' . $PublicoExcepciones->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoExcepciones->archivo = 'FILE-' . $PublicoExcepciones->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/FILE-' . $PublicoExcepciones->codigo . '.pdf';
                                        $PublicoExcepciones->archivo = 'FILE-' . $PublicoExcepciones->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                //para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoExcepciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/' . $PublicoExcepciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/FILE-' . $PublicoExcepciones->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoExcepciones->archivo = 'FILE-' . $PublicoExcepciones->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/FILE-' . $PublicoExcepciones->codigo . '.jpg';
                                        $PublicoExcepciones->archivo = 'FILE-' . $PublicoExcepciones->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoExcepciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/' . $PublicoExcepciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/FILE-' . $PublicoExcepciones->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoExcepciones->archivo = 'FILE-' . $PublicoExcepciones->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/excepciones/FILE-' . $PublicoExcepciones->codigo . '.jpeg';
                                        $PublicoExcepciones->archivo = 'FILE-' . $PublicoExcepciones->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PublicoExcepciones->save();
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

    //getAjaxFormacion
    public function getAjaxPublicoExcepcionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {


            //    echo '<pre>';
            //    print_r($_POST);
            //    exit();


            $PublicoExcepciones = PublicoExcepciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExcepciones) {
                $this->response->setJsonContent($PublicoExcepciones->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarPublicoExcepcionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExcepciones = PublicoExcepciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExcepciones && $PublicoExcepciones->estado = 'A') {

                //$PublicoExcepciones->estado = 'X';
                //$PublicoExcepciones->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_excepciones", "codigo = {$PublicoExcepciones->codigo}");
                $url_destino = 'adminpanel/archivos/publico/excepciones/' . $PublicoExcepciones->archivo;
                unlink($url_destino);

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

    //------------------------------------------fin excepciones--------------------------------------------------------------


    //--------------------------------------------reconocimientos------------------------------------------------------------
    public function reconocimientosAction()
    {
        $publico = Publico::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->publico = $publico;

        $tiporeconocimientos = TipoReconocimientos::find("estado = 'A' AND numero = 137 ORDER BY nombres ASC");
        $this->view->tiporeconocimientos = $tiporeconocimientos;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.reconocimientos.js?v" . uniqid());
    }

    //datatableExperiencia
    public function datatableReconocimientoAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,nombre,institucion,fecha_reconocimiento,pais,archivo,imagen,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_reconocimientos.codigo,
            CONCAT (public.publico.apellidop, ' ',public.publico.apellidom, ' ',public.publico.nombres) AS publico,
            public.tbl_web_publico_reconocimientos.nombre,
            public.tbl_web_publico_reconocimientos.institucion,
            to_char(public.tbl_web_publico_reconocimientos.fecha_reconocimiento, 'DD/MM/YYYY') AS fecha_reconocimiento,
            public.tbl_web_publico_reconocimientos.pais,
            public.tbl_web_publico_reconocimientos.archivo,
            public.tbl_web_publico_reconocimientos.imagen,
            public.tbl_web_publico_reconocimientos.estado,
            tipo_reconocimientos.nombres AS tipo_reconocimiento
            FROM
            public.tbl_web_publico_reconocimientos
            INNER JOIN public.a_codigos AS tipo_reconocimientos ON tipo_reconocimientos.codigo = public.tbl_web_publico_reconocimientos.id_tipo_reconocimiento
            INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_publico_reconocimientos.id_publico
            WHERE
            tipo_reconocimientos.numero = 137 AND public.tbl_web_publico_reconocimientos.id_publico = $publico) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("codigo DESC");
            $datatable->getJson();
        }
    }

    //saveReconocimiento
    public function saveReconocimientosAction()
    {
        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoReconocimiento = PublicoReconocimientos::findFirstBycodigo($id);
                $id_publico = $this->session->get("auth")["codigo"];

                //Valida cuando es nuevo
                $PublicoReconocimiento = (!$PublicoReconocimiento) ? new PublicoReconocimientos() : $PublicoReconocimiento;

                $PublicoReconocimiento->codigo = $this->request->getPost("codigo", "int");


                $PublicoReconocimiento->id_publico = $id_publico;

                if ($this->request->getPost("id_tipo_reconocimiento", "int") == "") {
                    $PublicoReconocimiento->id_tipo_reconocimiento = null;
                } else {
                    $PublicoReconocimiento->id_tipo_reconocimiento = $this->request->getPost("id_tipo_reconocimiento", "int");
                }

                $PublicoReconocimiento->nombre = $this->request->getPost("nombre", "string");
                $PublicoReconocimiento->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("fecha_reconocimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_reconocimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoReconocimiento->fecha_reconocimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoReconocimiento->pais = $this->request->getPost("pais", "string");
                $PublicoReconocimiento->estado = "A";



                if ($PublicoReconocimiento->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoReconocimiento->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_publicoreconocimiento") {

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoReconocimiento->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/publico/reconocimientos/' . $PublicoReconocimiento->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/reconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/reconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '.jpg';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($PublicoReconocimiento->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/publico/reconocimientos/' . $PublicoReconocimiento->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publico/reconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.png';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publico/reconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '.png';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . ".png";
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
                            if ($file->getKey() == "archivo_reconocimientos") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PublicoReconocimiento->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/reconocimientos/' . $PublicoReconocimiento->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/reconocimientos/' . 'FILE' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoReconocimiento->archivo = 'FILE' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/reconocimientos/' . 'FILE' . '-' . $PublicoReconocimiento->codigo . '.pdf';
                                        $PublicoReconocimiento->archivo = 'FILE' . '-' . $PublicoReconocimiento->codigo . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $PublicoReconocimiento->save();
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

    //getAjaxPublicoReconocimientos
    public function getAjaxPublicoReconocimientosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExperiencia = PublicoReconocimientos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExperiencia) {
                $this->response->setJsonContent($PublicoExperiencia->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //eliminarPublicoReconocimientos
    public function eliminarPublicoReconocimientosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoReconocimientos = PublicoReconocimientos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoReconocimientos && $PublicoReconocimientos->estado = 'A') {

                //$PublicoExperiencia->estado = 'X';
                //$PublicoExperiencia->save();

                //delete fisico y delete de archivo
                $this->db->delete("tbl_web_publico_reconocimientos", "codigo = {$PublicoReconocimientos->codigo}");
                $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoReconocimientos->archivo;
                unlink($url_destino);

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

    //-----------------------------convocatorias4--------------------------------
    public function convocatorias4Action()
    {

        //echo "<pre>"; print_r($_SESSION);exit();

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->publico = $Publico->codigo;
        $convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 4");
        $id_convocatoria = $convocatorias->id_convocatoria;

        if ($id_convocatoria == "") {
            $id_convocatoria = 0;
        }

        $archivo_solicitud = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_solicitud <> ''",
            ]
        );

        //print("archivo_solicitud: ".$archivo_solicitud);exit();
        $this->view->count_archivo_solicitud = $archivo_solicitud;

        $archivo_proyecto = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND archivo_proyecto <> ''",
            ]
        );

        $this->view->count_archivo_proyecto = $archivo_proyecto;

        $carta_cumplir = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND carta_cumplir <> ''",
            ]
        );

        $this->view->count_carta_cumplir = $carta_cumplir;

        $carta_presentar = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND carta_presentar <> ''",
            ]
        );

        $this->view->count_carta_presentar = $carta_presentar;

        $carta_difundir = ConvocatoriasPublico::count(
            [
                "publico = $Publico->codigo AND convocatoria = $id_convocatoria AND carta_difundir <> ''",
            ]
        );

        $this->view->count_carta_difundir = $carta_difundir;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.convocatorias4.js?v" . uniqid());
    }

    public function datatableConvocatorias4Action()
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto,convocatorias_perfiles.fecha_inicio, convocatorias_perfiles.fecha_fin, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo");
            $datatable->setFrom("tbl_web_convocatorias convocatorias INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria");
            $datatable->setWhere("convocatorias.etapa = 1 AND convocatorias.tipo = 4");
            $datatable->setOrderby("convocatorias_perfiles.nombre_corto");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function verificarConvocatoria4Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $convocatoria = (int) $this->request->getPost("convocatoria", "int");
            $publico = (int) $this->request->getPost("publico", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria AND publico = $publico",
                ]
            );

            if ($ConvocatoriasPublico->perfil == null || $ConvocatoriasPublico->perfil == "") {

                // echo '<pre>';
                // print_r("llega");
                // exit();

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


    public function saveConvocatorias4Action()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //perfil
                $id_publico = (int)$this->request->getPost("id_publico", "int");

                $Convocatorias = Convocatorias::findFirst("estado = 'A' and etapa = 1 and tipo = 4");

                // print($id_publico);
                // exit();

                $ConvocatoriasPublico = ConvocatoriasDocentes::findFirst("publico = $id_publico AND convocatoria = $Convocatorias->id_convocatoria");

                // print($ConvocatoriasPublico->convocatoria);
                // exit();

                $ConvocatoriasPublico->perfil = $this->request->getPost("id_perfil", "int");

                $ConvocatoriasPublico->fecha = date('Y-m-d H:i:s');

                $ConvocatoriasPublico->estado = 1;

                $ConvocatoriasPublico->proceso = 0;

                //campos para email
                $convocatorias_titular = $this->request->getPost("convocatorias_titular", "string");
                $convocatoria_perfiles_codigo = $this->request->getPost("convocatoria_perfiles_codigo", "string");
                $convocatoria_perfiles_nombre = $this->request->getPost("convocatoria_perfiles_nombre", "string");
                $convocatoria_perfiles_nombre_corto = $this->request->getPost("convocatoria_perfiles_nombre_corto", "string");

                if ($ConvocatoriasPublico->save() == false) {

                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    $temporal_rand = mt_rand(100000, 999999);
                    $Publico = Docentes::findFirstBycodigo($this->session->get("auth")["codigo"]);
                    $fecha_format = explode("-", $ConvocatoriasPublico->fecha);
                    $fecha_format_resultado = $fecha_format[2] . "/" . $fecha_format[1] . "/" . $fecha_format[0];

                    $email_destEmail = $this->config->mail->destEmailcv;
                    $text_body = "{$this->config->global->xCiudadIns}, $fecha_format_resultado" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "SOLICITUD DE POSTULACIÓN" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Señores:" . '<br>';
                    $text_body .= "COMITÉ DE EVALUACIÓN DEL {$convocatorias_titular}" . '<br>';
                    $text_body .= "{$this->config->global->xNombreIns}" . '<br>';
                    $text_body .= "Presente." . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Yo, {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}, identificado (a)con DNI N° {$Publico->nro_doc}, con correo electrónico {$Publico->email}, me presento ante ustedes, para exponerle:" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Que, deseo postular a la plaza de {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}. del proceso de $convocatorias_titular, cumpliendo con los requisitos solicitados en el perfil del cargo al cual postulo, para cuyo efecto registré los documentos solicitados en la plataforma virtual de Gestión de Convocatorias para la evaluación correspondiente" . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "Atentamente." . '<br>';
                    $text_body .= "" . '<br>';
                    $text_body .= "{$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}" . '<br>';

                    //
                    $from = $this->config->mail->from;
                    $mailer = new mailer($this->di);
                    $mailer->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                    $mailer->setFrom($from);
                    $mailer->setTo($email_destEmail, $from);
                    $mailer->setBody($text_body);
                    //

                    if ($mailer->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
                    }

                    // Enviando Email al Usuario

                    $email_usuario = $Publico->email1;
                    $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Ud. se ha registrado satisfactoriamente a la $convocatorias_titular , la plaza: {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Atentamente" . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "La comisión del concurso.";
                    $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Ud. se ha registrado satisfactoriamente a la $convocatorias_titular , la plaza: {$convocatoria_perfiles_nombre} - {$convocatoria_perfiles_nombre_corto}." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "Atentamente" . '<br>';
                    $text_body2 .= "" . '<br>';
                    $text_body2 .= "La comisión del concurso.";

                    $from2 = $this->config->mail->from;
                    $mailer_u = new mailer($this->di);
                    $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                    $mailer_u->setFrom($from2);
                    $mailer_u->setTo($email_usuario, $from2);
                    $mailer_u->setBody($text_body2);
                    //
                    if ($mailer_u->send()) {
                        //return true;
                    } else {
                        echo $mailer->getError();
                        echo "error";
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

    public function postulaciones4Action()
    {

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.postulaciones4.js?v" . uniqid());
    }

    public function datatablepostulaciones4Action()
    {
        $publico = $this->session->get("auth")["codigo"];
        $nro_doc = $this->session->get("auth")["nro_doc"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo, "
                . "convocatorias_publico.fecha, convocatorias_publico.anexos");
            $datatable->setFrom("tbl_web_convocatorias convocatorias "
                . "INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria "
                . "INNER JOIN tbl_web_convocatorias_publico convocatorias_publico ON convocatorias_publico.convocatoria = convocatorias.id_convocatoria "
                . "AND convocatorias_publico.perfil = convocatorias_perfiles.codigo");
            //$datatable->setWhere("convocatorias.etapa = 1 AND convocatorias_publico.publico = {$publico}");
            $datatable->setWhere("convocatorias_publico.nro_doc = '$nro_doc'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    public function saveGrabarVoucherAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        // Instantiate the Query


      //  $idvoucher=$voucherdata->voucher;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                /*print_r($_POST);
                print_r($_FILES);*/
                $codigo=$_POST['idcodigo'];
                if ($this->request->hasFiles() == true) {
                    // Print the real file names and sizes
                    foreach ($this->request->getUploadedFiles() as $file) {
                        //print_r($file);
                        if ($file->getKey() == "archivo") {

                            $filex = new SplFileInfo($file->getName());

                            //
                            if ($filex->getExtension() == 'pdf') {


                                $voucher=new Voucher();
                                $voucher->codigo=$_POST['idcodigo'];
                                $voucher->convocatoria=$_POST['tipo'];
                                $voucher->fecharegistro = date('Y-m-d H:i:s');
                                $voucher->archivo = $file->getName();
                                //$voucher->voucher = intval($idvoucher)+1;

                                $url_destino = 'adminpanel/archivos/voucher/voucher_' . $codigo.date('YmdHis'). '.pdf';
                                $voucher->archivo = 'voucher_' . $codigo.date('YmdHis'). '.pdf';

                                if ($voucher->save() == false) {
                                    // Cuando hay error
                                    $this->response->setStatusCode(200, "OK");
                                    $this->response->setJsonContent($voucher->getMessages());
                                } else {
                                    if ($file->moveTo($url_destino)) {
                                        $this->response->setStatusCode(200, "OK");
                                        $this->response->setJsonContent(array("say" => "yes", "mensaje" => "Se subio el archivo el voucher"));
                                    } else {
                                        $this->response->setStatusCode(200, "OK");
                                        $this->response->setJsonContent(array("say" => "yes", "mensaje" => "No se subio el archivo el voucher"));

                                    }
                                }
                            }else{
                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "yes", "mensaje" => "No es un formato PDF valido"));

                            }
                        }else{
                            $this->response->setStatusCode(404, "OK");
                            $this->response->setJsonContent(array("say" => "yes", "mensaje" => "No eexiste el parametro de archivo"));
                        }
                    }
                    }


            }catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        }
        $this->response->send();
    }

    public function aprobarAction() {
        $this->view->disable();
        $indice = (int) $this->request->getPost("indice", "int");
        $mensaje = (string) $this->request->getPost("mensaje", "string");
        if ($this->request->isPost() && $this->request->isAjax()) {

                $db_update = $this->db;
                $sql_update_a_s = " update tbl_web_convocatorias_voucher
SET estado=1,mensaje='{$mensaje}',fechaatencion=now() where voucher='{$indice}'";
                $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);

                //alumnos solicitudes
                $DocenteVoucher = Voucher::findFirst(null);

                if ($DocenteVoucher->save()) {

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
    public function denegarAction() {
        $this->view->disable();
        $indice = (int) $this->request->getPost("indice", "int");
        $mensaje = (string) $this->request->getPost("mensaje", "string");
        if ($this->request->isPost() && $this->request->isAjax()) {

            $db_update = $this->db;
            $sql_update_a_s = " update tbl_web_convocatorias_voucher
SET estado=2,mensaje='{$mensaje}',fechaatencion=now() where voucher='{$indice}'";
            $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);

            //alumnos solicitudes
            $DocenteVoucher = Voucher::findFirst(null);

            if ($DocenteVoucher->save()) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
                $Voucher = Voucher::findFirst("voucher=".$indice);
                $this->enviaremail($indice,$Voucher->codigo,0);
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

    public function getNewVoucherAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "si"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }
    public function datatableDetallePagoAction() {

        $this->view->disable();
        #if ($this->request->isPOST() && $this->request->isAjax()) {
            $docente=$this->session->get("auth")["codigo"];
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("voucher");
            $datatable->setSelect("voucher,codigo, convocatoria, fecha, archivo,  estado,  nomestado,nombredocente,nro_doc,mensaje,titulo,fechaatencion");
            $datatable->setFrom("(SELECT * from view_voucherdocente where codigo='$docente') AS temporal_table");
            $datatable->setParams(["length" => -1]);
            //$datatable->setWhere("perfil ={$perfil}");
            //$datatable->setWhere("perfil = 8 OR perfil= 6");
            $datatable->setOrderby("fecha DESC ");
            $datatable->getJson();
            //print_r($datatable->setSelect());
       # }

    }
    function subirdocumentoAction(){
       // $this->view->disable();

        $voucher = (int) $this->dispatcher->getParam("0");
        $this->view->idvoucher=$voucher;
        $this->assets->addJs("adminpanel/js/modulos/registrovoucher.js?v" . uniqid());
    }

    public function EnviarBasesAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        // Instantiate the Query


        //  $idvoucher=$voucherdata->voucher;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                /*print_r($_POST);
                print_r($_FILES);*/
                $codigo=$_POST['idvoucher'];
                if ($this->request->hasFiles() == true) {
                    // Print the real file names and sizes
                   # print_r($this->request->getUploadedFiles());
                    foreach ($this->request->getUploadedFiles() as $file) {
                        //print_r($file);
                       # if ($file->getKey() == "archivo") {
                            @mkdir('adminpanel/archivos/basedocente/'.$codigo.'/',0777,true);
                            $filex = new SplFileInfo($file->getName());

                            //
                            if ($filex->getExtension() == 'pdf') {

                              #  echo 'es pdf';
                               /* $voucher=new Voucher();
                                $voucher->codigo=$_POST['idcodigo'];
                                $voucher->convocatoria=$_POST['tipo'];
                                $voucher->fecharegistro = date('Y-m-d H:i:s');
                                $voucher->archivo = $file->getName();
                                //$voucher->voucher = intval($idvoucher)+1;
                                */
                                $url_destino = 'adminpanel/archivos/basedocente/'.$codigo.'/' . $file->getKey() .'.pdf';
                               # $voucher->archivo = 'voucher_' . $codigo.date('YmdHis'). '.pdf';


                                    if ($file->moveTo($url_destino)) {
                                        $this->response->setStatusCode(200, "OK");
                                        $this->response->setJsonContent(array("say" => "yes", "mensaje" => "Se subio el archivo el voucher"));
                                    } else {
                                        $this->response->setStatusCode(200, "OK");
                                        $this->response->setJsonContent(array("say" => "yes", "mensaje" => "No se subio el archivo el voucher"));

                                    }

                            }else{
                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "yes", "mensaje" => "No es un formato PDF valido"));

                            }
                       /* }else{
                            $this->response->setStatusCode(404, "OK");
                            $this->response->setJsonContent(array("say" => "yes", "mensaje" => "No eexiste el parametro de archivo"));
                        }*/
                    }
                    $Publico = Voucher::findFirst("voucher=".$codigo);
                    #print_r($Publico->codigo);

                    $this->enviaremail($codigo,$Publico->codigo,1);
                }


            }catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        }
        $this->response->send();
    }
    public function enviaremailAction()
    {
        $indice = (int) $this->request->getPost("indice", "int");
        $codigo = (int) $this->request->getPost("codigo", "int");
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);



        $this->enviaremail($indice,$codigo,1);

    }

    public function enviaremail($indice,$codigo,$tipo=0,$adjunta=0)
    {
       /* ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/
        // Instantiate the Query
        $Publico = Publico::findFirstBycodigo($codigo);
        $Voucher = Voucher::findFirst("voucher=".$indice);
        $Convenio=Convocatorias::findFirst("id_convocatoria=".$Voucher->convocatoria);
        $mensaje=array('Estimado postulante, '.$Publico->apellidop.' '.$Publico->apellidom.' '.$Publico->nombres.':<br><br>
Su inscripci&oacute;n ha sido RECHAZADA para el '.$Convenio->titulo.', debido a que el comprobante de pago no es legible o no evidencia el pago correspondiente. Se sugiere revisar el formato o un su defecto comprobar en la entidad bancaria el pago correspondiente.
Saludos cordiales.<br><br><br>

Atentamente.<br><br><br>

Oficina de Tecnolog&iacute;as de la Informaci&oacute;n.
','Estimado postulante, '.$Publico->apellidop.' '.$Publico->apellidom.' '.$Publico->nombres.':<br><br>
Su inscripci&oacute;n ha sido ACEPTADA para el '.$Convenio->titulo.', puede descargar los documentos del presente concurso y seguir con su postulaci&oacute;n.
Saludos cordiales.<br><br><br>

Atentamente.<br><br><br>

Oficina de Tecnolog&iacute;as de la Informaci&oacute;n.
','Estimado postulante, '.$Publico->apellidop.' '.$Publico->apellidom.' '.$Publico->nombres.':<br><br>
Se envian los documentos  para el '.$Convenio->titulo.', puede descargar los documentos del presente concurso y seguir con su postulaci&oacute;n.
Saludos cordiales.<br><br><br>

Atentamente.<br><br><br>

Oficina de Tecnolog&iacute;as de la Informaci&oacute;n.
');


       # print_r($Convenio);
        require("/home/unca/web/unca.edu.pe/public_html/app/library/PHPMailer/PHPMailer.php");
        $this->view->disable();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $email=$Publico->email;
        #apellidop,apellidop,nombres
        $nombrecompleto=$Publico->apellidop.' '.$Publico->apellidom.' '.$Publico->nombres;
        $mail->Username = "notificaciones@unca.edu.pe"; // SMTP username
        $mail->Password = "yktjzqxeknlvxmaw"; // SMTP password
        $mail->FromName ="Notificación UNCA";

        $adjuntadatos="<br><br><br>
        Se Adjunta los siguientes documentos:
            <ol>";

        if(file_exists("adminpanel/archivos/basedocente/".$indice."/baseconcurso.pdf")) {
            $adjunta=1;
            $mail->addAttachment("adminpanel/archivos/basedocente/" . $indice . "/baseconcurso.pdf", "baseconcurso.pdf");
            $adjuntadatos.='<li>Bases del concurso público</li>';
        }
        if(file_exists("adminpanel/archivos/basedocente/".$indice."/declaracionjurada.pdf")){
            $adjunta=1;
            $mail->addAttachment("adminpanel/archivos/basedocente/".$indice."/declaracionjurada.pdf","declaracionjurada.pdf");
            $adjuntadatos.='<li>Formato de Declaración Jurada de no tener impedimentos y veracidad de la información (Anexo N° 02)</li>';
        }
        if(file_exists("adminpanel/archivos/basedocente/" . $indice . "/declaracionjuradafa.pdf")) {
            $adjunta=1;
            $mail->addAttachment("adminpanel/archivos/basedocente/" . $indice . "/declaracionjuradafa.pdf", "declaracionjuradafa.pdf");

            $adjuntadatos.='<li>Formato de Declaración Jurada de Uso de Derecho por Primera Vez de la Bonificación por ser Personal Licenciado de las Fuerzas Armadas (Anexo N° 06)</li>';
        }
        if(file_exists("adminpanel/archivos/basedocente/" . $indice . "/solicitudinscripcion.pdf")) {
            $adjunta=1;
            $mail->addAttachment("adminpanel/archivos/basedocente/" . $indice . "/solicitudinscripcion.pdf", "solicitudinscripcion.pdf");
            $adjuntadatos.='<li>Solicitud de inscripción y postulación al concurso público(Anexo N° 03)</li>';
        }
        $adjuntadatos.='</ol>';
        $mail->From = $email;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; //SMTP port
        $mail->addAddress($email, $nombrecompleto);
        $mail->Subject = "VALIDACIÓN DEL COMPROBANTE DE PAGO DEL ".$Convenio->titulo;
        $mail->Body =$mensaje[$tipo].($adjunta==1?$adjuntadatos:'');
        $mail->AltBody = 'Su navegador no soporta ';

        if(!$mail->Send())
        {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
    }
}
