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
{% set numero = "" %}
{% set avance = "" %}


{% set unidad_medida = "" %}
{% set meta = "" %}
{% set datos = "" %}
{% set gf_monto_programado = "" %}
{% set gf_01 = "" %}
{% set gf_02 = "" %}
{% set gf_03 = "" %}
{% set gf_04 = "" %}
{% set gf_05 = "" %}
{% set gf_06 = "" %}
{% set gf_07 = "" %}
{% set gf_08 = "" %}
{% set gf_09 = "" %}
{% set gf_10 = "" %}
{% set gf_11 = "" %}
{% set gf_12 = "" %}
{% set gf_total = "" %}
{% set gf_porcentaje = "" %}

{% set go_01 = "" %}
{% set go_02 = "" %}
{% set go_03 = "" %}
{% set go_04 = "" %}
{% set go_05 = "" %}
{% set go_06 = "" %}
{% set go_07 = "" %}
{% set go_08 = "" %}
{% set go_09 = "" %}
{% set go_10 = "" %}
{% set go_11 = "" %}
{% set go_12 = "" %}
{% set go_total = "" %}
{% set go_porcentaje = "" %}


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

{% if actividadesaei.numero is defined %}
    {% set numero = actividadesaei.numero %}
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

{% if actividadesaei.gf_monto_programado  is defined %}
    {% set gf_monto_programado  = actividadesaei.gf_monto_programado  %}
{% endif %}

{% if actividadesaei.gf_01  is defined %}
    {% set gf_01  = actividadesaei.gf_01  %}
{% endif %}

{% if actividadesaei.gf_02  is defined %}
    {% set gf_02  = actividadesaei.gf_02  %}
{% endif %}

{% if actividadesaei.gf_03 is defined %}
    {% set gf_03  = actividadesaei.gf_03  %}
{% endif %}

{% if actividadesaei.gf_04 is defined %}
    {% set gf_04  = actividadesaei.gf_04  %}
{% endif %}

{% if actividadesaei.gf_05 is defined %}
    {% set gf_05  = actividadesaei.gf_05  %}
{% endif %}

{% if actividadesaei.gf_06 is defined %}
    {% set gf_06  = actividadesaei.gf_06  %}
{% endif %}

{% if actividadesaei.gf_07 is defined %}
    {% set gf_07  = actividadesaei.gf_07  %}
{% endif %}

{% if actividadesaei.gf_08 is defined %}
    {% set gf_08  = actividadesaei.gf_08  %}
{% endif %}

{% if actividadesaei.gf_09 is defined %}
    {% set gf_09  = actividadesaei.gf_09  %}
{% endif %}

{% if actividadesaei.gf_10  is defined %}
    {% set gf_10   = actividadesaei.gf_10   %}
{% endif %}

{% if actividadesaei.gf_11   is defined %}
    {% set gf_11   = actividadesaei.gf_11    %}
{% endif %}

{% if actividadesaei.gf_12   is defined %}
    {% set gf_12   = actividadesaei.gf_12    %}
{% endif %}


{% if actividadesaei.gf_total   is defined %}
    {% set gf_total   = actividadesaei.gf_total    %}
{% endif %}

{% if actividadesaei.gf_porcentaje   is defined %}
    {% set gf_porcentaje   = actividadesaei.gf_total    %}
{% endif %}



{% if actividadesaei.go_01  is defined %}
    {% set go_01 = actividadesaei.go_01   %}
{% endif %}

{% if actividadesaei.go_02  is defined %}
    {% set go_02 = actividadesaei.go_02   %}
{% endif %}

{% if actividadesaei.go_03  is defined %}
    {% set go_03 = actividadesaei.go_03   %}
{% endif %}

{% if actividadesaei.go_04  is defined %}
    {% set go_04 = actividadesaei.go_04   %}
{% endif %}

{% if actividadesaei.go_05  is defined %}
    {% set go_05 = actividadesaei.go_05   %}
{% endif %}

{% if actividadesaei.go_06  is defined %}
    {% set go_06 = actividadesaei.go_06  %}
{% endif %}

{% if actividadesaei.go_07  is defined %}
    {% set go_07 = actividadesaei.go_07  %}
{% endif %}

{% if actividadesaei.go_08  is defined %}
    {% set go_08 = actividadesaei.go_08  %}
{% endif %}

