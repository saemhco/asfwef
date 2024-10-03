<?php

class GestionactividadesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestionactividades.js?v=" . uniqid() . "");
    }

    //index
    public function indexAction() {
        
    }

    //
    public function registroAction($id = null) {


        if ($id != null) {
            $Actividades = Actividades::findFirstByid_actividad((int) $id);
            $this->view->id_actividad = $id;
        } else {
            $Actividades = Actividades::findFirstByid_actividad(0);

//            print("@KenMack");
//            exit();

            $this->view->id_actividad = 0;
        }

        $this->view->actividades = $Actividades;

        //turno
        $turnos = Turnos::find("estado = 'A' AND numero = 18");
        $this->view->turnos = $turnos;
        $this->assets->addJs("adminpanel/js/modulos/gestionactividades.detalles.js?v=" . uniqid());
    }

    //Funcion para guardar obra
    public function saveAction() {

//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $id_actividad = (int) $this->request->getPost("id_actividad", "int");
                $Actividades = Actividades::findFirstByid_actividad($id_actividad);
                $Actividades = (!$Actividades) ? new Actividades() : $Actividades;

                $Actividades->descripcion = $this->request->getPost("descripcion", "string");

                //fecha
                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $Actividades->fecha = date('Y-m-d', strtotime($fecha_new));
                }

                //personal
                $auth = $this->session->get('auth');
                $id_personal = $auth["codigo"];
                $Actividades->personal = $id_personal;


                $Actividades->estado = "A";


                if ($Actividades->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Actividades->getMessages());
                } else {

                    //Cuando va bien                  
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            //echo "<pre>";print_r($file->getName());exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Actividades->archivo)) {
                                            $url_destino = 'adminpanel/archivos/actividades/' . $Actividades->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/actividades/' . 'FILE' . '-' . $Actividades->id_actividad . '-' . $temporal_rand . "." . $extension;
                                            $Actividades->archivo = 'FILE' . '-' . $Actividades->id_actividad . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/actividades/' . 'FILE' . '-' . $Actividades->id_actividad . "." . $extension;
                                            $Actividades->archivo = 'FILE' . '-' . $Actividades->id_actividad . "." . $extension;
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

                        $Actividades->save();
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

    //datatable
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

             $auth = $this->session->get('auth');
            //print_r($auth);exit();
            $id_personal = $auth["codigo"];



            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_doc_actividades.id_actividad");
            $datatable->setSelect("public.tbl_doc_actividades.id_actividad,"
                    . "public.tbl_doc_actividades.fecha,"
                    . "public.tbl_doc_actividades.archivo,"
                    . "public.tbl_doc_actividades.estado");
            $datatable->setFrom("public.tbl_doc_actividades");
            $datatable->setWhere("public.tbl_doc_actividades.personal = {$id_personal}");
            $datatable->setOrderby("public.tbl_doc_actividades.fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Actividades = Actividades::findFirstByid_actividad((int) $this->request->getPost("id_actividad", "int"));
            if ($Actividades) {
                $this->response->setJsonContent($Actividades->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //delete fisico
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$Actividades = Actividades::findFirstByid_actividad((int) $this->request->getPost("id_actividad", "int"));

            $id_actividad = (int) $this->request->getPost("id_actividad", "int");
            $Actividades = Actividades::findFirstByid_actividad($id_actividad);

            if ($Actividades && $Actividades->estado = 'A') {

                //$Actividades->estado = 'X';
                //$Actividades->save();
                $this->db->delete("tbl_doc_actividades", "id_actividad = {$id_actividad}");
                $this->db->delete("tbl_doc_actividades_detalles", "actividad = {$id_actividad}");

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

    //datatable actividades_detalles
    public function datatableActividadesDetallesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_doc_actividades_detalles.id_actividad_detalle");
            $datatable->setSelect("public.tbl_doc_actividades_detalles.id_actividad_detalle,"
                    . "public.tbl_doc_actividades_detalles.actividad,"
                    . "public.tbl_doc_actividades_detalles.descripcion,"
                    . "public.tbl_doc_actividades_detalles.turno,"
                    . "public.tbl_doc_actividades_detalles.archivo,"
                    . "public.tbl_doc_actividades_detalles.estado,"
                    . "public.a_codigos.nombres AS turno_nombre");
            $datatable->setFrom("public.tbl_doc_actividades_detalles INNER JOIN public.a_codigos ON public.tbl_doc_actividades_detalles.turno = public.a_codigos.codigo");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            $datatable->setWhere("public.tbl_doc_actividades_detalles.actividad = $id AND public.a_codigos.numero = 18");
            $datatable->setOrderby("public.tbl_doc_actividades_detalles.turno ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //
    public function saveActividadesDetallesAction() {


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

                $id = (int) $this->request->getPost("id_actividad_detalle", "int");
                $ActividadesDetalles = ActividadesDetalles::findFirstByid_actividad_detalle($id);
                $ActividadesDetalles = (!$ActividadesDetalles) ? new ActividadesDetalles() : $ActividadesDetalles;


                $ActividadesDetalles->actividad = $this->request->getPost("actividad", "int");

                //fecha
                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $ActividadesDetalles->fecha = date('Y-m-d', strtotime($fecha_new));
                }

                $ActividadesDetalles->descripcion = $this->request->getPost("descripcion");
                $ActividadesDetalles->turno = $this->request->getPost("turno", "int");



                //estado_detalle
                $ActividadesDetalles->estado = "A";


                if ($ActividadesDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ActividadesDetalles->getMessages());
                } else {

                    //Cuando va bien
                    //ptint($ActividadesDetalles->id_actividad_detalle);
                    //exit();
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "archivo_actividades_archivos") {

                                if ($_FILES['archivo_actividades_archivos']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'PPT', 'pptx', 'PPTX', 'xlsx', 'XLSX', 'jpg', 'png', 'jpeg');

                                    $file_archivo = $_FILES['archivo_actividades_archivos']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($ActividadesDetalles->archivo)) {
                                            $url_destino = 'adminpanel/archivos/actividades_files/' . $ActividadesDetalles->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/actividades_files/' . 'FILE' . '-' . $ActividadesDetalles->actividad . '-' . $ActividadesDetalles->id_actividad_detalle . '-' . $temporal_rand . "." . $extension;
                                            $ActividadesDetalles->archivo = 'FILE' . '-' . $ActividadesDetalles->actividad . '-' . $ActividadesDetalles->id_actividad_detalle . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/actividades_files/' . 'FILE' . '-' . $ActividadesDetalles->actividad . '-' . $ActividadesDetalles->id_actividad_detalle . "." . $extension;
                                            $ActividadesDetalles->archivo = 'FILE' . '-' . $ActividadesDetalles->actividad . '-' . $ActividadesDetalles->id_actividad_detalle . "." . $extension;
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

                        $ActividadesDetalles->save();
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

    //edit
    public function getAjaxActividadesDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ActividadesDetalles::findFirstByid_actividad_detalle((int) $this->request->getPost("id_actividad_detalle", "int"));
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
    public function eliminarActividadesDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = ActividadesDetalles::findFirstByid_actividad_detalle((int) $this->request->getPost("id_actividad_detalle", "int"));
            $id_actividad_detalle = (int) $this->request->getPost("id_actividad_detalle", "int");
            $obj = ActividadesDetalles::findFirstByid_actividad_detalle($id_actividad_detalle);
            if ($obj && $obj->estado = 'A') {
                //$obj->estado = 'X';
                //$obj->save();
                $this->db->delete("tbl_doc_actividades_detalles", "id_actividad_detalle = {$id_actividad_detalle}");
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

    public function getAjaxValidacionAction() {
        $this->view->disable();


        if ($this->request->isPost() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $id_personal = $auth["codigo"];

            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));
            $fecha = (string) $this->request->getPost("fecha", "string");

            $fecha_format = explode("/", $fecha);
            $fecha_resultado = $fecha_format[2] . "-" . $fecha_format[1] . "-" . $fecha_format[0] . " " . "00:00:00";

            //print("fecha:" . $fecha_resultado);
            //exit();

            $obj = Actividades::findFirst("fecha = '{$fecha_resultado}'  AND personal = '{$id_personal}'  ");

            if ($obj) {
                //print("update:".$obj->update);
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                //$this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxValidacionEditarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $auth = $this->session->get('auth');
            $id_personal = $auth["codigo"];
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));
            $fecha = (string) $this->request->getPost("fecha", "string");
            $fecha_oculta = (string) $this->request->getPost("fecha_oculta", "string");

            if ($fecha == $fecha_oculta) {
                //print("Graba");
                //exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $fecha_format = explode("/", $fecha);
                $fecha_resultado = $fecha_format[2] . "-" . $fecha_format[1] . "-" . $fecha_format[0] . " " . "00:00:00";
                $obj = Actividades::findFirst("fecha = '{$fecha_resultado}' AND personal = '{$id_personal}'  ");

                //print($obj->fecha);
                //exit();

                if ($obj->estado == 'A') {
                    //print("Existe".$obj->fecha);
                    //exit();
                    //print("update:".$obj->update);
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "existe"));
                    $this->response->send();
                } else {
                    //$this->response->setContent('No existe registro');
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    #----------------------------------personal---------------------------------
}
