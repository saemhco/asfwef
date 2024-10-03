<?php

class HorariosController  extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction($turno = NULL) {
        if ($turno && $turno != "0") {
            $horas = Horas::find("turno={$turno} AND estado='A' ");
        } else {
            $horas = Horas::find("estado='A'");
        }

        /* Calculamos el semestre actual */
        $SemestreM = Semestres::findFirst("activo = 'M'");

        $this->view->semestre = $SemestreM;
        /* fin semestre */
        

        $this->view->horas = $horas;

        
        $alu = $this->session->get("auth")["codigo"];
        

        if (is_null($turno)) {
            $turno = 0;
        }


        $this->view->c_alumno = $alu;
        $this->view->c_turno = $turno;

        //print($this->session->get("auth")["perfil"]);
        //exit();

        $perfil = $this->session->get("auth")["perfil"];
        $this->view->perfil = $perfil;

        $titulo = $this->config->global->xCarreraIns;
        $this->view->titulo = $titulo;

        $this->assets->addJs("adminpanel/js/modulos/horarios.js?v=" . uniqid());
        
    }    

    public function pdfAction(){
        $this->view->disable();
        $pdf=new PDFTABLE();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);

        $html='<table border="1">
        <tr>
        <td width="200" >
                cell 1 <br> \n
                 Millerbr  <br>  \n
                 xdxds
        </td>
        </tr>
       
        </table>';

        $pdf->WriteHTML($html);
        $pdf->Output();
    }
}
