
<div class="row">
  {% for noticia in noticias %}
  <div class="content col-lg-4 col-md-6 col-sm-6 mb-2">
    <div class="container">
      <div class="row align-items-center justify-content-center">
          <div class="col-md-12" style="background-color: white;width: 100%;padding: 0px;box-shadow: 2px 0px 5px #c1bbbb;margin-top:30px;">
          
          <div class="mb-12" style="align-content: center;">
              {{ image("adminpanel/imagenes/noticias/"~noticia.imagen, "width":"100%", "height":"220") }}
          </div>
          
          <div style="border-top: 5px solid #326ab7; height: 2px; max-width: 100%; padding: 0; margin: 0px auto 0 auto; ">
          </div>  
          
          <div style="padding: 10px;">
            <a href="{{ url('web-detalle-noticia/'~noticia.id_noticia~".html") }}">
            <h4><p style="font-size:18px; color: #326ab7;"> <strong>{{ utilidades.partedescripcion(noticia.titular,0,120)}}</strong></p></a>
            <span class="font-lato" style="font-size:12px;">{{ utilidades.fechita(noticia.fecha_hora,"d/m/Y")}}</span></h4>
            <p style="text-align:justify; font-size:12px;">{{ utilidades.partedescripcion(noticia.texto_muestra,0,200)}}</p>
        
         
          </div>
        </div>
      </div>
    </div>
  </div>    
  {% endfor %}
</div>

  <div style="margin-top: 10px;">
    <center>
        <a href="web-noticias.html" class="btn btn-primary btn-raised text-right" role="button">              
            Ver más noticias
        </a>
        
    </center>
    </div>



<!--
    <div class="row">
        {% for noticia in noticias %}                                 
                <div class="col-lg-4 col-md-6 col-sm-6 mb-2">
                  <div class="ms-icon-feature wow flipInX">
                    <div class="ms-icon-feature-icon">
                      {{ image("adminpanel/imagenes/noticias/"~noticia.imagen, "width":"60", "height":"60") }}
                    </div>
                    <div class="ms-icon-feature-content">
                        <a href="{{ url('web-detalle-noticia/'~noticia.id_noticia~".html") }}">
                        <h4 class="color-primary"><p style="font-size:14px;"> <strong>{{ utilidades.partedescripcion(noticia.titular,0,120)}}</strong></p></a>
                        <i class="fa fa-calendar"></i><span class="font-lato" style="font-size:11px;"> &nbsp; {{ utilidades.fechita(noticia.fecha_hora,"d/m/Y")}}</span></h4>
                        <h6><p style="text-align:justify; font-size:12px;">{{ utilidades.partedescripcion(noticia.texto_muestra,0,200)}}</p></h6>
                    </div>
                  </div>
                </div>
        {% endfor %}
                
    </div>
    <div style="margin-top: -20px;">
    <center>
        <a href="web-noticias.html" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Noticias anteriores</span>
        </a>
        
    </center>
    </div>
-->   
