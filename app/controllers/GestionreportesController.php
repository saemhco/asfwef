<?php

require_once APP_PATH . '/app/library/pdf.php';

class GestionreportesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function gestionacademicaAction()
    {

        $semestre_a = Semestres::findFirst("activo = 'M'");
        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->semestres = $semestres;

        $this->assets->addJs("adminpanel/js/modulos/gestionreportes.gestionacademica.js?v=" . uniqid());
    }



    //reporte de matriculas
    public function reportematriculasAction()
    {

        $semestre_a = Semestres::findFirst("activo = 'M'");
        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->semestres = $semestres;

        $this->assets->addJs("adminpanel/js/modulos/gestionreportes.reportematriculas.js?v=" . uniqid());
    }


    public function gestionadmisionAction()
    {

        $admision_a = Admision::findFirst("activo = 'M'");
        $this->view->semestrea = $admision_a->codigo;

        $admision = Admision::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->admision = $admision;

        $this->assets->addJs("adminpanel/js/modulos/gestionreportes.gestionadmision.js?v=" . uniqid());
    }


  /*--------------------- Reportes de admision -----------------------------*/
  
  //Reporte de Postulantes

        
    public function reportegeneralpostulantesAction($admisiones)
    {
        $this->view->disable();
        //admision
        $admisiones = Admision::findFirstBycodigo($admisiones);

        $pdf = new PDF('L','mm','Letter');
        
    
        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "select c.codigo, c.descripcion as  carrera_nombre
        from PUBLIC.admision_postulantes ap 
        inner join PUBLIC.publico p on ap.postulante = p.codigo 
        inner join PUBLIC.admision a on ap.admision = a.codigo 
        inner join PUBLIC.carreras c on ap.carrera1 = c.codigo 
        where a.codigo = {$admisiones->codigo}
        group by 
        c.descripcion,
        c.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
            //
    
            if (count($Carreras) == 0) {
                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'DIRECCIÓN DE ADMISIÓN', 0, 'R');
                $pdf->Ln();
    
                $pdf->SetFont('Arial', 'B', 10);
    
                $pdf->Cell(190, 25, 'REPORTE DE POSTULANTES - ' . $admisiones->descripcion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

            } else {
                $pdf->SetFont('Arial', 'B', 16);
                foreach ($Carreras as $carrera) {
    
                    $pdf->AddPage();
                
                    $pdf->Image('webpage/assets/img/logo.png', 10, 9, 36);                    
                    

                    $pdf->Line(50,18,270,18); //linea horizontal 1
                    $pdf->Line(50,26,270,26); //linea horizontal 2

                    $w = 220;
                    $date=date('d/m/Y h:m');
                    //$pdf->Cell(190, 0, '', 0, 0, 'L');
                    $pdf->Cell(40, 8, '', 0, 0, 'C');
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell($w, 8, 'Universidad Nacional Ciro Alegría', 0, 0, 'C');
                    $pdf->Ln();
                    $pdf->Cell(40, 8, '', 0, 0, 'C');                    
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell($w, 8, 'REPORTE DE POSTULANTES - ' . $admisiones->descripcion, 0, 0, 'C');
                    $pdf->Ln();
                    $pdf->Cell(40, 8, '', 0, 0, 'C');                    
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(195, 8, '                         Fecha: '.$date, 0, 0, 'C');
                    $pdf->AliasNbPages('tpagina');
                    $pdf->Cell(25, 8, 'Página: '.$pdf->PageNo().' de tpagina', 0, 0, 'L');
                        
                    // Line break
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial', 'B', 9);
    
                    $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                    $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');
                    $pdf->Ln(2);
                    $header = array('N°', 'CÓD.', 'DNI', 'APELLIDOS Y NOMBRES', 'F. NAC.', 'CELULAR', 'CORREO', 'INSTITUCIÓN EDUCATIVA', 'PROCEDENCIA');
                    $pdf->Ln(5);                    
                    $pdf->SetFillColor(230, 231, 232);
                    $pdf->SetTextColor(0);
                    $pdf->SetDrawColor(0, 0, 0);
                    $pdf->SetLineWidth(.3);
                    $pdf->SetFont('Arial', 'B', 7);
                    // Header
                    $w = array(8, 10, 15, 60, 15, 15, 40, 60, 38);
                    for ($i = 0; $i < count($header); $i++) {
                        $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
                    }
    
                    $pdf->Ln();
    
                    // Color and font restoration
                    $pdf->SetFillColor(0, 0, 0);
                    $pdf->SetTextColor(0);
                    $pdf->SetFont('');
                    // Data
                    $fill = false;
                    //Footer
                    $pdf->SetWidths($w);
    
                    $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C', 'C', 'L', 'C'));
    
                    $crece = 0;
    
                    //
                    $db = $this->db;
                    $sql_query = "select p.codigo, p.nro_doc, 
                    CONCAT (p.apellidop, ' ', p.apellidom, ' ', p.nombres ) AS alumno_nombre,
                    c.descripcion as carrera_nombre,
                    p.celular, p.email, p.colegio_nombre, 
                    to_char(p.fecha_nacimiento, 'DD/MM/YYYY') AS fecha_nacimiento,
                    age(p.fecha_nacimiento) as edad,
                    p.colegio_nombre, p.ciudad
                   from PUBLIC.admision_postulantes ap 
                   inner join PUBLIC.publico p on ap.postulante = p.codigo 
                   inner join PUBLIC.admision a on ap.admision = a.codigo 
                   inner join PUBLIC.carreras c on ap.carrera1 = c.codigo 
                   where a.codigo = {$admisiones->codigo} and c.codigo ='{$carrera->codigo}'";
                                   
                    
                    //print($sql_query);
                    //exit();
    
                    $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                    foreach ($data as $key => $value) {
                        $crece++;
    
                        $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->fecha_nacimiento, $value->celular, $value->email, $value->colegio_nombre, $value->ciudad));
                    }
                    //
    
                    $pdf->Ln(3);
                }
            }
    
            $pdf->Output();
    }


    /*--------------------- fin de reportes de admision -----------------------------*/    


    /*--------------------- inicio de reportes de acad -----------------------------*/   

    //reporte ficha de matricula
    public function reporteFichaMatriculaAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //$myarray = array(1, 2, 3);
        //$Alumnos = VFicha::find("semestre = {$Semestre->codigo}");

        // $Alumnos = AlumnosSemestre::find(
        //     [
        //         "semestre = {$Semestre->codigo} AND matricula_realizada = '1'",
        //         'order' => 'alumno',
        //     ]
        // );

        $db = $this->db;
        $sqlAlumnosSemestre = "  SELECT
        distinct public.carreras.descripcion,
        public.alumnos.apellidop,
        public.alumnos.apellidom,
        public.alumnos.nombres,
        public.alumnos_asignaturas.alumno
        FROM
        public.alumnos_asignaturas
        INNER JOIN public.alumnos ON public.alumnos.codigo = public.alumnos_asignaturas.alumno
        INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        where public.alumnos_asignaturas.semestre = {$Semestre->codigo} and public.alumnos_asignaturas.tipo <> 2 and public.alumnos_asignaturas.tipo <> 5
        ORDER BY
        public.carreras.descripcion ASC,
        public.alumnos.apellidop ASC,
        public.alumnos.apellidom ASC,
        public.alumnos.nombres ASC";

        //print($sql_ficha);
        //exit();

        $Alumnos = $db->fetchAll($sqlAlumnosSemestre, Phalcon\Db::FETCH_OBJ);

        //print "Normal count: " . count($Alumnos) . "<br>";
        //exit();
        //        foreach ($Alumnos as $value) {
        //            echo '<pre>';
        //            print_r($value->alumno);
        //        }
        //        exit();

        $pdf->SetFont('Arial', 'B', 16);
        foreach ($Alumnos as $alumno) {
            //$VFicha = VFicha::findFirstBycodigo($alumno->alumno);
            $VAlumnosSemestre = VAlumnosSemestre::findFirstBycodigo($alumno->alumno);

            //carrera
            //$Carreras = Carreras::findFirstBycodigo($VFicha->carrera_code);

            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 48);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(190, 12, '  FICHA DE MATRICULA - ' . $Semestre->descripcion, 1, 0, 'L');
            $pdf->Ln(18);

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(7);
            $pdf->Cell(50, 5, 'CODIGO', 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->codigo}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(7);
            $pdf->Cell(50, 5, 'APELLIDOS', 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->apellidop} {$VAlumnosSemestre->apellidom}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(7);
            $pdf->Cell(50, 5, 'NOMBRES', 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->nombres}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(7);
            $pdf->Cell(50, 5, strtoupper($this->config->global->xCarreraIns), 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->carrera_nombre}", 0, 0, 'L');
            $pdf->Ln(2);

            $header = array('CODIGO', 'CICLO', 'ASIGNATURA', 'GRUPO', 'TIPO', 'CREDITOS');
            $pdf->Ln(5);
            $pdf->SetFillColor(50, 50, 55);
            $pdf->SetTextColor(255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', 'B', 8);
            // Header
            $w = array(20, 15, 100, 15, 20, 20);
            for ($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
            }

            $pdf->Ln();

            // Color and font restoration
            $pdf->SetFillColor(0, 0, 0);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');
            // Data
            $fill = false;
            //Footer
            $pdf->SetWidths(array(20, 15, 100, 15, 20, 20));

            $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

            $semestre_m = $Semestre->codigo;

            //$ficha = VFicha::find("codigo = '{$VAlumnosSemestre->codigo}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}");

            // $ficha = VFicha::find(
            //     [
            //         'conditions' => "codigo = '{$VAlumnosSemestre->codigo}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}",
            //         'order'      => 'carrera_nombre, apellidos, nombres'
            //     ]
            // );

            // $ficha = VFicha::find(
            //     [
            //         "codigo = '{$VAlumnosSemestre->codigo}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}",
            //         'order' => 'carrera_nombre, apellidos, nombres',
            //     ]
            // );


            $db = $this->db;
            $sql_ficha = "  select * from view_ficha
            where codigo = '{$VAlumnosSemestre->codigo}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}
            order by carrera_nombre, apellidos, nombres ";
    
            //print($sql_ficha);
            //exit();
    
            $ficha = $db->fetchAll($sql_ficha, Phalcon\Db::FETCH_OBJ);

            // foreach ($ficha as $key => $value) {
            //     echo "<pre>";
            //     print_r($value->carrera_nombre);
            // }
    

            $num_cursos = count($ficha);
            $sum_creditos = 0;
            foreach ($ficha as $key => $value) {
                $sum_creditos = $sum_creditos + (int) $value->creditos;
                $pdf->row(array($value->asignatura_code, $value->ciclo, $value->nombre, $value->grupo, $value->tipo_matricula_abrev, $value->creditos));
            }
            //$pdf->row(array("xsa","asd","asd","asd","<d"));

            $pdf->Cell(array_sum($w), 0, '', 'T');
            $pdf->Ln();

            //$header = array('  TOTAL DE ASIGNATURAS :  ' . $num_cursos, 'TOTAL CREDITOS  ', '' . $sum_creditos);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(135, 5, 'TOTAL DE ASIGNATURAS: ' . $num_cursos, 1, 0, 'C');
            $pdf->Cell(55, 5, 'TOTAL CREDITOS: ' . $sum_creditos, 1, 1, 'C');
            // Data loading
            //$data = array("khi");
            $pdf->SetFont('Arial', 'B', 10);

            //$pdf->BasicTables($header, $data);
            $pdf->Ln(6);

            $pdf->Cell(10);
            $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
            $pdf->Cell(30);
            $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
            $pdf->Ln();

            $pdf->Cell(10);
            $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
            $pdf->Cell(30);
//            $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Ln(2);
            $pdf->SetFont('Arial', '', 9);
            // Move to the right
            //$pdf->Cell(10);
            // Title
            //  $pdf->MultiCell(190, 15, 'PROLONG. LIBERTAD #1220-1228 - YURIMAGUAS - LORETO - PERU \r '
            //       . ':v',1, 'C', 0, false);

            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $h = 10;
            $w = 190;
            //Draw the border
            $pdf->Rect($x, $y, $w, $h);
            //Print the text
            $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
            $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');
            //Put the position to the right of the cell
            $pdf->SetXY($x + $w, $y);
            $pdf->Ln(5);
            $pdf->Ln(5);
            //$pdf->Cell(50);
            //$pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la '.$this->config->global->xJefaturaIns, 0, 0, 'C');
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(190, 3, 'NOTA: TIPO MATRICULA ("MR": MATRICULA REGULAR, "RI": REINSCRIPCIÓN, "MN": MATRICULA DE NIVELACIÓN, "MX": MATRICULA EXTRACURRICULAR )', 0, 1, 'L');
            //NOTA: TIPO MATRICULA ("MR": MATRICULA REGULAR, "RI": REINSCRIPCIÓN, "MN": MATRICULA DE NIVELACIÓN, "MX": MATRICULA EXTRACURRICULAR )
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->Cell(190, 2, 'Este documento carece de valor oficial sin la firma del responsable de la ' . $this->config->global->xJefaturaIns, 0, 1, 'L');

            //other
            $anio = date('Y');
            $pdf->SetFont('Arial', 'I', 8);
            $pdf->Cell(190, 10, $this->config->global->xAbrevIns . ' - ' . $anio, 0, 1, 'C');

            $pdf->SetXY(0, 140);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(200, 5, '-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'C');

            $pdf->Ln(8);
            $pdf->Image('webpage/assets/img/logo-vr.png', 140, 154, 48);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(190, 12, '  FICHA DE MATRICULA - ' . $Semestre->descripcion, 1, 0, 'L');
            $pdf->Ln(18);
            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(7);
            $pdf->Cell(50, 5, 'CODIGO', 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->codigo}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(7);
            $pdf->Cell(50, 5, 'APELLIDOS', 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->apellidop} {$VAlumnosSemestre->apellidom}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(7);
            $pdf->Cell(50, 5, 'NOMBRES', 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->nombres}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(7);
            $pdf->Cell(50, 5, strtoupper($this->config->global->xCarreraIns), 0, 0, 'L');
            $pdf->Cell(50, 5, ":   {$VAlumnosSemestre->carrera_nombre}", 0, 0, 'L');
            $pdf->Ln(2);

            $header = array('CODIGO', 'CICLO', 'ASIGNATURA', 'GRUPO', 'TIPO', 'CREDITOS');
            $pdf->Ln(5);
            $pdf->SetFillColor(50, 50, 55);
            $pdf->SetTextColor(255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', 'B', 8);
            // Header
            $w = array(20, 15, 100, 15, 20, 20);
            for ($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
            }

            $pdf->Ln();

            // Color and font restoration
            $pdf->SetFillColor(0, 0, 0);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');
            // Data
            $fill = false;
            //Footer
            $pdf->SetWidths(array(20, 15, 100, 15, 20, 20));

            $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

            $semestre_m = $Semestre->codigo;

            $ficha = VFicha::find("codigo = '{$VAlumnosSemestre->codigo}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}");

            $num_cursos = count($ficha);
            $sum_creditos = 0;
            foreach ($ficha as $key => $value) {
                $sum_creditos = $sum_creditos + (int) $value->creditos;
                $pdf->row(array($value->asignatura_code, $value->ciclo, $value->nombre, $value->grupo, $value->tipo_matricula_abrev, $value->creditos));
            }
            //$pdf->row(array("xsa","asd","asd","asd","<d"));

            $pdf->Cell(array_sum($w), 0, '', 'T');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(135, 5, 'TOTAL DE ASIGNATURAS: ' . $num_cursos, 1, 0, 'C');
            $pdf->Cell(55, 5, 'TOTAL CREDITOS: ' . $sum_creditos, 1, 1, 'C');

            $pdf->SetFont('Arial', 'B', 10);

            //$pdf->BasicTables($header, $data);
            $pdf->Ln(6);
            $pdf->Cell(10);
            $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
            $pdf->Cell(30);
            $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
            $pdf->Ln();

            $pdf->Cell(10);
            $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
            $pdf->Cell(30);
//            $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Ln(2);
            $pdf->SetFont('Arial', '', 9);
            // Move to the right
            //$pdf->Cell(10);
            // Title
            //  $pdf->MultiCell(190, 15, 'PROLONG. LIBERTAD #1220-1228 - YURIMAGUAS - LORETO - PERU \r '
            //       . ':v',1, 'C', 0, false);

            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $h = 10;
            $w = 190;
            //Draw the border
            $pdf->Rect($x, $y, $w, $h);
            //Print the text
            $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
            $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');
            //Put the position to the right of the cell
            $pdf->SetXY($x + $w, $y);
            $pdf->Ln(10);
            //$pdf->Cell(50);
            //$pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la '.$this->config->global->xJefaturaIns, 0, 0, 'C');
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(190, 3, 'NOTA: TIPO MATRICULA ("MR": MATRICULA REGULAR, "RI": REINSCRIPCIÓN, "MN": MATRICULA DE NIVELACIÓN, "MX": MATRICULA EXTRACURRICULAR )', 0, 1, 'L');
            //NOTA: TIPO MATRICULA ("MR": MATRICULA REGULAR, "RI": REINSCRIPCIÓN, "MN": MATRICULA DE NIVELACIÓN, "MX": MATRICULA EXTRACURRICULAR )
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->Cell(190, 2, 'Este documento carece de valor oficial sin la firma del responsable de la ' . $this->config->global->xJefaturaIns, 0, 1, 'L');
        }
        //exit();
        $pdf->Output();
    }

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

    public function reporteRegistroAuxiliarAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        $DocentesAsignaturas = DocentesAsignaturas::find(
            [
                "semestre = {$Semestre->codigo} AND estado = 'A'",
                //'order' => 'alumno',
            ]
        );

        $pdf->SetFont('Arial', 'B', 16);
        foreach ($DocentesAsignaturas as $docente_asignatura) {
            //echo '<pre>';
            //print_r($docente_asignatura->asignatura);
            //            $semestre = Semestres::findFirst(
            //                            [
            //                                "codigo=" . (int) $docente_asignatura->semestre,
            //                                'order' => 'codigo DESC',
            //                                'limit' => 1,
            //                            ]
            //            );

            $VAsignaturasSemestre = VAsignaturasSemestre::findFirstBydocente_code($docente_asignatura->docente);

            $vista_registro_auxiliar = VFicha::find(
                [
                    "semestre = {$VAsignaturasSemestre->semestre_code} AND asignatura_code ='{$VAsignaturasSemestre->asignatura_code}' AND grupo = {$VAsignaturasSemestre->grupo}",
                    //'order' => 'alumno ASC',
                ]
            );

            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 15);

            $pdf->Cell(190, 25, 'REGISTRO DE AUXILIAR - ' . $VAsignaturasSemestre->semestre_definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);

            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'ASIGNATURA', 0, 0, 'L');
            $pdf->Cell(32, 5, " :  " . "  $VAsignaturasSemestre->asignatura_code", 0, 0, 'L');
            $pdf->Cell(10, 5, "{$VAsignaturasSemestre->nombre}", 0, 0, 'L');

            $pdf->Ln();
            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'TIPO', 0, 0, 'L');
            $pdf->Cell(32, 5, " :  " . "  {$VAsignaturasSemestre->tipo_asignatura_b}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'CICLO', 0, 0, 'L');
            $pdf->Cell(100, 5, " :  " . "  {$VAsignaturasSemestre->ciclo}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'GRUPO', 0, 0, 'L');
            $pdf->Cell(100, 5, " :  " . "  {$VAsignaturasSemestre->grupo}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'CRÉDITOS', 0, 0, 'L');
            $pdf->Cell(100, 5, " :  " . "  {$VAsignaturasSemestre->creditos}", 0, 0, 'L');

            $pdf->Ln();
            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'DOCENTE', 0, 0, 'L');
            $pdf->Cell(32, 5, " :  " . "  $VAsignaturasSemestre->docente_code", 0, 0, 'L');
            $pdf->Cell(10, 5, "{$VAsignaturasSemestre->docentes}", 0, 0, 'L');

            $pdf->Ln(3);

            $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', '', '', '', '', '');
            $pdf->Ln(5);
            $pdf->SetFillColor(250, 250, 255);
            $pdf->SetTextColor(0);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', 'B', 7);
            // Header
            $w = array(10, 20, 85, 15, 15, 15, 15, 15);
            for ($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
            }

            $pdf->Ln();

            // Color and font restoration
            $pdf->SetFillColor(0, 0, 0);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');
            // Data
            $fill = false;
            //Footer
            $pdf->SetWidths($w);

            $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C', 'C', 'C'));

            $crece = 0;
            foreach ($vista_registro_auxiliar as $key => $value) {
                $crece++;

                $pdf->row(array($crece, $value->codigo, $value->alumno, "", "", "", "", ""));
            }

            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(1);
            $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 0, 'L');

            $pdf->Ln(25);

            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(140);
            $pdf->Cell(51, 1, $this->config->global->xCiudadIns . ', ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

            $pdf->Ln(25);

            $pdf->Cell(1);
            $pdf->Cell(41, 5, '________________________________', 0, 0, 'L');
            $pdf->Cell(85, 5, "                              ", 0, 0, 'L');
            $pdf->Cell(10, 5, "________________________________", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Ln(18);

            $pdf->Cell(1);
            $pdf->Cell(41, 5, '________________________________', 0, 0, 'L');
            $pdf->Cell(85, 5, "                              ", 0, 0, 'L');
            $pdf->Cell(10, 5, "________________________________", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(1);
            $pdf->Cell(41, 5, '                              ', 0, 0, 'L');
            $pdf->Cell(85, 5, "                              ", 0, 0, 'L');
            $pdf->Cell(60, 5, "DOCENTE", 0, 0, 'C');
            $pdf->Ln();
        }
        //exit();
        $pdf->Output();
        //exit;
    }

    public function reporteCargaLectivaAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        $docentesSemestre = DocentesSemestre::find(
            [
                "semestre = {$Semestre->codigo} AND estado = 'A'",
                //'order' => 'alumno',
            ]
        );

        $pdf->SetFont('Arial', 'B', 16);
        foreach ($docentesSemestre as $docentesData) {
            //echo '<pre>';
            //print_r($docente_asignatura->asignatura);

            $semestre = Semestres::findFirst(
                [
                    "codigo=" . (int) $docentesData->semestre,
                    'order' => 'codigo DESC',
                    'limit' => 1,
                ]
            );
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();

            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(190, 25, 'RELACIÓN DE ASIGNATURAS - SEMESTRE ACADÉMICO ' . $Semestre->descripcion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);

            $Docentes = Docentes::findFirstBycodigo($docentesData->docente);

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(1);
            $pdf->Cell(30, 5, 'DOCENTE', 0, 0, 'L');
            $pdf->Cell(32, 5, " :  " . "  $Docentes->codigo", 0, 0, 'L');
            $pdf->Cell(10, 5, "{$Docentes->apellidop} {$Docentes->apellidom} {$Docentes->nombres}", 0, 0, 'L');
            $pdf->Ln();
            $pdf->Ln(5);

            $header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
            $pdf->Ln(5);
            $pdf->SetFillColor(250, 250, 255);
            $pdf->SetTextColor(0);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', 'B', 10);
            // Header
            $w = array(45, 20, 70, 15, 10, 10, 10, 10);
            for ($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
            }

            $pdf->Ln();

            // Color and font restoration
            $pdf->SetFillColor(0, 0, 0);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');
            // Data
            //Footer
            $pdf->SetWidths(array(45, 20, 70, 15, 10, 10, 10, 10));

            $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C', 'C'));

            // print($Semestre->codigo."-".$Docentes->codigo);
            // exit();

            $docenteCodigo = (int)$Docentes->codigo;

            //print($docenteCodigo);
            //exit();

            $db = $this->db;
            $sql_query = "SELECT DISTINCT
            public.docentes_asignaturas.asignatura AS asignatura_codigo,
            public.docentes_asignaturas.semestre,
            public.docentes_asignaturas.docente,
            public.docentes_asignaturas.tipo,
            public.docentes_asignaturas.tp,
            public.curriculas.descripcion AS curricula,
            public.asignaturas.ciclo,
            public.asignaturas.nombre AS asignatura_nombre,
            public.asignaturas.hp,
            public.asignaturas.ht AS ht,
            public.asignaturas.creditos AS creditos,
            public.docentes_asignaturas.grupo AS grupo,
            tipo.nombres AS tipo_nombre
            FROM
            public.docentes_asignaturas
            INNER JOIN public.asignaturas ON public.asignaturas.codigo = public.docentes_asignaturas.asignatura
            INNER JOIN public.curriculas ON public.curriculas.codigo = public.asignaturas.curricula
            INNER JOIN public.a_codigos AS tipo ON tipo.codigo = public.asignaturas.tipo
            WHERE
            tipo.numero = 71 AND
            public.docentes_asignaturas.semestre = {$Semestre->codigo} AND
            public.docentes_asignaturas.docente = {$docenteCodigo} AND
            public.docentes_asignaturas.estado = 'A'";

            // print($sql_query);
            // exit();

            $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

            foreach ($data as $key => $value) {
                $pdf->row(array($value->curricula, $value->asignatura_codigo, $value->asignatura_nombre, $value->grupo, $value->creditos, $value->ht, $value->hp));
            }
            $pdf->Ln();
        }
        //exit();
        $pdf->Output();
    }

#-------------------------------nuevos reportes--------------------------------

    public function reporteEstudiantesSancionadosAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
	public.carreras.codigo,
	public.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos_asignaturas
	INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
	INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
	AND public.alumnos_semestre.semestre = public.alumnos.semestre
        WHERE
	public.alumnos_asignaturas.semestre = {$Semestre->codigo}
	AND public.alumnos_asignaturas.veces >= 3
        GROUP BY
	public.carreras.descripcion,
	public.carreras.codigo";

        //print($sql_query);
        //exit();

        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES SANCIONADOS - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES SANCIONADOS - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'ASIGNATURA', 'VECES', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 100, 20, 10, 10);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.alumnos_asignaturas.veces,
            public.alumnos_asignaturas.asignatura,
            public.alumnos_semestre.ciclo
            FROM
            public.alumnos_asignaturas
            INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            WHERE
            public.alumnos_asignaturas.semestre = {$Semestre->codigo}
            AND public.alumnos_asignaturas.veces >= 3 AND public.carreras.codigo = '{$carrera->codigo}'";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;
                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->asignatura, $value->veces, $value->ciclo));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteReservaEstudiantesAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
	public.carreras.codigo,
	public.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos_semestre
	INNER JOIN public.alumnos ON public.alumnos_semestre.alumno = public.alumnos.codigo
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
	public.alumnos_semestre.semestre = {$Semestre->codigo}
	AND public.alumnos_semestre.reserva_matricula = '1'
        GROUP BY
	public.carreras.descripcion,
	public.carreras.codigo";

        //print($sql_query);
        //exit();

        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);

        if (count($Carreras) == 0) {
            //print('No hay registros');
            //exit();
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE RESERVA DE ESTUDIANTES - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            //print('Si hay registros');
            //exit();
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE RESERVA DE ESTUDIANTES - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 120, 20);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.alumnos_semestre.ciclo
            FROM
            public.alumnos_semestre
            INNER JOIN public.alumnos ON public.alumnos_semestre.alumno = public.alumnos.codigo
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            WHERE
            public.alumnos_semestre.semestre = {$Semestre->codigo}
            AND public.alumnos_semestre.reserva_matricula = '1' AND public.carreras.codigo = '{$carrera->codigo}'";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo));
                }
                //

                $pdf->Ln(3);
            }
            //exit();
            //exit;
        }

        $pdf->Output();
    }


    
    //reporte de número de estudiantes Matriculados
    public function reportenroEstudiantesMatriculadosAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT PUBLIC
        .carreras.codigo,
        PUBLIC.carreras.descripcion AS carrera_nombre,
        count(PUBLIC.alumnos.codigo) AS total
            FROM
        PUBLIC.alumnos_semestre
        INNER JOIN PUBLIC.alumnos ON PUBLIC.alumnos.codigo = PUBLIC.alumnos_semestre.alumno    
        AND PUBLIC.alumnos_semestre.semestre = PUBLIC.alumnos.semestre
        INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
            WHERE
        PUBLIC.alumnos_semestre.semestre = {$Semestre->codigo}
            GROUP BY
        PUBLIC.carreras.descripcion,
        PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'NÚMERO DE ESTUDIANTES MATRICULADOS - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            
        
            $pdf->SetFont('Arial', 'B', 9);

            $pdf->Cell(90, 10, 'CARRERA PROFESIONAL', 1, 0, 'L');
            $pdf->Cell(20, 10, 'TOTAL', 1, 0, 'C');
            $pdf->Ln();

            foreach ($Carreras as $carrera) {
              
                
                $pdf->SetFont('Arial', '', 9);

                $pdf->Cell(90, 10, "{$carrera->carrera_nombre}", 0, 0, 'L');
                $pdf->Cell(20, 10, "{$carrera->total}", 0, 0, 'C');
                $pdf->Ln(6);

                $suma= $suma + $carrera->total;
            }
            
            $pdf->Ln(5);

            $pdf->SetFont('Arial', 'B', 9);

            $pdf->Cell(90, 10, 'TOTAL DE ESTUDIANTES', 1, 0, 'L');
            $pdf->Cell(20, 10, "{$suma}", 1, 0, 'C');
            $pdf->Ln();
        
        $pdf->Output();
    }


