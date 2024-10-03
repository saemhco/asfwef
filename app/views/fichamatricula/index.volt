
<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Ficha de Matrícula</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <!--  <div class="col-md-2">
      <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">                               
          <header class="">
              <center>
                  <span class="widget-icon"> <i class="fa fa-hand-o-up"></i> </span> OPCIONES
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

        <div class="col-md-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>FICHA DE MATRÍCULA  --- SEMESTRE {{ semestre.descripcion }}  --- PROGRAMA: {{ carrera.descripcion }}  </strong></h2>	



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
                                                <center>DATOS DEL ESTUDIANTE</center>
                                                </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Código:<strong> {{ alumno.codigo }}<input type="hidden" name="codigoalumno" value="{{ alumno.codigo }}"></strong></td>
                                                        <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                                        <td>Nombres: {{ alumno.nombres }}</td>
                                                        <td>Ciclo: <strong>{{ ciclo }}</strong><input type="hidden" name="semestre" value="{{ semestre.codigo }}"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> 
                                        <div class="col-md-12">





                                            <!-- widget content -->
                                            <div class="widget-body" >



                                                <ul id="myTab1" class="nav nav-tabs bordered">
                                                    <li class="active">
                                                        <a href="#s1" data-toggle="tab">Asignaturas Matriculadas<span class="badge bg-color-blue txt-color-white">{{ total }}</span></a>
                                                    </li>

                                                    <li>
                                                        <a href="#s2" data-toggle="tab">Asignaturas Ofertadas<span class="badge bg-color-blue txt-color-white">{{ totalcursos }}</span></a>
                                                    </li>


                                                </ul>

                                                <div id="myTabContent1" class="tab-content">
                                                    <div class="tab-pane  active" id="s1">
                                                        <div class="table-responsive">
                                                            <table class="table-primary table-bordered table" style="font-size: 10px !important;" >
                                                                <thead>
                                                                    <tr>
                                                                        <th width="12%">Codigo</th>
                                                                        <th width="8%" style="vertical-align: middle;text-align: center;">Ciclo</th>
                                                                        <th>Asignatura</th>                                                                        
                                                                        <th width="5%" style="vertical-align: middle;text-align: center;">Grupo</th>
                                                                        <th width="5%" style="vertical-align: middle;text-align: center;">Creditos</th>
                                                                        <th width="15%">Tipo</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {% set sum = 0 %}
                                                                    {% for curso in cursos %}
                                                                        {% set sum = sum+curso.creditos %}
                                                                        <tr>
                                                                            <td >{{ curso.asignatura }}</td>
                                                                            <td style="vertical-align: middle;text-align: center;" id="ciclo-{{ curso.asignatura }}">{{ curso.ciclo }}</td>
                                                                            <td id="nombre-{{ curso.asignatura }}">{{ curso.nombre }}</td>
                                                                            <td style="vertical-align: middle;text-align: center;" id="creditos-{{ curso.asignatura }}">{{ curso.grupo }}</td>
                                                                            <td style="vertical-align: middle;text-align: center;" id="creditos-{{ curso.asignatura }}">{{ curso.creditos }}</td>
                                                                            <td id="tipo-{{ curso.asignatura }}">{{ curso.tipo_matricula }}</td>
                                                                        </tr>

                                                                    {% endfor %}

                                                                    <tr>
                                                                        <td colspan="2" ><h4>TOTAL ASIGNATURAS:  {{ total }}</h4></td>
                                                                        <td colspan="2" style="text-align: right;" ><h4>TOTAL CREDITOS </h4></td>
                                                                        <td><h4>{{ sum }}</h4></td>
                                                                        <td></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">
                                                                <center> <a role="button" href="{{ url('fichamatricula/imprime/1/2') }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  DESCARGAR FICHA DE MATRICULA </a></center>
                                                                </td>
                                                                </tr>
                                                                </tbody>    
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="s2">
                                                        <table class="table-primary table-bordered table" style="font-size: 10px !important;" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Codigo</th>
                                                                    <th>Asignatura</th>
                                                                    <th>Ciclo</th>
                                                                    <th>Creditos</th>
                                                                    <th>Tipo</th>
                                                                    <th>Hs.T</th>
                                                                    <th>Hs.P</th>
                                                                    <th>Grupo</th>
                                                                    <th>Docente</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {% for curso in cursosdispo %}
                                                                    <tr>
                                                                        <td >{{ curso.asignatura }}</td>
                                                                        <td id="nombre-{{ curso.asignatura }}">{{ curso.nombre }}</td>
                                                                        <td id="ciclo-{{ curso.asignatura }}">{{ curso.ciclo }}</td>
                                                                        <td id="creditos-{{ curso.asignatura }}">{{ curso.creditos }}</td>
                                                                        <td id="tipo-{{ curso.asignatura }}">{{ curso.tipo }}</td>
                                                                        <td id="ht-{{ curso.asignatura }}">{{ curso.ht }}</td>
                                                                        <td id="hp-{{ curso.asignatura }}">{{ curso.hp }}</td>
                                                                        <td id="grupo-{{ curso.asignatura }}">{{ curso.grupo }}</td>
                                                                        <td id="docente-{{ curso.asignatura }}">{{ curso.docentename }}</td>
                                                                    </tr>
                                                                {% endfor %}
                                                            </tbody>    
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- end widget content -->

                                        </div>
                                        <div class="col-md-12">
                                            <!--   <iframe src="" width="100%" height="600" frameBorder="0">Browser not compatible.</iframe> -->

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
