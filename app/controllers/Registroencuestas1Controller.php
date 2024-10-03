<?php
class Registroencuestas1Controller extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();

        $this->assets->addJs("adminpanel/js/modulos/registroencuestas1.js?v=" . uniqid());
    }

    //Funcion index
    public function indexAction()
    {
    }

    //Cargamos el datatables
    public function datatableAction()
    {

        $auth = $this->session->get('auth');
        $codigo_alumno = $auth["codigo"];

        $semestre_a = Semestres::findFirst(
            [
                "activo = 'M'  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("a_e.id_encuesta_alumno");
            $datatable->setSelect("a_e.id_encuesta_alumno, "
                . "a_e.id_semestre, "
                . "a_e.id_alumno, "
                . "a_e.id_asignatura, "
                . "a_e.fecha, a_e.estado, "
                . "a_e.id_grupo, "
                . "s.descripcion AS semestre, "
                . "a.nombre AS asignatura, "
                . "a.ciclo");
            $datatable->setFrom("tbl_enc_encuestas_alumnos a_e "
                . "INNER JOIN semestres s ON s.codigo = a_e.id_semestre "
                . "INNER JOIN asignaturas a ON a.codigo = a_e.id_asignatura");
            $datatable->setWhere("a_e.estado = 'A' AND a_e.id_alumno = '$codigo_alumno' AND s.codigo = $semestre_a->codigo ");
            $datatable->setOrderby("a_e.id_encuesta_alumno ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    //Funcion para agregar encuesta y editar
    public function registroAction($id = null)
    {

        //echo '<pre>';
        //print_r("hola");
        //exit();
        //Modelo semestre
        $semestres = Semestres::find(
            [
                'order' => 'codigo DESC',
            ]
        );
        $this->view->semestres = $semestres;

        //Modelo encuestas
        $encuesta = Encuestas::findFirst("estado = 'A' AND id_tipo_encuesta = '1' AND id_encuesta = 1");
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
            ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36")
            ->groupBy('TipoPreguntas.codigo, TipoPreguntas.nombres')
            ->getQuery()
            ->execute();




        // foreach ($tipo_de_pregunta as $value) {
        //     echo "<pre>";
        //     print_r("TipoPreguntas: " . $value->nombres);
        // }
        // exit();

        $this->view->tipo_preguntas = $tipo_de_pregunta;



        //Pregunta
        $preguntas = $this->modelsManager->createBuilder()
            ->from('Encuestas')
            ->columns('Encuestas.id_tipo_encuesta,
                    Encuestas.descripcion,
                    TipoPreguntas.codigo,
                    TipoPreguntas.nombres,
                    EncuestasPreguntas.id_encuesta_pregunta,
                    EncuestasPreguntas.descripcion, EncuestasPreguntas.numero')
            ->join('EncuestasPreguntas', 'EncuestasPreguntas.id_encuesta = Encuestas.id_encuesta')
            ->join('TipoPreguntas', 'TipoPreguntas.codigo = EncuestasPreguntas.id_tipo_pregunta')
            ->join('EncuestasPreguntasRespuestas', 'EncuestasPreguntas.id_encuesta_pregunta = EncuestasPreguntasRespuestas.id_encuesta_pregunta')
            ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36")
            ->groupBy('Encuestas.id_tipo_encuesta, EncuestasPreguntas.descripcion, TipoPreguntas.codigo,TipoPreguntas.nombres, EncuestasPreguntas.id_encuesta_pregunta')
            ->orderBy('EncuestasPreguntas.numero ASC')
            ->getQuery()
            ->execute();
        $this->view->preguntas = $preguntas;

        $auth = $this->session->get('auth');
        $codigo_alumno = $auth["codigo"];

        $semestre_a = Semestres::findFirst(
            [
                "activo = 'M'  ",
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        //echo"<pre>";
        //print_r($codigo_alumno."-".$semestre_a->codigo);
        //exit();

        $asignaturas_query = $this->modelsManager->createQuery("SELECT
            Asignaturas.codigo,
            Asignaturas.nombre,
            Asignaturas.ciclo,
            AlumnosAsignaturas.semestre,
            AlumnosAsignaturas.alumno,
            AlumnosAsignaturas.asignatura,
            Docentes.apellidop,
            Docentes.apellidom,
            Docentes.nombres,
            Carreras.descripcion AS carrera,
            AlumnosAsignaturas.grupo
            FROM
            AlumnosAsignaturas
            INNER JOIN Asignaturas ON Asignaturas.codigo = AlumnosAsignaturas.asignatura
            INNER JOIN DocentesAsignaturas ON AlumnosAsignaturas.semestre = DocentesAsignaturas.semestre AND AlumnosAsignaturas.asignatura = DocentesAsignaturas.asignatura AND AlumnosAsignaturas.grupo = DocentesAsignaturas.grupo
            INNER JOIN Docentes ON DocentesAsignaturas.docente = Docentes.codigo
            INNER JOIN Alumnos ON Alumnos.codigo = AlumnosAsignaturas.alumno
            INNER JOIN Carreras ON Alumnos.carrera = Carreras.codigo
            INNER JOIN TipoMatricula ON TipoMatricula.codigo = AlumnosAsignaturas.tipo
            WHERE
            AlumnosAsignaturas.alumno = '{$codigo_alumno}'
            AND AlumnosAsignaturas.semestre = {$semestre_a->codigo}
            AND Docentes.codigo <> 0
            AND DocentesAsignaturas.semestre = {$semestre_a->codigo}
            AND TipoMatricula.numero = 9
            AND DocentesAsignaturas.semestre = {$semestre_a->codigo}
            AND AlumnosAsignaturas.tipo <> 2 AND AlumnosAsignaturas.tipo <> 5 AND AlumnosAsignaturas.tipo <> 9");

        $asignaturas = $asignaturas_query->execute();

        //        foreach ($asignaturas as $test) {
        //            echo "<pre>";
        //            print_r($test->codigo . '<br>' . $test->nombre . '<br>' . $test->semestre . '<br>' . $test->alumno);
        //        }
        //        exit();

        $this->view->asignaturas = $asignaturas;



        $respuestas = EncuestasPreguntasRespuestas::find("estado = 'A' ORDER BY puntaje ASC");
        // foreach ($respuestas as $test) {
        //     echo "<pre>";
        //     print_r($test->descripcion);
        // }
        // exit();
        $this->view->respuestas = $respuestas;
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
                $encuestasAlumnos->id_asignatura = $this->request->getPost("asignatura", "string");
                $encuestasAlumnos->id_grupo = $this->request->getPost("id_grupo", "int");

                $encuestasAlumnos->fecha = date('Y-m-d');
                $encuestasAlumnos->estado = 'A';

                $like = $this->request->getPost("like", "string");
                if ($like == '0') {
                    $encuestasAlumnos->chk_like = 0;
                } elseif ($like == '1') {
                    $encuestasAlumnos->chk_like = 1;
                } else {
                    $encuestasAlumnos->chk_like = 2;
                }

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
                        ->where("Encuestas.id_tipo_encuesta = 1 AND TipoPreguntas.numero = 36 ")
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
}
