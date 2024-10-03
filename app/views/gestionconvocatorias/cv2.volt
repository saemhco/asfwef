{% set txt_buton = "Registrar Voucher" %}
<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Gestión de convocatorias</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->

<div class="center-block" style="margin-bottom: 20px; margin-top: 20px;margin-left:30%;margin-right:30%">



<div id="content">
    <div class="row">

        <div class="col-sm-12">



            <table class="table table-sm table-primary table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">
                            <center>Sistema de Gestión de convocatorias</center>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>
                            <center>
                                <h1 style="color: #3276b1;font-weight: bold;">CONCURSO PÚBLICO DE MÉRITOS DE INGRESO A LA CARRERA COMO DOCENTE ORDINARIO</h1>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block bg-color-magenta btn-lg txt-color-white"
                                    href="{{ url('gestionconvocatorias/datos2') }}" style="width: 465px;margin: 0 auto;
                                   "> <i class="fa fa-user"></i> Datos Personales</a>
                            </div>

                            <!--
                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/descargas2') }}" style="width: 465px;margin: 0 auto;
                                   "> <i class="fa fa-download"></i> Descarga de Archivos</a>
                            </div>
                            -->



                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block bg-color-magenta btn-lg txt-color-white"
                                    href="{{ url('gestionconvocatorias/datosgenerales2') }}" style="width: 465px;margin: 0 auto;
                                   "> <i class="fa fa-user"></i> Datos Generales</a>
                            </div>



                        </td>

                    </tr>

                    <tr>
                        <td>
                            <center>
                                <h1 style="color: #3276b1;font-weight: bold;">REGISTRO DE CURRICULUM VITAE</h1>
                            </center>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <div class="center-block" style="margin-bottom: 20px;margin-top: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/colegiatura2') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-graduation-cap"></i> Colegiatura, Habilitación, CTI</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block bg-color-magenta btn-lg txt-color-white"
                                    href="{{ url('gestionconvocatorias/excepciones') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Para evaluar por Excepción</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/formacion') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-graduation-cap"></i> Grados Académicos y Títulos
                                    Profesionales</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/capacitaciones') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Actualizaciones y Capacitaciones</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/publicaciones') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Trabajos de investigación, publicaciones y patentes</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/experiencia') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-briefcase"></i> Experiencia académica y profesional</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/cargos') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Cargos Directivos <!--o Apoyo Administrativo--></a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/materiales') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Elaboración de materiales de enseñanza</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/idiomas') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Conocimiento de Idiomas</a>
                            </div>


                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/asesorias') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Asesoría de tesis</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/extension') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Actividades de Responsabilidad Social Universitaria <!--Actividades de Proyección Social y/o Extensión Cultural--></a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/distinciones') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Distinciones y Honores</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/ofimaticas') }}" style="width: 465px;margin: 0 auto;
                                       "> <i class="fa fa-book"></i> Conocimiento de Ofimática y Herraminetas Digitales</a>
                            </div>
                        </td>
                    </tr>


                </tbody>
            </table>



        </div>
    </div>
</div>

{{ form('reportes/reporteCurriculumVitae','method':
'post','id':'form_cv','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        {#<label class="col-md-2 control-label">Checkbox Styles</label>#}
        <div class="col-md-12">


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-datos_personales"
                        id="input-datos_personales">
                    <span>Datos Personales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-formacion" id="input-formacion">
                    <span>Formación Académica</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones"
                        id="input-capacitaciones">
                    <span>Capacitaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia" id="input-experiencia">
                    <span>Experiencia Laboral</span>
                </label>
            </div>
            <input type="hidden" id="publico" name="publico" value="">
        </div>
    </div>

</fieldset>
{{ endForm() }}

{{ form('convocatoriasganadores/getArchivosGanador','method':
'post','id':'form_archivos_ganador','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        {#<label class="col-md-2 control-label">Checkbox Styles</label>#}
        <div class="col-md-12">


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_datos_personales"
                        id="input-file_datos_personales">
                    <span>Datos Personales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-formacion" id="input-file_formacion">
                    <span>Formación Académica</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones"
                        id="input-file_capacitaciones">
                    <span>Capacitaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia"
                        id="input-file_experiencia">
                    <span>Experiencia Laboral</span>
                </label>
            </div>
            <input type="hidden" id="file_publico" name="file_publico" value="">
        </div>
    </div>

</fieldset>
{{ endForm() }}

<script type="text/javascript">

                                                                                            //var region_id = "";
                                                                                            //var provincia_id = '';
                                                                                            var publica = "si";
                                                                                           // var idl = "";
                                                                                        //var distrito_id = '';
</script>
                                                                                        <script type="text/javascript"> var perfil = "{{ perfil }}";</script>