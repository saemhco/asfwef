
{% set archivo_solicitud = "" %}
{% if cp.archivo_solicitud is defined %}
    {% set archivo_solicitud = cp.archivo_solicitud %}
{% endif %}

{% set archivo_dni = "" %}
{% if cp.archivo_dni is defined %}
    {% set archivo_dni = cp.archivo_dni %}
{% endif %}

{% set archivo_silabo = "" %}
{% if cp.archivo_silabo is defined %}
    {% set archivo_silabo = cp.archivo_silabo %}
{% endif %}

{% set archivo_dj = "" %}
{% if cp.archivo_dj is defined %}
    {% set archivo_dj = cp.archivo_dj %}
{% endif %}

{% set txt_buton = "Registrar" %}
{% if cp.codigo is defined %}
    {% set codigo = cp.codigo %}
    {% set txt_buton = "Guardar" %}
{% endif %}


<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Datos Generales</li>
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
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Datos Generales</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    {{ form('gestionconvocatorias/saveDatosGenerales2','method': 'post','id':'form_publico','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">
                                                                                        
                                            <section class="col col-md-6">

                                                <label class="text-info" >Solicitud de inscripción y postulación (Anexo N° 03) </label>
                                                <div class="input input-file">

                                                    <span class="button"><input id="archivo_solicitud" type="file" name="archivo_solicitud" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar </span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if archivo_solicitud !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_solicitud) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >DNI vigente</label>
                                                <div class="input input-file">


                                                    <span class="button"><input id="archivo_dni" type="file" name="archivo_dni" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if archivo_dni !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_dni) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Sílabo de las asignaturas</label>
                                                <div class="input input-file">

                

                                                    <span class="button"><input id="archivo_silabo" type="file" name="archivo_silabo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if archivo_silabo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_silabo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            
                                            <section class="col col-md-6">

                                                <label class="text-info" >Declaraciones Juradas. (Anexo N° 02)</label>
                                                <div class="input input-file">

                

                                                    <span class="button"><input id="archivo_dj" type="file" name="archivo_dj" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if archivo_dj !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_dj) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <input type="hidden" id="id_convocatoria" name="id_convocatoria"
                                            value="{{ id_convocatoria }}">
         
         


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
                {% if foto !== "" %}
                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/publico/'~foto) }}" error="this.onerror=null;this.src='';"></img>
                {% endif %}

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
    var codigo_colegiado = '{{ codigo }}';
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

</script>

<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente su postulación...
        </p>
    </div>
</div>


<script type="text/javascript" >


    var publica = "si";

    //Ubigeo
    var region_id = '{{ region }}';
    var provincia_id = '{{ provincia }}';
    var distrito_id = '{{ distrito }}';

    //Lugar de procedencia
    var region1_id = '{{ region1 }}';
    var provincia1_id = '{{ provincia1 }}';
    var distrito1_id = '{{ distrito1 }}';


</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>