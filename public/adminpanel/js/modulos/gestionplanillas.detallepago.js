$(document).ready(function(){
	$("#remu-bruta").keypress(function (e) {
 		var key = e.which;
		if(key == 13){
			var remu = parseFloat($(this).val());
			// llenamos el primer parametro por defecto
			$("#remu-bruta").val((remu).toFixed(2));
			$("#remuneracion-basica").val((remu).toFixed(2));
			$("#remu-asegurable").val((remu).toFixed(2));

			setIngresos(remu.toFixed(2))
			setDescuentos(remu.toFixed(2))
			setAportes(remu.toFixed(2))
			setTotal(remu.toFixed(2))
		}
	});   

	$("#calcula-pago").on("click",function(){
		var ingresos = sumaIngresos();
		var descuentos = sumaDescuentos();
		var aportes = sumaAportes();

		var neto = ingresos-descuentos;
		neto = parseFloat(neto);

		$("#neto-pago").val(neto.toFixed(2));
	});

	 $("#btn-guarda").on("click",function(){
        frm = $("#form-detalle-pago");
        $.ajax({
            url: base_url+"gestionplanillas/savedetallepago",
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert("<strong>Se registró correctamente ...</strong>");
                } else {
                    bootbox.alert("<strong>ocurrio un error...</strong>");
                }
            }
        });       
    })

})

function setTotal(remu){
		//Fixed Values
		//ing
		var fixed_remu_basica = parseFloat(remu);
		//desc
		var fixed_descuentos = 0;
		var factor_aporte_obligatorio = $('#aporte_obligatorio-factor').val();
			factor_aporte_obligatorio = parseFloat(factor_aporte_obligatorio);
			factor_aporte_obligatorio = (remu*factor_aporte_obligatorio)/100;
			factor_aporte_obligatorio =  factor_aporte_obligatorio.toFixed(2);

		var factor_prima_seguro = $('#prima_seguro-factor').val();
			factor_prima_seguro = parseFloat(factor_prima_seguro);
			factor_prima_seguro = (remu*factor_prima_seguro)/100;
			factor_prima_seguro =  factor_prima_seguro.toFixed(2);

		var factor_csr = $('#csr-factor').val();
			factor_csr = parseFloat(factor_csr);
			factor_csr = (remu*factor_csr)/100;
			factor_csr =  factor_csr.toFixed(2);

		var factor_cuarta_categoria = $('#cuarta_categoria-factor').val();
			factor_cuarta_categoria = parseFloat(factor_cuarta_categoria);
			factor_cuarta_categoria = (remu*factor_cuarta_categoria)/100;
			factor_cuarta_categoria =  factor_cuarta_categoria.toFixed(2);

		var factor_quinta_categoria = $('#quinta_categoria-factor').val();
			factor_quinta_categoria = parseFloat(factor_quinta_categoria);
			factor_quinta_categoria = (remu*factor_quinta_categoria)/100;
			factor_quinta_categoria =  factor_quinta_categoria.toFixed(2);	
	    
	    var dscto_judicial_soles = $('#dscto_judicial_soles').val();
	   		dscto_judicial_soles = parseFloat(dscto_judicial_soles);
	   		dscto_judicial_soles =  dscto_judicial_soles.toFixed(2);

	   	$("#aporte_obligatorio").val(factor_aporte_obligatorio);
	   	$("#prima_seguro").val(factor_prima_seguro);
	   	$("#csr").val(factor_csr);
	   	$("#cuarta_categoria").val(factor_cuarta_categoria);
	   	$("#quinta_categoria").val(factor_quinta_categoria);
	   	$("#dscto_judicial_soles").val(dscto_judicial_soles);

	   	fixed_descuentos = parseFloat(factor_aporte_obligatorio)+parseFloat(factor_prima_seguro)+
	   	parseFloat(factor_csr)+parseFloat(factor_cuarta_categoria)+parseFloat(factor_quinta_categoria)+parseFloat(dscto_judicial_soles);
	   	//Aportes
	   	var fixed_aportes = 0;
	   	var aportaciones = $('#aportaciones').val();
	   		aportaciones = parseFloat(aportaciones);
	   		aportaciones =  aportaciones.toFixed(2);

	   	var essalud = $('#essalud').val();
	   		essalud = parseFloat(essalud);
	   		essalud =  essalud.toFixed(2);

	   	var ies = $('#ies').val();
	   		ies = parseFloat(ies);
	   		ies =  ies.toFixed(2);

	   	var sctr = $('#sctr').val();
	   		sctr = parseFloat(sctr);
	   		sctr =  sctr.toFixed(2);
		fixed_aportes = parseFloat(aportaciones)+parseFloat(essalud)+parseFloat(ies)+parseFloat(sctr);

		console.log("SET - TOTAL");
		console.log(fixed_remu_basica);
		console.log(fixed_descuentos);
		console.log(fixed_aportes);
		//Automatico
		var ingresos = sumaIngresos()+fixed_remu_basica;
		var descuentos = sumaDescuentos()+fixed_descuentos;
		var aportes = sumaAportes()+fixed_aportes;
		var neto = 0;
		
		neto = ingresos-descuentos;
		neto = parseFloat(neto);

		$("#total-desc").val(descuentos.toFixed(2));
		$("#total-ap").val(aportes.toFixed(2));
		$("#neto-pago").val(neto.toFixed(2));
}
function sumaIngresos(){


	var total = 0;
	$.each($('input[name="ingresos-value[]"]'), function(key,value){
	   if(isNaN(parseFloat($(this).val()))){

	   }else{
	   		total += parseFloat($(this).val());
	   }
	   
	});
	console.log(total);

	return total
}

