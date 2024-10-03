

{% set codigo = "" %}
{% set descripcion = "" %}
{% set definicion = "" %}
{% set semestre = "" %}
{% set anio = "" %}
{% set fecha_inicio = "" %}
{% set fecha_fin = "" %}

{% set fecha_inicio_notas1 = "" %}
{% set fecha_fin_notas1 = "" %}
{% set fecha_inicio_notas2 = "" %}
{% set fecha_fin_notas2 = "" %}
{% set fecha_inicio_sustitutorio = "" %}
{% set fecha_fin_sustitutorio = "" %}
{% set fecha_inicio_matricula = "" %}
{% set fecha_fin_matricula = "" %}
{% set observacion = "" %}

{% set estado = "" %}

{% if semestres.descripcion is defined %}
    {% set descripcion = semestres.descripcion %}
{% endif %}

{% if semestres.definicion is defined %}
    {% set definicion = semestres.definicion %}
{% endif %}

{% if semestres.semestre is defined %}
    {% set semestre = semestres.semestre %}
{% endif %}

{% if semestres.anio is defined %}
    {% set anio = semestres.anio %}
{% endif %}

{% if semestres.fecha_inicio is defined %}
    {% set fecha_inicio =  utilidades.fechita(semestres.fecha_inicio,'d/m/Y') %}
    {% set hora_inicio = utilidades.hora_formato(semestres.fecha_inicio,'H:i:s') %}
{% endif %}

{% if semestres.fecha_fin is defined %}
    {% set fecha_fin = utilidades.fechita(semestres.fecha_fin,'d/m/Y') %}
    {% set hora_fin = utilidades.hora_formato(semestres.fecha_fin,'H:i:s') %}
{% endif %}

{% if semestres.fecha_inicio_notas1 is defined %}
    {% set fecha_inicio_notas1 = utilidades.fechita(semestres.fecha_inicio_notas1,'d/m/Y') %}
    {% set hora_inicio_notas1 = utilidades.hora_formato(semestres.fecha_inicio_notas1,'H:i:s') %}
{% endif %}

{% if semestres.fecha_fin_notas1 is defined %}
    {% set fecha_fin_notas1 = utilidades.fechita(semestres.fecha_fin_notas1,'d/m/Y') %}
    {% set hora_fin_notas1 = utilidades.hora_formato(semestres.fecha_fin_notas1,'H:i:s') %}
{% endif %}

{% if semestres.fecha_inicio_notas2 is defined %}
    {% set fecha_inicio_notas2 = utilidades.fechita(semestres.fecha_inicio_notas2,'d/m/Y') %}
    {% set hora_inicio_notas2 = utilidades.hora_formato(semestres.fecha_inicio_notas2,'H:i:s') %}
{% endif %}

{% if semestres.fecha_fin_notas2 is defined %}
    {% set fecha_fin_notas2 = utilidades.fechita(semestres.fecha_fin_notas2,'d/m/Y') %}
    {% set hora_fin_notas2 = utilidades.hora_formato(semestres.fecha_fin_notas2,'H:i:s') %}
{% endif %}

{% if semestres.fecha_inicio_sustitutorio is defined %}
    {% set fecha_inicio_sustitutorio = utilidades.fechita(semestres.fecha_inicio_sustitutorio,'d/m/Y') %}
    {% set hora_inicio_sustitutorio = utilidades.hora_formato(semestres.fecha_inicio_sustitutorio,'H:i:s') %}
{% endif %}

{% if semestres.fecha_fin_sustitutorio is defined %}
    {% set fecha_fin_sustitutorio = utilidades.fechita(semestres.fecha_fin_sustitutorio,'d/m/Y') %}
    {% set hora_fin_sustitutorio = utilidades.hora_formato(semestres.fecha_fin_sustitutorio,'H:i:s') %}

{% endif %}

{% if semestres.fecha_inicio_matricula is defined %}
    {% set fecha_inicio_matricula = utilidades.fechita(semestres.fecha_inicio_matricula,'d/m/Y') %}
    {% set hora_inicio_matricula = utilidades.hora_formato(semestres.fecha_inicio_matricula,'H:i:s') %}
{% endif %}

{% if semestres.fecha_fin_matricula is defined %}
    {% set fecha_fin_matricula = utilidades.fechita(semestres.fecha_fin_matricula,'d/m/Y') %}
    {% set hora_fin_matricula = utilidades.hora_formato(semestres.fecha_fin_matricula,'H:i:s') %}
{% endif %}

{% if semestres.observacion is defined %}
    {% set observacion = semestres.observacion %}
{% endif %}

{% if semestres.codigo is defined %}
    {% set codigo = semestres.codigo %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if semestres.estado is defined %}
    {% set estado = semestres.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% set fecha_inicio_matricula_ex = "" %}
{% if semestres.fecha_inicio_matricula_ex is defined %}
    {% set fecha_inicio_matricula_ex = utilidades.fechita(semestres.fecha_inicio_matricula_ex,'d/m/Y') %}
    {% set hora_fecha_inicio_matricula_ex = utilidades.hora_formato(semestres.fecha_inicio_matricula_ex,'H:i:s') %}
{% endif %}

