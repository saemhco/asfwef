{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}                 
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>UNCA</strong></h3>
                    </div>
                    <div class="card-body">
                        <center>
                            <br><br><br>
                        <span style="color:#2600ff">UNIVERSIDAD NACIONAL CIRO ALEGRIA - UNCA</span><br/>
                        <span style="color:#2600ff">(LA LIBERTAD / SANCHEZ CARRION / HUAMACHUCO)</span><br/>
                        <span style="color:#2600ff">RUC 20602391583</span><br/>
                        <span style="color:#FF0000">INFORMACIÓN ESTARÁ DISPONIBLE CUANDO INICIEN LOS PERIODOS ACADÉMICOS...</span>
                        </center>
                        <br><br><br>
                    </div>
                </div>
                             
                            
            </div>
        </div>
    </div>
</div>
{% endblock %}
