<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Gestion de convocatorias</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12">



            <table class="table table-sm table-primary table-bordered">

                <tbody>
                    <tr>
                        <td>
                            <center>
                                <!--<h1 style="color: #3276b1;font-weight: bold;">CONVOCATORIAS FONDOS CONCURSABLES RSU</h1>-->
                                <h1 style="color: #3276b1;font-weight: bold;">PROYECTO DE RESPONSABILIDAD SOCIAL UNIVERSITARIA</h1>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block bg-color-magenta btn-lg txt-color-white"
                                    href="{{ url('datos/docente') }}" style="width: 505px;margin: 0 auto;
                                   "> <i class="fa fa-user"></i> Datos Personales</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block btn-lg btn-primary"
                                    href="{{ url('gestionconvocatorias/descargas4') }}" style="width: 505px;margin: 0 auto;
                                   "> <i class="fa fa-download"></i> Descarga de Archivos</a>
                            </div>
                            <div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
                                <a class="btn btn-block bg-color-magenta btn-lg txt-color-white"
                                    href="{{ url('gestionconvocatorias/datosgenerales4') }}" style="width: 505px;margin: 0 auto;
                                   "> <i class="fa fa-user"></i> Datos Generales</a>
                            </div>



                        </td>

                    </tr>
                    
                </tbody>
            </table>



        </div>
    </div>
</div>

<script type="text/javascript">
    //var region_id = "";
    //var provincia_id = '';
    var publica = "no";
    var idl = "";
//var distrito_id = '';
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>