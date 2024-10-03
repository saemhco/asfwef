<?php

class ConfigpromediosController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction($curso_p,$semestre_p){
       
        $Asignaturas = Asignaturas::findFirstBycodigo((string) $curso_p);
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'  ",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );

        $semestre_m = $semestre->codigo;
        $this->view->semestre = $semestre_m;

        $this->view->codigo = $curso_p;

        $nombre_asignatura = $Asignaturas->nombre;
        $this->view->asignatura = $nombre_asignatura;

        $ciclo = $Asignaturas->ciclo;
        $this->view->ciclo = $ciclo;

        $creditos = $Asignaturas->creditos;
        $this->view->creditos = $creditos;

        $TipoAsignaturas = TipoAsignaturas::findFirst("numero = 71 AND codigo = '{$Asignaturas->tipo}'");
        $this->view->tipo_asignatura = $TipoAsignaturas->nombres;

        $this->assets->addJs("adminpanel/js/modulos/configpromedios.js?v=" . uniqid());
    }

    public function configAction($semestre_p,$curso_p,$grupo_p){
        $semestre = Semestres::findFirst(
            [
                "codigo=" . (int) $semestre_p,
                'order' => 'codigo DESC',
                'limit' => 1,
            ]
        );

        $curso = Asignaturas::findFirstBycodigo($curso_p);
        $carrera = Curriculas::findFirstBycodigo($curso->curricula);

        $this->view->semestre = $semestre;
        $this->view->curso = $curso;
        $this->view->carrera = $carrera;
        $this->view->grupo = $grupo_p;

        $this->view->cursop = $curso_p;
        $this->view->semestrep = $semestre_p;
        $this->assets->addJs("adminpanel/js/modulos/configpromediosform.js?v=" . uniqid());
    }

    public function saveAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //echo "<pre>"; print_r($_POST);exit();

                $auth = $this->session->get('auth');
                $doc_id = $auth["codigo"];

                $conditions = ['semestre'=>$this->request->getPost("semestre", "int"), 'asignatura'=>$this->request->getPost("curso", "string"), 
                                'grupo' => $this->request->getPost("grupo", "int"),'docente' => $doc_id ];
                
                $PromedioDetalle = PromedioDetalle::findFirst($conditions);

               // print_r($PromedioDetalle);exit();

                $PromedioDetalle = (!$PromedioDetalle) ? new PromedioDetalle() : $PromedioDetalle;
               // $PromedioDetalle->formula = trim($this->request->getPost("formula", "string"));
                foreach($_POST["etq"] as $key => $val ){
                    $temp_name = "etq_".($key+1);
                    $PromedioDetalle->$temp_name = $val;
                }

                foreach($_POST["peso"] as $key => $val ){
                    $temp_name = "peso_".($key+1);
                    $PromedioDetalle->$temp_name = $val;
                }



                
                $PromedioDetalle->semestre = $this->request->getPost("semestre", "int");
                $PromedioDetalle->asignatura = $this->request->getPost("curso", "string");
                $PromedioDetalle->grupo = $this->request->getPost("grupo", "int");
                $PromedioDetalle->docente = $doc_id;
                

                if ($PromedioDetalle->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PromedioDetalle->getMessages());
                } else {
                    //Cuando va bien 
                    
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PromedioDetalle);
                   // $this->response->setJsonContent(array("say" => "yes"));
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

    public function getAjaxAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Perfil = Perfil::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Perfil) {
                $this->response->setJsonContent($Perfil->toArray());
                $this->response->send();
            } else {
                $this->response->setContent("No existe registro");
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function eliminarAction() {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $Perfil = Perfil::findFirstByid((int) $this->request->getPost("id", "int"));
            if ($Perfil && $Perfil->estado = 'A') {
                $Perfil->estado = 'I';
                $Perfil->save();
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

     public function datatableregistroAction($id, $semestre) {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $auth = $this->session->get('auth');
            $doc_id = $auth["codigo"];

            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("grupo");
            $datatable->setSelect("semestre,grupo,docente,asignatura,estado");
            $datatable->setFrom("( SELECT
                                    d_a_d.semestre AS semestre,
                                    CONCAT ( d.apellidop, ' ', d.apellidom, ' ', d.nombres ) AS nombre_docente,
                                    d_a_d.asignatura,
                                    d_a_d.grupo,
                                    d_a_d.docente,
                                    d_a_d.tipo,
                                    d_a_d.estado
                                    FROM
                                            docentes_asignaturas_detalle AS d_a_d
                                            INNER JOIN docentes AS d ON d_a_d.docente = d.codigo
                                            INNER JOIN docentes_asignaturas AS d_a ON d_a.semestre = d_a_d.semestre
                                            AND d_a.asignatura = d_a_d.asignatura
                                            AND d_a.grupo = d_a_d.grupo
                                            AND d_a.docente = d_a_d.docente
                                            AND  d_a.tipo = d_a_d.tipo
                                            INNER JOIN a_codigos AS m ON d_a_d.modalidad = m.codigo
                                    WHERE
                                            d.estado = 'A' 
                                    ) AS temporal_table");
            $datatable->setWhere("estado = 'A' AND asignatura = '{$id}' AND docente={$doc_id} AND semestre ={$semestre} ");
            $datatable->setParams($_POST);
            $datatable->setOrderby("grupo");
            $datatable->setGroupby("grupo,semestre,docente,asignatura,estado");
            $datatable->getJson();
        }
    }
    

}
