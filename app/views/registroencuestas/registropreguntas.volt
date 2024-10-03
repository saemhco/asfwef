{% set id_encuesta_pregunta = "" %}
{% if preguntas.id_encuesta_pregunta is defined %}
{% set id_encuesta_pregunta = preguntas.id_encuesta_pregunta %}
{% endif %}

{% set id_encuesta = "" %}
{% if preguntas.id_encuesta is defined %}
{% set id_encuesta = preguntas.id_encuesta %}
{% endif %}

{% set id_tipo_pregunta = "" %}
{% if preguntas.id_tipo_pregunta is defined %}
{% set id_tipo_pregunta = preguntas.id_tipo_pregunta %}
{% endif %}

{% set id_tipo_respuesta = "" %}
{% if preguntas.id_tipo_respuesta is defined %}
{% set id_tipo_respuesta = preguntas.id_tipo_respuesta %}
{% endif %}

{% set numero = "" %}
{% if preguntas.numero is defined %}
{% set numero = preguntas.numero %}
{% endif %}

{% set descripcion = "" %}
{% if preguntas.descripcion is defined %}
{% set descripcion = preguntas.descripcion %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if preguntas.estado is defined %}
{% set estado = preguntas.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Preguntas </li>
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
                                <h2>Registro de Preguntas </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroencuestas/saveEncuestasPreguntas','method':
                                    'post','id':'form_tbl_enc_encuestas_preguntas','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info">Tipo de preguntas</label>
                                                <label class="select">
                                                    <select id="input-id_tipo_pregunta" name="id_tipo_pregunta">
                                                        <option value="">Seleccione...</option>
                                                        {% for tipopreguntas_select in tipopreguntas %}
                                                        {% if tipopreguntas_select.codigo == id_tipo_pregunta %}
                                                        <option selected="selected"
                                                            value="{{ tipopreguntas_select.codigo }}">{{
                                                                tipopreguntas_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipopreguntas_select.codigo }}">{{
                                                            tipopreguntas_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Tipo de respuesta</label>
                                                <label class="select">
                                                    <select id="input-id_tipo_respuesta" name="id_tipo_respuesta">
                                                        <option value="">Seleccione...</option>

                                                        {% for tiporespuesta_select in tiporespuestas %}
                                                        {% if tiporespuesta_select.codigo == id_tipo_respuesta %}
                                                        <option selected="selected"
                                                            value="{{ tiporespuesta_select.codigo }}">{{
                                                                tiporespuesta_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tiporespuesta_select.codigo }}">{{
                                                            tiporespuesta_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Numero</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero"
                                                        name="numero" placeholder="Numero"
                                                        value="{{ numero }}">
                                                        <input type="hidden" id="input-id_encuesta_pregunta" name="id_encuesta_pregunta"
                                                        value="{{ id_encuesta_pregunta }}">
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



                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">

                                        </div>
                                    </fieldset>

                                    <footer>
                                        <button id="publicar_preguntas" type="button" class="btn btn-primary">
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
    {% if id_encuesta_pregunta !== "" %}
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
                                <h2>Registro de Respuestas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_enc_encuestas_respuestas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-hide="expand">Descripcion</th>
                                                <th data-hide="phone,tablet">Puntaje</th>
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



{{ form('registroencuestas/saveEncuestasPreguntasRespuestas','method':
'post','id':'form_tbl_enc_encuestas_respuestas','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">


        <section class="col col-md-12">
            <label class="text-info">Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-er-descripcion" name="descripcion" placeholder=""></textarea>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Puntaje</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-er-puntaje" name="puntaje" placeholder="Puntaje">
                <input type="hidden" id="input-er-id_encuesta_respuesta" name="id_encuesta_respuesta" value="">
                <input type="hidden" id="input-er-id_encuesta_pregunta" name="id_encuesta_pregunta" value="{{ id_encuesta_pregunta }}">
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}


<div class="hidden">
    <div id="success">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript">
    var publica = "si";
    var id_encuesta_pregunta = "{{id_encuesta_pregunta}}";
</script>