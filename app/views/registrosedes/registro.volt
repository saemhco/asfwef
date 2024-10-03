<style>
    #cke_input-texto_muestra {
        border: solid 1px black;
    }
</style>

{% set id_sede = "" %}
{% if model.id_sede is defined %}
{% set id_sede = model.id_sede %}
{% endif %}

{% set nombres = "" %}
{% if model.nombres is defined %}
{% set nombres = model.nombres %}
{% endif %}

{% set descripcion = "" %}
{% if model.descripcion is defined %}
{% set descripcion = model.descripcion %}
{% endif %}

{% set direccion = "" %}
{% if model.direccion is defined %}
{% set direccion = model.direccion %}
{% endif %}

{% set abreviatura = "" %}
{% if model.abreviatura is defined %}
{% set abreviatura = model.abreviatura %}
{% endif %}

{% set imagen = "" %}
{% if model.imagen is defined %}
{% set imagen = model.imagen %}
{% endif %}

{% set archivo = "" %}
{% if model.archivo is defined %}
{% set archivo = model.archivo %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if model.estado is defined %}
{% set estado = model.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

{% set codigo = "" %}
{% if model.codigo is defined %}
{% set codigo = model.codigo %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Sedes</li>
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
                                <h2>Registro de Sedes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrosedes/save','method':
                                    'post','id':'form_tbl_web_sedes','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info">Codigo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo"
                                                        placeholder="Codigo" value="{{ codigo }}">
                                                    <input type="hidden" id="input-id_sede" name="id_sede"
                                                        value="{{ id_sede }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info">Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres"
                                                        name="nombres" placeholder="Nombres"
                                                        value="{{ nombres }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripcion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-descripcion"
                                                        name="descripcion">{{ descripcion }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info">Direccion </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion" name="direccion"
                                                        placeholder="Direccion" value="{{ direccion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Abreviatura </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-abreviatura" name="abreviatura"
                                                        placeholder="Abreviatura" value="{{ abreviatura }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen</label>

                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-toggle="collapse" data-target="#imagen_save"><i
                                                        class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                                                    Imagen</button>

                                                <div id="imagen_save" class="collapse">

                                                    {% if imagen !== "" %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/sedes/'~imagen) }}"
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
                                                                name="imagen_sedes"
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
                                                            name="archivo_sedes"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file" name="archivo" placeholder="Agregar Archivo"
                                                        readonly="">

                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/sedes/'~archivo) }}"> <i
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