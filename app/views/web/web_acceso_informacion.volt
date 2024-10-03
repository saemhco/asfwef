{% block content %}
    <div class="container mt-6">
        <h1 class="font-light">ACCESO A LA INFORMACIÓN PÚBLICA</h1>
        {#<p class="lead color-primary">— Intelligent apps that help you do your best work. </p>#}
        <div class="panel panel-light panel-flat">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-transparent indicator-primary nav-tabs-full nav-tabs-5" role="tablist">
                <li class="nav-item wow fadeInDown animation-delay-6" role="presentation"><a href="#ciudadano" aria-controls="ciudadano" role="tab" data-toggle="tab" class="nav-link withoutripple active"><i class="zmdi zmdi-account"></i> <span class="d-none d-md-inline">CIUDADANO</span></a></li>
                <li class="nav-item wow fadeInDown animation-delay-4" role="presentation"><a href="#persona_natural" aria-controls="persona_natural" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-home"></i> <span class="d-none d-md-inline">PERSONA NATURAL</span></a></li>
                <li class="nav-item wow fadeInDown animation-delay-4" role="presentation"><a href="#persona_juridica" aria-controls="persona_juridica" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-home"></i> <span class="d-none d-md-inline">PERSONA JURÍDICA</span></a></li>
            </ul>
            <div class="panel-body">
                <!-- Tab panes -->
                <div class="tab-content mt-4">
                    <div role="tabpanel" class="tab-pane active show fade" id="ciudadano">
                        <div class="row">
                            <div class="col-xl-12 order-xl-1">
                                <div class="card card-primary animated fadeInUp animation-delay-7">
                                    <div class="card-body">
                                        {#<h1 class="color-primary text-center">LIBRO DE RECLAMACIONES</h1>#}
                                        {{ form('web/saveAccesoInformacion','method': 'post','id':'form_registro_ciudadano','class':'form-horizontal','enctype':'multipart/form-data') }}
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">I. Datos del solicitante</legend>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-nro_doc" class="control-label">Número Documento:</label>
                                                        <input type="text" class="form-control" id="input-nro_doc_ciudadano" placeholder="" name="nro_doc" maxlength="8">
                                                        <input type="hidden" id="input-tipo_ciudadano" name="tipo" value="1">
                                                        <input type="hidden" id="input-codigo_ciudadano" name="codigo" value="">
                                                    </div>

                                                </div>

                                                <div class="col-md-4" style="display: none;" id="input-registro_c">
                                                    <div class="form-group row justify-content-end">
                                                        <div class="col-lg-10">
                                                            <label for="input-nro_doc" class="control-label">Click aqui para registrarse</label>

                                                            <a href="javascript:void(0);"class="btn btn-raised btn-primary" onclick="registro_ciudadano();">Registrarse {#<i class="zmdi zmdi-account-add no-mr ml-1"></i>#}</a>

                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-apellidop" class="control-label">Apellido Paterno:</label>
                                                        <input type="text" class="form-control" id="input-apellidop_ciudadano" placeholder="" name="apellidop" value="" disabled>

                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-apellidom" class="control-label">Apellido Materno:</label>
                                                        <input type="text" class="form-control" id="input-apellidom_ciudadano" placeholder="" name="apellidom" disabled>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-nombres" class="control-label">Nombres:</label>
                                                        <input type="text" class="form-control" id="input-nombres_ciudadano" placeholder="" name="nombres" disabled>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-telefono" class="control-label">Teléfono:</label>
                                                        <input type="text" class="form-control" id="input-telefono_ciudadano" placeholder="" name="telefono" disabled> 
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-celular" class="control-label">Celular:</label>                                                
                                                        <input type="text" class="form-control" id="input-celular_ciudadano" placeholder="" name="celular" disabled>    
                                                    </div>
                                                </div> 

                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-email" class="control-label">Email:</label>
                                                        <input type="email" class="form-control" id="input-email_ciudadano" placeholder="" name="email" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row form-group">
                                                        <label for="input-direccion" class="control-label">Dirección</label>
                                                        <input type="text" class="form-control" id="input-direccion_ciudadano" placeholder="" name="direccion" disabled>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_region">
                                                        <label for="input-region" class="control-label">Región</label>

                                                        <select id="input-region_select_ciudadano" class="form-control selectpicker" name="region" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                            {% for region_model in regiones %}
                                                                <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_provincia">
                                                        <label for="input-provincia" class="control-label">Provincia</label>
                                                        <select id="input-provincia_select_ciudadano" class="form-control selectpicker" name="provincia" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_distrito">
                                                        <label for="input-distrito" class="control-label">Distrito</label>

                                                        <select id="input-distrito_select_ciudadano" class="form-control selectpicker" name="distrito" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row"> 
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">II. Informacion solicitada</legend>
                                                    <div class="row form-group">
                                                        <label for="input-informacion" class="control-label">Información solicitada</label>
                                                        <textarea class="form-control" rows="3" id="input-informacion_ciudadano" name="informacion"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">III. Dependencia de cual se requiere la informacion</legend>
                                                    <div class="row form-group" id="select_area">

                                                        <label for="input-distrito" class="control-label">Area</label>

                                                        <select id="input-area_select_ciudadano" class="form-control selectpicker" name="area" >
                                                            <option value="">SELECCIONE...</option>
                                                            {% for area_select in areas %}
                                                                <option value="{{ area_select.codigo }}">{{ area_select.nombres }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">IV. Forma de entrega de la Informacion</legend>
                                                    <div class="row form-group" id="select_medio">
                                                        <label for="input-medio" class="control-label">Medio de entrega</label>

                                                        <select id="input-medio_select_ciudadano" class="form-control selectpicker" name="medio" >
                                                            <option value="">SELECCIONE...</option>  
                                                            {% for  medio_entrega_select in  medio_entrega %}
                                                                <option value="{{  medio_entrega_select.codigo }}">{{  medio_entrega_select.nombres }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{ endForm() }}

                                        <button type="button" class="btn btn-block btn-raised btn-primary" id="btn_graba_ciudadano"><i class="fa fa-send"></i>Enviar</button>

                                    </div>

                                    <!--modal_save_ciudadano-->
                                    <div class="modal modal-primary" id="modal_save_ciudadano" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                                        <div class="modal-dialog animated zoomIn animated-3x" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal" id="btn_cerrar_confirmar">Cerrar</button>
                                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin modal_save_ciudadano-->  

                                    <!--modal_registro_ciudadano_nuevo-->
                                    <div class="modal modal-primary" id="modal_registro_ciudadano_nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel4">Registro de Persona Natural</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                                </div>
                                                <div class="modal-body">

                                                    {{ form('web/saveCiudadanoAccesoInformacion','method': 'post','id':'form_registro_ciudadano_nuevo','class':'form-horizontal','enctype':'multipart/form-data') }}


                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row form-group" id="select_documento_c">
                                                                    <label for="input_documento" class="control-label" >Tipo Documento:</label>
                                                                    <select id="input-documento_select" class="form-control selectpicker" name="documento" style="pointer-events: none;">

                                                                        {% for tipodocumento_select in tipodocumentos %}
                                                                            {% if tipodocumento_select.codigo == 1 %}
                                                                                <option value="{{ tipodocumento_select.codigo }}" selected>{{ tipodocumento_select.nombres }}</option>     
                                                                            {% endif %}
                                                                        {% endfor %}
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_nro_doc" class="control-label">Número Documento:</label>
                                                                    <input type="text" class="form-control" id="input-nro_doc_c" placeholder="" name="nro_doc" style="margin-top: 9px !important;" maxlength="8">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="row form-group" >
                                                                    <label for="input_documento" class="control-label" >Sexo:</label>
                                                                    <select id="input-sexo_select_c" class="form-control selectpicker" name="sexo">
                                                                        <option value="">SELECCIONE...</option>   
                                                                        {% for sexo_model in sexo %}
                                                                            <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>   
                                                                        {% endfor %}
                                                                    </select>
                                                                    <span id="select_sexo_c"></span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_apellidop" class="control-label">Apellido Paterno:</label>
                                                                    <input type="text" class="form-control" id="input-apellidop_c" placeholder="" name="apellidop">

                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_apellidom" class="control-label">Apellido Materno:</label>
                                                                    <input type="text" class="form-control" id="input-apellidom_c" placeholder="" name="apellidom">
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_nombres" class="control-label">Nombres:</label>
                                                                    <input type="text" class="form-control" id="input-nombres_c" placeholder="" name="nombres">
                                                                    {#<input type="hidden" id="input_codigo" name="codigo" value="{{ codigo_nuevo_publico }}">#}
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_email_publico" class="control-label">Email:</label>
                                                                    <input type="email" class="form-control" id="input-email_c" placeholder="" name="email" style="margin-top: 9px !important;">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_celular" class="control-label">Celular:</label>                                                
                                                                    <input type="text" class="form-control" id="input-celular_c" placeholder="" name="celular" style="margin-top: 9px !important;">    
                                                                </div>
                                                            </div> 

                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_ciudad" class="control-label">Ciudad</label>
                                                                    <input type="text" class="form-control" id="input-ciudad_c" placeholder="" name="ciudad"> 
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <label for="input_direccion" class="control-label">Dirección</label>
                                                                    <input type="text" class="form-control" id="input-direccion_c" placeholder="" name="direccion">
                                                                </div>                                            
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_region" style="margin-top: 18px !important;">
                                                                    <label for="input_region" class="control-label">Región </label>

                                                                    <select id="input-region_select_c" class="form-control selectpicker" name="region">
                                                                        <option value="">SELECCIONE...</option>   
                                                                        {% for region_model in regiones %}
                                                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                                        {% endfor %}
                                                                    </select>
                                                                    <span id="select_region_c"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_provincia" style="margin-top: 18px !important;">
                                                                    <label for="input_provincia" class="control-label">Provincia </label>

                                                                    <select id="input-provincia_select_c" class="form-control selectpicker" name="provincia">
                                                                        <option value="">SELECCIONE...</option>   
                                                                    </select>
                                                                    <span id="select_provincia_c"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_distrito" style="margin-top: 18px !important;">
                                                                    <label for="input_distrito" class="control-label">Distrito </label>

                                                                    <select id="input-distrito_select_c" class="form-control selectpicker" name="distrito">
                                                                        <option value="">SELECCIONE...</option>   
                                                                    </select>
                                                                    <span id="select_distrito_c"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group">
                                                                    <label for="input_ubigeo" class="control-label">Nro ubigeo</label>

                                                                    <input type="text" class="form-control" id="input-ubigeo_c" placeholder="Ubigeo" name="ubigeo" {#style="margin-top: 9px !important;"#}>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="input_password" class="control-label">Contraseña</label>
                                                                    <input type="password" class="form-control" id="input-password_1_c" placeholder="" name="password_1">
                                                                </div>
                                                            </div> 

                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="input_password_2" class="control-label">Repetir Contraseña</label>
                                                                    <input type="password" class="form-control" id="input-password_2_c" placeholder="" name="password_2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ endForm() }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
                                                    <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_c"><i class="fa fa-save"></i>Guardar</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin modal_registro_ciudadano_nuevo--> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--persona natural -->
                    <div role="tabpanel" class="tab-pane fade" id="persona_natural">
                        <div class="row">
                            <div class="col-xl-12 order-xl-1">
                                <div class="card card-primary animated fadeInUp animation-delay-7">
                                    <div class="card-body">
                                        {#<h1 class="color-primary text-center">LIBRO DE RECLAMACIONES</h1>#}
                                        {{ form('web/saveAccesoInformacion','method': 'post','id':'form_registro_persona_natural','class':'form-horizontal','enctype':'multipart/form-data') }}
                                        <div class="container-fluid">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">I. Datos del solicitante</legend>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-nro_doc" class="control-label">Número de RUC</label>
                                                        <input type="text" class="form-control" id="input-ruc_persona_natural" placeholder="" name="ruc" maxlength="11">
                                                        <input type="hidden" id="input-tipo" name="tipo" value="2">
                                                        <input type="hidden" id="input-codigo_persona_natural" name="codigo" value="">
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-apellidop" class="control-label">Razon Social</label>
                                                        <input type="text" class="form-control" id="input-razon_social_persona_natural" placeholder="" name="razon_social" disabled>

                                                    </div>

                                                </div>


                                                <div class="col-md-4" style="display: none;" id="input-registro_pn">
                                                    <div class="form-group row justify-content-end">
                                                        <div class="col-lg-10">
                                                            <label for="input-nro_doc" class="control-label">Click aqui para registrarse</label>

                                                            <a href="javascript:void(0);"class="btn btn-raised btn-primary" onclick="registro_persona_natural();">Registrarse {#<i class="zmdi zmdi-account-add no-mr ml-1"></i>#}</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-md-12">
                                                    <div class="row form-group">
                                                        <label for="input-direccion" class="control-label">Direccion</label>
                                                        <input type="text" class="form-control" id="input-direccion_persona_natural" placeholder="" name="direccion" disabled>
                                                    </div>                                            
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-email" class="control-label">Email:</label>
                                                        <input type="email" class="form-control" id="input-email_persona_natural" placeholder="" name="email" disabled>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-telefono" class="control-label">Teléfono:</label>
                                                        <input type="text" class="form-control" id="input-telefono_persona_natural" placeholder="" name="telefono" disabled> 
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-celular" class="control-label">Celular:</label>                                                
                                                        <input type="text" class="form-control" id="input-celular_persona_natural" placeholder="" name="celular" disabled>    
                                                    </div>
                                                </div> 

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_region">
                                                        <label for="input-region" class="control-label">Región</label>

                                                        <select id="input-region_select_persona_natural" class="form-control selectpicker" name="region" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                            {% for region_model in regiones %}
                                                                <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_provincia">
                                                        <label for="input-provincia" class="control-label">Provincia</label>
                                                        <select id="input-provincia_select_persona_natural" class="form-control selectpicker" name="provincia" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_distrito">
                                                        <label for="input-distrito" class="control-label">Distrito</label>

                                                        <select id="input-distrito_select_persona_natural" class="form-control selectpicker" name="distrito" disabled>
                                                            <option value="1">SELECCIONE...</option>   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row"> 
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">II. Informacion solicitada</legend>
                                                    <div class="row form-group">
                                                        <label for="input-informacion" class="control-label">Información solicitada</label>
                                                        <textarea class="form-control" rows="3" id="input-informacion_persona_natural" name="informacion"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">III. Dependencia de cual se requiere la informacion</legend>
                                                    <div class="row form-group" id="select_area">

                                                        <label for="input-distrito" class="control-label">Area</label>

                                                        <select id="input-area_select_persona_natural" class="form-control selectpicker" name="area" >
                                                            <option value="">SELECCIONE...</option>
                                                            {% for area_select in areas %}
                                                                <option value="{{ area_select.codigo }}">{{ area_select.nombres }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">IV. Forma de entrega de la Informacion</legend>
                                                    <div class="row form-group" id="select_medio">
                                                        <label for="input-medio" class="control-label">Medio de entrega</label>

                                                        <select id="input-medio_select_persona_natural" class="form-control selectpicker" name="medio" >
                                                            <option value="">SELECCIONE...</option>  
                                                            {% for  medio_entrega_select in  medio_entrega %}
                                                                <option value="{{  medio_entrega_select.codigo }}">{{  medio_entrega_select.nombres }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{ endForm() }}

                                        <button type="button" class="btn btn-block btn-raised btn-primary" id="btn_graba_persona_natural"><i class="fa fa-send"></i>Enviar</button>

                                    </div>

                                    <!--Modal save persona juridica -->
                                    <div class="modal modal-primary" id="modal_save_persona_natural" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                                        <div class="modal-dialog animated zoomIn animated-3x" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal" id="btn_cerrar_confirmar">Cerrar</button>
                                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin modal save postulante -->  

                                    <!--modal_registro_persona_natural_nuevo-->
                                    <div class="modal modal-primary" id="modal_registro_persona_natural_nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel4">Registro de Persona Natural</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                                </div>
                                                <div class="modal-body">

                                                    {{ form('web/savePersonaNaturalAccesoInformacion','method': 'post','id':'form_registro_persona_natural_nuevo','class':'form-horizontal','enctype':'multipart/form-data') }}


                                                    <div class="container-fluid">
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_ruc" class="control-label">Número RUC:</label>
                                                                    <input type="text" class="form-control" id="input-ruc_pn" placeholder="" name="ruc" maxlength="11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row form-group">
                                                                    <label for="input-razon_social" class="control-label">Razon Social:</label>
                                                                    <input type="text" class="form-control" id="input-razon_social_pn" placeholder="" name="razon_social">

                                                                </div>

                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <label for="input_direccion" class="control-label">Dirección</label>
                                                                    <input type="text" class="form-control" id="input-direccion_pn" placeholder="" name="direccion">
                                                                </div>                                            
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-8">
                                                                <div class="row form-group">
                                                                    <label for="input_email_publico" class="control-label">Email:</label>
                                                                    <input type="email" class="form-control" id="input-email_pn" placeholder="" name="email">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input-telefono_pn" class="control-label">Telefono:</label>                                                
                                                                    <input type="text" class="form-control" id="input-telefono_pn" placeholder="" name="telefono" >    
                                                                </div>
                                                            </div> 


                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_region" style="margin-top: 18px !important;">
                                                                    <label for="input_region" class="control-label">Región </label>

                                                                    <select id="input-region_select_pn" class="form-control selectpicker" name="region">
                                                                        <option value="">SELECCIONE...</option>   
                                                                        {% for region_model in regiones %}
                                                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                                        {% endfor %}
                                                                    </select>
                                                                    <span id="select_region_pn"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_provincia" style="margin-top: 18px !important;">
                                                                    <label for="input_provincia" class="control-label">Provincia </label>

                                                                    <select id="input-provincia_select_pn" class="form-control selectpicker" name="provincia">
                                                                        <option value="">SELECCIONE...</option>   
                                                                    </select>
                                                                    <span id="select_provincia_pn"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_distrito" style="margin-top: 18px !important;">
                                                                    <label for="input_distrito" class="control-label">Distrito </label>

                                                                    <select id="input-distrito_select_pn" class="form-control selectpicker" name="distrito">
                                                                        <option value="">SELECCIONE...</option>   
                                                                    </select>
                                                                    <span id="select_distrito_pn"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group">
                                                                    <label for="input_ubigeo" class="control-label">Nro ubigeo</label>

                                                                    <input type="text" class="form-control" id="input-ubigeo_pn" placeholder="Ubigeo" name="ubigeo" {#style="margin-top: 9px !important;"#}>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="input_password" class="control-label">Contraseña</label>
                                                                    <input type="password" class="form-control" id="input-password_1_pn" placeholder="" name="password_1">
                                                                </div>
                                                            </div> 

                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="input_password_2" class="control-label">Repetir Contraseña</label>
                                                                    <input type="password" class="form-control" id="input-password_2_pn" placeholder="" name="password_2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ endForm() }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
                                                    <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_pn"><i class="fa fa-save"></i>Guardar</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin modal_registro_persona_natural_nuevo--> 

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- persona natural fin -->

                    <div role="tabpanel" class="tab-pane fade" id="persona_juridica">
                        <div class="row">
                            <div class="col-xl-12 order-xl-1">
                                <div class="card card-primary animated fadeInUp animation-delay-7">
                                    <div class="card-body">
                                        {#<h1 class="color-primary text-center">LIBRO DE RECLAMACIONES</h1>#}
                                        {{ form('web/saveAccesoInformacion','method': 'post','id':'form_registro_persona_juridica','class':'form-horizontal','enctype':'multipart/form-data') }}
                                        <div class="container-fluid">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">I. Datos del solicitante</legend>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-nro_doc" class="control-label">Número de RUC</label>
                                                        <input type="text" class="form-control" id="input-ruc_persona_juridica" placeholder="" name="ruc" maxlength="11">
                                                        <input type="hidden" id="input-tipo" name="tipo" value="2">
                                                        <input type="hidden" id="input-codigo_persona_juridica" name="codigo" value="">
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-apellidop" class="control-label">Razon Social</label>
                                                        <input type="text" class="form-control" id="input-razon_social_persona_juridica" placeholder="" name="razon_social" disabled>

                                                    </div>

                                                </div>


                                                <div class="col-md-4" style="display: none;" id="input-registro_pj">
                                                    <div class="form-group row justify-content-end">
                                                        <div class="col-lg-10">
                                                            <label for="input-nro_doc" class="control-label">Click aqui para registrarse</label>

                                                            <a href="javascript:void(0);"class="btn btn-raised btn-primary" onclick="registro_persona_juridica();">Registrarse {#<i class="zmdi zmdi-account-add no-mr ml-1"></i>#}</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="col-md-12">
                                                    <div class="row form-group">
                                                        <label for="input-direccion" class="control-label">Direccion</label>
                                                        <input type="text" class="form-control" id="input-direccion_persona_juridica" placeholder="" name="direccion" disabled>
                                                    </div>                                            
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-email" class="control-label">Email:</label>
                                                        <input type="email" class="form-control" id="input-email_persona_juridica" placeholder="" name="email" disabled>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-telefono" class="control-label">Teléfono:</label>
                                                        <input type="text" class="form-control" id="input-telefono_persona_juridica" placeholder="" name="telefono" disabled> 
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group">
                                                        <label for="input-celular" class="control-label">Celular:</label>                                                
                                                        <input type="text" class="form-control" id="input-celular_persona_juridica" placeholder="" name="celular" disabled>    
                                                    </div>
                                                </div> 

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_region">
                                                        <label for="input-region" class="control-label">Región</label>

                                                        <select id="input-region_select_persona_juridica" class="form-control selectpicker" name="region" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                            {% for region_model in regiones %}
                                                                <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_provincia">
                                                        <label for="input-provincia" class="control-label">Provincia</label>
                                                        <select id="input-provincia_select_persona_juridica" class="form-control selectpicker" name="provincia" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group" id="select_distrito">
                                                        <label for="input-distrito" class="control-label">Distrito</label>

                                                        <select id="input-distrito_select_persona_juridica" class="form-control selectpicker" name="distrito" disabled>
                                                            <option value="">SELECCIONE...</option>   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row"> 
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">II. Informacion solicitada</legend>
                                                    <div class="row form-group">
                                                        <label for="input-informacion" class="control-label">Información solicitada</label>
                                                        <textarea class="form-control" rows="3" id="input-informacion_persona_juridica" name="informacion"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">III. Dependencia de cual se requiere la informacion</legend>
                                                    <div class="row form-group" id="select_area">

                                                        <label for="input-distrito" class="control-label">Area</label>

                                                        <select id="input-area_select_persona_juridica" class="form-control selectpicker" name="area" >
                                                            <option value="">SELECCIONE...</option>
                                                            {% for area_select in areas %}
                                                                <option value="{{ area_select.codigo }}">{{ area_select.nombres }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <legend style="margin-bottom: -30px;">IV. Forma de entrega de la Informacion</legend>
                                                    <div class="row form-group" id="select_medio">
                                                        <label for="input-medio" class="control-label">Medio de entrega</label>

                                                        <select id="input-medio_select_persona_juridica" class="form-control selectpicker" name="medio" >
                                                            <option value="">SELECCIONE...</option>  
                                                            {% for  medio_entrega_select in  medio_entrega %}
                                                                <option value="{{  medio_entrega_select.codigo }}">{{  medio_entrega_select.nombres }}</option>   
                                                            {% endfor %}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{ endForm() }}

                                        <button type="button" class="btn btn-block btn-raised btn-primary" id="btn_graba_persona_juridica"><i class="fa fa-send"></i>Enviar</button>

                                    </div>

                                    <!--Modal save persona juridica -->
                                    <div class="modal modal-primary" id="modal_save_persona_juridica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                                        <div class="modal-dialog animated zoomIn animated-3x" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal" id="btn_cerrar_confirmar">Cerrar</button>
                                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin modal save postulante -->  

                                    <!--modal_registro_persona_juridica_nuevo-->
                                    <div class="modal modal-primary" id="modal_registro_persona_juridica_nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel4">Registro de Persona Juridica</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                                </div>
                                                <div class="modal-body">

                                                    {{ form('web/savePersonaJuridicaAccesoInformacion','method': 'post','id':'form_registro_persona_juridica_nuevo','class':'form-horizontal','enctype':'multipart/form-data') }}


                                                    <div class="container-fluid">
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input_ruc" class="control-label">Número RUC:</label>
                                                                    <input type="text" class="form-control" id="input-ruc_pj" placeholder="" name="ruc" maxlength="11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row form-group">
                                                                    <label for="input-razon_social" class="control-label">Razon Social:</label>
                                                                    <input type="text" class="form-control" id="input-razon_social_pj" placeholder="" name="razon_social">

                                                                </div>

                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <label for="input_direccion" class="control-label">Dirección</label>
                                                                    <input type="text" class="form-control" id="input-direccion_pj" placeholder="" name="direccion">
                                                                </div>                                            
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-8">
                                                                <div class="row form-group">
                                                                    <label for="input_email_publico" class="control-label">Email:</label>
                                                                    <input type="email" class="form-control" id="input-email_pj" placeholder="" name="email">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="row form-group">
                                                                    <label for="input-telefono_pj" class="control-label">Telefono:</label>                                                
                                                                    <input type="text" class="form-control" id="input-telefono_pj" placeholder="" name="telefono" >    
                                                                </div>
                                                            </div> 


                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_region" style="margin-top: 18px !important;">
                                                                    <label for="input_region" class="control-label">Región </label>

                                                                    <select id="input-region_select_pj" class="form-control selectpicker" name="region">
                                                                        <option value="">SELECCIONE...</option>   
                                                                        {% for region_model in regiones %}
                                                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                                                        {% endfor %}
                                                                    </select>
                                                                    <span id="select_region_pj"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_provincia" style="margin-top: 18px !important;">
                                                                    <label for="input_provincia" class="control-label">Provincia </label>

                                                                    <select id="input-provincia_select_pj" class="form-control selectpicker" name="provincia">
                                                                        <option value="">SELECCIONE...</option>   
                                                                    </select>
                                                                    <span id="select_provincia_pj"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group" id="select_distrito" style="margin-top: 18px !important;">
                                                                    <label for="input_distrito" class="control-label">Distrito </label>

                                                                    <select id="input-distrito_select_pj" class="form-control selectpicker" name="distrito">
                                                                        <option value="">SELECCIONE...</option>   
                                                                    </select>
                                                                    <span id="select_distrito_pj"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row form-group">
                                                                    <label for="input_ubigeo" class="control-label">Nro ubigeo</label>

                                                                    <input type="text" class="form-control" id="input-ubigeo_pj" placeholder="Ubigeo" name="ubigeo" {#style="margin-top: 9px !important;"#}>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="input_password" class="control-label">Contraseña</label>
                                                                    <input type="password" class="form-control" id="input-password_1_pj" placeholder="" name="password_1">
                                                                </div>
                                                            </div> 

                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label for="input_password_2" class="control-label">Repetir Contraseña</label>
                                                                    <input type="password" class="form-control" id="input-password_2_pj" placeholder="" name="password_2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ endForm() }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
                                                    <button type="button" class="btn btn-raised btn-primary" id="btn_grabar_pj"><i class="fa fa-save"></i>Guardar</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin modal_registro_persona_juridica_nuevo--> 

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- panel -->
    </div> <!-- container -->
{% endblock %}