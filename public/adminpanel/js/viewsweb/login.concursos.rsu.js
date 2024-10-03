$(document).ready(function () {

    //alert('Hola Mundo');

    

    //
    $("#btn_login_concursos_rsu").on("click", function () {

        //limpiar alertas
        $(".errorforms").hide();

        //alert('Testing');
        if ($("#input_nro_doc_login").val() === "" || $("#input_password_login").val() === "") {
            if ($("#input_nro_doc_login").val() === "") {
                //alert('campo vacio');
                var val = '<div class="text-danger errorforms">El campo número de documento es requerido</div>';
                $("#input_nro_doc_login").after(val);

            }
            if ($("#input_password_login").val() === "") {

                var val = '<div class="text-danger errorforms">El campo contraseña es requerido</div>';
                $("#input_password_login").after(val);
            }
        } else {
            //ajax
            frm = $("#form_sesion_concursos_rsu");
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
                        $("#modal_campo_vacio .modal-body").text('Contraseña incorrecta, intentelo nuevamente');

                        //location.reload();
                    } else if (msg.say === "no_existe") {
                        //alert("Credenciales no registradas , intentelo nuevamente");


                        $("#modal_campo_vacio").modal("show");
                        $("#modal_campo_vacio .modal-body").text('Credenciales no registradas , intentelo nuevamente');

                        //location.reload();
                    } else if (msg.say === "evaluado") {
                        //alert("Credenciales no registradas , intentelo nuevamente");


                        $("#modal_campo_vacio").modal("show");
                        $("#modal_campo_vacio .modal-body").text('Usted esta siendo evaluado en el sistema de convocatorias');

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


function agregar() {
    // $(".errorforms").hide();
    // $(".error_focus").hide();
    // $("#form_registro_postulante")[0].reset();
    // $('#modal_registro_postulante').modal('show');
    $('#modal_warning').modal('show');
}

