<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Libros Adquisiciones</li>
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
                                <h2>Registro de Libros Adquisiciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    <table id="tbl_libros_adquisiciones"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Fecha</th>
                                                <th data-hide="phone,tablet">Descripción</th>
                                                <th data-hide="phone,tablet">Número</th>
                                                <th data-hide="phone,tablet">Precio</th>
                                                <th data-hide="phone,tablet">Observaciones</th>
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

{{ form('registrolibrosadquisiciones/save','method':
'post','id':'form_libros_adquisiciones','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        
        <section class="col col-md-6">
            <label class="text-info">Tipo</label>
            <label class="select">
                <select id="input-tipo" name="tipo">
                    <option value="">SELECCIONE...</option>
                    {% for origen_select in origen %}

                    <option value="{{ origen_select.codigo }}">{{origen_select.nombres}}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Adquisición</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_adquisicion" name="fecha_adquisicion" placeholder="Fecha Adquisición"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Numero Orden de Compra</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-numero_oc" name="numero_oc" placeholder="">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Precio</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-precio" name="precio" placeholder="">
            </label>
        </section>

        
        <section class="col col-md-12">
            <label class="text-info">Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-descripcion" name="descripcion"></textarea>
                <input type="hidden" id="input-id_adquisicion" name="id_adquisicion" value="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-observaciones" name="observaciones"></textarea>
            </label>
        </section>

    </div>
</fieldset>
{{ endForm() }}