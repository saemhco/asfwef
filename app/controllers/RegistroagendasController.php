<?php
class RegistroagendasController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {

        $this->assets->addJs("adminpanel/js/modulos/registroagendas.js?v=" . uniqid());
    }

    public function saveAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

            // echo"<pre>";
            // print_r($_POST);
            // exit();

                $id = (int) $this->request->getPost("id_agenda", "int");
                $model = Agenda::findFirstByid_agenda($id);
                $model = (!$model) ? new Agenda() : $model;

                $model->descripcion = $this->request->getPost("descripcion", "string");
                if ($this->request->getPost("fecha_hora", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_hora", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora", "string");
                    $model->fecha_hora = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
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

    public function getAjaxAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo"<pre>";
            // print_r($_POST);
            // exit();

            $model = Agenda::findFirstByid_agenda((int) $this->request->getPost("id_agenda", "int"));
            if ($model) {
                $this->response->setJsonContent($model->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo"<pre>";
            // print_r($_POST);
            // exit();

            $model = Agenda::findFirstByid_agenda((int) $this->request->getPost("id_agenda", "int"));
            if ($model && $model->estado = 'A') {
                $model->estado = 'X';
                $model->save();
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

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_agenda");
            $datatable->setSelect("id_agenda,"
                . " descripcion,to_char(fecha_hora, 'DD/MM/YYYY') AS fecha_hora,
                    to_char(fecha_hora::Time, 'HH12:MI:SS AM') AS hora,estado");
            $datatable->setFrom("tbl_web_agenda");
            //$datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("descripcion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }
}
