<!DOCTYPE html>
<html lang="en-us" style="background: white;">

	<head>
		<meta charset="utf-8">
		{{ get_title() }}
		<meta name="description" content="">
		<meta name="author" content="">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		<!-- Basic Styles -->
		{{ stylesheet_link(["adminpanel/css/bootstrap.min.css",'media':'screen,projection']) }}
		{{ stylesheet_link(["adminpanel/css/font-awesome.min.css",'media':'screen,projection']) }}


		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->

		{{ stylesheet_link(["adminpanel/css/smartadmin-production-plugins.min.css",'media':'screen,projection']) }}
		{{ stylesheet_link(["adminpanel/css/smartadmin-production.min.css",'media':'screen,projection']) }}
		{{ stylesheet_link(["adminpanel/css/smartadminskin.min.css?v=1234567",'media':'screen,projection']) }}

		<!-- SmartAdmin RTL Support -->
		{{ stylesheet_link(["adminpanel/css/smartadmin-rtl.min.css",'media':'screen,projection']) }}

		<!-- We recommend you use "your_style.css" to override SmartAdmin
																																																																																				             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
																																																																																				             <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		{{ stylesheet_link(["adminpanel/css/demo.min.css",'media':'screen,projection']) }}
		{{ stylesheet_link(["adminpanel/css/my.css?v=123",'media':'screen,projection']) }}
		{{ assets.outputCss() }}

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="adminpanel/img/favicon/favicon.ico" type="image/x-icon"> <link
		rel="icon" href="adminpanel/img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<style>:root
		{
			/*--primary: #3c5085;*/
			--primary: #2446a3;
			/*--open_li: #4a5f89;*/
			--open_li: #476dbb;
			--open_a_active: #ddb02a;
			--open_li_active: #e0a800;
		}
		#left-panel {
			overflow-y: scroll;
			overflow-x: hidden;
			max-height: 200px;
			background: var(--primary);
		}
		::-webkit-scrollbar {
			background: #f3f3f3 !important;
			width: 7px;
		}

		::-webkit-scrollbar-thumb {
			background: #505050 !important;
			border-radius: 3px;
			border: none;
		}

		/* Cambiamos el fondo y agregamos una sombra cuando esté en hover */
		::-webkit-scrollbar-thumb:hover {
			background: #b3b3b3;
			box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
		}

		/* Cambiamos el fondo cuando esté en active */
		::-webkit-scrollbar-thumb:active {
			background-color: #999999;
		}
		nav > ul {
			background: var(--primary) !important;
		}
		nav > ul>li:not(.open):hover {
			background: var(--open_li_active) !important;

		}
		nav > ul > li {
			background: var(--primary) !important;
			color: white !important;
			border-bottom: none !important;
			font-size: 13px;
			padding: 2px;
		}
		nav > ul > li>ul>li:hover {
			background: var(--open_a_active) !important;
		}
		nav > ul::before > li {
			background: var(--primary) !important;
			color: white !important;
			border-bottom: none !important;
			font-size: 13px;
		}
		nav > ul > li > a > i {
			color: white !important;
			font-size: 20px !important;
		}
		nav ul span.menu-item-parent {
			color: white !important;
		}
		
		.minified nav > ul > li > a > .menu-item-parent {
			background: var(--primary) !important;
		}
		.minified nav > ul > li > ul > li {
			background: var(--primary) !important;
		}
		.minified nav > ul > li > ul > li.active {
			background: var(--open_li_active) !important;
		}
		.smart-style-3.minified nav > ul > li > ul,
		.smart-style-3.minified nav > ul > li > ul > li > ul > li {
			background: var(--primary) !important;
		}

		.open > nav > ul > li > a > i {
			color: white !important;
		}
		.open {
			background: var(--open_li) !important;
			color: white !important;

		}
		.active {
			background: var(--open_li_active) !important;
		}
		.open .menu-item-parent {
			color: white !important;
		}

		.user-panel {
			color: white;
			/*background: var(--primary) !important;*/
			position: relative;
			width: 100%;
			padding: 10px;
			overflow: hidden;
			margin-top: 10px;
		}

		.user-panel:before,
		.user-panel:after {
			content: " ";
			display: table
		}

		.user-panel:after {
			clear: both
		}

		.user-panel > .image > img {
			width: 100%;
			max-width: 45px;
			height: auto
		}

		.user-panel > .info {
			padding: 5px 5px 5px 15px;
			line-height: 1;
			position: absolute;
			left: 55px
		}

		.user-panel > .info > p {
			font-weight: 600;
			margin-bottom: 9px
		}

		.user-panel > .info > a {
			text-decoration: none;
			padding-right: 5px;
			margin-top: 3px;
			font-size: 11px
		}

		.user-panel > .info > a > .fa,
		.user-panel>.info>a>.ion,
		.user-panel > .info > a > .glyphicon {
			margin-right: 3px
		}
		.main-header {
			position: relative;
			max-height: 100px;
			z-index: 1030;
			color: white !important;
		}

		.main-header .navbar {
			-webkit-transition: margin-left 0.3s ease-in-out;
			-o-transition: margin-left 0.3s ease-in-out;
			transition: margin-left 0.3s ease-in-out;
			margin-bottom: 0;
			border: none;
			min-height: 50px;
			border-radius: 0
		}

		.layout-top-nav .main-header .navbar {
			margin-left: 0
		}

		.main-header #navbar-search-input.form-control {
			background: rgba(255, 255, 255, 0.2);
			border-color: transparent
		}

		.main-header #navbar-search-input.form-control:focus,
		.main-header #navbar-search-input.form-control:active {
			border-color: rgba(0, 0, 0, 0.1);
			background: rgba(255, 255, 255, 0.9)
		}

		.main-header #navbar-search-input.form-control::-moz-placeholder {
			color: #ccc;
			opacity: 1
		}

		.main-header #navbar-search-input.form-control:-ms-input-placeholder {
			color: #ccc
		}

		.main-header #navbar-search-input.form-control::-webkit-input-placeholder {
			color: #ccc
		}

		.main-header .navbar-custom-menu,
		.main-header .navbar-right {
			float: right
		}

		@media(max-width: 991px) {
			.main-header .navbar-custom-menu a,
			.main-header .navbar-right a {
				color: inherit;
				background: transparent
			}
		}

		@media(max-width: 767px) {
			.main-header .navbar-right {
				float: none
			}

			.navbar-collapse .main-header .navbar-right {
				margin: 7.5px -15px
			}

			.main-header .navbar-right > li {
				color: inherit;
				border: 0
			}
		}

		.main-header .sidebar-toggle {
			color: grey;
			float: left;
			padding: 15px;
			font-family: fontAwesome;
			font-size: 18px;
		}

		.main-header .sidebar-toggle:before {
			content: "\f0c9"
		}


		.main-header .sidebar-toggle .icon-bar {
			display: none
		}

		.main-header .navbar .nav > li.user > a > .fa,
		.main-header .navbar .nav>li.user>a>.glyphicon,
		.main-header .navbar .nav > li.user > a > .ion {
			margin-right: 5px
		}

		.main-header .navbar .nav > li > a > .label {
			position: absolute;
			top: 9px;
			right: 7px;
			text-align: center;
			font-size: 9px;
			padding: 2px 3px;
			line-height: .9
		}

		.main-header .logo {
			-webkit-transition: width 0.3s ease-in-out;
			-o-transition: width 0.3s ease-in-out;
			transition: width 0.3s ease-in-out;
			display: block;
			float: left;
			height: 50px;
			font-size: 20px;
			line-height: 50px;
			text-align: center;
			width: 230px;
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			padding: 0 15px;
			font-weight: 300;
			overflow: hidden
		}

		.main-header .logo .logo-lg {
			color: white !important;
			display: block
		}

		.main-header .logo .logo-mini {
			display: none
		}

		.main-header .navbar-brand {
			color: #fff
		}

		.content-header {
			position: relative;
			padding: 15px 15px 0
		}

		.content-header > h1 {
			margin: 0;
			font-size: 24px
		}

		.content-header > h1 > small {
			font-size: 15px;
			display: inline-block;
			padding-left: 4px;
			font-weight: 300
		}

		.content-header > .breadcrumb {
			float: right;
			background: transparent;
			margin-top: 0;
			margin-bottom: 0;
			font-size: 12px;
			padding: 7px 5px;
			position: absolute;
			top: 15px;
			right: 10px;
			border-radius: 2px
		}

		.content-header > .breadcrumb > li > a {
			color: #444;
			text-decoration: none;
			display: inline-block
		}

		.content-header > .breadcrumb > li > a > .fa,
		.content-header>.breadcrumb>li>a>.glyphicon,
		.content-header > .breadcrumb > li > a > .ion {
			margin-right: 5px
		}

		.content-header>.breadcrumb>li+li:before {
			content: '>\00a0'
		}

		@media(max-width: 991px) {
			.content-header > .breadcrumb {
				position: relative;
				margin-top: 5px;
				top: 0;
				right: 0;
				float: none;
				background: #d2d6de;
				padding-left: 10px
			}

			.content-header>.breadcrumb li:before {
				color: #97a0b3
			}
		}

		.navbar-toggle {
			color: #fff;
			border: 0;
			margin: 0;
			padding: 15px
		}

		@media(max-width: 991px) {
			.navbar-custom-menu .navbar-nav > li {
				float: left
			}

			.navbar-custom-menu .navbar-nav {
				margin: 0;
				float: left
			}

			.navbar-custom-menu .navbar-nav > li > a {
				padding-top: 15px;
				padding-bottom: 15px;
				line-height: 20px
			}
		}

		@media(max-width: 767px) {
			.main-header {
				position: relative
			}

			.main-header .logo,
			.main-header .navbar {
				width: 100%;
				float: none
			}

			.main-header .navbar {
				margin: 0
			}

			.main-header .navbar-custom-menu {
				float: right
			}
		}

		@media(max-width: 991px) {
			.navbar-collapse.pull-left {
				float: none !important
			}

			.navbar-collapse.pull-left+.navbar-custom-menu {
				display: block;
				position: absolute;
				top: 0;
				right: 40px
			}
		}


		.main-header .navbar-custom-menu,
		.main-header .navbar-right {
			float: right
		}

		@media(max-width: 991px) {
			.main-header .navbar-custom-menu a,
			.main-header .navbar-right a {
				color: inherit;
				background: transparent
			}
		}

		@media(max-width: 991px) {
			.navbar-custom-menu .navbar-nav > li {
				float: left
			}

			.navbar-custom-menu .navbar-nav {
				margin: 0;
				float: left
			}

			.navbar-custom-menu .navbar-nav > li > a {
				padding-top: 15px;
				padding-bottom: 15px;
				line-height: 20px
			}
		}
		.dropdown-menu {
			display: block;
			position: absolute;
			right: 0;
			left: auto;
		}
		.user-header {
			height: 175px;
			padding: 10px;
			text-align: center;
		}
		.user-footer {
			background-color: #f9f9f9;
			padding: 10px;
		}
	</style>
