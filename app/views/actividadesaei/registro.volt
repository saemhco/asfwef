<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_actividad_aei = "" %}
{% set id_indicador_aei = "" %}
{% set ano_eje = "" %}
{% set nombre = "" %}
{% set descripcion = "" %}
{% set orden = "" %}
{% set avance = "" %}


{% set unidad_medida = "" %}
{% set meta = "" %}
{% set datos = "" %}

{% set gfp_monto_programado = "" %}
{% set gfp_01 = "" %}
{% set gfp_02 = "" %}
{% set gfp_03 = "" %}
{% set gfp_04 = "" %} 
{% set gfp_05 = "" %}
{% set gfp_06 = "" %}
{% set gfp_07 = "" %}
{% set gfp_08 = "" %}
{% set gfp_09 = "" %}
{% set gfp_10 = "" %}
{% set gfp_11 = "" %}
{% set gfp_12 = "" %}
{% set gfp_total = "" %}
{% set gfp_porcentaje = "" %}

{% set gop_01 = "" %}
{% set gop_02 = "" %}
{% set gop_03 = "" %}
{% set gop_04 = "" %}
{% set gop_05 = "" %}
{% set gop_06 = "" %}
{% set gop_07 = "" %}
{% set gop_08 = "" %}
{% set gop_09 = "" %}
{% set gop_10 = "" %}
{% set gop_11 = "" %}
{% set gop_12 = "" %}
{% set gop_total = "" %}
{% set gop_porcentaje = "" %}

{% set enlace = "" %}
{% set estado = "" %}




{% if actividadesaei.id_actividad_aei is defined %}
    {% set id_actividad_aei = actividadesaei.id_actividad_aei %}
{% endif %}

{% if actividadesaei.id_indicador_aei is defined %}
    {% set id_indicador_aei = actividadesaei.id_indicador_aei %}
{% endif %}

{% if actividadesaei.ano_eje is defined %}
    {% set ano_eje = actividadesaei.ano_eje %}
{% endif %}

{% if actividadesaei.nombre is defined %}
    {% set nombre = actividadesaei.nombre %}
{% endif %}

{% if actividadesaei.descripcion is defined %}
    {% set descripcion = actividadesaei.descripcion %}
{% endif %}

{% if actividadesaei.orden is defined %}
    {% set orden = actividadesaei.orden %}
{% endif %}

{% if actividadesaei.avance is defined %}
    {% set avance = actividadesaei.avance %}
{% endif %}

