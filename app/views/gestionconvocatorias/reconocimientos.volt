<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Puiblico Reconocimientos</li>
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

                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Reconocimientos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_web_publico_reconocimientos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha</th>
                                                <th>Publico</th>
                                                <th data-hide="phone,tablet">Nombre</th>
                                                <th data-hide="phone,tablet">Institucion</th>
                                                <th data-hide="phone,tablet">Pais</th>
                                                <th data-hide="phone,tablet">Archivo</th>
                                                <th data-hide="phone,tablet">Estado</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <footer>
                                        <a href="javascript:history.back();" role="button"
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

{{ form('gestionconvocatorias/saveReconocimientos','method':
'post','id':'form_tbl_web_publico_reconocimientos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info">Tipo de Reconocimientos</label>
            <label class="select">
                <select id="input-id_tipo_reconocimiento" name="id_tipo_reconocimiento">
                    <option value="">SELECCIONE...</option>
                    {% for tiporeconocimiento in tiporeconocimientos %}
                    <option value="{{ tiporeconocimiento.codigo }}">{{ tiporeconocimiento.nombres }} </option>
                    {% endfor %}
                </select> <i></i>
                <input type="hidden" id="input-codigo" name="codigo" value="">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Fecha Reconocimiento</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_reconocimiento" name="fecha_reconocimiento"
                    placeholder="Fecha Reconocimiento" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Nombre</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="">
            </label>
        </section>

    </div>
    <div class="row">

        <section class="col col-md-9">
            <label class="text-info">Institución</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-institucion" name="institucion" placeholder="Institución" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Pais</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-pais" name="pais" placeholder="Pais" value="">
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-6">

            <label class="text-info">Agregar Archivo (Documento que acredita la experiencia profesional)</label>
            <div class="input input-file" id="input-archivo">

                <span class="button"><input id="file-archivo" type="file" name="archivo_reconocimientos"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                        class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"
                    placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

            </div>

        </section>
    </div>

</fieldset>
{{ endForm() }}

<script type="text/javascript">
    var publica = "no";
</script>