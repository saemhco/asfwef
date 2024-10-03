{% set texto_ciclo = "ALUMNO" %}
{% if ciclo == "" %}
    {% set texto_ciclo = "EGRESADO" %}
    {% set ciclo = "E" %}
{% endif %}
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Estado de Cuenta</li>
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
                                <h2><strong>ESTADO DE CUENTA  --- PROGRAMA: {{ carrera.descripcion }}  </strong></h2>	



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
                                                <div id="myTabContent1" class="tab-content">
                                                    {% for caja in cajitas %}

                                                        {% if loop.first %}
                                                            <div class="tab-pane fade in active" id="hr-{{ loop.index }}">



                                                                <table class="table table-bordered table-primary">
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
                                                                                <td>{{ utilidades.fechita(det['emision'],'d/m/Y') }}</td>
                                                                               <td>{{  utilidades.fechita(det['pago'],'d/m/Y') }}</td>
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




                                                                <table class="table table-bordered table-primary">
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
                                                                                <td>{{ utilidades.fechita(det['emision'],'Y/m/d') }}</td>
                                                                                <td>{{  utilidades.fechita(det['pago'],'Y/m/d') }}</td>
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
