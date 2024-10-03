<p/>      
    <div class="row" style="margin-bottom: -30px;">
        {% for noticia in noticias %} 
                <div class="col-xl-4 col-md-6 mb-3">                    
                    <div class="ms-thumbnail-container wow fadeInUp">
                        <figure class="ms-thumbnail"  style="margin-top: 10px;">
                            {{ image("adminpanel/imagenes/noticias/"~noticia.imagen, "width":"200", "height":"150") }}
                            <figcaption class="ms-thumbnail-caption text-center">
                                <div class="ms-thumbnail-caption-content">
                                  <h3 class="ms-thumbnail-caption-title"></h3>
                                  <p></p>
                                  <a href="{{ url('web-detalle-noticia/'~noticia.id_noticia~".html") }}" class="btn btn-white btn-raised color-primary"><i class="zmdi zmdi-eye"></i> Leer más ...</a>
                                </div>
                            </figcaption>
                        </figure>
                        <a href="{{ url('web-detalle-noticia/'~noticia.id_noticia~".html") }}">
                        <h6 class="color-primary"><p style="font-size:11px;"> {{ utilidades.partedescripcion(noticia.titular,0,120)}}</p></a>
                        <i class="fa fa-calendar"></i><span class="font-lato" style="font-size:11px;"> &nbsp; {{ utilidades.fechita(noticia.fecha_hora,"d/m/Y")}}</span></h6>
                        <h6><p style="text-align:justify;font-size:11px;">{{ utilidades.partedescripcion(noticia.texto_muestra,0,200)}}</p></h6>

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