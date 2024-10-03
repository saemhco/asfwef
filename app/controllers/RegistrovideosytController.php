<?php

class RegistrovideosytController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrovideosyt.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    //Funcion agregar Videos y editar
    public function registroAction($id = null)
    {
        if ($id != null) {
            $Videos = Videosyt::findFirstByid_video_yt((int) $id);
        } else {
            $Videos = Videosyt::findFirstByid_video_yt(0);
        }

        $this->view->videos = $Videos;

    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_video_yt");
            $datatable->setSelect("id_video_yt,titulo,enlace, imagen,estado");
            $datatable->setFrom("tbl_web_videos_yt");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_video_yt DESC");
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
                $id = (int) $this->request->getPost("id_video_yt", "int");
                $Videos = Videosyt::findFirstByid_video_yt($id);
                //Valida cuando es nuevo
                $Videos = (!$Videos) ? new Videosyt() : $Videos;

                $Videos->id_video_yt = $this->request->getPost("id_video_yt", "int");

                $Videos->titulo = $this->request->getPost("titulo", "string");
                $Videos->enlace = $this->request->getPost("enlace");

                $Videos->estado = "A";

                if ($Videos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Videos->getMessages());
                } else {
                    //Cuando va bien

                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_videosfb") {
                                if ($_FILES['imagen_videosfb']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_videosfb']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        if (isset($Videos->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/videosyt/' . $Videos->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/videosyt/' . 'IMG' . '-' . $Videos->id_video_yt . $temporal_rand . "." . $extension;
                                            $Videos->imagen = 'IMG' . '-' . $Videos->id_video_yt . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/videosyt/' . 'IMG' . '-' . $Videos->id_video_yt . '.' . $extension;
                                            $Videos->imagen = 'IMG' . '-' . $Videos->id_video_yt . "." . $extension;
                                        }
                                        $file->moveTo($url_destino);

                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_ambientes_imagenes") {

                            }
                        }

                        $Videos->save();
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

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $sliders = Videosyt::findFirstByid_video_yt((int) $this->request->getPost("id", "int"));
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
