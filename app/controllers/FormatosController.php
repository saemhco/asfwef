<?php

class FormatosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/formatos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {
        $this->view->id = $id;
        if ($id != null) {
            $formatos = Formatos::findFirstByid_formato((int) $id);
        } else {

            $formatos = Formatos::findFirstByid_formato(0);
        }

        $this->view->formatos = $formatos;

        $Pesonal = Personal::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->personal = $Pesonal;

        $Docentes = Docentes::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->docentes = $Docentes;




        $grupos = Grupos::find("estado = 'A' AND tipo = 3");
        $this->view->grupos_personal = $grupos;

        $grupos = Grupos::find("estado = 'A' AND tipo = 2");
        $this->view->grupos_docente = $grupos;

        $this->assets->addJs("adminpanel/js/modulos/formatos.usuarios.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/formatos.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction() {


//        echo "<pre>";
//        print_r($_POST);
//        exit();
        //echo "<pre>";
        //print_r($_FILES);
        //exit();
        //echo "<pre>";
        //print_r("archivo1:".$_FILES['archivo_formato']['name']."-"."archivo2:".$_FILES['archivo2_formato']['name']);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_formato", "int");
                $Formatos = Formatos::findFirstByid_formato($id);
                //Valida cuando es nuevo
                $Formatos = (!$Formatos) ? new Formatos() : $Formatos;

                //titular
                $Formatos->nombre = $this->request->getPost("nombre", "string");

                $Formatos->codigo = $this->request->getPost("codigo", "string");

                //Objeto
                $Formatos->descripcion = $this->request->getPost("descripcion", "string");

                //suscriptores
                $Formatos->enlace = $this->request->getPost("enlace", "string");

                //tipo
                $Formatos->tipo = 0;

                //estado
                $Formatos->estado = "A";

                if ($Formatos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Formatos->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            //archivo
                            $temporal_rand = mt_rand(100000, 999999);



                            $archivo_pdf = $_FILES['archivo_formato']['name'];
                            if ($archivo_pdf !== '') {
                                if ($file->getKey() == "archivo_formato") {

                                    //echo '<pre>';
                                    //print_r("llega archivo 1");
                                    //exit();

                                    $filex = new SplFileInfo($file->getName());

                                    //echo '<pre>';
                                    //print_r($file->getName());
                                    //exit();
                                    //$file->getName() = $Resoluciones->nombre;
                                    //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                    //$url_destino = 'adminpanel/archivos/formatos/' . 'FILE' . '-' . $Formatos->id_formato . '.pdf';
                                    //$url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '.xlsx';
                                    //$Formatos->archivo = $Formatos->id_formato . '.xlsx';


                                    if ($filex->getExtension() == 'pdf') {

                                        if (isset($Formatos->imagen)) {

                                            //echo '<pre>';
                                            //print_r("edit:");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->codigo . '-' . $temporal_rand . '.pdf';
                                            $Formatos->archivo = $Formatos->codigo . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("new");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->codigo . '.pdf';
                                            $Formatos->archivo = $Formatos->codigo . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                            //archivo2
                            $archivo_excel = $_FILES['archivo2_formato']['name'];
                            if ($archivo_excel !== '') {
                                if ($file->getKey() == "archivo2_formato") {

                                    //echo '<pre>';
                                    //print_r("llega archivo 2");
                                    //exit();


                                    $filex = new SplFileInfo($file->getName());


                                    if ($filex->getExtension() == 'xlsx') {

                                        if (strlen($Formatos->archivo2) > 0) {

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo2;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->codigo . '-' . $temporal_rand . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->codigo . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->codigo . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->codigo . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    } elseif ($filex->getExtension() == 'xls') {

                                        if (strlen($Formatos->archivo2) > 0) {

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo2;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->codigo . '-' . $temporal_rand . '.xls';
                                            $Formatos->archivo2 = $Formatos->codigo . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->codigo . '.xls';
                                            $Formatos->archivo2 = $Formatos->codigo . '.xls';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                            //
                        }

                        $Formatos->save();
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
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_formato");
            $datatable->setSelect("id_formato, codigo, nombre, descripcion, archivo, enlace, estado, archivo2");
            $datatable->setFrom("tbl_lic_formatos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Formatos = Formatos::findFirstByid_formato((int) $this->request->getPost("id", "int"));
            if ($Formatos && $Formatos->estado = 'A') {
                $Formatos->estado = 'X';
                $Formatos->save();
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

    //delete pdf
    public function deletepdfAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Formatos = Formatos::findFirstByid_formato((string) $this->request->getPost("id", "string"));
            if ($Formatos) {
                $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo;
                unlink($url_destino);
                $Formatos->archivo = '';
                $Formatos->save();
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

    //delete excel
    public function deleteexcelAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Formatos = Formatos::findFirstByid_formato((string) $this->request->getPost("id", "string"));
            if ($Formatos) {
                $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo2;
                unlink($url_destino);
                $Formatos->archivo2 = '';
                $Formatos->save();
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

    //codigo registrado
    public function codigoRegistradoAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $formatos = Formatos::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

            if ($formatos) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
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

#-----------------------------personal-----------------------------------------

    public function saveUsuariosDetallesAction() {

//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_usuario_detalle", "int");
                $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id);
                $UsuariosDetalles = (!$UsuariosDetalles) ? new UsuariosDetalles() : $UsuariosDetalles;

                $UsuariosDetalles->id_usuario = $this->request->getPost("id_usuario", "int");
                $UsuariosDetalles->tabla = "tbl_lic_formatos";
                $UsuariosDetalles->id_tabla = $this->request->getPost("id_tabla", "int");

                $accion = $this->request->getPost("accion", "string");
                if (isset($accion)) {
                    $UsuariosDetalles->accion = "1";
                } else {
                    $UsuariosDetalles->accion = "0";
                }

                $UsuariosDetalles->estado = "A";
                $UsuariosDetalles->tipo = 3;

                if ($UsuariosDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($UsuariosDetalles->getMessages());
                } else {

                    //Cuando va bien
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

    //Editar Usuarios Detalles
    public function getAjaxUsuariosDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = UsuariosDetalles::findFirstByid_usuario_detalle((int) $this->request->getPost("id", "int"));
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

    //Eliminar Usuarios Detalles
    public function eliminarUsuariosDetallesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle((int) $this->request->getPost("id", "int"));
            $id_usuario_detalle = (int) $this->request->getPost("id", "int");
            $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id_usuario_detalle);

//            echo '<pre>';
//            print_r($ConvocatoriasDetalle->id_convocatoria_detalle);
//            exit();

            if ($UsuariosDetalles && $UsuariosDetalles->estado = 'A') {
                //$UsuariosDetalles->estado = 'X';
                //$UsuariosDetalles->save();
                $this->db->delete("tbl_seg_usuarios_detalles", "id_usuario_detalle = {$id_usuario_detalle}");
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

    public function datatableUsuariosDetallesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_usuario_detalle");
            $datatable->setSelect("id_usuario_detalle,apellidos_nombres,estado,id_tabla,accion,tabla,tipo");
            $datatable->setFrom("(SELECT
            usuarios_detalles.id_usuario_detalle AS id_usuario_detalle,     
            CONCAT (personal.apellidop, ' ', personal.apellidom, ' ', personal.nombres ) AS apellidos_nombres,
            usuarios_detalles.estado AS estado,
            usuarios_detalles.id_tabla AS id_tabla,
            usuarios_detalles.tabla AS tabla,
            usuarios_detalles.accion AS accion,
            usuarios_detalles.tipo AS tipo
            FROM
            tbl_seg_usuarios_detalles AS usuarios_detalles
            INNER JOIN tbl_web_personal AS personal ON personal.codigo = usuarios_detalles.id_usuario) AS temporal_table");
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_lic_formatos' AND tipo = 3");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxValidarUsuarioAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));
//            echo '<pre>';
//            print_r($_POST);
//            exit();

            $id_usuario = (int) $this->request->getPost("id_usuario", "int");
            $id_usuario_oculto = (int) $this->request->getPost("id_usuario_oculto", "int");
            $id_tabla = (int) $this->request->getPost("id_tabla", "int");


            if ($id_usuario == $id_usuario_oculto) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_formatos' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");
                if ($obj) {
                    //print("accion:".$obj->accion);
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

    public function savePersonalGrupoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

//            echo "<pre>";
//            print_r($_POST);
//            exit();

            $id_grupo = $this->request->getPost("id_grupo", "int");
            $id_tabla = $this->request->getPost("id_tabla", "int");

            $PersonalGrupos = PersonalGrupos::find(
                            [
                                "grupo = {$id_grupo} AND estado = 'A'"
                            ]
            );

            //$nuevo = 1;
            foreach ($PersonalGrupos as $valuePersonalGrupos) {

                //echo '<pre>';
                //print_r($valuePersonalGrupos->personal);


                $id_usuario = $valuePersonalGrupos->personal;


                $UsuariosDetalles = UsuariosDetalles::findFirst("tabla = 'tbl_lic_formatos' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");

                //print($UsuariosDetalles->id_usuario);
                //exit();

                if (isset($UsuariosDetalles->id_usuario)) {
                    
                } else {
                    $NuevoUsuariosDetalles = new UsuariosDetalles();
                    $NuevoUsuariosDetalles->id_usuario = $id_usuario;
                    $NuevoUsuariosDetalles->tabla = 'tbl_lic_formatos';
                    $NuevoUsuariosDetalles->id_tabla = $id_tabla;
                    $NuevoUsuariosDetalles->accion = 0;
                    $NuevoUsuariosDetalles->estado = "A";
                    $NuevoUsuariosDetalles->tipo = 3;
                    $NuevoUsuariosDetalles->save();
                }
            }
            //exit();

            if ($PersonalGrupos) {
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

    #------------------------------docente--------------------------------------

    public function saveUsuariosDetallesDocenteAction() {

//        echo "<pre>";
//        print_r($_POST);
//        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_usuario_detalle", "int");
                $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id);
                $UsuariosDetalles = (!$UsuariosDetalles) ? new UsuariosDetalles() : $UsuariosDetalles;

                $UsuariosDetalles->id_usuario = $this->request->getPost("id_usuario", "int");
                $UsuariosDetalles->tabla = "tbl_lic_formatos";
                $UsuariosDetalles->id_tabla = $this->request->getPost("id_tabla", "int");

                $accion = $this->request->getPost("accion", "string");
                if (isset($accion)) {
                    $UsuariosDetalles->accion = "1";
                } else {
                    $UsuariosDetalles->accion = "0";
                }

                $UsuariosDetalles->estado = "A";
                $UsuariosDetalles->tipo = 2;

                if ($UsuariosDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($UsuariosDetalles->getMessages());
                } else {

                    //Cuando va bien
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

    public function getAjaxUsuariosDetallesDocenteAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = UsuariosDetalles::findFirstByid_usuario_detalle((int) $this->request->getPost("id", "int"));
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

    public function eliminarUsuariosDetallesDocenteAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle((int) $this->request->getPost("id", "int"));
            $id_usuario_detalle = (int) $this->request->getPost("id", "int");
            $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id_usuario_detalle);

//            echo '<pre>';
//            print_r($ConvocatoriasDetalle->id_convocatoria_detalle);
//            exit();

            if ($UsuariosDetalles && $UsuariosDetalles->estado = 'A') {
                //$UsuariosDetalles->estado = 'X';
                //$UsuariosDetalles->save();
                $this->db->delete("tbl_seg_usuarios_detalles", "id_usuario_detalle = {$id_usuario_detalle}");
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

    public function datatableUsuariosDetallesDocenteAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_usuario_detalle");
            $datatable->setSelect("id_usuario_detalle,apellidos_nombres,estado,id_tabla,accion,tabla,tipo");
            $datatable->setFrom("(SELECT
            usuarios_detalles.id_usuario_detalle AS id_usuario_detalle,     
            CONCAT (docentes.apellidop, ' ', docentes.apellidom, ' ', docentes.nombres ) AS apellidos_nombres,
            usuarios_detalles.estado AS estado,
            usuarios_detalles.id_tabla AS id_tabla,
            usuarios_detalles.tabla AS tabla,
            usuarios_detalles.accion AS accion,
            usuarios_detalles.tipo AS tipo
            FROM
            tbl_seg_usuarios_detalles AS usuarios_detalles
            INNER JOIN docentes AS docentes ON docentes.codigo = usuarios_detalles.id_usuario) AS temporal_table");
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_lic_formatos' AND tipo = 2");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxValidarUsuarioDocenteAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));
//            echo '<pre>';
//            print_r($_POST);
//            exit();

            $id_usuario = (int) $this->request->getPost("id_usuario", "int");
            $id_usuario_oculto_docente = (int) $this->request->getPost("id_usuario_oculto_docente", "int");
            $id_tabla = (int) $this->request->getPost("id_tabla", "int");


            if ($id_usuario == $id_usuario_oculto_docente) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_formatos' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 2");
                if ($obj) {
                    //print("accion:".$obj->accion);
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

    public function savePersonalGrupoDocenteAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

//            echo "<pre>";
//            print_r($_POST);
//            exit();

            $id_grupo = $this->request->getPost("id_grupo", "int");
            $id_tabla = $this->request->getPost("id_tabla", "int");

            $PersonalGrupos = PersonalGrupos::find(
                            [
                                "grupo = {$id_grupo} AND estado = 'A'"
                            ]
            );

            //$nuevo = 1;
            foreach ($PersonalGrupos as $valuePersonalGrupos) {

                //echo '<pre>';
                //print_r($valuePersonalGrupos->personal);


                $id_usuario = $valuePersonalGrupos->personal;


                $UsuariosDetalles = UsuariosDetalles::findFirst("tabla = 'tbl_lic_formatos' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 2");

                //print($UsuariosDetalles->id_usuario);
                //exit();

                if (isset($UsuariosDetalles->id_usuario)) {
                    
                } else {
                    $NuevoUsuariosDetalles = new UsuariosDetalles();
                    $NuevoUsuariosDetalles->id_usuario = $id_usuario;
                    $NuevoUsuariosDetalles->tabla = 'tbl_lic_formatos';
                    $NuevoUsuariosDetalles->id_tabla = $id_tabla;
                    $NuevoUsuariosDetalles->accion = 0;
                    $NuevoUsuariosDetalles->estado = "A";
                    $NuevoUsuariosDetalles->tipo = 2;
                    $NuevoUsuariosDetalles->save();
                }
            }
            //exit();

            if ($PersonalGrupos) {
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
