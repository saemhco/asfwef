
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion Planillas</li><li>Configuración de Planillas</li>
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
                                <h2><strong>CONFIGURACION DE PLANILLA (INGRESOS - DESCUENTOS - APORTES) </strong></h2>	
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


                                  

                                        <div class="row" >
                                            <div class="col col-md-12" >  

                                                <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="8">
                                                            <center>PLANILLA</center>
                                                         </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="font-size: 12px !important;" >
                                                            <td><strong>PLANILLA: {{ planilla.numero }}</strong></td>
                                                            <td><strong>TIPO: {{ tipoplanilla.nombre }}</strong> </td>
                                                            <td><strong>PERIODO: {{ periodo.periodo }}</strong>
                                                                <input type="hidden" name="ciclo_alumno" value="{{ ciclo }}">

                                                                <input type="hidden" name="semestre" value="{{ semestre.codigo }}"> 
                                                            </td>
                                                          
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3">
                                                                <center>PARÁMETROS DE CONFIGURACIÓN</center>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                <center>INGRESOS</center>
                                                            </th>
                                                            <th>
                                                                <center>DESCUENTOS</center>
                                                            </th>
                                                            <th>
                                                                <center>APORTES</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <!-- Ingresos -->
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <tr>
                                                                        <td width="75%">
                                                                            <input type="text" id="desc" class="form-control input-xs"
                                                                            placeholder="Etiqueta"
                                                                            
                                                                             name="">
                                                                        </td>
                                                                         <td width="20%">
                                                                            <input type="text" id="factor" class="form-control input-xs" 
                                                                            placeholder="Factor" 
                                                                            
                                                                            name="">
                                                                        </td>
                                                                        <td width="5%" >
                                                                            <button onclick="ingresos()" class="btn btn-xs btn-primary" >
                                                                                <i class="fa fa-plus" ></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <!-- Descuentos -->
                                                               <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <tr>
                                                                        <td width="75%">
                                                                            <input type="text" id="desc" class="form-control input-xs"
                                                                            placeholder="Etiqueta"
                                                                            
                                                                             name="">
                                                                        </td>
                                                                         <td width="20%">
                                                                            <input type="text" id="factor" class="form-control input-xs" 
                                                                            placeholder="Factor" 
                                                                            
                                                                            name="">
                                                                        </td>
                                                                        <td width="5%" >
                                                                            <button class="btn btn-xs btn-primary" onclick="descuentos()" >
                                                                                <i class="fa fa-plus" ></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <!-- Aportes -->
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <tr>
                                                                        <td width="75%">
                                                                            <input type="text" id="desc" class="form-control input-xs"
                                                                            placeholder="Etiqueta"
                                                                            
                                                                             name="">
                                                                        </td>
                                                                         <td width="20%">
                                                                            <input type="text" id="factor" class="form-control input-xs" 
                                                                            placeholder="Factor" 
                                                                            
                                                                            name="">
                                                                        </td>
                                                                        <td width="5%" >
                                                                            <button 
                                                                            onclick="aportes()"
                                                                            class="btn btn-xs btn-primary" >
                                                                                <i class="fa fa-plus" ></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                 

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



<script type="text/javascript">
    var anio = "{{ anio_select }}";
    var codigo = "{{ id }}";
</script>