<p/>

    <div class="row d-flex justify-content-center">
        {% for convenio in convenios %} 
            <div class="col-lg-2 col-md-6">
                <div class="card card-light-inverse">
                    <div class="withripple zoom-img" style="margin-top: 30px;">
                        <a href="{{ url('detalle-convenio/'~convenio.id_convenio~".html") }}"><center>{{ image("adminpanel/imagenes/imagenes_convenios/"~convenio.imagen, "width":"165", "height":"110") }}</center></a>
                    </div>
                    <div class="card-body" style="margin-top: -15px;">
                        <h6 class="color-primary"><p>{{ convenio.titulo}}</p><i class="fa fa-clock-o"></i><span class="font-lato"> &nbsp; {{ convenio.vigencia}}</span></h6>
                        <p class="text-center">                    
                                <a href="{{ url('detalle-convenio/'~convenio.id_convenio~".html") }}" class="btn btn-primary btn-raised text-right" role="button">
                                    <i class="zmdi zmdi-collection-plus"></i><span>Leer</span>
                                </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    <center>
        <a href="convenios.html" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Convenios anteriores</span>
        </a>
    </center>