<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Agendas</li>
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
                                <h2>Registro de Agendas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
 
                                    <table id="tbl_web_agenda"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-hide="phone,tablet">Fecha</th>
                                                <th data-hide="phone,tablet">Hora</th>
                                                <th data-hide="phone,tablet">Descripcion</th>
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

{{ form('registroagendas/save','method': 'post','id':'form_agendas','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Descripcion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-descripcion" name="descripcion"></textarea>
                <input type="hidden" id="input-id_agenda" name="id_agenda" value="">
            </label>
        </section>

        <section class="col col-md-6" >
            <label class="text-info" >Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora" name="fecha_hora" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="" autocomplete="off">
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info" >Hora Inicio (HH:MM:SS)</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                    <input type="text" id="input-hora" name="hora" placeholder="Hora" value="">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}