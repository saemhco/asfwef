<style>
    #cke_input-texto_muestra {
        border:solid 1px black;
    }
</style>

{% set id_boletin = "" %}
{% set tipo = "" %}
{% set titular = "" %}
{% set texto_muestra = "" %}
{% set fecha_hora = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set imagen = "" %}
{% set estado = "" %}

{% if boletines.tipo is defined %}
    {% set tipo = boletines.tipo %}
{% endif %}

{% if boletines.titular is defined %}
    {% set titular = boletines.titular %}
{% endif %}


{% if boletines.texto_muestra is defined %}
    {% set texto_muestra = boletines.texto_muestra %}
{% endif %}

{% if boletines.fecha_hora is defined %}
    {% set fecha_hora = utilidades.fechita(boletines.fecha_hora,'d/m/Y') %}
{% endif %}

{% if boletines.archivo is defined %}
    {% set archivo = boletines.archivo %}
{% endif %}

{% if boletines.enlace is defined %}
    {% set enlace = boletines.enlace %}
{% endif %}

{% if boletines.imagen is defined %}
    {% set imagen = boletines.imagen %}
{% endif %}



{% if boletines.id_boletin is defined %}
    {% set id_boletin = boletines.id_boletin %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if boletines.estado is defined %}
    {% set estado = boletines.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Boletines</li>
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
                                <h2>Registro de Boletines  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroboletines/save','method': 'post','id':'form_boletines','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3" >
                                                <label class="text-info" >Fecha (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>


                                                    {% if estado == ""   %}
                                                        <input type="text" id="input-fecha_hora" name="fecha_hora" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    {% else %}
                                                        <input type="text" id="input-fecha_hora" name="fecha_hora" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_hora }}">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info" >Boletín</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular" placeholder="Nombre titular" value="{{ titular }}" >
                                                    <input type="hidden" id="input-id_boletin" name="id_boletin" value="{{ id_boletin }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Texto Muestra</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-texto_muestra" name="texto_muestra">{{ texto_muestra }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >

                                                </label>
                                            </section>


                                            <section class="col col-md-12" >
                                                <label class="text-info" >Imagen Boletin</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/boletines/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_boletin" name="archivo_boletin">

                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/boletines/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                    </div>


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
    <div id="exito_boletines">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_resolucion_registrada">
        <p>
            Resolucion ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de resolución...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de convocatoria...

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