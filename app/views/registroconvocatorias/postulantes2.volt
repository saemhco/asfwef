<style>
    .dataTables_filter input {
        width: 335px !important;
    }
</style>
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Postulantes</li>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Postulantes</h2>
                            </header>
                            <!--
                            <div id="success">
                                <p>
                                    Leyenda: <b>DP</b>: Datos Personales, <b>DG</b>: Datos Generales, <b>01. GA</b>: Grados Académicos y Títulos Profesionales, <b>02. PU</b>: Publicaciones, Patentes y Trabajos de Investigación, <b>03. PU</b>: Publicaciones Académicas y Otros, <b>04. CA</b>: Actualizaciones y Capacitaciones, <b>05. GU</b>: Gestión Universitaria, <b>06. AE</b>: Asesoría de Estudiantes (No Aplica), <b>07. TE</b>: Tutoría de Estudiantes (No Aplica), <b>08. PY</b>: Desarrollo de Proyectos, <b>09. DH</b>: Distinciones y Honores, <b>10. CI</b>: Conocimiento de Idiomas, <b>11. CO</b>: Conocimiento de Ofimática y Herramientas Digitales.
                                </p>
                            </div>
                            -->
                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12">
                                                <table id="tbl_convocatoria_postulantes"
                                                    class="table tablecuriosity table-striped table-bordered table-hover"
                                                    width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center><i class="fa fa-check-circle"></i></center>
                                                            </th>

                                                            <th data-hide="expand">DNI</th>
                                                            <th data-hide="phone,tablet"> Apellidos y Nombres</th>
                                                            <th data-hide="phone,tablet">D.Personales</th>
                                                            <th data-hide="phone,tablet">D.Generales</th>                                                            
                                                            <th data-hide="phone,tablet">Colegiatura</th>                                                            
                                                            <th data-hide="phone,tablet">Excepciones</th>                                                            
                                                            <th data-hide="phone,tablet">Títulos</th>                                                            
                                                            <th data-hide="phone,tablet">Publicaciones</th>
                                                            <!--
                                                            <th data-hide="phone,tablet">PU</th>
                                                            -->
                                                            <th data-hide="phone,tablet">Capacitaciones</th>
                                                            <th data-hide="phone,tablet">Experiencia</th>
                                                            <th data-hide="phone,tablet">Cargos</th>
                                                            <th data-hide="phone,tablet">Materiales</th>
                                                            <th data-hide="phone,tablet">Extensión</th>
                                                            <!--
                                                            <th data-hide="phone,tablet">PL</th>
                                                            -->
                                                            <th data-hide="phone,tablet">Distinciones</th>
                                                            <th data-hide="phone,tablet">Idiomas</th>
                                                            <th data-hide="phone,tablet">Asesorías</th>
                                                            <th data-hide="phone,tablet">Ofimática</th>                                                            
                                                            <th data-hide="phone,tablet">R</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div>
                                    </fieldset>

                                    <footer>
                                        <a href="javascript:history.back();" role="button"
                                            class="btn tbn-block btn-primary"><i
                                                class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Volver</a>
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
    <table id="tbl_formacion" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
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

<div id="modal_excepciones" style="display: none;">
    <table id="tbl_excepciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Tipo</th>
                <th data-hide="phone,tablet"> Nombre</th>
                <th data-hide="phone,tablet"> Fecha</th>
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
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Especialidad</th>
                <th> Denominación del curso, diplomado o especialización</th>
                <th data-hide="phone,tablet"> Horas</th>
                <th data-hide="phone,tablet"> Créditos</th>
                <th data-hide="phone,tablet"> Fecha Inicio</th>
                <th data-hide="phone,tablet"> Fecha Fin</th>
                <th data-hide="phone,tablet">País</th>
                <th data-hide="phone,tablet">Centro de Estudios</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="modal_publicaciones" style="display: none;">
    <table id="tbl_publicaciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Tipo</th>
                <th data-hide="phone,tablet"> Nombre</th>
                <th data-hide="phone,tablet"> Fecha</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="modal_cargos" style="display: none;">
    <table id="tbl_cargos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Tipo</th>
                <th data-hide="phone,tablet"> Cargo</th>
                <th data-hide="phone,tablet"> Institución </th>
                <th data-hide="phone,tablet"> Fecha Inicio</th>
                <th data-hide="phone,tablet"> Fecha Fin</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="modal_materiales" style="display: none;">
    <table id="tbl_materiales" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Tipo</th>
                <th data-hide="phone,tablet"> Nombre</th>
                <th data-hide="phone,tablet"> Fecha</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="modal_idiomas" style="display: none;">
    <table id="tbl_idiomas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Especialidad</th>
                <th data-hide="phone,tablet"> Denominación del curso, diplomado o especialización</th>
                <th data-hide="phone,tablet"> Horas</th>
                <th data-hide="phone,tablet"> Fecha Inicio</th>
                <th data-hide="phone,tablet"> Fecha Fin</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<div id="modal_ofimatica" style="display: none;">
    <table id="tbl_ofimatica" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Especialidad</th>
                <th data-hide="phone,tablet"> Denominación del curso, diplomado o especialización</th>
                <th data-hide="phone,tablet"> Horas</th>
                <th data-hide="phone,tablet"> Fecha Inicio</th>
                <th data-hide="phone,tablet"> Fecha Fin</th>
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- original ratificacion
<div id="modal_felicitaciones" style="display: none;">
    <table id="tbl_felicitaciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-hide="phone,tablet"> Tipo de Reconocimiento</th>
                <th data-class="expand"> Nombre de Reconocimiento</th>
                <th data-hide="phone,tablet"> Institución</th>
                <th data-hide="phone,tablet"> Fecha</th>                
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
-->

