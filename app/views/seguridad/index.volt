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
		rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/bootstrap.min.css"/>
		<!-- Style -->
		<link rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/style2.css"/>

		<title>{{ config.global.xNombreAdmin }}</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	</head>
	<body>
		<div class="d-lg-flex half">
			<div id="image_rigth" class="bg order-2 order-md-1" style="background-image: url('{{ url() }}adminpanel/login_vendor/images/home.png');background-color:#4169e1"></div>
			<div class="contents order-1 order-md-2">
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-md-7" style="background-color: white;padding: 20px;box-shadow: 5px 3px 36px grey;margin-top:30px;">
							<div class="mb-2">
								<center>
									<img src="{{ url() }}adminpanel/login_vendor/images/logo_unca.jpg" class="img-responsive" style="margin-left: auto;margin-right: auto;width: 200px;">
								</center>
								<br/>
								<center>
									<h4>SISTEMA DE GESTIÓN
										<br>
										<b style="color:#416cdc!important;">
											ADMINISTRATIVA</b>
									</h4>
								</center>
							</div>
							<br/>
							<form method="POST" id="login-form">
								<div class="form-group field--not-empty">
									<label for="username">Usuario</label>
									<input type="hidden" name="csrf" value="{{ security.getToken() }}">
									<input type="text" class="form-control" id="username" name="usuario">
								</div>
								<br>
								<div class="form-group field--not-empty">
									<label for="password" name="password">Contraseña</label>
									<input type="password" id="password" name="password" class="form-control">
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="color: lightgrey;"></span>
								</div>
								<br>

								<div class="d-flex mb-4 align-items-center">
									<label class="control control--checkbox mb-0">
										<span class="caption">Recordar</span>
										<input type="checkbox" id="saveAccount">
										<div class="control__indicator"></div>
									</label>

								</div>
								<div id="divLogin">
									<button id="btnLogin" class="btn btn-block btn-primary" type="button" style="height: 40px">
										Ingresar
									</button>
								</div>
								<br>
								<!--<div>
																																																																																	<button id="backToMenu" class="btn btn-block btn-primary" type="button" style="height: 40px">
																																																																																		Regresar a Plataformas Virtuales
																																																																																	</button>
																																																																																</div>-->
							</form>
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
		<script src="{{ url() }}adminpanel/login_vendor/js/login_admin/main.js"></script>
	</body>
</html></body></html>
