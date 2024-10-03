<style>
    #cke_input-titulo {
        border: solid 1px black;
    }
</style>

{% set id_documento = "" %}
{% set titulo = "" %}
{% set referencia = "" %}
{% set referencia_enlace = "" %}
{% set fecha_hora = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set estado = "" %}
{% set tipo = "" %}
{% set visible = "" %}
{% set orden = "" %}


{% if documentos.titulo is defined %}
{% set titulo = documentos.titulo %}
{% endif %}

{% if documentos.referencia is defined %}
{% set referencia = documentos.referencia %}
{% endif %}

{% if documentos.referencia_enlace is defined %}
{% set referencia_enlace = documentos.referencia_enlace %}
{% endif %}

{% if documentos.fecha_hora is defined %}
{% set fecha_hora = utilidades.fechita(documentos.fecha_hora,'d/m/Y') %}
{% endif %}

{% if documentos.archivo is defined %}
{% set archivo = documentos.archivo %}
{% endif %}

{% if documentos.tipo is defined %}
{% set tipo = documentos.tipo %}
{% endif %}

{% if documentos.orden is defined %}
{% set orden = documentos.orden %}
{% endif %}

{% if documentos.visible is defined %}
{% set visible = documentos.visible %}
{% endif %}

{% if documentos.enlace is defined %}
{% set enlace = documentos.enlace %}
{% endif %}

