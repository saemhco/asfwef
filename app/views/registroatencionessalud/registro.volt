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

{% set temperatura = "" %}
{% if atenciones.temperatura is defined %}
{% set temperatura = atenciones.temperatura %}
{% endif %}

{% set peso = "" %}
{% if atenciones.peso is defined %}
{% set peso = atenciones.peso %}
{% endif %}

{% set talla = "" %}
{% if atenciones.talla is defined %}
{% set talla = atenciones.talla %}
{% endif %}

{% set pa = "" %}
{% if atenciones.pa is defined %}
{% set pa = atenciones.pa %}
{% endif %}

{% set fc = "" %}
{% if atenciones.fc is defined %}
{% set fc = atenciones.fc %}
{% endif %}

{% set oximetria = "" %}
{% if atenciones.oximetria is defined %}
{% set oximetria = atenciones.oximetria %}
{% endif %}

{% set fr = "" %}
{% if atenciones.fr is defined %}
{% set fr = atenciones.fr %}
{% endif %}

{% set musculo = "" %}
{% if atenciones.musculo is defined %}
{% set musculo = atenciones.musculo %}
{% endif %}

{% set calorias = "" %}
{% if atenciones.calorias is defined %}
{% set calorias = atenciones.calorias %}
{% endif %}

{% set consumo_agua = "" %}
{% if atenciones.consumo_agua is defined %}
{% set consumo_agua = atenciones.consumo_agua %}
{% endif %}

{% set grasa_corporal = "" %}
{% if atenciones.grasa_corporal is defined %}
{% set grasa_corporal = atenciones.grasa_corporal %}
{% endif %}

{% set imc = "" %}
{% if atenciones.imc is defined %}
{% set imc = atenciones.imc %}
{% endif %}

{% set edad_corporal = "" %}
{% if atenciones.edad_corporal is defined %}
{% set edad_corporal = atenciones.edad_corporal %}
{% endif %}

