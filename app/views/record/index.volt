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
        <li>Panel</li><li>Record Académico</li>
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
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>RECORD ACADÉMICO  --- PROGRAMA: {{ carrera.descripcion }}  </strong></h2>	
                            </header>
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <div class="row" >
                                        <div class="col col-md-12" >  

                                            <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="8">
                                                <center>DATOS DEL {{ texto_ciclo }}</center>
                                                </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="font-size: 12px !important;" >
                                                        <td>Código:<strong> {{ alumno.codigo }}<input type="hidden" name="codigoalumno" value="{{ alumno.codigo }}"></strong></td>
                                                        <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                                        <td>Nombres: {{ alumno.nombres }}</td>
                                                        <td>Ciclo: <strong>{{ ciclo }}</strong><input type="hidden" name="semestre" value="{{ semestre.codigo }}"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div> 

                                        <div class="col-md-12">

                                            <div class="widget-body no-border" >
                                                <ul id="widget-tab-1" class="nav nav-tabs bordered">
                                                    {% for record in records %}
                                                        {% if loop.first %}
                                                            <li class="active">

                                                                <a data-toggle="tab" href="#hr-{{ loop.index }}"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> {{ record['semestre_name'] }} </span> </a>

                                                            </li>
                                                        {% else %}

                                                            <li>
                                                                <a data-toggle="tab" href="#hr-{{ loop.index }}"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> {{ record['semestre_name'] }} </span></a>
                                                            </li>
                                                        {% endif %}



                                                    {% endfor %}
                                                </ul>	
                                                <div id="myTabContent1" class="tab-content">
                                                    {% for record in records %}

                                                        {% if loop.first %}
                                                            <div class="tab-pane fade in active" id="hr-{{ loop.index }}">


                                                                <div class="table-responsive">

                                                                    <table class="table table-bordered table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Codigo</th>
                                                                                <th><center>Ciclo</center></th>
                                                                        <th>Asignatura</th>
                                                                        <th><center>Créditos</center></th>
                                                                        <th><center>Promedio</center></th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            {% for det in record['detalle_notas'] %}
                                                                                <tr>
                                                                                    <td>{{ det['asignatura'] }}</td>
                                                                                    <td><center>{{ det['ciclo'] }}</center></td>
                                                                            <td>{{ det['curso'] }}</td>
                                                                            <td><center>{{ det['creditos'] }}</center></td>
                                                                                {%if det["aprobado"] == "si" %}
                                                                                <td><center><label class="text-info">{{ det['nota'] }}</label></center></td>
                                                                                {% else %}
                                                                                <td><center><label class="text-danger">{{ det['nota'] }}</label></center></td>
                                                                                {% endif %}
                                                                            </tr>
                                                                        {% endfor %}
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td style="text-align: right;">Total de creditos: </td>
                                                                            <td><center><strong> {{ record['sum_creditos'] }}</strong></center></td>
                                                                        <td>Ponderado: <strong> {{ record['prom_semestre'] }}</strong></td>                                                                                
                                                                        </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr style="font-size: 16px;">
                                                                                <td colspan="5">Total de Asignaturas:<strong> {{ record['total_asignaturas'] }}</strong></td>

                                                                            </tr>
                                                                            <tr style="font-size: 16px;">
                                                                                <td colspan="5"><center><a role="button" href="{{ url('reportes/reporteboletanotaspromedio/'~record['semestre']~'/'~alumno.codigo) }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  BOLETA DE NOTAS PROMEDIO
                                                                            </a></center></td>

                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                        {% else %}
                                                            <div class="tab-pane fade" id="hr-{{ loop.index }}">


                                                                <div class="table-responsive">

                                                                    <table class="table table-bordered table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Codigo</th>
                                                                                <th><center>Ciclo</center></th>
                                                                        <th>Asignatura</th>
                                                                        <th><center>Créditos</center></th>
                                                                        <th><center>Promedio</center></th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            {% for det in record['detalle_notas'] %}
                                                                                <tr>
                                                                                    <td>{{ det['asignatura'] }}</td>
                                                                                    <td><center>{{ det['ciclo'] }}</center></td>
                                                                            <td>{{ det['curso'] }}</td>
                                                                            <td><center>{{ det['creditos'] }}</center></td>
                                                                                {%if det["aprobado"] == "si" %}
                                                                                <td><center><label class="text-info">{{ det['nota'] }}</label></center></td>
                                                                                {% else %}
                                                                                <td><center><label class="text-danger">{{ det['nota'] }}</label></center></td>
                                                                                {% endif %}
                                                                            </tr>
                                                                        {% endfor %}
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td style="text-align: right;">Total de creditos: </td>
                                                                            <td><center><strong> {{ record['sum_creditos'] }}</strong></center></td>
                                                                        <td>Ponderado: <strong> {{ record['prom_semestre'] }}</strong></td>                                                                                
                                                                        </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr style="font-size: 16px;">
                                                                                <td colspan="5">Total de Asignaturas:<strong> {{ record['total_asignaturas'] }}</strong></td>

                                                                            </tr>
                                                                            <tr style="font-size: 16px;">
                                                                                <td colspan="5"><center><a role="button" href="{{ url('reportes/reporteboletanotaspromedio/'~record['semestre']~'/'~alumno.codigo) }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  BOLETA DE NOTAS PROMEDIO
                                                                            </a></center></td>

                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                        {% endif %}   

                                                    {% endfor %}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Widget ID (each widget will need unique ID)-->

                        <!-- end widget -->	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
