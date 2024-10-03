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





{% set id_hc = "" %}
{% if historiaClinica.id_hc is defined %}
{% set id_hc = historiaClinica.id_hc %}
{% endif %}

{% set fecha_inicio = "" %}
{% if historiaClinica.fecha_inicio is defined %}
{% set fecha_inicio = utilidades.fechita(historiaClinica.fecha_inicio,'d/m/Y') %}
{% endif %}

{% set fecha_actualizacion = "" %}
{% if historiaClinica.fecha_actualizacion is defined %}
{% set fecha_actualizacion = utilidades.fechita(historiaClinica.fecha_actualizacion,'d/m/Y') %}
{% endif %}

{% set nro_doc = "" %}
{% if historiaClinica.nro_doc is defined %}
{% set nro_doc = historiaClinica.nro_doc %}
{% endif %}

{% set grupo_sanguineo = "" %}
{% if historiaClinica.grupo_sanguineo is defined %}
{% set grupo_sanguineo = historiaClinica.grupo_sanguineo %}
{% endif %}

{% set rh = "" %}
{% if historiaClinica.rh is defined %}
{% set rh = historiaClinica.rh %}
{% endif %}

{% set alergico = "" %}
{% if historiaClinica.alergico is defined %}
{% set alergico = historiaClinica.alergico %}
{% endif %}

{% set alergico_nombre = "" %}
{% if historiaClinica.alergico_nombre is defined %}
{% set alergico_nombre = historiaClinica.alergico_nombre %}
{% endif %}

{% set descripcion_antecedentes = "" %}
{% if historiaClinica.descripcion_antecedentes is defined %}
{% set descripcion_antecedentes = historiaClinica.descripcion_antecedentes %}
{% endif %}

{% set nro_hijos_vivos = "" %}
{% if historiaClinica.nro_hijos_vivos is defined %}
{% set nro_hijos_vivos = historiaClinica.nro_hijos_vivos %}
{% endif %}

{% set nro_hijos_fallecidos = "" %}
{% if historiaClinica.nro_hijos_fallecidos is defined %}
{% set nro_hijos_fallecidos = historiaClinica.nro_hijos_fallecidos %}
{% endif %}

{% set fecha_ur = "" %}
{% if historiaClinica.fecha_ur is defined %}
{% set fecha_ur = utilidades.fechita(historiaClinica.fecha_ur,'d/m/Y') %}
{% endif %}

{% set observaciones = "" %}
{% if historiaClinica.observaciones is defined %}
{% set observaciones = historiaClinica.observaciones %}
{% endif %}

{% set hipertension_arterial = "" %}
{% if historiaClinica.hipertension_arterial is defined %}
{% set hipertension_arterial = historiaClinica.hipertension_arterial %}
{% endif %}

{% set diabetes_mellitus = "" %}
{% if historiaClinica.diabetes_mellitus is defined %}
{% set diabetes_mellitus = historiaClinica.diabetes_mellitus %}
{% endif %}

{% set obesidad_dislipidemias = "" %}
{% if historiaClinica.obesidad_dislipidemias is defined %}
{% set obesidad_dislipidemias = historiaClinica.obesidad_dislipidemias %}
{% endif %}

{% set enfermedades_osteomusculares = "" %}
{% if historiaClinica.enfermedades_osteomusculares is defined %}
{% set enfermedades_osteomusculares = historiaClinica.enfermedades_osteomusculares %}
{% endif %}

{% set enfermedades_metaxemicas = "" %}
{% if historiaClinica.enfermedades_metaxemicas is defined %}
{% set enfermedades_metaxemicas = historiaClinica.enfermedades_metaxemicas %}
{% endif %}

{% set enfermedades_cardiovasculares = "" %}
{% if historiaClinica.enfermedades_cardiovasculares is defined %}
{% set enfermedades_cardiovasculares = historiaClinica.enfermedades_cardiovasculares %}
{% endif %}

{% set neoplasias = "" %}
{% if historiaClinica.neoplasias is defined %}
{% set neoplasias = historiaClinica.neoplasias %}
{% endif %}

{% set cancer_cervix_mama = "" %}
{% if historiaClinica.cancer_cervix_mama is defined %}
{% set cancer_cervix_mama = historiaClinica.cancer_cervix_mama %}
{% endif %}

