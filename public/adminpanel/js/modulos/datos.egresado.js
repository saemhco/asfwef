$(document).ready(function () {

    if (region_id !== "") {
        carga_provincia(region_id, provincia_id);
    }

    if (provincia_id !== "") {
        console.log("yes i do");
        carga_distrito(region_id, provincia_id, distrito_id);
    }

    $("#actualizar").on("click", function () {
        frmx = $("#form_alumnos");
        var frm = new FormData(document.getElementById("form_alumnos"));

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


    $("#input-region").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo").val("");
        var html = '<option value="">Provincias</option>';
        $("#input-distrito").html(html);
    });

    $("#input-provincia").on("change", function () {
        $("#input-ubigeo").val("");
        carga_distrito($("#input-region").val(), $(this).val(), 0);
    });

    $("#input-distrito").on("change", function () {
        var c_region = $("#input-region").val();
        var c_provincia = $("#input-provincia").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo").val(concat_name);
    });

    function carga_provincia(idregion, param) {

        $.post(base_url + "btrpublicaciones/getProvincias", {pk: idregion}, function (response) {
            var html = "";
            html = html + '<option value="">Provincias</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                } else {
                    if (val.provincia == param) {

                        html = html + '<option value="' + val.provincia + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.provincia + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input-provincia").html(html);
        }, "json");

    }


//FUncion para cargar distritos
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "btrpublicaciones/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
            var html = "";
            html = html + '<option value="">Distrito</option>';
            $.each(response, function (i, val) {
                if (param == 0) {
                    html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                } else {
                    if (val.distrito == param) {

                        html = html + '<option value="' + val.distrito + '" selected >' + val.descripcion + '</option>';
                    } else {
                        html = html + '<option value="' + val.distrito + '">' + val.descripcion + '</option>';
                    }
                }

            });

            $("#input-distrito").html(html);
        }, "json");

    }

});


//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}