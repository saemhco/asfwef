{% set codigo = "" %}
{% set nombres = "" %}
{% set apellidop = "" %}
{% set apellidom = "" %}
{% set email = "" %}
{% set email1 = "" %}
{% set grado = "" %}
{% set grado_universidad = "" %}
{% set titulo = "" %}
{% set titulo_universidad = "" %}
{% set grado_abreviado = "" %}
{% set concytec_enlace = "" %}
{% set peru_enlace = "" %}
{% set archivo = "" %}

{% set direccion_actual = "" %}
{% set direccion_procedencia = "" %}
{% set fecha_ingreso = "" %}
{% set lugar_nacimiento = "" %}
{% set estado_civil = "" %}
{% set grupo_sanguineo = "" %}
{% set religion = "" %}
{% set caso_emergencia_llamar = "" %}
{% set alergico_medicamentos = "" %}
{% set telefono_emergencia = "" %}

{% set enlace = "" %}

{% set fecha_nacimiento = "" %}
{% set documento = "" %}
{% set nro_doc = "" %}
{% set nro_cta = "" %}
{% set cci = "" %}
{% set celular = "" %}
{% set visible = "" %}
{% set sexo = "" %}
{% set estado = "" %}
{% set imagen = "" %}

{% if personal.nombres is defined %}
{% set nombres = personal.nombres %}
{% endif %}

{% if personal.apellidop is defined %}
{% set apellidop = personal.apellidop %}
{% endif %}

{% if personal.apellidom is defined %}
{% set apellidom = personal.apellidom %}
{% endif %}

{% if personal.email is defined %}
{% set email = personal.email %}
{% endif %}

{% if personal.email1 is defined %}
{% set email1 = personal.email1 %}
{% endif %}

{% if personal.email1 is defined %}
{% set email1 = personal.email1 %}
{% endif %}

{% if personal.grado is defined %}
{% set grado = personal.grado %}
{% endif %}

{% if personal.grado_universidad is defined %}
{% set grado_universidad = personal.grado_universidad %}
{% endif %}

{% if personal.titulo is defined %}
{% set titulo = personal.titulo %}
{% endif %}

{% if personal.titulo_universidad is defined %}
{% set titulo_universidad = personal.titulo_universidad %}
{% endif %}

{% if personal.grado_abreviado is defined %}
{% set grado_abreviado = personal.grado_abreviado %}
{% endif %}

{% if personal.concytec_enlace is defined %}
{% set concytec_enlace = personal.concytec_enlace %}
{% endif %}

{% if personal.peru_enlace is defined %}
{% set peru_enlace = personal.peru_enlace %}
{% endif %}

{% if personal.archivo is defined %}
{% set archivo = personal.archivo %}
{% endif %}

{% if personal.enlace is defined %}
{% set enlace = personal.enlace %}
{% endif %}



{% if personal.direccion_actual is defined %}
{% set direccion_actual = personal.direccion_actual %}
{% endif %}

{% if personal.direccion_procedencia is defined %}
{% set direccion_procedencia = personal.direccion_procedencia %}
{% endif %}

{% if personal.fecha_ingreso is defined %}
{% set fecha_ingreso = utilidades.fechita(personal.fecha_ingreso,'d/m/Y') %}
{% endif %}

{% if personal.lugar_nacimiento is defined %}
{% set lugar_nacimiento = personal.lugar_nacimiento %}
{% endif %}

{% if personal.estado_civil is defined %}
{% set estado_civil = personal.estado_civil %}
{% endif %}

{% if personal.grupo_sanguineo is defined %}
{% set grupo_sanguineo = personal.grupo_sanguineo %}
{% endif %}

{% if personal.religion is defined %}
{% set religion = personal.religion %}
{% endif %}

{% if personal.caso_emergencia_llamar is defined %}
{% set caso_emergencia_llamar = personal.caso_emergencia_llamar %}
{% endif %}

{% if personal.alergico_medicamentos is defined %}
{% set alergico_medicamentos = personal.alergico_medicamentos %}
{% endif %}

{% if personal.telefono_emergencia is defined %}
{% set telefono_emergencia = personal.telefono_emergencia %}
{% endif %}



