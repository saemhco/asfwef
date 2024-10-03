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
                                    | <b> {{ carrera.descripcion }} </b> | <b>{{ curso.nombre }}</b>  |
                                </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										
                                    {{ form('configpromedios/save','method': 'post','id':'form-config') }}
                                    <table id="tbl_config" class="table  table-bordered " width="100%">
                                        <thead>		                
                                            <tr>
                                                <th>Etiquetas - Peso</th>
                                               
                                                <th>Fórmula</th> 		
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td width="35%">
                                                <table class="table table-bordered no-padding" width="100%">
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" id="etiqueta" placeholder="Etiqueta" />
                                                            
                                                        </td>
                                                        <td>
                                                            <input class="form-control" id="peso" placeholder="Peso"  /> 
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
                                                                        <th>Etiqueta</th>
                                                                        <th>Peso</th>
                                                                        <th width="30%">Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="llena_etiquetas">
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-bordered no-padding" width="100%">
                                                    <tr>
                                                        <th colspan="3" class="hidden" >
                                                            <b>Signos Permitidos :</b>&nbsp; 
                                                            <span class="label label-info"> / </span>&nbsp;
                                                            <span class="label label-info"> * </span>&nbsp;
                                                            <span class="label label-info"> + </span>&nbsp;
                                                            <span class="label label-info"> - </span>&nbsp;
                                                        </th>
                                                        <th colspan="3"  >
                                                            <b>Vista Previa :</b>&nbsp; 
                                                            
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
                                                           

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <textarea id="formula" name="formula"  class="hidden form-control" rows="3" cols="5" >
                                                            </textarea>
                                                            <input type="hidden" name="semestre" value="{{ semestrep }}" />
                                                            <input type="hidden" name="curso" value="{{ cursop }}" />
                                                            <input type="hidden" name="grupo" value="{{ grupo }}" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>	
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <a role="button" href="javascript:history.back()" class="btn btn-info" ><i class="fa fa-chevron-left" ></i> Regresar</a>
                                                    <button type="button" id="btn-guarda"  class="btn btn-info" ><i class="fa fa-save" ></i> Grabar</button>
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