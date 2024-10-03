$(document).ready(function () {

    //validar solo numeros nro_ruc
    $('#input-nro_doc_ciudadano').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    //validacion al salir del foco nro_ruc
    $("#input-nro_doc_ciudadano").focusout(function () {

        $('.errorforms').remove();
        var nro_doc = $("#input-nro_doc_ciudadano").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/getAjaxCiudadano",
            data: {nro_doc: nro_doc},
            dataType: 'json',
            success: function (response) {
                //console.log(response.say);
                if (response.say === "yes") {

                    $("#input-registro_c").attr("style", "display: none;");

                    //console.log("@kenmack");
                    //console.log(response.persona_natural.codigo);
                    $("#input-codigo_ciudadano").val(response.persona_natural.codigo);
                    $("#input-apellidop_ciudadano").val(response.persona_natural.apellidop);
                    $("#input-apellidom_ciudadano").val(response.persona_natural.apellidom);
                    $("#input-nombres_ciudadano").val(response.persona_natural.nombres);
                    $("#input-telefono_ciudadano").val(response.persona_natural.telefono);
                    $("#input-celular_ciudadano").val(response.persona_natural.celular);
                    $("#input-email_ciudadano").val(response.persona_natural.email);
                    $("#input-direccion_ciudadano").val(response.persona_natural.direccion);

                    $("#input-region_select_ciudadano").val(response.persona_natural.region).change();

                    carga_provincia_ciudadano(response.persona_natural.region, response.persona_natural.provincia);

                    carga_distrito_ciudadano(response.persona_natural.region, response.persona_natural.provincia, response.persona_natural.distrito);


                } else if (response.say === 'no') {
                    $("#form_registro_ciudadano")[0].reset();

                    $("#input-region_select_ciudadano").val('');
                    $("#input-region_select_ciudadano").selectpicker("refresh");

                    $("#input-provincia_select_ciudadano").val('');
                    $("#input-provincia_select_ciudadano").selectpicker("refresh");

                    $("#input-distrito_select_ciudadano").val('');
                    $("#input-distrito_select_ciudadano").selectpicker("refresh");

                    var val = '<div class="text-danger errorforms">usuario no registrado</div>';
                    $("#input-nro_doc_ciudadano").after(val);

                    $("#input-registro_c").attr("style", "display: block;");
                }
            }
        });

    });


    function carga_provincia_ciudadano(idregion, param) {

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

            $("#input-provincia_select_ciudadano").html(html).selectpicker('refresh');


        }, "json");

    }

    function carga_distrito_ciudadano(idregion, idprov, param) {

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

            $("#input-distrito_select_ciudadano").html(html).selectpicker('refresh');
        }, "json");

    }

    //graba persona natural
    $("#btn_graba_ciudadano").on("click", function () {


        if ($("#input-nro_doc_ciudadano").val() !== "") {
            console.log("@graba persona natural");
            frmx = $("#form_registro_ciudadano");
            var frm = new FormData(document.getElementById("form_registro_ciudadano"));
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
                        $("#modal_save_ciudadano .modal-body").text('Mensaje enviado correctamente...');
                        $("#modal_save_ciudadano").modal("show");
                        $("#modal_save_ciudadano").on("hide.bs.modal", function () {
                            window.location.reload();
                        });

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
        } else {
            //console.log("test");
             $('.errorforms').remove();
            var val = '<div class="text-danger errorforms">El campo numero de documento es requerido</div>';
            $("#input-nro_doc_ciudadano").after(val);
        }
    });





    //validar solo numeros ruc
    $('#input-ruc_persona_juridica').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    //validacion al salir del foco nro_ruc
    $("#input-ruc_persona_juridica").focusout(function () {

        $('.errorforms').remove();
        var ruc = $("#input-ruc_persona_juridica").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/getAjaxPersonaJuridica",
            data: {ruc: ruc},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === "yes") {
                    $("#input-registro_pj").attr("style", "display: none;");
                    //console.log("@kenmack");
                    //console.log(response.persona_natural.codigo);
                    $("#input-codigo_persona_juridica").val(response.persona_juridica.id_empresa);
                    $("#input-razon_social_persona_juridica").val(response.persona_juridica.razon_social);
                    $("#input-direccion_persona_juridica").val(response.persona_juridica.direccion);
                    $("#input-email_persona_juridica").val(response.persona_juridica.email);
                    $("#input-telefono_persona_juridica").val(response.persona_juridica.telefono);
                    $("#input-celular_persona_juridica").val(response.persona_juridica.celular);

                    $("#input-region_select_persona_juridica").val(response.persona_juridica.region).change();

                    carga_provincia_personal_juridica(response.persona_juridica.region, response.persona_juridica.provincia);

                    carga_distrito_persona_juridica(response.persona_juridica.region, response.persona_juridica.provincia, response.persona_juridica.distrito);


                } else if (response.say === 'no') {
                    
                    $("#form_registro_persona_juridica")[0].reset();

                    $("#input-region_select_persona_juridica").val('');
                    $("#input-region_select_persona_juridica").selectpicker("refresh");

                    $("#input-provincia_select_persona_juridica").val('');
                    $("#input-provincia_select_persona_juridica").selectpicker("refresh");

                    $("#input-distrito_select_persona_juridica").val('');
                    $("#input-distrito_select_persona_juridica").selectpicker("refresh");
                    
                    var val = '<div class="text-danger errorforms">empresa no registrada</div>';
                    $("#input-ruc_persona_juridica").after(val);
                    $("#input-registro_pj").attr("style", "display: block;");
                }
            }
        });

    });

    function carga_provincia_personal_juridica(idregion, param) {

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

            $("#input-provincia_select_persona_juridica").html(html).selectpicker('refresh');


        }, "json");

    }

    function carga_distrito_persona_juridica(idregion, idprov, param) {

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

            $("#input-distrito_select_persona_juridica").html(html).selectpicker('refresh');
        }, "json");

    }


    //graba persona juridica
    $("#btn_graba_persona_juridica").on("click", function () {
        if ($("#input-ruc_persona_juridica").val() !== "") {
            console.log("@graba persona natural");
            frmx = $("#form_registro_persona_juridica");
            var frm = new FormData(document.getElementById("form_registro_persona_juridica"));
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
                        $("#modal_save_persona_juridica .modal-body").text('Mensaje enviado correctamente...');
                        $("#modal_save_persona_juridica").modal("show");
                        $("#modal_save_persona_juridica").on("hide.bs.modal", function () {
                            window.location.reload();
                        });

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
        } else {
            var val = '<div class="text-danger errorforms">El campo ruc es requerido</div>';
            $("#input-ruc_persona_juridica").after(val);
        }

    });

    //valida solo numeros
    $('#input-nro_doc_c').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    //graba persona natural modal
    $("#btn_grabar_c").on("click", function () {
        $(".errorforms").remove();
        var input_password = $("#input-password_1_c").val();
        //alert(input_password);
        var input_password2 = $("#input-password_2_c").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_ciudadano_nuevo");
            var frm = new FormData(document.getElementById("form_registro_ciudadano_nuevo"));
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


                        $("#modal_registro_ciudadano_nuevo").modal("hide");

                        $("#modal_save_ciudadano .modal-body").text('Se a registrado correctamente. Vuelva ingresar su numero de documento...');
                        $("#modal_save_ciudadano").modal("show");
                        $("#modal_save_ciudadano").on("hide.bs.modal", function () {
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
                            //$("#input-" + i +"_c").focus();
                            $("#input-" + i + "_c").after(val);

                            if (i === 'sexo') {
                                $("#select_sexo_c").after(val);
                            }

                            if (i === 'region') {
                                $("#select_region_c").after(val);
                            }

                            if (i === 'provincia') {
                                $("#select_provincia_c").after(val);
                            }

                            if (i === 'distrito') {
                                $("#select_distrito_c").after(val);
                            }


                            if (i === "password") {

                                $("#input-password_1_c").after(val);
                            }




                        });
                    }
                }
            });

        } else {
            //console.log("Testing");
            $(".errorforms").remove();
            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
            $("#input-password_2_c").after(val);
        }


    });

    //region_select_c
    $("#input-region_select_c").on("change", function () {
        carga_provincia_c($(this).val(), 0);
        $("#input-ubigeo_c").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga_provincia
    function carga_provincia_c(idregion, param) {

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

            $("#input-provincia_select_c").html(html).selectpicker('refresh');


        }, "json");

    }

    //input_provincia_select
    $("#input-provincia_select_c").on("change", function () {
        $("#input-ubigeo_c").val("");
        carga_distrito_c($("#input-region_select_c").val(), $(this).val(), 0);
    });

    //carga_distrito
    function carga_distrito_c(idregion, idprov, param) {

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

            $("#input-distrito_select_c").html(html).selectpicker('refresh');
        }, "json");

    }

    //carga input ubigeo
    $("#input-distrito_select_c").on("change", function () {
        var c_region = $("#input-region_select_c").val();
        var c_provincia = $("#input-provincia_select_c").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo_c").val(concat_name);
        $("#input-ubigeo_c").attr('readonly', true);
    });



    //graba persona juridica modal
    $("#btn_grabar_pj").on("click", function () {
        $(".errorforms").remove();
        var input_password = $("#input-password_1_pj").val();
        //alert(input_password);
        var input_password2 = $("#input-password_2_pj").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_persona_juridica_nuevo");
            var frm = new FormData(document.getElementById("form_registro_persona_juridica_nuevo"));
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


                        $("#modal_registro_persona_juridica_nuevo").modal("hide");

                        $("#modal_save_persona_juridica .modal-body").text('Se a registrado correctamente. Vuelva ingresar su numero de ruc...');
                        $("#modal_save_persona_juridica").modal("show");
                        $("#modal_save_persona_juridica").on("hide.bs.modal", function () {
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
                            //$("#input-" + i +"_c").focus();
                            $("#input-" + i + "_pj").after(val);



                            if (i === 'region') {
                                $("#select_region_pj").after(val);
                            }

                            if (i === 'provincia') {
                                $("#select_provincia_pj").after(val);
                            }

                            if (i === 'distrito') {
                                $("#select_distrito_pj").after(val);
                            }


                            if (i === "password") {

                                $("#input-password_1_pj").after(val);
                            }




                        });
                    }
                }
            });

        } else {
            //console.log("Testing");
            $(".errorforms").remove();
            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
            $("#input-password_2_pj").after(val);
        }


    });

    //region_select_pj
    $("#input-region_select_pj").on("change", function () {
        carga_provincia_pj($(this).val(), 0);
        $("#input-ubigeo_pj").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia pj
    function carga_provincia_pj(idregion, param) {

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

            $("#input-provincia_select_pj").html(html).selectpicker('refresh');


        }, "json");

    }

    //provincia_pj
    $("#input-provincia_select_pj").on("change", function () {
        $("#input-ubigeo_pj").val("");
        carga_distrito_pj($("#input-region_select_pj").val(), $(this).val(), 0);
    });

    function carga_distrito_pj(idregion, idprov, param) {

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

            $("#input-distrito_select_pj").html(html).selectpicker('refresh');
        }, "json");

    }

    //carga input ubigeo
    $("#input-distrito_select_pj").on("change", function () {
        var c_region = $("#input-region_select_pj").val();
        var c_provincia = $("#input-provincia_select_pj").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo_pj").val(concat_name);
        $("#input-ubigeo_pj").attr('readonly', true);
    });



    //-------------------------------inicio persona natural---------------------

    $('#input-ruc_persona_natural').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $("#input-ruc_persona_natural").focusout(function () {

        $('.errorforms').remove();
        var ruc = $("#input-ruc_persona_natural").val();

        $.ajax({
            type: 'POST',
            url: base_url + "web/getAjaxPersonaNatural",
            data: {ruc: ruc},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === "yes") {
                    $("#input-registro_pn").attr("style", "display: none;");
                    //console.log("@kenmack");
                    //console.log(response.persona_natural.codigo);
                    $("#input-codigo_persona_natural").val(response.persona_natural.id_empresa);
                    $("#input-razon_social_persona_natural").val(response.persona_natural.razon_social);
                    $("#input-direccion_persona_natural").val(response.persona_natural.direccion);
                    $("#input-email_persona_natural").val(response.persona_natural.email);
                    $("#input-telefono_persona_natural").val(response.persona_natural.telefono);
                    $("#input-celular_persona_natural").val(response.persona_natural.celular);

                    $("#input-region_select_persona_natural").val(response.persona_natural.region).change();

                    carga_provincia_persona_natural(response.persona_natural.region, response.persona_natural.provincia);

                    carga_distrito_persona_natural(response.persona_natural.region, response.persona_natural.provincia, response.persona_natural.distrito);


                } else if (response.say === 'no') {
                    $("#form_registro_persona_natural")[0].reset();

                    $("#input-region_select_persona_natural").val('');
                    $("#input-region_select_persona_natural").selectpicker("refresh");

                    $("#input-provincia_select_persona_natural").val('');
                    $("#input-provincia_select_persona_natural").selectpicker("refresh");

                    $("#input-distrito_select_persona_natural").val('');
                    $("#input-distrito_select_persona_natural").selectpicker("refresh");

                    var val = '<div class="text-danger errorforms">empresa no registrada</div>';
                    $("#input-ruc_persona_natural").after(val);
                    $("#input-registro_pn").attr("style", "display: block;");
                }
            }
        });

    });



    function carga_provincia_persona_natural(idregion, param) {

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
           
            $("#input-provincia_select_persona_natural").html(html).selectpicker('refresh');


        }, "json");

    }

    function carga_distrito_persona_natural(idregion, idprov, param) {

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
            
           
            $("#input-distrito_select_persona_natural").html(html).selectpicker('refresh');
        }, "json");

    }


    $("#btn_grabar_pn").on("click", function () {
        $(".errorforms").remove();
        var input_password = $("#input-password_1_pn").val();
        //alert(input_password);
        var input_password2 = $("#input-password_2_pn").val();

        if (input_password === input_password2) {

            //alert('Testing');
            frmx = $("#form_registro_persona_natural_nuevo");
            var frm = new FormData(document.getElementById("form_registro_persona_natural_nuevo"));
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


                        $("#modal_registro_persona_natural_nuevo").modal("hide");

                        $("#modal_save_persona_natural .modal-body").text('Se a registrado correctamente. Vuelva ingresar su numero de ruc...');
                        $("#modal_save_persona_natural").modal("show");
                        $("#modal_save_persona_natural").on("hide.bs.modal", function () {
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
                            //$("#input-" + i +"_c").focus();
                            $("#input-" + i + "_pn").after(val);



                            if (i === 'region') {
                                $("#select_region_pn").after(val);
                            }

                            if (i === 'provincia') {
                                $("#select_provincia_pn").after(val);
                            }

                            if (i === 'distrito') {
                                $("#select_distrito_pn").after(val);
                            }


                            if (i === "password") {

                                $("#input-password_1_pn").after(val);
                            }




                        });
                    }
                }
            });

        } else {
            //console.log("Testing");
            $(".errorforms").remove();
            var val = '<div class="text-danger errorforms">Las contraseñas no coinciden</div>';
            $("#input-password_2_pn").after(val);
        }


    });



    //region_select_pj
    $("#input-region_select_pn").on("change", function () {
        carga_provincia_pn($(this).val(), 0);
        $("#input-ubigeo_pn").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });


    //carga provincia pj
    function carga_provincia_pn(idregion, param) {

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

            $("#input-provincia_select_pn").html(html).selectpicker('refresh');


        }, "json");

    }

    $("#input-provincia_select_pn").on("change", function () {
        $("#input-ubigeo_pn").val("");
        carga_distrito_pn($("#input-region_select_pn").val(), $(this).val(), 0);
    });


    function carga_distrito_pn(idregion, idprov, param) {

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

            $("#input-distrito_select_pn").html(html).selectpicker('refresh');
        }, "json");

    }


    $("#input-distrito_select_pn").on("change", function () {
        var c_region = $("#input-region_select_pn").val();
        var c_provincia = $("#input-provincia_select_pn").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo_pn").val(concat_name);
        $("#input-ubigeo_pn").attr('readonly', true);
    });
    
    
    
        $("#btn_graba_persona_natural").on("click", function () {
        if ($("#input-ruc_persona_natural").val() !== "") {
            console.log("@graba persona natural");
            frmx = $("#form_registro_persona_natural");
            var frm = new FormData(document.getElementById("form_registro_persona_natural"));
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
                        $("#modal_save_persona_natural .modal-body").text('Mensaje enviado correctamente...');
                        $("#modal_save_persona_natural").modal("show");
                        $("#modal_save_persona_natural").on("hide.bs.modal", function () {
                            window.location.reload();
                        });

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
        } else {
            var val = '<div class="text-danger errorforms">El campo ruc es requerido</div>';
            $("#input-ruc_persona_natural").after(val);
        }

    });





    //-----------------------------fin persona natural--------------------------
});


function registro_ciudadano() {
    $(".errorforms").hide();
    $("#form_registro_ciudadano_nuevo")[0].reset();
    $("#input-sexo_select_c").selectpicker('refresh');
    $("#input-region_select_c").selectpicker('refresh');
    $("#input-provincia_select_c").selectpicker('refresh');
    $("#input-distrito_select_c").selectpicker('refresh');
    $('#modal_registro_ciudadano_nuevo').modal('show');
}

function registro_persona_juridica() {
    $(".errorforms").hide();
    $("#form_registro_persona_juridica_nuevo")[0].reset();
    $("#input-region_select_pj").selectpicker('refresh');
    $("#input-provincia_select_pj").selectpicker('refresh');
    $("#input-distrito_select_pj").selectpicker('refresh');
    $('#modal_registro_persona_juridica_nuevo').modal('show');
}

function registro_persona_natural() {
    $(".errorforms").hide();
    $("#form_registro_persona_natural_nuevo")[0].reset();
    $("#input-region_select_pn").selectpicker('refresh');
    $("#input-provincia_select_pn").selectpicker('refresh');
    $("#input-distrito_select_pn").selectpicker('refresh');
    $('#modal_registro_persona_natural_nuevo').modal('show');
}