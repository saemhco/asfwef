<?php

class GestionegresadosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

       
    }

    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionegresados.js?v=" . uniqid());
    }

    public function empleosAction($id = null)
    {

        $this->view->id = $id;

        $this->assets->addJs("adminpanel/js/modulos/gestionegresados.empleos.js?v=" . uniqid());

        $tipocontratos = TipoContratos::find("estado = 'A' AND numero = 47");
        $this->view->tipocontratos = $tipocontratos;

        $cargos = Cargos::find("estado = 'A' AND numero = 45");
        $this->view->cargos = $cargos;

        $jornadas = Jornadas::find("estado = 'A' AND numero = 46");
        $this->view->jornadas = $jornadas;

        $seeEmpleos = Empresas::find("estado = 'A'");
        $this->view->empresas = $seeEmpleos;

        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;


    }

    //Funcion para agregar alumno y editar
    public function registroAction($id = null)
    {

        if ($id != null) {
            $alumnos = Alumnos::findFirstBycodigo((int) $id);
        } else {
            //$docentes = Asignaturas::findFirstBycodigo(0);
            $alumnos = Alumnos::findFirstBycodigo(null);
        }

        $this->view->alumnos = $alumnos;

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

        //Region para ubigeo
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //modalidad_estudios nuevos campos
        $ModalidadEstudios = ModalidadEstudios::find("estado = 'A' AND numero = 77");
        $this->view->modalidadestudios = $ModalidadEstudios;

        //local
        $Local = Locales::find("estado = 'A'");
        $this->view->locales = $Local;

        $semestre_a = Semestres::findFirst("activo = 'M'");

        $alumnos_ficha = AlumnosFicha::findFirst("alumno='{$id}' AND semestre = {$semestre_a->codigo} ");
        $this->view->alumnos_ficha = $alumnos_ficha;



        $this->assets->addJs("adminpanel/js/modulos/gestionegresados.js?v=" . uniqid());

    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_alumno");
            $datatable->setSelect("id_alumno,carrera_nombre,alumnos_nombre,nro_doc,celular,estado");
            $datatable->setFrom("(SELECT
            public.alumnos.codigo AS id_alumno,
            public.carreras.descripcion AS carrera_nombre,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumnos_nombre,
            public.alumnos.nro_doc AS nro_doc,
            public.alumnos.celular AS celular,
            public.alumnos.estado AS estado
            FROM
            public.alumnos
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            WHERE
            public.alumnos.estado = 'A' AND  public.alumnos.tipo > 1) AS temporal_table");
            $datatable->setOrderby("alumnos_nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar docente
    public function saveAction()
    {
//        echo "<pre>";
        //        print_r($_POST);
        //        exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "int");
                $Alumnos = Alumnos::findFirstBycodigo($id);
                $Alumnos = (!$Alumnos) ? new Alumnos() : $Alumnos;

                //codigo
                $Alumnos->codigo = $this->request->getPost("codigo", "string");

                //tipo
                /*
                if ($this->request->getPost("tipo", "int") == "") {
                $Alumnos->tipo = null;
                } else {
                $Alumnos->tipo = $this->request->getPost("tipo", "int");
                }
                 */

                //semestre
                if ($this->request->getPost("semestre", "int") == "") {
                    $Alumnos->semestre = null;
                } else {
                    $Alumnos->semestre = $this->request->getPost("semestre", "int");
                }

                //semestre_egreso
                if ($this->request->getPost("semestre_egreso", "int") == "") {
                    $Alumnos->semestre_egreso = null;
                } else {
                    $Alumnos->semestre_egreso = $this->request->getPost("semestre_egreso", "int");
                }

                //carrera
                $Alumnos->carrera = $this->request->getPost("carrera", "string");

                //apellidop
                $Alumnos->apellidop = $this->request->getPost("apellidop", "string");

                //apellidom
                $Alumnos->apellidom = $this->request->getPost("apellidom", "string");

                //nombres
                $Alumnos->nombres = $this->request->getPost("nombres", "string");

                //Sexo
                if ($this->request->getPost("sexo", "int") == "") {
                    $Alumnos->sexo = null;
                } else {
                    $Alumnos->sexo = $this->request->getPost("sexo", "int");
                }
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
                if ($this->request->getPost("documento", "int") == "") {
                    $Alumnos->documento = null;
                } else {
                    $Alumnos->documento = $this->request->getPost("documento", "int");
                }

                //nro_doc
                $Alumnos->nro_doc = $this->request->getPost("nro_doc", "string");

                //fecha_ingreso
                if ($this->request->getPost("fecha_ingreso", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_ingreso", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Alumnos->fecha_ingreso = date('Y-m-d', strtotime($fecha_new));
                }

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
                $Alumnos->observaciones = $this->request->getPost("observaciones");

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
                $graduado = $this->request->getPost("graduado", "string");
                if (isset($graduado)) {

                    $Alumnos->graduado = 1;
                } else {

                    $Alumnos->graduado = 0;
                }

                //titulado
                $titulado = $this->request->getPost("titulado", "string");
                if (isset($titulado)) {

                    $Alumnos->titulado = 1;
                } else {

                    $Alumnos->titulado = 0;
                }

                //discapacitado
                $discapacitado = $this->request->getPost("discapacitado", "string");

                if (isset($discapacitado)) {

                    $Alumnos->discapacitado = 1;
                } else {

                    $Alumnos->discapacitado = 0;
                }

                //envio
                $envio = $this->request->getPost("envio", "string");

                if (isset($envio)) {

                    $Alumnos->envio = 1;
                } else {

                    $Alumnos->envio = 0;
                }

                //activo
                $activo = $this->request->getPost("activo", "string");

                if (isset($activo)) {
                    $Alumnos->activo = 1;
                } else {
                    $Alumnos->activo = 0;
                }

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
                if ($this->request->getPost("idioma", "int") == "") {
                    $Alumnos->idioma = null;
                } else {
                    $Alumnos->idioma = $this->request->getPost("idioma", "int");
                }
                //archivo
                //nro_seguro
                $Alumnos->nro_seguro = $this->request->getPost("nro_seguro", "string");
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
                if ($this->request->getPost("fecha_egreso", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_egreso", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Alumnos->fecha_egreso = date('Y-m-d', strtotime($fecha_new));
                }

                //modalidad_ingreso
                if ($this->request->getPost("modalidad_ingreso", "int") == "") {
                    $Alumnos->modalidad_ingreso = null;
                } else {
                    $Alumnos->modalidad_ingreso = $this->request->getPost("modalidad_ingreso", "int");
                }

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

                                //$file->getName() = $Alumnos->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Alumnos->codigo . "-" . $file->getName();
                            }

                            //cv
                            if ($file->getKey() == "cv") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Alumnos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/cv/' . $Alumnos->cv;

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

                            //Traslado
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

                                    $url_destino = 'adminpanel/archivos/traslados/FILE-' . $Alumnos->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                        //Si el archivo se envio se guarda en 0
                                        $Alumnos->traslado = 0;
                                    } else {

                                        //Si el archivo ya esta cargado guardamos 1
                                        $Alumnos->traslado = 1;
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

                                    $url_destino = 'adminpanel/archivos/partidas_nacimiento/FILE-' . $Alumnos->codigo . '.pdf';

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


    public function datatableEmpleosAction($idalumno)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_empleo");
            $datatable->setSelect("id_empleo, fecha_inicio, fecha_fin, titulo, razon_social, tipocontrato, cargo, jornada, ciudad, estado");
            $datatable->setFrom("(SELECT
            public.tbl_see_empleos.id_empleo,
            to_char(public.tbl_see_empleos.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(public.tbl_see_empleos.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            public.tbl_see_empleos.titulo,
            public.tbl_btr_empresas.razon_social,
            tipo_contrato.nombres AS tipocontrato,
            cargos.nombres AS cargo,
            jornadas.nombres AS jornada,
            public.tbl_see_empleos.ciudad,
            public.tbl_see_empleos.estado
            FROM
            public.tbl_see_empleos
            INNER JOIN public.tbl_btr_empresas ON public.tbl_btr_empresas.id_empresa = public.tbl_see_empleos.id_empresa
            INNER JOIN public.a_codigos AS tipo_contrato ON tipo_contrato.codigo = public.tbl_see_empleos.id_tipocontrato
            INNER JOIN public.a_codigos AS cargos ON cargos.codigo = public.tbl_see_empleos.id_cargo
            INNER JOIN public.a_codigos AS jornadas ON jornadas.codigo = public.tbl_see_empleos.id_jornada
            WHERE
            tipo_contrato.numero = 47 AND
            cargos.numero = 45 AND
            jornadas.numero = 46 AND
            public.tbl_see_empleos.id_alumno = '$idalumno') AS temporal_table");
            $datatable->setOrderby("fecha_inicio ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveEmpleosAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        //echo "<pre>";
        //print_r($_FILES);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $id = (int) $this->request->getPost("id_empleo", "int");
                $seeEmpleos = SeeEmpleos::findFirstByid_empleo($id);
                $seeEmpleos = (!$seeEmpleos) ? new SeeEmpleos() : $seeEmpleos;

                $seeEmpleos->id_tipocontrato = $this->request->getPost("id_tipocontrato", "int");
                $seeEmpleos->id_cargo = $this->request->getPost("id_cargo", "int");
                $seeEmpleos->id_jornada = $this->request->getPost("id_jornada", "int");
                $seeEmpleos->id_empresa = $this->request->getPost("id_empresa", "int");

                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $seeEmpleos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $seeEmpleos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $seeEmpleos->titulo = $this->request->getPost("titulo", "string");
                $seeEmpleos->descripcion = $this->request->getPost("descripcion", "string");
                $seeEmpleos->remuneracion = $this->request->getPost("remuneracion", "string");
                $seeEmpleos->ciudad = $this->request->getPost("ciudad", "string");
                $seeEmpleos->ubigeo_id = $this->request->getPost("ubigeo_id", "int");
                $seeEmpleos->region_id = $this->request->getPost("region_id", "string");
                $seeEmpleos->provincia_id = $this->request->getPost("provincia_id", "string");
                $seeEmpleos->distrito_id = $this->request->getPost("distrito_id", "string");
                $seeEmpleos->estado = "A";
                $seeEmpleos->id_alumno = $this->request->getPost("id_alumno", "string");

                if ($seeEmpleos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($seeEmpleos->getMessages());
                } else {
                    //Cuando va bien                  
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_empleo") {
                                if ($_FILES['imagen_empleo']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_empleo']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {
                                        if (isset($seeEmpleos->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/egresados/empleos/' . $seeEmpleos->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/egresados/empleos/' . 'IMG' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                            $seeEmpleos->imagen = 'IMG' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/egresados/empleos/' . 'IMG' . '-' . $seeEmpleos->id_empleo . '.' . $extension;
                                            $seeEmpleos->imagen = 'IMG' . '-' . $seeEmpleos->id_empleo . '.' . $extension;
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
                            if ($file->getKey() == "archivo_empleo") {

                                if ($_FILES['archivo_empleo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo_empleo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($seeEmpleos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/egresados/empleos/' . $seeEmpleos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/egresados/empleos/' . 'FILE' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                            $seeEmpleos->archivo = 'FILE' . '-' . $seeEmpleos->id_empleo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/egresados/empleos/' . 'FILE' . '-' . $seeEmpleos->id_empleo . "." . $extension;
                                            $seeEmpleos->archivo = 'FILE' . '-' . $seeEmpleos->id_empleo . "." . $extension;
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

                        $seeEmpleos->save();
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

    public function getAjaxEmpleosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $seeEmpleos = SeeEmpleos::findFirstByid_empleo((int) $this->request->getPost("id", "int"));
            if ($seeEmpleos) {
                $this->response->setJsonContent($seeEmpleos->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarEmpleosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $seeEmpleos = SeeEmpleos::findFirstByid_empleo((int) $this->request->getPost("id", "int"));
            if ($seeEmpleos && $seeEmpleos->estado = 'A') {
                $seeEmpleos->estado = 'X';
                $seeEmpleos->save();
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
