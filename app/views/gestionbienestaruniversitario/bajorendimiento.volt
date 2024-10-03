{% set fecha_nacimiento = utilidades.fechita(alumnos.fecha_nacimiento,'d/m/Y') %}
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Datos alumno - Registro de alertas de bajo rendimiento</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-md-12">
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
                                <h2>Registro de alertas de bajo rendimiento</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('datos/saveAlumno','method': 'post','id':'form_alumnos','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Código de Estudiante</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder="" value="{{ alumnos.codigo }}" readonly="">
                                                   
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Estudiante</label>
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" disabled>
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipoalumno in tipoalumnos %}
                                                            {% if tipoalumno.codigo == alumnos.tipo %}
                                                                <option selected="selected" value="{{ tipoalumno.codigo }}">{{ tipoalumno.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipoalumno.codigo }}">{{ tipoalumno.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info" >Modalidad Ingreso
                                                </label>
                                                <label class="select">
                                                    <select id="input_modalidad_ingreso"  name="modalidad_ingreso" disabled>
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for modalidad_select in modalidad %}
                                                            {% if modalidad_select.codigo == alumnos.modalidad_ingreso %}
                                                                <option selected="selected" value="{{ modalidad_select.codigo }}">{{ modalidad_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ modalidad_select.codigo }}">{{ modalidad_select.nombres }}</option>   
                                                            {% endif %}
                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Imagen del Alumnos</label>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_alumno"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                <div id="imagen_alumno" class="collapse">

                                                    {% if foto !== ""   %}
                                                        <img class="img-responsive" src="{{ url('adminpanel/imagenes/alumnos/'~alumnos.foto) }}" error="this.onerror=null;this.src='';"></img>
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
                                                    <select id="input-documento"  name="documento" disabled>
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for documentoalumno in documentoalumnos %}
                                                            {% if documentoalumno.codigo == alumnos.documento %}
                                                                <option selected="selected" value="{{ documentoalumno.codigo }}">{{ documentoalumno.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ documentoalumno.codigo }}">{{ documentoalumno.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>   

                                            <section class="col col-md-4">
                                                <label class="text-info" >Número de Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc" placeholder="Nro. Documento" value="{{ alumnos.nro_doc }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidop" name="apellidop" placeholder="Apellido paterno" value="{{ alumnos.apellidop }}" readonly>

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Apellido materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-apellidom" name="apellidom" placeholder="Apellido materno" value="{{ alumnos.apellidom }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombres" name="nombres" placeholder="Nombres" value="{{ alumnos.nombres }}" readonly>

                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha de Nacimiento (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" class="" data-dateformat='dd/mm/yy' value="{{ utilidades.fechita(alumnos.fecha_nacimiento,'d/m/Y') }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Sexo</label>
                                                <label class="select">
                                                    <select id="input-sexo"  name="sexo" disabled>
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for sexoalumno in sexoalumnos %}
                                                            {% if sexoalumno.codigo == alumnos.sexo %}
                                                                <option selected="selected" value="{{ sexoalumno.codigo }}">{{ sexoalumno.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ sexoalumno.codigo }}">{{ sexoalumno.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section> 

                                            <section class="col col-md-4">
                                                <label class="text-info" >Idioma</label>
                                                <label class="select">
                                                    <select id="input-idioma"  name="idioma" disabled>
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for ia in idiomaalumnos %}
                                                            {% if ia.codigo == alumnos.idioma %}
                                                                <option selected="selected" value="{{ ia.codigo }}">{{ ia.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ ia.codigo }}">{{ ia.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Dirección</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-direccion" name="direccion" placeholder="Dirección" value="{{ alumnos.direccion }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad" placeholder="Ciudad" value="{{ alumnos.ciudad }}" >

                                                </label>
                                            </section>
                                            <section class="col col-md-4">
                                                <label class="text-info" >Correo personal</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email" name="email" placeholder="Correo personal" value="{{ alumnos.email }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Correo Institucional</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email1" name="email1" placeholder="Correo UNAAA" value="{{ alumnos.email1 }}" readonly>

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Seguro</label>
                                                <label class="select">
                                                    <select id="input-seguro"  name="seguro" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for seguroalumno in seguroalumnos %}
                                                            {% if seguroalumno.codigo == alumnos.seguro %}
                                                                <option selected="selected" value="{{ seguroalumno.codigo }}">{{ seguroalumno.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ seguroalumno.codigo }}">{{ seguroalumno.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section> 



                                            <section class="col col-md-4">
                                                <label class="text-info" >Teléfono</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-telefono" name="telefono" placeholder="Teléfono" value="{{ alumnos.telefono }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-celular" name="celular" placeholder="Celular" value="{{ alumnos.celular }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Estado Civil</label>
                                                <label class="select">
                                                    <select id="input-estado_civil"  name="estado_civil">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for i_e in estadocivil %}
                                                            {% if i_e.codigo == alumnos.estado_civil %}
                                                                <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>


                                            <section class="col col-md-3">

                                                <label class="checkbox">

                                                    {% if alumnos.discapacitado == 1 %}
                                                        <input type="checkbox" name="discapacitado" value="{{ alumnos.discapacitado }}" id="discapacitado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="discapacitado" value="{{ alumnos.discapacitado }}" id="discapacitado">
                                                    {% endif %}

                                                    <i></i>Discapacitado - Nombre discapacidad

                                                </label>

                                                <label class="input" > <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-discapacitado_nombre" name="discapacitado_nombre" placeholder="Nombre Discapacidad" value="{{ alumnos.discapacitado_nombre }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" style="margin-bottom: 10px;">Tipo de Discapacidad</label>
                                                <label class="select">
                                                    <select id="input-tipo_discapacidad"  name="tipo_discapacidad">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for i_e in tipodiscapacidad %}
                                                            {% if i_e.codigo == alumnos.tipo_discapacidad %}
                                                                <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">

                                                <label class="checkbox">

                                                    {% if alumnos.violencia_sociopolitica == 1 %}
                                                        <input type="checkbox" name="violencia_sociopolitica" value="{{ alumnos.violencia_sociopolitica }}" id="violencia_sociopolitica" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="violencia_sociopolitica" value="{{ alumnos.violencia_sociopolitica }}" id="violencia_sociopolitica">
                                                    {% endif %}

                                                    <i></i>Violencia Sociopolitica - Registro

                                                </label>

                                                <label class="input" > <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-violencia_sociopolitica_registro" name="violencia_sociopolitica_registro" placeholder="Registro Violencia Sociopolitica" value="{{ alumnos.violencia_sociopolitica_registro }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" style="margin-bottom: 10px;">Identidad Étnica</label>
                                                <label class="select">
                                                    <select id="input_identidad_etnica"  name="identidad_etnica">
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for i_e in identidadetnica %}
                                                            {% if i_e.codigo == alumnos.identidad_etnica %}
                                                                <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-6" style="float: right;">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if alumnos.archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/alumnos/'~alumnos.archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6" style="float: right;">

                                                <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if alumnos.foto !== ""   %}

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

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar CV</label>
                                                <div class="input input-file">

                                                    {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                    <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                    <span class="button"><input id="cv" type="file" name="cv" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_cv" name="input-file"  placeholder="Agregar CV" readonly="">

                                                </div>

                                                {% if alumnos.cv !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/cv/'~alumnos.cv) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" ></label>
                                                <label class="checkbox">

                                                    {% if alumnos.envio == 1 %}
                                                        <input type="checkbox" name="envio" value="{{ alumnos.envio }}" id="envio" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="envio" value="{{ alumnos.envio }}" id="envio" disabled>
                                                    {% endif %}

                                                    <i></i>Envio e-mail</label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" ></label>
                                                <label class="checkbox">

                                                    {% if alumnos.activo == 1 %}
                                                        <input type="checkbox" name="activo" value="{{ alumnos.activo }}" id="activo" checked disabled> 
                                                    {% else %}
                                                        <input type="checkbox" name="activo" value="{{ alumnos.activo }}" id="activo" disabled>
                                                    {% endif %}

                                                    <i></i>Activo</label>
                                            </section>

                                        </div> 
                                    </fieldset>
                                    <footer>
                                        <button id="actualizar" type="button" class="btn btn-primary">
                                            Actualizar
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
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/alumnos_familiares/'~alumnos.foto) }}" error="this.onerror=null;this.src='';"></img>
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
    var region_id = '{{ alumnos.region }}';
    var provincia_id = '{{ alumnos.provincia }}';
    var distrito_id = '{{ alumnos.distrito}}';

</script>