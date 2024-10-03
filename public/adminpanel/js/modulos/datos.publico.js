$(document).ready(function () {


    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_postulantes");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_postulantes"));
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

        $.post(base_url + "web/getProvincias", {pk: idregion}, function (response) {
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

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
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


    //lugar de prodecencia
    if (region1_id !== "") {
        console.log("Region: " + region1_id);
        carga_provincia_lp(region1_id, provincia1_id);
    }



    if (provincia1_id !== "") {
        console.log("Provincia: " + provincia1_id);
        console.log("Distrito: " + distrito1_id);
        //console.log("loading provincia procedencia");
        carga_distrito_lp(region1_id, provincia1_id, distrito1_id);
    }

    //Select region ubigeo
    $("#input-region1").on("change", function () {
        carga_provincia_lp($(this).val(), 0);
        $("#input-ubigeo1").val("");
        //var html = '<option value="">Distritos</option>';
        //$("#input_distrito").html(html);
    });

    //carga provincia ubigeo
    function carga_provincia_lp(idregion, param) {

        $.post(base_url + "web/getProvincias", {pk: idregion}, function (response) {
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

            $("#input-provincia1").html(html);


        }, "json");

    }
    //Select provincia-(ubigeo)
    $("#input-provincia1").on("change", function () {
        $("#input-ubigeo1").val("");
        carga_distrito_lp($("#input-region1").val(), $(this).val(), 0);
    });

    //cara distritos ubideo
    function carga_distrito_lp(idregion, idprov, param) {

        $.post(base_url + "web/getDistritos", {pk: idregion, idprov: idprov}, function (response) {
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

            $("#input-distrito1").html(html);
        }, "json");

    }


    $("#input-distrito1").on("change", function () {
        var c_region = $("#input-region1").val();
        var c_provincia = $("#input-provincia1").val();
        var c_distrito = $(this).val();
        var concat_name = c_region + c_provincia + c_distrito;
        $("#input-ubigeo1").val(concat_name);
    });



});

//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}