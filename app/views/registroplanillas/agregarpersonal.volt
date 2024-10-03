<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Gestion Planillas</li>
        <li>Agregar Personal</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">


        <div class="col-md-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false"
                            data-widget-editbutton="false" data-widget-togglebutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false">

                            <header>
                                <h2><strong>AGREGAR PERSONAL </strong></h2>
                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">


                                    <div class="widget-body-toolbar">
                                      
                                            
                                                <table class="table table-sm table-primary table-bordered"
                                                style="font-size: 10px !important;margin-bottom:0px !important;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3">
                                                            <center>PLANILLA</center>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="font-size: 12px !important;">
                                                        <td><strong>PLANILLA: {{ planilla.numero }}</strong></td>
                                                        <td><strong>TIPO: {{ tipoplanilla.nombre }}</strong> </td>
                                                        <td><strong>PERIODO: {{ periodo.periodo }}</strong>
                                                            <input type="hidden" name="ciclo_alumno" value="{{ ciclo }}">
        
                                                            <input type="hidden" name="semestre" value="{{ semestre.codigo }}">
                                                        </td>
        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        

                                    </div>
                                    <br>

                                    <center>
                                        <button style="margin-bottom:9px !important;" type="button"
                                            class="btn btn-info btn-xs" onclick="modalCont()">
                                            AGREGAR PERSONAL
                                        </button>
                                    </center>

                                    <table id="tbl_planillas_personal"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Nombres</th>
                                                <th width="10%">Dias Trab.</th>
                                                <th width="10%">Reg.Pensiones</th>
                                                <th width="10%">Meta</th>
                                                <th width="10%">Inasistencia(S/)</th>
                                                <th width="10%">Tardanza(S/)</th>
                                                <th width="10%">Judicial(S/)</th>
                                                <th width="8%" data-hide="phone,tablet">Acciones</th>
                                                <th width="8%">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <footer>
                                        <a href="{{ url('registroplanillas') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>


<div id="modalcont" aria-hidden="true" class="modal fade" role="dialog" tabindex="-1"
    aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px !important;">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><span>&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">BUSQUEDA DE PERSONAL</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false" data-widget-colorbutton="false"
                    data-widget-custombutton="false" data-widget-sortable="false" data-widget-togglebutton="false"
                    style="margin: 0 0 0px !important;">

                    <header class="hidden">

                        <h2>BUSQUEDA DE PERSONAL</h2>


                    </header>

                    <div>
                        <div class="jarviswidget-editbox">
                            <input class="form-control" type="text">
                        </div>
                        <div class="widget-body no-padding">

                            <table id="tbl_planillas_cont"
                                class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                        </th>
                                        <th data-class="expand">Nombres</th>
                                        <th>Área</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="padding: 8px !important;">

                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var anio = "{{ anio_select }}";
    var codigo = "{{ id }}";

    var regimens_object = [];

    {% for regimen in regimens %}

    regimens_object.push({ codigo: "{{ regimen.codigo }}", nombre: "{{ regimen.nombre }}", regimen: "{{ regimen.regimen }}" });
    {% endfor %}
    console.log(regimens_object);


    var metas_object = [];

    {% for meta in metas %}

    metas_object.push({ codigo: "{{ meta.sec_func }}", nombre: "{{ meta.sec_func }}" });
    {% endfor %}
    console.log(metas_object);
</script>