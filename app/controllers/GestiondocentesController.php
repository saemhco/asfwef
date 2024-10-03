<?php

class GestiondocentesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestiondocentes.js?v=" . uniqid());
    }

    public function indexAction($sem) {
        $semestre_a = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $this->view->semestrea = $semestre_a->codigo;

        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
    }

    //Funcion para agregar docente y editar
    public function registroAction($semestre, $docente) {

        //Docente
        $docentes = Docentes::findFirstBycodigo((int) $docente);
        $this->view->docentes = $docentes;

        $this->view->semestre = $semestre;

        //Modelo documento(a_codigos)
        $documentos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentos = $documentos;

        //Modelo sexo(a_codigos)
        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguros;


        //Docentes semestre
        $DocentesSemestre = DocentesSemestre::findFirst(
                        [
                            "semestre = $semestre AND docente = $docente",
                        ]
        );
        $this->view->docentes_semestre = $DocentesSemestre;

        //Modelo condiciones(a_codigos)
        $condiciones = CondicionesDocente::find("estado = 'A' AND numero = 11");
        $this->view->condiciones = $condiciones;

        //Modelo Categoria(a_codigos)
        $categoriasdocentes = CategoriasDocentes::find("estado = 'A' AND numero = 5");
        $this->view->categoriasdocentes = $categoriasdocentes;

        //Modelo Regimen docentes(a_codigos)
        $regimendocentes = Regimendocentes::find("estado = 'A' AND numero = 12");
        $this->view->regimendocentes = $regimendocentes;

        //Modelo tipo_dependencia(a_codigos)
        $tipodependencias = TipoDependencias::find("estado = 'A' AND numero = 13");
        $this->view->tipodependencias = $tipodependencias;

        //Personal academico
        $PersonalAcademico = PersonalAcademico::find("estado = 'A' AND numero = 39");
        $this->view->personalacademico = $PersonalAcademico;

        //Cargo general
        $CargoGeneral = CargoGeneral::find("estado = 'A' AND numero = 44");
        $this->view->cargogeneral = $CargoGeneral;

        //Situacion grado academico otro
        $SituacionGradoAcademicoOtro = SituacionGradoAcademicoOtro::find("estado = 'A' AND numero = 38");
        $this->view->situaciongradoacademicootro = $SituacionGradoAcademicoOtro;

        //modalidad
        $ModalidadIngreso = ModalidadIngreso::find("estado = 'A' AND numero = 37");
        $this->view->modalidadingreso = $ModalidadIngreso;

        //identidad etnica
        $IdentidadEtnica = IdentidadEtnica::find("estado = 'A' AND numero = 56");
        $this->view->identidadetnica = $IdentidadEtnica;

        //Carrera
        $carreras = Carreras::find("estado = 'A'");
        $this->view->carreras = $carreras;
    }

    //Cargamos el datatables
    public function datatableAction($sem) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("docente");
            $datatable->setSelect("docentes_semestre.docente, "
                    . "docentes.apellidop,"
                    . "docentes.apellidom,"
                    . "docentes.nombres,"
                    . "docentes.nro_doc,"
                    . "docentes.celular,"
                    . "docentes.titulo,"
                    . "docentes_semestre.estado");
            $datatable->setFrom("docentes_semestre docentes_semestre
                INNER JOIN docentes docentes ON docentes_semestre.docente = docentes.codigo");
            $datatable->setWhere("docentes_semestre.semestre={$sem} AND docentes_semestre.estado ='A' ");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para guardar docente
    public function saveAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $semestre = (int) $this->request->getPost("semestre", "int");
                $docente = (int) $this->request->getPost("docente", "int");

                $DocentesSemestre = DocentesSemestre::findFirst(
                                [
                                    "semestre = {$semestre} AND docente = {$docente}"
                                ]
                );


                //Valida cuando es nuevo
                $DocentesSemestre = (!$DocentesSemestre) ? new DocentesSemestre() : $DocentesSemestre;

                $DocentesSemestre->semestre = $this->request->getPost("semestre", "int");
                $DocentesSemestre->docente = $this->request->getPost("docente", "int");




                $DocentesSemestre->cargo = $this->request->getPost("cargo", "string");

                if ($this->request->getPost("condicion", "int") == "") {
                    $DocentesSemestre->condicion = null;
                } else {
                    $DocentesSemestre->condicion = $this->request->getPost("condicion", "int");
                }

                if ($this->request->getPost("categoria", "int") == "") {
                    $DocentesSemestre->categoria = null;
                } else {
                    $DocentesSemestre->categoria = $this->request->getPost("categoria", "int");
                }


                if ($this->request->getPost("dedicacion", "int") == "") {
                    $DocentesSemestre->dedicacion = null;
                } else {
                    $DocentesSemestre->dedicacion = $this->request->getPost("dedicacion", "int");
                }


                if ($this->request->getPost("tipo_dependencia", "int") == "") {
                    $DocentesSemestre->tipo_dependencia = null;
                } else {
                    $DocentesSemestre->tipo_dependencia = $this->request->getPost("tipo_dependencia", "int");
                }


                $DocentesSemestre->dependencia = $this->request->getPost("dependencia", "string");


                if ($this->request->getPost("personal_academico", "int") == "") {
                    $DocentesSemestre->personal_academico = null;
                } else {
                    $DocentesSemestre->personal_academico = $this->request->getPost("personal_academico", "int");
                }

                if ($this->request->getPost("cargo_general", "int") == "") {
                    $DocentesSemestre->cargo_general = null;
                } else {
                    $DocentesSemestre->cargo_general = $this->request->getPost("cargo_general", "int");
                }


                if ($this->request->getPost("situacion_grado_academico_otro", "int") == "") {
                    $DocentesSemestre->situacion_grado_academico_otro = null;
                } else {
                    $DocentesSemestre->situacion_grado_academico_otro = $this->request->getPost("situacion_grado_academico_otro", "int");
                }

                if ($this->request->getPost("modalidad_ingreso", "int") == "") {
                    $DocentesSemestre->modalidad_ingreso = null;
                } else {
                    $DocentesSemestre->modalidad_ingreso = $this->request->getPost("modalidad_ingreso", "int");
                }

                if ($this->request->getPost("identidad_etnica", "int") == "") {
                    $DocentesSemestre->identidad_etnica = null;
                } else {
                    $DocentesSemestre->identidad_etnica = $this->request->getPost("identidad_etnica", "int");
                }


                if ($this->request->getPost("carrera", "string") == "") {
                    $DocentesSemestre->carrera = null;
                } else {
                    $DocentesSemestre->carrera = $this->request->getPost("carrera", "string");
                }

                $investigador = $this->request->getPost("investigador", "string");
                if (isset($investigador)) {
                    $DocentesSemestre->investigador = 1;
                } else {
                    $DocentesSemestre->investigador = 0;
                }

                $renacyt = $this->request->getPost("renacyt", "string");
                if (isset($renacyt)) {
                    $DocentesSemestre->renacyt = 1;
                } else {
                    $DocentesSemestre->renacyt = 0;
                }

                $pregrado = $this->request->getPost("pregrado", "string");
                if (isset($pregrado)) {
                    $DocentesSemestre->pregrado = 1;
                } else {
                    $DocentesSemestre->pregrado = 0;
                }

                $posgrado = $this->request->getPost("posgrado", "string");
                if (isset($posgrado)) {
                    $DocentesSemestre->posgrado = 1;
                } else {
                    $DocentesSemestre->posgrado = 0;
                }


                $c9 = $this->request->getPost("c9", "string");
                if (isset($c9)) {
                    $DocentesSemestre->c9 = 1;
                } else {
                    $DocentesSemestre->c9 = 0;
                }


                $destacado = $this->request->getPost("destacado", "string");
                if (isset($destacado)) {
                    $DocentesSemestre->destacado = 1;
                } else {
                    $DocentesSemestre->destacado = 0;
                }




                if ($this->request->getPost("hl1", "int") == "") {
                    $DocentesSemestre->hl1 = null;
                } else {
                    $DocentesSemestre->hl1 = $this->request->getPost("hl1", "int");
                }



                if ($this->request->getPost("hl2", "int") == "") {
                    $DocentesSemestre->hl2 = null;
                } else {
                    $DocentesSemestre->hl2 = $this->request->getPost("hl2", "int");
                }



                if ($this->request->getPost("hnl1", "int") == "") {
                    $DocentesSemestre->hnl1 = null;
                } else {
                    $DocentesSemestre->hnl1 = $this->request->getPost("hnl1", "int");
                }



                if ($this->request->getPost("hnl2", "int") == "") {
                    $DocentesSemestre->hnl2 = null;
                } else {
                    $DocentesSemestre->hnl2 = $this->request->getPost("hnl2", "int");
                }




                if ($this->request->getPost("hnl3", "int") == "") {
                    $DocentesSemestre->hnl3 = null;
                } else {
                    $DocentesSemestre->hnl3 = $this->request->getPost("hnl3", "int");
                }


                if ($this->request->getPost("hnl4", "int") == "") {
                    $DocentesSemestre->hnl4 = null;
                } else {
                    $DocentesSemestre->hnl4 = $this->request->getPost("hnl4", "int");
                }



                if ($this->request->getPost("hnl5", "int") == "") {
                    $DocentesSemestre->hnl5 = null;
                } else {
                    $DocentesSemestre->hnl5 = $this->request->getPost("hnl5", "int");
                }


                if ($this->request->getPost("hnl6", "int") == "") {
                    $DocentesSemestre->hnl6 = null;
                } else {
                    $DocentesSemestre->hnl6 = $this->request->getPost("hnl6", "int");
                }


                if ($this->request->getPost("hnl7", "int") == "") {
                    $DocentesSemestre->hnl7 = null;
                } else {
                    $DocentesSemestre->hnl7 = $this->request->getPost("hnl7", "int");
                }


                if ($this->request->getPost("hnl8", "int") == "") {
                    $DocentesSemestre->hnl8 = null;
                } else {
                    $DocentesSemestre->hnl8 = $this->request->getPost("hnl8", "int");
                }


                if ($this->request->getPost("hnl9", "int") == "") {
                    $DocentesSemestre->hnl9 = null;
                } else {
                    $DocentesSemestre->hnl9 = $this->request->getPost("hnl9", "int");
                }


                if ($this->request->getPost("hnl10", "int") == "") {
                    $DocentesSemestre->hnl10 = null;
                } else {
                    $DocentesSemestre->hnl10 = $this->request->getPost("hnl10", "int");
                }

                
                if ($this->request->getPost("hnl11", "int") == "") {
                    $DocentesSemestre->hnl11 = null;
                } else {
                  $DocentesSemestre->hnl11 = $this->request->getPost("hnl11", "int");
                }




                $act01 = $this->request->getPost("act01", "string");
                if (isset($act01)) {
                    $DocentesSemestre->act01 = 1;
                } else {
                    $DocentesSemestre->act01 = 0;
                }

                $act02 = $this->request->getPost("act02", "string");
                if (isset($act02)) {
                    $DocentesSemestre->act02 = 1;
                } else {
                    $DocentesSemestre->act02 = 0;
                }

                $act03 = $this->request->getPost("act03", "string");
                if (isset($act03)) {
                    $DocentesSemestre->act03 = 1;
                } else {
                    $DocentesSemestre->act03 = 0;
                }

                $act04 = $this->request->getPost("act04", "string");
                if (isset($act04)) {
                    $DocentesSemestre->act04 = 1;
                } else {
                    $DocentesSemestre->act04 = 0;
                }

                $act05 = $this->request->getPost("act05", "string");
                if (isset($act05)) {
                    $DocentesSemestre->act05 = 1;
                } else {
                    $DocentesSemestre->act05 = 0;
                }


                $act06 = $this->request->getPost("act06", "string");
                if (isset($act06)) {
                    $DocentesSemestre->act06 = 1;
                } else {
                    $DocentesSemestre->act06 = 0;
                }


                $act07 = $this->request->getPost("act07", "string");
                if (isset($act07)) {
                    $DocentesSemestre->act07 = 1;
                } else {
                    $DocentesSemestre->act07 = 0;
                }


                $act08 = $this->request->getPost("act08", "string");
                if (isset($act08)) {
                    $DocentesSemestre->act08 = 1;
                } else {
                    $DocentesSemestre->act08 = 0;
                }

                $DocentesSemestre->horario = $this->request->getPost("horario", "string");
                $DocentesSemestre->estado = "A";



                if ($DocentesSemestre->save() == false) {

                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($DocentesSemestre->getMessages());
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

    //Funcion para eliminar
    public function eliminarAction() {
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

}
