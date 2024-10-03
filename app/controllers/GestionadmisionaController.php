<?php

class GestionadmisionController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function postulantesAction()
    {

        $admision = Admision::find("estado = 'A'");
        $this->view->admision = $admision;


        $admision_m = Admision::findFirst("estado = 'A' AND activo = 'M'");
        $this->view->admision_m = $admision_m->codigo;


        $this->assets->addJs("adminpanel/js/modulos/gestionadmision.postulantes.js?v=" . uniqid());

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;

        $procesos = Procesos::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesos = $procesos;
    }

    public function datatablePostulantesAction($id_admision_enae, $id_proceso)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            // print("id_admision_enae: " . $id_admision_enae . " " . "id_proceso: " . $id_proceso);
            // exit();

            if ($id_proceso == "") {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("postulante");
                $datatable->setSelect("postulante, admision, nro_doc, nombres_apellidos, colegio_publico, colegio_nombre, recibo, postulante, postulante, escuela, universidad, monto, imagen, proceso, observaciones, foto, archivo, archivo_escuela, proceso_nombre,fecha_inscripcion, categoria_nombres, puntaje,monto_conv, celular, email");
                $datatable->setFrom("(SELECT ADMIN
                .postulante,
                ADMIN.admision,
                ADMIN.modalidad,
                to_char(ADMIN.fecha_inscripcion, 'DD/MM/YYYY') AS fecha_inscripcion,
                ADMIN.tipo_inscripcion,
                ADMIN.recibo,
                ADMIN.concepto,
                ADMIN.fecha_registro,
                ADMIN.fecha_modificacion,
                ADMIN.monto,
                ADMIN.estado,
                ADMIN.puesto,
                ADMIN.puntaje,
                ADMIN.modalidad_ingreso,
                ADMIN.carrera1,
                ADMIN.carrera2,
                ADMIN.imagen,
                ADMIN.proceso,
                ADMIN.observaciones,
                ADMIN.monto_conv,
                CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS nombres_apellidos,
                P.colegio_publico,
                P.colegio_nombre,
                P.escuela,
                P.institucion,
                P.nro_doc,
                P.foto,
                P.archivo,
                P.archivo_escuela,
                P.celular,
                P.email,
                universidades.universidad,
                proceso.nombres AS proceso_nombre,
                categorias.nombres AS categoria_nombres
                FROM
                admision_postulantes
                ADMIN INNER JOIN publico P ON ADMIN.postulante = P.codigo
                INNER JOIN public.a_codigos AS proceso ON proceso.codigo = ADMIN.proceso
                INNER JOIN public.a_codigos AS categorias ON categorias.codigo = P.categoria
                INNER JOIN public.tbl_web_universidades AS universidades ON universidades.id_universidad = P.id_universidad
                WHERE
                proceso.numero = 106 AND categorias.numero = 104 AND ADMIN.admision = $id_admision_enae) AS temporal_table");
                $datatable->setOrderby("fecha_inscripcion DESC");
                $datatable->setParams($_POST);
                $datatable->getJson();
            } else {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("postulante");
                $datatable->setSelect("postulante, admision, nro_doc, nombres_apellidos, colegio_publico, colegio_nombre, recibo, postulante, postulante, escuela, universidad, monto, imagen, proceso, observaciones, foto, archivo, archivo_escuela, proceso_nombre,fecha_inscripcion, categoria_nombres, puntaje,monto_conv");
                $datatable->setFrom("(SELECT ADMIN
                .postulante,
                ADMIN.admision,
                ADMIN.modalidad,
                to_char(ADMIN.fecha_inscripcion, 'DD/MM/YYYY') AS fecha_inscripcion,
                ADMIN.tipo_inscripcion,
                ADMIN.recibo,
                ADMIN.concepto,
                ADMIN.fecha_registro,
                ADMIN.fecha_modificacion,
                ADMIN.monto,
                ADMIN.estado,
                ADMIN.puesto,
                ADMIN.puntaje,
                ADMIN.modalidad_ingreso,
                ADMIN.carrera1,
                ADMIN.carrera2,
                ADMIN.imagen,
                ADMIN.proceso,
                ADMIN.observaciones,
                ADMIN.monto_conv,
                CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS nombres_apellidos,
                P.colegio_publico,
                P.colegio_nombre,
                P.escuela,
                P.institucion,
                P.nro_doc,
                P.foto,
                P.archivo,
                P.archivo_escuela,
                universidades.universidad,
                proceso.nombres AS proceso_nombre,
                categorias.nombres AS categoria_nombres
                FROM
                admision_postulantes
                ADMIN INNER JOIN publico P ON ADMIN.postulante = P.codigo
                INNER JOIN public.a_codigos AS proceso ON proceso.codigo = ADMIN.proceso
                INNER JOIN public.a_codigos AS categorias ON categorias.codigo = P.categoria
                INNER JOIN public.tbl_web_universidades AS universidades ON universidades.id_universidad = P.id_universidad
                WHERE
                proceso.numero = 106 AND categorias.numero = 104 AND ADMIN.admision = $id_admision_enae AND ADMIN.proceso = $id_proceso) AS temporal_table");
                $datatable->setOrderby("fecha_inscripcion DESC");
                $datatable->setParams($_POST);
                $datatable->getJson();
            }
        }
    }


    public function getAdmisionPostulantesaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            if ($admisionPostulantesa) {
                $this->response->setJsonContent($admisionPostulantesa->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function saveProcesosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->proceso = (int) $this->request->getPost("proceso", "int");
            $admisionPostulantesa->observaciones = (string) $this->request->getPost("observaciones", "string");
            $admisionPostulantesa->save();

            $publico = Publico::findFirst("codigo = {$postulante}");

            // print($publico->email);
            // exit();

            $emailPublico = $publico->email;

            $admision = Admision::findFirst("codigo = {$admision}");

            $procesosPostulante = ProcesosPostulantes::findFirst("estado = 'A' AND numero = 106  AND codigo = $admisionPostulantesa->proceso ORDER BY codigo ASC");



            //send email
            $text_body = "" . '<br>';
            $text_body .= "ESTIMADO " . $publico->apellidop . " " . $publico->apellidom . " " . $publico->nombres . '<br>';
            $text_body .= "SU ESTADO DE INSCRIPCION " . strtoupper($admision->descripcion) . " ESTA " . strtoupper($procesosPostulante->nombres) . '<br>';

            if ($procesosPostulante->nombres == "Verificado") {

                $text_body .= "FELICITACIONES UD ESTA APTO (A)" . '<br>';
            } else if ($procesosPostulante->nombres == "Observado") {

                $text_body .= "VERIFIQUE EN LA PLATAFORMA" . '<br>';
            }


            $text_body .= "NO RESPONDER ESTE CORREO..." . '<br>';


            // print($text_body);
            // exit();

            $from = $this->config->mail->from;
            $mailer = new mailer($this->di);
            $mailer->setSubject("ESTADO DE INSCRIPCIÓN " . strtoupper($admision->descripcion));
            $mailer->setFrom($from);
            $mailer->setTo($emailPublico, $from);
            $mailer->setBody($text_body);
            //
            if ($mailer->send()) {
                //return true;
                // print("Enviado sin error");
                // exit();
            } else {
                echo $mailer->getError();
                echo "error";
            }
            //fin send email



            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function postulantesaptosAction()
    {
        $admision = Admision::find("estado = 'A'");
        $this->view->admision = $admision;

        $admision_m = Admision::findFirst("estado = 'A' AND activo = 'M'");
        $this->view->admision_m = $admision_m->codigo;

        $this->assets->addJs("adminpanel/js/modulos/gestionadmision.postulantesaptos.js?v=" . uniqid());
    }

    public function datatablePostulantespagosAction($id_admision_enae)
    {
        // print($id_admision_enae);
        // exit();
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("postulante");
            $datatable->setSelect("codigo, apellidop, apellidom, nombres, postulante, admision, nro_doc, nombres_apellidos, colegio_publico, colegio_nombre, recibo, postulante, postulante, escuela, institucion, monto, imagen, proceso, observaciones, foto, archivo, archivo_escuela, proceso_nombre,fecha_inscripcion, categoria_nombres, supervisor, grupo, puntaje, asistencia, observaciones_asistencia, estado, monto_conv,observaciones_pago, celular, email");
            $datatable->setFrom("(SELECT ADMIN
            .postulante,
            ADMIN.admision,
            ADMIN.modalidad,
            to_char(ADMIN.fecha_inscripcion, 'DD/MM/YYYY') AS fecha_inscripcion,
            ADMIN.tipo_inscripcion,
            ADMIN.recibo,
            ADMIN.concepto,
            ADMIN.fecha_registro,
            ADMIN.fecha_modificacion,
            ADMIN.monto,
            ADMIN.estado,
            ADMIN.puesto,
            ADMIN.puntaje,
            ADMIN.modalidad_ingreso,
            ADMIN.carrera1,
            ADMIN.carrera2,
            ADMIN.imagen,
            ADMIN.proceso,
            ADMIN.observaciones,
            ADMIN.supervisor,
            ADMIN.grupo,
            ADMIN.asistencia,
            ADMIN.observaciones_asistencia,
            ADMIN.monto_conv,
            ADMIN.observaciones_pago,
            P.apellidop,
            P.apellidom,
            P.nombres,
            CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS nombres_apellidos,
            P.codigo,
            P.colegio_publico,
            P.colegio_nombre,
            P.escuela,
            P.institucion,
            P.nro_doc,
            P.foto,
            P.archivo,
            P.archivo_escuela,
            P.celular,
            P.email,
            proceso.nombres AS proceso_nombre,
            categorias.nombres AS categoria_nombres
            FROM
            admision_postulantes
            ADMIN INNER JOIN publico P ON ADMIN.postulante = P.codigo
            INNER JOIN public.a_codigos AS proceso ON proceso.codigo = ADMIN.proceso
            INNER JOIN public.a_codigos AS categorias ON categorias.codigo = P.categoria
            WHERE
            proceso.numero = 106 AND categorias.numero = 104 AND ADMIN.proceso = 2 AND ADMIN.admision = $id_admision_enae) AS temporal_table");
            $datatable->setOrderby("apellidop ASC, apellidom ASC, nombres ASC");
            //$datatable->setOrderby("puntaje DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function datatablePostulantesaptosAction($id_admision_enae)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("postulante");
            $datatable->setSelect("codigo, apellidop, apellidom, nombres, postulante, admision, nro_doc, nombres_apellidos, colegio_publico, colegio_nombre, recibo, postulante, postulante, escuela, institucion, monto, imagen, proceso, observaciones, foto, archivo, archivo_escuela, proceso_nombre,fecha_inscripcion, categoria_nombres, supervisor, grupo, puntaje, asistencia, observaciones_asistencia, estado, monto_conv,observaciones_pago");
            $datatable->setFrom("(SELECT ADMIN
            .postulante,
            ADMIN.admision,
            ADMIN.modalidad,
            to_char(ADMIN.fecha_inscripcion, 'DD/MM/YYYY') AS fecha_inscripcion,
            ADMIN.tipo_inscripcion,
            ADMIN.recibo,
            ADMIN.concepto,
            ADMIN.fecha_registro,
            ADMIN.fecha_modificacion,
            ADMIN.monto,
            ADMIN.estado,
            ADMIN.puesto,
            ADMIN.modalidad_ingreso,
            ADMIN.carrera1,
            ADMIN.carrera2,
            ADMIN.imagen,
            ADMIN.proceso,
            ADMIN.observaciones,
            ADMIN.supervisor,
            ADMIN.grupo,
            ADMIN.asistencia,
            ADMIN.observaciones_asistencia,
            ADMIN.monto_conv,
            ADMIN.observaciones_pago,
            P.apellidop,
            P.apellidom,
            P.nombres,
            CONCAT ( P.apellidop, ' ', P.apellidom, ' ', P.nombres ) AS nombres_apellidos,
            P.codigo,
            P.colegio_publico,
            P.colegio_nombre,
            P.escuela,
            P.institucion,
            P.nro_doc,
            P.foto,
            P.archivo,
            P.archivo_escuela,
            proceso.nombres AS proceso_nombre,
            categorias.nombres AS categoria_nombres,
            calif.puntaje
            FROM
            admision_postulantes
            ADMIN INNER JOIN publico P ON ADMIN.postulante = P.codigo
            INNER JOIN public.a_codigos AS proceso ON proceso.codigo = ADMIN.proceso
            INNER JOIN public.a_codigos AS categorias ON categorias.codigo = P.categoria
            INNER JOIN public.calificaciones AS calif ON calif.nro_doc = P.nro_doc
            WHERE
            proceso.numero = 106 AND categorias.numero = 104 AND ADMIN.proceso = 2 AND ADMIN.admision = $id_admision_enae) AS temporal_table");
            $datatable->setOrderby("apellidop ASC, apellidom ASC, nombres ASC");
            //$datatable->setOrderby("puntaje DESC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function editarSupervisorAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $supervisor = (string) $this->request->getPost("supervisor", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->supervisor = $supervisor;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function editarGrupoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $grupo = (string) $this->request->getPost("grupo", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->grupo = $grupo;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function editarPuntajeAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $puntaje = (string) $this->request->getPost("puntaje", "string");

            $db = $this->db;
            $sql_query = "SELECT
            public.calificaciones.puntaje,
            public.publico.nro_doc,
            public.admision_postulantes.admision
            FROM
            public.admision_postulantes
            INNER JOIN public.publico ON public.publico.codigo = public.admision_postulantes.postulante 
            INNER JOIN public.calificaciones ON public.calificaciones.nro_doc = public.publico.nro_doc
            WHERE
            public.admision_postulantes.admision = $admision AND public.calificaciones.admision = $admision AND public.admision_postulantes.proceso = 2  AND public.admision_postulantes.postulante = $postulante";
            $sql_query_r1= $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

            // print($sql_query_r1->nro_doc);
            // print($sql_query_r1->admision);
            // exit();

            $db2 = $this->db;
            $sql_query2 = " UPDATE public.calificaciones SET puntaje = $puntaje WHERE nro_doc = '{$sql_query_r1->nro_doc}' AND admision = $sql_query_r1->admision";
            $db2->fetchOne($sql_query2, Phalcon\Db::FETCH_OBJ);


            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function getAjaxObservacionesAsistenciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            if ($admisionPostulantesa) {
                $this->response->setJsonContent($admisionPostulantesa->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function postulantespagosAction()
    {

        $admision = Admision::find("estado = 'A'");
        $this->view->admision = $admision;

        $admision_m = Admision::findFirst("estado = 'A' AND activo = 'M'");
        $this->view->admision_m = $admision_m->codigo;


        $this->assets->addJs("adminpanel/js/modulos/gestionadmision.postulantespagos.js?v=" . uniqid());
    }

    public function editarMontoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $monto = (string) $this->request->getPost("monto", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->monto = $monto;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function editarMontoconvAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $monto_conv = (string) $this->request->getPost("monto_conv", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->monto_conv = $monto_conv;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function editarOPAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $observaciones_pago = (string) $this->request->getPost("observaciones_pago", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->observaciones_pago = $observaciones_pago;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }
}