function setIngresos(remu){
	var total = 0;
	var factors = [];
	$.each($('input[name="ingresos-factor[]"]'), function(key,value){

	   if(isNaN(parseFloat($(this).val()))){
	   		factors[key] = 1;
	   }else{
	   		factors[key] = parseFloat($(this).val());
	   }
	   
	});

	console.log(factors);

	$.each($('input[name="ingresos-value[]"]'), function(key,value){
	   var op = 0 ;
	   op = (remu*factors[key])/100;
	   console.log(op);
	   $(this).val(op.toFixed(2));
	});
	
}

function sumaDescuentos(){
	var total = 0;

	

	$.each($('input[name="descuentos-value[]"]'), function(){
	  	 if(isNaN(parseFloat($(this).val()))){

	   }else{
	   		total += parseFloat($(this).val());
	   }
	   
	});
	console.log(total);
	
	return total
}


function setDescuentos(remu){
	var total = 0;
	var factors = [];
	$.each($('input[name="descuentos-factor[]"]'), function(key,value){

	   if(isNaN(parseFloat($(this).val()))){
	   		factors[key] = 1;
	   }else{
	   		factors[key] = parseFloat($(this).val());
	   }
	   
	});

	console.log(factors);

	$.each($('input[name="descuentos-value[]"]'), function(key,value){
	   var op = 0 ;
	   op = (remu*factors[key])/100;
	   console.log(op);
	   $(this).val(op.toFixed(2));
	});
}

function sumaAportes(){
	var total = 0;
	$.each($('input[name="aportes-value[]"]'), function(){
	    if(isNaN(parseFloat($(this).val()))){

	   }else{
	   		total += parseFloat($(this).val());
	   }
	});
	console.log(total);
	
	return total
}

function setAportes(remu){
	var total = 0;
	var factors = [];
	$.each($('input[name="aportes-factor[]"]'), function(key,value){

	   if(isNaN(parseFloat($(this).val()))){
	   		factors[key] = 1;
	   }else{
	   		factors[key] = parseFloat($(this).val());
	   }
	   
	});

	console.log(factors);

	$.each($('input[name="aportes-value[]"]'), function(key,value){
	   var op = 0 ;
	   op = (remu*factors[key])/100;
	   console.log(op);
	   $(this).val(op.toFixed(2));
	  
	});
}