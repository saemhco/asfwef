<style>
    #cke_input-requisitos {
        border:solid 1px black;
    }
</style>
{% set titulo = "" %}
{#{% set codigo = "" %}#}
{% set descripcion = "" %}
{% set requisitos = "Requisitos de la Publicación" %}
{% set region_id = "" %}
{% set provincia_id = "" %}
{% set distrito_id = "" %}
{% set ciudad = "" %}
{% set idubigeo = "" %}
{% set tipocontrato = "" %}
{% set jornada = "" %}
{% set cargo = "" %}
{% set fecha_clausura = ""%}
{% set salario = ""%}
{% set cantidad_vacantes = ""%}
{% set txt_buton = "Publicar Ahora" %}
{% if empleo.codigo is defined %}
    {% set codigo = empleo.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% if empleo.titulo is defined %}
    {% set titulo = empleo.titulo %}
{% endif %}

{% if empleo.ciudad is defined %}
    {% set ciudad = empleo.ciudad %}
{% endif %}

{% if empleo.ubigeo_id is defined %}
    {% set idubigeo = empleo.ubigeo_id %}
{% endif %}

{% if empleo.descripcion is defined %}
    {% set descripcion = empleo.descripcion %}
{% endif %}

{% if empleo.requisitos is defined %}
    {% set requisitos = empleo.requisitos %}
{% endif %}

{% if empleo.region_id is defined %}
    {% set region_id = empleo.region_id %}
    {% set provincia_id = empleo.provincia_id %}
    {% set distrito_id = empleo.distrito_id %}
{% endif %}

{% if empleo.tipocontrato is defined %}
    {% set tipocontrato = empleo.tipocontrato %}
{% endif %}

{% if empleo.jornada is defined %}
    {% set jornada = empleo.jornada %}
{% endif %}

{% if empleo.cargo is defined %}
    {% set cargo = empleo.cargo %}
{% endif %}

{% if empleo.fecha_clausura is defined %}
    {% set fecha_clausura = utilidades.fechita(empleo.fecha_clausura,'d/m/Y') %}
{% endif %}

{% if empleo.salario is defined %}
    {% set salario = empleo.salario %}
{% endif %}

{% if empleo.cantidad_vacantes is defined %}
    {% set cantidad_vacantes = empleo.cantidad_vacantes %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Publicaciones</li><li>Publicar Empleo</li>
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Formulario de Empleos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('publicaciones/save','method': 'post','id':'form_empleos','class':'smart-form') }}
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12">
                                                <label class="text-info" >Titulo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="" value="{{ titulo }}" >
                                                    <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                </label>
                                            </section>                                            
                                            <section class="col col-md-6">
                                                <label class="text-info" >Descripcion de la publicación</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                                                    <textarea rows="5" id="input-descripcion" name="descripcion" placeholder="">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info" >Requisitos de la Publicación</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                                                    <textarea rows="5" id="input-requisitos" name="requisitosxd" >{{ requisitos }}</textarea> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Region</label>
                                                <label class="select">
                                                    <select id="input-region_id"  name="region_id" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for reg in regiones %}
                                                            {% if reg.region == region_id %}
                                                                <option selected="selected" value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Provincia</label>
                                                <label class="select">
                                                    <select id="input-provincia_id"  name="provincia_id" >
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Distrito</label>
                                                <label class="select">
                                                    <select id="input-distrito_id"  name="distrito_id" >
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Ubigeo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ubigeo_id" name="ubigeo_id" placeholder="" value="{{ idubigeo }}" readonly>                                              
                                                </label>
                                            </section>  
                                            <section class="col col-md-3">
                                                <label class="text-info" >Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad" placeholder="" value="{{ ciudad }}" >                                              
                                                </label>
                                            </section>  
                                            <section class="col col-md-3">
                                                <label class="text-info" >Tipo de Contrato</label>
                                                <label class="select">

                                                    <select id="input-tipocontrato"  name="tipocontrato" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tc in tipocontratos %} 
                                                            {% if tc.codigo == tipocontrato %}
                                                                <option selected value="{{ tc.codigo }}" >{{ tc.nombres }}</option>
                                                            {% else %}
                                                                <option value="{{ tc.codigo }}" >{{ tc.nombres }}</option>
                                                            {% endif %}
                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Tipo de jornada</label>
                                                <label class="select">
                                                    <select id="input-jornada"  name="jornada" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for j in jornadas %}  
                                                            {% if j.codigo == jornada %}
                                                                <option selected value="{{ j.codigo }}">{{ j.nombres }}</option>
                                                            {% else %}
                                                                <option value="{{ j.codigo }}">{{ j.nombres }}</option>
                                                            {% endif %}                                                                                                 
                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Cargo u Ocupación</label>
                                                <label class="select">
                                                    <select id="input-cargo"  name="cargo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for c in cargos %}
                                                            {% if c.codigo == cargo %}
                                                                <option selected value="{{ c.codigo }}">{{ c.nombres }}</option>
                                                            {% else %}
                                                                <option value="{{ c.codigo }}">{{ c.nombres }}</option>
                                                            {% endif %}                                   
                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                 <label class="text-info" >Fecha de Clausura</label>
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_clausura" name="fecha_clausura" placeholder="" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_clausura }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                 <label class="text-info" >Salario</label>
                                                <label class="input"> <i class="icon-prepend fa fa-money"></i>
                                                    <input type="text" id="input-salario" name="salario" placeholder="" value="{{ salario }}" >

                                                </label>
                                            </section>  
                                            <section class="col col-md-3">
                                                <label class="text-info" >Cantidad de Vacantes</label>
                                                <label class="input"> <i class="icon-prepend fa fa-group"></i>
                                                    <input type="text" id="input-cantidad_vacantes" name="cantidad_vacantes" placeholder="" value="{{ cantidad_vacantes }}" >


                                                </label>
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
<script type="text/javascript" >
    var region_id = '{{ region_id }}';
    var provincia_id = '{{ provincia_id }}';
    var distrito_id = '{{ distrito_id }}';
    console.log(distrito_id);

    var publica = "si";
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}"; var perfil_usuario = "{{ perfil }}";</script>