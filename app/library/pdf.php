<?php

require 'fpdf.php';

//require ('/../config/config.ini');
//$ini_array = parse_ini_file("/../config/config.ini");

class PDF extends FPDF
{

// Page header

    public $widths;
    public $aligns;

    public function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    public function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    public function RowNotap($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 5.5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            if ($i == 3) {
                if ($data[$i] <= 10) {
                    $this->SetTextColor(250, 0, 0);
                } else {
                    $this->SetTextColor(0, 0, 255);
                }
            } else {

                if ($i == 4) {

                    $dataez = explode("-", $data[$i]);
                    //echo "<pre> ";print_r($dataez) ; exit();

                    if ($dataez[0] <= 10) {
                        //$this->SetTextColor(250, 0, 0);
                    } else {
                        $this->SetTextColor(0, 0, 255);
                    }
                } else {
                    $this->SetTextColor(0);
                }
            }

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            if ($i == 4) {

                $dataez = explode("-", $data[$i]);
                $this->MultiCell($w, 5.5, $dataez[0], 0, $a);
            } else {
                $this->MultiCell($w, 5.5, $data[$i], 0, $a);
            }

            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->SetTextColor(0);
        $this->Ln($h);
    }

    function RowNotap2($data) {

    	//print("Cantidad:".count($data));
    	//exit();

        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 6.5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

        	//print($data[2]);

            if ($i == 3) {
                if ($data[$i] <= 10) {
                	//color rojo 
                    $this->SetTextColor(250, 0, 0);
                } else {
                	//color azul
                    $this->SetTextColor(0, 0, 255);
                }
            } else {

                if ($i == 4) {


                    $dataez = explode("-", $data[$i]);
                    //echo "<pre> ";print_r($dataez) ; exit();

                    if ($dataez[0] <= 10) {
                        //$this->SetTextColor(250, 0, 0);
                    } else {
                        $this->SetTextColor(0, 0, 255);
                    }
                } else {
                    $this->SetTextColor(0);
                }
            }

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            if ($i == 4) {

                $dataez = explode("-", $data[$i]);
                //imprime letras
                $this->MultiCell($w, 6.5, $dataez[0], 0, $a);
            } else {
            	//imprime numeros
                $this->MultiCell($w, 6.5, $data[$i], 0, $a);
            }
            

            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);

        }

        //exit();

        //Go to the next line
        $this->SetTextColor(0);
        $this->Ln($h);
    }

    public function RowNota($data)
    {
        //echo "<pre> ";
        //print_r($data);
        //exit();
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        //print count($data)-3; exit();
        for ($i = 0; $i < count($data); $i++) {
            if ($i >= 3 && $i <= (count($data) - 1)) {
                if ($data[$i] <= 10) {
                    //color rojo
                    $this->SetTextColor(250, 0, 0);
                } else {
                    //azul
                    $this->SetTextColor(0, 0, 255);
                }
            } else {

                //echo "<pre> ";
                //print_r($data[7]);
                //exit();

                //if($data[7] <= 10){
                //$this->SetTextColor(250, 0, 0);
                //}

                $this->SetTextColor(0);

            }

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            if ($i == (count($data) - 2)) {

                $dataez = explode("-", $data[$i]);
                $this->MultiCell($w, 5, $dataez[0], 0, $a);
            } else {
                $this->MultiCell($w, 5, $data[$i], 0, $a);
            }

            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->SetTextColor(0);
        $this->Ln($h);

    }

    public function RowNota2($data)
    {
        //echo "<pre> ";
        //print_r($data);
        //exit();
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 5.5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        //print count($data)-3; exit();
        for ($i = 0; $i < count($data); $i++) {
            if ($i >= 3 && $i <= (count($data) - 1)) {
                if ($data[$i] <= 10) {
                    //color rojo
                    $this->SetTextColor(250, 0, 0);
                } else {
                    //azul
                    $this->SetTextColor(0, 0, 255);
                }
            } else {

                //echo "<pre> ";
                //print_r($data[7]);
                //exit();

                //if($data[7] <= 10){
                //$this->SetTextColor(250, 0, 0);
                //}

                $this->SetTextColor(0);

            }

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            if ($i == (count($data) - 2)) {

                $dataez = explode("-", $data[$i]);
                $this->MultiCell($w, 5.5, $dataez[0], 0, $a);
            } else {
                $this->MultiCell($w, 5.5, $data[$i], 0, $a);
            }

            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->SetTextColor(0);
        $this->Ln($h);

    }

    public function RowNotaPr($data, $line_number)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            if ($i > 2) {
                if ($data[$i] <= 10) {
                    $this->SetTextColor(250, 0, 0);
                } else {
                    $this->SetTextColor(0, 0, 255);
                }
            } else {

            }

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text

            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->SetTextColor(0);
        $this->Ln($h);
    }

    public function Row($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    public function Row2($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 5.5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5.5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    
    public function Row3($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = 2.5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 2.5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    public function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }

    }

    public function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }

        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") {
            $nb--;
        }

        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }

            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }

                } else {
                    $i = $sep + 1;
                }

                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }

        }
        return $nl;
    }

    public function Header()
    {
        // Logo
        //$this->Image('helpdesk.png', 10, 6, 30);
        // Arial bold 15
    }

