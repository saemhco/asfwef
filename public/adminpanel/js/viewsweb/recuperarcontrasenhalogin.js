$(document).ready(function () {

    //Recuperar pass
    $("#btn_recuperar_contrasenha_enlace").on("click", function () {

        if ($("#password").val() === "") {

            //bootbox.alert("El campo contraseña esta vacio");
            $("#modal_contraseña_vacio").modal("show");

        } else if ($("#password_repeat").val() === "") {

            //bootbox.alert("El campo repita contraseña esta vacio");
            $("#modal_nueva_contraseña_vacio").modal("show");

        } else {
            //alert("Testing");
            frm = $("#form_recuperar_contrasenha_enlace");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (msg) {
                    //alert("FUAAAAAAAAAAAAAAAAAAAAA");
                    //console.log("mensaje:" + msg.mensaje_envio);

                    if (msg.mensaje_envio == "si") {
                        /*
                         bootbox.alert({
                         message: "Su contraseña fue cambiada con éxito",
                         callback: function () {
                         //console.log('This was logged in the callback!');
                         window.location.href = base_url + "web/login";
                         }
                         });
                         */

                        //mostramnos modal de exito
                        $("#modal_contraseña_exito").modal("show");

                        //ejecutamos accion al cerrar modal
                        $("#modal_contraseña_exito").on("hide.bs.modal", function () {
                            //alert('Testing');
                            window.location.href = base_url + "login.html";
                        });



                    } else {
                        //$("#modal_mensaje_enviado_error").modal("show");
                        //alert("El email no esta registrado");
                        //bootbox.alert("La contraseña enviada es distinta a la de confirmacion , intentelo nuevamente");
                        $("#modal_nueva_contraseña_error").modal("show");
                    }

                }
            });
        }

    });

});
