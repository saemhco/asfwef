<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Medios Verificacion</li>
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


                        <a href="{{ url('licenciamiento1/registrom') }}" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>


                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Medios de Verificación</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_medios"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Indicador</th>
                                                <th>Codigo</th>
                                                <th data-hide="phone,tablet">Medio verificacion</th>
                                                <th data-hide="phone,tablet">Requisitos</th>
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
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="archivo_no_existe">
        <p>
            Archivo no existe...
        </p>
    </div>
</div>
<script type="text/javascript">
    //var region_id = "";
    //var provincia_id = '';
    var publica = "no";
    var idl = "";
//var distrito_id = '';
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>