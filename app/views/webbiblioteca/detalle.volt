{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Libros
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <?php $this->partial('sharedbiblioteca/menu1'); ?>
                <!-- CENTER -->
                <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 					
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-book"></i><strong>Información del Libro</strong></h3>
                                    {#<a href="#" class="btn btn-raised btn-success float-right" id="enviar-btn" role="button" ><i class="fa fa-check"></i> RESERVAR</a>#}
                            <button  id="reservar_libro" type="button" class="btn btn-raised btn-warning float-right" style="margin-top: -25px;margin-bottom: -5px;">
                                Reservar Libro a Domicilio
                            </button>

                        </div>
                        <div class="card-body">    
                            <!-- POST ITEM -->
                            <div class="blog-post-item">
                                {% for  libro in libros %}

                                    {#<a href="#" class="btn btn-raised btn-success float-right" role="button"><i class="fa fa-check"></i> RESERVAR</a><br><br>#}
                                    <h3 style="color:black;font-weight: bold;"><span></span><strong>{{ libro.titulo }}</strong></span></h3>

                                    <table class="table table-no-border table-striped">
                                        <tr>
                                            <th><i class="zmdi zmdi-account mr-1 color-success"></i> AUTOR(ES)</th>
                                            <td>
                                                {% if libro.autor2 == "" %}
                                                {% set autor2 = "" %}
                                                {% set guion2 = "" %}
                                                {% else %}
                                                {% set autor2 = libro.autor2 %}
                                                
                                                {% set guion2 ="-" %}
                                                {% endif %}
                        
                        
                                                {% if libro.autor3 == "" %}
                                                {% set autor3 = "" %}
                                                {% set guion3 = "" %}
                                                {% else %}
                                                {% set autor3 = libro.autor3 %}
                                                {% set guion3 = "-" %}
                                                {% endif %}
                                                
                                                - {{ libro.autor1}}
                                                <br>
                                                {{guion2}} {{autor2}}
                                                <br>
                                                {{guion3}} {{autor3}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th ><i class="zmdi zmdi-view-dashboard mr-1 color-warning"></i> CATEGORÍA</th>
                                            <td >{{ libro.categoria}}</td>
                                        </tr>
                                        <tr>
                                            <th ><i class="zmdi zmdi-calendar mr-1 color-royal"></i> AÑO PUBLICACIÓN</th>
                                            <!-- <td>{{utilidades.fechita(libro.fecha_publicacion,"d/m/Y") }}</td> -->
                                            <td>{{ libro.anio_publicacion}}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="zmdi zmdi-format-list-numbered mr-1 color-danger"></i> ISBN</th>
                                            <td>
                                                {{ libro.isbn}}
                                                {{ form('webbiblioteca/reservarlibro','method': 'post','id':'form_reservar_libro','enctype':'multipart/form-data') }}
                                                <input type="hidden" name="id_libro" id="id_libro" value="{{libro.libro_id}}">
                                                <input type="hidden" name="id_ejemplar" id="id_ejemplar" value="{{libro.id_ejemplar}}">
                                                {{ endForm() }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="zmdi zmdi-globe-alt mr-1 color-info"></i> IDIOMA</th>
                                            <td>{{ libro.idioma}}</td>
                                        </tr>

                                        <tr>
                                            <th><i class="zmdi zmdi-collection-bookmark mr-1 color-danger"></i> EDITORIAL</th>
                                            <td >{{ libro.editorial}}</td>
                                        </tr>
                                        <tr>
                                            <th ><i class="zmdi zmdi-collection-text mr-1 color-warning"></i> PAGINAS</th>
                                            <td >{{ libro.paginas}}</td>
                                        </tr>

                                        <tr>
                                            <th ><i class="zmdi zmdi-collection-plus mr-1 color-danger"></i> EJEMPLAR N°</th>
                                            <td >{{ libro.cantidad_ejemplares}}</td>
                                        </tr>

                                        <tr>
                                            <th ><i class="zmdi zmdi-book mr-1 color-danger"></i> NÚMERO</th>
                                            <td >{{ libro.numero}}</td>
                                        </tr>
                                    </table>

                                    <a href="{{ url('web-biblioteca/listado.html') }}" class="btn btn-primary btn-raised text-right" role="button">
                                        <i class="fa fa-backward"></i>
                                        <span>Regresar</span>
                                    </a>
                                {% endfor %} 
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
                    {{ form('webbiblioteca/login','method': 'post','id':'form_sesion','class':'form-horizontal','enctype':'multipart/form-data') }}
                    <div class="container-fluid">
                        <div class="row" style="margin-top: -20px;">
                            <div class="col-md-12">
                                <div class="row form-group" id="select_tipo_usuario">
                                    <label for="input_tipousuario" class="control-label" >Tipo de Usuario:</label>
                                    <select id="input_tipousuario_select" class="form-control selectpicker" name="tipousuario">
                                        <option value="">Seleccione...</option>   
                                        <option value="1">Estudiante</option>
                                        <option value="2">Docente</option>
                                        <!-- <option value="3">Administrativo</option> -->
                                        <option value="5">Público</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -20px;">
                            <div class="col-md-12">
                                <div class="row form-group" id="email_login">
                                    <label for="input_email" class="control-label" id="label_change">Email:</label>
                                    <input type="email" class="form-control" id="input_email" placeholder="" name="email">
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
                        
                        <!--
                        <p>¿No es un miembro? <a href="{{ url('registro-publico.html') }}" class="blue-text">Regístrate</a></p>
                        -->

                        <p>Recuperar <a href="{{ url('recuperar-contrasenha-web.html') }}" class="blue-text">contraseña</a></p>
                        <p>Recuperar <a href="{{ url('recuperar-contrasenha-publico-web.html') }}" class="blue-text">contraseña Público</a></p>
                    </div>
                    <button type="button" class="btn btn-raised btn-danger waves-effect ml-auto" data-dismiss="modal"><i class="fa fa-times"></i>Cerrar </button>
                </div>

            </div>
        </div>
    </div>
    <!-- fin modal registro postulante -->

    <!--Modal alerta confirmar reserva -->
    <div class="modal modal-warning" id="modal_confirmar_reserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog modal-md animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <p align="center">¿Esta seguro de realizar esta reserva?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal" id="btn_confirmar_cerrar">Cerrar</button>
                    <button type="button" class="btn btn-raised btn-primary" id="btn_confirmar_aceptar">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!--fin -->

    <!--Modal alerta confirmar reserva -->
    <div class="modal modal-success" id="modal_reserva_confirmada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog modal-md animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <p align="justify">LIBRO RESERVADO: Para no perder tu reserva, tienes 24 horas para acercarte a la Biblioteca Central, además puedes ver el estado de la misma ingresando a tu panel en la opción "Mis Reservas"</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-success" data-dismiss="modal" id="btn_cerrar">Cerrar</button>
                    {#<button type="button" class="btn btn-raised btn-primary" id="btn_aceptar">Aceptar</button>#}
                </div>
            </div>
        </div>
    </div>
    <!--fin -->

    <!--Modal error reserva -->
    <div class="modal modal-warning" id="modal_error_reserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog modal-md animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <p align="center">Usted solo puede realizar una reserva virtual de un ejemplar</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal" id="btn_confirmar_reserva_cerrar">Cerrar</button>
                    {#<button type="button" class="btn btn-raised btn-primary" id="btn_error_reserva_aceptar">Aceptar</button>#}
                </div>
            </div>
        </div>
    </div>
    <!--fin -->

    <!--Modal error reserva -->
    <div class="modal modal-warning" id="modal_error_reserva_libro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog modal-md animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                </div>
                <div class="modal-body">
                    <p align="center">El libro se encuentra reservado/prestamo</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-raised btn-warning" data-dismiss="modal" id="btn_confirmar_reserva_libro_cerrar">Cerrar</button>
                    {#<button type="button" class="btn btn-raised btn-primary" id="btn_error_reserva_aceptar">Aceptar</button>#}
                </div>
            </div>
        </div>
    </div>
    <!--fin -->
{% endblock %}
