{% block content %}
   

<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Resultados del Examen de Admisión
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php // $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">            				
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Modalidad Extraordinario</strong></h3>
                    </div>
                    <div class="card-body">
                       

           
                            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 
                                <div class="card">
                                    <div class="embed-responsive embed-responsive-16by9">
                                            <embed src="adminpanel/archivos/admision/resultados-extraordinario-24-I.pdf" width=845 height=1080>
                                    </div>
                                </div>
                            
                            
                                <center>    
                                    
                                    <a href="adminpanel/archivos/admision/resultados-extraordinario-24-I.pdf" target="_blank"
                                        class="btn btn-reveal btn-primary b-0 btn-shadow-2">
                                        <i class="fa fa-download"></i> Descargar
                                    </a>
                                </center>
                            </div>                


                    </div>
                </div>                
                           
            </div>

   
            </div>

        </div>
    </div>
</div>

<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php // $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">                         
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Modalidad Ordinario</strong></h3>
                    </div>
                    <div class="card-body">
                       

           
                            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 
                                <div class="card">
                                    <div class="embed-responsive embed-responsive-16by9">
                                            <embed src="adminpanel/archivos/admision/resultados-ordinario-24-I.pdf" width=845 height=1080>
                                    </div>
                                </div>
                            
                            
                                <center>    
                                    
                                    <a href="adminpanel/archivos/admision/resultados-ordinario-24-I.pdf" target="_blank"
                                        class="btn btn-reveal btn-primary b-0 btn-shadow-2">
                                        <i class="fa fa-download"></i> Descargar
                                    </a>
                                </center>
                            </div>                


                    </div>
                </div>                
                           
            </div>

   
            </div>

        </div>
    </div>
</div>
{% endblock %}