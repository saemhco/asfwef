<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Gestión de Procesos</li><li>Gestión de Procesos</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Generar PDFs de...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">
                                    <form id="togglingForm1" method="post" class="form-horizontal">
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
                                    <form id="togglingForm2" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Alumnos
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ficha de Pre Matrícula</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Ficha de Matrícula</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Boleta de Notas</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" style="background-color: #C0C0FF;color: black;" href="" ><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Notas Promedio</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" style="background-color: #C0C0FF;color: black;" href="" ><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Extracurricular</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" style="background-color: #C0C0FF;color: black;" href="" ><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Horarios</a>
                                                </div>
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" style="background-color: #C0C0FF;color: black;" href="" ><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Fondo de Agua</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <form id="togglingForm3" method="post" class="form-horizontal">
                                        <fieldset>
                                            <legend>
                                                Docentes
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Registros Auxiliares</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Carga Académica / Alumnos</a>
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

        <div class="col-sm-4" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Pre Matrícula y Matrícula...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="togglingForm4" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">
                                                <div class="col-lg-6" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Pre Matrícula</a>
                                                </div>

                                                <div class="col-lg-6" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Matrícula</a>
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

        <div class="col-sm-8" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Situación Académica para Matrícula...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="togglingForm4" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos / Código</a>
                                                </div>

                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control" name="company"
                                                           required data-bv-notempty-message="The company name is required" />
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
        <div class="col-sm-12" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Actualizar Situación Académica...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="togglingForm4" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Asignaturas</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Veces</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Órden de Mérito</a>
                                                </div>

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Alumnos</a>
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
        <div class="col-sm-4" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Generar XLSs de...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="togglingForm4" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">

                                                <div class="col-lg-6" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Registro de Notas</a>
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
        <div class="col-sm-8" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>Actualizar Promedios...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="togglingForm4" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Promedio Semestral</a>
                                                </div>

                                                <div class="col-lg-4" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" href="javascript:void(0);" onclick="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Promedio Acumulado</a>
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
        <div class="col-sm-12" style="margin-bottom: -20px !important;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"><i class="fa fa-table"></i></span>
                                <h2>...</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">

                                    <form id="togglingForm4" method="post" class="form-horizontal">

                                        <fieldset>

                                            <div class="form-group">

                                                <div class="col-lg-3" style="margin-bottom: 10px;">
                                                    <a class="btn btn-block" target="_blank" href="" style="background-color: #C0C0FF;color: black;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Enviar Correos</a>
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
