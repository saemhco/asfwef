<?php

class BtrpostulacioneswebController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
        $this->assets->addJs("adminpanel/js/modulos/btrpostulacionesweb.js?v=" . uniqid());
    }

    public function indexAction() {
        //echo '<pre>';
        //print_r($this->session->get("auth")["codigo"]);
        //exit();
        
    }

    public function datatableAction() {
        
        $alumno = $this->session->get("auth")["codigo"];
        
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("p.alumno");
            $datatable->setSelect("p.alumno , p.empleo, p.cv_referencia, p.fecha_postulacion, p.estado,
            p.estado , e.titulo, em.razon_social");
            $datatable->setFrom("tbl_btr_postulaciones p
            INNER JOIN tbl_btr_empleos e ON e.id_empleo = p.empleo
            INNER JOIN tbl_btr_empresas em ON em.id_empresa = e.empresa");
            $datatable->setWhere("e.estado = 'A' AND p.alumno = '$alumno' ");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
