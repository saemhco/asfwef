$(document).ready(function () {


    //validacion postulante existente con numero dni
    $("#input_nro_doc").focusout(function () {

        $('#alerta_nro_doc').remove();

        var nro_doc = $("#input_nro_doc").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/postulanteRegistrado",
            data: { nro_doc: nro_doc },
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    //alert('El numero de DNI ya esta registrado');

                    $("#input_nro_doc").after('<p id="alerta_nro_doc" class="error_focus" style="color:red;">El número de documento ya está registrado</div>');

                } else {

                }

                //$(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });


    });



    $("#btn_grabar_postulantes").on("click", function () {

        $(".errorforms").remove();

        var input_password = $("#input_password").val();
        //alert(input_password);
        var input_password2 = $("#input_password2").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_postulante");
            var frm = new FormData(document.getElementById("form_registro_postulante"));
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
                    if (result.say === "yes") {


                        //bootbox.alert("<strong>Se registró correctamente</strong>")
                        $("#modal_registro_postulante").modal("hide");

                        $("#modal_save_postulante").modal("show");
                        $("#modal_save_postulante").on("hide.bs.modal", function () {
                            window.location.reload();
                        });


                        //$("#form_sliders")[0].reset();

                    } else if (result.say === "error_foto") {
                        $(".errorforms").remove();
                        var val = '<div class="text-danger errorforms">Subir foto en formato jpg/jpeg/png</div>';
                        $("#input_foto").after(val);
                    } else if (result.say === "error_archivo") {
                        $(".errorforms").remove();
                        var val = '<div class="text-danger errorforms">Subir archivo en formato pdf</div>';
                        $("#input_archivo").after(val);
                    } else if (result.say === "error_archivo_escuela") {
                        $(".errorforms").remove();
                        var val = '<div class="text-danger errorforms">Subir archivo en formato pdf</div>';
                        $("#input_archivo_escuela").after(val);
                    } else if (result.say === "password_vacio") {
                        $(".errorforms").remove();
                        var val = '<div class="text-danger errorforms">El campo contraseña esta vacio</div>';
                        $("#input_password").after(val);
                    } else {

                        //console.log("Error grabar");
                        $(".errorforms").remove();

                        $.each(result, function (i, val) {
                            console.log(i);
                            //console.log(val);
                            $("#input_" + i).focus();
                            $("#input_" + i).after(val);

                            if (i === 'categoria') {
                                $("#select_categoria").after(val);
                            }

                            if (i === 'tipo_institucion') {
                                $("#select_tipo_institucion").after(val);
                            }

                        });
                    }
                }
            });

        } else {

            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
            $("#input_password2").after(val);
        }


    });


    //
    $("#btn_login_postulantes").on("click", function () {

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
            frm = $("#form_sesion_postulantes");
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

