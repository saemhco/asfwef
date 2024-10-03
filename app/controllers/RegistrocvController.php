<?php

class RegistrocvController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
        $id_publico = $this->session->get("auth")["codigo"];
        $this->view->id_publico = $id_publico;
        $this->assets->addJs("adminpanel/js/modulos/registrocv.js?v" . uniqid());
    }

//datos
    public function datosAction()
    {
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico;

//Modelo documentos(a_codigos)
        $tipodocumento = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentopostulantes = $tipodocumento;

//Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

//colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

//estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

//Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        $this->assets->addJs("adminpanel/js/modulos/registrocv.datos.js?v" . uniqid());
    }

//saveDatos
    public function saveDatosAction()
    {

        //    echo '<pre>';
        //            print_r($_FILES['archivo']['size']);
        //            exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoConvocatorias = PublicoConvocatorias::findFirstBycodigo($id);
//$PublicoConvocatorias = (!$PublicoConvocatorias) ? new PublicoConvocatorias() : $PublicoConvocatorias;

                $PublicoConvocatorias->codigo = $this->request->getPost("codigo", "int");
                $PublicoConvocatorias->documento = 1;
//$PublicoConvocatorias->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoConvocatorias->nro_ruc = $this->request->getPost("nro_ruc", "string");
                $PublicoConvocatorias->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoConvocatorias->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoConvocatorias->nombres = strtoupper($this->request->getPost("nombres"));
                $PublicoConvocatorias->email = $this->request->getPost("email", "string");
                $PublicoConvocatorias->tipo = 1;
                $PublicoConvocatorias->celular = $this->request->getPost("celular", "string");

                $PublicoConvocatorias->region = $this->request->getPost("region", "string");
                $PublicoConvocatorias->provincia = $this->request->getPost("provincia", "string");
                $PublicoConvocatorias->distrito = $this->request->getPost("distrito", "string");
                $PublicoConvocatorias->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoConvocatorias->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoConvocatorias->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $PublicoConvocatorias->ciudad = strtoupper($this->request->getPost("ciudad", "string"));

                if ($this->request->getPost("estado_civil", "int") == "") {
                    $PublicoConvocatorias->estado_civil = null;
                } else {
                    $PublicoConvocatorias->estado_civil = $this->request->getPost("estado_civil", "int");
                }

                if ($this->request->getPost("sexo", "int") == "") {
                    $PublicoConvocatorias->sexo = null;
                } else {
                    $PublicoConvocatorias->sexo = $this->request->getPost("sexo", "int");
                }

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $PublicoConvocatorias->discapacitado = 1;
                } else {

                    $PublicoConvocatorias->discapacitado = 0;
                }

                $PublicoConvocatorias->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $PublicoConvocatorias->colegio_profesional = null;
                } else {
                    $PublicoConvocatorias->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }

                $PublicoConvocatorias->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");

                $PublicoConvocatorias->estado = "A";

                if ($PublicoConvocatorias->save() == false) {
// Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoConvocatorias->getMessages());
                } else {

//Cuando va bien
                    if ($this->request->hasFiles() == true) {
// Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
//echo "<pre>";print_r($file);exit();
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                if ($_FILES['imagen']['size'] <= 1000000){
                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'jpg') {
    
                                        if (isset($PublicoConvocatorias->foto)) {
                                            $url_destino = 'adminpanel/imagenes/publico/' . $PublicoConvocatorias->foto;
    
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
    
                                            $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . '.jpg';
                                            $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . ".jpg";
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '.jpg';
                                            $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . ".jpg";
                                        }
    
                                        if (!$file->moveTo($url_destino)) {
    
                                        } else {
    
                                        }
    
                                    } elseif ($filex->getExtension() == 'png') {
    
                                        if (isset($PublicoConvocatorias->foto)) {
                                            $url_destino = 'adminpanel/imagenes/publico/' . $PublicoConvocatorias->foto;
    
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
    
                                            $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . '.png';
                                            $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . '-' . $temporal_rand . ".png";
                                        } else {
                                            $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $PublicoConvocatorias->codigo . '.png';
                                            $PublicoConvocatorias->foto = 'IMG' . '-' . $PublicoConvocatorias->codigo . ".png";
                                        }
    
                                        if (!$file->moveTo($url_destino)) {
    
                                        } else {
    
                                        }
    
                                    }
                                }else{
                                    $this->response->setJsonContent(array("say" => "error_imagen"));
                                    $this->response->send();
                                    exit();
                                }


                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['size'] <= 1000000) {

                                    $filex = new SplFileInfo($file->getName());
                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($PublicoConvocatorias->archivo)) {

                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            //$file->getName() = $Resoluciones->nombre;
                                            //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DNI' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';

                                            $PublicoConvocatorias->archivo = 'FILE-DNI' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';
                                        } else {
                                            //$file->getName() = $Resoluciones->nombre;
                                            //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DNI' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';

                                            $PublicoConvocatorias->archivo = 'FILE-DNI' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';
                                        }
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } else {
                                    $this->response->setJsonContent(array("say" => "error_archivo_dni"));
                                    $this->response->send();
                                    exit();
                                }

                            }

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {
                                if ($_FILES['archivo_ruc']['size'] <= 1000000) {
                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($PublicoConvocatorias->archivo)) {

                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo_ruc;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'RUC' . '-' . $PublicoConvocatorias->nro_ruc . '-' . $temporal_rand . '.pdf';

                                            $PublicoConvocatorias->archivo_ruc = 'FILE-RUC' . '-' . $PublicoConvocatorias->nro_ruc . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'RUC' . '-' . $PublicoConvocatorias->nro_ruc . '.pdf';

                                            $PublicoConvocatorias->archivo_ruc = 'FILE-RUC' . '-' . $PublicoConvocatorias->nro_ruc . '.pdf';
                                        }
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } else {
                                    $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                                    $this->response->send();
                                    exit();
                                }

                            }

                            //archivo_cp
                            if ($file->getKey() == "archivo_cp") {
                                if ($_FILES['archivo_cp']['size'] <= 1000000) {
                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($PublicoConvocatorias->archivo)) {

                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo_cp;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'CP' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';

                                            $PublicoConvocatorias->archivo_cp = 'FILE-CP' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'CP' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';

                                            $PublicoConvocatorias->archivo_cp = 'FILE-CP' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';
                                        }
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } else {
                                    $this->response->setJsonContent(array("say" => "error_archivo_cp"));
                                    $this->response->send();
                                    exit();
                                }

                            }

                            //archivo_dc
                            if ($file->getKey() == "archivo_dc") {
                                if ($_FILES['archivo_dc']['size'] <= 1000000) {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'pdf') {
                                        if (isset($PublicoConvocatorias->archivo)) {

                                            $url_destino = 'adminpanel/archivos/publico/personales/' . $PublicoConvocatorias->archivo_dc;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DC' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';

                                            $PublicoConvocatorias->archivo_dc = 'FILE-DC' . '-' . $PublicoConvocatorias->nro_doc . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            $url_destino = 'adminpanel/archivos/publico/personales/FILE-' . 'DC' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';

                                            $PublicoConvocatorias->archivo_dc = 'FILE-DC' . '-' . $PublicoConvocatorias->nro_doc . '.pdf';
                                        }
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                } else {
                                    $this->response->setJsonContent(array("say" => "error_archivo_dc"));
                                    $this->response->send();
                                    exit();
                                }

                            }
                        }

                        $PublicoConvocatorias->save();
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