{% if actividadesaei.go_09 is defined %}
    {% set go_09 = actividadesaei.go_09  %}
{% endif %}

{% if actividadesaei.go_10 is defined %}
    {% set go_10 = actividadesaei.go_10 %}
{% endif %}

{% if actividadesaei.go_11 is defined %}
    {% set go_11 = actividadesaei.go_11 %}
{% endif %}

{% if actividadesaei.go_12 is defined %}
    {% set go_12 = actividadesaei.go_12 %}
{% endif %}

{% if actividadesaei.go_total is defined %}
    {% set go_total = actividadesaei.go_total %}
{% endif %}

{% if actividadesaei.go_porcentaje is defined %}
    {% set go_porcentaje = actividadesaei.go_porcentaje %}
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
        <li>Panel</li><li>Registrar Actividades A.E.I.E</li>
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
                                <h2>Registro de Actividades A.E.I.E</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('actividadesaeie/save','method': 'post','id':'form_actividadesaeie','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">
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

                                                <section class="col col-md-12">
                                                    <label class="text-info" >Indicadores ei</label>
                                                    <label class="select">
                                                        <select id="input-id_indicador_ei"  name="id_indicador_ei">
                                                            <option value="" >Seleccione...</option>

                                                        </select> <i></i> 
                                                    </label>
                                                </section>

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
                                                        <select id="input-ano_eje"  name="ano_eje" disabled="true">
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
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" checked onclick="return false;"> 
                                                    {% else %}
                                                        <input type="checkbox" name="estado" value="{{ estado }}" id="estado" onclick="return false;">
                                                    {% endif %}
                                                    <i></i>Estado
                                                </label>
                                            </section>

                                            <section class="col col-md-12">

                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="{{ nombre }}" readonly="">
                                                    <input type="hidden" id="input-id_actividad_aei" name="id_actividad_aei" value="{{ id_actividad_aei }}">                                                  
                                                    <input type="hidden" id="input-id_indicador_aei" name="id_indicador_aei" value="{{ id_indicador_aei }}">
                                                    {% if estado !== "" %}<input type="hidden" id="input-ano_eje" name="ano_eje" value="{{ ano_eje }}">{% endif %}


                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Descripción</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="3" id="input-descripcion" name="descripcion" placeholder="Descripción" readonly="">{{ descripcion }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Unidad Medida  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-unidad_medida " name="unidad_medida" placeholder="Unidad Medida " value="{{ unidad_medida  }}" readonly="">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Meta  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-meta" name="meta" placeholder="Meta" value="{{ meta  }}" readonly="">
                                                </label>
                                            </section>                                         


                                            <section class="col col-md-2">
                                                <label class="text-info" >Datos  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-datos" name="datos" placeholder="Datos" value="{{ datos  }}" readonly="">
                                                </label>
                                            </section>



                                            <section class="col col-md-2">
                                                <label class="text-info" >Avance </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-avance" name="avance" placeholder="Avance" value="{{ avance }}" readonly="">
                                                </label>
                                            </section>

                                            <section class="col col-md-10">
                                                <label class="text-info" >Enlace </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-enlace" name="enlace" placeholder="Enlace" value="{{ enlace }}" readonly="">
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >Número </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero" placeholder="Número" value="{{ numero }}" readonly="">
                                                </label>
                                            </section>

                                            <section class="col col-md-12"> <label class="text-info" >- o -</label> </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Monto Programado  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_monto_programado" name="gf_monto_programado" placeholder="gf_monto_programado" value="{{ gf_monto_programado  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_monto_programado" name="gf_monto_programado" placeholder="gf_monto_programado" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-12"> <label class="text-info" >Gestión Financiera</label> </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Enero  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_01" name="gf_01" placeholder="gf_01" value="{{ gf_01  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gf_01" name="gf_01" placeholder="gf_01" value="0.00" style="text-align:right;">
                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Febrero  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_02" name="gf_02" placeholder="gf_02" value="{{ gf_02  }}" style="text-align:right;">
                                                    {% else %}
                                                        <input type="text" id="input-gf_02" name="gf_02" placeholder="gf_02" value="0.00" style="text-align:right;">
                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Marzo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_03" name="gf_03" placeholder="gf_03" value="{{ gf_03  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_03" name="gf_03" placeholder="gf_03" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Abril  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>

                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_04" name="gf_04" placeholder="gf_04" value="{{ gf_04  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_04" name="gf_04" placeholder="gf_04" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Mayo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_05" name="gf_05" placeholder="gf_05" value="{{ gf_05  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_05" name="gf_05" placeholder="gf_05" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Junio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_06" name="gf_06" placeholder="gf_06" value="{{ gf_06  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_06" name="gf_06" placeholder="gf_06" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Julio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_07" name="gf_07" placeholder="gf_07" value="{{ gf_07  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_07" name="gf_07" placeholder="gf_07" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Agosto  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_08" name="gf_08" placeholder="gf_08" value="{{ gf_08  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_08" name="gf_08" placeholder="gf_08" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Setiembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_09" name="gf_09" placeholder="gf_09" value="{{ gf_09  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_09" name="gf_09" placeholder="gf_09" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Octubre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_10" name="gf_10" placeholder="gf_10" value="{{ gf_10  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_10" name="gf_10" placeholder="gf_10" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Noviembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_11" name="gf_11" placeholder="gf_11" value="{{ gf_11  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_11" name="gf_11" placeholder="gf_11" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Diciembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_12" name="gf_12" placeholder="gf_12" value="{{ gf_12  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_12" name="gf_12" placeholder="gf_12" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Total ejecutado (fase devengado)  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_total" name="gf_total" placeholder="gf_total" value="{{ gf_total  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_total" name="gf_total" placeholder="gf_total" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >% ejecución  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-gf_porcentaje" name="gf_porcentaje" placeholder="gf_porcentaje" value="{{ gf_porcentaje  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-gf_porcentaje" name="gf_porcentaje" placeholder="gf_porcentaje" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-12"> <label class="text-info" >Gestión Operativa</label> </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Enero  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_01" name="go_01" placeholder="go_01" value="{{ go_01  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_01" name="go_01" placeholder="go_01" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>  

                                            <section class="col col-md-2">
                                                <label class="text-info" >Febrero  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_02" name="go_02" placeholder="go_02" value="{{ go_02  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_02" name="go_02" placeholder="go_02" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Marzo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_03" name="go_03" placeholder="go_03" value="{{ go_03  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_03" name="go_03" placeholder="go_03" value="0.00" style="text-align:right;">

                                                    {% endif %}

                                                </label>
                                            </section> 

                                            <section class="col col-md-2">
                                                <label class="text-info" >Abril  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_04" name="go_03" placeholder="go_03" value="{{ go_03  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_04" name="go_03" placeholder="go_03" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Mayo  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_05" name="go_05" placeholder="go_05" value="{{ go_05  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_05" name="go_05" placeholder="go_05" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Junio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_06" name="go_06" placeholder="go_06" value="{{ go_06  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_06" name="go_06" placeholder="go_06" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Julio  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_07" name="go_07" placeholder="go_07" value="{{ go_07  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_07" name="go_07" placeholder="go_07" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Agosto  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_08" name="go_08" placeholder="go_08" value="{{ go_08  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_08" name="go_08" placeholder="go_08" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section> 

                                            <section class="col col-md-2">
                                                <label class="text-info" >Setiembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_09" name="go_09" placeholder="go_09" value="{{ go_09  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_09" name="go_09" placeholder="go_09" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Octubre </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_10" name="go_10" placeholder="go_10" value="{{ go_10  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_10" name="go_10" placeholder="go_10" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Noviembre  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_11" name="go_11" placeholder="go_11" value="{{ go_11  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_11" name="go_11" placeholder="go_11" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Diciembre </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_12" name="go_12" placeholder="go_12" value="{{ go_12  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_12" name="go_12" placeholder="go_12" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Total ejecutado  </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_total" name="go_total" placeholder="go_total" value="{{ go_total  }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_total" name="go_total" placeholder="go_total" value="0.00" style="text-align:right;">

                                                    {% endif %}
                                                </label>
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="text-info" >% ejecución   </label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    {% if estado !== "" %}
                                                        <input type="text" id="input-go_porcentaje" name="go_porcentaje" placeholder="go_porcentaje" value="{{ go_porcentaje }}" style="text-align:right;">

                                                    {% else %}
                                                        <input type="text" id="input-go_porcentaje" name="go_porcentaje" placeholder="go_porcentaje" value="0.00" style="text-align:right;">

                                                    {% endif %}
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
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = '{{ id }}';

    {% endif %}

        //alert(id_indicador_aei);
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>