<style>
    #cke_input-descripcion {
        border: solid 1px black;
    }
</style>

{% set id_doc = "" %}
{% if documentos.id_doc is defined %}
{% set id_doc = documentos.id_doc %}
{% endif %}

{% set fecha = "" %}
{% if documentos.fecha is defined %}
{% set fecha = utilidades.fechita(documentos.fecha,'d/m/Y') %}
{% endif %}

{% set documento = "" %}
{% if documentos.documento is defined %}
{% set documento = documentos.documento %}
{% endif %}

{% set asunto = "" %}
{% if documentos.asunto is defined %}
{% set asunto = documentos.asunto %}
{% endif %}

{% set tipo = "" %}
{% if documentos.tipo is defined %}
{% set tipo = documentos.tipo %}
{% endif %}

{% set remitente = "" %}
{% if documentos.remitente is defined %}
{% set remitente = documentos.remitente %}
{% endif %}

{% set destinatario = "" %}
{% if documentos.destinatario is defined %}
{% set destinatario = documentos.destinatario %}
{% endif %}

{% set proceso = "" %}
{% if documentos.proceso is defined %}
{% set proceso = documentos.proceso %}
{% endif %}

{% set archivo = "" %}
{% if documentos.archivo is defined %}
{% set archivo = documentos.archivo %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if documentos.estado is defined %}
{% set estado = documentos.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Documentos</li>
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
                                <h2>Registro de Documentos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('gestiontramitedocumentarioexterno/save','method':
                                    'post','id':'form_documentos','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">


                                            <section class="col col-md-4">
                                                <label class="text-info">Fecha</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha" name="fecha" placeholder="Fecha"
                                                        class="datepicker" data-dateformat='dd/mm/yy'
                                                        value="{{ fecha }}">
                                                </label>
                                            </section>


                                            <section class="col col-md-8">

                                                <label class="text-info" >Tipo de documento
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_doc"  name="tipo_doc" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipodocumentos_select in tipodocumentos %}
                                                            {% if tipodocumentos_select.codigo == tipo_doc %}
                                                                <option selected="selected" value="{{ tipodocumentos_select.codigo }}">{{ tipodocumentos_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipodocumentos_select.codigo }}">{{ tipodocumentos_select.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info">Documento</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-documento" name="documento"
                                                        placeholder="Nombre documento" value="{{ documento }}">
                                                    <input type="hidden" id="input-id_doc" name="id_doc"
                                                        value="{{ id_doc }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                                <label class="text-info" >Destinatario
                                                </label>
                                                <label class="select">
                                                    <select id="input-destinatario"  name="destinatario" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for destinatario_select in destinatarios %}
                                                            {% if tipodocumentos_select.codigo == destinatario %}
                                                                <option selected="selected" value="{{ destinatario_select.id_doc_personal_area }}">{{ destinatario_select.area_nombre }} - {{destinatario_select.personal_nombre}}</option>   
                                                            {% else %}
                                                                <option value="{{ destinatario_select.id_doc_personal_area }}">{{ destinatario_select.area_nombre }} - {{destinatario_select.personal_nombre}}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info">Asunto</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" id="input-asunto" name="asunto"
                                                        placeholder="Asunto">{{ asunto }}</textarea>
                                                </label>
                                            </section>



                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo (solo en formato PDF)</label>
                                                <div class="input input-file">
                                                    <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">
                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/tramite_documentario/externos/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

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


    {% if id_doc !== "" %}
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
                                <h2>Archivos de Convocatorias</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_doc_documentos_detalles"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Fecha</th>
                                                <th data-hide="phone,tablet">Proveido</th>
                                                <th data-hide="phone,tablet">Destinatario</th>
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
    {% endif %}


</div>


{{ form('gestiontramitedocumentarioexterno/savearchivo','method':
'post','id':'form_convocatorias_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">

        <section class="col col-md-3">
            <label class="text-info">Fecha</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha" name="fecha" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="">
                <input type="hidden" id="input-id_doc_detalle" name="id_doc_detalle" value="">
                <input type="hidden" id="input-id_doc" name="id_doc" value="{{ id_doc }}">
            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info">Enlace</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enlace_detalle" name="enlace_detalle" placeholder="Enlace" value="">

            </label>
        </section>

    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="success">
        <p>
            Se guardó correctamente...
        </p>
    </div>
</div>