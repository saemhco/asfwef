<style>
    #cke_input-compromiso {
        border: solid 1px black;
    }

    #cke_input-compromiso_cooperante {
        border: solid 1px black;
    }

    #cke_input-objeto {
        border: solid 1px black;
    }
</style>

{% set id_convenio = "" %}
{% set titulo = "" %}
{% set objeto = "" %}
{% set fecha_inicio = "" %}
{% set fecha_termino = "" %}
{% set vigencia = "" %}
{% set compromiso = "" %}
{% set entidad_cooperante = "" %}
{% set compromiso_cooperante = "" %}
{% set suscriptores = "" %}
{% set mecanismos = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set imagen = "" %}

{% set estado = "" %}


{% if convenios.titulo is defined %}
{% set titulo = convenios.titulo %}
{% endif %}

{% if convenios.objeto is defined %}
{% set objeto = convenios.objeto %}
{% endif %}

{% if convenios.fecha_inicio is defined %}
{% set fecha_inicio = utilidades.fechita(convenios.fecha_inicio,'d/m/Y') %}
{% endif %}

{% if convenios.fecha_termino is defined %}
{% set fecha_termino = utilidades.fechita(convenios.fecha_termino,'d/m/Y') %}
{% endif %}

{% if convenios.vigencia is defined %}
{% set vigencia = convenios.vigencia %}
{% endif %}

{% if convenios.compromiso is defined %}
{% set compromiso = convenios.compromiso %}
{% endif %}

{% if convenios.entidad_cooperante is defined %}
{% set entidad_cooperante = convenios.entidad_cooperante %}
{% endif %}

{% if convenios.compromiso_cooperante is defined %}
{% set compromiso_cooperante = convenios.compromiso_cooperante %}
{% endif %}

{% if convenios.suscriptores is defined %}
{% set suscriptores = convenios.suscriptores %}
{% endif %}

{% if convenios.mecanismos is defined %}
{% set mecanismos = convenios.mecanismos %}
{% endif %}

{% if convenios.archivo is defined %}
{% set archivo = convenios.archivo %}
{% endif %}

{% if convenios.enlace is defined %}
{% set enlace = convenios.enlace %}
{% endif %}

{% if convenios.imagen is defined %}
{% set imagen = convenios.imagen %}
{% endif %}

{% if convenios.id_convenio is defined %}
{% set id_convenio = convenios.id_convenio %}
{% endif %}

{% set referencia = "" %}
{% if convenios.referencia is defined %}
{% set referencia = convenios.referencia %}
{% endif %}

{% set referencia_enlace = "" %}
{% if convenios.referencia_enlace is defined %}
{% set referencia_enlace = convenios.referencia_enlace %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if convenios.estado is defined %}
{% set estado = convenios.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}


{% set id_resolucion = "" %}
{% if convenios.id_resolucion is defined %}
{% set id_resolucion = convenios.id_resolucion %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Convenios</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-12" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Convenios</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroconvenios/save','method': 'post','id':'form_convenios','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">





                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Inicio (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>


                                                    {% if estado == ""   %}
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    {% else %}
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Termino(DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == ""   %}
                                                    <input type="text" id="input-fecha_termino" name="fecha_termino"
                                                        placeholder="Fecha Termino" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    {% else %}
                                                    <input type="text" id="input-fecha_termino" name="fecha_termino"
                                                        placeholder="Fecha Termino" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_termino }}">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Vigencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-vigencia" name="vigencia"
                                                        placeholder="Vigencia" value="{{ vigencia }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Título</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo"
                                                        placeholder="Título" value="{{ titulo }}">
                                                    <input type="hidden" id="input-id_convenio" name="id_convenio"
                                                        value="{{ id_convenio }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Objeto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="10" id="input-objeto"
                                                        name="objeto_ckeditor">{{ objeto }}</textarea>
                                                </label>
                                            </section>




                                            <section class="col col-md-12">
                                                <label class="text-info">Compromiso</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="10" id="input-compromiso"
                                                        name="compromiso_ckeditor">{{ compromiso }}</textarea>
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info">Entidad Cooperante</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-entidad_cooperante"
                                                        name="entidad_cooperante" placeholder="Entidad Cooperante"
                                                        value="{{ entidad_cooperante }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info">Compromiso Cooperante</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="10" id="input-compromiso_cooperante"
                                                        name="compromiso_cooperante_ckeditor">{{ compromiso_cooperante }}</textarea>
                                                </label>
                                            </section>



                                            <section class="col col-md-12">
                                                <label class="text-info">Suscriptores</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-suscriptores" name="suscriptores"
                                                        placeholder="Suscriptores" value="{{ suscriptores }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Mecanismos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-mecanismos" name="mecanismos"
                                                        placeholder="Mecanismos" value="{{ mecanismos }}">
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
                                                <label class="text-info">Resolucion</label>
                                                <select style="width:100%" id="input-id_resolucion"
                                                    name="id_resolucion">
                                                    <optgroup label="">
                                                        <option value="0">SELECCIONE...</option>
                                                        {% for resolucion_select in resoluciones %}

                                                        {% if resolucion_select.id_resolucion == id_resolucion %}
                                                        <option selected="selected"
                                                            value="{{ resolucion_select.id_resolucion }}">{{
                                                            resolucion_select.titulo }}</option>

                                                        {% else %}
                                                        <option value="{{ resolucion_select.id_resolucion }}">{{
                                                            resolucion_select.titulo }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </optgroup>
                                                </select>
                                                <p id="input-warning_resolucion">
                                                <p>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Referencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-referencia" name="referencia"
                                                        placeholder="Nombre referencia" value="{{ referencia }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info">Referencia Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-referencia_enlace"
                                                        name="referencia_enlace" placeholder="Referencia enlace"
                                                        value="{{ referencia_enlace }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info">Imagen Convenio</label>

                                                <br>
                                                <img class="img-responsive"
                                                    src="{{ url('adminpanel/imagenes/convenios/'~imagen) }}"
                                                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_convenio" name="archivo_convenio">
                                                    <input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/convenios/'~archivo) }}"> <i
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
    <div id="exito_convenios">
        <p>
            Se grabo resolución correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_resolucion_registrada">
        <p>
            Resolución ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de resolución...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de convocatoria...

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