<?php

class RegistrovisitasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrovisitas.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function registroAction($id = null)
    {

        if ($id != null) {
            $visitas = Visitas::findFirstByid_visita((int) $id);
        } else {
            $visitas = Visitas::findFirstByid_visita(0);
            // print($visitas->hora_ingreso);
            // exit();
        }

        $this->view->visitas = $visitas;

        $db = $this->db;
        $visitantes = "SELECT
        public.tbl_web_empresa_publico.id_empresa_publico,
        public.tbl_btr_empresas.razon_social,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
		public.publico.nro_doc,
		public.tbl_btr_empresas.ruc
        FROM
        public.tbl_btr_empresas
        INNER JOIN public.tbl_web_empresa_publico ON public.tbl_web_empresa_publico.id_empresa = public.tbl_btr_empresas.id_empresa
        INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_empresa_publico.id_publico
        ORDER BY
        public.tbl_btr_empresas.razon_social ASC,
        public.publico.apellidop ASC,
        public.publico.apellidom ASC,
        public.publico.nombres ASC";
        $visitantes = $db->fetchAll($visitantes, Phalcon\Db::FETCH_OBJ);
        $this->view->visitantes = $visitantes;

        $personal_model = Personal::find("estado = 'A' ORDER BY apellidop, apellidom, nombres ASC");
        $this->view->personal_model = $personal_model;

        $areas = Areas::find(
            [
                "estado = 'A'",
                'order' => 'nombres',
            ]
        );
        $this->view->areas_model = $areas;


        $motivos = Motivos::find("estado = 'A' AND numero = 128");
        $this->view->motivos_model = $motivos;

        $lugares = Lugares::find(
            [
                "estado = 'A'",
                'order' => 'descripcion',
            ]
        );
        $this->view->lugares_model = $lugares;

        $sedes = Sedes::find(
            [
                "estado = 'A'",
                'order' => 'nombres',
            ]
        );
        $this->view->sedes_model = $sedes;

        $tipodocumentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipodocumentos;

        $empresas = Empresas::find("estado = 'A' ORDER BY razon_social");
        $this->view->empresas = $empresas;

        $publico = Publico::find("estado = 'A' ORDER BY apellidop, apellidom, nombres ASC");
        // foreach ($publico as $key => $value) {
        //    echo "<pre>";
        //    print_r($value->codigo);

        // }
        // exit();
        $this->view->publico = $publico;


        //fecha actual
        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;
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
                $id = (int) $this->request->getPost("id_visita", "int");
                $model = Visitas::findFirstByid_visita($id);
                $model = (!$model) ? new Visitas() : $model;

                if ($this->request->getPost("id_visitante", "int") == "") {
                    $model->id_visitante = null;
                } else {
                    $model->id_visitante = $this->request->getPost("id_visitante", "int");
                }

                if ($this->request->getPost("id_motivo", "int") == "") {
                    $model->id_motivo = null;
                } else {
                    $model->id_motivo = $this->request->getPost("id_motivo", "int");
                }

                if ($this->request->getPost("id_personal", "int") == "") {
                    $model->id_personal = null;
                } else {
                    $model->id_personal = $this->request->getPost("id_personal", "int");
                }

                if ($this->request->getPost("id_area", "int") == "") {
                    $model->id_area = null;
                } else {
                    $model->id_area = $this->request->getPost("id_area", "int");
                }


                if ($this->request->getPost("id_sede", "int") == "") {
                    $model->id_sede = null;
                } else {
                    $model->id_sede = $this->request->getPost("id_sede", "int");
                }

                if ($this->request->getPost("id_lugar", "int") == "") {
                    $model->id_lugar = null;
                } else {
                    $model->id_lugar = $this->request->getPost("id_lugar", "int");
                }

                if ($this->request->getPost("fecha_visita", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_visita", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $model->fecha_visita = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("hora_ingreso", "string") != "") {
                    // $fecha_ex = explode("/", $this->request->getPost("hora_ingreso", "string"));
                    $hora = $this->request->getPost("hora_ingreso", "string");




                    $hora_new = date("H:i:s", strtotime($hora));


                    $model->hora_ingreso = $hora_new;
                }

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

    //Cargamos el datatables
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_visita");
            $datatable->setSelect("id_visita,fecha_visita,visitante,area,personal,motivo,estado,hora_salida,hora_ingreso");
            $datatable->setFrom("(SELECT
            public.tbl_web_visitas.id_visita,
            to_char(public.tbl_web_visitas.fecha_visita, 'DD/MM/YYYY') AS fecha_visita,
            CONCAT (public.tbl_btr_empresas.razon_social,' ', PUBLIC.publico.apellidop, ' ', PUBLIC.publico.apellidom, ' ', PUBLIC.publico.nombres ) AS visitante,
            public.tbl_web_areas.nombres AS area,
            CONCAT ( PUBLIC.tbl_web_personal.apellidop, ' ', PUBLIC.tbl_web_personal.apellidom, ' ', PUBLIC.tbl_web_personal.nombres ) AS personal,
            motivos.nombres AS motivo,
            public.tbl_web_visitas.estado,
            public.tbl_web_visitas.hora_salida,
            public.tbl_web_visitas.hora_ingreso
            FROM
            public.tbl_web_visitas
            INNER JOIN public.tbl_web_empresa_publico ON public.tbl_web_empresa_publico.id_empresa_publico = public.tbl_web_visitas.id_visitante
            INNER JOIN public.a_codigos AS motivos ON motivos.codigo = public.tbl_web_visitas.id_motivo
            INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_visitas.id_personal
            INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_visitas.id_area AND public.tbl_web_areas.codigo = public.tbl_web_visitas.id_area
            INNER JOIN public.tbl_web_sedes ON public.tbl_web_sedes.id_sede = public.tbl_web_visitas.id_sede
            INNER JOIN public.tbl_web_lugares ON public.tbl_web_lugares.id_lugar = public.tbl_web_visitas.id_lugar
            INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_empresa_publico.id_publico
            INNER JOIN public.tbl_btr_empresas ON public.tbl_btr_empresas.id_empresa = public.tbl_web_empresa_publico.id_empresa
            WHERE
            motivos.numero = 128
            ORDER BY
            public.tbl_web_visitas.fecha_visita,
            public.tbl_web_visitas.hora_salida) AS temporal_table");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("id_visita DESC");
            $datatable->getJson();
        }
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = Visitas::findFirstByid_visita((int) $this->request->getPost("id", "int"));
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


    public function getLugaresAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id = $this->request->getPost("pk");
            $model = Lugares::find("id_sede = $id");
            $this->response->setJsonContent($model->toArray());
            $this->response->send();
        }
    }

    public function saveEmpresaPublicoAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $model = (!$model) ? new EmpresaPublicoVisitas() : $model;

                if ($this->request->getPost("id_empresa", "int") == "") {
                    $model->id_empresa = null;
                } else {
                    $model->id_empresa = $this->request->getPost("id_empresa", "int");
                }

                if ($this->request->getPost("id_publico", "int") == "") {
                    $model->id_publico = null;
                } else {
                    $model->id_publico = $this->request->getPost("id_publico", "int");
                }

                $model->email = $this->request->getPost("email", "string");
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

    public function saveEmpresaAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $model = (!$model) ? new EmpresaVisitas() : $model;

                $model->ruc = $this->request->getPost("ruc", "string");
                $model->razon_social = $this->request->getPost("razon_social", "string");
                $model->email = $this->request->getPost("email", "string");
                $model->celular = $this->request->getPost("celular", "string");


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

    public function savePublicoAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $model = (!$model) ? new CiudadanoVisitas() : $model;
                $model->tipo = 0;
                $model->apellidop = strtoupper($this->request->getPost("apellidop"));
                $model->apellidom = strtoupper($this->request->getPost("apellidom"));
                $model->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("documento", "int") == "") {
                    $model->documento = null;
                } else {
                    $model->documento = $this->request->getPost("documento", "int");
                }

                $model->nro_doc = $this->request->getPost("nro_doc", "string");

                $model->celular = $this->request->getPost("celular", "string");
                $model->email = $this->request->getPost("email", "string");
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


    public function saveHoraSalidaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $id_visita = (int) $this->request->getPost("id_visita", "int");
            $model = Visitas::findFirst("id_visita = '{$id_visita}'");
            if ($this->request->getPost("hora_salida", "string") != "") {
                // $fecha_ex = explode("/", $this->request->getPost("hora_ingreso", "string"));
                $hora = $this->request->getPost("hora_salida", "string");




                $hora_new = date("H:i:s", strtotime($hora));


                $model->hora_salida = $hora_new;
            }
            $model->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Visita = Visitas::findFirstByid_visita((int) $this->request->getPost("id_visita", "int"));
            if ($Visita) {
                $this->response->setJsonContent($Visita->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function validaEmpresaPublicoAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_empresa = $this->request->getPost("id_empresa", "int");
            $id_publico = $this->request->getPost("id_publico", "int");

            $empresaPublicoVisitas = EmpresaPublicoVisitas::findFirst(
                            [
                                "id_empresa = $id_empresa AND id_publico = $id_publico"
                            ]
            );



            if ($empresaPublicoVisitas && $empresaPublicoVisitas->estado = 'A') {
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
