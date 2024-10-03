<div class="card card-royal">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-royal nav-tabs-full nav-tabs-1" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#Miscelania1" aria-controls="Miscelania1" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Comunicaciones</span></a></li>        
    </ul>

    <div class="card-body" style="margin-bottom: -20px;">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Miscelania1">
                
                    <div class="card card-light-inverse wow zoomInUp">
                            <div class="row" style="margin-bottom: -42px;">        
                                {% if  config.global.xAbrevIns  == 'UNCA'  %}
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/noticias.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-noticias.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/eventos.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-eventos.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/boletines.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-boletines.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/videos.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-videos.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
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