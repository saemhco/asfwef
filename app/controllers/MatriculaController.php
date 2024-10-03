<?php

class MatriculaController extends ControllerPanel
{

    public function initialize()
    {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction()
    {
        $Semestres = Semestres::findFirst("activo = 'M'");
        $fecha_inicio_matricula = strtotime(date($Semestres->fecha_inicio_matricula));
        $fecha_fin_matricula = strtotime(date($Semestres->fecha_fin_matricula));
        $fecha_actual = strtotime(date("Y-m-d H:i:s", time()));

        //print("fecha_inicio_matricula:" . $fecha_inicio_matricula."<br>");
        //print("fecha_inicio_matricula:" . $fecha_fin_matricula."<br>");
        //print("fecha_actual:" . $fecha_actual);
        //exit();

        $SemestreM = Semestres::findFirst("activo = 'M'");
        $this->view->semestre_nombre = $SemestreM->definicion;

        $auth = $this->session->get('auth');
        $codigo_alumno = $auth["codigo"];

        $verifica_1 = AlumnosSemestre::find("semestre = {$SemestreM->codigo} AND alumno='{$codigo_alumno}' AND matricula_realizada = '1' ");
        if (count($verifica_1) >= 1) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("matricula/fichamatricula");
        } else {

            if ($fecha_actual > $fecha_inicio_matricula and $fecha_actual < $fecha_fin_matricula) {
                $verifica_2 = AlumnosSemestre::find("semestre = {$SemestreM->codigo} AND alumno='{$codigo_alumno}' ");
                if (count($verifica_2) >= 1) {
                    //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
                    return $this->response->redirect("matricula/requisitos");
                }
            } else {
                //print("Matricula no disponible");
                //exit();
                $fecha_falta = 1;
                $this->view->fecha_falta = $fecha_falta;
            }
        }

        //print("Hola Mundo IF");
        //exit();
        //return $this->response->redirect("matricula");

        $this->assets->addJs("adminpanel/js/modulos/index.matricula.js?v=" . uniqid());
    }

    public function saveiniciommatriculaAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $auth = $this->session->get('auth');
                $codigo_alumno = $auth["codigo"];

                $Semestres = Semestres::findFirst("activo = 'M'");
                $SemestreM = $Semestres->codigo;

                $AlumnosSemestre = new AlumnosSemestre();
                $AlumnosSemestre->semestre = $SemestreM;
                $AlumnosSemestre->alumno = $codigo_alumno;
                $AlumnosSemestre->fecha_inicio_matricula = date("Y-m-d");
                $AlumnosSemestre->registros_academicos = '0';
                $AlumnosSemestre->voucher = '1';
                $AlumnosSemestre->matricula_ok = '0';
                $AlumnosSemestre->matricula_realizada = '0';
                $AlumnosSemestre->reserva_matricula = '0';
                $AlumnosSemestre->servicio_cultural = '0';
                $AlumnosSemestre->servicio_deportivo = '0';
                $AlumnosSemestre->servicio_psicopedagogico = '0';
                $AlumnosSemestre->servicio_social = '0';
                $AlumnosSemestre->servicio_salud = '0';
                $AlumnosSemestre->estado = 'A';
                $AlumnosSemestre->save();

                $AlumnosFicha = new AlumnosFicha();
                $AlumnosFicha->semestre = $SemestreM;
                $AlumnosFicha->alumno = $codigo_alumno;
                $AlumnosFicha->estado = 'A';
                $AlumnosFicha->save();

