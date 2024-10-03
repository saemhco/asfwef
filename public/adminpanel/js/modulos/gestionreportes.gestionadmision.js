$(document).ready(function () {

});

//reporte postulantes

function reporte_general_postulantes() {
    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reportegeneralpostulantes/" + admision);
}

function reporte_modalidad_admision() {
    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reportemodalidadadmision/" + admision);
}

function reporte_estado_proceso() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteestadoproceso/" + admision);

}

//reporte asistentes
function reporte_asistentes_examen() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteasistentesexamen/" + admision);

}


function resultados_examen_admision() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/resultadosexamenadmision/" + admision);

}

// reporte ingresantes
function reporte_ingresantes_admision() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteingresantesadmision/" + admision);

}


function reporte_ingresantes_constancia() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteingresantesconstancia/" + admision);

}

// reporte en excel
function reporte_excel_postulantes() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteexcelpostulantes/" + admision);

}

function reporte_excel_asistentes_examen() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteexcelasistentesexamen/" + admision);

}

function reporte_excel_resultados_examen() {

    var admision = $("#admision").val();
    window.open(base_url + "gestionreportes/reporteexcelresultadosexamen/" + admision);

}
