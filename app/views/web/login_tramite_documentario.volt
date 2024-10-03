{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body"  style="margin-top: 5px!important;">

                    <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>
                    
                    {{ form('web/loginTramiteDocumentario','method':
                    'post','id':'form_sesion_perfiles','class':'form-horizontal') }}
                    <fieldset>
                        <div class="form-group row" style="margin-bottom: -10px !important;">
                            <label for="inputEmail-ñogin" class="col-md-4 control-label" id="label_change"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Email</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="input-email" placeholder="Ingrese su email"
                                    name="email">
                                <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom: -5px !important;">
                            <label for="inputPassword-login" class="col-md-4 control-label"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Contraseña</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="input-password" placeholder="Contraseña"
                                    name="password">
                            </div>
                        </div>
                    </fieldset>

                    <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_perfiles"
                        style="margin-top: 30px!important;">Acceder  <i
                            class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                            <div class="text-center mt-4" style="margin-top: 20px!important;">

                                <a href="{{ url('recuperar-contrasenha-tramite-documentario.html') }}">Recuperar Contraseña</a>
        
                            </div>

                    {{ endForm() }}
                    
                    
                    <div class="text-center mt-4" style="margin-top: 25px!important;">

                        <a target="_blank" href="web-consulta-tramite-documentario.html" class="btn btn-raised btn-info btn-block">
                            <i class="zmdi zmdi-search no-mr ml-1"></i>   &nbsp;&nbsp; Consulte su trámite
                        </a>
                    
                        <a href="javascript:void(0);" class="btn btn-raised btn-primary btn-block"
                               onclick="enviar_email();"><i class="zmdi zmdi-account-add no-mr ml-1"></i>   &nbsp;&nbsp; Regístrese 
                        </a>
                    </div>

                </div>

                <!--Modal alerta campo vacio -->
                <div class="modal modal-warning" id="modal_campo_vacio" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel4">Mensaje</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-warning" id="btn_cerrar_alerta"
                                    data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!--fin modal vacio -->

                <!--Modal publico -->
                <div class="modal modal-primary" id="modal_enviar_email" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">

                    <div class="modal-dialog animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mesa de Partes Virtual</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">

                                {{ form('web/envioEmailPublico','method':
                                'post','id':'form_enviar_email','class':'form-horizontal','enctype':'multipart/form-data')
                                }}

                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <label for="input_email_publico" class="control-label">Ingrese su e-mail
                                                    / correo electrónico institucional para iniciar registro:
                                                </label>
                                                <input type="email" class="form-control" id="input_email_publico"
                                                    placeholder="" name="email" style="margin-top: 9px !important;">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                {{ endForm() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i>Cancelar</button>
                                <button type="button" class="btn btn-raised btn-primary" id="btn-enviar_email"><i
                                        class="fa fa-arrow-right"></i>Enviar</button>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- fin modal registro publico -->

                <!--Modal envio link -->
                <div class="modal modal-info" id="modal_envio_link" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>Se envió un correo con el link para continuar con el proceso de registro...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-info"
                                    data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    
                    <h2 class="color-primary text-center" style="font-size:25px;"><strong><span>SISTEMA DE INFORMACIÓN DE GESTIÓN DE TRÁMITE DOCUMENTARIO</strong></h2>
                    <hr>                    
                    <p style="text-align: justify;padding-bottom: 3px;">
                        Bienvenidos al Sistema de Información de Gestión de Tramite Documentario, esta plataforma
                        permite a los usuarios presentar diversos documentos e iniciar trámites ante la entidad de una manera no presencial.
                    
                    </br>
                    Para más información sobre el procedimiento de trámites descargue el siguiente
                    <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-sistema-tramite-documentario-903454.pdf">
                        <strong>Manual de usuario del Sistema de Gestión de Trámite Documentario de la UNCA.</strong>
                     </a>

                    </p> 
               
                    <div class="col-md-12">
                        <p>
                        <i class="fa fa-envelope"></i>&nbsp;E-mail:
                        <a href="mailto:informes@unca.edu.pe">tramite.documentario@unca.edu.pe</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-phone"></i>&nbsp;Tel: +51 044 365463</p>
                    </div>
               

                    <img class="card-img-top" src="adminpanel/imagenes/web/login-tramite-documentario.jpg" alt="" height="150">
                    

                    

                </div>

              
            </div>
        </div>
    </div>
</div> <!-- container -->
{% endblock %}