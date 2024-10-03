<?php

class GestionlicenciamientoController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

    }

    public function indexAction()
    {

    }

    ////////////////////////////////////////////////////////mediosverificacion////////////////////////////////////////////////

    public function mediosverificacionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento.mediosverificacion.js?v=" . uniqid());

    }

    public function registromediosverificacionAction($id = null)
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

        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento.mediosverificacion.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveMediosverificacionAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

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
                                        if (strlen($Medios->archivo) > 0) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->id_medio_verificacion . '-' . $temporal_rand . '.pdf';
                                            $Medios->archivo = $Medios->id_medio_verificacion . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->id_medio_verificacion . '.pdf';
                                            $Medios->archivo = $Medios->id_medio_verificacion . '.pdf';
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
                                        if (strlen($Medios->archivo2) > 0) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo2;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->id_medio_verificacion . '-' . $temporal_rand . '.xlsx';
                                            $Medios->archivo2 = $Medios->id_medio_verificacion . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->id_medio_verificacion . '.xlsx';
                                            $Medios->archivo2 = $Medios->id_medio_verificacion . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    } elseif ($filex->getExtension() == 'xls') {
                                        if (strlen($Medios->archivo2) > 0) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->archivo2;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->id_medio_verificacion . '-' . $temporal_rand . '.xls';
                                            $Medios->archivo2 = $Medios->id_medio_verificacion . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion/' . $Medios->id_medio_verificacion . '.xls';
                                            $Medios->archivo2 = $Medios->id_medio_verificacion . '.xls';
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

    public function datatableMediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];
            $tipo = $auth["tipo"];

            //print($tipo);
            //exit();

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("mediosverificacion.id_medio_verificacion");
            $datatable->setSelect("mediosverificacion.id_medio_verificacion,"
                . "mediosverificacion.nombre,mediosverificacion.codigo,"
                . "mediosverificacion.descripcion, mediosverificacion.archivo, mediosverificacion.archivo2, "
                . "mediosverificacion.enlace, mediosverificacion.proceso, mediosverificacion.estado, "
                . "indicadores.id_indicador, indicadores.nombre as nombre_indicador, indicadores.codigo AS codigo_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion mediosverificacion  INNER JOIN tbl_lic_indicadores indicadores ON mediosverificacion.indicador = indicadores.id_indicador"
                . " INNER JOIN tbl_seg_usuarios_detalles usuarios_detalles ON usuarios_detalles.id_tabla = mediosverificacion.id_medio_verificacion");
            $datatable->setWhere("usuarios_detalles.id_usuario ={$id_usuario} AND usuarios_detalles.tabla = 'tbl_lic_medios_verificacion' AND mediosverificacion.estado = 'A' AND usuarios_detalles.tipo = $tipo");
            $datatable->setOrderby("mediosverificacion.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarMediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Medios = Medios::findFirstByid_medio((string) $this->request->getPost("id", "string"));
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

    //carga medios
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
            $Medios = Medios::findFirstByid_medio((string) $this->request->getPost("id", "string"));
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
            $Medios = Medios::findFirstByid_medio((string) $this->request->getPost("id", "string"));
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

    public function getAjaxPermisoMediosverificacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_tabla = (int) $this->request->getPost("id", "int");

            //$obj = UsuariosDetalles::findFirstBytabla($tabla);
            $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion' AND id_tabla = {$id_tabla}");

            // print("update:" . $obj->tabla);
            // exit();

            // print("update:" . $obj->accion);
            // exit();

            if ($obj->accion == '1') {

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

    ////////////////////////////////////////////////////////formatos////////////////////////////////////////////////
    public function formatosAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento.formatos.js?v=" . uniqid());

    }

    public function registroFormatosAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $formatos = Formatos::findFirstByid_formato((int) $id);
        } else {

            $formatos = Formatos::findFirstByid_formato(0);
        }

        $this->view->formatos = $formatos;

        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento.formatos.js?v=" . uniqid());
    }

    public function saveFormatosAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();
        //echo "<pre>";
        //print_r($_FILES);
        //exit();
        //echo "<pre>";
        //print_r("archivo1:".$_FILES['archivo_formato']['name']."-"."archivo2:".$_FILES['archivo2_formato']['name']);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("id_formato", "string");
                $Formatos = Formatos::findFirstByid_formato($id);
                //Valida cuando es nuevo
                $Formatos = (!$Formatos) ? new Formatos() : $Formatos;

                //titular
                $Formatos->nombre = $this->request->getPost("nombre", "string");

                $Formatos->id_formato = $this->request->getPost("id_formato", "string");

                //Objeto
                $Formatos->descripcion = $this->request->getPost("descripcion", "string");

                //suscriptores
                $Formatos->enlace = $this->request->getPost("enlace", "string");

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

                                        if (strlen($Formatos->archivo) > 0) {

                                            //echo '<pre>';
                                            //print_r("edit:");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '-' . $temporal_rand . '.pdf';
                                            $Formatos->archivo = $Formatos->id_formato . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("new");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '.pdf';
                                            $Formatos->archivo = $Formatos->id_formato . '.pdf';
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
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '-' . $temporal_rand . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->id_formato . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->id_formato . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    } elseif ($filex->getExtension() == 'xls') {

                                        if (strlen($Formatos->archivo2) > 0) {

                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->archivo2;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '-' . $temporal_rand . '.xls';
                                            $Formatos->archivo2 = $Formatos->id_formato . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos/' . $Formatos->id_formato . '.xls';
                                            $Formatos->archivo2 = $Formatos->id_formato . '.xls';
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

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];
            $tipo = $auth["tipo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("formatos.id_formato");
            $datatable->setSelect("formatos.id_formato,formatos.codigo, formatos.nombre, formatos.descripcion, formatos.archivo, formatos.enlace, formatos.estado, formatos.archivo2");
            $datatable->setFrom("tbl_lic_formatos formatos INNER JOIN tbl_seg_usuarios_detalles usuarios_detalles ON usuarios_detalles.id_tabla = formatos.id_formato");
            $datatable->setWhere("usuarios_detalles.id_usuario ={$id_usuario} AND usuarios_detalles.tabla = 'tbl_lic_formatos' AND formatos.estado = 'A' AND usuarios_detalles.tipo = $tipo");
            $datatable->setOrderby("formatos.codigo");
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
            $formatos = Formatos::findFirstByid_formato((string) $this->request->getPost("id_formato", "string"));

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

    public function getAjaxPermisoFormatosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$obj = UsuariosDetalles::findFirstByid_tabla((int) $this->request->getPost("id", "int"));

            $id_tabla = (int) $this->request->getPost("id", "int");

            $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_formatos' AND id_tabla = {$id_tabla}");

            if ($obj->update == '1') {
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

    ///////////////////////////////////////////////indicadoresevaluacion///////////////////////////////////
    public function indicadoresevaluacionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento.indicadores.evaluacion.js?v=" . uniqid());
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

    public function getAjaxIndicadoresAction() {
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

}
