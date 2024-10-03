<?php

class ActividadesaeieController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/actividadesaeie.js?v=" . uniqid());
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



                //numero
                $actividadesaei->numero = $this->request->getPost("numero", "string");

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

                //gf_monto_programado
                $actividadesaei->gf_monto_programado = $this->request->getPost("gf_monto_programado", "string");

                //gf_01
                $actividadesaei->gf_01 = $this->request->getPost("gf_01", "string");

                //gf_02
                $actividadesaei->gf_02 = $this->request->getPost("gf_02", "string");

                //gf_03
                $actividadesaei->gf_03 = $this->request->getPost("gf_03", "string");

                //gf_04
                $actividadesaei->gf_04 = $this->request->getPost("gf_04", "string");

                //gf_05
                $actividadesaei->gf_05 = $this->request->getPost("gf_05", "string");

                //gf_06
                $actividadesaei->gf_06 = $this->request->getPost("gf_06", "string");

                //gf_07
                $actividadesaei->gf_07 = $this->request->getPost("gf_07", "string");

                //gf_08
                $actividadesaei->gf_08 = $this->request->getPost("gf_08", "string");

                //gf_09
                $actividadesaei->gf_09 = $this->request->getPost("gf_09", "string");

                //gf_10
                $actividadesaei->gf_10 = $this->request->getPost("gf_10", "string");

                //gf_11
                $actividadesaei->gf_11 = $this->request->getPost("gf_11", "string");

                //gf_12
                $actividadesaei->gf_12 = $this->request->getPost("gf_12", "string");

                //gf_total
                $actividadesaei->gf_total = $this->request->getPost("gf_total", "string");

                //gf_porcentaje
                $actividadesaei->gf_porcentaje = $this->request->getPost("gf_porcentaje", "string");



                //go_01 
                $actividadesaei->go_01 = $this->request->getPost("go_01", "string");

                //go_02
                $actividadesaei->go_02 = $this->request->getPost("go_02", "string");

                //go_03
                $actividadesaei->go_03 = $this->request->getPost("go_03", "string");

                //go_04
                $actividadesaei->go_04 = $this->request->getPost("go_04", "string");

                //go_05
                $actividadesaei->go_05 = $this->request->getPost("go_05", "string");

                //go_06
                $actividadesaei->go_06 = $this->request->getPost("go_06", "string");

                //go_07
                $actividadesaei->go_07 = $this->request->getPost("go_07", "string");

                //go_08
                $actividadesaei->go_08 = $this->request->getPost("go_08", "string");

                //go_09
                $actividadesaei->go_09 = $this->request->getPost("go_09", "string");

                //go_10
                $actividadesaei->go_10 = $this->request->getPost("go_10", "string");

                //go_11
                $actividadesaei->go_11 = $this->request->getPost("go_11", "string");

                //go_12
                $actividadesaei->go_12 = $this->request->getPost("go_12", "string");

                //go_total
                $actividadesaei->go_total = $this->request->getPost("go_total", "string");

                //go_porcentaje
                $actividadesaei->go_porcentaje = $this->request->getPost("go_porcentaje", "string");

                
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
            $datatable->setSelect("id_actividad_aei, id_actividad_aei,ano_eje,"
                    . "nombre, descripcion, "
                    . "avance, "
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

    //validar id_actividad_aei
    public function getActividadesaeiAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id = (string) $this->request->getPost("id", "string");

            $ano_eje = (int) $this->request->getPost("ano_eje", "int");

            //echo '<pre>';
            //print_r($id);
            //exit();

            $id_nuevo = str_replace("IAEI", "AEIAP", $id);

            //echo '<pre>';
            //print_r($id_nuevo);
            //exit();
            //$id_actividad_aei = 'IOEI.01.01';
            $id_actividad_aei = $id_nuevo . '.01';

            //echo '<pre>';
            //print_r("Nuevo id_actividad_aei: " . $id_actividad_aei);
            //exit();
            //$id_accion_ei = str_replace("IO", "A", $nuevo_id);
            //echo '<pre>';
            //print_r("Nuevo id_actividad_aei: " . $id_accion_ei);
            //exit();
            //$actividadesaei = Indicadoresei::findFirstByid_actividad_aei((string) $id_actividad_aei);

            $actividadesaei = Actividadesaei::findFirst(
                            [
                                "id_actividad_aei = '$id_actividad_aei' AND ano_eje = $ano_eje "
                            ]
            );



            //echo '<pre>';
            //print_r($actividadesaei->id_actividad_aei . '-' . $actividadesaei->ano_eje);
            //exit();
            //$Asistencias = Asistencias::findFirstBycodigo((string) $this->request->getPost("id", "string"));
            if ($actividadesaei) {

                //echo '<pre>';
                //print_r($actividadesaei->ano_eje);
                //exit();

                $actividadesaei_nuevo = Actividadesaei::findFirst([
                            "id_actividad_aei = '$actividadesaei->id_actividad_aei' AND ano_eje = $actividadesaei->ano_eje ",
                            "order" => "id_actividad_aei DESC",
                            "limit" => 1
                ]);


                //echo '<pre>';
                //print_r("pk:".$actividadesaei_nuevo->id_actividad_aei);
                //exit();

                $id_pk = explode(".", $actividadesaei_nuevo->id_actividad_aei);

                //echo '<pre>';
                //print_r($id_pk[5]);
                //exit();
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si", "pk_aumenta" => $id_pk[5] + 1));
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

    //getIndicadoresei
    public function getIndicadoreseiAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_objetivo_ei = $this->request->getPost("id_objetivo_ei");
            $ano_eje = $this->request->getPost("ano_eje");
            $indicadoresei = Indicadoresei::find('id_objetivo_ei = "' . $id_objetivo_ei . '" AND ano_eje = "' . $ano_eje . '"');
            $this->response->setJsonContent($indicadoresei->toArray());
            $this->response->send();
        }
    }

    //getAccionesei
    public function getAccioneseiAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $id_indicador_ei = $this->request->getPost("id_indicador_ei");
            $ano_eje = $this->request->getPost("ano_eje");

            //echo '<pre>';
            //print_r("Llega:" . $id_indicador_ei ."-". $ano_eje);
            //exit();

            $accionesei = Accionesei::find('id_indicador_ei = "' . $id_indicador_ei . '" AND ano_eje = "' . $ano_eje . '"');
            $this->response->setJsonContent($accionesei->toArray());
            $this->response->send();
        }
    }

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

}
