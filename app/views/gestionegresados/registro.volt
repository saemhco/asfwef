{% set codigo = "" %}
{% set txt_buton = "Registrar" %}
{% if alumnos.codigo is defined %}
{% set codigo = alumnos.codigo %}
{% set txt_buton = "Actualizar" %}
{% endif %}

{% set tipo_alumnos = "" %}
{% if alumnos.tipo is defined %}
{% set tipo_alumnos = alumnos.tipo %}
{% endif %}

{% set semestre_alumnos = "" %}
{% if alumnos.semestre is defined %}
{% set semestre_alumnos = alumnos.semestre %}
{% endif %}

{% set semestre_egreso = "" %}
{% if alumnos.semestre_egreso is defined %}
{% set semestre_egreso = alumnos.semestre_egreso %}
{% endif %}

{% set programa_alumnos = "" %}
{% if alumnos.carrera is defined %}
{% set programa_alumnos = alumnos.carrera %}
{% endif %}

{% set apellidop = "" %}
{% if alumnos.apellidop is defined %}
{% set apellidop = alumnos.apellidop %}
{% endif %}

{% set apellidom = "" %}
{% if alumnos.apellidom is defined %}
{% set apellidom = alumnos.apellidom %}
{% endif %}

{% set nombres = "" %}
{% if alumnos.nombres is defined %}
{% set nombres = alumnos.nombres %}
{% endif %}

{% set sexo_alumnos = "" %}
{% if alumnos.sexo is defined %}
{% set sexo_alumnos = alumnos.sexo %}
{% endif %}

{% set cv = "" %}
{% if alumnos.cv is defined %}
{% set cv = alumnos.cv %}
{% endif %}

{% set region = "" %}
{% if alumnos.region is defined %}
{% set region = alumnos.region %}
{% endif %}

{% set provincia = "" %}
{% if alumnos.provincia is defined %}
{% set provincia = alumnos.provincia %}
{% endif %}

{% set distrito = "" %}
{% if alumnos.distrito is defined %}
{% set distrito = alumnos.distrito %}
{% endif %}

{% set ubigeo = "" %}
{% if alumnos.ubigeo is defined %}
{% set ubigeo = alumnos.ubigeo %}
{% endif %}

