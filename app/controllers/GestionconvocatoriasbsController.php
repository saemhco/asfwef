<?php

class GestionconvocatoriasbsController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //-----------------------------convocatorias--------------------------------
    public function convocatoriasbsAction()
    {

        //echo "<pre>"; print_r($_SESSION);exit();

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        $empresas = Empresas::findFirstByid_empresa($this->session->get("auth")["id_empresa"]);

        // print($empresas->ruc);
        // exit();

        $this->view->empresas = $empresas;

        $this->assets->addJs("adminpanel/js/modulos/gestionconvocatoriasbs.convocatoriasbs.js?v" . uniqid());
    }

    //datatableConvocatorias
    public function datatableConvocatoriasbsAction()
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_web_convocatorias_bs.id_convocatoria_bs");
            $datatable->setSelect("public.tbl_web_convocatorias_bs.id_convocatoria_bs, public.tbl_web_convocatorias_bs.fecha_hora, public.tbl_web_convocatorias_bs.titulo, "
                . "public.tbl_web_convocatorias_bs_perfiles.nombre, public.tbl_web_convocatorias_bs_perfiles.nombre_corto,public.tbl_web_convocatorias_bs_perfiles.fecha_inicio, public.tbl_web_convocatorias_bs_perfiles.fecha_fin, "
                . "public.tbl_web_convocatorias_bs.estado, public.tbl_web_convocatorias_bs_perfiles.estado, public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs_perfil, public.tbl_web_convocatorias_bs.archivo");
            $datatable->setFrom("public.tbl_web_convocatorias_bs INNER JOIN public.tbl_web_convocatorias_bs_perfiles ON public.tbl_web_convocatorias_bs.id_convocatoria_bs = public.tbl_web_convocatorias_bs_perfiles.id_convocatoria_bs");
            $datatable->setWhere("public.tbl_web_convocatorias_bs.etapa = 1");
            $datatable->setOrderby("public.tbl_web_convocatorias_bs_perfiles.nombre_corto");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

