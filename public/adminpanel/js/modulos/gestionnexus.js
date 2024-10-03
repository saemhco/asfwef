$(document).ready(function () {






    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_nexus = $("#tbl_nexus").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionnexus/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            { "data": "nombre_de_la_institucion_educativa", "name": "nombre_de_la_institucion_educativa" },
            { "data": "cargo", "name": "cargo" },
            { "data": "codigo_de_plaza", "name": "codigo_de_plaza" },
            { "data": "documento_de_identidad", "name": "documento_de_identidad" },
            { "data": "codigo_modular", "name": "codigo_modular" },
            { "data": "apellidos_nombres", "name": "apellidos_nombres" },
            { "data": "categoria_remunerativa", "name": "categoria_remunerativa" },
            { "data": "fecha_de_ingreso", "name": "fecha_de_ingreso" },
            { "data": "fecha_de_nacimiento", "name": "fecha_de_nacimiento" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_nexus'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {




        },

        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_nexus').dataTable().fnFilter(this.value);
                }
            });
        }

    });

});



function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "gestionnexus/licencias/" + xsmart;
        ;
    } else {
        errordialogtablecuriosity();
    }
}


