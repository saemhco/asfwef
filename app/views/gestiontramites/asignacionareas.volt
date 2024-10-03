<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Asignación de Areas</li>
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
                                <h2>Registro Asignación de Areas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_asignacionareas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             
                                        <th data-class="expand">Personal</th>
                                
                                        <th data-hide="phone,tablet">Area</th> 
                                        <th data-hide="phone,tablet">Perfil</th>                            
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

{{ form('gestiontramites/saveAsignacionAreas','method': 'post','id':'form_asignacionareas','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Personal
            </label>
            <label class="select">
                <select id="input-personal"  name="personal" >
                    <option value="" > Apellido Paterno Apellidos Materno Nombres</option>
                    {% for personal_select in personal %}                                       
                        <option value="{{ personal_select.codigo }}">{{ personal_select.apellidop }} {{ personal_select.apellidom }} {{ personal_select.nombres }} </option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
            <input type="hidden" class="" name="codigo" value="" id="input-codigo">
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Areas
            </label>
            <label class="select">
                <select id="input-area"  name="area" >
                    <option value="" > Nombre del Area</option>
                    {% for areas_select in areas %}                                       

                        <option value="{{ areas_select.codigo }}">{{ areas_select.nombres }} </option>  

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Perfil
            </label>
            <label class="select">
                <select id="input-perfil"  name="perfil" >
                    <option value="" > Perfil</option>
                    {% for perfil_tramite_select in perfil_tramite %}                                       

                        <option value="{{ perfil_tramite_select.codigo }}">{{ perfil_tramite_select.nombres }} </option>  

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>

    </div>    
</fieldset>
{{ endForm() }}