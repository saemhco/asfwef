$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_asignacionareas = $("#tbl_asignacionareas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestiontramites/datatableAsignacionAreas", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "personal", "name": "personal"},
            {"data": "area", "name": "area"},
            {"data": "perfil", "name": "perfil"},
            {"data": "estado", "name": "estado"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_asignacionareas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        "createdRow": function (row, data, index) {
            //console.log(data.estado);
            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_asignacionareas').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );

    //valida enter
    $("#form_asignacionareas .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;

        }
    }); // fin validar enter




    //form asignacionareas
    $("#form_asignacionareas").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "    <div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Asignación de Areas</h4></div>",
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
                html: "<i class='fa fa-save'></i>&nbsp; Asignar", "id": "graba",
                "class": "btn btn-info",
                click: function () {
                    $(".errorforms").remove();
                    //
                    var personal = $("#input-personal option:selected").val();
                    var area = $("#input-area option:selected").val();
                    var perfil = $("#input-perfil option:selected").val();

                    $.ajax({
                        url: base_url + "gestiontramites/getTramitePersonalArea",
                        type: 'POST',
                        data: {personal: personal, area: area, perfil: perfil},
                        success: function (response) {
                            if (response.say === "yes") {

                                //console.log("Ya existe Gaaaaaaaaaaa");
                                var val = '<div class="text-danger errorforms">Ya se asignó el perfil para el personal seleccionado</div>';
                                $("#input-perfil").after(val);


                            } else {

                                frm = $("#form_asignacionareas");
                                $.ajax({
                                    url: frm.attr("action"),
                                    type: 'POST',
                                    data: frm.serialize(),
                                    success: function (msg) {
                                        var result = msg;
                                        if (result.say === "yes")
                                        {
                                            // $("#modalnew").modal("hide");
                                            $('#tbl_asignacionareas').dataTable().fnDraw();
                                            bootbox.alert("<strong>Se registró correctamente</strong>");
                                            $("#form_asignacionareas").dialog("close");
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
                        }
                    });
                    //

                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });
});



function agregar() {
    $("#form_asignacionareas")[0].reset();

    $.ajax({
        type: 'POST',
        url: base_url + "gestiontramites/getNuevo",
        dataType: 'json',
        success: function (response) {

            if (response.say === 'yes') {

                $("#input-codigo").attr('value', response.codigo);

            }

            $(".errorforms").remove();
        }, complete: function () {
            $("#form_asignacionareas").dialog("open");
        }
    });

}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        bootbox.dialog({
            message: "<strong>¿ Está seguro que desea activar el perfil ?</strong>",
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
                            url: base_url + "gestiontramites/editar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say === "yes") {
                                    $('#tbl_asignacionareas').dataTable().fnDraw();
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

function eliminar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        bootbox.dialog({
            message: "<strong>¿ Está seguro que desea desactivar el perfil ?</strong>",
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
                            url: base_url + "gestiontramites/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say === "yes") {
                                    $('#tbl_asignacionareas').dataTable().fnDraw();
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