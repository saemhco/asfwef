{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Centros de Pagos
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Banco de la Nación</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1">              
                            </div>
                            <div class="col-lg-8">
                                <h4><p> Cuenta Corriente N°  00-801-051057</p></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Caja Trujillo</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1">              
                            </div>
                            <div class="col-lg-8">
                                <h4><p> Pago con código de Estudiante</p></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
        </div>
    </div>
</div>
{% endblock %}
