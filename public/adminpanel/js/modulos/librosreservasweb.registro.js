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

    tbl_usuario = $("#tbl_postulaciones").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "librosreservasweb/datatableregistro", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},

            {"data": "titulo", "name": "l.titulo"},
            //{"data": "autor", "name": "au.descripcion"},
            {"data": "fecha_reserva", "name": " p.fecha_reserva"},
            {"data": "estado", "name": " p.estado"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_postulaciones'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {
            console.log(data.estado);
            var html2 = "";

            var str = data.fecha_reserva;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0];
            //console.log(respuesta);
            $('td', row).eq(1).html(respuesta);



            //Estado del prestamo
            if (data.estado === 1) {
                
                html2 = '<span class="label label-warning">Pendiente</span>';
                
            }else if(data.estado === 2) {

                html2 = '<span class="label label-success">Aceptado</span>';
            }else if(data.estado === 3) {

                html2 = '<span class="label label-success">Devuelto</span>';

            }else if(data.estado === 4){
                html2 = '<span class="label label-danger">Rechazado</span>';
            }



            $('td', row).eq(2).html(html2);
            //}else{
            //     $('td', row).eq(7).html('<button onclick="anadirrep('+data.id+')" class="btn btn-xs btn-info" title="añadir representante" ><i class="fa fa-user"></i></button>');
            // }
        }
    }
    );


});

