<?php

class PersonalpermisosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/listapersonalpermisos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $Personal = Personal::findFirstBycodigo((int) $id);
        }

        $this->view->personal = $Personal;

        //TipoDocumento
        $tipo_documento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documento;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //religion
        $religion = Religion::find("estado = 'A' AND numero = 75 ");
        $this->view->religiones = $religion;

        //Sexo
        $sexo_personal = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo_personal = $sexo_personal;

        //personal_familiares
        $this->assets->addJs("adminpanel/js/modulos/personal.permisos.js?v=" . uniqid());

        //documento_familiar
        $tipo_documento_familiares = TipoDocumentoFamiliares::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos_familiares = $tipo_documento_familiares;

        //parentesco_familiar
        $parentesco_familiares = ParentescoFamiliares::find("estado = 'A' AND numero = 27 ");
        $this->view->parentesco_familiares = $parentesco_familiares;

        //sexo_familiares
        $sexo_familiares = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo_familiares = $sexo_familiares;

        //estado_civil_familiares
        $estado_civil_familiares = EstadoCivilFamiliares::find("estado = 'A' AND numero = 26 ");
        $this->view->estado_civil_familiares = $estado_civil_familiares;

        //grado_instruccion_familiar
        $grado_instruccion_familiar = GradoInstruccionFamiliares::find("estado = 'A' AND numero = 28 ");
        $this->view->grado_instruccion_familiares = $grado_instruccion_familiar;

        //tipo de permiso
        $tipo_permiso = TipoPermiso::find("estado = 'A' AND numero = 58 ");
        $this->view->tipopermiso = $tipo_permiso;
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, nombres, apellidop, apellidom,"
                    . " email, email1, grado, grado_universidad, titulo,"
                    . " titulo_universidad, grado_abreviado, concytec_enlace,"
                    . "fecha_nacimiento,direccion_actual,"
                    . "archivo, imagen, enlace,estado");
            $datatable->setFrom("tbl_web_personal");
            $datatable->setWhere("codigo > 0");
            $datatable->setOrderby("apellidop,apellidom,nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatables personal_permisos
    public function datatablePersonalPermisosAction($id) {
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
            $datatable->setWhere("personal_permisos.personal = $id AND personal_permisos.tipo = 3");
            $datatable->setOrderby("personal_permisos.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //guardar personal familiar
    public function savePersonalPermisosAction() {

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




                //motivos
                $PersonalPermisos->enlace = $this->request->getPost("enlace", "string");

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

                $PersonalPermisos->tipo = 3;


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
    public function getAjaxPersonalPermisosAction() {
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
