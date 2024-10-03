$(document).ready(function () {

//Lugar de procedencia
    if (semestreax !== "") {
        //console.log("Semestre defecto: " + semestreax);
        carga_asignatura(semestreax, asignatura, grupo, subgrupo);
    }


    if (asignatura !== "") {
        //console.log("LLega asignatura: " + asignatura);
        //console.log("Distrito: " + distrito1_id);
        //console.log("loading provincia procedencia");
        //carga_asignatura(semestreax, asignatura);

        //console.log(semestreax+"*"+asignatura);

        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        tbl_asignaturas = $("#tbl_asignaturas").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "gestionasistencias/datatable/" + semestreax + "/" + asignatura + "/" + grupo + "/" + subgrupo, "type": "POST"},
            "processing": false,
            "serverSide": true,
//            'columnDefs': [
//                {
//                    "targets": 6,
//                    "className": "text-center"
//                },
//                {
//                    "targets": 7,
//                    "className": "text-center"
//                }
//            ],
            "order": [[2, "asc"], [3, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
                //{"data": "imagen_1", "name": "ob.imagen_1"},
                //{"data": "codigo", "name": "codigo"} asis.horario,
                //{"data": "codigo", "name": "asis.codigo"},
                {"data": "fecha", "name": "fecha"},
                {"data": "codigo", "name": "codigo"},
                {"data": "tema", "name": "tema"},
                {"data": "observaciones", "name": "observaciones"},
      
           
                {"data": "estado", "name": "estado"}

                //{"data": "asignatura", "name": "da.asignatura"}

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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_asignaturas'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {


                var fecha = data.fecha;

                if (fecha !== null) {
                    //split igual explode php
                    var fecha_ini_r1 = fecha.split(" ");
                    //console.log(res_fecha_ini[0]);

                    var fecha_ini_result1 = fecha_ini_r1[0].split("-");
                    //console.log(fecha_ini_result1[2]);

                    var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
                    $('td', row).eq(1).html(fecha_ini_result2);
                }


                //formateamos la hora
                var hora = data.fecha;
                var split_hora = hora.split(" ");
                //console.log("Hora:" +split_hora[0]);
                var result_hora = split_hora[1];
                $('td', row).eq(2).html(result_hora);


                //console.log("estado: " + data.estado);
                var html2 = "";
                if (data.estado === "1") {
                    //html2 = '<span class="label label-success">Abierto</span>';
                    html2 = "<button class='btn btn-xs btn-success' onclick='confirmar(" + data.codigo + ")' >Abierto</button>";
                } else if (data.estado === "2") {
                    //html2 = '<span class="label label-warning" style="" >Cerrado</span>';
                    html2 = "<button style='pointer-events: none;' class='btn btn-xs btn-warning'>Cerrado</button>";
                } else if (data.estado === "0") {
                    //html2 = '<span class="label label-warning" style="" >Cerrado</span>';
                    html2 = "<button style='pointer-events: none;' class='btn btn-xs btn-danger'>Eliminado</button>";
                }
                $('td', row).eq(5).html(html2);
            },
            initComplete: function () {
                //Busqueda al dar enter
                $('div.dataTables_filter input').unbind();
                $('div.dataTables_filter input').bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        $('#tbl_asignaturas').dataTable().fnFilter(this.value);
                    }
                });
            }
        });
    }





    //Busca semestre
    $("#semestre").on("change", function () {
        carga_asignatura($(this).val(), 0);
    });

    $("#asignatura").on("change", function () {
        if ($("#asignatura").val() !== "") {
            var semes = $("#semestre").val();
            var asignatura = $("#asignatura").val();
            var grupo = $("#asignatura option:selected").attr("grupo");
            var subgrupo = $("#asignatura option:selected").attr("subgrupo");
            console.log(grupo);
            carga_datatables_asistencias($("#semestre").val(), asignatura, grupo, subgrupo, 0);
        } else {
            window.location.href = base_url + "gestionasistencias";
        }
    });

    //Carga Asistencia
    function carga_datatables_asistencias(semestre, asignatura, grupo, subgrupo, param) {
        window.location.href = base_url + "gestionasistencias/index/" + semestre + "/" + asignatura + "/" + grupo + "/" + subgrupo;
    }

    //Funcion carga asignatura
    function carga_asignatura(idsemestre, asignatura, grupo, subgrupo) {

        //console.log("Parameto:" + param);
        var param = idsemestre + "-" + asignatura + "-" + grupo + "-" + subgrupo;

        $.post(base_url + "gestionasistencias/getAsignaturas", {pk: idsemestre}, function (response) {

            var html = "";
            html = html + '<option value="">ASIGNATURAS</option>';
            $.each(response, function (i, val) {



                if (param === 0) {

                    html = html + '<option semestre ="' + val.semestre + '" value="' + val.asignatura + '" grupo="' + val.grupo + '" subgrupo="' + val.subgrupo + '">ASIGNATURA:'
                            + val.asignatura + ' - ' + val.nombre_asignatura + ' - CICLO: ' + val.ciclo
                            + ' - GRUPO:' + val.grupo + ' - SUBGRUPO:' + val.subgrupo + ' - CURRICULA:' + val.curricula
                            + '</option>';
                } else {
                    //val.semestre + "-" + val.asignatura + "-" + val.grupo + "-" + val.subgrupo 
                    if (val.semestre + "-" + val.asignatura + "-" + val.grupo + "-" + val.subgrupo === param) {

                        html = html + '<option semestre ="' + val.semestre + '" value="' + val.asignatura + '" grupo="' + val.grupo + '" subgrupo="' + val.subgrupo + '" selected >ASIGNATURA:'
                                + val.asignatura + ' - ' + val.nombre_asignatura + ' - CICLO: ' + val.ciclo
                                + ' - GRUPO:' + val.grupo + ' - SUBGRUPO:' + val.subgrupo + ' - CURRICULA:' + val.curricula
                                + '</option>';
                    } else {
                        html = html + '<option semestre ="' + val.semestre + '" value="' + val.asignatura + '" grupo="' + val.grupo + '" subgrupo="' + val.subgrupo + '">ASIGNATURA:'
                                + val.asignatura + ' - ' + val.nombre_asignatura + ' - CICLO: ' + val.ciclo
                                + ' - GRUPO:' + val.grupo + ' - SUBGRUPO:' + val.subgrupo + ' - CURRICULA:' + val.curricula
                                + '</option>';
                    }
                }

            });
            $("#asignatura").html(html);
        }, "json");
    }








    $(".activax").on("click", function () {
        //console.log("nais");
        var item = $(this).attr("id");
        console.log(item);
        $(".activa").removeClass("active");
        $(this).addClass("active");
        $(".not").attr("disabled", "disabled");
        $("." + item).removeAttr('disabled');
    });
    $(".activ").on("click", function () {
        //console.log("nais");
        var item = $(this).attr("id");
        //console.log(item);
        $(".activa").removeClass("active");
        $(this).parent().addClass("active");
        $(".not").attr("disabled", "disabled");
        $("." + item).removeAttr('disabled');
    });
    $(".not").on("click", function () {
        //console.log("nais");

        $(this).focus();
    });
    //Error agregar
    $("#error_agregar").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });

    //Error editar asistencia cerrada
    $("#error_editar_asistencia_cerrada").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica</h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });

    //Error eliminar
    $("#error_eliminar").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> Sistema de gestión académica </h4></div>",
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
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    });


















});
function agregar() {
//    if ($(".selrow").is(':checked')) {
//        var xsmart = $('input:radio[name=selrow]:checked').val();
//        var semes = $("#semestre").val();
//        window.location.href = base_url + "gestionasistencias/asistencia/" + xsmart + "/" + semes;
//    } else {
//        errordialogtablecuriosity();
//    }


    if ($("#asignatura").val().trim() !== '') {
        var semes = $("#semestre").val();
        var asignatura = $("#asignatura").val();
        var grupo = $("#asignatura option:selected").attr("grupo");
        var subgrupo = $("#asignatura option:selected").attr("subgrupo");
        //console.log(asignatura);
        window.location.href = base_url + "gestionasistencias/asistencias/" + semes + "/" + asignatura + "/" + grupo + "/" + subgrupo;
    } else {
        $("#error_agregar").dialog("open");
        CuriositySoundError();
    }

}



