<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets"   rel="tooltip" data-placement="bottom" data-original-title="" data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion de Asignaturas</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center>
                        <span class="widget-icon"> <i class="fa fa-hand-o-up"></i> </span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center" style="min-height: 0px !important; ">
                        <a href="javascript:void(0);"  onclick="agregar()" class="btn btn-primary btn-block"><i class="fa fa-check-circle-o"></i></a>

                     
                    </div>
                </div>
            </div>

            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">                               
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Reportes</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">                              

                    </div>
                    <div class="widget-body text-center">
                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_registro_auxiliar();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Registro Auxiliar"><i class="fa fa-file-pdf-o"></i></a>
                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_carga_academica();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Carga Académica"><i class="fa fa-file-pdf-o"></i></a>
                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_acta_inicial();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Acta Inicial"><i class="fa fa-file-pdf-o"></i></a>
                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_registro_notas();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Registro de Notas"><i class="fa fa-file-pdf-o"></i></a>
                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="reporte_acta_final();" class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Acta Final"><i class="fa fa-file-pdf-o"></i></a>
                    </div>
                </div>
            </div>

            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">                               
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Exportar</span>
                    </center>
                </header>
                <div>
                    <div class="widget-body text-center" style="min-height: 0px !important; ">
                        <a  href="javascript:void(0);" onclick="reporte_registro_auxiliar_xls();" class="btn btn-success txt-color-white btn-block" rel="tooltip" data-placement="top" data-original-title="Registro Auxiliar"><i class="fa fa-file-excel-o"></i></a>
                       
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11">
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
                                <h2>Registro de asignaturas </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	
                                    <table class="table">
                                        <tr>
                                            <td>
                                        <center>
                                            <select class="form-control" id="semestre" >
                                                <option value="">--SELECCIONE SEMESTE-- </option>
                                                {% if sem is defined %}
                                                    {% for s in semestres %}
                                                            {% if s.codigo == sem %}
                                                                    <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                            {% else %}
                                                                    <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                            {% endif %}
                                                    {% endfor %}
                                                {% else %}
                                                    {% for s in semestres %}
                                                            {% if s.codigo == semestrea %}
                                                                    <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                            {% else %}
                                                                    <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                            {% endif %}
                                                    {% endfor %}
                                                {% endif %}
                                            </select>
                                        </center>
                                            </td>
                                        </tr>
                                    </table>

                                    <table id="tbl_asignaturas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 
                                                <th>CÓDIGO</th>  
                                                <th>PROGRAMA DE ESTUDIOS</th>
                                                <th>NOMBRE</th>
                                                <th>CIC.</th>
                                                <th>GRUPO</th>
                                                <th>HT</th>
                                                <th>HP</th>
                                                <th>TIPO A.</th>
                                                <th>CREDITOS</th>
                                                

                                        </tr>
                                        </thead>
                                        <tbody>				
                                        </tbody>
                                    </table>				
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible
        </p>
    </div>
</div>
<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
//var distrito_id = '';
</script>
<script type="text/javascript" >
   
    {% if sem is defined %}
        var semestreax = "{{ sem }}";
    {% else %}
        console.log("xd");
        var semestreax = "{{ semestrea }}";
    {% endif %}
    console.log(semestreax);
</script>

