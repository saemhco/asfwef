<style>
    #cke_input-texto_muestra {
        border: solid 1px black;
    }
</style>

{% set id_visita = "" %}
{% if visitas.id_visita is defined %}
{% set id_visita = visitas.id_visita %}
{% endif %}

{% set id_visitante = "" %}
{% if visitas.id_visitante is defined %}
{% set id_visitante = visitas.id_visitante %}
{% endif %}

{% set id_motivo = "" %}
{% if visitas.id_motivo is defined %}
{% set id_motivo = visitas.id_motivo %}
{% endif %}

{% set id_personal = "" %}
{% if visitas.id_personal is defined %}
{% set id_personal = visitas.id_personal %}
{% endif %}

{% set id_area = "" %}
{% if visitas.id_area is defined %}
{% set id_area = visitas.id_area %}
{% endif %}

{% set id_sede = "" %}
{% if visitas.id_sede is defined %}
{% set id_sede = visitas.id_sede %}
{% endif %}

{% set id_lugar = "" %}
{% if visitas.id_lugar is defined %}
{% set id_lugar = visitas.id_lugar %}
{% endif %}

{% set fecha_visita = "" %}
{% if visitas.fecha_visita is defined %}
{% set fecha_visita = utilidades.fechita(visitas.fecha_visita,'d/m/Y') %}
{% endif %}

{% set hora_ingreso = "" %}
{% if visitas.hora_ingreso is defined %}
{% set hora_ingreso = utilidades.hora_peru(visitas.hora_ingreso,'H:i:s') %}
{% endif %}

