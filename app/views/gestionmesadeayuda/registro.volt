<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_documento = "" %}
{% set descripcion = "" %}
{% set referencia = "" %}
{% set referencia_enlace = "" %}
{% set fecha_hora = "" %}
{% set archivo = "" %}
{% set enlace = "" %}
{% set estado = "" %}
{% set tipo = "" %}
{% set visible = "" %}


{% if documentos.descripcion is defined %}
    {% set descripcion = documentos.descripcion %}
{% endif %}

{% if documentos.referencia is defined %}
    {% set referencia = documentos.referencia %}
{% endif %}

{% if documentos.referencia_enlace is defined %}
    {% set referencia_enlace = documentos.referencia_enlace %}
{% endif %}

{% if documentos.fecha_hora is defined %}
    {% set fecha_hora = utilidades.fechita(documentos.fecha_hora,'d/m/Y') %}
{% endif %}

{% if documentos.archivo is defined %}
    {% set archivo = documentos.archivo %}
{% endif %}

{% if documentos.tipo is defined %}
    {% set tipo = documentos.tipo %}
{% endif %}

{% if documentos.visible is defined %}
    {% set visible = documentos.visible %}
{% endif %}

{% if documentos.enlace is defined %}
    {% set enlace = documentos.enlace %}
{% endif %}

{% if documentos.id_documento is defined %}
    {% set id_documento = documentos.id_documento %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if documentos.estado is defined %}
    {% set estado = documentos.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mesa de ayuda</li>
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
                                <h2>Registro de Atención</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('gestionmesadeayuda/saveAtenciones','method': 'post','id':'form_atenciones_admin','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-6">
                                                <label class="text-info" >Tipo de Atención
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" >
                                                        <option value="" > SELECCIONE...</option>
                                                        {% for tipo_atencion_select in tipo_atencion %}                                       

                                                            <option value="{{ tipo_atencion_select.codigo }}">{{ tipo_atencion_select.nombres }} </option>  

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                                <input type="hidden" class="" name="codigo" value="" id="input-codigo">
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Prioridad
                                                </label>
                                                <label class="select">
                                                    <select id="input-prioridad"  name="prioridad" >
                                                        <option value="" > SELECCIONE...</option>
                                                        {% for prioridad_select in prioridad %}                                       

                                                            <option value="{{ prioridad_select.codigo }}">{{ prioridad_select.nombres }} </option>  

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Asunto</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" name="asunto" id="input-asunto" placeholder="Asunto" >                             
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                                                    <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción"></textarea> 
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Pedido</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                                                    <textarea rows="3" id="input-pedido" name="pedido" placeholder="Pedido"></textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <button type="button" class="btn btn-sm btn-primary" id="open_modal_publico">
                                                    <i class="fa fa-plus"></i> Agregar Usuario
                                                </button>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >DNI</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" name="nro_doc" id="input-nro_doc" placeholder="Número de documento" readonly>
                                                    <input type="hidden" id="input-publico" name="publico" value="">
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Usuario:</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" name="publico_nombre" id="input-publico_nombre" placeholder="Apellidos y Nombres" readonly>

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

<div id="modal_publico" style="display: none;">
    <table  id="tbl_publico" class="table tablecuriosity table-striped table-bordered table-hover" width="100%" >
        <thead>
            <tr>

                <th><center><i class="fa fa-check-circle"></i></center></th>
        <th width="10%">DNI</th>
        <th>Apellidos y Nombres</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script type="text/javascript" >
    var idl = "";
    var publica = "si";
    {% if id is defined %}
        idl = {{ id }};
    {% endif %}
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>