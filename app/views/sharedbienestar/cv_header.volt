<!DOCTYPE html>
<html>
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/php; charset=ISO-8859-1" />
        <title>{{ config.global.xNombreWeb }}</title>
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
        <meta name="description" content="CV - PERU, Yurimaguas, Alto Amazonas, Loreto, Peru, Amazonia Peruana" />
        <meta name="keywords" content="CV - PERU, Yurimaguas, Alto Amazonas, Loreto, Peru, Amazonía Peruana"/>
        <meta name="distribution" content="Global"/>
        <meta name="robots" content="All"/>
        <meta name="copyright" content="CV -PERU - www.cv.com.pe"/>
        <meta name="author" content="CV PERU - www.cv.com.pe"/>
        <meta name="location" content="Peru">
        <meta property="og:locale" content="es_ES" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="CV - PERU" />
        <meta property="og:description" content="CV - PERU, Yurimaguas, Loreto, Loreto, Peru, Selva, Amazonia Peruana" />
        <meta property="og:url" content="http://www.cv.com.pe/" />
        <meta property="og:site_name" content="CV" />
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:site" content="@CV"/>
        <meta name="twitter:domain" content="CV"/>
        <meta name="twitter:creator" content="@CV"/>

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
                      {{ image("webpage/assets/img/escudo.png", "alt":"CV") }}
                      <h1 class="animated fadeInRight animation-delay-6"><span> Plataforma &nbsp;&nbsp; Virtual &nbsp;&nbsp; CV &nbsp;&nbsp; Digital </span></h1>
                    </a>
                  </div>
                  <div class="header-right">                    
                    <a target="_blank" href="http://www.cv.com.pe/webmail" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-7"><i class="zmdi zmdi-email"></i></a>
                    <a target="_blank" href="http://www.cv.com.pe/" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-8"><i class="zmdi zmdi-balance"></i></a>
                    <a target="_blank" href="http://www.cv.com.pe/admin" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-9"><i class="zmdi zmdi-account"></i></a>
                    <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary ms-toggle-left animated zoomInDown animation-delay-10"><i class="zmdi zmdi-menu"></i></a>
                  </div>
                </div>
            </header>
              <nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-primary">
                <div class="container container-full">
                  <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('web') }}">
                      <!-- <img src="assets/img/demo/logo-navbar.png" alt="">-->
                      {{ image("webpage/assets/img/escudito.png", "alt":"CV") }}
                      <span class="ms-title"><strong>Plataforma CV Digital </strong></span>
                    </a>
                  </div>
                    <div class="collapse navbar-collapse" id="ms-navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a data-scroll class="nav-link active" href="{{ url('web-bolsatrabajo') }}">Inicio</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbolsatrabajo/tipspracticas') }}">Tips</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbolsatrabajo/infointeres') }}">Información</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbolsatrabajo/novedades') }}">Novedades</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbolsatrabajo/testimonios') }}">Testimonios</a></li>
                            <li class="nav-item"><a data-scroll class="nav-link" href="{{ url('webbolsatrabajo/contactenos') }}">Contáctenos</a></li>

                            {% if logueado == true %}
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle animated fadeIn animation-delay-9" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce" id="a_usuario_login_web">{{ nombre }} <i class="zmdi zmdi-chevron-down"></i></a>
                                    <input type="hidden" name="codigo_usuario" id="codigo_usuario" value="{{ codigo }}">
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ url('panel') }}"> MI PANEL</a></li>
                                        <li><a class="dropdown-item" href="{{ url('web/end') }}"> CERRAR SESIÓN</a></li>
                                    </ul>
                                </li>
                            {% else %}
                                <li class="nav-item" id="li_usuario_login_webbolsatrabajo">
                                    <a data-scroll class="nav-link" href="{{ url('login.html') }}" id="a_usuario_login_webbolsatrabajo">INICIAR SESIÓN</a>
                                    <input type="hidden" name="codigo_usuario" id="codigo_usuario" value="">
                                    <ul class="dropdown-menu" style="display: none;" id="ul_usuario_login_webbolsatrabajo">
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




