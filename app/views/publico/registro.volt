{% set codigo = "" %}

{% set apellidop = "" %}
{% set apellidom = "" %}
{% set nombres = "" %}
{% set sexo = "" %}
{% set fecha_nacimiento = "" %}
{% set documento_postulantes = "" %}
{% set nro_doc = "" %}
{% set direccion = "" %}
{% set ciudad = "" %}
{% set localidad = "" %}
{% set ubigeo = "" %}
{% set region = "" %}
{% set provincia = "" %}
{% set distrito = "" %}
{% set ubigeo1 = "" %}
{% set region1 = "" %}
{% set provincia1 = "" %}
{% set distrito1 = "" %}
{% set email = "" %}
{% set telefono = "" %}
{% set celular = "" %}

{% set colegio_publico = "" %}
{% set colegio_nombre = "" %}
{% set sitrabaja = "" %}
{% set sitrabaja_nombre = "" %}
{% set sidepende  = "" %}
{% set sidepende_nombre = "" %}
{% set discapacitado = "" %}
{% set discapacitado_nombre = "" %}

{% set seguro = "" %}
{% set observaciones = "" %}
{% set estado = "" %}
{% set foto = "" %}

{% set archivo = "" %}
{% if postulantes.archivo is defined %}
    {% set archivo = postulantes.archivo %}
{% endif %}

{% set archivo_cp = "" %}
{% if postulantes.archivo_cp is defined %}
    {% set archivo_cp = postulantes.archivo_cp %}
{% endif %}

{% set archivo_ruc = "" %}
{% if postulantes.archivo_ruc is defined %}
    {% set archivo_ruc = postulantes.archivo_ruc %}
{% endif %}

{% set txt_buton = "Registrar" %}
{% if postulantes.codigo is defined %}
    {% set codigo = postulantes.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}


{% if postulantes.apellidop is defined %}
    {% set apellidop = postulantes.apellidop %}
{% endif %}

{% if postulantes.apellidom is defined %}
    {% set apellidom = postulantes.apellidom %}
{% endif %}

{% if postulantes.nombres is defined %}
    {% set nombres = postulantes.nombres %}
{% endif %}


{% if postulantes.sexo is defined %}
    {% set sexo = postulantes.sexo %}
{% endif %}

