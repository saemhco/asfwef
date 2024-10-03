<style>

</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar usuarios</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false"
                data-widget-sortable="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                    <h2>Consulta de Recursos TIC</h2>
                </header>

                <div>
                    <div class="jarviswidget-editbox">
                        <input class="form-control" type="text">
                    </div>
                    <div class="widget-body no-padding">

                        <table id="tbl_recursostic"
                            class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>

                                    <th data-class="expand">Tipo</th>
                                    <th data-hide="phone,tablet">Usuario</th>
                                    <th data-hide="phone,tablet">Equipo</th>
                                    <th data-hide="phone,tablet">Marca</th>
                                    <th data-hide="phone,tablet">Modelo</th>
                                    <th data-hide="phone,tablet">Serie</th>
                                    <th data-hide="phone,tablet">Color</th>
                                    <th data-hide="phone,tablet">Teamviewer</th>
                                    <th data-hide="phone,tablet">Anydesk</th>
                                    <th data-hide="phone,tablet">IP</th>
                                    <th data-hide="phone,tablet">Estado</th>

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

    <div class="row">
        <div class="col-sm-1">
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
                        <a href="javascript:void(0);" onclick="agregar_computadoras();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar_computadoras();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar_computadoras();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Computadoras - Laptops - Servidores</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_computadoras"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Patrimonial</th>
                                                <th data-hide="phone,tablet"> Marca</th>
                                                <th data-hide="phone,tablet"> Modelo</th>
                                                <th data-hide="phone,tablet"> Serie</th>
                                                <th data-hide="phone,tablet"> Color</th>
                                                <th data-hide="phone,tablet"> Estado</th>


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

    <div class="row">
        <div class="col-sm-1">
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
                        <a href="javascript:void(0);" onclick="agregar_pantallas();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar_pantallas();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar_pantallas();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Monitores - Proyectores</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_pantallas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>
                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Patrimonial</th>
                                                <th data-hide="phone,tablet"> Marca</th>
                                                <th data-hide="phone,tablet"> Modelo</th>
                                                <th data-hide="phone,tablet"> Serie</th>
                                                <th data-hide="phone,tablet"> Color</th>
                                                <th data-hide="phone,tablet"> Estado</th>

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

    <div class="row">
        <div class="col-sm-1">
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
                        <a href="javascript:void(0);" onclick="agregar_impresoras();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar_impresoras();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar_impresoras();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Impresoras - Fotocopiadoras - Escanersx</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_impresoras"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Patrimonial</th>
                                                <th data-hide="phone,tablet"> Marca</th>
                                                <th data-hide="phone,tablet"> Modelo</th>
                                                <th data-hide="phone,tablet"> Serie</th>
                                                <th data-hide="phone,tablet"> Color</th>
                                                <th data-hide="phone,tablet"> Estado</th>


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

    <div class="row">
        <div class="col-sm-1">
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
                        <a href="javascript:void(0);" onclick="agregar_estabilizadores();"
                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar_estabilizadores();"
                            class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar_estabilizadores();"
                            class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-11">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Estabilizadores - Ups - Supresores</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_estabilizadores"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Tipo</th>
                                                <th data-hide="phone,tablet">Patrimonial</th>
                                                <th data-hide="phone,tablet"> Marca</th>
                                                <th data-hide="phone,tablet"> Modelo</th>
                                                <th data-hide="phone,tablet"> Serie</th>
                                                <th data-hide="phone,tablet"> Color</th>
                                                <th data-hide="phone,tablet"> Estado</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                    <table class="table-primary table-bordered table" style="font-size: 10px !important;" >

                                        <tbody>

                                            <tr>
                                                <td>
                                        <center> <a role="button" href="{{ url('gestionrecursostic') }}" class="btn btn-primary  btn-md"><i class="fa fa-arrow-left"></i>  Volver </a></center>
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



