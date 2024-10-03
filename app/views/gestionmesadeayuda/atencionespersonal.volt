<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Atenciones Personal</li>
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

                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-list"></i></a>

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
                                <h2>Registro de Atenciones Personal</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_atencionespersonal" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>      
                                        <th data-class="expand">Area</th>
                                        <th data-hide="phone,tablet">DNI</th>
                                        <th data-hide="phone,tablet">Usuario</th>
                                        <th data-hide="phone,tablet">Tipo</th>
                                        <th data-hide="phone,tablet">Prioridad</th> 
                                        <th data-hide="phone,tablet">Fecha Recepción</th> 
                                        <th data-hide="phone,tablet">Hora</th>      
                                        <th data-hide="phone,tablet">Fecha Prevista</th>
                                        <th data-hide="phone,tablet">Fecha Termino</th>
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

{{ form('gestionmesadeayuda/saveAtencionesPersonal','method': 'post','id':'form_atenciones_personal','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-primary table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3">
                    <center>DATOS DE LA ATENCIÓN: <span id="input-codigo_atencion_text"></span></center>
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr {#style="background-color: #F7F7F7;"#}>
                            <td width="20%"><strong>Fecha:</strong> <span id="input-fecha_recepcion"></span></td>
                            <td width="20%"><strong>DNI:</strong> <span id="input-dni"></span></td>
                            <td><strong>Usuario:</strong> <span id="input-publico"></span></td>
                        </tr>
                        <tr>

                            <td colspan="3"><strong>Asunto:</strong> <span id="input-asunto"></span></td>

                        </tr>
                    </tbody>
                </table>
                <input type="hidden" class="" name="atencion" value="" id="input-atencion">
                {#<input type="hidden" class="" name="codigo" value="" id="input-codigo">#}
            </div>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha Respuesta</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_respuesta" name="fecha_respuesta" placeholder="Fecha Respuesta" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Proceso</label>
            <label class="select">
                <select id="input-proceso"  name="proceso">
                    <option value="0">SELECCIONE...</option>
                    {% for proceso_select in procesos %}
                    <option value="{{ proceso_select.codigo }}">{{
                        proceso_select.nombres }} </option>
                    {% endfor %} 
                </select> <i></i>

            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info" id="label_change">Solución</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                <textarea rows="5" id="input-solucion" name="solucion" placeholder="Solución"></textarea> 
                
            </label>
        </section>

    </div>    
</fieldset>
{{ endForm() }}