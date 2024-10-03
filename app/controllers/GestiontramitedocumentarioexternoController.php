<?php

class GestiontramitedocumentarioexternoController extends ControllerPanel
{

    public function initialize()
    {

        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/gestiontramitedocumentarioexterno.js?v=" . uniqid());
    }

    public function documentosenviadosAction()
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

        $tipoDocumentos = TipoDocumentos::find("estado = 'A' AND numero = 102");
        $this->view->tipodocumentos = $tipoDocumentos;

        $areas = Areas::find("estado = 'A'");
        $this->view->areas = $areas;

        $fecha_actual_envio = date('d/m/Y');
        $this->view->fecha_actual_envio = $fecha_actual_envio;

        $hora_actual_envio = date('h:i:s A');
        $this->view->hora_actual_envio = $hora_actual_envio;

        $fecha_cargo = date('d/m/Y');
        $this->view->fecha_actual_cargo = $fecha_cargo;

        $hora_actual_cargo = date('h:i:s A');
        $this->view->hora_actual_cargo = $hora_actual_cargo;

        $locales = Locales::find("estado = 'A'");
        $this->view->locales = $locales;

        $cargos = Cargos::find("estado = 'A' AND numero = 68");
        $this->view->cargos = $cargos;

        $personal = Personal::find(
            [
                "estado = 'A'",
                'order' => 'apellidop, apellidom, nombres',
            ]
        );
        $this->view->personal = $personal;

        $auth = $this->session->get('auth');
        $id_empresa_publico = $auth["codigo"];

        $empresaPublico = EmpresaPublico::findFirstByid_empresa_publico($id_empresa_publico);

        //print_r("testing:".$empresaPublico->id_publico);
        //exit();

        $db = $this->db;
        $sqlQuery = "SELECT public.publico.nro_doc as dni, public.publico.celular, public.publico.email,
        CONCAT ( public.publico.apellidop, ' ', public.publico.apellidom, ' ', public.publico.nombres ) AS apellidos_nombres
        FROM
        public.tbl_web_empresa_publico
        INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_empresa_publico.id_publico
        WHERE
        public.tbl_web_empresa_publico.id_publico = $empresaPublico->id_publico";

        $remitente = $db->fetchOne($sqlQuery, Phalcon\Db::FETCH_OBJ);
        $this->view->apellidos_nombres = $remitente->apellidos_nombres;

        $this->view->dni = $remitente->dni;
        $this->view->celular = $remitente->celular;
        $this->view->email = $remitente->email;

        $db = $this->db;
        $sqlQuery2 = "SELECT
        public.tbl_btr_empresas.razon_social
        FROM
        public.tbl_web_empresa_publico
        INNER JOIN public.tbl_btr_empresas ON public.tbl_btr_empresas.id_empresa = public.tbl_web_empresa_publico.id_empresa
        WHERE
        public.tbl_web_empresa_publico.id_publico = $empresaPublico->id_publico";
        $remitenteInstitucion = $db->fetchOne($sqlQuery2, Phalcon\Db::FETCH_OBJ);
        $this->view->institucion = $remitenteInstitucion->razon_social;

        $empresaPublico = EmpresaPublico::findFirstByid_empresa_publico($id_empresa_publico);
        $this->view->area = $empresaPublico->area;

        $empresaPublico = EmpresaPublico::findFirstByid_empresa_publico($id_empresa_publico);
        $this->view->cargo = $empresaPublico->cargo;

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

                $auth = $this->session->get('auth');
                $codigo = $auth["codigo"];
                if ($this->request->getPost("id_remitente", "int") != "") {
                    $documentos->id_remitente = $this->request->getPost("id_remitente", "int");
                }else{
                    $documentos->id_remitente = $codigo;
                    
                }
                if ($this->request->getPost("id_tipo_doc", "int") == "") {
                    $documentos->id_tipo_doc = null;
                } else {
                    $documentos->id_tipo_doc = $this->request->getPost("id_tipo_doc", "int");
                }

                $documentos->id_tipo_envio = 1;

                if ($this->request->getPost("id_area", "int") == "") {
                    $documentos->id_area = null;
                } else {
                    $documentos->id_area = $this->request->getPost("id_area", "int");
                }

                if ($this->request->getPost("id_personal", "int") == "") {
                    $documentos->id_personal = null;
                } else {
                    $documentos->id_personal = $this->request->getPost("id_personal", "int");
                }

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

                if ($this->request->getPost("id_cargo", "int") == "") {
                    $documentos->id_cargo = null;
                } else {
                    $documentos->id_cargo = $this->request->getPost("id_cargo", "int");
                }

                //$documentos->fecha = date("Y-m-d H:i:s");

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

                $documentos->nro_documento = $this->request->getPost("nro_documento", "string");
                $documentos->asunto = $this->request->getPost("asunto", "string");
                $documentos->nro_folios = $this->request->getPost("nro_folios", "int");
                $documentos->proceso = $this->request->getPost("id_proc", "string");
                $documentos->observaciones = $this->request->getPost("observaciones", "string");
                $documentos->estado = 'A';
                $documentos->proceso = 1;
                
