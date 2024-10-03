<style>
    #cke_input-url {
        border:solid 1px black;
    }
</style>

{% set codigo = "" %}
{% set nombres = "" %}
{% set descripcion = "" %}
{% set direccion = "" %}
{% set orden = "" %}
{% set archivo = "" %}
{% set imagen = "" %}
{% set estado = "" %}




{% if locales.codigo is defined %}
    {% set codigo = locales.codigo %}
{% endif %}

{% if locales.nombres is defined %}
    {% set nombres = locales.nombres %}
{% endif %}

{% if locales.descripcion is defined %}
    {% set descripcion = locales.descripcion %}
{% endif %}

{% if locales.direccion is defined %}
    {% set direccion = locales.direccion %}
{% endif %}

{% if locales.abreviatura is defined %}
    {% set abreviatura = locales.abreviatura %}
{% endif %}

{% if locales.archivo is defined %}
    {% set archivo = locales.archivo %}
{% endif %}

{% if locales.imagen is defined %}
    {% set imagen = locales.imagen %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if locales.estado is defined %}
    {% set estado = locales.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Enlaces</li>
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Enlaces  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrolocales/save','method': 'post','id':'form_locales','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres" placeholder="Nombre nombres" value="{{ nombres }}" >
                                                    <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Dirección </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion" name="direccion" placeholder="Dirección" value="{{ direccion }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Abreviatura</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-abreviatura" name="abreviatura" placeholder="Abreviatura" value="{{ abreviatura }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file">
                                                    <label class="input">
                                                        <span class="button"><input id="input-archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">
                                                    </label>
                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/locales/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>
                                            <section class="col col-md-6" >
                                                <div class="input input-file">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">

                                                        <span class="button"><input id="imagen_personal_familiares" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image_personal_familiares" name="input-file"  placeholder="Agregar Imagen" readonly="">
                                                    </label>
                                                </div>

                                                {% if imagen !== ""   %}
                                                    <label class="text-info" >Imagen Local</label>

                                                    <br>
                                                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/locales/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                {% endif %}




                                                {% if imagen !== ""   %}

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
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
    <div id="exito_locales">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<script type="text/javascript" >
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = {{ id }};
    {% endif %}



        //alert("Hola");
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>