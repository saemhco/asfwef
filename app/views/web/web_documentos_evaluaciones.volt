{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                Documentos de Gestión
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php $this->partial('shared/menu2'); ?>
 
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><strong>{{ documento.titulo }}</strong></h3>
                    </div>
                    <div class="card-body">

                        <ul style="list-style-type: disc;">
                            {% if resolucion.id_resolucion != '' OR  resolucion.id_resolucion != null %}
                            <i class="fa fa-book"></i>&nbsp&nbsp&nbsp
                            <a style="color: #000000; text-decoration: none;"
                                href="../adminpanel/archivos/resoluciones/{{ resolucion.archivo }}" target="_blank">

                                
                                
                                Aprobado con: {{ resolucion.titulo }} </a>
                                {% endif %}
                        </ul>

                        <center>
                            <div class="embed-responsive embed-responsive-16by9">
                                <embed src="../adminpanel/archivos/documentos_evaluaciones/{{ documento.archivo }}" width=845
                                    height=1080>
                            </div>
                            <br>
                            <a href="../adminpanel/archivos/documentos_evaluaciones/{{ documento.archivo }}" target="_blank"
                                class="btn btn-reveal btn-primary b-0 btn-shadow-2">
                                <i class="fa fa-download"></i> Descargar
                            </a>
                        </center>

                                               

                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
{% endblock %}