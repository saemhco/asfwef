<style>
    .form-control{ 
        width: 455px !important;
    }
</style>
{% set texto_ciclo = "ALUMNO" %}
{% if ciclo == "" %}
    {% set texto_ciclo = "EGRESADO" %}
    {% set ciclo = "E" %}
{% endif %}
<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Notas</li>
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

                                <h2><strong>RECORD ACADÉMICO - CARRERA PROFESIONAL: {{ carrera.descripcion }}  </strong></h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">

                                    <fieldset>
                                        <div class="row">

                                            <div class="col col-md-12" >  

                                                <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4">
                                                    <center>DATOS DEL {{ texto_ciclo }}</center>
                                                    </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="font-size: 12px !important;" >
                                                            <td>Código:<strong> {{ alumno.codigo }}</strong></td>
                                                            <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                                            <td>Nombres: {{ alumno.nombres }}</td>
                                                            <td>Ciclo: <strong>{{ ciclo }}</strong> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div> 


                                            <section class="col col-md-12" >
                                                {#                                                <header style="margin-top: 10px;">
                                                                                                    Asignaturas 
                                                                                                </header>#}
                                                <fieldset>

                                                    <div class="row">

                                                        <section class="col col-md-12">


                                                            <table id="tbl_notas_alumnos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                                <thead>			                
                                                                    <tr>
                                                                        {#<th>
                                                                <center><i class="fa fa-check-circle"></i></center>
                                                                </th>#}
                                                                <th data-class="expand">Semestre</th>
                                                                <th data-class="expand">Asignatura</th>

                                                                <th>Nombre Asignatura</th>
                                                                <th data-hide="phone,tablet">Ciclo</th>
                                                                <th data-hide="phone,tablet">Tipo</th>
                                                                <th data-hide="phone,tablet">veces</th>
                                                                <th data-hide="phone,tablet">Pf</th>
                                                                <th data-hide="phone,tablet">Observacion</th>
                                                                <th data-hide="phone,tablet">Estado</th>


                                                                </tr>
                                                                </thead>
                                                                <tbody>				
                                                                </tbody>
                                                            </table>	
                                                        </section>

                                                    </div>
                                                </fieldset>
                                            </section>
                                        </div> 
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                        </div> 
                                    </fieldset>

                                    <footer>
                                        <a href="{{ url('gestionalumnos') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>

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
    <div id="error_tipo">

        <p>
            Solo se permite editar alumnoses...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_asignatura_registrada">
        <p>
            Asignatura registrada, no se puede actualizar...
        </p>
    </div>
</div>

<script type="text/javascript" >
    var id = "";

    {% if id is defined %}
        id = {{ id }};
    {% endif %}



        //alert("Hola");
</script>