<?php

class AsignaturashorariosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/asignaturas.ofertadas.js?v=" . uniqid());
        $auth = $this->session->get('auth');
        $this->view->auth = $auth;

        $semestre_m = Semestres::findFirst("activo = 'M'");

        $sql_horario = $this->modelsManager->createQuery("SELECT AlumnosPadres.codigo_padres, 
                parentesco.nombres AS parentesco_padres, AlumnosPadres.apellido_paterno_padres, 
                AlumnosPadres.apellido_materno_padres, AlumnosPadres.nombres_padres, sexo.descripcion AS sexo_padres, 
                AlumnosPadres.edad_padres, estado_civil.nombres AS estado_civil_padres, grado_instruccion.nombres AS grado_instruccion_padres,
                AlumnosPadres.ocupacion_padres,AlumnosPadres.ingresos_padres
                FROM AlumnosPadres
                INNER JOIN Parentescos parentesco ON AlumnosPadres.parentesco_padres = parentesco.codigo
                INNER JOIN Sexoalumnos sexo ON AlumnosPadres.sexo_padres = sexo.codigo
                INNER JOIN EstadoCivilFamiliares estado_civil ON AlumnosPadres.estado_civil_padres = estado_civil.codigo
                INNER JOIN GradoInstruccionFamiliares grado_instruccion ON AlumnosPadres.grado_instruccion_padres = grado_instruccion.codigo
                WHERE AlumnosPadres.alumno = '" . $codigo_alumno . "'
                AND parentesco.numero = 27 AND sexo.numero = 3 
                AND estado_civil.numero = 26 AND grado_instruccion.numero = 28 AND AlumnosPadres.estado = 'A'
                ORDER BY AlumnosPadres.codigo_padres ASC");
        $horario = $sql_horario->execute();
        //$this->view->horario = $horario;

//        foreach ($horario as $test) {
//
//            echo "<pre>";
//            print_r($test->nombre . '<br>');
//        }
//        exit();
    }

}