//reporte de estudiantes Matriculados
    public function reporteEstudiantesMatriculadosAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT PUBLIC
    .carreras.codigo,
    PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
    PUBLIC.alumnos_asignaturas
    INNER JOIN PUBLIC.alumnos ON PUBLIC.alumnos.codigo = PUBLIC.alumnos_asignaturas.alumno
    INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo
    AND PUBLIC.alumnos_semestre.semestre = PUBLIC.alumnos.semestre
    INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
        WHERE
    PUBLIC.alumnos_semestre.semestre = {$Semestre->codigo}
        GROUP BY
    PUBLIC.carreras.descripcion,
    PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES MATRICULADOS - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES MATRICULADOS - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 120, 20);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT PUBLIC
                .alumnos.codigo,
                PUBLIC.alumnos.nro_doc,                
                CONCAT ( PUBLIC.alumnos.apellidop, ' ', PUBLIC.alumnos.apellidom, ' ', PUBLIC.alumnos.nombres ) AS alumno_nombre,
                PUBLIC.carreras.descripcion AS carrera_nombre,
                PUBLIC.alumnos_semestre.ciclo, 
                PUBLIC.alumnos.celular,
                PUBLIC.alumnos_semestre.semestre AS semestre,
                PUBLIC.alumnos.estado 
                FROM
                PUBLIC.alumnos
                INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
                INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo 
                WHERE
                PUBLIC.alumnos.estado = 'A' 
                AND PUBLIC.alumnos_semestre.semestre = {$Semestre->codigo} AND public.carreras.codigo = '{$carrera->codigo}'";
                               
                
                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }



    //reporte de estudiantes No Matriculados
    public function reporteEstudiantesNoMatriculadosAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT PUBLIC
	.carreras.codigo,
	PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
	PUBLIC.alumnos_asignaturas
	INNER JOIN PUBLIC.alumnos ON PUBLIC.alumnos.codigo = PUBLIC.alumnos_asignaturas.alumno
	INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo
	AND PUBLIC.alumnos_semestre.semestre = PUBLIC.alumnos.semestre
	INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
        WHERE
	PUBLIC.alumnos_semestre.semestre = {$Semestre->codigo}
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE RESERVA DE ESTUDIANTES - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE RESERVA DE ESTUDIANTES - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 120, 20);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT PUBLIC
            .alumnos.codigo,
            PUBLIC.alumnos.nro_doc,
            CONCAT ( PUBLIC.alumnos.apellidop, ' ', PUBLIC.alumnos.apellidom, ' ', PUBLIC.alumnos.nombres ) AS alumno_nombre,
            PUBLIC.carreras.descripcion AS carrea_nombre,
            PUBLIC.alumnos_semestre.ciclo
            FROM
            PUBLIC.alumnos_asignaturas
            INNER JOIN PUBLIC.alumnos ON PUBLIC.alumnos.codigo = PUBLIC.alumnos_asignaturas.alumno
            INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo
            INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
            WHERE
            PUBLIC.alumnos_semestre.semestre = {$Semestre->codigo} AND public.carreras.codigo = '{$carrera->codigo}'";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteestudiantesreprobados2Action($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
	public.carreras.codigo,
	public.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos_asignaturas
	INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
	INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
	AND public.alumnos_semestre.semestre = public.alumnos.semestre
        WHERE
	public.alumnos_asignaturas.semestre = {$Semestre->codigo}
	AND public.alumnos_asignaturas.veces >= 2
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES REPROBADOS UNA MISMA ASIGNATURA POR 2DA - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES REPROBADOS UNA MISMA ASIGNATURA POR 2DA - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'ASIGNATURA', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 110, 20, 10);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_asignaturas.veces,
            public.alumnos_asignaturas.asignatura,
            public.alumnos_semestre.ciclo
            FROM
            public.alumnos_asignaturas
            INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            WHERE
            public.alumnos_asignaturas.semestre = {$Semestre->codigo}
            AND public.alumnos_asignaturas.veces >= 2 AND public.carreras.codigo = '{$carrera->codigo}'";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->asignatura, $value->ciclo));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteestudiantesreprobados3Action($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
	public.carreras.codigo,
	public.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos_asignaturas
	INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
	INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
	AND public.alumnos_semestre.semestre = public.alumnos.semestre
        WHERE
	public.alumnos_asignaturas.semestre = {$Semestre->codigo}
	AND public.alumnos_asignaturas.veces >= 3
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES REPROBADOS UNA MISMA ASIGNATURA POR 3ERA - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES REPROBADOS UNA MISMA ASIGNATURA POR 3ERA - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'ASIGNATURA', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 110, 20, 10);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_asignaturas.veces,
            public.alumnos_asignaturas.asignatura,
            public.alumnos_semestre.ciclo
            FROM
            public.alumnos_asignaturas
            INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            WHERE
            public.alumnos_asignaturas.semestre = {$Semestre->codigo}
            AND public.alumnos_asignaturas.veces >= 3 AND public.carreras.codigo = '{$carrera->codigo}'";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->asignatura, $value->ciclo));
                }

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteestudiantesreprobados4Action($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT PUBLIC
	.carreras.codigo,
	PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
	PUBLIC.alumnos_asignaturas
	INNER JOIN PUBLIC.alumnos ON PUBLIC.alumnos_asignaturas.alumno = PUBLIC.alumnos.codigo
	INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
	INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo
	AND PUBLIC.alumnos_semestre.semestre = PUBLIC.alumnos.semestre
        WHERE
	PUBLIC.alumnos_asignaturas.semestre = {$Semestre->codigo}
	AND PUBLIC.alumnos_asignaturas.veces >= 4
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES REPROBADOS UNA MISMA ASIGNATURA POR 4TA - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ESTUDIANTES REPROBADOS UNA MISMA ASIGNATURA POR 4TA - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'ASIGNATURA', 'CICLO');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 20, 110, 20, 10);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_asignaturas.veces,
            public.alumnos_asignaturas.asignatura,
            public.alumnos_semestre.ciclo
            FROM
            public.alumnos_asignaturas
            INNER JOIN public.alumnos ON public.alumnos_asignaturas.alumno = public.alumnos.codigo
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            WHERE
            public.alumnos_asignaturas.semestre = {$Semestre->codigo}
            AND public.alumnos_asignaturas.veces >= 4 AND public.carreras.codigo = '{$carrera->codigo}'";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->asignatura, $value->ciclo));
                }
                //

                $pdf->Ln(3);
            }
            //exit();
        }

        $pdf->Output();
    }

    public function reporteordenmeritoAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT PUBLIC
	.carreras.codigo,
	PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
	PUBLIC.alumnos
	INNER JOIN PUBLIC.alumnos_semestre ON PUBLIC.alumnos_semestre.alumno = PUBLIC.alumnos.codigo
	AND PUBLIC.alumnos_semestre.semestre = PUBLIC.alumnos.semestre
	INNER JOIN PUBLIC.carreras ON PUBLIC.alumnos.carrera = PUBLIC.carreras.codigo
        WHERE
	PUBLIC.alumnos_semestre.semestre = {$Semestre->codigo}
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO PROMEDIO PONDERADO SEMESTRAL - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO PROMEDIO PONDERADO SEMESTRAL - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO', 'Orden Mérito', 'PPS Anterior', 'PPS', 'CRED.', 'CRED. ACUM.');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 16, 13, 60, 16, 16, 16, 16, 16, 16);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C', 'C', 'C', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_semestre.ciclo,
            public.alumnos_semestre.orden,
            public.alumnos_semestre.promedio_anterior,
            public.alumnos_semestre.promedio_acumulado,
            public.alumnos_semestre.creditos,
            public.alumnos_semestre.creditos_acumulado
            FROM
            public.alumnos
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            WHERE
            public.alumnos_semestre.semestre = {$Semestre->codigo} AND public.carreras.codigo = '{$carrera->codigo}' ORDER BY
            public.alumnos_semestre.orden ASC,
            public.alumnos_semestre.ciclo ASC";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo, $value->orden, round($value->promedio_anterior, 2), round($value->promedio_acumulado, 2), $value->creditos, $value->creditos_acumulado));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteordenmeritoacumuladoAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
        PUBLIC
	.carreras.codigo,
	PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos
	INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
	AND public.alumnos_semestre.semestre = public.alumnos.semestre
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
	public.alumnos_semestre.semestre = {$Semestre->codigo}
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO PROMEDIO PONDERADO ACUMULADO - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO PROMEDIO PONDERADO ACUMULADO - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO', 'Orden Mérito', 'PPS Anterior', 'PPA', 'CRED. ACUM.');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 16, 13, 72, 16, 16, 16, 16, 16, 16);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C', 'C', 'C', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_semestre.ciclo,
            public.alumnos_semestre.orden,
            public.alumnos_semestre.promedio_anterior,
            public.alumnos_semestre.promedio_acumulado,
            public.alumnos_semestre.creditos_acumulado
            FROM
            public.alumnos
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            WHERE
            public.alumnos_semestre.semestre = {$Semestre->codigo} AND public.carreras.codigo = '{$carrera->codigo}'
            ORDER BY
            public.alumnos_semestre.orden ASC,
            public.alumnos_semestre.ciclo ASC";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo, $value->orden, round($value->promedio_anterior, 2), round($value->promedio_acumulado, 2), $value->creditos_acumulado));
                }

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    
    public function reporteordenmeritoinvictosAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
        PUBLIC
	.carreras.codigo,
	PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos
	INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
	AND public.alumnos_semestre.semestre = public.alumnos.semestre
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
	public.alumnos_semestre.semestre = {$Semestre->codigo}
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO INVICTOS - ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO INVICTOS - ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "{$carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO', 'Orden Mérito', 'PPS Anterior', 'PPS', 'CRED. ACUM.');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 16, 13, 72, 16, 16, 16, 16, 16);
                for ($i = 0; $i < count($header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C', 'C', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_semestre.ciclo,
            public.alumnos_semestre.orden,
            public.alumnos_semestre.promedio_anterior,
            public.alumnos_semestre.promedio_acumulado,
            public.alumnos_semestre.creditos_acumulado
            FROM
            public.alumnos
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            WHERE
            public.alumnos_semestre.semestre = {$Semestre->codigo} AND public.carreras.codigo = '{$carrera->codigo}'
            ORDER BY
            public.alumnos_semestre.orden ASC,
            public.alumnos_semestre.ciclo ASC";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo, $value->orden, round($value->promedio_anterior, 2), round($value->promedio_acumulado, 2), $value->creditos_acumulado));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteordenmeritoinvictoscarreraprofesionalAction($semestre)
    {
        $this->view->disable();
        //semestre
        $Semestre = Semestres::findFirstBycodigo($semestre);

        $pdf = new PDF();

        //cabecera
        $db_cabecera = $this->db;
        $sql_query_cabecera = "SELECT
        PUBLIC
	.carreras.codigo,
	PUBLIC.carreras.descripcion AS carrera_nombre
        FROM
	public.alumnos
	INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
	AND public.alumnos_semestre.semestre = public.alumnos.semestre
	INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
	public.alumnos_semestre.semestre = {$Semestre->codigo}
        GROUP BY
	PUBLIC.carreras.descripcion,
	PUBLIC.carreras.codigo";
        $Carreras = $db_cabecera->fetchAll($sql_query_cabecera, Phalcon\Db::FETCH_OBJ);
        //

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;
            //$pdf->Cell(190, 0, '', 0, 0, 'L');
            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO INVICTOS - CARRERA PROFESIONAL ' . $Semestre->definicion, 0, 0, 'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Arial', 'B', 9);
        } else {
            $pdf->SetFont('Arial', 'B', 16);
            foreach ($Carreras as $carrera) {

                $pdf->AddPage();
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(190, 25, 'REPORTE DE ORDEN DE MERITO INVICTOS - CARRERA PROFESIONAL ' . $Semestre->definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, " { $carrera->carrera_nombre}", 0, 0, 'L');

                $header = array('NRO', 'CODIGO', 'DNI', 'APELLIDOS Y NOMBRES', 'CICLO', 'Orden Mérito', 'PPS Anterior', 'PPA');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 16, 13, 85, 16, 16, 16, 16);
                for ($i = 0; $i < count(
                    $header); $i++) {
                    $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
                }

                $pdf->Ln();

                // Color and font restoration
                $pdf->SetFillColor(0, 0, 0);
                $pdf->SetTextColor(0);
                $pdf->SetFont('');
                // Data
                $fill = false;
                //Footer
                $pdf->SetWidths($w);

                $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C', 'C', 'C'));

                $crece = 0;

                //
                $db = $this->db;
                $sql_query = "SELECT
            public.alumnos.codigo,
            public.alumnos.nro_doc,
            CONCAT ( public.alumnos.apellidop, ' ', public.alumnos.apellidom, ' ', public.alumnos.nombres ) AS alumno_nombre,
            public.carreras.descripcion AS carrea_nombre,
            public.alumnos_semestre.ciclo,
            public.alumnos_semestre.orden,
            public.alumnos_semestre.promedio_anterior,
            public.alumnos_semestre.promedio_acumulado,
            public.alumnos_semestre.creditos_acumulado
            FROM
            public.alumnos
            INNER JOIN public.alumnos_semestre ON public.alumnos_semestre.alumno = public.alumnos.codigo
            AND public.alumnos_semestre.semestre = public.alumnos.semestre
            INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
            WHERE
            public.alumnos_semestre.semestre = {$Semestre->codigo} AND public.carreras.codigo = '{$carrera->codigo}'
            ORDER BY
            public.alumnos_semestre.orden ASC,
            public.alumnos_semestre.ciclo ASC";

                //print($sql_query);
                //exit();

                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->codigo, $value->nro_doc, $value->alumno_nombre, $value->ciclo, $value->orden, round($value->promedio_anterior, 2), round($value->promedio_acumulado, 2)));
                }
                //

                $pdf->Ln(3);
            }
        }
        $pdf->Output();
    }

}
