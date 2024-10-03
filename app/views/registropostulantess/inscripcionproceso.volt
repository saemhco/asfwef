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
                                                DATOS INSCRIPCIÓN
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>Carrera Profesional:</strong></td>
                                            <td width="85%">
                                                {{ carrera1 }} : {{ carrera2 }}
                                            </td>
                                            
                                            
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




                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>	
<div class="col-sm-12">
			{{ form('registropostulantes/saveInscripcion','method':'post','id':'form_admisionproceso','enctype':'multipart/form-data')}}

				<section id="widget-grid" class="">

					<div class="row">
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false" data-widget-sortable="false" data-widget-togglebutton="false">

								<header>
									<span class="widget-icon">
										<i class="fa fa-edit"></i>
									</span>
									<h2>Informacion de Registro</h2>
								</header>

								<div>
									<div class="jarviswidget-editbox">
										<input class="form-control" type="text">
									</div>
									<div class="widget-body no-padding smart-form">
										<fieldset>
											<div class="row">
												<section class="col col-md-2">
													<label class="text-info">Fecha de Inscripción</label>
													<label class="input">
														<i class="icon-prepend fa fa-calendar"></i>
														<input type="text" id="input_fecha_inscripcion" name="fecha_inscripcion" placeholder="" {#class="datepicker"#} data-dateformat='dd/mm/yy' value="{{ fecha_actual }}" readonly>

														<input
														type="hidden" id="input_postulante" name="postulante" value="{{ postulante.codigo }}">
														{#<input type="hidden" id="input_semestre" name="semestre" value="{{semestre_admision.codigo}}">#}
														<input type="hidden" id="input_admision" name="admision" value="{{admision_m.codigo}}">

													</label>
												</section>
												<section class="col col-md-4">

													<label class="text-info">Tipo Modalidad
													</label>
													<label class="select">
														<select id="modalidad" name="modalidad">
															<option value="">SELECCIONE.</option>
															<option value="1">Ordinario</option>
															<option value="2">Extraordinario</option>
														</select>
														<i></i>
													</label>
												</section>
												<section class="col col-md-4" id="tipo_inscripcion_form" style="display:none;">
													<label class="text-info">
														Modalidades
													</label>
													<label class="select">
														<select id="tipo_inscripcion" name="tipo_inscripcion">
															<option value="">SELECCIONE...</option>
															{% for modalidad_select in modalidad %}

																<option value="{{ modalidad_select.codigo }}">{{ modalidad_select.nombres }}</option>

															{% endfor %}
														</select>
														<i></i>
													</label>
												</section>
											</div>
											<div class="row">
												<section class="col col-md-6">
													<label class="text-info">{{ config.global.xCarreraIns }}</label>
													<label class="select">
														<select id="input_carrera1">
															<option value="">SELECCIONE...</option>
															{% for carreras_select in carreras %}

																<option value="{{ carreras_select.codigo }}">{{ carreras_select.descripcion }}</option>

															{% endfor %}
														</select>
														<i></i>
													</label>
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

			<div class="col-sm-12" style="margin-bottom: -30px;">
				<section id="widget-grid" class="">
					<div class="row">
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">

								<header>
									<span class="widget-icon">
										<i class="fa fa-edit"></i>
									</span>
									<h2>Requisitos</h2>
								</header>

								<div>
									<div class="jarviswidget-editbox">
										<input class="form-control" type="text">
									</div>
									<div class="widget-body no-padding smart-form">
										<fieldset>
											<div class="row">
												<section class="col col-md-12">
													<p class="text-danger">Importante : Todo los archivos son necesarios subir.</p>
												</section>
												<section class="col col-md-6">

													<label class="text-info">Solicitud de inscripción y postulación (Anexo 02)
														<span class="text-danger">*</span>
													</label>
													<div class="input input-file">
														<span class="button"><input id="archivo_solicitud_02" type="file" name="archivo_solicitud_02" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar
														</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>
													{% if archivo_solicitud_02 !== ""   %}
														<div class="alert alert-success fade in">
															Click aqui para ver el archivo
															<a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_solicitud_02) }}">
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
													<div class="input input-file">
														<span class="button"><input id="archivo_dni" type="file" name="archivo_dni" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>

													{% if archivo_dni !== ""   %}

														<div class="alert alert-success fade in">

															Click aqui para ver el archivo
															<a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_dni) }}">
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
													<label class="text-info">Foto tamaño carnet(Fondo Blanco,sin gorra o similar)
														<span class="text-danger">*</span>
													</label>
													<div class="input input-file">
														<span class="button"><input id="archivo_foto_carnet" type="file" name="archivo_foto_carnet" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>

													{% if archivo_foto_carnet !== ""   %}

														<div class="alert alert-success fade in">

															Click aqui para ver el archivo
															<a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_foto_carnet) }}">
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
													<div class="input input-file">
														<span class="button"><input id="archivo_certificado_estudio_secundaria" type="file" name="archivo_certificado_estudio_secundaria" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>

													{% if archivo_certificado_estudio_secundaria !== ""   %}

														<div class="alert alert-success fade in">

															Click aqui para ver el archivo
															<a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_certificado_estudio_secundaria) }}">
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
													<div class="input input-file">

														<span class="button"><input id="archivo_solicitud_03" type="file" name="archivo_solicitud_03" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar
														</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

													</div>
													{% if archivo_solicitud_03 !== ""   %}

														<div class="alert alert-success fade in">

															Click aqui para ver el archivo
															<a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~archivo_solicitud_03) }}">
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
												<section class="col col-md-6 " id="fileUploadExt" style="display:none;">
													<label class="text-info" id="txtFileUploadExt"></label>
													<div class="input input-file">
														<span class="button"><input id="file_upload_ext_value" type="file" name="file_upload_ext_value" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar
														</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>
													{% if file_upload_ext_value !== ""   %}

														<div class="alert alert-success fade in">

															Click aqui para ver el archivo
															<a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/convocatorias_publico/'~file_upload_ext_value) }}">
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

			<div class="col-sm-12">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">
							<div>
								<center>
									<button class="btn btn-primary mx-auto" type="submit" id="save" style="width: 250px;height: 40px;">
										Pre Inscribirse</button>
								</center>
								<br/>
							</div>
						</div>
					</article>
				</div>
			</div>
			{{ endForm() }}

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