{% set codigo = "" %}

{% set apellido_paterno = "" %}
{% set apellido_materno = "" %}
{% set nombres = "" %}
{% set sexo = "" %}
{% set fecha_nacimiento = "" %}
{% set fecha_cip = "" %}
{% set documento_colegiados = "" %}
{% set nro_documento = "" %}

{% set consejo = "" %}
{% set capitulo = "" %}
{% set especialidad = "" %}
{% set habilitado = "" %}
{% set vive = "" %}
{% set direccion = "" %}
{% set referencia = "" %}
{% set ciudad = "" %}

{% set ubigeo = "" %}
{% set region = "" %}
{% set provincia = "" %}
{% set distrito = "" %}

{% set email = "" %}
{% set telefono = "" %}
{% set celular = "" %}


{% set seguro = "" %}

{% set observaciones = "" %}

{% set estado = "" %}

{% set facebook = "" %}
{% set twitter = "" %}
{% set red_social_otra = "" %}

{% set cv = "" %}
{% set nro_dependientes = "" %}
{% set emprendedor = "" %}
{% set entidad1 = "" %}
{% set entidad2 = "" %}
{% set entidad3 = "" %}
{% set foto = "" %}

{% set txt_buton = "Registrar" %}
{% if colegiados.codigo is defined %}
    {% set codigo = colegiados.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}


{% if colegiados.apellido_paterno is defined %}
    {% set apellido_paterno = colegiados.apellido_paterno %}
{% endif %}

{% if colegiados.apellido_materno is defined %}
    {% set apellido_materno = colegiados.apellido_materno %}
{% endif %}

{% if colegiados.nombres is defined %}
    {% set nombres = colegiados.nombres %}
{% endif %}


{% if colegiados.sexo is defined %}
    {% set sexo = colegiados.sexo %}
{% endif %}

