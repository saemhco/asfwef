<div class="col-lg-3 ms-paper-menu-left-container" style ="margin-top: 20px;">
    <div class="ms-paper-menu-left">

        <div class="card">
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple active" style="pointer-events: none;">CARGOS</a>
                {% for  cargo_model in cargos %}
                    {% set cantidad = utilidades.count_empleos('cargo',cargo_model.codigo) %} 
                   
                    {% if cantidad != 0 %}
                        <a href="{{  utilidades.url_search(full_url,'cargo',cargo_model.codigo) }}" class="list-group-item list-group-item-action withripple" id="{{'cargo_'~cargo_model.codigo}}"><i class="zmdi zmdi-check"></i> {{ cargo_model.nombres}} <span class="ml-auto badge-pill bg-success">{{ utilidades.count_empleos('cargo',cargo_model.codigo) }}</span></a>
                        {% endif %}
                    {% endfor %} 
            </div>
        </div>

        <div class="card">
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple active" style="pointer-events: none;">DISTRITOS</a>
                {% for  menu_distrito in menu_distritos %}

                    <a href="{{  utilidades.url_search(full_url,'distrito',menu_distrito.ubigeo_id) }}" class="list-group-item list-group-item-action withripple" id="{{'distrito_'~menu_distrito.ubigeo_id}}"><i class="zmdi zmdi-check"></i> {{ menu_distrito.distrito}} <span class="ml-auto badge-pill bg-success">{{ menu_distrito.numero_empleos}}</span></a>

                {% endfor %} 
            </div>
        </div>


        <div class="card">
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple active" style="pointer-events: none;">TIPO DE JORNADA</a>
                {% for  jornada_model in jornadas %}
                    {% set cantidad = utilidades.count_empleos('jornada',jornada_model.codigo) %}
                    {% if cantidad != 0 %}
                        <a href="{{  utilidades.url_search(full_url,'jornada',jornada_model.codigo) }}" class="list-group-item list-group-item-action withripple" id="{{'jornada_'~jornada_model.codigo}}"><i class="zmdi zmdi-check"></i> {{ jornada_model.nombres}} <span class="ml-auto badge-pill bg-success">{{ utilidades.count_empleos('jornada',jornada_model.codigo) }}</span></a>
                        {% endif %}
                    {% endfor %} 
            </div>
        </div>

        <div class="card">
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action withripple active" style="pointer-events: none;">TIPO DE CONTRATO</a>
                {% for  tipocontrato_model in tipocontratos %}
                    {% set cantidad = utilidades.count_empleos('tipocontrato',tipocontrato_model.codigo) %}
                    {% if cantidad != 0 %}
                        <a href="{{  utilidades.url_search(full_url,'tipocontrato',tipocontrato_model.codigo) }}" class="list-group-item list-group-item-action withripple" id="{{'contrato_'~tipocontrato_model.codigo}}"><i class="zmdi zmdi-check"></i> {{ tipocontrato_model.nombres}} <span class="ml-auto badge-pill bg-success">{{ utilidades.count_empleos('tipocontrato',tipocontrato_model.codigo) }}</span></a>
                        {% endif %}
                    {% endfor %} 
            </div>
        </div>

    </div>
</div>