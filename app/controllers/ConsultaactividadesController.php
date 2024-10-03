<?php

class ConsultaactividadesController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //index
    public function indexAction() {
        $this->assets->addJs("adminpanel/js/modulos/consultaactividades.js?v=" . uniqid() . "");
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

    public function detalle1Action($id_personal) {
        $this->view->id_personal = $id_personal;
        $this->assets->addJs("adminpanel/js/modulos/consultaactividades.detalle1.js?v=" . uniqid() . "");
    }

    //datatable
    public function datatabledetalle1Action($id_personal) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_actividad");
            $datatable->setSelect("id_actividad, fecha, personal_nombre, estado");
            $datatable->setFrom("(SELECT
                                public.tbl_doc_actividades.id_actividad AS id_actividad,
                                public.tbl_doc_actividades.fecha AS fecha,
                                CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre,
                                public.tbl_doc_actividades.estado AS estado
                                FROM
                                public.tbl_web_personal
                                INNER JOIN public.tbl_doc_actividades ON public.tbl_web_personal.codigo = public.tbl_doc_actividades.personal
                                WHERE
                                public.tbl_doc_actividades.estado = 'A' AND public.tbl_doc_actividades.personal = {$id_personal}) AS temporal_table");
            //$datatable->setWhere("");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function detalle2Action($id = null) {
        if ($id != null) {
            $Actividades = Actividades::findFirstByid_actividad((int) $id);
            $this->view->id_actividad = $id;
        } else {
            $Actividades = Actividades::findFirstByid_actividad(0);

//            print("@KenMack");
//            exit();

            $this->view->id_actividad = 0;
        }

        $this->view->actividades = $Actividades;


        $this->assets->addJs("adminpanel/js/modulos/consultaactividades.detalle2.js?v=" . uniqid());
    }

    public function datatableActividadesDetallesAction($id) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.tbl_doc_actividades_detalles.id_actividad_detalle");
            $datatable->setSelect("public.tbl_doc_actividades_detalles.id_actividad_detalle,"
                    . "public.a_codigos.nombres AS turno,"
                    . "public.tbl_doc_actividades_detalles.descripcion");
            $datatable->setFrom("public.tbl_doc_actividades_detalles INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_doc_actividades_detalles.turno");
            $datatable->setWhere("public.tbl_doc_actividades_detalles.actividad = {$id} AND public.a_codigos.numero = 18");
            $datatable->setOrderby("public.tbl_doc_actividades_detalles.id_actividad_detalle ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
