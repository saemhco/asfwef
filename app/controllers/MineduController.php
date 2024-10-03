<?php

class MineduController extends ControllerPanel {

    public function initialize() {
        $this->tag->setTitle('ADMIN');
        parent::initialize();
    }

    public function indexAction() {
      
    }

    public function reportesAction(){

    }

    public function siriesdocentesAction(){
        //$this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siries_docentes_2020.xls");  
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);

        $data = VSiriesDocentes::find();
        $test="<table border='1'>";
            $test.="<tr>";
                $test.="<td>TIPO DE DOCUMENTO</td>";
                $test.="<td>N. DOCUMENTO</td>";
                $test.="<td>APELLIDO PATERNO</td>";
                $test.="<td>APELIIDO MATERNO</td>";
                $test.="<td>NOMBRES</td>";
                $test.="<td>GENERO</td>";
                $test.="<td>FECHA DE NACIMIENTO</td>";
                $test.="<td>PERIODO</td>";
                $test.="<td>TIPO DE DEPENDENCIA</td>";
                $test.="<td>DEPENDENCIA</td>";
                $test.="<td>FACULTAD</td>";
                $test.="<td>CARRERA</td>";
                $test.="<td>PERSONAL ACADEMICO</td>";
                $test.="<td>CARGO GENERAL</td>";
                $test.="<td>DESCRIPCION DEL CARGO</td>";
                $test.="<td>GRADO O TITULO ALCANZADO</td>";
                $test.="<td>DESCRIPCION GRADO ACADEMICO</td>";
                $test.="<td>UNIVERSIDAD OBTENCION GRADO ACADEMICO</td>";
                $test.="<td>LUGAR GRADO OBTENIDO</td>";
                $test.="<td>PAIS GRADO OBTENIDO</td>";
                $test.="<td>CLASE CONDICION DOCENTE</td>";
                $test.="<td>CATEGORIA DOCENTE</td>";
                $test.="<td>REGIMEN DEDICACION</td>";
                $test.="<td>INVESTIGADOR</td>";
                $test.="<td>PREGRADO</td>";
                $test.="<td>POSGRADO</td>";
                $test.="<td>HORAS LECTIVAS</td>";
                $test.="<td>HORAS NO LECTIVAS</td>";
                $test.="<td>HORAS DEDICACION SEMANAL</td>";
                $test.="<td>FECHA INGRESO</td>";
                $test.="<td>IDENTIDAD ETNICA</td>";
                $test.="<td>CORREO INSTITUCIONAL</td>";
                $test.="<td>CORREO PERSONAL</td>";
                $test.="<td>TELEFONO</td>";
                $test.="<td>CELULAR</td>";
            $test.="</tr>";
            foreach ($data as $key => $value) {
                $test.="<tr>";
                    $test.="<td>".utf8_decode($value->tipo_de_documento)."</td>";
                    $test.="<td>".utf8_decode($value->numero_de_documento)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_paterno)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_materno)."</td>";
                    $test.="<td>".utf8_decode($value->nombres)."</td>";
                    $test.="<td>".utf8_decode($value->genero)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_nacimiento)."</td>";
                    $test.="<td>".utf8_decode($value->periodo)."</td>";
                    $test.="<td>".utf8_decode($value->tipo_de_dependencia)."</td>";
                    $test.="<td>".utf8_decode($value->dependencia)."</td>";
                    $test.="<td>".utf8_decode($value->facultad)."</td>";
                    $test.="<td>".utf8_decode($value->carrera)."</td>";
                    $test.="<td>".utf8_decode($value->personal_academico)."</td>";
                    $test.="<td>".utf8_decode($value->cargo_general)."</td>";
                    $test.="<td>".utf8_decode($value->descripcion_del_cargo)."</td>";
                    $test.="<td>".utf8_decode($value->grado_o_titulo_alcanzado)."</td>";
                    $test.="<td>".utf8_decode($value->descripcion_grado_academico)."</td>";
                    $test.="<td>".utf8_decode($value->universidad_obtencion_grado_academico)."</td>";
                    $test.="<td>".utf8_decode($value->lugar_grado_obtenido)."</td>";
                    $test.="<td>".utf8_decode($value->pais_grado_obtenido)."</td>";
                    $test.="<td>".utf8_decode($value->clase_condicion_docente)."</td>";
                    $test.="<td>".utf8_decode($value->categoria_docente)."</td>";
                    $test.="<td>".utf8_decode($value->regimen_dedicacion)."</td>";
                    $test.="<td>".utf8_decode($value->investigador)."</td>";
                    $test.="<td>".utf8_decode($value->pregrado)."</td>";
                    $test.="<td>".utf8_decode($value->posgrado)."</td>";
                    $test.="<td>".utf8_decode($value->horas_lectivas)."</td>";
                    $test.="<td>".utf8_decode($value->horas_no_lectivas)."</td>";
                    $test.="<td>".utf8_decode($value->horas_dedicacion_semanal)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_ingreso)."</td>";
                    $test.="<td>".utf8_decode($value->identidad_etnica)."</td>";
                    $test.="<td>".utf8_decode($value->correo_institucional)."</td>";
                    $test.="<td>".utf8_decode($value->correo_personal)."</td>";
                    $test.="<td>".utf8_decode($value->telefono)."</td>";
                    $test.="<td>".utf8_decode($value->celular)."</td>";
                $test.="</tr>";
            }
        $test.="</table>";
        print $test;
        exit();
    }
    
    public function siriesadministrativosAction(){
        //$this->view->disable();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siries_administrativos_2020.xls");  
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $data = VSiriesAdministrativos::find();
        $test="<table border='1'>";
            $test.="<tr>";
                $test.="<td>TIPO DE DOCUMENTO</td>";                
                $test.="<td>NUMERO_DE_DOCUMENTO</td>";
                $test.="<td>APELLIDO_PATERNO</td>";
                $test.="<td>APELLIDO_MATERNO</td>";
                $test.="<td>NOMBRES</td>";
                $test.="<td>GENERO</td>";
                $test.="<td>FECHA_DE_NACIMIENTO</td>";
                $test.="<td>LOCAL</td>";
                $test.="<td>TIPO_DE_DEPENDENCIA</td>";
                $test.="<td>DEPENDENCIA</td>";
                $test.="<td>FACULTAD</td>";
                $test.="<td>CARRERA</td>";
                $test.="<td>CARGO_GENERAL</td>";
                $test.="<td>DESCRIPCION_DE_CARGO</td>";
                $test.="<td>MAXIMO_GRADO_ACADEMICO</td>";
                $test.="<td>DESCRIPCION_DE_GRADO_ACADEMICO</td>";
                $test.="<td>CONDICION_LABORAL</td>";
                $test.="<td>REGIMEN_LABORAL</td>";
                $test.="<td>FECHA_DE_INGRESO_A_IE</td>";
                $test.="<td>FECHA_DE_INICIO_DE_CONTRATO</td>";
                $test.="<td>FECHA_DE_FIN_DE_CONTRATO</td>";
                $test.="<td>CATEGORIA_LABORAL</td>";
            $test.="</tr>";
            foreach ($data as $key => $value) {
                $test.="<tr>";
                    $test.="<td>".utf8_decode($value->tipo_de_documento)."</td>";                    
                    $test.="<td>".utf8_decode($value->numero_de_documento)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_paterno)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_materno)."</td>";
                    $test.="<td>".utf8_decode($value->nombres)."</td>";
                    $test.="<td>".utf8_decode($value->genero)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_nacimiento)."</td>";
                    $test.="<td>".utf8_decode($value->local)."</td>";
                    $test.="<td>".utf8_decode($value->tipo_de_dependencia)."</td>";
                    $test.="<td>".utf8_decode($value->dependencia)."</td>";
                    $test.="<td>".utf8_decode($value->facultad)."</td>";
                    $test.="<td>".utf8_decode($value->carrera)."</td>";
                    $test.="<td>".utf8_decode($value->cargo_general)."</td>";
                    $test.="<td>".utf8_decode($value->descripcion_de_cargo)."</td>";
                    $test.="<td>".utf8_decode($value->maximo_grado_academico)."</td>";
                    $test.="<td>".utf8_decode($value->descripcion_de_grado_academico)."</td>";
                    $test.="<td>".utf8_decode($value->condicion_laboral)."</td>";
                    $test.="<td>".utf8_decode($value->regimen_laboral)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_ingreso_a_ie)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_inicio_de_contrato)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_fin_de_contrato)."</td>";
                    $test.="<td>".utf8_decode($value->categoria_laboral)."</td>";
                $test.="</tr>";
            }
        $test.="</table>";
        print $test;
        exit();
    }
    
    public function siriespostulantesAction(){
        //$this->view->disable();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siries_postulantes_2020.xls");  
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $data = VSiriesPostulantes::find();
        $test="<table border='1'>";
            $test.="<tr>";
                $test.="<td>TIPO DE DOCUMENTO</td>";
                $test.="<td>NUMERO_DE_DOCUMENTO</td>";
                $test.="<td>APELLIDO_PATERNO</td>";
                $test.="<td>APELLIDO_MATERNO</td>";
                $test.="<td>NOMBRES</td>";
                $test.="<td>GENERO</td>";
                $test.="<td>FECHA_DE_NACIMIENTO</td>";
                $test.="<td>DISCAPACIDAD</td>";
                $test.="<td>TIPO_DE_DISCAPACIDAD</td>";
                $test.="<td>PERIODO_DE_MATRICULA</td>";
                $test.="<td>CARRERA</td>";
                $test.="<td>LOCAL</td>";
                $test.="<td>ESCALA_DE_PAGO</td>";
                $test.="<td>NOTA_PROMEDIO_PONDERADO</td>";
                $test.="<td>PERIODO_DE_INGRESO</td>";
                $test.="<td>PRIMER_PERIODO_MATRICULA</td>";
                $test.="<td>MOVILIDAD</td>";
                $test.="<td>IDENTIDAD_ETNICA</td>";
                $test.="<td>CORREO_INSTITUCIONAL</td>";
                $test.="<td>CORREO_PERSONAL</td>";
                $test.="<td>TELEFONO</td>";
                $test.="<td>CELULAR</td>";
                $test.="<td>MODALIDAD_DE_ESTUDIOS</td>";                
            $test.="</tr>";
            foreach ($data as $key => $value) {
                $test.="<tr>";
                    $test.="<td>".utf8_decode($value->tipo_de_documento)."</td>";                    
                    $test.="<td>".utf8_decode($value->numero_de_documento)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_paterno)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_materno)."</td>";
                    $test.="<td>".utf8_decode($value->nombres)."</td>";
                    $test.="<td>".utf8_decode($value->genero)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_nacimiento)."</td>";
                    $test.="<td>".utf8_decode($value->discapacidad)."</td>";
                    $test.="<td>".utf8_decode($value->tipo_de_discapacidad)."</td>";
                    $test.="<td>".utf8_decode($value->periodo_de_matricula)."</td>";
                    $test.="<td>".utf8_decode($value->local)."</td>";
                    $test.="<td>".utf8_decode($value->carrera)."</td>";
                    $test.="<td>".utf8_decode($value->escala_de_pago)."</td>";
                    $test.="<td>".utf8_decode($value->nota_promedio_ponderado)."</td>";
                    $test.="<td>".utf8_decode($value->periodo_de_ingreso)."</td>";
                    $test.="<td>".utf8_decode($value->primer_periodo_matricula)."</td>";
                    $test.="<td>".utf8_decode($value->movilidad)."</td>";
                    $test.="<td>".utf8_decode($value->identidad_etnica)."</td>";
                    $test.="<td>".utf8_decode($value->correo_institucional)."</td>";
                    $test.="<td>".utf8_decode($value->correo_personal)."</td>";
                    $test.="<td>".utf8_decode($value->telefono)."</td>";
                    $test.="<td>".utf8_decode($value->celular)."</td>";
                    $test.="<td>".utf8_decode($value->modalidad_de_estudios)."</td>";
                $test.="</tr>";
            }
        $test.="</table>";
        print $test;
        exit();
    }
    public function siriesmatriculadosAction(){
        //$this->view->disable();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siries_matriculados_2020.xls");  
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);

        $data = VSiriesMatriculados::find();
        $test="<table border='1'>";
            $test.="<tr>";
                $test.="<td>TIPO DE DOCUMENTO</td>";
                $test.="<td>NUMERO_DE_DOCUMENTO</td>";
                $test.="<td>APELLIDO_PATERNO</td>";
                $test.="<td>APELLIDO_MATERNO</td>";
                $test.="<td>NOMBRES</td>";
                $test.="<td>GENERO</td>";
                $test.="<td>FECHA_DE_NACIMIENTO</td>";
                $test.="<td>DISCAPACIDAD</td>";
                $test.="<td>TIPO_DE_DISCAPACIDAD</td>";
                $test.="<td>PERIODO_DE_MATRICULA</td>";
                $test.="<td>CARRERA</td>";
                $test.="<td>LOCAL</td>";
                $test.="<td>ESCALA_DE_PAGO</td>";
                $test.="<td>NOTA_PROMEDIO_PONDERADO</td>";
                $test.="<td>PERIODO_DE_INGRESO</td>";
                $test.="<td>PRIMER_PERIODO_MATRICULA</td>";
                $test.="<td>MOVILIDAD</td>";
                $test.="<td>IDENTIDAD_ETNICA</td>";
                $test.="<td>CORREO_INSTITUCIONAL</td>";
                $test.="<td>CORREO_PERSONAL</td>";
                $test.="<td>TELEFONO</td>";
                $test.="<td>CELULAR</td>";
                $test.="<td>MODALIDAD_DE_ESTUDIOS</td>";  
                $test.="<td>CREDITOS</td>";   
                $test.="<td>CREDITOS ACUMULADOS</td>";             
            $test.="</tr>";
            foreach ($data as $key => $value) {
                $test.="<tr>";
                    $test.="<td>".utf8_decode($value->tipo_de_documento)."</td>";                    
                    $test.="<td>".utf8_decode($value->numero_de_documento)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_paterno)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_materno)."</td>";
                    $test.="<td>".utf8_decode($value->nombres)."</td>";
                    $test.="<td>".utf8_decode($value->genero)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_nacimiento)."</td>";
                    $test.="<td>".utf8_decode($value->discapacidad)."</td>";
                    $test.="<td>".utf8_decode($value->tipo_de_discapacidad)."</td>";
                    $test.="<td>".utf8_decode($value->periodo_de_matricula)."</td>";
                    $test.="<td>".utf8_decode($value->local)."</td>";
                    $test.="<td>".utf8_decode($value->carrera)."</td>";
                    $test.="<td>".utf8_decode($value->escala_de_pago)."</td>";
                    $test.="<td>".utf8_decode($value->nota_promedio_ponderado)."</td>";
                    $test.="<td>".utf8_decode($value->periodo_de_ingreso)."</td>";
                    $test.="<td>".utf8_decode($value->primer_periodo_matricula)."</td>";
                    $test.="<td>".utf8_decode($value->movilidad)."</td>";
                    $test.="<td>".utf8_decode($value->identidad_etnica)."</td>";
                    $test.="<td>".utf8_decode($value->correo_institucional)."</td>";
                    $test.="<td>".utf8_decode($value->correo_personal)."</td>";
                    $test.="<td>".utf8_decode($value->telefono)."</td>";
                    $test.="<td>".utf8_decode($value->celular)."</td>";
                    $test.="<td>".utf8_decode($value->modalidad_de_estudios)."</td>";
                    $test.="<td>".utf8_decode($value->creditos)."</td>";
                    $test.="<td>".utf8_decode($value->creditos_acumulado)."</td>";
                $test.="</tr>";
            }
        $test.="</table>";
        print $test;
        exit();
    }
    public function siriesegresadosAction(){
        //$this->view->disable();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=siries_egresados_2020.xls");  
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $data = VSiriesEgresados::find();
        $test="<table border='1'>";
            $test.="<tr>";
                $test.="<td>TIPO DE DOCUMENTO</td>";
                $test.="<td>NUMERO_DE_DOCUMENTO</td>";
                $test.="<td>APELLIDO_PATERNO</td>";
                $test.="<td>APELLIDO_MATERNO</td>";
                $test.="<td>NOMBRES</td>";
                $test.="<td>GENERO</td>";
                $test.="<td>FECHA_DE_NACIMIENTO</td>";
                $test.="<td>DISCAPACIDAD</td>";
                $test.="<td>TIPO_DE_DISCAPACIDAD</td>";
                $test.="<td>PERIODO_DE_MATRICULA</td>";
                $test.="<td>CARRERA</td>";
                $test.="<td>LOCAL</td>";
                $test.="<td>ESCALA_DE_PAGO</td>";
                $test.="<td>NOTA_PROMEDIO_PONDERADO</td>";
                $test.="<td>PERIODO_DE_INGRESO</td>";
                $test.="<td>PRIMER_PERIODO_MATRICULA</td>";
                $test.="<td>MOVILIDAD</td>";
                $test.="<td>IDENTIDAD_ETNICA</td>";
                $test.="<td>CORREO_INSTITUCIONAL</td>";
                $test.="<td>CORREO_PERSONAL</td>";
                $test.="<td>TELEFONO</td>";
                $test.="<td>CELULAR</td>";
                $test.="<td>MODALIDAD_DE_ESTUDIOS</td>";                
            $test.="</tr>";
            foreach ($data as $key => $value) {
                $test.="<tr>";
                    $test.="<td>".utf8_decode($value->tipo_de_documento)."</td>";                    
                    $test.="<td>".utf8_decode($value->numero_de_documento)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_paterno)."</td>";
                    $test.="<td>".utf8_decode($value->apellido_materno)."</td>";
                    $test.="<td>".utf8_decode($value->nombres)."</td>";
                    $test.="<td>".utf8_decode($value->genero)."</td>";
                    $test.="<td>".utf8_decode($value->fecha_de_nacimiento)."</td>";
                    $test.="<td>".utf8_decode($value->discapacidad)."</td>";
                    $test.="<td>".utf8_decode($value->tipo_de_discapacidad)."</td>";
                    $test.="<td>".utf8_decode($value->periodo_de_matricula)."</td>";
                    $test.="<td>".utf8_decode($value->local)."</td>";
                    $test.="<td>".utf8_decode($value->carrera)."</td>";
                    $test.="<td>".utf8_decode($value->escala_de_pago)."</td>";
                    $test.="<td>".utf8_decode($value->nota_promedio_ponderado)."</td>";
                    $test.="<td>".utf8_decode($value->periodo_de_ingreso)."</td>";
                    $test.="<td>".utf8_decode($value->primer_periodo_matricula)."</td>";
                    $test.="<td>".utf8_decode($value->movilidad)."</td>";
                    $test.="<td>".utf8_decode($value->identidad_etnica)."</td>";
                    $test.="<td>".utf8_decode($value->correo_institucional)."</td>";
                    $test.="<td>".utf8_decode($value->correo_personal)."</td>";
                    $test.="<td>".utf8_decode($value->telefono)."</td>";
                    $test.="<td>".utf8_decode($value->celular)."</td>";
                    $test.="<td>".utf8_decode($value->modalidad_de_estudios)."</td>";
                $test.="</tr>";
            }
        $test.="</table>";
        print $test;
        exit();
    }
}
