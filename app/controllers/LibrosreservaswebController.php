<?php

class LibrosreservaswebController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/librosreservasweb.js?v=" . uniqid());
    }

    public function registroAction() {
        //aca va salir los aceptado y rechazados diferentes de pendientes estado <> P
        $this->assets->addJs("adminpanel/js/modulos/librosreservasweb.registro.js?v=" . uniqid());
    }

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("pk, alumno, docente, publico, lector, codigo_lector, fecha_reserva, prestamo");
            $datatable->setFrom("view_prestamos_solicitudes");
            $datatable->setWhere("tipo = 1");
            $datatable->setOrderby("prestamo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatableregistroAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);

            switch ($this->session->get("auth")["perfil"]) {

                case($this->session->get("auth")["perfil"] == 3):
                    $datatable->setColumnaId("p.id_libro_prestamo");
                    $datatable->setSelect("l.titulo AS titulo,
                        p.fecha_reserva AS fecha_reserva,
                        p.estado as estado");
                    $datatable->setFrom("tbl_lib_libros_prestamos AS p
                        INNER JOIN tbl_lib_libros_prestamos_detalles AS dp ON p.id_libro_prestamo = dp.id_prestamo
                        INNER JOIN tbl_lib_libros AS l ON l.id_libro = dp.id_libro
                        INNER JOIN alumnos AS al ON al.codigo = p.codigos");
                    $datatable->setWhere("p.codigos = '{$this->session->get("auth")["codigo"]}' AND p.alumno = '1' AND p.estado = 1");
                    $datatable->setOrderby("p.id_libro_prestamo DESC");
                    $datatable->setParams($_POST);
                    break;

                case($this->session->get("auth")["perfil"] == 4):
                    //print("@KenMack");
                    //exit();
                    $datatable->setColumnaId("p.id_libro_prestamo");
                    $datatable->setSelect("l.titulo AS titulo,
                        p.fecha_reserva AS fecha_reserva,
                        p.estado as estado");
                    $datatable->setFrom("tbl_lib_libros_prestamos AS p
                        INNER JOIN tbl_lib_libros_prestamos_detalles AS dp ON p.id_libro_prestamo = dp.id_prestamo
                        INNER JOIN tbl_lib_libros AS l ON l.id_libro = dp.id_libro
                        INNER JOIN docentes AS doc ON CAST(doc.codigo AS character varying) = p.codigos");
                    $datatable->setWhere("p.codigos = '{$this->session->get("auth")["codigo"]}' AND p.docente = '1' AND p.estado = 1");
                    $datatable->setParams($_POST);
                    break;

                case($this->session->get("auth")["perfil"] == 5):
                    $datatable->setColumnaId("p.id_libro_prestamo");
                    $datatable->setSelect("l.titulo AS titulo,
                        p.fecha_reserva AS fecha_reserva,
                        p.estado as estado");
                    $datatable->setFrom("tbl_lib_libros_prestamos AS p
                        INNER JOIN tbl_lib_libros_prestamos_detalles AS dp ON p.id_libro_prestamo = dp.id_prestamo
                        INNER JOIN tbl_lib_libros AS l ON l.id_libro = dp.id_libro
                        INNER JOIN publico AS pub ON CAST(pub.codigo AS character varying) = p.codigos");
                    $datatable->setWhere("p.codigos = '{$this->session->get("auth")["codigo"]}' AND p.publico = '1' AND p.estado = 1");
                    $datatable->setParams($_POST);
                    break;
            }

            $datatable->getJson();
        }
    }

   
    public function verAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

             $id_prestamo = (int) $this->request->getPost("id_prestamo", "int");

            $PrestamosDetalles = $this->modelsManager->createBuilder()
                    ->from('PrestamosDetalles')
                    ->columns('Libros.titulo, LibrosEjemplares.numero')
                    ->join('Libros', 'Libros.id_libro = PrestamosDetalles.id_libro')
                    ->join('LibrosEjemplares', 'LibrosEjemplares.id_ejemplar = PrestamosDetalles.id_ejemplar')
                    ->where("PrestamosDetalles.id_prestamo = $id_prestamo ")
                    ->getQuery()
                    ->execute();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("prestamos" => $PrestamosDetalles->toArray()));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function confirmaAction() {


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $codigo_prestamo = (int) $this->request->getPost("prestamo", "int");

                $Prestamo = PrestamosWeb::findFirst("id_libro_prestamo = " . $codigo_prestamo);
                $Prestamo->fecha_entrega = date('Y-m-d');
                if ($this->request->getPost("fecha_devolucion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_devolucion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $Prestamo->fecha_devolucion = date('Y-m-d', strtotime($fecha_new));
                }

                $Prestamo->estado = 2;

                if ($Prestamo->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Prestamo->getMessages());
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

    //rechazar
    public function rechazarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                
                $codigo_prestamo = (int) $this->request->getPost("prestamo_rechazado", "int");
        
                $Prestamo = PrestamosRechazados::findFirst("id_libro_prestamo = {$codigo_prestamo}");
                
                $Prestamo->fecha_entrega = date('Y-m-d');
                $Prestamo->observacion = $this->request->getPost("observacion", "string");
                $Prestamo->estado = 4;
                
                $PrestamosDetalles = PrestamosDetalles::findFirst("id_prestamo = {$codigo_prestamo}");
            
                $libro_activado = Libros::findFirst("id_libro = {$PrestamosDetalles->id_libro}");
                $libro_activado->activo = 1;
                
                $libro_activado->save();
                

                if ($Prestamo->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Prestamo->getMessages());
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

    public function reporteAction(){
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE LIBROS REGISTRADOS', 0, 0, 'C');
            // Line break
        $pdf->Ln(20);


            //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°','TIPO','LECTOR', 'FECHA PRÉSTAMO', 'FECHA DEVOLUCIÓN');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
            // Header
        $w = array(15, 20, 80, 37, 40);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
            $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 20, 80, 37, 40));
        $pdf->SetAligns(array('C', 'L','L', 'C', 'C'));

        $db = $this->db;
        $sqlQuery = "SELECT codigo_lector, lector, fecha_reserva, fecha_devolucion,alumno,docente,publico 
        FROM view_prestamos_solicitudes Order by pk";
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial','',8);
        foreach ($data as $key=>$robot) {
            if($robot->alumno=='1'){
                $tipo='ALUMNO';
            }
            if($robot->docente=='1'){
                $tipo='DOCENTE';
            }
            if($robot->publico=='1'){
                $tipo='PÚBLICO';
            }
            $fecha_explode_1 = explode(' ', $robot->fecha_reserva);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];

            if($robot->fecha_devolucion!=NULL){
            $fecha_explode_1 = explode(' ', $robot->fecha_devolucion);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado2 = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];
            }else{
                $fecha_resultado2='---------';
            }
            $pdf->row(array($key+1,$tipo,$robot->lector,$fecha_resultado,$fecha_resultado2));
        }
        $pdf->Ln();
        $pdf->Output();
        
    }

/* ------ Excel --------- */


}
