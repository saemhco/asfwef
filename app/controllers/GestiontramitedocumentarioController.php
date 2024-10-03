<?php

class GestiontramitedocumentarioController extends ControllerPanel
{

    public function initialize()
    {

        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestiontramitedocumentario.js?v=" . uniqid());
    }

    public function documentosrecibidosAction()
    {

    }


    public function registroAction($id = null)
    {

        if ($id != null) {
            $documentos = Documentos::findFirstByid_doc((int) $id);
        } else {
            $documentos = Documentos::findFirstByid_doc(0);
        }

        $this->view->documentos = $documentos;

        $ciudadanos = Publico::find("estado = 'A'");
        $this->view->ciudadanos = $ciudadanos;

        $empresas = Empresas::find("estado = 'A'");

        // foreach ($empresas as $key => $value) {
        //     echo"<pre>";
        //     print_r($value->razon_social);
        // }
        // exit();

        $this->view->empresas = $empresas;

        $tipoDocumentos = TipoDocumentos::find("estado = 'A' AND numero = 102");
        $this->view->tipodocumentos = $tipoDocumentos;

        $locales = Locales::find("estado = 'A'");
        $this->view->locales = $locales;

        $publico = Publico::find(
            [
                "estado = 'A'",
                'order' => 'apellidop, apellidom, nombres',
            ]
        );
        $this->view->remitentes = $publico;



        $personal = VPersonalArea::find(
            [
                "estado = 'A'",
                'order' => 'personal_nombre ASC',
            ]
        );
        $this->view->personal = $personal;

        $fecha_actual_envio = date('d/m/Y');
        $this->view->fecha_actual_envio = $fecha_actual_envio;

        $hora_actual_envio = date('h:i:s A');
        $this->view->hora_actual_envio = $hora_actual_envio;

        $fecha_cargo = date('d/m/Y');
        $this->view->fecha_actual_cargo = $fecha_cargo;

        $hora_actual_cargo = date('h:i:s A');
        $this->view->hora_actual_cargo = $hora_actual_cargo;

    }

    public function datatableAction()
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_doc");
            $datatable->setSelect("id_doc,fecha_envio, fecha_cargo,tipo_documento,nro_documento,remitente_nombres,estado, expediente, personal");
            $datatable->setFrom("(SELECT
            public.tbl_doc_documentos.id_doc,
            to_char(public.tbl_doc_documentos.fecha_envio, 'DD/MM/YYYY') AS fecha_envio,
            to_char(public.tbl_doc_documentos.fecha_cargo, 'DD/MM/YYYY') AS fecha_cargo,
            public.a_codigos.nombres AS tipo_documento,
            public.tbl_doc_documentos.nro_documento,
            public.tbl_doc_documentos.remitente_nombres,
            public.tbl_doc_documentos.estado,
            public.tbl_doc_documentos.expediente,
            public.tbl_doc_documentos.es_tramite,
            CONCAT (public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal,
            public.tbl_web_personal_areas.cargo,
            public.tbl_web_areas.nombres AS area
            FROM
            public.tbl_doc_documentos
            INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_doc_documentos.id_tipo_doc
            INNER JOIN public.tbl_web_personal_areas ON public.tbl_web_personal_areas.id_personal_area = public.tbl_doc_documentos.id_personal_area
            INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_personal_areas.area
            INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
            WHERE
            public.a_codigos.numero = 102 AND public.tbl_doc_documentos.es_tramite = '1'
            ORDER BY
            public.tbl_doc_documentos.expediente DESC) AS temporal_table");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_doc", "int");
                $documentos = Documentos::findFirstByid_doc($id);

                $documentos = (!$documentos) ? new Documentos() : $documentos;

                if ($this->request->getPost("id_remitente", "int") == "") {
                    $documentos->id_remitente = null;
                } else {
                    $documentos->id_remitente = $this->request->getPost("id_remitente", "int");
                }

                if ($this->request->getPost("id_tipo_doc", "int") == "") {
                    $documentos->id_tipo_doc = null;
                } else {
                    $documentos->id_tipo_doc = $this->request->getPost("id_tipo_doc", "int");
                }

                $documentos->id_tipo_envio = 2;


                if ($this->request->getPost("id_sede", "int") == "") {
                    $documentos->id_sede = null;
                } else {
                    $documentos->id_sede = $this->request->getPost("id_sede", "int");
                }

                
                if ($this->request->getPost("id_personal_area", "int") == "") {
                    $documentos->id_personal_area = null;
                } else {
                    $documentos->id_personal_area = $this->request->getPost("id_personal_area", "int");
                }


                if ($this->request->getPost("fecha_actual_envio", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_actual_envio", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_actual_envio", "string");
                    $documentos->fecha_envio = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }

