{% set id_requisito1 = "" %}
{% if requisitos.id_requisito1 is defined %}
{% set id_requisito1 = requisitos.id_requisito1 %}
{% endif %}



{% set codigo = "" %}
{% if requisitos.codigo is defined %}
{% set codigo = requisitos.codigo %}
{% endif %}

{% set nombre = "" %}
{% if requisitos.nombre is defined %}
{% set nombre = requisitos.nombre %}
{% endif %}

{% set descripcion = "" %}
{% if requisitos.descripcion is defined %}
{% set descripcion = requisitos.descripcion %}
{% endif %}

{% set imagen = "" %}
{% if requisitos.imagen is defined %}
{% set imagen = requisitos.imagen %}
{% endif %}

{% set archivo = "" %}
{% if requisitos.archivo is defined %}
{% set archivo = requisitos.archivo %}
{% endif %}

{% set archivo2 = "" %}
{% if requisitos.archivo2 is defined %}
{% set archivo2 = requisitos.archivo2 %}
{% endif %}

{% set proceso = "" %}
{% if requisitos.proceso is defined %}
{% set proceso = requisitos.proceso %}
{% endif %}

{% set visible = "" %}
{% if requisitos.visible is defined %}
{% set visible = requisitos.visible %}
{% endif %}

{% set enlace = "" %}
{% if requisitos.enlace is defined %}
{% set enlace = requisitos.enlace %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if requisitos.estado is defined %}
{% set estado = requisitos.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}


{% set mediosverificacion_nombre = "" %}
{% if mediosverificacion.nombre is defined %}
{% set mediosverificacion_nombre = mediosverificacion.nombre %}
{% endif %}

{% set id_medio_verificacion1 = "" %}
{% if mediosverificacion.id_medio_verificacion1 is defined %}
{% set id_medio_verificacion1 = mediosverificacion.id_medio_verificacion1 %}
{% endif %}



{% set fecha_inicio = "" %}
{% if requisitos.fecha_inicio is defined %}
{% set fecha_inicio = utilidades.fechita(requisitos.fecha_inicio,'d/m/Y') %}
{% endif %}

{% set fecha_fin = "" %}
{% if requisitos.fecha_fin is defined %}
{% set fecha_fin = utilidades.fechita(requisitos.fecha_fin,'d/m/Y') %}
{% endif %}

{% set fecha_vencimiento = "" %}
{% if requisitos.fecha_vencimiento is defined %}
{% set fecha_vencimiento = utilidades.fechita(requisitos.fecha_vencimiento,'d/m/Y') %}
{% endif %}

{% set responsable_docente = "" %}
{% if requisitos.responsable_docente is defined %}
{% set responsable_docente = requisitos.responsable_docente %}
{% endif %}

{% set responsable_administrativo = "" %}
{% if requisitos.responsable_administrativo is defined %}
{% set responsable_administrativo = requisitos.responsable_administrativo %}
{% endif %}

{% set id_resolucion = "" %}
{% if requisitos.id_resolucion is defined %}
{% set id_resolucion = requisitos.id_resolucion %}
{% endif %}

{% set control = "" %}
{% if requisitos.control is defined %}
{% set control = requisitos.control %}
{% endif %}


