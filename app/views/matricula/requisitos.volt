<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Requisitos</li>
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
                                <h2>Requisitos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body">
                                    <form class="form-horizontal">

                                        <fieldset class="demo-switcher-1">
                                            <legend>Requisitos para la Matrícula</legend>

                                            <div class="form-group">
                                                {#<label class="col-md-2 control-label">Inline</label>#}
                                                {#<div class="col-md-12">#}

                                                {% set  xAbrevIns = config.global.xAbrevIns %}

                                                {% if xAbrevIns == 'UNCA' %}
                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">

                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if registros_academicos == 1 %}checked disabled{% endif %}>


                                                            <span>Reg. Académicos</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if servicio_social == 1 %}checked disabled{% endif %}>
                                                            <span>Ficha de Evaluación Socioeconómica Familiar</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">

                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if servicio_salud == 1 %}checked disabled{% endif %}>
                                                            <span>Examen Médico</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if servicio_psicopedagogico == 1 %}checked disabled{% endif %}>
                                                            <span>Examen Psicológico</span>
                                                        </label>
                                                    </div>
                                                    <!--
                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if servicio_deportivo == 1 %}checked disabled{% endif %}>
                                                            <span>Servicios Deportivos</span>
                                                        </label>
                                                    </div>
                                                    -->

                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if voucher != 0 %}checked disabled{% endif %}>
                                                            <span>Comprobante de Pago por Derecho de Matrícula</span>
                                                        </label>
                                                    </div>
                                                {% elseif xAbrevIns == 'UNAAA' %}
                                                    <div class="col-md-2">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if voucher != 0 %}checked disabled{% endif %}>
                                                            <span>Voucher de Pago</span>
                                                        </label>
                                                    </div>
                                                {% else%}
                                                    {% if (resolucion_matricula_especial != 1) %}
                                                            <div class="col-md-2">
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if promedio_anterior > 10.5 %}checked disabled{% endif %}>
                                                                    <span>Promedio Aprobado</span>
                                                                </label>
                                                            </div>                                                 
                                                    {% else%}                                                            
                                                            <div class="col-md-2">
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if resolucion_matricula_especial !=0 %}checked disabled{% endif %}>
                                                                    <span>Resolución Matricula</span>
                                                                </label>
                                                            </div>
                                                    {% endif %}
                                                    
                                                            <div class="col-md-2">
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" class="checkbox style-0" onclick="javascript: return false;" {% if voucher != 0 %}checked disabled{% endif %}>
                                                                    <span>Voucher de Pago</span>
                                                                </label>
                                                            </div>
                                                    
                                                {% endif %}


                                                {#</div>#}

                                            </div>

                                        </fieldset>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {#<button class="btn btn-default" type="submit">
                                                        Cancel
                                                    </button>#}
                                                    {#<button class="btn btn-primary" type="button">
                                                        <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente
                                                    </button>#}
                                                    {% set  xAbrevIns = config.global.xAbrevIns %}

                                                    {% if xAbrevIns == 'UNCA' %}
                                                                {% if registros_academicos == 1 and servicio_social == 1 and servicio_salud == 1 and servicio_psicopedagogico == 1  and voucher == 1 %}
                                                                    <a href="{{ url('matricula/matricula') }}" role="button" class="btn tbn-block btn-primary"><i class="fa fa-arrow-right" ></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente</a>
                                                                {% else%}
                                                                    <a href="javascript:void(0)" role="button" class="btn tbn-block btn-default" style="background:#E2E2E2;" disabled="disabled"><i class="fa fa-arrow-right" ></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente</a>
                                                                {% endif %}
                                                    {% elseif xAbrevIns == 'UNAAA' %}
                                                                {% if voucher == 1 %}
                                                                    <a href="{{ url('matricula/matricula') }}" role="button" class="btn tbn-block btn-primary"><i class="fa fa-arrow-right" ></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente</a>
                                                                {% else%}
                                                                    <a href="javascript:void(0)" role="button" class="btn tbn-block btn-default" style="background:#E2E2E2;" disabled="disabled"><i class="fa fa-arrow-right" ></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente</a>
                                                                {% endif %}
                                                    {% else%}
                                                                {% if (voucher == 1) and (promedio > 10.5 or resolucion_matricula_especial == 1) %}
                                                                    <a href="{{ url('matricula/matricula') }}" role="button" class="btn tbn-block btn-primary"><i class="fa fa-arrow-right" ></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente</a>
                                                                {% else%}
                                                                    <a href="javascript:void(0)" role="button" class="btn tbn-block btn-default" style="background:#E2E2E2;" disabled="disabled"><i class="fa fa-arrow-right" ></i>&nbsp;&nbsp;&nbsp;&nbsp;Siguiente</a>
                                                                {% endif %}
                                                    {% endif %}
                                                </div>
                                            </div>
                                        </div>
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

