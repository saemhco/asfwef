<div id="ribbon">
  

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion de Horarios - Docentes</li>
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
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>HORARIOS POR DOCENTE - SEMESTRE {{ semestre.descripcion }}</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	
                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <td>
                                        <center>

                                            <select class="form-control" id="docente"  {% if perfil == 4 %}disabled{% endif  %}>
                                                <option value="0">--SELECCIONE DOCENTE-- </option>
                                                {% for docente in docentes %}
                                                    {% if docente.codigo == c_docente %}
                                                        <option value="{{ docente.codigo }}" selected="selected" > {{ docente.apellidop }} {{ docente.apellidom }} {{ docente.nombres }} </option>
                                                    {% else %}  
                                                        <option value="{{ docente.codigo }}"> {{ docente.apellidop }} {{ docente.apellidom }} {{ docente.nombres }} </option>
                                                    {% endif  %}
                                                {% endfor %}
                                            </select>

                                          

                                         
                                        </center>
                                            </td>
                                            <td>
                                                <center>
                                                       <select class="form-control" id="d_turno">
                                                            <option value="0">--SELECCIONE TURNO-- </option>
                                                            {% if c_turno == 1 %}   
                                                                <option value="1" selected="selected"> MAÑANA </option>
                                                            {% else %}
                                                                <option value="1"> MAÑANA </option>   
                                                            {% endif %}

                                                            {% if c_turno == 2 %}   
                                                                <option value="2" selected="selected"> TARDE </option>
                                                            {% else %}
                                                                <option value="2"> TARDE </option>   
                                                            {% endif %}
                                                           
                                                            
                                                            {% if c_turno == 3 %}   
                                                                <option value="3" selected="selected"> NOCHE </option>
                                                            {% else %}
                                                                <option value="3"> NOCHE </option>   
                                                            {% endif %}
                                                        </select>
                                                </center>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="table-responsive" id="horaarioprint">
                                        <table class="hide" width="100%" >
                                            <tr>
                                                <td>
                                                    <h2>HORARIO {{ semestre.descripcion }}</h2>

                                                </td>
                                                <td style="text-align:right;" >
                                                    <img src="{{ url() }}webpage/assets/img/logo-vr.png" >
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <row>
                                            <table id="tbl_asignaturas" border="1" class="table table-responsive table-bordered">
                                                <thead>			                
                                                    <tr>
                                                        <th width="11%" style="vertical-align: middle;text-align: center;"><center><i class="fa fa-list-alt"></i></center></th> 
                                                        <th width="15%" style="vertical-align: middle;text-align: center;">LUNES</th>  
                                                        <th width="15%" style="vertical-align: middle;text-align: center;">MARTES</th>
                                                        <th width="15%" style="vertical-align: middle;text-align: center;">MIERCOLES</th>
                                                        <th width="15%" style="vertical-align: middle;text-align: center;">JUEVES</th>
                                                        <th width="15%" style="vertical-align: middle;text-align: center;">VIERNES</th>
                                                        <th width="15%" style="vertical-align: middle;text-align: center;">SABADO</th>
                                                        <th class="hide" style="vertical-align: middle;text-align: center;" width="12%">DOMINGO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {% for hora in horas %}	
                                                        <tr>
                                                            {% if hora.turno == 1 %}
                                                                {% set t_desc = "AM" %}
                                                            {% elseif hora.turno == 2 %}
                                                                {% set t_desc = "PM" %}
                                                            {% elseif hora.turno == 3 %}
                                                                {% set t_desc = "PM" %}
                                                            {% endif %}

                                                            <td  width="10%">
                                                                {{ hora.descripcion~" "~t_desc }}
                                                            </td>
                                                            <td>
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,1) }}</center>
                                                            </td>
                                                            <td>
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,2) }}</center>
                                                            </td>
                                                            <td>
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,3) }}</center>
                                                            </td>
                                                            <td>
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,4) }}</center>
                                                            </td>
                                                            <td>
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,5) }}</center>
                                                            </td>
                                                            <td>
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,6) }}</center>
                                                            </td>
                                                            <td class="hide" >
                                                                <center>{{ registros.getHoraDocenteTurno(semestre.codigo,hora.codigo,c_docente,c_turno,7) }}</center>
                                                            </td>
                                                        </tr>
                                                    {% endfor %}	
                                                </tbody>
                                            </table>
                                        </row>
                                    </div>
                                     <center><button class="btn btn-primary" type="button"  onclick="codespeedy()"> 
Imprimir horario <i class="fa fa-print"></i>
                                            </button>
                                            </center>
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<script type="text/javascript">
                
function codespeedy(){
var print_div = document.getElementById("horaarioprint");
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();
        }

    </script>