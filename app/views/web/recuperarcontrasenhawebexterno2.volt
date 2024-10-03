{% block content %}

    <div class="container">
        <div class="row">
            <div class="col-xl-5 order-xl-2">
                <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-bottom: 10px;">
                    <div class="card-body">
                        <h2 class="color-primary text-center">Recuperar Contraseña</h2>

                        {{ form('web/recuperarContrasenhaExterno','method': 'post','id':'form_recuperarclave','class':'form-horizontal') }}
                        <fieldset>
                            <div class="form-group row">
                                <label for="inputEmail-ñogin" class="col-md-3 control-label">E-mail</label>
                                <div class="col-md-9">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </fieldset>

                        <button class="btn btn-raised btn-primary btn-block" type="button"  data-toggle="modal" id="btn-recuperar">Enviar <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                        <a href="https://www.unca.edu.pe/" class="btn btn-danger btn-raised btn-block" role="button">
                            <i class="mr-1 zmdi zmdi-arrow-left zmdi-hc-fw"></i><span>Volver</span>                                        
                        </a>
                        {{ endForm() }}
                    </div>

                    <!--Modal alerta email vacio -->
                    <div class="modal modal-warning" id="modal_email_vacio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Ingrese su email para recuperar su contraseña.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal alerta email no registrado -->
                    <div class="modal modal-warning" id="modal_email_no_registrado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel4">Mensaje</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>El email no esta registrado...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal envio link -->
                    <div class="modal modal-info" id="modal_envio_link" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel4">Mensaje</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Se envió un correo con el link de recuperar contraseña...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-info" data-dismiss="modal" id="btn_cerrar_alerta">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-7 order-xl-1">
                <div class="card card-primary animated fadeInUp animation-delay-7">
                    <div class="card-body">
                        <h2 class="color-primary text-left">{{ config.global.xNombreSistema }}</h2>
                        <p>Sigue los siguientes pasos para recuperar tu contraseña:</p>
                        <div class="card" style="box-shadow: none !important;">
                            <ul class="list-group">
                                <li class="list-group-item" style="border: none !important;"><i class="color-primary fa fa-link"></i>Ingresa tu Email y envia el enlace de recuperación.</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-success fa fa-mail-reply"></i> Accede al enlace proporcionado en el mensaje para crear tu nueva contraseña.</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-info fa fa-envelope-square"></i> Si no encuentra el mensaje, revise en la seccion "spam/correo no deseado"</li>

                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
{% endblock %}
