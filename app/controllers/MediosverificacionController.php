<?php

class MediosverificacionController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/mediosverificacion.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {

        if ($id != null) {
            $Medios = Medios::findFirstByid_medio_verificacion((int) $id);

            $indicadores = Indicadores::find("estado = 'A'");
            $this->view->indicadores = $indicadores;
        } else {
            $Medios = Medios::findFirstByid_medio_verificacion(0);
        }

        $this->view->medios = $Medios;

        //proceso medios de verificacion
        $proceso_medios = ProcesosMedios::find("estado = 'A' AND numero = 80 ");
        $this->view->procesomedios = $proceso_medios;

        //select condicion
        $condiciones = Condiciones::find("estado = 'A'");
        $this->view->condiciones = $condiciones;

        $Pesonal = Personal::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->personal = $Pesonal;


        $grupos = Grupos::find("estado = 'A' AND tipo = 3");
        $this->view->grupos_personal = $grupos;

        $grupos = Grupos::find("estado = 'A' AND tipo = 2");
        $this->view->grupos_docente = $grupos;

        $Docentes = Docentes::find(
                        [
                            "estado = 'A'",
                            'order' => 'apellidop ASC',
                        ]
        );
        $this->view->docentes = $Docentes;




        $this->assets->addJs("adminpanel/js/modulos/mediosverificacion.usuarios.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/mediosverificacion.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_medio_verificacion", "int");
                $Medios = Medios::findFirstByid_medio_verificacion($id);
                //Valida cuando es nuevo
                $Medios = (!$Medios) ? new Medios() : $Medios;

                //titular
                $Medios->nombre = $this->request->getPost("nombre", "string");

                $Medios->codigo = $this->request->getPost("codigo", "string");

                $Medios->indicador = $this->request->getPost("indicador", "string");

                //Objeto
                $Medios->descripcion = $this->request->getPost("descripcion", "string");

                //suscriptores
                $Medios->enlace = $this->request->getPost("enlace", "string");

