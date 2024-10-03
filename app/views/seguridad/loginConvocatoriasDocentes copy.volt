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
							<div id="image_rigth" style="background-image: url('{{ url() }}adminpanel/login_vendor/images/home.png');background-color:#4169e1;height:100vh;background-size: contain;background-repeat: no-repeat;background-position: center;"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6 half">
					<div class="contents">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-8" style="background-color: white;padding: 20px;box-shadow: 5px 3px 36px grey;margin-top:30px;">
								<div class="float-right">
									<button type="button" data-toggle="modal" data-target="#infoModal">
										<i class="fa fa-question"></i>
									</button>
								</div><br>
								<div class="mb-2">
									<center>
										<h6>Sistema de Gestión Administrativa</h6>
										<h6>"CONVOCATORIA DE DOCENTES"</h6>
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
										<input type="password" id="password" name="password_login" class="form-control"/>
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
									<br/>
									<div>
										<button id="backToMenu" class="btn btn-block btn-primary" type="button" style="height: 40px">
											Regresar a Plataformas Virtuales
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
									<p style="text-align: justify;color:black;">
										Bienvenidos al nuevo portal de Gestión de Convocatoria Docente. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
																																										                        Para más información sobre el procedimiento de postulación descargue el siguiente Manual de usuario del Sistema de Gestión de Convocatorias Docentes de la UNCA.
									</p>
									<p style="text-align: justify;color:black;">Para más información sobre el procedimiento de postulación descargue
																																		                        el siguiente
										<a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-informacion-de-gestion-de-convocatorias-de-concurso-docente.pdf">
											<strong>Manual
																																										                                de usuario del Sistema de Gestión de Convocatorias de la UNCA</strong>
										</a>.</p>
								</div>
								<div class="col-md-12">
									<h5>
										<p style="">Las consultas se pueden realizar por los siguientes medios:
										</p>
									</h5>
									<h5>
										<p style="">Enviando un correo electrónico a:</p>
									</h5>
									<p>
										<i class="fa fa-envelope"></i>&nbsp; Email: <a href="mailto:seleccion.docente@unca.edu.pe">seleccion.docente@unca.edu.pe</a></p>
									<h5>
										<p style="text-align: justify;"><i class="fa fa-phone"></i> &nbsp;Teléfono:  &nbsp;  +51 044 365463</p>
									</h5>
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
		<script src="{{ url() }}adminpanel/login_vendor/js/login_convocatoria_docente/main.js"></script>
	</body>
</html>
