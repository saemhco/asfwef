{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Costos de Inscripción
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>¡ IMPORTANTE !</strong></h3>
                    </div>
                    <div class="card-body">
                        <h4><p style="text-align: justify;"> 
                            Para participar del examen de admisión de la UNCA, primero tiene que pre-inscribirse de manera virtual por la Plataforma de Admisión, completando sus datos y luego realizar el pago correspondiente, el pago se realiza en cualquier medio de pago del Banco de la Nación.
                        </br>
                        </br>
                            Los costos son por tipo de modalidad de admisión (Ordinario y Extraordinario).
                        </br>
                        </br>
                            Luego de realizar el pago correspondiente debe VERIFICAR SU INSCRIPCIÓN (desde la Plataforma de Admisión).
                        </br>
                        </br>
                        <b>
                        Según el Reglamento de Admisión: Los pagos realizados a favor de la Universidad Nacional Ciro Alegría por el concepto de derecho al examen de Admisión, se realiza en la entidad financiera que la Universidad autorice. Los pagos efectuados no serán reembolsados en ninguna circunstancia.
                        </b>   
                        </p></h4>
                    </div>
                </div>                
                           
            </div>
        </div>


        <div class="row">
           
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 
                <div class="card">
                    <div class="embed-responsive embed-responsive-16by9">
                            <embed src="adminpanel/archivos/admision/costos-inscripcion-2024-I.pdf" width=845 height=1080>
                    </div>
                </div>
            
            
                <center>    
                    
                    <a href="adminpanel/archivos/admision/costos-inscripcion-2024-I.pdf" target="_blank"
                        class="btn btn-reveal btn-primary b-0 btn-shadow-2">
                        <i class="fa fa-download"></i> Descargar
                    </a>
                </center>
            </div>                  
	</div>		
    </div>
    </div>
</div>
{% endblock %}
