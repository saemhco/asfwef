{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                Visitas
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-globe"></i><strong>Registro de Visitas</strong></h3>
                    </div>
                    <div class="card-body">
                        {{ form('web-visitas.html','method':
                        'get','id':'form_search','class':'form-horizontal','autocomplete':'off') }}

                        <fieldset>
                            <div class="form-group row justify-content-end">
                                <div class="col-lg-8">
                      

                                        <input id="datePicker1" placeholder="Buscar por fecha de visita" type="text" class="form-control" name="fecha_visita" placeholder="dd/mm/yyyy" value="{{ fecha_visita }}">

                                </div>
                                <div class="col-lg-4">
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                                    <button type="submit" class="btn btn-raised btn-primary btn-block"><i
                                            class="zmdi zmdi-search"></i> Buscar</button>
                                </div>
                            </div>
                        </fieldset>
                        {{ endForm() }}
                        <br>
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th width="10%" style="vertical-align: middle;text-align: center;">
                                        <h5 style="font-size: 12px;">
                                            <center>FECHA</center>
                                        </h5>
                                    </th>
                                    <th width="18%" style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">VISITANTE</h5>
                                    </th>
                                    <th width="15%" style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">
                                            <center>DOCUMENTO</center>
                                        </h5>
                                    </th>
                                    <th width="30%" style="vertical-align: middle;text-align: center;">
                                        <h5 style="font-size: 12px;">ENTIDAD</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">MOTIVO</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">SEDE</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">EMPLEADO PUBLICO</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">OFICINA</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">LUGAR</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">HORA INGRESO</h5>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">HORA SALIDA</h5>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                {% for visitas in page.items %}
                                <tr>

                                    <td>
                                        <center>
                                            <h5  style="font-size: 12px;">
                                                {{ visitas.fecha_visita}}
                                            </h5>
                                        </center>
                                    </td>
                                    <td style="vertical-align: middle;text-align: left;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.visitante}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.documento}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.razon_social}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.motivo}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.sede}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.personal}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.area}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.lugar}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.hora_ingreso}}
                                        </h5>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <h5  style="font-size: 12px;">
                                            {{ visitas.hora_salida}}
                                        </h5>
                                    </td>


                                </tr>
                                {% endfor %}

                            </tbody>
                        </table>
                        <br>

                        {#----paginador---#}
                        <div align="center">
                            <nav aria-label="Page navigation" style="display: inline-block;">
                                <!-- Pagination Default -->
                                {#<p>pagina actual: {{ page.current}}</p>
                                <p>pagina anterior: {{ page.first}}</p>
                                <p>pagina ultima: {{ page.last}}</p>
                                <p>pagina limite: {{ page.limit}}</p>
                                <p>pagina siguiente: {{ page.next}}</p>
                                <p>pagina total: {{ page.total_items}}</p>#}

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
        
                                                <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.before) }}"><<</a>
        
                                            </li>
        
                                            {#----------#}
                                            {% if page.last == 1%}
                                                <li class="page-item active">
        
                                                    <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>
        
                                                </li>
                                            {%  elseif(page.last == 2) %}
        
                                                {% for i in 1..page.total_items if i <= 2 %}
                                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                    </li>
        
                                                {% endfor %}
        
                                            {%  elseif(page.last == 3) %}
        
                                                {% for i in 1..page.total_items if i <= 3 %}
                                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                    </li>
        
                                                {% endfor %}
        
                                            {%  elseif(page.last == 4) %}
        
                                                {% for i in 1..page.total_items if i <= 4 %}
                                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
                                                    </li>
        
                                                {% endfor %}
        
                                            {%  elseif(page.last == 5) %}
        
                                                {% for i in 1..page.total_items if i <= 5 %}
                                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
        
                                                    </li>
        
                                                {% endfor %}
        
                                            {%  elseif(page.last == 6) %}
        
                                                {% for i in 1..page.total_items if i <= 6 %}
                                                    <li  {% if i == page.current %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
        
                                                    </li>
        
                                                {% endfor %}
        
                                            {% else %}
                                                {% if page.current == page.last-1 or page.current == page.last-2 or page.current == page.last-3 %}
        
                                                    <li class="page-item">
        
                                                        <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>
        
                                                    </li>
        
                                                    <li class="page-item">
        
                                                        <a class="page-link" href="javascript: void(0)">...</a>
        
                                                    </li>
        
                                                    {% set page_last_4 = page.last-4 %}
                                                    <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_4) }}">{{ page_last_4 }}</a>
        
                                                    </li>
        
                                                    {% set page_last_3 = page.last-3 %}
                                                    <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_3) }}">{{ page_last_3 }}</a>
                                                    </li>
        
                                                    {% set page_last_2 = page.last-2 %}
                                                    <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_2) }}">{{ page_last_2 }}</a>
        
                                                    </li>
        
                                                    {% set page_last_1 = page.last-1 %}
                                                    <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_1) }}">{{ page_last_1 }}</a>
        
                                                    </li>
        
                                                    <li  {% if page.current == page.last %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page.last) }}">{{ page.last }}</a>
        
                                                    </li>
        
                                                {%  elseif(page.current == page.last) %}
        
                                                    <li class="page-item">
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page.first) }}">{{ page.first }}</a>
        
                                                    </li>
                                                    <li class="page-item">
        
                                                        <a class="page-link" href="javascript: void(0)">...</a>
        
                                                    </li>
        
                                                    {% set page_last_4 = page.last-4 %}
                                                    <li  {% if page.current == page_last_4 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_4) }}">{{ page_last_4 }}</a>
        
                                                    </li>
        
                                                    {% set page_last_3 = page.last-3 %}
                                                    <li  {% if page.current == page_last_3 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_3) }}">{{ page_last_3 }}</a>
        
                                                    </li>
        
                                                    {% set page_last_2 = page.last-2 %}
                                                    <li  {% if page.current == page_last_2 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_2) }}">{{ page_last_2 }}</a>
        
                                                    </li>
        
                                                    {% set page_last_1 = page.last-1 %}
                                                    <li  {% if page.current == page_last_1 %} class="page-item active" {% else %} class="page-item"{% endif %}>
        
                                                        <a class="page-link" href="{{  utilidades.url_search(full_url,'page',page_last_1) }}">{{ page_last_1 }}</a>
        
                                                    </li>
        
                                                    <li  {% if page.current == page.last %} class="page-item active"{% else %} class="page-item"{% endif %}>
        
                                                        
                                                        <a class="page-link" href="{{ url('resoluciones.html?page='~page.last) }}">{{ page.last }}</a>
        
                                                    </li>
        
                                                {% else %}
        
                                                    {% if page.current >= 5%}
                                                        <li class="page-item">
        
                                                            <a class="page-link" href="{{  utilidades.url_search(full_url,'page',1) }}">1</a>
        
                                                        </li>
                                                        <li class="page-item">
        
                                                            <a class="page-link" href="javascript: void(0)">...</a>
        
                                                        </li>
                                                        <li class="page-item">
        
                                                            <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.before) }}">{{ page.before }}</a>
        
                                                        </li>
                                                        <li class="page-item active">
        
                                                            <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.current) }}">{{ page.current }}</a>
        
                                                        </li>
        
                                                        <li class="page-item">
        
                                                            <a class="page-link" href="{{ utilidades.url_search(full_url,'page',page.next) }}">{{ page.next }}</a>
        
                                                        </li>
                                                        <li class="page-item">
        
                                                            <a class="page-link" href="javascript: void(0)">...</a>
        
                                                        </li>
                                                    {% else %}
        
                                                        {% for i in 1..page.total_items if i <= 5 %}
        
                                                            <li{% if i == page.current %} class="page-item active"{% else %} class="page-item"{% endif %}>
        
                                                                <a class="page-link" href="{{  utilidades.url_search(full_url,'page',i) }}">{{ i }}</a>
        
                                                            </li>
        
        
                                                        {% endfor %}
                                                        <li class="page-item">
        
                                                            <a class="page-link" href="javascript: void(0)">...</a>
        
                                                        </li>
                                                    {% endif %}
        
                                                    <li class="page-item">
        
                                                        
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
                                <!-- /Pagination Default -->
                            </nav>
                        </div>
                        {#---fin paginador-----#}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var site_key = "{{site_key}}";
</script>
{% endblock %}