//------------------------------formacion-----------------------------------
    public function formacionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registrocv.formacion.js?v" . uniqid());

//grado
        $GradoMaximo = GradoMaximo::find("estado = 'A' AND numero = 69");
        $this->view->gradomaximo = $GradoMaximo;
    }

//datatableFormacion
    public function datatableFormacionAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("formacion.codigo");
            $datatable->setSelect("formacion.codigo, formacion.publico, formacion.grado, "
                . "formacion.nombre, formacion.fecha_grado, formacion.institucion, formacion.pais, "
                . "formacion.archivo, formacion.imagen, formacion.estado, grado.nombres AS nombre_grado");
            $datatable->setFrom("tbl_web_publico_formacion formacion INNER JOIN a_codigos grado ON grado.codigo = formacion.grado");
            //$datatable->setWhere("formacion.estado = 'A' AND grado.numero = 69 AND formacion.publico = {$publico}");
            $datatable->setWhere("formacion.estado = 'A' AND grado.numero = 69 AND formacion.publico = {$publico}");
            $datatable->setOrderby("formacion.fecha_grado DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

//saveFormacion
    public function saveFormacionAction()
    {

//        echo '<pre>';
        //        print_r($_POST);
        //        exit();
        //        echo "<pre>";
        //        print_r($_FILES['archivo']['name']);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");

                $PublicoFormacion = PublicoFormacion::findFirstBycodigo($id);
                $PublicoFormacion = (!$PublicoFormacion) ? new PublicoFormacion() : $PublicoFormacion;

                //publico
                $PublicoFormacion->publico = $this->session->get("auth")["codigo"];

                //grado
                $PublicoFormacion->grado = $this->request->getPost("grado", "int");

                //nombre
                $PublicoFormacion->nombre = $this->request->getPost("nombre", "string");

                //fecha_grado
                if ($this->request->getPost("fecha_grado", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_grado", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoFormacion->fecha_grado = date('Y-m-d', strtotime($fecha_new));
                }

                //institucion
                $PublicoFormacion->institucion = $this->request->getPost("institucion", "string");

                //pais
                $PublicoFormacion->pais = $this->request->getPost("pais", "string");

                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoFormacion->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoFormacion->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }

                //estado
                $PublicoFormacion->estado = 'A';

                $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoFormacion->nro_doc = $Publico->nro_doc;

                if ($PublicoFormacion->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoFormacion->getMessages());
                } else {

//Cuando va bien
                    if ($this->request->hasFiles() == true) {
// Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
//imagen
                            $temporal_rand = mt_rand(100000, 999999);

//archivo
                            if ($file->getKey() == "archivo") {

//$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

//echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoFormacion->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '.pdf';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }

//para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoFormacion->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '.jpg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoFormacion->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/' . $PublicoFormacion->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/formacion/FILE-' . $PublicoFormacion->codigo . '.jpeg';
                                        $PublicoFormacion->archivo = 'FILE-' . $PublicoFormacion->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $PublicoFormacion->save();
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

//getAjaxFormacion
    public function getAjaxPublicoFormacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoFormacion = PublicoFormacion::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoFormacion) {
                $this->response->setJsonContent($PublicoFormacion->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

//eliminarPublicoFormacion
    public function eliminarPublicoFormacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoFormacion = PublicoFormacion::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoFormacion && $PublicoFormacion->estado = 'A') {
                $PublicoFormacion->estado = 'X';
                $PublicoFormacion->save();
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

//--------------------------capacitaciones-------------------------------------
    public function capacitacionesAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registrocv.capacitaciones.js?v" . uniqid());

//capacitaciones
        $Capacitaciones = Capacitaciones::find("estado = 'A' AND numero = 86");
        $this->view->capacitaciones = $Capacitaciones;
    }

//datatableEspecializaciones
    public function datatableCapacitacionesAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("capacitaciones.codigo");
            $datatable->setSelect("capacitaciones.codigo, capacitaciones.publico, capacitaciones.capacitacion, "
                . "capacitaciones.nombre, capacitaciones.fecha_inicio, capacitaciones.fecha_fin, capacitaciones.institucion, "
                . "capacitaciones.pais, capacitaciones.archivo, capacitaciones.imagen, capacitaciones.estado, capacitacion.nombres AS nombre_capacitacion, "
                . "capacitaciones.horas, capacitaciones.creditos");
            $datatable->setFrom("tbl_web_publico_capacitaciones capacitaciones INNER JOIN a_codigos capacitacion ON capacitacion.codigo = capacitaciones.capacitacion");
            //$datatable->setWhere("capacitaciones.estado = 'A' AND capacitacion.numero = 86 AND capacitaciones.publico = {$publico}");
            $datatable->setWhere("capacitaciones.estado = 'A' AND capacitacion.numero = 86 AND capacitaciones.publico = {$publico}");
            $datatable->setOrderby("capacitaciones.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

//saveEspecializacion
    public function saveCapacitacionesAction()
    {

//echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoCapacitaciones = PublicoCapacitaciones::findFirstBycodigo($id);
                $PublicoCapacitaciones = (!$PublicoCapacitaciones) ? new PublicoCapacitaciones() : $PublicoCapacitaciones;

                //
                //publico
                $PublicoCapacitaciones->publico = $this->session->get("auth")["codigo"];

//grado
                $PublicoCapacitaciones->capacitacion = $this->request->getPost("capacitacion", "int");

//nombre
                $PublicoCapacitaciones->nombre = $this->request->getPost("nombre", "string");

//fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoCapacitaciones->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

//fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoCapacitaciones->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

//institucion
                $PublicoCapacitaciones->institucion = $this->request->getPost("institucion", "string");

//pais
                $PublicoCapacitaciones->pais = $this->request->getPost("pais", "string");

//horas
                $PublicoCapacitaciones->horas = $this->request->getPost("horas", "int");

//creditos
                if ($this->request->getPost("creditos", "int") == "") {
                    $PublicoCapacitaciones->creditos = null;
                } else {
                    $PublicoCapacitaciones->creditos = $this->request->getPost("creditos", "int");
                }

//
                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoCapacitaciones->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoCapacitaciones->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
//
                //estado
                $PublicoCapacitaciones->estado = 'A';

                $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoCapacitaciones->nro_doc = $Publico->nro_doc;

                if ($PublicoCapacitaciones->save() == false) {
// Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoCapacitaciones->getMessages());
                } else {

//Cuando va bien
                    if ($this->request->hasFiles() == true) {
// Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
//imagen
                            $temporal_rand = mt_rand(100000, 999999);

//archivo
                            if ($file->getKey() == "archivo") {

//$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

//echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();
                                //para archivos pdf
                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoCapacitaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '.pdf';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }

//para imaganes con formato jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoCapacitaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '.jpg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoCapacitaciones->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/' . $PublicoCapacitaciones->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/capacitaciones/FILE-' . $PublicoCapacitaciones->codigo . '.jpeg';
                                        $PublicoCapacitaciones->archivo = 'FILE-' . $PublicoCapacitaciones->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $PublicoCapacitaciones->save();
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

//getAjaxEspecializacion
    public function getAjaxPublicoCapacitacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoCapacitaciones = PublicoCapacitaciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoCapacitaciones) {
                $this->response->setJsonContent($PublicoCapacitaciones->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

//eliminarEspecializaciones
    public function eliminarPublicoCapacitacionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoCapacitaciones = PublicoCapacitaciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoCapacitaciones && $PublicoCapacitaciones->estado = 'A') {
                $PublicoCapacitaciones->estado = 'X';
                $PublicoCapacitaciones->save();
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

//-----------------------------experiencia----------------------------------
    public function experienciaAction()
    {
//especialidad
        $TipoExperienciaLaboral = TipoExperienciaLaboral::find("estado = 'A' AND numero = 87");
        $this->view->tipoexperiencialaboral = $TipoExperienciaLaboral;

        $this->assets->addJs("adminpanel/js/modulos/registrocv.experiencia.js?v" . uniqid());
    }

//datatableExperiencia
    public function datatableExperienciaAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("experiencia.codigo");
            $datatable->setSelect("experiencia.codigo, experiencia.publico, experiencia.tipo, "
                . "experiencia.cargo, experiencia.fecha_inicio, experiencia.fecha_fin, "
                . "experiencia.tiempo, experiencia.institucion, experiencia.funciones, "
                . "experiencia.archivo, experiencia.imagen, experiencia.estado, tipo.nombres AS nombre_tipo");
            $datatable->setFrom("tbl_web_publico_experiencia experiencia INNER JOIN a_codigos tipo ON tipo.codigo = experiencia.tipo");
            //$datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.publico = {$publico}");
            $datatable->setWhere("experiencia.estado = 'A' AND tipo.numero = 87 AND experiencia.publico = {$publico}");
            $datatable->setOrderby("experiencia.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

//saveExperiencia
    public function saveExperienciaAction()
    {

//        echo '<pre>';
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("codigo", "int");
                $PublicoExperiencia = PublicoExperiencia::findFirstBycodigo($id);
                $PublicoExperiencia = (!$PublicoExperiencia) ? new PublicoExperiencia() : $PublicoExperiencia;

//publico
                $PublicoExperiencia->publico = $this->session->get("auth")["codigo"];

//tipo
                $PublicoExperiencia->tipo = $this->request->getPost("tipo", "int");

//cargo
                $PublicoExperiencia->cargo = $this->request->getPost("cargo", "string");

//fecha_inicio
                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoExperiencia->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

//fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $PublicoExperiencia->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

//tiempo
                $PublicoExperiencia->tiempo = 0;
//institucion
                $PublicoExperiencia->institucion = $this->request->getPost("institucion", "string");

//funciones
                $PublicoExperiencia->funciones = $this->request->getPost("funciones");

//archivo
                if ($this->request->getPost("input-file") !== '') {

                    $info = new SplFileInfo($this->request->getPost("input-file"));

                    if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                        $PublicoExperiencia->archivo = $this->request->getPost("input-file");
                    } else {
                        $this->response->setJsonContent(array("say" => "no_formato"));
                        $this->response->send();
                        exit();
                    }
                } else {
                    $info = new SplFileInfo($_FILES['archivo']['name']);

                    if ($info->getExtension() !== '') {

                        if ($info->getExtension() == 'pdf' or $info->getExtension() == 'jpg' or $info->getExtension() == 'jpeg') {
                            $PublicoExperiencia->archivo = $_FILES['archivo']['name'];
                        } else {
                            $this->response->setJsonContent(array("say" => "no_formato"));
                            $this->response->send();
                            exit();
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "falta"));
                        $this->response->send();
                        exit();
                    }
                }
//estado
                $PublicoExperiencia->estado = 'A';

                $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                $PublicoExperiencia->nro_doc = $Publico->nro_doc;

                if ($PublicoExperiencia->save() == false) {
// Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoExperiencia->getMessages());
                } else {

//Cuando va bien
                    if ($this->request->hasFiles() == true) {
// Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
//imagen
                            $temporal_rand = mt_rand(100000, 999999);

//archivo
                            if ($file->getKey() == "archivo") {

//$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

//echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($PublicoExperiencia->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.pdf';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '.pdf';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }

//para subir jpg
                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($PublicoExperiencia->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '.jpg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '.jpg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }

                                if ($filex->getExtension() == 'jpeg') {

                                    if (isset($PublicoExperiencia->archivo)) {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/' . $PublicoExperiencia->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpeg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '-' . $temporal_rand . '.jpeg';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/publico/experiencia/FILE-' . $PublicoExperiencia->codigo . '.jpeg';
                                        $PublicoExperiencia->archivo = 'FILE-' . $PublicoExperiencia->codigo . '.jpeg';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $PublicoExperiencia->save();
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

//getAjaxPublicoExperiencia
    public function getAjaxPublicoExperienciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExperiencia = PublicoExperiencia::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExperiencia) {
                $this->response->setJsonContent($PublicoExperiencia->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

//eliminarExperiencia
    public function eliminarPublicoExperienciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExperiencia = PublicoExperiencia::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($PublicoExperiencia && $PublicoExperiencia->estado = 'A') {
                $PublicoExperiencia->estado = 'X';
                $PublicoExperiencia->save();
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

//-----------------------------convocatorias--------------------------------
    public function convocatoriasAction()
    {

        // echo "<pre>";
        // print_r($_SESSION);exit();

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
        $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
        $this->view->publico = $Publico->codigo;

        //$ConvocatoriasPublico = ConvocatoriasPublico::count();
        //$this->view->codigo = $ConvocatoriasPublico + 1;
        //Count PublicoFormacion
        $PublicoFormacion = PublicoFormacion::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_formacion = $PublicoFormacion;

        //Count PublicoCapacitaciones
        $PublicoCapacitaciones = PublicoCapacitaciones::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_capacitaciones = $PublicoCapacitaciones;

        //Count PublicoExperiencia
        $PublicoExperiencia = PublicoExperiencia::count(
            [
                "publico = {$Publico->codigo} AND estado = 'A'",
            ]
        );
        $this->view->count_experiencia = $PublicoExperiencia;

        $this->assets->addJs("adminpanel/js/modulos/registrocv.convocatorias.js?v" . uniqid());
    }

//datatableConvocatorias
    public function datatableConvocatoriasAction()
    {

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto,convocatorias_perfiles.fecha_inicio, convocatorias_perfiles.fecha_fin, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo");
            $datatable->setFrom("tbl_web_convocatorias convocatorias INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria");
            $datatable->setWhere("convocatorias.etapa = 1");
            $datatable->setOrderby("convocatorias_perfiles.nombre_corto");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

//verificar convocatoria
    public function verificarConvocatoriaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $convocatoria = (int) $this->request->getPost("convocatoria", "int");
            $publico = (int) $this->request->getPost("publico", "int");

            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst(
                [
                    "convocatoria = $convocatoria AND publico = $publico",
                ]
            );

            if ($ConvocatoriasPublico) {
//$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
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

//save convocatorias
    public function saveConvocatoriasAction()
    {

//        echo '<pre>';
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //perfil
                $perfil_puesto = $this->request->getPost("perfil", "int");

                //vaalidar fecha
                $ConvocatoriasPerfiles = ConvocatoriasPerfiles::findFirstBycodigo($perfil_puesto);

                $f_i = strtotime(date($ConvocatoriasPerfiles->fecha_inicio));
                $f_f = strtotime(date($ConvocatoriasPerfiles->fecha_fin));
                $f_a = strtotime(date("Y-m-d H:i:s", time()));

                if ($f_a >= $f_i and $f_a <= $f_f) {

                    $ConvocatoriasPublico = (!$ConvocatoriasPublico) ? new ConvocatoriasPublico() : $ConvocatoriasPublico;

                    $ConvocatoriasPublico->convocatoria = $this->request->getPost("convocatoria", "int");

                    //publico
                    $ConvocatoriasPublico->publico = $this->request->getPost("publico", "int");

                    //perfil
                    $ConvocatoriasPublico->perfil = $this->request->getPost("perfil", "int");

                    //fecha_registro
                    $ConvocatoriasPublico->fecha = date("Y-m-d H:i:s");

                    $ConvocatoriasPublico->anexos = $this->request->getPost("input-file", "string");

                    //estado
                    $ConvocatoriasPublico->estado = 1;

                    //proceso
                    $ConvocatoriasPublico->proceso = 0;

                    //campos para email
                    $convocatorias_titular = $this->request->getPost("convocatorias_titular", "string");
                    $convocatoria_perfiles_codigo = $this->request->getPost("convocatoria_perfiles_codigo", "string");
                    $convocatoria_perfiles_nombre = $this->request->getPost("convocatoria_perfiles_nombre", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "fecha_vencida"));
                    $this->response->send();
                    exit();
                }

                if ($ConvocatoriasPublico->save() == false) {

                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ConvocatoriasPublico->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            // Enviando email a La empresa
                            $Publico = Publico::findFirstBycodigo($this->session->get("auth")["codigo"]);
                            $fecha_format = explode("-", $ConvocatoriasPublico->fecha);
                            $fecha_format_resultado = $fecha_format[2] . "/" . $fecha_format[1] . "/" . $fecha_format[0];

                            $email_destEmail = $this->config->mail->destEmail;
                            $text_body = "{$this->config->global->xCiudadIns}, $fecha_format_resultado" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "SOLICITUD DE INSCRIPCIÓN" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Señores:" . '<br>';
                            $text_body .= "COMITÉ DE EVALUACIÓN Y SELECCIÓN DEL {$convocatorias_titular}" . '<br>';
                            $text_body .= "{$this->config->global->xNombreIns}" . '<br>';
                            $text_body .= "Presente." . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Yo, {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}, identificado (a)con DNI N° {$Publico->nro_doc}, con correo electrónico {$Publico->email}, me presento ante ustedes, para exponerle:" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Que, deseo postular al puesto de {$convocatoria_perfiles_codigo} {$convocatoria_perfiles_nombre}. del proceso de $convocatorias_titular, cumpliendo con los requisitos solicitados en el perfil del cargo al cual postulo, para cuyo efecto registré los documentos solicitados en la plataforma virtual de Gestión de Convocatorias para la evaluación correspondiente" . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "Atentamente." . '<br>';
                            $text_body .= "" . '<br>';
                            $text_body .= "{$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}" . '<br>';

                            //$this->config->global->xAbrevIns;

                            $mailer = new mailer($this->di);
                            $mailer->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            $mailer->setTo($email_destEmail, $email_destEmail);
                            $mailer->setBody($text_body);
                            if ($mailer->send()) {
                                //return true;
                            } else {
                                echo $mailer->getError();
                                echo "error";
                            }

                            // Enviando Email al Usuario

                            $email_usuario = $Publico->email;

                            //print("Beba Army is back:" . $email_usuario);
                            //exit();
                            $text_body2 = "Estimado Postulante: {$Publico->nombres} {$Publico->apellidop} {$Publico->apellidom}: " . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Ud. se ha registrado satisfactoriamente al $convocatorias_titular al puesto: {$convocatoria_perfiles_codigo} {$convocatoria_perfiles_nombre}." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "HA REGISTRADO LOS SIGUIENTE INFORMACIÓN:";
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "- DATOS PERSONALES" . '<br>';
                            $text_body2 .= "- FORMACIÓN PROFESIONAL" . '<br>';
                            $text_body2 .= "- CURSOS / DIPLOMADOS DE CAPACITACIÓN" . '<br>';
                            $text_body2 .= "- EXPERIENCIA PROFESIONAL" . '<br>';
                            $text_body2 .= "- ANEXOS." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Se sugiere estar pendiente de la publicación de resultados en el Portal Web Institucional de acuerdo al cronograma establecido." . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Atentamente" . '<br>';
                            $text_body2 .= "" . '<br>';
                            $text_body2 .= "Comité de Evaluación y Selección.";

                            $mailer_u = new mailer($this->di);
                            $mailer_u->setSubject("Registro de Postulación {$this->config->global->xAbrevIns} Convocatorias");
                            $mailer_u->setTo($email_usuario, $email_usuario);
                            $mailer_u->setBody($text_body2);
                            if ($mailer_u->send()) {
                                //return true;
                            } else {
                                echo $mailer->getError();
                                echo "error";
                            }

                            //archivo
                            $nro_doc = $Publico->nro_doc;

                            if ($file->getKey() == "archivo") {

                                //$file->getName() = $Resoluciones->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();

                                $filex = new SplFileInfo($file->getName());

                                //echo "<pre>";
                                //print_r($filex->getExtension());
                                //exit();

                                if ($filex->getExtension() == 'pdf') {

                                    if (isset($ConvocatoriasPublico->anexos)) {
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/' . $ConvocatoriasPublico->anexos;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '-' . $temporal_rand . '.pdf';
                                        $ConvocatoriasPublico->anexos = 'ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/convocatorias_publico/ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '.pdf';
                                        $ConvocatoriasPublico->anexos = 'ANX-' . $ConvocatoriasPublico->convocatoria . '-' . $nro_doc . '.pdf';
                                    }

                                    if (isset($url_destino)) {
                                        if (!$file->moveTo($url_destino)) {

                                        }
                                    }
                                }
                            }
                        }

                        $ConvocatoriasPublico->save();
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

    //------------------------postulaciones-------------------------------------
    public function postulacionesAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/registrocv.postulaciones.js?v" . uniqid());
    }

    //datatablepostulaciones
    public function datatablepostulacionesAction()
    {
        $publico = $this->session->get("auth")["codigo"];
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("convocatorias.id_convocatoria");
            $datatable->setSelect("convocatorias.id_convocatoria, convocatorias.fecha_hora, convocatorias.titulo, "
                . "convocatorias_perfiles.nombre, convocatorias_perfiles.nombre_corto, "
                . "convocatorias.estado, convocatorias_perfiles.estado, convocatorias_perfiles.codigo, convocatorias.archivo, "
                . "convocatorias_publico.fecha, convocatorias_publico.anexos");
            $datatable->setFrom("tbl_web_convocatorias convocatorias "
                . "INNER JOIN tbl_web_convocatorias_perfiles convocatorias_perfiles ON convocatorias_perfiles.convocatoria = convocatorias.id_convocatoria "
                . "INNER JOIN tbl_web_convocatorias_publico convocatorias_publico ON convocatorias_publico.convocatoria = convocatorias.id_convocatoria "
                . "AND convocatorias_publico.perfil = convocatorias_perfiles.codigo");
            //$datatable->setWhere("convocatorias.etapa = 1 AND convocatorias_publico.publico = {$publico}");
            $datatable->setWhere("convocatorias_publico.publico = {$publico}");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //descarga de archivos de datos personales
    public function getArchivosDatosPersonalesAction($publico = null, $datos_personales = null)
    {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        //$publico_ganador = Publico::findFirstBycodigo($publico);
        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($datos_personales == "A") {
            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip", ZipArchive::CREATE);
            //$dir = 'adminpanel/archivos/convocatorias/documentos/personales/';
            //$zip->addEmptyDir($dir);

            if ($publico_file->archivo !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo, "1-" . $publico_file->archivo);
            }

            if ($publico_file->archivo_ruc !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_ruc, "2-" . $publico_file->archivo_ruc);
            }

            if ($publico_file->archivo_cp !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_cp, "3-" . $publico_file->archivo_cp);
            }

            if ($publico_file->archivo_dc !== null) {
                $zip->addFile("adminpanel/archivos/publico/personales/" . $publico_file->archivo_dc, "4-" . $publico_file->archivo_dc);
            }

            $zip->close();

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-datos-personales.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-datos-personales.zip");
        }
    }

    //descarga de archivos formacion academica
    public function getArchivosFormacionAction($publico = null, $formacion = null)
    {

        $this->view->disable();

        //print("Publico:".$publico." - Formacion:".$formacion);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($formacion == "A") {

            $zip = new ZipArchive();

            try {
                $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip", ZipArchive::CREATE);
            } catch (Exception $ex) {
                print($ex->getMessage());
                exit();
            }

            $PublicoFormacionSql = $this->modelsManager->createQuery("SELECT
                                                publico_formacion.fecha_grado,
                                                publico_formacion.archivo
                                                FROM
                                                PublicoFormacion publico_formacion
                                                WHERE
                                                publico_formacion.estado = 'A'
                                                AND publico_formacion.publico = {$publico_file->codigo} ORDER BY publico_formacion.fecha_grado DESC");
            //print($PublicoFormacionSql);
            //exit();
            $PublicoFormacionResult = $PublicoFormacionSql->execute();

//            foreach ($PublicoFormacionResult as $value) {
            //                echo '<pre>';
            //                print_r($value->archivo);
            //            }
            //            exit();

            $num_file_formacion = 1;
            foreach ($PublicoFormacionResult as $PublicoFormacion) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoFormacion->archivo !== null) {
                    try {
                        $zip->addFile("adminpanel/archivos/publico/formacion/" . $PublicoFormacion->archivo, "{$num_file_formacion}-" . $PublicoFormacion->archivo);
                    } catch (Exception $ex) {
                        print($ex->getMessage());
                        exit();
                    }
                }
                $num_file_formacion++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-formacion-academica.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-formacion-academica.zip");
        }
    }

    //descarga de archivos capacitaciones
    public function getArchivosCapacitacionesAction($publico = null, $capacitaciones = null)
    {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($capacitaciones == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip", ZipArchive::CREATE);

            $PublicoCapacitacionesSql = $this->modelsManager->createQuery("SELECT
                                                    publico_capacitaciones.fecha_inicio,
                                                    publico_capacitaciones.archivo
                                                    FROM
                                                    PublicoCapacitaciones publico_capacitaciones
                                                    WHERE
                                                    publico_capacitaciones.estado = 'A'
                                                    AND publico_capacitaciones.publico = {$publico_file->codigo} ORDER BY publico_capacitaciones.fecha_inicio DESC");
            $PublicoCapacitacionesResult = $PublicoCapacitacionesSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoCapacitacionesResult as $PublicoCapacitaciones) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoCapacitaciones->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/capacitaciones/" . $PublicoCapacitaciones->archivo, "{$num_file_capacitaciones}-" . $ublicoCapacitaciones->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-capacitaciones.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-capacitaciones.zip");
        }
    }

    //descarga de archivos de experiencia
    public function getArchivosExperienciaAction($publico = null, $experiencia = null)
    {
        $this->view->disable();
        //print("Publico:".$publico." - Datos Personales:".$datos_personales." - Formacion:".$formacion." - Capacitaciones:".$capacitaciones." - Experiencia:".$experiencia);
        //exit();

        $publico_file = Publico::findFirstBycodigo($publico);
        //$ganador = ConvocatoriasPublico::findFirstBypublico($publico_ganador->codigo);

        if ($experiencia == "A") {

            $zip = new ZipArchive();
            $zip->open("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip", ZipArchive::CREATE);

            $PublicoExperienciaSql = $this->modelsManager->createQuery("SELECT
                                                publico_experiencia.fecha_inicio,
                                                publico_experiencia.archivo
                                                FROM
                                                PublicoExperiencia publico_experiencia
                                                WHERE
                                                publico_experiencia.estado = 'A'
                                                AND publico_experiencia.publico = {$publico_file->codigo} ORDER BY publico_experiencia.fecha_inicio DESC");
            $PublicoExperienciaResult = $PublicoExperienciaSql->execute();
            $num_file_capacitaciones = 1;
            foreach ($PublicoExperienciaResult as $PublicoExperiencia) {
                //$ConvocatoriasPublicoFormacion->archivo;
                if ($PublicoExperiencia->archivo !== null) {
                    $zip->addFile("adminpanel/archivos/publico/experiencia/" . $PublicoExperiencia->archivo, "{$num_file_capacitaciones}-" . $PublicoExperiencia->archivo);
                }
                $num_file_capacitaciones++;
            }

            $zip->close();
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename={$publico_file->nro_doc}-experiencia.zip");
            readfile("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
            unlink("adminpanel/archivos/convocatorias/temporal/" . $publico_file->nro_doc . "-experiencia.zip");
        }
    }

    //

}
