<style>
    #cke_input-texto_complementario {
        border: solid 1px black;
    }
</style>
{% set id_noticia = "" %}
{% set titular = "" %}
{% set texto_muestra = "" %}
{% set texto_complementario = "" %}
{% set fecha_hora = "" %}

{% set archivo = "" %}
{% set imagen = "" %}
{% set estado = "" %}



{% if noticias.titular is defined %}
{% set titular = noticias.titular %}
{% endif %}

{% if noticias.texto_muestra is defined %}
{% set texto_muestra = noticias.texto_muestra %}
{% endif %}

{% if noticias.texto_complementario is defined %}
{% set texto_complementario = noticias.texto_complementario %}
{% endif %}

{% if noticias.fecha_hora is defined %}
{% set fecha_hora = utilidades.fechita(noticias.fecha_hora,'d/m/Y') %}
{% endif %}

{% if noticias.archivo is defined %}
{% set archivo = noticias.archivo %}
{% endif %}

{% if noticias.imagen is defined %}
{% set imagen = noticias.imagen %}
{% endif %}


{% if noticias.id_noticia is defined %}
{% set id_noticia = noticias.id_noticia %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if noticias.estado is defined %}
{% set estado = noticias.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Noticias </li>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Noticias </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registronoticias/save','method':
                                    'post','id':'form_noticias','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha de Lanzamienro (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == "" %}
                                                    <input type="text" id="input-fecha_hora" name="fecha_hora"
                                                        placeholder="Fecha de hora" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">

                                                    {% else %}
                                                    <input type="text" id="input-fecha_hora" name="fecha_hora"
                                                        placeholder="Fecha de hora" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_hora }}">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info">Titular Noticia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular"
                                                        placeholder="Nombre Noticia" value="{{ titular }}">
                                                    <input type="hidden" id="input-id_noticia" name="id_noticia"
                                                        value="{{ id_noticia }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Texto Muestra</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-texto_muestra"
                                                        name="texto_muestra">{{ texto_muestra }}</textarea>
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Texto Complementario</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="16" id="input-texto_complementario"
                                                        name="texto_complementario_ckeditor">{{ texto_complementario }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen Noticia</label>

                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/noticias/'~imagen) }}"
                                                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                        {#<input type="hidden" id="input-imagen_noticia"
                                                            name="imagen_noticia" value="">#}
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_noticia" name="archivo_noticia">
                                                    {#<input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/noticias/'~archivo) }}"> <i
                                                            class="fa-fw fa fa-eye"></i></a>
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
                                                    <input type="checkbox" name="estado" value="{{ estado }}"
                                                        id="estado" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="estado" value="{{ estado }}"
                                                        id="estado">
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
                                        <a href="javascript:history.back()" type="button" class="btn btn-default">
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

        {% if estado !== "" %}
        <div class="row">
            <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                    data-widget-custombutton="false" data-widget-sortable="false">
                    <header class="">
                        <center style="margin-top: -5px !important;">
                            <span class="widget-icon">Opciones</span>
                        </center>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">

                        </div>
                        <div class="widget-body text-center">
                            <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                    class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                    class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i
                                    class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                    class="fa fa-trash"></i></a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-11" style="margin-bottom: -30px;">
                <section id="widget-grid" class="">
                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                                data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                data-widget-colorbutton="false" data-widget-custombutton="false"
                                data-widget-sortable="false" data-widget-togglebutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Imagenes Noticias</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="widget-body no-padding">

                                        <table id="tbl_noticias_detalles"
                                            class="table tablecuriosity table-striped table-bordered table-hover"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <center><i class="fa fa-check-circle"></i></center>
                                                    </th>

                                                    <th data-class="expand">Imagen _ Detalle</th>
                                                    <th>Noticia - Detalle</th>
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
        {% endif %}

    </div>
</div>
<div class="hidden">
    <div id="exito_noticias">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<!--Formulario de registro detalle-->
{{ form('registronoticias/saveDetalles','method':
'post','id':'form_noticias_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Titular</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titular_detalle" name="titular_detalle" placeholder="Titular">
                <input type="hidden" id="input-id_noticia_detalle" name="id_noticia_detalle" value="">
                <input type="hidden" id="input-id_noticia_modal" name="id_noticia" value="{{ id_noticia }}">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Fecha (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_detalle" name="fecha_hora_detalle" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Enlace</label>
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

            <label class="text-info">Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;">

                <input type="file" id="archivo_noticia_detalle" name="archivo_noticia_detalle">
                <input type="hidden" id="input-archivo_detalle" name="imput-archivo_detalle" value="">
            </div>



        </section>

        <section class="col col-md-6">
            <div class="input input-file" style="margin-top: 5px;">
                <label class="text-info">Agregar Imagen</label>
                <label class="input">
                    <input id="imagen_noticias_detalle" type="file" name="imagen_noticia_detalle">
                </label>
            </div>
        </section>



    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->
<script type="text/javascript">
    var idl = "";
    var publica = "si";

    {% if id is defined %}
    idl = {{ id }};
    {% endif %}



        //alert("Hola");
</script>
<script type="text/javascript">
    var id_noticia = {{ id_noticia }};
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>