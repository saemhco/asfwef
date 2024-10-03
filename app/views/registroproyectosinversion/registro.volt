<style>
    #cke_input-compromiso_cooperante {
        border: solid 1px black;
    }
</style>

{% set id_proyecto = "" %}
{% set titulo = "" %}
{% set tipo = "" %}
{% set objetivo = "" %}
{% set objetivos = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set imagen = "" %}
{% set estado = "" %}
{% set local_proyecto = "" %}
{% set fecha_inicio = "" %}
{% set fecha_termino = "" %}
{% set vigencia = "" %}

{% set entidad_cooperante = "" %}
{% set compromiso_cooperante = "" %}
{% set investigador = "" %}

{% if invproyecto.tipo is defined %}
{% set tipo = invproyecto.tipo %}
{% endif %}

{% if invproyecto.titulo is defined %}
{% set titulo = invproyecto.titulo %}
{% endif %}

{% if invproyecto.fecha_inicio is defined %}
{% set fecha_inicio = utilidades.fechita(invproyecto.fecha_inicio,'d/m/Y') %}
{% endif %}

{% if invproyecto.fecha_termino is defined %}
{% set fecha_termino = utilidades.fechita(invproyecto.fecha_termino,'d/m/Y') %}
{% endif %}

{% if invproyecto.objetivo is defined %}
{% set objetivo = invproyecto.objetivo %}
{% endif %}

{% if invproyecto.objetivos is defined %}
{% set objetivos = invproyecto.objetivos %}
{% endif %}

{% if invproyecto.archivo is defined %}
{% set archivo = invproyecto.archivo %}
{% endif %}

{% if invproyecto.enlace is defined %}
{% set enlace = invproyecto.enlace %}
{% endif %}

{% if invproyecto.investigador is defined %}
{% set investigador = invproyecto.investigador %}
{% endif %}

{% if invproyecto.imagen is defined %}
{% set imagen = invproyecto.imagen %}
{% endif %}

{% if invproyecto.vigencia is defined %}
{% set vigencia = invproyecto.vigencia %}
{% endif %}

{% set presupuesto = "" %}
{% if invproyecto.presupuesto is defined %}
{% set presupuesto = invproyecto.presupuesto %}
{% endif %}




{% if invproyecto.entidad_cooperante is defined %}
{% set entidad_cooperante = invproyecto.entidad_cooperante %}
{% endif %}

{% if invproyecto.compromiso_cooperante is defined %}
{% set compromiso_cooperante = invproyecto.compromiso_cooperante %}
{% endif %}

{% if invproyecto.local_proyecto is defined %}
{% set local_proyecto = invproyecto.local_proyecto %}
{% endif %}

{% if invproyecto.id_proyecto is defined %}
{% set id_proyecto = invproyecto.id_proyecto %}
{% endif %}

{% set id_linea_investigacion = "" %}
{% if invproyecto.id_linea_investigacion is defined %}
{% set id_linea_investigacion = invproyecto.id_linea_investigacion %}
{% endif %}

{% set id_sub_linea_investigacion = "" %}
{% if invproyecto.id_sub_linea_investigacion is defined %}
{% set id_sub_linea_investigacion = invproyecto.id_sub_linea_investigacion %}
{% endif %}

{% set resumen = "" %}
{% if invproyecto.resumen is defined %}
{% set resumen = invproyecto.resumen %}
{% endif %}

{% set codigo_unico = "" %}
{% if invproyecto.codigo_unico is defined %}
{% set codigo_unico = invproyecto.codigo_unico %}
{% endif %}

{% set etapa = "" %}
{% if invproyecto.etapa is defined %}
{% set etapa = invproyecto.etapa %}
{% endif %}

