
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Lista de libros Prestados</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <!--
   <div class="col-sm-1">
       
  
       
       <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
           <header class="">
               <center>
                   <span class="widget-icon"> <i class="fa fa-hand-o-up"></i> </span>
               </center>
           </header>
           <div>
               <div class="jarviswidget-editbox">								

               </div>
               <div class="widget-body text-center">
                   <a href="{{ url('listaprestamos/registro') }}"  class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                   <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
        {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

    </div>
</div>
</div>
        
        
    

</div>
        -->
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
                                <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                <h2>Registro de Prestamos que se realizaron</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_listaprestamos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand"> Lector</th>
                                        <th> Apellido Peterno</th>
                                        <th> Código </th>
                                        <th> Tipo </th>

                                        <th data-hide="phone,tablet"> Fecha - Prestamo </th>
                                        <th data-hide="phone,tablet"> Fecha Devolución </th>
                                        <th data-hide="phone,tablet"> Fecha Devolución Confirmada </th>
                                        <th data-hide="phone,tablet"> Acciones </th>

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
                <h5 class="modal-title" id="exampleModalLabel">Lista de Libros Prestados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="tbl_libros">
                    <thead>
                        <tr>
                            <th>Nombres de libros</th>

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