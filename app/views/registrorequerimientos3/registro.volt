<style>
    #cke_input-texto_complementario {
        border: solid 1px black;
    }
</style>

{% set id_req_servicio = "" %}
{% if requerimientos.id_req_servicio is defined %}
{% set id_req_servicio = requerimientos.id_req_servicio %}
{% endif %}


{% set id_tipo_servicio = "" %}
{% if requerimientos.id_tipo_servicio is defined %}
{% set id_tipo_servicio = requerimientos.id_tipo_servicio %}
{% endif %}

{% set id_prioridad = "" %}
{% if requerimientos.id_prioridad is defined %}
{% set id_prioridad = requerimientos.id_prioridad %}
{% endif %}

{% set id_personal_area_equipo = "" %}
{% if requerimientos.id_personal_area_equipo is defined %}
{% set id_personal_area_equipo = requerimientos.id_personal_area_equipo %}
{% endif %}

{% set fecha_req = "" %}
{% if requerimientos.fecha_req is defined %}
{% set fecha_req = utilidades.fechita(requerimientos.fecha_req,'d/m/Y') %}
{% endif %}

{% set hora_req = "" %}
{% if requerimientos.hora_req is defined %}
{% set hora_req = utilidades.hora_formato(documentos.hora_req,'H:i:s') %}
{% endif %}


{% set descripcion = "" %}
{% if requerimientos.descripcion is defined %}
{% set descripcion = requerimientos.descripcion %}
{% endif %}


{% set archivo = "" %}
{% if requerimientos.archivo is defined %}
{% set archivo = requerimientos.archivo %}
{% endif %}

{% set imagen = "" %}
{% if requerimientos.imagen is defined %}
{% set imagen = requerimientos.imagen %}
{% endif %}

{% set id_area = "" %}
{% if requerimientos.id_area is defined %}
{% set id_area = requerimientos.id_area %}
{% endif %}

{% set id_personal = "" %}
{% if requerimientos.id_personal is defined %}
{% set id_personal = requerimientos.id_personal %}
{% endif %}

{% set id_personal_area_equipo = "" %}
{% if requerimientos.id_personal_area_equipo is defined %}
{% set id_personal_area_equipo = requerimientos.id_personal_area_equipo %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if requerimientos.estado is defined %}
{% set estado = requerimientos.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Requerimientos </li>
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Requerimientos </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrorequerimientos3/save','method':
                                    'post','id':'form_tbl_hdt_req_servicio','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-6">

                                                <label class="text-info">Tipo de Servicio
                                                </label>
                                                <label class="select">
                                                    <select id="input-id_tipo_servicio" name="id_tipo_servicio">
                                                        <option value="">Seleccione...</option>

                                                        {% for tiposervicio_select in tiposervicio %}

                                                        {% if tiposervicio_select.codigo == id_tipo_servicio %}
                                                        <option selected="selected"
                                                            value="{{ tiposervicio_select.codigo }}">{{
                                                            tiposervicio_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tiposervicio_select.codigo }}">{{
                                                            tiposervicio_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}

                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Prioridad
                                                </label>
                                                <label class="select">
                                                    <select id="input-id_prioridad" name="id_prioridad">
                                                        <option value="">Seleccione...</option>
                                                        {% for prioridad_select in prioridad %}

                                                        {% if prioridad_select.codigo == id_prioridad %}
                                                        <option selected="selected"
                                                            value="{{ prioridad_select.codigo }}">{{
                                                            prioridad_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ prioridad_select.codigo }}">{{
                                                            prioridad_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Areas</label>
                                                <select style="width:100%" id="input-id_area" name="id_area">
                                                    <optgroup label="">
                                                        <option value="">SELECCIONE...</option>

                                                        {% for area_select in areas %}
                                                        {% if area_select.codigo ==
                                                        id_area %}
                                                        <option selected="selected" value="{{ area_select.codigo }}">
                                                            {{ area_select.nombres }}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ area_select.codigo }}">
                                                            {{ area_select.nombres }}
                                                        </option>
                                                        {% endif %}

                                                        {% endfor %}


                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_id_area">
                                                <p>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Personal</label>
                                                <select style="width:100%" id="input-id_personal" name="id_personal">
                                                    <optgroup label="">
                                                        <option value="">SELECCIONE...</option>

                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_id_personal">
                                                <p>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Equipos</label>
                                                <select style="width:100%" id="input-id_personal_area_equipo"
                                                    name="id_personal_area_equipo">
                                                    <optgroup label="">
                                                        <option value="">SELECCIONE...</option>

                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_id_personal_area_equipo">
                                                <p>
                                            </section>




                                            <section class="col col-md-12">
                                                <label class="text-info">Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-descripcion" name="descripcion"
                                                        placeholder="Descripción">{{ descripcion }}</textarea>
                                                        
                                                </label>
                                                <input type="hidden" id="input-id_req_servicio" name="id_req_servicio"
                                                value="{{ id_req_servicio }}">
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen </label>

                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/requerimientos/'~imagen) }}"
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

                                                    <input type="file" id="archivo_requerimiento"
                                                        name="archivo_requerimiento">

                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/requerimientos/'~archivo) }}">
                                                        <i class="fa-fw fa fa-eye"></i></a>
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
    <div id="success">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript" >
    var publica = "si";
    var id_area = '{{ id_area }}';
    var id_personal = '{{ id_personal }}';
    var id_personal_area_equipo = '{{ id_personal_area_equipo }}';

    // console.log("id_area: "+ id_area);
    // console.log("id_personal: "+ id_personal);
    // console.log("id_personal_area_equipo: "+ id_personal);
</script>