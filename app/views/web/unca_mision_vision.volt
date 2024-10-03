
{% block content %}

<div
  class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee"
  style="height: 70px !important"
>
  <div class="container">
    <div class="text-left">
      <h2 style="color: #757575; margin-top: -15px !important">
        {{ config.global.xSeparadorIns }}
        Misión y Visión
      </h2>
    </div>
  </div>
</div>
<div class="container container-full" style="margin-top: -50px">
  <div class="ms-paper">
    <div class="row">
      <?php $this->partial('shared/menu1'); ?>
      <!-- CENTER -->
      <div
        class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2"
        style="margin-top: 20px"
      >
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-globe"></i
              ><strong>Visión del Sector Educación</strong>
            </h3>
          </div>
          <div class="card-body">
            <h4>
              <p style="text-align: justify">
                “Todos los peruanos acceden a una educación que les permite
                desarrollar su potencial desde la primera infancia y convertirse
                en ciudadanos que valoran su cultura, conocen sus derechos y
                responsabilidades, desarrollan sus talentos y participan de
                manera innovadora, competitiva y comprometida en las dinámicas
                sociales, contribuyendo al desarrollo de sus comunidades y del
                país en su conjunto”
              </p>
            </h4>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-globe"></i><strong>Misión</strong>
            </h3>
          </div>
          <div class="card-body">
            <h4>
              <p style="text-align: justify">
                “Formar profesionales de alta calidad, generando conocimiento a
                través de la investigación, desarrollo e innovación tecnológica,
                con enfoque ético y responsabilidad social para enfrentar los
                retos del desarrollo sostenible del país”
              </p>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{% endblock %}
