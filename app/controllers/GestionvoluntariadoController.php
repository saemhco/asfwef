<?php

class GestionvoluntariadoController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

//datos
    public function datosAction() {
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico;

//Modelo documentos(a_codigos)        
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

//Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

//colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

//estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

//Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;


        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatorias.datos.js?v" . uniqid());
    }

//saveDatos
    public function saveDatosAction() {

//        echo '<pre>';
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoVoluntariado = PublicoVoluntariado::findFirstBycodigo($id);

                $PublicoVoluntariado->codigo = $this->request->getPost("codigo");
                $PublicoVoluntariado->tipo = 3;
                $PublicoVoluntariado->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoVoluntariado->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoVoluntariado->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoVoluntariado->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoVoluntariado->documento = 1;
                $PublicoVoluntariado->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoVoluntariado->celular = $this->request->getPost("celular", "string");
                $PublicoVoluntariado->email = $this->request->getPost("email", "string");
                $PublicoVoluntariado->direccion = strtoupper($this->request->getPost("direccion", "string"));

                $voluntariado = $this->request->getPost("voluntariado", "string");
                if (isset($voluntariado)) {

                    $PublicoVoluntariado->voluntariado = 1;
                } else {

                    $PublicoVoluntariado->voluntariado = "";
                }

                //$PublicoVoluntariado->password = $this->request->getPost("password", "string");

                $password_postulantes = $this->request->getPost("password", "string");
                $PublicoVoluntariado->password = $this->security->hash($password_postulantes);


                $PublicoVoluntariado->estado = "A";


                $PublicoVoluntariado->sexo = $this->request->getPost("sexo", "int");

                $PublicoVoluntariado->expectativas = $this->request->getPost("expectativas", "string");
                $PublicoVoluntariado->sobre_ti = $this->request->getPost("sobre_ti", "string");

                if ($PublicoVoluntariado->save() == false) {
                // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoVoluntariado->getMessages());
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

}