{% set hora_salida = "" %}
{% if visitas.hora_salida is defined %}
{% set hora_salida = utilidades.hora_peru(visitas.hora_salida,'H:i:s') %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if visitas.estado is defined %}
{% set estado = visitas.estado %}
{% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Visitas</li>
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
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro de Visitas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('registrovisitas/save','method':
                                    'post','id':'form_tbl_web_visitas','class':'smart-form','enctype':'multipart/form-data')
                                    }}


                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-6">
                                                <label class="text-info"> Visitante
                                                </label>
                                                <select style="width:100%" id="input-id_visitante" name="id_visitante">
                                                    <option value="">Seleccione...</option>
                                                    {% for visitante in visitantes %}
                                                    {% if visitante.id_empresa_publico == id_visitante %}
                                                    <option selected="selected"
                                                        value="{{ visitante.id_empresa_publico }}">
                                                        {{visitante.ruc }} {{visitante.razon_social }} - {{visitante.nro_doc }} {{visitante.apellidop }}
                                                        {{visitante.apellidom }} {{visitante.nombres }}  </option>
                                                    {% else %}
                                                    <option value="{{ visitante.id_empresa_publico }}">
                                                        {{visitante.ruc }} {{visitante.razon_social }} - {{visitante.nro_doc }} {{visitante.apellidop }}
                                                        {{visitante.apellidom }} {{visitante.nombres }}  </option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                <p id="warning-id_visitante"></p>
                                            </section>

                                            <section class="col col-2">
                                                <label class="text-info"></label>

                                                <a href="javascript:void(0);" onclick="agregar_visitante();"
                                                    class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                                    Agregar Visitante</a>

                                            </section>

                                            <section class="col col-2">
                                                <label class="text-info"></label>

                                                <a href="javascript:void(0);" onclick="agregar_institucion();"
                                                    class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                                    Agregar Institución</a>
                                            </section>


                                            <section class="col col-2">
                                                <label class="text-info"></label>

                                                <a href="javascript:void(0);" onclick="agregar_ciudadano();"
                                                    class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                                    Agregar Ciudadano</a>

                                            </section>
                                        </div>

                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info">Fecha </label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if id_visita == "" %}
                                                    <input type="text" id="input-fecha_visita" name="fecha_visita"
                                                        placeholder="Fecha" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    {% else %}
                                                    <input type="text" id="input-fecha_visita" name="fecha_visita"
                                                        placeholder="Fecha" class="datepicker"
                                                        data-dateformat='dd/mm/yy' value="{{ fecha_visita }}">
                                                    {% endif %}

                                                    <input type="hidden" id="input-id_visita" name="id_visita"
                                                        value="{{ id_visita }}">

                                                </label>
                                            </section>


                                            <section class="col col-md-3">
                                                <label class="text-info">Hora Ingreso</label>
                                                <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>

                                                    <input type="text" id="input-hora_ingreso" name="hora_ingreso"
                                                        placeholder="Hora Ingreso" class="" value="{{ hora_ingreso }}">


                                                </label>
                                            </section>
                                            <!-- 

                                            <section class="col col-md-3">
                                                <label class="text-info">Hora Salida</label>
                                                <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>

                                                    <input type="text" id="input-hora_salida" name="hora_salida"
                                                        placeholder="Hora Salida" class="" value="{{ hora_salida }}">

                                                </label>
                                            </section> -->

                                            <section class="col col-md-6">
                                                <label class="text-info">Motivo </label>
                                                <label class="select">
                                                    <select id="input-id_motivo" name="id_motivo">
                                                        <option value="">Seleccione...</option>
                                                        {% for motivo_select in motivos_model %}
                                                        {% if motivo_select.codigo == id_motivo %}
                                                        <option selected="selected" value="{{ motivo_select.codigo }}">
                                                            {{motivo_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ motivo_select.codigo }}">
                                                            {{motivo_select.nombres
                                                            }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>

                                                </label>
                                            </section>






                                            <section class="col col-md-6">
                                                <label class="text-info"> Personal
                                                </label>
                                                <select style="width:100%" id="input-id_personal" name="id_personal">
                                                    <option value="">Seleccione...</option>
                                                    {% for personal_select in personal_model %}
                                                    {% if personal_select.codigo == id_personal %}
                                                    <option selected="selected" value="{{ personal_select.codigo }}">
                                                        {{personal_select.apellidop }} {{personal_select.apellidom }}
                                                        {{personal_select.nombres }}</option>
                                                    {% else %}
                                                    <option value="{{ personal_select.codigo }}">
                                                        {{personal_select.apellidop }} {{personal_select.apellidom }}
                                                        {{personal_select.nombres }}</option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                <p id="warning-id_personal"></p>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info"> Areas
                                                </label>
                                                <select style="width:100%" id="input-id_area" name="id_area">
                                                    <option value="">Seleccione...</option>
                                                    {% for area_select in areas_model %}
                                                    {% if area_select.codigo == id_area %}
                                                    <option selected="selected" value="{{ area_select.codigo }}">
                                                        {{area_select.nombres }}</option>
                                                    {% else %}
                                                    <option value="{{ area_select.codigo }}">{{area_select.nombres }}
                                                    </option>
                                                    {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                <p id="warning-id_area"></p>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Sede</label>
                                                <label class="select">
                                                    <select id="input-id_sede" name="id_sede">
                                                        <option value="">Seleccione...</option>
                                                        {% for sede_select in sedes_model %}
                                                        {% if sede_select.id_sede == id_sede %}
                                                        <option selected="selected" value="{{ sede_select.id_sede }}">
                                                            {{sede_select.nombres }}</option>
                                                        {% else %}
                                                        <option value="{{ sede_select.id_sede }}">{{sede_select.nombres
                                                            }}</option>
                                                        {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Lugar</label>
                                                <label class="select">
                                                    <select id="input-id_lugar" name="id_lugar">
                                                        <option value="">Seleccione...</option>
                                                    </select> <i></i>

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
    </div>
</div>



{{ form('registrovisitas/saveEmpresaPublico','method': 'post','id':'form_empresa_publico','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Institución</label>
            <select style="width:100%" id="input-ep-id_empresa" name="id_empresa">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

      
                    {% for empresas_select in empresas %}
                    <option value="{{ empresas_select.id_empresa }}">{{ empresas_select.ruc }} - {{
                        empresas_select.razon_social }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_empresa">
            <p>
        </section>

        
        <section class="col col-md-12">
            <label class="text-info">Ciudadano</label>
            <select style="width:100%" id="input-ep-id_publico" name="id_publico">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for publico_select in publico %}
                    <option value="{{ publico_select.codigo }}">{{ publico_select.nro_doc }} - {{
                        publico_select.apellidop
                        }} {{ publico_select.apellidom }} {{ publico_select.nombres }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_publico">
            <p>
        </section>

        <section class="col col-md-12" style="margin-top: 50px;">
            <label class="text-info" >Correo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ep-email" name="email" placeholder="" >
                <input type="hidden" id="input-ep-id_empresa_publico" name="id_empresa_publico" value="">

            </label>
        </section>


    </div> 

</fieldset>
{{ endForm() }}
{{ form('registrovisitas/saveEmpresa','method': 'post','id':'form_empresa','class':'smart-form','style':'display:none;')
}}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Nro Ruc</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-e-ruc" name="ruc" placeholder="">
                <input type="hidden" id="input-e-id_empresa" name="id_empresa" value="">

            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Razon Social</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-e-razon_social" name="razon_social" placeholder="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Email</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-e-email" name="email" placeholder="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Celular</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-e-celular" name="celular" placeholder="">
            </label>
        </section>

    </div>

</fieldset>
{{ endForm() }}

{{ form('registrovisitas/savePublico','method': 'post','id':'form_publico','class':'smart-form','style':'display:none;')
}}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Tipo Documento</label>
            <label class="select">
                <select id="input-p-documento" name="documento">
                    <option value="">Seleccione</option>
                    {% for tipodocumento in tipodocumentos %}
                    <option value="{{ tipodocumento.codigo }}">{{ tipodocumento.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Nro Documento</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-p-nro_doc" name="nro_doc" placeholder="">
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Apellido Paterno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-p-apellidop" name="apellidop" placeholder="">
                <input type="hidden" id="input-p-codigo" name="codigo" value="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Apellido Materno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-p-apellidom" name="apellidom" placeholder="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Nombres</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-p-nombres" name="nombres" placeholder="">
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Email</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-p-email" name="email" placeholder="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Celular</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-p-celular" name="celular" placeholder="">
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
    var id_sede = '{{ id_sede }}';
    var id_lugar = '{{ id_lugar }}';
</script>
<script type="text/javascript"> var perfil = "{{ perfil }}";</script>