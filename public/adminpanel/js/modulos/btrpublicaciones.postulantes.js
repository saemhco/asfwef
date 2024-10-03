$(document).ready(function () {

    //alert("Publicaciones.postulantes.js");

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_postulantes").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "btrpublicaciones/tblpostulantes/" + idx, "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "tipo_alumno", "name": "tipo_alumno", "width": "12%"},
            {"data": "fullname", "name": "fullname"},
            {"data": "dni", "name": "dni"},
            {"data": "celular_alumno", "name": "celular_alumno"},
            {"data": "email_alumno", "name": "email_alumno"},
            {"data": "cv", "name": "cv"},
            {"data": "codigo_postulacion", "name": "codigo_postulacion", "width": "13%"}],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_postulantes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            var html = "";

            var ref = "";
            if (data.cv_referencia != "") {
                ref = 1;
            }

            html = "<a role='button' class='btn btn-xs btn-info' target='_BLANK' href='" + base_url + "btrpublicaciones/descarga/" + data.codigo_postulacion + "/" + idx + "/" + ref + "' > <i class='fa fa-download' ></i></a>";

            var html2 = "";

            if (data.estado == 1) {

                if (perfil == "1") {
                    html2 = '<h4><span class="label label-warning">Pendiente</span></h4>';
                } else {
                    html2 = "<button  onclick='aceptar(" + data.codigo_postulacion + ")' class='btn btn-xs btn-primary' >Aceptar</button>\n\
                    <button  class='btn btn-xs btn-warning' onclick='rechazar(" + data.codigo_postulacion + ")' >Rechazar</button>";
                }


            } else {
                if (data.estado == 2) {
                    html2 = '<h4><span class="label label-success">Apto </span></h4>';
                } else {
                    html2 = '<h4><span class="label label-danger">No Apto</span></h4>';
                }
            }



            $('td', row).eq(5).html(html);
            $('td', row).eq(6).html(html2);

        }
    }
    );


});

function aceptar(iduser) {
    $.ajax({
        url: base_url + "btrpublicaciones/aplica",
        type: 'POST',
        data: {"alumno": iduser, "empleo": idx, "aplica": 2},
        success: function (msg) {
            console.log(msg)

            if (msg.say === "yes") {
                $('#tbl_postulantes').dataTable().fnDraw();
            } else {
                alert("error");
            }


        }
    });
}

function rechazar(iduser) {
    $.ajax({
        url: base_url + "btrpublicaciones/aplica",
        type: 'POST',
        data: {"alumno": iduser, "empleo": idx, "aplica": 3},
        success: function (msg) {

            if (msg.say === "yes") {
                $('#tbl_postulantes').dataTable().fnDraw();
            } else {
                alert("error");
            }
        }
    });
}