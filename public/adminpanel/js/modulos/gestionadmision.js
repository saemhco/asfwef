$(document).ready(function () {

    //modal save
    $("#success").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success' style='color:white;'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
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
                    if (id) {
                        window.location.href = base_url + "gestionadmision/index/" + id;
                    } else {
                        window.location.href = base_url + "gestionadmision/inscripcionfin";
                    }

                }
            }]
    }).prev(".ui-dialog-titlebar").css("background", "#468847");
    ;
    //fin succes

    //modal warning
    $("#warning").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning' style='color:white;'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [
            {
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                    //window.location.href = base_url + "admisionproceso";
                }
            },
            {
                html: "<i class='fa fa-save'></i>&nbsp; Grabar",
                "class": "btn btn-info",
                click: function () {
                    $(this).dialog("close");
                    //window.location.href = base_url + "admisionproceso";
                    //ajax

                    //
                    $(".errorforms").remove();
                    var input_carrera1 = $("#input_carrera1 option:selected").val();
                    var input_carrera2 = $("#input_carrera2 option:selected").val();

                    //console.log('carrera1:' + input_carrera1 + '-' + 'carrera2:' + input_carrera2);

                    if (input_carrera1 === input_carrera2) {
                        var val = '<div class="text-danger errorforms">Seleccione una carrera profesional diferente</div>';
                        $("#input_carrera2").after(val);
                    } else {
                        //

                        frmx = $("#form_admisionproceso");
                        var frm = new FormData(document.getElementById("form_admisionproceso"));
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
                                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                                    //window.location.href = base_url + "noticias";
                                    $("#success").dialog("open");
                                    //CuriositySoundError();

                                } else {
                                    //console.log("llegamos a la disco");
                                    $(".errorforms").remove();

                                    //Mostrar mensaje error del modelo
                                    $.each(result, function (i, val) {
                                        $("#input_" + i).focus();
                                        $("#input_" + i).after(val);




                                    });
                                }
                            }
                        });
                        //
                    }


                }
            }]
    }).prev(".ui-dialog-titlebar").css("background", "#C09853");
    //fin

    //grabar
    $("#save").on("click", function () {

        $("#warning").dialog("open");
        CuriositySoundError();

    });
    //fin

    //validar select carrera1 con carrera2

    //fin




});
