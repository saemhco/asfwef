$(document).ready(function () {

    //alert('Hola Mundo');

    //validacion postulante existente con numero dni
    $("#input_nro_doc").focusout(function () {

        $('#alerta_nro_doc').remove();

        var nro_doc = $("#input_nro_doc").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/postulanteRegistrado",
            data: {nro_doc: nro_doc},
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

    //validacion email postulante
    $("#input_email").focusout(function () {

        $('#alert_email').remove();

        var pk_email = $("#input_email").val();



        $.ajax({
            type: 'POST',
            url: base_url + "web/postulanteEmailRegistrado",
            data: {pk_email: pk_email},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    //alert('El numero de DNI ya esta registrado');

                    $("#input_email").after('<p id="alert_email" class="error_focus" style="color:red;">El email ya está registrado</div>');

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

        //alert('Hola');

        var input_password = $("#input_password").val();
        //alert(input_password);
        var input_password2 = $("#input_password2").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_convocatorias");
            var frm = new FormData(document.getElementById("form_registro_convocatorias"));
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
                        $("#modal_registro_postulante").modal("hide");

                        $("#modal_save_postulante").modal("show");
                        $("#modal_save_postulante").on("hide.bs.modal", function () {
                            //alert('Testing');
                            window.location.href = base_url+"login-convocatorias.html";
                        });

                        //$("#form_sliders")[0].reset();

                    } else {

                        //console.log("Error grabar");
                        $(".errorforms").remove();

                        $.each(result, function (i, val) {
                            console.log(i);
                            //console.log(val);
                            $("#input_" + i).focus();
                            $("#input_" + i).after(val);

                            if (i === 'fecha_nacimiento') {
                                $("#datePicker1").after(val);
                            } else if (i === 'documento') {
                                $("#select_documento").after(val);
                            } else if (i === 'estado_civil') {
                                $("#select_estado_civil").after(val);
                            } else if (i === 'region') {
                                $("#select_region").after(val);
                            } else if (i === 'provincia') {
                                $("#select_provincia").after(val);
                            } else if (i === 'distrito') {
                                $("#select_distrito").after(val);
                            } else if (i === 'sexo') {
                                $("#select_sexo").after(val);
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
    $("#btn_login").on("click", function () {

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
            frm = $("#form_sesion_convocatorias");
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
                    }else if (msg.say === "evaluado") {
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

    //
    $("#btn_cerrar_alerta").on("click", function () {
        location.reload();
    });

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


function agregar() {
    //alert('Hola Mundo');
    //Limpia los errores y resetea los valores de los campos
    //error input
    $(".errorforms").hide();
    //$("#input-id").val("");
    //error focus
    $(".error_focus").hide();
    $("#form_registro_convocatorias")[0].reset();
    //$("#form_registro_convocatorias").dialog("open");
    $('#modal_registro_postulante').modal('show');
}