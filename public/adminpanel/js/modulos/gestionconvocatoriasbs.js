$(document).ready(function () {

    $("#form_cv").dialog({
        autoOpen: false,
        //height: "auto",
        width: "300px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Resumen Curriculum Vitae</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }, {
                //le agregas  "id","graba" Para validar lo del enter
                html: "<i class='fa fa-download'></i>&nbsp; Descargar", "id": "graba",
                "class": "btn btn-info",
                click: function () {

                    var publico = $("#publico").val();

                    if ($("#input-datos_personales").is(':checked')) {
                        //console.log('1');
                        var datos_personales = "A";
                    } else {
                        //console.log('0');
                        var datos_personales = "I";
                    }

                    //var formacion = $("#input-formacion").val();
                    if ($("#input-formacion").is(':checked')) {
                        //console.log('1');
                        var formacion = "A";
                    } else {
                        //console.log('0');
                        var formacion = "I";
                    }

                    //var capacitaciones = $("#input-capacitaciones").val();
                    if ($("#input-capacitaciones").is(':checked')) {
                        //console.log('1');
                        var capacitaciones = "A";
                    } else {
                        //console.log('0');
                        var capacitaciones = "I";
                    }

                    if ($("#input-experiencia").is(':checked')) {
                        //console.log('1');
                        var experiencia = "A";

                    } else {
                        //console.log('0');
                        var experiencia = "I";
                    }

                    //var experiencia = $("#input-experiencia").val();
                    //console.log("Publico:"+publico);

                    window.open(base_url + "reportes/reporteCurriculumVitaePublico/" + publico + "/" + datos_personales + "/" + formacion + "/" + capacitaciones + "/" + experiencia);
                    $("#form_cv").dialog("close");
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#form_archivos_ganador").dialog({
        autoOpen: false,
        //height: "auto",
        width: "300px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Descarga de archivos</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }, {
                //le agregas  "id","graba" Para validar lo del enter
                html: "<i class='fa fa-download'></i>&nbsp; Descargar", "id": "graba",
                "class": "btn btn-info",
                click: function () {

                    var publico = $("#file_publico").val();

                    if ($("#input-file_datos_personales").is(':checked')) {
                        //console.log('1');
                        var datos_personales = "A";
                        window.open(base_url + "gestionconvocatorias/getArchivosDatosPersonales/" + publico + "/" + datos_personales);
                    }

                    if ($("#input-file_formacion").is(':checked')) {
                        //console.log('1');
                        var formacion = "A";
                        window.open(base_url + "gestionconvocatorias/getArchivosFormacion/" + publico + "/" + formacion);
                    }

                    if ($("#input-file_capacitaciones").is(':checked')) {
                        //console.log('1');
                        var capacitaciones = "A";
                        window.open(base_url + "gestionconvocatorias/getArchivosCapacitaciones/" + publico + "/" + capacitaciones);
                    }

                    if ($("#input-file_experiencia").is(':checked')) {
                        //console.log('1');
                        var experiencia = "A";
                        window.open(base_url + "gestionconvocatorias/getArchivosExperiencia/" + publico + "/" + experiencia);
                    }

                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });
});

function reporte_resumen_ganador(publico) {
    $("#form_cv")[0].reset();
    $("#publico").val(publico);
    $("#form_cv").dialog("open");
}


function archivos_ganador(publico) {
    $("#form_archivos_ganador")[0].reset();
    $("#file_publico").val(publico);
    $("#form_archivos_ganador").dialog("open");
}