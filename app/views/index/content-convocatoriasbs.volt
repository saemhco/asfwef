<div class="card-body" style="background: white;" >
   

    <div class="text-center mb-4">
        <p style="font-size: 25px;">CONVOCATORIAS Y REGISTRO</p>            
        <p style="font-size: 30px; color: #326ab7;"></p>            
        </p>
    </div>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Convocatorias">
               

            <div class="row">
                <div class="col-xl-2 col-md-4 mb-2">
                    <label></label>
                </div>
               
                <div class="col-xl-2 col-md-4 mb-2">
                    <div class="ms-thumbnail-container wow fadeInUp">
                        <figure class="ms-thumbnail">
                            {{ image("adminpanel/imagenes/botones/btn_convocatoria_bienes.png", "class":"img-fluid", "alt":"") }}
                            <figcaption class="ms-thumbnail-caption text-center">
                                <div class="ms-thumbnail-caption-content">
                                  <h3 class="ms-thumbnail-caption-title"></h3>
                                  <p></p>
                                  <a href="https://www.unca.edu.pe/web-convocatoriasbs/1.html" class="btn btn-white btn-raised color-primary">Ingresar</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>


                <div class="col-xl-2 col-md-4 mb-2">
                    <div class="ms-thumbnail-container wow fadeInUp">
                        <figure class="ms-thumbnail">
                            {{ image("adminpanel/imagenes/botones/btn_convocatoria_servicios.png", "class":"img-fluid", "alt":"") }}
                            <figcaption class="ms-thumbnail-caption text-center">
                                <div class="ms-thumbnail-caption-content">
                                  <h3 class="ms-thumbnail-caption-title"></h3>
                                  <p></p>
                                  <a href="https://www.unca.edu.pe/web-convocatoriasbs/2.html" class="btn btn-white btn-raised color-primary">Ingresar</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>


                <div class="col-xl-2 col-md-4 mb-2">
                    <div class="ms-thumbnail-container wow fadeInUp">
                        <figure class="ms-thumbnail">
                            {{ image("adminpanel/imagenes/botones/btn_registro_proveedores.png", "class":"img-fluid", "alt":"") }}
                            <figcaption class="ms-thumbnail-caption text-center">
                                <div class="ms-thumbnail-caption-content">
                                  <h3 class="ms-thumbnail-caption-title"></h3>
                                  <p></p>
                                  <a target="_blank" href="https://www.unca.edu.pe/login-proveedores.html" class="btn btn-white btn-raised color-primary">Ingresar</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 mb-2">
                    <div class="ms-thumbnail-container wow fadeInUp">
                        <figure class="ms-thumbnail">
                            {{ image("adminpanel/imagenes/botones/btn_registro_empresas.png", "class":"img-fluid", "alt":"") }}
                            <figcaption class="ms-thumbnail-caption text-center">
                                <div class="ms-thumbnail-caption-content">
                                  <h3 class="ms-thumbnail-caption-title"></h3>
                                  <p></p>
                                  <a target="_blank" href="https://www.unca.edu.pe/login-empresas.html" class="btn btn-white btn-raised color-primary">Ingresar</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>

               

               


               


            </div>


              




            </div>
        </div>
    
</div> 




<!--
<div class="card card-warning">
    
    <ul class="nav nav-tabs nav-tabs-transparent indicator-warning nav-tabs-full nav-tabs-3" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#ConvocatoriasBs" aria-controls="Convocatorias" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Convocatorias de </span></a></li>        
    </ul>

    <div class="card-body" style="margin-bottom: -20px;">
    
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="ConvocatoriasBs">
                
                    <div class="card card-light-inverse">
                            <div class="row" style="margin-bottom: -42px;">        
                                {% if  config.global.xAbrevIns  == 'UNCA'  %}

                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/convocatoria-bienes.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-convocatoriasbs/1.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/convocatoria-servicios.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/web-convocatoriasbs/2.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="ms-thumbnail-container wow fadeInUp">
                                            <figure class="ms-thumbnail">
                                                {{ image("adminpanel/imagenes/botones/registro-proveedores.jpg", "class":"img-fluid", "alt":"") }}
                                                <figcaption class="ms-thumbnail-caption text-center">
                                                    <div class="ms-thumbnail-caption-content">
                                                      <h3 class="ms-thumbnail-caption-title"></h3>
                                                      <p></p>
                                                      <a href="https://www.unca.edu.pe/login-proveedores.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
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
</div> 
-->