{{ form('gestionrecursostic/saveComputadoras','method':
'post','id':'form_computadoras','class':'smart-form','style':'display:none;') }}
<fieldset>

    <div class="row">

        <section class="col col-md-12" id="ocultar_computadoras">
            <label class="text-info">Area - Personal - Cargo</label>
            <select style="width:100%" id="input-id_personal_area_computadoras" name="id_personal_area">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for area_personal_cargo_select in area_personal_cargo %}
                    <option value="{{ area_personal_cargo_select.id_personal_area }}">
                        {{ area_personal_cargo_select.nombre_area }} - {{ area_personal_cargo_select.personal_nombre }}
                        - {{ area_personal_cargo_select.cargo }}
                    </option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_id_personal_area_computadoras">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Computadoras - Laptops - Servidores</label>
            <select style="width:100%" id="input-id_tabla_computadoras" name="id_tabla">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for computadoras_select in computadoras %}
                    <option value="{{ computadoras_select.id_computadora }}"> {{ computadoras_select.id_patrimonial }}
                        {{ computadoras_select.marca }} {{ computadoras_select.modelo }} {{ computadoras_select.color }}
                        {{ computadoras_select.serie }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_computadoras">
            <p>

        </section>

        <section class="col col-md-12">
            <label class="text-info">Usuario</label>
            <label class="input">
                <input type="text" list="datalist-usuario_computadoras" name="usuario" value=""
                    id="input-usuario_computadoras">
                <datalist id="datalist-usuario_computadoras">
                    {% for personal_select in personal %}
                    <option
                        value="{{ personal_select.apellidop }} {{ personal_select.apellidom}} {{ personal_select.nombres }}"
                        style="width: 100px;"></option>
                    {% endfor %}
                </datalist> </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Ubicacion</label>
            <label class="input">
                <input type="text" list="datalist-ubicacion_computadoras" name="ubicacion" value=""
                    id="input-ubicacion_computadoras">
                <datalist id="datalist-ubicacion_computadoras">
                    {% for ubicacion_select in ubicacion %}
                    <option value="{{ ubicacion_select.nombres }}"></option>
                    {% endfor %}
                </datalist> </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_computadoras" name="fecha_inicio" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_computadoras" name="fecha_fin" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Teamviewer</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="teamviewer" id="input-teamviewer_computadoras" placeholder="Teamviewer">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Anydesk</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="anydesk" id="input-anydesk_computadoras" placeholder="Anydesk">
            </label>
        </section>


        <section class="col col-md-4">
            <label class="text-info">IP</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="ip" id="input-ip_computadoras" placeholder="IP">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Nombre Equipo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="nombre" id="input-nombre_computadoras" placeholder="Nombre">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Conservacion</label>
            <label class="select">
                <select id="input-conservacion_computadoras" name="conservacion">
                    <option value="0">SELECCIONE...</option>
                    {% for conservacion_select in conservacion %}
                    <option value="{{ conservacion_select.codigo }}">{{ conservacion_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observaciones_computadoras" name="observaciones"></textarea>
            </label>
        </section>
    </div>

    <input type="hidden" id="input-id_tabla_computadoras_hidden" name="id_tabla_hidden" value="">
    <input type="hidden" id="input-id_personal_area_equipo_computadoras" name="id_personal_area_equipo" value="">
    <input type="hidden" id="input-id_personal_area_computadoras_nuevo" name="id_personal_area"
        value="{{ personalAreas.id_personal_area}}">

</fieldset>
{{ endForm() }}

{{ form('gestionrecursostic/savePantallas','method':
'post','id':'form_pantallas','class':'smart-form','style':'display:none;') }}
<fieldset>

    <div class="row">

        <section class="col col-md-12" id="ocultar_pantallas">
            <label class="text-info">Area - Personal - Cargo</label>
            <select style="width:100%" id="input-id_personal_area_pantallas" name="id_personal_area">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for area_personal_cargo_select in area_personal_cargo %}
                    <option value="{{ area_personal_cargo_select.id_personal_area }}">
                        {{ area_personal_cargo_select.nombre_area }} - {{ area_personal_cargo_select.personal_nombre }}
                        - {{ area_personal_cargo_select.cargo }}
                    </option>
                    {% endfor %}

                </optgroup>
            </select>

            <p id="input-warning_id_personal_area_pantallas">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Monitores - Proyectores</label>
            <select style="width:100%" id="input-id_tabla_pantallas" name="id_tabla">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for pantallas_select in pantallas %}
                    <option value="{{ pantallas_select.id_pantalla }}">{{ pantallas_select.id_patrimonial }} {{
                        pantallas_select.marca }} {{ pantallas_select.modelo }} {{ pantallas_select.color }} {{
                        pantallas_select.serie }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_pantallas">
            <p>
        </section>



        <section class="col col-md-12">
            <label class="text-info">Usuario</label>
            <label class="input">
                <input type="text" list="datalist-usuario_pantallas" name="usuario" value=""
                    id="input-usuario_pantallas">
                <datalist id="datalist-usuario_pantallas">
                    {% for personal_select in personal %}
                    <option
                        value="{{ personal_select.apellidop }} {{ personal_select.apellidom}} {{ personal_select.nombres }}">
                    </option>
                    {% endfor %}
                </datalist> </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Ubicacion</label>
            <label class="input">
                <input type="text" list="datalist-ubicacion_pantallas" name="ubicacion" value=""
                    id="input-ubicacion_pantallas">
                <datalist id="datalist-ubicacion_pantallas">
                    {% for ubicacion_select in ubicacion %}
                    <option value="{{ ubicacion_select.nombres }}"></option>
                    {% endfor %}
                </datalist> </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_pantallas" name="fecha_inicio" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_pantallas" name="fecha_fin" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>


        <section class="col col-md-6">
            <label class="text-info">Conservacion</label>
            <label class="select">
                <select id="input-conservacion_pantallas" name="conservacion">
                    <option value="0">SELECCIONE...</option>
                    {% for conservacion_select in conservacion %}
                    <option value="{{ conservacion_select.codigo }}">{{ conservacion_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>

            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observaciones_pantallas" name="observaciones"></textarea>
            </label>
        </section>
    </div>

    <input type="hidden" id="input-id_tabla_pantallas_hidden" name="id_tabla_hidden" value="">
    <input type="hidden" id="input-id_personal_area_equipo_pantallas" name="id_personal_area_equipo" value="">
    <input type="hidden" id="input-id_personal_area_pantallas_nuevo" name="id_personal_area"
        value="{{ personalAreas.id_personal_area}}">

</fieldset>
{{ endForm() }}

{{ form('gestionrecursostic/saveImpresoras','method':
'post','id':'form_impresoras','class':'smart-form','style':'display:none;') }}
<fieldset>

    <div class="row">

        <section class="col col-md-12" id="ocultar_impresoras">
            <label class="text-info">Area - Personal - Cargo</label>
            <select style="width:100%" id="input-id_personal_area_impresoras" name="id_personal_area">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for area_personal_cargo_select in area_personal_cargo %}
                    <option value="{{ area_personal_cargo_select.id_personal_area }}">
                        {{ area_personal_cargo_select.nombre_area }} - {{ area_personal_cargo_select.personal_nombre }}
                        - {{ area_personal_cargo_select.cargo }}
                    </option>
                    {% endfor %}

                </optgroup>
            </select>

            <p id="input-warning_id_personal_area_impresoras">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Impresoras - Fotocopiadoras - Escaners</label>
            <select style="width:100%" id="input-id_tabla_impresoras" name="id_tabla">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for impresoras_select in impresoras %}
                    <option value="{{ impresoras_select.id_impresora }}">{{ impresoras_select.id_patrimonial }} {{
                        impresoras_select.marca }} {{ impresoras_select.modelo }} {{ impresoras_select.color }} {{
                        impresoras_select.serie }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_impresoras">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Usuario</label>
            <label class="input">
                <input type="text" list="datalist-usuario_impresoras" name="usuario" value=""
                    id="input-usuario_impresoras">
                <datalist id="datalist-usuario_impresoras">
                    {% for personal_select in personal %}
                    <option
                        value="{{ personal_select.apellidop }} {{ personal_select.apellidom}} {{ personal_select.nombres }}">
                    </option>
                    {% endfor %}
                </datalist> </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Ubicacion</label>
            <label class="input">
                <input type="text" list="datalist-ubicacion_impresoras" name="ubicacion" value=""
                    id="input-ubicacion_impresoras">
                <datalist id="datalist-ubicacion_impresoras">
                    {% for ubicacion_select in ubicacion %}
                    <option value="{{ ubicacion_select.nombres }}"></option>
                    {% endfor %}
                </datalist> </label>
        </section>


        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_impresoras" name="fecha_inicio" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_impresoras" name="fecha_fin" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">IP</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="ip" id="input-ip_impresoras" placeholder="IP">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Nombre Equipo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" name="nombre" id="input-nombre_impresoras" placeholder="Nombre">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Conservación</label>
            <label class="select">
                <select id="input-conservacion_impresoras" name="conservacion">
                    <option value="0">SELECCIONE...</option>
                    {% for conservacion_select in conservacion %}
                    <option value="{{ conservacion_select.codigo }}">{{ conservacion_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observaciones_impresoras" name="observaciones"></textarea>
            </label>
        </section>
    </div>

    <input type="hidden" id="input-id_tabla_impresoras_hidden" name="id_tabla_hidden" value="">
    <input type="hidden" id="input-id_personal_area_equipo_impresoras" name="id_personal_area_equipo" value="">
    <input type="hidden" id="input-id_personal_area_impresoras_nuevo" name="id_personal_area"
        value="{{ personalAreas.id_personal_area}}">

</fieldset>
{{ endForm() }}


{{ form('gestionrecursostic/saveEstabilizadores','method':
'post','id':'form_estabilizadores','class':'smart-form','style':'display:none;') }}
<fieldset>

    <div class="row">
        <section class="col col-md-12" id="ocultar_estabilizadores">
            <label class="text-info">Area - Personal - Cargo</label>
            <select style="width:100%" id="input-id_personal_area_estabilizadores" name="id_personal_area">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for area_personal_cargo_select in area_personal_cargo %}
                    <option value="{{ area_personal_cargo_select.id_personal_area }}">
                        {{ area_personal_cargo_select.nombre_area }} - {{ area_personal_cargo_select.personal_nombre }}
                        - {{ area_personal_cargo_select.cargo }}
                    </option>
                    {% endfor %}

                </optgroup>
            </select>

            <p id="input-warning_id_personal_area_estabilizadores">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Estabilizadores - Ups - Supresores</label>
            <select style="width:100%" id="input-id_tabla_estabilizadores" name="id_tabla">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for estabilizadores_select in estabilizadores %}
                    <option value="{{ estabilizadores_select.id_estabilizador }}">{{
                        estabilizadores_select.id_patrimonial }} {{ estabilizadores_select.marca }} {{
                        estabilizadores_select.modelo }} {{ estabilizadores_select.color }} {{
                        estabilizadores_select.serie }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_estabilizadores">
            <p>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Usuario</label>
            <label class="input">
                <input type="text" list="datalist-usuario_estabilizadores" name="usuario" value=""
                    id="input-usuario_estabilizadores">
                <datalist id="datalist-usuario_estabilizadores">
                    {% for personal_select in personal %}
                    <option
                        value="{{ personal_select.apellidop }} {{ personal_select.apellidom}} {{ personal_select.nombres }}">
                    </option>
                    {% endfor %}
                </datalist> </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Ubicacion</label>
            <label class="input">
                <input type="text" list="datalist-ubicacion_estabilizadores" name="ubicacion" value=""
                    id="input-ubicacion_estabilizadores">
                <datalist id="datalist-ubicacion_estabilizadores">
                    {% for ubicacion_select in ubicacion %}
                    <option value="{{ ubicacion_select.nombres }}"></option>
                    {% endfor %}
                </datalist> </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_estabilizadores" name="fecha_inicio" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_estabilizadores" name="fecha_fin" placeholder="Fecha"
                    class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Conservacion</label>
            <label class="select">

                <select id="input-conservacion_estabilizadores" name="conservacion">
                    <option value="0">SELECCIONE...</option>
                    {% for conservacion_select in conservacion %}
                    <option value="{{ conservacion_select.codigo }}">{{ conservacion_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observaciones_estabilizadores" name="observaciones"></textarea>
            </label>
        </section>
    </div>

    <input type="hidden" id="input-id_tabla_estabilizadores_hidden" name="id_tabla_hidden" value="">
    <input type="hidden" id="input-id_personal_area_equipo_estabilizadores" name="id_personal_area_equipo" value="">
    <input type="hidden" id="input-id_personal_area_estabilizadores_nuevo" name="id_personal_area"
        value="{{ personalAreas.id_personal_area}}">

</fieldset>
{{ endForm() }}



<script type="text/javascript">
    var id_personal_areas = "{{ personalAreas.id_personal_area }}";</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>