<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Gestion Reportes</li>
        <li>Reportes Generales</li>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Reportes Generales</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body">
                                    <form id="5" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-lg-12 selectContainer">
                                                <select class="form-control" id="admision">

                                                    {% for s in admision %}
                                                    {% if s.codigo == admisiona %}
                                                    <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                    {% else %}
                                                    <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                    {% endif %}
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="6" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                               Postulantes
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    
                                                               
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_general_postulantes();"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_general_postulantes"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Postulantes</a>
                                                    
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">

                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Reporte-Postulantes-Modalidad-Admision.pdf"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_ficha_registro"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte por Modalidad de Admisión</a>

                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        onclick="reporte_modalidad_admision();"
                                                        style="background-color: #C0C0FF;color: black;"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte por Modalidad de Admisión</a>
                                                    -->
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">

                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Reporte-Postulantes-Estado-Proceso.pdf"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        id="reporte_ficha_registro"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte por Estado de Proceso</a>


                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0C0FF;color: black;"
                                                        onclick="reporte_estado_proceso();" id="reporte_boleta_notas"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte por Estado de Proceso</a>
                                                    -->
                                                </div>

                                               
                                                
                                            </div>
                                        </fieldset>
                                    </form>



                                    


                                    <form id="togglingForm4" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Asistentes
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">


                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Reporte-Asistentes-Examen.pdf"
                                                    style="background-color: #FFFFC0; color: black;"
                                                    id="reporte_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Asistentes al Exámen</a>

                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="reporte_asistentes_examen();"
                                                        id="reporte_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Asistentes al Exámen</a>
                                                    -->
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">

                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Reporte-Resultados-Examen.pdf"
                                                    style="background-color: #FFFFC0; color: black;"
                                                    id="reporte_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Resultados del Exámen de Admisión</a>

                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFFFC0; color: black;" onclick="resultados_examen_admision();" id="reporte_horarios"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Resultados del Exámen de Admisión</a>
                                                    -->
                                                </div>
                                                
                                                
                                            </div>
                                        </fieldset>
                                    </form>

                                    

                                    <form id="togglingForm4" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Ingresantes
                                            </legend>

                                            <div class="form-group">
                                                
                                                <div class="col-lg-3" style="margin-bottom: 10px;">

                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Reporte-Ingresantes-Examen.pdf"
                                                    style="background-color: #FFE0C0; color: black;"
                                                    id="reporte_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Ingresantes</a>

                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;"
                                                        onclick="reporte_ingresantes_admision();"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Ingresantes</a>
                                                    -->
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">

                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Reporte-Alumnos-Constancia.pdf"
                                                    style="background-color: #FFE0C0; color: black;"
                                                    id="reporte_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Ingresantes con Constancia de Ingreso</a>

                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_ingresantes_constancia();" 
                                                        id="reporte_ingresantes_constancia"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Ingresantes con Constancia de Ingreso</a>
                                                    -->
                                                </div>

                                                
                                            </div>
                                        </fieldset>
                                    </form>
                                    
                                    <form id="togglingForm4" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Número de Postulantes e Ingresantes
                                            </legend>

                                            <div class="form-group">
                                                
                                                <div class="col-lg-3" style="margin-bottom: 10px;">

                                                    <a target="_blank" class="btn btn-block" 
                                                    href="../adminpanel/archivos/reportes/admision/Numero-Postulantes-Ingresantes.pdf"
                                                    style="background-color: #C0FFFF; color: black;"
                                                    id="reporte_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Por Carrera y Modalidad</a>

                                                    <!--
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: ##C0FFFF; color: black;"
                                                        onclick="reporte_ingresantes_admision();"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte de Ingresantes</a>
                                                    -->
                                                </div>

                                                

                                                
                                            </div>
                                        </fieldset>
                                    </form>

                                   

                                    <form id="3" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Formatos en Excel
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFC0; color: black;" onclick="reporte_excel_postulantes();" id="reporte_excel_postulantes"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Postulantes registrados (Modalidad / Proceso)</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFC0; color: black;" onclick="reporte_excel_asistentes_examen();" id="reporte_excel_asistentes_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Postulantes asistentes al exámen</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #C0FFC0; color: black;" onclick="reporte_excel_resultados_examen();" id="reporte_excel_resultados_examen"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ingresantes y resultados al exámen</a>
                                                </div>
                                               
                                            </div>
                                        </fieldset>
                                    </form>

                                    
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>