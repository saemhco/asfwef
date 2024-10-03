{% set id_slider = "" %}
{% set texto_principal = "" %}
{% set texto_1 = "" %}
{% set texto_2 = "" %}
{% set enlace = "" %}
{% set imagen = "" %}
{% set estado = "" %}


{% if sliders.texto_principal is defined %}
    {% set texto_principal = sliders.texto_principal %}
{% endif %}

{% if sliders.texto_1 is defined %}
    {% set texto_1 = sliders.texto_1 %}
{% endif %}

{% if sliders.texto_2 is defined %}
    {% set texto_2 = sliders.texto_2 %}
{% endif %}

{% if sliders.enlace is defined %}
    {% set enlace = sliders.enlace %}
{% endif %}

{% if sliders.imagen is defined %}
    {% set imagen = sliders.imagen %}
{% endif %}


{% if sliders.estado is defined %}
    {% set estado = sliders.estado %}
{% endif %}

{% if sliders.id_slider is defined %}
    {% set id_slider = sliders.id_slider %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if sliders.estado is defined %}
    {% set estado = sliders.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Sliders</li>
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
                                <h2>Registro de Sliders  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrosliders/save','method': 'post','id':'form_sliders','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">


                                            <section class="col col-md-12">
                                                <label class="text-info" >Texto Principal Slider</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-texto_principal" name="texto_principal" placeholder="Nombre Slider" value="{{ texto_principal }}" >
                                                    <input type="hidden" id="input-id_slider" name="id_slider" value="{{ id_slider }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Texto 1 Slider</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-texto_1" name="texto_1" placeholder="Texto 1" value="{{ texto_1 }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Texto 2 Slider</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-texto_2" name="texto_2" placeholder="Texto 2" value="{{ texto_2 }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Ruta ver mas Slider</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Texto Ruta ver mas" value="{{ enlace }}" >

                                                </label>
                                            </section>

                                          
                                            <section class="col col-md-6">
                                                <label class="text-info">Tipo</label>

                                                {% if estado == '' %}
                                                    <label class="select">
                                                        <select id="estado"  name="estado" >
                                                                <option value="A" >PRINCIPAL</option>
                                                                <option value="B" >ADMISIÓN</option>
                                                                <option value="C" >CEPRE-UNCA</option>
                                                                <option value="X" >INACTIVO</option>                                                       
                                                        </select>
                                                    </label>
                                                {% else %}
                                                    {% if estado == 'A' %}
                                                    <label class="select">
                                                    <select id="estado"  name="estado" >
                                                        <option value="A" selected >PRINCIPAL</option>                                                        
                                                        <option value="B" >ADMISIÓN</option>
                                                        <option value="C" >CEPRE-UNCA</option>
                                                        <option value="X" >INACTIVO</option>
                                                    </select>
                                                    </label>
                                                    {% endif %}
                                                    {% if estado == 'B' %}
                                                    <label class="select">
                                                    <select id="estado"  name="estado" >
                                                        <option value="A" >PRINCIPAL</option>                                                        
                                                        <option value="B" selected>ADMISIÓN</option>
                                                        <option value="C" >CEPRE-UNCA</option>
                                                        <option value="X" >INACTIVO</option>
                                                    </select>
                                                    </label>
                                                    {% endif %}

                                                    {% if estado == 'C' %}
                                                    <label class="select">
                                                    <select id="estado"  name="estado" >
                                                        <option value="A" >PRINCIPAL</option>                                                        
                                                        <option value="B" >ADMISIÓN</option>
                                                        <option value="C" selected>CEPRE-UNCA</option>
                                                        <option value="X" >INACTIVO</option>
                                                    </select>
                                                    </label>
                                                    {% endif %}

                                                    {% if estado == 'X' %}
                                                    <label class="select">
                                                    <select id="estado"  name="estado" >
                                                        <option value="A" >PRINCIPAL</option>                                                        
                                                        <option value="B" >ADMISIÓN</option>
                                                        <option value="C" >CEPRE-UNCA</option>
                                                        <option value="X" selected>INACTIVO</option>
                                                    </select>
                                                    </label>
                                                    {% endif %}

                                                {% endif %}
                                                
                                            </section>

                                            <section class="col col-md-12" >
                                                <label class="text-info" >Imagen Slider</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/sliders/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen (1200x500 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
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
    <div id="exito_sliders">
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