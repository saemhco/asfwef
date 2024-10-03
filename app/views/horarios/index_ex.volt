{% set texto_ciclo = "ALUMNO" %}
{% if ciclo == "" %}
    {% set texto_ciclo = "EGRESADO" %}
    {% set ciclo = "E" %}
{% endif %}
<div id="ribbon">
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

        <div class="col-md-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>HORARIOS  --- PROGRAMA: {{ carrera.descripcion }}  </strong></h2>	



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
                                                                <br>
                                                                <center>                                                                    
                                                                    <iframe marginwidth="3" marginheight="1" src="{{ url('adminpanel/archivos/horarios/'~record['semestre_name']~'/'~alumno.codigo~'.pdf') }}" frameborder="0" width="1020" height="780" scrolling="no"></span></iframe>
                                                                    <br>
                                                                    <br>
                                                                    <center> <a role="button" href="{{ url('adminpanel/archivos/horarios/'~record['semestre_name']~'/'~alumno.codigo~'.pdf') }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  DESCARGAR HORARIO </a></center>
                                                                </center>
                                                                
                                                                <br>
                                                                </div>
                                                            </div>
                                                        {% else %}
                                                            <div class="tab-pane fade" id="hr-{{ loop.index }}">
                                                                <div class="table-responsive">
                                                                <br>
                                                                <center>                                                                    
                                                                    <iframe marginwidth="3" marginheight="1" src="{{ url('adminpanel/archivos/horarios/'~record['semestre_name']~'/'~alumno.codigo~'.pdf') }}" frameborder="0" width="1020" height="780" scrolling="no"></span></iframe>
                                                                    <br>
                                                                    <br>
                                                                    <center> <a role="button" href="{{ url('adminpanel/archivos/horarios/'~record['semestre_name']~'/'~alumno.codigo~'.pdf') }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  DESCARGAR HORARIO </a></center>
                                                                </center>
                                                                
                                                                <br>
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
