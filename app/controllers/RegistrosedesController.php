<?php

class RegistrosedesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrosedes.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    public function registroAction($id = null)
    {

        if ($id != null) {
            $model = Sedes::findFirstByid_sede((int) $id);
        } else {
            $model = Sedes::findFirstByid_sede(0);
        }

        $this->view->model = $model;
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
                $id = (int) $this->request->getPost("id_sede", "int");
                $model = Sedes::findFirstByid_sede($id);

                //Valida cuando es nuevo
                $model = (!$model) ? new Sedes() : $model;


                $model->nombres = $this->request->getPost("nombres", "string");
                $model->descripcion = $this->request->getPost("descripcion", "string");
                $model->direccion = $this->request->getPost("direccion", "string");
                $model->abreviatura = $this->request->getPost("abreviatura", "string");
                $model->codigo = $this->request->getPost("codigo", "string");
                $model->estado = "A";


                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_sedes") {

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($model->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/sedes/' . $model->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/sedes/' . 'IMG' . '-' . $model->codigo . '-' . $temporal_rand . '.jpg';
                                        $model->imagen = 'IMG' . '-' . $model->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/sedes/' . 'IMG' . '-' . $model->codigo . '.jpg';
                                        $model->imagen = 'IMG' . '-' . $model->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($model->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/sedes/' . $model->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/sedes/' . 'IMG' . '-' . $model->codigo . '-' . $temporal_rand . '.png';
                                        $model->imagen = 'IMG' . '-' . $model->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/sedes/' . 'IMG' . '-' . $model->codigo . '.png';
                                        $model->imagen = 'IMG' . '-' . $model->codigo . ".png";
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
                            if ($file->getKey() == "archivo_sedes") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($model->archivo)) {
                                        $url_destino = 'adminpanel/archivos/sedes/' . $model->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/sedes/' . 'FILE' . '-' . $model->codigo . '-' . $temporal_rand . '.pdf';
                                        $model->archivo = 'FILE' . '-' . $model->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/sedes/' . 'FILE' . '-' . $model->codigo . '.pdf';
                                        $model->archivo = 'FILE' . '-' . $model->codigo . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $model->save();
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
            $datatable->setColumnaId("id_sede");
            $datatable->setSelect("id_sede, nombres, descripcion, direccion, abreviatura, imagen, archivo, estado, codigo");
            $datatable->setFrom("(SELECT
           public.tbl_web_sedes.id_sede,
           public.tbl_web_sedes.nombres,
           public.tbl_web_sedes.descripcion,
           public.tbl_web_sedes.direccion,
           public.tbl_web_sedes.abreviatura,
           public.tbl_web_sedes.imagen,
           public.tbl_web_sedes.archivo,
           public.tbl_web_sedes.estado,
           public.tbl_web_sedes.codigo
            FROM
           public.tbl_web_sedes) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("id_sede DESC");
            $datatable->getJson();

        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Sedes::findFirstByid_sede((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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
