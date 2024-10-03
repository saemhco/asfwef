<!--Model: asistencias-->
{% set codigo = "" %}
{% if asistencias.codigo is defined %}
    {% set codigo = asistencias.codigo %}
{% endif %}



{% set estado = "" %}
{% if asistencias.estado is defined %}
    {% set estado = asistencias.estado %}
{% endif %}

{% set tema = "" %}
{% if asistencias.tema is defined %}
    {% set tema = asistencias.tema %}
{% endif %}



{% set fecha = "" %}
{% if asistencias.fecha is defined %}
    {% set fecha =  utilidades.fechita(asistencias.fecha,'d/m/Y') %}
    {% set hora = utilidades.hora_formato(asistencias.fecha,'H:i:s') %}
{% endif %}


{% set observaciones = "" %}
{% if asistencias.observaciones is defined %}
    {% set observaciones = asistencias.observaciones %}
{% endif %}


{% set tipo_asistencia = "" %}
{% if asistencias.tipo is defined %}
    {% set tipo_asistencia = asistencias.tipo %}
{% endif %}



<!--Model: alumnos_asistencia-->
{% set asistio = "" %}
{% if alumnos_asistencias.asistio is defined %}
    {% set asistio = alumnos_asistencias.asistio %}
{% endif %}

<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestión de Asistencia </li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
         <div class="col-md-12" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>Registro de Asistencia</strong></h2>	



                            </header>
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">


                                    <div class="row"  >
                                        <div class="col col-md-12" >  

                                            <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="6">
                                                <center>ASIGNATURA: {{ asignatura.nombre }}</center>
                                                </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="font-size: 12px !important;" >
                                                        <td>Código:<strong> {{ asignatura.codigo }}<input type="hidden" name="codigo" value="{{ asignatura.codigo }}"></strong></td>
                                                        <td>Ciclo: <strong>{{ asignatura.ciclo}} </strong></td>
                                                        <td>Creditos: <strong>{{ asignatura.creditos  }}</strong> </td>
                                                        <td>Grupo: <strong>{{ grupo  }}</strong> </td>
                                                        <td>Sub grupo: <strong>{{ subgrupo  }}</strong> </td>
                                                        <td>Curricula: <strong>{{ programa.descripcion  }}</strong> </td>


                                                    </tr>


                                                </tbody>
                                            </table>

                                        </div> 
                                    </div> 


                                    {{ form('gestionasistencias/save','method': 'post','id':'form_asistencias','class':'smart-form') }}
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info" >Tipo</label>
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for ta in tipoasistencias %}

                                                            {% if ta.codigo == tipo_asistencia %}
                                                                <option selected="selected" value="{{ ta.codigo }}">{{ ta.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ ta.codigo }}">{{ ta.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Fecha </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-fecha" name="fecha" placeholder="dd/mm/aaaa" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>



                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora }}" name="hora">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora">
                                                        {% endif %}

                                                    </div>
                                                </div>
                                            </section>
                                            <section class="col col-md-3">

                                                <label class="text-info" >Estado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado == NULL OR estado == "1" %}
                                                        <input type="text" id="input-estado" name="estado" placeholder="Estado" value="Abierto" readonly="">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Tema</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-tema" name="tema" placeholder="Tema" value="{{ tema }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Observaciones</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-asistencia_semestre_observaciones" name="asistencias_semestre_observaciones" placeholder="Observaciones" value="{{ observaciones }}" >

                                                </label>
                                            </section>

                                        </div> 
                                    </fieldset>
                                    <header style="margin-top: -10px;">
                                        Registro de Asistencia - Total de Estudiantes: {{ total_estudiantes }}
                                    </header>
                                    <fieldset>

                                        <!--<div class="row">-->

                                        <!--<div class="table-responsive">-->


                                        <table class="table table-bordered table-hover" style="font-size: 10px !important;">
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-check-square"></th>
                                                    <th width="10%" > Codigo

                                                       

                                                        {% if codigo !== "" %}
                                                            <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                        {% else %}
                                                             <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo_count }}">
                                                        {% endif %}


                                                        <input type="hidden" name="semestre" value="{{ semestre.codigo }}">
                                                        <input type="hidden" name="asignatura" value="{{ asignatura.codigo }}">
                                                        <input type="hidden" name="grupo" value="{{ grupo }}">
                                                        <input type="hidden" name="subgrupo" value="{{ subgrupo }}">
                                                        {#<input type="hidden" name="hora_entrada" value="{{ hora_entrada }}">#}
                                                    </th>
                                                    <th>Apellidos</th>
                                                    <th>Nombres</th>
                                                    <th width="5%">Asistencia</th>
                                                    <th width="5%">Detalle</th>


                                                    <th width="5%">Observacion</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                {% if codigo !== "" %}



                                                    {% for det in vista_asistencias %}
                                                        <tr class="activa" id="get-{{ det.alumno }}">
                                                            <td class="activ cc" id="get-{{ det.alumno }}">

                                                                <input 
                                                                    class="checkcurso pp_check" id="check-{{ det.alumno }}"

                                                                    type="radio" name="checkbox-inline" value="1" />
                                                            </td>
                                                            <td class="activ" id="get-{{ det.alumno }}" ><input type="hidden" class="inp-{{ det.alumno }}" name="alumno[]" value="{{ det.alumno }}" >{{ det.alumno }}</td>
                                                            <td class="activ" id="get-{{ det.alumno }}">{{ det.apellidos }}</td>
                                                            <td class="activ" id="get-{{ det.alumno }}">{{ det.nombres }}</td>

                                                            <!--
                                                            <td class="p_p1"><input type="text" style="width: 50px;" class="input-xs pp1 not get-{{ det.alumno }}" onkeyup="calculaprom($(this))" name="asistio[]" value="{{ det.ep1 }}" disabled></td>
                                                            <td class="p_p2"><input type="text" class="input-xs pp2 not get-{{ det.alumno }}" onkeyup="calculaprom($(this))" name="observaciones[]" value="{{ det.ep2 }}" disabled></td>
                                                            -->
                                                            <td class="p_p1" align="center"> 



                                                                {% if det.asistio  == 1 %}



                                                                    <label class="checkbox">
                                                                        <input type="checkbox" checked="checked" disabled="disabled" class="input-xs pp1 not get-{{ det.alumno }}" name="asistio[]"  value="{{ det.alumno }}">
                                                                        <i></i>

                                                                    </label>

                                                                {% else %}

                                                                    <label class="checkbox">
                                                                        <input type="checkbox"  disabled="disabled" class="input-xs pp1 not get-{{ det.alumno }}" name="asistio[]"  value="{{ det.alumno }}">
                                                                        <i></i>

                                                                    </label>
                                                                {% endif %}




                                                            </td>



                                                            <td class="p_p0"> 


                                                                {% if det.detalle  == 0 %}

                                                                    <label class="select" style="width: 118px;">
                                                                        <select id="input-detalle"  name="detalle[]" disabled="" class="input-xs pp1 not get-{{ det.alumno }}">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for entrada in entradas %}

                                                                                {% if entrada.codigo == det.detalle %}

                                                                                    <option selected="selected" value="{{ entrada.codigo}}">{{ entrada.nombres }}</option> 

                                                                                {% else %}

                                                                                    <option value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>

                                                                {% elseif det.detalle  == 1 %}

                                                                    <label class="select" style="width: 118px;">
                                                                        <select id="input-detalle"  name="detalle[]" disabled="" class="input-xs pp1 not get-{{ det.alumno }}">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for entrada in entradas %}

                                                                                {% if entrada.codigo == det.detalle %}
                                                                                    <option selected="selected" value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% else %}

                                                                                    <option value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                {% elseif det.detalle  == 2 %}

                                                                    <label class="select" style="width: 118px;">
                                                                        <select id="input-detalle"  name="detalle[]" disabled="" class="input-xs pp1 not get-{{ det.alumno }}">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for entrada in entradas %}

                                                                                {% if entrada.codigo == det.detalle %}

                                                                                    <option selected="selected" value="{{ entrada.codigo}}">{{ entrada.nombres }}</option> 

                                                                                {% else %}

                                                                                    <option value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>

                                                                {% elseif det.detalle  == 3 %}
                                                                    <label class="select" style="width: 118px;">
                                                                        <select id="input-detalle"  name="detalle[]" disabled="" class="input-xs pp1 not get-{{ det.alumno }}">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for entrada in entradas %}

                                                                                {% if entrada.codigo == det.detalle %}

                                                                                    <option selected="selected" value="{{ entrada.codigo}}">{{ entrada.nombres }}</option> 

                                                                                {% else %}

                                                                                    <option value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>

                                                                {% endif %}


                                                            </td>


                                                            <td class="p_p2">
                                                                <label class="input"><input class="input-xs pp2 not get-{{ det.alumno }}" type="text" id="input-observaciones" name="observaciones[]" placeholder="" value="{{ det.observaciones }}" disabled></label>

                                                            </td>


                                                        </tr>
                                                    {% endfor %}




                                                {% else %}


                                                    {% for det in lista_alumnos %}
                                                        <tr class="activa" id="get-{{ det.alumno }}">
                                                            <td class="activ cc" id="get-{{ det.alumno }}">

                                                                <input 
                                                                    class="checkcurso pp_check" id="check-{{ det.alumno }}"

                                                                    type="radio" name="checkbox-inline" value="1" />
                                                            </td>
                                                            <td class="activ" id="get-{{ det.alumno }}" ><input type="hidden" class="inp-{{ det.alumno }}" name="alumno[]" value="{{ det.alumno }}" >{{ det.alumno }}</td>
                                                            <td class="activ" id="get-{{ det.alumno }}">{{ det.apellidos }}</td>
                                                            <td class="activ" id="get-{{ det.alumno }}">{{ det.nombres }}</td>

                                                    
                                                            <td class="p_p1" align="center"> 

                                                                <label class="checkbox">
                                                                    <input type="checkbox" checked="checked" disabled="disabled" class="input-xs pp1 not get-{{ det.alumno }}" name="asistio[]"  value="{{ det.alumno }}">
                                                                    <i></i>

                                                                </label>

                                                            </td>
                                                            <td class="p_p0"> 

                                                                <label class="select" style="width: 118px;">
                                                                    <select id="input-detalle"  name="detalle[]" disabled="" class="input-xs pp1 not get-{{ det.alumno }}">
                                                                        <option value="" >SELECCIONE...</option>
                                                                        {% for entrada in entradas %}
                                                                            {% if entrada.codigo == asistio %}
                                                                                <option selected="selected" value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                            {% else %}

                                                                                {% if entrada.codigo == 1 %}
                                                                                    <option selected="selected" value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% else %}

                                                                                    <option value="{{ entrada.codigo}}">{{ entrada.nombres }}</option>   
                                                                                {% endif %}


                                                                            {% endif %}

                                                                        {% endfor %}
                                                                    </select> <i></i> 
                                                                </label>
                                                            </td>


                                                            <td class="p_p2">
                                                                <label class="input"><input class="input-xs pp2 not get-{{ det.alumno }}" type="text" id="input-observaciones" name="observaciones[]" placeholder="" value="" disabled></label>

                                                            </td>


                                                        </tr>
                                                    {% endfor %}


                                                {% endif %}


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7">
                                            <center>
                                                <a href="javascript:history.back()" type="button" class="btn btn-sm btn-default" >Volver <i class="fa fa-chevron-circle-left"></i> </a>
                                                <button id="guardar" type="button" class="btn btn-sm btn-primary" >Guardar <i class="fa fa-save"></i> </button>

                                            </center>
                                            </td>
                                            </tr>
                                            </tfoot>
                                        </table>


                                        <!--</div>-->

                                        <!--  </div> -->        

                                    </fieldset>


                                    {{ endForm() }}       




                                </div>
                            </div>

                        </div>
                        <!-- Widget ID (each widget will need unique ID)-->

                        <!-- end widget -->	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<div class="hidden">
    <div id="confirmar_asistencia">
        <p>
            Debe Selecionar una asignatura
        </p>
    </div>
</div>

<div class="hidden">
    <div id="exito_asistencia">
        <p>
            Se grabo Asistencia correctamente...
        </p>
    </div>
</div>
