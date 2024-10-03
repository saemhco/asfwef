$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_derivacion_servicios = $("#tbl_derivacion_servicios").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroatencionservicios/datatableDerivacionServicios/" + id_atencion, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "fecha_derivacion", "name": "fecha_derivacion" },
            { "data": "servicio", "name": "servicio" },
            { "data": "motivo", "name": "motivo" },
            { "data": "proceso", "name": "proceso" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_derivacion_servicios'), breakpointDefinition);
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
            $('td', row).eq(5).html(estado);

        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_derivacion_servicios').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    $("#form_atencion_servicio").dialog({
        open: function () {
            if ($.ui && $.ui.dialog && !$.ui.dialog.prototype._allowInteractionRemapped && $(this).closest(".ui-dialog").length) {
                if ($.ui.dialog.prototype._allowInteraction) {
                    $.ui.dialog.prototype._allowInteraction = function (e) {
                        if ($(e.target).closest('.select2-drop').length) return true;
                        return ui_dialog_interaction.apply(this, arguments);
                    };
                    $.ui.dialog.prototype._allowInteractionRemapped = true;
                }
                else {
                    $.error("You must upgrade jQuery UI or else.");
                }
            }
        },
        _allowInteraction: function (event) {
            return !!$(event.target).is(".select2-input") || this._super(event);
        },
        height: 'auto',
        autoOpen: false,
        width: "700px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Derivacion Servicios</h4></div>",
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
                frm = $("#form_atencion_servicio");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            $('#tbl_derivacion_servicios').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>")
                            $("#form_atencion_servicio").dialog("close");
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
    $("#form_atencion_servicio .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter


});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-ds-id_derivacion_servicio").val("");
    $('#input-ds-id_personal').val("0");
    $('#input-ds-id_personal').select2();
    $("#form_atencion_servicio")[0].reset();
    $("#form_atencion_servicio").dialog("open");
}

function editar() {

    $('#input-ds-id_personal').select2({
        dropdownParent: $('#form_atencion_servicio')
    });

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registroatencionservicios/getAjaxDerivacionServicios",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                //var result = JSON.parse(msg);

                $.each(response, function (i, val) {
                    //console.log(i);
                    $("#input-ds-" + i).val(val);

                    
                    if (i === "id_personal") {
               
                        $('#input-ds-id_personal').val(val).trigger('change');

                    }

                    if (i === "fecha_derivacion") {
                        var f_d = val;
                        var r_f_d = f_d.split(" ");
                        var res_r_f_d = r_f_d[0].split("-");
                        var fecha_derivacion = res_r_f_d[2] + '/' + res_r_f_d[1] + '/' + res_r_f_d[0];
                        $("#input-ds-fecha_derivacion").val(fecha_derivacion);
                    }

                    if (i === "fecha_atencion") {
                        var f_a = val;
                        var r_f_a = f_a.split(" ");
                        var res_r_f_a= r_f_a[0].split("-");
                        var fecha_atencion = res_r_f_a[2] + '/' + res_r_f_a[1] + '/' + res_r_f_a[0];
                        $("#input-ds-fecha_atencion").val(fecha_atencion);
                    }






                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_atencion_servicio").dialog("open");
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
                            url: base_url + "registroatencionservicios/eliminarDerivacionServicios",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_derivacion_servicios').dataTable().fnDraw();
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