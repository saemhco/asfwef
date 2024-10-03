{% block content %}
    <div class="text-center mb-6">
        <h3 class="no-m ms-site-title color-box center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Galería de imágenes - {{ galeria.titular }}</h3>
        {#<p class="lead lead-lg color-box text-center center-block mt-2 mb-4 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Discover our projects and the <span class="colorStar">rigorous process</span> of creation. Our principles are creativity, design, experience and knowledge.</p>#}
    </div>
    <div class="container">
        <div class="row">
            {% for  galeria_detalle in page.items  %}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card wow zoomIn">
                        <div class="ms-thumbnail card-body p-05 ">
                            <div class="withripple zoom-img">
                                <a href="{{ url('adminpanel/imagenes/galerias_detalles/'~galeria_detalle.imagen_detalle) }}" data-lightbox="gallery" data-title="{{ galeria_detalle.titular_detalle }}" c><img src="{{ url('adminpanel/imagenes/galerias_detalles/'~galeria_detalle.imagen_detalle) }}" alt="" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                </div>
            {% endfor %}
        </div>
        <br>
        <div class="row">
            <!-- Pagination Default -->
            <div align="center" style="margin-left: 360px;">
                <nav aria-label="Page navigation" style="display: inline-block;">
                    <!-- Pagination Default -->
                    {#<p>pagina actual: {{ page.current}}</p>
                    <p>pagina anterior: {{ page.first}}</p>
                    <p>pagina ultima: {{ page.last}}</p>
                    <p>pagina limite: {{ page.limit}}</p>
                    <p>pagina siguiente: {{ page.next}}</p>
                    <p>pagina total: {{ page.total_items}}</p>#}

                    <ul class="pagination pagination-round">

                        <li class="page-item">

                            {{ link_to("web-detalle-galeria/"~id_galeria~".html?page=" ~ page.before, '<<', "class": "page-link") }}

                        </li>

                        {#----------#}
                        {% if page.last == 1%}
                            <li class="page-item active">

                                <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.first) }}">{{ page.first }}</a>

                            </li>
                        {%  elseif(page.last == 2) %}

                            {% for i in 1..page.total_items if i <= 2 %}
                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~i) }}">{{ i }}</a>

                                </li>

                            {% endfor %}

                        {%  elseif(page.last == 3) %}

                            {% for i in 1..page.total_items if i <= 3 %}
                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~i) }}">{{ i }}</a>

                                </li>

                            {% endfor %}

                        {%  elseif(page.last == 4) %}

                            {% for i in 1..page.total_items if i <= 4 %}
                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~i) }}">{{ i }}</a>

                                </li>

                            {% endfor %}

                        {%  elseif(page.last == 5) %}

                            {% for i in 1..page.total_items if i <= 5 %}
                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~i) }}">{{ i }}</a>

                                </li>

                            {% endfor %}

                        {%  elseif(page.last == 6) %}

                            {% for i in 1..page.total_items if i <= 6 %}
                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~i) }}">{{ i }}</a>

                                </li>

                            {% endfor %}

                        {% else %}
                            {% if page.current == page.last-1 or page.current == page.last-2 or page.current == page.last-3 %}

                                <li class="page-item">

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.first) }}">{{ page.first }}</a>

                                </li>

                                <li class="page-item">

                                    <a class="page-link" href="javascript: void(0)">...</a>

                                </li>

                                {% set page_last_4 = page.last-4 %}
                                <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_4) }}">{{ page_last_4 }}</a>

                                </li>

                                {% set page_last_3 = page.last-3 %}
                                <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_3) }}">{{ page_last_3 }}</a>

                                </li>

                                {% set page_last_2 = page.last-2 %}
                                <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_2) }}">{{ page_last_2 }}</a>

                                </li>

                                {% set page_last_1 = page.last-1 %}
                                <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_1) }}">{{ page_last_1 }}</a>

                                </li>

                                <li  {% if page.current == page.last %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.last) }}">{{ page.last }}</a>

                                </li>

                            {%  elseif(page.current == page.last) %}

                                <li class="page-item">

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.first) }}">{{ page.first }}</a>

                                </li>
                                <li class="page-item">

                                    <a class="page-link" href="javascript: void(0)">...</a>

                                </li>

                                {% set page_last_4 = page.last-4 %}
                                <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_4) }}">{{ page_last_4 }}</a>

                                </li>

                                {% set page_last_3 = page.last-3 %}
                                <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_3) }}">{{ page_last_3 }}</a>

                                </li>

                                {% set page_last_2 = page.last-2 %}
                                <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_2) }}">{{ page_last_2 }}</a>

                                </li>

                                {% set page_last_1 = page.last-1 %}
                                <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page_last_1) }}">{{ page_last_1 }}</a>

                                </li>

                                <li  {% if page.current == page.last %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.last) }}">{{ page.last }}</a>

                                </li>

                            {% else %}

                                {% if page.current >= 5%}
                                    <li class="page-item">

                                        <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~1) }}">1</a>

                                    </li>
                                    <li class="page-item">

                                        <a class="page-link" href="javascript: void(0)">...</a>

                                    </li>
                                    <li class="page-item">

                                        <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.before) }}">{{ page.before }}</a>

                                    </li>
                                    <li class="page-item active">

                                        <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.current) }}">{{ page.current }}</a>

                                    </li>

                                    <li class="page-item">

                                        <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.next) }}">{{ page.next }}</a>

                                    </li>
                                    <li class="page-item">

                                        <a class="page-link" href="javascript: void(0)">...</a>

                                    </li>
                                {% else %}

                                    {% for i in 1..page.total_items if i <= 5 %}

                                        <li{% if i == page.current %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~i) }}">{{ i }}</a>

                                        </li>


                                    {% endfor %}
                                    <li class="page-item">

                                        <a class="page-link" href="javascript: void(0)">...</a>

                                    </li>
                                {% endif %}

                                <li class="page-item">

                                    <a class="page-link" href="{{ url('web-detalle-galeria/'~id_galeria~'.html?page='~page.last) }}">{{ page.last }}</a>

                                </li>

                            {% endif %}


                        {% endif %}
                        {#---------#}

                        <li class="page-item">


                            {{ link_to('web-detalle-galeria/'~id_galeria~'.html?page=' ~ page.next, '>>', "class": "page-link") }}

                        </li>

                    </ul>
                    <!-- /Pagination Default -->
                </nav>
            </div>
        </div>
    </div> <!-- container -->
{% endblock %}