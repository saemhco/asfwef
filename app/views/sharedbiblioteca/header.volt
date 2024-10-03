<!DOCTYPE html>
<html>
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/php; charset=ISO-8859-1" />
        <title>{{ config.global.xNombreWeb }}</title>
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
        <meta name="description" content="Universidad, Educacion Superior, Huamachuco, Sanchez Carrion, La Libertad, Peru, Ande Liberteno" />
        <meta name="keywords" content="Universidad, Educacion Superior, Huamachuco, Sanchez Carrion, La Libertad, Peru, Ande Liberteño"/>
        <meta name="distribution" content="Global"/>
        <meta name="robots" content="All"/>
        <meta name="copyright" content="Universidad Nacional Ciro Alegría - www.unca.edu.pe"/>
        <meta name="author" content="Universidad Nacional Ciro Alegría - www.unca.edu.pe"/>
        <meta name="location" content="Peru">
        <meta property="og:locale" content="es_ES" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Universidad Nacional Ciro Alegría" />
        <meta property="og:description" content="Universidad, Educacion Superior, Huamachuco, Sanchez Carrion, La Libertad, Peru, Sierra, Ande Liberteno" />
        <meta property="og:url" content="http://www.unca.edu.pe/" />
        <meta property="og:site_name" content="unca" />
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:site" content="@unca"/>
        <meta name="twitter:domain" content="unca"/>
        <meta name="twitter:creator" content="@unca"/>

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        {{ stylesheet_link('webpage/assets/css/width-boxed.min.css') }}
        {{ stylesheet_link('webpage/assets/img/favicon.png?v=3') }}
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!-- REVOLUTION SLIDER AMARTY 23-->
        {{ stylesheet_link('webpage/assets/plugins/slider.revolution/css/extralayers.css') }}
        {{ stylesheet_link('webpage/assets/plugins/slider.revolution/css/settings.css') }}

        <!-- MATERIAL-->
        {{ stylesheet_link('webpage/assets/css/preload.min.css') }}
        {{ stylesheet_link('webpage/assets/css/plugins.min.css') }}        
        {{ stylesheet_link('webpage/assets/css/style.light-blue-500.min.css') }}

    </head>

    <body>

        <div id="ms-preload" class="ms-preload">
            <div id="status">
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            </div>
        </div>

        <div class="ms-site-container">

            <header class="ms-header ms-header-primary">
                <!--ms-header-primary-->
                <div class="container container-full">
                    <div class="ms-title">
                        <a href="{{ url('web') }}">
                            <!-- <img src="assets/img/demo/logo-header.png" alt="">-->
                            {{ image("webpage/assets/img/escudo.png", "alt":"UNCA") }}
                            <h1 class="animated fadeInRight animation-delay-6"><span>Universidad &nbsp; Nacional &nbsp; Ciro &nbsp; Alegría</span></h1>
                        </a>
                    </div>
                    <div class="header-right">                    
                        <a target="_blank" href="http://correo.unca.edu.pe" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-7"><i class="zmdi zmdi-email"></i></a>
                        <a target="_blank" href="http://classroom.google.com" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-8"><i class="zmdi zmdi-balance"></i></a>
                        <a target="_blank" href="http://sigesu.unca.edu.pe/" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-9"><i class="zmdi zmdi-account"></i></a>
                        <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary ms-toggle-left animated zoomInDown animation-delay-10"><i class="zmdi zmdi-menu"></i></a>
                    </div>
                </div>
            </header>
            <nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-primary">
                <div class="container container-full">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('') }}">
                            <!-- <img src="assets/img/demo/logo-navbar.png" alt="">-->
                            {{ image("webpage/assets/img/escudito.png", "alt":"UNCA") }}
                            <span class="ms-title"><strong>UNCA</strong></span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="ms-navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a data-scroll class="nav-link active" href="{{ url('web-biblioteca') }}">Inicio</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbiblioteca/tipspracticas') }}">Tips</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbiblioteca/infointeres') }}">Información</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbiblioteca/novedades') }}">Novedades</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbiblioteca/testimonios') }}">Testimonios</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbiblioteca/contactenos') }}">Contáctenos</a></li>

                            {% if logueado == true %}
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle animated fadeIn animation-delay-9" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce" id="a_usuario_login_web">{{ nombre }} <i class="zmdi zmdi-chevron-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('panel') }}"> MI PANEL</a></li>
                                        <li><a class="dropdown-item" href="{{ url('web/end') }}"> CERRAR SESIÓN</a></li>
                                    </ul>
                                </li>
                            {% else %}
                            <?php 
                            $request_uri = $_SERVER['REQUEST_URI'];
                            $request_explode = explode("/", $request_uri);
                            $p_1 = $request_explode[1];
                            $p_2 = $request_explode[2];
                            $encode_url = base64_encode($request_uri);
                            $url_full = "login.html?redirect=true&tipo=biblioteca&url=".$encode_url;
                            $isDetailBook = ($p_1 == "web-biblioteca" && $p_2 == "detalle-libro")?true:false;
                            ?>
                                <li class="nav-item" id="li_usuario_login_webbiblioteca">
                                    {% if isDetailBook == true %}
                                    <a data-scroll class="nav-link" href="{{ url(url_full) }}" id="a_usuario_login_webbiblioteca">INICIAR SESIÓN</a>
                                    {% else %}
                                    <a data-scroll class="nav-link" href="{{ url('login.html') }}" id="a_usuario_login_webbiblioteca">INICIAR SESIÓN</a>
                                    {% endif %}
                                    <ul class="dropdown-menu" style="display: none;" id="ul_usuario_login_webbiblioteca">
                                        <li><a class="dropdown-item" href="{{ url('panel') }}"> MI PANEL</a></li>
                                        <li><a class="dropdown-item" href="{{ url('web/end') }}"> CERRAR SESIÓN</a></li>
                                    </ul>
                                </li>
                            {% endif %}

                        </ul>
                    </div>
                    <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
                </div><!-- container -->
            </nav>




