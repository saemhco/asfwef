$(document).ready(function () {

    var fecha_inicio = moment().format('DD/MM/YYYY');
    $("#input-fecha_desde").val(fecha_inicio);

    var fecha_fin = moment().add(1, 'days').format('DD/MM/YYYY');
    $("#input-fecha_hasta").val(fecha_fin);

    $("#btn-registrar-personal").on("click", function () {

        console.log("fecha_desde: " + $("#input-fecha_desde").val());
        console.log("fecha_hasta: " + $("#input-fecha_hasta").val());

        var f_d = moment($("#input-fecha_desde").val(), 'DD/MM/YYYY').format('DD-MM-YYYY');
        var f_h = moment($("#input-fecha_hasta").val(), 'DD/MM/YYYY').format('DD-MM-YYYY');


        var fecha_desde = f_d;
        var fecha_hasta = f_h;

        $.ajax({
            type: 'POST',
            url: base_url + "gestionasistencias3/saveRegistrarPersonal",
            data: { fecha_desde: fecha_desde, fecha_hasta: fecha_hasta },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say === "yes") {

                    bootbox.alert("<strong>Se registró correctamente</strong>");
                    $('#tbl_web_personal_marcaciones').dataTable().fnDraw();

                }
                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_autores").dialog("open");
            }
        });

    });


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_web_personal_marcaciones = $("#tbl_web_personal_marcaciones").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionasistencias3/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "fecha_format", "name": "fecha_format" },
            { "data": "personal", "name": "personal" },
            { "data": "horario_ingreso_1", "name": "horario_ingreso_1" },
            { "data": "horario_salida_1", "name": "horario_salida_1" },
            { "data": "horario_ingreso_2", "name": "horario_ingreso_2" },
            { "data": "horario_salida_2", "name": "horario_salida_2" },
            { "data": "ingreso_1", "name": "ingreso_1" },
            { "data": "salida_1", "name": "salida_1" },
            { "data": "ingreso_2", "name": "ingreso_2" },
            { "data": "salida_2", "name": "salida_2" },
            { "data": "estado", "name": "estado" }
        ],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {
            //"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json",
            'search': 'asas' /*Empty to remove the label*/,
            "searchPlaceholder": "Ingrese el texto a buscar y presione enter ...",
            "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_web_personal_marcaciones'), breakpointDefinition);
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
            $('td', row).eq(11).html(html_estado);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_web_personal_marcaciones').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    $("#input-buscar").on("click", function () {
        console.log("Testing by @KeMack");
        var fecha_inicio1 = $("#input-fecha_desde").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_hasta").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);

        

        var responsiveHelper_dt_basic = undefined;
        $('#tbl_web_personal_marcaciones').DataTable().destroy();

        tbl_web_personal_marcaciones = $("#tbl_web_personal_marcaciones").DataTable({
            "stateSave": true,
            "ajax": { "url": base_url + "gestionasistencias3/datatable/" + fecha_inicio + "/" + fecha_fin, "type": "POST" },
            "processing": false,
            "serverSide": true,
            "order": [[2, "asc"], [3, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
                { "data": "fecha_format", "name": "fecha_format" },
                { "data": "personal", "name": "personal" },
                { "data": "horario_ingreso_1", "name": "horario_ingreso_1" },
                { "data": "horario_salida_1", "name": "horario_salida_1" },
                { "data": "horario_ingreso_2", "name": "horario_ingreso_2" },
                { "data": "horario_salida_2", "name": "horario_salida_2" },
                { "data": "ingreso_1", "name": "ingreso_1" },
                { "data": "salida_1", "name": "salida_1" },
                { "data": "ingreso_2", "name": "ingreso_2" },
                { "data": "salida_2", "name": "salida_2" },
                { "data": "estado", "name": "estado" }
            ],
            "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "language": {
                //"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json",
                'search': 'asas' /*Empty to remove the label*/,
                "searchPlaceholder": "Ingrese el texto a buscar y presione enter ...",
                "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"
            },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_web_personal_marcaciones'), breakpointDefinition);
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
                $('td', row).eq(11).html(html_estado);

            },
            initComplete: function () {
                //reinicia start
                $(this).DataTable().page(0).draw(true);
                //Busqueda al dar enter
                $('div.dataTables_filter input').unbind();
                $('div.dataTables_filter input').bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        $('#tbl_web_personal_marcaciones').dataTable().fnFilter(this.value);
                    }
                });
            }
        });
    });
});


