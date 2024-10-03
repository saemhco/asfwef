<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Solicitudes</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1">
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
        <div class="col-sm-11">
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
                                <h2>Registro Solicitudes de Alumnos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_alumnos_solicitudes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand"> numero</th>
                                        <th> Tipo</th>
                                        <th data-hide="phone,tablet"> Mensaje</th>
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

{{ form('alumnossolicitudes/save','method': 'post','id':'form_alumnos_solicitudes','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info" >Numero</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input_numero" name="numero" placeholder="" value="" readonly="">
                <input type="hidden" id="semestre" name="semestre" value="{{ semestre }}">
                <input type="hidden" id="alumno" name="alumno" value="{{ alumno }}">
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Destinatario</label>
            <label class="select">
                <select id="input_area"  name="area">
                    <option value="" >SELECCIONE...</option>
                    {% for d in destinatario %}                                       
                        <option value="{{ d.id_area }}">{{ d.nombres }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Solicitud</label>
            <label class="select">
                <select id="input_tipo"  name="tipo">
                    <option value="" >SELECCIONE...</option>
                    {% for t_s_a in tipo_solicitud_alumno %}                                       
                        <option value="{{ t_s_a.codigo }}">{{ t_s_a.nombres }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
    </div>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Mensaje</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input_descripcion" name="descripcion" ></textarea>          
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