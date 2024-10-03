{% set id_indicador1 = "" %}
{% if indicadores.id_indicador1 is defined %}
{% set id_indicador1 = indicadores.id_indicador1 %}
{% endif %}

{% set componente1 = "" %}
{% if indicadores.componente1 is defined %}
{% set componente1 = indicadores.componente1 %}
{% endif %}

{% set codigo = "" %}
{% if indicadores.codigo is defined %}
{% set codigo = indicadores.codigo %}
{% endif %}

{% set nombre = "" %}
{% if indicadores.nombre is defined %}
{% set nombre = indicadores.nombre %}
{% endif %}

{% set descripcion = "" %}
{% if indicadores.descripcion is defined %}
{% set descripcion = indicadores.descripcion %}
{% endif %}

{% set enlace = "" %}
{% if indicadores.enlace is defined %}
{% set enlace = indicadores.enlace %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if indicadores.estado is defined %}
{% set estado = indicadores.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Indicadores </li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Indicadores</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('licenciamiento1/saveIndicadores1','method':
                                    'post','id':'form_formatos','class':'smart-form','enctype':'multipart/form-data') }}

                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-12">
                                                <label class="text-info">Condiciones</label>
                                                <label class="select">
                                                    <select id="input-condicion" name="condicion1" style="pointer-events: none;">
                                                        <option value="">Seleccione...</option>
                                                        {% for condiciones_select in condiciones %}

                                                        {% if condiciones_select.id_condicion1 == condicionSelected %}
                                                        <option value="{{ condiciones_select.id_condicion1 }}"
                                                            selected="selected">{{ condiciones_select.nombre }}</option>
                                                        {% else %}
                                                        <option value="{{ condiciones_select.id_condicion1 }}">{{
                                                            condiciones_select.nombre }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Componentes</label>
                                                <label class="select">
                                                    <select id="input-componente" name="componente1"
                                                        style="pointer-events: none;">
                                                        <option value="">Seleccione...</option>
                                                        {% for componentes_select in componentes %}

                                                        {% if componentes_select.id_componente1 == componenteSelected %}
                                                        <option value="{{ componentes_select.id_componente1 }}"
                                                            selected="selected">{{ componentes_select.nombre }}</option>
                                                        {% else %}
                                                        <option value="{{ componentes_select.id_componente1 }}">{{
                                                            componentes_select.nombre }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo"
                                                        placeholder="Código" value="{{codigo }}">
                                                        <input type="hidden" id="input-codigo_oculto" name="codigo_oculto" value="{{ codigo }}">      
                                                </label>

                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Nombre</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <input type="hidden" id="input-id_indicador1" name="id_indicador1"
                                                        value="{{ id_indicador1 }}">
                                                    <textarea rows="6" id="input-nombre" name="nombre"
                                                        placeholder="Nombre">{{ nombre }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="6" id="input-descripcion" name="descripcion"
                                                        placeholder="Descripcion">{{ descripcion }}</textarea>
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace"
                                                        placeholder="Enlace" value="{{ enlace }}">

                                                </label>
                                            </section>

                                        </div>
                                    </fieldset>

                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="{{ url('licenciamiento1/indicadores1') }}" type="button" class="btn btn-default">
                                            Volver
                                        </a>

                                    </footer>
                                    {{ endForm() }}
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="hidden">
    <div id="exito_formatos">
        <p>
            Se grabo formato correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="codigo_vacio">
        <p>
            Debe ingresar un codigo válido...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="codigo_registrado">
        <p>
            Codigo registrado...
        </p>
    </div>
</div>


<script type="text/javascript">
    var id = "";
    var publica = "si";

    {% if id is defined %}
    id = "{{ id }}";
    {% endif %}

</script>
<script type="text/javascript">
    var id_indicador1 = "{{ id}}";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>