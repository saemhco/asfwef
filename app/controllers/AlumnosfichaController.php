<?php

class AlumnosfichaController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/alumnosficha.js?v=" . uniqid());
    }

    public function indexAction($sem) {


        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    //Funcion para agregar alumno y editar
    public function registroAction($id = null, $sem) {
        $this->view->sem = $sem;
        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;


        //COnusltamos al semestre
//        $semestre = Semestres::findFirst(
//                        [
//                            "activo = 'M' and codigo = {$sem} ",
//                            'order' => 'codigo DESC',
//                            'limit' => 1,
//                        ]
//        );



        if ($id != null) {
            $alumnos = Alumnos::findFirstBycodigo((int) $id);
        } else {
            //$docentes = Asignaturas::findFirstBycodigo(0);
            $alumnos = Alumnos::findFirstBycodigo(NULL);
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

        //Modelo alumnos_ficha
        //$alumnos_ficha = Alumnosficha::findFirstByalumno((int) $id);
        $alumnos_ficha = AlumnosFicha::findFirst("alumno='{$id}' AND semestre = {$sem} ");

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

        //Modelo alumnos_ficha
        //$alumnos = AlumnosFamiliares::findFirstByalumno((int) $id);
        //$this->view->alumnos = $alumnos;
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

        //Agregamos el datatables para los padres
        $this->assets->addJs("adminpanel/js/modulos/alumnosficha.familiares.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction($semestre) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("a.codigo");
            $datatable->setSelect("a.codigo,a_f.semestre, ca.descripcion as carrera, a.apellidop, a.apellidom, a.nombres, a.nro_doc, a.celular, a.direccion,a.cv,a.estado");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("alumnos a INNER JOIN carreras ca ON a.carrera = ca.codigo"
                    . " INNER JOIN alumnos_ficha a_f ON a.codigo = a_f.alumno");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            $datatable->setWhere("a.estado = 'A' AND a_f.semestre = {$semestre} ");
            $datatable->setOrderby("a.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar alumno
    public function saveAction() {

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
                                        "alumno = '{$alumno}' AND semestre = {$semestre}"
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
                    $AlumnosFicha->apreciacion = $this->request->getPost("apreciacion", "string");

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

    //getNew
    public function getNewAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$personal = (int) $this->request->getPost("personal", "int");

            $PersonalFamiliares = AlumnosFamiliares::count();

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

    public function saveFamiliaresAction() {

//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo_familiares", "int");
                $AlumnosFamiliares = AlumnosFamiliares::findFirstBycodigo($id);
                $AlumnosFamiliares = (!$AlumnosFamiliares) ? new AlumnosFamiliares() : $AlumnosFamiliares;

                $AlumnosFamiliares->codigo = $this->request->getPost("codigo_familiares", "string");
                $AlumnosFamiliares->alumno = $this->request->getPost("codigo_alumno", "string");

                //Es principal
                $es_principal = $this->request->getPost("es_principal_familiares", "string");
                if (isset($es_principal)) {
                    $AlumnosFamiliares->es_principal = 1;
                } else {
                    $AlumnosFamiliares->es_principal = 0;
                }


                $AlumnosFamiliares->documento = $this->request->getPost("documento_familiares", "string");
                $AlumnosFamiliares->nro_doc = $this->request->getPost("nro_doc_familiares", "string");
                $AlumnosFamiliares->parentesco = $this->request->getPost("parentesco_familiares", "string");
                $AlumnosFamiliares->apellido_paterno = $this->request->getPost("apellido_paterno_familiares", "string");
                $AlumnosFamiliares->apellido_materno = $this->request->getPost("apellido_materno_familiares", "string");
                $AlumnosFamiliares->nombres = $this->request->getPost("nombres_familiares", "string");
                $AlumnosFamiliares->grado_instruccion = $this->request->getPost("grado_instruccion_familiares", "string");
                $AlumnosFamiliares->ingresos = $this->request->getPost("ingresos_familiares", "string");
                $AlumnosFamiliares->edad = $this->request->getPost("edad_familiares", "string");
                $AlumnosFamiliares->sexo = $this->request->getPost("sexo_familiares", "string");

                if ($this->request->getPost("fecha_nacimiento_familiares", "string") != "") {
                    $fecha_ex = explode("-", $this->request->getPost("fecha_nacimiento_familiares", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $AlumnosFamiliares->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $AlumnosFamiliares->estado_civil = $this->request->getPost("estado_civil_familiares", "string");
                $AlumnosFamiliares->ocupacion = $this->request->getPost("ocupacion_familiares", "string");
                $AlumnosFamiliares->observaciones = $this->request->getPost("observaciones_familiares", "string");

                //$AlumnosFamiliares->enfermedad = $this->request->getPost("enfermedad", "string");
                $enfermedad = $this->request->getPost("enfermedad_familiares", "string");
                if (isset($enfermedad)) {
                    $AlumnosFamiliares->enfermedad = 1;
                } else {
                    $AlumnosFamiliares->enfermedad = 0;
                }


                $AlumnosFamiliares->enfermedad_nombre = $this->request->getPost("enfermedad_nombre_familiares", "string");
                $AlumnosFamiliares->enfermedad_tiempo = $this->request->getPost("enfermedad_tiempo_familiares", "string");

                //$AlumnosFamiliares->tratamiento = $this->request->getPost("tratamiento", "string");
                $tratamiento = $this->request->getPost("tratamiento_familiares", "string");
                if (isset($tratamiento)) {
                    $AlumnosFamiliares->tratamiento = 1;
                } else {
                    $AlumnosFamiliares->tratamiento = 0;
                }

                $AlumnosFamiliares->tratamiento_lugar = $this->request->getPost("tratamiento_lugar_familiares", "string");

                //$AlumnosFamiliares->discapacidad = $this->request->getPost("discapacidad", "string");
                $discapacidad = $this->request->getPost("discapacidad_familiares", "string");
                if (isset($discapacidad)) {
                    $AlumnosFamiliares->discapacidad = 1;
                } else {
                    $AlumnosFamiliares->discapacidad = 0;
                }

                $AlumnosFamiliares->discapacidad_nombre = $this->request->getPost("discapacidad_nombre_familiares", "string");


                $casa = $this->request->getPost("casa_familiares", "string");
                if (isset($casa)) {
                    $AlumnosFamiliares->casa = 1;
                } else {
                    $AlumnosFamiliares->casa = 0;
                }


                $camion = $this->request->getPost("camion_familiares", "string");
                if (isset($camion)) {
                    $AlumnosFamiliares->camion = 1;
                } else {
                    $AlumnosFamiliares->camion = 0;
                }

                $auto = $this->request->getPost("auto_familiares", "string");
                if (isset($auto)) {
                    $AlumnosFamiliares->auto = 1;
                } else {
                    $AlumnosFamiliares->auto = 0;
                }

                $mototaxi = $this->request->getPost("mototaxi_familiares", "string");
                if (isset($mototaxi)) {
                    $AlumnosFamiliares->mototaxi = 1;
                } else {
                    $AlumnosFamiliares->mototaxi = 0;
                }

                $predios = $this->request->getPost("predios_familiares", "string");
                if (isset($predios)) {
                    $AlumnosFamiliares->predios = 1;
                } else {
                    $AlumnosFamiliares->predios = 0;
                }

                $tv = $this->request->getPost("tv_familiares", "string");
                if (isset($tv)) {
                    $AlumnosFamiliares->tv = 1;
                } else {
                    $AlumnosFamiliares->tv = 0;
                }

                $equipo = $this->request->getPost("equipo_familiares", "string");
                if (isset($equipo)) {
                    $AlumnosFamiliares->equipo = 1;
                } else {
                    $AlumnosFamiliares->equipo = 0;
                }

                $animales = $this->request->getPost("animales_familiares", "string");
                if (isset($animales)) {
                    $AlumnosFamiliares->animales = 1;
                } else {
                    $AlumnosFamiliares->animales = 0;
                }

                $AlumnosFamiliares->estado = "A";

                //orden
                $AlumnosFamiliares->orden = $this->request->getPost("orden_familiares", "string");


                //sillas
                $sillas = $this->request->getPost("sillas_familiares", "string");
                if (isset($sillas)) {
                    $AlumnosFamiliares->sillas = 1;
                } else {
                    $AlumnosFamiliares->sillas = 0;
                }

                //sillas
                $mesas = $this->request->getPost("mesas_familiares", "string");
                if (isset($mesas)) {
                    $AlumnosFamiliares->mesas = 1;
                } else {
                    $AlumnosFamiliares->mesas = 0;
                }

                //lugar_centro_estudios
                $AlumnosFamiliares->lugar_centro_estudios = $this->request->getPost("lugar_centro_estudios_familiares", "string");


                if ($AlumnosFamiliares->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AlumnosFamiliares->getMessages());
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

                                    if (isset($AlumnosFamiliares->imagen_detalle)) {

                                        $url_destino = 'adminpanel/imagenes/alumnos_familiares/' . $AlumnosFamiliares->imagen;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/alumnos_familiares/' . 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '-' . $temporal_rand . '.jpg';
                                        $AlumnosFamiliares->imagen = 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/alumnos_familiares/' . 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '.jpg';
                                        $AlumnosFamiliares->imagen = 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($AlumnosFamiliares->imagen_detalle)) {

                                        $url_destino = 'adminpanel/imagenes/alumnos_familiares/' . $AlumnosFamiliares->imagen_detalle;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/alumnos_familiares/' . 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '-' . $temporal_rand . '.png';
                                        $AlumnosFamiliares->imagen = 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/alumnos_familiares/' . 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '.png';
                                        $AlumnosFamiliares->imagen = 'IMG' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen_detalle = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria_detalle . ".jpg";
                                    }
                                }
                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
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


                                    if (isset($AlumnosFamiliares->archivo_detalle)) {
                                        $url_destino = 'adminpanel/archivos/alumnos_familiares/' . $AlumnosFamiliares->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/alumnos_familiares/FILE-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '-' . $temporal_rand . '.pdf';
                                        $AlumnosFamiliares->archivo = 'FILE' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/alumnos_familiares/FILE-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '.pdf';
                                        $AlumnosFamiliares->archivo = 'FILE' . '-' . $AlumnosFamiliares->alumno . '-' . $AlumnosFamiliares->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                        }

                        $AlumnosFamiliares->save();
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

    //datatableFamiliares
    public function datatableFamiliaresAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("af.codigo");
            $datatable->setSelect("af.codigo, af.alumno, p.nombres AS nombre_parentesco, af.parentesco,
                     af.nombres, af.apellido_paterno, af.apellido_materno, 
                     af.edad, af.estado_civil, af.grado_instruccion, 
                     af.ocupacion, af.estado, ec.nombres AS estado_civil, gi.nombres AS grado_instruccion");
            $datatable->setFrom("alumnos_familiares af INNER JOIN a_codigos p ON p.codigo = af.parentesco
                    INNER JOIN a_codigos ec ON ec.codigo = af.estado_civil
                    INNER JOIN a_codigos AS gi ON gi.codigo = af.grado_instruccion");
            $datatable->setWhere("af.estado = 'A' AND alumno = '$id' AND p.numero = 27 AND ec.numero = 26 AND gi.numero = 28");
            $datatable->setOrderby("af.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //getAjaxFamiliares
    public function getAjaxFamiliaresAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AlumnosFamiliares::findFirstBycodigo((int) $this->request->getPost("id", "int"));
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

    //Eliminar Padre
    public function eliminarFamiliaresAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AlumnosFamiliares::findFirstBycodigo((int) $this->request->getPost("id", "int"));
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
