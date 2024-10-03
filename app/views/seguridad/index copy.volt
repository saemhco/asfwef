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
		<div class="container-md">
			<div class="row align-items-center vh-100 ">

				<div class="col-md-12">
					<div class="card" style="height: 50px;">
						<div class="d-flex align-items-center ">
							<div class="me-auto"></div>
							<ul class="nav nav-pills">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Ayuda</a>
									<ul class="dropdown-menu">
										<li>
											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#infoModal">Manual 1</a>
										</li>
										<li>
											<a class="dropdown-item" href="#">Manual 2</a>
										</li>
									</ul>
								</li>

							</ul>

						</div>
					</div>
					<div class="card">
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
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #007bff;">
											<div class="carousel-caption d-none d-md-block">
												<h5>First slide label</h5>
												<p>Some representative placeholder content for the first slide.</p>
											</div>
										</div>
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #ff9900;">
											<div class="carousel-caption d-none d-md-block">
												<h5>Second slide label</h5>
												<p>Some representative placeholder content for the second slide.</p>
											</div>
										</div>
										<div class="carousel-item">
											<img src="{{ url() }}adminpanel/login_vendor/images/home.png" class="d-block w-100" alt="..." style="background: #007bff;">
											<div class="carousel-caption d-none d-md-block">
												<h5>Third slide label</h5>
												<p>Some representative placeholder content for the third slide.</p>
											</div>
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
								<div class="row" style="height:100%">
									<div class="text-center" style="height: 0;">
										<div class="d-flex align-items-center ">
											<div class="me-auto p-2 ">
												<h3>
													<b>SIGEAD</b>
												</h3>
											</div>
											<div>
												<img src="{{ url() }}adminpanel/login_vendor/images/logo_unca.jpg" class="img-responsive" style="margin-left: auto;margin-right: auto;width: 150PX;padding: 10px;"/>
											</div>
										</div>

										<hr style="margin: 0;"/>
									</div>
									<div class=" va-middle">
										<form method="POST" id="login-form">
											<div class="text-center mt-2 mb-4">
												<h4>
													<b>INICIAR SESIÓN</b>
												</h4>
											</div>
											<div class="mb-4 mt-2">
												<input type="hidden" name="csrf" value="{{ security.getToken() }}">
												<input type="text" class="form-control" id="username" name="usuario" placeholder="Usuario" autocomplete="off"/>
											</div>
											<div class="mb-4 ">
												<div class="input-group flex-nowrap">
													<input type="password" id="password" name="password" class="form-control shadow-none" id="password" placeholder="Contraseña"/>
													<span toggle="#password-field" class="input-group-text  " style="color:  #9f9f9f;">
														<i class="toggle-password fa fa-fw fa-eye field-icon"></i>
													</span>
												</div>
											</div>
											<div class="mt-2">
												<label class="control mb-0">
													<input type="checkbox" id="saveAccount"/>
													<span class="caption">Recordar</span>
												</label>
											</div>
											<div class="text-center mt-5" id="divLogin">
												<button id="btnLogin" class="btn btn-block btn-primary" type="button" style="width: 100%;height: 40px;">
													Iniciar Sesión
												</button>
											</div>

											<br/>
										</form>
									</div>
									<div
										class="text-center text-lg-start">
										<!-- Copyright -->
										<div class="text-center p-3" style="font-size:12px;">
											Copyright © 2023 &nbsp;
											<a href="https://www.unca.edu.pe">Universidad Nacional Ciro Alegría</a>
											. Todos los derechos reservados.
										</div>
										<!-- Copyright -->
									</div>
								</div>
							</div>
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
		<script src="{{ url() }}adminpanel/vendor/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
		<script src="{{ url() }}adminpanel/login_vendor/js/login_admin/main.js"></script>
	</body>
</html></body></html>
