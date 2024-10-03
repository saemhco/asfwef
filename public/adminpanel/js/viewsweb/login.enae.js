$(document).ready(function () {

    //alert('Hola Mundo');

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

    //validacion email postulante
    $("#input_email").focusout(function () {

        $('#alert_email').remove();

        var pk_email = $("#input_email").val();



        $.ajax({
            type: 'POST',
            url: base_url + "web/postulanteEmailRegistrado",
            data: { pk_email: pk_email },
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

    //Select region ubigeo
    $("#input_region_select").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input_ubigeo").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia ubigeo
    function carga_provincia(idregion, param) {

        $.post(base_url + "web/getProvincias", { pk: idregion }, function (response) {
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

        $.post(base_url + "web/getDistritos", { pk: idregion, idprov: idprov }, function (response) {
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

        $.post(base_url + "web/getProvincias", { pk: idregion }, function (response) {

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

        $.post(base_url + "web/getDistritos", { pk: idregion, idprov: idprov }, function (response) {
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
                            console.log(i);pdatos/publicoa
                            //console.log(val);
                            $("#input_" + i).focus();
                            $("#input_" + i).after(val);

                            if (i === 'categoria') {
                                $("#select_categoria").after(val);
                            }

                            if (i === 'tipo_institucion') {
                                $("#select_tipo_institucion").after(val);
                            }

                            if (i === 'sexo') {
                                $("#select_sexo").after(val);
                            }



                            if (i === 'id_universidad') {
                                $("#select_universidades").after(val);
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


    $("#input_categoria_select").on("change", function () {
        var categoria = $("#input_categoria_select option:selected").text();
        console.log("Valor: " + categoria);
        if (categoria == 'Interno') {
            $("#input-label_archivo_escuela").text("Constancia de " + categoria);
        } else if (categoria == 'Egresado') {

            $("#input-label_archivo_escuela").text("Constancia de " + categoria);

        } else if (categoria == 'Bachiller') {

            $("#input-label_archivo_escuela").text("Grado Académico " + categoria);

        } else if (categoria == 'Titulado') {

            $("#input-label_archivo_escuela").text("Título Profesional " + categoria);

        }

    });


    // $("#inputFileFoto").change(function () {
    //     console.log("testing");
    //     var foto = $("#inputFileFoto").val();
    //     var extensionesFoto = foto.substring(foto.lastIndexOf("."));
    //     if ((extensionesFoto != '.jpg') && (extensionesFoto != '.jpeg') && (extensionesFoto != '.png')) {
    //         var val = '<div class="text-danger errorforms">Subir foto en formato jpg/jpeg/png</div>';
    //         $("#input_foto").after(val);
    //         $("#btn_grabar_postulantes").prop('disabled', true);
    //     }else{
    //         $("#btn_grabar_postulantes").prop('disabled', false);
    //     }
    // });


    // $("#inputFileArchivo").change(function () {
    //     //$(".errorforms").remove();
    //     console.log("testing");
    //     var foto = $("#input_foto").val();
    //     var extensionesFoto = foto.substring(foto.lastIndexOf("."));
    //     if ((extensionesFoto != '.jpg') && (extensionesFoto != '.jpeg') && (extensionesFoto != '.png')) {
    //         var val = '<div class="text-danger errorforms">Subir foto en formato jpg/jpeg/png</div>';
    //         $("#input_foto").after(val);
    //         $("#btn_grabar_postulantes").prop('disabled', true);
    //     }else{
    //         $(".errorforms").remove();
    //         $("#btn_grabar_postulantes").prop('disabled', false);
    //     }
    // });


    // $("#inputFileArchivoEscuela").change(function () {
    //     //$(".errorforms").remove();
    //     console.log("testing");
    //     var foto = $("#inputFileArchivoEscuela").val();
    //     var extensionesFoto = foto.substring(foto.lastIndexOf("."));
    //     if ((extensionesFoto != '.jpg') && (extensionesFoto != '.jpeg') && (extensionesFoto != '.png')) {
    //         var val = '<div class="text-danger errorforms">Subir foto en formato jpg/jpeg/png</div>';
    //         $("#input_foto").after(val);
    //         $("#btn_grabar_postulantes").prop('disabled', true);
    //     }else{
    //         $(".errorforms").remove();
    //         $("#btn_grabar_postulantes").prop('disabled', false);
    //     }
    // });




    $("#inputFileFoto").on("change", function () {
        $(".errorforms").remove();
        if (this.files[0].size > 2000000) {
            //alert("Please upload file less than 2MB. Thanks!!");
            var val = '<div class="text-danger errorforms">Cargue el archivo de menos de 2 MB. ¡¡Gracias!! </div>';
            $("#input_foto").after(val);
            $(this).val('');
        } else {

            var imagen = $("#inputFileFoto").val();
            var extensiones = imagen.substring(imagen.lastIndexOf("."));
            if ((extensiones != '.jpg') && (extensiones != '.png') && (extensiones != '.jpeg')) {
                $(".errorforms").remove();
                var val = '<div class="text-danger errorforms">El formato del archivo no corresponde...</div>';
                $("#input_foto").after(val);
                $(this).val('');
            }

        }
    });

    $("#inputFileArchivo").on("change", function () {
        $(".errorforms").remove();
        if (this.files[0].size > 2000000) {
            //alert("Please upload file less than 2MB. Thanks!!");
            var val = '<div class="text-danger errorforms">Cargue el archivo de menos de 2 MB. ¡¡Gracias!! </div>';
            $("#input_archivo").after(val);
            $(this).val('');
        } else {

            var archivo = $("#inputFileArchivo").val();
            var extensiones = archivo.substring(archivo.lastIndexOf("."));
            if ((extensiones != '.pdf')) {
                $(".errorforms").remove();
                var val = '<div class="text-danger errorforms">El formato del archivo no corresponde...</div>';
                $("#input_archivo").after(val);
                $(this).val('');
            }

        }
    });

    $("#inputFileArchivoEscuela").on("change", function () {
        $(".errorforms").remove();
        if (this.files[0].size > 2000000) {
            //alert("Please upload file less than 2MB. Thanks!!");
            var val = '<div class="text-danger errorforms">Cargue el archivo de menos de 2 MB. ¡¡Gracias!! </div>';
            $("#input_archivo_escuela").after(val);
            $(this).val('');
        } else {

            var archivoEscuela = $("#inputFileArchivoEscuela").val();
            var extensiones = archivoEscuela.substring(archivoEscuela.lastIndexOf("."));
            if ((extensiones != '.pdf')) {
                $(".errorforms").remove();
                var val = '<div class="text-danger errorforms">El formato del archivo no corresponde...</div>';
                $("#input_archivo_escuela").after(val);
                $(this).val('');
            }

        }
    });


});


function agregar() {
    $(".errorforms").hide();
    $(".error_focus").hide();
    $("#form_registro_postulante")[0].reset();
    //$('#modal_registro_postulante').modal('show');
    $('#modal_warning').modal('show');
}


