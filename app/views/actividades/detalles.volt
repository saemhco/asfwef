<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_actividad = "" %}
{% if actividades.id_actividad is defined %}
    {% set id_actividad = actividades.id_actividad %}
{% endif %}


{% set fecha = "" %}
{% if actividades.fecha is defined %}
    {% set fecha = utilidades.fechita(actividades.fecha,'d/m/Y') %}
{% endif %}

{% set archivo = "" %}
{% if actividades.archivo is defined %}
    {% set archivo = actividades.archivo %}
{% endif %}





<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Actividades Detalles</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">

    {% if actividades.id_actividad is defined %}

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
                                    <h2>Actividades de fecha: {{ fecha }}</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_actividades_detalles" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>
                                            <th data-class="expand">Turno</th>
                                            <th data-hide="phone,tablet">Descripcion</th>



                                            </tr>
                                            </thead>
                                            <tbody>			
                                            </tbody>
                                        </table>
                                        <footer>
                                            <a href="{{ url('actividades') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                        </footer>
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
    <div id="exito_actividades">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<!--Formulario de registro archivos-->
{{ form('gestionactividades/saveActividadesDetalles','method': 'post','id':'form_actividades_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">


        <section class="col col-md-12">
            <label class="text-info" >Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                {#<textarea rows="5" id="input-descripcion" name="descripcion_ckeditor" placeholder=""></textarea>#}
                <textarea rows="6" id="input-descripcion" name="descripcion" placeholder=""></textarea> 
            </label>

        </section>


        {#<section class="col col-md-6" >
            <label class="text-info" >Fecha</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_hora_actividades_archivos" name="fecha_hora_actividades_archivos" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>#}

        <section class="col col-md-6">
            <label class="text-info" >Turno</label>
            <label class="select">
                <select id="input-turno"  name="turno" >
                    <option value="" >SELECCIONE...</option>
                    {% for turnos_select in turnos %}
                        {% if turnos_select.codigo == turno %}
                            <option selected="selected" value="{{ turnos_select.codigo }}">{{ turnos_select.nombres }}</option>   
                        {% else %}
                            <option value="{{ turnos_select.codigo }}">{{ turnos_select.nombres }}</option>   
                        {% endif %}

                    {% endfor %}
                </select> <i></i>
                <input type="hidden" id="input-id_actividad_detalle" name="id_actividad_detalle" value="">
                <input type="hidden" id="input-actividad" name="actividad" value="{{ id_actividad }}">
            </label>
        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" style="margin-bottom: 5px;" id="ver_archivo">
                <input type="file" id="archivo_actividades_archivos" name="archivo_actividades_archivos">
                <input type="hidden" id="input-archivo_actividades_archivos" name="imput-archivo_actividades_archivos" value="">
            </div>
        </section>
    </div>
</fieldset>
{{ endForm() }}
<div class="hidden">
    <div id="fecha_vacio">
        <p>
            Debe ingresar un fecha...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="fecha_registrada">
        <p>
            La fecha ya esta registrada...
        </p>
    </div>
</div>
<!-- fin form -->
<script type="text/javascript" >
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = {{ id }};
    {% endif %}
        //alert("Hola");
</script>
<script type="text/javascript" >
    {% if id_actividad %}
        var id_actividad = {{ id_actividad }};
    {% else %}
        var id_actividad = 0;
    {% endif %}
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>