<aside class="ms-footbar">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 ms-footer-col">  
              <div class="ms-footbar-block">                
                <h3 class="ms-footbar-title">{{ config.global.xNombreIns }}</h3><hr>                
                <p class="margin-bottom-20">{{ config.global.xDescripcionIns }}</p>
                
                  <!-- Publications -->
                    <div class="g-mb-50">
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-like" data-href="https://www.facebook.com/www.cv.com.pe" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                    </div>
                    <!-- End Publications -->                 
                </div>
              
            </div>
            <div class="col-lg-3 col-md-7 ms-footer-col">
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title">Enlaces</h3><hr>
                <ul class="footer-links list-unstyled">
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-presentacion.html') }}">&nbsp;&nbsp; Presentación</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-mision-vision.html') }}">&nbsp;&nbsp; Misión y Visión</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-objetivos.html') }}">&nbsp;&nbsp; Objetivos</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-tips.html') }}">&nbsp;&nbsp; Tips</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-novedades.html') }}">&nbsp;&nbsp; Novedades</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-testimonios.html') }}">&nbsp;&nbsp; Testimonios</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('galerias.html') }}">&nbsp;&nbsp; Galeria de Imágenes</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="{{ url('cv-videos.html') }}">&nbsp;&nbsp; Videos</a></li><p/>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-7 ms-footer-col">
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title">Enlaces Externos</h3><hr>
                <ul class="footer-links list-unstyled">
                    <li><i class="fa fa-check"></i><a href="https://www.perutrabajos.com">&nbsp;&nbsp; Perú Trabajos</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="https://www.empleosperu.gob.pe">&nbsp;&nbsp; Empleos Perú</a></li><p/>
                    <li><i class="fa fa-check"></i><a href="https://www.portaltrabajos.pe">&nbsp;&nbsp; Portal de Tranajos Perú</a></li><p/>
                    
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 ms-footer-col ms-footer-text-right">
              <div class="ms-footbar-block">
                <div class="ms-footbar-title">
                    <h3 class="no-m ms-site-title"><span>Contáctenos</span></h3>
                </div><hr>
                <address class="no-mb">
                    
                    <ul class="footer-links list-unstyled">
                      <i></i><strong>cv - YURIMAGUAS</strong><br />
                        <i class="fa fa-home"></i>&nbsp Jr. Coronel Portillos # 707 <br />
                        <i class="fa fa-whatsapp"></i>&nbsp <a href="https://api.whatsapp.com/send?phone=+51986148600"> +51 986148600 </a><br />   
                      <i></i><strong>cv - MORALES </strong><br />
                          <i class="fa fa-home"></i>&nbsp Jr. Alfonso Ugarte # 251. <br />
                          <i class="fa fa-whatsapp"></i>&nbsp <a href="https://api.whatsapp.com/send?phone=+51986148600"> +51 986148600 </a><br />   
                        <i></i><strong>cv - TARAPOTO </strong><br />
                          <i class="fa fa-home"></i>&nbsp Jr. Jose Olaya # 365 <br />
                          <i class="fa fa-whatsapp"></i>&nbsp <a href="https://api.whatsapp.com/send?phone=+51986148600"> +51 986148600 </a><br />   
                         
                    
                        
                          
                    </ul>
                </address>                
              </div>              
            </div>
          </div>
        </div>
</aside>
<footer class="ms-footer">
    <div class="container">
        <p>Copyright © 2023 Diseñado por  <a target="_blank" href="http://unca.edu.pe">Oficina de Tecnologías de la Información </a> - Todos los derechos reservados.</p>
    </div>
