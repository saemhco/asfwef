{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
              <!--  <! {{ config.global.xSeparadorIns }}-->
                Dirección CEPRE-UNCA
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
           <!-- <?php // $this->partial('shared/menu1'); ?>
             CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 
				
                    <div class="card card-primary">
                        <div class="card-header">						
                          <h3 class="card-title"><strong>CEPRE-UNCA</strong></h3>
                        </div>
						<br>
                        <div class="card-body">
                            <center>{{ image("adminpanel/imagenes/docentes/IMG-12.jpg", "class":"img-fluid", "style":"width:450px;height:300px;") }}</center>                            
                            <div style="text-align: center;"><h4><strong>MG. JAVIER ALEJANDRO MANRIQUE CATALAN</strong><br>Director</h4></div>                              
                                                                            
                        </div>
						
						<div class="card-body">
                            <center>{{ image("adminpanel/imagenes/docentes/IMG-9.jpg", "class":"img-fluid", "style":"width:450px;height:300px;") }}</center>                            
                            <div style="text-align: center;"><h4><strong>MG. FREDY JULIO FLORES MOSCOL</strong><br>Coordinador Académico</h4></div>                              
                                                                            
                        </div>
                    </div>       
					
            </div>        	
        </div>
    </div>
</div>
{% endblock %}

