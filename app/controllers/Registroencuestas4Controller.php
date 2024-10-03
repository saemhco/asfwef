<?php
class Registroencuestas4Controller extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroencuestas4.js?v=" . uniqid());
    }




    //Funcion para agregar encuesta y editar
    public function registroAction($id = null)
    {

        $auth = $this->session->get('auth');
        $id_alumno = $auth["codigo"];

        $semestre_a = Semestres::findFirst(
            [
                "activo = 'M'  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        //$verifica = EncuestasAlumnos::find("id_semestre = $semestre_a->codigo AND id_alumno = '$id_alumno'");

        $db = $this->db;
        $sql = "SELECT
        public.tbl_enc_encuestas.id_encuesta,
        public.tbl_enc_encuestas.id_tipo_encuesta,
        public.tbl_enc_encuestas_alumnos.id_semestre,
        public.tbl_enc_encuestas_alumnos.id_alumno
        FROM
        public.tbl_enc_encuestas
        INNER JOIN public.tbl_enc_encuestas_alumnos ON public.tbl_enc_encuestas.id_encuesta = public.tbl_enc_encuestas_alumnos.id_encuesta
        WHERE
        public.tbl_enc_encuestas.id_encuesta = 4 AND public.tbl_enc_encuestas_alumnos.id_alumno = '$id_alumno' AND public.tbl_enc_encuestas_alumnos.id_semestre = $semestre_a->codigo";

        // print($sql);
        // exit();

        $verifica = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);

        //    echo '<pre>';
        //    print(count($verifica));
        //    exit();

        if (count($verifica) > 0) {
            return $this->response->redirect("registroencuestas4/fin");
        }




        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->semestres = $semestres;

        //Modelo encuestas
        $encuesta = Encuestas::findFirst("estado = 'A' AND id_tipo_encuesta = '3' AND id_encuesta = 4");
        // print($encuesta->descripcion);
        // exit();
        $this->view->encuesta = $encuesta;

        // $tipo_de_pregunta = TipoPreguntas::find("estado = 'A' AND numero = 36 AND codigo <> 6");
        // $this->view->tipo_preguntas = $tipo_de_pregunta;

        //Pregunta
        $tipo_de_pregunta = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('TipoPreguntas.codigo,
                        TipoPreguntas.nombres')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_encuesta = 4 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->orderBy('TipoPreguntas.codigo ASC')
            ->getQuery()
            ->execute();

        // foreach ($tipo_de_pregunta as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->codigo . $value->nombres);
        // }
        // exit();


        $this->view->tipo_preguntas = $tipo_de_pregunta;



        //Pregunta
        $encuestas_model = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    TipoPreguntas.codigo,
                    TipoPreguntas.nombres,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_encuesta = 4 AND TipoPreguntas.numero = 36")
            ->groupBy('Encuestas.id_tipo_encuesta, EncuestasPreguntas.descripcion, TipoPreguntas.codigo,TipoPreguntas.nombres, EncuestasPreguntas.id_encuesta_pregunta')
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();


        // foreach ($encuestas_model as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->descripcion);
        // }
        // exit();




        $this->view->preguntas = $encuestas_model;






        $db = $this->db;
        $sql = "SELECT
        public.alumnos.codigo,
        public.alumnos_semestre.ciclo,
        public.carreras.descripcion AS carrera
        FROM
        public.alumnos
        INNER JOIN public.alumnos_semestre ON public.alumnos.codigo = public.alumnos_semestre.alumno AND public.alumnos.semestre = public.alumnos_semestre.semestre
        INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
        public.alumnos.codigo = '$id_alumno'";

        // print($sql);
        // exit();

        $datos = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->datos = $datos;



        $respuestas = EncuestasPreguntasRespuestas::find("estado = 'A' ORDER BY puntaje ASC");
        // foreach ($respuestas as $test) {
        //     echo "<pre>";
        //     print_r($test->descripcion);
        // }
        // exit();
        $this->view->respuestas = $respuestas;

        $encuestasRespuestasT = EncuestasRespuestasT::find("estado = 'A' AND id_encuesta = 4 ORDER BY orden ASC");
        $this->view->encuestasRespuestasT = $encuestasRespuestasT;
    }

    //Busca Asignaturas
    public function getAsignaturasAction()
    {

        $auth = $this->session->get('auth');
        $codigo_alumno = $auth["codigo"];

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $semestre_id = $this->request->getPost("pk");

            //Native query
            //$Distritos = Provincias::find('region="' . $region_id . '"');

            $asignaturas_query = $this->modelsManager->createQuery("SELECT DISTINCT
            Asignaturas.codigo,
            Asignaturas.nombre,
            Asignaturas.ciclo,
            AlumnosAsignaturas.semestre,
            AlumnosAsignaturas.alumno,
            Docentes.apellidop,
            Docentes.apellidom,
            Docentes.nombres,
            Carreras.descripcion AS carrera
            FROM
            AlumnosAsignaturas
            INNER JOIN Asignaturas ON Asignaturas.codigo = AlumnosAsignaturas.asignatura
            INNER JOIN DocentesAsignaturas ON DocentesAsignaturas.asignatura = Asignaturas.codigo
            INNER JOIN Docentes ON DocentesAsignaturas.docente = Docentes.codigo
            INNER JOIN Alumnos ON Alumnos.codigo = AlumnosAsignaturas.alumno
            INNER JOIN Carreras ON Alumnos.carrera = Carreras.codigo
            WHERE
            AlumnosAsignaturas.alumno = '$codigo_alumno'
            AND AlumnosAsignaturas.semestre = $semestre_id
            AND Docentes.codigo <> 0");

            //echo"<pre>";print_r($asignaturas_query);exit();

            $asignaturas = $asignaturas_query->execute();

            //foreach ($asignaturas as $test) {
            //echo "<pre>";
            //print_r($test->nombre);
            //}
            //exit();

            $this->response->setJsonContent($asignaturas->toArray());
            $this->response->send();
        }
    }

    //Funcion para guardar encuesta
    public function saveAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //Funcion insertar
                $encuestasAlumnos = new EncuestasAlumnos();
                $encuestasAlumnos->id_encuesta = $this->request->getPost("id_encuesta", "int");

                //Semestre matriculado
                $Semestres = Semestres::findFirst("activo = 'M'");
                $semestre_m = $Semestres->codigo;
                $encuestasAlumnos->id_semestre = $semestre_m;
                $encuestasAlumnos->id_alumno = $this->session->get("auth")["codigo"];
                $encuestasAlumnos->id_asignatura = 0;
                $encuestasAlumnos->id_grupo = 0;

                $encuestasAlumnos->fecha = date('Y-m-d');
                $encuestasAlumnos->estado = 'A';

                $encuestasAlumnos->recomendacion = $this->request->getPost("recomendacion", "string");

                if ($encuestasAlumnos->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($encuestasAlumnos->getMessages());
                } else {

                    // echo "<pre>";
                    // print_r($encuestasAlumnos->id_encuesta_alumno);
                    // exit();

                    //$respuestasAlumnos->pregunta = $this->request->getPost("radio", "string");
                    $encuestas_model = $this->modelsManager->createBuilder()
                        ->from('Encuestas')
                        ->columns('Encuestas.id_tipo_encuesta,
                    Encuestas.descripcion,
                    TipoPreguntas.codigo,
                    TipoPreguntas.descripcion AS tipo_pregunta,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion AS pregunta')
                        ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
                        ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
                        ->where("Encuestas.id_encuesta = 4 AND TipoPreguntas.numero = 36 ")
                        ->getQuery()
                        ->execute();

                    foreach ($encuestas_model as $key => $value) {

                        //print $encuestasAlumnos->id_encuesta_alumno;

                        $respuestasAlumnos = new RespuestasAlumnos();
                        $respuestasAlumnos->id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno;
                        $respuestasAlumnos->valor = (int) $_POST["radio" . $value->id_encuesta_pregunta];
                        $respuestasAlumnos->id_encuesta_pregunta = $value->id_encuesta_pregunta;
                        $respuestasAlumnos->save();
                    }

                    //exit();

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

    //Funcion para validar encuesta ya registrada
    public function encuestaRegistradaAction()
    {
        //print_r("Entro Aqui");exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $codigo_encuesta = (int) $this->request->getPost("codigo_encuesta", "int");
            $codigo_semestre = (int) $this->request->getPost("codigo_semestre", "int");
            $codigo_alumno = (string) $this->request->getPost("codigo_alumno", "string");
            $codigo_asignatura = (string) $this->request->getPost("codigo_asignatura", "string");
            $codigo_grupo = (int) $this->request->getPost("codigo_grupo", "int");

            // print("encuesta:" . $codigo_encuesta . " - semestre:" . $codigo_semestre . " - alumno:" . $codigo_alumno . " - asignatura:" . $codigo_asignatura . " - grupo:" . $codigo_grupo);
            // exit();

            $model = EncuestasAlumnos::findFirst("id_encuesta = {$codigo_encuesta} AND id_semestre = {$codigo_semestre} AND id_alumno = '{$codigo_alumno}' AND id_asignatura = '{$codigo_asignatura}' AND id_grupo = {$codigo_grupo}");

            //echo '<pre>';
            //print_r($AlumnosEncuestas->asignatura);
            //exit();
            //$Asistencias = Asistencias::findFirstBycodigo((string) $this->request->getPost("id", "string"));
            if ($model) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function finAction()
    {

        $auth = $this->session->get('auth');
        $id_alumno = $auth["codigo"];

        $db = $this->db;
        $sql = "SELECT
        public.alumnos.codigo,
        public.alumnos_semestre.ciclo,
        public.carreras.descripcion AS carrera
        FROM
        public.alumnos
        INNER JOIN public.alumnos_semestre ON public.alumnos.codigo = public.alumnos_semestre.alumno AND public.alumnos.semestre = public.alumnos_semestre.semestre
        INNER JOIN public.carreras ON public.alumnos.carrera = public.carreras.codigo
        WHERE
        public.alumnos.codigo = '$id_alumno'";
        $datos = $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
        $this->view->datos = $datos;

        $encuesta = Encuestas::findFirst("estado = 'A' AND id_tipo_encuesta = '3' AND id_encuesta = 4");
        $this->view->encuesta = $encuesta;

        $tipo_de_pregunta = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('TipoPreguntas.codigo,
                    TipoPreguntas.nombres')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_encuesta = 4 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->orderBy('TipoPreguntas.codigo ASC')
            ->getQuery()
            ->execute();

        // foreach ($tipo_de_pregunta as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->codigo . $value->nombres);
        // }
        // exit();

        $this->view->tipo_preguntas = $tipo_de_pregunta;

        $encuestasAlumnos = EncuestasAlumnos::findFirst("id_alumno = '$id_alumno' AND id_encuesta = 4");

        // print($encuestasAlumnos->id_encuesta_alumno);
        // exit();

        $preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    TipoPreguntas.codigo,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion,
                    RespuestasAlumnos.id_encuesta_alumno,
                    RespuestasAlumnos.valor, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('RespuestasAlumnos', 'RespuestasAlumnos.id_encuesta_pregunta = EncuestasPreguntas.id_encuesta_pregunta')
            ->where("Encuestas.id_encuesta = 4 AND TipoPreguntas.numero = 36 AND RespuestasAlumnos.id_encuesta_alumno = $encuestasAlumnos->id_encuesta_alumno")
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();

        //             foreach ($preguntas as $value) {
        //     echo "<pre>";
        //     print_r("Preguntas: " . $value->descripcion);
        // }
        // exit();


        $this->view->preguntas = $preguntas;


        $respuestas = EncuestasPreguntasRespuestas::find("estado = 'A' ORDER BY puntaje ASC");
        $this->view->respuestas = $respuestas;

        $this->view->respuestalike = $encuestasAlumnos->chk_like;
        $recomendacion = $encuestasAlumnos->recomendacion;
        $this->view->recomendacion = $recomendacion;

        $encuestasRespuestasT = EncuestasRespuestasT::find("estado = 'A' AND id_encuesta = 4 ORDER BY orden ASC");
        $this->view->encuestasRespuestasT = $encuestasRespuestasT;
    }
}
