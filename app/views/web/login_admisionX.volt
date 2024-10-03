{% block content %}
    <div class="container">
        <div class="row">
            <div class="col-xl-5 order-xl-2">
                <div class="card card-primary animated fadeInUp animation-delay-7"  style="padding-top: 25px;">
                    <div class="card-body">
                        <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>

                        {{ form('web/loginAdmision','method': 'post','id':'form_sesion_postulantes','class':'form-horizontal') }}
                        <fieldset>
                            {#<div class="row form-group">
                                <label for="inputGen" class="col-md-3 control-label">Tipo de usuario</label>
                                <div class="col-md-9">
                                    <select id="input-tipousuario" class="form-control selectpicker" name="tipousuario">
                                        <option value="1">Estudiante</option>
                                        <option value="2">Docente</option>
                                        <option value="3">Administrativo</option>
                                        <option value="4">Empresa</option>
                                        <option value="5">Público</option>
                                    </select>
                                </div>
                            </div>#}
                            <div class="form-group row">
                                <label for="inputEmail-ñogin" class="col-md-4 control-label" style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Nro. DNI</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="input_nro_doc_login" placeholder="Ingrese su número de DNI" name="nro_doc_login">
                                    <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword-login" class="col-md-4 control-label" style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Contraseña</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="input_password_login" placeholder="Contraseña" name="password_login">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                        <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_postulantes">Iniciar Sesión <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>

                        {{ endForm() }}
                        <div class="text-center mt-1">
                            {# <h3>Recuperar Contraseña</h3>#}
                            <a href="{{ url('recuperar-contrasenha-web-externo.html') }}">Recuperar Contraseña</a>

                        </div>
                        <br>
                        <a href="javascript:void(0);"class="btn btn-raised btn-primary btn-block" onclick="agregar();">Regístrate <i class="zmdi zmdi-account-add no-mr ml-1"></i></a>
                    </div>


                    <!--Modal alerta campo vacio -->
                    <div class="modal modal-warning" id="modal_campo_vacio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
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

                    <!--Modal postulante -->
                    <div class="modal modal-primary" id="modal_registro_postulante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Registro de Postulantes</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    {#<p>Se registro postulante correctamente...</p>#}
                                    {{ form('web/savePostulante','method': 'post','id':'form_registro_postulante','class':'form-horizontal','enctype':'multipart/form-data') }}


                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group" id="select_documento">
                                                    <label for="input_documento" class="control-label" >Tipo Documento:</label>
                                                    <select id="input_documento_select" class="form-control selectpicker" name="documento">
                                                        <option value="">SELECCIONE...</option>   
                                                        {% for tipodocumento_model in tipodocumentos %}
                                                            <option value="{{ tipodocumento_model.codigo }}">{{ tipodocumento_model.nombres }}</option>                                      
                                                        {% endfor %}
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_nro_doc" class="control-label">Número Documento:</label>
                                                    <input type="text" class="form-control" id="input_nro_doc" placeholder="" name="nro_doc">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_fecha_nacimiento" class="control-label">Fecha de Nacimiento:</label>
                                                    <input id="datePicker1" type="text" class="form-control" name="fecha_nacimiento" placeholder="dd/mm/yyyy">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_apellidop" class="control-label">Apellido Paterno:</label>
                                                    <input type="text" class="form-control" id="input_apellidop" placeholder="" name="apellidop">

                                                </div>


                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_apellidom" class="control-label">Apellido Materno:</label>
                                                    <input type="text" class="form-control" id="input_apellidom" placeholder="" name="apellidom">
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_nombres" class="control-label">Nombres:</label>
                                                    <input type="text" class="form-control" id="input_nombres" placeholder="" name="nombres">
                                                    <input type="hidden" id="input_codigo" name="codigo" value="{{ codigo_nuevo_postulante }}">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="row form-group" id="select_region">
                                                    <label for="input_region" class="control-label">Región (Actual)</label>

                                                    <select id="input_region_select" class="form-control selectpicker" name="region">
                                                        <option value="">SELECCIONE...</option>   
                                                        {% for region_model in regiones %}
                                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                        {% endfor %}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row form-group" id="select_provincia">
                                                    <label for="input_provincia" class="control-label">Provincia (Actual)</label>

                                                    <select id="input_provincia_select" class="form-control selectpicker" name="provincia">
                                                        <option value="">SELECCIONE...</option>   
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row form-group" id="select_distrito">
                                                    <label for="input_distrito" class="control-label">Distrito (Actual)</label>

                                                    <select id="input_distrito_select" class="form-control selectpicker" name="distrito">
                                                        <option value="">SELECCIONE...</option>   
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row form-group">
                                                    <label for="input_ubigeo" class="control-label">Nro ubigeo</label>

                                                    <input type="text" class="form-control" id="input_ubigeo" placeholder="Ubigeo" name="ubigeo">

                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row form-group">
                                                    <label for="input_direccion" class="control-label">Dirección</label>
                                                    <input type="text" class="form-control" id="input_direccion" placeholder="" name="direccion">
                                                </div>                                            
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_ciudad" class="control-label">Ciudad</label>
                                                    <input type="text" class="form-control" id="input_ciudad" placeholder="" name="ciudad"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="inputFile" class="control-label">Foto</label>
                                                    <input type="text" readonly="" class="form-control" placeholder="Buscar..." name="foto">
                                                    <input type="file" id="inputFile" multiple="" name="foto">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group" id="select_sexo">
                                                    <label for="input_documento" class="control-label" >Sexo:</label>
                                                    <select id="input_sexo_select" class="form-control selectpicker" name="sexo">
                                                        <option value="">SELECCIONE...</option>   
                                                        {% for sexo_model in sexo %}
                                                            <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>   
                                                        {% endfor %}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group" id="select_seguro">
                                                    <label for="input_seguro" class="control-label">Seguro:</label>
                                                    <select id="input_seguro_select" class="form-control selectpicker" name="seguro">
                                                        <option value="">SELECCIONE...</option>   
                                                        {% for seguro_model in seguro %}
                                                            <option value="{{ seguro_model.codigo }}">{{ seguro_model.nombres }}</option>   
                                                        {% endfor %}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_email" class="control-label">Email:</label>
                                                    <input type="email" class="form-control" id="input_email" placeholder="" name="email" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_telefono" class="control-label">Teléfono:</label>
                                                    <input type="text" class="form-control" id="input_telefono" placeholder="" name="telefono"> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <label for="input_celular" class="control-label">Celular:</label>                                                
                                                    <input type="text" class="form-control" id="input_celular" placeholder="" name="celular">    
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="input_observaciones" class="control-label">Observaciones</label>
                                                    <textarea class="form-control" rows="3" id="input_observaciones" name="observaciones"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="colegio_publico"> <span class="ml-2">Colegio Público</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="input_colegio_nombre" class="control-label">Nombre de Colegio</label>
                                                    <input type="text" class="form-control" id="input_colegio_nombre" placeholder="" name="colegio_nombre">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sitrabaja"> <span class="ml-2">Si Trabaja</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="input_sitrabaja_nombre" class="control-label">Si Trabaja</label>
                                                    <input type="text" class="form-control" id="input_sitrabaja_nombre" placeholder="" name="sitrabaja_nombre">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row form-group">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sidepende"> <span class="ml-2">Si Depende</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="input_sidepende" class="control-label">Si Depende</label>
                                                    <input type="text" class="form-control" id="input_sidepende_nombre" placeholder="" name="sidepende_nombre">
                                                </div>
                                            </div>
                                        </div>                                      

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="row form-group" id="select_region1">
                                                    <label for="input_region1" class="control-label">Región (Lugar de Procedencia)</label>
                                                    <select id="input_region1_select" class="form-control selectpicker" name="region1">
                                                        <option value="">SELECCIONE...</option>   
                                                        {% for region_model in regiones %}
                                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                        {% endfor %}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row form-group" id="select_provincia1">
                                                    <label for="input_provincia1" class="control-label">Provincia (Lugar de Procedencia)</label>
                                                    <select id="input_provincia1_select" class="form-control selectpicker" name="provincia1">
                                                        <option value="">SELECCIONE...</option>   
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="row form-group" id="select_distrito1">
                                                    <label for="input_distrito1" class="control-label">Distrito (Lugar de Procedencia)</label>
                                                    <select id="input_distrito1_select" class="form-control selectpicker" name="distrito1">
                                                        <option value="">SELECCIONE...</option>   
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row form-group">
                                                    <label for="input_ubigeo1" class="control-label">Nro ubigeo</label>

                                                    <input type="text" class="form-control" id="input_ubigeo1" placeholder="" name="ubigeo1">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="input_localidad" class="control-label">Localidad</label>

                                                    <input type="text" class="form-control" id="input_localidad" placeholder="" name="localidad">

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="discapacitado"> <span class="ml-2">Discapacidad</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <label for="input_discapacitado_nombre" class="control-label">Nombre discapacidad</label>
                                                    <input type="text" class="form-control" id="input_discapacitado_nombre" placeholder="" name="discapacitado_nombre">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="input_password" class="control-label">Contraseña</label>
                                                    <input type="password" class="form-control" id="input_password" placeholder="" name="password">
                                                </div>
                                            </div> 

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="input_password_2" class="control-label">Repetir Contraseña</label>
                                                    <input type="password" class="form-control" id="input_password2" placeholder="" name="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{ endForm() }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
                                    <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_postulantes"><i class="fa fa-save"></i>Guardar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin modal registro postulante --> 

                    <!--Modal save postulante -->
                    <div class="modal modal-primary" id="modal_save_postulante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Usted se ha registrado correctamente. Inicie sesión par continuar con el proceso de inscripción...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal">Cerrar</button>
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
                        <h2 class="color-primary text-center"><strong>SISTEMA DE GESTIÓN UNIVERSITARIA</strong></h2>
                        <h2 class="color-primary text-center">ADMISIÓN</h2>
                        <p>Cronograma:</p>
                        <div class="card" style="box-shadow: none !important;">
                            <ul class="list-group">
                                <li class="list-group-item" style="border: none !important;"><i class="color-primary fa fa-home"></i>Gestión Institucional</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-success fa fa-user-plus"></i> Gestión de Personal</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-info fa fa-file-text"></i>Gestión de Documentos</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-danger fa fa-image"></i>Gestión  de Imagen Institucional</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-user"></i>Gestión de Convocatorias</li>
                                <li class="list-group-item" style="border: none !important;"><i class="color-warning fa fa-users"></i>Gestión de Convenios</li>
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