<?php

require_once APP_PATH . '/app/library/pdf.php';


class ReportesController extends ControllerPanel
{


   

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        //$this->assets->addJs("adminpanel/js/modulos/reportes.js?v=" . uniqid());
    }


    //carne de postulante
    public function carnetpostulanteAction($postulante)
    {
        
        $this->view->disable();

        $admision_activo = Admision::findFirst("activo = 'M'");
        
        $codigo_postulante = $postulante;
        $datos_postulante = Postulantes::findFirstBycodigo($codigo_postulante);


        $datos_semestre = Semestres::findFirstBycodigo($admision_activo->semestre);
        
        $postulante = $Postulante->codigo;
        $admision_m = $admision_activo->codigo;

        
        $admision = AdmisionPostulantes::findFirst(
            [
                "postulante = $codigo_postulante AND admision = $admision_m",
            ]
        );


         //carrera
         $admision_carrera1 = $admision->carrera1;
         $carrera1 = Carreras::findFirst(
             [
                 "estado = 'A' AND codigo = '$admision_carrera1'",
             ]
         );
        
         $cod_desc =  Acodigos::findFirst(["numero=103 AND codigo=$admision->modalidad"]);
     
        $pdf = new PDF('L','mm','Letter');
        $pdf->AddPage();
        
        
        if ($datos_postulante->foto == null) {
            $pdf->Image('adminpanel/img/avatars/user.png', 95, 35, 20);
            $pdf->Image('adminpanel/img/avatars/user.png', 239, 35, 20);
        }
        else{
            $pdf->Image('adminpanel/imagenes/publico/'.$datos_postulante->foto, 95, 35, 20);
            $pdf->Image('adminpanel/imagenes/publico/'.$datos_postulante->foto, 239, 35, 20);
        }

        
        $pdf->Image('webpage/assets/img/logo_unca_1.png', 10, 5, 90);
        $pdf->Image('webpage/assets/img/dad_logo.jpg', 110, 5, 15);
        $pdf->Image('webpage/assets/img/logo_unca_1.png', 157, 5, 90);
        $pdf->Image('webpage/assets/img/dad_logo.jpg', 257, 5, 15);

        $pdf->Image('adminpanel/imagenes/admision/tijera.png', 135.5, 195, 7);

        $pdf->Image('adminpanel/imagenes/admision/para-postulante.jpg', 269, 115, 7);
        $pdf->Image('adminpanel/imagenes/admision/para-universidad.jpg', 129, 115, 7);

        $pdf->Ln(12);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->Line(139,0,139,195); //linea Vertical

        
        $pdf->SetFont('Arial', 'B', 10);    
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(117, 1, 'DIRECCIÓN DE ADMISIÓN - UNCA', 0, 0, 'C');
        $pdf->Cell(10, 1, '', 0, 0, 'C');
        $pdf->Cell(15, 1, '', 0, 0, 'C');        
        $pdf->Cell(117, 1, 'DIRECCIÓN DE ADMISIÓN - UNCA', 0, 0, 'C');
        $pdf->Cell(10, 1, '', 0, 0, 'C');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);        
        $pdf->SetTextColor(0,0,0); 
        $pdf->Cell(117, 5, 'CARNÉ DE POSTULANTE - DECLARACIÓN JURADA - '.$datos_semestre->descripcion, 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(15, 5, '', 0, 0, 'C');        
        $pdf->Cell(117, 5, 'CARNÉ DE POSTULANTE - DECLARACIÓN JURADA - '.$datos_semestre->descripcion, 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);        
        $pdf->SetTextColor(0,0,0); 
        $pdf->Cell(117, 5, '____________________________________________________________', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(15, 5, '', 0, 0, 'C');        
        $pdf->Cell(117, 5, '____________________________________________________________', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'CÓDIGO DE POSTULANTE:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $codigo_postulante, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'CÓDIGO DE POSTULANTE:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $codigo_postulante, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);


        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'DNI:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->nro_doc, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'DNI:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->nro_doc, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);


        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'APELLIDO PATERNO:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->apellidop, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'APELLIDO PATERNO:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->apellidop, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);

        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'APELLIDO MATERNO:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->apellidom, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'APELLIDO MATERNO:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->apellidom, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);


        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'NOMBRES:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->nombres, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'NOMBRES:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $datos_postulante->nombres, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);


        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $carrera1->descripcion, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $carrera1->descripcion, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);

        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'MODALIDAD:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $cod_desc->nombres, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'MODALIDAD:', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, $cod_desc->nombres, 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);


        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, 'DECLARACIÓN JURADA', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, 'DECLARACIÓN JURADA', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, '- La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, '- La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, '- Conozco y acepto todas las disposiciones del Reglamento General de Admisión al cual me someto.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, '- Conozco y acepto todas las disposiciones del Reglamento General de Admisión al cual me someto.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, '- En caso de alcanzar una vacante, me comprometo a cumplir con lo dispuesto en los artículos del', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, '- En caso de alcanzar una vacante, me comprometo a cumplir con lo dispuesto en los artículos del', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, '  33 al 38 del Reglamento General de Admisión.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, '  33 al 38 del Reglamento General de Admisión.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, 'DÍA DEL EXAMEN', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, 'DÍA DEL EXAMEN', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(8);

        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, '- Presentarse con este carné en el local que le corresponda rendir su Examen de Admisión.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, '- Presentarse con este carné en el local que le corresponda rendir su Examen de Admisión.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(38.5, 5, '- Portar el DNI original.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(24, 5, '', 0, 0, 'C');                
        $pdf->Cell(38.5, 5, '- Portar el DNI original.', 0, 0, 'L');
        $pdf->Cell(38.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(28);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x+69,$y-22);
        $pdf->MultiCell(25, 28, '', 1,'C',0);

        $pdf->SetXY($x+211,$y-22);
        $pdf->MultiCell(25, 28, '', 1,'C',0);
        
        
        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, '_________________________________________', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'L');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(15, 5, '', 0, 0, 'C');                
        $pdf->Cell(40, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, '_________________________________________', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, 'FIRMA DEL POSTULANTE', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, 'HUELLA DIGITAL', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(15, 5, '', 0, 0, 'C');                
        $pdf->Cell(40, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, 'FIRMA DEL POSTULANTE', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, 'HUELLA DIGITAL', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(22);


        $pdf->SetFont('Arial', '', 6);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, '_________________________________________', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '_______________________', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(15, 5, '', 0, 0, 'C');                
        $pdf->Cell(40, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, '_________________________________________', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, '_______________________', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 8);        
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, 'FIRMA DEL DOCENTE', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, 'AULA', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Cell(15, 5, '', 0, 0, 'C');                
        $pdf->Cell(40, 5, '', 0, 0, 'C');
        $pdf->Cell(28.5, 5, 'FIRMA DEL DOCENTE', 0, 0, 'C');
        $pdf->Cell(18.5, 5, '', 0, 0, 'L');
        $pdf->Cell(30, 5, 'AULA', 0, 0, 'C');
        $pdf->Cell(10, 5, '', 0, 0, 'C');
        $pdf->Ln(7);

        date_default_timezone_set('America/Mexico_City');

        $fechaActual = date("d/m/Y");
        $horaActual = date("g:i a");


        $pdf->SetFont('Arial', '', 7);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(117,4, '____________________________________________________________________________________', 0, 0, 'L');
        $pdf->Cell(23, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(117,4, '__________________________________________________________________________', 0, 0, 'L');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', '', 7);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'Huamachuco, '.$fechaActual.' '.$horaActual, 0, 0, 'L');        
        $pdf->Cell(78, 5, 'Oficina de Tecnologías de la Información - UNCA', 0, 0, 'R');
        $pdf->Cell(24, 5, '', 0, 0, 'C');        
        $pdf->SetFont('Arial', '', 8);        
        $pdf->SetTextColor(0,80,180);
        $pdf->Cell(38.5, 5, 'Huamachuco, '.$fechaActual.' '.$horaActual, 0, 0, 'L');
        $pdf->Cell(78.5, 5, 'Oficina de Tecnologías de la Información - UNCA', 0, 0, 'R');
        
        



        $pdf->Output();
        exit;
        
    }


    //reporte ficha de matricula
    public function reporteFichaMatriculaAction($semestre, $alumno)
    {
        $this->view->disable();

        $codigo_alumno = $alumno;
        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);

        $Carreras = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $Semestre = Semestres::findFirstBycodigo($semestre);

        //print $semestre->codigo;exit();

        $VAlumnosSemestre = VAlumnosSemestre::findFirstBycodigo($codigo_alumno);

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 48);
        // Arial bold 15
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
        $pdf->Cell(50, 5, ":   {$Carreras->descripcion}", 0, 0, 'L');

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
        //Footer
        $pdf->SetWidths(array(20, 15, 100, 15, 20, 20));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

        $semestre_m = $Semestre->codigo;

        //print("Codigo de alumno: ".$codigo_alumno." semestre: ".$semestre_m." semestre_docente: " .$semestre_m);
        //exit();

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
        $xAbrevIns = $this->config->global->xAbrevIns;
        $pdf->Cell(190, 10, $xAbrevIns . ' - ' . $anio, 0, 1, 'C');

        $pdf->SetXY(0, 140);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(200, 5, '-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 0, 0, 'C');

        //Otra hoja
        $pdf->Ln(12);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 153, 48);
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
        $pdf->Cell(50, 5, ":   {$Carreras->descripcion}", 0, 0, 'L');

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

        //Footer
        $pdf->SetWidths(array(20, 15, 100, 15, 20, 20));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

        $semestre_m = $Semestre->codigo;

        $ficha_copia = VFicha::find("codigo = '{$codigo_alumno}' AND semestre = {$semestre_m} AND semestre_docente = {$semestre_m}");

        $num_cursos_ficha_copia = count($ficha_copia);
        $sum_creditos_copia = 0;
        foreach ($ficha_copia as $key => $value) {
            $sum_creditos_copia = $sum_creditos_copia + (int) $value->creditos;
            $pdf->row(array($value->asignatura_code, $value->ciclo, $value->nombre, $value->grupo, $value->tipo_matricula_abrev, $value->creditos));
        }
        //$pdf->row(array("xsa","asd","asd","asd","<d"));

        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();

        //$header = array('  TOTAL DE ASIGNATURAS :  ' . $num_cursos, 'TOTAL CREDITOS  ', '' . $sum_creditos);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(135, 5, 'TOTAL DE ASIGNATURAS: ' . $num_cursos_ficha_copia, 1, 0, 'C');
        $pdf->Cell(55, 5, 'TOTAL CREDITOS: ' . $sum_creditos_copia, 1, 1, 'C');

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
    public function reporteBoletaNotasPromedioAction($semestre, $alumno)
    {
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
            $prom_sum = $prom_sum + ($value->pf * $value->creditos);
            $pdf->row2(array($value->asignatura, $value->ciclo, $value->nombre, $value->creditos, $value->pf));
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
    public function reporteAlumnoConvalidiacionesAction($alumno)
    {
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
            $prom_sum = $prom_sum + ($value->pf * $value->creditos);
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

    public function reporteAsistenciasAction($semestre, $curso, $asistencia)
    {

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
                "estado = 'A'  AND numero = 55 AND codigo = {$DocentesAsignaturasDetalle->modalidad}",
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
    public function reporteRegistroAuxiliarAction($semestrex, $curso, $grupo)
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
        $pdf->Output();

        exit;
    }

    //reporte carga academica
    public function reporteCargaAcademicaAction($semestre)
    {
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
    public function reporteActaInicialAction($semestrex, $curso, $grupo)
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
        $pdf->Cell(51, 1, 'Huamachuco, ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

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
    public function convierte($numero)
    {
        $numero = (int) $numero;
        if ($numero < 0) {
            //print("Promedio Final: ".$numero);
            //exit();
            $numero = abs($numero * 0);
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

    public function reporteRegistroNotasAction($semestrex, $curso, $grupo)
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
        $pdf->Cell(51, 1, 'Huamachuco, ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

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
    public function reporteactafinalAction($semestrex, $curso, $grupo)
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
            $pdf->RowNotap(array(
                $crece, $value->alumno, $value->apellidos . " " . $value->nombres,
                $value->pf, $this->convierte((int) $value->pf)
            ));
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 0, 'L');

        $pdf->Ln(25);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(140);
        $pdf->Cell(51, 1, 'Huamachuco, ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 0, 'R');

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
    public function reporteEncuestasAction($id)
    {
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
        $pdf->Image('webpage/assets/img/logo-vr.png', 120, 10, 54);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 12);
        // Title
        $pdf->Cell(190, 15, 'FORMATO 1. PARA ESTUDIANTES POR CURSO', 1, 0, 'L');
        // Line break
        $pdf->Ln(16);

        //Titulo
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(190, 8, 'ENCUESTA DE EVALUACIÓN DE DESEMPEÑO DOCENTE POR ESTUDIANTES', 0, 0, 'C');
        $pdf->Ln(6);

        //Subtitulos
        $pdf->SetFont('Arial', '', 9);
        $encuestas = Encuestas::findFirstByid_encuesta((int) 1);

        $pdf->Multicell(190, 4, $encuestas->indicaciones, 0, 'L', 0);

        //$pdf->Multicell(190, 5, 'Al estudiante se le solicita ser justo, responsable y explícito en sus respuestas.' . "\n", 0, 'L', 0);
        $pdf->Ln(2);

        //Datos generales
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 5, 'DATOS GENERALES:', 0, 1, 'L');

        //Nombre del curso
        //Consultamos alumnos_encuestas con el codigo de alumnos_encuestas (datatables)
        $encuestasAlumnos = EncuestasAlumnos::findFirstByid_encuesta_alumno($id);
        $asignatura = Asignaturas::findFirstBycodigo($encuestasAlumnos->id_asignatura);


        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'NOMBRE DEL CURSO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$asignatura->nombre}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'GRUPO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$encuestasAlumnos->id_grupo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(50, 5, 'CICLO ACADEMICO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$asignatura->ciclo}", 0, 0, 'L');
        $pdf->Ln();




        //echo "<pre>";        print_r($encuestasAlumnos->asignatura);exit();
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
            Asignaturas.codigo = '{$encuestasAlumnos->id_asignatura}'
            AND DocentesAsignaturas.semestre = {$semestre->codigo}
            AND DocentesAsignaturas.grupo = {$encuestasAlumnos->id_grupo}");
        $docente_result = $docente->execute();



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
            ->from('Encuestas')
            ->columns('TipoPreguntas.codigo,
                        TipoPreguntas.nombres')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->getQuery()
            ->execute();


        //Pregunta
        $preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    Encuestas.descripcion,
                    TipoPreguntas.codigo,
                    TipoPreguntas.descripcion AS tipo_pregunta,
                    EncuestasPreguntas.id_encuesta_pregunta AS codigo_pregunta,
                    EncuestasPreguntas.descripcion AS pregunta,
                    RespuestasAlumnos.id_encuesta_alumno,
                    RespuestasAlumnos.valor, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('RespuestasAlumnos', 'RespuestasAlumnos.id_encuesta_pregunta = EncuestasPreguntas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36 AND RespuestasAlumnos.id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno")
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();





        foreach ($tipo_de_pregunta as $tipo_de_pregunta_query) {
            //echo "<pre>";
            //print_r($docente_query->nombres);
            $pdf->Cell(190, 5, "$tipo_de_pregunta_query->nombres", 1, 1, 'C');
            //Tipo de pregunta
            $codigo_tipo_pregunta = $tipo_de_pregunta_query->codigo;

            foreach ($preguntas as $encuestas_model_query) {
                if ($encuestas_model_query->codigo == $codigo_tipo_pregunta) {

                    //Pregunta
                    $pdf->Cell(10, 5, "$encuestas_model_query->numero", 1, 0, 'L');
                    $pdf->Cell(150, 5, "$encuestas_model_query->pregunta", 1, 0, 'L');
                    $pdf->Cell(30, 5, "$encuestas_model_query->valor", 1, 1, 'C');
                }
            }

            //exit();
        }

        // print("Llega XD");
        // exit();


        $pdf->Cell(90, 5, '¿Le gustaria llevar otra asignatura con el docente?', 0, 0, 'L');
        if ($encuestasAlumnos->chk_like == '0') {
            $respuestaLike = 'No';
        } elseif ($encuestasAlumnos->chk_like == '1') {
            $respuestaLike = 'Si';
        } else {
            $respuestaLike = '';
        }
        $pdf->Cell(100, 5, $respuestaLike, 0, 1, 'L');

        $pdf->Cell(90, 5, 'Comentario o recomendaciones: ' . $encuestasAlumnos->recomendacion, 0, 0, 'L');

        $pdf->Ln(12);

        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
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
        $pdf->Ln(4);
        $pdf->Ln(8);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');
        $pdf->Output();
    }

    //reporte admision registro
    public function reporteAdmisionRegistroAction($id = null)
    {
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
                "postulante = $postulante AND admision = $admision_m",
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
                "estado = 'A' AND numero = 21 AND codigo = $admision_modalidad",
            ]
        );

        //fin
        //carrea1
        $admision_carrera1 = $AdmisionPostulantes->carrera1;
        $carrera1 = Carreras::findFirst(
            [
                "estado = 'A' AND codigo = '$admision_carrera1'",
            ]
        );
        //fin
        //carrea2
        $admision_carrera2 = $AdmisionPostulantes->carrera2;
        $carrera2 = Carreras::findFirst(
            [
                "estado = 'A' AND codigo = '$admision_carrera2'",
            ]
        );
        //fin

        $pdf = new PDF();
        //para bordees
        $pdf = new PDF_Dash();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 34);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);
        // Move to the right
        //$pdf->Cell(10);
        // Title
        $pdf->Cell(190, 10, '  FICHA DE INSCRIPCIÓN - DECLARACIÓN JURADA', 1, 0, 'L');
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

        $pdf->SetLineWidth(0.5);
        $pdf->SetDash(2, 2); //4mm on, 2mm off
        $pdf->Rect(110, 155, 90, 130);
        $pdf->SetDash(); //restores no dash

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

        $pdf->Output();
        exit;
    }

    //reporte ficha socioeconomica
    public function reporteFichaSocioeconomicaAction($sem, $alumno_id)
    {
        $this->view->disable();

        $codigo_alumno = $alumno_id;

        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);
        $semestre = SemestreAlumnos::findFirstBycodigo($sem);

        if (empty(AlumnosFicha::findFirst("alumno='{$codigo_alumno}' AND semestre = {$semestre->codigo} "))) {
            echo "<pre>";
            print_r("No se registraron datos en el tap ficha " . $sem);
            exit();
        } else {
            $alumnos_ficha = AlumnosFicha::findFirst("alumno='{$codigo_alumno}' AND semestre = {$semestre->codigo} ");
        }

        $carrea = Carreras::findFirstBycodigo($dato_alumno->carrera);

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

        if ($dato_alumno->region1 and $dato_alumno->provincia1 and $dato_alumno->region1 != null) {
            $region1 = Regiones::findFirst("id='{$dato_alumno->region1}'");
            $provincia1 = Provincias::findFirst("region='{$dato_alumno->region1}' AND provincia='{$dato_alumno->provincia1}'");
            $distrito1 = Distritos::findFirst("region='{$dato_alumno->region1}' AND provincia='{$dato_alumno->provincia1}' AND distrito='{$dato_alumno->distrito1}'");

            $pdf->Cell(190, 5, 'h) Lugar de Procedencia: ' . $dato_alumno->region1 . ":" . $region1->descripcion . " - " . $dato_alumno->provincia1 . ":" . $provincia1->descripcion . " - " . $dato_alumno->distrito1 . ":" . $distrito1->descripcion, 1, 1, 'L');
        } else {

            $region1_vacio = "";
            $provincia1_vacio = "";
            $distrito1_vacio = "";

            $pdf->Cell(190, 5, 'h) Lugar de Procedencia: ' . $dato_alumno->region1 . ":" . $region1_vacio . " - " . $dato_alumno->provincia1 . ":" . $provincia1_vacio . " - " . $dato_alumno->distrito1 . ":" . $distrito1_vacio, 1, 1, 'L');
        }

        //Direccion actual
        $pdf->Cell(190, 5, 'i) Dirección Actual: ' . $dato_alumno->direccion, 1, 1, 'L');

        //Lugar de procedencia

        if ($dato_alumno->region and $dato_alumno->provincia and $dato_alumno->region != null) {

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

        $pdf->Cell(68, 5, 'r) Seguro de Salud: ' . $seguro_alumno->nombres, 1, 0, 'L');

        //Trabaja
        if ($dato_alumno->sitrabaja == null or $dato_alumno->sitrabaja == 0) {
            $pdf->Cell(57, 5, 's) Trabaja: NO', 1, 1, 'L');
        } else {
            $pdf->Cell(57, 5, 's) Trabaja: SI', 1, 1, 'L');
        }

        //Lugar donde trabaja
        $pdf->Cell(190, 5, 't) Lugar/Inst. donde labora:' . $dato_alumno->sitrabaja_nombre, 1, 1, 'L');

        //Padece discapacidad

        if ($dato_alumno->discapacitado == null or $dato_alumno->discapacitado == 0) {
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
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

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

        foreach ($ficha_alumno as $key => $value) {
            //$sum_creditos = $sum_creditos + (int) $value->creditos;
            $pdf->row(array(
                $value->parentesco,
                $value->apellido_paterno . ' ' . $value->apellido_materno . ' ' . $value->nombres,
                $value->sexo, $value->edad, $value->estado_civil, $value->grado_instruccion,
                $value->ocupacion, $value->ingresos
            ));
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
        // if ($alumnos_ficha->techo_material == null) {

        //     $techo_material = "";
        //     $pdf->Cell(121, 5, 'Material techo vivienda: ' . $techo_material, 1, 1, 'L');
        // } else {
        //     $techo_material = MaterialTechoViviendas::findFirst("numero = 32 AND codigo={$alumnos_ficha->techo_material}");
        //     $pdf->Cell(121, 5, 'Material techo vivienda: ' . $techo_material->nombres, 1, 1, 'L');
        // }

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

            $es_principal = AlumnosFamiliares::findFirst("alumno='{$dato_alumno->codigo}' AND es_principal='1'");

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
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

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
            $pdf->row(array(
                $value->parentesco,
                $value->apellido_paterno . ' ' . $value->apellido_materno . ' ' . $value->nombres, $value->enfermedad_nombre,
                $value->enfermedad_tiempo, $tratamiento, $value->tratamiento_lugar
            ));
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
    public function reporteEtiquetaAction($codigo)
    {
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
    public function reporteFichaAction($codigo)
    {
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

        $header = array('Nº registro', 'Signatura', 'Título');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(20, 30, 80);
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

    public function reporteCurriculumVitaeAction($publico = null, $datos_personales = null, $formacion = null, $capacitaciones = null, $experiencia = null)
    {

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

                if ($Publico->foto) {
                    $pdf->Image('adminpanel/imagenes/publico/' . $Publico->foto, 90, 25, 30);
                }

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
            print($publico);
            exit();
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
                // echo '<pre>';
                // print_r($ConvocatoriasPublicoFormacion->nombre_grado);
                // exit();
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
            $pdf->Cell(80, 5, '_____________________', 0, 0, 'C');
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

    public function reporteCurriculumVitaePublicoAction($publico = null, $datos_personales = null, $formacion = null, $capacitaciones = null, $experiencia = null)
    {

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

                if ($Publico->foto) {
                    // print($Publico->foto);
                    // exit();
                    $pdf->Image('adminpanel/imagenes/publico/' . $Publico->foto, 90, 25, 30);
                }

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
        //$filename="adminpanel/archivos/convocatorias_publico/cvs/test.pdf";
        //$pdf->Output($filename,'F');
        //exit();
    }

    public function curriculumVitaePublico2Action($publico = null, $datos_personales = null, $datos_generales = null, $chcti = null,$excepciones = null, $formacion = null, $capacitaciones = null,$publicaciones = null, $experiencia = null, $cargos = null, $materiales = null, $idiomas = null, $asesorias = null, $extension = null)
    {

        $this->view->disable();

        //echo '<pre>';
        //print_r($_POST);
        //exit();
        //$Publico = Publico::findFirstBycodigo($publico);
        // print ("Publicaciones:" . $publicaciones);
        // exit();

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


            $PublicoSql = $this->modelsManager->createQuery("SELECT publico.codigo,publico.id_bonificacion, publico.nacionalidad,publico.tipo, publico.apellidop, publico.apellidom,
        publico.nombres, publico.sexo, publico.fecha_nacimiento, publico.documento, publico.nro_doc, publico.nro_ruc, publico.seguro, publico.telefono,
        publico.celular, publico.email, publico.direccion, publico.ciudad, publico.observaciones, publico.foto, publico.colegio_publico,
        publico.colegio_nombre, publico.sitrabaja, publico.sitrabaja_nombre, publico.sidepende, publico.sidepende_nombre, publico.estado,
        publico.region, publico.provincia, publico.distrito, publico.ubigeo, publico.region1, publico.provincia1, publico.distrito1, publico.ubigeo1,
        publico.localidad, publico.discapacitado, publico.discapacitado_nombre, publico.password, publico.archivo,publico.estado_civil, publico.archivo_cp, publico.archivo_ruc, publico.archivo_dc, publico.sobre_ti, publico.voluntariado,
        publico.expectativas, publico.fecha_emision_dni, tipo_documento.nombres AS nombre_tipo_documento, estado_civil.nombres AS nombre_estado_civil, sexos.nombres AS nombre_sexo,
        regiones.descripcion AS nombre_region, provincias.descripcion AS nombre_provincia, distritos.descripcion AS nombre_distrito, tipo_bonifiaccion.nombres AS tipo_bonificacion, publico.archivo_discapacitado,
        publico.archivo_fa, publico.archivo_dar, publico.archivo_renacyt
        FROM Publico publico
        INNER JOIN TipoDocumento tipo_documento ON publico.documento = tipo_documento.codigo
        INNER JOIN EstadoCivil estado_civil ON publico.estado_civil = estado_civil.codigo
        INNER JOIN TipoBonificaciones tipo_bonifiaccion ON publico.id_bonificacion = tipo_bonifiaccion.codigo
        INNER JOIN Sexo sexos ON CAST (publico.sexo AS INTEGER) = sexos.codigo
        INNER JOIN Regiones regiones ON publico.region = regiones.region
        INNER JOIN Provincias provincias ON publico.provincia = provincias.provincia AND publico.region = provincias.region
        INNER JOIN Distritos distritos ON publico.distrito = distritos.distrito AND publico.provincia = distritos.provincia AND publico.region = distritos.region
        WHERE publico.codigo = {$publico} AND tipo_documento.numero = 1 AND estado_civil.numero = 26 AND sexos.numero = 3 AND tipo_bonifiaccion.numero = 134");
            $PublicoResult = $PublicoSql->execute();

            foreach ($PublicoResult as $Publico) {


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(174, 9, 'DATOS PERSONALES', 0, 0, 'L');
                $pdf->Ln(10);

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Apellidos y Nombres', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(190, 6, "{$Publico->apellidop} {$Publico->apellidom} {$Publico->nombres}", 0, 1, 'L');

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
                $pdf->Cell(40, 6, 'Nacionalidad', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->nacionalidad}", 0, 1, 'L');

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
                $pdf->Cell(40, 6, 'Bonificación', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$Publico->tipo_bonificacion}", 0, 1, 'L');

                if ($Publico->id_bonificacion !== 1) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 6, 'Enlace Bonificación', 0, 0, 'L');
                    $pdf->Cell(14, 6, ':', 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 10);
                } 

                if ($Publico->id_bonificacion == 2) {
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_discapacitado}", 0, 1, 'L');

                }

                if ($Publico->id_bonificacion == 3) {
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_fa}", 0, 1, 'L');

                }

                if ($Publico->id_bonificacion == 4) {
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_dar}", 0, 1, 'L');

                }

                if ($Publico->id_bonificacion == 5) {
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/personales/{$Publico->archivo_renacyt}", 0, 1, 'L');

                }

                $pdf->Ln(4);
            }
        }

        $convocatoria = Convocatorias::findFirst("estado = 'A' and (etapa = 1 or etapa = 2) and tipo = 2");
        $convocatoria_m = $convocatoria->id_convocatoria;

        $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
            [
                "publico = $publico AND convocatoria = $convocatoria_m",
            ]
        );



        if ($datos_generales == "A"){
            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'DATOS GENERALES', 0, 0, 'L');
            $pdf->Ln(10);

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'Solicitud de inscripción y postulación (Anexo 03):', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_solicitud}", 0, 1, 'L');

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'DNI vigente:', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_dni}", 0, 1, 'L');

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'Sílabo de las asignaturas:', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_silabo}", 0, 1, 'L');

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'Declaración Jurada. (Anexo 02):', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_dj}", 0, 1, 'L');
        }

        if ($chcti == "A"){
            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'COLEGIATURA, HABILITACIÓN, CTI', 0, 0, 'L');
            $pdf->Ln(10);

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'Colegiatura:', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_colegiatura}", 0, 1, 'L');

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'Habilitación:', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_habilitacion}", 0, 1, 'L');

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(40, 6, 'CTI:', 0, 1, 'L');
            $pdf->Cell(16);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(174, 6, "{$this->config->global->xWebIns}/adminpanel/archivos/convocatorias_publico/{$ConvocatoriasPublico->archivo_cti}", 0, 1, 'L');

        }

        if ($excepciones == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_excepciones.codigo,
            public.tbl_web_publico_excepciones.publico,
            public.tbl_web_publico_excepciones.id_tipo_excepcion,
            public.tbl_web_publico_excepciones.nombre,
            to_char(public.tbl_web_publico_excepciones.fecha_excepcion, 'DD/MM/YYYY') AS fecha_excepcion,
            public.tbl_web_publico_excepciones.institucion,
            public.tbl_web_publico_excepciones.archivo,
            public.tbl_web_publico_excepciones.imagen,
            public.tbl_web_publico_excepciones.estado,
            public.tbl_web_publico_excepciones.nro_doc,
            tipodepublicaciones.nombres AS tipo_publicacion
            FROM
            public.tbl_web_publico_excepciones
            INNER JOIN public.a_codigos AS tipodepublicaciones ON tipodepublicaciones.codigo = public.tbl_web_publico_excepciones.id_tipo_excepcion
            WHERE
            tipodepublicaciones.numero = 136 AND public.tbl_web_publico_excepciones.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'PARA EVALUAR POR EXCEPCIÓN', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {
                //echo '<pre>';
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tipo de Excepcion', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tipo_publicacion}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                //$pdf->Cell(120, 6, "{$PublicoFormacion->nombre}", 0, 1, 'L');
                $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $format_f_f = explode(" ", $dataValue->fecha_excepcion);
                $fotmat_f_f_r = explode("-", $format_f_f[0]);
                $fotmat_f_f_r_r = $fotmat_f_f_r[2] . "/" . $fotmat_f_f_r[1] . "/" . $fotmat_f_f_r[0];
                $pdf->Cell(120, 6, "{$fotmat_f_f_r_r}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Institucion', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->institucion}", 0, 1, 'L');



                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/excepciones/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
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
            $pdf->Cell(174, 9, 'GRADOS ACADÉMICOS Y TÍTULOS PROFESIONALES', 0, 0, 'L');
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
            $pdf->Cell(174, 9, 'ACTUALIZACIONES Y CAPACITACIONES', 0, 0, 'L');
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

        if ($publicaciones == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_publicaciones.codigo,
            public.tbl_web_publico_publicaciones.publico,
            public.tbl_web_publico_publicaciones.id_tipo_publicacion,
            public.tbl_web_publico_publicaciones.nombre,
            to_char(public.tbl_web_publico_publicaciones.fecha_publicacion, 'DD/MM/YYYY') AS fecha_publicacion,
            public.tbl_web_publico_publicaciones.doi,
            public.tbl_web_publico_publicaciones.pais,
            public.tbl_web_publico_publicaciones.archivo,
            public.tbl_web_publico_publicaciones.imagen,
            public.tbl_web_publico_publicaciones.estado,
            public.tbl_web_publico_publicaciones.nro_paginas,
            public.tbl_web_publico_publicaciones.nro_doc,
            tipo_de_publicaciones.nombres AS tipo_publicacion
            FROM
            public.a_codigos AS tipo_de_publicaciones
            INNER JOIN public.tbl_web_publico_publicaciones ON tipo_de_publicaciones.codigo = public.tbl_web_publico_publicaciones.id_tipo_publicacion
            WHERE
            tipo_de_publicaciones.numero = 135 AND public.tbl_web_publico_publicaciones.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'TRABAJOS DE INVESTIGACIÓN Y PUBLICACIONES', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {

   
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tipo de Publicacion', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tipo_publicacion}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha Publicacion', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "$dataValue->fecha_publicacion", 0, 1, 'L');

                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/publicaciones/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
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
            $pdf->Cell(174, 9, 'EXPERIENCIA ACADÉMICA Y PROFESIONAL', 0, 0, 'L');
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

        if ($cargos == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_cargos.codigo,
            public.tbl_web_publico_cargos.tipo_institucion,
            public.tbl_web_publico_cargos.nombre,
            public.tbl_web_publico_cargos.institucion,
            to_char(public.tbl_web_publico_cargos.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(public.tbl_web_publico_cargos.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            public.tbl_web_publico_cargos.archivo,
            public.tbl_web_publico_cargos.estado,
            tipodecargos.nombres AS tipo_cargo
            FROM
            public.tbl_web_publico_cargos
            INNER JOIN public.a_codigos AS tipodecargos ON tipodecargos.codigo = public.tbl_web_publico_cargos.id_tipo_cargo
            WHERE
            tipodecargos.numero = 68 AND public.tbl_web_publico_cargos.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'CARGOS DIRECTIVOS O APOYO ADMINISTRATIVO', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {

   
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tipo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tipo_cargo}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha Inicio', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "$dataValue->fecha_inicio", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha Fin', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "$dataValue->fecha_fin", 0, 1, 'L');

                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/cargos/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
        }

        
        if ($materiales == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_materiales.codigo,
            tipo_de_materiales.nombres AS tipo_material,
            public.tbl_web_publico_materiales.publico,
            public.tbl_web_publico_materiales.id_tipo_material,
            public.tbl_web_publico_materiales.nombre,
            to_char(public.tbl_web_publico_materiales.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_materiales.archivo,
            public.tbl_web_publico_materiales.imagen,
            public.tbl_web_publico_materiales.nro_doc,
            public.tbl_web_publico_materiales.estado
            FROM
            public.a_codigos AS tipo_de_materiales
            INNER JOIN public.tbl_web_publico_materiales ON public.tbl_web_publico_materiales.id_tipo_material = tipo_de_materiales.codigo
            WHERE
            tipo_de_materiales.numero = 133 AND public.tbl_web_publico_materiales.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'ELABORACIÓN DE MATERIALES DE ENSEÑANZA', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {

   
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tipo de Material', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tipo_material}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "$dataValue->fecha", 0, 1, 'L');


                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/materiales/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
        }

        if ($idiomas == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_idiomas.codigo,
            tipodeidiomas.nombres AS tipo_idioma,
            public.tbl_web_publico_idiomas.publico,
            public.tbl_web_publico_idiomas.id_tipo_idioma,
            public.tbl_web_publico_idiomas.nombre,
            to_char(public.tbl_web_publico_idiomas.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char(public.tbl_web_publico_idiomas.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            public.tbl_web_publico_idiomas.institucion,
            public.tbl_web_publico_idiomas.pais,
            public.tbl_web_publico_idiomas.id_nivel,
            public.tbl_web_publico_idiomas.horas,
            public.tbl_web_publico_idiomas.creditos,
            public.tbl_web_publico_idiomas.archivo,
            public.tbl_web_publico_idiomas.imagen,
            public.tbl_web_publico_idiomas.nro_doc,
            public.tbl_web_publico_idiomas.estado
            FROM
            public.a_codigos AS tipodeidiomas
            INNER JOIN public.tbl_web_publico_idiomas ON tipodeidiomas.codigo = public.tbl_web_publico_idiomas.id_tipo_idioma
            WHERE
            tipodeidiomas.numero = 49 AND public.tbl_web_publico_idiomas.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'CONOCIMIENTO DE IDIOMAS', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {

   
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tipo', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tipo_idioma}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->nombre}", 0, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha Inicio', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "$dataValue->fecha_inicio", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha Fin', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "$dataValue->fecha_fin", 0, 1, 'L');


                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/idiomas/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
        }

        if ($asesorias == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_asesorias.codigo,
            tipo_grado.nombres AS tipo_grado,
            public.tbl_web_publico_asesorias.publico,
            public.tbl_web_publico_asesorias.id_grado,
            public.tbl_web_publico_asesorias.tesista,
            to_char(public.tbl_web_publico_asesorias.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_asesorias.url,
            public.tbl_web_publico_asesorias.archivo,
            public.tbl_web_publico_asesorias.imagen,
            public.tbl_web_publico_asesorias.nro_doc,
            public.tbl_web_publico_asesorias.estado,
            public.tbl_web_universidades.universidad,
            tipodeinstitucion.nombres AS tipo_institucion
            FROM
            public.tbl_web_publico_asesorias
            INNER JOIN public.a_codigos AS tipo_grado ON tipo_grado.codigo = public.tbl_web_publico_asesorias.id_grado
            INNER JOIN public.tbl_web_universidades ON public.tbl_web_universidades.id_universidad = public.tbl_web_publico_asesorias.id_universidad
            INNER JOIN public.a_codigos AS tipodeinstitucion ON tipodeinstitucion.codigo = public.tbl_web_universidades.tipo_institucion
            WHERE
            tipodeinstitucion.numero = 105 AND
            tipo_grado.numero = 69 AND public.tbl_web_publico_asesorias.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'ASESORÍA DE TESIS', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {

   
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Universidades', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->universidad}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Grado', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tipo_grado}", 0, 1, 'L');

                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Tesista', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->tesista}", 0, 1, 'L');


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->fecha}", 0, 'L');

                
                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Url', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->url}", 0, 'L');



                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/asesorias/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
        }

        if ($extension == "A") {

            $db = $this->db;
            $sqlQuery = "SELECT
            public.tbl_web_publico_extension.codigo,
            public.tbl_web_publico_extension.publico,
            public.tbl_web_publico_extension.nombre,
            to_char(public.tbl_web_publico_extension.fecha, 'DD/MM/YYYY') AS fecha,
            public.tbl_web_publico_extension.archivo,
            public.tbl_web_publico_extension.imagen,
            public.tbl_web_publico_extension.estado
            FROM
            public.tbl_web_publico_extension
            WHERE
            public.tbl_web_publico_extension.publico = $publico";
            // print($sqlQuery);
            // exit();
            $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
            

            $pdf->Cell(16);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(174, 9, 'ACTIVIDADES DE PROYECCIÓN SOCIAL Y/O EXTENSIÓN CULTURAL', 0, 0, 'L');
            $pdf->Ln(10);
            foreach ($data as $dataValue) {

   


                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Nombre', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(120, 6, "{$dataValue->nombre}", 0, 1, 'L');



                $pdf->Cell(16);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(40, 6, 'Fecha', 0, 0, 'L');
                $pdf->Cell(14, 6, ':', 0, 0, 'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(120, 6, "{$dataValue->fecha}", 0, 'L');



                if ($dataValue->archivo !== null) {
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(40, 4, 'Enlace archivo', 0, 0, 'L');
                    $pdf->Cell(14, 4, ':', 0, 1, 'L');
                    $pdf->Cell(16);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(174, 4, "{$this->config->global->xWebIns}/adminpanel/archivos/publico/extension/{$dataValue->archivo}", 0, 1, 'L');
                }

                $pdf->Ln(5);
            }
            //exit();
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
        //$filename="adminpanel/archivos/convocatorias_publico/cvs/test.pdf";
        //$pdf->Output($filename,'F');
        //exit();
    }


    public function reporteResumenAction($publico = null, $datos_personales = null, $formacion = null, $capacitaciones = null, $experiencia = null)
    {

        $this->view->disable();

        // echo '<pre>';
        // print_r($_POST);
        // exit();
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

                if ($Publico->foto) {
                    $pdf->Image('adminpanel/imagenes/publico/' . $Publico->foto, 90, 25, 30);
                }

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
        //$filename="adminpanel/archivos/convocatorias_publico/cvs/test.pdf";
        //$pdf->Output($filename,'F');
        //exit();
    }

    #1530
    //reporte carga academica
    public function reporteCargaAcademica1530Action($semestrex, $curso, $grupo)
    {
        $this->view->disable();
        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];
        $docente = $auth["codigo"];
        $full_name = $auth["full_name"];

        $Semestre = Semestres::findFirst(
            [
                "codigo=" . (int) $semestrex,
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $VAsignaturasSemestre = VAsignaturasSemestre::findFirst("semestre_code = {$semestrex} AND asignatura_code = '{$curso}' AND grupo = {$grupo} AND docente_code = {$doc_id}");

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 11, 7, 50);
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

        $pdf->SetFont('Arial', 'B', 10);

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
        $pdf->Ln(10);

        $header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(45, 20, 70, 15, 12, 12, 12, 12);
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
        $pdf->SetWidths(array(45, 20, 70, 15, 12, 12, 12, 12));

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
            $pdf->row2(array($value->curricula, $value->asignatura_codigo, $value->asignatura_nombre, $value->grupo, $value->creditos, $value->ht, $value->hp));
        }

        $pdf->Ln();
        $pdf->Output();
    }

    //reporte de acta inicial
    public function reporteActaInicial1530Action($semestrex, $curso, $grupo)
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

        $conditions = " semestre = {$semestrex} AND asignatura = '{$curso}' AND grupo = {$grupo} AND docente = {$doc_id} ";

        #$prom_conf = PromedioDetalle::findFirst([$conditions])->toArray();
        // las notas

        $vista_notas = VNotas::find(
            [
                "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo<>2 AND tipo<>5 AND tipo <>9 AND grupo = $grupo ",
                'order' => 'apellidos ASC',
            ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->enablefooter = 'footer3';
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;

        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 14);

        // Title
        $pdf->Cell(190, 25, 'REGISTRO DE NOTAS - PRIMER PARCIAL - SEMESTRE ACADÉMICO ' . $semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

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

        $pdf->Ln(5);

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES');
        $aligns = array('C', 'C', 'L', 'C');
        $w = array(10, 20, 150);
        /*for ($i = 1; $i <= 20; $i++) {
        if ($prom_conf["tipo_" . $i] != "") {
        array_push($header, $prom_conf["etq_" . $i]);
        array_push($w, 12);
        array_push($aligns, 'C');
        }
        }*/
        array_push($header, 'NP1');

        array_push($w, 10);

        //echo "<pre>";print_r($header);exit();

        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 9);
        // Header

        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
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

        $pdf->SetAligns($aligns);

        $crece = 0;
        foreach ($vista_notas as $key => $value) {
            $crece++;

            $init = array($crece, $value->alumno, $value->apellidos . " " . $value->nombres);

            $ep1 = $value->ep1;
            if ($ep1 <= 0) {
                $ep1 = "00";
            } else if ($ep1 < 10) {
                $ep1 = '0' . $value->ep1;
            }
            array_push($init, $ep1);

            if ($crece == 31) {
                $pdf->AddPage();
                $pdf->enablefooter = 'footer3';
                $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->Ln();
                $w = 190;

                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 14);

                // Title
                $pdf->Cell(190, 25, 'REGISTRO DE NOTAS - PRIMER PARCIAL - SEMESTRE ACADÉMICO' . $semestre->descripcion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 10);

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

                $pdf->Ln(10);
                $pdf->SetFont('Arial', '', 9);
                $pdf->RowNota2($init);
            } else {
                $pdf->RowNota2($init);
            }
        }

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        //$pdf->Cell(140);
        $pdf->Cell(185, 1, $this->config->global->xCiudadIns . ', ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 1, 'R');

        $pdf->Output();
        exit;
    }

    public function reporteRegistroNotas1530Action($semestrex, $curso, $grupo)
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

        $curricula = Curriculas::findFirstBycodigo($cursoob->curricula);

        $carrera = Carreras::findFirstBycodigo($curricula->carrera);

        $conditions = " semestre = {$semestrex} AND asignatura = '{$curso}' AND grupo = {$grupo} AND docente = {$doc_id} ";

        #$prom_conf = PromedioDetalle::findFirst([$conditions])->toArray();
        // las notas

        $vista_notas = VNotas::find(
            [
                "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo<>2 AND tipo<>5 AND tipo <>9 AND grupo = $grupo ",
                'order' => 'apellidos ASC',
            ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->enablefooter = 'footer3';
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
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
        $pdf->Cell(190, 25, 'REGISTRO DE NOTAS - SEMESTRE ACADÉMICO ' . $semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

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

        $pdf->Ln(8);

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES');
        $aligns = array('C', 'C', 'L');
        $w = array(9, 20, 95);
        /*for ($i = 1; $i <= 20; $i++) {
        if ($prom_conf["tipo_" . $i] != "") {
        array_push($header, $prom_conf["etq_" . $i]);
        array_push($w, 12);
        array_push($aligns, 'C');
        }
        }*/
        array_push($header, 'NP1');
        array_push($header, 'NP2');
        array_push($header, 'E.C');
        array_push($header, 'E.S');
        array_push($header, 'P.F');
        #array_push($header, 'LETRAS');
        array_push($aligns, 'C');
        array_push($aligns, 'C');
        array_push($aligns, 'C');
        array_push($aligns, 'C');
        array_push($aligns, 'C');
        #array_push($aligns, 'L');
        array_push($w, 13);
        array_push($w, 13);
        array_push($w, 13);
        array_push($w, 13);
        array_push($w, 13);
        #array_push($w, 25);

        //echo "<pre>";print_r($header);exit();

        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header

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

        $pdf->SetAligns($aligns);

        $crece = 0;
        foreach ($vista_notas as $key => $value) {
            $crece++;

            $init = array($crece, $value->alumno, $value->apellidos . " " . $value->nombres);

            /*
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
             */
            $ep1 = $value->ep1;
            if ($ep1 <= 0) {
                $ep1 = "00";
            } else if ($ep1 < 10) {
                $ep1 = '0' . $value->ep1;
            }
            array_push($init, $ep1);

            $ep2 = $value->ep2;
            if ($ep2 <= 0) {
                $ep2 = "00";
            } else if ($ep2 < 10) {
                $ep2 = '0' . $value->ep2;
            }
            array_push($init, $ep2);

            $ef = $value->ef;
            if ($ef <= 0) {
                $ef = "00";
            } else if ($ef < 10) {
                $ef = '0' . $value->ef;
            }
            array_push($init, $ef);

            $ea = $value->ea;
            if ($ea <= 0) {
                $ea = "";
            } else if ($ea < 10) {
                $ea = '0' . $value->ea;
            }
            array_push($init, $ea);

            $pf = $value->pf;
            if ($pf <= 0) {
                $pf = "00";
            } else if ($pf < 10) {
                $pf = '0' . $value->pf;
            }
            array_push($init, $pf);
            #array_push($init, $this->convierte((int) $value->pf));

            // echo "<pre> ";
            // print_r($init);
            // exit();

            if ($crece == 31) {
                $pdf->AddPage();
                $pdf->enablefooter = 'footer3';
                $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
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
                $pdf->Cell(190, 25, 'REGISTRO DE NOTAS - SEMESTRE ACADÉMICO' . $semestre->descripcion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 10);

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

                $pdf->Ln(8);
                $pdf->SetFont('Arial', '', 7);
                $pdf->RowNota2($init);
            } else {
                $pdf->RowNota2($init);
            }
        }
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        //$pdf->Cell(140);
        $pdf->Cell(185, 1, $this->config->global->xCiudadIns . ', ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 1, 'R');

        $pdf->Output();
        exit;
    }

    //reporte de acta final
    public function reporteactafinal1530Action($semestrex, $curso, $grupo)
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

        $curricula = Curriculas::findFirstBycodigo($cursoob->curricula);

        $carrera = Carreras::findFirstBycodigo($curricula->carrera);

        // las notas

        $vista_notas = VNotas::find(
            [
                "semestre = '{$semestrex}' AND asignatura='{$curso}' AND tipo <>2 AND tipo <>5 AND tipo <>9 AND grupo = $grupo ",
                'order' => 'apellidos ASC',
            ]
        );

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->enablefooter = 'footer3';
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
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
        $pdf->Cell(190, 25, 'ACTA DE NOTAS - SEMESTRE ACADÉMICO ' . $semestre->descripcion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

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
            $pdf->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
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
            $primedioFinalNumero = $value->pf;

            if ($primedioFinalNumero <= 0) {
                $primedioFinalNumero = "00";
            } else if ($primedioFinalNumero < 10) {
                $primedioFinalNumero = '0' . $value->pf;
            }

            if ($crece == 31) {
                $pdf->AddPage();
                $pdf->enablefooter = 'footer3';
                $pdf->Image('webpage/assets/img/logo.png', 11, 7, 18);
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
                $pdf->Cell(190, 25, 'ACTA DE NOTAS - SEMESTRE ACADÉMICO' . $semestre->descripcion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(1);
                $pdf->Cell(41, 3, 'ESCUELA PROFESIONAL', 0, 0, 'L');
                $pdf->Cell(35, 3, "  : " . $carrera->codigo, 0, 0, 'L');
                $pdf->Cell(10, 3, "{$carrera->descripcion}", 0, 0, 'L');
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
                $pdf->SetFont('Arial', '', 7);
                $pdf->RowNotap(array(
                    $crece, $value->alumno, $value->apellidos . " " . $value->nombres,
                    $primedioFinalNumero, $this->convierte((int) $value->pf)
                ));
            } else {
                $pdf->RowNotap(array(
                    $crece, $value->alumno, $value->apellidos . " " . $value->nombres,
                    $primedioFinalNumero, $this->convierte((int) $value->pf)
                ));
            }
        }

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        //$pdf->Cell(140);
        $pdf->Cell(185, 1, $this->config->global->xCiudadIns . ', ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 1, 'R');

        $pdf->Output();

        exit;
    }
    //reporte registro auxiliar
    public function reporteRegistroAuxiliar1530Action($semestrex, $curso, $grupo)
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
        $pdf->enablefooter = 'footer3';
        $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 50);
        $pdf->SetFont('Arial', 'B', 7);
        //$pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 3, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 3, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'REGISTRO DE AUXILIAR - ' . $VAsignaturasSemestre->semestre_definicion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

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

        $pdf->Ln(10);

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', '', '', '', '', '');
        $pdf->Ln(2);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 9);
        // Header
        $w = array(10, 20, 85, 15, 15, 15, 15, 15);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
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

            if ($crece == 31) {
                $pdf->AddPage();
                //$pdf->Ln(50);
                $pdf->enablefooter = 'footer3';
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 50);
                $pdf->SetFont('Arial', 'B', 7);
                //$pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 3, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 3, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');

                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(190, 25, 'REGISTRO DE AUXILIAR - ' . $VAsignaturasSemestre->semestre_definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 10);

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

                $pdf->Ln(10);
                $pdf->SetFont('Arial', '', 7);

                $pdf->row2(array($crece, $value->codigo, $value->alumno, "", "", "", "", ""));
            } else {
                $pdf->SetFont('Arial', '', 7);
                $pdf->row2(array($crece, $value->codigo, $value->alumno, "", "", "", "", ""));
            }
        }

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(65, 5, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        //$pdf->Cell(140);
        $pdf->Cell(185, 1, $this->config->global->xCiudadIns . ', ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 1, 'R');

        $pdf->Output();
    }

    //reporte registro auxiliar datos estudiantes
    public function reporteRegistroAuxiliarDatosEstudiantesAction($semestrex, $curso, $grupo)
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
        $pdf->enablefooter = 'footer3';
        $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 50);
        $pdf->SetFont('Arial', 'B', 6);
        //$pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 3, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 3, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(190, 25, 'REGISTRO DE AUXILIAR DATOS ESTUDIANTES - ' . $VAsignaturasSemestre->semestre_definicion, 0, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

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

        $pdf->Ln(10);

        $header = array('NRO', 'CODIGO', 'APELLIDOS Y NOMBRES', 'DNI', 'EMAIL', 'CELULAR');
        $pdf->Ln(2);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 20, 85, 15, 40, 20);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
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

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));

        $crece = 0;
        foreach ($vista_registro_auxiliar as $key => $value) {
            $crece++;

            if ($crece == 31) {
                $pdf->AddPage();
                $pdf->enablefooter = 'footer3';
                $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 50);
                $pdf->SetFont('Arial', 'B', 6);
                //$pdf->Ln();
                $w = 190;
                //$pdf->Cell(190, 0, '', 0, 0, 'L');
                $pdf->MultiCell($w, 3, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 3, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');

                $pdf->SetFont('Arial', 'B', 13);
                $pdf->Cell(190, 25, 'REGISTRO DE AUXILIAR DATOS ESTUDIANTES - ' . $VAsignaturasSemestre->semestre_definicion, 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 10);

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

                $pdf->Ln(10);

                $pdf->SetFont('Arial', '', 7);

                $pdf->row2(array($crece, $value->codigo, $value->alumno, $value->nro_doc, $value->email1, $value->celular));
            } else {
                $pdf->SetFont('Arial', '', 7);
                $pdf->row2(array($crece, $value->codigo, $value->alumno, $value->nro_doc, $value->email1, $value->celular));
            }
        }

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(1);
        $pdf->Cell(51, 1, 'TOTAL DE ALUMNOS MATRICULADOS     : ' . $crece, 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        //$pdf->Cell(140);
        $pdf->Cell(185, 1, $this->config->global->xCiudadIns . ', ' . date('d') . ' de ' . $this->mesespanion(date('m')) . ' de ' . date('Y'), 0, 1, 'R');

        $pdf->Output();
    }

    public function reporteLibrosreservaswebAction($fecha_inicio = null, $fecha_fin = null)
    {

        $this->view->disable();
        $vPrestamosSolicitudes = VPrestamosSolicitudes::find("tipo=1 AND (CAST (fecha_reserva AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        $pdf->SetFont('Arial', 'B', 15);

        $pdf->Cell(190, 15, 'REGISTRO DE SOLICITUDES DE LIBROS', 1, 0, 'L');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Ln(5);

        $header = array('CODIGO', 'TIPO', 'LECTOR', 'FECHA RESERVA');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(30, 20, 100, 35);
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
        $pdf->SetWidths(array(30, 20, 100, 35));

        $pdf->SetAligns(array('C', 'C', 'L', 'C'));
        foreach ($vPrestamosSolicitudes as $key => $value) {
            if ($value->alumno == '1') {
                $tipoUsuario = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipoUsuario = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipoUsuario = 'PÚBLICO';
            }

            //print($value->fecha_reserva);
            //exit();

            $fecha_reserva_explode = explode('-', $value->fecha_reserva);
            $fecha_reserva = $fecha_reserva_explode[2] . "/" . $fecha_reserva_explode[1] . "/" . $fecha_reserva_explode[0];

            $pdf->row(array($value->codigo_lector, $tipoUsuario, $value->lector, $fecha_reserva));
        }

        $pdf->Output();
        exit;
    }

    public function reporteLibrosprestamoswebAction($fecha_inicio = null, $fecha_fin = null)
    {
        /*((CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') AND (CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')) */
        $this->view->disable();

        $vPrestamosConfirmados = VPrestamosConfirmados::find("tipo=1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        $pdf->SetFont('Arial', 'B', 15);

        $pdf->Cell(190, 15, 'REGISTRO DE PRESTAMOS', 1, 0, 'L');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Ln(5);

        $header = array('CODIGO', 'TIPO', 'LECTOR', 'F. PRESTAMO', 'F. DEVOLUCION');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(25, 20, 85, 30, 30);
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
        $pdf->SetWidths(array(25, 20, 85, 30, 30));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C'));
        foreach ($vPrestamosConfirmados as $key => $value) {
            if ($value->alumno == '1') {
                $tipoUsuario = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipoUsuario = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipoUsuario = 'PÚBLICO';
            }

            $fecha_entrega_explode = explode('-', $value->fecha_entrega);
            $fecha_entrega = $fecha_entrega_explode[2] . "/" . $fecha_entrega_explode[1] . "/" . $fecha_entrega_explode[0];

            $fecha_devolucion_explode = explode('-', $value->fecha_devolucion);
            $fecha_devolucion = $fecha_devolucion_explode[2] . "/" . $fecha_devolucion_explode[1] . "/" . $fecha_devolucion_explode[0];

            $pdf->row(array($value->codigo_lector, $tipoUsuario, $value->lector, $fecha_entrega, $fecha_devolucion));
        }

        $pdf->Output();
        exit;
    }

    public function reporteLibrosprestamoslistawebAction($fecha_inicio = null, $fecha_fin = null)
    {
        /*((CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') AND (CAST (public.tbl_doc_actividades.fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')) */
        $this->view->disable();

        $vPrestamosLista = VPrestamosLista::find("tipo=1 AND (CAST (fecha_reserva AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 140, 11, 52);
        $pdf->SetFont('Arial', 'B', 15);

        $pdf->Cell(190, 15, 'REGISTRO DE PRESTAMOS WEB', 1, 0, 'L');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Ln(5);

        $header = array('CODIGO', 'TIPO', 'LECTOR', 'F. RESERVA', 'F. PRESTAMO', 'F. DEVOLUCION');
        $pdf->Ln(5);
        $pdf->SetFillColor(50, 50, 55);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(20, 20, 60, 30, 30, 30);
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
        $pdf->SetWidths(array(20, 20, 60, 30, 30, 30));

        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'C'));
        foreach ($vPrestamosLista as $key => $value) {
            if ($value->alumno == '1') {
                $tipoUsuario = 'ALUMNO';
            }
            if ($value->docente == '1') {
                $tipoUsuario = 'DOCENTE';
            }
            if ($value->publico == '1') {
                $tipoUsuario = 'PÚBLICO';
            }

            $fecha_reserva_explode = explode('-', $value->fecha_reserva);
            $fecha_reserva = $fecha_reserva_explode[2] . "/" . $fecha_reserva_explode[1] . "/" . $fecha_reserva_explode[0];

            $fecha_entrega_explode = explode('-', $value->fecha_entrega);
            $fecha_entrega = $fecha_entrega_explode[2] . "/" . $fecha_entrega_explode[1] . "/" . $fecha_entrega_explode[0];

            $fecha_devolucion_confirmada_explode = explode('-', $value->fecha_devolucion_confirmada);
            $fecha_devolucion_confirmada = $fecha_devolucion_confirmada_explode[2] . "/" . $fecha_devolucion_confirmada_explode[1] . "/" . $fecha_devolucion_confirmada_explode[0];

            $pdf->row(array($value->codigo_lector, $tipoUsuario, $value->lector, $fecha_reserva, $fecha_entrega, $fecha_devolucion_confirmada));
        }

        $pdf->Output();
        exit;
    }

    public function reporteBtrpublicacionesAction($fechaCreaccion = null, $fechaClausura = null)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $idEmpresa = $auth["id_empresa"];
        $nombreEmpresa = $auth["nombres"];

        //$razon_social = $auth["razon_social"];

        //echo '<pre>';
        //print_r($auth = $this->session->get('auth'));
        //exit();

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(190, 25, 'PUBLICACIONES DE BOLSA DE TRABAJO', 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(40, 5, 'NOMBRE EMPRESA', 0, 0, 'L');
        $pdf->Cell(41, 5, " :  " . $nombreEmpresa, 0, 0, 'L');
        $pdf->Ln();

        $header = array('TÍTULO', 'REGIÓN', 'DISTRITO', 'CARGO', 'FECHA CLAUSURA', 'N°POSTULANTES', 'N° VISITAS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(35, 20, 20, 30, 35, 30, 20);
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
        $pdf->SetWidths(array(35, 20, 20, 30, 35, 30, 20));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));

        //condicion
        //$where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}') AND (CAST (e.fecha_clausura AS DATE) BETWEEN '{$fechaCreaccion}' AND '$fechaClausura'))";
        $where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}'))";

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
            AND e.empresa = {$idEmpresa}
            AND C.numero = 45
            AND j.numero = 46
            AND tc.numero = 47";

        // print($sqlQuery);
        // exit();

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 8);
        foreach ($data as $robot) {
            $fecha_explode_1 = explode(' ', $robot->fecha_clausura);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];
            $pdf->row(array($robot->titulo, $robot->region, $robot->distrito, $robot->cargo, $fecha_resultado, $robot->postulo, $robot->numero_visitas));
        }

        $pdf->Ln();
        $pdf->Output();
        exit;
    }

    public function reporteBtrpublicacionesPostulantesAction($idEmpleo)
    {
        $this->view->disable();

        $auth = $this->session->get('auth');
        $idEmpresa = $auth["id_empresa"];
        $nombreEmpresa = $auth["nombres"];

        $empleo = Empleos::findFirst("id_empleo = {$idEmpleo} AND empresa = {$idEmpresa}");

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(190, 25, 'POSTULANTES A LA OFERTA LABORAL', 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(40, 5, 'NOMBRE EMPRESA   :', 0, 0, 'L');
        $pdf->Cell(150, 5, $nombreEmpresa, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(40, 5, 'TITULO EMPLEO         :', 0, 0, 'L');
        //$pdf->Cell(41, 5, " :  " . $empleo->titulo, 0, 0, 'L');
        $pdf->MultiCell(150, 5, $empleo->titulo, 0, 'L');
        $pdf->Ln();

        $header = array('TIPO', 'CODIGO', 'APELLIDOS NOMBRES', 'DNI', 'CARRERA', 'CELULAR', 'DIRECCION', 'EMAIL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(15, 20, 35, 15, 35, 30, 20, 20);
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
        $pdf->SetWidths(array(15, 20, 35, 15, 35, 30, 20, 20));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

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

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);
        foreach ($data as $robot) {
            $pdf->row(array($robot->tipo, $robot->alumno_codigo, $robot->alumno_nombres, $robot->dni, $robot->carrera_nombre, $robot->alumno_celular, $robot->alumno_direccion, $robot->email_alumno));
        }

        $pdf->Ln();
        $pdf->Output();
        exit;
    }

    //reporte publicaciones de bolsa de trabajo
    public function reporteBtrpublicacionesEmpleosAction($fechaCreaccion = null, $fechaClausura = null)
    {
        $this->view->disable();

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(190, 25, 'PUBLICACIONES DE BOLSA DE TRABAJO', 0, 0, 'C');
        $pdf->Ln();

        $header = array('RAZON SOCIAL', 'TÍTULO', 'REGIÓN', 'DISTRITO', 'CARGO', 'FECHA CLAUSURA', 'N°POSTULANTES', 'N° VISITAS');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 7);
        // Header
        $w = array(30, 30, 20, 20, 25, 25, 25, 15);
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
        $pdf->SetWidths(array(30, 30, 20, 20, 25, 25, 25, 15));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

        //condicion
        //$where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}') AND (CAST (e.fecha_clausura AS DATE) BETWEEN '{$fechaCreaccion}' AND '$fechaClausura'))";
        $where = "((CAST (e.fecha_creacion AS DATE) BETWEEN '{$fechaCreaccion}' AND '{$fechaClausura}'))";

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

        $pdf->SetFont('Arial', '', 6);
        foreach ($data as $robot) {
            $fecha_explode_1 = explode(' ', $robot->fecha_clausura);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];
            //$pdf->row(array($robot->razon_social, $robot->titulo, $robot->region, $robot->distrito, $robot->cargod, $fecha_resultado, $robot->postulo, $robot->numero_visitas));
            $pdf->row(array($robot->razon_social, $robot->titulo, $robot->region, $robot->distrito, $robot->cargod, $fecha_resultado, $robot->postulo, $robot->numero_visitas));
        }

        $pdf->Ln();
        $pdf->Output();
        exit;
    }

    public function reporteBtrpublicacionesPostulantesEmpleosAction($idEmpleo)
    {
        $this->view->disable();
        $auth = $this->session->get('auth');

        $empleo = Empleos::findFirst("id_empleo = {$idEmpleo}");

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo-vr.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();
        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln();
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(190, 25, 'POSTULANTES A LA OFERTA LABORAL', 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(40, 5, 'TITULO EMPLEO         :', 0, 0, 'L');
        //$pdf->Cell(41, 5, " :  " . $empleo->titulo, 0, 0, 'L');
        $pdf->MultiCell(150, 5, $empleo->titulo, 0, 'L');
        $pdf->Ln();

        $header = array('TIPO', 'CODIGO', 'APELLIDOS NOMBRES', 'DNI', 'CARRERA', 'CELULAR', 'DIRECCION', 'EMAIL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(15, 20, 35, 15, 35, 30, 20, 20);
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
        $pdf->SetWidths(array(15, 20, 35, 15, 35, 30, 20, 20));

        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

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

        $pdf->SetFont('Arial', '', 6);
        foreach ($data as $robot) {
            $pdf->row(array($robot->tipo, $robot->alumno_codigo, $robot->alumno_nombres, $robot->dni, $robot->carrera_nombre, $robot->alumno_celular, $robot->alumno_direccion, $robot->email_alumno));
        }

        $pdf->Ln();
        $pdf->Output();
        exit;
    }

    public function reporteListaEgresadosAction()
    {
        $this->view->disable();

        $pdf = new PDF();

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
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;

            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'RELACIÓN DE EGRESADOS', 0, 0, 'C');
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

                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'RELACIÓN DE EGRESADOS', 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "$carrera->carreras_nombre", 0, 0, 'L');

                $header = array('N°', 'CODIGO', 'APELLIDOS Y NOMBRES', 'EMAIL', 'CELULAR', 'FIRMA');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 80, 32, 20, 28);
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

                $pdf->SetAligns(array('C', 'C', 'L', 'L', 'C'));

                //
                $db = $this->db;
                $sql_query = "SELECT
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

                //print($sql_query);
                //exit();
                $crece = 0;
                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->id_alumno, $value->alumnos_nombre, $value->alumnos_email, $value->alumnos_celular, ''));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    public function reporteListaEstudiantesAction()
    {
        $this->view->disable();

        $pdf = new PDF();

        //cabecera pdf
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
        //fin cabecera pdf

        if (count($Carreras) == 0) {
            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 10, 9, 70);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->Ln();
            $w = 190;

            $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
            $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(190, 25, 'RELACIÓN DE EGRESADOS', 0, 0, 'C');
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

                $pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
                $pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
                $pdf->Ln();

                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(190, 25, 'RELACIÓN DE ESTUDIANTES', 0, 0, 'C');
                // Line break
                $pdf->Ln(20);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(50, 5, 'CARRERA PROFESIONAL:', 0, 0, 'L');
                $pdf->Cell(10, 5, "$carrera->carreras_nombre", 0, 0, 'L');

                $header = array('N°', 'CODIGO', 'APELLIDOS Y NOMBRES', 'EMAIL', 'CELULAR', 'FIRMA');
                $pdf->Ln(5);
                $pdf->SetFillColor(250, 250, 255);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(.3);
                $pdf->SetFont('Arial', 'B', 7);
                // Header
                $w = array(10, 20, 80, 32, 20, 28);
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

                $pdf->SetAligns(array('C', 'C', 'L', 'L', 'C'));

                //sql
                $db = $this->db;
                $sql_query = "SELECT
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
                //fin sql

                //print($sql_query);
                //exit();

                $crece = 0;
                $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);
                foreach ($data as $key => $value) {
                    $crece++;

                    $pdf->row(array($crece, $value->id_alumno, $value->alumnos_nombre, $value->alumnos_email, $value->alumnos_celular, ''));
                }
                //

                $pdf->Ln(3);
            }
        }

        $pdf->Output();
    }

    //reportelibrosprestamos
    public function reportelibrosprestamosAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE PRÉSTAMOS REGISTRADOS', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);

        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'CÓDIGO', 'TIPO', 'LECTOR', 'FECHA PRÉSTAMO', 'FECHA DEVOLUCIÓN');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(15, 20, 17, 80, 28, 30);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 20, 17, 80, 28, 30));
        $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C'));

        $vPrestamosConfirmados = VPrestamosConfirmados::find("tipo > 1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ORDER BY codigos DESC");

        $pdf->SetFont('Arial', '', 8);
        foreach ($vPrestamosConfirmados as $key => $robot) {
            if ($robot->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($robot->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($robot->publico == '1') {
                $tipo = 'PÚBLICO';
            }
            $fecha_explode_1 = explode(' ', $robot->fecha_entrega);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];
            $fecha_explode_1 = explode(' ', $robot->fecha_devolucion);
            $fecha_explode_2 = explode('-', $fecha_explode_1[0]);
            $fecha_resultado2 = $fecha_explode_2[2] . "/" . $fecha_explode_2[1] . "/" . $fecha_explode_2[0];
            $pdf->row(array($key + 1, $robot->codigo_lector, $tipo, $robot->lector, $fecha_resultado, $fecha_resultado2));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    //reportelibrosprestamoslista
    public function reportelibrosprestamoslistaAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE PRÉSTAMOS REGISTRADOS', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);

        $header = array('N°', 'CÓDIGO', 'TIPO', 'LECTOR', 'FECHA PRÉSTAMO', 'FECHA DEVOLUCIÓN');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(15, 20, 17, 80, 28, 30);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 20, 17, 80, 28, 30));
        $pdf->SetAligns(array('C', 'C', 'L', 'L', 'C', 'C'));

        $vPrestamosLista = VPrestamosLista::find("tipo > 1 AND (CAST (fecha_entrega AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') ");

        $pdf->SetFont('Arial', '', 8);
        foreach ($vPrestamosLista as $key => $robot) {
            if ($robot->alumno == '1') {
                $tipo = 'ALUMNO';
            }
            if ($robot->docente == '1') {
                $tipo = 'DOCENTE';
            }
            if ($robot->publico == '1') {
                $tipo = 'PÚBLICO';
            }

            $fecha_entrega_explode = explode('-', $robot->fecha_entrega);
            $fecha_entrega = $fecha_entrega_explode[2] . "/" . $fecha_entrega_explode[1] . "/" . $fecha_entrega_explode[0];

            $fecha_devolucion_confirmada_explode = explode('-', $robot->fecha_devolucion_confirmada);
            $fecha_devolucion_confirmada = $fecha_devolucion_confirmada_explode[2] . "/" . $fecha_devolucion_confirmada_explode[1] . "/" . $fecha_devolucion_confirmada_explode[0];

            $pdf->row(array($key + 1, $robot->codigo_lector, $tipo, $robot->lector, $fecha_entrega, $fecha_devolucion_confirmada));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    //reporteinvproyectos
    public function reporteInvproyectosAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN REGISTRO DE PROYECTOS', 0, 0, 'C');
        $pdf->Ln(20);

        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'NOMBRE PROYECTO', 'FECHA INICIO', 'FECHA FIN', 'INVESTIGADOR PRINCIPAL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(15, 80, 20, 20, 55);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 80, 20, 20, 55));
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'L'));

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

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 8);
        foreach ($data as $key => $robot) {
            $pdf->row(array($key + 1, $robot->titulo, $robot->fecha_inicio, $robot->fecha_termino, $robot->investigador_principal));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    //gestioninvproyectos
    public function reporteGestioninvproyectosAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN REGISTRO DE PROYECTOS', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'NOMBRE PROYECTO', 'FECHA INICIO', 'FECHA FIN', 'INVESTIGADOR PRINCIPAL', 'AVANCE', 'PROCESO');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(10, 70, 15, 15, 55, 12, 12);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 70, 15, 15, 55, 12, 12));
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'L', 'C', 'C'));

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

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);
        foreach ($data as $key => $robot) {
            $pdf->row(array($key + 1, $robot->titulo, $robot->fecha_inicio, $robot->fecha_termino, $robot->investigador_principal, $robot->avance, $robot->proceso));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    //gestionmesadeayuda/atenciones
    public function reporteGestionmesadeayudaAtencionesAction($tipoAtencion = null, $proceso = null, $fechaInicio = null, $fechaFin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN REGISTRO DE ATENCIONES', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('DNI', 'USUARIO', 'TIPO', 'PRIORIDAD', 'FECHA RECEPCIÓN', 'FECHA PREVISTA', 'FECHA TERMINO', 'PROCESO');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(15, 65, 15, 15, 22, 20, 20, 17);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 65, 15, 15, 22, 20, 20, 17));
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C', 'C'));

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
            procesos.numero = 94  $where
        ) AS temporal_table
        WHERE
        estado = 'A'
        ORDER BY
        codigo DESC";

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);
        foreach ($data as $key => $robot) {
            $pdf->row(array($robot->dni, $robot->publico, $robot->tipo, $robot->prioridad, $robot->fecha_recepcion, $robot->fecha_inicio, $robot->fecha_termino, $robot->proceso_nombre));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    //reporte gestionadmisionPostulantes
    public function reportegestionadmisionPostulantesAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE POSTULANTES', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'CÓDIGO', 'NRO DOC', 'APELLIDOS Y NOMBRES', 'TIPO INSTITUCION', 'UNIVERSIDAD', 'NOMBRE DE ESCUELA', 'FECHA INSCRIPCIÓN', 'NRO RECIBO', 'MONTO', 'PROCESO');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(10, 10, 10, 28, 20, 28, 25, 25, 15, 10, 12);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 10, 10, 28, 20, 28, 25, 25, 15, 10, 12));
        $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'L', 'C'));

        $where = "((CAST (fecha_inscripcion AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";
        $db = $this->db;
        $sql_query = "SELECT
        postulante, nro_doc, nombres_apellidos, colegio_publico, colegio_nombre, recibo, postulante, postulante, escuela, universidad, monto, imagen, fecha_inscripcion, proceso_nombre, tipoinstitucion_nombres
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
            $where AND proceso.numero = 106 AND categorias.numero = 104 AND tipoinstitucion.numero = 105) AS temporal_table ";

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 5);
        foreach ($data as $key => $robot) {

            $pdf->row(array($key + 1, $robot->postulante, $robot->nro_doc, $robot->nombres_apellidos, $robot->tipoinstitucion_nombres, $robot->universidad, $robot->escuela, $robot->fecha_inscripcion, $robot->recibo, $robot->monto, $robot->proceso_nombre));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    public function reportegestiontramitedocumentarioAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'REGISTRO DE DOCUMENTOS', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);

        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'FECHA ENVIO', 'FECHA CARGO', 'TIPO DOCUMENTO', 'DOCUMENTO', 'DESTINATARIO', 'REMITENTE');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(15, 20, 20, 30, 15, 45, 45);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15, 20, 20, 30, 15, 45, 45));
        $pdf->SetAligns(array('C', 'C', 'C', 'L', 'C', 'C'));

        //print($fecha_inicio."*".$fecha_fin);
        //exit();

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

        $pdf->SetFont('Arial', '', 8);

        foreach ($data as $key => $robot) {
            $pdf->row(array($key + 1, $robot->fecha_envio, $robot->fecha_cargo, $robot->tipo_documento, $robot->nro_documento, $robot->destinatario_personal, $robot->remitente_nombres));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    public function reporteGestiontramitedocumentarioDocumentosdetalleAction($id_doc = null, $fecha_inicio = null, $fecha_fin = null)
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

    public function reporteconsultarecursosticAction()
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

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'RECURSOS INFORMÁTICOS ASIGNADOS', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);

        $header = array('N°', 'Área', 'Tipo', 'Patrimonial', 'Usuario', 'Equipo', 'Marca', 'Modelo', 'Serie', 'Color');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(10, 30, 12, 15, 40, 15, 15, 20, 15, 15);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 30, 12, 15, 40, 15, 15, 20, 15, 15));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

        //print($fecha_inicio."*".$fecha_fin);
        //exit();

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
	tipo_nombre ASC ";

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {
            $pdf->row(array($key + 1, $robot->personal_nombre, $robot->tipo_nombre, $robot->nombre_equipo, $robot->usuario, $robot->tipo_nombre, $robot->marca, $robot->modelo, $robot->serie, $robot->color));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    public function reporteconsultarecursosticnoAction()
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

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 25, 'RECURSOS INFORMÁTICOS NO ASIGNADOS', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);

        $header = array('N°', 'Tipo', 'Patrimonial', 'Marca', 'Modelo', 'Serie', 'Color', 'MAC');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(10, 25, 20, 30, 45, 30, 15, 15);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 25, 20, 30, 45, 30, 15, 15));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));

        //print($fecha_inicio."*".$fecha_fin);
        //exit();

        $db = $this->db;
        $sql_query = "SELECT
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
        patrimonial ASC ";

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 6);

        foreach ($data as $key => $robot) {
            $pdf->row(array($key + 1, $robot->tipo_nombre, $robot->patrimonial, $robot->marca, $robot->modelo, $robot->serie, $robot->color, $robot->mac));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    public function reporteRegistropublicoaAction()
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE POSTULANTES', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'CÓDIGO', 'APELLIDOS Y NOMBRES', 'NRO DOC', 'CELULAR', 'EMAIL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(10, 10, 94, 28, 20, 28);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 10, 94, 28, 20, 28));
        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'L'));

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

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 5);
        foreach ($data as $key => $robot) {

            $pdf->row(array($key + 1, $robot->codigo, $robot->apellidos_nombres, $robot->nro_doc, $robot->celular, $robot->email));
        }
        $pdf->Ln();
        $pdf->Output();
    }

    public function reporteLibrosAction()
    {
        $this->view->disable();
        $libro = Libros::find(['order' => 'id_libro']);

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
        $pdf->Cell(190, 25, 'REPORTE DE LIBROS REGISTRADOS', 0, 0, 'C');
        // Line break
        $pdf->Ln(20);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°','DEWEY','TITULO', 'ISBN', 'EJEMPLARES');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 10);
        // Header
        $w = array(15,20,95, 35, 25);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(15,20,95, 35, 25));
        $pdf->SetAligns(array('C','C','L', 'C', 'C'));

        foreach ($libro as $key => $value) {
            $pdf->row(array($key + 1,$value->codigo,$value->titulo, $value->isbn, $value->cantidad_ejemplares));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function planillasCasAction($id_planilla)
    {
        $this->view->disable();

        $planilla = Planilla::findFirst("id_planilla = $id_planilla");

        $periodo = Periodos::findFirst("codigo = $planilla->periodo");

        $data = VPlanillasCas::find("id_planilla = $id_planilla");

        $pdf = new PDF();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage('L');
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 278;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        $pdf->MultiCell($w, 4, 'UNIVERSIDAD NACIONAL CIRO ALEGRIA', 0, 'C');
        $pdf->MultiCell($w, 4, 'DIRECCION GENERAL DE ADMINISTRACION', 0, 'C');
        $pdf->MultiCell($w, 4, 'UNIDAD DE RECURSOS HUMANOS', 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(110, 25, $planilla->nombre . " " . $planilla->numero . " DEL MES DE: ", 0, 0, 'R');
        $fecha = explode("-", $periodo->periodo);
        $pdf->Cell(60, 25, strtoupper($this->mesespanion($fecha[0])) . ' DEL ' . $fecha[1], 0, 0, 'C');
        $pdf->Ln(20);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N ORDEN', 'META', 'TELEAHORRO', 'NRO DOC', 'NOMBRES Y APELLIDOS', 'REG. PENS.', 'CARGO', 'REM. DIAS TRAB', 'INASISTENCIA', 'TARDANZA', 'AGU. JULIO', 'ING TOTAL', 'SEM ASEG.', 'SIST.NAC PEN', 'Aporte AFP', 'Prima Seguro', 'Comision AFP', 'DCTO. REG. PENS.', 'DCTO JUDICIAL', '4ta CAT', 'TOTAL DCTO', 'REMU NETA', 'ESALUD');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 4);
        // Header
        $w = array(10, 10, 12, 10, 20, 10, 18, 15, 12, 12, 12, 12, 12, 12, 12, 12, 12, 13, 12, 10, 10, 10, 10);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 10, 12, 10, 20, 10, 18, 15, 12, 12, 12, 12, 12, 12, 12, 12, 12, 13, 12, 10, 10, 10, 10));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'L', 'C', 'C', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R'));

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

            if ($value->rem_basica == "0.00") {
                $rem_basica = "-";
            } else {
                $rem_basica = $value->rem_basica;
            }

            //cambiar formato
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


            $pdf->row3(array(
                $key + 1, $value->meta, 'DE EN CUENTA', $value->nro_doc,
                $value->personal1, $value->afp_nombre, $value->cargo, $rem_basica, $d_inas, $d_tard,
                $i_aguin_jul, $rem_bruta, $rem_aseg, $nac_pen, $aporte, $prima,
                $comision, $desc_regimen_pension, $d_judicial, $cuarta_cat, $descuentos,
                $rem_neta, $aessalud
            ));
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



        $pdf->Cell(90, 5, 'TOTAL', 1, 0, 'L');
        $pdf->Cell(15, 5, $t_rem_dias_trab, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_inasistencia, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_tardanza, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_i_aguin_jul, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_ingreso, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_rem_aseg, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_sist_nac_pen, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_aporte, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_prima, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_comision, 1, 0, 'R');
        $pdf->Cell(13, 5, $t_desc_regimen_pension, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_d_judicial, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_cuarta_cat, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_descuentos, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_rem_neta, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_aessalud, 1, 0, 'R');
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function planillasDocentesAction($id_planilla)
    {
        $this->view->disable();


        $planilla = Planilla::findFirst("id_planilla = $id_planilla");

        $periodo = Periodos::findFirst("codigo = $planilla->periodo");

        $data = VPlanillasDocentes::find("id_planilla = $id_planilla");

        $pdf = new PDF();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->AddPage('L');
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 278;
        $pdf->MultiCell($w, 4, 'UNIVERSIDAD NACIONAL CIRO ALEGRIA', 0, 'C');
        $pdf->MultiCell($w, 4, 'DIRECCION GENERAL DE ADMINISTRACION', 0, 'C');
        $pdf->MultiCell($w, 4, 'UNIDAD DE RECURSOS HUMANOS', 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(110, 25, $planilla->nombre . " " . $planilla->numero . " DEL MES DE: ", 0, 0, 'R');
        $fecha = explode("-", $periodo->periodo);
        $pdf->Cell(60, 25, strtoupper($this->mesespanion($fecha[0])) . ' DEL ' . $fecha[1], 0, 0, 'C');
        $pdf->Ln(20);



        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array(
            'N ORDEN', 'META', 'TELEAHORRO', 'NRO DOC', 'NOMBRES Y APELLIDOS', 'REG. PENS.', 'CARGO', 'REM. DIAS TRAB',
            'INASISTENCIA', 'TARDANZA', 'ESCOLARIDAD', 'AGU. JULIO', 'ING TOTAL', 'SEM ASEG.', 'SIST.NAC PEN', 'Aporte AFP', 'Prima Seguro', 'Comision AFP',
            'DCTO. REG. PENS.', 'DCTO JUDICIAL', '5ta CAT', 'TOTAL DCTO', 'REMU NETA', 'ESALUD'
        );
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 4);
        // Header
        $w = array(10, 10, 12, 10, 20, 10, 18, 15, 12, 10, 10, 10, 10, 10, 12, 10, 10, 10, 13, 12, 10, 10, 10, 10);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 10, 12, 10, 20, 10, 18, 15, 12, 10, 10, 10, 10, 10, 12, 10, 10, 10, 13, 12, 10, 10, 10, 10));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'L', 'C', 'C', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R'));

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


            $pdf->row3(array(
                $key + 1, $value->meta, 'DE EN CUENTA', $value->nro_doc,
                $value->personal1, $value->afp_nombre, $value->cargo, $rem_basica, $d_inas, $d_tard,
                $i_escolar, $i_aguin_jul, $rem_bruta, $rem_aseg, $nac_pen, $aporte, $prima,
                $comision, $desc_regimen_pension, $d_judicial, $quinta_cat, $descuentos,
                $rem_neta, $aessalud
            ));
        }

        // print($t_comision);
        //exit();

        $t_rem_dias_trab = number_format($t_rem_dias_trab, 2, '.', ' ');
        $t_inasistencia = number_format($t_inasistencia, 2, '.', ' ');
        $t_tardanza = number_format($t_tardanza, 2, '.', ' ');
        $t_escolar =   number_format($t_escolar, 2, '.', ' ');
        $t_i_aguin_jul = number_format($t_i_aguin_jul, 2, '.', ' ');
        $t_ingreso =  number_format($t_ingreso, 2, '.', ' ');
        $t_rem_aseg =  number_format($t_rem_aseg, 2, '.', ' ');
        $t_sist_nac_pen =  number_format($t_rem_aseg, 2, '.', ' ');
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

        $pdf->Cell(90, 5, 'TOTAL', 1, 0, 'L');
        $pdf->Cell(15, 5, $t_rem_dias_trab, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_inasistencia, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_tardanza, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_escolar, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_i_aguin_jul, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_ingreso, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_rem_aseg, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_sist_nac_pen, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_aporte, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_prima, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_comision, 1, 0, 'R');
        $pdf->Cell(13, 5, $t_desc_regimen_pension, 1, 0, 'R');
        $pdf->Cell(12, 5, $t_d_judicial, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_quinta_cat, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_descuentos, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_rem_neta, 1, 0, 'R');
        $pdf->Cell(10, 5, $t_aessalud, 1, 0, 'R');
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }


    public function postulantesconvocatoriasAction($id_convocatoria, $id_perfil)
    {
        $this->view->disable();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);

        $convocatoriaPerfil = ConvocatoriasPerfiles::findFirstBycodigo($id_perfil);

        $db = $this->db;
        $sqlQuery = "SELECT
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
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        //print count($libro); exit();


        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        //$pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        //$pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 8, 'RELACION DE POSTULANTES ', 0, 1, 'C');
        $pdf->Multicell(190, 5, $convocatoria->titulo, 0, 'C', 0);
        $pdf->Multicell(190, 5, strtoupper($convocatoriaPerfil->nombre), 0, 'C', 0);

        // Line break
        $pdf->Ln(2);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'FECHA', 'NRO DOC.', 'POSTULANTE', 'EMAIL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 20, 20, 100, 40);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 20, 20, 100, 40));
        $pdf->SetAligns(array('C', 'C', 'C', 'L'));

        foreach ($data as $key => $value) {
            $pdf->row(array($key + 1, $value->fecha, $value->nro_doc, $value->postulante, strtolower($value->email)));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function convocatoriasAction($id_convocatoria)
    {
        $this->view->disable();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);

        $dbconv = $this->db;
        $sqlQuery = "select tipo from tbl_web_convocatorias where  id_convocatoria=$id_convocatoria";
        $dataconv = $dbconv->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);
        $tipoconv=$dataconv[0]->tipo;
        $db = $this->db;
        if($tipoconv==4 or $tipoconv==7){
            $sqlQuery = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        P.nro_doc,
        P.email,
        twcp,nombre_corto,
        rtrim(
            ltrim( P.apellidop )) || ' ' || rtrim(
            ltrim( P.apellidom )) || ' ' || rtrim(
        ltrim( P.nombres )) AS postulante 
    FROM
        tbl_web_convocatorias_publico twlcp
        INNER JOIN docentes P ON twlcp.publico = P.codigo
        INNER JOIN tbl_web_convocatorias_perfiles twcp ON twlcp.perfil = twcp.codigo 
    WHERE
        twlcp.convocatoria = $id_convocatoria 
    ORDER BY
        twcp.nombre,
        postulante";
        }else {
            $sqlQuery = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        P.nro_doc,
        P.email,
        twcp,nombre_corto,
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
        }
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        //print count($libro); exit();


        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        //$pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        //$pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 8, 'RELACION DE POSTULANTES ', 0, 1, 'C');
        $pdf->Multicell(190, 5, $convocatoria->titulo, 0, 'C', 0);

        // Line break
        $pdf->Ln(2);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'PERFIL', 'FECHA', 'NRO DOC.', 'POSTULANTE', 'EMAIL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 30, 20, 20, 80, 30);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 30, 20, 20, 80, 30));
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'L', 'L'));

        foreach ($data as $key => $value) {
            $pdf->row(array($key + 1, $value->perfil." - ".$value->nombre_corto, $value->fecha, $value->nro_doc, $value->postulante, strtolower($value->email)));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function convocatoriascvAction($id_convocatoria)
    {
        $this->view->disable();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);


        $db = $this->db;
        $sqlQuery = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        twlcp.chk_cv,
        twlcp.puntaje_cv,
        twlcp.observaciones_cv,
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
        ORDER BY perfil ASC, twlcp.chk_cv DESC,twlcp.puntaje_cv DESC, postulante ASC";
        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        //print count($libro); exit();


        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        //$pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        //$pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 8, 'RELACION DE POSTULANTES ', 0, 1, 'C');
        $pdf->Multicell(190, 5, $convocatoria->titulo, 0, 'C', 0);

        // Line break
        $pdf->Ln(2);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'CARGO', 'POSTULANTE', 'DNI', 'RESULTADOS CV', 'CONDICION', 'OBSERVACIONES');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 30, 40, 20, 25, 20, 45);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 30, 40, 20, 25, 20, 45));
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'L'));

        foreach ($data as $key => $value) {
            $chk_cv = $value->chk_cv;
            if ($chk_cv == '1') {
                $apto = "Apto";
            } else if ($chk_cv == '0') {
                $apto = "No Apto";
            }
            $pdf->row(array($key + 1, $value->perfil, $value->postulante, $value->nro_doc, $value->puntaje_cv, $apto, $value->observaciones_cv));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function convocatoriasentrevistaAction($id_convocatoria)
    {
        $this->view->disable();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);


        $db = $this->db;
        $sqlQuery = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        twlcp.chk_cv,
        twlcp.puntaje_entrevista,
        twlcp.observaciones_cv,
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
        ORDER BY perfil ASC, twlcp.chk_cv DESC,twlcp.puntaje_entrevista DESC, postulante ASC";

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        //print count($libro); exit();


        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        //$pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        //$pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 8, 'RELACION DE POSTULANTES ', 0, 1, 'C');
        $pdf->Multicell(190, 5, $convocatoria->titulo, 0, 'C', 0);

        // Line break
        $pdf->Ln(2);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'CARGO', 'POSTULANTE', 'DNI', 'RESULTADOS ENTREV.', 'CONDICION');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 30, 85, 15, 34, 16);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 30, 85, 15, 34, 16));
        $pdf->SetAligns(array('C', 'L', 'L', 'C', 'C', 'C'));

        foreach ($data as $key => $value) {
            $chk_cv = $value->chk_cv;
            if ($chk_cv == 1) {
                $apto = "Apto";
            } else {
                $apto = "No Apto";
            }
            $pdf->row(array($key + 1, $value->perfil, $value->postulante, $value->nro_doc, $value->puntaje_entrevista, $apto));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }


    public function convocatoriasexamenAction($id_convocatoria)
    {
        $this->view->disable();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);


        $db = $this->db;
        $sqlQuery = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        twlcp.chk_cv,
        twlcp.puntaje_examen,
        twlcp.observaciones_cv,
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
        ORDER BY perfil ASC, twlcp.chk_cv DESC,twlcp.puntaje_examen DESC, postulante ASC";

        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        //print count($libro); exit();


        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        //$pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        //$pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 8, 'RELACION DE POSTULANTES ', 0, 1, 'C');
        $pdf->Multicell(190, 5, $convocatoria->titulo, 0, 'C', 0);

        // Line break
        $pdf->Ln(2);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP'); quito osb
        $header = array('N°', 'CARGO', 'POSTULANTE', 'DNI', 'RESULTADOS EXAMEN', 'CONDICION');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 30, 85, 15, 34, 16);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 30, 85, 15, 34, 16));
        $pdf->SetAligns(array('C', 'L', 'L', 'C', 'C', 'C'));

        foreach ($data as $key => $value) {
            $chk_cv = $value->chk_cv;
            if ($chk_cv == 1) {
                $apto = "Apto";
            } else {
                $apto = "No Apto";
            }
            $pdf->row(array($key + 1, $value->perfil, $value->postulante, $value->nro_doc, $value->puntaje_examen, $apto));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function convocatoriasfinalAction($id_convocatoria)
    {
        $this->view->disable();

        $convocatoria = Convocatorias::findFirstByid_convocatoria($id_convocatoria);


        $db = $this->db;
        $sqlQuery = "SELECT
        twcp.nombre AS perfil,
        to_char(twlcp.fecha, 'DD/MM/YYYY') AS fecha,
        twlcp.chk_cv,
        twlcp.puntaje_cv,
        twlcp.puntaje_entrevista,
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
    ORDER BY perfil ASC, twlcp.chk_cv DESC,twlcp.puntaje_entrevista DESC, postulante ASC";


        $data = $db->fetchAll($sqlQuery, Phalcon\Db::FETCH_OBJ);

        //print count($libro); exit();


        $pdf = new PDF();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Image('webpage/assets/img/logo.png', 11, 7, 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Ln();

        $w = 190;
        //$pdf->Cell(190, 0, '', 0, 0, 'L');
        //$pdf->MultiCell($w, 4, 'VICEPRESIDENCIA ACADÉMICA', 0, 'R');
        //$pdf->MultiCell($w, 4, 'UNIDAD DE GESTION ACADÉMICA - REGISTROS ACADÉMICOS', 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 8, 'RELACION DE POSTULANTES ', 0, 1, 'C');
        $pdf->Multicell(190, 5, $convocatoria->titulo, 0, 'C', 0);

        // Line break
        $pdf->Ln(2);


        //$header = array('CURRICULA', 'CÓDIGO', 'ASIGNATURA', 'GRUPO', 'CR.', 'HT', 'HP');
        $header = array('N°', 'CARGO', 'POSTULANTE', 'DNI', 'RESULTADOS CV', 'RESULTADOS ENTREV.', 'PUNTAJE FINAL');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        $w = array(10, 30, 55, 15, 27, 35, 22);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 30, 55, 15, 27, 35, 22));
        $pdf->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C', 'C'));

        foreach ($data as $key => $value) {
            $puntaje_final = $value->puntaje_cv + $value->puntaje_entrevista;
            $pdf->row(array($key + 1, $value->perfil, $value->postulante, $value->nro_doc, $value->puntaje_cv, $value->puntaje_entrevista, $puntaje_final));
        }
        $pdf->Ln();

        //exit();
        $pdf->Output();
    }

    public function gestionencuestasAction($id_alumno)
    {
        $this->view->disable();



        $dato_alumno = Alumnos::findFirstBycodigo($id_alumno);
        $carrera = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $semestre = Semestres::findFirst(
            [
                "activo = 'M'",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $pdf = new PDF();

        // print($id_alumno);
        // exit();


        $ea = EncuestasAlumnos::find("id_alumno = '$id_alumno' AND id_encuesta = 1");

        foreach ($ea as $encuestasAlumnos) {

            // echo "<pre>";
            // print_r("id_asignatura: ".$encuestasAlumnos->id_alumno);

            $pdf->AddPage();
            $pdf->Image('webpage/assets/img/logo-vr.png', 120, 10, 54);
            // Arial bold 15
            $pdf->SetFont('Arial', 'B', 12);
            // Title
            $pdf->Cell(190, 15, 'FORMATO 1. PARA ESTUDIANTES POR CURSO', 1, 0, 'L');
            // Line break
            $pdf->Ln(16);

            //Titulo
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(190, 8, 'ENCUESTA DE EVALUACIÓN DE DESEMPEÑO DOCENTE POR ESTUDIANTES', 0, 0, 'C');
            $pdf->Ln(6);

            //Subtitulos
            $pdf->SetFont('Arial', '', 9);
            $encuestas = Encuestas::findFirstByid_encuesta((int) 1);

            $pdf->Multicell(190, 4, $encuestas->indicaciones, 0, 'L', 0);

            //$pdf->Multicell(190, 5, 'Al estudiante se le solicita ser justo, responsable y explícito en sus respuestas.' . "\n", 0, 'L', 0);
            $pdf->Ln(2);

            //Datos generales
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(50, 5, 'DATOS GENERALES:', 0, 1, 'L');

            //Nombre del curso
            //Consultamos alumnos_encuestas con el codigo de alumnos_encuestas (datatables)
            $asignatura = Asignaturas::findFirstBycodigo($encuestasAlumnos->id_asignatura);


            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(50, 5, 'NOMBRE DEL CURSO', 0, 0, 'L');
            $pdf->Cell(50, 5, ": {$asignatura->nombre}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(50, 5, 'GRUPO', 0, 0, 'L');
            $pdf->Cell(50, 5, ": {$encuestasAlumnos->id_grupo}", 0, 0, 'L');
            $pdf->Ln();

            $pdf->Cell(50, 5, 'CICLO ACADEMICO', 0, 0, 'L');
            $pdf->Cell(50, 5, ": {$asignatura->ciclo}", 0, 0, 'L');
            $pdf->Ln();




            //echo "<pre>";        print_r($encuestasAlumnos->asignatura);exit();
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
                Asignaturas.codigo = '{$encuestasAlumnos->id_asignatura}'
                AND DocentesAsignaturas.semestre = {$semestre->codigo}
                AND DocentesAsignaturas.grupo = {$encuestasAlumnos->id_grupo}");
            $docente_result = $docente->execute();



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
                ->from('Encuestas')
                ->columns('TipoPreguntas.codigo,
                            TipoPreguntas.nombres')
                ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
                ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
                ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
                ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36")
                ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
                ->getQuery()
                ->execute();


            //Pregunta
            $preguntas = $this->modelsManager->createBuilder()
                ->from('Encuestas')
                ->columns('Encuestas.id_tipo_encuesta,
                        Encuestas.descripcion,
                        TipoPreguntas.codigo,
                        TipoPreguntas.descripcion AS tipo_pregunta,
                        EncuestasPreguntas.id_encuesta_pregunta AS codigo_pregunta,
                        EncuestasPreguntas.descripcion AS pregunta,
                        RespuestasAlumnos.id_encuesta_alumno,
                        RespuestasAlumnos.valor, EncuestasPreguntas.numero')
                ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
                ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
                ->join('RespuestasAlumnos', 'RespuestasAlumnos.id_encuesta_pregunta = EncuestasPreguntas.id_encuesta_pregunta')
                ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36 AND RespuestasAlumnos.id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno")
                ->orderBy('EncuestasPreguntas.numero ASC')
                ->getQuery()
                ->execute();





            foreach ($tipo_de_pregunta as $tipo_de_pregunta_query) {
                //echo "<pre>";
                //print_r($docente_query->nombres);
                $pdf->Cell(190, 5, "$tipo_de_pregunta_query->nombres", 1, 1, 'C');
                //Tipo de pregunta
                $codigo_tipo_pregunta = $tipo_de_pregunta_query->codigo;

                foreach ($preguntas as $encuestas_model_query) {
                    if ($encuestas_model_query->codigo == $codigo_tipo_pregunta) {

                        //Pregunta
                        $pdf->Cell(10, 5, "$encuestas_model_query->numero", 1, 0, 'L');
                        $pdf->Cell(150, 5, "$encuestas_model_query->pregunta", 1, 0, 'L');
                        $pdf->Cell(30, 5, "$encuestas_model_query->valor", 1, 1, 'C');
                    }
                }

                //exit();
            }

            // print("Llega XD");
            // exit();


            $pdf->Cell(90, 5, '¿Le gustaria llevar otra asignatura con el docente?', 0, 0, 'L');
            if ($encuestasAlumnos->chk_like == '0') {
                $respuestaLike = 'No';
            } elseif ($encuestasAlumnos->chk_like == '1') {
                $respuestaLike = 'Si';
            } else {
                $respuestaLike = '';
            }
            $pdf->Cell(100, 5, $respuestaLike, 0, 1, 'L');

            $pdf->Cell(90, 5, 'Comentario o recomendaciones: ' . $encuestasAlumnos->recomendacion, 0, 0, 'L');

            $pdf->Ln(12);

            $pdf->Ln(12);
            $pdf->Cell(10);
            $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
            $pdf->Cell(30);
            $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
            $pdf->Ln();

            $pdf->Cell(10);
            $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
            $pdf->Cell(30);
            $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
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
            $pdf->Ln(4);
            $pdf->Ln(8);
            $pdf->Cell(50);
            $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');
        }
        //exit();

        $pdf->Output();
    }

    public function test1Action($id_alumno)
    {
        $this->view->disable();


        $alumno = Alumnos::findFirstBycodigo($id_alumno);

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
        $pdf->Image('webpage/assets/img/logo-vr.png', 120, 10, 54);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 12);
        // Title
        $pdf->Cell(190, 15, 'FORMATO 1. PARA ESTUDIANTES POR CURSO', 1, 0, 'L');
        // Line break
        $pdf->Ln(16);

        //Titulo
        $pdf->SetFont('Arial', 'B', 13);
        $encuestas = Encuestas::findFirstByid_encuesta((int) 4);
        $pdf->Cell(190, 8, $encuestas->descripcion, 0, 0, 'C');
        $pdf->Ln(6);

        //Subtitulos
        $pdf->SetFont('Arial', '', 9);


        $pdf->Multicell(190, 4, $encuestas->indicaciones, 0, 'L', 0);

        //$pdf->Multicell(190, 5, 'Al estudiante se le solicita ser justo, responsable y explícito en sus respuestas.' . "\n", 0, 'L', 0);
        $pdf->Ln(2);

        //Datos generales
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 5, 'DATOS GENERALES:', 0, 1, 'L');

        //Nombre del curso
        //Consultamos alumnos_encuestas con el codigo de alumnos_encuestas (datatables)
        $encuestasAlumnos = EncuestasAlumnos::findFirst("id_encuesta = 4 AND id_semestre = $semestre->codigo AND id_alumno = '$id_alumno'");

        $db = $this->db;
        $sql = "SELECT
        public.alumnos.codigo,
        public.alumnos_semestre.ciclo,
        public.carreras.descripcion AS carrera
        FROM
        public.alumnos
        INNER JOIN public.alumnos_semestre ON public.alumnos.codigo = public.alumnos_semestre.alumno AND public.alumnos.semestre = public.alumnos_semestre.semestre
        INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
        public.alumnos.codigo = '$id_alumno'";
        $datos = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'CICLO ACADEMICO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$datos->ciclo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(50, 5, 'CARRERA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$datos->carrera}", 0, 1, 'L');

        $pdf->Cell(50, 5, 'NOMBRES Y APELLIDOS', 0, 0, 'L');
        $pdf->Cell(50, 5, ": ". $alumno->apellidosp." ".$alumno->apellidom." ".$alumno->nombres, 0, 0, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Arial', '', 9);

        $pdf->Cell(160, 10, 'CRITERIOS DE EVALUACION', 1, 0, 'C', 0);
        $pdf->MultiCell(30, 5, 'RESPUESTA VALORATIVA', 1, 'C', 0);



        //Tipo de pregunnta
        $tipo_de_preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('TipoPreguntas.codigo,
                    TipoPreguntas.nombres')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 3 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->getQuery()
            ->execute();


        //Pregunta
        $preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    TipoPreguntas.codigo,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion,
                    RespuestasAlumnos.id_encuesta_alumno,
                    RespuestasAlumnos.valor, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('RespuestasAlumnos', 'RespuestasAlumnos.id_encuesta_pregunta = EncuestasPreguntas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 3 AND TipoPreguntas.numero = 36 AND RespuestasAlumnos.id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno")
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();

        // foreach ($preguntas as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->numero . $value->descripcion);
        // }
        // exit();



        //$header = array('N°', 'CRITERIOS DE EVALUACION', 'REST VALORATIVA');

        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        //$w = array(10, 150, 30);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 150, 30));
        $pdf->SetAligns(array('C', 'L', 'C'));

        


        foreach ($tipo_de_preguntas as $tipo_de_pregunta) {
            //echo "<pre>";
            //print_r($docente_query->nombres);
            $pdf->Cell(190, 5, "$tipo_de_pregunta->nombres", 1, 1, 'C');
            //Tipo de pregunta
            $id_tipo_pregunta = $tipo_de_pregunta->codigo;

            $suma = 0;
            foreach ($preguntas as $pregunta) {
                if ($pregunta->codigo == $id_tipo_pregunta) {
                    $pdf->row(array($pregunta->numero, $pregunta->descripcion, $pregunta->valor));
                }
                $suma += (float)$pregunta->valor;
            }
        }

        $pdf->Cell(160, 10, 'TOTAL', 1, 0, 'C', 0);
        $pdf->Cell(30, 10,  $suma, 1, 1, 'C', 0);


        // print("Llega XD");
        // exit();
        


        $pdf->Cell(90, 5, '¿Le gustaria llevar otra asignatura con el docente?', 0, 0, 'L');
        if ($encuestasAlumnos->chk_like == '0') {
            $respuestaLike = 'No';
        } elseif ($encuestasAlumnos->chk_like == '1') {
            $respuestaLike = 'Si';
        } else {
            $respuestaLike = '';
        }
        $pdf->Cell(100, 5, $respuestaLike, 0, 1, 'L');

        $pdf->Cell(90, 5, 'Comentario o recomendaciones: ' . $encuestasAlumnos->recomendacion, 0, 0, 'L');

        $pdf->Ln(12);

        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
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
        $pdf->Ln(4);
        $pdf->Ln(8);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');
        $pdf->Output();
    }

    public function test2Action($id_alumno)
    {
        $this->view->disable();


        $alumno = Alumnos::findFirstBycodigo($id_alumno);

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
        $pdf->Image('webpage/assets/img/logo-vr.png', 120, 10, 54);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 12);
        // Title
        $pdf->Cell(190, 15, 'FORMATO 1. PARA ESTUDIANTES POR CURSO', 1, 0, 'L');
        // Line break
        $pdf->Ln(16);

        //Titulo
        $pdf->SetFont('Arial', 'B', 13);
        $encuestas = Encuestas::findFirstByid_encuesta((int) 5);
        $pdf->Cell(190, 8, $encuestas->descripcion, 0, 0, 'C');
        $pdf->Ln(6);

        //Subtitulos
        $pdf->SetFont('Arial', '', 9);


        $pdf->Multicell(190, 4, $encuestas->indicaciones, 0, 'L', 0);

        //$pdf->Multicell(190, 5, 'Al estudiante se le solicita ser justo, responsable y explícito en sus respuestas.' . "\n", 0, 'L', 0);
        $pdf->Ln(2);

        //Datos generales
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 5, 'DATOS GENERALES:', 0, 1, 'L');

        //Nombre del curso
        //Consultamos alumnos_encuestas con el codigo de alumnos_encuestas (datatables)
        $encuestasAlumnos = EncuestasAlumnos::findFirst("id_encuesta = 5 AND id_semestre = $semestre->codigo AND id_alumno = '$id_alumno'");

        $db = $this->db;
        $sql = "SELECT
        public.alumnos.codigo,
        public.alumnos_semestre.ciclo,
        public.carreras.descripcion AS carrera
        FROM
        public.alumnos
        INNER JOIN public.alumnos_semestre ON public.alumnos.codigo = public.alumnos_semestre.alumno AND public.alumnos.semestre = public.alumnos_semestre.semestre
        INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
        public.alumnos.codigo = '$id_alumno'";
        $datos = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'CICLO ACADEMICO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$datos->ciclo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(50, 5, 'CARRERA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$datos->carrera}", 0, 1, 'L');

        $pdf->Cell(50, 5, 'NOMBRES Y APELLIDOS', 0, 0, 'L');
        $pdf->Cell(50, 5, ": ". $alumno->apellidosp." ".$alumno->apellidom." ".$alumno->nombres, 0, 0, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Arial', '', 9);

        $pdf->Cell(160, 10, 'CRITERIOS DE EVALUACION', 1, 0, 'C', 0);
        $pdf->MultiCell(30, 5, 'RESPUESTA VALORATIVA', 1, 'C', 0);



        //Tipo de pregunnta
        $tipo_de_preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('TipoPreguntas.codigo,
                    TipoPreguntas.nombres')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 3 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->getQuery()
            ->execute();


        //Pregunta
        $preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    TipoPreguntas.codigo,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion,
                    RespuestasAlumnos.id_encuesta_alumno,
                    RespuestasAlumnos.valor, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('RespuestasAlumnos', 'RespuestasAlumnos.id_encuesta_pregunta = EncuestasPreguntas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 3 AND TipoPreguntas.numero = 36 AND RespuestasAlumnos.id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno")
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();

        // foreach ($preguntas as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->numero . $value->descripcion);
        // }
        // exit();



        //$header = array('N°', 'CRITERIOS DE EVALUACION', 'REST VALORATIVA');

        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        //$w = array(10, 150, 30);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 150, 30));
        $pdf->SetAligns(array('C', 'L', 'C'));

        


        foreach ($tipo_de_preguntas as $tipo_de_pregunta) {
            //echo "<pre>";
            //print_r($docente_query->nombres);
            $pdf->Cell(190, 5, "$tipo_de_pregunta->nombres", 1, 1, 'C');
            //Tipo de pregunta
            $id_tipo_pregunta = $tipo_de_pregunta->codigo;

            $suma = 0;
            foreach ($preguntas as $pregunta) {
                if ($pregunta->codigo == $id_tipo_pregunta) {
                    $pdf->row(array($pregunta->numero, $pregunta->descripcion, $pregunta->valor));
                }
                $suma += (float)$pregunta->valor;
            }
        }

        $pdf->Cell(160, 10, 'TOTAL', 1, 0, 'C', 0);
        $pdf->Cell(30, 10,  $suma, 1, 1, 'C', 0);


        // print("Llega XD");
        // exit();
        


        $pdf->Cell(90, 5, '¿Le gustaria llevar otra asignatura con el docente?', 0, 0, 'L');
        if ($encuestasAlumnos->chk_like == '0') {
            $respuestaLike = 'No';
        } elseif ($encuestasAlumnos->chk_like == '1') {
            $respuestaLike = 'Si';
        } else {
            $respuestaLike = '';
        }
        $pdf->Cell(100, 5, $respuestaLike, 0, 1, 'L');

        $pdf->Cell(90, 5, 'Comentario o recomendaciones: ' . $encuestasAlumnos->recomendacion, 0, 0, 'L');

        $pdf->Ln(12);

        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
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
        $pdf->Ln(4);
        $pdf->Ln(8);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');
        $pdf->Output();
    }

    public function test3Action($id_alumno)
    {
        $this->view->disable();


        $alumno = Alumnos::findFirstBycodigo($id_alumno);

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
        $pdf->Image('webpage/assets/img/logo-vr.png', 120, 10, 54);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 12);
        // Title
        $pdf->Cell(190, 15, 'FORMATO 1. PARA ESTUDIANTES POR CURSO', 1, 0, 'L');
        // Line break
        $pdf->Ln(16);

        //Titulo
        $pdf->SetFont('Arial', 'B', 13);
        $encuestas = Encuestas::findFirstByid_encuesta((int) 6);
        $pdf->Cell(190, 8, $encuestas->descripcion, 0, 0, 'C');
        $pdf->Ln(6);

        //Subtitulos
        $pdf->SetFont('Arial', '', 9);


        $pdf->Multicell(190, 4, $encuestas->indicaciones, 0, 'L', 0);

        //$pdf->Multicell(190, 5, 'Al estudiante se le solicita ser justo, responsable y explícito en sus respuestas.' . "\n", 0, 'L', 0);
        $pdf->Ln(2);

        //Datos generales
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 5, 'DATOS GENERALES:', 0, 1, 'L');

        //Nombre del curso
        //Consultamos alumnos_encuestas con el codigo de alumnos_encuestas (datatables)
        $encuestasAlumnos = EncuestasAlumnos::findFirst("id_encuesta = 6 AND id_semestre = $semestre->codigo AND id_alumno = '$id_alumno'");

        $db = $this->db;
        $sql = "SELECT
        public.alumnos.codigo,
        public.alumnos_semestre.ciclo,
        public.carreras.descripcion AS carrera
        FROM
        public.alumnos
        INNER JOIN public.alumnos_semestre ON public.alumnos.codigo = public.alumnos_semestre.alumno AND public.alumnos.semestre = public.alumnos_semestre.semestre
        INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
        public.alumnos.codigo = '$id_alumno'";
        $datos = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, 'CICLO ACADEMICO', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$datos->ciclo}", 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(50, 5, 'CARRERA PROFESIONAL', 0, 0, 'L');
        $pdf->Cell(50, 5, ": {$datos->carrera}", 0, 1, 'L');

        $pdf->Cell(50, 5, 'NOMBRES Y APELLIDOS', 0, 0, 'L');
        $pdf->Cell(50, 5, ": ". $alumno->apellidosp." ".$alumno->apellidom." ".$alumno->nombres, 0, 0, 'L');
        $pdf->Ln(6);

        $pdf->SetFont('Arial', '', 9);

        $pdf->Cell(160, 10, 'CRITERIOS DE EVALUACION', 1, 0, 'C', 0);
        $pdf->MultiCell(30, 5, 'RESPUESTA VALORATIVA', 1, 'C', 0);



        //Tipo de pregunnta
        $tipo_de_preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('TipoPreguntas.codigo,
                    TipoPreguntas.nombres')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 2 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->getQuery()
            ->execute();


        //Pregunta
        $preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    TipoPreguntas.codigo,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion,
                    RespuestasAlumnos.id_encuesta_alumno,
                    RespuestasAlumnos.valor, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('RespuestasAlumnos', 'RespuestasAlumnos.id_encuesta_pregunta = EncuestasPreguntas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 2 AND TipoPreguntas.numero = 36 AND RespuestasAlumnos.id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno")
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();

        // foreach ($preguntas as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->numero . $value->descripcion);
        // }
        // exit();



        //$header = array('N°', 'CRITERIOS DE EVALUACION', 'REST VALORATIVA');

        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 8);
        // Header
        //$w = array(10, 150, 30);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 150, 30));
        $pdf->SetAligns(array('C', 'L', 'C'));

        


        foreach ($tipo_de_preguntas as $tipo_de_pregunta) {
            //echo "<pre>";
            //print_r($docente_query->nombres);
            $pdf->Cell(190, 5, "$tipo_de_pregunta->nombres", 1, 1, 'C');
            //Tipo de pregunta
            $id_tipo_pregunta = $tipo_de_pregunta->codigo;

            $suma = 0;
            foreach ($preguntas as $pregunta) {
                if ($pregunta->codigo == $id_tipo_pregunta) {
                    $pdf->row(array($pregunta->numero, $pregunta->descripcion, $pregunta->valor));
                }
                $suma += (float)$pregunta->valor;
            }
        }

        $pdf->Cell(160, 10, 'TOTAL', 1, 0, 'C', 0);
        $pdf->Cell(30, 10,  $suma, 1, 1, 'C', 0);


        // print("Llega XD");
        // exit();
        


        $pdf->Cell(90, 5, '¿Le gustaria llevar otra asignatura con el docente?', 0, 0, 'L');
        if ($encuestasAlumnos->chk_like == '0') {
            $respuestaLike = 'No';
        } elseif ($encuestasAlumnos->chk_like == '1') {
            $respuestaLike = 'Si';
        } else {
            $respuestaLike = '';
        }
        $pdf->Cell(100, 5, $respuestaLike, 0, 1, 'L');

        $pdf->Cell(90, 5, 'Comentario o recomendaciones: ' . $encuestasAlumnos->recomendacion, 0, 0, 'L');

        $pdf->Ln(12);

        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '______________________________', 0, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(70, 5, '    ESTUDIANTE', 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(70, 5, '    CONSEJERO', 0, 0, 'C');
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
        $pdf->Ln(4);
        $pdf->Ln(8);
        $pdf->Cell(50);
        $pdf->Cell(65, 5, 'NOTA:Este documento carece de valor oficial sin la firma del responsable de la Dirección de Registros Académicos', 0, 0, 'C');
        $pdf->Output();
    }


    public function concursodocentesAction($fecha_inicio = null, $fecha_fin = null)
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

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 25, 'RELACIÓN DE POSTULANTES', 0, 0, 'C');
        $pdf->Ln(20);

        $header = array('N°', 'CÓDIGO', 'APELLIDOS Y NOMBRES', 'NRO DOC', 'CELULAR', 'EMAIL', 'FECHA INSCRIPCIÓN', 'NRO RECIBO', 'MONTO', 'PROCESO');
        $pdf->Ln(5);
        $pdf->SetFillColor(250, 250, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 6);
        // Header
        $w = array(10, 10, 50, 15, 15, 25, 25, 15, 10, 15);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }

        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetWidths(array(10, 10, 50, 15, 15, 25, 25, 15, 10, 15));
        $pdf->SetAligns(array('C', 'C', 'L', 'C', 'C', 'L', 'C','C','C','C'));

        $where = "((CAST (fecha_recibo AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}'))";
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
                procesos.numero = 106) AS temporal_table ";

        // print($sql_query);
        // exit();

        $data = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

        $pdf->SetFont('Arial', '', 5);
        foreach ($data as $key => $robot) {

            $pdf->row(array($key + 1, $robot->publico, $robot->nombres_apellidos, $robot->nro_doc, $robot->celular, $robot->email, $robot->fecha_recibo, $robot->nro_recibo, $robot->monto_recibo, $robot->proceso));
        }
        $pdf->Ln();
        $pdf->Output();
    }
}
