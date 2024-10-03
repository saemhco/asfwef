$(document).ready(function () {


//alert("Hola Mundo");



    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };



    tbl_formatos = $("#tbl_formatos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "licenciamiento/datatableFormatossunedu", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "nombre", "name": "nombre"},
            {"data": "archivo", "name": "archivo"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_formatos'), breakpointDefinition);
            }
        },
        "columnDefs": [
            {"width": "70px", "targets": 2}
        ],
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var pdf = '';
            var excel = '';
            var enlace = '';

            if (String(data.archivo).length > 9) {
                var pdf = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/formatos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            }
            if (String(data.archivo2).length > 9) {
                var excel = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/formatos/" + data.archivo2 + "' >   <i class='fa fa-file-excel-o' ></i></a>";
            }
            if (String(data.enlace).length > 9) {
                var enlace = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' id='archivo_medios' href='" + data.enlace + "'  >   <i class='fa fa-link' ></i></a>";
            }

            var html = pdf + ' ' + excel + ' ' + enlace;

            $('td', row).eq(2).html(html);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_formatos').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //valida enter
    $("#form_formatos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});

