<?php

class RegistroaeiController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

    }


    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registroaei.js?v=" . uniqid());

    }


    public function registroAction($id = null, $id2 = null)
    {
        $this->view->id = $id;
        $this->view->id2 = $id2;

        if ($id != null && $id2 != null) {
            //$accionesei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $accionesei = Accionesei::findFirst(
                [
                    "id_accion_ei = '$id' AND ano_eje = $id2"
                ]
            );
        }


        $this->view->accionesei = $accionesei;

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

        $objetivosei = Objetivosei::find("estado = 'A'");
        $this->view->objetivosei = $objetivosei;

        $this->assets->addJs("adminpanel/js/modulos/registroaei.js?v=" . uniqid());

    }


    public function saveAction()
    {





        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("id_accion_ei", "string");
                $id2 = (int) $this->request->getPost("ano_eje", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();
                //$accionesei = Objetivosei::findFirstByid_objetivo_ei($id);

                $accionesei = Accionesei::findFirst(
                    [
                        "id_accion_ei = '$id' AND ano_eje = $id2"
                    ]
                );

                //Valida cuando es nuevo
                $accionesei = (!$accionesei) ? new Accionesei() : $accionesei;

                //id_objetivo_ei        
                $accionesei->id_accion_ei = $this->request->getPost("codigo", "string");

                //id_objetivo_ei
                if ($this->request->getPost("id_objetivo_ei", "string") == "") {
                    $accionesei->id_objetivo_ei = null;
                } else {
                    $accionesei->id_objetivo_ei = $this->request->getPost("id_objetivo_ei", "string");
                }

                //ano_eje
                $accionesei->ano_eje = $this->request->getPost("ano_eje", "int");

                //nombre
                $accionesei->nombre = $this->request->getPost("nombre", "string");

                //descripcion
                $accionesei->descripcion = $this->request->getPost("descripcion", "string");

                //orden
                $accionesei->orden = $this->request->getPost("orden", "string");

                //avance
                if ($this->request->getPost("avance", "int") == "") {
                    $accionesei->avance = null;
                } else {
                    $accionesei->avance = $this->request->getPost("avance", "int");
                }

                //enlace
                $accionesei->enlace = $this->request->getPost("enlace", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $accionesei->estado = "A";
                } else {
                    $accionesei->estado = "X";
                }


                if ($accionesei->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($accionesei->getMessages());
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

    //datatables accionesei
    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_accion_ei");
            $datatable->setSelect("id_accion_ei, id_objetivo_ei,ano_eje,"
                . "nombre, descripcion, "
                . "orden, avance, "
                . "enlace, estado ");
            $datatable->setFrom("tbl_gxi_acciones_ei");
            //$datatable->setWhere("estado = 'A'");
            //$datatable->setWhere("ano_eje.numero = 40");
            $datatable->setOrderby("ano_eje,id_objetivo_ei ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$accionesei = Objetivosei::findFirstByid_objetivo_ei((string) $this->request->getPost("id", "string"));

            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $accionesei = Accionesei::findFirst(
                [
                    "id_accion_ei = '$id' AND ano_eje = $id2"
                ]
            );



            if ($accionesei && $accionesei->estado = 'A') {
                $accionesei->estado = 'X';
                $accionesei->save();
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
    public function getObjetivosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $ano_eje = $this->request->getPost("ano_eje");
            $objetivosei = Objetivosei::find('ano_eje = "' . $ano_eje . '"');
            $this->response->setJsonContent($objetivosei->toArray());
            $this->response->send();
        }
    }
    //fin

    //valida pk accionesei
    public function getAccioneseiAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_objetivo_ei = (string) $this->request->getPost("id", "string");

            $ano_eje = (int) $this->request->getPost("ano_eje", "int");


            $indicadoresoei = Accionesei::count(
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
    //


    public function aeiiAction($id_accion_ei)
    {
        $this->view->id_accion_ei = $id_accion_ei;
        $this->assets->addJs("adminpanel/js/modulos/registroaei.aeii.js?v=" . uniqid());
    }

    public function datatableAeiiAction($id_accion_ei)
    {
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
            $datatable->setWhere("id_accion_ei = '$id_accion_ei'");
            $datatable->setOrderby("ano_eje,id_indicador_aei ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registroaeiiAction($id = null, $id2 = null) {
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

        $this->assets->addJs("adminpanel/js/modulos/registroaei.aeii.js?v=" . uniqid());

    }

}
