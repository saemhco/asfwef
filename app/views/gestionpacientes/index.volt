<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Gestion Pacientes</li>
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
                        <span class="widget-icon">Historia</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body text-center" style="margin-bottom: -55px !important;">
                        <a href="javascript:void(0);" onclick="historia();" class="btn btn-primary btn-block"><i
                                class="fa fa-table"></i></a>

                    </div>
                </div>
            </div>

            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
            data-widget-custombutton="false" data-widget-sortable="false">
            <header class="">
                <center style="margin-top: -5px !important;">
                    <span class="widget-icon">Atenciones</span>
                </center>
            </header>
            <div>
                <div class="jarviswidget-editbox">

                </div>
                <div class="widget-body text-center" style="margin-bottom: -55px !important;">
                    <a href="javascript:void(0);" onclick="atenciones();" class="btn btn-primary btn-block"><i
                            class="fa fa-table"></i></a>

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
                                <h2>Gestion Pacientes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_pacientes"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>


                                                <th data-hide="expand">Nro Documento</th>
                                                <th data-hide="phone,tablet">Apellidos y Nombres</th>


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

{{ form('registromedicamentos/save','method':
'post','id':'form_medicamentos','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Descripcion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-descripcion" name="descripcion"></textarea>
                <input type="hidden" name="id_medicamento" id="input-id_medicamento">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Concentracion</label>
            <label class="select">
                <select id="input-id_concentracion" name="id_concentracion">
                    <option value="">Seleccione</option>
                    {% for concentracion in concentraciones %}
                    <option value="{{ concentracion.codigo }}">{{ concentracion.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Forma</label>
            <label class="select">
                <select id="input-id_forma" name="id_forma">
                    <option value="">Seleccione</option>
                    {% for forma in formas %}
                    <option value="{{ forma.codigo }}">{{ forma.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

    </div>


</fieldset>
{{ endForm() }}