{% if colegiados.fecha_nacimiento is defined %}
    {% set fecha_nacimiento = utilidades.fechita(colegiados.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if colegiados.fecha_cip is defined %}
    {% set fecha_cip = utilidades.fechita(colegiados.fecha_cip,'d/m/Y') %}
{% endif %}


{% if colegiados.documento is defined %}
    {% set documento_colegiados = colegiados.documento %}
{% endif %}

{% if colegiados.nro_documento is defined %}
    {% set nro_documento = colegiados.nro_documento %}
{% endif %}


{% if colegiados.consejo is defined %}
    {% set consejo = colegiados.consejo %}
{% endif %}

{% if colegiados.capitulo is defined %}
    {% set capitulo = colegiados.capitulo %}
{% endif %}

{% if colegiados.especialidad is defined %}
    {% set especialidad = colegiados.especialidad %}
{% endif %}

{% if colegiados.habilitado is defined %}
    {% set habilitado = colegiados.habilitado %}
{% endif %}

{% if colegiados.vive is defined %}
    {% set vive = colegiados.vive %}
{% endif %}

{% if colegiados.direccion is defined %}
    {% set direccion = colegiados.direccion %}
{% endif %}

{% if colegiados.referencia is defined %}
    {% set ciudad = colegiados.referencia %}
{% endif %}

{% if colegiados.ciudad is defined %}
    {% set ciudad = colegiados.ciudad %}
{% endif %}

{% if colegiados.telefono is defined %}
    {% set telefono = colegiados.telefono %}
{% endif %}

{% if colegiados.celular is defined %}
    {% set celular = colegiados.celular %}
{% endif %}

{% if colegiados.email is defined %}
    {% set email = colegiados.email %}
{% endif %}

{% if colegiados.seguro is defined %}
    {% set seguro = colegiados.seguro %}
{% endif %}

{% if colegiados.observaciones is defined %}
    {% set observaciones = colegiados.observaciones %}
{% endif %}

{% if colegiados.ubigeo is defined %}
    {% set ubigeo = colegiados.ubigeo %}
{% endif %}

{% if colegiados.region is defined %}
    {% set region = colegiados.region %}
{% endif %}

{% if colegiados.provincia is defined %}
    {% set provincia = colegiados.provincia %}
{% endif %}

{% if colegiados.distrito is defined %}
    {% set distrito = colegiados.distrito %}
{% endif %}

{% if colegiados.facebook is defined %}
    {% set facebook = colegiados.facebook %}
{% endif %}

{% if colegiados.twitter is defined %}
    {% set twitter = colegiados.twitter %}
{% endif %}

{% if colegiados.nro_dependientes is defined %}
    {% set nro_dependientes = colegiados.nro_dependientes %}
{% endif %}

{% if colegiados.red_social_otra is defined %}
    {% set red_social_otra = colegiados.red_social_otra %}
{% endif %}

{% if colegiados.cv is defined %}
    {% set cv = colegiados.cv %}
{% endif %}

{% if colegiados.emprendedor is defined %}
    {% set emprendedor = colegiados.emprendedor %}
{% endif %}

{% if colegiados.entidad1 is defined %}
    {% set entidad1 = colegiados.entidad1 %}
{% endif %}

{% if colegiados.entidad2 is defined %}
    {% set entidad2 = colegiados.entidad2 %}
{% endif %}

{% if colegiados.entidad3 is defined %}
    {% set entidad3 = colegiados.entidad3 %}
{% endif %}

{% if colegiados.foto is defined %}
    {% set foto = colegiados.foto %}
{% endif %}
{% if colegiados.estado is defined %}
    {% set estado = colegiados.estado %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Colegiado</li>
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
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"    
                             data-widget-custombutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                <h2>Información del Colegiado ...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('colegiados/save','method': 'post','id':'form_colegiados','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Foto</label>
                                                <br>
                                                <img width="162" height="162" src="{{ url('adminpanel/imagenes/colegiados/'~foto) }}" onerror="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/user.png') }}';" ></img>
                                                <br>
                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <input type="file" id="foto_colegiado" name="foto" onchange="this.parentNode.nextSibling.value = this.value">
                                                </div>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-codigo" name="codigo"  placeholder="Codigo" value="{{codigo }}"    {% if codigo !== "" %} readonly="" {% endif %} >                             
                                                </label>

                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info" >Fecha de nacimiento (dd-mm-aaaa)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nac." class="datepicker" data-dateformat='dd/mm/yy' value="{{  fecha_nacimiento }}">
                                                </label>

                                            </section>





                                            <section class="col col-md-4">
                                                {#<label class="label">Estado:</label>#}
                                                <div class="inline-group">
                                                    <label class="checkbox">
                                                        {% if habilitado == 1%}
                                                            <input type="checkbox" name="habilitado" value="{{ habilitado }}" checked="checked" id="input-habilitado">

                                                        {% elseif(habilitado == 0) %}
                                                            <input type="checkbox" name="habilitado" value="{{ habilitado }}" id="input-habilitado">
                                                        {% endif %}
                                                        <i></i>Habilitado</label>

                                                    <label class="checkbox">
                                                        {% if vive == 1 OR vive == '' %}
                                                            <input type="checkbox" name="vive" value="{{ vive }}" checked="checked" id="input-vive">

                                                        {% elseif(vive == 0) %}
                                                            <input type="checkbox" name="vive" value="{{ vive }}" id="input-vive">
                                                        {% endif %}
                                                        <i></i>Vive</label>

                                                    <label class="checkbox">
                                                        {% if estado == 'A' OR estado == '' %}                                                           
                                                            <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked> 
                                                        {% elseif(estado == 'X') %}
                                                            <input type="checkbox" name="estado" value="{{ estado }}" id="estado">
                                                        {% endif %}
                                                        <i></i>Estado</label>

                                                </div>
                                            </section>



                                            <section class="col col-md-4">

                                                <label class="text-info" >Fecha de cip (dd-mm-aaaa)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_cip" name="fecha_cip" placeholder="Fecha Cip." class="datepicker" data-dateformat='dd/mm/yy' value="{{  fecha_cip }}">
                                                </label>

                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Sexo</label>
                                                <label class="select">
                                                    <select id="input-sexo"  name="sexo" >
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
                                                    <select id="input-documento"  name="documento" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for documentocolegiado in documentocolegiados %}
                                                            {% if documentocolegiado.codigo == documento_colegiados %}
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
                                                    <input type="text" id="input-nro_documento" name="nro_documento"  placeholder="DNI" value="{{ nro_documento }}" >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro"  name="seguro" >
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

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nombres"name="nombres" placeholder="Nombres" value="{{nombres }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellido_paterno"name="apellido_paterno" placeholder="Apellido Paterno" value="{{apellido_paterno }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellido_materno"name="apellido_materno" placeholder="Apellido Materno" value="{{apellido_materno }}"  >                             
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
                                                <label class="input"> <i class="icon-prepend fa fa-mobile-phone"></i>
                                                    <input type="text" id="input-email" name="email"  placeholder="Email" value="{{email }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Dirección Actual</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-direccion"name="direccion" placeholder="Dirección" value="{{direccion }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Referencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-referencia" name="referencia" placeholder="Referencia" value="{{referencia }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad" placeholder="Ciudad" value="{{ciudad }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Consejo de Procedencia</label>
                                                <label class="select">
                                                    <select id="input-consejo"  name="consejo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for consejo_i in consejos %}
                                                            {% if consejo_i.codigo == consejo %}
                                                                <option selected="selected" value="{{ consejo_i.codigo }}">{{ consejo_i.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ consejo_i.codigo }}">{{ consejo_i.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Capítulo</label>
                                                <label class="select">
                                                    <select id="input-capitulo"  name="capitulo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for capitulo_i in capitulos %}
                                                            {% if capitulo_i.codigo == capitulo %}
                                                                <option selected="selected" value="{{ capitulo_i.codigo }}">{{ capitulo_i.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ capitulo_i.codigo }}">{{ capitulo_i.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Especialidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-envelope"></i>
                                                    <input type="text" id="input-especialidad" name="especialidad" placeholder="Especialidad" value="{{ especialidad }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-observaciones" name="observaciones" placeholder="Observaciones">{{ observaciones }}</textarea> 
                                                </label>
                                            </section>  




                                            <section class="col col-md-4">
                                                <label class="text-info" >Region</label>
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

                                            <section class="col col-md-4">
                                                <label class="text-info" >Provincia</label>
                                                <label class="select">
                                                    <select id="input-provincia"  name="provincia">
                                                        <option value="" >Provincia</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Distrito</label>
                                                <label class="select">
                                                    <select id="input-distrito"  name="distrito">
                                                        <option value="" >Distrito</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Ubigeo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                    <input type="text" id="input-ubigeo" name="ubigeo" placeholder="ubigeo" value="{{ ubigeo }}" >                                              
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Facebook</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-facebook"name="facebook" placeholder="Facebook" value="{{facebook }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Twitter</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-twitter"name="twitter" placeholder="Twitter" value="{{twitter }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Otra Red Social</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-red_social_otra"name="red_social_otra" placeholder="red_social_otra" value="{{red_social_otra }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info">Emprendedor</label>
                                                <div class="inline-group">
                                                    {% if emprendedor == 1 %}
                                                        <label class="radio">
                                                            <input name="emprendedor" value="1" type="radio" name="radio-inline" checked="checked" >
                                                            <i></i>Si
                                                        </label>

                                                        <label class="radio">
                                                            <input name="emprendedor" value="0" type="radio" name="radio-inline" >
                                                            <i></i>No
                                                        </label>
                                                    {% elseif(emprendedor == 0) %}
                                                        <label class="radio">
                                                            <input name="emprendedor" value="1" type="radio" name="radio-inline" >
                                                            <i></i>Si
                                                        </label>

                                                        <label class="radio">
                                                            <input name="emprendedor" value="0" type="radio" name="radio-inline" checked="checked" >
                                                            <i></i>No
                                                        </label>
                                                    {% endif %}

                                                </div>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Número de hijos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nro_dependientes"name="nro_dependientes" placeholder="Número de hijos" value="{{nro_dependientes }}"  >                             
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info" >Entidad donde labora</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-entidad1"name="entidad1" placeholder="Entidad 1" value="{{entidad1 }}"  >                             
                                                </label>
                                                <br>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-entidad2"name="entidad2" placeholder="Entidad 2" value="{{entidad2 }}"  >                             
                                                </label>
                                                <br>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-entidad3"name="entidad3" placeholder="Entidad 3" value="{{entidad3 }}"  >                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >CV por defecto</label>
                                                <div class="input input-file">
                                                    <input id="input-cv" type="file" name="cv" onchange="this.parentNode.nextSibling.value = this.value">
                                                </div>
                                                <br>                                        
                                                {% if cv  %}
                                                    <div class="alert alert-info fade in">                                                        
                                                        <i class="fa-fw fa fa-info"></i>
                                                        Tienes un CV por defecto 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('colegiados/descargacv/'~colegiados.codigo) }}" > Descargar mi CV </a>
                                                    </div>

                                                {% else %}
                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no se ha subido un CV por defecto
                                                    </div>
                                                {% endif %}

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
<div class="hidden">
    <div id="exito_colegiado">
        <p>
            Se actualizo correctamente...
        </p>
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
    <div id="codigo_colegiado_vacio">
        <p>
            Debe ingresar un codigo valido...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_colegiado_registrada">
        <p>
            Codigo registrado...
        </p>
    </div>
</div>


<script type="text/javascript" >


    var publica = "si";

    //Ubigeo
    var region_id = '{{ region }}';
    var provincia_id = '{{ provincia }}';
    var distrito_id = '{{ distrito }}';


</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>