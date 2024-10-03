<?php

class Licenciamiento1Controller extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    public function mediosverificacion1Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.mediosverificacion1.js?v=" . uniqid());
    }

    //Funcion agregar y editar
    public function registromAction($id = null)
    {

        if ($id != null) {
            $Medios = Medios1::findFirstByid_medio_verificacion1((int) $id);

            $indicadores = Indicadores1::find("estado = 'A'");
            $this->view->indicadores = $indicadores;
        } else {
            $Medios = Medios1::findFirstByid_medio_verificacion1(0);
        }

        $this->view->medios = $Medios;

        //proceso medios de verificacion
        $proceso_medios = ProcesosMedios::find("estado = 'A' AND numero = 80 ");
        $this->view->procesomedios = $proceso_medios;

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
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.mediosverificacion1.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.mediosverificacion1.usuarios.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.mediosverificacion1.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    //Funcion guardar
    public function savemAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_medio_verificacion1", "int");
                $Medios = Medios1::findFirstByid_medio_verificacion1($id);
                //Valida cuando es nuevo
                $Medios = (!$Medios) ? new Medios1() : $Medios;

                //titular
                $Medios->nombre = $this->request->getPost("nombre", "string");

                $Medios->codigo = $this->request->getPost("codigo", "string");

                $Medios->indicador1 = $this->request->getPost("indicador1", "string");

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


                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['imagen']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);



                                    if (in_array($extension, $formatos_imagenes)) {


                                        if (isset($Medios->imagen)) {
                                            $url_destino = 'adminpanel/imagenes/mediosverificacion1/' . $Medios->imagen;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/imagenes/mediosverificacion1/' . 'IMG' . '-' . $Medios->codigo . '-' . $temporal_rand . "." . $extension;
                                            $Medios->imagen = 'IMG' . '-' . $Medios->codigo . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/mediosverificacion1/' . 'IMG' . '-' . $Medios->codigo . '.' . $extension;
                                            $Medios->imagen = 'IMG' . '-' . $Medios->codigo . '.' . $extension;
                                        }


                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            $archivo_pdf = $_FILES['archivo_medios']['name'];
                            if ($archivo_pdf !== '') {
                                if ($file->getKey() == "archivo_medios") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($Medios->archivo)) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->archivo;

                                            if ($Medios->archivo !== "") {

                                                //echo "El fichero se elimina";
                                                //exit();

                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->codigo . '-' . $temporal_rand . '.pdf';
                                            $Medios->archivo = $Medios->codigo . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->codigo . '.pdf';
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
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->archivo2;
                                            if ($Medios->archivo2 !== "") {

                                                //echo "El fichero se elimina";
                                                //exit();

                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->codigo . '-' . $temporal_rand . '.xlsx';
                                            $Medios->archivo2 = $Medios->codigo . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->codigo . '.xlsx';
                                            $Medios->archivo2 = $Medios->codigo . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    } elseif ($filex->getExtension() == 'xls') {
                                        if (strlen($Medios->archivo2) > 0) {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->archivo2;
                                            if ($Medios->archivo2 !== "") {

                                                //echo "El fichero se elimina";
                                                //exit();

                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->codigo . '-' . $temporal_rand . '.xls';
                                            $Medios->archivo2 = $Medios->codigo . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->codigo . '.xls';
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
    public function datatableMediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("medios_verificacion1.id_medio_verificacion1");
            $datatable->setSelect("medios_verificacion1.id_medio_verificacion1,"
                . "medios_verificacion1.nombre,medios_verificacion1.codigo,"
                . "medios_verificacion1.descripcion,"
                . "medios_verificacion1.enlace, medios_verificacion1.estado,"
                . "indicadores1.id_indicador1, indicadores1.nombre as nombre_indicador, indicadores1.codigo AS codigo_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion1 medios_verificacion1
            INNER JOIN tbl_lic_indicadores1 indicadores1 ON medios_verificacion1.indicador1 = indicadores1.id_indicador1");
            $datatable->setWhere("medios_verificacion1.estado = 'A'");
            $datatable->setOrderby("indicadores1.codigo, medios_verificacion1.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Medios = Medios1::findFirstByid_medio_verificacion1((string) $this->request->getPost("id", "string"));
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
    public function getComponentesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $condicion = $this->request->getPost("condicion1");
            $componentes = Componentes1::find('condicion1="' . $condicion . '"');
            $this->response->setJsonContent($componentes->toArray());
            $this->response->send();
        }
    }

    //carga indicador
    public function getIndicadoresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $componente = $this->request->getPost("componente1");
            // echo "<pre>";
            // print_r($componente);
            // exit();
            $indicadores = Indicadores1::find("componente1 = {$componente}");
            $this->response->setJsonContent($indicadores->toArray());
            $this->response->send();
        }
    }

    //carga medios
    public function getMediosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_indicador = $this->request->getPost("id_indicador1");
            //echo "<pre>";
            //print_r($id_componente);
            //exit();
            $medios = Medios1::find('id_indicador1="' . $id_indicador . '"');
            $this->response->setJsonContent($medios->toArray());
            $this->response->send();
        }
    }

    #mediosarchivo
    public function getArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo_medio = $this->request->getPost("archivo_medio");
            $nombre_fichero = 'adminpanel/archivos/mediosverificacion1/' . $archivo_medio;

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
    public function deletepdfmediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo"<pre>";
            // print_r($_POST);
            // exit();

            $Medios = Medios1::findFirstByid_medio_verificacion1((string) $this->request->getPost("id", "string"));
            if ($Medios) {
                $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->archivo;
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
    public function deleteexcelmediosverificacion1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Medios = Medios1::findFirstByid_medio_verificacion1((string) $this->request->getPost("id", "string"));
            if ($Medios) {
                $url_destino = 'adminpanel/archivos/mediosverificacion1/' . $Medios->archivo2;
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
    public function saveUsuariosDetallesAction()
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
                $UsuariosDetalles->tabla = "tbl_lic_medios_verificacion1";
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
    public function getAjaxUsuariosDetallesAction()
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

    //Eliminar Usuarios Detalles
    public function eliminarUsuariosDetallesAction()
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

    public function datatableUsuariosDetallesAction($id)
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
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_lic_medios_verificacion1' AND tipo = 3");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxValidarUsuarioAction()
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

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion1' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");
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

    public function savePersonalGrupoAction()
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

                $UsuariosDetalles = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion1' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 3");

                //print($UsuariosDetalles->id_usuario);
                //exit();

                if (isset($UsuariosDetalles->id_usuario)) {
                } else {
                    $NuevoUsuariosDetalles = new UsuariosDetalles();
                    $NuevoUsuariosDetalles->id_usuario = $id_usuario;
                    $NuevoUsuariosDetalles->tabla = 'tbl_lic_medios_verificacion1';
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
    public function saveUsuariosDetallesDocenteAction()
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
                $UsuariosDetalles->tabla = "tbl_lic_medios_verificacion1";
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

    public function getAjaxUsuariosDetallesDocenteAction()
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

    public function eliminarUsuariosDetallesDocenteAction()
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

    public function datatableUsuariosDetallesDocenteAction($id)
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
            $datatable->setWhere("id_tabla = $id AND tabla = 'tbl_lic_medios_verificacion1' AND tipo = 2");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxValidarUsuarioDocenteAction()
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

                $obj = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion1' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 2");
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

    public function savePersonalGrupoDocenteAction()
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

                $UsuariosDetalles = UsuariosDetalles::findFirst("tabla = 'tbl_lic_medios_verificacion1' AND id_usuario = {$id_usuario} AND id_tabla = {$id_tabla} AND tipo = 2");

                //print($UsuariosDetalles->id_usuario);
                //exit();

                if (isset($UsuariosDetalles->id_usuario)) {
                } else {
                    $NuevoUsuariosDetalles = new UsuariosDetalles();
                    $NuevoUsuariosDetalles->id_usuario = $id_usuario;
                    $NuevoUsuariosDetalles->tabla = 'tbl_lic_medios_verificacion1';
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
    //-----------------------------------------formatos-------------------------------------------------------
    public function formatos1Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.formatos1.js?v=" . uniqid());
    }

    //Funcion agregar y editar
    public function registrofAction($id = null)
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

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.formatos1.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.formatos1.usuarios.detalles.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.formatos1.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    //Funcion guardar
    public function savefAction()
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
                $Formatos->tipo = 1;

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

                                        if (isset($Formatos->imagen)) {

                                            //echo '<pre>';
                                            //print_r("edit:");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo;

                                            if ($Formatos->archivo !== "") {

                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->codigo . '-' . $temporal_rand . '.pdf';
                                            $Formatos->archivo = $Formatos->codigo . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("new");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->codigo . '.pdf';
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

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo2;

                                            if ($Formatos->archivo2 !== "") {
                                                unlink($url_destino);
                                            }


                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->codigo . '-' . $temporal_rand . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->codigo . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->codigo . '.xlsx';
                                            $Formatos->archivo2 = $Formatos->codigo . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    } elseif ($filex->getExtension() == 'xls') {

                                        if (strlen($Formatos->archivo2) > 0) {

                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo2;

                                            if ($Medios->archivo2 !== "") {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->codigo . '-' . $temporal_rand . '.xls';
                                            $Formatos->archivo2 = $Formatos->codigo . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->codigo . '.xls';
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
    public function datatableFormatosAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_formato");
            $datatable->setSelect("id_formato, codigo, nombre, descripcion, archivo, enlace, estado, archivo2");
            $datatable->setFrom("tbl_lic_formatos");
            $datatable->setWhere("estado = 'A' AND tipo=1");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarfAction()
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

    //delete pdf
    public function deletepdffAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Formatos = Formatos::findFirstByid_formato((string) $this->request->getPost("id", "string"));
            if ($Formatos) {
                $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo;
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
    public function deleteexcelfAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Formatos = Formatos::findFirstByid_formato((string) $this->request->getPost("id", "string"));
            if ($Formatos) {
                $url_destino = 'adminpanel/archivos/formatos1/' . $Formatos->archivo2;
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
    public function codigoRegistradofAction()
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

    #-----------------------------personal-----------------------------------------

    public function saveUsuariosDetallesfAction()
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

    //Editar Usuarios Detalles
    public function getAjaxUsuariosDetallesfAction()
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

    //Eliminar Usuarios Detalles
    public function eliminarUsuariosDetallesfAction()
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

    public function datatableUsuariosDetallesfAction($id)
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

    public function getAjaxValidarUsuariofAction()
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

    public function savePersonalGrupofAction()
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

    #------------------------------docente--------------------------------------

    public function saveUsuariosDetallesDocentefAction()
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

    public function getAjaxUsuariosDetallesDocentefAction()
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

    public function eliminarUsuariosDetallesDocentefAction()
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

    public function datatableUsuariosDetallesDocentefAction($id)
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

    public function getAjaxValidarUsuarioDocentefAction()
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

    public function savePersonalGrupoDocentefAction()
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

    public function codigoRegistradoMediosverificacion1Action()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $medios = Medios1::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

            if ($medios) {
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

    //////////////////////////////////////////condiciones1///////////////////////////////////////////////////////
    public function condiciones1Action()
    {

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.condiciones1.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableCondiciones1Action()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_condicion1");
            $datatable->setSelect("id_condicion1, codigo, nombre, descripcion, enlace, numero, avance, estado, nro_act_fin, nro_act_total");
            $datatable->setFrom("tbl_lic_condiciones1");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroCondiciones1Action($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $condiciones = Condiciones1::findFirstByid_condicion1((int) $id);
        } else {

            $condiciones = Condiciones1::findFirstByid_condicion1(0);
        }

        $this->view->condiciones = $condiciones;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.condiciones1.js?v=" . uniqid());
    }

    public function saveCondiciones1Action()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_condicion1", "int");
                $condiciones = Condiciones1::findFirstByid_condicion1($id);

                $condiciones = (!$condiciones) ? new Condiciones1() : $condiciones;

                $condiciones->codigo = $this->request->getPost("codigo", "string");

                $condiciones->nombre = $this->request->getPost("nombre", "string");

                $condiciones->descripcion = $this->request->getPost("descripcion", "string");

                $condiciones->enlace = $this->request->getPost("enlace", "string");

                $condiciones->numero = $this->request->getPost("numero", "string");

                $condiciones->avance = $this->request->getPost("avance", "string");

                $condiciones->nro_act_fin = $this->request->getPost("nro_act_fin", "string");

                $condiciones->nro_act_total = $this->request->getPost("nro_act_total", "string");

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

    public function codigoRegistradoCondiciones1Action()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $condiciones = Condiciones1::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

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
    public function componentes1Action()
    {
        $condiciones = Condiciones1::find("estado = 'A' ORDER BY id_condicion1");
        $this->view->condiciones = $condiciones;

        $condicionesSelected = Condiciones1::findFirst("estado = 'A' AND id_condicion1 = 1");
        $this->view->condicionesSelected = $condicionesSelected;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.componentes1.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableComponentes1Action($condicionSelect = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            if ($condicionSelect != 0) {
                $where = "AND condicion1 = '{$condicionSelect}'";
            } else {
                $where = "AND condicion1 = 1";
            }

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_componente1");
            $datatable->setSelect("id_componente1, condicion1, codigo, nombre, descripcion, finalidad, enlace, estado");
            $datatable->setFrom("tbl_lic_componentes1");
            $datatable->setWhere("estado = 'A' $where");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroComponentes1Action($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $componentes = Componentes1::findFirstByid_componente1((int) $id);
        } else {
            $componentes = Componentes1::findFirstByid_componente1(0);
        }

        $this->view->componentes = $componentes;

        //select condicion1
        $condiciones = Condiciones1::find("estado = 'A'");
        $this->view->condiciones = $condiciones;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.componentes1.js?v=" . uniqid());
    }

    public function saveComponentes1Action()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_componente1", "int");
                $compotente = Componentes1::findFirstByid_componente1($id);

                $compotente = (!$compotente) ? new Componentes1() : $compotente;

                $compotente->condicion1 = $this->request->getPost("condicion1", "string");

                $compotente->codigo = $this->request->getPost("codigo", "string");

                $compotente->nombre = $this->request->getPost("nombre", "string");

                $compotente->descripcion = $this->request->getPost("descripcion", "string");

                $compotente->finalidad = $this->request->getPost("finalidad", "string");

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

    public function codigoRegistradoComponentes1Action()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $componentes = Componentes1::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

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

    ///////////////////////////////////////////////indicadores1///////////////////////////////////////////////////////
    public function indicadores1Action()
    {
        $condiciones = Condiciones1::find("estado = 'A' ORDER BY id_condicion1");
        $this->view->condiciones = $condiciones;

        $condicionesSelected = Condiciones1::findFirst("estado = 'A' AND id_condicion1 = 1");
        $this->view->condicionesSelected = $condicionesSelected;

        $componentes = Componentes1::find("estado = 'A' ORDER BY id_componente1");
        $this->view->componentes = $componentes;

        $componentesSelected = Componentes1::findFirst("estado = 'A' AND id_componente1 = 1");
        $this->view->componentesSelected = $componentesSelected;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.indicadores1.js?v=" . uniqid());
    }

    //carga componentes
    public function getComponentes1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $condicion = $this->request->getPost("pk");
            $componentes = Componentes1::find("condicion1= $condicion");

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
    public function datatableIndicadores1Action($componenteSelect = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            if ($componenteSelect != 0) {
                $where = "AND componente1 = '{$componenteSelect}'";
            } else {
                $where = "AND componente1 = 0";
            }

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_indicador1");
            $datatable->setSelect("id_indicador1, componente1, codigo, nombre, descripcion, enlace, estado");
            $datatable->setFrom("tbl_lic_indicadores1");
            $datatable->setWhere("estado = 'A' $where");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroIndicadores1Action($id = null, $condicionSelected = null, $componenteSelected = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $indicadores = Indicadores1::findFirstByid_indicador1((int) $id);
        } else {
            $indicadores = Indicadores1::findFirstByid_indicador1(0);
        }

        $this->view->indicadores = $indicadores;

        $condiciones = Condiciones1::find("estado = 'A'");
        $this->view->condiciones = $condiciones;
        $this->view->condicionSelected = $condicionSelected;

        $componentes = Componentes1::find("estado = 'A'");
        $this->view->componentes = $componentes;
        $this->view->componenteSelected = $componenteSelected;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.indicadores1.js?v=" . uniqid());
    }

    public function saveIndicadores1Action()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_indicador1", "int");
                $indicadores = Indicadores1::findFirstByid_indicador1($id);

                $indicadores = (!$indicadores) ? new Indicadores1() : $indicadores;

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

    public function codigoRegistradoIndicadores1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $indicadores = Indicadores1::findFirstBycodigo((string) $this->request->getPost("codigo", "string"));

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

    ///////////////////////////////////////////////requisitos1///////////////////////////////////////////////////////
    public function requisitos1Action($medio_verificacion)
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.requisitos1.js?v=" . uniqid());
        $Medios = Medios1::findFirstByid_medio_verificacion1((int) $medio_verificacion);

        // print($Medios->nombre);
        // exit();

        $this->view->medio_verificacion = $Medios;
    }

    public function datatableRequisitos1Action($medio_verificacion = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_requisito1");
            $datatable->setSelect("requisitos1.id_requisito1,
            requisitos1.id_medio_verificacion1,
            requisitos1.codigo,
            requisitos1.nombre,
            requisitos1.descripcion,
            requisitos1.imagen,
            requisitos1.archivo,
            requisitos1.archivo2,
            requisitos1.enlace,
            requisitos1.proceso,
            requisitos1.visible,
            requisitos1.estado,
            procesos.nombres AS proceso,
            resoluciones.archivo AS archivo_resolucion");
            $datatable->setFrom("public.tbl_lic_requisitos1 requisitos1 INNER JOIN a_codigos procesos ON procesos.codigo = requisitos1.proceso
            LEFT JOIN tbl_web_resoluciones resoluciones ON resoluciones.id_resolucion = requisitos1.id_resolucion");
            $datatable->setWhere("requisitos1.id_medio_verificacion1 = $medio_verificacion AND procesos.numero = 80");
            $datatable->setOrderby("id_requisito1");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroRequisitos1Action($id = null, $id_medio_verificacion1 = null)
    {
        $this->view->id = $id;
        if ($id != null and $id != 0) {
            $requisitos = Requisitos1::findFirstByid_requisito1((int) $id);

            $mediosverificacion = Medios1::findFirstByid_medio_verificacion1((int) $requisitos->id_medio_verificacion1);
            $this->view->mediosverificacion = $mediosverificacion;
        } else {
            $requisitos = Requisitos1::findFirstByid_requisito1(0);
            $mediosverificacion = Medios1::findFirstByid_medio_verificacion1((int) $id_medio_verificacion1);
            $this->view->mediosverificacion = $mediosverificacion;
        }

        $this->view->requisitos = $requisitos;


        $proceso_medios = ProcesosMedios::find("estado = 'A' AND numero = 80 ");
        $this->view->procesomedios = $proceso_medios;

        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.requisitos1.js?v=" . uniqid());

        $docentes = Docentes::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->docentes = $docentes;

        $personal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->personal = $personal;

        $resoluciones = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'id_resolucion ASC',
            ]
        );
        $this->view->resoluciones = $resoluciones;
    }

    public function saveRequisitos1Action()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_requisito1", "int");
                $Requisitos = Requisitos1::findFirstByid_requisito1($id);

                $Requisitos = (!$Requisitos) ? new Requisitos1() : $Requisitos;

                $Requisitos->id_medio_verificacion1 = $this->request->getPost("id_medio_verificacion1", "int");

                $Requisitos->codigo = $this->request->getPost("codigo", "string");

                $Requisitos->nombre = $this->request->getPost("nombre", "string");

                $Requisitos->descripcion = $this->request->getPost("descripcion", "string");

                $Requisitos->enlace = $this->request->getPost("enlace", "string");

                if ($this->request->getPost("proceso", "int") == "") {
                    $Requisitos->proceso = null;
                } else {
                    $Requisitos->proceso = $this->request->getPost("proceso", "int");
                }

                $visible = $this->request->getPost("visible", "int");
                if (isset($visible)) {
                    $Requisitos->visible = 1;
                } else {
                    $Requisitos->visible = 0;
                }

                $control = $this->request->getPost("control", "string");
                if (isset($control)) {
                    $Requisitos->control = "1";
                } else {
                    $Requisitos->control = "0";
                }


                $Requisitos->estado = "A";

                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $Requisitos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $Requisitos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }




                if ($this->request->getPost("responsable_docente", "int") == "") {
                    $Requisitos->responsable_docente = null;
                } else {
                    $Requisitos->responsable_docente = $this->request->getPost("responsable_docente", "int");
                }


                if ($this->request->getPost("responsable_administrativo", "int") == "") {
                    $Requisitos->responsable_administrativo = null;
                } else {
                    $Requisitos->responsable_administrativo = $this->request->getPost("responsable_administrativo", "int");
                }

                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $Requisitos->id_resolucion = null;
                } else {
                    $Requisitos->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }


                if ($Requisitos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Requisitos->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            //archivo
                            $temporal_rand = mt_rand(100000, 999999);

                            $archivo_pdf = $_FILES['archivo_requisitos1']['name'];
                            if ($archivo_pdf !== '') {
                                if ($file->getKey() == "archivo_requisitos1") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($Requisitos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->archivo;
                                            if ($Requisitos->archivo !== "") {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->codigo . '-' . $temporal_rand . '.pdf';
                                            $Requisitos->archivo = $Requisitos->codigo . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->codigo . '.pdf';
                                            $Requisitos->archivo = $Requisitos->codigo . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }

                            //archivo2
                            $archivo_excel = $_FILES['archivo2_requisitos1']['name'];
                            if ($archivo_excel !== '') {
                                if ($file->getKey() == "archivo2_requisitos1") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'xlsx') {
                                        if (isset($Requisitos->archivo2)) {
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->archivo2;
                                            if ($Requisitos->archivo2 !== "") {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->codigo . '-' . $temporal_rand . '.xlsx';
                                            $Requisitos->archivo2 = $Requisitos->codigo . '-' . $temporal_rand . '.xlsx';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->codigo . '.xlsx';
                                            $Requisitos->archivo2 = $Requisitos->codigo . '.xlsx';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    } elseif ($filex->getExtension() == 'xls') {
                                        if (strlen($Requisitos->archivo2) > 0) {
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->archivo2;
                                            if ($Requisitos->archivo2 !== "") {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->codigo . '-' . $temporal_rand . '.xls';
                                            $Requisitos->archivo2 = $Requisitos->codigo . '-' . $temporal_rand . '.xls';
                                        } else {
                                            $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos->codigo . '.xls';
                                            $Requisitos->archivo2 = $Requisitos->codigo . '.xls';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            }
                        }

                        $Requisitos->save();

                        //update tbl_lic_condiciones1
                        $vcondicion1Finalizado = VCondicion1Finalizado::find();
                       
                        foreach ($vcondicion1Finalizado as $value) {


                            $condiciones1 = Condiciones1::findFirst(
                                [
                                    "id_condicion1 = $value->id_condicion1",
                                ]
                            );

                            $vcondicion1Total = VCondicion1Total::findFirst("id_condicion1 = $value->id_condicion1");

                            $avance = ($value->nro * 100) / $vcondicion1Total->nro;
                            //echo "<pre>";
                            //print_r(round($avance));
                            $condiciones1->avance = round($avance);
                            $condiciones1->nro_act_fin = $value->nro;
                            $condiciones1->nro_act_total = $vcondicion1Total->nro;
                            $condiciones1->save();
                        }
                        //exit();
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

    //delete pdf
    public function deletepdfRequisitos1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Requisitos1 = Requisitos1::findFirstByid_requisito1((string) $this->request->getPost("id", "string"));
            if ($Requisitos1) {
                $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos1->archivo;
                unlink($url_destino);
                $Requisitos1->archivo = '';
                $Requisitos1->save();
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
    public function deleteexcelRequisitos1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Requisitos1s = Requisitos1::findFirstByid_requisito1((string) $this->request->getPost("id", "string"));
            if ($Requisitos1) {
                $url_destino = 'adminpanel/archivos/requisitos1/' . $Requisitos1->archivo2;
                unlink($url_destino);
                $Requisitos1->archivo2 = '';
                $Requisitos1->save();
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

    //Eliminar
    public function eliminarRequisitos1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Requisitos1 = Requisitos1::findFirstByid_requisito1((string) $this->request->getPost("id", "string"));
            if ($Requisitos1 && $Requisitos1->estado = 'A') {
                $Requisitos1->estado = 'X';
                $Requisitos1->save();
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


    public function mediosverificacionsunedu1Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.mediosverificacionsunedu1.js?v=" . uniqid());
    }

    public function datatableMediosverificacionsunedu1Action()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("medios_verificacion1.id_medio_verificacion1");
            $datatable->setSelect("medios_verificacion1.id_medio_verificacion1,"
                . "medios_verificacion1.nombre,medios_verificacion1.codigo,"
                . "medios_verificacion1.descripcion,"
                . "medios_verificacion1.enlace, medios_verificacion1.estado,"
                . "indicadores1.id_indicador1, indicadores1.nombre as nombre_indicador, indicadores1.codigo AS codigo_indicador");
            $datatable->setFrom("tbl_lic_medios_verificacion1 medios_verificacion1
            INNER JOIN tbl_lic_indicadores1 indicadores1 ON medios_verificacion1.indicador1 = indicadores1.id_indicador1");
            $datatable->setWhere("medios_verificacion1.estado = 'A'");
            $datatable->setOrderby("indicadores1.codigo, medios_verificacion1.codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function formatossunedu1Action()
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.formatossunedu1.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableFormatossunedu1Action()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_formato");
            $datatable->setSelect("id_formato, codigo, nombre, descripcion, archivo, enlace, estado, archivo2");
            $datatable->setFrom("tbl_lic_formatos");
            $datatable->setWhere("estado = 'A' AND tipo=1");
            $datatable->setOrderby("codigo");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function requisitossunedu1Action($medio_verificacion)
    {
        $this->assets->addJs("adminpanel/js/modulos/licenciamiento1.requisitos1.js?v=" . uniqid());
        $Medios = Medios1::findFirstByid_medio_verificacion1((int) $medio_verificacion);

        // print($Medios->nombre);
        // exit();

        $this->view->medio_verificacion = $Medios;
    }
}
