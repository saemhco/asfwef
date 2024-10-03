<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets"   rel="tooltip" data-placement="bottom" data-original-title="" data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion de Horarios</li>
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
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>GESTION DE HORARIOS - SEMESTRE {{ semestre.descripcion }}</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	
                                    <br>
                                    <div class="table-responsive">
                                        <row>
                                            <table id="tbl_asignaturas" class="table table-responsive table-bordered">
                                                <thead>			                
                                                    <tr>
                                                        <th width="12%"  ><center><i class="fa fa-list-alt"></i></center></th> 
                                                        <th width="68%" style="vertical-align: middle;text-align: center;">DESCRIPCION</th>  
                                                        <th width="20%" style="vertical-align: middle;text-align: center;">HORARIO</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                        <tr>

                                                            <td style="vertical-align: middle;text-align: center;">
                                                                1
                                                            </td>
                                                            <td>
                                                                AMBIENTES
                                                            </td>
                                                            <td style="vertical-align: middle;text-align: center;">
                                                                <a style="margin-bottom: 6px;" href="gestionhorarios/ambientes"><span class='label label-warning' style='white-space: normal !important;font-size:90% !important;'>&nbsp;&nbsp;&nbsp;&nbsp;AMBIENTES&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                                                            </td>

                                                        </tr>
                                                        <tr>

                                                            <td style="vertical-align: middle;text-align: center;">
                                                                2
                                                            </td>
                                                            <td>
                                                                DOCENTES
                                                            </td>
                                                            <td style="vertical-align: middle;text-align: center;">
                                                                <a style="margin-bottom: 6px;" href="gestionhorarios/docentes"><span class='label label-warning' style='white-space: normal !important;font-size:90% !important;'>&nbsp;&nbsp;&nbsp;&nbsp;DOCENTES&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
                                                            </td>

                                                        </tr>
                                                        <tr>

                                                            <td style="vertical-align: middle;text-align: center;">
                                                                3
                                                            </td>
                                                            <td>
                                                                ASIGNATURAS
                                                            </td>
                                                            <td style="vertical-align: middle;text-align: center;">
                                                                <a style="margin-bottom: 6px;" href="gestionhorarios/asignaturas"><span class='label label-warning' style='white-space: normal !important;font-size:90% !important;'>&nbsp;ASIGNATURAS&nbsp;</span></a>
                                                            </td>

                                                        </tr>

                                                </tbody>
                                            </table>
                                        <row>
                                    </div>
                                    <br>
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
