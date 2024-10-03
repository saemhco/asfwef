<?php
require_once APP_PATH . '/app/library/pdf.php';
class EditorialesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/editoriales.js?v=" . uniqid());
    }

    public function saveAction() {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_editorial", "int");
                $Editorial = Editoriales::findFirstByid_editorial($id);
                $Editorial = (!$Editorial) ? new Editoriales() : $Editorial;

                $Editorial->descripcion = $this->request->getPost("descripcion", "string");
                $estado = $this->request->getPost("estado", "string");
                $Editorial->estado = "A";

                if ($Editorial->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Editorial->getMessages());
                } else {
                    //Cuando va bien 

                    $id_editorial_nuevo = Editoriales::count();
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes","id_editorial_nuevo" => $id_editorial_nuevo));
                    
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Editorial = Editoriales::findFirstByid_editorial((int) $this->request->getPost("id_editorial", "int"));
            if ($Editorial) {
                $this->response->setJsonContent($Editorial->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Editorial = Editoriales::findFirstByid_editorial((int) $this->request->getPost("id_editorial", "int"));
            if ($Editorial && $Editorial->estado = 'A') {
                $Editorial->estado = 'X';
                $Editorial->save();
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

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_editorial");
            $datatable->setSelect("id_editorial, descripcion, estado");
            $datatable->setFrom("tbl_lib_editoriales");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("descripcion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    public function reporteAction() {
        $this->view->disable();
        $var = Editoriales::find(['order'=>'id_editorial']);
        //print count($libro); exit();


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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE EDITORIALES REGISTRADOS', 0, 0, 'C');
            // Line break
        $pdf->Ln(20);


            //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°','EDITORIALES','ESTADO');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
            // Header
        $w = array(15, 130, 35);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
            $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 130, 35));
        $pdf->SetAligns(array('C', 'L', 'C', 'C'));

        foreach ($var as $key=>$value) {
            if($value->estado='A'){
                $estado='Activo';
            }else{
                $estado='Inactivo';
            }
            $pdf->row(array($key+1, $value->descripcion, $estado));
        }
        $pdf->Ln();
        $pdf->Output();
    }

}
