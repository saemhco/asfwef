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
                <!-- CENTER -->
                <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 	
                    <div class="card card-primary">
                        {% for  galeria in page.items  %}
                            <div class="row">
                                <!-- item -->
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"><strong><span>{{ utilidades.partedescripcion(galeria.titular,0,200)}} </span> </strong></h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" style ="margin-left:20px;"><!-- item -->                                
                                                <div class="col-md-3" style="margin-left: -20px;">
                                                    <center>
                                                    <div class="thumbnail"><!-- company logo -->
                                                        {{ image("adminpanel/imagenes/galerias/"~galeria.imagen, "width":"220", "height":"135") }}
                                                    </div>
                                                    </center>
                                                </div>
                                                <div class="col-md-9" style="margin-top: -10px;"><!-- company detail -->                                                
                                                    <ul class="list-inline">
                                                        <h4><li><i class="fa fa-newspaper-o"></i><span class="text-info">  Publicado por la Oficina de Relaciones Públicas</span></li></h4>
                                                    </ul>
                                                    <p style="text-align:justify;">{{ utilidades.partedescripcion(galeria.descripcion,0,285)}} &nbsp ...</p>
                                                </div> 
                                            </div>
                                            <center>
                                                <a href="{{ url('web-detalle-galeria/'~galeria.id_galeria~".html") }}" class="btn btn-primary btn-raised text-right" role="button">
                                                    <i class="zmdi zmdi-plus"></i><span>Leer Más</span>                                        
                                                </a>
                                            </center>
                                        </div>
                                    </div>                                
                                </div>
                            </div><!-- /item -->
                        {% endfor %}
                        
                        
                    <!-- Pagination Default -->
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

                                {{ link_to("web-galerias.html?page=" ~ page.before, '<<', "class": "page-link") }}

                            </li>

                            {#----------#}
                            {% if page.last == 1%}
                                <li class="page-item active">

                                    <a class="page-link" href="{{ url('web-galerias.html?page='~page.first) }}">{{ page.first }}</a>

                                </li>
                            {%  elseif(page.last == 2) %}

                                {% for i in 1..page.total_items if i <= 2 %}
                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~i) }}">{{ i }}</a>

                                    </li>

                                {% endfor %}

                            {%  elseif(page.last == 3) %}

                                {% for i in 1..page.total_items if i <= 3 %}
                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~i) }}">{{ i }}</a>

                                    </li>

                                {% endfor %}

                            {%  elseif(page.last == 4) %}

                                {% for i in 1..page.total_items if i <= 4 %}
                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~i) }}">{{ i }}</a>

                                    </li>

                                {% endfor %}

                            {%  elseif(page.last == 5) %}

                                {% for i in 1..page.total_items if i <= 5 %}
                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~i) }}">{{ i }}</a>

                                    </li>

                                {% endfor %}

                            {%  elseif(page.last == 6) %}

                                {% for i in 1..page.total_items if i <= 6 %}
                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~i) }}">{{ i }}</a>

                                    </li>

                                {% endfor %}

                            {% else %}
                                {% if page.current == page.last-1 or page.current == page.last-2 or page.current == page.last-3 %}

                                    <li class="page-item">

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page.first) }}">{{ page.first }}</a>

                                    </li>

                                    <li class="page-item">

                                        <a class="page-link" href="javascript: void(0)">...</a>

                                    </li>

                                    {% set page_last_4 = page.last-4 %}
                                    <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_4) }}">{{ page_last_4 }}</a>

                                    </li>

                                    {% set page_last_3 = page.last-3 %}
                                    <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_3) }}">{{ page_last_3 }}</a>

                                    </li>

                                    {% set page_last_2 = page.last-2 %}
                                    <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_2) }}">{{ page_last_2 }}</a>

                                    </li>

                                    {% set page_last_1 = page.last-1 %}
                                    <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_1) }}">{{ page_last_1 }}</a>

                                    </li>

                                    <li  {% if page.current == page.last %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page.last) }}">{{ page.last }}</a>

                                    </li>

                                {%  elseif(page.current == page.last) %}

                                    <li class="page-item">

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page.first) }}">{{ page.first }}</a>

                                    </li>
                                    <li class="page-item">

                                        <a class="page-link" href="javascript: void(0)">...</a>

                                    </li>

                                    {% set page_last_4 = page.last-4 %}
                                    <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_4) }}">{{ page_last_4 }}</a>

                                    </li>

                                    {% set page_last_3 = page.last-3 %}
                                    <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_3) }}">{{ page_last_3 }}</a>

                                    </li>

                                    {% set page_last_2 = page.last-2 %}
                                    <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_2) }}">{{ page_last_2 }}</a>

                                    </li>

                                    {% set page_last_1 = page.last-1 %}
                                    <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page_last_1) }}">{{ page_last_1 }}</a>

                                    </li>

                                    <li  {% if page.current == page.last %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page.last) }}">{{ page.last }}</a>

                                    </li>

                                {% else %}

                                    {% if page.current >= 5%}
                                        <li class="page-item">

                                            <a class="page-link" href="{{ url('web-galerias.html?page='~1) }}">1</a>

                                        </li>
                                        <li class="page-item">

                                            <a class="page-link" href="javascript: void(0)">...</a>

                                        </li>
                                        <li class="page-item">

                                            <a class="page-link" href="{{ url('web-galerias.html?page='~page.before) }}">{{ page.before }}</a>

                                        </li>
                                        <li class="page-item active">

                                            <a class="page-link" href="{{ url('web-galerias.html?page='~page.current) }}">{{ page.current }}</a>

                                        </li>

                                        <li class="page-item">

                                            <a class="page-link" href="{{ url('web-galerias.html?page='~page.next) }}">{{ page.next }}</a>

                                        </li>
                                        <li class="page-item">

                                            <a class="page-link" href="javascript: void(0)">...</a>

                                        </li>
                                    {% else %}

                                        {% for i in 1..page.total_items if i <= 5 %}

                                            <li{% if i == page.current %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                                <a class="page-link" href="{{ url('web-galerias.html?page='~i) }}">{{ i }}</a>

                                            </li>


                                        {% endfor %}
                                        <li class="page-item">

                                            <a class="page-link" href="javascript: void(0)">...</a>

                                        </li>
                                    {% endif %}

                                    <li class="page-item">

                                        <a class="page-link" href="{{ url('web-galerias.html?page='~page.last) }}">{{ page.last }}</a>

                                    </li>

                                {% endif %}


                            {% endif %}
                            {#---------#}

                            <li class="page-item">


                                {{ link_to("web-galerias.html?page=" ~ page.next, '>>', "class": "page-link") }}

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