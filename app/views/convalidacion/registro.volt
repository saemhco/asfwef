<style>
    .form-control{ 
        width: 455px !important;
    }
</style>
{% set texto_ciclo = "ALUMNO" %}
{% if ciclo == "" %}
    {% set texto_ciclo = "EGRESADO" %}
    {% set ciclo = "E" %}
{% endif %}
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Convalidación</li>
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
                                <h2>REGISTRO DE CONVALIDACIONES - CARRERA PROFESIONAL: {{ carrera.descripcion }}  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										

                                
                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                    <center>DATOS DEL {{ texto_ciclo }}</center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Código:<strong> {{ alumno.codigo }}</strong></td>
                                            <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                            <td>Nombres: {{ alumno.nombres }}</td>
                                            <td>Ciclo: <strong>{{ ciclo }}</strong> </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>	

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
                        <a href="javascript:void(0);"  onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro de asignaturas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_notas_convalidacion" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>
                                        <th data-class="expand">Semestre</th>
                                        <th>Asignatura</th>
                                        <th>Nombre Asignatura</th>
                                        <th data-hide="phone,tablet">Ciclo</th>
                                        <th data-hide="phone,tablet">Tipo</th>
                                        <th data-hide="phone,tablet">veces</th>
                                        <th data-hide="phone,tablet">Pf</th>
                                        <th data-hide="phone,tablet">Observacion</th>
                                        <th data-hide="phone,tablet">Estado</th>


                                        </tr>
                                        </thead>
                                        <tbody>			
                                        </tbody>
                                    </table>
                                    <table class="table-primary table-bordered table" style="font-size: 10px !important;" >

                                        <tbody>

                                            <tr>
                                                <td>
                                        <center> <a role="button" href="javascript:history.back()" class="btn btn-primary  btn-md"><i class="fa fa-arrow-left"></i>  Volver </a></center>
                                        </td>
                                        </tr>
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

<!--Formulario de registro de padres-->
{{ form('convalidacion/save_notas_convalidacion','method': 'post','id':'form_notas_convalidacion','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">



        <section class="col col-md-10">

            <label class="text-info" >Asignatura
            </label>
            <label class="select">
                <select id="input-asignatura"  name="asignatura" >
                    <option value="0" >CODIGO - ASIGNATURA - CICLO </option>
                    {% for asignatura_model in asignaturas %}


                        <option value="{{ asignatura_model.codigo }}">{{ asignatura_model.codigo }} - {{ asignatura_model.nombre }} - CICLO: {{ asignatura_model.ciclo }} </option>

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-2">
            <label class="text-info" >PF. </label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-pf" name="pf" placeholder="pf" value="" style="text-align:right;">

            </label>
        </section>

        <section class="col col-md-10">
            <label class="text-info" >Observacion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                <textarea rows="3" id="input-observacion" name="observacion" placeholder=""></textarea>

                <input type="hidden" id="input-semestre" name="semestre" value="{{ semestre.codigo }}">
                <input type="hidden" id="input-alumno" name="alumno" value="{{ alumno.codigo }}">

                <input type="hidden" id="input-veces" name="veces" value="1">
                <input type="hidden" id="input-tipo" name="tipo" value="9">

            </label>
        </section>


        <section class="col col-md-2" style="margin-top: 20px;">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="estado" value="" id="input-estado">
                <i></i>Estado
            </label>
        </section>





    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="error_tipo">

        <p>
            Solo se permite editar convalidaciones...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_asignatura_registrada">
        <p>
            Asignatura registrada, no se puede convalidar...
        </p>
    </div>
</div>

<script type="text/javascript" >
    var id = "";

    {% if id is defined %}
        id = {{ id }};
    {% endif %}



        //alert("Hola");
</script>