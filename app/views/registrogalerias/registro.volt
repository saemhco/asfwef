<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>
{% set id_galeria = "" %}
{% set titular = "" %}
{% set enlace = "" %}
{% set descripcion = "" %}
{% set fecha = "" %}
{% set archivo = "" %}

{% set estado = "" %}

{% set imagen = "" %}
{% if galerias.imagen is defined %}
    {% set imagen = galerias.imagen %}
{% endif %}

{% if galerias.titular is defined %}
    {% set titular = galerias.titular %}
{% endif %}

{% if galerias.enlace is defined %}
    {% set enlace = galerias.enlace %}
{% endif %}

{% if galerias.descripcion is defined %}
    {% set descripcion = galerias.descripcion %}
{% endif %}

{% if galerias.fecha is defined %}
    {% set fecha = utilidades.fechita(galerias.fecha,'d/m/Y') %}
{% endif %}

{% if galerias.archivo is defined %}
    {% set archivo = galerias.archivo %}
{% endif %}



{% if galerias.id_galeria is defined %}
    {% set id_galeria = galerias.id_galeria %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if galerias.estado is defined %}
    {% set estado = galerias.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Galerias</li>
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
                                <h2>Registro de Galerias  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrogalerias/save','method': 'post','id':'form_galerias','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3" >
                                                <label class="text-info" >Fecha de Lanzamienro (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    {% if estado == ""   %}
                                                        <input type="text" id="input-fecha" name="fecha" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    {% else %}
                                                        <input type="text" id="input-fecha" name="fecha" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha }}">
                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info" >Galeria</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular" placeholder="Nombre Galeria" value="{{ titular }}" >
                                                    <input type="hidden" id="input-id_galeria" name="id_galeria" value="{{ id_galeria }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Texto Complementario</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="16" id="input-descripcion" name="descripcion_ckeditor" >{{ descripcion }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-12" >
                                                <label class="text-info" >Imagen Galería</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/galerias/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen</label>
                                                    <label class="input">
                                                        <input id="imagen_galeria" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value" value="">
                                                    </label>
                                                </div>
                                            </section>
                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_galeria" name="archivo_galeria" value="">
                                                    {#<input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/galerias/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
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

                                    <fieldset>
                                        <div class="row">

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
       <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center">
                        <a href="javascript:void(0);"  onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>

        </div>
         <div class="col-sm-11" style="margin-bottom: -30px;">
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Imagenes Galerias</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_galerias_detalles" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>

                                        <th data-class="expand">Imagen _ Detalle</th>
                                        <th>Galeria - Detalle</th>
                                        <th data-hide="phone,tablet">Fecha - Detalle</th>
                                        <th data-hide="phone,tablet">Enlace - Detalle</th>
                                        <th data-hide="phone,tablet">Estado - Detalle</th>


                                        </tr>
                                        </thead>
                                        <tbody>			
                                        </tbody>
                                    </table>
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
    <div id="exito_galerias">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<!--Formulario de registro detalle-->
{{ form('registrogalerias/saveDetalles','method': 'post','id':'form_galerias_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Título</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_detalle" name="titular_detalle" placeholder="Titular">
                <input type="hidden" id="input-id_galeria_detalle" name="id_galeria_detalle" value="">
                <input type="hidden" id="input-id_galeria_modal" name="id_galeria" value="{{ id_galeria }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_detalle" name="fecha_hora_detalle" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_detalle" name="enlace_detalle" placeholder="Enlace" value="">

            </label>
        </section>
        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="estado_detalle" value="" id="input-estado_detalle">
                <i></i>Estado
            </label>
        </section>


        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;">

                <input type="file" id="archivo_galeria_detalle" name="archivo_galeria_detalle">
                <input type="hidden" id="input-archivo_detalle" name="input-archivo_detalle" value="">
            </div>


            {% if archivo !== ""   %}

                <div class="alert alert-success fade in">                                                        

                    Click aqui para ver el archivo 
                    <a class="btn btn-ribbon" target="_BLANK" role="button"  id="enlace_archivo">  <i class="fa-fw fa fa-eye"></i></a>
                </div>


            {% else %}

                <div class="alert alert-warning fade in">                                                       
                    <i class="fa-fw fa fa-warning"></i>
                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                </div>

            {% endif %}

        </section>

        <section class="col col-md-6" >
            <label class="text-info" >Imagen Convocatoria Detalle</label>

            <br>
            <img id="imagen_detalle" class="img-responsive"></img>

            <div class="input input-file" style="margin-top: 26px;">
                <label class="text-info" >Agregar Imagen</label>
                <label class="input">
                    <input id="imagen_galeria_detalle" type="file" name="imagen_galeria_detalle" onchange="this.parentNode.nextSibling.value = this.value" value="">
                </label>
            </div>
        </section>



    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->
<script type="text/javascript" >
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = {{ id }};
    {% endif %}



        //alert("Hola");
</script>
<script type="text/javascript" >
    var id_galeria = {{ id_galeria }};
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>