$(document).ready(function () {


    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_save");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_save"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());
        //frm.append('texto_complementario', editor.getData());

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
                    //window.location.href = base_url + "personal";
                    //$("#save").dialog("open");
                    //CuriositySoundError();

                    bootbox.alert("<strong>Se actualizó correctamente</strong>", function () {
                        location.reload();
                    });

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    //Mostrar mensaje error del modelo
                    $.each(result, function (i, val) {
                        //console.log(i);

                        $("#input-" + i).focus();
                        $("#input-" + i).after(val);
                    });
                }
            }
        });
    });
});
