$(document).ready(function () {
    //modal save
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
                if (id) {
                    window.location.href = base_url + "registropostulantesa/inscripcionfin/" + id;
                } else {
                    window.location.href = base_url + "registropostulantesa/inscripcionfin";
                }

            }
        }]
    });
    //fin succes

    $("#waringFiles").dialog({
        autoOpen: false,
        width: 500,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB </h4></div>",
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
                window.location.href = base_url + "datos/publicoa";
            }
        }]
    });

    //modal warning
    $("#warning").dialog({
        autoOpen: false,
        width: 500,
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
                html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
                "class": "btn btn-info",
                click: function () {

                    //
                    if (foto !== "" && archivo !== "" && archivo_escuela !== "") {
                        $(this).dialog("close");

                        $(".errorforms").remove();

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
                                if (result.say === "yes") {

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
                    } else {
                        $("#warning").dialog("close");
                        $("#waringFiles").dialog("open");
                    }
                    //


                }
            }]
    });
    //fin

    //grabar
    $("#save").on("click", function () {
        $(".errorforms").remove();

        var recibo = $("#input_recibo").val();
        var monto = $("#input_monto").val();
        var imagen = $("#file_imagen").val();
        var extensiones = imagen.substring(imagen.lastIndexOf("."));
        if (recibo == "") {
            var val = '<div class="text-danger errorforms">El Nro. de Voucher es requerido</div>';
            $("#input_recibo").after(val);
        }else if(monto == ""){
            var val = '<div class="text-danger errorforms">El Monto Cancelado es requerido</div>';
            $("#input_monto").after(val);
        }else if(((extensiones != '.jpg') && (extensiones != '.png') && (extensiones != '.jpeg'))){
           
            var val = '<div class="text-danger errorforms">Subir voucher en formato jpg, png o jpeg</div>';
            $("#file_imagen").after(val);
        }else{
            $("#warning").dialog("open");

        }

    });
    //fin


    //Validar solo numeros
    $('#input_monto').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    $("#input_monto").keyup(function () {
        $(".errorforms").remove();
        console.log($("#input_monto").val());
        if (parseInt($("#input_monto").val()) >= 110) {

            $("#save").attr("disabled", false);

        } else {

            $("#save").attr("disabled", true);
            var val = '<div class="text-danger errorforms">El monto debe ser mayor</div>';
            $("#input_monto").after(val);

        }
    });



    $("#modal_imagen_tasa_lugar_pago").dialog({
        position: { my: 'top', at: 'top+80' },
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i>Tasas y Lugar de Pago</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#modal_voucher").dialog({
        autoOpen: false,
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Voucher de pago</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-primary",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });



    $("#file_imagen").on("change", function () {
        //console.log("input-index-imagen");
        $("#save").attr("disabled", false);
        $(".errorforms").remove();
        if (this.files[0].size > 2000000) {
            //alert("Please upload file less than 2MB. Thanks!!");
            var val = '<div class="text-danger errorforms">Cargue el archivo de menos de 2 MB. ¡¡Gracias!! </div>';
            $("#input-imagen").after(val);
            $(this).val('');
            $("#save").attr("disabled", true);
        } else {
            
            var imagen = $("#file_imagen").val();
            var extensiones = imagen.substring(imagen.lastIndexOf("."));
            
            if ((extensiones != '.jpg') && (extensiones != '.png') && (extensiones != '.jpeg')) {
                $(".errorforms").remove();
                var val = '<div class="text-danger errorforms">El formato del archivo no corresponde...</div>';
                $("#input-imagen").after(val);
                $(this).val('');
                $("#save").attr("disabled", true);
            }
        }
    });



});



function imagen_tasa_lugar_pago() {
    //console.log("Testing");
    $('#input-lugar_pago').removeAttr('src');
    $("#input-lugar_pago").attr("src", base_url + "adminpanel/imagenes/admision/admision-2021.jpg");
    $("#modal_imagen_tasa_lugar_pago").dialog("open");
}


function modal_voucher() {
    $("#modal_voucher").dialog("open");
}
