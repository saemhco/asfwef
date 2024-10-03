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
            <a  href="#" class="btn-circle btn-circle-white animated zoomInDown animation-delay-7"><i class="zmdi zmdi-phone"></i></a><label style="font-size: 13px;">+ 51 926 239 616</label>
            <a  href="#" class="btn-circle btn-circle-white animated zoomInDown animation-delay-7"><i class="zmdi zmdi-email-open"></i></a><label style="font-size: 13px;"> informes@unca.edu.pe </label>         
          

            <div class="header-right" >                    
              
              <a target="_blank" href="https://www.unca.edu.pe/login.html">
              <label style="font-size: 13px; color: white; cursor: pointer;">ESTUDIANTES</label>
              </a>

              &nbsp;&nbsp;&nbsp;&nbsp;
              <a target="_blank" href="https://www.unca.edu.pe/login.html">
              <label style="font-size: 13px; color: white; cursor: pointer;">DOCENTES</label>
              </a>
              
             
              <!--
              &nbsp;&nbsp;&nbsp;&nbsp;              
              <label style="font-size: 13px; color: white; cursor: pointer;">EGRESADOS</label>
              -->
              
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a target="_blank" href="https://www.unca.edu.pe/login-interno.html">
              <label style="font-size: 13px; color: white; cursor: pointer;">ADMINISTRATIVOS</label>
              </a>
            
              &nbsp;&nbsp;&nbsp;&nbsp;
            
              <!--
              <a target="_blank" href="https://reclamos.servicios.gob.pe/?institution_id=230" style="color: #000000; text-decoration: none;" >
                {{ image("https://www.unca.edu.pe/webpage/assets/img/enlaces/libro.png", "class":"img-responsive", "width":"90", "height": "38") }}
              </a>
              --> 

              <a target="_blank" href="https://www.gob.pe/institucion/sunedu/normas-legales/4711485-029-2023-sunedu-cd" style="color: #000000; text-decoration: none;" >
                {{ image("https://www.unca.edu.pe/webpage/assets/img/enlaces/licencia-sunedu-unca.png", "class":"img-responsive", "width":"255", "height": "40") }}
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
                    <a href="{{ url('') }}">
                      <!-- <img src="assets/img/demo/logo-header.png" alt="">-->
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/logo_unca_1.png", "alt":"UNCA") }}
                      <!--
                      <h1 class="animated fadeInRight animation-delay-6" style="margin-top:15px"><span>Universidad &nbsp; Nacional &nbsp; Ciro &nbsp; Alegría</span></h1>
                      -->
                    </a>
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="https://www.unca.edu.pe/web-transparencia-estandar.html" style="color: #000000; text-decoration: none;" >
                        {{ image("https://www.unca.edu.pe/webpage/assets/img/enlaces/logo-portal-transparencia.png", "class":"img-responsive", "width":"130", "height": "50") }}
                        </a> 


                        
                    <a href="https://www.unca.edu.pe/unca-transparencia-universitaria.html">
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/enlaces/btn_transparencia_universitaria.png", "class":"img-responsive", "width":"140", "height": "50") }}
                      </a> 

                  </div>

            
                  <div class="header-right">              

                    <!--
                    <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary ms-toggle-left animated zoomInDown animation-delay-100"><i class="zmdi zmdi-menu mdc-text-light-blue"></i></a>
                    -->   

                       <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
                       
                  </div>
                </div>
            </header>




              <nav class="navbar navbar-expand-md navbar-static ms-navbar ms-navbar-white " style="height: 50px;margin-bottom:0px!important;">
                <div class="container container-full" style="
   
