<style>
    #cke_input-visto {
        border:solid 1px black;
    }
    #cke_input-resuelve {
        border:solid 1px black;
    }
</style>

{% set id_acta = "" %}
{% set numero = "" %}
{% set fecha = "" %}
{% set visto = "" %}
{% set resuelve = "" %}
{% set titulo = "" %}
{% set archivo = "" %}
{% set tipo = "" %}
{% set anio = "" %}

{% set visible = "" %}
{% set escaneado = "" %}
{% set resumen = "" %}

{% set estado = "" %}



{% if actas.numero is defined %}
    {% set numero = actas.numero %}
{% endif %}


{% if actas.visto is defined %}
    {% set visto = actas.visto %}
{% endif %}

{% if actas.resuelve is defined %}
    {% set resuelve = actas.resuelve %}
{% endif %}

{% if actas.fecha is defined %}
    {% set fecha = utilidades.fechita(actas.fecha,'d/m/Y') %}
{% endif %}

{% if actas.titulo is defined %}
    {% set titulo = actas.titulo %}
{% endif %}

{% if actas.archivo is defined %}
    {% set archivo = actas.archivo %}
{% endif %}

{% if actas.tipo is defined %}
    {% set tipo = actas.tipo %}
{% endif %}

{% if actas.anio is defined %}
    {% set anio = actas.anio %}
{% endif %}

{% if actas.visible is defined %}
    {% set visible = actas.visible %}
{% endif %}

{% if actas.escaneado is defined %}
    {% set escaneado = actas.escaneado %}
{% endif %}

{% if actas.resumen is defined %}
    {% set resumen = actas.resumen %}
{% endif %}


{% if actas.id_acta is defined %}
    {% set id_acta = actas.id_acta %}
{% endif %}

{% set imagen = "" %}
{% if actas.imagen is defined %}
    {% set imagen = actas.imagen %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if actas.estado is defined %}
    {% set estado = actas.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Actas</li>
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
                                <h2>Registro de Actas  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroactas/save','method': 'post','id':'form_actas','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">

                                                <label class="text-info" >Tipo de acta 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for tipoactas_select in tipoactas %}
                                                            {% if tipoactas_select.codigo == tipo %}
                                                                <option selected="selected" value="{{ tipoactas_select.codigo }}">{{ tipoactas_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipoactas_select.codigo }}">{{ tipoactas_select.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-3" >
                                                <label class="text-info" >Fecha</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == ""  %}
                                                        <input type="text" id="input-fecha" name="fecha" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                        <input type="hidden" id="input-id_acta" name="id_acta" value="{{ id1 }}" >
                                                        <input type="hidden" id="input-anio" name="anio" value="">
                                                    {% else %}
                                                        <input type="text" id="input-fecha" name="fecha" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha }}">
                                                        <input type="hidden" id="input-id_acta" name="id_acta" value="{{ id_acta }}" >
                                                        <input type="hidden" id="input-anio" name="anio" value="{{ anio }}">
                                                    {% endif %}

                                                </label>
                                            </section>



                                            <section class="col col-md-3" style="margin-top: 30px;">
                                                <label class="checkbox">
                                                    {% if visible == 1 %}
                                                        <input type="checkbox" name="visible" value="{{ visible }}" id="visible" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="visible" value="{{ visible }}" id="visible">
                                                    {% endif %}
                                                    <i></i>Visible</label>


                                            </section>

                                            <section class="col col-md-3" style="margin-top: 30px;">
                                                <label class="checkbox">
                                                    {% if escaneado == 1 %}
                                                        <input type="checkbox" name="escaneado" value="{{ escaneado }}" id="escaneado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="escaneado" value="{{ escaneado }}" id="escaneado">
                                                    {% endif %}
                                                    <i></i>Escaneado</label>


                                            </section>



                                            <section class="col col-md-3">
                                                <label class="text-info" >Número</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero" placeholder="Número" value="{{ numero }}" onblur="concatenacionNombre();">

                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info" >Acta</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="Acta" value="{{ titulo }}" readonly="">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Resumen</label>
                                                <label class="textarea"><i class="icon-append fa fa-comment"></i>  
                                                    <textarea rows="4"  id="input-resumen" name="resumen" >{{ resumen }} </textarea>

                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Visto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="16" id="input-visto" name="visto_ckeditor">{{ visto }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Resuelve</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="16" id="input-resuelve" name="resuelve_ckeditor" >{{ resuelve }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12" >

                                                {% if actas.imagen is defined %}
                                                    <label class="text-info" >Imagen</label>
                                                    <br>
                                                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/actas/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                {% endif %}

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="input-imagen_resolucion" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_acta" name="archivo_acta">
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                    {% if tipo == 1   %}

                                                        <div class="alert alert-success fade in">                                                        

                                                            Click aqui para ver el archivo 
                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/actas/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                        </div>
                                                    {% else %}
                                                        <div class="alert alert-success fade in">                                                        

                                                            Click aqui para ver el archivo 
                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/actas/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                        </div>
                                                    {% endif %}

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

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
    <div id="exito_resoluciones">
        <p>
            Se grabó acta correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_resolucion_registrada">
        <p>
            Acta ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el número de acta...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de acta...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_pdf">

        <p>
            Solo se permite archivos con extensión ".pdf" ...

        </p>
    </div>
</div>
<script type="text/javascript" >
    var id1 = "";
    var id2 = "";
    var publica = "si";
    var xAbrevIns = "{{ config.global.xAbrevIns }}";

    {% if id1 is defined %}
        id1 = {{ id1 }};
    {% endif %}

    {% if id2 is defined %}
        id2 = {{ id2 }};
    {% endif %}


</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>