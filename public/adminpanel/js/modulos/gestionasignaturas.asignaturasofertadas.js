$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    $("#input-semestre_select").on("change", function () {
        var responsiveHelper_dt_basic = undefined;
        //console.log("Entra");
        var semestre_select = $(this).val();

        $('#tbl_asignaturasofertadas').DataTable().destroy();

        tbl_asignaturasofertadas = $("#tbl_asignaturasofertadas").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "gestionasignaturas/datatableAsignaturasOfertadas/"+semestre_select, "type": "POST"},
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"]],
            "columnDefs": [
                {"width": "60px", "targets": 1},
                {"targets": 3, "className": "text-center"},
                {"targets": 4, "className": "text-center"},
                {"targets": 6, "className": "text-center"}
            ],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
                //{"data": "imagen_1", "name": "ob.imagen_1"},
                {"data": "codigo", "name": "a.codigo"},
                {"data": "nombre", "name": "a.nombre"},
                {"data": "ciclo", "name": "a.ciclo"},
                {"data": "creditos", "name": "a.creditos"},
                {"data": "tipo_asignatura", "name": "t_a.nombres"},
                {"data": "estado", "name": "a.estado"}
    
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
    
                var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" pk2="' + data.semestre + '" ><i></i> </label></center>';
                $('td', row).eq(0).html(html);
    
    
                var html_grupos = "";
                html_grupos = "<button type='button'  class='btn btn-xs btn-primary' data-toggle='modal' data-target='#modal_agregar_grupos' onclick='agregar(\"" + data.codigo + "\"," + data.semestre + " ,\"" + data.nombre + "\"," + data.ciclo + ", " + data.creditos + ", \"" + data.tipo_asignatura + "\");'><i class='fa fa-users'></i></button>";
                $('td', row).eq(6).html(html_grupos);
    
    
    
    
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
    

    });

    var semestre_select = $('#input-semestre_select').val();
    tbl_asignaturasofertadas = $("#tbl_asignaturasofertadas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionasignaturas/datatableAsignaturasOfertadas/"+semestre_select, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columnDefs": [
            {"width": "60px", "targets": 1},
            {"targets": 3, "className": "text-center"},
            {"targets": 4, "className": "text-center"},
            {"targets": 6, "className": "text-center"}
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            //{"data": "imagen_1", "name": "ob.imagen_1"},
            {"data": "codigo", "name": "a.codigo"},
            {"data": "nombre", "name": "a.nombre"},
            {"data": "ciclo", "name": "a.ciclo"},
            {"data": "creditos", "name": "a.creditos"},
            {"data": "tipo_asignatura", "name": "t_a.nombres"},
            {"data": "estado", "name": "a.estado"}

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

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" pk2="' + data.semestre + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);


            var html_grupos = "";
            html_grupos = "<button type='button'  class='btn btn-xs btn-primary' data-toggle='modal' data-target='#modal_agregar_grupos' onclick='agregar(\"" + data.codigo + "\"," + data.semestre + " ,\"" + data.nombre + "\"," + data.ciclo + ", " + data.creditos + ", \"" + data.tipo_asignatura + "\");'><i class='fa fa-users'></i></button>";
            $('td', row).eq(6).html(html_grupos);




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



    //save 
    $("#save_asignaturasofertadas").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> Sistema de gestión académica</h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [{
                html: "Aceptar",
                "class": "btn btn-success btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "asignaturas";
                }
            }]
    });




    $("#registrar_grupos").on("click", function () {
        //alert('Testing');
        frm = $("#form_grupos");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    // $("#modalnew").modal("hide");
                    $("#modal_agregar_grupos").modal("hide");
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

});

