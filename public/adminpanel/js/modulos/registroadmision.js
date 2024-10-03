$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_admision = $("#tbl_admision").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registroadmision/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "descripcion", "name": "admi.descripcion"},
            {"data": "nombre_semestre", "name": "semes.descripcion"},
            {"data": "anio", "name": "admi.anio"},
            {"data": "fecha_hora_ordinario", "name": "admi.fecha_hora_ordinario"},
            {"data": "fecha_hora_extraordinario", "name": "admi.fecha_hora_extraordinario"},
            {"data": "activo", "name": "admi.activo"},
            {"data": "estado", "name": "admi.estado"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_admision'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },

        "createdRow": function (row, data, index) {

            if (data.fecha_hora_ordinario && data.fecha_hora_extraordinario !== null) {
                //alert("LLega si es diferente de null");
                //Formateamos la fecha-inicio
                var fecha_inicio = data.fecha_hora_ordinario;
                //split igual explode php
                var res_fecha_inicio = fecha_inicio.split("-");
                //recorremos el array por las posiciones
                //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
                var array_2_fecha_inicio = res_fecha_inicio[2].split(" ");

                var res_fecha_inicio = array_2_fecha_inicio[0] + '/' + res_fecha_inicio[1] + '/' + res_fecha_inicio[0];
                $('td', row).eq(4).html(res_fecha_inicio);


                //Formateamos la fecha-fin
                var fecha_fin = data.fecha_hora_extraordinario;
                //split igual explode php
                var res_fecha_fin = fecha_fin.split("-");
                //recorremos el array por las posiciones
                //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
                var array_2_fecha_fin = res_fecha_fin[2].split(" ");

                var res_fecha_fin = array_2_fecha_fin[0] + '/' + res_fecha_fin[1] + '/' + res_fecha_fin[0];
                $('td', row).eq(5).html(res_fecha_fin);

            }


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(7).html(html_estado);
        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_admision').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //parametros
    $("#form_admision_parametros").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Parametros</h4></div>",
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

                    var admision_actual = $("#admision_actual option:selected").val();
                    var admision_anterior = $("#admision_anterior option:selected").val();


                    if (admision_actual === '0') {
                        //alert('Falta select matricula');
                        $("#error_select_semestre_1").dialog("open");
                        CuriositySoundError();
                    } else if (admision_anterior === '0') {
                        $("#error_select_semestre_2").dialog("open");
                        CuriositySoundError();
                    } else {
                        frm = $("#form_admision_parametros");
                        $.ajax({
                            url: frm.attr("action"),
                            type: 'POST',
                            data: frm.serialize(),
                            success: function (msg) {
                                var result = msg;
                                if (result.say === "yes")
                                {



                                    $.each(result, function (i, val) {
                                        console.log(i);
                                    });


                                    bootbox.alert("<strong>Se registró correctamente</strong>");
                                    $("#form_admision_parametros").dialog("close");
                                    $('#tbl_admision').dataTable().fnDraw();



                                } else {
                                    //console.log("llegamos a la disco");
                                    //alert('Debe selecionar ambos campos');
                                    $("#error_ambos_select").dialog("open");
                                    CuriositySoundError();
                                    $(".errorforms").remove();

                                    $.each(result, function (i, val) {
                                        $("#input-" + i).focus();
                                        $("#input-" + i).after(val);
                                    });
                                }
                            }
                        });
                    }


                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    //exito datos guardados
    $("#success").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
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
                    window.location.href = base_url + "registroadmision";
                }
            }]
    });

    //Publicar form
    $("#publicar").on("click", function () {
        console.log("@kenmack");
        frmx = $("#form_admision");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_admision"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());
        //frm.append('texto_1', editor.getData());
        frm.append('estado_input',$('#input-estado').is(':checked'));
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
                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "sliders";
                    $("#success").dialog("open");
                    //CuriositySoundError();

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    //Mostrar mensaje error del modelo
                    $.each(result, function (i, val) {
                        $("#input-" + i).focus();
                        $("#input-" + i).after(val);
                    });
                }
            }
        });
    });




    $("#admision_anterior").on("change", function () {
        //alert('Testing');
        var admision_actual = $("#admision_actual option:selected").val();
        var admision_anterior = $(this).val();
        //alert("enaviamos:"+asignatura+"-"+alumno);

        if (parseInt(admision_actual) < parseInt(admision_anterior)) {
            //$("#error_select_semestre").dialog("open");
            //CuriositySoundError();
            //$("#form_semestres_parametros").dialog("close");
        }
    });


    $('#input-hora_ordinario').timepicker();
    $('#input-hora_extraordinario').timepicker();
    $('#input-hora_inicio_inscripcion').timepicker();
    $('#input-hora_fin_inscripcion').timepicker();
 
});

//editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registroadmision/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}

function eliminar()
{
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
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
                            url: base_url + "registroadmision/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_admision').dataTable().fnDraw();
                                } else {

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

function parametros() {

    console.log("Codigo del parametro:" + codigo_parametro);
    if (codigo_parametro === 0) {
        //Limpia los errores y resetea los valores de los campos
        $(".errorforms").hide();
        $("#input-codigo").val("");
        $("#form_admision_parametros")[0].reset();
        $("#form_admision_parametros").dialog("open");
    } else if (codigo_parametro === 2) {
        $("#form_admision_parametros").dialog("open");
        console.log("admision_m: " + admision_m);
        console.log("admision_p: " + admision_p);
        $("#admision_actual").val(admision_m);
        $("#admision_anterior").val(admision_p);

    }



}
