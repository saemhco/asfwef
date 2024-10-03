<style>
	.dataTables_filter input {
		width: 335px !important;
	}
</style>
<div
	id="ribbon">

	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Panel</li>
		<li>Gestion de convocatorias</li>
	</ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">

		<div class="col-sm-12">


			<table class="table table-sm table-primary table-bordered">

				<tbody>
					<tr>
						<td>
							<center>
								<h1 style="color: #3276b1;font-weight: bold;">RATIFICACIÓN O PROMOCIÓN Y/O SEPARACIÓN DEL DOCENTE ORDINARIO</h1>
							</center>
						</td>
					</tr>
					<tr>
						<td>

							<div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
								<a class="btn btn-block bg-color-magenta btn-lg txt-color-white" href="{{ url('gestionconvocatorias/datos2') }}" style="width: 505px;margin: 0 auto;
																																																		                                   ">
									<i class="fa fa-user"></i>
									Datos Personales</a>
							</div>


							<div class="center-block" style="margin-bottom: 20px; margin-top: 20px;">
								<a class="btn btn-block bg-color-magenta btn-lg txt-color-white" href="{{ url('gestionconvocatorias/datosgenerales3') }}" style="width: 505px;margin: 0 auto;
																																																		                                   ">
									<i class="fa fa-user"></i>
									Datos Generales</a>
							</div>


						</td>

					</tr>

					<tr>
						<td>
							<center>
								<h1 style="color: #3276b1;font-weight: bold;">Curriculum vitae</h1>
							</center>
						</td>
					</tr>


					<tr>
						<td>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/formacion') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-graduation-cap"></i>
									1.- Grados Académicos y Títulos
																																													                                    Profesionales</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/publicaciones') }}" style="width: 505px;margin: 0 auto;
																																																		                                           ">
									<i class="fa fa-book"></i>2.- Publicaciones, Patentes y Trabajos de Investigación</a>
							</div>
							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/publicaciones') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>3.- Publicaciones, Académicas y Otros</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/capacitaciones') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									4.- Actualizaciones y Capacitaciones</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/cargos') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									5.- Gestión Universitaria en la UNCA</a>
							</div>


							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="javascript:void(0);" onclick="noaplica();" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									6.- Asesoría de Estudiantes de pregrado y posgrado</a>
							</div>
							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="javascript:void(0);" onclick="noaplica();" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									7.- Tutoría de Estudiantes</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/extension') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									8.- Desarrollo de Proyectos y/o Prog. de Res. Social Universitaria</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/reconocimientos') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									9.- Felicitaciones y Reconocimientos</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/idiomas') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									10.- Conocimiento de Idiomas</a>
							</div>

							<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/ofimaticas') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-book"></i>
									11.- Conocimiento de Ofimática y Herramientas Digitales</a>
							</div>

							<!--<div class="center-block" style="margin-bottom: 20px;">
								<a class="btn btn-block btn-lg btn-primary" href="{{ url('gestionconvocatorias/experiencia') }}" style="width: 505px;margin: 0 auto;
																																																		                                       ">
									<i class="fa fa-briefcase"></i>
									Experiencia Docente en la UNCA</a>
							</div>-->
						</td>
					</tr>


				</tbody>
			</table>


		</div>
	</div>
</div>

{{ form('reportes/reporteCurriculumVitae','method':
'post','id':'form_cv','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
	<fieldset class="demo-switcher-1">

		<div
			class="form-group">
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

	{{ form('convocatoriasganadores/getArchivosGanador','method':
'post','id':'form_archivos_ganador','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
		<fieldset class="demo-switcher-1">

			<div
				class="form-group">
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

		<script type="text/javascript">
			// var region_id = "";
// var provincia_id = '';
var publica = "no";
var idl = "";
// var distrito_id = '';
		</script>
		<script type="text/javascript">
			var perfil = "{{ perfil }}";
		</script>
