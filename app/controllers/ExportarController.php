<?php

class ExportarController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        //$this->assets->addJs("adminpanel/js/modulos/reportes.js?v=" . uniqid());
    }

    //reporte de asistencia
    public function mesespanion($mes)
    {
        $array = array(
            "01" => "enero",
            "02" => "febrero",
            "03" => "marzo",
            "04" => "abril",
            "05" => "mayo",
            "06" => "junio",
            "07" => "julio",
            "08" => "agosto",
            "09" => "septiembre",
            "10" => "octubre",
            "11" => "noviembre",
            "12" => "diciembre",
        );

        return $array[$mes];
    }

    // reporte registro auxiliar XLS
    public function reporteRegistroAuxiliarxlsAction($semestrex, $curso, $grupo)
    {
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];
        $full_name = $auth["full_name"];

        $semestre = Semestres::findFirst(
            [
                "codigo=" . (int) $semestrex,
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        //$VAsignaturasSemestre = VAsignaturasSemestre::findFirstBydocente_code($doc_id);

        $VAsignaturasSemestre = VAsignaturasSemestre::findFirst("semestre_code = {$semestrex} AND asignatura_code = '{$curso}' AND grupo = {$grupo} AND docente_code = {$doc_id}");

        $vista_registro_auxiliar = VFicha::find(
            [
                "semestre = {$VAsignaturasSemestre->semestre_code} AND asignatura_code ='{$VAsignaturasSemestre->asignatura_code}' AND grupo = {$VAsignaturasSemestre->grupo}",
                //'order' => 'alumno ASC',
            ]
        );
        $name = "registro_de_notas_" . $VAsignaturasSemestre->asignatura_code . "_" . $VAsignaturasSemestre->grupo . ".xls";
        header("Content-Disposition: attachment; filename=" . $name);
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>ASIGNATURA</td>";
        $test .= "<td>GRUPO</td>";
        $test .= "<td>NRO</td>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "</tr>";
        $crece = 0;
        foreach ($vista_registro_auxiliar as $key => $value) {
            $crece++;

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($VAsignaturasSemestre->asignatura_code) . "</td>";
            $test .= "<td>" . utf8_decode($VAsignaturasSemestre->grupo) . "</td>";
            $test .= "<td>" . utf8_decode($crece) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno) . "</td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        //exit();
    }

    //reporte carga academica
    //reporte de registro de notas
    public function convierte($numero)
    {
        $numero = (int) $numero;
        if ($numero < 0) {
            $numero = abs($numero);
        }

        $array = array(
            "0" => "CERO",
            "1" => "UNO",
            "2" => "DOS",
            "3" => "TRES",
            "4" => "CUATRO",
            "5" => "CINCO",
            "6" => "SEIS",
            "7" => "SIETE",
            "8" => "OCHO",
            "9" => "NUEVE",
            "10" => "DIEZ",
            "11" => "ONCE",
            "12" => "DOCE",
            "13" => "TRECE",
            "14" => "CATORCE",
            "15" => "QUINCE",
            "16" => "DIECISEIS",
            "17" => "DIECISIETE",
            "18" => "DIECIOCHO",
            "19" => "DIECINUEVE",
            "20" => "VEINTE"
        );
        return $array[$numero];
    }

    // reporte registro auxiliar XLS
    public function exportarregistroauxiliar1530Action($semestrex, $curso, $grupo)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];
        $full_name = $auth["full_name"];

        $semestre = Semestres::findFirst(
            [
                "codigo=" . (int) $semestrex,
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        //print($semestrex.$curso.$grupo);
        //exit();

        $VAsignaturasSemestre = VAsignaturasSemestre::findFirst("semestre_code = {$semestrex} AND asignatura_code = '{$curso}' AND grupo = {$grupo} AND docente_code = {$doc_id}");
        $vista_registro_auxiliar = VFicha::find(
            [
                "semestre = {$VAsignaturasSemestre->semestre_code} AND asignatura_code ='{$VAsignaturasSemestre->asignatura_code}' AND grupo = {$VAsignaturasSemestre->grupo}",
                //'order' => 'alumno ASC',
            ]
        );

        $name = "reporte-registro-auxiliar" . ".xls";
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=" . $name);
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>ASIGNATURA</td>";
        $test .= "<td>GRUPO</td>";
        $test .= "<td>NRO</td>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "<td></td>";
        $test .= "</tr>";
        $crece = 0;
        foreach ($vista_registro_auxiliar as $key => $value) {
            $crece++;

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($VAsignaturasSemestre->asignatura_code) . "</td>";
            $test .= "<td>" . utf8_decode($VAsignaturasSemestre->grupo) . "</td>";
            $test .= "<td>" . utf8_decode($crece) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno) . "</td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "<td></td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //exportar consultaactividades
    public function exportarConsultaactividadesAction($fecha_inicio = null, $fecha_fin = null, $id_personal = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=consultaactividades.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //condicion
        $where = "public.a_codigos.numero = 18 AND ((CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') AND (CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";

        //print($id_personal);
        //exit();

        //sql
        $db = $this->db;
        $sql_actividades = " SELECT
        public.tbl_doc_actividades.fecha,
        public.a_codigos.nombres AS turno,
        public.tbl_doc_actividades_detalles.descripcion AS actividad,
        public.tbl_doc_actividades_detalles.archivo
        FROM
        public.tbl_doc_actividades
        INNER JOIN public.tbl_doc_actividades_detalles ON public.tbl_doc_actividades_detalles.actividad = public.tbl_doc_actividades.id_actividad
        INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_doc_actividades_detalles.turno
        WHERE $where AND public.tbl_doc_actividades.personal = {$id_personal} ORDER BY
        public.tbl_doc_actividades.fecha ASC,
        public.tbl_doc_actividades_detalles.turno ASC";

        // print($sql_actividades);
        // exit();

        $data = $db->fetchAll($sql_actividades, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>Fecha</td>";
        $test .= "<td>Turno</td>";
        $test .= "<td>Actividad</td>";
        //$test .= "<td>Archivo</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $fecha_format = strtotime($value->fecha);
            $fecha = date("d/m/Y", $fecha_format);

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($fecha) . "</td>";
            $test .= "<td>" . utf8_decode($value->turno) . "</td>";
            $test .= "<td>" . utf8_decode($value->actividad) . "</td>";
            //$test .= "<td>" . utf8_decode($value->archivo) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        //exit();
    }

    //gestionactividades
    public function exportarGestionactividadesAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $id_personal = $auth["codigo"];

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=gestionactividades.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //condicion
        $where = "public.a_codigos.numero = 18 AND ((CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') AND (CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";

        //sql
        $db = $this->db;
        $sql_actividades = " SELECT
        public.tbl_doc_actividades.fecha,
        public.a_codigos.nombres AS turno,
        public.tbl_doc_actividades_detalles.descripcion AS actividad,
        public.tbl_doc_actividades_detalles.archivo
        FROM
        public.tbl_doc_actividades
        INNER JOIN public.tbl_doc_actividades_detalles ON public.tbl_doc_actividades_detalles.actividad = public.tbl_doc_actividades.id_actividad
        INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_doc_actividades_detalles.turno
        WHERE $where AND public.tbl_doc_actividades.personal = {$id_personal} ORDER BY
        public.tbl_doc_actividades.fecha ASC,
        public.tbl_doc_actividades_detalles.turno ASC";

        // print($sql_actividades);
        // exit();

        $data = $db->fetchAll($sql_actividades, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>Fecha</td>";
        $test .= "<td>Turno</td>";
        $test .= "<td>Actividad</td>";

        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $fecha_format = strtotime($value->fecha);
            $fecha = date("d/m/Y", $fecha_format);

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($fecha) . "</td>";
            $test .= "<td>" . utf8_decode($value->turno) . "</td>";
            $test .= "<td>" . utf8_decode($value->actividad) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //reporteBtrpublicaciones panel empresa
    public function reporteBtrpublicacionesAction($fechaCreaccion = null, $fechaClausura = null)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $idEmpresa = $auth["id_empresa"];
        $nombreEmpresa = $auth["nombres"];

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=publicaciones-bolsa-de-trabajo.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //condicion
        //$where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}') AND (CAST (e.fecha_clausura AS DATE) BETWEEN '{$fechaCreaccion}' AND '$fechaClausura'))";
        $where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}'))";

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
        e.id_empleo AS pk,
        e.id_empleo,
        r.descripcion AS region,
        d.descripcion AS distrito,
        C.nombres AS cargo,
        j.descripcion AS jornada,
        tc.descripcion AS tipocontrato,
        e.fecha_creacion,
        e.fecha_clausura,
        e.titulo,
        e.descripcion,
        e.salario,
        e.requisitos,
        e.cantidad_vacantes,
        e.numero_visitas AS numero_visitas,
        ( SELECT COUNT ( empleo ) AS postulo FROM tbl_btr_postulaciones WHERE empleo = e.id_empleo ),
        e.estado
    FROM
        tbl_btr_empleos e
        INNER JOIN regiones r ON r.region = e.region_id
        INNER JOIN distritos d ON ( d.distrito = e.distrito_id AND d.region = e.region_id AND d.provincia = e.provincia_id )
        INNER JOIN a_codigos C ON C.codigo = e.cargo
        INNER JOIN a_codigos j ON j.codigo = e.jornada
        INNER JOIN a_codigos tc ON tc.codigo = e.tipocontrato
    WHERE
        $where
        AND e.estado = 'A'
        AND C.numero = 45
        AND j.numero = 46
        AND tc.numero = 47
        AND e.empresa = {$idEmpresa}";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>Fecha Creacion</td>";
        $test .= "<td>Fecha Clausura</td>";
        $test .= "<td>Titulo</td>";
        $test .= "<td>Region</td>";
        $test .= "<td>Distrito</td>";
        $test .= "<td>Cargo</td>";
        $test .= "<td>Nro Postulantes</td>";
        $test .= "<td>Nro Visitas</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $fechaFormatoInicio = strtotime($value->fecha_creacion);
            $fechaInicio = date("d/m/Y", $fechaFormatoInicio);

            $fechaFormatoFin = strtotime($value->fecha_clausura);
            $fechaFin = date("d/m/Y", $fechaFormatoFin);

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($fechaInicio) . "</td>";
            $test .= "<td>" . utf8_decode($fechaFin) . "</td>";
            $test .= "<td>" . utf8_decode($value->titulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->region) . "</td>";
            $test .= "<td>" . utf8_decode($value->distrito) . "</td>";
            $test .= "<td>" . utf8_decode($value->cargo) . "</td>";
            $test .= "<td>" . utf8_decode($value->postulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->numero_visitas) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        //exit();
    }

    //reporteBtrpublicacionesEmpleos panel admin
    public function reporteBtrpublicacionesEmpleosAction($fechaCreaccion = null, $fechaClausura = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=publicaciones-bolsa-de-trabajo.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //condicion
        //$where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}') AND (CAST (e.fecha_clausura AS DATE) BETWEEN '{$fechaCreaccion}' AND '$fechaClausura'))";
        $where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}'))";

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
            e.id_empleo AS pk,
            e.id_empleo,
            r.descripcion AS region,
            emp.imagen,
            emp.razon_social,
            d.descripcion AS distrito,
            C.nombres AS cargod,
            j.nombres AS jornada,
            tc.nombres AS tipocontrato,
            e.fecha_creacion,
            e.fecha_clausura,
            e.titulo,
            e.descripcion,
            e.salario,
            e.requisitos,
            e.cantidad_vacantes,
            e.numero_visitas,
            ( SELECT COUNT ( empleo ) AS postulo FROM tbl_btr_postulaciones WHERE empleo = e.id_empleo ),
            e.estado
        FROM
            tbl_btr_empleos e
            INNER JOIN regiones r ON r.region = e.region_id
            INNER JOIN distritos d ON ( d.distrito = e.distrito_id AND d.region = e.region_id AND d.provincia = e.provincia_id )
            INNER JOIN tbl_btr_empresas emp ON emp.id_empresa = e.empresa
            INNER JOIN a_codigos C ON C.codigo = e.cargo
            INNER JOIN a_codigos j ON j.codigo = e.jornada
            INNER JOIN a_codigos tc ON tc.codigo = e.tipocontrato
        WHERE
            $where
            AND e.estado = 'A'
            AND C.numero = 45
            AND j.numero = 46
            AND tc.numero = 47";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>Fecha Creacion</td>";
        $test .= "<td>Fecha Clausura</td>";
        $test .= "<td>Razon Social</td>";
        $test .= "<td>Titulo</td>";
        $test .= "<td>Region</td>";
        $test .= "<td>Distrito</td>";
        $test .= "<td>Cargo</td>";
        $test .= "<td>Nro Postulantes</td>";
        $test .= "<td>Nro Visitas</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $fechaFormatoInicio = strtotime($value->fecha_creacion);
            $fechaInicio = date("d/m/Y", $fechaFormatoInicio);

            $fechaFormatoFin = strtotime($value->fecha_clausura);
            $fechaFin = date("d/m/Y", $fechaFormatoFin);

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($fechaInicio) . "</td>";
            $test .= "<td>" . utf8_decode($fechaFin) . "</td>";
            $test .= "<td>" . utf8_decode($value->razon_social) . "</td>";
            $test .= "<td>" . utf8_decode($value->titulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->region) . "</td>";
            $test .= "<td>" . utf8_decode($value->distrito) . "</td>";
            $test .= "<td>" . utf8_decode($value->cargod) . "</td>";
            $test .= "<td>" . utf8_decode($value->postulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->numero_visitas) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        //exit();
    }

    //reporteBtrpublicaciones panel empresa
    public function reporteBtrpublicacionesPostulantesAction($idEmpleo)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $idEmpresa = $auth["id_empresa"];
        $nombreEmpresa = $auth["nombres"];

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=publicaciones-bolsa-de-trabajo.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
            empleo,
            tipo_alumno AS tipo,
            alumno_codigo,
            alumno_nombres,
            dni,
            carrera_nombre,
            alumno_celular,
            alumno_direccion,
            email_alumno,
            estado
            FROM
            (
            SELECT P
                .alumno AS alumno_codigo,
                P.empleo,
                al.celular AS alumno_celular,
                al.nro_doc AS dni,
                a_c.nombres AS tipo_alumno,
                al.email1 AS email_alumno,
                al.direccion AS alumno_direccion,
                carre.descripcion AS carrera_nombre,
                P.estado,
                CONCAT ( al.apellidop, ' ', al.apellidom, ' ', al.nombres ) AS alumno_nombres
            FROM
                tbl_btr_postulaciones
                AS P INNER JOIN alumnos al ON al.codigo = P.alumno
                INNER JOIN a_codigos a_c ON al.tipo = a_c.codigo
                INNER JOIN carreras carre ON al.carrera = carre.codigo
            WHERE
                a_c.numero = 16
            ) AS tempx
            WHERE
            empleo = {$idEmpleo}";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>Tipo</td>";
        $test .= "<td>Codigo</td>";
        $test .= "<td>Apellidos Nombres</td>";
        $test .= "<td>DNI</td>";
        $test .= "<td>Carrera</td>";
        $test .= "<td>Celular</td>";
        $test .= "<td>Direccion</td>";
        $test .= "<td>Email</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_nombres) . "</td>";
            $test .= "<td>" . utf8_decode($value->dni) . "</td>";
            $test .= "<td>" . utf8_decode($value->carrera_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_celular) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_direccion) . "</td>";
            $test .= "<td>" . utf8_decode($value->email_alumno) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        //exit();
    }

    //reporteBtrpublicacionesPostulantesEmpleos panel admin
    public function reporteBtrpublicacionesPostulantesEmpleosAction($idEmpleo)
    {
        $this->view->disable();

        //$auth = $this->session->get('auth');
        //$idEmpresa = $auth["id_empresa"];
        //$nombreEmpresa = $auth["nombres"];

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=publicaciones-bolsa-de-trabajo.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
            empleo,
            tipo_alumno AS tipo,
            alumno_codigo,
            alumno_nombres,
            dni,
            carrera_nombre,
            alumno_celular,
            alumno_direccion,
            email_alumno,
            estado
            FROM
            (
            SELECT P
                .alumno AS alumno_codigo,
                P.empleo,
                al.celular AS alumno_celular,
                al.nro_doc AS dni,
                a_c.nombres AS tipo_alumno,
                al.email1 AS email_alumno,
                al.direccion AS alumno_direccion,
                carre.descripcion AS carrera_nombre,
                P.estado,
                CONCAT ( al.apellidop, ' ', al.apellidom, ' ', al.nombres ) AS alumno_nombres
            FROM
                tbl_btr_postulaciones
                AS P INNER JOIN alumnos al ON al.codigo = P.alumno
                INNER JOIN a_codigos a_c ON al.tipo = a_c.codigo
                INNER JOIN carreras carre ON al.carrera = carre.codigo
            WHERE
                a_c.numero = 16
            ) AS tempx
            WHERE
            empleo = {$idEmpleo}";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>Tipo</td>";
        $test .= "<td>Codigo</td>";
        $test .= "<td>Apellidos Nombres</td>";
        $test .= "<td>DNI</td>";
        $test .= "<td>Carrera</td>";
        $test .= "<td>Celular</td>";
        $test .= "<td>Direccion</td>";
        $test .= "<td>Email</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_nombres) . "</td>";
            $test .= "<td>" . utf8_decode($value->dni) . "</td>";
            $test .= "<td>" . utf8_decode($value->carrera_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_celular) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno_direccion) . "</td>";
            $test .= "<td>" . utf8_decode($value->email_alumno) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
        //exit();
    }

    public function reporteListaEgresadosAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-lista-egresados.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
        carreras_codigo,
        carreras_nombre
        FROM
        (
        SELECT PUBLIC
            .alumnos.codigo AS id_alumno,
            PUBLIC.carreras.descripcion AS carreras_nombre,
            PUBLIC.carreras.codigo AS carreras_codigo,
            PUBLIC.alumnos.estado
        FROM
            PUBLIC.alumnos
            INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
        WHERE
            PUBLIC.alumnos.estado = 'A'
        AND PUBLIC.alumnos.tipo = 2
        ) AS temporal_table
        GROUP BY
        carreras_codigo,
        carreras_nombre";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
        } else {

            foreach ($Carreras as $carrera) {
                //sql
                $db = $this->db;
                $sqlQuery = "SELECT
                id_alumno,
                carreras_codigo,
                carreras_nombre,
                alumnos_nombre,
                alumnos_email,
                alumnos_celular,
                nro_doc,
                estado
                FROM
                (
                SELECT public
                    .alumnos.codigo AS id_alumno,
                    public.carreras.codigo AS carreras_codigo,
                    public.carreras.descripcion AS carreras_nombre,
                    CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumnos_nombre,
                    public.alumnos.nro_doc AS nro_doc,
                    public.alumnos.email1 AS alumnos_email,
                    public.alumnos.celular AS alumnos_celular,
                    public.alumnos.estado AS estado
                FROM
                    public.alumnos
                    INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
                WHERE
                    public.alumnos.estado = 'A'
                AND public.alumnos.tipo = 2
                AND public.carreras.codigo = '{$carrera->carreras_codigo}'
                ) AS temporal_table";

                //sql
                //print($sqlQuery);
                //exit();

                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

                $test = "<table border='1'>";
                $test .= "<tr>";
                $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode("RELACIÓN DE EGRESADOS") . "</td>";
                $test .= "</tr>";
                $test .= "<tr>";
                $test .= "<td colspan='5'>CARRERA PROFESIONAL: " . utf8_decode($carrera->carreras_nombre) . "</td>";
                $test .= "</tr>";
                $test .= "<tr>";
                $test .= "<td>" . utf8_decode("N°") . "</td>";
                $test .= "<td>CODIGO</td>";
                $test .= "<td style='width:600px'>APELLIDOS Y NOMBRES</td>";
                $test .= "<td>EMAIL</td>";
                $test .= "<td style='width:100px'>CELULAR</td>";
                $test .= "</tr>";
                $crece = 0;
                foreach ($data as $key => $value) {
                    $crece++;
                    $test .= "<tr>";
                    $test .= "<td>" . $crece . "</td>";
                    $test .= "<td>" . utf8_decode($value->id_alumno) . "</td>";
                    $test .= "<td>" . utf8_decode($value->alumnos_nombre) . "</td>";
                    $test .= "<td>" . utf8_decode($value->alumnos_email) . "</td>";
                    $test .= "<td>" . utf8_decode($value->alumnos_celular) . "</td>";
                    $test .= "</tr>";
                }
                $test .= "</table>";
                $test .= "<br>";
                print $test;
                //exit();
            }
        }
    }

    public function reporteListaEstudiantesAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-lista-estudiantes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
        carreras_codigo,
        carreras_nombre
    FROM
        (
        SELECT PUBLIC
            .alumnos.codigo AS id_alumno,
            PUBLIC.carreras.descripcion AS carreras_nombre,
            PUBLIC.carreras.codigo AS carreras_codigo,
            PUBLIC.alumnos.estado
        FROM
            PUBLIC.alumnos
            INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
            INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo
            AND PUBLIC.alumnos.semestre = PUBLIC.alumnos_semestre.semestre
        WHERE
            PUBLIC.alumnos.estado = 'A'
            AND PUBLIC.alumnos_semestre.semestre = 4
            AND PUBLIC.alumnos.tipo = 1
        ) AS temporal_table
    GROUP BY
        carreras_codigo,
        carreras_nombre";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
        } else {

            foreach ($Carreras as $carrera) {
                //sql
                $db = $this->db;
                $sqlQuery = "SELECT
                id_alumno,
                alumnos_nombre,
                alumnos_email,
                alumnos_celular,
                estado
                FROM
                (
                SELECT public
                    .alumnos.codigo AS id_alumno,
                    CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumnos_nombre,
                    public.alumnos.email1 AS alumnos_email,
                    public.alumnos.celular AS alumnos_celular,
                    public.alumnos.estado
                FROM
                    public.alumnos
                    INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
                    INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
                    AND public.alumnos.semestre = public.alumnos_semestre.semestre
                WHERE
                    public.alumnos.estado = 'A'
                    AND public.alumnos_semestre.semestre = 4
                    AND public.carreras.codigo = '{$carrera->carreras_codigo}'
                    AND public.alumnos.tipo = 1
                ) AS temporal_table
                ORDER BY
                alumnos_nombre ASC";

                //sql
                //print($sqlQuery);
                //exit();

                $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

                $test = "<table border='1'>";
                $test .= "<tr>";
                $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode("RELACIÓN DE ESTUDIANTES") . "</td>";
                $test .= "</tr>";
                $test .= "<tr>";
                $test .= "<td colspan='5'>CARRERA PROFESIONAL: " . utf8_decode($carrera->carreras_nombre) . "</td>";
                $test .= "</tr>";
                $test .= "<tr>";
                $test .= "<td>" . utf8_decode("N°") . "</td>";
                $test .= "<td>CODIGO</td>";
                $test .= "<td style='width:600px'>APELLIDOS Y NOMBRES</td>";
                $test .= "<td>EMAIL</td>";
                $test .= "<td style='width:100px'>CELULAR</td>";
                $test .= "</tr>";
                $crece = 0;
                foreach ($data as $key => $value) {
                    $crece++;
                    $test .= "<tr>";
                    $test .= "<td>" . $crece . "</td>";
                    $test .= "<td>" . utf8_decode($value->id_alumno) . "</td>";
                    $test .= "<td>" . utf8_decode($value->alumnos_nombre) . "</td>";
                    $test .= "<td>" . utf8_decode($value->alumnos_email) . "</td>";
                    $test .= "<td>" . utf8_decode($value->alumnos_celular) . "</td>";
                    $test .= "</tr>";
                }
                $test .= "</table>";
                $test .= "<br>";
                print $test;
                //exit();
            }
        }
    }

    //reporteRegistrocvFormacion
    public function reporteRegistrocvFormacionAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-formacion-academica.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
        formacion.codigo,
        grado.nombres AS grado_nombre,
        formacion.nombre,
        formacion.publico,
        formacion.grado,
        har(formacion.fecha_grado, 'DD/MM/YYYY') AS fecha_gto_crado,
        formacion.institucion,
        formacion.pais,
        formacion.archivo
        FROM
        tbl_web_publico_formacion formacion
        INNER JOIN a_codigos grado ON grado.codigo = formacion.grado
        WHERE
        formacion.estado = 'A'
        AND grado.numero = 69
        AND formacion.publico = 8 ";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='3'>" . utf8_decode("Registro de Formacion Académica") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("Grado / Título") . "</td>";
        $test .= "<td>" . utf8_decode("Denominación del Grado / Título alcanzado") . "</td>";
        $test .= "<td>Fecha</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->grado_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_grado) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //reporteRegistrocvCapacitaciones
    public function reporteRegistrocvCapacitacionesAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-capacitaciones.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
            capacitaciones.codigo,
            capacitaciones.publico,
            capacitaciones.capacitacion,
            capacitaciones.nombre,
            to_char(capacitaciones.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(capacitaciones.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            capacitaciones.institucion,
            capacitaciones.pais,
            capacitacion.nombres AS capacitacion_nombre,
            capacitaciones.horas,
            capacitaciones.creditos
            FROM
            tbl_web_publico_capacitaciones capacitaciones
            INNER JOIN a_codigos capacitacion ON capacitacion.codigo = capacitaciones.capacitacion
            WHERE
            capacitaciones.estado = 'A'
            AND capacitacion.numero = 86
            AND capacitaciones.publico = 8 ";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode("Registro de Cursos, Diplomados o Capacitaciones") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>Especialidad</td>";
        $test .= "<td>" . utf8_decode("Denominación del curso, diplomado o especialización") . "</td>";
        $test .= "<td>Horas</td>";
        $test .= "<td>Fecha Inicio</td>";
        $test .= "<td>Fecha Fin</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->capacitacion_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->horas) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inicio) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_fin) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //reporteRegistrocvCapacitaciones
    public function reporteRegistrocvExperienciaAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-experiencia.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //sql
        $db = $this->db;
        $sqlQuery = "SELECT
            experiencia.codigo AS pk,
            experiencia.codigo,
            experiencia.publico,
            experiencia.tipo,
            experiencia.cargo,
            to_char(experiencia.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(experiencia.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            experiencia.tiempo,
            experiencia.institucion,
            experiencia.funciones,
            experiencia.archivo,
            experiencia.imagen,
            experiencia.estado,
            tipo.nombres AS tipo_nombre
        FROM
            tbl_web_publico_experiencia experiencia
            INNER JOIN a_codigos tipo ON tipo.codigo = experiencia.tipo
        WHERE
            experiencia.estado = 'A'
            AND tipo.numero = 87
            AND experiencia.publico = 8";

        //print($sqlQuery);
        //exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode("Registro de Experiencia Laboral") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>Tipo</td>";
        $test .= "<td>Cargo</td>";
        $test .= "<td>" . utf8_decode("Institución") . "</td>";
        $test .= "<td>Fecha Inicio</td>";
        $test .= "<td>Fecha Fin</td>";
        $test .= "</tr>";
        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->tipo_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->cargo) . "</td>";
            $test .= "<td>" . utf8_decode($value->institucion) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inicio) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_fin) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //exportarLibrosreservasweb
    public function exportarLibrosreservaswebAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        //print($id_personal);
        //exit();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=librosreservasweb.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        //print($id_personal);
        //exit();

        $vPrestamosSolicitudes = VPrestamosSolicitudes::find("tipo=1 AND (CAST (fecha_reserva AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>LECTOR</td>";
        $test .= "<td>FECHA RESERVA</td>";
        //$test .= "<td>Archivo</td>";
        $test .= "</tr>";
        foreach ($vPrestamosSolicitudes as $key => $value) {
            if ($value->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipo = 'PÚBLICO';
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->codigo_lector) . "</td>";
            $test .= "<td>" . utf8_decode($tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->lector) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_reserva) . "</td>";
            //$test .= "<td>" . utf8_decode($value->archivo) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    public function exportarLibrosprestamoswebAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=librosprestamosweb.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $vPrestamosConfirmados = VPrestamosConfirmados::find("tipo=1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>LECTOR</td>";
        $test .= "<td>FECHA PRESTAMO</td>";
        $test .= "<td>FECHA DEVOLUCION</td>";
        $test .= "</tr>";
        foreach ($vPrestamosConfirmados as $key => $value) {
            if ($value->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipo = 'PÚBLICO';
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->codigo_lector) . "</td>";
            $test .= "<td>" . utf8_decode($tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->lector) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_entrega) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_devolucion) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    public function exportarLibrosprestamoslistawebAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=librosprestamoslistaweb.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $vPrestamosLista = VPrestamosLista::find("tipo=1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>LECTOR</td>";
        $test .= "<td>FECHA RESERVA</td>";
        $test .= "<td>FECHA PRESTAMO</td>";
        $test .= "<td>FECHA DEVOLUCION CONFIRMADA</td>";
        $test .= "</tr>";
        foreach ($vPrestamosLista as $key => $value) {
            if ($value->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipo = 'PÚBLICO';
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->codigo_lector) . "</td>";
            $test .= "<td>" . utf8_decode($tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->lector) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_reserva) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_entrega) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_devolucion_confirmada) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    public function exportarLibrosprestamosAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=librosprestamos.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $vPrestamosConfirmados = VPrestamosConfirmados::find("tipo > 1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ORDER BY codigos DESC");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>LECTOR</td>";
        $test .= "<td>FECHA PRESTAMO</td>";
        $test .= "<td>FECHA DEVOLUCION</td>";
        $test .= "</tr>";
        foreach ($vPrestamosConfirmados as $key => $value) {
            if ($value->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipo = 'PÚBLICO';
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->codigo_lector) . "</td>";
            $test .= "<td>" . utf8_decode($tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->lector) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_entrega) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_devolucion) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    // exportarlibrosprestamoslista
    public function exportarlibrosprestamoslistaAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=librosprestamoslista.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $vPrestamosLista = VPrestamosLista::find("tipo > 1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>LECTOR</td>";
        $test .= "<td>FECHA PRESTAMO</td>";
        $test .= "<td>FECHA DEVOLUCION CONFIRMADA</td>";
        $test .= "</tr>";
        foreach ($vPrestamosLista as $key => $value) {
            if ($value->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipo = 'PÚBLICO';
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->codigo_lector) . "</td>";
            $test .= "<td>" . utf8_decode($tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->lector) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_entrega) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_devolucion_confirmada) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    public function exportarRegistroAuxiliarDatosEstudiantes1530Action($semestrex, $curso, $grupo)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];
        $full_name = $auth["full_name"];

        $semestre = Semestres::findFirst(
            [
                "codigo=" . (int) $semestrex,
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        //print($semestrex.$curso.$grupo);
        //exit();

        $VAsignaturasSemestre = VAsignaturasSemestre::findFirst("semestre_code = {$semestrex} AND asignatura_code = '{$curso}' AND grupo = {$grupo} AND docente_code = {$doc_id}");
        $vista_registro_auxiliar = VFicha::find(
            [
                "semestre = {$VAsignaturasSemestre->semestre_code} AND asignatura_code ='{$VAsignaturasSemestre->asignatura_code}' AND grupo = {$VAsignaturasSemestre->grupo}",
                //'order' => 'alumno ASC',
            ]
        );

        $name = "reporte-registro-auxiliar-datos-estudiantes" . ".xls";
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=" . $name);
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>ASIGNATURA</td>";
        $test .= "<td>GRUPO</td>";
        $test .= "<td>NRO</td>";
        $test .= "<td>CODIGO</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td>DNI</td>";
        $test .= "<td>EMAIL</td>";
        $test .= "<td>CELULAR</td>";
        $test .= "</tr>";
        $crece = 0;
        foreach ($vista_registro_auxiliar as $key => $value) {
            $crece++;

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($VAsignaturasSemestre->asignatura_code) . "</td>";
            $test .= "<td>" . utf8_decode($VAsignaturasSemestre->grupo) . "</td>";
            $test .= "<td>" . utf8_decode($crece) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->alumno) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->email1) . "</td>";
            $test .= "<td>" . utf8_decode($value->celular) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //exportarInvproyectos
    public function exportarInvproyectosAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=relacion-registro-de-proyectos.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $where = "((CAST (fecha_inicio AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";
        $db = $this->db;
        $sql_query = "SELECT
        public.tbl_inv_proyectos.titulo,
        to_char(PUBLIC.tbl_inv_proyectos.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
	    to_char(PUBLIC.tbl_inv_proyectos.fecha_termino, 'DD/MM/YYYY') AS fecha_termino,
        CONCAT ( public.docentes.apellidop, ' ',public.docentes.apellidom, ' ', public.docentes.nombres) AS investigador_principal,
        public.tbl_inv_proyectos.estado
        FROM
        public.tbl_inv_proyectos
        INNER JOIN public.tbl_inv_proyectos_investigadores ON public.tbl_inv_proyectos.id_proyecto = public.tbl_inv_proyectos_investigadores.id_proyecto
        INNER JOIN public.docentes ON public.tbl_inv_proyectos_investigadores.codigo = public.docentes.codigo
        WHERE
        $where AND public.tbl_inv_proyectos.estado = 'A' AND
        public.docentes.condicion = 1";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode("RELACIÓN REGISTRO DE PROYECTOS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>NOMBRE PROYECTO</td>";
        $test .= "<td>FECHA INICIO</td>";
        $test .= "<td>FECHA FIN</td>";
        $test .= "<td>INVESTIGADOR PRINCIPAL</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->titulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inicio) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_termino) . "</td>";
            $test .= "<td>" . utf8_decode($value->investigador_principal) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //gestioninvproyectos
    public function exportarGestioninvproyectosAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=relacion-registro-de-proyectos.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $where = "((CAST (fecha_inicio AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";
        $db = $this->db;
        $sql_query = "SELECT
        public.tbl_inv_proyectos.titulo,
        to_char(PUBLIC.tbl_inv_proyectos.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
	    to_char(PUBLIC.tbl_inv_proyectos.fecha_termino, 'DD/MM/YYYY') AS fecha_termino,
        CONCAT ( public.docentes.apellidop, ' ',public.docentes.apellidom, ' ', public.docentes.nombres) AS investigador_principal,
        public.tbl_inv_proyectos.avance,
        public.tbl_inv_proyectos.proceso,
        public.tbl_inv_proyectos.estado
        FROM
        public.tbl_inv_proyectos
        INNER JOIN public.tbl_inv_proyectos_investigadores ON public.tbl_inv_proyectos.id_proyecto = public.tbl_inv_proyectos_investigadores.id_proyecto
        INNER JOIN public.docentes ON public.tbl_inv_proyectos_investigadores.codigo = public.docentes.codigo
        WHERE
        $where AND public.tbl_inv_proyectos.estado = 'A' AND
        public.docentes.condicion = 1";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='7'>" . utf8_decode("RELACIÓN REGISTRO DE PROYECTOS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>NOMBRE PROYECTO</td>";
        $test .= "<td>FECHA INICIO</td>";
        $test .= "<td>FECHA FIN</td>";
        $test .= "<td>INVESTIGADOR PRINCIPAL</td>";
        $test .= "<td>AVANCE</td>";
        $test .= "<td>PROCESO</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->titulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inicio) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_termino) . "</td>";
            $test .= "<td>" . utf8_decode($value->investigador_principal) . "</td>";
            $test .= "<td>" . utf8_decode($value->avance) . "</td>";
            $test .= "<td>" . utf8_decode($value->proceso) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //gestionmesadeayuda/atenciones
    public function exportarGestionmesadeayudaAtencionesAction($tipoAtencion = null, $proceso = null, $fechaInicio = null, $fechaFin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=gestion-mesa-de-ayuda.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        if ($tipoAtencion != 0 and $proceso == 0 and $fechaInicio != 0 and $fechaFin != 0) {

            $where = "AND atenciones.tipo = {$tipoAtencion} AND (CAST (atenciones.fecha_recepcion AS DATE) BETWEEN '{$fechaInicio}' AND '{$fechaFin}')";
        } else if ($tipoAtencion == 0 and $proceso != 0 and $fechaInicio != 0 and $fechaFin != 0) {

            $where = "AND atenciones.proceso = {$proceso} AND (CAST (atenciones.fecha_recepcion AS DATE) BETWEEN '{$fechaInicio}' AND '{$fechaFin}')";
        } else if ($tipoAtencion != 0 and $proceso != 0 and $fechaInicio != 0 and $fechaFin != 0) {

            $where = "AND atenciones.tipo = {$tipoAtencion} AND atenciones.proceso = {$proceso} AND (CAST (atenciones.fecha_recepcion AS DATE) BETWEEN '{$fechaInicio}' AND '{$fechaFin}')";
        } else {

            $where = "AND ((CAST (atenciones.fecha_recepcion AS DATE) BETWEEN '{$fechaInicio}' AND '{$fechaFin}'))";
        }

        $db = $this->db;
        $sql_query = "SELECT
        codigo,
        publico,
        dni,
        asunto,
        tipo,
        prioridad,
        fecha_recepcion,
        fecha_inicio,
        fecha_termino,
        proceso,
        estado,
        tipo_atencion,
        proceso_nombre
        FROM
        (
            SELECT
            atenciones.codigo AS codigo,
            tipo_atencion.nombres AS tipo,
            prioridad.nombres AS prioridad,
            to_char(atenciones.fecha_recepcion, 'DD/MM/YYYY') AS fecha_recepcion,
            to_char(atenciones.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(atenciones.fecha_termino, 'DD/MM/YYYY') AS fecha_termino,
            atenciones.proceso AS proceso,
            atenciones.estado AS estado,
            CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS publico,
            public.publico.nro_doc AS dni,
            atenciones.asunto,
            atenciones.tipo AS tipo_atencion,
            procesos.nombres AS proceso_nombre
            FROM
            public.tbl_hdk_atenciones AS atenciones
            INNER JOIN public.a_codigos AS tipo_atencion ON tipo_atencion.codigo = atenciones.tipo
            INNER JOIN public.a_codigos AS prioridad ON prioridad.codigo = atenciones.prioridad
            INNER JOIN public.publico ON public.publico.codigo = atenciones.publico
            INNER JOIN public.a_codigos AS procesos ON procesos.codigo = atenciones.proceso
            WHERE
            tipo_atencion.numero = 52 AND
            prioridad.numero = 53 AND
            procesos.numero = 94 $where
        ) AS temporal_table
        ORDER BY
        codigo DESC";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='8'>" . utf8_decode("RELACIÓN REGISTRO DE ATENCIONES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("DNI") . "</td>";
        $test .= "<td>USUARIO</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>PRIORIDAD</td>";
        $test .= "<td>" . utf8_decode("FECHA RECEPCIÓN") . "</td>";
        $test .= "<td>" . utf8_decode("FECHA PREVISTA") . "</td>";
        $test .= "<td>" . utf8_decode("FECHA TERMINO") . "</td>";
        $test .= "<td>" . utf8_decode("PROCESO") . "</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($value->dni) . "</td>";
            $test .= "<td>" . utf8_decode($value->publico) . "</td>";
            $test .= "<td>" . utf8_decode($value->tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->prioridad) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_recepcion) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inicio) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_termino) . "</td>";
            $test .= "<td>" . utf8_decode($value->proceso_nombre) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    //exportarGestionadmisionPostulantes
    public function exportarGestionadmisionPostulantesAction($fechaInicio = null, $fechaFin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=postulantes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $where = "((CAST (fecha_inscripcion AS DATE) BETWEEN '{$fechaInicio}' AND '{$fechaFin}'))";

        $db = $this->db;
        $sql_query = "SELECT
        postulante, nro_doc, nombres_apellidos, colegio_publico, colegio_nombre, recibo, postulante, postulante, escuela, universidad, monto, imagen, fecha_inscripcion, proceso_nombre, tipoinstitucion_nombres, celular, email
        FROM
        (
            SELECT ADMIN
            .postulante,
            ADMIN.admision,
            ADMIN.modalidad,
            to_char(ADMIN.fecha_inscripcion, 'DD/MM/YYYY') AS fecha_inscripcion,
            ADMIN.tipo_inscripcion,
            ADMIN.recibo,
            ADMIN.concepto,
            ADMIN.fecha_registro,
            ADMIN.fecha_modificacion,
            ADMIN.monto,
            ADMIN.estado,
            ADMIN.puesto,
            ADMIN.puntaje,
            ADMIN.modalidad_ingreso,
            ADMIN.carrera1,
            ADMIN.carrera2,
            ADMIN.imagen,
            ADMIN.proceso,
            ADMIN.observaciones,
            CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS nombres_apellidos,
            P.colegio_publico,
            P.colegio_nombre,
            P.escuela,
            P.institucion,
            P.nro_doc,
            P.foto,
            P.archivo,
            P.archivo_escuela,
            P.celular,
            P.email,
            proceso.nombres AS proceso_nombre,
            categorias.nombres AS categoria_nombres,
            tipoinstitucion.nombres AS tipoinstitucion_nombres,
            universidades.universidad
            FROM
            admision_postulantes
            ADMIN INNER JOIN publico P ON ADMIN.postulante = P.codigo
            INNER JOIN public.a_codigos AS proceso ON proceso.codigo = ADMIN.proceso
            INNER JOIN public.a_codigos AS categorias ON categorias.codigo = P.categoria
            INNER JOIN public.tbl_web_universidades AS universidades ON universidades.id_universidad = P.id_universidad
            INNER JOIN public.a_codigos AS tipoinstitucion ON universidades.tipo_institucion = tipoinstitucion.codigo
            WHERE
            $where AND proceso.numero = 106 AND categorias.numero = 104 AND tipoinstitucion.numero = 105) AS temporal_table";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='13'>" . utf8_decode("RELACIÓN DE POSTULANTES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("CÓDIGO") . "</td>";
        $test .= "<td>NRO DOC</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td>CELULAR</td>";
        $test .= "<td>EMAIL</td>";
        $test .= "<td>TIPO INSTITUCION</td>";
        $test .= "<td>UNIVERSIDAD</td>";
        $test .= "<td>NOMBRE DE ESCUELA</td>";
        $test .= "<td>" . utf8_decode("FECHA INSCRIPCIÓN") . "</td>";
        $test .= "<td>NRO RECIBO</td>";
        $test .= "<td>MONTO</td>";
        $test .= "<td>PROCESO</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->postulante) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombres_apellidos) . "</td>";
            $test .= "<td>" . utf8_decode($value->celular) . "</td>";
            $test .= "<td>" . utf8_decode($value->email) . "</td>";
            $test .= "<td>" . utf8_decode($value->tipoinstitucion_nombres) . "</td>";
            $test .= "<td>" . utf8_decode($value->universidad) . "</td>";
            $test .= "<td>" . utf8_decode($value->escuela) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inscripcion) . "</td>";
            $test .= "<td>" . utf8_decode($value->recibo) . "</td>";
            $test .= "<td>" . utf8_decode($value->monto) . "</td>";
            $test .= "<td>" . utf8_decode($value->proceso_nombre) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }



    public function exportargestiontramitedocumentarioAction($fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=documentosrecibidos.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $where = "((CAST (fecha_envio AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";
        $db = $this->db;
        $sql_query = "
        SELECT
        id_doc,
        fecha_envio,
        fecha_cargo,
        tipo_documento,
        nro_documento,
        remitente_nombres,
        destinatario_personal,
        archivo,
        estado 
        FROM
        (
        SELECT PUBLIC
            .tbl_doc_documentos.id_doc,
            to_char( PUBLIC.tbl_doc_documentos.fecha_envio, 'DD/MM/YYYY' ) AS fecha_envio,
            to_char( PUBLIC.tbl_doc_documentos.fecha_cargo, 'DD/MM/YYYY' ) AS fecha_cargo,
            PUBLIC.a_codigos.nombres AS tipo_documento,
            PUBLIC.tbl_doc_documentos.nro_documento,
            PUBLIC.tbl_doc_documentos.destinatario_personal,
            PUBLIC.tbl_doc_documentos.remitente_nombres,
            PUBLIC.tbl_doc_documentos.archivo,
            PUBLIC.tbl_doc_documentos.estado 
        FROM
            PUBLIC.tbl_doc_documentos
            INNER JOIN PUBLIC.a_codigos ON PUBLIC.a_codigos.codigo = PUBLIC.tbl_doc_documentos.id_tipo_doc 
        WHERE
            PUBLIC.a_codigos.numero = 102 AND
            $where 
        ) AS temporal_table 
        ORDER BY
        fecha_envio ASC";

        //print($sql_query);
        //exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);


        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='6'>" . utf8_decode("REGISTROS DOCUMENTOS RECIBIDOS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>FECHA ENVIO</td>";
        $test .= "<td>FECHA CARGO</td>";
        $test .= "<td>TIPO DOCUMENTO</td>";
        $test .= "<td>DOCUMENTO</td>";
        $test .= "<td>DESTINATARIO</td>";
        $test .= "<td>REMITENTE</td>";
        $test .= "</tr>";
        foreach ($data as $key => $robot) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($robot->fecha_envio) . "</td>";
            $test .= "<td>" . utf8_decode($robot->fecha_cargo) . "</td>";
            $test .= "<td>" . utf8_decode($robot->tipo_documento) . "</td>";
            $test .= "<td>" . utf8_decode($robot->nro_documento) . "</td>";
            $test .= "<td>" . utf8_decode($robot->destinatario_personal) . "</td>";
            $test .= "<td>" . utf8_decode($robot->remitente_nombres) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }

    public function exportarconsultarecursosticAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=recursos-informaticos-asignados.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "
        SELECT
	pk AS pk,
	personal_nombre,
	usuario,
	nombre_equipo,
	patrimonial,
	tipo_nombre,
	marca,
	modelo,
	serie,
	color,
	teamviewer,
	anydesk,
	ip,
	pae_estado 
FROM
	view_consulta_recursos_tic 
ORDER BY
	personal_nombre,
	tipo_nombre ASC";

        //print($sql_query);
        //exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);


        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='12'>" . utf8_decode("REGISTROS DOCUMENTOS RECIBIDOS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>ÁREA</td>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>PATRIMONIAL</td>";
        $test .= "<td>USUARIO</td>";
        $test .= "<td>EQUIPO</td>";
        $test .= "<td>MARCA</td>";
        $test .= "<td>MODELO</td>";
        $test .= "<td>SERIE</td>";
        $test .= "<td>COLOR</td>";
        $test .= "<td>TEAMVIEWVER</td>";
        $test .= "<td>ANYDESK</td>";
        $test .= "<td>IP</td>";
        $test .= "</tr>";
        foreach ($data as $key => $robot) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($robot->personal_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($robot->tipo_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($robot->nombre_equipo) . "</td>";
            $test .= "<td>" . utf8_decode($robot->usuario) . "</td>";
            $test .= "<td>" . utf8_decode($robot->tipo_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($robot->marca) . "</td>";
            $test .= "<td>" . utf8_decode($robot->modelo) . "</td>";
            $test .= "<td>" . utf8_decode($robot->serie) . "</td>";
            $test .= "<td>" . utf8_decode($robot->color) . "</td>";
            $test .= "<td>" . utf8_decode($robot->teamviewer) . "</td>";
            $test .= "<td>" . utf8_decode($robot->anydesk) . "</td>";
            $test .= "<td>" . utf8_decode($robot->ip) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }


    public function exportarconsultarecursosticnoAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=recursos-informaticos-no-asignados.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "
        SELECT
        pk AS pk,
        pk,
        tipo_nombre,
        marca,
        modelo,
        serie,
        color,
        estado,
        observaciones,
        mac,
        caracteristicas,
        patrimonial 
    FROM
        view_consulta_recursos_tic_no 
    ORDER BY
        tipo_nombre,
        patrimonial,
        patrimonial ASC";

        //print($sql_query);
        //exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);


        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='7'>" . utf8_decode("REGISTROS DOCUMENTOS RECIBIDOS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>TIPO</td>";
        $test .= "<td>PATRIMONIAL</td>";
        $test .= "<td>MARCA</td>";
        $test .= "<td>MODELO</td>";
        $test .= "<td>SERIE</td>";
        $test .= "<td>COLOR</td>";
        $test .= "<td>MAC</td>";
        $test .= "</tr>";
        foreach ($data as $key => $robot) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($robot->tipo_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($robot->patrimonial) . "</td>";
            $test .= "<td>" . utf8_decode($robot->marca) . "</td>";
            $test .= "<td>" . utf8_decode($robot->modelo) . "</td>";
            $test .= "<td>" . utf8_decode($robot->serie) . "</td>";
            $test .= "<td>" . utf8_decode($robot->color) . "</td>";
            $test .= "<td>" . utf8_decode($robot->mac) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }



    public function exportarRegistropublicoaAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=postulantes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);


        $db = $this->db;
        $sql_query = "SELECT
        codigo AS pk,
        codigo,
        apellidos_nombres,
        nro_doc,
        telefono,
        celular,
        direccion,
        estado,
        foto,
        archivo,
        archivo_escuela,
        email 
        FROM
        (
        SELECT P
            .codigo AS pk,
            P.codigo,
            CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS apellidos_nombres,
            P.nro_doc,
            P.telefono,
            P.celular,
            P.direccion,
            P.estado,
            P.foto,
            P.archivo,
            P.archivo_escuela,
            P.email 
        FROM
            publico P 
        ) AS temporal_table";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='11'>" . utf8_decode("RELACIÓN DE POSTULANTES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("CÓDIGO") . "</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td>NRO DOC</td>";
        $test .= "<td>CELULAR</td>";
        $test .= "<td>EMAIL</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidos_nombres) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->celular) . "</td>";
            $test .= "<td>" . utf8_decode($value->email) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }



    public function exportarInstitucionAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-segun-institucion.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.codigo,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        CONCAT (public.publico.apellidop, ' ', public.publico.apellidom, ' ', public.publico.nombres ) AS apellidos_nombres,
        documentos.nombres AS documento,
        public.publico.nro_doc,
        public.publico.email,
        public.publico.celular,
        public.publico.ciudad,
        tipoinstituciones.nombres AS tipoinstitucion,
        public.publico.institucion,
        categoriaspostulantes.nombres AS categoriapostulante,
        public.publico.escuela,
        public.publico.colegio_profesional_nro,
        sexos.nombres AS sexo,
        to_char( public.admision_postulantes.fecha_inscripcion, 'DD/MM/YYYY' ) AS fecha_inscripcion,
        to_char( public.admision_postulantes.fecha_registro, 'DD/MM/YYYY' ) AS fecha_registro,
        public.admision_postulantes.recibo,
        public.admision_postulantes.monto,
        public.admision_postulantes.puntaje,
        public.publico.observaciones AS observacion_publico,
        public.admision_postulantes.observaciones_asistencia,
        procesos.nombres AS proceso,
        public.admision_postulantes.supervisor,
        public.admision_postulantes.grupo,
        public.admision_postulantes.imagen,
        public.admision_postulantes.asistencia
        FROM
        public.publico
        INNER JOIN public.admision_postulantes ON public.publico.codigo = public.admision_postulantes.postulante
        INNER JOIN public.a_codigos AS documentos ON documentos.codigo = public.publico.documento
        INNER JOIN public.a_codigos AS tipoinstituciones ON tipoinstituciones.codigo = public.publico.tipo_institucion
        INNER JOIN public.a_codigos AS categoriaspostulantes ON public.publico.categoria = categoriaspostulantes.codigo
        INNER JOIN public.a_codigos AS sexos ON sexos.codigo = CAST ( public.publico.sexo AS INTEGER )
        INNER JOIN public.a_codigos AS procesos ON procesos.codigo = public.admision_postulantes.proceso
        WHERE
        documentos.numero = 1 AND
        tipoinstituciones.numero = 105 AND
        categoriaspostulantes.numero = 104 AND
        sexos.numero = 3 AND
        procesos.numero = 106";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='25'>" . utf8_decode("REPORTE SEGÚN INSTITUCIÓN") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("CÓDIGO") . "</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td>DOCUMENTO</td>";
        $test .= "<td>NUMERO DE DOCUMENTO</td>";
        $test .= "<td>EMAIL</td>";
        $test .= "<td>CELULAR</td>";
        $test .= "<td>CIUDAD</td>";
        $test .= "<td>" . utf8_decode("TIPO DE INSTITUCIÓN") . "</td>";
        $test .= "<td>" . utf8_decode("INSTITUCIÓN") . "</td>";
        $test .= "<td>CATEGORIA POSTULANTE</td>";
        $test .= "<td>ESCUELA</td>";
        $test .= "<td>COLEGIATURA</td>";
        $test .= "<td>SEXO</td>";
        $test .= "<td>" . utf8_decode("FECHA INSCRIPCIÓN") . "</td>";
        $test .= "<td>" . utf8_decode("FECHA REGISTRO") . "</td>";
        $test .= "<td>" . utf8_decode("RECIBO") . "</td>";
        $test .= "<td>" . utf8_decode("MONTO") . "</td>";
        $test .= "<td>" . utf8_decode("PUNTAJE") . "</td>";
        $test .= "<td>" . utf8_decode("OBSERVACIÓN") . "</td>";
        $test .= "<td>" . utf8_decode("OBSERVACIÓN ASISTENCIA") . "</td>";
        $test .= "<td>" . utf8_decode("PROCESO") . "</td>";
        $test .= "<td>" . utf8_decode("SUPERVISOR") . "</td>";
        $test .= "<td>" . utf8_decode("GRUPO") . "</td>";
        $test .= "<td>" . utf8_decode("IMAGEN") . "</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidos_nombres) . "</td>";
            $test .= "<td>" . utf8_decode($value->documento) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->email) . "</td>";
            $test .= "<td>" . utf8_decode($value->celular) . "</td>";
            $test .= "<td>" . utf8_decode($value->ciudad) . "</td>";
            $test .= "<td>" . utf8_decode($value->tipoinstitucion) . "</td>";
            $test .= "<td>" . utf8_decode($value->institucion) . "</td>";
            $test .= "<td>" . utf8_decode($value->categoriapostulante) . "</td>";
            $test .= "<td>" . utf8_decode($value->escuela) . "</td>";
            $test .= "<td>" . utf8_decode($value->colegio_profesional_nro) . "</td>";
            $test .= "<td>" . utf8_decode($value->sexo) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inscripcion) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_registro) . "</td>";
            $test .= "<td>" . utf8_decode($value->recibo) . "</td>";
            $test .= "<td>" . utf8_decode($value->monto) . "</td>";
            $test .= "<td>" . utf8_decode($value->puntaje) . "</td>";
            $test .= "<td>" . utf8_decode($value->observacion_publico) . "</td>";
            $test .= "<td>" . utf8_decode($value->observaciones_asistencia) . "</td>";
            $test .= "<td>" . utf8_decode($value->proceso) . "</td>";
            $test .= "<td>" . utf8_decode($value->supervisor) . "</td>";
            $test .= "<td>" . utf8_decode($value->grupo) . "</td>";
            $test .= "<td>" . utf8_decode($value->imagen) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }


    public function exportarexperienciaAction($id_publico)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=experiencia.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $publico = Publico::findFirstBycodigo($id_publico);

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.codigo,
        tipos.nombres AS tipo,
        to_char(public.tbl_web_publico_experiencia.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
        to_char(public.tbl_web_publico_experiencia.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
        public.tbl_web_publico_experiencia.cargo,
        public.tbl_web_publico_experiencia.institucion,
        publico.nro_doc,
	    publico.apellidom,
		publico.apellidop,
		publico.nombres,
        tiposinstituciones.nombres AS tipoinstitucion 
        FROM
        public.publico
        INNER JOIN public.tbl_web_publico_experiencia ON public.tbl_web_publico_experiencia.publico = public.publico.codigo
        INNER JOIN public.a_codigos AS tipos ON tipos.codigo = public.tbl_web_publico_experiencia.tipo
        INNER JOIN PUBLIC.a_codigos AS tiposinstituciones ON tiposinstituciones.codigo = tbl_web_publico_experiencia.tipo_institucion 
        WHERE
        public.publico.codigo = $id_publico AND
        tipos.numero = 87
        AND tiposinstituciones.numero = 105";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td colspan='3'>" . utf8_decode("NUMERO DE DOCUMENTO: ") . utf8_decode($publico->nro_doc) . "</td>";
        $test .= "<td colspan='5'>" . utf8_decode("APELLIDOS Y NOMBRES: ") . utf8_decode($publico->apellidop) . " " . utf8_decode($publico->apellidom) . " " . utf8_decode($publico->nombres) . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='8'>" . utf8_decode("REPORTE EXPERIENCIA") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("ORDEN") . "</td>";
        $test .= "<td>" . utf8_decode("CÓDIGO") . "</td>";
        $test .= "<td>" . utf8_decode("TIPO") . "</td>";
        $test .= "<td>" . utf8_decode("FECHA INICIO") . "</td>";
        $test .= "<td>" . utf8_decode("FECHA FIN") . "</td>";
        $test .= "<td>" . utf8_decode("CARGO") . "</td>";
        $test .= "<td>" . utf8_decode("TIPO DE INSTITUCION") . "</td>";
        $test .= "<td>" . utf8_decode("INSTITUCIÓN") . "</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_inicio) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_fin) . "</td>";
            $test .= "<td>" . utf8_decode($value->cargo) . "</td>";
            $test .= "<td>" . utf8_decode($value->tipoinstitucion) . "</td>";
            $test .= "<td>" . utf8_decode($value->institucion) . "</td>";
            $test .= "</tr>";
        }

        $test .= "</table>";
        print $test;
    }

    public function exportarLibrosAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=libros.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "SELECT
        '' AS local,
            public.tbl_lib_libros.titulo,
            CASE
            WHEN 	public.tbl_lib_libros.programa_1= '1' THEN 'X'
          END 
          AS programa_1,
                CASE
            WHEN 	public.tbl_lib_libros.programa_2= '1' THEN 'X'
          END 
          AS programa_2,
                CASE
            WHEN 	public.tbl_lib_libros.programa_3= '1' THEN 'X'
          END 
          AS programa_3,
          CONCAT (autor1.descripcion, '/', autor2.descripcion, '/', autor3.descripcion) AS autores,
            public.tbl_lib_libros.anio_publicacion,
            public.tbl_lib_libros.cantidad_ejemplares,
            public.tbl_lib_libros.codigo
        FROM
            public.tbl_lib_libros
            LEFT JOIN public.tbl_lib_autores AS autor1 ON public.tbl_lib_libros.autor_1 = autor1.id_autor
            LEFT JOIN public.tbl_lib_autores AS autor2 ON public.tbl_lib_libros.autor_2 = autor2.id_autor
            LEFT JOIN public.tbl_lib_autores AS autor3 ON public.tbl_lib_libros.autor_3 = autor3.id_autor 
        ORDER BY public.tbl_lib_libros.id_libro ASC";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='10'>" . utf8_decode("REPORTE LIBROS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("LOCAL") . "</td>";
        $test .= "<td>" . utf8_decode("DEWEY") . "</td>";
        $test .= "<td>" . utf8_decode("TITULO") . "</td>";
        $test .= "<td>" . utf8_decode("PROGRAMA 1") . "</td>";
        $test .= "<td>" . utf8_decode("PROGRAMA 2") . "</td>";
        $test .= "<td>" . utf8_decode("PROGRAMA 3") . "</td>";
        $test .= "<td>" . utf8_decode("AUTORES") . "</td>";
        $test .= "<td>" . utf8_decode("AÑO DE PUBLICACIÓN") . "</td>";
        $test .= "<td>" . utf8_decode("CANTIDAD DE EJEMPLARES") . "</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->local) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->titulo) . "</td>";
            $test .= "<td>" . utf8_decode($value->programa_1) . "</td>";
            $test .= "<td>" . utf8_decode($value->programa_2) . "</td>";
            $test .= "<td>" . utf8_decode($value->programa_3) . "</td>";

            $valorAutor = explode('/', $value->autores);
            $autor1 = $valorAutor[0];
            $autor2 = $valorAutor[1];
            $autor3 = $valorAutor[2];

            if ($autor1) {
                $resultado1 = $autor1;
            }

            if ($autor2 === "") {
                $resultado2 = "";
            } else {
                $resultado2 = " / " . $autor2;
            }

            if ($autor3 === "") {
                $resultado3 = "";
            } else {
                $resultado3 = " / " . $autor3;
            }

            $autores = $resultado1 . $resultado2 . $resultado3;


            $test .= "<td>" . utf8_decode($autores) . "</td>";
            $test .= "<td>" . utf8_decode($value->anio_publicacion) . "</td>";
            $test .= "<td>" . utf8_decode($value->cantidad_ejemplares) . "</td>";
            $test .= "</tr>";
        }

        $test .= "</table>";
        print $test;
    }


    public function exportarRegistroatencionessaludAction()
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=experiencia.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "SELECT distinct tbl_dss_atenciones.id_atencion,
        to_char(tbl_dss_atenciones.fecha_atencion, 'DD/MM/YYYY') AS fecha_atencion,
        tbl_dss_atenciones.fecha_atencion AS fecha,
        view_dss_pacientes.nro_doc,
        view_dss_pacientes.tipo,
        view_dss_pacientes.tipo_codigo,
        view_dss_pacientes.apellidos_nombre,
        view_dss_pacientes.direccion,
        view_dss_pacientes.telefono,
        tbl_dss_atenciones.estado,
        tbl_dss_atenciones.motivo
        FROM tbl_dss_atenciones INNER JOIN view_dss_pacientes ON view_dss_pacientes.nro_doc = tbl_dss_atenciones.nro_doc";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='7'>" . utf8_decode("REPORTE EXPERIENCIA") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("CODIGO") . "</td>";
        $test .= "<td>" . utf8_decode("FECHA ATENCION") . "</td>";
        $test .= "<td>" . utf8_decode("TIPO") . "</td>";
        $test .= "<td>" . utf8_decode("NRO DOCUMENTO") . "</td>";
        $test .= "<td>" . utf8_decode("APELLIDOS Y NOMBRES") . "</td>";
        $test .= "<td>" . utf8_decode("DIRECCION") . "</td>";
        $test .= "<td>" . utf8_decode("TELEFONO") . "</td>";
        $test .= "<td>" . utf8_decode("MOTIVO") . "</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->id_atencion) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_atencion) . "</td>";
            $test .= "<td>" . utf8_decode($value->tipo) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidos_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->direccion) . "</td>";
            $test .= "<td>" . utf8_decode($value->telefono) . "</td>";
            $test .= "<td>" . utf8_decode($value->motivo) . "</td>";
            $test .= "</tr>";
        }

        $test .= "</table>";
        print $test;
    }

    public function planillasCasAction($id_planilla)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=planillascas.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $data = VPlanillasCas::find("id_planilla = $id_planilla");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='23'>" . utf8_decode("REPORTE REGISTRO DE PLANILLAS") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N ORDEN") . "</td>";
        $test .= "<td>" . utf8_decode("META") . "</td>";
        $test .= "<td>" . utf8_decode("TELEAHORRO") . "</td>";
        $test .= "<td>" . utf8_decode("NRO DOC") . "</td>";
        $test .= "<td>" . utf8_decode("NOMBRES Y APELLIDOS") . "</td>";
        $test .= "<td>" . utf8_decode("REG. PENS.") . "</td>";
        $test .= "<td>" . utf8_decode("CARGO") . "</td>";
        $test .= "<td>" . utf8_decode("REM. DIAS TRAB") . "</td>";
        $test .= "<td>" . utf8_decode("INASISTENCIA") . "</td>";
        $test .= "<td>" . utf8_decode("TARDANZA") . "</td>";

        $test .= "<td>" . utf8_decode("AGU. JULIO") . "</td>";
        $test .= "<td>" . utf8_decode("ING TOTAL") . "</td>";
        $test .= "<td>" . utf8_decode("SEM ASEG.") . "</td>";
        $test .= "<td>" . utf8_decode("SIST.NAC PEN") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte AFP") . "</td>";
        $test .= "<td>" . utf8_decode("Prima Seguro") . "</td>";
        $test .= "<td>" . utf8_decode("Comision AFP") . "</td>";
        $test .= "<td>" . utf8_decode("DCTO. REG. PENS.") . "</td>";
        $test .= "<td>" . utf8_decode("DCTO JUDICIAL") . "</td>";
        $test .= "<td>" . utf8_decode("4ta CAT") . "</td>";
        $test .= "<td>" . utf8_decode("TOTAL DCTO") . "</td>";
        $test .= "<td>" . utf8_decode("REMU NETA") . "</td>";
        $test .= "<td>" . utf8_decode("ESALUD") . "</td>";

        $test .= "</tr>";

        $t_rem_dias_trab = 0;
        $t_inasistencia = 0;
        $t_tardanza = 0;
        $t_i_aguin_jul = 0;
        $t_ingreso = 0;
        $t_rem_aseg = 0;
        $t_sist_nac_pen = 0;
        $t_aporte = 0;
        $t_prima = 0;
        $t_comision = 0;
        $t_desc_regimen_pension = 0;
        $t_d_judicial = 0;
        $t_cuarta_cat = 0;
        $t_descuentos = 0;
        $t_rem_neta = 0;
        $t_aessalud = 0;

        foreach ($data as $key => $value) {

            $desc_regimen_pension = $value->afp_aporte + $value->afp_prima + $value->afp_comision;
            $desc_regimen_pension = number_format($desc_regimen_pension, 2, '.', ' ');

            if ($value->id_afp == 1) {
                $sist_nac_pen = $value->afp_aporte;
            } else {
                $aporte = $value->afp_aporte;
                $prima = $value->afp_prima;
                $comision = $value->afp_comision;
            }

            $t_rem_dias_trab += $value->rem_basica;
            $t_inasistencia += $value->d_inas;
            $t_tardanza += $value->d_tard;
            $t_i_aguin_jul += $value->i_aguin_jul;
            $t_ingreso += $value->rem_bruta;
            $t_rem_aseg += $value->rem_aseg;
            $t_sist_nac_pen += $sist_nac_pen;
            $t_aporte += $aporte;
            $t_prima += $prima;
            $t_comision += $comision;
            $t_desc_regimen_pension += $desc_regimen_pension;
            $t_d_judicial += $value->d_judicial;
            $t_cuarta_cat += $value->cuarta_cat;
            $t_descuentos += $value->descuentos;
            $t_rem_neta += $value->rem_neta;
            $t_aessalud += $value->aessalud;

            //cambiar formato
            if ($value->rem_basica == "0.00") {
                $rem_basica = "-";
            } else {
                $rem_basica = $value->rem_basica;
            }

            if ($value->d_inas == "0.00") {
                $d_inas = "-";
            } else {
                $d_inas = $value->d_inas;
            }

            if ($value->d_tard == "0.00") {
                $d_tard = "-";
            } else {
                $d_tard = $value->d_tard;
            }

            if ($value->i_aguin_jul == "0.00") {
                $i_aguin_jul = "-";
            } else {
                $i_aguin_jul = $value->i_aguin_jul;
            }

            if ($value->rem_bruta == "0.00") {
                $rem_bruta = "-";
            } else {
                $rem_bruta = $value->rem_bruta;
            }

            if ($value->rem_aseg == "0.00") {
                $rem_aseg = "-";
            } else {
                $rem_aseg = $value->rem_aseg;
            }

            if ($sist_nac_pen == "0.00" || $sist_nac_pen == "") {
                $nac_pen = "-";
            } else {
                $nac_pen = $sist_nac_pen;
            }

            if ($aporte == "0.00") {
                $aporte = "-";
            } else {
                $aporte = $aporte;
            }

            if ($prima == "0.00") {
                $prima = "-";
            } else {
                $prima = $prima;
            }


            if ($comision == "0.00") {
                $comision = "-";
            } else {
                $comision = $comision;
            }

            if ($desc_regimen_pension == "0.00") {
                $desc_regimen_pension = "-";
            } else {
                $desc_regimen_pension = $desc_regimen_pension;
            }


            if ($value->d_judicial == "0.00") {
                $d_judicial = "-";
            } else {
                $d_judicial = $value->d_judicial;
            }

            if ($value->cuarta_cat == "0.00") {
                $cuarta_cat = "-";
            } else {
                $cuarta_cat = $value->cuarta_cat;
            }

            if ($value->descuentos == "0.00") {
                $descuentos = "-";
            } else {
                $descuentos = $value->descuentos;
            }


            if ($value->rem_neta == "0.00") {
                $rem_neta = "-";
            } else {
                $rem_neta = $value->rem_neta;
            }

            if ($value->aessalud == "0.00") {
                $aessalud = "-";
            } else {
                $aessalud = $value->aessalud;
            }

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->meta) . "</td>";
            $test .= "<td>" . utf8_decode('DE EN CUENTA') . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->personal1) . "</td>";
            $test .= "<td>" . utf8_decode($value->afp_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->cargo) . "</td>";
            $test .= "<td>" . utf8_decode($rem_basica) . "</td>";
            $test .= "<td>" . utf8_decode($d_inas) . "</td>";
            $test .= "<td>" . utf8_decode($d_tard) . "</td>";
            $test .= "<td>" . utf8_decode($i_aguin_jul) . "</td>";
            $test .= "<td>" . utf8_decode($rem_bruta) . "</td>";
            $test .= "<td>" . utf8_decode($rem_aseg) . "</td>";
            $test .= "<td>" . utf8_decode($nac_pen) . "</td>";
            $test .= "<td>" . utf8_decode($aporte) . "</td>";
            $test .= "<td>" . utf8_decode($prima) . "</td>";
            $test .= "<td>" . utf8_decode($comision) . "</td>";
            $test .= "<td>" . utf8_decode($desc_regimen_pension) . "</td>";
            $test .= "<td>" . utf8_decode($d_judicial) . "</td>";
            $test .= "<td>" . utf8_decode($cuarta_cat) . "</td>";
            $test .= "<td>" . utf8_decode($descuentos) . "</td>";
            $test .= "<td>" . utf8_decode($rem_neta) . "</td>";
            $test .= "<td>" . utf8_decode($aessalud) . "</td>";
            $test .= "</tr>";
        }

        $t_rem_dias_trab = number_format($t_rem_dias_trab, 2, '.', ' ');
        $t_inasistencia = number_format($t_inasistencia, 2, '.', ' ');
        $t_tardanza = number_format($t_tardanza, 2, '.', ' ');
        $t_i_aguin_jul = number_format($t_i_aguin_jul, 2, '.', ' ');
        $t_ingreso =  number_format($t_ingreso, 2, '.', ' ');
        $t_rem_aseg =  number_format($t_rem_aseg, 2, '.', ' ');
        $t_sist_nac_pen =  number_format($t_sist_nac_pen, 2, '.', ' ');
        $t_aporte =  number_format($t_aporte, 2, '.', ' ');
        $t_prima =  number_format($t_prima, 2, '.', ' ');
        $t_comision = number_format($t_comision, 2, '.', ' ');
        $t_desc_regimen_pension = number_format($t_desc_regimen_pension, 2, '.', ' ');
        $t_d_judicial = number_format($t_d_judicial, 2, '.', ' ');
        $t_cuarta_cat = number_format($t_cuarta_cat, 2, '.', ' ');
        $t_descuentos = number_format($t_descuentos, 2, '.', ' ');
        $t_rem_neta = number_format($t_rem_neta, 2, '.', ' ');
        $t_aessalud = number_format($t_aessalud, 2, '.', ' ');

        //cambiar formato
        if ($t_rem_dias_trab == "0.00") {
            $t_rem_dias_trab = "-";
        } else {
            $t_rem_dias_trab = $t_rem_dias_trab;
        }

        if ($t_inasistencia == "0.00") {
            $t_inasistencia = "-";
        } else {
            $t_inasistencia = $t_inasistencia;
        }

        if ($t_tardanza == "0.00") {
            $t_tardanza = "-";
        } else {
            $t_tardanza = $t_tardanza;
        }

        if ($t_i_aguin_jul == "0.00") {
            $t_i_aguin_jul = "-";
        } else {
            $t_i_aguin_jul = $t_i_aguin_jul;
        }

        if ($t_ingreso == "0.00") {
            $t_ingreso = "-";
        } else {
            $t_ingreso = $t_ingreso;
        }

        if ($t_rem_aseg == "0.00") {
            $t_rem_aseg = "-";
        } else {
            $t_rem_aseg = $t_rem_aseg;
        }

        if ($t_sist_nac_pen == "0.00") {
            $t_sist_nac_pen = "-";
        } else {
            $t_sist_nac_pen = $t_sist_nac_pen;
        }

        if ($t_aporte == "0.00") {
            $t_aporte = "-";
        } else {
            $t_aporte = $t_aporte;
        }

        if ($t_prima == "0.00") {
            $t_prima = "-";
        } else {
            $t_prima = $t_prima;
        }

        if ($t_comision == "0.00") {
            $t_comision = "-";
        } else {
            $t_comision = $t_comision;
        }

        if ($t_desc_regimen_pension == "0.00") {
            $t_desc_regimen_pension = "-";
        } else {
            $t_desc_regimen_pension = $t_desc_regimen_pension;
        }

        if ($t_d_judicial == "0.00") {
            $t_d_judicial = "-";
        } else {
            $t_d_judicial = $t_d_judicial;
        }

        if ($t_cuarta_cat == "0.00") {
            $t_cuarta_cat = "-";
        } else {
            $t_cuarta_cat = $t_cuarta_cat;
        }

        if ($t_descuentos == "0.00") {
            $t_descuentos = "-";
        } else {
            $t_descuentos = $t_descuentos;
        }

        if ($t_rem_neta == "0.00") {
            $t_rem_neta = "-";
        } else {
            $t_rem_neta = $t_rem_neta;
        }

        if ($t_aessalud == "0.00") {
            $t_aessalud = "-";
        } else {
            $t_aessalud = $t_aessalud;
        }

        $test .= "<tr>";
        $test .= "<td colspan='7' align='center'>TOTAL</td>";
        $test .= "<td>" . utf8_decode($t_rem_dias_trab) . "</td>";
        $test .= "<td>" . utf8_decode($t_inasistencia) . "</td>";
        $test .= "<td>" . utf8_decode($t_tardanza) . "</td>";
        $test .= "<td>" . utf8_decode($t_i_aguin_jul) . "</td>";
        $test .= "<td>" . utf8_decode($t_ingreso) . "</td>";
        $test .= "<td>" . utf8_decode($t_rem_aseg) . "</td>";
        $test .= "<td>" . utf8_decode($t_sist_nac_pen) . "</td>";
        $test .= "<td>" . utf8_decode($t_aporte) . "</td>";
        $test .= "<td>" . utf8_decode($t_prima) . "</td>";
        $test .= "<td>" . utf8_decode($t_comision) . "</td>";
        $test .= "<td>" . utf8_decode($t_desc_regimen_pension) . "</td>";
        $test .= "<td>" . utf8_decode($t_d_judicial) . "</td>";
        $test .= "<td>" . utf8_decode($t_cuarta_cat) . "</td>";
        $test .= "<td>" . utf8_decode($t_descuentos) . "</td>";
        $test .= "<td>" . utf8_decode($t_rem_neta) . "</td>";
        $test .= "<td>" . utf8_decode($t_aessalud) . "</td>";
        $test .= "</tr>";

        $test .= "</table>";
        print $test;
    }

    public function planillasDocentesAction($id_planilla)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=planillasdocentes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $data = VPlanillasDocentes::find("id_planilla = $id_planilla");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='24'>" . utf8_decode("REPORTE REGISTRO DE PLANILLAS DOCENTES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N ORDEN") . "</td>";
        $test .= "<td>" . utf8_decode("META") . "</td>";
        $test .= "<td>" . utf8_decode("TELEAHORRO") . "</td>";
        $test .= "<td>" . utf8_decode("NRO DOC") . "</td>";
        $test .= "<td>" . utf8_decode("NOMBRES Y APELLIDOS") . "</td>";
        $test .= "<td>" . utf8_decode("REG. PENS.") . "</td>";
        $test .= "<td>" . utf8_decode("CARGO") . "</td>";
        $test .= "<td>" . utf8_decode("REM. DIAS TRAB") . "</td>";
        $test .= "<td>" . utf8_decode("INASISTENCIA") . "</td>";
        $test .= "<td>" . utf8_decode("TARDANZA") . "</td>";
        $test .= "<td>" . utf8_decode("ESCOLARIDAD") . "</td>";

        $test .= "<td>" . utf8_decode("AGU. JULIO") . "</td>";
        $test .= "<td>" . utf8_decode("ING TOTAL") . "</td>";
        $test .= "<td>" . utf8_decode("SEM ASEG.") . "</td>";
        $test .= "<td>" . utf8_decode("SIST.NAC PEN") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte AFP") . "</td>";
        $test .= "<td>" . utf8_decode("Prima Seguro") . "</td>";
        $test .= "<td>" . utf8_decode("Comision AFP") . "</td>";
        $test .= "<td>" . utf8_decode("DCTO. REG. PENS.") . "</td>";
        $test .= "<td>" . utf8_decode("DCTO JUDICIAL") . "</td>";
        $test .= "<td>" . utf8_decode("5ta CAT") . "</td>";
        $test .= "<td>" . utf8_decode("TOTAL DCTO") . "</td>";
        $test .= "<td>" . utf8_decode("REMU NETA") . "</td>";
        $test .= "<td>" . utf8_decode("ESALUD") . "</td>";

        $test .= "</tr>";

        $t_rem_dias_trab = 0;
        $t_inasistencia = 0;
        $t_tardanza = 0;
        $t_escolar = 0;
        $t_i_aguin_jul = 0;
        $t_ingreso = 0;
        $t_rem_aseg = 0;
        $t_sist_nac_pen = 0;
        $t_aporte = 0;
        $t_prima = 0;
        $t_comision = 0;
        $t_desc_regimen_pension = 0;
        $t_d_judicial = 0;
        $t_quinta_cat = 0;
        $t_descuentos = 0;
        $t_rem_neta = 0;
        $t_aessalud = 0;

        foreach ($data as $key => $value) {

            $desc_regimen_pension = $value->afp_aporte + $value->afp_prima + $value->afp_comision;
            $desc_regimen_pension = number_format($desc_regimen_pension, 2, '.', ' ');

            if ($value->id_afp == 1) {
                $sist_nac_pen = $value->afp_aporte;
            } else {
                $aporte = $value->afp_aporte;
                $prima = $value->afp_prima;
                $comision = $value->afp_comision;
            }

            //cambiar formato
            if ($value->rem_basica == "0.00") {
                $rem_basica = "-";
            } else {
                $rem_basica = $value->rem_basica;
            }

            if ($value->d_inas == "0.00") {
                $d_inas = "-";
            } else {
                $d_inas = $value->d_inas;
            }

            if ($value->d_tard == "0.00") {
                $d_tard = "-";
            } else {
                $d_tard = $value->d_tard;
            }

            if ($value->i_escolar == "0.00") {
                $i_escolar = "-";
            } else {
                $i_escolar = $value->i_escolar;
            }


            if ($value->i_aguin_jul == "0.00") {
                $i_aguin_jul = "-";
            } else {
                $i_aguin_jul = $value->i_aguin_jul;
            }

            if ($value->rem_bruta == "0.00") {
                $rem_bruta = "-";
            } else {
                $rem_bruta = $value->rem_bruta;
            }

            if ($value->rem_aseg == "0.00") {
                $rem_aseg = "-";
            } else {
                $rem_aseg = $value->rem_aseg;
            }

            if ($sist_nac_pen == "0.00" || $sist_nac_pen == "") {
                $nac_pen = "-";
            } else {
                $nac_pen = $sist_nac_pen;
            }

            if ($aporte == "0.00") {
                $aporte = "-";
            } else {
                $aporte = $aporte;
            }

            if ($prima == "0.00") {
                $prima = "-";
            } else {
                $prima = $prima;
            }


            if ($comision == "0.00") {
                $comision = "-";
            } else {
                $comision = $comision;
            }

            if ($desc_regimen_pension == "0.00") {
                $desc_regimen_pension = "-";
            } else {
                $desc_regimen_pension = $desc_regimen_pension;
            }


            if ($value->d_judicial == "0.00") {
                $d_judicial = "-";
            } else {
                $d_judicial = $value->d_judicial;
            }

            if ($value->quinta_cat == "0.00") {
                $quinta_cat = "-";
            } else {
                $quinta_cat = $value->quinta_cat;
            }

            if ($value->descuentos == "0.00") {
                $descuentos = "-";
            } else {
                $descuentos = $value->descuentos;
            }


            if ($value->rem_neta == "0.00") {
                $rem_neta = "-";
            } else {
                $rem_neta = $value->rem_neta;
            }

            if ($value->aessalud == "0.00") {
                $aessalud = "-";
            } else {
                $aessalud = $value->aessalud;
            }


            $t_rem_dias_trab += $value->rem_basica;
            $t_inasistencia += $value->d_inas;
            $t_tardanza += $value->d_tard;
            $t_escolar += $value->i_escolar;
            $t_i_aguin_jul += $value->i_aguin_jul;
            $t_ingreso += $value->rem_bruta;
            $t_rem_aseg += $value->rem_aseg;
            $t_sist_nac_pen += $sist_nac_pen;
            $t_aporte += $aporte;
            $t_prima += $prima;
            $t_comision += $comision;
            $t_desc_regimen_pension += $desc_regimen_pension;
            $t_d_judicial += $value->d_judicial;
            $t_quinta_cat += $value->quinta_cat;
            $t_descuentos += $value->descuentos;
            $t_rem_neta += $value->rem_neta;
            $t_aessalud += $value->aessalud;

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->meta) . "</td>";
            $test .= "<td>" . utf8_decode('DE EN CUENTA') . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->personal1) . "</td>";
            $test .= "<td>" . utf8_decode($value->afp_nombre) . "</td>";
            $test .= "<td>" . utf8_decode($value->cargo) . "</td>";
            $test .= "<td>" . utf8_decode($rem_basica) . "</td>";
            $test .= "<td>" . utf8_decode($d_inas) . "</td>";
            $test .= "<td>" . utf8_decode($d_tard) . "</td>";
            $test .= "<td>" . utf8_decode($i_escolar) . "</td>";
            $test .= "<td>" . utf8_decode($i_aguin_jul) . "</td>";
            $test .= "<td>" . utf8_decode($rem_bruta) . "</td>";
            $test .= "<td>" . utf8_decode($rem_aseg) . "</td>";
            $test .= "<td>" . utf8_decode($nac_pen) . "</td>";
            $test .= "<td>" . utf8_decode($aporte) . "</td>";
            $test .= "<td>" . utf8_decode($prima) . "</td>";
            $test .= "<td>" . utf8_decode($comision) . "</td>";
            $test .= "<td>" . utf8_decode($desc_regimen_pension) . "</td>";
            $test .= "<td>" . utf8_decode($d_judicial) . "</td>";
            $test .= "<td>" . utf8_decode($quinta_cat) . "</td>";
            $test .= "<td>" . utf8_decode($descuentos) . "</td>";
            $test .= "<td>" . utf8_decode($rem_neta) . "</td>";
            $test .= "<td>" . utf8_decode($aessalud) . "</td>";
            $test .= "</tr>";
        }

        $t_rem_dias_trab = number_format($t_rem_dias_trab, 2, '.', ' ');
        $t_inasistencia = number_format($t_inasistencia, 2, '.', ' ');
        $t_tardanza = number_format($t_tardanza, 2, '.', ' ');
        $t_escolar =   number_format($t_escolar, 2, '.', ' ');
        $t_i_aguin_jul = number_format($t_i_aguin_jul, 2, '.', ' ');
        $t_ingreso =  number_format($t_ingreso, 2, '.', ' ');
        $t_rem_aseg =  number_format($t_rem_aseg, 2, '.', ' ');
        $t_sist_nac_pen =  number_format($t_sist_nac_pen, 2, '.', ' ');
        $t_aporte =  number_format($t_aporte, 2, '.', ' ');
        $t_prima =  number_format($t_prima, 2, '.', ' ');
        $t_comision = number_format($t_comision, 2, '.', ' ');
        $t_desc_regimen_pension = number_format($t_desc_regimen_pension, 2, '.', ' ');
        $t_d_judicial = number_format($t_d_judicial, 2, '.', ' ');
        $t_quinta_cat = number_format($t_quinta_cat, 2, '.', ' ');
        $t_descuentos = number_format($t_descuentos, 2, '.', ' ');
        $t_rem_neta = number_format($t_rem_neta, 2, '.', ' ');
        $t_aessalud = number_format($t_aessalud, 2, '.', ' ');

        //cambiar formato
        if ($t_rem_dias_trab == "0.00") {
            $t_rem_dias_trab = "-";
        } else {
            $t_rem_dias_trab = $t_rem_dias_trab;
        }

        if ($t_inasistencia == "0.00") {
            $t_inasistencia = "-";
        } else {
            $t_inasistencia = $t_inasistencia;
        }

        if ($t_tardanza == "0.00") {
            $t_tardanza = "-";
        } else {
            $t_tardanza = $t_tardanza;
        }

        if ($t_escolar == "0.00") {
            $t_escolar = "-";
        } else {
            $t_escolar = $t_escolar;
        }

        if ($t_i_aguin_jul == "0.00") {
            $t_i_aguin_jul = "-";
        } else {
            $t_i_aguin_jul = $t_i_aguin_jul;
        }

        if ($t_ingreso == "0.00") {
            $t_ingreso = "-";
        } else {
            $t_ingreso = $t_ingreso;
        }

        if ($t_rem_aseg == "0.00") {
            $t_rem_aseg = "-";
        } else {
            $t_rem_aseg = $t_rem_aseg;
        }

        if ($t_sist_nac_pen == "0.00") {
            $t_sist_nac_pen = "-";
        } else {
            $t_sist_nac_pen = $t_sist_nac_pen;
        }

        if ($t_aporte == "0.00") {
            $t_aporte = "-";
        } else {
            $t_aporte = $t_aporte;
        }

        if ($t_prima == "0.00") {
            $t_prima = "-";
        } else {
            $t_prima = $t_prima;
        }

        if ($t_comision == "0.00") {
            $t_comision = "-";
        } else {
            $t_comision = $t_comision;
        }

        if ($t_desc_regimen_pension == "0.00") {
            $t_desc_regimen_pension = "-";
        } else {
            $t_desc_regimen_pension = $t_desc_regimen_pension;
        }

        if ($t_d_judicial == "0.00") {
            $t_d_judicial = "-";
        } else {
            $t_d_judicial = $t_d_judicial;
        }

        if ($t_quinta_cat == "0.00") {
            $t_quinta_cat = "-";
        } else {
            $t_quinta_cat = $t_quinta_cat;
        }

        if ($t_descuentos == "0.00") {
            $t_descuentos = "-";
        } else {
            $t_descuentos = $t_descuentos;
        }

        if ($t_rem_neta == "0.00") {
            $t_rem_neta = "-";
        } else {
            $t_rem_neta = $t_rem_neta;
        }

        if ($t_aessalud == "0.00") {
            $t_aessalud = "-";
        } else {
            $t_aessalud = $t_aessalud;
        }


        $test .= "<tr>";
        $test .= "<td colspan='7' align='center'>TOTAL</td>";
        $test .= "<td>" . utf8_decode($t_rem_dias_trab) . "</td>";
        $test .= "<td>" . utf8_decode($t_inasistencia) . "</td>";
        $test .= "<td>" . utf8_decode($t_tardanza) . "</td>";
        $test .= "<td>" . utf8_decode($t_escolar) . "</td>";
        $test .= "<td>" . utf8_decode($t_i_aguin_jul) . "</td>";
        $test .= "<td>" . utf8_decode($t_ingreso) . "</td>";
        $test .= "<td>" . utf8_decode($t_rem_aseg) . "</td>";
        $test .= "<td>" . utf8_decode($t_sist_nac_pen) . "</td>";
        $test .= "<td>" . utf8_decode($t_aporte) . "</td>";
        $test .= "<td>" . utf8_decode($t_prima) . "</td>";
        $test .= "<td>" . utf8_decode($t_comision) . "</td>";
        $test .= "<td>" . utf8_decode($t_desc_regimen_pension) . "</td>";
        $test .= "<td>" . utf8_decode($t_d_judicial) . "</td>";
        $test .= "<td>" . utf8_decode($t_quinta_cat) . "</td>";
        $test .= "<td>" . utf8_decode($t_descuentos) . "</td>";
        $test .= "<td>" . utf8_decode($t_rem_neta) . "</td>";
        $test .= "<td>" . utf8_decode($t_aessalud) . "</td>";
        $test .= "</tr>";

        $test .= "</table>";
        print $test;
    }


    public function siafCasAction($id_planilla)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siafcas.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $data = VPlanillasCas::find("id_planilla = $id_planilla");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("NUM_CTA") . "</td>";
        $test .= "<td>" . utf8_decode("TIPO_DOC") . "</td>";
        $test .= "<td>" . utf8_decode("NUM_DOC") . "</td>";
        $test .= "<td>" . utf8_decode("MONTO") . "</td>";
        $test .= "<td>" . utf8_decode("ESTADO") . "</td>";
        $test .= "</tr>";



        foreach ($data as $key => $value) {

            $monto = $value->rem_bruta - $value->descuentos;
            $monto = number_format($monto, 2, '.', ',');
            $test .= "<tr>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->nro_cta) . "</td>";
            $test .= "<td align='center' style=' 
            mso-number-format: \@; '><p>01</p></td>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($monto) . "</td>";
            $test .= "<td align='center'>" . utf8_decode('I') . "</td>";
            $test .= "</tr>";
        }


        $test .= "</table>";
        print $test;
    }

    public function siafDocentesAction($id_planilla)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siafdocentes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $data = VPlanillasDocentes::find("id_planilla = $id_planilla");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("NUM_CTA") . "</td>";
        $test .= "<td>" . utf8_decode("TIPO_DOC") . "</td>";
        $test .= "<td>" . utf8_decode("NUM_DOC") . "</td>";
        $test .= "<td>" . utf8_decode("MONTO") . "</td>";
        $test .= "<td>" . utf8_decode("ESTADO") . "</td>";
        $test .= "</tr>";



        foreach ($data as $key => $value) {

            $monto = $value->rem_bruta - $value->descuentos;
            $monto = number_format($monto, 2, '.', ',');


            $test .= "<tr>";
            $test .= "<td  style='mso-number-format: \@; '>" . utf8_decode($value->nro_cta) . "</td>";
            $test .= "<td align='center' style=' 
            mso-number-format: \@; '><p>01</p></td>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($monto) . "</td>";
            $test .= "<td align='center'>" . utf8_decode('I') . "</td>";
            $test .= "</tr>";
        }


        $test .= "</table>";
        print $test;
    }


    public function afpnetcasAction($id_planilla)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siafcas.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $data = VPlanillasCas::find("id_planilla = $id_planilla");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("Número de secuencia") . "</td>";
        $test .= "<td>" . utf8_decode("CUSPP") . "</td>";
        $test .= "<td>" . utf8_decode("Tipo  de documento de identidad") . "</td>";
        $test .= "<td>" . utf8_decode("Número de documento de indentidad") . "</td>";
        $test .= "<td>" . utf8_decode("Apellido paterno") . "</td>";
        $test .= "<td>" . utf8_decode("Apellido materno") . "</td>";
        $test .= "<td>" . utf8_decode("Nombres") . "</td>";
        $test .= "<td>" . utf8_decode("Relación Laboral") . "</td>";
        $test .= "<td>" . utf8_decode("Inicio de RL") . "</td>";
        $test .= "<td>" . utf8_decode("Cese de RL") . "</td>";
        $test .= "<td>" . utf8_decode("Excepcion de Aportar") . "</td>";
        $test .= "<td>" . utf8_decode("Remuneración asegurable") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte voluntario del afiliado con fin previsional") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte voluntario del afiliado sin fin previsional") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte voluntario del empleador") . "</td>";
        $test .= "<td>" . utf8_decode("Tipo de trabajo") . "</td>";
        $test .= "<td>" . utf8_decode("AFP") . "</td>";
        $test .= "</tr>";



        foreach ($data as $key => $value) {


            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->cuspp) . "</td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidop) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidom) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombres) . "</td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p></p></td>";
            $test .= "<td align='right'>" . utf8_decode($value->rem_aseg) . "</td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p></p></td>";
            $test .= "</tr>";
        }


        $test .= "</table>";
        print $test;
    }

    public function afpnetdocentesAction($id_planilla)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siafdocentes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $data = VPlanillasDocentes::find("id_planilla = $id_planilla");

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("Número de secuencia") . "</td>";
        $test .= "<td>" . utf8_decode("CUSPP") . "</td>";
        $test .= "<td>" . utf8_decode("Tipo  de documento de identidad") . "</td>";
        $test .= "<td>" . utf8_decode("Número de documento de indentidad") . "</td>";
        $test .= "<td>" . utf8_decode("Apellido paterno") . "</td>";
        $test .= "<td>" . utf8_decode("Apellido materno") . "</td>";
        $test .= "<td>" . utf8_decode("Nombres") . "</td>";
        $test .= "<td>" . utf8_decode("Relación Laboral") . "</td>";
        $test .= "<td>" . utf8_decode("Inicio de RL") . "</td>";
        $test .= "<td>" . utf8_decode("Cese de RL") . "</td>";
        $test .= "<td>" . utf8_decode("Excepcion de Aportar") . "</td>";
        $test .= "<td>" . utf8_decode("Remuneración asegurable") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte voluntario del afiliado con fin previsional") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte voluntario del afiliado sin fin previsional") . "</td>";
        $test .= "<td>" . utf8_decode("Aporte voluntario del empleador") . "</td>";
        $test .= "<td>" . utf8_decode("Tipo de trabajo") . "</td>";
        $test .= "<td>" . utf8_decode("AFP") . "</td>";
        $test .= "</tr>";



        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->cuspp) . "</td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td style='mso-number-format: \@; '>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidop) . "</td>";
            $test .= "<td>" . utf8_decode($value->apellidom) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombres) . "</td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p></p></td>";
            $test .= "<td align='right'>" . utf8_decode($value->rem_aseg) . "</td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>0</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p>N</p></td>";
            $test .= "<td align='center' style='so-number-format: \@; '><p></p></td>";
            $test .= "</tr>";
        }


        $test .= "</table>";
        print $test;
    }

    public function postulantesconvocatoriasAction($id_convocatoria, $id_perfil)
    {
        $this->view->disable();

        // print("id_concovatoria: ".$id_concovatoria);
        // print("id_perfil: ".$id_perfil);
        // exit();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);
        $convocatoriaPerfil = ConvocatoriasPerfiles::findFirstBycodigo($id_perfil);

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=convocatorias-postulantes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        P.nro_doc,
        P.email,
        rtrim(
            ltrim( P.apellidop )) || ' ' || rtrim(
            ltrim( P.apellidom )) || ' ' || rtrim(
        ltrim( P.nombres )) AS postulante 
        FROM
        tbl_web_convocatorias_publico twlcp
        INNER JOIN publico P ON twlcp.publico = P.codigo
        INNER JOIN tbl_web_convocatorias_perfiles twcp ON twlcp.perfil = twcp.codigo 
        WHERE
        twlcp.convocatoria = $id_convocatoria 
        AND twlcp.perfil = $id_perfil 
        ORDER BY
        twcp.nombre,
        postulante";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode("RELACION DE POSTULANTES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode($convocatoria->titulo) . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='5'>" . utf8_decode(strtoupper($convocatoriaPerfil->nombre)) . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("Fecha") . "</td>";
        $test .= "<td>" . utf8_decode("Nro Documento") . "</td>";
        $test .= "<td>" . utf8_decode("Email") . "</td>";
        $test .= "</tr>";



        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key+1) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->postulante) . "</td>";
            $test .= "<td>" . utf8_decode(strtolower($value->email)) . "</td>";
            $test .= "</tr>";
        }


        $test .= "</table>";
        print $test;
    }

    
    public function convocatoriasAction($id_convocatoria)
    {
        $this->view->disable();

        // print("id_concovatoria: ".$id_concovatoria);
        // print("id_perfil: ".$id_perfil);
        // exit();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=convocatorias.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        P.nro_doc,
        P.email,
        rtrim(
            ltrim( P.apellidop )) || ' ' || rtrim(
            ltrim( P.apellidom )) || ' ' || rtrim(
        ltrim( P.nombres )) AS postulante 
    FROM
        tbl_web_convocatorias_publico twlcp
        INNER JOIN publico P ON twlcp.publico = P.codigo
        INNER JOIN tbl_web_convocatorias_perfiles twcp ON twlcp.perfil = twcp.codigo 
    WHERE
        twlcp.convocatoria = $id_convocatoria 
    ORDER BY
        twcp.nombre,
        postulante";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='6'>" . utf8_decode("RELACION DE POSTULANTES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='6'>" . utf8_decode($convocatoria->titulo) . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("Perfil") . "</td>";
        $test .= "<td>" . utf8_decode("Fecha") . "</td>";
        $test .= "<td>" . utf8_decode("Nro Documento") . "</td>";
        $test .= "<td>" . utf8_decode("Postulante") . "</td>";
        $test .= "<td>" . utf8_decode("Email") . "</td>";
        $test .= "</tr>";



        foreach ($data as $key => $value) {

            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key+1) . "</td>";
            $test .= "<td>" . utf8_decode($value->perfil) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->postulante) . "</td>";
            $test .= "<td>" . utf8_decode(strtolower($value->email)) . "</td>";
            $test .= "</tr>";
        }


        $test .= "</table>";
        print $test;
    }


    public function concursodocentesAction($fechaInicio = null, $fechaFin = null)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=postulantes.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $where = "((CAST (fecha_recibo AS DATE) BETWEEN '{$fechaInicio}' AND '{$fechaFin}'))";

        $db = $this->db;
        $sql_query = "SELECT
        publico, convocatoria, nro_doc, nombres_apellidos, proceso, fecha_recibo, nro_recibo, monto_recibo, celular, email, archivo_recibo, foto
        FROM
        (SELECT
                public.tbl_web_convocatorias_publico.publico,
                public.tbl_web_convocatorias_publico.convocatoria,
                CONCAT ( public.publico.apellidop, ' ', public.publico.apellidom, ' ', public.publico.nombres ) AS nombres_apellidos,
                public.publico.nro_doc,
                public.publico.celular,
                public.publico.email,
                procesos.nombres AS proceso,
                to_char(tbl_web_convocatorias_publico.fecha_recibo, 'DD/MM/YYYY') AS fecha_recibo,
                public.tbl_web_convocatorias_publico.nro_recibo,
                public.tbl_web_convocatorias_publico.monto_recibo,
                public.tbl_web_convocatorias_publico.archivo_recibo,
                public.publico.foto
                FROM
                public.tbl_web_convocatorias_publico
                INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_convocatorias_publico.publico
                INNER JOIN public.a_codigos AS procesos ON procesos.codigo = public.tbl_web_convocatorias_publico.proceso_recibo
                WHERE
                procesos.numero = 106) AS temporal_table";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='10'>" . utf8_decode("RELACIÓN DE POSTULANTES") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("CÓDIGO") . "</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td>NRO DOC</td>";
        $test .= "<td>CELULAR</td>";
        $test .= "<td>EMAIL</td>";
        $test .= "<td>" . utf8_decode("FECHA INSCRIPCIÓN") . "</td>";
        $test .= "<td>NRO RECIBO</td>";
        $test .= "<td>MONTO</td>";
        $test .= "<td>PROCESO</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->publico) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombres_apellidos) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->celular) . "</td>";
            $test .= "<td>" . utf8_decode($value->email) . "</td>";
            $test .= "<td>" . utf8_decode($value->fecha_recibo) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_recibo) . "</td>";
            $test .= "<td>" . utf8_decode($value->monto_recibo) . "</td>";
            $test .= "<td>" . utf8_decode($value->proceso) . "</td>";
            $test .= "</tr>";
        }
        
        $test .= "</table>";
        print $test;
    }

    public function asistenciaAction($id_admision, $id_supervisor)
    {
        $this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte-asistencia.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $db = $this->db;
        $sql_query = "SELECT PUBLIC
        .admision_postulantes.supervisor,
        PUBLIC.publico.codigo,
        PUBLIC.publico.nro_doc,
        CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS nombres_apellidos,
        PUBLIC.admision_postulantes.grupo,
        PUBLIC.admision_postulantes.admision,
        PUBLIC.admision_postulantes.postulante,
        PUBLIC.admision_postulantes.asistencia,
        PUBLIC.admision_postulantes.observaciones_asistencia 
        FROM
        PUBLIC.admision_postulantes
        INNER JOIN PUBLIC.publico ON PUBLIC.publico.codigo = PUBLIC.admision_postulantes.postulante 
        WHERE
        public.admision_postulantes.proceso = 2 AND PUBLIC.admision_postulantes.supervisor = $id_supervisor 
        AND PUBLIC.admision_postulantes.admision = $id_admision 
        ORDER BY
        PUBLIC.admision_postulantes.grupo,
        publico.apellidop,
        publico.apellidom,
        publico.nombres";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $test = "<table border='1'>";
        $test .= "<tr>";
        $test .= "<td style='text-align:center;' colspan='25'>" . utf8_decode("REPORTE DE ASISTENCIA") . "</td>";
        $test .= "</tr>";
        $test .= "<tr>";
        $test .= "<td>" . utf8_decode("N°") . "</td>";
        $test .= "<td>" . utf8_decode("CÓDIGO") . "</td>";
        $test .= "<td>NUMERO DE DOCUMENTO</td>";
        $test .= "<td>APELLIDOS Y NOMBRES</td>";
        $test .= "<td>GRUPO</td>";
        $test .= "<td>ASISTENCIA</td>";
        $test .= "<td>OBSERVACIONES</td>";
        $test .= "</tr>";

        foreach ($data as $key => $value) {
            $test .= "<tr>";
            $test .= "<td>" . utf8_decode($key + 1) . "</td>";
            $test .= "<td>" . utf8_decode($value->codigo) . "</td>";
            $test .= "<td>" . utf8_decode($value->nro_doc) . "</td>";
            $test .= "<td>" . utf8_decode($value->nombres_apellidos) . "</td>";
            $test .= "<td>" . utf8_decode($value->grupo) . "</td>";
            $test .= "<td>" . utf8_decode($value->asistencia) . "</td>";
            $test .= "<td>" . utf8_decode($value->observaciones_asistencia) . "</td>";
            $test .= "</tr>";
        }
        $test .= "</table>";
        print $test;
    }
}
