<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimiento de Docentes</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center">
                        <a href="javascript:void(0);"  onclick="informacion_semestral();" class="btn btn-primary btn-block" rel="tooltip" data-placement="top" data-original-title="Información Semestral"><i class="fa fa-list"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11" style="margin-bottom: -30px;">
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
                                <h2>Registro de Docentes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										
                                    <table class="table">
                                        <tr>
                                            <td>
                                        <center>
                                            <select class="form-control" id="semestre" >
                                                <option value="">--SELECCIONE SEMESTE-- </option>
                                                {% if sem is defined %}
                                                    {% for s in semestres %}
                                                        {% if s.codigo == sem %}
                                                            <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                        {% else %}
                                                            <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                        {% endif %}
                                                    {% endfor %}
                                                {% else %}
                                                    {% for s in semestres %}
                                                        {% if s.codigo == semestrea %}
                                                            <option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
                                                        {% else %}
                                                            <option value="{{ s.codigo }}">{{ s.descripcion }}</option>
                                                        {% endif %}
                                                    {% endfor %}
                                                {% endif %}
                                            </select>
                                        </center>
                                        </td>
                                        </tr>
                                    </table>
                                    <table id="tbl_docentes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             
                                        <th data-class="expand">CÓDIGO</th>                                                               
                                        <th>APELLIDO PATERNO</th>
                                        <th>APELLIDO MATERNO</th>
                                        <th data-hide="phone,tablet">NOMBRES</th>
                                        <th data-hide="phone,tablet">DOCUMENTO</th>
                                        <th data-hide="phone,tablet">CELULAR</th>
                                        <th data-hide="phone,tablet">TITULO</th>
                                        <th data-hide="phone,tablet">ESTADO</th>

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

<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
//var distrito_id = '';

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

