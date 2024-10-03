<p/>

    <div class="row d-flex justify-content-center">
        {% for galeria in galerias %} 
            <div class="col-lg-3">
                <div class="card card-light-inverse">
                    <div class="withripple zoom-img" style="margin-top: 30px;">
                        <a href="{{ url('web-detalle-galeria/'~galeria.id_galeria~".html") }}"><center>{{ image("adminpanel/imagenes/galerias/"~galeria.imagen, "width":"258", "height":"172") }}</center></a>
                    </div>
                    <div class="card-body" style="margin-top: -15px;">
                        <h6 class="color-primary"><p>{{ utilidades.partedescripcion(galeria.titular,0,90)}} ...</p></h6>
                        <h6><p style="text-align:justify;">{{ utilidades.partedescripcion(galeria.texto_muestra,0,110)}} &nbsp ...</p></h6>
                        <p class="text-center">                    
                                <a href="{{ url('web-detalle-galeria/'~galeria.id_galeria~".html") }}" class="btn btn-primary btn-raised text-right" role="button">
                                    <i class="zmdi zmdi-plus"></i><span>Leer Más</span>
                                </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
        
    </div>
        <center>
            <a href="web-galerias.html" class="btn btn-primary btn-raised text-right" role="button">
                <i class="fa fa-mail-forward"></i>
                <span>Más Servicios</span>
            </a>
        </center>
    