<?php

class RegistrohistoriasclinicasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }


    public function registroAction($id = null)
    {

        $this->view->id = $id;
        if ($id != null) {

            $historiaClinica = HistoriaClinica::findFirstBynro_doc("$id");

            $alumnos = Alumnos::findFirst("nro_doc = '{$id}'");

            $docentes = Docentes::findFirstBynro_doc("$id");

            $db1 = $this->db;
            $sqlQuery1 = "SELECT
                public.tbl_web_personal.codigo,
                public.tbl_web_personal.apellidop,
                public.tbl_web_personal.apellidom,
                public.tbl_web_personal.nombres,
                public.tbl_web_personal.fecha_nacimiento,
                public.tbl_web_personal.sexo,
                public.tbl_web_personal.direccion_actual AS direccion,
                public.tbl_web_personal.lugar_nacimiento AS ciudad,
                public.tbl_web_personal.celular,
                public.tbl_web_personal.telefono_emergencia AS telefono,
                public.tbl_web_personal.email,
                public.tbl_web_personal.email1,
                public.tbl_web_personal.seguro,
                public.tbl_web_personal.documento,
                public.tbl_web_personal.nro_doc,
                public.tbl_web_personal.imagen AS foto
                FROM
                public.tbl_web_personal
                WHERE
                public.tbl_web_personal.nro_doc = '$id'";
            $personal = $db1->fetchOne($sqlQuery1, Phalcon\Db::FETCH_OBJ);


            $db2 = $this->db;
            $sqlQuery2 = "SELECT
                public.publico.codigo,
                public.publico.apellidop,
                public.publico.apellidom,
                public.publico.nombres,
                public.publico.fecha_nacimiento,
                public.publico.sexo,
                public.publico.direccion,
                public.publico.ciudad,
                public.publico.celular,
                public.publico.telefono,
                public.publico.email,
                ''AS email1,
                public.publico.seguro,
                public.publico.documento,
                public.publico.nro_doc,
                public.publico.foto
                FROM
                public.publico
                WHERE
                public.publico.nro_doc = '$id'";
            $publico = $db2->fetchOne($sqlQuery2, Phalcon\Db::FETCH_OBJ);


            if ($alumnos->nro_doc) {
                $this->view->paciente = $alumnos;
                // print("Alumno");
                // exit();
                $this->view->tipo = 1;
            } elseif ($docentes->nro_doc) {
                $this->view->paciente = $docentes;
                // print("Docente");
                // exit();
                $this->view->tipo = 2;
            } elseif ($personal->nro_doc) {
                $this->view->paciente = $personal;
                // print("Personal");
                // exit();
                $this->view->tipo = 3;
            } elseif ($publico->nro_doc) {
                $this->view->paciente = $publico;
                // print("Publico");
                // exit();
                $this->view->tipo = 5;
            }
        } else {

            $historiaClinica = HistoriaClinica::findFirstBynro_doc(0);

            $alumnos = Alumnos::findFirst("nro_doc = '{$id}'");
            $docentes = Docentes::findFirstBynro_doc("$id");
            $db = $this->db;
            $sqlQuery1 = "SELECT
                public.tbl_web_personal.codigo,
                public.tbl_web_personal.apellidop,
                public.tbl_web_personal.apellidom,
                public.tbl_web_personal.nombres,
                public.tbl_web_personal.fecha_nacimiento,
                public.tbl_web_personal.sexo,
                public.tbl_web_personal.direccion_actual AS direccion,
                public.tbl_web_personal.lugar_nacimiento AS ciudad,
                public.tbl_web_personal.celular,
                public.tbl_web_personal.telefono_emergencia AS telefono,
                public.tbl_web_personal.email,
                public.tbl_web_personal.email1,
                public.tbl_web_personal.seguro,
                public.tbl_web_personal.documento,
                public.tbl_web_personal.nro_doc,
                public.tbl_web_personal.imagen AS foto
                FROM
                public.tbl_web_personal
                WHERE
                public.tbl_web_personal.nro_doc = '$id'";
            $personal = $db->fetchOne($sqlQuery1, Phalcon\Db::FETCH_OBJ);

            $db2 = $this->db;
            $sqlQuery2 = "SELECT
                public.publico.codigo,
                public.publico.apellidop,
                public.publico.apellidom,
                public.publico.nombres,
                public.publico.fecha_nacimiento,
                public.publico.sexo,
                public.publico.direccion,
                public.publico.ciudad,
                public.publico.celular,
                public.publico.telefono,
                public.publico.email,
                ''AS email1,
                public.publico.seguro,
                public.publico.documento,
                public.publico.nro_doc,
                public.publico.imagen AS foto
                FROM
                public.publico
                WHERE
                public.publico.nro_doc = '$id'";
            $publico = $db2->fetchOne($sqlQuery2, Phalcon\Db::FETCH_OBJ);

            if ($alumnos->nro_doc) {
                $this->view->paciente = $alumnos;
                print("Alumno");
                exit();
                $this->view->tipo = 1;
            } elseif ($docentes->nro_doc) {
                $this->view->paciente = $docentes;
                // print("Docente");
                // exit();
                $this->view->tipo = 2;
            } elseif ($personal->nro_doc) {
                $this->view->paciente = $personal;
                // print("Personal");
                // exit();
                $this->view->tipo = 3;
            } elseif ($publico->nro_doc) {
                $this->view->paciente = $publico;
                // print("Publico");
                // exit();
                $this->view->tipo = 5;
            }
        }
        $this->view->historiaClinica = $historiaClinica;

        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguros;

        $documentos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentos = $documentos;

        $db = $this->db;
        $sqlMedicamentos = "SELECT
        public.tbl_dss_medicamentos.id_medicamento,
        public.tbl_dss_medicamentos.descripcion AS medicamento,
        concentraciones.nombres AS concentracion,
        formas.nombres AS forma
        FROM
        public.tbl_dss_medicamentos
        INNER JOIN public.a_codigos AS concentraciones ON public.tbl_dss_medicamentos.id_concentracion = concentraciones.codigo
        INNER JOIN public.a_codigos AS formas ON public.tbl_dss_medicamentos.id_forma = formas.codigo
        WHERE
        concentraciones.numero = 124 AND
        formas.numero = 123";
        $medicamentos = $db->fetchAll($sqlMedicamentos, Phalcon\Db::FETCH_OBJ);
        $this->view->medicamentos = $medicamentos;

        $vias = Vias::find(array("estado = 'A' AND numero = 122", "order" => "nombres DESC"));
        $this->view->vias = $vias;

        $exameneslab = ExamenesLab::find(array("estado = 'A' AND numero = 114", "order" => "nombres DESC"));
        $this->view->exameneslab = $exameneslab;


        $habitos = DssHabitos::find(array("estado = 'A' AND numero = 122", "order" => "nombres DESC"));
        $this->view->habitos = $habitos;

        $vacunas = DssVacunas::find(array("estado = 'A' AND numero = 111", "order" => "nombres DESC"));
        $this->view->vacunas = $vacunas;


        $dosis = DssDosis::find(array("estado = 'A' AND numero = 127", "order" => "nombres DESC"));
        $this->view->dosis = $dosis;


        // foreach ($exameneslab as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->nombres);
        // }
        // exit();




        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.medicamentos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.bucal.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.examen.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.fiebre.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.habitos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.tos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registrohistoriasclinicas.vacunas.js?v=" . uniqid());
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("nro_doc");
            $datatable->setSelect("id_hc,nro_doc,apellidos_nombre,estado");
            $datatable->setFrom("(SELECT distinct view_dss_pacientes.nro_doc,
            view_dss_pacientes.apellidos_nombre,
            tbl_dss_hc.estado,
            tbl_dss_hc.id_hc
            FROM tbl_dss_hc INNER JOIN view_dss_pacientes ON view_dss_pacientes.nro_doc = tbl_dss_hc.nro_doc) AS temporal_table");
            $datatable->setOrderby("apellidos_nombre ASC");
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

                $id = (int) $this->request->getPost("id_hc", "int");
                $historiaClinica = HistoriaClinica::findFirstByid_hc($id);
                $historiaClinica = (!$historiaClinica) ? new HistoriaClinica() : $historiaClinica;

                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $historiaClinica->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_actualizacion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_actualizacion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $historiaClinica->fecha_actualizacion = date('Y-m-d', strtotime($fecha_new));
                }

                $historiaClinica->nro_doc = $this->request->getPost("nro_doc", "string");
                $historiaClinica->grupo_sanguineo = $this->request->getPost("grupo_sanguineo", "string");
                $historiaClinica->rh = $this->request->getPost("rh", "string");
                $historiaClinica->descripcion_antecedentes = $this->request->getPost("descripcion_antecedentes", "string");

                $alergico = $this->request->getPost("alergico", "string");
                if (isset($alergico)) {

                    $historiaClinica->alergico = 1;
                } else {

                    $historiaClinica->alergico = 0;
                }
                $historiaClinica->alergico_nombre = $this->request->getPost("alergico_nombre", "string");




                if ($this->request->getPost("nro_hijos_vivos", "int") == "") {
                    $historiaClinica->nro_hijos_vivos = null;
                } else {
                    $historiaClinica->nro_hijos_vivos = $this->request->getPost("nro_hijos_vivos", "int");
                }

                if ($this->request->getPost("nro_hijos_fallecidos", "int") == "") {
                    $historiaClinica->nro_hijos_fallecidos = null;
                } else {
                    $historiaClinica->nro_hijos_fallecidos = $this->request->getPost("nro_hijos_fallecidos", "int");
                }

                if ($this->request->getPost("fecha_ur", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_ur", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $historiaClinica->fecha_ur = date('Y-m-d', strtotime($fecha_new));
                }

                $historiaClinica->observaciones = $this->request->getPost("observaciones", "string");
                $historiaClinica->estado = "A";

                $hipertension_arterial = $this->request->getPost("hipertension_arterial", "string");
                if (isset($hipertension_arterial)) {

                    $historiaClinica->hipertension_arterial = 1;
                } else {

                    $historiaClinica->hipertension_arterial = 0;
                }

                $diabetes_mellitus = $this->request->getPost("diabetes_mellitus", "string");
                if (isset($diabetes_mellitus)) {

                    $historiaClinica->diabetes_mellitus = 1;
                } else {

                    $historiaClinica->diabetes_mellitus = 0;
                }

                $obesidad_dislipidemias = $this->request->getPost("obesidad_dislipidemias", "string");
                if (isset($obesidad_dislipidemias)) {

                    $historiaClinica->obesidad_dislipidemias = 1;
                } else {

                    $historiaClinica->obesidad_dislipidemias = 0;
                }

                $enfermedades_osteomusculares = $this->request->getPost("enfermedades_osteomusculares", "string");
                if (isset($enfermedades_osteomusculares)) {

                    $historiaClinica->enfermedades_osteomusculares = 1;
                } else {

                    $historiaClinica->enfermedades_osteomusculares = 0;
                }

                $enfermedades_metaxemicas = $this->request->getPost("enfermedades_metaxemicas", "string");
                if (isset($enfermedades_metaxemicas)) {

                    $historiaClinica->enfermedades_metaxemicas = 1;
                } else {

                    $historiaClinica->enfermedades_metaxemicas = 0;
                }


                $enfermedades_cardiovasculares = $this->request->getPost("enfermedades_cardiovasculares", "string");
                if (isset($enfermedades_cardiovasculares)) {

                    $historiaClinica->enfermedades_cardiovasculares = 1;
                } else {

                    $historiaClinica->enfermedades_cardiovasculares = 0;
                }

                $neoplasias = $this->request->getPost("neoplasias", "string");
                if (isset($neoplasias)) {

                    $historiaClinica->neoplasias = 1;
                } else {

                    $historiaClinica->neoplasias = 0;
                }

                $cancer_cervix_mama = $this->request->getPost("cancer_cervix_mama", "string");
                if (isset($cancer_cervix_mama)) {

                    $historiaClinica->cancer_cervix_mama = 1;
                } else {

                    $historiaClinica->cancer_cervix_mama = 0;
                }

                $cancer_prostata = $this->request->getPost("cancer_prostata", "string");
                if (isset($cancer_prostata)) {

                    $historiaClinica->cancer_prostata = 1;
                } else {

                    $historiaClinica->cancer_prostata = 0;
                }

                $hepatitis_a_b_c = $this->request->getPost("hepatitis_a_b_c", "string");
                if (isset($hepatitis_a_b_c)) {

                    $historiaClinica->hepatitis_a_b_c = 1;
                } else {

                    $historiaClinica->hepatitis_a_b_c = 0;
                }

                $alergias_o_hipersensibilidad = $this->request->getPost("alergias_o_hipersensibilidad", "string");
                if (isset($alergias_o_hipersensibilidad)) {

                    $historiaClinica->alergias_o_hipersensibilidad = 1;
                } else {

                    $historiaClinica->alergias_o_hipersensibilidad = 0;
                }


                $enfermedades_respiratorias = $this->request->getPost("enfermedades_respiratorias", "string");
                if (isset($enfermedades_respiratorias)) {

                    $historiaClinica->enfermedades_respiratorias = 1;
                } else {

                    $historiaClinica->enfermedades_respiratorias = 0;
                }


                $transfusiones_sanguinea = $this->request->getPost("transfusiones_sanguinea", "string");
                if (isset($transfusiones_sanguinea)) {

                    $historiaClinica->transfusiones_sanguinea = 1;
                } else {

                    $historiaClinica->transfusiones_sanguinea = 0;
                }

                $intervencion_quirurgica = $this->request->getPost("intervencion_quirurgica", "string");
                if (isset($intervencion_quirurgica)) {

                    $historiaClinica->intervencion_quirurgica = 1;
                } else {

                    $historiaClinica->intervencion_quirurgica = 0;
                }

                $traumatismos_accidentes = $this->request->getPost("traumatismos_accidentes", "string");
                if (isset($traumatismos_accidentes)) {

                    $historiaClinica->traumatismos_accidentes = 1;
                } else {

                    $historiaClinica->traumatismos_accidentes = 0;
                }

                $enfermedad_gastrointestinal = $this->request->getPost("enfermedad_gastrointestinal", "string");
                if (isset($enfermedad_gastrointestinal)) {

                    $historiaClinica->enfermedad_gastrointestinal = 1;
                } else {

                    $historiaClinica->enfermedad_gastrointestinal = 0;
                }

                $enfermedades_ginecologicas = $this->request->getPost("enfermedades_ginecologicas", "string");
                if (isset($enfermedades_ginecologicas)) {

                    $historiaClinica->enfermedades_ginecologicas = 1;
                } else {

                    $historiaClinica->enfermedades_ginecologicas = 0;
                }


                $enfermedades_psicomotoras = $this->request->getPost("enfermedades_psicomotoras", "string");
                if (isset($enfermedades_psicomotoras)) {

                    $historiaClinica->enfermedades_psicomotoras = 1;
                } else {

                    $historiaClinica->enfermedades_psicomotoras = 0;
                }


                $tb_pulmonar_extrapulmonar = $this->request->getPost("tb_pulmonar_extrapulmonar", "string");
                if (isset($tb_pulmonar_extrapulmonar)) {

                    $historiaClinica->tb_pulmonar_extrapulmonar = 1;
                } else {

                    $historiaClinica->tb_pulmonar_extrapulmonar = 0;
                }


                $hipertension_arterial_f = $this->request->getPost("hipertension_arterial_f", "string");
                if (isset($hipertension_arterial_f)) {

                    $historiaClinica->hipertension_arterial_f = 1;
                } else {

                    $historiaClinica->hipertension_arterial_f = 0;
                }

                $diabetes_mellitus_f = $this->request->getPost("diabetes_mellitus_f", "string");
                if (isset($diabetes_mellitus_f)) {

                    $historiaClinica->diabetes_mellitus_f = 1;
                } else {

                    $historiaClinica->diabetes_mellitus_f = 0;
                }

                $infarto_miocardio_f = $this->request->getPost("infarto_miocardio_f", "string");
                if (isset($infarto_miocardio_f)) {

                    $historiaClinica->infarto_miocardio_f = 1;
                } else {

                    $historiaClinica->infarto_miocardio_f = 0;
                }

                $enfermedad_mental = $this->request->getPost("enfermedad_mental", "string");
                if (isset($enfermedad_mental)) {

                    $historiaClinica->enfermedad_mental = 1;
                } else {

                    $historiaClinica->enfermedad_mental = 0;
                }


                $neoplasias_f = $this->request->getPost("neoplasias_f", "string");
                if (isset($neoplasias_f)) {

                    $historiaClinica->neoplasias_f = 1;
                } else {

                    $historiaClinica->neoplasias_f = 0;
                }

                $tipo = $this->request->getPost("tipo", "int");

                if ($tipo == 1) {

                    $codigo = $this->request->getPost("codigo", "int");
                    $alumno = Alumnos::findFirstBycodigo((int) $codigo);
                    $alumno->direccion = $this->request->getPost("direccion", "string");
                    if ($this->request->getPost("seguro", "int") == "") {
                        $alumno->seguro = null;
                    } else {
                        $alumno->seguro = $this->request->getPost("seguro", "int");
                    }
                    $alumno->celular = $this->request->getPost("celular", "string");
                    $alumno->save();
                } elseif ($tipo == 2) {

                    $codigo = $this->request->getPost("codigo", "int");
                    $docente = Docentes::findFirstBycodigo((int) $codigo);
                    $docente->direccion = $this->request->getPost("direccion", "string");
                    if ($this->request->getPost("seguro", "int") == "") {
                        $docente->seguro = null;
                    } else {
                        $docente->seguro = $this->request->getPost("seguro", "int");
                    }
                    $docente->celular = $this->request->getPost("celular", "string");
                    $docente->save();
                } elseif ($tipo == 3) {

                    $codigo = $this->request->getPost("codigo", "int");
                    $personal = Personal::findFirstBycodigo((int) $codigo);
                    $personal->direccion = $this->request->getPost("direccion", "string");
                    if ($this->request->getPost("seguro", "int") == "") {
                        $personal->seguro = null;
                    } else {
                        $personal->seguro = $this->request->getPost("seguro", "int");
                    }
                    $personal->celular = $this->request->getPost("celular", "string");
                    $personal->save();
                } elseif ($tipo == 5) {

                    $codigo = $this->request->getPost("codigo", "int");
                    $publico = Publico::findFirstBycodigo((int) $codigo);
                    $publico->direccion = $this->request->getPost("direccion", "string");
                    if ($this->request->getPost("seguro", "int") == "") {
                        $publico->seguro = null;
                    } else {
                        $publico->seguro = $this->request->getPost("seguro", "int");
                    }
                    $publico->celular = $this->request->getPost("celular", "string");
                    $publico->save();
                }



                if ($historiaClinica->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($historiaClinica->getMessages());
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


    public function datatablePacientesAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("nro_doc");
            $datatable->setSelect("nro_doc, apellidos_nombre, direccion, telefono, tipo_codigo, tipo, estado");
            $datatable->setFrom("view_dss_pacientes");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function getAjaxPacienteAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $nro_doc = (string) $this->request->getPost("nro_doc", "string");
            $tipo = (int) $this->request->getPost("tipo", "int");

            if ($tipo == 1) {
                $paciente = Alumnos::findFirstBynro_doc("$nro_doc");
            } elseif ($tipo == 2) {
                $paciente = Docentes::findFirstBynro_doc("$nro_doc");
            } elseif ($tipo == 3) {

                $db = $this->db;
                $sqlQuery = "SELECT
                public.tbl_web_personal.codigo,
                public.tbl_web_personal.apellidop,
                public.tbl_web_personal.apellidom,
                public.tbl_web_personal.nombres,
                public.tbl_web_personal.fecha_nacimiento,
                public.tbl_web_personal.sexo,
                public.tbl_web_personal.direccion_actual AS direccion,
                public.tbl_web_personal.lugar_nacimiento AS ciudad,
                public.tbl_web_personal.celular,
                public.tbl_web_personal.telefono_emergencia AS telefono,
                public.tbl_web_personal.email,
                public.tbl_web_personal.email1,
                public.tbl_web_personal.seguro,
                public.tbl_web_personal.documento,
                public.tbl_web_personal.nro_doc,
                public.tbl_web_personal.imagen AS foto
                FROM
                public.tbl_web_personal
                WHERE
                public.tbl_web_personal.nro_doc = '$nro_doc'";
                $paciente = $db->fetchOne($sqlQuery, Phalcon\Db::FETCH_OBJ);
            }



            if ($paciente) {
                $this->response->setJsonContent(array("paciente" => $paciente, "tipo" => $tipo));
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function getAjaxVerificarPacienteAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $nro_doc = (string) $this->request->getPost("nro_doc", "string");
            // print($nro_doc);
            // exit();
            $model = HistoriaClinica::findFirstBynro_doc("$nro_doc");
            if ($model && $model->estado = 'A') {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function savePacienteNuevoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $model = (!$model) ? new HistoriaClinica() : $model;
                $model->nro_doc = $this->request->getPost("nro_doc", "string");
                $model->fecha_atencion = date("Y-m-d H:i:s");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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


    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $nro_doc = (string) $this->request->getPost("nro_doc", "string");
            $model = HistoriaClinica::findFirst("nro_doc = '$nro_doc'");

            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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

    public function datatableMedicamentosAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_medicamento");
            $datatable->setSelect("id_hc_medicamento,id_hc,id_medicamento,medicamento,concentracion,forma,
            nro_doc,id_via,dosis,observaciones,estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_medicamentos.id_hc_medicamento,
            public.tbl_dss_hc_medicamentos.id_hc,
            public.tbl_dss_hc_medicamentos.id_medicamento,
            public.tbl_dss_medicamentos.descripcion AS medicamento,
            tbl_dss_hc.nro_doc,
            public.tbl_dss_hc_medicamentos.id_via,
            public.tbl_dss_hc_medicamentos.dosis,
            public.tbl_dss_hc_medicamentos.observaciones,
            public.tbl_dss_hc_medicamentos.estado,
            concentraciones.nombres AS concentracion,
            formas.nombres AS forma
            FROM
            public.tbl_dss_hc_medicamentos
            INNER JOIN tbl_dss_hc ON tbl_dss_hc.id_hc = public.tbl_dss_hc_medicamentos.id_hc
            INNER JOIN public.tbl_dss_medicamentos ON public.tbl_dss_hc_medicamentos.id_medicamento = public.tbl_dss_medicamentos.id_medicamento
            INNER JOIN public.a_codigos AS concentraciones ON public.tbl_dss_medicamentos.id_concentracion = concentraciones.codigo
            INNER JOIN public.a_codigos AS formas ON public.tbl_dss_medicamentos.id_forma = formas.codigo
            WHERE
            public.tbl_dss_hc_medicamentos.id_hc = $id_hc AND
            concentraciones.numero = 124 AND
            formas.numero = 123) AS temporal_table");
            $datatable->setOrderby("id_hc_medicamento ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveHistoriasclinicasMedicamentosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_hc_medicamento", "int");
                $model = HistoriaclinicaMedicamentos::findFirstByid_hc_medicamento((int)$id);
                $model = (!$model) ? new HistoriaclinicaMedicamentos() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");
                $model->id_medicamento = $this->request->getPost("id_medicamento", "int");


                if ($this->request->getPost("id_via", "int") == "") {
                    $model->id_via = null;
                } else {
                    $model->id_via = $this->request->getPost("id_via", "int");
                }

                $model->dosis = $this->request->getPost("dosis", "string");
                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxHistoriasclinicasMedicamentosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaMedicamentos::findFirstByid_hc_medicamento((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function eliminarHistoriasclinicasMedicamentosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaMedicamentos::findFirstByid_hc_medicamento((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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


    public function datatableFiebreAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_fiebre");
            $datatable->setSelect("id_hc_fiebre, id_hc, fecha_fiebre, basal, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_fiebre.id_hc_fiebre,
            public.tbl_dss_hc_fiebre.id_hc,
            
            to_char(public.tbl_dss_hc_fiebre.fecha_fiebre, 'DD/MM/YYYY' ) AS fecha_fiebre,

            public.tbl_dss_hc_fiebre.basal,
            public.tbl_dss_hc_fiebre.observaciones,
            public.tbl_dss_hc_fiebre.estado
            FROM
            public.tbl_dss_hc_fiebre
            WHERE public.tbl_dss_hc_fiebre.id_hc = $id_hc) AS temporal_table");
            $datatable->setOrderby("id_hc_fiebre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveFiebreAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_hc_fiebre", "int");
                $model = HistoriaclinicaFiebre::findFirstByid_hc_fiebre((int)$id);
                $model = (!$model) ? new HistoriaclinicaFiebre() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");

                if ($this->request->getPost("fecha_fiebre", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fiebre", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_fiebre = date('Y-m-d', strtotime($fecha_new));
                }

                $basal = $this->request->getPost("basal", "string");
                if (isset($basal)) {
                    $model->basal = 1;
                } else {
                    $model->basal = 0;
                }

                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxFiebreAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaFiebre::findFirstByid_hc_fiebre((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarFiebreAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaFiebre::findFirstByid_hc_fiebre((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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


    public function datatableTosAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_tos");
            $datatable->setSelect("id_hc_tos, id_hc, fecha_tos, basal, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_tos.id_hc_tos,
            public.tbl_dss_hc_tos.id_hc,
           
            to_char( public.tbl_dss_hc_tos.fecha_tos, 'DD/MM/YYYY' ) AS  fecha_tos,

            public.tbl_dss_hc_tos.basal,
            public.tbl_dss_hc_tos.observaciones,
            public.tbl_dss_hc_tos.estado
            FROM
            public.tbl_dss_hc_tos
            WHERE public.tbl_dss_hc_tos.id_hc = $id_hc) AS temporal_table");
            $datatable->setOrderby("id_hc_tos ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function saveTosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_hc_tos", "int");
                $model = HistoriaclinicaTos::findFirstByid_hc_tos((int)$id);
                $model = (!$model) ? new HistoriaclinicaTos() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");

                if ($this->request->getPost("fecha_tos", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_tos", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_tos = date('Y-m-d', strtotime($fecha_new));
                }

                $basal = $this->request->getPost("basal", "string");
                if (isset($basal)) {
                    $model->basal = 1;
                } else {
                    $model->basal = 0;
                }

                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxTosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaTos::findFirstByid_hc_tos((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarTosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaTos::findFirstByid_hc_tos((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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

    public function datatableBucalAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_bucal");
            $datatable->setSelect("id_hc_bucal, id_hc, fecha_bucal, basal, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_bucal.id_hc_bucal,
            public.tbl_dss_hc_bucal.id_hc,
            to_char(public.tbl_dss_hc_bucal.fecha_bucal, 'DD/MM/YYYY' ) AS fecha_bucal,
            public.tbl_dss_hc_bucal.basal,
            public.tbl_dss_hc_bucal.observaciones,
            public.tbl_dss_hc_bucal.estado
            FROM
            public.tbl_dss_hc_bucal
            WHERE public.tbl_dss_hc_bucal.id_hc = $id_hc) AS temporal_table");
            $datatable->setOrderby("id_hc_bucal ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }




    public function saveBucalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_hc_bucal", "int");
                $model = HistoriaclinicaBucal::findFirstByid_hc_bucal((int)$id);
                $model = (!$model) ? new HistoriaclinicaBucal() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");

                if ($this->request->getPost("fecha_bucal", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_bucal", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_bucal = date('Y-m-d', strtotime($fecha_new));
                }

                $basal = $this->request->getPost("basal", "string");
                if (isset($basal)) {
                    $model->basal = 1;
                } else {
                    $model->basal = 0;
                }

                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxBucalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaBucal::findFirstByid_hc_bucal((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarBucalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaBucal::findFirstByid_hc_bucal((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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

    public function datatableExamenAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_examen");
            $datatable->setSelect("id_hc_examen, id_hc, examen,fecha_examen, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_examenes.id_hc_examen,
            public.tbl_dss_hc_examenes.id_hc,
            examenes.nombres AS examen,
            to_char(public.tbl_dss_hc_examenes.fecha_examen, 'DD/MM/YYYY' ) AS fecha_examen,
            public.tbl_dss_hc_examenes.observaciones,
            public.tbl_dss_hc_examenes.estado
            FROM
            public.tbl_dss_hc_examenes
            INNER JOIN public.a_codigos AS examenes ON examenes.codigo = public.tbl_dss_hc_examenes.id_examen
            WHERE
            examenes.numero = 114 AND public.tbl_dss_hc_examenes.id_hc = $id_hc) AS temporal_table");
            $datatable->setOrderby("id_hc_examen ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveExamenAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_hc_examen", "int");
                $model = HistoriaclinicaExamenes::findFirstByid_hc_examen((int)$id);
                $model = (!$model) ? new HistoriaclinicaExamenes() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");

                if ($this->request->getPost("id_examen", "int") == "") {
                    $model->id_examen = null;
                } else {
                    $model->id_examen = $this->request->getPost("id_examen", "int");
                }


                if ($this->request->getPost("fecha_examen", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_examen", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_examen = date('Y-m-d', strtotime($fecha_new));
                }

                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxExamenAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaExamenes::findFirstByid_hc_examen((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarExamenAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaExamenes::findFirstByid_hc_examen((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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


    public function datatableHabitosAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_habito");
            $datatable->setSelect("id_hc_habito, id_hc, habito,fecha_habito, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_habitos.id_hc_habito,
            public.tbl_dss_hc_habitos.id_hc,
            public.tbl_dss_hc_habitos.id_habito,
            
            to_char(public.tbl_dss_hc_habitos.fecha_habito, 'DD/MM/YYYY' ) AS fecha_habito,

            public.tbl_dss_hc_habitos.observaciones,
            public.tbl_dss_hc_habitos.estado,
            habitos.nombres AS habito
            FROM
            public.tbl_dss_hc_habitos
            INNER JOIN public.a_codigos AS habitos ON habitos.codigo = public.tbl_dss_hc_habitos.id_habito
            WHERE
            habitos.numero = 122 AND public.tbl_dss_hc_habitos.id_hc = $id_hc) AS temporal_table");
            $datatable->setOrderby("id_hc_habito ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveHabitosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_hc_habito", "string");
                $model = HistoriaclinicaHabitos::findFirstByid_hc_habito((int)$id);
                $model = (!$model) ? new HistoriaclinicaHabitos() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");

                if ($this->request->getPost("id_habito", "int") == "") {
                    $model->id_habito = null;
                } else {
                    $model->id_habito = $this->request->getPost("id_habito", "int");
                }


                if ($this->request->getPost("fecha_habito", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_habito", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_habito = date('Y-m-d', strtotime($fecha_new));
                }

                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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


    public function getAjaxHabitosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaHabitos::findFirstByid_hc_habito((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarHabitosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaHabitos::findFirstByid_hc_habito((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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


    public function datatableVacunasAction($id_hc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_hc_vacuna");
            $datatable->setSelect("id_hc_vacuna, id_hc, vacuna,dosis,fecha_vacuna, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_hc_vacunas.id_hc_vacuna,
            public.tbl_dss_hc_vacunas.id_hc,
            vacunas.nombres AS vacuna,
            dosis.nombres AS dosis,
            
            to_char(public.tbl_dss_hc_vacunas.fecha_vacuna, 'DD/MM/YYYY' ) AS fecha_vacuna,

            public.tbl_dss_hc_vacunas.observaciones,
            public.tbl_dss_hc_vacunas.estado
            FROM
            public.tbl_dss_hc_vacunas
            INNER JOIN public.a_codigos AS vacunas ON vacunas.codigo = public.tbl_dss_hc_vacunas.id_vacuna
            INNER JOIN public.a_codigos AS dosis ON dosis.codigo = public.tbl_dss_hc_vacunas.id_dosis
            WHERE
            vacunas.numero = 111 AND
            dosis.numero = 127 AND public.tbl_dss_hc_vacunas.id_hc = $id_hc) AS temporal_table");
            $datatable->setOrderby("id_hc_vacuna ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveVacunasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_hc_vacuna", "string");
                $model = HistoriaclinicaVacunas::findFirstByid_hc_vacuna((int)$id);
                $model = (!$model) ? new HistoriaclinicaVacunas() : $model;

                $model->id_hc = $this->request->getPost("id_hc", "int");

                if ($this->request->getPost("id_vacuna", "int") == "") {
                    $model->id_vacuna = null;
                } else {
                    $model->id_vacuna = $this->request->getPost("id_vacuna", "int");
                }

                if ($this->request->getPost("id_dosis", "int") == "") {
                    $model->id_dosis = null;
                } else {
                    $model->id_dosis = $this->request->getPost("id_dosis", "int");
                }



                if ($this->request->getPost("fecha_vacuna", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_vacuna", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_vacuna = date('Y-m-d', strtotime($fecha_new));
                }

                $model->observaciones = $this->request->getPost("observaciones", "string");
                $model->estado = "A";

                if ($model->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($model->getMessages());
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

    public function getAjaxVacunasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaVacunas::findFirstByid_hc_vacuna((int) $this->request->getPost("id", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarVacunasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = HistoriaclinicaVacunas::findFirstByid_hc_vacuna((int) $this->request->getPost("id", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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
