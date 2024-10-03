{% block content %}
<div class="container">
    <hr> 
        <img class="card-img-top" src="https://www.unca.edu.pe/adminpanel/imagenes/web/login-tramite-documentario.jpg" alt="" height="150">
          <div class="row">        
        <div class="col-xl-12 order-xl-1">             
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <h1 class="color-primary text-center">REGISTRO DEL REMITENTE</h1>
                    {{ form('web/saveEmpresaPublico','method':
                    'post','id':'form_registro_empresa_publico','class':'form-horizontal','enctype':'multipart/form-data')
                    }}
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <h3 class="color-primary" style="display: none;" id="pj-titulo">Institución o
                                    Empresa:</h3>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -50px;">

                            <div class="col-md-3">
                                <div class="row form-group" id="select_documento">
                                    <label for="input-tipo_persona" class="control-label">Tipo de Persona</label>
                                    <select id="input-tipo_persona" class="form-control selectpicker" name="documento">
                                        <option value="1">Persona Natural</option>
                                        <option value="2">Persona Juridica</option>
                                        <option value="3">Entidad Pública</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" style="display: none;" id="pj-ruc">
                                <div class="row form-group" style="margin-top:35px;">
                                    <label for="input-ruc" class="control-label">Número de RUC:</label>
                                    <input type="text" class="form-control" id="input-ruc" placeholder="" name="ruc">
                                </div>
                            </div>

                            <div class="col-md-1" style="display: none;" id="pj-search">
                                <div class="row form-group" style="margin-top:60px;">
                                    <button type="button" class="btn btn-block btn-raised btn-primary"
                                        id="btn-buscar_empresa" style="padding-right: 10px;padding-left: 20px;"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="col-md-4" style="display: none;" id="pj-razon_social">
                                <div class="row form-group" style="margin-top:35px;">
                                    <label for="input-razon_social" class="control-label">Razón Social</label>
                                    <input type="text" class="form-control" id="input-razon_social" placeholder=""
                                        name="razon_social">
                                    <input type="hidden" id="input-id_empresa" name="id_empresa" value="">
                                </div>
                            </div>

                            <div class="col-md-1" style="display: none;" id="pj-agregar_empresa">
                                <div class="row form-group" style="margin-top:60px;">
                                    <button type="button" class="btn btn-block btn-raised btn-primary"
                                        id="btn-agregar_empresa" style="padding-right: 10px;padding-left: 20px;"
                                        onclick="registro_empresa();"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h3 class="color-primary">Datos de la persona que firma el documento:</h3>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -50px;">

                            <div class="col-md-3">
                                <div class="row form-group" id="select_documento">
                                    <label for="input_documento" class="control-label">Tipo Documento:</label>
                                    <select id="input_documento_select" class="form-control selectpicker"
                                        name="documento">
                                        <option value="">SELECCIONE...</option>
                                        {% for tipodocumento_select in tipodocumentos %}
                                        <option value="{{ tipodocumento_select.codigo }}">{{
                                            tipodocumento_select.nombres }}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row form-group" style="margin-top:35px;">
                                    <label for="input-nro_doc" class="control-label">Número de doc</label>
                                    <input type="text" class="form-control" id="input-nro_doc" placeholder=""
                                        name="nro_doc">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row form-group" style="margin-top:60px;">
                                    <button type="button" class="btn btn-block btn-raised btn-primary"
                                        id="btn-buscar_publico" style="padding-right: 10px;padding-left: 20px;"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row form-group" style="margin-top:35px;">
                                    <label for="input-nombres" class="control-label">Apellidos y Nombres</label>
                                    <input type="text" class="form-control" id="input-nombres" placeholder=""
                                        name="nombres">
                                    <input type="hidden" id="input-id_publico" name="id_publico" value="">
                                </div>
                            </div>


                            <div class="col-md-1">
                                <div class="row form-group" style="margin-top:60px;">
                                    <button type="button" class="btn btn-block btn-raised btn-primary"
                                        id="btn-agregar_publico" style="padding-right: 10px;padding-left: 20px;"
                                        onclick="registro_publico();"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: -30px;">
                            <div class="col-md-3" style="display: none;" id="ep-cargo">
                                <div class="row form-group" id="select_documento">
                                    <label for="input_documento" class="control-label">Cargo:</label>
                                    <select id="input-cargo" class="form-control selectpicker" name="cargo">
                                        <option value="">SELECCIONE...</option>
                                        {% for cargos_select in cargos %}
                                        <option value="{{ cargos_select.codigo }}">{{
                                            cargos_select.nombres }}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-9" style="display: none;" id="ep-area">
                                <div class="row form-group" style="margin-top:35px;">
                                    <label for="input-area" class="control-label">Área</label>
                                    <input type="text" class="form-control" id="input-area" placeholder="" name="area">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="input-email" class="control-label">Email</label>
                                    <input type="email" class="form-control" id="input-email" placeholder=""
                                        name="email">
                                </div>
                            </div>

                        </div>

                        <div class="row" style="margin-top: -30px;">

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="input-password" class="control-label">Contraseña</label>
                                    <input type="password" class="form-control" id="input-password" placeholder=""
                                        name="password">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="input-password_2" class="control-label">Repetir Contraseña</label>
                                    <input type="password" class="form-control" id="input-password2" placeholder=""
                                        name="password">
                                </div>
                            </div>
                        </div>


                        <div class="row" style="margin-top: -30px;">

                            <div class="col-md-12">
                                <div class="form-group row">                                  
                                    <input type="checkbox" class="form-check-input" id="chkPolitica" placeholder="" name="chkPolitica" required>
                                    <label for="input_politica" class="form-label"> &nbsp; He leido la <a target="_blank" href="{{ url() }}politica-privacidad.html">Política de Protección de Datos</a> de la Universidad Nacional Ciro ALegría</label>
                                  
                                </div>
                            </div>

                            </div>
                       
                    </div>
                    {{ endForm() }}

                    <button type="button" class="btn btn-block btn-raised btn-primary"
                        id="btn-grabar_empresa_publico"><i class="fa fa-save"></i>Guardar</button>

                <!--

                    <h2 class="color-primary text-center" style="font-size:25px;"><strong><span
                                style="font-size: 30px;">PROTECCIÓN DE DATOS PERSONALES</strong></h2>
                    <p style="text-align: justify;padding-bottom: 15px;">

                        En cumplimiento de lo dispuesto por la Ley N° 29733, Ley de Protección de Datos Personales, le
                        informamos que los datos personales que usted nos proporcione serán utilizados y/o tratados por
                        el Indecopi (por sí mismo o a través de terceros), estricta y únicamente para la atención de los
                        servicios que realice la Mesa de Partes de nuestra Institución, pudiendo ser incorporados en un
                        banco de datos personales de titularidad del Indecopi. Los datos personales proporcionados se
                        mantendrán almacenados mientras su uso y tratamiento sean necesarios para cumplir con las
                        finalidades anteriormente descritas. Se informa que el Indecopi podría compartir y/o usar y /o
                        almacenar y/o transferir dicha información a terceras personas, estrictamente con el objeto de
                        realizar las actividades antes mencionadas. Usted podrá ejercer sus derechos de información,
                        acceso, rectificación, cancelación y oposición de sus datos personales, en cualquier momento, a
                        través de una solicitud simple presentada por este portal.
                    </p>

                -->



                </div>

                <!--Modal empresa -->
                <div class="modal modal-primary" id="modal_registro_empresa" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel4">Registro de Empresa / Institución</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                            <div class="modal-body">
                                {#<p>Se registro postulante correctamente...</p>#}
                                {{ form('web/saveEmpresaTramiteDocumentario','method':
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
                                        <div class="col-md-8">
                                            <div class="row form-group">
                                                <label for="input_email" class="control-label">Email:</label>
                                                <input type="email" class="form-control" id="input_email_empresa"
                                                    placeholder="" name="email">
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
                                <p>Se ha registrado correctamente. Inicie sesión para continuar...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-raised btn-primary"
                                    data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save empresa -->

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
                                {{ form('web/savePublicoTramiteDocumentario','method':
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
                                                    <option value="">SELECCIONE...</option>
                                                    {% for tipodocumento_select in tipodocumentos %}

                                                    <option value="{{ tipodocumento_select.codigo }}">{{
                                                        tipodocumento_select.nombres }}</option>

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
                                                    {% for sexo_select in sexo %}
                                                    <option value="{{ sexo_select.codigo }}">{{ sexo_select.nombres }}
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

                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label for="input_email_publico" class="control-label">Email
                                                    Personal:</label>
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

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save publico -->


                <!--Modal save empresa publico-->
                <div class="modal modal-primary" id="modal_save_empresa_publico" tabindex="-1" role="dialog"
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

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin modal save empresa -->

            </div>
        </div>
    </div>
</div> <!-- container -->
{% endblock %}