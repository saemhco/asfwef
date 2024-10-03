$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    
    tbl_personal_areas = $("#tbl_personal_areas").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionrecursostic/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "nombre_area", "name": "nombre_area" },
            { "data": "personal_nombre", "name": "personal_nombre" },
            { "data": "cargo", "name": "cargo" },
            { "data": "estado", "name": "estado" },
            { "data": "estado_a", "name": "estado_a" },
            { "data": "estado_pa", "name": "estado_pa" }

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_personal_areas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(4).html(html_estado);

            var html_estado_a = "";
            if (data.estado_a === 'A') {
                html_estado_a = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado_a === 'X') {
                html_estado_a = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado_a);

            var html_estado_pa = "";
            if (data.estado_pa === 'A') {
                html_estado_pa = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado_pa === 'X') {
                html_estado_pa = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(html_estado_pa);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_personal_areas').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    //valida enter
    $("#form_invproyecto .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter

});

function editar() {

    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        //console.log(xsmart);

        window.location.href = base_url + "gestionrecursostic/registro/" + xsmart;

    } else {
        errordialogtablecuriosity();
    }

}

