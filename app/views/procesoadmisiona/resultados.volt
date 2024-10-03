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
                                <h2>Resultados del ENAE</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>

                                {{ form('','method': 'post','id':'','class':'smart-form','style':'') }}

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

                                        <tr>
                                            <td width="15%"><strong>ENAE:</strong></td>

                                            <td colspan="3" width="70%">
                                                <section class="col col-md-3" style="margin-left: -15px;"> 
                                                    <label class="select">
                                                        <select id="id_admision_enae" name="id_admision_enae">
                                                            <option value="0">SELECCIONE ENAE...</option>
                                                            {% for admision_select in admision %}
                                                            <option value="{{ admision_select.codigo }}">{{
                                                                admision_select.descripcion }}</option>
                                                            {% endfor %}
                                                        </select> <i></i>

                                                    </label>
                                                </section>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>

<br>
<br>
                                <table class="table table-sm table-primary table-bordered" style="display: none;" id="si_resultados">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                RESULTADOS
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>CALIFICACIÓN</strong></td>
                                            <td width="30%">{{ admisionPostulante.puntaje }}</td>
                                            <td width="15%">
                                                <a href="javascript:void(0);" onclick="clickConstancia();"
                                                    class="btn btn-sm btn-success" role="button">VER CONSTANCIA<i
                                                        class="fa-fw fa fa-image"
                                                        style="padding-left: 30px;padding-right: 30px;padding-top: 8px;padding-bottom: 8px;"
                                                        id="input-constancia"></i></a>


                                            </td>
                                            <td width="40%">
                                                <span>Usted a descargado {{admisionPostulante.contador}} veces la
                                                    constancia</span>
                                            </td>
                                            <!-- <td width="40%">
                                                <form class="form-horizontal">
                        
                                                    <fieldset class="demo-switcher-1">
                                        
                                                        <div class="form-group">
                                                            
                                                            <div class="col-md-10">
                                                                <label class="radio radio-inline">
                                                                    
                                                                    <input type="radio" class="radiobox" name="sexo">
                                                                    <span>Masculino</span> 
                                                                    
                                                                </label>
                                                                <label class="radio radio-inline">
                                                                    <input type="radio" class="radiobox" name="sexo" checked="checked">
                                                                    <span>Femenino</span>  
                                                                </label>

                                                            </div>
                                                        </div>
                                                    
                                                    </fieldset>
                                                    
  
                        
                                                </form>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-sm table-primary table-bordered" style="display: none;" id="no_resultados">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                RESULTADOS
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>ENAE:</strong></td>

                                            <td colspan="3" width="70%">
x
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{ endForm() }}



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