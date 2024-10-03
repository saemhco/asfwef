
<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
    .dataTables_filter input { width: 335px !important; }
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
<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="content">

    {% if actividades.id_actividad is defined %}

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
                                            <a href="javascript:history.back();" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
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