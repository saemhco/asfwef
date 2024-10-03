<?php

class RegistroproyectosinversionController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('Mantenimiento de Proyectos');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroproyectosinversion.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    //Funcion agregar y editar
    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $invproyectos = ProyectosInversion::findFirstByid_proyecto((int) $id);
        }
        $this->view->invproyecto = $invproyectos;

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

        $lineasinv = LineasInvestigacion::find("estado = 'A' ORDER BY nombre ASC");
        $this->view->lineasinv = $lineasinv;


        $tipos = Acodigos::find("estado = 'A' AND numero = 138 ORDER BY nombres");
        $this->view->tipos = $tipos;

        $etapas = Acodigos::find("estado = 'A' AND numero = 139 ORDER BY nombres");
        $this->view->etapas = $etapas;

    }

    //Funcion guardar
    public function saveAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_proyecto", "int");
                $InvProyecto = ProyectosInversion::findFirstByid_proyecto($id);
                $InvProyecto = (!$InvProyecto) ? new ProyectosInversion() : $InvProyecto;

                $InvProyecto->titulo = $this->request->getPost("titulo", "string");
                $InvProyecto->tipo = $this->request->getPost("tipo", "string");
                $InvProyecto->codigo_unico = $this->request->getPost("codigo_unico", "int");

                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $InvProyecto->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_termino", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_termino", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $InvProyecto->fecha_termino = date('Y-m-d', strtotime($fecha_new));
                }

                $InvProyecto->presupuesto = $this->request->getPost("presupuesto", "string");
                $InvProyecto->monto = $this->request->getPost("monto", "string");
                $InvProyecto->local_proyecto = $this->request->getPost("local_proyecto", "string");
                $InvProyecto->archivo = $this->request->getPost("archivo", "string");
                $InvProyecto->imagen = $this->request->getPost("imagen", "string");
                $InvProyecto->enlace = $this->request->getPost("enlace", "string");
                $InvProyecto->estado = "A";

                $InvProyecto->tipo_proyecto = 2;

                if ($this->request->getPost("etapa", "int") == "") {
                    $InvProyecto->etapa = null;
                } else {
                    $InvProyecto->etapa = $this->request->getPost("etapa", "int");
                }

                $InvProyecto->resumen = $this->request->getPost("resumen", "string");

                if ($InvProyecto->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($InvProyecto->getMessages());
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

                                    if (isset($InvProyecto->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/invproyectos/' . $InvProyecto->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/invproyectos/' . 'IMG' . '-' . $InvProyecto->id_proyecto . '-' . $temporal_rand . '.jpg';
                                        $InvProyecto->imagen = 'IMG' . '-' . $InvProyecto->id_proyecto . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/invproyectos/' . 'IMG' . '-' . $InvProyecto->id_proyecto . '.jpg';
                                        $InvProyecto->imagen = 'IMG' . '-' . $InvProyecto->id_proyecto . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($InvProyecto->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/invproyectos/' . $InvProyecto->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/invproyectos/' . 'IMG' . '-' . $InvProyecto->id_proyecto . '-' . $temporal_rand . '.png';
                                        $InvProyecto->imagen = 'IMG' . '-' . $InvProyecto->id_proyecto . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/invproyectos/' . 'IMG' . '-' . $InvProyecto->id_proyecto . '.png';
                                        $InvProyecto->imagen = 'IMG' . '-' . $InvProyecto->id_proyecto . ".png";
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

                                    if ($InvProyecto->archivo != '') {
                                        $url_destino = 'adminpanel/archivos/invproyectos/' . $InvProyecto->archivo;
                                        //print $url_destino;exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/invproyectos/' . 'FILE' . '-' . $InvProyecto->id_proyecto . '-' . $temporal_rand . '.pdf';
                                        $InvProyecto->archivo = 'FILE' . '-' . $InvProyecto->id_proyecto . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/invproyectos/' . 'FILE' . '-' . $InvProyecto->id_proyecto . '.pdf';
                                        $InvProyecto->archivo = 'FILE' . '-' . $InvProyecto->id_proyecto . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $InvProyecto->save();
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
            $datatable->setSelect("id_proyecto,titulo,fecha_inicio,fecha_termino,entidad_cooperante,estado,codigo_unico");
            $datatable->setFrom("tbl_inv_proyectos");
            $datatable->setWhere("estado = 'A' AND tipo_proyecto = 2");
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
            $InvProyecto = ProyectosInversion::findFirstByid_proyecto((int) $this->request->getPost("id_proyecto", "int"));
            if ($InvProyecto && $InvProyecto->estado = 'A') {
                $InvProyecto->estado = 'X';
                $InvProyecto->save();
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
