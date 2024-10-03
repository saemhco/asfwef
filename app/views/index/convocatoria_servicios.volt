<div class="col-md-12 col-sm-12 order-md-2 order-sm-2">    
    {% for convocatoriabs in convocatoriasbs2 %} 
        <article>
            <div class="card card-light-inverse">
                <div class="card-body overflow-hidden overflow-hidden">
                    <div class="row">
                        <div class="col-xl-3">
                              <center>{{ image("adminpanel/imagenes/convocatoriasbs/"~convocatoriabs.imagen, "width":"250", "height":"130") }}</center>
                        </div>
                        <div class="col-xl-9">
                            <a href="{{ url('web-detalle-convocatoriabs/'~convocatoriabs.id_convocatoria_bs~".html") }}" 
                                <h4>{{ utilidades.partedescripcion(convocatoriabs.titulo,0,200)}} </h4>
                                {% if convocatoriabs.etapa == 1   %}
                                    <span class="ml-auto badge badge-default" style="background-color: #00BCD4;color: white;">PUBLICADO</span>
                                {%  elseif(convocatoriabs.etapa == 2) %}
                                    <span class="ml-auto badge badge-default" style="background-color: #FF9800;color: white;">EN PROCESO</span>
                                {%  elseif(convocatoriabs.etapa == 3) %}
                                    <span class="ml-auto badge badge-default" style="background-color: #4CAF50;color: white;">FINALIZADO</span>
                                {% endif %}
                            </a>
                            <h5><span class="text-info">  Publicado por el Comité de Evaluación y Selección - Fecha:  {{ utilidades.fechita(convocatoriabs.fecha_hora,"d/m/Y")}}</span></h5>
                            <h5><p style="text-align:justify">{{ convocatoriabs.texto_muestra}}</p></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">              
                        </div>
                        <div class="col-lg-2 text-right">
                            <a href="{{ url('web-detalle-convocatoriabs/'~convocatoriabs.id_convocatoria_bs~".html") }}" class="btn btn-primary btn-raised btn-block animate-icon">Leer Más ... <i class="ml-1 no-mr zmdi zmdi-long-arrow-right"></i></a>
                        </div>
                    </div>
                  </div>
            </div>
        </article>       
        
    {% endfor %}
    <center>
        <a href="convocatoriabss/1.html" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Convocatorias anteriores</span>
        </a>
    </center>
</div>
            