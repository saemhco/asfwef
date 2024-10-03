<?php

class Mediosverificacion2Controller extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/medios2.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {

        if ($id != null) {
            $Medios = Medios::findFirstByid_medio((int) $id);

            $indicadores = Indicadores::find("estado = 'A'");
            $this->view->indicadores = $indicadores;
        } else {
            $Medios = Medios::findFirstByid_medio(0);
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
    }

    //Funcion guardar
    public function saveAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_medio", "int");
                $Medios = Medios::findFirstByid_medio($id);
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
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->id_medio . '-' . $temporal_rand . '.pdf';
                                            $Medios->archivo = $Medios->id_medio . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->id_medio . '.pdf';
                                            $Medios->archivo = $Medios->id_medio . '.pdf';
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
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->archivo2;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->id_medio . '-' . $temporal_rand . '.xlsx';
                                            $Medios->archivo2 = $Medios->id_medio . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->id_medio . '.xlsx';
                                            $Medios->archivo2 = $Medios->id_medio . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    } elseif ($filex->getExtension() == 'xls') {
                                        if (strlen($Medios->archivo2) > 0) {
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->archivo2;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->id_medio . '-' . $temporal_rand . '.xls';
                                            $Medios->archivo2 = $Medios->id_medio . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/medios/' . $Medios->id_medio . '.xls';
                                            $Medios->archivo2 = $Medios->id_medio . '.xls';
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

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("medios.id_medio_verificacion");
            $datatable->setSelect("medios.id_medio_verificacion,"
                    . "medios.nombre,medios.codigo,"
                    . "medios.descripcion, medios.archivo, medios.archivo2, "
                    . "medios.enlace, medios.proceso, medios.estado, "
                    . "indicadores.id_indicador, indicadores.nombre as nombre_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion medios  INNER JOIN tbl_lic_indicadores indicadores ON medios.indicador = indicadores.id_indicador"
                    . " INNER JOIN tbl_seg_usuarios_detalles usuarios_detalles ON usuarios_detalles.id_tabla = medios.id_medio_verificacion");
            $datatable->setWhere("usuarios_detalles.id_usuario ={$id_usuario} AND usuarios_detalles.tabla = 'tbl_lic_medios_verificacion' AND medios.estado = 'A' AND usuarios_detalles.tipo = 2");
            $datatable->setOrderby("medios.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction() {
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
            $nombre_fichero = 'adminpanel/archivos/medios/' . $archivo_medio;

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
            $Medios = Medios::findFirstByid_medio((string) $this->request->getPost("id", "string"));
            if ($Medios) {
                $url_destino = 'adminpanel/archivos/medios/' . $Medios->archivo;
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
            $Medios = Medios::findFirstByid_medio((string) $this->request->getPost("id", "string"));
            if ($Medios) {
                $url_destino = 'adminpanel/archivos/medios/' . $Medios->archivo2;
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

    public function getAjaxPermisoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_tabla = (int) $this->request->getPost("id", "int");

            //$obj = UsuariosDetalles::findFirstBytabla($tabla);
            $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios' AND id_tabla = {$id_tabla}");

            //print("update:" . $obj->id_usuario_detalle);
            //exit();

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

}
