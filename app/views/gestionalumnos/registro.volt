<!------------------------------alumnos_semestre------------------------------->
{% set alumno = "" %}
{% set txt_buton = "Registrar" %}
{% if alumnos_semestre.alumno is defined %}
    {% set alumno = alumnos_semestre.alumno %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% set semestre = "" %}
{% if alumnos_semestre.semestre is defined %}
    {% set semestre_alumnos = alumnos_semestre.semestre %}
{% endif %}

{% set consejero = "" %}
{% if alumnos_semestre.consejero is defined %}
    {% set consejero = alumnos_semestre.consejero %}
{% endif %}


{% set fecha_matricula = "" %}
{% if alumnos_semestre.fecha_matricula is defined %}
    {% set fecha_matricula = utilidades.fechita(alumnos_semestre.fecha_matricula,'d/m/Y') %}
{% endif %}

{% set nivelacion_s = "" %}
{% if alumnos_semestre.nivelacion_s is defined %}
    {% set nivelacion_s = alumnos_semestre.nivelacion_s %}
{% endif %}

{% set nivelacion = "" %}
{% if alumnos_semestre.nivelacion is defined %}
    {% set nivelacion = alumnos_semestre.nivelacion %}
{% endif %}

{% set fecha_nivelacion = "" %}
{% if alumnos_semestre.fecha_nivelacion is defined %}
    {% set fecha_nivelacion =  utilidades.fechita(alumnos_semestre.fecha_nivelacion,'d/m/Y')  %}
{% endif %}

{% set ampliacion_s = "" %}
{% if alumnos_semestre.ampliacion_s is defined %}
    {% set ampliacion_s =  alumnos_semestre.ampliacion_s  %}
{% endif %}

{% set ampliacion = "" %}
{% if alumnos_semestre.ampliacion is defined %}
    {% set ampliacion =  alumnos_semestre.ampliacion  %}
{% endif %}

{% set fecha_ampliacion = "" %}
{% if alumnos_semestre.fecha_ampliacion is defined %}
    {% set fecha_ampliacion =   utilidades.fechita(alumnos_semestre.fecha_ampliacion,'d/m/Y')%}
{% endif %}

{% set paralelos_s = "" %}
{% if alumnos_semestre.paralelos_s is defined %}
    {% set paralelos_s =  alumnos_semestre.paralelos_s  %}
{% endif %}

{% set paralelos = "" %}
{% if alumnos_semestre.paralelos is defined %}
    {% set paralelos =  alumnos_semestre.paralelos  %}
{% endif %}

{% set fecha_paralelo = "" %}
{% if alumnos_semestre.fecha_paralelo is defined %}
    {% set fecha_paralelo =   utilidades.fechita(alumnos_semestre.fecha_paralelo,'d/m/Y')%}
{% endif %}


{% set rectificacion_s = "" %}
{% if alumnos_semestre.rectificacion_s is defined %}
    {% set rectificacion_s =  alumnos_semestre.rectificacion_s  %}
{% endif %}


{% set fecha_rectificacion = "" %}
{% if alumnos_semestre.fecha_rectificacion is defined %}
    {% set fecha_rectificacion =  utilidades.fechita(alumnos_semestre.fecha_rectificacion,'d/m/Y')  %}
{% endif %}

{% set carne_u_s = "" %}
{% if alumnos_semestre.carne_u_s is defined %}
    {% set carne_u_s =  alumnos_semestre.carne_u_s  %}
{% endif %}

{% set carne_u_r = "" %}
{% if alumnos_semestre.carne_u_r is defined %}
    {% set carne_u_r =  alumnos_semestre.carne_u_r  %}
{% endif %}

{% set es_regular = "" %}
{% if alumnos_semestre.es_regular is defined %}
    {% set es_regular =  alumnos_semestre.es_regular  %}
{% endif %}

{% set matricula_ok = "" %}
{% if alumnos_semestre.matricula_ok is defined %}
    {% set matricula_ok =  alumnos_semestre.matricula_ok  %}
{% endif %}

