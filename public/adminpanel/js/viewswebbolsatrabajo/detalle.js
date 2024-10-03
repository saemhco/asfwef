$(document).ready(function () {


    //formateamos link del menu cargos
    $.ajax({
        type: 'POST',
        url: base_url + "webbolsatrabajo/urlCargos",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                //console.log(i);
                //console.log(val.cargo_id);
                $("#cargo_" + val.codigo).attr("href", base_url + "web-bolsatrabajo/listado.html?cargo=" + val.codigo);
            });
        }
    });



    //formateamos link del menu distritos
    $.ajax({
        type: 'POST',
        url: base_url + "webbolsatrabajo/urlDistritos",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                //console.log(i);
                //console.log(val.ubigeo_id);
                $("#distrito_" + val.ubigeo_id).attr("href", base_url + "web-bolsatrabajo/listado.html?distrito=" + val.ubigeo_id);
            });
        }
    });

    //formateamos link del menu jornada
    $.ajax({
        type: 'POST',
        url: base_url + "webbolsatrabajo/urlJornadas",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                //console.log(i);
                //console.log(val.jornada_id);
                $("#jornada_" + val.codigo).attr("href", base_url + "web-bolsatrabajo/listado.html?jornada=" + val.codigo);
            });
        }
    });


    //formateamos link del menu contrato
    $.ajax({
        type: 'POST',
        url: base_url + "webbolsatrabajo/urlContratos",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                //console.log(i);
                //console.log(val.tc_id);
                $("#contrato_" + val.codigo).attr("href", base_url + "web-bolsatrabajo/listado.html?contrato=" + val.codigo);
            });
        }
    });


    //boton postular
    $("#btn_postular_empleo").on("click", function () {
        //console.log("Testing");
        if ($("#key").val() === 'I') {
            $(".errorforms").hide();
            //alert("Testing");
            frm = $("#form_validarcv");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(), //Agarra todo los campos del formulario y envia como array
                success: function (response) {
                    //alert(response.say);
                    if (response.say === 'no_inicio_sesion') {
                        //aparece modal de registro
                        $("#modal_registro").modal("show");
                    } else if (response.postulo.postulo === 'si') {
                        //error en reserva
                        $("#modal_error_postulacion").modal("show");
                    } else if (response.postulo.postulo === 'no') {
                        //console.log('LLega despues de loguearse: ' + response.postulo.postulo);
                        $("#modal_validarcv").modal("show");

                    }
                }
            });
        } else if ($("#key").val() === 'A') {
            //$("#modal_validarcv").modal("show");
            frm = $("#form_validarcv");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(), //Agarra todo los campos del formulario y envia como array
                success: function (response) {
                    //alert(response.say);
                    // alert(response.postulo.postulo);
                    if (response.say === 'no_inicio_sesion') {
                        //aparece modal de registro
                        $("#modal_registro").modal("show");
                    } else if (response.postulo.postulo === 'si') {
                        //error en reserva
                        //console.log(response.postulo.postulo);
                        $("#modal_error_postulacion").modal("show");
                    } else if (response.postulo.postulo === 'no') {
                        //console.log('llega cuando ya dio reload: ' + response.postulo.postulo);
                        $("#modal_validarcv").modal("show");
                    }
                }
            });
        }
    });

    //login_registro
    $("#entrar_login").on("click", function () {

        //alert($("#input_nro_doc").val());

        $(".errorforms").hide();

        if ($("#input_email").val() === "" || $("#input_password").val() === "") {

            if ($("#input_email").val() === "") {

                var val = '<div class="text-danger errorforms">El campo email es requerido</div>';
                $("#input_email").after(val);

            }

            if ($("#input_password").val() === "") {

                var val = '<div class="text-danger errorforms">El campo contraseña es requerido</div>';
                $("#input_password").after(val);

            }

        } else {

            frm = $("#form_sesion");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(), //Agarra todo los campos del formulario y envia como array
                success: function (response) {
                    //alert(response.say);
                    if (response.say === 'yes') {
                        //Sale modal de confirmacion
                        $("#modal_registro").modal("hide");

                        //$("#usuario_login_webbolsatrabajo").text('Testing');
                        $("#li_usuario_login_webbolsatrabajo").attr("class", "nav-item dropdown");
                        $("#a_usuario_login_webbolsatrabajo").removeAttr("data-scroll");
                        $("#a_usuario_login_webbolsatrabajo").attr("data-toggle", "dropdown");
                        $("#a_usuario_login_webbolsatrabajo").attr("data-hover", "dropdown");
                        $("#a_usuario_login_webbolsatrabajo").attr("rol", "button");
                        $("#a_usuario_login_webbolsatrabajo").attr("aria-haspopup", "true");
                        $("#a_usuario_login_webbolsatrabajo").attr("aria-expanded", "false");
                        $("#a_usuario_login_webbolsatrabajo").attr("data-name", "ecommerce");
                        //nombre del usuario
                        var nombre_usuario = response.nombre_usuario;
                        var codigo_usuario = response.codigo_usuario;

                        //console.log(codigo_usuario);

                        $("#codigo_usuario").val(codigo_usuario);
                        $("#a_usuario_login_webbolsatrabajo").html(nombre_usuario + '<i class="zmdi zmdi-chevron-down"></i>');

                        $("#ul_usuario_login_webbolsatrabajo").attr("style", "display:block");
                        $("#modal_validarcv").modal("show");

                    } else if (response.say === 'password_alumno_incorrecto') {
                        var val = '<div class="text-danger errorforms">La contraseña del estudiante es incorrecta</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'alumno_no_existe') {
                        var val = '<div class="text-danger errorforms">El estudiante no está registrado</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'datos_no_existen') {
                        var val = '<div class="text-danger errorforms">Datos no xisten</div>';
                        $("#input_password").after(val);
                    }
                }
            });
        }
    });

    //reset login  
    $("#btn_postular_empleo").on("click", function () {
        $(".errorforms").hide();
        $("#form_sesion")[0].reset();
        $("#form_validarcv")[0].reset();
        //$("#modal_validarcv").val('');      
    });



    //validacion check
    $("#cv_defecto").on("change", function () {
        $(".errorforms").hide();
        if (this.checked) {
            document.getElementById("cv_nuevo").disabled = true;

            var codigo_usuario = $("#codigo_usuario").val();

            $.ajax({
                type: 'POST',
                url: base_url + "webbolsatrabajo/getcv",
                data: {codigo_usuario: codigo_usuario},
                dataType: 'json',
                success: function (response) {
                    if (response.say === 'no_cv') {
                        $("#cv_defecto").prop("checked", false);

                        var val = '<div class="text-danger errorforms">Usted no tiene registrado un cv, por favor adjunte un cv</div>';
                        $("#div_cv_defecto").after(val);

                        document.getElementById("cv_nuevo").disabled = false;

                    } else if (response.say === 'yes_cv') {

                    }

                }
            });



        } else {
            document.getElementById("cv_nuevo").disabled = false;
        }
    });
    //
    $("#cv_nuevo").on("click", function () {
        //console.log('testing');
        $(".errorforms").hide();
    });

    $("#cv_nuevo").change(function () {
        var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) === -1) {
            //alert("Only formats are allowed : "+fileExtension.join(', '));
            var val = '<div class="text-danger errorforms">Subir su CV en formato pdf</div>';
            $("#div_cv_defecto").after(val);
            $("#cv_nuevo").val('');
        }
    });


    //
    $("#btn_validarcv_aceptar").on("click", function () {
        $(".errorforms").hide();


        if ($("#cv_defecto").is(':checked') || $("#cv_nuevo")[0].files.length !== 0) {




            var frm = new FormData(document.getElementById("form_validarcv"));
            $.ajax({
                type: 'POST',
                url: base_url + "webbolsatrabajo/savecv",
                data: frm,
                beforeSend: function ()
                {
                    //console.log('Mostrar Barra de progreso');
                    $('#barra_progreso').css('display', 'block');

                    //
                    var percentage = 0;

                    var timer = setInterval(function () {
                        percentage = percentage + 20;
                        progress_bar_process(percentage, timer);
                    }, 1000);


                },
                success: function (response) {

                    console.log(response.say);
                    //

                    //
//                    if (response.say === 'yes') {
//                        $("#modal_validarcv").modal("hide");
//                        $("#modal_postulacion_confirmada").modal("show");
//                        //
//
//
//                    } else {
//                        //alert("Debe elegir una opción para poder postular a este empleo");
//                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });

        } else {
            console.log("No hay check ni file");
            var val = '<div class="text-danger errorforms">Debe elegir al menos una opción</div>';
            $("#div_cv_defecto").after(val);

        }

    });


    //function
    function progress_bar_process(percentage, timer) {
        $('.progress-bar').css('width', percentage + '%');
        $('.progress-bar').attr('aria-valuenow', percentage);
        $('.progress-bar').text(percentage+"%");
        if (percentage > 100)
        {
            clearInterval(timer);
            //$('#sample_form')[0].reset();
            $('#barra_progreso').css('display', 'none');
            $('.progress-bar').css('width', '0%');
            $('.progress-bar').attr('aria-valuenow', '0');
            $("#modal_validarcv").modal("hide");
            $("#modal_postulacion_confirmada").modal("show");


        }
    }

});


