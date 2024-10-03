<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Empresas</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center>
                        <span class="widget-icon"> <i class="fa fa-hand-o-up"></i> </span>
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
                                <h2>Registro de Empresas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_empleador" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand"> Logo</th>
                                        <th> Razon Social</th>
                                        <th> Ruc</th>
                                        <th data-hide="phone,tablet"> Rubro</th>
                                        <th data-hide="phone,tablet"> Telefono</th>
                                        <th data-hide="phone,tablet"> Direccion</th> 
                                        <th data-hide="phone,tablet"> Email</th> 
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

{{ form('empleador/save','method': 'post','id':'form_empleador','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-razon_social" name="razon_social" placeholder="Razon Social" >
                <input type="hidden" id="input-empleador_id" name="empleador_id" value="">
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-credit-card-alt"></i>
                <input type="text" name="ruc" id="input-ruc" placeholder="RUC" >                             
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="representante" id="input-representante" placeholder="Representante" >                             
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-envelope"></i>
                <input type="text" name="email" id="input-email" placeholder="Email" >                             
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="rubro" id="input-rubro" placeholder="Rubro" >                             
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                <input type="text" name="telefono" id="input-telefono" placeholder="Telefono" >                             
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-map-marker"></i>
                <input type="text" name="direccion" id="input-direccion" placeholder="Direccion" >                             
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <div class="input input-file">
                <span class="button"><input id="logosubir" type="file" name="logo" onchange="this.parentNode.nextSibling.value = this.value">Buscar</span><input type="text" id="input-logo" name="input-logo"  placeholder="Agregar Logo" readonly="">
            </div>
        </section>

    </div>

</fieldset>
{{ endForm() }}