<style>
    #cke_input-texto_complementario {
        border:solid 1px black;
    }
</style>
{% set id_ambiente = "" %}
{% set codigo = "" %}
{% set titular = "" %}
{% set texto_muestra = "" %}
{% set texto_complementario = "" %}
{% set fecha_hora = "" %}
{% set archivo = "" %}
{% set imagen = "" %}
{% set estado = "" %}
{% set orden = "" %}

{% if ambientes.orden is defined %}
    {% set orden = ambientes.orden %}
{% endif %}

{% if ambientes.codigo is defined %}
    {% set codigo = ambientes.codigo %}
{% endif %}

{% if ambientes.titular is defined %}
    {% set titular = ambientes.titular %}
{% endif %}

{% if ambientes.texto_muestra is defined %}
    {% set texto_muestra = ambientes.texto_muestra %}
{% endif %}

{% if ambientes.texto_complementario is defined %}
    {% set texto_complementario = ambientes.texto_complementario %}
{% endif %}

{% if ambientes.fecha_hora is defined %}
    {% set fecha_hora = utilidades.fechita(ambientes.fecha_hora,'d/m/Y') %}
{% endif %}

{% if ambientes.archivo is defined %}
    {% set archivo = ambientes.archivo %}
{% endif %}


{% if ambientes.imagen is defined %}
    {% set imagen = ambientes.imagen %}
{% endif %}




{% if ambientes.id_ambiente is defined %}
    {% set id_ambiente = ambientes.id_ambiente %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if ambientes.estado is defined %}
    {% set estado = ambientes.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Ambientes</li>
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
                                <h2>Registro de Ambientes  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroambientesweb/save','method': 'post','id':'form_ambientes','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            {#<section class="col col-md-3" >
                                                <label class="text-info" >Fecha de Lanzamienro (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_hora" name="fecha_hora" placeholder="Fecha de hora" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_hora }}">
                                                </label>
                                            </section>#}

                                            <section class="col col-md-3">
                                                <label class="text-info" >Codigo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder="Codigo" value="{{ codigo }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-7">
                                                <label class="text-info" >Ambiente</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular" placeholder="Nombre Ambiente" value="{{ titular }}" >
                                                    <input type="hidden" id="input-id_ambiente" name="id_ambiente" value="{{ id_ambiente }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info">Orden</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden"
                                                        placeholder="Orden" value="{{ orden }}">                                                    
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
                                                    <textarea rows="16" id="input-texto_complementario" name="texto_complementario_ckeditor" >{{ texto_complementario }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12" >




                                                {% if ambientes.imagen is defined %}
                                                    <label class="text-info" >Imagen Ambiente</label>

                                                    <br>
                                                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/ambientes/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                {% endif %}


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

                                                    <input type="file" id="archivo_ambiente" name="archivo">
                                                    {#<input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/ambientes/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            {#<section class="col col-md-3" style="margin-top: 25px;">
                                                <label class="checkbox">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado">
                                                    {% endif %}
                                                    <i></i>Estado</label>
                                            </section>#}

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
                            <a href="javascript:void(0);"  onclick="agregar_ambientes_imagenes();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_ambientes_imagenes();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_ambientes_imagenes();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                    <h2>Ambientes Imagenes</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_ambientes_imagenes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>

                                            <th data-class="expand">Imagen</th>
                                            <th data-hide="phone,tablet">Titular</th>
                                            <th data-hide="phone,tablet">Fecha</th>
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
                            <a href="javascript:void(0);"  onclick="agregar_ambientes_archivos();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_ambientes_archivos();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_ambientes_archivos();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                    <h2>Ambientes Archivos</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_ambientes_archivos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
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
    </div>  
</div>
<div class="hidden">
    <div id="exito_ambientes">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<!--Formulario de registro imagenes-->
{{ form('registroambientesweb/saveAmbientesImagenes','method': 'post','id':'form_ambientes_imagenes','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Servicio Detalle</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_ambientes_imagenes" name="titular_ambientes_imagenes" placeholder="Titular">
                <input type="hidden" id="input-id_ambiente_imagen" name="id_ambiente_imagen" value="">
                <input type="hidden" id="input-id_ambiente_modal" name="id_ambiente" value="{{ id_ambiente }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_ambientes_imagenes" name="fecha_hora_ambientes_imagenes" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_ambientes_imagenes" name="enlace_ambientes_imagenes" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-12" >
            <img id="imagen_ambientes_imagenes" class="img-responsive"></img>
            <div class="input input-file">
                <label class="text-info" >Agregar Imagen</label>
                <label class="input">
                    <input id="input-imagen_ambientes_imagenes" type="file" name="imagen_ambientes_imagenes" onchange="this.parentNode.nextSibling.value = this.value">
                </label>
            </div>
        </section>
    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

<!--Formulario de registro archivos-->
{{ form('registroambientesweb/saveAmbientesArchivos','method': 'post','id':'form_ambientes_archivos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Titular</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_ambientes_archivos" name="titular_ambientes_archivos" placeholder="Titular">
                <input type="hidden" id="input-id_ambiente_archivo" name="id_ambiente_archivo" value="">
                <input type="hidden" id="input-id_ambiente_modal_2" name="id_ambiente" value="{{ id_ambiente }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_ambientes_archivos" name="fecha_hora_ambientes_archivos" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_ambientes_archivos" name="enlace_ambientes_archivos" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-12">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="ver_archivo">

                <input type="file" id="archivo_ambientes_archivos" name="archivo_ambientes_archivos">
                <input type="hidden" id="input-archivo_ambientes_archivos" name="imput-archivo_ambientes_archivos" value="">
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
    var id_ambiente_js = {{ id_ambiente_js }};
    console.log(id_ambiente_js);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>