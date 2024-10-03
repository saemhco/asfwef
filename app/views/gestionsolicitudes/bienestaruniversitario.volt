<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Bienestar Universitario</li>
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
                                <h2>Registro Bienestar Universitario</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_dbu_solicitud_servicios" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand"> Fecha</th>
                                        <th data-hide="phone,tablet"> Servicio</th>                                        
                                        <th data-hide="phone,tablet"> Mensaje</th>
                                        <th data-hide="phone,tablet"> Archivo</th>
                                        <th data-hide="phone,tablet"> Estado</th>

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

{{ form('gestionsolicitudes/savebienestaruniversitario','method': 'post','id':'form_bienestaruniversitario','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Servicios</label>
            <label class="select">
                <select id="id_servicio"  name="id_servicio">
                    <option value="" >SELECCIONE...</option>
                    {% for servicios_select in servicios %}                                       
                        <option value="{{ servicios_select.id_servicio }}">{{ servicios_select.titular }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
    </div>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Mensaje</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="asunto" name="asunto" ></textarea>  
                <input type="hidden" id="id_solicitud_servicio" name="id_solicitud_servicio" value="">
                <input type="hidden" id="semestre" name="id_semestre" value="{{ semestre }}">
                <input type="hidden" id="alumno" name="id_alumno" value="{{ alumno }}">
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
                            <textarea class="form-control" placeholder="Content" rows="5" readonly="" id="asunto"></textarea>
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