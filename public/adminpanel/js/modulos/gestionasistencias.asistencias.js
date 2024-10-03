$(document).ready(function () {





    $(".activax").on("click", function () {
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
        $(this).addClass("active");
        $(".not").attr("disabled", "disabled");
        $("." + item).removeAttr('disabled');


    });

    $(".activ").on("click", function () {
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
        $(this).parent().addClass("active");
        $(".not").attr("disabled", "disabled");
        $("." + item).removeAttr('disabled');
        $(".pp_check").prop("checked", false);
        $(this).parent().find(".pp_check").prop("checked", true);


    });


    $("#semestre").on("change", function () {
        var sema = $(this).val();
        window.location.href = base_url + "gestionasignaturas/index/" + sema;
    });


    $(".not").on("click", function () {
        console.log("nais");

        $(this).focus();

    });


//Exito asistencia
    $("#exito_asistencia").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> Sistema de gestión académica</h4></div>",
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
                    window.location.href = base_url + "gestionasistencias";
                }
            }]
    });


    //Funcion Guardar
    $("#guardar").on("click", function () {

        //alert("Funcion guardar");
        $(".not").removeAttr('disabled');
        frm = $("#form_asistencias");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {



                    //bootbox.alert("<strong>Registro de Asistencia fue guardado con exito</strong>", function () {
                        //window.location.href = base_url + "gestionasistencias";
                    //});

                    $("#exito_asistencia").dialog("open");
                    CuriositySoundError();


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
        $(".not").attr("disabled", "disabled");

    });

    //Funcion confirmar
    $("#confirmar").on("click", function () {

        //alert("Funcion confirmar");
        $(".not").removeAttr('disabled');
        frm = $("#form_asistencias");
        $.ajax({
            url: base_url + "gestionasistencias/confirmarasistencias",
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {

                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "prestamos";

                    bootbox.confirm("<strong>Esta seguro que desea confirmar esta asistencia?</strong>", function (result) {
                        if (result === true) {
                            //console.log(result);
                            window.location.href = base_url + "gestionasistencias";
                        }

                    });


                } else {

                    console.log("llegamos a la disco");
                    //$(".errorforms").remove();


                }
            }
        });
        $(".not").attr("disabled", "disabled");

    });





    $("#error_agregar").dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        title: "<div class='widget-header txt-color-red'><h4><i class='fa fa-warning'></i> Error ! </h4></div>",
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
                "class": "btn btn-danger btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });


});





function agregar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semes = $("#semestre").val();
        window.location.href = base_url + "gestionasignaturas/notas/" + xsmart + "/" + semes;
    } else {
        errordialogtablecuriosity();
    }
}


