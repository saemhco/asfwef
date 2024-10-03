<style>
    #cke_input-texto_muestra {
        border: solid 1px black;
    }
</style>

{% set codigo = "0" %}
{% if autoridades.codigo is defined %}
{% set codigo = autoridades.codigo %}
{% endif %} 

{% set personal = "" %}
{% if autoridades.personal is defined %}
{% set personal = autoridades.personal %}
{% endif %}

{% set documento = "" %}
{% if autoridades.documento is defined %}
{% set documento = autoridades.documento %}
{% endif %}

{% set documento_enlace = "" %}
{% if autoridades.documento_enlace is defined %}
{% set documento_enlace = autoridades.documento_enlace %}
{% endif %}

{% set descripcion = "" %}
{% if autoridades.descripcion is defined %}
{% set descripcion = autoridades.descripcion %}
{% endif %}

{% set fecha_inicio = "" %}
{% if autoridades.fecha_inicio is defined %}
{% set fecha_inicio = utilidades.fechita(autoridades.fecha_inicio,'d/m/Y') %}
{% endif %}

{% set fecha_fin = "" %}
{% if autoridades.fecha_fin is defined %}
{% set fecha_fin = utilidades.fechita(autoridades.fecha_fin,'d/m/Y') %}
{% endif %}

{% set archivo = "" %}
{% if autoridades.archivo is defined %}
{% set archivo = autoridades.archivo %}
{% endif %}

{% set imagen = "" %}
{% if autoridades.imagen is defined %}
{% set imagen = autoridades.imagen %}
{% endif %}

{% set enlace = "" %}
{% if autoridades.enlace is defined %}
{% set enlace = autoridades.enlace %}
{% endif %}


{% set imagen_vertical = "0" %} 
{% if autoridades.imagen_vertical is defined %}
{% set imagen_vertical = autoridades.imagen_vertical %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if autoridades.estado is defined %}
{% set estado = autoridades.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Autoridades</li>
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
                                <h2>Registro de Autoridades</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroautoridades/save','method':
                                    'post','id':'form_autoridades','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Fin</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_fin" name="fecha_fin"
                                                        placeholder="Fecha Fin" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_fin }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info"> Personal
                                                </label>

                                                <select style="width:100%" id="input-personal" name="personal">
                                                    <option value="">Seleccione...</option>
                                                    {% for personal_select in personal_model %}
                                                    {% if personal_select.codigo == personal %}
                                                    <option selected="selected" value="{{ personal_select.codigo }}">
                                                        {{personal_select.apellidop }} {{personal_select.apellidom }}
                                                        {{personal_select.nombres }}</option>
                                                    {% else %}
                                                    <option value="{{ personal_select.codigo }}">
                                                        {{personal_select.apellidop }} {{personal_select.apellidom }}
                                                        {{personal_select.nombres }}</option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>


                                            </section>



                                            <section class="col col-md-6">
                                                <label class="text-info">Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-documento" name="documento"
                                                        placeholder="Documento" value="{{ documento }}">
                                                
                                                        <input type="hidden" id="input-codigos" name="codigos"
                                                        value="{{ codigo }}">
                                                       
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Documento enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-documento_enlace"
                                                        name="documento_enlace" placeholder="Documento enlace"
                                                        value="{{ documento_enlace }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripcion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-descripcion"
                                                        name="descripcion">{{ descripcion }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace"
                                                        placeholder="Enlace" value="{{ enlace }}">

                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen</label>

                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-toggle="collapse" data-target="#imagen_personal"><i
                                                        class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                                                    Imagen</button>

                                                <div id="imagen_personal" class="collapse">

                                                    {% if imagen !== "" %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/autoridades/'~imagen) }}"
                                                        error="this.onerror=null;this.src='';"></img>
                                                    {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                    {% endif %}
                                                </div>





                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">


                                                        <span class="button"><input id="imagen" type="file"
                                                                name="imagen_autoridades"
                                                                onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                class="fa fa-search"></i> Buscar</span><input
                                                            type="text" id="input-imagen" name="imagen"
                                                            placeholder="Agregar Archivo" readonly="">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-3" style="">
                                                <label class="checkbox">
                                                    {% if imagen_vertical == '1' %}
                                                    <input type="checkbox" name="imagen_vertical"
                                                        value="{{ imagen_vertical }}" id="input-imagen_vertical"
                                                        checked>
                                                    {% elseif imagen_vertical == '0' %}
                                                    <input type="checkbox" name="imagen_vertical"
                                                        value="{{ imagen_vertical }}" id="input-imagen_vertical">
                                                    {% endif %}
                                                    <i></i>Imagen vertical</label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">
                                                    <span class="button"><input id="archivo" type="file"
                                                            name="archivo_autoridades"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file" name="archivo" placeholder="Agregar Archivo"
                                                        readonly="">

                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/autoridades/'~archivo) }}"> <i
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



        //alert("Hola");
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>