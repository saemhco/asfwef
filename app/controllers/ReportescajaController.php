<?php

require_once APP_PATH . '/app/library/pdf.php';

class ReportescajaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        //$this->assets->addJs("adminpanel/js/modulos/reportes.js?v=" . uniqid());
    }

    public function indexAction() {
        $semestre_a = Semestres::findFirst("activo = 'M'");
        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->semestres = $semestres;
    }

}
