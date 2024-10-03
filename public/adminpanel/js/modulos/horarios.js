$(document).ready(function () {
    //alert("Hola mundo");

    
    $("#d_turno").on("change", function () {
        var ac = $(this).val();
        var docente = $("#docente").val();
        window.location.href = base_url + "horarios/index/"+ac;
    });
      //asignaturas
   
    console.log("spiderman esta aqui");

});