{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Áreas
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php $this->partial('shared/menu4'); ?>
            <!-- CENTER -->
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><strong>{{ area.nombres }}</strong></h3>
                        </div>
                        <div class="card-body">
                            <center>{{ image("adminpanel/imagenes/personal_areas/"~personal.imagen, "class":"img-fluid", "style":"width:450px;height:300px;") }}</center>                            
                            <div style="text-align: center;"><h4><strong>{{ personal.grado_abreviado}} {{ personal.nombres}} {{ personal.apellidop}} {{ personal.apellidom }}</strong><br>{{ personal.cargo}}</h4></div>                              
                            <br>
                            <p style="text-align:justify;margin-bottom: -5px;">{{ area.descripcion}}</p>
                            <br>
                            {% if noticia.archivo != ''   %}
                                    <h2><strong>Unidades:</strong></h2> 

                                    {% for  personal in personales %}
                                            <div class="heading-title heading-border-bottom heading-color" style="margin-bottom: 20px;">                                                               
                                                <a style="color: #000000; text-decoration: none;" href="{{ config.application.baseUri }}areas-unidades/{{ personal.enlace_a }}.html"><h4><strong><p style="text-align: justify;">{{ personal.oficina }}<p></strong></h4></a>                                                                
                                            </div>                                    
                                    {% endfor %}
                            {% endif %}                         
                        </div>
                    </div>           
            </div>        	
        </div>
    </div>
</div>
{% endblock %}
