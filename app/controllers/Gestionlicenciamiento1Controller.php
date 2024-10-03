<?php

class Gestionlicenciamiento1Controller extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

    }

    public function indexAction()
    {

    }

    ////////////////////////////////////////////////////////mediosverificacion1////////////////////////////////////////////////

    public function mediosverificacion1Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento1.mediosverificacion1.js?v=" . uniqid());

    }

    public function registromediosverificacion1Action($id = null)
    {

        if ($id != null) {
            $Medios = Medios1::findFirstByid_medio_verificacion((int) $id);

            $indicadores = Indicadores1::find("estado = 'A'");
            $this->view->indicadores = $indicadores;
        } else {
            $Medios = Medios1::findFirstByid_medio_verificacion(0);
        }

        $this->view->medios = $Medios;

        //select condicion
        $condiciones = Condiciones1::find("estado = 'A'");
        $this->view->condiciones = $condiciones;

        $Pesonal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->personal = $Pesonal;

        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento1.mediosverificacion1.js?v=" . uniqid());
    }

    public function saveMediosverificacion1Action()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_medio_verificacion", "int");
                $Medios = Medios1::findFirstByid_medio_verificacion($id);
                //Valida cuando es nuevo
                $Medios = (!$Medios) ? new Medios1() : $Medios;

                //titular
                $Medios->nombre = $this->request->getPost("nombre", "string");

                $Medios->codigo = $this->request->getPost("codigo", "string");

                $Medios->indicador = $this->request->getPost("indicador", "string");

                //Objeto
                $Medios->descripcion = $this->request->getPost("descripcion", "string");

                //suscriptores
                $Medios->enlace = $this->request->getPost("enlace", "string");

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

    public function datatableMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];
            $tipo = $auth["tipo"];

    // echo"<pre>";
    // print_r($auth);
    // exit();

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("mediosverificacion1.id_medio_verificacion1");
            $datatable->setSelect("mediosverificacion1.id_medio_verificacion1,"
                . "mediosverificacion1.nombre,mediosverificacion1.codigo,"
                . "mediosverificacion1.descripcion,"
                . "mediosverificacion1.enlace,mediosverificacion1.estado, "
                . "indicadores1.id_indicador1, indicadores1.nombre as nombre_indicador, indicadores1.codigo AS codigo_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion1 mediosverificacion1  INNER JOIN tbl_lic_indicadores1 indicadores1 ON mediosverificacion1.indicador1 = indicadores1.id_indicador1"
                . " INNER JOIN tbl_seg_usuarios_detalles usuarios_detalles ON usuarios_detalles.id_tabla = mediosverificacion1.id_medio_verificacion1");
            $datatable->setWhere("usuarios_detalles.id_usuario ={$id_usuario} AND usuarios_detalles.tabla = 'tbl_lic_medios_verificacion1' AND mediosverificacion1.estado = 'A' AND usuarios_detalles.tipo = $tipo");
            $datatable->setOrderby("mediosverificacion1.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function eliminarMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Medios = Medios1::findFirstByid_medio1((string) $this->request->getPost("id", "string"));
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

    public function getComponentesMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $condicion = $this->request->getPost("condicion");
            $componentes = Componentes1::find('condicion1="' . $condicion . '"');
            $this->response->setJsonContent($componentes->toArray());
            $this->response->send();
        }
    }

    public function getIndicadoresMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $componente = $this->request->getPost("componente");
            //echo "<pre>";
            //print_r($componente);
            //exit();
            $indicadores = Indicadores1::find("componente1 = {$componente}");
            $this->response->setJsonContent($indicadores->toArray());
            $this->response->send();
        }
    }

    public function getMediosMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_indicador = $this->request->getPost("id_indicador");
            //echo "<pre>";
            //print_r($id_componente);
            //exit();
            $medios = Medios1::find('id_indicador1="' . $id_indicador . '"');
            $this->response->setJsonContent($medios->toArray());
            $this->response->send();
        }
    }

    public function getAjaxPermisoMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_tabla = (int) $this->request->getPost("id", "int");

            //$obj = UsuariosDetalles::findFirstBytabla($tabla);
            $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion1' AND id_tabla = {$id_tabla}");

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

    ////////////////////////////////////////////////////////formatos1////////////////////////////////////////////////
    public function formatos1Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento1.formatos1.js?v=" . uniqid());
    }

    public function registroFormatos1Action($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $formatos = Formatos::findFirstByid_formato((int) $id);
        } else {

            $formatos = Formatos::findFirstByid_formato(0);
        }

        $this->view->formatos = $formatos;

        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento1.formatos1.js?v=" . uniqid());
    }

    public function saveFormatos1Action()
    {

        //echo "<pre>";
        //print_r($_POST);
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
                                    //$url_destino = 'adminpanel/archivos/formatos1/' . 'FILE' . '-' . $Formatos->id_formato . '.pdf';
                                    //$url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '.xlsx';
                                    //$Formatos->archivo = $Formatos->id_formato . '.xlsx';

                                    if ($filex->getExtension() == 'pdf') {

                                        if (strlen($Formatos->archivo) > 0) {

                                            //echo '<pre>';
                                            //print_r("edit:");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '-' . $temporal_rand . '.pdf';
                                            $Formatos->archivo = $Formatos->id_formato . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("new");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '.pdf';
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

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo2;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '-' . $temporal_rand . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->id_formato . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->id_formato . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    } elseif ($filex->getExtension() == 'xls') {

                                        if (strlen($Formatos->archivo2) > 0) {

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo2;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '-' . $temporal_rand . '.xls';
                                            $Formatos->archivo2 = $Formatos->id_formato . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->id_formato . '.xls';
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

    public function datatableFormatos1Action()
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

    public function eliminarFormatos1Action()
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

    public function deletepdfFormatos1Action()
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

    public function deleteexcelFormatos1Action()
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

    public function codigoRegistradoFormatos1Action()
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

    public function getAjaxPermisoFormatos1Action()
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

    ///////////////////////////////////////////////requisitos1///////////////////////////////////////////////////////
    public function requisitos1Action($medio_verificacion)
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionlicenciamiento1.requisitos1.js?v=" . uniqid());
        $Medios = Medios1::findFirstByid_medio_verificacion1((int) $medio_verificacion);
        $this->view->medio_verificacion = $Medios;

    }

    public function datatableRequisitos1Action($medio_verificacion = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_requisito1");
            $datatable->setSelect("public.tbl_lic_requisitos1.id_requisito1,
            public.tbl_lic_requisitos1.medio_verificacion1,
            public.tbl_lic_requisitos1.codigo,
            public.tbl_lic_requisitos1.nombre,
            public.tbl_lic_requisitos1.descripcion,
            public.tbl_lic_requisitos1.imagen,
            public.tbl_lic_requisitos1.archivo,
            public.tbl_lic_requisitos1.archivo2,
            public.tbl_lic_requisitos1.enlace,
            public.tbl_lic_requisitos1.proceso,
            public.tbl_lic_requisitos1.visible,
            public.tbl_lic_requisitos1.estado");
            $datatable->setFrom("public.tbl_lic_requisitos1");
            $datatable->setWhere("public.tbl_lic_requisitos1.estado = 'A' AND  public.tbl_lic_requisitos1.medio_verificacion1 = $medio_verificacion");
            $datatable->setOrderby("id_requisito1");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
