<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Ambientes</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
         <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center  style="margin-top: -5px !important;">
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
                                <h2>Registro de Ambientes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_ambientesa" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand"> Codigo</th>
                                        <th> Tipo</th>
                                        <th data-hide="phone,tablet"> Descripción</th>
                                        <th data-hide="phone,tablet"> Abreviatura</th>
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

{{ form('registroambientes/save','method': 'post','id':'form_ambientesa','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Código</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input_code" name="code" placeholder="Código">
                <input type="hidden" id="input_codigo" name="codigo">     
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Sede</label>
            <label class="select">
                <select id="input_id_sede"  name="id_sede">
                    <option value="" >SELECCIONE...</option>
                    {% for sedes_select in sedes %}                                       
                        <option value="{{ sedes_select.id_sede }}">{{ sedes_select.nombres }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Pabellón</label>
            <label class="select">
                <select id="input_id_pabellon"  name="id_pabellon">
                    <option value="" ></option>
                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Tipo</label>
            <label class="select">
                <select id="input_tipo"  name="tipo">
                    <option value="" >SELECCIONE...</option>
                    {% for t_a_a in tipo_ambientes_academicos %}                                       
                        <option value="{{ t_a_a.codigo }}">{{ t_a_a.nombres }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
    </div>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Descripción</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="descripcion" id="input_descripcion" placeholder="Descripción" >                             
            </label>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Abreviatura</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="abreviatura" id="input_abreviatura" placeholder="Abreviatura" >                             
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" id="input_estado">
                <i></i>Activar / Desactivar</label>
        </section>
    </div>

</fieldset>
{{ endForm() }}