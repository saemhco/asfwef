{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }}
                SITUACIÓN DE MI TRÁMITE
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php //$this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-search"></i><strong>Búsqueda de Trámites </strong></h3>
                    </div>
                    <div class="card-body">

                        {{ form(full_url,'method':
                        'get','id':'form_busqueda_tramite','class':'form-horizontal','autocomplete':'off') }}

                        <fieldset>
                            {#<legend>Legend</legend>#}
                            <div class="form-group row justify-content-end">


                                <div class="col-lg-4">
                                    <select id="select2" class="form-control selectpicker" data-dropup-auto="false"
                                        name="anio_tramite">
                                        <option value="">--- SELECCIONE AÑO---</option>

                                        <option value="2023" selected="selected" codigo>2023
                                        </option>

                                        <option value="2022">2022
                                        </option>

                                        <option value="2021">2021
                                        </option>

                                        <option value="2019">2020
                                        </option>


                                    </select>
                                </div>

                                <div class="col-lg-8" style="margin-top: 8.5px !important;">
                                    <input type="number" placeholder="Buscar por N° de Registro" class="form-control"
                                        name="codigo_tramite" value="{{ codigo_tramite }}" style="color: #757575;" id="input-codigo">
                                </div>
                                <div class="col-lg-4">

                                    <button type="submit" class="btn btn-raised btn-primary btn-block" value="buscar"><i
                                            class="zmdi zmdi-search"></i> Buscar</button>
                                </div>
                            </div>
                        </fieldset>
                        {{ endForm() }}
                        <br>

                        <div class="card card-primary">
                            <div class="card-body">

                                {% if mensaje != "" %}
                                <p class="color-danger" align="center">{{mensaje}}</p>
                                {% elseif(documentos != "" ) %}

                                <div class="row">
                                    <div class="col-lg-6" style="margin-bottom: -10px;">
                                        <p class="color-primary">
                                            <strong>
                                                FECHA ENVIO:
                                                <span style="color: black;">{{documentos.fecha_envio}}</span>
                                            </strong>
                                        </p>
                                        <p class="color-primary"><strong>TIPO DE DOCUMENTO:
                                            <span style="color: black;">{{documentos.tipo_documento_nombre}}</span></strong>
                                        </p>
                                    </div>
                                    <div class="col-lg-6" style="margin-bottom: -10px;">
                                        <p class="color-primary">
                                            <strong>FECHA CARGO:
                                                <span style="color: black;">{{documentos.fecha_cargo}}</span>
                                            </strong>
                                        </p>
                                        <p class="color-primary"><strong>NRO DOCUMENTO:
                                                <span style="color: black;">{{documentos.nro_documento}}</span>
                                            </strong></h4>
                                    </div>
                                    <div class="col-lg-6" style="margin-bottom: -10px;">
                                        <p class="color-primary"><strong>DESTINATARIO:
                                            <span style="color: black;">{{documentos.destinatario_personal}}</span></strong>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="color-primary"><strong>REMITENTE:
                                            <span style="color: black;">{{documentos.remitente_nombres}}</span></strong>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="color-primary"><strong>ESTADO DE TRÁMITE:
                                            <span style="color: black;">{{documentos.proceso_tramite_nombre}}</span></strong>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="color-primary"><strong>OBSERVACIONES:
                                            <span style="color: black;">{{documentos.observaciones}}</span></strong>
                                        </p>
                                    </div>
                                </div>

                                <!--
                                <div class="row">
                                    <div class="col text-center">
                                        <button class="btn btn-raised btn-sm btn-primary" type="button" id="btn-detalle"
                                        style="margin-top: 20px!important;"><i class="zmdi zmdi-plus"></i>VER MÁS</button>
                                        <input type="hidden" id="input-id_doc" name="id_doc" value="{{documentos.id_doc}}">
                                    </div>
                                </div>


                                <div class="row" style="display: none;" id="documentos_detalle">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>FECHA</th>
                                                    <th>PROVEIDO</th>
                                                    <th>DESTINATARIO</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_documentos_detalles">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row" style="display: none;" id="documentos_detalle_vacio">
                                    <h2 class="color-danger" align="center" id="mensaje_detalle_vacio"></h2>
                                </div>
                                -->

                                {% endif %}


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}