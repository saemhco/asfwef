<?php

class RegistroaeiiController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroaeii.js?v=" . uniqid());
    }

    //index
    public function indexAction() {
        
    }

    //funcion agregar y editar
    public function registroAction($id = null, $id2 = null) {
        $this->view->id = $id;
        $this->view->id2 = $id2;

        if ($id != null && $id2 != null) {
            //$indicadoresaei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $indicadoresaei = Indicadoresaei::findFirst(
                            [
                                "id_indicador_aei = '$id' AND ano_eje = $id2"
                            ]
            );
        } else {
            
        }

        //echo '<pre>';
        //print_r($indicadoresaei);
        //exit();

        $this->view->indicadoresaei = $indicadoresaei;

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
                $id = (string) $this->request->getPost("id_indicador_aei", "string");
                $id2 = (int) $this->request->getPost("ano_eje", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();
                //$indicadoresaei = Objetivosei::findFirstByid_objetivo_ei($id);

                $indicadoresaei = Indicadoresaei::findFirst(
                                [
                                    "id_indicador_aei = '$id' AND ano_eje = $id2"
                                ]
                );

                //Valida cuando es nuevo
                $indicadoresaei = (!$indicadoresaei) ? new Indicadoresaei() : $indicadoresaei;

                //id_objetivo_ei        
                $indicadoresaei->id_indicador_aei = $this->request->getPost("codigo", "string");

                //id_objetivo_ei
                if ($this->request->getPost("id_accion_ei", "string") == "") {
                    $indicadoresaei->id_accion_ei = null;
                } else {
                    $indicadoresaei->id_accion_ei = $this->request->getPost("id_accion_ei", "string");
                }

                //ano_eje
                $indicadoresaei->ano_eje = $this->request->getPost("ano_eje", "int");

                //nombre
                $indicadoresaei->nombre = $this->request->getPost("nombre", "string");

                //descripcion
                $indicadoresaei->descripcion = $this->request->getPost("descripcion", "string");



                //orden
                $indicadoresaei->orden = $this->request->getPost("orden", "string");

                //avance
                if ($this->request->getPost("avance", "int") == "") {
                    $indicadoresaei->avance = null;
                } else {
                    $indicadoresaei->avance = $this->request->getPost("avance", "int");
                }

                //resultado
                $indicadoresaei->resultado = $this->request->getPost("resultado", "string");

                //meta_programada
                $indicadoresaei->meta_programada = $this->request->getPost("meta_programada", "string");

                //porcentaje_obtenido
                $indicadoresaei->porcentaje_obtenido = $this->request->getPost("porcentaje_obtenido", "string");

                //porcentaje_resultado
                $indicadoresaei->porcentaje_resultado = $this->request->getPost("porcentaje_resultado", "string");

                //enlace
                $indicadoresaei->enlace = $this->request->getPost("enlace", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $indicadoresaei->estado = "A";
                } else {
                    $indicadoresaei->estado = "X";
                }


                if ($indicadoresaei->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($indicadoresaei->getMessages());
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
            $datatable->setColumnaId("id_indicador_aei");
            $datatable->setSelect("id_indicador_aei, id_accion_ei,ano_eje,"
                    . "nombre, descripcion, "
                    . "orden, avance, resultado, "
                    . "meta_programada, porcentaje_obtenido, porcentaje_resultado, "
                    . "enlace, estado ");
            $datatable->setFrom("tbl_gxi_indicadores_aei");
            //$datatable->setWhere("estado = 'A'");
            //$datatable->setWhere("ano_eje.numero = 40");
            $datatable->setOrderby("ano_eje,id_indicador_aei ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$indicadoresaei = Objetivosei::findFirstByid_objetivo_ei((string) $this->request->getPost("id", "string"));

            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $indicadoresaei = Indicadoresei::findFirst(
                            [
                                "id_indicador_aei = '$id' AND ano_eje = $id2"
                            ]
            );



            if ($indicadoresaei && $indicadoresaei->estado = 'A') {
                $indicadoresaei->estado = 'X';
                $indicadoresaei->save();
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
        public function getIndicadoresaeiAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_accion_ei = (string) $this->request->getPost("id_accion_ei", "string");

            $ano_eje = (int) $this->request->getPost("ano_eje", "int");


            $indicadoresoei = Indicadoresaei::count(
                            [
                                "id_accion_ei = '$id_accion_ei' AND ano_eje = $ano_eje "
                            ]
            );

            //echo '<pre>';
            //print_r($indicadoresoei);
            //exit();

            if ($indicadoresoei) {

                $id_pk = $indicadoresoei + 1;


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
}
