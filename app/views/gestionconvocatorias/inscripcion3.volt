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
                                                
                                                <strong style="color:red;">Aún no ha iniciado el proceso de
                                                    inscripción...</strong>
                                                
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td width="15%"><strong>OBSERVACIONES: </strong></td>
                                            <td width="90%"> {{ admision.observaciones }}</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                <div class="widget-body no-padding">

                                    {{ form('gestionconvocatorias/saveInscripcion2','method':
                                    'post','id':'form_admisionproceso','class':'smart-form','enctype':'multipart/form-data')
                                    }}
                                    <input type="hidden" id="id_convocatoria" name="id_convocatoria"
                                    value="{{ id_convocatoria }}">

                                    <input type="hidden" id="id_publico" name="id_publico"
                                    value="{{ id_publico }}">
                                    <br>
                                    <footer>
                                        <button id="save" type="button" class="btn btn-primary">
                                            Iniciar Inscripción
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
            Se inicio su inscripción correctamente...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="warning">  
        <p>
            ¿Esta seguro que desea iniciar su inscripcion?...
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