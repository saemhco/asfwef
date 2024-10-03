$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_padres = $("#tbl_padres").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "alumnosficha/datatablePadres/" + codigo_alumno, "type": "POST"},
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        "searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [
            {
                "targets": 0,
                "className": "text-center"
            }],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false},
            {"data": "parentesco", "name": "p.nombres"},
            {"data": "nombres_padres", "name": "ap.nombres_padres"},
            {"data": "apellido_paterno_padres", "name": "ap.apellido_paterno_padres"},
            {"data": "apellido_materno_padres", "name": "ap.apellido_materno_padres"},
            {"data": "edad_padres", "name": "ap.edad_padres"},
            {"data": "estado_civil_padres", "name": "ec.nombres"},
            {"data": "grado_instruccion_padres", "name": "gi.nombres"},
            {"data": "ocupacion_padres", "name": "ap.ocupacion_padres"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_padres'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {




        }
    });




    $("#form_padres").dialog({
        autoOpen: false,
        //height: "auto",
        width: "1000px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Familiares / Apoderados:</h4></div>",
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
                    //frm = $("#form_padres");  
                    frmx = $("#form_padres");
                    var frm = new FormData(this);

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
                                  console.log("save_padre");
                                $('#tbl_padres').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_padres").dialog("close");
                                
                                
                              
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

    //valida enter
    $("#form_padres .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    //$("#input-codigo").val("");
    $("#input-codigo_padres").val("");
    $("#form_padres")[0].reset();
    $("#form_padres").dialog("open");

}
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "alumnosficha/getAjaxPadres",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i).val(val);
                    //console.log(i);



                    if (i == "enfermedad_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "tratamiento_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "discapacidad_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "casa_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "camion_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "auto_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "mototaxi_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "predios_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "tv_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "equipo_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "animales_padres") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    } else if (i == "es_principal") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#" + i).prop("checked", true);
                        }
                    }




                });

                //Formateamos fecha de nacimiento
                var f_i = $("#input-fecha_nacimiento_padres").val();
                //console.log(f_i);
                //Split igual explode php
                var r_f_i = f_i.split(" ");
                //console.log(r_f_i[0]);
                var res_f_i = r_f_i[0].split("-");
                //console.log(res_f_i[0]);
                var result_fi = res_f_i[2] + '-' + res_f_i[1] + '-' + res_f_i[0];
                //console.log(result_fi);
                $("#input-fecha_nacimiento_padres").val(result_fi);



                $(".errorforms").remove();
            }, complete: function () {
                $("#form_padres").dialog("open");
            }
        });
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
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "alumnosficha/eliminarPadre",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_padres').dataTable().fnDraw();
                                } else {

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