<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<style>
    #tbl_formacion {
        font-size: 11px;
    }

    #tbl_capacitaciones {
        font-size: 11px;
    }

    #tbl_experiencia {
        font-size: 11px;
    }
</style>

<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Postulantes</li>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Postulantes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12" >
                                                <table id="tbl_convocatoria_postulantes" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>			                
                                                        <tr>
                                                            <th data-class="expand">DNI</th>
                                                            <th data-hide="phone,tablet">Apellidos y Nombres</th>
                                                            <th data-hide="phone,tablet">Datos Personales</th>
                                                            <th data-hide="phone,tablet">Formación Académica</th>
                                                            <th data-hide="phone,tablet">Capacitaciones</th>
                                                            <th data-hide="phone,tablet">Experiencia Laboral</th> 
                                                            <th data-hide="phone,tablet">Resumen</th> 
                                                            <th data-hide="phone,tablet">Archivos</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>			
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div>
                                    </fieldset>

                                    <footer>
                                        <a href="javascript:history.back();" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
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
<div id="modal_formacion" style="display: none;">
    <table  id="tbl_formacion" class="table tablecuriosity table-striped table-bordered table-hover" width="100%" >
        <thead>
            <tr>
                <th data-class="expand"> Grado Titulo</th>
                <th> Denominación del Grado/Título alcanzado</th>
                <th data-hide="phone,tablet"> Fecha</th>
                <th data-hide="phone,tablet">País</th>
                <th data-hide="phone,tablet">Centro de Estudios</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div id="modal_capacitaciones" style="display: none;">
    <table id="tbl_capacitaciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>			                
            <tr>
                <th data-class="expand"> Especialidad</th>
                <th data-hide="phone,tablet"> Denominación</th>
                <th data-hide="phone,tablet">Centro de Estudios</th>
                <th data-hide="phone,tablet"> Horas</th>
                <th data-hide="phone,tablet"> Créditos</th>
                <th data-hide="phone,tablet"> Inicio</th>
                <th data-hide="phone,tablet"> Fin</th>
                <th data-hide="phone,tablet"> País</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>				
        </tbody>
    </table>
</div>
<div id="modal_experiencia" style="display: none;">
    <table id="tbl_experiencia" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>			                
            <tr>

                <th data-class="expand"> Especialidad</th>
                <th data-hide="phone,tablet"> Institución </th>
                <th data-hide="phone,tablet"> Cargo</th>
                <th data-hide="phone,tablet"> Inicio</th>
                <th data-hide="phone,tablet"> Fin</th>
                <th data-hide="phone,tablet"> Tiempo</th>


                <th data-hide="phone,tablet"> Funciones </th>
                <th data-hide="phone,tablet"> Archivo</th>

            </tr>
        </thead>
        <tbody>				
        </tbody>
    </table>