<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar requisitos </li>
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
                                <h2>Registro de requisitos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('licenciamiento1/saveRequisitos1','method':
                                    'post','id':'form_requisitos','class':'smart-form','enctype':'multipart/form-data')
                                    }}
                                    <header style="margin-top: 10px;">
                                        {{ mediosverificacion_nombre}}
                                        <input type="hidden" name="id_medio_verificacion1"
                                            value="{{ id_medio_verificacion1 }}">
                                        <!-- {{utilidades.partedescripcion(mediosverificacion_nombre,0,100) }} -->
                                    </header>
                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{fecha_inicio}}">

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Fin</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_fin" name="fecha_fin"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{fecha_fin}}">

                                                </label>
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info">Proceso
                                                </label>
                                                <label class="select">
                                                    <select id="input-proceso" name="proceso">
                                                        <option value="">Seleccione...</option>
                                                        {% for procesomedio_model in procesomedios %}
                                                        {% if procesomedio_model.codigo == proceso %}
                                                        <option selected="selected"
                                                            value="{{ procesomedio_model.codigo }}">{{
                                                            procesomedio_model.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ procesomedio_model.codigo }}">{{
                                                            procesomedio_model.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-2" style="margin-top: 20px;">
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

                                            <section class="col col-md-2" style="margin-top: 20px;">
                                                <label class="checkbox">
                                                    {% if control == '1' %}
                                                    <input type="checkbox" name="control" value="{{ control }}"
                                                        id="control" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="control" value="{{ control }}"
                                                        id="control">
                                                    {% endif %}
                                                    <i></i>Control</label>
                                            </section>




                                            <section class="col col-md-6">
                                                <label class="text-info">Docente</label>
                                                <select style="width:100%" id="input-responsable_docente"
                                                    name="responsable_docente">
                                                    <optgroup label="">
                                                        <option value="0">SELECCIONE...</option>
                                                        {% for docente_select in docentes %}
                                                        {% if docente_select.codigo == responsable_docente %}
                                                        <option selected="selected" value="{{ docente_select.codigo }}">
                                                            {{ docente_select.apellidop }} {{ docente_select.apellidom
                                                            }} {{ docente_select.nombres }}</option>

                                                        {% else %}
                                                        <option value="{{ docente_select.codigo }}">{{
                                                            docente_select.apellidop }} {{ docente_select.apellidom }}
                                                            {{ docente_select.nombres }}</option>
                                                        {% endif %}
                                                        {% endfor %}

                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_docentes">
                                                <p>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Personal</label>
                                                <select style="width:100%" id="input-responsable_administrativo"
                                                    name="responsable_administrativo">
                                                    <optgroup label="">
                                                        <option value="0">SELECCIONE...</option>
                                                        {% for personal_select in personal %}

                                                        {% if personal_select.codigo == responsable_administrativo %}
                                                        <option selected="selected"
                                                            value="{{ personal_select.codigo }}">{{
                                                            personal_select.apellidop }} {{ personal_select.apellidom }}
                                                            {{ personal_select.nombres }}</option>

                                                        {% else %}
                                                        <option value="{{ personal_select.codigo }}">{{
                                                            personal_select.apellidop }} {{ personal_select.apellidom }}
                                                            {{ personal_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_personal">
                                                <p>
                                            </section>




                                            <section class="col col-md-4">
                                                <label class="text-info">Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo"
                                                        placeholder="Código" value="{{codigo }}">
                                                    <input type="hidden" id="input-codigo_oculto" name="codigo_oculto"
                                                        value="{{ codigo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info">Resolucion</label>
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


                                            <section class="col col-md-12">
                                                <label class="text-info">Nombre</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <input type="hidden" id="input-id_requisito1" name="id_requisito1"
                                                        value="{{ id_requisito1 }}">
                                                    <textarea rows="6" id="input-nombre" name="nombre"
                                                        placeholder="Nombre">{{ nombre }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="6" id="input-descripcion" name="descripcion"
                                                        placeholder="Nombre">{{ descripcion }}</textarea>
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

                                                <label class="text-info">Agregar Archivo PDF</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_requisitos1"
                                                        name="archivo_requisitos1">
                                                    {#<input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== "" %}

                                                <a href="{{ url('adminpanel/archivos/requisitos1/'~archivo) }}"
                                                    target="_BLANK" class="btn btn-success btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="javascript:void(0);" onclick="detelepdf();"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                </div>

                                                {% endif %}

                                            </section>


                                            <section class="col col-md-6">

                                                <label class="text-info">Agregar Archivo EXCEL</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo2_requisitos1"
                                                        name="archivo2_requisitos1">
                                                    {#<input type="hidden" id="input-archivo2" name="archivo2"
                                                        value="{{ archivo2 }}">#}
                                                </div>


                                                {% if archivo2 !== "" %}

                                                <a href="{{ url('adminpanel/archivos/requisitos1/'~archivo2) }}"
                                                    target="_BLANK" class="btn btn-success btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="javascript:void(0);" onclick="deleteexcel();"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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
</div>
<div class="hidden">
    <div id="exito_requisitos1">
        <p>
            Se grabo formato correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="codigo_vacio">
        <p>
            Debe ingresar un codigo válido...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="codigo_registrado">
        <p>
            Codigo registrado...
        </p>
    </div>
</div>


<script type="text/javascript">
    var id = "";
    var publica = "si";

    {% if id is defined %}
    id = "{{ id }}";
    {% endif %}

</script>
<script type="text/javascript">
    var id_componente1 = "{{ id}}";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>
<script type="text/javascript">
    var medio_verificacion = "{{id_medio_verificacion1}}";
</script>