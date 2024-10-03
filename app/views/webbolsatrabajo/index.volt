{% block content %}
    <div class="ms-hero-page ms-hero-img-webbolsatrabajo ms-hero-bg-info">
        <div class="container">
            <div class="text-center">
                <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">DESCUBRE TU TRABAJO IDEAL.</h1>

                {{ form('webbolsatrabajo/listado','method': 'get','class':'mt-4 mw-800 center-block animated fadeInUp') }}
                {#<form class=" mt-4 mw-800 center-block animated fadeInUp">#}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group label-floating input-group ">
                            <label class="control-label color-white" for="ms-class-zip"><i class="zmdi zmdi-book mr-1"></i> Puesto deseado o especilidad (Escribre la palabra clave)</label>
                            <input type="text" id="ms-class-zip" class="form-control color-white" name="palabra_clave">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-block"><i class="zmdi zmdi-search"></i> Buscar</button>
                {#</form>#}
                {{ endForm() }}

            </div>
        </div>
    </div>
    <br>
    <div class="row d-flex justify-content-center">
        {% for  empleo in empleos %}
            <div class="col-lg-4 col-md-6" style="padding-left: 25px;padding-right: 25px;">
                <div class="card card-light-inverse">


                    <div class="card-body" style="margin-top: 5px;">
                        <center>
                            <th style="font-size: 8px;"><i class="zmdi zmdi-tag mr-1 color-warning"></i> Título </th><p style="margin-top: -8px;">
                                {{ utilidades.partedescripcion(empleo.titulo,0,60)}}
                            <hr style="margin-top: -8px;">
                            <th style="font-size: 8px;"><i class="zmdi zmdi-account mr-1 color-success"></i> Razón Social </th><p style="margin-top: -8px;">
                                {{ empleo.razon_social}}      
                            <hr style="margin-top: -8px;">
                            <th style="font-size: 8px;"><i class="zmdi zmdi-assignment mr-1 color-warning"></i> Descripción:</th><p style="margin-top: -8px;">
                                {{ utilidades.partedescripcion(empleo.descripcion,0,80)}}  ...                     
                            <hr style="margin-top: -8px;">
                            <th style="font-size: 8px;"><i class="zmdi zmdi-money-box mr-1 color-danger"></i> Remuneración:</th>
                                S/.{{ empleo.salario}}                               
                            <br><br>
                        </center>
                        <p class="text-center">                    
                            <a href="{{ url('web-bolsatrabajo/detalle-empleo/'~empleo.id_empleo~'.html') }}" class="btn btn-primary btn-raised text-right" role="button">
                                <i class="zmdi zmdi-plus"></i><span>Ver Detalles</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    <center>
        <a href="{{ url('web-bolsatrabajo/listado.html') }}" class="btn btn-primary btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Ver más Trabajos</span>
        </a>
    </center>
{% endblock %}