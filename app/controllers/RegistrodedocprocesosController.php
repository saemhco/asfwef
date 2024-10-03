<?php

class RegistrodedocprocesosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrodedocprocesos.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    //Funcion agregar Documentos y editar
    public function registroAction($id = null)
    {


        $this->view->id = $id;
        if ($id != null) {
            $Docprocesos = Docproceso::findFirstByid_docproceso((int) $id);
        } else {

            $Docprocesos = Docproceso::findFirstByid_docproceso(0);
        }
        $this->view->docprocesos = $Docprocesos;



        //Tipo de Procesos
        $tipo_docproceso = TipoDocproceso::find("estado = 'A' AND numero = 146 ORDER BY nombres ASC ");
        $this->view->tipodocproceso = $tipo_docproceso;

        //Tipo nombre Procesos
        $tipo_nombreproceso = TipoNombreproceso::find("estado = 'A' AND numero = 147 ORDER BY nombres ASC ");
        $this->view->tiponombreproceso = $tipo_nombreproceso;

        //Tipo descripcion Procesos
        $tipo_descproceso = TipoDescproceso::find("estado = 'A' AND numero = 148 ORDER BY nombres ASC ");
        $this->view->tipodescproceso = $tipo_descproceso;


        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        //Archivos.detalles.js
        $this->assets->addJs("adminpanel/js/modulos/registrodedocprocesos.archivos.js?v=" . uniqid());
    

        $resoluciones = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'titulo DESC',
            ]
        );
        $this->view->resoluciones = $resoluciones;
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        /*
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_docproceso");
            $datatable->setSelect("tbl_web_docprocesos.id_docproceso,tbl_web_docprocesos.titulo,tbl_web_docprocesos.archivo,tbl_web_docprocesos.estado");
            $datatable->setFrom("tbl_web_docprocesos");            
            $datatable->setOrderby("tbl_web_docprocesos.id_docproceso DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();            
        }
        */
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,tipo_proceso,p_proceso,desc_proceso,titulo,archivo,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_docprocesos.id_docproceso as codigo,
            tipoproceso.nombres AS tipo_proceso,
            proceso.nombres AS p_proceso,
            descproceso.nombres AS desc_proceso,
            public.tbl_web_docprocesos.titulo,
            public.tbl_web_docprocesos.archivo,
            public.tbl_web_docprocesos.estado            
            FROM
            public.tbl_web_docprocesos
            INNER JOIN public.a_codigos AS tipoproceso ON tipoproceso.codigo = public.tbl_web_docprocesos.tipo
            INNER JOIN public.a_codigos AS proceso ON proceso.codigo = public.tbl_web_docprocesos.tipop
            INNER JOIN public.a_codigos AS descproceso ON descproceso.codigo = public.tbl_web_docprocesos.tipod
            WHERE
            tipoproceso.numero = 146 and proceso.numero= 147 and descproceso.numero= 148) AS temporal_table");
            $datatable->setOrderby("codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_docproceso", "int");
                $Docprocesos = Docproceso::findFirstByid_docproceso($id);
                $Docprocesos = (!$Docprocesos) ? new Docproceso() : $Docprocesos;

               
                //titulo
                $Docprocesos->titulo = $this->request->getPost("titulo", "string");

                //referencia
                $Docprocesos->referencia = $this->request->getPost("referencia", "string");

                //referencia_enlace
                $Docprocesos->referencia_enlace = $this->request->getPost("referencia_enlace", "string");

                //fecha_hora
                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Docprocesos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("orden", "int") == "") {
                    $Docprocesos->orden = null;
                } else {
                    $Docprocesos->orden = $this->request->getPost("orden", "int");
                }

                if ($this->request->getPost("tipo", "int") == "") {
                    $Docprocesos->tipo = null;
                } else {
                    $Docprocesos->tipo = $this->request->getPost("tipo", "int");
                }

                if ($this->request->getPost("tipop", "int") == "") {
                    $Docprocesos->tipop = null;
                } else {
                    $Docprocesos->tipop = $this->request->getPost("tipop", "int");
                }

                if ($this->request->getPost("tipod", "int") == "") {
                    $Docprocesos->tipod = null;
                } else {
                    $Docprocesos->tipod = $this->request->getPost("tipod", "int");
                }

                //enlace
                $Docprocesos->enlace = $this->request->getPost("enlace", "string");

                $visible = $this->request->getPost("visible", "string");
                
                if (isset($visible)) {
                    $Docprocesos->visible = 1;
                } else {
                    $Docprocesos->visible = 0;
                }

                //echo "<pre>";
                //print_r($Docprocesos->archivo);
                //exit();
                //estado
                $Docprocesos->estado = "A";

                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $Docprocesos->id_resolucion = null;
                } else {
                    $Docprocesos->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($Docprocesos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Docprocesos->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Docprocesos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/docprocesos/' . $Docprocesos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/docprocesos/' . 'IMG' . '-' . $Docprocesos->id_docproceso . '-' . $temporal_rand . '.jpg';
                                        $Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . '-' . $temporal_rand . ".jpg";
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/docprocesos/' . 'IMG' . '-' . $Docprocesos->id_docproceso . '.jpg';
                                        $Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . ".jpg";
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Docprocesos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/docprocesos/' . $Docprocesos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/docprocesos/' . 'IMG' . '-' . $Docprocesos->id_docproceso . '-' . $temporal_rand . '.png';
                                        $Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . '-' . $temporal_rand . ".png";
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/docprocesos/' . 'IMG' . '-' . $Docprocesos->id_docproceso . '.png';
                                        $Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . ".png";
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . ".jpg";
                                    }
                                }
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Docprocesos->archivo)) {

                                        $url_destino = 'adminpanel/archivos/docprocesos/' . $Docprocesos->archivo;

                                        //echo '<pre>';
                                        //print_r($url_destino);
                                        //exit();

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/docprocesos/' . $Docprocesos->enlace . '-' . $temporal_rand . '.pdf';
                                        $Docprocesos->archivo = $Docprocesos->enlace . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/docprocesos/' . $Docprocesos->enlace . '.pdf';
                                        $Docprocesos->archivo = $Docprocesos->enlace . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Docprocesos->imagen = 'IMG' . '-' . $Docprocesos->id_docproceso . ".jpg";
                                    }
                                }
                            }
                        }

                        $Docprocesos->save();
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

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $docprocesos = Docproceso::findFirst([
                'conditions' => 'id_docproceso = :id:',
                'bind' => ['id' => (int) $this->request->getPost("id", "int")]
            ]);
            if ($docprocesos && $docprocesos->estado = 'A') {
                $docprocesos->estado = 'X';
                $docprocesos->update();
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

    public function datatableArchivosAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_docproceso_archivo");
            $datatable->setSelect("public.tbl_web_docprocesos_archivos.id_docproceso_archivo,
            public.tbl_web_docprocesos_archivos.id_docproceso,
            public.tbl_web_docprocesos_archivos.titulo,
            to_char( public.tbl_web_docprocesos_archivos.fecha_hora, 'DD/MM/YYYY' ) AS fecha_hora,
            public.tbl_web_docprocesos_archivos.archivo,
            public.tbl_web_docprocesos_archivos.enlace,
            public.tbl_web_docprocesos_archivos.estado,
            public.tbl_web_docprocesos_archivos.orden");
            $datatable->setFrom("public.tbl_web_docprocesos_archivos");
            $datatable->setWhere("public.tbl_web_docprocesos_archivos.id_docproceso = $id");
            $datatable->setOrderby("public.tbl_web_docprocesos_archivos.orden DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDocprocesosArchivosAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = $this->request->getPost("id_docproceso_archivo");
                if ($id !== "") {
                    $id = (int)$id;
                } else {
                    // Manejar el caso de valor vacío según tus necesidades
                    $id = null; // O asigna un valor predeterminado apropiado
                }
                
                $docprocesosArchivos = DocprocesosArchivos::findFirst([
                    'conditions' => 'id_docproceso_archivo = :id:',
                    'bind' => ['id' => $id]
                ]);
                
                $docprocesosArchivos = (!$docprocesosArchivos) ? new DocprocesosArchivos() : $docprocesosArchivos;

                $docprocesosArchivos->id_docproceso = $this->request->getPost("id_docproceso", "int");

                $docprocesosArchivos->titulo = $this->request->getPost("titulo_archivo", "string");

                if ($this->request->getPost("fecha_hora_archivo", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_archivo", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $docprocesosArchivos->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $docprocesosArchivos->enlace = $this->request->getPost("enlace_archivo", "string");

                //$docprocesosArchivos->orden = $this->request->getPost("orden_archivo", "int");
                $docprocesosArchivos->estado = "A";
              
                $visible = $this->request->getPost("visible_archivo", "string");
                if (isset($visible)) {
                    $docprocesosArchivos->visible = "1";
                } else {
                    $docprocesosArchivos->visible = "0";
                }


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $docprocesosArchivos->id_resolucion = null;
                } else {
                    $docprocesosArchivos->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($docprocesosArchivos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($docprocesosArchivos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "docprocesos_archivo") {

                                if ($_FILES['docprocesos_archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['docprocesos_archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($docprocesosArchivos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/docprocesos_archivos/' . $docprocesosArchivos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/docprocesos_archivos/' . $docprocesosArchivos->enlace . '-' . $temporal_rand . "." . $extension;
                                            $docprocesosArchivos->archivo = $docprocesosArchivos->enlace . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/docprocesos_archivos/' . $docprocesosArchivos->enlace . "." . $extension;
                                            $docprocesosArchivos->archivo = $docprocesosArchivos->enlace . "." . $extension;
                                        }
                                       
                                        $as = $file->moveTo($url_destino);

                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $docprocesosArchivos->save();
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

    public function getAjaxDocprocesosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocprocesosArchivos::findFirstByid_docproceso_archivo((int) $this->request->getPost("id", "int"));
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

    public function eliminarDocprocesosArchivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocprocesosArchivos::findFirstByid_docproceso_archivo((int) $this->request->getPost("id", "int"));
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

    public function datatableEvaluacionesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_docproceso_evaluacion");
            $datatable->setSelect("public.tbl_web_documentos_evaluaciones.id_docproceso_evaluacion,
            public.tbl_web_documentos_evaluaciones.id_docproceso,
            public.tbl_web_documentos_evaluaciones.titulo,
            to_char( public.tbl_web_documentos_evaluaciones.fecha_hora, 'DD/MM/YYYY' ) AS fecha_hora,
            public.tbl_web_documentos_evaluaciones.archivo,
            public.tbl_web_documentos_evaluaciones.enlace,
            public.tbl_web_documentos_evaluaciones.estado");
            $datatable->setFrom("public.tbl_web_documentos_evaluaciones");
            $datatable->setWhere("public.tbl_web_documentos_evaluaciones.id_docproceso = $id");
            $datatable->setOrderby("public.tbl_web_documentos_evaluaciones.fecha_hora DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDocumentosEvaluacionesAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_docproceso_evaluacion", "int");
                $docprocesosEvaluaciones = DocumentosEvaluaciones::findFirstByid_docproceso_evaluacion($id);
                $docprocesosEvaluaciones = (!$docprocesosEvaluaciones) ? new DocumentosEvaluaciones() : $docprocesosEvaluaciones;

                $docprocesosEvaluaciones->id_docproceso = $this->request->getPost("id_docproceso", "int");

                $docprocesosEvaluaciones->titulo = $this->request->getPost("titulo_evaluacion", "string");

                if ($this->request->getPost("fecha_hora_evaluacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora_evaluacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $docprocesosEvaluaciones->fecha_hora = date('Y-m-d', strtotime($fecha_new));
                }

                $docprocesosEvaluaciones->enlace = $this->request->getPost("enlace_evaluacion", "string");

                $docprocesosEvaluaciones->orden = $this->request->getPost("orden_evaluacion", "int");
                $docprocesosEvaluaciones->estado = "A";

                $visible = $this->request->getPost("visible_evaluacion", "string");
                if (isset($visible)) {
                    $docprocesosEvaluaciones->visible = "1";
                } else {
                    $docprocesosEvaluaciones->visible = "0";
                }


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $docprocesosEvaluaciones->id_resolucion = null;
                } else {
                    $docprocesosEvaluaciones->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($docprocesosEvaluaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($docprocesosEvaluaciones->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "documentos_evaluacion") {

                                if ($_FILES['documentos_evaluacion']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['documentos_evaluacion']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($docprocesosEvaluaciones->archivo)) {
                                            $url_destino = 'adminpanel/archivos/documentos_evaluaciones/' . $docprocesosEvaluaciones->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/documentos_evaluaciones/' . $docprocesosEvaluaciones->enlace . '-' . $temporal_rand . "." . $extension;
                                            $docprocesosEvaluaciones->archivo = $docprocesosEvaluaciones->enlace . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/documentos_evaluaciones/' . $docprocesosEvaluaciones->enlace . "." . $extension;
                                            $docprocesosEvaluaciones->archivo = $docprocesosEvaluaciones->enlace . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $docprocesosEvaluaciones->save();
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

    public function getAjaxDocumentosEvaluacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocumentosEvaluaciones::findFirstByid_docproceso_evaluacion((int) $this->request->getPost("id", "int"));
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

    public function eliminarDocumentosEvaluacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = DocumentosEvaluaciones::findFirstByid_docproceso_evaluacion((int) $this->request->getPost("id", "int"));
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

}
