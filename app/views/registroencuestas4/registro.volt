{% set txt_buton = "Registrar" %}
{% if alumnos.codigo is defined %}
{% set codigo = alumnos.codigo %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <span class="ribbon-button-alignment">
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" rel="tooltip" data-placement="bottom"
            data-original-title="" data-html="true">
            <i class="fa fa-refresh"></i>
        </span>
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Test</li>
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
                                <span class="widget-icon"> <i class="fa fa-clipboard"></i> </span>
                                <h2>Registro de Test</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroencuestas4/save','method':
                                    'post','id':'form_encuestas','class':'smart-form','enctype':'multipart/form-data')
                                    }}



                                    <div id="tipo_encuesta">

                                        <header style="margin-top: -10px;color: black;">
                                            ENCUESTA:<p id="text_encuesta">{{ encuesta.descripcion }}</p>
                                        </header>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-md-12">

                                                    <table class="table table-sm table-primary table-bordered"
                                                        style="font-size: 10px !important;">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">
                                                                    <p align="left">Datos Generales: </p>
                                                                    <input type="hidden" id="input-id_encuesta_alumno"
                                                                        name="id_encuesta_alumno" value="">
                                                                    <input type="hidden" id="input-grupo"
                                                                        name="id_grupo" value="">
                                                                    <input type="hidden" id="input-id_encuesta"
                                                                        name="id_encuesta"
                                                                        value="{{encuesta.id_encuesta}}">
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr style="font-size: 12px !important;">

                                                                <th>Carrera Profesional: <strong>
                                                                        <p id="text_carrera">{{datos.carrera}}</p>
                                                                    </strong></th>
                                                                <th>Ciclo Académico: <strong></strong>
                                                                    <p id="text_ciclo">{{datos.ciclo}}</p>
                                                                </th>


                                                            </tr>

                                                            <tr style="font-size: 12px !important;">

                                                                <th colspan="2">Indicaciones: <strong>
                                                                        <p id="text_indicaciones">{{
                                                                            encuesta.indicaciones }}</p>
                                                                    </strong></th>



                                                            </tr>


                                                        </tbody>
                                                    </table>

                                                    <table class="table table-bordered table-hover"
                                                        style="font-size: 12px !important;">
                                                        <thead>
                                                            <tr>

                                                                <th colspan="2">
                                                                    <center>PREGUNTAS</center>
                                                                </th>
                                                                <th colspan="5">
                                                                    <center>RESPUESTAS</center>
                                                                </th>


                                                            </tr>
                                                            <tr>
                                                                <th colspan="2"></th>
                                                                {% for encuesta_respuesta_t in encuestasRespuestasT %}
                                                                <th width="8%">{{encuesta_respuesta_t.descripcion}}</th>
                                                                {% endfor %}
                                                            </tr>
                                                        </thead>
                                                        <tbody>





                                                            {% for tp in tipo_preguntas %}

                                                            <tr>

                                                                <td colspan="7"><strong>{{ tp.nombres }}</strong></td>
                                                            </tr>
                                                            {% set codigo_tipo_pregunta = tp.codigo %}




                                                            {% for p in preguntas %}

                                                            <tr>
                                                                {% if p.codigo == codigo_tipo_pregunta %}
                                                                <td style="width:5%">{{ p.numero }}</td>
                                                                <td>{{ p.descripcion }}</td>



                                                                {% for respuesta in respuestas %}

                                                                {% if p.id_encuesta_pregunta ==
                                                                respuesta.id_encuesta_pregunta %}





                                                                {% if respuesta.puntaje == "0" %}

                                                                <td>

                                                                    <div class="inline-group">
                                                                        <label class="radio">
                                                                            <input type="radio"
                                                                                name="radio{{ p.id_encuesta_pregunta }}"
                                                                                checked="checked"
                                                                                value="{{respuesta.puntaje}}">
                                                                            <i></i>{{respuesta.descripcion}}
                                                                        </label>

                                                                    </div>
                                                                </td>

                                                                {% elseif(respuesta.puntaje == "")%}
                                                                <td>

                                                                    <div class="inline-group">
                                                                        <label class="radio state-disabled">
                                                                            <input type="radio"
                                                                                name="radio{{ p.id_encuesta_pregunta }}"
                                                                                value="{{respuesta.puntaje}}"
                                                                                disabled="disabled">
                                                                            <i></i>{{respuesta.descripcion}}
                                                                        </label>

                                                                    </div>
                                                                </td>

                                                                {% else %}


                                                                <td>

                                                                    <div class="inline-group    ">
                                                                        <label class="radio">
                                                                            <input type="radio"
                                                                                name="radio{{ p.id_encuesta_pregunta }}"
                                                                                value="{{respuesta.puntaje}}">
                                                                            <i></i>{{respuesta.descripcion}}
                                                                        </label>

                                                                    </div>
                                                                </td>
                                                                {% endif %}




                                                                {% endif %}

                                                                {% endfor %}

                                                                {% endif %}

                                                            </tr>
                                                            {% endfor %}



                                                            {% endfor %}
                                                            <tr>
                                                                <td>Comentario o recomendaciones</td>
                                                                <td colspan="6">
                                                                    <label class="textarea"> <i
                                                                            class="icon-append fa fa-comment"></i>
                                                                        <textarea rows="3" id="input-recomendacion"
                                                                            name="recomendacion"
                                                                            placeholder="Comentario o Recomendaciones"></textarea>
                                                                    </label>
                                                                </td>
                                                            </tr>


                                                        </tbody>

                                                    </table>


                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>





                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <!-- <a href="javascript:history.back()" type="button" class="btn btn-default">
                                            Volver
                                        </a> -->

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
    <div id="error_asignatura">
        <p>
            Debe selecionar una asignatura...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_encuesta">
        <p>
            Debe selecionar el tipo de encuesta...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_encuesta_registrada">
        <p>
            Usted ya realizó la encuesta...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="success">
        <p>
            El Test se registró correctamente...
        </p>
    </div>
</div>

<script type="text/javascript">

    var publica = "si";

    //alert("Hola");
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>