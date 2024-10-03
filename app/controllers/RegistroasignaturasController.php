<?php

class RegistroasignaturasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroasignaturas.js?v=" . uniqid());
    }

    //Aca insertamos un comentario para subir
    public function indexAction() {
        
    }

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("a.codigo");
            $datatable->setSelect("a.codigo, a.nombre, cu.descripcion as curricula,"
                    . " a.ciclo, a.ht, a.hp, a.tipo, a.creditos, "
                    . "a.estado,t_a.nombres AS tipo_asignatura");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("asignaturas a
                INNER JOIN curriculas cu ON a.curricula = cu.codigo
                INNER JOIN a_codigos t_a ON t_a.codigo = a.tipo
                ");
            //$datatable->setWhere(" (a.estado = 'A') AND (a.codigo > 0) ");
            $datatable->setWhere("(a.estado = 'A') AND (a.nivel > 0) AND t_a.numero = 71");
            $datatable->setOrderby("cu.descripcion, a.ciclo, a.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion agregar y editar
    public function registroAction($id = null) {

        if ($id != null) {
            $asignaturas = Asignaturas::findFirstBycodigo((string) $id);
        } else {
            //$Asignaturas = Asignaturas::findFirstBycodigo(0);
            //funcion para crear uevo registro
            //hacer consulta y enviar a la vista



            $asignaturas = Asignaturas::findFirstBycodigo(NULL);
        }


        //Modelo ciclos(a_codigos)
        $ciclos = Ciclos::find("estado = 'A' AND numero = 7 ");
        $this->view->ciclos = $ciclos;

        //Modelo tipo de asignatura
        $tipoasignaturas = TipoAsignaturas::find("estado = 'A' AND numero = 6");
        $this->view->tipoasignaturas = $tipoasignaturas;
        
        //Modelo tipo de asignaturae
        $tipoasignaturase = TipoAsignaturasE::find("estado = 'A' AND numero = 71");
        $this->view->tipoasignaturase = $tipoasignaturase;

        //Modelo tipo de curriculas
        $curriculas = Curriculas::find("estado = 'A'");
        $this->view->curriculas = $curriculas;

        $this->view->asignaturas = $asignaturas;
    }

    //Funcion para guardar asignatura
    public function saveAction() {
        //echo "<pre>";print_r($_POST);exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "int");
                $Asignaturas = Asignaturas::findFirstBycodigo($id);
                $Asignaturas = (!$Asignaturas) ? new Asignaturas() : $Asignaturas;

                $Asignaturas->codigo = $this->request->getPost("codigo", "string");


                $Asignaturas->nombre = $this->request->getPost("nombre", "string");
                $Asignaturas->nivel = $this->request->getPost("nivel", "string");
                $Asignaturas->ciclo = $this->request->getPost("ciclo", "string");
                $Asignaturas->tipo = $this->request->getPost("tipo", "string");
                $Asignaturas->tipoe = $this->request->getPost("tipoe", "string");

                // print $this->request->getPost("curricula", "string") ;exit();

                $Asignaturas->curricula = $this->request->getPost("curricula", "string");
                $Asignaturas->creditos = $this->request->getPost("creditos", "string");
                $Asignaturas->pr1 = $this->request->getPost("pr1", "string");
                $Asignaturas->pr2 = $this->request->getPost("pr2", "string");
                $Asignaturas->pr3 = $this->request->getPost("pr3", "string");
                $Asignaturas->prhm = $this->request->getPost("prhm", "string");
                $Asignaturas->ht = $this->request->getPost("ht", "string");
                $Asignaturas->hp = $this->request->getPost("hp", "string");
                $Asignaturas->observaciones = $this->request->getPost("observaciones");
                $Asignaturas->estado = "A";



                if ($Asignaturas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Asignaturas->getMessages());
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

    //Funcion para eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Asignaturas = Asignaturas::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Asignaturas && $Asignaturas->estado = 'A') {
                $Asignaturas->estado = 'X';
                $Asignaturas->save();
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

    //validar registro de asignaturas
    public function asignaturaRegistradaAction() {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $asignaturas = Asignaturas::findFirstBycodigo((string) $this->request->getPost("codigo_asignatura", "string"));


            if ($asignaturas) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
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
