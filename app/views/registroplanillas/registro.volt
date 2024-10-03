<style>
    #cke_input-perfil {
        border: solid 1px black;
    }
</style>

{% set disabled = "" %}
{% set readonly = "" %}
{% if planilla.id_planilla is defined %}
{% set disabled = "disabled" %}
{% set readonly = "readonly" %}
{% endif %}

{% set id_planilla = "" %}
{% if planilla.id_planilla is defined %}
{% set id_planilla = planilla.id_planilla %}
{% endif %}

{% set anio = "" %}
{% if planilla.anio is defined %}
{% set anio = planilla.anio %}
{% endif %}

{% set periodo = "" %}
{% if planilla.periodo is defined %}
{% set periodo = planilla.periodo %}
{% endif %}

{% set numero = "" %}
{% if planilla.numero is defined %}
{% set numero = planilla.numero %}
{% endif %}

{% set id_planilla_tipo = "" %}
{% if planilla.id_planilla_tipo is defined %}
{% set id_planilla_tipo = planilla.id_planilla_tipo %}
{% endif %}



{% set especifica = "" %}
{% if planilla.especifica is defined %}
{% set especifica = planilla.especifica %}
{% endif %}

{% set fuente_financ = "" %}
{% if planilla.fuente_financ is defined %}
{% set fuente_financ = planilla.fuente_financ %}
{% endif %}

{% set rubro = "" %}
{% if planilla.rubro is defined %}
{% set rubro = planilla.rubro %}
{% endif %}

{% set tipo_recurso = "" %}
{% if planilla.tipo_recurso is defined %}
{% set tipo_recurso = planilla.tipo_recurso %}
{% endif %}

{% set referencia = "" %}
{% if planilla.referencia is defined %}
{% set referencia = planilla.referencia %}
{% endif %}

{% set nombre = "" %}
{% if planilla.nombre is defined %}
{% set nombre = planilla.nombre %}
{% endif %}

{% set fecha_inicio = "" %}
{% if planilla.fecha_inicio is defined %}
{% set fecha_inicio = utilidades.fechita(planilla.fecha_inicio,'d/m/Y') %}
{% endif %}

{% set fecha_fin = "" %}
{% if planilla.fecha_fin is defined %}
{% set fecha_fin = utilidades.fechita(planilla.fecha_fin,'d/m/Y') %}
{% endif %}

{% set referencia = "" %}
{% if planilla.referencia is defined %}
{% set referencia = planilla.referencia %}
{% endif %}


{% set nro_referencia = "" %}
{% if planilla.nro_referencia is defined %}
{% set nro_referencia = planilla.nro_referencia %}
{% endif %}



{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if planilla.estado is defined %}
{% set estado = planilla.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Planilla</li>
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
                                <h2>Registro de Planilla </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroplanillas/save','method':
                                    'post','id':'form_planillas','class':'smart-form','enctype':'multipart/form-data')
                                    }}
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Año ejecucion</label>
                                                <label class="select">
                                                    <select id="input-anio" name="anio">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for anios_select in anios %}

                                                        {% if anios_select.nombres == anio_actual %}
                                                        <option selected="selected" value="{{ anios_select.nombres }}" anio_select="{{ anios_select.nombres }}">{{
                                                            anios_select.nombres }}</option>
                                                        {% else %}
                                                        {% if anios_select.nombres == anio %}
                                                        <option selected="selected" value="{{ anios_select.nombres }}" anio_select="{{ anios_select.nombres }}">{{
                                                            anios_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ anios_select.nombres }}" anio_select="{{ anios_select.nombres }}">{{
                                                            anios_select.nombres }}</option>
                                                        {% endif %}
                                                        {% endif %}


                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-3">

                                                <label class="text-info">Periodo
                                                </label>
                                                <label class="select">
                                                    <select id="input-periodo" name="periodo">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for c in periodos %}
                                                        {% if c.codigo == periodo %}
                                                        <option selected="selected" value="{{ c.codigo }}"
                                                            fecha_inicio="{{ c.fecha_inicio }}"
                                                            fecha_fin="{{ c.fecha_fin }}">{{ c.periodo }}</option>
                                                        {% else %}
                                                        <option value="{{ c.codigo }}"
                                                            fecha_inicio="{{ c.fecha_inicio }}"
                                                            fecha_fin="{{ c.fecha_fin }}">{{ c.periodo }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == "" %}
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    <input type="hidden" id="input-id_planilla" name="id_planilla" value="">

                                                    {% else %}
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                    <input type="hidden" id="input-id_planilla" name="id_planilla"
                                                        value="{{ id_planilla }}">

                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Fin</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_fin" name="fecha_fin"
                                                        placeholder="Fecha" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_fin }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Tipo de Planilla
                                                </label>
                                                <label class="select">
                                                    <select id="input-id_planilla_tipo" name="id_planilla_tipo" {{ disabled }}>
                                                        <option value="">SELECCIONE...</option>
                                                        {% for t_p in tipoplanillas %}
                                                        {% if t_p.id_planilla_tipo == id_planilla_tipo %}
                                                        <option selected="selected" value="{{ t_p.id_planilla_tipo }}">
                                                            {{ t_p.nombre }}</option>
                                                        {% else %}
                                                        <option value="{{ t_p.id_planilla_tipo }}">{{ t_p.nombre }}
                                                        </option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                    {% if id_planilla != "" %}
                                                    <input type="hidden" name="id_planilla_tipo" value="{{ id_planilla_tipo }}">
                                                    {% endif %}
                                                </label>
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info">Número</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero"
                                                        placeholder="Número" value="{{ numero }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-10">
                                                <label class="text-info">Planilla</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre"
                                                        placeholder="Planilla" value="{{ nombre }}">

                                                </label>
                                            </section>






                                        </div>

                                        <div class="row">
                                            <section class="col col-md-12">
                                                <label class="text-info">Especifica
                                                </label>

                                                <select id="input-especifica" name="especifica" style="width:100%">

                                                </select> <i></i>

                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Fuente Financiamiento
                                                </label>
                                                <label class="select">
                                                    <select id="input-fuente_financ" name="fuente_financ">
                                                        <option value="">SELECCIONE...</option>

                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Rubro
                                                </label>
                                                <label class="select">
                                                    <select id="input-rubro" name="rubro">
                                                        <option value="">SELECCIONE...</option>

                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Tipo Recurso
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_recurso" name="tipo_recurso">
                                                        <option value="">SELECCIONE...</option>

                                                    </select> <i></i>
                                                </label>
                                            </section>




                                        </div>
                                        <div class="row">
                                            <section class="col col-md-6">
                                                <label class="text-info">Referencia
                                                </label>
                                                <label class="select">
                                                    <select id="input-referencia" name="referencia">
                                                        <option value="">-- Seleccione --</option>
                                                        {% for c in referencias %}
                                                        {% if c.codigo == referencia %}
                                                        <option selected="selected" value="{{ c.codigo }}">{{
                                                            c.descripcion }}</option>
                                                        {% else %}
                                                        <option value="{{ c.codigo }}">{{ c.descripcion }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info">Número de Referencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_referencia" name="nro_referencia"
                                                        placeholder="Número de Referencia" value="{{ nro_referencia }}">

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

<script type="text/javascript">
    var id = "{{ id }}";
    var especifica = "{{ especifica }}";
    var fuente_financ = "{{ fuente_financ }}";
    var rubro = "{{ rubro }}";
    var tipo_recurso = "{{ tipo_recurso }}";
    var referencia = "{{ referencia }}";

</script>