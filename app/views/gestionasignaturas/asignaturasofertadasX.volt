<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Asignaturas Ofertadas</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                data-widget-custombutton="false" data-widget-sortable="false">
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body text-center">

                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="update();"
                            class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Actualizar Docentes"><i class="fa fa-refresh"></i></a>

                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="detalle();"
                            class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Actualizar Detalle"><i class="fa fa-list"></i></a>

                        <a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="horario();"
                            class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
                            data-original-title="Horarios"><i class="fa fa-list-alt"></i></a>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de asignaturas ofertadas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>

                                <div class="widget-body no-padding">
                                    
                                    <div class="widget-body-toolbar">
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <select class="form-control" id="input-semestre_select">
                                                    <option value="0">--SELECCIONE SEMESTE--</option>
                                                    {% for semestre_model in semestres %}

                                                    {% if semestre_model.codigo == semestre_m.codigo %}
                                                    <option value="{{ semestre_model.codigo }}" selected>{{ semestre_model.descripcion }}</option>
                                                    {% else %}
                                                    <option value="{{ semestre_model.codigo }}">{{ semestre_model.descripcion }}</option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select>
                                            </div>


                                        </div>
                                    </div>


                                    <table id="tbl_asignaturasofertadas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">CÓDIGO</th>
                                                <th>ASIGNATURA</th>
                                                <th data-hide="phone,tablet">CICLO</th>
                                                <th data-hide="phone,tablet">CRED.</th>
                                                <th data-hide="phone,tablet">TIPO</th>
                                                <th data-hide="phone,tablet">GRUPOS</th>
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
    <div id="save_asignaturasofertadas">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_agregar_grupos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">GESTIONAR GRUPOS</h4>
            </div>
            <div class="modal-body">
                {{ form('gestionasignaturas/saveGrupos','method': 'post','id':'form_grupos') }}

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-sm table-primary table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">
                                        <center>CÓDIGO</center>
                                    </th>
                                    <th>
                                        <center>ASIGNATURA</center>
                                    </th>
                                    <th width="8%">
                                        <center>CICLO</center>
                                    </th>
                                    <th width="10%">
                                        <center>CREDITOS</center>
                                    </th>
                                    <th width="8%">
                                        <center>TIPO</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: middle;text-align: center;"><strong id="codigo"></strong>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;"><strong
                                            id="asignatura"></strong></td>
                                    <td style="vertical-align: middle;text-align: center;"><strong id="ciclo"></strong>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;"><strong
                                            id="creditos"></strong></td>
                                    <td style="vertical-align: middle;text-align: center;"><strong id="tipo"></strong>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-sm table-primary table-bordered" id="t_grupos">
                            <thead>
                                <tr>
                                    <th width="15%" style="vertical-align: middle;text-align: center;">GRUPO</th>
                                    <th style="vertical-align: middle;text-align: center;">DOCENTE</th>
                                    <th width="8%" style="vertical-align: middle;text-align: center;">NRO ALUMNOS</th>
                                    <th width="25%" style="vertical-align: middle;text-align: center;">OBSERVACION</th>

                                    <th width="10%" style="vertical-align: middle;text-align: center;">ACTIVO</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_grupos">
                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" id="grupo_1"></td>
                                    <td style="vertical-align: middle;text-align: center;">

                                        <select class="form-control input-sm" id="select_docente_1"
                                            name="select_docente[]">

                                            {% for docentes_model in docentes %}
                                            <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }}
                                                {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>
                                            {% endfor %}
                                        </select>

                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="nro_alumnos_1"
                                            name="nro_alumnos[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="observacion_1"
                                            name="observacion[]">
                                    </td>

                                    <td style="vertical-align: middle;text-align: center;">

                                        <label id="checkbox_1" style="pointer-events: none;">
                                            <input type="checkbox" class="checkbox style-0" id="estado_1"
                                                name="estado[]" checked>
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" id="grupo_2"></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <select class="form-control input-sm" id="select_docente_2"
                                            name="select_docente[]">

                                            {% for docentes_model in docentes %}
                                            <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }}
                                                {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>
                                            {% endfor %}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="nro_alumnos_2"
                                            name="nro_alumnos[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="observacion_2"
                                            name="observacion[]">
                                    </td>

                                    <td style="vertical-align: middle;text-align: center;">
                                        <label id="checkbox_2">
                                            <input type="checkbox" class="checkbox style-0" id="estado_2"
                                                name="estado[]">
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" id="grupo_3"></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <select class="form-control input-sm" id="select_docente_3"
                                            name="select_docente[]">

                                            {% for docentes_model in docentes %}
                                            <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }}
                                                {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>
                                            {% endfor %}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="nro_alumnos_3"
                                            name="nro_alumnos[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="observacion_3"
                                            name="observacion[]">
                                    </td>

                                    <td style="vertical-align: middle;text-align: center;">
                                        <label id="checkbox_3">
                                            <input type="checkbox" class="checkbox style-0" id="estado_3"
                                                name="estado[]">
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" id="grupo_4"></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <select class="form-control input-sm" id="select_docente_4"
                                            name="select_docente[]">

                                            {% for docentes_model in docentes %}
                                            <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }}
                                                {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>
                                            {% endfor %}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="nro_alumnos_4"
                                            name="nro_alumnos[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="observacion_4"
                                            name="observacion[]">
                                    </td>

                                    <td style="vertical-align: middle;text-align: center;">
                                        <label id="checkbox_4">
                                            <input type="checkbox" class="checkbox style-0" id="estado_4"
                                                name="estado[]">
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" id="grupo_5"></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <select class="form-control input-sm" id="select_docente_5"
                                            name="select_docente[]">

                                            {% for docentes_model in docentes %}
                                            <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }}
                                                {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>
                                            {% endfor %}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="nro_alumnos_5"
                                            name="nro_alumnos[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="observacion_5"
                                            name="observacion[]">
                                    </td>

                                    <td style="vertical-align: middle;text-align: center;">
                                        <label id="checkbox_5">
                                            <input type="checkbox" class="checkbox style-0" id="estado_5"
                                                name="estado[]">
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" id="grupo_6"></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <select class="form-control input-sm" id="select_docente_6"
                                            name="select_docente[]">

                                            {% for docentes_model in docentes %}
                                            <option value="{{ docentes_model.codigo }}">{{ docentes_model.apellidop }}
                                                {{ docentes_model.apellidom }} {{ docentes_model.nombres }}</option>
                                            {% endfor %}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="nro_alumnos_6"
                                            name="nro_alumnos[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="" id="observacion_6"
                                            name="observacion[]">
                                    </td>

                                    <td style="vertical-align: middle;text-align: center;">
                                        <label id="checkbox_6">
                                            <input type="checkbox" class="checkbox style-0" id="estado_6"
                                                name="estado[]">
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                            <input type="hidden" class="" name="key_semestre" value="" id="key_semestre">
                            <input type="hidden" class="" name="key_asignatura" value="" id="key_asignatura">
                        </table>
                    </div>
                </div>
                {{ endForm() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="registrar_grupos">
                    Aceptar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    //var region_id = "";
    //var provincia_id = '';
    var publica = "no";
    //var distrito_id = '';
</script>
<script type="text/javascript">     var perfil = "{{ perfil }}";
</script>