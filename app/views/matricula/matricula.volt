
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Matrícula</li>
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
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>MATRÍCULA - SEMESTRE {{ semestre.descripcion }}  - - - PROGRAMA: {{ carrera.descripcion }}  </strong></h2>	



                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">

                                    <!-- widget body text-->


                                    <form class="smart-form" id="form-matricula" method="POST">

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
                                                        <tr style="font-size: 12px !important;" >
                                                            <td>Código:<strong> {{ alumno.codigo }}<input type="hidden" name="codigoalumno" value="{{ alumno.codigo }}"></strong></td>
                                                            <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                                            <td>Nombres: {{ alumno.nombres }}</td>
                                                            <td>Ciclo: <strong>{{ ciclo }}</strong><input type="hidden" name="ciclo_alumno" value="{{ ciclo }}"><input type="hidden" name="semestre" value="{{ semestre.codigo }}"> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>      
                                            <div class="col-md-12">





                                                <!-- widget content -->
                                                <div class="widget-body" style="padding: 20px !important ;">



                                                    <ul id="myTab1" class="nav nav-tabs bordered">
                                                        <li class="active">
                                                            <a href="#s1" data-toggle="tab">Asignaturas Ofertadas<span class="badge bg-color-blue txt-color-white">{{ totalcursos }}</span></a>
                                                        </li>
                                                        <li class="hide">
                                                            <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i>Estado de Cuenta</a>
                                                        </li>


                                                    </ul>

                                                    <div id="myTabContent1" class="tab-content">


                                                        <div class="tab-pane fade in active" id="s1">
                                                            <div class="table-responsive">
                                                                <table class="table-primary table-bordered table" style="font-size: 10px !important;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Codigo</th>
                                                                            <th>Asignatura</th>
                                                                            <th>Ciclo</th>
                                                                            <th>Creditos</th>
                                                                            <th>Tipo</th>
                                                                            <th>Grupo</th>
                                                                            <th>Observación</th>
                                                                            <th>Docente</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {% for curso in cursosdispo %}
                                                                            <tr>
                                                                                <td>
                                                                                    <label>
                                                                                        <input type="checkbox" class="checkbox style-0 checkcurso" name="checkcurso{{ curso.asignatura }}" grupo="{{ curso.grupo }}" value="{{ curso.asignatura }}" >
                                                                                        <span>{{ curso.asignatura }}</span>
                                                                                    </label>
                                                                                </td>                                                                                
                                                                                <td id="nombre-{{ curso.asignatura }}">{{ curso.nombre }}</td>
                                                                                <td id="ciclo-{{ curso.asignatura }}">{{ curso.ciclo }}</td>
                                                                                <td id="creditos-{{ curso.asignatura }}">{{ curso.creditos }}</td>
                                                                                <td id="tipo-{{ curso.asignatura }}">{{ curso.tipo_asignatura }}</td>
                                                                                <td id="grupo-{{ curso.asignatura }}">{{ curso.grupo }}</td>
                                                                                <td id="grupo-{{ curso.asignatura }}">{{ curso.observacion }}</td>
                                                                                <td id="docente-{{ curso.asignatura }}">{{ curso.docentename }}</td>
                                                                            <tr>
                                                                            {% endfor %}
                                                                    </tbody>    
                                                                </table>  
                                                            </div>
                                                        </div>





                                                        <div class="tab-pane fade" id="s2">
                                                            <div class="widget-body" >



                                                                <ul id="widget-tab-1" class="nav nav-tabs bordered">
                                                                    {% for caja in cajitas %}
                                                                        {% if loop.first %}
                                                                            <li class="active">

                                                                                <a data-toggle="tab" href="#hr-{{ loop.index }}"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> {{ caja['semestre_name'] }} </span> </a>

                                                                            </li>
                                                                        {% else %}

                                                                            <li>
                                                                                <a data-toggle="tab" href="#hr-{{ loop.index }}"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> {{ caja['semestre_name'] }} </span></a>
                                                                            </li>
                                                                        {% endif %}



                                                                    {% endfor %}
                                                                </ul>	



                                                                <!-- widget div-->
                                                                <div>


                                                                    <!-- end widget edit box -->

                                                                    <!-- widget content -->
                                                                    <div class="widget-body" >

                                                                        <!-- widget body text-->

                                                                        <div class="tab-content">
                                                                            {% for caja in cajitas %}

                                                                                {% if loop.first %}
                                                                                    <div class="tab-pane fade in active" id="hr-{{ loop.index }}">



                                                                                        <table style="font-size: 10px !important;" class="table table-bordered table-primary">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Concepto</th>
                                                                                                    <th>Emisión</th>
                                                                                                    <th>Pago</th>
                                                                                                    <th>Cuota</th>
                                                                                                    <th>Cant.</th>
                                                                                                    <th>PU</th>
                                                                                                    <th>Total</th>
                                                                                                    <th>Estado</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                {% for det in caja['detalle'] %}
                                                                                                    <tr>
                                                                                                        <td>{{ det['concepto'] }}</td>
                                                                                                        <td>{{ det['emision'] }}</td>
                                                                                                        <td>{{ det['pago'] }}</td>
                                                                                                        <td>{{ det['cuota'] }}</td>
                                                                                                        <td>{{ det['cantidad'] }}</td>
                                                                                                        <td>{{ det['pu'] }}</td>
                                                                                                        <td>{{ det['total'] }}</td>
                                                                                                        <td>{{ det['estado'] }}</td>
                                                                                                    </tr>
                                                                                                {% endfor %}

                                                                                            </tbody>
                                                                                        </table>



                                                                                    </div>
                                                                                {% else %}
                                                                                    <div class="tab-pane fade" id="hr-{{ loop.index }}">




                                                                                        <table style="font-size: 10px !important;" class="table table-bordered table-primary">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Concepto</th>
                                                                                                    <th>Emisión</th>
                                                                                                    <th>Pago</th>
                                                                                                    <th>Cuota</th>
                                                                                                    <th>Cant.</th>
                                                                                                    <th>PU</th>
                                                                                                    <th>Total</th>
                                                                                                    <th>Estado</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                {% for det in caja['detalle'] %}
                                                                                                    <tr>
                                                                                                        <td>{{ det['concepto'] }}</td>
                                                                                                        <td>{{ det['emision'] }}</td>
                                                                                                        <td>{{ det['pago'] }}</td>
                                                                                                        <td>{{ det['cuota'] }}</td>
                                                                                                        <td>{{ det['cantidad'] }}</td>
                                                                                                        <td>{{ det['pu'] }}</td>
                                                                                                        <td>{{ det['total'] }}</td>
                                                                                                        <td>{{ det['estado'] }}</td>
                                                                                                    </tr>
                                                                                                {% endfor %}
                                                                                            </tbody>
                                                                                        </table>




                                                                                    </div>
                                                                                {% endif %}   

                                                                            {% endfor %}


                                                                        </div>

                                                                    </div>
                                                                    <!-- end widget content -->

                                                                </div>
                                                                <!-- end widget div -->

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- end widget content -->

                                            </div>
                                            <div class="col col-md-12 showme hidden" >  
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="8">
                                                        <center>FICHA DE MATRICULA</center>
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                            <th width="12%">Código</th>
                                                            <th>Asigantura</th>
                                                            <th width="8%">Ciclo</th>
                                                            <th width="8%">Créditos</th>
                                                            <th width="8%">Tipo</th>
                                                            <th width="8%">Matrícula</th>
                                                            <th width="8%">Veces</th>
                                                            <th width="8%">Grupo</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="cursos-llevar">

                                                        </tbody>

                                                    </table>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-primary table-bordered" >

                                                        <tr>
                                                            <td>Total Asignaturas: <label id="totalasig">0</label></td>
                                                            <td>Creditos Permitidos:  {{ creditosciclo }}</td>                                                            
                                                            <td>Total Creditos Matrícula: <label id="totalcred">0</label></td>
                                                            <td><button id="matriculabtn" type="button"  class="btn btn-primary btn-block" >
                                                                    <h3> Guardar Matrícula </h3>
                                                                </button></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>                                      




                                        </div>

                                    </form>


                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<script>
    var credimax
    = {{ creditosciclo }}; // poduccion
            //var credimax = 8; //solo para debug
            var cicloorden = [];
    {% for curso in cursosdispo %}
        cicloorden.push({{ curso.ciclo }});
    {% endfor %}
        console.log(cicloorden);
</script>