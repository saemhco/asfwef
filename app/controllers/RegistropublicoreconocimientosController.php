<?php

class RegistropublicoreconocimientosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registropublicoreconocimientos.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function registroAction($id = null)
    {

        if ($id != null) {
            $publicoreconocimiento = PublicoReconocimientos::findFirstBycodigo((int) $id);
        } else {
            $publicoreconocimiento = PublicoReconocimientos::findFirstBycodigo(0);
        }


        $this->view->publicoreconocimiento = $publicoreconocimiento;

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $publico = Publico::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->publico = $publico;

        $tiporeconocimientos = TipoReconocimientos::find("estado = 'A' AND numero = 137 ORDER BY nombres ASC");
        $this->view->tiporeconocimientos = $tiporeconocimientos;
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
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoReconocimiento = PublicoReconocimientos::findFirstBycodigo($id);

                //Valida cuando es nuevo
                $PublicoReconocimiento = (!$PublicoReconocimiento) ? new PublicoReconocimientos() : $PublicoReconocimiento;

                $PublicoReconocimiento->codigo = $this->request->getPost("codigo", "int");

                if ($this->request->getPost("id_publico", "int") == "") {
                    $PublicoReconocimiento->id_publico = null;
                } else {
                    $PublicoReconocimiento->id_publico = $this->request->getPost("id_publico", "int");
                }

                if ($this->request->getPost("id_tipo_reconocimiento", "int") == "") {
                    $PublicoReconocimiento->id_tipo_reconocimiento = null;
                } else {
                    $PublicoReconocimiento->id_tipo_reconocimiento = $this->request->getPost("id_tipo_reconocimiento", "int");
                }

                $PublicoReconocimiento->nombre = $this->request->getPost("nombre", "string");
                $PublicoReconocimiento->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("fecha_reconocimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_reconocimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoReconocimiento->fecha_reconocimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoReconocimiento->pais = $this->request->getPost("pais", "string");
                $PublicoReconocimiento->estado = "A";



                if ($PublicoReconocimiento->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoReconocimiento->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_publicoreconocimiento") {

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoReconocimiento->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/publicoreconocimientos/' . $PublicoReconocimiento->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publicoreconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publicoreconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '.jpg';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($PublicoReconocimiento->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/publicoreconocimientos/' . $PublicoReconocimiento->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/publicoreconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.png';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/publicoreconocimientos/' . 'IMG' . '-' . $PublicoReconocimiento->codigo . '.png';
                                        $PublicoReconocimiento->imagen = 'IMG' . '-' . $PublicoReconocimiento->codigo . ".png";
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

                            //archivo
                            if ($file->getKey() == "archivo_publicoreconocimientos") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PublicoReconocimiento->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publicoreconocimientos/' . $PublicoReconocimiento->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/publicoreconocimientos/' . 'FILE' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoReconocimiento->archivo = 'FILE' . '-' . $PublicoReconocimiento->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publicoreconocimientos/' . 'FILE' . '-' . $PublicoReconocimiento->codigo . '.pdf';
                                        $PublicoReconocimiento->archivo = 'FILE' . '-' . $PublicoReconocimiento->codigo . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $PublicoReconocimiento->save();
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

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $id_publico = $this->session->get("auth")["codigo"];
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,publico,nombre,institucion,fecha_reconocimiento,pais,archivo,imagen,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_publico_reconocimientos.codigo,
            CONCAT (public.publico.apellidop, ' ',public.publico.apellidom, ' ',public.publico.nombres) AS publico,
            public.tbl_web_publico_reconocimientos.nombre,
            public.tbl_web_publico_reconocimientos.institucion,
            to_char(public.tbl_web_publico_reconocimientos.fecha_reconocimiento, 'DD/MM/YYYY') AS fecha_reconocimiento,
            public.tbl_web_publico_reconocimientos.pais,
            public.tbl_web_publico_reconocimientos.archivo,
            public.tbl_web_publico_reconocimientos.imagen,
            public.tbl_web_publico_reconocimientos.estado,
            tipo_reconocimientos.nombres AS tipo_reconocimiento
            FROM
            public.tbl_web_publico_reconocimientos
            INNER JOIN public.a_codigos AS tipo_reconocimientos ON tipo_reconocimientos.codigo = public.tbl_web_publico_reconocimientos.id_tipo_reconocimiento
            INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_publico_reconocimientos.id_publico
            WHERE
            tipo_reconocimientos.numero = 137 AND  public.tbl_web_publico_reconocimientos.id_publico='".$id_publico."') AS temporal_table ");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("codigo DESC");
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoReconocimiento = PublicoReconocimientos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoReconocimiento && $PublicoReconocimiento->estado = 'A') {
                $PublicoReconocimiento->estado = 'X';
                $PublicoReconocimiento->save();
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
