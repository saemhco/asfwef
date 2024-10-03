<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimientos</li><li>Estabilizadores</li>
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
                        <div class="widget-body text-center">
                            <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                            <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                    <h2>Registro de Estabilizadores</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_estabilizadores" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th><center><i class="fa fa-check-circle"></i></center></th>


                                                    <th data-class="expand">Tipo</th>
                                                    <th data-hide="phone,tablet">Patrimonial</th>
                                                    <th data-hide="phone,tablet"> Marca</th>
                                                    <th data-hide="phone,tablet"> Modelo</th>
                                                    <th data-hide="phone,tablet"> Serie</th>
                                                    <th data-hide="phone,tablet"> Color</th>

                                                    <th data-hide="phone,tablet"> Observaciones</th>  
                                                    <th data-hide="phone,tablet"> Estado</th>
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

    {{ form('registroestabilizadores/save','method': 'post','id':'form_estabilizadores','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
    <fieldset>
        <div class="row">
            <section class="col col-md-6">
                <label class="text-info" >Tipo</label>
                <label class="select">
                    <select id="input-tipo"  name="tipo" >
                        <option value="" >Tipo</option>
                        {% for tipoestabilizadores_select in tipoestabilizadores %}                                       
                            <option value="{{ tipoestabilizadores_select.codigo }}">{{ tipoestabilizadores_select.nombres }}</option>                                       
                        {% endfor %}
                    </select> <i></i> 
                </label>
            </section> 
            <section class="col col-md-6">
                <label class="text-info" >Codigo Patrimonial</label>
                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                    <input type="text" name="id_patrimonial" id="input-id_patrimonial" placeholder="" >  
                                      
                </label>
            </section>    
        </div>

        <div class="row">
            <section class="col col-md-12">
                <label class="text-info">Caracteristicas</label>
                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                    <textarea rows="5" id="input-caracteristicas" name="caracteristicas" placeholder=""></textarea>
                </label>
            </section>
        </div>

        <div class="row">
            <section class="col col-md-6">
                <label class="text-info" >Marca</label>
                <label class="input"> <i class="icon-prepend fa fa-desktop"></i>
                    <input type="text" name="marca" id="input-marca" placeholder="" >  
                    <input type="hidden" id="input-id_estabilizador" name="id_estabilizador" value="">                           
                </label>
            </section> 
            <section class="col col-md-6">
                <label class="text-info" >Modelo</label>
                <label class="input"> <i class="icon-prepend fa fa-desktop"></i>
                    <input type="text" name="modelo" id="input-modelo" placeholder="" >                             
                </label>
            </section>   
        </div>

        <div class="row">
            <section class="col col-md-6">
                <label class="text-info" >Serie</label>
                <label class="input"> <i class="icon-prepend fa fa-barcode"></i>
                    <input type="text" name="serie" id="input-serie" placeholder="" >                             
                </label>

            </section> 
            <section class="col col-md-6">
                <label class="text-info" >Color</label>
                <label class="input"> <i class="icon-prepend fa fa-paint-brush"></i>
                    <input type="text" name="color" id="input-color" placeholder="" >                             
                </label>
            </section> 
        </div>

        <div class="row">
            <section class="col col-md-12">
                <label class="text-info" >Observaciones</label>
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-observaciones" name="observaciones" placeholder=""></textarea> 
                </label>
            </section>
        </div>

    </fieldset>
    {{ endForm() }}