{% set a1 = "" %}
{% if alumnos_semestre.a1 is defined %}
    {% set a1 =  alumnos_semestre.a1  %}
{% endif %}

{% set a2 = "" %}
{% if alumnos_semestre.a1 is defined %}
    {% set a2 =  alumnos_semestre.a2  %}
{% endif %}

{% set a3 = "" %}
{% if alumnos_semestre.a3 is defined %}
    {% set a3 =  alumnos_semestre.a3  %}
{% endif %}

{% set a4 = "" %}
{% if alumnos_semestre.a4 is defined %}
    {% set a4 =  alumnos_semestre.a4  %}
{% endif %}

{% set a5 = "" %}
{% if alumnos_semestre.a5 is defined %}
    {% set a5 =  alumnos_semestre.a5  %}
{% endif %}

{% set a6 = "" %}
{% if alumnos_semestre.a6 is defined %}
    {% set a6 =  alumnos_semestre.a6  %}
{% endif %}

{% set a7 = "" %}
{% if alumnos_semestre.a7 is defined %}
    {% set a7 =  alumnos_semestre.a7  %}
{% endif %}

{% set a8 = "" %}
{% if alumnos_semestre.a8 is defined %}
    {% set a8 =  alumnos_semestre.a8  %}
{% endif %}

{% set a9 = "" %}
{% if alumnos_semestre.a9 is defined %}
    {% set a9 =  alumnos_semestre.a9  %}
{% endif %}

{% set a0 = "" %}
{% if alumnos_semestre.a0 is defined %}
    {% set a0 =  alumnos_semestre.a0  %}
{% endif %}

{% set ht = "" %}
{% if alumnos_semestre.ht is defined %}
    {% set ht =  alumnos_semestre.ht  %}
{% endif %}

{% set hp = "" %}
{% if alumnos_semestre.hp is defined %}
    {% set hp =  alumnos_semestre.hp  %}
{% endif %}

{% set creditos = "" %}
{% if alumnos_semestre.creditos is defined %}
    {% set creditos =  alumnos_semestre.creditos  %}
{% endif %}

{% set ciclo = "" %}
{% if alumnos_semestre.ciclo is defined %}
    {% set ciclo =  alumnos_semestre.ciclo  %}
{% endif %}

{% set promedio = "" %}
{% if alumnos_semestre.promedio is defined %}
    {% set promedio =  alumnos_semestre.promedio  %}
{% endif %}

{% set tutor = "" %}
{% if alumnos_semestre.tutor is defined %}
    {% set tutor =  alumnos_semestre.tutor  %}
{% endif %}

{% set estado = "" %}
{% if alumnos_semestre.estado is defined %}
    {% set estado =  alumnos_semestre.estado  %}
{% endif %}

{% set orden = "" %}
{% if alumnos_semestre.orden is defined %}
    {% set orden =  alumnos_semestre.orden  %}
{% endif %}

{% set registros_academicos = "" %}
{% if alumnos_semestre.registros_academicos is defined %}
    {% set registros_academicos =  alumnos_semestre.registros_academicos  %}
{% endif %}

{% set servicio_salud = "" %}
{% if alumnos_semestre.servicio_salud is defined %}
    {% set servicio_salud =  alumnos_semestre.servicio_salud  %}
{% endif %}

{% set servicio_social = "" %}
{% if alumnos_semestre.servicio_social is defined %}
    {% set servicio_social =  alumnos_semestre.servicio_social  %}
{% endif %}

{% set servicio_psicopedagogico = "" %}
{% if alumnos_semestre.servicio_psicopedagogico is defined %}
    {% set servicio_psicopedagogico =  alumnos_semestre.servicio_psicopedagogico  %}
{% endif %}

{% set servicio_deportivo = "" %}
{% if alumnos_semestre.servicio_deportivo is defined %}
    {% set servicio_deportivo =  alumnos_semestre.servicio_deportivo  %}
{% endif %}

{% set servicio_cultural = "" %}
{% if alumnos_semestre.servicio_cultural is defined %}
    {% set servicio_cultural =  alumnos_semestre.servicio_cultural  %}
{% endif %}

