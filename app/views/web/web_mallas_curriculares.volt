{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                MALLAS CURRICULARES
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-globe"></i><strong>Malla Curricular</strong>
                    </h3>
                </div>
                <div class="card-body">

                    <div class="panel-body">
                        <center>

                            <h4>SELECCIONE PROGRAMA DE ESTUDIOS</h4>

                        </center>

                        <div class="col-md-12">
                            <select name="carrera" class="form-control selectpicker" id="input-carrera"
                                data-dropup-auto="false">

                                <option value="0">---SELECCIONE---</option>

                                {% for carreras_select in carreras %}

                                <option value="{{ carreras_select.codigo }}">{{ carreras_select.descripcion}}</option>

                                {% endfor %}



                            </select>
                        </div>

                    </div>

                    <div class="panel-body" style="display: none;" id="panel-body-curricula">
                        <center>

                            <h4>SELECCIONE PLAN DE ESTUDIOS</h4>
                        </center>

                        <div class="col-md-12">
                            <select name="carrera" class="form-control selectpicker" id="input-curricula">

                            </select>
                        </div>

                    </div>

                    <br>

                    <div class="col-md-12" id="table-asignaturas" style="display: none;">
                        <table id="tbl_asignaturas"
                            class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th data-class="expand">CÓDIGO</th>
                                    <th>NOMBRE</th>
                                    <th>CURRICULA</th>
                                    <th data-hide="phone,tablet">CICLO</th>
                                    <th data-hide="phone,tablet">CRED.</th>
                                    <th data-hide="phone,tablet">HT</th>
                                    <th data-hide="phone,tablet">HP</th>
                                    <th data-hide="phone,tablet">TIPO</th>
                                    <th data-hide="phone,tablet">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}