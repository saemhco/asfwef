<?php

require_once APP_PATH . '/app/library/pdf.php';

class ReportesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        //$this->assets->addJs("adminpanel/js/modulos/reportes.js?v=" . uniqid());
    }

    //reporte ficha de matricula
    public function reporteFichaMatriculaAction($semestre, $alumno) {
        $this->view->disable();

        $codigo_alumno = $alumno;
        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);

        $Carreras = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $Semestre = Semestres::findFirstBycodigo($semestre);

        //print $semestre->codigo;exit();

        $VAlumnosSemestre = VAlumnosSemestre::findFirstBycodigo($codigo_alumno);


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 15, '  FICHA DE MATRICULA - ' . $Semestre->descripcion, 1, 0, 'L');
        // Line break
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
        $pdf->Cell(50, 5, ":   {$Carreras->descripcion}", 0, 0, 'L');

        $pdf->Ln(4);

        $header = array('CODIGO', 'CICLO', 'ASIGNATURA', 'GRUPO', 'TIPO', 'CREDITOS');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(30, 15, 90, 15, 20, 20);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        //Footer
        $pdf->SetWidths(array(30, 15, 90, 15, 20, 20));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

        $semestre_m = $Semestre->codigo;

        $ficha = VFicha::find("codigo = '{$codigo_alumno}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}");

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
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(135, 5, 'TOTAL DE ASIGNATURAS: ' . $num_cursos, 1, 0, 'C');
        $pdf->Cell(55, 5, 'TOTAL CREDITOS: ' . $sum_creditos, 1, 1, 'C');
        // Data loading
        //$data = array("khi");
        $pdf->SetFont('Arial', 'B', 10);

        //$pdf->BasicTables($header, $data);
        $pdf->Ln(6);
        //$pdf->Ln(5);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();


        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);

        $pdf->Ln(5);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);


        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $h = 10;
        $w = 190;
        //Draw the border
        $pdf->Rect($x, $y, $w, $h);
        //Print the text
        $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
        $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');

        $pdf->SetXY($x + $w, $y);

        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 6);
        $pdf->Cell(190, 3, 'NOTA: TIPO MATRICULA ("MR": MATRICULA REGULAR, "RI": REINSCRIPCIÓN, "MN": MATRICULA DE NIVELACIÓN, "MX": MATRICULA EXTRACURRICULAR )', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Cell(190, 2, 'Este documento carece de valor oficial sin la firma del responsable de la ' . $this->config->global->xJefaturaIns, 0, 1, 'L');

        //linea punteada 


        $anio = date('Y');
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(190, 10, 'UNCA - ' . $anio, 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(200, 5, '-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 0, 'C');

        //Otra hoja
        $pdf->Ln(12);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 153, 52);
        $pdf->Cell(190, 15, '  FICHA DE MATRICULA - ' . $Semestre->descripcion, 1, 0, 'L');
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
        $pdf->Cell(50, 5, ":   {$Carreras->descripcion}", 0, 0, 'L');

        $pdf->Ln(4);

        $header = array('CODIGO', 'CICLO', 'ASIGNATURA', 'GRUPO', 'TIPO', 'CREDITOS');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(30, 15, 90, 15, 20, 20);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
       
        //Footer
        $pdf->SetWidths(array(30, 15, 90, 15, 20, 20));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

        $semestre_m = $Semestre->codigo;

        $ficha = VFicha::find("codigo = '{$codigo_alumno}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}");


        foreach ($ficha as $key => $value) {
            $sum_creditos = $sum_creditos + (int) $value->creditos;
            $pdf->row(array($value->asignatura_code, $value->ciclo, $value->nombre, $value->grupo, $value->tipo_matricula_abrev, $value->creditos));
        }
        //$pdf->row(array("xsa","asd","asd","asd","<d"));

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();

        //$header = array('  TOTAL DE ASIGNATURAS :  ' . $num_cursos, 'TOTAL CREDITOS  ', '' . $sum_creditos);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(135, 5, 'TOTAL DE ASIGNATURAS: ' . $num_cursos, 1, 0, 'C');
        $pdf->Cell(55, 5, 'TOTAL CREDITOS: ' . $sum_creditos, 1, 1, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(6);

        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 1, 'C');

        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);

        $pdf->Ln(5);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $h = 10;
        $w = 190;
        //Draw the border
        $pdf->Rect($x, $y, $w, $h);
        //Print the text
        $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
        $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');

        $pdf->SetXY($x + $w, $y);

        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 6);
        $pdf->Cell(190, 3, 'NOTA: TIPO MATRICULA ("MR": MATRICULA REGULAR, "RI": REINSCRIPCIÓN, "MN": MATRICULA DE NIVELACIÓN, "MX": MATRICULA EXTRACURRICULAR )', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Cell(190, 2, 'Este documento carece de valor oficial sin la firma del responsable de la ' . $this->config->global->xJefaturaIns, 0, 1, 'L');


        $pdf->Output();
        exit;
    }

    //reporte de boleta de notas promedio
    public function reporteBoletaNotasPromedioAction($semestre, $alumno) {
        $this->view->disable();

        $codigo_alumno = $alumno;
        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);

        $carrera = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $Semestre = Semestres::findFirstBycodigo($semestre);

        //print $semestre->codigo;exit();


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        //echo '<pre>';
        //print_r($semestre->descripcion);
        //exit();

        $pdf->Cell(190, 15, 'BOLETA DE NOTAS - ' . $Semestre->descripcion, 1, 0, 'L');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(7);
        $pdf->Cell(50, 5, 'CODIGO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$codigo_alumno}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(7);
        $pdf->Cell(50, 5, 'APELLIDOS', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$dato_alumno->apellidop} {$dato_alumno->apellidom}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(7);
        $pdf->Cell(50, 5, 'NOMBRES', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$dato_alumno->nombres}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(7);
        $pdf->Cell(50, 5, strtoupper($this->config->global->xCarreraIns), 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$carrera->descripcion}", 0, 0, 'L');

        $pdf->Ln(5);

        $header = array('CODIGO', 'CICLO', 'ASIGNATURA', 'CREDITOS', 'PROM. FINAL');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(30, 15, 100, 20, 25);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(30, 15, 100, 20, 25));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C'));

        $codestr = $Semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        $notas_curso = $this->modelsManager->createBuilder()
                ->from('AlumnosAsignaturas')
                ->columns('DISTINCT AlumnosAsignaturas.asignatura ,AlumnosAsignaturas.semestre, AlumnosAsignaturas.asignatura, 
        AlumnosAsignaturas.alumno,Acodigos.descripcion ,AlumnosAsignaturas.pf, Asignaturas.nombre, Asignaturas.creditos, Asignaturas.ciclo')
                ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
                ->join('Acodigos', 'Acodigos.codigo = AlumnosAsignaturas.tipo')
                ->where("AlumnosAsignaturas.alumno='{$codigo_alumno}' AND  AlumnosAsignaturas.semestre = {$codestr} AND AlumnosAsignaturas.tipo <> 5  AND AlumnosAsignaturas.tipo <> 2  AND Acodigos.numero = 9 ")
                ->getQuery()
                ->execute();



        $num_cursos = count($notas_curso);
        $sum_creditos = 0;
        $prom_sum = 0;
        foreach ($notas_curso as $key => $value) {
            $sum_creditos = $sum_creditos + (int) $value->creditos;
            $prom_sum = $prom_sum + ( $value->pf * $value->creditos );
            $pdf->row(array($value->asignatura, $value->ciclo, $value->nombre, $value->creditos, $value->pf));
        }
        //$pdf->row(array("xsa","asd","asd","asd","<d"));
        $prom_semes = $prom_sum / $sum_creditos;
        $prom_semes_resultado = number_format($prom_semes, 2, '.', ' ');

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();

        //$header = array('TOTAL DE ASIGNATURAS : ' . $num_cursos,'TOTAL CREDITOS: '. $sum_creditos,'PSS: '.$prom_semes_resultado);
        $header = array('TOTAL CREDITOS: ', $sum_creditos, '');
        // Data loading
        $data = array();
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->BasicTables($header, $data);
        $pdf->Ln(5);

        $pdf->Cell(45, 5, 'TOTAL DE ASIGNATURAS: ' . $num_cursos, 0, 0, 'L');
        $pdf->Cell(100);
        $pdf->Cell(20, 5, 'PPS: ', 0, 0, 'R');
        $pdf->Cell(25, 5, $prom_semes_resultado, 0, 0, 'C');

        $pdf->Ln(5);
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 9);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        //  $pdf->MultiCell(190, 15, 'PROLONG. LIBERTAD #1220-1228 - YURIMAGUAS - LORETO - PERU \r '
        //       . ':v',1, 'C', 0, false);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $h = 12;
        $w = 190;
        //Draw the border
        $pdf->Rect($x, $y, $w, $h);
        //Print the text
        $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
        $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');
        //Put the position to the right of the cell
        $pdf->SetXY($x + $w, $y);
        $pdf->Ln(5);
        $pdf->Ln(10);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA: Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');

        $pdf->Output();
        exit;
    }

    //reporte de convalidacion
    public function reporteAlumnoConvalidiacionesAction($alumno) {
        $this->view->disable();

        //$auth = $this->session->get('auth');
        //$codigo_alumno = $auth["codigo"];



        $dato_alumno = Alumnos::findFirstBycodigo($alumno);

        $Carreras = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        //print $semestre->codigo;exit();


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 15, '  CONVALIDACIÓN DE ASIGNATURAS', 1, 0, 'L');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(7);
        $pdf->Cell(50, 5, 'CODIGO', 0, 0, 'L');
        $pdf->Cell(50, 5, ":   {$alumno}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(7);
        $pdf->Cell(50, 5, 'APELLIDOS', 0, 0, 'L');
        $pdf->Cell(50, 5, ":   {$dato_alumno->apellidop} {$dato_alumno->apellidom}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(7);
        $pdf->Cell(50, 5, 'NOMBRES', 0, 0, 'L');
        $pdf->Cell(50, 5, ":   {$dato_alumno->nombres}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(7);
        $pdf->Cell(50, 5, strtoupper($this->config->global->xCarreraIns), 0, 0, 'L');
        $pdf->Cell(50, 5, ":   {$Carreras->descripcion}", 0, 0, 'L');

        $pdf->Ln(5);

        $header = array('CODIGO', 'CICLO', 'ASIGNATURA', 'SEMESTRE', 'CREDITOS', 'PROM. FINAL');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(30, 15, 80, 20, 20, 25);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(30, 15, 80, 20, 20, 25));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

        $codestr = $semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        $notas_curso = $this->modelsManager->createBuilder()
                ->from('AlumnosAsignaturas')
                ->columns('DISTINCT AlumnosAsignaturas.asignatura ,AlumnosAsignaturas.semestre, AlumnosAsignaturas.asignatura,Semestres.descripcion AS nombre_semestre,
        AlumnosAsignaturas.alumno,Acodigos.descripcion ,AlumnosAsignaturas.pf, Asignaturas.nombre, Asignaturas.creditos, Asignaturas.ciclo')
                ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
                ->join('Acodigos', 'Acodigos.codigo = AlumnosAsignaturas.semestre')
                ->join('Semestres', 'Semestres.codigo = AlumnosAsignaturas.tipo')
                ->where("AlumnosAsignaturas.alumno='{$alumno}' "
                        . "AND  AlumnosAsignaturas.semestre = {$codestr} "
                        . "AND Acodigos.numero = 9 AND Acodigos.codigo = 9 "
                        . "AND Semestres.estado ='M' ")
                ->getQuery()
                ->execute();



        $num_cursos = count($notas_curso);
        $sum_creditos = 0;
        $prom_sum = 0;
        foreach ($notas_curso as $key => $value) {
            $sum_creditos = $sum_creditos + (int) $value->creditos;
            $prom_sum = $prom_sum + ( $value->pf * $value->creditos );
            $pdf->row(array($value->asignatura, $value->ciclo, $value->nombre, $value->nombre_semestre, $value->creditos, $value->pf));
        }
        //$pdf->row(array("xsa","asd","asd","asd","<d"));

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();

        $prom_semes = $prom_sum / $sum_creditos;
        $prom_semes_resultado = number_format($prom_semes, 2, '.', ' ');

        //$header = array('TOTAL DE ASIGNATURAS :  ' . $num_cursos, 'TOTAL CREDITOS  ', '' . $sum_creditos);
        $header = array('TOTAL DE ASIGNATURAS :  ' . $num_cursos, 'PSS: ', $prom_semes_resultado);

        //$pdf->Cell(165, 5, 'TOTAL DE ASIGNATURAS:' . $num_cursos.'                               '.'                               '.'                         '.'TOTAL CREDITOS:', 1, 0, 'L');
        //$pdf->Cell(25, 5, '           '.$sum_creditos, 1, 0, 'L');
        // Data loading
        $data = array();
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->BasicTables($header, $data);
        $pdf->Ln(10);
        $pdf->Ln(5);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();


        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
        $pdf->Ln(5);
        $pdf->Ln(10);
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
        $pdf->Ln(10);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');

        $pdf->Output();
        exit;
    }

    //reporte de asistencia
    function mesespanion($mes) {
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
            "12" => "diciembre"
        );

        return $array[$mes];
    }

    public function reporteAsistenciasAction($semestre, $curso, $asistencia) {



        $this->view->disable();
        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];
        $full_name = $auth["full_name"];

        $Semestre = Semestres::findFirst(
                        [
                            "codigo=" . (int) $semestre,
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $cursoob = Asignaturas::findFirstBycodigo($curso);


        //print $cursoob->nombre;exit();
        //Las asistencias
        $vista_asistencias = Vistaasistencias::find(
                        [
                            "semestre = '{$semestre}' AND asistencia='{$asistencia}'  ",
                            'order' => 'apellidos ASC',
                        ]
        );


        //asistencias
        $asistencias = AsistenciasSemestre::findFirst("semestre = {$semestre} AND asignatura='{$curso}' AND codigo = {$asistencia}  ");


        //modalidad (tipo)
        $semestre_pk = $semestre;
        $asignatura_pk = $cursoob->codigo;
        $grupo_pk = $asistencias->grupo;
        $docente_pk = $doc_id;
        $subgrupo_pk = $asistencias->subgrupo;

        $DocentesAsignaturasDetalle = DocentesAsignaturasDetalle::findFirst("semestre = {$semestre_pk} AND "
                        . "asignatura = '{$asignatura_pk}' AND "
                        . "grupo = {$grupo_pk} AND "
                        . "docente = {$docente_pk} AND "
                        . "subgrupo = {$subgrupo_pk}");
        //print($DocentesAsignaturasDetalle->modalidad);
        //exit();
        $Modalidades = Modalidad::findFirst(
                        [
                            "estado = 'A'  AND numero = 55 AND codigo = {$DocentesAsignaturasDetalle->modalidad}"
                        ]
        );







        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 25, 'REGISTRO DE ASISTENCIAS - SEMESTRE ACADÉMICO' . $Semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 9);


        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'DOCENTE', 0, 0, 'L');
        $pdf->Cell(32, 5, " :  " . "  $doc_id", 0, 0, 'L');
        $pdf->Cell(10, 5, "{$full_name}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'ASIGNATURA', 0, 0, 'L');
        $pdf->Cell(32, 5, " :  " . "  $curso", 0, 0, 'L');
        $pdf->Cell(10, 5, "{$cursoob->nombre}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'CICLO', 0, 0, 'L');
        $pdf->Cell(100, 5, " :  " . "  {$cursoob->ciclo}", 0, 0, 'L');

        $pdf->Cell(33, 5, 'GRUPO - SUBGRUPO', 0, 0, 'L');
        $pdf->Cell(10, 5, " :  " . "  {$asistencias->grupo}-{$asistencias->subgrupo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'CRÉDITOS', 0, 0, 'L');
        $pdf->Cell(100, 5, " :  " . "  {$cursoob->creditos}", 0, 0, 'L');

        $pdf->Cell(33, 5, 'TIPO', 0, 0, 'L');
        $pdf->Cell(10, 5, " :  " . "  {$Modalidades->nombres}", 0, 0, 'L');
        $pdf->Ln();



        $fecha = explode(" ", $asistencias->fecha);
        //$nueva_fecha = $fecha_format[2] . "-" . $fecha_format[1] . "-" . $fecha_format[0];



        $fecha_formato = explode("-", $fecha[0]);

        //print("fecha:" . $fecha_formato[0]);
        //exit();

        $fecha_formato_resultado = $fecha_formato[2] . "/" . $fecha_formato[1] . "/" . $fecha_formato[0];
        $hora = $fecha[1];

        //print("Fecha:" . $fecha_formato_resultado);
        //exit();

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'FECHA', 0, 0, 'L');
        $pdf->Cell(100, 5, " :  " . "  $fecha_formato_resultado", 0, 0, 'L');

        $pdf->Cell(33, 5, 'HORA', 0, 0, 'L');
        $pdf->Cell(10, 5, " :  " . "  $hora", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'TEMA', 0, 0, 'L');
        $pdf->Cell(32, 5, " :  " . "  {$asistencias->tema}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'OBSERVACIONES', 0, 0, 'L');
        $pdf->Cell(32, 5, " :  " . "  {$asistencias->observaciones}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Ln(3);



        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', 'DETALLE', 'OBSERVACIONES');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header
        $w = array(10, 20, 110, 17, 33);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths($w);

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'L'));

        $crece = 0;
        foreach ($vista_asistencias as $key => $value) {
            $crece++;



            //Formateamos el detalle
            if ($value->detalle == 0) {
                $detalle = 'Falto';
            } elseif ($value->detalle == 1) {
                $detalle = 'Asistió';
            } elseif ($value->detalle == 2) {
                $detalle = 'Tardanza';
            } elseif ($value->detalle == 3) {
                $detalle = 'Justifico';
            }

            $pdf->row(array($crece, $value->alumno, $value->apellidos . " " . $value->nombres, $detalle, $value->obervaciones));
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
        $pdf->Output();




        exit;
    }

    //reporte registro auxiliar
    public function reporteRegistroAuxiliarAction($semestrex, $curso, $grupo) {
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



        //$VAsignaturasSemestre = VAsignaturasSemestre::findFirstBydocente_code($doc_id);

        $VAsignaturasSemestre = VAsignaturasSemestre::findFirst("semestre_code = {$semestrex} AND asignatura_code = '{$curso}' AND grupo = {$grupo} AND docente_code = {$doc_id}");


        $vista_registro_auxiliar = VFicha::find(
                        [
                            "semestre = {$VAsignaturasSemestre->semestre_code} AND asignatura_code ='{$VAsignaturasSemestre->asignatura_code}' AND grupo = {$VAsignaturasSemestre->grupo}",
                        //'order' => 'alumno ASC',
                        ]
        );



        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
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

        $pdf->Cell(33, 5, 'GRUPO - SUBGRUPO', 0, 0, 'L');
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
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
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
        $pdf->Output();



        exit;
    }

    //reporte carga academica
    public function reporteCargaAcademicaAction($semestre) {
        $this->view->disable();
        $auth = $this->session->get('auth');
        $docente = $auth["codigo"];
        $full_name = $auth["full_name"];

        $Semestre = Semestres::findFirst(
                        [
                            "codigo=" . (int) $semestre,
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 25, 'RELACIÓN DE ASIGNATURAS - SEMESTRE ACADÉMICO ' . $Semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(1);
        $pdf->Cell(30, 5, 'DOCENTE', 0, 0, 'L');
        $pdf->Cell(32, 5, " :  " . "  $docente", 0, 0, 'L');
        $pdf->Cell(10, 5, "{$full_name}", 0, 0, 'L');
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
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        //Footer
        $pdf->SetWidths(array(45, 20, 70, 15, 10, 10, 10, 10));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C', 'C'));

        $sql_consulta = $this->modelsManager->createQuery("SELECT docentesasignaturas.asignatura,
                docentesasignaturas.asignatura AS asignatura_codigo, docentesasignaturas.semestre, docentesasignaturas.docente,
                docentesasignaturas.tipo, docentesasignaturas.tp, curriculas.descripcion AS curricula, asignaturas.ciclo,
                asignaturas.nombre AS asignatura_nombre , docentesasignaturas.semestre, asignaturas.hp, asignaturas.ht AS ht, 
                asignaturas.creditos AS creditos, tipo.nombres, docentesasignaturas.grupo AS grupo
                FROM DocentesAsignaturas docentesasignaturas
                INNER JOIN Asignaturas asignaturas ON asignaturas.codigo = docentesasignaturas.asignatura
                INNER JOIN Curriculas curriculas ON curriculas.codigo = asignaturas.curricula
                INNER JOIN TipoAsignaturasE tipo ON tipo.codigo = asignaturas.tipo
                WHERE docentesasignaturas.semestre = {$Semestre->codigo} AND docentesasignaturas.docente = {$docente} AND tipo.numero = 71");
        $CargaAcademica = $sql_consulta->execute();

        foreach ($CargaAcademica as $key => $value) {
            $pdf->row(array($value->curricula, $value->asignatura_codigo, $value->asignatura_nombre, $value->grupo, $value->creditos, $value->ht, $value->hp));
        }

        $pdf->Ln();
        $pdf->Output();
        exit;
    }

    //reporte de acta inicial
    public function reporteActaInicialAction($semestrex, $curso, $grupo) {
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

        $cursoob = Asignaturas::findFirstBycodigo($curso);
        //print $cursoob->nombre;exit();


        $carrera = Curriculas::findFirstBycodigo($cursoob->curricula);

        $conditions = " semestre = {$semestrex} AND asignatura = '{$curso}' AND grupo = {$grupo} AND docente = {$doc_id} ";



        $prom_conf = PromedioDetalle::findFirst([$conditions])->toArray();

        // las notas 

        $vista_notas = VNotas::find(
                        [
                            "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo<>2 AND tipo<>5 AND tipo <>9  AND grupo = {$grupo} ",
                            'order' => 'apellidos ASC',
                        ]
        );


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 25, 'REGISTRO DE NOTAS - PRIMER PARCIAL - SEMESTRE ACADÉMICO' . $semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'ESCUELA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $carrera->codigo, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$carrera->descripcion}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'ASIGNATURA', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $curso, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$cursoob->nombre}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'CICLO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$cursoob->ciclo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'CREDITOS', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$cursoob->creditos}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'DOCENTE', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $doc_id, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$full_name}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Ln(3);

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES');
        $aligns = array('C', 'C', 'L');
        $w = array(15, 30, 100);
        for ($i = 1; $i <= 20; $i++) {
            if ($prom_conf["tipo_" . $i] == 1) {
                array_push($header, $prom_conf["etq_" . $i]);
                array_push($w, 20);
                array_push($aligns, 'C');
            }
        }

        //echo "<pre>";print_r($header);exit();

        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header

        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths($w);

        $pdf->SetAligns($aligns);

        $crece = 0;

        foreach ($vista_notas as $key => $value) {
            $crece++;
            $init = array($crece, $value->alumno, $value->apellidos . " " . $value->nombres);

            for ($i = 1; $i <= 20; $i++) {
                if ($prom_conf["tipo_" . $i] == 1) {
                    if ($i < 10) {
                        $var = "n0" . $i;
                    } else {
                        $var = "n" . $i;
                    }

                    array_push($init, $value->$var);
                }
            }

            $pdf->RowNotaPr($init, 3);
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 0, 'L');

        $pdf->Ln(25);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(140);
        $pdf->Cell(51, 1, 'Huanta, ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

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
        $pdf->Output();



        exit;
    }

    //reporte de registro de notas
    function convierte($numero) {
        $numero = (int) $numero;
        if ($numero < 0) {
            $numero = abs($numero);
        }

        $array = array("0" => "CERO",
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
            "20" => "VEINTE");
        return $array[$numero];
    }

    public function reporteRegistroNotasAction($semestrex, $curso, $grupo) {
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

        $cursoob = Asignaturas::findFirstBycodigo($curso);
        //print $cursoob->nombre;exit();


        $carrera = Curriculas::findFirstBycodigo($cursoob->curricula);

        $conditions = " semestre = {$semestrex} AND asignatura = '{$curso}' AND grupo = {$grupo} AND docente = {$doc_id} ";



        $prom_conf = PromedioDetalle::findFirst([$conditions])->toArray();
        // las notas 

        $vista_notas = VNotas::find(
                        [
                            "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo<>2 AND tipo<>5 AND tipo <>9 AND grupo = $grupo ",
                            'order' => 'apellidos ASC',
                        ]
        );


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 25, 'REGISTRO DE NOTAS - SEMESTRE ACADÉMICO' . $semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'ESCUELA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $carrera->codigo, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$carrera->descripcion}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'ASIGNATURA', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $curso, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$cursoob->nombre}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'CICLO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$cursoob->ciclo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'CREDITOS', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$cursoob->creditos}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'DOCENTE', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $doc_id, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$full_name}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Ln(3);



        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES');
        $aligns = array('C', 'C', 'L');
        $w = array(9, 20, 60);
        for ($i = 1; $i <= 20; $i++) {
            if ($prom_conf["tipo_" . $i] != "") {
                array_push($header, $prom_conf["etq_" . $i]);
                array_push($w, 12);
                array_push($aligns, 'C');
            }
        }
        array_push($header, 'E.SUST');
        array_push($header, 'E.FINAL');
        array_push($header, 'LETRAS');
        array_push($aligns, 'C');
        array_push($aligns, 'C');
        array_push($aligns, 'L');
        array_push($w, 12);
        array_push($w, 12);
        array_push($w, 25);

        //echo "<pre>";print_r($header);exit();

        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header

        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths($w);

        $pdf->SetAligns($aligns);

        $crece = 0;
        foreach ($vista_notas as $key => $value) {
            $crece++;

            $init = array($crece, $value->alumno, $value->apellidos . " " . $value->nombres);

            for ($i = 1; $i <= 20; $i++) {
                if ($prom_conf["tipo_" . $i] != "") {
                    if ($i < 10) {
                        $var = "n0" . $i;
                    } else {
                        $var = "n" . $i;
                    }

                    array_push($init, $value->$var);
                }
            }

            array_push($init, $value->ea);
            array_push($init, $value->pf);
            array_push($init, $this->convierte((int) $value->pf));

            $pdf->RowNota($init);
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 0, 'L');

        $pdf->Ln(25);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(140);
        $pdf->Cell(51, 1, 'Huanta, ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

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
        $pdf->Output();



        exit;
    }

    //reporte de acta final
    public function reporteactafinalAction($semestrex, $curso, $grupo) {
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

        $cursoob = Asignaturas::findFirstBycodigo($curso);
        //print $cursoob->nombre;exit();


        $carrera = Curriculas::findFirstBycodigo($cursoob->curricula);


        // las notas 

        $vista_notas = VNotas::find(
                        [
                            "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo <>2 AND tipo <>5 AND tipo <>9 AND grupo = $grupo ",
                            'order' => 'apellidos ASC',
                        ]
        );


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 25, 'ACTA DE NOTAS - SEMESTRE ACADÉMICO' . $semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'ESCUELA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $carrera->codigo, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$carrera->descripcion}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'ASIGNATURA', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $curso, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$cursoob->nombre}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'CICLO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$cursoob->ciclo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'CREDITOS', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$cursoob->creditos}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'DOCENTE', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : " . $doc_id, 0, 0, 'L');
        $pdf->Cell(10, 5, "{$full_name}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Ln(3);

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', 'PROMEDIO FINAL', 'LETRAS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header
        $w = array(10, 25, 90, 25, 35);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths($w);

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L'));

        $crece = 0;
        foreach ($vista_notas as $key => $value) {
            $crece++;
            $pdf->RowNotap(array($crece, $value->alumno, $value->apellidos . " " . $value->nombres,
                $value->pf, $this->convierte((int) $value->pf)));
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 0, 'L');

        $pdf->Ln(25);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(140);
        $pdf->Cell(51, 1, 'Huanta, ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

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
        $pdf->Output();



        exit;
    }

    //reporte de encuestas
    public function reporteEncuestasAction($id) {
        $this->view->disable();

        //Insntanciamos ala variable de sesion codigfo del alumno
        $auth = $this->session->get('auth');
        $codigo_alumno = $auth["codigo"];

        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);
        $carrera = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        //print $semestre->codigo;exit();


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 120, 9, 70);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 12);
        // Title
        $pdf->Cell(190, 15, 'FORMATO 1. PARA ESTUDIANTES POR CURSO', 1, 0, 'L');
        // Line break
        $pdf->Ln(16);



        //Titulo 
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(190, 8, 'ENCUESTA DE EVALUACIÓN DE DESEMPEÑO DOCENTE POR ESTUDIANTES', 0, 0, 'C');
        $pdf->Ln(10);

        //Subtitulos
        $pdf->SetFont('Arial', '', 10);
        $pdf->Multicell(190, 5, 'Esta encuesta es ANÓNIMA Y CONFIDENCIAL tiene el objetivo de conocer la percepción del estudiante sobre el desempeño docente.' . "\n", 0, 'L', 0);

        $pdf->Multicell(190, 5, 'Al estudiante se le solicita ser justo, responsable y explícito en sus respuestas.' . "\n", 0, 'L', 0);
        $pdf->Ln(2);

        //Datos generales
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 5, 'DATOS GENERALES:', 0, 1, 'L');

        //Nombre del curso
        //Consultamos alumnos_encuestas con el codigo de alumnos_encuestas (datatables)
        $AlumnosEncuestas = AlumnosEncuestas::findFirstBycodigo($id);
        $asignatura = Asignaturas::findFirstBycodigo($AlumnosEncuestas->asignatura);


//        echo '<pre>';
//        print_r($asignatura->codigo);
//        exit();



        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'NOMBRE DEL CURSO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$asignatura->nombre}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'GRUPO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$AlumnosEncuestas->grupo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(50, 5, 'CICLO ACADEMICO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$asignatura->ciclo}", 0, 0, 'L');
        $pdf->Ln();



        //echo "<pre>";        print_r($AlumnosEncuestas->asignatura);exit();
        //echo "<pre>";        print_r($semestre->codigo);exit();
        //Nombre del docente
        $docente = $this->modelsManager->createQuery("SELECT
            Asignaturas.codigo,
            DocentesAsignaturas.semestre,
            DocentesAsignaturas.grupo,
            Docentes.nombres,
            Docentes.apellidop,
            Docentes.apellidom
            FROM
            Asignaturas
            INNER JOIN DocentesAsignaturas ON Asignaturas.codigo = DocentesAsignaturas.asignatura
            INNER JOIN Docentes ON DocentesAsignaturas.docente = Docentes.codigo
            WHERE
            Asignaturas.codigo = '{$AlumnosEncuestas->asignatura}' 
            AND DocentesAsignaturas.semestre = {$semestre->codigo}
            AND DocentesAsignaturas.grupo = {$AlumnosEncuestas->grupo}");
        $docente_result = $docente->execute();


        //




        $pdf->Cell(50, 5, 'NOMBRE DEL DOCENTE', 0, 0, 'L');
        foreach ($docente_result as $docente_query) {
            //echo "<pre>";
            //print_r($docente_query->nombres);
            $pdf->Cell(50, 5, ": $docente_query->nombres $docente_query->apellidop $docente_query->apellidom", 0, 0, 'L');
        }
        //exit();
        $pdf->Ln();





        $pdf->Cell(50, 5, 'CARRERA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$carrera->descripcion}", 0, 0, 'L');
        $pdf->Ln(6);


        $pdf->SetFont('Arial', '', 9);


        $pdf->Cell(160, 10, 'CRITERIOS DE EVALUACION', 1, 0, 'C', 0);
        $pdf->MultiCell(30, 5, 'RESPUESTA VALORATIVA', 1, 'C', 0);



        //Tipo de pregunnta
        $tipo_de_pregunta = $this->modelsManager->createBuilder()
                ->from('TipoPreguntas')
                ->columns('TipoPreguntas.codigo,
       TipoPreguntas.descripcion')
                ->where("TipoPreguntas.estado ='A' AND numero = 36 AND codigo <> 6")
                //->orderBy("Noticias.noticia_id DESC")
                //->orderBy("Noticias.fecha_publicacion DESC")
                ->getQuery()
                ->execute();
        $this->view->tipo_preguntas = $tipo_de_pregunta;


        //Pregunta
        $encuestas_model = $this->modelsManager->createBuilder()
                ->from('Encuestas')
                ->columns('Encuestas.tipo,
                    Encuestas.descripcion,
                    TipoPreguntas.codigo,
                    TipoPreguntas.descripcion AS tipo_pregunta,
                    EncuestasPreguntas.codigo AS codigo_pregunta,
                    EncuestasPreguntas.descripcion AS pregunta,
                    AlumnosEncuestasRespuestas.alumno_encuesta,
                    AlumnosEncuestasRespuestas.valor')
                ->join('EncuestasPreguntas', 'EncuestasPreguntas.encuesta = Encuestas.codigo')
                ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.tipo_pregunta')
                ->join('AlumnosEncuestasRespuestas', 'AlumnosEncuestasRespuestas.encuesta_pregunta = EncuestasPreguntas.codigo')
                ->where("Encuestas.tipo = 1 AND TipoPreguntas.numero = 36 AND AlumnosEncuestasRespuestas.alumno_encuesta = $AlumnosEncuestas->codigo")
                //->limit(6)
                //->orderBy('Libros.libro_id')
                ->getQuery()
                ->execute();
        $this->view->preguntas = $encuestas_model;

//        foreach ($encuestas_model as $docente_query) {
//            echo "<pre>";
//            print_r($docente_query->alumno_encuesta."-".$docente_query->codigo_pregunta."-".$docente_query->pregunta."-".$docente_query->valor);
//        }
//        exit();



        foreach ($tipo_de_pregunta as $tipo_de_pregunta_query) {
            //echo "<pre>";
            //print_r($docente_query->nombres);
            $pdf->Cell(190, 5, "$tipo_de_pregunta_query->descripcion", 1, 1, 'C');
            //Tipo de pregunta
            $codigo_tipo_pregunta = $tipo_de_pregunta_query->codigo;

            foreach ($encuestas_model as $encuestas_model_query) {
                if ($encuestas_model_query->codigo == $codigo_tipo_pregunta) {

                    //Pregunta
                    $pdf->Cell(160, 5, "$encuestas_model_query->pregunta", 1, 0, 'L');
                    $pdf->Cell(30, 5, "$encuestas_model_query->valor", 1, 1, 'C');
                }
            }


            //exit();
        }


        $pdf->Ln(10);

        $pdf->Ln(5);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();


        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
        $pdf->Ln(5);
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 9);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        //  $pdf->MultiCell(190, 15, 'PROLONG. LIBERTAD #1220-1228 - YURIMAGUAS - LORETO - PERU \r '
        //       . ':v',1, 'C', 0, false);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $h = 12;
        $w = 190;
        //Draw the border
        $pdf->Rect($x, $y, $w, $h);
        //Print the text
        $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
        $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');
        //Put the position to the right of the cell
        $pdf->SetXY($x + $w, $y);
        $pdf->Ln(5);
        $pdf->Ln(10);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');

        $pdf->Output();
        exit;
    }

    //reporte admision registro
    public function reporteAdmisionRegistroAction($id = null) {
        $this->view->disable();

        //postulante
        //$Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if ($id != null) {
            $Postulante = Publico::findFirstBycodigo((int) $id);
            $this->view->id = $id;
        } else {
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        }


        //formateamos codigo
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
        //fin
        //admision

        $admision_activo = Admision::findFirst("activo = 'M'");

        $postulante = $Postulante->codigo;
        $admision_m = $admision_activo->codigo;

        $AdmisionPostulantes = AdmisionPostulantes::findFirst(
                        [
                            "postulante = $postulante AND admision = $admision_m"
                        ]
        );
        //fin
        //concepto
        $admision_concepto = $AdmisionPostulantes->concepto;
        $concepto = Conceptos::findFirstBycodigo("$admision_concepto");
        //fin
        //modalidad
        $admision_modalidad = $AdmisionPostulantes->modalidad;

        //print($admision_modalidad);
        //exit();

        $modalidad = Modalidad::findFirst(
                        [
                            "estado = 'A' AND numero = 21 AND codigo = $admision_modalidad"
                        ]
        );

        //fin
        //carrea1
        $admision_carrera1 = $AdmisionPostulantes->carrera1;
        $carrera1 = Carreras::findFirst(
                        [
                            "estado = 'A' AND codigo = '$admision_carrera1'"
                        ]
        );
        //fin
        //carrea2
        $admision_carrera2 = $AdmisionPostulantes->carrera2;
        $carrera2 = Carreras::findFirst(
                        [
                            "estado = 'A' AND codigo = '$admision_carrera2'"
                        ]
        );
        //fin




        $pdf = new PDF();
        //para bordees
        $pdf = new PDF_Dash();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 9, '  FICHA DE INSCRIPCIÓN - DECLARACIÓN JURADA', 1, 0, 'L');
        // Line break
        $pdf->Ln(12);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 5, 'DECLARO BAJO JURAMENTO QUE:', 0, 1, 'L');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'Yo: ' . $Postulante->apellidop . ' ' . $Postulante->apellidom . ' ' . $Postulante->nombres, 0, 0, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(140, 5, 'CÓDIGO:  ' . $new_codigo, 0, 1, 'R');

        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(190, 5, 'Dejo expresa constancia, '
                . 'conocer de forma detallada todas las disposiciones y sanciones que establece el '
                . 'capitulo VIII del reglamento del proceso de admisión ' . $admision_activo->anio . '.', 0, 'J');
        $pdf->Ln(2);
        $pdf->Cell(50, 5, 'Asi mismo declaro que:', 0, 1, 'L');
        $pdf->Cell(8);
        $pdf->MultiCell(182, 5, '- La información consignada en el presente documento es verdadera y de mi entera responsabilidad.', 0, 'J');
        $pdf->Cell(8);
        $pdf->MultiCell(182, 5, '- No registro antecedentes policiales ni penales.', 0, 'J');
        $pdf->Cell(8);
        $pdf->MultiCell(182, 5, '- En caso de alcanzar una vacante, asumo la responsabilidad, que de no cumplir con la entrega de documentacion', 0, 'J');
        $pdf->Cell(6);
        $pdf->MultiCell(183, 5, 'original y los compromisos asumidos en el plazo que la Comisión Ejecutiva de Admisión establezca,  mi  vacante', 0, 'R');
        $pdf->Cell(10);
        $pdf->MultiCell(180, 5, 'será ANULADA.', 0, 'L');

        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 9, '  DATOS DEL POSTULANTE', 1, 1, 'L');
        //$pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'DNI', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $Postulante->nro_doc", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'APELLIDOS Y NOMBRES', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $Postulante->apellidop $Postulante->apellidom $Postulante->nombres", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'MODALIDAD', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $modalidad->nombres", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'PROGRAMA DE ESTUDIOS 01', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $carrera1->descripcion", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'PROGRAMA DE ESTUDIOS 02', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $carrera2->descripcion", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'PROCEDENCIA', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $Postulante->colegio_nombre", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'NRO. RECIBO', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $AdmisionPostulantes->recibo", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'CONCEPTO', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": $concepto->descripcion", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'MONTO', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(135, 5, ": S/. $AdmisionPostulantes->monto", 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'LUGAR DE EXAMEN', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        //$this->config->global->xDireccionIns;
        $pdf->Cell(135, 5, ": " . $this->config->global->xDireccionIns, 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'FECHA', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        if ($AdmisionPostulantes->modalidad == 1) {

            $fecha_explode_1 = explode(' ', $admision_activo->fecha_hora_ordinario);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];

            $date = new DateTime($admision_activo->fecha_hora_ordinario);
            $hora = $date->format("g") . '.' . $date->format("i") . ' ' . $date->format("A");
        } else {

            $fecha_explode_1 = explode(' ', $admision_activo->fecha_hora_extraordinario);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];


            $date = new DateTime($admision_activo->fecha_hora_extraordinario);
            $hora = $date->format("g") . '.' . $date->format("i") . ' ' . $date->format("A");
        }
        //$pdf->Cell(135, 5, ": " . $this->config->global->xfechaAdm . ' ' . $this->config->global->xHoraAdm, 1, 1, 'L');
        $pdf->Cell(135, 5, ": " . $fecha_resultado, 1, 1, 'L');



        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 5, 'HORA', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        //$this->config->global->xDireccionIns;
        //$fecha_explode_1[1]


        $pdf->Cell(135, 5, ": " . $hora, 1, 1, 'L');
        $pdf->Ln(1);



        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 9, '  FOTOCHEK', 1, 1, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, 'INSTRUCCIONES DE USO DEL FOTOCHEK', 1, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(95, 4, 'Felicidades, has completado tu inscripción satisfactoriamente,'
                . ' hemos elaborado tu fotochek para que puedas identificarte el dia del examen, '
                . ' por favor sigue las siguientes instrucciones:', 0, 'J');
        $pdf->Ln(3);
        $pdf->MultiCell(95, 4, '1. Recortar cuidadosamente el recuadro de lineas puenteadas de la derecha.', 0, 'J');
        $pdf->Ln(2);
        $pdf->MultiCell(95, 4, '2. Colocar la parte recortada dentro de un portafochek con las mismas dimensiones.', 0, 'J');
        $pdf->Ln(2);
        $pdf->MultiCell(95, 4, '3. El presente fotochek debe ser portado por cada postulante el dia del examen,'
                . ' pendiendo del cuello obligatoriamente.', 0, 'J');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(3);
        $pdf->Cell(95, 5, 'NOTA:', 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(95, 4, 'El postulante solo usará el área de fotochek para su idetnificación, '
                . 'la Declaración Jurada incorporada en este documento quedará en custodia de cada postulante y no debe ser'
                . ' portada el dia del examen', 0, 'J');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, 'INSTRUCCIONES DE IDENTIFICACIÓN', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(2);
        $pdf->MultiCell(95, 4, 'Para que el postulante pueda rendir el examen, debe identificarse obligatoriamente con'
                . ' los los figuientes documentos:', 0, 'J');
        $pdf->Cell(5);
        $pdf->Cell(90, 5, '- DNI vigente', 0, 1, 'L');
        $pdf->Cell(5);
        $pdf->Cell(90, 5, '- Fotochek', 0, 0, 'L');



//$pdf->SetLineWidth(0.1);
//$pdf->SetDash(5,5); //5mm on, 5mm off
//$pdf->Line(20,20,190,20);
//$pdf->SetLineWidth(0.5);
//$pdf->Line(20,25,190,25);

        $pdf->SetLineWidth(0.5);
        $pdf->SetDash(2, 2); //4mm on, 2mm off
        $pdf->Rect(110, 155, 90, 130);
        $pdf->SetDash(); //restores no dash
//$pdf->Line(20,55,190,55);
//
        $pdf->Image('webpage/assets/img/escudo.png', 109, 156, 12);
        $pdf->SetXY(122, 156);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 5, $this->config->global->xNombreIns, 0, 0, 'L');
        $pdf->SetXY(122, 160);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 5, 'COMISIÓN EJECUTIVA DE ADMISIÓN 2020', 0, 0, 'L');
        $pdf->Image('webpage/assets/img/logo.png', 174, 156, 25);

        $pdf->SetXY(130, 170);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(50, 5, 'POSTULANTE:', 0, 0, 'C');
        $pdf->SetXY(130, 175);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(50, 5, "$Postulante->apellidop $Postulante->apellidom $Postulante->nombres", 0, 0, 'C');

        $pdf->SetXY(140, 180);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(35, 35, "", 1, 0, 'C');

        $pdf->SetXY(115, 215);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 5, 'CÓDIGO', 0, 0, 'L');

        $pdf->SetXY(135, 215);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 5, ': ' . $new_codigo, 0, 0, 'L');


        $pdf->SetXY(115, 220);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 5, 'DNI', 0, 0, 'L');

        $pdf->SetXY(135, 220);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 5, ': ' . $Postulante->nro_doc, 0, 0, 'L');

        $pdf->SetXY(115, 225);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(20, 5, 'MODALIDAD', 0, 0, 'L');

        $pdf->SetXY(135, 225);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(50, 5, ': ' . $modalidad->descripcion, 0, 0, 'L');

        $pdf->SetXY(130, 230);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(40, 5, $this->config->global->xCarreraIns, 0, 0, 'C');

        $pdf->SetXY(120, 235);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(60, 5, $carrera1->descripcion, 0, 0, 'C');


        $pdf->SetXY(125, 268);
        $pdf->Cell(20, 5, '______________________________', 0, 0, 'C');
        $pdf->SetXY(125, 271);
        $pdf->Cell(20, 5, 'FIRMA DEL POSTULANTE', 0, 0, 'C');


        $pdf->SetXY(170, 245);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(25, 26, '', 1, 0, 'C');

        $pdf->SetXY(172, 271);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 5, 'HUELLA DACTILAR', 0, 0, 'C');

