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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Carrera Profesional </strong></h3>
                    </div>
                    <div class="card-body">          
                        <!-- POST ITEM -->
                        <div class="blog-post-item">

                            <h3><strong>{{ carrera.descripcion }}</strong></h3>
                            <h4><p style="text-align:justify;margin-bottom: -5px;"><strong>Grado Académico:</strong> {{ carrera.grado }}</p></h4>
                            <h4><p style="text-align:justify;margin-bottom: -5px;"><strong>Titulo Profesional: </strong>{{ carrera.titulo }}</p></h4>                                               
                            <h4><p style="text-align:justify;margin-bottom: -5px;"><strong>Modalidad de Estudios:</strong> {{ carrera.modalidad }}</p></h4>
                            <h4><p style="text-align:justify;margin-bottom: -5px;"><strong>Duración: </strong>{{ carrera.duracion }}</p></h4>  
                            
                            <h4><p style="text-align:justify;margin-bottom: -5px;"><strong></strong></p></h4>  
                            <br>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card wow zoomIn">
                                    <div class="ms-thumbnail card-body p-05 ">
                                        <div class="withripple zoom-img">
                                            <a href="{{ url('adminpanel/imagenes/carreras/'~carrera.imagen) }}" data-lightbox="gallery" data-title="{{ carrera.titulo }}" c><img src="{{ url('adminpanel/imagenes/carreras/'~carrera.imagen) }}" alt="" class="img-fluid"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4><p style="text-align:justify;margin-bottom: -5px;">{{ carrera.perfil }}</p></h4>                                               
                            <td><center><h5>

                                        <a href="../adminpanel/archivos/carreras/{{ carrera.archivo }}" target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-1" style ="margin-top: 15px;">
                                            <i class="fa fa-download"></i>
                                            Malla Curricular
                                        </a>
                                </h5></center>
                            </td>
                            <a href="{{ url('web-carreras.html') }}" class="btn btn-primary btn-raised text-right" role="button">
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
