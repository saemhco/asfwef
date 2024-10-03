$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_curriculas = $("#tbl_curriculas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registrocurriculas/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "codigo", "name": "cu.codigo"},
            {"data": "descripcion", "name": "cu.descripcion"},
            {"data": "fecha_inicio", "name": "cu.fecha_inicio"},
            {"data": "fecha_fin", "name": "cu.fecha_fin"},
            {"data": "abreviatura", "name": "cu.abreviatura"},
            {"data": "carrera", "name": "carr.descripcion"},
            {"data": "estado", "name": "cu.estado"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_curriculas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        "createdRow": function (row, data, index) {

            //console.log(data.fecha_inicio);
            //Formateamos la fecha-inicio
            var fecha_inicio = data.fecha_inicio;
            //split igual explode php
            var res_fecha_inicio = fecha_inicio.split("-");
            //recorremos el array por las posiciones
            //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
            var array_2_fecha_inicio = res_fecha_inicio[2].split(" ");

            var res_fecha_inicio = array_2_fecha_inicio[0] + '-' + res_fecha_inicio[1] + '-' + res_fecha_inicio[0];
            $('td', row).eq(3).html(res_fecha_inicio);


            //Formateamos la fecha-fin
            var fecha_fin = data.fecha_fin;
            //split igual explode php
            var res_fecha_fin = fecha_fin.split("-");
            //recorremos el array por las posiciones
            //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
            var array_2_fecha_fin = res_fecha_fin[2].split(" ");

            var res_fecha_fin = array_2_fecha_fin[0] + '-' + res_fecha_fin[1] + '-' + res_fecha_fin[0];
            $('td', row).eq(4).html(res_fecha_fin);


        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_curriculas').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );
    $("#form_curriculas").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de curriculas</h4></div>",
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
                    frm = $("#form_curriculas");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_curriculas').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>")
                                $("#form_curriculas").dialog("close");
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
    $("#form_curriculas .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter


});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-codigo").val("");
    $("#form_curriculas")[0].reset();
    $("#form_curriculas").dialog("open");
}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registrocurriculas/getAjax",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                //var result = JSON.parse(msg);

                $.each(response, function (i, val) {
                    // console.log(val);
                    $("#input-" + i).val(val);


                });

                //Formateamos fecha inicio
                var f_i = $("#input-fecha_inicio").val();
                console.log(f_i);
                //Split igual explode php
                var r_f_i = f_i.split(" ");
                //console.log(r_f_i[0]);
                var res_f_i = r_f_i[0].split("-");
                //console.log(res_f_i[0]);
                var result_fi = res_f_i[2] + '-' + res_f_i[1] + '-' + res_f_i[0];
                //console.log(result_fi);
                $("#input-fecha_inicio").val(result_fi);

                //Formateamos la fecha fin
                var f_fin = $("#input-fecha_fin").val();
                //console.log(f_i);
                //Split igual explode php
                var r_f_fin = f_fin.split(" ");
                //console.log(r_f_i[0]);
                var res_f_fin = r_f_fin[0].split("-");
                //console.log(res_f_i[0]);
                var result_f_fin = res_f_fin[2] + '-' + res_f_fin[1] + '-' + res_f_fin[0];
                //console.log(result_fi);
                $("#input-fecha_fin").val(result_f_fin);


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_curriculas").dialog("open");
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
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                },
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "registrocurriculas/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_curriculas').dataTable().fnDraw();
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