                $documentos->remitente_nombres = $this->request->getPost("remitente_nombres", "string");
                $documentos->remitente_cargo = $this->request->getPost("remitente_cargo", "string");
                $documentos->remitente_area = $this->request->getPost("remitente_area", "string");
                $documentos->remitente_institucion = $this->request->getPost("remitente_institucion", "string");
                $documentos->destinatario_area = $this->request->getPost("destinatario_area", "string");
                $documentos->destinatario_personal = $this->request->getPost("destinatario_personal", "string");
                $documentos->anio = date("Y");
                $documentos->es_tramite = 1;

                if ($documentos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($documentos->getMessages());
                } else {

                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //imagen
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo
                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('pdf', 'PDF');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($documentos->archivo)) {
                                            $url_destino = 'adminpanel/archivos/tramite_documentario/externos/' . $documentos->archivo;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/tramite_documentario/externos/' . 'FILE' . '-' . $documentos->id_doc . '-' . $temporal_rand . "." . $extension;
                                            $documentos->archivo = 'FILE' . '-' . $documentos->id_doc . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/tramite_documentario/externos/' . 'FILE' . '-' . $documentos->id_doc . "." . $extension;
                                            $documentos->archivo = 'FILE' . '-' . $documentos->id_doc . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    }
                                }
                            }
                        }

                        $documentos->save();
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

    public function datatableAction()
    {
       
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $id_usuario = $auth["codigo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("id_doc");
            $datatable->setSelect("id_doc,fecha_envio, fecha_cargo,tipo_documento,nro_documento,remitente_nombres,personal_nombre,destinatario_personal,area,estado,tipo_proceso,archivo,observaciones");
            $datatable->setFrom("(
            SELECT
            public.tbl_doc_documentos.id_doc,
            to_char( PUBLIC.tbl_doc_documentos.fecha_envio, 'DD/MM/YYYY' ) AS fecha_envio,
            to_char( PUBLIC.tbl_doc_documentos.fecha_cargo, 'DD/MM/YYYY' ) AS fecha_cargo,
            TipoDocumento.nombres AS tipo_documento,
            public.tbl_doc_documentos.nro_documento,
            public.tbl_doc_documentos.remitente_nombres,
            public.tbl_doc_documentos.estado,
            public.tbl_doc_documentos.destinatario_personal,
             CONCAT ( public.tbl_web_personal.apellidop, ' ', public.tbl_web_personal.apellidom, ' ', public.tbl_web_personal.nombres ) AS personal_nombre,
            public.tbl_web_areas.nombres AS area,
            public.tbl_doc_documentos.archivo,
            TipoProceso.nombres AS tipo_proceso,
            public.tbl_doc_documentos.observaciones
            FROM
            public.tbl_doc_documentos
            INNER JOIN public.a_codigos as TipoDocumento ON TipoDocumento.codigo = public.tbl_doc_documentos.id_tipo_doc
            INNER JOIN public.a_codigos as TipoProceso ON TipoProceso.codigo = public.tbl_doc_documentos.proceso
            LEFT JOIN public.tbl_web_personal_areas ON public.tbl_doc_documentos.id_personal_area = public.tbl_web_personal_areas.id_personal_area
            LEFT JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_web_personal_areas.personal
            LEFT JOIN public.tbl_web_areas ON public.tbl_web_personal_areas.area = public.tbl_web_areas.codigo
            WHERE
            TipoDocumento.numero = 102 AND TipoProceso.numero = 145 AND
            public.tbl_doc_documentos.id_remitente = $id_usuario order by public.tbl_doc_documentos.id_doc desc) AS temporal_table");
            $datatable->setParams($_POST);
            $datatable->getJson();

            //id_remitente

        }
    }

    public function eliminarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            // echo"<pre>";
            // print_r($_POST);
            // exit();
            $documentos = Documentos::findFirstByid_doc((int) $this->request->getPost("id", "int"));
            if ($documentos->fecha_cargo != null && $documentos->estado == 'A') {
                //print("fecha cargo es null");
                //exit();
                $documentos->estado = 'X';
                $documentos->save();
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } else {
                //print("fecha cargo no es null");
                //exit();
                $this->response->setContent('No existe registro');
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "no"));
            }
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function agregarAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {


                $documentos = Documentos::findFirstByid_doc($id);
                $documentos = (!$documentos) ? new Documentos() : $documentos;

                $auth = $this->session->get('auth');
                $codigo = $auth["codigo"];
                $documentos->id_remitente = $codigo;
                $documentos->id_tipo_envio = 1;
                $documentos->anio = date("Y");
                $documentos->proceso = 0;
                $documentos->estado = "X";


                if ($documentos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($documentos->getMessages());
                } else {
                    //Cuando va bien 
                    $id_doc = $documentos->id_doc;
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes", "id_doc" => $id_doc));
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
