$(document).ready(function () {

    var sumcreditos = 0;
    var totalasignaturas = 0;


//$("input[type='checkbox'][name='checkcurso']").change(function ()
    $(".checkcurso").change(function () {

        var check_seleccionado = $(this);

        console.log("El grupo es: " + check_seleccionado.attr("name"));
        var nombre_check_seleccionado = check_seleccionado.attr("name");

        if (this.checked) {

            var check_value_seleccionado = $(this).val();


            setchecks(nombre_check_seleccionado, check_value_seleccionado);


            //console.log(numero_grupo);

            //console.log("si");
            totalasignaturas = totalasignaturas + 1;
            var nombre = $("#nombre-" + this.value).text();
            var ciclo = $("#ciclo-" + this.value).text();
            var creditos = $("#creditos-" + this.value).text();
            var tipo = $("#tipo-" + this.value).text();
            var matricula = 1;
            var veces = 1;
            var grupo = $(this).attr("grupo");

            //console.log(grupo);

            //console.log(this.value);

            console.log("Creditos: "+creditos);

            sumcreditos = sumcreditos + parseInt(creditos);


            //for (var i = 0; i <= cicloorden.length; i++) {
            if (ciclo > cicloorden[0]) {
                bootbox.alert("<strong>Debes elegir los Cursos de menor Ciclo como prioridad</strong>")
                $(this).prop('checked', false);
                sumcreditos = sumcreditos - parseInt(creditos);
                totalasignaturas = totalasignaturas - 1;
                return 0;
            } else {
                cicloorden.shift();
                console.log(cicloorden);
            }
            //}

            console.log("Credimax: "+credimax);

            if (sumcreditos > credimax) {
                bootbox.alert("<strong>Excede el número de creditos permitidos</strong>");
                $(this).prop('checked', false);
                sumcreditos = sumcreditos - parseInt(creditos);
                totalasignaturas = totalasignaturas - 1;
                return 0;
            }

            var html = "<tr id='row-" + this.value + "'>";
            html += "<td><input type='hidden' name='codigocursos[]' value='" + this.value + "' >" + this.value + "</td>";
            html += "<td>" + nombre + "</td>";
            html += "<td><input type='hidden' name='ciclo[]' value='" + ciclo + "' >" + ciclo + "</td>";
            html += "<td>" + creditos + "</td>";
            html += "<td><input type='hidden' name='tipocursos[]' value='" + tipo + "' >" + tipo + "</td>";
            html += "<td>" + matricula + "</td>";
            html += "<td>" + veces + "</td>";
            html += "<td><input type='hidden' name='grupos[]' value='" + grupo + "' >" + grupo + "</td>";
            html += "</tr>";

            $("#cursos-llevar").append(html);
        } else {
            var creditos = $("#creditos-" + this.value).text();
            sumcreditos = sumcreditos - parseInt(creditos);
            totalasignaturas = totalasignaturas - 1;
            console.log("no ");
            $("#row-" + this.value).remove();

            //deschequeamos todo
            $("input[name='" + nombre_check_seleccionado + "']:checkbox").attr("disabled", false);
        }

        $("#totalcred").text(sumcreditos);
        $("#totalasig").text(totalasignaturas);

        var result = verificar();
        console.log("result " + result);
        if (result === "si") {
            $(".showme").removeClass("hidden");
        } else {
            $(".showme").addClass("hidden");
        }
    });



    $("#matriculabtn").click(function () {
        $.ajax({
            url: base_url + "matricula/savematricula",
            type: 'POST',

            data: $("#form-matricula").serialize(),

            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert({
                        message: "<strong>Se resgistro correctamente</strong>",
                        callback: function () {
                            location.reload();
                        }
                    });

                } else {

                    bootbox.alert("<strong>Ocurrio algun error</strong>")
                }
            }
        });

    });

});


function verificar() {
    if ($("#totalasig").text() == "0") {
        return "no";
    } else {
        return "si";
    }
}

function setchecks(nombre_check_seleccionado, check_value_seleccionado) {

    $("input[name='" + nombre_check_seleccionado + "']").each(function () {
        var value = $(this).val();

        if (value === check_value_seleccionado) {

            if (this.checked) {
                $(this).prop('checked', true);
            } else {
                $(this).attr("disabled", true);
            }

        } else {
            $(this).prop('checked', false);
        }

    });
}


