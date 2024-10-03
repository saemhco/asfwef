{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Unidades
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
                          <h3 class="card-title"><strong>{{ area.nombres }}</strong></h3>
                        </div>
                        <div class="card-body">
                            {% for  personal in personales %}                                    
                                    <center><a target="_blank" style="color: #000000; text-decoration: none;" href="{{ personal.concytec_enlace }}">{{ image("adminpanel/imagenes/personal_areas/"~personal.imagen, "class":"img-fluid", "style":"width:450px;height:300px;") }}  </a></center>                                    
                                    <a target="_blank" style="color: #000000; text-decoration: none;" href="{{ personal.concytec_enlace }}"><div style="text-align: center;"><h4><strong>{{ personal.grado_abreviado}} {{ personal.nombres}} {{ personal.apellidop}} {{ personal.apellidom }}</strong><br>{{ personal.cargo}}<br>{{ personal.oficina}}</h4></div></a>
                            {% endfor %}
                            <br>
                            <p style="text-align:justify;margin-bottom: -5px;">{{ area.descripcion}}</p>                                                     
                        </div>
                    </div>           
            </div>        	
        </div>
    </div>
</div>
{% endblock %}