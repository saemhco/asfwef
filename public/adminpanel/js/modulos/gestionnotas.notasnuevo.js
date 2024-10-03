$(document).ready(function () {


    
    $(".activax").on("click",function(){
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        //$(".activa").removeClass("active");
         //$(this).addClass("active");
        //$(".not").attr("disabled","disabled");
        //$("."+item).removeAttr('disabled');
       
       
    });
    
    $(".activ").on("click",function(){
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        //$(".activa").removeClass("active");
        // $(this).parent().addClass("active");
        //$(".not").attr("disabled","disabled");
        //$("."+item).removeAttr('disabled');
        $(".pp_check").prop("checked",false);
         $(this).parent().find(".pp_check").prop("checked", true);
      
       
    });
    
    
    $("#semestre").on("change",function(){
       var sema = $(this).val();
       window.location.href = base_url + "gestionnotas/index/"+sema;
    });
    
    
    $(".not").on("click",function(){
       console.log("nais");
       $(this).focus();
    });
    
    
    



    $("#guardar").on("click", function () {
        
        //alert("Funcion guardar");
        $(".not").removeAttr('disabled');
        frm = $("#form-notas");
        $.ajax({
            url: base_url + "gestionnotas/guardanotas",
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                console.log(msg);
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert("<strong>Se guardo las notas correctamente</strong>");
                    //window.location.href = base_url + "";

                } else {
                    console.log("llegamos a la disco");
                    //$(".errorforms").remove();
                   
                }
            }
        });
        $(".not").attr("disabled","disabled");
        
    });






       $("#error_agregar").dialog({
		    autoOpen: false,
		    resizable: false,
		    modal: true,
		    title: "<div class='widget-header txt-color-red'><h4><i class='fa fa-warning'></i> Error ! </h4></div>",
		    show: {
		        effect: "highlight",
		        duration: 300
		    },
		    hide: {
		        effect: "clip",
		        duration: 300
		    },
		    buttons: [{
		            html: "Aceptar",
		            "class": "btn btn-danger btn-sm ",
		            click: function () {
		                $(this).dialog("close");
		            }
		        }]
		});


});





function agregar(){
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        window.location.href = base_url + "gestionnotas/notas/"+xsmart+"/"+semes;
    } else {
        errordialogtablecuriosity();
    }
}  


function calculaprom(t) {
    var row = t.closest('tr');
    var p_p1 = parseFloat(row.find('.p_p1').find('.pp1').val());
    var p_p2 = parseFloat(row.find('.p_p2').find('.pp2').val());
    var p_ef = parseFloat(row.find('.p_ef').find('.pef').val());
    var xNotaFinal= 0;
    
    if (p_ef == 0 ){
        xNotaFinal = Math.round((p_p1 + p_p2)/2);
                                   
    }else{
        if(p_ef > 0){
            if(p_p1 >= p_p2){
                xNotaFinal =  Math.round((p_ef + p_p1) / 2);
            }else{
                xNotaFinal =  Math.round((p_ef + p_p2) / 2);
            }
        }                                
    }
    
    row.find('.p_pf').find('.ppf').val(xNotaFinal);
    console.log(xNotaFinal);
}





function calculaFormulaPeso(t){
    if(t.val()>20){
        bootbox.alert("El puntaje maximo es 20");
        t.val(20);
    }

    if(t.val()<0){
        bootbox.alert("las notas no pueden ser numeros negativos");
        t.val(0);
    }

	var pf = 0;
	var row = t.closest('tr');
	for(i=1;i<=bucle_notas;i++){

		var not = parseFloat(row.find('.p_p'+i).find('.pp'+i).val());
		var multi = parseFloat(row.find('.p_p'+i).find('.m-pp'+i).val());
		if (isNaN(not)) {
		    not = 0;
		}
		pf += not*multi;
	}
	pf = Math.round(pf);
	row.find('.p_pf').find('.ppf').val(pf);
    console.log(pf);
}