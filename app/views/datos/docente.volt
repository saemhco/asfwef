{% set codigo = "" %}
{% set ciudad = "" %}
{% set telefono = "" %}
{% set nombres = "" %}
{% set email1 = "" %}
{% set email = "" %}

{% set documento_identidad = "" %}

{% set apellidop = "" %}

{% set sexo_docente = "" %}
{% set celular = "" %} 

{% set seguro_docente = "" %}

{% set nro_doc = "" %}
{% set apellidom = "" %}
{% set direccion = "" %}
{% set pais = "" %}
{% set fecha_ingreso = "" %}

{% set grado_academico = "" %}

{% set grado_academico_otro = "" %}

{% set grado_mencion_mayor = "" %}
{% set grado_mencion_otro = "" %}
{% set grado_universidad_mayor = "" %}
{% set grado_universidad_otro = "" %}
{% set pais_universidad_mayor = "" %}
{% set pais_universidad_otro = "" %}
{% set grado_maximo = "" %}
{% set grado_maximo_otro = "" %}

{% set titulo = "" %}


{% set ley = "" %}
{% set dina = "" %}
{% set maestria = "" %}
{% set doctorado = "" %}
{% set titulo_universitario = "" %}

{% set observaciones = "" %}



{% set concytec_enlace = "" %}

