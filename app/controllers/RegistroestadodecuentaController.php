<?php

class RegistroestadodecuentaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroestadodecuenta.js?v=" . uniqid() . "");
    }

    public function indexAction()
    {

    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("public.caja.codigo");
            $datatable->setSelect("public.caja.codigo,
            public.caja.alumno,
            public.conceptos.descripcion AS concepto_nombre,
            public.caja.fecha_emision,
            public.caja.fecha_pago,
            public.caja.cuota,
            public.caja.cantidad,
            public.caja.monto,
            public.caja.monto AS total,
            public.caja.proceso,
            public.caja.estado");
            $datatable->setFrom("public.caja INNER JOIN public.conceptos ON public.conceptos.codigo = public.caja.concepto");
            //$datatable->setWhere("public.caja.monto.estado = 'A'");
            $datatable->setOrderBy("public.caja.codigo desc");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //pagar
    public function pagarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                //echo "<pre>";
                //print_r($_POST);
                //exit();

                $idCaja = (int) $this->request->getPost("id_caja", "int");
                $Caja = Caja::findFirst("codigo = {$idCaja}");
                $Caja->voucher = $this->request->getPost("voucher", "string");
                $Caja->fecha_pago = date("Y-m-d H:i:s");
                $Caja->proceso = 1;
   
                if ($Caja->save() == false) {
                    //print("testing");
                    //exit();
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Caja->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

}
