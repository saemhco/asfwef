$(document).ready(function () {
    //Publicar form
    $("#publicar").on("click", function () {
        //console.log("Testing");
        $(".errorforms").remove();
        frmx = $("#form_publico");
        var frm = new FormData(document.getElementById("form_publico"));
        $.ajax({
            url: frmx.attr("action"),
            type: 'POST',
            data: frm,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                var result = msg;
                if (result.say === "yes") {
                    bootbox.alert("<strong>Se actualizó correctamente</strong>", function () {
                        window.location.href = base_url + "registrocv";
                    });

                } else if(result.say === "error_archivo_dni"){
                    var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
                    $("#warning_dni").after(val);
                }else if(result.say === "error_archivo_ruc"){
                    var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
                    $("#warning_ruc").after(val);
                }else if(result.say === "error_archivo_cp"){
                    var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
                    $("#warning_cp").after(val);
                }else if(result.say === "error_archivo_dc"){
                    var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
                    $("#warning_dc").after(val);
                }else if(result.say === "error_imagen"){
                    var val = '<div class="text-danger errorforms">El archivo no debe ser mayor a 1MB</div>';
                    $("#warning_imagen").after(val);
                }else {
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

    //
    if (region_id !== "") {
        carga_provincia(region_id, provincia_id);
    }

    if (provincia_id !== "") {
        //console.log("loading provincia ubigeo");
        carga_distrito(region_id, provincia_id, distrito_id);
    }


    //Select region ubigeo
    $("#input-region").on("change", function () {
        carga_provincia($(this).val(), 0);
        $("#input-ubigeo").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia ubigeo
    function carga_provincia(idregion, param) {

        $.post(base_url + "web/getProvincias", { pk: idregion }, function (response) {
            var html = "";
            html = html + '<option value="">SELECCIONE...</option>';

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
            console.log('Llega');

            $("#input-provincia").html(html);


        }, "json");

    }
    //Select provincia-(ubigeo)
    $("#input-provincia").on("change", function () {
        $("#input-ubigeo").val("");
        carga_distrito($("#input-region").val(), $(this).val(), 0);
    });

    //cara distritos ubideo
    function carga_distrito(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", { pk: idregion, idprov: idprov }, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';
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


    $("#input-distrito").on("change", function () {
        var c_region = $("#input-region").val();
        var c_provincia = $("#input-provincia").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo").val(concat_name);
    });

});

//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}