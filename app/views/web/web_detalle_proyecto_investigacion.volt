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
            <?php $this->partial('shared/menu3'); ?>
            <!-- CENTER -->
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 				
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-globe"></i>
                        <strong>Detalle del Proyecto de Investigación</strong>
                    
                                            {% if proyecto.etapa == 1 %}
                                            <span class="ml-auto badge badge-default"
                                                style="background-color: #00BCD4;color: white;">PUBLICADO</span>
                                            {% elseif(proyecto.etapa == 2) %}
                                            <span class="ml-auto badge badge-default"
                                                style="background-color: #FF9800;color: white;">EN PROCESO</span>
                                            {% elseif(proyecto.etapa == 3) %}
                                            <span class="ml-auto badge badge-default"
                                                style="background-color: #4CAF50;color: white;">FINALIZADO</span>
                                            {% elseif(proyecto.etapa == 4) %}
                                            <span class="ml-auto badge badge-default"
                                                style="background-color: #da1515;color: white;">ANULADO</span>
                                            {% elseif(proyecto.etapa == 5) %}
                                            <span class="ml-auto badge badge-default"
                                                style="background-color: #da1515;color: white;">CANCELADO</span>
                                            {% endif %}

                    </h3>

                                            

                    </div>
                    <div class="card-body">          
                        <!-- POST ITEM -->
                        <div class="blog-post-item">

                            <h3><strong>{{ proyecto.titulo }}</strong></h3>
                            <p style="text-align:justify;margin-bottom: -2px;"><strong>Investigadores: </strong><br><br>{{ proyecto.investigador }}</p>
                            <br>
                            <p style="text-align:justify;margin-bottom: -5px;"><strong>Tipo Investigación: </strong><br>{{ proyecto.tipo }}</p>
                            <br>
                            <p style="text-align:justify;margin-bottom: -5px;"><strong>Lineas de Investigación: </strong><br>{{ proyecto.lineas }}</p>
                            <br>
                            <p style="text-align:justify;margin-bottom: -5px;"><strong>Objetivo Principal: </strong><br>{{ proyecto.objetivo }}</p>
                            <br>
                            <p style="text-align:justify;margin-bottom: -5px;"><strong>Objetivos Especifícos: </strong><br>{{ proyecto.objetivos }}</p>
                            <br>
                            <strong>Duración: </strong>{{ proyecto.vigencia }}
                            <br>
                            <strong>Presupuesto: </strong>{{ proyecto.presupuesto }}
                            <br>
                            <strong>Entidad que financia: </strong>{{ proyecto.entidad_cooperante }}                           
                            <br>
                            <strong>Local: </strong>{{ proyecto.local_proyecto }}
                            
                            <br>
                            <br>

                            {% if proyecto.etapa == 3 or proyecto.etapa == 2 %}
                            <table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">

                                <thead>
                                    <tr style="background:{{ config.global.xColorIns }};">
                                        <th>
                                            <center>
                                                <font color="#FFFFFF">RESOLUCIÓN</font< /center>
                                        </th>
                                        <th>
                                            <center>
                                                <font color="#FFFFFF">DOCUMENTO</font< /center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td style="color: #000000;">
                                            <center>
                                            <a style="color: #000000; text-align:justify;"
                                                href="../adminpanel/archivos/invproyecto/{{ proyecto.archivo }}"
                                                target="_blank"> {{ proyecto.resumen }} 
                                            </a>
                                            </center>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <center>
                                                <a href="../adminpanel/archivos/invproyecto/{{ proyecto.archivo }}"
                                                    target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-1">
                                                    <i class="fa fa-download"></i> Descargar
                                                </a>
                                            </center>
                                        </td>                                        
                                    </tr>
                                  
                                </tbody>

                            </table>

                            </br>
                            {% endif %}

                            <a href="{{ url('web-proyectos-investigacion.html') }}" class="btn btn-primary btn-raised text-right" role="button">
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
