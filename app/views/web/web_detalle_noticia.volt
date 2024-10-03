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
                            <h3 class="card-title"><i class="fa fa-globe"></i><strong>Detalle de la Noticia</strong></h3>
                        </div>
                        <div class="card-body">    
                            <!-- POST ITEM -->
                            <div class="blog-post-item">

                                <h3><span>{{ noticia.titular }}</span></h3>

                                <ul class="blog-post-info list-inline">
                                    <li>                                       
                                        <i class="fa fa-calendar"></i> 
                                        <span class="font-lato">{{ utilidades.fechita(noticia.fecha_hora,"d/m/Y")}}</span>

                                    </li>

                                </ul>
                                <!-- OWL SLIDER -->
                                <div>
                                    <center>
                                        <div id="carousel-example-generic" class="ms-carousel carousel slide" data-ride="carousel" {#style="width: 600px;border: 3px solid #C0C0C0;"#}>


                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">
                                                {% if activa_imagenes == 1 %} 
                                                    {% set codigo_active = noticia_imagen_active.id_noticia_detalle %}
                                                    {% for  noticia_imagen in noticias_imagenes  %}
                                                        <div class="carousel-item {% if noticia_imagen.id_noticia_detalle == codigo_active %} active {% endif %}">
                                                            {{ image("adminpanel/imagenes/noticias_detalles/"~noticia_imagen.imagen_detalle, "class":"d-block img-fluid", "alt":"") }}
                                                            <div class="carousel-caption">

                                                            </div>
                                                        </div>
                                                    {% endfor %}
                                                {% elseif activa_imagenes == 0 %}
                                                    <div class="carousel-item active">
                                                        {{ image("adminpanel/imagenes/noticias/"~noticia.imagen, "class":"d-block img-fluid", "alt":"") }}

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
                                <p>{{ noticia.texto_complementario }}</p>

                                {% if noticia.archivo != ''   %}
                                    <div style="text-align: center;">
                                        <a href="../adminpanel/archivos/noticias/{{ noticia.archivo }}" target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-1">
                                            <i class="fa fa-download"></i> Descargar
                                        </a>
                                    </div>
                                {% endif %}
                                <br>

                                <ul>
                                    <li><a href="#" target="_blank" rel="" id="facebook" class="link facebook">Comparte por facebook</a></li>
                                    <li><a href="#" target="_blank" rel="" id="whatsapp" class="link whatsapp">Comparte este post por Whatsapp</a></li>
                                    <li><a href="#" target="_blank" rel="" id="linkedin" class="link linkedin">Comparte este post en LinkedIn</a></li>
                                    <li><a href="#" target="_blank" rel="" id="twitter" class="link twitter">Comparte este post en Twitter</a></li>
                                    </ul>

                                <a href="{{ url('web-noticias.html') }}" class="btn btn-primary btn-raised text-right" role="button">
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
<script>
    setTimeout(function(){
        var url=window.location.href;
        document.getElementById("facebook").setAttribute("href", "https://www.facebook.com/sharer/sharer.php?u="+url);
    document.getElementById("whatsapp").setAttribute("href", "https://api.whatsapp.com/send?text="+url);
    document.getElementById("linkedin").setAttribute("href", "https://www.linkedin.com/sharing/share-offsite/?url="+url);
    document.getElementById("twitter").setAttribute("href", "https://twitter.com/intent/tweet?text=&url="+url);
    },1000)
    

</script>