<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Solicitud de Prestamos Web</li>
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
                                <span class="widget-icon"> <i class="fa fa-globe"></i> </span>
                                <h2>Registro de Solicitudes de  Prestamos en la  Web</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">                                        

                                    <table id="tbl_prestamos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>                         
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand">LECTOR</th>
                                        <th>APELLIDO PATERNO</th>
                                        <th>CÓDIGO</th>
                                        <th data-hide="phone,tablet">TIPO</th>
                                        <th data-hide="phone,tablet">FEHCA SOLICITUD PRESTAMO</th>
                                        <th data-hide="phone,tablet">ACCIONES</th>

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




<!-- Modal -->
<div class="modal fade" id="modalver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Libro Prestado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre del libro:</th>

                        </tr>
                    </thead>
                    <tbody id="tbody_libros">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalfecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Fecha de Devolución</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Fecha:</label>
                        <input type="text" id="input-fecha_devolucion" name="fecha_devolucion" placeholder="Fecha devolucion" class="form-control datepicker" data-dateformat='dd/mm/yy' value="">
                        <input type="hidden" name="prestamo_id" id="prestamo_id">
                    </div>
                </form>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="grabar_fecha();">Grabar</button>
            </div>
        </div>
    </div>
</div>