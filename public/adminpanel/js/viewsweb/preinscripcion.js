$(document).ready(function () {
    
    //alert("Testing");

    //guadar postulante (preinscripcion)
    $("#registrar_postulante_btn").on("click", function () {

        var input_documento = $("#input_documento").val();
        var input_nro_doc = $("#input_nro_doc").val();
        var input_apellidop = $("#input_apellidop").val();
        var input_apellidom = $("#input_apellidom").val();
        var input_sexo = $("#input_sexo").val();
        var datePicker = $("#datePicker").val();
        var input_seguro = $("#input_seguro").val();
        //var input_telefono = $("#input_telefono").val();
        var input_celular = $("#input_celular").val();
        var input_email = $("#input_email").val();
        var input_direccion = $("#input_direccion").val();
        var input_ciudad = $("#input_ciudad").val();
        var input_observaciones = $("#input_observaciones").val();
        var inputFile = $("#inputFile").val();
        var input_colegio_nombre = $("#input_colegio_nombre").val();
        //var input_sitrabaja_nombre = $("#input_sitrabaja_nombre").val();
        //var input_sidepende_nombre = $("#input_sidepende_nombre").val();

        var input_region = $("#input_region").val();
        var input_provincia = $("#input_provincia").val();
        var input_distrito = $("#input_distrito").val();

        var input_region1 = $("#input_region1").val();
        var input_provincia1 = $("#input_provincia1").val();
        var input_distrito1 = $("#input_distrito1").val();

        var input_password = $("#password").val();


        if (input_documento === '0') {
            //alert('Testing');
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar el tipo de documento');
            $("#input_documento").focus().select();
        } else if (input_nro_doc === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar el numero de documento');
            $("#input_nro_doc").focus();
        } else if (input_apellidop === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar apellido paterno');
            $("#input_apellidop").focus();
        } else if (input_apellidom === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar apellido materno');
            $("#input_apellidom").focus();
        } else if (input_sexo === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su sexo');
            $("#input_sexo").focus().select();
        } else if (datePicker === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su fecha de nacimiento');
            $("#datePicker").focus();
        } else if (input_seguro === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su numero de seguro');
            $("#input_seguro").focus();
        } else if (input_celular === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su numero de celular');
            $("#input_celular").focus();
        } else if (input_email === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su email');
            $("#input_email").focus();
        } else if (input_direccion === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su dirección');
            $("#input_direccion").focus();
        } else if (input_ciudad === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su numero de ciudad');
            $("#input_ciudad").focus();
        } else if (input_observaciones === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar el campo observaciones');
            $("#input_observaciones").focus();
        } else if (inputFile === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su foto');
            $("#inputFile").focus();
        } else if (input_colegio_nombre === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar el nombre de su colegio');
            $("#input_colegio_nombre").focus();
        } else if (input_region === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su region de ubigeo');
            $("#input_region").focus().select();
        } else if (input_provincia === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su provincia de ubigeo');
            $("#input_provincia").focus().select();
        } else if (input_distrito === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su distrito de ubigeo');
            $("#input_distrito").focus().select();
        } else if (input_region1 === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su region de lugar de procedencia');
            $("#input_region1").focus().select();
        } else if (input_provincia1 === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su provincia de lugar de procedencia');
            $("#input_provincia1").focus().select();
        } else if (input_distrito1 === '0') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe selecionar su distrito de lugar de procedencia');
            $("#input_distrito1").focus().select();
        } else if (input_password === '') {
            $("#modal_campo_vacio").modal("show");
            $("#modal_campo_vacio .modal-body").text('Debe ingresar su password');
            $("#input_password").focus();
        } else {


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
                    if (result.say === "yes")
                    {


                        //bootbox.alert("<strong>Se registró correctamente</strong>")
                        $("#modal_save_postulante").modal("show");

                        //$("#form_sliders")[0].reset();

                    } else {

                        console.log("Error grabar");
                        $(".errorforms").remove();

                        $.each(result, function (i, val) {

                            $("#input-" + i).focus();
                            $("#input-" + i).closest(".input-group").after(val);

                        });
                    }
                }
            });
        }

    });
    //fin

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

                $(".errorforms").remove();
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

                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });


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

    //select region (lugar de procedencia)
    $("#input_region1_select").on("change", function () {
        carga_provincia_lp($(this).val(), 0);
        //var html = '<option value="">Distrito</option>';
        //$("#input-distrito1").html(html);
    });

    //cara provincia (lugar de procedencia)
    function carga_provincia_lp(idregion, param) {
        console.log("LLega parametro enviado de region: " + param);

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

            $("#input_provincia1_select").html(html).selectpicker('refresh');
        }, "json");

    }

    //select procinvia (lugar de prodecencia)
    $("#input_provincia1_select").on("change", function () {
        $("#input_ubigeo1").val("");
        carga_distrito_lp($("#input_region1_select").val(), $(this).val(), 0);
    });

    //carga dsitrito (lugar de procedencia)
    function carga_distrito_lp(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
            var html = "";
            html = html + '<option value="">SELECCIONE...</option>';
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

            $("#input_distrito1_select").html(html).selectpicker('refresh');
        }, "json");

    }

    //select input lugar de procedencia
    $("#input_distrito1_select").on("change", function () {
        var c_region1 = $("#input_region1_select").val();
        var c_provincia1 = $("#input_provincia1_select").val();
        var c_distrito1 = $(this).val();
        var concat_name = c_region1 + c_provincia1 + c_distrito1;
        $("#input_ubigeo1").val(concat_name);
        $("#input_ubigeo1").attr('readonly', true);
    });





    $("#grabar_postulante").on("click", function () {

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
                    if (result.say === "yes")
                    {


                        //bootbox.alert("<strong>Se registró correctamente</strong>")
                        $("#modal_registro_postulante").modal("hide");

                        $("#modal_save_postulante").modal("show");

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
                                $("#datePicker").after(val);
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
                            } else if (i === 'region1') {
                                $("#select_region1").after(val);
                            } else if (i === 'provincia1') {
                                $("#select_provincia1").after(val);
                            } else if (i === 'distrito1') {
                                $("#select_distrito1").after(val);
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
});


function agregar() {
    //alert('Hola Mundo');
    //Limpia los errores y resetea los valores de los campos
    //error input
    $(".errorforms").hide();
    //$("#input-id").val("");
    //error focus
    $(".error_focus").hide();
    $("#form_registro_postulante")[0].reset();
    //$("#form_registro_postulante").dialog("open");
    $('#modal_registro_postulante').modal('show');
}