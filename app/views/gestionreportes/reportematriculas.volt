<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Gestion Reportes</li>
        <li>Reporte de Matrículas</li>
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
                                <h2>Reporte de Matrículas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body">
                                    <form id="5" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-lg-12 selectContainer">
                                                <select class="form-control" id="semestre">

                                                    {% for s in semestres %}
                                                    {% if s.codigo == semestrea %}
                                                    <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                    {% else %}
                                                    <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                    {% endif %}
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                 

                                    <form id="1" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Registros Académicos
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_matriculados();" id="reporte_relacion_alumnos_matriculados"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos Matriculados por Programa Académico</a>
                                                </div>
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_matriculados_semestre();" id="reporte_relacion_alumnos_matriculados_semestre"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos Matriculados / Semestre</a>
                                                </div>
                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);"
                                                        style="background-color: #FFE0C0; color: black;" onclick="reporte_relacion_alumnos_matriculados_dni();" id="reporte_relacion_alumnos_matriculados_dni"><i
                                                            class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos Matriculados / Curso</a>
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