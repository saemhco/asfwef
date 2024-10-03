
{% set archivo_solicitud = "" %}
{% if cp.archivo_solicitud is defined %}
    {% set archivo_solicitud = cp.archivo_solicitud %}
{% endif %}

{% set archivo_proyecto = "" %}
{% if cp.archivo_proyecto is defined %}
    {% set archivo_proyecto = cp.archivo_proyecto %}
{% endif %}

{% set carta_cumplir = "" %}
{% if cp.carta_cumplir is defined %}
    {% set carta_cumplir = cp.carta_cumplir %}
{% endif %}

{% set carta_presentar = "" %}
{% if cp.carta_presentar is defined %}
    {% set carta_presentar = cp.carta_presentar %}
{% endif %}

{% set carta_difundir = "" %}
{% if cp.carta_difundir is defined %}
    {% set carta_difundir = cp.carta_difundir %}
{% endif %}

{% set carta_ejecucion = "" %}
{% if cp.carta_ejecucion is defined %}
    {% set carta_ejecucion = cp.carta_ejecucion %}
{% endif %}



{% set reporte_similitud = "" %}
{% if cp.reporte_similitud is defined %}
    {% set reporte_similitud = cp.reporte_similitud %}
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
                                    {{ form('gestionconvocatorias/saveDatosGenerales4','method': 'post','id':'form_publico','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>


                                        <div class="row">
                                                                                        
                                            <section class="col col-md-6">

                                                <label class="text-info" >Solicitud de postulación e inscripción. (Anexo 01) </label>
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

                                                <label class="text-info" >Archivo Proyecto. (Anexo 02)</label>
                                                <div class="input input-file">


                                                    <span class="button"><input id="archivo_proyecto" type="file" name="archivo_proyecto" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if archivo_proyecto !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_proyecto) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>


                                            
                                            <section class="col col-md-6">

                                                <label class="text-info" >Carta de compromiso de cumplir. (Anexo 03)</label>
                                                <div class="input input-file">

                

                                                    <span class="button"><input id="carta_cumplir" type="file" name="carta_cumplir" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if carta_cumplir !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~carta_cumplir) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>
         
                                            <section class="col col-md-6">

                                                <label class="text-info" >Carta de compromiso de presentar. (Anexo 04)</label>
                                                <div class="input input-file">

                

                                                    <span class="button"><input id="carta_presentar" type="file" name="carta_presentar" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if carta_presentar !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~carta_presentar) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Carta de compromiso de difundir. (Anexo 05)</label>
                                                <div class="input input-file">

                

                                                    <span class="button"><input id="carta_difundir" type="file" name="carta_difundir" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if carta_difundir !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~carta_difundir) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Carta de compromiso de ejecución. (Anexo 06)</label>
                                                <div class="input input-file">

                

                                                    <span class="button"><input id="carta_ejecucion" type="file" name="carta_ejecucion" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                </div>

                                                {% if carta_ejecucion !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~carta_ejecucion) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Reporte de Similitud</label>
                                                    <div class="input input-file">
                                                         <span class="button"><input id="carta_ejecucion" type="file" name="carta_ejecucion" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

                                                                                            </div>

                                                                                            {% if reporte_similitud !== ""   %}

                                                                                                <div class="alert alert-success fade in">

                                                                                                    Click aqui para ver el archivo
                                                                                                    <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~carta_ejecucion) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                                                                </div>


                                                                                            {% else %}

                                                                                                <div class="alert alert-warning fade in">
                                                                                                    <i class="fa-fw fa fa-warning"></i>
                                                                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                                                </div>

                                                                                            {% endif %}

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