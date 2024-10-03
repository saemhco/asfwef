{% set codigo = "" %}

{% set apellidop = "" %}
{% set apellidom = "" %}
{% set nombres = "" %}
{% set sexo = "" %}
{% set fecha_nacimiento = "" %}
{% set documento_postulantes = "" %}
{% set nro_doc = "" %}
{% set direccion = "" %}
{% set ciudad = "" %}
{% set localidad = "" %}
{% set ubigeo = "" %}
{% set region = "" %}
{% set provincia = "" %}
{% set distrito = "" %}
{% set ubigeo1 = "" %}
{% set region1 = "" %}
{% set provincia1 = "" %}
{% set distrito1 = "" %}
{% set email = "" %}
{% set telefono = "" %}
{% set celular = "" %}

{% set colegio_publico = "" %}
{% set colegio_nombre = "" %}
{% set sitrabaja = "" %}
{% set sitrabaja_nombre = "" %}
{% set sidepende = "" %}
{% set sidepende_nombre = "" %}
{% set discapacitado = "" %}
{% set discapacitado_nombre = "" %}

{% set seguro = "" %}
{% set observaciones = "" %}
{% set estado = "" %}
{% set foto = "" %}

{% set archivo = "" %}
{% if postulantes.archivo is defined %}
{% set archivo = postulantes.archivo %}
{% endif %}

{% set archivo_cp = "" %}
{% if postulantes.archivo_cp is defined %}
{% set archivo_cp = postulantes.archivo_cp %}
{% endif %}

{% set archivo_ruc = "" %}
{% if postulantes.archivo_ruc is defined %}
{% set archivo_ruc = postulantes.archivo_ruc %}
{% endif %}

{% set txt_buton = "Registrar" %}
{% if postulantes.codigo is defined %}
{% set codigo = postulantes.codigo %}
{% set txt_buton = "Actualizar" %}
{% endif %}


{% if postulantes.apellidop is defined %}
{% set apellidop = postulantes.apellidop %}
{% endif %}

{% if postulantes.apellidom is defined %}
{% set apellidom = postulantes.apellidom %}
{% endif %}

{% if postulantes.nombres is defined %}
{% set nombres = postulantes.nombres %}
{% endif %}


{% if postulantes.sexo is defined %}
{% set sexo = postulantes.sexo %}
{% endif %}