//verificar convocatoria
    public function verificarConvocatoriaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_convocatoria_bs = (int) $this->request->getPost("id_convocatoria_bs", "int");
            $id_empresa = (int) $this->request->getPost("id_empresa", "int");

            $convocatoriasbsEmpresas = ConvocatoriasbsEmpresas::findFirst(
                [
                    "id_convocatoria_bs = $id_convocatoria_bs AND id_empresa = $id_empresa",
                ]
            );

            if ($convocatoriasbsEmpresas) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //save convocatorias
    public function saveConvocatoriasAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //perfil
                $perfil_puesto = $this->request->getPost("id_convocatoria_bs_perfil", "int");

                //vaalidar fecha
                $convocatoriasbsPerfiles = ConvocatoriasbsPerfiles::findFirstByid_convocatoria_bs_perfil($perfil_puesto);

                $f_i = strtotime(date($convocatoriasbsPerfiles->fecha_inicio));
                $f_f = strtotime(date($convocatoriasbsPerfiles->fecha_fin));
                $f_a = strtotime(date("Y-m-d H:i:s", time()));

                if ($f_a >= $f_i and $f_a <= $f_f) {

                    $convocatoriasbsEmpresas = (!$convocatoriasbsEmpresas) ? new ConvocatoriasbsEmpresas() : $convocatoriasbsEmpresas;

                    $convocatoriasbsEmpresas->id_convocatoria_bs = $this->request->getPost("id_convocatoria_bs", "int");

                    //publico
                    $convocatoriasbsEmpresas->id_empresa = $this->request->getPost("id_empresa", "int");

                    //perfil
                    $convocatoriasbsEmpresas->id_convocatoria_bs_perfil = $this->request->getPost("id_convocatoria_bs_perfil", "int");

                    //fecha_registro
                    $convocatoriasbsEmpresas->fecha = date("Y-m-d H:i:s");

                    $convocatoriasbsEmpresas->anexos = $this->request->getPost("input-file", "string");

                    //estado
                    $convocatoriasbsEmpresas->estado = 1;

                    //proceso
                    $convocatoriasbsEmpresas->proceso = 0;

                    //campos para email
                    $convocatorias_titulo = $this->request->getPost("convocatorias_titulo", "string");
                    $convocatoria_perfiles_codigo = $this->request->getPost("convocatoria_perfiles_codigo", "string");
                    $convocatoria_perfiles_nombre = $this->request->getPost("convocatoria_perfiles_nombre", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "fecha_vencida"));
                    $this->response->send();
                    exit();
                }

                if ($convocatoriasbsEmpresas->save() == false) {

                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($convocatoriasbsEmpresas->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            // Enviando email a La empresa
                            $empresas = Empresas::findFirstByid_empresa($this->session->get("auth")["id_empresa"]);
                            $fecha_format = explode("-", $convocatoriasbsEmpresas->fecha);
                            $fecha_format_resultado = $fecha_format[2] . "/" . $fecha_format[1] . "/" . $fecha_format[0];

                            $email_destEmail = $this->config->mail->destEmail;
                            $text_body .= "" . '<br>';
                            $text_body .= "SOLICITUD DE INSCRIPCIÓN" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Señores:" . '<br>';
                            $text_body .= "COMITÉ DE SELECCIÓN DEL {$convocatorias_titulo}" . '<br>';
                            $text_body .= "{$this->config->global->xNombreIns}" . '<br>';
                            $text_body .= "Presente." . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Yo, {$empresas->razon_social}, con RUC N° {$empresas->ruc}, con correo electrónico {$empresas->email}, me presento ante ustedes, para exponerle:" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Que, deseo presentar mi propuesta para la {$convocatoria_perfiles_codigo} {$convocatoria_perfiles_nombre}. de la convocatoria de $convocatorias_titulo, cumpliendo con los requisitos solicitados en el anexo, para cuyo efecto registré la propuesta en la plataforma virtual de Gestión de Administrativa para la evaluación correspondiente" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Atentamente." . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "{$empresas->razon_social}" . '<br>';

                            //$this->config->global->xAbrevIns;

                            $mailer = new mailer($this->di);
                            $mailer->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            $mailer->setTo($email_destEmail, $email_destEmail);
                            $mailer->setBody($text_body);
                            if ($mailer->send()) {
                                //return true;
                            } else {
                                echo $mailer->getError();
                                echo "error";
                            }


                            $email_usuario = $empresas->email;
                            $text_body2 = "Estimado Postulante: {$empresas->razon_social}: " . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Ud. ha registrado su propuesta satisfactoriamente del $convocatorias_titulo: {$convocatoria_perfiles_codigo} {$convocatoria_perfiles_nombre}." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "HA REGISTRADO LOS SIGUIENTE INFORMACIÓN:";
                            $text_body2 .= "- ANEXOS." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "De ser aceptada su propuesta se le estará comunicando por este medio o llamada telefónica." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Atentamente" . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Unidad de Abastecimientos - ".$this->config->global->xAbrevIns.".";

                            $mailer_u = new mailer($this->di);
                            $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            $mailer_u->setTo($email_usuario, $email_usuario);
                            $mailer_u->setBody($text_body2);
                            if ($mailer_u->send()) {
                                //return true;
                            } else {
                                echo $mailer->getError();
                                echo "error";
                            }

                            //archivo
                            $ruc = $empresas->ruc;

                            if ($file->getKey() == "archivo") {
                                //$filex = new SplFileInfo($file->getName());
                            
                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'rar', 'zip');
                                    $file_archivo = $_FILES['archivo']['name'];
                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);
                            
                                    if (in_array($extension, $formatos_archivo)) {
                            
                                        if (isset($convocatoriasbsEmpresas->anexos)) {
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs_empresa/' . $convocatoriasbsEmpresas->anexos;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs_empresa/ANX-' . $convocatoriasbsEmpresas->id_convocatoria_bs . '-' . $ruc . '-' . $temporal_rand . "." . $extension;
                                            $convocatoriasbsEmpresas->anexos = 'ANX-' . $convocatoriasbsEmpresas->id_convocatoria_bs . '-' . $ruc . '-' . $temporal_rand .  "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/convocatoriasbs_empresa/ANX-' . $convocatoriasbsEmpresas->id_convocatoria_bs . '-' . $ruc . "." . $extension;
                                            $convocatoriasbsEmpresas->anexos = 'ANX-' . $convocatoriasbsEmpresas->id_convocatoria_bs . '-' . $ruc . "." . $extension;
                                        }
                            
                                        $file->moveTo($url_destino);
                                    } else {
                            
                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            
                            
                            }

                        }

                        $convocatoriasbsEmpresas->save();
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

    public function getAjaxVerificaFilesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $Empresas = Empresas::findFirstByid_empresa((int) $this->request->getPost("id_empresa", "int"));
            if ($Empresas->archivo_rnp !== "" && $Empresas->archivo_ruc !== "") {
                //$Empresas->estado = 'X';
                //$Empresas->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                $this->response->setContent('No tiene ruc ni rnp');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

}