                if ($this->request->getPost("fecha_actual_cargo", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_actual_cargo", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $hora = $this->request->getPost("hora_actual_cargo", "string");
                    $documentos->fecha_cargo = date("Y-m-d H:i:s", strtotime($fecha_new . $hora));
                }


                $documentos->fecha = date("Y-m-d H:i:s");
                $documentos->nro_documento = $this->request->getPost("nro_documento", "string");
                $documentos->asunto = $this->request->getPost("asunto", "string");
                $documentos->nro_folios = $this->request->getPost("nro_folios", "int");
                $documentos->proceso = 0;
                $documentos->estado = 'A';

                $documentos->remitente_nombres = $this->request->getPost("remitente_nombres", "string");
                $documentos->remitente_cargo = $this->request->getPost("remitente_cargo", "string");
                $documentos->remitente_area = $this->request->getPost("remitente_area", "string");
                $documentos->remitente_institucion = $this->request->getPost("remitente_institucion", "string");
                $documentos->destinatario_personal = $this->request->getPost("destinatario_personal", "string");
                $documentos->anio = date("Y");

                $documentos->expediente = $this->request->getPost("expediente", "string");

                $documentos->es_tramite = 1;


                if ($documentos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($documentos->getMessages());
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

    public function documentosdetalleAction($idDoc)
    {
        $this->view->iddoc = $idDoc;
        $this->assets->addJs("adminpanel/js/modulos/gestiontramitedocumentario.documentosdetalle.js?v" . uniqid());

        $proveidos = Proveido::find("estado = 'A' AND numero = 66");
        $this->view->proveidos = $proveidos;


        $db = $this->db;
        $sql_personal = "SELECT
        public.tbl_web_personal_areas.id_personal_area,
        CONCAT (public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal,
        public.tbl_web_areas.nombres AS area,
        public.tbl_web_personal_areas.cargo
        FROM
        public.tbl_web_personal
        INNER JOIN public.tbl_web_personal_areas ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
        INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_web_personal_areas.area
        WHERE public.tbl_web_personal_areas.estado = 'A' 
        ORDER BY public.tbl_web_personal.apellidop, public.tbl_web_personal.apellidom, public.tbl_web_personal.nombres";
        $personal = $db->fetchAll($sql_personal, Phalcon\Db::FETCH_OBJ);
        $this->view->personal = $personal;

    }

    public function datatableDocumentoDetalleAction($idDoc)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_doc_detalle");
            $datatable->setSelect("id_doc_detalle, id_doc, fecha, proveido, destinatario, estado");
            $datatable->setFrom("(SELECT 
            public.tbl_doc_documentos_detalles.id_doc_detalle, 
            public.tbl_doc_documentos_detalles.id_doc, 
            public.tbl_doc_documentos_detalles.fecha, 
            proveido.nombres AS proveido, 
            public.tbl_doc_documentos_detalles.estado, 
            CONCAT (public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS destinatario, 
            public.tbl_web_personal_areas.cargo, 
            public.tbl_web_areas.nombres AS area 
            FROM 
            public.tbl_doc_documentos_detalles 
            INNER JOIN public.tbl_web_personal_areas ON public.tbl_web_personal_areas.id_personal_area = public.tbl_doc_documentos_detalles.id_personal_area 
            INNER JOIN public.a_codigos AS proveido ON proveido.codigo = public.tbl_doc_documentos_detalles.id_proveido 
            INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal 
            INNER JOIN public.tbl_web_areas ON public.tbl_web_personal_areas.area = public.tbl_web_areas.codigo 
            WHERE 
            proveido.numero = 66 and tbl_doc_documentos_detalles.id_doc = $idDoc) AS temporal_table");
            $datatable->setOrderby("fecha DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function saveDocumentosDetallesAction()
    {

            //    echo "<pre>";
            //    print_r($_FILES);
            //    exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $id = (int) $this->request->getPost("id_doc_detalle", "int");
                $documentosDetalles = DocumentosDetalles::findFirstByid_doc_detalle($id);
                $documentosDetalles = (!$documentosDetalles) ? new DocumentosDetalles() : $documentosDetalles;

                $documentosDetalles->id_doc = $this->request->getPost("id_doc", "int");

                if ($this->request->getPost("fecha", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $hora = $hora = date("H:i:s");
                    $documentosDetalles->fecha = date("Y-m-d H:i:s", strtotime($fecha_new . " " . $hora));
                }

                if ($this->request->getPost("id_proveido", "int") == "") {
                    $documentosDetalles->id_proveido = null;
                } else {
                    $documentosDetalles->id_proveido = $this->request->getPost("id_proveido", "int");
                }

                $documentosDetalles->proveido_descripcion = $this->request->getPost("proveido_descripcion", "string");

                if ($this->request->getPost("id_personal_area", "int") == "") {
                    $documentosDetalles->id_personal_area = null;
                } else {
                    $documentosDetalles->id_personal_area = $this->request->getPost("id_personal_area", "int");
                }

                $documentosDetalles->link_drive = $this->request->getPost("link_drive", "string");
                $documentosDetalles->estado = 'A';

                if ($documentosDetalles->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($documentosDetalles->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen

                            $temporal_rand = mt_rand(100000, 999999);



                            //archivo
                            if ($file->getKey() == "archivo_documentosdetalle") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'pdf') {
                                    if (isset($documentosDetalles->archivo)) {
                                        $url_destino = 'adminpanel/archivos/tramite_documentario/externos/' . $documentosDetalles->archivo;

                                        if (file_exists($url_destino)) {
                                            unlink($url_destino);
                                        }


                                        $url_destino = 'adminpanel/archivos/tramite_documentario/externos/' . 'FILE' . '-' . $documentosDetalles->id_doc . '-' . $documentosDetalles->id_doc_detalle . '-' . $temporal_rand . '.pdf';
                                        $documentosDetalles->archivo = 'FILE'  . '-' . $documentosDetalles->id_doc . '-' . $documentosDetalles->id_doc_detalle . '-' . $temporal_rand . '.pdf';
                                    } else {
                                        $url_destino = 'adminpanel/archivos/tramite_documentario/externos/' . 'FILE' . '-' . $documentosDetalles->id_doc . '-'. $documentosDetalles->id_doc_detalle . '.pdf';
                                        $documentosDetalles->archivo = 'FILE' . '-' . $documentosDetalles->id_doc . '-' . $documentosDetalles->id_doc_detalle . '.pdf';
                                    }

                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $documentosDetalles->save();
                    }
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

    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $documentos = Documentos::findFirstByid_doc((int) $this->request->getPost("id", "int"));
            if ($documentos->fecha_cargo == null && $documentos->estado == 'A') {

                $documentos->estado = 'X';
                $documentos->save();
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
