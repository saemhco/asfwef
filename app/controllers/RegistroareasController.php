<?php

class RegistroareasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroareas.js?v=" . uniqid());
    }

    public function indexAction()
    {
        
    }

    //Funcion agregar y editar
    public function registroAction($id = null)
    {
        $this->view->id = $id;
        if ($id != null) {
            $Areas = Areas::findFirstBycodigo((int) $id);
        } else {

            $area_nuevo = Personal::count();

            //echo '<pre>';
            //print_r($noticias_nuevo);
            //exit();

            $Areas->codigo = $area_nuevo + 1;
        }

        $this->view->areas = $Areas;

        //tipo de area
        $tipo_areas = TipoAreas::find("estado = 'A' AND numero = 74 ");
        $this->view->tipoareas = $tipo_areas;

        //Personal detalle
        $Personal = Personal::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->personal_model = $Personal;

        //ModalidadTrabajo
        $ModalidadTrabajo = ModalidadTrabajo::find("estado = 'A' AND numero = 57");
        $this->view->modalidadtrabajo = $ModalidadTrabajo;

        //Docentes
        $docentes = Docentes::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->docentes = $docentes;


        $resoluciones = Resoluciones::find(
            [
                "estado = 'A'",
                'order' => 'id_resolucion ASC',
            ]
        );
        $this->view->resoluciones = $resoluciones;

        
        $contratos = Contratos::find(
            [
                "estado = 'A'",
                'order' => 'id_contrato ASC',
            ]
        );
        $this->view->contratos = $contratos;

        //areas_personal
        $this->assets->addJs("adminpanel/js/modulos/registroareas.personal.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroareas.docentes.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Areas = Areas::findFirstBycodigo($id);
                //Valida cuando es nuevo
                $Areas = (!$Areas) ? new Areas() : $Areas;

                //codigo
                $Areas->codigo = $this->request->getPost("codigo", "int");

                //tipo
                if ($this->request->getPost("tipo", "int") == "") {
                    $Areas->tipo = null;
                } else {
                    $Areas->tipo = $this->request->getPost("tipo", "int");
                }

                //nombres
                $Areas->nombres = $this->request->getPost("nombres", "string");

                //descripcion
                $Areas->descripcion = $this->request->getPost("descripcion");

                //email
                $Areas->email = $this->request->getPost("email", "string");

                //unidad_enlace
                $Areas->unidad_enlace = $this->request->getPost("unidad_enlace", "string");

                //orden
                if ($this->request->getPost("orden", "int") == "") {
                    $Areas->orden = null;
                } else {
                    $Areas->orden = $this->request->getPost("orden", "int");
                }

                //enlace
                $Areas->enlace = $this->request->getPost("enlace", "string");

                //estado
                $Areas->estado = "A";

                if ($Areas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Areas->getMessages());
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

                                    if (isset($Areas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->codigo . '-' . $temporal_rand . '.jpg';
                                        $Areas->imagen = 'IMG' . '-' . $Areas->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->codigo . '.jpg';
                                        $Areas->imagen = 'IMG' . '-' . $Areas->codigo . '.jpg';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Areas->imagen = 'IMG' . '-' . $Areas->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Areas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->codigo . '-' . $temporal_rand . '.png';
                                        $Areas->imagen = 'IMG' . '-' . $Areas->codigo . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->codigo . '.png';
                                        $Areas->imagen = 'IMG' . '-' . $Areas->codigo . '.png';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$Areas->imagen = 'IMG' . '-' . $Areas->codigo . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                //$url_destino = 'adminpanel/imagenes/areas/' . 'IMG' . '-' . $Areas->codigo . '.jpg';
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Areas->archivo)) {

                                        $url_destino = 'adminpanel/archivos/areas/' . $Areas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/areas/' . 'FILE' . '-' . $Areas->codigo . '-' . $temporal_rand . '.pdf';

                                        $Areas->archivo = 'FILE' . '-' . $Areas->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/areas/' . 'FILE' . '-' . $Areas->codigo . '.pdf';

                                        $Areas->archivo = 'FILE' . '-' . $Areas->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {

                                    }
                                }
                            }
                        }

                        $Areas->save();
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
            $datatable->setColumnaId("areas.codigo");
            $datatable->setSelect("areas.codigo,tipo_area.nombres as tipo_area, areas.nombres, areas.descripcion, areas.email, areas.unidad_enlace, areas.orden, areas.archivo, areas.imagen, areas.enlace, areas.estado");
            $datatable->setFrom("tbl_web_areas areas INNER JOIN a_codigos tipo_area ON CAST (areas.tipo AS INTEGER) = tipo_area.codigo");
            //$datatable->setWhere("areas.estado = 'A' AND tipo_area.numero = 74");
            $datatable->setWhere("tipo_area.numero = 74");
            $datatable->setOrderby("orden ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Areas = Areas::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Areas && $Areas->estado = 'A') {
                $Areas->estado = 'X';
                $Areas->save();
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



    //Areas.detalle
    public function datatablePersonalAreasAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("personal_areas.id_personal_area");
            $datatable->setSelect("personal_areas.id_personal_area, "
                . "personal_areas.personal, personal_areas.area,"
                . "personal_areas.cargo, personal_areas.fecha_inicio, "
                . "personal_areas.fecha_fin, personal_areas.archivo, "
                . "personal_areas.imagen, personal_areas.enlace, "
                . "personal_areas.estado, personal_areas.oficina, personal_areas.orden,"
                . "personal.nombres as nombres_personal, personal.apellidop as apellidop_personal, personal.apellidom as apellidom_personal");
            $datatable->setFrom("tbl_web_personal_areas personal_areas "
                . "INNER JOIN tbl_web_personal personal ON personal_areas.personal = personal.codigo "
                . "INNER JOIN tbl_web_areas areas ON personal_areas.area = areas.codigo");
            $datatable->setWhere("personal_areas.area = $id AND personal_areas.tipo=3");
            $datatable->setOrderby("personal_areas.orden ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Guardar
    public function savePersonalAreasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area", "int");
                $PersonalAreas = PersonalAreas::findFirstByid_personal_area($id);
                $PersonalAreas = (!$PersonalAreas) ? new PersonalAreas() : $PersonalAreas;

                //id_peprsonal
                $PersonalAreas->personal = $this->request->getPost("personal", "int");

                //codigo
                $PersonalAreas->area = $this->request->getPost("area", "int");

                //cargo
                $PersonalAreas->cargo = $this->request->getPost("cargo", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalAreas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalAreas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $PersonalAreas->enlace = $this->request->getPost("enlace", "string");

                //email
                $PersonalAreas->email = $this->request->getPost("email", "string");

                //enlace
                $PersonalAreas->oficina = $this->request->getPost("oficina", "string");

                //orden
                if ($this->request->getPost("orden", "int") == "") {
                    $PersonalAreas->orden = null;
                } else {
                    $PersonalAreas->orden = $this->request->getPost("orden", "int");
                }

                //Enlace
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $PersonalAreas->estado = "A";
                } else {
                    $PersonalAreas->estado = "X";
                }

                //es_principal
                $es_principal = $this->request->getPost("es_principal", "string");
                if (isset($es_principal)) {
                    $PersonalAreas->es_principal = "A";
                } else {
                    $PersonalAreas->es_principal = "X";
                }

                //Encargatura
                $encargatura = $this->request->getPost("encargatura", "string");
                if (isset($encargatura)) {
                    $PersonalAreas->encargatura = "A";
                } else {
                    $PersonalAreas->encargatura = "X";
                }

                $PersonalAreas->tipo = 3;


                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $PersonalAreas->id_resolucion = null;
                } else {
                    $PersonalAreas->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($this->request->getPost("id_contrato", "int") == "") {
                    $PersonalAreas->id_contrato = null;
                } else {
                    $PersonalAreas->id_contrato = $this->request->getPost("id_contrato", "int");
                }



                if ($PersonalAreas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonalAreas->getMessages());
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

                                    if (isset($PersonalAreas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . $PersonalAreas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.jpg';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($PersonalAreas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . $PersonalAreas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.png';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.png';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '.png';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                //$url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.pdf';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.pdf';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } elseif ($filex->getExtension() == 'doc') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.doc';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.doc';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.doc';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.doc';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } elseif ($filex->getExtension() == 'docx') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.docx';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.docx';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.docx';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.docx';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $PersonalAreas->save();
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

    //editar personal_areas
    public function getAjaxPersonalAreasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalAreas::findFirstByid_personal_area((int) $this->request->getPost("codigo", "int"));
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

    //eliminar personal_areas
    public function eliminarPersonalAreasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalAreas::findFirstByid_personal_area((int) $this->request->getPost("id", "int"));
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

    public function datatableDocentesAction($id)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("personal_areas.id_personal_area");
            $datatable->setSelect("personal_areas.id_personal_area AS pk,
            personal_areas.id_personal_area,
            personal_areas.personal,
            personal_areas.area,
            personal_areas.cargo,
            personal_areas.fecha_inicio,
            personal_areas.fecha_fin,
            personal_areas.archivo,
            personal_areas.imagen,
            personal_areas.enlace,
            personal_areas.estado,
            personal_areas.oficina,
            personal_areas.orden,
            public.docentes.apellidop AS apellidop_docentes,
            public.docentes.apellidom AS apellidom_docentes,
            public.docentes.nombres AS nombres_docentes");
            $datatable->setFrom("tbl_web_personal_areas personal_areas
            INNER JOIN public.tbl_web_areas AS areas ON personal_areas.area = areas.codigo
            INNER JOIN public.docentes ON public.docentes.codigo = personal_areas.personal");
            $datatable->setWhere("personal_areas.area = $id AND personal_areas.tipo=2");
            $datatable->setOrderby("personal_areas.orden ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Guardar
    public function saveDocentesAreasAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_personal_area", "int");
                $PersonalAreas = PersonalAreas::findFirstByid_personal_area($id);
                $PersonalAreas = (!$PersonalAreas) ? new PersonalAreas() : $PersonalAreas;

                //id_peprsonal
                $PersonalAreas->personal = $this->request->getPost("docentes", "int");

                //codigo
                $PersonalAreas->area = $this->request->getPost("area", "int");

                //cargo
                $PersonalAreas->cargo = $this->request->getPost("cargo", "string");

                //fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalAreas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PersonalAreas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //enlace
                $PersonalAreas->enlace = $this->request->getPost("enlace", "string");

                //email
                $PersonalAreas->email = $this->request->getPost("email", "string");

                //enlace
                $PersonalAreas->oficina = $this->request->getPost("oficina", "string");

                //orden
                if ($this->request->getPost("orden", "int") == "") {
                    $PersonalAreas->orden = null;
                } else {
                    $PersonalAreas->orden = $this->request->getPost("orden", "int");
                }

                //Enlace
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $PersonalAreas->estado = "A";
                } else {
                    $PersonalAreas->estado = "X";
                }

                //es_principal
                $es_principal = $this->request->getPost("es_principal", "string");
                if (isset($es_principal)) {
                    $PersonalAreas->es_principal = "A";
                } else {
                    $PersonalAreas->es_principal = "X";
                }

                //Encargatura
                $encargatura = $this->request->getPost("encargatura", "string");
                if (isset($encargatura)) {
                    $PersonalAreas->encargatura = "A";
                } else {
                    $PersonalAreas->encargatura = "X";
                }

                $PersonalAreas->tipo = 2;

                if ($this->request->getPost("id_resolucion", "int") == "") {
                    $PersonalAreas->id_resolucion = null;
                } else {
                    $PersonalAreas->id_resolucion = $this->request->getPost("id_resolucion", "int");
                }

                if ($this->request->getPost("id_contrato", "int") == "") {
                    $PersonalAreas->id_contrato = null;
                } else {
                    $PersonalAreas->id_contrato = $this->request->getPost("id_contrato", "int");
                }

                if ($PersonalAreas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonalAreas->getMessages());
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

                                    if (isset($PersonalAreas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . $PersonalAreas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.jpg';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($PersonalAreas->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . $PersonalAreas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.png';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.png';
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.png';
                                        $PersonalAreas->imagen = 'IMG' . '-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.png';
                                    }

                                    if (!$file->moveTo($url_destino)) {

                                    } else {
                                        //$Noticias->imagen = $Noticias->id_galeria . "-" . $file->getName();
                                        //$galeriasdetalles->imagen = 'IMG' . '-' . $galeriasdetalles->id_galeria . '-' . $galeriasdetalles->id_galeria . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Noticias->codigo . "-" . $file->getName();
                                //$url_destino = 'adminpanel/imagenes/personal_areas/' . 'IMG' . '-' . $PersonalAreas->id_personal_area . '.jpg';
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.pdf';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.pdf';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } elseif ($filex->getExtension() == 'doc') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.doc';
                                        $PersonalAreas->archivo = $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.doc';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.doc';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.doc';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } elseif ($filex->getExtension() == 'docx') {

                                    if (isset($PersonalAreas->archivo)) {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . $PersonalAreas->archivo;
                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.docx';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '-' . $temporal_rand . '.docx';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/personal_areas/' . 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.docx';
                                        $PersonalAreas->archivo = 'FILE-' . $PersonalAreas->tipo . '-' . $PersonalAreas->id_personal_area . '.docx';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $PersonalAreas->save();
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

    public function getAjaxDocentesAreasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalAreas::findFirstByid_personal_area((int) $this->request->getPost("codigo", "int"));
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

    public function eliminarDocentesAreasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = PersonalAreas::findFirstByid_personal_area((int) $this->request->getPost("id", "int"));
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
