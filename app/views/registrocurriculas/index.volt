<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Curriculas</li>
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
                                <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                <h2>Registro de Curriculas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">                                        

                                    <table id="tbl_curriculas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>                         
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>

                                        <th data-class="expand">CÓDIGO</th>
                                        <th>DESCRIPCIÓN</th>            
                                        <th>FECHA INICIO</th> 
                                        <th>FECHA FIN</th> 
                                        <th data-hide="phone,tablet">ABREVIATURA</th> 
                                        <th data-hide="phone,tablet">CARERRA</th> 
                                        <th data-hide="phone,tablet">ESTADO</th> 

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

{{ form('registrocurriculas/save','method': 'post','id':'form_curriculas','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Código</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-codigo" name="codigo" placeholder="Código">
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Currícula</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-descripcion" name="descripcion" placeholder="Currícula" >
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info" >Fecha Inicio</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd-mm-yy' value="">
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info" >Fecha Final</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin" placeholder="Fecha Fin" class="datepicker" data-dateformat='dd-mm-yy' value="">
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Abreviatura</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-abreviatura" name="abreviatura" placeholder="Abreviatura de la Currícula" >
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Carrera Profesional</label>
            <label class="select">
                <select id="input-carrera"  name="carrera" >
                    <option value="" >CARRERAS</option>
                    {% for carrera in carreras %}                                       
                        <option value="{{ carrera.codigo }}">{{ carrera.descripcion }}</option>
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section> 

    </div> 


</fieldset>
{{ endForm() }}