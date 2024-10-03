<?php

class ConvocatoriasganadoresController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //--------------------------------convocatorias-----------------------------
    public function indexAction() {
        //convocatoriasganadores.js
        $this->assets->addJs("adminpanel/js/modulos/convocatoriasganadores.js?v=" . uniqid());
    }

    //datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("conv.id_convocatoria");
            $datatable->setSelect("conv.id_convocatoria, aco.nombres as tipo_resolucion, conv.titulo, conv.texto_muestra, conv.fecha_hora, conv.archivo, conv.imagen, conv.enlace, conv.estado");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("tbl_web_convocatorias conv
                INNER JOIN a_codigos aco ON CAST (conv.tipo AS INTEGER) = aco.codigo
                ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("conv.estado = 'A' AND aco.numero = 72");
            $datatable->setWhere("aco.numero = 72");
            $datatable->setOrderby("conv.id_convocatoria DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //--------------------------------perfiles----------------------------------
    public function perfilesAction($convocatoria) {

        $this->view->convocatoria = $convocatoria;
        $this->assets->addJs("adminpanel/js/modulos/convocatoriasganadores.perfiles.js?v" . uniqid());
    }

    //datatablesPerfiles
    public function datatablesPerfilesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias_perfiles.codigo");
            $datatable->setSelect("convocatorias_perfiles.codigo, "
                    . "convocatorias_perfiles.nombre, "
                    . "convocatorias_perfiles.nombre_corto, "
                    . "convocatorias_perfiles.estado, convocatorias_perfiles.convocatoria");
            $datatable->setFrom("tbl_web_convocatorias_perfiles convocatorias_perfiles");
            $datatable->setWhere("convocatorias_perfiles.convocatoria = $id");
            $datatable->setOrderby("convocatorias_perfiles.codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //--------------------------------ganadores---------------------------------
    public function ganadoresAction($perfil_puesto, $convocatoria) {

        //$auth = $this->session->get('auth');
        //echo '<pre>';
        //print_r($auth);
        //exit();

        $this->view->perfil_puesto = $perfil_puesto;
        $this->view->convocatoria = $convocatoria;

        //grado
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;

        //datos personales   
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //resultado
        $ResultadosConvocatoria = ResultadosConvocatoria::find("estado = 'A' AND numero = 89 ");
        $this->view->resultados_convocatoria = $ResultadosConvocatoria;

        $this->assets->addJs("adminpanel/js/modulos/convocatoriasganadores.ganadores.js?v" . uniqid());
    }

    //datatablepostulaciones
    public function datatableGanadoresAction($perfil, $convocatoria) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, convocatoria, perfil,fullname,anexos, publico,nro_doc, proceso");
            $datatable->setFrom("(SELECT
                                    convocatorias_publico.codigo AS codigo,convocatorias_publico.convocatoria AS convocatoria,
                                    convocatorias_publico.publico AS publico, convocatorias_publico.perfil AS perfil,
                                    convocatorias_publico.imagen AS imagen, convocatorias_publico.estado AS estado,
                                    convocatorias_publico.fecha AS fecha, convocatorias_publico.anexos AS anexos,
                                    CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS fullname,
                                    publico.nro_doc AS nro_doc,
                                    convocatorias_publico.proceso AS proceso
                                    FROM
                                    tbl_web_convocatorias_publico AS convocatorias_publico 
                                    INNER JOIN publico AS publico ON publico.codigo = convocatorias_publico.publico) AS temporal_table");
            $datatable->setWhere("perfil={$perfil} AND convocatoria = {$convocatoria} AND proceso = 3");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //getPublicoDatos
    public function getPublicoDatosGanadoresAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$Publico = Publico::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            $id_publico = (int) $this->request->getPost("id", "int");

            $GanadoresSql = $this->modelsManager->createQuery("SELECT
                                                                Publico.codigo,
                                                                Publico.tipo,
                                                                Publico.apellidop,
                                                                Publico.apellidom,
                                                                Publico.nombres,
                                                                Publico.sexo,
                                                                Publico.fecha_nacimiento,
                                                                Publico.documento,
                                                                Publico.nro_doc,
                                                                Publico.nro_ruc,
                                                                Publico.seguro,
                                                                Publico.telefono,
                                                                Publico.celular,
                                                                Publico.email,
                                                                Publico.direccion,
                                                                Publico.ciudad,
                                                                Publico.observaciones,
                                                                Publico.foto,
                                                                Publico.colegio_publico,
                                                                Publico.colegio_nombre,
                                                                Publico.sitrabaja,
                                                                Publico.sitrabaja_nombre,
                                                                Publico.sidepende,
                                                                Publico.sidepende_nombre,
                                                                Publico.estado,
                                                                Publico.region,
                                                                Publico.provincia,
                                                                Publico.distrito,
                                                                Publico.ubigeo,
                                                                Publico.region1,
                                                                Publico.provincia1,
                                                                Publico.distrito1,
                                                                Publico.ubigeo1,
                                                                Publico.localidad,
                                                                Publico.discapacitado,
                                                                Publico.discapacitado_nombre,
                                                                Publico.password,
                                                                Publico.archivo,
                                                                Publico.colegio_profesional,
                                                                Publico.colegio_profesional_nro,
                                                                Publico.estado_civil,
                                                                Publico.archivo_cp,
                                                                Publico.archivo_ruc,
                                                                Publico.archivo_dc,
                                                                Publico.sobre_ti,
                                                                Publico.voluntariado,
                                                                Publico.expectativas,
                                                                Publico.fecha_emision_dni,
                                                                ConvocatoriasPublico.archivo_dni,
                                                                ConvocatoriasPublico.archivo_ruc,
                                                                ConvocatoriasPublico.archivo_profesional,
                                                                ConvocatoriasPublico.archivo_discapacidad
                                                                FROM
                                                                Publico
                                                                INNER JOIN ConvocatoriasPublico ON Publico.codigo = ConvocatoriasPublico.publico
                                                                WHERE
                                                                Publico.codigo = $id_publico");
            $Ganadores = $GanadoresSql->execute();

            if ($Ganadores) {
                $this->response->setJsonContent($Ganadores->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //datatableConvocatoriasPublicoFormacion
    public function datatableConvocatoriasPublicoFormacionAction($publico) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("formacion.codigo");
            $datatable->setSelect("formacion.codigo, formacion.publico, formacion.grado, "
                    . "formacion.nombre, formacion.fecha_grado, formacion.institucion, formacion.pais, "
                    . "formacion.archivo, formacion.imagen, formacion.estado, grado.nombres AS nombre_grado");
            $datatable->setFrom("tbl_web_convocatorias_publico_formacion formacion INNER JOIN a_codigos grado ON grado.codigo = formacion.grado");
            $datatable->setWhere("grado.numero = 69 AND formacion.publico = {$publico}");
            $datatable->setOrderby("formacion.fecha_grado DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatableConvocatoriasPublicoCapacitaciones
    public function datatableConvocatoriasPublicoCapacitacionesAction($publico) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("capacitaciones.codigo");
            $datatable->setSelect("capacitaciones.codigo, capacitaciones.publico, capacitaciones.capacitacion, "
                    . "capacitaciones.nombre, capacitaciones.fecha_inicio, capacitaciones.fecha_fin, capacitaciones.institucion, "
                    . "capacitaciones.pais, capacitaciones.archivo, capacitaciones.imagen, capacitaciones.estado, capacitacion.nombres AS nombre_capacitacion, "
                    . "capacitaciones.horas, capacitaciones.creditos");
            $datatable->setFrom("tbl_web_convocatorias_publico_capacitaciones capacitaciones INNER JOIN a_codigos capacitacion ON capacitacion.codigo = capacitaciones.capacitacion");
            $datatable->setWhere("capacitaciones.estado = 'A' AND capacitacion.numero = 86 AND capacitaciones.publico = {$publico}");
            $datatable->setOrderby("capacitaciones.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatableConvocatoriasPublicoExperiencia
    public function datatableConvocatoriasPublicoExperienciaAction($publico) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("experiencia.codigo");
            $datatable->setSelect("experiencia.codigo, experiencia.publico, experiencia.tipo, "
                    . "experiencia.cargo, experiencia.fecha_inicio, experiencia.fecha_fin, "
                    . "experiencia.tiempo, experiencia.institucion, experiencia.funciones, "
                    . "experiencia.archivo, experiencia.imagen, experiencia.estado, tipo.nombres AS nombre_tipo");
            $datatable->setFrom("tbl_web_convocatorias_publico_experiencia experiencia INNER JOIN a_codigos tipo ON tipo.codigo = experiencia.tipo");
            $datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.publico = {$publico}");
            $datatable->setOrderby("experiencia.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getExperienciaFuncionesGanadoresAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo '<pre>';
            //print_r($_POST);
            //exit();

            $ConvocatoriasPublicoExperiencia = ConvocatoriasPublicoExperiencia::findFirstBypublico((int) $this->request->getPost("id", "int"));

            //echo '<pre>';
            //print_r($ConvocatoriasPublicoExperiencia->funciones);
            //exit();

            if ($ConvocatoriasPublicoExperiencia) {
                $this->response->setJsonContent($ConvocatoriasPublicoExperiencia->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //descarga de archivos de datos personales
    public function getArchivosDatosPersonalesAction($publico = null, $datos_personales = null) {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_ganador = Publico::findFirstBycodigo($publico);
        $ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);


        if ($datos_personales == "A") {
            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-datos-personales.zip", ZipArchive::CREATE);
            //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
            //$zip->addEmptyDir($dir);

            if ($ganador->archivo_dni !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias/documentos/personales/" . $ganador->archivo_dni, "1-" . $ganador->archivo_dni);
            }

            if ($ganador->archivo_ruc !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias/documentos/personales/" . $ganador->archivo_ruc, "2-" . $ganador->archivo_ruc);
            }

            if ($ganador->archivo_profesional !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias/documentos/personales/" . $ganador->archivo_profesional, "3-" . $ganador->archivo_profesional);
            }

            if ($ganador->archivo_discapacidad !== null) {
                $zip->addFile("adminpanel/archivos/convocatorias/documentos/personales/" . $ganador->archivo_discapacidad, "4-" . $ganador->archivo_discapacidad);
            }


            $zip->close();

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_ganador->nro_doc}-datos-personales.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-datos-personales.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-datos-personales.zip");
        }
    }

    //descarga de archivos formacion academica 
    public function getArchivosFormacionAction($publico = null, $formacion = null) {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_ganador = Publico::findFirstBycodigo($publico);
        $ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);


        if ($formacion == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-formacion-academica.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }


            $ConvocatoriasPublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                convocatorias_publico_formacion.fecha_grado,
                                                convocatorias_publico_formacion.archivo
                                                FROM
                                                ConvocatoriasPublicoFormacion convocatorias_publico_formacion
                                                WHERE
                                                convocatorias_publico_formacion.estado = 'A'
                                                AND convocatorias_publico_formacion.publico = {$ganador->publico} ORDER BY convocatorias_publico_formacion.fecha_grado DESC");
            $ConvocatoriasPublicoFormacionResult = $ConvocatoriasPublicoFormacionSql->execute();
            $num_file_formacion = 1;
            foreach ($ConvocatoriasPublicoFormacionResult as $ConvocatoriasPublicoFormacion) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($ConvocatoriasPublicoFormacion->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/convocatorias/documentos/formacion/" . $ConvocatoriasPublicoFormacion->archivo, "{$num_file_formacion}-" . $ConvocatoriasPublicoFormacion->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file_formacion++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_ganador->nro_doc}-formacion-academica.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-formacion-academica.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-formacion-academica.zip");
        }
    }

    //descarga de archivos capacitaciones
    public function getArchivosCapacitacionesAction($publico = null, $capacitaciones = null) {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_ganador = Publico::findFirstBycodigo($publico);
        $ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);


        if ($capacitaciones == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-capacitaciones.zip", ZipArchive::CREATE);

            $ConvocatoriasPublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    convocatoria_publico_capacitaciones.fecha_inicio,
                                                    convocatoria_publico_capacitaciones.archivo
                                                    FROM
                                                    ConvocatoriasPublicoCapacitaciones convocatoria_publico_capacitaciones
                                                    WHERE
                                                    convocatoria_publico_capacitaciones.estado = 'A'
                                                    AND convocatoria_publico_capacitaciones.publico = {$ganador->publico} ORDER BY convocatoria_publico_capacitaciones.fecha_inicio DESC");
            $ConvocatoriasPublicoCapacitacionesResult = $ConvocatoriasPublicoCapacitacionesSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($ConvocatoriasPublicoCapacitacionesResult as $ConvocatoriasPublicoCapacitaciones) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($ConvocatoriasPublicoCapacitaciones->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias/documentos/capacitaciones/" . $ConvocatoriasPublicoCapacitaciones->archivo, "{$num_file_capacitaciones}-" . $ConvocatoriasPublicoCapacitaciones->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_ganador->nro_doc}-capacitaciones.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-capacitaciones.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-capacitaciones.zip");
        }
    }

    //descarga de archivos de experiencia
    public function getArchivosExperienciaAction($publico = null, $experiencia = null) {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_ganador = Publico::findFirstBycodigo($publico);
        $ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);


        if ($experiencia == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-experiencia.zip", ZipArchive::CREATE);

            $ConvocatoriasPublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                convocatorias_publico_experiencia.fecha_inicio,
                                                convocatorias_publico_experiencia.archivo
                                                FROM
                                                ConvocatoriasPublicoExperiencia convocatorias_publico_experiencia
                                                WHERE
                                                convocatorias_publico_experiencia.estado = 'A' 
                                                AND convocatorias_publico_experiencia.publico = {$ganador->publico} ORDER BY convocatorias_publico_experiencia.fecha_inicio DESC");
            $ConvocatoriasPublicoExperienciaResult = $ConvocatoriasPublicoExperienciaSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($ConvocatoriasPublicoExperienciaResult as $ConvocatoriasPublicoExperiencia) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($ConvocatoriasPublicoExperiencia->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/convocatorias/documentos/experiencia/" . $ConvocatoriasPublicoExperiencia->archivo, "{$num_file_capacitaciones}-" . $ConvocatoriasPublicoExperiencia->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_ganador->nro_doc}-experiencia.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-experiencia.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_ganador->nro_doc . "-experiencia.zip");
        }
    }

}
