<?php

class RegistrolibrosadquisicionesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/registrolibrosadquisiciones.js?v=" . uniqid());

        
        $origen = Origen::find("estado = 'A' AND numero = 92");
        $this->view->origen = $origen;
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // echo "<pre>";
                // print_r($_POST);
                // exit();

                $id = (int) $this->request->getPost("id_adquisicion", "int");
                $librosAdquisiciones = LibrosAdquisiciones::findFirstByid_adquisicion($id);
                $librosAdquisiciones = (!$librosAdquisiciones) ? new LibrosAdquisiciones() : $librosAdquisiciones;

                if ($this->request->getPost("tipo", "int") == "") {
                    $librosAdquisiciones->tipo = null;
                } else {
                    $librosAdquisiciones->tipo = $this->request->getPost("tipo", "int");
                }

                if ($this->request->getPost("fecha_adquisicion", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_adquisicion", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $librosAdquisiciones->fecha_adquisicion = date('Y-m-d', strtotime($fecha_new));
                }

                $librosAdquisiciones->descripcion = $this->request->getPost("descripcion", "string");
                $librosAdquisiciones->numero_oc = $this->request->getPost("numero_oc", "string");
                $librosAdquisiciones->precio = $this->request->getPost("precio", "string");
                $librosAdquisiciones->observaciones = $this->request->getPost("observaciones", "string");
                $librosAdquisiciones->estado = "A";

                if ($librosAdquisiciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($librosAdquisiciones->getMessages());
                } else {
                    //Cuando va bien 
                    
                    //obtenemos el ultimo id_adquisicion para insertar en el select de registro de libros/registro
                    $id_adquisicion_nuevo = LibrosAdquisiciones::count();
                    
                    
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes","id_adquisicion_nuevo" => $id_adquisicion_nuevo));
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $librosAdquisiciones = LibrosAdquisiciones::findFirstByid_adquisicion((int) $this->request->getPost("id", "int"));
            if ($librosAdquisiciones) {
                $this->response->setJsonContent($librosAdquisiciones->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $librosAdquisiciones = LibrosAdquisiciones::findFirstByid_adquisicion((int) $this->request->getPost("id", "int"));
            if ($librosAdquisiciones && $librosAdquisiciones->estado = 'A') {
                $librosAdquisiciones->estado = 'X';
                $librosAdquisiciones->save();
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

    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_adquisicion");
            $datatable->setSelect("id_adquisicion, tipo, fecha_adquisicion, descripcion, numero_oc, precio, observaciones, estado");
            $datatable->setFrom("(SELECT
            public.tbl_lib_adquisiciones.id_adquisicion,
            tipo.nombres AS tipo,
             to_char(public.tbl_lib_adquisiciones.fecha_adquisicion, 'DD/MM/YYYY') AS fecha_adquisicion,
            public.tbl_lib_adquisiciones.descripcion,
            public.tbl_lib_adquisiciones.numero_oc,
            public.tbl_lib_adquisiciones.precio,
            public.tbl_lib_adquisiciones.observaciones,
            public.tbl_lib_adquisiciones.estado
            FROM
            public.tbl_lib_adquisiciones
            INNER JOIN public.a_codigos AS tipo ON tipo.codigo = public.tbl_lib_adquisiciones.tipo
            WHERE
            tipo.numero = 92) AS temporal_table");
            $datatable->setOrderby("id_adquisicion");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
