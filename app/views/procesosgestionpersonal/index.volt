<style>
    .dataTables_filter input {
        width: 330px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Marcaciones</li>
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
                    <div class="widget-body text-center">


                        <a href="javascript:void(0);" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>


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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Marcaciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    <div class="widget-body-toolbar" style="margin-bottom: -10px !important;">

                                        {{ form('','method': 'get','id':'form_parametros','class':'smart-form') }}
                                        <fieldset style="background-color: #fafafa;">

                                            <div class="row"
                                                style="margin-top: -25px !important; background-color: #fafafa;">
                                                <label class="label col col-1">
                                                    Desde</label>
                                                <div class="col col-2">
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>


                                                        <input type="text" id="input-fecha_desde" name="fecha_desde"
                                                            placeholder="Fecha Desde" class="datepicker"
                                                            data-dateformat='dd/mm/yy' value="">


                                                    </label>
                                                </div>
                                                <label class="label col col-1">
                                                    Hasta</label>
                                                <div class="col col-2">
                                                    <label class="input"> <i class="icon-append fa fa-calendar"></i>


                                                        <input type="text" id="input-fecha_hasta" name="fecha_hasta"
                                                            placeholder="Fecha Hasta" class="datepicker"
                                                            data-dateformat='dd/mm/yy' value="">


                                                    </label>
                                                </div>
                                                <div class="col col-2">

                                                </div>
                                                <div class="col col-2">
                                                    <button type="button" class="btn btn-warning btn-sm btn-block"
                                                        id="input-buscar">
                                                        <span class="fa fa-search"></span> Buscar
                                                    </button>
                                                </div>
                                                <div class="col col-2">
                                                    <button type="button" class="btn btn-warning btn-sm btn-block"
                                                    id="btn-registrar-personal">
                                                        <span class="fa fa-gears"></span> Procesar
                                                    </button>
                                                </div>
                                            </div>


                                        </fieldset>
                                        {{ endForm() }}
                                    </div>

                                    <table id="tbl_web_personal_marcaciones"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha</th>
                                                <th>Personal</th>
                                                <th data-hide="phone,tablet">Ingreso 01</th>
                                                <th data-hide="phone,tablet">Salida 01</th>
                                                <th data-hide="phone,tablet">Ingreso 02</th>
                                                <th data-hide="phone,tablet">Salida 02</th>
                                                <th data-hide="phone,tablet">I1</th>
                                                <th data-hide="phone,tablet">S1</th>
                                                <th data-hide="phone,tablet">I2</th>
                                                <th data-hide="phone,tablet">S2</th>
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

<script type="text/javascript">

    var publica = "no";
    var id1 = "";
    var id2 = "";
    var xAbrevIns = "{{ config.global.xAbrevIns }}";

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>