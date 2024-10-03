<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro de Admisión Proceso</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de admisión proceso (Datos Postulante) </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_admision" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             

                                        <th data-class="expand">CÓDIGO</th>
                                        <th>NRO. DOC</th>
                                        <th data-hide="phone,tablet">APELLIDO PATERNO</th>
                                        <th data-hide="phone,tablet">APELLIDO MATERNO</th>
                                        <th data-hide="phone,tablet">NOMBRES</th> 
                                        <th data-hide="phone,tablet">TIPO DE COLEGIO</th>
                                        <th data-hide="phone,tablet">NOMBRE DE COLEGIO</th>
                                        <th data-hide="phone,tablet">FICHA</th>
                                        <th data-hide="phone,tablet">VOUCHER</th>


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
            Opcion no disponible
        </p>
    </div>
</div>
<script type="text/javascript" >
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

    //Lugar de procedencia
    var region1_id = "";
    var provincia1_id = '';
    var distrito1_id = '';

    var publica = "no";
    
    

</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

