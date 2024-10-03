<?php

class RegistroambienteswebController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroambientesweb.js?v=" . uniqid());
    }

    public function indexAction() {
        //$this->assets->addJs("Testing");
    }

    //Funcion agregar Ambiente y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $Ambientes = Ambientes::findFirstByid_ambiente((int) $id);
            $this->view->id_ambiente_js = $id;
        } else {
            $Ambientes = Ambientes::findFirstByid_ambiente(0);
            $this->view->id_ambiente_js = 0;
        }

        $this->view->ambientes = $Ambientes;
        $this->assets->addJs("adminpanel/js/modulos/registroambientesweb.js?v=" . uniqid() . "");

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $this->assets->addJs("adminpanel/js/modulos/registroambientesweb.imagenes.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroambientesweb.archivos.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_ambiente");
            $datatable->setSelect("id_ambiente, titular, texto_muestra, texto_complementario, imagen, fecha_hora, estado, orden");
            $datatable->setFrom("tbl_web_ambientes");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("orden asc");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction() {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_ambiente", "int");
                $Ambientes = Ambientes::findFirstByid_ambiente($id);
                //Valida cuando es nuevo
                $Ambientes = (!$Ambientes) ? new Ambientes() : $Ambientes;

                $Ambientes->id_ambiente = $this->request->getPost("id_ambiente", "int");


                $Ambientes->titular = $this->request->getPost("titular", "string");
                $Ambientes->texto_muestra = $this->request->getPost("texto_muestra", "string");
                //$Ambientes->texto_complementario = $this->request->getPost("texto_complementario", "string");
                $Ambientes->texto_complementario = $this->request->getPost("texto_complementario");


                $Ambientes->fecha_hora = date('Y-m-d H:i:s');

                if ($this->request->getPost("orden", "int") == "") {
                    $Ambientes->orden = null;
                } else {
                    $Ambientes->orden = $this->request->getPost("orden", "int");
                }


                $Ambientes->estado = "A";

                $Ambientes->codigo = $this->request->getPost("codigo", "string");

                       

                if ($Ambientes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Ambientes->getMessages());
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


                                        if (isset($Ambientes->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/ambientes/' . $Ambientes->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/ambientes/' . 'IMG' . '-' . $Ambientes->id_ambiente . '-' . $temporal_rand . "." . $extension;
                                            $Ambientes->imagen = 'IMG' . '-' . $Ambientes->id_ambiente . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/ambientes/' . 'IMG' . '-' . $Ambientes->id_ambiente . '.' . $extension;
                                            $Ambientes->imagen = 'IMG' . '-' . $Ambientes->id_ambiente . '.' . $extension;
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

                                        if (isset($Ambientes->archivo)) {
                                            $url_destino = 'adminpanel/archivos/ambientes/' . $Ambientes->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/ambientes/' . 'FILE' . '-' . $Ambientes->id_ambiente . '-' . $temporal_rand . "." . $extension;
                                            $Ambientes->archivo = 'FILE' . '-' . $Ambientes->id_ambiente . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/ambientes/' . 'FILE' . '-' . $Ambientes->id_ambiente . "." . $extension;
                                            $Ambientes->archivo = 'FILE' . '-' . $Ambientes->id_ambiente . "." . $extension;
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

                        $Ambientes->save();
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
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Ambientes = Ambientes::findFirstByid_ambiente((int) $this->request->getPost("id", "int"));
            if ($Ambientes && $Ambientes->estado = 'A') {
                $Ambientes->estado = 'X';
                $Ambientes->save();
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

    //datatables Ambientes Imagenes
    public function datatableAmbientesImagenesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("ambientes_imagenes.id_ambiente_imagen");
            $datatable->setSelect("ambientes_imagenes.id_ambiente_imagen,"
                    . " ambientes_imagenes.id_ambiente,"
                    . "ambientes_imagenes.titular, "
                    . "ambientes_imagenes.fecha_hora, "
                    . " ambientes_imagenes.imagen, "
                    . "ambientes_imagenes.enlace, "
                    . "ambientes_imagenes.estado");
            $datatable->setFrom("tbl_web_ambientes_imagenes ambientes_imagenes");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            $datatable->setWhere("ambientes_imagenes.id_ambiente = $id");
            $datatable->setOrderby("ambientes_imagenes.id_ambiente_imagen DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //save ambientes imagenes
    public function saveAmbientesImagenesAction() {


//        $info = new SplFileInfo('foo.txt');
//        echo "<pre>";
//        print_r(var_dump($info->getExtension()));
//        exit();
//        
//        
//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_ambiente_imagen", "int");
                $AmbientesImagenes = AmbientesImagenes::findFirstByid_ambiente_imagen($id);
                $AmbientesImagenes = (!$AmbientesImagenes) ? new AmbientesImagenes() : $AmbientesImagenes;

//                $AmbientesImagenes->id_ambiente_detalle = $this->request->getPost("id_ambiente_detalle", "int");
//
//                echo "<pre>";
//                print_r($AmbientesImagenes->id_ambiente_detalle);
//                exit();

                $AmbientesImagenes->id_ambiente = $this->request->getPost("id_ambiente", "int");
                //titular
                $AmbientesImagenes->titular = $this->request->getPost("titular_ambientes_imagenes", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_ambientes_imagenes", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_ambientes_imagenes", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $AmbientesImagenes->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $AmbientesImagenes->descripcion = $this->request->getPost("descripcion_ambientes_imagenes", "string");

                //enlace
                $AmbientesImagenes->enlace = $this->request->getPost("enlace_ambientes_imagenes", "string");

                //estado_detalle
                $AmbientesImagenes->estado = "A";


                $AmbientesImagenes->descripcion = $this->request->getPost("descripcion_ambientes_imagenes");


                if ($AmbientesImagenes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AmbientesImagenes->getMessages());
                } else {


                    //print($AmbientesImagenes->id_ambiente_imagen);
                    //exit();
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_ambientes_imagenes") {
                                if ($_FILES['imagen_ambientes_imagenes']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_ambientes_imagenes']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        //
                                        if (isset($AmbientesImagenes->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/ambientes_img/' . $AmbientesImagenes->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/ambientes_img/' . 'IMG' . '-' . $AmbientesImagenes->id_ambiente . '-' . $AmbientesImagenes->id_ambiente_imagen . '-' . $temporal_rand . "." . $extension;
                                            $AmbientesImagenes->imagen = 'IMG' . '-' . $AmbientesImagenes->id_ambiente . '-' . $AmbientesImagenes->id_ambiente_imagen . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/ambientes_img/' . 'IMG' . '-' . $AmbientesImagenes->id_ambiente . '-' . $AmbientesImagenes->id_ambiente_imagen . "." . $extension;
                                            $AmbientesImagenes->imagen = 'IMG' . '-' . $AmbientesImagenes->id_ambiente . '-' . $AmbientesImagenes->id_ambiente_imagen . "." . $extension;
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
                            if ($file->getKey() == "archivo_ambientes_imagenes") {
                                
                            }
                        }

                        $AmbientesImagenes->save();
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

    //Edit Ambientes Imagenes
    public function getAjaxAmbientesImagenesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AmbientesImagenes::findFirstByid_ambiente_imagen((int) $this->request->getPost("id", "int"));
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

    //Delete Ambientes Imagenes
    public function eliminarAmbientesImagenesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AmbientesImagenes::findFirstByid_ambiente_imagen((int) $this->request->getPost("id", "int"));
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

    //Datatables Servicios Archivos
    public function datatableAmbientesArchivosAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("ambientes_archivos.id_ambiente_archivo");
            $datatable->setSelect("ambientes_archivos.id_ambiente_archivo,"
                    . " ambientes_archivos.id_ambiente,"
                    . "ambientes_archivos.titular, "
                    . "ambientes_archivos.fecha_hora, "
                    . " ambientes_archivos.archivo, "
                    . "ambientes_archivos.enlace, "
                    . "ambientes_archivos.estado");
            $datatable->setFrom("tbl_web_ambientes_archivos ambientes_archivos");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("ambientes_archivos.id_ambiente = $id");
            $datatable->setOrderby("ambientes_archivos.id_ambiente_archivo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //
    public function saveAmbientesArchivosAction() {


//        $info = new SplFileInfo('foo.txt');
//        echo "<pre>";
//        print_r(var_dump($info->getExtension()));
//        exit();
//        
//        
//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_ambiente_archivo", "int");
                $AmbientesArchivos = AmbientesArchivos::findFirstByid_ambiente_archivo($id);
                $AmbientesArchivos = (!$AmbientesArchivos) ? new AmbientesArchivos() : $AmbientesArchivos;


                $AmbientesArchivos->id_ambiente = $this->request->getPost("id_ambiente", "int");
                //titular
                $AmbientesArchivos->titular = $this->request->getPost("titular_ambientes_archivos", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_ambientes_archivos", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_ambientes_archivos", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $AmbientesArchivos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $AmbientesArchivos->descripcion = $this->request->getPost("descripcion_ambientes_archivos", "string");

                //enlace
                $AmbientesArchivos->enlace = $this->request->getPost("enlace_ambientes_archivos", "string");

                //estado_detalle
                $AmbientesArchivos->estado = "A";



                if ($AmbientesArchivos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AmbientesArchivos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "archivo_ambientes_archivos") {

                                if ($_FILES['archivo_ambientes_archivos']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_ambientes_archivos']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($AmbientesArchivos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/ambientes_files/' . $AmbientesArchivos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/ambientes_files/' . 'FILE' . '-' . $AmbientesArchivos->id_ambiente . '-' . $AmbientesArchivos->id_ambiente_archivo . '-' . $temporal_rand . "." . $extension;
                                            $AmbientesArchivos->archivo = 'FILE' . '-' . $AmbientesArchivos->id_ambiente . '-' . $AmbientesArchivos->id_ambiente_archivo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/ambientes_files/' . 'FILE' . '-' . $AmbientesArchivos->id_ambiente . '-' . $AmbientesArchivos->id_ambiente_archivo . "." . $extension;
                                            $AmbientesArchivos->archivo = 'FILE' . '-' . $AmbientesArchivos->id_ambiente . '-' . $AmbientesArchivos->id_ambiente_archivo . "." . $extension;
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

                        $AmbientesArchivos->save();
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

    //edit ambientes archivos
    public function getAjaxAmbientesArchivosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo '<pre>';
            //print_r($_POST);
            //exit();

            $obj = AmbientesArchivos::findFirstByid_ambiente_archivo((int) $this->request->getPost("id", "int"));
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

    //delete ambientes archivos
    public function eliminarAmbientesArchivosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AmbientesArchivos::findFirstByid_ambiente_archivo((int) $this->request->getPost("id", "int"));
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
