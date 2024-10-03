<div class="col-lg-3 ms-paper-menu-left-container" style ="margin-top: 20px;">
    <div class="ms-paper-menu-left">
        <div class="card">
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple active" style="pointer-events: none;">CATEGORIAS</a>
                {% for  categoria_model in categorias %}
                    {% set cantidad = utilidades.count_libros('categoria',categoria_model.codigo) %}
                    {% if cantidad != 0 %}
                        <a href="{{  utilidades.url_search(full_url,'categoria',categoria_model.codigo) }}" class="list-group-item list-group-item-action withripple" id="{{'categoria_'~categoria_model.codigo}}"><i class="zmdi zmdi-check"></i> {{ categoria_model.nombres}} <span class="ml-auto badge-pill bg-success">{{ utilidades.count_libros('categoria',categoria_model.codigo) }}</span></a>
                        {% endif %}
                    {% endfor %} 
            </div>
        </div>
        <div class="card">
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple active" style="pointer-events: none;">IDIOMA</a>
                {% for  idioma_model in idiomas %}
                    {% set cantidad = utilidades.count_libros('idioma',idioma_model.codigo) %}
                    {% if cantidad != 0 %}
                        <a href="{{  utilidades.url_search(full_url,'idioma',idioma_model.codigo) }}" class="list-group-item list-group-item-action withripple" id="{{'idioma_'~idioma_model.codigo}}"><i class="zmdi zmdi-check"></i> {{ idioma_model.nombres}} <span class="ml-auto badge-pill bg-success">{{ utilidades.count_libros('idioma',idioma_model.codigo) }}</span></a>
                        {% endif %}
                    {% endfor %} 
            </div>
        </div>
    </div>
</div>