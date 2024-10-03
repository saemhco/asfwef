<?php

class RegistroautoridadesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroautoridades.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    //Funcion agregar y editar
    public function registroAction($id = null)
    {

        if ($id != null) {
            $autoridades = Autoridades::findFirstBycodigo((int) $id);
        } else {
            $autoridades = Autoridades::findFirstBycodigo(0);
        }
#print_r($autoridades); exit;
        $this->view->autoridades = $autoridades;
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $personal = Personal::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->personal_model = $personal;
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
                $id = (int) $this->request->getPost("codigos", "int");
                $Autoridades = Autoridades::findFirstBycodigo($id);

                //Valida cuando es nuevo
                $Autoridades = (!$Autoridades) ? new Autoridades() : $Autoridades;

                $Autoridades->codigo = $this->request->getPost("codigos", "int");

                if ($this->request->getPost("personal", "int") == "") {
                    $Autoridades->personal = null;
                } else {
                    $Autoridades->personal = $this->request->getPost("personal", "int");
                }

                $Autoridades->documento = $this->request->getPost("documento", "string");
                $Autoridades->documento_enlace = $this->request->getPost("documento_enlace", "string");
                $Autoridades->descripcion = $this->request->getPost("descripcion", "string");

                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Autoridades->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }
                $Autoridades->enlace = $this->request->getPost("enlace", "string");
                $Autoridades->estado = "A";

                $imagenVertical = $this->request->getPost("imagen_vertical", "string");
                if (isset($imagenVertical)) {

                    $Autoridades->imagen_vertical = '1';
                } else {

                    $Autoridades->imagen_vertical = '0';
                }

                if ($Autoridades->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Autoridades->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_autoridades") {

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Autoridades->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/autoridades/' . $Autoridades->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/autoridades/' . 'IMG' . '-' . $Autoridades->codigo . '-' . $temporal_rand . '.jpg';
                                        $Autoridades->imagen = 'IMG' . '-' . $Autoridades->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/autoridades/' . 'IMG' . '-' . $Autoridades->codigo . '.jpg';
                                        $Autoridades->imagen = 'IMG' . '-' . $Autoridades->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Autoridades->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/autoridades/' . $Autoridades->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/autoridades/' . 'IMG' . '-' . $Autoridades->codigo . '-' . $temporal_rand . '.png';
                                        $Autoridades->imagen = 'IMG' . '-' . $Autoridades->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/autoridades/' . 'IMG' . '-' . $Autoridades->codigo . '.png';
                                        $Autoridades->imagen = 'IMG' . '-' . $Autoridades->codigo . ".png";
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
                            if ($file->getKey() == "archivo_autoridades") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Autoridades->archivo)) {
                                        $url_destino = 'adminpanel/archivos/autoridades/' . $Autoridades->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/autoridades/' . 'FILE' . '-' . $Autoridades->codigo . '-' . $temporal_rand . '.pdf';
                                        $Autoridades->archivo = 'FILE' . '-' . $Autoridades->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/autoridades/' . 'FILE' . '-' . $Autoridades->codigo . '.pdf';
                                        $Autoridades->archivo = 'FILE' . '-' . $Autoridades->codigo . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $Autoridades->save();
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

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,imagen,personal,documento,fecha_hora,archivo,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_autoridades.codigo,
            public.tbl_web_autoridades.imagen,
            CONCAT (tbl_web_personal.apellidop, ' ',tbl_web_personal.apellidom, ' ',tbl_web_personal.nombres) AS personal,
            public.tbl_web_autoridades.documento,
            to_char(tbl_web_autoridades.fecha_hora, 'DD/MM/YYYY') AS fecha_hora,
            public.tbl_web_autoridades.archivo,
            public.tbl_web_autoridades.estado
            FROM
            public.tbl_web_autoridades
            INNER JOIN public.tbl_web_personal ON public.tbl_web_autoridades.personal = public.tbl_web_personal.codigo) AS temporal_table");
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
            $Autoridades = Autoridades::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Autoridades && $Autoridades->estado = 'A') {
                $Autoridades->estado = 'X';
                $Autoridades->save();
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
