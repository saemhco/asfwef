{% set id_empresa = "" %}

{% if empresas.id_empresa is defined %}
    {% set id_empresa = empresas.id_empresa %}

{% endif %}

{% set razon_social = "" %}
{% if empresas.razon_social is defined %}
    {% set razon_social = empresas.razon_social %}
{% endif %}

{% set representante = "" %}
{% if empresas.representante is defined %}
    {% set representante = empresas.representante %}
{% endif %}

{% set ruc = "" %}
{% if empresas.ruc is defined %}
    {% set ruc = empresas.ruc %}
{% endif %}

{% set imagen = "" %}
{% if empresas.imagen is defined %}
    {% set imagen = empresas.imagen %}
{% endif %}

{% set rubro = "" %}
{% if empresas.rubro is defined %}
    {% set rubro = empresas.rubro %}
{% endif %}

{% set telefono = "" %}
{% if empresas.telefono is defined %}
    {% set telefono = empresas.telefono %}
{% endif %}

{% set direccion = "" %}
{% if empresas.direccion is defined %}
    {% set direccion = empresas.direccion %}
{% endif %}

{% set descripcion = "" %}
{% if empresas.descripcion is defined %}
    {% set descripcion = empresas.descripcion %}
{% endif %}

{% set email = "" %}
{% if empresas.email is defined %}
    {% set email = empresas.email %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% set estado = "" %}
{% if empresas.estado is defined %}
    {% set estado = empresas.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% set bolsa_trabajo = "" %}
{% if empresas.bolsa_trabajo is defined %}
    {% set bolsa_trabajo = empresas.bolsa_trabajo %}
{% endif %}

{% set archivo = "" %}
{% if empresas.archivo is defined %}
    {% set archivo = empresas.archivo %}
{% endif %}




{% set giro = "" %}
{% if empresas.giro is defined %}
    {% set giro = empresas.giro %}
{% endif %}

{% set fecha_registro = "" %}
{% if empresas.fecha_registro is defined %}
    {% set fecha_registro = utilidades.fechita(empresas.fecha_registro,'d/m/Y') %}
{% endif %}

{% set cta_cte_detraccion = "" %}
{% if empresas.cta_cte_detraccion is defined %}
    {% set cta_cte_detraccion = empresas.cta_cte_detraccion %}
{% endif %}

{% set cci = "" %}
{% if empresas.cci is defined %}
    {% set cci = empresas.cci %}
{% endif %}

{% set cargo = "" %}
{% if empresas.cargo is defined %}
    {% set cargo = empresas.cargo %}
{% endif %}

{% set nro_doc = "" %}
{% if empresas.nro_doc is defined %}
    {% set nro_doc = empresas.nro_doc %}
{% endif %}

{% set fax = "" %}
{% if empresas.fax is defined %}
    {% set fax = empresas.fax %}
{% endif %}

{% set celular = "" %}
{% if empresas.celular is defined %}
    {% set celular = empresas.celular %}
{% endif %}

{% set pais = "" %}
{% if empresas.pais is defined %}
    {% set pais = empresas.pais %}
{% endif %}

{% set region = "" %}
{% if empresas.region is defined %}
    {% set region = empresas.region %}
{% endif %}

{% set provincia = "" %}
{% if empresas.provincia is defined %}
    {% set provincia = empresas.provincia %}
{% endif %}

{% set distrito = "" %}
{% if empresas.distrito is defined %}
    {% set distrito = empresas.distrito %}
{% endif %}

{% set ubigeo = "" %}
{% if empresas.ubigeo is defined %}
    {% set ubigeo = empresas.ubigeo %}
{% endif %}

{% set referencia = "" %}
{% if empresas.referencia is defined %}
    {% set referencia = empresas.referencia %}
{% endif %}

{% set tipo = "" %}
{% if empresas.tipo is defined %}
    {% set tipo = empresas.tipo %}
{% endif %}

{% set boleta = "" %}
{% if empresas.boleta is defined %}
    {% set boleta = empresas.boleta %}
{% endif %}

{% set factura = "" %}
{% if empresas.factura is defined %}
    {% set factura = empresas.factura %}
{% endif %}

{% set rnp = "" %}
{% if empresas.rnp is defined %}
    {% set rnp = empresas.rnp %}
{% endif %}

{% set mype = "" %}
{% if empresas.mype is defined %}
    {% set mype = empresas.mype %}
{% endif %}

