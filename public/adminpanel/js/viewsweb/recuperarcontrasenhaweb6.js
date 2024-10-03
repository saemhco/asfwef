$(document).ready(function () {

    //Boton recuperar clave
    $("#btn-recuperar").on("click", function () {

        //alert("Testing");
        if ($("#email").val() === "") {

            //alert("Email vacio");
            $("#modal_email_vacio").modal("show");


        } else {
            
            frm = $("#form_recuperarclave");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (msg) {
                    //alert("FUAAAAAAAAAAAAAAAAAAAAA");
                    //console.log("mensaje:" + msg.mensaje_envio);

                    if (msg.mensaje_envio == "si") {


                        //alert("Se envió  un correo con el link de recuperar contraseña");
                        $("#modal_envio_link").modal("show");

                    } else {

                        //alert("El email no esta registrado");
                        $("#modal_email_no_registrado").modal("show");

                    }

                }
            });

        }


    });


});
