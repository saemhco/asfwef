
{% set id_formato = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set archivo = "" %}
{% set archivo2 = "" %}
{% set enlace = "" %}

{% set estado = "" %}


{% if formatos.nombre is defined %}
    {% set nombre = formatos.nombre %}
{% endif %}

{% if formatos.descripcion is defined %}
    {% set descripcion = formatos.descripcion %}
{% endif %}

{% if formatos.archivo is defined %}
    {% set archivo = formatos.archivo %}
{% endif %}

{% if formatos.archivo2 is defined %}
    {% set archivo2 = formatos.archivo2 %}
{% endif %}

{% if formatos.enlace is defined %}
    {% set enlace = formatos.enlace %}
{% endif %}


{% if formatos.id_formato is defined %}
    {% set id_formato = formatos.id_formato %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if formatos.estado is defined %}
    {% set estado = formatos.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Formatos </li>
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
                                <h2>Registro de Formatos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('gestionlicenciamiento1/saveFormatos1','method': 'post','id':'form_formatos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-4">
                                                <label class="text-info" >Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-id_formato" name="id_formato"  placeholder="Código" value="{{id_formato }}">                             
                                                </label>

                                            </section>



                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" >
                                                    {#<input type="hidden" id="input-id_formato" name="id_formato" value="{{ id_formato }}">#}
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-descripcion" name="descripcion" placeholder="Descripción" value="{{ descripcion }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo PDF</label>
                                                <div class="input input-file">

                                                    <input type="file" id="archivo_formato" name="archivo_formato" style="margin-bottom: 5px;">
                                                    {# <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <a href="{{ url('adminpanel/archivos/formatos1/'~archivo) }}"  target="_BLANK" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="javascript:void(0);"  onclick="detelepdf();" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}



                                            </section>
                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo EXCEL</label>
                                                <div class="input input-file">

                                                    <input type="file" id="archivo2_formato" name="archivo2_formato" style="margin-bottom: 5px;">
                                                    {#<input type="hidden" id="input-archivo2" name="archivo2" value="{{ archivo2 }}">#}
                                                </div>


                                                {% if archivo2 !== ""   %}

                                                    <a href="{{ url('adminpanel/archivos/formatos1/'~archivo2) }}"  target="_BLANK" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="javascript:void(0);"  onclick="deleteexcel();" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>



                                            <section class="col col-md-6">
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

<script type="text/javascript" > var perfil = "{{ perfil }}";</script>