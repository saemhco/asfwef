<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Publicaciones</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        {% if perfil_usuario == 'ADMINISTRADOR DEL SISTEMA' or perfil_usuario == 'BOLSA DE TRABAJO'%}
            <div class="col-sm-12">
            {% else %}
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
                                <a href="{{ url('publicaciones/registro') }}"  class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                                <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                    {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                                <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-11">
                {% endif %}


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
                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                    <h2>Registro de Publicaciones</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_publicaciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>

                                                    {% if perfil_usuario == 'ADMINISTRADOR DEL SISTEMA' or perfil_usuario == 'BOLSA DE TRABAJO'%}

                                                    {% else %}
                                                        <th><center><i class="fa fa-check-circle"></i></center></th>
                                                    {% endif %}


                                            <th> Titulo</th>
                                            <th> Region</th>
                                            <th> Distrito</th>
                                            <th data-hide="phone,tablet"> Cargo</th>
                                                {# <th data-hide="tablet"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Tipo Contrato</th>
                                                 <th data-hide="tablet"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Jornada</th>
                                                 #}
                                                {#<th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Fecha Creacion</th>#} 
                                            <th data-hide="phone,tablet"> Fecha Clausura</th>
                                            <th data-hide="phone,tablet">N° Postulantes</th>
                                            <th data-hide="phone,tablet">N° Visitas</th>

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

    <script type="text/javascript" > var region_id = "";
        var provincia_id = '';
        var publica = "no";
        var distrito_id = '';</script>
    <script type="text/javascript" > var perfil = "{{ perfil }}"; var perfil_usuario = "{{ perfil_usuario }}";</script>