{% set grasa_visceral = "" %}
{% if atenciones.grasa_visceral is defined %}
{% set grasa_visceral = atenciones.grasa_visceral %}
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
                                    {{ form('registroatencionessalud/save','method':
                                    'post','id':'form_atenciones','class':'smart-form','enctype':'multipart/form-data')
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
                                                <a href="{{ url('registrohistoriasclinicas/registro/'~nro_doc) }}" type="button" class="btn btn-sm  btn-block btn-warning">
                                                    <i class="fa fa-table"></i>  Historia
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
                                        <strong style="font-size: 14px;">Atenccion</strong>
                                    </p>
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



                                            <section class="col col-md-2">
                                                <label class="text-info">Edad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-edad" name="edad" placeholder="Edad"
                                                        value="{{ edad }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Tiempo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-tiempo" name="tiempo"
                                                        placeholder="Tiempo" value="{{ tiempo }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Motivo</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-motivo"
                                                        name="motivo">{{ motivo }}</textarea>
                                                </label>
                                            </section>




                                            <section class="col col-md-3">
                                                <label class="text-info">Apetito</label>
                                                <label class="select">
                                                    <select id="input-id_apetito" name="id_apetito">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for apetito in apetitos %}
                                                        {% if apetito.codigo == id_apetito
                                                        %}
                                                        <option selected="selected" value="{{ apetito.codigo }}">{{
                                                            apetito.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ apetito.codigo }}">{{
                                                            apetito.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Sed</label>
                                                <label class="select">
                                                    <select id="input-id_sed" name="id_sed">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for sed in seds %}
                                                        {% if sed.codigo == id_sed
                                                        %}
                                                        <option selected="selected" value="{{ sed.codigo }}">{{
                                                            sed.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ sed.codigo }}">{{
                                                            sed.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>





                                            <section class="col col-md-3">
                                                <label class="text-info">Sueño</label>
                                                <label class="select">
                                                    <select id="input-id_sueno" name="id_sueno">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for suenio in suenios %}

                                                        {% if suenio.codigo == id_sueno %}
                                                        <option selected="selected" value="{{ suenio.codigo }}">{{
                                                            suenio.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ suenio.codigo }}">{{
                                                            suenio.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>




                                            <section class="col col-md-3">
                                                <label class="text-info">Animo</label>
                                                <label class="select">
                                                    <select id="input-id_animo" name="id_animo">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for animo in animos %}
                                                        {% if animo.codigo == id_animo
                                                        %}
                                                        <option selected="selected" value="{{ animo.codigo }}">{{
                                                            animo.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ animo.codigo }}">{{
                                                            animo.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Orina</label>
                                                <label class="select">
                                                    <select id="input-id_orina" name="id_orina">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for orina in orinas %}
                                                        {% if orina.codigo == id_orina
                                                        %}
                                                        <option selected="selected" value="{{ orina.codigo }}">{{
                                                            orina.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ orina.codigo }}">{{
                                                            orina.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>




                                            <section class="col col-md-3">
                                                <label class="text-info">Deposicion</label>
                                                <label class="select">
                                                    <select id="input-id_deposicion" name="id_deposicion">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for deposicion in deposiciones %}
                                                        {% if deposicion.codigo == id_deposicion
                                                        %}
                                                        <option selected="selected" value="{{ deposicion.codigo }}">{{
                                                            deposicion.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ deposicion.codigo }}">{{
                                                            deposicion.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info">Eva</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-eva" name="eva" placeholder="Eva"
                                                        value="{{ eva }}">
                                                </label>
                                            </section>



                                            <section class="col col-md-6">
                                                <label class="text-info">Referencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-referencia" name="referencia"
                                                        placeholder="Referencia" value="{{ referencia }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Lugar</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-lugar" name="lugar" placeholder="Lugar"
                                                        value="{{ lugar }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-observaciones"
                                                        name="observaciones">{{ observaciones }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Temperatura</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-temperatura" name="temperatura" placeholder="Temperatura"
                                                        value="{{ temperatura }}">
                                                </label>
                                            </section>

                                            
                                            <section class="col col-md-2">
                                                <label class="text-info">Peso</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-peso" name="peso" placeholder="Peso"
                                                        value="{{ peso }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Talla</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-talla" name="talla" placeholder="Talla"
                                                        value="{{ talla }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Pa</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pa" name="pa" placeholder="Pa"
                                                        value="{{ pa }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Fc</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-fc" name="fc" placeholder="Fc"
                                                        value="{{ fc }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Oximetria</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-oximetria" name="oximetria" placeholder="Oximetria"
                                                        value="{{ oximetria }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Fr</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-fr" name="fr" placeholder="Fr"
                                                        value="{{ fr }}">
                                                </label>
                                            </section>

                                            
                                            <section class="col col-md-2">
                                                <label class="text-info">Musculo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-musculo" name="musculo" placeholder="Musculo"
                                                        value="{{ musculo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Calorias</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-calorias" name="calorias" placeholder="Calorias"
                                                        value="{{ calorias }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Consumo Agua</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-consumo_agua" name="consumo_agua" placeholder="Consumo Agua"
                                                        value="{{ consumo_agua }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Grasa Corporal</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grasa_corporal" name="grasa_corporal" placeholder="Grasa Corporal"
                                                        value="{{ grasa_corporal }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Imc</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-imc" name="imc" placeholder="IMC"
                                                        value="{{ imc }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Edad Corporal</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-edad_corporal" name="edad_corporal" placeholder="Edad Corporal"
                                                        value="{{ edad_corporal }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">Grasa viseral</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grasa_visceral" name="grasa_visceral" placeholder="Grasa viseral"
                                                        value="{{ grasa_visceral }}">
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
                        <a href="javascript:void(0);" onclick="agregarCie10();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editarCie10();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminarCie10();" class="btn btn-danger btn-block"><i
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
                                <h2>Atenciones Cie10</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_atencion_cie10"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Cie10</th>
                                                <th data-hide="phone,tablet">Descripcion</th>
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
                                <h2>Atenciones Medicamentos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_atencion_medicamento"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Medicamentos</th>
                                                <th>Cantidad</th>
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

    {% endif %}

</div>

<!--Formulario de registro detalle-->
{{ form('registroatencionessalud/saveAtencionesMedicamentos','method':
'post','id':'form_atencion_medicamento','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Medicamento</label>
            <select style="width:100%" id="input-am-id_medicamento" name="id_medicamento">
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
            <label class="text-info">Cantidad</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-am-cantidad" name="cantidad" placeholder="Cantidad">
                <input type="hidden" id="input-am-id_atencion_medicamento" name="id_atencion_medicamento" value="">
                <input type="hidden" id="input-am-id_atencion" name="id_atencion" value="{{ id_atencion }}">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Via</label>
            <label class="select">
                <select id="input-am-id_via" name="id_via">
                    <option value="">Seleccione</option>
                    {% for via in vias %}
                    <option value="{{ via.codigo }}">{{ via.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="recibido" value="" id="input-am-recibido">
                <i></i>Recibido
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Dosis</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-am-dosis" name="dosis" placeholder="Dosis" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Frecuencia</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-am-frecuencia" name="frecuencia" placeholder="Dosis" value="">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Duracion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-am-duracion" name="duracion" placeholder="Duracion" value="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-am-observaciones" name="observaciones"></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->

<!--Formulario de registro detalle-->
{{ form('registroatencionessalud/saveAtencionesCie10','method':
'post','id':'form_atencion_cie10','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Cie10</label>
            <select style="width:100%" id="input-ac-id_cie10" name="id_cie10">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for cie10_select in cie10 %}

                    <option value="{{ cie10_select.id_cie10 }}">
                        {{cie10_select.cie10 }} - {{cie10_select.descripcion }}
                    </option>

                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_atencion_cie10">
            <p>
        </section>



        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-ac-observaciones" name="observaciones"></textarea>
                <input type="hidden" id="input-ac-id_atencion_cie10" name="id_atencion_cie10" value="">
                <input type="hidden" id="input-ac-id_atencion" name="id_atencion" value="{{ id_atencion }}">
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