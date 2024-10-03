<?php

require_once APP_PATH . '/app/library/pdf.php';

class Gestionnotas1530Controller extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        //print("llega");
        //exit();
    }

    //Aca insertamos un comentario para subir
    public function indexAction($sem = null)
    {

        $semestre_a = Semestres::findFirst(
            [
                "activo = 'M'  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
        $this->assets->addJs("adminpanel/js/modulos/gestionnotas1530.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction($sem)
    {

        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("da.asignatura");
            $datatable->setSelect("da.asignatura,da.semestre,  da.docente, da.tipo, da.tp,
             cu.descripcion, asi.ciclo, asi.nombre, da.semestre, asi.hp, asi.ht , asi.creditos, ac.nombres, da.grupo");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("docentes_asignaturas da
             inner join asignaturas asi ON asi.codigo = da.asignatura
             inner join curriculas cu ON cu.codigo = asi.curricula
             inner join a_codigos ac ON ac.codigo = asi.tipo
                ");
            //$datatable->setWhere(" (a.estado = 'A') AND (a.codigo > 0) ");
            $datatable->setWhere(" da.semestre = {$sem} and da.docente = {$doc_id} and  ac.numero = 71 ");
            $datatable->setOrderby("da.asignatura ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function notasAction($id, $sem, $gru)
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionnotas1530.notas.js?v=" . uniqid());

        $semestre = Semestres::findFirst(
            [
                "activo = 'M' and codigo = {$sem} ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $fecha_actual = strtotime(date("Y-m-d H:i:s", time()));

        $fecha_inicio_sustitutorio = strtotime(date($semestre->fecha_inicio_sustitutorio));
        $fecha_final_sustitutorio = strtotime(date($semestre->fecha_fin_sustitutorio));

        $fecha_inicio_notas1 = strtotime(date($semestre->fecha_inicio_notas1));
        $fecha_fin_notas1 = strtotime(date($semestre->fecha_fin_notas1));

        $fecha_inicio_notas2 = strtotime(date($semestre->fecha_inicio_notas2));
        $fecha_fin_notas2 = strtotime(date($semestre->fecha_fin_notas2));

        $ea_activado = "readonly";
        if ($fecha_actual >= $fecha_inicio_sustitutorio && $fecha_actual <= $fecha_final_sustitutorio) {
            $ea_activado = "";
        }

        $eaadisab[1] = "disabled";
        $eaactivado[1] = "readonly";
        if ($fecha_actual >= $fecha_inicio_notas1 && $fecha_actual <= $fecha_fin_notas1) {
            $eaactivado[1] = "";
            $eaadisab[1] = "";
        }

        $eaadisab[2] = "disabled";
        $eaactivado[2] = "readonly";
        if ($fecha_actual >= $fecha_inicio_notas2 && $fecha_actual <= $fecha_fin_notas2) {
            $eaactivado[2] = "";
            $eaadisab[2] = "";
        }

        $this->view->ea_activado = $ea_activado;
        $this->view->eaactivado = $eaactivado;
        $this->view->eaadisab = $eaadisab;

        $asignatura = "";
        if ($id != null) {
            $asignatura = Asignaturas::findFirstBycodigo((string) $id);
        }

        //$vista_notas  = Vistanotas::find("semestre = '{$sem}' AND asignatura='{$id}' ");
        $vista_notas = VNotas::find(
            [
                "semestre = '{$sem}' AND asignatura='{$id}' AND grupo='{$gru}' AND tipo<>2 AND tipo<>5 AND tipo<>9 ",
                'order' => 'apellidos ASC',
            ]
        );

        $cod = Acodigos::findFirst(
            [
                "codigo = '{$asignatura->tipo}' AND numero = 6  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $programa = Curriculas::findFirst(
            [
                "codigo = '{$asignatura->curricula}'  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );
        // echo  $asignaturas->codigo ; exit();
        $this->view->asignatura = $asignatura;
        $this->view->semestre = $semestre;
        $this->view->grupo = $gru;
        $this->view->programa = $programa;
        $this->view->notas = $vista_notas;
        $this->view->cod = $cod;
    }

    public function guardanotasAction()
    {
//        echo "<pre>";
        //        print_r($_POST);
        //        exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $semestre = $this->request->getPost("semestre", "int");
            $asignatura = $this->request->getPost("asignatura", "string");
            $grupo = $this->request->getPost("grupo", "string");

            foreach ($_POST["alumno"] as $key => $val) {

                $db = $this->db;
                //$perid = (int)$perfil;

                // $pp1 = (double)$_POST["ep1"][$key];
                // $pp2 = (double)$_POST["ep2"][$key];
                // $ef = (double)$_POST["ef"][$key];
                // $ea = (double)$_POST["ea"][$key];
                // $pf = (double)$_POST["pf"][$key];

                $pp1 = $_POST["ep1"][$key];
                $pp2 = $_POST["ep2"][$key];
                $ef = $_POST["ef"][$key];
                $ea = $_POST["ea"][$key];
                $pf = $_POST["pf"][$key];

                if ($pp1 == "") {
                    $pp1 = 0;
                }

                if ($pp2 == "") {
                    $pp2 = 0;
                }

                if ( $ef == "") {
                    $ef = 0;
                }

                if ( $ea == "") {
                    $ea = 0;
                }

                if ( $pf == "") {
                    $pf = 0;
                }
                

                $sql = " update alumnos_asignaturas  set ep1 = {$pp1}  , ep2 = {$pp2}, ef = {$ef}, ea = {$ea} ,pf = {$pf}

            where alumno = '{$val}' AND semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = '{$grupo}'  ";
                //print $sql; exit();
                $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);

                /*
                $not = Alumnosasignatura::findFirst(
                [
                "asignatura = '{$asignatura}' AND semestre = {$semestre} AND alumno='{$val}'  ",
                'order' => 'alumno DESC',
                'limit' => 1,
                ]); */
                //$not->semestre = (int)$semestre;
                //$not->asignatura = $asignatura;
                //$not->alumno = (string)$val;
                /* $not->pp1 = $_POST["ep1"][$key];
                $not->pp2 = $_POST["ep2"][$key];
                $not->ea = $_POST["ef"][$key];
                $not->pf = $_POST["pf"][$key]; */
                //$not->save();
            }
            //exit();
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //Funcion para guardar asignatura
    // justo aca
    public function saveAction()
    {
        echo "<pre>";
        print_r($_POST);exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "int");
                $Asignaturas = Asignaturas::findFirstBycodigo($id);
                $Asignaturas = (!$Asignaturas) ? new Asignaturas() : $Asignaturas;

                $Asignaturas->codigo = $this->request->getPost("codigo", "string");

                $Asignaturas->nombre = $this->request->getPost("nombre", "string");
                $Asignaturas->nivel = $this->request->getPost("nivel", "string");
                $Asignaturas->ciclo = $this->request->getPost("ciclo", "string");
                $Asignaturas->tipo = $this->request->getPost("tipo", "string");

                // print $this->request->getPost("curricula", "string") ;exit();

                $Asignaturas->curricula = $this->request->getPost("curricula", "string");
                $Asignaturas->creditos = $this->request->getPost("creditos", "string");
                $Asignaturas->pr1 = $this->request->getPost("pr1", "string");
                $Asignaturas->pr2 = $this->request->getPost("pr2", "string");
                $Asignaturas->pr3 = $this->request->getPost("pr3", "string");
                $Asignaturas->ht = $this->request->getPost("ht", "string");
                $Asignaturas->hp = $this->request->getPost("hp", "string");
                $Asignaturas->observaciones = $this->request->getPost("observaciones");
                $Asignaturas->estado = "A";

                if ($Asignaturas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Asignaturas->getMessages());
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

    //Funcion para eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Asignaturas = Asignaturas::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Asignaturas && $Asignaturas->estado = 'A') {
                $Asignaturas->estado = 'I';
                $Asignaturas->save();
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

    public function actasAction($curso, $semestrex, $grupo)
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

        $cursoob = Asignaturas::findFirstBycodigo($curso);
        //print $cursoob->nombre;exit();

        $carrera = Curriculas::findFirstBycodigo($cursoob->curricula);

        // las notas

        $vista_notas = Vnotas::find(
            [
                "semestre = '{$semestrex}' AND asignatura='{$curso}' AND grupo='{$grupo}' AND tipo <>2 AND tipo <>5 AND tipo <>9  ",
                'order' => 'apellidos ASC',
            ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vri.png', 11, 7, 90);
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

    public function registrosAction($curso, $semestrex)
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

        $cursoob = Asignaturas::findFirstBycodigo($curso);
        //print $cursoob->nombre;exit();

        $carrera = Curriculas::findFirstBycodigo($cursoob->curricula);

        // las notas

        $vista_notas = Vnotas::find(
            [
                "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo<>2 AND tipo<>5 AND tipo <>9 ",
                'order' => 'apellidos ASC',
            ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vri.png', 11, 7, 70);
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

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', 'EP. 01', 'EP. 02', 'EC', 'EXAM SUST.', 'PROM. FINAL', 'LETRAS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header
        $w = array(9, 20, 60, 14, 14, 14, 17, 17, 25);
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

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C', 'C', 'C', 'L'));

        $crece = 0;
        foreach ($vista_notas as $key => $value) {
            $crece++;
            $pdf->RowNota(array($crece, $value->alumno, $value->apellidos . " " . $value->nombres,
                $value->ep1, $value->ep2, $value->ef, $value->ea, $value->pf, $this->convierte((int) $value->pf)));
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

    public function ep1Action($curso, $semestrex)
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

        $cursoob = Asignaturas::findFirstBycodigo($curso);
        //print $cursoob->nombre;exit();

        $carrera = Curriculas::findFirstBycodigo($cursoob->curricula);

        // las notas

        $vista_notas = Vnotas::find(
            [
                "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo<>2 AND tipo<>5 AND tipo <>9 ",
                'order' => 'apellidos ASC',
            ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vri.png', 11, 7, 70);
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

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', 'EP1');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header
        $w = array(15, 30, 120, 20);
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

        $pdf->SetAligns(array('C', 'C', 'L', 'C'));

        $crece = 0;
        foreach ($vista_notas as $key => $value) {
            $crece++;
            $pdf->RowNotaPr(array($crece, $value->alumno, $value->apellidos . " " . $value->nombres,
                $value->ep1), 3);
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

    public function convierte($numero)
    {
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

}
