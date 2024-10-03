{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Comisión Organizadora
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
                {% for autoridad in autoridades %}
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="fa fa-globe"></i><strong>{{ autoridad.cargo }}</strong></h3>
                        </div>
                        <div class="card-body">                            
                            <center><a target="_blank" style="color: #000000; text-decoration: none;" href="{{ autoridad.peru_enlace }}">{{ image("adminpanel/imagenes/autoridades/"~autoridad.imagen, "class":"img-fluid", "style":"width:450px;height:300px;") }}  </a></center>
                            <br>
                            <a target="_blank" style="color: #000000; text-decoration: none;" href="{{ autoridad.peru_enlace }}"><h3 style="text-align: center;"><span style="color: #000000;"><strong>{{ autoridad.grado_abreviado}} {{ autoridad.nombres}} {{ autoridad.apellidop}} {{ autoridad.apellidom }}</strong></span></h3></a>
                            <h5><p style="text-align:justify;margin-bottom: -5px;">{{ autoridad.descripcion}}</p></h5>                                                     
                        </div>
                    </div>
                {% endfor %}
            </div>
        </div>
    </div>
</div>
{% endblock %}
