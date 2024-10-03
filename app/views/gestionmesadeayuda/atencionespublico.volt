<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Atenciones Público</li>
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
                    <div class="widget-body text-center" style="margin-bottom: -55px !important;">



                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Atenciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_atencionespublico" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             
                                        <th data-class="expand">Tipo de Atención</th>                               
                                        <th data-hide="phone,tablet">Prioridad</th> 
                                        <th data-hide="phone,tablet">Fecha Recepción</th> 
                                        <th data-hide="phone,tablet">Hora Recepción</th>      
                                        <th data-hide="phone,tablet">Fecha Prevista</th>
                                        <th data-hide="phone,tablet">Fecha Termino</th>
                                        <th data-hide="phone,tablet">Solucion</th>
                                        <th data-hide="phone,tablet">Proceso</th>
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

{{ form('gestionmesadeayuda/saveAtencionesPublico','method': 'post','id':'form_atencionespublico','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Tipo de Atención
            </label>
            <label class="select">
                <select id="input-tipo"  name="tipo" >
                    <option value="" > SELECCIONE...</option>
                    {% for tipo_atencion_select in tipo_atencion %}                                       

                        <option value="{{ tipo_atencion_select.codigo }}">{{ tipo_atencion_select.nombres }} </option>  

                    {% endfor %}
                </select> <i></i> 
            </label>
            <input type="hidden" class="" name="codigo" value="" id="input-codigo">
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Prioridad
            </label>
            <label class="select">
                <select id="input-prioridad"  name="prioridad" >
                    <option value="" > SELECCIONE...</option>
                    {% for prioridad_select in prioridad %}                                       

                        <option value="{{ prioridad_select.codigo }}">{{ prioridad_select.nombres }} </option>  

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Asunto</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="asunto" id="input-asunto" placeholder="Asunto" >                             
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción"></textarea> 
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Pedido</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                <textarea rows="3" id="input-pedido" name="pedido" placeholder="Pedido"></textarea> 
            </label>
        </section>

    </div>    
</fieldset>
{{ endForm() }}