<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_indicador_oei = "" %}
{% set id_objetivo_ei = "" %}
{% set ano_eje = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set orden = "" %}
{% set avance = "" %}
{% set enlace = "" %}
{% set estado = "" %}




{% if indicadoresoei.id_indicador_oei is defined %}
    {% set id_indicador_oei = indicadoresoei.id_indicador_oei %}
{% endif %}

{% if indicadoresoei.id_objetivo_ei is defined %}
    {% set id_objetivo_ei = indicadoresoei.id_objetivo_ei %}
{% endif %}

{% if indicadoresoei.ano_eje is defined %}
    {% set ano_eje = indicadoresoei.ano_eje %}
{% endif %}

{% if indicadoresoei.nombre is defined %}
    {% set nombre = indicadoresoei.nombre %}
{% endif %}

{% if indicadoresoei.descripcion is defined %}
    {% set descripcion = indicadoresoei.descripcion %}
{% endif %}

{% if indicadoresoei.orden is defined %}
    {% set orden = indicadoresoei.orden %}
{% endif %}

{% if indicadoresoei.avance is defined %}
    {% set avance = indicadoresoei.avance %}
{% endif %}

{% if indicadoresoei.enlace is defined %}
    {% set enlace = indicadoresoei.enlace %}
{% endif %}



{% set txt_buton = "Guardar" %}
{% if indicadoresoei.estado is defined %}
    {% set estado = indicadoresoei.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Indicadores o.e.i.</li>
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
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Inidcadores o.e.i. </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrooeii/save','method': 'post','id':'form_registrooeii','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-3">

                                                <label class="text-info" >Año
                                                </label>
                                                <label class="select">

                                                    {% if estado == ""  %}
                                                        <select id="input-ano_eje"  name="ano_eje">
                                                            <option value="" >Seleccione...</option>
                                                            {% for anio_model in anios %}
                                                                {% if anio_model.nombres == anio_actual %}
                                                                    <option selected="selected" value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% else %}
                                                                    <option value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% endif %}

                                                            {% endfor %}
                                                        </select> <i></i>
                                                    {% else %}
                                                        <select id="input-ano_eje"  name="ano_eje" disabled="true">
                                                            <option value="" >Seleccione...</option>
                                                            {% for anio_model in anios %}
                                                                {% if anio_model.nombres == ano_eje %}
                                                                    <option selected="selected" value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% else %}
                                                                    <option value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% endif %}

                                                            {% endfor %}
                                                        </select> <i></i>
                                                    {% endif %}

                                                </label>
                                            </section>
                                            {% if estado == "" %}
                                                <section class="col col-md-12">
                                                    <label class="text-info" >Objetivos ei</label>
                                                    <label class="select">
                                                        <select id="input-id_objetivo_ei"  name="id_objetivo_ei">
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i> 
                                                    </label>
                                                </section>
                                            {% endif %}



                                            <section class="col col-md-4">
                                                <label class="text-info" > Código </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="{{ id_indicador_oei }}" readonly="">
                                                    {% else %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="" readonly="">
                                                    {% endif %}


                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" >
                                                    <input type="hidden" id="input-id_indicador_oei" name="id_indicador_oei" value="{{ id_indicador_oei }}">

                                                    {% if estado !== "" %}
                                                        <input type="hidden" id="input-id_objetivo_ei" name="id_objetivo_ei" value="{{ id_objetivo_ei }}">
                                                        <input type="hidden" id="input-ano_eje" name="ano_eje" value="{{ ano_eje }}">
                                                    {% endif %}


                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Orden </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden" placeholder="Orden" value="{{ orden }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Avance </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-avance" name="avance" placeholder="Avance" value="{{ avance }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-2" style="margin-top: 25px;">
                                                <label class="checkbox" style="color: #346597;">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado">
                                                    {% endif %}
                                                    <i></i>Estado
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
<div class="hidden">
    <div id="exito_registrooeii">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_objetivoei">

        <p>
            Debe seleccionar un objetivoei...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_ano_eje">

        <p>
            Debe seleccionar un año...

        </p>
    </div>
</div>
<script type="text/javascript" >
    var id1 = "";
    var publica = "si";


    id_objetivo_ei = '{{ id_objetivo_ei }}';


        //alert(id_indicador_oei);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>