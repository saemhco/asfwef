$(document).ready(function () {
    //alert("Hola mundo");

    //Ambientes
    $("#ambiente").on("change", function () {
        var ac = $(this).val();
        var turno = $("#turno").val();
        window.location.href = base_url + "gestionhorarios/ambientes/"+ac+"/"+turno;
    });

    $("#turno").on("change", function () {
        var ac = $(this).val();
        var ambiente = $("#ambiente").val();
        window.location.href = base_url + "gestionhorarios/ambientes/"+ambiente+"/"+ac;
    });

    //docentes
    $("#docente").on("change", function () {
        var ac = $(this).val();
        var turno = $("#d_turno").val();
        window.location.href = base_url + "gestionhorarios/docentes/"+ac+"/"+turno;
    });

    $("#d_turno").on("change", function () {
        var ac = $(this).val();
        var docente = $("#docente").val();
        window.location.href = base_url + "gestionhorarios/docentes/"+docente+"/"+ac;
    });
      //asignaturas
    $("#asignatura").on("change", function () {
        var ac = $(this).val();
        var turno = $("#a_turno").val();
        window.location.href = base_url + "gestionhorarios/asignaturas/"+ac+"/"+turno;
    });

    $("#a_turno").on("change", function () {
        var ac = $(this).val();
        var asignatura = $("#asignatura").val();
        window.location.href = base_url + "gestionhorarios/asignaturas/"+asignatura+"/"+ac;
    });

    console.log("spiderman esta aqui");

});



