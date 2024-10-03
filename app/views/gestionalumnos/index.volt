<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Panel</li>
		<li>Relación de Estudiantes</li>
	</ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
			<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
				data-widget-custombutton="false" data-widget-sortable="false">
				<header class="">
					<center style="margin-top: -5px !important;">
						<span class="widget-icon">Opciones</span>
					</center>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body text-center">

						{#<a href="javascript:void(0);" onclick="editar();" class="btn btn-primary btn-block"><i class="fa fa-check-circle-o"></i></a>#}
						<a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="detalle_alumnos();"
							class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
							data-original-title="Detalle Estudiantes">
							<i class="fa fa-list"></i>
						</a>
						<a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="record();"
							class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
							data-original-title="Historial Académico">
							<i class="fa fa-book"></i>
						</a>
						<a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="rectificar();"
							class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
							data-original-title="Rectificar Matrícula">
							<i class="fa fa-table"></i>
						</a>
						<a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="convalidacion_registro();"
							class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
							data-original-title="Convalidacion">
							<i class="fa fa-list"></i>
						</a>
						<a style="margin-bottom: 6px;" href="javascript:void(0);" onclick="verificar_requisitos();"
							class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
							data-original-title="Verificar Requisitos">
							<i class="fa fa-file-archive-o"></i>
						</a>
						<a href="javascript:void(0);" onclick="restablecer_matricula();"
							class="btn btn-primary btn-block" rel="tooltip" data-placement="top"
							data-original-title="Restablecer Matrícula">
							<i class="fa fa-refresh"></i>
						</a>


					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-11" style="margin-bottom: -30px;">
			<section id="widget-grid" class="">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
							data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
							data-widget-colorbutton="false" data-widget-custombutton="false"
							data-widget-sortable="false" data-widget-togglebutton="false">

							<header>
								<span class="widget-icon">
									<i class="fa fa-user"></i>
								</span>
								<h2>Registro de Estudiantes</h2>
							</header>

							<div>
								<div class="jarviswidget-editbox">
									<input class="form-control" type="text">
								</div>
								<div class="widget-body no-padding">
									<div class="widget-body-toolbar">
										<div class="row">
											<div class="col-sm-4">
												<select class="form-control" id="semestre">
													<option value="">--SELECCIONE SEMESTE--</option>
													{% if sem is defined %}
													{% for s in semestres %}
													{% if s.codigo == sem %}
													<option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
													{% else %}
													<option value="{{ s.codigo }}">{{ s.descripcion }}</option>
													{% endif %}
													{% endfor %}
													{% else %}
													{% for s in semestres %}
													{% if s.codigo == semestrea %}
													<option value="{{ s.codigo }}" selected>{{ s.descripcion }}</option>
													{% else %}
													<option value="{{ s.codigo }}">{{ s.descripcion }}</option>
													{% endif %}
													{% endfor %}
													{% endif %}
												</select>
											</div>
											<div class="col-sm-4 text-center">
												<a href="javascript:void(0);" onclick="reportes()"
													class="btn bg-color-magenta txt-color-white">
													<i class="fa fa-file-pdf-o"></i>
													&nbsp;Reportes
												</a>
											</div>
											<div class="col-sm-4 text-right">
												<a href="javascript:void(0);" onclick="exportar()"
													class="btn btn-success"><i class="fa fa-file-excel-o"></i>
													&nbsp;Exportar
												</a>
											</div>
										</div>
									</div>
									<table id="tbl_alumnos"
										class="table tablecuriosity table-striped table-bordered table-hover"
										width="100%">
										<thead>
											<tr>
												<th>
													<center>
														<i class="fa fa-check-circle"></i>
													</center>
												</th>


												<th data-class="expand">Código</th>
												<th>Programa de estudios</th>
												<th>Apellidos y Nombres</th>
												<th data-hide="phone,tablet">Nro. Doc.</th>
												<th data-hide="phone,tablet">Celular</th>
												<th data-hide="phone,tablet">Estado</th>
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

<!-- Modal Requisitos-->
<div class="modal fade" id="modal_verificar_requisitos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">REQUISITOS</h4>
			</div>
			<div class="modal-body">
				{{ form('gestionalumnos/saverequisitos','method': 'post','id':'form_requisitos','class':"form-horizontal") }}

				<fieldset class="demo-switcher-1">
					<legend>Proceso de Matricula</legend>
					<div class="form-group">
						{#<label class="col-md-2 control-label">Checkbox Styles</label>#}
						<div class="col-md-10">

							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="registros_academicos"
										id="input_registros_academicos">
									<span><font size="1">Ingreso del Estudiante</font></span>
								</label>
							</div>

							

							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="servicio_social"
										id="input_servicio_social">
									<span><font size="1">Ficha de Evaluación Socioeconómica Familiar</font></span>
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="servicio_salud"
										id="input_servicio_salud">
									<span><font size="1">Examen Médico</font></span>
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="servicio_psicopedagogico"
										id="input_servicio_psicopedagogico">
									<span><font size="1">Examen Psicológico</font></span>
								</label>
							</div>

							<!--
							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="servicio_deportivo"
										id="input_servicio_deportivo">
									<span>Servicios Deportivos</span>
								</label>
							</div>
						

							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="servicio_cultural"
										id="input_servicio_cultural">
									<span>Servicios Cultural</span>
								</label>
							</div>
							-->

							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="resolucion_matricula_especial"
										id="input_resolucion_matricula_especial">
									<span><font size="1">Evaluación de la Encuesta Estudiantil</font></span>
								</label>
							</div>


							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkbox style-0" name="voucher" id="input_voucher">
									<span><font size="1">Comprobante de Pago por Derecho de Matrícula (Según Corresponda)</font></span>
								</label>
							</div>


							
							<input type="hidden" class="" name="key_requisitos_semestre" value=""
								id="key_requisitos_semestre">
							<input type="hidden" class="" name="key_requisitos_alumno" value=""
								id="key_requisitos_alumno">

						</div>
					</div>

				</fieldset>

				{{ endForm() }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button" class="btn btn-primary" id="btn_requisitos">
					Aceptar
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="hidden">
	<div id="error_agregar">
		<p>
			Opcion no disponible...
		</p>
	</div>
</div>
{{ form('','method': 'post','id':'form_reportes_pdf','class':'smart-form','style':'display:none;') }}
<fieldset>
	<div class="row">
		<section class="col col-md-12" style="margin-top: -5px;">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_ficha_matricula()" id="reporte_ficha_matricula">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Ficha de Matrícula</a>
		</section>
		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_promedio()" id="reporte_promedio">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Boleta de Notas</a>
		</section>
		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_boleta_notas_promedio()" id="reporte_boleta_notas_promedio">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp; Reporte Boleta de Notas Promedio</a>
		</section>

		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_horario()" id="reporte_horario">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Horario</a>
		</section>

		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_convalidacion()" id="reporte_convalidacion">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Convalidación</a>
		</section>
		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="constancia_matricula()" id="constancia_matricula">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Constancia de Matricula</a>
		</section>
		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="constancia_egresado()" id="constancia_egresado">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Constancia de Egresado</a>
		</section>
		<section class="col col-md-12">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_ficha_socioeconomica()" id="constancia_extracurricular">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte Ficha Socioeconómica</a>
		</section>
		<section class="col col-md-12" style="margin-bottom: 5px;">
			<a class="btn bg-color-magenta txt-color-white btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_lista_estudiantes_pdf()" id="reporte_lista_estudiantes_pdf">
				<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;&nbsp;Reporte lista de estudiantes</a>
		</section>
	</div>
</fieldset>
{{ endForm() }}
{{ form('','method': 'post','id':'form_reportes_xls','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
		<section class="col col-md-12" style="margin-bottom: 5px;">
			<a class="btn btn-success btn-sm btn-block" href="javascript:void(0);"
				onclick="reporte_lista_estudiantes_xls()" id="reporte_lista_estudiantes_pdf">
				<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Reporte lista de estudiantes</a>
		</section>
    </div>
</fieldset>
{{ endForm() }}
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
	{% if sem is defined %}
	var semestreax = "{{ sem }}";
	console.log("Carga semestre seleccionado: " + semestreax);
	{% else %}
	var semestreax = "{{ semestrea }}";
	// console.log("Carga semestre por defecto: " + semestreax);
	{% endif %}
</script>
<script type="text/javascript">
	var perfil = "{{ perfil }}";
</script>