{% set entidad_publica = "" %}
{% if empresas.entidad_publica is defined %}
    {% set entidad_publica = empresas.entidad_publica %}
{% endif %}

{% set archivo_ruc = "" %}
{% if empresas.archivo_ruc is defined %}
    {% set archivo_ruc = empresas.archivo_ruc %}
{% endif %}

{% set archivo_rnp = "" %}
{% if empresas.archivo_rnp is defined %}
    {% set archivo_rnp = empresas.archivo_rnp %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Empresa</li>
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
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Empresa</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registroempresas/save','method': 'post','id':'form_empresas','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Imagen de la Empresa</label>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_empresa"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                <div id="imagen_empresa" class="collapse">

                                                    {% if imagen !== ""   %}
                                                        <img class="img-responsive" src="{{ url('adminpanel/imagenes/empresas/'~imagen) }}" error="this.onerror=null;this.src='';"></img>
                                                    {% else %}

                                                        <div class="alert alert-warning fade in">                                                       
                                                            <i class="fa-fw fa fa-warning"></i>
                                                            <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                        </div>

                                                    {% endif %}
                                                </div>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Razon Social</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-razon_social" name="razon_social" placeholder="Razon Social" value="{{ razon_social }}">
                                                    <input type="hidden" id="input-id_empresa" name="id_empresa" value="{{ id_empresa }}">
                                                    <input type="hidden" id="input-estado_registrado" name="estado_registrado" value="{{ estado }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >RUC</label>
                                                <label class="input"> <i class="icon-prepend fa fa-credit-card-alt"></i>
                                                    <input type="text" name="ruc" id="input-ruc" placeholder="RUC" value="{{ ruc }}">                             
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Representante</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" name="representante" id="input-representante" placeholder="Representante" value="{{ representante }}">                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Email</label>
                                                <label class="input"> <i class="icon-prepend fa fa-envelope"></i>
                                                    <input type="text" name="email" id="input-email" placeholder="Email" value="{{ email }}">                             
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Telefono</label>
                                                <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                    <input type="text" name="telefono" id="input-telefono" placeholder="Telefono" value="{{ telefono }}">                             
                                                </label>
                                            </section>
                                        </div>

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Rubro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="rubro" id="input-rubro" placeholder="Rubro" value="{{ rubro }}">                             
                                                </label>
                                            </section>
                                            <section class="col col-md-8">
                                                <label class="text-info" >Direccion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-map-marker"></i>
                                                    <input type="text" name="direccion" id="input-direccion" placeholder="Direccion" value="{{ direccion }}">                             
                                                </label>
                                            </section>

                                        </div>

                                        <div class="row">


                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
                                                <div class="input input-file" id="input-imagen">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if imagen !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver la imagen 
                                                        <a  href="javascript:void(0);" class="btn btn-ribbon" role="button" onclick="imagen_registro();">  <i class="fa-fw fa fa-image"></i></a>
                                                    </div>
                                                    <input type="hidden" name="imagen" value="{{ imagen }}">

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/empresas/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                        </div>

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info">&nbsp;</label>
                                                <label class="checkbox">

                                                    {% if bolsa_trabajo == '1' %}
                                                        <input type="checkbox" name="bolsa_trabajo" value="{{ bolsa_trabajo }}" id="input-bolsa_trabajo" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="bolsa_trabajo" value="{{ bolsa_trabajo }}" id="input-bolsa_trabajo">
                                                    {% endif %}
                                                    <i></i>Bolsa de Trabajo</label>
                                            </section>
                                            {#<section class="col col-md-4">
                                                <label class="text-info">Estado</label>
                                                <label class="checkbox">

                                                    {% if estado == 'A' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="input-estado" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="input-estado">
                                                    {% endif %}
                                                    <i></i>&nbsp;</label>
                                            </section>#}
                                            <section class="col col-md-8">
                                                <label class="text-info" >Giro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="giro" id="input-giro" placeholder="Giro" value="{{ giro }}">                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha Inscripcion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_registro" name="fecha_registro" placeholder="Fecha de Registro" {#class="datepicker"#} data-dateformat='dd/mm/yy' value="{{ fecha_registro }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Nro. Cta Cte Detracciones</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="cta_cte_detraccion" id="input-cta_cte_detraccion" placeholder="Nro. Cta Cte Detracciones" value="{{ cta_cte_detraccion }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >CCI</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="cci" id="input-cci" placeholder="CCI" value="{{ cci }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Cargo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="cargo" id="input-cargo" placeholder="Cargo" value="{{ cargo }}">                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Doc Identidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="nro_doc" id="input-nro_doc" placeholder="Doc Identidad" value="{{ nro_doc }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Telefono Fax</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="fax" id="input-fax" placeholder="Telefono Fax" value="{{ fax }}">                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="celular" id="input-celular" placeholder="Celular" value="{{ celular }}">                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Pais</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="pais" id="input-pais" placeholder="Pais" value="Perú" readonly>                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Region</label>
                                                <label class="select">
                                                    <select id="input-region"  name="region" >
                                                        <option value="" >SELECCIONE...</option>
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
                                                        <option value="" >SELECCIONE</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Distrito</label>
                                                <label class="select">
                                                    <select id="input-distrito"  name="distrito">
                                                        <option value="" >SELECCIONE</option>

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Ubigeo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="ubigeo" id="input-ubigeo" placeholder="Ubigeo" value="{{ ubigeo }}" readonly>                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Referencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="referencia" id="input-referencia" placeholder="Referencia" value="{{ referencia }}">                             
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo Persona</label>
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipo_persona_select in tipo_persona %}
                                                            {% if tipo_persona_select.codigo == tipo %}
                                                                <option selected="selected" value="{{ tipo_persona_select.codigo }}">{{ tipo_persona_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipo_persona_select.codigo }}">{{ tipo_persona_select.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">&nbsp;</label>
                                                <label class="checkbox">

                                                    {% if boleta == '1' %}
                                                        <input type="checkbox" name="boleta" value="{{ boleta }}" id="input-boleta" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="boleta" value="{{ boleta }}" id="input-boleta">
                                                    {% endif %}
                                                    <i></i>Boleta</label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">&nbsp;</label>
                                                <label class="checkbox">

                                                    {% if factura == '1' %}
                                                        <input type="checkbox" name="factura" value="{{ factura }}" id="input-factura" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="factura" value="{{ factura }}" id="input-factura">
                                                    {% endif %}
                                                    <i></i>Factura</label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">&nbsp;</label>
                                                <label class="checkbox">

                                                    {% if rnp == '1' %}
                                                        <input type="checkbox" name="rnp" value="{{ rnp }}" id="input-rnp" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="rnp" value="{{ rnp }}" id="input-rnp">
                                                    {% endif %}
                                                    <i></i>Reg. Nac. Proveedores</label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">&nbsp;</label>
                                                <label class="checkbox">

                                                    {% if mype == '1' %}
                                                        <input type="checkbox" name="mype" value="{{ mype }}" id="input-mype" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="mype" value="{{ mype }}" id="input-mype">
                                                    {% endif %}
                                                    <i></i>MYPE</label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info">&nbsp;</label>
                                                <label class="checkbox">

                                                    {% if entidad_publica == '1' %}
                                                        <input type="checkbox" name="entidad_publica" value="{{ entidad_publica }}" id="input-entidad_publica" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="entidad_publica" value="{{ entidad_publica }}" id="input-entidad_publica">
                                                    {% endif %}
                                                    <i></i>Entidad Publica</label>
                                            </section>
                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo RUC</label>
                                                <div class="input input-file" id="input-archivo_ruc">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo_ruc" type="file" name="archivo_ruc" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file3" name="input-file3"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo_ruc !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/empresas/'~archivo_ruc) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>

                                                    <input type="hidden" name="archivo_ruc" value="{{ archivo_ruc }}">
                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo RNP</label>
                                                <div class="input input-file" id="input-archivo_rnp">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo_rnp" type="file" name="archivo_rnp" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file2" name="input-file2"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo_rnp !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/empresas/'~archivo_rnp) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>
                                                    <input type="hidden" name="archivo_rnp" value="{{ archivo_rnp }}">

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
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
    <div id="success">
        <p>
            Se guardo correctamente...
        </p>
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
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/empresas/'~imagen) }}" error="this.onerror=null;this.src='';"></img>
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

    var publica = "si";

    //Ubigeo
    var region_id = '{{ region }}';
    var provincia_id = '{{ provincia }}';
    var distrito_id = '{{ distrito }}';

</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>