                //Cuando va bien
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function matriculaAction()
    {

        $auth = $this->session->get('auth');

        $codigo_alumno = $auth["codigo"];
        $Alumnos = Alumnos::findFirstBycodigo($codigo_alumno);

        $Carreras = Carreras::findFirstBycodigo($Alumnos->carrera);

        $this->view->alumno = $Alumnos;
        $this->view->carrera = $Carreras;

        /* Calculamos el semestre actual */
        $SemestreM = Semestres::findFirst("activo = 'M'");

        /* El semestre de Estado P, para el promedio */
        $SemestreP = Semestres::findFirst("activo = 'P'");

        $semestrep_codigo = $SemestreP->codigo;

        $this->view->semestre = $SemestreM;

        /* Verificamos si ya esta matriculado */
        // buscaremos si ya tiene cursos con su codigo en el semestrea actual
        $verifica = AlumnosSemestre::find("semestre = {$SemestreM->codigo} AND alumno='{$codigo_alumno}' AND matricula_realizada = '1' ");

//        echo '<pre>';
        //        print_r(1);
        //        exit();

        if (count($verifica) >= 1) {
            //ya esta matriculado , y lo redireccionamos a la ficha de matricula :v
            return $this->response->redirect("matricula/fichamatricula");
        }
        $ciclo_corresponde = "0";
        $reserva_matricula = "0";
        /* Mario : Buscamos en Alumno Semestre */
        $AlumnosSemestre = AlumnosSemestre::findFirst("semestre = {$semestrep_codigo} AND alumno='{$codigo_alumno}' ");
        $pps = (double) $AlumnosSemestre->promedio;


//        $semestrep_codigo = $semestrep_codigo - 1;
        //        $AlumnosSemestreP = AlumnosSemestre::findFirst("semestre = {$semestrep_codigo} AND alumno='{$codigo_alumno}' ");
        //
        //
        //
        //        if ($AlumnosSemestreP->reserva_matricula == 1) {
        //            $pps = (double) $AlumnosSemestreP->promedio;
        //            if ($pps < 0) {
        //                $semestrep_codigo = $semestrep_codigo - 1;
        //                $AlumnosSemestreP = AlumnosSemestre::findFirst("semestre = {$semestrep_codigo} AND alumno='{$codigo_alumno}' ");
        //                $pps = (double) $AlumnosSemestreP->promedio;
        //                if ($pps < 0) {
        //                    $semestrep_codigo = $semestrep_codigo - 1;
        //                    $AlumnosSemestreP = AlumnosSemestre::findFirst("semestre = {$semestrep_codigo} AND alumno='{$codigo_alumno}' ");
        //                    $pps = (double) $AlumnosSemestreP->promedio;
        //                    if ($pps < 0) {
        //                        $semestrep_codigo = $semestrep_codigo - 1;
        //                        $AlumnosSemestreP = AlumnosSemestre::findFirst("semestre = {$semestrep_codigo} AND alumno='{$codigo_alumno}' ");
        //                        $pps = (double) $AlumnosSemestreP->promedio;
        //                    }
        //                }
        //            }
        //        }

        /* Obteniendo numero de creditos del alumno */
        $NumeroCreditosAlumno = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturas')
            ->columns('SUM(Asignaturas.creditos) as total')
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
            ->where("  AlumnosAsignaturas.alumno ='{$codigo_alumno}' "
                . "AND (AlumnosAsignaturas.tipo <> 2) AND (Asignaturas.ciclo < 11) AND (AlumnosAsignaturas.estado = 'A') AND (AlumnosAsignaturas.pf > 10 OR AlumnosAsignaturas.pf = - 1)")
            ->getQuery()
            ->execute();
        $numero_creditos_alumno = $NumeroCreditosAlumno[0]->total;
        $this->view->totalcreditos = $numero_creditos_alumno;

        /* Fin */

        $numero_creditos_alumno_int = (int) $numero_creditos_alumno;

        $xCreditosC = 0;
        $xCreditosT = 0;
        $xCiclo = 1;
        $CreditosciclosT = CreditosCiclos::find("carrera = '{$Alumnos->carrera}'");
        $evalue = array();
        $sum = 0;

        $credinfo = array();

        foreach ($CreditosciclosT as $key => $value) {
            $credinfo[$value->ciclo] = $value->creditos;
            $sum = $sum + (int) $value->creditos;

            $evalue["{$value->ciclo}"][] = $sum;
        }

        if ($numero_creditos_alumno > 0) {
            foreach ($evalue as $key => $value) {
                $xCreditosT = $xCreditosC + ($value[0]);
                if ($xCreditosC < $numero_creditos_alumno_int and $numero_creditos_alumno_int <= $xCreditosT) {
                    $ciclo_corresponde = $xCiclo;
                    break;
                }
                $xCreditosC = $xCreditosC + ($value[0]);

                $xCiclo = $xCiclo + 1;
            }
        } else {
            $ciclo_corresponde = 1;
            $pps = 13;
        }

        $CreditosCiclos = CreditosCiclos::findFirst("carrera = '{$Alumnos->carrera}' AND ciclo = '{$ciclo_corresponde}' ");
        $creditos_ciclo_permitidos = (int) $CreditosCiclos->creditos;

        /* Validaciones Nuevas 2019 */
        $creditos_permitidos_alumno = 0;

        if ($pps >= -1 && $pps < 10.5) {

            $creditos_permitidos_alumno = 12;
        } else {
            if ($pps >= 10.5 && $pps < 13.5) {
                $creditos_permitidos_alumno = $creditos_ciclo_permitidos;
            } else {
                if ($pps >= 13.5 && $pps < 16.5) {
                    $creditos_permitidos_alumno = $creditos_ciclo_permitidos + 3;
                } else {
                    if ($pps >= 16.5 && $pps <= 20) {
                        $creditos_permitidos_alumno = $creditos_ciclo_permitidos + 4;

 
                    }
                }
            }

            // print("Creditos Ciclo: ");
            // exit();
        }

        //$this->view->creditosciclo = $credi;

        $this->view->creditosciclo = $creditos_permitidos_alumno;
        $this->view->ciclo = $ciclo_corresponde;
        /* fin de calculo */

        /* Consulta cursos permitidos para la matricula */
        $cursodispo = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturasPre')
            ->columns("AlumnosAsignaturasPre.semestre, AlumnosAsignaturasPre.alumno, AlumnosAsignaturasPre.asignatura, "
                . "Asignaturas.nombre, Asignaturas.ciclo, Asignaturas.creditos,Asignaturas.pr1, "
                . "Asignaturas.pr2,Asignaturas.pr3,Asignaturas.prhm, Asignaturas.ht, Asignaturas.hp, TipoAsignaturas.nombres AS tipo_asignatura, "
                . " AlumnosAsignaturasPre.tipo, AlumnosAsignaturasPre.activo, DocentesAsignaturas.observacion, "
                . " DocentesAsignaturas.docente, CONCAT(Docentes.nombres,' ',Docentes.apellidop,' ',Docentes.apellidom) AS docentename, DocentesAsignaturas.grupo")
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturasPre.asignatura')
            ->join('TipoAsignaturas', 'TipoAsignaturas.codigo = Asignaturas.tipo')
            ->join('DocentesAsignaturas', 'DocentesAsignaturas.asignatura = Asignaturas.codigo')
            ->join('AsignaturasSemestreCarreras', 'DocentesAsignaturas.asignatura = AsignaturasSemestreCarreras.asignatura '
                . 'AND DocentesAsignaturas.grupo = AsignaturasSemestreCarreras.grupo ')
            ->join('Docentes', 'Docentes.codigo = DocentesAsignaturas.docente')
            ->where("AlumnosAsignaturasPre.alumno='{$codigo_alumno}' AND AlumnosAsignaturasPre.semestre={$SemestreM->codigo}"
                . " AND DocentesAsignaturas.semestre={$SemestreM->codigo} AND DocentesAsignaturas.estado= 'A' "
                . "AND TipoAsignaturas.numero = 71 AND AsignaturasSemestreCarreras.carrera='{$Alumnos->carrera}' "
                . "AND AsignaturasSemestreCarreras.semestre={$SemestreM->codigo} ")
            ->orderBy('Asignaturas.ciclo ASC,  Asignaturas.codigo, DocentesAsignaturas.grupo')
        //->limit(7)
            ->getQuery()
            ->execute();

        $this->view->cursosdispo = $cursodispo;
        $this->view->totalcursos = count($cursodispo);

        $semestres = $this->modelsManager->createBuilder()
            ->from('AlumnosSemestre')
            ->columns('DISTINCT AlumnosSemestre.semestre, AlumnosSemestre.alumno, AlumnosSemestre.ciclo, AlumnosSemestre.creditos, '
                . 'AlumnosSemestre.promedio, Semestres.descripcion')
            ->join('Semestres', 'Semestres.codigo = AlumnosSemestre.semestre')
            ->where("AlumnosSemestre.alumno='{$codigo_alumno}' AND Semestres.codigo < {$SemestreM->codigo}")
            ->orderBy('AlumnosSemestre.semestre DESC')
            ->getQuery()
            ->execute();

        $cajaalumno = array();

        $sems = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturas')
            ->columns('DISTINCT AlumnosAsignaturas.semestre, AlumnosAsignaturas.alumno'
                . ', Semestres.descripcion')
            ->join('Semestres', 'Semestres.codigo = AlumnosAsignaturas.semestre')
        //->where("AlumnosSemestre.alumno='{$codigo_alumno}' AND Semestres.codigo < {$SemestreM->codigo} ")
            ->where("AlumnosAsignaturas.alumno='{$codigo_alumno}'  ")
            ->orderBy('AlumnosAsignaturas.semestre DESC')
            ->getQuery()
            ->execute();

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
        $this->assets->addJs("adminpanel/js/modulos/matricula.js?v=" . uniqid());
        //print_r($cajaalumno);exit();
        /* SELECT ca.codigo,con.descripcion,ca.fecha_emision,ca.fecha_pago,ca.cuota,ca.cantidad,ca.monto,ca.estado
        FROM caja as ca
        INNER JOIN conceptos as con ON con.codigo = ca.concepto
        WHERE alumno = '1261301106' */

        /* fin */
    }

