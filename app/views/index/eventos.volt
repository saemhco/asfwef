<div class="row">
    {% for evento in eventos %}
    <div class="content col-lg-4 col-md-6 col-sm-6 mb-2">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12" style="background-color: white;width: 100%;padding: 0px;box-shadow: 2px 0px 5px #c1bbbb;margin-top:30px;">
            
            <div class="mb-12" style="align-content: center;">
              {{ image("adminpanel/imagenes/eventos/"~evento.imagen, "width":"100%", "style":"object-fit: contain;max-height: 372px;") }}
            </div>

            <div style="border-top: 5px solid #326ab7; height: 2px; max-width: 100%; padding: 0; margin: 0px auto 0 auto; ">
            </div>  
          
              <div style="padding: 10px;">
              <a href="{{ url('web-detalle-evento/'~evento.id_evento~".html") }}">
              <h4><p style="font-size:18px; color: #326ab7;"> <strong>{{ utilidades.partedescripcion(evento.titular,0,120)}}</strong></p></a>
              <span class="font-lato" style="font-size:12px;">{{ utilidades.fechita(evento.fecha_hora,"d/m/Y")}}</span></h4>
              <p style="text-align:justify; font-size:12px;">{{ utilidades.partedescripcion(evento.texto_muestra,0,200)}}</p>
          
           
          </div>
          </div>
        </div>
      </div>
    </div>    
    {% endfor %}
    
  </div>

    <div style="margin-top: 10px;">
      <center>
          <a href="web-eventos.html" class="btn btn-primary btn-raised text-right" role="button">              
              Ver más eventos
          </a>
          
      </center>
      </div>



<!--
<p/>
    <div class="row d-flex justify-content-center">
        {% for evento in eventos %} 
            <div class="col-lg-3 col-md-6">
                <div class="card card-light-inverse">
                  <div class="withripple zoom-img" style="margin-top: 30px;">
                    <a href="{{ url('web-detalle-evento/'~evento.id_evento~".html") }}"><center>{{ image("adminpanel/imagenes/eventos/"~evento.imagen, "width":"258", "height":"172") }}</center></a>
                </div>
                <div class="card-body" style="margin-top: -15px;">
                    <h6 class="color-primary"><p>{{ evento.titular }}</p><i class="fa fa-clock-o"></i><span class="font-lato"> &nbsp; {{ utilidades.fechita(evento.fecha_hora,"d/m/Y")}}</span></h6>
                    <p class="text-center">                    
                            <a href="{{ url('web-detalle-evento/'~evento.id_evento~".html") }}" class="btn btn-warning btn-raised text-right" role="button">
                                <i class="zmdi zmdi-plus"></i><span>Leer Más</span>
                            </a>
                    </p>
                </div>
            </div>
          </div>
        {% endfor %}
    </div>
    <center>
        <a href="web-eventos.html" class="btn btn-warning btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Eventos anteriores</span>
        </a>
    </center>
-->