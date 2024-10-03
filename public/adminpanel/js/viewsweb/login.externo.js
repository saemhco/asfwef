$(document).ready(function () {
    //
    $("#input_tipousuario_select_form_sesion_perfiles").on("change", function () {

        var persona_juridica = $("#input_tipousuario_select_form_sesion_perfiles").val();
        console.log("Es persona juridica:" + persona_juridica);

        if (persona_juridica !== "2") {
            //alert('Se envia email y se desactiva nro_doc');
            $("#label_change").text("Nro. DNI");
            $("#input_ruc_form_sesion_perfiles").attr("id", "input_nro_doc_form_sesion_perfiles");
            $("#input_nro_doc_form_sesion_perfiles").attr("name", "nro_doc");
            $("#input_nro_doc_form_sesion_perfiles").attr("type", "text");
            $('#input_nro_doc_form_sesion_perfiles').attr('placeholder', 'Ingrese su número de DNI:');

        } else if (persona_juridica === "2") {
            //alert('Se envia nro_doc y se desactiva email');
            $("#label_change").text("Nro. RUC");
            $("#input_nro_doc_form_sesion_perfiles").attr("id", "input_ruc_form_sesion_perfiles");
            $("#input_ruc_form_sesion_perfiles").attr("name", "ruc");
            $("#input_ruc_form_sesion_perfiles").attr("style", "font-size: 14px !important;text-align: left;");
            $("#input_ruc_form_sesion_perfiles").attr("type", "text");
            $('#input_ruc_form_sesion_perfiles').attr('placeholder', 'Ingrese su número de RUC:');
        }

    });
    //

    $("#btn_login_perfiles").on("click", function () {

        //limpiar alertas
        $(".errorforms").hide();

        //alert('Testing');
        if ($("#input_tipousuario_select_form_sesion_perfiles").val() === "" || $("#input_nro_doc_form_sesion_perfiles").val() === "" || $("#input_ruc_form_sesion_perfiles").val() === "" || $("#input_password_form_sesion_perfiles").val() === "") {
            if ($("#input_tipousuario_select_form_sesion_perfiles").val() === "") {
                //console.log('Testing');
                var val = '<div class="text-danger errorforms">El campo tipo de usuario es requerido</div>';
                $("#select_tipo_usuario").after(val);

            }

            if ($("#input_nro_doc_form_sesion_perfiles").val() === "") {
                //alert('campo vacio');
                var val = '<div class="text-danger errorforms">El campo número de DNI es requerido</div>';
                $("#input_nro_doc_form_sesion_perfiles").after(val);

            }

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



                        $("#modal_campo_vacio").modal("show");
                        $("#modal_campo_vacio .modal-body").text('Contraseña incorrecta, intentelo nuevamente...');

                        //location.reload();
                    } else if (msg.say === "no_existe") {


                        $("#modal_campo_vacio").modal("show");
                        $("#modal_campo_vacio .modal-body").text('Credenciales no registradas , debe registrarse');

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


    $("#btn_grabar_publico").on("click", function () {

        //alert('Testing');
        $('#alerta_nro_doc').remove();
        $('#alerta_email').remove();

        var input_password = $("#input_password_publico_modal").val();
        //alert(input_password);
        var input_password2 = $("#input_password_publico_repeat_modal").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_publico");
            var frm = new FormData(document.getElementById("form_registro_publico"));
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
                        $("#modal_registro_publico").modal("hide");

                        $("#modal_save_publico").modal("show");
                        $("#modal_save_publico").on("hide.bs.modal", function () {
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

                            if (i === 'sexo') {
                                $("#select_sexo").after(val);
                            }

                            if (i === "nro_doc") {
                                $("#input_nro_doc_modal").after(val);
                            }


                            if (i === "email") {
                                $("#input_email_publico").after(val);
                            }

                            if (i === "password") {

                                $("#input_password_publico_modal").after(val);
                            }




                        });
                    }
                }
            });

        } else {
            //console.log("Testing");
            $(".errorforms").remove();
            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
            $("#input_password_publico_repeat_modal").after(val);
        }


    });


    $("#btn_grabar_empresa").on("click", function () {

        //alert('Testing');
        $('#alerta_nro_ruc').remove();
        $('#alerta_email').remove();

        var input_password = $("#input_password_empresa_modal").val();
        //alert(input_password);
        var input_password2 = $("#input_password_empresa_repeat_modal").val();

        if (input_password === input_password2) {
 $(".errorforms").remove();
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

                    } else if (result.say === "error_archivo_ruc") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo_ruc").after(val);

                    } else if (result.say === "error_archivo_rnp") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo_rnp").after(val);

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

                            if (i === "archivo_ruc") {
                                //input_email_empresa
                                $("#input-archivo_ruc").after(val);
                            }

                            if (i === "archivo_rnp") {
                                //input_email_empresa
                                $("#input-archivo_rnp").after(val);
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

    //
    //Select region ubigeo
    $("#input_region_select").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input_ubigeo").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia ubigeo
    function carga_provincia(idregion, param) {

        $.post(base_url + "web/getProvincias", {pk: idregion}, function (response) {
            var html = "";
            html = html + '<option value="">SELECCIONE...</option>';

            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';

                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.provincia + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                    }
                }

            });
            console.log('Llega');

            $("#input_provincia_select").html(html).selectpicker('refresh');


        }, "json");

    }
    //Select provincia-(ubigeo)
    $("#input_provincia_select").on("change", function () {
        $("#input_ubigeo").val("");
        carga_distrito($("#input_region_select").val(), $(this).val(), 0);
    });

    //cara distritos ubideo
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                } else {
                    if (val.distrito == param) {

                        html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input_distrito_select").html(html).selectpicker('refresh');
        }, "json");

    }

    //carga input ubigeo
    $("#input_distrito_select").on("change", function () {
        var c_region = $("#input_region_select").val();
        var c_provincia = $("#input_provincia_select").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input_ubigeo").val(concat_name);
        $("#input_ubigeo").attr('readonly', true);
    });
});

function registro_publico() {
    $(".errorforms").hide();
    $(".error_focus").hide();
    $("#form_registro_publico")[0].reset();
    $('#modal_registro_publico').modal('show');
}


function registro_empresa() {
    $(".errorforms").hide();
    $(".error_focus").hide();
    $("#form_registro_empresa")[0].reset();
    $('#modal_registro_empresa').modal('show');
}


