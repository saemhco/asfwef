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
                                    <div class="widget-body-toolbar">
                                        <div class="row">
                                            <div class="col-sm-4 text-center">
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
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <a href="javascript:void(0);" onclick="reporte_pdf();"
                                                    class="btn bg-color-magenta txt-color-white"><i
                                                        class="fa fa-file-pdf-o"></i>
                                                    &nbsp;Reporte
                                                </a>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="javascript:void(0);" onclick="reporte_xls()"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    &nbsp;Exportar
                                                </a>
                                            </div>
                                        </div>
                                    </div>	
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
{{ form('','method': 'post','id':'form_reporte_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12" style="margin-top: -5px;">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="registro_auxiliar_pdf()" id="registro_auxiliar_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro Auxiliar</a>
        </section>
        <section class="col col-md-12" style="margin-top: -5px;">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="registro_auxiliar_datos_estudiantes_pdf()" id="registro_auxiliar_datos_estudiantes_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro Auxiliar / Datos Estudiantes</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="carga_academica_pdf()" id="carga_academica_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Carga Académica</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="acta_inicial_pdf()" id="acta_inicial_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Acta Inicial</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="registro_notas_pdf()" id="registro_notas_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro de Notas</a>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="acta_final_pdf()" id="acta_final_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Acta Final</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'form_reporte_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12" style="margin-top: -5px;">
            <a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
                onclick="registro_auxiliar_xls()" id="registro_auxiliar_xls"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro Auxiliar</a>
        </section>
        <section class="col col-md-12" style="margin-top: -5px;">
            <a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
                onclick="registro_auxiliar_datos_estudiantes_xls()" id="registro_auxiliar_datos_estudiantes_xls"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Registro Auxiliar / Datos Estudiantes</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}
<script type="text/javascript" >

    var publica = "no";

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

