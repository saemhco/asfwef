function editarAsistencia(admision, postulante) {

    console.log("Admision:" + admision);
    console.log("Postulante:" + postulante);



    if ($("#asistencia-" + admision + '-' + postulante).is(':checked')) {
        //alert("Esta checkeado");
        var asistencia = 1;
    } else {
        var asistencia = 0;
    }

    $.ajax({
        type: 'POST',
        url: base_url + "gestionsupervisores/editarAsistencia",
        data: { admision: admision, postulante: postulante, asistencia: asistencia },
        dataType: 'json',
        success: function (response) {
            //console.log(response.say);
            if (response.say === "yes") {
                console.log("yes");
            }
        }
    });
}

function editarObservacion(admision, postulante) {

    console.log("Admision:" + admision);
    console.log("Postulante:" + postulante);

    var observaciones_asistencia = $("#observacion-" + admision + '-' + postulante).val();

    $.ajax({
        type: 'POST',
        url: base_url + "gestionsupervisores/editarObservacion",
        data: { admision: admision, postulante: postulante, observaciones_asistencia: observaciones_asistencia },
        dataType: 'json',
        success: function (response) {
            //console.log(response.say);
            if (response.say === "yes") {
                console.log("yes");
            }
        }
    });
}


function exportar() {

    window.open(base_url + "exportar/asistencia/"+id_admision+"/"+id_supervisor);

}




