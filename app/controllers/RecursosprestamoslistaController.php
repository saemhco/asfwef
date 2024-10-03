<?php

class RecursosprestamoslistaController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/recursosprestamoslista.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }


    //Cargamos el datatable computadoras prestadas
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_recurso_prestamo");
            $datatable->setSelect("id_recurso_prestamo, apellidos_nombres, codigos, tipo_usuario, id_recurso, fecha_prestamo_recurso, hora_entrada, hora_salida");
            $datatable->setFrom("view_prestamos_recursos");
            $datatable->setWhere("estado = 'C'");
            $datatable->setOrderby("id_recurso_prestamo DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function aplicaAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $alquiler_id = (int) $this->request->getPost("prestamo_id", "int");
            //$empleo_id = (int)$this->request->getPost("empleo_id", "int");
            //$aplica = $this->request->getPost("aplica", "string");


            $prestamos = $this->modelsManager->createBuilder()
                    //Instanciamos al modelo "Detallealquiler"
                    ->from('DetallePrestamos')
                    ->columns('Libros.titulo')
                    //Se escribe el nombre del Modelo "Libro"
                    ->join('Libros', 'Libros.libro_id = DetallePrestamos.libro_id')
                    ->where("DetallePrestamos.prestamo_id =" . $alquiler_id . "")
                    ->getQuery()
                    ->execute();

            //print_r($prestamos);exit();
            //enviamos por json la variable de $alquieleres

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("alquileres" => $prestamos->toArray()));

            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }



}
