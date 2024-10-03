{% block content %}
	<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
		<div class="container">
			<div class="text-left">
				<h2 style="color: #757575; margin-top: -15px !important;">
					{{ config.global.xSeparadorIns }}
					Resoluciones
				</h2>
			</div>
		</div>
	</div>
	<div class="container container-full" style="margin-top: -50px;">
		<div class="ms-paper">
			<div class="row">
				<?php $this->partial('shared/menu1'); ?>
				<!-- CENTER -->
				<div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style="margin-top: 20px;">

					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<i class="fa fa-search"></i>
								<strong>Búsqueda de Resoluciones
								</strong>
							</h3>
						</div>
						<div class="card-body">						
							<div class="container-fluid">
								<div>
									<button class="btn-arcjas" id="btn-ordinario" data-target="#acordeon1">
										<span>
											<div class="icono">
												<i class="fa fa-files-o fa-3x pt-3" aria-hidden="true"></i>
											</div>
											<span>Presidencial</span>
										</span>
									</button>
									<button class="btn-arcjas" id="btn-extraordinario" data-target="#acordeon2">
										<span>
											<div class="icono">
												<i class="fa fa-files-o fa-3x pt-3" aria-hidden="true"></i>
												<div>
													<span>Comisión</span>
												</div>
											</div>
										</span>
									</button>
									<button class="btn-arcjas" id="btn-extraordinario1" data-target="#acordeon3">
										<span>
											<div class="icono">
												<i class="fa fa-files-o fa-3x pt-3" aria-hidden="true"></i>
												<div>
													<span>Administración</span>
												</div>
											</div>
										</span>
									</button>
								</div>
								<div class="accordion " id="acordeon1">
									{% for anio in data_presidencial_anio %}

										<div class="accordion-item">
											<div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel{{anio}}" data-target="#panel{{anio}}">{{anio}} <span class="badge">{{data_presidencial[anio]|length}}</span></div>
											<div class="accordion-content collapse" id="panel{{anio}}">
												<div class="table-responsive">
													<table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
														<thead>
															<tr>
																<th>#</th>
																<th>Título</th>
																<th>Fecha</th>
																<th>Descargar</th>
															</tr>
														</thead>
														<tbody>
															{% for data in data_presidencial[anio] %}
																<tr>
																	<td>{{data.numero}}</td>
																	<td>{{data.titulo}}</td>
																	<td>{{data.fecha_parse}}</td>
																	<td>
																		<a href="{{ url('adminpanel/archivos/resoluciones/'~data.archivo) }}" target="_blank">
																			<button class="btn-descarga"><i class="fa fa-file-pdf-o"></i></button>
																		</a>
																	</td>
																</tr>
															{% endfor %}

														</tbody>
													</table>
												</div>
											</div>
										</div>
									{% endfor %}
								</div>
								<div class="accordion " id="acordeon2">
									{% for anio in data_comision_anio %}

										<div class="accordion-item">
											<div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel2-{{anio}}" data-target="#panel2-{{anio}}">{{anio }} <span class="badge">{{data_comision[anio]|length}}</span></div>
											<div class="accordion-content collapse" id="panel2-{{anio}}">
												<div class="table-responsive">
													<table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
														<thead>
															<tr>
																<th>#</th>
																<th>Título</th>
																<th>Fecha</th>
																<th>Descargar</th>
															</tr>
														</thead>
														<tbody>
															{% for data in data_comision[anio] %}
																<tr>
																	<td>{{data.numero}}</td>
																	<td>{{data.titulo}}</td>
																	<td>{{data.fecha_parse}}</td>
																	<td>
																		<a href="{{ url('adminpanel/archivos/resoluciones/'~data.archivo) }}" target="_blank">
																			<button class="btn-descarga"><i class="fa fa-file-pdf-o"></i></button>
																		</a>
																	</td>
																</tr>
															{% endfor %}

														</tbody>
													</table>
												</div>
											</div>
										</div>
									{% endfor %}
								</div>
								<div class="accordion " id="acordeon3">
									{% for anio in data_administracion_anio %}

										<div class="accordion-item">
											<div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel3-{{anio}}" data-target="#panel3-{{anio}}">{{anio }} <span class="badge">{{data_administracion[anio]|length}}</span></div>
											<div class="accordion-content collapse" id="panel3-{{anio}}">
												<div class="table-responsive">
													<table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
														<thead>
															<tr>
																<th>#</th>
																<th>Título</th>
																<th>Fecha</th>
																<th>Descargar</th>
															</tr>
														</thead>
														<tbody>
															{% for data in data_administracion[anio] %}
																<tr>
																	<td>{{data.numero}}</td>
																	<td>{{data.titulo}}</td>
																	<td>{{data.fecha_parse}}</td>
																	<td>
																		<a href="{{ url('adminpanel/archivos/resoluciones/'~data.archivo) }}" target="_blank">
																			<button class="btn-descarga"><i class="fa fa-file-pdf-o"></i></button>
																		</a>
																	</td>
																</tr>
															{% endfor %}

														</tbody>
													</table>
												</div>
											</div>
										</div>
									{% endfor %}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{% endblock %}