{% set fecha_nacimiento = "" %}
{% if docentes.fecha_nacimiento is defined %}
    {% set fecha_nacimiento = utilidades.fechita(docentes.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if docentes.ciudad is defined %}
    {% set ciudad = docentes.ciudad %}
{% endif %}

{% if docentes.telefono is defined %}
    {% set telefono = docentes.telefono %}
{% endif %}

{% if docentes.nombres is defined %}
    {% set nombres = docentes.nombres %}
{% endif %}

{% if docentes.email is defined %}
    {% set email = docentes.email %}
{% endif %}

{% if docentes.email1 is defined %}
    {% set email1 = docentes.email1 %}
{% endif %}

{% if docentes.documento is defined %}
    {% set documento_identidad = docentes.documento %}
{% endif %}

{% if docentes.apellidop is defined %}
    {% set apellidop = docentes.apellidop %}
{% endif %}

{% if docentes.sexo is defined %}
    {% set sexo_docente = docentes.sexo %}
{% endif %}

{% if docentes.celular is defined %}
    {% set celular = docentes.celular %}
{% endif %}

{% if docentes.seguro is defined %}
    {% set seguro_docente = docentes.seguro %}
{% endif %}

{% if docentes.nro_doc is defined %}
    {% set nro_doc = docentes.nro_doc %}
{% endif %}

{% if docentes.apellidom is defined %}
    {% set apellidom = docentes.apellidom %}
{% endif %}

{% if docentes.direccion is defined %}
    {% set direccion = docentes.direccion %}
{% endif %}

{% if docentes.pais is defined %}
    {% set pais = docentes.pais %}
{% endif %}

{% if docentes.fecha_ingreso is defined %}
    {% set fecha_ingreso = utilidades.fechita(docentes.fecha_ingreso,'d/m/Y') %}
{% endif %}

{% if docentes.grado is defined %}
    {% set grado_academico = docentes.grado %}
{% endif %}

{% if docentes.grado_otro is defined %}
    {% set grado_academico_otro = docentes.grado_otro %}
{% endif %}

{% if docentes.grado_mencion_mayor is defined %}
    {% set grado_mencion_mayor = docentes.grado_mencion_mayor %}
{% endif %}

{% if docentes.grado_mencion_otro is defined %}
    {% set grado_mencion_otro = docentes.grado_mencion_otro %}
{% endif %}

{% if docentes.grado_universidad_mayor is defined %}
    {% set grado_universidad_mayor = docentes.grado_universidad_mayor %}
{% endif %}

{% if docentes.grado_universidad_otro is defined %}
    {% set grado_universidad_otro = docentes.grado_universidad_otro %}
{% endif %}

{% if docentes.pais_universidad_mayor is defined %}
    {% set pais_universidad_mayor = docentes.pais_universidad_mayor %}
{% endif %}

{% if docentes.pais_universidad_otro is defined %}
    {% set pais_universidad_otro = docentes.pais_universidad_otro %}
{% endif %}

{% if docentes.gradom is defined %}
    {% set grado_maximo = docentes.gradom %}
{% endif %}

{% if docentes.gradom_otro is defined %}
    {% set grado_maximo_otro = docentes.gradom_otro %}
{% endif %}

{% if docentes.titulo is defined %}
    {% set titulo = docentes.titulo %}
{% endif %}


{% if docentes.categoria is defined %}
    {% set categoria_docente = docentes.categoria %}
{% endif %}

{% if docentes.titulo_universitario is defined %}
    {% set titulo_universitario = docentes.titulo_universitario %}
{% endif %}

{% if docentes.dina is defined %}
    {% set dina = docentes.dina %}
{% endif %}

{% if docentes.maestria is defined %}
    {% set maestria = docentes.maestria %}
{% endif %}

{% if docentes.doctorado is defined %}
    {% set doctorado = docentes.doctorado %}
{% endif %}



{% if docentes.ley30220 is defined %}
    {% set ley = docentes.ley30220 %}
{% endif %}



{% if docentes.observaciones is defined %}
    {% set observaciones = docentes.observaciones %}
{% endif %}

{% set foto = "" %}
{% if docentes.foto is defined %}
    {% set foto = docentes.foto %}
{% endif %}

{% set archivo = "" %}
{% if docentes.archivo is defined %}
    {% set archivo = docentes.archivo %}
{% endif %}

{% if docentes.concytec_enlace is defined %}
    {% set concytec_enlace = docentes.concytec_enlace %}
{% endif %}



{% set txt_buton = "Guardar" %}
{% if docentes.codigo is defined %}
    {% set codigo = docentes.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Docente</li>
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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de docente</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('datos/saveDocente','method': 'post','id':'form_docentes','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info" >Código del docente</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder="Codigo" value="{{ codigo }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" ></label>
                                                <label class="checkbox">
                                                    {% if ley == 1 %}
                                                        <input type="checkbox" name="ley30220" value="{{ ley }}" id="ley" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="ley30220" value="{{ ley }}" id="ley" disabled>
                                                    {% endif %}
                                                    <i></i>Docente Universitario - LU 30220

                                                </label>
                                            </section>
                                        </div> 

                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Imagen del Docente</label>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_docente"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                <div id="imagen_docente" class="collapse">

                                                    {% if foto !== ""   %}
                                                        <img class="img-responsive" src="{{ url('adminpanel/imagenes/docentes/'~foto) }}" error="this.onerror=null;this.src='';"></img>
                                                    {% else %}

                                                        <div class="alert alert-warning fade in">                                                       
                                                            <i class="fa-fw fa fa-warning"></i>
                                                            <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                        </div>

                                                    {% endif %}
                                                </div>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Documento</label>
                                                <label class="select">
                                                    <select id="input-documento"  name="documento"  disabled>
                                                        <option value="" >Seleccione...</option>
                                                        {% for documento in documentos %}
                                                            {% if documento.codigo == documento_identidad %}
                                                                <option selected="selected" value="{{ documento.codigo }}">{{ documento.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ documento.codigo }}">{{ documento.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>   
                                            <section class="col col-md-4">
                                                <label class="text-info" >Nro. Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc" placeholder="Nro. Documento" value="{{ nro_doc }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidop" name="apellidop" placeholder="Apellido Paterno" value="{{ apellidop }}" readonly=>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidom" name="apellidom" placeholder="Apellido materno" value="{{ apellidom }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres" placeholder="Nombres" value="{{ nombres }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Dirección</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion" name="direccion" placeholder="Dirección" value="{{ direccion }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad" placeholder="Ciudad" value="{{ ciudad }}" >

                                                </label>
                                            </section>




                                            <section class="col col-md-4">
                                                <label class="text-info" >País</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pais" name="pais" placeholder="País" value="{{ pais }}" >

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Teléfono</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-telefono" name="telefono" placeholder="Teléfono" value="{{ telefono }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-celular" name="celular" placeholder="Celular" value="{{ celular }}" >

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Sexo</label>
                                                <label class="select">
                                                    <select id="input-sexo"  name="sexo" disabled>
                                                        <option value="" >Seleccione...</option>
                                                        {% for sexo in sexos %}
                                                            {% if sexo.codigo == sexo_docente %}
                                                                <option selected="selected" value="{{ sexo.codigo }}">{{ sexo.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ sexo.codigo }}">{{ sexo.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section> 


                                            <section class="col col-md-4">
                                                <label class="text-info" >Email - Personal</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email" name="email" placeholder="E-mail" value="{{ email }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Email - Institucional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email1" name="email1" placeholder="E-mail UNAAA" value="{{ email1 }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha de Nacimiento (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_nacimiento }}">
                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro"  name="seguro" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for seguro in seguros %}
                                                            {% if seguro.codigo == seguro_docente %}
                                                                <option selected="selected" value="{{ seguro.codigo }}">{{ seguro.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ seguro.codigo }}">{{ seguro.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section> 

                                            <section class="col col-md-4">
                                                <label class="text-info" >Enlace Concytec</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-concytec_enlace" name="concytec_enlace" placeholder="" value="{{ concytec_enlace }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="5" id="input-observaciones" name="observaciones" disabled>{{ observaciones }}</textarea> 
                                                </label>
                                            </section>


                                        </div> 
                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info" >Fecha de Ingreso (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_ingreso" name="fecha_ingreso" placeholder="Fecha de Ingreso" class="" data-dateformat='dd/mm/yy' value="{{ fecha_ingreso }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info" >Título profesional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="Título profesional" value="{{ titulo }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Grado académico</label>
                                                <label class="select">
                                                    <select id="input-grado"  name="grado" disabled>
                                                        <option value="" >Seleccione...</option>
                                                        {% for grado in grados %}
                                                            {% if grado.codigo == grado_academico %}
                                                                <option selected="selected" value="{{ grado.codigo }}">{{ grado.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ grado.codigo }}">{{ grado.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>
                                            <section class="col col-md-9">
                                                <label class="text-info" >Grado mención</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_mencion_mayor" name="grado_mencion_mayor" placeholder="Grado mención" value="{{ grado_mencion_mayor }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Universidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_universidad_mayor" name="grado_universidad_mayor" placeholder="Grado Universidad" value="{{ grado_universidad_mayor }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-3">

                                                <label class="text-info" >País Universidad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pais_universidad_mayor" name="pais_universidad_mayor" placeholder="País Universidad" value="{{ pais_universidad_mayor }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info" >Grado Máximo</label>
                                                <label class="select">
                                                    <select id="input-gradom"  name="gradom" disabled>
                                                        <option value="" >Seleccione...</option>
                                                        {% for grado_m in gradosm %}
                                                            {% if grado_m.codigo == grado_maximo %}
                                                                <option selected="selected" value="{{ grado_m.codigo }}">{{ grado_m.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ grado_m.codigo }}">{{ grado_m.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Grado académico otro</label>
                                                <label class="select">
                                                    <select id="input-grado_otro"  name="grado_otro" disabled>
                                                        <option value="" >Seleccione...</option>
                                                        {% for grado in grados %}
                                                            {% if grado.codigo == grado_academico_otro %}
                                                                <option selected="selected" value="{{ grado.codigo }}">{{ grado.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ grado.codigo }}">{{ grado.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-9">
                                                <label class="text-info" >Grado mención otro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_mencion_otro" name="grado_mencion_otro" placeholder="Grado mención otro" value="{{ grado_mencion_otro }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Universidad otro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-grado_universidad_otro" name="grado_universidad_otro" placeholder="Grado Universidad otro" value="{{ grado_universidad_otro }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-3">

                                                <label class="text-info" >País Universidad otro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-pais_universidad_otro" name="pais_universidad_otro" placeholder="País Universidad Otro" value="{{ pais_universidad_otro }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Grado Máximo otro</label>
                                                <label class="select">
                                                    <select id="input-gradom_otro"  name="gradom_otro" >
                                                        <option value="" >Seleccione...</option>
                                                        {% for grado_m in gradosm %}
                                                            {% if grado_m.codigo == grado_maximo_otro %}
                                                                <option selected="selected" value="{{ grado_m.codigo }}">{{ grado_m.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ grado_m.codigo }}">{{ grado_m.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <!-- <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/docentes/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
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

                                                        <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');" disabled><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if foto !== ""   %}

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

                                            </section> -->
                                            
                                            <section class="col col-md-3">
                                                <label class="checkbox">

                                                    {% if titulo_universitario == 1 %}
                                                        <input type="checkbox" name="titulo_universitario" value="{{ titulo_universitario }}" id="titulo_universitario" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="titulo_universitario" value="{{ titulo_universitario }}" id="titulo_universitario" disabled>
                                                    {% endif %}

                                                    <i></i>Título

                                                </label>


                                            </section>

                                            <section class="col col-md-3">
                                                <label class="checkbox">

                                                    {% if maestria == 1 %}
                                                        <input type="checkbox" name="maestria" value="{{ maestria }}" id="maestria" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="maestria" value="{{ maestria }}" id="maestria" disabled>
                                                    {% endif %}

                                                    <i></i>Maestria

                                                </label>


                                            </section>

                                            <section class="col col-md-3">
                                                <label class="checkbox">
                                                    {% if doctorado == 1 %}
                                                        <input type="checkbox" name="doctorado" value="{{ doctorado }}" id="doctorado" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="doctorado" value="{{ doctorado }}" id="doctorado" disabled>
                                                    {% endif %}
                                                    <i></i>Doctorado

                                                </label>


                                            </section>

                                            <section class="col col-md-3">
                                                <label class="checkbox">
                                                    {% if dina == 1 %}
                                                        <input type="checkbox" name="dina" value="{{ dina }}" id="dina" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="dina" value="{{ dina }}" id="dina" disabled>
                                                    {% endif %}
                                                    <i></i>Registro CTI VITAE</label>


                                            </section>

                                            <section class="col col-md-12">
                                                <br>
                                                * Coordinar con Registros Academicos para la actualización de los campos que bloqueados.
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
    <div id="guarda_docentes">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
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
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/docentes/'~foto) }}" error="this.onerror=null;this.src='';"></img>
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
<script type="text/javascript" >

    var publica = "si";

    //alert("Hola");
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>