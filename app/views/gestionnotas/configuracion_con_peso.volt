<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Configuración - Fórmulas - Promédios</li>
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
                                <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                <h2>Registro de Etiquetas y Fórmula | <b>SEMESTRE:</b> {{ semestre.descripcion }}
                                    | <b> {{ carrera.descripcion }} </b> | <b>{{ curso.nombre }}</b>  | <b> GRUPO : {{ grupo }}</b>
                                </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">	
                                        <br>
                                        {{ form('gestionnotas/saveconfig','method': 'post','id':'form-config') }}
                                        <table id="tbl_config" class="table  table-bordered ">
                                            <thead>		                
                                                <tr>
                                                    <th>Establecer Promedio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="45%">
                                                        <table class="table table-bordered no-padding" width="100%">
                                                            <tr>
                                                                <td width="33%" >
                                                                    <input class="form-control" id="etiqueta" placeholder="Etiqueta" />
                                                                </td>
                                                                <td width="33%" >
                                                                    <input class="form-control" id="peso"
                                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                                                           placeholder="Peso"  /> 
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" id="tipo" >
                                                                        <option value="0" >Tipo</option>
                                                                        <option value="1" >Inicial</option>
                                                                        <option value="2" >Final</option>
                                                                        <option value="3" >Otros</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                            <center><button class="btn btn-sm btn-primary" id="agregar" type="button" >+</button></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <table class="table table-bordered no-padding" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5%">Orden</th>
                                                                    <th width="20%">Etiqueta</th>
                                                                    <th width="17%" >Peso</th>
                                                                    <th>Tipo</th>
                                                                    <th width="25%">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="llena_etiquetas">
                                                                {% if nuevo == 1 %}
                                                                    {% set enum_r = 0 %}
                                                                    {% for i in 1..20 %}
                                                                        {%  set etq = "etq_"~i %}
                                                                        {%  set peso = "peso_"~i %}
                                                                        {%  set tipo = "tipo_"~i %}
                                                                        {% if prom_conf[etq] %}
                                                                            {% set enum_r += 1 %}
                                                                            <tr>
                                                                                <td class='orden'>{{ enum_r }}</td>
                                                                                <td><input type='text' onkeyup="drawFormula()"
                                                                                           class="form-control" name='etq[]' value='{{ prom_conf[etq] }}' ></td>
                                                                                <td>
                                                                                    <input type='text' onkeyup="drawFormula()"
                                                                                           class="form-control" name='peso[]'

                                                                                           value='{{ prom_conf[peso] }}'
                                                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                                                                           >
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control" name="tipo[]">
                                                                                        {% if prom_conf[tipo] == 1 %}
                                                                                            <option value="1"  selected="selected">Inicial</option>
                                                                                            <option value="2">Final</option>
                                                                                            <option value="3">Otros</option>
                                                                                        {% elseif prom_conf[tipo] == 2 %}
                                                                                            <option value="1">Inicial</option>
                                                                                            <option value="2" selected="selected">Final</option>
                                                                                            <option value="3">Otros</option>
                                                                                        {% elseif prom_conf[tipo] == 3 %}
                                                                                            <option value="1">Inicial</option>
                                                                                            <option value="2">Final</option>
                                                                                            <option value="3" selected="selected">Otros</option>
                                                                                        {% endif %}
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type='button' class='btn btn-success btn-xs' onclick='moveRow(this, 1)'>
                                                                                        <i class='fa fa-arrow-up' ></i> 
                                                                                    </button>
                                                                                    <button type='button' class='btn btn-success btn-xs' onclick='moveRow(this, 0)'>
                                                                                        <i class='fa fa-arrow-down' ></i>
                                                                                    </button>

                                                                                </td>
                                                                            </tr>   
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                {% endif %}
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                        </table>
                                        </td>
                                        </tr>
                                        <tr>
                                            <th>Formula</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="table table-bordered no-padding" width="100%">

                                                    <tr>
                                                        <td width="10%" style="vertical-align:middle;" >
                                                            <label style="font-size:20px;" class="label label-primary" >PF</label>
                                                        </td>
                                                        <td width="5%" style="vertical-align:middle;" >
                                                            =
                                                        </td>
                                                        <td id="formula-draw" >


                                                        </td>
                                                    <input type="hidden" name="semestre" value="{{ semestrep }}" />
                                                    <input type="hidden" name="curso" value="{{ cursop }}" />
                                                    <input type="hidden" name="grupo" value="{{ grupo }}" />
                                        </tr>

                                        </table>
                                        </td>	
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <a role="button" href="javascript:history.back()" class="btn btn-info" ><i class="fa fa-chevron-left" ></i> Regresar</a>
                                                <button type="button" id="btn-guarda"  class="btn btn-info" ><i class="fa fa-save" ></i> Guardar</button>
                                            </td>
                                        </tr>			
                                        </tbody>
                                        </table>
                                        {{ endForm() }}	
                                    </div>	
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
    var nuevo
    ={{ nuevo }}
</script>