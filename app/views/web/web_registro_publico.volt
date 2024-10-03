{% block content %}
    <div class="container">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card card-primary animated fadeInUp animation-delay-7">
                    <div class="card-body">
                        <h1 class="color-primary text-center">DATOS DEL USUARIO</h1>
                        {{ form('web/savepublico','method': 'post','id':'form_registro_publico','class':'form-horizontal','enctype':'multipart/form-data') }}
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

                        <button type="button" class="btn btn-block btn-raised btn-primary" id="btn_grabar_publico"><i class="fa fa-save"></i>Guardar</button>

                    </div>
                        
                    <!--Modal save postulante -->
                    <div class="modal modal-primary" id="modal_save_postulante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Usted se ha registrado correctamente. Inicie sesión par continuar con el proceso de reserva...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-primary" data-dismiss="modal" id="btn_cerrar_confirmar">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin modal save postulante -->  
                </div>
            </div>
        </div>
    </div> <!-- container -->
{% endblock %}