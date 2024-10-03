$(document).ready(function () {
    //ininicar proceso de matricula
    $("#btn_iniciar_proceso_matricula").click(function () {
        bootbox.confirm({
            message: "<strong>¿Desea iniciar el proceso de matrícula ?</strong>",
            buttons: {
                confirm: {
                    label: 'Aceptar',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                //console.log('This was logged in the callback: ' + result);
                if (result === true) {
                    $.ajax({
                        url: base_url + "matricula/saveiniciommatricula",
                        type: 'POST',
                        //data: $("#form-matricula").serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                window.location.href = base_url + "matricula/requisitos";

                            } else {

                                bootbox.alert("<strong>Ocurrio algun error</strong>");
                            }
                        }
                    });
                }
            }
        });
    });
});