{% set voucher = "" %}
{% if alumnos_semestre.voucher is defined %}
    {% set voucher =  alumnos_semestre.voucher  %}
{% endif %}

{% set fecha_inicio_matricula = "" %}
{% if alumnos_semestre.fecha_inicio_matricula is defined %}
    {% set fecha_inicio_matricula =  utilidades.fechita(alumnos_semestre.fecha_inicio_matricula,'d/m/Y')  %}
{% endif %}

{% set matricula_realizada = "" %}
{% if alumnos_semestre.matricula_realizada is defined %}
    {% set matricula_realizada =  alumnos_semestre.matricula_realizada  %}
{% endif %}

{% set resolucion_matricula_especial = "" %}
{% if alumnos_semestre.resolucion_matricula_especial is defined %}
    {% set resolucion_matricula_especial =  alumnos_semestre.resolucion_matricula_especial  %}
{% endif %}

{% set reserva_matricula = "" %}
{% if alumnos_semestre.reserva_matricula is defined %}
    {% set reserva_matricula =  alumnos_semestre.reserva_matricula  %}
{% endif %}

{% set fecha_reserva_matricula = "" %}
{% if alumnos_semestre.fecha_reserva_matricula is defined %}
    {% set fecha_reserva_matricula =  utilidades.fechita(alumnos_semestre.fecha_reserva_matricula,'d/m/Y')  %}
{% endif %}


{% set promedio_anterior = "" %}
{% if alumnos_semestre.promedio_anterior is defined %}
    {% set promedio_anterior =  alumnos_semestre.promedio_anterior  %}
{% endif %}

{% set promedio_acumulado = "" %}
{% if alumnos_semestre.promedio_acumulado is defined %}
    {% set promedio_acumulado =  alumnos_semestre.promedio_acumulado  %}
{% endif %}


{% set creditos_acumulado = "" %}
{% if alumnos_semestre.creditos_acumulado is defined %}
    {% set creditos_acumulado =  alumnos_semestre.creditos_acumulado  %}
{% endif %}


{% set creditos_acumulado = "" %}
{% if alumnos_semestre.creditos_acumulado is defined %}
    {% set creditos_acumulado =  alumnos_semestre.creditos_acumulado  %}
{% endif %}

{% set voucher_nro = "" %}
{% if alumnos_semestre.voucher_nro is defined %}
    {% set voucher_nro =  alumnos_semestre.voucher_nro  %}
{% endif %}


{% set orden_merito_anterior = "" %}
{% if alumnos_semestre.orden_merito_anterior is defined %}
    {% set orden_merito_anterior =  alumnos_semestre.orden_merito_anterior  %}
{% endif %}
<!--------------------------------fin------------------------------------------>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Estudiante</li>
    </ol>
</div>