{% set cancer_prostata = "" %}
{% if historiaClinica.cancer_prostata is defined %}
{% set cancer_prostata = historiaClinica.cancer_prostata %}
{% endif %}

{% set hepatitis_a_b_c = "" %}
{% if historiaClinica.hepatitis_a_b_c is defined %}
{% set hepatitis_a_b_c = historiaClinica.hepatitis_a_b_c %}
{% endif %}

{% set alergias_o_hipersensibilidad = "" %}
{% if historiaClinica.alergias_o_hipersensibilidad is defined %}
{% set alergias_o_hipersensibilidad = historiaClinica.alergias_o_hipersensibilidad %}
{% endif %}

{% set enfermedades_respiratorias = "" %}
{% if historiaClinica.enfermedades_respiratorias is defined %}
{% set enfermedades_respiratorias = historiaClinica.enfermedades_respiratorias %}
{% endif %}

{% set transfusiones_sanguinea = "" %}
{% if historiaClinica.transfusiones_sanguinea is defined %}
{% set transfusiones_sanguinea = historiaClinica.transfusiones_sanguinea %}
{% endif %}

{% set intervencion_quirurgica = "" %}
{% if historiaClinica.intervencion_quirurgica is defined %}
{% set intervencion_quirurgica = historiaClinica.intervencion_quirurgica %}
{% endif %}

{% set traumatismos_accidentes = "" %}
{% if historiaClinica.traumatismos_accidentes is defined %}
{% set traumatismos_accidentes = historiaClinica.traumatismos_accidentes %}
{% endif %}

{% set enfermedad_gastrointestinal = "" %}
{% if historiaClinica.enfermedad_gastrointestinal is defined %}
{% set enfermedad_gastrointestinal = historiaClinica.enfermedad_gastrointestinal %}
{% endif %}

{% set enfermedades_ginecologicas = "" %}
{% if historiaClinica.enfermedades_ginecologicas is defined %}
{% set enfermedades_ginecologicas = historiaClinica.enfermedades_ginecologicas %}
{% endif %}

{% set enfermedades_psicomotoras = "" %}
{% if historiaClinica.enfermedades_psicomotoras is defined %}
{% set enfermedades_psicomotoras = historiaClinica.enfermedades_psicomotoras %}
{% endif %}

{% set tb_pulmonar_extrapulmonar = "" %}
{% if historiaClinica.tb_pulmonar_extrapulmonar is defined %}
{% set tb_pulmonar_extrapulmonar = historiaClinica.tb_pulmonar_extrapulmonar %}
{% endif %}

{% set hipertension_arterial_f = "" %}
{% if historiaClinica.hipertension_arterial_f is defined %}
{% set hipertension_arterial_f = historiaClinica.hipertension_arterial_f %}
{% endif %}

{% set diabetes_mellitus_f = "" %}
{% if historiaClinica.diabetes_mellitus_f is defined %}
{% set diabetes_mellitus_f = historiaClinica.diabetes_mellitus_f %}
{% endif %}

{% set infarto_miocardio_f = "" %}
{% if historiaClinica.infarto_miocardio_f is defined %}
{% set infarto_miocardio_f = historiaClinica.infarto_miocardio_f %}
{% endif %}

{% set enfermedad_mental = "" %}
{% if historiaClinica.enfermedad_mental is defined %}
{% set enfermedad_mental = historiaClinica.enfermedad_mental %}
{% endif %}

