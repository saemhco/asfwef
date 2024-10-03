$(document).ready(function () {

    //alert(codigo + '-' + semestre);

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_asignaturasofertadas = $("#tbl_asignaturasofertadas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionasignaturas/datatableRegistro/" + codigo + "/" + semestre, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            {"data": "grupo", "name": "grupo"},
            {"data": "subgrupo", "name": "subgrupo"},            
            {"data": "actividad_nombre", "name": "actividad_nombre"},
            {"data": "modalidad_nombre", "name": "modalidad_nombre"},
            {"data": "nombre_docente", "name": "nombre_docente"},
            {"data": "subnro", "name": "subnro"},
            {"data": "observacion", "name": "observacion"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_asignaturasofertadas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            //console.log(data.docente);

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.semestre + '" pk2="' + data.asignatura + '" pk3="' + data.grupo + '" pk4="' + data.subgrupo + '" pk5="' + data.docente + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);


//console.log(data.docente);


            var html_grupos = "";
            html_grupos = "<button type='button'  class='btn btn-xs btn-primary' data-toggle='modal' data-target='#modal_agregar_horario' onclick='agregar(" + data.semestre + ",\"" + data.asignatura + "\"," + data.grupo + ",\"" + data.subgrupo + "\"," + data.docente + ");'><i class='fa fa-edit'></i></button>";
            $('td', row).eq(8).html(html_grupos);


        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_asignaturasofertadas').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    $("#registrar_horario").on("click", function () {
        //alert('Testing');
        frm = $("#form_horarios");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    // $("#modalnew").modal("hide");
                    $("#modal_agregar_horario").modal("hide");
                    bootbox.alert("<strong>Se registró correctamente</strong>");


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




    //agregar horario table
    $("#agregar_horario").on("click", function () {
        $(".errorforms").remove();

        if ($("#input-ambiente option:selected").val() === "0" || $("#input-dia option:selected").val() === "0" || $("#input-hora option:selected").val() === "0") {

            if ($("#input-ambiente option:selected").val() === "0") {
                //console.log('Testing');
                var val = '<div class="text-danger errorforms">Debe seleccionar un Ambiente/ Dia / Hora </div>';
                $("#error_insert").append(val);

            } else if ($("#input-dia option:selected").val() === "0") {
                //console.log('Testing');
                var val = '<div class="text-danger errorforms">Debe seleccionar un Ambiente/ Dia / Hora </div>';
                $("#error_insert").append(val);

            } else if ($("#input-hora option:selected").val() === "0") {
                //console.log('Testing');
                var val = '<div class="text-danger errorforms">Debe seleccionar un Ambiente/ Dia / Hora </div>';
                $("#error_insert").append(val);

            } else {
                var val = '<div class="text-danger errorforms">Debe seleccionar un Ambiente/ Dia / Hora </div>';
                $("#error_insert").append(val);
            }



        } else {



            var ambiente = $("#input-ambiente option:selected").attr("ambiente");
            var dia = $("#input-dia option:selected").attr("dia");
            var hora = $("#input-hora option:selected").attr("hora");

            var pk_semestre = $("#post_semestre").val();
            var pk_ambiente = $("#input-ambiente option:selected").val();
            var pk_dia = $("#input-dia option:selected").val();
            var pk_hora = $("#input-hora option:selected").val();
            var pk_asignatura = $("#post_asignatura").val();
            var pk_grupo = $("#post_grupo").val();
            var pk_subgrupo = $("#post_subgrupo").val();
            var pk_docente = $("#post_docente").val();
            console.log("Codigo del docente: " + pk_docente);
            //var pk_total = pk_semestre + '-' + pk_ambiente + '-' + pk_dia + '-' + pk_hora;
            //console.log(pk_total);


            //validar docente
            $.ajax({
                url: base_url + "gestionasignaturas/getDocenteHorario",
                type: 'POST',
                data: {"dia": pk_dia, "hora": pk_hora, "docente": pk_docente},
                success: function (response) {
                    if (response.say === "yes") {

                        var val = '<div class="text-danger errorforms">Docente tiene asignado la asignatura: ' + response.asignatura + ' en este horario...</div>';
                        $("#error_insert").append(val);

                    } else if (response.say === "no") {


                        //segunda validacion
                        $.ajax({
                            url: base_url + "gestionasignaturas/getRegistroHorario",
                            type: 'POST',
                            data: {"semestre": pk_semestre, "ambiente": pk_ambiente, "dia": pk_dia, "hora": pk_hora},
                            success: function (response) {
                                if (response.say === "yes") {

                                    var codigo_asignatura = response.codigo_asignatura;
                                    var nombre_asignatura = response.nombre_asignatura;
                                    var grupo = response.grupo;
                                    var subgrupo = response.subgrupo;



                                    var val = '<div class="text-danger errorforms">Existe un registro en el horario:' + codigo_asignatura + '-' + nombre_asignatura + '- GRUPO:' + grupo + '- SUB GRUPO:' + subgrupo + '</div>';
                                    $("#error_insert").append(val);

                                } else {
                                    $(".errorforms").remove();


                                    $.ajax({
                                        url: base_url + "gestionasignaturas/saveGestionHorarios",
                                        type: 'POST',
                                        data: {"semestre": pk_semestre, "ambiente": pk_ambiente, "dia": pk_dia, "hora": pk_hora, "asignatura": pk_asignatura, "grupo": pk_grupo, "subgrupo": pk_subgrupo},
                                        success: function (response) {
                                            if (response.say === "yes") {

                                                var html = "";
                                                html = html + "<tr id='" + pk_semestre + "-" + pk_ambiente + "-" + pk_dia + "-" + pk_hora + "'>";
                                                html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + ambiente + "</strong></td>";
                                                html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + dia + "</strong></td>";
                                                html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + hora + "</strong></td>";
                                                html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminar_horario(" + pk_semestre + "," + pk_ambiente + "," + pk_dia + "," + pk_hora + ")' class='btn btn-xs btn-danger cargacr'><i class='fa fa-trash'></i></button></td>";
                                                html = html + "</tr>";
                                                $("#tbody_horarios").append(html);

                                            }
                                        }
                                    });

                                }
                            }
                        });
                        //
                    }
                }
            });
            //

        }

    });


    //edit
    $("#form_registro").dialog({
        autoOpen: false,
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 1000,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro </h4></div>",
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
                    frmx = $("#form_registro");
                    var frm = new FormData(this);//Trae archivos del formulario

                    $.ajax({
                        url: frmx.attr("action"),
                        type: 'POST',
                        //data: frm.serialize(),
                        data: frm,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                //$('#tbl_asignaturasofertadas').dataTable().fnDraw();

                                $("#form_registro").dialog("close");

                                //bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                                //window.location.href = base_url + "alumnos";
                                //});

                                bootbox.alert({
                                    message: "<strong>Se resgistro correctamente</strong>",
                                    callback: function () {
                                        //location.reload();
                                        $('#tbl_asignaturasofertadas').dataTable().fnDraw();
                                    }
                                });

                            } else {
                                console.log("llegamos a la disco");
                                $(".errorforms").remove();

                                $.each(result, function (i, val) {
                                    $("#input_" + i).focus();
                                    $("#input_" + i).after(val);
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


    //agregar carrera
    $("#agregar_carreras").on("click", function () {
        $(".errorforms").remove();

        if ($("#input_carreras option:selected").val() === "0") {

            var val = '<div class="text-danger errorforms">Debe seleccionar una Carrera </div>';
            $("#error_insert_carrera").append(val);



        } else {


            var carrera = $("#input_carreras option:selected").attr("carrera");
            //console.log(carrera);
            var pk_semestre = $("#modal_a_s_c_semestre").val();
            var pk_asignatura = $("#modal_a_s_c_asignatura").val();
            var pk_grupo = $("#modal_a_s_c_grupo").val();
            var pk_carrera = $("#input_carreras option:selected").val();


            //var pk_total = pk_semestre + '-' + pk_ambiente + '-' + pk_dia + '-' + pk_hora;
            //console.log(pk_total);

            $.ajax({
                url: base_url + "gestionasignaturas/getAsignaturasSemestreCarreras",
                type: 'POST',
                data: {"semestre": pk_semestre, "asignatura": pk_asignatura, "grupo": pk_grupo, "carrera": pk_carrera},
                success: function (response) {
                    if (response.say === "yes") {

                        var carrera_response = response.carrera;
                        var carrera_grupo = response.grupo;


                        var val = '<div class="text-danger errorforms">Ya se registro la carrera profesional :' + carrera_response + "- Grupo:" + carrera_grupo + '</div>';
                        $("#error_insert_carrera").append(val);

                    } else {
                        $(".errorforms").remove();


                        $.ajax({
                            url: base_url + "gestionasignaturas/saveAsignaturasSemestreCarreras",
                            type: 'POST',
                            data: {"semestre": pk_semestre, "asignatura": pk_asignatura, "grupo": pk_grupo, "carrera": pk_carrera},
                            success: function (response) {
                                if (response.say === "yes") {

                                    var html = "";
                                    html = html + "<tr id='" + pk_semestre + "-" + pk_asignatura + "-" + pk_grupo + "-" + pk_carrera + "'>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + carrera + "</strong></td>";
                                    html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminar_carrera(" + pk_semestre + ",\"" + pk_asignatura + "\"," + pk_grupo + ",\"" + pk_carrera + "\")' class='btn btn-xs btn-danger cargacr'><i class='fa fa-trash'></i></button></td>";
                                    html = html + "</tr>";
                                    $("#tbody_carreras").append(html);

                                }
                            }
                        });

                    }
                }
            });
        }

    });


});

function agregar(semestre, codigo, grupo, subgrupo, docente) {
    $(".errorforms").remove();
    //reset selects
    $("#input-ambiente").val("0");
    $("#input-dia").val("0");
    $("#input-hora").val("0");


    $("#m_codigo").text(codigo);
    $("#m_grupo").text(grupo);
    $("#m_subgrupo").text(subgrupo);


    $("#post_asignatura").val(codigo);
    $("#post_grupo").val(grupo);
    $("#post_subgrupo").val(subgrupo);

    //console.log("Docente llega:" + docente);
    $("#post_docente").val(docente);


    //console.log("Semestre:" + semestre + " - Codigo:" + codigo + " - Grupo:" + grupo + " - SubGrupo:" + subgrupo + " - Modalidad:" + modalidad + " - " + modalidad_nombre);

    $.post(base_url + "gestionasignaturas/getTableModal", {semestre: semestre, asignatura: codigo, grupo: grupo, subgrupo: subgrupo}, function (response) {
        var html = "";
        //html = html + '<option value="">Provincias</option>';
        $.each(response, function (i, val) {

            html = html + "<tr id='" + val.pk_semestre + "-" + val.pk_ambiente + "-" + val.pk_dia + "-" + val.pk_hora + "'>";
            html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.ambiente + "</strong></td>";
            html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.dia + "</strong></td>";
            html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.hora + "</strong></td>";
            html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminar_horario(" + val.pk_semestre + "," + val.pk_ambiente + "," + val.pk_dia + "," + val.pk_hora + ")' class='btn btn-xs btn-danger cargacr'><i class='fa fa-trash'></i></button></td>";
            html = html + "</tr>";

        });

        $("#tbody_horarios").html(html);
    }, "json");


}


function eliminar_horario(semestre, ambiente, dia, hora) {
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
                        url: base_url + "gestionasignaturas/eliminarHorario",
                        type: 'POST',
                        //data: {"id": xsmart},
                        data: {"semestre": semestre, "ambiente": ambiente, "dia": dia, "hora": hora},
                        success: function (response) {
                            if (response.say === "yes") {
                                $("#" + semestre + "-" + ambiente + "-" + dia + "-" + hora).remove();
                            }
                        }
                    });
                }
            }

        }
    });
}

function nuevo() {
    $("#form_registro")[0].reset();
    if ($(".selrow").is(':checked')) {
        var semestre = $('input:radio[name=selrow]:checked').val();
        var asignatura = $('input:radio[name=selrow]:checked').attr('pk2');
        var grupo = $('input:radio[name=selrow]:checked').attr('pk3');
        var docente = $('input:radio[name=selrow]:checked').attr('pk5');

        //console.log("docente:" + docente);

        //var subgrupo = $('input:radio[name=selrow]:checked').attr('pk4');
        $.ajax({
            type: 'POST',
            url: base_url + "gestionasignaturas/getNew",
            data: {semestre: semestre, asignatura: asignatura, grupo: grupo},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'yes') {


                    $("#modal_post_subgrupo").attr('value', response.subgrupo);
                    $("#modal_subgrupo").text(response.subgrupo);

                }

                $(".errorforms").remove();
            }, complete: function () {



                $("#modal_codigo").text(asignatura);
                $("#modal_post_asignatura").val(asignatura);
                $("#modal_grupo").text(grupo);
                $("#modal_post_grupo").val(grupo);
                $("#input_docente").val(docente);
                $("#input_modalidad").attr('style', 'pointer-events: auto;');
                $("#input_modalidad").val(1);
                $("#input_actividad").attr('style', 'pointer-events: auto;');
                $("#input_actividad").val(1);
                $("#input_estado").attr('checked', true);

                var parametro = "nuevo";
                $("#modal_post_parametro").val(parametro);

                $("#form_registro").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

function editar() {
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        var semestre = $('input:radio[name=selrow]:checked').val();
        var asignatura = $('input:radio[name=selrow]:checked').attr('pk2');
        var grupo = $('input:radio[name=selrow]:checked').attr('pk3');
        var subgrupo = $('input:radio[name=selrow]:checked').attr('pk4');
        $.ajax({
            type: 'POST',
            url: base_url + "gestionasignaturas/getAjaxDocenteAsignaturaDetalle",
            data: {semestre: semestre, asignatura: asignatura, grupo: grupo, subgrupo: subgrupo},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {

                    $("#input_" + i).val(val);

                    //console.log(i);

                    if (i === "asignatura") {
                        $("#modal_codigo").text(val);
                        $("#modal_post_asignatura").val(val);

                    }

                    if (i === "grupo") {
                        $("#modal_grupo").text(val);
                        $("#modal_post_grupo").val(val);
                    }

                    if (i === "subgrupo") {
                        $("#modal_subgrupo").text(val);
                        $("#modal_post_subgrupo").val(val);
                        if (val <= 2) {
                            $("#input_modalidad").attr('style', 'pointer-events: none;');
                            $("#input_actividad").attr('style', 'pointer-events: none;');
                        }
                    }

                    if (i === "estado") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input_" + i).prop("checked", true);

                        }
                    }
                });
                $(".errorforms").remove();
            }, complete: function () {
                var parametro = "editar";
                $("#modal_post_parametro").val(parametro);
                $("#form_registro").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
    $("#form_registro")[0].reset();
    if ($(".selrow").is(':checked')) {
        var semestre = $('input:radio[name=selrow]:checked').val();
        var asignatura = $('input:radio[name=selrow]:checked').attr('pk2');
        var grupo = $('input:radio[name=selrow]:checked').attr('pk3');
        var subgrupo = $('input:radio[name=selrow]:checked').attr('pk4');

        //console.log("docente:" + docente);

        //var subgrupo = $('input:radio[name=selrow]:checked').attr('pk4');
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
                            url: base_url + "gestionasignaturas/eliminar",
                            type: 'POST',
                            data: {"semestre": semestre, "asignatura": asignatura, "grupo": grupo, "subgrupo": subgrupo},
                            success: function (response) {

                                if (response.say === "yes") {
                                    $('#tbl_asignaturasofertadas').dataTable().fnDraw();
                                } else if (response.say === "no") {
                                    bootbox.alert("<strong>No es prosible eliminar</strong>");
                                }
                            }
                        });
                    }
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

//agregar carrera
function agregar_carrera() {
    $("#input-estado").prop("checked", false);
    if ($(".selrow").is(':checked')) {
        $("#input_carreras").val("0");
        var semestre = $('input:radio[name=selrow]:checked').val();
        var asignatura = $('input:radio[name=selrow]:checked').attr('pk2');
        //var nombre_asignatura = $("#asignatura").text();
        var grupo = $('input:radio[name=selrow]:checked').attr('pk3');

        $("#modal_a_s_c_codigo").text(asignatura);
        $("#modal_a_s_c_asignatura").val(asignatura);
        $("#modal_a_s_c_text_grupo").text(grupo);
        $("#modal_a_s_c_grupo").val(grupo);
        $("#modal_agregar_carreras").modal('show');



        $.post(base_url + "gestionasignaturas/getTableModalCarrera", {semestre: semestre, asignatura: asignatura, grupo: grupo}, function (response) {
            var html = "";
            //html = html + '<option value="">Provincias</option>';
            $.each(response, function (i, val) {

                html = html + "<tr id='" + val.pk_semestre + "-" + val.pk_asignatura + "-" + val.pk_grupo + "-" + val.pk_carrera + "'>";
                html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.carrera + "</strong></td>";
                html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminar_carrera(" + val.pk_semestre + ",\"" + val.pk_asignatura + "\"," + val.pk_grupo + ",\"" + val.pk_carrera + "\")' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button></td>";
                html = html + "</tr>";

            });

            $("#tbody_carreras").html(html);
        }, "json");

    } else {
        errordialogtablecuriosity();
    }
}

function eliminar_carrera(semestre, asignatura, grupo, carrera) {
    console.log('Test');
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
                        url: base_url + "gestionasignaturas/eliminarCarrera",
                        type: 'POST',
                        //data: {"id": xsmart},
                        data: {"semestre": semestre, "asignatura": asignatura, "grupo": grupo, "carrera": carrera},
                        success: function (response) {
                            if (response.say === "yes") {
                                $("#" + semestre + "-" + asignatura + "-" + grupo + "-" + carrera).remove();

                            }
                        }
                    });
                }
            }

        }
    });
}



