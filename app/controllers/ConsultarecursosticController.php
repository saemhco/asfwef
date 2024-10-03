<?php

class ConsultarecursosticController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        //convocatoriasganadores.js
        $this->assets->addJs("adminpanel/js/modulos/consultarecursostic.js?v=" . uniqid());
    }

    //datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("pk");
            $datatable->setSelect("personal_area, usuario, nombre_equipo, patrimonial, tipo_nombre,  marca, modelo, serie, color, teamviewer, anydesk, ip, pae_estado");
            $datatable->setFrom("view_consulta_recursos_tic ");
            //$datatable->setWhere("pae_estado = 'A' ");
            $datatable->setOrderby("personal_nombre");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

       

}
