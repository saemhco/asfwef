<?php

class EstadodecuentaController  extends ControllerPanel {

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
                ->where("AlumnosSemestre.alumno='{$codigo_alumno}' AND Semestres.codigo < {$semestre->codigo} ")
                ->orderBy('AlumnosSemestre.semestre DESC')
                ->getQuery()
                ->execute();
                
                
                
                 $sems =     
                    $this->modelsManager->createBuilder()
                ->from('AlumnosAsignaturas')
                ->columns('DISTINCT AlumnosAsignaturas.semestre, AlumnosAsignaturas.alumno'
                        . ', Semestres.descripcion')
                ->join('Semestres', 'Semestres.codigo = AlumnosAsignaturas.semestre')
                //->where("AlumnosSemestre.alumno='{$codigo_alumno}' AND Semestres.codigo < {$semestre->codigo} ")
                ->where("AlumnosAsignaturas.alumno='{$codigo_alumno}'  ")
                ->orderBy('AlumnosAsignaturas.semestre DESC')
                ->getQuery()
                ->execute();

        $cajaalumno = array();

        foreach ($sems as $k => $v) {
            $cajaalumno[$k]["semestre_name"] = $v->descripcion;

            $cajita = $this->modelsManager->createBuilder()
                    ->from('Caja')
                    ->columns('Caja.codigo,Conceptos.descripcion,Caja.fecha_emision,Caja.fecha_pago'
                            . ',Caja.cuota,Caja.cantidad,Caja.monto,Caja.estado')
                    ->join('Conceptos', 'Conceptos.codigo = Caja.concepto')
                    ->where("Caja.alumno = '{$codigo_alumno}' AND Caja.semestre = {$v->semestre} ")
                    ->orderBy('Caja.fecha_pago DESC')
                    ->getQuery()
                    ->execute();

            $infocaja = array();
            foreach ($cajita as $key => $value) {

                $total = (int) $value->cantidad * (double) $value->monto;
                $msg = "PENDIENTE";
                if ($value->estado == 1) {
                    $msg = "CANCELADO";
                }

                $infocaja[$key]["concepto"] = $value->descripcion;
                $infocaja[$key]["emision"] = $value->fecha_emision;
                $infocaja[$key]["pago"] = $value->fecha_pago;
                $infocaja[$key]["cuota"] = $value->cuota;
                $infocaja[$key]["cantidad"] = $value->cantidad;
                $infocaja[$key]["pu"] = number_format($value->monto, 2, '.', '');
                $infocaja[$key]["total"] = number_format($total, 2, '.', '');
                $infocaja[$key]["estado"] = $msg;
            }
            $cajaalumno[$k]["detalle"] = $infocaja;
        }
        $this->view->cajitas = $cajaalumno;
    }


}
