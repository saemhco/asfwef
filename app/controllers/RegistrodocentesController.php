<?php

class RegistrodocentesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrodocentes.js?v=" . uniqid());
    }

    public function indexAction()
    {
        $id = Docentes::count();
        // print($id);
        // exit();
        $this->view->id_docente = $id;
    }

    //Funcion para agregar docente y editar
    public function registroAction($id = null)
    {

        if ($id != null) {
            $docentes = Docentes::findFirstBycodigo((int) $id);
        } else {
            //$docentes = Asignaturas::findFirstBycodigo(0);
            //funcion para crear uevo registro
            //hacer consulta y enviar a la vista
            $docentes_registro = Docentes::findFirstBycodigo(NULL);

            $docentes_registro = Docentes::find([
                // "estado = 'A' ",
                "order" => "codigo DESC",
                "limit" => 1
            ]);

            //print($docente_registro[0]->codigo); exit();
            $docentes->codigo = $docentes_registro[0]->codigo + 1;
            $this->view->docentes = $docentes;
        }

        $this->view->docentes = $docentes;


        //Modelo documento(a_codigos)
        $documentos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentos = $documentos;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguros;

        //Modelo grado_academico(a_codigos)
        $grados = Grados::find("estado = 'A' AND numero = 8");
        $this->view->grados = $grados;

        //Modelo grado_maximo(a_codigos)
        $gradosm = Gradosm::find("estado = 'A' AND numero = 10");
        $this->view->gradosm = $gradosm;

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        $condiciones = CondicionesDocente::find("estado = 'A' AND numero = 11 ORDER BY nombres");
        $this->view->condiciones = $condiciones;

        $categorias = CategoriasDocentes::find("estado = 'A' AND numero = 5 ORDER BY nombres");
        $this->view->categorias = $categorias;

        $dedicaciones = Acodigos::find("estado = 'A' AND numero = 12 ORDER BY nombres");
        $this->view->dedicaciones = $dedicaciones;
    }

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("d.codigo");
            $datatable->setSelect("d.codigo, d.apellidop, d.apellidom, d.nombres, d.nro_doc, d.celular, d.titulo, d.estado, d.foto");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("docentes d");
            //$datatable->setWhere("a.estado = 'A' AND a.codigo > 0");
            //$datatable->setWhere("d.estado = 'A' AND aco.numero = 5 AND d.codigo > 0");
            $datatable->setWhere("d.codigo > 0");
            $datatable->setOrderby("d.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar docente
    public function saveAction()
    {

        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                //$Docentes = Docentes::findFirstBycodigo($id);
                //$Docentes = (!$Docentes) ? new Docentes() : $Docentes;
                //
                $Docentes = Docentes::findFirstBycodigo($id);

                if ($id == "") {


                    // print("Llega");
                    // exit(); 

                    $Docentes = new Docentes();
                    $id = Docentes::count();
                    $Docentes->codigo = $id + 1;
                    $Docentes->password = $this->security->hash($this->request->getPost("nro_doc", "string"));
                }



                $Docentes->documento = 1;


                if ($this->request->getPost("sexo", "int") == "") {
                    $Docentes->sexo = null;
                } else {
                    $Docentes->sexo = $this->request->getPost("sexo", "int");
                }

                if ($this->request->getPost("grado", "int") == "") {
                    $Docentes->grado = null;
                } else {
                    $Docentes->grado = $this->request->getPost("grado", "int");
                }

                if ($this->request->getPost("grado_otro", "int") == "") {
                    $Docentes->grado_otro = null;
                } else {
                    $Docentes->grado_otro = $this->request->getPost("grado_otro", "int");
                }

                if ($this->request->getPost("gradom", "int") == "") {
                    $Docentes->gradom = null;
                } else {
                    $Docentes->gradom = $this->request->getPost("gradom", "int");
                }

                if ($this->request->getPost("gradom_otro", "int") == "") {
                    $Docentes->gradom_otro = null;
                } else {
                    $Docentes->gradom_otro = $this->request->getPost("gradom_otro", "int");
                }

                
                $titulo_universitario = $this->request->getPost("titulo_universitario", "string");
                if (isset($titulo_universitario)) {
                    $Docentes->titulo_universitario = 1;
                } else {
                    $Docentes->titulo_universitario = 0;
                }


                if ($this->request->getPost("condicion", "int") == "") {
                    $Docentes->condicion = null;
                } else {
                    $Docentes->condicion = $this->request->getPost("condicion", "int");
                }

                if ($this->request->getPost("categoria", "int") == "") {
                    $Docentes->categoria = null;
                } else {
                    $Docentes->categoria = $this->request->getPost("categoria", "int");
                }

                if ($this->request->getPost("dedicacion", "int") == "") {
                    $Docentes->dedicacion = null;
                } else {
                    $Docentes->dedicacion = $this->request->getPost("dedicacion", "int");
                }

                if ($this->request->getPost("tipo_dependencia", "int") == "") {
                    $Docentes->tipo_dependencia = null;
                } else {
                    $Docentes->tipo_dependencia = $this->request->getPost("tipo_dependencia", "int");
                }

                if ($this->request->getPost("seguro", "int") == "") {
                    $Docentes->seguro = null;
                } else {
                    $Docentes->seguro = $this->request->getPost("seguro", "int");
                }

                if ($this->request->getPost("modalidad", "int") == "") {
                    $Docentes->modalidad = null;
                } else {
                    $Docentes->modalidad = $this->request->getPost("modalidad", "int");
                }

                if ($this->request->getPost("perfil", "int") == "") {
                    $Docentes->perfil = null;
                } else {
                    $Docentes->perfil = $this->request->getPost("perfil", "int");
                }


                if ($this->request->getPost("concytec_enlace", "int") == "") {
                    $Docentes->concytec_enlace = null;
                } else {
                    $Docentes->concytec_enlace = $this->request->getPost("concytec_enlace", "int");
                }


                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $Docentes->colegio_profesional = null;
                } else {
                    $Docentes->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }

                if ($this->request->getPost("moodle", "int") == "") {
                    $Docentes->moodle = null;
                } else {
                    $Docentes->moodle = $this->request->getPost("moodle", "int");
                }

                if ($this->request->getPost("rol", "int") == "") {
                    $Docentes->rol = null;
                } else {
                    $Docentes->rol = $this->request->getPost("rol", "int");
                }

                if ($this->request->getPost("afp", "int") == "") {
                    $Docentes->afp = null;
                } else {
                    $Docentes->afp = $this->request->getPost("afp", "int");
                }



                $Docentes->nro_doc = $this->request->getPost("nro_doc", "string");
                $Docentes->apellidop = $this->request->getPost("apellidop", "string");
                $Docentes->apellidom = $this->request->getPost("apellidom", "string");
                $Docentes->nombres = $this->request->getPost("nombres", "string");
                $Docentes->direccion = $this->request->getPost("direccion", "string");
                $Docentes->ciudad = $this->request->getPost("ciudad", "string");



                $Docentes->pais = $this->request->getPost("pais", "string");
                $Docentes->telefono = $this->request->getPost("telefono", "string");
                $Docentes->celular = $this->request->getPost("celular", "string");
                $Docentes->email = $this->request->getPost("email", "string");
                $Docentes->email1 = $this->request->getPost("email1", "string");



                $Docentes->nro_seguro = $this->request->getPost("nro_seguro", "string");
                $Docentes->titulo = $this->request->getPost("titulo", "string");
                $Docentes->observaciones = $this->request->getPost("observaciones");


                $ley30220 = $this->request->getPost("ley30220", "string");

                if (isset($ley30220)) {
                    $Docentes->ley30220 = 1;
                } else {
                    $Docentes->ley30220 = 0;
                }


                if ($this->request->getPost("fecha_ingreso", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_ingreso", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Docentes->fecha_ingreso = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Docentes->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }


                $Docentes->grado_mencion_mayor = $this->request->getPost("grado_mencion_mayor", "string");
                $Docentes->grado_mencion_otro = $this->request->getPost("grado_mencion_otro", "string");
                $Docentes->grado_universidad_mayor = $this->request->getPost("grado_universidad_mayor", "string");
                $Docentes->grado_universidad_otro = $this->request->getPost("grado_universidad_otro", "string");
                $Docentes->pais_universidad_mayor = $this->request->getPost("pais_universidad_mayor", "string");
                $Docentes->pais_universidad_otro = $this->request->getPost("pais_universidad_otro", "string");


                $dina = $this->request->getPost("dina", "string");
                if (isset($dina)) {
                    $Docentes->dina = 1;
                } else {
                    $Docentes->dina = 0;
                }

                $maestria = $this->request->getPost("maestria", "string");
                if (isset($maestria)) {
                    $Docentes->maestria = 1;
                } else {
                    $Docentes->maestria = 0;
                }


                $doctorado = $this->request->getPost("doctorado", "string");
                if (isset($doctorado)) {
                    $Docentes->doctorado = 1;
                } else {
                    $Docentes->doctorado = 0;
                }

                $Docentes->estado = "A";

                //colegio_profesional


                //colegio_profesional_nro
                $Docentes->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");



                $Docentes->grado_abreviado = $this->request->getPost("grado_abreviado", "string");
                $Docentes->enlace = $this->request->getPost("enlace", "string");

                $visible = $this->request->getPost("visible", "string");
                if (isset($visible)) {
                    $Docentes->visible = 1;
                } else {
                    $Docentes->visible = 0;
                }



                if ($Docentes->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Docentes->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();

                            $temporal_rand = mt_rand(100000, 999999);

                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Docentes->foto)) {
                                        $url_destino = 'adminpanel/imagenes/docentes/' . $Docentes->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.jpg';
                                        $Docentes->foto = 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '.jpg';
                                        $Docentes->foto = 'IMG' . '-' . $Docentes->codigo . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Docentes->foto)) {
                                        $url_destino = 'adminpanel/imagenes/docentes/' . $Docentes->foto;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.png';
                                        $Docentes->foto = 'IMG' . '-' . $Docentes->codigo . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/docentes/' . 'IMG' . '-' . $Docentes->codigo . '.png';
                                        $Docentes->foto = 'IMG' . '-' . $Docentes->codigo . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $Docentes->nombre;
                                //$url_destino = 'adminpanel/imagenes/docentes/' . $Docentes->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($Docentes->archivo)) {

                                        $url_destino = 'adminpanel/archivos/docentes/' . $Docentes->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/docentes/' . 'FILE' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.pdf';

                                        $Docentes->archivo = 'FILE' . '-' . $Docentes->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        //$file->getName() = $Resoluciones->nombre;
                                        //$url_destino = 'adminpanel/imagenes/docentes/' . $Resoluciones->id_resolucion . "-" . $file->getName();
                                        $url_destino = 'adminpanel/archivos/docentes/' . 'FILE' . '-' . $Docentes->codigo . '.pdf';

                                        $Docentes->archivo = 'FILE' . '-' . $Docentes->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $Docentes->save();
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

    //Funcion para eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Docentes = Docentes::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Docentes && $Docentes->estado = 'A') {
                $Docentes->estado = 'X';
                $Docentes->save();
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

    //validar docentes registrado
    public function docentesRegistradoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Docentes = Docentes::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($Docentes) {
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
}
