<style>
    #cke_input-texto_muestra {
        border: solid 1px black;
    }
</style>

{% set codigo = "" %}
{% if publicoreconocimiento.codigo is defined %}
{% set codigo = publicoreconocimiento.codigo %}
{% endif %}

{% set id_publico = "" %}
{% if publicoreconocimiento.id_publico is defined %}
{% set id_publico = publicoreconocimiento.id_publico %}
{% endif %}

{% set id_tipo_reconocimiento = "" %}
{% if publicoreconocimiento.id_tipo_reconocimiento is defined %}
{% set id_tipo_reconocimiento = publicoreconocimiento.id_tipo_reconocimiento %}
{% endif %}

{% set nombre = "" %}
{% if publicoreconocimiento.nombre is defined %}
{% set nombre = publicoreconocimiento.nombre %}
{% endif %}

{% set institucion = "" %}
{% if publicoreconocimiento.institucion is defined %}
{% set institucion = publicoreconocimiento.institucion %}
{% endif %}

{% set fecha_reconocimiento = "" %}
{% if publicoreconocimiento.fecha_reconocimiento is defined %}
{% set fecha_reconocimiento = utilidades.fechita(publicoreconocimiento.fecha_reconocimiento,'d/m/Y') %}
{% endif %}

{% set pais = "" %}
{% if publicoreconocimiento.pais is defined %}
{% set pais = publicoreconocimiento.pais %}
{% endif %}

{% set archivo = "" %}
{% if publicoreconocimiento.archivo is defined %}
{% set archivo = publicoreconocimiento.archivo %}
{% endif %}

{% set imagen = "" %}
{% if publicoreconocimiento.imagen is defined %}
{% set imagen = publicoreconocimiento.imagen %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if publicoreconocimiento.estado is defined %}
{% set estado = publicoreconocimiento.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Publico Reconocimientos</li>
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
                                <h2>Registro de Publico Reconocimientos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registropublicoreconocimientos/save','method':
                                    'post','id':'form_tbl_web_publico_reconocimientos','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    {% if estado == "" %}
                                                    <input type="text" id="input-fecha_reconocimiento"
                                                        name="fecha_reconocimiento" placeholder="Fecha"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_actual }}">
                                                    {% else %}
                                                    <input type="text" id="input-fecha_reconocimiento"
                                                        name="fecha_reconocimiento" placeholder="Fecha"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_reconocimiento }}">
                                                    {% endif %}
                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Tipo de Reconocimientos</label>
                                                <label class="select">
                                                    <select id="input-id_tipo_reconocimiento" name="id_tipo_reconocimiento">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for tiporeconocimiento in tiporeconocimientos %}
                                                        {% if tiporeconocimiento.codigo == id_tipo_reconocimiento %}
                                                        <option selected="selected"
                                                            value="{{ tiporeconocimiento.codigo }}">{{
                                                                tiporeconocimiento.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tiporeconocimiento.codigo }}">{{
                                                            tiporeconocimiento.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info"> Publico
                                                </label>

                                                <select style="width:100%" id="input-id_publico" name="id_publico">
                                                    <option value="">Seleccione...</option>
                                                    {% for publico_select in publico %}
                                                    {% if publico_select.codigo == id_publico %}
                                                    <option selected="selected" value="{{ publico_select.codigo }}">
                                                        {{publico_select.apellidop }} {{publico_select.apellidom }}
                                                        {{publico_select.nombres }}</option>
                                                    {% else %}
                                                    <option value="{{ publico_select.codigo }}">
                                                        {{publico_select.apellidop }} {{publico_select.apellidom }}
                                                        {{publico_select.nombres }}</option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info">Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre"
                                                        placeholder="Nombre" value="{{ nombre }}">
                                                    <input type="hidden" id="input-codigo" name="codigo"
                                                        value="{{ codigo }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info">Institucion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-institucion" name="institucion"
                                                        placeholder="Institucion" value="{{ institucion }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Pais </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pais" name="pais" placeholder="Pais"
                                                        value="{{ pais }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen</label>

                                                {% if imagen !== "" %}
                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/publicoreconocimientos/'~imagen) }}"
                                                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                {% endif %}


                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">


                                                        <span class="button"><input id="imagen" type="file"
                                                                name="imagen_publicoreconocimiento"
                                                                onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                class="fa fa-search"></i> Buscar</span><input
                                                            type="text" id="input-imagen" name="imagen"
                                                            placeholder="Agregar Archivo" readonly="">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">
                                                    <span class="button"><input id="archivo" type="file"
                                                            name="archivo_publicoreconocimientos"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file" name="archivo" placeholder="Agregar Archivo"
                                                        readonly="">

                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/publicoreconocimientos/'~archivo) }}"> <i
                                                            class="fa-fw fa fa-eye"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                </div>

                                                {% endif %}

                                            </section>



                                        </div>
                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()" type="button" class="btn btn-default">
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
    <div id="exito_autoridades">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<script type="text/javascript">
    var idl = "";
    var publica = "si";

    {% if id is defined %}
    idl = {{ id }};
    {% endif %}

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>