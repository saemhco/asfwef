{% set id_encuesta = "" %}
{% if encuestas.id_encuesta is defined %}
{% set id_encuesta = encuestas.id_encuesta %}
{% endif %}

{% set id_tipo_encuesta = "" %}
{% if encuestas.id_tipo_encuesta is defined %}
{% set id_tipo_encuesta = encuestas.id_tipo_encuesta %}
{% endif %}

{% set id_tipo_usuario = "" %}
{% if encuestas.id_tipo_usuario is defined %}
{% set id_tipo_usuario = encuestas.id_tipo_usuario %}
{% endif %}

{% set descripcion = "" %}
{% if encuestas.descripcion is defined %}
{% set descripcion = encuestas.descripcion %}
{% endif %}

{% set indicaciones = "" %}
{% if encuestas.indicaciones is defined %}
{% set indicaciones = encuestas.indicaciones %}
{% endif %}

{% set area_responsable = "" %}
{% if encuestas.area_responsable is defined %}
{% set area_responsable = encuestas.area_responsable %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if encuestas.estado is defined %}
{% set estado = encuestas.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Encuestas </li>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro de Encuestas </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroencuestas/save','method':
                                    'post','id':'form_tbl_enc_encuestas','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>
                                        <div class="row">


                                            <section class="col col-md-3">
                                                <label class="text-info">Tipo de Encuestas</label>
                                                <label class="select">
                                                    <select id="input-id_tipo_encuesta" name="id_tipo_encuesta">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for tipoencuestas_select in tipoencuestas %}
                                                        {% if tipoencuestas_select.codigo == id_tipo_encuesta %}
                                                        <option selected="selected"
                                                            value="{{ tipoencuestas_select.codigo }}">{{
                                                            tipoencuestas_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipoencuestas_select.codigo }}">{{
                                                            tipoencuestas_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-3">
                                                <label class="text-info">Tipo de Usuario</label>
                                                <label class="select">
                                                    <select id="input-id_tipo_usuario" name="id_tipo_usuario">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for tipousuarios_select in tipousuarios %}
                                                        {% if tipousuarios_select.codigo === id_tipo_usuario %}
                                                        <option value="{{ tipousuarios_select.codigo }}" selected>{{
                                                            tipousuarios_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipousuarios_select.codigo }}">{{
                                                            tipousuarios_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Área Responsable</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-area_responsable"
                                                        name="area_responsable" placeholder="Área Responsable"
                                                        value="{{ area_responsable }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Descripcion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-descripcion"
                                                        name="descripcion">{{ descripcion }}</textarea>
                                                </label>
                                                <input type="hidden" id="input-id_encuesta" name="id_encuesta"
                                                    value="{{ id_encuesta }}">
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Indicaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-indicaciones"
                                                        name="indicaciones">{{ indicaciones }}</textarea>
                                                </label>
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

<script type="text/javascript">
    var publica = "si";
    var id_encuesta = "{{id_encuesta}}";
</script>