$(document).ready(function () {

    //alert('Hola Mundo');
    //valida codigo registrado
    $("#input_codigo").focusout(function () {

        $('#alerta_input_codigo').remove();

        var codigo = $("#input_codigo").val();



        $.ajax({
            type: 'POST',
            url: base_url + "web/colegiadoRegistrado",
            data: {codigo: codigo},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    //alert('El numero de DNI ya esta registrado');

                    $("#input_codigo").after('<p id="alerta_input_codigo" class="error_focus" style="color:red;">El codigo ya esta registrado</div>');

                } else {

                }

                //$(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });


    });
    //fin



    //Select region ubigeo
    $("#input_region_select").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input_ubigeo").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });
    //fin select region

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
    //fin caraga provincias

    //Select provincia ubigeo 
    $("#input_provincia_select").on("change", function () {
        $("#input_ubigeo").val("");
        carga_distrito($("#input_region_select").val(), $(this).val(), 0);
    });
    //fin select provincia

    //carga distritos ubideo
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
    //fin carga distrito

    //carga input ubigeo
    $("#input_distrito_select").on("change", function () {
        var c_region = $("#input_region_select").val();
        var c_provincia = $("#input_provincia_select").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input_ubigeo").val(concat_name);
        $("#input_ubigeo").attr('readonly', true);
    });
    //fin carga ubigeo


    //grabar colegiado
    $("#btn_grabar_colegiados").on("click", function () {

        var input_password = $("#input_password").val();
        //alert(input_password);
        var input_password2 = $("#input_password2").val();

        var input_codigo = $("#input_codigo").val();

        //alert("El codigo es: "+codigo);

        if (input_codigo !== '') {
            if (input_password === input_password2) {

                //alert('Testing');
                frmx = $("#form_registro_colegiados");
                var frm = new FormData(document.getElementById("form_registro_colegiados"));
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
                            $("#modal_registro_colegiados").modal("hide");

                            $("#modal_save_colegiados").modal("show");

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
                                } else if (i === 'region') {
                                    $("#select_region").after(val);
                                } else if (i === 'provincia') {
                                    $("#select_provincia").after(val);
                                } else if (i === 'distrito') {
                                    $("#select_distrito").after(val);
                                } else if (i === 'sexo') {
                                    $("#select_sexo").after(val);
                                } else if (i === 'seguro') {
                                    $("#select_seguro").after(val);
                                } else if (i === 'consejo') {
                                    $("#select_consejo").after(val);
                                } else if (i === 'capitulo') {
                                    $("#select_capitulo").after(val);
                                } else if (i === 'fecha_cip') {
                                    $("#datePicker4").after(val);
                                }



                            });
                        }
                    }
                });

            } else {
                var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
                $("#input_password2").after(val);
            }
        } else {
            var val = '<div class="text-danger errorforms">El campo codigo es requerido</div>';
            $("#input_codigo").after(val);
            $("#input_codigo").focus();
        }




    });
    //fin grabar colegiado

    //login colegiados
    $("#btn_login_colegiados").on("click", function () {

        //limpiar alertas
        $(".errorforms").hide();

        //alert('Testing');
        //
        if ($("#input_codigo_login").val() === "" || $("#input_password_login").val() === "") {

            if ($("#input_codigo_login").val() === "") {
                //alert('campo vacio');
                var val = '<div class="text-danger errorforms">El codigo es requerido</div>';
                $("#input_codigo_login").after(val);

            }
            if ($("#input_password_login").val() === "") {

                var val = '<div class="text-danger errorforms">El campo password es requerido</div>';
                $("#input_password_login").after(val);
            }
        } else {
            //ajax
            frm = $("#form_sesion_colegiados");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (msg) {
                    if (msg.say === "yes") {
                        window.location.href = "panel";
                    } else if (msg.say === "no") {
                        //alert("Credenciales no registradas , intentelo nuevamente");
                        $("#modal_error_login").modal("show");
                        //$("#modal_campo_vacio .modal-body").text('Credenciales no registradas , intentelo nuevamente');
                        //location.reload();
                    } else if (msg.say === 'no_existe') {

                        $("#modal_error_login").modal("show");

                    } else if (msg.say === 'error_csrf') {

                        $("#modal_error_login").modal("show");

                    }
                }
            });
        }
        //
    });
    //fin

    //click moddal error
    $("#btn_error_login_cerrar").on("click", function () {
        location.reload();
    });
    //

    $("#icon_error_login_cerrar").on("click", function () {
        location.reload();
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
    $("#form_registro_colegiados")[0].reset();
    //$("#form_registro_colegiado").dialog("open");
    $('#modal_registro_colegiados').modal('show');
}
