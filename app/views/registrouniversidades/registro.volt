{% set id_universidad = "" %}
{% if universidades.id_universidad is defined %}
{% set id_universidad = universidades.id_universidad %}
{% endif %}

{% set tipo_institucion = "" %}
{% if universidades.tipo_institucion is defined %}
{% set tipo_institucion = universidades.tipo_institucion %}
{% endif %}

{% set universidad = "" %}
{% if universidades.universidad is defined %}
{% set universidad = universidades.universidad %}
{% endif %}

{% set departamento = "" %}
{% if universidades.departamento is defined %}
{% set departamento = universidades.departamento %}
{% endif %}

{% set provincia = "" %}
{% if universidades.provincia is defined %}
{% set provincia = universidades.provincia %}
{% endif %}

{% set dispositivo = "" %}
{% if universidades.dispositivo is defined %}
{% set dispositivo = universidades.dispositivo %}
{% endif %} 

{% set fecha_creacion = "" %}
{% if universidades.fecha_creacion is defined %}
{% set fecha_creacion = utilidades.fechita(universidades.fecha_creacion,'d/m/Y') %}
{% endif %}


{% set dispositivo_licenciamiento = "" %}
{% if universidades.dispositivo_licenciamiento is defined %}
{% set dispositivo_licenciamiento = universidades.dispositivo_licenciamiento %}
{% endif %} 

{% set fecha_licenciamiento = "" %}
{% if universidades.fecha_licenciamiento is defined %}
{% set fecha_licenciamiento = utilidades.fechita(universidades.fecha_licenciamiento,'d/m/Y') %}
{% endif %}

{% set convenio = "" %}
{% if universidades.convenio is defined %}
{% set convenio = universidades.convenio %}
{% endif %} 

{% set pais = "" %}
{% if universidades.pais is defined %}
{% set pais = universidades.pais %}
{% endif %} 

{% set txt_buton = "Guardar" %}
{% if universidades.estado is defined %}
{% set estado = universidades.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Asignatura</li>
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
                                <h2>Registro de asignatura</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrouniversidades/save','method':
                                    'post','id':'form_tbl_web_universidades','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info">Tipo de Institucion</label>
                                                <label class="select">
                                                    <select id="input-tipo_institucion" name="tipo_institucion">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for tipoinstitucion_select in tipoinstitucion %}
                                                        {% if tipoinstitucion_select.codigo == tipo_institucion %}
                                                        <option value="{{ tipoinstitucion_select.codigo }}" selected>{{
                                                            tipoinstitucion_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipoinstitucion_select.codigo }}">{{
                                                            tipoinstitucion_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>

                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info">Nombre de la Universidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-universidad" name="universidad"
                                                        placeholder="Nombre de la universidad"
                                                        value="{{ universidad }}">
                                                        <input type="hidden" id="input-id" name="id" value="{{ id_universidad }}">

                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Departamento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-departamento" name="departamento" placeholder="Departamento"
                                                        value="{{ departamento }}">
                                                </label>
                                            </section>
                                            
                                            <section class="col col-md-4">
                                                <label class="text-info">Provincia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-provincia" name="provincia" placeholder="Provincia"
                                                        value="{{ provincia }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Dispositivo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-dispositivo" name="dispositivo" placeholder="Dispositivo"
                                                        value="{{ dispositivo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Dispositivo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-dispositivo" name="dispositivo" placeholder="Dispositivo"
                                                        value="{{ dispositivo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha de Creacion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_creacion" name="fecha_creacion" placeholder="Fecha de Creacion" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_creacion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Dispositivo Licenciamiento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-dispositivo_licenciamiento" name="dispositivo_licenciamiento" placeholder="Dispositivo Licenciamiento"
                                                        value="{{ dispositivo_licenciamiento }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha Licenciamiento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_licenciamiento" name="fecha_licenciamiento" placeholder="Fecha de Creacion" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_licenciamiento }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Pais</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pais" name="pais" placeholder="Pais"
                                                        value="{{ pais }}">
                                                </label>
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info" ></label>
                                                <label class="checkbox">
                                                    {% if convenio == '1' %}
                                                        <input type="checkbox" name="convenio" value="{{ convenio }}" id="convenio" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="convenio" value="{{ convenio }}" id="convenio">
                                                    {% endif %}
                                                    <i></i>Convenio

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
    <div id="error_asignatura_registrada">
        <p>
            Asignatura registrada...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="codigo_asignatura_vacio">
        <p>
            Debe ingresar un codigo valido...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="save_asignatura">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>
<script type="text/javascript">



    var publica = "si";

    //alert("Hola");
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>