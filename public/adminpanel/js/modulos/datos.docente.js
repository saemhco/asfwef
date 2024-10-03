$(document).ready(function () {


    $("#publicar").on("click", function () {
        frmx = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_docentes"));

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

                    //bootbox.alert("<strong>Se actualizo correctamente</strong>");
                    //location.reload();

                    bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                        location.reload();
                    });
                    
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
    });

});
