<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Proceso de Admision</li>
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
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>PROCESO DE ADMISIÓN - {{admision_activo.descripcion}} </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										


                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                    <center>DATOS POSTULANTE</center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>CÓDIGO:</strong></td>
                                            <td width="30%">{{ codigo_postulante }}</td>
                                            <td width="15%"><strong>NRO. DOC. </strong></td>
                                            <td width="40%">{{ postulante.nro_doc }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>APELLIDOS:</strong></td>
                                            <td width="30%">{{ postulante.apellidop }} {{ postulante.apellidom }}</td>
                                            <td width="15%"><strong>NOMBRES:</strong></td>
                                            <td width="40%">{{ postulante.nombres }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>TIPO DE COLEGIO:  </strong></td>
                                            <td width="30%">{% if postulante.colegio_publico == 1   %} PUBLICO {% elseif(postulante.colegio_publico == 0) %} PRIVADO {% endif %}</td>
                                            <td width="15%"><strong>NOMBRE DE COLEGIO:</strong></td>
                                            <td width="40%">{{ postulante.colegio_nombre }}</td>
                                        </tr>


                                    </tbody>
                                </table>

                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                    <center>DATOS ADMISIÓN</center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>

                                            <td width="15%" ><strong>MODALIDAD DE ADMISIÓN:</strong></td>
                                            <td width="30%">{{ modalidad.nombres }}</td>

                                            <td width="15%"><strong>FECHA DE INSCRIPCIÓN:</strong></td>
                                            <td width="40%">{{ utilidades.fechita(admision.fecha_inscripcion,'d/m/Y') }}</td>

                                        </tr>
                                        <tr>
                                            <td width="15%'"><strong>TIPO DE INSCRIPCIÓN: </strong></td>
                                            <td width="30%">{{ tipo.nombres }}</td>

                                            <td width="15%"><strong>NRO DE VOUCHER: </strong></td>
                                            <td width="40%">
                                                {{ admision.recibo }}<br> <a class="btn btn-success btn-sm" target="_BLANK" role="button" href="{{ url('adminpanel/imagenes/admision/'~admision.imagen) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td width="15%'"><strong>MONTO: </strong></td>
                                            <td width="30%">{{ admision.monto }}</td>

                                            <td width="15%"><strong>CONCEPTO: </strong></td>
                                            <td width="40%">{{ conceptos.descripcion }}</td>

                                        </tr>

                                        <tr>
                                            <td width="15%'"><strong>PRIMERA OPCIÓN: </strong></td>
                                            <td width="30%">{{ carrera1.descripcion }}</td>

                                            <td width="15%"><strong>SEGUNDA OPCIÓN: </strong></td>
                                            <td width="40%">{{ carrera2.descripcion }}</td>


                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table-primary table-bordered table" >
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                    <center> 

                                        {% if id is defined %}
                                            <a role="button" href="{{ url('reportes/reporteadmisionregistro/'~id) }}" target="_BLANK" class="btn btn-primary  btn-md"><i class="fa fa-download"></i>  FICHA REGISTRO ADMISIÓN </a>
                                        {% else %}
                                             <a role="button" href="{{ url('reportes/reporteadmisionregistro') }}" target="_BLANK" class="btn btn-primary  btn-md"><i class="fa fa-download"></i>  FICHA REGISTRO ADMISIÓN </a>
                                        {% endif %}

                                       
                                    </center>
                                    </th>
                                    </tr>
                                    </thead>
                                </table>


                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>	

    </div>	
</div>


