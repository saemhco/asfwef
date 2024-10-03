<style>
    #cke_input-visto {
        border: solid 1px black;
    }

    #cke_input-resuelve {
        border: solid 1px black;
    }
</style>

{% set id_resolucion = "" %}
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



{% if resoluciones.numero is defined %}
{% set numero = resoluciones.numero %}
{% endif %}


{% if resoluciones.visto is defined %}
{% set visto = resoluciones.visto %}
{% endif %}

{% if resoluciones.resuelve is defined %}
{% set resuelve = resoluciones.resuelve %}
{% endif %}

{% if resoluciones.fecha is defined %}
{% set fecha = utilidades.fechita(resoluciones.fecha,'d/m/Y') %}
{% endif %}

{% if resoluciones.titulo is defined %}
{% set titulo = resoluciones.titulo %}
{% endif %}

{% if resoluciones.archivo is defined %}
{% set archivo = resoluciones.archivo %}
{% endif %}

{% if resoluciones.tipo is defined %}
{% set tipo = resoluciones.tipo %}
{% endif %}

{% if resoluciones.anio is defined %}
{% set anio = resoluciones.anio %}
{% endif %}

{% if resoluciones.visible is defined %}
{% set visible = resoluciones.visible %}
{% endif %}

{% if resoluciones.escaneado is defined %}
{% set escaneado = resoluciones.escaneado %}
{% endif %}

{% if resoluciones.resumen is defined %}
{% set resumen = resoluciones.resumen %}
{% endif %}


{% if resoluciones.id_resolucion is defined %}
{% set id_resolucion = resoluciones.id_resolucion %}
{% endif %}

{% set imagen = "" %}
{% if resoluciones.imagen is defined %}
{% set imagen = resoluciones.imagen %}
{% endif %}

