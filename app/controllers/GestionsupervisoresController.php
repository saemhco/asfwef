<?php

class GestionsupervisoresController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function asistenciaAction()
    {
        //echo "<pre>"; print_r($_SESSION);exit();
        $id = $auth["id"];
        $supervisor = Supervisores::findFirstByid_supervisor($this->session->get("auth")["id"]);

         echo "<pre>"; print_r($supervisor->id_supervisor);exit();


        $this->view->supervisor = $supervisor;
        $admision_m = Admision::findFirst("activo = 'M'");
        $this->view->admision_m = $admision_m;



        $db = $this->db;
        $sql = "SELECT
        public.admision_postulantes.supervisor,
        public.publico.codigo,
        public.publico.nro_doc,
        CONCAT ( publico.apellidop, ' ', publico.apellidom, ' ', publico.nombres ) AS nombres_apellidos,
        public.admision_postulantes.grupo,
        public.admision_postulantes.admision,
        public.admision_postulantes.postulante,
        public.admision_postulantes.asistencia,
        public.admision_postulantes.observaciones_asistencia
        FROM
        public.admision_postulantes
        INNER JOIN public.publico ON public.publico.codigo = public.admision_postulantes.postulante
        WHERE
        public.admision_postulantes.proceso = 2 AND public.admision_postulantes.supervisor = $supervisor->id_supervisor AND public.admision_postulantes.admision = $admision_m->codigo
        ORDER BY public.admision_postulantes.grupo, publico.apellidop, publico.apellidom, publico.nombres";

        // print($sql);
        // exit();

        $data = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->data = $data;

        $prueba = count($data);
        // print($prueba);
        // exit();

        $this->view->total_postulantes = count($data);


        $this->assets->addJs("adminpanel/js/modulos/gestionsupervisores.asistencia.js?v=" . uniqid());
    }

    public function editarAsistenciaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $asistencia = (string) $this->request->getPost("asistencia", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->asistencia = $asistencia;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function editarObservacionAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $admision = (int) $this->request->getPost("admision", "int");
            $postulante = (int) $this->request->getPost("postulante", "int");
            $observacionesAsistencia = (string) $this->request->getPost("observaciones_asistencia", "string");

            $admisionPostulantesa = AdmisionPostulantesa::findFirst("admision = {$admision} AND postulante = {$postulante}");
            $admisionPostulantesa->observaciones_asistencia = $observacionesAsistencia;
            $admisionPostulantesa->save();

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));


            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }
}
