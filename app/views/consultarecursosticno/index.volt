<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Recursos TIC no asignados</li>
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Consulta de Recursos TIC no asignados</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										
                                    <div class="widget-body-toolbar">
                                        <div class="row">
                                            <div class="col-sm-6 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_pdf();"
                                                    class="btn bg-color-magenta txt-color-white"><i
                                                        class="fa fa-file-pdf-o"></i>
                                                    &nbsp;Reporte
                                                </a>
                                            </div>
                                            <div class="col-sm-6 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_xls()"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    &nbsp;Exportar
                                                </a>
                                            </div>
                                        </div>
                                    </div>	
                                    <table id="tbl_recursos_tic_no" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                              

                                        <th data-class="expand">Tipo</th>
                                        <th>Patrimonial</th>
                                        <th data-hide="phone,tablet">Marca</th>
                                        <th data-hide="phone,tablet">Modelo</th>
                                        <th data-hide="phone,tablet">Serie</th>
                                        <th data-hide="phone,tablet">Color</th>
                                        <th data-hide="phone,tablet">MAC</th>
                                        <th data-hide="phone,tablet">Características</th>
                                        <th data-hide="phone,tablet">Observaciones</th>                                        
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

{{ form('','method': 'post','id':'form_reporte_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="reporte_consultarecursosticno_pdf()" id="reporte_consultarecursosticno_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Recursos Informaticos No Aisgnados</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'form_reporte_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
                onclick="reporte_consultarecursosticno_xls()" id="reporte_consultarecursosticno_xls"><i
                    class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Recursos Informaticos No Aisgnados</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
    var idl = "";
//var distrito_id = '';
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

