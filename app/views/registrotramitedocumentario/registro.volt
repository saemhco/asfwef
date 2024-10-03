<style>
    #cke_input-descripcion {
        border: solid 1px black;
    }
</style>

{% set id_doc = "" %}
{% if documentos.id_doc is defined %}
{% set id_doc = documentos.id_doc %}
{% endif %}

{% set id_remitente = "" %}
{% if documentos.id_remitente is defined %}
{% set id_remitente = documentos.id_remitente %}
{% endif %}

{% set id_tipo_doc = "" %}
{% if documentos.id_tipo_doc is defined %}
{% set id_tipo_doc = documentos.id_tipo_doc %}
{% endif %}

{% set id_sede = "" %}
{% if documentos.id_sede is defined %}
{% set id_sede = documentos.id_sede %}
{% endif %}

{% set id_tipo_envio = "" %}
{% if documentos.id_tipo_envio is defined %}
{% set id_tipo_envio = documentos.id_tipo_envio %}
{% endif %}


{% set id_personal_area = "" %}
{% if documentos.id_personal_area is defined %}
{% set id_personal_area = documentos.id_personal_area %}
{% endif %}

{% set destinatario_personal = "" %}
{% if documentos.destinatario_personal is defined %}
{% set destinatario_personal = documentos.destinatario_personal %}
{% endif %}

{% set fecha_envio = "" %}
{% if documentos.fecha_envio is defined %}
{% set fecha_envio = utilidades.fechita(documentos.fecha_envio,'d/m/Y') %}
{% endif %}

{% if documentos.fecha_envio is defined %}
{% set hora_envio = utilidades.hora_formato(documentos.fecha_envio,'H:i:s') %}
{% endif %}



{% set nro_documento = "" %}
{% if documentos.nro_documento is defined %}
{% set nro_documento = documentos.nro_documento %}
{% endif %}

{% set asunto = "" %}
{% if documentos.asunto is defined %}
{% set asunto = documentos.asunto %}
{% endif %}

{% set nro_folios = "" %}
{% if documentos.nro_folios is defined %}
{% set nro_folios = documentos.nro_folios %}
{% endif %}

{% set proceso = "" %}
{% if documentos.proceso is defined %}
{% set proceso = documentos.proceso %}
{% endif %}

{% set archivo = "" %}
{% if documentos.archivo is defined %}
{% set archivo = documentos.archivo %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if documentos.estado is defined %}
{% set estado = documentos.estado %}
{% set txt_buton = "Actualizar" %}
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
                                <h2>Registro de Documentos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrotramitedocumentario/save','method':
                                    'post','id':'form_documentos','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info">Sede
                                                </label>
                                                <label class="select">
                                                    <select id="input-id_sede" name="id_sede">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for locales_select in locales %}
                                                        {% if locales_select.codigo == id_sede %}
                                                        <option selected="selected" value="{{ locales_select.codigo }}">
                                                            {{locales_select.nombres}}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ locales_select.codigo }}">
                                                            {{locales_select.nombres}}
                                                        </option>
                                                        {% endif %}
                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Fecha Envio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-fecha_actual_envio"
                                                        name="fecha_actual_envio" placeholder="Fecha Envio"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_envio }}">
                                                    {% else %}
                                                    <input type="text" id="input-fecha_actual_envio"
                                                        name="fecha_actual_envio" placeholder="Fecha Envio"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_actual_envio }}" readonly>
                                                    {% endif %}
                                                </label>
                                                <input type="hidden" id="id_doc" name="id_doc" value="{{id_doc}}">
                                                <input type="hidden" id="id_personal_area_remitente" name="id_personal_area_remitente" value="{{id_personal_area_remitente}}">
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info">Hora Envio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-hora_actual_envio"
                                                        name="hora_actual_envio" placeholder="Hora Envio" class=""
                                                        data-dateformat='dd/mm/yy' value="{{ hora_envio }}">
                                                    {% else %}
                                                    <input type="text" id="input-hora_actual_envio"
                                                        name="hora_actual_envio" placeholder="Hora Envio"
                                                        value="{{ hora_actual_envio }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            

                                        </div>
                                    </fieldset>


                                    <header style="margin-top: 10px;">
                                        Destinatario
                                    </header>
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-8" id="select-ciudadano" style="float: left;">
                                                <label class="text-info">Personal - Cargo - Área 
                                                </label>
                                                <select type="text" id="input-id_personal_area" name="id_personal_area"
                                                    style="width:100%;">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for personal_select in personal %}

                                                    {% if personal_select.id_personal_area == id_personal_area %}
                                                    <option
                                                        data-value="{{personal_select.personal_nombre }}"
                                                        value="{{ personal_select.id_personal_area }}" selected="selected">
                                                        {{personal_select.personal_nombre }} - {{personal_select.cargo }} - {{personal_select.nombre_area }} 
                                                    </option>
                                                    {% else %}
                                                    <option
                                                        data-value="{{personal_select.personal_nombre }}"
                                                        value="{{ personal_select.id_personal_area }}">
                                                        {{personal_select.personal_nombre }} - {{personal_select.cargo }} - {{personal_select.nombre_area }}
                                                    </option>
                                                    {% endif %}


                                                    {% endfor %}
                                                </select> <i></i>
                                                <input type="hidden" id="destinatario_personal"
                                                    name="destinatario_personal" value="{{destinatario_personal}}">
                                            </section>



                                            

                                        </div>
                                    </fieldset>


                                    <header style="margin-top: 10px;">
                                        Documento
                                    </header>
                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-4">
                                                <label class="text-info">Tipo de documento
                                                </label>
                                                <label class="select">
                                                    <select id="input-id_tipo_doc" name="id_tipo_doc">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for tipodocumentos_select in tipodocumentos %}
                                                        {% if tipodocumentos_select.codigo == id_tipo_doc %}
                                                        <option selected="selected"
                                                            value="{{ tipodocumentos_select.codigo }}">{{
                                                            tipodocumentos_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipodocumentos_select.codigo }}">{{
                                                            tipodocumentos_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Nro. Folios</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="number" id="input-nro_folios" name="nro_folios"
                                                        placeholder="Nro. Folios" value="{{ nro_folios }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_documento" name="nro_documento"
                                                        placeholder="Doumento" value="{{ nro_documento }}">

                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Asunto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-asunto" name="asunto"
                                                        placeholder="Asunto">{{ asunto }}</textarea>
                                                </label>
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
    <div id="success">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>


<script type="text/javascript">

    var publica = "no";
    var idl = "";

    var id_personal_area_remitente = "{{ id_personal_area_remitente }}";

</script>