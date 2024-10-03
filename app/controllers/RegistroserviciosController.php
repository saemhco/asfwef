<?php

class RegistroserviciosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroservicios.js?v=" . uniqid());
    }

    public function indexAction()
    {
        //$this->assets->addJs("Testing");
    }

    public function registroAction($id = null)
    {

        $this->view->id_servicio = $id;

        if ($id != null) {
            $Servicios = Servicios::findFirstByid_servicio((int) $id);
            $this->view->id_servicio_js = $id;
        } else {
            $Servicios = Servicios::findFirstByid_servicio(0);
            $this->view->id_servicio_js = 0;
        }

        $this->view->servicios = $Servicios;



        $perfiles = Perfil::find("estado = 'A' ORDER BY per_descripcion ASC");
        $this->view->perfiles = $perfiles;




        $this->assets->addJs("adminpanel/js/modulos/registroservicios.imagenes.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroservicios.archivos.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_servicio");
            $datatable->setSelect("id_servicio, titular, texto_muestra, texto_complementario, imagen, fecha_hora, estado");
            $datatable->setFrom("tbl_web_servicios");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_servicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_servicio", "int");
                $Servicios = Servicios::findFirstByid_servicio($id);
                //Valida cuando es nuevo
                $Servicios = (!$Servicios) ? new Servicios() : $Servicios;

                //$Servicios->id_servicio = $this->request->getPost("id_servicio", "int");


                $Servicios->titular = $this->request->getPost("titular", "string");
                $Servicios->texto_muestra = $this->request->getPost("texto_muestra", "string");
                //$Servicios->texto_complementario = $this->request->getPost("texto_complementario", "string");
                $Servicios->texto_complementario = $this->request->getPost("texto_complementario");



                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Servicios->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $Servicios->fecha_hora = date("Y-m-d H:i:s");

                if ($this->request->getPost("id_perfil", "int") == "") {
                    $Servicios->id_perfil = null;
                } else {
                    $Servicios->id_perfil = $this->request->getPost("id_perfil", "int");
                }

                $Servicios->estado = "A";






                if ($Servicios->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Servicios->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            //echo "<pre>";print_r($file->getName());exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                    if (in_array($extension, $formatos_imagenes)) {


                                        if (isset($Servicios->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/servicios/' . $Servicios->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/servicios/' . 'IMG' . '-' . $Servicios->id_servicio . '-' . $temporal_rand . "." . $extension;
                                            $Servicios->imagen = 'IMG' . '-' . $Servicios->id_servicio . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/servicios/' . 'IMG' . '-' . $Servicios->id_servicio . '.' . $extension;
                                            $Servicios->imagen = 'IMG' . '-' . $Servicios->id_servicio . '.' . $extension;
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
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Servicios->archivo)) {
                                            $url_destino = 'adminpanel/archivos/servicios/' . $Servicios->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/servicios/' . 'FILE' . '-' . $Servicios->id_servicio . '-' . $temporal_rand . "." . $extension;
                                            $Servicios->archivo = 'FILE' . '-' . $Servicios->id_servicio . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/servicios/' . 'FILE' . '-' . $Servicios->id_servicio . "." . $extension;
                                            $Servicios->archivo = 'FILE' . '-' . $Servicios->id_servicio . "." . $extension;
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

                        $Servicios->save();
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

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Servicios = Servicios::findFirstByid_servicio((int) $this->request->getPost("id", "int"));
            if ($Servicios && $Servicios->estado = 'A') {
                $Servicios->estado = 'X';
                $Servicios->save();
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

    //Datatables detalle
    public function datatableServiciosImagenesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("servicios_imagenes.id_servicio_imagen");
            $datatable->setSelect("servicios_imagenes.id_servicio_imagen,"
                . " servicios_imagenes.id_servicio,"
                . "servicios_imagenes.titular, "
                . "servicios_imagenes.fecha_hora, "
                . " servicios_imagenes.imagen, "
                . "servicios_imagenes.enlace, "
                . "servicios_imagenes.estado");
            $datatable->setFrom("tbl_web_servicios_imagenes servicios_imagenes");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("servicios_imagenes.id_servicio = $id");
            $datatable->setOrderby("servicios_imagenes.id_servicio_imagen DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveServiciosImagenesAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_servicio_imagen", "int");
                $ServiciosImagenes = ServiciosImagenes::findFirstByid_servicio_imagen($id);
                $ServiciosImagenes = (!$ServiciosImagenes) ? new ServiciosImagenes() : $ServiciosImagenes;


                $ServiciosImagenes->id_servicio = $this->request->getPost("id_servicio", "int");
                //titular
                $ServiciosImagenes->titular = $this->request->getPost("titular_servicios_imagenes", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_servicios_imagenes", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_servicios_imagenes", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ServiciosImagenes->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $ServiciosImagenes->descripcion = $this->request->getPost("descripcion_servicios_imagenes", "string");

                //enlace
                $ServiciosImagenes->enlace = $this->request->getPost("enlace_servicios_imagenes", "string");

                $ServiciosImagenes->estado = $this->request->getPost("estado", "string");

                $ServiciosImagenes->descripcion = $this->request->getPost("descripcion_servicios_imagenes");


                if ($ServiciosImagenes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ServiciosImagenes->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_servicios_imagenes") {
                                if ($_FILES['imagen_servicios_imagenes']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_servicios_imagenes']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        //
                                        if (isset($ServiciosImagenes->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/servicios_img/' . $ServiciosImagenes->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/servicios_img/' . 'IMG' . '-' . $ServiciosImagenes->id_servicio . '-' . $ServiciosImagenes->id_servicio_imagen . '-' . $temporal_rand . "." . $extension;
                                            $ServiciosImagenes->imagen = 'IMG' . '-' . $ServiciosImagenes->id_servicio . '-' . $ServiciosImagenes->id_servicio_imagen . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/servicios_img/' . 'IMG' . '-' . $ServiciosImagenes->id_servicio . '-' . $ServiciosImagenes->id_servicio_imagen . "." . $extension;
                                            $ServiciosImagenes->imagen = 'IMG' . '-' . $ServiciosImagenes->id_servicio . '-' . $ServiciosImagenes->id_servicio_imagen . "." . $extension;
                                        }
                                        $file->moveTo($url_destino);
                                        //
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_servicios_imagenes") {
                            }
                        }

                        $ServiciosImagenes->save();
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

    //editar notricias detalles
    public function getAjaxServiciosImagenesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ServiciosImagenes::findFirstByid_servicio_imagen((int) $this->request->getPost("id", "int"));
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

    //eliminar servicios imagenes
    public function eliminarServiciosImagenesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ServiciosImagenes::findFirstByid_servicio_imagen((int) $this->request->getPost("id", "int"));
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

    //datatables serivicios archivos
    public function datatableServiciosArchivosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("servicios_archivos.id_servicio_archivo");
            $datatable->setSelect("servicios_archivos.id_servicio_archivo,"
                . " servicios_archivos.id_servicio,"
                . "servicios_archivos.titular, "
                . "servicios_archivos.fecha_hora, "
                . " servicios_archivos.archivo, "
                . "servicios_archivos.enlace, "
                . "servicios_archivos.estado");
            $datatable->setFrom("tbl_web_servicios_archivos servicios_archivos");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("servicios_archivos.id_servicio = $id");
            $datatable->setOrderby("servicios_archivos.id_servicio_archivo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveServiciosArchivosAction()
    {


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_servicio_archivo", "int");
                $ServiciosArchivos = ServiciosArchivos::findFirstByid_servicio_archivo($id);
                $ServiciosArchivos = (!$ServiciosArchivos) ? new ServiciosArchivos() : $ServiciosArchivos;


                $ServiciosArchivos->id_servicio = $this->request->getPost("id_servicio", "int");
                //titular
                $ServiciosArchivos->titular = $this->request->getPost("titular_servicios_archivos", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_servicios_archivos", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_servicios_archivos", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ServiciosArchivos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $ServiciosArchivos->descripcion = $this->request->getPost("descripcion_servicios_archivos", "string");

                //enlace
                $ServiciosArchivos->enlace = $this->request->getPost("enlace_servicios_archivos", "string");

                //estado_detalle
                $ServiciosArchivos->estado = "A";


                if ($ServiciosArchivos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ServiciosArchivos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "archivo_servicios_archivos") {

                                if ($_FILES['archivo_servicios_archivos']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_servicios_archivos']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ServiciosArchivos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/servicios_files/' . $ServiciosArchivos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/servicios_files/' . 'FILE' . '-' . $ServiciosArchivos->id_servicio . '-' . $ServiciosArchivos->id_servicio_archivo . '-' . $temporal_rand . "." . $extension;
                                            $ServiciosArchivos->archivo = 'FILE' . '-' . $ServiciosArchivos->id_servicio . '-' . $ServiciosArchivos->id_servicio_archivo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/servicios_files/' . 'FILE' . '-' . $ServiciosArchivos->id_servicio . '-' . $ServiciosArchivos->id_servicio_archivo . "." . $extension;
                                            $ServiciosArchivos->archivo = 'FILE' . '-' . $ServiciosArchivos->id_servicio . '-' . $ServiciosArchivos->id_servicio_archivo . "." . $extension;
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

                        $ServiciosArchivos->save();
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

    //edit servicios archivos
    public function getAjaxServiciosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ServiciosArchivos::findFirstByid_servicio_archivo((int) $this->request->getPost("id", "int"));
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

    //delete
    public function eliminarServiciosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ServiciosArchivos::findFirstByid_servicio_archivo((int) $this->request->getPost("id", "int"));
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
