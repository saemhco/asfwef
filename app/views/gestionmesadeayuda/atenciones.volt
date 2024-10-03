<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Atenciones</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
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
                    <div class="widget-body text-center" style="margin-bottom: -18px !important;">

                        <a href="{{ url('gestionmesadeayuda/registro') }}" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                class="fa fa-list"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Atenciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <div class="widget-body-toolbar">
                                        <div class="row">
                                            <div class="col-sm-6 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_pdf();"
                                                    class="btn bg-color-magenta txt-color-white"><i
                                                        class="fa fa-file-pdf-o"></i>
                                                    &nbsp;Reporte
                                                </a>
                                            </div>
                                            <div class="col-sm-6 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_xls()"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    &nbsp;Exportar
                                                </a>
                                            </div>
                                        </div>

                                        {{ form('','method': 'get','id':'form_parametros','class':'smart-form') }}
                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-3">
                                                    <label class="text-info">Tipo de Atención
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-tipo_atencion" name="tipo">
                                                            <option value=""> SELECCIONE...</option>
                                                            {% for tipo_atencion_select in tipo_atencion %}

                                                            <option value="{{ tipo_atencion_select.codigo }}">{{
                                                                tipo_atencion_select.nombres }} </option>

                                                            {% endfor %}
                                                        </select> <i></i>
                                                    </label>

                                                </section>
                                                <section class="col col-3">
                                                    <label class="text-info">Proceso
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-proceso" name="proceso">
                                                            <option value=""> SELECCIONE...</option>
                                                            {% for proceso_select in procesos %}
                                                            <option value="{{ proceso_select.codigo }}">{{
                                                                proceso_select.nombres }} </option>
                                                            {% endfor %}
                                                        </select> <i></i>
                                                    </label>
                                                </section>
                                                <section class="col col-2">
                                                    <label class="text-info">Fecha Inicio</label>
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                            placeholder="Fecha  Inicio" class="datepicker"
                                                            data-dateformat='dd/mm/yy'>
                                                    </label>
                                                </section>
                                                <section class="col col-2">
                                                    <label class="text-info">Fecha Fin</label>
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                        <input type="text" id="input-fecha_fin" name="fecha_fin"
                                                            placeholder="Fecha Fin" class="datepicker"
                                                            data-dateformat='dd/mm/yy'>
                                                    </label>
                                                </section>

                                                <section class="col col-md-2">
                                                    <label class="text-info">&nbsp</label>
                                                    <label class="input">
                                                        <button type="button" class="btn btn-warning btn-block btn-sm"
                                                            id="input-buscar">
                                                            <span class="fa fa-search"></span> Buscar
                                                        </button>
                                                    </label>
                                                </section>

                                            </div>
                                        </fieldset>
                                        {{ endForm() }}
                                    </div>

                                    <table id="tbl_atenciones"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">DNI</th>
                                                <th data-hide="phone,tablet">Usuario</th>
                                                <th data-hide="phone,tablet">Tipo</th>
                                                <th data-hide="phone,tablet">Prioridad</th>
                                                <th data-hide="phone,tablet">Fecha Recepción</th>
                                                <th data-hide="phone,tablet">Hora</th>
                                                <th data-hide="phone,tablet">Fecha Prevista</th>
                                                <th data-hide="phone,tablet">Fecha Termino</th>
                                                <th data-hide="phone,tablet">Personal</th>
                                                <th data-hide="phone,tablet">Proceso</th>
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
</div>

