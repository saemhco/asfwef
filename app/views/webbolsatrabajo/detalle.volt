{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Empelos
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <?php $this->partial('sharedbolsatrabajo/menu1'); ?>
                <!-- CENTER -->
                <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 					
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-book"></i><strong>Información del Empleo</strong></h3>
                                    {#<a href="#" class="btn btn-raised btn-success float-right" id="enviar-btn" role="button" ><i class="fa fa-check"></i> RESERVAR</a>#}
                            <button  id="btn_postular_empleo" type="button" class="btn btn-raised btn-warning float-right" style="margin-top: -25px;margin-bottom: -5px;">
                                Postular
                            </button>
                            <input type="hidden" name="key" id="key" value="{{key}}">
                        </div>
                        <div class="card-body">    
                            <!-- POST ITEM -->
                            <div class="blog-post-item">


                                {#<a href="#" class="btn btn-raised btn-success float-right" role="button"><i class="fa fa-check"></i> RESERVAR</a><br><br>#}
                                <h3><span>{{ empleo.titulo }}</span></h3>

                                <table class="table table-no-border table-striped">
                                    <tr>
                                        <th><i class="zmdi zmdi-account mr-1 color-success"></i> RAZÓN SOCIAL</th>
                                        <td>{{ empleador.razon_social }}</td>
                                    </tr>
                                    <tr>
                                        <th ><i class="zmdi zmdi-collection-text mr-1 color-warning"></i> DESCRIPCIÓN</th>
                                        <td >{{ empleo.descripcion }}</td>
                                    </tr>
                                    <tr>
                                        <th ><i class="zmdi zmdi-calendar mr-1 color-success"></i> FECHA PUBLICACIÓN</th>
                                        <td>{{utilidades.fechita(fecha_creacion,"d/m/Y") }}</td>
                                    </tr>

                                    <tr>
                                        <th ><i class="zmdi zmdi-calendar mr-1 color-danger"></i> FECHA CLAUSURA</th>
                                        <td>{{utilidades.fechita(fecha_clausura,"d/m/Y") }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="zmdi zmdi-assignment mr-1 color-info"></i> REQUISITOS</th>
                                        <td>{{ empleo.requisitos}}</td>
                                    </tr>
                                    <tr>
                                        <th ><i class="zmdi zmdi-money-box mr-1 color-success"></i> REMUNERACIÓN</th>
                                        <td >S/.{{ empleo.salario}}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="zmdi zmdi-calendar mr-1 color-info"></i> UBICACIÓN</th>
                                        <td><strong>REGIÓN:</strong> {{region.descripcion}}, <strong>PROVINCIA:</strong> {{provincia.descripcion}}, <strong>DISTRITO:</strong> {{distrito.descripcion}}</td>
                                    </tr>
                                </table>

                                <a href="{{ url('web-bolsatrabajo/listado.html') }}" class="btn btn-primary btn-raised text-right" role="button">
                                    <i class="fa fa-backward"></i>
                                    <span>Regresar</span>
                                </a>

                            </div>
                            <!-- /POST ITEM -->	
                        </div> 
                    </div>
                </div>       	
            </div>
        </div>
    </div>

    <!--Modal postulante -->
    <div class="modal modal-primary" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
        {# <div class="modal-dialog modal-sm animated zoomIn animated-3x" role="document">#}
        <div class="modal-dialog animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Iniciar Sesión</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    {#<p>Se registro postulante correctamente...</p>#}
                    {{ form('webbolsatrabajo/login','method': 'post','id':'form_sesion','class':'form-horizontal','enctype':'multipart/form-data') }}
                    <div class="container-fluid">
                        <div class="row" style="margin-top: -20px;">
                            <div class="col-md-12">
                                <div class="row form-group" id="email_login">
                                    <label for="input_email" class="control-label" id="label_change">Email:</label>
                                    <input type="email" class="form-control" id="input_email" placeholder="" name="email">
                                    <input type="hidden" name="tipousuario" id="tipousuario" value="1">
                                </div>
                            </div>                                          
                        </div>
                        <div class="row" style="margin-top: -20px;">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="input_password" class="control-label">Contraseña</label>
                                    <input type="password" class="form-control" id="input_password" placeholder="" name="password">
                                </div>
                            </div> 
                        </div>
                        <div class="text-center form-sm mt-2">
                            <button class="btn btn-raised btn-primary" type="button" id="entrar_login"><i class="fa fa-sign-in"></i>Entrar </button>
                        </div>
                    </div>
                    {{ endForm() }}
                </div>
                <div class="modal-footer">
                    <div class="options text-center text-md-left mt-1">
                        <p>¿No es un miembro? <a href="{{ url('registrar-publico.html') }}" class="blue-text">Regístrate</a></p>
                              <p>Recuperar <a href="{{ url('recuperar-contrasenha-web.html') }}" class="blue-text">contraseña</a></p>
                        <p>Recuperar <a href="{{ url('recuperar-contrasenha-publico-web.html') }}" class="blue-text">contraseña Público</a></p>
                    </div>
                    <button type="button" class="btn btn-raised btn-danger waves-effect ml-auto" data-dismiss="modal"><i class="fa fa-times"></i>Cerrar </button>
                </div>

            </div>
        </div>
    </div>
    <!-- fin modal registro postulante -->

    <!--Modal validarcv -->
    <div class="modal modal-primary" id="modal_validarcv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-backdrop="static" data-keyboard="false">
        {# <div class="modal-dialog modal-sm animated zoomIn animated-3x" role="document">#}
        <div class="modal-dialog animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Elegir Opción</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    {#<p>Se registro postulante correctamente...</p>#}
                    {{ form('webbolsatrabajo/validarcv','method': 'post','id':'form_validarcv','class':'form-horizontal','enctype':'multipart/form-data') }}
                    <div class="container-fluid">


                        <div class="row" style="margin-top: -20px;">
                            <div class="col-md-12">
                                <div class="row form-group" id="email_login">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="cv_defecto" id="cv_defecto"> Utilizar mi CV por defecto 
                                        </label>
                                    </div>
                                    <input type="hidden" name="idempleo" id="idempleo" value="{{empleo.id_empleo}}">
                                </div>
                            </div>                                          
                        </div>

                        <div class="row" style="margin-top: -20px;">
                            <div class="col-md-12">
                                <div class="row form-group" id="email_login">
                                    <input type="file" multiple="" name="cv_nuevo" id="cv_nuevo">
                                    <div class="input-group" id="div_cv_defecto">
                                        <input type="text" readonly="" class="form-control" placeholder="Subir un cv nuevo para esta oferta laboral...">
                                        <span class="input-group-btn input-group-sm">
                                            <button type="button" class="btn btn-fab btn-fab-mini">
                                                <i class="material-icons">attach_file</i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="progress" style="display: none;" id="barra_progreso">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                        10%
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    {{ endForm() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal" id="btn_validarcv_cerrar">Cerrar</button>
                    <button type="button" class="btn btn-raised btn-primary" id="btn_validarcv_aceptar">Aceptar</button>
                </div>

            </div>
        </div>
    </div>
    <!-- fin modal registro postulante -->

    <!--Modal alerta postulacion confirmada -->
    <div class="modal modal-success" id="modal_postulacion_confirmada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog modal-md animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <p align="justify">Acabas de postular a esta oferta laboral, puede ver el estado de su postulacion ingresando al panel en la opción "Bolsa de Trabajo -> Mis postulaciones"...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-success" data-dismiss="modal" id="btn_cerrar">Cerrar</button>
                    {#<button type="button" class="btn btn-raised btn-primary" id="btn_aceptar">Aceptar</button>#}
                </div>
            </div>
        </div>
    </div>
    <!--fin -->

    <!--Modal alerta confirmar reserva -->
    <div class="modal modal-warning" id="modal_error_postulacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog modal-md animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <p align="center">No se puede postular 2 veces al mismo trabajo, puede ver el estado de su postulacion ingresando al panel en la opcion "mis postulaciones"</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal" id="btn_error_postulacion_cerrar">Cerrar</button>
                    {#<button type="button" class="btn btn-raised btn-primary" id="btn_error_reserva_aceptar">Aceptar</button>#}
                </div>
            </div>
        </div>
    </div>
    <!--fin -->
{% endblock %}