//        $pdf->Cell(10);
//        $pdf->Cell(180, 5, '- La información consignada en el presente documento es verdadera y de mi entera responsabilidad.', 0, 1, 'L');
//        $pdf->Cell(10);
//        $pdf->Cell(180, 5, '- No registro antecedentes policiales ni penales.', 0, 1, 'L');
//        $pdf->Cell(10);
//        $pdf->Cell(180, 5, '- En caso de alcanzar una vacante, asumo la responsabilidad, que de no cumplir con la entrega de '
//                . 'documentacion', 0, 1, 'L');
//        $pdf->Cell(12);
//        $pdf->Cell(180, 5, 'original y los compromisos asumidos en el plazo que la Comisión Ejecutiva de Admisión establezca, mi '
//                . 'vacante será ANULADA', 0, 0, 'L');




        $pdf->Output();
        exit;
    }

    //reporte ficha socioeconomica
    public function reporteFichaSocioeconomicaAction($sem, $alumno_id) {
        $this->view->disable();

        //$auth = $this->session->get('auth');

        $codigo_alumno = $alumno_id;

//        echo "<pre>";
//        print_r($codigo_alumno);
//        exit();

        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);
        $semestre = SemestreAlumnos::findFirstBycodigo($sem);
//        echo "<pre>";
//        print_r($semestre->descripcion);
//        exit();
        //$alumnos_ficha = Alumnosficha::findFirst("semestre = {$semestre->codigo} AND alumno='{$codigo_alumno}' ");



        if (empty(AlumnosFicha::findFirst("alumno='{$codigo_alumno}' AND semestre = {$semestre->codigo} "))) {
            echo "<pre>";
            print_r("No se registraron datos en el tap ficha " . $sem);
            exit();
        } else {
            $alumnos_ficha = AlumnosFicha::findFirst("alumno='{$codigo_alumno}' AND semestre = {$semestre->codigo} ");
        }




