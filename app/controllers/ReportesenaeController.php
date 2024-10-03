<?php

require_once APP_PATH . '/app/library/pdf.php';

class ReportesenaeController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/reportesenae.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    public function convierte($numero)
    {
        $numero = (int) $numero;
        if ($numero < 0) {
            //print("Promedio Final: ".$numero);
            //exit();
            $numero = abs($numero * 0);
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

    public function reporteInstitucionAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        $xJefaturaIns = $this->config->global->xJefaturaIns;
        $xOficinaIns = $this->config->global->xOficinaIns;
        $pdf->MultiCell($w, 4, $xJefaturaIns, 0, 'R');
        $pdf->MultiCell($w, 4, $xOficinaIns, 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'REPORTE SEGÚN INSTITUCIÓN', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'APELLIDOS Y NOMBRES', 'PUNTAJE', 'INSTITUCIÓN');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);

        $w = array(10, 78, 12, 90);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 78, 12, 90));
        $pdf->SetAligns(array('C', 'L', 'C', 'L'));

        // print("Reporte en desarrollo...");
        // exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        public.admision_postulantes.puntaje,
        public.publico.institucion
        FROM
        public.publico
        INNER JOIN public.admision_postulantes ON public.publico.codigo = public.admision_postulantes.postulante
        WHERE
        public.admision_postulantes.proceso = 2 AND
        public.admision_postulantes.puntaje >= 0
        ORDER BY public.publico.apellidop ASC,
        public.publico.apellidom ASC,
        public.publico.nombres ASC,
        public.publico.institucion ASC";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {

            $apellidop = mb_strtoupper($robot->apellidop, 'utf-8');
            $apellidom = mb_strtoupper($robot->apellidom, 'utf-8');
            $nombres = mb_strtoupper($robot->nombres, 'utf-8');
            $pdf->row(array($key + 1, $apellidop . ' ' . $apellidom . ' ' . $nombres, $robot->puntaje, $robot->institucion));
        }

        $pdf->Ln();
        $pdf->Output();

    }

    public function reporteParticipantesInternosAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        $xJefaturaIns = $this->config->global->xJefaturaIns;
        $xOficinaIns = $this->config->global->xOficinaIns;
        $pdf->MultiCell($w, 4, $xJefaturaIns, 0, 'R');
        $pdf->MultiCell($w, 4, $xOficinaIns, 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'REPORTE SEGÚN TIPO DE PARTICPANTE: INTERNOS', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'APELLIDOS Y NOMBRES', 'PUNTAJE', 'INTERNOS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        $w = array(10, 78, 12, 90);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 78, 12, 90));
        $pdf->SetAligns(array('C', 'L', 'C', 'L'));

        // print("Reporte en desarrollo...");
        // exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.codigo,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        public.admision_postulantes.puntaje,
        public.publico.institucion
        FROM
        public.publico
        INNER JOIN public.admision_postulantes ON public.publico.codigo = public.admision_postulantes.postulante
        INNER JOIN public.a_codigos AS categoria ON public.publico.categoria = categoria.codigo
        WHERE
        categoria.numero = 104 AND
        categoria.nombres = 'Interno' AND
        public.admision_postulantes.proceso = 2 AND
        public.admision_postulantes.puntaje >= 0
        ORDER BY public.publico.apellidop ASC,
        public.publico.apellidom ASC,
        public.publico.nombres ASC,
        public.publico.institucion ASC";
        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {
            $apellidop = mb_strtoupper($robot->apellidop, 'utf-8');
            $apellidom = mb_strtoupper($robot->apellidom, 'utf-8');
            $nombres = mb_strtoupper($robot->nombres, 'utf-8');
            $pdf->row(array($key + 1, $apellidop . ' ' . $apellidom . ' ' . $nombres, $robot->puntaje, $robot->institucion));
        }

        $pdf->Ln();
        $pdf->Output();

    }

    public function reporteParticipantesEgresadosAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        $xJefaturaIns = $this->config->global->xJefaturaIns;
        $xOficinaIns = $this->config->global->xOficinaIns;
        $pdf->MultiCell($w, 4, $xJefaturaIns, 0, 'R');
        $pdf->MultiCell($w, 4, $xOficinaIns, 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'REPORTE SEGÚN TIPO DE PARTICPANTE: EGRESADOS', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'APELLIDOS Y NOMBRES', 'PUNTAJE', 'EGRESADOS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        $w = array(10, 78, 12, 90);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 78, 12, 90));
        $pdf->SetAligns(array('C', 'L', 'C', 'L'));

        // print("Reporte en desarrollo...");
        // exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.codigo,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        public.admision_postulantes.puntaje,
        public.publico.institucion
        FROM
        public.publico
        INNER JOIN public.admision_postulantes ON public.publico.codigo = public.admision_postulantes.postulante
        INNER JOIN public.a_codigos AS categoria ON public.publico.categoria = categoria.codigo
        WHERE
        categoria.numero = 104 AND
        categoria.nombres = 'Egresado' AND
        public.admision_postulantes.proceso = 2 AND
        public.admision_postulantes.puntaje >= 0
        ORDER BY public.publico.apellidop ASC,
        public.publico.apellidom ASC,
        public.publico.nombres ASC,
        public.publico.institucion ASC";
        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {
            $apellidop = mb_strtoupper($robot->apellidop, 'utf-8');
            $apellidom = mb_strtoupper($robot->apellidom, 'utf-8');
            $nombres = mb_strtoupper($robot->nombres, 'utf-8');
            $pdf->row(array($key + 1, $apellidop . ' ' . $apellidom . ' ' . $nombres, $robot->puntaje, $robot->institucion));
        }

        $pdf->Ln();
        $pdf->Output();

    }

    public function reporteParticipantesBachilleresAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        $xJefaturaIns = $this->config->global->xJefaturaIns;
        $xOficinaIns = $this->config->global->xOficinaIns;
        $pdf->MultiCell($w, 4, $xJefaturaIns, 0, 'R');
        $pdf->MultiCell($w, 4, $xOficinaIns, 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'REPORTE SEGÚN TIPO DE PARTICPANTE: BACHILLERES', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'APELLIDOS Y NOMBRES', 'PUNTAJE', 'BACHILLERES');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        $w = array(10, 78, 12, 90);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 78, 12, 90));
        $pdf->SetAligns(array('C', 'L', 'C', 'L'));

        // print("Reporte en desarrollo...");
        // exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.codigo,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        public.admision_postulantes.puntaje,
        public.publico.institucion
        FROM
        public.publico
        INNER JOIN public.admision_postulantes ON public.publico.codigo = public.admision_postulantes.postulante
        INNER JOIN public.a_codigos AS categoria ON public.publico.categoria = categoria.codigo
        WHERE
        categoria.numero = 104 AND
        categoria.nombres = 'Bachiller' AND
        public.admision_postulantes.proceso = 2 AND
        public.admision_postulantes.puntaje >= 0
        ORDER BY public.publico.apellidop ASC,
        public.publico.apellidom ASC,
        public.publico.nombres ASC,
        public.publico.institucion ASC";
        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {
            $apellidop = mb_strtoupper($robot->apellidop, 'utf-8');
            $apellidom = mb_strtoupper($robot->apellidom, 'utf-8');
            $nombres = mb_strtoupper($robot->nombres, 'utf-8');
            $pdf->row(array($key + 1, $apellidop . ' ' . $apellidom . ' ' . $nombres, $robot->puntaje, $robot->institucion));
        }

        $pdf->Ln();
        $pdf->Output();

    }

    public function reporteParticipantesTituladosAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        $xJefaturaIns = $this->config->global->xJefaturaIns;
        $xOficinaIns = $this->config->global->xOficinaIns;
        $pdf->MultiCell($w, 4, $xJefaturaIns, 0, 'R');
        $pdf->MultiCell($w, 4, $xOficinaIns, 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'REPORTE SEGÚN TIPO DE PARTICPANTE: TITULADOS', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'APELLIDOS Y NOMBRES', 'PUNTAJE', 'TITULADOS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        $w = array(10, 78, 12, 90);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 78, 12, 90));
        $pdf->SetAligns(array('C', 'L', 'C', 'L'));

        // print("Reporte en desarrollo...");
        // exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.publico.codigo,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        public.admision_postulantes.puntaje,
        public.publico.institucion
        FROM
        public.publico
        INNER JOIN public.admision_postulantes ON public.publico.codigo = public.admision_postulantes.postulante
        INNER JOIN public.a_codigos AS categoria ON public.publico.categoria = categoria.codigo
        WHERE
        categoria.numero = 104 AND
        categoria.nombres = 'Titulado' AND
        public.admision_postulantes.proceso = 2 AND
        public.admision_postulantes.puntaje >= 0
        ORDER BY public.publico.apellidop ASC,
        public.publico.apellidom ASC,
        public.publico.nombres ASC,
        public.publico.institucion ASC";
        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {
            $apellidop = mb_strtoupper($robot->apellidop, 'utf-8');
            $apellidom = mb_strtoupper($robot->apellidom, 'utf-8');
            $nombres = mb_strtoupper($robot->nombres, 'utf-8');
            $pdf->row(array($key + 1, $apellidop . ' ' . $apellidom . ' ' . $nombres, $robot->puntaje, $robot->institucion));
        }

        $pdf->Ln();
        $pdf->Output();

    }

    public function reporteConstanciaenaeAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();

        $pdf->enablefooter = 'footerBlanco';
        //
        $auth = $this->session->get('auth');
        $id = $auth["codigo"];
        $postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);

        // print($postulante->sexo);
        // exit();

        $admisionM = Admision::findFirst("activo = 'M'");
        $admisionPostulantesa = AdmisionPostulantes::findFirst("admision = $admisionM->codigo AND postulante = $postulante->codigo");

        //  print(count($admisionPostulantesa->puntaje));
        //  exit();

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $verifica = AdmisionPostulantes::find("postulante = {$Postulante->codigo}");

        if (count($verifica) >= 1) {

            // print($admisionPostulantesa->puntaje);
            // exit();

            if ((int) $admisionPostulantesa->puntaje < 0) {
                $pdf->Image('adminpanel/imagenes/certificados/enae_constancia_0.png', 0, 0, 212);
                $pdf->Output();
            } else {
                if ($postulante->sexo == '1') {
                    // print('Masculino');
                    // exit();
                    $pdf->Image('adminpanel/imagenes/certificados/enae_constancia_1.png', 0, 0, 212);
                } else if ($postulante->sexo == '2') {
                    // print('Femenino');
                    // exit();
                    $pdf->Image('adminpanel/imagenes/certificados/enae_constancia_2.png', 0, 0, 212);
                }
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 18);
                $pdf->ln(112);
                $nombres = mb_strtoupper($postulante->nombres, 'utf-8');
                $apellidop = mb_strtoupper($postulante->apellidop, 'utf-8');
                $apellidom = mb_strtoupper($postulante->apellidom, 'utf-8');
                $pdf->Cell(190, 5, $apellidop . ' ' . $apellidom . ' ' . $nombres, 0, 1, 'C');
                $pdf->ln(7);
                $pdf->Cell(67);

                $codigoPostulante = strlen($postulante->codigo);
                if ($codigoPostulante == 1) {

                    $newCodigo = '00000' . $postulante->codigo;
                } elseif ($codigoPostulante == 2) {
                    $newCodigo = '0000' . $postulante->codigo;
                } elseif ($codigoPostulante == 3) {
                    $newCodigo = '000' . $postulante->codigo;
                } elseif ($codigoPostulante == 4) {
                    $newCodigo = '00' . $postulante->codigo;
                } elseif ($codigoPostulante == 5) {
                    $newCodigo = '0' . $postulante->codigo;
                }

                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(27, 8, $newCodigo, 0, 1, 'C');

                $pdf->ln(1);
                $pdf->Cell(30);
                $pdf->Cell(120, 8, $postulante->institucion, 0, 1, 'L');

                $pdf->ln(14);
                $pdf->Cell(108);
                $pdf->Cell(20, 8, number_format($admisionPostulantesa->puntaje, 2), 0, 0, 'C');
                $pdf->Cell(50, 8, $this->convierte((int) $admisionPostulantesa->puntaje), 0, 1, 'C');

                $pdf->Ln();
                $pdf->Output();
            }

        } else {
            return $this->response->redirect("procesoadmisiona/resultadosnoapto");
        }

    }

    public function reporteConstanciasenaeAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $admisionM = Admision::findFirst("activo = 'M'");

            $admisionPostulante = AdmisionPostulantes::find("admision = $admisionM->codigo AND proceso = 2 AND puntaje >= 0");
            // $admisionPostulante = AdmisionPostulantes::find(
            //     [
            //         "admision = $admisionM->codigo AND proceso = 2 AND puntaje >= 0",
            //         'limit' => 2,
            //     ]
            // );

            foreach ($admisionPostulante as $admisionPostulantesa) {

                // echo "<pre>";
                // print_r($admisionPostulantesa->postulante);
                $postulante = Publico::findFirstBycodigo($admisionPostulantesa->postulante);

                //print_r($admisionPostulantesa->postulante."-".$postulante->nro_doc);

                $pdf = new PDF();
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->AddPage();
                $pdf->enablefooter = 'footerBlanco';

                $postulante = Publico::findFirstBycodigo($admisionPostulantesa->postulante);

                if ($postulante->sexo == '1') {
                    // print('Masculino');
                    // exit();
                    $pdf->Image('adminpanel/imagenes/certificados/enae_constancia_1.png', 0, 0, 212);
                } else if ($postulante->sexo == '2') {
                    // print('Femenino');
                    // exit();
                    $pdf->Image('adminpanel/imagenes/certificados/enae_constancia_2.png', 0, 0, 212);
                }
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 18);
                $pdf->ln(112);
                $nombres = mb_strtoupper($postulante->nombres, 'utf-8');
                $apellidop = mb_strtoupper($postulante->apellidop, 'utf-8');
                $apellidom = mb_strtoupper($postulante->apellidom, 'utf-8');
                $pdf->Cell(190, 5, $apellidop . ' ' . $apellidom . ' ' . $nombres, 0, 1, 'C');
                $pdf->ln(7);
                $pdf->Cell(67);

                $codigoPostulante = strlen($postulante->codigo);
                if ($codigoPostulante == 1) {

                    $newCodigo = '00000' . $postulante->codigo;
                } elseif ($codigoPostulante == 2) {
                    $newCodigo = '0000' . $postulante->codigo;
                } elseif ($codigoPostulante == 3) {
                    $newCodigo = '000' . $postulante->codigo;
                } elseif ($codigoPostulante == 4) {
                    $newCodigo = '00' . $postulante->codigo;
                } elseif ($codigoPostulante == 5) {
                    $newCodigo = '0' . $postulante->codigo;
                }

                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(27, 8, $newCodigo, 0, 1, 'C');

                $pdf->ln(1);
                $pdf->Cell(30);
                $pdf->Cell(120, 8, $postulante->institucion, 0, 1, 'L');

                $pdf->ln(14);
                $pdf->Cell(108);
                $pdf->Cell(20, 8, number_format($admisionPostulantesa->puntaje, 2), 0, 0, 'C');
                $pdf->Cell(50, 8, $this->convierte((int) $admisionPostulantesa->puntaje), 0, 1, 'C');
                $pdf->Ln();

                // print("Hola Mundo");
                // exit();

                $filename = "adminpanel/archivos/certificados/enae-2021-1/CONSTANCIA-ENAE-{$postulante->nro_doc}.pdf";
                // print($filename);
                // exit();

                $admisionM = Admision::findFirst("activo = 'M'");
                $admisionPostulantesArchivo = AdmisionPostulantesa::findFirst("admision = $admisionM->codigo AND postulante = $postulante->codigo");
                $admisionPostulantesArchivo->archivo = "CONSTANCIA-ENAE-{$postulante->nro_doc}.pdf";
                $admisionPostulantesArchivo->save();
                $pdf->Output($filename, 'F');

            }
            //exit();
            if ($admisionPostulante) {
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
