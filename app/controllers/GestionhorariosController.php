<?php

class GestionhorariosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {


        $this->assets->addJs("adminpanel/js/modulos/gestionhorarios.js?v=" . uniqid());
    }

    public function ambientesAction($ambiente = NULL, $turno = NULL) {

        if ($turno && $turno != "0") {
            $horas = Horas::find("turno={$turno} AND estado='A' order by codigo");
        } else {
            $horas = Horas::find("estado='A' order by codigo");
        }

        /* Calculamos el semestre actual */
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $this->view->semestre = $semestre;
        /* fin semestre */

        $ambientes = AmbientesA::find();

        $this->view->horas = $horas;
        $this->view->ambientes = $ambientes;
        $this->view->c_ambiente = $ambiente;
        $this->view->c_turno = $turno;

        $this->assets->addJs("adminpanel/js/modulos/gestionhorarios.js?v=" . uniqid());
    }

    public function docentesAction($doc = NULL, $turno = NULL) {

       if ($turno && $turno != "0") {
            $horas = Horas::find("turno={$turno} AND estado='A' order by codigo");
        } else {
            $horas = Horas::find("estado='A' order by codigo");
        }

        /* Calculamos el semestre actual */
        $SemestreM = Semestres::findFirst("activo = 'M'");

        $this->view->semestre = $SemestreM;
        /* fin semestre */
        $Docentes = $this->modelsManager->createBuilder()
                ->from('DocentesSemestre')
                ->columns('Docentes.codigo,Docentes.apellidop,Docentes.apellidom,Docentes.nombres')
                ->join('Docentes', 'Docentes.codigo = DocentesSemestre.docente')
                ->where(" DocentesSemestre.semestre = {$SemestreM->codigo} AND (DocentesSemestre.estado = 'A')")
                ->getQuery()
                ->execute();

        $this->view->horas = $horas;
        $this->view->docentes = $Docentes;

        if (is_null($doc)) {
            $doc = $this->session->get("auth")["codigo"];
        }

        if (is_null($turno)) {
            $turno = 0;
        }


        $this->view->c_docente = $doc;
        $this->view->c_turno = $turno;

        //print($this->session->get("auth")["perfil"]);
        //exit();

        $perfil = $this->session->get("auth")["perfil"];
        $this->view->perfil = $perfil;

        $this->assets->addJs("adminpanel/js/modulos/gestionhorarios.js?v=" . uniqid());
    }

    public function asignaturasAction($asignatura = NULL, $turno = NULL) {
       if ($turno && $turno != "0") {
            $horas = Horas::find("turno={$turno} AND estado='A' order by codigo");
        } else {
            $horas = Horas::find("estado='A' order by codigo");
        }

        /* Calculamos el semestre actual */
        $SemestreM = Semestres::findFirst("activo = 'M'");

        $this->view->semestre = $SemestreM;
        /* fin semestre */

        $Asignaturas = $this->modelsManager->createBuilder()
                ->from('AsignaturasSemestre')
                ->columns('Asignaturas.nombre,Asignaturas.codigo')
                ->join('Asignaturas', 'Asignaturas.codigo = AsignaturasSemestre.asignatura')
                ->where(" AsignaturasSemestre.semestre = {$SemestreM->codigo} AND (AsignaturasSemestre.estado = 'A')")
                ->orderBy('Asignaturas.nombre')                
                ->getQuery()
                ->execute();

        $this->view->horas = $horas;
        $this->view->asignaturas = $Asignaturas;
        if (is_null($asignatura)) {
            $asignatura = 0;
        }
        $this->view->a_asignatura = $asignatura;
        if (is_null($turno)) {
            $turno = 0;
        }
        $this->view->a_turno = $turno;

        $this->assets->addJs("adminpanel/js/modulos/gestionhorarios.js?v=" . uniqid());
    }

}
