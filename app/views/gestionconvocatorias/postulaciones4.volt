<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro </li><li>Postulaciones</li>
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Postulaciones</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_postulaciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th>
                                        <th data-class="expand"> Fecha</th>
                                        <th>Convocatoria</th>
                                        <th data-hide="phone,tablet">Código</th>
                                         <th data-hide="phone,tablet">Perfil</th>
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

{{ form('gestionconvocatorias/saveConvocatorias','method': 'post','id':'form_convocatorias','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-primary table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3">
                    <center><strong id="input-convocatorias_titular_text"></strong></center>
                    </th>

                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;text-align: center;" width="20%"><strong id="input-convocatoria_perfiles_codigo_text"></strong></td>
                            <td style="vertical-align: middle;text-align: center;"><strong id="input-convocatoria_perfiles_nombre_text"></strong></td>
                            <td style="vertical-align: middle;text-align: center;" width="25%">
                                <div class="form-group">

                                    <a href=""  class="btn btn-warning btn-xs" download id="input-convocatorias_archivo"><i class="fa fa-download"></i> Descargar Anexos</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="input-convocatorias_titular" name="convocatorias_titular" value="">
                <input type="hidden" id="input-convocatoria_perfiles_codigo" name="convocatoria_perfiles_codigo" value="">
                <input type="hidden" id="input-convocatoria_perfiles_nombre" name="convocatoria_perfiles_nombre" value="">
                <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                <input type="hidden" id="input-publico" name="publico" value="{{ publico }}">
                <input type="hidden" id="input-convocatoria" name="convocatoria" value="">
                <input type="hidden" id="input-perfil" name="perfil" value="">
            </div>            
        </section>
        <section class="col col-md-4">
        </section>
        <section class="col col-md-3">

        </section>
    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Adjuntar Anexos</label>
            <div class="input input-file" id="input-anexos">

                <span class="button"><input id="file-archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

            </div>
        </section>
        <section class="col col-md-12">
            <h5><p style="text-align:justify;color:black;font-size: 11px;">Nota: Antes de <strong>confirmar su postulación</strong>, asegúrese de haber registrado y acreditado sus datos correctamente (Datos personales, formación académica y experiencia laboral), a fin de evitar ser descalificado por no cumplir con lo que se indica en las bases del presente proceso de concurso.</p></h5>
        </section>

    </div>
</fieldset>
{{ endForm() }}