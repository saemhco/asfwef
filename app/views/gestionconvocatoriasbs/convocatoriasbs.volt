<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registro </li>
        <li>Convocatorias</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-12" style="">
            <table class="table table-sm table-primary table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">
                            <center>INFORMACIÓN DEL PROVEEDOR</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: #F7F7F7;">
                        <td>RUC:</td>
                        <td>Razon Social:</td>
                        <td>Ficha RUC:</td>
                        <td>RNP: </td>
                    </tr>
                    <tr style="background-color: rgb(250, 250, 250);">
                        <td width="15%">{{empresas.ruc}}</td>
                        <td width="65%">{{empresas.razon_social}}</td>
                        <td width="10%">
                            {% if empresas.archivo_ruc !== "" AND empresas.archivo_ruc !== null %}
                            Si
                            {% else %}
                            No
                            {% endif %}
                        </td>
                        <td width="10%">
                            {% if empresas.archivo_rnp !== ""   AND empresas.archivo_rnp !== null %}
                            Si
                            {% else %}
                            No
                            {% endif %}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="col-sm-12" style="">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Convocatorias</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_convocatorias"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand"> Fecha</th>
                                                <th>Convocatoria</th>
                                                <th data-hide="phone,tablet"> Codigo</th>
                                                <th data-hide="phone,tablet">Perfil</th>
                                                <th data-hide="phone,tablet"> Acciones</th>
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

{{ form('gestionconvocatoriasbs/saveConvocatorias','method':
'post','id':'form_convocatorias','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-primary table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <center><strong id="input-convocatorias_titular_text"></strong></center>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;text-align: center;" width="20%"><strong
                                    id="input-convocatoria_perfiles_codigo_text"></strong></td>
                            <td style="vertical-align: middle;text-align: center;"><strong
                                    id="input-convocatoria_perfiles_nombre_text"></strong></td>
                            <td style="vertical-align: middle;text-align: center;" width="25%">
                                <div class="form-group">

                                    <a href="" class="btn btn-warning btn-xs" download
                                        id="input-convocatorias_archivo"><i class="fa fa-download"></i> Descargar
                                        Anexos</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="input-convocatorias_titulo" name="convocatorias_titulo" value="">
                <input type="hidden" id="input-convocatoria_perfiles_codigo" name="convocatoria_perfiles_codigo"
                    value="">
                <input type="hidden" id="input-convocatoria_perfiles_nombre" name="convocatoria_perfiles_nombre"
                    value="">

                <input type="hidden" id="input-id_empresa" name="id_empresa" value="{{ empresas.id_empresa }}">
                <input type="hidden" id="input-convocatoria" name="id_convocatoria_bs" value="">
                <input type="hidden" id="input-perfil" name="id_convocatoria_bs_perfil" value="">


                <input type="hidden" id="input-fecha_inicio" value="">
                <input type="hidden" id="input-fecha_fin" value="">

            </div>
        </section>
        <section class="col col-md-4">
        </section>
        <section class="col col-md-3">

        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Adjuntar Anexos</label>
            <div class="input input-file" id="input-anexos">

                <span class="button"><input id="file-archivo" type="file" name="archivo"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                        class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"
                    placeholder="Agregar Archivo" readonly="">

            </div>
        </section>
        <section class="col col-md-12">
            <h5>
                <p style="text-align:justify;color:black;font-size: 11px;">Nota: Antes de <strong>confirmar su
                    propuesta</strong>, asegúrese de haber registrado y acreditado sus datos correctamente (Datos de la Empresa, Ficha RUC y RNP), a fin de evitar ser descalificado de la presente convocatoria de Bienes y Servicios.</p>
            </h5>
        </section>

    </div>
</fieldset>
{{ endForm() }}
