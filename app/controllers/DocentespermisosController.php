<?php

class DocentespermisosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/listadocentespermisos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $docentes = Docentes::findFirstBycodigo((int) $id);
        }

        $this->view->docentes = $docentes;

        //TipoDocumento
        $tipo_documento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documento;

        //tipo de permiso
        $tipo_permiso = TipoPermiso::find("estado = 'A' AND numero = 58 ");
        $this->view->tipopermiso = $tipo_permiso;

        //personal_familiares
        $this->assets->addJs("adminpanel/js/modulos/docentes.permisos.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("d.codigo");
            $datatable->setSelect("d.codigo, aco.nombres as condicion, d.apellidop, d.apellidom, d.nombres, d.nro_doc, d.celular, d.titulo");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("docentes d
                INNER JOIN a_codigos aco ON d.condicion = aco.codigo
                ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            $datatable->setWhere("d.estado = 'A' AND aco.numero = 5 AND d.codigo > 0");
            $datatable->setOrderby("d.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatables personal_permisos
    public function datatableDocentesPermisosAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("personal_permisos.codigo");
            $datatable->setSelect("personal_permisos.personal, "
                    . "personal_permisos.fecha_inicio, personal_permisos.fecha_retorno,"
                    . " personal_permisos.motivos, personal_permisos.archivo, "
                    . "personal_permisos.imagen, personal_permisos.enlace, "
                    . "personal_permisos.estado ");
            $datatable->setFrom("tbl_web_personal_permisos personal_permisos ");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("personal_permisos.estado_detalle = 'A' AND personal_permisos.estado_detalle = 'A' AND  personal_permisos.id_area = $id");
            $datatable->setWhere("personal_permisos.personal = $id AND personal_permisos.tipo = 2");
            $datatable->setOrderby("personal_permisos.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //guardar personal familiar
    public function saveDocentesPermisosAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PersonalPermisos = PersonalPermisos::findFirstBycodigo($id);
                $PersonalPermisos = (!$PersonalPermisos) ? new PersonalPermisos() : $PersonalPermisos;

                //codigo
                $PersonalPermisos->codigo = $this->request->getPost("codigo", "int");

                //id_peprsonal
                $PersonalPermisos->personal = $this->request->getPost("personal", "int");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PersonalPermisos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_retorno
                if ($this->request->getPost("fecha_retorno", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_retorno", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PersonalPermisos->fecha_retorno = date('Y-m-d', strtotime($fecha_new));
                }

                //motivos
                $PersonalPermisos->motivos = $this->request->getPost("motivos", "string");



                //tipo_permiso
                if ($this->request->getPost("tipo_permiso", "int") == "") {
                    $PersonalPermisos->tipo_permiso = null;
                } else {
                    $PersonalPermisos->tipo_permiso = $this->request->getPost("tipo_permiso", "int");
                }

                //gocedehaber
                $gocedehaber = $this->request->getPost("gocedehaber", "string");
                if (isset($gocedehaber)) {
                    $PersonalPermisos->gocedehaber = "1";
                } else {
                    $PersonalPermisos->gocedehaber = "0";
                }

                $PersonalPermisos->estado = "A";

                $PersonalPermisos->tipo = 2;


                if ($PersonalPermisos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonalPermisos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);
                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {
                                    if (isset($PersonalPermisos->imagen)) {

                                        $url_destino = 'adminpanel/imagenes/personal_permisos/' . $PersonalPermisos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_permisos/' . 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '-' . $temporal_rand . '.jpg';
                                        $PersonalPermisos->imagen = 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/personal_permisos/' . 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '.jpg';
                                        $PersonalPermisos->imagen = 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '.jpg';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$PersonalPermisos->imagen = 'IMG' . '-' . $PersonalPermisos->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($PersonalPermisos->imagen)) {

                                        $url_destino = 'adminpanel/imagenes/personal_permisos/' . $PersonalPermisos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_permisos/' . 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '-' . $temporal_rand . '.png';
                                        $PersonalPermisos->imagen = 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '-' . $temporal_rand . '.png';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/personal_permisos/' . 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '.png';
                                        $PersonalPermisos->imagen = 'IMG' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '.png';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$PersonalPermisos->imagen = 'IMG' . '-' . $PersonalPermisos->codigo . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($PersonalPermisos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/personal_permisos/' . $PersonalPermisos->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_permisos/' . 'FILE' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '-' . $temporal_rand . '.pdf';
                                        $PersonalPermisos->archivo = 'FILE' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/personal_permisos/' . 'FILE' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '.pdf';
                                        $PersonalPermisos->archivo = 'FILE' . '-' . $PersonalPermisos->tipo . '-' . $PersonalPermisos->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $PersonalPermisos->save();
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

    //editar personal_permisos
    public function getAjaxDocentesPermisosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalPermisos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
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
    public function eliminarPersonalPermisosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalPermisos::findFirstBycodigo((int) $this->request->getPost("id", "int"));
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

    //getNew
    public function getNewAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$personal = (int) $this->request->getPost("personal", "int");

            $PersonalPermisos = PersonalPermisos::count();

            //echo '<pre>';
            //print_r($PersonalPermisos);
            //exit();

            if ($PersonalPermisos >= 0) {

                $codigo = $PersonalPermisos + 1;

                $this->response->setJsonContent(array("say" => "yes", "codigo" => $codigo));
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

}
