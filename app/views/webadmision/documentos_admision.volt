
{% block content %}
   

<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Documentos de Admisión 2024 - I
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php //$this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">            				
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Descarga y lee los documentos</strong></h3>
                    </div>
                    <div class="card-body">
                        

                        <table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">

                            <thead>
                                <tr style="background:{{ config.global.xColorIns }};">
                                    <th>
                                        <center>
                                            <font color="#FFFFFF">DOCUMENTO</font< /center>
                                    </th>
                                    <th>
                                        <center>
                                            <font color="#FFFFFF">DESCARGAR</font< /center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for convocatoria in convocatorias1 %}
                                <tr>
                                    <td style="color: #000000; vertical-align: middle;">
                                        <a style="color: #000000;"
                                            href="../adminpanel/archivos/convocatorias/{{ convocatoria.archivo }}"
                                            target="_blank"> {{ convocatoria.titulo }} </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <center>
                                            <a href="../adminpanel/archivos/convocatorias/{{ convocatoria.archivo }}"
                                                target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-1">
                                                <i class="fa fa-download"></i> Descargar
                                            </a>
                                        </center>
                                    </td>                                        
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