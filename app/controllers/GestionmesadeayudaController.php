<?php

class GestionmesadeayudaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //atenciones
    public function atencionesAction($tipo_atencion = null, $proceso = null, $fecha_inicio = null, $fecha_fin = null)
    {

        $AreasSql = $this->modelsManager->createQuery("SELECT DISTINCT
                        Areas.codigo,
                        Areas.nombres
                        FROM
                        Areas AS Areas
                        INNER JOIN PersonalAreas AS PersonalAreas ON PersonalAreas.area = Areas.codigo
                        WHERE Areas.estado = 'A' AND PersonalAreas.estado = 'A'
                        ORDER BY Areas.nombres");
        $Areas = $AreasSql->execute();
        $this->view->areas = $Areas;

        //tipo de atencion
        $TipoAtencion = TipoAtencion::find("estado = 'A' AND numero = 52");
        $this->view->tipo_atencion = $TipoAtencion;

        //HelpdeskProceso
        $helpdeskProceso = HelpdeskProceso::find("estado = 'A' AND numero = 94");
        $this->view->procesos = $helpdeskProceso;

        //tipo_atencion
        //$this->view->t_a = $tipo_atencion;
        //proceso
        //$this->view->p = $proceso;
        //fecha inicio
        //$this->view->f_i_d = $fecha_inicio;
        //fecha fin
        //$this->view->f_f_d = $fecha_fin;

        $this->assets->addJs("adminpanel/js/modulos/gestionmesadeayuda.atenciones.js?v=" . uniqid());
    }

    //getPersonal
    public function getPersonalAction()
    {

        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $area = $this->request->getPost("area");

            $PersonalSql = $this->modelsManager->createQuery("SELECT
                        Personal.codigo,
                        Personal.apellidop,
                        Personal.apellidom,
                        Personal.nombres,
                        PersonalAreas.area
                        FROM
                        Personal AS Personal
                        INNER JOIN PersonalAreas AS PersonalAreas ON PersonalAreas.personal = Personal.codigo
                        WHERE Personal.estado = 'A' AND Personal.codigo > 0 AND PersonalAreas.estado = 'A' AND PersonalAreas.area = {$area}
                        ORDER BY Personal.apellidop, Personal.apellidom, Personal.nombres");
            $Personal = $PersonalSql->execute();
            $this->response->setJsonContent($Personal->toArray());
            $this->response->send();
        }
    }

    public function datatableAtencionesAction($tipo_atencion = null, $proceso = null, $fecha_inicio = null, $fecha_fin = null)
    {

        // print("tipo_atencion:" . $tipo_atencion . " - proceso:" . $proceso . " - fecha inicio:" . $fecha_inicio . " - fecha fin:" . $fecha_fin);
        // exit();

        if ($tipo_atencion == 0 and $proceso == 0 and $fecha_inicio == 0 and $fecha_fin == 0) {
            $where = "";

        } else if ($tipo_atencion != 0 and $proceso == 0 and $fecha_inicio != 0 and $fecha_fin != 0) {

            $where = "AND tipo_atencion = {$tipo_atencion} AND (CAST (fecha_recepcion AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";

        } else if ($tipo_atencion == 0 and $proceso != 0 and $fecha_inicio != 0 and $fecha_fin != 0) {

            $where = "AND proceso = {$proceso} AND (CAST (fecha_recepcion AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";

        } else if ($tipo_atencion == 0 and $proceso == 0 and $fecha_inicio != 0 and $fecha_fin != 0) {

            $where = "AND (CAST (fecha_recepcion AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";
        } else {

            $where = "AND tipo_atencion = {$tipo_atencion} AND proceso = {$proceso} AND (CAST (fecha_recepcion AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}')";

        }

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, publico, dni, asunto, tipo, prioridad, fecha_recepcion, fecha_inicio, fecha_termino, proceso, estado, tipo_atencion");
            $datatable->setFrom("(SELECT
                                    atenciones.codigo AS codigo,
                                    tipo_atencion.nombres AS tipo,
                                    prioridad.nombres AS prioridad,
                                    atenciones.fecha_recepcion AS fecha_recepcion,
                                    atenciones.fecha_inicio AS fecha_inicio,
                                    atenciones.fecha_termino AS fecha_termino,
                                    atenciones.proceso AS proceso,
                                    atenciones.estado AS estado,
                                    CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS publico,
                                    publico.nro_doc AS dni,
                                    atenciones.asunto,
                                    atenciones.tipo AS tipo_atencion
                                    FROM
                                    tbl_hdk_atenciones AS atenciones
                                    INNER JOIN a_codigos AS tipo_atencion ON tipo_atencion.codigo = atenciones.tipo
                                    INNER JOIN a_codigos AS prioridad ON prioridad.codigo = atenciones.prioridad
                                    INNER JOIN publico AS publico ON publico.codigo = atenciones.publico
                                    WHERE tipo_atencion.numero = 52 AND prioridad.numero = 53) AS temporal_table");
            //$datatable->setWhere("estado ='A' $where tipo_atencion = {$tipo_atencion} AND proceso = {$proceso} AND ((CAST (fecha_inicio AS DATE) BETWEEN '{$fecha_inicio}' AND '{$fecha_fin}') AND (CAST (fecha_termino AS DATE) BETWEEN '{$fecha_inicio}' AND '$fecha_fin'))");
            $datatable->setWhere("estado ='A' $where");
            $datatable->setOrderby("codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAtencionesAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $HdkAtenciones = HdkAtenciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));

            if ($HdkAtenciones->proceso == 1 || $HdkAtenciones->proceso == 4) {
                //print("El Estado:" . $HdkAtenciones->proceso);
                //exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                //$this->response->setContent('No existe registro');
                $proceso_estado = $HdkAtenciones->proceso;
                if ($proceso_estado == 2) {
                    $proceso = 2;
                } elseif ($proceso_estado == 3) {
                    $proceso = 3;
                }

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no", "proceso" => $proceso));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function getAtencionesPersonalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $HdkAtenciones = HdkAtenciones::findFirstBycodigo((int) $this->request->getPost("id", "int"));

            if ($HdkAtenciones->proceso == 2) {
                //print("El Estado:" . $HdkAtenciones->proceso);
                //exit();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                //$this->response->setContent('No existe registro');
                $proceso_estado = $HdkAtenciones->proceso;
                if ($proceso_estado == 3) {
                    $proceso = 3;
                } elseif ($proceso_estado == 4) {
                    $proceso = 4;
                }

                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no", "proceso" => $proceso));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function saveAtencionesDetalleAction()
    {

//        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $atencion = (int) $this->request->getPost("atencion", "int");

                //HdkAtenciones
                $HdkAtenciones = HdkAtenciones::findFirstBycodigo($atencion);
                $HdkAtenciones->proceso = 2;
                $HdkAtenciones->fecha_inicio = date("Y-m-d H:i:s");
                $HdkAtenciones->save();

                $area = (int) $this->request->getPost("area", "int");
                $personal = (int) $this->request->getPost("personal", "int");

                $HdkAtencionesDetalle = HdkAtencionesDetalle::findFirst(
                    [
                        "atencion = {$HdkAtenciones->codigo} AND area = {$area} AND personal = {$personal}",
                    ]
                );

                //Valida cuando es nuevo
                $HdkAtencionesDetalle = (!$HdkAtencionesDetalle) ? new HdkAtencionesDetalle() : $HdkAtencionesDetalle;
                $HdkAtencionesDetalle->personal = (int) $this->request->getPost("personal", "int");
                $HdkAtencionesDetalle->area = (int) $this->request->getPost("area", "int");
                $HdkAtencionesDetalle->atencion = (int) $this->request->getPost("atencion", "int");
                $HdkAtencionesDetalle->fecha_asignacion = $HdkAtenciones->fecha_inicio;
                $HdkAtencionesDetalle->estado = "A";

                if ($HdkAtencionesDetalle->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($HdkAtencionesDetalle->getMessages());
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

    public function getAtencionesDetalleAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $atencion = (int) $this->request->getPost("atencion", "int");

            $HdkAtencionesDetalleSql = $this->modelsManager->createQuery("SELECT
                        HdkAtencionesDetalle.fecha_asignacion,
                        HdkAtencionesDetalle.fecha_respuesta,
                        Personal.apellidop,
                        Personal.apellidom,
                        Personal.nombres,
                        Areas.nombres AS area
                        FROM
                        HdkAtencionesDetalle AS HdkAtencionesDetalle
                        INNER JOIN Personal AS Personal ON Personal.codigo = HdkAtencionesDetalle.personal
                        INNER JOIN Areas AS Areas ON Areas.codigo = HdkAtencionesDetalle.area
                        WHERE HdkAtencionesDetalle.atencion = {$atencion}");
            $HdkAtencionesDetalle = $HdkAtencionesDetalleSql->execute();

            //foreach ($HdkAtencionesDetalle as $test) {
            //                echo '<pre>';
            //                print_r("Areas:".$test->area);
            //            }
            //            exit();

            $this->response->setJsonContent($HdkAtencionesDetalle->toArray());
            $this->response->send();
        }
    }

    public function datatableAtencionesPublicoAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, publico, tipo, prioridad, fecha_recepcion, fecha_inicio, fecha_termino, proceso, estado,solucion");
            $datatable->setFrom("(SELECT
                                    atenciones.publico AS publico,
                                    atenciones.codigo AS codigo,
                                    tipo_atencion.nombres AS tipo,
                                    prioridad.nombres AS prioridad,
                                    atenciones.fecha_recepcion AS fecha_recepcion,
                                    atenciones.fecha_inicio AS fecha_inicio,
                                    atenciones.fecha_termino AS fecha_termino,
                                    atenciones.proceso AS proceso,
                                    atenciones.estado AS estado,
                                    atenciones.solucion
                                    FROM
                                    tbl_hdk_atenciones AS atenciones
                                    INNER JOIN a_codigos AS tipo_atencion ON tipo_atencion.codigo = atenciones.tipo
                                    INNER JOIN a_codigos AS prioridad ON prioridad.codigo = atenciones.prioridad
                                    WHERE tipo_atencion.numero = 52 AND prioridad.numero = 53) AS temporal_table");
            $datatable->setWhere("publico = {$this->session->get("auth")["codigo"]}");
            $datatable->setOrderby("codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //atencionespublico
    public function atencionespublicoAction()
    {

        //tipo de atencion
        $TipoAtencion = TipoAtencion::find("estado = 'A' AND numero = 52");
        $this->view->tipo_atencion = $TipoAtencion;

        //prioridad
        $Prioridad = Prioridad::find("estado = 'A' AND numero = 53");
        $this->view->prioridad = $Prioridad;

        $this->assets->addJs("adminpanel/js/modulos/gestionmesadeayuda.atencionespublico.js?v=" . uniqid());
    }

    //saveAtenciones
    public function saveAtencionesAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $HdkAtenciones = new HdkAtenciones();
                $HdkAtenciones->tipo = $this->request->getPost("tipo", "int");
                $HdkAtenciones->prioridad = $this->request->getPost("prioridad", "int");
                $HdkAtenciones->fecha_recepcion = date("Y-m-d H:i:s");
                $HdkAtenciones->asunto = $this->request->getPost("asunto", "string");
                $HdkAtenciones->descripcion = $this->request->getPost("descripcion", "string");
                $HdkAtenciones->pedido = $this->request->getPost("pedido", "string");
                $HdkAtenciones->proceso = 1;
                $HdkAtenciones->publico = $this->request->getPost("publico", "int");

                // if(empty($this->request->getPost("publico", "int"))) {
                //     //print("@KenMack");
                //     //exit();
                //     $HdkAtenciones->publico = $this->request->getPost("publico", "int");
                // } else {
                //     //$HdkAtenciones->publico = $this->session->get("auth")["codigo"];
                // }

                $HdkAtenciones->estado = "A";

                if ($HdkAtenciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($HdkAtenciones->getMessages());
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

    //saveAtencionesPublico
    public function saveAtencionesPublicoAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $HdkAtenciones = new HdkAtenciones();
                $HdkAtenciones->tipo = $this->request->getPost("tipo", "int");
                $HdkAtenciones->prioridad = $this->request->getPost("prioridad", "int");
                $HdkAtenciones->fecha_recepcion = date("Y-m-d H:i:s");
                $HdkAtenciones->asunto = $this->request->getPost("asunto", "string");
                $HdkAtenciones->descripcion = $this->request->getPost("descripcion", "string");
                $HdkAtenciones->pedido = $this->request->getPost("pedido", "string");
                $HdkAtenciones->proceso = 1;
                $HdkAtenciones->publico = $this->request->getPost("publico", "int");

                $HdkAtenciones->publico = $this->session->get("auth")["codigo"];
     

                $HdkAtenciones->estado = "A";

                if ($HdkAtenciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($HdkAtenciones->getMessages());
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

//atencionespersonal
    public function atencionespersonalAction()
    {

        //$fecha_server = date("Y-m-d H:i:s");
        //print_r($fecha_server);
        //exit();
        //tipo de atencion
        $TipoAtencion = TipoAtencion::find("estado = 'A' AND numero = 52");
        $this->view->tipo_atencion = $TipoAtencion;

        //prioridad
        $Prioridad = Prioridad::find("estado = 'A' AND numero = 53");
        $this->view->prioridad = $Prioridad;

                //HelpdeskProceso
                $helpdeskProceso = HelpdeskProceso::find("estado = 'A' AND numero = 94 AND codigo > 2");
                $this->view->procesos = $helpdeskProceso;



        $this->assets->addJs("adminpanel/js/modulos/gestionmesadeayuda.atencionespersonal.js?v=" . uniqid());
    }

    public function datatableAtencionesPersonalAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, publico, dni, asunto, tipo, prioridad, fecha_recepcion, fecha_inicio, fecha_termino, proceso, area, estado, personal");
            $datatable->setFrom("(SELECT
                                    atenciones.codigo AS codigo,
                                    tipo_atencion.nombres AS tipo,
                                    prioridad.nombres AS prioridad,
                                    atenciones.fecha_recepcion AS fecha_recepcion,
                                    atenciones.fecha_inicio AS fecha_inicio,
                                    atenciones.fecha_termino AS fecha_termino,
                                    atenciones.proceso AS proceso,
                                    atenciones.estado AS estado,
                                    CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS publico,
                                    publico.nro_doc AS dni,
                                    atenciones.asunto AS asunto,
                                    areas.nombres AS area,
                                    atenciones_detalle.personal AS personal
                                    FROM
                                    tbl_hdk_atenciones AS atenciones 
                                    INNER JOIN a_codigos AS tipo_atencion ON tipo_atencion.codigo = atenciones.tipo
                                    INNER JOIN a_codigos AS prioridad ON prioridad.codigo = atenciones.prioridad
                                    INNER JOIN publico AS publico ON publico.codigo = atenciones.publico
                                    INNER JOIN tbl_hdk_atenciones_detalle AS atenciones_detalle ON atenciones_detalle.atencion = atenciones.codigo
                                    INNER JOIN tbl_web_areas AS areas ON atenciones_detalle.area = areas.codigo
                                    WHERE tipo_atencion.numero = 52 AND prioridad.numero = 53) AS temporal_table");
            $datatable->setWhere("personal = {$this->session->get("auth")["codigo"]}");
            $datatable->setOrderby("codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
    //saveAtencionesPersonal
    public function saveAtencionesPersonalAction()
    {

        // echo '<pre>';
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $atencion = (int) $this->request->getPost("atencion", "int");
                $proceso = (int) $this->request->getPost("proceso", "int");

                if ($proceso == 3) {

                    $HdkAtenciones = HdkAtenciones::findFirstBycodigo($atencion);
                    $HdkAtenciones->proceso = $proceso;
                    if ($this->request->getPost("fecha_respuesta", "string") != "") {
                        $fecha_ex = explode("/", $this->request->getPost("fecha_respuesta", "string"));
                        $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                        $hora = $hora = date("H:i:s");

                        //print("Fecha Termino:" . $fecha_new . $hora);
                        //exit();

                        $HdkAtenciones->fecha_termino = date("Y-m-d H:i:s", strtotime($fecha_new . " " . $hora));
                    }

                    //$HdkAtenciones->solucion = $this->request->getPost("solucion", "string");
                    //validacion solucion
                    if (strlen($this->request->getPost("solucion", "string")) > 20) {
                        //print("@KenMack");
                        //exit();
                        $HdkAtenciones->solucion = $this->request->getPost("solucion", "string");
                    } else {
                        //$HdkAtenciones->solucion = "";
                        $this->response->setJsonContent(array("say" => "no_solucion"));
                        $this->response->send();
                        exit();
                    }
                    //fin

                    $HdkAtenciones->save();

                    $HdkAtencionesDetalle = HdkAtencionesDetalle::findFirstByatencion($HdkAtenciones->codigo);
                    $HdkAtencionesDetalle->fecha_respuesta = $HdkAtenciones->fecha_termino;
                } elseif ($proceso == 4) {

                    $HdkAtenciones = HdkAtenciones::findFirstBycodigo($atencion);
                    $HdkAtenciones->proceso = $proceso;

                    $HdkAtencionesDetalle = HdkAtencionesDetalle::findFirstByatencion($HdkAtenciones->codigo);
                    $HdkAtencionesDetalle->fecha_respuesta = $HdkAtenciones->fecha_termino;
                    //$HdkAtencionesDetalle->motivo = $this->request->getPost("motivo", "string");
                    //validacion motivo
                    if (strlen($this->request->getPost("motivo", "string")) > 20) {
                        //print("@KenMack");
                        //exit();
                        $HdkAtenciones->solucion = $this->request->getPost("motivo", "string");
                    } else {
                        //$HdkAtenciones->solucion = "";
                        $this->response->setJsonContent(array("say" => "no_motivo"));
                        $this->response->send();
                        exit();
                    }
                    $HdkAtenciones->save();
                    //fin
                    $HdkAtencionesDetalle->estado = 'X';
                }

                if ($HdkAtencionesDetalle->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($HdkAtencionesDetalle->getMessages());
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

    //atenciones admin registro
    public function registroAction()
    {

        //tipo de atencion
        $TipoAtencion = TipoAtencion::find("estado = 'A' AND numero = 52");
        $this->view->tipo_atencion = $TipoAtencion;

        //prioridad
        $Prioridad = Prioridad::find("estado = 'A' AND numero = 53");
        $this->view->prioridad = $Prioridad;

        //$this->assets->addJs("adminpanel/js/modulos/gestionmesadeayuda.atenciones.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/js/modulos/gestionmesadeayuda.registro.js?v=" . uniqid());
    }

    //databables publico
    public function datatablePublicoAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo, nro_doc, publico, estado");
            $datatable->setFrom("(SELECT
                                    publico.codigo AS codigo,
                                    publico.nro_doc AS nro_doc,
                                    CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS publico,
                                    publico.estado AS estado
                                    FROM publico AS publico) AS temporal_table");
            //$datatable->setWhere("publico = {$this->session->get("auth")["codigo"]}");
            $datatable->setOrderby("codigo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxPublicoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //llega la captura del ajax mediante el parametro getPost

            $codigo = (int) $this->request->getPost("codigo", "int");

            $Publico = Publico::findFirstBycodigo($codigo);

            //echo '<pre>';
            //print_r($Publico->nombres);
            //exit();

            if ($Publico) {
                $this->response->setJsonContent($Publico->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

}
