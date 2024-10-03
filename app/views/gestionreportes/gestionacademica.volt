<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Gestion Reportes</li>
        <li>Reportes Generales</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Reportes Generales</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body">
                                    <form id="5" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-lg-12 selectContainer">
                                                <select class="form-control" id="semestre">

                                                    {% for s in semestres %}
                                                    {% if s.codigo == semestrea %}
                                                    <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                    {% else %}
                                                    <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                    {% endif %}
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="6" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Alumnos
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_ficha_registro();"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_ficha_registro"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ficha de
                                                        Registro</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/FICHA_REGISTRO_ESTUDIANTE.pdf"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_ficha_registro"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ficha de
                                                        Registro</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_ficha_matricula();"
                                                        style="background-color: #C0C0FF;color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Ficha
                                                        de Matrícula</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        onclick="reporte_boleta_notas();" id="reporte_boleta_notas"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Boleta de
                                                        Notas</a>
                                                    -->

                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/BOLETA_NOTAS.pdf"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_ficha_registro"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Boleta de
                                                            Notas</a>

                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        href="javascript:void(0);" onclick="reporte_notas_promedio();"
                                                        id="reporte_notas_promedio"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Notas
                                                        Promedio</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/BOLETA_NOTAS_PROMEDIO.pdf"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_ficha_registro"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Boleta de
                                                            Notas Promedio</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                   <!--
                                                    <a class="btn btn-block"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        href="javascript:void(0);"
                                                        onclick="reporte_nro_alumnos_asigantura();"
                                                        id="reporte_nro_alumnos_asigantura"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Nro Alumnos /
                                                        Asignatura</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/AlumnosAsignatura-UNCA.pdf"
                                                    style="background-color: #C0C0FF;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Nro Alumnos /
                                                        Asignatura</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        href="javascript:void(0);" onclick="reporte_record_academico();"
                                                        id="reporte_record_academico"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Récord
                                                        Académico</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/RecordAcademico-UNCA.pdf"
                                                    style="background-color: #C0C0FF;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Récord
                                                        Académico</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>


                                    <form id="togglingForm4" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Docentes
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_ficha_registro_docentes();"
                                                        id="reporte_ficha_registro_docentes"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ficha de
                                                        Registro</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/FichaDocente-UNCA.pdf"
                                                    style="background-color: #FFFFC0;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ficha Docente</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_horarios();" id="reporte_horarios"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Horarios</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/HorarioDocente-UNCA.pdf"
                                                    style="background-color: #FFFFC0;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Horarios</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;"
                                                        onclick="reporte_carga_lectiva();"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Carga
                                                        Lectiva</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/CargaLectiva-UNCA.pdf"
                                                    style="background-color: #FFFFC0;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Carga
                                                        Lectiva</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_cargar_lectiva_alumnos();" id="reporte_cargar_lectiva_alumnos"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Carga Lectiva
                                                        / Alumnos</a>
                                                    -->
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/CargaLectivaAlumnos-UNCA.pdf"
                                                    style="background-color: #FFFFC0;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Carga Lectiva
                                                        / Alumnos</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_registro_auxiliar();" id="reporte_registro_auxiliar"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Registro
                                                        Auxiliar</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;"  onclick="reporte_registro_notas_1();" id="reporte_registro_notas_1"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Registro de
                                                        Notas 1</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;"  onclick="reporte_registro_notas();" id="reporte_registro_notas"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Registro de
                                                        Notas</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_actas_notas_finales();" id="reporte_actas_notas_finales"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Actas de
                                                        Notas Finales</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_encuesta_satisfaccion_docente();" id="reporte_encuesta_satisfaccion_docente"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Encuesta
                                                        Satisfacción Docente</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_encuesta_satisfaccion_docente_a();" id="reporte_encuesta_satisfaccion_docente_a"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Encuesta
                                                        Satisfacción Docente A.</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>

                                    <form id="1" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Registros Académicos
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" 
                                                        onclick="reporte_relacion_alumnos_matriculados();" id="reporte_relacion_alumnos_matriculados"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Relación
                                                        Alumnos Matriculados</a>
                                                    

                                                    <!--
                                                    <a target="_blank" class="btn btn-block" href="../adminpanel/archivos/reportes/EstudiantesMatriculados-UNCA.pdf"
                                                    style="background-color: #FFE0C0;color: black;"
                                                    id="reporte_ficha_registro"><i
                                                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Relación
                                                        Alumnos Matriculados</a>
                                                    -->

                                                    
                                                </div>
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_matriculados_semestre();" id="reporte_relacion_alumnos_matriculados_semestre"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos
                                                        Matriculados / Semestre</a>
                                                </div>
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_matriculados_dni();" id="reporte_relacion_alumnos_matriculados_dni"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Relación
                                                        Alumnos Matriculados DNI</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_matriculados_dni_semestre();" id="reporte_relacion_alumnos_matriculados_dni_semestre"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos
                                                        Matriculados DNI / Semestre</a>
                                                </div>
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_ciclo();" id="reporte_relacion_alumnos_ciclo"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Relación
                                                        Alumnos x Ciclo</a>
                                                </div>
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_ciclo_semestre();" id="reporte_relacion_alumnos_ciclo_semestre"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Relación
                                                        Alumnos x Ciclo / Semestre</a>
                                                </div>

                                                <!--nuevos reportes-->
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_estudiantes_sancionados();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Estudiantes
                                                        Sancionados / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_reserva_estudiantes();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reserva de
                                                        Estudiantes / Semestre</a>
                                                </div>


                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_estudiantes_no_matriculados();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Estudiantes
                                                        no matriculados / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_estudiantes_reprobados_misma_asignatura_2();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Estudiantes
                                                        Reprobados 2da vez / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_estudiantes_reprobados_misma_asignatura_3();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Estudiantes
                                                        Reprobados 3ra vez / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_estudiantes_reprobados_misma_asignatura_4();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Estudiantes
                                                        Reprobados 4ta vez / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_orden_merito();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Orden de
                                                        Merito PPS / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_orden_merito_acumulado();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Orden de
                                                        Merito PPA / Semestre</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_orden_merito_invictos();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Orden de
                                                        Merito Invictos General</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_orden_merito_invictos_carrera_profesional();"
                                                        style="background-color: #FFE0C0; color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Orden de
                                                        Merito Invictos / Carrera Profesional</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>

                                    <form id="2" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Número de Matriculados
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFC0; color: black;" onclick="reporte_alumnos_matriculados();" id="reporte_alumnos_matriculados"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos
                                                        Matriculados</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFC0; color: black;" onclick="reporte_alumnos_matriculados_semestre();" id="reporte_alumnos_matriculados_semestre"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos
                                                        Matriculados / Semestre</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFC0; color: black;" onclick="reporte_alumnos_matriculados_ciclo();" id="reporte_alumnos_matriculados_ciclo"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos
                                                        Matriculados / Ciclo</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>

                                    <form id="3" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Record Académico y Orden de Mérito
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFFF; color: black;" onclick="reporte_record_academico_general();" id="reporte_record_academico_general"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Record
                                                        Académico General</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFFF; color: black;" onclick="reporte_record_academico_semestre();" id="reporte_record_academico_semestre"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Record
                                                        Académico / Semestre</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #80FFFF; color: black;" onclick="reporte_orden_merito();" id="reporte_orden_merito"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Orden de
                                                        Mérito</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #80FFFF; color: black;" onclick="reporte_relacion_promedios();" id="reporte_relacion_promedios"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Relación de
                                                        Promedios</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>

                                    <form id="4" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Bienestar Universitario
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFC0FF; color: black;" onclick="reporte_obu();" id="reporte_obu"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;OBU</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFC0FF; color: black;" onclick="reporte_seguro_estudiantil();" id="reporte_seguro_estudiantil"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Seguro
                                                        Estudiantil</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFC0FF; color: black;" onclick="reporte_lonche_universitario();" id="reporte_lonche_universitario"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Lonche
                                                        Universitario</a>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </form>

                                    <form id="togglingForm3" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Miscelanea
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFC0C0; color: black;" onclick="reporte_chekeo_alumnos_matriculados();" id="reporte_chekeo_alumnos_matriculados"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Chekeo
                                                        Alumnos Matriculados</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFC0C0; color: black;" onclick="reporte_carnes_universitarios();" id="reporte_carnes_universitarios"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Carnes
                                                        Universitarios</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFC0C0; color: black;" onclick="reporte_file_alumnos_matriculados();" id="reporte_file_alumnos_matriculados"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;File Alumnos
                                                        Matriculados</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FF8080; color: black;" onclick="reporte_fondo_agua();" id="reporte_fondo_agua"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Fondo de
                                                        Agua</a>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>