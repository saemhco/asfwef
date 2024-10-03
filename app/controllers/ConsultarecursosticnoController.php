<?php

class ConsultarecursosticnoController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //--------------------------------convocatorias-----------------------------
    public function indexAction() {
        //convocatoriasganadores.js
        $this->assets->addJs("adminpanel/js/modulos/consultarecursosticno.js?v=" . uniqid());
    }

    //datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("pk, tipo_nombre, marca, modelo, serie, color,estado, observaciones, mac, caracteristicas, patrimonial");
            $datatable->setFrom("view_consulta_recursos_tic_no");
            //$datatable->setWhere("pae_estado = 'A' ");
            $datatable->setOrderby("tipo_nombre, patrimonial");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

       

}