</head>


<!-- <body class="fixed-header fixed-navigation fixed-ribbon smart-style-3" style="background-color: #F1F1F1 !important;"> -->
<body
	class="smart-style-3" style="">

	<!-- #HEADER -->
	<header class="main-header" style="height: 55px;background: white!important;box-shadow: 2px 2px 14px #cbcbcb;">
		<!-- Logo -->


		<!-- Header Navbar -->


		<!-- rayas -->
			<nav class="navbar "> <a
				href="panel" class="logo" style="width: 190px;">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<img width="130" src="{{ url() }}adminpanel/login_vendor/images/logo_unca.jpg" alt="{{ config.global.xAbrevIns }}">


			</a>
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle visible-lg" href="javascript:void(0);" data-action="minifyMenu">
				<span class="sr-only">Toggle navigation</span>
			</a>


			<!-- fin rayas -->

			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" style="color:var(--primary)!important;font-size: 20px;font-weight: bold;margin-top: 3px;padding: 15px;">{{ perfil_alias }}
							| v1.0
							<span class="sr-only">(current)</span>
						</a>

					</li>
				</ul>

			</div>

			<!-- Navbar Right Menu -->
			
			<div
				class="pull-right">
				<!-- logout button -->
				<div id="logout" class=" pull-right" style="
												    margin: 12px;
												">
					<span>
						<a href="{{ url('seguridad/logout') }}" class="btn btn-primary btn-block" title="Cerrar sesión" data-action="userLogout" data-logout-msg="Por su seguridad debe cerrar sesión antes de cerrar el navegador">
							<i class="fa fa-sign-out"></i>
						</a>
					</span>
				</div>
				<!-- end logout button -->

				<!-- collapse menu button -->


				<div id="hide-menu" class="btn-header pull-right visible-xs">
					<span>

						<a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu">
							<i class="fa fa-reorder"></i>
						</a>
					</span>
				</div>
				<div id="hide-menu" class="btn-header pull-right visible-xs" style="margin-top: 5px;
																								">
					<a href="#" style="color:var(--primary)!important;font-size: 15px;font-weight: bold;margin-top: 3px;padding: 15px;">{{ perfil_desc }}
					</a>
				</div>

				<!-- end collapse menu -->

				<!-- #MOBILE -->
				<!-- Top menu profile link : this shows only when top menu is active -->
					<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5"> <li class="">
						<a href="javascript:void(0)" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
							<img src="https://www.unca.edu.pe/adminpanel/img/avatars/sunny.png" alt="Usuario" class="online">
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0">
									<i class="fa fa-cog"></i>
									Setting</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0">
									<i class="fa fa-user"></i>
									<u>P</u>rofile</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut">
									<i class="fa fa-arrow-down"></i>
									<u>S</u>hortcut</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen">
									<i class="fa fa-arrows-alt"></i>
									Full
									<u>S</u>creen</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="https://www.unca.edu.pe/seguridad/logout" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout">
									<i class="fa fa-sign-out fa-lg"></i>
									<strong>
										<u>C</u>errar
																																																																																																																																																																																	                                    sesion</strong>
								</a>
							</li>
						</ul>
					</li>
				</ul>


				<!-- fullscreen button -->
			<!--
																																																	                <div id="fullscreen" class="btn-header transparent pull-right">
																																																	                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
																																																	                </div>
																																																	                -->
				<!-- end fullscreen button -->

				<!--
																																																																	                <div id="fullscreen" class="btn-header transparent pull-right">
																																																																	                    <span> <a href="https://www.unca.edu.pe/web/index"  title="Regresar al Portal Web"><i class="fa fa-arrow-circle-left"></i> UNAAA</a> </span>
																																																																	                </div>
																																																																	                -->


			</div>
		</nav>
	</header>

	<!-- END HEADER -->

	<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside
		id="left-panel"> <!-- User info -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ url() }}adminpanel/img/avatars/user.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ nombre }}</p>
			</div>
		</div>

		<!-- end user info -->

		<nav>
			<ul>
				<li>
					<a href="{{ url('panel') }}" title="Dashboard">
						<i class="fa fa-lg fa-fw fa-home"></i>
						<span class="menu-item-parent">Principal</span>
					</a>
				</li>
				{{ utilidades.getMenu(0,perfil) }}
			</ul>
		</nav>


		<span class="minifyme" data-action="minifyMenu">
			<i class="fa fa-arrow-circle-left hit"></i>
		</span>

	</aside>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">
		{{ content() }}
		<!-- RIBBON -->

		<div class="hidden">
			<div id="dialog-smart-error">
				<p>
					Usted debe seleccionar un registro para poder ejecutar esta acción.
				</p>
			</div>
		</div>
	</div>
	<!-- END MAIN PANEL -->

	<!-- PAGE FOOTER -->
	<div class="page-footer" style="background-color:white!important;color:black;">
		<div class="row">
			<div class="col-xs-12 col-sm-6"></div>
			<div class="col-xs-6 col-sm-6 text-right hidden-xs">
				<div class="inline-block">
					Desarrollado por la Oficina de Tecnologías de la Información ® 2019-2023
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE FOOTER -->

	<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
																																																																								        Note: These tiles are completely responsive,
																																																																								        you can add as many as you like
																																																																								        -->
	<div id="shortcut">
		<ul>
			<li><a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"><span class="iconbox"><i class="fa fa-envelope fa-4x"></i><span>Mail<span class="label pull-right bg-color-darken">14</span></span></span></a></li>
			<li><a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"><span class="iconbox"><i class="fa fa-calendar fa-4x"></i><span>Calendar</span></span></a></li>
			<li><a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"><span class="iconbox"><i class="fa fa-map-marker fa-4x"></i><span>Maps</span></span></a></li>
			<li><a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"><span class="iconbox"><i class="fa fa-book fa-4x"></i><span>Invoice<span class="label pull-right bg-color-darken">99</span></span></span></a></li>
			<li><a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"><span class="iconbox"><i class="fa fa-picture-o fa-4x"></i><span>Gallery</span></span></a></li>
			<li><a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"><span class="iconbox"><i class="fa fa-user fa-4x"></i><span>My Profile</span></span></a></li>
		</ul>
	</div>
	<!-- END SHORTCUT AREA -->

	<!--================================================== -->

	<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)--><script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ url() }}adminpanel/js/plugin/pace/pace.min.js"> </script>

	<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		var base_url = '{{ url() }}';
