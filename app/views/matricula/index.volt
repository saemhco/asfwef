<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Matricula</li>
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
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Iniciar Matricula </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                        {#<br>
                                        <br>
                                        <h4 class="text-primary" align="center"><strong>BIENVENIDO AL PROCESO DE MATRÍCULA DEL {{ semestre_nombre }}</strong></h4>
                                        <br>
                                        <br>
                                        <div class="well">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_iniciar_proceso_matricula">
                                                Iniciar Proceso de Matrícula
                                            </button>
                                        </div>#}
                                        
                                    {% if fecha_falta is defined %}
                                        <br>
                                        <br>
                                        <h4 class="text-primary" align="center"><strong>EL PROCESO DE MATRÍCULA NO SE ENCUENTRA DISPONIBLE</strong></h4>
                                        <br>
                                        <br>

                                    {% else %}
                                        <br>
                                        <br>
                                        <h4 class="text-primary" align="center"><strong>BIENVENIDO AL PROCESO DE MATRÍCULA DEL {{ semestre_nombre }}</strong></h4>
                                        <br>
                                        <br>
                                        <div class="well">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_iniciar_proceso_matricula">
                                                Iniciar Proceso de Matrícula
                                            </button>
                                        </div>
                                    {% endif %}



                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>

