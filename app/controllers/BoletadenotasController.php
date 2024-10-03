<?php

class BoletadenotasController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
        //echo "<pre>"; print_r($_SESSION);exit();
        $auth = $this->session->get('auth');

        $codigo_alumno = $auth["codigo"];


        $dato_alumno = Alumnos::findFirstBycodigo($codigo_alumno);
        $carrea = Carreras::findFirstBycodigo($dato_alumno->carrera);

        $this->view->alumno = $dato_alumno;
        $this->view->carrera = $carrea;


        /* Calculamos el semestre actual */
        $semestre = Semestres::findFirst(
                        [
                            "activo = 'M'",
                            'order' => 'codigo DESC',
                            'limit' => 1,
                        ]
        );
        $this->view->semestre = $semestre;
        /* fin semestre */

        /* Calculo de ciclo */
        $ciclo_creditos = CreditosCiclos::find("carrera = '{$dato_alumno->carrera}'");
        $evalue = array();
        $sum = 0;

        $credinfo = array();
        foreach ($ciclo_creditos as $key => $value) {
            $credinfo[$value->ciclo] = $value->creditos;
            $sum = $sum + (int) $value->creditos;

            $evalue["{$value->ciclo}"][] = $sum;
        }

        /* Obteniendo numero de creditos */
        $numero_cre = $this->modelsManager->createBuilder()
                ->from('AlumnosAsignaturas')
                ->columns('SUM(Asignaturas.creditos) as total')
                ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
                ->where("AlumnosAsignaturas.alumno ='{$codigo_alumno}' AND AlumnosAsignaturas.pf > 10 ")
                //->orderBy("Noticias.noticia_id DESC")
                //->orderBy("Noticias.fecha_publicacion DESC")
                ->getQuery()
                ->execute();
        $nc = $numero_cre[0]->total;
        //print "<pre>";        print_r($evalue);
        //print $nc;exit();

        $this->view->totalcreditos = $nc;

        /* Fin */

        $n_creditos = (int) $nc;
        $ciclo_corresponde = "";

        foreach ($evalue as $key => $value) {
            if ($n_creditos <= $value[0]) {
                if ($ciclo_corresponde == "") {
                    $ciclo_corresponde = $key;
                }
            }
        }

        $this->view->ciclo = $ciclo_corresponde;



        $semestres = $this->modelsManager->createBuilder()
                ->from('AlumnosSemestre')
                ->columns('DISTINCT AlumnosSemestre.semestre, AlumnosSemestre.alumno, AlumnosSemestre.ciclo, AlumnosSemestre.creditos, '
                        . 'AlumnosSemestre.promedio, Semestres.descripcion')
                ->join('Semestres', 'Semestres.codigo = AlumnosSemestre.semestre')
                //->where("AlumnosSemestre.alumno='{$codigo_alumno}' AND Semestres.codigo < {$semestre->codigo} ")
                ->where("AlumnosSemestre.alumno='{$codigo_alumno}'  ")
                ->orderBy('AlumnosSemestre.semestre DESC')
                ->getQuery()
                ->execute();

        $sems = $this->modelsManager->createBuilder()
                ->from('AlumnosAsignaturas')
                ->columns('DISTINCT AlumnosAsignaturas.semestre, AlumnosAsignaturas.alumno'
                        . ', Semestres.descripcion')
                ->join('Semestres', 'Semestres.codigo = AlumnosAsignaturas.semestre')
                //->where("AlumnosSemestre.alumno='{$codigo_alumno}' AND Semestres.codigo < {$semestre->codigo} ")
                ->where("AlumnosAsignaturas.alumno='{$codigo_alumno}'  ")
                ->orderBy('AlumnosAsignaturas.semestre DESC')
                ->getQuery()
                ->execute();

        $data_notas = array();
        //echo "<pre>" ; print_r($semestres);exit();


        foreach ($sems as $k => $v) {
            $data_notas[$k]["semestre_name"] = $v->descripcion;
            $data_notas[$k]["prom_semestre"] = "";


            $notas_curso = $this->modelsManager->createBuilder()
                    ->from('AlumnosAsignaturas')
                    ->columns('DISTINCT AlumnosAsignaturas.asignatura ,AlumnosAsignaturas.semestre, AlumnosAsignaturas.asignatura, 
        AlumnosAsignaturas.alumno, AlumnosAsignaturas.pf, Asignaturas.nombre, Asignaturas.creditos, Asignaturas.ciclo,
        AlumnosAsignaturas.eo1, AlumnosAsignaturas.nt1, AlumnosAsignaturas.pp1, AlumnosAsignaturas.ee1, AlumnosAsignaturas.ifo1, AlumnosAsignaturas.ep1,
        AlumnosAsignaturas.eo2, AlumnosAsignaturas.nt2, AlumnosAsignaturas.pp2, AlumnosAsignaturas.ee2, AlumnosAsignaturas.ifo2, AlumnosAsignaturas.ep2,
        AlumnosAsignaturas.ef,AlumnosAsignaturas.ea,AlumnosAsignaturas.pf')
                    ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
                    //->where("AlumnosAsignaturas.alumno='{$codigo_alumno}' AND  AlumnosAsignaturas.semestre = {$v->semestre} ")
                    ->where("AlumnosAsignaturas.alumno='{$codigo_alumno}' AND AlumnosAsignaturas.pf >= -2 AND AlumnosAsignaturas.estado = 'A' AND AlumnosAsignaturas.tipo <> 5 AND AlumnosAsignaturas.tipo <> 9 AND AlumnosAsignaturas.tipo <> 2 AND AlumnosAsignaturas.semestre = {$v->semestre} ")
                    ->getQuery()
                    ->execute();
            $detalle_notas = array();
            $sum_creditos = 0;
            $total_desaprobados = 0;

            $total_aprobados = 0;
            foreach ($notas_curso as $key => $value) {
                $detalle_notas[$key]["asignatura"] = $value->asignatura;
                $detalle_notas[$key]["eo1"] = $value->eo1;
                $detalle_notas[$key]["nt1"] = $value->nt1;
                $detalle_notas[$key]["pp1"] = $value->pp1;
                $detalle_notas[$key]["ee1"] = $value->ee1;
                $detalle_notas[$key]["ifo1"] = $value->ifo1;
                $detalle_notas[$key]["ep1"] = $value->ep1;

                $detalle_notas[$key]["eo2"] = $value->eo2;
                $detalle_notas[$key]["nt2"] = $value->nt2;
                $detalle_notas[$key]["pp2"] = $value->pp2;
                $detalle_notas[$key]["ee2"] = $value->ee2;
                $detalle_notas[$key]["ifo2"] = $value->ifo2;
                $detalle_notas[$key]["ep2"] = $value->ep2;
                $detalle_notas[$key]["ef"] = $value->ef;

                $detalle_notas[$key]["ea"] = $value->ea;
                $detalle_notas[$key]["pf"] = $value->pf;

                $detalle_notas[$key]["curso"] = $value->nombre;
                $detalle_notas[$key]["ciclo"] = $value->ciclo;
                $detalle_notas[$key]["creditos"] = $value->creditos;
                $detalle_notas[$key]["nota"] = $value->pf;
                if ((Float) $value->pf > 10) {
                    $detalle_notas[$key]["aprobado"] = "si";
                    $total_aprobados = $total_aprobados + 1;
                } else {
                    $detalle_notas[$key]["aprobado"] = "no";
                    $total_desaprobados = $total_desaprobados + 1;
                }

                $sum_creditos = $sum_creditos + (int) $value->creditos;
            }
            $data_notas[$k]["cursillos"] = count($notas_curso);
            $data_notas[$k]["sum_creditos"] = $sum_creditos;
            $data_notas[$k]["total_aprobados"] = $total_aprobados;
            $data_notas[$k]["total_desaprobados"] = $total_desaprobados;
            $data_notas[$k]["detalle_notas"] = $detalle_notas;
        }
        //echo "<pre>" ; print_r($data_notas);exit();
        // echo "<pre>" ; print_r($semestres);exit();
        $this->view->records = $data_notas;
        //$this->assets->addJs("adminpanel/js/modulos/alumnos.js?v=" . uniqid());
    }

}
