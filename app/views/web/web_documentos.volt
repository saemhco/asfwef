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
	<div class="container container-full" style="margin-top: -50px;">
		<div class="ms-paper">
			<div class="row">
				<?php $this->partial('shared/menu2'); ?>

				<div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<strong>{{ documento.titulo}}</strong>
							</h3>
						</div>
						<div class="card-body">

							<ul style="list-style-type: disc;">
								{% if resolucion.id_resolucion != '' OR  resolucion.id_resolucion != null %}
									<i class="fa fa-book"></i>&nbsp&nbsp&nbsp
									<a style="color: #000000; text-decoration: none;" href="../adminpanel/archivos/resoluciones/{{ resolucion.archivo }}" target="_blank">


										Aprobado con:
										{{ resolucion.titulo }}
									</a>
								{% endif %}
							</ul>

							<center>
								<div class="embed-responsive embed-responsive-16by9">
									<embed src="../adminpanel/archivos/documentos/{{ documento.archivo }}" width="845" height="1080">
								</div>
								<br>
								<a href="../adminpanel/archivos/documentos/{{ documento.archivo }}" target="_blank" class="btn btn-reveal btn-primary b-0 btn-shadow-2">
									<i class="fa fa-download"></i>
									Descargar
								</a>
							</center>

							{% if verificae >= 1 %}
								<div class="blog-post-item">
									<h3>
										<span>Documentos de Evaluación</span>
									</h3>
									<table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">
										<thead>
											<tr>

												<th style="background-color: #4169e1; color: white;text-align:center !important;">
													Documento</th>

												<th style="background-color: #4169e1; color: white;text-align:center !important;">
													Resolucion</th>
												<th style="background-color: #4169e1; color: white;text-align:center !important;">
													Descargar</th>

											</tr>
										</thead>
										<tbody>
											{% for documentoEvaluacion in documentosEvaluaciones %}

												<tr>

													<td style="color: #000000;text-align:left !important; font-size: 12px;" width="40%">
														<a href="../web-documentos-evaluaciones/{{ documentoEvaluacion.enlace }}.html" target="_blank">
															{{ documentoEvaluacion.titulo }}
														</a>
													</td>


													<td style="color: #000000;text-align:left !important; font-size: 12px;" width="40%">
														{% for documentoEvaluacionResolucion in documentosEvaluacionesResoluciones %}
															{% if documentoEvaluacionResolucion.id_resolucion ==
                                            documentoEvaluacion.id_resolucion %}
																{{ documentoEvaluacionResolucion.titulo }}
															{% endif %}
														{% endfor %}

													</td>

													<td style="color: #000000;text-align:center !important;" width="20%">

														<a class="btn btn-raised btn-royal btn-xs" style="padding-right: 5px;" href="{{ config.global.xWebIns }}/adminpanel/archivos/documentos_evaluaciones/{{ documentoEvaluacion.archivo }}" target="_blank" width="10%">
															<i class="fa fa-file-pdf-o"></i>
														</a>

														{% for documentoEvaluacionResolucion in documentosEvaluacionesResoluciones %}
															{% if documentoEvaluacionResolucion.id_resolucion ==
                                            documentoEvaluacion.id_resolucion %}
																<a class="btn btn-raised btn-royal btn-xs" href="{{ config.global.xWebIns }}/adminpanel/archivos/resoluciones/{{ documentoEvaluacionResolucion.archivo }}" target="_blank" width="10%">R</a>
															{% endif %}
														{% endfor %}

													</td>
												</tr>

											{% endfor %}
										</tbody>
									</table>
								</div>
							{% endif %}

							{% if verificaa >= 1 %}
								<div class="blog-post-item">
									<h3>
										<span>Documentos Anteriores</span>
									</h3>
									<table class="table table-hover table-bordered" style="border: solid 1px #f2f2f2;">
										<thead>
											<tr>

												<th style="background-color: #4169e1; color: white;text-align:center !important;">
													Documento</th>

												<th style="background-color: #4169e1; color: white;text-align:center !important;">
													Resolucion</th>
												<th style="background-color: #4169e1; color: white;text-align:center !important;">
													Descargar</th>

											</tr>
										</thead>
										<tbody>
											{% for documentoArchivo in documentosArchivos %}
												{% if documentoArchivo.estado == "A" %}
													<tr>

														<td style="color: #000000;text-align:left !important; font-size: 12px;" width="40%">
															<a href="../web-documentos-archivos/{{ documentoArchivo.enlace }}.html" target="_blank">
																{{ documentoArchivo.titulo }}
																
															</a>
														</td>


														<td style="color: #000000;text-align:left !important; font-size: 12px;" width="40%">
															{% for documentoArchivoResolucion in documentosArchivosResoluciones %}
																{% if documentoArchivoResolucion.id_resolucion ==
                                            documentoArchivo.id_resolucion %}
																	{{ documentoArchivoResolucion.titulo }}
																{% endif %}
															{% endfor %}

														</td>

														<td style="color: #000000;text-align:center !important;" width="20%">

															<a class="btn btn-raised btn-royal btn-xs" style="padding-right: 5px;" href="{{ config.global.xWebIns }}/adminpanel/archivos/documentos_archivos/{{ documentoArchivo.archivo }}" target="_blank" width="10%">
																<i class="fa fa-file-pdf-o"></i>
															</a>

															{% for documentoArchivoResolucion in documentosArchivosResoluciones %}
																{% if documentoArchivoResolucion.id_resolucion ==
                                            documentoArchivo.id_resolucion %}
																	<a class="btn btn-raised btn-royal btn-xs" href="{{ config.global.xWebIns }}/adminpanel/archivos/resoluciones/{{ documentoArchivoResolucion.archivo }}" target="_blank" width="10%">R</a>
																{% endif %}
															{% endfor %}

														</td>
													</tr>
												{% endif %}

											{% endfor %}
										</tbody>
									</table>
								</div>
							{% endif %}

						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
{% endblock %}
