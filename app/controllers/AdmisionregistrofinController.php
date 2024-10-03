<?php

class AdmisionregistrofinController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        //$this->assets->addJs("adminpanel/js/modulos/admision.proceso.js?v=" . uniqid());
    }

    public function indexAction($id = null) {
        //$Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        //echo '<pre>';
        //print_r($Postulante->codigo);
        //exit();

        if ($id != null) {
            $Postulante = Publico::findFirstBycodigo((int) $id);
            $this->view->id = $id;
        } else {
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        }


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

        $this->view->codigo_postulante = $new_codigo;
        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $admision = Admision::findFirst("activo = 'M'");
        $this->view->admision_m = $admision;

        $postulante = $Postulante->codigo;
        $admision_m = $admision->codigo;

        $admision = AdmisionPostulantes::findFirst(
                        [
                            "postulante = $postulante AND admision = $admision_m "
                        ]
        );

        //print("Admision - Modalidad: ".$admision->modalidad);
        //exit();


        $this->view->admision = $admision;

        //modalidad
        $admision_modalidad = $admision->modalidad;
        $modalidad = Modalidad::findFirst(
                        [
                            "estado = 'A' AND numero = 21 AND codigo = $admision_modalidad"
                        ]
        );

        //print("Modalidad: ".$modalidad->nombres);
        //exit();

        $this->view->modalidad = $modalidad;

        //tipo
        $admision_tipo = $admision->tipo_inscripcion;
        $tipo = TipoExamen::findFirst(
                        [
                            "estado = 'A' AND numero = 22 AND codigo = $admision_tipo"
                        ]
        );
        $this->view->tipo = $tipo;

        //concepto
        $admision_concepto = $admision->concepto;
        $concepto = Conceptos::findFirstBycodigo("$admision_concepto");
        $this->view->conceptos = $concepto;

        //carrea1
        $admision_carrera1 = $admision->carrera1;
        $carrera1 = Carreras::findFirst(
                        [
                            "estado = 'A' AND codigo = '$admision_carrera1'"
                        ]
        );
        $this->view->carrera1 = $carrera1;


        //carrea2
        $admision_carrera2 = $admision->carrera2;
        $carrera2 = Carreras::findFirst(
                        [
                            "estado = 'A' AND codigo = '$admision_carrera2'"
                        ]
        );
        $this->view->carrera2 = $carrera2;
    }

}
