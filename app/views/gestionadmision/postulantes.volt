<div
	id="ribbon">

	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Panel</li>
		<li>Registro de Admisión Proceso</li>
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
						<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">

							<header>
								<span class="widget-icon">
									<i class="fa fa-user"></i>
								</span>
								<h2>Lista de Postulantes al Proceso de Admisión
								</h2>
							</header>

							<div>
								<input type="hidden" id="codigo_postulante">



								
								<form id="5" method="post" class="form-horizontal">
									<div class="form-group">
										<div class="col-lg-12 selectContainer">
											<select class="form-control" id="admision">

												{% for s in admision %}
												{% if s.codigo == admisiona %}
												<option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
												{% else %}
												<option value="{{ s.codigo }}">{{ s.descripcion }}</option>
												{% endif %}
												{% endfor %}
											</select>
										</div>
									</div>
								</form>


								<div class="jarviswidget-editbox">
									<input class="form-control" type="text">
								</div>
								<div class="widget-body no-padding">
									<div class="widget-body-toolbar">
										<div class="row">
											<div class="col-sm-6">
												
												<a href="javascript:void(0);" onclick="reporte_pdf();" class="btn bg-color-magenta txt-color-white">
													<i class="fa fa-file-pdf-o"></i>
													&nbsp;Reporte
												</a>
												<a href="javascript:void(0);" onclick="reporte_xls()" class="btn btn-success">
													<i class="fa fa-file-excel-o"></i>
													&nbsp;Exportar
												</a>
											</div>
											<div class="col-sm-6 text-center">
												
											</div>
										</div>
									</div>





									<table id="tbl_admision" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th>
													<center>
														<i class="fa fa-check-circle"></i>
													</center>
												</th>

												<th data-hide="phone,tablet">Código</th>
												<th data-hide="phone,tablet">Nro. Doc</th>
												<th data-hide="phone,tablet">Apellidos y Nombres</th>
												<th data-hide="phone,tablet">Fecha Nacimiento</th>
												<th data-hide="phone,tablet">Celular</th>
												<th data-hide="phone,tablet">Correo</th>
												<th data-hide="phone,tablet">Proceso</th>
												<th data-hide="phone,tablet">Carrera</th>
												<th data-hide="phone,tablet">Fecha de Inscripción</th>
												<th data-hide="phone,tablet">Modalidad</th>
												<th data-hide="phone,tablet">Tipo de Inscripción</th>
												<th data-hide="phone,tablet">Archivos</th>																					
												<th data-hide="phone,tablet">Proceso</th>


											</tr>
										</thead>
										<tbody></tbody>
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
				<label class="input">
					<i class="icon-prepend fa fa-calendar"></i>
					<input type="text" id="input-fecha_inicio_pdf" name="fecha_inicio" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
				</label>
			</section>
			<section class="col col-md-6">
				<label class="text-info">Fecha Fin</label>
				<label class="input">
					<i class="icon-prepend fa fa-calendar"></i>
					<input type="text" id="input-fecha_fin_pdf" name="fecha_fin" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
				</label>
			</section>
			<section class="col col-md-12">
				<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);" onclick="reporte_gestionadmision_postulantes_pdf()" id="gestionadmision/postulantes">
					<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Lista de postulantes</a>
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
					<label class="input">
						<i class="icon-prepend fa fa-calendar"></i>
						<input type="text" id="input-fecha_inicio_xls" name="fecha_inicio" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
					</label>
				</section>
				<section class="col col-md-6">
					<label class="text-info">Fecha Fin</label>
					<label class="input">
						<i class="icon-prepend fa fa-calendar"></i>
						<input type="text" id="input-fecha_fin_xls" name="fecha_fin" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
					</label>
				</section>
				<section class="col col-md-12">
					<a class="btn btn-success btn-sm btn-block" href="javascript:void(0);" onclick="reporte_librosprestamos_xls()" id="reporte_librosprestamos_xls">
						<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Exportar Lista de Postulantes
					</a>
				</section>
			</div>
		</fieldset>
		{{ endForm() }}


		{{ form('gestionadmision/downloadArchivosPostulate','method':
'post','id':'form_archivo_postulante','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
			<fieldset>
				<div class="row">
					<section class="col col-md-12">
						<label class="text-info">Selecciona los que deseas descargar o click en cada archivo para poder visualizar</label><br/>
						<label class="select">
							<ul id="checkbox-list" style="list-style:none;"></ul>
						</label>
					</section>
				</div>
			</fieldset>
			{{ endForm() }}


			{{ form('Gestionadmision/saveProcesos','method':
'post','id':'form_procesos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
				<fieldset>
					<div class="row">
						<section class="col col-md-12">
							<label class="text-info">Procesos</label>
							<label class="select">
								<select id="input-proceso" name="proceso">
									<option value="">Seleccione...</option>
									{% for procesosPostulantes_select in procesosPostulantes %}
										<option value="{{ procesosPostulantes_select.codigo }}">{{ procesosPostulantes_select.nombres }}</option>
									{% endfor %}
								</select>
								<i></i>
							</label>
						</section>
					</div>
					<div class="row">
						<section class="col col-md-12">
							<label class="text-info">Observaciones</label>
							<label class="textarea">
								<i class="icon-append fa fa-comment"></i>
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
									<img width="300" height="300" src="" error="this.onerror=null;this.src='';" id="input-imagen"></img>
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
									<img width="300" height="300" src="" error="this.onerror=null;this.src='';" id="input-foto"></img>
							</center>
						</section>
					</div>
				</fieldset>
				{{ endForm() }}

				<!-- Modal Registro Imagen -->
				<div class="modal fade" id="modal_fotox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title" id="myModalLabel">Imagen Foto</h4>
							</div>
							<div class="modal-body">
								<center>
									<img width="240" height="288" src="" error="this.onerror=null;this.src='';" id="input-fotox"></img>
							</center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">
								Cerrar
							</button>
							{#<button type="button" class="btn btn-primary">
																					                    Post Article
																					                </button>#}
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->

			<script type="text/javascript">
				// Ubigeo
var region_id = "";
var provincia_id = '';
var distrito_id = '';

// Lugar de procedencia
var region1_id = "";
var provincia1_id = '';
var distrito1_id = '';

var publica = "no";
			</script>
			<script type="text/javascript">
				var perfil = "{{ perfil }}";
			</script>
