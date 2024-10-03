<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Publicaciones</li><li>Postulantes</li>
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
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                <h2>Registro de Postulantes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_postulantes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>

                                                <th data-class="expand"> Grado Académico</th>
                                                <th> Postulante</th>
                                                <th data-hide="phone"> DNI</th>
                                                <th data-hide="phone"> Telefono</th>
                                                <th data-hide="phone">Email</th>
                                                <th data-hide="phone">CV</th>
                                                <th data-hide="phone"> Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>				
                                        </tbody>
                                    </table>
                                    <footer>
                                        <a href="javascript:history.back();" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>	

                                </div>		
                            </div>
                        </div>	
                    </article>	


                </div>
            </section>
        </div>			
    </div>	
</div>
<script type="text/javascript" >
    var idx = '{{ idwork }}';
</script>
<script type="text/javascript" > var region_id = "";
    var provincia_id = '';
    var publica = "no";
    var distrito_id = '';</script>
<script type="text/javascript" > var perfil = "{{ perfil }}"; var perfil_usuario = "{{ perfil_usuario }}"</script>