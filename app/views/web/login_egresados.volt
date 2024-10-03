{% block content %}
    <div class="container">
        <div class="row">
            <div class="col-xl-6 order-xl-2">
                <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-top: 120px;padding-bottom: 55px; ">
                    <div class="card-body">
                        <h1 class="color-primary text-center" style="margin-top: -80px !important;">Inicio de Sesión</h1>

                        {{ form('web/loginEgresados','method': 'post','id':'form_sesion_perfiles','class':'form-horizontal') }}
                        <fieldset>

                            <div class="form-group row" style="margin-bottom: -20px !important;">
                                <label for="inputEmail-ñogin" class="col-md-4 control-label" id="label_change" style="font-size: 14px !important;padding-top: 1px !important;text-align: left;">E-mail</label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" id="input_email" placeholder="Email" name="email">
                                    <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                                </div>

                                <div class="col-md-4">
                                    
                                    <label for="inputEmail-ñogin" class="control-label" style="color: black !important; font-size: 14px;padding-top: 1px !important;">{{ config.global.xEmailIns }}</label>
                                     
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword-login" class="col-md-4 control-label" style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Contraseña</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="input_password" placeholder="Contraseña" name="password">
                                </div>
                            </div>
                        </fieldset>
                        {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                        <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_perfiles" style="margin-top: 20px!important;">Entrar <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                            {{ endForm() }}
                        <div class="text-center mt-4" style="margin-top: 24px!important; margin-bottom: 28px!important;">

                            <a href="{{ url('recuperar-contrasenha-web.html') }}">Recuperar Contraseña</a>
                        
                        </div>
                    </div>
                    <!--Modal alerta campo vacio -->
                    <div class="modal modal-warning" id="modal_campo_vacio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel4">Mensaje</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    {#<p>El numero de documento es obligatorio...</p>#}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning"  id="btn_cerrar_alerta" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fin modal vacio -->
                </div>
            </div>
            <div class="col-xl-6 order-xl-1">
                <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-bottom: -50px !important;">
                    <div class="card-body">
                        <h3 class="color-primary text-center"><strong>SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE LA EDUCACIÓN SUPERIOR UNIVERSITARIA</strong></h3>
                        <center><h1><strong>SIGESU</strong></h1></center>
                        <div class="card" style="box-shadow: none !important;">
                            <ul class="list-group">
                                <li class="list-group-item" style="border: none !important;"><i class="color-primary fa fa-home"></i>Matricula Online</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-success fa fa-user-plus"></i> Gestión Docente</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-info fa fa-file-text"></i>Gestión de Biblioteca</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-danger fa fa-briefcase"></i>Bolsa de Trabajo</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-user"></i>Registros Académicos</li>
                              
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
    <script type="text/javascript" >
        {#var site_key = "{{site_key}}";#}
    </script>
{% endblock %}