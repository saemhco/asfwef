<?php

class DatosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {

        if ($this->session->get("auth")["perfil"] == "2") {

            $obj = Empresas::findFirstBycodigo($this->session->get("auth")["codigo"]);
            $this->assets->addJs("adminpanel/js/modulos/datos.js?v=" . uniqid() . "");
            $this->view->o = $obj;
            
        } elseif ($this->session->get("auth")["perfil"] == "3") {

            return $this->response->redirect("datos/estudiante");
        } elseif ($this->session->get("auth")["perfil"] == "4") {

            return $this->response->redirect("datos/docente");
        } elseif ($this->session->get("auth")["perfil"] == "5") {

            return $this->response->redirect("datos/publico");
        }
    }

    public function repasswordAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            switch ($this->session->get("auth")["perfil"]) {
                case ($this->session->get("auth")["perfil"] == "3"):
                    $user = Alumnos::findFirst("password = '" . $password . "' AND CAST(codigo AS INTEGER) = " . $this->session->get("auth")["codigo"]);
                    break;
                case ($this->session->get("auth")["perfil"] == "4"):
                    $user = Docentes::findFirst("password = '" . $password . "' AND CAST(codigo AS INTEGER) = " . $this->session->get("auth")["codigo"]);
                    break;
                case ($this->session->get("auth")["perfil"] == "5"):
                    $user = Publico::findFirst("password = '" . $password . "' AND CAST(codigo AS INTEGER) = " . $this->session->get("auth")["codigo"]);
                    break;
            }

            if ($user) {
                if ($password_new == $repassword) {
                    $user->password = $this->request->getPost("usu_clave2", "string");
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no", "msg" => "Clave incorrecta"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function alumnoAction()
    {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);

        if ($alumno->tipo == 2) {
            return $this->response->redirect("datos/egresado");
        }

        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;

        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

    public function saveAlumnoAction()
    {
//        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //------------------------tabla: alumnos----------------------------------------

                $id = (string) $this->request->getPost("codigo", "string");
                $Alumnos = Alumnos::findFirstBycodigo($id);
                //$Alumnos = (!$Alumnos) ? new Alumnos() : $Alumnos;
                //codigo
                //tipo
                //semestre
                //semestre_egreso
                //carrera
                //apellidop
                $Alumnos->apellidop = $this->request->getPost("apellidop", "string");

                //apellidom
                $Alumnos->apellidom = $this->request->getPost("apellidom", "string");

                //nombres
                $Alumnos->nombres = $this->request->getPost("nombres", "string");

                //Sexo
                //cv
                //region
                $Alumnos->region = $this->request->getPost("region");

                //provincia
                $Alumnos->provincia = $this->request->getPost("provincia");

                //distrito
                $Alumnos->distrito = $this->request->getPost("distrito");

                //ubigeo
                $Alumnos->ubigeo = $this->request->getPost("ubigeo");

                //fecha_nacimiento
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Alumnos->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                //documento
                //nro_doc
                $Alumnos->nro_doc = $this->request->getPost("nro_doc", "string");

                //fecha_ingreso
                //seguro
                if ($this->request->getPost("seguro", "int") == "") {
                    $Alumnos->seguro = null;
                } else {
                    $Alumnos->seguro = $this->request->getPost("seguro", "int");
                }

                //telefono
                $Alumnos->telefono = $this->request->getPost("telefono", "string");

                //celular
                $Alumnos->celular = $this->request->getPost("celular", "string");

                //email
                $Alumnos->email = $this->request->getPost("email", "string");

                //email1
                $Alumnos->email1 = $this->request->getPost("email1", "string");

                //direccion
                $Alumnos->direccion = $this->request->getPost("direccion", "string");

                //ciudad
                $Alumnos->ciudad = $this->request->getPost("ciudad", "string");

                //observaciones
                //foto
                //traslado
                //certificado_u
                //constancia_i
                //certificado_c
                //dni
                //partida_n
                //colegio_publico
                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {

                    $Alumnos->colegio_publico = 1;
                } else {

                    $Alumnos->colegio_publico = 0;
                }
                //colegio_nombre
                $Alumnos->colegio_nombre = $this->request->getPost("colegio_nombre", "string");

                //colegio_anio
                if ($this->request->getPost("colegio_anio", "int") == "") {
                    $Alumnos->colegio_anio = null;
                } else {
                    $Alumnos->colegio_anio = $this->request->getPost("colegio_anio", "int");
                }

                //sitrabaja
                $Alumnos->sitrabaja = $this->request->getPost("sitrabaja", "string");

                //sitrabaja_nombre
                $Alumnos->sitrabaja_nombre = $this->request->getPost("sitrabaja_nombre", "string");

                //sidepende
                $Alumnos->sidepende = $this->request->getPost("sidepende", "string");

                //sidepende_nombre
                $Alumnos->sidepende_nombre = $this->request->getPost("sidepende_nombre", "string");

                //graduado
                //titulado
                //discapacitado
                $discapacitado = $this->request->getPost("discapacitado", "string");

                if (isset($discapacitado)) {

                    $Alumnos->discapacitado = 1;
                } else {

                    $Alumnos->discapacitado = 0;
                }

                //envio
                //activo
                //estado
                $Alumnos->estado = "A";

                //referencia
                $Alumnos->referencia = "-";

                //discapacitado_nombre
                $Alumnos->discapacitado_nombre = $this->request->getPost("discapacitado_nombre", "string");

                //region1
                $Alumnos->region1 = $this->request->getPost("region1");

                //provincia1
                $Alumnos->provincia1 = $this->request->getPost("provincia1");

                //distrito1
                $Alumnos->distrito1 = $this->request->getPost("distrito1");

                //ubigeo1
                $Alumnos->ubigeo1 = $this->request->getPost("ubigeo1");

                //localidad
                $Alumnos->localidad = $this->request->getPost("localidad");

                //idioma
                //                if ($this->request->getPost("idioma", "int") == "") {
                //                    $Alumnos->idioma = null;
                //                } else {
                //                    $Alumnos->idioma = $this->request->getPost("idioma", "int");
                //                }
                //archivo
                //nro_seguro

                if ($this->request->getPost("identidad_etnica", "int") == "") {
                    $Alumnos->identidad_etnica = null;
                } else {
                    $Alumnos->identidad_etnica = $this->request->getPost("identidad_etnica", "int");
                }

                //tipo_discapacidad
                if ($this->request->getPost("tipo_discapacidad", "int") == "") {
                    $Alumnos->tipo_discapacidad = null;
                } else {
                    $Alumnos->tipo_discapacidad = $this->request->getPost("tipo_discapacidad", "int");
                }

                //fecha_egreso
                //modalidad_ingreso
                //                if ($this->request->getPost("modalidad_ingreso", "int") == "") {
                //                    $Alumnos->modalidad_ingreso = null;
                //                } else {
                //                    $Alumnos->modalidad_ingreso = $this->request->getPost("modalidad_ingreso", "int");
                //                }
                //sitrabaja_actividad
                $Alumnos->sitrabaja_actividad = $this->request->getPost("sitrabaja_actividad", "string");

                //violencia_sociopolitica
                $violencia_sociopolitica = $this->request->getPost("violencia_sociopolitica", "string");
                if (isset($violencia_sociopolitica)) {

                    $Alumnos->violencia_sociopolitica = 1;
                } else {

                    $Alumnos->violencia_sociopolitica = 0;
                }

                //violencia_sociopolitica_registro
                $Alumnos->violencia_sociopolitica_registro = $this->request->getPost("violencia_sociopolitica_registro", "string");

                //estado_civil
                if ($this->request->getPost("estado_civil", "int") == "") {
                    $Alumnos->estado_civil = null;
                } else {
                    $Alumnos->estado_civil = $this->request->getPost("estado_civil", "string");
                }
//---------------------------------fin tabla alumnos----------------------------

                if ($Alumnos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Alumnos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Alumnos->foto)) {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . $Alumnos->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.jpg';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '.jpg';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Alumnos->foto)) {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . $Alumnos->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.png';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '.png';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . ".png";
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

                            //cv
                            if ($file->getKey() == "cv") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Alumnos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/alumnos/' . $Alumnos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/cv/' . 'CV-' . $Alumnos->codigo . '-' . $temporal_rand . '.pdf';

                                        $Alumnos->cv = 'CV' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/cv/' . 'CV-' . $Alumnos->codigo . '.pdf';

                                        $Alumnos->cv = 'CV' . '-' . $Alumnos->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $Alumnos->save();
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                    // $this->response->send();
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

    public function savepAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("lector_id", "int");
                $profesional = Lectores::findFirstBylector_id($id);
                $profesional->nombres = $this->request->getPost("nombres");
                $profesional->ap_paterno = $this->request->getPost("ap_paterno");
                $profesional->ap_materno = $this->request->getPost("ap_materno");
                $profesional->dni = $this->request->getPost("dni");
                $profesional->telefono = $this->request->getPost("telefono");
                $profesional->direccion = $this->request->getPost("direccion");

                if ($profesional->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($profesional->getMessages());
                } else {

                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                    // $this->response->send();
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

    public function saveAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Empleador = Empresas::findFirstBycodigo($id);
                $Empleador->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Empleador->ruc = $this->request->getPost("ruc", "string");
                $Empleador->rubro = $this->request->getPost("rubro", "string");
                $Empleador->telefono = $this->request->getPost("telefono", "string");
                $Empleador->direccion = $this->request->getPost("direccion", "string");
                $Empleador->descripcion = $this->request->getPost("descripcion", "string");
                $Empleador->email = $this->request->getPost("email", "string");
                $Empleador->representante = $this->request->getPost("representante", "string");

                //comprueba si hay archivos por subir
                if ($this->request->getPost("input-logo", "string") != "") {
                    $Empleador->logo = $this->request->getPost("input-logo", "string");
                } else {
                    //$Empleador->logo = ".";
                }

                if ($Empleador->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empleador->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $url_destino = 'adminpanel/imagenes/empresas/' . $Empleador->codigo . "-" . $file->getName();

                            if (!$file->moveTo($url_destino)) {
                                //echo "te";
                                //return 0;
                            } else {
                                $Empleador->logo = $Empleador->codigo . "-" . $file->getName();
                            }
                        }

                        $Empleador->save();
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

    //Datos docente
    public function docenteAction()
    {
        $obj = Docentes::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->docentes = $obj;

        //Modelo documento(a_codigos)
        $documentos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentos = $documentos;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguros;

        //Modelo grado_academico(a_codigos)
        $grados = Grados::find("estado = 'A' AND numero = 8");
        $this->view->grados = $grados;

        //Modelo grado_maximo(a_codigos)
        $gradosm = Gradosm::find("estado = 'A' AND numero = 10");
        $this->view->gradosm = $gradosm;

        $this->assets->addJs("adminpanel/js/modulos/datos.docente.js?v=" . uniqid() . "");
    }

    //Guardar datos docente
    //Funcion para guardar docente
    public function saveDocenteAction()
    {

//        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "int");
                $Docentes = Docentes::findFirstBycodigo($id);
                //$Docentes = (!$Docentes) ? new Docentes() : $Docentes;
                //$Docentes->codigo = $this->request->getPost("codigo", "string");
                //                $ley30220 = $this->request->getPost("ley30220", "string");
                //
                //                if (isset($ley30220)) {
                //                    $Docentes->ley30220 = 1;
                //                } else {
                //                    $Docentes->ley30220 = 0;
                //                }
                //                $Docentes->documento = $this->request->getPost("documento", "string");
                //                $Docentes->nro_doc = $this->request->getPost("nro_doc", "string");
                //                $Docentes->apellidop = $this->request->getPost("apellidop", "string");
                //                $Docentes->apellidom = $this->request->getPost("apellidom", "string");
                //                $Docentes->nombres = $this->request->getPost("nombres", "string");
                $Docentes->direccion = $this->request->getPost("direccion", "string");
                $Docentes->ciudad = $this->request->getPost("ciudad", "string");
//                $Docentes->sexo = $this->request->getPost("sexo", "string");
                $Docentes->pais = $this->request->getPost("pais", "string");
                $Docentes->telefono = $this->request->getPost("telefono", "string");
                $Docentes->celular = $this->request->getPost("celular", "string");
                $Docentes->email = $this->request->getPost("email", "string");
                $Docentes->email1 = $this->request->getPost("email1", "string");
                $Docentes->seguro = $this->request->getPost("seguro", "string");
                $Docentes->nro_seguro = $this->request->getPost("nro_seguro", "string");
//                $Docentes->titulo = $this->request->getPost("titulo", "string");
                //                $Docentes->observaciones = $this->request->getPost("observaciones");
                //                if ($this->request->getPost("fecha_ingreso", "string") != "") {
                //                    $fecha_ex = explode("/", $this->request->getPost("fecha_ingreso", "string"));
                //                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                //
                //                    $Docentes->fecha_ingreso = date('Y-m-d', strtotime($fecha_new));
                //                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Docentes->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

//               $Docentes->grado = $this->request->getPost("grado", "int");
                //                if ($this->request->getPost("grado_otro", "int") == "") {
                //                    $Docentes->grado_otro = null;
                //                } else {
                //                    $Docentes->grado_otro = $this->request->getPost("grado_otro", "int");
                //                }
                //                $Docentes->grado_mencion_mayor = $this->request->getPost("grado_mencion_mayor", "string");
                //                $Docentes->grado_mencion_otro = $this->request->getPost("grado_mencion_otro", "string");
                //                $Docentes->concytec_enlace = $this->request->getPost("concytec_enlace", "string");
                //                $Docentes->grado_universidad_mayor = $this->request->getPost("grado_universidad_mayor", "string");
                //                $Docentes->grado_universidad_otro = $this->request->getPost("grado_universidad_otro", "string");
                //                $Docentes->pais_universidad_mayor = $this->request->getPost("pais_universidad_mayor", "string");
                //                $Docentes->pais_universidad_otro = $this->request->getPost("pais_universidad_otro", "string");
                //                if ($this->request->getPost("gradom", "int") == "") {
                //                    $Docentes->gradom = null;
                //                } else {
                //                    $Docentes->gradom = $this->request->getPost("gradom", "int");
                //                }
                //
                //                if ($this->request->getPost("gradom_otro", "int") == "") {
                //                    $Docentes->gradom_otro = null;
                //                } else {
                //                    $Docentes->gradom_otro = $this->request->getPost("gradom_otro", "int");
                //                }
                //                $titulo_universitario = $this->request->getPost("titulo_universitario", "string");
                //                if (isset($titulo_universitario)) {
                //                    $Docentes->titulo_universitario = 1;
                //                } else {
                //                    $Docentes->titulo_universitario = 0;
                //                }
                //                $dina = $this->request->getPost("dina", "string");
                //                if (isset($dina)) {
                //                    $Docentes->dina = 1;
                //                } else {
                //                    $Docentes->dina = 0;
                //                }
                //
                //                $maestria = $this->request->getPost("maestria", "string");
                //                if (isset($maestria)) {
                //                    $Docentes->maestria = 1;
                //                } else {
                //                    $Docentes->maestria = 0;
                //                }
                //
                //
                //                $doctorado = $this->request->getPost("doctorado", "string");
                //                if (isset($doctorado)) {
                //                    $Docentes->doctorado = 1;
                //                } else {
                //                    $Docentes->doctorado = 0;
                //                }

                $Docentes->estado = "A";

                if ($Docentes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Docentes->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();

                            $temporal_rand = mt_rand(100000, 999999);

//                            if ($file->getKey() == "imagen") {
                            //
                            //                                $filex = new SplFileInfo($file->getName());
                            //
                            //                                if ($filex->getExtension() == 'jpg') {
                            //
                            //                                    if (isset($Docentes->imagen)) {
                            //                                        $url_destino = 'adminpanel/imagenes/docentes/' . $Docentes->imagen;
                            //
                            //                                        if (file_exists($url_destino)) {
                            //                                            unlink($url_destino);
                            //                                        }
                            //
                            //                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.jpg';
                            //                                        $Docentes->imagen = 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . ".jpg";
                            //                                    } else {
                            //                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '.jpg';
                            //                                        $Docentes->imagen = 'IMG' . '-' . $Docentes->codigo . ".jpg";
                            //                                    }
                            //
                            //                                    //
                            //                                    if (!$file->moveTo($url_destino)) {
                            //
                            //                                    } else {
                            //                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                            //                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                            //                                    }
                            //                                    //
                            //                                } elseif ($filex->getExtension() == 'png') {
                            //
                            //                                    if (isset($Docentes->imagen)) {
                            //                                        $url_destino = 'adminpanel/imagenes/docentes/' . $Docentes->imagen;
                            //
                            //                                        if (file_exists($url_destino)) {
                            //                                            unlink($url_destino);
                            //                                        }
                            //
                            //                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.png';
                            //                                        $Docentes->imagen = 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . ".png";
                            //                                    } else {
                            //                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '.png';
                            //                                        $Docentes->imagen = 'IMG' . '-' . $Docentes->codigo . ".png";
                            //                                    }
                            //
                            //                                    //
                            //                                    if (!$file->moveTo($url_destino)) {
                            //
                            //                                    } else {
                            //                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                            //                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                            //                                    }
                            //                                    //
                            //                                }
                            //
                            //                                //$file->getName() = $Docentes->nombre;
                            //                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Docentes->codigo . "-" . $file->getName();
                            //                            }
                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Docentes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/docentes/' . $Docentes->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/docentes/' . 'FILE' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.pdf';

                                        $Docentes->archivo = 'FILE' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/docentes/' . 'FILE' . '-' . $Docentes->codigo . '.pdf';

                                        $Docentes->archivo = 'FILE' . '-' . $Docentes->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $Docentes->save();
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

    //Datos Publico
    public function publicoAction()
    {
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico;

        //Modelo documentos(a_codigos)
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

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

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;



        $this->assets->addJs("adminpanel/js/modulos/datos.publico.js?v=" . uniqid() . "");
    }

    //Save publico
    //Funcion para guardar colegiado
    public function savePublicoAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoConvocatorias = PublicoCV::findFirstBycodigo($id);
                //$PublicoConvocatorias = (!$PublicoConvocatorias) ? new PublicoConvocatorias() : $PublicoConvocatorias;

                $PublicoConvocatorias->codigo = $this->request->getPost("codigo", "int");

                $PublicoConvocatorias->tipo = 1;
                $PublicoConvocatorias->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoConvocatorias->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoConvocatorias->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("sexo", "int") == "") {
                    $PublicoConvocatorias->sexo = null;
                } else {
                    $PublicoConvocatorias->sexo = $this->request->getPost("sexo", "int");
                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoConvocatorias->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoConvocatorias->documento = 1;

                $PublicoConvocatorias->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoConvocatorias->seguro = $this->request->getPost("seguro", "string");
                $PublicoConvocatorias->telefono = $this->request->getPost("telefono", "string");
                $PublicoConvocatorias->celular = $this->request->getPost("celular", "string");
                $PublicoConvocatorias->email = $this->request->getPost("email", "string");
                $PublicoConvocatorias->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $PublicoConvocatorias->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $PublicoConvocatorias->observaciones = strtoupper($this->request->getPost("observaciones", "string"));

                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {

                    $PublicoConvocatorias->colegio_publico = 1;
                } else {

                    $PublicoConvocatorias->colegio_publico = 0;
                }

                $PublicoConvocatorias->colegio_nombre = strtoupper($this->request->getPost("colegio_nombre", "string"));

                $sitrabaja = $this->request->getPost("sitrabaja", "string");
                if (isset($sitrabaja)) {

                    $PublicoConvocatorias->sitrabaja = 1;
                } else {

                    $PublicoConvocatorias->sitrabaja = 0;
                }

                $PublicoConvocatorias->sitrabaja_nombre = strtoupper($this->request->getPost("sitrabaja_nombre", "string"));

                $sidepende = $this->request->getPost("sidepende", "string");
                if (isset($sidepende)) {

                    $PublicoConvocatorias->sidepende = 1;
                } else {

                    $PublicoConvocatorias->sidepende = 0;
                }

                $PublicoConvocatorias->sidepende_nombre = strtoupper($this->request->getPost("sidepende_nombre", "string"));

                //Ubigeo
                $PublicoConvocatorias->region = $this->request->getPost("region", "string");
                $PublicoConvocatorias->provincia = $this->request->getPost("provincia", "string");
                $PublicoConvocatorias->distrito = $this->request->getPost("distrito", "string");
                $PublicoConvocatorias->ubigeo = $this->request->getPost("ubigeo", "string");

                //lugar de procedencia
                $PublicoConvocatorias->region1 = $this->request->getPost("region1", "string");
                $PublicoConvocatorias->provincia1 = $this->request->getPost("provincia1", "string");
                $PublicoConvocatorias->distrito1 = $this->request->getPost("distrito1", "string");
                $PublicoConvocatorias->ubigeo1 = $this->request->getPost("ubigeo1", "string");

                $PublicoConvocatorias->localidad = $this->request->getPost("localidad", "string");

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $PublicoConvocatorias->discapacitado = 1;
                } else {

                    $PublicoConvocatorias->discapacitado = 0;
                }

                $PublicoConvocatorias->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                //$PublicoConvocatorias->password = $this->request->getPost("password", "string");
                //$password_postulantes = $this->request->getPost("nro_doc", "string");
                //$PublicoConvocatorias->password = $this->security->hash($password_postulantes);

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

                                        $url_destino = 'adminpanel/archivos/publico/' . $PublicoConvocatorias->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/' . 'FILE' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . '.pdf';

                                        $PublicoConvocatorias->archivo = 'FILE' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publico/' . 'FILE' . '-' . $PublicoConvocatorias->codigo . '.pdf';

                                        $PublicoConvocatorias->archivo = 'FILE' . '-' . $PublicoConvocatorias->codigo . '.pdf';
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

    public function cambiarcontrasenha0Action()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha0.js?v=" . uniqid() . "");
    }

    //guardar contraseña usuarios admin
    public function save_contrasenha0Action()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            $where = " estado = 'A' AND id = " . $this->session->get("auth")["usuario_id"];

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();

            $user = UsuariosAdmin::findFirst($where);
            $pass = $user->usu_clave;

            /* Desencryptar */
            if ($this->security->checkHash($password, $pass)) {
                $this->session->set('auth', [
                    'usuario_id' => $user->id,
                    'nombres' => $user->usu_nombre,
                    'perfil' => $user->perfil_id,
                ]);
            } else {
                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();
            }

            if ($user) {
                if ($password_new == $repassword) {

                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->usu_clave = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no", "msg" => "Clave incorrecta"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //cambiar contraseña estudiantes
    public function cambiarcontrasenha1Action()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha1.js?v=" . uniqid() . "");

        //$usuarios_admin = Usuario::findFirstByid($this->session->get("auth")["usuario_id"]);
        //$this->assets->addJs("adminpanel/js/modulos/secretaria_general.js?v=" . uniqid() . "");
        //$this->view->usuarios = $usuarios_admin;
    }

    //guardar contraseña estudiantes
    public function save_contrasenha1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            //echo '<pre>';
            //print_r($this->session->get("auth")["usuario_id"]);
            //exit();

            $where = " estado = 'A' AND codigo = '" . $this->session->get("auth")["codigo"] . "'";

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();
            //echo '<pre>';
            //print_r($where);
            //exit();

            $user = Alumnos::findFirst($where);
            $pass = $user->password;

            //echo '<pre>';
            //print_r("contraseña:".$user->password);
            //exit();

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $this->session->set('auth', [
                    'codigo' => $user->codigo,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {
                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->password = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //cambiar contraseña docentes
    public function cambiarcontrasenha2Action()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha2.js?v=" . uniqid() . "");

        //$usuarios_admin = Usuario::findFirstByid($this->session->get("auth")["usuario_id"]);
        //$this->assets->addJs("adminpanel/js/modulos/secretaria_general.js?v=" . uniqid() . "");
        //$this->view->usuarios = $usuarios_admin;
    }

    //
    //guardar contraseña estudiantes
    public function save_contrasenha2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            //echo '<pre>';
            //print_r("Id_ usuario:" . $this->session->get("auth")["codigo"]);
            //exit();

            $where = " estado = 'A' AND codigo = " . $this->session->get("auth")["codigo"] . "";

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();
            //echo '<pre>';
            //print_r($where);
            //exit();

            $user = Docentes::findFirst($where);
            $pass = $user->password;

            //echo '<pre>';
            //print_r("Nombre:".$user->nombres);
            //exit();

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

//                echo '<pre>';
                //                print_r("Testing");
                //                exit();

                $this->session->set('auth', [
                    'codigo' => $user->codigo,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {

                    //print("LLega:".$this->request->getPost("usu_clave2"));
                    //exit();

                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);
                    $user->password = $this->security->hash($text);

                    //print("LLega:" .  $user->password);
                    //exit();

                    $user->save();

//                    if ($user->save() == false) {
                    //                        // Cuando hay error
                    //                        print("No graba");
                    //                        exit();
                    //                    } else {
                    //                        print("graba");
                    //                        exit();
                    //                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //cambiar contraseña adminsitrativos (personal)
    public function cambiarcontrasenha3Action()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha3.js?v=" . uniqid() . "");

        //$usuarios_admin = Usuario::findFirstByid($this->session->get("auth")["usuario_id"]);
        //$this->assets->addJs("adminpanel/js/modulos/secretaria_general.js?v=" . uniqid() . "");
        //$this->view->usuarios = $usuarios_admin;
    }

    //Cambiar contraseña administrativos
    public function save_contrasenha3Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            //echo '<pre>';
            //print_r($this->session->get("auth")["usuario_id"]);
            //exit();

            $where = " estado = 'A' AND codigo = " . $this->session->get("auth")["codigo"] . "";

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();
            //echo '<pre>';
            //print_r($where);
            //exit();

            $user = Personal::findFirst($where);
            $pass = $user->password;

            //echo '<pre>';
            //print_r("contraseña:".$user->password);
            //exit();

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $this->session->set('auth', [
                    'codigo' => $user->codigo,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {
                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->password = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function empresaAction()
    {
        $empresas = Empresas::findFirstByid_empresa($this->session->get("auth")["id_empresa"]);

        //print($this->session->get("auth")["id_empresa"]);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/datos.empresa.js?v=" . uniqid() . "");
        $this->view->empresas = $empresas;
    }

    //guarda datos postulante
    public function save_empresaAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_empresa", "int");
                $Empresas = Empresas::findFirstByid_empresa($id);
                $Empresas = (!$Empresas) ? new Empresas() : $Empresas;

                $Empresas->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Empresas->ruc = $this->request->getPost("ruc", "string");
                $Empresas->rubro = $this->request->getPost("rubro", "string");
                $Empresas->telefono = $this->request->getPost("telefono", "string");
                $Empresas->direccion = $this->request->getPost("direccion", "string");
                $Empresas->email = $this->request->getPost("email", "string");

                $pass_bcrypt = $this->request->getPost("ruc", "string") . 'UNCA';
                $Empresas->password = $this->security->hash($pass_bcrypt);

                $Empresas->representante = $this->request->getPost("representante", "string");

                $Empresas->estado = "A";

                $bolsa_trabajo = $this->request->getPost("bolsa_trabajo", "string");
                if (isset($bolsa_trabajo)) {
                    $Empresas->bolsa_trabajo = "1";
                } else {
                    $Empresas->bolsa_trabajo = "0";
                }

                $Empresas->perfil = 2;
                $Empresas->giro = $this->request->getPost("giro", "string");
                $Empresas->fecha_registro = date("Y-m-d H:i:s");
                $Empresas->cta_cte_detraccion = $this->request->getPost("cta_cte_detraccion", "string");
                $Empresas->cci = $this->request->getPost("cci", "string");
                $Empresas->cargo = $this->request->getPost("cargo", "string");
                $Empresas->nro_doc = $this->request->getPost("nro_doc", "string");
                $Empresas->fax = $this->request->getPost("fax", "string");
                $Empresas->celular = $this->request->getPost("celular", "string");
                $Empresas->pais = $this->request->getPost("pais", "string");
                $Empresas->region = $this->request->getPost("region", "string");
                $Empresas->provincia = $this->request->getPost("provincia", "string");
                $Empresas->distrito = $this->request->getPost("distrito", "string");
                $Empresas->ubigeo = $this->request->getPost("ubigeo", "string");
                $Empresas->referencia = $this->request->getPost("referencia", "string");

                if ($this->request->getPost("tipo", "int") == "") {
                    $Empresas->tipo = null;
                } else {
                    $Empresas->tipo = $this->request->getPost("tipo", "int");
                }

                $boleta = $this->request->getPost("boleta", "string");
                if (isset($boleta)) {
                    $Empresas->boleta = "1";
                } else {
                    $Empresas->boleta = "0";
                }

                $factura = $this->request->getPost("factura", "string");
                if (isset($factura)) {
                    $Empresas->factura = "1";
                } else {
                    $Empresas->factura = "0";
                }

                $rnp = $this->request->getPost("rnp", "string");
                if (isset($rnp)) {
                    $Empresas->rnp = "1";
                } else {
                    $Empresas->rnp = "0";
                }

                $mype = $this->request->getPost("mype", "string");
                if (isset($mype)) {
                    $Empresas->mype = "1";
                } else {
                    $Empresas->mype = "0";
                }

                $entidad_publica = $this->request->getPost("entidad_publica", "string");
                if (isset($entidad_publica)) {
                    $Empresas->entidad_publica = "1";
                } else {
                    $Empresas->entidad_publica = "0";
                }

                $imagen = $this->request->getPost("imagen", "string");
                if ($imagen) {
                    $Empresas->imagen = $this->request->getPost("imagen", "string");
                } else {

                    $imagen = $_FILES['imagen']['name'];
                    if ($imagen == "") {

                        $Empresas->imagen = null;
                    } else {
                        $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                        $file_imagen = $_FILES['imagen']['name'];
                        $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                        if (in_array($extension, $formatos_imagenes)) {
                            $Empresas->imagen = "imagen" . $extension;
                        } else {
                            $this->response->setJsonContent(array("say" => "error_imagen"));
                            $this->response->send();
                            exit();
                        }
                    }
                }

                //archivo_ruc
                $archivo_ruc = $this->request->getPost("archivo_ruc", "string");
                if ($archivo_ruc) {
                    $Empresas->archivo_ruc = $this->request->getPost("archivo_ruc", "string");
                } else {

                    $archivo_ruc = $_FILES['archivo_ruc']['name'];
                    if ($archivo_ruc == "") {

                        $Empresas->archivo_ruc = null;
                    } else {
                        $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                        $file_archivo = $_FILES['archivo_ruc']['name'];
                        $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                        if (in_array($extension, $formatos_archivo)) {
                            $Empresas->archivo_ruc = "archivo_ruc" . $extension;
                        } else {
                            $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                            $this->response->send();
                            exit();
                        }
                    }
                }

                //archivo_rnp
                $archivo_rnp = $this->request->getPost("archivo_rnp", "string");
                if ($archivo_rnp) {
                    $Empresas->archivo_rnp = $this->request->getPost("archivo_rnp", "string");
                } else {

                    $archivo_rnp = $_FILES['archivo_rnp']['name'];
                    if ($archivo_rnp == "") {

                        $Empresas->archivo_rnp = null;
                    } else {
                        $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                        $file_archivo = $_FILES['archivo_rnp']['name'];
                        $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                        if (in_array($extension, $formatos_archivo)) {
                            $Empresas->archivo_rnp = "archivo_rnp" . $extension;
                        } else {
                            $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                            $this->response->send();
                            exit();
                        }
                    }
                }
                //

                if ($Empresas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empresas->getMessages());
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
                                        if (isset($Empresas->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/empresas/' . $Empresas->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/empresas/' . 'IMG' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->imagen = 'IMG' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/empresas/' . 'IMG' . '-' . $Empresas->id_empresa . '.' . $extension;
                                            $Empresas->imagen = 'IMG' . '-' . $Empresas->id_empresa . '.' . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                if ($_FILES['archivo_ruc']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_ruc']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo_ruc)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo_ruc;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo_ruc = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo_ruc = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_rnp
                            if ($file->getKey() == "archivo_rnp") {

                                if ($_FILES['archivo_rnp']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_rnp']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo_rnp;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo_rnp = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo_rnp = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Empresas->save();
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

    //cambiar contraseña empresa
    public function cambiarcontrasenha4Action()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha4.js?v=" . uniqid() . "");

        //$usuarios_admin = Usuario::findFirstByid($this->session->get("auth")["usuario_id"]);
        //$this->assets->addJs("adminpanel/js/modulos/secretaria_general.js?v=" . uniqid() . "");
        //$this->view->usuarios = $usuarios_admin;
    }

    //Cambiar contraseña empresas
    public function save_contrasenha4Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            //echo '<pre>';
            //print_r($this->session->get("auth")["usuario_id"]);
            //exit();

            $where = "estado = 'A' AND id_empresa = " . $this->session->get("auth")["id_empresa"] . "";

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();
            //echo '<pre>';
            //print_r($where);
            //exit();

            $user = Empresas::findFirst($where);
            $pass = $user->password;

            //echo '<pre>';
            //print_r("contraseña:".$user->password);
            //exit();

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $this->session->set('auth', [
                    'id_empresa' => $user->codigo,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {
                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->password = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //cammbiar contraseña empresas
    public function cambiarcontrasenha5Action()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();

        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha5.js?v=" . uniqid() . "");

        //$usuarios_admin = Usuario::findFirstByid($this->session->get("auth")["usuario_id"]);
        //$this->assets->addJs("adminpanel/js/modulos/secretaria_general.js?v=" . uniqid() . "");
        //$this->view->usuarios = $usuarios_admin;
    }

    //Cambiar contraseña empresas
    public function save_contrasenha5Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            //echo '<pre>';
            //print_r($this->session->get("auth")["usuario_id"]);
            //exit();

            $where = " estado = 'A' AND codigo = " . $this->session->get("auth")["codigo"] . "";

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();
            //echo '<pre>';
            //print_r($where);
            //exit();

            $user = Publico::findFirst($where);
            $pass = $user->password;

            //echo '<pre>';
            //print_r("contraseña:".$user->password);
            //exit();

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $this->session->set('auth', [
                    'codigo' => $user->codigo,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {
                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->password = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //Cambiar contrasenia colegiados
    public function cambiarcontrasenha6Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha6.js?v=" . uniqid() . "");

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();
    }

    //fin
    //Guarda cambiar contraseña
    public function save_contrasenha6Action()
    {

        //echo '<pre>';
        //print_r('Hola Mundo');
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            $codigo_colegiado = $this->session->get('auth')['codigo'];

            $where = " estado = 'A' AND codigo = $codigo_colegiado";

            //echo '<pre>';
            //print_r($_SESSION);
            //exit();

            $user = Colegiados::findFirst($where);

            //echo '<pre>';
            //print_r($user->password);
            //exit();

            $pass = $user->password;

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $this->session->set('auth', [
                    'codigo' => $user->codigo,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {
                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->password = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //Vista administrativo
    public function administrativoAction()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();
        //echo '<pre>';
        //print_r($this->session->get("auth")["usuario_id"]);
        //exit();
        $Personal = Personal::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->personal = $Personal;

        //TipoDocumento
        $tipo_documento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documento;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //religion
        $religion = Religion::find("estado = 'A' AND numero = 75 ");
        $this->view->religiones = $religion;

        //Sexo
        $sexo_personal = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo_personal = $sexo_personal;

        //documento_familiar
        $tipo_documento_familiares = TipoDocumentoFamiliares::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos_familiares = $tipo_documento_familiares;

        //parentesco_familiar
        $parentesco_familiares = ParentescoFamiliares::find("estado = 'A' AND numero = 27 ");
        $this->view->parentesco_familiares = $parentesco_familiares;

        //sexo_familiares
        $sexo_familiares = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo_familiares = $sexo_familiares;

        //estado_civil_familiares
        $estado_civil_familiares = EstadoCivilFamiliares::find("estado = 'A' AND numero = 26 ");
        $this->view->estado_civil_familiares = $estado_civil_familiares;

        //grado_instruccion_familiar
        $grado_instruccion_familiar = GradoInstruccionFamiliares::find("estado = 'A' AND numero = 28 ");
        $this->view->grado_instruccion_familiares = $grado_instruccion_familiar;

        $this->assets->addJs("adminpanel/js/modulos/datos.administrativo.js?v=" . uniqid() . "");
        $this->assets->addJs("adminpanel/js/modulos/registropersonal.familiares.js?v=" . uniqid() . "");
    }

    //Guardar administrativo
    public function saveAdministrativoAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Personal = Personal::findFirstBycodigo($id);
                //Valida cuando es nuevo
                $Personal = (!$Personal) ? new Personal() : $Personal;

                $Personal->codigo = $this->request->getPost("codigo", "int");

                //nombres
                //$Personal->nombres = $this->request->getPost("nombres", "string");
                //apellidop
                //$Personal->apellidop = $this->request->getPost("apellidop", "string");
                //apellidom
                //$Personal->apellidom = $this->request->getPost("apellidom", "string");
                //email
                $Personal->email = $this->request->getPost("email", "string");

                //email1
                //$Personal->email1 = $this->request->getPost("email1", "string");
                //grado
                $Personal->grado = $this->request->getPost("grado", "string");

                //grado_universidad
                $Personal->grado_universidad = $this->request->getPost("grado_universidad", "string");

                //titulo
                $Personal->titulo = $this->request->getPost("titulo", "string");

                //titulo_universidad
                $Personal->titulo_universidad = $this->request->getPost("titulo_universidad", "string");

                //grado_abreviado
                $Personal->grado_abreviado = $this->request->getPost("grado_abreviado", "string");

                //concytec_enlace
                $Personal->concytec_enlace = $this->request->getPost("concytec_enlace", "string");

                //peru_enlace
                $Personal->peru_enlace = $this->request->getPost("peru_enlace", "string");

                //direccion actual
                $Personal->direccion_actual = $this->request->getPost("direccion_actual", "string");

                //direccion procedencia
                $Personal->direccion_procedencia = $this->request->getPost("direccion_procedencia", "string");

                //fecha_ingreso
                //                if ($this->request->getPost("fecha_ingreso", "string") != "") {
                //                    $fecha_ex = explode("/", $this->request->getPost("fecha_ingreso", "string"));
                //                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                //
                //                    $Personal->fecha_ingreso = date('Y-m-d', strtotime($fecha_new));
                //                }
                //lugar de nacimiento
                $Personal->lugar_nacimiento = $this->request->getPost("lugar_nacimiento", "string");

                //Estado civil
                if ($this->request->getPost("estado_civil", "int") == "") {
                    $Personal->estado_civil = null;
                } else {
                    $Personal->estado_civil = $this->request->getPost("estado_civil", "int");
                }

                //grupo sanguineo
                $Personal->grupo_sanguineo = $this->request->getPost("grupo_sanguineo", "string");

                //religion
                if ($this->request->getPost("religion", "int") == "") {
                    $Personal->religion = null;
                } else {
                    $Personal->religion = $this->request->getPost("religion", "int");
                }

                //caso emergencia llamar
                $Personal->caso_emergencia_llamar = $this->request->getPost("caso_emergencia_llamar", "string");

                //alergico_medicamentos
                $Personal->alergico_medicamentos = $this->request->getPost("alergico_medicamentos", "string");

                //telefono_emergencia
                $Personal->telefono_emergencia = $this->request->getPost("telefono_emergencia", "string");

                //enlace
                //$Personal->enlace = $this->request->getPost("enlace", "string");
                //fecha_nacimiento
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Personal->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                //documento
                //                if ($this->request->getPost("documento", "int") == "") {
                //                    $Personal->documento = null;
                //                } else {
                //                    $Personal->documento = $this->request->getPost("documento", "int");
                //                }
                //sexo
                if ($this->request->getPost("sexo", "int") == "") {
                    $Personal->sexo = null;
                } else {
                    $Personal->sexo = $this->request->getPost("sexo", "int");
                }

                //nro_doc
                //$Personal->nro_doc = $this->request->getPost("nro_doc", "string");
                //nro_cta
                $Personal->nro_cta = $this->request->getPost("nro_cta", "string");

                //cci
                $Personal->cci = $this->request->getPost("cci", "string");

                //celular
                $Personal->celular = $this->request->getPost("celular", "string");

                //visible
                //                $visible = $this->request->getPost("visible", "string");
                //                if (isset($visible)) {
                //                    $Personal->visible = 1;
                //                } else {
                //                    $Personal->visible = 0;
                //                }
                //
                //                //estado
                //                $estado = $this->request->getPost("estado", "string");
                //                if (isset($estado)) {
                //                    $Personal->estado = "A";
                //                } else {
                //                    $Personal->estado = "X";
                //                }

                if ($Personal->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Personal->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            if ($file->getKey() == "imagen") {

                                //$file->getName() = $Personal->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Personal->codigo . "-" . $file->getName();
                                $url_destino = 'adminpanel/imagenes/personal/' . 'IMG' . '-' . $Personal->codigo . '.jpg';

                                if (!$file->moveTo($url_destino)) {

                                } else {
                                    //$Personal->imagen = $Personal->codigo . "-" . $file->getName();
                                    $Personal->imagen = 'IMG' . '-' . $Personal->codigo . ".jpg";
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_personal") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                $url_destino = 'adminpanel/archivos/personal/' . 'FILE' . '-' . $Personal->codigo . '.pdf';

                                $Personal->archivo = 'FILE' . '-' . $Personal->codigo . '.pdf';

                                if (!$file->moveTo($url_destino)) {

                                }
                            }
                        }

                        $Personal->save();
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

    //vista postulantes
    public function postulanteAction()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();
        //echo '<pre>';
        //print_r($this->session->get("auth")["usuario_id"]);
        //exit();
        $Personal = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->assets->addJs("adminpanel/js/modulos/datos.postulante.js?v=" . uniqid() . "");
        $this->view->postulantes = $Personal;

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
    }

    //guarda datos postulante
    public function save_postulanteAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Empresa = Publico::findFirstBycodigo($id);
                $Empresa = (!$Empresa) ? new Postulantes() : $Empresa;

                $Empresa->codigo = $this->request->getPost("codigo", "int");

                $Empresa->sexo = $this->request->getPost("sexo", "string");
                $Empresa->documento = $this->request->getPost("documento", "int");
                $Empresa->nro_doc = $this->request->getPost("nro_doc", "string");

                $Empresa->telefono = $this->request->getPost("telefono", "string");
                $Empresa->celular = $this->request->getPost("celular", "string");

                $Empresa->nombres = $this->request->getPost("nombres", "string");
                $Empresa->apellidop = $this->request->getPost("apellidop", "string");
                $Empresa->apellidom = $this->request->getPost("apellidom", "string");

                $Empresa->direccion = $this->request->getPost("direccion", "string");
                $Empresa->ciudad = $this->request->getPost("ciudad", "string");

                $Empresa->email = $this->request->getPost("email", "string");
                $Empresa->seguro = $this->request->getPost("seguro", "int");

                //->Ubigeo
                $Empresa->region = $this->request->getPost("region");
                $Empresa->provincia = $this->request->getPost("provincia");
                $Empresa->distrito = $this->request->getPost("distrito");
                $Empresa->ubigeo = $this->request->getPost("ubigeo");

                //->lugar de procedencia
                $Empresa->region1 = $this->request->getPost("region1");
                $Empresa->provincia1 = $this->request->getPost("provincia1");
                $Empresa->distrito1 = $this->request->getPost("distrito1");
                $Empresa->ubigeo1 = $this->request->getPost("ubigeo1");

                if ($this->request->getPost("estado_civil", "int") == "") {
                    $Empresa->estado_civil = null;
                } else {
                    $Empresa->estado_civil = $this->request->getPost("estado_civil", "int");
                }

                //$Empresa->nro_dependientes = 1;
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Empresa->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                //$Empresa->fechamod1 = date('Y-m-d', strtotime($fecha_modificacion));\
                //Sexo
                if ($this->request->getPost("sexo", "int") == "") {
                    $Empresa->sexo = null;
                } else {
                    $Empresa->sexo = $this->request->getPost("sexo", "int");
                }

                $Empresa->observaciones = $this->request->getPost("observaciones", "string");

                //password graba codigo
                //$colegiados_password = $this->request->getPost("codigo", "int");
                //$Empresa->password = $this->security->hash($colegiados_password);

                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {
                    $Empresa->colegio_publico = 1;
                } else {

                    $Empresa->colegio_publico = 0;
                }
                $Empresa->colegio_nombre = $this->request->getPost("colegio_nombre", "string");

                $sitrabaja = $this->request->getPost("sitrabaja", "string");
                if (isset($sitrabaja)) {
                    $Empresa->sitrabaja = 1;
                } else {

                    $Empresa->sitrabaja = 0;
                }
                $Empresa->sitrabaja_nombre = $this->request->getPost("sitrabaja_nombre", "string");

                $sidepende = $this->request->getPost("sidepende", "string");
                if (isset($sidepende)) {
                    $Empresa->sidepende = 1;
                } else {

                    $Empresa->sidepende = 0;
                }
                $Empresa->sidepende_nombre = $this->request->getPost("sidepende_nombre", "string");

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {
                    $Empresa->discapacitado = 1;
                } else {

                    $Empresa->discapacitado = 0;
                }
                $Empresa->discapacitado_nombre = $this->request->getPost("discapacitado_nombre", "string");

                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Empresa->estado = "A";
                } else {

                    //echo '<pre>';
                    //print_r("No ha chequeado");
                    //xit();

                    $Empresa->estado = "A";
                }

                if ($Empresa->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empresa->getMessages());
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

                                    if (isset($Empresa->foto)) {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . $Empresa->foto;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Empresa->codigo . '-' . $temporal_rand . '.jpg';
                                        $Empresa->foto = 'IMG' . '-' . $Empresa->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Empresa->codigo . '.jpg';
                                        $Empresa->foto = 'IMG' . '-' . $Empresa->codigo . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Empresa->imagen = $Empresa->codigo . "-" . $file->getName();
                                        //$Empresa->imagen = 'IMG' . '-' . $Empresa->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($Empresa->foto)) {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . $Empresa->foto;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Empresa->codigo . '-' . $temporal_rand . '.png';
                                        $Empresa->foto = 'IMG' . '-' . $Empresa->codigo . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $Empresa->codigo . '.png';
                                        $Empresa->foto = 'IMG' . '-' . $Empresa->codigo . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Empresa->imagen = $Empresa->codigo . "-" . $file->getName();
                                        //$Empresa->imagen = 'IMG' . '-' . $Empresa->codigo . ".jpg";
                                    }
                                }
                            }

                            //archivo
                        }

                        $Empresa->save();
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

    //vista colegiados
    public function colegiadoAction()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();
        //echo '<pre>';
        //print_r($this->session->get("auth")["usuario_id"]);
        //exit();
        $Colegiado = Colegiados::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->assets->addJs("adminpanel/js/modulos/datos.colegiado.js?v=" . uniqid() . "");
        $this->view->colegiados = $Colegiado;

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

    //guarda datos colegiados
    public function save_colegiadoAction()
    {

        //echo "<pre>";
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
                $Colegiados->nro_doc = $this->request->getPost("nro_doc", "string");

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

    //--------------------------alumnosficha-------------------------------------

    public function alumnosfichaAction()
    {

        $obj = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $obj;

        $semestre_a = Semestres::findFirst("activo = 'M'");
        $this->view->semestrea = $semestre_a->codigo;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;

        //Modelo Semestre (a_codigos)
        $semestres = Semestres::find("estado <> 'X'");
        $this->view->semestres = $semestres;

        //Modelo Programa de estudios
        $programas = Programas::find("estado = 'A'");
        $this->view->programas = $programas;

        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //Modelo alumnos_ficha
        //$alumnos_ficha = Alumnosficha::findFirstByalumno((int) $id);
        $alumnos_ficha = AlumnosFicha::findFirst("alumno='{$obj->codigo}' AND semestre = {$semestre_a->codigo} ");

//        echo "<pre>";
        //        print_r($alumnos_ficha->peso);
        //        exit();

        $this->view->alumnos_ficha = $alumnos_ficha;

        //Modelo de vivienda
        $viviendas = Viviendas::find("estado = 'A' AND numero = 29");
        $this->view->viviendas = $viviendas;

        //Modelo Tipo de vivienda
        $tipoviviendas = TipoViviendas::find("estado = 'A' AND numero = 30");
        $this->view->tipoviviendas = $tipoviviendas;

        //Modelo material de la vivienda
        $materialviviendas = Materialviviendas::find("estado = 'A' AND numero = 31");
        $this->view->materialviviendas = $materialviviendas;

        //Modelos material techo vivienda
        $materialtechoviviendas = MaterialTechoViviendas::find("estado = 'A' AND numero = 32");
        $this->view->materialtechoviviendas = $materialtechoviviendas;

        //Region para ubigeo
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //Modelo Composicion nuclear (a_codigos)
        $composiciones = Composiciones::find("estado = 'A' AND numero = 24");
        $this->view->composiciones = $composiciones;

        //Modelo sexoalumnos(a_codigos)
        $sexofamiliares = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexofamiliares = $sexofamiliares;

        //Modelo sexoalumnos(a_codigos)
        $parentescos = Parentescos::find("estado = 'A' AND numero = 27 ");
        $this->view->parentescos = $parentescos;

        //Modelo docuementos(a_codigos)
        $documentofamiliares = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentofamiliares = $documentofamiliares;

        //Modelo docuementos(a_codigos)
        $gradoinstruccionfamiliares = GradoInstruccionFamiliares::find("estado = 'A' AND numero = 28 ");
        $this->view->gradoinstruccionfamiliares = $gradoinstruccionfamiliares;

        //Modelo Estado civil familiares
        $estadocivilfamiliares = EstadoCivilFamiliares::find("estado = 'A' AND numero = 26");
        $this->view->estado_civil_familiares = $estadocivilfamiliares;

        //modalidad_estudios nuevos campos
        $ModalidadEstudios = ModalidadEstudios::find("estado = 'A' AND numero = 77");
        $this->view->modalidadestudios = $ModalidadEstudios;

        //local
        $Local = Locales::find("estado = 'A'");
        $this->view->locales = $Local;

        //vivienda_material_piso
        $ViviendaMaterialPiso = ViviendaMaterialPiso::find("estado = 'A' AND numero = 79");
        $this->view->viviendamaterialpiso = $ViviendaMaterialPiso;

        //vivienda_material_pared
        $ViviendaMaterialPared = ViviendaMaterialPared::find("estado = 'A' AND numero = 78");
        $this->view->viviendamaterialpared = $ViviendaMaterialPared;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //alumnosficha
        $this->assets->addJs("adminpanel/js/modulos/datos.alumnosficha.js?v=" . uniqid() . "");
    }

    public function saveAlumnosfichaAction()
    {

//        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
//------------------------tabla: alumnos----------------------------------------

                $id = (string) $this->request->getPost("codigo", "string");
                $Alumnos = Alumnos::findFirstBycodigo($id);
                $Alumnos = (!$Alumnos) ? new Alumnos() : $Alumnos;

                //codigo
                //tipo
                //semestre
                //semestre_egreso
                //carrera
                //apellidop
                $Alumnos->apellidop = $this->request->getPost("apellidop", "string");

                //apellidom
                $Alumnos->apellidom = $this->request->getPost("apellidom", "string");

                //nombres
                $Alumnos->nombres = $this->request->getPost("nombres", "string");

                //Sexo
                //cv
                //region
                $Alumnos->region = $this->request->getPost("region");

                //provincia
                $Alumnos->provincia = $this->request->getPost("provincia");

                //distrito
                $Alumnos->distrito = $this->request->getPost("distrito");

                //ubigeo
                $Alumnos->ubigeo = $this->request->getPost("ubigeo");

                //fecha_nacimiento
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Alumnos->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                //documento
                //nro_doc
                $Alumnos->nro_doc = $this->request->getPost("nro_doc", "string");

                //fecha_ingreso
                //seguro
                if ($this->request->getPost("seguro", "int") == "") {
                    $Alumnos->seguro = null;
                } else {
                    $Alumnos->seguro = $this->request->getPost("seguro", "int");
                }

                //telefono
                $Alumnos->telefono = $this->request->getPost("telefono", "string");

                //celular
                $Alumnos->celular = $this->request->getPost("celular", "string");

                //email
                $Alumnos->email = $this->request->getPost("email", "string");

                //email1
                $Alumnos->email1 = $this->request->getPost("email1", "string");

                //direccion
                $Alumnos->direccion = $this->request->getPost("direccion", "string");

                //ciudad
                $Alumnos->ciudad = $this->request->getPost("ciudad", "string");

                //observaciones
                //foto
                //traslado
                //certificado_u
                //constancia_i
                //certificado_c
                //dni
                //partida_n
                //colegio_publico
                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {

                    $Alumnos->colegio_publico = 1;
                } else {

                    $Alumnos->colegio_publico = 0;
                }
                //colegio_nombre
                $Alumnos->colegio_nombre = $this->request->getPost("colegio_nombre", "string");

                //colegio_anio
                if ($this->request->getPost("colegio_anio", "int") == "") {
                    $Alumnos->colegio_anio = null;
                } else {
                    $Alumnos->colegio_anio = $this->request->getPost("colegio_anio", "int");
                }

                //sitrabaja
                $Alumnos->sitrabaja = $this->request->getPost("sitrabaja", "string");

                //sitrabaja_nombre
                $Alumnos->sitrabaja_nombre = $this->request->getPost("sitrabaja_nombre", "string");

                //sidepende
                $Alumnos->sidepende = $this->request->getPost("sidepende", "string");

                //sidepende_nombre
                $Alumnos->sidepende_nombre = $this->request->getPost("sidepende_nombre", "string");

                //graduado
                //titulado
                //discapacitado
                $discapacitado = $this->request->getPost("discapacitado", "string");

                if (isset($discapacitado)) {

                    $Alumnos->discapacitado = 1;
                } else {

                    $Alumnos->discapacitado = 0;
                }

                //envio
                //activo
                //estado
                $Alumnos->estado = "A";

                //referencia
                $Alumnos->referencia = "-";

                //discapacitado_nombre
                $Alumnos->discapacitado_nombre = $this->request->getPost("discapacitado_nombre", "string");

                //region1
                $Alumnos->region1 = $this->request->getPost("region1");

                //provincia1
                $Alumnos->provincia1 = $this->request->getPost("provincia1");

                //distrito1
                $Alumnos->distrito1 = $this->request->getPost("distrito1");

                //ubigeo1
                $Alumnos->ubigeo1 = $this->request->getPost("ubigeo1");

                //localidad
                $Alumnos->localidad = $this->request->getPost("localidad");

                //idioma
                //                if ($this->request->getPost("idioma", "int") == "") {
                //                    $Alumnos->idioma = null;
                //                } else {
                //                    $Alumnos->idioma = $this->request->getPost("idioma", "int");
                //                }
                //archivo
                //nro_seguro

                if ($this->request->getPost("identidad_etnica", "int") == "") {
                    $Alumnos->identidad_etnica = null;
                } else {
                    $Alumnos->identidad_etnica = $this->request->getPost("identidad_etnica", "int");
                }

                //tipo_discapacidad
                if ($this->request->getPost("tipo_discapacidad", "int") == "") {
                    $Alumnos->tipo_discapacidad = null;
                } else {
                    $Alumnos->tipo_discapacidad = $this->request->getPost("tipo_discapacidad", "int");
                }

                //fecha_egreso
                //modalidad_ingreso
                //                if ($this->request->getPost("modalidad_ingreso", "int") == "") {
                //                    $Alumnos->modalidad_ingreso = null;
                //                } else {
                //                    $Alumnos->modalidad_ingreso = $this->request->getPost("modalidad_ingreso", "int");
                //                }
                //sitrabaja_actividad
                $Alumnos->sitrabaja_actividad = $this->request->getPost("sitrabaja_actividad", "string");

                //violencia_sociopolitica
                $violencia_sociopolitica = $this->request->getPost("violencia_sociopolitica", "string");
                if (isset($violencia_sociopolitica)) {

                    $Alumnos->violencia_sociopolitica = 1;
                } else {

                    $Alumnos->violencia_sociopolitica = 0;
                }

                //violencia_sociopolitica_registro
                $Alumnos->violencia_sociopolitica_registro = $this->request->getPost("violencia_sociopolitica_registro", "string");

                //estado_civil
                if ($this->request->getPost("estado_civil", "int") == "") {
                    $Alumnos->estado_civil = null;
                } else {
                    $Alumnos->estado_civil = $this->request->getPost("estado_civil", "int");
                }
//---------------------------------fin tabla alumnos----------------------------

                if ($Alumnos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Alumnos->getMessages());
                } else {

//---------------------------------tabla: alumnos_ficha-------------------------

                    $alumno = $Alumnos->codigo;
                    $semestre = $this->request->getPost("semestre_select");

                    //print("Semestre:".$semestre);
                    //exit();

                    $AlumnosFicha = AlumnosFicha::findFirst(
                        [
                            "alumno = '{$alumno}' AND semestre = {$semestre}",
                        ]
                    );
                    $AlumnosFicha = (!$AlumnosFicha) ? new AlumnosFicha() : $AlumnosFicha;

                    //alumno
                    $AlumnosFicha->alumno = $Alumnos->codigo;

                    //semestre
                    $AlumnosFicha->semestre = $this->request->getPost("semestre_select", "int");

                    //fecha_ficha
                    $AlumnosFicha->fecha_ficha = date("Y-m-d");

                    //peso
                    $AlumnosFicha->peso = $this->request->getPost("peso", "string");

                    //talla
                    $AlumnosFicha->talla = $this->request->getPost("talla", "string");

                    //edad
                    if ($this->request->getPost("edad", "int") == "") {
                        $AlumnosFicha->edad = null;
                    } else {
                        $AlumnosFicha->edad = $this->request->getPost("edad", "int");
                    }

                    //nro_hijos
                    if ($this->request->getPost("nro_hijos", "string") == "") {
                        $AlumnosFicha->nro_hijos = null;
                    } else {
                        $AlumnosFicha->nro_hijos = $this->request->getPost("nro_hijos", "string");
                    }

                    //ingresos_papa
                    $AlumnosFicha->ingresos_papa = $this->request->getPost("ingresos_papa", "string");

                    //ingresos_mama
                    $AlumnosFicha->ingresos_mama = $this->request->getPost("ingresos_mama", "string");

                    //ingresos_hnos
                    $AlumnosFicha->ingresos_hnos = $this->request->getPost("ingresos_hnos", "string");

                    //ingresos_personal
                    $AlumnosFicha->ingresos_personal = $this->request->getPost("ingresos_personal", "string");

                    //egresos_vivienda
                    $AlumnosFicha->egresos_vivienda = $this->request->getPost("egresos_vivienda", "string");

                    //egresos_alimentacion
                    $AlumnosFicha->egresos_alimentacion = $this->request->getPost("egresos_alimentacion", "string");

                    //egresos_luz
                    $AlumnosFicha->egresos_luz = $this->request->getPost("egresos_luz", "string");

                    //egresos_agua
                    $AlumnosFicha->egresos_agua = $this->request->getPost("egresos_agua", "string");

                    //egresos_gas
                    $AlumnosFicha->egresos_gas = $this->request->getPost("egresos_gas", "string");

                    //egresos_materiales_estudio
                    $AlumnosFicha->egresos_materiales_estudio = $this->request->getPost("egresos_materiales_estudio", "string");

                    //egresos_materiales_aseo
                    $AlumnosFicha->egresos_materiales_aseo = $this->request->getPost("egresos_materiales_aseo", "string");

                    //egresos_internet
                    $AlumnosFicha->egresos_internet = $this->request->getPost("egresos_internet", "string");

                    //egresos_pasajes
                    $AlumnosFicha->egresos_pasajes = $this->request->getPost("egresos_pasajes", "string");

                    //egresos_cable_tv
                    $AlumnosFicha->egresos_cable_tv = $this->request->getPost("egresos_cable_tv", "string");

                    //egresos_prestamos
                    $AlumnosFicha->egresos_prestamos = $this->request->getPost("egresos_prestamos", "string");

                    //egresos_ocio_recreacion
                    $AlumnosFicha->egresos_ocio_recreacion = $this->request->getPost("egresos_ocio_recreacion", "string");

                    //estudios_ayuda
                    $estudios_ayuda = $this->request->getPost("estudios_ayuda", "string");
                    if (isset($estudios_ayuda)) {

                        $AlumnosFicha->estudios_ayuda = 1;
                    } else {

                        $AlumnosFicha->estudios_ayuda = 0;
                    }

                    //estudios_ayuda_nombre
                    $AlumnosFicha->estudios_ayuda_nombre = $this->request->getPost("estudios_ayuda_nombre", "string");

                    //estudios_horas
                    if ($this->request->getPost("estudios_horas", "int") == "") {
                        $AlumnosFicha->estudios_horas = null;
                    } else {
                        $AlumnosFicha->estudios_horas = $this->request->getPost("estudios_horas", "int");
                    }

                    //estudios_lugar
                    $AlumnosFicha->estudios_lugar = $this->request->getPost("estudios_lugar", "string");

                    //horas_ocio_recreacion
                    if ($this->request->getPost("horas_ocio_recreacion", "int") == "") {
                        $AlumnosFicha->horas_ocio_recreacion = null;
                    } else {
                        $AlumnosFicha->horas_ocio_recreacion = $this->request->getPost("horas_ocio_recreacion", "int");
                    }

                    //observaciones
                    $AlumnosFicha->observaciones = $this->request->getPost("observaciones_ficha", "string");

                    //moto
                    $moto = $this->request->getPost("moto", "string");
                    if (isset($moto)) {

                        $AlumnosFicha->moto = 1;
                    } else {

                        $AlumnosFicha->moto = 0;
                    }

                    //laptop
                    $laptop = $this->request->getPost("laptop", "string");
                    if (isset($laptop)) {

                        $AlumnosFicha->laptop = 1;
                    } else {

                        $AlumnosFicha->laptop = 0;
                    }

                    //cocina
                    $cocina = $this->request->getPost("cocina", "string");
                    if (isset($cocina)) {

                        $AlumnosFicha->cocina = 1;
                    } else {

                        $AlumnosFicha->cocina = 0;
                    }

                    //hervidora
                    $hervidora = $this->request->getPost("hervidora", "string");
                    if (isset($hervidora)) {

                        $AlumnosFicha->hervidora = 1;
                    } else {

                        $AlumnosFicha->hervidora = 0;
                    }

                    //mesa
                    $mesa = $this->request->getPost("mesa", "string");
                    if (isset($mesa)) {

                        $AlumnosFicha->mesa = 1;
                    } else {

                        $AlumnosFicha->mesa = 0;
                    }

                    //silla
                    $silla = $this->request->getPost("silla", "string");
                    if (isset($silla)) {

                        $AlumnosFicha->silla = 1;
                    } else {

                        $AlumnosFicha->silla = 0;
                    }

                    //nro_cuartos
                    if ($this->request->getPost("nro_cuartos", "int") == "") {
                        $AlumnosFicha->nro_cuartos = null;
                    } else {
                        $AlumnosFicha->nro_cuartos = $this->request->getPost("nro_cuartos", "int");
                    }

                    //nro_personas_cuarto
                    if ($this->request->getPost("nro_personas_cuarto", "int") == "") {
                        $AlumnosFicha->nro_personas_cuarto = null;
                    } else {
                        $AlumnosFicha->nro_personas_cuarto = $this->request->getPost("nro_personas_cuarto", "int");
                    }

                    //vivienda
                    if ($this->request->getPost("vivienda", "int") == "") {
                        $AlumnosFicha->vivienda = null;
                    } else {
                        $AlumnosFicha->vivienda = $this->request->getPost("vivienda", "int");
                    }

                    //vivienda_tipo
                    if ($this->request->getPost("vivienda_tipo", "int") == "") {
                        $AlumnosFicha->vivienda_tipo = null;
                    } else {
                        $AlumnosFicha->vivienda_tipo = $this->request->getPost("vivienda_tipo", "int");
                    }

                    //vivienda_material
                    if ($this->request->getPost("vivienda_material", "int") == "") {
                        $AlumnosFicha->vivienda_material = null;
                    } else {
                        $AlumnosFicha->vivienda_material = $this->request->getPost("vivienda_material", "int");
                    }

                    //vivienda_material_techo
                    if ($this->request->getPost("vivienda_material_techo", "int") == "") {
                        $AlumnosFicha->vivienda_material_techo = null;
                    } else {
                        $AlumnosFicha->vivienda_material_techo = $this->request->getPost("vivienda_material_techo", "int");
                    }

                    //luz
                    $luz = $this->request->getPost("luz_ficha", "string");
                    if (isset($luz)) {

                        $AlumnosFicha->luz = 1;
                    } else {

                        $AlumnosFicha->luz = 0;
                    }

                    //agua
                    $agua = $this->request->getPost("agua_ficha", "string");
                    if (isset($agua)) {

                        $AlumnosFicha->agua = 1;
                    } else {

                        $AlumnosFicha->agua = 0;
                    }

                    //desague
                    $desague = $this->request->getPost("desague_ficha", "string");
                    if (isset($desague)) {

                        $AlumnosFicha->desague = 1;
                    } else {

                        $AlumnosFicha->desague = 0;
                    }

                    //telefono
                    $telefono = $this->request->getPost("telefono_ficha", "string");
                    if (isset($telefono)) {

                        $AlumnosFicha->telefono = 1;
                    } else {

                        $AlumnosFicha->telefono = 0;
                    }

                    //cable_tv
                    $cable_tv = $this->request->getPost("cable_tv_ficha", "string");
                    if (isset($cable_tv)) {

                        $AlumnosFicha->cable_tv = 1;
                    } else {

                        $AlumnosFicha->cable_tv = 0;
                    }

                    //internet_ficha
                    $internet = $this->request->getPost("internet_ficha", "string");
                    if (isset($internet)) {

                        $AlumnosFicha->internet = 1;
                    } else {

                        $AlumnosFicha->internet = 0;
                    }

                    //composicion
                    if ($this->request->getPost("composicion", "int") == "") {
                        $AlumnosFicha->composicion = null;
                    } else {
                        $AlumnosFicha->composicion = $this->request->getPost("composicion", "int");
                    }

                    //estado
                    $AlumnosFicha->estado = "A";

                    //modalidad_estudios
                    //local
                    //celular_apoderado1
                    $AlumnosFicha->celular_apoderado1 = $this->request->getPost("celular_apoderado1", "string");

                    //celular_apoderado2
                    $AlumnosFicha->celular_apoderado2 = $this->request->getPost("celular_apoderado2", "string");

                    //es_padre_familia
                    $es_padre_familia = $this->request->getPost("es_padre_familia", "string");
                    if (isset($es_padre_familia)) {

                        $AlumnosFicha->es_padre_familia = 1;
                    } else {

                        $AlumnosFicha->es_padre_familia = 0;
                    }

                    //hijos_con_quien_viven
                    $AlumnosFicha->hijos_con_quien_viven = $this->request->getPost("hijos_con_quien_viven", "string");

                    //egresos_otros
                    $AlumnosFicha->egresos_otros = $this->request->getPost("egresos_otros", "string");

                    //cama
                    $cama = $this->request->getPost("cama", "string");
                    if (isset($cama)) {

                        $AlumnosFicha->cama = 1;
                    } else {

                        $AlumnosFicha->cama = 0;
                    }

                    //tv
                    $tv = $this->request->getPost("tv", "string");
                    if (isset($tv)) {

                        $AlumnosFicha->tv = 1;
                    } else {

                        $AlumnosFicha->tv = 0;
                    }

                    //pc
                    $pc = $this->request->getPost("pc", "string");
                    if (isset($pc)) {

                        $AlumnosFicha->pc = 1;
                    } else {

                        $AlumnosFicha->pc = 0;
                    }

                    //nro_ambientes
                    if ($this->request->getPost("nro_ambientes", "int") == "") {
                        $AlumnosFicha->nro_ambientes = null;
                    } else {
                        $AlumnosFicha->nro_ambientes = $this->request->getPost("nro_ambientes", "int");
                    }

                    //otros_servicios
                    $otros_servicios = $this->request->getPost("otros_servicios", "string");
                    if (isset($otros_servicios)) {

                        $AlumnosFicha->otros_servicios = 1;
                    } else {

                        $AlumnosFicha->otros_servicios = 0;
                    }

                    //celular
                    $celular = $this->request->getPost("celular", "string");
                    if (isset($celular)) {

                        $AlumnosFicha->celular = 1;
                    } else {

                        $AlumnosFicha->celular = 0;
                    }

                    //beca_permanencia
                    $beca_permanencia = $this->request->getPost("beca_permanencia", "string");
                    if (isset($beca_permanencia)) {

                        $AlumnosFicha->beca_permanencia = 1;
                    } else {

                        $AlumnosFicha->beca_permanencia = 0;
                    }

                    //beca_completa_alimentacion
                    $beca_completa_alimentacion = $this->request->getPost("beca_completa_alimentacion", "string");
                    if (isset($beca_completa_alimentacion)) {

                        $AlumnosFicha->beca_completa_alimentacion = 1;
                    } else {

                        $AlumnosFicha->beca_completa_alimentacion = 0;
                    }

                    //subvencionada_alimentacion
                    $subvencionada_alimentacion = $this->request->getPost("subvencionada_alimentacion", "string");
                    if (isset($subvencionada_alimentacion)) {

                        $AlumnosFicha->subvencionada_alimentacion = 1;
                    } else {

                        $AlumnosFicha->subvencionada_alimentacion = 0;
                    }

                    //acceso_internet_celular
                    $acceso_internet_celular = $this->request->getPost("acceso_internet_celular", "string");
                    if (isset($acceso_internet_celular)) {

                        $AlumnosFicha->acceso_internet_celular = 1;
                    } else {

                        $AlumnosFicha->acceso_internet_celular = 0;
                    }

                    //acceso_internet_vivienda
                    $acceso_internet_vivienda = $this->request->getPost("acceso_internet_vivienda", "string");
                    if (isset($acceso_internet_vivienda)) {

                        $AlumnosFicha->acceso_internet_vivienda = 1;
                    } else {

                        $AlumnosFicha->acceso_internet_vivienda = 0;
                    }

                    //acceso_internet_cabina
                    $acceso_internet_cabina = $this->request->getPost("acceso_internet_cabina", "string");
                    if (isset($acceso_internet_cabina)) {

                        $AlumnosFicha->acceso_internet_cabina = 1;
                    } else {

                        $AlumnosFicha->acceso_internet_cabina = 0;
                    }

                    //acceso_internet_universidad
                    $acceso_internet_universidad = $this->request->getPost("acceso_internet_universidad", "string");
                    if (isset($acceso_internet_universidad)) {

                        $AlumnosFicha->acceso_internet_universidad = 1;
                    } else {

                        $AlumnosFicha->acceso_internet_universidad = 0;
                    }

                    //acceso_internet_otros
                    $acceso_internet_otros = $this->request->getPost("acceso_internet_otros", "string");
                    if (isset($acceso_internet_otros)) {

                        $AlumnosFicha->acceso_internet_otros = 1;
                    } else {

                        $AlumnosFicha->acceso_internet_otros = 0;
                    }

                    //uso_internet_laptop_propia
                    $uso_internet_laptop_propia = $this->request->getPost("uso_internet_laptop_propia", "string");
                    if (isset($uso_internet_laptop_propia)) {

                        $AlumnosFicha->uso_internet_laptop_propia = 1;
                    } else {

                        $AlumnosFicha->uso_internet_laptop_propia = 0;
                    }

                    //uso_internet_laptop_prestada
                    $uso_internet_laptop_prestada = $this->request->getPost("uso_internet_laptop_prestada", "string");
                    if (isset($uso_internet_laptop_prestada)) {

                        $AlumnosFicha->uso_internet_laptop_prestada = 1;
                    } else {

                        $AlumnosFicha->uso_internet_laptop_prestada = 0;
                    }

                    //uso_internet_pc
                    $uso_internet_pc = $this->request->getPost("uso_internet_pc", "string");
                    if (isset($uso_internet_pc)) {

                        $AlumnosFicha->uso_internet_pc = 1;
                    } else {

                        $AlumnosFicha->uso_internet_pc = 0;
                    }

                    //uso_internet_celular_plan
                    $uso_internet_celular_plan = $this->request->getPost("uso_internet_celular_plan", "string");
                    if (isset($uso_internet_celular_plan)) {

                        $AlumnosFicha->uso_internet_celular_plan = 1;
                    } else {

                        $AlumnosFicha->uso_internet_celular_plan = 0;
                    }

                    //uso_internet_celular_recarga
                    $uso_internet_celular_recarga = $this->request->getPost("uso_internet_celular_recarga", "string");
                    if (isset($uso_internet_celular_recarga)) {

                        $AlumnosFicha->uso_internet_celular_recarga = 1;
                    } else {

                        $AlumnosFicha->uso_internet_celular_recarga = 0;
                    }

                    //uso_internet_celular_prestado
                    $uso_internet_celular_prestado = $this->request->getPost("uso_internet_celular_prestado", "string");
                    if (isset($uso_internet_celular_prestado)) {

                        $AlumnosFicha->uso_internet_celular_prestado = 1;
                    } else {

                        $AlumnosFicha->uso_internet_celular_prestado = 0;
                    }

                    //uso_internet_tablet
                    $uso_internet_tablet = $this->request->getPost("uso_internet_tablet", "string");
                    if (isset($uso_internet_tablet)) {

                        $AlumnosFicha->uso_internet_tablet = 1;
                    } else {

                        $AlumnosFicha->uso_internet_tablet = 0;
                    }

                    //uso_internet_otros
                    $uso_internet_otros = $this->request->getPost("uso_internet_otros", "string");
                    if (isset($uso_internet_otros)) {

                        $AlumnosFicha->uso_internet_otros = 1;
                    } else {

                        $AlumnosFicha->uso_internet_otros = 0;
                    }

                    //descripcion_lugar_origen
                    $AlumnosFicha->descripcion_lugar_origen = $this->request->getPost("descripcion_lugar_origen", "string");

                    //descripcion_lugar_actual
                    $AlumnosFicha->descripcion_lugar_actual = $this->request->getPost("descripcion_lugar_actual", "string");

                    //apreciacion
                    $AlumnosFicha->descripcion_lugar_actual = $this->request->getPost("descripcion_lugar_actual", "string");

                    //auto
                    $auto = $this->request->getPost("auto", "string");
                    if (isset($auto)) {

                        $AlumnosFicha->auto = 1;
                    } else {

                        $AlumnosFicha->auto = 0;
                    }

                    //vivienda_material_piso
                    if ($this->request->getPost("vivienda_material_piso", "int") == "") {
                        $AlumnosFicha->vivienda_material_piso = null;
                    } else {
                        $AlumnosFicha->vivienda_material_piso = $this->request->getPost("vivienda_material_piso", "int");
                    }

                    //vivienda_material_pared
                    if ($this->request->getPost("vivienda_material_pared", "int") == "") {
                        $AlumnosFicha->vivienda_material_pared = null;
                    } else {
                        $AlumnosFicha->vivienda_material_pared = $this->request->getPost("vivienda_material_pared", "int");
                    }

                    //otros_servicios_descripcion
                    $AlumnosFicha->otros_servicios_descripcion = $this->request->getPost("otros_servicios_descripcion", "string");

                    //acceso_internet_otros_descripcion
                    $AlumnosFicha->acceso_internet_otros_descripcion = $this->request->getPost("acceso_internet_otros_descripcion", "string");

                    //uso_internet_otros_descripcion
                    $AlumnosFicha->uso_internet_otros_descripcion = $this->request->getPost("uso_internet_otros_descripcion", "string");

                    //fecha_ficha_alumno
                    $AlumnosFicha->fecha_ficha_alumno = date('Y-m-d');

                    //ficha_alumno
                    $AlumnosFicha->ficha_alumno = 1;

                    $AlumnosFicha->save();
//---------------------------------fin alumnos_ficha----------------------------
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Alumnos->foto)) {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . $Alumnos->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.jpg';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '.jpg';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Alumnos->foto)) {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . $Alumnos->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.png';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/alumnos/' . 'IMG' . '-' . $Alumnos->codigo . '.png';
                                        $Alumnos->foto = 'IMG' . '-' . $Alumnos->codigo . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $Alumnos->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                            }

                            //cv
                            if ($file->getKey() == "cv") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Alumnos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/alumnos/' . $Alumnos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/cv/' . 'CV-' . $Alumnos->codigo . '-' . $temporal_rand . '.pdf';

                                        $Alumnos->cv = 'CV' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/cv/' . 'CV-' . $Alumnos->codigo . '.pdf';

                                        $Alumnos->cv = 'CV' . '-' . $Alumnos->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }

                            //Traslado UNAAA
                            $traslado = $this->request->getPost("traslado", "string");
                            //echo "<pre>";print_r($certificado_u);exit();

                            if ($traslado == '1') {

                                $Alumnos->traslado = 1;

                                //Grabamos la foto
                                if ($file->getKey() == "traslado_alumno") {

                                    //$file->getName() = $Alumnos->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                                    $url_destino = 'adminpanel/archivos/traslados/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            } else {
                                //$Alumnos->partida_n = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "traslado_alumno") {

                                    $url_destino = 'adminpanel/archivos/traslados_unaaa/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->traslado_unap = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->traslado_unap = 1;
                                    }
                                }
                            }

                            //certificados de estudios
                            $certificado_u = $this->request->getPost("certificado_u", "string");
                            //echo "<pre>";print_r($certificado_u);exit();

                            if ($certificado_u == '1') {

                                $Alumnos->certificado_u = 1;

                                //Grabamos la foto
                                if ($file->getKey() == "certificado_u_alumno") {

                                    //$file->getName() = $Alumnos->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                                    $url_destino = 'adminpanel/archivos/certificados_estudios/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            } else {
                                //$Alumnos->partida_n = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "certificado_u_alumno") {

                                    $url_destino = 'adminpanel/archivos/certificados_estudios/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->certificado_u = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->certificado_u = 1;
                                    }
                                }
                            }

                            //Constancia de ingreso
                            $constancia_i = $this->request->getPost("constancia_i", "string");

                            if ($constancia_i == '1') {

                                $Alumnos->constancia_i = 1;

                                //Grabamos la foto
                                if ($file->getKey() == "constancia_i_alumno") {

                                    //$file->getName() = $Alumnos->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                                    $url_destino = 'adminpanel/archivos/constancias_ingreso/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            } else {
                                //$Alumnos->partida_n = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "constancia_i_alumno") {

                                    $url_destino = 'adminpanel/archivos/constancias_ingreso/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->constancia_i = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->constancia_i = 1;
                                    }
                                }
                            }

                            //Certificados de estudio del colegio
                            $certificado_c = $this->request->getPost("certificado_c", "string");

                            if ($certificado_c == '1') {

                                $Alumnos->certificado_c = 1;

                                //Grabamos la foto
                                if ($file->getKey() == "certificado_c_alumno") {

                                    //$file->getName() = $Alumnos->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                                    $url_destino = 'adminpanel/archivos/certificados_estudios_colegio/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            } else {
                                //$Alumnos->partida_n = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "certificado_c_alumno") {

                                    $url_destino = 'adminpanel/archivos/certificados_estudios_colegio/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->certificado_c = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->certificado_c = 1;
                                    }
                                }
                            }

                            //dni
                            $dni_c = $this->request->getPost("dni_c", "string");

                            if ($dni_c == '1') {

                                $Alumnos->dni_c = 1;

                                //Grabamos la foto
                                if ($file->getKey() == "dni_alumno") {

                                    //$file->getName() = $Alumnos->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                                    $url_destino = 'adminpanel/archivos/dni/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            } else {
                                //$Alumnos->partida_n = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "dni_alumno") {

                                    $url_destino = 'adminpanel/archivos/dni/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->dni_c = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->dni_c = 1;
                                    }
                                }
                            }

                            //partida_n
                            $partida_n = $this->request->getPost("partida_n", "string");

                            if ($partida_n == '1') {

                                $Alumnos->partida_n = 1;

                                //Grabamos la foto
                                if ($file->getKey() == "partida_nacimiento") {

                                    //$file->getName() = $Alumnos->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                                    $url_destino = 'adminpanel/archivos/partidas_nacimiento/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            } else {
                                //$Alumnos->partida_n = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "partida_nacimiento") {

                                    $url_destino = 'adminpanel/archivos/partidas_nacimiento/-FILE' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->partida_n = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->partida_n = 1;
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Alumnos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/alumnos/' . $Alumnos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/alumnos/' . 'FILE' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.pdf';

                                        $Alumnos->archivo = 'FILE' . '-' . $Alumnos->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/alumnos/' . 'FILE' . '-' . $Alumnos->codigo . '.pdf';

                                        $Alumnos->archivo = 'FILE' . '-' . $Alumnos->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $Alumnos->save();
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

    public function egresadoAction()
    {
        $obj = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->assets->addJs("adminpanel/js/modulos/datos.egresado.js?v=" . uniqid() . "");
        $this->view->alumnos = $obj;

        //Modelo Tipoalumnos(a_codigos)
        $tipoAlumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoAlumnos;

        //Modelo idiomas
        $idiomaAlumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaAlumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoAlumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoAlumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoAlumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoAlumnos;

        //Modelo seguro(a_codigos)
        $segurosAlumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosAlumnos;

        //Modelo Estado civil
        $estadoCivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadoCivil;

        //identidad etnica
        $identidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $identidadEtnica;

        //tipo de discapacidad
        $tipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $tipoDiscapacidad;

    }

    public function publicoaAction()
    {

        //echo "<pre>";
        //print_r($_SESSION);
        //exit();
        //echo '<pre>';
        //print_r($this->session->get("auth")["usuario_id"]);
        //exit();
        $Personal = PublicoAspefeenAdmin::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->assets->addJs("adminpanel/js/modulos/datos.publicoa.js?v=" . uniqid() . "");
        $this->view->postulantes = $Personal;

        //Modelo documentos(a_codigos)
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

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

        $categoriaPostulante = CategoriaPostulante::find(
            [
                "estado = 'A' AND numero = 104",
                'order' => 'codigo ASC',
            ]);
        $this->view->categoriapostulante = $categoriaPostulante;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;

        $universidades = Universidades::find("estado = 'A' ORDER BY universidad ASC");
        $this->view->universidades = $universidades;
    }

    //guarda datos postulante
    public function savePublicoAAction()
    {
        // echo '<pre>';
        // print_r($_POST);
        // exit();

        //         echo '<pre>';
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Postulantes = PublicoAspefeenAdmin::findFirstBycodigo($id);
                $Postulantes = (!$Postulantes) ? new PublicoAspefeenAdmin() : $Postulantes;

                $Postulantes->tipo = 0;
                $Postulantes->apellidop = strtoupper($this->request->getPost("apellidop"));
                $Postulantes->apellidom = strtoupper($this->request->getPost("apellidom"));
                $Postulantes->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("documento", "int") == "") {
                    $Postulantes->documento = null;
                } else {
                    $Postulantes->documento = $this->request->getPost("documento", "int");
                }

                $Postulantes->sexo = $this->request->getPost("sexo", "string");
                $Postulantes->nro_doc = $this->request->getPost("nro_doc", "string");
                $Postulantes->celular = $this->request->getPost("celular", "string");
                $Postulantes->email = $this->request->getPost("email", "string");
                $Postulantes->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                //$password_postulantes = $this->request->getPost("nro_doc", "string");
                //$Postulantes->password = $this->security->hash($password_postulantes);
                $Postulantes->estado = "A";

                if ($this->request->getPost("id_universidad", "int") == "") {
                    $Postulantes->id_universidad = null;
                } else {
                    $Postulantes->id_universidad = $this->request->getPost("id_universidad", "int");
                }

                // $Postulantes->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("categoria", "int") == "") {
                    $Postulantes->categoria = null;
                } else {
                    $Postulantes->categoria = $this->request->getPost("categoria", "int");
                }
                $Postulantes->escuela = $this->request->getPost("escuela", "string");

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

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        if (isset($Postulantes->foto)) {
                                            $url_destino = 'adminpanel/imagenes/publico/personales/' . $Postulantes->foto;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . "." . $extension;
                                            $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $Postulantes->codigo . "." . $extension;
                                            $Postulantes->foto = 'IMG' . '-' . $Postulantes->codigo . $extension;
                                        }
                                        $file->moveTo($url_destino);

                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Postulantes->archivo)) {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DNI' . '-' . $Postulantes->codigo . '-' . $temporal_rand . "." . $extension;
                                            $Postulantes->archivo = 'FILE-DNI' . '-' . $Postulantes->codigo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DNI' . '-' . $Postulantes->codigo . "." . $extension;
                                            $Postulantes->archivo = 'FILE-DNI' . '-' . $Postulantes->codigo . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                if ($_FILES['archivo_ruc']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_ruc']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Postulantes->archivo_ruc)) {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_ruc;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'RUC' . '-' . $Postulantes->nro_ruc . '-' . $temporal_rand . "." . $extension;
                                            $Postulantes->archivo_ruc = 'RUC' . '-' . $Postulantes->nro_ruc . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'RUC' . '-' . $Postulantes->nro_ruc . "." . $extension;
                                            $Postulantes->archivo_ruc = 'RUC' . '-' . $Postulantes->nro_ruc . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_cp") {

                                if ($_FILES['archivo_cp']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_cp']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Postulantes->archivo_cp)) {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_cp;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'CP' . '-' . $Postulantes->nro_doc . '-' . $temporal_rand . "." . $extension;
                                            $Postulantes->archivo_cp = 'CP' . '-' . $Postulantes->nro_doc . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'CP' . '-' . $Postulantes->nro_doc . "." . $extension;
                                            $Postulantes->archivo_cp = 'CP' . '-' . $Postulantes->nro_doc . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_escuela") {

                                if ($_FILES['archivo_escuela']['name'] !== "") {

                                    $formatosFiles = array('pdf', 'PDF');
                                    $fileArchivo = $_FILES['archivo_escuela']['name'];
                                    $extension = pathinfo($fileArchivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatosFiles)) {

                                        if (isset($Postulantes->archivo_escuela)) {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $Postulantes->archivo_escuela;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-CGT' . '-' . $Postulantes->codigo . '-' . $temporal_rand . "." . $extension;
                                            $Postulantes->archivo_escuela = 'FILE-CGT' . '-' . $Postulantes->codigo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-CGT' . '-' . $Postulantes->codigo . "." . $extension;
                                            $Postulantes->archivo_escuela = 'FILE-CGT' . '-' . $Postulantes->codigo . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_file"));
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

    public function supervisorAction()
    {

        // echo "<pre>";
        // print_r($_SESSION);
        // exit();
        // echo '<pre>';
        // print_r($this->session->get("auth")["id"]);
        // exit();
        $supervisor = Supervisores::findFirstByid_supervisor($this->session->get("auth")["id"]);
        $this->assets->addJs("adminpanel/js/modulos/datos.supervisor.js?v=" . uniqid() . "");
        $this->view->supervisor = $supervisor;

        //Modelo documentos(a_codigos)
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipodocumento;

    }

    public function saveSupervisorAction()
    {
        // echo '<pre>';
        // print_r($_POST);
        // exit();

        // echo '<pre>';
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_supervisor", "int");
                $supervisores = Supervisores::findFirstByid_supervisor($id);

                if ($this->request->getPost("documento", "int") == "") {
                    $supervisores->documento = null;
                } else {
                    $supervisores->documento = $this->request->getPost("documento", "int");
                }

                $supervisores->nro_doc = $this->request->getPost("nro_doc", "string");
                $supervisores->apellidop = strtoupper($this->request->getPost("apellidop"));
                $supervisores->apellidom = strtoupper($this->request->getPost("apellidom"));
                $supervisores->nombres = strtoupper($this->request->getPost("nombres"));
                $supervisores->procedencia = $this->request->getPost("procedencia", "string");
                $supervisores->celular = $this->request->getPost("celular", "string");
                $supervisores->email = $this->request->getPost("email", "string");
                $supervisores->cuenta_bancaria = $this->request->getPost("cuenta_bancaria", "string");
                $supervisores->nro_ruc = $this->request->getPost("nro_ruc", "string");
                $supervisores->estado = "A";

                if ($supervisores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($supervisores->getMessages());
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

    public function cambiarcontrasenha7Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/cambiarcontrasenha7.js?v=" . uniqid() . "");

    }

    public function save_contrasenha7Action()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $password = $this->request->getPost("usu_clave", "string");
            $password_new = $this->request->getPost("usu_clave2", "string");
            $repassword = $this->request->getPost("re_password", "string");

            $id = $this->session->get('auth')['id'];

            $where = " estado = 'A' AND id_supervisor = $id";

            // echo '<pre>';
            // print_r($_SESSION);
            // exit();

            $user = Supervisores::findFirst($where);

            // print($user->nro_doc);
            // exit();

            $pass = $user->password;

            /* Desencryptar */
            $codigo_perfil = $this->session->get("auth")["perfil"];
            if ($this->security->checkHash($password, $pass)) {

                $this->session->set('auth', [
                    'id' => $user->id_supervisor,
                    'nombres' => $user->nombres,
                    'perfil' => $codigo_perfil,
                ]);

                if ($password_new == $repassword) {
                    $text = $this->request->getPost("usu_clave2");
                    //$usuarios_admin->usu_clave = $this->security->hash($text);

                    $user->password = $this->security->hash($text);
                    $user->save();

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                } else {
                    $this->response->setContent('Clave Error');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_nueva", "msg" => "la clave nueva no coincide con la clave confirmada"));
                }
            } else {

                //echo '<pre>';
                //print_r("Intento fallido");
                //exit();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no_actual"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

}
