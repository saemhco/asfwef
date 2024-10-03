{% set codigo = "" %}
{% set nombre = "" %}
{% set creditos = "" %}
{% set curricula = "" %}
{% set pr1 = "" %}
{% set pr2 = "" %}
{% set pr3 = "" %}
{% set prhm = "" %}
{% set ht = "" %}
{% set hp = "" %}


{% set ciclo_academico = "" %}
{% set tipo = "" %}
{% set nivel = "" %}

{% set observaciones = "" %}



{% if asignaturas.nombre is defined %}
    {% set nombre = asignaturas.nombre %}
{% endif %}

{% if asignaturas.creditos is defined %}
    {% set creditos = asignaturas.creditos %}
{% endif %}

{% if asignaturas.curricula is defined %}
    {% set curricula = asignaturas.curricula %}
{% endif %}

{% if asignaturas.pr1 is defined %}
    {% set pr1 = asignaturas.pr1 %}
{% endif %}

{% if asignaturas.pr2 is defined %}
    {% set pr2 = asignaturas.pr2 %}
{% endif %}

{% if asignaturas.pr3 is defined %}
    {% set pr3 = asignaturas.pr3 %}
{% endif %}

{% if asignaturas.prhm is defined %}
    {% set prhm = asignaturas.prhm %}
{% endif %}

{% if asignaturas.ht is defined %}
    {% set ht = asignaturas.ht %}
{% endif %}

{% if asignaturas.hp is defined %}
    {% set hp = asignaturas.hp %}
{% endif %}


{% if asignaturas.nivel is defined %}
    {% set nivel = asignaturas.nivel %}
{% endif %}

{% if asignaturas.observaciones is defined %}
    {% set observaciones = asignaturas.observaciones %}
{% endif %}


{% if asignaturas.ciclo is defined %}
    {% set ciclo_academico = asignaturas.ciclo %}
{% endif %}

{% if asignaturas.tipo is defined %}
    {% set tipo = asignaturas.tipo %}
{% endif %}

{% if asignaturas.curricula is defined %}
    {% set curricula = asignaturas.curricula %}
{% endif %}



{% set txt_buton = "Guardar" %}


{% if asignaturas.codigo is defined %}
    {% set codigo = asignaturas.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}





<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets"   rel="tooltip" data-placement="bottom" data-original-title="" data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Asignatura</li>
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
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>Registro de asignatura</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('asignaturas/save','method': 'post','id':'form_asignaturas','class':'smart-form','enctype':'multipart/form-data') }}

                                    <header>
                                        Identificación de la asignatura
                                    </header>

                                    <fieldset>

                                        <div class="row">




                                            <section class="col col-md-3">
                                                <label class="text-info" >Código de asignatura</label>
                                                <label class="input"> <i class="icon-prepend fa fa-lock"></i>

                                                    <input type="text" name="codigo" id="input-codigo" placeholder="Código de asignatura" value="{{ codigo }}" readonly>
                             

                                                </label>
                                            </section>


                                        </div> 
                                    </fieldset>
                                    <header style="margin-top: -10px;">
                                        Datos de asignatura
                                    </header>
                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-8">
                                                <label class="text-info" >Nombre de la Asignatura</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre de la asignatura" value="{{ nombre }}" >

                                                </label>
                                            </section>
                                            <section class="col col-md-2">

                                                <label class="text-info" >Nivel</label>
                                                <label class="select">
                                                    <select id="input-nivel"  name="nivel" >
                                                        <option value="" >Seleccione...</option>
                                                        {% if nivel == 1 %}
                                                            <option selected="selected" value="{{ nivel }}">{{ nivel }}</option>   
                                                        {% else %}
                                                            <option value="1">1</option>   

                                                        {% endif %}

                                                        {% if nivel == 2 %}
                                                            <option selected="selected" value="{{ nivel }}">{{ nivel }}</option>   
                                                        {% else %}
                                                            <option value="2">2</option>   

                                                        {% endif %}

                                                        {% if nivel == 3 %}
                                                            <option selected="selected" value="{{ nivel }}">{{ nivel }}</option>   
                                                        {% else %}
                                                            <option value="3">3</option>   

                                                        {% endif %}

                                                        {% if nivel == 4 %}
                                                            <option selected="selected" value="{{ nivel }}">{{ nivel }}</option>   
                                                        {% else %}
                                                            <option value="4">4</option>   

                                                        {% endif %}

                                                        {% if nivel == 5 %}
                                                            <option selected="selected" value="{{ nivel }}">{{ nivel }}</option>   
                                                        {% else %}
                                                            <option value="5">5</option>   

                                                        {% endif %}

                                                        {% if nivel == 6 %}
                                                            <option selected="selected" value="{{ nivel }}">{{ nivel }}</option>   
                                                        {% else %}
                                                            <option value="6">6</option>   

                                                        {% endif %}


                                                    </select> <i></i> 
                                                </label>
                                            </section> 

                                            <section class="col col-md-2">
                                                <label class="text-info" >Ciclo</label>
                                                <label class="select">
                                                    <select id="input-ciclo"  name="ciclo" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for ciclo in ciclos %}
                                                            {% if ciclo.codigo == ciclo_academico %}
                                                                <option selected="selected" value="{{ ciclo.codigo }}">{{ ciclo.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ ciclo.codigo }}">{{ ciclo.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>   

                                            <section class="col col-md-2">
                                                <label class="text-info" >Tipo</label>
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for tipoasignatura in tipoasignaturas %}
                                                            {% if tipoasignatura.codigo == tipo %}
                                                                <option selected="selected" value="{{ tipoasignatura.codigo }}">{{ tipoasignatura.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipoasignatura.codigo }}">{{ tipoasignatura.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info" >Curricula</label>
                                                <label class="select">
                                                    <select id="input-curricula"  name="curricula" >
                                                        <option value="" >CURRICULA</option>
                                                        {% for c_curricula in curriculas %}
                                                            {% if c_curricula.codigo == curricula %}
                                                                <option selected="selected" value="{{ c_curricula.codigo }}">{{ c_curricula.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ c_curricula.codigo }}">{{ c_curricula.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 

                                                </label>
                                            </section> 



                                            <section class="col col-md-2">
                                                <label class="text-info" >Créditos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-creditos" name="creditos" placeholder="Creditos" title="Creditos" value="{{ creditos }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" > Pre Requisito 1</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pr1" name="pr1" placeholder="Pre Requisito 1" value="{{ pr1 }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" > Pre Requisito 2</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pr2" name="pr2" placeholder="Pre Requisito 2" value="{{ pr2 }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" > Pre Requisito 3</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pr3" name="pr3" placeholder="Pre Requisito 3" value="{{ pr3 }}" >

                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Número créditos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-prhm" name="" placeholder="Número créditos" value="{{ prhm }}" > 
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Hora de teoría</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ht" name="ht" placeholder="Hora de teoría" value="{{ ht }}" >

                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Hora de práctica</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-hp" name="hp" placeholder="Hora de práctica" value="{{ hp }}" >
                                                </label>
                                            </section>
                                            <section class="col col-md-12">
                                                <label class="text-info" >Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-observaciones" name="observaciones" >{{ observaciones }}</textarea> 

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
<script type="text/javascript" >



    var publica = "si";

    //alert("Hola");
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>