<!--distinciones concurso docente-->
<div id="modal_felicitaciones" style="display: none;">
    <table id="tbl_felicitaciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-hide="phone,tablet"> Tipo</th>
                <th data-class="expand"> Nombre</th>                
                <th data-hide="phone,tablet"> Fecha</th>                
                <th data-hide="phone,tablet"> Archivo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<div id="modal_asesorias" style="display: none;">
    <table id="tbl_asesorias" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-cpircle"></i></center>
                </th>
                <th data-class="expand"> Grado</th>
                <th> Universidad</th>
                <th data-hide="phone,tablet"> Fecha</th>
                <th data-hide="phone,tablet"> Tesista</th>
                <th data-hide="phone,tablet"> Url</th>

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="modal_extension" style="display: none;">
    <table id="tbl_extension" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Nombre</th>
                <th data-hide="phone,tablet"> Fecha</th>
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
                <th>
                    <center><i class="fa fa-check-circle"></i></center>
                </th>
                <th data-class="expand"> Tipo</th>
                <th data-hide="phone,tablet"> Fecha Inicio</th>
                <th data-hide="phone,tablet"> Fecha Fin</th>
                <th data-hide="phone,tablet"> Tiempo (años)</th>
                <th data-hide="phone,tablet"> Cargo</th>
                <th data-class="phone,tablet"> Tipo Institución</th>
                <th data-hide="phone,tablet"> Institución </th>
                <th data-hide="phone,tablet"> Funciones </th>
                <th data-hide="phone,tablet"> Archivo</th>
                <th data-hide="phone,tablet"> Estado</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
{{ form('','method':
'post','id':'form_funciones','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
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

{{
form('','method':'post','id':'form_datos_personales','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info">Imagen del Público </label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse"
                data-target="#imagen_publico"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

            <div id="imagen_publico" class="collapse">

            </div>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Documento</label>
            <label class="select">
                <select id="input-documento" name="documento" style="pointer-events: none;">
                    <option value="">Seleccione...</option>
                    {% for documentocolegiado in documentopostulantes %}
                    {% if documentocolegiado.codigo == documento_postulantes %}
                    <option selected="selected" value="{{ documentocolegiado.codigo }}">{{ documentocolegiado.nombres }}
                    </option>
                    {% else %}
                    <option value="{{ documentocolegiado.codigo }}">{{ documentocolegiado.nombres }}</option>
                    {% endif %}

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Nro. Documento</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-nro_doc" name="nro_doc" placeholder="" value="{{ nro_doc }}" readonly>
            </label>
        </section>


        <section class="col col-md-3">
            <label class="text-info">Apellido Paterno</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-apellidop" name="apellidop" placeholder="" value="{{apellidop }}" readonly>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Apellido Materno</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-apellidom" name="apellidom" placeholder="" value="{{apellidom }}" readonly>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Nombres</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-nombres" name="nombres" placeholder="" value="{{nombres }}" readonly>
                <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Email</label>
            <label class="input"> <i class="icon-prepend fa fa-at"></i>
                <input type="text" id="input-email" name="email" placeholder="" value="{{email }}" readonly>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Fecha de nacimiento</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="" class=""
                    data-dateformat='dd/mm/yy' value="{{  fecha_nacimiento }}" readonly>
            </label>

        </section>

        <section class="col col-md-3">
            <label class="text-info">Celular</label>
            <label class="input"> <i class="icon-prepend fa fa-mobile-phone"></i>
                <input type="text" id="input-celular" name="celular" placeholder="" value="{{celular }}" readonly>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Nacionalidad</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nacionalidad" name="nacionalidad" placeholder="Nacionalidad" value="">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Dirección Actual</label>
            <label class="input"> <i class="icon-prepend fa fa-home"></i>
                <input type="text" id="input-direccion" name="direccion" placeholder="" value="{{direccion }}" readonly>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Region (Ubigeo)</label>
            <label class="select">
                <select id="input-region" name="region" style="pointer-events: none;">
                    <option value="">Region</option>
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
            <label class="text-info">Provincia (Ubigeo)</label>
            <label class="select">
                <select id="input-provincia" name="provincia" style="pointer-events: none;">
                    <option value="">SELECCIONE...</option>

                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Distrito (Ubigeo)</label>
            <label class="select">
                <select id="input-distrito" name="distrito" style="pointer-events: none;">
                    <option value="">SELECCIONE...</option>

                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Nro. Ubigeo</label>
            <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                <input type="text" id="input-ubigeo" name="ubigeo" placeholder="" value="{{ ubigeo }}" readonly>
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Estado Civil</label>
            <label class="select">
                <select id="input-estado_civil" name="estado_civil" style="pointer-events: none;">
                    <option value="">Seleccione...</option>
                    {% for estadocivil_select in estadocivil %}
                    <option value="{{ estadocivil_select.codigo }}">{{ estadocivil_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Sexo</label>
            <label class="select">
                <select id="input-sexo" name="sexo" style="pointer-events: none;">
                    <option value="">Seleccione...</option>
                    {% for sexo_model in sexos %}

                    <option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Tipo de Bonificacion</label>
            <label class="select">
                <select id="input-id_bonificacion" name="id_bonificacion">
                    <option value="">Seleccione...</option>
                    {% for tipobonificaciones_select in tipobonificaciones %}
                    {% if tipobonificaciones_select.codigo == id_bonificacion %}
                    <option selected="selected" value="{{ tipobonificaciones_select.codigo }}">{{
                        tipobonificaciones_select.nombres }}</option>
                    {% else %}
                    <option value="{{ tipobonificaciones_select.codigo }}">{{ tipobonificaciones_select.nombres }}
                    </option>
                    {% endif %}

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>





    </div>

</fieldset>
{{ endForm() }}

{{
form('','method':'post','id':'form_datos_generales','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">
        <section class="col col-md-6">
            <label class="text-info">Solicitud de inscripción y postulación (Anexo 03)</label>
            <div class="input input-file" id="input-archivo_solicitud">
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info">DNI vigente</label>
            <div class="input input-file" id="input-archivo_dni">
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Sílabo de las asignaturas</label>
            <div class="input input-file" id="input-archivo_silabo">
            </div>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Declaración Jurada. (Anexo 02)</label>
            <div class="input input-file" id="input-archivo_dj">
            </div>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{
form('','method':'post','id':'form_datos_generales2','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info">Colegiatura</label>
            <div class="input input-file" id="input-archivo_colegiatura">
            </div>
        </section>

        <section class="col col-md-4">
            <label class="text-info">Habilitación</label>
            <div class="input input-file" id="input-archivo_habilitacion">
            </div>
        </section>

        <section class="col col-md-4">
            <label class="text-info">CTI</label>
            <div class="input input-file" id="input-archivo_cti">
            </div>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{
form('','method':'post','id':'form_plandeclases','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">


        <section class="col col-md-3">
        </section>

        <section class="col col-md-6">
            <label class="text-info">Plan de Clases</label>
            <div class="input input-file" id="input-archivo_plan">
            </div>
        </section>

        <section class="col col-md-3">
        </section>

    </div>
</fieldset>
{{ endForm() }}




{{ form('registroconvocatorias/saveResultadosConvocatoria','method':
'post','id':'form_proceso','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-8">
            <label class="text-info">Puntaje CV</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-puntaje_cv" name="puntaje_cv" placeholder="" value="">
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Apto cv</label>
            <label class="checkbox">
                <input type="checkbox" name="chk_cv" id="input-chk_cv">
                <i></i></label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observaciones_cv" name="observaciones_cv"></textarea>

            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-8">
            <label class="text-info">Puntaje Examen</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-puntaje_examen" name="puntaje_examen" placeholder="" value="">
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Apto Examen</label>
            <label class="checkbox">
                <input type="checkbox" name="chk_examen" id="input-chk_examen">
                <i></i></label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-8">
            <label class="text-info">Puntaje Entrevista</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-puntaje_entrevista" name="puntaje_entrevista" placeholder="" value="">
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Apto Entrevista</label>
            <label class="checkbox">
                <input type="checkbox" name="chk_entrevista" id="input-chk_entrevista">
                <i></i></label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Proceso</label>
            <label class="select">
                <select id="input-proceso" name="proceso" style="">
                    <option value="0">SELECCIONE...</option>
                    {% for resultados_convocatoria_select in resultados_convocatoria %}
                    <option value="{{ resultados_convocatoria_select.codigo }}">{{
                        resultados_convocatoria_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
            <input type="hidden" id="input-publico" name="publico" value="">
        </section>
    </div>
</fieldset>
{{ endForm() }}


{{ form('reportes/reporteCurriculumVitae','method':
'post','id':'form_cv','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        <div class="col-md-12">
            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-datos_personales"
                        id="input-datos_personales">
                    <span>Datos Personales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-datos_generales"
                        id="input-datos_generales">
                    <span>Datos Generales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-chcti" id="input-chcti">
                    <span>Colegiatura, Habilitación, CTI</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-excepciones" id="input-excepciones">
                    <span>Para evaluar por Excepción</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-formacion" id="input-formacion">
                    <span> Grados Académicos y Títulos Profesionales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones"
                        id="input-capacitaciones">
                    <span> Actualizaciones y Capacitaciones</span>
                </label>
            </div>


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-publicaciones" id="input-publicaciones">
                    <span> Trabajos de investigación y publicaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia" id="input-experiencia">
                    <span> Experiencia académica y profesional</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-cargos" id="input-cargos">
                    <span> Cargos Directivos o Apoyo Administrativo</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-materiales" id="input-materiales">
                    <span> Elaboración de materiales de enseñanza</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-idiomas" id="input-idiomas">
                    <span> Conocimiento de Idiomas</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-asesorias" id="input-asesorias">
                    <span> Asesoría de tesis</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-extension" id="input-extension">
                    <span>Actividades de Proyección Social y/o Extensión Cultura</span>
                </label>
            </div>

            <input type="hidden" id="publico" name="publico" value="">

        </div>
    </div>

</fieldset>
{{ endForm() }}


{{ form('convocatoriasganadores/getArchivosGanador','method':
'post','id':'form_archivos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        <div class="col-md-12">

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_datos_personales"
                        id="input-file_datos_personales">
                    <span>Datos Personales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_datos_generales"
                        id="input-file_datos_generales">
                    <span>Datos Generales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_chcti" id="input-file_chcti">
                    <span>Colegiatura, Habilitación, CTI</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_excepciones"
                        id="input-file_excepciones">
                    <span>Para evaluar por Excepción</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-formacion" id="input-file_formacion">
                    <span>Grados Académicos y Títulos Profesionales</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-capacitaciones"
                        id="input-file_capacitaciones">
                    <span>Actualizaciones y Capacitaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-file_publicaciones"
                        id="input-file_publicaciones">
                    <span> Trabajos de investigación y publicaciones</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-experiencia"
                        id="input-file_experiencia">
                    <span>Experiencia académica y profesional</span>
                </label>
            </div>


            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-cargos" id="input-file_cargos">
                    <span> Cargos Directivos o Apoyo Administrativo</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-materiales" id="input-file_materiales">
                    <span> Elaboración de materiales de enseñanza</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-idiomas" id="input-file_idiomas">
                    <span> Conocimiento de Idiomas</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-asesorias" id="input-file_asesorias">
                    <span> Asesoría de tesis</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox style-0" name="input-extension" id="input-file_extension">
                    <span>Actividades de Proyección Social y/o Extensión Cultura</span>
                </label>
            </div>

            <input type="hidden" id="file_publico" name="file_publico" value="">

        </div>

    </div>



</fieldset>
{{ endForm() }}


{{ form('','method':
'post','id':'formcv','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset class="demo-switcher-1">

    <div class="form-group">
        <div class="col-md-12">
            <input type="hidden" id="file_publico" name="file_publico" value="">

            <button type="button" class="btn btn-primary btn-xs btn-block" id="generar_cv">
                <i class="fa fa-file-pdf-o"></i> Generar CV
            </button>
            <div class="alert alert-success fade in" id="mensajecv1">

                <i class="fa-fw fa fa-warning"></i>
                Cv generado.
            </div>
            <div class="alert alert-warning fade in" id="mensajecv2">
                <i class="fa-fw fa fa-warning"></i>
                Aun no ha generado cv.
            </div>
            <span id="alerta_cv" style="display: none;" class="text-danger errorforms">Es necesario generar su
                cv...</span>

        </div>



    </div>



</fieldset>
{{ endForm() }}


<script type="text/javascript">
    var convocatoria = "{{convocatoria}}";
</script>
<script type="text/javascript"> var perfil_puesto = "{{ perfil_puesto }}";</script>