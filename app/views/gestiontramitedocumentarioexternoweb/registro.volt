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


{% set remitente_dni = "" %}
{% if documentos.remitente_dni is defined %}
{% set remitente_dni = documentos.remitente_dni %}
{% endif %}


{% set remitente_celular = "" %}
{% if documentos.remitente_celular is defined %}
{% set remitente_celular = documentos.remitente_celular %}
{% endif %}


{% set remitente_email = "" %}
{% if documentos.remitente_email is defined %}
{% set remitente_email = documentos.remitente_email %}
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

{% set id_area = "" %}
{% if documentos.id_area is defined %}
{% set id_area = documentos.id_area %}
{% endif %}

{% set id_tipo_envio = "" %}
{% if documentos.id_tipo_envio is defined %}
{% set id_tipo_envio = documentos.id_tipo_envio %}
{% endif %}


{% set destinatario_area = "" %}
{% if documentos.destinatario_area is defined %}
{% set destinatario_area = documentos.destinatario_area %}
{% endif %}

{% set id_personal = "" %}
{% if documentos.id_personal is defined %}
{% set id_personal = documentos.id_personal %}
{% endif %}

{% set destinatario_personal = "" %}
{% if documentos.destinatario_personal is defined %}
{% set destinatario_personal = documentos.destinatario_personal %}
{% endif %}

{% set id_cargo = "" %}
{% if documentos.id_cargo is defined %}
{% set id_cargo = documentos.id_cargo %}
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

{% set observaciones = "" %}
{% if documentos.observaciones is defined %}
{% set observaciones = documentos.observaciones %}
{% endif %}

{% set proceso_tramite_nombres = "" %}
{% if ProcesoTramite.nombres is defined %}
{% set proceso_tramite_nombres = ProcesoTramite.nombres %}
{% endif %}


{% set nro_folios = "" %}
{% if documentos.nro_folios is defined %}
{% set nro_folios = documentos.nro_folios %}
{% endif %}

