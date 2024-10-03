<?php

class GestioncontratosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {

        $this->assets->addJs("adminpanel/js/modulos/gestioncontratos.js?v=" . uniqid());
    }

    public function datatablePersonalContratoAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            
            $auth = $this->session->get('auth');
            $id_personal = $auth["codigo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_per_contratos.id_contrato");
            $datatable->setSelect("public.tbl_per_contratos.id_contrato,"
                    . "public.tbl_per_contratos.anio,"
                    . "public.tbl_per_contratos.fecha_inicio,"
                     . "public.tbl_per_contratos.fecha_fin,"
                    . "public.tbl_per_contratos.contrato,"
                    . "public.tbl_per_contratos.archivo");
            $datatable->setFrom("public.tbl_per_contratos");
            $datatable->setWhere("public.tbl_per_contratos.estado = 'A' AND public.tbl_per_contratos.personal = {$id_personal}");
            $datatable->setOrderby("public.tbl_per_contratos.anio DESC, public.tbl_per_contratos.fecha_inicio DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