</div>
{{ form('','method': 'post','id':'form_funciones','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">            
            <label class="textarea"> 										
                <textarea rows="5" id="input-funciones" name="funciones_ckeditor" placeholder=""></textarea>
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'form_datos_personales','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info" >Imagen del Público </label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_publico"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

            <div id="imagen_publico" class="collapse">

            </div>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Documento</label>
            <label class="select">
                <select id="input-documento"  name="documento" style="pointer-events: none;">
                    <option value="" >Seleccione...</option>
                    {% for documentocolegiado in documentopostulantes %}
                        {% if documentocolegiado.codigo == documento_postulantes %}
                            <option selected="selected" value="{{ documentocolegiado.codigo }}">{{ documentocolegiado.nombres }}</option>   
                        {% else %}
                            <option value="{{ documentocolegiado.codigo }}">{{ documentocolegiado.nombres }}</option>   
                        {% endif %}

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Nro. Documento</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-nro_doc" name="nro_doc"  placeholder="" value="{{ nro_doc }}" readonly>                             
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Nro. RUC</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-nro_ruc" name="nro_ruc"  placeholder="" value="{{ nro_ruc }}" readonly>                             
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Apellido Paterno</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-apellidop"name="apellidop" placeholder="" value="{{apellidop }}" readonly>                             
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Apellido Materno</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-apellidom"name="apellidom" placeholder="" value="{{apellidom }}" readonly>                             
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Nombres</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-nombres"name="nombres" placeholder="" value="{{nombres }}" readonly>
                <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Email</label>
            <label class="input"> <i class="icon-prepend fa fa-at"></i>
                <input type="text" id="input-email" name="email"  placeholder="" value="{{email }}"  readonly>                             
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Fecha de nacimiento</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="" class="" data-dateformat='dd/mm/yy' value="{{  fecha_nacimiento }}" readonly>
            </label>

        </section>

        <section class="col col-md-3">
            <label class="text-info" >Celular</label>
            <label class="input"> <i class="icon-prepend fa fa-mobile-phone"></i>
                <input type="text" id="input-celular" name="celular"  placeholder="" value="{{celular }}"  readonly>                             
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Estado Civil</label>
            <label class="select">
                <select id="input-estado_civil"  name="estado_civil" style="pointer-events: none;">
                    <option value="" >Seleccione...</option>
                    {% for estadocivil_select in estadocivil %}
                        <option value="{{ estadocivil_select.codigo }}">{{ estadocivil_select.nombres }}</option>   
                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Sexo</label>
            <label class="select">
                <select id="input-sexo"  name="sexo" style="pointer-events: none;">
                    <option value="" >Seleccione...</option>
                    {% for sexo_model in sexos %}

                        <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>   

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section> 

        <section class="col col-md-3">
            <label class="text-info" >Region (Ubigeo)</label>
            <label class="select">
                <select id="input-region"  name="region" style="pointer-events: none;">
                    <option value="" >Region</option>
                    {% for reg in regiones %}
                        {% if reg.region == region %}
                            <option selected="selected" value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                        {% else %}
                            <option value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                        {% endif %}

                    {% endfor %}
                </select> <i></i> 
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Provincia (Ubigeo)</label>
            <label class="select">
                <select id="input-provincia"  name="provincia" style="pointer-events: none;">
                    <option value="" >SELECCIONE...</option>

                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Distrito (Ubigeo)</label>
            <label class="select">
                <select id="input-distrito"  name="distrito" style="pointer-events: none;">
                    <option value="" >SELECCIONE...</option>

                </select> <i></i> 
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Nro. Ubigeo</label>
            <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                <input type="text" id="input-ubigeo" name="ubigeo" placeholder="" value="{{ ubigeo }}" readonly>                                              
            </label>
        </section>


        <section class="col col-md-9">
            <label class="text-info" >Dirección Actual</label>
            <label class="input"> <i class="icon-prepend fa fa-home"></i>
                <input type="text" id="input-direccion"name="direccion" placeholder="" value="{{direccion }}" readonly>                             
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Ciudad</label>
            <label class="input"> <i class="icon-prepend fa fa-home"></i>
                <input type="text" id="input-ciudad" name="ciudad" placeholder="" value="{{ciudad }}"  readonly>                             
            </label>
        </section>


        <section class="col col-md-4">
            <label class="text-info" style="margin-top: 6px;margin-bottom: 4px;">Colegio Profesional</label>
            <label class="select">
                <select id="input-colegio_profesional"  name="colegio_profesional" style="pointer-events: none;">
                    <option value="" >SELECCIONE...</option>
                    {% for c_p in colegioprofesional %}
                        <option value="{{ c_p.codigo }}">{{ c_p.nombres }}</option>   
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-2">
            <label class="text-info" style="margin-top: 6px;margin-bottom: 4px;">Nro. Colegiatura</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-colegio_profesional_nro" name="colegio_profesional_nro" placeholder="" value="{{ colegio_profesional_nro }}" readonly>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="checkbox">

                <input type="checkbox" name="discapacitado" value="" id="discapacitado" disabled>

                <i></i>Discapacitado / Nombre discapacidad
            </label>
            {#<label class="text-info"></label>#}
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-discapacitado_nombre" name="discapacitado_nombre" placeholder="" value="" readonly>

            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info">DNI</label>
            <div class="input input-file" id="input-archivo">             
            </div>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Ficha RUC</label>
            <div class="input input-file" id="input-archivo_ruc">
            </div>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Certificado de Habilidad</label>
            <div class="input input-file" id="input-archivo_cp">
            </div>
        </section>
        <section class="col col-md-3">
            <label class="text-info">Certificado de discapacidad</label>
            <div class="input input-file" id="input-archivo_dc">
            </div>
        </section>
    </div>
</fieldset>
{{ endForm() }}


{{ form('reportes/reporteCurriculumVitae','method': 'post','id':'form_cv','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        {#<label class="col-md-2 control-label">Checkbox Styles</label>#}
        <div class="col-md-12">


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-datos_personales" id="input-datos_personales">
                    <span>Datos Personales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-formacion" id="input-formacion">
                    <span>Formación Académica</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones" id="input-capacitaciones">
                    <span>Capacitaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia" id="input-experiencia">
                    <span>Experiencia Laboral</span>
                </label>
            </div>
            <input type="hidden" id="publico" name="publico" value="">
        </div>       
    </div>

</fieldset>
{{ endForm() }}



{{ form('convocatorias/saveResultadosConvocatoria','method': 'post','id':'form_proceso','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Proceso</label>
            <label class="select">
                <select id="input-proceso"  name="proceso" style="">
                    <option value="" >SELECCIONE...</option>
                    {% for resultados_convocatoria_select in resultados_convocatoria %}
                        <option value="{{ resultados_convocatoria_select.codigo }}">{{ resultados_convocatoria_select.nombres }}</option>   
                    {% endfor %}
                </select> <i></i> 
            </label>
            <input type="hidden" id="input-publico" name="publico" value="">
        </section>
    </div>
</fieldset>
{{ endForm() }}


{{ form('convocatoriasganadores/getArchivosGanador','method': 'post','id':'form_archivos_ganador','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        {#<label class="col-md-2 control-label">Checkbox Styles</label>#}
        <div class="col-md-12">


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_datos_personales" id="input-file_datos_personales">
                    <span>Datos Personales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-formacion" id="input-file_formacion">
                    <span>Formación Académica</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones" id="input-file_capacitaciones">
                    <span>Capacitaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia" id="input-file_experiencia">
                    <span>Experiencia Laboral</span>
                </label>
            </div>
            <input type="hidden" id="file_publico" name="file_publico" value="">
        </div>       
    </div>

</fieldset>
{{ endForm() }}

<script type="text/javascript" >
    var convocatoria = "{{convocatoria}}";
</script>
<script type="text/javascript" > var perfil_puesto = "{{ perfil_puesto }}";</script>

