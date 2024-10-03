<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Gestión Planillas</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1">
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


                        <a href="{{ url('registroplanillas/registro') }}" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>


                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

                        <a href="javascript:void(0);" title="Registrar personal" onclick="personal();"
                            class="btn btn-info btn-block"><i class="fa fa-group"></i></a>



                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Planillas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    <div class="widget-body-toolbar">
                                        <div class="row">

                                            <!-- <div class="col-sm-4 text-center">
                                                <button type="button" class="btn btn-primary" id="btn-generar-planillas">
                                                    <i class="fa fa-file-pdf-o"></i> Generar Planillas
                                                </button>
                                            </div> -->

                                            <div class="col-sm-4 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_pdf();"
                                                    class="btn bg-color-magenta txt-color-white"><i
                                                        class="fa fa-file-pdf-o"></i>
                                                    &nbsp;Reporte
                                                </a>
                                            </div>

                                            <div class="col-sm-4 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_xls()"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    &nbsp;Exportar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="tbl_planillas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Nombre</th>
                                                <th data-hide="phone,tablet">Periodo</th>
                                                <th data-hide="phone,tablet">Número</th>
                                                <th data-hide="phone,tablet">Fecha Inicio</th>
                                                <th data-hide="phone,tablet">Fecha Fin</th>
                                                <th data-hide="phone,tablet">Acciones</th>
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
</div>

<!-- modal proceso -->
{{ form('registroplanillas/copiarplanilla','method': 'post','id':'form_proceso','class':'smart-form','style':'display:none;')
}}
<fieldset>
    <div class="row">

        <section class="col col-md-12" style="padding-bottom: 100px;">
            <label class="text-info">Planilla</label>

            <select id="select-id_planilla" name="select-id_planilla" style="width:100%">
                <option value="">SELECCIONE...</option>
                {% for planillas_select in planillas %}

                <option value="{{ planillas_select.id_planilla }}">{{ planillas_select.tipo_planilla }} {{
                    planillas_select.planilla }} {{ planillas_select.numero }} / {{ planillas_select.periodo }}
                </option>

                {% endfor %}
            </select> <i></i>

        </section>

        <input type="hidden" id="datatable-id_planilla" name="datatable-id_planilla" value="">

    </div>
</fieldset>
{{ endForm() }}
<!--fin-->