// Page footer
    public function Footer()
    {

        if (!empty($this->enablefooter)) {
            call_user_func($this->enablefooter, $this);
        } else {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            //$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
            $year = date("Y");
            $this->Cell(0, 10, 'UNCA - ' . $year, 0, 0, 'C');
        }
    }

// Load data
    public function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line) {
            $data[] = explode(';', trim($line));
        }

        return $data;
    }

// Simple table
    public function BasicTables($header, $data)
    {
        // Header
        $this->SetFont('Arial', 'B', 8);
        foreach ($header as $jey => $col) {
            if ($jey == 2) {
                $this->Cell(25, 7, $col, 1, 0, 'L');
            } else {
                if ($jey == 1) {
                    $this->Cell(20, 7, $col, 1, 0, 'C');
                } else {

                    $this->Cell(145, 7, $col, 'L,B', 0, 'C');
                }
            }
        }

        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(95, 6, $col, 1);
            }

            $this->Ln();
        }
    }

    public function BasicTable($header, $data)
    {
        // Header
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }

        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(40, 6, $col, 1);
            }

            $this->Ln();
        }
    }

// Better table
    public function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }

        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

// Colored table
    public function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }

        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

function footer2($pdf)
{
    $pdf->SetY(-15);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Pagina ' . $pdf->PageNo(), 0, 0, 'C');

    // Position at 1.5 cm from bottom
    //$this->SetY(-15);
    // Arial italic 8
    //$this->SetFont('Arial', 'I', 8);
    // Page number
    //$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

function footer3($pdf)
{

    $pdf->SetY(-20);
    $pdf->SetFont('Arial', '', 8);

    $pdf->Cell(45, 5, '________________________________', 0, 0, 'L');
    $pdf->Cell(100, 5, "                              ", 0, 0, 'L');
    $pdf->Cell(45, 5, "________________________________", 0, 0, 'R');
    $pdf->Ln();

    $pdf->Cell(45, 2, '                              ', 0, 0, 'L');
    $pdf->Cell(100, 2, "                              ", 0, 0, 'L');
    $pdf->Cell(45, 2, "DOCENTE", 0, 1, 'C');
    $pdf->Ln(2.5);

    $year = date("Y");
    $pdf->Cell(190, 5, 'UNCA - ' . $year, 0, 0, 'C');

    // Position at 1.5 cm from bottom
    //$this->SetY(-15);
    // Arial italic 8
    //$this->SetFont('Arial', 'I', 8);
    // Page number
    //$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

class PDF_Dash extends FPDF
{

    public function SetDash($black = null, $white = null)
    {
        if ($black !== null) {
            $s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
        } else {
            $s = '[] 0 d';
        }

        $this->_out($s);
    }

}
