<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Proceso de Admisión</li>
    </ol>
</div>
<!-- END RIBBON -->		





<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>PROCESO DE ADMISIÓN - {{admision_activo.descripcion}} </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										


                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                    <center>DATOS DEL POSTULANTE</center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>Código:</strong></td>
                                            <td width="20%">{{ postulante.codigo }}</td>
                                            <td width="15%"><strong></strong></td>
                                            <td width="50%"></td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>Nro. Doc. </strong></td>
                                            <td width="20%">{{ postulante.nro_doc }}</td>
                                            <td width="15%"><strong>Apellidos y Nombres</strong></td>
                                            <td width="50%">{{ postulante.apellidop }} {{ postulante.apellidom }} {{ postulante.nombres }}</td>                                            
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>Tipo de Colegio:  </strong></td>
                                            <td width="20%">{% if postulante.colegio_publico == 1   %} PUBLICO {% elseif(postulante.colegio_publico == 0) %} PRIVADO {% endif %}</td>
                                            <td width="15%"><strong>Nombre de Colegio:</strong></td>
                                            <td width="50%">{{ postulante.colegio_nombre }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                DATOS DE INSCRIPCIÓN
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>Fecha de Inscripción:</strong></td>
                                            <td width="85%">
                                                {{ fecha_inscripcion }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>Carrera Profesional:</strong></td>
                                            <td width="85%">
                                                {{ carrera1 }} : {{ carrera2 }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="15%">
                                                <strong>Modalidad:
                                                </strong>
                                            </td>


                                            {% if admisionPostulantes.modalidad==1 %}
                                                <td width="20%">EXTRAORDINARIO</td>
                                            {% elseif admisionPostulantes.modalidad==2 %}
                                                <td width="20%">ORDINARIO</td>
                                            {% endif %}

                                            
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                ESTADO DE LA INSCRIPCIÓN
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>Proceso:</strong></td>
                                            <td width="90%"><strong>{{ proceso_desc }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>Observaciones: </strong></td>
                                            <td width="90%"> {{ admision.observaciones }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <center>
                                <div class="col-md-12">

                                    <a role="button" href="{{ url('reportes/carnetpostulante/'~postulante.codigo) }}"  target="_BLANK">

                                    
                                    <button type="button" class="btn btn-warning"><i class="fa fa-print"></i> DESCARGAR CARNÉ DE POSTULANTE
                                    </button>

                                    </a>

                                </div>
                                </center>

                            </br>
                        </br>
                    </br>




                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>	






        <div class="col-sm-12" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">
                                <header>
                                    <span class="widget-icon">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <h2>VOUCHER DE PAGO
                                        <span class="text-danger">*</span>
                                    </h2>
                                </header>
                                <div>
                                    <div class="jarviswidget-editbox">
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="widget-body no-padding smart-form">
                                        <fieldset>
                                            <div class="row">
                                               
                                                <section class="col col-md-6">
                                                    <label class="text-info">Voucher de pago
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    
                                                    {% if voucher_file !== ""   %}
                                                        <div class="alert alert-success fade in">
                                                            Click aqui para ver el archivo
                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~voucher_file) }}">
                                                                <i class="fa-fw fa fa-book"></i>
                                                            </a>
                                                        </div>
                                                    {% else %}
                                                        <div class="alert alert-warning fade in">
                                                            <i class="fa-fw fa fa-warning"></i>
                                                            <strong>Pendiente</strong>
                                                            Aun no ha subido un archivo.
                                                        </div>
                                                    {% endif %}
                                                </section>
                                                <section class="col col-md-6">
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label class="text-info">Nro° Pago
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <label class="input">
                                                                <input type="text" id="voucher_nro" name="voucher_nro" value="{{admisionPostulantes.recibo}}"/>
                                                            </label>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <label class="text-info">Monto
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <label class="input">
                                                                <input type="text" id="voucher_monto" name="voucher_monto" value="{{admisionPostulantes.monto}}"/>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </article>
                    
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">

                            <header>
                                <span class="widget-icon">
                                    <i class="fa fa-edit"></i>
                                </span>
                                <h2>REQUISITOS</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding smart-form">
                                    <fieldset>
                                        <div class="row">
                                           
                                            <section class="col col-md-6">

                                                <label class="text-info">Solicitud de inscripción y postulación (Anexo 02)
                                                    <span class="text-danger">*</span>
                                                </label>
                                               
                                                {% if archivo_solicitud_02 !== ""   %}
                                                    <div class="alert alert-success fade in">
                                                        Click aqui para ver el archivo
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~archivo_solicitud_02) }}">
                                                            <i class="fa-fw fa fa-book"></i>
                                                        </a>
                                                    </div>
                                                {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong>
                                                        Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info">DNI vigente
                                                    <span class="text-danger">*</span>
                                                </label>
                                               

                                                {% if archivo_dni !== ""   %}

                                                    <div class="alert alert-success fade in">

                                                        Click aqui para ver el archivo
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~archivo_dni) }}">
                                                            <i class="fa-fw fa fa-book"></i>
                                                        </a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong>
                                                        Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info">Foto tamaño carnet(Fondo Blanco,sin gorra y sin lentes)
                                                    <span class="text-danger">*</span>
                                                </label>
                                               
                                                {% if archivo_foto_carnet !== ""   %}

                                                    <div class="alert alert-success fade in">

                                                        Click aqui para ver el archivo
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~archivo_foto_carnet) }}">
                                                            <i class="fa-fw fa fa-book"></i>
                                                        </a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong>
                                                        Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info">Certificado de estudios secundarios completos
                                                    <span class="text-danger">*</span>
                                                </label>
                                               

                                                {% if archivo_certificado_estudio_secundaria !== ""   %}

                                                    <div class="alert alert-success fade in">

                                                        Click aqui para ver el archivo
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~archivo_certificado_estudio_secundaria) }}">
                                                            <i class="fa-fw fa fa-book"></i>
                                                        </a>
                                                    </div>
                                                {% else %}
                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong>
                                                        Aun no ha subido un archivo.
                                                    </div>
                                                {% endif %}
                                            </section>
                                            <section class="col col-md-6">
                                                <label class="text-info">Declaración Jurada de no tener impedimentos (Anexo 03)
                                                    <span class="text-danger">*</span>
                                                </label>
                                               
                                                {% if archivo_solicitud_03 !== ""   %}

                                                    <div class="alert alert-success fade in">

                                                        Click aqui para ver el archivo
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~archivo_solicitud_03) }}">
                                                            <i class="fa-fw fa fa-book"></i>
                                                        </a>
                                                    </div>
                                                {% else %}
                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong>
                                                        Aun no ha subido un archivo.
                                                    </div>
                                                {% endif %}
                                            </section>
                                            <section class="col col-md-6 " id="fileUploadExt" style="display:{{admisionPostulantes.modalidad=='2' and es_registrado==1?'block':'none'}};">
                                                <label class="text-info" id="txtFileUploadExt"></label>
                                               
                                                {% if file_upload_ext_value !== ""    %}

                                                    <div class="alert alert-success fade in">

                                                        Click aqui para ver el archivo
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/admision_postulante_archivo/'~admisionPostulantes.codigo_unico~'/'~file_upload_ext_value) }}">
                                                            <i class="fa-fw fa fa-book"></i>
                                                        </a>
                                                    </div>
                                                {% else %}
                                                    <div class="alert alert-warning fade in">
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong>
                                                        Aun no ha subido un archivo.
                                                    </div>
                                                {% endif %}
                                            </section>
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>








    </div>	
</div>


{{ form('','method': 'post','id':'modal_voucher','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            
                <center>
                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/admision/'~admision_activo.codigo~'/'~admision.imagen) }}"
                        error="this.onerror=null;this.src='';"></img>
                </center>
    
        </section>
    </div>
</fieldset>
{{ endForm() }}