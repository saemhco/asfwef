{% block content %}
    <div class="container">
        <div class="row">
            <div class="col-xl-5 order-xl-2">
                <div class="card card-primary animated fadeInUp animation-delay-7" >
                    <div class="card-body">
                        
                        <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>
                        <br>
                        {{ form('web/loginInterno','method': 'post','id':'form_sesion_perfiles','class':'form-horizontal') }}
                        <fieldset>

                            {#<div class="form-group row" style="margin-bottom: -20px !important;">
                                <label for="inputEmail-ñogin" class="col-md-3 control-label" id="label_change" style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">E-mail</label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" id="input_email" placeholder="Email" name="email">
                                    <input type="hidden" name="tipousuario" value="3" id="">
                                    <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                                </div>

                                <div class="col-md-5">

                                    <label for="inputEmail-ñogin" class="control-label" style="color: black !important; font-size: 14px;padding-top: 1px !important;">{{ config.global.xEmailIns }}</label>

                                </div>
                            </div>#}
                            <div class="form-group row" style="margin-bottom: -20px !important; margin-top: 5px;">
                                <label for="inputEmail-ñogin" class="col-md-4 control-label" id="label_change" style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Nro. DNI</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="input_nro_doc" placeholder="Ingrese su número de DNI" name="nro_doc">
                                    <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                                    <input type="hidden" name="tipousuario" value="3" id="">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: -10px !important;">
                                <label for="inputPassword-login" class="col-md-4 control-label" style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Contraseña</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="input_password" placeholder="Contraseña" name="password">
                                </div>
                            </div>
                        </fieldset>
                        {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                        <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_perfiles" style="margin-top: 30px!important;">Entrar <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                            {{ endForm() }}
                        <div class="text-center mt-4" style="margin-top: 35px!important;">

                            <a href="{{ url('recuperar-contrasenha-web-interno.html') }}">Recuperar Contraseña</a>

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
            <div class="col-xl-7 order-xl-1">
                <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-top: -30px;">
                    <div class="card-body">
                        <h3 class="color-primary text-center"><strong>SISTEMA DE INFORMACION PARA LA GESTION ADMINISTRATIVA</strong></h3>
                        {#<center><h1><strong>SIGADU</strong></h1></center>#}
                        <div class="card" style="box-shadow: none !important;">
                            <ul class="list-group">                                
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-book"></i>Trámite Documentario</li>                                
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-book"></i>Economía y Finanzas</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-user"></i>Recursos Humanos</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-user"></i>Mesa de Ayuda</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-user"></i>Gestión Institucional</li>
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