<?php

class GestionnexusController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/gestionnexus.js?v=" . uniqid());
    }



    public function licenciasAction($iddocumento = null)
    {

        if ($iddocumento != null) {

            $uglLicencias = UglLicencias::findFirstByid_nro_doc("$iddocumento");

        } else {
            $uglLicencias = UglLicencias::findFirstByid_nro_doc(null);
        }

        $this->view->uglLicencias = $uglLicencias;
        $this->assets->addJs("adminpanel/js/modulos/gestionnexus.licencias.js?v=" . uniqid());

        $tiposlicencias = TiposLicencias::find("estado = 'A' AND numero = 109");
        $this->view->tiposlicencias = $tiposlicencias;

        $motivos = Motivos::find("estado = 'A' AND numero = 108");
        $this->view->motivos = $motivos;

        $situaciones = Situaciones::find("estado = 'A' AND numero = 107");
        $this->view->situaciones = $situaciones;
    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("documento_de_identidad");
            $datatable->setSelect("nombre_de_la_institucion_educativa, cargo,
            codigo_de_plaza, documento_de_identidad,
            codigo_modular, apellidos_nombres, 
            categoria_remunerativa, fecha_de_ingreso,
            fecha_de_nacimiento, estado");
            $datatable->setFrom("(SELECT
           public.tbl_ugl_nexus.nombre_de_la_institucion_educativa,
           public.tbl_ugl_nexus.cargo,
           public.tbl_ugl_nexus.codigo_de_plaza,
           public.tbl_ugl_nexus.documento_de_identidad,
           public.tbl_ugl_nexus.codigo_modular,
            CONCAT (public.tbl_ugl_nexus.apellido_paterno, ' ',public.tbl_ugl_nexus.apellido_materno, ' ',public.tbl_ugl_nexus.nombres ) AS apellidos_nombres,
           public.tbl_ugl_nexus.categoria_remunerativa,
            to_char(public.tbl_ugl_nexus.fecha_de_ingreso, 'DD/MM/YYYY') AS fecha_de_ingreso,
            to_char(public.tbl_ugl_nexus.fecha_de_nacimiento, 'DD/MM/YYYY') AS fecha_de_nacimiento,
           public.tbl_ugl_nexus.estado
            FROM
           public.tbl_ugl_nexus) AS temporal_table");
            $datatable->setOrderby("documento_de_identidad DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveLicenciasAction() {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $id = (int) $this->request->getPost("id_licencia", "int");
                $uglLicencias = UglLicencias::findFirstByid_licencia($id);
                $uglLicencias = (!$uglLicencias) ? new UglLicencias() : $uglLicencias;

                $uglLicencias->expediente_nro = $this->request->getPost("expediente_nro", "string");
                $uglLicencias->expediente_nro_folios = $this->request->getPost("expediente_nro_folios", "int");
                $uglLicencias->id_nro_doc = $this->request->getPost("id_nro_doc", "string");
                $uglLicencias->id_plaza = $this->request->getPost("id_plaza", "string");
                $uglLicencias->id_tipo = $this->request->getPost("id_tipo", "int");
                $uglLicencias->id_motivo = $this->request->getPost("id_motivo", "int");
                $uglLicencias->id_situacion = $this->request->getPost("id_situacion", "int");
                
                if ($this->request->getPost("fecha_inicio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_inicio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $uglLicencias->fecha_inicio = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("fecha_fin", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_fin", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $uglLicencias->fecha_fin = date('Y-m-d', strtotime($fecha_new));
                }

                $uglLicencias->dias = $this->request->getPost("dias", "int");
                $uglLicencias->certificado = $this->request->getPost("certificado", "string");
                $uglLicencias->resolucion = $this->request->getPost("resolucion", "string");
                $uglLicencias->estado = "A";

                if ($uglLicencias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($uglLicencias->getMessages());
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


    public function datatableLicenciasAction($iddocumento = null)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_licencia");
            $datatable->setSelect("id_licencia,expediente_nro,
            expediente_nro_folios, id_nro_doc,
            id_plaza, tipolicencia,motivo,
            situacion,fecha_inicio,
            fecha_fin, dias,
            certificado,resolucion,estado");
            $datatable->setFrom("(SELECT
            public.tbl_ugl_licencias.id_licencia,
            public.tbl_ugl_licencias.expediente_nro,
            public.tbl_ugl_licencias.expediente_nro_folios,
            public.tbl_ugl_licencias.id_nro_doc,
            public.tbl_ugl_licencias.id_plaza,
            tiposlicencias.nombres AS tipolicencia,
            motivos.nombres AS motivo,
            situaciones.nombres AS situacion,
            to_char( public.tbl_ugl_licencias.fecha_inicio, 'DD/MM/YYYY' ) AS fecha_inicio,
            to_char( public.tbl_ugl_licencias.fecha_fin, 'DD/MM/YYYY' ) AS fecha_fin,
            public.tbl_ugl_licencias.dias,
            public.tbl_ugl_licencias.certificado,
            public.tbl_ugl_licencias.resolucion,
            public.tbl_ugl_licencias.estado
            FROM
            public.tbl_ugl_licencias
            INNER JOIN public.a_codigos AS tiposlicencias ON public.tbl_ugl_licencias.id_tipo = tiposlicencias.codigo
            INNER JOIN public.a_codigos AS motivos ON motivos.codigo = public.tbl_ugl_licencias.id_motivo
            INNER JOIN public.a_codigos AS situaciones ON situaciones.codigo = public.tbl_ugl_licencias.id_situacion
            WHERE
            tiposlicencias.numero = 109 AND
            motivos.numero = 108 AND
            situaciones.numero = 107 AND
            public.tbl_ugl_licencias.id_nro_doc = '$iddocumento') AS temporal_table");
            $datatable->setOrderby("id_licencia DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function getAjaxLicenciasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $uglLicencias = UglLicencias::findFirstByid_licencia((int) $this->request->getPost("id", "int"));
            if ($uglLicencias) {
                $this->response->setJsonContent($uglLicencias->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarLicenciasAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $uglLicencias = UglLicencias::findFirstByid_licencia((int) $this->request->getPost("id", "int"));
            
            if ($uglLicencias && $uglLicencias->estado = 'A') {
                $uglLicencias->estado = 'X';
                $uglLicencias->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


}
