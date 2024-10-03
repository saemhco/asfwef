<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Mantenimiento de Estudiantes</li>
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
                        <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"
                            data-proceso="REGISTRAR_PROCESO"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>
                        {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i
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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Estudiantes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    <div class="widget-body-toolbar">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <a href="javascript:void(0);" onclick="reportes()"
                                                    class="btn bg-color-magenta txt-color-white"><i
                                                        class="fa fa-file-pdf-o"></i>
                                                    &nbsp;Reportes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="tbl_alumnos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Código</th>
                                                <th>Programa de estudios</th>
                                                <th>Apellidos y Nombres</th>
                                                <th data-hide="phone,tablet">Nro. Doc.</th>
                                                <th data-hide="phone,tablet">Celular</th>
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
{{ form('','method': 'post','id':'form_reportes','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12" style="margin-top: -5px;">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="certificado_estudio()" id="certificado_estudio"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Certificado de Estudios</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="certificado_estudio_2()" id="certificado_estudio_2"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Certificado de
                Estudios 2</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="record_academico()" id="record_academico"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Record Académico</a>
        </section>

        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="revision_curricular()" id="revision_curricular"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Revisión Curricular</a>
        </section>

        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="file()" id="file"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;File</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="constancia_matricula()" id="constancia_matricula"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Constancia de Matricula</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="constancia_egresado()" id="constancia_egresado"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Constancia de Egresado</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="constancia_extracurricular()" id="constancia_extracurricular"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Constancia de Extracurricular</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="constancia_cien()" id="constancia_cien"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Constancia 100%</a>
        </section>
        <section class="col col-md-12" style="margin-bottom: 5px;">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);" onclick="cv();">
                <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;CV</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}
<script type="text/javascript">
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

    //Lugar de procedencia
    var region1_id = "";
    var provincia1_id = '';
    var distrito1_id = '';

    var publica = "no";

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>