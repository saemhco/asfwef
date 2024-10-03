<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Gestion Planillas</li>
        <li>Detalle de Pago</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <form id="form-detalle-pago" method="POST">
            <div class="col-md-12">
                <section id="widget-grid" class="">
                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false"
                                data-widget-editbutton="false" data-widget-togglebutton="false"
                                data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                data-widget-custombutton="false">

                                <header>
                                    <center>
                                        <h2><strong>DETALLE DE PAGO - {{ mes_text }}</strong></h2>
                                    </center>
                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">

                                        <!-- widget body text-->




                                        <div class="row">
                                            <div class="col col-md-12">

                                                <table class="table table-sm table-primary table-bordered"
                                                    style="font-size: 10px !important;margin-bottom:0px !important;">

                                                    <tr>
                                                        <td width="27%"><strong>PLANILLA: {{ planilla.numero }}</strong>
                                                        </td>
                                                        <td width="34%"><strong>PERIODO: {{ periodo.periodo }}</strong>
                                                            <input type="hidden" name="planilla"
                                                                value="{{ planilla_id }}">

                                                            <input type="hidden" name="personal"
                                                                value="{{ personal_id }}">
                                                        </td>
                                                        <td width="50%">
                                                            <strong>TIPO: {{ tipoplanilla.nombre }}</strong>
                                                        </td>


                                                    </tr>


                                                </table>
                                            </div>


                                        </div>



                                        <!-- Widget ID (each widget will need unique ID)-->
                                        <div class="jarviswidget col-md-12" id="wid-id-12"
                                            data-widget-colorbutton="false" data-widget-colorbutton="false"
                                            data-widget-editbutton="false" data-widget-deletebutton="false"
                                            data-widget-fullscreenbutton="false" data-widget-custombutton="false"
                                            data-widget-collapsed="false" data-widget-sortable="false"
                                            data-widget-togglebutton="false">

                                            <header>

                                                <center>
                                                    <h2><strong>TRABAJADOR</strong></h2>
                                                </center>


                                            </header>

                                            <!-- widget div-->
                                            <div>

                                                <!-- widget edit box -->
                                                <div class="jarviswidget-editbox">
                                                    <!-- This area used as dropdown edit box -->

                                                </div>
                                                <!-- end widget edit box -->

                                                <!-- widget content -->
                                                <div class="widget-body no-padding">
                                                    <table class="table"
                                                        style="font-size: 12px !important;margin-bottom:0px !important;">
                                                        <tbody>

                                                            <tr>
                                                                <td>
                                                                    <strong>DNI : <label class="label label-primary">{{
                                                                            personal.nro_doc }}</label></strong>
                                                                </td>
                                                                <td>
                                                                    <strong>APELLIDOS Y NOMBRES: <label
                                                                            class="label label-primary"> {{
                                                                            personal.apellidop }} {{ personal.apellidom
                                                                            }} {{ personal.nombres }}
                                                                        </label></strong>
                                                                </td>
                                                                <td>
                                                                    <strong>FECHA DE NACIMIENTO : <label
                                                                            class="label label-primary">{{
                                                                            utilidades.fechita(personal.fecha_nacimiento,"d-m-Y")
                                                                            }}</label></strong>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>CARGO: <label class="label label-primary">
                                                                            {{ contrato.cargo }}
                                                                        </label></strong>
                                                                </td>

                                                                <td>
                                                                    <strong>AREA: <label class="label label-primary"> {{
                                                                            area.nombres }}
                                                                        </label></strong>
                                                                </td>


                                                                <td>
                                                                    <strong>TIPO DE SERVIDOR: <label
                                                                            class="label label-primary"> {{
                                                                            tipo_servidor.nombres }}
                                                                        </label></strong>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <strong>REGIMEN PENSIONARIO: <label
                                                                            class="label label-primary"> {{ regimen }}
                                                                            {{ afp.nombre }}
                                                                        </label></strong>
                                                                    &nbsp;
                                                                    <label class="label label-primary"> APORTE: {{
                                                                        detalleafp.aporte }}
                                                                    </label></strong>
                                                                    &nbsp;
                                                                    <label class="label label-primary"> PRIMA: {{
                                                                        detalleafp.prima }}
                                                                    </label></strong>
                                                                    &nbsp;
                                                                    <label class="label label-primary"> CSR: {{
                                                                        detalleafp.comision }}
                                                                    </label></strong>


                                                                </td>
                                                                <td>
                                                                    <strong>CUSPP: <label class="label label-primary">
                                                                            {{ personal.cusp }}
                                                                        </label></strong>
                                                                </td>


                                                                <td>
                                                                    <strong>CODIGO DE ESSALUD: <label
                                                                            class="label label-primary"> {{
                                                                            personal.seguro_nro }}
                                                                        </label></strong>
                                                                </td>

                                                            </tr>
                                                            <tr style="border-bottom:1px solid #ddd !important;">
                                                                <td>
                                                                    <strong>FECHA DE INGRESO : <label
                                                                            class="label label-primary">{{
                                                                            utilidades.fechita(personal.fecha_ingreso,"d-m-Y")
                                                                            }}</label></strong>
                                                                </td>
                                                                <td>
                                                                    <strong>DIAS TRABAJADOS :
                                                                        <label class="label label-primary">
                                                                            {{planilladetalle.diastrab}}
                                                                        </label>
                                                                    </strong>
                                                                </td>

                                                                <td>
                                                                    <strong>RENTA :</strong>
                                                                    <label class="checkbox"
                                                                        style="display: inline-block;">

                                                                        {% if planilladetalle.renta == 1 %}
                                                                        <input type="checkbox" name="renta"
                                                                            value="{{ planilladetalle.renta }}"
                                                                            id="renta" checked>
                                                                        {% else %}
                                                                        <input type="checkbox" name="renta"
                                                                            value="{{ planilladetalle.renta }}"
                                                                            id="renta">
                                                                        {% endif %}

                                                                        <i></i>

                                                                    </label>

                                                                    <strong>NO AFP :</strong>
                                                                    <label class="checkbox"
                                                                    style="display: inline-block;">

                                                                    {% if planilladetalle.afp_no == 1 %}
                                                                    <input type="checkbox" name="afp_no"
                                                                        value="{{ planilladetalle.afp_no }}"
                                                                        id="afp_no" checked>
                                                                    {% else %}
                                                                    <input type="checkbox" name="afp_no"
                                                                        value="{{ planilladetalle.afp_no }}"
                                                                        id="afp_no">
                                                                    {% endif %}

                                                                    <i></i>

                                                                </label>

                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                    <!-- widget body text-->
                                                    <ul id="widget-tab-1" class="nav nav-tabs">

                                                        <li class="active">

                                                            <a data-toggle="tab" href="#hr1"> <i
                                                                    class="fa fa-lg fa-arrow-circle-o-down"></i> <span>
                                                                    INGRESOS </span> </a>

                                                        </li>

                                                        <li>
                                                            <a data-toggle="tab" href="#hr2"><i
                                                                    class="fa fa-lg fa-arrow-circle-o-down"></i> <span>
                                                                    DESCUENTOS </span></a>
                                                        </li>

                                                        <li>
                                                            <a data-toggle="tab" href="#hr3"> <i
                                                                    class="fa fa-lg fa-arrow-circle-o-down"></i> <span>
                                                                    APORTES </span></a>
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content padding-10">
                                                        <div class="tab-pane fade in active" id="hr1">
                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">Remuneración
                                                                        Básica</span>

                                                                    <input type='text' id="i_rem_basica"
                                                                        class='form-control' name='i_rem_basica'
                                                                        value="{{planilladetalle.i_rem_basica}}"
                                                                        style="text-align: right;" readonly>

                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">Aguinaldo
                                                                        Julio</span>

                                                                    <input type='text' id="i_aguin_jul"
                                                                        class='form-control rb' name='i_aguin_jul'
                                                                        value="{{planilladetalle.i_aguin_jul}}"
                                                                        style="text-align: right;">

                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">Aguinaldo
                                                                        Diciembre</span>

                                                                    <input type='text' id="i_aguin_dic"
                                                                        class='form-control rb' name='i_aguin_dic'
                                                                        value="{{planilladetalle.i_aguin_dic}}"
                                                                        style="text-align: right;">

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="hr2">

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Aporte</span>

                                                                    <input type='text' id="aporte"
                                                                        class='form-control td' name='aporte' value="{{vplanillas.afp_aporte}}"
                                                                        style="text-align: right;" readonly>

                                
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Prima</span>

                                                                    <input type='text' id="prima"
                                                                        class='form-control td' name='prima' value="{{vplanillas.afp_prima}}"
                                                                        style="text-align: right;" readonly>

                            

                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Comision</span>

                                                                    <input type='text' id="comision"
                                                                        class='form-control td' name='comision' value="{{vplanillas.afp_comision}}"
                                                                        style="text-align: right;" readonly>
                                                   

                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        4ta Categoria</span>

                                                                    <input type='text' id="d_4ta_cat"
                                                                        class='form-control td' name='d_4ta_cat'
                                                                        value="{{vplanillas.cuarta_cat}}"
                                                                        style="text-align: right;" readonly>

                                                        

                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Tardanzas</span>

                                                                    <input type='text' id="d_tard"
                                                                        class='form-control ra td' name='d_tard'
                                                                        value="{{planilladetalle.d_tard}}"
                                                                        style="text-align: right;">

                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Inasistencia</span>

                                                                    <input type='text' id="d_inas"
                                                                        class='form-control ra td' name='d_inas'
                                                                        value="{{planilladetalle.d_inas}}"
                                                                        style="text-align: right;">

                                                                </div>
                                                            </div>


                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Judicial </span>

                                                                    <input type='text' id="d_judicial"
                                                                        class='form-control td' name='d_judicial'
                                                                        value="{{planilladetalle.d_judicial}}"
                                                                        style="text-align: right;">

                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="tab-pane fade" id="hr3">
                                                            <div class="form-group col-md-3"
                                                                style="margin-bottom: 7px !important;">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-addon"
                                                                        style="width:145px;text-align: left;">
                                                                        Es Salud</span>

                                                                    <input type='text' id="a_essalud"
                                                                        class='form-control' name='a_essalud'
                                                                        value="{{vplanillas.aessalud}}"
                                                                        style="text-align: right;" readonly>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table">

                                                            <tr class="hide">
                                                                <td colspan="6">
                                                                    <center>
                                                                        <button type="button" class="btn btn-info"
                                                                            id="calcula-pago"> Calcular Pago</button>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6">

                                                                    <div class="form-group col-md-3">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-addon"
                                                                                style="width:145px !important;text-align: left;">Remuneración
                                                                                Bruta</span>
                                                                            <input type='text'
                                                                                class='form-control input-xs'
                                                                                id="remuneracion-bruta"
                                                                                name='remuneracion-bruta'
                                                                                style="text-align: right;" value="{{vplanillas.rem_bruta}}" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-3">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-addon"
                                                                                style="width:145px !important;text-align: left;">Remuneración
                                                                                Asegurable</span>
                                                                            <input type='text'
                                                                                class='form-control input-xs'
                                                                                id="remuneracion-asegurable"
                                                                                name='remuneracion-asegurable'
                                                                                style="text-align: right;" readonly value="{{vplanillas.rem_aseg}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-3">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-addon"
                                                                                style="width:145px !important;text-align: left;">Total
                                                                                Descuentos </span>
                                                                            <input type='text'
                                                                                class='form-control input-xs'
                                                                                id="total-descuentos"
                                                                                name='total-descuentos'
                                                                                style="text-align: right;" readonly value="{{vplanillas.descuentos}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-3">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-addon"
                                                                                style="width:145px !important;text-align: left;">Total
                                                                                Aportes</span>
                                                                            <input type='text'
                                                                                class='form-control input-xs'
                                                                                id="total-aportes" name='total-aportes'
                                                                                style="text-align: right;" readonly value="{{vplanillas.aessalud}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-4">

                                                                    </div>

                                                                    <div class="form-group col-md-3">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-addon"
                                                                                style="width:145px !important;text-align: left;">Remuneración
                                                                                Neta (S/)</span>
                                                                            <input type='text'
                                                                                class='form-control input-xs'
                                                                                id="remuneracion-neta"
                                                                                name='remuneracion-neta' readonly=""
                                                                                style="font-weight:bold;text-align: right;"
                                                                                value="{{vplanillas.rem_neta}}">
                                                                        </div>

                                                                    </div>


                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <!-- end widget body text-->



                                                </div>
                                                <!-- end widget content -->

                                            </div>
                                            <!-- end widget div -->


                                        </div>



                                        <center>
                                            <a role="button" href="javascript:history.back()" class="btn btn-info"><i
                                                    class="fa fa-chevron-left"></i> Regresar</a>
                                        </center>
                                        <!-- end widget -->



                                    </div>



                                </div>

                            </div>
                            <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

            </div>
            <!-- 1:ONP  2:afp  3:  end widget -->
            </article>
    </div>
    </section>
</div>
</form>
</div>
</div>

<script type="text/javascript">
    var planilla = "{{ planilla_id }}";
    var personal = "{{ personal_id }}";
    var id_planilla_detalle = "{{ planilladetalle.id_planilla_detalle }}";
</script>