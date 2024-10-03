{% set codigo = "" %}
{% set nombres = "" %}
{% set apellidop = "" %}
{% set apellidom = "" %}
{% set email = "" %}
{% set email1 = "" %}
{% set grado = "" %}
{% set grado_universidad = "" %}
{% set titulo = "" %}
{% set titulo_universidad = "" %}
{% set grado_abreviado = "" %}
{% set concytec_enlace = "" %}
{% set peru_enlace = "" %}
{% set archivo = "" %}

{% set direccion_actual = "" %}
{% set direccion_procedencia = "" %}
{% set fecha_ingreso = "" %}
{% set lugar_nacimiento = "" %}
{% set estado_civil = "" %}
{% set grupo_sanguineo = "" %}
{% set religion = "" %}
{% set caso_emergencia_llamar = "" %}
{% set alergico_medicamentos = "" %}
{% set telefono_emergencia = "" %}

{% set enlace = "" %}

{% set fecha_nacimiento = "" %}
{% set documento = "" %}
{% set nro_doc = "" %}
{% set nro_cta = "" %}
{% set cci = "" %}
{% set celular = "" %}
{% set visible = "" %}
{% set sexo = "" %}
{% set estado = "" %}
{% set imagen = "" %}

{% if personal.nombres is defined %}
    {% set nombres = personal.nombres %}
{% endif %}

{% if personal.apellidop is defined %}
    {% set apellidop = personal.apellidop %}
{% endif %}

{% if personal.apellidom is defined %}
    {% set apellidom = personal.apellidom %}
{% endif %}

{% if personal.email is defined %}
    {% set email = personal.email %}
{% endif %}

{% if personal.email1 is defined %}
    {% set email1 = personal.email1 %}
{% endif %}

{% if personal.email1 is defined %}
    {% set email1 = personal.email1 %}
{% endif %}

{% if personal.grado is defined %}
    {% set grado = personal.grado %}
{% endif %}

{% if personal.grado_universidad is defined %}
    {% set grado_universidad = personal.grado_universidad %}
{% endif %}

{% if personal.titulo is defined %}
    {% set titulo = personal.titulo %}
{% endif %}

{% if personal.titulo_universidad is defined %}
    {% set titulo_universidad = personal.titulo_universidad %}
{% endif %}

{% if personal.grado_abreviado is defined %}
    {% set grado_abreviado = personal.grado_abreviado %}
{% endif %}

{% if personal.concytec_enlace is defined %}
    {% set concytec_enlace = personal.concytec_enlace %}
{% endif %}

{% if personal.peru_enlace is defined %}
    {% set peru_enlace = personal.peru_enlace %}
{% endif %}

{% if personal.archivo is defined %}
    {% set archivo = personal.archivo %}
{% endif %}

{% if personal.enlace is defined %}
    {% set enlace = personal.enlace %}
{% endif %}



{% if personal.direccion_actual is defined %}
    {% set direccion_actual = personal.direccion_actual %}
{% endif %}

{% if personal.direccion_procedencia is defined %}
    {% set direccion_procedencia = personal.direccion_procedencia %}
{% endif %}

{% if personal.fecha_ingreso is defined %}
    {% set fecha_ingreso = utilidades.fechita(personal.fecha_ingreso,'d/m/Y') %}
{% endif %}

{% if personal.lugar_nacimiento is defined %}
    {% set lugar_nacimiento = personal.lugar_nacimiento %}
{% endif %}

{% if personal.estado_civil is defined %}
    {% set estado_civil = personal.estado_civil %}
{% endif %}

{% if personal.grupo_sanguineo is defined %}
    {% set grupo_sanguineo = personal.grupo_sanguineo %}
{% endif %}

{% if personal.religion is defined %}
    {% set religion = personal.religion %}
{% endif %}

{% if personal.caso_emergencia_llamar is defined %}
    {% set caso_emergencia_llamar = personal.caso_emergencia_llamar %}
{% endif %}

