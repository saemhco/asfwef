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
        <!--  <div class="col-md-2">
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
                  <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block">Notas por Ciclo</a>

                  <a href="javascript:void(0);" onclick="editar()" class="btn btn-primary btn-block">Notas por Semestre</a>

              </div>
          </div>
      </div>

  </div> -->

        <div class="col-md-12" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>BOLETA DE NOTAS  --- CARRERA PROFESIONAL: {{ carrera.descripcion }}  </strong></h2>	



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

                                            <div class="widget-body" >
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

                                                                        <table class="table table-bordered table-hover" style="font-size: 9px;" >
                                                                        <thead>
                                                                            <tr>
                                                                                <th rowspan="2" style="vertical-align: middle;text-align: center;" >CODIGO</th>
                                                                                <th rowspan="2" style="vertical-align: middle;text-align: center;">ASIGNATURA</th>
                                                                                <th width="10" style="text-align: center;" >PROMEDIO 01</th>
                                                                                <th width="10" style="text-align: center;" >PROMEDIO 02</th>
                                                                                <th width="10" style="vertical-align: middle;text-align: center;"  rowspan="2" >EVALUACIÓN<br>CONTINUA</th>
                                                                                <th width="10" style="vertical-align: middle;text-align: center;"  rowspan="2" >EXAMEN<br>SUSTITUTORIO</th>
                                                                                <th width="12" style="vertical-align: middle;text-align: center;"  rowspan="2" >PROMEDIO<br>FINAL</th>
                                                                            
                                                                            </tr>

                                                                        </thead>
                                                                        <tbody>
                                                                            {% for det in record['detalle_notas'] %}
                                                                                <tr>
                                                                                    <td>{{ det['asignatura'] }}</td>
                                                                                    <td>{{ det['curso'] }}</td>
                                                                                    <td><center>{{ det['ep1'] }}</center></td>
                                                                                    
                                                                                    <td><center>{{ det['ep2'] }}</center></td>
                                                                                    
                                                                                   <td><center><strong>{{ det['ef'] }}</strong></center></td>
                                                                                    <td><center>{{ det['ea'] }}</center></td>
                                                                                    <td><center><strong>{{ det['pf'] }}</strong></center></td>
                                                                                    
                                                                                </tr>
                                                                            {% endfor %}
                                                                            <tr style="font-size: 12px;">
                                                                                <td colspan="7" >Total de Asignaturas: <strong> {{ record['cursillos'] }}</strong></td>
                                                                              
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </div>


                                                            </div>
                                                        {% else %}
                                                            <div class="tab-pane fade" id="hr-{{ loop.index }}">


                                                                <div class="table-responsive">

                                                                     <table class="table table-bordered table-hover" style="font-size: 9px;" >
                                                                        <thead>
                                                                            <tr>
                                                                                <th rowspan="2" style="vertical-align: middle;text-align: center;" >CODIGO</th>
                                                                                <th rowspan="2" style="vertical-align: middle;text-align: center;">ASIGNATURA</th>
                                                                                <th width="10" style="text-align: center;" >PROMEDIO 01</th>
                                                                                <th width="10" style="text-align: center;" >PROMEDIO 02</th>
                                                                                <th width="10" style="vertical-align: middle;text-align: center;"  rowspan="2" >EVALUACIÓN<br>CONTINUA</th>
                                                                                <th width="10" style="vertical-align: middle;text-align: center;"  rowspan="2" >EXAMEN<br>SUSTITUTORIO</th>
                                                                                <th width="12" style="vertical-align: middle;text-align: center;"  rowspan="2" >PROMEDIO<br>FINAL</th>
                                                                            
                                                                            </tr>                                                                        

                                                                        </thead>
                                                                        <tbody>
                                                                            {% for det in record['detalle_notas'] %}
                                                                                <tr>
                                                                                    <td>{{ det['asignatura'] }}</td>
                                                                                    <td>{{ det['curso'] }}</td>
                                                                                    <td><center>{{ det['ep1'] }}</center></td>
                                                                                    
                                                                                    <td><center>{{ det['ep2'] }}</center></td>
                                                                                    
                                                                                    <td><center><strong>{{ det['ef'] }}</strong></center></td>
                                                                                    <td><center>{{ det['ea'] }}</center></td>
                                                                                    <td><center><strong>{{ det['pf'] }}</strong></center></td>
                                                                                    
                                                                                </tr>
                                                                            {% endfor %}
                                                                            <tr style="font-size: 12px;">
                                                                                <td colspan="7" >Total de Asignaturas: <strong> {{ record['cursillos'] }}</strong></td>
                                                                              
                                                                            </tr>
                                                                        </tbody>
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
