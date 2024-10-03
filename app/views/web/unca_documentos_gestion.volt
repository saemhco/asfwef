{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Documentos de Gestión
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">		
                <div class="card card-primary">
                    <div class="card-header">
                           <h3 class="card-title"><span>Documentos de Gestión</span></h3>
                    </div>
                    <div class="card-body">
                        <div class="heading-title heading-border-bottom heading-color">
                                                <h3><span>Estatuto</span></h3>
                                        </div>
                                        <ul style="list-style-type: disc;">
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'estatuto'~".html") }}" >Estatuto de la UNCA.</a></span></h4>
                                                </li>
                                        </ul>
                                        <div class="heading-title heading-border-bottom heading-color">
                                                <h3><span>Documentos de Gestión</span></h3>
                                        </div>
                                        <ul style="list-style-type: disc;">
                                                
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'pei'~".html") }}" >Plan Estrat&eacute;gico Institucional (PEI).</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'rof'~".html") }}" >Reglamento de Organizaci&oacute;n y Funciones (ROF).</a></span></h4>
                                                </li>
                                                
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'pia-2020'~".html") }}" >Presupuesto Institucional de Apertura 2020 (PIA).</a></span></h4>
                                                </li>
                                                
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'tupa'~".html") }}" >Texto &Uacute;nico de Procedimientos Administrativos (TUPA).</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'pac'~".html") }}" >Plan Anual de Contrataciones (PAC).</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'cap'~".html") }}" >Cuadro de Asignación de Personal (CAP).</a></span></h4>
                                                </li>
                                        </ul>
                                        <div class="heading-title heading-border-bottom heading-color">
                                                <h3><span>Reglamentos</span></h3>
                                        </div>
                                        <ul style="list-style-type: disc;">
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-estudiantes'~".html") }}" >Reglamento de Estudiantes.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-general-investigacion'~".html") }}" >Reglamento General de Investigación.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-desempeño-docente'~".html") }}" >Reglamento de Desempeño Docente.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-asistencia-permanencia-personal-docente'~".html") }}" >Reglamento de Asistencia y Permanencia del Personal Docente.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-capacitacion-docente'~".html") }}" >Reglamento de Capacitación Docente.</a></span></h4>
                                                </li>                                                
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-ingreso-docencia-universitaria'~".html") }}" >Reglamento de Ingreso a la Docencia Universitaria.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-contrato-docente'~".html") }}" >Reglamento para Contrato Docente.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-ratificacion-ascenso-separacion-docente'~".html") }}" >Reglamento de Ratificación, Ascenso y Separación Docente.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-prevencion-intervencion-casos-hostigamiento-sexual'~".html") }}" >Reglamento para la Prevención e Intervención en casos de Hostigamiento Sexual.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'reglamento-interno-seguridad-salud-trabajo'~".html") }}" >Reglamento Interno de Seguridad y Salud en el Trabajo.</a></span></h4>
                                                </li>
                                        </ul>
                                        <div class="heading-title heading-border-bottom heading-color">
                                                <h3><span>Planes</span></h3>
                                        </div>
                                        <ul style="list-style-type: disc;">
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'plan-gestion-calidad-institucional'~".html") }}" >Plan de Gestión de la Calidad Institucional.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'plan-anual-capacitacion-docente'~".html") }}" >Plan Anual de Capacitación Docente.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'plan-seguimiento-graduado'~".html") }}" >Plan de Seguimiento al Graduado.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'plan-mantenimiento-infraestructura'~".html") }}" >Plan de Mantenimiento de Infraestructura.</a></span></h4>
                                                </li>
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'plan-proteccion-ambiental-2020'~".html") }}" >Plan de Protección Ambiental 2020.</a></span></h4>
                                                </li>
                                        </ul>
                                    <div class="heading-title heading-border-bottom heading-color">
                                                <h3><span>Políticas</span></h3>
                                        </div>
                                        <ul style="list-style-type: disc;">
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'politica-ambiental-unca'~".html") }}" >Política Ambiental de la Universidad Nacional Ciro Alegría.</a></span></h4>
                                                </li>
                                                
                                        </ul>
                                    
                                    <!--    <div class="heading-title heading-border-bottom heading-color">
                                                <h3><span>Directivas</span></h3>
                                        </div>
                                        <ul style="list-style-type: disc;">
                                                <li>
                                                <h4><a style="text-decoration: none;" href="{{ url('documentos/'~'procedimiento-contratacion-bienes-servicios-montos-menores-iguales-8-uit'~".html") }}" >Directiva Procedimiento para la Contratación de Bienes y Servicios para montos menores o iguales a 8 UIT.</a></span></h4>
                                                </li>
                                                
                                        </ul>
                                    -->
                    </div>
                </div>                	
            </div>		
        </div>
    </div>
</div>
{% endblock %}