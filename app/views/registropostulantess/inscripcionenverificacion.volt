<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Proceso de Admision</li>
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
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>PROCESO DE ADMISIÓN - {{admision_activo.descripcion}} </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>


                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                DATOS POSTULANTE
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>CÓDIGO:</strong></td>
                                            <td width="30%">{{ codigo_postulante }}</td>
                                            <td width="15%"><strong>NRO. DOC. </strong></td>
                                            <td width="40%">{{ postulante.nro_doc }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>APELLIDOS:</strong></td>
                                            <td width="30%">{{ postulante.apellidop }} {{ postulante.apellidom }}</td>
                                            <td width="15%"><strong>NOMBRES:</strong></td>
                                            <td width="40%">{{ postulante.nombres }}</td>
                                        </tr>



                                    </tbody>
                                </table>

                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="6">
                                                DATOS INSCRIPCIÓN
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>NÚMERO:</strong></td>
                                            <td width="20%">
                                                {{ admision.recibo }}
                                            </td>
                                            <td width="15%"><strong>MONTO: </strong></td>
                                            <td width="20%"> {{ admision.monto }}</td>
                                            <td width="15%"><strong>ARCHIVO:</strong>
                                            </td>
                                            <td width="15%">
                                                <center>
                                                    <a class="btn btn-success btn-sm" role="button"
                                                        href="javascript:void(0);" onclick="modal_voucher();"> <i
                                                            class="fa-fw fa fa-image"></i>
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                ESTADO DE LA INSCRIPCIÓN
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>PROCESO:</strong></td>
                                            <td width="90%">
                                                {% if admision.proceso !== "" %}
                                                {% for procesosPostulantes_select in procesosPostulantes %}
                                                {% if procesosPostulantes_select.codigo == admision.proceso %}


                                                {% if procesosPostulantes_select.codigo == 0 %}
                                                <strong>{{procesosPostulantes_select.nombres }}</strong>
                                                {% elseif(procesosPostulantes_select.codigo == 1) %}
                                                <strong>{{procesosPostulantes_select.nombres }}</strong>
                                                {% elseif(procesosPostulantes_select.codigo == 2) %}
                                                <strong style="color: blue;">{{procesosPostulantes_select.nombres
                                                    }}</strong>
                                                {% elseif(procesosPostulantes_select.codigo == 3) %}
                                                <strong style="color: red;">{{procesosPostulantes_select.nombres
                                                    }}</strong>
                                                {% endif %}


                                                {% endif %}
                                                {% endfor %}
                                                {% else %}
                                                <strong style="color:red;">No Inscrito</strong>
                                                {% endif %}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>OBSERVACIONES: </strong></td>
                                            <td width="90%"> {{ admision.observaciones }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>

    </div>
</div>

{{ form('','method': 'post','id':'modal_voucher','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">

            <center>
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/admision/'~admision_activo.codigo~'/'~admision.imagen) }}"
                error="this.onerror=null;this.src='';"></img>
            </center>

        </section>
    </div>
</fieldset>
{{ endForm() }}