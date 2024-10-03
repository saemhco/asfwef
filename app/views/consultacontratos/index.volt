<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Contratos</li>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Lista de Personal</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										
                                    <table id="tbl_actividades" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 
                                        <th data-class="expand">Personal</th>
                                        <th data-hide="phone,tablet">Contratos</th>
                                      
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
{{ form('','method': 'post','id':'form_reporte_actividades_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12" {#style="margin-bottom: 60px;"#}>
            <label class="text-info" >Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">
                <input type="hidden" id="input-id_personal" name="id_personal" value="">
            </label>
        </section>
        <section class="col col-md-12" {#style="margin-bottom: 60px;"#}>
            <label class="text-info" >Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
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

