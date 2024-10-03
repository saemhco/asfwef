<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Estado de Cuenta</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-md-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false"
                            data-widget-editbutton="false" data-widget-togglebutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false">

                            <header>
                                <h2><strong>ESTADO DE CUENTA --- PROGRAMA: {{ carrera.descripcion }} </strong></h2>



                            </header>
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <div class="row" style="margin-bottom: -20px;">
                                        <div class="col col-md-12">

                                            <table class="table table-sm table-primary table-bordered"
                                                style="font-size: 10px !important;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="8">
                                                            <center>DATOS DEL ALUMNO</center>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="font-size: 12px !important;">
                                                        <td>Código:<strong> {{ alumno.codigo }}</strong></td>
                                                        <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                                        <td>Nombres: {{ alumno.nombres }}</td>
                                                        <td>Ciclo: <strong>{{ ciclo }}</strong><input type="hidden"
                                                                name="semestre" value="{{ semestre.codigo }}"> </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="widget-body-toolbar" >
                                        <div class="row" style="margin-bottom: 10px;">
                                            
                                            <div class="col-sm-4">
                                                <select class="form-control" id="semestre_select">
                                                    <option value="0">SELECCIONE SEMESTRE</option>
                                                    {% for semestre_select in semestres %}
                                                    {% if semestre_select.codigo == semestre_activo %}
                                                    <option value="{{ semestre_select.codigo }}" selected>{{ semestre_select.descripcion }}</option>
                                                    {% else %}
                                                    <option value="{{ semestre_select.codigo }}">{{ semestre_select.descripcion }}</option>
                                                    {% endif %}
                                                    {% endfor %}
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="tbl_gestionestadodecuenta"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Concepto</th>
                                                <th data-hide="">Emisión</th>
                                                <th data-hide="phone,tablet">Pago</th>
                                                <th data-hide="phone,tablet">Cuota</th>
                                                <th data-hide="phone,tablet">Cant.</th>
                                                <th data-hide="phone,tablet">PU</th>
                                                <th data-hide="phone,tablet">Total</th>
                                                <th data-hide="phone,tablet">Proceso</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- Widget ID (each widget will need unique ID)-->

                        <!-- end widget -->
                    </article>
                </div>
            </section>
        </div>



    </div>
</div>