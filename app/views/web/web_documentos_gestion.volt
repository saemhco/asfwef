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
                <div class="card card-primary">
                    <div class="card-body">
                        {{ form('web-documentos-gestion.html','method':
                        'get','id':'form_search','class':'form-horizontal','autocomplete':'off') }}

                        
                            <div class="form-group row justify-content-end" style="margin-bottom: -30px;margin-top: -10px;">
                                <div class="col-lg-8">
                                    <input type="text" placeholder="Buscar por titulo del documento" class="form-control"
                                        name="busqueda" value="{{ input_titulo }}" style="margin-top: 8px !important;color: #757575;">
                                </div>
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-raised btn-primary btn-block"><i
                                            class="zmdi zmdi-search"></i> Buscar</button>
                                </div>
                            </div>
                        
                        {{ endForm() }}
                        <br>
                        {% for tipoNombre in tipoNombres %}
                        <div class="card card-primary">
        
                            <div class="card-header">
                                <h4 class="card-title"><i class="fa fa-globe"></i><strong>{{
                                        tipoNombre.nombres }}</strong></h4>
                            </div>
        
                            {% for documento in page.items %}
                            {% if tipoNombre.codigo == documento.tipo %}
                            <div class="card-body">
                                <ul style="list-style-type: disc;">
                                    <li>
                                        <h5 style="margin-top: -5px; margin-bottom: -40px;"><a style="text-decoration: none;"
                                                href="web-documentos/{{ documento.enlace }}.html">{{ documento.titulo }}</a>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            {% endif %}
                            {% endfor %}
                            </p>
                        </div>
                        {% endfor %}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{% endblock %}