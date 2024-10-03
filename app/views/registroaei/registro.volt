<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_accion_ei = "" %}
{% set id_objetivo_ei = "" %}
{% set ano_eje = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set orden = "" %}
{% set avance = "" %}
{% set enlace = "" %}
{% set estado = "" %}




{% if accionesei.id_accion_ei is defined %}
    {% set id_accion_ei = accionesei.id_accion_ei %}
{% endif %}

{% if accionesei.id_objetivo_ei is defined %}
    {% set id_objetivo_ei = accionesei.id_objetivo_ei %}
{% endif %}

{% if accionesei.ano_eje is defined %}
    {% set ano_eje = accionesei.ano_eje %}
{% endif %}

{% if accionesei.nombre is defined %}
    {% set nombre = accionesei.nombre %}
{% endif %}

{% if accionesei.descripcion is defined %}
    {% set descripcion = accionesei.descripcion %}
{% endif %}

{% if accionesei.orden is defined %}
    {% set orden = accionesei.orden %}
{% endif %}

{% if accionesei.avance is defined %}
    {% set avance = accionesei.avance %}
{% endif %}

{% if accionesei.enlace is defined %}
    {% set enlace = accionesei.enlace %}
{% endif %}



{% set txt_buton = "Guardar" %}
{% if accionesei.estado is defined %}
    {% set estado = accionesei.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Acciones e.i.</li>
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
                                <h2>Registro de Acciones e.i. </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroaei/save','method': 'post','id':'form_registroaei','class':'smart-form','enctype':'multipart/form-data') }}


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

                                                    <label class="text-info" >Objetivos ei 
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-id_objetivo_ei"  name="id_objetivo_ei" >
                                                            <option value="" >Seleccione...</option>
                                                            {% for objetivoei_model in objetivosei %}

                                                                <option value="{{ objetivoei_model.id_objetivo_ei }}" ano_eje="{{ objetivoei_model.ano_eje }}">{{ objetivoei_model.ano_eje }} - {{ utilidades.partedescripcion(objetivoei_model.descripcion,0,60) }}...</option>   


                                                            {% endfor %}
                                                        </select> <i></i>
                                                    </label>
                                                </section>

                                            {% endif %}



                                            <section class="col col-md-4">
                                                <label class="text-info" > Código </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="{{ id_accion_ei }}" readonly="">
                                                    {% else %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="" readonly="">
                                                    {% endif %}


                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombrex</label>
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
                                                <label class="text-info" >Número </label>
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
    <div id="exito_registroaei">
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
    <div id="error_indicadores">

        <p>
            Debe seleccionar un indicadorei...

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
        id1 = '{{ id_objetivo_ei }}';
    {% endif %}

        //alert(id_indicador_oei);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>