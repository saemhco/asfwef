<?php

class GestionnotasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    //Aca insertamos un comentario para subir
    public function indexAction($sem = null) {
        //print $sem;exit();
        $semestre_a = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $this->view->semestrea = $semestre_a->codigo;


        $semestres = Semestres::find(
                        [
                            'order' => 'codigo DESC'
                        ]
        );

        $this->view->semestres = $semestres;
        $this->view->sem = $sem;
        $this->assets->addJs("adminpanel/js/modulos/gestionnotas.js?v=" . uniqid());
    }

    //Cargamos el datatables
    public function datatableAction($sem) {

        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];






        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("da.asignatura");
            $datatable->setSelect("da.asignatura,da.semestre,  da.docente, da.tipo, da.tp, 
             cu.descripcion, asi.ciclo, asi.nombre, da.semestre, asi.hp, asi.ht , asi.creditos, ac.nombres, da.grupo");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("docentes_asignaturas da
             inner join asignaturas asi ON asi.codigo = da.asignatura
             inner join curriculas cu ON cu.codigo = asi.curricula
             inner join a_codigos ac ON ac.codigo = asi.tipo
                ");
            //$datatable->setWhere(" (a.estado = 'A') AND (a.codigo > 0) ");
            $datatable->setWhere(" da.semestre = {$sem} and da.docente = {$doc_id} and  ac.numero = 71 ");
            $datatable->setOrderby("da.asignatura ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }

    public function notasAction($sem, $id, $grupo) {
        $this->assets->addJs("adminpanel/js/modulos/gestionnotas.notasnuevo.js?v=" . uniqid());

        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M' and codigo = {$sem} ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $fecha_actual = strtotime(date("Y-m-d H:i:s", time()));

        $fecha_inicio_sustitutorio = strtotime(date($semestre->fecha_inicio_sustitutorio));
        $fecha_final_sustitutorio = strtotime(date($semestre->fecha_fin_sustitutorio));

        $fecha_inicio_notas1 = strtotime(date($semestre->fecha_inicio_notas1));
        $fecha_fin_notas1 = strtotime(date($semestre->fecha_fin_notas1));

        $fecha_inicio_notas2 = strtotime(date($semestre->fecha_inicio_notas2));
        $fecha_fin_notas2 = strtotime(date($semestre->fecha_fin_notas2));



        $ea_activado = "readonly";
        if ($fecha_actual >= $fecha_inicio_sustitutorio && $fecha_actual <= $fecha_final_sustitutorio) {
            $ea_activado = "";
        }

        $eaadisab[1] = "disabled";
        $eaactivado[1] = "readonly";
        if ($fecha_actual >= $fecha_inicio_notas1 && $fecha_actual <= $fecha_fin_notas1) {
            $eaactivado[1] = "";
            $eaadisab[1] = "";
        }

        $eaadisab[2] = "disabled";
        $eaactivado[2] = "readonly";
        if ($fecha_actual >= $fecha_inicio_notas2 && $fecha_actual <= $fecha_fin_notas2) {
            $eaactivado[2] = "";
            $eaadisab[2] = "";
        }

        $this->view->ea_activado = $ea_activado;
        $this->view->eaactivado = $eaactivado;
        $this->view->eaadisab = $eaadisab;
        //echo "<pre>" ;print_r($eaactivado);
        //echo "<pre>" ;print_r($eaadisab);exit();
        //print $semestre->fecha_inicio_sustitutorio."<br>".$semestre->fecha_fin_sustitutorio."<br>";
        //print $ea_activado;exit();
        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];

        $asignatura = "";
        if ($id != null) {
            $asignatura = Asignaturas::findFirstBycodigo((string) $id);
        }

        $conditions = " semestre = {$sem} AND asignatura = '{$id}' AND grupo = {$grupo} AND docente = {$doc_id} ";



        $prom_conf = PromedioDetalle::findFirst([$conditions])->toArray();

        //print_r($conditions); exit();


        $this->view->prom_conf = $prom_conf;

        //$vista_notas  = Vistanotas::find("semestre = '{$sem}' AND asignatura='{$id}' ");
        $vista_notas = VNotas::find(
                        [
                            "semestre = '{$sem}' AND asignatura='{$id}' AND tipo<>2 AND tipo<>5 AND tipo<>9 AND grupo = $grupo ",
                            'order' => 'apellidos ASC',
                        ]
                )->toArray();

        $cod = Acodigos::findFirst(
                        [
                            "codigo = '{$asignatura->tipo}' AND numero = 6  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $programa = Curriculas::findFirst(
                        [
                            "codigo = '{$asignatura->curricula}'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        // echo  $asignaturas->codigo ; exit();
        $this->view->asignatura = $asignatura;
        $this->view->semestre = $semestre;
        $this->view->programa = $programa;
        $this->view->notas = $vista_notas;
        $this->view->cod = $cod;
        $this->view->grupo = $grupo;

        $this->view->ea_activado = $ea_activado;
        $this->view->eaactivado = $eaactivado;
        $this->view->eaadisab = $eaadisab;
    }

    public function guardanotasAction() {
        //echo "<pre>";
        //print_r($_POST);
        //exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $semestre = $this->request->getPost("semestre", "int");
            $asignatura = $this->request->getPost("asignatura", "string");
            $grupo = $this->request->getPost("grupo", "int");

            // esto es magia , no tocar 
            foreach ($_POST["alumno"] as $key => $val) {


                $db = $this->db;
                //$perid = (int)$perfil;
                $str_update = "";
                for ($i = 1; $i <= 20; $i++) {

                    if ($i <= 10) {
                        $label_db = "n0" . $i;
                    } else {
                        $label_db = "n" . $i;
                    }

                    if (isset($_POST["ep" . $i][$key])) {
                        $str_update = $str_update . " , {$label_db} = " . (double) $_POST["ep" . $i][$key];
                    }
                }

                $ea = (double) $_POST["ea"][$key];
                $pf = (double) $_POST["pf"][$key];

                $sql = " update alumnos_asignaturas  set ea = {$ea} ,pf = {$pf} {$str_update}

                where alumno = '{$val}' AND semestre = {$semestre} AND asignatura = '{$asignatura}' AND grupo = {$grupo}  ";

                //print $sql; exit(); 
                //print $sql; exit();
                $db->fetchOne($sql, Phalcon\Db::FETCH_OBJ);
            }
            //exit();
            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("say" => "yes"));
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //Funcion para guardar asignatura
    // justo aca
    public function saveAction() {
        //echo "<pre>";
        //print_r($_POST);
        //exit();
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {
                $id = (string) $this->request->getPost("codigo", "int");
                $Asignaturas = Asignaturas::findFirstBycodigo($id);
                $Asignaturas = (!$Asignaturas) ? new Asignaturas() : $Asignaturas;

                $Asignaturas->codigo = $this->request->getPost("codigo", "string");


                $Asignaturas->nombre = $this->request->getPost("nombre", "string");
                $Asignaturas->nivel = $this->request->getPost("nivel", "string");
                $Asignaturas->ciclo = $this->request->getPost("ciclo", "string");
                $Asignaturas->tipo = $this->request->getPost("tipo", "string");

                // print $this->request->getPost("curricula", "string") ;exit();

                $Asignaturas->curricula = $this->request->getPost("curricula", "string");
                $Asignaturas->creditos = $this->request->getPost("creditos", "string");
                $Asignaturas->pr1 = $this->request->getPost("pr1", "string");
                $Asignaturas->pr2 = $this->request->getPost("pr2", "string");
                $Asignaturas->pr3 = $this->request->getPost("pr3", "string");
                $Asignaturas->ht = $this->request->getPost("ht", "string");
                $Asignaturas->hp = $this->request->getPost("hp", "string");
                $Asignaturas->observaciones = $this->request->getPost("observaciones");
                $Asignaturas->estado = "A";



                if ($Asignaturas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Asignaturas->getMessages());
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

    //Funcion para eliminar
    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Asignaturas = Asignaturas::findFirstBycodigo($this->request->getPost("id", "int"));
            if ($Asignaturas && $Asignaturas->estado = 'A') {
                $Asignaturas->estado = 'X';
                $Asignaturas->save();
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


    // Configuracion de formulas
    public function configuracionAction($semestre_p, $curso_p, $grupo_p) {
        $auth = $this->session->get('auth');
        $doc_id = $auth["codigo"];

        $conditions = " semestre = {$semestre_p} AND asignatura = '{$curso_p}' AND grupo = {$grupo_p} AND docente = {$doc_id} ";
        $prom_conf = PromedioDetalle::findFirst([$conditions]);
        $nuevo = 0;
        if ($prom_conf) {
            $this->view->prom_conf = $prom_conf->toArray();
            $nuevo = 1;
        }

        $semestre = Semestres::findFirst(
                        [
                            "codigo=" . (int) $semestre_p,
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $curso = Asignaturas::findFirstBycodigo($curso_p);
        $carrera = Curriculas::findFirstBycodigo($curso->curricula);

        $this->view->nuevo = $nuevo;

        $this->view->semestre = $semestre;
        $this->view->curso = $curso;
        $this->view->carrera = $carrera;
        $this->view->grupo = $grupo_p;
        $this->view->cursop = $curso_p;
        $this->view->semestrep = $semestre_p;
        $this->assets->addJs("adminpanel/js/modulos/gestionnotas.form.js?v=" . uniqid());
    }

    public function saveconfigAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //echo "<pre>"; print_r($_POST);exit();

                $auth = $this->session->get('auth');
                $doc_id = $auth["codigo"];

                $conditions = " semestre =" . (int) $this->request->getPost("semestre", "int") . " AND asignatura = '" . $this->request->getPost("curso", "string") . "' AND grupo = " . (int) $this->request->getPost("grupo", "int") . " AND docente = $doc_id ";

                $PromedioDetalle = PromedioDetalle::findFirst($conditions);
                //print $PromedioDetalle->semestre; exit();
                // print_r($PromedioDetalle);exit();

                $PromedioDetalle = (!$PromedioDetalle) ? new PromedioDetalle() : $PromedioDetalle;
                // $PromedioDetalle->formula = trim($this->request->getPost("formula", "string"));
                foreach ($_POST["etq"] as $key => $val) {
                    $temp_name = "etq_" . ($key + 1);
                    $PromedioDetalle->$temp_name = $val;
                }

                /*
                  foreach($_POST["peso"] as $key => $val ){
                  $temp_name = "peso_".($key+1);
                  $PromedioDetalle->$temp_name = $val;
                  } */


                foreach ($_POST["tipo"] as $key => $val) {
                    $temp_name = "tipo_" . ($key + 1);
                    $PromedioDetalle->$temp_name = $val;
                }

                $PromedioDetalle->semestre = (int) $this->request->getPost("semestre", "int");
                $PromedioDetalle->asignatura = $this->request->getPost("curso", "string");
                $PromedioDetalle->grupo = (int) $this->request->getPost("grupo", "int");
                $PromedioDetalle->formula = $this->request->getPost("formula", "string");
                $PromedioDetalle->docente = $doc_id;


                if ($PromedioDetalle->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PromedioDetalle->getMessages());
                } else {
                    //Cuando va bien 

                    $this->response->setStatusCode(200, "OK");
                    //$this->response->setJsonContent($PromedioDetalle);
                    $this->response->setJsonContent(array("say" => "yes", "data" => $PromedioDetalle));
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

    public function verificarconfigAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $auth = $this->session->get('auth');
            $doc_id = $auth["codigo"];

            $conditions = " semestre =" . (int) $this->request->getPost("semestre", "int") . " AND asignatura = '" . $this->request->getPost("asignatura", "string") . "' AND grupo = " . (int) $this->request->getPost("grupo", "int") . " AND docente = $doc_id ";

            $PromedioDetalle = PromedioDetalle::findFirst($conditions);
            if ($PromedioDetalle) {
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
