<p/>

    <div class="row d-flex justify-content-center">
        {% for proyecto in proyectos %} 
            <div class="col-lg-4 col-md-6">
                <div class="card card-primary">
                    
                    <div class="card-body">
                        <h6 class="color-primary"><p>{{ proyecto.titulo}}</p><i class="fa fa-clock-o"></i><span class="font-lato"> &nbsp; {{ proyecto.vigencia}}</span></h6>
                        <p class="text-center">                    
                                <a href="{{ url('web-detalle-proyecto-investigacion/'~proyecto.id_proyecto~".html") }}" class="btn btn-primary btn-raised text-right" role="button">
                                    <i class="zmdi zmdi-collection-plus"></i><span>Leer</span>
                                </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    <center>
        <a href="web-proyectos-investigacion.html" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Proyectos anteriores</span>
        </a>
    </center>