$(document).ready(function () {

	$("#i_aguin_jul").keyup(function () {
		var i_aguin_jul_save = parseFloat($('#i_aguin_jul').val());
		saveAguinaldoJulio(id_planilla_detalle, i_aguin_jul_save);
	});

	$("#i_aguin_dic").keyup(function () {
		var i_aguin_dic_save = parseFloat($('#i_aguin_dic').val());
		saveAguinaldoDiciembre(id_planilla_detalle, i_aguin_dic_save);
	});

	$("#d_tard").keyup(function () {
		var d_tard_save = parseFloat($('#d_tard').val());
		saveDTardanza(id_planilla_detalle, d_tard_save);
	});

	$("#d_inas").keyup(function () {
		var d_inas_save = parseFloat($('#d_inas').val());
		saveDInasistencia(id_planilla_detalle, d_inas_save);
	});

	
	$("#d_judicial").keyup(function () {
		var d_judicial_save = parseFloat($('#d_judicial').val());
		saveDJudicial(id_planilla_detalle, d_judicial_save);
	});


	$("#renta").change(function () {
		if ($("#renta").is(':checked')) {
			console.log("Tiene check");
			//guarda renta = 1
			var renta = "1";
			saveRenta(id_planilla_detalle, renta);
		} else {
			console.log("No tiene check");
			//guarda renta = 0
			var renta = "0";
			saveRenta(id_planilla_detalle, renta);
		}
	});

	$("#afp_no").change(function () {
		if ($("#afp_no").is(':checked')) {
			console.log("Tiene check");
			//guarda renta = 1
			var afp_no = "1";
			saveAfpno(id_planilla_detalle, afp_no);
		} else {
			console.log("No tiene check");
			//guarda renta = 0
			var afp_no = "0";
			saveAfpno(id_planilla_detalle, afp_no);
		}
	});
});

function saveAguinaldoJulio(id_planilla_detalle, i_aguin_jul) {

	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveAguinaldoJulio",
		data: { id_planilla_detalle: id_planilla_detalle, i_aguin_jul: i_aguin_jul },
		dataType: 'json',
		success: function (response) {
			//console.log(response.estado);
			if (response.say === 'yes') {
				$('#remuneracion-bruta').val(response.obj.rem_bruta);
				$("#remuneracion-neta").val(response.obj.rem_neta);
			}
		}, complete: function () {
			console.log("load save");
		}
	});
}



function saveAguinaldoDiciembre(id_planilla_detalle, i_aguin_dic) {

	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveAguinaldoDiciembre",
		data: { id_planilla_detalle: id_planilla_detalle, i_aguin_dic: i_aguin_dic },
		dataType: 'json',
		success: function (response) {
			//console.log(response.estado);
			if (response.say === 'yes') {
				$('#remuneracion-bruta').val(response.obj.rem_bruta);
				$("#remuneracion-neta").val(response.obj.rem_neta);
			}
		}, complete: function () {
			console.log("load save");
		}
	});
}

function saveDTardanza(id_planilla_detalle, d_tard) {
	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveDTardanza",
		data: { id_planilla_detalle: id_planilla_detalle, d_tard: d_tard },
		dataType: 'json',
		success: function (response) {
			//console.log(response.estado);
			if (response.say === 'yes') {
				$('#remuneracion-asegurable').val(response.obj.rem_aseg);
				$("#total-descuentos").val(response.obj.descuentos);
				$("#remuneracion-neta").val(response.obj.rem_neta);
			}
		}, complete: function () {
			console.log("load save");
		}
	});
}


function saveDInasistencia(id_planilla_detalle, d_inas) {
	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveDInasistencia",
		data: { id_planilla_detalle: id_planilla_detalle, d_inas: d_inas },
		dataType: 'json',
		success: function (response) {
			//console.log(response.estado);
			if (response.say === 'yes') {
				$('#remuneracion-asegurable').val(response.obj.rem_aseg);
				$("#total-descuentos").val(response.obj.descuentos);
				$("#remuneracion-neta").val(response.obj.rem_neta);
			}
		}, complete: function () {
			console.log("load save");
		}
	});
}

function saveDJudicial(id_planilla_detalle, d_judicial) {
	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveDJudicial",
		data: { id_planilla_detalle: id_planilla_detalle, d_judicial: d_judicial },
		dataType: 'json',
		success: function (response) {
			//console.log(response.estado);
			if (response.say === 'yes') {
				$("#total-descuentos").val(response.obj.descuentos);
				$("#remuneracion-neta").val(response.obj.rem_neta);
			}
		}, complete: function () {
			console.log("load save");
		}
	});
}


function saveRenta(id_planilla_detalle, renta) {
	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveRenta",
		data: { id_planilla_detalle: id_planilla_detalle, renta: renta },
		dataType: 'json',
		success: function (response) {

			$('#d_4ta_cat').val(response.obj.cuarta_cat);
			$("#total-descuentos").val(response.obj.descuentos);
			$("#remuneracion-neta").val(response.obj.rem_neta);

		}, complete: function () {
			//console.log("load save");
		}
	});
}

function saveAfpno(id_planilla_detalle, afp_no) {
	$.ajax({
		type: 'POST',
		url: base_url + "registroplanillas/saveAfpno",
		data: { id_planilla_detalle: id_planilla_detalle, afp_no: afp_no },
		dataType: 'json',
		success: function (response) {

			$('#aporte').val(response.obj.afp_aporte);
			$('#prima').val(response.obj.afp_prima);
			$('#comision').val(response.obj.afp_comision);
			$("#total-descuentos").val(response.obj.descuentos);
			$("#remuneracion-neta").val(response.obj.rem_neta);

		}, complete: function () {
			//console.log("load save");
		}
	});
}
