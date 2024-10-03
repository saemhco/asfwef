{% block content %}


    <div class="container">
        <div class="row">
{#            <div class="col-xl-5 order-xl-2">
                <div class="card card-primary animated fadeInUp animation-delay-7">
                    <div class="card-body">
                        <h1 class="color-primary text-center">Login</h1>
                        <form class="form-horizontal">
                            <fieldset>
                                <div class="form-group row">
                                    <label for="inputEmail-ñogin" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="inputEmail-ñogin" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword-login" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="inputPassword-login" placeholder="Password">
                                    </div>
                                </div>
                            </fieldset>
                            <button class="btn btn-raised btn-primary btn-block">Login <i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                        </form>
                        <div class="text-center mt-4">
                            <h3>Login with</h3>
                            <a href="javascript:void(0)" class="btn-circle btn-facebook"><i class="zmdi zmdi-facebook"></i></a>
                            <a href="javascript:void(0)" class="btn-circle btn-twitter"><i class="zmdi zmdi-twitter"></i></a>
                            <a href="javascript:void(0)" class="btn-circle btn-google"><i class="zmdi zmdi-google"></i></a>
                        </div>
                    </div>
                </div>
            </div>#}
            <div class="col-xl-12 order-xl-1">
                <div class="card card-primary animated fadeInUp animation-delay-7">
                    <div class="card-body">
                        <h1 class="color-primary text-center">DATOS DEL POSTULANTE</h1>

                        {{ form('web/savePostulante','method': 'post','id':'form_registro_postulante','class':'form-horizontal','enctype':'multipart/form-data') }}
                        <fieldset>
                            <div class="row form-group">
                                <label for="input_documento" class="col-md-3 control-label">Tipo Documento</label>
                                <div class="col-md-9">
                                    <select id="input_documento" class="form-control selectpicker" name="documento">
                                        <option value="0">SELECCIONE...</option>   
                                        {% for tipodocumento_model in tipodocumentos %}
                                            <option value="{{ tipodocumento_model.codigo }}">{{ tipodocumento_model.nombres }}</option>                                      
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input_nro_doc" class="col-md-3 control-label">Número Documento</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_nro_doc" placeholder="Número Documento" name="nro_doc">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input_nombres" class="col-md-3 control-label">Nombres</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_nombres" placeholder="Nombres" name="nombres">
                                    <input type="hidden" id="input_codigo" name="codigo" value="{{ codigo_nuevo_postulante }}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input_apellidop" class="col-md-3 control-label">Apellido Paterno</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_apellidop" name="apellidop" placeholder="Apellido Paterno">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input_apellidom" class="col-md-3 control-label">Apellido Materno</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_apellidom" name="apellidom" placeholder="Apellido Materno">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input-sexo" class="col-md-3 control-label">Sexo</label>
                                <div class="col-md-9">
                                    <select id="input_sexo" class="form-control selectpicker" name="sexo">
                                        <option value="0">SELECCIONE...</option>   
                                        {% for sexo_model in sexo %}
                                            <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>   
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_fecha_nacimiento" class="col-md-3 control-label">Fecha de Nacimiento</label>
                                <div class="col-md-9">
                                    {#<input id="datepicker" type="text" class="form-control" placeholder="dd/mm/yy" name="fecha_nacimiento">#}
                                    <input id="datePicker" type="text" class="form-control" name="fecha_nacimiento">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_seguro" class="col-md-3 control-label">Seguro</label>
                                <div class="col-md-9">
                                    <select id="input_seguro" class="form-control selectpicker" name="seguro">
                                        <option value="0">SELECCIONE...</option>   
                                        {% for seguro_model in seguro %}
                                            <option value="{{ seguro_model.codigo }}">{{ seguro_model.nombres }}</option>   
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_telefono" class="col-md-3 control-label">Teléfono</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_telefono" placeholder="Teléfono" name="telefono">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_celular" class="col-md-3 control-label">Celular</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_celular" placeholder="Celular" name="celular">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_email" class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="input_email" placeholder="Email" name="email" >
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_direccion" class="col-md-3 control-label">Dirección</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_direccion" placeholder="Dirección" name="direccion">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_ciudad" class="col-md-3 control-label">Ciudad</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_ciudad" placeholder="Ciudad" name="ciudad">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_observaciones" class="col-lg-3 control-label">Observaciones</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" rows="3" id="input_observaciones" name="observaciones"></textarea>
                                    <span class="help-block">Un bloque más largo de texto de ayuda que se divide en una nueva línea y puede extenderse más allá de una línea.</span>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputFile" class="col-md-3 control-label">Foto</label>
                                <div class="col-lg-9">
                                    <input type="text" readonly="" class="form-control" placeholder="Buscar..." name="foto">
                                    <input type="file" id="inputFile" multiple="" name="foto">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="offset-lg-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="colegio_publico"> <span class="ml-2">Colegio Público</span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input_colegio_nombre" class="col-md-3 control-label">Nombre de Colegio</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_colegio_nombre" placeholder="Nombre de Colegio" name="colegio_nombre">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="offset-lg-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sitrabaja"> <span class="ml-2">Si Trabaja</span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="input_sitrabaja_nombre" class="col-md-3 control-label">Si Trabaja</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_sitrabaja_nombre" placeholder="Si tarabaja nombre" name="sitrabaja_nombre">
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="offset-lg-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sidepende"> <span class="ml-2">Si Depende</span>
                                        </label>

                                    </div>

                                </div>

                            </div>
                            <div class="row form-group">
                                <label for="input_sidepende" class="col-md-3 control-label">Si Depende</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_sidepende_nombre" placeholder="Si tarabaja nombre" name="sidepende_nombre">
                                </div>
                            </div>



                            <div class="row form-group">
                                <label for="input_region" class="col-md-3 control-label">Región (Ubigeo)</label>
                                <div class="col-md-9">
                                    <select id="input_region_select" class="form-control selectpicker" name="region">
                                        <option value="0">SELECCIONE...</option>   
                                        {% for region_model in regiones %}
                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_provincia" class="col-md-3 control-label">Provincia (Ubigeo)</label>
                                <div class="col-md-9">
                                    <select id="input_provincia_select" class="form-control selectpicker" name="provincia">
                                        <option value="0">SELECCIONE...</option>   
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_distrito" class="col-md-3 control-label">Distrito (Ubigeo)</label>
                                <div class="col-md-9">
                                    <select id="input_distrito_select" class="form-control selectpicker" name="distrito">
                                        <option value="0">SELECCIONE...</option>   
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_ubigeo" class="col-md-3 control-label">Nro ubigeo</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_ubigeo" placeholder="Ubigeo" name="ubigeo">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_region1" class="col-md-3 control-label">Región (Lugar de Procedencia)</label>
                                <div class="col-md-9">
                                    <select id="input_region1_select" class="form-control selectpicker" name="region1">
                                        <option value="0">SELECCIONE...</option>   
                                        {% for region_model in regiones %}
                                            <option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>   
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_provincia1" class="col-md-3 control-label">Provincia (Lugar de Procedencia)</label>
                                <div class="col-md-9">
                                    <select id="input_provincia1_select" class="form-control selectpicker" name="provincia1">
                                        <option value="0">SELECCIONE...</option>   
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_distrito1" class="col-md-3 control-label">Distrito (Lugar de Procedencia)</label>
                                <div class="col-md-9">
                                    <select id="input_distrito1_select" class="form-control selectpicker" name="distrito1">
                                        <option value="0">SELECCIONE...</option>   
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_ubigeo1" class="col-md-3 control-label">Nro ubigeo (Lugar de Procedencia)</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_ubigeo1" placeholder="Ubigeo" name="ubigeo1">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="input_localidad" class="col-md-3 control-label">Localidad</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_localidad" placeholder="Localidad" name="localidad">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="offset-lg-2 col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="discapacitado"> <span class="ml-2">Discapacidad</span>
                                        </label>

                                    </div>

                                </div>

                            </div>

                            <div class="row form-group">
                                <label for="input_discapacitado_nombre" class="col-md-3 control-label">Nombre discapacidad</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="input_discapacitado_nombre" placeholder="Nombre discapacidad" name="discapacitado_nombre">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="input_password" class="col-md-3 control-label">Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="input_password" placeholder="Contraseña" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input_password_2" class="col-md-3 control-label">Repetir Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="input_password2" placeholder="Contraseña" name="password">
                                </div>
                            </div>


                            <div class="row mt-2">
                                {#                                    <div class="offset-lg-2 col-lg-10">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox"> <span class="ml-2">I agree to the terms and conditions.</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>#}
                                <div class="col">
                                    <button class="btn btn-raised btn-primary btn-block" type="button" id="registrar_postulante_btn">Registrar Postulante</button>
                                </div>
                            </div>
                        </fieldset>
                        {{ endForm() }}

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
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fin modal vacio -->

                    <!--Modal alerta nro documento ya registrado -->
                    <div class="modal modal-warning" id="modal_nro_doc_registrado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog modal-lm animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>El numero de documento ya esta registrado...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal">Cerrar</button>
                                    {#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fin nro documento ya registrado -->

                    <!--Modal save postulante -->
                    <div class="modal modal-primary" id="modal_save_postulante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
                        <div class="modal-dialog animated zoomIn animated-3x" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Se registro postulante correctamente...</p>
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
        </div>
    </div> <!-- container -->



{% endblock %}