<?php

class FormatossuneduController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/formatossunedu.js?v=" . uniqid());
    }

    public function indexAction() {
        
    }


    //Cargamos el datatables
    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_formato");
            $datatable->setSelect("id_formato, nombre, descripcion, archivo, enlace, estado, archivo2");
            $datatable->setFrom("tbl_lic_formatos");
            $datatable->setWhere("estado = 'A'");
            $datatable->setOrderby("id_formato");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }



}
