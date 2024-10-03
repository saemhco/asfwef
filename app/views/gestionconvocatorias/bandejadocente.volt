{% set txt_buton = "Registrar Voucher" %}
<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro</li><li>Voucher</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center" style="margin-bottom: -55px !important;">
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Voucher</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_registrovoucherdocente" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th data-class="expand">Convocatoria</th>
                                                <th data-class="expand">Fecha</th>
                                                <th data-hide="phone,tablet">Codigo</th>
                                                <th data-hide="phone,tablet">Docente</th>
                                                <th data-hide="phone,tablet">Archivo</th>
                                                <th data-hide="phone,tablet">Fecha Atencion</th>
                                                <th data-hide="phone,tablet">Mensaje</th>
                                                <th data-hide="phone,tablet">Estado</th>
                                                <th data-hide="phone,tablet">Documento</th>

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

{{ form('gestionconvocatorias/saveGrabarVoucher','method': 'post','id':'form_voucher_docente','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Convocatoria</label>
                <label class="select">
                    <select id="input_tipo"  name="tipo">
                        {% for t_s_a in tabla_convocatoria %}
                            <option value="{{ t_s_a.id_convocatoria }}">{{ t_s_a.titulo }}</option>
                        {% endfor %}
                    </select> <i></i>
                </label>
        </section>
    </div>

    <div class="row">
       <section class="col col-md-12">
            <label class="text-info" >Archivo</label>
            <div class="input input-file">
                <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input_file" name="input_file"  placeholder="Agregar Archivo" readonly="">
            </div>
        </section>
    </div>
</fieldset>
<footer>
    <input type="hidden" id="idcodigo" name="idcodigo" value="{{ idcodigo }}">
    <button id="publicar" type="button" class="btn btn-primary">
        {{ txt_buton }}
    </button>
</footer>
{{ endForm() }}
<div class="modal fade" id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Content" rows="5" readonly="" id="descripcion"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-times'></i>&nbsp;
                    Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->