                //proceso
                if ($this->request->getPost("proceso", "int") == "") {
                    $Medios->proceso = null;
                } else {
                    $Medios->proceso = $this->request->getPost("proceso", "int");
                }

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Medios->estado = "A";
                } else {
                    $Medios->estado = "X";
                }





                if ($Medios->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Medios->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            //archivo
                            $temporal_rand = mt_rand(100000, 999999);

                            $archivo_pdf = $_FILES['archivo_medios']['name'];
                            if ($archivo_pdf !== '') {
                                if ($file->getKey() == "archivo_medios") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($Medios->archivo)) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->codigo . '-' . $temporal_rand . '.pdf';
                                            $Medios->archivo = $Medios->codigo . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->codigo . '.pdf';
                                            $Medios->archivo = $Medios->codigo . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }


                            //archivo2
                            $archivo_excel = $_FILES['archivo2_medios']['name'];
                            if ($archivo_excel !== '') {
                                if ($file->getKey() == "archivo2_medios") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'xlsx') {
                                        if (isset($Medios->archivo2)) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo2;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->codigo . '-' . $temporal_rand . '.xlsx';
                                            $Medios->archivo2 = $Medios->codigo . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->codigo . '.xlsx';
                                            $Medios->archivo2 = $Medios->codigo . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    } elseif ($filex->getExtension() == 'xls') {
                                        if (strlen($Medios->archivo2) > 0) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo2;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->codigo . '-' . $temporal_rand . '.xls';
                                            $Medios->archivo2 = $Medios->codigo . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->codigo . '.xls';
                                            $Medios->archivo2 = $Medios->codigo . '.xls';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                }
                            }
                        }

                        $Medios->save();
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
            $datatable->setColumnaId("medios.id_medio_verificacion");
            $datatable->setSelect("medios.id_medio_verificacion,"
                    . "medios.nombre,medios.codigo,"
                    . "medios.descripcion, medios.archivo, medios.archivo2, "
                    . "medios.enlace, medios.proceso, medios.estado, "
                    . "indicadores.id_indicador, indicadores.nombre as nombre_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion medios  INNER JOIN tbl_lic_indicadores indicadores ON medios.indicador = indicadores.id_indicador");
            $datatable->setWhere("medios.estado = 'A'");
            $datatable->setOrderby("medios.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Medios = Medios::findFirstByid_medio_verificacion((string) $this->request->getPost("id", "string"));
            if ($Medios && $Medios->estado = 'A') {
                $Medios->estado = 'X';
                $Medios->save();
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

    //carga componentes
    public function getComponentesAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $condicion = $this->request->getPost("condicion");
            $componentes = Componentes::find('condicion="' . $condicion . '"');
            $this->response->setJsonContent($componentes->toArray());
            $this->response->send();
        }
    }

    //carga indicador
    public function getIndicadoresAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $componente = $this->request->getPost("componente");
            //echo "<pre>";
            //print_r($componente);
            //exit();
            $indicadores = Indicadores::find("componente = {$componente}");
            $this->response->setJsonContent($indicadores->toArray());
            $this->response->send();
        }
    }

    //carga medios
    public function getMediosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_indicador = $this->request->getPost("id_indicador");
            //echo "<pre>";
            //print_r($id_componente);
            //exit();
            $medios = Medios::find('id_indicador="' . $id_indicador . '"');
            $this->response->setJsonContent($medios->toArray());
            $this->response->send();
        }
    }

    #mediosarchivo

    public function getArchivosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo_medio = $this->request->getPost("archivo_medio");
            $nombre_fichero = 'adminpanel/archivos/mediosverificacion/' . $archivo_medio;

            if (file_exists($nombre_fichero)) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si", "archivo_medio" => $archivo_medio));
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

    //delete pdf
    public function deletepdfAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Medios = Medios::findFirstByid_medio_verificacion((string) $this->request->getPost("id", "string"));
            if ($Medios) {
                $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo;
                unlink($url_destino);
                $Medios->archivo = '';
                $Medios->save();
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
            $Medios = Medios::findFirstByid_medio_verificacion((string) $this->request->getPost("id", "string"));
            if ($Medios) {
                $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo2;
                unlink($url_destino);
                $Medios->archivo2 = '';
                $Medios->save();
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

#------------------------------usuarios----------------------------------------

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
                $UsuariosDetalles->tabla = "tbl_lic_medios_verificacion";
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
        //print($id);
        //exit();
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
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_lic_medios_verificacion' AND tipo = 3");
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

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");
                if ($obj) {
                    //print("accion:" . $obj->accion);
                    //exit();
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


                $UsuariosDetalles = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");

                //print($UsuariosDetalles->id_usuario);
                //exit();

                if (isset($UsuariosDetalles->id_usuario)) {
                    
                } else {
                    $NuevoUsuariosDetalles = new UsuariosDetalles();
                    $NuevoUsuariosDetalles->id_usuario = $id_usuario;
                    $NuevoUsuariosDetalles->tabla = 'tbl_lic_medios_verificacion';
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

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_usuario_detalle", "int");
                $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id);
                $UsuariosDetalles = (!$UsuariosDetalles) ? new UsuariosDetalles() : $UsuariosDetalles;

                $UsuariosDetalles->id_usuario = $this->request->getPost("id_usuario", "int");
                $UsuariosDetalles->tabla = "tbl_lic_medios_verificacion";
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
            $id_usuario_detalle = (int) $this->request->getPost("id", "int");
            $UsuariosDetalles = UsuariosDetalles::findFirstByid_usuario_detalle($id_usuario_detalle);

            if ($UsuariosDetalles && $UsuariosDetalles->estado = 'A') {

                //delete row table
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
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_lic_medios_verificacion' AND tipo = 2");
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

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 2");
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


                $UsuariosDetalles = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 2");

                //print($UsuariosDetalles->id_usuario);
                //exit();

                if (isset($UsuariosDetalles->id_usuario)) {
                    
                } else {
                    $NuevoUsuariosDetalles = new UsuariosDetalles();
                    $NuevoUsuariosDetalles->id_usuario = $id_usuario;
                    $NuevoUsuariosDetalles->tabla = 'tbl_lic_medios_verificacion';
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
