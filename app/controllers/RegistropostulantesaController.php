<?php

class RegistropostulantesaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction($id = null)
    {

        $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $verifica = AdmisionPostulantes::findFirst("postulante = {$Postulante->codigo}");

        if ($verifica->postulante == $Postulante->codigo) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("registropostulantesa/inscripcionfin");
        }

        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $semestres = Semestres::findFirst("activo = 'M'");
        // print($semestres->definicion);
        // exit();
        $this->view->semestre_admision = $semestres;

        //admision m
        $admision_m = Admision::findFirst("activo = 'M'");

        //print("Codigo admision: ".$admision_m->codigo);
        //exit();

        $this->view->admision_m = $admision_m;

        //modalidad
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;

        //tipo
        $tipo = TipoExamen::find("estado = 'A' AND numero = 22");
        $this->view->tipo = $tipo;

        //concepto
        $concepto = Conceptos::find();
        $this->view->conceptos = $concepto;

        //concepto
        $carreras = Carreras::find("estado = 'A' AND codigo <> '0001'");
        $this->view->carreras = $carreras;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $verifica = AdmisionPostulantes::findFirst("postulante = {$Postulante->codigo}");

        //echo '<pre>';
        //print_r("Valor:" . $verifica->postulante);
        //exit();

        if ($verifica->postulante == $Postulante->codigo) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            //return $this->response->redirect("admisionregistrofin");
            //return $this->response->redirect("gestionadmision/inscripcionfin");
        }

        $this->assets->addJs("adminpanel/js/modulos/registropostulantesa.js?v=" . uniqid());
    }

    public function inscripcionfinAction($id = null)
    {
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
        //$semestres = Semestres::findFirst("activo = 'M'");
        $admision_activo = Admision::findFirst("activo = 'M'");
        $this->view->admision_activo = $admision_activo;

        $postulante = $Postulante->codigo;
        $admision_m = $admision_activo->codigo;

        $admision = AdmisionPostulantes::findFirst(
            [
                "postulante = $postulante AND admision = $admision_m",
            ]
        );
        $this->view->admision = $admision;

        //modalidad
        $admision_modalidad = $admision->modalidad;

        $modalidad = Modalidad::findFirst(
            [
                "estado = 'A' AND numero = 21 AND codigo = $admision_modalidad",
            ]
        );

        //print($modalidad->nombres);
        //exit();

        $this->view->modalidad = $modalidad;

        //tipo
        $admision_tipo = $admision->tipo_inscripcion;
        $tipo = TipoExamen::findFirst(
            [
                "estado = 'A' AND numero = 22 AND codigo = $admision_tipo",
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
                "estado = 'A' AND codigo = '$admision_carrera1'",
            ]
        );
        $this->view->carrera1 = $carrera1;

        //carrea2
        $admision_carrera2 = $admision->carrera2;
        $carrera2 = Carreras::findFirst(
            [
                "estado = 'A' AND codigo = '$admision_carrera2'",
            ]
        );
        $this->view->carrera2 = $carrera2;
    }

    public function saveInscripcionAction()
    {

        //echo "<pre>";
        //print_r($_FILES['file_imagen']['name']);
        //exit();
        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $postulante = (int) $this->request->getPost("postulante", "int");
                $admision = (int) $this->request->getPost("admision", "int");

                //$Personal = Personal::findFirstByid_personal($id);
                $AdmisionPostulantes = AdmisionPostulantes::findFirst(
                    [
                        "postulante = $postulante AND admision = $admision",
                    ]
                );
                //Valida cuando es nuevo

                $AdmisionPostulantes = (!$AdmisionPostulantes) ? new AdmisionPostulantes() : $AdmisionPostulantes;

                $AdmisionPostulantes->postulante = $this->request->getPost("postulante", "int");
                //$AdmisionPostulantes->semestre = $this->request->getPost("semestre", "int");
                $AdmisionPostulantes->admision = $this->request->getPost("admision", "int");
                $AdmisionPostulantes->modalidad = $this->request->getPost("modalidad", "int");

                //fecha_inscripcion
                //                if ($this->request->getPost("fecha_inscripcion", "string") != "") {
                //                    $fecha_ex = explode("/", $this->request->getPost("fecha_inscripcion", "string"));
                //                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                //
                //                    $AdmisionPostulantes->fecha_inscripcion = date('Y-m-d', strtotime($fecha_new));
                //                    // $AdmisionPostulantes->fecha_inscripcion = date('Y-m-d H:i:s')
                //                }
                $AdmisionPostulantes->fecha_inscripcion = date('Y-m-d H:i:s');
                $AdmisionPostulantes->tipo_inscripcion = $this->request->getPost("tipo_inscripcion", "int");

                $AdmisionPostulantes->recibo = $this->request->getPost("recibo", "string");
                $AdmisionPostulantes->monto = $this->request->getPost("monto", "string");
                $AdmisionPostulantes->concepto = $this->request->getPost("concepto", "string");
                $AdmisionPostulantes->carrera1 = $this->request->getPost("carrera1", "int");
                $AdmisionPostulantes->carrera2 = $this->request->getPost("carrera2", "int");

                $imagen_voucher = $_FILES['file_imagen']['name'];

                $AdmisionPostulantes->imagen = $imagen_voucher;

                if ($AdmisionPostulantes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AdmisionPostulantes->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();

                            if ($file->getKey() == "file_imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    $url_destino = 'adminpanel/imagenes/admision/' . 'IMG' . '-' . $AdmisionPostulantes->postulante . '.jpg';
                                    $AdmisionPostulantes->imagen = 'IMG' . '-' . $AdmisionPostulantes->postulante . ".jpg";

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    $url_destino = 'adminpanel/imagenes/admision/' . 'IMG' . '-' . $AdmisionPostulantes->postulante . '.png';
                                    $AdmisionPostulantes->imagen = 'IMG' . '-' . $AdmisionPostulantes->postulante . ".png";

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                            }
                        }

                        $AdmisionPostulantes->save();
                    }

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
