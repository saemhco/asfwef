$(document).ready(function () {

    //alert("Hola Mundo");
    //alert("llega: "+id_personal_areas);

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_recursostic = $("#tbl_recursostic").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionrecursostic/datatableRecursostic/" + id_personal_areas, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},

            {"data": "tipo_nombre", "name": "tipo_nombre"},            
            {"data": "usuario", "name": "usuario"},
            {"data": "nombre_equipo", "name": "nombre_equipo"},
            {"data": "marca", "name": "marca"},
            {"data": "modelo", "name": "modelo"},
            {"data": "serie", "name": "serie"},
            {"data": "color", "name": "color"},   
            {"data": "teamviewer", "name": "teamviewer"},
            {"data": "anydesk", "name": "anydesk"},
            {"data": "ip", "name": "ip"},                                 
            {"data": "pae_estado", "name": "pae_estado"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_recursostic'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {
            var html_estado = "";
            if (data.pae_estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.pae_estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(10).html(html_estado);

        }
    });



    //valida enter
    $("#form_computadoras .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter




});


