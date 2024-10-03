$(document).ready(function () {
    //alert("Hola");
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_registroestadodecuenta = $("#tbl_registroestadodecuenta").DataTable({
        "ajax": { "url": base_url + "registropagos/datatablematricula", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "alumno", "name": "public.caja.alumno" },
            { "data": "concepto_nombre", "name": "public.conceptos.descripcion" },
            { "data": "fecha_emision", "name": "public.caja.fecha_emision" },
            { "data": "fecha_pago", "name": "public.caja.fecha_pago" },
            { "data": "cuota", "name": "public.caja.cuota" },
            { "data": "cantidad", "name": "public.caja.cantidad" },
            { "data": "monto", "name": "public.caja.monto" },
            { "data": "total", "name": "public.caja.monto" },
            { "data": "proceso", "name": "public.caja.proceso" },
            { "data": "estado", "name": "public.caja.estado" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_registroestadodecuenta'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

             var fecha_split_emision = data.fecha_emision;
            var fecha_split_1_emision = fecha_split_emision.split(" ");
            var fecha_split_2_emision = fecha_split_1_emision[0].split("-");
            var fecha_emision = fecha_split_2_emision[2] + '/' + fecha_split_2_emision[1] + '/' + fecha_split_2_emision[0];
            $('td', row).eq(3).html(fecha_emision);

            if (data.fecha_pago) {
                //console.log("esta lleno");
                var fecha_split_pago = data.fecha_pago;
                var fecha_split_1_pago = fecha_split_pago.split(" ");
                var fecha_split_2_pago = fecha_split_1_pago[0].split("-");
                var fecha_pago = fecha_split_2_pago[2] + '/' + fecha_split_2_pago[1] + '/' + fecha_split_2_pago[0];
                $('td', row).eq(4).html(fecha_pago);
            }



            var proceso = "";
            if (data.proceso === 0) {
                proceso = "<button class='btn btn-xs btn-primary' onclick='pagar(" + data.codigo + ")' >Pagar</button>";
            } else if (data.proceso === 1) {
                proceso = '<span class="label label-success">Cancelado</span>';
            }
            $('td', row).eq(9).html(proceso);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(10).html(html_estado); 

        }
    });

    //form rechazar
    $("#form_pagar").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registrar Pago</h4></div>",
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

                frm = $("#form_pagar");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {

                            $("#form_pagar").dialog("close");
                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                $('#tbl_registroestadodecuenta').dataTable().fnDraw();
                            });
                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();

                            $.each(result, function (i, val) {
                                //$("#input-" + i).focus();
                                $("#input-" + i).blur();
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



function pagar(id_caja) {
    //Limpia los errores y resetea los valores de los campos
    console.log("id_caja:" + id_caja);
    $(".errorforms").hide();
    $('#input-id_caja').val(id_caja);
    $("#form_pagar")[0].reset();
    $("#form_pagar").dialog("open");
}