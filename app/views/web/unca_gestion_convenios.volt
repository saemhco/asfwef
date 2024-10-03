{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Gestión Convenios
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
                           <h3 class="card-title"><span>Gestión Convenios</span></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <ul style="list-style-type: circle;">
                                <li>
                                    <h4><a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/resoluciones/RES.%20COM.%20ORG.%200197-2022-CO-UNCA.pdf" Style="text-decoration:none"> Resolución que aprueba la Directiva para la formulación, aprobación, suscripción, monitoreo y evaluación de convenios de cooperación interinstitucional. </a></h4>
                                </li>
                                <hr>
                                <li>
                                    <h4><a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/directiva-formulacion-aprobacion-suscripcion-monitoreo-evaluacion-convenios-cooperacion-institucional-430847.pdf" Style="text-decoration:none"> Directiva para la formulación, aprobación, suscripción, monitoreo y evaluación de convenios de cooperación interinstitucional. </a></h4>
                                </li>
                                <hr>
                                <li>
                                        <h4><a href="https://www.unca.edu.pe/adminpanel/archivos/documentos/plan-trabajo-ocri-2022-448891.pdf" Style="text-decoration:none"> Plan de Trabajo de la Oficina de Cooperación y Relaciones Internacionales. </a></h4>
                                </li>                                
                                <hr>
                                <li>
                                    <h4><a target="_blank" href="https://www.unca.edu.pe/web-convenios.html" Style="text-decoration:none"> Convenios de la Universidad Nacional Ciro Alegría. </a></h4>
                                </li>
                                
                            </ul>

                                  
                        </div>            
                    </div>
                </div>                	
            </div>		
        </div>
    </div>
</div>
{% endblock %}
