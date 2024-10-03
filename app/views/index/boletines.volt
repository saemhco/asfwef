<p/>

    <div class="row d-flex justify-content-center">
        {% for boletin in boletines %} 
            <div class="col-lg-3 col-md-6">
                <div class="card card-light-inverse">
                  <div class="withripple zoom-img" style="margin-top: 30px;">
                    <a target="_blank" href="{{ url('adminpanel/archivos/boletines/'~boletin.archivo) }}"><center>{{ image("adminpanel/imagenes/boletines/"~boletin.imagen, "width":"258", "height":"172") }}</center></a>
                </div>
                <div class="card-body" style="margin-top: -15px;">
                    <h6 class="color-primary"><p>{{ boletin.titular }}</p><i class="fa fa-clock-o"></i><span class="font-lato"> &nbsp; {{ utilidades.fechita(boletin.fecha_hora,"d/m/Y")}}</span></h6>
                    <p class="text-center">                    
                            <a target="_blank" href="{{ url('adminpanel/archivos/boletines/'~boletin.archivo) }}" class="btn btn-warning btn-raised text-right" role="button">
                                <i class="zmdi zmdi-plus"></i><span>Ver ...</span>
                            </a>
                    </p>
                </div>
            </div>
          </div>
        {% endfor %}
    </div>
    