{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-top: 25px;">
                <div class="card-body">
                    <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>

                    {{ form('web/loginConcursosRsu','method':
                    'post','id':'form_sesion_concursos_rsu','class':'form-horizontal') }}
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
                    <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_concursos_rsu">Iniciar Sesión <i
                            class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                    {{ endForm() }}
                    <div class="text-center mt-1">
                        {# <h3>Recuperar Contraseña</h3>#}
                        <a href="{{ url('recuperar-contrasenha-web.html') }}">Recuperar Contraseña</a>

                    </div>
                    
                </div>

            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <h4 class="color-primary text-center" style="font-size:24px;;padding-bottom: 20px;"><strong>
                                
                        <span>SISTEMA DE INFORMACION DE GESTIÓN DE CONVOCATORIAS DE PROYECTOS DE INVESTIGACIÓN BASICA Y APLICADA</strong>
                                
                    </h4>
                    <p style="text-align: justify;padding-bottom: 5px;">
                        Bienvenidos a la nueva Plataforma de Gestión de Convocatorias de Proyectos de Investigación Básica y Aplicada. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
                    </p>
                    <p style="text-align: justify;">Para más información sobre el procedimiento de postulación descargue el siguiente Manual de Usuario: <br><a target="_blank"
                            href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-informacion-de-gestion-de-convocatorias-de-concurso-docente.pdf"><strong>
                                Sistema de Información de Gestión de Convocatorias de Proyectos de Investigación Básica y Aplicada SIGCPIBA.</strong></a>
                    </p>
                        

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
                                href="mailto:informes@unca.edu.pe">informes@unca.edu.pe</a> <br />

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