{% if documentos.id_documento is defined %}
{% set id_documento = documentos.id_documento %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if documentos.estado is defined %}
{% set estado = documentos.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

{% set id_resolucion = "" %}
{% if documentos.id_resolucion is defined %}
{% set id_resolucion = documentos.id_resolucion %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Documentos</li>
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
                            data-widget-colorbutton="false" data-widget-custombutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Documentos </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrodocumentosgestion/save','method':
                                    'post','id':'form_documentos','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-6">
                                                <label class="text-info">Tipo Documento de Gestión
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_documento_gestion" name="tipo">
                                                        <option value="">Seleccione...</option>
                                                        {% for tipodocumentogestion in tipodocumentosgestion %}
                                                        {% if tipodocumentogestion.codigo == tipo %}
                                                        <option selected="selected"
                                                            value="{{ tipodocumentogestion.codigo }}">{{
                                                            tipodocumentogestion.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipodocumentogestion.codigo }}">{{
                                                            tipodocumentogestion.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Fecha</label>
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

                                            <section class="col col-md-2">
                                                <label class="text-info">Orden</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden"
                                                        placeholder="Orden" value="{{ orden }}">                                                    
                                                </label>
                                            </section>

                                            <section class="col col-md-2" style="margin-top: 19px;">
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
                                            <br>
                                            <section class="col col-md-12">
                                                <label class="text-info">Título</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo"
                                                        placeholder="Nombre titulo" value="{{ titulo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Resolución</label>
                                                <select style="width:100%" id="input-id_resolucion"
                                                    name="id_resolucion">
                                                    <optgroup label="">
                                                        <option value="0">SELECCIONE...</option>
                                                        {% for resolucion_select in resoluciones %}

                                                        {% if resolucion_select.id_resolucion == id_resolucion %}
                                                        <option selected="selected"
                                                            value="{{ resolucion_select.id_resolucion }}">{{
                                                            resolucion_select.titulo }}</option>

                                                        {% else %}
                                                        <option value="{{ resolucion_select.id_resolucion }}">{{
                                                            resolucion_select.titulo }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_resolucion">
                                                <p>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Referencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-referencia" name="referencia"
                                                        placeholder="Nombre referencia" value="{{ referencia }}">
                                                    <input type="hidden" id="input-id_documento" name="id_documento"
                                                        value="{{ id_documento }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info">Referencia Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-referencia_enlace"
                                                        name="referencia_enlace" placeholder="Nombre enlace"
                                                        value="{{ referencia_enlace }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace"
                                                        placeholder="Enlace" value="{{ enlace }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>

                                                {% if imagen  %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver la imagen
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/imagenes/documentos/'~imagen) }}"> <i
                                                            class="fa-fw fa fa-eye"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido una Imagen.
                                                </div>

                                                {% endif %}
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info">Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_documento" name="archivo_documento">
                                                    <input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/documentos/'~archivo) }}"> <i
                                                            class="fa-fw fa fa-eye"></i></a>
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
        <div class="row"></div>
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
                        <a href="javascript:void(0);" onclick="agregarEvaluacion();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarEvaluacion();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarEvaluacion();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Documentos Evaluaciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_documentos_evaluaciones"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha</th>
                                                <th>Titulo</th>
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
                        <a href="javascript:void(0);" onclick="agregarArchivo();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarArchivo();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarArchivo();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Documentos Archivos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_documentos_archivos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha</th>
                                                <th>Titulo</th>
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
</div>

<!--Formulario de registro detalle-->
{{ form('registrodocumentosgestion/saveDocumentosEvaluaciones','method': 'post','id':'form_documentos_evaluaciones','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Título</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titulo_evaluacion" name="titulo_evaluacion" placeholder="Titulo">
                <input type="hidden" id="input-id_documento_evaluacion_evaluacion" name="id_documento_evaluacion" value="">
                <input type="hidden" id="input-id_documento" name="id_documento" value="{{ id_documento }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_evaluacion" name="fecha_hora_evaluacion" placeholder="Fecha Hora" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >orden</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_evaluacion" name="orden_evaluacion" placeholder="Orden" value="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Resolucion</label>
            <select style="width:100%" id="input-evaluaciones-id_resolucion"
                name="id_resolucion">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for resolucion_select in resoluciones %}

                    <option value="{{ resolucion_select.id_resolucion }}">{{
                        resolucion_select.titulo }}</option>
     
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_resolucion">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_evaluacion" name="enlace_evaluacion" placeholder="Enlace" value="">
            </label>
        </section>

        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="visible_evaluacion" value="" id="input-visible_evaluacion">
                <i></i>Visible
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;" id="ver_evaluacion">
                <input type="file" id="documentos_evaluacion" name="documentos_evaluacion">
                <input type="hidden" id="input-documentos_evaluacion" name="imput-documentos_evaluacion" value="">
            </div>
        </section>

    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

<!--Formulario de registro detalle-->
{{ form('registrodocumentosgestion/saveDocumentosArchivos','method': 'post','id':'form_documentos_archivos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Título</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titulo_archivo" name="titulo_archivo" placeholder="Titulo">
                <input type="hidden" id="input-id_documento_archivo_archivo" name="id_documento_archivo" value="">
                <input type="hidden" id="input-id_documento" name="id_documento" value="{{ id_documento }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_archivo" name="fecha_hora_archivo" placeholder="Fecha Hora" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >orden</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_archivo" name="orden_archivo" placeholder="Orden" value="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Resolucion</label>
            <select style="width:100%" id="input-archivos-id_resolucion"
                name="id_resolucion">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for resolucion_select in resoluciones %}

                    <option value="{{ resolucion_select.id_resolucion }}">{{
                        resolucion_select.titulo }}</option>
     
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_resolucion">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_archivo" name="enlace_archivo" placeholder="Enlace" value="">
            </label>
        </section>

        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="visible_archivo" value="" id="input-visible_archivo">
                <i></i>Visible
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;" id="ver_archivo">
                <input type="file" id="documentos_archivo" name="documentos_archivo">
                <input type="hidden" id="input-documentos_archivo" name="imput-documentos_archivo" value="">
            </div>
        </section>

    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->


<div class="hidden">
    <div id="exito_documentos">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_documento_registrada">
        <p>
            Resolucion ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de documento...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de documento...

        </p>
    </div>
</div>
<script type="text/javascript">
    var idl = "";
    var publica = "si";

    {% if id is defined %}
    idl = {{ id }};
    {% endif %}

</script>
<script type="text/javascript" >
    var id_documento = {{ id_documento }};
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>