<?php

class RegistroresolucionesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroresoluciones.js?v=" . uniqid());
    }

    public function indexAction()
    {

        //TipoResoluciones
        $tipo_resoluciones = TipoResoluciones::find("estado = 'A' AND numero = 70 ");
        $this->view->tiporesoluciones = $tipo_resoluciones;
    }

    //Cargamos el datatables
    public function datatableAction($fecha_inicio = null, $fecha_fin = null, $tipo = null)
    {

        if ($fecha_inicio != 0 and $fecha_fin != 0 and $tipo != 0) {
            $where = "tipo = $tipo AND (CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else if ($fecha_inicio != 0 and $fecha_fin != 0) {
            $where = "(CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else {
            $where = "";
        }


        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_resolucion");
            $datatable->setSelect("id_resolucion, anio, tipo, numero, titulo, visto, resuelve, fecha, archivo, imagen, visible, escaneado, estado");
            $datatable->setFrom("tbl_web_resoluciones");
            $datatable->setWhere("$where");
            $datatable->setOrderby("fecha DESC,tipo,numero DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function registroAction($id = null)
    {
        $this->view->id = $id;


        if ($id != null) {
            $resoluciones = Resoluciones::findFirstByid_resolucion((int) $id);
        } else {
            $resoluciones = Resoluciones::findFirstByid_resolucion(0);
        }

        $this->view->resoluciones = $resoluciones;


        //TipoResoluciones
        $tipo_resoluciones = TipoResoluciones::find("estado = 'A' AND numero = 70 ");
        $this->view->tiporesoluciones = $tipo_resoluciones;

        //documentosgestion
        $documentosgestion = Documentosgestion::find("estado = 'A' ORDER BY titulo ASC");
        $this->view->documentosgestion = $documentosgestion;


        $fecha_actual = date('d/m/Y');
        //$anio_actual_result = explode('-', $anio_actual);
        $this->view->fecha_actual = $fecha_actual;


        $tiporesolucionesDetalle = Acodigos::find("estado = 'A' AND numero = 140");
        $this->view->tiporesolucionesDetalle = $tiporesolucionesDetalle;


        $resoluciones2 = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'id_resolucion ASC',
            ]
        );
        $this->view->resoluciones2 = $resoluciones2;




        $this->assets->addJs("adminpanel/js/modulos/registroresoluciones.detalles.js?v=" . uniqid());
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

                $id = (int) $this->request->getPost("id_resolucion", "int");
                $Resoluciones = Resoluciones::findFirstByid_resolucion($id);
                $Resoluciones = (!$Resoluciones) ? new Resoluciones() : $Resoluciones;


                $digito = $this->request->getPost("numero", "string");

                $digito_cero = strlen($digito);
                if ($digito_cero == 1) {
                    $Resoluciones->numero = '000' . $digito;
                } elseif ($digito_cero == 2) {
                    $Resoluciones->numero = '00' . $digito;
                } elseif ($digito_cero == 3) {
                    $Resoluciones->numero = '0' . $digito;
                } elseif ($digito_cero == 4) {
                    $Resoluciones->numero = $digito;
                }


                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Resoluciones->fecha = date('Y-m-d', strtotime($fecha_new));
                }


                if ($this->request->getPost("anio", "int") == "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $Resoluciones->anio = $fecha_ex[2];
                } else {
                    $Resoluciones->anio = $this->request->getPost("anio", "int");
                }


                $Resoluciones->titulo = $this->request->getPost("titulo", "string");
                $Resoluciones->resumen = $this->request->getPost("resumen", "string");
                $Resoluciones->visto = $this->request->getPost("visto");
                $Resoluciones->resuelve = $this->request->getPost("resuelve");

                if ($this->request->getPost("tipo", "int") == "") {
                    $Resoluciones->tipo = null;
                } else {
                    $Resoluciones->tipo = $this->request->getPost("tipo", "int");
                }

                $visible = $this->request->getPost("visible", "string");

                if (isset($visible)) {
                    $Resoluciones->visible = 1;
                } else {
                    $Resoluciones->visible = 0;
                }


                $escaneado = $this->request->getPost("escaneado", "string");

                if (isset($escaneado)) {
                    $Resoluciones->escaneado = 1;
                } else {
                    $Resoluciones->escaneado = 0;
                }


                if ($this->request->getPost("id_documento", "int") == "") {
                    $Resoluciones->id_documento = null;
                } else {
                    $Resoluciones->id_documento = $this->request->getPost("id_documento", "int");
                }




                $Resoluciones->estado = "A";




                //echo '<pre>';
                //print_r("Testing");
                //exit();


                if ($Resoluciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Resoluciones->getMessages());
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

                                //$Resoluciones->archivo = 1;
                                //Grabamos la foto
                                if ($file->getKey() == "archivo_resolucion") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Resoluciones->archivo);
                                        //exit();

                                        if (isset($Resoluciones->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . $Resoluciones->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . 'RES. COM. ORG.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Resoluciones->archivo = 'RES. COM. ORG.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . 'RES. COM. ORG.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '.pdf';
                                            $Resoluciones->archivo = 'RES. COM. ORG.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-CO-' . $xAbrevIns . '.pdf';
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

                                        if (isset($Resoluciones->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/resoluciones/' . $Resoluciones->imagen;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/imagenes/resoluciones/' . 'IMG' . '-' . $Resoluciones->id_resolucion . '-' . $temporal_rand . '.jpg';
                                            $Resoluciones->imagen = 'IMG' . '-' . $Resoluciones->id_resolucion . '-' . $temporal_rand . ".jpg";
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/resoluciones/' . 'IMG' . '-' . $Resoluciones->id_resolucion . '.jpg';
                                            $Resoluciones->imagen = 'IMG' . '-' . $Resoluciones->id_resolucion . ".jpg";
                                        }

                                        //
                                        if (!$file->moveTo($url_destino)) {
                                        } else {
                                            //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                            //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                        }
                                        //
                                    } elseif ($filex->getExtension() == 'png') {

                                        if (isset($Resoluciones->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/resoluciones/' . $Resoluciones->imagen;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/imagenes/resoluciones/' . 'IMG' . '-' . $Resoluciones->id_resolucion . '-' . $temporal_rand . '.png';
                                            $Resoluciones->imagen = 'IMG' . '-' . $Resoluciones->id_resolucion . '-' . $temporal_rand . ".png";
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/resoluciones/' . 'IMG' . '-' . $Resoluciones->id_resolucion . '.png';
                                            $Resoluciones->imagen = 'IMG' . '-' . $Resoluciones->id_resolucion . ".png";
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
                                //$Resoluciones->archivo = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "archivo_resolucion") {

                                    $filex = new SplFileInfo($file->getName());


                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        if (isset($Resoluciones->archivo)) {

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . $Resoluciones->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . 'RES. PRES.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Resoluciones->archivo = 'RES. PRES.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/resoluciones/' . 'RES. PRES.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '.pdf';
                                            $Resoluciones->archivo = 'RES. PRES.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-P-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 3) {
                                //$Resoluciones->archivo = 0;
                                //Grabamos la foto
                                if ($file->getKey() == "archivo_resolucion") {

                                    $filex = new SplFileInfo($file->getName());


                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        if (isset($Resoluciones->archivo)) {

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . $Resoluciones->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/resoluciones/' . 'RES. DGA.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-DGA-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Resoluciones->archivo = 'RES. DGA.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-DGA-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/resoluciones/' . 'RES. DGA.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-DGA-' . $xAbrevIns . '.pdf';
                                            $Resoluciones->archivo = 'RES. DGA.' . ' ' . $Resoluciones->numero . '-' . $fecha_ex[2] . '-DGA-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                    //
                                }
                            }

                            //
                        }

                        $Resoluciones->save();
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
              $NumeroResolucion = Resoluciones::findFirst(
              [
              "numero = :numero: AND tipo = :tipo: ",
              'bind' => [
              'numero' => $numero,
              'tipo' => $tipo
              ]
              ]
              );
             */

            $NumeroResolucion = Resoluciones::findFirst(
                [
                    "numero = $numero AND tipo = $tipo AND anio = $anio "
                ]
            );

            //echo '<pre>';
            //print_r($NumeroResolucion->id_resolucion . $NumeroResolucion->tipo);
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
            //$Resoluciones = Resoluciones::findFirstByid_resolucion((int) $this->request->getPost("id", "int"));
            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $Resoluciones = Resoluciones::findFirst(
                [
                    "id_resolucion = '$id' AND anio = $id2"
                ]
            );

            if ($Resoluciones && $Resoluciones->estado = 'A') {
                $Resoluciones->estado = 'X';
                $Resoluciones->save();
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

            $resoluciones = Resoluciones::count(
                [
                    "anio = $anio "
                ]
            );

            //echo '<pre>';
            //print_r($objetivosei);
            //exit();

            if ($resoluciones) {

                $id_pk = $resoluciones + 1;

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


    public function datatableDetallesAction($id_resolucion)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_resolucion_detalle");
            $datatable->setSelect("id_resolucion_detalle,titulo,tipo,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_resoluciones_detalles.id_resolucion_detalle,
            public.tbl_web_resoluciones_detalles.id_resolucion,
            public.tbl_web_resoluciones_detalles.id_resolucion2,
            tipos.nombres AS tipo,
            tbl_web_resoluciones2.titulo,
            public.tbl_web_resoluciones_detalles.estado
            FROM
            public.tbl_web_resoluciones
            INNER JOIN public.tbl_web_resoluciones_detalles ON public.tbl_web_resoluciones_detalles.id_resolucion = public.tbl_web_resoluciones.id_resolucion
            INNER JOIN public.a_codigos AS tipos ON tipos.codigo = public.tbl_web_resoluciones_detalles.id_tipo
            INNER JOIN public.tbl_web_resoluciones AS tbl_web_resoluciones2 ON public.tbl_web_resoluciones_detalles.id_resolucion2 = tbl_web_resoluciones2.id_resolucion
            WHERE
            tipos.numero = 140 AND
            public.tbl_web_resoluciones_detalles.id_resolucion = $id_resolucion ORDER BY tbl_web_resoluciones2.titulo ASC) AS temporal_table");;
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDetallesAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_resolucion_detalle", "int");
                $resolucionesdetalles = ResolucionesDetalles::findFirstByid_resolucion_detalle($id);
                $resolucionesdetalles = (!$resolucionesdetalles) ? new ResolucionesDetalles() : $resolucionesdetalles;

                $resolucionesdetalles->id_resolucion = $this->request->getPost("id_resolucion", "int");


                if ($this->request->getPost("id_tipo", "int") == "") {
                    $resolucionesdetalles->id_tipo = null;
                } else {
                    $resolucionesdetalles->id_tipo = $this->request->getPost("id_tipo", "int");
                }


                if ($this->request->getPost("id_resolucion2", "int") == "") {
                    $resolucionesdetalles->id_resolucion2 = null;
                } else {
                    $resolucionesdetalles->id_resolucion2 = $this->request->getPost("id_resolucion2", "int");
                }


                $resolucionesdetalles->estado = "A";


                if ($resolucionesdetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($resolucionesdetalles->getMessages());
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

    public function getAjaxDetallesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ResolucionesDetalles::findFirstByid_resolucion_detalle((int) $this->request->getPost("id", "int"));
            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarDetallesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ResolucionesDetalles::findFirstByid_resolucion_detalle((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
}
