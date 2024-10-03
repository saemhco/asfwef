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
										<!--
										<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
										<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
										-->
									</div>
									<div class="carousel-inner">
										<div class="carousel-item active">
											<img src="{{ url() }}adminpanel/login_vendor/images/home_admision1.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>									
										<!--
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home_admision2.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home_admision3.png" class="d-block w-100" alt="..." style="background: #416cdc;">
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
											<p style="font-size: 12px;">
												La <b style="color: var(--primary);">Universidad Nacional Ciro Alegría</b>, te da la bienvenida y te invita a postular a nuestra casa de estudios.											
												Para conocer el proceso de inscripción, te recomendamos hacer <a target="_blank" href="https://www.unca.edu.pe/proceso-admision.html"><b style="color: var(--primary);">CLIC AQUÍ</b></a>
											
											<!--
											<img src="{{ url() }}adminpanel/login_vendor/images/videotutorial.png" class="img-responsive" style="margin-left: auto;margin-right: auto;width: 40px; padding: 10px;"/>
											
											<button type="button" class="btn btn-secondary btn-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Videotutorial" style="box-shadow: none;">
												<i class="fa fa-video-camera" style="font-size: 14px;"></i>
											</button>
											-->
											</p>
										</div>

										<div class="text-center mb-4">
											<p style="font-size: 22px;">
												<b>PLATAFORMA </b>
												<b style=" color: var(--primary);">DE ADMISIÓN</b>
												
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
					<div class="modal-body">
						{{ form('web/saveNewPostulante','method': 'post','id':'form_registro_postulante','class':'form-horizontal','enctype':'multipart/form-data') }}
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-4">
										<label for="input_documento" class="form-label">Tipo Documento:</label>
										<select id="input_documento_select" class="form-control selectpicker" name="documento">
											<option value="">SELECCIONE...</option>	
											
											
											{% for tipodocumento_select in tipodocumentos %}
													<option value="{{ tipodocumento_select.codigo }}">{{ tipodocumento_select.nombres }}</option>
												{% endfor %}

											<!--
											{% for tipodocumento_select in tipodocumentos %}													
													{% if tipodocumento_select.codigo == 1 %}													
														<option value="{{ tipodocumento_select.codigo }}" selected>{{
                                                        tipodocumento_select.nombres }}</option>													
													{% endif %}													
											{% endfor %}
											-->
										</select>
									</div>
									<div class="col-md-4">
										<label for="input_nro_doc" class="form-label">Número Documento:</label>
										<input type="text" class="form-control" id="input_nro_doc" placeholder="" name="nro_doc">
									</div>
									<div class="col-md-4">
										<label for="input_fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
										<input id="datePicker1" type="text" class="form-control" name="fecha_nacimiento" placeholder="dd/mm/yyyy">
									</div>

								</div>
								<div class="row">
									<div class="col-md-4">
										<label for="input_apellidop" class="form-label">Apellido Paterno:</label>
										<input type="text" class="form-control" id="input_apellidop" placeholder="" name="apellidop">

									</div>
									<div class="col-md-4">
										<label for="input_apellidom" class="form-label">Apellido Materno:</label>
										<input type="text" class="form-control" id="input_apellidom" placeholder="" name="apellidom">
									</div>
									<div class="col-md-4">
										<label for="input_nombres" class="form-label">Nombres:</label>
										<input type="text" class="form-control" id="input_nombres" placeholder="" name="nombres">
										<input type="hidden" id="input_codigo" name="codigo" value="{{ codigo_nuevo_postulante }}">
									</div>

								</div>
								<div class="row">
									<div class="col-md-3">
										<div id="select_region">
											<label for="input_region" class="form-label">Región (Domicilio)</label>

											<select id="input_region_select" class="form-control selectpicker" name="region">
												<option value="">SELECCIONE...</option>
												{% for region_model in regiones %}
													<option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>
												{% endfor %}
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div id="select_provincia">
											<label for="input_provincia" class="form-label">Provincia (Domicilio)</label>

											<select id="input_provincia_select" class="form-control selectpicker" name="provincia">
												<option value="">SELECCIONE...</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div id="select_distrito">
											<label for="input_distrito" class="form-label">Distrito (Domicilio)</label>

											<select id="input_distrito_select" class="form-control selectpicker" name="distrito">
												<option value="">SELECCIONE...</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<label for="input_ubigeo" class="form-label">Nro ubigeo</label>
										<input type="text" class="form-control" id="input_ubigeo" placeholder="Ubigeo" name="ubigeo">
									</div>
									<div class="col-md-8">
										<label for="input_direccion" class="form-label">Dirección</label>
										<input type="text" class="form-control" id="input_direccion" placeholder="" name="direccion">
									</div>
									<div class="col-md-4">
										<label for="input_ciudad" class="form-label">Ciudad</label>
										<input type="text" class="form-control" id="input_ciudad" placeholder="" name="ciudad">
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="" id="select_estado_civil">
											<label for="input_estado_civil" class="form-label">Estado
																																																																								                                                    Civil:</label>
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
										<div id="select_sexo">
											<label for="input_documento" class="form-label">Sexo:</label>
											<select id="input_sexo_select" class="form-control selectpicker" name="sexo">
												<option value="">SELECCIONE...</option>
												{% for sexo_model in sexo %}
													<option value="{{ sexo_model.codigo }}">{{ sexo_model.nombres }}</option>
												{% endfor %}
											</select>
										</div>
									</div>
									<!--
									<div class="col-md-4">
										<div id="select_seguro">
											<label for="input_seguro" class="form-label">Seguro:</label>
											<select id="input_seguro_select" class="form-control selectpicker" name="seguro">
												<option value="">SELECCIONE...</option>
												{% for seguro_model in seguro %}
													<option value="{{ seguro_model.codigo }}">{{ seguro_model.nombres }}</option>
												{% endfor %}
											</select>
										</div>
									</div>
									-->
								
									<div class="col-md-4">
										<label for="input_email" class="form-label">Email:</label>
										<input type="email" class="form-control" id="input_email" placeholder="" name="email">
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<label for="input_telefono" class="form-label">Teléfono:</label>
										<input type="text" class="form-control" id="input_telefono" placeholder="" name="telefono">
									</div>
									<div class="col-md-4">
										<label for="input_celular" class="form-label">Celular:</label>
										<input type="text" class="form-control" id="input_celular" placeholder="" name="celular">
									</div>
								</div>
								<!--
								<div class="row">
									<div class="col-md-12">
										<label for="input_observaciones" class="form-label">Observaciones</label>
										<textarea class="form-control" rows="3" id="input_observaciones" name="observaciones"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">										
										<div class="checkbox">
											<label>
												<input type="checkbox" name="colegio_publico">
												<label for="input_documento" class="form-label">Marcar si estudió en colegio público</label>
											</label>
										</div>
									</div>
								</div>
								-->
								<div class="row">
									<div class="col-md-12">
										<label for="input_colegio_nombre" class="form-label">Nombre de Colegio (Público / Privado)</label>
										<input type="text" class="form-control" id="input_colegio_nombre" placeholder="" name="colegio_nombre">
									</div>
								</div>
								<!--
								<div class="row">
									<div class="col-md-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="sitrabaja">
												<label for="input_documento" class="form-label">Marcar si trabaja</label>
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="input_sitrabaja_nombre" class="form-label">Lugar de trabajo</label>
										<input type="text" class="form-control" id="input_sitrabaja_nombre" placeholder="" name="sitrabaja_nombre">
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="sidepende">
												<label for="input_documento" class="form-label">Marcar si depende de alguien</label>
											</label>											
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="input_sidepende" class="form-label">De quién depende</label>
										<input type="text" class="form-control" id="input_sidepende_nombre" placeholder="" name="sidepende_nombre">
									</div>
								</div>
								-->
								<div class="row">
									<div class="col-md-3">
										<div id="select_region1">
											<label for="input_region1" class="form-label">Región (Lugar de Nacimiento)</label>
											<select id="input_region1_select" class="form-control selectpicker" name="region1">
												<option value="">SELECCIONE...</option>
												{% for region_model in regiones %}
													<option value="{{ region_model.region }}">{{ region_model.descripcion }}</option>
												{% endfor %}
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div id="select_provincia1">
											<label for="input_provincia1" class="form-label">Provincia (Lugar de Nacimiento)</label>
											<select id="input_provincia1_select" class="form-control selectpicker" name="provincia1">
												<option value="">SELECCIONE...</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div id="select_distrito1">
											<label for="input_distrito1" class="form-label">Distrito (Lugar de Nacimiento)</label>
											<select id="input_distrito1_select" class="form-control selectpicker" name="distrito1">
												<option value="">SELECCIONE...</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<label for="input_ubigeo1" class="form-label">Nro ubigeo</label>
										<input type="text" class="form-control" id="input_ubigeo1" placeholder="" name="ubigeo1">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="input_localidad" class="form-label">Localidad</label>
										<input type="text" class="form-control" id="input_localidad" placeholder="" name="localidad">
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="discapacitado">
												<label for="input_documento" class="form-label">Marcar si presenta discapacidad</label>
											</label>												
										</div>
									</div>
								</div>
								


								<div class="row">
									<div class="col-md-6">
										<label for="input_discapacitado_nombre" class="form-label">Nombre de discapacidad</label>
										<input type="text" class="form-control" id="input_discapacitado_nombre" placeholder="" name="discapacitado_nombre">
									</div>
								
									<div class="col-md-6">
										<label for="inputFile" class="form-label">Foto (tamaño carnet .jpg, fondo blanco)</label>
										<input type="text" readonly="" class="form-control" placeholder="Buscar..." >
										<input type="file" id="inputFile" multiple="" name="foto">
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<label for="input_password" class="form-label">Contraseña</label>
										<input type="password" class="form-control" id="input_password" placeholder="" name="password">
									</div>

									<div class="col-md-6">
										<label for="input_password_2" class="form-label">Repetir Contraseña</label>
										<input type="password" class="form-control" id="input_password2" placeholder="" name="password">
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
								<p style="text-align: justify;">Bienvenidos a la Plataforma de Admisión, la cual permite a los postulantes crear una cuenta de usuario y poder inscribirse al proceso de admisión.</p>
								<p style="text-align: justify;">Si ya te registraste accede a la plataforma con tu Nro. de DNI y contraseña.</p>

								<p style="text-align: justify;">
								Para más información sobre el proceso de inscripción comuníquese con nosotros por los siguientes canales:
								<!--
								descargue el siguiente
									<a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-admision.pdf">
										<strong>Manual de usuario del Sistema de Admisión.</strong>
									</a>
								-->
								</p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<p>
									<i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp; Email:
									<a href="mailto:informes@unca.edu.pe">admision@unca.edu.pe</a>
								</p>
							</div>
							<div class="col-md-6">
								<p>
									<i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; Cel. Whatsapp: 910 212 205</p>
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
						<p>Usted se ha registrado correctamente. Inicie sesión para continuar con el proceso de inscripción...</p>
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
		<script src="{{ url() }}adminpanel/login_vendor/js/login_admision/main.js"></script>
	</body>

</html>
