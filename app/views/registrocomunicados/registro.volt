<style>
    #cke_input-texto_complementario {
        border: solid 1px black;
    }
</style>
{% set id_comunicado = "" %}
{% set titular = "" %}
{% set texto_muestra = "" %}
{% set texto_complementario = "" %}
{% set fecha_hora = "" %}

{% set archivo = "" %}
{% set imagen = "" %}
{% set estado = "" %}



{% if comunicados.titular is defined %}
{% set titular = comunicados.titular %}
{% endif %}

{% if comunicados.texto_muestra is defined %}
{% set texto_muestra = comunicados.texto_muestra %}
{% endif %}

{% if comunicados.texto_complementario is defined %}
{% set texto_complementario = comunicados.texto_complementario %}
{% endif %}

{% if comunicados.fecha_hora is defined %}
{% set fecha_hora = utilidades.fechita(comunicados.fecha_hora,'d/m/Y') %}
{% endif %}

{% if comunicados.archivo is defined %}
{% set archivo = comunicados.archivo %}
{% endif %}

{% if comunicados.imagen is defined %}
{% set imagen = comunicados.imagen %}
{% endif %}


{% if comunicados.id_comunicado is defined %}
{% set id_comunicado = comunicados.id_comunicado %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if comunicados.estado is defined %}
{% set estado = comunicados.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Comunicados </li>
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
                                <h2>Registro de Comunicados </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrocomunicados/save','method':
                                    'post','id':'form_tbl_web_comunicados','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha de Lanzamienro (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == "" %}
                                                    <input type="text" id="input-fecha_hora" name="fecha_hora"
                                                        placeholder="Fecha de hora" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">

                                                    {% else %}
                                                    <input type="text" id="input-fecha_hora" name="fecha_hora"
                                                        placeholder="Fecha de hora" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_hora }}">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info">Titular </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titular" name="titular"
                                                        placeholder="Titular" value="{{ titular }}">
                                                    <input type="hidden" id="input-id_comunicado" name="id_comunicado"
                                                        value="{{ id_comunicado }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Texto Muestra</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-texto_muestra"
                                                        name="texto_muestra">{{ texto_muestra }}</textarea>
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Texto Complementario</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="16" id="input-texto_complementario"
                                                        name="texto_complementario_ckeditor">{{ texto_complementario }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen </label>

                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/comunicados/'~imagen) }}"
                                                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                        {#<input type="hidden" id="input-imagen_noticia"
                                                            name="imagen_noticia" value="">#}
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_noticia" name="archivo_noticia">
                                                    {#<input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/comunicados/'~archivo) }}"> <i
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

                                    <fieldset>
                                        <div class="row">

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
    <div id="exito_noticias">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript">
    var publica = "si";
</script>
