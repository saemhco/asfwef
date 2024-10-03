<?php

class RegistropersonalController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registropersonal.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $Personal = Personal::findFirstBycodigo((int) $id);
            //print("Codigo del Seguro:".$Personal->seguro);
            //exit();
        } else {

            $personal_nuevo = Personal::count();
            $Personal->codigo = $personal_nuevo + 1;
        }

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

        //grado_maximo
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;

        //regimen_pensiones
        $RegimenPensiones = RegimenPensiones::find("estado = 'A' AND numero = 83");
        $this->view->regimenpensiones = $RegimenPensiones;

        //afp
        $Afp = Afp::find();
        $this->view->afps = $Afp;

        //tbl_web_personal
        $TipoRegimenPensiones = TipoRegimenPensiones::find("estado = 'A' AND numero = 84");
        $this->view->tiporegimenpensiones = $TipoRegimenPensiones;

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        //Modelo seguro(a_codigos)
        $seguro = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguro;


        //Personal detalle
        $areas = Areas::find("estado = 'A' ORDER BY nombres ASC");
        $this->view->areas = $areas;


        $bancos = Bancos::find("estado = 'A' ORDER BY nombre ASC");
        $this->view->bancos = $bancos;


        $resoluciones = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'id_resolucion ASC',
            ]
        );
        $this->view->resoluciones = $resoluciones;


        $contratos = Contratos::find(
            [
                "estado = 'A'",
                'order' => 'id_contrato ASC',
            ]
        );
        $this->view->contratos = $contratos;


        //personal_familiares
        $this->assets->addJs("adminpanel/js/modulos/registropersonal.familiares.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registropersonal.contratos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registropersonal.historialareas.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, nro_doc, nombres, apellidop, apellidom,"
                . " email, email1, grado, grado_universidad, titulo,"
                . " titulo_universidad, grado_abreviado, concytec_enlace,"
                . "fecha_nacimiento,direccion_actual,"
                . "archivo, imagen, enlace,estado");
            $datatable->setFrom("tbl_web_personal");
            $datatable->setWhere("codigo > 0");
            $datatable->setOrderby("apellidop,apellidom,nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction()
    {


        // echo "<pre>";
        // print_r($_POST);
        // exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Personal = Personal::findFirstBycodigo($id);
                //Valida cuando es nuevo
                $Personal = (!$Personal) ? new Personal() : $Personal;

                $Personal->codigo = $this->request->getPost("codigo", "int");

                //nombres
                $Personal->nombres = $this->request->getPost("nombres", "string");

                //apellidop
                $Personal->apellidop = $this->request->getPost("apellidop", "string");

                //apellidom
                $Personal->apellidom = $this->request->getPost("apellidom", "string");

                //email
                $Personal->email = $this->request->getPost("email", "string");

                //email1
                $Personal->email1 = $this->request->getPost("email1", "string");

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
                if ($this->request->getPost("concytec_enlace", "int") == "") {
                    $Personal->concytec_enlace = null;
                } else {
                    $Personal->concytec_enlace = $this->request->getPost("concytec_enlace", "int");
                }


                //peru_enlace
                $Personal->peru_enlace = $this->request->getPost("peru_enlace", "string");

                //direccion actual
                $Personal->direccion_actual = $this->request->getPost("direccion_actual", "string");

                //direccion procedencia
                $Personal->direccion_procedencia = $this->request->getPost("direccion_procedencia", "string");

                //fecha_ingreso
                if ($this->request->getPost("fecha_ingreso", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_ingreso", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Personal->fecha_ingreso = date('Y-m-d', strtotime($fecha_new));
                }

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
                $Personal->enlace = $this->request->getPost("enlace", "string");

                //fecha_nacimiento
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Personal->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                //documento
                if ($this->request->getPost("documento", "int") == "") {
                    $Personal->documento = null;
                } else {
                    $Personal->documento = $this->request->getPost("documento", "int");
                }

                //sexo
                if ($this->request->getPost("sexo", "int") == "") {
                    $Personal->sexo = null;
                } else {
                    $Personal->sexo = $this->request->getPost("sexo", "int");
                }


                //nro_doc
                $Personal->nro_doc = $this->request->getPost("nro_doc", "string");

                //nro_cta
                $Personal->nro_cta = $this->request->getPost("nro_cta", "string");

                //cci
                $Personal->cci = $this->request->getPost("cci", "string");

                //celular
                $Personal->celular = $this->request->getPost("celular", "string");




                //visible
                $visible = $this->request->getPost("visible", "string");
                if (isset($visible)) {
                    $Personal->visible = 1;
                } else {
                    $Personal->visible = 0;
                }

                //estado
                //                $estado = $this->request->getPost("estado", "string");
                //                if (isset($estado)) {
                //                    $Personal->estado = "A";
                //                } else {
                //                    $Personal->estado = "X";
                //                }

                $Personal->estado = "A";

                //Grado Maximo
                if ($this->request->getPost("grado_maximo", "int") == "") {
                    $Personal->grado_maximo = null;
                } else {
                    $Personal->grado_maximo = $this->request->getPost("grado_maximo", "int");
                }

                //celular
                $Personal->grado_maximo_descripcion = $this->request->getPost("grado_maximo_descripcion", "string");

                //descuento_judicial_p
                $Personal->descuento_judicial_p = $this->request->getPost("descuento_judicial_p", "string");

                //descuento_judicial_m
                $Personal->descuento_judicial_m = $this->request->getPost("descuento_judicial_m", "string");

                //cusp
                $Personal->cuspp = $this->request->getPost("cusp", "string");

                //tipo
                if ($this->request->getPost("tipo", "int") == "") {
                    $Personal->tipo = null;
                } else {
                    $Personal->tipo = $this->request->getPost("tipo", "int");
                }

                //seguro
                if ($this->request->getPost("seguro", "int") == "") {
                    $Personal->seguro = null;
                } else {
                    $Personal->seguro = $this->request->getPost("seguro", "int");
                }

                //seguro_nro
                $Personal->seguro_nro = $this->request->getPost("seguro_nro", "string");

                //regimen_pensiones
                if ($this->request->getPost("regimen_pensiones", "int") == "") {
                    $Personal->regimen_pensiones = null;
                } else {
                    $Personal->regimen_pensiones = $this->request->getPost("regimen_pensiones", "int");
                }
                //afp
                if ($this->request->getPost("afp", "int") == "") {
                    $Personal->afp = null;
                } else {
                    $Personal->afp = $this->request->getPost("afp", "int");
                }

                //colegio_profesional
                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $Personal->colegio_profesional = null;
                } else {
                    $Personal->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }

                //colegio_profesional_nro
                $Personal->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");


                $Personal->airhsp = $this->request->getPost("airhsp", "string");

                $airhsp_estado = $this->request->getPost("airhsp_estado", "string");
                if (isset($airhsp_estado)) {
                    $Personal->airhsp_estado = 1;
                } else {
                    $Personal->airhsp_estado = 0;
                }

                if ($this->request->getPost("id_banco", "string") == "") {
                    $Personal->id_banco = null;
                } else {
                    $banco = $this->request->getPost("id_banco", "string");
                    // print("banco:".$banco);
                    // exit();
                    $Personal->id_banco = $this->request->getPost("id_banco", "string");
                }






                if ($Personal->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Personal->getMessages());
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

                                        if (isset($Personal->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/personal/IMG-' . $Personal->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/personal/IMG-' . $Personal->codigo . '-' . $temporal_rand . "." . $extension;
                                            $Personal->imagen = 'IMG-' . $Personal->codigo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/personal/IMG-' . $Personal->codigo . '.' . $extension;
                                            $Personal->imagen = 'IMG-'. $Personal->codigo . '.' . $extension;
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
                            if ($file->getKey() == "archivo_personal") {


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

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Personal = Personal::findFirstBycodigo((int) $this->request->getPost("id", "int"));

            //print("Personal: ".$Personal->estado);
            //exit();

            if ($Personal && $Personal->estado == 'A') {
                //print("Desactiva");
                //exit();

                $Personal->estado = 'X';
                $Personal->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else if ($Personal && $Personal->estado == 'X') {
                //print("Activa");
                //exit();
                //$this->response->setContent('No existe registro');
                $Personal->estado = 'A';
                $Personal->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //getNew
    public function getNewAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$personal = (int) $this->request->getPost("personal", "int");

            $PersonalFamiliares = PersonalFamiliares::count();

            //echo '<pre>';
            //print_r($PersonalFamiliares);
            //exit();

            if ($PersonalFamiliares >= 0) {

                $codigo = $PersonalFamiliares + 1;

                $this->response->setJsonContent(array("say" => "yes", "codigo" => $codigo));
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

    //datatables personal_familiares
    public function datatablePersonalFamiliaresAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("personal_familiares.codigo");
            $datatable->setSelect("personal_familiares.codigo,personal_familiares.personal, "
                . "personal_familiares.documento, personal_familiares.nro_doc,"
                . " personal_familiares.parentesco, personal_familiares.apellidop, "
                . "personal_familiares.apellidom, personal_familiares.nombres, "
                . "personal_familiares.grado_instruccion, personal_familiares.sexo, "
                . "personal_familiares.fecha_nacimiento, personal_familiares.estado_civil, personal_familiares.ocupacion,"
                . "personal_familiares.observaciones, personal_familiares.es_principal, "
                . "personal_familiares.estado, personal_familiares.orden, personal_familiares.celular, aco.nombres as parentesco ");
            $datatable->setFrom("tbl_web_personal_familiares personal_familiares "
                . "INNER JOIN a_codigos aco ON personal_familiares.parentesco = aco.codigo");
            $datatable->setWhere("personal_familiares.personal = $id AND aco.numero = 27");
            $datatable->setOrderby("personal_familiares.orden ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //guardar personal familiar
    public function savePersonalFamiliaresAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $codigo = (int) $this->request->getPost("codigo", "int");
                $personal = (int) $this->request->getPost("personal", "int");

                $PersonalFamiliares = PersonalFamiliares::findFirst(
                    [
                        "codigo = {$codigo}"
                    ]
                );

                //Valida cuando es nuevo
                $PersonalFamiliares = (!$PersonalFamiliares) ? new PersonalFamiliares() : $PersonalFamiliares;

                //id_peprsonal
                $PersonalFamiliares->codigo = $this->request->getPost("codigo", "int");
                $PersonalFamiliares->personal = $this->request->getPost("personal", "int");

                //documento_familiar
                if ($this->request->getPost("documento", "int") == "") {
                    $PersonalFamiliares->documento = null;
                } else {
                    $PersonalFamiliares->documento = $this->request->getPost("documento", "int");
                }

                //nro_doc_familiar
                $PersonalFamiliares->nro_doc = $this->request->getPost("nro_doc", "string");

                //parentesco_familiar
                if ($this->request->getPost("parentesco", "int") == "") {
                    $PersonalFamiliares->parentesco = null;
                } else {
                    $PersonalFamiliares->parentesco = $this->request->getPost("parentesco", "int");
                }

                //apellidop_familiar
                $PersonalFamiliares->apellidop = $this->request->getPost("apellidop", "string");

                //apellidom_familiar
                $PersonalFamiliares->apellidom = $this->request->getPost("apellidom", "string");

                //nombres_familiar
                $PersonalFamiliares->nombres = $this->request->getPost("nombres", "string");

                //grado_instruccion_familiar
                if ($this->request->getPost("grado_instruccion", "int") == "") {
                    $PersonalFamiliares->grado_instruccion = null;
                } else {
                    $PersonalFamiliares->grado_instruccion = $this->request->getPost("grado_instruccion", "int");
                }

                //sexo_familiar
                if ($this->request->getPost("sexo", "int") == "") {
                    $PersonalFamiliares->sexo = null;
                } else {
                    $PersonalFamiliares->sexo = $this->request->getPost("sexo", "int");
                }

                //fecha_nacimiento_familiar
                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalFamiliares->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                //estado_civil_familiar
                if ($this->request->getPost("estado_civil", "int") == "") {
                    $PersonalFamiliares->estado_civil = null;
                } else {
                    $PersonalFamiliares->estado_civil = $this->request->getPost("estado_civil", "int");
                }

                //ocupacion_familiar
                $PersonalFamiliares->ocupacion = $this->request->getPost("ocupacion", "string");

                //observaciones_familiar
                $PersonalFamiliares->observaciones = $this->request->getPost("observaciones", "string");

                //es_principal
                $es_principal = $this->request->getPost("es_principal", "string");
                if (isset($es_principal)) {
                    $PersonalFamiliares->es_principal = "A";
                } else {
                    $PersonalFamiliares->es_principal = "X";
                }

                //estado_familiar
                $estado_familiar = $this->request->getPost("estado", "string");
                if (isset($estado_familiar)) {
                    $PersonalFamiliares->estado = "A";
                } else {
                    $PersonalFamiliares->estado = "X";
                }

                //orden_familiar
                if ($this->request->getPost("orden", "int") == "") {
                    $PersonalFamiliares->orden = null;
                } else {
                    $PersonalFamiliares->orden = $this->request->getPost("orden", "int");
                }

                //celular_familiar
                $PersonalFamiliares->celular = $this->request->getPost("celular", "string");

                if ($PersonalFamiliares->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonalFamiliares->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                //nombre extension
                                $filex = new SplFileInfo($file->getName());
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PersonalFamiliares->imagen_detalle)) {

                                        $url_destino = 'adminpanel/imagenes/personal_familiares/' . $PersonalFamiliares->imagen;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_familiares/' . 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '-' . $temporal_rand . '.jpg';
                                        $PersonalFamiliares->imagen = 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_familiares/' . 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '.jpg';
                                        $PersonalFamiliares->imagen = 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($PersonalFamiliares->imagen_detalle)) {

                                        $url_destino = 'adminpanel/imagenes/personal_familiares/' . $PersonalFamiliares->imagen_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_familiares/' . 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '-' . $temporal_rand . '.png';
                                        $PersonalFamiliares->imagen = 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_familiares/' . 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '.png';
                                        $PersonalFamiliares->imagen = 'IMG' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {





                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {


                                    if (isset($PersonalFamiliares->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/personal_familiares/' . $PersonalFamiliares->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_familiares/FILE-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '-' . $temporal_rand . '.pdf';
                                        $PersonalFamiliares->archivo = 'FILE' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_familiares/FILE-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '.pdf';
                                        $PersonalFamiliares->archivo = 'FILE' . '-' . $PersonalFamiliares->personal . '-' . $PersonalFamiliares->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PersonalFamiliares->save();
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

    //editar personal_familiares
    public function getAjaxPersonalFamiliaresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalFamiliares::findFirstBycodigo((int) $this->request->getPost("codigo", "int"));
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

    //eliminar
    public function eliminarPersonalFamiliaresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalFamiliares::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {

                //print("Hola Mundo");
                //exit();

                $obj->estado = 'X';
                $obj->save();
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

    //validar personal registrado
    public function personalRegistradoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Personal = Personal::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($Personal) {
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

    public function getAjaxPermisoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));

            $Personal = Personal::findFirstBycodigo((int) $this->request->getPost("id_personal", "int"));

            if ($Personal->estado == 'X') {
                //print("update:".$obj->update);
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                //$this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }



    public function datatableContratosAction($id_personal)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_contrato");
            $datatable->setSelect("id_contrato, tipo, numero, anio, fecha_inicio, fecha_fin, personal, estado, archivo");
            $datatable->setFrom("(SELECT contratos.id_contrato,
                tipo.nombres AS tipo,contratos.numero AS numero,
                contratos.anio AS anio,contratos.fecha_inicio AS fecha_inicio,
                contratos.fecha_fin AS fecha_fin,
                CONCAT (personal.apellidop,' ', personal.apellidom,' ',personal.nombres) AS personal,
                contratos.estado AS estado,
                contratos.archivo AS archivo
                FROM tbl_per_contratos AS contratos INNER JOIN a_codigos tipo ON tipo.codigo = contratos.tipo 
                INNER JOIN tbl_web_personal personal ON personal.codigo = contratos.personal WHERE tipo.numero = 60 AND personal.codigo = $id_personal) AS tempx");
            $datatable->setOrderby("anio desc, tipo, fecha_inicio DESC, numero DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function numeroContratoAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $numero = $this->request->getPost('numero');
            $tipo = $this->request->getPost('tipo');
            $anio = (int) $this->request->getPost('anio');

            //echo '<pre>';
            //print_r("Numero:" . $numero . "- Tipo:" . $tipo . " - Anio:" . $anio);
            //exit();

            /*
              $NumeroResolucion = Resoluciones::findFirst(
              [
              "numero = :numero: AND tipo = :tipo: ",
              'bind' => [
              'numero' => $numero,
              'tipo' => $tipo
              ]
              ]
              );
             */

            $NumeroResolucion = Contratos::findFirst(
                [
                    "numero = $numero AND tipo = $tipo AND anio = $anio "
                ]
            );

            //echo '<pre>';
            //print_r($NumeroResolucion->codigo . $NumeroResolucion->tipo);
            //exit();

            if ($NumeroResolucion) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {

                //echo '<pre>';
                //print_r('Testing');
                //exit();
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function contratoAction($id1 = null, $id2 = null)
    {
        $this->view->id1 = $id1;
        $this->view->id2 = $id2;

        //cuando se va editar
        if ($id1 != null && $id2 != null) {

            //$objetivosei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $Contratos = Contratos::findFirst(
                [
                    "id_contrato = $id1 AND anio = $id2"
                ]
            );

            // echo '<pre>';
            // print_r($Contratos->personal);
            // exit();

            $this->view->id_personal =  $Contratos->personal;
        } else {

            $this->view->id_personal = $id1;
        }

        $this->view->contratos = $Contratos;

        //Tipo
        $TipoContratosP = TipoContratosP::find("estado = 'A' AND numero = 60 ORDER BY nombres");
        $this->view->tipocontratos = $TipoContratosP;


        $fecha_actual = date('d/m/Y');
        //$anio_actual_result = explode('-', $anio_actual);
        $this->view->fecha_actual = $fecha_actual;


        //Personal detalle
        $Personal = Personal::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->personal_model = $Personal;

        //Area
        $Areas = Areas::find("estado = 'A' ORDER BY nombres");
        $this->view->areas = $Areas;

        //Condicion trabajo
        $CondicionTrabajoP = CondicionTrabajoP::find("estado = 'A' AND numero = 61 ORDER BY nombres");
        $this->view->condicion_trabajo = $CondicionTrabajoP;

        //Regimen trabajo
        $RegimenTrabajoP = RegimenTrabajoP::find("estado = 'A' AND numero = 62 ORDER BY nombres");
        $this->view->regimen_trabajo = $RegimenTrabajoP;

        //Tipo dependencia
        $TipoDependenciaP = TipoDependenciaP::find("estado = 'A' AND numero = 63 ORDER BY nombres");
        $this->view->tipodependencia_trabajo = $TipoDependenciaP;

        //Carreras
        $Carreras = Carreras::find("estado = 'A' ORDER BY descripcion");
        $this->view->carreras = $Carreras;

        //Cargo general cargo_general
        $CargoGeneralP = CargoGeneralP::find("estado = 'A' AND numero = 68 ORDER BY nombres");
        $this->view->cargogeneral = $CargoGeneralP;

        //Categoria Lboral
        $CategoriaLaboralP = CategoriaLaboralP::find("estado = 'A' AND numero = 59 ORDER BY nombres");
        $this->view->categorialaboral = $CategoriaLaboralP;

        //categoria_laboral
        $Locales = Locales::find("estado = 'A' ORDER BY nombres");
        $this->view->locales = $Locales;

        $this->assets->addJs("adminpanel/js/modulos/registropersonal.contratos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registropersonal.adenda.js?v=" . uniqid());
    }

    public function saveContratoAction()
    {


        //    echo "<pre>";
        //    print_r($_POST);
        //    exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_contrato", "int");
                $id2 = (int) $this->request->getPost("anio", "int");
                //$Contratos = Resoluciones::findFirstBycodigo($id);
                //echo '<pre>';
                //print_r("llegan: " . $id . '-' . $id2);
                //exit();


                $Contratos = Contratos::findFirst(
                    [
                        "id_contrato = $id AND anio = $id2"
                    ]
                );

                //echo '<pre>';
                //print_r($Contratos->archivo);
                //exit();
                //Valida cuando es nuevo
                $Contratos = (!$Contratos) ? new Contratos() : $Contratos;


                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex_inicio = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex_inicio[2] . "-" . $fecha_ex_inicio[1] . "-" . $fecha_ex_inicio[0];

                    $Contratos->anio = $fecha_ex_inicio[2];
                    $Contratos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }



                $digito = $this->request->getPost("numero", "string");

                $digito_cero = strlen($digito);
                if ($digito_cero == 1) {
                    $Contratos->numero = '000' . $digito;
                } elseif ($digito_cero == 2) {
                    $Contratos->numero = '00' . $digito;
                } elseif ($digito_cero == 3) {
                    $Contratos->numero = '0' . $digito;
                } elseif ($digito_cero == 4) {
                    $Contratos->numero = $digito;
                }
                $Contratos->tipo = $this->request->getPost("tipo", "int");
                $Contratos->perfil = $this->request->getPost("perfil");
                $Contratos->certificacion = $this->request->getPost("certificacion", "string");
                $Contratos->concurso = $this->request->getPost("concurso", "string");
                $Contratos->resolucion = $this->request->getPost("resolucion", "string");

                $confianza = $this->request->getPost("confianza", "string");
                if (isset($confianza)) {
                    $Contratos->confianza = "1";
                } else {
                    $Contratos->confianza = "0";
                }

                $Contratos->personal = $this->request->getPost("personal", "int");


                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Contratos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }
                $Contratos->area = $this->request->getPost("area", "int");
                $Contratos->condicion = $this->request->getPost("condicion", "int");


                if ($this->request->getPost("regimen", "int") == "") {
                    $Contratos->regimen = null;
                } else {
                    $Contratos->regimen = $this->request->getPost("regimen", "int");
                }

                $Contratos->tipo_dependencia = $this->request->getPost("tipo_dependencia", "int");

                $Contratos->dependencia = $this->request->getPost("dependencia", "string");


                if ($this->request->getPost("carrera", "string") == "") {
                    $Contratos->carrera = null;
                } else {
                    $Contratos->carrera = $this->request->getPost("carrera", "string");
                }


                $Contratos->cargo_general = $this->request->getPost("cargo_general", "int");
                $Contratos->cargo = $this->request->getPost("cargo", "string");

                $Contratos->categoria_laboral = $this->request->getPost("categoria_laboral", "int");
                $Contratos->modalidad = $this->request->getPost("modalidad", "int");
                $Contratos->local = $this->request->getPost("local", "int");
                $Contratos->estado = "A";
                $Contratos->contrato = $this->request->getPost("contrato", "string");

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $Contratos->monto = $this->request->getPost("monto", "string");

                $visado = $this->request->getPost("visado", "string");
                if (isset($visado)) {
                    $Contratos->visado = "1";
                } else {
                    $Contratos->visado = "0";
                }

                //nivel_remunerativo
                $Contratos->nivel_remunerativo = $this->request->getPost("nivel_remunerativo", "string");


                if ($Contratos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Contratos->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //Partida de nacimiento
                            //$archivo = $this->request->getPost("archivo", "string");

                            $temporal_rand = mt_rand(100000, 999999);
                            $xAbrevIns = $this->config->global->xAbrevIns;

                            //imagen
                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Contratos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . $Contratos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . '.jpg';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '.jpg';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Contratos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . $Contratos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . '.png';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '.png';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $Contratos->nombre;
                                //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Contratos->codigo . "-" . $file->getName();
                            }


                            //$Contratos->archivo = 1;
                            //Grabamos la foto

                            if ($this->request->getPost("tipo", "int") == 1) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 2) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 3) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 4) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 5) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            }
                        }

                        $Contratos->save();
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

    public function eliminarContratoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$Contratos = Resoluciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $Contratos = Contratos::findFirst(
                [
                    "id_contrato = '$id' AND anio = $id2"
                ]
            );

            if ($Contratos && $Contratos->estado = 'A') {
                $Contratos->estado = 'X';
                $Contratos->save();
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

    public function verificapdfAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo = $this->request->getPost("file_pdf");

            //echo '<pre>';
            //print_r($archivo);
            //exit();

            $file_pdf = new SplFileInfo($archivo);

            //echo '<pre>';
            //print_r($file_pdf->getExtension());
            //exit();

            if ($file_pdf->getExtension() != 'pdf') {
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

    public function getContratosAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $anio = (int) $this->request->getPost("anio", "int");

            $contratos = Contratos::count(
                [
                    "anio = $anio "
                ]
            );

            //echo '<pre>';
            //print_r($contratos);
            //exit();

            if ($contratos >= 0) {

                //print("Test");
                //exit();

                $codigo = $contratos + 1;

                $this->response->setJsonContent(array("say" => "si", "codigo" => $codigo));
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






    public function getNuevoAdendasAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $contrato = (int) $this->request->getPost("contrato", "int");
            $anio = (int) $this->request->getPost("anio", "int");

            $ContratosAdendas = ContratosAdendas::count();

            //            echo '<pre>';
            //            print_r("Contrato:" . $contrato . " - Anio:" . $anio);
            //            exit();

            $num = ContratosAdendas::count(
                [
                    "contrato = {$contrato} AND anio = {$anio}"
                ]
            );

            if ($ContratosAdendas >= 0 and $num >= 0) {

                $codigo = $ContratosAdendas + 1;

                $numero = $num + 1;

                $this->response->setJsonContent(array("say" => "yes", "codigo" => $codigo, "numero" => $numero));
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

    public function datatableAdendasAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("contratos_adendas.id_contrato_adenda");
            $datatable->setSelect("contratos_adendas.id_contrato_adenda,contratos_adendas.id_contrato,"
                . "contratos_adendas.numero,contratos_adendas.fecha_inicio,"
                . "contratos_adendas.fecha_fin,contratos_adendas.numero,contratos_adendas.adenda,contratos_adendas.estado");
            $datatable->setFrom("tbl_per_contratos_adendas contratos_adendas ");
            $datatable->setWhere("contratos_adendas.id_contrato = {$id}");
            $datatable->setOrderby("contratos_adendas.id_contrato_adenda ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //guardar personal familiar
    public function saveAdendasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_contrato_adenda", "int");
                $ContratosAdendas = ContratosAdendas::findFirstByid_contrato_adenda($id);
                $ContratosAdendas = (!$ContratosAdendas) ? new ContratosAdendas() : $ContratosAdendas;

                $ContratosAdendas->id_contrato = $this->request->getPost("id_contrato", "int");


                $digito = $this->request->getPost("numero", "string");

                //numero
                $digito_cero = strlen($digito);
                if ($digito_cero == 1) {
                    $ContratosAdendas->numero = '000' . $digito;
                } elseif ($digito_cero == 2) {
                    $ContratosAdendas->numero = '00' . $digito;
                } elseif ($digito_cero == 3) {
                    $ContratosAdendas->numero = '0' . $digito;
                } elseif ($digito_cero == 4) {
                    $ContratosAdendas->numero = $digito;
                }


                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $ContratosAdendas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $ContratosAdendas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //adenda
                $ContratosAdendas->adenda = $this->request->getPost("adenda", "string");

                //certificacion
                $ContratosAdendas->certificacion = $this->request->getPost("certificacion", "string");

                //resolucion
                $ContratosAdendas->resolucion = $this->request->getPost("resolucion", "string");


                //visado
                $visado = $this->request->getPost("visado_adenda", "string");
                if (isset($visado)) {
                    $ContratosAdendas->visado = 1;
                } else {
                    $ContratosAdendas->visado = 0;
                }

                $ContratosAdendas->estado = "A";

                //anio
                $ContratosAdendas->anio = $this->request->getPost("anio", "int");

                if ($ContratosAdendas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ContratosAdendas->getMessages());
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
                                    if (isset($ContratosAdendas->imagen)) {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . $ContratosAdendas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '-' . $temporal_rand . '.jpg';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '-' . $temporal_rand . '.jpg';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '.jpg';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '.jpg';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($ContratosAdendas->imagen)) {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . $ContratosAdendas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '-' . $temporal_rand . '.png';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '-' . $temporal_rand . '.png';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '.png';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . '.png';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->id_contrato_adenda . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Noticias->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($ContratosAdendas->archivo)) {

                                        $url_destino = 'adminpanel/archivos/contratos_adendas/' . $ContratosAdendas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/contratos_adendas/' . 'FILE' . '-' . $ContratosAdendas->id_contrato_adenda . '-' . $temporal_rand . '.pdf';
                                        $ContratosAdendas->archivo = 'FILE' . '-' . $ContratosAdendas->id_contrato_adenda . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/contratos_adendas/' . 'FILE' . '-' . $ContratosAdendas->id_contrato_adenda . '.pdf';
                                        $ContratosAdendas->archivo = 'FILE' . '-' . $ContratosAdendas->id_contrato_adenda . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $ContratosAdendas->save();
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

    //editar personal_permisos
    public function getAjaxContratosAdendasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ContratosAdendas::findFirstByid_contrato_adenda((int) $this->request->getPost("id", "int"));
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

    //eliminar
    public function eliminarContratosAdendasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ContratosAdendas::findFirstByid_contrato_adenda((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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



    public function datatablePersonalAreasAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("personal_areas.id_personal_area");
            $datatable->setSelect("personal_areas.id_personal_area, "
                . "personal_areas.personal, personal_areas.area,"
                . "personal_areas.cargo, personal_areas.fecha_inicio, "
                . "personal_areas.fecha_fin, personal_areas.archivo, "
                . "personal_areas.imagen, personal_areas.enlace, "
                . "personal_areas.estado, personal_areas.oficina, personal_areas.orden,"
                . "personal.nombres as nombres_personal, personal.apellidop as apellidop_personal, personal.apellidom as apellidom_personal, areas.nombres as area");
            $datatable->setFrom("tbl_web_personal_areas personal_areas "
                . "INNER JOIN tbl_web_personal personal ON personal_areas.personal = personal.codigo "
                . "INNER JOIN tbl_web_areas areas ON personal_areas.area = areas.codigo");
            $datatable->setWhere("personal_areas.personal = $id AND personal_areas.tipo= 3");
            $datatable->setOrderby("personal_areas.orden ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function savePersonalAreasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area", "int");
                $PersonalAreas = PersonalAreas::findFirstByid_personal_area($id);
                $PersonalAreas = (!$PersonalAreas) ? new PersonalAreas() : $PersonalAreas;


                $PersonalAreas->personal = $this->request->getPost("personal", "int");

                $PersonalAreas->area = $this->request->getPost("area", "int");


                //cargo
                $PersonalAreas->cargo = $this->request->getPost("cargo", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalAreas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalAreas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $PersonalAreas->enlace = $this->request->getPost("enlace", "string");

                //email
                $PersonalAreas->email = $this->request->getPost("email", "string");

                //enlace
                $PersonalAreas->oficina = $this->request->getPost("oficina", "string");

                //orden
                if ($this->request->getPost("orden", "int") == "") {
                    $PersonalAreas->orden = null;
                } else {
                    $PersonalAreas->orden = $this->request->getPost("orden", "int");
                }

                //Enlace
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $PersonalAreas->estado = "A";
                } else {
                    $PersonalAreas->estado = "X";
                }

                //es_principal
                $es_principal = $this->request->getPost("es_principal", "string");
                if (isset($es_principal)) {
                    $PersonalAreas->es_principal = "A";
                } else {
                    $PersonalAreas->es_principal = "X";
                }

                //Encargatura
                $encargatura = $this->request->getPost("encargatura", "string");
                if (isset($encargatura)) {
                    $PersonalAreas->encargatura = "A";
                } else {
                    $PersonalAreas->encargatura = "X";
                }

                $PersonalAreas->tipo = 3;


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $PersonalAreas->id_resolucion = null;
                } else {
                    $PersonalAreas->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($this->request->getPost("id_contrato", "int") == "") {
                    $PersonalAreas->id_contrato = null;
                } else {
                    $PersonalAreas->id_contrato = $this->request->getPost("id_contrato", "int");
                }


                if ($PersonalAreas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonalAreas->getMessages());
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

                                    if (isset($PersonalAreas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . $PersonalAreas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.jpg';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($PersonalAreas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . $PersonalAreas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.png';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.png';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '.png';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                //$url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.pdf';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.pdf';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'doc') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.doc';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.doc';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.doc';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.doc';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                } elseif ($filex->getExtension() == 'docx') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.docx';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.docx';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.docx';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.docx';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $PersonalAreas->save();
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

    public function getAjaxPersonalAreasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalAreas::findFirstByid_personal_area((int) $this->request->getPost("codigo", "int"));
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

    public function eliminarPersonalAreasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalAreas::findFirstByid_personal_area((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
