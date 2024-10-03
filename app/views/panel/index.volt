
<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Bienvenido</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row" style ="margin-top: -16px;" >     
        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >	
                        <div class="row" style="overflow-x: hidden;">

                            <header>
                                <!--   <span class="widget-icon"> <i class="fa fa-home"></i> </span>-->
                                <!-- <h2>Bienvenido</h2>-->
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    


                                    {#                                    {% if perfil == 1 %}
                                                                            <center>
                                                                                <img class="img-responsive" src="{{ url('adminpanel/img/banner.jpg') }}" ></img>
                                                                            </center>
                                    
                                                                        {% elseif perfil == 2 %}
                                                                            <center>
                                                                                <img class="img-responsive" src="{{ url('adminpanel/img/banner.jpg') }}" ></img>
                                                                            </center>
                                                                        {% elseif perfil == 3 %}
                                                                            <center>
                                                                                <img class="img-responsive" src="{{ url('adminpanel/img/banner.jpg') }}" ></img>
                                                                            </center>
                                                                        {% elseif perfil == 4 %}
                                    
                                                                            <center>
                                                                                <img class="img-responsive" src="{{ url('adminpanel/img/banner.jpg') }}" ></img>
                                                                            </center>
                                    
                                                                        {% elseif perfil == 5 %}
                                    
                                                                            <center>
                                                                                <img class="img-responsive" src="{{ url('adminpanel/img/banner.jpg') }}" ></img>
                                                                            </center>
                                    
                                                                        {% endif %}#}

                                    
                                    <!--ADMISIÓN-->
                                    {% if perfil == 21 %} 
                                    <div class="d-lg-flex half">
                                        <div class="container">
                                            <div class="row align-items-center justify-content-center">
                                                
                                                <div class="row align-items-center justify-content-center" style="margin-top: 20px">
                                                    <div class="col-md-12">
                                                        Bienvenidos a la Plataforma de Admisión, la información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
                                                        <br/>
                                                       
                                                        Para más información sobre el proceso de inscripción Email: admision@unca.edu.pe,  <i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; Celular / Whatsapp: 910 212 205</p>
                                                        
                                                        <!--
                                                        <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-admision.pdf">
                                                            <strong>Manual de Usuario</strong></a>; o ver el <strong>Videotutorial</strong>.
                                                        -->
                                                       
                                                    </div>                            
                                                </div>
                                                <br/>
                                               
                                                <center>
                                                        <img src="../adminpanel/login_vendor/images/home_admision1.png" alt="" style="width: 50%;">
                                                    </center>
                                                    
                                               
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {% endif %}

                                    

                                    {% if nombre_perfil == 'DOCENTES RATIFICACION' %}
                                    <div class="d-lg-flex half">
                                        <div class="container">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-md-12" style="background-color: white;width: 100%;padding: 0px;box-shadow: 2px 0px 5px #c1bbbb;margin-top:30px;">
                                                    <center>
                                                        <img src="../adminpanel/imagenes/convocatorias/banner-ratificacion-index.jpg" alt="" style="width: 100%;">
                                                    </center>
                                                    <div class="row align-items-center justify-content-center" style="margin-top: 20px">
                                                        <div class="col-md-12">
                                                            Bienvenidos al portal de Gestión de Ratificación o Promoción y/o Separación Docente. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada..
                                                            <br/>
                                                            <br/>
                                                            Para más información sobre el procedimiento de postulación te recomendamos ver el
                                                            <a target="_blank" href="https://www.youtube.com/watch?v=mhFfDkAR3I8">
                                                                <strong>Videotutorial del Sistema de Gestión de Ratificación Docente.</strong>
                                                             </a>
                                                        </div>                            
                                                    </div>
                                                    <br/>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>
                                                                <i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp; Email:
                                                                <a href="mailto:informes@unca.edu.pe">informes@unca.edu.pe</a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>
                                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; Tel: +51 044 365463</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6 col-lg-6 d-none d-md-block px-0">                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {% endif %}


                                   
                                    
                                    {% if nombre_perfil == 'DOCENTES CONVOCATORIAS' %}
                                    <div class="d-lg-flex half">
                                        <div class="container">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-md-12" style="background-color: white;width: 100%;padding: 0px;box-shadow: 2px 0px 5px #c1bbbb;margin-top:30px;">
                                                    <center>
                                                        <img src="../adminpanel/imagenes/convocatorias/banner-convocatoria-docente-index.jpg" alt="" style="width: 100%;">
                                                    </center>
                                                    <div class="row align-items-center justify-content-center" style="margin-top: 20px">
                                                        <div class="col-md-12">
                                                            Bienvenidos al nuevo portal de Gestión de Convocatoria Docente. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
                                                            <br/>
                                                            <br/>
                                                            Para más información sobre el procedimiento de postulación descargue el siguiente
                                                            <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-informacion-de-gestion-de-convocatorias-de-concurso-docente-460923.pdf">
                                                                <strong>Manual de usuario del Sistema de Gestión de Convocatorias de la UNCA.</strong>
                                                             </a>
                                                        </div>                            
                                                    </div>
                                                    <br/>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>
                                                                <i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp; Email:
                                                                <a href="mailto:informes@unca.edu.pe">informes@unca.edu.pe</a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>
                                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; Tel: +51 044 365463</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6 col-lg-6 d-none d-md-block px-0">                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {% endif %}



                                    
                                   
                                    {% if nombre_perfil == 'PUBLICO CONVOCATORIAS' %}
                                    <div class="d-lg-flex half">
                                        <div class="container">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-md-12" style="background-color: white;width: 100%;padding: 0px;box-shadow: 2px 0px 5px #c1bbbb;margin-top:30px;">
                                                    <center>
                                                        <img src="../adminpanel/imagenes/convocatorias/banner-convocatoriascas-index.jpg" alt="" style="width: 100%;">
                                                    </center>
                                                    <div class="row align-items-center justify-content-center" style="margin-top: 20px">
                                                        <div class="col-md-12">
                                                            Bienvenidos al portal de Gestión Administrativa mediante la modalidad de Contratación Administrativa de Servicios - CAS. La información que se consigne tiene carácter de Declaración Jurada, por lo que el postulante será responsable de la Información presentada.
                                                            <br/>
                                                            <br/>
                                                            Para más información sobre el procedimiento de postulación descargue el siguiente
                                                            <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/documentos/manual-de-usuario-del-sistema-de-gestion-de-convocatorias-unca-656574.pdf">
                                                                <strong>Manual de usuario del Sistema de Gestión de Convocatorias de la UNCA.</strong>
                                                             </a>
                                                        </div>                            
                                                    </div>
                                                    <br/>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>
                                                                <i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp; Email:
                                                                <a href="mailto:informes@unca.edu.pe">informes@unca.edu.pe</a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>
                                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; Tel: +51 044 365463</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6 col-lg-6 d-none d-md-block px-0">                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {% endif %}




                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>




