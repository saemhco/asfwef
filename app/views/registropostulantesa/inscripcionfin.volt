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
                                            <td width="15%"><strong>NRO DE VOUCHER: </strong></td>
                                            <td width="40%">
                                                {{ admision.recibo }}<br> <a class="btn btn-success btn-sm" target="_BLANK" role="button" href="{{ url('adminpanel/imagenes/admision/'~admision.imagen) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>




                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>	

    </div>	
</div>