if (!window.jQuery) {
document.write('<script src="' + base_url + 'adminpanel/js/libs/jquery-3.2.1.min.js"><\/script>');
}
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script>
		if (!window.jQuery.ui) {
document.write('<script src="adminpanel/js/libs/jquery-ui.min.js"><\/script>');
}
	</script>

	<!-- IMPORTANT: APP CONFIG -->

	{{ javascript_include('adminpanel/js/app.config.js?v=1') }}

	<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->

	{{ javascript_include('adminpanel/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}

	<!-- BOOTSTRAP JS -->
	{{ javascript_include('adminpanel/js/bootstrap/bootstrap.min.js') }}


	<!-- CUSTOM NOTIFICATION -->

	{{ javascript_include('adminpanel/js/notification/SmartNotification.min.js') }}

	<!-- JARVIS WIDGETS -->

	{{ javascript_include('adminpanel/js/smartwidgets/jarvis.widget.min.js') }}

	<!-- EASY PIE CHARTS -->

	{{ javascript_include('adminpanel/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}

	<!-- SPARKLINES -->

	{{ javascript_include('adminpanel/js/plugin/sparkline/jquery.sparkline.min.js') }}

	<!-- JQUERY VALIDATE -->

	{{ javascript_include('adminpanel/js/plugin/jquery-validate/jquery.validate.min.js') }}

	<!-- JQUERY MASKED INPUT -->

	{{ javascript_include('adminpanel/js/plugin/masked-input/jquery.maskedinput.min.js') }}

	<!-- JQUERY SELECT2 INPUT -->

	{{ javascript_include('adminpanel/js/plugin/select2/select2.min.js') }}

	<!-- JQUERY UI + Bootstrap Slider -->

	{{ javascript_include('adminpanel/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}

	<!-- browser msie issue fix -->

	{{ javascript_include('adminpanel/js/plugin/msie-fix/jquery.mb.browser.min.js') }}

	<!-- FastClick: For mobile devices -->

	{{ javascript_include('adminpanel/js/plugin/fastclick/fastclick.min.js') }}<!--[if IE 8]>
																																																																																																					
																																																																																																					        <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
																																																																																																					
																																																																																																					    <![endif]-->

	<!-- Demo purpose only -->


	<!-- MAIN APP JS FILE -->{{ javascript_include('adminpanel/js/app.min.js?v=1562323') }}

	<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
	<!-- Voice command : plugin -->{{ javascript_include('adminpanel/js/speech/voicecommand.min.js') }}

	<!-- SmartChat UI : plugin -->{{ javascript_include('adminpanel/js/smart-chat-ui/smart.chat.ui.min.js') }}{{ javascript_include('adminpanel/js/smart-chat-ui/smart.chat.manager.min.js') }}

	<!-- Datatable -->{{ javascript_include('adminpanel/js/plugin/datatables/jquery.dataTables.min.js') }}{{ javascript_include('adminpanel/js/plugin/datatables/dataTables.colVis.min.js') }}{{ javascript_include('adminpanel/js/plugin/datatables/dataTables.tableTools.min.js') }}{{ javascript_include('adminpanel/js/plugin/datatables/dataTables.bootstrap.min.js') }}{{ javascript_include('adminpanel/js/plugin/datatable-responsive/datatables.responsive.min.js') }}{{ javascript_include('adminpanel/js/plugin/clockpicker/clockpicker.min.js') }}{{ javascript_include('adminpanel/js/curiosity.js?v=67778') }}{{ javascript_include('adminpanel/js/bootbox.min.js') }}

	{#{{ javascript_include('adminpanel/js/plugin/ckeditor/ckeditor.js') }}#}<script src="//cdn.ckeditor.com/4.13.0/full/ckeditor.js"> </script>
	{{ javascript_include('adminpanel/js/plugin/moment/moment.min.js') }}

	{{ assets.outputJs() }}


	<!-- PAGE RELATED PLUGIN(S)-->
	{{ javascript_include('adminpanel/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js') }}

	<script>
		var base_url = '{{ url() }}';

$(document).ready(function () { /* DO NOT REMOVE : GLOBAL FUNCTIONS!
             *
             * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
             *
             * // activate tooltips
             * $("[rel=tooltip]").tooltip();
             *
             * // activate popovers
             * $("[rel=popover]").popover();
             *
             * // activate popovers with hover states
             * $("[rel=popover-hover]").popover({ trigger: "hover" });
             *
             * // activate inline charts
             * runAllCharts();
             *
             * // setup widgets
             * setup_widgets_desktop();
             *
             * // run form elements
             * runAllForms();
             *
             ********************************
             *
             * pageSetUp() is needed whenever you load a page.
             * It initializes and checks for all basic elements of the page
             * and makes rendering easier.
             *
             */

pageSetUp();

$('.input-clockpicker').clockpicker({placement: 'top', donetext: 'Done'});

/*
             * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
             * eg alert("my home function");
             * 
             * var pagefunction = function() {
             *   ...
             * }
             * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
             * 
             * TO LOAD A SCRIPT:
             * var pagefunction = function (){ 
             *  loadScript(".../plugin.js", run_after_loaded);	
             * }
             * 
             * OR
             * 
             * loadScript(".../plugin.js", run_after_loaded);
             */

});
	</script>

	<!-- Your GOOGLE ANALYTICS CODE Below -->
	<script>
		var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
_gaq.push(['_trackPageview']);

(function () {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
	</script>

	<script type="text/javascript" charset="utf-8">
		$body = $("body");
$(document).on({
ajaxStart: function () {
$body.addClass("loading");
},
ajaxStop: function () {
$body.removeClass("loading");
}
});
	</script>
	<div
		class="modaljxr"><!-- Place at bottom of page -->
	</div>
</body></html>
