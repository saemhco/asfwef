<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Solicitudes</li><li>Becas de Alumnos</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12">
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
                                <h2>Lista de Solicitudes de Becas de Alumnos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_registrosolicitudesalumnosbecas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 
                                        <th data-class="expand">Fecha</th>
                                        <th data-hide="phone,tablet">Código</th>
                                        <th data-hide="phone,tablet">Alumno</th>
                                        <th data-hide="phone,tablet">Solicitud</th>
                                        <th data-hide="phone,tablet">Mensaje</th>
                                        <th data-hide="phone,tablet"> Archivo</th>
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
<script type="text/javascript" > var region_id = "";
    var provincia_id = '';
    var publica = "no";
    var distrito_id = '';</script>
<script type="text/javascript" > var perfil = "{{ perfil }}"</script>