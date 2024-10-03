<div class="card card-info">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-info nav-tabs-full nav-tabs-3" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#Galerias" aria-controls="Galerias" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Galerias</span></a></li>        
    </ul>

    <div class="card-body animation-delay-7" style="margin-bottom: -20px;">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Galerias">
                
                    <div class="card card-light-inverse wow zoomInUp">
                            <div class="row" style="margin-bottom: -42px;">        
                                {% if  config.global.xAbrevIns  == 'UNCA'  %}

                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/galerias.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-galerias/1.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
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