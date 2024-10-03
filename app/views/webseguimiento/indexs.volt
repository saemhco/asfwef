{% block content %}
<div class="ms-hero-page ms-hero-img-webbolsatrabajo ms-hero-bg-info">
    <div class="container">
        <div class="text-center">
            <h1
                class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">
                DESCUBRE TU TRABAJO IDEAL.</h1>

            {{ form('webbolsatrabajo/listado','method': 'get','class':'mt-4 mw-800 center-block animated fadeInUp') }}
            {#<form class=" mt-4 mw-800 center-block animated fadeInUp">#}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group label-floating input-group ">
                            <label class="control-label color-white" for="ms-class-zip"><i
                                    class="zmdi zmdi-book mr-1"></i> Puesto deseado o especilidad (Escribre la palabra
                                clave)</label>
                            <input type="text" id="ms-class-zip" class="form-control color-white" name="palabra_clave">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-block"><i class="zmdi zmdi-search"></i>
                    Buscar</button>
                {#
            </form>#}
            {{ endForm() }}

        </div>
    </div>
</div>
<br>
<div class="row d-flex justify-content-center">
    {% for servicio in servicios %}
    <div class="col-lg-3">
        <div class="card card-light-inverse">
            <div class="withripple zoom-img" style="margin-top: 30px;">
                <a href="{{ url('web-detalle-servicio/'~servicio.id_servicio~" .html") }}">
                    <center>{{ image("adminpanel/imagenes/servicios/"~servicio.imagen, "width":"258", "height":"172") }}
                    </center>
                </a>
            </div>
            <div class="card-body" style="margin-top: -15px;">
                <h6 class="color-primary">
                    <p>{{ utilidades.partedescripcion(servicio.titular,0,90)}} ...x</p>
                </h6>
                <h6>
                    <p style="text-align:justify;">{{ utilidades.partedescripcion(servicio.texto_muestra,0,110)}} &nbsp
                        ...</p>
                </h6>
                <p class="text-center">
                    <a href="{{ url('web-detalle-servicio/'~servicio.id_servicio~" .html") }}"
                        class="btn btn-primary btn-raised text-right" role="button">
                        <i class="zmdi zmdi-plus"></i><span>Leer Más</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
    {% endfor %}

</div>
<center>
    <a href="web-servicios.html" class="btn btn-primary btn-raised text-right" role="button">
        <i class="fa fa-mail-forward"></i>
        <span>Más Servicios</span>
    </a>
</center>

{% endblock %}