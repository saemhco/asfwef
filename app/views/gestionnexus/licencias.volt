<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Licencias</li>
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
                        <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

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
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de licencias</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12">
                                                <table id="tbl_licencias"
                                                    class="table tablecuriosity table-striped table-bordered table-hover"
                                                    width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center><i class="fa fa-check-circle"></i></center>
                                                            </th>
                                                            <th data-class="expand">Numero de Expediente</th>
                                                            <th data-hide="phone,tablet">Expediente numero de folios
                                                            </th>
                                                            <th data-hide="phone,tablet">Numero de documento</th>
                                                            <th data-hide="phone,tablet">Plaza</th>
                                                            <th data-hide="phone,tablet">Tipo</th>
                                                            <th data-hide="phone,tablet">Motivo</th>
                                                            <th data-hide="phone,tablet">Situacion</th>
                                                            <th data-hide="phone,tablet">Fecha Inicio</th>
                                                            <th data-hide="phone,tablet">Fecha Fin</th>
                                                            <th data-hide="phone,tablet">Dias</th>
                                                            <th data-hide="phone,tablet">Certificado</th>
                                                            <th data-hide="phone,tablet">resolucion</th>
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
                                        <a href="{{ url('gestionnexus') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
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

{{ form('gestionnexus/saveLicencias','method':
'post','id':'form_licencias','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-4">
            <label class="text-info">Tipo</label>
            <label class="select">
                <select id="input-id_tipo" name="id_tipo">
                    <option value="">SELECCIONE...</option>
                    {% for tiposlicencias_select in tiposlicencias %}

                    <option value="{{ tiposlicencias_select.codigo }}">{{ tiposlicencias_select.nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Motivo</label>
            <label class="select">
                <select id="input-id_motivo" name="id_motivo">
                    <option value="">SELECCIONE...</option>
                    {% for motivos_select in motivos %}

                    <option value="{{ motivos_select.codigo }}">{{ motivos_select.nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Situacion</label>
            <label class="select">
                <select id="input-id_situacion" name="id_situacion">
                    <option value="">SELECCIONE...</option>
                    {% for situaciones_select in situaciones %}

                    <option value="{{ situaciones_select.codigo }}">{{ situaciones_select.nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>


        <section class="col col-md-4">
            <label class="text-info">Numero de documento</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-id_nro_doc" name="id_nro_doc" placeholder="Numero de documento">
            </label>
        </section>


        <section class="col col-md-4">
            <label class="text-info">Nro. Plaza</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-id_plaza" name="id_plaza" placeholder="Numero de documento">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Resolucion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-resolucion" name="resolucion" placeholder="Resolucion">
            </label>
        </section>


        <section class="col col-md-4">
            <label class="text-info">Numero de Expediente</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-expediente_nro" name="expediente_nro" placeholder="Numero de Expediente">

                <input type="hidden" id="input-id_licencia" name="id_licencia" value="">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Expediente numero de folios</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-expediente_nro_folios" name="expediente_nro_folios"
                    placeholder="Expediente numero de folios">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Certificado</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-certificado" name="certificado" placeholder="Certificado">
            </label>
        </section>




        <section class="col col-md-4">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin" placeholder="Fecha Fin" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>



        <section class="col col-md-4">
            <label class="text-info">Dias</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-dias" name="dias" placeholder="Dias" readonly>
            </label>
        </section>




    </div>
</fieldset>
{{ endForm() }}

<script type="text/javascript"> var iddocumento = "{{ uglLicencias.id_nro_doc }}";</script>