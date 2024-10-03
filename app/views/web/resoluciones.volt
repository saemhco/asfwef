{% block content %}
    <div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
        <div class="container">
            <div class="text-left">
                <h2 style="color: #757575; margin-top: -15px !important;">
                    {{ config.global.xSeparadorIns }} 
                    Resoluciones
                </h2>
            </div>
        </div>
    </div>
    <div class="container container-full" style ="margin-top: -50px;">
        <div class="ms-paper">
            <div class="row">
                <?php $this->partial('shared/menu1'); ?>
                <!-- CENTER -->
                <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-search"></i><strong>Búsqueda de Resoluciones</strong></h3>
                        </div>
                        <div class="card-body">

                            {{ form(full_url,'method': 'get','id':'form_search','class':'form-horizontal','autocomplete':'off') }}

                            <fieldset>
                                {#<legend>Legend</legend>#}
                                <div class="form-group row justify-content-end" style ="margin-top: -10px;">
                                    <div class="col-lg-8">
                                        <select id="select1" class="form-control selectpicker" data-dropup-auto="false" name="tipo_resolucion">
                                            <option value="">--- SELECCIONE TIPO DE RESOLUCIÓN --- </option>
                                            {% for tiporesolucion in tiporesoluciones %}
                                                {% if tiporesolucion.codigo == tipo_resolucion %}
                                                    <option value="{{ tiporesolucion.codigo }}" selected="selected" >{{ tiporesolucion.nombres}}</option>
                                                {% else %}
                                                    <option value="{{ tiporesolucion.codigo }}" >{{ tiporesolucion.nombres}}</option>
                                                {% endif %}
                                            {% endfor %}  
                                        </select>
                                    </div>


                                    <div class="col-lg-4">
                                        <select id="select2" class="form-control selectpicker" data-dropup-auto="false" name="anio_resolucion">
                                            <option value="">--- SELECCIONE AÑO---</option>
                                            {% for anioresolucion in anioresoluciones %}
                                                {% if anioresolucion.nombres == anio_resolucion %}
                                                    <option value="{{ anioresolucion.nombres }}" selected="selected" codigo>{{ anioresolucion.nombres}}</option>
                                                {% else %}
                                                    <option value="{{ anioresolucion.nombres }}" >{{ anioresolucion.nombres}}</option>
                                                {% endif %}
                                            {% endfor %} 
                                        </select>
                                    </div>

                                    <div class="col-lg-8">
                                        <input type="text" placeholder="Buscar por  Número / Nombre / Resumen" class="form-control" name="nombre_resolucion" value="{{ nombre_resolucion }}" style="color: #757575;">                           
                                    </div>
                                    <div class="col-lg-4">
                                        {#<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />#}
                                        <button type="submit" class="btn btn-raised btn-primary btn-block"><i class="zmdi zmdi-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </fieldset>
                            {{ endForm() }}
                            <br>
                            {% for  resolucion in page.items %}
                                <div class="card card-primary">
                                    <div class="card-body">                                              
                                        <a target="_blank" href="adminpanel/archivos/resoluciones/{{ resolucion.archivo }}"                                 
                                           <h3 class="color-primary"><strong>{{ resolucion.titulo }}</strong></h3>                                
                                        </a>
                                        <h6>FECHA: {{ utilidades.fechita(resolucion.fecha,"d/m/Y")}}</h6>
                                        <h6><p style="text-align:justify;margin-bottom: -5px;">{{ resolucion.resumen}}</p></h6>
                                        <div class="row">                                                
                                            <div class="col text-right">
                                                <a target="_blank" href="adminpanel/archivos/resoluciones/{{ resolucion.archivo }}"  class="btn btn-raised btn-sm btn-primary"><i class="zmdi zmdi-download"></i> Descargar</a>
                                            </div>
                                        </div>                                            
                                    </div>                               
                                </div>
                            {% endfor %}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                            
{% endblock %}
