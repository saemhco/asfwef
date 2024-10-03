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
{% if publico.archivo is defined %}
    {% set archivo = publico.archivo %}
{% endif %}

{% set txt_buton = "Registrar" %}
{% if publico.codigo is defined %}
    {% set codigo = publico.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}


{% if publico.apellidop is defined %}
    {% set apellidop = publico.apellidop %}
{% endif %}

{% if publico.apellidom is defined %}
    {% set apellidom = publico.apellidom %}
{% endif %}

{% if publico.nombres is defined %}
    {% set nombres = publico.nombres %}
{% endif %}


{% if publico.sexo is defined %}
    {% set sexo = publico.sexo %}
{% endif %}

{% if publico.fecha_nacimiento is defined %}
    {% set fecha_nacimiento = utilidades.fechita(publico.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if publico.documento is defined %}
    {% set documento_postulantes = publico.documento %}
{% endif %}

{% if publico.nro_doc is defined %}
    {% set nro_doc = publico.nro_doc %}
{% endif %}

{% if publico.direccion is defined %}
    {% set direccion = publico.direccion %}
{% endif %}

{% if publico.ciudad is defined %}
    {% set ciudad = publico.ciudad %}
{% endif %}

{% if publico.localidad is defined %}
    {% set localidad = publico.localidad %}
{% endif %}

{% if publico.telefono is defined %}
    {% set telefono = publico.telefono %}
{% endif %}

{% if publico.celular is defined %}
    {% set celular = publico.celular %}
{% endif %}

{% if publico.email is defined %}
    {% set email = publico.email %}
{% endif %}

{% if publico.seguro is defined %}
    {% set seguro = publico.seguro %}
{% endif %}

{% if publico.observaciones is defined %}
    {% set observaciones = publico.observaciones %}
{% endif %}



{% if publico.region is defined %}
    {% set region = publico.region %}
{% endif %}

{% if publico.provincia is defined %}
    {% set provincia = publico.provincia %}
{% endif %}

{% if publico.distrito is defined %}
    {% set distrito = publico.distrito %}
{% endif %}

{% if publico.ubigeo is defined %}
    {% set ubigeo = publico.ubigeo %}
{% endif %}


{% if publico.region1 is defined %}
    {% set region1 = publico.region1 %}
{% endif %}

{% if publico.provincia1 is defined %}
    {% set provincia1 = publico.provincia1 %}
{% endif %}

{% if publico.distrito1 is defined %}
    {% set distrito1 = publico.distrito1 %}
{% endif %}

{% if publico.ubigeo1 is defined %}
    {% set ubigeo1 = publico.ubigeo1 %}
{% endif %}

{% if publico.foto is defined %}
    {% set foto = publico.foto %}
{% endif %}

{% if publico.colegio_publico is defined %}
    {% set colegio_publico = publico.colegio_publico %}
{% endif %}

{% if publico.colegio_nombre is defined %}
    {% set colegio_nombre = publico.colegio_nombre %}
{% endif %}


{% if publico.sitrabaja is defined %}
    {% set sitrabaja = publico.sitrabaja %}
{% endif %}

{% if publico.sitrabaja_nombre is defined %}
    {% set sitrabaja_nombre = publico.sitrabaja_nombre %}
{% endif %}

{% if publico.sidepende is defined %}
    {% set sidepende = publico.sidepende %}
{% endif %}

{% if publico.sidepende_nombre is defined %}
    {% set sidepende_nombre = publico.sidepende_nombre %}
{% endif %}

{% if publico.discapacitado is defined %}
    {% set discapacitado = publico.discapacitado %}
{% endif %}

{% if publico.discapacitado_nombre is defined %}
    {% set discapacitado_nombre = publico.discapacitado_nombre %}
{% endif %}

{% if publico.estado is defined %}
    {% set estado = publico.estado %}
{% endif %}

{% set colegio_profesional = "" %}
{% if publico.colegio_profesional is defined %}
    {% set colegio_profesional = publico.colegio_profesional %}
{% endif %}

{% set colegio_profesional_nro = "" %}
{% if publico.colegio_profesional_nro is defined %}
    {% set colegio_profesional_nro = publico.colegio_profesional_nro %}
{% endif %}

{% set nro_ruc = "" %}
{% if publico.nro_ruc is defined %}
    {% set nro_ruc = publico.nro_ruc %}
{% endif %}


{% set estado_civil = "" %}
{% if publico.estado_civil is defined %}
    {% set estado_civil = publico.estado_civil %}
{% endif %}

{% set archivo_cp = "" %}
{% if publico.archivo_cp is defined %}
    {% set archivo_cp = publico.archivo_cp %}
{% endif %}

{% set archivo_ruc = "" %}
{% if publico.archivo_ruc is defined %}
    {% set archivo_ruc = publico.archivo_ruc %}
{% endif %}


{% set archivo_dc = "" %}
{% if publico.archivo_dc is defined %}
    {% set archivo_dc = publico.archivo_dc %}
{% endif %}

{% set sobre_ti = "" %}
{% if publico.sobre_ti is defined %}
    {% set sobre_ti = publico.dsobre_ti %}
{% endif %}

{% set voluntariado = "" %}
{% if publico.voluntariado is defined %}
    {% set voluntariado = publico.voluntariado %}
{% endif %}

{% set expectativas = "" %}
{% if publico.expectativas is defined %}
    {% set expectativas = publico.expectativas %}
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
                                    {{ form('gestionvoluntariado/saveDatos','method': 'post','id':'form_publico','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Documento</label>
                                                <label class="select">
                                                    <select id="input-documento"  name="documento" disabled>
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
                                                    <input type="text" id="input-nro_doc" name="nro_doc"  placeholder="DNI" value="{{ nro_doc }}" readonly>                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha de nacimiento (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nac." class="datepicker" data-dateformat='dd/mm/yy' value="{{  fecha_nacimiento }}">
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
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-mobile-phone"></i>
                                                    <input type="text" id="input-celular" name="celular"  placeholder="Celular" value="{{celular }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Dirección Actual</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-direccion"name="direccion" placeholder="Dirección" value="{{direccion }}" >                             
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
                                                <label class="text-info" >Email</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email" name="email"  placeholder="Email" value="{{email }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" ></label>
                                                <label class="checkbox" id="input-voluntariado">
                                                    {% if voluntariado == "1" %}
                                                        <input type="checkbox" name="voluntariado" value="{{ voluntariado }}"  checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="voluntariado" value="{{ voluntariado }}"  >
                                                    {% endif %}
                                                    <i></i>Voluntariado</label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Expectativas</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-expectativas" name="expectativas" placeholder="Expectativas">{{ expectativas }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Sobre Ti</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-sobre_ti" name="sobre_ti" placeholder="Sobre Ti">{{ sobre_ti }}</textarea> 
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
                {% if foto !== "" %}
                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/imagenes_publico/'~foto) }}" error="this.onerror=null;this.src='';"></img>
                {% endif %}

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