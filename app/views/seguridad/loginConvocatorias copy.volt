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
			<div class="row">

				<div class="col-md-6 p-0">
					<div class="row">
						<div class="col-md-12">
							<div id="image_rigth" style="background-image: url('{{ url() }}adminpanel/login_vendor/images/home.png');height:100vh;background-size: contain;background-repeat: no-repeat;background-position: center;background-color:#4169e1;"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6 half">
					<div class="contents">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-8" style="background-color: white;padding: 20px;box-shadow: 5px 3px 36px grey;margin-top:30px;border-radius: 20px;">
								<div class="float-right">
									<button type="button" data-toggle="modal" data-target="#infoModal">
										<i class="fa fa-question"></i>
									</button>
								</div><br>
								<div class="mb-2">
									<center>
										<h6>Sistema de Gestión Administrativa</h6>
										<h6>"CONVOCATORIA CAS"</h6>
									</center>
									<center>
										<img src="{{ url() }}adminpanel/login_vendor/images/logo_unca.jpg" class="img-responsive" style="margin-left: auto;margin-right: auto;width: 200px;"/>
									</center>
								</div>
								<form method="POST" id="login-form">
									<div class="form-group">
										<label for="username">Número de DNI</label>
										<input type="hidden" name="csrf" value="{{ security.getToken() }}">
										<input type="number" class="form-control" id="username" name="nro_doc_login"/>
									</div>
									<br/>
									<div class="form-group">
										<label for="password" name="password">Contraseña</label>
										<input type="password" id="password" name="password_login" class="form-control" id="password"/>
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
									<div id="divLogin">
										<button id="btnLogin" class="btn btn-block btn-primary" type="button" style="height: 40px">
											Ingresar
										</button>

									</div>
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
									<p style="text-align: justify;padding-bottom: 15px;color: black;" class="__web-inspector-hide-shortcut__">
										Bienvenidos al nuevo portal de Gestión Administrativa mediante la modalidad de Contratación Administrativa de Servicios - CAS. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
										<br/>
										<br/>Para más información sobre el procedimiento de postulación descargue el siguiente
										<a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-gestion-de-convocatorias-unca-656574.pdf">
											<strong>Manual de usuario del Sistema de Gestión de Convocatorias de la UNCA.</strong>
										</a>.
									</p>

								</div>

							</div>
							<div class="row">
								<div class="col-md-6">
									<p>
										<i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp; Email:
										<a href="mailto:informes@unca.edu.pe">informes@unca.edu.pe</a>
									</p>
								</div>
								<div class="col-md-6">
									<p>
										<i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; Tel: +51 044 365463</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</body>
	</body>
</html></div><script type="text/javascript">
var urlPath = "{{ url() }}";</script><script src="https://www.google.com/recaptcha/api.js?render=6LetFsokAAAAANw_8B4sNQTs_kse1Qa8RGkvDJXd"></script><script src="{{ url() }}adminpanel/js/sweetalert2/sweetalert2.all.min.js"></script><script src="{{ url() }}adminpanel/login_vendor/js/jquery-3.3.1.min.js"></script><script src="{{ url() }}adminpanel/login_vendor/js/popper.min.js"></script><script src="{{ url() }}adminpanel/login_vendor/js/bootstrap.min.js"></script><script src="{{ url() }}adminpanel/login_vendor/js/login_convocatorias_cas/main.js"></script></body></html>
