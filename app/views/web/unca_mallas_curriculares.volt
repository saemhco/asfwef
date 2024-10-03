{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Mallas Curriculares
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Mallas Curriculares</strong></h3>
                    </div>
                    <div class="card-body">

                        <ul style="list-style-type: circle;"> 
                            <li>
                                    <h4><a href="{{ url('web-documentos/'~'malla-curricular-ingenieria-agricola-forestal'~".html") }}" Style="text-decoration:none"> Ingeniería Agrícola y Forestal. </a></h4>
                            </li>
                            <hr>
                            <li>
                                    <h4><a href="{{ url('web-documentos/'~'malla-curricular-ingenieria-civil-diseno-arquitectonico'~".html") }}" Style="text-decoration:none"> Ingeniería Civil y Diseño Arquitectónico. </a></h4>
                            </li>
                            <hr>                                            
                            <li>
                                    <h4><a href="{{ url('web-documentos/'~'malla-curricular-gestion-turistica-hoteleria-gastronomia'~".html") }}" Style="text-decoration:none"> Gestión Turística, Hotelería y Gastronomía. </a></h4>
                            </li>

                        </ul>

                    </div>
                </div>
                
                	
	</div>
	
    </div>
    </div>
</div>
{% endblock %}