    public function savematriculaAction()
    {
        //echo '<pre>';
        //print_r($Alumnos->carrera);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                // Asignamos la matricula al alumno seleccionado
                foreach ($_POST["codigocursos"] as $key => $value) {

                    $AlumnosAsignaturas = new AlumnosAsignaturas();
                    $AlumnosAsignaturas->semestre = (integer) $_POST["semestre"];
                    $AlumnosAsignaturas->asignatura = $value;
                    $AlumnosAsignaturas->grupo = (integer) $_POST["grupos"][$key];
                    $AlumnosAsignaturas->alumno = $_POST["codigoalumno"];
                    $AlumnosAsignaturas->tipo = 1; //pedido de mario
                    $AlumnosAsignaturas->veces = 1;
                    $AlumnosAsignaturas->pf = -1;
                    $AlumnosAsignaturas->cerrado = 0;
                    $AlumnosAsignaturas->estado = 'A';
                    $AlumnosAsignaturas->save();

                    $subgrupo = array(1, 2);
                    foreach ($subgrupo as $sg) {
                        $AlumnosAsignaturasDetalle = new AlumnosAsignaturasDetalle();
                        $AlumnosAsignaturasDetalle->semestre = $AlumnosAsignaturas->semestre;
                        $AlumnosAsignaturasDetalle->asignatura = $AlumnosAsignaturas->asignatura;
                        $AlumnosAsignaturasDetalle->grupo = $AlumnosAsignaturas->grupo;
                        $AlumnosAsignaturasDetalle->alumno = $AlumnosAsignaturas->alumno;
                        $AlumnosAsignaturasDetalle->subgrupo = $sg;
                        $AlumnosAsignaturasDetalle->modalidad = $sg;
                        $AlumnosAsignaturasDetalle->cerrado = $AlumnosAsignaturas->cerrado;
                        $AlumnosAsignaturasDetalle->estado = 'A';
                        $AlumnosAsignaturasDetalle->save();
                    }
                }

                $ciclo_alumno = $this->request->getPost("ciclo_alumno", "int");
                //alumnos semestre
                $SemestreM = Semestres::findFirst("activo = 'M'");

                $auth = $this->session->get('auth');
                $codigo_alumno = $auth["codigo"];

                $fecha_actual = date("Y-m-d");
                $db_update = $this->db;

                $sql_update_a_s = " UPDATE alumnos_semestre  SET ciclo = $ciclo_alumno, fecha_matricula = '{$fecha_actual}', matricula_realizada = '1' "
                    . "WHERE semestre = {$SemestreM->codigo} AND alumno = '{$codigo_alumno}' ";
                $db_update->fetchOne($sql_update_a_s, Phalcon\Db::FETCH_OBJ);

                //Cuando va bien
                $this->response->setStatusCode(200, "OK");
                $this->response->setJsonContent(array("say" => "yes"));
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //fichamatricula
    public function fichamatriculaAction()
    {

        $auth = $this->session->get('auth');

        $codigo_alumno = $auth["codigo"];
        $Alumnos = Alumnos::findFirstBycodigo($codigo_alumno);

        $Carreras = Carreras::findFirstBycodigo($Alumnos->carrera);

        $this->view->alumno = $Alumnos;
        $this->view->carrera = $Carreras;

        /* Calculamos el semestre actual */
        $SemestreM = Semestres::findFirst("activo = 'M'");

        $this->view->semestre = $SemestreM;
        /* fin semestre */

        $cursodispo = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturasPre')
            ->columns("AlumnosAsignaturasPre.semestre, AlumnosAsignaturasPre.alumno, AlumnosAsignaturasPre.asignatura, "
                . "Asignaturas.nombre, Asignaturas.ciclo, Asignaturas.creditos,Asignaturas.pr1, "
                . "Asignaturas.pr2,Asignaturas.pr3,Asignaturas.prhm, Asignaturas.ht, Asignaturas.hp, TipoAsignaturas.nombres AS tipo_asignatura, "
                . " AlumnosAsignaturasPre.tipo, AlumnosAsignaturasPre.activo, DocentesAsignaturas.observacion, "
                . " DocentesAsignaturas.docente, CONCAT(Docentes.nombres,' ',Docentes.apellidop,' ',Docentes.apellidom) AS docentename, DocentesAsignaturas.grupo")
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturasPre.asignatura')
            ->join('TipoAsignaturas', 'TipoAsignaturas.codigo = Asignaturas.tipo')
            ->join('DocentesAsignaturas', 'DocentesAsignaturas.asignatura = Asignaturas.codigo')
            ->join('Docentes', 'Docentes.codigo = DocentesAsignaturas.docente')
            ->where("AlumnosAsignaturasPre.alumno='{$codigo_alumno}' AND AlumnosAsignaturasPre.semestre={$SemestreM->codigo} AND DocentesAsignaturas.semestre={$SemestreM->codigo} AND DocentesAsignaturas.estado= 'A' AND TipoAsignaturas.numero = 71 ")
            ->orderBy('Asignaturas.ciclo ASC,  Asignaturas.codigo, DocentesAsignaturas.grupo')
            ->getQuery()
            ->execute();

        //print("Hola Mundo");exit();

        $this->view->cursosdispo = $cursodispo;
        $this->view->totalcursos = count($cursodispo);

        $notas_curso = $this->modelsManager->createBuilder()
            ->from('AlumnosAsignaturas')
            ->columns('DISTINCT AlumnosAsignaturas.asignatura ,AlumnosAsignaturas.semestre, AlumnosAsignaturas.asignatura, AlumnosAsignaturas.tipo, DocentesAsignaturas.observacion,
                           AlumnosAsignaturas.alumno,TipoMatricula.descripcion ,AlumnosAsignaturas.pf, Asignaturas.nombre, Asignaturas.creditos, Asignaturas.ciclo, AlumnosAsignaturas.grupo,
                           TipoMatricula.nombres AS tipo_matricula')
            ->join('Asignaturas', 'Asignaturas.codigo = AlumnosAsignaturas.asignatura')
            ->join('TipoMatricula', 'TipoMatricula.codigo = AlumnosAsignaturas.tipo')
            ->join('DocentesAsignaturas', 'Asignaturas.codigo = DocentesAsignaturas.asignatura AND DocentesAsignaturas.grupo = AlumnosAsignaturas.grupo')
            ->where("AlumnosAsignaturas.alumno='{$codigo_alumno}' AND  AlumnosAsignaturas.semestre = {$SemestreM->codigo} AND TipoMatricula.numero = 9 AND DocentesAsignaturas.semestre = {$SemestreM->codigo} AND AlumnosAsignaturas.tipo <> 2 AND AlumnosAsignaturas.tipo <> 5 AND AlumnosAsignaturas.tipo <> 9")
            ->orderBy('Asignaturas.ciclo ASC,  AlumnosAsignaturas.asignatura')
            ->getQuery()
            ->execute();

        $total = count($notas_curso);
        $this->view->cursos = $notas_curso;
        $this->view->total = $total;

        $AlumnosSemestreM = AlumnosSemestre::findFirst("semestre = {$SemestreM->codigo} AND alumno='{$codigo_alumno}' ");
        $ciclo_corresponde = $AlumnosSemestreM->ciclo;

        $this->view->ciclo = $ciclo_corresponde;
        $credi = $credinfo[$ciclo_corresponde];
        $this->view->creditosciclo = $credi;
        /* fin de calculo */
    }

    public function requisitosAction()
    {
        $SemestreM = Semestres::findFirst("activo = 'M'");
        $semestre_p = Semestres::findFirst("activo = 'P'");
        $auth = $this->session->get('auth');
        $codigo_alumno = $auth["codigo"];

        $AlumnosSemestreM = AlumnosSemestre::findFirst("semestre = {$SemestreM->codigo} AND alumno='{$codigo_alumno}' ");
        $AlumnosSemestreP = AlumnosSemestre::findFirst("semestre = {$semestre_p->codigo} AND alumno='{$codigo_alumno}' ");
//        echo '<pre>';
        //        print_r($AlumnosSemestre->registros_academicos);
        //        exit();
        $this->view->registros_academicos = $AlumnosSemestreM->registros_academicos;
        $this->view->servicio_salud = $AlumnosSemestreM->servicio_salud;
        $this->view->servicio_social = $AlumnosSemestreM->servicio_social;
        $this->view->servicio_psicopedagogico = $AlumnosSemestreM->servicio_psicopedagogico;
        $this->view->servicio_deportivo = $AlumnosSemestreM->servicio_deportivo;
        $this->view->servicio_cultural = $AlumnosSemestreM->servicio_cultural;
        $this->view->promedio = $AlumnosSemestreM->promedio;
        $this->view->voucher = $AlumnosSemestreM->voucher;
        $this->view->resolucion_matricula_especial = $AlumnosSemestreM->resolucion_matricula_especial;
        $this->view->promedio_anterior = $AlumnosSemestreP->promedio;

        $this->view->promedio = $AlumnosSemestreP->promedio;
    }

}
