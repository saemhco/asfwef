{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                Documentos de Gestión
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
                {% for tipoNombre in tipoNombres %}
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-globe"></i><strong>{{
                                tipoNombre.nombres }}</strong></h3>
                    </div>

                    {% for documento in documentos %}
                    {% if tipoNombre.codigo == documento.tipo %}
                    <div class="card-body" style="margin-top: -20px;padding-bottom: 20px;">
                        <ul style="list-style-type: disc;">
                            <li>
                                <h4><a style="text-decoration: none;"
                                        href="web-documentos/{{ documento.enlace }}.html">{{ documento.titulo
                                        }}</a></span></h4>
                            </li>
                        </ul>
                    </div>  
                    {% endif %}
                    {% endfor %}
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
</div>
{% endblock %}