//agregar grupo
function agregar(codigo, semestre, asignatura, ciclo, creditos, tipo) {

    $("#form_grupos")[0].reset();


    var nro_alumnos = [1, 2, 3, 4, 5, 6];
    $.each(nro_alumnos, function (ind, elem) {
        //console.log('¡Hola :' + elem + '!');
        $('#nro_alumnos_' + elem).on('input', function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });
    });

    //
    $("#estado_2").on("click", function () {
        //console.log("nais");
        if ($("#estado_2").is(':checked')) {
            $('#select_docente_2').prop('disabled', false);

            $('#nro_alumnos_2').prop('disabled', false);
            $('#observacion_2').prop('disabled', false);

            $('#estado_3').prop('disabled', false);
        } else {

            //console.log('Tes');
            $('#select_docente_2').val(0);
            $('#nro_alumnos_2').val(0);
            $('#observacion_2').val("");
            $('#select_docente_2').prop('disabled', true);
            $('#nro_alumnos_2').prop('disabled', true);
            $('#observacion_2').prop('disabled', true);


            $('#estado_3').prop('disabled', true);
            $('#estado_3').prop('checked', false);
            $('#select_docente_3').prop('disabled', true);

            $('#estado_4').prop('disabled', true);
            $('#estado_4').prop('checked', false);
            $('#select_docente_4').prop('disabled', true);

            $('#estado_5').prop('disabled', true);
            $('#estado_5').prop('checked', false);
            $('#select_docente_5').prop('disabled', true);

            $('#estado_6').prop('disabled', true);
            $('#estado_6').prop('checked', false);
            $('#select_docente_6').prop('disabled', true);

        }
    });

    $('#estado_3').prop('disabled', true);
    $('#estado_4').prop('disabled', true);
    $('#estado_5').prop('disabled', true);
    $('#estado_6').prop('disabled', true);

    $("#estado_3").on("click", function () {
        //console.log("nais");
        if ($("#estado_3").is(':checked')) {
            $('#select_docente_3').prop('disabled', false);

            $('#nro_alumnos_3').prop('disabled', false);
            $('#observacion_3').prop('disabled', false);

            $('#estado_4').prop('disabled', false);
        } else {
            $('#select_docente_3').val(0);
            $('#nro_alumnos_3').val(0);
            $('#observacion_3').val("");
            $('#select_docente_3').val(0);
            $('#nro_alumnos_3').val(0);
            $('#observacion_3').val("");
            $('#select_docente_3').val(0);
            $('#select_docente_3').prop('disabled', true);
            $('#nro_alumnos_3').prop('disabled', true);
            $('#observacion_3').prop('disabled', true);

            $('#estado_4').prop('disabled', true);
            $('#estado_4').prop('checked', false);
            $('#select_docente_4').prop('disabled', true);

            $('#estado_5').prop('disabled', true);
            $('#estado_5').prop('checked', false);
            $('#select_docente_5').prop('disabled', true);

            $('#estado_6').prop('disabled', true);
            $('#estado_6').prop('checked', false);
            $('#select_docente_6').prop('disabled', true);
        }
    });

    $("#estado_4").on("click", function () {
        //console.log("nais");
        if ($("#estado_4").is(':checked')) {
            $('#select_docente_4').prop('disabled', false);

            $('#nro_alumnos_4').prop('disabled', false);
            $('#observacion_4').prop('disabled', false);

            $('#estado_5').prop('disabled', false);
        } else {
            $('#select_docente_4').val(0);
            $('#nro_alumnos_4').val(0);
            $('#observacion_4').val("");
            $('#select_docente_4').val(0);
            $('#select_docente_4').prop('disabled', true);
            $('#nro_alumnos_4').prop('disabled', true);
            $('#observacion_4').prop('disabled', true);

            $('#estado_5').prop('disabled', true);
            $('#estado_5').prop('checked', false);
            $('#select_docente_5').prop('disabled', true);

            $('#estado_6').prop('disabled', true);
            $('#estado_6').prop('checked', false);
            $('#select_docente_6').prop('disabled', true);
        }
    });

    $("#estado_5").on("click", function () {
        //console.log("nais");
        if ($("#estado_5").is(':checked')) {
            $('#select_docente_5').prop('disabled', false);

            $('#nro_alumnos_5').prop('disabled', false);
            $('#observacion_5').prop('disabled', false);

            $('#estado_6').prop('disabled', false);
        } else {
            $('#select_docente_5').val(0);
            $('#nro_alumnos_5').val(0);
            $('#observacion_5').val("");
            $('#select_docente_5').val(0);
            $('#select_docente_5').prop('disabled', true);
            $('#nro_alumnos_5').prop('disabled', true);
            $('#observacion_5').prop('disabled', true);

            $('#estado_6').prop('disabled', true);
            $('#estado_6').prop('checked', false);
            $('#select_docente_6').prop('disabled', true);

            //$('#estado_6').prop('disabled', true);
        }
    });

    $("#estado_6").on("click", function () {
        //console.log("nais");
        if ($("#estado_6").is(':checked')) {
            $('#select_docente_6').prop('disabled', false);

            $('#nro_alumnos_6').prop('disabled', false);
            $('#observacion_6').prop('disabled', false);
        } else {
            $('#select_docente_6').val(0);
            $('#nro_alumnos_6').val(0);
            $('#observacion_6').val("");
            $('#select_docente_6').val(0);
            $('#select_docente_6').prop('disabled', true);
            $('#nro_alumnos_6').prop('disabled', true);
            $('#observacion_6').prop('disabled', true);
        }
    });
    //


    //console.log(codigo+'*'+nombre+'*'+ciclo+'*'+creditos+'*'+tipo);
    $("#codigo").text(codigo);
    $("#asignatura").text(asignatura);
    $("#ciclo").text(ciclo);
    $("#creditos").text(creditos);
    $("#tipo").text(tipo);


    //key
    $("#key_semestre").val(semestre);
    $("#key_asignatura").val(codigo);



    $.ajax({
        type: 'POST',
        url: base_url + "gestionasignaturas/getGrupos",
        data: {codigo: codigo, semestre: semestre},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {

                console.log(val.docente);
                $("#select_docente_" + val.grupo).val(val.docente);

                $("#grupo_" + val.grupo).text(val.grupo);
                $("#grupo_" + val.grupo).html(+val.grupo + '<input type="hidden" id="g_' + val.grupo + ' " name="grupos[]" value=" ' + val.grupo + ' ">');

                $("#nro_alumnos_" + val.grupo).val(val.nro);

                $("#observacion_" + val.grupo).val(val.observacion);

                //$("#val-" + i).val(val);
                //$("#val-" + i).text(val);

                console.log(val.estado);

                if (val.estado === "A") {
                    //Usamos la propiedad prop para el check
                    //console.log("Entro aqui");
                    $("#estado_" + val.grupo).prop("checked", true);
                    $("#estado_" + val.grupo).prop('disabled', false);

                    if ($("#estado_" + val.grupo).is(':checked')) {
                        $('#select_docente_' + val.grupo).prop('disabled', false);

                        $('#nro_alumnos_' + val.grupo).prop('disabled', false);
                        $('#observacion_' + val.grupo).prop('disabled', false);

                        var contador = val.grupo + 1;

                        $('#estado_' + contador).prop('disabled', false);
                    }


                } else if (val.estado === "X") {
                    $('#select_docente_' + val.grupo).prop('disabled', true);
                    $('#nro_alumnos_' + val.grupo).prop('disabled', true);
                    $('#observacion_' + val.grupo).prop('disabled', true);
                    //$("#estado_" + val.grupo).prop('disabled', false);
                }

            });
            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_autores").dialog("open");
        }
    });



}



