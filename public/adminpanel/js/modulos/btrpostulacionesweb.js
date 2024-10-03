$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_postulaciones").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "btrpostulacionesweb/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},

            {"data": "titulo", "name": "e.titulo"},
            {"data": "razon_social", "name": "em.razon_social"},
            {"data": "fecha_postulacion", "name": "p.fecha_postulacion"},
            {"data": "estado", "name": " p.estado"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_postulaciones'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var fecha_split_i = data.fecha_postulacion;
            var fecha_split_1 = fecha_split_i.split(" ");
            var fecha_split_2 = fecha_split_1[0].split("-");
            var fecha_postulacion = fecha_split_2[2] + '/' + fecha_split_2[1] + '/' + fecha_split_2[0];
            $('td', row).eq(2).html(fecha_postulacion);

            var html2 = "";

            if (data.estado == 1) {
                html2 = '<h4><span class="label label-warning">Pendiente</span></h4>';
            } else {
                if (data.estado == 2) {
                    html2 = '<h4><span class="label label-success">Apto</span></h4>';
                } else {
                    html2 = '<h4><span class="label label-danger">No apto</span></h4>';
                }
            }

            $('td', row).eq(3).html(html2);

        }
    }
    );


});

