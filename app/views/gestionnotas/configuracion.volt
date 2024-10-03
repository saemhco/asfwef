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
                                    | <b> {{ carrera.descripcion }} </b> | <b>{{ curso.nombre }}</b>  |  <b> GRUPO : {{ grupo }}</b>
                                </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										
                                    {{ form('gestionnotas/saveconfig','method': 'post','id':'form-config') }}
                                    <table id="tbl_config" class="table  table-bordered " width="100%">
                                      
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered no-padding" width="100%">
                                                    <tr>
                                                        <th colspan="3">Etiquetas - Nombre de la nota/evaluación</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" id="etiqueta" placeholder="Etiqueta" />
                                                            
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
                                                         <button class="btn btn-sm btn-primary" id="agregar" type="button" >+</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <table class="table table-bordered no-padding" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">Orden</th>
                                                                        <th width="30%">Etiqueta</th>
                                                                        <th>Tipo</th>
                                                                        <th width="30%">Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="llena_etiquetas">
                                                                    {% if nuevo == 1 %}
                                                                    {% set enum_r = 0 %}
                                                                    {% for i in 1..20 %}
                                                                        {%  set etq = "etq_"~i %}
                                                                       
                                                                        {%  set tipo = "tipo_"~i %}
                                                                        {% if prom_conf[etq] %}
                                                                            {% set enum_r += 1 %}
                                                                            <tr>
                                                                                <td class='orden'>{{ enum_r }}</td>
                                                                                <td><input type='text' onkeyup="drawFormula()"
                                                                                    class="form-control" name='etq[]' value='{{ prom_conf[etq] }}' >
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
                                                                                    <button type='button' class='hidden btn btn-success btn-xs' onclick='moveRow(this,1)'>
                                                                                        <i class='fa fa-arrow-up' ></i> 
                                                                                    </button>
                                                                                    <button type='button' class='hidden btn btn-success btn-xs' onclick='moveRow(this,0)'>
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
                                                </div>
                                                 <div class="col-md-6">
                                                    <table class="table table-bordered no-padding" width="100%">
                                                    <tr>
                                                        <th colspan="3" >Fórmula</th> 
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2" >
                                                            <b>Signos:</b>&nbsp; 
                                                        </th>
                                                        <th>
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> ( </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> ) </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> + </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> - </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> * </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> / </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-info"> . </button >&nbsp;


                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2" >
                                                            <b>Numeros:</b>&nbsp; 
                                                        </th>
                                                        <th>
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 0 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 1 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 2 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 3 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 4 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 5 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 6 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 6 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 7 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 8 </button >&nbsp;
                                                            <button type="button" onclick="drawPick(this)" class="label label-success"> 9 </button >&nbsp;
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2" >
                                                            <b>Etiquetas:</b>&nbsp; 
                                                        </th>
                                                        <th id="llena-etiquetas" >
                                                          
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td width="10%" style="vertical-align:middle;" >
                                                            <label style="font-size:20px;" class="label label-primary" >PF</label>
                                                        </td>
                                                        <td width="5%" style="vertical-align:middle;" >
                                                            =
                                                        </td width="85%" >
                                                        <td id="formula-draw" >
                                                           <textarea  class="form-control" name="formula" style="text-align:left!important;" 
                                                           readonly="readonly" 
                                                            id="llena-formula" rows="2">{{ prom_conf["formula"] }}
                                                           </textarea>
                                                           <input type="hidden" id="anterior-form" name="">
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td colspan="2" style="vertical-align:middle;" >
                                                        </td >
                                                        <td width="85%"  id="formula-draw" >
                                                         <div class="col-md-6">
                                                            <button onclick="Anterior()" type="button" class="btn btn-xs btn-block btn-warning" > Borrar </button>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <button onclick="Limpiar()" type="button" class="btn btn-xs  btn-block btn-danger" > Limpiar </button>
                                                         </div>
                                                           <input type="hidden" name="semestre" value="{{ semestrep }}" />
                                                            <input type="hidden" name="curso" value="{{ cursop }}" />
                                                            <input type="hidden" name="grupo" value="{{ grupo }}" />
                                                        </td>
                                                    </tr>
                                                   

                                                </table>
                                                 </div>
                                                 </td>
                                             </tr>
                                             <tr>
                                                
                                           
                                            <tr>
                                                <td colspan="2" class="text-center">
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
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<script type="text/javascript">
    var nuevo = {{ nuevo }}
</script>