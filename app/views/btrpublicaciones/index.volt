<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Publicaciones</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        {% if perfil_usuario == 'ADMINISTRADOR DEL SISTEMA' or perfil_usuario == 'BOLSA DE TRABAJO'%}
        <div class="col-sm-12" style="margin-bottom: -30px;">
            {% else %}
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
                            <a href="{{ url('btrpublicaciones/registro') }}" class="btn btn-primary btn-block"><i
                                    class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i
                                    class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i
                                    class="fa fa-trash"></i></a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-11">
                {% endif %}


                <section id="widget-grid" class="">
                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                                data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                data-widget-colorbutton="false" data-widget-custombutton="false"
                                data-widget-sortable="false" data-widget-togglebutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                    <h2>Registro de Publicaciones</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="widget-body no-padding">
                                        <div class="widget-body-toolbar">
                                            <div class="row">
                                                <div class="col-sm-6 text-center">
                                                    <a href="javascript:void(0);" onclick="reportes()"
                                                        class="btn bg-color-magenta txt-color-white"><i
                                                            class="fa fa-file-pdf-o"></i>
                                                        &nbsp;Reportes
                                                    </a>
                                                </div>
                                                <div class="col-sm-6 text-center">
                                                    <a href="javascript:void(0);" onclick="exportar()"
                                                        class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                        &nbsp;Exportar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="tbl_publicaciones"
                                            class="table tablecuriosity table-striped table-bordered table-hover"
                                            width="100%">
                                            <thead>
                                                <tr>

                                                    {% if perfil_usuario == 'ADMINISTRADOR DEL SISTEMA' or perfil_usuario == 'BOLSA DE TRABAJO'%}

                                                    {% else %}
                                                    <th>
                                                        <center><i class="fa fa-check-circle"></i></center>
                                                    </th>
                                                    {% endif %}


                                                    <th> Titulo</th>
                                                    <th> Region</th>
                                                    <th> Distrito</th>
                                                    <th data-hide="phone,tablet"> Cargo</th>
                                                    {# <th data-hide="tablet"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Tipo Contrato</th>
                                                 <th data-hide="tablet"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Jornada</th>
                                                 #}
                                                    {#<th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Fecha Creacion</th>#}
                                                    <th data-hide="phone,tablet"> Fecha Creacion</th>
                                                    <th data-hide="phone,tablet"> Fecha Clausura</th>
                                                    <th data-hide="phone,tablet">N° Postulantes</th>
                                                    <th data-hide="phone,tablet">N° Visitas</th>

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
    {{ form('','method': 'post','id':'form_reportes','class':'smart-form','style':'display:none;') }}
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
                    onclick="reporte_btrpublicaciones_pdf()" id="reporte_btrpublicaciones_pdf"><i
                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Publicaciones de bolsa de Trabajo</a>
            </section>
            <section class="col col-md-12">
                <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                    onclick="reporte_btrpublicaciones_postulantes_pdf()" id="reporte_btrpublicaciones_postulantes_pdf"><i
                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Postulantes a la oferta Laboral</a>
            </section>
        </div>
    </fieldset>
    {{ endForm() }}
    {{ form('','method': 'post','id':'form_reportes_xls','class':'smart-form','style':'display:none;') }}
    <fieldset>
        <div class="row">
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
                    onclick="reporte_btrpublicaciones_xls()" id="reporte_btrpublicaciones"><i
                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Publicaciones de bolsa de Trabajo</a>
            </section>
            <section class="col col-md-12">
                <a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
                    onclick="reporte_btrpublicaciones_postulantes_xls()" id="reporte_btrpublicaciones_postulantes"><i
                        class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Postulantes a la oferta Laboral</a>
            </section>
        </div>
    </fieldset>
    {{ endForm() }}
    <script type="text/javascript"> var region_id = "";
        var provincia_id = '';
        var publica = "no";
        var distrito_id = '';</script>
    <script type="text/javascript"> var perfil = "{{ perfil }}"; var perfil_usuario = "{{ perfil_usuario }}";</script>