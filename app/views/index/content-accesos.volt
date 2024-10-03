<div class="card card-info">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-info nav-tabs-full nav-tabs-2" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#Miscelania1" aria-controls="Miscelania1" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Accesos a los Sistemas de Información de la UNCA</span></a></li>        
    </ul>

    <div class="card-body" style="margin-bottom: -20px;">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Miscelania1">
                
                    <div class="card card-light-inverse wow zoomInUp">
                            <div class="row" style="margin-bottom: -42px;">        
                                {% if  config.global.xAbrevIns  == 'UNCA'  %}
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/estudiantes.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/login.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/docentes.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/login.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/administrativos.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/login-interno.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/empresas.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/login-empresas.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/ciudadanos.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/login-externo.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                {% endif %}
                            </div>
                        </div>
                    
            </div>            
        </div>
    </div>
</div> <!-- card -->