{#inicio#}
{% if actividadesaei.unidad_medida is defined %}
    {% set unidad_medida = actividadesaei.unidad_medida %}
{% endif %}

{% if actividadesaei.meta is defined %}
    {% set meta = actividadesaei.meta %}
{% endif %}

{% if actividadesaei.datos is defined %}
    {% set datos = actividadesaei.datos %}
{% endif %}




{% if actividadesaei.gfp_monto_programado  is defined %}
    {% set gfp_monto_programado   = actividadesaei.gfp_monto_programado    %}
{% endif %}

{% if actividadesaei.gfp_01  is defined %}
    {% set gfp_01   = actividadesaei.gfp_01    %}
{% endif %}

{% if actividadesaei.gfp_02  is defined %}
    {% set gfp_02   = actividadesaei.gfp_02    %}
{% endif %}

{% if actividadesaei.gfp_03  is defined %}
    {% set gfp_03  = actividadesaei.gfp_03    %}
{% endif %}

{% if actividadesaei.gfp_04  is defined %}
    {% set gfp_04  = actividadesaei.gfp_04    %}
{% endif %}

{% if actividadesaei.gfp_05  is defined %}
    {% set gfp_05  = actividadesaei.gfp_05    %}
{% endif %}

{% if actividadesaei.gfp_06  is defined %}
    {% set gfp_06  = actividadesaei.gfp_06    %}
{% endif %}

{% if actividadesaei.gfp_07  is defined %}
    {% set gfp_07  = actividadesaei.gfp_07    %}
{% endif %}


{% if actividadesaei.gfp_08  is defined %}
    {% set gfp_08  = actividadesaei.gfp_08    %}
{% endif %}

{% if actividadesaei.gfp_09  is defined %}
    {% set gfp_09  = actividadesaei.gfp_09    %}
{% endif %}

{% if actividadesaei.gfp_10  is defined %}
    {% set gfp_10  = actividadesaei.gfp_10    %}
{% endif %}

{% if actividadesaei.gfp_11  is defined %}
    {% set gfp_11  = actividadesaei.gfp_11    %}
{% endif %}

{% if actividadesaei.gfp_12  is defined %}
    {% set gfp_12  = actividadesaei.gfp_12   %}
{% endif %}

{% if actividadesaei.gfp_total  is defined %}
    {% set gfp_total = actividadesaei.gfp_total   %}
{% endif %}

{% if actividadesaei.gfp_porcentaje  is defined %}
    {% set gfp_porcentaje = actividadesaei.gfp_porcentaje   %}
{% endif %}



{% if actividadesaei.gop_01 is defined %}
    {% set gop_01 = actividadesaei.gop_01 %}
{% endif %}

{% if actividadesaei.gop_02 is defined %}
    {% set gop_02 = actividadesaei.gop_02 %}
{% endif %}

{% if actividadesaei.gop_03 is defined %}
    {% set gop_03 = actividadesaei.gop_03 %}
{% endif %}

{% if actividadesaei.gop_04 is defined %}
    {% set gop_04 = actividadesaei.gop_04 %}
{% endif %}

{% if actividadesaei.gop_05 is defined %}
    {% set gop_05 = actividadesaei.gop_05 %}
{% endif %}

{% if actividadesaei.gop_06 is defined %}
    {% set gop_06 = actividadesaei.gop_06 %}
{% endif %}

{% if actividadesaei.gop_07 is defined %}
    {% set gop_07 = actividadesaei.gop_07 %}
{% endif %}

{% if actividadesaei.gop_08 is defined %}
    {% set gop_08 = actividadesaei.gop_08 %}
{% endif %}

{% if actividadesaei.gop_09 is defined %}
    {% set gop_09 = actividadesaei.gop_08 %}
{% endif %}

{% if actividadesaei.gop_10 is defined %}
    {% set gop_10 = actividadesaei.gop_10 %}
{% endif %}

{% if actividadesaei.gop_11 is defined %}
    {% set gop_11 = actividadesaei.gop_11 %}
{% endif %}

{% if actividadesaei.gop_12 is defined %}
    {% set gop_12 = actividadesaei.gop_12 %}
{% endif %}

{% if actividadesaei.gop_total is defined %}
    {% set gop_total = actividadesaei.gop_total %}
{% endif %}

{% if actividadesaei.gop_porcentaje  is defined %}
    {% set gop_porcentaje  = actividadesaei.gop_porcentaje  %}
{% endif %}

{#fin#}





{% if actividadesaei.enlace is defined %}
    {% set enlace = actividadesaei.enlace %}
{% endif %}



{% set txt_buton = "Guardar" %}
{% if actividadesaei.estado is defined %}
    {% set estado = actividadesaei.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}



<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Actividades a.e.i</li>
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
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Actividades a.e.i</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('actividadesaei/save','method': 'post','id':'form_actividadesaei','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-3">

                                                <label class="text-info" >Año
                                                </label>
                                                <label class="select">

                                                    {% if estado == ""  %}
                                                        <select id="input-ano_eje"  name="ano_eje">
                                                            <option value="" >Seleccione...</option>
                                                            {% for anio_model in anios %}
                                                                {% if anio_model.nombres == anio_actual %}
                                                                    <option selected="selected" value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% else %}
                                                                    <option value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% endif %}

                                                            {% endfor %}
                                                        </select> <i></i>
                                                    {% else %}
                                                        <select id="input-ano_eje_edit"  name="ano_eje" disabled="true">
                                                            <option value="" >Seleccione...</option>
                                                            {% for anio_model in anios %}
                                                                {% if anio_model.nombres == ano_eje %}
                                                                    <option selected="selected" value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% else %}
                                                                    <option value="{{ anio_model.nombres }}">{{ anio_model.nombres }}</option>   
                                                                {% endif %}

                                                            {% endfor %}
                                                        </select> <i></i>
                                                    {% endif %}

                                                </label>
                                            </section>
                                            {% if estado == "" %}
                                                <section class="col col-md-12">

                                                    <label class="text-info" >Objetivos ei 
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-id_objetivo_ei"  name="id_objetivo_ei" >
                                                            <option value="" >Seleccione...</option>
                                                            {% for objetivoei_model in objetivosei %}

                                                                <option value="{{ objetivoei_model.id_objetivo_ei }}" ano_eje="{{ objetivoei_model.ano_eje }}">{{ objetivoei_model.ano_eje }} - {{ utilidades.partedescripcion(objetivoei_model.descripcion,0,60) }}...</option>   


                                                            {% endfor %}
                                                        </select> <i></i>
                                                    </label>
                                                </section>

                                                {#                                                <section class="col col-md-12">
                                                                                                    <label class="text-info" >Indicadores ei</label>
                                                                                                    <label class="select">
                                                                                                        <select id="input-id_indicador_ei"  name="id_indicador_ei">
                                                                                                            <option value="" >Seleccione...</option>
                                                
                                                                                                        </select> <i></i> 
                                                                                                    </label>
                                                                                                </section>#}

                                                <section class="col col-md-12">

                                                    <label class="text-info" >Accion e.i
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-id_accion_ei"  name="id_accion_ei" >
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i>
                                                    </label>
                                                </section>

                                                <section class="col col-md-12">

                                                    <label class="text-info" >Indicadores a.e.i 
                                                    </label>
                                                    <label class="select">
                                                        <select id="input-id_indicador_aei"  name="id_indicador_aei" >
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i>
                                                    </label>
                                                </section>
                                            {% endif %}



                                            <section class="col col-md-4">
                                                <label class="text-info" > Código</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="{{ id_actividad_aei }}" readonly="">
                                                    {% else %}
                                                        <input type="text" id="input-codigo" name="codigo" placeholder="Código" value="" readonly="">
                                                    {% endif %}


                                                </label>
                                            </section>

                                            <section class="col col-md-2" style="margin-top: 25px;">
                                                <label class="checkbox" style="color: #346597;">
                                                    {% if estado == 'A' or estado == '' %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado">
                                                    {% endif %}
                                                    <i></i>Estado
                                                </label>
                                            </section>  

                                            <section class="col col-md-12"> </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" >
                                                    {#<input type="hidden" id="input-id_actividad_aei" name="id_actividad_aei" value="{{ id_actividad_aei }}">#}
                                                 
                                                    {% if estado !== "" %}
                                                           <input type="hidden" id="input-id_indicador_aei" name="id_indicador_aei" value="{{ id_indicador_aei }}">
                                                        <input type="hidden" id="input-ano_eje" name="ano_eje" value="{{ ano_eje }}">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Unidad Medida  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-unidad_medida " name="unidad_medida" placeholder="Unidad Medida " value="{{ unidad_medida  }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Meta  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-meta" name="meta" placeholder="Meta" value="{{ meta  }}" >
                                                </label>
                                            </section>                                              

                                            <section class="col col-md-2">
                                                <label class="text-info" >Datos  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-datos" name="datos" placeholder="Datos" value="{{ datos  }}" >
                                                </label>
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info" >Avance </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-avance" name="avance" placeholder="Avance" value="{{ avance }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-10">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Orden </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-orden" name="orden" placeholder="Orden" value="{{ orden }}" >
                                                </label>
                                            </section>


                                            <section class="col col-md-12"> <label class="text-info" >- o -</label> </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Monto Programado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_monto_programado" name="gfp_monto_programado" placeholder="gfp_monto_programado" value="{{ gfp_monto_programado  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gfp_monto_programado" name="gfp_monto_programado" placeholder="gfp_monto_programado" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>


                                            <section class="col col-md-12"> <label class="text-info" >Gestión Financiera</label> </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Enero  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_01" name="gfp_01" placeholder="gfp_01" value="{{ gfp_01  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_01" name="gfp_01" placeholder="gfp_01" value="0.00" style="text-align:right;">
                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Febrero </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_02" name="gfp_02" placeholder="gfp_02" value="{{ gfp_02  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_02" name="gfp_02" placeholder="gfp_02" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Marzo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_03" name="gfp_03" placeholder="gfp_03" value="{{ gfp_03  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_03" name="gfp_03" placeholder="gfp_03" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Abril  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_04" name="gfp_04" placeholder="gfp_04" value="{{ gfp_04  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_04" name="gfp_04" placeholder="gfp_04" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Mayo </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_05" name="gfp_05" placeholder="gfp_05" value="{{ gfp_05  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_05" name="gfp_05" placeholder="gfp_05" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Junio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_06" name="gfp_06" placeholder="gfp_06" value="{{ gfp_06  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_06" name="gfp_06" placeholder="gfp_06" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Julio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_07" name="gfp_07" placeholder="gfp_07" value="{{ gfp_07  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_07" name="gfp_07" placeholder="gfp_07" value="0.00" style="text-align:right;">
                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Agosto  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_08" name="gfp_08" placeholder="gfp_08" value="{{ gfp_08  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_08" name="gfp_08" placeholder="gfp_08" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Setiembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_09" name="gfp_09" placeholder="gfp_09" value="{{ gfp_09  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_09" name="gfp_09" placeholder="gfp_09" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Octubre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_10" name="gfp_10" placeholder="gfp_10" value="{{ gfp_10  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_10" name="gfp_10" placeholder="gfp_10" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Noviembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_11" name="gfp_11" placeholder="gfp_11" value="{{ gfp_11  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_11" name="gfp_11" placeholder="gfp_11" value="0.00" style="text-align:right;">

                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Diciembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_12" name="gfp_12" placeholder="gfp_12" value="{{ gfp_12  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_12" name="gfp_12" placeholder="gfp_12" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Total Ejcutado  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_total" name="gfp_total" placeholder="gfp_total" value="{{ gfp_total  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gfp_total" name="gfp_total" placeholder="gfp_total" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>                                            

                                            <section class="col col-md-2">
                                                <label class="text-info" >% Ejecución </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gfp_porcentaje" name="gfp_porcentaje" placeholder="gfp_porcentaje" value="{{ gfp_porcentaje  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gfp_porcentaje" name="gfp_porcentaje" placeholder="gfp_porcentaje" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section> 

                                            <section class="col col-md-12"> <label class="text-info" >Gestión Operativa</label> </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Enero  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    <input type="text" id="input-gop_01" name="gop_01" placeholder="gop_01" value="{{ gop_01 }}" style="text-align:right;">

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Febrero   </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    <input type="text" id="input-gop_02" name="gop_02" placeholder="gop_02" value="{{ gop_02 }}" style="text-align:right;">

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Marzo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                        <input type="text" id="input-gop_03" name="gop_03" placeholder="gop_03" value="{{ gop_03 }}" style="text-align:right;">
                                 
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Abril  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                        <input type="text" id="input-gop_04" name="gop_04" placeholder="gop_04" value="{{ gop_04 }}" style="text-align:right;">

                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Mayo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                      
                                                        <input type="text" id="input-gop_05" name="gop_05" placeholder="gop_05" value="{{ gop_05 }}" style="text-align:right;">
                                 
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Junio </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                 
                                                        <input type="text" id="input-gop_06" name="gop_06" placeholder="gop_06" value="{{ gop_06 }}" style="text-align:right;">
                               
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Julio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    
                                                        <input type="text" id="input-gop_07" name="gop_07" placeholder="gop_07" value="{{ gop_07 }}" style="text-align:right;">
                                      
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Agosto  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    
                                                        <input type="text" id="input-gop_08" name="gop_08" placeholder="gop_08" value="{{ gop_08 }}" style="text-align:right;">

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Setiembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                          
                                                        <input type="text" id="input-gop_09" name="gop_09" placeholder="gop_09" value="{{ gop_09 }}" style="text-align:right;">

                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Octubre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                  
                                                        <input type="text" id="input-gop_10" name="gop_10" placeholder="gop_10" value="{{ gop_10 }}" style="text-align:right;">
                              
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Noviembre </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                        
                                                        <input type="text" id="input-gop_11" name="gop_11" placeholder="gop_11" value="{{ gop_11 }}" style="text-align:right;">

                          
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Diciembre </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                               
                                                        <input type="text" id="input-gop_12" name="gop_12" placeholder="gop_12" value="{{ gop_12 }}" style="text-align:right;">

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Total Ejecutado   </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                       
                                                        <input type="text" id="input-gop_total" name="gop_total" placeholder="gop_total" value="{{ gop_total }}" style="text-align:right;">

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >% Ejecución   </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                   
                                                        <input type="text" id="input-gop_porcentaje" name="gop_porcentaje" placeholder="gop_porcentaje" value="{{ gop_porcentaje }}" style="text-align:right;">

                                      
                                                </label>
                                            </section>

                                        </div> 
                                    </fieldset>

                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
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
<div class="hidden">
    <div id="exito_actividadesaei">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_objetivosei">

        <p>
            Debe seleccionar un Obejtivosei...

        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_indicadoresei">

        <p>
            Debe seleccionar un indicadorei...

        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_accionesei">

        <p>
            Debe seleccionar una accion ei...

        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_indicadoresaei">

        <p>
            Debe seleccionar una indicador aei...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_ano_eje">

        <p>
            Debe seleccionar un año...

        </p>
    </div>
</div>
<script type="text/javascript" >
    var id1 = "";
    var publica = "si";

    {% if id1 is defined %}
        id1 = '{{ id_indicador_aei }}';
    {% endif %}

        //alert(id_indicador_oei);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>