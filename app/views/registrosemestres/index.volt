<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Semestre</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
         <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                  <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center">
                        <a href="{{ url('registrosemestres/registro') }}"  class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        <a href="javascript:void(0);" onclick="parametros();" class="btn btn-success btn-block"><i class="fa fa-key"></i></a>
                    </div>
                </div>
            </div>

        </div>
         <div class="col-sm-11" style="margin-bottom: -30px;">
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de semestres</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_semestres" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             
                                        <th data-class="expand">DESCRIPCIÓN</th>
                                        <th data-hide="phone,tablet">DEFINICIÓN</th>
                                        <th data-hide="phone,tablet">AÑO</th>
                                        <th data-hide="phone,tablet">FECHA INICIO</th>
                                        <th data-hide="phone,tablet">FECHA FIN</th>
                                        <th data-hide="phone,tablet">ACTIVO</th>
                                        <th data-hide="phone,tablet">ESTADO</th>

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
</div>
<div class="hidden" style="background-color: red;">
    <div id="error_fecha">
        <p>
            La fecha final debe ser mayor...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_select_semestre">
        <p>
            El semestre de matricula debe ser mayor al semestre anterior...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_ambos_select">
        <p>
            Debe selecionar los campos anteriores...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_select_semestre_1">
        <p>
            Debe selecionar campo Semestre Matricula...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="error_select_semestre_2">
        <p>
            Debe selecionar campo Semestre Anterior...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="save_semestre">
        <p>
            Se actualizo correctamente...
        </p>
    </div>
</div>

{{ form('registrosemestres/save','method': 'post','id':'form_semestres','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info" >Descripcion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-descripcion" name="descripcion" placeholder="Descripcion" >
                <input type="hidden" id="input-codigo" name="codigo" value="">
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info" >Definición</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-definicion" name="definicion" placeholder="Definición" >
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info" >Semestre</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-semestre" name="semestre" placeholder="Semestre" >
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info" >Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info" >Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin" placeholder="Fecha Fin" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-4">
            <label class="text-info" >Año</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-anio" name="anio" placeholder="Año" >
            </label>
        </section>

        <section class="col col-6">
            <label class="text-info" >Fecha Inicio Notas 1</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_notas1" name="fecha_inicio_notas1" placeholder="Fecha Inicio Notas 1" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-6">
            <label class="text-info" >Fecha Fin Notas 1</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_notas1" name="fecha_fin_notas1" placeholder="Fecha Fin Notas 1" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>


        <section class="col col-6">
            <label class="text-info" >Fecha Inicio Notas 2</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_notas2" name="fecha_inicio_notas2" placeholder="Fecha Inicio Notas 2" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-6">
            <label class="text-info" >Fecha Fin Notas 2</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_notas2" name="fecha_fin_notas2" placeholder="Fecha Fin Notas 2" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>


        <section class="col col-6">
            <label class="text-info" >Fecha Inicio Sustitutorio </label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_sustitutorio" name="fecha_inicio_sustitutorio" placeholder="Fecha Inicio Sustitutorio" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>


        <section class="col col-6">
            <label class="text-info" >Fecha Fin Sustitutorio </label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_sustitutorio" name="fecha_fin_sustitutorio" placeholder="Fecha Fin Sustitutorio" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>


        <section class="col col-6">
            <label class="text-info" >Fecha Inicio Matricula </label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_matricula" name="fecha_inicio_matricula" placeholder="Fecha Inicio Matricula" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>


        <section class="col col-4">
            <label class="text-info" >Fecha Fin Matricula </label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_matricula" name="fecha_fin_matricula" placeholder="Fecha Fin Matricula" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>

        <section class="col col-md-10">
            <label class="text-info" >Observacion</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observacion" name="observacion" ></textarea> 
            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="estado" value="" id="input-estado">
                <i></i>Estado
            </label>
        </section>
    </div>    
</fieldset>
{{ endForm() }}


{{ form('registrosemestres/save_parametros','method': 'post','id':'form_semestres_parametros','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >SEMESTRE MATRICULA</label>
            <label class="select">

                <select id="semestre_matricula"  name="semestre_matricula" >
                    <option value="0" >SELECCIONE...</option>
                    {% for semestre_model in semestres %}                                       
                        <option value="{{ semestre_model.codigo }}">{{ semestre_model.descripcion }}</option>
                    {% endfor %}
                </select> <i></i>

            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >SEMESTRE ANTERIOR</label>
            <label class="select">
                <select id="semestre_anterior"  name="semestre_anterior" >
                    <option value="0" >SELECCIONE...</option>
                    {% for semestre_model in semestres %}                                       
                        <option value="{{ semestre_model.codigo }}">{{ semestre_model.descripcion }}</option>
                    {% endfor %}
                </select> <i></i>

            </label>
        </section>

        {#        {% if asignatura_estado is defined %}
                    <section class="col col-md-4">
                        <label class="checkbox" style="color: #346597;">
                            <input type="checkbox" name="asignaturas" value="" id="input-asignaturas">
                            <i></i>Asignatura Estado
                        </label>
                    </section>
                {% endif %}
        #}

    </div>    
</fieldset>
{{ endForm() }}

<script type="text/javascript" >
    var codigo_parametro = "";
    {% if codigo_parametro is defined %}
        codigo_parametro = {{ codigo_parametro }};
    {% endif %}

        var semestre_m = "";
    {% if semestre_m is defined %}
        semestre_m = {{ semestre_m }};
    {% endif %}

        var semestre_p = "";
    {% if semestre_p is defined %}
        semestre_p = {{ semestre_p }};
    {% endif %}

</script>