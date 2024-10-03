<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Visistas</li>
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


                        <a href="{{ url('registrovisitas/registro') }}" class="btn btn-primary btn-block"><i
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
                                <h2>Registro de Visitas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_web_visitas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha Visita</th>
                                                <th data-hide="phone,tablet">Hora Ingreso</th>
                                                <th data-hide="phone,tablet">Hora Salida</th>
                                                <th data-hide="phone,tablet">Visitante</th>
                                                <th data-hide="phone,tablet">Area</th>
                                                <th data-hide="phone,tablet">Personal</th>
                                                <th data-hide="phone,tablet">Motivo</th>
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


{{ form('registrovisitas/saveHoraSalida','method':
'post','id':'form_hora_salida','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Hora Salida</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-hora_salida" name="hora_salida" placeholder="Hora Salida" value="">
                <input type="hidden" id="input-id_visita" name="id_visita" value="">

            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}






<script type="text/javascript">
    var id_sede = '{{ id_sede }}';
    var id_lugar = '{{ id_lugar }}';
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>