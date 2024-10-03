<?php

class LicenciamientoController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    ///////////////////////////////////////////////mediosverificacion///////////////////////////////////

    public function mediosverificacionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.mediosverificacion.js?v=" . uniqid());
    }

    public function registroMediosverificacionAction($id = null)
    {

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

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.mediosverificacion.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.mediosverificacion.usuarios.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.mediosverificacion.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    public function saveMediosverificacionAction()
    {

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
                                            if ($Medios->archivo !== "") {
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
                                            if ($Medios->archivo2 !== "") {
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
                                            if ($Medios->archivo2 !== "") {
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

    public function datatablemediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("medios.id_medio_verificacion");
            $datatable->setSelect("medios.id_medio_verificacion,"
                . "medios.nombre,medios.codigo,"
                . "medios.descripcion, medios.archivo, medios.archivo2, "
                . "medios.enlace, medios.proceso, medios.estado, "
                . "indicadores.id_indicador,indicadores.nombre AS nombre_indicador,indicadores.codigo AS codigo_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion medios  INNER JOIN tbl_lic_indicadores indicadores ON medios.indicador = indicadores.id_indicador");
            $datatable->setWhere("medios.estado = 'A'");
            $datatable->setOrderby("medios.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarMediosverificacionAction()
    {
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

    public function getComponentesMediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $condicion = $this->request->getPost("condicion");
            $componentes = Componentes::find('condicion="' . $condicion . '"');
            $this->response->setJsonContent($componentes->toArray());
            $this->response->send();
        }
    }

    //carga indicador
    public function getIndicadoresMediosverificacionAction()
    {
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

    public function getMediosMediosverificacionAction()
    {
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

    public function getArchivosMediosverificacionAction()
    {
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

    public function deletepdfMediosverificacionAction()
    {
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

    public function deleteexcelMediosverificacionAction()
    {
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

    public function saveUsuariosDetallesMediosverificacionAction()
    {

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

    public function getAjaxUsuariosDetallesMediosverificacionAction()
    {
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

    public function eliminarUsuariosDetallesMediosverificacionAction()
    {
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

    public function datatableUsuariosDetallesMediosverificacionAction($id)
    {
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

    public function getAjaxValidarUsuarioMediosverificacionAction()
    {
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

    public function savePersonalGrupoMediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //            echo "<pre>";
            //            print_r($_POST);
            //            exit();

            $id_grupo = $this->request->getPost("id_grupo", "int");
            $id_tabla = $this->request->getPost("id_tabla", "int");

            $PersonalGrupos = PersonalGrupos::find(
                [
                    "grupo = {$id_grupo} AND estado = 'A'",
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

    public function saveUsuariosDetallesDocenteMediosverificacionAction()
    {

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

    public function getAjaxUsuariosDetallesDocenteMediosverificacionAction()
    {
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

    public function eliminarUsuariosDetallesDocenteMediosverificacionAction()
    {
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

    public function datatableUsuariosDetallesDocenteMediosverificacionAction($id)
    {
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

    public function getAjaxValidarUsuarioDocenteMediosverificacionAction()
    {
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

    public function savePersonalGrupoDocenteMediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //            echo "<pre>";
            //            print_r($_POST);
            //            exit();

            $id_grupo = $this->request->getPost("id_grupo", "int");
            $id_tabla = $this->request->getPost("id_tabla", "int");

            $PersonalGrupos = PersonalGrupos::find(
                [
                    "grupo = {$id_grupo} AND estado = 'A'",
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

    ///////////////////////////////////////////////formatos///////////////////////////////////
    public function formatosAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.formatos.js?v=" . uniqid());
    }

    //Funcion agregar y editar
    public function registroFormatosAction($id = null)
    {
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

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.formatos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/formatos.usuarios.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/formatos.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    public function saveFormatosAction()
    {

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

                                            if ($Formatos->archivo !== "") {
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

                                            if ($Formatos->archivo2 !== "") {
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

                                            if ($Formatos->archivo2 !== "") {
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

    public function datatableFormatosAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_formato");
            $datatable->setSelect("id_formato, codigo, nombre, descripcion, archivo, enlace, estado, archivo2");
            $datatable->setFrom("tbl_lic_formatos");
            $datatable->setWhere("estado = 'A' AND tipo = 0");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function eliminarFormatosAction()
    {
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

    public function deletepdfFormatosAction()
    {
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

    public function deleteexcelFormatosAction()
    {
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

    public function codigoRegistradoFormatosAction()
    {
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

    public function saveUsuariosDetallesFormatosAction()
    {

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

    public function getAjaxUsuariosDetallesFormatosAction()
    {
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

    public function eliminarUsuariosDetallesFormatosAction()
    {
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

    public function datatableUsuariosDetallesFormatosAction($id)
    {
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

    public function getAjaxValidarUsuarioFormatosAction()
    {
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

    public function savePersonalGrupoFormatosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //            echo "<pre>";
            //            print_r($_POST);
            //            exit();

            $id_grupo = $this->request->getPost("id_grupo", "int");
            $id_tabla = $this->request->getPost("id_tabla", "int");

            $PersonalGrupos = PersonalGrupos::find(
                [
                    "grupo = {$id_grupo} AND estado = 'A'",
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

    public function saveUsuariosDetallesDocenteFormatosAction()
    {

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

    public function getAjaxUsuariosDetallesDocenteFormatosAction()
    {
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

    public function eliminarUsuariosDetallesDocenteFormatosAction()
    {
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

    public function datatableUsuariosDetallesDocenteFormatosAction($id)
    {
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

    public function getAjaxValidarUsuarioDocenteFormatosAction()
    {
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

    public function savePersonalGrupoDocenteFormatosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //            echo "<pre>";
            //            print_r($_POST);
            //            exit();

            $id_grupo = $this->request->getPost("id_grupo", "int");
            $id_tabla = $this->request->getPost("id_tabla", "int");

            $PersonalGrupos = PersonalGrupos::find(
                [
                    "grupo = {$id_grupo} AND estado = 'A'",
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

    //////////////////////////////////////////condiciones///////////////////////////////////////////////////////
    public function condicionesAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.condiciones.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableCondicionesAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_condicion");
            $datatable->setSelect("id_condicion, codigo, nombre, descripcion, enlace, numero, avance, estado");
            $datatable->setFrom("tbl_lic_condiciones");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroCondicionesAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $condiciones = Condiciones::findFirstByid_condicion((int) $id);
        } else {

            $condiciones = Condiciones::findFirstByid_condicion(0);
        }

        $this->view->condiciones = $condiciones;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.condiciones.js?v=" . uniqid());
    }

    public function saveCondicionesAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_condicion1", "int");
                $condiciones = Condiciones::findFirstByid_condicion($id);

                $condiciones = (!$condiciones) ? new Condiciones() : $condiciones;

                $condiciones->codigo = $this->request->getPost("codigo", "string");

                $condiciones->nombre = $this->request->getPost("nombre", "string");

                $condiciones->descripcion = $this->request->getPost("descripcion", "string");

                $condiciones->enlace = $this->request->getPost("enlace", "string");

                $condiciones->numero = $this->request->getPost("numero", "string");

                $condiciones->avance = $this->request->getPost("avance", "string");

                $condiciones->tipo = 1;

                $condiciones->estado = "A";

                if ($condiciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($condiciones->getMessages());
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

    public function codigoRegistradoCondicionesAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $condiciones = Condiciones::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

            if ($condiciones) {
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

    ///////////////////////////////////////////////componentes1///////////////////////////////////////////////////////
    public function componentesAction()
    {
        $condiciones = Condiciones::find("estado = 'A' ORDER BY id_condicion");
        $this->view->condiciones = $condiciones;

        $condicionesSelected = Condiciones::findFirst("estado = 'A' AND id_condicion = 1");
        $this->view->condicionesSelected = $condicionesSelected;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.componentes.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableComponentesAction($condicionSelect = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            if ($condicionSelect != 0) {
                $where = "AND condicion = '{$condicionSelect}'";
            } else {
                $where = "AND condicion = 1";
            }

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_componente");
            $datatable->setSelect("id_componente, condicion, codigo, nombre, descripcion, enlace, estado");
            $datatable->setFrom("tbl_lic_componentes");
            $datatable->setWhere("estado = 'A' $where");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroComponentesAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $componentes = Componentes::findFirstByid_componente((int) $id);
        } else {
            $componentes = Componentes::findFirstByid_componente(0);
        }

        $this->view->componentes = $componentes;

        //select condicion1
        $condiciones = Condiciones::find("estado = 'A'");
        $this->view->condiciones = $condiciones;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.componentes.js?v=" . uniqid());
    }

    public function saveComponentesAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_componente", "int");
                $compotente = Componentes::findFirstByid_componente($id);

                $compotente = (!$compotente) ? new Componentes() : $compotente;

                $compotente->condicion = $this->request->getPost("condicion", "string");

                $compotente->codigo = $this->request->getPost("codigo", "string");

                $compotente->nombre = $this->request->getPost("nombre", "string");

                $compotente->descripcion = $this->request->getPost("descripcion", "string");

                $compotente->enlace = $this->request->getPost("enlace", "string");

                $compotente->estado = "A";

                if ($compotente->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($compotente->getMessages());
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

    public function codigoRegistradoComponentesAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $componentes = Componentes::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

            if ($componentes) {

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

    ///////////////////////////////////////////////indicadores///////////////////////////////////////////////////////
    public function indicadoresAction()
    {
        $condiciones = Condiciones::find("estado = 'A' ORDER BY id_condicion");
        $this->view->condiciones = $condiciones;

        $condicionesSelected = Condiciones::findFirst("estado = 'A' AND id_condicion = 1");
        $this->view->condicionesSelected = $condicionesSelected;

        $componentes = Componentes::find("estado = 'A' ORDER BY id_componente");
        $this->view->componentes = $componentes;

        $componentesSelected = Componentes::findFirst("estado = 'A' AND id_componente = 1");
        $this->view->componentesSelected = $componentesSelected;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.indicadores.js?v=" . uniqid());
    }

    //carga componentes
    public function getComponentesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $condicion = $this->request->getPost("pk");
            $componentes = Componentes::find("condicion= $condicion");

            // foreach ($componentes as $fua) {
            //     echo "<pre>";
            //     print_r($fua->nombre);
            // }
            // exit();

            $this->response->setJsonContent($componentes->toArray());
            $this->response->send();
        }
    }

    //Cargamos el datatables
    public function datatableIndicadoresAction($componenteSelect = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            if ($componenteSelect != 0) {
                $where = "AND componente = '{$componenteSelect}'";
            } else {
                $where = "AND componente = 0";
            }

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_indicador");
            $datatable->setSelect("id_indicador, componente, codigo, nombre, descripcion, enlace, estado");
            $datatable->setFrom("tbl_lic_indicadores");
            $datatable->setWhere("estado = 'A' $where");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroIndicadoresAction($id = null, $condicionSelected = null, $componenteSelected = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $indicadores = Indicadores::findFirstByid_indicador((int) $id);
        } else {
            $indicadores = Indicadores::findFirstByid_indicador(0);
        }

        $this->view->indicadores = $indicadores;

        $condiciones = Condiciones::find("estado = 'A'");
        $this->view->condiciones = $condiciones;
        $this->view->condicionSelected = $condicionSelected;

        $componentes = Componentes::find("estado = 'A'");
        $this->view->componentes = $componentes;
        $this->view->componenteSelected = $componenteSelected;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.indicadores.js?v=" . uniqid());
    }

    public function saveIndicadoresAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_indicador", "int");
                $indicadores = Indicadores::findFirstByid_indicador($id);

                $indicadores = (!$indicadores) ? new Indicadores() : $indicadores;

                $indicadores->componente1 = $this->request->getPost("componente1", "string");

                $indicadores->codigo = $this->request->getPost("codigo", "string");

                $indicadores->nombre = $this->request->getPost("nombre", "string");

                $indicadores->descripcion = $this->request->getPost("descripcion", "string");

                $indicadores->enlace = $this->request->getPost("enlace", "string");

                $indicadores->estado = "A";

                if ($indicadores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($indicadores->getMessages());
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

    public function codigoRegistradoIndicadoresAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $indicadores = Indicadores::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

            if ($indicadores) {

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

    ///////////////////////////////////////////////indicadoresevaluacion///////////////////////////////////
    public function indicadoresevaluacionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.indicadores.evaluacion.js?v=" . uniqid());
    }


    public function datatableIndicadoresEvaluacionAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_indicador");
            $datatable->setSelect("id_indicador, componente, codigo, nombre, descripcion, enlace, cumple,observaciones, estado");
            $datatable->setFrom("tbl_lic_indicadores");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function IndicaoresCumpleAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Indicadores = Indicadores::findFirstByid_indicador((int) $this->request->getPost("id", "int"));

            if ($Indicadores->cumple == 0) {
                $Indicadores->cumple = 1;
                $Indicadores->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } elseif ($Indicadores->cumple == 1) {
                $Indicadores->cumple = 0;
                $Indicadores->save();
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


    public function getAjaxIndicadoresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $indicadores = Indicadores::findFirstByid_indicador((int) $this->request->getPost("id", "int"));
            if ($indicadores) {
                $this->response->setJsonContent($indicadores->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function indicadoresObservacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $indicadores = Indicadores::findFirstByid_indicador((int) $this->request->getPost("id_indicador", "int"));

                // echo "<pre>";
                // print_r($indicadores->id_indicador);
                // exit();


                $indicadores->observaciones = $this->request->getPost("observaciones", "string");

                if ($indicadores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($indicadores->getMessages());
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


    //formatossunedu
    public function formatossuneduAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.formatossunedu.js?v=" . uniqid());
    }

    public function datatableFormatossuneduAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_formato");
            $datatable->setSelect("id_formato, nombre, descripcion, archivo, enlace, estado, archivo2");
            $datatable->setFrom("tbl_lic_formatos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_formato");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //mediosverificacionsunedu
    public function mediosverificacionsuneduAction() {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento.mediosverificacionsunedu.js?v=" . uniqid());

    }

    public function datatableMediosverificacionsuneduAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("medios.id_medio_verificacion");
            $datatable->setSelect("medios.id_medio_verificacion, medios.nombre, "
                    . "medios.descripcion, medios.archivo, "
                    . "medios.enlace, medios.proceso, medios.estado, "
                    . "indicadores.id_indicador, indicadores.nombre as nombre_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion medios  INNER JOIN tbl_lic_indicadores indicadores ON medios.indicador = indicadores.id_indicador");
            $datatable->setWhere("medios.estado = 'A'");
            $datatable->setOrderby("medios.id_medio_verificacion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getArchivosMediosverificacionsuneduAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo_medio_sunedu = $this->request->getPost("archivo_medio");
            $nombre_fichero = 'adminpanel/archivos/medios/' . $archivo_medio_sunedu;

            if (file_exists($nombre_fichero)) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si", "archivo_medio_sunedu" => $archivo_medio_sunedu));
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
