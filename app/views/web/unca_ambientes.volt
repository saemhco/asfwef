{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Ambientes
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Servicio de Salud - Tópicos</strong></h3>
                    </div>
                    <div class="card-body">                                        
                        <center>{{ image("adminpanel/imagenes/ambientes/salud1.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>
                        <br><br>
                        <center>{{ image("adminpanel/imagenes/ambientes/salud2.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>                                
                    </div>
                </div>
                
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Servicio Social</strong></h3>
                    </div>
                    <div class="card-body">			
                        <center>{{ image("adminpanel/imagenes/ambientes/social1.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>                                    
                    </div>
                </div>
                    
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Servicio Psicopedagógico</strong></h3>
                    </div>
                    <div class="card-body">
                        <center>{{ image("adminpanel/imagenes/ambientes/psicopedagogico1.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>
                    </div>
                </div>
                                        
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Servicios Culturales, Deportivos y Artísticos</strong></h3>
                    </div>
                    <div class="card-body">
			<center>{{ image("adminpanel/imagenes/ambientes/cultural1.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>
                        <br><br>
                        <center>{{ image("adminpanel/imagenes/ambientes/deportivos1.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>
                        <br><br>
                        <center>{{ image("adminpanel/imagenes/ambientes/cultural2.jpg", "class":"img-fluid", "style":"width:600px;height:400px;") }}</center>                        
                    </div>
                </div>                                	
            </div>
	</div>
    </div>
</div>
{% endblock %}