{% if personal.alergico_medicamentos is defined %}
    {% set alergico_medicamentos = personal.alergico_medicamentos %}
{% endif %}

{% if personal.telefono_emergencia is defined %}
    {% set telefono_emergencia = personal.telefono_emergencia %}
{% endif %}



{% if personal.fecha_nacimiento is defined %}
    {% set fecha_nacimiento = utilidades.fechita(personal.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if personal.documento is defined %}
    {% set documento = personal.documento %}
{% endif %}

{% if personal.sexo is defined %}
    {% set sexo = personal.sexo %}
{% endif %}

{% if personal.nro_doc is defined %}
    {% set nro_doc = personal.nro_doc %}
{% endif %}

{% if personal.nro_cta is defined %}
    {% set nro_cta = personal.nro_cta %}
{% endif %}

{% if personal.cci is defined %}
    {% set cci = personal.cci %}
{% endif %}

{% if personal.celular is defined %}
    {% set celular = personal.celular %}
{% endif %}

{% if personal.visible is defined %}
    {% set visible = personal.visible %}
{% endif %}

{% if personal.codigo is defined %}
    {% set codigo = personal.codigo %}
{% endif %}

{% if personal.imagen is defined %}
    {% set imagen = personal.imagen %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if personal.estado is defined %}
    {% set estado = personal.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}


<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Personal</li>
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
                                <h2>Registro de Personal  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('datos/saveAdministrativo','method': 'post','id':'form_personal','class':'smart-form','enctype':'multipart/form-data') }}

                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Imagen del Personal</label>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_personal"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                <div id="imagen_personal" class="collapse">

                                                    {% if imagen !== ""   %}
                                                        <img class="img-responsive" src="{{ url('adminpanel/imagenes/personal/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                    {% else %}

                                                        <div class="alert alert-warning fade in">                                                       
                                                            <i class="fa-fw fa fa-warning"></i>
                                                            <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                        </div>

                                                    {% endif %}
                                                </div>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Documento
                                                </label>
                                                <label class="select">
                                                    <select id="input-documento"  name="documento" disabled>
                                                        <option value="" >Seleccione...</option>
                                                        {% for tipodocumento in tipodocumentos %}
                                                            {% if tipodocumento.codigo == documento %}
                                                                <option selected="selected" value="{{ tipodocumento.codigo }}">{{ tipodocumento.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipodocumento.codigo }}">{{ tipodocumento.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Número Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc" placeholder="Número de Documento" value="{{ nro_doc }}" readonly>
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidop" name="apellidop" placeholder="Apellido Paterno" value="{{ apellidop }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido Materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    <input type="text" id="input-apellidom" name="apellidom" placeholder="Apellido Materno" value="{{ apellidom }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres" placeholder="Nombres" value="{{ nombres }}" >
                                                    <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4" >
                                                <label class="text-info" >Fecha Nacimiento(DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_nacimiento }}">
                                                </label>
                                            </section> 

                                            <section class="col col-md-4">
                                                <label class="text-info" >Correo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-email" name="email" placeholder="Email" value="{{ email }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Correo Insitucional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-email1" name="email1" placeholder="Email1" value="{{ email1 }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-celular" name="celular" placeholder="Celular" value="{{ celular }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Número de Cuenta</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_cta" name="nro_cta" placeholder="Número de Cuenta" value="{{ nro_cta }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >CCI</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cci" name="cci" placeholder="CCI" value="{{ cci }}" >
                                                </label>
                                            </section>
                                            <section class="col col-md-4">

                                                <label class="text-info" >Sexo
                                                </label>
                                                <label class="select">
                                                    <select id="input-sexo"  name="sexo" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for sexo_personal_model in sexo_personal %}
                                                            {% if sexo_personal_model.codigo == sexo %}
                                                                <option selected="selected" value="{{ sexo_personal_model.codigo }}">{{ sexo_personal_model.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ sexo_personal_model.codigo }}">{{ sexo_personal_model.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Estado Civil
                                                </label>
                                                <label class="select">
                                                    <select id="input-estado_civil"  name="estado_civil" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for estadocivil_model in estadocivil %}
                                                            {% if estadocivil_model.codigo == estado_civil %}
                                                                <option selected="selected" value="{{ estadocivil_model.codigo }}">{{ estadocivil_model.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ estadocivil_model.codigo }}">{{ estadocivil_model.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Religion
                                                </label>
                                                <label class="select">
                                                    <select id="input-religion"  name="religion" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for religion_model in religiones %}
                                                            {% if religion_model.codigo == religion %}
                                                                <option selected="selected" value="{{ religion_model.codigo }}">{{ religion_model.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ religion_model.codigo }}">{{ religion_model.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Dirección actual</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion_actual" name="direccion_actual" placeholder="Direccion Actual" value="{{ direccion_actual }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Dirección Procedencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion_procedencia" name="direccion_procedencia" placeholder="Direccion Procedencia" value="{{ direccion_procedencia }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Lugar de Nacimiento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-lugar_nacimiento" name="lugar_nacimiento" placeholder="Lugar de Nacimiento" value="{{ lugar_nacimiento }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4" >
                                                <label class="text-info" >Fecha ingreso(DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_ingreso" name="fecha_ingreso" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_ingreso }}" readonly>
                                                </label>
                                            </section>   

                                            <section class="col col-md-4">
                                                <label class="text-info" >Concytec Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-concytec_enlace" name="concytec_enlace" placeholder="Concytec Enlace" value="{{ concytec_enlace }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Titulo - Grado Abreviado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_abreviado" name="grado_abreviado" placeholder="Grado Abreviado" value="{{ grado_abreviado }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Grado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado" name="grado" placeholder="Grado" value="{{ grado }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Universidad Grado Mayor</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_universidad" name="grado_universidad" placeholder="Universidad Grado Mayor" value="{{ grado_universidad }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Título Profesional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="Titulo" value="{{ titulo }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Universidad Titulo Mayor</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo_universidad" name="titulo_universidad" placeholder="Universidad Titulo Profesional" value="{{ titulo_universidad }}" >
                                                </label>
                                            </section>                                         


                                            <section class="col col-md-6">
                                                <label class="text-info" >Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Peru Gob Pe Enlace</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-peru_enlace" name="peru_enlace" placeholder="Peru Gob Pe Enlace" value="{{ peru_enlace }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Grupo Sanguineo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grupo_sanguineo" name="grupo_sanguineo" placeholder="Grupo Sanguineo" value="{{ grupo_sanguineo }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Alergico Medicamentos</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-alergico_medicamentos" name="alergico_medicamentos" placeholder="Alergico a Medicamentos" value="{{ alergico_medicamentos }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Caso de emergencia Llamar</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-caso_emergencia_llamar" name="caso_emergencia_llamar" placeholder="Caso Emergencia LLamar" value="{{ caso_emergencia_llamar }}" >
                                                </label>
                                            </section>



                                            <section class="col col-md-6">
                                                <label class="text-info" >Teléfono Emergencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-telefono_emergencia" name="telefono_emergencia" placeholder="Teléfono Emergencia" value="{{ telefono_emergencia }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo_personal" type="file" name="archivo_personal" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/personal/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if imagen !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver la imagen 
                                                        <a  href="javascript:void(0);" class="btn btn-ribbon" role="button" onclick="imagen_registro();">  <i class="fa-fw fa fa-image"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                {% endif %}

                                            </section>
                                        </div> 
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">

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
                        <a href="javascript:void(0);"  onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Relación de  Familiares</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_personal_familiares" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>

                                        <th data-class="expand">Orden</th>
                                        <th>Nombres</th>
                                        <th data-hide="phone,tablet">Apellido Paterno</th>
                                        <th data-hide="phone,tablet">Apellido Materno</th>
                                        <th data-hide="phone,tablet">Nro DNI</th>
                                        <th data-hide="phone,tablet">Parentesco</th>
                                        <th data-hide="phone,tablet">Estado</th>


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
</div>
<!--Formulario de registro de padres-->
{{ form('personal/savePersonalFamiliares','method': 'post','id':'form_personal_familiares','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info" >Imagen Familiar (600 x 400 px)</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_familiar"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>
            <div id="imagen_familiar" class="collapse">
                <img id="imagen_familiar_collapse" class="img-responsive" src="" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
            </div>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Documento</label>
            <label class="select">
                <select id="input-documento_personal_familiares"  name="documento" >
                    <option value="" > Seleccione</option>
                    {% for tipo_documento_familiar_model in tipodocumentos_familiares %}                                       
                        <option value="{{ tipo_documento_familiar_model.codigo }}">{{ tipo_documento_familiar_model.nombres }} </option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Nro Documento</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nro_doc_personal_familiares" name="nro_doc" placeholder="Nro Documento" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Orden </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_personal_familiares" name="orden" placeholder="Orden" value="">

            </label>
        </section>

    </div>    

    <div class="row">
        <section class="col col-md-3">
            <label class="text-info" >Apellido Paterno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-apellidop_personal_familiares" name="apellidop" placeholder="Apellido Paterno" value="">

            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Apellido Materno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-apellidom_personal_familiares" name="apellidom" placeholder="Apellido Materno" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Nombres </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombres_personal_familiares" name="nombres" placeholder="Nombres">
                <input type="hidden" id="input-codigo_familiar" name="codigo" value="">
                <input type="hidden" id="input-personal" name="personal" value="{{ codigo }}">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Parentesco
            </label>
            <label class="select">
                <select id="input-parentesco_personal_familiares"  name="parentesco" >
                    <option value="" > Seleccione</option>
                    {% for parentesco_familiar_model in parentesco_familiares %}                                       
                        <option value="{{ parentesco_familiar_model.codigo }}">{{ parentesco_familiar_model.nombres }} </option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
    </div>
    <div class="row">

        <section class="col col-md-3" >
            <label class="text-info" >Fecha Nacimiento (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_nacimiento_personal_familiares" name="fecha_nacimiento" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Celular </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-celular_personal_familiares" name="celular" placeholder="Celular" value="">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Sexo
            </label>
            <label class="select">
                <select id="input-sexo_personal_familiares"  name="sexo" >
                    <option value="" > Seleccione</option>
                    {% for sexo_familiar_model in sexo_familiares %}                                       
                        <option value="{{ sexo_familiar_model.codigo }}">{{ sexo_familiar_model.nombres }} </option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Ocupación</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ocupacion_personal_familiares" name="ocupacion" placeholder="Ocupación" value="">
            </label>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="archivo_personal_familiares_modal">

                {#<input type="file" id="archivo_personal" name="archivo_personal" >
                <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                <span class="button"><input id="archivo_personal_familiares" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_personal_familiares" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_personal_familiares_modal">

                <label class="input">

                    <span class="button"><input id="imagen_personal_familiares" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image_personal_familiares" name="input-file"  placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

        <section class="col col-md-6">
            <label class="text-info" >Observaciones </label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                <textarea rows="3" id="input-observaciones_personal_familiares" name="observaciones"></textarea> 
            </label>
        </section>
        {#<section class="col col-md-2">
            <label class="text-info">Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado_personal_familiares">
                <i></i>&nbsp;</label>
        </section>#}
        <section class="col col-md-2">
            <label class="text-info">Principal</label>
            <label class="checkbox">
                <input type="checkbox" name="es_principal" value="" id="input-es_principal_personal_familiares">
                <i></i>&nbsp;</label>
        </section>

    </div>
</fieldset>
{{ endForm() }}
<!-- Modal Registro Imagen -->
<div class="modal fade" id="modal_registro_imagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Imagen</h4>
            </div>
            <div class="modal-body">
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/personal/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                {#<button type="button" class="btn btn-primary">
                    Post Article
                </button>#}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="hidden">
    <div id="exito_personal">
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