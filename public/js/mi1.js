$(document).on('ready', function () {
    //alert("hola");

//validar boton registrar
    $("#registrar-btn").on("click", function () {
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






    $("#enviar-btn").on("click", function () {

        //alert("Hola Mundo");

        $("#modal_confirmar").modal("show");

        $(".btn-primary").click(function () {


            frm = $("#form_validarcv");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(), //Agarra todo los campos del formulario y envia como array
                success: function (msg) {
                    var result = msg;

                    //Capturamos la variable postulo definida en el array del controlardor 
                    //webcontroller
                    console.log(msg);


                    if (msg.reservacion.reservo === "si") {
                        $("#modal_aceptado").modal("show");

                    } else {

                        $("#modal_dos").modal("show");

                    }


                }
            });

            $("#modal_confirmar").modal("hide");

        });




    });


//Validar boton enviar
    $("#enviar-msg").on("click", function () {


        var frm = new FormData(document.getElementById("form_validarcv"));

        $.ajax({
            type: 'POST',
            url: base_url + "web/savecv",
            data: frm,
            success: function (response) {
                if (response.say == 'yes') {
                    $("#exampleModal").modal("hide");
                    $("#modal_aceptado").modal("show");
                } else {
                    alert("Debe elegir una opción para poder postular a este empleo");
                }

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    //recuperarclaveweb
    $("#btn-recuperar").on("click", function () {
        
        if ($("#email").val()===""){
           $("#modal_mensaje_email_vacio").modal("show");

        }else{


        frm = $("#form_recuperarclave");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                //alert("FUAAAAAAAAAAAAAAAAAAAAA");
                console.log("mensaje:" + msg.mensaje_envio);

                if (msg.mensaje_envio == "si") {

                    $("#modal_mensaje_enviado").modal("show");

                } else {
                    $("#modal_mensaje_enviado_error").modal("show");

                }

            }
        });
        
        }




    });


});