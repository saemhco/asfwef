$(document).ready(function () {

    $("#actualizar-clave").on("click", function () {
        console.log("Testing by Ken Mack");
        var clave = $("#input-usu_clave");
        var clave_nueva = $("#input-usu_clave2");
        var clave_confirm = $("#input-re_password");

        if (clave.val() === "" || clave_nueva.val() === "" || clave_confirm === "") {
            //bootbox.alert("Todos los datos son requeridos");
            $("#campos_vacio_password").dialog("open");
        } else {
            frm = $("#form_usuarios");
            $.ajax({
                url: frm.attr("action"),
                type: 'POST',
                data: frm.serialize(),
                success: function (xr) {
                    var result = xr;
                    if (result.say === "yes")
                    {
                        //bootbox.alert("<strong>Se actualizo su clave exitosamente</strong>");
                        $("#exito_cambio_password").dialog("open");
                        $("#form_usuarios")[0].reset();
                    } else if (result.say === "no_actual") {
                        //bootbox.alert("<strong>" + result.msg + "</strong>");
                        $("#alerta_no_coincide_password_actual").dialog("open");
                        console.log("error");
                    } else if (result.say === "no_nueva") {
                        //bootbox.alert("<strong>" + result.msg + "</strong>");
                        $("#alerta_no_coincide_password").dialog("open");
                        console.log("error");
                    }
                }
            });
        }

    });


    //exito datos guardados
    $("#exito_cambio_password").dialog({
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
                    window.location.href = base_url + "datos/cambiarcontrasenha1";
                }
            }]
    });

    //mensaje campos vacios
    $("#campos_vacio_password").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "datos/cambiarcontrasenha1";
                }
            }]
    });

    //alerta password no coinciden
    $("#alerta_no_coincide_password").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "datos/cambiarcontrasenha1";
                }
            }]
    });

    $("#alerta_no_coincide_password_actual").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "datos/cambiarcontrasenha1";
                }
            }]
    });

});
