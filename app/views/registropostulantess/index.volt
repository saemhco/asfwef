<div
	id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Panel</li>
		<li>Proceso de Admisión</li>
	</ol>
</div>


<!-- MAIN CONTENT -->




<div id="content">

	<div class="row">

		<div class="col-sm-12">
			<section id="widget-grid" class="">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false" data-widget-sortable="false" data-widget-togglebutton="false">

							<header>
								<span class="widget-icon">
									<i class="fa fa-graduation-cap"></i>
								</span>
								<h2>PROCESO DE ADMISIÓN -
									{{admision_m.descripcion}}
								</h2>
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
											<td width="15%">
												<strong>Código de Postulante:</strong>
											</td>
											<td width="20%">{{ postulante.codigo }}</td>
											<td width="15%">
												<strong></strong>
											</td>
											<td width="50%"></td>
										</tr>
										<tr>
											<td width="15%">
												<strong>N° Documento
												</strong>
											</td>
											<td width="20%">{{ postulante.nro_doc }}</td>
											<td width="15%">
												<strong>Apellidos y Nombres:
												</strong>
											</td>
											<td width="50%">{{ postulante.apellidop }}
												{{ postulante.apellidom }}
												{{ postulante.nombres }}</td>
										</tr>
										<tr>
											<td width="15%">
												<strong>Tipo de Colegio:
												</strong>
											</td>
											<td width="20%">
												{% if postulante.colegio_publico == 1   %}
													PUBLICO
												{% elseif(postulante.colegio_publico == 0) %}
													PRIVADO
												{% endif %}
											</td>
											<td width="15%">
												<strong>Nombre de Colegio:
												</strong>
											</td>
											<td width="50%">{{ postulante.colegio_nombre }}</td>
										</tr>
										<tr>
											<td width="15%">
												<strong>N° de Celular:
												</strong>
											</td>
											<td width="20%">{{ postulante.celular }}</td>
											<td width="15%">
												<strong>Correo Electrónico:
												</strong>
											</td>
											<td width="50%">{{ postulante.email }}</td>
										</tr>
									</tbody>
								</table>
								{% if es_registrado %}
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
												<td width="15%">
													<strong>Carrera Profesional:</strong>
												</td>
												<td width="85%">
													{{ carrera1 }}
													:
													{{ carrera2 }}
												</td>

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
											</tr>
										</tbody>
									</table>

									{% if proceso_id !="4"   %}
									<section class="col col-md-12">													
										<div class="alert alert-success">
											<b>Nota:</b> Su documentación se encuentra en proceso de verificación, en un lapso no mayor de 48 horas recibirá un correo electrónico sobre el estado del proceso de su inscripción. Gracias!!!.
										</div>
									</section>
									{% endif  %}

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
												<td width="15%">
													<strong>Proceso:</strong>
												</td>
												<td width="90%">
													<strong>{{ proceso_desc }}
														</strong>
												</td>
											</tr>
											<tr>
												<td width="15%">
													<strong>Observaciones:
													</strong>
												</td>
												<td width="90%">
													{{ admision.observaciones }}</td>
											</tr>
										</tbody>
									</table>
								{% endif %}

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
							<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false" data-widget-sortable="false" data-widget-togglebutton="false">

								<header>
									<span class="widget-icon">
										<i class="fa fa-edit"></i>
									</span>
									<h2><b>PASO N° 1:</b> INFORMACIÓN DE INSCRIPCIÓN</h2>
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
														
														<!--por verificar, en verificacion, observado, pago verificacion-->
														{% if proceso_id == "0" or proceso_id == "1" or proceso_id == "2" or proceso_id == "4" %}
														
														<input type="text" id="input_fecha_inscripcion" name="fecha_inscripcion" placeholder="" {#class="datepicker"#} data-dateformat='dd/mm/yy' value="{{ fecha_inscripcion }}" readonly {{admisionPostulantes!=null?'disabled':''}}>
														
														{% else %}

														<input type="text" id="input_fecha_inscripcion" name="fecha_inscripcion" placeholder="" {#class="datepicker"#} data-dateformat='dd/mm/yy' value="{{ fecha_actual }}" readonly {{admisionPostulantes!=null?'disabled':''}}>

														{% endif  %}

														<input type="hidden" id="input_postulante" name="postulante" value="{{ postulante.codigo }}">
														<input type="hidden" id="modalidad_value" name="modalidad_value" value="{{ admisionPostulantes.modalidad }}">


														<input
														type="hidden" id="proceso_id" name="proceso_id" value="{{ proceso_id }}">

														{#<input type="hidden" id="input_semestre" name="semestre" value="{{semestre_admision.codigo}}">#}
														<input type="hidden" id="input_admision" name="admision" value="{{admision_m.codigo}}">

													</label>
												</section>
												<section class="col col-md-4">

													<label class="text-info">Tipo de Modalidad
													</label>
													<label class="select">
														<select id="modalidad" name="modalidad" value="1" {{admisionPostulantes!=null?'disabled':''}}>
															<option value="">SELECCIONE.</option>
															<option value="2" {{admisionPostulantes.modalidad==2?'selected':''}}>Ordinario</option>
															<option value="1" {{admisionPostulantes.modalidad==1?'selected':''}}>Extraordinario</option>
														</select>
														<i></i>
													</label>
												</section>
												<section class="col col-md-4" id="tipo_inscripcion_form" style="display:{{admisionPostulantes.modalidad==1?'block':'none'}};">
													<label class="text-info">
														Modalidades
													</label>
													<label class="select">
														<select id="tipo_inscripcion" name="tipo_inscripcion" {{admisionPostulantes!=null?'disabled':''}}>
															<option value="">SELECCIONE...</option>
															{% for modalidad_select in modalidad %}

																<option value="{{ modalidad_select.codigo }}" {{admisionPostulantes.tipo_inscripcion==modalidad_select.codigo?'selected':''}}>{{ modalidad_select.nombres }}</option>

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
														<select id="input_carrera1" {{admisionPostulantes!=null?'disabled':''}}>
															<option value="">SELECCIONE...</option>
															{% for carreras_select in carreras %}

																<option value="{{ carreras_select.codigo }}" {{admisionPostulantes.carrera1==carreras_select.codigo?'selected':''}}>{{ carreras_select.descripcion }}</option>

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
							<div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">

								<header>
									<span class="widget-icon">
										<i class="fa fa-edit"></i>
									</span>
									<h2><b>PASO N° 2:</b> ADJUNTAR REQUISITOS DE INSCRIPCIÓN</h2>
								</header>

								<div>
									<div class="jarviswidget-editbox">
										<input class="form-control" type="text">
									</div>
									<div class="widget-body no-padding smart-form">
										<fieldset>
											<div class="row">
												<section class="col col-md-12">													
													<div class="alert alert-danger">
														<b>Importante:</b> Toda documentación es obligatoria para la postulación en cualquier modalidad (ordinario o extraordinario), debe ser escaneado del original y tener formato PDF.
													</div>

												</section>
												<section class="col col-md-6">

													<label class="text-info">Solicitud de inscripción y postulación <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/convocatorias/solicitud-inscripcion-admision.docx">(DESCARGAR ANEXO N° 01)</a>
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
													<div class="input input-file">
														<span class="button"><input id="archivo_dni" type="file" name="archivo_dni" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>

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
													<div class="input input-file">
														<span class="button"><input id="archivo_foto_carnet" type="file" name="archivo_foto_carnet" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>

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
													<div class="input input-file">
														<span class="button"><input id="archivo_certificado_estudio_secundaria" type="file" name="archivo_certificado_estudio_secundaria" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>

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
													<label class="text-info">Declaración Jurada de no tener impedimentos; si es mayor  de edad <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/convocatorias/declaracion-jurada-admision-mayor.docx">(DESCARGAR ANEXO N° 02)</a> y si es menor de edad <a target="_blank" href="https://www.unca.edu.pe/adminpanel/archivos/convocatorias/declaracion-jurada-admision-menor.docx">(DESCARGAR ANEXO N° 04)</a>
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
													<div class="input input-file">
														<span class="button"><input id="file_upload_ext_value" type="file" name="file_upload_ext_value" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar
														</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">
													</div>
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


						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">
								<header>
									<span class="widget-icon">
										<i class="fa fa-edit"></i>
									</span>
									<h2><b>PASO N° 3: </b>ADJUNTAR VOUCHER DE PAGO
										<!--
										<span class="text-danger">*</span>
										-->
									</h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
										<input class="form-control" type="text">
									</div>
									<div class="widget-body no-padding smart-form">
										<fieldset>
											<div class="row">
												<section class="col col-md-12">													
													<div class="alert alert-danger">
														<b>Importante:</b> El Voucher de Pago es obligatorio para la postulación, debe ser escaneado del original y tener formato PDF.
													</div>

												</section>
												<section class="col col-md-6">
													<label class="text-info">Voucher de pago
														<span class="text-danger">*</span>
													</label>
													<div class="input input-file">
														<span class="button"><input id="voucher_file" type="file" name="voucher_file" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i>
															Buscar
														</span><input type="text" id="input-file" name="input-file" placeholder="Agregar Archivo (Archivo pdf, PDF menor a 10 MB)" readonly="">

													</div>
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



					</div>
				</section>
			</div>

			<div class="col-sm-12">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-custombutton="false">
							<div>
								<center>
									{% if admisionPostulantes.postulante != null   %}
										<button class="btn btn-primary mx-auto" type="submit" id="update" style="width: 250px;height: 40px;">
											<i class="fa fa-refresh"></i>  ACTUALIZAR DOCUMENTOS</button>
									{% else %}

										<button class="btn btn-primary mx-auto" type="submit" id="save" style="width: 250px;height: 40px;">
											<i class="fa fa-edit"></i> PREINSCRIPCIÓN</button>

									{% endif %}

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

	<div class="hidden">
		<div id="success">
			<p>
				Su información se registró correctamente, porfavor revise su correo electrónico...
			</p>
		</div>
	</div>
	<div class="hidden">
		<div id="warning_file">
			<p>
				Por favor sube todo los archivos necesarios...
			</p>
		</div>
	</div>
	<div class="hidden">
		<div id="warning_update">
			<p>
				Está seguro que desea actualizar?...
			</p>
		</div>
	</div>
	<div class="hidden">
		<div id="warning">
			<p>
				Está seguro que desea Preinscribirse para el Proceso de Admisión?...
			</p>
		</div>
	</div>

	<script type="text/javascript">
		var id = "";{% if id is defined %}id = {{ id }};{% endif %};
var proceso_id = "";{% if proceso_id is defined %}proceso_id = {{ proceso_id }};{% endif %};
var modalidad_value = "";{% if admisionPostulantes.modalidad is defined %}modalidad_value = {{ admisionPostulantes.modalidad }};{% endif %}var tipo_inscripcion_value = "";{% if admisionPostulantes.tipo_inscripcion is defined %}tipo_inscripcion_value = {{ admisionPostulantes.tipo_inscripcion }};{% endif %}
	</script>