{% set monto = "" %}
{% if invproyecto.monto is defined %}
{% set monto = invproyecto.monto %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if invproyecto.estado is defined %}
{% set estado = invproyecto.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Boletines</li>
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
                                <h2>Registro de Proyectos </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    {{ form('registroproyectosinversion/save','method':
                                    'post','id':'form_invproyecto','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-3">
                                                <label class="text-info">Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-money"></i>
                                                    <input type="text" id="input-codigo_unico" name="codigo_unico"
                                                        placeholder="Código" value="{{ codigo_unico}}">
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Termino</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_termino" name="fecha_termino"
                                                        placeholder="Fecha termino" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_termino }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Etapa
                                                </label>
                                                <label class="select">
                                                    <select id="input-etapa" name="etapa">
                                                        <option value="0"> Seleccione...</option>
                                                        {% for etapa_select in etapas %}
                                                        {% if etapa_select.codigo == etapa %}
                                                        <option value="{{ etapa_select.codigo }}"
                                                            selected="selected">{{ etapa_select.nombres }} </option>
                                                        {% else %}
                                                        <option value="{{ etapa_select.codigo }}">{{
                                                            etapa_select.nombres }} </option>
                                                        {% endif %}
                                                        {% endfor %}

                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            
                                            <section class="col col-md-12">
                                                <label class="text-info">Título</label>
                                                <label class="input"> <i class="icon-prepend fa fa-pencil-square-o"></i>
                                                    <input type="text" id="input-titulo" name="titulo"
                                                        placeholder="Título" value="{{ titulo }}">

                                                    <input type="hidden" id="input-id_proyecto" name="id_proyecto"
                                                        value="{{ id_proyecto }}">

                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Presupuesto</label>
                                                <label class="input"> <i class="icon-prepend fa fa-money"></i>
                                                    <input type="text" id="input-presupuesto" name="presupuesto"
                                                        placeholder="Presupuesto" value="{{ presupuesto}}">
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Monto</label>
                                                <label class="input"> <i class="icon-prepend fa fa-money"></i>
                                                    <input type="text" id="input-monto" name="monto"
                                                        placeholder="Monto" value="{{ monto}}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Resumen</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-resumen" name="resumen"
                                                        placeholder="Resumen">{{ resumen }}</textarea>
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Local Proyecto</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-local_proyecto" name="local_proyecto"
                                                        placeholder="Local Proyecto" value="{{ local_proyecto }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-link"></i>
                                                    <input type="text" id="input-enlace" name="enlace"
                                                        placeholder="Enlace" value="{{ enlace }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen</label>

                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/invproyecto/'~imagen) }}"
                                                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_boletin" name="archivo_boletin">

                                                    <input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/invproyecto/'~archivo) }}"> <i
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
    </div>
</div>
<div class="hidden">
    <div id="exito_invproyecto">
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
{{ form('registroproyectosinversion/saveUsuarioDetallePersonal','method':
'post','id':'form_usuarios_detalles','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-id_usuario" name="codigo">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for personal_select in personal %}
                    <option value="{{ personal_select.codigo }}">{{ personal_select.apellidop }} {{
                        personal_select.apellidom }} {{ personal_select.nombres }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning">
            <p>
        </section>
    </div>
    <input type="hidden" id="input-id_usuario_oculto" name="id_usuario_oculto" value="">
    <input type="hidden" id="input-id_proyecto_investigador_personal" name="id_proyecto_investigador_personal" value="">
    <input type="hidden" id="input-id_tabla" name="id_proyecto" value="{{ id_proyecto }}">

</fieldset>
{{ endForm() }}


{{ form('registroproyectosinversion/saveUsuarioDetalleDocente','method':
'post','id':'form_usuarios_detalles_docente','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-id_usuario_docente" name="codigo">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for docentes_select in docentes %}
                    <option value="{{ docentes_select.codigo }}">{{ docentes_select.apellidop }} {{
                        docentes_select.apellidom }} {{ docentes_select.nombres }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_docente">
            <p>
        </section>
    </div>
    <input type="hidden" id="input-id_usuario_oculto_docente" name="id_usuario_oculto_docente" value="">
    <input type="hidden" id="input-id_proyecto_investigador_docente" name="id_proyecto_investigador_docente" value="">
    <input type="hidden" id="input-id_tabla" name="id_proyecto" value="{{ id_proyecto }}">

</fieldset>
{{ endForm() }}


<script type="text/javascript">
    var idl = "";
    var publica = "si";

    {% if id is defined %}
    idl = {{ id }};
    {% endif %}


    var id_linea_investigacion = '{{ id_linea_investigacion }}';
    var id_sub_linea_investigacion = '{{ id_sub_linea_investigacion }}';


</script>

<script type="text/javascript">
    var id_proyecto = "{{ id_proyecto }}";</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>