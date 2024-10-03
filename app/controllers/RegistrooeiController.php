<?php

class RegistrooeiController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        
    }

    //index
    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registrooei.js?v=" . uniqid());
    }

    //funcion agregar y editar
    public function registroAction($id1 = null, $id2 = null)
    {

        $this->view->id1 = $id1;
        $this->view->id2 = $id2;

        //cuando se va editar
        if ($id1 != null && $id2 != null) {


            //$objetivosei = Objetivosei::findFirstByid_objetivo_ei((string) $id);
            $objetivosei = Objetivosei::findFirst(
                [
                    "id_objetivo_ei = '$id1' AND ano_eje = $id2"
                ]
            );
        }

        //echo '<pre>';
        //print_r($objetivosei);
        //exit();

        $this->view->objetivosei = $objetivosei;

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
        $this->assets->addJs("adminpanel/js/modulos/registrooei.js?v=" . uniqid());
    }

    public function saveAction()
    {


        //echo "<pre>";
        //print_r($_POST);
        //exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("id_objetivo_ei", "string");
                $id2 = (int) $this->request->getPost("ano_eje", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();
                //$objetivosei = Objetivosei::findFirstByid_objetivo_ei($id);

                $objetivosei = Objetivosei::findFirst(
                    [
                        "id_objetivo_ei = '$id' AND ano_eje = $id2"
                    ]
                );




                //Valida cuando es nuevo
                $objetivosei = (!$objetivosei) ? new Objetivosei() : $objetivosei;

                //id_objetivo_ei        
                $objetivosei->id_objetivo_ei = $this->request->getPost("codigo", "string");

                $objetivosei->ano_eje = $this->request->getPost("ano_eje", "int");

                //nombre
                $objetivosei->nombre = $this->request->getPost("nombre", "string");

                //descripcion
                $objetivosei->descripcion = $this->request->getPost("descripcion", "string");

                //orden
                $objetivosei->orden = $this->request->getPost("orden", "string");

                //avance
                if ($this->request->getPost("avance", "int") == "") {
                    $objetivosei->avance = null;
                } else {
                    $objetivosei->avance = $this->request->getPost("avance", "int");
                }

                //enlace
                $objetivosei->enlace = $this->request->getPost("enlace", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $objetivosei->estado = "A";
                } else {
                    $objetivosei->estado = "X";
                }


                if ($objetivosei->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($objetivosei->getMessages());
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

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);


            $datatable->setColumnaId("id_objetivo_ei");
            $datatable->setSelect("id_objetivo_ei,ano_eje,"
                . "nombre, descripcion, "
                . "orden, avance "
                . "enlace, estado ");
            $datatable->setFrom("tbl_gxi_objetivos_ei objetivosei");
            $datatable->setOrderby("objetivosei.ano_eje, objetivosei.id_objetivo_ei ASC");


            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //$objetivosei = Objetivosei::findFirstByid_objetivo_ei((string) $this->request->getPost("id", "string"));

            $id = $this->request->getPost("id", "string");
            $id2 = $this->request->getPost("id2", "int");

            $objetivosei = Objetivosei::findFirst(
                [
                    "id_objetivo_ei = '$id' AND ano_eje = $id2"
                ]
            );

            if ($objetivosei && $objetivosei->estado = 'A') {
                $objetivosei->estado = 'X';
                $objetivosei->save();
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

    public function getObjetivosAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $ano_eje = (int) $this->request->getPost("ano_eje", "int");

            $objetivosei = Objetivosei::count(
                [
                    "ano_eje = $ano_eje "
                ]
            );

            //echo '<pre>';
            //print_r($objetivosei);
            //exit();

            if ($objetivosei) {

                $id_pk = $objetivosei + 1;

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

    public function oeiiAction($id_objetivo_ei)
    {
        $this->view->id_objetivo_ei = $id_objetivo_ei;
        $this->assets->addJs("adminpanel/js/modulos/registrooei.oeii.js?v=" . uniqid());

    }

    public function datatableOeiiAction($id_objetivo_ei) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_indicador_oei");
            $datatable->setSelect("id_indicador_oei, id_objetivo_ei,ano_eje,"
                    . "nombre, descripcion, "
                    . "orden, avance, "
                    . "enlace, estado ");
            $datatable->setFrom("tbl_gxi_indicadores_oei");
            $datatable->setWhere("id_objetivo_ei = '$id_objetivo_ei'");
            $datatable->setOrderby("ano_eje,id_indicador_oei ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function registrooeiiAction($id = null, $id2 = null) {
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
        $this->assets->addJs("adminpanel/js/modulos/registrooei.oeii.js?v=" . uniqid());

    }

}
