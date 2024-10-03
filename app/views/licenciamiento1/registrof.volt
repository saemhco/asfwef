
{% set id_formato = "" %}
{% set codigo = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set archivo = "" %}
{% set archivo2 = "" %}
{% set enlace = "" %}

{% set estado = "" %}

{% if formatos.codigo is defined %}
    {% set codigo = formatos.codigo %}
{% endif %}

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
                                    {{ form('licenciamiento1/savef','method': 'post','id':'form_formatos','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-4">
                                                <label class="text-info" >Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo"  placeholder="Código" value="{{codigo }}"    {% if codigo !== "" %} readonly="" {% endif %} >                             
                                                </label>

                                            </section>



                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" >
                                                    <input type="hidden" id="input-id_formato" name="id_formato" value="{{ id_formato }}">
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
    {% if formatos.id_formato is defined %}


        <div class="row">
            <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                    <header class="">
                        <center style="margin-top: -5px !important;">
                            <span class="widget-icon">Opciones</span>
                        </center>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">								

                        </div>
                        <div class="widget-body text-center">
                            <a href="javascript:void(0);"  onclick="agregar_usuarios();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_usuarios();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_usuarios();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                            <a href="javascript:void(0);" onclick="agregar_personal_grupo();" class="btn btn-success btn-block"><i class="fa fa-users"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-11" style="margin-bottom: -30px;">
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
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Usuarios: Personal Administrativo</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_usuarios_detalles" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>

                                            <th data-class="expand">Nombre del Personal</th>
                                            <th data-hide="phone,tablet">Accion</th>
                                            {#<th data-hide="phone,tablet">Estado</th>#}

                                            </tr>
                                            </thead>
                                            <tbody>			
                                            </tbody>
                                        </table>
                                    </div>		
                                </div>
                            </div>	
                        </article>	
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                    <header class="">
                        <center style="margin-top: -5px !important;">
                            <span class="widget-icon">Opciones</span>
                        </center>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">								

                        </div>
                        <div class="widget-body text-center">
                            <a href="javascript:void(0);"  onclick="agregar_usuarios_docente();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_usuarios_docente();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_usuarios_docente();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                            <a href="javascript:void(0);" onclick="agregar_personal_grupo_docente();" class="btn btn-success btn-block"><i class="fa fa-users"></i></a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-11" style="margin-bottom: -30px;">
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
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Usuarios: Docentes</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_usuarios_detalles_docente" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>

                                            <th data-class="expand">Nombre del Docente</th>
                                            <th data-hide="phone,tablet">Accion</th>
                                            {#<th data-hide="phone,tablet">Estado</th>#}

                                            </tr>
                                            </thead>
                                            <tbody>			
                                            </tbody>
                                        </table>
                                    </div>		
                                </div>
                            </div>	
                        </article>	
                    </div>
                </section>
            </div>
        </div>
    {% endif %}
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

{{ form('licenciamiento1/saveUsuariosDetalles','method': 'post','id':'form_usuarios_detalles','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-id_usuario"  name="id_usuario">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for personal_select in personal %}                                       
                        <option value="{{ personal_select.codigo }}">{{ personal_select.apellidop }} {{ personal_select.apellidom }} {{ personal_select.nombres }}</option>                                       
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning"><p>
        </section>
        <section class="col col-md-4">
            <label class="checkbox" {#style="color: #346597;"#}>
                <input type="checkbox" name="accion" value="" id="input-accion">
                <input type="hidden" id="input-id_usuario_oculto" name="id_usuario_oculto" value="">
                <i></i>Puede Modificar?
            </label>
        </section>
    </div>

    <input type="hidden" id="input-id_usuario_detalle" name="id_usuario_detalle" value="">
    <input type="hidden" id="input-id_tabla" name="id_tabla" value="{{ id_formato }}">

</fieldset>
{{ endForm() }}

{{ form('licenciamiento1/savePersonalGrupo','method': 'post','id':'form_grupos_personal','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-grupo_personal"  name="id_grupo">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for grupos_select in grupos_personal %}                                       
                        <option value="{{ grupos_select.id_grupo }}">{{ grupos_select.nombre }}</option>                                       
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning"><p>
        </section>
        <input type="hidden" id="input-id_tabla_grupo" name="id_tabla" value="{{ id_formato }}">
    </div>

</fieldset>
{{ endForm() }}

{{ form('licenciamiento1/saveUsuariosDetallesDocente','method': 'post','id':'form_usuarios_detalles_docente','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-id_usuario_docente"  name="id_usuario">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for docentes_select in docentes %}                                       
                        <option value="{{ docentes_select.codigo }}">{{ docentes_select.apellidop }} {{ docentes_select.apellidom }} {{ docentes_select.nombres }}</option>                                       
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning_docente"><p>
        </section>
        <section class="col col-md-4">
            <label class="checkbox" {#style="color: #346597;"#}>
                <input type="checkbox" name="accion" value="" id="input-accion_docente">
                <input type="hidden" id="input-id_usuario_oculto_docente" name="id_usuario_oculto_docente" value="">
                <i></i>Puede Modificar?
            </label>
        </section>
    </div>

    <input type="hidden" id="input-id_usuario_detalle_docente" name="id_usuario_detalle" value="">
    <input type="hidden" id="input-id_tabla_docente" name="id_tabla" value="{{ id_formato }}">

</fieldset>
{{ endForm() }}



{{ form('licenciamiento1/savePersonalGrupoDocente','method': 'post','id':'form_grupos_docente','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-grupo_docente"  name="id_grupo">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for grupos_select in grupos_docente %}                                       
                        <option value="{{ grupos_select.id_grupo }}">{{ grupos_select.nombre }}</option>                                       
                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-warning"><p>
        </section>
        <input type="hidden" id="input-id_tabla_grupo" name="id_tabla" value="{{ id_formato }}">
    </div>

</fieldset>
{{ endForm() }}

<script type="text/javascript" >
    var id = "";
    var publica = "si";

    {% if id is defined %}
        id = "{{ id }}";
    {% endif %}

</script>
<script type="text/javascript" >
    var id_formato = "{{ id}}";
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>