<?php

class GestionestadodecuentaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestionestadodecuenta.js?v=" . uniqid() . "");
    }

    public function indexAction()
    {
        //echo "<pre>"; print_r($_SESSION);exit();
        $auth = $this->session->get('auth');
        $codigoAlumno = $auth["codigo"];

        $datosAlumno = Alumnos::findFirstBycodigo($codigoAlumno);
        $this->view->alumno = $datosAlumno;

        $carrea = Carreras::findFirstBycodigo($datosAlumno->carrera);
        $this->view->carrera = $carrea;

        $semestreActivo = Semestres::findFirst("activo = 'M'");
        $this->view->semestre_activo = $semestreActivo->codigo;

        $alumnosSemestre = AlumnosSemestre::findFirst("alumno = '{$codigoAlumno}' AND semestre = {$semestreActivo->codigo}");
        $this->view->ciclo = $alumnosSemestre->ciclo;

        $semestres = Semestres::find(['order' => 'codigo DESC']);
        $this->view->semestres = $semestres;

        //print($alumnosSemestre->ciclo);
        //exit();

    }

    public function datatableAction($semestreSelect) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $where = "public.caja.semestre = {$semestreSelect}";
            $auth = $this->session->get('auth');
            $codigoAlumno = $auth["codigo"];
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.caja.codigo");
            $datatable->setSelect("public.caja.codigo,
            public.conceptos.descripcion AS concepto_nombre,
            public.caja.fecha_emision,
            public.caja.fecha_pago,
            public.caja.cuota,
            public.caja.cantidad,
            public.caja.monto,
            public.caja.monto AS total,
            public.caja.proceso");
            $datatable->setFrom("public.caja INNER JOIN public.conceptos ON public.conceptos.codigo = public.caja.concepto");
            $datatable->setWhere("$where AND public.caja.semestre = 4 AND public.caja.alumno = '{$codigoAlumno}'");
            $datatable->setOrderBy("public.caja.codigo desc");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

}