//        print $alumnos_ficha->alumno;
//        exit();
//        foreach ($alumnos as $khi) {
//
//            echo "<pre>";
//            print_r($khi->alumno . '<br>');
//            exit();
//        }




        $carrea = Carreras::findFirstBycodigo($dato_alumno->carrera);

//        $semestre = Semestres::findFirst(
//                        [
//                            "estado = 'M'",
//                            'order' => 'codigo DESC',
//                            'limit' => 1,
//                        ]
//        );
        //print $semestre->codigo;exit();


        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 145, 11, 50);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 15, 'FICHA  SOCIOECONÓMICA: N°' . $dato_alumno->codigo . '-' . $semestre->descripcion, 1, 0, 'L');
        $pdf->Ln(15);

        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(190, 5, "NOTA: La información que se consigne en este cuestionario es de carácter reservado y tiene el valor de Declaración Jurada, por lo que se requiere que los datos que se proporcionen sean verídicos. ", 1, "J", 0);
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, 'I. DATOS GENERALES DEL ESTUDIANTE: ', 1, 0, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        //Nombres y apellidos
        //$pdf->MultiCell(168, 5, 'a) Apellidos y Nombres: ' . $dato_alumno->apellidop . ' ' . $dato_alumno->apellidom . ' ' . $dato_alumno->nombres, 1, 'L', 0);
        $pdf->Cell(162, 5, 'a) Apellidos y Nombres: ' . $dato_alumno->apellidop . ' ' . $dato_alumno->apellidom . ' ' . $dato_alumno->nombres, 1, 0, 'L');

        //Edad
        if (!empty($alumnos_ficha->edad)) {
            $pdf->Cell(28, 5, 'b) Edad:' . $alumnos_ficha->edad . ' años', 1, 1, 'L');
        } else {

//            echo "<pre>";
//            print_r("oks");
//            exit();

            $alumnos_ficha_edad = "";

            $pdf->Cell(28, 5, 'b) Edad:' . $alumnos_ficha_edad . ' años', 1, 1, 'L');
        }






        //DNI
        $pdf->Cell(40, 5, 'c) Nº de DNI: ' . $dato_alumno->nro_doc, 1, 0, 'L');
        //Sexo
        $sexo_alumno = Sexo::findFirst("numero = 3 AND codigo='{$dato_alumno->sexo}'");
        $pdf->Cell(40, 5, 'd) Sexo: ' . $sexo_alumno->nombres, 1, 0, 'L');

        //fecha de nacimiento
        $fecha_nacimiento_alumno = explode(" ", $dato_alumno->fecha_nacimiento);
        $result_fecha_nacimiento = explode("-", $fecha_nacimiento_alumno[0]);
        $result_f_n = $result_fecha_nacimiento[2] . "-" . $result_fecha_nacimiento[1] . "-" . $result_fecha_nacimiento[0];
        $pdf->Cell(60, 5, 'e) Fecha de Nacimiento:' . $result_f_n, 1, 0, 'L');

        //Talla

        if (!empty($alumnos_ficha->talla)) {
            $pdf->Cell(22, 5, 'f) Talla: ' . $alumnos_ficha->talla, 1, 0, 'L');
        } else {
            $alumnos_ficha_talla = "";
            $pdf->Cell(22, 5, 'f) Talla: ' . $alumnos_ficha_talla, 1, 0, 'L');
        }


        //Peso
        if (!empty($alumnos_ficha->peso)) {
            $pdf->Cell(28, 5, 'g) Peso: ' . $alumnos_ficha->peso . ' kg', 1, 1, 'L');
        } else {
            $alumnos_ficha_peso = "";
            $pdf->Cell(28, 5, 'f) Peso: ' . $alumnos_ficha_peso, 1, 1, 'L');
        }



        //Lugar de Procedencia

        if ($dato_alumno->region1 AND $dato_alumno->provincia1 AND $dato_alumno->region1 != null) {
            $region1 = Regiones::findFirst("id='{$dato_alumno->region1}'");
            $provincia1 = Provincias::findFirst("region='{$dato_alumno->region1}' AND provincia='{$dato_alumno->provincia1}'");
            $distrito1 = Distritos::findFirst("region='{$dato_alumno->region1}' AND provincia='{$dato_alumno->provincia1}' AND distrito='{$dato_alumno->distrito1}'");

            $pdf->Cell(190, 5, 'h) Lugar de Procedencia: ' . $dato_alumno->region1 . ":" . $region1->descripcion . " - " . $dato_alumno->provincia1 . ":" . $provincia1->descripcion . " - " . $dato_alumno->distrito1 . ":" . $distrito1->descripcion, 1, 1, 'L');
        } else {

//                    echo "<pre>";
//        print_r("HolaF");
//        exit();

            $region1_vacio = "";
            $provincia1_vacio = "";
            $distrito1_vacio = "";

            $pdf->Cell(190, 5, 'h) Lugar de Procedencia: ' . $dato_alumno->region1 . ":" . $region1_vacio . " - " . $dato_alumno->provincia1 . ":" . $provincia1_vacio . " - " . $dato_alumno->distrito1 . ":" . $distrito1_vacio, 1, 1, 'L');
        }


