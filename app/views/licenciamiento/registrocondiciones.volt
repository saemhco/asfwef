
{% set id_condicion1 = "" %}
{% set codigo = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set enlace = "" %}

{% set estado = "" %}

{% if condiciones.codigo is defined %}
    {% set codigo = condiciones.codigo %}
{% endif %}

{% if condiciones.nombre is defined %}
    {% set nombre = condiciones.nombre %}
{% endif %}

{% if condiciones.descripcion is defined %}
    {% set descripcion = condiciones.descripcion %}
{% endif %}

{% if condiciones.archivo is defined %}
    {% set archivo = condiciones.archivo %}
{% endif %}

{% if condiciones.archivo2 is defined %}
    {% set archivo2 = condiciones.archivo2 %}
{% endif %}

{% if condiciones.enlace is defined %}
    {% set enlace = condiciones.enlace %}
{% endif %}


{% if condiciones.id_condicion1 is defined %}
    {% set id_condicion1 = condiciones.id_condicion1 %}
{% endif %}

{% set numero = "" %}
{% if condiciones.numero is defined %}
    {% set numero = condiciones.numero %}
{% endif %}

{% set avance = "" %}
{% if condiciones.avance is defined %}
    {% set avance = condiciones.avance %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if condiciones.estado is defined %}
    {% set estado = condiciones.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Condiciones </li>
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
                                <h2>Registro de Condiciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('licenciamiento1/saveCondiciones1','method': 'post','id':'form_formatos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-4">
                                                <label class="text-info" >Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo"  placeholder="Código" value="{{codigo }}">   
                                                    <input type="hidden" id="input-codigo_oculto" name="codigo_oculto" value="{{ codigo }}">                          
                                                </label>

                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" >
                                                    <input type="hidden" id="input-id_condicion1" name="id_condicion1" value="{{ id_condicion1 }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="6" id="input-descripcion" name="descripcion"
                                                        placeholder="Descripcion">{{ descripcion }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >

                                                </label>
                                            </section>

                                            
                                            <section class="col col-md-6">
                                                <label class="text-info" >Numero </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    <input type="text" id="input-numero" name="numero" placeholder="Numero" value="{{ numero }}" >

                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info" >Avance </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    
                                                    <input type="text" id="input-avance" name="avance" placeholder="Avance" value="{{ avance }}" >

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
<div class="hidden">
    <div id="exito_formatos">
        <p>
            Se grabo formato correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="codigo_vacio">
        <p>
            Debe ingresar un codigo válido...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="codigo_registrado">
        <p>
            Codigo registrado...
        </p>
    </div>
</div>


<script type="text/javascript" >
    var id = "";
    var publica = "si";

    {% if id is defined %}
        id = "{{ id }}";
    {% endif %}

</script>
<script type="text/javascript" >
    var id_condicion1 = "{{ id}}";
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>