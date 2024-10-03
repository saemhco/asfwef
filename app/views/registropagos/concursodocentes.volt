<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro de Admisión Proceso</li>
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
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Gestión de Pagos - Concursos Docentes</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    <div class="widget-body-toolbar">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="form-control" id="id_admision_enae">
                                                    <option value="0">SELECCIONE CONCURSO</option>
                                                    
                                                    {% for convocatorias_select in convocatorias %}
                                                    {% if convocatorias_select.id_convocatoria == convocatoria_m %}
                                                    
                                                    <option value="{{ convocatorias_select.id_convocatoria }}" selected>{{
                                                        convocatorias_select.titulo }}</option>

                                                    {% else %}

                                                    <option value="{{ convocatorias_select.id_convocatoria }}">{{
                                                        convocatorias_select.titulo }}</option>

                                                    {% endif %}
                                                    {% endfor %}
                                            
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" id="id_proceso">
                                                    <option value="">PROCESO</option>
                                                    
                                                    {% for procesos_select in procesos %}


                                                    <option value="{{ procesos_select.codigo }}">{{
                                                        procesos_select.nombres }}</option>


                                                    {% endfor %}
                                            
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="javascript:void(0);" onclick="reporte_pdf();"
                                                    class="btn bg-color-magenta txt-color-white"><i
                                                        class="fa fa-file-pdf-o"></i>
                                                    &nbsp;Reporte
                                                </a>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="javascript:void(0);" onclick="reporte_xls()"
                                                    class="btn btn-success"><i class="fa fa-file-excel-o"></i>
                                                    &nbsp;Exportar
                                                </a>
                                            </div>
                                        </div>
                                    </div>										

                                    <table id="tbl_admision" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>                                             

                                        <th data-class="expand">Código</th>
                                        <th data-hide="phone,tablet">Apellidos y Nombres</th> 
                                        <th data-hide="phone,tablet">Nro. Doc</th>
                                        <th data-hide="phone,tablet">Celular</th>
                                        <th data-hide="phone,tablet">Email</th>
                                        <th data-hide="phone,tablet">Fecha de Inscripción</th>
                                        <th data-hide="phone,tablet">Nro. Recibo</th>
                                        <th data-hide="phone,tablet">Monto</th>
                                        <th data-hide="phone,tablet">Recibo</th>
                                        <th data-hide="phone,tablet">Foto</th>
                                        <th data-hide="phone,tablet">Proceso</th>

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
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible
        </p>
    </div>
</div>

{{ form('','method': 'post','id':'form_reporte_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_pdf" name="fecha_inicio" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_pdf" name="fecha_fin" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-12">
            <a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
                onclick="reporte_gestionadmision_postulantes_pdf()" id="reporte_gestionadmision_postulantes_pdf"><i
                    class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Lista de postulantes</a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<!-- modal reporte -->
{{ form('','method': 'post','id':'form_reporte_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-6">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_xls" name="fecha_inicio" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-6">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_xls" name="fecha_fin" placeholder="Fecha" class="datepicker"
                    data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-12">
            <a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
                onclick="reporte_gestionadmision_postulantes_xls()" id="reporte_gestionadmision_postulantes_xls"><i
                    class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Exportar Lista de Postulantes
                </a>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('registropagos/saveProcesos','method':
'post','id':'form_procesos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Procesos</label>
            <label class="select">
                <select id="input-proceso_recibo" name="proceso">
                    <option value="">Seleccione...</option>
                    {% for procesosPostulantes_select in procesosPostulantes %}
                    <option value="{{ procesosPostulantes_select.codigo }}">{{ procesosPostulantes_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Observaciones</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="5" id="input-observaciones" name="observaciones" placeholder=""></textarea>
                <input type="hidden" id="input-admision" name="admision" value="">
                <input type="hidden" id="input-postulante" name="postulante" value="">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'modal_registro_voucher','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <center>
                <img width="300" height="300" src=""
                error="this.onerror=null;this.src='';" id="input-imagen"></img>
            </center>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'modal_foto','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <center>
                <img width="300" height="300" src=""
                error="this.onerror=null;this.src='';" id="input-foto"></img>
            </center>
        </section>
    </div>
</fieldset>
{{ endForm() }}


<script type="text/javascript" >
    //Ubigeo
    var region_id = "";
    var provincia_id = '';
    var distrito_id = '';

    //Lugar de procedencia
    var region1_id = "";
    var provincia1_id = '';
    var distrito1_id = '';

    var publica = "no";
    
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

