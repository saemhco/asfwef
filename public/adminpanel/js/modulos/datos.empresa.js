$(document).ready(function () {

    //exito datos guardados
    $("#success").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [{
                html: "Aceptar",
                "class": "btn btn-success btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "datos/empresa";
                }
            }]
    });


    $("#publicar").on("click", function () {
        $(".errorforms").remove();
        //validar personal registrado
        var ruc = $("#input-ruc").val();
        var estado_registrado = $("#input-estado_registrado").val();

        if (estado_registrado === "") {
            $.ajax({
                type: 'POST',
                url: base_url + "empresas/empresasRegistrado",
                data: {ruc: ruc},
                dataType: 'json',
                success: function (response) {
                    //console.log(response.estado);
                    if (response.say === 'yes') {

                        var val = '<div class="text-danger errorforms">El número de RUC ya está registrado</div>';
                        $("#input-ruc").after(val);
                    } else {
                        frmx = $("#form_empresas");
                        //var datos = $("#form_mantenimientos").serialize();
                        //var datos = $("#form_empresas");
                        var frm = new FormData(document.getElementById("form_empresas"));
                        //datos += "&contenido=" + encodeURIComponent(editor.getData());
                        //frm.append('contenido', editor.getData());

                        $.ajax({
                            url: frmx.attr("action"),
                            type: 'POST',
                            //data: frm.serialize(),
                            data: frm,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (msg) {
                                console.log("Llega cuando es nuevo");
                                var result = msg;
                                if (result.say === "yes")
                                {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "docentes";
//                    });

                                    $("#success").dialog("open");
                                    //CuriositySoundError();


                                } else if (result.say === "error_image") {

                                    var val = '<div class="text-danger errorforms">Extensión de imagen no permitida</div>';
                                    $("#input-imagen").after(val);

                                } else if (result.say === "error_archivo") {

                                    var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                                    $("#input-archivo").after(val);

                                } else if (result.say === "error_archivo_ruc") {

                                    var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                                    $("#input-archivo_ruc").after(val);

                                } else if (result.say === "error_archivo_rnp") {

                                    var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                                    $("#input-archivo_rnp").after(val);

                                } else {
                                    console.log("llegamos a la disco");
                                    $(".errorforms").remove();

                                    $.each(result, function (i, val) {
                                        $("#input-" + i).focus();
                                        $("#input-" + i).after(val);
                                    });
                                }
                            }
                        });
                    }


                }
            });
        } else {
            frmx = $("#form_empresas");
            //var datos = $("#form_mantenimientos").serialize();
            //var datos = $("#form_empresas");
            var frm = new FormData(document.getElementById("form_empresas"));
            //datos += "&contenido=" + encodeURIComponent(editor.getData());
            //frm.append('contenido', editor.getData());

            $.ajax({
                url: frmx.attr("action"),
                type: 'POST',
                //data: frm.serialize(),
                data: frm,
                cache: false,
                contentType: false,
                processData: false,
                success: function (msg) {
                    console.log("Llega");
                    var result = msg;
                    if (result.say === "yes")
                    {
//                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
//                        window.location.href = base_url + "docentes";
//                    });

                        $("#success").dialog("open");
                        //CuriositySoundError();


                    } else if (result.say === "error_image") {

                        var val = '<div class="text-danger errorforms">Extensión de imagen no permitida</div>';
                        $("#input-imagen").after(val);

                    } else if (result.say === "error_archivo") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo").after(val);

                    } else if (result.say === "error_archivo_ruc") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo_ruc").after(val);

                    } else if (result.say === "error_archivo_rnp") {

                        var val = '<div class="text-danger errorforms">Extensión de archivo no permitido</div>';
                        $("#input-archivo_rnp").after(val);

                    } else {
                        console.log("llegamos a la disco");
                        $(".errorforms").remove();

                        $.each(result, function (i, val) {
                            $("#input-" + i).focus();
                            $("#input-" + i).after(val);
                        });
                    }
                }
            });
        }

    });

});

