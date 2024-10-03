<?php

class RegistrocontratosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrocontratos.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_contrato");
            $datatable->setSelect("id_contrato, tipo, numero, anio, fecha_inicio, fecha_fin, personal, estado, archivo");
            $datatable->setFrom("(SELECT contratos.id_contrato,
                tipo.nombres AS tipo,contratos.numero AS numero,
                contratos.anio AS anio,contratos.fecha_inicio AS fecha_inicio,
                contratos.fecha_fin AS fecha_fin,
                CONCAT (personal.apellidop,' ', personal.apellidom,' ',personal.nombres) AS personal,
                contratos.estado AS estado,
                contratos.archivo AS archivo
                FROM tbl_per_contratos AS contratos INNER JOIN a_codigos tipo ON tipo.codigo = contratos.tipo 
                INNER JOIN tbl_web_personal personal ON personal.codigo = contratos.personal WHERE tipo.numero = 60) AS tempx");
            //$datatable->setWhere("tipo.numero = 60");
            $datatable->setOrderby("anio desc, tipo, fecha_inicio DESC, numero DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function registroAction($id1 = null, $id2 = null) {
        $this->view->id1 = $id1;
        $this->view->id2 = $id2;

        //cuando se va editar
        if ($id1 != null && $id2 != null) {

            //$objetivosei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $Contratos = Contratos::findFirst(
                            [
                                "id_contrato = $id1 AND anio = $id2"
                            ]
            );

            //echo '<pre>';
            //print_r($resoluciones->codigo);
            //exit();
        }

        $this->view->contratos = $Contratos;

        //Tipo
        $TipoContratosP = TipoContratosP::find("estado = 'A' AND numero = 60 ORDER BY nombres");
        $this->view->tipocontratos = $TipoContratosP;


        $fecha_actual = date('d/m/Y');
        //$anio_actual_result = explode('-', $anio_actual);
        $this->view->fecha_actual = $fecha_actual;


        //Personal detalle
        $Personal = Personal::find("estado = 'A' ORDER BY apellidop, apellidom, nombres DESC");
        $this->view->personal_model = $Personal;

        //Area
        $Areas = Areas::find("estado = 'A' ORDER BY nombres");
        $this->view->areas = $Areas;

        //Condicion trabajo
        $CondicionTrabajoP = CondicionTrabajoP::find("estado = 'A' AND numero = 61 ORDER BY nombres");
        $this->view->condicion_trabajo = $CondicionTrabajoP;

        //Regimen trabajo
        $RegimenTrabajoP = RegimenTrabajoP::find("estado = 'A' AND numero = 62 ORDER BY nombres");
        $this->view->regimen_trabajo = $RegimenTrabajoP;

        //Tipo dependencia
        $TipoDependenciaP = TipoDependenciaP::find("estado = 'A' AND numero = 63 ORDER BY nombres");
        $this->view->tipodependencia_trabajo = $TipoDependenciaP;

        //Carreras
        $Carreras = Carreras::find("estado = 'A' ORDER BY descripcion");
        $this->view->carreras = $Carreras;

        //Cargo general cargo_general
        $CargoGeneralP = CargoGeneralP::find("estado = 'A' AND numero = 68 ORDER BY nombres");
        $this->view->cargogeneral = $CargoGeneralP;

        //Categoria Lboral
        $CategoriaLaboralP = CategoriaLaboralP::find("estado = 'A' AND numero = 59 ORDER BY nombres");
        $this->view->categorialaboral = $CategoriaLaboralP;

        //categoria_laboral
        $Locales = Locales::find("estado = 'A' ORDER BY nombres");
        $this->view->locales = $Locales;

        $this->assets->addJs("adminpanel/js/modulos/registrocontratos.adenda.js?v=" . uniqid());
    }

    //Funcion guardar
    public function saveAction() {


    //    echo "<pre>";
    //    print_r($_POST);
    //    exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("id_contrato", "int");
                $id2 = (int) $this->request->getPost("anio", "int");
                //$Contratos = Resoluciones::findFirstBycodigo($id);
                //echo '<pre>';
                //print_r("llegan: " . $id . '-' . $id2);
                //exit();


                $Contratos = Contratos::findFirst(
                                [
                                    "id_contrato = $id AND anio = $id2"
                                ]
                );

                //echo '<pre>';
                //print_r($Contratos->archivo);
                //exit();
                //Valida cuando es nuevo
                $Contratos = (!$Contratos) ? new Contratos() : $Contratos;


                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex_inicio = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex_inicio[2] . "-" . $fecha_ex_inicio[1] . "-" . $fecha_ex_inicio[0];
                    
                    $Contratos->anio = $fecha_ex_inicio[2];
                    $Contratos->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }



                $digito = $this->request->getPost("numero", "string");

                $digito_cero = strlen($digito);
                if ($digito_cero == 1) {
                    $Contratos->numero = '000' . $digito;
                } elseif ($digito_cero == 2) {
                    $Contratos->numero = '00' . $digito;
                } elseif ($digito_cero == 3) {
                    $Contratos->numero = '0' . $digito;
                } elseif ($digito_cero == 4) {
                    $Contratos->numero = $digito;
                }
                $Contratos->tipo = $this->request->getPost("tipo", "int");
                $Contratos->perfil = $this->request->getPost("perfil");
                $Contratos->certificacion = $this->request->getPost("certificacion", "string");
                $Contratos->concurso = $this->request->getPost("concurso", "string");
                $Contratos->resolucion = $this->request->getPost("resolucion", "string");

                $confianza = $this->request->getPost("confianza", "string");
                if (isset($confianza)) {
                    $Contratos->confianza = "1";
                } else {
                    $Contratos->confianza = "0";
                }

                $Contratos->personal = $this->request->getPost("personal", "int");


                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Contratos->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }
                $Contratos->area = $this->request->getPost("area", "int");
                $Contratos->condicion = $this->request->getPost("condicion", "int");


                if ($this->request->getPost("regimen", "int") == "") {
                    $Contratos->regimen = null;
                } else {
                    $Contratos->regimen = $this->request->getPost("regimen", "int");
                }

                $Contratos->tipo_dependencia = $this->request->getPost("tipo_dependencia", "int");

                $Contratos->dependencia = $this->request->getPost("dependencia", "string");


                if ($this->request->getPost("carrera", "string") == "") {
                    $Contratos->carrera = null;
                } else {
                    $Contratos->carrera = $this->request->getPost("carrera", "string");
                }


                $Contratos->cargo_general = $this->request->getPost("cargo_general", "int");
                $Contratos->cargo = $this->request->getPost("cargo", "string");

                $Contratos->categoria_laboral = $this->request->getPost("categoria_laboral", "int");
                $Contratos->modalidad = $this->request->getPost("modalidad", "int");
                $Contratos->local = $this->request->getPost("local", "int");
                $Contratos->estado = "A";
                $Contratos->contrato = $this->request->getPost("contrato", "string");

                //echo '<pre>';
                //print_r("Testing");
                //exit();

                $Contratos->monto = $this->request->getPost("monto", "string");

                $visado = $this->request->getPost("visado", "string");
                if (isset($visado)) {
                    $Contratos->visado = "1";
                } else {
                    $Contratos->visado = "0";
                }

                //nivel_remunerativo
                $Contratos->nivel_remunerativo = $this->request->getPost("nivel_remunerativo", "string");


                if ($Contratos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Contratos->getMessages());
                } else {
                    //Cuando va bien 
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //Partida de nacimiento
                            //$archivo = $this->request->getPost("archivo", "string");

                            $temporal_rand = mt_rand(100000, 999999);
                            $xAbrevIns = $this->config->global->xAbrevIns;

                            //imagen
                            if ($file->getKey() == "imagen") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {

                                    if (isset($Contratos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . $Contratos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . '.jpg';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . ".jpg";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '.jpg';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . ".jpg";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                } elseif ($filex->getExtension() == 'png') {

                                    if (isset($Contratos->imagen)) {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . $Contratos->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . '.png';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '-' . $temporal_rand . ".png";
                                    } else {
                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos/' . 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . '.png';
                                        $Contratos->imagen = 'IMG' . '-' . $Contratos->tipo . '-' . $Contratos->numero . '-' . $Contratos->anio . ".png";
                                    }

                                    //
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Galerias->imagen = $Galerias->id_galeria . "-" . $file->getName();
                                        //$Galerias->imagen = 'IMG' . '-' . $Galerias->id_galeria . ".jpg";
                                    }
                                    //
                                }

                                //$file->getName() = $Contratos->nombre;
                                //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Contratos->codigo . "-" . $file->getName();
                            }


                            //$Contratos->archivo = 1;
                            //Grabamos la foto

                            if ($this->request->getPost("tipo", "int") == 1) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 2) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "CONTRATO ADMINISTRATIVO DE SERVICIOS - CONFIANZA" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 3) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "LOCACION DE SERVICIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 4) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "AUTORIDADES" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                    //
                                }
                            } elseif ($this->request->getPost("tipo", "int") == 5) {
                                if ($file->getKey() == "archivo") {

                                    $filex = new SplFileInfo($file->getName());

                                    //
                                    if ($filex->getExtension() == 'pdf') {

                                        //echo '<pre>';
                                        //print_r("Nombre resolucion: ".$Contratos->archivo);
                                        //exit();

                                        if (isset($Contratos->archivo)) {

                                            //echo '<pre>';
                                            //print_r("El archivo existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . $Contratos->archivo;

                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }

                                            $url_destino = 'adminpanel/archivos/contratos/' . "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                            $Contratos->archivo = "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '-' . $temporal_rand . '.pdf';
                                        } else {

                                            //echo '<pre>';
                                            //print_r("El archivo no existe");
                                            //exit();

                                            $url_destino = 'adminpanel/archivos/contratos/' . "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                            $Contratos->archivo = "FUNCIONARIOS" . '-' . $Contratos->numero . '-' . $fecha_ex_inicio[2] . '-' . $xAbrevIns . '.pdf';
                                        }

                                        if (!$file->moveTo($url_destino)) {
                                            
                                        }
                                    }
                                    //
                                }
                            }
                        }

                        $Contratos->save();
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

    //verifica
    public function numeroContratoAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $numero = $this->request->getPost('numero');
            $tipo = $this->request->getPost('tipo');
            $anio = (int) $this->request->getPost('anio');

            //echo '<pre>';
            //print_r("Numero:" . $numero . "- Tipo:" . $tipo . " - Anio:" . $anio);
            //exit();

            /*
              $NumeroResolucion = Resoluciones::findFirst(
              [
              "numero = :numero: AND tipo = :tipo: ",
              'bind' => [
              'numero' => $numero,
              'tipo' => $tipo
              ]
              ]
              );
             */

            $NumeroResolucion = Contratos::findFirst(
                            [
                                "numero = $numero AND tipo = $tipo AND anio = $anio "
                            ]
            );

            //echo '<pre>';
            //print_r($NumeroResolucion->codigo . $NumeroResolucion->tipo);
            //exit();

            if ($NumeroResolucion) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {

                //echo '<pre>';
                //print_r('Testing');
                //exit();
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //Eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$Contratos = Resoluciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $Contratos = Contratos::findFirst(
                            [
                                "id_contrato = '$id' AND anio = $id2"
                            ]
            );

            if ($Contratos && $Contratos->estado = 'A') {
                $Contratos->estado = 'X';
                $Contratos->save();
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

    public function getContratosAction() {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $anio = (int) $this->request->getPost("anio", "int");

            $contratos = Contratos::count(
                            [
                                "anio = $anio "
                            ]
            );

            //echo '<pre>';
            //print_r($contratos);
            //exit();

            if ($contratos >= 0) {

                //print("Test");
                //exit();

                $codigo = $contratos + 1;

                $this->response->setJsonContent(array("say" => "si", "codigo" => $codigo));
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

    public function verificapdfAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $archivo = $this->request->getPost("file_pdf");

            //echo '<pre>';
            //print_r($archivo);
            //exit();

            $file_pdf = new SplFileInfo($archivo);

            //echo '<pre>';
            //print_r($file_pdf->getExtension());
            //exit();

            if ($file_pdf->getExtension() != 'pdf') {
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

    //adenda nuevo
    public function getNewAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $contrato = (int) $this->request->getPost("contrato", "int");
            $anio = (int) $this->request->getPost("anio", "int");

            $ContratosAdendas = ContratosAdendas::count();

//            echo '<pre>';
//            print_r("Contrato:" . $contrato . " - Anio:" . $anio);
//            exit();

            $num = ContratosAdendas::count(
                            [
                                "contrato = {$contrato} AND anio = {$anio}"
                            ]
            );

            if ($ContratosAdendas >= 0 AND $num >= 0) {

                $codigo = $ContratosAdendas + 1;

                $numero = $num + 1;

                $this->response->setJsonContent(array("say" => "yes", "codigo" => $codigo, "numero" => $numero));
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

    public function datatableAdendasAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("contratos_adendas.id_contrato_adenda");
            $datatable->setSelect("contratos_adendas.id_contrato_adenda,contratos_adendas.id_contrato,"
                    . "contratos_adendas.numero,contratos_adendas.fecha_inicio,"
                    . "contratos_adendas.fecha_fin,contratos_adendas.numero,contratos_adendas.adenda,contratos_adendas.estado");
            $datatable->setFrom("tbl_per_contratos_adendas contratos_adendas ");
            $datatable->setWhere("contratos_adendas.id_contrato = {$id}");
            $datatable->setOrderby("contratos_adendas.id_contrato_adenda ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //guardar personal familiar
    public function saveAdendasAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_contrato_adenda", "int");
                $ContratosAdendas = ContratosAdendas::findFirstByid_contrato_adenda($id);
                $ContratosAdendas = (!$ContratosAdendas) ? new ContratosAdendas() : $ContratosAdendas;

                $ContratosAdendas->id_contrato = $this->request->getPost("id_contrato", "int");
                $digito = $this->request->getPost("numero", "string");

                $digito_cero = strlen($digito);
                if ($digito_cero == 1) {
                    $ContratosAdendas->numero = '000' . $digito;
                } elseif ($digito_cero == 2) {
                    $ContratosAdendas->numero = '00' . $digito;
                } elseif ($digito_cero == 3) {
                    $ContratosAdendas->numero = '0' . $digito;
                } elseif ($digito_cero == 4) {
                    $ContratosAdendas->numero = $digito;
                }


                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $ContratosAdendas->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                //fecha_fin
                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $ContratosAdendas->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                //adenda
                $ContratosAdendas->adenda = $this->request->getPost("adenda", "string");

                //certificacion
                $ContratosAdendas->certificacion = $this->request->getPost("certificacion", "string");

                //resolucion
                $ContratosAdendas->resolucion = $this->request->getPost("resolucion", "string");


                //visado
                $visado = $this->request->getPost("visado_adenda", "string");
                if (isset($visado)) {
                    $ContratosAdendas->visado = 1;
                } else {
                    $ContratosAdendas->visado = 0;
                }

                $ContratosAdendas->estado = "A";

                //anio
                $ContratosAdendas->anio = $this->request->getPost("anio", "int");

                if ($ContratosAdendas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($ContratosAdendas->getMessages());
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
                                    if (isset($ContratosAdendas->imagen)) {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . $ContratosAdendas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->codigo . '-' . $temporal_rand . '.jpg';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->codigo . '-' . $temporal_rand . '.jpg';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->codigo . '.jpg';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->codigo . '.jpg';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    if (isset($ContratosAdendas->imagen)) {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . $ContratosAdendas->imagen;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->codigo . '-' . $temporal_rand . '.png';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->codigo . '-' . $temporal_rand . '.png';
                                    } else {

                                        $url_destino = 'adminpanel/imagenes/imagenes_contratos_adendas/' . 'IMG' . '-' . $ContratosAdendas->codigo . '.png';
                                        $ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->codigo . '.png';
                                    }


                                    if (!$file->moveTo($url_destino)) {
                                        
                                    } else {
                                        //$Noticias->imagen = $Noticias->id_noticia . "-" . $file->getName();
                                        //$ContratosAdendas->imagen = 'IMG' . '-' . $ContratosAdendas->codigo . ".jpg";
                                    }
                                }

                                //$file->getName() = $Noticias->nombre;
                                //$url_destino = 'adminpanel/imagenes/imagenes_docentes/' . $Noticias->codigo . "-" . $file->getName();
                            }

                            //archivo
                            if ($file->getKey() == "archivo") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($ContratosAdendas->archivo)) {

                                        $url_destino = 'adminpanel/archivos/contratos_adendas/' . $ContratosAdendas->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }

                                        $url_destino = 'adminpanel/archivos/contratos_adendas/' . 'FILE' . '-' . $ContratosAdendas->codigo . '-' . $temporal_rand . '.pdf';
                                        $ContratosAdendas->archivo = 'FILE' . '-' . $ContratosAdendas->codigo . '-' . $temporal_rand . '.pdf';
                                    } else {

                                        $url_destino = 'adminpanel/archivos/contratos_adendas/' . 'FILE' . '-' . $ContratosAdendas->codigo . '.pdf';
                                        $ContratosAdendas->archivo = 'FILE' . '-' . $ContratosAdendas->codigo . '.pdf';
                                    }
                                    if (!$file->moveTo($url_destino)) {
                                        
                                    }
                                }
                            }
                        }

                        $ContratosAdendas->save();
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

    //editar personal_permisos
    public function getAjaxContratosAdendasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ContratosAdendas::findFirstByid_contrato_adenda((int) $this->request->getPost("id", "int"));
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

    //eliminar
    public function eliminarContratosAdendasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = ContratosAdendas::findFirstByid_contrato_adenda((int) $this->request->getPost("id", "int"));
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
