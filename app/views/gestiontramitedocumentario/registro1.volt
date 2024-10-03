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

{% set remitente_nombres = "" %}
{% if documentos.remitente_nombres is defined %}
{% set remitente_nombres = documentos.remitente_nombres %}
{% endif %}

{% set remitente_cargo = "" %}
{% if documentos.remitente_cargo is defined %}
{% set remitente_cargo = documentos.remitente_cargo %}
{% endif %}

{% set remitente_area = "" %}
{% if documentos.remitente_area is defined %}
{% set remitente_area = documentos.remitente_area %}
{% endif %}

{% set remitente_institucion = "" %}
{% if documentos.remitente_institucion is defined %}
{% set remitente_institucion = documentos.remitente_institucion %}
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

{% set fecha_cargo = "" %}
{% if documentos.fecha_cargo is defined %}
{% set fecha_cargo = utilidades.fechita(documentos.fecha_cargo,'d/m/Y') %}
{% endif %}

{% if documentos.fecha_cargo is defined %}
{% set hora_cargo = utilidades.hora_formato(documentos.fecha_cargo,'H:i:s') %}
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

{% set expediente = "" %}
{% if documentos.expediente is defined %}
{% set expediente = documentos.expediente %}
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
                                    {{ form('gestiontramitedocumentario/save','method':
                                    'post','id':'form_documentos','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">
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
                                            </section>



                                            <section class="col col-md-3">
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





                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Cargo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-fecha_actual_cargo"
                                                        name="fecha_actual_cargo" placeholder="Fecha Cargo"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_cargo }}">
                                                    {% else %}
                                                    <input type="text" id="input-fecha_actual_cargo"
                                                        name="fecha_actual_cargo" placeholder="Fecha Cargo" class=""
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual_cargo }}"
                                                        readonly>
                                                    {% endif %}
                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Hora Cargo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-hora_actual_cargo"
                                                        name="hora_actual_cargo" placeholder="Hora Cargo" class=""
                                                        data-dateformat='dd/mm/yy' value="{{ hora_cargo }}">
                                                    {% else %}
                                                    <input type="text" id="input-hora_actual_cargo"
                                                        name="hora_actual_cargo" placeholder="Hora Cargo"
                                                        value="{{ hora_actual_cargo }}">
                                                    {% endif %}
                                                </label>
                                            </section>




                                        </div>
                                    </fieldset>

                                    <header style="margin-top: 10px;">
                                        Remitente
                                    </header>
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-6">
                                                <label class="text-info">Remitente</label>
                                                <label class="input">

                                                    {% if id_doc !== "" %}
                                                    <input type="text" list="datalist-remitente_nombres"
                                                        name="remitente_nombres" value="{{remitente_nombres}}"
                                                        id="input-remitente_nombres">
                                                    <datalist id="datalist-remitente_nombres">
                                                        {% for remitentes_select in remitentes %}
                                                        <option data-value="{{ remitentes_select.codigo }}"
                                                            value="{{remitentes_select.apellidop}} {{remitentes_select.apellidom}} {{remitentes_select.nombres}}"
                                                            style="width: 100px;"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% else %}
                                                    <input type="text" list="datalist-remitente_nombres"
                                                        name="remitente_nombres" value="" id="input-remitente_nombres">
                                                    <datalist id="datalist-remitente_nombres">
                                                        {% for remitentes_select in remitentes %}
                                                        <option data-value="{{ remitentes_select.codigo }}"
                                                            value="{{remitentes_select.apellidop}} {{remitentes_select.apellidom}} {{remitentes_select.nombres}}"
                                                            style="width: 100px;"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% endif %}
                                                </label>
                                                <input type="hidden" id="id_remitente" name="id_remitente"
                                                    value="{{id_remitente}}">
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Cargo</label>
                                                <label class="input">
                                                    {% if id_doc !== "" %}
                                                    <input type="text" list="datalist-remitente_cargo"
                                                        name="remitente_cargo" value="{{remitente_cargo}}"
                                                        id="input-remitente_cargo">
                                                    <datalist id="datalist-remitente_cargo">
                                                        {% for cargos_select in cargos %}
                                                        <option data-value="{{ cargos_select.codigo }}"
                                                            value="{{cargos_select.nombres }}" style="width: 100px;">
                                                        </option>
                                                        </option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% else %}
                                                    <input type="text" list="datalist-remitente_cargo"
                                                        name="remitente_cargo" value="" id="input-remitente_cargo">
                                                    <datalist id="datalist-remitente_cargo">
                                                        {% for cargos_select in cargos %}
                                                        <option data-value="{{ cargos_select.codigo }}"
                                                            value="{{cargos_select.nombres }}" style="width: 100px;">
                                                        </option>
                                                        </option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Areas</label>
                                                <label class="input">
                                                    {% if id_doc !== "" %}
                                                    <input type="text" list="datalist-remitente_area"
                                                        name="remitente_area" value="{{remitente_area}}"
                                                        id="input-remitente_area">
                                                    <datalist id="datalist-remitente_area">
                                                        {% for areas_select in areas %}
                                                        <option value="{{ areas_select.nombres }}" style="width: 100px;"
                                                            data-value="{{ areas_select.codigo }}"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% else %}
                                                    <input type="text" list="datalist-remitente_area"
                                                        name="remitente_area" value="" id="input-remitente_area">
                                                    <datalist id="datalist-remitente_area">
                                                        {% for areas_select in areas %}
                                                        <option value="{{ areas_select.nombres }}" style="width: 100px;"
                                                            data-value="{{ areas_select.codigo }}"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% endif %}
                                                </label>

                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Institución</label>
                                                <label class="input">
                                                    {% if id_doc !== "" %}
                                                    <input type="text" list="datalist-remitente_institucion"
                                                        name="remitente_institucion" value="{{remitente_institucion}}"
                                                        id="input-remitente_institucion">
                                                    <datalist id="datalist-remitente_institucion">
                                                        {% for empresas_select in empresas %}
                                                        <option data-value="{{ empresas_select.id_empresa }}"
                                                            value="{{empresas_select.razon_social}}"
                                                            style="width: 100px;"></option>
                                                        {% endfor %}
                                                    </datalist> </label>
                                                {% else %}
                                                <input type="text" list="datalist-remitente_institucion"
                                                    name="remitente_institucion" value=""
                                                    id="input-remitente_institucion">
                                                <datalist id="datalist-remitente_institucion">
                                                    {% for empresas_select in empresas %}
                                                    <option data-value="{{ empresas_select.id_empresa }}"
                                                        value="{{empresas_select.razon_social}}" style="width: 100px;">
                                                    </option>
                                                    {% endfor %}
                                                </datalist> </label>
                                                {% endif %}
                                            </section>
                                        </div>
                                    </fieldset>


                                    <header style="margin-top: 10px;">
                                        Destinatario
                                    </header>
                                    <fieldset>

                                        <div class="row">
                                            
                                            <section class="col col-md-6" id="select-ciudadano" style="float: left;">
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



                                            <section class="col col-md-6" style="float: right;">
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

                                        </div>
                                    </fieldset>


                                    <header style="margin-top: 10px;">
                                        Documento
                                    </header>
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info">Expediente</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-expediente" name="expediente"
                                                        placeholder="Expediente" value="{{ expediente }}">
                                                </label>
                                            </section>

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

                                            <section class="col col-md-4">
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
                                                        placeholder="Doumento" value="{{ nro_documento }}" {% if id_doc
                                                        !=="" %} readonly {% endif %}>

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