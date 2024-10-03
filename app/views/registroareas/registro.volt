<style>
    #cke_input-descripcion {
        border: solid 1px black;
    }
</style>

{% set codigo = "" %}
{% set tipo = "" %}
{% set nombres = "" %}
{% set descripcion = "" %}
{% set email = "" %}
{% set personal = "" %}
{% set unidad_enlace = "" %}
{% set orden = "" %}
{% set archivo = "" %}
{% set enlace = "" %}

{% set estado = "" %}

{% if areas.tipo is defined %}
{% set tipo = areas.tipo %}
{% endif %}

{% set imagen = "" %}

{% if areas.imagen is defined %}
{% set imagen = areas.imagen %}
{% endif %}

{% if areas.nombres is defined %}
{% set nombres = areas.nombres %}
{% endif %}

{% if areas.descripcion is defined %}
{% set descripcion = areas.descripcion %}
{% endif %}

{% if areas.email is defined %}
{% set email = areas.email %}
{% endif %}

{% if areas.personal is defined %}
{% set personal = areas.personal %}
{% endif %}

{% if areas.unidad_enlace is defined %}
{% set unidad_enlace = areas.unidad_enlace %}
{% endif %}

{% if areas.orden is defined %}
{% set orden = areas.orden %}
{% endif %}

{% if areas.archivo is defined %}
{% set archivo = areas.archivo %}
{% endif %}

{% if areas.enlace is defined %}
{% set enlace = areas.enlace %}
{% endif %}

{% if areas.codigo is defined %}
{% set codigo = areas.codigo %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if areas.estado is defined %}
{% set estado = areas.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}