//        echo "<pre>";
//        print_r($provincia1->descripcion);
//        exit();
//        
        //Direccion actual
        $pdf->Cell(190, 5, 'i) Dirección Actual: ' . $dato_alumno->direccion, 1, 1, 'L');


        //Lugar de procedencia

        if ($dato_alumno->region AND $dato_alumno->provincia AND $dato_alumno->region != null) {


            $region = Regiones::findFirst("id='{$dato_alumno->region}'");
            $provincia = Provincias::findFirst("region='{$dato_alumno->region}' AND provincia='{$dato_alumno->provincia}'");
            $distrito = Distritos::findFirst("region='{$dato_alumno->region}' AND provincia='{$dato_alumno->provincia}' AND distrito='{$dato_alumno->distrito}'");

            //Distrito

            $pdf->Cell(65, 5, 'j) Distrito: ' . $distrito->descripcion, 1, 0, 'L');

            //Provincia
            $pdf->Cell(68, 5, 'k) Provincia: ' . $provincia->descripcion, 1, 0, 'L');

            //Departamento
            $pdf->Cell(57, 5, 'l) Departamento: ' . $region->descripcion, 1, 1, 'L');
        } else {
            $region_vacio = "";
            $provincia_vacio = "";
            $distrito_vacio = "";




            //Distrito

            $pdf->Cell(65, 5, 'j) Distrito: ' . $distrito_vacio, 1, 0, 'L');

            //Provincia
            $pdf->Cell(68, 5, 'k) Provincia: ' . $provincia_vacio, 1, 0, 'L');

            //Departamento
            $pdf->Cell(57, 5, 'l) Departamento: ' . $region_vacio, 1, 1, 'L');
        }




        //Estado civil
        if (!empty($alumnos_ficha->estado_civil)) {
            $estado_civil_alumno = EstadoCivil::findFirst("numero = 26 AND codigo={$alumnos_ficha->estado_civil}");
            $pdf->Cell(65, 5, 'm) Estado Civil: ' . $estado_civil_alumno->nombres, 1, 0, 'L');
        } else {
            $pdf->Cell(65, 5, 'm) Estado Civil: ', 1, 0, 'L');
        }




        //Email and facebook
        $pdf->Cell(125, 5, 'n) Email: ' . $dato_alumno->email, 1, 1, 'L');

        //Tipo de colegio
        $colegio_alumno = $dato_alumno->colegio_publico;
        if ($colegio_alumno == '1') {
            $pdf->Cell(65, 5, 'o)Tipo de colegio que estudió: PÚBLICO', 1, 0, 'L');
        } else {
            $pdf->Cell(65, 5, 'o) Tipo de colegio que estudió:PRIVADO', 1, 0, 'L');
        }

        //Nombre de Colegio
        $pdf->Cell(125, 5, 'p) Nombre del Colegio: ' . $dato_alumno->colegio_nombre, 1, 1, 'L');

        //Numero de celular
        $pdf->Cell(65, 5, 'q) N° Cel./ Telef. del estud.: ' . $dato_alumno->celular, 1, 0, 'L');



        //Seguro
        $seguro_alumno = Seguro::findFirst("numero = 4 AND codigo='{$dato_alumno->seguro}'");
//        echo "<pre>";
//        print_r($seguro_alumno->nombres);
//        exit();
        $pdf->Cell(68, 5, 'r) Seguro de Salud: ' . $seguro_alumno->nombres, 1, 0, 'L');

        //Trabaja
        if ($dato_alumno->sitrabaja == null OR $dato_alumno->sitrabaja == 0) {
            $pdf->Cell(57, 5, 's) Trabaja: NO', 1, 1, 'L');
        } else {
            $pdf->Cell(57, 5, 's) Trabaja: SI', 1, 1, 'L');
        }

        //Lugar donde trabaja
        $pdf->Cell(190, 5, 't) Lugar/Inst. donde labora:' . $dato_alumno->sitrabaja_nombre, 1, 1, 'L');

        //Padece discapacidad

        if ($dato_alumno->discapacitado == null OR $dato_alumno->discapacitado == 0) {
            $pdf->Cell(40, 5, 'u) Discapacidad: NO', 1, 0, 'L');
        } else {
            $pdf->Cell(40, 5, 'u) Discapacidad: SI', 1, 0, 'L');
        }

        //Nombre discapacidad
        $pdf->Cell(120, 5, 'v) Nombre Discapacidad: ' . $dato_alumno->discapacitado_nombre, 1, 0, 'L');
        $pdf->Cell(30, 5, 'w) N° de hijos: ' . $alumnos_ficha->nro_hijos, 1, 1, 'L');
        //$pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, 'II. COMPOSICIÓN FAMILIAR', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);


        //Tipo de familia
        if ($alumnos_ficha->composicion == 1) {
            $pdf->Cell(190, 5, 'Tipo de Familia: Nuclear/Completa ( X )      Incompleta (   )       Extendida (   )        Reconstituida (   )' . $dato_alumno->discapacitado_nombre, 1, 1, 'L');
        } elseif ($alumnos_ficha->composicion == 2) {
            $pdf->Cell(190, 5, 'Tipo de Familia: Nuclear/Completa (   )       Incompleta ( X )      Extendida (   )        Reconstituida (   )' . $dato_alumno->discapacitado_nombre, 1, 1, 'L');
        } elseif ($alumnos_ficha->composicion == 3) {
            $pdf->Cell(190, 5, 'Tipo de Familia: Nuclear/Completa (   )       Incompleta (   )      Extendida ( X )        Reconstituida (   )' . $dato_alumno->discapacitado_nombre, 1, 1, 'L');
        } elseif ($alumnos_ficha->composicion == 4) {
            $pdf->Cell(190, 5, 'Tipo de Familia: Nuclear/Completa (   )       Incompleta (   )      Extendida (   )        Reconstituida ( X )' . $dato_alumno->discapacitado_nombre, 1, 1, 'L');
        }


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, '1. Integrantes de la familia:' . $dato_alumno->discapacitado_nombre, 1, 1, 'L');



