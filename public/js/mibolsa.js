$(document).on('ready', function () {
//alert("hola");

//validar boton registrar
$("#registrar-btn").on("click",function(){
   frm = $("#form_registro");
   $.ajax({
    url: frm.attr("action"),
    type: 'POST',
    data: frm.serialize(),
    success: function (msg) {
        var result = msg;
        if (result.say === "yes")
        {


            //bootbox.alert("<strong>Se agrego correctamente</strong>")
            $("#modal_tres").modal("show");
            
        } else {
            console.log("llegamos a la disco");
            $(".errorforms").remove();

            $.each(result, function (i, val) {
                $("#input-" + i).focus();
                $("#input-" + i).closest(".input-group").after(val);
            });
        }
    }
});

});



//Validar envio de cv
$("#enviar-btn").on("click",function(){
    
    frm = $("#form_validarcv");
    $.ajax({
        url: frm.attr("action"),
        type: 'POST',
        data: frm.serialize(),
        success: function (msg) {
            var result = msg;

            //Capturamos la variable postulo definida en el array del controlardor 
            //webcontroller
            //Se instancias dos veces para poder entrar al array
            console.log(msg.postulo.postulo);
            if (msg.postulo.postulo == "si"){
               $("#modal_dos").modal("show");
            //Capturamos la variable profesional que se añadio en el controlador
            //webcontroller


        }else{
           $("#exampleModal").modal("show");
           console.log(msg.profesional.cv);
           if(msg.profesional.cv == null){
            $('#cv_defecto').hide();

        }
    }
}
});

});


//Validar boton enviar
$("#enviar-msg").on("click",function(){
    
 
    var frm = new FormData(document.getElementById("form_validarcv"));
    
    $.ajax({
        type: 'POST',
        url: base_url +"webbolsa/savecv",
        data: frm,       
        success: function (response) {
            if(response.say == 'yes'){
                $("#exampleModal").modal("hide");
                $("#modal_aceptado").modal("show");
            }else{
                alert("Debe elegir una opción para poder postular a este empleo");
            }

        },
        cache: false,
        contentType: false,
        processData: false
    });
});

});