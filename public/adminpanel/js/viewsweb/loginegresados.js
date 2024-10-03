$(document).ready(function () {
//select tipo de usuario

    $("#btn_login_perfiles").on("click", function () {

        //limpiar alertas
        $(".errorforms").hide();

        //alert('Testing');
        if ($("#input_tipousuario_select").val() === "" || $("#input_email").val() === "" || $("#input_nro_doc").val() === "" || $("#input_password").val() === "") {
            if ($("#input_tipousuario_select").val() === "") {
                //console.log('Testing');
                var val = '<div class="text-danger errorforms">El campo tipo de usuario es requerido</div>';
                $("#select_tipo_usuario").after(val);

            }

            if ($("#input_email").val() === "") {
                //alert('campo vacio');
                var val = '<div class="text-danger errorforms">El campo email es requerido</div>';
                $("#input_email").after(val);

            }

            if ($("#input_nro_doc").val() === "") {
                //alert('campo vacio');
                var val = '<div class="text-danger errorforms">El campo número de DNI es requerido</div>';
                $("#input_nro_doc").after(val);

            }

            if ($("#input_password").val() === "") {

                var val = '<div class="text-danger errorforms">El campo contraseña es requerido</div>';
                $("#input_password").after(val);
            }
        } else {
            //ajax
            frm = $("#form_sesion_perfiles");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (msg) {
                    if (msg.say === "yes") {
                        window.location.href = "panel";
                    } else if (msg.say === "no") {
                        //alert("Credenciales no registradas , intentelo nuevamente");


                        $("#modal_campo_vacio").modal("show");
                        $("#modal_campo_vacio .modal-body").text('Contraseña incorrecta, intentelo nuevamente...');

                        //location.reload();
                    } else if (msg.say === "no_existe") {
                        //alert("Credenciales no registradas , intentelo nuevamente");


                        $("#modal_campo_vacio").modal("show");
                        $("#modal_campo_vacio .modal-body").text('Credenciales no registradas , intentelo nuevamente');

                        //location.reload();
                    }
                }
            });

        }


    });
    //fin boton login

    $("#btn_cerrar_alerta").on("click", function () {
        location.reload();
    });
});


