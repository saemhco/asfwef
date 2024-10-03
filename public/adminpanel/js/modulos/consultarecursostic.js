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


    tbl_recursos_tic = $("#tbl_recursos_tic").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "consultarecursostic/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        'columnDefs': [
            {
                "targets": 7,
                "className": "text-center"
            }],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            //{"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            { "data": "personal_area", "name": "personal_area" },
            { "data": "tipo_nombre", "name": "tipo_nombre" },
            { "data": "patrimonial", "name": "patrimonial" },
            { "data": "usuario", "name": "usuario" },
            { "data": "nombre_equipo", "name": "nombre_equipo" },
            { "data": "marca", "name": "marca" },
            { "data": "modelo", "name": "modelo" },
            { "data": "serie", "name": "serie" },
            { "data": "color", "name": "color" },
            { "data": "teamviewer", "name": "teamviewer" },
            { "data": "anydesk", "name": "anydesk" },
            { "data": "ip", "name": "ip" },
            { "data": "pae_estado", "name": "pae_estado" }

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_recursos_tic'), breakpointDefinition);
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
            $('td', row).eq(12).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_recursos_tic').dataTable().fnFilter(this.value);
                }
            });
        }
    });


    //valida enter
    $("#form_convocatorias .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


    $("#form_reporte_pdf").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
                html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
                "class": "btn btn-primary",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#form_reporte_xls").dialog({
        autoOpen: false,
        height: "auto",
        width: "500px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Reporte </h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
                html: "<i class='fa fa-times'></i>&nbsp; Cerrar",
                "class": "btn btn-primary",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

});



function reporte_pdf() {
    $(".errorforms").remove();
    $("#form_reporte_pdf")[0].reset();

    $("#form_reporte_pdf").dialog("open");
}

function reporte_consultarecursostic_pdf() {
    $(".errorforms").remove();
    window.open(base_url + "reportes/reporteconsultarecursostic");
}

function reporte_xls() {
    $(".errorforms").remove();
    $("#form_reporte_xls")[0].reset();

    $("#form_reporte_xls").dialog("open");
}

function reporte_consultarecursostic_xls() {
    $(".errorforms").remove();

    window.open(base_url + "exportar/exportarconsultarecursostic");

}









