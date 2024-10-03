
{% block content %}
   

<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Presentación
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Creación de la Universidad Nacional Ciro Alegría</strong></h3>
                    </div>
                    <div class="card-body">
                        <h4><p style="text-align: justify;">La Universidad Nacional Ciro Alegría en adelante UNCA, creada por Ley N° 29756, publicada en el diario el peruano el 17 de julio de 2011, es una persona jurídica de derecho público interno con domicilio en la Ciudad de Huamachuco. Tiene su sede en el distrito de Huamachuco, provincia de Sánchez Carrión, región La Libertad.</p></h4>
                    </div>
                </div>                
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>La UNCA</strong></h3>
                    </div>
                    <div class="card-body">
                        <h4><p style="text-align: justify;">La UNCA es una comunidad académica orientada a la investigación y a la docencia, que brinda una formación humanista, científica y tecnológica con una clara conciencia de nuestro país como realidad multicultural. Adopta el concepto de educación como derecho fundamental y servicio público esencial. Integrada por docentes, estudiantes y graduados.</p></h4>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
{% endblock %}