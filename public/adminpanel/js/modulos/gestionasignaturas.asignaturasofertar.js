$(document).ready(function () {
    var sumcreditos = 0;
    var totalasignaturas = 0;

    $('.checkcurso').change(function () {



        if (this.checked) {



            console.log("si");
            totalasignaturas = totalasignaturas + 1;
            var nombre = $("#nombre-" + this.value).text();
            var ciclo = $("#ciclo-" + this.value).text();
            var creditos = $("#creditos-" + this.value).text();
            var tipo = $("#tipo-" + this.value).text();
            var ht = $("#ht-" + this.value).text();
            var hp = $("#hp-" + this.value).text();

            console.log(this.value);
            sumcreditos = sumcreditos + parseInt(creditos);

            var html = "<tr id='row-" + this.value + "'>";
            html += "<td><input type='hidden' name='codigocursos[]' value='" + this.value + "' >" + this.value + "</td>";
            html += "<td>" + nombre + "</td>";
            html += "<td><input type='hidden' name='ciclo[]' value='" + ciclo + "' >" + ciclo + "</td>";
            html += "<td>" + creditos + "</td>";
            html += "<td><input type='hidden' name='tipocursos[]' value='" + tipo + "' >" + tipo + "</td>";
            html += "<td>" + ht + "</td>";
            html += "<td>" + hp + "</td>";
            html += "</tr>";

            $("#cursos-llevar").append(html);
        } else {
            //alert('Testing');
            $("#row-" + this.value).remove();
            totalasignaturas = totalasignaturas - 1;
        }

        $("#totalasig").text(totalasignaturas);

        var result = verificar();
        console.log("result " + result);
        if (result === "si") {
            $(".showme").removeClass("hidden");
        } else {
            $(".showme").addClass("hidden");
        }
    });

    $("#registrar-asignatura-btn").click(function () {
        $.ajax({
            url: base_url + "gestionasignaturas/saveAsignaturasOfertar",
            type: 'POST',
            data: $("#form_asignaturasofertar").serialize(),

            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    //bootbox.alert("<strong>Se registró de manera correcta</strong>")
                    //location.reload();
                    $("#save_asignaturasofertar").dialog("open");
                    CuriositySoundError();


                } else {

                    //bootbox.alert("<strong>Ocurrio algun error</strong>")
                    $("#error_vacio").dialog("open");
                    CuriositySoundError();
                }
            }
        });

    });

    //save 
    $("#save_asignaturasofertar").dialog({
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
                    window.location.href = base_url + "gestionasignaturas/asignaturasofertadas";
                }
            }]
    });

    //error
    $("#error_vacio").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica </h4></div>",
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
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });

});


function verificar() {
    if ($("#totalasig").text() == "0") {
        return "no";
    } else {
        return "si";
    }
}


