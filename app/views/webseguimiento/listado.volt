{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Empleos
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <?php $this->partial('sharedbolsatrabajo/menu1'); ?>
                <!-- CENTER -->
                <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-search"></i><strong>Búsqueda de Empleos </strong></h3>
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
                                        <input type="hidden" name="cargo" value="{{ f_cargo }}" >
                                        <input type="hidden" name="region" value="{{ f_region }}" >
                                        <input type="hidden" name="provincia" value="{{ f_provincia }}" >
                                        <input type="hidden" name="distrito" value="{{ f_distrito }}" >
                                        <input type="hidden" name="jornada" value="{{ f_jornada }}" >
                                        <input type="hidden" name="tipocontrato" value="{{ f_tipocontrato }}" >

                                    </div>
                                </div>
                            </fieldset>
                            {{ endForm() }}
                            <br>
                            {% for empleo in page.items %}
                                <div class="card card-primary">
                                    <div class="card-body">                                              
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <center>{{ image("adminpanel/imagenes/empresas/"~empleo.imagen, "width":"105", "height":"105") }}</center>
                                            </div>
                                            <div class="col-xl-9">
                                                <h4><a href="{{ url('web-bolsatrabajo/detalle-empleo/'~empleo.id_empleo~'.html') }}">{{ empleo.titulo }}</a></h4>                                                
                                                <h5>
                                                    <span class="text-royal"> <i class="zmdi zmdi-account mr-1 color-success"></i> RAZÓN SOCIAL: {{ empleo.razon_social}} </span>

                                                </h5>
                                                <h5>
                                                    <span class="text-royal"> <i class="zmdi zmdi-eye mr-1 color-success"></i> NÚMERO VISITAS: {{ empleo.numero_visitas }} </span>
                                                </h5>
                                                <h5>
                                                    <span class="text-royal"> <i class="zmdi zmdi-calendar mr-1 color-success"></i> FECHA PUBLICACIÓN: {{utilidades.fechita(empleo.fecha_creacion,"d/m/Y") }} </span>
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

                                            {#{{ link_to("web/empleos?page=" ~ page.before, '<<', "class": "page-link") }}#}
                                            {#<a class="page-link" href="{{ url('web/empleos?page='~page.before) }}"><</a>#}
                                            <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.before) }}"><<</a>

                                        </li>

                                        {#----------#}
                                        {% if page.last == 1%}
                                            <li class="page-item active">

                                                {#<a class="page-link" href="{{ url('web/empleos?page='~page.first) }}">{{ page.first }}</a>#}
                                                <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>

                                            </li>
                                        {%  elseif(page.last == 2) %}

                                            {% for i in 1..page.total_items if i <= 2 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 3) %}

                                            {% for i in 1..page.total_items if i <= 3 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 4) %}

                                            {% for i in 1..page.total_items if i <= 4 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 5) %}

                                            {% for i in 1..page.total_items if i <= 5 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>

                                                </li>

                                            {% endfor %}

                                        {%  elseif(page.last == 6) %}

                                            {% for i in 1..page.total_items if i <= 6 %}
                                                <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~i) }}">{{ i }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>

                                                </li>

                                            {% endfor %}

                                        {% else %}
                                            {% if page.current == page.last-1 or page.current == page.last-2 or page.current == page.last-3 %}

                                                <li class="page-item">

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page.first) }}">{{ page.first }}</a>#}
                                                    <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>

                                                </li>

                                                <li class="page-item">

                                                    <a class="page-link" href="javascript: void(0)">...</a>

                                                </li>

                                                {% set page_last_4 = page.last-4 %}
                                                <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_4) }}">{{ page_last_4 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_4) }}">{{ page_last_4 }}</a>

                                                </li>

                                                {% set page_last_3 = page.last-3 %}
                                                <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_3) }}">{{ page_last_3 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_3) }}">{{ page_last_3 }}</a>
                                                </li>

                                                {% set page_last_2 = page.last-2 %}
                                                <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_2) }}">{{ page_last_2 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_2) }}">{{ page_last_2 }}</a>

                                                </li>

                                                {% set page_last_1 = page.last-1 %}
                                                <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_1) }}">{{ page_last_1 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_1) }}">{{ page_last_1 }}</a>

                                                </li>

                                                <li  {% if page.current == page.last %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page.last) }}">{{ page.last }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page.last) }}">{{ page.last }}</a>

                                                </li>

                                            {%  elseif(page.current == page.last) %}

                                                <li class="page-item">

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page.first) }}">{{ page.first }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>

                                                </li>
                                                <li class="page-item">

                                                    <a class="page-link" href="javascript: void(0)">...</a>

                                                </li>

                                                {% set page_last_4 = page.last-4 %}
                                                <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_4) }}">{{ page_last_4 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_4) }}">{{ page_last_4 }}</a>

                                                </li>

                                                {% set page_last_3 = page.last-3 %}
                                                <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_3) }}">{{ page_last_3 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_3) }}">{{ page_last_3 }}</a>

                                                </li>

                                                {% set page_last_2 = page.last-2 %}
                                                <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_2) }}">{{ page_last_2 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_2) }}">{{ page_last_2 }}</a>

                                                </li>

                                                {% set page_last_1 = page.last-1 %}
                                                <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page_last_1) }}">{{ page_last_1 }}</a>#}
                                                    <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_1) }}">{{ page_last_1 }}</a>

                                                </li>

                                                <li  {% if page.current == page.last %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page.last) }}">{{ page.last }}</a>#}
                                                    <a class="page-link" href="{{ url('web/empleos?page='~page.last) }}">{{ page.last }}</a>

                                                </li>

                                            {% else %}

                                                {% if page.current >= 5%}
                                                    <li class="page-item">

                                                        {#<a class="page-link" href="{{ url('web/empleos?page='~1) }}">1</a>#}
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',1) }}">1</a>

                                                    </li>
                                                    <li class="page-item">

                                                        <a class="page-link" href="javascript: void(0)">...</a>

                                                    </li>
                                                    <li class="page-item">

                                                        {#<a class="page-link" href="{{ url('web/empleos?page='~page.before) }}">{{ page.before }}</a>#}
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.before) }}">{{ page.before }}</a>

                                                    </li>
                                                    <li class="page-item active">

                                                        {#<a class="page-link" href="{{ url('web/empleos?page='~page.current) }}">{{ page.current }}</a>#}
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.current) }}">{{ page.current }}</a>

                                                    </li>

                                                    <li class="page-item">

                                                        {#<a class="page-link" href="{{ url('web/empleos?page='~page.next) }}">{{ page.next }}</a>#}
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.next) }}">{{ page.next }}</a>

                                                    </li>
                                                    <li class="page-item">

                                                        <a class="page-link" href="javascript: void(0)">...</a>

                                                    </li>
                                                {% else %}

                                                    {% for i in 1..page.total_items if i <= 5 %}

                                                        <li{% if i == page.current %} class="page-item active"{% else %} class="page-item"{% endif %}>

                                                            {#<a class="page-link" href="{{ url('web/empleos?page='~i) }}">{{ i }}</a>#}
                                                            <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>

                                                        </li>


                                                    {% endfor %}
                                                    <li class="page-item">

                                                        <a class="page-link" href="javascript: void(0)">...</a>

                                                    </li>
                                                {% endif %}

                                                <li class="page-item">

                                                    {#<a class="page-link" href="{{ url('web/empleos?page='~page.last) }}">{{ page.last }}</a>#}
                                                    <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.last) }}">{{ page.last }}</a>

                                                </li>

                                            {% endif %}


                                        {% endif %}
                                        {#---------#}

                                        <li class="page-item">


                                            {#{{ link_to("web/empleos?page=" ~ page.next, '>>', "class": "page-link") }}#}
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
