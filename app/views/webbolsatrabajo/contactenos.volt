{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Dirección
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Sedes de la Universidad Nacional Ciro Alegría</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1">              
                            </div>
                            <div class="col-lg-8">
                                    <!-- Contacts -->
                                    <ul class="footer-links list-unstyled">
                                        <i></i><strong>SEDE ACADÉMICA</strong><br>
                                        <i class="fa fa-home"></i>&nbsp Jr. Ramiro Prialé N° 570  <a {{ url('https://goo.gl/maps/D4h6yu6wXuQnBnKF7') }}  target="_blank" rel="noopener">{{ image("webpage/assets/img/icons/ubicacion.png", "class":"img-fluid", "style":"width:35px;height:28px;") }}</a><br />
                                        <i class="fa fa-phone"></i>&nbsp +51 044 365462 <br /><br>
                                        <hr>
                                        <i></i><strong>SEDE LABORATORIOS</strong><br>
                                        <i class="fa fa-home"></i>&nbsp Jr. Garcilazo de la Vega N° 905  <a {{ url('https://goo.gl/maps/D4h6yu6wXuQnBnKF7') }} target="_blank" rel="noopener">{{ image("webpage/assets/img/icons/ubicacion.png", "class":"img-fluid", "style":"width:35px;height:28px;") }}</a><br />
                                        <i class="fa fa-phone"></i>&nbsp +51 044 365397 <br /><br>
                                        <hr>
                                        <i></i><strong>SEDE ADMINISTRATIVA</strong><br>								
                                        <i class="fa fa-home"></i>&nbsp Jr. Miguel Grau N° 459 – 469  <a {{ url('https://goo.gl/maps/D4h6yu6wXuQnBnKF7') }}  target="_blank" rel="noopener">{{ image("webpage/assets/img/icons/ubicacion.png", "class":"img-fluid", "style":"width:35px;height:28px;") }}</a><br />
                                        <i class="fa fa-phone"></i>&nbsp +51 044 365463 <br /><br>
                                        <hr>
                                    </ul>
                                    <!-- Business Hours -->
                                    <h3>Horario de Atención</h3>
                                    <ul class="list-unstyled">
                                            <li><strong>Lunes-Viernes:</strong> 8:00am a 01:00pm - 02:30pm a 05:30pm</li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
        </div>
    </div>
</div>
{% endblock %}
