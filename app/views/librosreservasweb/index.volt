<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Solicitud de Libros Web</li>
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Solicitudes de Libros Web</h2>

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
                                    </div>

                                    <table id="tbl_prestamos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-hide="phone,tablet">TIPO</th>
                                                <th>CÓDIGO</th>
                                                <th data-class="expand">LECTOR</th>
                                                <th data-hide="phone,tablet">FECHA RESERVA</th>
                                                <th data-hide="phone,tablet">ACCIONES</th>

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

<!--Modal ver-->
<div class="modal fade" id="modalver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Libros Reservados</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre del libro:</th>
                                <th>Ejemplar N°</th>

                            </tr>
                        </thead>
                        <tbody id="tbody_libros">

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-times'></i>&nbsp;
                    Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--fin-->

<!-- modal confirmar -->
{{ form('librosreservasweb/confirma','method': 'post','id':'form_confirmar','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Fecha devolucion</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_devolucion" name="fecha_devolucion" placeholder="" class="datepicker"
                    data-dateformat='dd/mm/yy' value="">
                <input type="hidden" name="prestamo" id="prestamo">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}
<!--fin-->

<!-- modal rechazar -->
{{ form('librosreservasweb/rechazar','method': 'post','id':'form_rechazar','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Observacion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observacion" name="observacion"></textarea>
                <input type="hidden" name="prestamo_rechazado" id="prestamo_rechazado">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}
<!--fin-->

{{ form('','method': 'post','id':'form_reporte_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_pdf" name="fecha_inicio" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
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
                onclick="reporte_librosreservasweb_pdf()" id="reporte_librosreservasweb_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de solicitudes de libros web</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<!-- modal reporte -->
{{ form('','method': 'post','id':'form_reporte_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_xls" name="fecha_inicio" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
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
                onclick="reporte_librosreservasweb_xls()" id="reporte_librosreservasweb_xls"><i
                    class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de solicitudes de libros web</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}