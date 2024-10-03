<?php

class TablasmaestrasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

    }

    //index
    public function indexAction($numero_tabla = null) {
        $tablas_maestras = TablasMaestras::find(
                        [
                            "codigo = 100 AND nombres <> '-' ",
                            'order' => 'nombres',
                        ]
        );
        $this->view->tablas_maestras = $tablas_maestras;
        $this->view->numero_tabla = $numero_tabla;

//        foreach ($robots as $khi) {
//
//            echo "<pre>";
//            print_r($khi->nombres . '<br>');
//        }
//        exit();

        $this->view->valor_datatable = 0;
        $this->assets->addJs("adminpanel/js/modulos/tablasmaestras.js?v=" . uniqid());

    }

    public function valoresAction($numero_tabla = null) {

        $this->assets->addJs("adminpanel/js/modulos/tablasmaestras.js?v=" . uniqid());

        if ($numero_tabla == null) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("tablasmaestras");
        }

        $tablas_maestras = TablasMaestras::find(
                        [
                            "codigo = 100 AND nombres <> '-' ",
                            'order' => 'nombres',
                        ]
        );
        $this->view->tablas_maestras = $tablas_maestras;
        $this->view->numero_tabla = $numero_tabla;

//        foreach ($robots as $khi) {
//
//            echo "<pre>";
//            print_r($khi->nombres . '<br>');
//        }
//        exit();
    }

    public function registroAction($numero_tabla = null) {

        $this->view->numero_tabla = $numero_tabla;
        $this->assets->addJs("adminpanel/js/modulos/tablasmaestras.tablas.js?v=" . uniqid());

    }

    public function tablasAction() {
        $this->assets->addJs("adminpanel/js/modulos/tablasmaestras.tablas.js?v=" . uniqid());

    }

    public function datatablemaestrasAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("numero");
            $datatable->setSelect("codigo, nombres,numero, descripcion, abreviatura, orden, estado");
            $datatable->setFrom("a_codigos");
            $datatable->setWhere("estado = 'N' AND codigo = 100");
            //$datatable->setWhere("estado = 'D'");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $numero = (int) $this->request->getPost("numero", "int");
                $codigo = (int) $this->request->getPost("codigo", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();

                $TablasMaestras = TablasMaestras::findFirst(
                                [
                                    "numero = $numero AND codigo = $codigo"
                                ]
                );

                //Valida cuando es nuevo
                $TablasMaestras = (!$TablasMaestras) ? new TablasMaestras() : $TablasMaestras;

                //numero      
                $TablasMaestras->numero = $this->request->getPost("numero", "string");

                //codigo
                $TablasMaestras->codigo = $this->request->getPost("codigo", "int");

                //nombre
                $TablasMaestras->nombres = $this->request->getPost("nombres", "string");

                //descripcion
                $TablasMaestras->descripcion = $this->request->getPost("descripcion", "string");

                //abreviatura
                $TablasMaestras->abreviatura = $this->request->getPost("abreviatura", "string");

                //orden
                $TablasMaestras->orden = $this->request->getPost("orden", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
                if (isset($estado)) {
                    $TablasMaestras->estado = "A";
                } else {
                    $TablasMaestras->estado = "X";
                }


                if ($TablasMaestras->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($TablasMaestras->getMessages());
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

    public function savemaestrasAction() {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $numero = (int) $this->request->getPost("numero", "int");
                $codigo = (int) $this->request->getPost("codigo", "int");

                //echo '<pre>';
                //print_r($id2);
                //exit();

                $TablasMaestras = TablasMaestras::findFirst(
                                [
                                    "numero = $numero AND codigo = $codigo"
                                ]
                );

                //Valida cuando es nuevo
                $TablasMaestras = (!$TablasMaestras) ? new TablasMaestras() : $TablasMaestras;

                //numero      
                $TablasMaestras->numero = $this->request->getPost("numero", "string");

                //codigo
                $TablasMaestras->codigo = $this->request->getPost("codigo", "int");

                //nombre
                $TablasMaestras->nombres = $this->request->getPost("nombres", "string");

                //descripcion
                $TablasMaestras->descripcion = $this->request->getPost("descripcion", "string");

                //abreviatura
                $TablasMaestras->abreviatura = $this->request->getPost("abreviatura", "string");

                //orden
                $TablasMaestras->orden = $this->request->getPost("orden", "string");

                //estado
                $estado = $this->request->getPost("estado", "string");
//                if (isset($estado)) {
                $TablasMaestras->estado = "N";
//                } else {
//                    $TablasMaestras->estado = "X";
//                }


                if ($TablasMaestras->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($TablasMaestras->getMessages());
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

    public function datatableAction($numero_tabla) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("numero");
            $datatable->setSelect("codigo, nombres,numero, descripcion, abreviatura, orden, estado");
            $datatable->setFrom("a_codigos");
            $datatable->setWhere("codigo <> 100 AND estado <> 'N' AND numero = $numero_tabla");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //edit    
    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $numero = (int) $this->request->getPost("numero", "int");
            $codigo = (int) $this->request->getPost("codigo", "int");

            $TablasMaestras = TablasMaestras::findFirst(
                            [
                                "numero = $numero AND codigo = $codigo"
                            ]
            );

            if ($TablasMaestras) {
                $this->response->setJsonContent($TablasMaestras->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //new
    public function getNewAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $numero = (int) $this->request->getPost("numero_tabla", "int");
            //$codigo = (int) $this->request->getPost("codigo", "int");
            //echo '<pre>';
            //print_r($numero);
            //exit();

            $TablasMaestras = TablasMaestras::count(
                            [
                                "codigo > 0 AND codigo < 99 AND numero = $numero"
                            ]
            );

            //echo '<pre>';
            //print_r($TablasMaestras);
            ///exit();

            if ($TablasMaestras >= 0) {

                $id_pk = $TablasMaestras + 1;


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

    public function getNewMaestraAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $db = $this->db;
            $sql1 = " select count(distinct numero) AS numero from a_codigos  ";
            //print $sql; exit();
            $resultados = $db->fetchOne($sql1, Phalcon\Db::FETCH_OBJ);

            //echo '<pre>';
            //print_r($resultados->numero);
            //exit();

            $TablasMaestras = $resultados->numero;

            if ($TablasMaestras >= 0) {

                $id_pk = $TablasMaestras + 1;


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

    //delete
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $numero = $this->request->getPost("numero", "int");
            $codigo = $this->request->getPost("codigo", "int");

            $TablasMaestras = TablasMaestras::findFirst(
                            [
                                "numero = $numero AND codigo = $codigo"
                            ]
            );

            if ($TablasMaestras && $TablasMaestras->estado = 'A') {
                $TablasMaestras->estado = 'X';
                $TablasMaestras->save();
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
