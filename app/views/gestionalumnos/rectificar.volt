<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Rectificar Matricula</li>
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Rectificar Matricula  </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">

                                    <fieldset>
                                        <div class="row">
                                            <div class="col col-md-12" >  
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4">
                                                        <center>DATOS DEL ALUMNO</center>
                                                        </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr style="font-size: 12px !important;" >
                                                                <td>Código:<strong> {{ alumno.codigo }}</strong></td>
                                                                <td>Apellidos: {{ alumno.apellidop~' '~alumno.apellidom }}</td>
                                                                <td>Nombres: {{ alumno.nombres }}</td>
                                                                <td>Ciclo: <strong>{{ ciclo }}</strong> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div> 
                                        </div>
                                    </fieldset>
                                    {{ form('gestionalumnos/saveFicha','method': 'post','id':'form_ficha','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>                                            
                                        <div class="row">
                                            <section class="col col-md-12">
                                                <label class="text-info" >ASIGNATURAS DISPONIBLES
                                                </label>
                                                <label class="select">
                                                    <select id="input_cursos_disponibles">
                                                        <option value="0" >--SELECCIONE--</option>
                                                        {% for c_d in cursos_disponibles %}                                                      
                                                            <option semestre="{{ c_d.semestre }}" value="{{ c_d.asignatura }}" ciclo="{{ c_d.ciclo }}" asignatura_nombre="{{ c_d.nombre }}" creditos="{{ c_d.creditos }}" grupo="{{ c_d.grupo }}" veces="{{ c_d.veces }}" alumno="{{ c_d.alumno }}" >CODIGO: {{ c_d.asignatura }}- ASIGNATURA: {{ utilidades.partedescripcion(c_d.nombre,0,60)}}  - CICLO: {{ c_d.ciclo }} - CREDITOS: {{ c_d.creditos }} - TIPO: {{ c_d.tipo_asignatura }} - GRUPO: {{ c_d.grupo }} - DOCENTE: {{ c_d.docentename }}</option>                                                   
                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-2">
                                                <button type="button" class="btn btn-sm  btn-block btn-primary" id="agregar_asignatura">
                                                    <i class="fa fa-plus"></i> Agregar
                                                </button>
                                            </section>

                                            <section class="col col-10">
                                                <label class="text-danger" id="error_insert_asignaturas"></label>
                                            </section>

                                        </div>

                                    </fieldset>


                                    <div class="table-responsive">
                                        <table class="table table-sm table-primary table-bordered" id="table_asignaturas">
                                            <thead>
                                                <tr>
                                                    <th width="15%" style="vertical-align: middle;text-align: center;">CÓDIGO</th>
                                                    <th style="vertical-align: middle;text-align: center;" width="8%">CICLO</th>
                                                    <th style="vertical-align: middle;text-align: center;">ASIGNATURA</th>
                                                    <th style="vertical-align: middle;text-align: center;" width="10%">CREDITOS</th>
                                                    <th style="vertical-align: middle;text-align: center;" width="23%">TIPO</th>
                                                    <th style="vertical-align: middle;text-align: center;" width="8%">GRUPO</th>
                                                    <th style="vertical-align: middle;text-align: center;" width="8%">VECES</th>
                                                    <th style="vertical-align: middle;text-align: center;" width="8%">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_lista_asignaturas">
                                                {% for a_a in alumnos_asignaturas %}
                                                    <tr id="{{a_a.semestre}}-{{a_a.asignatura}}-{{a_a.grupo}}-{{a_a.alumno}}">
                                                        <td style="vertical-align: middle;text-align: center;">
                                                            <input type='hidden' name='asignaturas[]' value="{{a_a.asignatura}}">
                                                            {{ a_a.asignatura }}
                                                        </td>
                                                        <td style="vertical-align: middle;text-align: center;">{{ a_a.ciclo }}</td>
                                                        <td style="vertical-align: middle;text-align: center;">{{ a_a.nombre }}</td>
                                                        <td style="vertical-align: middle;text-align: center;">{{ a_a.creditos }}</td>
                                                        <td style="vertical-align: middle;text-align: center;">                           
                                                            <label class="select">
                                                                <select name="tipo_asignatura[]">
                                                                    {% for t_a in tipo_asignaturas %}
                                                                        {% if t_a.codigo == a_a.tipo %}
                                                                            <option selected="selected" value="{{ t_a.codigo }}">{{ t_a.nombres }}</option>   
                                                                        {% else %}
                                                                            <option value="{{ t_a.codigo }}">{{ t_a.nombres }}</option>   
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                </select> <i></i>
                                                            </label>
                                                        </td>
                                                        <td style="vertical-align: middle;text-align: center;">
                                                            <input type='hidden' name='grupos[]' value="{{ a_a.grupo }}">
                                                            {{ a_a.grupo }}
                                                        </td>
                                                        <td style="vertical-align: middle;text-align: center;">

                                                            <label class="input">
                                                                <input type='number' name='veces[]' value="{{ a_a.veces }}" id="input_veces" min="1" max="5">
                                                            </label>

                                                        </td>
                                                        <td style="vertical-align: middle;text-align: center;">
                                                            {% if a_a.cerrado == 2 %}
                                                                <button type="button" onclick="eliminar_asignatura({{a_a.semestre}}, '{{a_a.asignatura}}',{{a_a.grupo}} , '{{a_a.alumno}}');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                                {% endif %}
                                                        </td>
                                                    </tr>
                                                {% endfor %}
                                            </tbody>
                                            <input type="hidden" class="" name="key_semestre" value="{{ semestre }}" id="key_semestre">
                                            <input type="hidden" class="" name="key_alumno" value="{{ alumno.codigo }}" id="key_alumno">
                                        </table>
                                    </div>


                                    <footer>
                                        <button id="btn_update_ficha" type="button" class="btn btn-primary">
                                            Guardar
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>
                                    </footer>
                                    {{ endForm() }}
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

    var semestreax = "{{ semestre }}";
    var array_test = {{ tipo_asignaturas | json_encode }};
    console.log(array_test);
</script>