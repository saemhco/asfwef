<!DOCTYPE html>
<html lang="en-us" id="extr-page" class="animated fadeInDown">
	<head>
		<meta
		charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title>
			{{ config.global.xNombreAdmin }}
		</title>
		<meta name="description" content="">
		<meta name="author" content="">

		<meta
		name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/bootstrap.min.css">
		<link
		rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/smartadmin-production.min.css">
		<link
		rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support is under construction-->
		<link
		rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/smartadmin-rtl.min.css">

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		        <link rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/your_style.css"> -->

		<link
		rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/your_style.css">

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link
		rel="stylesheet" type="text/css" media="screen" href="{{ url() }}adminpanel/css/demo.min.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="{{ url() }}adminpanel/img/favicon/favicon.ico" type="image/x-icon">
		<link
		rel="icon" href="{{ url() }}adminpanel/img/favicon/favicon.ico" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link
		rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- Specifying a Webpage Icon for Web Clip
		             Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="{{ url() }}adminpanel/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ url() }}adminpanel/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ url() }}adminpanel/img/splash/touch-icon-iphone-retina.png">
		<link
		rel="apple-touch-icon" sizes="152x152" href="{{ url() }}adminpanel/img/splash/touch-icon-ipad-retina.png">

		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta
		name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="{{ url() }}adminpanel/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="{{ url() }}adminpanel/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link
		rel="apple-touch-startup-image" href="{{ url() }}adminpanel/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
document.write('<script src=" {{ url() }}adminpanel/js/libs/jquery-3.2.1.min.js"><\/script>');
}
		</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
document.write('<script src=" {{ url() }}adminpanel/js/libs/jquery-ui.min.js"><\/script>');
}
		</script>


	</head>
	<body style="
			          position: absolute !important;
			          top: 0  !important;
			          right: 0  !important;
			          bottom: 0  !important;
			          left: 0;  -webkit-background-size: cover;
			          -moz-background-size: cover;
			          -o-background-size: cover;
			          background-size: cover;">

		<div
			role="main" style="background-repeat: repeat-x;background-image: linear-gradient(150deg, {{ config.global.xColorIns }}, {{ config.global.xColorRGB }}) !important; height:100%; ">

			<!-- MAIN CONTENT -->
			<div class="container">

				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<br><br>
						<br><br><br><br>
						<div class="well no-padding">
                            <section style="text-align:center;">
                                        <h2><b>Cambiar contraseña</b></h2>
                                    </section>
							<form method="POST" id="login-form" class="smart-form client-form">
								<header>
									{{ image("webpage/assets/img/logo.png", "class":"img-responsive", "style":"margin-left: auto; margin-right: auto;") }}
								</header>
								<fieldset>
									<section>
										<label class="label">Usuario</label>
										<label class="input">
											<i class="icon-append fa fa-user"></i>
											<input type="text" id="usuario" name="usuario">
											<b class="tooltip tooltip-top-right">
												<i class="fa fa-user txt-color-teal"></i>
												Porfavor ingrese su cuenta de usuario</b>
										</label>
										<input type="hidden" name="csrf" value="{{ security.getToken() }}">
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input">
											<i class="icon-append fa fa-lock"></i>
											<input type="password" id="password" name="password">
											<b class="tooltip tooltip-top-right">
												<i class="fa fa-lock txt-color-teal"></i>
												Porfavor ingrese su password</b>
										</label>
										<div class="note">
											<a href="{{ url() }}seguridad/recuperar">Olvidaste tu password?</a>
										</div>
									</section>


								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Ingresar
									</button>
								</footer>
							</form>

						</div>


					</div>
					<div class="col-md-4"></div>
				</div>
			</div>

		</div>
		<!-- END MAIN PANEL -->
		<!-- ==========================CONTENT ENDS HERE ========================== -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)--><script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ url() }}adminpanel/js/plugin/pace/pace.min.js"> </script>

		<!-- These scripts will be located in Header So we can add scripts inside body (used in class.datatables.php) -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

		<script src="{{ url() }}adminpanel/js/app.config.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{ url() }}adminpanel/js/bootstrap/bootstrap.min.js"></script>

		
		<!-- JQUERY VALIDATE -->
		<script src="{{ url() }}adminpanel/js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="{{ url() }}adminpanel/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>



		<!--[if IE 8]>
		            <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		        <![endif]-->


		<!-- MAIN APP JS FILE -->
		<script src="{{ url() }}adminpanel/js/app.min.js"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="{{ url() }}adminpanel/js/speech/voicecommand.min.js"></script>

		<!-- SmartChat UI : plugin -->
		<script src="{{ url() }}adminpanel/js/smart-chat-ui/smart.chat.ui.min.js"></script>
		<script src="{{ url() }}adminpanel/js/smart-chat-ui/smart.chat.manager.min.js"></script>

		<script type="text/javascript">
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
$(document).ready(function () {
pageSetUp();

})
		</script>
		<!-- PAGE RELATED PLUGIN(S) 
		        <script src="..."></script>-->
		<script src="https://www.google.com/recaptcha/api.js?render=6Ldnv8QkAAAAAEA6BYfuFMFuZ3HA9s-AJo1RomkX"></script>

		<script type="text/javascript">

			runAllForms();

$(function () {
setTimeout(() => {}, 2000);
// Validation
$("#login-form").validate({ // Rules for form validation
rules: {
usuario: {
required: true
},
password: {
required: true,
minlength: 3,
maxlength: 20
}
},
// Messages for form validation
messages: {
usuario: {
required: 'Por favor ingrese su cuenta de usuario'

},
password: {
required: 'Por favor ingrese su password'
}
},
// Do not change code below
errorPlacement: function (error, element) {
error.insertAfter(element.parent());
},
submitHandler: function (form) {
grecaptcha.execute('6Ldnv8QkAAAAAEA6BYfuFMFuZ3HA9s-AJo1RomkX', {action: 'subscribe_newsletter'}).then(function (token) {
$('#login-form').prepend('<input type="hidden" name="token" value="' + token + '">');
$('#login-form').prepend('<input type="hidden" name="action" value="subscribe_newsletter">');
$.ajax({
url: "{{ url() }}seguridad/login",
type: 'POST',
data: $("#login-form").serialize(),
success: function (msg) {
if (msg.say == "yes") {
window.location.href = "{{ url('panel') }}";
} else {
alert("Credenciales no registradas , intentelo nuevamente");
location.reload();
}
}
});

});


}
});
});
		</script>


	</body>

</html>
