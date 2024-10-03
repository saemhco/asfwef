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
<div class="container container-full" style ="margin-top: -50px;">
   
        <div class="row">         
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">            				
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Condiciones Básicas de Calidad.</strong></h3>
                    </div>
                    <div class="card-body">                        
                        
                        <div class="panel-body">
                            <h3><span>{{ condicion.nombre }}</span></h3>  
                            <center>
                                
                                <div class="piechart" data-color="#4169E1" data-trackcolor="rgba(0,0,0,0.04)" data-size="150" data-percent="{{ condicion.avance }}" data-width="10" data-animate="1700">
                                    <span class="fs-30">
                                        <span class="countTo" data-speed="1700">{{ condicion.avance }}</span>%
                                    </span>
                            </center>

                            <div class="col-md-12">
                                <select name="indicador" class="form-control selectpicker" id="indicador">
                                    <option value="0">--- Seleccione Indicador de la Condición {{ condicion.numero }} ---</option>
                                    {% for indicador in indicadores %}
                                        {% if indicador.id_indicador == 1 %}
                                            <option value="{{ indicador.id_indicador }}" selected="selected" >{{ indicador.indicador_a}} ...</option>
                                        {% else %}
                                            <option value="{{ indicador.id_indicador }}" >{{ indicador.indicador_a}} ...</option>
                                        {% endif %}
                                    {% endfor %}  
                                    <input type="hidden" id="id_condicion" name="id_condicion" value="{{ condicion.id_condicion }}">
                                </select>                                                
                            </div>
                                <br>
                                <div class="col-md-12" id="table_medios">
                                <table class="table table-hover table-bordered hidden" id="medios">
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>    
</div>
{% endblock %}
