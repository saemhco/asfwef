

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Procesos Gestion Personal</li>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Procesos Gestion Personal</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="6" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">


                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-registrar-personal">
                                                        <i class="fa fa-users"></i> Registrar Personal
                                                    </button>
                                                    
                                                </div>


       
                                            </div>
                                        </fieldset>
                                    </form>

                                </div>
                                <!-- end widget content -->	
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>
    </div>


    <div class="row">
        {% if activa_btn_docs !== 0 %}


    {% endif %}
    </div>
</div>


<!--Formulario de registro -->
{{ form('registroconvocatorias/savearchivo','method': 'post','id':'form_convocatorias_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info" >Convocatoria </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titulo_detalle" name="titulo_detalle" placeholder="Titular">
                <input type="hidden" id="input-id_convocatoria_detalle_pk" name="id_convocatoria_detalle" value="">
                <input type="hidden" id="input-id_convocatoria" name="id_convocatoria" value="{{ id_convocatoria }}">
            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_detalle" name="fecha_hora_detalle" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_detalle" name="enlace_detalle" placeholder="Enlace" value="">

            </label>
        </section>

        <section class="col col-md-12" >
            <label class="text-info" >Imagen Convocatoria Detalle</label>

            <br>
            <img id="imagen_detalle" class="img-responsive"  error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

            <div class="input input-file" style="margin-top: 26px;">
                <label class="text-info" >Agregar Imagen</label>
                <label class="input">
                    <input id="imagen_convocatorias_detalle" type="file" name="imagen_convocatoria_detalle" onchange="this.parentNode.nextSibling.value = this.value">
                </label>
            </div>
        </section>

        <section class="col col-md-12">

            <label class="text-info" ></label>
            <div class="input input-file" style="margin-bottom: 5px;" id="ver_archivo">

                <input type="file" id="archivo_convocatoria_detalle" name="archivo_convocatoria_detalle">
                <input type="hidden" id="input-archivo_detalle" name="imput-archivo_detalle" value="{{ archivo_detalle }}">
            </div>
        </section>





    </div>
</fieldset>
{{ endForm() }}

{{ form('registroconvocatorias/saveUsuariosDetalles','method': 'post','id':'form_usuarios_detalles','class':'smart-form','style':'display:none;') }}
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
    <input type="hidden" id="input-id_tabla" name="id_tabla" value="{{ id_convocatoria }}">

</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="exito_convocatorias">
        <p>
            Se registró correctamente ...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_resolucion_registrada">
        <p>
            Convocatoria ya registrada...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de resolución...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de convocatoria...

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
    var id_convocatoria = {{ id_convocatoria }};
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>