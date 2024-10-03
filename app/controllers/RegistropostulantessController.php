<?php

use App\Core\Constants\AdmisionProcesoConstante;


class RegistropostulantessController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction($id = null)
    {
        $esRegistrado = false;
        $postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $admisionPostulantes = AdmisionPostulantes::findFirst("postulante = {$postulante->codigo}");
        if ($admisionPostulantes != null) {
            $esRegistrado = true;
            if ($admisionPostulantes->proceso == AdmisionProcesoConstante::VERIFICADO) {
                return $this->response->redirect("registropostulantess/inscripcionfin");
            }
        }


        $this->view->codigo_postulante = $postulante->codigo;
        $this->view->postulante = $postulante;
        $this->view->admisionPostulantes = $admisionPostulantes;

        $semestres = Semestres::findFirst("activo = 'M'");
        $this->view->semestre_admision = $semestres;
        $admision_m = Admision::findFirst("activo = 'M'");
        $this->view->admision_m = $admision_m;
        $modalidad = Modalidad::find("estado = 'A' AND numero = 21");
        $this->view->modalidad = $modalidad;
        $tipo = TipoExamen::find("estado = 'A' AND numero = 22");
        $this->view->tipo = $tipo;
        $concepto = Conceptos::find();
        $this->view->conceptos = $concepto;
        $carreras = Carreras::find("estado = 'A' AND codigo <> '0001'");
        $this->view->carreras = $carreras;
        
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        
        $this->view->fecha_inscripcion = $admisionPostulantes->fecha_inscripcion;
        
        
        $this->view->es_registrado = $esRegistrado;
        $this->view->archivo_solicitud_02 = "";
        $this->view->voucher_file = "";
        $this->view->archivo_dni = "";
        $this->view->archivo_foto_carnet = "";
        $this->view->archivo_certificado_estudio_secundaria = "";
        $this->view->archivo_solicitud_03 = "";
        $this->view->file_upload_ext_value = "";
        if ($esRegistrado) {

            $admisionPostulantesArchivo = AdmisionPostulantesArchivo::find("id_postulante = {$postulante->codigo} and id_admision={$admisionPostulantes->admision}");
            $this->view->admisionPostulantesArchivo = $admisionPostulantesArchivo;

            foreach ($admisionPostulantesArchivo as $apa) {
                if ($apa->cod_tipo != 0) {
                    $this->view->file_upload_ext_value = $apa->archivo;
                }
                switch ($apa->desc_tipo) {
                    case 'VOUCHER-FILE':
                        $this->view->voucher_file = $apa->archivo;
                        break;
                    case 'ANEXO-02':
                        $this->view->archivo_solicitud_02 = $apa->archivo;
                        break;
                    case 'DNI':
                        $this->view->archivo_dni = $apa->archivo;
                        break;
                    case 'FOTO-CARNET':
                        $this->view->archivo_foto_carnet = $apa->archivo;
                        break;
                    case 'CERTIFICADO-ESTUDIO':
                        $this->view->archivo_certificado_estudio_secundaria = $apa->archivo;
                        break;
                    case 'ANEXO-03':
                        $this->view->archivo_solicitud_03 = $apa->archivo;
                        break;
                }
            }

            $admision = AdmisionPostulantes::findFirst(
                [
                    "postulante = $postulante->codigo AND admision = $admision_m->codigo",
                ]
            );

            $cod_desc =  Acodigos::findFirst(["numero=106 AND codigo=$admision->proceso"]);
            $this->view->admision = $admision;
            $this->view->proceso_id = $cod_desc->codigo;
            $this->view->proceso_desc = $cod_desc->nombres;

            //carrera1
            $admision_carrera1 = $admision->carrera1;
            $carrera1 = Carreras::findFirst(
                [
                    "estado = 'A' AND codigo = '$admision_carrera1'",
                ]
            );
            $this->view->carrera1 = $carrera1->codigo;
            $this->view->carrera2 = $carrera1->descripcion;
        }
        $this->assets->addJs("adminpanel/js/modulos/registropostulantess.js?v=" . uniqid());
    }

    public function inscripcionfinAction($id = null)
    {
        //$Postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        //echo '<pre>';
        //print_r($Postulante->codigo);
        //exit();

        $postulante = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $admisionPostulantes = AdmisionPostulantes::findFirst("postulante = {$postulante->codigo}");


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
        $this->view->admisionPostulantes = $admisionPostulantes;        


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
        if ($admision == null) {
            return $this->response->redirect("registropostulantess");
        }
        $cod_desc =  Acodigos::findFirst(["numero=106 AND codigo=$admision->proceso"]);
        $this->view->admision = $admision;
        $this->view->proceso_desc = $cod_desc->nombres;


        
        //carrera1
        $admision_carrera1 = $admision->carrera1;
        $carrera1 = Carreras::findFirst(
            [
                "estado = 'A' AND codigo = '$admision_carrera1'",
            ]
        );
        $this->view->carrera1 = $carrera1->codigo;
        $this->view->carrera2 = $carrera1->descripcion;

        $this->view->fecha_inscripcion = $admisionPostulantes->fecha_inscripcion;
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
