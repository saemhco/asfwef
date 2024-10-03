$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_registrosolicitudesalumnosbecas = $("#tbl_registrosolicitudesalumnosbecas").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "Gestionsolicitudes/datatableSolicitudesrecibidasbecas", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[7, "desc"]],
        "columnDefs": [
            {"width": "8", "targets": 6},
            {
                "targets": 6,
                "className": "text-center"
            },
            {"width": "10.8%", "targets": 7}
        ],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha", "name": "fecha"},
            {"data": "codigo", "name": "codigo"},
            {"data": "fullname", "name": "fullname"},
            {"data": "tipo_solicitud", "name": "tipo_solicitud"},
            {"data": "mensaje", "name": "mensaje"},
            {"data": "archivo", "name": "archivo"},
            {"data": "estado", "name": "estado"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_registrosolicitudesalumnosbecas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var fecha_ini_r1 = data.fecha.split(" ");
            //console.log(res_fecha_ini[0]);

            var fecha_ini_result1 = fecha_ini_r1[0].split("-");
            //console.log(fecha_ini_result1[2]);

            var hora_date = fecha_ini_r1[1].split("-");

            var fecha_ini_result2 = fecha_ini_result1[2] + '/' + fecha_ini_result1[1] + '/' + fecha_ini_result1[0];
            $('td', row).eq(1).html(fecha_ini_result2 + " - " + hora_date);


            var mensaje = "";
            mensaje = "<button onclick='mensaje(" + data.semestre + "," + data.alumno + "," + data.numero + ")' class='btn btn-xs btn-success' ><i class='fa fa-comments'></i></button>";
            $('td', row).eq(5).html(mensaje);
            
            var archivo = data.archivo;
            if (archivo !== null) {
                var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/solicitudes/becas/FILE-BE-" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                $('td', row).eq(6).html(archivo);
            }




            var estado = "";
            if (data.estado === 1) {

                estado = "<button  onclick='aprobar(" + data.semestre + "," + data.alumno + "," + data.numero + ")' class='btn btn-xs btn-primary'>Aprobar</button>\n\
                    <button  class='btn btn-xs btn-warning' onclick='denegar(" + data.semestre + "," + data.alumno + "," + data.numero + ")' >Denegar</button>";

            } else if (data.estado === 2) {
                //estado = '<h4><span class="label label-success">Aprobado </span></h4>';
                estado = "<button class='btn btn-xs btn-success' style = 'pointer-events: none;'>Aprobado</button>";

            } else if (data.estado === 3) {
                //estado = '<h4><span class="label label-danger">Denegado </span></h4>';
                estado = "<button class='btn btn-xs btn-danger' style = 'pointer-events: none;'>Denegado</button>";
            }
            $('td', row).eq(7).html(estado);


        }
    }
    );

});

//mensaje
function mensaje(semestre, alumno, numero) {
    $.ajax({
        url: base_url + "gestionsolicitudes/mensajebeca",
        type: 'POST',
        data: {"semestre": semestre, "alumno": alumno, "numero": numero},
        success: function (response) {

            $('#descripcion').val(response.mensaje);
            $("#modal_mensaje").modal("show");
        }
    });
}

//aprobar
function aprobar(semestre, alumno, numero) {
    bootbox.confirm("<strong>¿Esta seguro que desea aprobar?</strong>", function (result) {
        if (result === true) {
            //console.log(result);
            $.ajax({
                url: base_url + "gestionsolicitudes/aprobarbeca",
                type: 'POST',
                data: {"semestre": semestre, "alumno": alumno, "numero": numero},
                success: function (response) {
                    if (response.say === "yes") {
                        $('#tbl_registrosolicitudesalumnosbecas').dataTable().fnDraw();
                    } else if (response.say === "no_start") {
                        //alert("error");\
                        bootbox.alert("<strong>Alumno aún no ha inicado el proceso de matrícula</strong>");
                    }
                }
            });
        }

    });
}

//denegar
function denegar(semestre, alumno, numero) {
    bootbox.confirm("<strong>¿Está seguro que desea aprobar?</strong>", function (result) {
        if (result === true) {
            //console.log(result);
            $.ajax({
                url: base_url + "gestionsolicitudes/denegarbeca",
                type: 'POST',
                data: {"semestre": semestre, "alumno": alumno, "numero": numero},
                success: function (response) {
                    if (response.say === "yes") {
                        $('#tbl_registrosolicitudesalumnosbecas').dataTable().fnDraw();
                    } else if (response.say === "no_start") {
                        //alert("error");
                        bootbox.alert("<strong>Alumno aún no ha inicado el proceso de matrícula</strong>");
                    }
                }
            });
        }

    });


}

