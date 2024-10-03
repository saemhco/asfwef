<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Plataformas Virtuales</title>
		<link rel="stylesheet" href="{{ url() }}adminpanel/login_vendor/css/bootstrap.min.css"/>
		<style>
			@import url('https://fonts.googleapis.com/css?family=Roboto:300');

			body {
				margin: 0;
				padding: 0;
				font-family: 'Roboto', sans-serif;
			}

			section {
				width: 100%;
				height: 100vh;
				box-sizing: border-box;
				padding: 30px 0;

			}

			.card {
				position: relative;
				min-width: 250px;
				height: auto;
				overflow: hidden;
				border-radius: 15px;
				margin: 0 auto;
				padding: 17px 20px;
				box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
				transition: 0.5s;
				width: 0;
			}
			.card:hover {
				transform: scale(1.1);
			}
			.card_blue,
			.card_blue .title .fa {
				background: linear-gradient(-45deg, #001d3c, #0057c9);
			}
			.card_red,
			.card_red .title .fa {
				background: linear-gradient(-45deg, #ffec61, #f321d7);
			}
			.card_violet,
			.card_violet .title .fa {
				background: linear-gradient(-45deg, #f403d1, #64b5f6);
			}
			.card_three,
			.card_three .title .fa {
				background: linear-gradient(-45deg, #24ff72, #9a4eff);
			}

			.card:before {
				content: '';
				position: absolute;
				bottom: 0;
				left: 0;
				width: 100%;
				height: 40%;
				background: rgba(255, 255, 255, 0.1);
				z-index: 1;
				transform: skewY(-5deg) scale(1.5);
			}

			.title .fa {
				color: #fff;
				font-size: 60px;
				width: 100px;
				height: 100px;
				border-radius: 50%;
				text-align: center;
				line-height: 100px;
				box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
			}
			.title p {
				position: relative;
				margin: 20px 0 0;
				padding: 0;
				color: #fff;
				font-size: 18px;
				z-index: 2;
			}
			.price {
				position: relative;
				z-index: 2;
			}
			.price h4 {
				margin: 0;
				padding: 20px 0;
				color: #fff;
				font-size: 60px;
			}
			.option {
				position: relative;
				z-index: 2;
			}
			.option ul {
				margin: 0;
				padding: 0;
			}
			.option ul li {
				margin: 0 0 10px;
				padding: 0;
				list-style: none;
				color: #fff;
				font-size: 12px;
			}
			.card a {
				display: block;
				position: relative;
				z-index: 2;
				background-color: #fff;
				color: #262ff;
				width: 150px;
				height: 40px;
				text-align: center;
				margin: 20px auto 0;
				line-height: 40px;
				border-radius: 40px;
				font-size: 16px;
				cursor: pointer;
				text-decoration: none;
				box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
			}
			.card a:hover {}
		</style>
	</head>
	<body>
		<section>
			<div class="container">
				<hr/>
				<center>
					<h3>Sistema Virtuales</h3>
				</center>
				<hr/>
				<div class="row">
					<div class="col-sm-4">
						<div class="card card_blue text-center">
							<div class="title">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
								<p>Sistema de Gestión Administrativa</p>
							</div>
							<div class="option">
								<ul>
									<li>
										<i class="fa fa-check" aria-hidden="true"></i>
									</li>
								</ul>
							</div>
							<a href="/admin">Ingresar</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card card_blue text-center">
							<div class="title">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
								<p>Sistema de Información
								</p>
							</div>
							<div class="option">
								<ul>
									<li>
										<i class="fa fa-check" aria-hidden="true"></i>PARA LA GESTIÓN DE LA EDUCACIÓN SUPERIOR UNIVERSITARIA</li>
								</ul>
							</div>
							<a href="/login-perfil">Ingresar</a>
						</div>
					</div>

				</div>
				<hr/>
				<center>
					<h3>Convocatorias</h3>
				</center>
				<hr/>
				<div class="row">
					<div class="col-sm-4">
						<div class="card card_blue text-center">
							<div class="title">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
								<p>Sistema de Gestión Administrativa</p>
							</div>
							<div class="option">
								<ul>
									<li>
										<i class="fa fa-check" aria-hidden="true"></i>"CONVOCATORIAS CAS"</li>
								</ul>
							</div>
							<a href="/login-convocatorias">Ingresar</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card card_blue text-center">
							<div class="title">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
								<p>Sistema de Gestión Administrativa</p>
							</div>
							<div class="option">
								<ul>
									<li>
										<i class="fa fa-check" aria-hidden="true"></i>"RATIFICACIÓN DE DOCENTES"</li>
								</ul>
							</div>
							<a href="/login-ratificacion-docentes">Ingresar</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card card_blue text-center">
							<div class="title">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
								<p>Sistema de Gestión Administrativa
								</p>
							</div>
							<div class="option">
								<ul>
									<li>
										<i class="fa fa-check" aria-hidden="true"></i>"CONVOCATORIAS DOCENTES"</li>
								</ul>
							</div>
							<a href="/login-convocatorias-docentes">Ingresar</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="{{ url() }}adminpanel/login_vendor/js/jquery-3.3.1.min.js"></script>
	</body>
</html>
