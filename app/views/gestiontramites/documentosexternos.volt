<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro de Documentos externos</li>
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
                                <h2>Registro de Documentos Externos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('documentosexternos/save','method': 'post','id':'form_documentosexternos','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-6">
                                                <label class="text-info" >Área destino documento 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Tipo trámite requerido 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Interesado 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info" >Proyecto 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Inmueble 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Documento 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Prioridad 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_resolucion"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tiporesolucion in tiporesoluciones %}
                                                            {% if tiporesolucion.codigo == tipo %}
                                                                <option selected="selected" value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tiporesolucion.codigo }}">{{ tiporesolucion.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Asunto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-observaciones_ficha" name="observaciones_ficha" >{{ observaciones_ficha }}</textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info" >Número de Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero" placeholder="Número" value="{{ numero }}" onblur="concatenacionNombre();">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Número de Folios</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero" placeholder="Número" value="{{ numero }}" onblur="concatenacionNombre();">
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Datos Remitente</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-observaciones_ficha" name="observaciones_ficha" >{{ observaciones_ficha }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Detalle Registro</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-observaciones_ficha" name="observaciones_ficha" >{{ observaciones_ficha }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-6" >
                                                <label class="text-info" >Fecha (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha" name="fecha" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    <input type="hidden" id="input-id_resolucion" name="id_resolucion" value="" >
                                                </label>
                                            </section>


                                            <section class="col col-md-6">
                                                <label class="text-info">Estado</label>
                                                <label class="checkbox">

                                                    {% if estado == 'A' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="input_estado" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="input_estado">
                                                    {% endif %}
                                                    <i></i>&nbsp;</label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_resolucion" name="archivo_resolucion">
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">
                                                </div>


                                                {% if archivo !== ""   %}

                                                    {% if tipo == 1   %}

                                                        <div class="alert alert-success fade in">                                                        

                                                            Click aqui para ver el archivo 
                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/resoluciones/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                        </div>
                                                    {% else %}
                                                        <div class="alert alert-success fade in">                                                        

                                                            Click aqui para ver el archivo 
                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/resoluciones/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                        </div>
                                                    {% endif %}

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
    <div id="exito_resoluciones">
        <p>
            Se grabo resolución correctamente...
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
            Debe seleccionar el tipo de resolución...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_pdf">

        <p>
            Solo se permite archivos con extencion ".pdf" ...

        </p>
    </div>
</div>
<script type="text/javascript" >
    var id1 = "";
    var id2 = "";
    var publica = "si";
    var xAbrevIns = "{{ config.global.xAbrevIns }}";

    {% if id1 is defined %}
        id1 = {{ id1 }};
    {% endif %}

    {% if id2 is defined %}
        id2 = {{ id2 }};
    {% endif %}


</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>