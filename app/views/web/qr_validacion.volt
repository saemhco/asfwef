{% block content %}
	<style>
		.ms-site-container {
			margin-top: 0!important;
		}
		.text-bg-success {
			background: #15D815;
		}
	</style>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8">
				<div class="card text-center">
					<div class="card-header">
						Validación QR
					</div>
					<div class="card-body">
						<div class="container-cam">
							<div id="reader" style="border: none !important;" style="width:50px;height:50px;"></div>
						</div>
					</div>
					<button class="btn btn-primary" id="verifyQr">Nueva validación QR</button>
				</div>
			</div>
		</div>
		<div class="row justify-content-center" id="showDatosPersonales">
			<div class="col-12 col-md-8">
				<div class="card text-center">
					<div class="card-header">
						Datos del personal
					</div>
					<div class="card-body">
						<div style=" margin-bottom: 10px;">
							<img id="imgDatosPersonales" class="rounded" src="" alt="" style="width: 150px;"/>
						</div>
						<h5 class="card-title" id="titleDatosPersonales">
							<span class="badge text-bg-success"></span>
						</h5>
						<p class="card-text">
							<div class="row justify-content-center">
								<div class="col-12 col-md-12">
									<table width="100%">
										<tbody>
											<tr>
												<td id="txtNombre"></td>
											</tr>
											<tr>
												<td id="txtDNI"></td>
											</tr>
											<tr>
												<td id="txtCargo"></td>
											</tr>
											<tr>
												<td id="txtOficina"></td>
											</tr>
										</tbody>
									</table>

								</div>
							</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
{% endblock %}
