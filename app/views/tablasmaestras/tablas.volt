<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimiento de tablas hijas</li>
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
                        <a href="javascript:void(0);" onclick="agregar_maestra();"  class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>
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
                                <h2>Registro de tablas hijas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    <input type="hidden" id="tablas_maestras" name="tablas_maestras" value="{{ numero_tabla }}">
                                    <table id="tbl_tablas_maestras" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             


                                        <th data-class="expand">NÚMERO</th>  
                                        <th>NOMBRE</th>    
                                        <th>DESCRIPCIÓN</th>  
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
{{ form('tablasmaestras/savemaestras','method': 'post','id':'form_tablas_maestras','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        {#<section class="col col-md-6">
            <label class="text-info" >Numero</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="hidden" id="input-codigo" name="codigo" placeholder=""  readonly="">
                <input type="hidden" id="input-numero" name="numero" value="">

            </label>
        </section>#}
        <input type="hidden" id="input-codigo" name="codigo" placeholder=""  readonly="">
        <input type="hidden" id="input-numero" name="numero" value="">

        <section class="col col-md-6">
            <label class="text-info" >Orden</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden" name="orden" placeholder="" >
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Nombres</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombres" name="nombres" placeholder="" >
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                <textarea rows="3" id="input-descripcion" name="descripcion" placeholder=""></textarea> 
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Abreviatura</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-abreviatura" name="abreviatura" placeholder="" >
            </label>
        </section>

        {#<section class="col col-md-4">
            <label class="text-info" >Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado">
                <i></i>
            </label>
        </section>#}
    </div>    
</fieldset>
{{ endForm() }}
{#<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible...
        </p>
    </div>
</div>#}
<script type="text/javascript" >

    var publica = "no";

    {% if numero_tabla is defined %}
        var numero_tabla = "{{ numero_tabla }}";
    {% else %}
        var numero_tabla = 0;
        var activa_datatable = 1;
    {% endif %}

</script>
<script type="text/javascript" >
    var perfil = "{{ perfil }}";
</script>

