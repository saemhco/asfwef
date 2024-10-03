<?php

class RegistropagosController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function concursodocentesAction()
    {


        $convocatorias = Convocatorias::find("estado = 'A'");
        $this->view->convocatorias = $convocatorias;


        $convocatoria_m = Convocatorias::findFirst("estado = 'A' AND activo = 'M'");
        // print($convocatoria_m->id_convocatoria);
        // exit();
        $this->view->convocatoria_m = $convocatoria_m->id_convocatoria;


        $this->assets->addJs("adminpanel/js/modulos/registropagos.concursodocentes.js?v=" . uniqid());

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

    public function datatablePostulantesAction($id_convocatoria, $id_proceso)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {

            // print("id_convocatoria: " . $id_convocatoria . " " . "id_proceso: " . $id_proceso);
            // exit();

            if ($id_proceso == "") {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("publico");
                $datatable->setSelect("publico, convocatoria, nro_doc, nombres_apellidos, proceso, fecha_recibo, nro_recibo, monto_recibo, celular, email, archivo_recibo, foto");
                $datatable->setFrom("(SELECT
                public.tbl_web_convocatorias_publico.publico,
                public.tbl_web_convocatorias_publico.convocatoria,
                CONCAT ( public.publico.apellidop, ' ', public.publico.apellidom, ' ', public.publico.nombres ) AS nombres_apellidos,
                public.publico.nro_doc,
                public.publico.celular,
                public.publico.email,
                procesos.nombres AS proceso,
                to_char(tbl_web_convocatorias_publico.fecha_recibo, 'DD/MM/YYYY') AS fecha_recibo,
                public.tbl_web_convocatorias_publico.nro_recibo,
                public.tbl_web_convocatorias_publico.monto_recibo,
                public.tbl_web_convocatorias_publico.archivo_recibo,
                public.publico.foto
                FROM
                public.tbl_web_convocatorias_publico
                INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_convocatorias_publico.publico
                INNER JOIN public.a_codigos AS procesos ON procesos.codigo = public.tbl_web_convocatorias_publico.proceso_recibo
                WHERE
                procesos.numero = 106 AND
                public.tbl_web_convocatorias_publico.convocatoria = $id_convocatoria) AS temporal_table");
                $datatable->setOrderby("fecha_recibo DESC");
                $datatable->setParams($_POST);
                $datatable->getJson();
            } else {
                $datatable = new Datatables($this->di);
                $datatable->setColumnaId("publico");
                $datatable->setSelect("publico, convocatoria, nro_doc, nombres_apellidos, proceso, fecha_recibo, nro_recibo, monto_recibo, celular, email, archivo_recibo, foto");
                $datatable->setFrom("(SELECT
                public.tbl_web_convocatorias_publico.publico,
                public.tbl_web_convocatorias_publico.convocatoria,
                CONCAT ( public.publico.apellidop, ' ', public.publico.apellidom, ' ', public.publico.nombres ) AS nombres_apellidos,
                public.publico.nro_doc,
                public.publico.celular,
                public.publico.email,
                procesos.nombres AS proceso,
                to_char(tbl_web_convocatorias_publico.fecha_recibo, 'DD/MM/YYYY') AS fecha_recibo,
                public.tbl_web_convocatorias_publico.nro_recibo,
                public.tbl_web_convocatorias_publico.monto_recibo,
                public.tbl_web_convocatorias_publico.archivo_recibo,
                public.publico.foto
                FROM
                public.tbl_web_convocatorias_publico
                INNER JOIN public.publico ON public.publico.codigo = public.tbl_web_convocatorias_publico.publico
                INNER JOIN public.a_codigos AS procesos ON procesos.codigo = public.tbl_web_convocatorias_publico.proceso_recibo
                WHERE
                procesos.numero = 106 AND
                public.tbl_web_convocatorias_publico.convocatoria = $id_convocatoria AND public.tbl_web_convocatorias_publico.proceso_recibo = $id_proceso) AS temporal_table");
                $datatable->setOrderby("fecha_recibo DESC");
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
            $admisionPostulantesa = ConvocatoriasPublicoRecibo::findFirst("convocatoria = {$admision} AND publico = {$postulante}");
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

            // echo"<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");




            $admisionPostulantesa = ConvocatoriasPublicoRecibo::findFirst("convocatoria = {$admision} AND publico = {$postulante}");
            $admisionPostulantesa->proceso_recibo = (int) $this->request->getPost("proceso", "int");
            $admisionPostulantesa->observaciones_recibo = (string) $this->request->getPost("observaciones", "string");
            $admisionPostulantesa->save();

            $publico = Publico::findFirst("codigo = {$postulante}");
            $emailPublico = $publico->email;

            $convocatoria = Convocatorias::findFirst("id_convocatoria = {$admision}");



            $procesosPostulante = ProcesosPostulantes::findFirst("estado = 'A' AND numero = 106  AND codigo = $admisionPostulantesa->proceso_recibo ORDER BY codigo ASC");


            // print($procesosPostulante->nombres);
            // exit();

            $text_body = "" . '<br>';
            if ($procesosPostulante->nombres == "Verificado") {

                $text_body .= "Estimado(a): " . $publico->apellidop . " " . $publico->apellidom . " " . $publico->nombres . "<br>";
                $text_body .= "Su pago por derecho de inscripción fue validado correctamente por lo su INSCRIPICIÓN ES ACEPTADA. Puede continuar con la postulación al concurso." . '<br>';
                $text_body .= "Puede acceder a la descarga del reglamento, bases y anexos del concurso." . '<br>';
                $text_body .= "https://www.unca.edu.pe/login-convocatorias-docentes.html" . '<br>';

            } else if ($procesosPostulante->nombres == "Observado") {

                $text_body .= "Estimado(a): " . $publico->apellidop . " " . $publico->apellidom . " " . $publico->nombres . "<br>";
                $text_body .= "Su pago por derecho de inscripción está Observado."."<br>";
                $text_body .= "Verifique en la Plataforma" . '<br>';
                $text_body .= "https://www.unca.edu.pe/login-convocatorias-docentes.html" . '<br>';
            }
            $text_body .= "Este correo es automático, por favor no responder." . '<br>';


            // print($text_body);
            // exit();

            $from = $this->config->mail->from;
            $xAbrevIns = $this->config->mail->xAbrevIns; 

            $mailer = new mailer($this->di);
            $mailer->setSubject($xAbrevIns." - ESTADO DE INSCRIPCIÓN DE PAGO $convocatoria->titulo");
            $mailer->setFrom($from);
            $mailer->setTo($emailPublico, $from);
            $mailer->setBody($text_body);
            //
            if ($mailer->send()) {
                //return true;
            } else {
                echo $mailer->getError();
                echo "error";
            }

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

        $this->assets->addJs("adminpanel/js/modulos/registropagos.postulantesaptos.js?v=" . uniqid());
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

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->puntaje = $puntaje;
            $admisionPostulantesa->save();

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


        $this->assets->addJs("adminpanel/js/modulos/registropagos.postulantespagos.js?v=" . uniqid());
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

    public function matriculaAction()
    {
        $this->assets->addJs("adminpanel/js/modulos/registropagos.matricula.js?v=" . uniqid() . "");
    }

    public function datatablematriculaAction()
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

    public function pagarMatriculaAction()
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
