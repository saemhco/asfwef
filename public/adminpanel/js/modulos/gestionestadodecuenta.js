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

    $("#semestre_select").on("change", function () {
        var responsiveHelper_dt_basic = undefined;

        console.log('Change select semestre');

        var semestre_select = $(this).val();

        $('#tbl_gestionestadodecuenta').DataTable().destroy();

        tbl_gestionestadodecuenta = $("#tbl_gestionestadodecuenta").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "gestionestadodecuenta/datatable/" + semestre_select, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[1, "asc"], [2, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                { "data": "concepto_nombre", "name": "public.conceptos.descripcion" },
                { "data": "fecha_emision", "name": "public.caja.fecha_emision" },
                { "data": "fecha_pago", "name": "public.caja.fecha_pago" },
                { "data": "cuota", "name": "public.caja.cuota" },
                { "data": "cantidad", "name": "public.caja.cantidad" },
                { "data": "monto", "name": "public.caja.monto" },
                { "data": "total", "name": "public.caja.monto" },
                { "data": "proceso", "name": "public.caja.proceso" }
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_gestionestadodecuenta'), breakpointDefinition);
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
                $('td', row).eq(2).html(fecha_emision);

                if (data.fecha_pago) {
                    //console.log("esta lleno");
                    var fecha_split_pago = data.fecha_pago;
                    var fecha_split_1_pago = fecha_split_pago.split(" ");
                    var fecha_split_2_pago = fecha_split_1_pago[0].split("-");
                    var fecha_pago = fecha_split_2_pago[2] + '/' + fecha_split_2_pago[1] + '/' + fecha_split_2_pago[0];
                    $('td', row).eq(3).html(fecha_pago);
                }
    

                var proceso = "";
                if (data.proceso === 0) {
                    proceso = '<span class="label label-danger">Pendiente</span>';
                } else if (data.proceso === 1) {
                    proceso = '<span class="label label-success">Cancelado</span>';
                }
                $('td', row).eq(8).html(proceso); 

            }
        });

    });


    var semestre_select = $('#semestre_select').val();

    tbl_gestionestadodecuenta = $("#tbl_gestionestadodecuenta").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionestadodecuenta/datatable/" + semestre_select, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"], [2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "concepto_nombre", "name": "public.conceptos.descripcion" },
            { "data": "fecha_emision", "name": "public.caja.fecha_emision" },
            { "data": "fecha_pago", "name": "public.caja.fecha_pago" },
            { "data": "cuota", "name": "public.caja.cuota" },
            { "data": "cantidad", "name": "public.caja.cantidad" },
            { "data": "monto", "name": "public.caja.monto" },
            { "data": "total", "name": "public.caja.monto" },
            { "data": "proceso", "name": "public.caja.proceso" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_gestionestadodecuenta'), breakpointDefinition);
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
            $('td', row).eq(2).html(fecha_emision);
            
            if (data.fecha_pago) {
                //console.log("esta lleno");
                var fecha_split_pago = data.fecha_pago;
                var fecha_split_1_pago = fecha_split_pago.split(" ");
                var fecha_split_2_pago = fecha_split_1_pago[0].split("-");
                var fecha_pago = fecha_split_2_pago[2] + '/' + fecha_split_2_pago[1] + '/' + fecha_split_2_pago[0];
                $('td', row).eq(3).html(fecha_pago);
            }


            
            var proceso = "";
            if (data.proceso === 0) {
                proceso = '<span class="label label-danger">Pendiente</span>';
            } else if (data.proceso === 1) {
                proceso = '<span class="label label-success">Cancelado</span>';
            }
            $('td', row).eq(8).html(proceso);


        }
    });
});
