<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimientos</li><li>Novedades</li>
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
                                <h2>Registro de Novedades</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_novedades" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand">Imagen</th>
                                        <th data-hide="phone,tablet"> Título</th>
                                        <th data-hide="phone,tablet"> Descripción</th>
                                        <th data-hide="phone,tablet"> Autor</th>
                                        <th data-hide="phone,tablet">Fecha</th>
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

{{ form('novedades/save','method': 'post','id':'form_novedades','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Titulo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titulo" name="titulo" placeholder="" >
                <input type="hidden" id="input-id_novedad" name="id_novedad" value="">
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                <textarea rows="5" id="input-descripcion" name="descripcion_ckeditor" placeholder=""></textarea> 
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Autor</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="autor" id="input-autor" placeholder="" >                             
            </label>
        </section>    
    </div>


    <div class="row">
        <section class="col col-md-10">
            <label class="text-info" >Agregar Imagen (600x400 px)</label>
            <div class="input input-file">
                <span class="button"><input id="logosubir" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">Buscar</span><input type="text" id="input-imagen" name="input-imagen"  placeholder="Agregar Imagen" readonly="">
            </div>
        </section>
        <section class="col col-md-2">
            <label class="text-info" >Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado">
                <i></i>
            </label>
        </section>
    </div>

</fieldset>
{{ endForm() }}