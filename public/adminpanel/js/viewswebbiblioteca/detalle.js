$(document).ready(function () {

    //formateamos link del menu categoria
    $.ajax({
        type: 'POST',
        url: base_url + "webbiblioteca/urlCategorias",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                //console.log(i);
                //console.log(val.categoria_id);
                $("#categoria_" + val.codigo).attr("href", base_url + "web-biblioteca/listado.html?categoria=" + val.codigo);
            });
        }
    });

    //formateamos link del menu idioma
    $.ajax({
        type: 'POST',
        url: base_url + "webbiblioteca/urlIdiomas",
        //data: {id: xsmart},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {
                //console.log(i);
                //console.log(val.idioma_id);
                $("#idioma_" + val.codigo).attr("href", base_url + "web-biblioteca/listado.html?idioma=" + val.codigo);
            });
        }
    });

    $("#reservar_libro").on("click", function () {

        //validar sesion
        $.ajax({
            url: base_url + "webbiblioteca/validalogin",
            type: 'POST',
            //data: {"codigo": codigo},
            success: function (response) {

                if (response.sesion === 'si') {
                    //si inicio sesion
                    var id_libro = $("#id_libro").val();
                    var id_ejemplar = $("#id_ejemplar").val();
                    $.ajax({
                        url: base_url + "webbiblioteca/libroactivo",
                        type: 'POST',
                        data: {"id_libro": id_libro, "id_ejemplar": id_ejemplar},
                        success: function (response) {

                            if (response.activo === 1) {
                                $("#modal_confirmar_reserva").modal("show");
                            } else {
                                $("#modal_error_reserva_libro").modal("show");
                            }
                        }
                    });

                } else {
                    //no inicio sesion
                    $(".errorforms").hide();
                    $("#modal_registro").modal("show");

                }
            }
        });
        //fin
    });

    //login_registro
    $("#entrar_login").on("click", function () {

        //alert($("#input_nro_doc").val());
        
        $(".errorforms").hide();

        if ($("#input_tipousuario_select").val() === "" || $("#input_email").val() === "" || $("#input_password").val() === "" || $("#input_nro_doc").val() === "") {

            if ($("#input_tipousuario_select").val() === "") {
                var val = '<div class="text-danger errorforms">El campo tipo de usuario es requerido</div>';
                $("#select_tipo_usuario").after(val);

            }

            if ($("#input_email").val() === "") {

                var val = '<div class="text-danger errorforms">El campo email es requerido</div>';
                $("#input_email").after(val);

            }

            if ($("#input_password").val() === "") {
                var val = '<div class="text-danger errorforms">El campo contraseña es requerido</div>';
                $("#input_password").after(val);

            }
            if ($("#input_nro_doc").val() === "") {
                var val = '<div class="text-danger errorforms">El campo número de documento es requerido</div>';
                $("#input_nro_doc").after(val);
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

                        //$("#usuario_login_webbiblioteca").text('Testing');
                        $("#li_usuario_login_webbiblioteca").attr("class", "nav-item dropdown");
                        $("#a_usuario_login_webbiblioteca").removeAttr("data-scroll");
                        $("#a_usuario_login_webbiblioteca").attr("data-toggle", "dropdown");
                        $("#a_usuario_login_webbiblioteca").attr("data-hover", "dropdown");
                        $("#a_usuario_login_webbiblioteca").attr("rol", "button");
                        $("#a_usuario_login_webbiblioteca").attr("aria-haspopup", "true");
                        $("#a_usuario_login_webbiblioteca").attr("aria-expanded", "false");
                        $("#a_usuario_login_webbiblioteca").attr("data-name", "ecommerce");
                        //nombre del usuario
                        var nombre_usuario = response.nombre_usuario;
                        $("#a_usuario_login_webbiblioteca").html(nombre_usuario + '<i class="zmdi zmdi-chevron-down"></i>');

                        $("#ul_usuario_login_webbiblioteca").attr("style", "display:block");

                        //$("#modal_confirmar_reserva").modal("show");

                        var id_libro = $("#id_libro").val();
                        var id_ejemplar = $("#id_ejemplar").val();

                        $.ajax({
                            url: base_url + "webbiblioteca/libroactivo",
                            type: 'POST',
                            data: {"id_libro": id_libro, "id_ejemplar": id_ejemplar},
                            success: function (response) {

                                if (response.activo === 1) {
                                    $("#modal_confirmar_reserva").modal("show");
                                } else {
                                    $("#modal_error_reserva_libro").modal("show");
                                }
                            }
                        });

                    } else if (response.say === 'password_alumno_incorrecto') {
                        var val = '<div class="text-danger errorforms">La contraseña del estudiante es incorrecta</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'alumno_no_existe') {
                        var val = '<div class="text-danger errorforms">El estudiante no está registrado</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'password_docente_incorrecto') {
                        var val = '<div class="text-danger errorforms">La contraseña del docente es incorrecta</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'docente_no_existe') {
                        var val = '<div class="text-danger errorforms">El docente no está registrado</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'password_administrativo_incorrecto') {
                        var val = '<div class="text-danger errorforms">La contraseña del administrativo es incorrecta</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'administrativo_no_existe') {
                        var val = '<div class="text-danger errorforms">El administrativo no está registrado</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'password_publico_incorrecto') {
                        var val = '<div class="text-danger errorforms">La contraseña de usuario es incorrecta</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'publico_no_existe') {
                        var val = '<div class="text-danger errorforms">El usuario no está registrado</div>';
                        $("#input_password").after(val);
                    } else if (response.say === 'datos_no_existen') {
                        var val = '<div class="text-danger errorforms">Datos no xisten</div>';
                        $("#input_password").after(val);
                    }
                }
            });
        }
    });

    //modal confirmar reserva
    $("#btn_confirmar_aceptar").click(function () {

        $("#modal_confirmar_reserva").modal("hide");

        frm = $("#form_reservar_libro");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(), //Agarra todo los campos del formulario y envia como array
            success: function (msg) {
                var result = msg;

                //Capturamos la variable postulo definida en el array del controlardor 
                //webcontroller
                //console.log(msg);

                if (msg.reservacion.reservo === "si") {
                    $("#modal_reserva_confirmada").modal("show");

                } else {

                    $("#modal_error_reserva").modal("show");

                }

            }
        });

        //$("#modal_reserva_confirmada").modal("hide");

    });

//select tipo de usuario
    $("#input_tipousuario_select").on("change", function () {

        $(".errorforms").hide();

        var publico = $("#input_tipousuario_select").val();

        if (publico !== "5") {
            //alert('Se envia email y se desactiva nro_doc');
            $("#label_change").text("Email:");
            $("#input_nro_doc").attr("id", "input_email");
            $("#input_email").attr("name", "email");
            $("#input_email").attr("type", "email");

        } else if (publico === "5") {
            //alert('Se envia nro_doc y se desactiva email');
            $("#label_change").text("Número de Documento:");
            $("#input_email").attr("id", "input_nro_doc");
            $("#input_nro_doc").attr("name", "nro_doc");
            $("#input_nro_doc").attr("type", "text");

        }

    });

    //

    $("#reservar_libro").on("click", function () {
        $(".errorforms").hide();
        $("#form_sesion")[0].reset();
    });


});