{% set fecha_fin_matricula_ex = "" %}
{% if semestres.fecha_fin_matricula_ex is defined %}
    {% set fecha_fin_matricula_ex = utilidades.fechita(semestres.fecha_fin_matricula_ex,'d/m/Y') %}
    {% set hora_fecha_fin_matricula_ex = utilidades.hora_formato(semestres.fecha_fin_matricula_ex,'H:i:s') %}
{% endif %}


<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Enlaces</li>
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Semestres  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrosemestres/save','method': 'post','id':'form_semestres','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">


                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input_descripcion" name="descripcion" placeholder="Nombre descripcion" value="{{ descripcion }}" >
                                                    <input type="hidden" id="input_codigo" name="codigo" value="{{ codigo }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Definición</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input_definicion" name="definicion" placeholder="Definición" value="{{ definicion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Semestre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input_semestre" name="semestre" placeholder="Semestre"value="{{ semestre }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Año</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input_anio" name="anio" placeholder="Año" value="{{ anio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora inicio</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_inicio }}" name="hora_inicio">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_inicio">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha Fin</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_fin" name="fecha_fin" placeholder="Fecha Fin" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fin</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fin }}" name="hora_fin">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fin">
                                                        {% endif %}

                                                    </div>
                                                </div>
                                            </section>



                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Inicio Notas 1</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inicio_notas1" name="fecha_inicio_notas1" placeholder="Fecha Inicio Notas 1" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio_notas1 }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Inicio Notas 1</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_inicio_notas1 }}" name="hora_inicio_notas1">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_inicio_notas1">
                                                        {% endif %}

                                                    </div>
                                                </div>
                                            </section>

                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Fin Notas 1</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_fin_notas1" name="fecha_fin_notas1" placeholder="Fecha Fin Notas 1" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin_notas1 }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fin Notas 1</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fin_notas1 }}" name="hora_fin_notas1">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fin_notas1">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>


                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Inicio Notas 2</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inicio_notas2" name="fecha_inicio_notas2" placeholder="Fecha Inicio Notas 2" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio_notas2 }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Inicio Notas 2</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_inicio_notas2 }}" name="hora_inicio_notas2">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_inicio_notas2">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>

                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Fin Notas 2</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_fin_notas2" name="fecha_fin_notas2" placeholder="Fecha Fin Notas 2" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin_notas2 }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fin Notas 2</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fin_notas2 }}" name="hora_fin_notas2">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fin_notas2">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>


                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Inicio Sustitutorio </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inicio_sustitutorio" name="fecha_inicio_sustitutorio" placeholder="Fecha Inicio Sustitutorio" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio_sustitutorio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Inicio Sustitutorio</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_inicio_sustitutorio }}" name="hora_inicio_sustitutorio">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_inicio_sustitutorio">
                                                        {% endif %}
                                                    </div>
                                                </div>
                                            </section>


                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Fin Sustitutorio </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_fin_sustitutorio" name="fecha_fin_sustitutorio" placeholder="Fecha Fin Sustitutorio" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin_sustitutorio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fin Sustitutorio</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fin_sustitutorio }}" name="hora_fin_sustitutorio">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fin_sustitutorio">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>


                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Inicio Matricula </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inicio_matricula" name="fecha_inicio_matricula" placeholder="Fecha Inicio Matricula" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio_matricula }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Inicio Matricula</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_inicio_matricula }}" name="hora_inicio_matricula">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_inicio_matricula">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>

                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Fin Matricula </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_fin_matricula" name="fecha_fin_matricula" placeholder="Fecha Fin Matricula" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin_matricula }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fin Matricula</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fin_matricula }}" name="hora_fin_matricula">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fin_matricula">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>
                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Inicio Matricula Ex </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inicio_matricula_ex" name="fecha_inicio_matricula_ex" placeholder="fecha inicio matricula ex" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio_matricula_ex }}">
                                                </label>
                                            </section>
                                            {#<section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fecha Inicio Matricula Ex</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if fecha_inicio_matricula_ex is null %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fecha_inicio_matricula_ex">


                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fecha_inicio_matricula_ex }}" name="hora_fecha_inicio_matricula_ex">

                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>#}

                                            <section class="col col-4">
                                                <label class="text-info" >Fecha Fin Matricula Ex </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_fin_matricula_ex" name="fecha_fin_matricula_ex" placeholder="fecha fin matricula ex" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin_matricula_ex }}">
                                                </label>
                                            </section>

                                            {#<section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Fecha Fin Matricula Ex</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>


                                                        {% if fecha_fin_matricula_ex is null %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_fecha_fin_matricula_ex">


                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_fecha_fin_matricula_ex }}" name="hora_fecha_fin_matricula_ex">

                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>#}

                                            <section class="col col-md-12">
                                                <label class="text-info" >Observacion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input_observacion" name="observacion">{{ observacion }}</textarea> 
                                                </label>
                                            </section>



                                            {#<section class="col col-md-4">
                                                <label class="text-info">Estado</label>
                                                <label class="checkbox" style="pointer-events: none;">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" id="input_estado" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="estado" id="input_estado">
                                                    {% endif %}
                                                    <i></i>Activar / Desactivar</label>
                                            </section>#}

                                        </div> 
                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>

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
    <div id="exito_semestres">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript" >
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = {{ id }};
    {% endif %}



        //alert("Hola");
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>