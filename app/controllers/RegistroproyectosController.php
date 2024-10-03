<?php

class RegistroproyectosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('Mantenimiento de Proyectos');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroproyectos.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    //Funcion agregar y editar
    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $proyectos = Proyectos::findFirstByid_proyecto((int) $id);
        }
        $this->view->proyectos = $proyectos;

        $personal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->personal = $personal;


        $Docentes = Docentes::find(
            [
                "estado = 'A'",
                'order' => 'apellidop ASC',
            ]
        );
        $this->view->docentes = $Docentes;

        $this->assets->addJs("adminpanel/js/modulos/registroproyectos.usuarios.detalles.personal.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroproyectos.usuarios.detalles.docentes.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction()
    {

//        echo "<pre>";
        //        print_r($_POST);
        //        exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_proyecto", "int");
                $proyectos = Proyectos::findFirstByid_proyecto($id);
                $proyectos = (!$proyectos) ? new Proyectos() : $proyectos;
                $proyectos->investigador = $this->request->getPost("investigador", "string");
                $proyectos->titulo = $this->request->getPost("titulo", "string");
                $proyectos->lineas = $this->request->getPost("lineas", "string");
                $proyectos->tipo = $this->request->getPost("tipo", "string");
                $proyectos->objetivo = $this->request->getPost("objetivo", "string");
                $proyectos->objetivos = $this->request->getPost("objetivos", "string");
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $proyectos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }
                if ($this->request->getPost("fecha_termino", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_termino", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $proyectos->fecha_termino = date('Y-m-d', strtotime($fecha_new));
                }
                $proyectos->vigencia = $this->request->getPost("vigencia", "string");
                $proyectos->presupuesto = $this->request->getPost("presupuesto", "string");
                $proyectos->entidad_cooperante = $this->request->getPost("entidad_cooperante", "string");
                $proyectos->compromiso_cooperante = $this->request->getPost("compromiso_cooperante", "string");
                $proyectos->local_proyecto = $this->request->getPost("local_proyecto", "string");
                $proyectos->archivo = $this->request->getPost("archivo", "string");
                $proyectos->imagen = $this->request->getPost("imagen", "string");
                $proyectos->enlace = $this->request->getPost("enlace", "string");
                $proyectos->estado = "A";

                if ($proyectos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($proyectos->getMessages());
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

                                    if (isset($proyectos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/proyectos/' . $proyectos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/proyectos/' . 'IMG' . '-' . $proyectos->id_proyecto . '-' . $temporal_rand . '.jpg';
                                        $proyectos->imagen = 'IMG' . '-' . $proyectos->id_proyecto . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/proyectos/' . 'IMG' . '-' . $proyectos->id_proyecto . '.jpg';
                                        $proyectos->imagen = 'IMG' . '-' . $proyectos->id_proyecto . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($proyectos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/proyectos/' . $proyectos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/proyectos/' . 'IMG' . '-' . $proyectos->id_proyecto . '-' . $temporal_rand . '.png';
                                        $proyectos->imagen = 'IMG' . '-' . $proyectos->id_proyecto . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/proyectos/' . 'IMG' . '-' . $proyectos->id_proyecto . '.png';
                                        $proyectos->imagen = 'IMG' . '-' . $proyectos->id_proyecto . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo_boletin") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {

                                    if ($proyectos->archivo != '') {
                                        $url_destino = 'adminpanel/archivos/proyectos/' . $proyectos->archivo;
                                        //print $url_destino;exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }


                                        $url_destino = 'adminpanel/archivos/proyectos/' . 'FILE' . '-' . $proyectos->id_proyecto . '-' . $temporal_rand . '.pdf';
                                        $proyectos->archivo = 'FILE' . '-' . $proyectos->id_proyecto . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/proyectos/' . 'FILE' . '-' . $proyectos->id_proyecto . '.pdf';
                                        $proyectos->archivo = 'FILE' . '-' . $proyectos->id_proyecto . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $proyectos->save();
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
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_proyecto");
            $datatable->setSelect("id_proyecto,titulo,fecha_inicio,fecha_termino,entidad_cooperante,estado");
            $datatable->setFrom("tbl_inv_proyectos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_proyecto ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $proyectos = Proyectos::findFirstByid_proyecto((int) $this->request->getPost("id_proyecto", "int"));
            if ($proyectos && $proyectos->estado = 'A') {
                $proyectos->estado = 'X';
                $proyectos->save();
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

    //datatable personal
    public function datatablePersonalAction($id)
    {
        //print($id);
        //exit();
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_proyecto_investigador");
            $datatable->setSelect("id_proyecto_investigador, id_proyecto, tipo, codigo, estado, apellidos_nombres");
            $datatable->setFrom("(SELECT
            tbl_inv_proyectos_investigadores.id_proyecto_investigador,
            tbl_inv_proyectos_investigadores.id_proyecto,
            tbl_inv_proyectos_investigadores.tipo,
            tbl_inv_proyectos_investigadores.codigo,
            tbl_inv_proyectos_investigadores.estado,
            CONCAT (tbl_web_personal.apellidop, ' ', tbl_web_personal.apellidom, ' ', tbl_web_personal.nombres ) AS apellidos_nombres
            FROM
            tbl_inv_proyectos_investigadores
            INNER JOIN tbl_web_personal ON tbl_web_personal.codigo = tbl_inv_proyectos_investigadores.codigo) AS temporal_table");
            $datatable->setWhere("id_proyecto = $id AND tipo = 3");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //datatable docente
    public function datatableDocenteAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_proyecto_investigador");
            $datatable->setSelect("id_proyecto_investigador, id_proyecto, tipo, codigo, estado, apellidos_nombres");
            $datatable->setFrom("(SELECT
            tbl_inv_proyectos_investigadores.id_proyecto_investigador,
            tbl_inv_proyectos_investigadores.id_proyecto,
            tbl_inv_proyectos_investigadores.tipo,
            tbl_inv_proyectos_investigadores.codigo,
            tbl_inv_proyectos_investigadores.estado,
            CONCAT (docentes.apellidop, ' ', docentes.apellidom, ' ', docentes.nombres ) AS apellidos_nombres
            FROM
            tbl_inv_proyectos_investigadores
            INNER JOIN docentes ON docentes.codigo = tbl_inv_proyectos_investigadores.codigo) AS temporal_table");
            $datatable->setWhere("id_proyecto = $id AND tipo = 2");
            $datatable->setOrderby("apellidos_nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //save personal
    public function saveUsuarioDetallePersonalAction()
    {

        //    echo "<pre>";
        //    print_r($_POST);
        //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_proyecto_investigador_personal", "int");
                $proyectosInvestigadores = ProyectosInvestigadores::findFirstByid_proyecto_investigador($id);
                $proyectosInvestigadores = (!$proyectosInvestigadores) ? new ProyectosInvestigadores() : $proyectosInvestigadores;

                $proyectosInvestigadores->id_proyecto = $this->request->getPost("id_proyecto", "int");
                $proyectosInvestigadores->tipo = 3;
                $proyectosInvestigadores->codigo = $this->request->getPost("codigo", "int");
                $proyectosInvestigadores->estado = "A";

                if ($proyectosInvestigadores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($proyectosInvestigadores->getMessages());
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


    public function getAjaxValidarUsuarioPersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo "<pre>";
            //print_r($_POST);
            //exit();
            

            $id_usuario = (int) $this->request->getPost("id_usuario", "int");
            $id_usuario_oculto = (int) $this->request->getPost("id_usuario_oculto", "int");
            $id_tabla = (int) $this->request->getPost("id_tabla", "int");

            if ($id_usuario == $id_usuario_oculto) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $obj = ProyectosInvestigadores::findFirst("codigo = {$id_usuario} AND id_proyecto = {$id_tabla} AND tipo = 3");
                
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

    public function getAjaxUsuarioDetallePersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $obj = ProyectosInvestigadores::findFirstByid_proyecto_investigador((int) $this->request->getPost("id", "int"));
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

    public function eliminarUsuarioDetallePersonalAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {


            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_usuario_detalle_personal = (int) $this->request->getPost("id", "int");
            $proyectosInvestigadores = ProyectosInvestigadores::findFirstByid_proyecto_investigador($id_usuario_detalle_personal);
            
            // print($proyectosInvestigadores->id_proyecto_investigador);
            // exit();

            if ($proyectosInvestigadores && $proyectosInvestigadores->estado = 'A') {
                //$UsuariosDetalles->estado = 'X';
                //$UsuariosDetalles->save();
                $this->db->delete("tbl_inv_proyectos_investigadores", "id_proyecto_investigador = {$proyectosInvestigadores->id_proyecto_investigador}");
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

    //save docente
    public function saveUsuarioDetalleDocenteAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_proyecto_investigador_docente", "int");
                $proyectosInvestigadores = ProyectosInvestigadores::findFirstByid_proyecto_investigador($id);
                $proyectosInvestigadores = (!$proyectosInvestigadores) ? new ProyectosInvestigadores() : $proyectosInvestigadores;

                $proyectosInvestigadores->id_proyecto = $this->request->getPost("id_proyecto", "int");
                $proyectosInvestigadores->tipo = 2;
                $proyectosInvestigadores->codigo = $this->request->getPost("codigo", "int");
                $proyectosInvestigadores->estado = "A";

                if ($proyectosInvestigadores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($proyectosInvestigadores->getMessages());
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

    //usuario detalle docente
    public function getAjaxUsuarioDetalleDocenteAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ProyectosInvestigadores::findFirstByid_proyecto_investigador((int) $this->request->getPost("id", "int"));
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

    public function getAjaxValidarUsuarioDocenteAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo "<pre>";
            //print_r($_POST);
            //exit();
            

            $id_usuario = (int) $this->request->getPost("id_usuario", "int");
            $id_usuario_oculto = (int) $this->request->getPost("id_usuario_oculto_docente", "int");
            $id_tabla = (int) $this->request->getPost("id_tabla", "int");

            if ($id_usuario == $id_usuario_oculto) {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "editar"));
                $this->response->send();
            } else {

                $obj = ProyectosInvestigadores::findFirst("codigo = {$id_usuario} AND id_proyecto = {$id_tabla} AND tipo = 2");
                
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

    public function eliminarUsuarioDetalleDocenteAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {


            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_usuario_detalle_personal = (int) $this->request->getPost("id", "int");
            $proyectosInvestigadores = ProyectosInvestigadores::findFirstByid_proyecto_investigador($id_usuario_detalle_personal);
            
            // print($proyectosInvestigadores->id_proyecto_investigador);
            // exit();

            if ($proyectosInvestigadores && $proyectosInvestigadores->estado = 'A') {
                //$UsuariosDetalles->estado = 'X';
                //$UsuariosDetalles->save();
                $this->db->delete("tbl_inv_proyectos_investigadores", "id_proyecto_investigador = {$proyectosInvestigadores->id_proyecto_investigador}");
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
