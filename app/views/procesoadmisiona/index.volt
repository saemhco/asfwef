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
                                <h2>ACCESOS AL LINKS / ENLACES AL ENAE</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>


                                <table class="table table-sm table-primary table-bordered">
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
                                            <td width="30%">{{ postulante.codigo }}</td>
                                            <td width="15%"><strong>NRO. DOC. </strong></td>
                                            <td width="40%">{{ postulante.nro_doc }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>APELLIDOS Y NOMBRES:</strong></td>
                                            <td width="70%" colspan="3">{{ postulante.apellidop }} {{
                                                postulante.apellidom }} {{
                                                postulante.nombres }}</td>

                                        </tr>


                                    </tbody>
                                </table>

            
                            <table class="table table-sm table-primary table-bordered">
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
                                        <td width="75%"><a href="{{ links.link_simulacro }}" target="_blank">{{ links.link_simulacro }}</a></td>

                                    </tr> -->
                                    <tr>
                                        <td width="15%"><strong>EXAMEN ENAE</strong></td>
                                        <td width="75%"><a href="{{ links.link_examen }}" target="_blank">{{ links.link_examen }}</a></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-sm table-primary table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            {% if links.grupo == 1 %}
                                            PLATAFORMA DEL ENAE - GRUPO: MAÑANA
                                            {% elseif(links.grupo == 2) %}
                                            PLATAFORMA DEL ENAE - GRUPO: TARDE
                                            {% endif %}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="15%"><strong>PLATAFORMA LMS</strong></td>
                                        <td width="75%"><a href="{{ links.link_plataforma_lms }}" target="_blank">{{ links.link_plataforma_lms }}</a></td>
                                    </tr>
                                    <tr>
                                        <td width="15%"><strong>USUARIO</strong></td>
                                        <td width="75%">{{ postulante.nro_doc }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%"><strong>CONTRASEÑA</strong></td>
                                        <td width="75%">{{ links.password }}</td>
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
                                            {% if admision.proceso == "" %}
                                            <strong style="color:red;">Aún no ha iniciado el proceso de
                                                inscripción...</strong>
                                            {% else %}
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

{{ form('','method': 'post','id':'modal_imagen_tasa_lugar_pago','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <center>
                <img class="img-responsive" src="" id="input-lugar_pago"></img>
            </center>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente su postulacion...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="warning">
        <p>
            ¿Está seguro que desea inscribirse para el examen de admision ENAE?...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="waringFiles">
        <p>
            Por favor cargar los archivos requeridos en su Registro...
        </p>
    </div>
</div>

<script type="text/javascript">
    var id = "";

    {% if id is defined %}
    id = {{ id }};
    {% endif %}
</script>

<script type="text/javascript">
    var foto = "{{ postulante.foto }}";
    var archivo = "{{ postulante.archivo }}";
    var archivo_escuela = "{{ postulante.archivo }}";

    //console.log("Foto:" + foto);
    //console.log("Archivo:" + archivo);
    //console.log("Archivo Escuela:" + archivo_escuela);

</script>