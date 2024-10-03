<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro de Pagos</li>
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de pagos  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('documentos/save','method': 'post','id':'form_documentos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            
                                            <section class="col col-md-12">
                                                <label class="text-info" >Concepto 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_documento_gestion"  name="tipo" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for conceptos_select in conceptos %}
                                                            {% if conceptos_select.codigo == concepto %}
                                                                <option selected="selected" value="{{ conceptos_select.codigo }}">{{ conceptos_select.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ conceptos_select.codigo }}">{{ conceptos_select.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Cantidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cantidad" name="cantidad" placeholder="Cantidad" value="" >                                   
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Precio Unitario</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-precio_unitario" name="precio_unitario" placeholder="Precio Unitario" value="" >
                            
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Total</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-total" name="total" placeholder="Total" value="" >                                   
                                                </label>
                                            </section>

                                        </div> 
                                    </fieldset>

                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                           Guardar
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
    <div id="exito_documentos">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_documento_registrada">
        <p>
            Resolucion ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de documento...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de documento...

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