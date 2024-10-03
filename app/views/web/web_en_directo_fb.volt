{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                “EN DIRECTO - FB”
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
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>EN DIRECTO FACEBOOK...</strong></h3>
                    </div>
                    <div class="card-body">
                        <center>
                            <!-- Colocar o automatizar esta vista -->
                            <!-- <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F  enlace 10153231379946729  enlace    %2F&width=500&show_text=false&height=280&appId" width="500" height="280" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe> -->
                            {{videosfb.enlace}}
                            <!-- Colocar o automatizar esta vista prueba-->
                        </center>
                    </div>
                </div>
                             
                
            </div>
        </div>
    </div>
</div>
{% endblock %}