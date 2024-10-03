$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_libros_ejemplares = $("#tbl_libros_ejemplares").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registrolibros/datatableEjemplares/" + id_libro, "type": "POST"},
        "processing": false,
        "serverSide": true,
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
            {"data": "numero", "name": "numero"},
            {"data": "adquisicion", "name": "adquisicion"},
            {"data": "precio", "name": "precio"},
            {"data": "observaciones", "name": "observaciones"},
            {"data": "activo", "name": "activo"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_libros_ejemplares'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var activo = "";
            if (data.activo === 1) {
                activo = '<span class="label label-success">Disponible</span>';
            } else if (data.activo === 0) {
                activo = '<span class="label label-warning">Préstamo</span>';
            }
            $('td', row).eq(5).html(activo);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(html_estado);
        }
    });


    //valida enter
    $("#form_usuarios_detalles .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter



    $("#form_libros_ejemplares").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Ejemplares</h4></div>",
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
                    frm = $("#form_libros_ejemplares");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_libros_ejemplares').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_libros_ejemplares").dialog("close");
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

});

function agregarEjemplar() {
    var id_libro = $("#id_libro").val();
    console.log("id_libro:"+id_libro);
    $.ajax({
        type: 'POST',
        url: base_url + "registrolibros/saveEjemplares",
        data: {id_libro: id_libro},
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            if (response.say === "yes") {

                bootbox.alert("<strong>Se registró correctamente</strong>");
                $('#tbl_libros_ejemplares').dataTable().fnDraw();

            }
            $(".errorforms").remove();
        }, complete: function () {
            //$("#form_libros_ejemplares").dialog("open");
        }
    });
}



function editarEjemplar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "registrolibros/editarEjemplar",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-ejemplar-" + i).val(val);
                    // console.log(i);
                    if (i == "activo") {
                        if (val == 1) {
                            //Usamos la propiedad prop para el check
                            $("#input-ejemplar-" + i).prop("checked", true);
                        }
                    }
                });


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_libros_ejemplares").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

function eliminarEjemplar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        console.log(xsmart);
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
                            url: base_url + "registrolibros/eliminarEjemplar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_libros_ejemplares').dataTable().fnDraw();
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


