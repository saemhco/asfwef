<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Asignaturas por grupos</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-12" style="margin-bottom: -30px;">
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
                                <span class="widget-icon"> <i class="fa fa-user-plus"></i> </span>
                                <h2>Datos del Grupo </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										

                                <div class="table-responsive">
                                    <table class="table table-sm table-primary table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="15%">
                                        <center>CÓDIGO</center>
                                        </th>
                                        <th><center>ASIGNATURA</center></th>
                                        <th width="8%"><center>CICLO</center></th>
                                        <th width="10%"><center>CREDITOS</center></th>
                                        <th width="8%"><center>TIPO</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="codigo">{{ codigo }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="asignatura">{{ asignatura }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="ciclo">{{ ciclo }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="creditos">{{ creditos }}</strong></td>
                                                <td style="vertical-align: middle;text-align: center;"><strong id="tipo">{{ tipo_asignatura }}</strong></td>

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
                        <a href="javascript:void(0);" onclick="nuevo();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        <a href="javascript:void(0);" onclick="agregar_carrera();" class="btn btn-success btn-block"><i class="fa fa-graduation-cap"></i></a>
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Lista de Asignaturas por grupos</h2>
                            </header>

                            <div>
                                <br>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12" >
                                                <table id="tbl_asignaturasofertadas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>			                
                                                        <tr>
                                                            <th><center><i class="fa fa-check-circle"></i></center></th>                                             

                                                    <th data-class="expand">GRUPO</th>
                                                    <th>SUBGRUPO</th>
                                                    <th data-hide="phone,tablet">ACTIVIDAD</th>
                                                    <th data-hide="phone,tablet">MODALIDAD</th>
                                                    <th data-hide="phone,tablet">DOCENTE</th>
                                                    <th data-hide="phone,tablet">NRO ALUMNOS</th>
                                                    <th data-hide="phone,tablet">OBSERVACION</th>
                                                    <th data-hide="phone,tablet">HORARIO</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>				
                                                    </tbody>
                                                </table>
                                            </section>

                                        </div>
                                    </fieldset>

                                    <footer>
                                        <a href="{{ url('gestionasignaturas/asignaturasofertadas') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>
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
    <div id="save_asignaturasofertadas">
        <p>
            Se actualizó correctamente...
        </p>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_agregar_horario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">GESTIONAR HORARIOS</h4>
            </div>
            <div class="modal-body">
                {#{{ form('asignaturasofertadas/savegestionhorarios','method': 'post','id':'form_horarios') }}#}

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-sm table-primary table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%" style="vertical-align: middle;text-align: center;">CÓDIGO</th>
                                    <th style="vertical-align: middle;text-align: center;">ASIGNATURA</th>
                                    <th style="vertical-align: middle;text-align: center;">GRUPO</th>
                                    <th style="vertical-align: middle;text-align: center;">SUB GRUPO</th>
                           

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: middle;text-align: center;"><strong id="m_codigo"></strong></td>

                                    <td style="vertical-align: middle;text-align: center;"><strong id="m_asignatura">{{ asignatura }}</strong></td>
                                    <td style="vertical-align: middle;text-align: center;"><strong id="m_grupo"></strong></td>
                                    <td style="vertical-align: middle;text-align: center;"><strong id="m_subgrupo"></strong></td>
                                   
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <fieldset>
                        <legend>Elección del horario</legend>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category"> Ambiente</label>
                                <select class="form-control" id="input-ambiente" name="ambiente">
                                    <option value="0">SELECCIONE...</option>
                                    {% for ambientes_model in ambientes %}
                                        <option value="{{ ambientes_model.codigo }}"  ambiente="{{ ambientes_model.descripcion }}">{{ ambientes_model.descripcion }}</option>   
                                    {% endfor %}
                                </select>
                                <input type="hidden" class="" name="semestre" value="{{ semestre }}" id="post_semestre">
                                <input type="hidden" class="" name="asignatura" value="" id="post_asignatura">
                                <input type="hidden" class="" name="grupo" value="" id="post_grupo">
                                <input type="hidden" class="" name="subgrupo" value="" id="post_subgrupo">
                                <input type="hidden" class="" name="docente" value="" id="post_docente">                             
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category"> Dia</label>
                                <select class="form-control" id="input-dia" name="dia">
                                    <option value="0">SELECCIONE...</option>
                                    {% for dias_model in dias %}
                                        <option value="{{ dias_model.codigo }}" dia="{{ dias_model.nombres }}">{{ dias_model.nombres }}</option>   
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category"> Hora</label>
                                <select class="form-control" id="input-hora" name="hora">
                                    <option value="0">SELECCIONE...</option>
                                    {% for horas_model in horas %}
                                        <option value="{{ horas_model.codigo }}" hora="{{ horas_model.descripcion }}">{{ horas_model.descripcion }}</option>   
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="agregar_horario">
                                    <span class="glyphicon glyphicon-plus-sign"></span> Agregar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group" id="error_insert">
                            </div>
                        </div>

                        <div class="col-md-12" >

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align: center;">AMBIENTE</th>
                                            <th style="vertical-align: middle;text-align: center;">DIA</th>
                                            <th style="vertical-align: middle;text-align: center;">HORA</th>
                                            <th style="vertical-align: middle;text-align: center;">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_horarios">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </fieldset>
                </div>

                {#{{ endForm() }}#}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                {#<button type="button" class="btn btn-primary" id="registrar_horario">
                    Aceptar
                </button>#}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{ form('Gestionasignaturas/saveRegistro','method': 'post','id':'form_registro','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-primary table-bordered">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;text-align: center;">CODIGO</th>
                            <th style="vertical-align: middle;text-align: center;">ASIGNATURA</th>
                            <th style="vertical-align: middle;text-align: center;">GRUPO</th>
                            <th style="vertical-align: middle;text-align: center;">SUB-GRUPO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;text-align: center;">
                                <strong id="modal_codigo"></strong>
                                <input type="hidden" class="" name="modal_post_semestre" value="{{ semestre }}" id="modal_post_semestre">   
                                <input type="hidden" class="" name="modal_post_asignatura" value="" id="modal_post_asignatura">  
                                <input type="hidden" class="" name="modal_post_grupo" value="" id="modal_post_grupo">  
                                <input type="hidden" class="" name="modal_post_subgrupo" value="" id="modal_post_subgrupo">  
                                <input type="hidden" class="" name="modal_post_parametro" value="" id="modal_post_parametro">
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <strong id="modal_asignatura">{{ asignatura }}</strong>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <strong id="modal_grupo"></strong>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <strong id="modal_subgrupo"></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Docente</label>
            <label class="select">
                <select id="input_docente"  name="docente" style="pointer-events: none;">
                    <option value="" >SELECCIONE...</option>
                    {% for docentes_model in docentes %}                                       
                        <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }} {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>                                       
                    {% endfor %}                                      
                </select> <i></i> 
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info" >Actividad</label>
            <label class="select">
                <select id="input_actividad"  name="actividad">
                    <option value="" >SELECCIONE...</option>
                    {% for actividad_model in actividad %}                                       
                        <option value="{{ actividad_model.codigo }}">{{ actividad_model.nombres }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info" >Modalidad</label>
            <label class="select">
                <select id="input_modalidad"  name="modalidad">
                    <option value="" >SELECCIONE...</option>
                    {% for modalidad_model in modalidades %}                                       
                        <option value="{{ modalidad_model.codigo }}">{{ modalidad_model.nombres }}</option>                                       
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info" >Cupo de Alumnos</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input_subnro" name="subnro" placeholder="" >

            </label>
        </section>
        {#        <section class="col col-md-4">
                    <label class="text-info">Estado</label>
                    <label class="checkbox" style="pointer-events: none;">
                        <input type="checkbox" name="estado" id="input_estado">
                        <i></i>Activar / Desactivar</label>
                </section>#}
    </div>

    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Observacion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input_observacion" name="observacion" ></textarea>          
            </label>
        </section>
    </div>


</fieldset>
{{ endForm() }}

<!-- Modal Registro de Carerras -->
<div class="modal fade" id="modal_agregar_carreras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">GESTIONAR HORARIOS</h4>
            </div>
            <div class="modal-body">
                {#{{ form('asignaturasofertadas/savegestionhorarios','method': 'post','id':'form_horarios') }}#}

                <div class="row">
                    <div class="table-responsive">

                        <table class="table table-sm table-primary table-bordered">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;text-align: center;">CODIGO</th>
                                    <th style="vertical-align: middle;text-align: center;">ASIGNATURA</th>
                                    <th style="vertical-align: middle;text-align: center;">GRUPO</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <strong id="modal_a_s_c_codigo"></strong>
                                        <input type="hidden" class="" name="modal_a_s_c_semestre" value="{{ semestre }}" id="modal_a_s_c_semestre">   
                                        <input type="hidden" class="" name="modal_a_s_c_asignatura" value="" id="modal_a_s_c_asignatura">  
                                        <input type="hidden" class="" name="modal_a_s_c_grupo" value="" id="modal_a_s_c_grupo">  


                                    </td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <strong id="modal_asignatura">{{ asignatura }}</strong>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <strong id="modal_a_s_c_text_grupo"></strong>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row">
                    <fieldset>
                        <legend>Elección del Carrera</legend>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category"> Carreras</label>
                                <select class="form-control" id="input_carreras" name="carrera">
                                    <option value="0">SELECCIONE...</option>
                                    {% for carrera_model in carreras %}                                       
                                        <option value="{{ carrera_model.codigo }}" carrera="{{ carrera_model.descripcion }}">{{ carrera_model.descripcion }}</option>                                       
                                    {% endfor %}
                                </select>
                                <input type="hidden" class="" name="modal_a_s_c_semestre" value="{{ semestre }}" id="modal_a_s_c_semestre">   
                                <input type="hidden" class="" name="modal_a_s_c_asignatura" value="" id="modal_a_s_c_asignatura">  
                                <input type="hidden" class="" name="modal_a_s_c_grupo" value="" id="modal_a_s_c_grupo">                                
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="agregar_carreras">
                                    <span class="glyphicon glyphicon-plus-sign"></span> Agregar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group" id="error_insert_carrera">
                            </div>
                        </div>

                        <div class="col-md-12" >

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align: center;">CARRERAS</th>

                                            <th style="vertical-align: middle;text-align: center;">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_carreras">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </fieldset>
                </div>

                {#{{ endForm() }}#}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                {#<button type="button" class="btn btn-primary" id="registrar_horario">
                    Aceptar
                </button>#}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" >
    //var region_id = "";
    //var provincia_id = '';
    var publica = "no";
    //var distrito_id = '';
</script>
<script type="text/javascript" >
    var perfil = "{{ perfil }}";
    var codigo = "{{ codigo }}";
    var semestre = "{{ semestre }}";
</script>

