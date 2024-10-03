$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_detalle = $("#tbl_detalle").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registromedicamentosadquisiciones/datatabledetalle/" + id_adquisicion, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "medicamento", "name": "medicamento" },
            { "data": "cantidad", "name": "cantidad" },
            { "data": "precio", "name": "precio" },
            { "data": "estado", "name": "estado" }

        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_detalle'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        "createdRow": function (row, data, index) {

            var estado = "";
            if (data.estado === 'A') {
                estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(4).html(estado);

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_detalle').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    $("#form_detalle").dialog({
        autoOpen: false,
        height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Adquisiciones Detalles</h4></div>",
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
                frm = $("#form_detalle");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            $('#tbl_detalle').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>")
                            $("#form_detalle").dialog("close");
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
    $("#form_detalle .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter


});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-ad-id_adquision_detalle").val("");
    $('#input-ad-id_medicamento').val("0");
    $('#input-ad-id_medicamento').select2({
        dropdownParent: $('#form_detalle')
    });
    $("#form_detalle")[0].reset();
    $("#form_detalle").dialog("open");
}

function editar() {

    $('#input-ad-id_medicamento').select2({
        dropdownParent: $('#form_detalle')
    });

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registromedicamentosadquisiciones/getAjaxDetalle",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                //var result = JSON.parse(msg);

                $.each(response, function (i, val) {
                    //console.log(i);
                    $("#input-ad-" + i).val(val);

                    
                    if (i === "id_medicamento") {

                        $('#input-ad-id_medicamento').val(val).trigger('change');

                    }



                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_detalle").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
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
                            url: base_url + "registromedicamentosadquisiciones/eliminarDetalle",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_detalle').dataTable().fnDraw();
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