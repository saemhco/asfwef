<style>
    #cke_input-titulo {
        border: solid 1px black;
    }
</style>

{% set id_adquisicion = "" %}
{% if adquisiones.id_adquisicion is defined %}
{% set id_adquisicion = adquisiones.id_adquisicion %}
{% endif %}

{% set tipo = "" %}
{% if adquisiones.tipo is defined %}
{% set tipo = adquisiones.tipo %}
{% endif %}

{% set fecha_adquisicion = "" %}
{% if adquisiones.fecha_adquisicion is defined %}
{% set fecha_adquisicion = utilidades.fechita(adquisiones.fecha_adquisicion,'d/m/Y') %}
{% endif %}

{% set descripcion = "" %}
{% if adquisiones.descripcion is defined %}
{% set descripcion = adquisiones.descripcion %}
{% endif %}

{% set numero_oc = "" %}
{% if adquisiones.numero_oc is defined %}
{% set numero_oc = adquisiones.numero_oc %}
{% endif %}

{% set precio = "" %}
{% if adquisiones.precio is defined %}
{% set precio = adquisiones.precio %}
{% endif %}

{% set observaciones = "" %}
{% if adquisiones.observaciones is defined %}
{% set observaciones = adquisiones.observaciones %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if adquisiones.estado is defined %}
{% set estado = adquisiones.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Adquisiciones</li>
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Adquisiciones </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registromedicamentosadquisiciones/save','method':
                                    'post','id':'form_adiquisiciones','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info">Tipo
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo" name="tipo">
                                                        <option value="">Seleccione...</option>
                                                        {% for origen_select in origen %}
                                                        {% if origen_select.codigo == tipo %}
                                                        <option selected="selected"
                                                            value="{{ origen_select.codigo }}">{{
                                                                origen_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ origen_select.codigo }}">{{
                                                            origen_select.nombres }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha Adquisicion</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_adquisicion" name="fecha_adquisicion"
                                                        placeholder="Fecha de hora" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_adquisicion }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Numero Orden de Compra</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero_oc" name="numero_oc" placeholder="Numero Orden de Compra" value="{{ numero_oc }}">
                                                    <input type="hidden" id="input-id_adquisicion" name="id_adquisicion"
                                                    value="{{ id_adquisicion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info">Precio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-precio" name="precio" placeholder="Precio" value="{{precio}}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>
                                    
                                            <section class="col col-md-12">
                                                <label class="text-info" >Observaciones</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-observaciones" name="observaciones" placeholder="Observaciones">{{ observaciones }}</textarea> 
                                                </label>
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

        {% if estado !== "" %}
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
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>
                        {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i
                                class="fa fa-eye"></i></a> #}
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
                                <h2>Adquisiciones Detalle</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_detalle"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Medicamento</th>
                                                <th>Cantidad</th>
                                                <th data-hide="phone,tablet">Precio</th>
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



<!--Formulario de registro detalle-->
{{ form('registromedicamentosadquisiciones/saveDetalle','method': 'post','id':'form_detalle','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Medicamento</label>
            <select style="width:100%" id="input-ad-id_medicamento" name="id_medicamento">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% for medicamento_select in medicamentos %}

                    <option value="{{ medicamento_select.id_medicamento }}">{{
                        medicamento_select.medicamento }} - {{
                        medicamento_select.concentracion }} - {{medicamento_select.forma}}</option>

                    {% endfor %}
                </optgroup>
            </select>
            <p id="input-ad-warning_medicamento">
            <p>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Cantidad</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ad-cantidad" name="cantidad" placeholder="Cantidad">
                <input type="hidden" id="input-ad-adquision_detalle" name="id_adquision_detalle" value="">
                <input type="hidden" id="input-ad-id_adquisicion" name="id_adquisicion" value="{{ id_adquisicion }}">
            </label>
        </section>


        <section class="col col-md-6">
            <label class="text-info" >Precio</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ad-precio" name="precio" placeholder="Precio" value="">
            </label>
        </section>

    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->


<div class="hidden">
    <div id="exito_documentos">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<script type="text/javascript" >
    var id_adquisicion = "{{ id_adquisicion }}";
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>