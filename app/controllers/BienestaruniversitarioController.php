<?php

class BienestaruniversitarioController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/alumnosficha.js?v=" . uniqid());
    }

    public function indexAction($sem) {


        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    public function socialAction($sem) {


        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    public function psicopedagogicoAction($sem) {


        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }


    public function saludAction($sem) {


        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    public function bajorendimientoAction($sem) {
        

        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    public function tutoriaAction($sem) {
        

        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    public function actividadesAction($sem) {
        

        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    
    public function eventosAction($sem) {
        

        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    public function talleresAction($sem) {
        

        $semestre_a = Semestres::findFirst("activo = 'M'");

        //print_r($semestre_a->codigo);
        //exit();

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

}
