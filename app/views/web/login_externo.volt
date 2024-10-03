{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    {#<h1 class="color-primary text-center">Inicio de Sesión</h1>#}
                    <center>{{ image("webpage/assets/img/logo.png", "alt":"UNCA") }}</center>
                    <br>
                    {{ form('web/loginExterno','method': 'post','id':'form_sesion_perfiles','class':'form-horizontal')
                    }}
                    <fieldset>
                        <div class="row form-group" style="margin-bottom: -20px !important; margin-top: 5px;">
                            <label for="inputGen" class="col-md-4 control-label"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Tipo de
                                usuario</label>
                            <div class="col-md-8">
                                <select id="input_tipousuario_select_form_sesion_perfiles" class="form-control"
                                    name="tipousuario">
                                    <option value="">Seleccione...</option>
                                    <option value="1">Ciudadano(a)</option>
                                    <option value="2">Institución / Empresa</option>

                                </select>
                                <input type="hidden" name="select_tipo_usuario" value="" id="select_tipo_usuario">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom: -10px !important;">
                            <label for="inputEmail-ñogin" class="col-md-4 control-label" id="label_change"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Nro.
                                DNI</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="input_nro_doc_form_sesion_perfiles"
                                    placeholder="Ingrese su número de DNI" name="nro_doc">
                                <input type="hidden" name="csrf" value="{{ security.getToken() }}">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom: -5px !important;">
                            <label for="inputPassword-login" class="col-md-4 control-label"
                                style="font-size: 14px !important;text-align: left;padding-top: 1px !important;">Contraseña</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="input_password_form_sesion_perfiles"
                                    placeholder="Contraseña" name="password">
                            </div>
                        </div>
                    </fieldset>
                    {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                    <button class="btn btn-raised btn-primary btn-block" type="button" id="btn_login_perfiles"
                        style="margin-top: 20px!important;">Entrar <i
                            class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                    <a href="javascript:void(0);" class="btn btn-raised btn-primary btn-block"
                        onclick="registro_publico();">Registro de Ciudadano / a <i
                            class="zmdi zmdi-account-add no-mr ml-1"></i></a>
                    <a href="javascript:void(0);" class="btn btn-raised btn-primary btn-block"
                        onclick="registro_empresa();">Registro de Empresa<i class="zmdi zmdi-home no-mr ml-1"></i></a>

                    {{ endForm() }}
                    <div class="text-center mt-4" style="margin-top: 24px!important;">

                        <a href="{{ url('recuperar-contrasenha-web-externo.html') }}">Recuperar Contraseña</a>

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

                <!--Modal publico -->
                <div class="modal modal-primary" id="modal_registro_publico" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Registro de Ciudadano / a</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                {#<p>Se registro postulante correctamente...</p>#}
                                {{ form('web/savePublicoLoginExterno','method':
                                'post','id':'form_registro_publico','class':'form-horizontal','enctype':'multipart/form-data')
                                }}


                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_documento">
                                                <label for="input_documento" class="control-label">Tipo
                                                    Documento:</label>
                                                <select id="input_documento_select" class="form-control selectpicker"
                                                    name="documento" style="pointer-events: none;">

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
                                                <input type="text" class="form-control" id="input_nro_doc_modal"
                                                    placeholder="" name="nro_doc_registro_publico"
                                                    style="margin-top: 9px !important;">
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
                                                <label for="input_email_publico" class="control-label">Email:</label>
                                                <input type="email" class="form-control" id="input_email_publico"
                                                    placeholder="" name="email_publico_registro"
                                                    style="margin-top: 9px !important;">
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
                                                <label for="input_ciudad" class="control-label">Ciudad</label>
                                                <input type="text" class="form-control" id="input_ciudad" placeholder=""
                                                    name="ciudad">
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


                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_region"
                                                style="margin-top: 18px !important;">
                                                <label for="input_region" class="control-label">Región </label>

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
                                            <div class="row form-group" id="select_provincia"
                                                style="margin-top: 18px !important;">
                                                <label for="input_provincia" class="control-label">Provincia </label>

                                                <select id="input_provincia_select" class="form-control selectpicker"
                                                    name="provincia">
                                                    <option value="">SELECCIONE...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_distrito"
                                                style="margin-top: 18px !important;">
                                                <label for="input_distrito" class="control-label">Distrito </label>

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
                                                    {#style="margin-top: 9px !important;" #}>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_referencia" class="control-label">Referencia</label>
                                                <input type="text" class="form-control" id="input_referencia"
                                                    placeholder="" name="referencia">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_referencia" class="control-label">Referencia</label>
                                                <input type="text" class="form-control" id="input_referencia_empresa"
                                                    placeholder="" name="referencia">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_tipo"
                                                style="margin-top: 18px !important;">
                                                <label for="input_tipo" class="control-label">Tipo Persona </label>

                                                <select id="input_tipo_select" class="form-control selectpicker"
                                                    name="tipo">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipo_persona_select in tipo_persona %}
                                                    <option value="{{ tipo_persona_select.codigo }}">
                                                        {{tipo_persona_select.nombres }}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password" class="control-label">Contraseña</label>
                                                <input type="password" class="form-control"
                                                    id="input_password_publico_modal" placeholder="" name="password">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password_2" class="control-label">Repetir
                                                    Contraseña</label>
                                                <input type="password" class="form-control"
                                                    id="input_password_publico_repeat_modal" placeholder=""
                                                    name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ endForm() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i>Cancelar</button>
                                <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_publico"><i
                                        class="fa fa-save"></i>Guardar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal registro publico -->

                <!--Modal save publico -->
                <div class="modal modal-primary" id="modal_save_publico" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>Usted se ha registrado correctamente. Inicie sesión par continuar...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-primary"
                                    data-dismiss="modal">Cerrar</button>
                                {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save publico -->

                <!--Modal empresa -->
                <div class="modal modal-primary" id="modal_registro_empresa" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Registro de Empresa</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                {#<p>Se registro postulante correctamente...</p>#}
                                {{ form('web/saveEmpresaLoginExterno','method':
                                'post','id':'form_registro_empresa','class':'form-horizontal','enctype':'multipart/form-data')
                                }}


                                <div class="container-fluid">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_nro_doc" class="control-label">Número RUC:</label>
                                                <input type="text" class="form-control" id="input_nro_ruc"
                                                    placeholder="" name="ruc">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_nro_doc" class="control-label">Razón Social:</label>
                                                <input type="text" class="form-control" id="input_razon_social"
                                                    placeholder="" name="razon_social">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_representante"
                                                    class="control-label">Representante:</label>
                                                <input type="text" class="form-control" id="input_representante"
                                                    placeholder="" name="representante">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_telefono" class="control-label">Telefono:</label>
                                                <input type="text" class="form-control" id="input_telefono"
                                                    placeholder="" name="telefono">
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <div class="row form-group">
                                                <label for="input_email" class="control-label">Email:</label>
                                                <input type="email" class="form-control" id="input_email_empresa"
                                                    placeholder="" name="email_empresa_registro">
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <label for="input_direccion_empresa"
                                                    class="control-label">Dirección</label>
                                                <input type="text" class="form-control" id="input_direccion_empresa"
                                                    placeholder="" name="direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <label for="input_direccion_empresa" class="control-label">Giro</label>
                                                <input type="text" class="form-control" id="input_giro" placeholder=""
                                                    name="direccion">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_fecha_registro" class="control-label">Fecha
                                                    Registro</label>
                                                <input id="datePicker1" type="text" class="form-control"
                                                    name="fecha_registro" placeholder="dd/mm/yyyy">
                                            </div>

                                        </div>
                                        <div class="col-md-8">
                                            <div class="row form-group">
                                                <label for="input_cta_cte_detraccion" class="control-label">Nro. Cta Cte
                                                    Detracciones</label>
                                                <input type="text" class="form-control" id="input_cta_cte_detraccion"
                                                    placeholder="" name="cta_cte_detraccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_cci" class="control-label">CCI</label>
                                                <input type="text" class="form-control" id="input_cci" placeholder=""
                                                    name="cci">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_cargo" class="control-label">Cargo</label>
                                                <input type="text" class="form-control" id="input_cargo" placeholder=""
                                                    name="cargo">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_nro_doc" class="control-label">Doc Identidad</label>
                                                <input type="text" class="form-control" id="input_nro_doc"
                                                    placeholder="" name="nro_doc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_fax" class="control-label">Telefono Fax</label>
                                                <input type="text" class="form-control" id="input_fax" placeholder=""
                                                    name="fax">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_celular" class="control-label">Celular</label>
                                                <input type="text" class="form-control" id="input_celular_empresa"
                                                    placeholder="" name="celular">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_pais" class="control-label">Pais</label>
                                                <input type="text" class="form-control" id="input_pais" placeholder=""
                                                    name="pais" value="Perú" readonly="">
                                            </div>
                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_region"
                                                style="margin-top: 18px !important;">
                                                <label for="input_region" class="control-label">Región </label>

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
                                            <div class="row form-group" id="select_provincia"
                                                style="margin-top: 18px !important;">
                                                <label for="input_provincia" class="control-label">Provincia </label>

                                                <select id="input_provincia_select" class="form-control selectpicker"
                                                    name="provincia">
                                                    <option value="">SELECCIONE...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row form-group" id="select_distrito"
                                                style="margin-top: 18px !important;">
                                                <label for="input_distrito" class="control-label">Distrito </label>

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
                                                    {#style="margin-top: 9px !important;" #}>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_referencia" class="control-label">Referencia</label>
                                                <input type="text" class="form-control" id="input_referencia"
                                                    placeholder="" name="referencia">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_referencia" class="control-label">Referencia</label>
                                                <input type="text" class="form-control" id="input_referencia_empresa"
                                                    placeholder="" name="referencia">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row form-group" id="select_tipo"
                                                style="margin-top: 18px !important;">
                                                <label for="input_tipo" class="control-label">Tipo Persona </label>

                                                <select id="input_tipo_select" class="form-control selectpicker"
                                                    name="tipo">
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipo_persona_select in tipo_persona %}
                                                    <option value="{{ tipo_persona_select.codigo }}">
                                                        {{tipo_persona_select.nombres }}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="boleta"> <span
                                                        class="ml-2">Boleta</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="factura"> <span
                                                        class="ml-2">Factura</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="rnp"> <span class="ml-2">RNP</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="mype"> <span class="ml-2">Mype</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="entidad_publica"> <span
                                                        class="ml-2">Entidad Publica</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="row form-group" id="input-archivo_ruc">
                                                <label for="inputFile" class="control-label">Archivo Ruc</label>
                                                <input type="text" readonly="" class="form-control"
                                                    placeholder="Buscar..." name="archivo_ruc">
                                                <input type="file" id="inputFile1" multiple="" name="archivo_ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group" id="input-archivo_rnp">
                                                <label for="inputFile" class="control-label">Archivo RNP</label>
                                                <input type="text" readonly="" class="form-control"
                                                    placeholder="Buscar..." name="archivo_rnp">
                                                <input type="file" id="inputFile2" multiple="" name="archivo_rnp">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password" class="control-label">Contraseña</label>
                                                <input type="password" class="form-control"
                                                    id="input_password_empresa_modal" placeholder="" name="password">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="input_password_2" class="control-label">Repetir
                                                    Contraseña</label>
                                                <input type="password" class="form-control"
                                                    id="input_password_empresa_repeat_modal" placeholder=""
                                                    name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ endForm() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i>Cancelar</button>
                                <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_empresa"><i
                                        class="fa fa-save"></i>Guardar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal registro empresa -->

                <!--Modal save empresa -->
                <div class="modal modal-primary" id="modal_save_empresa" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4">
                    <div class="modal-dialog animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <p>Se ha registrado correctamente. Inicie sesión par continuar...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-primary"
                                    data-dismiss="modal">Cerrar</button>
                                {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save empresa -->


            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card card-primary animated fadeInUp animation-delay-7"
                style="padding-top: -30px;padding-bottom: 55px;">
                <div class="card-body">
                    <h3 class="color-primary text-center"><strong>SISTEMA DE INFORMACION PARA LA GESTION DE LA EDUCACIÓN
                            SUPERIOR UNIVERSITARIA</strong></h3>
                    {#<center>
                        <h1><strong>SIGADU</strong></h1>
                    </center>#}
                    <div class="card" style="box-shadow: none !important;">
                        <ul class="list-group">
                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-user"></i>Trámite Documentario</li>
                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-user"></i>Bolsa de Trabajo</li>
                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-user"></i>Biblioteca</li>
                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-book"></i>Mesa de Ayuda</li>
                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-book"></i>Proyección Social</li>
                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-user"></i>Gestión Administrativa</li>

                            <li class="list-group-item" style="border: none !important;"><i
                                    class="color-warning fa fa-book"></i>Gestión de Proyectos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->
{% endblock %}