
{% block content %}
   

<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">                
                Proceso de Inscripción Admisión 2024-I
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php // $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-12 col-md-12 col-sm-12 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">            				
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-globe"></i><strong>Proceso de Inscripción</strong></h3>
                    </div>
                    <div class="card-body">
                        

<div class="card-body" style="margin-top: 5px; background: white;" >
  <div class="row">
    
    <div class="col-md-12">
        El proceso de inscripción del postulante se llevará a cabo en 4 (cuatro) etapas:
    </div>

    <div class="col-md-12">
    <div class="form-row">
    <div class="col-md-6">
        <div class="form-group form-row">            
        <b>1. Registro en la Plataforma de Admisión</b>
            <br>
         
            {{ image("https://www.unca.edu.pe/adminpanel/imagenes/admision/etapa1_admision.jpg", "alt":"UNCA","width":"350") }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-row">            
          
            Para tal efecto el postulante debe acceder a la Plataforma de Admisión, haciendo clic en el siguiente botón:
            <br>
            <div style="margin-top: -5px !important;margin-bottom: 10px !important;">
                <a target="_blank" href="{{ url('login-admision.html') }}"
                        class="btn btn-warning btn-raised text-right" role="button">
                        <i class="zmdi zmdi-plus"></i><span>INSCRÍBETE AQUÍ</span>
                    </a>
            </div>
            
            Registrarse e ingresar todos los datos que se solicita como postulante y luego acceder con tu N° de DNI y contraseña personalizada.
          
        </div>
    </div>
    </div>   
    </div>


    <div class="col-md-12">
        <div class="form-row">
        <div class="col-md-6">
            <div class="form-group form-row">            
            <b>2. Pre-Inscripción: Presentación de Documentos y voucher de pago.</b>
                <br>
               
                {{ image("https://www.unca.edu.pe/adminpanel/imagenes/admision/etapa2_admision.jpg", "alt":"UNCA","width":"350") }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-row">            
               
                El postulante debe inscribirse desde la Plataforma de Admisión, en el menú "Proceso de.." y luego en "Inscripción"; seleccionar la carrera profesional y modalidad, asimismo cargar los requisitos y voucher de pago en formato PDF (escaneado del original y legible):                                        
                <br>
                <ul>
                    <li>Solicitud de inscripción y postulación, dirigida al Rector de la UNCA (Anexo N° 02)</li>
                    <li>Documento Nacional de Identidad (DNI) actualizado y vigente, ambos lados.</li>
                    <li>Una (1) foto reciente tamaño carnet (a color en formato .jpg con resolución mínima de 400 ppp., fondo blanco, rostro de frente, sin gorra, sombrero o similar y sin anteojos (excepto los invidentes que lo requieran), imagen centrada y enfocada sólo en la cabeza y hombros, vestimenta de color (evitar la vestimenta blanca), cabello recogido hacia atrás (en caso fuese largo)).</li>
                    <li>Declaración Jurada de no tener impedimentos (Anexo N° 03). En caso el postulante sea menor de edad, la Declaración Jurada debe estar firmada por el padre/madre o apoderado.</li>
                    <li>Comprobante (voucher) de pago por derecho de inscripción escaneado del original y legible.</li>
                    <li>Otros documentos necesarios según la modalidad de postulación.</li>
                </ul>
              
            </div>
        </div>
        </div>   
    </div>



    <div class="col-md-12">
        <div class="form-row">
        <div class="col-md-6">
            <div class="form-group form-row">            
            <b>3. Revisión de documentos enviados</b>
                <br>
               
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-row">            
              
                La Direccón de Admisión es el encargado de verificar y validar los requisitos de inscripción de cada postulante, asimismo solicita la validación del voucher de pago a la Unidad de Tesorería; y se responde al postulante en un lapso no mayor de 48 horas por correo electrónico, sobre el estado del proceso de su inscripción.
             
              
            </div>
        </div>
        </div>   
    </div>


    

    <div class="col-md-12">
        <div class="form-row">
        <div class="col-md-6">
            <div class="form-group form-row">            
                <b>4. Impresión de carné de postulante</b>
                 <br>
                
                 {{ image("https://www.unca.edu.pe/adminpanel/imagenes/admision/etapa5_admision.jpg", "alt":"UNCA","width":"350") }}
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-row">            
               
                El postulante debe ingresar a la Plataforma de Admisión y descargar e imprimir su "Carné de Postulante".
                <br>
                <b>Nota:</b>
                Es obligatorio acérquese a la Oficina de Dirección de Admisión para que sea empadronado al examen de admisión, traer consigo los siguientes documentos: DNI, carné de postulante, requisitos y voucher de pago.
                <br>
                <b>(TODOS LOS DOCUMENTOS EN FÍSICO)</b>
               
            </div>
        </div>
        </div>   
    </div>


        
  </div>  
</div> 


                            

                      
                    </div>
                </div>                
                           
            </div>


          

        </div>
    </div>
</div>
{% endblock %}