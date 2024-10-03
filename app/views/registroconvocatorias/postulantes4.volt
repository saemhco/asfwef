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
                                                            <th data-hide="phone,tablet">Proyectos</th>
                                                            <th data-hide="phone,tablet">Acciones</th>
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


{{
form('','method':'post','id':'form_datos_generales','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Proyecto (Anexo 02)</label>
            <div class="input input-file" id="input-archivo_proyecto">
            </div>
        </section>

    </div>
</fieldset>
{{ endForm() }}

{{ form('registroconvocatorias/saveResultadosConvocatoria','method':
'post','id':'form_proceso','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info">Puntaje Proyecto</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-puntaje_proyecto" name="puntaje_proyecto" placeholder="" value="">
            </label>
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




<script type="text/javascript">
    var convocatoria = "{{convocatoria}}";
</script>
<script type="text/javascript"> var perfil_puesto = "{{ perfil_puesto }}";</script>