{% if personal.fecha_nacimiento is defined %}
{% set fecha_nacimiento = utilidades.fechita(personal.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if personal.documento is defined %}
{% set documento = personal.documento %}
{% endif %}

{% if personal.sexo is defined %}
{% set sexo = personal.sexo %}
{% endif %}

{% if personal.nro_doc is defined %}
{% set nro_doc = personal.nro_doc %}
{% endif %}

{% if personal.nro_cta is defined %}
{% set nro_cta = personal.nro_cta %}
{% endif %}

{% if personal.cci is defined %}
{% set cci = personal.cci %}
{% endif %}

{% if personal.celular is defined %}
{% set celular = personal.celular %}
{% endif %}

{% if personal.visible is defined %}
{% set visible = personal.visible %}
{% endif %}

{% if personal.codigo is defined %}
{% set codigo = personal.codigo %}
{% endif %}

{% if personal.imagen is defined %}
{% set imagen = personal.imagen %}
{% endif %}

{% set grado_maximo = "" %}
{% if personal.grado_maximo is defined %}
{% set grado_maximo = personal.grado_maximo %}
{% endif %}


{% set grado_maximo_descripcion = "" %}
{% if personal.grado_maximo_descripcion is defined %}
{% set grado_maximo_descripcion = personal.grado_maximo_descripcion %}
{% endif %}


{% set descuento_judicial_p = "" %}
{% if personal.descuento_judicial_p is defined %}
{% set descuento_judicial_p = personal.descuento_judicial_p %}
{% endif %}

{% set descuento_judicial_m = "" %}
{% if personal.descuento_judicial_m is defined %}
{% set descuento_judicial_m = personal.descuento_judicial_m %}
{% endif %}

{% set cusp = "" %}
{% if personal.cusp is defined %}
{% set cusp = personal.cusp %}
{% endif %}

{% set tipo = "" %}
{% if personal.tipo is defined %}
{% set tipo = personal.tipo %}
{% endif %}

{% set regimen_pensiones = "" %}
{% if personal.regimen_pensiones is defined %}
{% set regimen_pensiones = personal.regimen_pensiones %}
{% endif %}

{% set afp = "" %}
{% if personal.afp is defined %}
{% set afp = personal.afp %}
{% endif %}

{% set colegio_profesional = "" %}
{% if personal.colegio_profesional is defined %}
{% set colegio_profesional = personal.colegio_profesional %}
{% endif %}

{% set colegio_profesional_nro = "" %}
{% if personal.colegio_profesional_nro is defined %}
{% set colegio_profesional_nro = personal.colegio_profesional_nro %}
{% endif %}


{% set seguro = "" %}
{% if personal.seguro is defined %}
{% set seguro = personal.seguro %}
{% endif %}


{% set seguro_nro = "" %}
{% if personal.seguro_nro is defined %}
{% set seguro_nro = personal.seguro_nro %}
{% endif %}

{% set airhsp = "" %}
{% if personal.airhsp is defined %}
{% set airhsp = personal.airhsp %}
{% endif %}

{% set airhsp_estado = "" %}
{% if personal.airhsp_estado is defined %}
{% set airhsp_estado = personal.airhsp_estado %}
{% endif %}

{% set id_banco = "" %}
{% if personal.id_banco is defined %}
{% set id_banco = personal.id_banco %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if personal.estado is defined %}
{% set estado = personal.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Personal</li>
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
                                <h2>Registro de Personal </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registropersonal/save','method':
                                    'post','id':'form_personal','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info">Imagen del Personal</label>
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-toggle="collapse" data-target="#imagen_personal"><i
                                                        class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                                                    Imagen</button>

                                                <div id="imagen_personal" class="collapse">

                                                    {% if imagen !== "" %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/personal/'~imagen) }}"
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
                                                <label class="text-info">Tipo de Documento
                                                </label>
                                                <label class="select">
                                                    <select id="input-documento" name="documento">
                                                        <option value="">Seleccione...</option>
                                                        {% for tipodocumento in tipodocumentos %}
                                                        {% if tipodocumento.codigo == documento %}
                                                        <option selected="selected" value="{{ tipodocumento.codigo }}">
                                                            {{ tipodocumento.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ tipodocumento.codigo }}">{{
                                                            tipodocumento.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Número Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc"
                                                        placeholder="Número de Documento" value="{{ nro_doc }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Apellido Paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidop" name="apellidop"
                                                        placeholder="Apellido Paterno" value="{{ apellidop }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Apellido Materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    <input type="text" id="input-apellidom" name="apellidom"
                                                        placeholder="Apellido Materno" value="{{ apellidom }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres"
                                                        placeholder="Nombres" value="{{ nombres }}">
                                                    <input type="hidden" id="input-codigo" name="codigo"
                                                        value="{{ codigo }}">
                                                    <input type="hidden" id="input-estado_registrado"
                                                        name="estado_registrado" value="{{ estado }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Fecha Nacimiento(DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento"
                                                        name="fecha_nacimiento" placeholder="Fecha" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_nacimiento }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Correo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-email" name="email" placeholder="Email"
                                                        value="{{ email }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Correo Insitucional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-email1" name="email1"
                                                        placeholder="Email1" value="{{ email1 }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-celular" name="celular"
                                                        placeholder="Celular" value="{{ celular }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Número de Cuenta</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_cta" name="nro_cta"
                                                        placeholder="Número de Cuenta" value="{{ nro_cta }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">CCI</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cci" name="cci" placeholder="CCI"
                                                        value="{{ cci }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-4">

                                                <label class="text-info">Sexo
                                                </label>
                                                <label class="select">
                                                    <select id="input-sexo" name="sexo">
                                                        <option value="">Seleccione...</option>
                                                        {% for sexo_personal_model in sexo_personal %}
                                                        {% if sexo_personal_model.codigo == sexo %}
                                                        <option selected="selected"
                                                            value="{{ sexo_personal_model.codigo }}">{{
                                                            sexo_personal_model.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ sexo_personal_model.codigo }}">{{
                                                            sexo_personal_model.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Estado Civil
                                                </label>
                                                <label class="select">
                                                    <select id="input-estado_civil" name="estado_civil">
                                                        <option value="">Seleccione...</option>
                                                        {% for estadocivil_model in estadocivil %}
                                                        {% if estadocivil_model.codigo == estado_civil %}
                                                        <option selected="selected"
                                                            value="{{ estadocivil_model.codigo }}">{{
                                                            estadocivil_model.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ estadocivil_model.codigo }}">{{
                                                            estadocivil_model.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Religion
                                                </label>
                                                <label class="select">
                                                    <select id="input-religion" name="religion">
                                                        <option value="">Seleccione...</option>
                                                        {% for religion_model in religiones %}
                                                        {% if religion_model.codigo == religion %}
                                                        <option selected="selected" value="{{ religion_model.codigo }}">
                                                            {{ religion_model.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ religion_model.codigo }}">{{
                                                            religion_model.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Dirección actual</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion_actual"
                                                        name="direccion_actual" placeholder="Direccion Actual"
                                                        value="{{ direccion_actual }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Dirección Procedencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion_procedencia"
                                                        name="direccion_procedencia" placeholder="Direccion Procedencia"
                                                        value="{{ direccion_procedencia }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Lugar de Nacimiento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-lugar_nacimiento"
                                                        name="lugar_nacimiento" placeholder="Lugar de Nacimiento"
                                                        value="{{ lugar_nacimiento }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Colegio Profesional</label>
                                                <label class="select">
                                                    <select id="input-colegio_profesional" name="colegio_profesional">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for c_p in colegioprofesional %}
                                                        {% if c_p.codigo == colegio_profesional %}
                                                        <option selected="selected" value="{{ c_p.codigo }}">{{
                                                            c_p.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ c_p.codigo }}">{{ c_p.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Colegio Profesional Número</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-colegio_profesional_nro"
                                                        name="colegio_profesional_nro"
                                                        placeholder="Colegio Profesional Número"
                                                        value="{{ colegio_profesional_nro }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Fecha ingreso(DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_ingreso" name="fecha_ingreso"
                                                        placeholder="Fecha" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_ingreso }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Concytec Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-concytec_enlace" name="concytec_enlace"
                                                        placeholder="Concytec Enlace" value="{{ concytec_enlace }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Titulo - Grado Abreviado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_abreviado" name="grado_abreviado"
                                                        placeholder="Grado Abreviado" value="{{ grado_abreviado }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Grado Mayor</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado" name="grado" placeholder="Grado"
                                                        value="{{ grado }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Universidad Grado Mayor</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_universidad"
                                                        name="grado_universidad" placeholder="Universidad Grado Mayor"
                                                        value="{{ grado_universidad }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Título Profesional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo"
                                                        placeholder="Titulo" value="{{ titulo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Universidad Titulo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo_universidad"
                                                        name="titulo_universidad"
                                                        placeholder="Universidad Titulo Profesional"
                                                        value="{{ titulo_universidad }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info">Máximo Grado Académico</label>
                                                <label class="select">
                                                    <select id="input-grado_maximo" name="grado_maximo">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for g_m in gradomaximo %}
                                                        {% if g_m.codigo == grado_maximo %}
                                                        <option selected="selected" value="{{ g_m.codigo }}">{{
                                                            g_m.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ g_m.codigo }}">{{ g_m.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Máximo Grado Descripción</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_maximo_descripcion"
                                                        name="grado_maximo_descripcion"
                                                        placeholder="Máximo Grado Descripción"
                                                        value="{{ grado_maximo_descripcion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Régimen de Pensiones</label>
                                                <label class="select">
                                                    <select id="input-regimen_pensiones" name="regimen_pensiones">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for r_p in regimenpensiones %}
                                                        {% if r_p.codigo == regimen_pensiones %}
                                                        <option selected="selected" value="{{ r_p.codigo }}">{{
                                                            r_p.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ r_p.codigo }}">{{ r_p.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">AFP</label>
                                                <label class="select">
                                                    <select id="input-afp" name="afp">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for afp_m in afps %}
                                                        {% if afp_m.codigo == afp %}
                                                        <option selected="selected" value="{{ afp_m.codigo }}">{{
                                                            afp_m.nombre }}</option>
                                                        {% else %}
                                                        <option value="{{ afp_m.codigo }}">{{ afp_m.nombre }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">CUSP</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cusp" name="cusp" placeholder="CUSP"
                                                        value="{{ cusp }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Tipo</label>
                                                <label class="select">
                                                    <select id="input-tipo" name="tipo">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for t_r_p in tiporegimenpensiones %}
                                                        {% if t_r_p.codigo == tipo %}
                                                        <option selected="selected" value="{{ t_r_p.codigo }}">{{
                                                            t_r_p.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ t_r_p.codigo }}">{{ t_r_p.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro" name="seguro">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for seguros_select in seguros %}
                                                        {% if seguros_select.codigo == seguro %}
                                                        <option selected="selected" value="{{ seguros_select.codigo }}">
                                                            {{ seguros_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ seguros_select.codigo }}">{{
                                                            seguros_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Nro. Seguro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-seguro_nro" name="seguro_nro"
                                                        placeholder="seguro_nro" value="{{ seguro_nro }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Descuento Judicial Porcentaje %</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-descuento_judicial_p"
                                                        name="descuento_judicial_p"
                                                        placeholder="Descuento Judicial Porcentaje %"
                                                        value="{{ descuento_judicial_p }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Descuento Judicial Monto S/.</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-descuento_judicial_m"
                                                        name="descuento_judicial_m"
                                                        placeholder="Descuento Judicial Porcentaje S/."
                                                        value="{{ descuento_judicial_m }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info">Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace"
                                                        placeholder="Enlace" value="{{ enlace }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Peru Gob Pe Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-peru_enlace" name="peru_enlace"
                                                        placeholder="Peru Gob Pe Enlace" value="{{ peru_enlace }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Grupo Sanguineo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grupo_sanguineo" name="grupo_sanguineo"
                                                        placeholder="Grupo Sanguineo" value="{{ grupo_sanguineo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Alergico Medicamentos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-alergico_medicamentos"
                                                        name="alergico_medicamentos"
                                                        placeholder="Alergico a Medicamentos"
                                                        value="{{ alergico_medicamentos }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Caso de emergencia Llamar</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-caso_emergencia_llamar"
                                                        name="caso_emergencia_llamar"
                                                        placeholder="Caso Emergencia LLamar"
                                                        value="{{ caso_emergencia_llamar }}">
                                                </label>
                                            </section>



                                            <section class="col col-md-6">
                                                <label class="text-info">Teléfono Emergencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-telefono_emergencia"
                                                        name="telefono_emergencia" placeholder="Teléfono Emergencia"
                                                        value="{{ telefono_emergencia }}">
                                                </label>
                                            </section>



                                            <section class="col col-md-6">
                                                <label class="text-info">airhsp</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-airhsp" name="airhsp"
                                                        placeholder="airhsp" value="{{ airhsp }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info"> Banco 
                                                </label>
                                                <select style="width:100%" id="input-id_banco" name="id_banco">
                                                    <option value="">Seleccione...</option>
                                                    {% for banco_select in bancos %}

                                                    {% if banco_select.banco == id_banco %}
                                                    <option selected="selected"
                                                        value="{{ banco_select.banco }}">{{banco_select.nombre }}</option>
                                                    {% else %}
                                                    <option value="{{ banco_select.banco }}">{{banco_select.nombre }}</option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                <p id="warning-id_banco"></p>
                                            </section>



                                            <section class="col col-md-6">

                                                <label class="text-info">Agregar Archivo</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal">
                                                    <input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo_personal" type="file"
                                                            name="archivo_personal"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file" name="input-file" placeholder="Agregar Archivo"
                                                        readonly="">

                                                </div>

                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/personal/'~archivo) }}"> <i
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

                                                <label class="text-info">Agregar Imagen (600 x 400 px) formatos permitidos: ('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG')</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal">
                                                    <input type="hidden" id="input-archivo" name="archivo"
                                                        value="{{ archivo }}">#}

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

                                            <section class="col col-md-3">
                                                <label class="text-info">Visible</label>
                                                <label class="checkbox">
                                                    {% if visible == 1 %}
                                                    <input type="checkbox" name="visible" value="{{ visible }}"
                                                        id="input-visible" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="visible" value="{{ visible }}"
                                                        id="input-visible">
                                                    {% endif %}
                                                    <i></i>&nbsp;</label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">airhsp_estado</label>
                                                <label class="checkbox">
                                                    {% if airhsp_estado == 1 %}
                                                    <input type="checkbox" name="airhsp_estado" value="{{ airhsp_estado }}"
                                                        id="input-airhsp_estado" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="airhsp_estado" value="{{ airhsp_estado }}"
                                                        id="input-airhsp_estado">
                                                    {% endif %}
                                                    <i></i>&nbsp;</label>
                                            </section>



                                            {# <section class="col col-md-3">
                                                <label class="text-info">Estado</label>
                                                <label class="checkbox">

                                                    {% if estado == 'A' %}
                                                    <input type="checkbox" name="estado" value="{{ estado }}"
                                                        id="input-estado" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="estado" value="{{ estado }}"
                                                        id="input-estado">
                                                    {% endif %}
                                                    <i></i>&nbsp;</label>
                                            </section>#}
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
                        <a href="javascript:void(0);" onclick="agregarFamiliar();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarFamiliar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarFamiliar();" class="btn btn-danger btn-block"><i
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
                                <h2>Relación de Familiares</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_personal_familiares"
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
                                                <th data-hide="phone,tablet">Nro DNI</th>
                                                <th data-hide="phone,tablet">Parentesco</th>
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

                        <a href="{{ url('registropersonal/contrato/'~codigo) }}" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

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
                                <h2>Relación de Contratos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_contratos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Tipo</th>
                                                <th>Número</th>
                                                <th data-hide="phone,tablet">Año</th>
                                                <th data-hide="phone,tablet">Fecha Inicio</th>
                                                <th data-hide="phone,tablet">Fecha Fin</th>
                                                <th data-hide="phone,tablet">Archivo</th>
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
                        <a href="javascript:void(0);" onclick="agregarha();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarha();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarha();" class="btn btn-danger btn-block"><i
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
                                <h2>Relación de historial de areas</h2>
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
                                                <th data-hide="phone,tablet">Areas</th>
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

<!--Formulario de registro de padres-->
{{ form('registropersonal/savePersonalFamiliares','method':
'post','id':'form_personal_familiares','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info">Imagen Familiar (600 x 400 px)</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse"
                data-target="#imagen_familiar"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>
            <div id="imagen_familiar" class="collapse">
                <img id="imagen_familiar_collapse" class="img-responsive" src=""
                    error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
            </div>
        </section>
        <section class="col col-md-3">
            <label class="text-info">Documento</label>
            <label class="select">
                <select id="input-documento_personal_familiares" name="documento">
                    <option value=""> Seleccione</option>
                    {% for tipo_documento_familiar_model in tipodocumentos_familiares %}
                    <option value="{{ tipo_documento_familiar_model.codigo }}">{{ tipo_documento_familiar_model.nombres
                        }} </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Nro Documento</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nro_doc_personal_familiares" name="nro_doc" placeholder="Nro Documento"
                    value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Orden </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_personal_familiares" name="orden" placeholder="Orden" value="">

            </label>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-3">
            <label class="text-info">Apellido Paterno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-apellidop_personal_familiares" name="apellidop"
                    placeholder="Apellido Paterno" value="">

            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Apellido Materno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-apellidom_personal_familiares" name="apellidom"
                    placeholder="Apellido Materno" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Nombres </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombres_personal_familiares" name="nombres" placeholder="Nombres">
                <input type="hidden" id="input-codigo_familiar" name="codigo" value="">
                <input type="hidden" id="input-personal" name="personal" value="{{ codigo }}">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info">Parentesco
            </label>
            <label class="select">
                <select id="input-parentesco_personal_familiares" name="parentesco">
                    <option value=""> Seleccione</option>
                    {% for parentesco_familiar_model in parentesco_familiares %}
                    <option value="{{ parentesco_familiar_model.codigo }}">{{ parentesco_familiar_model.nombres }}
                    </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
    </div>
    <div class="row">

        <section class="col col-md-3">
            <label class="text-info">Fecha Nacimiento (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_nacimiento_personal_familiares" name="fecha_nacimiento"
                    placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Celular </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-celular_personal_familiares" name="celular" placeholder="Celular" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Sexo
            </label>
            <label class="select">
                <select id="input-sexo_personal_familiares" name="sexo">
                    <option value=""> Seleccione</option>
                    {% for sexo_familiar_model in sexo_familiares %}
                    <option value="{{ sexo_familiar_model.codigo }}">{{ sexo_familiar_model.nombres }} </option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Ocupación</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ocupacion_personal_familiares" name="ocupacion" placeholder="Ocupación"
                    value="">
            </label>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-6">

            <label class="text-info">Agregar Archivo</label>
            <div class="input input-file" id="archivo_personal_familiares_modal">

                {#<input type="file" id="archivo_personal" name="archivo_personal">
                <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                <span class="button"><input id="archivo_personal_familiares" type="file" name="archivo"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                        class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_personal_familiares"
                    name="input-file" placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info">Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_personal_familiares_modal">

                <label class="input">

                    <span class="button"><input id="imagen_personal_familiares" type="file" name="imagen"
                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                            class="fa fa-search"></i> Buscar</span><input type="text"
                        id="input-image_personal_familiares" name="input-file" placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

        <section class="col col-md-6">
            <label class="text-info">Observaciones </label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-observaciones_personal_familiares" name="observaciones"></textarea>
            </label>
        </section>
        <section class="col col-md-2">
            <label class="text-info">Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado_personal_familiares">
                <i></i>&nbsp;</label>
        </section>
        <section class="col col-md-2">
            <label class="text-info">Principal</label>
            <label class="checkbox">
                <input type="checkbox" name="es_principal" value="" id="input-es_principal_personal_familiares">
                <i></i>&nbsp;</label>
        </section>

    </div>
</fieldset>
{{ endForm() }}



{{ form('registropersonal/savePersonalAreas','method':
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

            <label class="text-info">Areas
            </label>
            <label class="select">
                <select id="input-area" name="area">
                    <option value=""> SELECCIONE...</option>
                    {% for areas_select in areas %}
                    <option value="{{ areas_select.codigo }}">{{ areas_select.nombres }} </option>
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
                <input type="hidden" id="input-codigo_personal_areas" name="id_personal_area" value="">
                <input type="hidden" id="input-personal" name="personal" value="{{ codigo }}">
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

<div class="hidden">
    <div id="exito_personal">
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
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/personal/'~imagen) }}"
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
    var codigo = "{{ codigo }}";
</script>

<script type="text/javascript">
    var id_personal = "{{ codigo }}";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>