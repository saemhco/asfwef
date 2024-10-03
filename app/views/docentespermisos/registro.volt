<style>
    #cke_input-texto_complementario {
        border:solid 1px black;
    }
    .dataTables_filter input { width: 335px !important; }
</style>
{% set codigo = "" %}
{% set nombres = "" %}
{% set apellidop = "" %}
{% set apellidom = "" %}

{% set documento = "" %}
{% set nro_doc = "" %}

{% set visible = "" %}
{% set estado = "" %}


{% if docentes.nombres is defined %}
    {% set nombres = docentes.nombres %}
{% endif %}

{% if docentes.apellidop is defined %}
    {% set apellidop = docentes.apellidop %}
{% endif %}

{% if docentes.apellidom is defined %}
    {% set apellidom = docentes.apellidom %}
{% endif %}

{% if docentes.documento is defined %}
    {% set documento = docentes.documento %}
{% endif %}



{% if docentes.nro_doc is defined %}
    {% set nro_doc = docentes.nro_doc %}
{% endif %}

{% if docentes.visible is defined %}
    {% set visible = docentes.visible %}
{% endif %}

{% if docentes.codigo is defined %}
    {% set codigo = docentes.codigo %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if docentes.estado is defined %}
    {% set estado = docentes.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Permiso Docente</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     
        <div class="col-sm-12" style="margin-bottom: -30px;">
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
                                <h2>Registro de Docente  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      

                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="5">
                                    <center>DATOS DEL DOCENTE </center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Código:<strong> {{ codigo }}</strong></td>
                                            <td>Apellidos: {{ apellidop~' '~apellidom }}</td>
                                            <td>Nombres: {{ nombres }}</td>
                                            <td>Tipo de Documento:
                                                {% for tipodocumento in tipodocumentos %}
                                                    {% if tipodocumento.codigo == documento %}
                                                        {{ tipodocumento.nombres }}   
                                                    {% endif %}
                                                {% endfor %}
                                            </td>
                                            <td>Número de Documento: {{ nro_doc }}</td>
                                        </tr>
                                    </tbody>
                                </table>    

                            </div>  
                    </article>  
                </div>
            </section>
        </div>

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
                        <a href="javascript:void(0);"  onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Docentes Permisos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_docentes_permisos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>


                                        <th data-class="expand">Imagen</th>
                                        <th>Fecha Inicio</th>
                                        <th data-hide="phone,tablet">Fecha Retorno</th>
                                        <th data-hide="phone,tablet">Motivos</th>
                                        <th data-hide="phone,tablet">Archivo</th>
                                        <th data-hide="phone,tablet">Enlace</th>
                                        <th data-hide="phone,tablet">Estado</th>


                                        </tr>
                                        </thead>
                                        <tbody>			
                                        </tbody>
                                    </table>

                                    <table class="table-primary table-bordered table" style="font-size: 10px !important;" >

                                        <tbody>

                                            <tr>
                                                <td>
                                        <center> <a role="button" href="javascript:history.back()" class="btn btn-primary  btn-md"><i class="fa fa-arrow-left"></i>  Volver </a></center>
                                        </td>
                                        </tr>
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
</div>
<!--Formulario de registro de padres-->
{{ form('docentespermisos/saveDocentesPermisos','method': 'post','id':'form_docentes_permisos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3" >
            <label class="text-info" >Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha Retorno (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_retorno" name="fecha_retorno" placeholder="Fecha Retorno" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>
        
        <section class="col col-md-3">
            <label class="text-info" >Tipo de Permiso</label>
            <label class="select">
                <select id="input-tipo_permiso"  name="tipo_permiso" >
                    <option value="" >SELECCIONE...</option>
                    {% for t_p in tipopermiso %}

                        <option value="{{ t_p.codigo }}">{{ t_p.nombres }}</option>   

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
                
        <section class="col col-md-3">
            <label class="text-info">Goce de haber</label>
            <label class="checkbox">
                <input type="checkbox" name="gocedehaber" value="" id="input-gocedehaber">
                <i></i>&nbsp;</label>
        </section>
    </div>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Motivos </label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                <textarea rows="3" id="input-motivos" name="motivos"></textarea>
                <input type="hidden" id="input-codigo" name="codigo" value="">
                <input type="hidden" id="input-personal" name="personal" value="{{ codigo }}">
            </label>
        </section>

        {#        <section class="col col-md-10">
                    <label class="text-info" >Enlace</label>
                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                        <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="">
        
                    </label>
                </section>
        #}
    </div>

    <div class="row">
        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="archivo_personal_permisos_modal">

                {#<input type="file" id="archivo_personal" name="archivo_personal" >
                <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                <span class="button"><input id="archivo_personal_permisos" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_personal_familiares" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_personal_permisos_modal">

                <label class="input">

                    <span class="button"><input id="imagen_docentes_permisos" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image_docentes_familiares" name="input-file"  placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>



    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="exito_docentes">
        <p>
            Se actualizo correctamente...
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

<script type="text/javascript" >
    var codigo = {{ codigo }};
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>