<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Areas</li>
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
                                <h2>Registro de Areas </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroareas/save','method':
                                    'post','id':'form_areas','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info">Imagen Área</label>
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-toggle="collapse" data-target="#imagen_personal"><i
                                                        class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                                                    Imagen</button>

                                                <div id="imagen_personal" class="collapse">

                                                    {% if imagen !== "" %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/areas/'~imagen) }}"
                                                        error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                    {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                    {% endif %}
                                                </div>
                                            </section>



                                            <section class="col col-md-4">

                                                <label class="text-info">Tipo de area
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_area" name="tipo">
                                                        <option value="">Seleccione...</option>
                                                        {% for tipoarea in tipoareas %}
                                                        {% if tipoarea.codigo == tipo %}
                                                        <option selected="selected" value="{{ tipoarea.codigo }}">{{
                                                            tipoarea.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipoarea.codigo }}">{{ tipoarea.nombres }}
                                                        </option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Email</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-email" name="email" placeholder="Email"
                                                        value="{{ email }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info">Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres"
                                                        placeholder="Nombre de la Dirección / Unidad"
                                                        value="{{ nombres }}">
                                                    <input type="hidden" id="input-codigo" name="codigo"
                                                        value="{{ codigo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="10" id="input-descripcion"
                                                        name="descripcion_ckeditor">{{ descripcion }}</textarea>
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Orden</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden" placeholder="Orden"
                                                        value="{{ orden }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace"
                                                        placeholder="Enlace" value="{{ enlace }}">

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Unidad enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-unidad_enlace" name="unidad_enlace"
                                                        placeholder="Unidad Enlace" value="{{ unidad_enlace }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-6">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <span class="button"><input id="archivo" type="file" name="archivo"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file" name="input-file" placeholder="Agregar Archivo"
                                                        readonly="">

                                                </div>


                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/areas/'~archivo) }}"> <i
                                                            class="fa-fw fa fa-book"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                </div>

                                                {% endif %}

                                            </section>


                                            <section class="col col-md-6">

                                                <label class="text-info">Imagen Area (600 x 400 px)</label>
                                                <div class="input input-file">

                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file"
                                                                name="imagen"
                                                                onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                class="fa fa-search"></i> Buscar</span><input
                                                            type="text" id="input-image" name="input-file"
                                                            placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if imagen !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver la imagen
                                                    <a href="javascript:void(0);" class="btn btn-ribbon" role="button"
                                                        onclick="imagen_registro();"> <i
                                                            class="fa-fw fa fa-image"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido una imagen.
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


        {% if estado !== "" %}
        <div class="col-sm-1">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                data-widget-custombutton="false" data-widget-sortable="false">
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body text-center">
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>
                        {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i
                                class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Relación de Personal</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_areas_detalles"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Orden</th>
                                                <th>Nombres</th>
                                                <th data-hide="phone,tablet">Apellido Paterno</th>
                                                <th data-hide="phone,tablet">Apellido Materno</th>
                                                <th data-hide="phone,tablet">Oficina</th>
                                                <th data-hide="phone,tablet">Cargo</th>
                                                <th data-hide="phone,tablet">Estado</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>


        <div class="col-sm-1">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                data-widget-custombutton="false" data-widget-sortable="false">
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body text-center">
                        <a href="javascript:void(0);" onclick="agregar_docente();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>
                        <a href="javascript:void(0);" onclick="editar_docente();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>
                        <a href="javascript:void(0);" onclick="eliminar_docente();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Relación de Docentes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_areas_docentes"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Orden</th>
                                                <th>Nombres</th>
                                                <th data-hide="phone,tablet">Apellido Paterno</th>
                                                <th data-hide="phone,tablet">Apellido Materno</th>
                                                <th data-hide="phone,tablet">Oficina</th>
                                                <th data-hide="phone,tablet">Cargo</th>
                                                <th data-hide="phone,tablet">Estado</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
        {% endif %}

    </div>
</div>

{{ form('registroareas/savePersonalAreas','method':
'post','id':'form_personal_areas','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info">Imagen Personal (600 x 400 px)</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse"
                data-target="#imagen_personal_areas"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                Imagen</button>
            <div id="imagen_personal_areas" class="collapse">
                <img id="imagen_personal_areas_collapse" class="img-responsive" src=""
                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
            </div>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Orden</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_personal_areas" name="orden" placeholder="Orden" value="">

            </label>
        </section>

        <section class="col col-md-4">

            <label class="text-info">Personal
            </label>
            <label class="select">
                <select id="input-personal" name="personal">
                    <option value=""> Apellido Paterno Apellidos Materno Nombres</option>
                    {% for p in personal_model %}
                    <option value="{{ p.codigo }}">{{ p.apellidop }} {{ p.apellidom }} {{ p.nombres }} </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Email</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-email_personal_areas" name="email" placeholder="Email" value="">

            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Cargo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-cargo_personal_areas" name="cargo" placeholder="Cargo">
                <input type="hidden" id="input-id_personal_area" name="id_personal_area" value="">
                <input type="hidden" id="input-area_personal_areas" name="area" value="{{ codigo }}">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Oficina</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-oficina_personal_areas" name="oficina" placeholder="Oficina" value="">

            </label>
        </section>



        <section class="col col-md-4">
            <label class="text-info">Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_personal_areas" name="fecha_inicio" placeholder="Fecha Inicio"
                    class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Fecha Fin (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_personal_areas" name="fecha_fin" placeholder="Fecha Fin"
                    class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Resolucion</label>
            <select style="width:100%" id="input-id_resolucion" name="id_resolucion">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for resolucion_select in resoluciones %}
                    <option value="{{ resolucion_select.id_resolucion }}">{{
                        resolucion_select.titulo }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_resolucion">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Contrato</label>
            <select style="width:100%" id="input-id_contrato" name="id_contrato">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for contrato_select in contratos %}
                    <option value="{{ contrato_select.id_contrato }}">{{
                        contrato_select.contrato }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_contrato">
            <p>
        </section>

        <section class="col col-md-6">

            <label class="text-info">Agregar Archivo</label>
            <div class="input input-file" id="archivo_personal_areas_modal">

                {#<input type="file" id="archivo_personal" name="archivo_personal">
                <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                <span class="button"><input id="archivo_personal_area" type="file" name="archivo"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                        class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_personal_areas"
                    name="input-file" placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info">Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_personal_areas_modal">

                <label class="input">

                    <span class="button"><input id="imagen_personal_area" type="file" name="imagen"
                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                            class="fa fa-search"></i> Buscar</span><input type="text" id="input-image_personal_areas"
                        name="input-file" placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

        <section class="col col-md-6">
            <label class="text-info">Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_personal_areas" name="enlace" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-2">
            <label class="text-info">Principal</label>
            <label class="checkbox">
                <input type="checkbox" name="es_principal" value="" id="input-es_principal_personal_areas">
                <i></i>&nbsp;</label>
        </section>

        <section class="col col-md-2">
            <label class="text-info">Encargatura</label>
            <label class="checkbox">
                <input type="checkbox" name="encargatura" value="" id="input-encargatura_personal_areas">
                <i></i>&nbsp;</label>
        </section>

        <section class="col col-md-2">
            <label class="text-info">Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado_personal_areas">
                <i></i>&nbsp;</label>
        </section>

    </div>
</fieldset>
{{ endForm() }}


{{ form('registroareas/saveDocentesAreas','method':
'post','id':'form_docentes_areas','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info">Imagen Personal (600 x 400 px)</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse"
                data-target="#imagen_docentes_areas"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                Imagen</button>
            <div id="imagen_docentes_areas" class="collapse">
                <img id="imagen_docentes_areas_collapse" class="img-responsive" src=""
                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
            </div>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Orden</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_docentes_areas" name="orden" placeholder="Orden" value="">

            </label>
        </section>

        <section class="col col-md-4">

            <label class="text-info">docentes
            </label>
            <label class="select">
                <select id="input-docentes" name="docentes">
                    <option value="">Apellido Paterno Apellidos Materno Nombres</option>
                    {% for docentes_select in docentes %}
                    <option value="{{ docentes_select.codigo }}">{{ docentes_select.apellidop }} {{
                        docentes_select.apellidom }} {{ docentes_select.nombres }} </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Email</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-email_docentes_areas" name="email" placeholder="Email" value="">

            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Cargo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-cargo_docentes_areas" name="cargo" placeholder="Cargo">
                <input type="hidden" id="input-id_personal_area_docentes_areas" name="id_personal_area" value="">
                <input type="hidden" id="input-area_docentes_areas" name="area" value="{{ codigo }}">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Oficina</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-oficina_docentes_areas" name="oficina" placeholder="Oficina" value="">

            </label>
        </section>



        <section class="col col-md-4">
            <label class="text-info">Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_docentes_areas" name="fecha_inicio" placeholder="Fecha Inicio"
                    class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Fecha Fin (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_docentes_areas" name="fecha_fin" placeholder="Fecha Fin"
                    class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Resolucion</label>
            <select style="width:100%" id="input-id_resolucion" name="id_resolucion">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for resolucion_select in resoluciones %}
                    <option value="{{ resolucion_select.id_resolucion }}">{{
                        resolucion_select.titulo }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_resolucion">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Contrato</label>
            <select style="width:100%" id="input-id_contrato" name="id_contrato">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for contrato_select in contratos %}
                    <option value="{{ contrato_select.id_contrato }}">{{
                        contrato_select.contrato }}</option>
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_contrato">
            <p>
        </section>


        <section class="col col-md-6">

            <label class="text-info">Agregar Archivo</label>
            <div class="input input-file" id="archivo_docentes_areas_modal">

                {#<input type="file" id="archivo_docentes" name="archivo_docentes">
                <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                <span class="button"><input id="archivo_docentes_area" type="file" name="archivo"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                        class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_docentes_areas"
                    name="input-file" placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info">Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_docentes_areas_modal">

                <label class="input">

                    <span class="button"><input id="imagen_docentes_area" type="file" name="imagen"
                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                            class="fa fa-search"></i> Buscar</span><input type="text" id="input-image_docentes_areas"
                        name="input-file" placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

        <section class="col col-md-6">
            <label class="text-info">Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_docentes_areas" name="enlace" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-2">
            <label class="text-info">Principal</label>
            <label class="checkbox">
                <input type="checkbox" name="es_principal" value="" id="input-es_principal_docentes_areas">
                <i></i>&nbsp;</label>
        </section>

        <section class="col col-md-2">
            <label class="text-info">Encargatura</label>
            <label class="checkbox">
                <input type="checkbox" name="encargatura" value="" id="input-encargatura_docentes_areas">
                <i></i>&nbsp;</label>
        </section>

        <section class="col col-md-2">
            <label class="text-info">Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado_docentes_areas">
                <i></i>&nbsp;</label>
        </section>

    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="exito_areas">
        <p>
            Se grabo Área correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_area_registrada">
        <p>
            Área ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de Área...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de Área...

        </p>
    </div>
</div>
<!-- Modal Registro Imagen -->
<div class="modal fade" id="modal_registro_imagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Imagen</h4>
            </div>
            <div class="modal-body">
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/areas/'~imagen) }}"
                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                {#<button type="button" class="btn btn-primary">
                    Post Article
                </button>#}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var idl = "";
    var publica = "si";

    {% if id is defined %}
    idl = {{ id }};
    {% endif %}



        //alert("Hola");
</script>
<script type="text/javascript">
    var codigo = {{ codigo }};
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>