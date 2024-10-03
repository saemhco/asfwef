<?php

class RegistrovideosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrovideos.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    //Funcion agregar Videos y editar
    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $videos = Videos::findFirstByid_video((int) $id);
        } else {

            $videos_nuevo = Videos::findFirstByid_video(NULL);

            $videos_nuevo = Videos::find([
                // "estado = 'A' ",
                "order" => "id_video DESC",
                "limit" => 1
            ]);

            //print($docente_nuevo[0]->id_video); exit();
            $videos->id_video = $videos_nuevo[0]->id_video + 1;
            $this->view->videos = $videos;
        }

        $this->view->videos = $videos;
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_video");
            $datatable->setSelect("id_video,titular,youtube,estado");
            $datatable->setFrom("tbl_web_videos");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_video DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction()
    {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_video", "int");
                $model = Videos::findFirstByid_video($id);
                //Valida cuando es nuevo
                $model = (!$model) ? new Videos() : $model;

                $model->id_video = $this->request->getPost("id_video", "int");

                $model->titular = $this->request->getPost("titular", "string");
                $model->youtube = $this->request->getPost("youtube", "string");

                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $model->estado = "A";
                } else {
                    $model->estado = "X";
                }



                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
                } else {
                    //Cuando va bien 

                    foreach ($this->request->getUploadedFiles() as $file) {
                        //imagen
                        $temporal_rand = mt_rand(100000, 999999);

                        if ($file->getKey() == "imagen") {

                            if ($_FILES['imagen']['name'] !== "") {
                                $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                $file_imagen = $_FILES['imagen']['name'];

                                $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                if (in_array($extension, $formatos_imagenes)) {


                                    if (isset($model->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/videos/' . $model->imagen;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/imagenes/videos/' . 'IMG' . '-' . $model->id_video . '-' . $temporal_rand . "." . $extension;
                                        $model->imagen = 'IMG' . '-' . $model->id_video . '-' . $temporal_rand . "." . $extension;
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/videos/' . 'IMG' . '-' . $model->id_video . '.' . $extension;
                                        $model->imagen = 'IMG' . '-' . $model->id_video . '.' . $extension;
                                    }


                                    $file->moveTo($url_destino);
                                } else {

                                    $this->response->setJsonContent(array("say" => "error_image"));
                                    $this->response->send();
                                    exit();
                                }
                            }
                        }


                    }

                    $model->save();


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

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $sliders = Videos::findFirstByid_video((int) $this->request->getPost("id", "int"));
            if ($sliders && $sliders->estado = 'A') {
                $sliders->estado = 'X';
                $sliders->save();
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
