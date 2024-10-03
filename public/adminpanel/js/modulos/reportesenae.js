$(document).ready(function () {

});

function reporteSegunInstitucion() {

    window.open(base_url + "reportesenae/reporteinstitucion");

}

function reporteParticipantesInternos() {

    window.open(base_url + "reportesenae/reporteParticipantesInternos");

}

function reporteParticipantesEgresados() {

    window.open(base_url + "reportesenae/reporteParticipantesEgresados");

}

function reporteParticipantesBachilleres() {

    window.open(base_url + "reportesenae/reporteParticipantesBachilleres");

}

function reporteParticipantesTitulados() {

    window.open(base_url + "reportesenae/reporteParticipantesTitulados");

}

function exportarInstitucion() {

    window.open(base_url + "exportar/exportarinstitucion");

}

function generarContanciasenae() {

    $.ajax({
        type: 'POST',
        url: base_url + "reportesenae/reporteconstanciasenae",
        //data: {convocatoria: convocatoria},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            if (response.say === "yes") {

                bootbox.alert("<strong>Se registró correctamente</strong>");

            }
            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_autores").dialog("open");
        }
    });

}

