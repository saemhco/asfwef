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
                                <h2>PROCESO DE INSCRIPCIÓN </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>


                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                <center>DATOS DEL POSTULANTE</center>
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
                                            <td width="30%">{{ postulante.apellidop }} {{ postulante.apellidom }} {{
                                                postulante.nombres }}</td>
                                            <td width="15%"><strong>ARCHIVO DNI: </strong></td>
                                            <td width="40%">{% if postulante.archivo == "" %} NO {%
                                                elseif(postulante.archivo !== "") %} SI {% endif %}</td>
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
                                            <td width="15%"><strong>PROCESO: {{admision.proceso}}</strong></td>
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
                                        <!-- <tr>
                                            <td width="15%"><strong>OBSERVACIONES: </strong></td>
                                            <td width="90%"> {{ admision.observaciones }}</td>
                                        </tr> -->
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>


        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Informacion de Registro</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    {{ form('gestionconvocatorias/saveInscripcion','method':
                                    'post','id':'form_admisionproceso','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-12">


                                                <center>
                                                    <a class="btn bg-color-magenta btn-sm txt-color-white" role="button"
                                                        href="javascript:void(0);"
                                                        onclick="imagen_tasa_lugar_pago();">Ver Tasas y Lugar de Pago
                                                    </a>
                                                </center>



                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info">Nro. de Voucher / Nro. Operación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-list-ol"></i>
                                                    <input type="text" id="input_recibo" name="recibo" placeholder=""
                                                        value="">

                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info">Monto Cancelado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                    <input type="number" id="input_monto" name="monto" placeholder=""
                                                        value="">

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <div class="input input-file">
                                                    <label class="text-info">Agregar Imagen del Voucher de Pago (TIpo de
                                                        archivo: jpg, png o jpeg)</label>
                                                    <label class="input">
                                                        <input id="file_index_imagen" type="file"
                                                            name="file_index_imagen_name"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                        <input type="hidden" id="input-index-imagen" name="imagen_index"
                                                            value="">
                                                    </label>
                                                </div>
                                                <input type="hidden" id="input_postulante" name="postulante"
                                                    value="{{ postulante.codigo }}">
                                                <input type="hidden" id="input_convocatoria" name="convocatoria"
                                                    value="{{convocatoria.id_convocatoria}}">

                                                <input type="hidden" id="input-codigo" name="codigo"
                                                    value="">
                                            </section>

                                        </div>
                                    </fieldset>
                                    <footer>
                                        <button id="save" type="button" class="btn btn-primary">
                                            Registrar Recibo / Voucher
                                        </button>
                                    </footer>
                                    {{ endForm() }}
                                </div>
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
            Se registró correctamente su recibo...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="warning">
        <p>
            ¿Esta seguro que desea enviar su voucher?...
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