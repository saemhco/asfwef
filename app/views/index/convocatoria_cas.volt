<div class="col-md-12 col-sm-12 order-md-2 order-sm-2">    
    {% for convocatoria in convocatorias %} 
        <article>
            <div class="card card-light-inverse">
                <div class="card-body overflow-hidden overflow-hidden">
                    <div class="row">
                        <div class="col-xl-3">
                              <center>{{ image("adminpanel/imagenes/convocatorias/"~convocatoria.imagen, "width":"250", "height":"130") }}</center>
                        </div>
                        <div class="col-xl-9">
                            <a href="{{ url('web-detalle-convocatoria/'~convocatoria.id_convocatoria~".html") }}" 
                                <h4>{{ utilidades.partedescripcion(convocatoria.titulo,0,200)}} </h4>
                                {% if convocatoria.etapa == 1   %}
                                    <span class="ml-auto badge badge-default" style="background-color: #00BCD4;color: white;">PUBLICADO</span>
                                {%  elseif(convocatoria.etapa == 2) %}
                                    <span class="ml-auto badge badge-default" style="background-color: #FF9800;color: white;">EN PROCESO</span>
                                {%  elseif(convocatoria.etapa == 3) %}
                                    <span class="ml-auto badge badge-default" style="background-color: #4CAF50;color: white;">FINALIZADO</span>
                                {% endif %}
                            </a>
                            <h5><span class="text-info">  Publicado por el Comité de Evaluación y Selección - Fecha:  {{ utilidades.fechita(convocatoria.fecha_hora,"d/m/Y")}}</span></h5>
                            <h5><p style="text-align:justify">{{ convocatoria.texto_muestra}}</p></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">              
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ url('web-detalle-convocatoria/'~convocatoria.id_convocatoria~".html") }}" class="btn btn-primary btn-raised btn-block animate-icon">Leer Más ... <i class="ml-1 no-mr zmdi zmdi-long-arrow-right"></i></a>
                        </div>
                    </div>
                  </div>
            </div>
        </article>       
        
    {% endfor %}
    <center>
        <a href="convocatorias/1.html" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Convocatorias anteriores</span>
        </a>
    </center>
</div>
            