{% set proceso = "" %}
{% if documentos.proceso is defined %}
{% set  proceso = documentos.proceso %}
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
                                    {{ form('gestiontramitedocumentarioexterno/save','method':
                                    'post','id':'form_documentos','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Envio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-fecha_actual_envio"
                                                        name="fecha_actual_envio" placeholder="Fecha Envio" class=""
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_envio }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-fecha_actual_envio"
                                                        name="fecha_actual_envio" placeholder="Fecha Envio" class=""
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual_envio }}"
                                                        readonly>
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
                                                        data-dateformat='dd/mm/yy' value="{{ hora_envio }}" readonly>
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
                                                        name="fecha_actual_cargo" placeholder="Fecha Cargo" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_cargo }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-fecha_actual_cargo"
                                                        name="fecha_actual_cargo" placeholder="Fecha Cargo" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual_cargo }}">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Hora Cargo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-hora_actual_cargo"
                                                        name="hora_actual_cargo" placeholder="Hora Cargo" class=""
                                                        data-dateformat='dd/mm/yy' value="{{ hora_actual_cargo }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-hora_actual_cargo"
                                                        name="hora_actual_cargo" placeholder="Hora Cargo"
                                                        value="{{ hora_actual_cargo }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>



                                <input type="hidden" name="id_remitente" value="{{ id_remitente }}"/>

                                    <header style="margin-top: 10px;">
                                        Remitente
                                    </header>
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-6">
                                                <label class="text-info">Apellidos y Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-apellidos_nombres"
                                                        name="remitente_nombres" placeholder="Apellidos y Nombres"
                                                        value="{{ remitente_nombres }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-apellidos_nombres"
                                                        name="remitente_nombres" placeholder="Apellidos y Nombres"
                                                        value="{{ apellidos_nombres }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">DNI</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-dni"
                                                        name="remitente_dni" placeholder="DNI"
                                                        value="{{ dni }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-dni"
                                                        name="remitente_dni" placeholder="DNI"
                                                        value="{{ dni }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-celular"
                                                        name="remitente_celular" placeholder="celular"
                                                        value="{{ celular }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-celular"
                                                        name="remitente_celular" placeholder="celular"
                                                        value="{{ celular }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">E-mail</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-email"
                                                        name="remitente_email" placeholder="email"
                                                        value="{{ email }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-email"
                                                        name="remitente_email" placeholder="email"
                                                        value="{{ email }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <!--
                                            <section class="col col-md-6">
                                                <label class="text-info">Cargo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-cargo" name="remitente_cargo"
                                                        placeholder="Cargo" value="{{ remitente_cargo }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-cargo" name="remitente_cargo"
                                                        placeholder="Cargo" value="{{ cargo }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>
                                            
                                            <section class="col col-md-6">
                                                <label class="text-info">Área</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="area" name="remitente_area"
                                                        placeholder="Area" value="{{ remitente_area }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="area" name="remitente_area"
                                                        placeholder="Area" value="{{ area }}" readonly>
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Institución</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>


                                                    {% if id_doc !== "" %}
                                                    <input type="text" id="input-institucion"
                                                        name="remitente_institucion" placeholder="Institución"
                                                        value="{{ remitente_institucion }}" readonly>
                                                    {% else %}
                                                    <input type="text" id="input-institucion"
                                                        name="remitente_institucion" placeholder="Institución"
                                                        value="{{ institucion }}" readonly>
                                                    {% endif %}

                                                </label>
                                            </section>
                                            -->
                                        </div>
                                    </fieldset>

                                    <header style="margin-top: 10px;">
                                        Destinatario
                                    </header>
                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-6">
                                                <label class="text-info">Personal</label>
                                                <label class="input">
                                                    {% if id_doc !== "" %}
                                                    <input readonly type="text" list="datalist-personal"
                                                        name="destinatario_personal" id="input-personal"
                                                        value="{{destinatario_personal}}" >
                                                    <datalist id="datalist-personal">
                                                        {% for personal_select in personal %}
                                                        <option data-value="{{ personal_select.codigo }}"
                                                            value="{{ personal_select.apellidop }} {{ personal_select.apellidom}} {{ personal_select.nombres }}"
                                                            style="width: 100px;"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% else %}
                                                    <input readonly type="text" list="datalist-personal"
                                                        name="destinatario_personal" id="input-personal">
                                                    <datalist id="datalist-personal">
                                                        {% for personal_select in personal %}
                                                        <option data-value="{{ personal_select.codigo }}"
                                                            value="{{ personal_select.apellidop }} {{ personal_select.apellidom}} {{ personal_select.nombres }}"
                                                            style="width: 100px;"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% endif %}
                                                </label>
                                                <input type="hidden" id="id_personal" name="id_personal" value="">
                                            </section>


                                           
                                            <section class="col col-md-6">
                                                <label class="text-info">Cargo
                                                </label>
                                                <label class="select">
                                                    <select  id="input-id_cargo" name="id_cargo" {% if id_doc !=="" %}
                                                         {% endif %}>
                                                        <option value="">SELECCIONE...</option>
                                                        {% for cargos_select in cargos %}
                                                        {% if cargos_select.codigo == id_cargo %}
                                                        <option selected="selected" value="{{ cargos_select.codigo }}">
                                                            {{cargos_select.nombres }}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ cargos_select.codigo }}">{{
                                                            cargos_select.nombres }}</option>
                                                        {% endif %}
                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>

                                            </section>
                                          


                                            <section class="col col-md-6" style="float: right;">

                                                <label class="text-info">Sede
                                                </label>
                                                <label class="select">
                                                    <select  id="input-id_sede" name="id_sede" {% if id_doc !=="" %}
                                                         {% endif %}>
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

                                            <section class="col col-md-6">
                                                <label class="text-info">Areas</label>
                                                <label class="input">
                                                    {% if id_doc !== "" %}
                                                    <input readonly type="text" list="datalist-area" name="destinatario_area"
                                                        value="{{destinatario_area}}" id="input-area" >
                                                    <datalist id="datalist-area">
                                                        {% for areas_select in areas %}
                                                        <option value="{{ areas_select.nombres }}" style="width: 100px;"
                                                            data-value="{{ areas_select.codigo }}"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% else %}
                                                    <input readonly type="text" list="datalist-area" name="destinatario_area"
                                                        value="" id="input-area">
                                                    <datalist id="datalist-area">
                                                        {% for areas_select in areas %}
                                                        <option value="{{ areas_select.nombres }}" style="width: 100px;"
                                                            data-value="{{ areas_select.codigo }}"></option>
                                                        {% endfor %}
                                                    </datalist>
                                                    {% endif %}
                                                </label>
                                                <input type="hidden" id="id_area" name="id_area" value="">
                                            </section>

                                        </div>
                                    </fieldset>


                                    <header style="margin-top: 10px;">
                                        Documento
                                    </header>
                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-3" style="float: left;">
                                                <label class="text-info">Tipo de documento
                                                </label>
                                                <label class="select">
                                                    <select   id="input-id_tipo_doc" name="id_tipo_doc" {% if id_doc !==""
                                                        %} {% endif %}>
                                                        <option value="" >SELECCIONE...</option>
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


                                            <section class="col col-md-6">
                                                <label class="text-info">Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input readonly type="text" id="input-nro_documento" name="nro_documento"
                                                        placeholder="Doumento" value="{{ nro_documento }}" {% if id_doc
                                                        !=="" %}  {% endif %}>

                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Nro. Folios</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input readonly type="number" id="input-nro_folios" name="nro_folios"
                                                        placeholder="Nro. Folios" value="{{ nro_folios }}" {% if id_doc
                                                        !=="" %}  {% endif %}>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Asunto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea readonly rows="3" id="input-asunto" name="asunto"
                                                        placeholder="Asunto" {% if id_doc !=="" %}  {% endif
                                                        %}>{{ asunto }}</textarea>
                                                </label>
                                            </section>


                                            

                                            <section class="col col-md-6">

                                                <label class="text-info">Archivo (formato PDF)</label>
                                                

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/tramite_documentario/externos/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
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



                                    <header style="margin-top: 10px;">
                                        Trámite
                                    </header>
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-3" style="float: left;">
                                                <label class="text-info">Proceso
                                                </label>
                                                <label class="select">
                                                    <select   id="input-id_proc" name="id_proc">
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for ptramite in ProcesoTramite %}
                                                        {% if ptramite.codigo == proceso %}
                                                        <option selected="selected"
                                                            value="{{ ptramite.codigo }}">{{
                                                                ptramite.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ ptramite.codigo }}">{{
                                                            ptramite.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                        
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea  rows="3" id="input-observaciones" name="observaciones"
                                                        placeholder="Observaciones" {% if id_doc !=="" %}  {% endif
                                                        %}>{{ observaciones }}</textarea>
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
            Se guardó correctamente...
        </p>
    </div>
</div>