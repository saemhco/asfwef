{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-primary animated fadeInUp animation-delay-7" style="padding-top: 25px;">
                <div class="card-body">
                    <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>

                    {{ form('web/loginConvocatoriasDocentes','method':
                    'post','id':'form_sesion_convocatorias','class':'form-horizontal') }}
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
                    <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login">Iniciar Sesión <i
                            class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                    {{ endForm() }}
                    <div class="text-center mt-1">
                        {# <h3>Recuperar Contraseña</h3>#}
                        <a href="{{ url('recuperar-contrasenha-web-externo2.html') }}">Recuperar Contraseña</a>

                    </div>
                    <br>
                    <a href="javascript:void(0);" class="btn btn-raised btn-primary btn-block"
                        onclick="agregar();">Regístrate <i class="zmdi zmdi-account-add no-mr ml-1"></i></a>
                    <br>
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
                                <h3 class="modal-title" id="myModalLabel4">Registro de Postulantes</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                {#<p>Se registro postulante correctamente...</p>#}
                                {{ form('web/savePublicoConvocatorias','method':
                                'post','id':'form_registro_convocatorias','class':'form-horizontal','enctype':'multipart/form-data')
                                }}


                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_documento">
                                                <label for="input_documento" class="control-label">Tipo
                                                    Documento:</label>
                                                <select id="input_documento_select" class="form-control selectpicker"
                                                    name="documento">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipodocumento_select in tipodocumentos %}
                                                    {% if tipodocumento_select.codigo == 1 %}
                                                    <option value="{{ tipodocumento_select.codigo }}" selected>{{
                                                        tipodocumento_select.nombres }}</option>
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
                                                <label for="input_fecha_nacimiento" class="control-label">Fecha de
                                                    Nacimiento:</label>
                                                <input id="datePicker1" type="text" class="form-control"
                                                    name="fecha_nacimiento" placeholder="dd/mm/yyyy"
                                                    style="margin-top: 9px !important;">
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
                                                {#<input type="hidden" id="input_codigo" name="codigo"
                                                    value="{{ codigo_nuevo_publico }}">#}
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_email" class="control-label">Email:</label>
                                                <input type="email" class="form-control" id="input_email" placeholder=""
                                                    name="email" style="margin-top: 9px !important;">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_celular" class="control-label">Celular:</label>
                                                <input type="text" class="form-control" id="input_celular"
                                                    placeholder="" name="celular" style="margin-top: 9px !important;">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_nacionalidad" class="control-label">Nacionalidad:</label>
                                                <input type="text" class="form-control" id="input_nacionalidad"
                                                    placeholder="" name="nacionalidad" style="margin-top: 9px !important;">
                                            </div>
                                        </div>





                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <label for="input_direccion" class="control-label">Dirección</label>
                                                <input type="text" class="form-control" id="input_direccion"
                                                    placeholder="" name="direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_region">
                                                <label for="input_region" class="control-label">Región (Actual)</label>

                                                <select id="input_region_select" class="form-control selectpicker"
                                                    name="region">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for region_model in regiones %}
                                                    <option value="{{ region_model.region }}">{{
                                                        region_model.descripcion }}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_provincia">
                                                <label for="input_provincia" class="control-label">Provincia
                                                    (Actual)</label>

                                                <select id="input_provincia_select" class="form-control selectpicker"
                                                    name="provincia">
                                                    <option value="">SELECCIONE...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_distrito">
                                                <label for="input_distrito" class="control-label">Distrito
                                                    (Actual)</label>

                                                <select id="input_distrito_select" class="form-control selectpicker"
                                                    name="distrito">
                                                    <option value="">SELECCIONE...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row form-group">
                                                <label for="input_ubigeo" class="control-label">Nro ubigeo</label>

                                                <input type="text" class="form-control" id="input_ubigeo"
                                                    placeholder="Ubigeo" name="ubigeo"
                                                    style="margin-top: 9px !important;">

                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_ciudad" class="control-label">Ciudad</label>
                                                <input type="text" class="form-control" id="input_ciudad" placeholder=""
                                                    name="ciudad">
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_estado_civil">
                                                <label for="input_estado_civil" class="control-label">Estado
                                                    Civil:</label>
                                                <select id="input_estado_civil_select" class="form-control selectpicker"
                                                    name="estado_civil">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for estadocivil_select in estadocivil %}

                                                    <option value="{{ estadocivil_select.codigo }}">{{
                                                        estadocivil_select.nombres }}</option>


                                                    {% endfor %}
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_sexo">
                                                <label for="input_documento" class="control-label">Sexo:</label>
                                                <select id="input_sexo_select" class="form-control selectpicker"
                                                    name="sexo">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for sexo_model in sexo %}
                                                    <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}
                                                    </option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group" id="id_bonificacion">
                                                <label for="input_documento" class="control-label">Tipo de Bonificacion:</label>
                                                <select id="input-id_bonificacion" class="form-control selectpicker"
                                                    name="id_bonificacion">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipobonificaciones_model in tipobonificaciones %}
                                                    <option value="{{ tipobonificaciones_model.codigo }}">{{ tipobonificaciones_model.nombres }}
                                                    </option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" id="input-archivos" style="display:none;">
                                        <div class="col-md-12">
                                            <div class="row form-group">

                                                <label for="input_direccion" class="control-label" id="label_archivo">Discapacidad</label>

                
                                                <input type="text" class="form-control archivoFile"
                                                    placeholder="Buscar... (Archivo Menor a 2MB)">
                                                <input type="file" class="archivoFile">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password" class="control-label">Contraseña</label>
                                                <input type="password" class="form-control" id="input_password"
                                                    placeholder="" name="password">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password_2" class="control-label">Repetir
                                                    Contraseña</label>
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
                                <p>Usted se ha registrado correctamente. Inicie sesión par continuar con el proceso de
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
            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">

                    <h2 class="color-primary text-center" style="font-size:25px;"><strong><span style="font-size: 30px;">SISTEMA DE GESTIÓN ADMINISTRATIVA</span> “CONVOCATORIAS
                            DOCENTES</strong></h2>
                    <p style="text-align: justify;padding-bottom: 15px;">
                        Bienvenidos al nuevo portal de Gestión de Convocatoria Docente. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.                        
                    </p>
                    <p style="text-align: justify;">Para más información sobre el procedimiento de postulación descargue
                        el siguiente <a target="_blank"
                            href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-informacion-de-gestion-de-convocatorias-de-concurso-docente.pdf"><strong>Manual
                                de usuario del Sistema de Gestión de Convocatorias de la UNCA</strong></a>.</p>
                   
                    <div class="heading-title heading-border-bottom heading-color">
                        <h4 class="panel-title">Las consultas se pueden realizar por los siguientes medios: </h4>
                    </div>
                    <div>
                        <h5>
                            <p style="text-align: justify;">Enviando un correo electrónico a:</p>
                        </h5>
                        <ul style="list-style-type: disc;">
                            <i class="fa fa-envelope"></i>&nbsp&nbsp&nbsp Email: <a
                                href="mailto:informes@unca.edu.pe">seleccion.docente@unca.edu.pe</a> <br />

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