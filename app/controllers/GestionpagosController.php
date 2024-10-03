
<?php

class GestionpagosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
        $this->assets->addJs("adminpanel/js/modulos/gestionpagos.js?v=" . uniqid());
    }

    public function indexAction()
    {

    }

    public function registroAction($id = null)
    {
        $conceptos = Conceptos::find();
        $this->view->conceptos = $conceptos;
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("codigo");
            $datatable->setSelect("codigo,fecha_emision,alumno_nombres,concepto,cantidad, monto,total,estado");
            $datatable->setFrom("(SELECT
            public.caja.codigo,
            to_char(public.caja.fecha_emision, 'DD/MM/YYYY') AS fecha_emision,
            CONCAT (public.alumnos.apellidop, ' ',public.alumnos.apellidom, ' ',public.alumnos.nombres) AS alumno_nombres,
            public.conceptos.descripcion AS concepto,
            public.caja.cantidad AS cantidad,
            public.conceptos.monto,
            (public.caja.cantidad*public.conceptos.monto) AS total,
            public.caja.estado
            FROM
            public.alumnos
            INNER JOIN public.caja ON public.alumnos.codigo = public.caja.alumno
            INNER JOIN public.conceptos ON public.caja.concepto = public.conceptos.codigo) AS temporal_table");
            $datatable->setWhere("estado = 'A'");
            $datatable->setParams($_POST);
            $datatable->setOrderby("codigo");
            $datatable->getJson();

        }
    }

}
