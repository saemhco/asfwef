{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Libros
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <?php $this->partial('sharedbiblioteca/menu1'); ?>
                <!-- CENTER -->
                <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-search"></i><strong>Búsqueda de Libros </strong></h3>
                        </div>
                        <div class="card-body">

                            {{ form(full_url,'method': 'get','id':'form_search','class':'form-horizontal','autocomplete':'off') }}

                            <fieldset>
                                <div class="form-group row justify-content-end">
                                    <div class="col-lg-8">
                                        <input type="text" placeholder="Buscar por  Codigo / Titulo " class="form-control" name="palabra_clave" value="{{ palabra_clave }}" style="color: #757575;">                           
                                    </div>
                                    <div class="col-lg-4">
                                        {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                                        <button type="submit" class="btn btn-raised btn-primary btn-block"><i class="zmdi zmdi-search"></i> Buscar</button>
                                        <input type="hidden" name="categoria" value="{{ f_categoria }}" >
                                        <input type="hidden" name="idioma" value="{{ f_idioma }}" >
                                    </div>
                                </div>
                            </fieldset>
                            {{ endForm() }}
                            <br>
                            {% for libro in page.items %}
                                <div class="card card-primary">
                                    <div class="card-body">                                              
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <center>{{ image("adminpanel/imagenes/libros/libro.png", "width":"105", "height":"75") }}</center>
                                            </div>
                                            <div class="col-xl-9">
                                                <h4><a href="{{ url('web-biblioteca/detalle-libro/'~libro.id_libro~'/'~libro.id_ejemplar~'.html') }}">{{ libro.titulo }}</a></h4>

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

                                                <h5>
                                                    <span class="text-royal"> <i class="zmdi zmdi-account mr-1 color-success"></i> AUTOR(ES):
                                                        <br>
                                                        - {{ libro.autor1}}
                                                        <br>
                                                        {{guion2}} {{autor2}}
                                                        <br>
                                                        {{guion3}} {{autor3}}
                                                    </span>
                                                </h5>
                                                <h5>
                                                    <span class="text-royal"> <i class="zmdi zmdi-format-list-numbered mr-1 color-danger"></i> ISBN: {{ libro.isbn }} </span>

                                                    <span class="text-royal"> <i class="zmdi zmdi-collection-plus mr-1 color-danger"></i> EJEMPLAR N°: {{ libro.numero }} </span>

                                                </h5>
                                                <h5>
                                                    <span class="text-royal"> <i class="zmdi zmdi-eye mr-1 color-success"></i> NÚMERO VISITAS: {{ libro.numero_visitas }} </span>

                                                </h5>
                                            </div>
                                        </div>

                                    </div>                               
                                </div>
                            {% endfor %}
                            <!-- Pagination Default -->
                            <div align="center">
                                <nav aria-label="Page navigation" style="display: inline-block;">

                                    {#<p>pagina actual: {{ page.current}}</p>
                                    <p>pagina anterior: {{ page.first}}</p>
                                    <p>pagina ultima: {{ page.last}}</p>
                                    <p>pagina limite: {{ page.limit}}</p>
                                    <p>pagina siguiente: {{ page.next}}</p>
                                    <p>pagina total: {{ page.total_items}}</p>#}

                                    <ul class="pagination pagination-round">

                                        <li class="page-item">

                                            {#{{ link_to("web/libros?page=" ~ page.before, '<<', "class": "page-link") }}#}
                                            {#<a class="page-link" href="{{ url('web/libros?page='~page.before) }}"><</a>#}
                                            <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.before) }}"><<</a>

                                        </li>

                                        {#----------#}
                                        {% if page.last == 1%}
                                            <li class="page-item active">

                                                {#<a class="page-link" href="{{ url('web/libros?page='~page.first) }}">{{ page.first }}</a>#}
                                                <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>

                                            </li>
                                        {%  elseif(page.last == 2) %}

                                            {% for i in 1..page.total_items if i <= 2 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 3) %}

                                            {% for i in 1..page.total_items if i <= 3 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 4) %}

                                            {% for i in 1..page.total_items if i <= 4 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 5) %}

                                            {% for i in 1..page.total_items if i <= 5 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>

                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 6) %}

                                            {% for i in 1..page.total_items if i <= 6 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>

                                                </li>

                                            {% endfor %}

                                        {% else %}
                                            {% if page.current == page.last-1 or page.current == page.last-2 or page.current == page.last-3 %}

                                                <li class="page-item">

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page.first) }}">{{ page.first }}</a>#}
                                                    <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>

                                                </li>

                                                <li class="page-item">

                                                    <a class="page-link" href="javascript: void(0)">...</a>

                                                </li>

                                                {% set page_last_4 = page.last-4 %}
                                                <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_4) }}">{{ page_last_4 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_4) }}">{{ page_last_4 }}</a>

                                                </li>

                                                {% set page_last_3 = page.last-3 %}
                                                <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_3) }}">{{ page_last_3 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_3) }}">{{ page_last_3 }}</a>
                                                </li>

                                                {% set page_last_2 = page.last-2 %}
                                                <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_2) }}">{{ page_last_2 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_2) }}">{{ page_last_2 }}</a>

                                                </li>

                                                {% set page_last_1 = page.last-1 %}
                                                <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_1) }}">{{ page_last_1 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_1) }}">{{ page_last_1 }}</a>

                                                </li>

                                                <li  {% if page.current == page.last %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page.last) }}">{{ page.last }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page.last) }}">{{ page.last }}</a>

                                                </li>

                                            {%  elseif(page.current == page.last) %}

                                                <li class="page-item">

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page.first) }}">{{ page.first }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>

                                                </li>
                                                <li class="page-item">

                                                    <a class="page-link" href="javascript: void(0)">...</a>

                                                </li>

                                                {% set page_last_4 = page.last-4 %}
                                                <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_4) }}">{{ page_last_4 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_4) }}">{{ page_last_4 }}</a>

                                                </li>

                                                {% set page_last_3 = page.last-3 %}
                                                <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_3) }}">{{ page_last_3 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_3) }}">{{ page_last_3 }}</a>

                                                </li>

                                                {% set page_last_2 = page.last-2 %}
                                                <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_2) }}">{{ page_last_2 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_2) }}">{{ page_last_2 }}</a>

                                                </li>

                                                {% set page_last_1 = page.last-1 %}
                                                <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page_last_1) }}">{{ page_last_1 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_1) }}">{{ page_last_1 }}</a>

                                                </li>

                                                <li  {% if page.current == page.last %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page.last) }}">{{ page.last }}</a>#}
                                                    <a class="page-link" href="{{ url('web/libros?page='~page.last) }}">{{ page.last }}</a>

                                                </li>

                                            {% else %}

                                                {% if page.current >= 5%}
                                                    <li class="page-item">

                                                        {#<a class="page-link" href="{{ url('web/libros?page='~1) }}">1</a>#}
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',1) }}">1</a>

                                                    </li>
                                                    <li class="page-item">

                                                        <a class="page-link" href="javascript: void(0)">...</a>

                                                    </li>
                                                    <li class="page-item">

                                                        {#<a class="page-link" href="{{ url('web/libros?page='~page.before) }}">{{ page.before }}</a>#}
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.before) }}">{{ page.before }}</a>

                                                    </li>
                                                    <li class="page-item active">

                                                        {#<a class="page-link" href="{{ url('web/libros?page='~page.current) }}">{{ page.current }}</a>#}
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.current) }}">{{ page.current }}</a>

                                                    </li>

                                                    <li class="page-item">

                                                        {#<a class="page-link" href="{{ url('web/libros?page='~page.next) }}">{{ page.next }}</a>#}
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.next) }}">{{ page.next }}</a>

                                                    </li>
                                                    <li class="page-item">

                                                        <a class="page-link" href="javascript: void(0)">...</a>

                                                    </li>
                                                {% else %}

                                                    {% for i in 1..page.total_items if i <= 5 %}

                                                        <li{% if i == page.current %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                                            {#<a class="page-link" href="{{ url('web/libros?page='~i) }}">{{ i }}</a>#}
                                                            <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>

                                                        </li>


                                                    {% endfor %}
                                                    <li class="page-item">

                                                        <a class="page-link" href="javascript: void(0)">...</a>

                                                    </li>
                                                {% endif %}

                                                <li class="page-item">

                                                    {#<a class="page-link" href="{{ url('web/libros?page='~page.last) }}">{{ page.last }}</a>#}
                                                    <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.last) }}">{{ page.last }}</a>

                                                </li>

                                            {% endif %}


                                        {% endif %}
                                        {#---------#}

                                        <li class="page-item">


                                            {#{{ link_to("web/libros?page=" ~ page.next, '>>', "class": "page-link") }}#}
                                            <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.next) }}">>></a>
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
    </div>
{% endblock %}
