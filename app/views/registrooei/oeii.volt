<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Indicadores o.e.i</li>
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


                        <a href="{{ url('registrooei/registrooeii') }}" class="btn btn-primary btn-block"><i
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
                            data-widget-colorbutton="false" data-widget-custombutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Indicadores o.e.i</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_registrooeii"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Codigo</th>
                                                <th>Año</th>
                                                <th>Obejtivo ei</th>
                                                <th>Nombre</th>
                                                <th data-hide="phone,tablet">Descripcion</th>
                                                <th data-hide="phone,tablet">Estado</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <a role="button" href="javascript:history.back()"
                                    class="btn btn-primary  btn-md"><i
                                        class="fa fa-arrow-left"></i> Volver </a>
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

    var id_objetivo_ei = "{{id_objetivo_ei}}";

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>