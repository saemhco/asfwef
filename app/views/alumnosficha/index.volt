<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Mantenimiento de Estudiantes</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                data-widget-custombutton="false" data-widget-sortable="false">
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body text-center" style="margin-bottom: -55px;">
                        <a href="javascript:void(0);" onclick="ficha_socioeconomica();"
                            class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Actulizar Ficha Socioeconomica" style="margin-bottom: 5px;"><i
                                class="fa fa-file-text"></i></a>

             

                        <!-- <a href="javascript:void(0);" onclick="ficha_socioeconomica();"
                            class="btn bg-color-magenta txt-color-white btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Registro de test de riesgos sociales" style="margin-bottom: 5px;"><i
                                class="fa fa-clipboard"></i></a>
                        <a href="javascript:void(0);" onclick="ficha_socioeconomica();"
                            class="btn btn-success btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Registro de alertas de bajo rendimiento" style="margin-bottom: 5px;"><i
                                class="fa fa-exclamation-circle"></i></a>

                        <a href="javascript:void(0);" onclick="ficha_socioeconomica();"
                            class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Evaluacion socio economica" style="margin-bottom: 5px;"><i
                                class="fa fa-list"></i></a>

                        <a href="javascript:void(0);" onclick="ficha_socioeconomica();"
                            class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Evaluacion de riesgos sociales" style="margin-bottom: 5px;"><i
                                class="fa fa-list"></i></a> -->

                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Estudiantes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table class="table">
                                        <tr>
                                            <td>
                                                <center>
                                                    <select class="form-control" id="semestre">
                                                        <option value="">--SELECCIONE SEMESTE--</option>
                                                        {% if sem is defined %}

                                                        {% for s in semestres %}
                                                        {% if s.codigo == sem %}
                                                        <option value="{{ s.codigo }}" selected>{{ s.descripcion }}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                        {% endif %}
                                                        {% endfor %}
                                                        {% else %}
                                                        {% for s in semestres %}
                                                        {% if s.codigo == semestrea %}
                                                        <option value="{{ s.codigo }}" selected>{{ s.descripcion }}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                        {% endif %}
                                                        {% endfor %}
                                                        {% endif %}
                                                    </select>
                                                </center>
                                            </td>
                                        </tr>
                                    </table>

                                    <table id="tbl_alumnos"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>


                                                <th data-class="expand">CÓDIGO</th>
                                                <th>PROGRAMA DE ESTUDIOS</th>
                                                <th>APELLIDO PATERNO</th>
                                                <th>APELLIDO MATERNO</th>
                                                <th data-hide="phone,tablet">NOMBRES</th>
                                                <th data-hide="phone,tablet">N° DE DOCUMENTO</th>


                                                <th data-hide="phone,tablet">FICHA</th>
                                                <th data-hide="phone,tablet">ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>
{{ form('semestres/save_parametros','method':
'post','id':'form_alumnos_ficha','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">SEMESTRE MATRICULA</label>
            <label class="select">

                <select id="semestre_matricula" name="semestre_matricula">
                    <option value="0">SELECCIONE...</option>
                    {% for semestre_model in semestres %}
                    <option value="{{ semestre_model.codigo }}">{{ semestre_model.descripcion }}</option>
                    {% endfor %}
                </select> <i></i>

            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info">SEMESTRE ANTERIOR</label>
            <label class="select">
                <select id="semestre_anterior" name="semestre_anterior">
                    <option value="0">SELECCIONE...</option>
                    {% for semestre_model in semestres %}
                    <option value="{{ semestre_model.codigo }}">{{ semestre_model.descripcion }}</option>
                    {% endfor %}
                </select> <i></i>

            </label>
        </section>

    </div>
</fieldset>
{{ endForm() }}
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible...
        </p>
    </div>
</div>
<script type="text/javascript">
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

    //Lugar de procedencia
    var region1_id = "";
    var provincia1_id = '';
    var distrito1_id = '';

    var publica = "no";


    //Ficha por semestre
    {% if sem is defined %}
    var semestreax = "{{ sem }}";
    console.log("Carga semestre seleccionado: " + semestreax);
    {% else %}

    var semestreax = "{{ semestrea }}";
    console.log("Carga semestre por defecto: " + semestreax);
    {% endif %}

</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>