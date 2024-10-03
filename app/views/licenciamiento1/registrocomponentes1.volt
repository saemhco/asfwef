
{% set id_componente1 = "" %}

{% set nombre = "" %}
{% set descripcion = "" %}
{% set enlace = "" %}

{% set estado = "" %}

{% set codigo = "" %}
{% if componentes.codigo is defined %}
    {% set codigo = componentes.codigo %}
{% endif %}

{% set condicion1 = "" %}
{% if componentes.condicion1 is defined %}
    {% set condicion1 = componentes.condicion1 %}
{% endif %}

{% if componentes.nombre is defined %}
    {% set nombre = componentes.nombre %}
{% endif %}

{% if componentes.descripcion is defined %}
    {% set descripcion = componentes.descripcion %}
{% endif %}

{% if componentes.enlace is defined %}
    {% set enlace = componentes.enlace %}
{% endif %}


{% if componentes.id_componente1 is defined %}
    {% set id_componente1 = componentes.id_componente1 %}
{% endif %}

{% set numero = "" %}
{% if componentes.numero is defined %}
    {% set numero = componentes.numero %}
{% endif %}

{% set finalidad = "" %}
{% if componentes.finalidad is defined %}
    {% set finalidad = componentes.finalidad %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if componentes.estado is defined %}
    {% set estado = componentes.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar componentes </li>
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
                                <h2>Registro de componentes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('licenciamiento1/saveComponentes1','method': 'post','id':'form_formatos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-12">
                                                <label class="text-info" >Condicion</label>
                                                <label class="select">
                                                    <select id="input-condicion"  name="condicion1" style="pointer-events: none;">
                                                        <option value="" >Seleccione...</option>
                                                        {% for condicion_select in condiciones %}                                             

                                                            {% if condicion_select.id_condicion1 == condicion1 %}
                                                                <option value="{{ condicion_select.id_condicion1 }}" selected="selected">{{ condicion_select.nombre }}</option>    
                                                            {% else %}
                                                                <option value="{{ condicion_select.id_condicion1 }}">{{ condicion_select.nombre }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo"  placeholder="Código" value="{{codigo }}"> 
                                                    <input type="hidden" id="input-codigo_oculto" name="codigo_oculto" value="{{ codigo }}">                                  
                                                </label>

                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>     
                                                    <input type="hidden" id="input-id_componente1" name="id_componente1" value="{{ id_componente1 }}">                      
                                                    <textarea rows="6" id="input-nombre" name="nombre" placeholder="Nombre">{{ nombre }}</textarea> 
                                                </label>
                                            </section>
                                                                                        
                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                        
                                                    <textarea rows="6" id="input-descripcion" name="descripcion" placeholder="Nombre">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Finalidad</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                        
                                                    <textarea rows="3" id="input-finalidad" name="finalidad" placeholder="Nombre">{{ finalidad }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >

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
    var id_componente1 = "{{ id}}";
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>