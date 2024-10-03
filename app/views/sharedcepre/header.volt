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
        <script type="text/javascript"> //<![CDATA[ 
          var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
          document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
          //]]>
          </script>
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

        <!--Datatables-->
        {{ stylesheet_link('webpage/datatables/css/dataTables.bootstrap4.min.css') }}
        {{ stylesheet_link('webpage/datatables/css/buttons.bootstrap4.min.css') }}
        {{ stylesheet_link('webpage/datatables/css/responsive.dataTables.min.css') }}
        {{ stylesheet_link('vendor/accordion-1.0.0.css') }}
        {{ stylesheet_link('webpage/assets/css/style-unca.css') }}
        {{ stylesheet_link('webpage/assets/css/override.css') }}
        {{ stylesheet_link('css/app.css') }}
        
      


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

          <div class="ms-site-container-blue">
          <header class="ms-header ms-header-primary-blue">
         <div class="container container-full-blue">
            
          <div class="container">                    
            <a  href="#" class="btn-circle btn-circle-white animated zoomInDown animation-delay-7"><i class="zmdi zmdi-phone"></i></a><label style="font-size: 13px;">+51 910 212 205</label>
            <a  href="#" class="btn-circle btn-circle-white animated zoomInDown animation-delay-7"><i class="zmdi zmdi-email-open"></i></a><label style="font-size: 13px;"> cepre@unca.edu.pe </label>         
          

            <div class="header-right" >                    
              
              <a target="_blank" href="https://www.unca.edu.pe/unca-direccion.html">
              <label style="font-size: 13px; color: white; cursor: pointer;">¿DÓNDE UBICARNOS?</label>
              </a>
              &nbsp;&nbsp;&nbsp;
              |
              &nbsp;&nbsp;&nbsp;
              <a target="_blank" href="https://www.unca.edu.pe/politica-privacidad.html">
                <label style="font-size: 13px; color: white; cursor: pointer;">POLÍTICA DE PRIVACIDAD</label>
                </a>

              
              

            <!--
            <a target="_blank" href="http://correo.unca.edu.pe" class="btn-circle btn-circle-white animated zoomInDown animation-delay-7"><i class="zmdi zmdi-email"></i></a>
            <a target="_blank" href="http://classroom.google.com" class="btn-circle btn-circle-white animated zoomInDown animation-delay-8"><i class="zmdi zmdi-balance"></i></a>
            <a target="_blank" href="https://www.unca.edu.pe/login.html" class="btn-circle btn-circle-white no-focus animated zoomInDown animation-delay-9"><i class="zmdi zmdi-account"></i></a>
            -->
            

          </div>
            
        </div>

          
          </div>
          </header>
          </div>

         


            <div class="new-container-site">
              <header class="ms-header ms-header-primary">
                <!--ms-header-primary-->
                <div class="container container-full">
                  <div class="ms-title">
                    <a href="admision">
                      <!-- <img src="assets/img/demo/logo-header.png" alt="">-->
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/logo_cepre_unca.png", "alt":"UNCA") }}
                      <!--
                      <h1 class="animated fadeInRight animation-delay-6" style="margin-top:15px"><span>Universidad &nbsp; Nacional &nbsp; Ciro &nbsp; Alegría</span></h1>
                      -->
                    </a>
                    
                   
                    &nbsp;&nbsp;&nbsp;&nbsp;
                        
                    <a target="_blank" href="https://www.gob.pe/institucion/sunedu/normas-legales/4711485-029-2023-sunedu-cd">
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/enlaces/licenciada-sunedu-unca.png", "class":"img-responsive", "width":"352", "height": "60") }}
                      </a> 

                  </div>

                 

                  &nbsp;&nbsp;&nbsp;&nbsp;
                 
                   
                        <a target="_blank" href="{{ url('login-admision.html') }}"
                                class="btn btn-warning btn-raised text-right" role="button">
                                <i class="zmdi zmdi-plus"></i><span>INSCRÍBETE AQUÍ</span>
                            </a>
                 

            
                  <div class="header-right">              

                    <!--
                    <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary ms-toggle-left animated zoomInDown animation-delay-100"><i class="zmdi zmdi-menu mdc-text-light-blue"></i></a>
                    -->   

                       <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
                       
                  </div>
                </div>
            </header>


              <nav class="navbar navbar-expand-md navbar-static ms-navbar ms-navbar-white " style="height: 50px;margin-bottom:0px!important;">
                <div class="container container-full" style="">
                  <!--IMAGEN CELULAR-->
                  <div class="responsive-logo">
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/logo_cepre_unca_sunedu.png", "alt":"UNCA","width":"350") }}

                  </div>
                  <div class="navbar-header">
                    <div>
                      <header class="ms-header ms-header-primary-blue-white">
                      <div class="container container-full-blue-white">
                        <a class="navbar-brand"  href="admision">
                      <!-- <img src="assets/img/demo/logo-navbar.png" alt="">-->
                      <!--IMAGEN SITIO RESPONSIVE-->
                      
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/logo_cepre_unca_sunedu.png", "alt":"UNCA","id":"unca-logo", "class":"img-responsive") }}
                    
                      <!--
                      <span class="ms-title"><strong>UNCA</strong></span>
                      -->
                    

                      </a>


                      </div>
                      </header>
                    </div>
                    
                  </div>
                  <div class="collapse navbar-collapse" id="ms-navbar">
                    <ul class="navbar-nav" style="width: 1010px;">
                      <li class="nav-item dropdown dropdown-megamenu-container">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-university"></i>&nbsp;Cepre UNCA<i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x" id="dropdown-menu-arcjas">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">INSTITUCIONAL</h3>
                                  <ul class="megamenu-block-list">
                                        <li><a href="{{ url('cepre-presentacion.html') }}"><i class="fa fa-caret-right"></i>Presentación </a></li>
                                        <li><a href="{{ url('cepre-mision-vision.html') }}"><i class="fa fa-caret-right"></i>Misión y Visión </a></li>
                                        <li><a href="{{ url('web-comision-organizadora.html') }}"><i class="fa fa-caret-right"></i>Autoridades </a></li>
                                        <li><a href="{{ url('cepre-direccion.html') }}"><i class="fa fa-caret-right"></i>Dirección de CEPRE-UNCA </a></li>	
                                        <li><a class="withripple" href="javascript:void(0)"></a></li>
                                  </ul>
                                </div>

                              </div>
                              
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">CEPRE-2024</h3>
                                  <ul class="megamenu-block-list">
                                        <li><a href="{{ url('cepre-ciclo-intensivo.html') }}"><i class="fa fa-caret-right"></i>Ciclo Intensivo</a></li>
                                        
                                        
                                  </ul>
                                </div>

                              </div>

                              

                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">INSCRIPCIÓN</h3>
                                  <ul class="megamenu-block-list">
                                    <li><a href="{{ url('cepre-documentos-inscripcion.html') }}"><i class="fa fa-caret-right"></i>Documentos de Inscripción</a></li>    
                                    <li><a href="{{ url('cepre-proceso-inscripcion.html') }}"><i class="fa fa-caret-right"></i>Proceso de Inscripción</a></li>
                                    <li><a href="{{ url('cepre-cuenta.html') }}"><i class="fa fa-caret-right"></i>Costos de Inscripción</a></li>                                                                                
                                  </ul>
                                </div>

                              </div>
                            
                            </div>
                          </li>
                        </ul>
                      </li>                      
                      
                      <li class="nav-item dropdown dropdown-megamenu-container">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-graduation-cap"></i>&nbsp;Carreras Profesionales <i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-6 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">CARRERAS PROFESIONALES DE INGENIERÍA</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a target="_blank" href="{{ url('web-detalle-carrera/0101.html') }}"><i class="fa fa-caret-right"></i>Ingeniería Agrícola y Forestal</a></li>
                                            <li><a target="_blank" href="{{ url('web-detalle-carrera/0102.html') }}"><i class="fa fa-caret-right"></i>Ingeniería Civil y Diseño Arquitectónico</a></li>
                                            <li><a target="_blank" class="withripple" href="javascript:void(0)"></a></li>
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-6 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">CARRERAS PROFESIONALES DE GESTIÓN</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a target="_blank" href="{{ url('web-detalle-carrera/0201.html') }}"><i class="fa fa-caret-right"></i>Gestión Turística, Hotelería y Gastronomía</a></li>
                                  </ul>
                                </div>
                              </div>

                            </div>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown dropdown-megamenu-container">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-book"></i>&nbsp;Exámen Cepre UNCA<i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-6 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">PROGRAMACIÓN</h3>
                                  <ul class="megamenu-block-list">
                                    <li><a href="{{ url('cepre-primer-examen.html') }}"><i class="fa fa-caret-right"></i>Primer Examen</a></li>        
                                    <li><a href="{{ url('cepre-segundo-examen.html') }}"><i class="fa fa-caret-right"></i>Segundo Examen</a></li>
                                        
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-6 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">RECOMENDACIONES</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('cepre-recomendaciones.html') }}"><i class="fa fa-caret-right"></i>Recomendaciones a seguir</a></li>
                                            <li><a href="{{ url('cepre-preguntas-frecuentes.html') }}"><i class="fa fa-caret-right"></i>Preguntas Frecuentes</a></li>    
                                            
                                  </ul>
                                </div>
                              </div>
                              
                             
                            </div>
                          </li>
                        </ul>
                      </li>
                      
                      
                      
                      <!--
                      <li>
                        <a target="_blank" href="https://www.transparencia.gob.pe/enlaces/pte_transparencia_enlaces.aspx?id_entidad=18813&id_tema=1&ver=D" style="color: #000000; text-decoration: none;" >
                        {{ image("https://www.unca.edu.pe/webpage/assets/img/enlaces/logo-portal-transparencia.png", "class":"img-responsive", "width":"140", "height": "50") }}
                        </a> 
                      </li>    
                      --> 

                    </ul>
                  </div>


                  <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
                

                </div><!-- container -->
              </nav>


              

              
              <?php
              $re_uri =  $_SERVER["REQUEST_URI"];
              ?>
              {% if  config.global.xAbrevIns  == 'UNCA' and re_uri=='/cepre'  %}
              <?php $this->partial('index/slider'); ?>
              {% endif %}
              

            
              

            </div>
            
            
          
            <div  id="slider-container">
            </div>

            <div class="ms-site-container"> 
              
      