{% set id_documento = "" %}
{% if resoluciones.id_documento is defined %}
{% set id_documento = resoluciones.id_documento %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if resoluciones.estado is defined %}
{% set estado = resoluciones.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Resoluciones</li>
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
                                <h2>Registro de Resoluciones </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroresoluciones/save','method':
                                    'post','id':'form_resoluciones','class':'smart-form','enctype':'multipart/form-data')
                                    }}
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Tipo de Resolución
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion" name="tipo">
                                                        <option value="">Seleccione...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                        {% if tiporesolucion.codigo == tipo %}
                                                        <option selected="selected" value="{{ tiporesolucion.codigo }}">
                                                            {{ tiporesolucion.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tiporesolucion.codigo }}">{{
                                                            tiporesolucion.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha (DD/MM/AAAA) {{ fecha_actual }}</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == "" %}
                                                    <input type="text" id="input-fecha" name="fecha" placeholder="Fecha"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_actual }}">
                                                    <input type="hidden" id="input-id_resolucion" name="id_resolucion"
                                                        value="">

                                                    {% else %}
                                                    <input type="text" id="input-fecha" name="fecha" placeholder="Fecha"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha }}">
                                                    <input type="hidden" id="input-id_resolucion" name="id_resolucion"
                                                        value="{{ id_resolucion }}">
                                                    <input type="hidden" id="input-anio" name="anio" value="{{ anio }}">
                                                    {% endif %}

                                                </label>
                                            </section>



                                            <section class="col col-md-3" style="margin-top: 30px;">
                                                <label class="checkbox">
                                                    {% if visible == 1 %}
                                                    <input type="checkbox" name="visible" value="{{ visible }}"
                                                        id="visible" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="visible" value="{{ visible }}"
                                                        id="visible">
                                                    {% endif %}
                                                    <i></i>Visible</label>
                                            </section>

                                            <section class="col col-md-3" style="margin-top: 30px;">
                                                <label class="checkbox">
                                                    {% if escaneado == 1 %}
                                                    <input type="checkbox" name="escaneado" value="{{ escaneado }}"
                                                        id="escaneado" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="escaneado" value="{{ escaneado }}"
                                                        id="escaneado">
                                                    {% endif %}
                                                    <i></i>Escaneado</label>


                                            </section>



                                            <section class="col col-md-3">
                                                <label class="text-info">Número</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero"
                                                        placeholder="Número" value="{{ numero }}"
                                                        onblur="concatenacionNombre();">

                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info">Resolución</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo"
                                                        placeholder="Resolución" value="{{ titulo }}" readonly="">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Resumen</label>
                                                <label class="textarea"><i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="4" id="input-resumen"
                                                        name="resumen">{{ resumen }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Documentos de Gestión</label>
                                                <select style="width:100%" id="input-id_documento" name="id_documento">
                                                    <optgroup label="">
                                                        <option value="0">SELECCIONE...</option>
                                                        {% for documentosgestion_select in documentosgestion %}

                                                        {% if documentosgestion_select.id_documento == id_documento %}
                                                        <option selected="selected"
                                                            value="{{ documentosgestion_select.id_documento }}">{{
                                                            documentosgestion_select.titulo }}</option>

                                                        {% else %}
                                                        <option value="{{ documentosgestion_select.id_documento }}">{{
                                                            documentosgestion_select.titulo }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_resolucion">
                                                <p>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Visto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="16" id="input-visto"
                                                        name="visto_ckeditor">{{ visto }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Resuelve</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="16" id="input-resuelve"
                                                        name="resuelve_ckeditor">{{ resuelve }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                {% if resoluciones.imagen is defined %}
                                                <label class="text-info">Imagen</label>
                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/resoluciones/'~imagen) }}"
                                                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                {% endif %}

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="input-imagen_resolucion" type="file" name="imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_resolucion"
                                                        name="archivo_resolucion">
                                                    <input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== "" %}

                                                {% if tipo == 1 %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/resoluciones/'~archivo) }}">
                                                        <i class="fa-fw fa fa-eye"></i></a>
                                                </div>
                                                {% else %}
                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/resoluciones/'~archivo) }}">
                                                        <i class="fa-fw fa fa-eye"></i></a>
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
    </div>


    {% if id_resolucion !== "" %}
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
                                <h2>Relacion de Resoluciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_web_resoluciones_detalles"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Resolucion</th>
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
    <div id="exito_resoluciones">
        <p>
            Se grabo resolución correctamente...
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
            Debe seleccionar el tipo de resolución...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_pdf">

        <p>
            Solo se permite archivos con extencion ".pdf" ...

        </p>
    </div>
</div>


<!--Formulario de registro detalle-->
{{ form('registroresoluciones/saveDetalles','method':
'post','id':'form_tbl_web_resoluciones_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-6">
            <label class="text-info" >Tipo</label>
            <label class="select">
                <select id="input-id_tipo"  name="id_tipo" >
                    <option value="0" >Seleccione...</option>
                    {% for tipo_select in tiporesolucionesDetalle %}                                       
                        <option value="{{ tipo_select.codigo }}">{{ tipo_select.nombres }}</option>                                       
                    {% endfor %}
                    <input type="hidden" id="input-id_resolucion_detalle" name="id_resolucion_detalle" value="">
                    <input type="hidden" id="input-id_resolucion" name="id_resolucion" value="{{ id_resolucion }}">            
                </select> <i></i> 
            </label>
        </section> 




        <section class="col col-md-12">
            <label class="text-info">Resolucion</label>
            <select style="width:100%" id="input-id_resolucion2" name="id_resolucion2">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for resolucion_select in resoluciones2 %}
                    <option value="{{ resolucion_select.id_resolucion }}">{{
                        resolucion_select.titulo }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_resolucion">
            <p>
        </section>




    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->


<script type="text/javascript">

    var publica = "si";
    var xAbrevIns = "{{ config.global.xAbrevIns }}";


    var id = "{{ id }}";

</script>
<script type="text/javascript">
    var id_resolucion = "{{ id_resolucion }}";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>