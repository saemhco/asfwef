{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-top: 25px;">
                <div class="card-body">
                    <center>{{ image("webpage/assets/img/logo.png", "alt":"ENAE") }}</center>

                    {{ form('web/loginSupervisores','method': 'post','id':'form_sesion','class':'form-horizontal')
                    }}
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
                    <button class="btn btn-raised btn-primary btn-block" type="button"
                        id="btn_login_postulantes">Iniciar Sesión <i
                            class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                    {{ endForm() }}
                    <div class="text-center mt-1">
                        {# <h3>Recuperar Contraseña</h3>#}
                        <a href="{{ url('recuperar-contrasenha-web-externo.html') }}">Recuperar Contraseña</a>

                    </div>
                    <br>
                    <a href="javascript:void(0);" class="btn btn-raised btn-primary btn-block"
                        onclick="agregar();">Regístrate <i class="zmdi zmdi-account-add no-mr ml-1"></i></a>
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

                <!--Modal postulante -->
                <div class="modal modal-primary" id="modal_registro_postulante" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Registro de ENAE 2021 - I</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                {#<p>Se registro postulante correctamente...</p>#}
                                {{ form('web/savePostulanteEnae','method':
                                'post','id':'form_registro_postulante','class':'form-horizontal','enctype':'multipart/form-data')
                                }}


                                <div class="container-fluid">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_documento">
                                                <label for="input_documento" class="control-label">Tipo
                                                    Documento:</label>
                                                <select id="input_tipo_documento" class="form-control selectpicker"
                                                    name="documento">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipodocumento_select in tipodocumentos %}

                                                    {% if tipodocumento_select.codigo == 1 %}
                                                    <option value="{{ tipodocumento_select.codigo }}" selected>{{
                                                        tipodocumento_select.nombres }}</option>
                                                    {% else %}
                                                    <option value="{{ tipodocumento_select.codigo }}">{{
                                                        tipodocumento_select.nombres}}</option>
                                                    {% endif %}
                                                    {% endfor %}
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_nro_doc" class="control-label">Número
                                                    Documento:</label>
                                                <input type="text" class="form-control" id="input_nro_doc"
                                                    placeholder="" name="nro_doc" style="margin-top: 9px !important;">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_email" class="control-label">Email:</label>
                                                <input type="email" class="form-control" id="input_email" placeholder=""
                                                    name="email" style="margin-top: 9px !important;">
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_apellidop" class="control-label">Apellido
                                                    Paterno:</label>
                                                <input type="text" class="form-control" id="input_apellidop"
                                                    placeholder="" name="apellidop">

                                            </div>


                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_apellidom" class="control-label">Apellido
                                                    Materno:</label>
                                                <input type="text" class="form-control" id="input_apellidom"
                                                    placeholder="" name="apellidom">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_nombres" class="control-label">Nombres:</label>
                                                <input type="text" class="form-control" id="input_nombres"
                                                    placeholder="" name="nombres">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_celular" class="control-label">Celular:</label>
                                                <input type="text" class="form-control" id="input_celular"
                                                    placeholder="" name="celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_ciudad" class="control-label">Ciudad:</label>
                                                <input type="text" class="form-control" id="input_ciudad" placeholder=""
                                                    name="ciudad">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_Colegio Profesional Número"
                                                    class="control-label">Número Colegiatura (Si no esta colegiado dejar
                                                    en blanco):</label>
                                                <input type="text" class="form-control"
                                                    id="input-colegio_profesional_nro" name="colegio_profesional_nro"
                                                    placeholder="">

                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_tipo_institucion">
                                                <label for="input_documento" class="control-label">Tipo
                                                    de Institución:</label>
                                                <select id="input_documento_select" class="form-control selectpicker"
                                                    name="tipo_institucion">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipoinstitucion_select in tipoinstitucion %}

                                                    <option value="{{ tipoinstitucion_select.codigo }}">{{
                                                        tipoinstitucion_select.nombres }}</option>

                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="row form-group">
                                                <label for="input_institucion" class="control-label">
                                                    Institución:</label>
                                                <input type="text" class="form-control" id="input_institucion"
                                                    placeholder="" name="institucion"
                                                    style="margin-top: 9px !important;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_categoria">
                                                <label for="input_region" class="control-label">Categoría:</label>

                                                <select id="input_categoria_select" class="form-control selectpicker"
                                                    name="categoria">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for categoriapostulante_select in categoriapostulante %}
                                                    <option value="{{ categoriapostulante_select.codigo }}">{{
                                                        categoriapostulante_select.nombres }}</option>
                                                    {% endfor %}
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row form-group">
                                                <label for="input_escuela" class="control-label">Facultad y/o Escuela de
                                                    Enfermería:</label>
                                                <input type="text" class="form-control" id="input_escuela"
                                                    placeholder="" name="escuela" style="margin-top: 9px !important;">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="inputFile" class="control-label">Cargar Foto (Tipo de
                                                    archivo: jpg/jpeg/png)</label>
                                                <input type="text" readonly="" class="form-control"
                                                    placeholder="Buscar...(Archivo Menor a 2MB)" name="foto"
                                                    id="input_foto">
                                                <input type="file" id="inputFileFoto" multiple="" name="foto">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="inputFile" class="control-label">Cargar archivo DNI (Tipo de
                                                    archivo: pdf)</label>
                                                <input type="text" readonly="" class="form-control"
                                                    placeholder="Buscar... (Archivo Menor a 2MB)" name="archivo"
                                                    id="input_archivo">
                                                <input type="file" id="inputFileArchivo" multiple="" name="archivo">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="inputFile" class="control-label">Cargar...<span
                                                        id="input-label_archivo_escuela"></span> (Tipo de archivo: pdf)
                                                    Seleccione Categoría</label>
                                                <input type="text" readonly="" class="form-control"
                                                    placeholder="Buscar...(Archivo Menor a 2MB)" name="archivo_escuela"
                                                    id="input_archivo_escuela">
                                                <input type="file" id="inputFileArchivoEscuela" multiple=""
                                                    name="archivo_escuela">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password" class="control-label">Contraseña:</label>
                                                <input type="password" class="form-control" id="input_password"
                                                    placeholder="" name="password">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password_2" class="control-label">Repetir
                                                    Contraseña:</label>
                                                <input type="password" class="form-control" id="input_password2"
                                                    placeholder="" name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ endForm() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i>Cancelar</button>
                                <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_postulantes"><i
                                        class="fa fa-save"></i>Guardar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal registro postulante -->

                <!--Modal save postulante -->
                <div class="modal modal-primary" id="modal_save_postulante" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>Usted se ha registrado correctamente. Inicie sesión para continuar con el proceso de
                                    inscripción...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-primary"
                                    data-dismiss="modal">Cerrar</button>
                                {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save postulante -->



                <!--Modal save postulante -->
                <div class="modal modal-warning" id="modal_warning" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>No se permiten registros nuevos...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-warning"
                                    data-dismiss="modal">Cerrar</button>
                                {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save postulante -->

            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">

                    <h2 class="color-primary text-center" style="font-size:25px;"><strong><span
                                style="font-size: 30px;">SISTEMA DE INFORMACION PARA LA GESTIÓN ADMINISTRATIVA
                                “ENAE”</span> </strong></h2>
                    <p style="text-align: justify;padding-bottom: 15px;">
                        Bienvenidos al nuevo portal del Sistema de Información para la Gestión Administrativa - ENAE. La
                        información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será
                        responsable de la Información presentada.
                    </p>
                    <p style="text-align: justify;">Para más información sobre el procedimiento de postulación descargue
                        el siguiente <a target="_blank"
                            href="adminpanel/archivos/documentos/enae_manual_de_usuario_del_sistema_de_informacion_para_la_gestion_administrativa_v1.pdf"><strong>Manual
                                de usuario del Sistema de Información para la Gestión Administrativa -
                                ENAE</strong></a>.</p>
                    {% if config.global.xAbrevIns == 'ASPEFEEN' %}
                    <div class="heading-title heading-border-bottom heading-color">
                        <h4 class="panel-title">Las consultas se pueden realizar por los siguientes medios: </h4>
                    </div>
                    <div>
                        <h5>
                            <p style="text-align: justify;">Enviando un correo electrónico a:</p>
                        </h5>
                        <ul style="list-style-type: disc;">
                            <i class="fa fa-envelope"></i>&nbsp&nbsp&nbsp Email: <a
                                href="mailto:aspefeen.oficial@gmail.com">aspefeen.oficial@gmail.com</a> <br />

                        </ul>
                        <h5>
                            <p style="text-align: justify;">Llamando al celular:</p>
                        </h5>
                        <ul style="list-style-type: disc;">
                            <i class="fa fa-phone"></i> &nbsp&nbsp&nbsp +51 953555276 (Consultas Administrativas) <br />

                        </ul>

                        <!-- <h5>
                            <p style="text-align: justify;">Via Whatsapp:</p>
                        </h5>

                        <ul style="list-style-type: disc;">
                            <i class="fa fa-whatsapp"></i>&nbsp&nbsp&nbsp <a
                                href="https://api.whatsapp.com/send?phone=+51955272733"> +51 955272733 (Soporte
                                Técnico)</a><br />
                        </ul> -->
                    </div>
                    {% endif %}

                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->

{% endblock %}