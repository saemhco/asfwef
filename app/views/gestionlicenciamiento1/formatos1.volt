<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Formatos</li>
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
                    <div class="widget-body text-center" style="margin-bottom: -55px;">



                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-primary btn-block"><i class="fa fa-edit"></i></a>



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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Formatos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_formatos1" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 

                                        <th data-class="expand">Codigo</th>
                                        <th>Nombre</th>
                                        <th data-hide="phone,tablet">Archivos</th>
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
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="alerta_editar">
        <p>
            Usted no tiene permiso para realizar este proceso...
        </p>
    </div>
</div>
<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
    var idl = "";
//var distrito_id = '';
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

