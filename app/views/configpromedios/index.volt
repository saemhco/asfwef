<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Configuracion de Fórmulas y Promedios por Asignaturas</li>
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
                                <span class="widget-icon"> <i class="fa fa-user-plus"></i> </span>
                                <h2>Datos de la Asignatura </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      

                                <div class="table-responsive">
                                    <table class="table table-sm table-primary table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="15%">
                                        <center>CÓDIGO</center>
                                        </th>
                                        <th><center>ASIGNATURA</center></th>
                                        <th width="8%"><center>CICLO</center></th>
                                        <th width="10%"><center>CREDITOS</center></th>
                                        <th width="8%"><center>TIPO</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="codigo">{{ codigo }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="asignatura">{{ asignatura }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="ciclo">{{ ciclo }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="creditos">{{ creditos }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="tipo">{{ tipo_asignatura }}</strong></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>  
                    </article>  
                </div>
            </section>
        </div>
     
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
                                <h2>Grupos de la Asignatura</h2>
                            </header>

                            <div>
                                <br>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">                                        
                                    <table id="tbl_asignaturasofertadas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>                         
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             




                                        <th data-class="expand">GRUPO</th>
                                       
                                        
                                        <th data-hide="phone,tablet">Configurar Formula</th>

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
                <a href="{{ url('gestionasignaturas') }}" role="button" class="btn tbn-block btn-default" ><i class="fa fa-chevron-left" ></i> Regresar</a>
            </section>
        </div>          
    </div>  
</div>
<div class="hidden">
    <div id="save_asignaturasofertadas">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript" >
    var perfil = "{{ perfil }}";
    var codigo = "{{ codigo }}";
    var semestre = "{{ semestre }}";
</script>

