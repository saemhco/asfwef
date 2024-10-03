<?php

class ActividadesaeiController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/actividadesaei.js?v=" . uniqid());
    }

    //index
    public function indexAction() {
        
    }

    //funcion agregar y editar
    public function registroAction($id = null, $id2 = null) {
        $this->view->id = $id;
        $this->view->id2 = $id2;

        if ($id != null && $id2 != null) {
            //$actividadesaei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $actividadesaei = Actividadesaei::findFirst(
                            [
                                "id_actividad_aei = '$id' AND ano_eje = $id2"
                            ]
            );
        } else {
            
        }

        //echo '<pre>';
        //print_r($actividadesaei);
        //exit();

        $this->view->actividadesaei = $actividadesaei;

        //años
        $anios = Anios::find(
                        [
                            "estado = 'A' AND numero = 40",
                            'order' => 'descripcion DESC',
                        ]
        );
        $this->view->anios = $anios;


        $anio_actual = date('Y-m-d');
        $anio_actual_result = explode('-', $anio_actual);
        $this->view->anio_actual = $anio_actual_result[0];

        //objetivosei
        $objetivosei = Objetivosei::find("estado = 'A'");
        $this->view->objetivosei = $objetivosei;
    }

    public function saveAction() {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("id_actividad_aei", "string");
                $id2 = (int) $this->request->getPost("ano_eje", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();
                //$actividadesaei = Objetivosei::findFirstByid_objetivo_ei($id);

                $actividadesaei = Actividadesaei::findFirst(
                                [
                                    "id_actividad_aei = '$id' AND ano_eje = $id2"
                                ]
                );

                //Valida cuando es nuevo
                $actividadesaei = (!$actividadesaei) ? new Actividadesaei() : $actividadesaei;

                //id_objetivo_ei        
                $actividadesaei->id_actividad_aei = $this->request->getPost("codigo", "string");

                //id_objetivo_ei
                if ($this->request->getPost("id_indicador_aei", "string") == "") {
                    $actividadesaei->id_indicador_aei = null;
                } else {
                    $actividadesaei->id_indicador_aei = $this->request->getPost("id_indicador_aei", "string");
                }

                //ano_eje
                $actividadesaei->ano_eje = $this->request->getPost("ano_eje", "int");

                //nombre
                $actividadesaei->nombre = $this->request->getPost("nombre", "string");

                //descripcion
                $actividadesaei->descripcion = $this->request->getPost("descripcion", "string");



                //orden
                $actividadesaei->orden = $this->request->getPost("orden", "string");

                //avance
                if ($this->request->getPost("avance", "int") == "") {
                    $actividadesaei->avance = null;
                } else {
                    $actividadesaei->avance = $this->request->getPost("avance", "int");
                }

                //-----
                //unidad_medida
                $actividadesaei->unidad_medida = $this->request->getPost("unidad_medida", "string");

                //meta
                $actividadesaei->meta = $this->request->getPost("meta", "string");

                //datos
                $actividadesaei->datos = $this->request->getPost("datos", "string");


                //gf_porcentaje
                $actividadesaei->gfp_monto_programado = $this->request->getPost("gfp_monto_programado", "string");

                //gfp_01 
                $actividadesaei->gfp_01 = $this->request->getPost("gfp_01", "string");

                //gfp_02 
                $actividadesaei->gfp_02 = $this->request->getPost("gfp_02", "string");

                //gfp_03 
                $actividadesaei->gfp_03 = $this->request->getPost("gfp_03", "string");

                //gfp_04 
                $actividadesaei->gfp_04 = $this->request->getPost("gfp_04", "string");

                //gfp_05 
                $actividadesaei->gfp_05 = $this->request->getPost("gfp_05", "string");

                //gfp_06
                $actividadesaei->gfp_06 = $this->request->getPost("gfp_06", "string");

                //gfp_07 
                $actividadesaei->gfp_07 = $this->request->getPost("gfp_07", "string");

                //gfp_08 
                $actividadesaei->gfp_08 = $this->request->getPost("gfp_08", "string");

                //gfp_09 
                $actividadesaei->gfp_09 = $this->request->getPost("gfp_09", "string");

                //gfp_10 
                $actividadesaei->gfp_10 = $this->request->getPost("gfp_10", "string");

                //gfp_11 
                $actividadesaei->gfp_11 = $this->request->getPost("gfp_11", "string");

                //gfp_12 
                $actividadesaei->gfp_12 = $this->request->getPost("gfp_12", "string");

                //gfp_total
                $actividadesaei->gfp_total = $this->request->getPost("gfp_total", "string");

                //gfp_porcentaje
                $actividadesaei->gfp_porcentaje = $this->request->getPost("gfp_porcentaje", "string");


                //gop_01
                $actividadesaei->gop_01 = $this->request->getPost("gop_01", "string");

                //gop_02
                $actividadesaei->gop_02 = $this->request->getPost("gop_02", "string");

                //gop_03
                $actividadesaei->gop_03 = $this->request->getPost("gop_03", "string");

                //gop_04
                $actividadesaei->gop_04 = $this->request->getPost("gop_04", "string");

                //gop_05
                $actividadesaei->gop_05 = $this->request->getPost("gop_05", "string");

                //gop_06
                $actividadesaei->gop_06 = $this->request->getPost("gop_06", "string");

                //gop_07
                $actividadesaei->gop_07 = $this->request->getPost("gop_07", "string");

                //gop_08
                $actividadesaei->gop_08 = $this->request->getPost("gop_08", "string");

                //gop_09
                $actividadesaei->gop_09 = $this->request->getPost("gop_09", "string");

                //gop_10
                $actividadesaei->gop_10 = $this->request->getPost("gop_10", "string");

                //gop_11
                $actividadesaei->gop_11 = $this->request->getPost("gop_11", "string");

                //gop_12
                $actividadesaei->gop_12 = $this->request->getPost("gop_12", "string");



                //gop_porcentaje
                $actividadesaei->gop_porcentaje = $this->request->getPost("gop_porcentaje", "string");
                //---
                //enlace
                $actividadesaei->enlace = $this->request->getPost("enlace", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $actividadesaei->estado = "A";
                } else {
                    $actividadesaei->estado = "X";
                }


                if ($actividadesaei->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($actividadesaei->getMessages());
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

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_actividad_aei");
            $datatable->setSelect("id_actividad_aei, id_indicador_aei,ano_eje,"
                    . "nombre, descripcion, "
                    . "orden, avance, "
                    . "unidad_medida, meta, datos, gf_monto_programado,"
                    . "gf_01, gf_02, gf_03, gf_04, gf_05, gf_06,"
                    . "gf_07, gf_08, gf_09, gf_10, gf_11, gf_12,"
                    . "gf_total, gf_porcentaje, gfp_monto_programado,"
                    . "gfp_01, gfp_02, gfp_03, gfp_04, gfp_05, gfp_06,"
                    . "gfp_07, gfp_08, gfp_09, gfp_10, gfp_11, gfp_12,"
                    . "gfp_total, gfp_porcentaje, "
                    . "go_01, go_02, go_03, go_04, go_05, go_06,"
                    . "go_07, go_08, go_09, go_10, go_11, go_12,"
                    . "go_total, go_porcentaje,"
                    . "gop_01, gop_02, gop_03, gop_04, gop_05, gop_06,"
                    . "gop_07, gop_08, gop_09, gop_10, gop_11, gop_12,"
                    . "gop_total, gop_porcentaje,"
                    . "enlace, estado ");
            $datatable->setFrom("tbl_gxi_actividades_aei");
            //$datatable->setWhere("estado = 'A'");
            //$datatable->setWhere("ano_eje.numero = 40");
            $datatable->setOrderby("ano_eje,id_actividad_aei ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$actividadesaei = Objetivosei::findFirstByid_objetivo_ei((string) $this->request->getPost("id", "string"));

            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $actividadesaei = Actividadesaei::findFirst(
                            [
                                "id_actividad_aei = '$id' AND ano_eje = $id2"
                            ]
            );



            if ($actividadesaei && $actividadesaei->estado = 'A') {
                $actividadesaei->estado = 'X';
                $actividadesaei->save();
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

    //valida pk indicadoresaei
    public function getActividadesaeiAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_indicador_aei = (string) $this->request->getPost("id_indicador_aei", "string");

            $ano_eje = (int) $this->request->getPost("ano_eje", "int");

            //echo '<pre>';
            //print_r("Llega:" . $id_indicador_aei ."-". $ano_eje);
            //exit();


            $actividadesaei = Actividadesaei::count(
                            [
                                "id_indicador_aei = '$id_indicador_aei' AND ano_eje = $ano_eje "
                            ]
            );

            //echo '<pre>';
            //print_r($actividadesaei);
            //exit();

            if ($actividadesaei) {

                $id_pk = $actividadesaei + 1;


                $this->response->setJsonContent(array("say" => "si", "pk_aumenta" => $id_pk));
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

    //fin
    //getIndicadoresaei
    public function getIndicadoresaeiAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_accion_ei = $this->request->getPost("id_accion_ei");
            $ano_eje = $this->request->getPost("ano_eje");

            //echo '<pre>';
            //print_r("Llega: " . $id_accion_ei ."-". $ano_eje);
            //exit();

            $indicadoresaei = Indicadoresaei::find('id_accion_ei = "' . $id_accion_ei . '" AND ano_eje = "' . $ano_eje . '"');
            $this->response->setJsonContent($indicadoresaei->toArray());
            $this->response->send();
        }
    }

    //getObjetivos
    public function getObjetivosAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $ano_eje = $this->request->getPost("ano_eje");
            $objetivosei = Objetivosei::find('ano_eje = "' . $ano_eje . '"');
            $this->response->setJsonContent($objetivosei->toArray());
            $this->response->send();
        }
    }

    //fin
    //getAccionesei
    public function getAccioneseiAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_objetivo_ei = $this->request->getPost("id_objetivo_ei");
            $ano_eje = $this->request->getPost("ano_eje");

            //echo '<pre>';
            //print_r("Llega:" . $id_objetivo_ei ."-". $ano_eje);
            //exit();

            $accionesei = Accionesei::find('id_objetivo_ei = "' . $id_objetivo_ei . '" AND ano_eje = "' . $ano_eje . '"');
            $this->response->setJsonContent($accionesei->toArray());
            $this->response->send();
        }
    }

}
