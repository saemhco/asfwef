{% set codigo = "" %}
{% if admision.codigo is defined %}
    {% set codigo = admision.codigo %}
{% endif %}

{% set descripcion = "" %}
{% if admision.descripcion is defined %}
    {% set descripcion = admision.descripcion %}
{% endif %}

{% set semestre = "" %}
{% if admision.semestre is defined %}
    {% set semestre = admision.semestre %}
{% endif %}

{% set anio = "" %}
{% if admision.anio is defined %}
    {% set anio = admision.anio %}
{% endif %}

{% set fecha_hora_ordinario = "" %}
{% if admision.fecha_hora_ordinario is defined %}
    {% set fecha_hora_ordinario =  utilidades.fechita(admision.fecha_hora_ordinario,'d/m/Y') %}
    {% set hora_ordinario = utilidades.hora_formato(admision.fecha_hora_ordinario,'H:i:s') %}
{% endif %}

{% set fecha_hora_extraordinario = "" %}
{% if admision.fecha_hora_extraordinario is defined %}
    {% set fecha_hora_extraordinario =  utilidades.fechita(admision.fecha_hora_extraordinario,'d/m/Y') %}
    {% set hora_extraordinario = utilidades.hora_formato(admision.fecha_hora_extraordinario,'H:i:s') %}
{% endif %}

{% set lugar_ordinario = "" %}
{% if admision.lugar_ordinario is defined %}
    {% set lugar_ordinario = admision.lugar_ordinario %}
{% endif %}

{% set lugar_extraordinario = "" %}
{% if admision.lugar_extraordinario is defined %}
    {% set lugar_extraordinario = admision.lugar_extraordinario %}
{% endif %}

{% set observacion = "" %}
{% if admision.observacion is defined %}
    {% set observacion = admision.observacion %}
{% endif %}

{% set imagen = "" %}
{% if admision.imagen is defined %}
    {% set imagen = admision.imagen %}
{% endif %}

{% set archivo = "" %}
{% if admision.archivo is defined %}
    {% set archivo = admision.archivo %}
{% endif %}

{% set activo = "" %}
{% if admision.activo is defined %}
    {% set activo = admision.activo %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if admision.estado is defined %}
    {% set estado = admision.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Admisión</li>
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
                                <h2>Registro de Admisión  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('admision/save','method': 'post','id':'form_admision','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">


                                            <section class="col col-md-6">
                                                <label class="text-info" >Descripción</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-descripcion" name="descripcion" placeholder="Nombre descripcion" value="{{ descripcion }}" >
                                                    <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Año</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-anio" name="anio" placeholder="Año" value="{{ anio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Semestre</label>
                                                <label class="select">
                                                    <select id="input-semestre"  name="semestre">
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for semestre_select in semestres %}
                                                            {% if semestre_select.codigo == semestre %}
                                                                <option selected="selected" value="{{ semestre_select.codigo }}">{{ semestre_select.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ semestre_select.codigo }}">{{ semestre_select.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>





                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha Ordinario</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_hora_ordinario" name="fecha_hora_ordinario" placeholder="Fecha Ordinario" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_hora_ordinario }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Ordinario</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_ordinario }}" name="hora_ordinario">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_ordinario">
                                                        {% endif %}


                                                    </div>
                                                </div>
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha Extraordinario</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_hora_extraordinario" name="fecha_hora_extraordinario" placeholder="Fecha Extraordinario" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_hora_extraordinario }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <div class="form-group">
                                                    <label class="text-info" >Hora Extraordinario</label>
                                                    <div class="input"><i class="icon-prepend fa fa-clock-o"></i>
                                                        {% if estado !== "" %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="{{ hora_extraordinario }}" name="hora_extraordinario">
                                                        {% else %}
                                                            <input class="input-clockpicker"  type="text" placeholder="" data-autoclose="true" value="00:00" name="hora_extraordinario">
                                                        {% endif %}

                                                    </div>
                                                </div>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Lugar Ordinario</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-lugar_ordinario" name="lugar_ordinario" placeholder="Lugar Ordinario" value="{{ lugar_ordinario }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Lugar Extraordinario</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-lugar_extraordinario" name="lugar_extraordinario" placeholder="Lugar Extraordinario" value="{{ lugar_extraordinario }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Observacion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-observacion" name="observacion">{{ observacion }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Estado</label>
                                                <label class="checkbox" style="pointer-events: none;">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" id="input-estado" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="estado" id="input-estado">
                                                    {% endif %}
                                                    <i></i>Activar / Desactivar</label>
                                            </section>

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
    <div id="success">
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