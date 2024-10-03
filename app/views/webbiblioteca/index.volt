{% block content %}

<div class="ms-hero-page ms-hero-img-webbiblioteca ms-hero-bg-info">
    <div class="container">
        <div class="text-center">
            <h3
                class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">
                <strong>ENCUENTRA TU RECURSO BIBLIOGRÁFICO IDEAL</strong></h3>

            {{ form('webbiblioteca/listado','method': 'get','class':'mt-4 mw-800 center-block animated fadeInUp') }}
            {#<form class=" mt-4 mw-800 center-block animated fadeInUp">#}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group label-floating input-group ">
                            <label class="control-label color-white" for="ms-class-zip"><i
                                    class="zmdi zmdi-book mr-1"></i> Libro deseado (Escribre la palabra clave)</label>
                            <input type="text" id="ms-class-zip" class="form-control color-white" name="palabra_clave">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-block"><i class="zmdi zmdi-search"></i>
                    Buscar</button>
                {#
            </form>#}
            {{ endForm() }}

        </div>
    </div>
</div>
<br>

<div class="row d-flex justify-content-center">
    {% for libro in libros %}
    <div class="col-lg-4 col-md-6" style="padding-left: 25px;padding-right: 25px;">
        <div class="card card-light-inverse">


            <div class="card-body" style="margin-top: 5px;">
                <center>
                    <th style="font-size: 8px;"><i class="zmdi zmdi-book mr-1 color-warning"></i> Título </th>
                    <p style="margin-top: -8px;">
                        <!-- {{ utilidades.partedescripcion(libro.titulo,0,40)}} -->
                        <strong>{{ libro.titulo}}</strong>
                        <hr style="margin-top: -8px;">
                        <th style="font-size: 8px;"><i class="zmdi zmdi-account mr-1 color-success"></i> Autor(es) </th>
                    <p style="margin-top: -8px;">

                        {% if libro.autor2 == "" %}
                        {% set autor2 = "" %}
                        {% set guion2 = "" %}
                        {% else %}
                        {% set autor2 = libro.autor2 %}
                        
                        {% set guion2 ="-" %}
                        {% endif %}


                        {% if libro.autor3 == "" %}
                        {% set autor3 = "" %}
                        {% set guion3 = "" %}
                        {% else %}
                        {% set autor3 = libro.autor3 %}
                        {% set guion3 = "-" %}
                        {% endif %}
                        - {{ libro.autor1}}
                        <br>
                        {{guion2}} {{autor2}}
                        <br>
                        {{guion3}} {{autor3}}
                        
                        <hr style="margin-top: -8px;">
                        <th style="font-size: 8px;"><i class="zmdi zmdi-view-dashboard mr-1 color-warning"></i>
                            Categoría</th>
                    <p style="margin-top: -8px;">
                        {{ libro.categoria}}
                        <hr style="margin-top: -8px;">
                        <th style="font-size: 8px;"><i class="zmdi zmdi-format-list-numbered mr-1 color-danger"></i>
                            ISBN</th>
                        {{ libro.isbn}}
                        <hr style="">
                        <th style="font-size: 8px;"><i class="zmdi zmdi-format-list-numbered mr-1 color-danger"></i>
                            Ejemplar N°:</th>
                        {{ libro.numero}}
                        <br><br>
                </center>
                <p class="text-center">
                    <a href="{{ url('web-biblioteca/detalle-libro/'~libro.id_libro~'/'~libro.id_ejemplar~'.html') }}"
                        class="btn btn-primary btn-raised text-right" role="button">
                        <i class="zmdi zmdi-plus"></i><span>Ver Detalles</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
    {% endfor %}
</div>
<center>
    <a href="{{ url('web-biblioteca/listado.html') }}" class="btn btn-primary btn-raised text-right" role="button">
        <i class="fa fa-mail-forward"></i>
        <span>Ver más recursos bibliográficas</span>
    </a>
</center>

{% endblock %}