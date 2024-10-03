<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet"/>
		<link
		rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/fonts/icomoon/style.css"/>
		<!-- Bootstrap CSS -->
		<link
		rel="stylesheet" href="{{ url() }}adminpanel/vendor/bootstrap-5.0.2/css/bootstrap.min.css"/>
		<!-- Style -->
		<link rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/style.css"/>

		<title>{{ config.global.xNombreAdmin }}</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	</head>
	<body>
		<div class="container-md login">
			<div class="row align-items-center vh-100 ">
				<div class="col-md-12">
					<div class="card" style="box-shadow: 2px 5px 10px grey;">
						<div class="row">
							<div class="col-md-6 col-lg-6 d-none d-md-block px-0">
								<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-indicators">
										<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
										<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
										<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
									</div>
									<div class="carousel-inner">
										<div class="carousel-item active">
											<img src="{{ url() }}adminpanel/login_vendor/images/home_convocatorias_docentes.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
										<!--
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
										-->
									</div>
									<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Anterior</span>
									</button>
									<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Siguiente</span>
									</button>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-12 ">
								<div class="text-center">
									<div class="d-flex align-items-center justify-content-center ">
										<div>
											<img src="{{ url() }}adminpanel/login_vendor/images/logo_unca.jpg" class="img-responsive" style="margin-left: auto;margin-right: auto;width: 200px;padding: 10px;"/>
										</div>

									</div>
									<hr style="margin: 0;"/>
								</div>
								<div class="text-end px-2 py-1">
									<div data-bs-toggle="modal" data-bs-target="#infoModal">
										<button type="button" class="btn btn-secondary btn-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Información" style="box-shadow: none;">
											<i class="fa fa-info" style="font-size: 14px;"></i>
										</button>
									</div>
								</div>
								<div class="mt-2 va-middle">
									<form method="POST" id="login-form">
										<div class="text-center mb-4">
											<p style="font-size: 16px;">
												<b>SISTEMA DE GESTIÓN ADMINISTRATIVA
													<br/><b style=" color: var(--primary);">"CONVOCATORIA DOCENTE"</b>
												</b>
											</p>
										</div>
										<div class="mb-4 mt-2">
											<input type="hidden" name="csrf" value="{{ security.getToken() }}">
											<input type="text" class="form-control" id="username" name="nro_doc_login" placeholder="Número de DNI" autocomplete="off"/>
										</div>										
										<div class="mb-2 mt-2">
											<div class="input-group flex-nowrap">
												<input type="password" id="password" name="password_login" class="form-control shadow-none" id="password" placeholder="Contraseña"/>
												<span toggle="#password-field" class="input-group-text  " style="color:  #9f9f9f;">
													<i class="toggle-password fa fa-fw fa-eye field-icon"></i>
												</span>
											</div>
										</div>
										<div class="mt-2">
											<div class="d-flex justify-content-between recovery">
												<div><input type="checkbox" id="saveAccount"/>
													<span class="caption">Recordar</span>
												</div>
												<a href="{{ url() }}recuperar-contrasenha-web-externo2.html">Recuperar Contraseña</a>
											</div>
										</div>
										<div class="text-center mt-4" id="divLogin">
											<button id="btnLogin" class="btn btn-block btn-primary" type="button" style="width: 100%;height: 40px;">
												Iniciar Sesión
											</button>
										</div>

									</br>
									
									<div class="text-center mt-2">
										<p style="font-size: 12px;">
											¿Aún no tienes usuario?
										</p>
									</div>

										<div class="text-center mt-2" id="divLogin">
											<button class="btn btn-block btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_registro_postulante" type="button" style="width: 100%;height: 40px;">
												Regístrate
											</button>
										</div>

										<br/>
									</form>
								</div>


							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 p-0">
					<div
						class="text-center text-lg-start">
						<!-- Copyright -->
						<div class="text-center" style="font-size:12px;">
							Copyright © 2023 &nbsp;
							<a href="https://www.unca.edu.pe">Universidad Nacional Ciro Alegría</a>
							. Todos los derechos reservados.
						</div>
						<!-- Copyright -->
					</div>
				</div>
			</div>

		</div>

		<!--Modal postulante -->
		<div class="modal fade" id="modal_registro_postulante" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="infoModalLabel">Registro de Postulantes</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div
						class="modal-body">
						{#<p>Se registro postulante correctamente...</p>#}
						{{ form('web/savePublicoConvocatorias','method':
                                'post','id':'form_registro_convocatorias','class':'form-horizontal','enctype':'multipart/form-data')
                                }}
							<div class="container-fluid">
								<div class="row ">
									<div class="col-md-4">
										<div id="select_documento">
											<label for="input_documento" class="form-label">Tipo</label>
											<select id="input_documento_select" class="form-control selectpicker" name="documento">
												<option value="">SELECCIONE...</option>
												{% for tipodocumento_select in tipodocumentos %}
													{% if tipodocumento_select.codigo == 1 %}
														<option value="{{ tipodocumento_select.codigo }}" selected>{{
                                                        tipodocumento_select.nombres }}</option>
													{% endif %}

												{% endfor %}
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="">
											<label for="input_nro_doc" class="form-label">Número</label>
											<input type="text" class="form-control" id="input_nro_doc" placeholder="" name="nro_doc" maxlength="8">
										</div>
									</div>
									<div class="col-md-4">
										<div class="">
											<label for="input_fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
											<input id="datePicker1" type="text" class="form-control" name="fecha_nacimiento" placeholder="dd/mm/yyyy">
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-4">
										<div class="">
											<label for="input_apellidop" class="form-label">Apellido Paterno:</label>
											<input type="text" class="form-control" id="input_apellidop" placeholder="" name="apellidop">
										</div>
									</div>
									<div class="col-md-4">
										<div class="">
											<label for="input_apellidom" class="form-label">Apellido Materno:</label>
											<input type="text" class="form-control" id="input_apellidom" placeholder="" name="apellidom">
										</div>

									</div>
									<div class="col-md-4">
										<div class="">
											<label for="input_nombres" class="form-label">Nombres:</label>
											<input
											type="text" class="form-control" id="input_nombres" placeholder="" name="nombres">
										{#<input type="hidden" id="input_codigo" name="codigo" value="{{ codigo_nuevo_publico }}">#}
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-4">
										<div class="">
											<label for="input_email" class="form-label">Email:</label>
											<input type="email" class="form-control" id="input_email" placeholder="" name="email">
										</div>
									</div>
									<div class="col-md-4">
										<div class="">
											<label for="input_celular" class="form-label">Celular:</label>
											<input type="text" class="form-control" id="input_celular" placeholder="" name="celular">
										</div>
									</div>
									<div class="col-md-4">
										<div class="">
											<label for="input_nacionalidad" class="form-label">Nacionalidad:</label>
											<input type="text" class="form-control" id="input_nacionalidad" placeholder="" name="nacionalidad">
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-12">
										<div class="">
											<label for="input_direccion" class="form-label">Dirección</label>
											<input type="text" class="form-control" id="input_direccion" placeholder="" name="direccion">
										</div>
									</div>
									<div class="col-md-3">
										<div class="" id="select_region">
											<label for="input_region" class="form-label">Región (Actual)</label>

											<select id="input_region_select" class="form-control selectpicker" name="region">
												<option value="">SELECCIONE...</option>
												{% for region_model in regiones %}
													<option value="{{ region_model.region }}">{{
                                                        region_model.descripcion }}</option>
												{% endfor %}
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="" id="select_provincia">
											<label for="input_provincia" class="form-label">Provincia
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                                    (Actual)</label>

											<select id="input_provincia_select" class="form-control selectpicker" name="provincia">
												<option value="">SELECCIONE...</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="" id="select_distrito">
											<label for="input_distrito" class="form-label">Distrito
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                                    (Actual)</label>

											<select id="input_distrito_select" class="form-control selectpicker" name="distrito">
												<option value="">SELECCIONE...</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="">
											<label for="input_ubigeo" class="form-label">Nro ubigeo</label>

											<input type="text" class="form-control" id="input_ubigeo" placeholder="Ubigeo" name="ubigeo">

										</div>
									</div>
									<div class="col-md-4">
										<div class="" id="select_estado_civil">
											<label for="input_estado_civil" class="form-label">Estado Civil:</label>
											<select id="input_estado_civil_select" class="form-control selectpicker" name="estado_civil">
												<option value="">SELECCIONE...</option>
												{% for estadocivil_select in estadocivil %}

													<option value="{{ estadocivil_select.codigo }}">{{
                                                        estadocivil_select.nombres }}</option>
												{% endfor %}
											</select>
										</div>

									</div>
									<div class="col-md-4">
										<div class="" id="select_sexo">
											<label for="input_documento" class="form-label">Sexo:</label>
											<select id="input_sexo_select" class="form-control selectpicker" name="sexo">
												<option value="">SELECCIONE...</option>
												{% for sexo_model in sexo %}
													<option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}
													</option>
												{% endfor %}
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="" id="id_bonificacion">
											<label for="input_documento" class="form-label">Tipo de Bonificacion:</label>
											<select id="input-id_bonificacion" class="form-control selectpicker" name="id_bonificacion">
												<option value="">SELECCIONE...</option>
												{% for tipobonificaciones_model in tipobonificaciones %}
													<option value="{{ tipobonificaciones_model.codigo }}">{{ tipobonificaciones_model.nombres }}
													</option>
												{% endfor %}
											</select>
										</div>
									</div>
								</div>
								<div class="row mt-2" id="input-archivos" style="display:none;">
									<div class="col-md-12">
										<div class="">

											<label for="input_direccion" class="form-label" id="label_archivo">Discapacidad</label>


											<input type="text" class="form-control archivoFile" placeholder="Buscar... (Archivo Menor a 2MB)">
											<input type="file" class="archivoFile">
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-6">
										<div>
											<label for="input_password" class="form-label">Contraseña</label>
											<input type="password" class="form-control" id="input_password" placeholder="" name="password">
										</div>
									</div>
									<div class="col-md-6">
										<div>
											<label for="input_password_2" class="form-label">Repetir
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				                                                    Contraseña</label>
											<input type="password" class="form-control" id="input_password2" placeholder="" name="password">
										</div>
									</div>
								</div>

								<div class="row mt-2"></div>
								<div class="row mt-2">
									<div class="col-md-12">
										<div class="" id="label_politica">
											<input type="checkbox" class="form-check-input" id="chkPolitica" placeholder="" name="chkPolitica" required>
											<label for="input_politica" class="form-label">He leido la <a target="_blank" href="{{ url() }}politica-privacidad.html">Política de Protección de Datos</a> de la Universidad Nacional Ciro ALegría</label>
											
										</div>

									</div>									
								</div>

								
							</div>
							{{ endForm() }}
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-raised btn-danger" data-bs-dismiss="modal">
								Cancelar</button>
							<button type="button" class="btn btn-raised btn-primary" id="btn_grabar_postulantes">
								Guardar</button>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- fin modal registro postulante -->
		<!-- Modal -->
		<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="infoModalLabel">Información</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-12">
								<p style="text-align: justify;">
									Bienvenidos al nuevo portal de Gestión de Convocatoria Docente. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
								</p>
								<p style="text-align: justify;">Para más información sobre el procedimiento de postulación descargue
																																																																																																																																																																																																																																																																																																			                        el siguiente
									<a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-informacion-de-gestion-de-convocatorias-de-concurso-docente-460923.pdf">
										<strong>Manual de usuario del Sistema de Gestión de Convocatorias de la UNCA</strong>
									</a>.</p>
							</div>
							<div class="col-md-12">
								<h5>
									<p style="">Las consultas se pueden realizar por los siguientes medios:
									</p>
								</h5>
								<p style="">Enviando un correo electrónico a:</p>
								<p>
									<i class="fa fa-envelope"></i>&nbsp; Email:
									<a href="mailto:seleccion.docente@unca.edu.pe">seleccion.docente@unca.edu.pe</a>
								</p>
								<p style="text-align: justify;">
									<i class="fa fa-phone"></i>
									&nbsp;Teléfono:  &nbsp;  +51 044 365463</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<!--Modal save postulante -->
		<div class="modal fade" id="modal_save_postulante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
			<div class="modal-dialog animated zoomIn animated-3x" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel4">Mensaje</h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Usted se ha registrado correctamente. Inicie sesión par continuar con el proceso de
																																			                                    inscripción...</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-raised btn-primary" data-bs-dismiss="modal">Cerrar</button>
						{#<button type="button" class="btn btn-raised btn-primary">Save changes</button>#}
					</div>
				</div>
			</div>
		</div>
		<!-- fin modal save postulante -->
		<script type="text/javascript">
			var urlPath = "{{ url() }}";
var base_url = "{{ url() }}";
		</script>
		<script src="https://www.google.com/recaptcha/api.js?render=6LetFsokAAAAANw_8B4sNQTs_kse1Qa8RGkvDJXd"></script>
		<script src="{{ url() }}adminpanel/js/sweetalert2/sweetalert2.all.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/jquery-3.3.1.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/popper.min.js"></script>
		<script src="{{ url() }}adminpanel/vendor/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/login_convocatoria_docente/main.js"></script>
		<script src="{{ url() }}adminpanel/js/viewsweb/login.convocatorias.docentes.js"></script>
	</body>

</html>
