<?php

class RegistroatencionessaludController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroatencionessalud.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function pacienteAction($nro_doc = null, $tipo = null)
    {
        $this->view->nro_doc = $nro_doc;
        $this->view->tipo = $tipo;
        $this->assets->addJs("adminpanel/js/modulos/registroatencionessalud.paciente.js?v=" . uniqid());
    }




    public function registroAction($id = null, $nro_doc = null)
    {

        $this->view->id = $id;
        if ($id != null) {

            $atenciones = Atenciones::findFirstByid_atencion((int)$id);

            $alumnos = Alumnos::findFirst("nro_doc = '{$nro_doc}'");

            $docentes = Docentes::findFirstBynro_doc("$nro_doc");

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
                public.tbl_web_personal.nro_doc = '$nro_doc'";
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
                public.publico.nro_doc = '$nro_doc'";
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

            $atenciones = Atenciones::findFirstByid_atencion(0);

            $alumnos = Alumnos::findFirst("nro_doc = '{$nro_doc}'");
            $docentes = Docentes::findFirstBynro_doc("$nro_doc");
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
                public.tbl_web_personal.nro_doc = '$nro_doc'";
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
                public.publico.nro_doc = '$nro_doc'";
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
        }
        $this->view->atenciones = $atenciones;

        $sexos = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexos = $sexos;

        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguros = $seguros;

        $documentos = Documento::find("estado = 'A' AND numero = 1 ");
        $this->view->documentos = $documentos;

        $apetitos = Apetitos::find(array("estado = 'A' AND numero = 115", "order" => "nombres DESC"));
        $this->view->apetitos = $apetitos;

        $seds = Seds::find(array("estado = 'A' AND numero = 116", "order" => "nombres DESC"));
        $this->view->seds = $seds;


        $suenios = Suenios::find(array("estado = 'A' AND numero = 117", "order" => "nombres DESC"));
        $this->view->suenios = $suenios;

        $animos = Animos::find(array("estado = 'A' AND numero = 118", "order" => "nombres DESC"));
        $this->view->animos = $animos;


        $orinas = Orinas::find(array("estado = 'A' AND numero = 119", "order" => "nombres DESC"));
        $this->view->orinas = $orinas;

        $deposiciones = Deposiciones::find(array("estado = 'A' AND numero = 120", "order" => "nombres DESC"));
        $this->view->deposiciones = $deposiciones;

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

        $cie10 = Cie10::find("estado = 'A'");
        $this->view->cie10 = $cie10;


        $this->assets->addJs("adminpanel/js/modulos/registroatencionessalud.atenciones.medicamentos.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/registroatencionessalud.atenciones.cie10.js?v=" . uniqid());
    }

    public function datatableAction($fecha_inicio = null, $fecha_fin = null)
    {

        // print($fecha_inicio."-".$fecha_fin);
        // exit();

        if ($fecha_inicio != 0 and $fecha_fin != 0) {
            $where = "(CAST (fecha AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else {
            $where = "";
        }

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_atencion");
            $datatable->setSelect("nro_doc,id_atencion,fecha_atencion,fecha,apellidos_nombre,estado,motivo");
            $datatable->setFrom("(SELECT distinct tbl_dss_atenciones.id_atencion,
            to_char(tbl_dss_atenciones.fecha_atencion, 'DD/MM/YYYY') AS fecha_atencion,
            tbl_dss_atenciones.fecha_atencion AS fecha,
            view_dss_pacientes.nro_doc,
            view_dss_pacientes.apellidos_nombre,
            tbl_dss_atenciones.estado,
            tbl_dss_atenciones.motivo
            FROM tbl_dss_atenciones INNER JOIN view_dss_pacientes ON view_dss_pacientes.nro_doc = tbl_dss_atenciones.nro_doc) AS temporal_table");
            $datatable->setWhere("$where");
            $datatable->setOrderby("apellidos_nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatablePacienteAction($nro_doc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_atencion");
            $datatable->setSelect("nro_doc,id_atencion,fecha_atencion,fecha,apellidos_nombre,estado,motivo");
            $datatable->setFrom("(SELECT distinct tbl_dss_atenciones.id_atencion,
            to_char(tbl_dss_atenciones.fecha_atencion, 'DD/MM/YYYY') AS fecha_atencion,
            tbl_dss_atenciones.fecha_atencion AS fecha,
            view_dss_pacientes.nro_doc,
            view_dss_pacientes.apellidos_nombre,
            tbl_dss_atenciones.estado,
            tbl_dss_atenciones.motivo
            FROM tbl_dss_atenciones INNER JOIN view_dss_pacientes ON view_dss_pacientes.nro_doc = tbl_dss_atenciones.nro_doc) AS temporal_table");
            $datatable->setWhere("nro_doc = '$nro_doc'");
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

                $id = (int) $this->request->getPost("id_atencion", "int");
                $atenciones = Atenciones::findFirstByid_atencion($id);
                $atenciones = (!$atenciones) ? new Atenciones() : $atenciones;

                $atenciones->nro_doc = $this->request->getPost("nro_doc", "string");

                if ($this->request->getPost("fecha_atencion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_atencion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $atenciones->fecha_atencion = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("edad", "int") == "") {
                    $atenciones->edad = null;
                } else {
                    $atenciones->edad = $this->request->getPost("edad", "int");
                }

                $atenciones->motivo = $this->request->getPost("motivo", "string");
                $atenciones->tiempo = $this->request->getPost("tiempo", "string");


                if ($this->request->getPost("id_apetito", "int") == "") {
                    $atenciones->id_apetito = null;
                } else {
                    $atenciones->id_apetito = $this->request->getPost("id_apetito", "int");
                }

                if ($this->request->getPost("id_sed", "int") == "") {
                    $atenciones->id_sed = null;
                } else {
                    $atenciones->id_sed = $this->request->getPost("id_sed", "int");
                }

                if ($this->request->getPost("id_sueno", "int") == "") {
                    $atenciones->id_sueno = null;
                } else {
                    $atenciones->id_sueno = $this->request->getPost("id_sueno", "int");
                }

                if ($this->request->getPost("id_animo", "int") == "") {
                    $atenciones->id_animo = null;
                } else {
                    $atenciones->id_animo = $this->request->getPost("id_animo", "int");
                }

                if ($this->request->getPost("id_orina", "int") == "") {
                    $atenciones->id_orina = null;
                } else {
                    $atenciones->id_orina = $this->request->getPost("id_orina", "int");
                }

                if ($this->request->getPost("id_deposicion", "int") == "") {
                    $atenciones->id_deposicion = null;
                } else {
                    $atenciones->id_deposicion = $this->request->getPost("id_deposicion", "int");
                }

                $atenciones->eva = $this->request->getPost("eva", "string");
                $atenciones->examenes_aux = $this->request->getPost("examenes_aux", "string");
                $atenciones->referencia = $this->request->getPost("referencia", "string");
                $atenciones->lugar = $this->request->getPost("lugar", "string");
                $atenciones->observaciones = $this->request->getPost("observaciones", "string");
                $atenciones->estado = "A";

                $atenciones->temperatura = $this->request->getPost("temperatura", "string");
                $atenciones->peso = $this->request->getPost("peso", "string");
                $atenciones->talla = $this->request->getPost("talla", "string");
                $atenciones->pa = $this->request->getPost("pa", "string");
                $atenciones->fc = $this->request->getPost("fc", "string");
                $atenciones->oximetria = $this->request->getPost("oximetria", "string");
                $atenciones->fr = $this->request->getPost("fr", "string");
                $atenciones->musculo = $this->request->getPost("musculo", "string");
                $atenciones->calorias = $this->request->getPost("calorias", "string");
                $atenciones->consumo_agua = $this->request->getPost("consumo_agua", "string");
                $atenciones->grasa_corporal = $this->request->getPost("grasa_corporal", "string");
                $atenciones->imc = $this->request->getPost("imc", "string");
                $atenciones->edad_corporal = $this->request->getPost("edad_corporal", "string");
                $atenciones->grasa_visceral = $this->request->getPost("grasa_visceral", "string");

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

                }elseif ($tipo == 2) {

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

                }elseif ($tipo == 3) {

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

                }elseif ($tipo == 5) {

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

                if ($atenciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($atenciones->getMessages());
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



    public function saveAtencionNuevoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $model = (!$model) ? new Atenciones() : $model;
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

            $id_atencion = (int) $this->request->getPost("id_atencion", "int");
            $nro_doc = (string) $this->request->getPost("nro_doc", "string");

            $model = Atenciones::findFirst("id_atencion = $id_atencion AND nro_doc = '$nro_doc'");

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

    public function datatableAtencionesMedicamentosAction($id_atencion)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_atencion_medicamento");
            $datatable->setSelect("id_atencion_medicamento,id_atencion,id_medicamento,medicamento,concentracion,forma,
            nro_doc,cantidad,recibido,id_via,dosis,frecuencia,duracion,observaciones,estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_atenciones_medicamentos.id_atencion_medicamento,
            public.tbl_dss_atenciones_medicamentos.id_atencion,
            public.tbl_dss_atenciones_medicamentos.id_medicamento,
            public.tbl_dss_medicamentos.descripcion AS medicamento,
            public.tbl_dss_atenciones.nro_doc,
            public.tbl_dss_atenciones_medicamentos.cantidad,
            public.tbl_dss_atenciones_medicamentos.recibido,
            public.tbl_dss_atenciones_medicamentos.id_via,
            public.tbl_dss_atenciones_medicamentos.dosis,
            public.tbl_dss_atenciones_medicamentos.frecuencia,
            public.tbl_dss_atenciones_medicamentos.duracion,
            public.tbl_dss_atenciones_medicamentos.observaciones,
            public.tbl_dss_atenciones_medicamentos.estado,
            concentraciones.nombres AS concentracion,
            formas.nombres AS forma
            FROM
            public.tbl_dss_atenciones_medicamentos
            INNER JOIN public.tbl_dss_atenciones ON public.tbl_dss_atenciones.id_atencion = public.tbl_dss_atenciones_medicamentos.id_atencion
            INNER JOIN public.tbl_dss_medicamentos ON public.tbl_dss_atenciones_medicamentos.id_medicamento = public.tbl_dss_medicamentos.id_medicamento
            INNER JOIN public.a_codigos AS concentraciones ON public.tbl_dss_medicamentos.id_concentracion = concentraciones.codigo
            INNER JOIN public.a_codigos AS formas ON public.tbl_dss_medicamentos.id_forma = formas.codigo
            WHERE
            public.tbl_dss_atenciones_medicamentos.id_atencion = $id_atencion AND
            concentraciones.numero = 124 AND
            formas.numero = 123) AS temporal_table");
            $datatable->setOrderby("id_atencion_medicamento ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAtencionesMedicamentosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_atencion_medicamento", "string");
                $model = AtencionesMedicamentos::findFirstByid_atencion_medicamento((int)$id);
                $model = (!$model) ? new AtencionesMedicamentos() : $model;

                $model->id_atencion = $this->request->getPost("id_atencion", "int");
                $model->id_medicamento = $this->request->getPost("id_medicamento", "int");
                $model->cantidad = $this->request->getPost("cantidad", "string");

                $recibido = $this->request->getPost("recibido", "string");
                if (isset($recibido)) {
                    $model->recibido = 1;
                } else {
                    $model->recibido = 0;
                }

                if ($this->request->getPost("id_via", "int") == "") {
                    $model->id_via = null;
                } else {
                    $model->id_via = $this->request->getPost("id_via", "int");
                }

                $model->dosis = $this->request->getPost("dosis", "string");
                $model->frecuencia = $this->request->getPost("frecuencia", "string");
                $model->duracion = $this->request->getPost("duracion", "string");
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

    public function getAjaxAtencionesMedicamentosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = AtencionesMedicamentos::findFirstByid_atencion_medicamento((int) $this->request->getPost("id", "int"));
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


    public function eliminarAtencionesMedicamentosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = AtencionesMedicamentos::findFirstByid_atencion_medicamento((int) $this->request->getPost("id", "int"));
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

    public function saveAtencionesCie10Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_atencion_cie10", "int");
                $model = AtencionesCie10::findFirstByid_atencion_cie10($id);
                $model = (!$model) ? new AtencionesCie10() : $model;

                $model->id_atencion = $this->request->getPost("id_atencion", "int");
                $model->id_cie10 = $this->request->getPost("id_cie10", "int");
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


    public function datatableAtencionesCie10Action($id_atencion)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_atencion_cie10");
            $datatable->setSelect("id_atencion_cie10,id_atencion,id_cie10,cie10,descripcion,estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_atenciones_cie10.id_atencion_cie10,
            public.tbl_dss_atenciones_cie10.id_atencion,
            public.tbl_dss_atenciones_cie10.id_cie10,
            public.tbl_dss_cie10.cie10,
            public.tbl_dss_cie10.descripcion,
            public.tbl_dss_atenciones_cie10.estado
            FROM
            public.tbl_dss_atenciones_cie10
            INNER JOIN public.tbl_dss_cie10 ON public.tbl_dss_cie10.id_cie10 = public.tbl_dss_atenciones_cie10.id_cie10
            WHERE
            public.tbl_dss_atenciones_cie10.id_atencion = $id_atencion) AS temporal_table");
            $datatable->setOrderby("id_atencion_cie10 ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxAtencionesCie10Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = AtencionesCie10::findFirstByid_atencion_cie10((int) $this->request->getPost("id", "int"));
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


    public function eliminarAtencionesCie10Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = AtencionesCie10::findFirstByid_atencion_cie10((int) $this->request->getPost("id", "int"));
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
