$(document).ready(function () {

    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_publico");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_publico"));
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
                if (result.say === "yes") {
                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "personal";
                    //$("#save").dialog("open");
                    //CuriositySoundError();

                    bootbox.alert("<strong>Se actualizó correctamente</strong>", function () {
                        window.location.href = base_url + "gestionconvocatorias/cv3";
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


    $("#input-id_bonificacion").on("change", function () {
        $(".form_datos2").remove();

        var bonificacion = $("#input-id_bonificacion").val();

        $.ajax({
            type: 'POST',
            url: base_url + "gestionconvocatorias/getBonificacion",
            data: { id : id_publico },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);

   

                var archivo_fa = response.archivo_fa;
                var archivo_discapacitado = response.archivo_discapacitado;
                var archivo_dar = response.archivo_dar;
                var archivo_renacyt = response.archivo_renacyt;



                if (bonificacion === "1") {
                    $("#input-archivos").attr("style", "display: none;");

                } else if (bonificacion === "2") {
                    


                    $("#input-archivos").attr("style", "display: block;");
                    $("#label_archivo").text("Discapacidad");
                    $(".archivoFile").attr("name", "archivo_discapacitado");

                    if (archivo_discapacitado === "" || archivo_discapacitado === null) {
                        var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                        $("#input-archivos-file").after(valor);
                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_discapacitado + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivos-file").after(valor);
                    }

                } else if (bonificacion === "3") {

                    $("#input-archivos").attr("style", "display: block;");
                    $("#label_archivo").text("Licenciado Fuerzas Armadas");
                    $(".archivoFile").attr("name", "archivo_fa");

                    if (archivo_fa === "" || archivo_fa === null) {
                        var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                        $("#input-archivos-file").after(valor);
                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_fa + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivos-file").after(valor);
                    }

                } else if (bonificacion === "4") {

                    console.log("Deportista Calificado")

                    $("#input-archivos").attr("style", "display: block;");
                    $("#label_archivo").text("Deportista Calificado");
                    $(".archivoFile").attr("name", "archivo_dar");

                    if (archivo_dar === "" || archivo_dar === null) {
                        var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                        $("#input-archivos-file").after(valor);
                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_dar + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivos-file").after(valor);
                    }

                } else if (bonificacion === "5") {

                    $("#input-archivos").attr("style", "display: block;");
                    $("#label_archivo").text("RENACYT");
                    $(".archivoFile").attr("name", "archivo_renacyt");

                    if (archivo_renacyt === "" || archivo_renacyt === null) {
                        var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                        $("#input-archivos-file").after(valor);
                    } else {

                        var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_renacyt + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                        $("#input-archivos-file").after(valor);
                    }

                }

                $(".errorforms").remove();
            }
        });

    });



    $.ajax({
        type: 'POST',
        url: base_url + "gestionconvocatorias/getdatos2",
        data: { id: id_publico },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);

            console.log(response.id_bonificacion);

            var id_bonificacion = response.id_bonificacion;
            var archivo_fa = response.archivo_fa;
            var archivo_discapacitado = response.archivo_discapacitado;
            var archivo_dar = response.archivo_dar;
            var archivo_renacyt = response.archivo_renacyt;




            if (id_bonificacion === 1) {
                $("#input-archivos").attr("style", "display: none;");

            } else if (id_bonificacion === 2) {

                $("#input-archivos").attr("style", "display: block;");
                $("#label_archivo").text("Discapacidad");
                $(".archivoFile").attr("name", "archivo_discapacitado");

                if (archivo_discapacitado === "" || archivo_discapacitado === null) {
                    var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                    $("#input-archivos-file").after(valor);
                } else {

                    var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_discapacitado + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                    $("#input-archivos-file").after(valor);
                }

            } else if (id_bonificacion === 3) {

                $("#input-archivos").attr("style", "display: block;");
                $("#label_archivo").text("Licenciado Fuerzas Armadas");
                $(".archivoFile").attr("name", "archivo_fa");

                if (archivo_fa === "" || archivo_fa === null) {
                    var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                    $("#input-archivos-file").after(valor);
                } else {

                    var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_fa + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                    $("#input-archivos-file").after(valor);
                }

            } else if (id_bonificacion === 4) {

                $("#input-archivos").attr("style", "display: block;");
                $("#label_archivo").text("Deportista Calificado");
                $(".archivoFile").attr("name", "archivo_dar");

                if (archivo_dar === "" || archivo_dar === null) {
                    var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                    $("#input-archivos-file").after(valor);
                } else {

                    var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_dar + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                    $("#input-archivos-file").after(valor);
                }

            } else if (id_bonificacion === 5) {

                $("#input-archivos").attr("style", "display: block;");
                $("#label_archivo").text("RENACYT");
                $(".archivoFile").attr("name", "archivo_renacyt");

                if (archivo_renacyt === "" || archivo_renacyt === null) {
                    var valor = '<div class="alert alert-warning fade in form_datos2"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                    $("#input-archivos-file").after(valor);
                } else {

                    var valor = '<div class="alert alert-success fade in form_datos2">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/personales/' + archivo_renacyt + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                    $("#input-archivos-file").after(valor);
                }

            }

            $(".errorforms").remove();
        }
    });

});

//mostrar imagen registro
function imagen_registro() {
    $("#modal_registro_imagen").modal("show");
}