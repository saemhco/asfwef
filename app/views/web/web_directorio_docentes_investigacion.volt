{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Directorio
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;"> 	
		<div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Personal Docente que realiza Investigación</strong></h3>
                    </div>
                    <div class="card-body">                                                                              					
                        <table class="table table-responsive table-bordered">
                                <thead>
                                        <tr>
                                                <th width="10%" style="vertical-align: middle;text-align: center;"><h5><center>IMÁGEN</center></h5></th>
                                                <th width="30%" style="vertical-align: middle;text-align: center;"><h5><center>APELLIDOS Y NOMBRES</center></h5></th>
                                                <th width="10%" style="vertical-align: middle;text-align: center;"><h5><center>GRADO ACADÉMICO</center></h5></th>
                                                <th width="10%" style="vertical-align: middle;text-align: center;"><h5><center>MENCIÓN</center></h5></th>
                                                <th width="10%" style="vertical-align: middle;text-align: center;"><h5><center>CATEGORÍA DOCENTE</center></h5></th>
                                                <th width="10%" style="vertical-align: middle;text-align: center;"><h5><center>RÉGIMEN DE DEDICACIÓN</center></h5></th>
                                                <th width="30%" style="vertical-align: middle;text-align: center;"><h5><center>CORREO ELECTRÓNICO</center></h5></th>
                                        </tr>
                                </thead>
                                <tbody>
                                    {% for  personal in personales %} 
                                        <tr>                                                                           
                                                <td>                                                
                                                <center>
                                                    <div class="ms-thumbnail-container">
                                                        <figure class="ms-thumbnail ms-thumbnail-diagonal">
                                                            {{ image("adminpanel/imagenes/docentes/"~personal.foto, "class":"img-responsive", "style":"width:120px;height:80px;") }}
                                                            <figcaption class="ms-thumbnail-caption text-center">
                                                                <div class="ms-thumbnail-caption-content">
                                                                    <a target="_blank" href="https://ctivitae.concytec.gob.pe/appDirectorioCTI/VerDatosInvestigador.do?id_investigador={{ personal.concytec_enlace }}" class="btn btn-success btn-raised">CV</a>
                                                                </div>
                                                            </figcaption>
                                                        </figure>
                                                    </div>
                                                </center>
                                                </td>

                                                <td style="vertical-align: middle;"><h6>
                                                    <div class="ms-thumbnail-caption-content">
                                                        <a target="_blank" href="https://ctivitae.concytec.gob.pe/appDirectorioCTI/VerDatosInvestigador.do?id_investigador={{ personal.concytec_enlace }}">{{ personal.apellidop}} {{ personal.apellidom }}, {{ personal.nombres}}</a>
                                                    </div>
                                                </h6></td>

                                                <td style="vertical-align: middle;text-align: center;"><h6>
                                                {{ personal.grado_d}} 
                                                </h6></td>

                                                <td style="vertical-align: middle;text-align: center;"><h6>
                                                {{ personal.grado_mencion_mayor}} 
                                                </h6></td>

                                                <td style="vertical-align: middle;text-align: center;"><h6>
                                                {{ personal.categoria_d}} 
                                                </h6></td>

                                                <td style="vertical-align: middle;text-align: center;"><h6>
                                                {{ personal.regimen_d}} 
                                                </h6></td>

                                                <td style="vertical-align: middle;"><h6>
                                                {{ personal.email1}} 
                                                </h6></td>
                                        </tr>
                                    {% endfor %}                                                                            
                                </tbody>
                        </table>                                        
                    </div>
                </div>                		
            </div>		
        </div>
    </div>
</div>
{% endblock %}
