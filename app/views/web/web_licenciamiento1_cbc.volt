{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                Licenciamiento Institucional
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">

    <div class="row">
        <!-- CENTER -->
        <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-globe"></i><strong>Condiciones Básicas de Calidad.</strong>
                    </h3>
                </div>
                <div class="card-body">

                    <div class="panel-body">
                        <h3><span>{{ condicion1.nombre }}</span></h3>
                        <center>

                            <div class="piechart" data-color="#4169E1" data-trackcolor="rgba(0,0,0,0.04)"
                                data-size="150" data-percent="{{ condicion1.avance }}" data-width="10"
                                data-animate="1700">
                                <span class="fs-30">
                                    <span class="countTo" data-speed="1700">{{ condicion1.avance }}</span>%
                                </span>
                        </center>

                        <div class="col-md-12">
                            <select name="indicador1" class="form-control selectpicker" id="indicador1">
                                <option value="0">--- Seleccione indicador de la Condición {{ condicion1.numero }} ---
                                </option>



                                {% for indicadores1_select in indicadores1 %}
   
                                <option value="{{ indicadores1_select.id_indicador1 }}">{{ indicadores1_select.indicador_a}} ...</option>
                  
                                {% endfor %}





                                <input type="hidden" id="id_condicion1" name="id_condicion1"
                                    value="{{ condicion1.id_condicion1 }}">
                            </select>
                        </div>
                        <br>
                        
                        

                    </div>
                
                <br>
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-globe"></i><strong>Comunicado</strong></h3>
                        </div>
                        <div class="card-body">
                            <center>
                            <span style="color:#2600ff">UNIVERSIDAD NACIONAL CIRO ALEGRIA - UNCA</span><br/>
                            <span style="color:#2600ff">(LA LIBERTAD / SANCHEZ CARRION / HUAMACHUCO)</span><br/>
                            <span style="color:#2600ff">En mérito a la Resolución de Superintendencia N° 0055-2021-SUNEDU - Aprobar las “Consideraciones para la valoración...</span><br/>
                            <span style="color:#2600ff">Los documentos correspondientes al Licenciamiento Institucional se encuentran en actualización ...</span>
                            </center>
                            
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}