{% set neoplasias_f = "" %}
{% if historiaClinica.neoplasias_f is defined %}
{% set neoplasias_f = historiaClinica.neoplasias_f %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if historiaClinica.estado is defined %}
{% set estado = historiaClinica.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Historia Clinica</li>
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
                                <h2>Registro de Historia Clinica</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrohistoriasclinicas/save','method':
                                    'post','id':'form_historia_clinica','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info">Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder=""
                                                        value="{{ codigo }}" readonly="">
                                                        <input type="hidden" id="input-tipo"
                                                        name="tipo" value="{{ tipo }}">
                                                </label>
                                            </section>
                                            <section class="col col-2">
                                                <label class="text-info"></label>
                                                <a href="{{ url('registroatencionessalud/paciente/'~nro_doc) }}" type="button" class="btn btn-sm  btn-block btn-warning">
                                                    <i class="fa fa-table"></i>  Atenciones
                                                </a>
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
                                                    {% elseif(tipo == 5) %}
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/publico/'~foto) }}"
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
                                                    <select id="input-seguro" name="seguro">
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
                                                        placeholder="Dirección" value="{{ direccion }}">

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
                                                        placeholder="Celular" value="{{ celular }}">

                                                </label>
                                            </section>

                                        </div>
                                    </fieldset>

                                    <p class="alert alert-info text-align-center">
                                        <strong style="font-size: 14px;">Historia Clinica</strong>
                                    </p>
                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-2">
                                                <label class="text-info">Fecha de Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                                                        placeholder="Fecha de Inicio" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                    <input type="hidden" id="input-id_hc"
                                                        name="id_hc" value="{{ id_hc }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Fecha de
                                                    Actualizacion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_actualizacion"
                                                        name="fecha_actualizacion" placeholder="Fecha de Actualizacion"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha_actualizacion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Grupo Sanguineo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grupo_sanguineo" name="grupo_sanguineo"
                                                        placeholder="Grupo Sanguineo" value="{{ grupo_sanguineo }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info">RH</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-rh" name="rh" placeholder="RH"
                                                        value="{{ rh }}">
                                                </label>
                                            </section>
                                        </div>


                                    </fieldset>


                                    <p class="alert alert-info text-align-center">
                                        <strong style="font-size: 14px;">Antecedentes Personales</strong>
                                    </p>
                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if hipertension_arterial == 1 %}
                                                    <input type="checkbox" name="hipertension_arterial"
                                                        value="{{ hipertension_arterial }}"
                                                        id="input-hipertension_arterial" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="hipertension_arterial"
                                                        value="{{ hipertension_arterial }}"
                                                        id="input-hipertension_arterial">
                                                    {% endif %}

                                                    <i></i>Hipertencion Arterial
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if diabetes_mellitus == 1 %}
                                                    <input type="checkbox" name="diabetes_mellitus"
                                                        value="{{ diabetes_mellitus }}" id="input-diabetes_mellitus"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="diabetes_mellitus"
                                                        value="{{ diabetes_mellitus }}" id="input-diabetes_mellitus">
                                                    {% endif %}

                                                    <i></i>Diabetes Militus
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if obesidad_dislipidemias == 1 %}
                                                    <input type="checkbox" name="obesidad_dislipidemias"
                                                        value="{{ obesidad_dislipidemias }}"
                                                        id="input-obesidad_dislipidemias" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="obesidad_dislipidemias"
                                                        value="{{ obesidad_dislipidemias }}"
                                                        id="input-obesidad_dislipidemias">
                                                    {% endif %}

                                                    <i></i>Obesidad o Dislipidemias
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedades_osteomusculares == 1 %}
                                                    <input type="checkbox" name="enfermedades_osteomusculares"
                                                        value="{{ enfermedades_osteomusculares }}"
                                                        id="input-enfermedades_osteomusculares" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedades_osteomusculares"
                                                        value="{{ enfermedades_osteomusculares }}"
                                                        id="input-enfermedades_osteomusculares">
                                                    {% endif %}

                                                    <i></i>Enfermedades Osteomusculares
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedades_metaxemicas == 1 %}
                                                    <input type="checkbox" name="enfermedades_metaxemicas"
                                                        value="{{ enfermedades_metaxemicas }}"
                                                        id="input-enfermedades_metaxemicas" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedades_metaxemicas"
                                                        value="{{ enfermedades_metaxemicas }}"
                                                        id="input-enfermedades_metaxemicas">
                                                    {% endif %}

                                                    <i></i>Enfermedades Metaxémicas
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedades_cardiovasculares == 1 %}
                                                    <input type="checkbox" name="enfermedades_cardiovasculares"
                                                        value="{{ enfermedades_cardiovasculares }}"
                                                        id="input-enfermedades_cardiovasculares" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedades_cardiovasculares"
                                                        value="{{ enfermedades_cardiovasculares }}"
                                                        id="input-enfermedades_cardiovasculares">
                                                    {% endif %}

                                                    <i></i>Enferm Cardiovas
                                                    (Infarto, Arritmia, ICC, etc)
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if neoplasias == 1 %}
                                                    <input type="checkbox" name="neoplasias" value="{{ neoplasias }}"
                                                        id="input-neoplasias" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="neoplasias" value="{{ neoplasias }}"
                                                        id="input-neoplasias">
                                                    {% endif %}

                                                    <i></i>Neoplasias
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if cancer_cervix_mama == 1 %}
                                                    <input type="checkbox" name="cancer_cervix_mama"
                                                        value="{{ cancer_cervix_mama }}" id="input-cancer_cervix_mama"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="cancer_cervix_mama"
                                                        value="{{ cancer_cervix_mama }}" id="input-cancer_cervix_mama">
                                                    {% endif %}

                                                    <i></i>Cáncer de cervix / mama
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if cancer_prostata == 1 %}
                                                    <input type="checkbox" name="cancer_prostata"
                                                        value="{{ cancer_prostata }}" id="input-cancer_prostata"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="cancer_prostata"
                                                        value="{{ cancer_prostata }}" id="input-cancer_prostata">
                                                    {% endif %}

                                                    <i></i>Cáncer de próstata
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if hepatitis_a_b_c == 1 %}
                                                    <input type="checkbox" name="hepatitis_a_b_c"
                                                        value="{{ hepatitis_a_b_c }}" id="input-hepatitis_a_b_c"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="hepatitis_a_b_c"
                                                        value="{{ hepatitis_a_b_c }}" id="input-hepatitis_a_b_c">
                                                    {% endif %}

                                                    <i></i>Hepatitis A, B, C, D
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if alergias_o_hipersensibilidad == 1 %}
                                                    <input type="checkbox" name="alergias_o_hipersensibilidad"
                                                        value="{{ alergias_o_hipersensibilidad }}"
                                                        id="input-alergias_o_hipersensibilidad" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="alergias_o_hipersensibilidad"
                                                        value="{{ alergias_o_hipersensibilidad }}"
                                                        id="input-alergias_o_hipersensibilidad">
                                                    {% endif %}

                                                    <i></i>Alergias o Hipersensibilidad
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedades_respiratorias == 1 %}
                                                    <input type="checkbox" name="enfermedades_respiratorias"
                                                        value="{{ enfermedades_respiratorias }}"
                                                        id="input-enfermedades_respiratorias" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedades_respiratorias"
                                                        value="{{ enfermedades_respiratorias }}"
                                                        id="input-enfermedades_respiratorias">
                                                    {% endif %}

                                                    <i></i>Enferm Respirat: Tuberculosis Pulmonar, Asma, SDRA, etc.
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if transfusiones_sanguinea == 1 %}
                                                    <input type="checkbox" name="transfusiones_sanguinea"
                                                        value="{{ transfusiones_sanguinea }}"
                                                        id="input-transfusiones_sanguinea" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="transfusiones_sanguinea"
                                                        value="{{ transfusiones_sanguinea }}"
                                                        id="input-transfusiones_sanguinea">
                                                    {% endif %}

                                                    <i></i>Transf Sanguínea u otros derivados hematol
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if intervencion_quirurgica == 1 %}
                                                    <input type="checkbox" name="intervencion_quirurgica"
                                                        value="{{ intervencion_quirurgica }}"
                                                        id="input-intervencion_quirurgica" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="intervencion_quirurgica"
                                                        value="{{ intervencion_quirurgica }}"
                                                        id="input-intervencion_quirurgica">
                                                    {% endif %}

                                                    <i></i>Intervencion Quirúrgica o Cirugías
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if traumatismos_accidentes == 1 %}
                                                    <input type="checkbox" name="traumatismos_accidentes"
                                                        value="{{ traumatismos_accidentes }}"
                                                        id="input-traumatismos_accidentes" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="traumatismos_accidentes"
                                                        value="{{ traumatismos_accidentes }}"
                                                        id="input-traumatismos_accidentes">
                                                    {% endif %}

                                                    <i></i>Traumatismos o accidentes
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedad_gastrointestinal == 1 %}
                                                    <input type="checkbox" name="enfermedad_gastrointestinal"
                                                        value="{{ enfermedad_gastrointestinal }}"
                                                        id="input-enfermedad_gastrointestinal" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedad_gastrointestinal"
                                                        value="{{ enfermedad_gastrointestinal }}"
                                                        id="input-enfermedad_gastrointestinal">
                                                    {% endif %}

                                                    <i></i>Enfermedad gastrointestinal o Digestivo
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedades_ginecologicas == 1 %}
                                                    <input type="checkbox" name="enfermedades_ginecologicas"
                                                        value="{{ enfermedades_ginecologicas }}"
                                                        id="input-enfermedades_ginecologicas" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedades_ginecologicas"
                                                        value="{{ enfermedades_ginecologicas }}"
                                                        id="input-enfermedades_ginecologicas">
                                                    {% endif %}

                                                    <i></i> Enfermedades Ginecológicas
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedades_psicomotoras == 1 %}
                                                    <input type="checkbox" name="enfermedades_psicomotoras"
                                                        value="{{ enfermedades_psicomotoras }}"
                                                        id="input-enfermedades_psicomotoras" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedades_psicomotoras"
                                                        value="{{ enfermedades_psicomotoras }}"
                                                        id="input-enfermedades_psicomotoras">
                                                    {% endif %}

                                                    <i></i> Enfermedades psicomotoras o Neuromotoras
                                                </label>
                                            </section>

                                        </div>

                                    </fieldset>



                                    <p class="alert alert-info text-align-center">
                                        <strong style="font-size: 14px;">Antecedentes Familiares</strong>
                                    </p>
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if tb_pulmonar_extrapulmonar == 1 %}
                                                    <input type="checkbox" name="tb_pulmonar_extrapulmonar"
                                                        value="{{ tb_pulmonar_extrapulmonar }}"
                                                        id="input-tb_pulmonar_extrapulmonar" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="tb_pulmonar_extrapulmonar"
                                                        value="{{ tb_pulmonar_extrapulmonar }}"
                                                        id="input-tb_pulmonar_extrapulmonar">
                                                    {% endif %}

                                                    <i></i>TB Pulmonar o Extrapulmonar
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if hipertension_arterial_f == 1 %}
                                                    <input type="checkbox" name="hipertension_arterial_f"
                                                        value="{{ hipertension_arterial_f }}"
                                                        id="input-hipertension_arterial_f" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="hipertension_arterial_f"
                                                        value="{{ hipertension_arterial_f }}"
                                                        id="input-hipertension_arterial_f">
                                                    {% endif %}

                                                    <i></i>Hipertensión Arterial
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if diabetes_mellitus_f == 1 %}
                                                    <input type="checkbox" name="diabetes_mellitus_f"
                                                        value="{{ diabetes_mellitus_f }}" id="input-diabetes_mellitus_f"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="diabetes_mellitus_f"
                                                        value="{{ diabetes_mellitus_f }}"
                                                        id="input-diabetes_mellitus_f">
                                                    {% endif %}

                                                    <i></i>Diabetes Mellitus
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if infarto_miocardio_f == 1 %}
                                                    <input type="checkbox" name="infarto_miocardio_f"
                                                        value="{{ infarto_miocardio_f }}" id="input-infarto_miocardio_f"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="infarto_miocardio_f"
                                                        value="{{ infarto_miocardio_f }}"
                                                        id="input-infarto_miocardio_f">
                                                    {% endif %}

                                                    <i></i>Infarto de Miocardio u otras Enf. Cardiovasculares
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if enfermedad_mental == 1 %}
                                                    <input type="checkbox" name="enfermedad_mental"
                                                        value="{{ enfermedad_mental }}" id="input-enfermedad_mental"
                                                        checked>
                                                    {% else %}
                                                    <input type="checkbox" name="enfermedad_mental"
                                                        value="{{ enfermedad_mental }}" id="input-enfermedad_mental">
                                                    {% endif %}
                                                    <i></i>Demencia o enfermedad mental
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if neoplasias_f == 1 %}
                                                    <input type="checkbox" name="neoplasias_f"
                                                        value="{{ neoplasias_f }}" id="input-neoplasias_f" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="neoplasias_f"
                                                        value="{{ neoplasias_f }}" id="input-neoplasias_f">
                                                    {% endif %}
                                                    <i></i>Neoplasias
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripcion
                                                    Antecedentes</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-descripcion_antecedentes"
                                                        name="descripcion_antecedentes">{{ descripcion_antecedentes }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-3">

                                                <label class="checkbox">

                                                    {% if alergico == 1 %}
                                                    <input type="checkbox" name="alergico" value="{{ alergico }}"
                                                        id="input-alergico" checked>
                                                    {% else %}
                                                    <input type="checkbox" name="alergico" value="{{ alergico }}"
                                                        id="input-alergico">
                                                    {% endif %}

                                                    <i></i>Alergico Nombre

                                                </label>

                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-alergico_nombre" name="alergico_nombre"
                                                        placeholder="Alergico Nombre" value="{{ alergico_nombre }}">

                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" style="margin-bottom: 10px;">Nro. de hijos
                                                    vivos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_hijos_vivos" name="nro_hijos_vivos"
                                                        placeholder="Nro. de hijos vivos" value="{{ nro_hijos_vivos }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" style="margin-bottom: 10px;">Nro. de hijos
                                                    fallecidos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_hijos_fallecidos"
                                                        name="nro_hijos_fallecidos"
                                                        placeholder="Nro. de hijos fallecidos"
                                                        value="{{ nro_hijos_fallecidos }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" style="margin-bottom: 10px;">Fecha Última
                                                    Regla</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_ur" name="fecha_ur"
                                                        placeholder="Fecha Última Regla" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_ur }}">
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
                        <a href="javascript:void(0);" onclick="agregarMedicamento();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarMedicamento();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarMedicamento();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Medicamentos Frecuentes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_medicamentos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Medicamentos</th>
                                                <th data-hide="phone,tablet">Concentracion</th>
                                                <th data-hide="phone,tablet">Forma</th>
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
                        <a href="javascript:void(0);" onclick="agregarBucal();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarBucal();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarBucal();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Historia Clinica Bucal</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_bucal"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha Bucal</th>
                                                <th data-hide="phone,tablet">observaciones</th>
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
                        <a href="javascript:void(0);" onclick="agregarExamenes();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarExamenes();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarExamenes();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Historia Clinica Examen</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_examenes"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Examen</th>
                                                
                                                <th data-hide="phone,tablet">Fecha Examen</th>
                                                <th data-hide="phone,tablet">observaciones</th>
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
                        <a href="javascript:void(0);" onclick="agregarFiebre();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarFiebre();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarFiebre();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Historia Clinica Fiebre</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_fiebre"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha Fiebre</th>
                                                <th data-hide="phone,tablet">observaciones</th>
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
                        <a href="javascript:void(0);" onclick="agregarHabito();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarHabito();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarHabito();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Historia Clinica Habito</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_habitos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Habito</th>
                                                <th data-hide="phone,tablet">Fecha</th>
                                                <th data-hide="phone,tablet">observaciones</th>
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
                        <a href="javascript:void(0);" onclick="agregarTos();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarTos();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarTos();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Historia Clinica Tos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_tos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha Tos</th>
                                                <th data-hide="phone,tablet">observaciones</th>
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
                        <a href="javascript:void(0);" onclick="agregarVacunas();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarVacunas();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarVacunas();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Historia Clinica Vacunas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_dss_hc_vacunas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Vacuna</th>
                                                <th data-class="phone,tablet">Dosis</th>
                                                <th data-class="phone,tablet">Fecha Vacuna</th>
                                                <th data-hide="phone,tablet">Observaciones</th>
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
{{ form('registrohistoriasclinicas/saveHistoriasclinicasMedicamentos','method':
'post','id':'form_tbl_dss_hc_medicamentos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Medicamento</label>
            <select style="width:100%" id="input-hcm-id_medicamento" name="id_medicamento">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for medicamento_select in medicamentos %}

                    <option value="{{ medicamento_select.id_medicamento }}">{{
                        medicamento_select.medicamento }} - {{
                        medicamento_select.concentracion }} - {{medicamento_select.forma}}</option>

                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_medicamento">
            <p>
        </section>



        <section class="col col-md-12">
            <label class="text-info">Via</label>
            <label class="select">
                <select id="input-hcm-id_via" name="id_via">
                    <option value="">Seleccione</option>
                    {% for via in vias %}
                    <option value="{{ via.codigo }}">{{ via.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Dosis</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-hcm-dosis" name="dosis" placeholder="Dosis" value="">
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hcm-observaciones" name="observaciones"></textarea>
                <input type="hidden" id="input-hcm-id_hc_medicamento" name="id_hc_medicamento" value="">
                <input type="hidden" id="input-hcm-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

{{ form('registrohistoriasclinicas/saveBucal','method':
'post','id':'form_tbl_dss_hc_bucal','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">


        <section class="col col-md-6">
            <label class="text-info">Fecha Bucal</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-hcb-fecha_bucal"
                    name="fecha_bucal" placeholder="Fecha Bucal"
                    class="datepicker" data-dateformat='dd/mm/yy' tabindex="-1">
                    <input type="hidden" id="input-hcb-id_hc_bucal" name="id_hc_bucal" value="">
                    <input type="hidden" id="input-hcb-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>


        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="basal" value="" id="input-hcb-basal">
                <i></i>Basal
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hcb-observaciones" name="observaciones"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->


{{ form('registrohistoriasclinicas/saveExamen','method':
'post','id':'form_tbl_dss_hc_examenes','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-6">
            <label class="text-info">Examen</label>
            <label class="select">
                <select id="input-hce-id_examen" name="id_examen">
                    <option value="">Seleccione</option>
                    {% for examen in exameneslab %}
                    <option value="{{ examen.codigo }}">{{ examen.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Examen</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-hce-fecha_examen"
                    name="fecha_examen" placeholder="Fecha Examen"
                    class="datepicker" data-dateformat='dd/mm/yy' tabindex="-1">
                    <input type="hidden" id="input-hce-id_hc_examen" name="id_hc_examen" value="">
                    <input type="hidden" id="input-hce-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hce-observaciones" name="observaciones"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->


{{ form('registrohistoriasclinicas/saveFiebre','method':
'post','id':'form_tbl_dss_hc_fiebre','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">


        <section class="col col-md-6">
            <label class="text-info">Fecha Fiebre</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-hcf-fecha_fiebre"
                    name="fecha_fiebre" placeholder="Fecha Fiebre"
                    class="datepicker" data-dateformat='dd/mm/yy' tabindex="-1">
                    <input type="hidden" id="input-hcf-id_hc_fiebre" name="id_hc_fiebre" value="">
                    <input type="hidden" id="input-hcf-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>


        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="basal" value="" id="input-hcf-basal">
                <i></i>Basal
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hcf-observaciones" name="observaciones"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->


{{ form('registrohistoriasclinicas/saveHabitos','method':
'post','id':'form_tbl_dss_hc_habitos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-6">
            <label class="text-info">Habito</label>
            <label class="select">
                <select id="input-hce-id_habito" name="id_habito">
                    <option value="">Seleccione</option>
                    {% for habito in habitos %}
                    <option value="{{ habito.codigo }}">{{ habito.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Habito</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-hch-fecha_habito"
                    name="fecha_habito" placeholder="Fecha Habito"
                    class="datepicker" data-dateformat='dd/mm/yy' tabindex="-1">
                    <input type="hidden" id="input-hch-id_hc_habito" name="id_hc_habito" value="">
                    <input type="hidden" id="input-hch-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hch-observaciones" name="observaciones"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

{{ form('registrohistoriasclinicas/saveTos','method':
'post','id':'form_tbl_dss_hc_tos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">


        <section class="col col-md-6">
            <label class="text-info">Fecha Tos</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-hct-fecha_tos"
                    name="fecha_tos" placeholder="Fecha Tos"
                    class="datepicker" data-dateformat='dd/mm/yy' tabindex="-1">
                    <input type="hidden" id="input-hct-id_hc_tos" name="id_hc_tos" value="">
                    <input type="hidden" id="input-hct-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>


        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="basal" value="" id="input-hct-basal">
                <i></i>Basal
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hct-observaciones" name="observaciones"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

{{ form('registrohistoriasclinicas/saveVacunas','method':
'post','id':'form_tbl_dss_hc_vacunas','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Vacuna</label>
            <label class="select">
                <select id="input-hcv-id_vacuna" name="id_vacuna">
                    <option value="">Seleccione</option>
                    {% for vacuna in vacunas %}
                    <option value="{{ vacuna.codigo }}">{{ vacuna.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Dosis</label>
            <label class="select">
                <select id="input-hcv-id_dosis" name="id_dosis">
                    <option value="">Seleccione</option>
                    {% for dosis_select in dosis %}
                    <option value="{{ dosis_select.codigo }}">{{ dosis_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Vacuna</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-hcv-fecha_vacuna"
                    name="fecha_vacuna" placeholder="Fecha Vacuna"
                    class="datepicker" data-dateformat='dd/mm/yy' tabindex="-1">
                    <input type="hidden" id="input-hcv-id_hc_vacuna" name="id_hc_vacuna" value="">
                    <input type="hidden" id="input-hcv-id_hc" name="id_hc" value="{{ id_hc }}">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-hcv-observaciones" name="observaciones"></textarea>
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
<script type="text/javascript"> 
var id_hc = "{{ id_hc }}";
// console.log(id_hc)
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>