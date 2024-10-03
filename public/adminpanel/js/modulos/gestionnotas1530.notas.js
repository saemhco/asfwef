$(document).ready(function () {

    $(".activax").on("click",function(){
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
         $(this).addClass("active");
        $(".not").attr("disabled","disabled");
        $("."+item).removeAttr('disabled');
       
       
    });
    
      $(".activ").on("click",function(){
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
         $(this).parent().addClass("active");
        $(".not").attr("disabled","disabled");
        $("."+item).removeAttr('disabled');
        $(".pp_check").prop("checked",false);
         $(this).parent().find(".pp_check").prop("checked", true);
      
       
    });
    
    
    $("#semestre").on("change",function(){
       var sema = $(this).val();
       window.location.href = base_url + "gestionnotas1530/index/"+sema;
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
            url: base_url + "gestionnotas1530/guardanotas",
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
        window.location.href = base_url + "gestionnotas1530/notas/"+xsmart+"/"+semes;
    } else {
        errordialogtablecuriosity();
    }
}  


function calculaprom(t) {
    var row = t.closest('tr');


    var p_p1 = parseFloat(row.find('.p_p1').find('.pp1').val());

    if(isNaN(p_p1)){
        p_p1 = 0;
    }

    var p_p2 = parseFloat(row.find('.p_p2').find('.pp2').val());
    if(isNaN(p_p2)){
        p_p2 = 0;
    }

    var p_ef = parseFloat(row.find('.p_ef').find('.pef').val());
    if(isNaN(p_ef)){
        p_ef = 0;
    }

    var p_ea = parseFloat(row.find('.p_ea').find('.pea').val());
    if(isNaN(p_ea)){
        p_ea = 0;
    }

    var xNotaFinal= 0;


    
    if (p_ea == 0){
        xNotaFinal = Math.round((p_p1 * 0.30 + p_p2 * 0.30 + p_ef * 0.40));
                                
    }else{
        if(p_ea > 0){
              if(p_p1 >= p_p2){
                    xNotaFinal =  Math.round((p_ea * 0.30 + p_p1 * 0.30 + p_ef * 0.40));
              }else{
                    xNotaFinal =  Math.round((p_ea * 0.30 + p_p2 * 0.30 + p_ef * 0.40));
              }
        }                                
    }
    
    row.find('.p_pf').find('.ppf').val(xNotaFinal);
    console.log(xNotaFinal);
}