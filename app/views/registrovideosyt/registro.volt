{% set id_video_yt = "" %}
{% set titulo = "" %}
{% set imagen = "" %}
{% set enlace = "" %}
{% set estado = "" %}

{% if videos.titulo is defined %}
    {% set titulo = videos.titulo %}
{% endif %}

{% if videos.enlace is defined %}
    {% set enlace = videos.enlace %}
{% endif %}

{% if videos.estado is defined %}
    {% set estado = videos.estado %}
{% endif %}

{% if videos.id_video_yt is defined %}
    {% set id_video_yt = videos.id_video_yt %}
{% endif %}

{% if videos.imagen is defined %}
    {% set imagen = videos.imagen %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if videos.estado is defined %}
    {% set estado = videos.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Videos Youtube</li>
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
                                <h2>Registro de Videos Youtube  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrovideosyt/save','method': 'post','id':'form_videos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">


                                            <section class="col col-md-12">
                                                <label class="text-info" >Titulo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="Titulo Video" value="{{ titulo }}" >
                                                    <input type="hidden" id="input-id_video_yt" name="id_video_yt" value="{{ id_video_yt }}">
                                                </label>
                                            </section>

                                     <section class="col col-md-12">
                                                <label class="text-info" >Enlace</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-enlace" name="enlace" placeholder="Enlace">{{ enlace }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12" >
                                                <label class="text-info" >Imagen</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/videosyt/'~imagen) }}" error="this.onerror=null;this.src='';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen_videosfb" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>


                                        </div> 
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">


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
    <div id="exito_videos">
        <p>
            Se actualizo correctamente...
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