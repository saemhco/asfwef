<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimiento de Docentes</li>
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
                        {# <a href="{{ url('registrodocentes/registro') }}"  class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>#}
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Docentes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_docentes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 
                                        <th data-class="expand">IMAGEN</th>  
                                        <th>CÓDIGO</th>  
                                        <th>APELLIDO PATERNO</th>
                                        <th data-hide="phone,tablet">APELLIDO MATERNO</th>
                                        <th data-hide="phone,tablet">NOMBRES</th>
                                        <th data-hide="phone,tablet">DOCUMENTO</th>
                                        <th data-hide="phone,tablet">CELULAR</th>
                                        <th data-hide="phone,tablet">TITULO</th>
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
{{ form('registrodocentes/save','method': 'post','id':'form_docente_nuevo','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info" >Numero documento</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-nro_doc" name="nro_doc" placeholder="" >
                <input type="hidden" id="input-codigo" name="codigo" value="">
            </label>
        </section>
    </div> 
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info" >Apellido Paterno</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-apellidop" name="apellidop" placeholder="" >
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info" >Apellido Materno</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-apellidom" name="apellidom" placeholder="" >
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info" >Nombres</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-nombres" name="nombres" placeholder="" >
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Email Institucional</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-email1" name="email1" placeholder="" >
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Grado Abreviado</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-grado_abreviado" name="grado_abreviado" placeholder="Grado Abreviado" >
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-append fa fa-edit"></i>
                <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" >
            </label>
        </section>
    </div>    
</fieldset>
{{ endForm() }}
<script type="text/javascript" >
    var publica = "no";
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