var contador = 1;
function agregar_grupo() {

    console.log(contador);
    contador++;

    $(".errorforms").remove();

    if (contador <= 6) {
        var html = "";
        html = html + "<tr id='tr_" + contador + "'>";
        html = html + "<td style='vertical-align: middle;text-align: center;'><strong id='codigo'</strong>" + contador + "</td>";
        html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminar_grupo(" + contador + ");' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button></td>";
        html = html + "</tr>";
        $("#tbody_grupos").append(html);
        //contador = 1;
    } else {
        contador = 0;
        var val = '<div class="text-danger errorforms">Número máximo de grupos = 6</div>';
        $("#t_grupos").after(val);


    }
}

function update() {
    var semestre_select = $('#input-semestre_select').val();
    //console.log("Semestre Select: "+semestre_select);
    $.ajax({
        type: 'POST',
        url: base_url + "gestionasignaturas/saveAsignaturasOfertadas/"+semestre_select,
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'yes') {

                bootbox.alert("<strong>Se actualizó correctamente</strong>");

            }
        }
    });
}

function detalle() {
    if ($(".selrow").is(':checked')) {
        var codigo_asignatura = $('input:radio[name=selrow]:checked').val();
        var semestre = $('input:radio[name=selrow]:checked').attr('pk2');
        console.log(semestre);
        window.location.href = base_url + "gestionasignaturas/registro/" + codigo_asignatura + '/' + semestre;
    } else {
        errordialogtablecuriosity();
    }
}

//horario
function horario() {
    if ($(".selrow").is(':checked')) {
        var codigo_asignatura = $('input:radio[name=selrow]:checked').val();
        var turno = 0;
        var bloquear = 0;
        window.location.href = base_url + "gestionhorarios/asignaturas/" + codigo_asignatura + '/' + turno + '/' + bloquear;
    } else {
        errordialogtablecuriosity();
    }
}

