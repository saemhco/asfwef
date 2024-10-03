<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimiento de Estudiantes</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center>
                        <span class="widget-icon"> <i class="fa fa-hand-o-up"></i> </span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center">

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-primary btn-block"><i class="fa fa-check-circle-o"></i></a>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11">
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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Estudiantes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_alumnos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             


                                        <th data-class="expand">Código</th>  
                                        <th>Programa de Estudios</th>  
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th data-hide="phone,tablet">Nombres</th> 
                                        <th data-hide="phone,tablet">N° de Documento</th>
                                        <th data-hide="phone,tablet">Celular</th>
                                        <th data-hide="phone,tablet">Dirección</th> 
                                        <th data-hide="phone,tablet">Convalidacion</th>



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
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible...
        </p>
    </div>
</div>
<script type="text/javascript" >
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
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

