$(document).ready(function () {

});

//reporte ficha de matricula
function reporte_ficha_matricula() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reportefichamatricula/" + semestre);

}


function reporte_registro_auxiliar() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteregistroauxiliar/" + semestre);

}

function reporte_carga_lectiva() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reportecargalectiva/" + semestre);

}

//reporte estudiantes sancionados
function reporte_estudiantes_sancionados() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantessancionados/" + semestre);

}


function reporte_reserva_estudiantes() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reportereservaestudiantes/" + semestre);

}

function reporte_estudiantes_no_matriculados() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantesnomatriculados/" + semestre);

}


function reporte_estudiantes_no_matriculados() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantesnomatriculados/" + semestre);

}


function reporte_estudiantes_reprobados_misma_asignatura_2() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantesreprobados2/" + semestre);

}

function reporte_estudiantes_reprobados_misma_asignatura_3() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantesreprobados3/" + semestre);

}

function reporte_estudiantes_reprobados_misma_asignatura_4() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantesreprobados4/" + semestre);

}

function reporte_orden_merito() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteordenmerito/" + semestre);

}

function reporte_orden_merito_acumulado() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteordenmeritoacumulado/" + semestre);

}

function reporte_orden_merito() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteordenmerito/" + semestre);

}

function reporte_orden_merito_invictos() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteordenmeritoinvictos/" + semestre);

}

function reporte_orden_merito_invictos_carrera_profesional() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteordenmeritoinvictoscarreraprofesional/" + semestre);

}

//reporte_ficha_registro
function reporte_ficha_registro() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_ficha_registro").after(val);
}

//reporte_boleta_notas
function reporte_boleta_notas() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_boleta_notas").after(val);
}

//reporte_notas_promedio
function reporte_notas_promedio() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_notas_promedio").after(val);
}

//reporte_nro_alumnos_asigantura
function reporte_nro_alumnos_asigantura() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_nro_alumnos_asigantura").after(val);
}

//reporte_record_academico
function reporte_record_academico() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_record_academico").after(val);
}

//reporte_ficha_registro
function reporte_ficha_registro_docentes() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_ficha_registro_docentes").after(val);
}

//reporte_horarios
function reporte_horarios() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_horarios").after(val);
}

//reporte_cargar_lectiva_alumnos
function reporte_cargar_lectiva_alumnos() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_cargar_lectiva_alumnos").after(val);
}

//reporte_registro_auxiliar
function reporte_registro_auxiliar() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_registro_auxiliar").after(val);
}

//reporte_registro_notas_1
function reporte_registro_notas_1() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_registro_notas_1").after(val);
}

//reporte_registro_notas
function reporte_registro_notas() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_registro_notas").after(val);
}

//reporte_actas_notas_finales
function reporte_actas_notas_finales() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_actas_notas_finales").after(val);
}

//reporte_encuesta_satisfaccion_docente
function reporte_encuesta_satisfaccion_docente() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_encuesta_satisfaccion_docente").after(val);
}

//reporte_encuesta_satisfaccion_docente_a
function reporte_encuesta_satisfaccion_docente_a() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_encuesta_satisfaccion_docente_a").after(val);
}

//reporte_relacion_alumnos_matriculados
function reporte_relacion_alumnos_matriculados() {

    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reporteestudiantesmatriculados/" + semestre);

}

//reporte_relacion_alumnos_matriculados_semestre
function reporte_relacion_alumnos_matriculados_semestre() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_relacion_alumnos_matriculados_semestre").after(val);
}

//reporte_relacion_alumnos_matriculados_dni
function reporte_relacion_alumnos_matriculados_dni() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_relacion_alumnos_matriculados_dni").after(val);
}

//reporte_relacion_alumnos_matriculados_dni_semestre
function reporte_relacion_alumnos_matriculados_dni_semestre() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_relacion_alumnos_matriculados_dni_semestre").after(val);
}

//reporte_relacion_alumnos_ciclo
function reporte_relacion_alumnos_ciclo() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_relacion_alumnos_ciclo").after(val);
}

//reporte_relacion_alumnos_ciclo_semestre
function reporte_relacion_alumnos_ciclo_semestre() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_relacion_alumnos_ciclo_semestre").after(val);
}

//reporte_alumnos_matriculados numero
function reporte_alumnos_matriculados() {
    //console.log("Testing");
    var semestre = $("#semestre").val();
    window.open(base_url + "gestionreportes/reportenroestudiantesmatriculados/" + semestre);
}

//reporte_alumnos_matriculados_semestre
function reporte_alumnos_matriculados_semestre() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_alumnos_matriculados_semestre").after(val);
}

//reporte_alumnos_matriculados_ciclo
function reporte_alumnos_matriculados_ciclo() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_alumnos_matriculados_ciclo").after(val);
}

//reporte_record_academico_general
function reporte_record_academico_general() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_record_academico_general").after(val);
}

//reporte_record_academico_semestre
function reporte_record_academico_semestre() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_record_academico_semestre").after(val);
}

//reporte_orden_merito
function reporte_orden_merito() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_orden_merito").after(val);
}

//reporte_relacion_promedios
function reporte_relacion_promedios() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_relacion_promedios").after(val);
}

//reporte_obu
function reporte_obu() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_obu").after(val);
}

//reporte_seguro_estudiantil
function reporte_seguro_estudiantil() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_seguro_estudiantil").after(val);
}

//reporte_lonche_universitario
function reporte_lonche_universitario() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_lonche_universitario").after(val);
}

//reporte_chekeo_alumnos_matriculados
function reporte_chekeo_alumnos_matriculados() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_chekeo_alumnos_matriculados").after(val);
}

//reporte_carnes_universitarios
function reporte_carnes_universitarios() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_carnes_universitarios").after(val);
}

//reporte_file_alumnos_matriculados
function reporte_file_alumnos_matriculados() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_file_alumnos_matriculados").after(val);
}

//reporte_fondo_agua
function reporte_fondo_agua() {
    //console.log("Testing");
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_fondo_agua").after(val);
}
