{% set id_caso = "" %}
{% if casos.id_caso is defined %}
{% set id_caso = casos.id_caso %}
{% endif %}

{% set fecha_caso = "" %}
{% if casos.fecha_caso is defined %}
{% set fecha_caso = utilidades.fechita(casos.fecha_caso,'d/m/Y') %}
{% endif %}

{% set descripcion = "" %}
{% if casos.descripcion is defined %}
{% set descripcion = casos.descripcion %}
{% endif %}

{% set observaciones = "" %}
{% if casos.observaciones is defined %}
{% set observaciones = casos.observaciones %}
{% endif %}

{% set id_comisaria = "" %}
{% if casos.id_comisaria is defined %}
{% set id_comisaria = casos.id_comisaria %}
{% endif %}

{% set id_seccion = "" %}
{% if casos.id_seccion is defined %}
{% set id_seccion = casos.id_seccion %}
{% endif %}

{% set id_comisario = "" %}
{% if casos.id_comisario is defined %}
{% set id_comisario = casos.id_comisario %}
{% endif %}

{% set id_fiscal = "" %}
{% if casos.id_fiscal is defined %}
{% set id_fiscal = casos.id_fiscal %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if casos.estado is defined %}
{% set estado = casos.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}





<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Casos</li>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro de Casos </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrocasos/save','method':
                                    'post','id':'form_tbl_fsc_casos','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha del Caso</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_caso" name="fecha_caso"
                                                        placeholder="Fecha del Caso" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_caso }}">
                                                    <input type="hidden" id="input-id_caso" name="id_caso"
                                                        value="{{ id_caso }}">
                                                </label>
                                            </section>




                                            <section class="col col-md-12">
                                                <label class="text-info">Descripcion</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-descripcion"
                                                        name="descripcion">{{ descripcion }}</textarea>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="5" id="input-observaciones"
                                                        name="observaciones">{{ observaciones }}</textarea>
                                                </label>
                                            </section>


                                            <section class="col col-md-4">

                                                <label class="text-info">Comisarias</label>

                                                <select style="width:100%" id="input-id_comisaria" name="id_comisaria">
                                                    <optgroup label="">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for comisaria in comisarias %}

                                                        {% if comisaria.id_comisaria == id_comisaria %}
                                                        <option value="{{ comisaria.id_comisaria }}"
                                                            selected="selected">
                                                            {{comisaria.descripcion}}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ comisaria.id_comisaria }}">
                                                            {{comisaria.descripcion}}
                                                        </option>
                                                        {% endif %}
                                                        {% endfor %}
                                                    </optgroup>
                                                </select>

                                            </section>



                                            <section class="col col-md-4">

                                                <label class="text-info">Seccion
                                                </label>
                                                <label class="select">
                                                    <select id="input-id_seccion" name="id_seccion">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for seccion in secciones %}
                                                        {% if seccion.id_seccion == id_seccion %}
                                                        <option value="{{ seccion.id_seccion }}" selected="selected">{{
                                                            seccion.descripcion }} </option>
                                                        {% else %}
                                                        <option value="{{ seccion.id_seccion }}">{{ seccion.descripcion
                                                            }} </option>
                                                        {% endif %}
                                                        {% endfor %}

                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info">Comisario</label>

                                                <select style="width:100%" id="input-id_comisario" name="id_comisario">
                                                    <optgroup label="">
                                                        <option value="">SELECCIONE...</option>
                                                        {% for comisario in comisarios %}

                                                        {% if comisario.id_comisario == id_comisario %}
                                                        <option value="{{ comisario.id_comisario }}"
                                                            selected="selected">
                                                            {{comisario.apellidos}} {{fiscal.nombres}}
                                                        </option>
                                                        {% else %}
                                                        <option value="{{ comisario.id_comisario }}">
                                                            {{comisario.apellidos}} {{fiscal.nombres}}
                                                        </option>
                                                        {% endif %}
                                                        {% endfor %}
                                                    </optgroup>
                                                </select>

                                            </section>

                                        </div>
                                    </fieldset>





                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()" type="button" class="btn btn-default">
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




    {% if id_caso !== "" %}
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
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

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
                                <h2>Casos Agraviados</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_fsc_casos_agraviados"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Nro Documento</th>
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
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Casos Denunciante</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_fsc_casos_denunciantes"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Nro Documento</th>
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
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Casos Denunciados</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_fsc_casos_denunciados"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Nro Documento</th>
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
            </section>
        </div>
        {% endif %}
    </div>
</div>



{{ form('registrocasos/saveAgraviados','method':
'post','id':'form_tbl_fsc_casos_agraviados','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Descripcion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-c-a-nro_doc" name="nro_doc" placeholder="">
                <input type="hidden" id="input-c-a-id_caso" name="id_caso" value="{{id_caso}}">
                <input type="hidden" id="input-c-a-id_caso_agraviado" name="id_caso_agraviado" value="">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}


{{ form('registrocasos/saveDenunciantes','method':
'post','id':'form_tbl_fsc_casos_denunciantes','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Descripcion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-c-d-nro_doc" name="nro_doc" placeholder="">
                <input type="hidden" id="input-d-id_caso" name="id_caso" value="{{id_caso}}">
                <input type="hidden" id="input-c-d-id_caso_denunciante" name="id_caso_denunciante" value="">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('registrocasos/saveDenunciados','method':
'post','id':'form_tbl_fsc_casos_denunciados','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Descripcion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-c-dd-nro_doc" name="nro_doc" placeholder="">
                <input type="hidden" id="input-dd-id_caso" name="id_caso" value="{{id_caso}}">
                <input type="hidden" id="input-c-dd-id_caso_denunciado" name="id_caso_denunciado" value="">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}




<div class="hidden">
    <div id="success">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<script type="text/javascript">
    var id_caso = "{{ id_caso }}";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>