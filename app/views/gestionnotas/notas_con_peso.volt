
<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestión de Asignaturas</li>
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
                                <h2><strong>Registro de Notas Detallado </strong></h2>	



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
                                                <center>ASIGNATURA: {{ asignatura.nombre }}</center>
                                                </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="font-size: 12px !important;" >
                                                        <td>Código:<strong> {{ asignatura.codigo }}<input type="hidden" name="codigo" value="{{ asignatura.codigo }}"></strong></td>
                                                        <td>Ciclo: <strong>{{ asignatura.ciclo}} </strong></td>
                                                        <td>Creditos: <strong>{{ asignatura.creditos  }}</strong> </td>
                                                        <td>Curricula: <strong>{{ programa.descripcion  }}</strong> </td>
                                                        <td>Grupo: <strong>{{ grupo  }}</strong> </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div> 

                                        <div class="col-md-12">

                                            <div class="widget-body" >
                                                <ul id="widget-tab-1" class="nav nav-tabs bordered">
                                                    <li class="active">

                                                        <a data-toggle="tab" href="#hr-1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> Registro de Calificaciones </span> </a>

                                                    </li>

                                                </ul>	
                                                <div id="myTabContent1" class="tab-content">

                                                    <div class="tab-pane fade in active" id="hr-1">


                                                        <div class="table-responsive">
                                                            <form id="form-notas" method="POST">  

                                                                <table class="table table-bordered table-hover" style="font-size: 10px !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><i class="fa fa-check-square"></th>
                                                                            <th width="10%" > Codigo
                                                                                <input type="hidden" name="asignatura" value="{{ asignatura.codigo }}">
                                                                                <input type="hidden" name="semestre" value="{{ semestre.codigo }}">
                                                                                <input type="hidden" name="grupo" value="{{ grupo }}">
                                                                            </th>
                                                                            <th>Apellidos</th>
                                                                            <th>Nombres</th>
                                                                            {% set enum_r = 0 %}
                                                                            {% for i in 1..20 %}
                                                                                {%  set etq = "etq_"~i %}
                                                                                {%  set peso = "peso_"~i %}
                                                                                {% if prom_conf[etq] %}

                                                                                    {% set enum_r += 1 %}
                                                                                    
                                                                                    {% set visible = "" %}
                                                                                    {% if prom_conf[peso] == 0 %}
                                                                                        {% set visible = "hidden" %}
                                                                                    {% endif %}
                                                                                    
                                                                                    <th class="{{ visible }}" width="5%">{{ prom_conf[etq] }}</th>
                                                                                    
                                                                                {% endif %}
                                                                            {% endfor %}
                                                                            <th width="5%">EA</th>
                                                                            <th width="5%">PF</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {% for det in notas %}
                                                                            <tr class="activa" id="get-{{ det["alumno"] }}"  >
                                                                                <td class="activ cc" id="get-{{ det["alumno"] }}">
                                                                                    <input 
                                                                                        class="checkcurso pp_check" id="check-{{ det["alumno"] }}"
                                                                                        type="radio" name="checkbox-inline" value="1" />
                                                                                </td>
                                                                                <td class="activ" id="get-{{ det["alumno"] }}" ><input type="hidden" class="inp-{{ det["alumno"] }}" name="alumno[]" value="{{ det["alumno"] }}" >{{ det["alumno"] }}</td>
                                                                                <td class="activ" id="get-{{ det["alumno"] }}">{{ det["apellidos"] }}</td>
                                                                                <td class="activ" id="get-{{ det["alumno"] }}">{{ det["nombres"] }}</td>

                                                                                {% for i in 1..enum_r %}
                                                                                    {% set n = "n"~i %}
                                                                                    {% if i < 10 %}
                                                                                        {% set n = "n0"~i %}
                                                                                    {% endif %}

                                                                                    {%  set peso = "peso_"~i %}
                                                                                    {%  set tipo = "tipo_"~i %}
                                                                                    {%  set tipo_val = prom_conf[tipo] %}

                                                                                    {% set visible = "" %}
                                                                                    {% if prom_conf[peso] == 0 %}
                                                                                        {% set visible = "hidden" %}
                                                                                    {% endif %}

                                                                                    <td class="p_p{{ i }} {{ visible }}">
                                                                                        <input type="text" style="width: 50px;" 
                                                                                        class="input-xs pp{{ i }} not get-{{ det["alumno"] }}" 
                                                                                        name="ep{{ i }}[]" 
                                                                                        value="{{ det[n] }}" 
                                                                                        onkeyup="calculaFormula($(this))"  
oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                                                                        disabled>
                                                                                        {%  set peso = "peso_"~i %}
                                                                                        <input type="hidden" style="width: 50px;" 
                                                                                        class="m-pp{{ i }}" 
                                                                                        value="{{ prom_conf[peso] }}" 
                                                                                        {{ eaactivado[tipo_val] }}
                                                                                         disabled>
                                                                                        
                                                                                    </td>
                                                                                {% endfor %}
                                                                                <td class="p_ea" style="background:#FFFDB2;" >


                                                                                    <input type="text" style="width: 50px;" class="input-xs pea not get-{{ det["alumno"] }}" onkeyup="calculaFormula($(this))" name="ea[]" value="{{ det["ea"] }}" 
oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                                                                    {{ ea_activado }} disabled>
                                                                                </td>
                                                                                <td class="p_pf" style="background:#D0FFBF;" >
                                                                                    <input type="text" style="width: 50px;" class="input-xs ppf pf-{{ det["alumno"] }}" name="pf[]" value="{{ det["pf"] }}" readonly>
                                                                                </td>
                                                                             
                                                                            </tr>
                                                                        {% endfor %}

                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="7">
                                                                    <center>
                                                                        <a href="javascript:history.back()" type="button" class="btn btn-default" >Volver <i class="fa fa-chevron-circle-left"></i> </a>
                                                                        <button id="guardar" type="button" class="btn btn-info" >Guardar <i class="fa fa-save"></i> </button>

                                                                    </center>
                                                                    </td>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </form>
                                                        </div>
                                                    </div>


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

<script type="text/javascript">
    var bucle_notas = {{ enum_r }};

</script>