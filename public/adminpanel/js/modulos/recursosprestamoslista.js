$(document).ready(function () {

//Abrimos el modal de lectores
    $("#open_modalusuarios").on("click", function () {
        $("#modalusuarios").dialog("open");
    });

    //Abrimos el modal de libros
    $("#open_modalrecursos").on("click", function () {
        $("#modalrecursos").dialog("open");
    });


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_prestamos = $("#tbl_prestamos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "recursosprestamoslista/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

            {"data": "apellidos_nombres", "name": "apellidos_nombres"},
            {"data": "codigos", "name": "codigos"},
            {"data": "tipo_usuario", "name": "tipo_usuario"},
            {"data": "hora_entrada", "name": "hora_entrada"},
            {"data": "hora_salida", "name": "hora_salida"},
            {"data": "fecha_prestamo_recurso", "name": "fecha_prestamo_recurso"},
            {"data": "id_recurso_prestamo", "name": "id_recurso_prestamo"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_prestamos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            //hora entrada
            var he = data.hora_entrada;
            var v_he = he.split("-05");
            var r_he = v_he[0];
            $('td', row).eq(4).html(r_he);

            //Hora de salida
            var hs = data.hora_salida;
            var v_hs = hs.split("-05");
            var r_hs = v_hs[0];
            $('td', row).eq(5).html(r_hs);


            //Fecha prestamopc
            var str = data.fecha_prestamo_recurso;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0];
            //console.log(respuesta);
            $('td', row).eq(6).html(respuesta);


            var ver = "";
            var confirmar = "";
            ver = "<button onclick='ver(" + data.id_recurso_prestamo + ")' class='btn btn-xs btn-warning' >Ver</i></button>";
            $('td', row).eq(7).html(ver);


        }
    });


    $("#publicar").on("click", function () {
        frm = $("#form_prestamospcs");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {

                    bootbox.alert("<strong>Se registró correctamente</strong>");
                    window.location.href = base_url + "prestamospcs";


                } else {

                    console.log("llegamos a la disco");
                    $(".errorforms").remove();


                    $.each(result, function (i, val) {

                        $("#input-" + i).focus();
                        $("#input-" + i).after(val);

                    });
                }
            }
        });
    });


});

function ver(codigo) {
    $.ajax({
        url: base_url + "recursosprestamos/aplica",
        type: 'POST',
        data: {"codigo": codigo},
        success: function (msg) {



            //recorre la funcion del controlador prestamoscontroller
            var html = '';
            $.each(msg.recursos, function (i, val) {
                html = html + '<tr>';
                //html = html+'<td>'+val.cuota+'</td>';
                // html = html+'<td><input name="montoc[]"   type="text" value="'+val.monto+'"></td>';
                // html = html+'<td><input name="fechai[]"   type="text" class="datepicker2" value="'+val.fechai+'"></td>';
                // html = html+'<td><input name="fechaend[]" type="text" class="datepicker2" value="'+val.fechaend+'"></td>';
                html = html + '<td>' + val.descripcion + '</td>';
                html = html + '<td>' + val.modelo + '</td>';
                html = html + '<td>' + val.serie + '</td>';
                html = html + '</tr>';

            });
            //console.log(html);

//creamos la tabla e insertamos con la funcion appesnd
            $('#tbody_computadoras').empty();
            $('#tbody_computadoras').append(html);
            $("#modalver").modal("show");




            // alert("Hola Mundo");

        }
    });
}
