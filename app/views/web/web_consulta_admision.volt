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
                        'get','id':'form_busqueda','class':'form-horizontal','autocomplete':'off') }}

                        <fieldset>
                            {#<legend>Legend</legend>#}
                            <div class="form-group row justify-content-end">

                                <div class="col-lg-8" style="margin-top: 8.5px !important;">
                                    <input type="text" placeholder="Buscar por número de documento" class="form-control"
                                        name="nro_doc" value="{{ nro_doc }}" style="color: #757575;" id="input-nro_doc">
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
                                <h2 class="color-danger" align="center">{{mensaje}}</h2>
                                {% elseif(result != "" ) %}

                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="4">
                                                    DATOS DEL POSTULANTE
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="15%"><strong>CÓDIGO:</strong></td>
                                                <td width="30%">{{ result.codigo }}</td>
                                                <td width="15%"><strong>NRO. DOC. </strong></td>
                                                <td width="40%">{{ result.nro_doc }}</td>
                                            </tr>
    
                                            <tr>
                                                <td width="15%"><strong>APELLIDOS Y NOMBRES:</strong></td>
                                                <td width="70%" colspan="3">{{ result.apellidop }} {{
                                                    result.apellidom }} {{
                                                        result.nombres }}</td>
    
                                            </tr>
    
    
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    VIDEO CONFERENCIA ZOOM
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td width="15%"><strong>EXAMEN SIMULACRO</strong></td>
                                                <td width="75%"><a href="{{ result.link_simulacro }}" target="_blank">{{ result.link_simulacro }}</a></td>
        
                                            </tr> -->
                                            <tr>
                                                <td width="15%"><strong>EXAMEN ENAE</strong></td>
                                                <td width="90%"><a href="{{ result.link_examen }}" target="_blank">{{ result.link_examen }}</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    {% if result.grupo == 1 %}
                                                    PLATAFORMA DEL ENAE - GRUPO: MAÑANA
                                                    {% elseif(result.grupo == 2) %}
                                                    PLATAFORMA DEL ENAE - GRUPO: TARDE
                                                    {% endif %}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="15%"><strong>PLATAFORMA LMS</strong></td>
                                                <td width="85%"><a href="{{ result.link_plataforma_lms }}" target="_blank">{{ result.link_plataforma_lms }}</a></td>
                                            </tr>
                                            <tr>
                                                <td width="15%"><strong>USUARIO</strong></td>
                                                <td width="85%">{{ result.nro_doc }}</td>
                                            </tr>
                                            <tr>
                                                <td width="15%"><strong>CONTRASEÑA</strong></td>
                                                <td width="85%">{{ result.password }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
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
                                                <td width="85%">
                                                    {% if result.proceso == "" %}
                                                    <strong style="color:red;">Aún no ha iniciado el proceso de
                                                        inscripción...</strong>
                                                    {% else %}
                                                    {% for procesosPostulantes_select in procesosPostulantes %}
                                                    {% if procesosPostulantes_select.codigo == result.proceso %}
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
                                                    {% endif %}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="15%"><strong>OBSERVACIONES: </strong></td>
                                                <td width="85%"> {{ result.observaciones }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            
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