{{ form('','method': 'post','id':'form_atenciones','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-primary table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <center>DATOS DE LA ATENCIÓN: <span id="input-codigo_atencion_text"></span></center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr {#style="background-color: #F7F7F7;" #}>
                            <td width="20%"><strong>Fecha:</strong> <span id="input-fecha_recepcion"></span></td>
                            <td width="20%"><strong>DNI:</strong> <span id="input-dni"></span></td>
                            <td><strong>Usuario:</strong> <span id="input-publico"></span></td>
                        </tr>
                        <tr>

                            <td colspan="3"><strong>Asunto:</strong> <span id="input-asunto"></span></td>

                        </tr>
                    </tbody>
                </table>
                <input type="hidden" class="" name="atencion" value="" id="input-atencion">
                <input type="hidden" class="" name="codigo" value="" id="input-codigo">
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Areas
            </label>
            <label class="select">
                <select id="input-area" name="area">
                    <option value="0">SELECCIONE...</option>
                    {% for areas_select in areas %}

                    <option value="{{ areas_select.codigo }}" area_nombre="{{ areas_select.nombres }}">{{
                        areas_select.nombres }} </option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Personal</label>
            <label class="select">
                <select id="input-personal" name="personal">
                    <option value="0">SELECCIONE...</option>
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-4">
            <button type="button" class="btn btn-primary btn-sm" id="input-agregar_personal">
                <span class="fa fa-plus-circle"></span> Agregar
            </button>
        </section>

        <section class="col col-md-8">
            <label class="text-info" id="input-personal_select"></label>
        </section>

        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;text-align: center;">Area</th>
                            <th style="vertical-align: middle;text-align: center;">Personal</th>
                            <th style="vertical-align: middle;text-align: center;">Fecha Asignación</th>
                            <th style="vertical-align: middle;text-align: center;">Fecha Solución</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_atenciones_detalle">

                    </tbody>
                </table>
            </div>
        </section>

    </div>
</fieldset>
{{ endForm() }}


{{ form('','method': 'post','id':'modal_area_personal','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;text-align: center;">Area</th>
                            <th style="vertical-align: middle;text-align: center;">Personal</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_atenciones_area_personal">

                    </tbody>
                </table>
            </div>
        </section>

    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'form_reporte_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-6">
            <label class="text-info">Tipo de Atención
            </label>
            <label class="select">
                <select id="input-tipo_atencion_pdf" name="tipo">
                    <option value=""> SELECCIONE...</option>
                    {% for tipo_atencion_select in tipo_atencion %}

                    <option value="{{ tipo_atencion_select.codigo }}">{{ tipo_atencion_select.nombres }} </option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-6">
            <label class="text-info">Proceso
            </label>
            <label class="select">
                <select id="input-proceso_pdf" name="proceso">
                    <option value=""> SELECCIONE...</option>
                    {% for proceso_select in procesos %}
                    <option value="{{ proceso_select.codigo }}">{{
                        proceso_select.nombres }} </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_pdf" name="fecha_inicio" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_pdf" name="fecha_fin" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="reporte_gestionmesadeayuda_pdf()" id="reporte_gestionmesadeayuda_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de atenciones</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<!-- modal reporte -->
{{ form('','method': 'post','id':'form_reporte_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-6">
            <label class="text-info">Tipo de Atención
            </label>
            <label class="select">
                <select id="input-tipo_atencion_xls" name="tipo">
                    <option value=""> SELECCIONE...</option>
                    {% for tipo_atencion_select in tipo_atencion %}

                    <option value="{{ tipo_atencion_select.codigo }}">{{ tipo_atencion_select.nombres }} </option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-6">
            <label class="text-info">Proceso
            </label>
            <label class="select">
                <select id="input-proceso_xls" name="proceso">
                    <option value=""> SELECCIONE...</option>
                    {% for proceso_select in procesos %}
                    <option value="{{ proceso_select.codigo }}">{{
                        proceso_select.nombres }} </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_xls" name="fecha_inicio" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_xls" name="fecha_fin" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-12">
            <a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
                onclick="reporte_gestionmesadeayuda_xls()" id="reporte_gestionmesadeayuda_xls"><i
                    class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de atenciones</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<!-- <script type="text/javascript">

    {% if t_a is defined %}
    var t_a = "{{ t_a }}";
    {% else %}
    var t_a = "{{ t_a }}";
    {% endif %}

    {% if p is defined %}
    var p = "{{ p }}";
    {% else %}
    var p = "{{ p}}";
    {% endif %}

    {% if f_i_d is defined %}
    var f_i_d = "{{ f_i_d }}";
    {% else %}
    var f_i_d = "{{ f_i_d }}";
    {% endif %}

    {% if f_f_d is defined %}
    var f_f_d = "{{ f_f_d }}";
    {% else %}
    var f_f_d = "{{ f_f_d }}";
    {% endif %}

</script> -->

<script type="text/javascript">
    var t_a = 0;

    var p = 0;

    var f_i_d = 0;

    var f_f_d = 0;
</script>