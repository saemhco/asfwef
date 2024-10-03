<?php
require_once  APP_PATH . '/app/library/pdf.php';

class RegistroplanillasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {

        $this->view->anio = date("Y");
        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.js?v=" . uniqid());


        $db = $this->db;
        $sql = "SELECT
        public.tbl_per_planillas.id_planilla,
        substring(public.tbl_per_planillas_tipo.nombre, 1, 50)  AS tipo_planilla,
        substring(public.tbl_per_planillas.nombre, 1, 50)  AS planilla,
        public.tbl_per_planillas.numero,
        public.tbl_per_periodos.periodo
        FROM
        public.tbl_per_planillas
        INNER JOIN public.tbl_per_planillas_tipo ON public.tbl_per_planillas.id_planilla_tipo = public.tbl_per_planillas_tipo.id_planilla_tipo
        INNER JOIN public.tbl_per_periodos ON public.tbl_per_periodos.codigo = public.tbl_per_planillas.periodo";
        $planillas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->planillas = $planillas;
    }

    public function saveAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_planilla", "int");
                $model = Planilla::findFirstByid_planilla($id);
                $model = (!$model) ? new Planilla() : $model;

                if ($this->request->getPost("id_planilla_tipo", "int") == "") {
                    $model->id_planilla_tipo = null;
                } else {
                    $model->id_planilla_tipo = $this->request->getPost("id_planilla_tipo", "int");
                }


                if ($this->request->getPost("anio", "int") == "") {
                    $model->anio = null;
                } else {
                    $model->anio = $this->request->getPost("anio", "int");
                }

                if ($this->request->getPost("periodo", "int") == "") {
                    $model->periodo = null;
                } else {
                    $model->periodo = $this->request->getPost("periodo", "int");
                }

                $model->numero = $this->request->getPost("numero", "int");
                $model->nombre = $this->request->getPost("nombre", "string");
                $model->especifica = $this->request->getPost("especifica", "string");
                $model->fuente_financ = $this->request->getPost("fuente_financ", "string");
                $model->rubro = $this->request->getPost("rubro", "string");
                $model->tipo_recurso = $this->request->getPost("tipo_recurso", "string");
                $model->referencia = $this->request->getPost("referencia", "string");
                $model->nro_referencia = $this->request->getPost("nro_referencia", "string");

                if ($this->request->getPost("fecha_inicio", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $model->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin", "string") != "") {

                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $model->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                if ($id == "") {
                    $model->fecha_reg = date("Y-m-d");
                } else {
                    $model->fecha_mod = date("Y-m-d");
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

    public function saveDetallePlanillaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost('planilla');
            $anio = (int) $this->request->getPost('anio');
            $personal = (int) $this->request->getPost('personal');

            //Valida cuando es nuevo
            $DPlanilla = new DetallePlanilla();
            $DPlanilla->codigo = $codigo;
            $DPlanilla->anio = $anio;
            $DPlanilla->personal = $personal;
            $DPlanilla->diastrab = 0;
            $DPlanilla->afp = 0;
            $DPlanilla->estado = "A";
            $DPlanilla->dscto_judicial_pct = 0;
            $DPlanilla->dscto_judicial_soles = 0;
            $DPlanilla->remu_basica = 0;
            $DPlanilla->remu_bruta = 0;
            $DPlanilla->aportaciones = 0;
            $DPlanilla->essalud = 0;
            $DPlanilla->ies = 0;
            $DPlanilla->sctr = 0;
            $DPlanilla->aporte_obligatorio = 0;
            $DPlanilla->prima_seguro = 0;
            $DPlanilla->csr = 0;

            $DPlanilla->cuarta_categoria = 0;
            $DPlanilla->quinta_categoria = 0;
            #Aportes
            $DPlanilla->aportaciones = 0;
            $DPlanilla->essalud = 0;
            $DPlanilla->ies = 0;
            $DPlanilla->sctr = 0;
            //fixeds

            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDetallePlanillaAfpAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $codigo = (int) $this->request->getPost('planilla');
            $personal = (int) $this->request->getPost('personal');
            $afp = (int) $this->request->getPost('afp');

            //Valida cuando es nuevo
            $DPlanilla = PlanillaDetalle::findFirst(" id_planilla = {$codigo} AND personal = {$personal} ");

            $DPlanilla->afp = $afp;
            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDetallePlanillaMetaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $codigo = (int) $this->request->getPost('planilla');
            $personal = (int) $this->request->getPost('personal');
            $meta = $this->request->getPost('meta');

            //Valida cuando es nuevo
            $DPlanilla = PlanillaDetalle::findFirst(
                [
                    "id_planilla = $codigo AND personal = $personal ",
                ]
            );


            $DPlanilla->meta =  $meta;
            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDetallePlanillaDiastrabAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost('planilla');
            $personal = (int) $this->request->getPost('personal');
            $diastrab = (int) $this->request->getPost('diastrab');

            //Valida cuando es nuevo
            $DPlanilla = PlanillaDetalle::findFirst(" id_planilla = {$codigo} AND personal = {$personal} ");

            $DPlanilla->diastrab = $diastrab;
            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDetallePlanillaDscInasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost('planilla');
            $personal = (int) $this->request->getPost('personal');
            $d_inas = (float) $this->request->getPost('d_inas');

            //Valida cuando es nuevo
            $DPlanilla = PlanillaDetalle::findFirst(" id_planilla = {$codigo} AND personal = {$personal} ");

            $DPlanilla->d_inas  = $d_inas;
            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDetallePlanillaDscTardAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost('planilla');
            $personal = (int) $this->request->getPost('personal');
            $d_tard = (float) $this->request->getPost('d_tard');

            //Valida cuando es nuevo
            $DPlanilla = PlanillaDetalle::findFirst(" id_planilla = {$codigo} AND personal = {$personal} ");

            $DPlanilla->d_tard = $d_tard;
            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDetallePlanillaJudicialAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost('planilla');
            $personal = (int) $this->request->getPost('personal');
            $d_judicial = (int) $this->request->getPost('d_judicial');

            //Valida cuando es nuevo
            $DPlanilla = PlanillaDetalle::findFirst(" id_planilla = {$codigo} AND personal = {$personal} ");

            $DPlanilla->d_judicial = $d_judicial;
            $DPlanilla->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $DPlanilla));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function savedetallepagoAction()
    {


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                echo "<pre>";
                print_r($_POST);
                exit();


                $codigo = (int) $this->request->getPost('planilla');
                $personal = (int) $this->request->getPost('personal');

                //Valida cuando es nuevo
                $DPlanilla = PlanillaDetalle::findFirst(
                    [
                        "id_planilla_detalle = $codigo AND personal = $personal ",
                    ]
                );

                #ingresos
                foreach ($_POST["ingresos-value"] as $key => $val) {
                    $temp_name = "ing" . ($key + 1);
                    $DPlanilla->$temp_name = $val;
                }

                #Descuentos
                foreach ($_POST["descuentos-value"] as $key => $val) {
                    $temp_name = "desc" . ($key + 1);
                    $DPlanilla->$temp_name = $val;
                }

                #Aportes
                foreach ($_POST["aportes-value"] as $key => $val) {
                    $temp_name = "ap" . ($key + 1);
                    $DPlanilla->$temp_name = $val;
                }

                #Manuales
                #Ingresos
                $DPlanilla->remu_basica = (float) $this->request->getPost('remu_basica');
                $DPlanilla->remu_bruta = (float) $this->request->getPost('remu_bruta');
                #Descuentos
                $DPlanilla->aporte_obligatorio = (float) $this->request->getPost('aporte_obligatorio');
                $DPlanilla->prima_seguro = (float) $this->request->getPost('prima_seguro');
                $DPlanilla->csr = (float) $this->request->getPost('csr');

                $DPlanilla->cuarta_categoria = (float) $this->request->getPost('cuarta_categoria');
                $DPlanilla->quinta_categoria = (float) $this->request->getPost('quinta_categoria');

                $DPlanilla->dscto_judicial_pct = (float) $this->request->getPost('dscto_judicial_pct');
                $DPlanilla->dscto_judicial_soles = (float) $this->request->getPost('dscto_judicial_soles');
                #Aportes
                $DPlanilla->aportaciones = (float) $this->request->getPost('aportaciones');
                $DPlanilla->essalud = (float) $this->request->getPost('essalud');
                $DPlanilla->ies = (float) $this->request->getPost('ies');
                $DPlanilla->sctr = (float) $this->request->getPost('sctr');

                #Pk compuesto
                $DPlanilla->codigo = $codigo;
                $DPlanilla->personal = $personal;

                if ($DPlanilla->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Tconfig->getMessages());
                } else {
                    //Cuando va bien

                    $this->response->setStatusCode(200, "OK");
                    //$this->response->setJsonContent($PromedioDetalle);
                    $this->response->setJsonContent(array("say" => "yes", "data" => $DPlanilla));
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

    public function planilladetallecasAction($id)
    {
        $this->view->id = $id;
        //cuando se va editar

        $Planilla = Planilla::findFirst(
            [
                "id_planilla = $id",
            ]
        );

        $regimens = Afp::find("estado = 'A' ORDER BY regimen DESC ");
        $this->view->regimens = $regimens;

        // print("anio:".$anio);
        // exit();

        $metas = SiafMeta::find("anio= CAST($Planilla->anio AS VARCHAR) AND estado = 'A' ORDER BY sec_func ASC ");
        // foreach ($metas as $value) {
        //         echo "<pre>";
        //         print_r($value->sec_func);
        // }
        // exit();
        $this->view->metas = $metas;


        // print($Planilla->id_planilla_tipo);
        // exit();

        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($Planilla->id_planilla_tipo);
        $periodo = Periodos::findFirstBycodigo($Planilla->periodo);

        $this->view->planilla = $Planilla;
        $this->view->tipoplanilla = $tipoplanilla;
        $this->view->periodo = $periodo;

        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.planilladetallecas.js?v=" . uniqid());
    }

    public function verifica_rango($date_inicio, $date_fin, $date_nueva)
    {
        $date_inicio = strtotime($date_inicio);
        $date_fin = strtotime($date_fin);
        $date_nueva = strtotime($date_nueva);
        if (($date_nueva >= $date_inicio) && ($date_nueva <= $date_fin))
            return true;
        return false;
    }

    public function detallepago1Action($planilla_id, $personal_id)
    {
        $Planilla = Planilla::findFirst(
            [
                "id_planilla = $planilla_id",
            ]
        );




        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($Planilla->id_planilla_tipo);
        $Periodo = Periodos::findFirstBycodigo($Planilla->periodo);
        $Personal = Personal::findFirstBycodigo($personal_id);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");



        $contrato = Contratos::findFirst(["personal = $personal_id "]);
        $this->view->contrato = $contrato;

        $tipo_servidor = Acodigos::findFirst(["numero = 59 AND codigo = {$contrato->categoria_laboral} "]);
        $this->view->tipo_servidor = $tipo_servidor;


        $periodo_e = explode("-", $Periodo->periodo);
        $mes = (int) $periodo_e[0];

        $mes_text = strtoupper($meses[$mes - 1]);
        $this->view->mes_text = $mes_text;



        $PlanillaDetalle = PlanillaDetalle::findFirst(
            [
                "id_planilla = $planilla_id AND personal = $personal_id ",
            ]
        );


        $Area = Areas::findFirstBycodigo($contrato->area);
        $this->view->area = $Area;


        $regimens = array("1" => "SNP ONP", "2" => "SPP AFP");

        $afp = Afp::findFirstBycodigo($PlanillaDetalle->afp);
        $regimen = $regimens[$afp->regimen];

        $db = $this->db;
        $sql = "SELECT
        public.tbl_per_afp_detalles.aporte,
        public.tbl_per_afp_detalles.prima,
        public.tbl_per_afp_detalles.comision,
        public.tbl_per_afp_detalles.rma
        FROM
        public.tbl_per_planillas
        INNER JOIN public.tbl_per_planillas_detalle ON public.tbl_per_planillas.id_planilla = public.tbl_per_planillas_detalle.id_planilla
        INNER JOIN public.tbl_per_afp_detalles ON public.tbl_per_planillas_detalle.afp = public.tbl_per_afp_detalles.afp AND public.tbl_per_planillas.periodo = public.tbl_per_afp_detalles.periodo
        WHERE
        public.tbl_per_planillas_detalle.id_planilla = $planilla_id AND
        public.tbl_per_planillas_detalle.personal = $personal_id";
        //echo "<pre>";print_r($sql);exit();
        $detalleafp = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->detalleafp = $detalleafp;


        $this->view->planilla = $Planilla;
        $this->view->periodo = $Periodo;
        $this->view->personal = $Personal;

        $this->view->planilladetalle = $PlanillaDetalle;
        $this->view->tipoplanilla = $tipoplanilla;
        $this->view->regimen = $regimen;
        $this->view->afp = $afp;

        $this->view->planilla_id = $planilla_id;
        $this->view->personal_id = $personal_id;



        $VPlanillaS = VPlanillasCas::findFirst(
            [
                "id_planilla = $planilla_id AND id_personal = $personal_id ",
            ]
        );


        $this->view->vplanillas = $VPlanillaS;




        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.detallepago1.js?v=" . uniqid());
    }

    public function configuracionAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.config.js?v=" . uniqid());
    }

    public function configAction($tipo_planilla_id)
    {
        $this->view->id = $tipo_planilla_id;
        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($tipo_planilla_id);
        $config = TipoPlanillaDetalle::findFirstByplanilla_tipo($tipo_planilla_id);

        $nuevo = 0;
        if ($config) {
            $this->view->config = $config->toArray();
            $nuevo = 1;
        }

        $this->view->tipoplanilla = $tipoplanilla;
        $this->view->nuevo = $nuevo;
        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.config.js?v=" . uniqid());
    }

    public function saveconfigAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $Tconfig = TipoPlanillaDetalle::findFirstByplanilla_tipo($this->request->getPost("tipoplanilla", "int"));

                $Tconfig = (!$Tconfig) ? new TipoPlanillaDetalle() : $Tconfig;

                #ingresos
                foreach ($_POST["ingresos-etq"] as $key => $val) {
                    $temp_name = "ing" . ($key + 1) . "_desc";
                    $Tconfig->$temp_name = $val;
                }

                foreach ($_POST["ingresos-factor"] as $key => $val) {
                    $temp_name = "ing" . ($key + 1) . "_factor";
                    $Tconfig->$temp_name = $val;
                }

                #Descuentos
                foreach ($_POST["descuentos-etq"] as $key => $val) {
                    $temp_name = "desc" . ($key + 1) . "_desc";
                    $Tconfig->$temp_name = $val;
                }

                foreach ($_POST["descuentos-factor"] as $key => $val) {
                    $temp_name = "desc" . ($key + 1) . "_factor";
                    $Tconfig->$temp_name = $val;
                }

                #Aportes
                foreach ($_POST["aportes-etq"] as $key => $val) {
                    $temp_name = "ap" . ($key + 1) . "_desc";
                    $Tconfig->$temp_name = $val;
                }

                foreach ($_POST["aportes-factor"] as $key => $val) {
                    $temp_name = "ap" . ($key + 1) . "_factor";
                    $Tconfig->$temp_name = $val;
                }

                if (isset($_POST["afecta_afp"])) {
                    $Tconfig->afecta_afp = 1;
                } else {
                    $Tconfig->afecta_afp = 0;
                }

                $Tconfig->planilla_tipo = (int) $this->request->getPost("tipoplanilla", "int");
                $Tconfig->cuarta_cat = (float) $this->request->getPost("cuarta_cat", "float");
                $Tconfig->quinta_cat = (float) $this->request->getPost("quinta_cat", "float");

                if ($Tconfig->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Tconfig->getMessages());
                } else {
                    //Cuando va bien

                    $this->response->setStatusCode(200, "OK");
                    //$this->response->setJsonContent($PromedioDetalle);
                    $this->response->setJsonContent(array("say" => "yes", "data" => $Tconfig));
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

    public function registroAction($id = null)
    {


        $this->view->id = $id;
        if ($id != null) {
            $Planilla = Planilla::findFirstByid_planilla((int) $id);
        } else {

            $Planilla = Planilla::findFirstByid_planilla(0);
        }
        $this->view->planilla = $Planilla;

        $anios = Anios::find(
            [
                "estado = 'A' AND numero = 40",
                'order' => 'descripcion DESC',
            ]
        );
        $this->view->anios = $anios;

        //Tipo Planillas
        $TipoPlanillas = TipoPlanillas::find(" nombre != ''  ORDER BY nombre ");
        $this->view->tipoplanillas = $TipoPlanillas;

        //Periodos
        $Periodos = Periodos::find(" periodo LIKE '%" . $Planilla->$anio . "%'  ORDER BY codigo DESC ");
        $this->view->periodos = $Periodos;

        //Referencia
        $Referencias = Referencias::find(" estado = 'A' ORDER BY descripcion DESC ");
        $this->view->referencias = $Referencias;

        $fecha_actual = date('d/m/Y');
        $this->view->fecha_actual = $fecha_actual;

        $anio_actual = date("Y");
        $this->view->anio_actual = $anio_actual;

        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.form.js?v=" . uniqid());
    }

    public function opcionesMetaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = SiafMeta::findByanio($this->request->getPost("anio", "string"));
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

    public function opcionesEspecificaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = SiafEspecifica::findByano_eje($this->request->getPost("anio", "string"));

            // echo "<pre>";
            // print_r($_POST);
            // exit();

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

    public function opcionesFuentefinanciamientoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = SiafFuenteFinanciamiento::find(
                [
                    'order' => 'codigo ASC',
                ]
            );
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

    public function opcionesRubroAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $anio = $this->request->getPost("anio", "string");
            $fuente_financ = $this->request->getPost("fuente_financ", "string");

            // print("Anio:".$anio." - fuente: ".$fuente_financ);
            // exit();

            $obj = SiafRubros::find(" ano_eje='" . $anio . "' AND fuente_financ='" . $fuente_financ . "' ORDER BY rubro ASC");

            // foreach ($obj as $key => $value) {
            //     echo "<pre>";
            //     print_r($value->nombre);
            // }
            // exit();



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

    public function opcionesTipoRecursoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $anio = $this->request->getPost("anio", "string");
            $rubro = $this->request->getPost("rubro", "string");

            // print("Anio:".$anio." - rubro: ".$rubro);
            // exit();

            $obj = SiafTipoRecursos::find(" ano_eje='" . $anio . "' AND fuente_financ='" . $rubro . "' ORDER BY tipo_recurso ASC");

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


    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_planilla");
            $datatable->setSelect("id_planilla,tipo_planilla,numero,fecha_inicio,fecha_fin,estado, nombre, periodo, id_planilla_tipo,abrev");
            $datatable->setFrom("(SELECT
            public.tbl_per_planillas.id_planilla,
            public.tbl_per_planillas_tipo.nombre AS tipo_planilla,
            public.tbl_per_planillas.numero,
            to_char( public.tbl_per_planillas.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
            to_char( public.tbl_per_planillas.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
            public.tbl_per_planillas.estado,
            public.tbl_per_planillas.nombre,
            public.tbl_per_periodos.periodo,
            public.tbl_per_planillas.id_planilla_tipo,
            public.tbl_per_planillas_tipo.abrev
            FROM
            public.tbl_per_planillas
            INNER JOIN public.tbl_per_planillas_tipo ON public.tbl_per_planillas_tipo.id_planilla_tipo = public.tbl_per_planillas.id_planilla_tipo
            INNER JOIN public.tbl_per_periodos ON public.tbl_per_planillas.periodo = public.tbl_per_periodos.codigo
            ORDER BY
            public.tbl_per_periodos.periodo DESC,tbl_per_planillas_tipo.nombre DESC,public.tbl_per_planillas.numero DESC) AS temporal_table");
            $datatable->setOrderby("periodo DESC,tipo_planilla DESC,numero DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    #Los del contrato en fecha vigente
    public function datatableContAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $fecha_actual = date("Y-m-d");

            //$fecha_inicio_sustitutorio = strtotime(date($semestre->fecha_inicio_sustitutorio));
            //$fecha_final_sustitutorio  = strtotime(date($semestre->fecha_fin_sustitutorio));

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("tpc.personal");
            $datatable->setSelect(" twp.nombres, twp.apellidop, twp.apellidom, tpc.id_contrato, tpc.anio, tpc.tipo,tpc.concurso, concat_ws(' ',twp.apellidop, twp.apellidom, twp.nombres) AS full_name,
                                    tpc.fecha_inicio, tpc.fecha_fin, twp.codigo as personal_code , tpc.fecha_fin_adenda,tpc.estado, tpc.dependencia AS areas");
            $datatable->setFrom("public.tbl_per_contratos tpc
                INNER JOIN public.tbl_web_personal twp ON twp.codigo = tpc.personal");
            $datatable->setWhere("twp.estado = 'A' AND tpc.estado = 'A' AND tpc.fecha_fin_adenda > to_date('{$fecha_actual}','YYYY-MM-DD') AND tpc.fecha_inicio < to_date('{$fecha_actual}','YYYY-MM-DD') AND twp.codigo NOT IN (
                    SELECT personal FROM public.tbl_per_planillas_detalle
                )  ");
            $datatable->setOrderby("twp.apellidop, twp.apellidom , twp.nombres ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    #Trabajadores registrados por planilla
    public function datatablePlanillaDetalleCasAction($codigo)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("tpp.personal");
            $datatable->setSelect(" twp.nombres,tpp.diastrab,tpp.personal, twp.apellidop, twp.apellidom, tpp.id_planilla_detalle, tpp.estado, tpp.afp,tpp.meta,tpp.d_tard, tpp.d_inas, tpp.d_judicial");
            $datatable->setFrom("public.tbl_per_planillas_detalle tpp
                INNER JOIN public.tbl_web_personal twp ON twp.codigo = tpp.personal");
            $datatable->setWhere("tpp.estado = 'A' AND tpp.id_planilla ={$codigo}");
            $datatable->setOrderby("twp.apellidop,twp.apellidom,twp.nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    #Tipos de planilla
    public function datatableTipoPlanillaAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_planilla_tipo");
            $datatable->setSelect("id_planilla_tipo, nombre,estado");
            $datatable->setFrom("public.tbl_per_planillas_tipo");
            $datatable->setOrderby("nombre ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveTipoPlanillaAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Tp = TipoPlanillas::findFirstBycodigo($id);
                $Tp = (!$Tp) ? new TipoPlanillas() : $Tp;
                $Tp->nombre = $this->request->getPost("nombre", "string");
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Tp->estado = "A";
                } else {
                    $Tp->estado = "X";
                }

                if ($id == "") {
                    $count = TipoPlanillas::count();
                    if ($count >= 0) {

                        $id_pk = $count + 1;
                        $Tp->codigo = $id_pk;
                    }
                }

                if ($Tp->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Tp->getMessages());
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

    public function getTipoPlanillasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Tp = TipoPlanillas::findFirstByid_planilla_tipo((int) $this->request->getPost("id", "int"));
            if ($Tp) {
                $this->response->setJsonContent($Tp->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarTipoPlanillasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Tp = TipoPlanillas::findFirstByid_planilla_tipo((int) $this->request->getPost("id", "int"));
            if ($Tp && $Tp->estado = 'A') {
                $Tp->estado = 'X';
                $Tp->save();
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

    public function afpAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.afp.js?v=" . uniqid());
    }
    #Tipos de planilla
    public function datatableAfpAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, regimen,nombre,estado");
            $datatable->setFrom("public.tbl_per_afp");
            $datatable->setWhere("estado != '' ");
            $datatable->setOrderby("regimen DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAfpAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (int) $this->request->getPost("codigo", "int");
                $Afp = Afp::findFirstBycodigo($id);
                $Afp = (!$Afp) ? new Afp() : $Afp;
                $Afp->nombre = $this->request->getPost("nombre", "string");
                $Afp->regimen = $this->request->getPost("regimen", "int");
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $Afp->estado = "A";
                } else {
                    $Afp->estado = "X";
                }

                if ($id == "") {
                    $count = Afp::count();
                    if ($count >= 0) {

                        $id_pk = $count + 1;
                        $Afp->codigo = $id_pk;
                    }
                }

                if ($Afp->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Afp->getMessages());
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

    public function getAfpAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Tp = Afp::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Tp) {
                $this->response->setJsonContent($Tp->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAfpAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Tp = Afp::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($Tp && $Tp->estado = 'A') {
                $Tp->estado = 'X';
                $Tp->save();
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

    public function detalleafpAction($afp, $anio)
    {
        //Datos AFP
        $Afp = Afp::findFirstBycodigo($afp);
        $this->view->afp = $Afp;
        //Periodos
        $Periodos = Periodos::find(" periodo LIKE '%" . $anio . "%'  ORDER BY codigo DESC ");
        $this->view->periodos = $Periodos;
        $this->view->anio = $anio;

        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.afp.detalle.js?v=" . uniqid());
    }

    public function datatableAfpDetalleAction($afp)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pfd.codigo");
            $datatable->setSelect("pfd.codigo, pfd.aporte, pfd.prima, pfd.csr, pfd.periodo, tpp.periodo as periodo_desc, pfd.estado");
            $datatable->setFrom("
                                    public.tbl_per_afp_detalles pfd
                                    INNER JOIN public.tbl_per_periodos tpp ON pfd.periodo = tpp.codigo
                                ");
            $datatable->setWhere("pfd.afp = " . $afp);
            $datatable->setOrderby("pfd.periodo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDetalleAfpAction()
    {
        $this->view->disable();

        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = (int) $this->request->getPost('codigo');

            $afp = (int) $this->request->getPost('afp');
            $periodo = (int) $this->request->getPost('periodo');

            if ($codigo == "") {
                $AfpD = AfpDetalle::findFirst(
                    [
                        "afp = $afp AND periodo = $periodo ",
                    ]
                );
            } else {
                $AfpD = false;
            }

            if ($AfpD) {
                #Ya existe
                $this->response->setJsonContent(array("say" => "no", "msg" => "Ya se registro los datos de Afp en este periodo"));
            } else {
                #Grabar
                #La ultimita de ese año
                $cAfpD = AfpDetalle::count(
                    [
                        "afp = $afp ",
                    ]
                );

                if ($cAfpD >= 0) {
                    $codigoSave = $cAfpD + 1;
                }

                $AfpD = AfpDetalle::findFirst(
                    [
                        "codigo = $codigo AND afp = $afp",
                    ]
                );

                //Valida cuando es nuevo
                $AfpD = (!$AfpD) ? new AfpDetalle() : $AfpD;
                $AfpD->periodo = $this->request->getPost("periodo", "int");
                $AfpD->afp = $this->request->getPost("afp", "int");
                $AfpD->aporte = $this->request->getPost("aporte", "float");
                $AfpD->prima = $this->request->getPost("prima", "float");
                $AfpD->csr = $this->request->getPost("csr", "float");

                if ($codigo == "") {
                    $AfpD->codigo = $codigoSave;
                }
                $AfpD->estado = "A";
                $AfpD->save();

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes", "obj" => $AfpD));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function getAfpDetalleAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = $this->request->getPost("id", "int");
            $afp = $this->request->getPost("afp", "int");
            $Tp = AfpDetalle::findFirst(" afp={$afp} AND codigo = {$codigo} ");
            if ($Tp) {
                $this->response->setJsonContent($Tp->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAfpDetalleAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo = $this->request->getPost("id", "int");
            $afp = $this->request->getPost("afp", "int");
            $Tp = AfpDetalle::findFirst(" afp={$afp} AND codigo = {$codigo} ");
            if ($Tp && $Tp->estado = 'A') {
                $Tp->estado = 'X';
                $Tp->save();
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

    public function detallepagoPdf1Action($planilla_id, $personal_id)
    {
        $this->view->disable();


        // print("Reporte de planilla en desarrollo...");
        // exit();

        $Planilla = Planilla::findFirst(
            [
                "id_planilla = $planilla_id",
            ]
        );



        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($Planilla->id_planilla_tipo);
        $Periodo = Periodos::findFirstBycodigo($Planilla->periodo);
        $Personal = Personal::findFirstBycodigo($personal_id);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");




        $contrato = Contratos::findFirst(["personal = $personal_id "]);
        //$this->view->contrato = $contrato;

        $tipo_servidor = Acodigos::findFirst(["numero = 59 AND codigo = {$contrato->categoria_laboral} "]);
        //$this->view->tipo_servidor = $tipo_servidor;

        $periodo_e = explode("-", $Periodo->periodo);
        $mes = (int) $periodo_e[0];

        $mes_text = ($meses[$mes - 1]);
        //$this->view->mes_text = $mes_text;

        $Config = TipoPlanillaDetalle::findFirstByplanilla_tipo($Planilla->id_planilla_tipo);

        $PlanillaDetalle = PlanillaDetalle::findFirst(
            [
                "id_planilla = $planilla_id AND personal=$personal_id ",
            ]
        );


        $VPlanillaS = VPlanillasCas::findFirst(
            [
                "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
            ]
        );





        //ARea
        $Area = Areas::findFirstBycodigo($contrato->area);
        //$this->view->area = $Area;

        $regimens = array("1" => "SNP ONP", "2" => "SPP AFP");

        $afp = Afp::findFirstBycodigo($PlanillaDetalle->afp);
        $regimen = $regimens[$afp->regimen];


        $where = "afp = {$PlanillaDetalle->afp} AND periodo = $Planilla->periodo";
        //print $where;exit();
        $detalleAfp = AfpDetalle::findFirst([$where]);
        //$this->view->detalleafp = $detalleAfp;



        $pdf = new PDF();
        $pdf->AddPage('L');
        $pdf->Image('webpage/assets/img/logo-vr.png', 210, 15, 70);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(5);
        $pdf->Cell(270, 155, '  ', 1, 0, 'C');
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->cell(5);
        $pdf->Cell(270, 15, $this->config->global->xNombreIns, 0, 0, 'C');
        $pdf->Ln(1);
        $pdf->cell(5);
        $pdf->Cell(270, 25, '  BOLETA DE PAGO ', 0, 0, 'C');
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->cell(5);
        $pdf->Cell(270, 35, '  RUC: ' . $this->config->global->xRUCIns, 0, 0, 'C');
        $pdf->Ln(30);

        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(10);
        $pdf->Cell(50, 5, "Nombres y Apellidos: {$Personal->apellidop} {$Personal->apellidom} {$Personal->nombres}", 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Mes de Pago:', 0, 0, 'L');
        $pdf->Cell(50, 5, $mes_text, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Cargo: ' . $contrato->cargo, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Fecha de Nacimiento:', 0, 0, 'L');
        $pdf->Cell(50, 5, date("d/m/Y", strtotime($Personal->fecha_nacimiento)), 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Tipo de Servidor: ' . $tipo_servidor->nombres, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Número de DNI:', 0, 0, 'L');
        $pdf->Cell(50, 5, $Personal->nro_doc, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Código de ESSALUD: ' . $Personal->seguro_nro, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Fecha de Ingreso:', 0, 0, 'L');
        $pdf->Cell(50, 5, date("d/m/Y", strtotime($Personal->fecha_ingreso)), 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Régimen Pensionario: ' . $regimen . ' ' . $afp->nombre, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Días Trabajados:', 0, 0, 'L');
        $pdf->Cell(50, 5, $PlanillaDetalle->diastrab, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'CUSPP: ' . $Personal->cusp, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Vacaciones del:', 0, 0, 'L');
        $pdf->Cell(50, 5, '', 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(5);
        $pdf->Cell(90, 5, 'REMUNERACIONES', 1, 0, 'C');
        $pdf->Cell(90, 5, 'DESCUENTOS', 1, 0, 'C');
        $pdf->Cell(90, 5, 'APORTACIONES DEL EMPLEADOR', 1, 0, 'C');
        $pdf->Ln(5);

        $pdf->Cell(5);
        $pdf->Cell(90, 80, '', 1, 0, 'C');
        $pdf->Cell(90, 80, '', 1, 0, 'C');
        $pdf->Cell(90, 80, '', 1, 0, 'C');
        $pdf->Ln(0);





        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'HONORARIOS CAS', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->rem_basica, 0, 0, 'R');


        $pdf->Cell(60, 5, 'SPP - Aporte AFP', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->afp_aporte, 0, 0, 'R');

        $pdf->Cell(60, 5, 'ESSALUD', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->aessalud, 1, 1, 'R');


        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'AGUINALDO JULIO', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->i_aguin_jul, 1, 0, 'R');


        $pdf->Cell(60, 5, 'SPP - Prima Seguro AFP', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->afp_prima, 1, 1, 'R');


        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'AGUINALDO DICIEMBRE', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->i_aguin_dic, 1, 0, 'R');



        $pdf->Cell(60, 5, 'SPP - Comision AFP', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->afp_comision, 1, 1, 'R');


        $pdf->Cell(5);
        $pdf->Cell(90);

        $pdf->Cell(60, 5, 'Tardanzas', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->d_tard, 1, 1, 'R');
        $pdf->Cell(90);

        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'Inasistencia', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->d_inas, 1, 1, 'R');

        $pdf->Cell(5);
        $pdf->Cell(90);

        $pdf->Cell(60, 5, 'Judicial', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->d_judicial, 1, 1, 'R');
        $pdf->Cell(90);

        $pdf->Cell(5);
        $pdf->Cell(60, 5, '4ta Categoria', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->cuarta_cat, 1, 0, 'R');




        $pdf->SetXY(10, 158);


        $pdf->Cell(5);
        $pdf->Cell(90, 7, 'S/. ' . number_format($VPlanillaS->rem_bruta, 2, '.', ''), 1, 0, 'R');
        $pdf->Cell(90, 7, 'S/. ' . number_format($VPlanillaS->descuentos, 2, '.', ''), 1, 0, 'R');
        $pdf->Cell(90, 7, 'RESUMEN', 1, 0, 'C');
        $pdf->Ln(7);

        $pdf->Cell(5);
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(60, 7, 'TOTAL REMUNERACIONES', 1, 0, 'L');
        $pdf->Cell(30, 7, 'S/. ' . $VPlanillaS->rem_bruta, 1, 0, 'R');
        $pdf->Ln(7);
        $pdf->Cell(5);
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(60, 7, 'TOTAL DESCUENTOS', 1, 0, 'L');
        $pdf->Cell(30, 7, 'S/. ' . $VPlanillaS->descuentos, 1, 0, 'R');
        $pdf->Ln(7);
        $pdf->Cell(5);
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(60, 7, 'REMUNERACION NETA', 1, 0, 'L');
        $pdf->Cell(30, 7, 'S/. ' . $VPlanillaS->rem_neta, 1, 0, 'R');
        $pdf->Ln(7);

        $pdf->Output();
    }

    //Eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $planilla = Planilla::findFirstBycodigo((int) $this->request->getPost("id", "int"));
            if ($planilla && $planilla->estado = 'A') {
                $planilla->estado = 'X';
                $planilla->save();
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

    public function generarPlanillasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $idplanilla = $this->request->getPost("id_planilla", "int");


            $personal = Personal::find("estado = 'A' AND codigo > 0");

            foreach ($personal as $valuePersonal) {

                //echo "<pre>";
                //print_r("descuento_judicial_p:" . $valuePersonal->descuento_judicial_p);
                //print_r("descuento_judicial_m:" . $valuePersonal->descuento_judicial_m);

                // if ($valuePersonal->descuento_judicial_p == null) {
                //    print_r("va p con 0");
                // }
                // if ($valuePersonal->descuento_judicial_m == null) {
                //     print_r("va m con 0");
                //  }




                $verifica = PlanillaDetalle::find("id_planilla = $idplanilla AND personal = $valuePersonal->codigo");

                if (count($verifica) == 0) {

                    // $planillaDetalle1 = new PlanillaDetalle();
                    // $planillaDetalle1->id_planilla = $idplanilla;
                    // $planillaDetalle1->personal = $valuePersonal->codigo;
                    // $planillaDetalle1->diastrab = 30;
                    // $planillaDetalle1->i_rem_basica = 0;
                    // $planillaDetalle1->save();




                    $planillaDetalle = new PlanillaDetalle();
                    $planillaDetalle->id_planilla = $idplanilla;
                    $planillaDetalle->personal = $valuePersonal->codigo;
                    $planillaDetalle->afp = $valuePersonal->afp;
                    $planillaDetalle->nro_cta = $valuePersonal->nro_cta;
                    $planillaDetalle->cuspp = $valuePersonal->cuspp;

                    $contrato = Contratos::findFirst(
                        [
                            "personal = $valuePersonal->codigo",
                        ]
                    );

                    $planillaDetalle->i_rem_basica = $contrato->monto;
                    $planillaDetalle->d_judicial = 0;

                    if ($valuePersonal->descuento_judicial_m > 0) {
                        $planillaDetalle->d_judicial = $valuePersonal->descuento_judicial_m;
                    }

                    if ($valuePersonal->descuento_judicial_p > 0) {
                        $planillaDetalle->d_judicial = ($contrato->monto * $valuePersonal->descuento_judicial_p) / 100;
                    }

                    $planillaDetalle->diastrab = 30;
                    $planillaDetalle->meta = '0000';
                    $planillaDetalle->i_rem_aseg = 0;
                    $planillaDetalle->i_aguin_jul = 0;
                    $planillaDetalle->i_aguin_dic = 0;
                    $planillaDetalle->d_tard = 0;
                    $planillaDetalle->d_inas = 0;
                    $planillaDetalle->d_4ta_cat = 0;
                    $planillaDetalle->d_5ta_cat = 0;
                    $planillaDetalle->a_essalud = 0;
                    $planillaDetalle->renta = '0';
                    $planillaDetalle->afp_no = '0';
                    $planillaDetalle->estado = "A";
                    $planillaDetalle->save();
                }
            }
            //exit();

            if ($personal) {
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


    public function saveAguinaldoJulioAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $i_aguin_jul = (string) $this->request->getPost('i_aguin_jul');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->i_aguin_jul = $i_aguin_jul;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveAguinaldoDiciembreAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $i_aguin_dic = (string) $this->request->getPost('i_aguin_dic');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->i_aguin_dic = $i_aguin_dic;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDTardanzaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $d_tard = (string) $this->request->getPost('d_tard');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->d_tard = $d_tard;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDInasistenciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $d_inas = (string) $this->request->getPost('d_inas');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->d_inas = $d_inas;
            $PlanillaDetalle->save();


            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDJudicialAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $d_judicial = (string) $this->request->getPost('d_judicial');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->d_judicial = $d_judicial;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveRentaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $renta = (string) $this->request->getPost('renta');

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            if ($renta == '1') {
                $PlanillaDetalle->renta = "1";
                $PlanillaDetalle->save();
            } else if ($renta == '0') {
                $PlanillaDetalle->renta = "0";
                $PlanillaDetalle->save();
            }

            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }


    public function saveAfpnoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $afp_no = (string) $this->request->getPost('afp_no');

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            if ($afp_no == '1') {
                $PlanillaDetalle->afp_no = "1";
                $PlanillaDetalle->save();
            } else if ($afp_no == '0') {
                $PlanillaDetalle->afp_no = "0";
                $PlanillaDetalle->save();
            }


            $VPlanillaS = VPlanillasCas::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );


            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function planilladetalledocentesAction($id)
    {
        $this->view->id = $id;
        //cuando se va editar

        $Planilla = Planilla::findFirst(
            [
                "id_planilla = $id",
            ]
        );

        $regimens = Afp::find("estado = 'A' ORDER BY regimen DESC ");
        $this->view->regimens = $regimens;

        // print("anio:".$anio);
        // exit();

        $metas = SiafMeta::find("anio= CAST($Planilla->anio AS VARCHAR) AND estado = 'A' ORDER BY sec_func ASC ");
        // foreach ($metas as $value) {
        //         echo "<pre>";
        //         print_r($value->sec_func);
        // }
        // exit();
        $this->view->metas = $metas;


        // print($Planilla->id_planilla_tipo);
        // exit();

        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($Planilla->id_planilla_tipo);
        $periodo = Periodos::findFirstBycodigo($Planilla->periodo);

        $this->view->planilla = $Planilla;
        $this->view->tipoplanilla = $tipoplanilla;
        $this->view->periodo = $periodo;

        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.planilladetalledocentes.js?v=" . uniqid());
    }

    public function datatablePlanillaDetalleDocentesAction($codigo)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_docente");
            $datatable->setSelect("id_planilla,id_docente,nombres, diastrab, personal, apellidop, apellidom, id_planilla_detalle, estado, afp, meta, d_tard, d_inas, d_judicial");
            $datatable->setFrom("(SELECT
            public.docentes.codigo AS id_docente,
            public.docentes.nombres,
            public.tbl_per_planillas_detalle.diastrab,
            public.tbl_per_planillas_detalle.personal,
            public.docentes.apellidop,
            public.docentes.apellidom,
            public.tbl_per_planillas_detalle.id_planilla_detalle,
            public.tbl_per_planillas_detalle.id_planilla,
            public.tbl_per_planillas_detalle.estado,
            public.tbl_per_planillas_detalle.afp,
            public.tbl_per_planillas_detalle.meta,
            public.tbl_per_planillas_detalle.d_tard,
            public.tbl_per_planillas_detalle.d_inas,
            public.tbl_per_planillas_detalle.d_judicial
            FROM
            public.docentes
            INNER JOIN public.tbl_per_planillas_detalle ON public.tbl_per_planillas_detalle.personal = public.docentes.codigo) AS temporal_table");
            $datatable->setWhere("estado = 'A' AND id_planilla ={$codigo}");
            $datatable->setOrderby("apellidop,apellidom,nombres");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function detallepago2Action($planilla_id, $personal_id)
    {
        $Planilla = Planilla::findFirst(
            [
                "id_planilla = $planilla_id",
            ]
        );




        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($Planilla->id_planilla_tipo);
        $Periodo = Periodos::findFirstBycodigo($Planilla->periodo);
        $docentes = Docentes::findFirstBycodigo($personal_id);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


        $periodo_e = explode("-", $Periodo->periodo);
        $mes = (int) $periodo_e[0];

        $mes_text = strtoupper($meses[$mes - 1]);
        $this->view->mes_text = $mes_text;



        $PlanillaDetalle = PlanillaDetalle::findFirst(
            [
                "id_planilla = $planilla_id AND personal = $personal_id ",
            ]
        );



        $regimens = array("1" => "SNP ONP", "2" => "SPP AFP");

        $afp = Afp::findFirstBycodigo($PlanillaDetalle->afp);
        $regimen = $regimens[$afp->regimen];

        $db = $this->db;
        $sql = "SELECT
        public.tbl_per_afp_detalles.aporte,
        public.tbl_per_afp_detalles.prima,
        public.tbl_per_afp_detalles.comision,
        public.tbl_per_afp_detalles.rma
        FROM
        public.tbl_per_planillas
        INNER JOIN public.tbl_per_planillas_detalle ON public.tbl_per_planillas.id_planilla = public.tbl_per_planillas_detalle.id_planilla
        INNER JOIN public.tbl_per_afp_detalles ON public.tbl_per_planillas_detalle.afp = public.tbl_per_afp_detalles.afp AND public.tbl_per_planillas.periodo = public.tbl_per_afp_detalles.periodo
        WHERE
        public.tbl_per_planillas_detalle.id_planilla = $planilla_id AND
        public.tbl_per_planillas_detalle.personal = $personal_id";
        //echo "<pre>";print_r($sql);exit();
        $detalleafp = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->detalleafp = $detalleafp;


        $this->view->planilla = $Planilla;
        $this->view->periodo = $Periodo;
        $this->view->docentes = $docentes;

        $this->view->planilladetalle = $PlanillaDetalle;
        $this->view->tipoplanilla = $tipoplanilla;
        $this->view->regimen = $regimen;
        $this->view->afp = $afp;

        $this->view->planilla_id = $planilla_id;
        $this->view->personal_id = $personal_id;



        $VPlanillaS = VPlanillasDocentes::findFirst(
            [
                "id_planilla = $planilla_id AND id_personal = $personal_id ",
            ]
        );


        $this->view->vplanillas = $VPlanillaS;




        $this->assets->addJs("adminpanel/js/modulos/registroplanillas.detallepago2.js?v=" . uniqid());
    }

    public function saveEscolaridadAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $i_escolar = (string) $this->request->getPost('i_escolar');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->i_escolar = $i_escolar;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveAguinaldoJulio2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $i_aguin_jul = (string) $this->request->getPost('i_aguin_jul');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->i_aguin_jul = $i_aguin_jul;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveAguinaldoDiciembre2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $i_aguin_dic = (string) $this->request->getPost('i_aguin_dic');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->i_aguin_dic = $i_aguin_dic;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDTardanza2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $d_tard = (string) $this->request->getPost('d_tard');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->d_tard = $d_tard;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDInasistencia2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $d_inas = (string) $this->request->getPost('d_inas');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->d_inas = $d_inas;
            $PlanillaDetalle->save();


            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveDJudicial2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $d_judicial = (string) $this->request->getPost('d_judicial');


            //Valida cuando es nuevo
            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            $PlanillaDetalle->d_judicial = $d_judicial;
            $PlanillaDetalle->save();

            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveRenta2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $renta = (string) $this->request->getPost('renta');

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            if ($renta == '1') {
                $PlanillaDetalle->renta = "1";
                $PlanillaDetalle->save();
            } else if ($renta == '0') {
                $PlanillaDetalle->renta = "0";
                $PlanillaDetalle->save();
            }

            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function saveAfpno2Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_planilla_detalle = (int) $this->request->getPost('id_planilla_detalle');
            $afp_no = (string) $this->request->getPost('afp_no');

            // echo "<pre>";
            // print_r($_POST);
            // exit();


            $PlanillaDetalle = PlanillaDetalle::findFirst(" id_planilla_detalle = {$id_planilla_detalle}");
            if ($afp_no == '1') {
                $PlanillaDetalle->afp_no = "1";
                $PlanillaDetalle->save();
            } else if ($afp_no == '0') {
                $PlanillaDetalle->afp_no = "0";
                $PlanillaDetalle->save();
            }


            $VPlanillaS = VPlanillasDocentes::findFirst(
                [
                    "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
                ]
            );


            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes", "obj" => $VPlanillaS));

            $this->response->send();
        } else {
            $this->response->setStatusCode(500);
            $this->response->send();
        }
    }

    public function detallepagoPdf2Action($planilla_id, $personal_id)
    {
        $this->view->disable();


        // print("Reporte de planilla en desarrollo...");
        // exit();

        $Planilla = Planilla::findFirst(
            [
                "id_planilla = $planilla_id",
            ]
        );



        $tipoplanilla = TipoPlanillas::findFirstByid_planilla_tipo($Planilla->id_planilla_tipo);
        $Periodo = Periodos::findFirstBycodigo($Planilla->periodo);
        $docentes = Docentes::findFirstBycodigo($personal_id);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");






        $periodo_e = explode("-", $Periodo->periodo);
        $mes = (int) $periodo_e[0];

        $mes_text = ($meses[$mes - 1]);
        //$this->view->mes_text = $mes_text;

        $Config = TipoPlanillaDetalle::findFirstByplanilla_tipo($Planilla->id_planilla_tipo);

        $PlanillaDetalle = PlanillaDetalle::findFirst(
            [
                "id_planilla = $planilla_id AND personal=$personal_id ",
            ]
        );


        $VPlanillaS = VPlanillasDocentes::findFirst(
            [
                "id_planilla = $PlanillaDetalle->id_planilla AND id_personal = $PlanillaDetalle->personal ",
            ]
        );





        //ARea
        $Area = Areas::findFirstBycodigo($contrato->area);
        //$this->view->area = $Area;

        $regimens = array("1" => "SNP ONP", "2" => "SPP AFP");

        $afp = Afp::findFirstBycodigo($PlanillaDetalle->afp);
        $regimen = $regimens[$afp->regimen];


        $where = "afp = {$PlanillaDetalle->afp} AND periodo = $Planilla->periodo";
        //print $where;exit();
        $detalleAfp = AfpDetalle::findFirst([$where]);
        //$this->view->detalleafp = $detalleAfp;



        $pdf = new PDF();
        $pdf->AddPage('L');
        $pdf->Image('webpage/assets/img/logo-vr.png', 210, 15, 70);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(5);
        $pdf->Cell(270, 155, '  ', 1, 0, 'C');
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->cell(5);
        $pdf->Cell(270, 15, $this->config->global->xNombreIns, 0, 0, 'C');
        $pdf->Ln(1);
        $pdf->cell(5);
        $pdf->Cell(270, 25, '  BOLETA DE PAGO ', 0, 0, 'C');
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->cell(5);
        $pdf->Cell(270, 35, '  RUC: ' . $this->config->global->xRUCIns, 0, 0, 'C');
        $pdf->Ln(30);

        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(10);
        $pdf->Cell(50, 5, "Nombres y Apellidos: {$docentes->apellidop} {$docentes->apellidom} {$docentes->nombres}", 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Mes de Pago:', 0, 0, 'L');
        $pdf->Cell(50, 5, $mes_text, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Cargo: ' . $docentes->cargo, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Fecha de Nacimiento:', 0, 0, 'L');
        $pdf->Cell(50, 5, date("d/m/Y", strtotime($docentes->fecha_nacimiento)), 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Tipo de Servidor: ' . $docentes->cargo, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Número de DNI:', 0, 0, 'L');
        $pdf->Cell(50, 5, $docentes->nro_doc, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Código de ESSALUD: ' . $docentes->seguro_nro, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Fecha de Ingreso:', 0, 0, 'L');
        $pdf->Cell(50, 5, date("d/m/Y", strtotime($docentes->fecha_ingreso)), 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'Régimen Pensionario: ' . $regimen . ' ' . $afp->nombre, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Días Trabajados:', 0, 0, 'L');
        $pdf->Cell(50, 5, $PlanillaDetalle->diastrab, 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(10);
        $pdf->Cell(50, 5, 'CUSPP: ' . $docentes->cuspp, 0, 0, 'L');
        $pdf->Cell(130);
        $pdf->Cell(50, 5, 'Vacaciones del:', 0, 0, 'L');
        $pdf->Cell(50, 5, '', 0, 0, 'L');
        $pdf->Ln();

        $pdf->Cell(5);
        $pdf->Cell(90, 5, 'REMUNERACIONES', 1, 0, 'C');
        $pdf->Cell(90, 5, 'DESCUENTOS', 1, 0, 'C');
        $pdf->Cell(90, 5, 'APORTACIONES DEL EMPLEADOR', 1, 0, 'C');
        $pdf->Ln(5);

        $pdf->Cell(5);
        $pdf->Cell(90, 80, '', 1, 0, 'C');
        $pdf->Cell(90, 80, '', 1, 0, 'C');
        $pdf->Cell(90, 80, '', 1, 0, 'C');
        $pdf->Ln(0);





        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'HONORARIOS CAS', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->rem_basica, 0, 0, 'R');


        $pdf->Cell(60, 5, 'SPP - Aporte AFP', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->afp_aporte, 0, 0, 'R');

        $pdf->Cell(60, 5, 'ESSALUD', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->aessalud, 1, 1, 'R');


        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'AGUINALDO JULIO', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->i_aguin_jul, 1, 0, 'R');


        $pdf->Cell(60, 5, 'SPP - Prima Seguro AFP', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->afp_prima, 1, 1, 'R');


        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'AGUINALDO DICIEMBRE', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->i_aguin_dic, 1, 0, 'R');



        $pdf->Cell(60, 5, 'SPP - Comision AFP', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->afp_comision, 1, 1, 'R');


        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'Escolaridad', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->i_escolar, 1, 0, 'R');

        $pdf->Cell(60, 5, 'Tardanzas', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->d_tard, 1, 1, 'R');
        $pdf->Cell(90);

        $pdf->Cell(5);
        $pdf->Cell(60, 5, 'Inasistencia', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->d_inas, 1, 1, 'R');

        $pdf->Cell(5);
        $pdf->Cell(90);

        $pdf->Cell(60, 5, 'Judicial', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->d_judicial, 1, 1, 'R');
        $pdf->Cell(90);

        $pdf->Cell(5);
        $pdf->Cell(60, 5, '5ta Categoria', 1, 0, 'L');
        $pdf->Cell(30, 5, 'S/. ' . $VPlanillaS->quinta_cat, 1, 0, 'R');




        $pdf->SetXY(10, 158);


        $pdf->Cell(5);
        $pdf->Cell(90, 7, 'S/. ' . number_format($VPlanillaS->rem_bruta, 2, '.', ''), 1, 0, 'R');
        $pdf->Cell(90, 7, 'S/. ' . number_format($VPlanillaS->descuentos, 2, '.', ''), 1, 0, 'R');
        $pdf->Cell(90, 7, 'RESUMEN', 1, 0, 'C');
        $pdf->Ln(7);

        $pdf->Cell(5);
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(60, 7, 'TOTAL REMUNERACIONES', 1, 0, 'L');
        $pdf->Cell(30, 7, 'S/. ' . $VPlanillaS->rem_bruta, 1, 0, 'R');
        $pdf->Ln(7);
        $pdf->Cell(5);
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(60, 7, 'TOTAL DESCUENTOS', 1, 0, 'L');
        $pdf->Cell(30, 7, 'S/. ' . $VPlanillaS->descuentos, 1, 0, 'R');
        $pdf->Ln(7);
        $pdf->Cell(5);
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(90, 7, '', 0, 0, 'R');
        $pdf->Cell(60, 7, 'REMUNERACION NETA', 1, 0, 'L');
        $pdf->Cell(30, 7, 'S/. ' . $VPlanillaS->rem_neta, 1, 0, 'R');
        $pdf->Ln(7);

        $pdf->Output();
    }


    public function copiarplanillaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_planilla_origen = $this->request->getPost("select-id_planilla", "int");
            $id_planilla_destino = $this->request->getPost("datatable-id_planilla", "int");



            $pd = PlanillaDetalle::find("estado = 'A' AND id_planilla = $id_planilla_origen");

            foreach ($pd as $value) {

                // echo "<pre>";
                // print_r($value->id_planilla);

                $verifica = PlanillaDetalle::find("id_planilla = $id_planilla_destino AND personal = $value->personal");
                if (count($verifica) == 0) {
                    $planillaDetalle = new PlanillaDetalle();
                    $planillaDetalle->id_planilla = $id_planilla_destino;
                    $planillaDetalle->personal = $value->personal;
                    $planillaDetalle->meta = $value->meta;
                    $planillaDetalle->banco = $value->banco;
                    $planillaDetalle->nro_cta = $value->nro_cta;
                    $planillaDetalle->afp = $value->afp;
                    $planillaDetalle->afp_no = $value->afp_no;
                    $planillaDetalle->cuspp = $value->cuspp;
                    $planillaDetalle->renta = $value->renta;
                    $planillaDetalle->diastrab = $value->diastrab;
                    $planillaDetalle->i_rem_basica = $value->i_rem_basica;
                    $planillaDetalle->i_escolar = $value->i_escolar;
                    $planillaDetalle->i_aguin_jul = $value->i_aguin_jul;
                    $planillaDetalle->i_aguin_dic = $value->i_aguin_dic;
                    $planillaDetalle->d_tard = $value->d_tard;
                    $planillaDetalle->d_inas = $value->d_inas;
                    $planillaDetalle->d_judicial = $value->d_judicial;
                    $planillaDetalle->estado = $value->estado;
                    $planillaDetalle->save();
                }
            }
            //exit();


            if ($pd) {
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


    public function actualizarDatosPersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $id_planilla = $this->request->getPost("id_planilla", "int");
            $id_planilla_tipo = $this->request->getPost("id_planilla_tipo", "int");


            $planillaDetalle = PlanillaDetalle::find("estado = 'A' AND id_planilla = $id_planilla");

            foreach ($planillaDetalle as $valuePD) {

                if ($id_planilla_tipo == 1) {

                    //personal
                    $personal = Personal::findFirstBycodigo($valuePD->personal);

                    $planillaDetalle = PlanillaDetalle::findFirst(
                        [
                            "id_planilla_detalle = $valuePD->id_planilla_detalle",
                        ]
                    );

                    $planillaDetalle->banco = $personal->banco;
                    $planillaDetalle->nro_cta = $personal->nro_cta;
                    $planillaDetalle->afp = $personal->afp;
                    $planillaDetalle->cuspp = $personal->cuspp;

                    if ($personal->descuento_judicial_m > 0) {
                        $planillaDetalle->d_judicial = $personal->descuento_judicial_m;
                    }

                    if ($personal->descuento_judicial_p > 0) {
                        $planillaDetalle->d_judicial = ($valuePD->i_rem_basica * $personal->descuento_judicial_p) / 100;
                    }
                    $planillaDetalle->save();
                } else if ($id_planilla_tipo == 2) {

                    //docentes
                    $docentes = Docentes::findFirstBycodigo($valuePD->personal);

                    $planillaDetalle = PlanillaDetalle::findFirst(
                        [
                            "id_planilla_detalle = $valuePD->id_planilla_detalle",
                        ]
                    );

                    $planillaDetalle->banco = $docentes->banco;
                    $planillaDetalle->nro_cta = $docentes->nro_cta;
                    $planillaDetalle->afp = $docentes->afp;
                    $planillaDetalle->cuspp = $docentes->cuspp;

                    if ($docentes->descuento_judicial_m > 0) {
                        $planillaDetalle->d_judicial = $docentes->descuento_judicial_m;
                    }

                    if ($docentes->descuento_judicial_p > 0) {
                        $planillaDetalle->d_judicial = ($valuePD->i_rem_basica * $docentes->descuento_judicial_p) / 100;
                    }
                    $planillaDetalle->save();
                }
            }
            //exit();

            if ($planillaDetalle) {
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
