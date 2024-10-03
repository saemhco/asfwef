{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Detalles
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <?php $this->partial('shared/menu1'); ?>
                <!-- CENTER -->
                <div class="col-lg-9 col-md-9 col-sm-9" style ="margin-top: 20px;"> 					
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-globe"></i><strong>{{ servicio.titular }}</strong></h3>
                        </div>
                        <div class="card-body">    
                            <!-- POST ITEM -->
                            <div class="blog-post-item">

                                {#<h3><span></span></h3>#}
                                <!-- OWL SLIDER -->
                                <div>
                                    <center>
                                        <div id="carousel-example-generic" class="ms-carousel carousel slide" data-ride="carousel" {#style="width: 600px;border: 3px solid #C0C0C0;"#}>


                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                {% if activa_imagenes == 1 %} 
                                                    {% set codigo_active = servicio_imagen_active.id_servicio_imagen %}
                                                    {% for  servicio_imagen in servicios_imagenes  %}
                                                        <div class="carousel-item {% if servicio_imagen.id_servicio_imagen == codigo_active %} active {% endif %}">
                                                            {{ image("adminpanel/imagenes/servicios_img/"~servicio_imagen.imagen, "class":"d-block img-fluid", "alt":"") }}
                                                            <div class="carousel-caption">

                                                            </div>
                                                        </div>
                                                    {% endfor %}
                                                {% elseif activa_imagenes == 0 %}
                                                    <div class="carousel-item active">
                                                        {{ image("adminpanel/imagenes/servicios/"~servicio.imagen, "class":"d-block img-fluid", "alt":"") }}

                                                    </div>
                                                {% endif %}

                                            </div>
                                            <!-- Controls -->
                                            {% if activa_imagenes == 1 %} 
                                                <a href="#carousel-example-generic" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary left carousel-control-prev" role="button" data-slide="prev"><i class="zmdi zmdi-chevron-left"></i></a>
                                                <a href="#carousel-example-generic" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary right carousel-control-next" role="button" data-slide="next"><i class="zmdi zmdi-chevron-right"></i></a>
                                                {% endif %}


                                        </div>
                                    </center>
                                </div>


                                <!-- /OWL SLIDER -->

                                <!-- aca se junta texto muestra y texto complementario  -->
                                <p>{{ servicio.texto_complementario }}</p>

                                {% if activa_archivos == 1 %} 
                                    <table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">
                                        <thead>
                                            <tr>

                                                <th style="background-color: #4169e1; color: white;text-align:center !important;">Título</th>
                                                <th style="background-color: #4169e1; color: white;text-align:center !important;">Archivo</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {% for  servicio_archivo in servicios_archivos  %}


                                                <tr>

                                                    <td style="color: #000000;text-align:left !important;">{{ servicio_archivo.titular }}</td>

                                                    <td style="color: #000000;text-align:center !important;"><a href="{{ config.global.xWebIns }}/adminpanel/archivos/eventos_files/{{ servicio_archivo.archivo }}" download><i class="fa fa-file-o"></i></a></td>
                                                </tr>



                                            {% endfor %}
                                        </tbody>
                                    </table>
                                {% endif %}

                                {% if activa_eventos == 1 %} 
                                    <h3><span>Relación de Eventos</span></h3>
                                    <table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">
                                        <thead>
                                            <tr>
                                                <th style="background-color: #4169e1; color: white;text-align:center !important;">Imagen</th>
                                                <th style="background-color: #4169e1; color: white;text-align:center !important;">Fecha</th>
                                                <th style="background-color: #4169e1; color: white;text-align:center !important;">Título</th>

                                                <th style="background-color: #4169e1; color: white;text-align:center !important;">Archivo</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {% for  evento in eventos  %}


                                                <tr>
                                                    <td>
                                                        {{ image("adminpanel/imagenes/eventos/"~evento.imagen, "class":"d-block img-fluid", "width":"90", "height":"90") }}
                                                    </td>
                                                    <td>{{ utilidades.fechita(evento.fecha_hora,"d/m/Y")}}</td>
                                                    <td style="color: #000000;text-align:left !important;">
                                                        <a href="{{ url('web-detalle-evento/'~evento.id_evento~".html") }}">
                                                            {{ evento.titular }}
                                                        </a>
                                                        <br>
                                                        {% for  evento_archivo in eventos_archivos  %}
                                                            {% if evento_archivo.id_evento == evento.id_evento %}
                                                                -{{ evento_archivo.titular }}<br>
                                                            {% endif %}
                                                        {% endfor %}


                                                    </td>

                                                    <td style="color: #000000;text-align:center !important;">
                                                        {% if evento.archivo !== null  %} 
                                                            <a href="{{ config.global.xWebIns }}/adminpanel/archivos/eventos/{{ evento.archivo }}" target="_BLANK"><i class="fa fa-file-pdf-o   "></i></a>
                                                            {% endif %}
                                                        <br>
                                                        {% for  evento_archivo in eventos_archivos  %}
                                                            {% if evento_archivo.id_evento == evento.id_evento %}
                                                                {#-{{ evento_archivo.titular }}<br>#}
                                                                <a href="{{ config.global.xWebIns }}/adminpanel/archivos/eventos_files/{{ evento_archivo.archivo }}" target="_BLANK"><i class="fa fa-file-pdf-o   "></i></a><br>
                                                                {% endif %}
                                                            {% endfor %}
                                                    </td>
                                                </tr>



                                            {% endfor %}
                                        </tbody>
                                    </table>
                                {% endif %}

                                <a href="{{ url('servicios.html') }}" class="btn btn-primary btn-raised text-right" role="button">
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
{% endblock %}
