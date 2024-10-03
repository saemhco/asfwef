<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Documentos</li>
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

                        <a href="{{ url('registrotramitedocumentario/registro/'~id_personal_area_remitente) }}"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

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
                            data-widget-colorbutton="false" data-widget-custombutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Documentos</h2>
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


                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12">
                                                <table id="tbl_documentos"
                                                    class="table tablecuriosity table-striped table-bordered table-hover"
                                                    width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center><i class="fa fa-check-circle"></i></center>
                                                            </th>
                                                            <th data-class="expand">Fecha Envio</th>


                                                            <th data-class="phone,tablet">Fecha Cargo</th>
                                                            <th data-hide="phone,tablet">Tipo Documento</th>
                                                            <th data-hide="phone,tablet">Documento</th>
                                                            <th data-hide="phone,tablet">Asunto</th>
                                                            <th data-hide="phone,tablet">Destinatario</th>
                                                            <th data-hide="phone,tablet">Archivos</th>
                                                            <th data-hide="phone,tablet">Detalles</th>
                                                            <th data-hide="phone,tablet">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div>
                                    </fieldset>

                                    <footer>
                                        <a href="javascript:history.back()" role="button"
                                            class="btn tbn-block btn-primary"><i
                                                class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>


                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>


{{ form('registrotramitedocumentario/saveDocumentosDetalles','method':
'post','id':'form_documento_detalle','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>

    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Link Drive</label>
            <label class="input" id="input-link"> 
                <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-link_drive" name="link_drive" placeholder="Link Drive" >
                <input type="hidden" id="input-id_doc_detalle" name="id_doc_detalle" value="">
                <input type="hidden" id="input-id_doc" name="id_doc" value="">
                <input type="hidden" id="input-id_personal_area_d" name="id_personal_area" value="">
                <input type="hidden" id="input-fecha_envio" name="fecha_envio" value="">


            </label>
        </section>

        
        <section class="col col-md-12">

            <label class="text-info">Agregar Archivo</label>
            <div class="input input-file" id="input-archivo">

                <span class="button"><input id="file-archivo" type="file" name="archivo_documentosdetalle"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                        class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"
                    placeholder="Agregar Archivo" readonly="">

            </div>

        </section>


    </div>
</fieldset>
{{ endForm() }}

<!-- modal reporte pdf-->
{{ form('','method': 'post','id':'form_reporte_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
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
                onclick="reporte_gestiontramitedocumentario_pdf()" id="reporte_librosprestamos_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de documentos</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}


<!-- modal reporte xls-->
{{ form('','method': 'post','id':'form_reporte_xls','class':'smart-form','style':'display:none;') }}
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
                onclick="reporte_gestiontramitedocumentario_xls()" id="reporte_librosprestamos_xls"><i
                    class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de documentos</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}


<script type="text/javascript">

    var publica = "no";
    var idl = "";

    var id_personal_area_remitente = "{{ id_personal_area_remitente }}";

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>