//Tabla padres
        $header = array('Parentesco', 'Apellidos y Nombres', 'Sexo', 'Edad', 'Estado Civil', 'Grado Instruccion', 'Ocupacion', 'Ingresos');
        //$pdf->Ln(5);
        //$pdf->SetFillColor(50, 50, 55);
        $pdf->SetFillColor(255, 255, 255);
        //$pdf->SetTextColor(255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(22, 50, 10, 10, 20, 25, 30, 23);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 8);
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(22, 50, 10, 10, 20, 25, 30, 23));

        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'L', 'C'));

        //$codestr = $semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        //Native query
        $sql_consulta = $this->modelsManager->createQuery("SELECT AlumnosFamiliares.codigo, 
                parentesco.nombres AS parentesco, AlumnosFamiliares.apellido_paterno, 
                AlumnosFamiliares.apellido_materno, AlumnosFamiliares.nombres, sexo.descripcion AS sexo, 
                AlumnosFamiliares.edad, estado_civil.nombres AS estado_civil, grado_instruccion.nombres AS grado_instruccion,
                AlumnosFamiliares.ocupacion,AlumnosFamiliares.ingresos
                FROM AlumnosFamiliares
                INNER JOIN Parentescos parentesco ON AlumnosFamiliares.parentesco = parentesco.codigo
                INNER JOIN Sexoalumnos sexo ON AlumnosFamiliares.sexo = sexo.codigo
                INNER JOIN EstadoCivilFamiliares estado_civil ON AlumnosFamiliares.estado_civil = estado_civil.codigo
                INNER JOIN GradoInstruccionFamiliares grado_instruccion ON AlumnosFamiliares.grado_instruccion = grado_instruccion.codigo
                WHERE AlumnosFamiliares.alumno = '" . $codigo_alumno . "'
                AND parentesco.numero = 27 AND sexo.numero = 3 
                AND estado_civil.numero = 26 AND grado_instruccion.numero = 28 AND AlumnosFamiliares.estado = 'A'
                ORDER BY AlumnosFamiliares.codigo ASC");
        $ficha_alumno = $sql_consulta->execute();

//        foreach ($notas_curso as $khi) {
//            echo "<pre>";
//            print_r($khi->parentesco . '<br>' . $khi->sexo . '<br>' . $khi->estado_civil . '<br>' . $khi->grado_instruccion);
//            exit();
//        }
        //$num_cursos = count($ficha_alumno);
        //$sum_creditos = 0;
        foreach ($ficha_alumno as $key => $value) {
            //$sum_creditos = $sum_creditos + (int) $value->creditos;
            $pdf->row(array($value->parentesco,
                $value->apellido_paterno . ' ' . $value->apellido_materno . ' ' . $value->nombres,
                $value->sexo, $value->edad, $value->estado_civil, $value->grado_instruccion,
                $value->ocupacion, $value->ingresos));
        }
        //$pdf->row(array("xsa","asd","asd","asd","<d"));

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();
        $pdf->Cell(190, 5, 'La información señalada en los cuadros  serán sustentadas con las copias de DNIs respectivos. ', 1, 1, 'L');

        $pdf->SetFont('Arial', '', 10);
        //Observaciones
        $pdf->Cell(190, 5, 'Observaciones: ' . $alumnos_ficha->observaciones, 1, 1, 'L');

        //Aspecto economico
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, 'III. ASPECTO SOCIOECONÓMICO DEL ESTUDIANTE:', 1, 1, 'L');
        //Situacion de dependencia del estudiante
        $pdf->Cell(190, 5, '3.1. Situación de Dependencia del Estudiante ', 1, 1, 'L');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(38, 5, 'Papá S/. ' . $alumnos_ficha->ingresos_papa, 1, 0, 'L');
        $pdf->Cell(38, 5, 'Mamá S/. ' . $alumnos_ficha->ingresos_mama, 1, 0, 'L');
        $pdf->Cell(38, 5, 'Hrnos/as. S/. ' . $alumnos_ficha->ingresos_hnos, 1, 0, 'L');
        $pdf->Cell(38, 5, 'Personal S/. ' . $alumnos_ficha->ingresos_personal, 1, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(38, 5, 'Total S/. ' . ($alumnos_ficha->ingresos_papa + $alumnos_ficha->ingresos_mama +
                $alumnos_ficha->ingresos_hnos + $alumnos_ficha->ingresos_personal), 1, 1, 'L');

        //Egresos
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, 'IV. EGRESO MENSUAL DEL ESTUDIANTE:', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(38, 5, 'Vivienda S/. ' . $alumnos_ficha->egresos_vivienda, 1, 0, 'L');
        $pdf->Cell(38, 5, 'Alimentación S/. ' . $alumnos_ficha->egresos_alimentacion, 1, 0, 'L');
        $pdf->Cell(36, 5, 'Luz S/. ' . $alumnos_ficha->egresos_luz, 1, 0, 'L');
        $pdf->Cell(48, 5, 'Material de estudio S/. ' . $alumnos_ficha->egresos_materiales_estudio, 1, 0, 'L');
        $pdf->Cell(30, 5, 'Agua S/. ' . $alumnos_ficha->egresos_agua, 1, 1, 'L');
        $pdf->Cell(25, 5, 'Gas S/. ' . $alumnos_ficha->egresos_gas, 1, 0, 'L');
        $pdf->Cell(28, 5, 'Internet S/.' . $alumnos_ficha->egresos_internet, 1, 0, 'L');
        $pdf->Cell(28, 5, 'Pasaje S/.' . $alumnos_ficha->egresos_pasajes, 1, 0, 'L');
        $pdf->Cell(31, 5, 'Tv Cable S/.' . $alumnos_ficha->egresos_cable_tv, 1, 0, 'L');
        $pdf->Cell(48, 5, 'Material de Aseo S/.' . $alumnos_ficha->egresos_materiales_aseo, 1, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, 'Total S/.' . ($alumnos_ficha->egresos_vivienda + $alumnos_ficha->egresos_alimentacion +
                $alumnos_ficha->egresos_luz + $alumnos_ficha->egresos_materiales_estudio + $alumnos_ficha->egresos_agua +
                $alumnos_ficha->egresos_gas + $alumnos_ficha->egresos_internet + $alumnos_ficha->egresos_pasajes +
                $alumnos_ficha->egresos_cable_tv + $alumnos_ficha->egresos_materiales_aseo), 1, 1, 'L');


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, 'V. CONDICIÓN DE LA VIVIENDA:', 1, 1, 'L');
        $pdf->Cell(190, 5, '5.1. Condición de Vivienda del Estudiante:', 1, 1, 'L');

        //Vivivienda
        $pdf->SetFont('Arial', '', 10);

        if ($alumnos_ficha->vivienda == null) {

            $vivienda = "";
            $pdf->Cell(69, 5, 'Su Vivienda es: ' . $vivienda, 1, 0, 'L');
        } else {
            $vivienda = Viviendas::findFirst("numero = 29 AND codigo={$alumnos_ficha->vivienda}");
            $pdf->Cell(69, 5, 'Su Vivienda es: ' . $vivienda->nombres, 1, 0, 'L');
        }





        //Tipo de vivienda
        if ($alumnos_ficha->vivienda_tipo == null) {
            $pdf->Cell(121, 5, 'Tipo de Vivienda: ', 1, 1, 'L');
        } else {
            $tipo_vivienda = TipoViviendas::findFirst("numero = 30 AND codigo={$alumnos_ficha->vivienda_tipo}");
            $pdf->Cell(121, 5, 'Tipo de Vivienda: ' . $tipo_vivienda->nombres, 1, 1, 'L');
        }




        //Vivienda material
        if ($alumnos_ficha->vivienda_material == null) {
            $pdf->Cell(69, 5, 'Material de la vivienda: ', 1, 0, 'L');
        } else {
            $material_vivienda = Materialviviendas::findFirst("numero = 31 AND codigo={$alumnos_ficha->vivienda_material}");
            $pdf->Cell(69, 5, 'Material de la vivienda: ' . $material_vivienda->nombres, 1, 0, 'L');
        }


        //Techo material
        if ($alumnos_ficha->techo_material == null) {

            $techo_material = "";
            $pdf->Cell(121, 5, 'Material techo vivienda: ' . $techo_material, 1, 1, 'L');
        } else {
            $techo_material = MaterialTechoViviendas::findFirst("numero = 32 AND codigo={$alumnos_ficha->techo_material}");
            $pdf->Cell(121, 5, 'Material techo vivienda: ' . $techo_material->nombres, 1, 1, 'L');
        }


//                echo "<pre>";
//        print_r($alumnos_ficha->luz);
//        exit();
//        if ($alumnos_ficha->luz == '1' OR $alumnos_ficha->agua == '1' OR $alumnos_ficha->desague == '1' OR $alumnos_ficha->telefono == '1' OR $alumnos_ficha->cable_tv == '1' OR $alumnos_ficha->internet == '1') {
//            $pdf->Cell(115, 5, 'Servicio de la vivienda: ' . $alumnos_ficha->luz = 'Luz ' . $alumnos_ficha->agua = '- Agua' .
//                    $alumnos_ficha->desague = ' - Desague' . $alumnos_ficha->cable_tv = ' - Cable tv' . $alumnos_ficha->internet = ' - Internet', 1, 1, 'L');
//        }


        if ($alumnos_ficha->luz == '1') {

            $luz_ficha = 'Luz';
        } else {

            $luz_ficha = '';
        }

        if ($alumnos_ficha->agua == '1') {
            $agua_ficha = ' - Agua';
        } else {
            $agua_ficha = '';
        }

        if ($alumnos_ficha->desague == '1') {
            $desague_ficha = ' - Desagüe';
        } else {
            $desague_ficha = '';
        }

        if ($alumnos_ficha->telefono == '1') {
            $telefono_ficha = ' - Teléfono';
        } else {
            $telefono_ficha = '';
        }

        if ($alumnos_ficha->cable_tv == '1') {
            $cable_tv_ficha = ' - Clave tv';
        } else {
            $cable_tv_ficha = '';
        }

        if ($alumnos_ficha->internet == '1') {
            $internet_ficha = ' - Internet';
        } else {
            $internet_ficha = '';
        }



        $pdf->Cell(69, 5, 'Nº Cuartos (sin incluir baño y cocina): ' . $alumnos_ficha->nro_cuartos, 1, 0, 'L');
        $pdf->Cell(121, 5, 'Servicio de la vivienda: ' . $luz_ficha . $agua_ficha .
                $desague_ficha . $telefono_ficha . $cable_tv_ficha . $internet_ficha, 1, 1, 'L');

        $pdf->Cell(190, 5, '*La información proporcionada en el cuadro 4 será validada con la visita domiciliaria respectiva.', 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(105, 5, '5.2. Número de personas que ocupan la habitación o cuarto:', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(85, 5, $alumnos_ficha->nro_personas_cuarto, 1, 1, 'L');


        if (!empty(AlumnosFamiliares::findFirst("alumno='{$dato_alumno->codigo}' AND es_principal='1'"))) {
//            echo "<pre>";
//            print_r("lenno");
//            exit();



            $es_principal = AlumnosFamiliares::findFirst("alumno='{$dato_alumno->codigo}' AND es_principal='1'");


//        echo "<pre>";
//        print_r($es_principal->casa);
//        exit();


            if ($es_principal->casa == '1') {

                $casa = 'Casa';
            } else {

                $casa = '';
            }

            if ($es_principal->camion == '1') {

                $camion = ' - Camion';
            } else {

                $camion = '';
            }

            if ($es_principal->auto == '1') {

                $auto = ' - Auto';
            } else {

                $auto = '';
            }

            if ($es_principal->mototaxi == '1') {

                $mototaxi = ' - Mototaxi';
            } else {

                $mototaxi = '';
            }

            if ($es_principal->predios == '1') {

                $predios = ' - Predios';
            } else {

                $predios = '';
            }

            if ($es_principal->tv == '1') {

                $tv = ' - Tv padres';
            } else {

                $tv = '';
            }

            if ($es_principal->equipo == '1') {

                $equipo = ' - Equipo ';
            } else {

                $equipo = '';
            }


            if ($es_principal->animales == '1') {

                $animales = ' - Animales ';
            } else {

                $animales = '';
            }

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(69, 5, '5.3. Tenencia de Bienes de los Padres:', 1, 0, 'L');
            $pdf->SetFont('Arial', '', 10);

            $pdf->Cell(121, 5, $casa . $camion .
                    $auto . $mototaxi . $predios .
                    $tv . $equipo . $animales, 1, 1, 'L');
        } else {
            
        }


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(69, 5, '5.3. Tenencia de Bienes de los Padres:', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);


        $pdf->Cell(121, 5, '', 1, 1, 'L');




        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(69, 5, '5.4. Tenencia del Estudiante:', 1, 0, 'L');
        $pdf->SetFont('Arial', '', 10);


        if ($alumnos_ficha->mesa == '1') {

            $mesa_ficha = 'Mesa';
        } else {

            $mesa_ficha = '';
        }

        if ($alumnos_ficha->silla == '1') {
            $silla_ficha = ' - Silla';
        } else {
            $silla_ficha = '';
        }

        if ($alumnos_ficha->hervidora == '1') {
            $hervidora_ficha = ' - Hervidora';
        } else {
            $hervidora_ficha = '';
        }

        if ($alumnos_ficha->cocina == '1') {
            $cocina_ficha = ' - Cocina';
        } else {
            $cocina_ficha = '';
        }

        if ($alumnos_ficha->laptop == '1') {
            $laptop_ficha = ' - Laptop';
        } else {
            $laptop_ficha = '';
        }

        if ($alumnos_ficha->moto == '1') {
            $moto_ficha = ' - Moto';
        } else {
            $moto_ficha = '';
        }


        $pdf->Cell(121, 5, $mesa_ficha . $silla_ficha .
                $hervidora_ficha . $cocina_ficha . $laptop_ficha . $moto_ficha, 1, 1, 'L');


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, '5.5 Situación de salud de la familia:', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 5, 'a) ¿Algún miembro de la familia padece de alguna enfermedad?', 1, 1, 'L');





//enfermitos

        $header = array('Parentesco', 'Apellidos y Nombres', 'Enfermedad', 'Tiempo', 'Recibe Tratamiento', 'Lugar Tratamiento');
        //$pdf->Ln(5);
        //$pdf->SetFillColor(50, 50, 55);
        $pdf->SetFillColor(255, 255, 255);
        //$pdf->SetTextColor(255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(22, 50, 30, 15, 28, 45);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 8);
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(22, 50, 30, 15, 28, 45));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C', 'C', 'L', 'C'));



        //Native query
        $sql_familares_enfermos = $this->modelsManager->createQuery("SELECT AlumnosFamiliares.codigo, 
                parentesco.nombres AS parentesco, AlumnosFamiliares.apellido_paterno, 
                AlumnosFamiliares.apellido_materno, AlumnosFamiliares.nombres, sexo.descripcion AS sexo, 
                AlumnosFamiliares.edad, estado_civil.nombres AS estado_civil, grado_instruccion.nombres AS grado_instruccion,
                AlumnosFamiliares.ocupacion,AlumnosFamiliares.ingresos, AlumnosFamiliares.enfermedad_nombre, AlumnosFamiliares.enfermedad_tiempo,
                AlumnosFamiliares.tratamiento, AlumnosFamiliares.tratamiento_lugar
                FROM AlumnosFamiliares
                INNER JOIN Parentescos parentesco ON AlumnosFamiliares.parentesco = parentesco.codigo
                INNER JOIN Sexoalumnos sexo ON AlumnosFamiliares.sexo = sexo.codigo
                INNER JOIN EstadoCivilFamiliares estado_civil ON AlumnosFamiliares.estado_civil = estado_civil.codigo
                INNER JOIN GradoInstruccionFamiliares grado_instruccion ON AlumnosFamiliares.grado_instruccion = grado_instruccion.codigo
                WHERE AlumnosFamiliares.alumno = '$codigo_alumno' AND AlumnosFamiliares.enfermedad = '1'
                AND parentesco.numero = 27 AND sexo.numero = 3 
                AND estado_civil.numero = 26 AND grado_instruccion.numero = 28
                ORDER BY AlumnosFamiliares.codigo ASC");
        $ficha_familiares_enfermos = $sql_familares_enfermos->execute();


        foreach ($ficha_familiares_enfermos as $key => $value) {
            //$sum_creditos = $sum_creditos + (int) $value->creditos;

            if ($value->tratamiento == '1') {
                $tratamiento = 'Si';
            } elseif ($value->tratamiento == '0') {
                $tratamiento = 'No';
            }
            $pdf->row(array($value->parentesco,
                $value->apellido_paterno . ' ' . $value->apellido_materno . ' ' . $value->nombres, $value->enfermedad_nombre,
                $value->enfermedad_tiempo, $tratamiento, $value->tratamiento_lugar));
        }
        //$pdf->row(array("xsa","asd","asd","asd","<d"));

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();
        $pdf->Cell(190, 5, 'La información señalada en los cuadros  serán sustentadas con las copias de DNIs respectivos. ', 1, 1, 'L');


        $pdf->SetY(500);


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 5, 'VI. CROQUIS DE UBICACIÓN DOMICILIARIA: ', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 80, '', 1, 1, 'L');
        $pdf->Ln(10);






