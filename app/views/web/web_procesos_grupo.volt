{% block content %}
	<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
		<div class="container">
			<div class="text-left">
				<h2 style="color: #757575; margin-top: -15px !important;">
					{{ config.global.xSeparadorIns }}
					Procesos
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
								<strong>Búsqueda de Procesos
								</strong>
							</h3>
						</div>
						<div class="card-body">						
							<div class="container-fluid">
								<div>
									<button class="btn-arcjas" id="btn-estrategicos" data-target="#acordeon1">
										<span>
											<div class="icono">
												<i class="fa fa-lightbulb-o fa-3x pt-3" aria-hidden="true"></i>
											</div>
											<span>Estratégicos</span>
										</span>
									</button>
									<button class="btn-arcjas" id="btn-misionales" data-target="#acordeon2">
										<span>
											<div class="icono">
												<i class="fa fa-gears fa-3x pt-3" aria-hidden="true"></i>
											<div>
											<span>Misionales</span>
										</span>
									</button>
									<button class="btn-arcjas" id="btn-apoyo" data-target="#acordeon3">
										<span>
											<div class="icono">
												<i class="fa fa-handshake-o fa-3x pt-3" aria-hidden="true"></i>
											<div>
											<span>Apoyo</span>
										</span>
									</button>
								</div>
								<div class="accordion " id="acordeon1">
									{% for index,anio in data_ordinario_anio %}

										<div class="accordion-item">
											<div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel{{index}}" data-target="#panel{{index}}">{{anio}} </div>
											
											<div class="accordion-content collapse" id="panel{{index}}">
											
												<div class="table-responsive">
													<table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
														<thead>
															<tr>
																<th>Proceso</th>																
																<th>Título</th>																
																<th>Ingresar</th>
															</tr>
														</thead>
														<tbody>
															{% for data in data_ordinario[anio] %}
																<tr>
																	
																	<td>{{data.nombre_proceso}}</td>																	
																	<td>{{data.titulo}}</td>																	
																	<td>
																		<a href="../web-procesos/{{ data.enlace }}.html" target="_blank">
																			<button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
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
									{% for index,anio in data_extraordinario_anio %}

										<div class="accordion-item">
											<div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel2-{{index}}" data-target="#panel2-{{index}}">{{anio }} </div>
											<div class="accordion-content collapse" id="panel2-{{index}}">
												<div class="table-responsive">
													<table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
														<thead>
															<tr>
																
																<th>Proceso</th>
																<th>Título</th>																
																<th>Ingresar</th>
															</tr>
														</thead>
														<tbody>
															{% for data in data_extraordinario[anio] %}
																<tr>
																	
																	<td>{{data.nombre_proceso}}</td>																		
																	<td>{{data.titulo}}</td>																		
																	<td>
																		<a href="../web-procesos/{{ data.enlace }}.html" target="_blank">
																			<button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
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
									{% for index,anio in data_extraordinario1_anio %}

										<div class="accordion-item">
											<div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel3-{{index}}" data-target="#panel3-{{index}}">{{anio}} </div>
											
											<div class="accordion-content collapse" id="panel3-{{index}}">
											
												<div class="table-responsive">
													<table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
														<thead>
															<tr>
																<th>Proceso</th>
																<th>Título</th>																
																<th>Ingresar</th>
															</tr>
														</thead>
														<tbody>
															{% for data in data_extraordinario1[anio] %}
																<tr>
																	<td>{{data.nombre_proceso}}</td>
																	<td>{{data.titulo}}</td>
																	<td>
																		<a href="../web-procesos/{{ data.enlace }}.html" target="_blank">
																			<button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
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
