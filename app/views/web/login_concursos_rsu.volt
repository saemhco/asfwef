{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-top: 25px;">
                <div class="card-body">
                    <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>

                    {{ form('web/loginRatificacionDocentes','method':
                    'post','id':'form_sesion_ratificacion_docentes','class':'form-horizontal') }}
                    <fieldset>

                        <div class="form-group row">
                            <label for="inputEmail-ñogin" class="col-md-4 control-label"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Nro.
                                DNI</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="input_nro_doc_login"
                                    placeholder="Ingrese su número de DNI" name="nro_doc_login">
                                <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword-login" class="col-md-4 control-label"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Contraseña</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="input_password_login"
                                    placeholder="Contraseña" name="password_login">
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                    <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_ratificacion_docentes">Iniciar Sesión <i
                            class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                    {{ endForm() }}
                    <div class="text-center mt-1">
                        {# <h3>Recuperar Contraseña</h3>#}
                        <a href="{{ url('recuperar-contrasenha-web.html') }}">Recuperar Contraseña</a>

                    </div>
                    
                </div>
 <!--Modal alerta campo vacio -->
                <div class="modal modal-warning" id="modal_campo_vacio" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                {#<p>El numero de documento es obligatorio...</p>#}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-warning" id="btn_cerrar_alerta"
                                    data-dismiss="modal">Cerrar</button>
                                {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin modal vacio -->
            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">

                    <h2 class="color-primary text-center" style="font-size:20px;"><strong>
                        <br>
                        <span style="font-size: 30px;">SISTEMA DE GESTIÓN ADMINISTRATIVA</span> 
                        “RATIFICACIÓN DE DOCENTES"</strong></h2>
                        <br>
                    <p style="text-align: justify;padding-bottom: 15px;">
                        Bienvenidos al nuevo portal de Gestión de Ratificación de Docentes. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
                    </p>
                    <p style="text-align: justify;">Para más información sobre el procedimiento de postulación descargue
                        el siguiente documento: <br><p></p><a target="_blank"
                            href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-informacion-de-gestion-de-convocatorias-de-concurso-docente.pdf"><strong>
                                Manual de usuario del Sistema de Gestión de Ratificación de Docentes de la UNCA</strong></a>.</p>
                        

                </div>
            </div>
        </div>

        <div class="col-xl-12 order-xl-3">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <div class="heading-title heading-border-bottom heading-color">
                        <h4 class="panel-title">Las consultas se pueden realizar por los siguientes medios: </h4>
                    </div>
                    <div>
                        <h5>
                            <p style="text-align: justify;">Enviando un correo electrónico a:</p>
                        </h5>
                        <ul style="list-style-type: disc;">
                            <i class="fa fa-envelope"></i>&nbsp&nbsp&nbsp Email: <a
                                href="mailto:informes@unca.edu.pe">rsu@unca.edu.pe</a> <br />

                        </ul>
                        <h5>
                            <p style="text-align: justify;">Llamando al teléfono:</p>
                        </h5>
                        <ul style="list-style-type: disc;">
                            <i class="fa fa-phone"></i> &nbsp&nbsp&nbsp +51 044 365463 <br />

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->
{% endblock %}