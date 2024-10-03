<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion Planillas</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1">
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
                        <a href="javascript:void(0);" onclick="agregar()" data-proceso="AGREGAR_USUARIO" class="btn-security btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        <a href="javascript:void(0);" onclick="permisos()" class="btn btn-success btn-block"><i class="fa fa-key"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11">
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
                                <h2>Registro de Planilla</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_usuarios" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                                <th data-hide="expand"></i> NUMERO</th>
                                                <th data-hide="phone,tablet"></i> FECHA INICIO</th>
                                                <th data-hide="phone,tablet"></i> FECHA FIN</th>
                                                <th data-hide="phone,tablet">CONTRATO</th>	
                                                <th data-class="phone,tabletx   "></i> PERSONAL</th>		
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

{{ form('usuarios/save','method': 'post','id':'form_usuarios','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-usu_nombre" name="usu_nombre" placeholder="Nombres" >
                <input type="hidden" id="input-id" name="id" value="">
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-6">
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="usu_usuario" id="input-usu_usuario" placeholder="Usuario" >                             
            </label>
        </section>
        <section class="col col-6">
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="password" id="input-usu_clave"  name="usu_clave" placeholder="Clave">
            </label>
        </section>
    </div>
    <section>
        <label class="select">
            <select id="input-perfil_id"  name="perfil_id" >
                <option value="" >PERFIL</option>
                {% for perfil in perfiles %}                                       
                    <option value="{{ perfil.id }}">{{ perfil.per_descripcion }}</option>                                       
                {% endfor %}
            </select> <i></i> 
        </label>
    </section>
</fieldset>
{{ endForm() }}

<div id="modalpermisos"  aria-hidden="true" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">ASIGNAR PERMISOS</h4>
            </div>
            <div class="modal-body">

                <div id="tree" style="font-size: 12px;overflow: auto;height: auto;"></div>
                <div style="text-align: center;" >
                    </br>

                </div>
                <span id="load"></span>
                <br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" id="actualizaPermisos"><i class="fa fa-refresh"></i> Actualizar Permisos</button>
                <button type="button"   class="btn btn-default" data-dismiss="modal">Cancelar</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->