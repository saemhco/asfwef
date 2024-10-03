{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                Detalles
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
                <div class="card card-primary">
                    {#<div class="card-header">
                        <h3 class="card-title"><i class="fa fa-globe"></i><strong>Detalle de la Convocatoria </strong>
                        </h3>
                    </div>#}
                    <div class="card-header" style="padding-bottom: 5px !important;padding-top: 5px !important;">
                        <div class="list-group">
                            <a href="javascript:void(0)" style="pointer-events: none;"
                                class="list-group-item list-group-action withripple active">
                                <h3 class="card-title"><strong>Detalle de la Convocatoria de Bienes y Servicios</strong>
                                </h3>

                                {% if convocatoriabs.etapa == 1 %}
                                <span class="ml-auto badge badge-default"
                                    style="background-color: #00BCD4;color: white;">PUBLICADO</span>
                                {% elseif(convocatoriabs.etapa == 2) %}
                                <span class="ml-auto badge badge-default"
                                    style="background-color: #FF9800;color: white;">EN PROCESO</span>
                                {% elseif(convocatoriabs.etapa == 3) %}
                                <span class="ml-auto badge badge-default"
                                    style="background-color: #4CAF50;color: white;">FINALIZADO</span>
                                {% endif %}
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <!-- POST ITEM -->
                        <div class="blog-post-item">
                            <!-- POST ITEM -->
                            <h3 style="text-align: justify !important;"><strong> {{ convocatoriabs.titulo }} </strong>
                            </h3>
                            <p style="text-align: justify;">{{ convocatoriabs.texto_muestra }}</p>


                            {% if active_boton_postular == 1%}
                            {% if convocatoriabs.etapa == 1 %}

                            <div style="margin-top: -5px !important;margin-bottom: 10px !important;">
                                <center>
                                    <a href="{{ url('login-convocatoriasbs.html') }}"
                                        class="btn btn-warning btn-raised text-right" role="button">
                                        <i class="zmdi zmdi-plus"></i><span>PRESENTAR PROPUESTA</span>
                                    </a>
                                </center>
                            </div>

                            {% endif %}
                            {% endif %}


                            <table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">

                                <thead>
                                    <tr style="background:{{ config.global.xColorIns }};">
                                        <th>
                                            <center>
                                                <font color="#FFFFFF">ETAPAS DEL PROCESO</font< /center>
                                        </th>
                                        <th>
                                            <center>
                                                <font color="#FFFFFF">DOCUMENTO</font< /center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for convocatoriabs in convocatoriasbs1 %}
                                    <tr>
                                        <td style="color: #000000; vertical-align: middle;">
                                            <a style="color: #000000;"
                                                href="../adminpanel/archivos/convocatoriasbs/{{ convocatoriabs.archivo }}"
                                                target="_blank"> {{ convocatoriabs.titulo }} </a>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <center>
                                                <a href="../adminpanel/archivos/convocatoriasbs/{{ convocatoriabs.archivo }}"
                                                    target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-1">
                                                    <i class="fa fa-download"></i> Descargar
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                    {% endfor %}
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>

                {% if config.global.xAbrevIns == 'UNCA' %}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-globe"></i><strong>Consultas </strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="heading-title heading-border-bottom heading-color">
                            <h4 class="panel-title">Las consultas se pueden realizar: </h4>
                        </div>
                        <div>
                            <h5>
                                <p style="text-align: justify;">Enviando un correo electrónico a:</p>
                            </h5>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-envelope"></i>&nbsp&nbsp&nbsp Email: <a
                                    href="mailto:abastecimientos@unca.edu.pe">abastecimientos@unca.edu.pe</a> <br />

                            </ul>
                            {#<h5>
                                <p style="text-align: justify;">Llamando al teléfono:</p>
                            </h5>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-phone"></i> &nbsp&nbsp&nbsp +51 044 365463 <br />

                            </ul>
                            <h5>
                                <p style="text-align: justify;">En la Unidad de Trámite Documentario de la UNCA:</p>
                            </h5>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-home"></i>&nbsp&nbsp&nbsp Sede Administrativa: Jr. Miguel Grau N° 459 –
                                469.<br />

                            </ul>#}
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-home"></i>&nbsp&nbsp&nbsp Horario de Atención: 08:00 am - 01:00 pm y
                                02:30 pm. - 05:30 pm.<br />

                            </ul>
                        </div>

                    </div>
                </div>

                {% elseif(config.global.xAbrevIns == 'UNAAA') %}

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-globe"></i><strong>Consultas</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="heading-title heading-border-bottom heading-color">
                            <h4 class="panel-title">Las consultas se pueden realizar por los siguientes medios: </h4>
                        </div>
                        <div>
                            <h5>
                                <p style="text-align: justify;">Enviando un correo electrónico a:</p>
                            </h5>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-envelope"></i>&nbsp&nbsp&nbsp Email: <a
                                    href="mailto:consultas@unaaa.edu.pe">consultas@unaaa.edu.pe</a> <br />

                            </ul>
                            <h5>
                                <p style="text-align: justify;">Llamando al teléfono:</p>
                            </h5>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-phone"></i> &nbsp&nbsp&nbsp +51 065 353346 <br />

                            </ul>
                            <h5>
                                <p style="text-align: justify;">En la Unidad de Trámite Documentario de la UNAAA:</p>
                            </h5>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-home"></i>&nbsp&nbsp&nbsp Sede Principal: Prolog. Libertad # 1220 -
                                1228<br />

                            </ul>
                            <ul style="list-style-type: disc;">
                                <i class="fa fa-home"></i>&nbsp&nbsp&nbsp Horario de Atención: 07:30 am - 01:00 pm y
                                02:00 pm. - 04:00 pm.<br />

                            </ul>
                        </div>

                    </div>
                </div>

                {% endif %}

                <a href="{{ url('web-convocatoriasbs/'~convocatoriabs.tipo~'.html') }}"
                    class="btn btn-primary btn-raised text-right" role="button">
                    <i class="fa fa-backward"></i>
                    <span>Regresar</span>
                </a>

            </div>

        </div>
    </div>
</div>
{% endblock %}