{% if postulantes.fecha_nacimiento is defined %}
    {% set fecha_nacimiento = utilidades.fechita(postulantes.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if postulantes.documento is defined %}
    {% set documento_postulantes = postulantes.documento %}
{% endif %}

{% if postulantes.nro_doc is defined %}
    {% set nro_doc = postulantes.nro_doc %}
{% endif %}

{% if postulantes.direccion is defined %}
    {% set direccion = postulantes.direccion %}
{% endif %}

{% if postulantes.ciudad is defined %}
    {% set ciudad = postulantes.ciudad %}
{% endif %}

{% if postulantes.localidad is defined %}
    {% set localidad = postulantes.localidad %}
{% endif %}

{% if postulantes.telefono is defined %}
    {% set telefono = postulantes.telefono %}
{% endif %}

{% if postulantes.celular is defined %}
    {% set celular = postulantes.celular %}
{% endif %}

{% if postulantes.email is defined %}
    {% set email = postulantes.email %}
{% endif %}

{% if postulantes.seguro is defined %}
    {% set seguro = postulantes.seguro %}
{% endif %}

{% if postulantes.observaciones is defined %}
    {% set observaciones = postulantes.observaciones %}
{% endif %}



{% if postulantes.region is defined %}
    {% set region = postulantes.region %}
{% endif %}

{% if postulantes.provincia is defined %}
    {% set provincia = postulantes.provincia %}
{% endif %}

{% if postulantes.distrito is defined %}
    {% set distrito = postulantes.distrito %}
{% endif %}

{% if postulantes.ubigeo is defined %}
    {% set ubigeo = postulantes.ubigeo %}
{% endif %}


{% if postulantes.region1 is defined %}
    {% set region1 = postulantes.region1 %}
{% endif %}

{% if postulantes.provincia1 is defined %}
    {% set provincia1 = postulantes.provincia1 %}
{% endif %}

{% if postulantes.distrito1 is defined %}
    {% set distrito1 = postulantes.distrito1 %}
{% endif %}

{% if postulantes.ubigeo1 is defined %}
    {% set ubigeo1 = postulantes.ubigeo1 %}
{% endif %}

{% if postulantes.foto is defined %}
    {% set foto = postulantes.foto %}
{% endif %}

{% if postulantes.colegio_publico is defined %}
    {% set colegio_publico = postulantes.colegio_publico %}
{% endif %}

{% if postulantes.colegio_nombre is defined %}
    {% set colegio_nombre = postulantes.colegio_nombre %}
{% endif %}


{% if postulantes.sitrabaja is defined %}
    {% set sitrabaja = postulantes.sitrabaja %}
{% endif %}

{% if postulantes.sitrabaja_nombre is defined %}
    {% set sitrabaja_nombre = postulantes.sitrabaja_nombre %}
{% endif %}

{% if postulantes.sidepende is defined %}
    {% set sidepende = postulantes.sidepende %}
{% endif %}

{% if postulantes.sidepende_nombre is defined %}
    {% set sidepende_nombre = postulantes.sidepende_nombre %}
{% endif %}

{% if postulantes.discapacitado is defined %}
    {% set discapacitado = postulantes.discapacitado %}
{% endif %}

{% if postulantes.discapacitado_nombre is defined %}
    {% set discapacitado_nombre = postulantes.discapacitado_nombre %}
{% endif %}



{% if postulantes.estado is defined %}
    {% set estado = postulantes.estado %}
{% endif %}

{% set colegio_profesional = "" %}
{% if postulantes.colegio_profesional is defined %}
    {% set colegio_profesional = postulantes.colegio_profesional %}
{% endif %}

{% set colegio_profesional_nro = "" %}
{% if postulantes.colegio_profesional_nro is defined %}
    {% set colegio_profesional_nro = postulantes.colegio_profesional_nro %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Publico</li>
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
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"    
                             data-widget-custombutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Información del Publico ...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('publico/save','method': 'post','id':'form_postulantes','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Imagen del Público</label>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_publico"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                <div id="imagen_publico" class="collapse">

                                                    {% if foto !== ""   %}
                                                        <img class="img-responsive" src="{{ url('adminpanel/imagenes/imagenes_publico/'~foto) }}" error="this.onerror=null;this.src='';"></img>
                                                    {% else %}

                                                        <div class="alert alert-warning fade in">                                                       
                                                            <i class="fa-fw fa fa-warning"></i>
                                                            <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                        </div>

                                                    {% endif %}
                                                </div>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Documento</label>
                                                <label class="select">
                                                    <select id="input-documento"  name="documento">
                                                        <option value="" >Seleccione...</option>
                                                        {% for documentocolegiado in documentopostulantes %}
                                                            {% if documentocolegiado.codigo == documento_postulantes %}
                                                                <option selected="selected" value="{{ documentocolegiado.codigo }}">{{ documentocolegiado.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ documentocolegiado.codigo }}">{{ documentocolegiado.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nro. Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc"  placeholder="DNI" value="{{ nro_doc }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellidop"name="apellidop" placeholder="Apellido Paterno" value="{{apellidop }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellidom"name="apellidom" placeholder="Apellido Materno" value="{{apellidom }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nombres"name="nombres" placeholder="Nombres" value="{{nombres }}">
                                                    <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                    <input type="hidden" id="input-estado_registrado" name="estado_registrado" value="{{ estado }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Teléfono</label>
                                                <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                    <input type="text" id="input-telefono" name="telefono"  placeholder="Teléfono" value="{{telefono }}"  >                             
                                                </label>                                                
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-mobile-phone"></i>
                                                    <input type="text" id="input-celular" name="celular"  placeholder="Celular" value="{{celular }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Email</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email" name="email"  placeholder="Email" value="{{email }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info" >Fecha de nacimiento (dd-mm-aaaa)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nac." class="datepicker" data-dateformat='dd/mm/yy' value="{{  fecha_nacimiento }}">
                                                </label>

                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Sexo</label>
                                                <label class="select">
                                                    <select id="input-sexo"  name="sexo">
                                                        <option value="" >Seleccione...</option>
                                                        {% for sexo_model in sexos %}
                                                            {% if sexo_model.codigo == sexo %}
                                                                <option selected="selected" value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section> 


                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro"  name="seguro">
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for seguro_i in seguros %}
                                                            {% if seguro_i.codigo == seguro %}
                                                                <option selected="selected" value="{{ seguro_i.codigo }}">{{ seguro_i.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ seguro_i.codigo }}">{{ seguro_i.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>


                                            <section class="col col-md-8">
                                                <label class="text-info" >Dirección Actual</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-direccion"name="direccion" placeholder="Dirección" value="{{direccion }}" >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad" placeholder="Ciudad" value="{{ciudad }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Region (Ubigeo)</label>
                                                <label class="select">
                                                    <select id="input-region"  name="region" >
                                                        <option value="" >Region</option>
                                                        {% for reg in regiones %}
                                                            {% if reg.region == region %}
                                                                <option selected="selected" value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Provincia (Ubigeo)</label>
                                                <label class="select">
                                                    <select id="input-provincia"  name="provincia">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Distrito (Ubigeo)</label>
                                                <label class="select">
                                                    <select id="input-distrito"  name="distrito">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Nro. Ubigeo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                    <input type="text" id="input-ubigeo" name="ubigeo" placeholder="ubigeo" value="{{ ubigeo }}" >                                              
                                                </label>
                                            </section>
                                            

                                            <section class="col col-md-12">
                                                <label class="text-info" >Localidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-localidad" name="localidad" placeholder="localidad" value="{{localidad }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Region (Lugar de procedencia)</label>
                                                <label class="select">
                                                    <select id="input-region1"  name="region1" >
                                                        <option value="" >Region</option>
                                                        {% for reg in regiones %}
                                                            {% if reg.region == region1 %}
                                                                <option selected="selected" value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Provincia (Lugar de procedencia)</label>
                                                <label class="select">
                                                    <select id="input-provincia1"  name="provincia1">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Distrito (Lugar de procedencia)</label>
                                                <label class="select">
                                                    <select id="input-distrito1"  name="distrito1">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Nro. Ubigeo (Lugar de procedencia)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                    <input type="text" id="input-ubigeo1" name="ubigeo1" placeholder="ubigeo" value="{{ ubigeo1 }}" >                                              
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="checkbox">
                                                    {% if colegio_publico == 1 %}
                                                        <input type="checkbox" name="colegio_publico" value="{{ colegio_publico }}" id="colegio_publico" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="colegio_publico" value="{{ colegio_publico }}" id="colegio_publico">
                                                    {% endif %}

                                                    <i></i>Colegio Público

                                                </label>
                                                <label class="text-info">Nombre Colegio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-colegio_nombre" name="colegio_nombre" placeholder="" value="{{ colegio_nombre }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="checkbox">

                                                    {% if sitrabaja == 1 %}
                                                        <input type="checkbox" name="sitrabaja" value="{{ sitrabaja }}" id="sitrabaja" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="sitrabaja" value="{{ sitrabaja }}" id="sitrabaja">
                                                    {% endif %}

                                                    <i></i>Si trabaja
                                                </label>
                                                <label class="text-info">Nombre si trabaja</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-sitrabaja_nombre" name="sitrabaja_nombre" placeholder="" value="{{ sitrabaja_nombre }}" >

                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="checkbox">

                                                    {% if sidepende == 1 %}
                                                        <input type="checkbox" name="sidepende" value="{{ sidepende }}" id="sidepende" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="sidepende" value="{{ sidepende }}" id="sidepende">
                                                    {% endif %}

                                                    <i></i>Si depende
                                                </label>
                                                <label class="text-info">Nombre si depende</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-sidepende_nombre" name="sidepende_nombre" placeholder="" value="{{ sidepende_nombre }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="checkbox">

                                                    {% if discapacitado == 1 %}
                                                        <input type="checkbox" name="discapacitado" value="{{ discapacitado }}" id="discapacitado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="discapacitado" value="{{ discapacitado }}" id="discapacitado">
                                                    {% endif %}

                                                    <i></i>Discapacitado
                                                </label>
                                                <label class="text-info">Nombre discapacidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-discapacitado_nombre" name="discapacitado_nombre" placeholder="" value="{{ discapacitado_nombre }}" >

                                                </label>
                                            </section>
                                            
                                            <section class="col col-md-6">
                                                <label class="text-info" >Colegio Profesional</label>
                                                <label class="select">
                                                    <select id="input-colegio_profesional"  name="colegio_profesional" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for c_p in colegioprofesional %}
                                                            {% if c_p.codigo == colegio_profesional %}
                                                                <option selected="selected" value="{{ c_p.codigo }}">{{ c_p.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ c_p.codigo }}">{{ c_p.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Colegio Profesional Número</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-colegio_profesional_nro" name="colegio_profesional_nro" placeholder="Colegio Profesional Número" value="{{ colegio_profesional_nro }}" >
                                                </label>
                                            </section>
                                                
                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo (Copia DNI)</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/publico/personales/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>
                                            
                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo (Subir Ficha RUC)</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo_ruc" type="file" name="archivo_ruc" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo_ruc !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/publico/personales/'~archivo_ruc) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo (Subir Certificado de Habilidad)</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo_cp" type="file" name="archivo_cp" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo_cp !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/publico/personales/'~archivo_cp) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>
                                                
                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if foto !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver la imagen 
                                                        <a  href="javascript:void(0);" class="btn btn-ribbon" role="button" onclick="imagen_registro();">  <i class="fa-fw fa fa-image"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-observaciones" name="observaciones" placeholder="Observaciones">{{ observaciones }}</textarea> 
                                                </label>
                                            </section>  



                                        </div>



                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
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
<!-- Modal Registro Imagen -->
<div class="modal fade" id="modal_registro_imagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Imagen</h4>
            </div>
            <div class="modal-body">
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/imagenes_publico/'~foto) }}" error="this.onerror=null;this.src='';"></img>
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
<script type="text/javascript" >
    var codigo_colegiado = '{{ codigo }}';
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

</script>

<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente su postulación...
        </p>
    </div>
</div>


<script type="text/javascript" >


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
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>