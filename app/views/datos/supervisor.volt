{% set id_supervisor = "" %}

{% set documento = "" %}
{% if supervisor.documento is defined %}
    {% set documento = supervisor.documento %}
{% endif %}

{% set nro_doc = "" %}
{% if supervisor.nro_doc is defined %}
    {% set nro_doc = supervisor.nro_doc %}
{% endif %}

{% set apellidop = "" %}
{% if supervisor.apellidop is defined %}
    {% set apellidop = supervisor.apellidop %}
{% endif %}

{% set apellidom = "" %}
{% if supervisor.apellidom is defined %}
    {% set apellidom = supervisor.apellidom %}
{% endif %}

{% set nombres = "" %}
{% if supervisor.nombres is defined %}
    {% set nombres = supervisor.nombres %}
{% endif %}

{% set procedencia = "" %}
{% if supervisor.procedencia is defined %}
    {% set procedencia = supervisor.procedencia %}
{% endif %}

{% set celular = "" %}
{% if supervisor.celular is defined %}
    {% set celular = supervisor.celular %}
{% endif %}

{% set email = "" %}
{% if supervisor.email is defined %}
    {% set email = supervisor.email %}
{% endif %}

{% set cuenta_bancaria = "" %}
{% if supervisor.cuenta_bancaria is defined %}
    {% set cuenta_bancaria = supervisor.cuenta_bancaria %}
{% endif %}

{% set nro_ruc = "" %}
{% if supervisor.nro_ruc is defined %}
    {% set nro_ruc = supervisor.nro_ruc %}
{% endif %}

{% set txt_buton = "Registrar" %}
{% if supervisor.id_supervisor is defined %}
    {% set id_supervisor = supervisor.id_supervisor %}
    {% set txt_buton = "Actualizar" %}
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
                                <h2>Información del Supervisor ...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('datos/saveSupervisor','method': 'post','id':'form_save','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Documento</label>
                                                <label class="select">
                                                    <select id="input-documento"  name="documento" style="pointer-events: none;">
                                                        <option value="" >Seleccione...</option>
                                                        {% for select_tipodocumentos in tipodocumentos %}

                                                            {% if select_tipodocumentos.codigo == documento %}
                                                                <option selected="selected" value="{{ select_tipodocumentos.codigo }}">{{ select_tipodocumentos.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ select_tipodocumentos.codigo }}">{{ select_tipodocumentos.nombres }}</option>   
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

                                            <section class="col col-md-8">
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nombres"name="nombres" placeholder="Nombres" value="{{nombres }}">
                                                    <input type="hidden" id="input-id_supervisor" name="id_supervisor" value="{{ id_supervisor }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Procedencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-procedencia" name="procedencia" placeholder="Procedencia" value="{{procedencia }}"  >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Número de Ruc</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_ruc" name="nro_ruc" placeholder="Numero de Ruc" value="{{nro_ruc }}"  >                             
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
                                                <label class="text-info" >Cuenta Bancaria</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cuenta_bancaria" name="cuenta_bancaria" placeholder="Cuenta Bancaria" value="{{cuenta_bancaria }}"  >                             
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
                <center>
                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/publico/'~foto) }}" error="this.onerror=null;this.src='';"></img>

                </center>
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

<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente su postulación...
        </p>
    </div>
</div>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>