{% set fecha_nacimiento = "" %}
{% if alumnos.fecha_nacimiento is defined %}
{% set fecha_nacimiento = utilidades.fechita(alumnos.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% set documento_alumnos = "" %}
{% if alumnos.documento is defined %}
{% set documento_alumnos = alumnos.documento %}
{% endif %}

{% set nro_doc = "" %}
{% if alumnos.nro_doc is defined %}
{% set nro_doc = alumnos.nro_doc %}
{% endif %}

{% set fecha_ingreso = "" %}
{% if alumnos.fecha_ingreso is defined %}
{% set fecha_ingreso = utilidades.fechita(alumnos.fecha_ingreso,'d/m/Y') %}
{% endif %}

{% set seguro_alumnos = "" %}
{% if alumnos.seguro is defined %}
{% set seguro_alumnos = alumnos.seguro %}
{% endif %}

{% set telefono = "" %}
{% if alumnos.telefono is defined %}
{% set telefono = alumnos.telefono %}
{% endif %}

{% set celular = "" %}
{% if alumnos.celular is defined %}
{% set celular = alumnos.celular %}
{% endif %}

{% set email = "" %}
{% if alumnos.email is defined %}
{% set email = alumnos.email %}
{% endif %}

{% set email1 = "" %}
{% if alumnos.email1 is defined %}
{% set email1 = alumnos.email1 %}
{% endif %}

{% set direccion = "" %}
{% if alumnos.direccion is defined %}
{% set direccion = alumnos.direccion %}
{% endif %}

{% set ciudad = "" %}
{% if alumnos.ciudad is defined %}
{% set ciudad = alumnos.ciudad %}
{% endif %}

{% set observaciones = "" %}
{% if alumnos.observaciones is defined %}
{% set observaciones = alumnos.observaciones %}
{% endif %}

{% set foto = "" %}
{% if alumnos.foto is defined %}
{% set foto = alumnos.foto %}
{% endif %}

{% set traslado = "" %}
{% if alumnos.traslado is defined %}
{% set traslado = alumnos.traslado %}
{% endif %}

{% set certificado_u = "" %}
{% if alumnos.certificado_u is defined %}
{% set certificado_u = alumnos.certificado_u %}
{% endif %}

{% set constancia_i = "" %}
{% if alumnos.constancia_i is defined %}
{% set constancia_i = alumnos.constancia_i %}
{% endif %}

{% set certificado_c = "" %}
{% if alumnos.certificado_c is defined %}
{% set certificado_c = alumnos.certificado_c %}
{% endif %}

{% set dni_c = "" %}
{% if alumnos.dni_c is defined %}
{% set dni_c = alumnos.dni_c %}
{% endif %}

{% set partida_n = "" %}
{% if alumnos.partida_n is defined %}
{% set partida_n = alumnos.partida_n %}
{% endif %}

{% set colegio_publico = "" %}
{% if alumnos.colegio_publico is defined %}
{% set colegio_publico = alumnos.colegio_publico %}
{% endif %}

{% set colegio_nombre = "" %}
{% if alumnos.colegio_nombre is defined %}
{% set colegio_nombre = alumnos.colegio_nombre %}
{% endif %}

{% set colegio_anio = "" %}
{% if alumnos.colegio_anio is defined %}
{% set colegio_anio = alumnos.colegio_anio %}
{% endif %}

{% set sitrabaja = "" %}
{% if alumnos.sitrabaja is defined %}
{% set sitrabaja = alumnos.sitrabaja %}
{% endif %}

{% set sitrabaja_nombre = "" %}
{% if alumnos.sitrabaja_nombre is defined %}
{% set sitrabaja_nombre = alumnos.sitrabaja_nombre %}
{% endif %}

{% set sidepende = "" %}
{% if alumnos.sidepende is defined %}
{% set sidepende = alumnos.sidepende %}
{% endif %}

{% set sidepende_nombre = "" %}
{% if alumnos.sidepende_nombre is defined %}
{% set sidepende_nombre = alumnos.sidepende_nombre %}
{% endif %}

{% set graduado = "" %}
{% if alumnos.graduado is defined %}
{% set graduado = alumnos.graduado %}
{% endif %}

{% set titulado = "" %}
{% if alumnos.titulado is defined %}
{% set titulado = alumnos.titulado %}
{% endif %}

{% set discapacitado = "" %}
{% if alumnos.discapacitado is defined %}
{% set discapacitado = alumnos.discapacitado %}
{% endif %}

{% set envio = "" %}
{% if alumnos.envio is defined %}
{% set envio = alumnos.envio %}
{% endif %}

{% set activo = "" %}
{% if alumnos.activo is defined %}
{% set activo = alumnos.activo %}
{% endif %}

{% set discapacitado_nombre = "" %}
{% if alumnos.discapacitado_nombre is defined %}
{% set discapacitado_nombre = alumnos.discapacitado_nombre %}
{% endif %}

{% set region1 = "" %}
{% if alumnos.region1 is defined %}
{% set region1 = alumnos.region1 %}
{% endif %}

{% set provincia1 = "" %}
{% if alumnos.provincia1 is defined %}
{% set provincia1 = alumnos.provincia1 %}
{% endif %}

{% set distrito1 = "" %}
{% if alumnos.distrito1 is defined %}
{% set distrito1 = alumnos.distrito1 %}
{% endif %}

{% set localidad = "" %}
{% if alumnos.localidad is defined %}
{% set localidad = alumnos.localidad %}
{% endif %}

{% set idioma_alumnos = "" %}
{% if alumnos.idioma is defined %}
{% set idioma_alumnos = alumnos.idioma %}
{% endif %}

{% set nro_seguro = "" %}
{% if alumnos.nro_seguro is defined %}
{% set nro_seguro = alumnos.nro_seguro %}
{% endif %}

{% set archivo = "" %}
{% if alumnos.archivo is defined %}
{% set archivo = alumnos.archivo %}
{% endif %}

{% set ubigeo1 = "" %}
{% if alumnos.ubigeo1 is defined %}
{% set ubigeo1 = alumnos.ubigeo1 %}
{% endif %}

{% set identidad_etnica = "" %}
{% if alumnos.identidad_etnica is defined %}
{% set identidad_etnica = alumnos.identidad_etnica %}
{% endif %}

{% set tipo_discapacidad = "" %}
{% if alumnos.tipo_discapacidad is defined %}
{% set tipo_discapacidad = alumnos.tipo_discapacidad %}
{% endif %}

{% set fecha_egreso = "" %}
{% if alumnos.fecha_egreso is defined %}
{% set fecha_egreso = utilidades.fechita(alumnos.fecha_egreso,'d/m/Y') %}
{% endif %}

{% set modalidad_ingreso = "" %}
{% if alumnos.modalidad_ingreso is defined %}
{% set modalidad_ingreso = alumnos.modalidad_ingreso %}
{% endif %}

{% set violencia_sociopolitica = "" %}
{% if alumnos.violencia_sociopolitica is defined %}
{% set violencia_sociopolitica = alumnos.violencia_sociopolitica %}
{% endif %}

{% set violencia_sociopolitica_registro = "" %}
{% if alumnos.violencia_sociopolitica_registro is defined %}
{% set violencia_sociopolitica_registro = alumnos.violencia_sociopolitica_registro %}
{% endif %}

{% set estado_civil = "" %}
{% if alumnos.estado_civil is defined %}
{% set estado_civil = alumnos.estado_civil %}
{% endif %}
<!---------------------tabla : alumnos_ficha----------------------------------->
{% set modalidad_estudios = "" %}
{% if alumnos_ficha.modalidad_estudios is defined %}
{% set modalidad_estudios = alumnos_ficha.modalidad_estudios %}
{% endif %}

{% set local = "" %}
{% if alumnos_ficha.local is defined %}
{% set local = alumnos_ficha.local %}
{% endif %}

{% set descripcion_lugar_origen = "" %}
{% if alumnos_ficha.descripcion_lugar_origen is defined %}
{% set descripcion_lugar_origen = alumnos_ficha.descripcion_lugar_origen %}
{% endif %}

{% set descripcion_lugar_actual = "" %}
{% if alumnos_ficha.descripcion_lugar_actual is defined %}
{% set descripcion_lugar_actual = alumnos_ficha.descripcion_lugar_actual %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registro Egresado</li>
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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Egresado</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('gestionegresados/save','method':
                                    'post','id':'form_alumnos','class':'smart-form','enctype':'multipart/form-data') }}



                                    <div class="row">
                                        <div class="col col-md-12">
                                            <!-- widget content -->
                                            <div class="widget-body">
                                                <ul id="myTab1" class="nav nav-tabs bordered">
                                                    <li class="active">
                                                        <a href="#s1" data-toggle="tab"><i
                                                                class="fa fa-fw fa-lg fa-edit"></i>Informacion del
                                                            Egresado</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s2" data-toggle="tab"><i
                                                                class="fa fa-fw fa-lg fa-edit"></i> Información
                                                            Académica</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s3" data-toggle="tab"><i
                                                                class="fa fa-fw fa-lg fa-edit"></i>Procedencia</a>
                                                    </li>



                                                </ul>

                                                <div id="myTabContent1" class="tab-content">
                                                    <div class="tab-pane  active" id="s1">
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Código de Egresado</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-codigo"
                                                                            name="codigo" placeholder="{{ codigo }}"
                                                                            value="{{ codigo }}" readonly="">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Tipo</label>
                                                                    <label class="select">
                                                                        <select id="input-tipo" name="tipo" disabled>
                                                                            <option value="">Seleccione...</option>
                                                                            {% for tipoalumno in tipoalumnos %}
                                                                            {% if tipoalumno.codigo == tipo_alumnos %}
                                                                            <option selected="selected"
                                                                                value="{{ tipoalumno.codigo }}">{{
                                                                                tipoalumno.nombres }}</option>
                                                                            {% else %}
                                                                            <option value="{{ tipoalumno.codigo }}">{{
                                                                                tipoalumno.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info">Modalidad Ingreso
                                                                    </label>
                                                                    <label class="select">
                                                                        <select id="input_modalidad_ingreso"
                                                                            name="modalidad_ingreso">
                                                                            <option value="">SELECCIONE...</option>
                                                                            {% for modalidad_select in modalidad %}
                                                                            {% if modalidad_select.codigo ==
                                                                            modalidad_ingreso %}
                                                                            <option selected="selected"
                                                                                value="{{ modalidad_select.codigo }}">{{
                                                                                modalidad_select.nombres }}</option>
                                                                            {% else %}
                                                                            <option
                                                                                value="{{ modalidad_select.codigo }}">{{
                                                                                modalidad_select.nombres }}</option>
                                                                            {% endif %}
                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Imagen del Alumnos</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-block"
                                                                        data-toggle="collapse"
                                                                        data-target="#imagen_alumno"><i
                                                                            class="fa fa-hand-o-up"></i> Click Aquí para
                                                                        mostrar Imagen</button>

                                                                    <div id="imagen_alumno" class="collapse">

                                                                        {% if foto !== "" %}
                                                                        <img class="img-responsive"
                                                                            src="{{ url('adminpanel/imagenes/alumnos/'~foto) }}"
                                                                            error="this.onerror=null;this.src='';"></img>
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
                                                                        <select id="input-documento" name="documento">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for documentoalumno in documentoalumnos
                                                                            %}
                                                                            {% if documentoalumno.codigo ==
                                                                            documento_alumnos %}
                                                                            <option selected="selected"
                                                                                value="{{ documentoalumno.codigo }}">{{
                                                                                documentoalumno.nombres }}</option>
                                                                            {% else %}
                                                                            <option
                                                                                value="{{ documentoalumno.codigo }}">{{
                                                                                documentoalumno.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Número de Documento</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-nro_doc"
                                                                            name="nro_doc" placeholder="Nro. Documento"
                                                                            value="{{ nro_doc }}">

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Apellido paterno</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-apellidop"
                                                                            name="apellidop"
                                                                            placeholder="Apellido paterno"
                                                                            value="{{ apellidop }}">

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Apellido materno</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-apellidom"
                                                                            name="apellidom"
                                                                            placeholder="Apellido materno"
                                                                            value="{{ apellidom }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Nombres</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-nombres"
                                                                            name="nombres" placeholder="Nombres"
                                                                            value="{{ nombres }}">

                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Fecha de Nacimiento
                                                                        (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_nacimiento"
                                                                            name="fecha_nacimiento"
                                                                            placeholder="Fecha de Nacimiento"
                                                                            class="datepicker"
                                                                            data-dateformat='dd/mm/yy'
                                                                            value="{{ fecha_nacimiento }}">
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Sexo</label>
                                                                    <label class="select">
                                                                        <select id="input-sexo" name="sexo">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for sexoalumno in sexoalumnos %}
                                                                            {% if sexoalumno.codigo == sexo_alumnos %}
                                                                            <option selected="selected"
                                                                                value="{{ sexoalumno.codigo }}">{{
                                                                                sexoalumno.nombres }}</option>
                                                                            {% else %}
                                                                            <option value="{{ sexoalumno.codigo }}">{{
                                                                                sexoalumno.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Idioma</label>
                                                                    <label class="select">
                                                                        <select id="input-idioma" name="idioma">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for ia in idiomaalumnos %}
                                                                            {% if ia.codigo == idioma_alumnos %}
                                                                            <option selected="selected"
                                                                                value="{{ ia.codigo }}">{{ ia.nombres }}
                                                                            </option>
                                                                            {% else %}
                                                                            <option value="{{ ia.codigo }}">{{
                                                                                ia.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-8">
                                                                    <label class="text-info">Dirección</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-direccion"
                                                                            name="direccion" placeholder="Dirección"
                                                                            value="{{ direccion }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Ciudad</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-ciudad"
                                                                            name="ciudad" placeholder="Ciudad"
                                                                            value="{{ ciudad }}">

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Correo personal</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-at"></i>
                                                                        <input type="text" id="input-email" name="email"
                                                                            placeholder="Correo personal"
                                                                            value="{{ email }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Correo
                                                                        Institucional</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-at"></i>
                                                                        <input type="text" id="input-email1"
                                                                            name="email1" placeholder="Correo UNAAA"
                                                                            value="{{ email1 }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Seguro</label>
                                                                    <label class="select">
                                                                        <select id="input-seguro" name="seguro">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for seguroalumno in seguroalumnos %}
                                                                            {% if seguroalumno.codigo == seguro_alumnos
                                                                            %}
                                                                            <option selected="selected"
                                                                                value="{{ seguroalumno.codigo }}">{{
                                                                                seguroalumno.nombres }}</option>
                                                                            {% else %}
                                                                            <option value="{{ seguroalumno.codigo }}">{{
                                                                                seguroalumno.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>



                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Teléfono</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-telefono"
                                                                            name="telefono" placeholder="Teléfono"
                                                                            value="{{ telefono }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Celular</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-celular"
                                                                            name="celular" placeholder="Celular"
                                                                            value="{{ celular }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Estado Civil</label>
                                                                    <label class="select">
                                                                        <select id="input-estado_civil"
                                                                            name="estado_civil">
                                                                            <option value="">SELECCIONE...</option>
                                                                            {% for i_e in estadocivil %}
                                                                            {% if i_e.codigo == estado_civil %}
                                                                            <option selected="selected"
                                                                                value="{{i_e.codigo }}">{{ i_e.nombres
                                                                                }}</option>
                                                                            {% else %}
                                                                            <option value="{{ i_e.codigo }}">{{
                                                                                i_e.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-3">

                                                                    <label class="checkbox">

                                                                        {% if discapacitado == 1 %}
                                                                        <input type="checkbox" name="discapacitado"
                                                                            value="{{ discapacitado }}"
                                                                            id="discapacitado" checked>
                                                                        {% else %}
                                                                        <input type="checkbox" name="discapacitado"
                                                                            value="{{ discapacitado }}"
                                                                            id="discapacitado">
                                                                        {% endif %}

                                                                        <i></i>Discapacitado - Nombre discapacidad

                                                                    </label>

                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text"
                                                                            id="input-discapacitado_nombre"
                                                                            name="discapacitado_nombre"
                                                                            placeholder="Nombre Discapacidad"
                                                                            value="{{ discapacitado_nombre }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info"
                                                                        style="margin-bottom: 10px;">Tipo de
                                                                        Discapacidad</label>
                                                                    <label class="select">
                                                                        <select id="input-tipo_discapacidad"
                                                                            name="tipo_discapacidad">
                                                                            <option value="">SELECCIONE...</option>
                                                                            {% for i_e in tipodiscapacidad %}
                                                                            {% if i_e.codigo == tipo_discapacidad %}
                                                                            <option selected="selected"
                                                                                value="{{i_e.codigo }}">{{ i_e.nombres
                                                                                }}</option>
                                                                            {% else %}
                                                                            <option value="{{ i_e.codigo }}">{{
                                                                                i_e.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">

                                                                    <label class="checkbox">

                                                                        {% if violencia_sociopolitica == 1 %}
                                                                        <input type="checkbox"
                                                                            name="violencia_sociopolitica"
                                                                            value="{{ violencia_sociopolitica }}"
                                                                            id="violencia_sociopolitica" checked>
                                                                        {% else %}
                                                                        <input type="checkbox"
                                                                            name="violencia_sociopolitica"
                                                                            value="{{ violencia_sociopolitica }}"
                                                                            id="violencia_sociopolitica">
                                                                        {% endif %}

                                                                        <i></i>Violencia Sociopolitica - Registro

                                                                    </label>

                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text"
                                                                            id="input-violencia_sociopolitica_registro"
                                                                            name="violencia_sociopolitica_registro"
                                                                            placeholder="Registro Violencia Sociopolitica"
                                                                            value="{{ violencia_sociopolitica_registro }}">

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info"
                                                                        style="margin-bottom: 10px;">Identidad
                                                                        Étnica</label>
                                                                    <label class="select">
                                                                        <select id="input_identidad_etnica"
                                                                            name="identidad_etnica">
                                                                            <option value="">SELECCIONE...</option>
                                                                            {% for i_e in identidadetnica %}
                                                                            {% if i_e.codigo == identidad_etnica %}
                                                                            <option selected="selected"
                                                                                value="{{i_e.codigo }}">{{ i_e.nombres
                                                                                }}</option>
                                                                            {% else %}
                                                                            <option value="{{ i_e.codigo }}">{{
                                                                                i_e.nombres }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-6" style="float: right;">

                                                                    <label class="text-info">Agregar Archivo</label>
                                                                    <div class="input input-file">

                                                                        {#<input type="file" id="archivo_personal"
                                                                            name="archivo_personal">
                                                                        <input type="hidden" id="input-archivo"
                                                                            name="archivo" value="{{ archivo }}">#}

                                                                        <span class="button"><input id="archivo"
                                                                                type="file" name="archivo"
                                                                                onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                                class="fa fa-search"></i>
                                                                            Buscar</span><input type="text"
                                                                            id="input-file" name="input-file"
                                                                            placeholder="Agregar Archivo" readonly="">

                                                                    </div>

                                                                    {% if archivo !== "" %}

                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/alumnos/'~archivo) }}">
                                                                            <i class="fa-fw fa fa-book"></i></a>
                                                                    </div>


                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-6" style="float: right;">

                                                                    <label class="text-info">Agregar Imagen (600 x 400
                                                                        px)</label>
                                                                    <div class="input input-file">

                                                                        {#<input type="file" id="archivo_personal"
                                                                            name="archivo_personal">
                                                                        <input type="hidden" id="input-archivo"
                                                                            name="archivo" value="{{ archivo }}">#}

                                                                        <label class="input">

                                                                            <span class="button"><input id="imagen"
                                                                                    type="file" name="imagen"
                                                                                    onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                                    class="fa fa-search"></i>
                                                                                Buscar</span><input type="text"
                                                                                id="input-image" name="input-file"
                                                                                placeholder="Agregar Imagen"
                                                                                readonly="">

                                                                        </label>
                                                                    </div>

                                                                    {% if foto !== "" %}

                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver la imagen
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-ribbon" role="button"
                                                                            onclick="imagen_registro();"> <i
                                                                                class="fa-fw fa fa-image"></i></a>
                                                                    </div>


                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido una
                                                                        imagen.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-6">

                                                                    <label class="text-info">Agregar CV</label>
                                                                    <div class="input input-file">

                                                                        {#<input type="file" id="archivo_personal"
                                                                            name="archivo_personal">
                                                                        <input type="hidden" id="input-archivo"
                                                                            name="archivo" value="{{ archivo }}">#}

                                                                        <span class="button"><input id="cv" type="file"
                                                                                name="cv"
                                                                                onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                                class="fa fa-search"></i>
                                                                            Buscar</span><input type="text"
                                                                            id="input-file_cv" name="input-file"
                                                                            placeholder="Agregar CV" readonly="">

                                                                    </div>

                                                                    {% if cv !== "" %}

                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/cv/'~cv) }}">
                                                                            <i class="fa-fw fa fa-book"></i></a>
                                                                    </div>


                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info"></label>
                                                                    <label class="checkbox">

                                                                        {% if envio == 1 %}
                                                                        <input type="checkbox" name="envio"
                                                                            value="{{ envio }}" id="envio" checked>
                                                                        {% else %}
                                                                        <input type="checkbox" name="envio"
                                                                            value="{{ envio }}" id="envio">
                                                                        {% endif %}

                                                                        <i></i>Envio e-mail</label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info"></label>
                                                                    <label class="checkbox">

                                                                        {% if activo == 1 %}
                                                                        <input type="checkbox" name="activo"
                                                                            value="{{ activo }}" id="activo" checked>
                                                                        {% else %}
                                                                        <input type="checkbox" name="activo"
                                                                            value="{{ activo }}" id="activo">
                                                                        {% endif %}

                                                                        <i></i>Activo</label>
                                                                </section>

                                                            </div>
                                                        </fieldset>
                                                    </div>


                                                    <div class="tab-pane fade" id="s2">
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-6">
                                                                    <label class="text-info">Programa de
                                                                        estudios</label>
                                                                    <label class="select">
                                                                        <select id="input-carrera" name="carrera" style="pointer-events:none;">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for programa in programas %}
                                                                            {% if programa.codigo == programa_alumnos %}
                                                                            <option selected="selected"
                                                                                value="{{ programa.codigo }}">{{
                                                                                programa.descripcion }}</option>
                                                                            {% else %}
                                                                            <option value="{{ programa.codigo }}">{{
                                                                                programa.descripcion }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info"></label>
                                                                    <label class="checkbox">
                                                                        {% if graduado == 1 %}
                                                                        <input type="checkbox" name="graduado"
                                                                            value="{{ graduado }}" id="input-graduado"
                                                                            checked disabled>
                                                                        {% else %}
                                                                        <input type="checkbox" name="graduado"
                                                                            value="{{ graduado }}" id="input-graduado" disabled>
                                                                        {% endif %}
                                                                        <i></i>Graduado</label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info"></label>
                                                                    <label class="checkbox">
                                                                        {% if titulado == 1 %}
                                                                        <input type="checkbox" name="titulado"
                                                                            value="{{ titulado }}" id="input-titulado"
                                                                            checked disabled>
                                                                        {% else %}
                                                                        <input type="checkbox" name="titulado"
                                                                            value="{{ titulado }}" id="input-titulado" disabled>
                                                                        {% endif %}
                                                                        <i></i>Titulado</label>
                                                                </section>

                                                            </div>

                                                            <div class="row">

                                                                <section class="col col-md-3">

                                                                    <label class="text-info">Semestre de Ingreso</label>
                                                                    <label class="select">
                                                                        <select id="input-semestre" name="semestre" style="pointer-events:none;">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for semestre in semestres %}
                                                                            {% if semestre.codigo == semestre_alumnos %}
                                                                            <option selected="selected"
                                                                                value="{{ semestre.codigo }}">{{
                                                                                semestre.descripcion }}</option>
                                                                            {% else %}
                                                                            <option value="{{ semestre.codigo }}">{{
                                                                                semestre.descripcion }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Fecha de Ingreso
                                                                        (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_ingreso"
                                                                            name="fecha_ingreso"
                                                                            placeholder="Fecha de Ingreso"
                                                                            class="datepicker"
                                                                            data-dateformat='dd/mm/yy'
                                                                            value="{{ fecha_ingreso }}" readonly>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">

                                                                    <label class="text-info">Semestre de Egreso</label>
                                                                    <label class="select">
                                                                        <select id="input-semestre_egreso"
                                                                            name="semestre_egreso" style="pointer-events:none;">
                                                                            <option value="">Seleccione...</option>
                                                                            {% for semestre in semestres %}
                                                                            {% if semestre.codigo == semestre_egreso %}
                                                                            <option selected="selected"
                                                                                value="{{ semestre.codigo }}">{{
                                                                                semestre.descripcion }}</option>
                                                                            {% else %}
                                                                            <option value="{{ semestre.codigo }}">{{
                                                                                semestre.descripcion }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Fecha de Egreso
                                                                        (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_egreso"
                                                                            name="fecha_egreso"
                                                                            placeholder="Fecha de Egreso"
                                                                            class="datepicker"
                                                                            data-dateformat='dd/mm/yy'
                                                                            value="{{ fecha_egreso }}" readonly>
                                                                    </label>
                                                                </section>

                                                            </div>

                                                            <div class="row">
                                                                <section class="col col-md-12">
                                                                    <label class="text-info">Observaciones</label>
                                                                    <label class="textarea"> <i
                                                                            class="icon-append fa fa-comment"></i>
                                                                        <textarea rows="2" id="input-observaciones"
                                                                            name="observaciones" readonly>{{ observaciones }}</textarea>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info">Partida de
                                                                        nacimiento</label>
                                                                    <div class="input input-file"
                                                                        style="margin-bottom: 5px;">

                                                                        <span class="button"><input type="file"
                                                                                id="partida_nacimiento"
                                                                                name="partida_nacimiento"
                                                                                onchange="this.parentNode.nextSibling.value = this.value" disabled>...</span><input
                                                                            type="text" placeholder="Subir archivo"
                                                                            readonly="">
                                                                        <input type="hidden" id="input-partida_n"
                                                                            name="partida_n" value="{{ partida_n }}">
                                                                    </div>


                                                                    {% if partida_n == 1 %}

                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/partidas_nacimiento/FILE-'~codigo~'.pdf') }}">
                                                                            <i class="fa-fw fa fa-eye"></i></a>
                                                                    </div>

                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info">DNI</label>
                                                                    <div class="input input-file"
                                                                        style="margin-bottom: 5px;">

                                                                        <span class="button"><input type="file"
                                                                                id="dni_alumno" name="dni_alumno"
                                                                                onchange="this.parentNode.nextSibling.value = this.value" disabled>...</span><input
                                                                            type="text" placeholder="Subir archivo"
                                                                        >
                                                                        <input type="hidden" id="input-dni_c"
                                                                            name="dni_c" value="{{ dni_c }}">

                                                                    </div>


                                                                    {% if dni_c == 1 %}

                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/dni/FILE-'~codigo~'.pdf') }}">
                                                                            <i class="fa-fw fa fa-eye"></i></a>
                                                                    </div>

                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}


                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info">Certificado de Estudios
                                                                        Colegio</label>
                                                                    <div class="input input-file"
                                                                        style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file"
                                                                                id="certificado_c_alumno"
                                                                                name="certificado_c_alumno"
                                                                                onchange="this.parentNode.nextSibling.value = this.value">...</span><input
                                                                            type="text" placeholder="Subir archivo"
                                                                            readonly="" disabled>
                                                                        <input type="hidden" id="input-certificado_c"
                                                                            name="certificado_c"
                                                                            value="{{ certificado_c }}">
                                                                    </div>

                                                                    {% if certificado_c == 1 %}
                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/certificados_estudios_colegio/FILE-'~codigo~'.pdf') }}">
                                                                            <i class="fa-fw fa fa-eye"></i></a>
                                                                    </div>

                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>


                                                                <section class="col col-md-4">

                                                                    <label class="text-info">Constancia de
                                                                        ingreso</label>
                                                                    <div class="input input-file"
                                                                        style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file"
                                                                                id="constancia_i_alumno"
                                                                                name="constancia_i_alumno"
                                                                                onchange="this.parentNode.nextSibling.value = this.value">...</span><input
                                                                            type="text" placeholder="Subir archivo"
                                                                            readonly="" disabled>
                                                                        <input type="hidden" id="input-constancia_i"
                                                                            name="constancia_i"
                                                                            value="{{ constancia_i }}">
                                                                    </div>

                                                                    {% if constancia_i == 1 %}
                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/constancias_ingreso/FILE-'~codigo~'.pdf') }}">
                                                                            <i class="fa-fw fa fa-eye"></i></a>
                                                                    </div>

                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info">Certificado de
                                                                        estudios</label>
                                                                    <div class="input input-file"
                                                                        style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file"
                                                                                id="certificado_u_alumno"
                                                                                name="certificado_u_alumno"
                                                                                onchange="this.parentNode.nextSibling.value = this.value">...</span><input
                                                                            type="text" placeholder="Subir archivo"
                                                                            readonly="" disabled>

                                                                        <input type="hidden" id="input-certificado_u"
                                                                            name="certificado_u"
                                                                            value="{{ certificado_u }}">

                                                                    </div>


                                                                    {% if certificado_u == 1 %}
                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/certificados_estudios/FILE-'~codigo~'.pdf') }}">
                                                                            <i class="fa-fw fa fa-eye"></i></a>
                                                                    </div>

                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}


                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info">Traslado</label>
                                                                    <div class="input input-file"
                                                                        style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file"
                                                                                id="traslado_alumno"
                                                                                name="traslado_alumno"
                                                                                onchange="this.parentNode.nextSibling.value = this.value">...</span><input
                                                                            type="text" placeholder="Subir archivo"
                                                                            readonly="" disabled>
                                                                        <input type="hidden" id="input-traslado"
                                                                            name="traslado" value="{{ traslado }}">
                                                                    </div>

                                                                    {% if traslado == 1 %}
                                                                    <div class="alert alert-success fade in">

                                                                        Click aqui para ver el archivo
                                                                        <a class="btn btn-ribbon" target="_BLANK"
                                                                            role="button"
                                                                            href="{{ url('adminpanel/archivos/traslados/FILE-'~codigo~'.pdf') }}">
                                                                            <i class="fa-fw fa fa-eye"></i></a>
                                                                    </div>

                                                                    {% else %}

                                                                    <div class="alert alert-warning fade in">
                                                                        <i class="fa-fw fa fa-warning"></i>
                                                                        <strong>Pendiente</strong> Aun no ha subido un
                                                                        archivo.
                                                                    </div>

                                                                    {% endif %}

                                                                </section>

                                                            </div>
                                                        </fieldset>
                                                    </div>


                                                    <div class="tab-pane fade" id="s3">


                                                        <header style="margin-top: 10px;">
                                                            Ubigeo
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Region</label>
                                                                    <label class="select">
                                                                        <select id="input-region" name="region" style="pointer-events: none;">
                                                                            <option value="">Region</option>
                                                                            {% for reg in regiones %}
                                                                            {% if reg.region == alumnos.region %}
                                                                            <option selected="selected"
                                                                                value="{{ reg.region }}">{{
                                                                                reg.descripcion }}</option>
                                                                            {% else %}
                                                                            <option value="{{ reg.region }}">{{
                                                                                reg.descripcion }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Provincia</label>
                                                                    <label class="select">
                                                                        <select id="input-provincia" name="provincia" style="pointer-events: none;">
                                                                            <option value="">Provincia</option>

                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Distrito</label>
                                                                    <label class="select">
                                                                        <select id="input-distrito" name="distrito" style="pointer-events: none;">
                                                                            <option value="">Distrito</option>

                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Cod. Ubigeo</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-map-pin"></i>
                                                                        <input type="text" id="input-ubigeo"
                                                                            name="ubigeo" placeholder="ubigeo"
                                                                            value="{{ ubigeo }}" readonly>
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Lugar de Procedencia
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Region</label>
                                                                    <label class="select">
                                                                        <select id="input-region1" name="region1" style="pointer-events: none;">
                                                                            <option value="">Region</option>
                                                                            {% for reg in regiones %}
                                                                            {% if reg.region == alumnos.region1 %}
                                                                            <option selected="selected"
                                                                                value="{{ reg.region }}">{{
                                                                                reg.descripcion }}</option>
                                                                            {% else %}
                                                                            <option value="{{ reg.region }}">{{
                                                                                reg.descripcion }}</option>
                                                                            {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Provincia</label>
                                                                    <label class="select">
                                                                        <select id="input-provincia1" name="provincia1" style="pointer-events: none;">
                                                                            <option value="">Provincia</option>

                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Distrito</label>
                                                                    <label class="select">
                                                                        <select id="input-distrito1" name="distrito1" style="pointer-events: none;">
                                                                            <option value="">Distrito</option>

                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-3">
                                                                    <label class="text-info">Cod. Ubigeo
                                                                        Procedencia</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-map-pin"></i>
                                                                        <input type="text" id="input-ubigeo1"
                                                                            name="ubigeo1"
                                                                            placeholder="ubigeo de Procedencia"
                                                                            value="{{ ubigeo1 }}" readonly>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-12">
                                                                    <label class="text-info">Localidad</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-localidad"
                                                                            name="localidad" placeholder="Localidad"
                                                                            value="{{ localidad }}" readonly>

                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                        <header style="margin-top: -10px;">
                                                            Colegio de Procedencia
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-9">

                                                                    <label class="checkbox">

                                                                        {% if colegio_publico == 1 %}
                                                                        <input type="checkbox" name="colegio_publico"
                                                                            value="{{ colegio_publico }}"
                                                                            id="colegio_publico" checked readonly>
                                                                        {% else %}
                                                                        <input type="checkbox" name="colegio_publico"
                                                                            value="{{ colegio_publico }}"
                                                                            id="colegio_publico" readonly>
                                                                        {% endif %}

                                                                        <i></i>Colegio Público



                                                                    </label>

                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-colegio_nombre"
                                                                            name="colegio_nombre"
                                                                            placeholder="Colegio Público"
                                                                            value="{{ colegio_nombre }}" readonly>

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info"
                                                                        style="margin-bottom: 10px;">Colegio año</label>
                                                                    <label class="input"> <i
                                                                            class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-colegio_anio"
                                                                            name="colegio_anio"
                                                                            placeholder="Año termino colegio"
                                                                            value="{{ colegio_anio }}" readonly>

                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <footer>


                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()" type="button" class="btn btn-default">
                                            Volver
                                        </a>


                                        <!--<a role="button" href="{{ url("alumnos/imprime/"~codigo~'/'~sem) }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  DESCARGAR FICHA</a>-->


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
    <div id="exito_alumno">
        <p>
            Se actualizo correctamente...
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
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/alumnos/'~foto) }}"
                    error="this.onerror=null;this.src='';"></img>
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
    var id_alumno = '{{ codigo }}';
</script>


<script type="text/javascript">


    var publica = "si";

    //Ubigeo
    var region_id = '{{ region }}';
    var provincia_id = '{{ provincia }}';
    var distrito_id = '{{ distrito }}';

    //Lugar de procedencia
    var region1_id = '{{ region1 }}';
    var provincia1_id = '{{ provincia1 }}';
    var distrito1_id = '{{ distrito1 }}';

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>