</footer>
                    
      <div class="btn-back-top">
        <a href="javascript:void(0)" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised "><i class="zmdi zmdi-long-arrow-up"></i></a>
      </div>
    </div> <!-- ms-site-container -->
    
    <div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
      <div class="sb-slidebar-container">
        <header class="ms-slidebar-header">          
          <div class="ms-slidebar-title">
            <form class="search-form">
              <input id="search-box-slidebar" type="text" class="search-input" placeholder="Search..." name="q" />
              <label for="search-box-slidebar"><i class="zmdi zmdi-search"></i></label>
            </form>
            <div class="ms-slidebar-t">
              
              <h5><span>{{ config.global.xNombreIns }}</span></h5>
            </div>
          </div>
        </header>
        <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">
            <li>
                <a class="link" href="{{ url('web') }}"><i class="zmdi zmdi-link"></i> Inicio</a>
            </li>
            <li>
                <a class="link" href="{{ url('directorio-administrativos.html') }}"><i class="zmdi zmdi-link"></i> Directorio - cv</a>
            </li>
            <li>
                <a class="link" href="{{ url('https://www.cv.com.pe/webmail') }}"><i class="zmdi zmdi-link"></i> Correo - cv</a>
            </li>
            <li class="card" role="tab" id="sch1">
                <a class="collapsed" role="button" data-toggle="collapse" href="#sc1" aria-expanded="false" aria-controls="sc1">
                    <i class="zmdi zmdi-balance"></i> Nuestra empresa 
                </a>
                <ul id="sc1" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch1" data-parent="#slidebar-menu">
                    <li><a class="withripple" href="{{ url('cv-presentacion.html') }}"><i class="fa fa-caret-right"></i>Presentación</a></li>
                    <li><a class="withripple" href="{{ url('cv-direccion.html') }}"><i class="fa fa-caret-right"></i>Dirección</a></li>
                    
                </ul>
            </li>            
            <li>
                <a class="link" href="{{ url('cv-mision-vision.html') }}"><i class="zmdi zmdi-link"></i> Misión y Visión</a>
            </li>
            <li>
                <a class="link" href="{{ url('cv-objetivos.html') }}"><i class="zmdi zmdi-link"></i> Objetivos</a>
            </li>
            <li>
              <a class="link" href="{{ url('cv-tips.html') }}"><i class="zmdi zmdi-link"></i> Tips</a>
            </li>           
            <li>
              <a class="link" href="{{ url('cv-novedades.html') }}"><i class="zmdi zmdi-link"></i> Novedades</a>
            </li>
            <li>
              <a class="link" href="{{ url('cv-testimonios.html') }}"><i class="zmdi zmdi-link"></i> Testimonios</a>
            </li>
            <li>
              <a class="link" href="{{ url('galerias.html') }}"><i class="zmdi zmdi-link"></i> Galerias</a>
            </li>
            <li>
              <a class="link" href="{{ url('videos.html') }}"><i class="zmdi zmdi-link"></i> Videos</a>
            </li>
            
        </ul>
        <div class="ms-slidebar-social ms-slidebar-block">
            <h4 class="ms-slidebar-block-title">Redes Sociales</h4>
            <div class="ms-slidebar-social">
                <a target="_blank" href="https://www.facebook.com/www.cv.com.pe" class="btn-circle btn-circle-raised btn-facebook"><i class="zmdi zmdi-facebook"></i> 
                    <div class="ripple-container"></div>
                </a>
                <a target="_blank" href="https://www.facebook.com/www.cv.com.pe" class="btn-circle btn-circle-raised btn-youtube"><i class="zmdi zmdi-youtube"></i> 
                    <div class="ripple-container"></div>
                </a>
                <a target="_blank" href="https://www.facebook.com/www.cv.com.pe" class="btn-circle btn-circle-raised btn-google"><i class="zmdi zmdi-google"></i>
                    <div class="ripple-container"></div>
                </a>
            </div>
        </div>
      </div>
    </div> 
    
<script language="JavaScript">
    //Ajusta el tamaño de un iframe al de su contenido interior para evitar scroll 
    function autofitIframe(id) {
        if (!window.opera && document.all && document.getElementById) {
            id.style.height = id.contentWindow.document.body.scrollHeight;
        } else if (document.getElementById) {
            id.style.height = id.contentDocument.body.scrollHeight + "px";
        }
    }
</script> 


<!-- JAVASCRIPT FILES -->

{{ javascript_include('webpage/assets/js/plugins.min.js') }}
{{ javascript_include('webpage/assets/js/index.js') }}
{{ javascript_include('webpage/assets/js/lead.js') }}
{{ javascript_include('webpage/assets/js/app.min.js') }}

<!-- js customized -->
{{ assets.outputJs() }}


<!-- REVOLUTION SLIDER -->
{{ javascript_include('webpage/assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js') }}
{{ javascript_include('webpage/assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js') }}
{{ javascript_include('webpage/assets/js/view/demo.revolution_slider.js') }}

{#{{ javascript_include('webpage/assets/plugins/bootstrap/js/bootstrap.min.js') }}#}
{{ javascript_include('adminpanel/js/bootbox.min.js') }}
     
    </body>
</html>