{#docentes#}
{% set ciudad = "" %}
{% if docentes.ciudad is defined %}
    {% set ciudad = docentes.ciudad %}
{% endif %}

{% set telefono = "" %}
{% if docentes.telefono is defined %}
    {% set telefono = docentes.telefono %}
{% endif %}

{% set nombres = "" %}
{% if docentes.nombres is defined %}
    {% set nombres = docentes.nombres %}
{% endif %}

{% set email = "" %}
{% if docentes.email is defined %}
    {% set email = docentes.email %}
{% endif %}

{% set email1 = "" %}
{% if docentes.email1 is defined %}
    {% set email1 = docentes.email1 %}
{% endif %}

{% set documento_identidad = "" %}
{% if docentes.documento is defined %}
    {% set documento_identidad = docentes.documento %}
{% endif %}

{% set apellidop = "" %}
{% if docentes.apellidop is defined %}
    {% set apellidop = docentes.apellidop %}
{% endif %}

{% set sexo_docente = "" %}
{% if docentes.sexo is defined %}
    {% set sexo_docente = docentes.sexo %}
{% endif %}

{% set celular = "" %} 
{% if docentes.celular is defined %}
    {% set celular = docentes.celular %}
{% endif %}

{% set seguro_docente = "" %}
{% if docentes.seguro is defined %}
    {% set seguro_docente = docentes.seguro %}
{% endif %}

{% set nro_doc = "" %}
{% if docentes.nro_doc is defined %}
    {% set nro_doc = docentes.nro_doc %}
{% endif %}

{% set apellidom = "" %}
{% if docentes.apellidom is defined %}
    {% set apellidom = docentes.apellidom %}
{% endif %}

{% set direccion = "" %}
{% if docentes.direccion is defined %}
    {% set direccion = docentes.direccion %}
{% endif %}

{% set pais = "" %}
{% if docentes.pais is defined %}
    {% set pais = docentes.pais %}
{% endif %}

{% set ley = "" %}
{% if docentes.ley30220 is defined %}
    {% set ley = docentes.ley30220 %}
{% endif %}

{% set foto = "" %}
{% if docentes.foto is defined %}
    {% set foto = docentes.foto %}
{% endif %}

{% set codigo = "" %}

{% if docentes.codigo is defined %}
    {% set codigo = docentes.codigo %}

{% endif %}

{#docentes_semestre#}
{% set cargo = "" %}
{% if docentes_semestre.cargo is defined %}
    {% set cargo = docentes_semestre.cargo %}
{% endif %}

{% set condicion = "" %}
{% if docentes_semestre.condicion is defined %}
    {% set condicion = docentes_semestre.condicion %}
{% endif %}

{% set categoria = "" %}
{% if docentes_semestre.categoria is defined %}
    {% set categoria = docentes_semestre.categoria %}
{% endif %}

{% set dedicacion = "" %}
{% if docentes_semestre.dedicacion is defined %}
    {% set dedicacion = docentes_semestre.dedicacion %}
{% endif %}

{% set tipo_dependencia = "" %}
{% if docentes_semestre.tipo_dependencia is defined %}
    {% set tipo_dependencia = docentes_semestre.tipo_dependencia %}
{% endif %}

{% set dependencia = "" %}
{% if docentes_semestre.dependencia is defined %}
    {% set dependencia = docentes_semestre.dependencia %}
{% endif %}

{% set investigador = "" %}
{% if docentes_semestre.investigador is defined %}
    {% set investigador = docentes_semestre.investigador %}
{% endif %}

{% set renacyt = "" %}
{% if docentes_semestre.renacyt is defined %}
    {% set renacyt = docentes_semestre.renacyt %}
{% endif %}

{% set pregrado = "" %}
{% if docentes_semestre.pregrado is defined %}
    {% set pregrado = docentes_semestre.pregrado %}
{% endif %}

{% set posgrado = "" %}
{% if docentes_semestre.posgrado is defined %}
    {% set posgrado = docentes_semestre.posgrado %}
{% endif %}

{% set c9 = "" %}
{% if docentes_semestre.c9 is defined %}
    {% set c9 = docentes_semestre.c9 %}
{% endif %}

{% set destacado = "" %}
{% if docentes_semestre.destacado is defined %}
    {% set destacado = docentes_semestre.destacado %}
{% endif %}

{% set hl1 = "" %}
{% if docentes_semestre.hl1 is defined %}
    {% set hl1 = docentes_semestre.hl1 %}
{% endif %}

{% set hl2 = "" %}
{% if docentes_semestre.hl2 is defined %}
    {% set hl2 = docentes_semestre.hl2 %}
{% endif %}

{% set hnl1 = "" %}
{% if docentes_semestre.hnl1 is defined %}
    {% set hnl1 = docentes_semestre.hnl1 %}
{% endif %}

{% set hnl2 = "" %}
{% if docentes_semestre.hnl2 is defined %}
    {% set hnl2 = docentes_semestre.hnl2 %}
{% endif %}

{% set hnl3 = "" %}
{% if docentes_semestre.hnl3 is defined %}
    {% set hnl3 = docentes_semestre.hnl3 %}
{% endif %}

{% set hnl4 = "" %}
{% if docentes_semestre.hnl4 is defined %}
    {% set hnl4 = docentes_semestre.hnl4 %}
{% endif %}

{% set hnl5 = "" %}
{% if docentes_semestre.hnl5 is defined %}
    {% set hnl5 = docentes_semestre.hnl5 %}
{% endif %}

{% set hnl6 = "" %}
{% if docentes_semestre.hnl6 is defined %}
    {% set hnl6 = docentes_semestre.hnl6 %}
{% endif %}

{% set hnl7 = "" %}
{% if docentes_semestre.hnl7 is defined %}
    {% set hnl7 = docentes_semestre.hnl7 %}
{% endif %}

{% set hnl8 = "" %}
{% if docentes_semestre.hnl8 is defined %}
    {% set hnl8 = docentes_semestre.hnl8 %}
{% endif %}

{% set hnl9 = "" %}
{% if docentes_semestre.hnl9 is defined %}
    {% set hnl9 = docentes_semestre.hnl9 %}
{% endif %}

{% set hnl10 = "" %}
{% if docentes_semestre.hnl10 is defined %}
    {% set hnl10 = docentes_semestre.hnl10 %}
{% endif %}

{% set hnl11 = "" %}
{% if docentes_semestre.hnl11 is defined %}
    {% set hnl11 = docentes_semestre.hnl11 %}
{% endif %}

{% set act01 = "" %}
{% if docentes_semestre.act01 is defined %}
    {% set act01 = docentes_semestre.act01 %}
{% endif %}

{% set act02 = "" %}
{% if docentes_semestre.act02 is defined %}
    {% set act02 = docentes_semestre.act02 %}
{% endif %}

{% set act03 = "" %}
{% if docentes_semestre.act03 is defined %}
    {% set act03 = docentes_semestre.act03 %}
{% endif %}

{% set act04 = "" %}
{% if docentes_semestre.act04 is defined %}
    {% set act04 = docentes_semestre.act04 %}
{% endif %}

{% set act05 = "" %}
{% if docentes_semestre.act05 is defined %}
    {% set act05 = docentes_semestre.act05 %}
{% endif %}

{% set act06 = "" %}
{% if docentes_semestre.act06 is defined %}
    {% set act06 = docentes_semestre.act06 %}
{% endif %}

{% set act07 = "" %}
{% if docentes_semestre.act07 is defined %}
    {% set act07 = docentes_semestre.act07 %}
{% endif %}

{% set act08 = "" %}
{% if docentes_semestre.act08 is defined %}
    {% set act08 = docentes_semestre.act08 %}
{% endif %}

{% set personal_academico = "" %}
{% if docentes_semestre.personal_academico is defined %}
    {% set personal_academico = docentes_semestre.personal_academico %}
{% endif %}

{% set cargo_general = "" %}
{% if docentes_semestre.cargo_general is defined %}
    {% set cargo_general = docentes_semestre.cargo_general %}
{% endif %}

{% set situacion_grado_academico_otro = "" %}
{% if docentes_semestre.situacion_grado_academico_otro is defined %}
    {% set situacion_grado_academico_otro = docentes_semestre.situacion_grado_academico_otro %}
{% endif %}

{% set modalidad_ingreso = "" %}
{% if docentes_semestre.modalidad_ingreso is defined %}
    {% set modalidad_ingreso = docentes_semestre.modalidad_ingreso %}
{% endif %}

{% set identidad_etnica = "" %}
{% if docentes_semestre.identidad_etnica is defined %}
    {% set identidad_etnica = docentes_semestre.identidad_etnica %}
{% endif %}

{% set carrera = "" %}
{% if docentes_semestre.carrera is defined %}
    {% set carrera = docentes_semestre.carrera %}
{% endif %}

{% set horario = "" %}
{% if docentes_semestre.horario is defined %}
    {% set horario = docentes_semestre.horario %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if docentes_semestre.estado is defined %}
    {% set estado = docentes_semestre.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Docente</li>
    </ol>
</div>

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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de docente</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('gestiondocentes/save','method': 'post','id':'form_gestiondocentes','class':'smart-form','enctype':'multipart/form-data') }}
                                    <ul id="myTab1" class="nav nav-tabs bordered">
                                        {#<li class="active">
                                            <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i> Información General</a>
                                        </li>#}
                                        <li class="active">
                                            <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i> Información Laboral</a>
                                        </li>
                                        <li>
                                            <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i> Distribucion de Carga Lectiva y No Lectiva</a>
                                        </li>

                                        <li>
                                            <a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i> Actividades Académicas</a>
                                        </li>

                                        <li>
                                            <a href="#s5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i> Tutoría</a>
                                        </li>
                                    </ul>

                                    <div id="myTabContent1" class="tab-content padding-10">
                                        {#                  <div class="tab-pane fade in active" id="s1">
                                                              <fieldset>
                                                                  <div class="row">
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Fotografía Docente</label>
                  
                                                                          <br>
                                                                          <img width="325" height="217" src="{{ url('adminpanel/imagenes/docentes/'~foto) }}" onerror="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/user_unaaa.png') }}';"></img>
                  
                                                                      </section>
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Código del docente</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_titulo" name="docente" placeholder="Codigo" value="{{ codigo }}" readonly>
                                                                              <input type="hidden" id="input_semestre" name="semestre" value="{{ semestre }}">
                                                                          </label>
                                                                      </section>
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info">Docente Universitario - LU 30220</label>
                                                                          <label class="checkbox">
                                                                              {% if ley == 1 %}
                                                                                  <input type="checkbox" name="ley30220" value="{{ ley }}" id="ley" checked disabled> 
                                                                              {% else %}
                                                                                  <input type="checkbox" name="ley30220" value="{{ ley }}" id="ley" disabled>
                                                                              {% endif %}
                                                                              <i></i>&nbsp;</label>
                                                                      </section>
                                                                      <section class="col col-md-4" style="float: right;">
                                                                          <label class="text-info" >Nro. Documento</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_nro_doc" name="nro_doc" placeholder="Nro. Documento" value="{{ nro_doc }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                                                                      <section class="col col-md-4"  style="float: right;">
                                                                          <label class="text-info" >Documento</label>
                                                                          <label class="select">
                                                                              <select id="input_documento"  name="documento" disabled>
                                                                                  <option value="" >Seleccione...</option>
                                                                                  {% for documento in documentos %}
                                                                                      {% if documento.codigo == documento_identidad %}
                                                                                          <option selected="selected" value="{{ documento.codigo }}">{{ documento.nombres }}</option>   
                                                                                      {% else %}
                                                                                          <option value="{{ documento.codigo }}">{{ documento.nombres }}</option>   
                                                                                      {% endif %}
                  
                                                                                  {% endfor %}
                                                                              </select> <i></i> 
                                                                          </label>
                                                                      </section>   
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Apellido paterno</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_apellidop" name="apellidop" placeholder="Apellido Paterno" value="{{ apellidop }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Apellido materno</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_apellidom" name="apellidom" placeholder="Apellido materno" value="{{ apellidom }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Nombres</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_nombres" name="nombres" placeholder="Nombres" value="{{ nombres }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Sexo</label>
                                                                          <label class="select">
                                                                              <select id="input_sexo"  name="sexo" disabled>
                                                                                  <option value="" >Seleccione...</option>
                                                                                  {% for sexo in sexos %}
                                                                                      {% if sexo.codigo == sexo_docente %}
                                                                                          <option selected="selected" value="{{ sexo.codigo }}">{{ sexo.nombres }}</option>   
                                                                                      {% else %}
                                                                                          <option value="{{ sexo.codigo }}">{{ sexo.nombres }}</option>   
                                                                                      {% endif %}
                  
                                                                                  {% endfor %}
                                                                              </select> <i></i> 
                                                                          </label>
                                                                      </section> 
                  
                                                                      <section class="col col-md-8">
                                                                          <label class="text-info" >Dirección</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_direccion" name="direccion" placeholder="Dirección" value="{{ direccion }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Ciudad</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_ciudad" name="ciudad" placeholder="Ciudad" value="{{ ciudad }}"  readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >País</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_pais" name="pais" placeholder="País" value="{{ pais }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Teléfono</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_telefono" name="telefono" placeholder="Teléfono" value="{{ telefono }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Celular</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                              <input type="text" id="input_celular" name="celular" placeholder="Celular" value="{{ celular }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Email - Personal</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                                              <input type="text" id="input_email" name="email" placeholder="E-mail" value="{{ email }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Email - Institucional</label>
                                                                          <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                                              <input type="text" id="input_email1" name="email1" placeholder="E-mail UNAAA" value="{{ email1 }}" readonly>
                  
                                                                          </label>
                                                                      </section>
                  
                                                                      <section class="col col-md-4">
                                                                          <label class="text-info" >Seguro</label>
                                                                          <label class="select">
                                                                              <select id="input_seguro"  name="seguro" disabled>
                                                                                  <option value="" >Seleccione...</option>
                                                                                  {% for seguro in seguros %}
                                                                                      {% if seguro.codigo == seguro_docente %}
                                                                                          <option selected="selected" value="{{ seguro.codigo }}">{{ seguro.nombres }}</option>   
                                                                                      {% else %}
                                                                                          <option value="{{ seguro.codigo }}">{{ seguro.nombres }}</option>   
                                                                                      {% endif %}
                  
                                                                                  {% endfor %}
                                                                              </select> <i></i> 
                                                                          </label>
                                                                      </section> 
                  
                                                                  </div> 
                                                              </fieldset>
                  
                                                          </div>#}
                                        <div class="tab-pane fade in active" id="s2">
                                            <header>
                                                Docente: {{ apellidop }} {{ apellidom }} {{ nombres }}
                                            </header>
                                            <fieldset>
                                                <div class="row">

                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Cargo</label>
                                                        <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                            <input type="text" id="input_cargo" name="cargo" placeholder="Cargo" value="{{ cargo }}" >

                                                            <input type="hidden" id="input_semestre" name="semestre" value="{{ semestre }}">
                                                              <input type="hidden" id="input_docente" name="docente" value="{{ codigo }}">
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Condicion</label>
                                                        <label class="select">
                                                            <select id="input_condicion"  name="condicion" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for co_d in condiciones %}
                                                                    {% if co_d.codigo == condicion %}
                                                                        <option  value="{{ co_d.codigo }}" selected="selected">{{ co_d.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ co_d.codigo }}">{{ co_d.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>
                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Categoria</label>
                                                        <label class="select">
                                                            <select id="input_categoria"  name="categoria" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for ca_d in categoriasdocentes %}
                                                                    {% if ca_d.codigo == categoria %}
                                                                        <option selected="selected" value="{{ ca_d.codigo }}">{{ ca_d.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ ca_d.codigo }}">{{ ca_d.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>
                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Dedicacion</label>
                                                        <label class="select">
                                                            <select id="input_dedicacion"  name="dedicacion" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for re_d in regimendocentes %}
                                                                    {% if re_d.codigo == dedicacion %}
                                                                        <option selected="selected" value="{{ re_d.codigo }}">{{ re_d.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ re_d.codigo }}">{{ re_d.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section> 
                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Tipo de Dependencia</label>
                                                        <label class="select">
                                                            <select id="input_tipo_dependencia"  name="tipo_dependencia" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for ti_d in tipodependencias %}
                                                                    {% if ti_d.codigo == tipo_dependencia %}
                                                                        <option selected="selected" value="{{ ti_d.codigo }}">{{ ti_d.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ ti_d.codigo }}">{{ ti_d.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section> 
                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Dependencia</label>
                                                        <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                            <input type="text" id="input_dependencia" name="dependencia" placeholder="Dependencia" value="{{ dependencia }}" >
                                                        </label>
                                                    </section>
                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Personal Académico</label>
                                                        <label class="select">
                                                            <select id="input_personal_academico"  name="personal_academico" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for p_a in personalacademico %}
                                                                    {% if p_a.codigo == personal_academico %}
                                                                        <option selected="selected" value="{{ p_a.codigo }}">{{ p_a.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ p_a.codigo }}">{{ p_a.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>
                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Cargo General</label>
                                                        <label class="select">
                                                            <select id="input_cargo_general"  name="cargo_general" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for c_g in cargogeneral %}
                                                                    {% if c_g.codigo == cargo_general %}
                                                                        <option selected="selected" value="{{ c_g.codigo }}">{{ c_g.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ c_g.codigo }}">{{ c_g.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Situacion Grado Academico Otro</label>
                                                        <label class="select">
                                                            <select id="input_situacion_grado_academico_otro"  name="situacion_grado_academico_otro" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for s_g_a_o in situaciongradoacademicootro %}
                                                                    {% if s_g_a_o.codigo == situacion_grado_academico_otro %}
                                                                        <option selected="selected" value="{{ s_g_a_o.codigo }}">{{ s_g_a_o.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ s_g_a_o.codigo }}">{{ s_g_a_o.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Modalidad</label>
                                                        <label class="select">
                                                            <select id="input_modalidad_ingreso"  name="modalidad_ingreso" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for m_i in modalidadingreso %}
                                                                    {% if m_i.codigo == modalidad_ingreso %}
                                                                        <option selected="selected" value="{{ m_i.codigo }}">{{ m_i.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ m_i.codigo }}">{{ m_i.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Identidad Étnica</label>
                                                        <label class="select">
                                                            <select id="input_identidad_etnica"  name="identidad_etnica" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for i_e in identidadetnica %}
                                                                    {% if i_e.codigo == identidad_etnica %}
                                                                        <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>

                                                    <section class="col col-md-4">
                                                        <label class="text-info" >Carrera</label>
                                                        <label class="select">
                                                            <select id="input_carrera"  name="carrera" >
                                                                <option value="" >SELECCIONE...</option>
                                                                {% for c in carreras %}
                                                                    {% if c.codigo == carrera %}
                                                                        <option selected="selected" value="{{c.codigo }}">{{ c.descripcion }}</option>   
                                                                    {% else %}
                                                                        <option value="{{ c.codigo }}">{{ c.descripcion }}</option>   
                                                                    {% endif %}

                                                                {% endfor %}
                                                            </select> <i></i> 
                                                        </label>
                                                    </section>

                                                    <header>
                                                        &nbsp;
                                                    </header> 
                                                    <br><br>
                                                    <section class="col col-md-2">
                                                        {# <label class="label">Habilitar / Desabilitar</label>#}
                                                        <div class="inline-group">
                                                            <label class="checkbox">
                                                                {% if investigador == 1 %}
                                                                    <input type="checkbox" name="investigador" value="{{ investigador }}" id="input_investigador" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="investigador" value="{{ investigador }}" id="input_investigador">
                                                                {% endif %}
                                                                <i></i>Investigador</label>
                                                        </div>
                                                    </section>
                                                    <section class="col col-md-2">
                                                        {# <label class="label">Habilitar / Desabilitar</label>#}
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if renacyt == 1 %}
                                                                    <input type="checkbox" name="renacyt" value="{{ renacyt }}" id="input_renacyt" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="renacyt" value="{{ renacyt }}" id="input_renacyt">
                                                                {% endif %}
                                                                <i></i>Renacyt</label>
                                                        </div>
                                                    </section>
                                                    <section class="col col-md-2">
                                                        {# <label class="label">Habilitar / Desabilitar</label>#}
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if pregrado == 1 %}
                                                                    <input type="checkbox" name="pregrado" value="{{ pregrado }}" id="input_pregrado" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="pregrado" value="{{ pregrado }}" id="input_pregrado">
                                                                {% endif %}
                                                                <i></i>Pregrado</label>
                                                        </div>
                                                    </section>

                                                    <section class="col col-md-2">
                                                        {# <label class="label">Habilitar / Desabilitar</label>#}
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if posgrado == 1 %}
                                                                    <input type="checkbox" name="posgrado" value="{{ posgrado }}" id="input_posgrado" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="posgrado" value="{{ posgrado }}" id="input_posgrado">
                                                                {% endif %}
                                                                <i></i>Posgrado</label>
                                                        </div>
                                                    </section>

                                                    <section class="col col-md-2">
                                                        {# <label class="label">Habilitar / Desabilitar</label>#}
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if c9 == 1 %}
                                                                    <input type="checkbox" name="c9" value="{{ c9 }}" id="input_c9" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="c9" value="{{ c9 }}" id="input_c9">
                                                                {% endif %}
                                                                <i></i>C9</label>
                                                        </div>
                                                    </section>

                                                    <section class="col col-md-2">
                                                        {# <label class="label">Habilitar / Desabilitar</label>#}
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if destacado == 1 %}
                                                                    <input type="checkbox" name="destacado" value="{{ destacado }}" id="input_destacado" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="destacado" value="{{ destacado }}" id="input_destacado">
                                                                {% endif %}
                                                                <i></i>Destacado</label>
                                                        </div>
                                                    </section>

                                                </div> 
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane fade" id="s3">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <header>
                                                        Carga Lectiva (Horas)
                                                    </header>                                                    
                                                    <br><br>    
                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Teoría</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hl1" name="hl1" placeholder="" value="{{ hl1 }}" id="input_hl1" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Práctica</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hl2" name="hl2" placeholder="" value="{{ hl2 }}" id="input_hl2" min="0" max="40">
                                                        </label>
                                                    </section>


                                                </div>
                                                <div class="col-md-6">                
                                                    <header>
                                                        Carga No Lectiva (Horas)
                                                    </header>
                                                    <br><br>
                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Investigación</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl1" name="hnl1" placeholder="" value="{{ hnl1 }}" id="input_hnl1" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Responsabilidad Social Universitaria</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl2" name="hnl2" placeholder="" value="{{ hnl2 }}" id="input_hnl2" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Gestión Académica</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl3" name="hnl3" placeholder="" value="{{ hnl3 }}" id="input_hnl3" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Gestión Administrativa</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl4" name="hnl4" placeholder="" value="{{ hnl4 }}" id="input_hnl4" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Gestión de Gobierno</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl5" name="hnl5" placeholder="" value="{{ hnl5 }}" id="input_hnl5" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Actividades de Licenciamiento</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl6" name="hnl6" placeholder="" value="{{ hnl6 }}" id="input_hnl6" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Actividades de mejora continua</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl7" name="hnl7" placeholder="" value="{{ hnl7 }}"  id="input_hnl7" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Autoevaluación y acreditación</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl8" name="hnl8" placeholder="" value="{{ hnl8 }}" id="input_hnl8" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Capacitación</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl9" name="hnl9" placeholder="" value="{{ hnl9 }}" id="input_hnl9" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Participación en eventos académicos, talleres, etc. </li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl10" name="hnl10" placeholder="" value="{{ hnl10 }}" id="input_hnl10" min="0" max="40">
                                                        </label>
                                                    </section>

                                                    <label class="label col col-9">
                                                        <ul style="padding-left: 30px;">
                                                            <li>Otros</li>
                                                        </ul>
                                                    </label>
                                                    <section class="col col-2">
                                                        <label class="input">
                                                            <input type="number" id="input_hnl11" name="hnl11" placeholder="" value="{{ hnl11 }}" id="input_hnl11" min="0" max="40">
                                                        </label>
                                                    </section>
                                                    </fieldset>
                                                </div>                
                                            </div>            

                                        </div>

                                        <div class="tab-pane fade" id="s4">
                                            <header>
                                                Actividades Académicas
                                            </header>
                                            <fieldset>
                                                <div class="row">
                                                    <label class="label col col-6">1.- Preparación de Clases</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act01 == 1 %}
                                                                    <input type="checkbox" name="act01" value="{{ act01 }}" id="input_act01" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act01" value="{{ act01 }}" id="input_act01">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">2.- Dictado de Clases</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act02 == 1 %}
                                                                    <input type="checkbox" name="act02" value="{{ act02 }}" id="input_act02" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act02" value="{{ act02 }}" id="input_act02">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">3.- Elaboración y entraga de Silabos</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act03 == 1 %}
                                                                    <input type="checkbox" name="act03" value="{{ act03 }}" id="input_act03" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act03" value="{{ act03 }}" id="input_act03">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">4.- Investigación Formativa</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act04 == 1 %}
                                                                    <input type="checkbox" name="act04" value="{{ act04 }}" id="input_act04" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act04" value="{{ act04 }}" id="input_act04">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">5.- Elaboración y aplicación de instrumentos de Evaluación</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act05 == 1 %}
                                                                    <input type="checkbox" name="act05" value="{{ act05 }}" id="input_act05" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act05" value="{{ act05 }}" id="input_act05">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">6.- Primer Registro de Notas</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act06 == 1 %}
                                                                    <input type="checkbox" name="act06" value="{{ act06 }}" id="input_act06" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act06" value="{{ act06 }}" id="input_act06">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">7.- Segundo Registro de Notas</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act07 == 1 %}
                                                                    <input type="checkbox" name="act07" value="{{ act07 }}" id="input_act07" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act07" value="{{ act07 }}" id="input_act07">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="label col col-6">8.- Registro Final de Notas (Promedios y Aplazados)</label>
                                                    <section class="col col-1">
                                                        <div class="inline-group">
                                                            <label class="checkbox">

                                                                {% if act08 == 1 %}
                                                                    <input type="checkbox" name="act08" value="{{ act08 }}" id="input_act08" checked>
                                                                {% else %}
                                                                    <input type="checkbox" name="act08" value="{{ act08 }}" id="input_act08">
                                                                {% endif %}
                                                                <i></i></label>
                                                        </div>
                                                    </section>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="tab-pane fade" id="s5">

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-md-12">
                                                        <label class="text-info" >Horario Resumen</label>
                                                        <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                            <textarea rows="5" id="input_horario" name="horario" >{{ horario }}</textarea> 
                                                        </label>
                                                    </section> 
                                                </div>
                                            </fieldset>

                                        </div>

                                    </div>

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
    <div id="guarda_docentes">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>
<script type="text/javascript" >

    var publica = "si";

    //alert("Hola");
    //Ficha por semestre
    {% if sem is defined %}
        var semestreax = "{{ sem }}";
        console.log("Carga semestre seleccionado: " + semestreax);
    {% else %}

        var semestreax = "{{ semestre }}";
        console.log("Carga semestre por defecto: " + semestreax);
    {% endif %}
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>