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

{% set txt_buton = "Registrar" %}
{% if postulantes.codigo is defined %}
    {% set codigo = postulantes.codigo %}
    {% set txt_buton = "Actualizar Datos" %}
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

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Postulante</li>
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
                                <h2>Información del Postulante ...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('datos/save_postulante','method': 'post','id':'form_postulantes','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Foto</label>
                                                <br>
                                                <img width="162" height="162" src="{{ url('adminpanel/imagenes/publico/'~foto) }}" onerror="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/user.png') }}';" ></img>
                                                
                                                <!--
                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <input type="file" id="foto_colegiado" name="foto" onchange="this.parentNode.nextSibling.value = this.value" style="pointer-events: none;">
                                                </div>
                                                -->
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
                                                    <select id="input-sexo"  name="sexo" style="pointer-events: none;">
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
                                                <label class="text-info" >Documento</label>
                                                <label class="select">
                                                    <select id="input-documento"  name="documento" style="pointer-events: none;">
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
                                                    <input type="text" id="input-nro_doc" name="nro_doc"  placeholder="DNI" value="{{ nro_doc }}" readonly="">                             
                                                </label>
                                            </section>


                                            
                                            <section class="col col-md-4">
                                                <label class="text-info" >Estado Civil</label>
                                                <label class="select">
                                                    <select id="input-estado_civil"  name="estado_civil">
                                                        <option value="" >Seleccione...</option>
                                                        {% for estadocivil_select in estadocivil %}
                                                            {% if estadocivil_select.codigo == estadocivil %}
                                                                <option selected="selected" value="{{ estadocivil_select.codigo }}">{{ estadocivil_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ estadocivil_select.codigo }}">{{ estadocivil_select.nombres }}</option>   
                                                            {% endif %}
                                                        {% endfor %}
                                                    </select> <i></i> 
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
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nombres"name="nombres" placeholder="Nombres" value="{{nombres }}" readonly="" >
                                                    <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellidop"name="apellidop" placeholder="Apellido Paterno" value="{{apellidop }}"  readonly="">                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellidom"name="apellidom" placeholder="Apellido Materno" value="{{apellidom }}"  readonly="">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Dirección Actual</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-direccion"name="direccion" placeholder="Dirección" value="{{direccion }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad" placeholder="Ciudad" value="{{ciudad }}"  >                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro"  name="seguro"  style="pointer-events: none;">
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

                                            <section class="col col-md-12">
                                                <label class="text-info" >Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-observaciones" name="observaciones" placeholder="Observaciones">{{ observaciones }}</textarea> 
                                                </label>
                                            </section>  




                                            <section class="col col-md-3">
                                                <label class="text-info" >Región (Domicilio)</label>
                                                <label class="select">
                                                    <select id="input-region"  name="region" >
                                                        <option value="" >Región</option>
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
                                                <label class="text-info" >Provincia (Domicilio)</label>
                                                <label class="select">
                                                    <select id="input-provincia"  name="provincia">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Distrito (Domicilio)</label>
                                                <label class="select">
                                                    <select id="input-distrito"  name="distrito">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Nro. Ubigeo (Domicilio)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                    <input type="text" id="input-ubigeo" name="ubigeo" placeholder="ubigeo" value="{{ ubigeo }}" >                                              
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Region (Lugar de nacimiento)</label>
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
                                                <label class="text-info" >Provincia (Lugar de nacimiento)</label>
                                                <label class="select">
                                                    <select id="input-provincia1"  name="provincia1">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Distrito (Lugar de nacimiento)</label>
                                                <label class="select">
                                                    <select id="input-distrito1"  name="distrito1">
                                                        <option value="" >SELECCIONE...</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Nro. Ubigeo (Lugar de nacimiento)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                    <input type="text" id="input-ubigeo1" name="ubigeo1" placeholder="ubigeo" value="{{ ubigeo1 }}" >                                              
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="checkbox">
                                                    {% if colegio_publico == 1 %}
                                                        <input type="checkbox" name="colegio_publico" value="{{ colegio_publico }}" id="colegio_publico" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="colegio_publico" value="{{ colegio_publico }}" id="colegio_publico">
                                                    {% endif %}

                                                    <i></i>Marcar si estudió en Colegio Público

                                                </label>
                                                <label class="text-info">Nombre Colegio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-colegio_nombre" name="colegio_nombre" placeholder="" value="{{ colegio_nombre }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
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
                                            <section class="col col-md-3">
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

                                            <section class="col col-md-3">
                                                <label class="checkbox">

                                                    {% if sidepende == 1 %}
                                                        <input type="checkbox" name="discapacitado" value="{{ discapacitado }}" id="discapacitado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="discapacitado" value="{{ discapacitado }}" id="discapacitado">
                                                    {% endif %}

                                                    <i></i>Discapacitado
                                                </label>
                                                <label class="text-info">Nombre de discapacidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-discapacitado_nombre" name="discapacitado_nombre" placeholder="" value="{{ discapacitado_nombre }}" >

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

<script type="text/javascript" >
    var codigo_colegiado = '{{ codigo }}';
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

</script>

<div class="hidden">
    <div id="save">
        <p>
            Se actualizó correctamente...
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