{% if postulantes.fecha_nacimiento is defined %}
{% set fecha_nacimiento = utilidades.fechita(postulantes.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% if postulantes.documento is defined %}
{% set documento_postulantes = postulantes.documento %}
{% endif %}

{% if postulantes.nro_doc is defined %}
{% set nro_doc = postulantes.nro_doc %}
{% endif %}

{% if postulantes.direccion is defined %}
{% set direccion = postulantes.direccion %}
{% endif %}

{% if postulantes.ciudad is defined %}
{% set ciudad = postulantes.ciudad %}
{% endif %}

{% if postulantes.localidad is defined %}
{% set localidad = postulantes.localidad %}
{% endif %}

{% if postulantes.telefono is defined %}
{% set telefono = postulantes.telefono %}
{% endif %}

{% if postulantes.celular is defined %}
{% set celular = postulantes.celular %}
{% endif %}

{% if postulantes.email is defined %}
{% set email = postulantes.email %}
{% endif %}

{% if postulantes.seguro is defined %}
{% set seguro = postulantes.seguro %}
{% endif %}

{% if postulantes.observaciones is defined %}
{% set observaciones = postulantes.observaciones %}
{% endif %}



{% if postulantes.region is defined %}
{% set region = postulantes.region %}
{% endif %}

{% if postulantes.provincia is defined %}
{% set provincia = postulantes.provincia %}
{% endif %}

{% if postulantes.distrito is defined %}
{% set distrito = postulantes.distrito %}
{% endif %}

{% if postulantes.ubigeo is defined %}
{% set ubigeo = postulantes.ubigeo %}
{% endif %}


{% if postulantes.region1 is defined %}
{% set region1 = postulantes.region1 %}
{% endif %}

{% if postulantes.provincia1 is defined %}
{% set provincia1 = postulantes.provincia1 %}
{% endif %}

{% if postulantes.distrito1 is defined %}
{% set distrito1 = postulantes.distrito1 %}
{% endif %}

{% if postulantes.ubigeo1 is defined %}
{% set ubigeo1 = postulantes.ubigeo1 %}
{% endif %}

{% if postulantes.foto is defined %}
{% set foto = postulantes.foto %}
{% endif %}

{% if postulantes.colegio_publico is defined %}
{% set colegio_publico = postulantes.colegio_publico %}
{% endif %}

{% if postulantes.colegio_nombre is defined %}
{% set colegio_nombre = postulantes.colegio_nombre %}
{% endif %}


{% if postulantes.sitrabaja is defined %}
{% set sitrabaja = postulantes.sitrabaja %}
{% endif %}

{% if postulantes.sitrabaja_nombre is defined %}
{% set sitrabaja_nombre = postulantes.sitrabaja_nombre %}
{% endif %}

{% if postulantes.sidepende is defined %}
{% set sidepende = postulantes.sidepende %}
{% endif %}

{% if postulantes.sidepende_nombre is defined %}
{% set sidepende_nombre = postulantes.sidepende_nombre %}
{% endif %}

{% if postulantes.discapacitado is defined %}
{% set discapacitado = postulantes.discapacitado %}
{% endif %}

{% if postulantes.discapacitado_nombre is defined %}
{% set discapacitado_nombre = postulantes.discapacitado_nombre %}
{% endif %}

{% if postulantes.estado is defined %}
{% set estado = postulantes.estado %}
{% endif %}

{% set colegio_profesional = "" %}
{% if postulantes.colegio_profesional is defined %}
{% set colegio_profesional = postulantes.colegio_profesional %}
{% endif %}

{% set colegio_profesional_nro = "" %}
{% if postulantes.colegio_profesional_nro is defined %}
{% set colegio_profesional_nro = postulantes.colegio_profesional_nro %}
{% endif %}

{% set archivo_escuela = "" %}
{% if postulantes.archivo_escuela is defined %}
{% set archivo_escuela = postulantes.archivo_escuela %}
{% endif %}


{% set colegio_profesional_nro = "" %}
{% if postulantes.colegio_profesional_nro is defined %}
{% set colegio_profesional_nro = postulantes.colegio_profesional_nro %}
{% endif %}

{% set id_universidad = "" %}
{% if postulantes.id_universidad is defined %}
{% set id_universidad = postulantes.id_universidad %}
{% endif %}




{% set categoria = "" %}
{% if postulantes.categoria is defined %}
{% set categoria = postulantes.categoria %}
{% endif %}

{% set escuela = "" %}
{% if postulantes.escuela is defined %}
{% set escuela = postulantes.escuela %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Publico</li>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Información del Publico ...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('datos/savePublicoA','method':
                                    'post','id':'form_postulantes','class':'smart-form','enctype':'multipart/form-data')
                                    }}
                                    <fieldset>


                                        <div class="row">

                                            <section class="col col-md-4">
                                                <label class="text-info">Imagen del Público</label>
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-toggle="collapse" data-target="#imagen_publico"><i
                                                        class="fa fa-hand-o-up"></i> Click Aquí para mostrar
                                                    Imagen</button>

                                                <div id="imagen_publico" class="collapse">

                                                    {% if foto !== "" %}
                                                    <center>
                                                        <img class="img-responsive"
                                                            src="{{ url('adminpanel/imagenes/publico/personales/'~foto) }}"
                                                            error="this.onerror=null;this.src='';" width="240"
                                                            height="288"></img>
                                                    </center>
                                                    {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                    {% endif %}
                                                </div>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Documento</label>
                                                <label class="select">
                                                    <select id="input-documento" name="documento">
                                                        <option value="">Seleccione...</option>
                                                        {% for documentocolegiado in documentopostulantes %}
                                                        {% if documentocolegiado.codigo == documento_postulantes %}
                                                        <option selected="selected"
                                                            value="{{ documentocolegiado.codigo }}">{{
                                                            documentocolegiado.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ documentocolegiado.codigo }}">{{
                                                            documentocolegiado.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Nro. Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nro_doc" name="nro_doc"
                                                        placeholder="DNI" value="{{ nro_doc }}" readonly>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Apellido Paterno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellidop" name="apellidop"
                                                        placeholder="Apellido Paterno" value="{{apellidop }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Apellido Materno</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-apellidom" name="apellidom"
                                                        placeholder="Apellido Materno" value="{{apellidom }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Nombres</label>
                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nombres" name="nombres"
                                                        placeholder="Nombres" value="{{nombres }}">
                                                    <input type="hidden" id="input-codigo" name="codigo"
                                                        value="{{ codigo }}">
                                                    <input type="hidden" id="input-estado_registrado"
                                                        name="estado_registrado" value="{{ estado }}">
                                                </label>
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info">Sexo</label>
                                                <label class="select">
                                                    <select id="input-sexo" name="sexo">

                                                        {% for sexo_model in sexos %}
                                                        {% if sexo_model.codigo == sexo %}
                                                        <option selected="selected" value="{{ sexo_model.codigo }}">{{
                                                            sexo_model.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}
                                                        </option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info">Celular</label>
                                                <label class="input"> <i class="icon-prepend fa fa-mobile-phone"></i>
                                                    <input type="text" id="input-celular" name="celular"
                                                        placeholder="Celular" value="{{celular }}">
                                                </label>
                                            </section>

                                            
                                            <section class="col col-md-4">
                                                <label class="text-info">Ciudad</label>
                                                <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                    <input type="text" id="input-ciudad" name="ciudad"
                                                        placeholder="Ciudad" value="{{ciudad }}">
                                                </label>
                                            </section>

      

                                            <section class="col col-md-4">
                                                <label class="text-info">Email</label>
                                                <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                    <input type="text" id="input-email" name="email" placeholder="Email"
                                                        value="{{email }}">
                                                </label>
                                            </section>

                                        </div>

                                        <div class="row">

                                            <section class="col col-md-8">
                                                <label class="text-info"> Universidades
                                                </label>
                                                <select style="width:100%" id="input-id_universidad"
                                                    name="id_universidad">
                                                    <option value="">Seleccione...</option>
                                                    {% for universidades_select in universidades %}
                                                    {% if universidades_select.id_universidad == id_universidad %}
                                                    <option selected="selected"
                                                        value="{{ universidades_select.id_universidad }}">
                                                        {{universidades_select.universidad }}
                                                    </option>
                                                    {% else %}
                                                    <option value="{{ universidades_select.id_universidad }}">
                                                        {{universidades_select.universidad }}
                                                    </option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                <p id="warning-id_universidad"></p>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Número Colegiatura (Si no esta colegiado dejar
                                                    en blanco)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-colegio_profesional_nro"
                                                        name="colegio_profesional_nro" placeholder="Número Colegiatura"
                                                        value="{{colegio_profesional_nro }}">
                                                </label>
                                            </section>






                                            <section class="col col-md-8">
                                                <label class="text-info">Facultad y/o Escuela de Enfermería</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-escuela" name="escuela"
                                                        placeholder="Escuela" value="{{escuela}}">
                                                </label>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info">Categoría</label>
                                                <label class="select">
                                                    <select id="input-categoria" name="categoria">
                                                        <option value="">Seleccione...</option>

                                                        {% for categoriapostulante_select in categoriapostulante %}
                                                        {% if categoriapostulante_select.codigo == categoria %}
                                                        <option selected="selected"
                                                            value="{{ categoriapostulante_select.codigo }}">{{
                                                            categoriapostulante_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ categoriapostulante_select.codigo }}">{{
                                                            categoriapostulante_select.nombres }}</option>
                                                        {% endif %}
                                                        {% endfor %}

                                                    </select> <i></i>
                                                </label>
                                            </section>


    




                                        </div>

                                        <div class="row">

                                            <section class="col col-md-4">

                                                <label class="text-info">Foto (jpg/jpeg/png) (240 x 288 px)</label>
                                                <div class="input input-file">

                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file"
                                                                name="imagen"
                                                                onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                                class="fa fa-search"></i> Buscar</span><input
                                                            type="text" id="input-image" name="input-file-imagen"
                                                            placeholder="Agregar Imagen" readonly="">

                                                    </label>
                                                </div>

                                                {% if foto !== "" %}

                                                <div class="alert alert-success fade in" id="">

                                                    Click aqui para ver la imagen
                                                    <a href="javascript:void(0);" class="btn btn-ribbon" role="button"
                                                        onclick="imagen_registro();"> <i
                                                            class="fa-fw fa fa-image"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                </div>

                                                {% endif %}

                                                <span id="warning-imagen"></span>

                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info">DNI (Archivo pdf)</label>
                                                <div class="input input-file">


                                                    <span class="button"><input id="archivo" type="file" name="archivo"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file-archivo" name="input-file"
                                                        placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo !== "" %}

                                                <div class="alert alert-success fade in" id="">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/publico/personales/'~archivo) }}">
                                                        <i class="fa-fw fa fa-book"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                </div>

                                                {% endif %}
                                                <span id="warning-archivo"></span>
                                            </section>

                                            <section class="col col-md-4">


                                                {% for categoriapostulante_select in categoriapostulante %}
                                                {% if categoriapostulante_select.codigo == categoria %}
                                                <label class="text-info">Archivo <span
                                                        id="input-label_archivo_escuela">{{categoriapostulante_select.descripcion
                                                        }}</span> (pdf)
                                                </label>
                                                {% endif %}
                                                {% endfor %}

                                                <div class="input input-file">

                                                    <span class="button"><input id="archivo_escuela" type="file"
                                                            name="archivo_escuela"
                                                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i
                                                            class="fa fa-search"></i> Buscar</span><input type="text"
                                                        id="input-file-archivo_escuela" name="input-file"
                                                        placeholder="Agregar Archivo" readonly="">

                                                </div>

                                                {% if archivo_escuela !== "" %}

                                                <div class="alert alert-success fade in" id="">

                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/publico/personales/'~archivo_escuela) }}">
                                                        <i class="fa-fw fa fa-book"></i></a>
                                                </div>


                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                </div>

                                                {% endif %}
                                                <span id="warning-archivo_escuela"></span>
                                            </section>

                                        </div>



                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()" type="button" class="btn btn-default">
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
<div class="modal fade" id="modal_registro_imagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Imagen</h4>
            </div>
            <div class="modal-body">
                <center>
                    <img src="{{ url('adminpanel/imagenes/publico/personales/'~foto) }}"
                        error="this.onerror=null;this.src='';" width="240" height="288"></img>
                </center>

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
<script type="text/javascript">
    var codigo_colegiado = '{{ codigo }}';
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

</script>

<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente...
        </p>
    </div>
</div>


<script type="text/javascript">


    var publica = "si";
    var region_id = '{{ region }}';
    var provincia_id = '{{ provincia }}';
    var distrito_id = '{{ distrito }}';

    var region1_id = '{{ region1 }}';
    var provincia1_id = '{{ provincia1 }}';
    var distrito1_id = '{{ distrito1 }}';
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>