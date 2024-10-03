$(document).ready(function () {

    console.log(id_actividad)
    //alert("Hola Mundo");

//    var editor = CKEDITOR.replace('descripcion_ckeditor', {
//        // Define the toolbar groups as it is a more accessible solution.
//        toolbar_Basic: [
//            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
//            {name: 'styles', items: ['Format', 'Font', 'FontSize']},
//            {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
//            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
//            {name: 'document', items: ['Source']}
//        ],
//        toolbar_Full: [
//            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
//            {name: 'styles', items: ['Format', 'Font', 'FontSize']},
//            {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
//            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
//            {name: 'document', items: ['Source']}
//        ],
//        toolbar: 'Full',
//        //alto texarea ckeditor
//        height: '150px'
//    });

    if (id_actividad !== 0) {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        tbl_actividades_detalles = $("#tbl_actividades_detalles").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "consultaactividades/datatableActividadesDetalles/" + id_actividad, "type": "POST"},
            "processing": false,
            "serverSide": true,
            //Desactivamos buscador
            //"searching": false,
            //Desactivamos Show inicio
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
                {"data": "turno", "name": "turno"},
                {"data": "descripcion", "name": "descripcion"}
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
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_actividades_detalles'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {

        
            }
        });

    }

    //valida enter
    $("#form_servicios .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


});
