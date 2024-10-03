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
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 				
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Detalle del Convenio</strong></h3>
                    </div>
                    <div class="card-body">          
                        <!-- POST ITEM -->
                        <div class="blog-post-item">

                            <h3><span>{{ convenio.titulo }}</span></h3>

                            

                            <!-- OWL SLIDER -->
                            <div>
                                <center>
                                    {{ image("adminpanel/imagenes/convenios/"~convenio.imagen, "class":"img-fluid", "alt":"") }}
                                </center>
                            </div>

                            <!-- /OWL SLIDER -->
                            <ul class="blog-post-info list-inline">
                                <li>                                   
                                        <i class="fa fa-calendar"></i> 
                                        <span class="font-lato">Vigencia: {{ convenio.vigencia}}  /  </span>
                                        <i class="fa fa-calendar"></i>
                                        <span class="font-lato"> Fecha inicio: {{ utilidades.fechita(convenio.fecha_inicio,"d/m/Y")}}  /  </span>
                                        <i class="fa fa-calendar"></i>
                                        <span class="font-lato"> Fecha termino: {{ utilidades.fechita(convenio.fecha_termino,"d/m/Y")}}</span><br>
                                    
                                </li>

                            </ul>
                            <!-- aca se junta texto muestra y texto complementario  -->
                            <p><strong>Objeto del Convenio:</strong><br>{{ convenio.objeto }}</p>
                            <p><strong>Compromiso(s):</strong> <br>{{ convenio.compromiso }}</p>
                            <p><strong>Entidad Cooperante:</strong><br>{{ convenio.entidad_cooperante }}</p>                         
                            <p><strong>Compromiso(s): </strong><br>{{ convenio.compromiso_cooperante }}</p>
                            

                            <p><strong>Referencia: </strong><br><a href="../adminpanel/archivos/resoluciones/{{ resolucion.archivo }}" target="_blank">{{ resolucion.titulo }}</a></p>
                                    
                  
                            
                            
                            {% if convenio.archivo != ''   %}
                            <br>
                                
                                    <div style="text-align: center;">
                                        <a href="../adminpanel/archivos/convenios/{{ convenio.archivo }}" target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-1">
                                            <i class="fa fa-download"></i> Descargar
                                        </a>
                                    </div>
                            {% endif %}
                            <br>
                            <a href="{{ url('web-convenios.html') }}" class="btn btn-primary btn-raised text-right" role="button">
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
