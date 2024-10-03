<?php

class RegistrooeiiController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registrooeii.js?v=" . uniqid());
    }

    //index
    public function indexAction() {
        
    }

    //funcion agregar y editar
    public function registroAction($id = null, $id2 = null) {
        $this->view->id = $id;
        $this->view->id2 = $id2;

        if ($id != null && $id2 != null) {
            //$indicadoresoei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $indicadoresoei = Indicadoresoei::findFirst(
                            [
                                "id_indicador_oei = '$id' AND ano_eje = $id2"
                            ]
            );
        } else {
            
        }

        //echo '<pre>';
        //print_r($indicadoresoei);
        //exit();

        $this->view->indicadoresoei = $indicadoresoei;

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


        // echo "<pre>";
        // print_r($_POST);
        // exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("id_indicador_oei", "string");
                $id2 = (int) $this->request->getPost("ano_eje", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();
                //$indicadoresoei = Objetivosei::findFirstByid_objetivo_ei($id);

                $indicadoresoei = Indicadoresoei::findFirst(
                                [
                                    "id_indicador_oei = '$id' AND ano_eje = $id2"
                                ]
                );

                //Valida cuando es nuevo
                $indicadoresoei = (!$indicadoresoei) ? new Indicadoresoei() : $indicadoresoei;

                //id_objetivo_ei        
                $indicadoresoei->id_indicador_oei = $this->request->getPost("codigo", "string");

                //id_objetivo_ei
                if ($this->request->getPost("id_objetivo_ei", "string") == "") {
                    $indicadoresoei->id_objetivo_ei = null;
                } else {
                    $indicadoresoei->id_objetivo_ei = $this->request->getPost("id_objetivo_ei", "string");
                }

                //ano_eje
                $indicadoresoei->ano_eje = $this->request->getPost("ano_eje", "int");

                //nombre
                $indicadoresoei->nombre = $this->request->getPost("nombre", "string");

                //descripcion
                $indicadoresoei->descripcion = $this->request->getPost("descripcion", "string");

                //orden
                $indicadoresoei->orden = $this->request->getPost("orden", "string");

                //avance
                if ($this->request->getPost("avance", "int") == "") {
                    $indicadoresoei->avance = null;
                } else {
                    $indicadoresoei->avance = $this->request->getPost("avance", "int");
                }

                //enlace
                $indicadoresoei->enlace = $this->request->getPost("enlace", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $indicadoresoei->estado = "A";
                } else {
                    $indicadoresoei->estado = "X";
                }


                if ($indicadoresoei->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($indicadoresoei->getMessages());
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
            $datatable->setColumnaId("id_indicador_oei");
            $datatable->setSelect("id_indicador_oei, id_objetivo_ei,ano_eje,"
                    . "nombre, descripcion, "
                    . "orden, avance, "
                    . "enlace, estado ");
            $datatable->setFrom("tbl_gxi_indicadores_oei");
            //$datatable->setWhere("estado = 'A'");
            //$datatable->setWhere("ano_eje.numero = 40");
            $datatable->setOrderby("ano_eje,id_indicador_oei ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$indicadoresoei = Objetivosei::findFirstByid_objetivo_ei((string) $this->request->getPost("id", "string"));

            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $indicadoresoei = Indicadoresoei::findFirst(
                            [
                                "id_indicador_oei = '$id' AND ano_eje = $id2"
                            ]
            );



            if ($indicadoresoei && $indicadoresoei->estado = 'A') {
                $indicadoresoei->estado = 'X';
                $indicadoresoei->save();
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

    //
    //validar id_indicador_oei
    public function getIndicadoresoeiAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_objetivo_ei = (string) $this->request->getPost("id", "string");

            $ano_eje = (int) $this->request->getPost("ano_eje", "int");


            $indicadoresoei = Indicadoresoei::count(
                            [
                                "id_objetivo_ei = '$id_objetivo_ei' AND ano_eje = $ano_eje "
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

}
