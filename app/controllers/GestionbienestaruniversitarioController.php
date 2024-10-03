<?php

class GestionbienestaruniversitarioController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestionbienestaruniversitario.js?v=" . uniqid());
    }

    public function indexAction() {

    }

    public function fichasocioeconomicaAction() {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if($alumno->tipo == 2){
            return $this->response->redirect("datos/egresado");
        }


        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;


        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

    public function testpsicologicoAction() {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if($alumno->tipo == 2){
            return $this->response->redirect("datos/egresado");
        }


        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;


        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

    public function bajorendimientoAction() {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if($alumno->tipo == 2){
            return $this->response->redirect("datos/egresado");
        }


        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;


        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

    public function cita3Action() {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if($alumno->tipo == 2){
            return $this->response->redirect("datos/egresado");
        }


        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;


        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

    public function publicacionesAction() {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if($alumno->tipo == 2){
            return $this->response->redirect("datos/egresado");
        }


        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;


        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

    public function registroeventosAction() {

        $alumno = Alumnos::findFirstBycodigo($this->session->get("auth")["codigo"]);


        if($alumno->tipo == 2){
            return $this->response->redirect("datos/egresado");
        }


        $this->assets->addJs("adminpanel/js/modulos/datos.alumno.js?v=" . uniqid() . "");
        $this->view->alumnos = $alumno;

        //Modelo Tipoalumnos(a_codigos)
        $tipoalumnos = TipoAlumnos::find("estado = 'A' AND numero = 16 ");
        $this->view->tipoalumnos = $tipoalumnos;

        //Modelo idiomas
        $idiomaalumnos = IdiomaAlumnos::find("estado = 'A' AND numero = 25 ");
        $this->view->idiomaalumnos = $idiomaalumnos;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //Modelo docuementos(a_codigos)
        $documentoalumnos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentoalumnos = $documentoalumnos;

        //Modelo sexoalumnos(a_codigos)
        $sexoalumnos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexoalumnos = $sexoalumnos;

        //Modelo seguro(a_codigos)
        $segurosalumnos = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguroalumnos = $segurosalumnos;


        //Modelo Estado civil
        $estadocivil = EstadoCivil::find("estado = 'A' AND numero = 26");
        $this->view->estadocivil = $estadocivil;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //tipo de discapacidad
        $TipoDiscapacidad = TipoDiscapacidad::find("estado = 'A' AND numero = 76");
        $this->view->tipodiscapacidad = $TipoDiscapacidad;
    }

}
