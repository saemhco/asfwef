<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_indicador_aei = "" %}
{% set id_accion_ei = "" %}
{% set ano_eje = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set orden = "" %}
{% set avance = "" %}


{% set resultado =  "" %}
{% set meta_programada =  "" %}
{% set porcentaje_obtenido =  "" %}
{% set porcentaje_resultado =  "" %}


{% set enlace = "" %}
{% set estado = "" %}




{% if indicadoresaei.id_indicador_aei is defined %}
    {% set id_indicador_aei = indicadoresaei.id_indicador_aei %}
{% endif %}

{% if indicadoresaei.id_accion_ei is defined %}
    {% set id_accion_ei = indicadoresaei.id_accion_ei %}
{% endif %}

{% if indicadoresaei.ano_eje is defined %}
    {% set ano_eje = indicadoresaei.ano_eje %}
{% endif %}

{% if indicadoresaei.nombre is defined %}
    {% set nombre = indicadoresaei.nombre %}
{% endif %}

{% if indicadoresaei.descripcion is defined %}
    {% set descripcion = indicadoresaei.descripcion %}
{% endif %}

{% if indicadoresaei.orden is defined %}
    {% set orden = indicadoresaei.orden %}
{% endif %}

{% if indicadoresaei.avance is defined %}
    {% set avance = indicadoresaei.avance %}
{% endif %}


{% if indicadoresaei.resultado is defined %}
    {% set resultado = indicadoresaei.resultado %}
{% endif %}

{% if indicadoresaei.meta_programada is defined %}
    {% set meta_programada = indicadoresaei.meta_programada %}
{% endif %}

{% if indicadoresaei.porcentaje_obtenido is defined %}
    {% set porcentaje_obtenido = indicadoresaei.porcentaje_obtenido %}
{% endif %}

{% if indicadoresaei.porcentaje_resultado is defined %}
    {% set porcentaje_resultado = indicadoresaei.porcentaje_resultado %}
{% endif %}

{% if indicadoresaei.enlace is defined %}
    {% set enlace = indicadoresaei.enlace %}
{% endif %}



{% set txt_buton = "Guardar" %}
{% if indicadoresaei.estado is defined %}
    {% set estado = indicadoresaei.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Indicadores a.e.i</li>
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
                                <h2>Registro de Inidcadores a.e.i </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroaeii/save','method': 'post','id':'form_registroaeii','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-3">

                                                <label class="text-info" >Año
                                                </label>
                                                <label class="select">

                                                    {% if estado == ""  %}
                                                        <select id="input-ano_eje"  name="ano_eje">
                                                            <option value="" >Seleccione... {{anio_actual}}</option>
                                                            {% for anio_model in anios %}
                                                                {% if anio_model.nombres == anio_actual %}
                                                                    <option selected="selected" value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% else %}
                                                                    <option value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% endif %}

                                                            {% endfor %}
                                                        </select> <i></i>
                                                    {% else %}
                                                        <select id="input-ano_eje_readonly"  name="ano_eje" disabled="true">
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


                                                <section class="col col-md-12">

                                                    <label class="text-info" >Accion e.i
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-id_accion_ei"  name="id_accion_ei" >
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i>
                                                    </label>
                                                </section>
                                            {% endif %}



                                            <section class="col col-md-4">
                                                <label class="text-info" > Código </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="{{ id_indicador_aei }}" readonly="">
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

                                                    {% if estado !== "" %}                         
                                                        <input type="hidden" id="input-ano_eje" name="ano_eje" value="{{ ano_eje }}">
                                                        <input type="hidden" id="input-id_accion_ei" name="id_accion_ei" value="{{ id_accion_ei }}">
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
                                                <label class="text-info" >Resultado </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-resultado" name="resultado" placeholder="Resultado" value="{{ resultado }}" >
                                                </label>
                                            </section>




                                            <section class="col col-md-2">
                                                <label class="text-info" >Meta programada </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-meta_programada" name="meta_programada" placeholder="Meta programada" value="{{ meta_programada }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Porcentaje obtenido </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-porcentaje_obtenido" name="porcentaje_obtenido" placeholder="Porcentaje obtenido" value="{{ porcentaje_obtenido }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Porcentaje resultado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-porcentaje_resultado" name="porcentaje_resultado" placeholder="Porcentaje resultado" value="{{ porcentaje_resultado }}" >
                                                </label>
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info" >Orden </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden" placeholder="Número" value="{{ orden }}" >
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
    <div id="exito_registroaeii">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_objetivosei">

        <p>
            Debe seleccionar un Obejtivosei...

        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_indicadoresei">

        <p>
            Debe seleccionar un indicadorei...

        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_accionesei">

        <p>
            Debe seleccionar una accion aei...

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

    {% if id1 is defined %}
        id1 = '{{ id_accion_ei }}';
    {% endif %}

        //alert(id_indicador_oei);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>