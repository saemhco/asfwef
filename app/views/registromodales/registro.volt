<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>
{% set id_modal = "" %}
{% set tipo = "" %}
{% set titulo = "" %}
{% set subtitulo = "" %}
{% set descripcion = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set imagen = "" %}
{% set estado = "" %}

{% set 	esimagen = "" %}


{% set 	orden = "" %}
{% if modales.orden is defined %}
    {% set orden = modales.orden %}
{% endif %}

{% if modales.tipo is defined %}
    {% set tipo = modales.tipo %}
{% endif %}

{% if modales.titulo is defined %}
    {% set titulo = modales.titulo %}
{% endif %}

{% if modales.subtitulo is defined %}
    {% set subtitulo = modales.subtitulo %}
{% endif %}

{% if modales.descripcion is defined %}
    {% set descripcion = modales.descripcion %}
{% endif %}

{% if modales.fecha_hora is defined %}
    {% set fecha_hora = utilidades.fechita(modales.fecha_hora,'d/m/Y') %}
{% endif %}

{% if modales.archivo is defined %}
    {% set archivo = modales.archivo %}
{% endif %}

{% if modales.enlace is defined %}
    {% set enlace = modales.enlace %}
{% endif %}

{% if modales.imagen is defined %}
    {% set imagen = modales.imagen %}
{% endif %}


{% if modales.esimagen is defined %}
    {% set esimagen = modales.esimagen %}
{% endif %}



{% if modales.id_modal is defined %}
    {% set id_modal = modales.id_modal %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if modales.estado is defined %}
    {% set estado = modales.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Modales</li>
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
                                <h2>Registro de Modales  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registromodales/save','method': 'post','id':'form_modales','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-4">

                                                <label class="text-info" >Tipo
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" >
                                                        <option value="0" >SELECCIONE...</option>
                                                        {% if estado == '' or tipo == 0 %}
                                                            <option value="1">1</option>  
                                                            <option value="2" >2</option>
                                                            <option value="3" >3</option>
                                                            <option value="4" >4</option>    
                                                            <option value="5" >5</option>  
                                                            <option value="6" >6</option>    
                                                            <option value="7" >7</option>    
                                                            <option value="8" >8</option>    
                                                            <option value="9" >9</option>    
                                                        {% else%}
                                                            {% if tipo == 1 %}
                                                                <option selected="selected" value="1">1</option>  
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>    
                                                                <option value="5" >5</option>  
                                                                <option value="6" >6</option>    
                                                                <option value="7" >7</option>    
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 2)%}
                                                                <option value="1" >1</option>
                                                                <option selected="selected" value="2" >2</option>                                                                
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>    
                                                                <option value="5" >5</option>  
                                                                <option value="6" >6</option>    
                                                                <option value="7" >7</option>    
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 3)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option selected="selected" value="3" >3</option>                                                              

                                                                <option value="4" >4</option>    
                                                                <option value="5" >5</option>  
                                                                <option value="6" >6</option>    
                                                                <option value="7" >7</option>    
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 4)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option selected="selected" value="4" >4</option>
                                                                <option value="5" >5</option>  
                                                                <option value="6" >6</option>    
                                                                <option value="7" >7</option>    
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 5)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>    
                                                                <option selected="selected" value="5" >5</option>
                                                                <option value="6" >6</option>    
                                                                <option value="7" >7</option>    
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 6)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>  
                                                                <option value="5" >5</option>  
                                                                <option selected="selected" value="6" >6</option>
                                                                <option value="7" >7</option>    
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 7)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>  
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>    
                                                                <option selected="selected" value="7" >7</option>
                                                                <option value="8" >8</option>    
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 8)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>  
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>
                                                                <option value="7" >7</option>  
                                                                <option selected="selected" value="8" >8</option>
                                                                <option value="9" >9</option> 
                                                            {% elseif(tipo == 9)%}
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>  
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>
                                                                <option value="7" >7</option>
                                                                <option value="8" >8</option>    
                                                                <option selected="selected" value="9" >9</option>
                                                            {% endif %}
                                                        {% endif %}

                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-2">
                                                <label class="text-info">Es imagen</label>
                                                <div class="inline-group">
                                                    <label class="checkbox">

                                                        {% if esimagen == 'A' %}
                                                            <input type="checkbox" name="esimagen" value="{{ esimagen }}" id="input_esimagen" checked>
                                                        {% else %}
                                                            <input type="checkbox" name="esimagen" value="{{ esimagen }}" id="input_esimagen">
                                                        {% endif %}
                                                        <i></i>&nbsp;</label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Orden </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden" placeholder="Orden" value="{{ orden }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Titulo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="Nombre titulo" value="{{ titulo }}" >
                                                    <input type="hidden" id="input-id_modal" name="id_modal" value="{{ id_modal }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Subtitulo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-subtitulo" name="subtitulo" placeholder="Nombre subtitulo" value="{{ subtitulo }}" >
                                                </label>
                                            </section>




                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea">                                      
                                                    <textarea rows="10" id="input-descripcion" name="descripcion_ckeditor">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >

                                                </label>
                                            </section>
                                                    
                                            <section class="col col-md-12" >
                                                <label class="text-info" >Imagen Modal</label>

                                                <br>
                                                <img class="img-responsive" src="{{ url('adminpanel/imagenes/modales/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info" >Agregar Imagen (500x400 px)</label>
                                                    <label class="input">
                                                        <input id="logosubir" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>
                                                
                                            <section class="col col-md-12">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_modal" name="archivo_modal">

                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/modales/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
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
    <div id="exito_modales">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_resolucion_registrada">
        <p>
            Resolucion ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de resolución...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de convocatoria...

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