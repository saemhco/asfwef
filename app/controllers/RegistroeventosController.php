<?php

class RegistroeventosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroeventos.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function registroAction($id = null)
    {

        if ($id != null) {
            $eventos = Eventos::findFirstByid_evento((int) $id);
            $this->view->id_evento_js = $id;
        } else {
            $eventos = Eventos::findFirstByid_evento(0);
            $this->view->id_evento_js = 0;
        }

        $this->view->eventos = $eventos;

        //Modelo documento(a_codigos)
        $Servicios = Servicios::find("estado = 'A'");
        $this->view->servicios = $Servicios;



        $this->assets->addJs("adminpanel/js/modulos/registroeventos.imagenes.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroeventos.archivos.js?v=" . uniqid());
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            // echo "<pre>";
            // print_r($auth);
            // exit();
            $id_perfil = $auth["perfil"];


            $perfil = Perfil::findFirstByid($id_perfil);

            // print("Perfil: ".$perfil->per_descripcion);
            // exit();

            $perfilNombre = $perfil->per_descripcion;

            if ($perfilNombre == 'ADMIN' || $perfilNombre == 'IMAGEN INSTITUCIONAL') {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("id_evento");
                $datatable->setSelect("id_evento, titular, texto_muestra, texto_complementario, imagen, fecha_hora, estado");
                $datatable->setFrom("(SELECT
                public.tbl_web_eventos.id_evento,
                public.tbl_web_eventos.titular,
                public.tbl_web_eventos.texto_muestra,
                public.tbl_web_eventos.texto_complementario,
                public.tbl_web_eventos.fecha_hora,
                public.tbl_web_eventos.imagen,
                public.tbl_web_eventos.estado,
                public.tbl_web_eventos.id_servicio
                FROM
                public.tbl_web_eventos) AS temporal_table");
                //$datatable->setWhere("estado = 'A'");
                $datatable->setParams($_POST);
                $datatable->setOrderby("fecha_hora DESC");
                $datatable->getJson();
            } else {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("id_evento");
                $datatable->setSelect("id_evento, titular, texto_muestra, texto_complementario, imagen, fecha_hora, estado");
                $datatable->setFrom("(SELECT
                public.tbl_web_eventos.id_evento,
                public.tbl_web_eventos.titular,
                public.tbl_web_eventos.texto_muestra,
                public.tbl_web_eventos.texto_complementario,
                public.tbl_web_eventos.fecha_hora,
                public.tbl_web_eventos.imagen,
                public.tbl_web_eventos.estado,
                public.tbl_web_eventos.id_servicio,
                public.tbl_web_servicios.id_perfil
                FROM
                public.tbl_web_eventos
                INNER JOIN public.tbl_web_servicios ON public.tbl_web_servicios.id_servicio = public.tbl_web_eventos.id_servicio
                WHERE
                public.tbl_web_servicios.id_perfil = $id_perfil) AS temporal_table");
                //$datatable->setWhere("estado = 'A'");
                $datatable->setParams($_POST);
                $datatable->setOrderby("fecha_hora DESC");
                $datatable->getJson();
            }
        }
    }

    public function saveAction()
    {


        //echo "<pre>";
        //print_r($_FILES);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_evento", "int");
                $model = Eventos::findFirstByid_evento($id);
                //Valida cuando es nuevo
                $model = (!$model) ? new Eventos() : $model;

                $model->id_evento = $this->request->getPost("id_evento", "int");


                $model->titular = $this->request->getPost("titular", "string");
                $model->texto_muestra = $this->request->getPost("texto_muestra", "string");
                $model->texto_complementario = $this->request->getPost("texto_complementario");




                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }


                if ($this->request->getPost("id_servicio", "int") == "") {
                    $model->id_servicio = null;
                } else {
                    $model->id_servicio = $this->request->getPost("id_servicio", "int");
                }

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
                            //echo "<pre>";print_r($file);exit();
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                    if (in_array($extension, $formatos_imagenes)) {


                                        if (isset($model->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/eventos/' . $model->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/eventos/' . 'IMG' . '-' . $model->id_evento . '-' . $temporal_rand . "." . $extension;
                                            $model->imagen = 'IMG' . '-' . $model->id_evento . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/eventos/' . 'IMG' . '-' . $model->id_evento . '.' . $extension;
                                            $model->imagen = 'IMG' . '-' . $model->id_evento . '.' . $extension;
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

                                        if (isset($model->archivo)) {
                                            $url_destino = 'adminpanel/archivos/eventos/' . $model->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/eventos/' . 'FILE' . '-' . $model->id_evento . '-' . $temporal_rand . "." . $extension;
                                            $model->archivo = 'FILE' . '-' . $model->id_evento . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/eventos/' . 'FILE' . '-' . $model->id_evento . "." . $extension;
                                            $model->archivo = 'FILE' . '-' . $model->id_evento . "." . $extension;
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

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Eventos::findFirstByid_evento((int) $this->request->getPost("id", "int"));
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

    //Datatables detalle
    public function datatableEventosImagenesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("eventos_imagenes.id_evento_imagen");
            $datatable->setSelect("eventos_imagenes.id_evento_imagen, eventos_imagenes.id_evento, eventos_imagenes.titular, eventos_imagenes.fecha_hora, eventos_imagenes.enlace, eventos_imagenes.estado,eventos_imagenes.imagen");
            $datatable->setFrom("tbl_web_eventos_imagenes eventos_imagenes");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("eventos_imagenes.id_evento = $id");
            $datatable->setOrderby("eventos_imagenes.id_evento_imagen DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //saveDetalles
    public function saveEventosImagenesAction()
    {


        //        $info = new SplFileInfo('foo.txt');
        //        echo "<pre>";
        //        print_r(var_dump($info->getExtension()));
        //        exit();
        //        
        //        
        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_evento_imagen", "int");
                $modelImagenes = EventosImagenes::findFirstByid_evento_imagen($id);
                $modelImagenes = (!$modelImagenes) ? new EventosImagenes() : $modelImagenes;


                $modelImagenes->id_evento = $this->request->getPost("id_evento", "int");
                //titular
                $modelImagenes->titular = $this->request->getPost("titular_eventos_imagenes", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_eventos_imagenes", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_eventos_imagenes", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $modelImagenes->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $modelImagenes->enlace = $this->request->getPost("enlace_eventos_imagenes", "string");

                $modelImagenes->descripcion = $this->request->getPost("descripcion_eventos_imagenes", "string");

                //estado_detalle
                $modelImagenes->estado = "A";



                if ($modelImagenes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($modelImagenes->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen_eventos_imagenes") {


                                if ($_FILES['imagen_eventos_imagenes']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen_eventos_imagenes']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        //
                                        if (isset($modelImagenes->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/eventos_img/' . $modelImagenes->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/eventos_img/' . 'IMG' . '-' . $modelImagenes->id_evento . '-' . $modelImagenes->id_evento_imagen . '-' . $temporal_rand . "." . $extension;
                                            $modelImagenes->imagen = 'IMG' . '-' . $modelImagenes->id_evento . '-' . $modelImagenes->id_evento_imagen . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/eventos_img/' . 'IMG' . '-' . $modelImagenes->id_evento . '-' . $modelImagenes->id_evento_imagen . "." . $extension;
                                            $modelImagenes->imagen = 'IMG' . '-' . $modelImagenes->id_evento . '-' . $modelImagenes->id_evento_imagen . "." . $extension;
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
                        }

                        $modelImagenes->save();
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
    public function getAjaxEventosImagenesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = EventosImagenes::findFirstByid_evento_imagen((int) $this->request->getPost("id", "int"));
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

    //eliminar eventos detalles
    public function eliminarEventosImagenesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = EventosImagenes::findFirstByid_evento_imagen((int) $this->request->getPost("id", "int"));
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

    //datatableEventosImagenes
    public function datatableEventosArchivosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("eventos_archivos.id_evento_archivo");
            $datatable->setSelect("eventos_archivos.id_evento_archivo, eventos_archivos.id_evento, eventos_archivos.titular, eventos_archivos.fecha_hora, eventos_archivos.enlace, eventos_archivos.archivo, eventos_archivos.estado");
            $datatable->setFrom("tbl_web_eventos_archivos eventos_archivos");

            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");

            $datatable->setWhere("eventos_archivos.id_evento = $id");
            $datatable->setOrderby("eventos_archivos.id_evento_archivo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveEventosArchivosAction()
    {


        //        $info = new SplFileInfo('foo.txt');
        //        echo "<pre>";
        //        print_r(var_dump($info->getExtension()));
        //        exit();
        //        
        //        
        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_evento_archivo", "int");
                $modelArchivos = EventosArchivos::findFirstByid_evento_archivo($id);
                $modelArchivos = (!$modelArchivos) ? new EventosArchivos() : $modelArchivos;


                $modelArchivos->id_evento = $this->request->getPost("id_evento", "int");
                //titular
                $modelArchivos->titular = $this->request->getPost("titular_eventos_archivos", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora_eventos_archivos", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_eventos_archivos", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $modelArchivos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $modelArchivos->enlace = $this->request->getPost("enlace_eventos_archivos", "string");
                $modelArchivos->descripcion = $this->request->getPost("descripcion_eventos_archivos", "string");

                //estado_detalle
                $modelArchivos->estado = "A";


                if ($modelArchivos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($modelArchivos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "archivo_eventos_archivos") {

                                if ($_FILES['archivo_eventos_archivos']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo_eventos_archivos']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($modelArchivos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/eventos_files/' . $modelArchivos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/eventos_files/' . 'FILE' . '-' . $modelArchivos->id_evento . '-' . $modelArchivos->id_evento_archivo . '-' . $temporal_rand . "." . $extension;
                                            $modelArchivos->archivo = 'FILE' . '-' . $modelArchivos->id_evento . '-' . $modelArchivos->id_evento_archivo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/eventos_files/' . 'FILE' . '-' . $modelArchivos->id_evento . '-' . $modelArchivos->id_evento_archivo . "." . $extension;
                                            $modelArchivos->archivo = 'FILE' . '-' . $modelArchivos->id_evento . '-' . $modelArchivos->id_evento_archivo . "." . $extension;
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

                        $modelArchivos->save();
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

    public function getAjaxEventosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = EventosArchivos::findFirstByid_evento_archivo((int) $this->request->getPost("id", "int"));
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

    //eliminar
    public function eliminarEventosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = EventosArchivos::findFirstByid_evento_archivo((int) $this->request->getPost("id", "int"));
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
