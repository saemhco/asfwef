<p/>

    <div class="row d-flex justify-content-center">
        {% for evento in eventos %} 
            <div class="col-lg-3 col-md-6">
                <div class="card card-light-inverse">
                  <div class="withripple zoom-img" style="margin-top: 30px;">
                    <a href="{{ url('detalle-evento/'~evento.id_evento~".html") }}"><center>{{ image("adminpanel/imagenes/imagenes_eventos/"~evento.imagen, "width":"258", "height":"172") }}</center></a>
                </div>
                <div class="card-body" style="margin-top: -15px;">
                    <h6 class="color-primary"><p>{{ evento.titular }}</p><i class="fa fa-clock-o"></i><span class="font-lato"> &nbsp; {{ utilidades.fechita(evento.fecha_hora,"d/m/Y")}}</span></h6>
                    <p class="text-center">                    
                            <a href="{{ url('detalle-evento/'~evento.id_evento~".html") }}" class="btn btn-warning btn-raised text-right" role="button">
                                <i class="zmdi zmdi-plus"></i><span>Leer Más</span>
                            </a>
                    </p>
                </div>
            </div>
          </div>
        {% endfor %}
    </div>
    <center>
        <a href="eventos.html" class="btn btn-warning btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Eventos anteriores</span>
        </a>
    </center>