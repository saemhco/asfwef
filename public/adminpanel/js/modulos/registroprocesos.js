function admision() {
    bootbox.dialog({
        message: "<strong>¿ Desea inicar el proceso ?</strong>",
        title: "Confirmar",
        buttons: {
            success: {
                label: "Aceptar",
                className: "btn-success",
                callback: function () {
                    $.ajax({
                        url: base_url + "registroprocesos/procesoAdmision",
                        type: 'POST',
                        //data: { "id": id },
                        success: function (msg) {

                            if (msg.say == "yes") {
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                            }
                        }
                    });
                }
            },
            danger: {
                label: "Cancelar",
                className: "btn-danger"
            }
        }
    });
}