<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     
        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Estudiantes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('gestionalumnos/saveRegistro','method': 'post','id':'form_alumnos','class':'smart-form','enctype':'multipart/form-data')  }}

                                    <div class="row" >
                                        <div class="col col-md-12" >
                                            <!-- widget content -->
                                            <div class="widget-body" >
                                                <ul id="myTab1" class="nav nav-tabs bordered">
                                                    <li class="active">
                                                        <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Matricula</a>
                                                    </li>
                                                    <li>
                                                        <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Registros Académicos</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Carné Universitario</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Tutoría</a>
                                                    </li>
                                                </ul>

                                                <div id="myTabContent1" class="tab-content">
                                                    <div class="tab-pane  active" id="s1">
                                                        <header>
                                                            Estudiante: {{alumno}} - {{ estudiante }}
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Inicio Matricula (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_inicio_matricula" name="fecha_inicio_matricula" placeholder="Fecha de Inicio Matricula" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio_matricula }}">
                                                                        <input type="hidden" id="input-semestre" name="semestre" value="{{ semestre_alumnos }}">
                                                                        <input type="hidden" id="input-alumno" name="alumno" value="{{ alumno }}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Matricula (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_matricula" name="fecha_matricula" placeholder="Fecha de Matricula" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_matricula }}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if matricula_realizada == 1 %}
                                                                            <input type="checkbox" name="matricula_realizada" value="{{ matricula_realizada }}" id="input-matricula_realizada" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="matricula_realizada" value="{{ matricula_realizada }}" id="input-matricula_realizada">
                                                                        {% endif %}

                                                                        <i></i>Matrícula Realizada</label>
                                                                </section>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Nivelación (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_nivelacion" name="fecha_nivelacion" placeholder="Fecha de Nivelación" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_nivelacion }}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Créditos de Nivelación</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-nivelacion" name="nivelacion" placeholder="Créditos Nivelación" value="{{ nivelacion }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if nivelacion_s == 1 %}
                                                                            <input type="checkbox" name="nivelacion_s" value="{{ nivelacion_s }}" id="input-nivelacion_s" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="nivelacion_s" value="{{ nivelacion_s }}" id="input-nivelacion_s">
                                                                        {% endif %}

                                                                        <i></i>Solicitud de Nivelación </label>
                                                                </section>
                                                            </div>

                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Ampliación (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_ampliacion" name="fecha_ampliacion" placeholder="Fecha de Ampliación" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_ampliacion }}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Créditos de Ampliación</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-ampliacion" name="ampliacion" placeholder="Nivelación" value="{{ ampliacion }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if ampliacion_s == TRUE %}
                                                                            <input type="checkbox" name="ampliacion_s" value="{{ ampliacion_s }}" id="input-ampliacion_s" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="ampliacion_s" value="{{ ampliacion_s }}" id="input-ampliacion_s" >
                                                                        {% endif %}

                                                                        <i></i>Solicitud de Ampliación </label>
                                                                </section>

                                                            </div>
                                                            <div class="row">

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Paralelo (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_paralelo" name="fecha_paralelo" placeholder="Fecha de Paralelo" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_paralelo }}">
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Créditos Paralelos</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-paralelos" name="paralelos" placeholder="Nivelación" value="{{ paralelos }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if paralelos_s == TRUE %}
                                                                            <input type="checkbox" name="paralelos_s" value="{{ paralelos_s }}" id="input-paralelos_s" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="paralelos_s" value="{{ paralelos_s }}" id="input-paralelos_s" >
                                                                        {% endif %}

                                                                        <i></i>Solicitud de Paralelos </label>
                                                                </section>
                                                            </div>

                                                            <div class="row">

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Rectificación (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_rectificacion" name="fecha_rectificacion" placeholder="Fecha de Rectificación" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_rectificacion }}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if rectificacion_s == 1 %}
                                                                            <input type="checkbox" name="rectificacion_s" value="{{ rectificacion_s }}" id="input-rectificacion_s" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="rectificacion_s" value="{{ rectificacion_s }}" id="input-rectificacion_s" >
                                                                        {% endif %}

                                                                        <i></i>Solicitud de Rectificación </label>
                                                                </section>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Reserva Matrícula (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_" name="fecha_reserva_matricula" placeholder="Fecha de Reserva Matrícula" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_reserva_matricula }}">
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if reserva_matricula == 1 %}
                                                                            <input type="checkbox" name="reserva_matricula" value="{{ reserva_matricula }}" id="input-reserva_matricula" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="reserva_matricula" value="{{ reserva_matricula }}" id="input-reserva_matricula" >
                                                                        {% endif %}

                                                                        <i></i>Reserva Matrícula</label>
                                                                </section>
                                                            </div>
                                                            <div class="row">

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if registros_academicos == 1 %}
                                                                            <input type="checkbox" name="registros_academicos" value="{{ registros_academicos }}" id="input-registros_academicos" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="registros_academicos" value="{{ registros_academicos }}" id="input-registros_academicos" >
                                                                        {% endif %}

                                                                        <i></i>Registros Académicos</label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if servicio_salud == 1 %}
                                                                            <input type="checkbox" name="servicio_salud" value="{{ servicio_salud }}" id="input-servicio_salud" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="servicio_salud" value="{{ servicio_salud }}" id="input-servicio_salud" >
                                                                        {% endif %}

                                                                        <i></i>Servicio de Salud</label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if servicio_social == 1 %}
                                                                            <input type="checkbox" name="servicio_social" value="{{ servicio_social }}" id="input-servicio_social" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="servicio_social" value="{{ servicio_social }}" id="input-servicio_social" >
                                                                        {% endif %}

                                                                        <i></i>Servicio Social</label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if servicio_psicopedagogico == 1 %}
                                                                            <input type="checkbox" name="servicio_psicopedagogico" value="{{ servicio_psicopedagogico }}" id="input-servicio_psicopedagogico" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="servicio_psicopedagogico" value="{{ servicio_psicopedagogico }}" id="input-servicio_psicopedagogico" >
                                                                        {% endif %}

                                                                        <i></i>Servicio Piscopedagógico</label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if servicio_deportivo == 1 %}
                                                                            <input type="checkbox" name="servicio_deportivo" value="{{ servicio_deportivo }}" id="input-servicio_deportivo" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="servicio_deportivo" value="{{ servicio_deportivo }}" id="input-servicio_deportivo" >
                                                                        {% endif %}

                                                                        <i></i>Servicio Deportivo</label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if servicio_cultural == 1 %}
                                                                            <input type="checkbox" name="servicio_cultural" value="{{ servicio_cultural }}" id="input-servicio_cultural" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="servicio_cultural" value="{{ servicio_cultural }}" id="input-servicio_cultural" >
                                                                        {% endif %}

                                                                        <i></i>Servicio Cultural</label>
                                                                </section>

                                                                        <section class="col col-md-4" style="margin-top: 12px;">

                                                                    <label class="checkbox">

                                                                        {% if voucher == 1 %}
                                                                            <input type="checkbox" name="voucher" value="{{ voucher }}" id="input-voucher" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="voucher" value="{{ voucher }}" id="input-voucher" >
                                                                        {% endif %}

                                                                        <i></i>Voucher</label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-voucher_nro" name="voucher_nro" placeholder="Número Voucher" value="{{ voucher_nro }}" >
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if resolucion_matricula_especial == 1 %}
                                                                            <input type="checkbox" name="resolucion_matricula_especial" value="{{ resolucion_matricula_especial }}" id="input-resolucion_matricula_especial" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="resolucion_matricula_especial" value="{{ resolucion_matricula_especial }}" id="input-resolucion_matricula_especial" >
                                                                        {% endif %}

                                                                        <i></i>Resolución Matrícula Especial</label>
                                                                </section>

                                                            </div>
                                                        </fieldset>
                                                    </div>


                                                    <div class="tab-pane fade" id="s2">
                                                        <header>
                                                            Estudiante: {{ estudiante }}
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a1 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a1" name="a1" placeholder="a1" value="{{ a1 }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a2 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a2" name="a2" placeholder="a2" value="{{ a2 }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a3 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a3" name="a3" placeholder="a3" value="{{ a3 }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a4 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a4" name="a4" placeholder="a4" value="{{ a4 }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a5 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a5" name="a5" placeholder="a5" value="{{ a5 }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a6 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a6" name="a6" placeholder="a6" value="{{ a6 }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a7 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a7" name="a7" placeholder="a7" value="{{ a7 }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a8 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a8" name="a8" placeholder="a8" value="{{ a8 }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a9 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a9" name="a9" placeholder="a9" value="{{ a9 }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >a0 </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-a0" name="a0" placeholder="a0" value="{{ a0 }}" >
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >ht </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-ht" name="ht" placeholder="ht" value="{{ ht }}" >
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >hp </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-hp" name="hp" placeholder="hp" value="{{ hp }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Créditos </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-creditos" name="creditos" placeholder="Créditos" value="{{ creditos }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Ciclo </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-ciclo" name="ciclo" placeholder="Ciclo" value="{{ ciclo }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Promedio </label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-promedio" name="promedio" placeholder="Promedio" value="{{ promedio }}" >
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Promedio Anterior</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-promedio_anterior" name="promedio_anterior" placeholder="Promedio Anterior" value="{{ promedio_anterior }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Promedio Acumulado</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-promedio_acumulado" name="promedio_acumulado" placeholder="Promedio Acumulado" value="{{ promedio_acumulado }}" >
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Créditos Acumulado</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-creditos_acumulado" name="creditos_acumulado" placeholder="Promedio Acumulado" value="{{ creditos_acumulado }}" >
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Percentil ACtual</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-percencil_actual" name="percencil_actual" placeholder="Percencil Actual" value="{{ orden_merito_anterior }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Orden Mérito Anterior</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-orden_merito_anterior" name="orden_merito_anterior" placeholder="Orden" value="{{ orden_merito_anterior }}" >
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Orden</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-orden" name="orden" placeholder="Orden" value="{{ orden }}" >
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="tab-pane fade" id="s3">
                                                        <header>
                                                            Estudiante: {{ estudiante }}
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">


                                                                <section class="col col-md-2">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if carne_u_s == 1 %}
                                                                            <input type="checkbox" name="carne_u_s" value="{{ carne_u_s }}" id="input-carne_u_s" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="carne_u_s" value="{{ carne_u_s }}" id="input-carne_u_s" >
                                                                        {% endif %}

                                                                        <i></i>Carne U S</label>
                                                                </section>


                                                                <section class="col col-md-2">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if carne_u_r == 1 %}
                                                                            <input type="checkbox" name="carne_u_r" value="{{ carne_u_r }}" id="input-carne_u_r" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="carne_u_r" value="{{ carne_u_r }}" id="input-carne_u_r" >
                                                                        {% endif %}

                                                                        <i></i>Carne U R</label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if es_regular == 1 %}
                                                                            <input type="checkbox" name="es_regular" value="{{ es_regular }}" id="input-es_regular" checked > 
                                                                        {% else %}
                                                                            <input type="checkbox" name="es_regular" value="{{ es_regular }}" id="input-es_regular" >
                                                                        {% endif %}

                                                                        <i></i>Regular</label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="tab-pane fade" id="s4">
                                                        <header>
                                                            Estudiante: {{ estudiante }}
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Consejero</label>
                                                                    <label class="select">
                                                                        <select id="input-consejero"  name="consejero" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for consejeros_select in consejeros %}
                                                                                {% if consejeros_select.codigo == consejero %}
                                                                                    <option selected="selected" value="{{ consejeros_select.codigo }}">{{ consejeros_select.apellidop }} {{ consejeros_select.apellidom }} {{ consejeros_select.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ consejeros_select.codigo }}">{{ consejeros_select.apellidop }} {{ consejeros_select.apellidom }} {{ consejeros_select.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Tutor</label>
                                                                    <label class="select">
                                                                        <select id="input-tutor"  name="tutor" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for tutores_select in tutores %}
                                                                                {% if tutores_select.codigo == tutor %}
                                                                                    <option selected="selected" value="{{ tutores_select.codigo }}">{{ tutores_select.apellidop }} {{ tutores_select.apellidom }} {{ tutores_select.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ tutores_select.codigo }}">{{ tutores_select.apellidop }} {{ tutores_select.apellidom }} {{ tutores_select.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>




                                                            </div>
                                                        </fieldset>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <footer>


                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>


                                        <!--<a role="button" href="{{ url("alumnos/imprime/"~codigo~'/'~sem) }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  DESCARGAR FICHA</a>-->


                                    </footer>
                                    {{ endForm() }}
                                </div>      
                            </div>
                        </div>  
                    </article>  
                </div>
            </section>
        </div>          
    </div>  
</div>
<div class="hidden">
    <div id="exito_alumno">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript" >
    {% if sem is defined %}
        var semestreax = "{{ sem }}";
        console.log("Carga semestre seleccionado: " + semestreax);
    {% else %}

        var semestreax = "{{ semestrea }}";
        console.log("Carga semestre por defecto: " + semestreax);
    {% endif %}

</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>