<style>
   .dataTables_filter input { width: 335px !important; }
</style>
{% set region1 = "" %}
<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets"   rel="tooltip" data-placement="bottom" data-original-title="" data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion de Asistencias</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
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
                        <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>

            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Reportes</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center">

                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_asistencias();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Reporte de Asistencia"><i class="fa fa-file-pdf-o"></i></a>
                        {#<a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_registro_auxiliar();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Registro Auxiliar"><i class="fa fa-file-pdf-o"></i></a>#}

                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11" style="margin-bottom: -30px;">
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
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>Registro de asistencias </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	
                                    <table class="table">
                                        <tr>
                                            <td>
                                        <center>
                                            <select class="form-control" id="semestre" >
                                                <option value="">--SELECCIONE SEMESTE--</option>
                                                {% if sem is defined %}
                                                    {% for s in semestres %}
                                                        {% if s.codigo == sem %}
                                                            <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                        {% else %}
                                                            <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                        {% endif %}
                                                    {% endfor %}
                                                {% else %}
                                                    {% for s in semestres %}
                                                        {% if s.codigo == semestrea %}
                                                            <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                        {% else %}
                                                            <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endif %}
                                            </select>
                                        </center>
                                        </td>
                                        </tr>
                                    </table>
                                    <table class="table">
                                        <tr>
                                            <td>
                                        <center>
                                            <select class="form-control" id="asignatura"  name="asignatura">
                                                <option>ASIGNATURAS</option>

                                            </select> <i></i> 

                                        </center>
                                        </td>
                                        </tr>
                                    </table>

                                    <table id="tbl_asignaturas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 



                                        <th data-class="expand">Fecha</th>
                                        <th>Hora</th>
                                        <th data-hide="phone,tablet">Tema</th>
                                        <th data-hide="phone,tablet">Observación</th>                                   
                                        
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
<div class="hidden">
    <div id="error_agregar">
        <p>
            Debe Selecionar una asignatura
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_editar_asistencia_cerrada">
        <p>
            La asistencia fue cerrada
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_eliminar">
        <p>
            La asistencia fue cerrada no se puede eliminar
        </p>
    </div>
</div>
<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
//var distrito_id = '';
</script>
<script type="text/javascript" >




    {% if sem is defined %}
        var semestreax = "{{ sem }}";
        //console.log("Carga semestre seleccionado: " + semestreax);
    {% else %}
        var semestreax = "{{ semestrea }}";
        //console.log("Carga semestre por defecto: " + semestreax);
    {% endif %}


    {% if asignatura is defined %}
        var asignatura = "{{ asignatura }}";
        //console.log("Carga asignatura enviada del select: " + asignatura);
    {% else %}
        var asignatura = '';
        //console.log("Carga asignatura por defecto 0 index: " + asignatura);
    {% endif %}


    {% if grupo is defined %}
        var grupo = "{{ grupo }}";
        console.log("Grupo: " + grupo);
    {% else %}
        var grupo = '';
        //console.log("Carga asignatura por defecto 0 index: " + asignatura);
    {% endif %}

    {% if subgrupo is defined %}
        var subgrupo = "{{ subgrupo }}";
        console.log("Subgrupo: " + subgrupo);
    {% else %}
        var subgrupo = '';
        //console.log("Carga asignatura por defecto 0 index: " + asignatura);
    {% endif %}
</script>

