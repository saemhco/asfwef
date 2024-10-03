<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Registros extends Component {

 

    public function getHoraAmbienteTurno($semestre,$hora_id,$ambiente_id,$turno_id,$dia){
        $db = $this->db;
        $string = "";
        if ($ambiente_id) {
           $where = " ambiente = {$ambiente_id} AND h.hora = {$hora_id} AND h.dia = {$dia} AND mod.numero = 55 ";
           if($turno_id != "0"){
              $where = $where." AND ho.turno = {$turno_id} ";
           }

           $select = "  SELECT 
                        h.semestre, h.ambiente, h.dia, h.hora, h.asignatura, asig.nombre , asig.ciclo, curr.descripcion,curr.abreviatura,
                        h.grupo, h.subgrupo, h.modalidad, h.estado, ho.turno, mod.nombres
                        FROM horarios h 
                        INNER JOIN asignaturas asig ON  asig.codigo = h.asignatura
                        INNER JOIN curriculas curr ON curr.codigo = asig.curricula
                        INNER JOIN horas ho ON ho.codigo = h.hora
                        INNER JOIN a_codigos mod ON mod.codigo = h.modalidad
                        WHERE h.semestre={$semestre} AND $where ";

            //print $select;

            $resultados = $db->fetchOne($select, Phalcon\Db::FETCH_OBJ);

            

            if($resultados){

                $docente = $selct_docente = " 
                    SELECT dad.semestre, dad.asignatura, dad.grupo, doc.apellidop, doc.apellidom, doc.nombres
                    FROM docentes_asignaturas_detalle dad
                    INNER JOIN docentes doc ON doc.codigo = dad.docente
                    WHERE dad.estado = 'A' AND dad.semestre = {$semestre} AND dad.asignatura='{$resultados->asignatura}' AND dad.grupo = {$resultados->grupo}
                 ";

                $docp= $db->fetchOne($docente, Phalcon\Db::FETCH_OBJ);

                $string = $string."<span class='label label-info' style='white-space: normal !important;font-size:58% !important;'>{$resultados->abreviatura}</span><br>";
                $string = $string."<span class='label label-primary' style='white-space: normal !important;font-size:58% !important;'>{$resultados->nombre}</span><br>";
                $string = $string."<span class='label label-danger' style='white-space: normal !important;font-size:58% !important;'>GRUPO: {$resultados->grupo} - {$resultados->subgrupo}</span>&nbsp;&nbsp;";
                $string = $string."<span class='label label-warning' style='white-space: normal !important;font-size:58% !important;'> {$resultados->nombres} </span><br>";
                $string = $string."<span class='label label-success' style='white-space: normal !important;font-size:50% !important;'>{$docp->nombres}  {$docp->apellidop} {$docp->apellidom} </span>";
            }

        }

        return $string;
    }

     public function getHoraDocenteTurno($semestre,$hora_id,$docente_id,$turno_id,$dia){
        //print("Semestre:".$semestre." - Hora:".$hora_id." - Docente:".$docente_id." - Turno:".$turno_id." - Dia:".$dia);
        //exit();
         
        $db = $this->db;
        $string = "";
        if ($docente_id) {
           $where = " dad.docente = {$docente_id} AND h.hora = {$hora_id} AND h.dia = {$dia} AND mod.numero = 55 AND 
                     dad.semestre = {$semestre} AND dad.asignatura = h.asignatura AND dad.grupo = h.grupo ";
           if($turno_id != "0"){
              $where = $where." AND ho.turno = {$turno_id} ";
           }

           $select = "  SELECT  h.semestre,am.descripcion as desc_ambiente, h.ambiente, h.dia, h.hora, h.asignatura, asig.nombre , asig.ciclo, curr.descripcion,
                        curr.abreviatura, h.grupo, h.subgrupo, h.modalidad, h.estado, ho.turno, mod.nombres, dad.docente 
                        FROM horarios h 
                        INNER JOIN asignaturas asig ON asig.codigo = h.asignatura 
                        INNER JOIN curriculas curr ON curr.codigo = asig.curricula 
                        INNER JOIN horas ho ON ho.codigo = h.hora 
                        INNER JOIN a_codigos mod ON mod.codigo = h.modalidad 
                        INNER JOIN ambientes am ON am.codigo = h.ambiente
                        INNER JOIN docentes_asignaturas_detalle dad ON dad.asignatura = h.asignatura

                        WHERE h.semestre= {$semestre} AND $where
                               LIMIT 1";

          //  print $select; 

            $resultados = $db->fetchOne($select, Phalcon\Db::FETCH_OBJ);

            

            if($resultados){

                $string = $string."<span class='label label-info' style='white-space: normal !important;font-size:58% !important;'>{$resultados->abreviatura}</span><br>";
                $string = $string."<span class='label label-primary' style='white-space: normal !important;font-size:58% !important;'>{$resultados->nombre}</span><br>";
                $string = $string."<span class='label label-danger' style='white-space: normal !important;font-size:58% !important;'>GRUPO: {$resultados->grupo} - {$resultados->subgrupo}</span>&nbsp;&nbsp;";
                $string = $string."<span class='label label-warning' style='white-space: normal !important;font-size:58% !important;'> {$resultados->nombres} </span><br>";
                $string = $string."<span class='label label-success' style='white-space: normal !important;font-size:50% !important;'>{$resultados->desc_ambiente } </span>";
            }

        }

        return $string;
    }

    public function getHoraAsignaturaTurno($semestre,$hora_id,$asignatura_id,$turno_id,$dia){
//        print("Semestre:".$semestre." - Hora:".$hora_id." - Asignatura:".$asignatura_id." - Turno:".$turno_id." - Dia:".$dia);
//        exit();
         
        $db = $this->db;
        $string = "";
        if ($asignatura_id) {
           $where = " dad.asignatura = '{$asignatura_id}' AND h.hora = {$hora_id} AND h.dia = {$dia} AND mod.numero = 55 AND 
                     dad.semestre = {$semestre} AND dad.docente = doc.codigo AND dad.grupo = h.grupo ";
           if($turno_id != "0"){
              $where = $where." AND ho.turno = {$turno_id} ";
           }

           $select = "  SELECT  h.semestre,am.descripcion as desc_ambiente, h.ambiente, h.dia, h.hora, h.asignatura, asig.nombre , asig.ciclo, curr.descripcion,
                        curr.abreviatura, h.grupo, h.subgrupo, h.modalidad, h.estado, ho.turno, mod.nombres, dad.docente ,doc.apellidop, doc.apellidom, doc.nombres as nombres_doc
                        FROM horarios h 
                        INNER JOIN asignaturas asig ON asig.codigo = h.asignatura 
                        INNER JOIN curriculas curr ON curr.codigo = asig.curricula 
                        INNER JOIN horas ho ON ho.codigo = h.hora 
                        INNER JOIN a_codigos mod ON mod.codigo = h.modalidad 
                        INNER JOIN ambientes am ON am.codigo = h.ambiente
                        INNER JOIN docentes_asignaturas_detalle dad ON dad.asignatura = h.asignatura
                        INNER JOIN docentes doc ON doc.codigo = dad.docente
                        WHERE h.semestre= {$semestre} AND $where
                               LIMIT 1";

            //print $select; 

            $resultados = $db->fetchOne($select, Phalcon\Db::FETCH_OBJ);

            

            if($resultados){

                $string = $string."<span class='label label-success' style='white-space: normal !important;font-size:50% !important;'>{$resultados->desc_ambiente } </span><br>";

                $string = $string."<span class='label label-info' style='white-space: normal !important;font-size:58% !important;'>{$resultados->abreviatura}</span><br>";
               // $string = $string."<span class='label label-primary' style='white-space: normal !important;font-size:58% !important;'>{$resultados->nombre}</span><br>";
                $string = $string."<span class='label label-danger' style='white-space: normal !important;font-size:58% !important;'>GRUPO: {$resultados->grupo} - {$resultados->subgrupo}</span>&nbsp;&nbsp;";
                $string = $string."<span class='label label-warning' style='white-space: normal !important;font-size:58% !important;'> {$resultados->nombres} </span><br>";
                

                $string = $string."<span class='label label-success' style='white-space: normal !important;font-size:50% !important;'>{$resultados->nombres_doc}  {$resultados->apellidop} {$resultados->apellidom} </span>";
            }

        }

        return $string;
    }


    public function getHoraAlumnoTurno($semestre,$hora_id,$alumno_id,$turno_id,$dia){
        //print("Semestre:".$semestre." - Hora:".$hora_id." - Docente:".$docente_id." - Turno:".$turno_id." - Dia:".$dia);
        //exit();
         
        $db = $this->db;
        $string = "";
        if ($alumno_id) {
           $where = " dad.alumno = '{$alumno_id}' AND h.hora = {$hora_id} AND h.dia = {$dia} AND  doad.docente = doc.codigo AND
                     dad.semestre = {$semestre} AND dad.asignatura = h.asignatura AND dad.grupo = h.grupo ";
           if($turno_id != "0"){
              $where = $where." AND ho.turno = {$turno_id} ";
           }

           $select = "  SELECT  h.semestre,am.descripcion as desc_ambiente, h.ambiente, h.dia, h.hora, h.asignatura, asig.nombre , asig.ciclo, curr.descripcion,
                        curr.abreviatura, h.grupo, h.subgrupo, h.estado, ho.turno, dad.alumno , doad.docente ,doc.apellidop, doc.apellidom, doc.nombres as nombres_doc
                        FROM horarios h 
                        INNER JOIN asignaturas asig ON asig.codigo = h.asignatura 
                        INNER JOIN curriculas curr ON curr.codigo = asig.curricula 
                        INNER JOIN horas ho ON ho.codigo = h.hora 
                        INNER JOIN ambientes am ON am.codigo = h.ambiente
                        INNER JOIN alumnos_asignaturas_detalle dad ON dad.asignatura = h.asignatura

                        INNER JOIN docentes_asignaturas_detalle doad ON doad.asignatura = h.asignatura
                        INNER JOIN docentes doc ON doc.codigo = doad.docente

                        WHERE h.semestre= {$semestre} AND $where
                               LIMIT 1";

            //print $select; exit();

            $resultados = $db->fetchOne($select, Phalcon\Db::FETCH_OBJ);

            

            if($resultados){

                $string = $string."<span class='label label-info' style='white-space: normal !important;font-size:58% !important;'>{$resultados->abreviatura}</span><br>";
                $string = $string."<span class='label label-primary' style='white-space: normal !important;font-size:58% !important;'>{$resultados->nombre}</span><br>";
                $string = $string."<span class='label label-danger' style='white-space: normal !important;font-size:58% !important;'>GRUPO: {$resultados->grupo} - {$resultados->subgrupo}</span>&nbsp;&nbsp;";
                $string = $string."<span class='label label-success' style='white-space: normal !important;font-size:50% !important;'>{$resultados->desc_ambiente } </span><br>";

                $string = $string."<span class='label label-success' style='white-space: normal !important;font-size:50% !important;'>{$resultados->nombres_doc}  {$resultados->apellidop} {$resultados->apellidom} </span>";
            }

        }

        return $string;
    }
    
}
