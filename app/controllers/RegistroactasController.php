<?php

class RegistroactasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroactas.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_acta");
            $datatable->setSelect("id_acta, anio, tipo, numero, titulo, visto, resuelve, fecha, archivo, imagen, visible, escaneado, estado");
            $datatable->setFrom("tbl_web_actas");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("fecha DESC,tipo,numero DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function registroAction($id1 = null, $id2 = null)
    {
        $this->view->id1 = $id1;
        $this->view->id2 = $id2;

        //cuando se va editar
        if ($id1 != null && $id2 != null) {


            //$objetivosei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $actas = Actas::findFirst(
                [
                    "id_acta = $id1 AND anio = $id2"
                ]
            );
        } else {

            /*$id1 = Actas::count();

            $this->view->id1 = $id1 + 1;*/
        }

        $this->view->actas = $actas;


        $tipoactas = TipoActas::find("estado = 'A' AND numero = 103 ");
        $this->view->tipoactas = $tipoactas;


        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
    }

    //Funcion guardar
    public function saveAction()
    {


        // echo "<pre>";
        // print_r($_POST);
        // exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_acta", "int");
                $id2 = (int) $this->request->getPost("anio", "int");




                $actas = Actas::findFirst(
                    [
                        "id_acta = $id AND anio = $id2"
                    ]
                );


                $actas = (!$actas) ? new Actas() : $actas;
                $latestRecordActas = Actas::findFirst([
                    'order' => 'id_acta DESC',
                ]);
                $latestRecord = $latestRecordActas->id_acta + 1;
                if ($actas->id_acta==null) {
                    $actas->id_acta = $latestRecord;
                } else {
                    $actas->id_acta = $this->request->getPost("id_acta", "int");
                }


                $digito = $this->request->getPost("numero", "string");

                $digito_cero = strlen($digito);
                if ($digito_cero == 1) {
                    $actas->numero = '000' . $digito;
                } elseif ($digito_cero == 2) {
                    $actas->numero = '00' . $digito;
                } elseif ($digito_cero == 3) {
                    $actas->numero = '0' . $digito;
                } elseif ($digito_cero == 4) {
                    $actas->numero = $digito;
                }

                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $actas->fecha = date('Y-m-d', strtotime($fecha_new));
                }


                if ($this->request->getPost("anio", "int") == "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $actas->anio = $fecha_ex[2];
                } else {
                    $actas->anio = $this->request->getPost("anio", "int");
                }


                $actas->titulo = $this->request->getPost("titulo", "string");
                $actas->resumen = $this->request->getPost("resumen", "string");
                $actas->visto = $this->request->getPost("visto");
                $actas->resuelve = $this->request->getPost("resuelve");

                if ($this->request->getPost("tipo", "int") == "") {
                    $actas->tipo = null;
                } else {
                    $actas->tipo = $this->request->getPost("tipo", "int");
                }

                $visible = $this->request->getPost("visible", "string");

                if (isset($visible)) {
                    $actas->visible = 1;
                } else {
                    $actas->visible = 0;
                }


                $escaneado = $this->request->getPost("escaneado", "string");

                if (isset($escaneado)) {
                    $actas->escaneado = 1;
                } else {
                    $actas->escaneado = 0;
                }




                $actas->estado = "A";


                // echo '<pre>';
                // print_r("Testing");
                // exit();


                if ($actas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($actas->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //Partida de nacimiento
                            //$archivo = $this->request->getPost("archivo", "string");

                            $temporal_rand = mt_rand(100000, 999999);
                            $xAbrevIns = $this->config->global->xAbrevIns;

                            if ($this->request->getPost("tipo", "int") == 1) {

                                //$actas->archivo = 1;
                                //Grabamos la foto
                                if ($file->getKey() == "archivo_acta") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$actas->archivo);
                                        //exit();

                                        if (isset($actas->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/actas/' . $actas->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/actas/' . 'ACTA SESION EXTRAORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $actas->archivo = 'ACTA SESION EXTRAORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/actas/' . 'ACTA SESION EXTRAORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '.pdf';
                                            $actas->archivo = 'ACTA SESION EXTRAORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }

                                //imagen
                                if ($file->getKey() == "imagen") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'jpg') {

                                        if (isset($actas->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/actas/' . $actas->imagen;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/imagenes/actas/' . 'IMG' . '-' . $actas->id_acta . '-' . $temporal_rand . '.jpg';
                                            $actas->imagen = 'IMG' . '-' . $actas->id_acta . '-' . $temporal_rand . ".jpg";
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/actas/' . 'IMG' . '-' . $actas->id_acta . '.jpg';
                                            $actas->imagen = 'IMG' . '-' . $actas->id_acta . ".jpg";
                                        }

                                        //
                                        if (!$file->moveTo($url_destino)) {
                                        } else {
                                            //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                            //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                        }
                                        //
                                    } elseif ($filex->getExtension() == 'png') {

                                        if (isset($actas->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/actas/' . $actas->imagen;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/imagenes/actas/' . 'IMG' . '-' . $actas->id_acta . '-' . $temporal_rand . '.png';
                                            $actas->imagen = 'IMG' . '-' . $actas->id_acta . '-' . $temporal_rand . ".png";
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/actas/' . 'IMG' . '-' . $actas->id_acta . '.png';
                                            $actas->imagen = 'IMG' . '-' . $actas->id_acta . ".png";
                                        }

                                        //
                                        if (!$file->moveTo($url_destino)) {
                                        } else {
                                            //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                            //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                        }
                                        //
                                    }
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 2) {
                                //$actas->archivo = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "archivo_acta") {

                                    $filex = new SplFileInfo($file->getName());


                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        if (isset($actas->archivo)) {

                                            $url_destino = 'adminpanel/archivos/actas/' . $actas->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/actas/' . 'ACTA SESION ORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $actas->archivo = 'ACTA SESION ORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/actas/' . 'ACTA SESION ORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '.pdf';
                                            $actas->archivo = 'ACTA SESION ORDINARIA C.O. N° ' . ' ' . $actas->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            }
                            //
                        }

                        $actas->save();
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

    public function numeroResolucionAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $numero = $this->request->getPost('numero');
            $tipo = $this->request->getPost('tipo');
            $anio = (int) $this->request->getPost('anio');

            //echo '<pre>';
            //print_r("EL numero y tipo es:" . $numero . "-" . $tipo);
            //exit();

            /*
              $NumeroResolucion = Actas::findFirst(
              [
              "numero = :numero: AND tipo = :tipo: ",
              'bind' => [
              'numero' => $numero,
              'tipo' => $tipo
              ]
              ]
              );
             */

            $NumeroResolucion = Actas::findFirst(
                [
                    "numero = $numero AND tipo = $tipo AND anio = $anio "
                ]
            );

            //echo '<pre>';
            //print_r($NumeroResolucion->id_acta . $NumeroResolucion->tipo);
            //exit();

            if ($NumeroResolucion) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {

                //echo '<pre>';
                //print_r('Testing');
                //exit();
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$actas = Actas::findFirstByid_acta((int) $this->request->getPost("id", "int"));
            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $actas = Actas::findFirst(
                [
                    "id_acta = '$id' AND anio = $id2"
                ]
            );

            if ($actas && $actas->estado = 'A') {
                $actas->estado = 'X';
                $actas->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function getResolucionesAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $anio = (int) $this->request->getPost("anio", "int");

            $actas = Actas::count(
                [
                    "anio = $anio "
                ]
            );

            // echo '<pre>';
            // print_r("valor del count".$actas);
            // exit();

            if ($actas) {

                $id_pk = $actas + 1;

                // print($id_pk);
                // exit();

                $this->response->setJsonContent(array("say" => "si", "pk_aumenta" => $id_pk));
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

    public function verificapdfAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo = $this->request->getPost("file_pdf");

            //echo '<pre>';
            //print_r($archivo);
            //exit();

            $file_pdf = new SplFileInfo($archivo);

            //echo '<pre>';
            //print_r($file_pdf->getExtension());
            //exit();

            if ($file_pdf->getExtension() != 'pdf') {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
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
}
