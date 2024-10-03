<?php

class AdmisionregistroController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/admision.registro.js?v=" . uniqid());
    }

    public function indexAction($id= null) {

        //echo '<pre>';
        //print_r($id);
        //exit();
        
        if($id != null){
            $Postulante = Publico::findFirstBycodigo((int)$id);
             $this->view->id = $id;
        }else{
            $Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]); 
        }
       

        //echo '<pre>';
        //print_r($Postulante->password);
        //exit();

        $this->view->postulante = $Postulante;

        //semestre -> m
        //Modelo Semestre (a_codigos)
        $semestres = Semestres::findFirst("activo = 'M'");
        $this->view->semestre_admision = $semestres;


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
        $carreras = Carreras::find("estado = 'A'");
        $this->view->carreras = $carreras;

        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;




        $verifica = Admision::findFirst("postulante = {$Postulante->codigo}");

        //echo '<pre>';
        //print_r($verifica->postulante);
        //exit();

        if ($verifica->postulante == $Postulante->codigo) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("admisionregistrofin");
        }
    }

    public function saveAction() {


        //echo "<pre>";
        //print_r($_FILES['file_imagen']['name']);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $postulante = (int) $this->request->getPost("postulante", "int");
                $semestre = (int) $this->request->getPost("semestre", "int");

                //$Personal = Personal::findFirstByid_personal($id);
                $Admision = Admision::findFirst(
                                [
                                    "postulante = $postulante AND semestre = $semestre"
                                ]
                );
                //Valida cuando es nuevo

                $Admision = (!$Admision) ? new Admision() : $Admision;

                $Admision->postulante = $this->request->getPost("postulante", "int");
                $Admision->semestre = $this->request->getPost("semestre", "int");
                $Admision->modalidad = $this->request->getPost("modalidad", "int");

                //fecha_inscripcion
                if ($this->request->getPost("fecha_inscripcion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inscripcion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Admision->fecha_inscripcion = date('Y-m-d', strtotime($fecha_new));
                }
                $Admision->tipo_inscripcion = $this->request->getPost("tipo_inscripcion", "int");


                $Admision->nro_documento = $this->request->getPost("nro_documento", "string");
                $Admision->monto = $this->request->getPost("monto", "string");
                $Admision->concepto = $this->request->getPost("concepto", "string");
                $Admision->carrera1 = $this->request->getPost("carrera1", "int");
                $Admision->carrera2 = $this->request->getPost("carrera2", "int");


                $imagen_voucher = $_FILES['file_imagen']['name'];


                $Admision->imagen = $imagen_voucher;

                if ($Admision->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Admision->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();

                            if ($file->getKey() == "file_imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    $url_destino = 'adminpanel/imagenes/imagenes_admision/' . 'IMG' . '-' . $Admision->postulante . '.jpg';
                                    $Admision->imagen = 'IMG' . '-' . $Admision->postulante . ".jpg";

                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    $url_destino = 'adminpanel/imagenes/imagenes_admision/' . 'IMG' . '-' . $Admision->postulante . '.png';
                                    $Admision->imagen = 'IMG' . '-' . $Admision->postulante . ".png";

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Noticias->codigo . "-" . $file->getName();
                            }
                        }

                        $Admision->save();
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
