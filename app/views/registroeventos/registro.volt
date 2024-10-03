<style>
    #cke_input-texto_complementario {
        border:solid 1px black;
    }

    #cke_input-texto_muestra {
        border:solid 1px black;
    }
</style>

{% set id_evento = "" %}
{% set titular = "" %}
{% set texto_muestra = "" %}
{% set texto_complementario = "" %}
{% set fecha_hora = "" %}
{% set estado = "" %}
{% set archivo = "" %}
{% if eventos.archivo is defined %}
    {% set archivo = eventos.archivo %}
{% endif %}


{% if eventos.titular is defined %}
    {% set titular = eventos.titular %}
{% endif %}

{% if eventos.texto_muestra is defined %}
    {% set texto_muestra = eventos.texto_muestra %}
{% endif %}

{% if eventos.texto_complementario is defined %}
    {% set texto_complementario = eventos.texto_complementario %}
{% endif %}

{% if eventos.fecha_hora is defined %}
    {% set fecha_hora = utilidades.fechita(eventos.fecha_hora,'d/m/Y') %}
{% endif %}



{% if eventos.id_evento is defined %}
    {% set id_evento = eventos.id_evento %}
{% endif %}

{% set imagen = "" %}
{% if eventos.imagen is defined %}
    {% set imagen = eventos.imagen %}
{% endif %}

{% set id_servicio = "" %}
{% if eventos.id_servicio is defined %}
    {% set id_servicio = eventos.id_servicio %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if eventos.estado is defined %}
    {% set estado = eventos.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Eventos</li>
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
                                <h2>Registro de Eventos  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroeventos/save','method': 'post','id':'form_eventos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-3" >
                                                <label class="text-info" >Fecha de Lanzamienro {{ id_evento }}</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_hora" name="fecha_hora" placeholder="Fecha de hora" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_hora }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info" >Nombre del Evento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular" placeholder="Nombre Evento" value="{{ titular }}" >
                                                    <input type="hidden" id="input-id_evento" name="id_evento" value="{{ id_evento }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Texto Muestra</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-texto_muestra" name="texto_muestra">{{ texto_muestra }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Texto Complementario</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="10" id="input-texto_complementario" name="texto_complementario_ckeditor" >{{ texto_complementario }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Servicios</label>
                                                <label class="select">
                                                    <select id="input-id_servicio"  name="id_servicio" >
                                                        <option value="0" >Seleccione...</option>
                                                        {% for servicios_select in servicios %}
                                                            {% if servicios_select.id_servicio == id_servicio %}
                                                                <option selected="selected" value="{{ servicios_select.id_servicio }}">{{ servicios_select.titular }}</option>   
                                                            {% else %}
                                                                <option value="{{ servicios_select.id_servicio }}">{{ servicios_select.titular }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section> 

                                            <section class="col col-md-12" >

                                                {% if eventos.imagen is defined %}
                                                    <label class="text-info" >Imagen Evento</label>
                                                    <br>
                                                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/eventos/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                {% endif %}

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="input-imagen_evento" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>



                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_evento" name="archivo">
                                                    {#<input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/eventos/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
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
    </div>  
    {% if eventos.id_evento is defined %}
        <div class="row">
            <div class="col-sm-1">
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
                            <a href="javascript:void(0);"  onclick="agregar_eventos_imagenes();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_eventos_imagenes();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_eventos_imagenes();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-11">
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
                                    <h2>Eventos Imagenes </h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_eventos_imagenes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>

                                            <th data-class="expand">Imagen Evento</th>
                                            <th>Evento</th>
                                            <th data-hide="phone,tablet">Fecha </th>
                                            <th data-hide="phone,tablet">Enlace</th>
                                            <th data-hide="phone,tablet">Estado</th>


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

        <div class="row">
            <div class="col-sm-1">
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
                            <a href="javascript:void(0);"  onclick="agregar_eventos_archivos();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_eventos_archivos();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_eventos_archivos();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-11">
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
                                    <h2>Eventos Archivos</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">                                      
                                        <input class="form-control" type="text">    
                                    </div>                                      
                                    <div class="widget-body no-padding">                                        

                                        <table id="tbl_eventos_archivos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>                         
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>

                                            <th data-class="expand">Evento</th>
                                            <th data-hide="phone,tablet">Fecha </th>
                                            <th data-hide="phone,tablet">Enlace</th>
                                            <th data-hide="phone,tablet">Archivo</th>
                                            <th data-hide="phone,tablet">Estado</th>

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
    {% endif %}

</div>
<div class="hidden">
    <div id="exito_eventos">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>


<!--Formulario de registro detalle-->
{{ form('registroeventos/saveEventosImagenes','method': 'post','id':'form_eventos_imagenes','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Titular</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_eventos_imagenes" name="titular_eventos_imagenes" placeholder="Titular">
                <input type="hidden" id="input-id_evento_imagen" name="id_evento_imagen" value="">
                <input type="hidden" id="input-id_evento_modal" name="id_evento" value="{{ id_evento }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_eventos_imagenes" name="fecha_hora_eventos_imagenes" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_eventos_imagenes" name="enlace_eventos_imagenes" placeholder="Enlace" value="">

            </label>
        </section>


        <section class="col col-md-12" >
            <img id="imagen_eventos_imagenes" class="img-responsive"></img>
            <div class="input input-file" {#style="margin-top: 26px;"#}>
                <label class="text-info" >Agregar Imagen (600x400 px)</label>
                <label class="input">
                    <input id="imagen_eventos_imagenes" type="file" name="imagen_eventos_imagenes" onchange="this.parentNode.nextSibling.value = this.value">
                </label>
            </div>
        </section>



    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

<!--Formulario de registro archivos-->
{{ form('registroeventos/saveEventosArchivos','method': 'post','id':'form_eventos_archivos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Titular</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_eventos_archivos" name="titular_eventos_archivos" placeholder="Titular">
                <input type="hidden" id="input-id_evento_archivo" name="id_evento_archivo" value="">
                <input type="hidden" id="input-id_evento_modal_2" name="id_evento" value="{{ id_evento }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_eventos_archivos" name="fecha_hora_eventos_archivos" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_eventos_archivos" name="enlace_eventos_archivos" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;" id="ver_archivo">
                <input type="file" id="archivo_eventos_archivos" name="archivo_eventos_archivos">
                <input type="hidden" id="input-archivo_eventos_archivos" name="imput-archivo_eventos_archivos" value="">
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
    var id_evento_js = {{ id_evento_js }};
    console.log(id_evento_js);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>