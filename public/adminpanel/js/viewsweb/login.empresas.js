$(document).ready(function () {


    $("#btn_login_perfiles").on("click", function () {

        //limpiar alertas
        $(".errorforms").hide();

        //alert('Testing');
        if ($("#input_ruc_form_sesion_perfiles").val() === "" || $("#input_password_form_sesion_perfiles").val() === "") {

            if ($("#input_ruc_form_sesion_perfiles").val() === "") {
                //alert('campo vacio');
                var val = '<div class="text-danger errorforms">El campo número de RUC es requerido</div>';
                $("#input_ruc_form_sesion_perfiles").after(val);

            }

            if ($("#input_password_form_sesion_perfiles").val() === "") {

                var val = '<div class="text-danger errorforms">El campo contraseña es requerido</div>';
                $("#input_password_form_sesion_perfiles").after(val);
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


    //validacion nro_doc publico
    $("#input_nro_doc_modal").focusout(function () {
        $('#alerta_nro_doc').remove();
        var nro_doc = $("#input_nro_doc_modal").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/publicoExternoNroDoc",
            data: {nro_doc: nro_doc},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'yes') {

                    $("#input_nro_doc_modal").after('<p id="alerta_nro_doc" class="error_focus" style="color:#C82333;">El número de documento ya está registrado</div>');
                }
            }
        });
    });

    //validacion email publico
    $("#input_email_publico").focusout(function () {
        $('#alerta_email').remove();
        var email = $("#input_email_publico").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/publicoExternoEmail",
            data: {"email": email},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'yes') {

                    $("#input_nro_doc").after('<p id="alerta_email" class="error_focus" style="color:#C82333;">El email ya está registrado</div>');
                }
            }
        });
    });

    //validacion ruc empresa
    $("#input_nro_ruc").focusout(function () {
        $('#alerta_nro_ruc').remove();
        var ruc = $("#input_nro_ruc").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/empresaExternoRuc",
            data: {"ruc": ruc},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'yes') {

                    $("#input_nro_ruc").after('<p id="alerta_nro_ruc" class="error_focus" style="color:#C82333;">El ruc ya está registrado</div>');
                }
            }
        });
    });


    //validacion email empresa
    $("#input_email_empresa").focusout(function () {
        $('#alerta_email').remove();
        var email = $("#input_email_empresa").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/empresaExternoEmail",
            data: {"email": email},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'yes') {

                    $("#input_email_empresa").after('<p id="alerta_email" class="error_focus" style="color:#C82333;">El email ya está registrado</div>');
                }
            }
        });
    });


//    $("#btn_grabar_publico").on("click", function () {
//
//        //alert('Testing');
//        $('#alerta_nro_doc').remove();
//        $('#alerta_email').remove();
//
//        var input_password = $("#input_password_publico_modal").val();
//        //alert(input_password);
//        var input_password2 = $("#input_password_publico_repeat_modal").val();
//
//        if (input_password === input_password2) {
//
//            //alert('Testing');
//            frmx = $("#form_registro_publico");
//            var frm = new FormData(document.getElementById("form_registro_publico"));
//            $.ajax({
//                url: frmx.attr("action"),
//                type: 'POST',
//                //data: frm.serialize(),
//                data: frm,
//                cache: false,
//                contentType: false,
//                processData: false,
//                success: function (msg) {
//                    var result = msg;
//                    if (result.say === "yes")
//                    {
//
//
//                        //bootbox.alert("<strong>Se registró correctamente</strong>")
//                        $("#modal_registro_publico").modal("hide");
//
//                        $("#modal_save_publico").modal("show");
//                        $("#modal_save_publico").on("hide.bs.modal", function () {
//                            //alert('Testing');
//                            //window.location.href = base_url + "login-convocatorias.html";
//                            window.location.reload();
//                        });
//
//                        //$("#form_sliders")[0].reset();
//
//                    } else {
//
//                        //console.log("Error grabar");
//                        $(".errorforms").remove();
//
//                        $.each(result, function (i, val) {
//                            //console.log(i);
//                            //console.log(val);
//                            $("#input_" + i).focus();
//                            $("#input_" + i).after(val);
//
//                            if (i === 'sexo') {
//                                $("#select_sexo").after(val);
//                            }
//
//                            if (i === "nro_doc") {
//                                $("#input_nro_doc_modal").after(val);
//                            }
//
//
//                            if (i === "email") {
//                                $("#input_email_publico").after(val);
//                            }
//
//                            if (i === "password") {
//
//                                $("#input_password_publico_modal").after(val);
//                            }
//
//
//
//
//                        });
//                    }
//                }
//            });
//
//        } else {
//            //console.log("Testing");
//            $(".errorforms").remove();
//            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
//            $("#input_password_publico_repeat_modal").after(val);
//        }
//
//
//    });


    $("#btn_grabar_empresa").on("click", function () {

        //alert('Testing');
        $('#alerta_nro_ruc').remove();
        $('#alerta_email').remove();

        var input_password = $("#input_password_empresa_modal").val();
        //alert(input_password);
        var input_password2 = $("#input_password_empresa_repeat_modal").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_empresa");
            var frm = new FormData(document.getElementById("form_registro_empresa"));
            $.ajax({
                url: frmx.attr("action"),
                type: 'POST',
                //data: frm.serialize(),
                data: frm,
                cache: false,
                contentType: false,
                processData: false,
                success: function (msg) {
                    var result = msg;
                    if (result.say === "yes")
                    {


                        //bootbox.alert("<strong>Se registró correctamente</strong>")
                        $("#modal_registro_empresa").modal("hide");

                        $("#modal_save_empresa").modal("show");
                        $("#modal_save_empresa").on("hide.bs.modal", function () {
                            //alert('Testing');
                            //window.location.href = base_url + "login-convocatorias.html";
                            window.location.reload();
                        });

                        //$("#form_sliders")[0].reset();

                    } else {

                        //console.log("Error grabar");
                        $(".errorforms").remove();

                        $.each(result, function (i, val) {
                            //console.log(i);
                            //console.log(val);
                            $("#input_" + i).focus();
                            $("#input_" + i).after(val);

                            if (i === "direccion") {
                                $("#input_direccion_empresa").after(val);
                            }

                            if (i === 'ruc') {

                                $("#input_nro_ruc").after(val);
                            }


                            if (i === "password") {

                                $("#input_password_empresa_modal").after(val);
                            }

                            if (i === "email") {
                                //input_email_empresa
                                $("#input_email_empresa").after(val);
                            }



                        });
                    }
                }
            });

        } else {
            //console.log("Testing");
            $(".errorforms").remove();
            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
            $("#input_password_empresa_repeat_modal").after(val);
        }


    });
});

//function registro_publico() {
//    $(".errorforms").hide();
//    $(".error_focus").hide();
//    $("#form_registro_publico")[0].reset();
//    $('#modal_registro_publico').modal('show');
//}


function registro_empresa() {
    $(".errorforms").hide();
    $(".error_focus").hide();
    $("#form_registro_empresa")[0].reset();
    $('#modal_registro_empresa').modal('show');
}


