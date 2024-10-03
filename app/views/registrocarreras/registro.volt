<style>
    #cke_input-perfil {
        border:solid 1px black;
    }
</style>

{% set codigo = "" %}
{% set descripcion = "" %}
{% set facultad = "" %}
{% set grado = "" %}

{% set titulo = "" %}
{% set modalidad = "" %}
{% set duracion = "" %}
{% set perfil = "" %}
{% set enlace = "" %}

{% set archivo = "" %}
{% set imagen = "" %}
{% set estado = "" %}

{% if carreras.codigo is defined %}
    {% set codigo = carreras.codigo %}
{% endif %}

{% if carreras.descripcion is defined %}
    {% set descripcion = carreras.descripcion %}
{% endif %}

{% if carreras.facultad is defined %}
    {% set facultad = carreras.facultad %}
{% endif %}

{% if carreras.archivo is defined %}
    {% set archivo = carreras.archivo %}
{% endif %}

{% if carreras.imagen is defined %}
    {% set imagen = carreras.imagen %}
{% endif %}

{% if carreras.enlace is defined %}
    {% set enlace = carreras.enlace %}
{% endif %}

{% if carreras.grado is defined %}
    {% set grado = carreras.grado %}
{% endif %}

{% if carreras.titulo is defined %}
    {% set titulo = carreras.titulo %}
{% endif %}

{% if carreras.modalidad is defined %}
    {% set modalidad = carreras.modalidad %}
{% endif %}

{% if carreras.duracion is defined %}
    {% set duracion = carreras.duracion %}
{% endif %}

{% if carreras.perfil is defined %}
    {% set perfil = carreras.perfil %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if carreras.estado is defined %}
    {% set estado = carreras.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Carrera</li>
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
                                <h2>Registro de Carreras  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">

                                    {{ form('registrocarreras/save','method': 'post','id':'form_carreras','class':'smart-form','enctype':'multipart/form-data') }}

                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-2">
                                                <label class="text-info" >Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder="" value="{{ codigo }}" >

                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info" >Nombre de la Carrera</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-descripcion" name="descripcion" placeholder="" value="{{ descripcion }}">
                                                </label>
                                            </section>

                                             <section class="col col-md-4">

                                                <label class="text-info" >Facultad
                                                </label>
                                                <label class="select">
                                                    <select id="input-facultad"  name="facultad" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for facultad_select in facultades %}
                                                            {% if facultad_select.codigo == facultad %}
                                                                <option selected="selected" value="{{ facultad_select.codigo }}">{{ facultad_select.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ facultad_select.codigo }}">{{ facultad_select.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Grado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado" name="grado" placeholder=""  value="{{ grado }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info" >Titulo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="" value="{{ titulo }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info" >Modalidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-modalidad" name="modalidad" placeholder="" value="{{ modalidad }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info" >Duración</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-duracion" name="duracion" placeholder="" value="{{ duracion }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info" >Perfil</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-perfil" name="perfil_ckeditor" >{{ perfil }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-9">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >
                                                </label>
                                            </section>



                                            <section class="col col-md-3" style="margin-top: 25px;">
                                                <label class="checkbox">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado">
                                                    {% endif %}
                                                    <i></i>Estado</label>
                                            </section>

            
                                            <section class="col col-md-12" >


                                                <label class="text-info" >Imagen</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/carreras/'~imagen) }}"></img>

                                                <div class="input input-file">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>


                                            </section>
                                <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_carrera" name="archivo_carrera">

                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/carreras/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                    </div>


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
                                        <button id="save" type="button" class="btn btn-primary">
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

<script type="text/javascript" >
    var id = "";
    var publica = "si";

    {% if id is defined %}
        id = {{ id }};
    {% endif %}

</script>
