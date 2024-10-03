<?php

class ConsultacontratosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //index
    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/consultacontratos.js?v=" . uniqid() . "");
    }

    public function datatableAction() {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_personal");
            $datatable->setSelect("id_personal,personal_nombre,estado");
            $datatable->setFrom("(SELECT
            public.tbl_web_personal.codigo AS id_personal,
            CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre,
            public.tbl_web_personal.estado AS estado
            FROM
            public.tbl_web_personal
            WHERE
            public.tbl_web_personal.estado = 'A' AND public.tbl_web_personal.codigo <> 0) AS temporal_table");
            $datatable->setOrderby("personal_nombre");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function detalleAction($id_personal) {
        $this->view->id_personal = $id_personal;
        $this->assets->addJs("adminpanel/js/modulos/consultacontratos.detalle.js?v=" . uniqid() . "");
    }

    //datatable
    public function datatabledetalleAction($id_personal) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

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
