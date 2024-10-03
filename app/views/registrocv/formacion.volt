<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro </li><li>de Formacion Académica</li>
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
                        <a href="javascript:void(0);" onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                <h2>Registro de Formacion Académica</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">	
                                    <div class="widget-body-toolbar">
										<div class="row">
											<div class="col-sm-6 text-right">
												<a href="javascript:void(0);" onclick="exportar()"
													class="btn btn-success"><i class="fa fa-file-excel-o"></i>
													&nbsp;Exportar
												</a>
											</div>
										</div>
									</div>									
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12" >
                                                <table id="tbl_formacion" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>			                
                                                        <tr>
                                                            <th><center><i class="fa fa-check-circle"></i></center></th>
                                                    <th data-class="expand"> Grado Titulo</th>
                                                    <th> Denominación del Grado/Título alcanzado</th>
                                                    <th data-hide="phone,tablet"> Fecha</th>
                                                    <th data-hide="phone,tablet"> Archivo</th>
                                                    <th data-hide="phone,tablet"> Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>				
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div>
                                    </fieldset>
                                    <footer>
                                        <a href="{{ url('registrocv') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
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

{{ form('registrocv/saveFormacion','method': 'post','id':'form_formacion','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info" >Grado</label>
            <label class="select">
                <select id="input-grado"  name="grado" >
                    <option value="">SELECCIONE...</option>
                    {% for grados_select in gradomaximo %}                                       
                        <option value="{{ grados_select.codigo }}">{{ grados_select.nombres }} </option>                                       
                    {% endfor %}
                </select> <i></i>
                <input type="hidden" id="input-codigo" name="codigo" value="">
            </label>
        </section>
        <section class="col col-md-4" >
            <label class="text-info" >Fecha Grado (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_grado" name="fecha_grado" placeholder="Fecha Grado" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info" >País</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-pais" name="pais" placeholder="País" value="">
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Denominación del Grado/Título alcanzado</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="">
            </label>
        </section>
        <section class="col col-md-12">
            <label class="text-info" >Centro de estudios</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-institucion" name="institucion" placeholder="Institución" value="">
            </label>
        </section>

    </div>
    <div class="row">
        <section class="col col-md-6">

            <label class="text-info" >Adjuntar Archivo (Documento que acredita formación académica)</label>
            <div class="input input-file" id="input-archivo">

                <span class="button"><input id="file-archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

    </div>

</fieldset>
{{ endForm() }}
{{ form('','method': 'post','id':'form_reportes_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
		<section class="col col-md-12" style="margin-bottom: 5px;">
			<a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_registrocv_formacion_xls()" id="reporte_registrocv_formacion_xls">
				<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp; Reporte Registro de Formacion Académica
            </a>
		</section>
    </div>
</fieldset>
{{ endForm() }}