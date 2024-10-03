$(document).ready(function () {

    //alert(semestreax);

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_alumnos = $("#tbl_alumnos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionalumnos/datatable/" + semestreax, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "id_alumno", "name": "id_alumno"},
            {"data": "carrera_nombre", "name": "carrera_nombre"},
            {"data": "alumnos_nombre", "name": "alumnos_nombre"},
            {"data": "nro_doc", "name": "nro_doc"},
            {"data": "celular", "name": "celular"},
            {"data": "estado", "name": "estado"}


        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_alumnos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var pk = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_alumno + '" pk2="' + data.semestre + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(pk);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(html_estado);



        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_alumnos').dataTable().fnFilter(this.value);
                }
            });
        }

    });

    //select semestre
    $("#semestre").on("change", function () {
        var sema = $(this).val();
        window.location.href = base_url + "gestionalumnos/index/" + sema;
    });

    //ficha matricula
    $("#btn_update_ficha").on("click", function () {
        //alert('Testing');
        frm = $("#form_ficha");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    // $("#modalnew").modal("hide");
                    $("#modal_rectificar_matricula").modal("hide");
                    bootbox.alert("<strong>Se atualizó correctamente</strong>");



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
    });


    //ficha matricula
    $("#btn_requisitos").on("click", function () {
        //alert('Testing');
        frm = $("#form_requisitos");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    // $("#modalnew").modal("hide");
                    $("#modal_verificar_requisitos").modal("hide");
                    bootbox.alert("<strong>Se atualizó correctamente</strong>");



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
    });

    //agregar asignatura
    $("#agregar_asignatura").on("click", function () {
        //alert("Hola Mundo");
        $(".errorforms").remove();

        if ($("#input_cursos_disponibles option:selected").val() === "0") {

            var val = '<div class="text-danger errorforms">Debe seleccionar al menos una asignatura </div>';
            $("#error_insert_asignaturas").append(val);



        } else {

            var pk_semestre = $("#input_cursos_disponibles option:selected").attr("semestre");
            var pk_asignatura = $("#input_cursos_disponibles option:selected").val();
            var pk_grupo = $("#input_cursos_disponibles option:selected").attr("grupo");
            var pk_alumno = $("#input_cursos_disponibles option:selected").attr("alumno");

            var asignatura = $("#input_cursos_disponibles option:selected").val();
            var ciclo = $("#input_cursos_disponibles option:selected").attr("ciclo");
            var asignatura_nombre = $("#input_cursos_disponibles option:selected").attr("asignatura_nombre");
            var creditos = $("#input_cursos_disponibles option:selected").attr("creditos");
            var tipo = 3;
            var grupo = $("#input_cursos_disponibles option:selected").attr("grupo");
            var veces = 1;

            //var pk_total = pk_semestre + '-' + pk_asignatura + '-' + pk_grupo + '-' + pk_alumno;
            //console.log(pk_total);

            $.ajax({
                url: base_url + "gestionalumnos/getAlumnosAsignaturas",
                type: 'POST',
                data: {"semestre": pk_semestre, "asignatura": pk_asignatura, "grupo": pk_grupo, "alumno": pk_alumno},
                success: function (response) {
                    if (response.say === "yes") {

                        var val = '<div class="text-danger errorforms">Ya se matriculó en esa asignatura</div>';
                        $("#error_insert_asignaturas").append(val);

                    } else {
                        $(".errorforms").remove();

                        $.ajax({
                            url: base_url + "gestionalumnos/saveAlumnosAsignaturas",
                            type: 'POST',
                            data: {"semestre": pk_semestre, "asignatura": pk_asignatura, "grupo": pk_grupo, "alumno": pk_alumno},
                            success: function (response) {
                                if (response.say === "yes") {
                                    var html = "";
                                    html = html + "<tr id='" + pk_semestre + "-" + pk_asignatura + "-" + pk_grupo + "-" + pk_alumno + "'>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'><input type='hidden' name='asignaturas[]' value='" + asignatura + "'>" + asignatura + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'>" + ciclo + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'>" + asignatura_nombre + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'>" + creditos + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'>";

                                    html = html + " <label class='select'>";
                                    html = html + "<select name='tipo_asignatura[]'>";
                                    html = html + seleccionar(tipo);
                                    html = html + "</select> <i></i>";
                                    html = html + "</label>";

                                    html = html + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'><input type='hidden' name='grupos[]'value='" + grupo + "'>" + grupo + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'>" + veces + "</td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminar_asignatura(" + pk_semestre + ",\"" + pk_asignatura + "\"," + pk_grupo + ",\"" + pk_alumno + "\")' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button></td>";
                                    html = html + "</tr>";
                                    $("#tbody_lista_asignaturas").append(html);

                                }
                            }
                        });

                    }
                }
            });
        }

    });

    //reportes
    $("#form_reportes_pdf").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reportes </h4></div>",
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
                html: "<i class='fa fa-save'></i>&nbsp; Grabar", "id": "graba",
                "class": "btn btn-info",
                click: function () {
                    frm = $("#form_reportes_pdf");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_autores').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_reportes_pdf").dialog("close");
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
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    //reportes
    $("#form_reportes_xls").dialog({    
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i>Exportar </h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


});

//editar
function record() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.location.href = base_url + "gestionalumnos/record/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}

function rectificar() {
    if ($(".selrow").is(':checked')) {
        $("#input_cursos_disponibles").val(0);
        var alumno = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;

        window.location.href = base_url + "gestionalumnos/rectificar/" + semestre + "/" + alumno;

    } else {
        errordialogtablecuriosity();
    }
}

function seleccionar(tipo) {
    var html = '';
    $.each(array_test, function (i, val) {

        var selected = (val.codigo === tipo) ? "selected ='selected' " : "";
        html = html + "<option value='" + val.codigo + "' " + selected + " >" + val.nombres + "</option>";

    });
    return html;
}

//restablecer matricula
function restablecer_matricula() {
    if ($(".selrow").is(':checked')) {
        bootbox.confirm({
            message: "<strong>¿Está seguro que desea restablecer el proceso de matrícula?</strong>",
            buttons: {
                confirm: {
                    label: 'Aceptar',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                //console.log('This was logged in the callback: ' + result);
                if (result === true) {
                    var alumno = $('input:radio[name=selrow]:checked').val();
                    var semestre = semestreax;

                    //console.log("Codigo alumno:" + alumno + "- Semestre:" + semestre);

                    //$("#key_semestre").val(semestre);
                    //$("#key_alumno").val(alumno);

                    $.ajax({
                        url: base_url + "gestionalumnos/restablecerMatricula",
                        type: 'POST',
                        data: {"alumno": alumno, "semestre": semestre},
                        success: function (response) {
                            if (response.say === 'yes') {

                                bootbox.alert("<strong>La matrícula se restableció correctamente</strong>");

                            }
                        }
                    });
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function verificar_requisitos() {
    if ($(".selrow").is(':checked')) {
        var alumno = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;

        $("#key_requisitos_semestre").val(semestre);
        $("#key_requisitos_alumno").val(alumno);




        $.ajax({
            type: 'POST',
            url: base_url + "gestionalumnos/getrequisitos",
            data: {semestre: semestre, alumno: alumno},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //$("#input-" + i).val(val);
                    console.log(val.voucher);
//                    if (val.voucher === '1') {
//                        $("#input_voucher").prop("checked", true);
//                    }

                    if (val.registros_academicos === "1") {
                        $("#input_registros_academicos").prop("checked", true);

                    }
                    if (val.servicio_salud === "1") {

                        $("#input_servicio_salud").prop("checked", true);

                    }
                    if (val.servicio_social === "1") {

                        $("#input_servicio_social").prop("checked", true);


                    }
                    if (val.servicio_psicopedagogico === "1") {

                        $("#input_servicio_psicopedagogico").prop("checked", true);

                    }
                    if (val.servicio_deportivo === "1") {

                        $("#input_servicio_deportivo").prop("checked", true);


                    }
                    if (val.servicio_cultural === "1") {
                        $("#input_servicio_cultural").prop("checked", true);
                    }
                    if (val.voucher === "1") {

                        $("#input_voucher").prop("checked", true);

                    }

                    if (val.resolucion_matricula_especial === "1") {

                        $("#input_resolucion_matricula_especial").prop("checked", true);

                    }
                });
                $(".errorforms").remove();
            }, complete: function () {
                $('#modal_verificar_requisitos').modal('show');
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

//convalidacion
function convalidacion_registro() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.location.href = base_url + "gestionalumnos/convalidaciones/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}

//reporte convalidacion
function reporte_convalidacion() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.open(base_url + "reportes/reportealumnoconvalidiaciones/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

//reporte ficha de matricula
function reporte_ficha_matricula() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.open(base_url + "reportes/reportefichamatricula/" + semestre + "/" + xsmart);

    } else {
        errordialogtablecuriosity();
    }
}

//reporte boleta de notas promedio
function reporte_boleta_notas_promedio() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.open(base_url + "reportes/reporteboletanotaspromedio/" + semestre + "/" + xsmart);

    } else {
        errordialogtablecuriosity();
    }
}


//eliminar asignatura
function eliminar_asignatura(semestre, asignatura, grupo, alumno) {
    //console.log('Test');
    bootbox.dialog({
        message: "<strong>¿ Desea Eliminar este registro ?</strong>",
        title: "Confirmar",
        buttons: {
            danger: {
                label: "Cancelar",
                className: "btn-danger"
            },
            success: {
                label: "Aceptar",
                className: "btn-success",
                callback: function () {
                    $.ajax({
                        url: base_url + "gestionalumnos/eliminarAlumnosAsignaturas",
                        type: 'POST',
                        //data: {"id": xsmart},
                        data: {"semestre": semestre, "asignatura": asignatura, "grupo": grupo, "alumno": alumno},
                        success: function (response) {
                            if (response.say === "yes") {
                                $("#" + semestre + "-" + asignatura + "-" + grupo + "-" + alumno).remove();

                            }
                        }
                    });
                }
            }

        }
    });
}

//dettale de alumnos
function detalle_alumnos() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semestre = $("#semestre").val();
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.location.href = base_url + "gestionalumnos/registro/" + semestre + "/" + xsmart;

    } else {
        errordialogtablecuriosity();
    }
}

//
function reporte_ficha_socioeconomica() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        //Agregamos el id del semestre
        //var semes = $("#semestre").val();
        window.open(base_url + "reportes/reportefichasocioeconomica/" + semestre + "/" + xsmart);

    } else {
        errordialogtablecuriosity();
    }
}

//reportes
function reportes() {
    $(".errorforms").hide();
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        //certificado_estudio(xsmart);

        //$("#input-cv").attr("href", "btrpublicaciones/descargacv/" + xsmart);
        $("#form_reportes_pdf").dialog("open");

    } else {
        errordialogtablecuriosity();
    }
}


//reporte_promedio
function reporte_promedio() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_promedio").after(val);
}

//reporte_horario
function reporte_horario() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#reporte_horario").after(val);
}

//constancia_matricula
function constancia_matricula() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_matricula").after(val);
}

//constancia_egresado
function constancia_egresado() {
    $(".errorforms").remove();
    var val = '<div class="text-danger errorforms" style="text-align: center;">El reporte se visualiza en la aplicación de escritorio...</div>';
    $("#constancia_egresado").after(val);
}

//reporte lista de estudiantes
function reporte_lista_estudiantes_pdf() {
    window.open(base_url + "reportes/reportelistaestudiantes");
}

function exportar() {
    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        $("#form_reportes_xls").dialog("open");

    } else {
        errordialogtablecuriosity();
    }

}

function reporte_lista_estudiantes_xls() {
    window.open(base_url + "exportar/reportelistaestudiantes");
}
