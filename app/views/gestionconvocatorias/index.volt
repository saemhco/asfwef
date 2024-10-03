<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion de convocatorias</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12">



            <table class="table table-sm table-primary table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">
                <center>Gestión de convocatorias</center>
                </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/datos') }}" style="width: 300px;margin: 0 auto;
                                   "> <i class="fa fa-user"></i> Datos Personales</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/formacion') }}" style="width: 300px;margin: 0 auto;
                                   "> <i class="fa fa-graduation-cap"></i> Formación Académica</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/capacitaciones') }}" style="width: 300px;margin: 0 auto;
                                   "> <i class="fa fa-book"></i> Capacitaciones</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/experiencia') }}" style="width: 300px;margin: 0 auto;
                                   "> <i class="fa fa-briefcase"></i> Experiencia Laboral</a>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">                                 
                                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-guardar-documentos" style="width: 300px;margin: 0 auto;" onclick="reporte_resumen_ganador({{id_publico}});">
                                    <i class="fa fa-file-pdf-o"></i> Resumen
                                </button>
                            </div>

                            <div class="center-block" style="margin-bottom: 20px;">
                                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-guardar-documentos" style="width: 300px;margin: 0 auto;" onclick="archivos_ganador({{id_publico}});">
                                    <i class="fa fa-archive"></i> Archivos
                                </button>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>



        </div>			
    </div>	
</div>

{{ form('reportes/reporteCurriculumVitae','method': 'post','id':'form_cv','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        {#<label class="col-md-2 control-label">Checkbox Styles</label>#}
        <div class="col-md-12">


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-datos_personales" id="input-datos_personales">
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
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones" id="input-capacitaciones">
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

{{ form('convocatoriasganadores/getArchivosGanador','method': 'post','id':'form_archivos_ganador','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        {#<label class="col-md-2 control-label">Checkbox Styles</label>#}
        <div class="col-md-12">


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_datos_personales" id="input-file_datos_personales">
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
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones" id="input-file_capacitaciones">
                    <span>Capacitaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia" id="input-file_experiencia">
                    <span>Experiencia Laboral</span>
                </label>
            </div>
            <input type="hidden" id="file_publico" name="file_publico" value="">
        </div>       
    </div>

</fieldset>
{{ endForm() }}

<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
    var idl = "";
//var distrito_id = '';
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

