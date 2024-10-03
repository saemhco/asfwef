<?php

class RegistromedicamentosadquisicionesController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registromedicamentosadquisiciones.js?v=" . uniqid());
    }

    public function indexAction()
    {
    }

    public function registroAction($id = null)
    {

        $this->view->id = $id;
        if ($id != null) {
            $adquisiones = DssAdquisiciones::findFirstByid_adquisicion((int) $id);
        } else {

            $adquisiones = DssAdquisiciones::findFirstByid_adquisicion(0);
        }
        $this->view->adquisiones = $adquisiones;

        $origen = Origen::find("estado = 'A' AND numero = 92");
        $this->view->origen = $origen;

        $db = $this->db;
        $sqlMedicamentos = "SELECT
        public.tbl_dss_medicamentos.id_medicamento,
        public.tbl_dss_medicamentos.descripcion AS medicamento,
        concentraciones.nombres AS concentracion,
        formas.nombres AS forma
        FROM
        public.tbl_dss_medicamentos
        INNER JOIN public.a_codigos AS concentraciones ON public.tbl_dss_medicamentos.id_concentracion = concentraciones.codigo
        INNER JOIN public.a_codigos AS formas ON public.tbl_dss_medicamentos.id_forma = formas.codigo
        WHERE
        concentraciones.numero = 124 AND
        formas.numero = 123";
        $medicamentos = $db->fetchAll($sqlMedicamentos, Phalcon\Db::FETCH_OBJ);

        $this->view->medicamentos = $medicamentos;

        $this->assets->addJs("adminpanel/js/modulos/registromedicamentosadquisiciones.detalle.js?v=" . uniqid());
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_adquisicion");
            $datatable->setSelect("id_adquisicion, tipo, fecha_adquisicion, descripcion, numero_oc, precio, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_adquisiciones.id_adquisicion,
            tipos.nombres AS tipo,
            to_char(public.tbl_dss_adquisiciones.fecha_adquisicion, 'DD/MM/YYYY') AS fecha_adquisicion,
            public.tbl_dss_adquisiciones.descripcion,
            public.tbl_dss_adquisiciones.numero_oc,
            public.tbl_dss_adquisiciones.precio,
            public.tbl_dss_adquisiciones.observaciones,
            public.tbl_dss_adquisiciones.estado
            FROM
            public.tbl_dss_adquisiciones
            INNER JOIN public.a_codigos AS tipos ON tipos.codigo = public.tbl_dss_adquisiciones.tipo
            WHERE
            tipos.numero = 92) AS temporal_table");
            $datatable->setOrderby("id_adquisicion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_adquisicion", "int");
                $model = DssAdquisiciones::findFirstByid_adquisicion($id);
                $model = (!$model) ? new DssAdquisiciones() : $model;

                if ($this->request->getPost("tipo", "int") == "") {
                    $model->tipo = null;
                } else {
                    $model->tipo = $this->request->getPost("tipo", "int");
                }

                if ($this->request->getPost("fecha_adquisicion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_adquisicion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $model->fecha_adquisicion = date('Y-m-d', strtotime($fecha_new));
                }

                $model->descripcion = $this->request->getPost("descripcion", "string");
                $model->numero_oc = $this->request->getPost("numero_oc", "string");
                $model->precio = $this->request->getPost("precio", "string");
                $model->observaciones = $this->request->getPost("observaciones", "string");
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


    //eliminar
    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $model = DssAdquisiciones::findFirstByid_adquisicion((int) $this->request->getPost("id", "int"));
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





    public function datatableDetalleAction($id_adquisicion)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_adquisicion_detalle");
            $datatable->setSelect("id_adquisicion_detalle, id_adquisicion, medicamento, cantidad, precio, estado");
            $datatable->setFrom("(SELECT
            public.tbl_dss_adquisiciones_detalles.id_adquisicion_detalle,
            public.tbl_dss_adquisiciones_detalles.id_adquisicion,
            public.tbl_dss_medicamentos.descripcion AS medicamento,
            public.tbl_dss_adquisiciones_detalles.cantidad,
            public.tbl_dss_adquisiciones_detalles.precio,
            public.tbl_dss_adquisiciones_detalles.estado
            FROM
            public.tbl_dss_adquisiciones_detalles
            INNER JOIN public.tbl_dss_medicamentos ON public.tbl_dss_medicamentos.id_medicamento = public.tbl_dss_adquisiciones_detalles.id_medicamento
            WHERE public.tbl_dss_adquisiciones_detalles.id_adquisicion = $id_adquisicion) AS temporal_table");
            $datatable->setOrderby("id_adquisicion_detalle ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function saveDetalleAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_adquisicion_detalle", "int");
                $model = AdquisicionesDetalles::findFirstByid_adquisicion_detalle($id);
                $model = (!$model) ? new AdquisicionesDetalles() : $model;

                $model->id_adquisicion = $this->request->getPost("id_adquisicion", "int");
                if ($this->request->getPost("id_medicamento", "int") == "") {
                    $model->id_medicamento = null;
                } else {
                    $model->id_medicamento = $this->request->getPost("id_medicamento", "int");
                }

                if ($this->request->getPost("cantidad", "int") == "") {
                    $model->cantidad = null;
                } else {
                    $model->cantidad = $this->request->getPost("cantidad", "int");
                }

                $model->precio = $this->request->getPost("precio", "string");
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

    public function getAjaxDetalleAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {


            $obj = AdquisicionesDetalles::findFirstByid_adquisicion_detalle((int) $this->request->getPost("id", "int"));


            if ($obj) {
                $this->response->setJsonContent($obj->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarDetalleAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $obj = AdquisicionesDetalles::findFirstByid_adquisicion_detalle((int) $this->request->getPost("id", "int"));
            if ($obj && $obj->estado = 'A') {
                $obj->estado = 'X';
                $obj->save();
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
