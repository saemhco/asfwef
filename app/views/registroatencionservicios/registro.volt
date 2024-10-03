{% set codigo = "" %}
{% if paciente.codigo is defined %}
{% set codigo = paciente.codigo %}
{% endif %}

{% set apellidop = "" %}
{% if paciente.apellidop is defined %}
{% set apellidop = paciente.apellidop %}
{% endif %}

{% set apellidom = "" %}
{% if paciente.apellidom is defined %}
{% set apellidom = paciente.apellidom %}
{% endif %}

{% set nombres = "" %}
{% if paciente.nombres is defined %}
{% set nombres = paciente.nombres %}
{% endif %}

{% set fecha_nacimiento = "" %}
{% if paciente.fecha_nacimiento is defined %}
{% set fecha_nacimiento = utilidades.fechita(paciente.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% set sexo_paciente = "" %}
{% if paciente.sexo is defined %}
{% set sexo_paciente = paciente.sexo %}
{% endif %}

{% set direccion = "" %}
{% if paciente.direccion is defined %}
{% set direccion = paciente.direccion %}
{% endif %}

{% set ciudad = "" %}
{% if paciente.ciudad is defined %}
{% set ciudad = paciente.ciudad %}
{% endif %}

{% set celular = "" %}
{% if paciente.celular is defined %}
{% set celular = paciente.celular %}
{% endif %}

{% set telefono = "" %}
{% if paciente.telefono is defined %}
{% set telefono = paciente.telefono %}
{% endif %}


{% set email = "" %}
{% if paciente.email is defined %}
{% set email = paciente.email %}
{% endif %}

{% set email1 = "" %}
{% if paciente.email1 is defined %}
{% set email1 = paciente.email1 %}
{% endif %}

{% set seguro_paciente = "" %}
{% if paciente.seguro is defined %}
{% set seguro_paciente = paciente.seguro %}
{% endif %}

{% set documento_paciente = "" %}
{% if paciente.documento is defined %}
{% set documento_paciente = paciente.documento %}
{% endif %}

{% set foto = "" %}
{% if paciente.foto is defined %}
{% set foto = paciente.foto %}
{% endif %}





{% set id_atencion = "" %}
{% if atenciones.id_atencion is defined %}
{% set id_atencion = atenciones.id_atencion %}
{% endif %}

{% set nro_doc = "" %}
{% if atenciones.nro_doc is defined %}
{% set nro_doc = atenciones.nro_doc %}
{% endif %}

{% set fecha_atencion = "" %}
{% if atenciones.fecha_atencion is defined %}
{% set fecha_atencion = utilidades.fechita(atenciones.fecha_atencion,'d/m/Y') %}
{% endif %}

{% set edad = "" %}
{% if atenciones.edad is defined %}
{% set edad = atenciones.edad %}
{% endif %}

{% set motivo = "" %}
{% if atenciones.motivo is defined %}
{% set motivo = atenciones.motivo %}
{% endif %}

{% set tiempo = "" %}
{% if atenciones.tiempo is defined %}
{% set tiempo = atenciones.tiempo %}
{% endif %}

{% set id_apetito = "" %}
{% if atenciones.id_apetito is defined %}
{% set id_apetito = atenciones.id_apetito %}
{% endif %}

{% set id_sed = "" %}
{% if atenciones.id_sed is defined %}
{% set id_sed = atenciones.id_sed %}
{% endif %}

{% set id_animo = "" %}
{% if atenciones.id_animo is defined %}
{% set id_animo = atenciones.id_animo %}
{% endif %}

{% set id_orina = "" %}
{% if atenciones.id_orina is defined %}
{% set id_orina = atenciones.id_orina %}
{% endif %}

{% set id_deposicion = "" %}
{% if atenciones.id_deposicion is defined %}
{% set id_deposicion = atenciones.id_deposicion %}
{% endif %}

{% set eva = "" %}
{% if atenciones.eva is defined %}
{% set eva = atenciones.eva %}
{% endif %}


{% set referencia = "" %}
{% if atenciones.referencia is defined %}
{% set referencia = atenciones.referencia %}
{% endif %}

{% set lugar = "" %}
{% if atenciones.lugar is defined %}
{% set lugar = atenciones.lugar %}
{% endif %}

{% set observaciones = "" %}
{% if atenciones.observaciones is defined %}
{% set observaciones = atenciones.observaciones %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if atenciones.estado is defined %}
{% set estado = atenciones.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Atencion</li>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro de Atencion</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registroatencionservicios/save','method':
                                    'post','id':'form_atenciones','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <header style="margin-top: -10px;">
                                        Informacion
                                        General
                                    </header>
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info">Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder=""
                                                        value="{{ codigo }}" readonly="">

                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info">Imagen del </label>
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-toggle="collapse" data-target="#imagen_paciente"><i
                                                        class="fa fa-hand-o-up"></i> Click Aquí para
                                                    mostrar Imagen</button>

                                                <div id="imagen_paciente" class="collapse">

                                                    {% if foto !== "" %}

                                                    {% if tipo == 1 %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/alumnos/'~foto) }}"
                                                        error="this.onerror=null;this.src='';"></img>
                                                    {% elseif(tipo == 2) %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/docentes/'~foto) }}"
                                                        error="this.onerror=null;this.src='';"></img>
                                                    {% elseif(tipo == 3) %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/personal/'~foto) }}"
                                                        error="this.onerror=null;this.src='';"></img>
                                                    {% endif %}

                                                    {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido
                                                        una imagen.
                                                    </div>

                                                    {% endif %}

                                                </div>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Documento</label>
                                                <label class="select">
                                                    <select id="input-documento" name="documento" disabled>
                                                        <option value="">SELECCIONE...</option>
                                                        {% for documento in documentos
                                                        %}
                                                        {% if documento.codigo ==
                                                        documento_paciente %}
                                                        <option selected="selected" value="{{ documento.codigo }}">{{
                                                            documento.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ documento.codigo }}">{{
                                                            documento.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Número de Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc"
                                                        placeholder="Nro. Documento" value="{{ nro_doc }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Apellido paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidop" name="apellidop"
                                                        placeholder="Apellido paterno" value="{{ apellidop }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Apellido materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidom" name="apellidom"
                                                        placeholder="Apellido materno" value="{{ apellidom }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres"
                                                        placeholder="Nombres" value="{{ nombres }}" readonly>

                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Fecha de Nacimiento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento"
                                                        name="fecha_nacimiento" placeholder="Fecha de Nacimiento"
                                                        class="" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_nacimiento }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Sexo</label>
                                                <label class="select">
                                                    <select id="input-sexo" name="sexo" disabled>
                                                        <option value="">SELECCIONE...</option>
                                                        {% for sexo in sexos %}
                                                        {% if sexo.codigo == sexo_paciente %}
                                                        <option selected="selected" value="{{ sexo.codigo }}">{{
                                                            sexo.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ sexo.codigo }}">{{
                                                            sexo.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro" name="seguro" disabled>
                                                        <option value="">SELECCIONE...</option>
                                                        {% for seguro in seguros %}
                                                        {% if seguro.codigo == seguro_paciente
                                                        %}
                                                        <option selected="selected" value="{{ seguro.codigo }}">{{
                                                            seguro.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ seguro.codigo }}">{{
                                                            seguro.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-8">
                                                <label class="text-info">Dirección</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion" name="direccion"
                                                        placeholder="Dirección" value="{{ direccion }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad"
                                                        placeholder="Ciudad" value="{{ ciudad }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Correo personal</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email" name="email"
                                                        placeholder="Correo personal" value="{{ email }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Correo
                                                    Institucional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email1" name="email1"
                                                        placeholder="Correo" value="{{ email1 }}" readonly>

                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-celular" name="celular"
                                                        placeholder="Celular" value="{{ celular }}" readonly>

                                                </label>
                                            </section>

                                        </div>
                                    </fieldset>

                                    <header style="margin-top: -10px;">
                                        Atencion
                                    </header>
                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-2">
                                                <label class="text-info">Fecha de Atencion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_atencion" name="fecha_atencion"
                                                        placeholder="Fecha de Atencion" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_atencion }}">
                                                    <input type="hidden" id="input-id_atencion" name="id_atencion"
                                                        value="{{ id_atencion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripcion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-descripcion"
                                                        name="descripcion">{{ descripcion }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-observaciones"
                                                        name="observaciones">{{ observaciones }}</textarea>
                                                </label>
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
    {% if estado !== "" %}
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
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

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-11" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Derivacion Servicios</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_derivacion_servicios"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha</th>
                                                <th data-hide="phone,tablet">Servicio</th>
                                                <th data-hide="phone,tablet">Motivo</th>
                                                <th data-hide="phone,tablet">Proceso</th>
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
    </div>

    {% endif %}

</div>
<!--Formulario de registro detalle-->
{{ form('registroatencionservicios/saveDerivacionServicios','method':
'post','id':'form_atencion_servicio','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-6">
            <label class="text-info">Fecha de Derivacion</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-ds-fecha_derivacion" name="fecha_derivacion"
                    placeholder="Fecha de Derivacion" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
                    <input type="hidden" id="input-ds-id_derivacion_servicio" name="id_derivacion_servicio" value="">
                    <input type="hidden" id="input-ds-id_atencion" name="id_atencion" value="{{ id_atencion }}">
            </label>
        </section>


        <section class="col col-md-6">
            <label class="text-info">Fecha de Atencion</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-ds-fecha_atencion" name="fecha_atencion"
                    placeholder="Fecha de Atencion" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Personal</label>
            <select style="width:100%" id="input-ds-id_personal" name="id_personal">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for personal_select in personal %}

                    <option value="{{ personal_select.codigo }}">
                        {{ personal_select.apellidop }} {{ personal_select.apellidom }} {{ personal_select.nombres }}
                    </option>

                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_personal">
            <p>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Servicios</label>
            <label class="select">
                <select id="input-ds-id_servicio" name="id_servicio">
                    <option value="">Seleccione</option>
                    {% for servicio_select in servicios %}

                    <option value="{{ servicio_select.id_servicio }}">
                       {{servicio_select.titular }}
                    </option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Procesos</label>
            <label class="select">
                <select id="input-ds-proceso" name="proceso">
                    <option value="">Seleccione</option>
                    {% for proceso_select in procesos %}

                    <option value="{{ proceso_select.codigo }}">
                       {{proceso_select.nombres }}
                    </option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Motivo</label>
            <label class="select">
                <select id="input-ds-id_motivo_dbu" name="id_motivo_dbu">
                    <option value="">Seleccione</option>
                    {% for motivo in motivos %}
                    <option value="{{ motivo.codigo }}">{{ motivo.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Descripcion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-ds-descripcion" name="descripcion"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

<div class="hidden">
    <div id="success">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript">
    var publica = "si";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>
<script type="text/javascript"> var id_atencion = "{{ id_atencion }}";</script>