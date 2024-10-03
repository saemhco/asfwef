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
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #416cdc;">
										</div>
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
												<b>SISTEMA DE INFORMACIÓN PARA LA
													<br/><b style=" color: var(--primary);">
														GESTIÓN DE LA EDUCACIÓN SUPERIOR UNIVERSITARIA</b>
												</b>
											</p>
										</div>
										<div class="mb-4 mt-2">
											<select id="input_tipousuario_select" class="form-control" name="tipousuario">
												<option value="">Seleccione...</option>
												<option value="1">Estudiante / Egresado</option>
												<option value="2">Docente</option>
											</select>
										</div>
										<div class="mb-4 mt-2">
											<input type="hidden" name="csrf" value="{{ security.getToken() }}">
											<div class="row">
												<div class="col-md-8">
													<input type="text" class="form-control" id="username" name="email"/>
												</div>
												<div class="col-md-4">
													<label for="inputEmail-ñogin" class="control-label" style="color: black !important;font-size: 14px;padding-top: 10px !important;">@unca.edu.pe</label>
												</div>
											</div>
										</div>
										<div class="mb-4 mt-2">
											<div class="input-group flex-nowrap">
												<input type="password" id="password" name="password" class="form-control shadow-none" id="password" placeholder="Contraseña"/>
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
												<a href="{{ url() }}recuperar-contrasenha-web.html">Recuperar Contraseña</a>
											</div>
										</div>
										<div class="text-center mt-4" id="divLogin">
											<button id="btnLogin" class="btn btn-block btn-primary" type="button" style="width: 100%;height: 40px;">
												Iniciar Sesión
											</button>
										</div>
										<div class="text-center mt-2">
											<a href="{{url_google}}" id="btnLogin2" class="btn btn-block btn-danger" type="button" style="width: 100%;height: 40px">
												<i class="fa fa-google" data-fa-mask="fa-solid fa-circle"></i>
												Iniciar con Google
											</a>
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
								<div class="text-center mt-1">
									<p>Manuales de Usuario de los Sistemas de Información de la UNCA</p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card" style="box-shadow: none !important;">
									<ul class="list-group">
										<li class="list-group-item list-group-item-action">
											<i class="text-primary fa fa-home"></i>
											<a target="_blank" href="https://www.unca.edu.pe/web-documentos/manual-usuario-sistema-informacion-gestion-matricula.html">
												Gestión de Matricula Online</a>
										</li>
										<li class="list-group-item list-group-item-action">
											<i class="text-success fa fa-user-plus"></i>
											<a target="_blank" href="https://www.unca.edu.pe/web-documentos/manual-usuario-sistema-informacion-gestion-docente.html">
												Gestión Docente</a>
										</li>
										<li class="list-group-item list-group-item-action">
											<i class="text-warning fa fa-user"></i>
											<a target="_blank" href="https://www.unca.edu.pe/web-documentos/manual-usuario-sistema-informacion-gestion-registros-academicos.html">
												Registros Académicos</a>
										</li>
										<li class="list-group-item list-group-item-action">
											<i class="text-success fa fa-file-text"></i>
											<a target="_blank" href="https://www.unca.edu.pe/web-documentos/manual-usuario-plataforma-virtual-biblioteca.html">
												Plataforma Virtual de Biblioteca</a>
										</li>
										<li class="list-group-item list-group-item-action">
											<i class="text-primary fa fa-briefcase"></i>
											<a target="_blank" href="https://www.unca.edu.pe/web-documentos/manual-usuario-plataforma-virtual-bolsa-de-trabajo.html">
												Plataforma Virtual de Bolsa de Trabajo</a>
										</li>

									</ul>
								</div>
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var urlPath = "{{ url() }}";
var base_url = "{{ url() }}";
		</script>
		<script src="https://www.google.com/recaptcha/api.js?render=6LetFsokAAAAANw_8B4sNQTs_kse1Qa8RGkvDJXd"></script>
		<script src="{{ url() }}adminpanel/js/sweetalert2/sweetalert2.all.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/jquery-3.3.1.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/popper.min.js"></script>
		<script src="{{ url() }}adminpanel/vendor/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/login_perfil/main.js"></script>
	</body>
</html>
