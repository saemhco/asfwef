<p/>

    <div class="row d-flex justify-content-center">
        {% for ambiente in ambientes %} 
            <div class="col-lg-3">
                <div class="card card-light-inverse">
                    <div class="withripple zoom-img" style="margin-top: 30px;">
                        <a href="{{ url('detalle-ambiente/'~ambiente.id_ambiente~".html") }}"><center>{{ image("adminpanel/imagenes/imagenes_ambientes/"~ambiente.imagen, "width":"258", "height":"172") }}</center></a>
                    </div>
                    <div class="card-body" style="margin-top: -15px;">
                        <h6 class="color-primary"><p>{{ utilidades.partedescripcion(ambiente.titular,0,90)}} ...</p></h6>
                        <p class="text-center">                    
                                <a href="{{ url('detalle-ambiente/'~ambiente.id_ambiente~".html") }}" class="btn btn-primary btn-raised text-right" role="button">
                                    <i class="zmdi zmdi-plus"></i><span>Leer Más</span>
                                </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
        
    </div>
        <center>
            <a href="ambientes.html" class="btn btn-primary btn-raised text-right" role="button">
                <i class="fa fa-mail-forward"></i>
                <span>Más Ambientes</span>
            </a>
        </center>
    