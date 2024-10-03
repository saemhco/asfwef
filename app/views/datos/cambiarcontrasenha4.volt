
<div id="ribbon">
    
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Utilitarios</li><li>Cambiar Contraseña</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     

        <div class="col-md-4 col-md-offset-4">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Cambiar Contraseña</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('datos/save_contrasenha4','method': 'post','id':'form_usuarios','class':'smart-form') }}
                                    <fieldset>

                                        <div class="row">                                           
                                            <section class="col col-md-12">
                                                <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                                    <input type="password" id="input-usu_clave"  name="usu_clave" placeholder="Contraseña Actual">
                                                </label>
                                            </section>
                                        </div>                                        

                                        <div class="row">                                           
                                            <section class="col col-md-12">
                                                <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                                    <input type="password" id="input-usu_clave2"  name="usu_clave2" placeholder="Contraseña Nueva">
                                                </label>
                                            </section>
                                        </div>

                                        <div class="row">                                           
                                            <section class="col col-md-12">
                                                <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                                    <input type="password" id="input-re_password"  name="re_password" placeholder="Confirmar Contraseña Nueva">
                                                </label>
                                            </section>
                                        </div>

                                    </fieldset>
                                    <footer>
                                        <button id="actualizar-clave" type="button" class="btn btn-primary">
                                            Actualizar
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>
                                    </footer>
                                    {{ endForm() }}
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>
        <div class="col-sm-4" ></div>
    </div>	
</div>
<div class="hidden">
    <div id="exito_cambio_password">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="alerta_no_coincide_password">
        <p>
            Contraseña nueva no coinciden con la confirmada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="alerta_no_coincide_password_actual">
        <p>
            Contraseña actual incorrecta...
        </p>
    </div>
</div>