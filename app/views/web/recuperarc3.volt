{% block content %}
    <div class="container">
        <div class="row">
            <div class="col-xl-5 order-xl-2">
                <div class="card card-primary animated fadeInUp animation-delay-7">
                    <div class="card-body">
                        <h1 class="color-primary text-center">Cambiar Contraseña</h1>

                        {{ form('web/recuperarc3enlace','method': 'post','id':'form_recuperar_contrasenha_enlace','class':'form-horizontal') }}
                        <fieldset>
                            <div class="form-group row">
                                <label for="inputPassword-login" class="col-md-5 control-label">Nueva Contraseña</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" id="password" placeholder="Nueva Contraseña" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword-login" class="col-md-5 control-label">Repita su contraseña</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" placeholder="Repita Contraseña" name="password_repeat" id="password_repeat">
                                </div>
                            </div>
                        </fieldset>

                        <button class="btn btn-raised btn-primary btn-block" type="button"  data-toggle="modal" id="btn_recuperar_contrasenha_enlace">Enviar <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        <input type="hidden" name="secret_id" value="{{ secret_id }}" >
                        {{ endForm() }}
                    </div>



                    <!--Modal alerta campo contraseña vacio -->
                    <div class="modal modal-warning" id="modal_contraseña_vacio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>El campo nueva contraseña esta vacio.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal alerta nueva contraseña vacio-->
                    <div class="modal modal-warning" id="modal_nueva_contraseña_vacio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>El campo nueva contraseña esta vacio.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal envio contraseña exito -->
                    <div class="modal modal-info" id="modal_contraseña_exito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close_1"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Su contraseña fue cambiada con éxito.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-info" data-dismiss="modal" id="btn_close_2">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal alerta contraseña error -->
                    <div class="modal modal-warning" id="modal_nueva_contraseña_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>La contraseña enviada es distinta a la de confirmacion , intentelo nuevamente.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-7 order-xl-1">
                <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-bottom: 25px;">
                    <div class="card-body">
                        <h2 class="color-primary text-left">SISTEMA DE GESTIÓN UNIVERSITARIA</h2>
                        <p>SIGESU, Sistema de información diseñado para apoyar la planificación estratégica, la evaluación institucional y la toma de decisiones. Siga los siguientes pasos para cambiar su contraseña:</p>
                        <div class="card" style="box-shadow: none !important;">
                            <ul class="list-group">
                                <li class="list-group-item" style="border: none !important;"><i class="color-primary fa fa-key"></i>Ingrese su nueva contraseña</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-success fa fa-lock"></i> Repita su nueva contraseña</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
{% endblock %}
