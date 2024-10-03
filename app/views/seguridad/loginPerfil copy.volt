<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet"/>
		<link rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/fonts/icomoon/style.css"/>
		<link
		rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/owl.carousel.min.css"/>
		<!-- Bootstrap CSS -->
		<link
		rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/bootstrap.min.css"/>
		<!-- Style -->
		<link rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/style.css"/>

		<title>{{ config.global.xNombreAdmin }}</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row align-items-center justify-content-center">
				<div class="col-md-6 p-0">
					<div class="row">
						<div class="col-md-12">
							<div id="image_rigth" style="background-image: url('{{ url() }}adminpanel/login_vendor/images/home.png');background-color:#4169e1;height:100vh;background-size: contain;background-repeat: no-repeat;background-position: center;"></div>
						</div>
					</div>
					<div class="row"></div>

					<div class="row">
						<div class="col-md-12"></div>
					</div>

				</div>
				<div class="col-md-6 half">
					<div class="contents">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-8" style="background-color: white;padding: 20px;box-shadow: 5px 3px 36px grey;margin-top:30px">
								<div class="float-right">
									<button type="button" data-toggle="modal" data-target="#infoModal">
										<i class="fa fa-question"></i>
									</button>
								</div><br>
								<div class="mb-2">
									<center>
										<h6>SISTEMA DE INFORMACIÓN PARA LA GESTIÓN DE LA EDUCACIÓN SUPERIOR UNIVERSITARIA</h6>
									</center>
									<center>
										<img src="{{ url() }}adminpanel/login_vendor/images/logo_unca.jpg" class="img-responsive" style="margin-left: auto;margin-right: auto;width: 200px;"/>
									</center>
								</div>
								<form method="POST" id="login-form">
									<div class="form-group">
										<select id="input_tipousuario_select" class="form-control" name="tipousuario">
											<option value="">Seleccione...</option>
											<option value="1">Estudiante / Egresado</option>
											<option value="2">Docente</option>
										</select>
										<input type="hidden" name="csrf" value="{{ security.getToken() }}">
									</div>
									<br/>
									<div class=" row">
										<div class="col-md-8">
											<div class="form-group ">
												<label for="username">E-mail</label>
												<input type="text" class="form-control" id="username" name="email"/>
											</div>
										</div>
										<div class="col-md-4">
											<label for="inputEmail-ñogin" class="control-label" style="color: black !important;font-size: 14px;padding-top: 20px !important;">@unca.edu.pe</label>
										</div>
									</div>

									<br/>
									<div class="form-group">
										<label for="password" name="password">Contraseña</label>
										<input type="password" id="password" name="password" class="form-control" id="password"/>
										<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color: lightgrey;"></span>
									</div>
									<br/>

									<div class="d-flex mb-4 align-items-center">
										<label class="control control--checkbox mb-0">
											<span class="caption">Recordar</span>
											<input type="checkbox" id="saveAccount"/>
											<div class="control__indicator"></div>
										</label>
									</div>
									<div class="row justify-content-md-center">
										<div class="col-md-8">
											<div id="divLogin">
												<button id="btnLogin" class="btn btn-block btn-primary" type="button" style="height: 40px">
													Ingresar
												</button>
											</div>
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-8 mt-1">
											<div id="divLogin2">
												<a href="{{url_google}}" id="btnLogin2" class="btn btn-block btn-danger" type="button" style="height: 40px">
													<i class="fa fa-google" data-fa-mask="fa-solid fa-circle"></i>
													Iniciar con Google
												</a>
											</div>
										</div>
									</div>

									<br/>
								</form>
							</div>
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
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
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
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			var urlPath = "{{ url() }}";
		</script>
		<script src="https://www.google.com/recaptcha/api.js?render=6LetFsokAAAAANw_8B4sNQTs_kse1Qa8RGkvDJXd"></script>
		<script src="{{ url() }}adminpanel/js/sweetalert2/sweetalert2.all.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/jquery-3.3.1.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/popper.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/bootstrap.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/login_perfil/main.js"></script>
	</body>
</html></body></html></body></html>