//        $header = array('TOTAL DE ASIGNATURAS : ' . $num_cursos, 'TOTAL CREDITOS', '' . $sum_creditos);
//        // Data loading
//        $data = array();
//        $pdf->SetFont('Arial', 'B', 10);
//
//        $pdf->BasicTables($header, $data);

        /*
          $pdf->Ln(10);
          $pdf->Ln(5);
          $pdf->Cell(10);
          $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
          $pdf->Cell(30);
          $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
          $pdf->Ln();


          $pdf->Cell(10);
          $pdf->Cell(70, 5, ' ESTUDIANTE', 0, 0, 'C');
          $pdf->Cell(30);
          $pdf->Cell(70, 5, ' CONSEJERO', 0, 0, 'C');


          $pdf->Ln(5);
          $pdf->Ln(10);
         */
        $pdf->SetFont('Arial', '', 9);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        //  $pdf->MultiCell(190, 15, 'PROLONG. LIBERTAD #1220-1228 - YURIMAGUAS - LORETO - PERU \r '
        //       . ':v',1, 'C', 0, false);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $h = 12;
        $w = 190;
        //Draw the border
        $pdf->Rect($x, $y, $w, $h);
        //Print the text
        $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
        $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');
        //Put the position to the right of the cell
        $pdf->SetXY($x + $w, $y);
        $pdf->Ln(5);
        $pdf->Ln(10);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');

        $pdf->Output();
        exit;
    }

    //reporte de etiqueta de libros
    public function reporteEtiquetaAction($codigo) {
        $this->view->disable();

        $libro = Libros::findFirstByid_libro($codigo);

        $pdf = new PDF();
        //$pdf = new PDF('P', 'mm', array(150,150));

        $pdf->AddPage();
        //$pdf->Image('logo-vr.png', 145, 11, 50);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);

        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(90);
        //$pdf->Cell(50, 5, 'CODIGO DEL LIBRO', 0, 0, 'L');
        $pdf->Cell(50, 5, "G-{$libro->codigo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(80);
        //$pdf->Cell(50, 5, '-------------------------------------', 0, 1, 'L');
        $pdf->Cell(10);

        $digito = strlen($libro->id_libro);
        if ($digito == 1) {

            $d_1 = '00000' . $libro->id_libro;
            $pdf->Cell(50, 5, "Codigo: $d_1", 0, 0, 'L');
        } elseif ($digito == 2) {

            $d_2 = '00000' . $libro->id_libro;
            $pdf->Cell(50, 5, "Codigo: $d_2", 0, 0, 'L');
        } elseif ($digito == 3) {

            $d_3 = '00000' . $libro->id_libro;
            $pdf->Cell(50, 5, "Codigo: $d_3", 0, 0, 'L');
        } elseif ($digito == 4) {

            $d_4 = '00000' . $libro->id_libro;
            $pdf->Cell(50, 5, "Codigo: $d_4", 0, 0, 'L');
        } else {

            $pdf->Cell(50, 5, "Codigo: {$libro->id_libro}", 0, 0, 'L');
        }


        //$pdf->Cell(50, 5, "Codigo: {$libro->id_libro}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(80);
        //$pdf->Cell(50, 5, 'TÍTULO ', 0, 0, 'L');
        //$titulo = substr($libro->titulo, 0, 20);
        $titulo = $libro->titulo;

        $pdf->Cell(50, 5, $titulo, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Output();
        exit;
    }

    //reporte ficha de libro
    public function reporteFichaAction($codigo) {
        $this->view->disable();

        $libro = Libros::findFirstByid_libro($codigo);

        $pdf = new PDF();
        //$pdf = new PDF('P', 'mm', array(150,150));

        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 60, 11, 50);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(130, 15, 'FICHA DEL LIBRO', 1, 0, 'L');
        // Line break
        $pdf->Ln(10);
//        $pdf->SetFont('Arial', 'B', 10);
//
//        //$pdf->Cell(7);
//        $pdf->Cell(50, 5, 'CODIGO DEL LIBRO', 0, 0, 'L');
//        $pdf->Cell(50, 5, ": {$libro->codigo}", 0, 0, 'L');
//        $pdf->Ln();
//
//        //$pdf->Cell(7);
//        $pdf->Cell(50, 5, 'CODIGO', 0, 0, 'L');
//        $pdf->Cell(50, 5, ": {$libro->codigo}", 0, 0, 'L');
//        $pdf->Ln();
//
//        //$pdf->Cell(7);
//        $pdf->Cell(50, 5, 'TÍTULO ', 0, 0, 'L');
//        $pdf->Cell(50, 5, ": {$libro->titulo}", 0, 0, 'L');
//        $pdf->Ln();
//
//
//        $pdf->Ln(5);

        $header = array('Nº registro', 'Signatura', 'Título');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(20, 30, 80);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(20, 30, 80));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C'));

        //$codestr = $semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        $libro_table = $this->modelsManager->createBuilder()
                ->from('Libros')
                ->columns('Libros.id_libro, Libros.codigo, Libros.titulo, Autores.descripcion as autor_1')
                ->join('Autores', 'Autores.id_autor = Libros.autor_1')
                //->join('Editoriales', 'Editoriales.id_editorial = Libros.editorial')
                ->where("Libros.id_libro='{$codigo}' AND  Libros.estado ='A'")
                ->getQuery()
                ->execute();



        //$num_cursos = count($notas_curso);
        //$sum_creditos = 0;
        foreach ($libro_table as $key => $value) {
            // $sum_creditos = $sum_creditos + (int) $value->creditos;
            //$fecha = date('d/m/Y');
            //--
            $digito = strlen($value->id_libro);
            if ($digito == 1) {

                $d_1 = '00000' . $value->id_libro;
                $pdf->row(array($d_1, $value->id_libro, substr($value->titulo, 0, 100) . "..."));
                //$titulo = substr($libro->titulo, 0, 20);
            } elseif ($digito == 2) {

                $d_2 = '0000' . $value->id_libro;
                $pdf->row(array($d_2, $value->id_libro, substr($value->titulo, 0, 100) . "..."));
            } elseif ($digito == 3) {

                $d_3 = '000' . $value->id_libro;
                $pdf->row(array($d_3, $value->id_libro, substr($value->titulo, 0, 100) . "..."));
            } elseif ($digito == 4) {

                $d_4 = '00' . $value->id_libro;
                $pdf->row(array($d_4, $value->id_libro, substr($value->titulo, 0, 100) . "..."));
            } else {
                $pdf->row(array($value->id_libro, $value->id_libro, substr($value->titulo, 0, 100) . "..."));
            }
        }

        //-----
        $header = array('Isbn', 'Autor');
        //$pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(50, 80);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(50, 80));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C'));

        //$codestr = $semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        $libro_table = $this->modelsManager->createBuilder()
                ->from('Libros')
                ->columns('Libros.id_libro, Libros.codigo, Libros.titulo, Autores.descripcion as autor_1, Libros.isbn')
                ->join('Autores', 'Autores.id_autor = Libros.autor_1')
                //->join('Editoriales', 'Editoriales.id_editorial = Libros.editorial')
                ->where("Libros.id_libro='{$codigo}' AND  Libros.estado ='A'")
                ->getQuery()
                ->execute();



        //$num_cursos = count($notas_curso);
        //$sum_creditos = 0;
        foreach ($libro_table as $key => $value) {
            // $sum_creditos = $sum_creditos + (int) $value->creditos;
            //$fecha = date('d/m/Y');

            $pdf->row(array($value->isbn, $value->autor_1));
        }
        //-----


        $header = array('Año', 'Idioma', 'Editorial');
        //$pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(20, 30, 80);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(20, 30, 80));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C'));

        //$codestr = $semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        $libro_table = $this->modelsManager->createBuilder()
                ->from('Libros')
                ->columns('Libros.id_libro,
                        Libros.codigo, Libros.titulo,
                        Libros.autor_1, Libros.anio_publicacion AS a_p, 
                        Editoriales.descripcion as editorial, 
                        Idiomas.nombres as idioma,
                        Libros.isbn, Libros.lugar_publicacion')
                ->join('Editoriales', 'Editoriales.id_editorial = Libros.editorial')
                ->join('Idiomas', 'Idiomas.codigo = Libros.idioma')
                ->where("Libros.id_libro='{$codigo}' AND  Libros.estado ='A' AND  Idiomas.numero =49")
                ->getQuery()
                ->execute();



        //$num_cursos = count($notas_curso);
        //$sum_creditos = 0;
        foreach ($libro_table as $key => $value) {
            // $sum_creditos = $sum_creditos + (int) $value->creditos;
            $pdf->row(array($value->a_p, $value->idioma, $value->editorial));
        }

        //-----
        $header = array('Fecha Registro', 'Lugar Impr.');
        //$pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(50, 80);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();

        // Color and font restoration
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        //Footer
        $pdf->SetWidths(array(50, 80));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C'));

        //$codestr = $semestre->codigo;
        //$codestr = 36;
        #Cursos de matricula en el semestre actual
        $libro_table = $this->modelsManager->createBuilder()
                ->from('Libros')
                ->columns('Libros.id_libro,
                        Libros.codigo, Libros.titulo,
                        Libros.autor_1, Libros.anio_publicacion AS a_p, 
                        Editoriales.descripcion as editorial, 
                        Idiomas.nombres as idioma,
                        Libros.isbn, Libros.lugar_publicacion')
                ->join('Editoriales', 'Editoriales.id_editorial = Libros.editorial')
                ->join('Idiomas', 'Idiomas.codigo = Libros.idioma')
                ->where("Libros.id_libro='{$codigo}' AND  Libros.estado ='A' AND  Idiomas.numero =49")
                ->getQuery()
                ->execute();



        //$num_cursos = count($notas_curso);
        //$sum_creditos = 0;
        foreach ($libro_table as $key => $value) {
            // $sum_creditos = $sum_creditos + (int) $value->creditos;
            $fecha = date('d/m/Y');
            $pdf->row(array($fecha, $value->lugar_publicacion));
        }
        //-----
        //$pdf->row(array("xsa","asd","asd","asd","<d"));

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();



//        $pdf->Ln(10);
//        $pdf->Ln(5);
//        $pdf->Cell(10);
//        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
//        $pdf->Cell(30);
//        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
//        $pdf->Ln();
//
//
//        $pdf->Cell(10);
//        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
//        $pdf->Cell(30);
//        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
//        $pdf->Ln(5);
//        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 9);


        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $h = 12;
        $w = 130;
        //Draw the border
        $pdf->Rect($x, $y, $w, $h);
        //Print the text
        $pdf->MultiCell($w, 5, $this->config->global->xDireccionIns, 0, 'C');
        $pdf->MultiCell($w, 5, $this->config->global->xWebIns, 0, 'C');
        //Put the position to the right of the cell
        $pdf->SetXY($x + $w, $y);
        $pdf->Ln(5);
        $pdf->Ln(10);
        $pdf->Cell(50);
        //$pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');

        $pdf->Output();
        exit;
    }

    //reporte resumen cv

    public function reporteCurriculumVitaeAction($publico = null, $datos_personales = null, $formacion = null, $capacitaciones = null, $experiencia = null) {

        $this->view->disable();

        //echo '<pre>';
        //print_r($_POST);
        //exit();
        //$Publico = Publico::findFirstBycodigo($publico);
        //print ("Codigo del Publico:" . $Publico->nombres);
        //exit();

        $pdf = new PDF();
        $pdf->AddPage();

        $pdf->enablefooter = 'footer2';

        //$pdf->Image('webpage/assets/img/logo-vr.png', 135, 7.6, 43);
        //$pdf->SetXY(10, 7);
        //$pdf->Cell(14.5);


        if ($datos_personales == "A") {
            $pdf->SetFont('Arial', 'B', 13.2);
            $pdf->MultiCell(190, 12.2, '    CURRICULUM  VITAE', 0, 'C');
            //$pdf->Cell(160, 12, '     CURRICULUM VITAE', 1, 0, 'L');
            $pdf->Ln(8);



            $PublicoSql = $this->modelsManager->createQuery("SELECT publico.codigo, publico.tipo, publico.apellidop, publico.apellidom,
        publico.nombres, publico.sexo, publico.fecha_nacimiento, publico.documento, publico.nro_doc, publico.nro_ruc, publico.seguro, publico.telefono,
        publico.celular, publico.email, publico.direccion, publico.ciudad, publico.observaciones, publico.foto, publico.colegio_publico,
        publico.colegio_nombre, publico.sitrabaja, publico.sitrabaja_nombre, publico.sidepende, publico.sidepende_nombre, publico.estado,
        publico.region, publico.provincia, publico.distrito, publico.ubigeo, publico.region1, publico.provincia1, publico.distrito1, publico.ubigeo1,
        publico.localidad, publico.discapacitado, publico.discapacitado_nombre, publico.password, publico.archivo, publico.colegio_profesional,
        publico.colegio_profesional_nro, publico.estado_civil, publico.archivo_cp, publico.archivo_ruc, publico.archivo_dc, publico.sobre_ti, publico.voluntariado,
        publico.expectativas, publico.fecha_emision_dni, convocatorias_publico.archivo_dni, convocatorias_publico.archivo_ruc, convocatorias_publico.archivo_profesional,
        convocatorias_publico.archivo_discapacidad, tipo_documento.nombres AS nombre_tipo_documento, estado_civil.nombres AS nombre_estado_civil, sexos.nombres AS nombre_sexo,
        regiones.descripcion AS nombre_region, provincias.descripcion AS nombre_provincia, distritos.descripcion AS nombre_distrito, colegio_profesional.nombres AS nombre_colegio_profesional
        FROM Publico publico
        INNER JOIN ConvocatoriasPublico convocatorias_publico ON publico.codigo = convocatorias_publico.publico
        INNER JOIN TipoDocumento tipo_documento ON publico.documento = tipo_documento.codigo
        INNER JOIN EstadoCivil estado_civil ON publico.estado_civil = estado_civil.codigo
        INNER JOIN Sexo sexos ON CAST (publico.sexo AS INTEGER) = sexos.codigo
        INNER JOIN Regiones regiones ON publico.region = regiones.region
        INNER JOIN Provincias provincias ON publico.provincia = provincias.provincia AND publico.region = provincias.region
        INNER JOIN Distritos distritos ON publico.distrito = distritos.distrito AND publico.provincia = distritos.provincia AND publico.region = distritos.region
        INNER JOIN ColegioProfesional colegio_profesional ON publico.colegio_profesional = colegio_profesional.codigo
        WHERE publico.codigo = {$publico} AND tipo_documento.numero = 1 AND estado_civil.numero = 26 AND sexos.numero = 3 AND colegio_profesional.numero = 85");
            $PublicoResult = $PublicoSql->execute();

            foreach ($PublicoResult as $Publico) {

                $pdf->Image('adminpanel/imagenes/imagenes_publico/' . $Publico->foto, 90, 25, 30);

                $pdf->Ln(38.2);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(190, 10, "{$Publico->apellidop} {$Publico->apellidom} {$Publico->nombres}", 0, 1, 'C');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'DATOS PERSONALES', 0, 0, 'L');
                $pdf->Ln(10);

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Documento', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_tipo_documento}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nro. Documento', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nro_doc}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nro. RUC ', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nro_ruc}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Email', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->email}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha de nacimiento', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $fecha_nacimiento_explode1 = explode(" ", $Publico->fecha_nacimiento);
                $fecha_nacimiento_explode2 = explode("-", $fecha_nacimiento_explode1[0]);
                $fecha_nacimiento = $fecha_nacimiento_explode2[2] . "/" . $fecha_nacimiento_explode2[1] . "/" . $fecha_nacimiento_explode2[0];
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$fecha_nacimiento}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Celular', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->celular}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Estado Civil', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_estado_civil}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Sexo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_sexo}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Región', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_region}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Provincia', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_provincia}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Distrito', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_distrito}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Dirección', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->direccion}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Ciudad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->ciudad}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Colegio Profesional', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_colegio_profesional}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nro. Colegiatura', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->colegio_profesional_nro}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Discapacitado', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                if ($Publico->discapacitado == '1') {
                    $discapacitado = 'SI';
                } else if ($Publico->discapacitado == '0') {
                    $discapacitado = 'NO';
                }
                $pdf->Cell(120, 6, "{$discapacitado}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre discapacidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->discapacitado_nombre}", 0, 1, 'L');
                $pdf->Ln(4);

                if ($Publico->archivo_dni !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Archivo DNI', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/personales/{$Publico->archivo_dni}", 0, 1, 'L');
                }

                if ($Publico->archivo_ruc !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Ficha RUC', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/personales/{$Publico->archivo_ruc}", 0, 1, 'L');
                }

                if ($Publico->archivo_profesional !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Certificado de Habilidad', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/personales/{$Publico->archivo_profesional}", 0, 1, 'L');
                }


                if ($Publico->archivo_discapacidad !== null) {
                    //Certificado de discapacidad:
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Certificado de discapacidad', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);

                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/personales/{$Publico->archivo_discapacidad}", 0, 1, 'L');
                }
                $pdf->Ln(4);
            }
        }
        if ($formacion == "A") {
            //print("Check formacion");
            //exit();
            //formacion
            $ConvocatoriasPublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                convocatorias_publico_formacion.codigo,
                                                convocatorias_publico_formacion.publico,
                                                convocatorias_publico_formacion.grado,
                                                convocatorias_publico_formacion.nombre,
                                                convocatorias_publico_formacion.fecha_grado,
                                                convocatorias_publico_formacion.institucion,
                                                convocatorias_publico_formacion.pais,
                                                convocatorias_publico_formacion.archivo,
                                                convocatorias_publico_formacion.imagen,
                                                convocatorias_publico_formacion.estado,
                                                grado_maximo.nombres AS nombre_grado 
                                                FROM
                                                ConvocatoriasPublicoFormacion convocatorias_publico_formacion
                                                INNER JOIN GradoMaximo grado_maximo ON grado_maximo.codigo = convocatorias_publico_formacion.grado 
                                                WHERE
                                                convocatorias_publico_formacion.estado = 'A'
                                                AND grado_maximo.numero = 69
                                                AND convocatorias_publico_formacion.publico = {$publico} ORDER BY convocatorias_publico_formacion.fecha_grado DESC");
            $ConvocatoriasPublicoFormacionResult = $ConvocatoriasPublicoFormacionSql->execute();

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'FORMACIÓN ACADÉMICA', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($ConvocatoriasPublicoFormacionResult as $ConvocatoriasPublicoFormacion) {
                //echo '<pre>';
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Grado / Titulo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$ConvocatoriasPublicoFormacion->nombre_grado}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoFormacion->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoFormacion->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f = explode(" ", $ConvocatoriasPublicoFormacion->fecha_grado);
                $fotmat_f_f_r = explode("-", $format_f_f[0]);
                $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$ConvocatoriasPublicoFormacion->pais}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$ConvocatoriasPublicoFormacion->institucion}", 0, 1, 'L');

                if ($ConvocatoriasPublicoFormacion->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/formacion/{$ConvocatoriasPublicoFormacion->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
        }

        if ($capacitaciones == "A") {
            //capacitaciones
            $ConvocatoriasPublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    convocatoria_publico_capacitaciones.codigo,
                                                    convocatoria_publico_capacitaciones.publico,
                                                    convocatoria_publico_capacitaciones.capacitacion,
                                                    convocatoria_publico_capacitaciones.nombre,
                                                    convocatoria_publico_capacitaciones.fecha_inicio,
                                                    convocatoria_publico_capacitaciones.fecha_fin,
                                                    convocatoria_publico_capacitaciones.institucion,
                                                    convocatoria_publico_capacitaciones.pais,
                                                    convocatoria_publico_capacitaciones.archivo,
                                                    convocatoria_publico_capacitaciones.imagen,
                                                    convocatoria_publico_capacitaciones.estado,
                                                    capacitaciones.nombres AS nombre_capacitacion,
                                                    convocatoria_publico_capacitaciones.horas,
                                                    convocatoria_publico_capacitaciones.creditos 
                                                    FROM
                                                    ConvocatoriasPublicoCapacitaciones convocatoria_publico_capacitaciones
                                                    INNER JOIN Capacitaciones capacitaciones ON capacitaciones.codigo = convocatoria_publico_capacitaciones.capacitacion 
                                                    WHERE
                                                    convocatoria_publico_capacitaciones.estado = 'A'
                                                    AND capacitaciones.numero = 86 
                                                    AND convocatoria_publico_capacitaciones.publico = {$publico} ORDER BY convocatoria_publico_capacitaciones.fecha_inicio DESC");
            $ConvocatoriasPublicoCapacitacionesResult = $ConvocatoriasPublicoCapacitacionesSql->execute();

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'CURSOS, DIPLOMADOS O ESPECIALIZACIONES', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($ConvocatoriasPublicoCapacitacionesResult as $ConvocatoriasPublicoCapacitaciones) {
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->institucion}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Horas', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->horas}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Créditos', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->creditos}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_i_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_inicio);
                $fotmat_f_i_c_r = explode("-", $format_f_i_c[0]);
                $fotmat_f_i_c_r_r = $fotmat_f_i_c_r[2] . "/" . $fotmat_f_i_c_r[1] . "/" . $fotmat_f_i_c_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_i_c_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_fin);
                $fotmat_f_f_c_r = explode("-", $format_f_f_c[0]);
                $fotmat_f_f_c_r_r = $fotmat_f_f_c_r[2] . "/" . $fotmat_f_f_c_r[1] . "/" . $fotmat_f_f_c_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_f_c_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->pais}", 0, 'L');

                if ($ConvocatoriasPublicoCapacitaciones->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                    $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 'L');
                }

                $pdf->Ln(5);
            }
        }

        if ($experiencia == "A") {
            //experiencia
            $ConvocatoriasPublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                convocatorias_publico_experiencia.codigo,
                                                convocatorias_publico_experiencia.publico,
                                                convocatorias_publico_experiencia.tipo,
                                                convocatorias_publico_experiencia.cargo,
                                                convocatorias_publico_experiencia.fecha_inicio,
                                                convocatorias_publico_experiencia.fecha_fin,
                                                convocatorias_publico_experiencia.tiempo,
                                                convocatorias_publico_experiencia.institucion,
                                                convocatorias_publico_experiencia.funciones,
                                                convocatorias_publico_experiencia.archivo,
                                                convocatorias_publico_experiencia.imagen,
                                                convocatorias_publico_experiencia.estado,
                                                tipo_experiencia_laboral.nombres AS nombre_tipo 
                                                FROM
                                                ConvocatoriasPublicoExperiencia convocatorias_publico_experiencia
                                                INNER JOIN TipoExperienciaLaboral tipo_experiencia_laboral ON tipo_experiencia_laboral.codigo = convocatorias_publico_experiencia.tipo 
                                                WHERE
                                                convocatorias_publico_experiencia.estado = 'A' 
                                                AND tipo_experiencia_laboral.numero = 87 
                                                AND convocatorias_publico_experiencia.publico = {$publico} ORDER BY convocatorias_publico_experiencia.fecha_inicio DESC");
            $ConvocatoriasPublicoExperienciaResult = $ConvocatoriasPublicoExperienciaSql->execute();

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'EXPERIENCIA LABORAL', 0, 0, 'L');
            $pdf->Ln(10);

            foreach ($ConvocatoriasPublicoExperienciaResult as $ConvocatoriasPublicoExperiencia) {
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->nombre_tipo}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Institución', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->institucion}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Cargo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->cargo}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_i_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_inicio);
                $fotmat_f_i_e_r = explode("-", $format_f_i_e[0]);
                $fotmat_f_i_e_r_r = $fotmat_f_i_e_r[2] . "/" . $fotmat_f_i_e_r[1] . "/" . $fotmat_f_i_e_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_i_e_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_fin);
                $fotmat_f_f_e_r = explode("-", $format_f_f_e[0]);
                $fotmat_f_f_e_r_r = $fotmat_f_f_e_r[2] . "/" . $fotmat_f_f_e_r[1] . "/" . $fotmat_f_f_e_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_f_e_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tiempo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //
                $dteStart = new DateTime($ConvocatoriasPublicoExperiencia->fecha_inicio);
                $dteEnd = new DateTime($ConvocatoriasPublicoExperiencia->fecha_fin);
                $interval = $dteStart->diff($dteEnd);

                //print($interval->format('%a'));
                //exit();

                $total_meses = ($interval->format('%a')) / 30;
                $total_meses_result = round($total_meses);

                //print($total_meses_result);
                //exit();
                //
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->tiempo}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$total_meses_result}", 0, 'L');

                if ($ConvocatoriasPublicoExperiencia->archivo !== null) {

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                    $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/experiencia/{$ConvocatoriasPublicoExperiencia->archivo}", 0, 'L');
                }

                $pdf->Ln(5);
            }
        }



        //firma ganador
        if ($datos_personales == 'A' || $formacion == 'A' || $capacitaciones == 'A' || $experiencia == 'A') {
            $ganador = Publico::findFirstBycodigo($publico);

            $pdf->Ln(5);
            $pdf->Cell(100);
            $pdf->Cell(80, 5, '_________________________________________', 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(100);
            $pdf->Cell(80, 5, "{$ganador->apellidop} {$ganador->apellidom} {$ganador->nombres}", 0, 1, 'C');
            $pdf->Cell(100);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(80, 5, "DNI.{$ganador->nro_doc}", 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Ln(10);
        }


        $pdf->Output();
        exit;
    }

    public function reporteCurriculumVitaePublicoAction($publico = null, $datos_personales = null, $formacion = null, $capacitaciones = null, $experiencia = null) {

        $this->view->disable();

        //echo '<pre>';
        //print_r($_POST);
        //exit();
        //$Publico = Publico::findFirstBycodigo($publico);
        //print ("Codigo del Publico:" . $Publico->nombres);
        //exit();

        $pdf = new PDF();
        $pdf->AddPage();

        $pdf->enablefooter = 'footer2';

        //$pdf->Image('webpage/assets/img/logo-vr.png', 135, 7.6, 43);
        //$pdf->SetXY(10, 7);
        //$pdf->Cell(14.5);


        if ($datos_personales == "A") {
            $pdf->SetFont('Arial', 'B', 13.2);
            $pdf->MultiCell(190, 12.2, '    CURRICULUM  VITAE', 0, 'C');
            //$pdf->Cell(160, 12, '     CURRICULUM VITAE', 1, 0, 'L');
            $pdf->Ln(8);



            $PublicoSql = $this->modelsManager->createQuery("SELECT publico.codigo, publico.tipo, publico.apellidop, publico.apellidom,
        publico.nombres, publico.sexo, publico.fecha_nacimiento, publico.documento, publico.nro_doc, publico.nro_ruc, publico.seguro, publico.telefono,
        publico.celular, publico.email, publico.direccion, publico.ciudad, publico.observaciones, publico.foto, publico.colegio_publico,
        publico.colegio_nombre, publico.sitrabaja, publico.sitrabaja_nombre, publico.sidepende, publico.sidepende_nombre, publico.estado,
        publico.region, publico.provincia, publico.distrito, publico.ubigeo, publico.region1, publico.provincia1, publico.distrito1, publico.ubigeo1,
        publico.localidad, publico.discapacitado, publico.discapacitado_nombre, publico.password, publico.archivo, publico.colegio_profesional,
        publico.colegio_profesional_nro, publico.estado_civil, publico.archivo_cp, publico.archivo_ruc, publico.archivo_dc, publico.sobre_ti, publico.voluntariado,
        publico.expectativas, publico.fecha_emision_dni, tipo_documento.nombres AS nombre_tipo_documento, estado_civil.nombres AS nombre_estado_civil, sexos.nombres AS nombre_sexo,
        regiones.descripcion AS nombre_region, provincias.descripcion AS nombre_provincia, distritos.descripcion AS nombre_distrito, colegio_profesional.nombres AS nombre_colegio_profesional
        FROM Publico publico
        INNER JOIN TipoDocumento tipo_documento ON publico.documento = tipo_documento.codigo
        INNER JOIN EstadoCivil estado_civil ON publico.estado_civil = estado_civil.codigo
        INNER JOIN Sexo sexos ON CAST (publico.sexo AS INTEGER) = sexos.codigo
        INNER JOIN Regiones regiones ON publico.region = regiones.region
        INNER JOIN Provincias provincias ON publico.provincia = provincias.provincia AND publico.region = provincias.region
        INNER JOIN Distritos distritos ON publico.distrito = distritos.distrito AND publico.provincia = distritos.provincia AND publico.region = distritos.region
        INNER JOIN ColegioProfesional colegio_profesional ON publico.colegio_profesional = colegio_profesional.codigo
        WHERE publico.codigo = {$publico} AND tipo_documento.numero = 1 AND estado_civil.numero = 26 AND sexos.numero = 3 AND colegio_profesional.numero = 85");
            $PublicoResult = $PublicoSql->execute();

            foreach ($PublicoResult as $Publico) {

                $pdf->Image('adminpanel/imagenes/imagenes_publico/' . $Publico->foto, 90, 25, 30);

                $pdf->Ln(38.2);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(190, 10, "{$Publico->apellidop} {$Publico->apellidom} {$Publico->nombres}", 0, 1, 'C');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'DATOS PERSONALES', 0, 0, 'L');
                $pdf->Ln(10);

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Documento', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_tipo_documento}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nro. Documento', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nro_doc}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nro. RUC ', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nro_ruc}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Email', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->email}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha de nacimiento', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $fecha_nacimiento_explode1 = explode(" ", $Publico->fecha_nacimiento);
                $fecha_nacimiento_explode2 = explode("-", $fecha_nacimiento_explode1[0]);
                $fecha_nacimiento = $fecha_nacimiento_explode2[2] . "/" . $fecha_nacimiento_explode2[1] . "/" . $fecha_nacimiento_explode2[0];
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$fecha_nacimiento}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Celular', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->celular}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Estado Civil', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_estado_civil}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Sexo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_sexo}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Región', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_region}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Provincia', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_provincia}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Distrito', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_distrito}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Dirección', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->direccion}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Ciudad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->ciudad}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Colegio Profesional', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nombre_colegio_profesional}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nro. Colegiatura', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->colegio_profesional_nro}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Discapacitado', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                if ($Publico->discapacitado == '1') {
                    $discapacitado = 'SI';
                } else if ($Publico->discapacitado == '0') {
                    $discapacitado = 'NO';
                }
                $pdf->Cell(120, 6, "{$discapacitado}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre discapacidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->discapacitado_nombre}", 0, 1, 'L');
                $pdf->Ln(4);

                if ($Publico->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Archivo DNI', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo}", 0, 1, 'L');
                }

                if ($Publico->archivo_ruc !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Ficha RUC', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_ruc}", 0, 1, 'L');
                }

                if ($Publico->archivo_cp !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Certificado de Habilidad', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_cp}", 0, 1, 'L');
                }


                if ($Publico->archivo_dc !== null) {
                    //Certificado de discapacidad:
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace Certificado de discapacidad', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);

                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_dc}", 0, 1, 'L');
                }
                $pdf->Ln(4);
            }
        }
        if ($formacion == "A") {
            //print("Check formacion");
            //exit();
            //formacion
            $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.codigo,
                                                publico_formacion.publico,
                                                publico_formacion.grado,
                                                publico_formacion.nombre,
                                                publico_formacion.fecha_grado,
                                                publico_formacion.institucion,
                                                publico_formacion.pais,
                                                publico_formacion.archivo,
                                                publico_formacion.imagen,
                                                publico_formacion.estado,
                                                grado_maximo.nombres AS nombre_grado 
                                                FROM
                                                PublicoFormacion publico_formacion
                                                INNER JOIN GradoMaximo grado_maximo ON grado_maximo.codigo = publico_formacion.grado 
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND grado_maximo.numero = 69
                                                AND publico_formacion.publico = {$publico} ORDER BY publico_formacion.fecha_grado DESC");
            $PublicoFormacionResult = $PublicoFormacionSql->execute();

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'FORMACIÓN ACADÉMICA', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($PublicoFormacionResult as $PublicoFormacion) {
                //echo '<pre>';
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Grado / Titulo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$PublicoFormacion->nombre_grado}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$PublicoFormacion->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$PublicoFormacion->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f = explode(" ", $PublicoFormacion->fecha_grado);
                $fotmat_f_f_r = explode("-", $format_f_f[0]);
                $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$PublicoFormacion->pais}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$PublicoFormacion->institucion}", 0, 1, 'L');

                if ($PublicoFormacion->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/formacion/{$PublicoFormacion->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
        }

        if ($capacitaciones == "A") {
            //capacitaciones
            $ConvocatoriasPublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    publico_capacitaciones.codigo,
                                                    publico_capacitaciones.publico,
                                                    publico_capacitaciones.capacitacion,
                                                    publico_capacitaciones.nombre,
                                                    publico_capacitaciones.fecha_inicio,
                                                    publico_capacitaciones.fecha_fin,
                                                    publico_capacitaciones.institucion,
                                                    publico_capacitaciones.pais,
                                                    publico_capacitaciones.archivo,
                                                    publico_capacitaciones.imagen,
                                                    publico_capacitaciones.estado,
                                                    capacitaciones.nombres AS nombre_capacitacion,
                                                    publico_capacitaciones.horas,
                                                    publico_capacitaciones.creditos 
                                                    FROM
                                                    PublicoCapacitaciones publico_capacitaciones
                                                    INNER JOIN Capacitaciones capacitaciones ON capacitaciones.codigo = publico_capacitaciones.capacitacion 
                                                    WHERE
                                                    publico_capacitaciones.estado = 'A'
                                                    AND capacitaciones.numero = 86 
                                                    AND publico_capacitaciones.publico = {$publico} ORDER BY publico_capacitaciones.fecha_inicio DESC");
            $ConvocatoriasPublicoCapacitacionesResult = $ConvocatoriasPublicoCapacitacionesSql->execute();

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'CURSOS, DIPLOMADOS O ESPECIALIZACIONES', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($ConvocatoriasPublicoCapacitacionesResult as $ConvocatoriasPublicoCapacitaciones) {
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Denominación', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Centro de Estudios', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->institucion}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Horas', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->horas}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Créditos', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->creditos}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_i_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_inicio);
                $fotmat_f_i_c_r = explode("-", $format_f_i_c[0]);
                $fotmat_f_i_c_r_r = $fotmat_f_i_c_r[2] . "/" . $fotmat_f_i_c_r[1] . "/" . $fotmat_f_i_c_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_i_c_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f_c = explode(" ", $ConvocatoriasPublicoCapacitaciones->fecha_fin);
                $fotmat_f_f_c_r = explode("-", $format_f_f_c[0]);
                $fotmat_f_f_c_r_r = $fotmat_f_f_c_r[2] . "/" . $fotmat_f_f_c_r[1] . "/" . $fotmat_f_f_c_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_f_c_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'País', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->pais}", 0, 'L');

                if ($ConvocatoriasPublicoCapacitaciones->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                    $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 'L');
                }

                $pdf->Ln(5);
            }
        }

        if ($experiencia == "A") {
            //experiencia
            $ConvocatoriasPublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                publico_experiencia.codigo,
                                                publico_experiencia.publico,
                                                publico_experiencia.tipo,
                                                publico_experiencia.cargo,
                                                publico_experiencia.fecha_inicio,
                                                publico_experiencia.fecha_fin,
                                                publico_experiencia.tiempo,
                                                publico_experiencia.institucion,
                                                publico_experiencia.funciones,
                                                publico_experiencia.archivo,
                                                publico_experiencia.imagen,
                                                publico_experiencia.estado,
                                                tipo_experiencia_laboral.nombres AS nombre_tipo 
                                                FROM
                                                PublicoExperiencia publico_experiencia
                                                INNER JOIN TipoExperienciaLaboral tipo_experiencia_laboral ON tipo_experiencia_laboral.codigo = publico_experiencia.tipo 
                                                WHERE
                                                publico_experiencia.estado = 'A' 
                                                AND tipo_experiencia_laboral.numero = 87 
                                                AND publico_experiencia.publico = {$publico} ORDER BY publico_experiencia.fecha_inicio DESC");
            $ConvocatoriasPublicoExperienciaResult = $ConvocatoriasPublicoExperienciaSql->execute();

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'EXPERIENCIA LABORAL', 0, 0, 'L');
            $pdf->Ln(10);

            foreach ($ConvocatoriasPublicoExperienciaResult as $ConvocatoriasPublicoExperiencia) {
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Especialidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre_capacitacion}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->nombre_tipo}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Institución', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->institucion}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Cargo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$ConvocatoriasPublicoExperiencia->cargo}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Inicio', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_i_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_inicio);
                $fotmat_f_i_e_r = explode("-", $format_f_i_e[0]);
                $fotmat_f_i_e_r_r = $fotmat_f_i_e_r[2] . "/" . $fotmat_f_i_e_r[1] . "/" . $fotmat_f_i_e_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_i_e_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fin', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f_e = explode(" ", $ConvocatoriasPublicoExperiencia->fecha_fin);
                $fotmat_f_f_e_r = explode("-", $format_f_f_e[0]);
                $fotmat_f_f_e_r_r = $fotmat_f_f_e_r[2] . "/" . $fotmat_f_f_e_r[1] . "/" . $fotmat_f_f_e_r[0];
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$fotmat_f_f_e_r_r}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tiempo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //
                $dteStart = new DateTime($ConvocatoriasPublicoExperiencia->fecha_inicio);
                $dteEnd = new DateTime($ConvocatoriasPublicoExperiencia->fecha_fin);
                $interval = $dteStart->diff($dteEnd);

                //print($interval->format('%a'));
                //exit();

                $total_meses = ($interval->format('%a')) / 30;
                $total_meses_result = round($total_meses);

                //print($total_meses_result);
                //exit();
                //
                //$pdf->Cell(120, 6, "{$ConvocatoriasPublicoCapacitaciones->tiempo}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$total_meses_result}", 0, 'L');

                if ($ConvocatoriasPublicoExperiencia->archivo !== null) {

                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo:', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    //$pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias/documentos/capacitaciones/{$ConvocatoriasPublicoCapacitaciones->archivo}", 0, 1, 'L');
                    $pdf->MultiCell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/experiencia/{$ConvocatoriasPublicoExperiencia->archivo}", 0, 'L');
                }

                $pdf->Ln(5);
            }
        }



        //firma ganador
        if ($datos_personales == 'A' || $formacion == 'A' || $capacitaciones == 'A' || $experiencia == 'A') {
            $ganador = Publico::findFirstBycodigo($publico);

            $pdf->Ln(5);
            $pdf->Cell(100);
            $pdf->Cell(80, 5, '_________________________________________', 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(100);
            $pdf->Cell(80, 5, "{$ganador->apellidop} {$ganador->apellidom} {$ganador->nombres}", 0, 1, 'C');
            $pdf->Cell(100);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(80, 5, "DNI.{$ganador->nro_doc}", 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Ln(10);
        }


        $pdf->Output();
        exit;
    }

}
