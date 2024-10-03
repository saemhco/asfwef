<p/>

    <div class="row d-flex justify-content-center">
        {% for noticia in noticias %} 
            <div class="col-lg-3 col-md-6">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="ms-thumbnail-container wow fadeInUp">
                        <figure class="ms-thumbnail">
                            {{ image("adminpanel/imagenes/botones/convocatoria-cas.jpg", "class":"img-fluid", "alt":"") }}
                            <figcaption class="ms-thumbnail-caption text-center">
                                <div class="ms-thumbnail-caption-content">
                                  <h3 class="ms-thumbnail-caption-title"></h3>
                                  <p></p>
                                  <a href="https://www.unca.edu.pe/web-convocatorias/1.html" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Acceder ...</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                
                <div class="card card-light-inverse">
                    <div class="withripple zoom-img" style="margin-top: 30px;">
                        <a href="{{ url('web-detalle-noticia/'~noticia.id_noticia~".html") }}"><center>{{ image("adminpanel/imagenes/noticias/"~noticia.imagen, "width":"258", "height":"172") }}</center></a>
                    </div>
                    <div class="card-body" style="margin-top: -15px;">
                        <h6 class="color-primary"><p>{{ utilidades.partedescripcion(noticia.titular,0,90)}} ...</p><i class="fa fa-clock-o"></i><span class="font-lato"> &nbsp; {{ utilidades.fechita(noticia.fecha_hora,"d/m/Y")}}</span></h6>
                        <h6><p style="text-align:justify;">{{ utilidades.partedescripcion(noticia.texto_muestra,0,90)}} &nbsp ...</p></h6>
                        <p class="text-center">                    
                                <a href="{{ url('web-detalle-noticia/'~noticia.id_noticia~".html") }}" class="btn btn-primary btn-raised text-right" role="button">
                                    <i class="zmdi zmdi-plus"></i><span>Leer Más</span>
                                </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    <center>
        <a href="web-noticias.html" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Noticias anteriores</span>
        </a>
    </center>