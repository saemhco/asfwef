{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Boletines
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <!-- CENTER -->
                <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 	
                    <div class="row d-flex justify-content-center">
                        {% for  boletin in page.items  %}
                            <div class="col-lg-4">
                                <div class="card card-light-inverse">
                                    <center>
                                    <div class="ms-thumbnail-container">
                                        <figure class="ms-thumbnail ms-thumbnail-diagonal">
                                            {{ image("adminpanel/imagenes/boletines/"~boletin.imagen,
                                            "class":"img-responsive", "style":"width:258px;height:172px;") }}
                                    
                                            <figcaption class="ms-thumbnail-caption text-center">
                                                <div class="ms-thumbnail-caption-content">
                                                    <a target="_blank"
                                                        href="../adminpanel/archivos/boletines/{{ boletin.archivo }}"
                                                        class="btn btn-success btn-raised">Ver Boletín</a>
                                                </div>
                                            </figcaption>
                                            
                                        </figure>
                                    </div>
                                    <div class="card-body" style="margin-top: -15px;">
                                        <h6 class="color-primary"><p> {{ boletin.titular }}</p></h6>
                                        
                                    </div>
                                    </center>
                                </div>
                            </div>
                        {% endfor %}
                        
                    </div>
                    
                    <div align="center">
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

                                    {{ link_to("web-boletines.html?page=" ~ page.before, '<<', "class": "page-link") }}

                                </li>

                                {#----------#}
                                {% if page.last == 1%}
                                    <li class="page-item active">

                                        <a class="page-link" href="{{ url('web-boletines.html?page='~page.first) }}">{{ page.first }}</a>

                                    </li>
                                {%  elseif(page.last == 2) %}

                                    {% for i in 1..page.total_items if i <= 2 %}
                                        <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~i) }}">{{ i }}</a>

                                        </li>

                                    {% endfor %}

                                {%  elseif(page.last == 3) %}

                                    {% for i in 1..page.total_items if i <= 3 %}
                                        <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~i) }}">{{ i }}</a>

                                        </li>

                                    {% endfor %}

                                {%  elseif(page.last == 4) %}

                                    {% for i in 1..page.total_items if i <= 4 %}
                                        <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~i) }}">{{ i }}</a>

                                        </li>

                                    {% endfor %}

                                {%  elseif(page.last == 5) %}

                                    {% for i in 1..page.total_items if i <= 5 %}
                                        <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~i) }}">{{ i }}</a>

                                        </li>

                                    {% endfor %}

                                {%  elseif(page.last == 6) %}

                                    {% for i in 1..page.total_items if i <= 6 %}
                                        <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~i) }}">{{ i }}</a>

                                        </li>

                                    {% endfor %}

                                {% else %}
                                    {% if page.current == page.last-1 or page.current == page.last-2 or page.current == page.last-3 %}

                                        <li class="page-item">

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page.first) }}">{{ page.first }}</a>

                                        </li>

                                        <li class="page-item">

                                            <a class="page-link" href="javascript: void(0)">...</a>

                                        </li>

                                        {% set page_last_4 = page.last-4 %}
                                        <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_4) }}">{{ page_last_4 }}</a>

                                        </li>

                                        {% set page_last_3 = page.last-3 %}
                                        <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_3) }}">{{ page_last_3 }}</a>

                                        </li>

                                        {% set page_last_2 = page.last-2 %}
                                        <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_2) }}">{{ page_last_2 }}</a>

                                        </li>

                                        {% set page_last_1 = page.last-1 %}
                                        <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_1) }}">{{ page_last_1 }}</a>

                                        </li>

                                        <li  {% if page.current == page.last %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page.last) }}">{{ page.last }}</a>

                                        </li>

                                    {%  elseif(page.current == page.last) %}

                                        <li class="page-item">

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page.first) }}">{{ page.first }}</a>

                                        </li>
                                        <li class="page-item">

                                            <a class="page-link" href="javascript: void(0)">...</a>

                                        </li>

                                        {% set page_last_4 = page.last-4 %}
                                        <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_4) }}">{{ page_last_4 }}</a>

                                        </li>

                                        {% set page_last_3 = page.last-3 %}
                                        <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_3) }}">{{ page_last_3 }}</a>

                                        </li>

                                        {% set page_last_2 = page.last-2 %}
                                        <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_2) }}">{{ page_last_2 }}</a>

                                        </li>

                                        {% set page_last_1 = page.last-1 %}
                                        <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page_last_1) }}">{{ page_last_1 }}</a>

                                        </li>

                                        <li  {% if page.current == page.last %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page.last) }}">{{ page.last }}</a>

                                        </li>

                                    {% else %}

                                        {% if page.current >= 5%}
                                            <li class="page-item">

                                                <a class="page-link" href="{{ url('web-boletines.html?page='~1) }}">1</a>

                                            </li>
                                            <li class="page-item">

                                                <a class="page-link" href="javascript: void(0)">...</a>

                                            </li>
                                            <li class="page-item">

                                                <a class="page-link" href="{{ url('web-boletines.html?page='~page.before) }}">{{ page.before }}</a>

                                            </li>
                                            <li class="page-item active">

                                                <a class="page-link" href="{{ url('web-boletines.html?page='~page.current) }}">{{ page.current }}</a>

                                            </li>

                                            <li class="page-item">

                                                <a class="page-link" href="{{ url('web-boletines.html?page='~page.next) }}">{{ page.next }}</a>

                                            </li>
                                            <li class="page-item">

                                                <a class="page-link" href="javascript: void(0)">...</a>

                                            </li>
                                        {% else %}

                                            {% for i in 1..page.total_items if i <= 5 %}

                                                <li{% if i == page.current %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                                    <a class="page-link" href="{{ url('web-boletines.html?page='~i) }}">{{ i }}</a>

                                                </li>


                                            {% endfor %}
                                            <li class="page-item">

                                                <a class="page-link" href="javascript: void(0)">...</a>

                                            </li>
                                        {% endif %}

                                        <li class="page-item">

                                            <a class="page-link" href="{{ url('web-boletines.html?page='~page.last) }}">{{ page.last }}</a>

                                        </li>

                                    {% endif %}


                                {% endif %}
                                {#---------#}

                                <li class="page-item">


                                    {{ link_to("web-boletines.html?page=" ~ page.next, '>>', "class": "page-link") }}

                                </li>

                            </ul>
                            <!-- /Pagination Default -->
                    </nav>
                    </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
{% endblock %}