function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "gestionasistencias/getAjax",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.estado === "1") {
                    var semestre = $("#semestre").val();
                    var asignatura = $("#asignatura").val();
                    var grupo = $("#asignatura option:selected").attr("grupo");
                    var subgrupo = $("#asignatura option:selected").attr("subgrupo");
                    window.location.href = base_url + "gestionasistencias/asistencias/" + semestre + "/" + asignatura + "/" + grupo + "/" + subgrupo + "/" + xsmart;
                } else {
                    $("#error_editar_asistencia_cerrada").dialog("open");
                    CuriositySoundError();
                }

                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

//Funcion confirmar
function confirmar(codigo) {
    //alert('Hello World');
    $.ajax({
        url: base_url + "gestionasistencias/confirmar",
        type: 'POST',
        data: {"codigo": codigo},
        success: function (msg) {

            if (msg.say == "yes") {

                bootbox.confirm("<strong>Esta seguro que desea confirmar esta asistencia?</strong>", function (result) {
                    if (result === true) {
                        //console.log(result);
                        $('#tbl_asignaturas').dataTable().fnDraw();
                    }

                });

            } else {
                alert("error");
            }
        }
    });
}


//Eliminar
function eliminar()
{
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        bootbox.dialog({
            message: "<strong>¿ Desea Eliminar este registro ?</strong>",
            title: "Confirmar",
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "gestionasistencias/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_asignaturas').dataTable().fnDraw();
                                } else {
                                    $("#error_eliminar").dialog("open");
                                    CuriositySoundError();
                                }
                            }
                        });
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

//reporte asistencias
function reporte_asistencias() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var asignatura_codigo = asignatura;

        window.open(base_url + "reportes/reporteasistencias/" + semestre + "/" + asignatura_codigo + "/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

//reporte registro uxiliar
function reporte_registro_auxiliar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var semestre = semestreax;
        var asignatura_codigo = asignatura;

        window.open(base_url + "reportes/reporteregistroauxiliar/" + semestre + "/" + asignatura_codigo + "/" + xsmart);
    } else {
        errordialogtablecuriosity();
    }
}

