<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
require_once APP_PATH . '/app/library/pdf.php';

class ReporteswebController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Web');
        $this->view->setTemplateAfter('webindex');
        parent::initialize();
    }

    public function reporteGestiontramitedocumentarioDocumentosdetalleAction($id_doc= null, $fecha_inicio = null, $fecha_fin = null)
    {
        $this->view->disable();

        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 25, 'REGISTRO DE DOCUMENTOS DETALLES', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);


        $db = $this->db;
        $sql_query1 = "SELECT PUBLIC
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
        PUBLIC
        .tbl_doc_documentos.id_doc = $id_doc";
        $data1 = $db->fetchOne($sql_query1, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'FECHA ENVIO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$data1->fecha_envio}", 0, 0, 'L');

        $pdf->Cell(45);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'FECHA CARGO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$data1->fecha_cargo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'TIPO DE DOCUMENTO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$data1->tipo_documento}", 0, 0, 'L');

        $pdf->Cell(45);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'NRO DOCUMENTO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$data1->nro_documento}", 0, 0, 'L');

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'DESTINATARIO', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$data1->destinatario_personal}", 0, 0, 'L');

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(1);
        $pdf->Cell(41, 5, 'REMITENTE', 0, 0, 'L');
        $pdf->Cell(35, 5, "  : {$data1->remitente_nombres}", 0, 0, 'L');


        $pdf->Ln(10);

        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'FECHA', 'PROVEIDO', 'DESTINATARIO');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(15, 20, 20, 135);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 20, 20, 135));
        $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C'));

        //print($fecha_inicio."*".$fecha_fin);
        //exit();


        $where = "((CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";
        $db = $this->db;
        $sql_query2 = "
        SELECT
        id_doc_detalle,
        id_doc,
        fecha,
        proveido,
        destinatario,
        estado 
        FROM
        (
        SELECT PUBLIC
            .tbl_doc_documentos_detalles.id_doc_detalle,
            PUBLIC.tbl_doc_documentos_detalles.id_doc,
            to_char( PUBLIC.tbl_doc_documentos_detalles.fecha, 'DD/MM/YYYY' ) AS fecha,
            proveido.nombres AS proveido,
            CONCAT (
                PUBLIC.tbl_web_areas.nombres,
                ' - ',
                PUBLIC.tbl_web_personal.apellidop,
                ' ',
                PUBLIC.tbl_web_personal.apellidom,
                ' ',
                PUBLIC.tbl_web_personal.nombres 
            ) AS destinatario,
            PUBLIC.tbl_doc_documentos_detalles.estado 
            FROM
            PUBLIC.tbl_doc_documentos_detalles
            INNER JOIN PUBLIC.tbl_web_personal ON PUBLIC.tbl_web_personal.codigo = PUBLIC.tbl_doc_documentos_detalles.id_personal
            INNER JOIN PUBLIC.tbl_web_areas ON PUBLIC.tbl_web_areas.codigo = PUBLIC.tbl_doc_documentos_detalles.id_area
            INNER JOIN PUBLIC.a_codigos AS proveido ON proveido.codigo = PUBLIC.tbl_doc_documentos_detalles.id_proveido 
        WHERE
            proveido.numero = 66
        AND PUBLIC.tbl_doc_documentos_detalles.id_doc = $id_doc
        ) AS temporal_table 
        ORDER BY
        fecha DESC";

        //print($sql_query);
        //exit();

        $data2 = $db->fetchAll($sql_query2, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 8);
        
        foreach ($data2 as $key => $robot) {
            $pdf->row(array($key + 1, $robot->fecha, $robot->proveido, $robot->destinatario));
        }
        $pdf->Ln();
        $pdf->Output();

    }

}
