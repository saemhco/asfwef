
{% set id_medio_verificacion = "" %}
{% set indicador = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set archivo = "" %}
{% set archivo2 = "" %}
{% set enlace = "" %}
{% set proceso = "" %}
{% set estado = "" %}


{% set codigo = "" %}
{% if medios.codigo is defined %}
    {% set codigo = medios.codigo %}
{% endif %}

{% if medios.nombre is defined %}
    {% set nombre = medios.nombre %}
{% endif %}

{% if medios.descripcion is defined %}
    {% set descripcion = medios.descripcion %}
{% endif %}

{% if medios.proceso is defined %}
    {% set proceso = medios.proceso %}
{% endif %}

{% if medios.archivo is defined %}
    {% set archivo = medios.archivo %}
{% endif %}

{% if medios.archivo2 is defined %}
    {% set archivo2 = medios.archivo2 %}
{% endif %}

{% if medios.enlace is defined %}
    {% set enlace = medios.enlace %}
{% endif %}


{% if medios.id_medio_verificacion is defined %}
    {% set id_medio_verificacion = medios.id_medio_verificacion %}
{% endif %}

{% if medios.indicador is defined %}
    {% set indicador = medios.indicador %}
{% endif %}


{% set txt_buton = "Guardar" %}
{% if medios.estado is defined %}
    {% set estado = medios.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Formatos</li>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro Medios de Verificación</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">


                                    {{ form('licenciamiento/saveMediosverificacion','method': 'post','id':'form_medios','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
                                            {% if id_medio_verificacion == ""   %}

                                                <section class="col col-md-12">
                                                    <label class="text-info" >Condición</label>
                                                    <label class="select">
                                                        <select id="input-condicion"  name="condicion" >
                                                            <option value="" >Seleccione...</option>
                                                            {% for condicion_model in condiciones %}                                             
                                                                <option value="{{ condicion_model.id_condicion }}">{{ condicion_model.descripcion }}</option>   
                                                            {% endfor %}
                                                        </select> <i></i> 
                                                    </label>
                                                </section>

                                                <section class="col col-md-12">
                                                    <label class="text-info" >Componentes</label>
                                                    <label class="select">
                                                        <select id="input-componente"  name="componente">
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i> 
                                                    </label>
                                                </section>

                                                <section class="col col-md-12">
                                                    <label class="text-info" >Indicadores</label>
                                                    <label class="select">
                                                        <select id="input-indicador"  name="indicador">
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i> 
                                                    </label>
                                                </section>
                                            {% else %}
                                                <section class="col col-md-12">
                                                    <label class="text-info" >Indicadores {{ indicador }}</label>
                                                    <label class="select">
                                                        <select id="input-indicaodor"  name="name_indicador" style="pointer-events: none;">
                                                            <option value="" >Seleccione...</option>
                                                            {% for indicadores_select in indicadores %}                                             

                                                                {% if indicadores_select.id_indicador == indicador %}
                                                                    <option value="{{ indicadores_select.id_indicador }}" selected="selected">{{ indicadores_select.nombre }}</option>    
                                                                {% else %}
                                                                    <option value="{{ indicadores_select.id_indicador }}">{{ indicadores_select.nombre }}</option>   
                                                                {% endif %}

                                                            {% endfor %}
                                                        </select> <i></i> 
                                                    </label>
                                                </section>
                                            {% endif %}


                                            <section class="col col-md-12">
                                                <label class="text-info" >Codigo Medio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {#<input type="text" id="input-id_medio_verificacion" name="id_medio_verificacion" placeholder="id_medio_verificacion" value="{{ id_medio_verificacion }}" readonly="">#}

                                                    {% if id_medio_verificacion == ""   %}

                                                        <input type="text" id="input-codigo" name="codigo" placeholder="" value="" >

                                                    {% else %}

                                                        <input type="text" id="input-codigo" name="codigo" placeholder="codigo" value="{{ codigo }}" readonly="">
                                                        <input type="hidden" id="input-id_medio_verificacion" name="id_medio_verificacion" value="{{ id_medio_verificacion }}">
                                                        <input type="hidden" id="input-id_indicador_edit" name="indicador" value="{{ indicador }}">
                                                    {% endif %}

                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" >
                                                    {#<input type="hidden" id="input-id_medio_verificacion" name="id_medio_verificacion" value="{{ id_medio_verificacion }}">#}
                                                    {#<input type="hidden" id="input-id_indicador" name="id_indicador" value="{{ id_indicador }}">#}
                                                </label>
                                            </section>



                                            <section class="col col-md-10">
                                                <label class="text-info" >Descripción</label>
                                                <label class="input "> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-descripcion" name="descripcion" placeholder="Descripción" value="{{ descripcion }}" >
                                                </label>
                                            </section>


                                            <section class="col col-md-2">

                                                <label class="text-info" >Proceso
                                                </label>
                                                <label class="select">
                                                    <select id="input-proceso"  name="proceso" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for procesomedio_model in procesomedios %}
                                                            {% if procesomedio_model.codigo == proceso %}
                                                                <option selected="selected" value="{{ procesomedio_model.codigo }}">{{ procesomedio_model.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ procesomedio_model.codigo }}">{{ procesomedio_model.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo PDF</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo_medios" name="archivo_medios" >
                                                    {#<input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}
                                                </div>


                                                {% if archivo !== ""   %}

                                                    <a href="{{ url('adminpanel/archivos/mediosverificacion/'~archivo) }}"  target="_BLANK" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="javascript:void(0);"  onclick="detelepdf({{id_medio_verificacion}});" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo EXCEL</label>
                                                <div class="input input-file" style="margin-bottom: 5px;">

                                                    <input type="file" id="archivo2_medios" name="archivo2_medios" >
                                                    {#<input type="hidden" id="input-archivo2" name="archivo2" value="{{ archivo2 }}">#}
                                                </div>


                                                {% if archivo2 !== ""   %}

                                                    <a href="{{ url('adminpanel/archivos/mediosverificacion/'~archivo2) }}"  target="_BLANK" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="javascript:void(0);"  onclick="deleteexcel({{id_medio_verificacion}});" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

                                            <section class="col col-md-3" style="margin-top: 5px;">
                                                <label class="checkbox">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado">
                                                    {% endif %}
                                                    <i></i>Estado</label>
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

    {% if medios.id_medio_verificacion is defined %}
        <div class="row">
            <div class="col-sm-1">
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

                            <a href="javascript:void(0);" onclick="eliminar_usuarios();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                            <a href="javascript:void(0);" onclick="agregar_personal_grupo();" class="btn btn-success btn-block"><i class="fa fa-users"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-11">
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
            <div class="col-sm-1">
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
            <div class="col-sm-11">
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
    <div id="exito_medios">
        <p>
            Se grabo medio de verificacion correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="modal_caracter_1">
        <p>
            Este campo codigo solo debe tener 10 caracteres...
        </p>

    </div>
</div>
<div class="hidden">
    <div id="modal_caracter_2">
        <p>
            El campo codigo debe tener hasta 10 caracteres...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="archivo_no_existe">
        <p>
            Archivo no existe...
        </p>
    </div>
</div>
{{ form('mediosverificacion/saveUsuariosDetalles','method': 'post','id':'form_usuarios_detalles','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" id="input-id_usuario"  name="id_usuario">
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
    <input type="hidden" id="input-id_tabla" name="id_tabla" value="{{ id_medio_verificacion }}">

</fieldset>
{{ endForm() }}

{{ form('mediosverificacion/savePersonalGrupo','method': 'post','id':'form_grupos_personal','class':'smart-form','style':'display:none;') }}
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
        <input type="hidden" id="input-id_tabla_grupo" name="id_tabla" value="{{ id_medio_verificacion }}">
    </div>

</fieldset>
{{ endForm() }}


{{ form('mediosverificacion/saveUsuariosDetallesDocente','method': 'post','id':'form_usuarios_detalles_docente','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" id="input-id_usuario_docente"  name="id_usuario">
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
    <input type="hidden" id="input-id_tabla_docente" name="id_tabla" value="{{ id_medio_verificacion }}">

</fieldset>
{{ endForm() }}

{{ form('mediosverificacion/savePersonalGrupoDocente','method': 'post','id':'form_grupos_docente','class':'smart-form','style':'display:none;') }}
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
        <input type="hidden" id="input-id_tabla_grupo" name="id_tabla" value="{{ id_medio_verificacion }}">
    </div>

</fieldset>
{{ endForm() }}
<script type="text/javascript" >
    var id = "";
    var publica = "si";

    {% if id is defined %}
        id = "{{ id }}";
    {% endif %}



        //alert("Hola");
</script>

<script type="text/javascript" >
    var id_medio_verificacion = "{{ id_medio_verificacion }}";</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>