">
                  <div class="responsive-logo">
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/logo_unca_1.png", "alt":"UNCA","width":"300") }}

                  </div>
                  <div class="navbar-header">
                    <div>
                      <header class="ms-header ms-header-primary-blue-white">
                      <div class="container container-full-blue-white">
                        <a class="navbar-brand" href="{{ url('') }}">
                      <!-- <img src="assets/img/demo/logo-navbar.png" alt="">-->
                      {{ image("https://www.unca.edu.pe/webpage/assets/img/logo_unca_1.png", "alt":"UNCA","id":"unca-logo", "class":"img-responsive") }}
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
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-university"></i>&nbsp;Universidad <i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x" id="dropdown-menu-arcjas">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">UNIVERSIDAD</h3>
                                  <ul class="megamenu-block-list">
                                        <li><a class="withripple" href="{{ url('unca-presentacion.html') }}"><i class="fa fa-caret-right"></i>Presentación</a></li>
                                        <li><a class="withripple" href="{{ url('unca-mision-vision.html') }}"><i class="fa fa-caret-right"></i>Misión y Visión</a></li>
                                        <li><a class="withripple" href="{{ url('web-documentos/'~'estatuto'~".html") }}"><i class="fa fa-caret-right"></i>Estatuto</a></li>
                                        <li><a class="withripple" href="{{ url('web-organigrama.html') }}"><i class="fa fa-caret-right"></i>Organigrama</a></li>
                                        <li><a class="withripple" href="{{ url('web-documentos-gestion.html') }}"><i class="fa fa-caret-right"></i>Documentos de Gestión</a></li>
                                        <li><a class="withripple" href="{{ url('web-resoluciones.html') }}"><i class="fa fa-caret-right"></i>Resoluciones </a></li>
                                        <li><a class="withripple" href="{{ url('web-actas-grupo.html') }}"><i class="fa fa-caret-right"></i>Actas </a></li>
                                        <li><a class="withripple" href="{{ url('unca-gestion-convenios.html') }}"><i class="fa fa-caret-right"></i>Gestión de Convenios</a></li>                                        
                                        <li><a class="withripple" href="{{ url('unca-gestion-ambiental.html') }}"><i class="fa fa-caret-right"></i>Gestión Ambiental</a></li>
                                        <li><a class="withripple" href="{{ url('unca-control-interno.html') }}"><i class="fa fa-caret-right"></i>Control Interno</a></li>                                        
                                        <li><a class="withripple" href="javascript:void(0)"></a></li>
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">AUTORIDADES</h3>
                                  <ul class="megamenu-block-list">
                                        <li><a href="{{ url('web-comision-organizadora.html') }}"><i class="fa fa-caret-right"></i>Comisión Organizadora </a></li>
                                        <li><a href="{{ url('web-autoridades/'~'presidente'~".html") }}"><i class="fa fa-caret-right"></i>Presidencia </a></li>
                                        <li><a href="{{ url('web-autoridades/'~'vpa'~".html") }}"><i class="fa fa-caret-right"></i>Vicepresidencia Académica </a></li>
                                        <li><a href="{{ url('web-autoridades/'~'vpi'~".html") }}"><i class="fa fa-caret-right"></i>Vicepresidencia de Investigación </a></li>	

                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">ÓRGANOS</h3>
                                  <ul class="megamenu-block-list">
                                        <li><a href="{{ url('web-areas/'~'dga'~".html") }}"><i class="fa fa-caret-right"></i>Administración</a></li>
                                        <li><a href="{{ url('web-areas/'~'sg'~".html") }}"><i class="fa fa-caret-right"></i>Secretaria General</a></li>
                                        <li><a href="{{ url('web-areas/'~'oti'~".html") }}"><i class="fa fa-caret-right"></i>Tecnologías de la Información</a></li>
                                        <li><a href="{{ url('web-areas/'~'oaj'~".html") }}"><i class="fa fa-caret-right"></i>Asesoria Jurídica</a></li>
                                        <li><a href="{{ url('web-areas/'~'opp'~".html") }}"><i class="fa fa-caret-right"></i>Planeamiento Estratégico</a></li>
                                        <li><a href="{{ url('web-areas/'~'ocri'~".html") }}"><i class="fa fa-caret-right"></i>Cooperación Técnica</a></li>
                                        <li><a href="{{ url('web-areas/'~'ogc'~".html") }}"><i class="fa fa-caret-right"></i>Gestión de la Calidad</a></li>
                                        <li><a href="{{ url('web-areas/'~'ocii'~".html") }}"><i class="fa fa-caret-right"></i>Comunicación e Imágen</a></li>
                                        
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">UNCA</h3>
                                  <ul class="megamenu-block-list">
                                        <li><a href="{{ url('web-directorio-administrativos.html') }}"><i class="fa fa-caret-right"></i>Directorio Administrativos</a></li>
                                        <li><a href="{{ url('web-directorio-docentes.html') }}"><i class="fa fa-caret-right"></i>Directorio Docentes</a></li>
                                        <li><a href="{{ url('unca-direccion.html') }}"><i class="fa fa-caret-right"></i>Ubíquenos</a></li>
                                        <li><a href="{{ url('unca-centro-pagos.html') }}"><i class="fa fa-caret-right"></i>Centros de Pagos</a></li>
                                        <li><a href="{{ url('web-convocatorias/'~'1'~".html") }}"><i class="fa fa-caret-right"></i>Trabaja con nosotros</a></li>                                        
                                        <li><a class="withripple" href="{{ url('web-transparencia-estandar.html') }}"><i class="fa fa-caret-right"></i>Portal Transparencia Estandar</a></li>
                                        <li><a class="withripple" href="{{ url('unca-transparencia-universitaria.html') }}"><i class="fa fa-caret-right"></i>Portal Transparencia Universitaria</a></li>																
                                        <li><a href="https://reclamos.servicios.gob.pe/?institution_id=230"><i class="fa fa-caret-right"></i>Libro de Reclamaciones</a></li>
                                        <li><a href="https://www.unca.edu.pe/login-tramite-documentario.html" target="_blank"><i class="fa fa-caret-right"></i>Mesa de Partes Virtual</a></li>
                                        
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
                                            <li><a href="{{ url('web-detalle-carrera/0101.html') }}"><i class="fa fa-caret-right"></i>Ingeniería Agrícola y Forestal</a></li>
                                            <li><a href="{{ url('web-detalle-carrera/0102.html') }}"><i class="fa fa-caret-right"></i>Ingeniería Civil y Diseño Arquitectónico</a></li>
                                            <li><a class="withripple" href="javascript:void(0)"></a></li>
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-6 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">CARRERAS PROFESIONALES DE GESTIÓN</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('web-detalle-carrera/0201.html') }}"><i class="fa fa-caret-right"></i>Gestión Turística, Hotelería y Gastronomía</a></li>
                                  </ul>
                                </div>
                              </div>

                            </div>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown dropdown-megamenu-container">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-book"></i>&nbsp;VP. Académica <i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">DIRECCIONES</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('web-areas/'~'da'~".html") }}"><i class="fa fa-caret-right"></i>Admisión</a></li>
                                            <li><a href="{{ url('web-areas/'~'dsa'~".html") }}"><i class="fa fa-caret-right"></i>Servicios Académicos</a></li>	
                                            <li><a href="{{ url('web-areas/'~'dbu'~".html") }}"><i class="fa fa-caret-right"></i>Bienestar Universitario</a></li>
                                            <li><a href="{{ url('web-areas/'~'drsu'~".html") }}"><i class="fa fa-caret-right"></i>Responsabilidad Social</a></li>
                                        
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">SERV. EDUC. COMPLEMENT.</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('web-detalle-servicio/1.html') }}"><i class="fa fa-caret-right"></i>Salud</a></li>
                                            <li><a href="{{ url('web-detalle-servicio/2.html') }}"><i class="fa fa-caret-right"></i>Social</a></li>
                                            <li><a href="{{ url('web-detalle-servicio/3.html') }}"><i class="fa fa-caret-right"></i>Psicopedagógico</a></li>
                                            <li><a href="{{ url('web-detalle-servicio/4.html') }}"><i class="fa fa-caret-right"></i>Deportivos</a></li>
                                            <li><a href="{{ url('web-detalle-servicio/5.html') }}"><i class="fa fa-caret-right"></i>Culturales y Artísticos</a></li>                                                               
                                            <li><a href="{{ url('web-detalle-servicio/6.html') }}"><i class="fa fa-caret-right"></i>Biblioteca</a></li>    
                                            
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title"></i>LABORATORIOS Y TALLERES</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('web-detalle-ambiente/11.html') }}"><i class="fa fa-caret-right"></i>Lab. de Computación e Idiomas</a></li>
                                            <li><a href="{{ url('web-detalle-ambiente/12.html') }}"><i class="fa fa-caret-right"></i>Lab. Física</a></li>
                                            <li><a href="{{ url('web-detalle-ambiente/13.html') }}"><i class="fa fa-caret-right"></i>Lab. Química, Edafología y Agrotec.</a></li>
                                            <li><a href="{{ url('web-detalle-ambiente/14.html') }}"><i class="fa fa-caret-right"></i>Lab. Biología</a></li>                                            
                                            <li><a href="{{ url('web-detalle-ambiente/15.html') }}"><i class="fa fa-caret-right"></i>Lab. Ensayo de Materiales</a></li>
                                            <li><a href="{{ url('web-detalle-ambiente/16.html') }}"><i class="fa fa-caret-right"></i>Lab. de Analítica</a></li>
                                            <li><a href="{{ url('web-detalle-ambiente/17.html') }}"><i class="fa fa-caret-right"></i>Taller de Dibujo Técnico</a></li>
                                            <li><a href="{{ url('web-detalle-ambiente/18.html') }}"><i class="fa fa-caret-right"></i>Gabinete de Topografía</a></li>
                                            
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">PLATAFORMAS VIRTUALES</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a target="_blank" href="{{ url('https://www.unca.edu.pe/login.html') }}"><i class="fa fa-caret-right"></i>Gestión de Matricula</a></li>
                                            <li><a target="_blank" href="{{ url('https://classroom.google.com/u/3/h?hl=es') }}"><i class="fa fa-caret-right"></i>Aprendizaje Virtual Classroom</a></li>
                                            <!--
                                            <li><a target="_blank" href="{{ url('https://www.unca.edu.pe/web-bolsatrabajo') }}"><i class="fa fa-caret-right"></i>Bolsa de Trabajo</a></li>
                                            <li><a target="_blank" href="{{ url('https://www.unca.edu.pe/web-biblioteca') }}"><i class="fa fa-caret-right"></i>Biblioteca</a></li>
                                            -->
                                            <li><a target="_blank" href="{{ url('https://www.unca.edu.pe/login.html') }}"><i class="fa fa-caret-right"></i>Gestión Docente</a></li>
                                            <li><a target="_blank" href="{{ url('https://www.unca.edu.pe/admin') }}"><i class="fa fa-caret-right"></i>Registros Académicos</a></li>
                                            <!--
                                            <li><a target="_blank" href="{{ url('https://www.unca.edu.pe/admin') }}"><i class="fa fa-caret-right"></i>Seguimiento al Graduado</a></li>
                                            -->
                                            <li><a target="_blank" href="{{ url('https://www.cajatrujillo.com.pe') }}"><i class="fa fa-caret-right"></i>Pagos Virtuales</a></li>
                                            <li><a class="withripple" href="javascript:void(0)"></a></li>
                                  </ul>
                                </div>

                              </div>
                            </div>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown dropdown-megamenu-container">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-flask"></i>&nbsp;VP. Investigación <i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">ÓRGANOS / UNIDADES</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('web-areas/'~'dpbs'~".html") }}"><i class="fa fa-caret-right"></i>Producción de Bienes y Servicios </a></li>
                                            <li><a href="{{ url('web-areas/'~'die'~".html") }}"><i class="fa fa-caret-right"></i>Incubadora de Empresas </a></li>
                                            <li><a href="{{ url('web-areas/'~'ditt'~".html") }}"><i class="fa fa-caret-right"></i>Innovación y Transf. Tecnológica </a></li>
                                            <li><a href="{{ url('web-areas/'~'ii'~".html") }}"><i class="fa fa-caret-right"></i>Instituto de Investigación</a></li>
                                            <li><a class="withripple" href="javascript:void(0)"></a></li>
                                    </ul>
                                  </div>

                                </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">PROYECTOS</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a href="{{ url('web-proyectos-investigacion.html') }}"><i class="fa fa-caret-right"></i>Proyectos de Investigación</a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">PLATAFORMAS VIRTUALES</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a target="_blank" href="http://repositorio.unca.edu.pe"><i class="fa fa-caret-right"></i>Repositorio Institucional</a></li>
                                            <li><a target="_blank" href="https://revistas.unca.edu.pe"><i class="fa fa-caret-right"></i>Revista Científica Huamachuco</a></li>
                                            <li><a target="_blank" href="https://app.compilatio.net/v5/login"><i class="fa fa-caret-right"></i>Compilatio Antiplagio</a></li>
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-3 megamenu-col">
                                <div class="megamenu-block animated fadeInRight animated-2x">
                                  <h3 class="megamenu-block-title">ENLACES - CONCYTEC</h3>
                                  <ul class="megamenu-block-list">
                                            <li><a target="_blank" href="{{ url('http://iopscience.iop.org') }}"><i class="fa fa-caret-right"></i>IOP Science</a></li>
                                            <li><a target="_blank" href="{{ url('http://www.sciencedirect.com') }}"><i class="fa fa-caret-right"></i>ScienceDirect</a></li>
                                  </ul>
                                </div>

                              </div>

                            </div>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown dropdown-megamenu-container">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="component"><i class="fa fa-dashboard"></i>&nbsp;G. Calidad <i class="zmdi zmdi-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-megamenu animated fadeIn animated-2x">
                          <li class="container">
                            <div class="row">
                              <div class="col-sm-4 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <a href="{{ url('web-licenciamiento1.html') }}"><h3 class="megamenu-block-title"> Condiciones Básicas de Calidad</h3></a>
                                  
                                    
                                  <ul class="megamenu-block-list">
                                    <li><a href="{{ url('web-licenciamiento1-cbc/'~'1'~".html") }}"><i class="fa fa-caret-right"></i>C. I  : Modelo Educativo de la Universidad.</a></li>
                                    <li><a href="{{ url('web-licenciamiento1-cbc/'~'2'~".html") }}"><i class="fa fa-caret-right"></i>C. II : Constitución, Gobierno y Gestión de la Universidad.</a></li>
                                    <li><a href="{{ url('web-licenciamiento1-cbc/'~'3'~".html") }}"><i class="fa fa-caret-right"></i>C. III: La Oferta Académica, Recursos Educativos y Docencia.</a></li>
                                    <li><a href="{{ url('web-licenciamiento1-cbc/'~'4'~".html") }}"><i class="fa fa-caret-right"></i>C. IV: Propuesta en Investigación.</a></li>
                                    <li><a href="{{ url('web-licenciamiento1-cbc/'~'5'~".html") }}"><i class="fa fa-caret-right"></i>C. V : Responsabilidad Social Universitaria y Bienestar Universitario.</a></li>
                                    <li><a href="{{ url('web-licenciamiento1-cbc/'~'6'~".html") }}"><i class="fa fa-caret-right"></i>C. VI: Transparencia.</a></li>
                                    <li><a class="withripple" href="javascript:void(0)"></a></li>
                                    
                                  </ul>
                                </div>

                              </div>
                              <div class="col-sm-4 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">Gestión por Procesos</h3>
                                  <ul class="megamenu-block-list">
                                    <li><a href="https://www.unca.edu.pe/web-documentos/mapa-de-procesos-unca.html"><i class="fa fa-caret-right"></i>Mapa de Procesos  de la UNCA</a></li>
                                    <li><a href="https://www.unca.edu.pe/web-documentos/manual-de-determinacion-de-procesos-en-la-unca.html"><i class="fa fa-caret-right"></i>Manual de Determinación de Procesos</a></li>
                                    <li><a href="https://www.unca.edu.pe/web-documentos/plan-de-implementacion-gestion-por-procesos.html"><i class="fa fa-caret-right"></i>Plan de Implementación GxP</a></li>
                                    <li><a href="https://www.unca.edu.pe/web-procesos-grupo.html"><i class="fa fa-caret-right"></i>Procesos</a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col-sm-4 megamenu-col">
                                <div class="megamenu-block animated fadeInLeft animated-2x">
                                  <h3 class="megamenu-block-title">Sistema de Gestión de Calidad</h3>
                                  <ul class="megamenu-block-list">
                                    <li><a href="https://www.unca.edu.pe/web-documentos/politica-de-calidad-institucional-de-la-universidad-nacional-ciro-alegria.html"><i class="fa fa-caret-right"></i>Política de Calidad Institucional</a></li>
                                    <li><a href="https://www.unca.edu.pe/web-documentos/alcance-del-sistema-de-gestion-de-la-calidad.html"><i class="fa fa-caret-right"></i>Alcance del Sistema de Gestión de Calidad</a></li>
                                    <li><a href="https://www.unca.edu.pe/web-documentos/objetivos-del-sistema-de-gestion-de-calidad.html"><i class="fa fa-caret-right"></i>Objetivos del Sistema de Gestión de Calidad</a></li>
                                    <li><a href="https://www.unca.edu.pe/web-documentos/instructivo-elaboracion-documentos-internos-sistema-gestion-calidad.html"><i class="fa fa-caret-right"></i>Instructivo para la elaboración de doc. internos </a></li>
                                    <li><a href="https://www.unca.edu.pe/web-documentos/manual-de-contexto.html"><i class="fa fa-caret-right"></i>Manual de Contexto </a></li>
                                    
                                    <!--
                                    <li><a href="https://www.unca.edu.pe/adminpanel/archivos/resoluciones/RES.%20PRES.%200023-2021-P-UNCA.pdf"><i class="fa fa-caret-right"></i>RAD en el Sistema de Gestión de Calidad </a></li>
                                    -->
                                    
                                    <li><a class="withripple" href="javascript:void(0)"></a></li>
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
              {% if  config.global.xAbrevIns  == 'UNCA' and re_uri=='/'  %}
              <?php $this->partial('index/slider'); ?>
              {% endif %}

            
              

            </div>
            
            
          
            <div  id="slider-container">
            </div>

            <div class="ms-site-container"> 
              
      



