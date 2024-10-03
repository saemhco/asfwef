<?php

class RegistropostulantesController extends ControllerPanel
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
            return $this->response->redirect("registropostulantes/inscripcionfin");
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

        $this->assets->addJs("adminpanel/js/modulos/registropostulantes.js?v=" . uniqid());
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
    public function updateInscripcionAction()
    {
        ini_set('upload_max_size', '256M');
        ini_set('post_max_size', '256M');
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '512M');
        ini_set('display_erros', 1);
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $postulante = (int)$this->request->getPost("id_postulante", "int");
                $admision = (int)$this->request->getPost("id_admision", "int");
                $AdmisionPostulantes = AdmisionPostulantes::findFirst("postulante = {$postulante}  AND admision = {$admision}");

                if ($AdmisionPostulantes->proceso == 4) {
                    $AdmisionPostulantes->monto = $this->request->getPost("voucher_monto", "int");
                    $AdmisionPostulantes->recibo = $this->request->getPost("voucher_nro", "int");
                    $AdmisionPostulantes->save();
                }

                $publico = Publico::findFirst("codigo={$postulante}");
                $email_send = $publico->email;

                $path_init = 'adminpanel/archivos/admision_postulante_archivo/' . $AdmisionPostulantes->codigo_unico . '/';
                $desc = $this->request->getPost("desc_tipo_inscripcion", "string");
                if ($this->request->hasFiles() == true) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        $parseDesc = str_replace(" ", "-", $desc);
                        if ($file->getKey() == "voucher_file") {
                            $AdmisionPostulantesArchivo =  AdmisionPostulantesArchivo::findFirst("id_postulante = {$postulante}  AND id_admision = {$admision} AND desc_tipo='VOUCHER-FILE'");
                            if (!$AdmisionPostulantesArchivo) {
                                $AdmisionPostulantesArchivo = new AdmisionPostulantesArchivo();
                                $AdmisionPostulantesArchivo->id_admision = (int)$admision;
                                $AdmisionPostulantesArchivo->id_postulante = (int)$AdmisionPostulantes->postulante;
                            }

                            $filex = new SplFileInfo($file->getName());
                            $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                            $AdmisionPostulantesArchivo->cod_tipo = $AdmisionPostulantes->tipo_inscripcion;
                            $AdmisionPostulantesArchivo->desc_tipo =  'VOUCHER-FILE';
                            $AdmisionPostulantesArchivo->archivo = 'VOUCHER-FILE' . '.' . $filex->getExtension();
                            $url_destino = $path_init . 'VOUCHER-FILE' . '.' . $filex->getExtension();

                            if (!$file->moveTo($url_destino)) {
                            } else {
                                $AdmisionPostulantesArchivo->save();
                            }
                        } else if ($file->getKey() == "archivo_solicitud_02") {
                            $filex = new SplFileInfo($file->getName());
                            $url_destino = $path_init . 'ANEXO-02' . '.' . $filex->getExtension();
                            if (!$file->moveTo($url_destino)) {
                            } else {
                            }
                        } else if ($file->getKey() == "archivo_dni") {

                            $filex = new SplFileInfo($file->getName());
                            $url_destino = $path_init . 'DNI' . '.' . $filex->getExtension();

                            if (!$file->moveTo($url_destino)) {
                            } else {
                            }
                        } else if ($file->getKey() == "archivo_foto_carnet") {
                            $filex = new SplFileInfo($file->getName());
                            $url_destino = $path_init . 'FOTO-CARNET' . '.' . $filex->getExtension();
                            if (!$file->moveTo($url_destino)) {
                            } else {
                            }
                        } else if ($file->getKey() == "archivo_certificado_estudio_secundaria") {
                            $filex = new SplFileInfo($file->getName());
                            $url_destino = $path_init . 'CERTIFICADO-ESTUDIO' . '.' . $filex->getExtension();
                            if (!$file->moveTo($url_destino)) {
                            } else {
                            }
                        } else if ($file->getKey() == "archivo_solicitud_03") {
                            $filex = new SplFileInfo($file->getName());
                            $url_destino = $path_init . 'ANEXO-03' . '.' . $filex->getExtension();
                            if (!$file->moveTo($url_destino)) {
                            } else {
                            }
                        } else if ($file->getKey() == "file_upload_ext_value") {
                            $filex = new SplFileInfo($file->getName());
                            $url_destino = $path_init . $parseDesc . '.' . $filex->getExtension();
                            $AdmisionPostulantesArchivo =  AdmisionPostulantesArchivo::findFirst("id_postulante = {$postulante}  AND id_admision = {$admision} AND desc_tipo={$parseDesc}");
                            $AdmisionPostulantesArchivo->cod_tipo = $AdmisionPostulantes->tipo_inscripcion;
                            if (!$file->moveTo($url_destino)) {
                            } else {
                                $AdmisionPostulantesArchivo->save();
                            }
                        }
                    }

                    $mailer_u = new MailUnca($this->di);
                    $mailer_u->setSubject("Actualización de Pre Inscripción");
                    $mailer_u->setTo($email_send);
                    $mailer_u->setPathView('registropostulantes/updateProceso', ["publico" => $publico]);
                    $status_sendmail = $mailer_u->send();
                    if ($status_sendmail) {
                        //return true;
                    } else {
                        echo $mailer_u->getError();
                        echo "error";
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(["say" => "yes", "success" => true, "message" => "Correcto"]);
                } else {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(["success" => false, "message" => "No hay ningun archivo para actualizar"]);
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }
    public function saveInscripcionAction()
    {
        ini_set('upload_max_size', '256M');
        ini_set('post_max_size', '256M');
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '512M');

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $postulante = (int)$this->request->getPost("id_postulante", "int");
                $admision = (int)$this->request->getPost("id_admision", "int");
                $publico = Publico::findFirst("codigo={$postulante}");
                $email_send = $publico->email;
                $AdmisionPostulantes = AdmisionPostulantes::findFirst("postulante = {$postulante}  AND admision = {$admision}");
                //Valida cuando es nuevo
                $AdmisionPostulantes = ($AdmisionPostulantes->postulante == NULL) ? new AdmisionPostulantes() : $AdmisionPostulantes;
                $codigo_unico="";
                if ($AdmisionPostulantes->postulante == NULL) {
                    $codigo_unico = uniqid();
                    $AdmisionPostulantes->postulante = $postulante;
                    //$AdmisionPostulantes->semestre = $this->request->getPost("semestre", "int");
                    $AdmisionPostulantes->admision = $admision;


                    $AdmisionPostulantes->modalidad = $this->request->getPost("id_modalidad", "int");
                    $AdmisionPostulantes->fecha_inscripcion = date('Y-m-d H:i:s');
                    if ($AdmisionPostulantes->modalidad == "1") {
                        $AdmisionPostulantes->tipo_inscripcion = $this->request->getPost("id_tipo_modalidad", "int");
                    } else {
                        $AdmisionPostulantes->tipo_inscripcion = 1;
                    }
                    $AdmisionPostulantes->recibo = $this->request->getPost("recibo", "string");
                    $AdmisionPostulantes->monto = $this->request->getPost("monto", "string");
                    $AdmisionPostulantes->concepto = $this->request->getPost("concepto", "string");
                    $AdmisionPostulantes->carrera1 = $this->request->getPost("id_carrera", "string");
                    $AdmisionPostulantes->carrera2 = $this->request->getPost("carrera2", "string");
                    $AdmisionPostulantes->proceso = 0;
                    $AdmisionPostulantes->imagen = null;

                    $AdmisionPostulantes->monto = $this->request->getPost("voucher_monto", "int");
                    $AdmisionPostulantes->recibo = $this->request->getPost("voucher_nro", "int");

                    
                    $AdmisionPostulantes->codigo_unico = $codigo_unico;
                } else {

                    $codigo_unico = $AdmisionPostulantes->codigo_unico;
                }

                if ($AdmisionPostulantes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AdmisionPostulantes->getMessages());
                } else {
                    $id_admision = $admision;
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        $path_init = 'adminpanel/archivos/admision_postulante_archivo/' . $codigo_unico . '/';
                        if (!file_exists($path_init)) {
                            mkdir($path_init, 0777, true);
                        }

                        foreach ($this->request->getUploadedFiles() as $file) {
                            $AdmisionPostulantesArchivo = new AdmisionPostulantesArchivo();
                            $AdmisionPostulantesArchivo->id_admision = (int)$id_admision;
                            $AdmisionPostulantesArchivo->id_postulante = (int)$AdmisionPostulantes->postulante;
                            if ($file->getKey() == "archivo_solicitud_02") {
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'ANEXO-02' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = 0;
                                $AdmisionPostulantesArchivo->desc_tipo = "ANEXO-02";
                                $AdmisionPostulantesArchivo->archivo = 'ANEXO-02' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                            } else if ($file->getKey() == "archivo_dni") {
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'DNI' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = 0;
                                $AdmisionPostulantesArchivo->desc_tipo = "DNI";
                                $AdmisionPostulantesArchivo->archivo = 'DNI' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                            } else if ($file->getKey() == "archivo_foto_carnet") {
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'FOTO-CARNET' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = 0;
                                $AdmisionPostulantesArchivo->desc_tipo = "FOTO-CARNET";
                                $AdmisionPostulantesArchivo->archivo = 'FOTO-CARNET' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                            } else if ($file->getKey() == "archivo_certificado_estudio_secundaria") {
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'CERTIFICADO-ESTUDIO' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = 0;
                                $AdmisionPostulantesArchivo->desc_tipo = "CERTIFICADO-ESTUDIO";
                                $AdmisionPostulantesArchivo->archivo = 'CERTIFICADO-ESTUDIO' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                            } else if ($file->getKey() == "archivo_solicitud_03") {
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'ANEXO-03' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = 0;
                                $AdmisionPostulantesArchivo->desc_tipo = "ANEXO-03";
                                $AdmisionPostulantesArchivo->archivo = 'ANEXO-03' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                            } else if ($file->getKey() == "file_upload_ext_value") {
                                $desc = $this->request->getPost("desc_tipo_inscripcion", "string");
                                $parseDesc = str_replace(" ", "-", $desc);
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'extraordinario' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = $AdmisionPostulantes->tipo_inscripcion;
                                $AdmisionPostulantesArchivo->desc_tipo = $this->request->getPost("desc_tipo_inscripcion", "string");
                                $AdmisionPostulantesArchivo->archivo = 'extraordinario' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                            } else if ($file->getKey() == "voucher_file") {
                                $filex = new SplFileInfo($file->getName());
                                $url_destino = $path_init . 'VOUCHER-FILE' . '.' . $filex->getExtension();
                                $AdmisionPostulantesArchivo->modalidad = $AdmisionPostulantes->modalidad;
                                $AdmisionPostulantesArchivo->cod_tipo = 0;
                                $AdmisionPostulantesArchivo->desc_tipo = "VOUCHER-FILE";
                                $AdmisionPostulantesArchivo->archivo = 'VOUCHER-FILE' . '.' . $filex->getExtension();
                                if (!$file->moveTo($url_destino)) {
                                } else {
                                }
                        }
                            $AdmisionPostulantesArchivo->save();
                        }
                    }

                    $mailer_u = new MailUnca($this->di);
                    $mailer_u->setSubject("Registro de Pre-Inscripción al Proceso de Admisión 2024 - I");
                    $mailer_u->setTo($email_send);
                    $mailer_u->setPathView('registropostulantes/index', ["publico" => $publico]);
                    $status_sendmail = $mailer_u->send();
                    if ($status_sendmail) {
                        //return true;
                    } else {
                        echo $mailer_u->getError();
                        echo "error";
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setJsonContent(["line" => $ex->getLine(), "message" => $ex->getMessage()]);
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }
}
