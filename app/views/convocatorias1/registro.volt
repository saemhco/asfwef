<style>
    #cke_input-texto_muestra {
        border:solid 1px black;
    }
</style>

{% set id_convocatoria = "" %}
{% set tipo = "" %}
{% set titular = "" %}
{% set texto_muestra = "" %}
{% set fecha_hora = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set etapa = "" %}
{% set estado = "" %}


{% if convocatorias.id_convocatoria is defined %}
    {% set id_convocatoria = convocatorias.id_convocatoria %}
{% endif %}


{% if convocatorias.tipo is defined %}
    {% set tipo = convocatorias.tipo %}
{% endif %}

{% if convocatorias.titular is defined %}
    {% set titular = convocatorias.titular %}
{% endif %}

{% if convocatorias.texto_muestra is defined %}
    {% set texto_muestra = convocatorias.texto_muestra %}
{% endif %}

{% if convocatorias.fecha_hora is defined %}
    {% set fecha_hora = utilidades.fechita(convocatorias.fecha_hora,'d/m/Y') %}
{% endif %}

{% if convocatorias.archivo is defined %}
    {% set archivo = convocatorias.archivo %}
{% endif %}

{% if convocatorias.enlace is defined %}
    {% set enlace = convocatorias.enlace %}
{% endif %}

{% if convocatorias.etapa is defined %}
    {% set etapa = convocatorias.etapa %}
{% endif %}

{% set fecha_boton_inicio = "" %}
{% if convocatorias.fecha_boton_inicio is defined %}
    {% set fecha_boton_inicio = utilidades.fechita(convocatorias.fecha_boton_inicio,'d/m/Y') %}
{% endif %}

{% set fecha_boton_fin = "" %}
{% if convocatorias.fecha_boton_fin is defined %}
    {% set fecha_boton_fin = utilidades.fechita(convocatorias.fecha_boton_fin,'d/m/Y') %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if convocatorias.estado is defined %}
    {% set estado = convocatorias.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% set imagen = "" %}
{% if convocatorias.imagen is defined %}
    {% set imagen = convocatorias.imagen %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Convocatorias</li>
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
                                <h2>Registro de Convocatorias </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('convocatorias1/save','method': 'post','id':'form_convocatorias','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">


                                            <section class="col col-md-4">

                                                <label class="text-info" >Tipo de Convocatoria
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipoconvocatoria in tipoconvocatorias %}
                                                            {% if tipoconvocatoria.codigo == tipo %}
                                                                <option selected="selected" value="{{ tipoconvocatoria.codigo }}">{{ tipoconvocatoria.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipoconvocatoria.codigo }}">{{ tipoconvocatoria.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4" >
                                                <label class="text-info" >Fecha (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    {% if estado == ""   %}
                                                        <input type="text" id="input-fecha" name="fecha_hora" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    {% else %}
                                                        <input type="text" id="input-fecha" name="fecha_hora" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_hora }}">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info" >Etapa
                                                </label>
                                                <label class="select">
                                                    <select id="input-etapa"  name="etapa" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for etapaconvocatoria_select in etapasconvocatorias %}
                                                            {% if etapaconvocatoria_select.codigo == etapa %}
                                                                <option selected="selected" value="{{ etapaconvocatoria_select.codigo }}">{{ etapaconvocatoria_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ etapaconvocatoria_select.codigo }}">{{ etapaconvocatoria_select.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-12">
                                                <label class="text-info" >Convocatoria</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular" placeholder="Nombre titular" value="{{ titular }}" >
                                                    <input type="hidden" id="input-id_convocatoria_registro" name="id_convocatoria" value="{{ id_convocatoria }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Texto Muestra</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-texto_muestra" name="texto_muestra">{{ texto_muestra }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4" >
                                                <label class="text-info" >Fecha Boton Inicio (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    <input type="text" id="input-fecha_boton_inicio" name="fecha_boton_inicio" placeholder="Fecha Boton Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_boton_inicio }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-4" >
                                                <label class="text-info" >Fecha Boton Fin (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    <input type="text" id="input-fecha_boton_fin" name="fecha_boton_fin" placeholder="Fecha Boton Fin" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_boton_fin }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-12" >
                                                <label class="text-info" >Imagen Convocatoria</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/convocatorias/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_convocatoria" name="archivo_convocatoria">
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
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
                        <a href="javascript:void(0);"  onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Archivos de Convocatorias</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_convocatoria_detalles" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>


                                        <th data-class="expand">Convocatoria</th>
                                        <th>Fecha</th>
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

        {% if activa_btn_docs !== 0 %}
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
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Proceso de Convocatoria</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body">


                                        <div class="well">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-guardar-documentos">
                                                <i class="fa fa-file-archive-o"></i> Guardar Documentos
                                            </button>
                                            <input type="hidden" id="input-convocatoria" name="convocatoria" value="{{ id_convocatoria }}">
                                        </div>

                                        <div class="well">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-registrar-personal">
                                                <i class="fa fa-users"></i> Registrar Personal
                                            </button>
                                            <input type="hidden" id="input-id_convocatoria" name="id_convocatoria" value="{{ id_convocatoria }}">
                                        </div>



                                        {#<div class="well">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-transferencia">
                                                <i class="fa fa-file-archive-o"></i> Tabla Origen => Tabla Destino
                                            </button>
                                            <input type="hidden" id="input-id_convocatoria" name="convocatoria" value="{{ id_convocatoria }}">
                                        </div>#}

                                    </div>
                                    <!-- end widget content -->	
                                </div>
                            </div>	
                        </article>	
                    </div>
                </section>
            </div>

        {% endif %}
    </div> 

</div>


<!--Formulario de registro -->
{{ form('convocatorias1/savearchivo','method': 'post','id':'form_convocatorias_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Convocatoria </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_detalle" name="titular_detalle" placeholder="Titular">
                <input type="hidden" id="input-id_convocatoria_detalle_pk" name="id_convocatoria_detalle" value="">
                <input type="hidden" id="input-id_convocatoria" name="id_convocatoria" value="{{ id_convocatoria }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_detalle" name="fecha_hora_detalle" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_detalle" name="enlace_detalle" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-12" >
            <label class="text-info" >Imagen Convocatoria Detalle</label>

            <br>
            <img id="imagen_detalle" class="img-responsive"  error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

            <div class="input input-file" style="margin-top: 26px;">
                <label class="text-info" >Agregar Imagen</label>
                <label class="input">
                    <input id="imagen_convocatorias_detalle" type="file" name="imagen_convocatoria_detalle" onchange="this.parentNode.nextSibling.value = this.value">
                </label>
            </div>
        </section>

        <section class="col col-md-12">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;" id="ver_archivo">

                <input type="file" id="archivo_convocatoria_detalle" name="archivo_convocatoria_detalle">
                <input type="hidden" id="input-archivo_detalle" name="imput-archivo_detalle" value="{{ archivo_detalle }}">
            </div>
        </section>





    </div>
</fieldset>
{{ endForm() }}



<div class="hidden">
    <div id="exito_convocatorias">
        <p>
            Se registró correctamente ...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_resolucion_registrada">
        <p>
            Convocatoria ya registrada...
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

<script type="text/javascript" >
    var id_convocatoria = {{ id_convocatoria }};
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>