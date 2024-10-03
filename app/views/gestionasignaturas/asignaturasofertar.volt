
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Ofertar Asignaturas</li>
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
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>Ofertadas Asignaturas - Semestre {{ semestre.descripcion }}  </strong></h2>	



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


                                    <form class="smart-form" id="form_asignaturasofertar" method="POST">

                                        <div class="row" >

                                            <div class="col-md-12">
                                                <!-- widget content -->
                                                <div class="widget-body" style="padding: 20px !important ;">
                                                    <input type="hidden" name="semestre" value="{{ semestre.codigo }}">
                                                    <ul id="myTab1" class="nav nav-tabs bordered">
                                                        <li class="active">
                                                            <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Asignaturas <span class="badge bg-color-blue txt-color-white">{{ totalcursos }}</span></a>
                                                        </li>

                                                        <li>
                                                            <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-book"></i>Asignaturas para Ofertar</a>
                                                        </li>
                                                    </ul>

                                                    <div id="myTabContent1" class="tab-content">
                                                        <div class="tab-pane fade in active" id="s1">
                                                            <div class="table-responsive">
                                                                <table class="table-primary table-bordered table" style="font-size: 11px !important;" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Codigo</th>
                                                                            <th>Asignatura</th>
                                                                            <th>Ciclo</th>
                                                                            <th>Creditos</th>
                                                                            <th>tipo</th>
                                                                            <th>Hs.T</th>
                                                                            <th>Hs.P</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {% for curso in cursosdispo %}
                                                                            <tr>
                                                                                <td ><label style="" class="checkbox">
                                                                                        <input 
                                                                                            class="checkcurso"
                                                                                            style="height: 9px !important; width: 9px !important;"
                                                                                            value="{{ curso.asignatura }}"
                                                                                            type="checkbox" name="checkbox-inline" >
                                                                                        <i style="" ></i><p style="font-size: 11px !important;">{{ curso.asignatura }}</p></label></td>
                                                                                <td id="nombre-{{ curso.asignatura }}">{{ curso.nombre }}</td>
                                                                                <td id="ciclo-{{ curso.asignatura }}">{{ curso.ciclo }}</td>
                                                                                <td id="creditos-{{ curso.asignatura }}">{{ curso.creditos }}</td>
                                                                                <td id="tipo-{{ curso.asignatura }}">{{ curso.tipo }}</td>
                                                                                <td id="ht-{{ curso.asignatura }}">{{ curso.ht }}</td>
                                                                                <td id="hp-{{ curso.asignatura }}">{{ curso.hp }}</td>

                                                                            <tr>
                                                                            {% endfor %}
                                                                    </tbody>    
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane" id="s2">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="12">
                                                                    <center>ASIGNATURAS</center>
                                                                    </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Codigo</th>
                                                                        <th>Asignatura</th>
                                                                        <th>Ciclo</th>
                                                                        <th>Creditos</th>
                                                                        <th>tipo</th>
                                                                        <th>Hs.T</th>
                                                                        <th>Hs.P</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="cursos-llevar">

                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                            <div class="table-responsive"> 
                                                                <table class="table table-primary table-bordered" >
                                                                    <tr>
                                                                        <td>Total Asignaturas: <label id="totalasig">0</label></td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                            <footer>
                                                                <button id="registrar-asignatura-btn" type="button" class="btn btn-primary">
                                                                    Registrar
                                                                </button>
                                                                <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                                                    Volver
                                                                </a>

                                                            </footer>


                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- end widget content -->

                                            </div>

                                        </div>

                                    </form>


                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<div class="hidden">
    <div id="save_asignaturasofertar">
        <p>
            Se registró correctamente ...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_vacio">
        <p>
            Debe seleccionar al menos una asignatura...
        </p>
    </div>
</div>
<script>

    var cicloorden = [];
    {% for curso in cursosdispo %}
        cicloorden.push({{ curso.ciclo }});
    {% endfor %}
        console.log(cicloorden);
</script>