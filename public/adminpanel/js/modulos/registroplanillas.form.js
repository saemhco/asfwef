$(document).ready(function () {


    $("#input-periodo").on("change", function () {
        var anio = $("#input-periodo option:selected").text();

        //getInputs(anio)
    });

    var anio_select = $("#input-anio option:selected").attr("anio_select");
    console.log("El anio selecionado: "+anio_select);

    getInputs(anio_select, especifica, fuente_financ);

    if (id !== "") {
        getInputsRubro(anio_select, fuente_financ, rubro);
        getInputsTipoRecurso(anio_select, rubro, tipo_recurso);
    }

    $("#input-fuente_financ").on("change", function () {
        var anio = $("#input-anio option:selected").attr("anio_select");
        var fuente_financ =  $(this).val();
        getInputsRubro(anio, fuente_financ, fuente_financ)
    });

    $("#input-rubro").on("change", function () {
        var anio = $("#input-anio option:selected").attr("anio_select");
        var rubro =  $(this).val();
        getInputsTipoRecurso(anio, rubro, tipo_recurso)
    });

    $("#publicar").on("click", function () {

        $.ajax({
            url: $("#form_planillas").attr("action"),
            type: 'POST',
            data: $("#form_planillas").serialize(),
            dataType: 'json',
            success: function (msg) {
                var result = msg;
                if (result.say === "yes") {



                    bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                        window.location.href = base_url + "registroplanillas";
                    });


                } else {

                    //Mostrar mensaje error del modelo
                    $.each(result, function (i, val) {
                        $("#input-" + i).focus();
                        $("#input-" + i).after(val);
                    });
                }
            }
        });
    });

    // $('#input-especifica').val("0");

    $('#input-especifica').select2({
        dropdownParent: $('#form_planillas')
    });


    // $('#input-fecha_inicio').val("");
    // $('#input-fecha_fin').val("")



    $("#input-periodo").on("change", function () {
        var f_i = $("#input-periodo option:selected").attr("fecha_inicio");
        var f_f = $("#input-periodo option:selected").attr("fecha_fin");

        var fecha_inicio = moment(f_i, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
        var fecha_fin = moment(f_f, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');


        $('#input-fecha_inicio').val(fecha_inicio);
        $('#input-fecha_fin').val(fecha_fin)
    });



});


function getInputs(anio, especifica, fuente_financ) {

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/opcionesEspecifica",
        data: { anio: anio },
        dataType: 'json',
        success: function (response) {
            var select = '<option value=""> -- SELECCIONE -- </option>';
            $.each(response, function (i, val) {

                valida = val.tipo_transaccion + val.generica + val.subgenerica + val.subgenerica_det + val.especifica + val.especifica_det;

                if (especifica == valida) {
                    console.log("valida: "+valida);
                    console.log("especifica:"+especifica);
                    console.log("llega a seleccionar");
                    select = select + "<option value='" + valida + "' selected='selected' >" + valida + " - " + val.descripcion + "</option>";
                } else {
                    select = select + "<option value='" + valida + "' >" + valida + " - " + val.descripcion + "</option>";
                }
            });
            //console.log(select);
            $("#input-especifica").html(select).select2({
                dropdownParent: $('#form_planillas')
            });
        }, complete: function () {
            //console.log("Cargamos Opciones meta");
        }
    })

    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/opcionesFuentefinanciamiento",
        data: { anio: anio },
        dataType: 'json',
        success: function (response) {
            var select = '<option value=""> -- SELECCIONE -- </option>';
            $.each(response, function (i, val) {
                if (fuente_financ == val.codigo) {
                    select = select + "<option value='" + val.codigo + "' selected='selected' >" + val.codigo + " - " + val.ftefto + "</option>";
                } else {
                    select = select + "<option value='" + val.codigo + "' >" + val.codigo + " - " + val.ftefto + "</option>";
                }

            });
            $("#input-fuente_financ").html(select);
        }, complete: function () {
            //console.log("Cargamos Opciones meta");
        }
    })


}

function getInputsRubro(anio, fuente_financ, rubro) {
    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/opcionesRubro",
        data: { anio: anio, fuente_financ: fuente_financ },
        dataType: 'json',
        success: function (response) {
            var select = '<option value=""> -- SELECCIONE -- </option>';
            $.each(response, function (i, val) {
                if (rubro == val.rubro) {
                    console.log("rubro:" + val.rubro);
                    select = select + "<option value='" + val.rubro + "' selected='selected' >" + val.rubro + " - " + val.nombre + "</option>";
                } else {
                    console.log("rubro2:" + val.rubro);
                    select = select + "<option value='" + val.rubro + "' >" + val.rubro + " - " + val.nombre + "</option>";
                }

            });
            $("#input-rubro").html(select);
        }, complete: function () {
            //console.log("Cargamos Opciones meta");
        }
    })
}

function getInputsTipoRecurso(anio, rubro, tipo_recurso) {
    $.ajax({
        type: 'POST',
        url: base_url + "registroplanillas/opcionesTipoRecurso",
        data: { anio: anio, rubro: rubro },
        dataType: 'json',
        success: function (response) {
            var select = '<option value=""> -- SELECCIONE -- </option>';
            $.each(response, function (i, val) {
                if (tipo_recurso == val.tipo_recurso) {
                    select = select + "<option value='" + val.tipo_recurso + "' selected='selected' >" + val.tipo_recurso + " - " + val.nombre + "</option>";

                } else {
                    select = select + "<option value='" + val.tipo_recurso + "' >" + val.tipo_recurso + " - " + val.nombre + "</option>";
                }
            });
            $("#input-tipo_recurso").html(select);
        }, complete: function () {
            //console.log("Cargamos Opciones meta");
        }
    })
}


