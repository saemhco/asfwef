$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

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
        "ajax": {"url": base_url + "librosprestamosweb/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "alumno", "name": "alumno"},
            {"data": "codigo_lector", "name": "codigo_lector"},
            {"data": "lector", "name": "lector"},
            {"data": "fecha_entrega", "name": "fecha_entrega"},
            {"data": "fecha_devolucion", "name": "fecha_devolucion"},
            {"data": "codigos", "name": "codigos"}

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


            //Fecha de entrega
            //console.log(data.fecha_entrega);

            if (data.fecha_entrega) {
                var str = data.fecha_entrega;
                //split igual explode php
                var res = str.split("-");
                //recorremos el array por las posiciones
                var respuesta = res[2] + '/' + res[1] + '/' + res[0];
                //console.log(respuesta);
            } else {
                var respuesta = '-';
            }

            $('td', row).eq(4).html(respuesta);


            var str = data.fecha_devolucion;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0];
            //console.log(respuesta);
            $('td', row).eq(5).html(respuesta);

            if ($.trim(data.alumno) === '1') {

                //console.log(data.alumno);
                var r_alumno = "ALUMNO";
                $('td', row).eq(1).html(r_alumno);
            }

            if ($.trim(data.docente) === '1') {

                //console.log(data.alumno);
                var r_alumno = "DOCENTE";
                $('td', row).eq(1).html(r_alumno);
            }

            if ($.trim(data.publico) === '1') {

                //console.log(data.alumno);
                var r_alumno = "PUBLICO";
                $('td', row).eq(1).html(r_alumno);
            }




            var ver = "";

            ver = "<button onclick='ver(" + data.codigo + ")' class='btn btn-xs btn-success' ><i class='fa fa-book'></i></button> \n\
                <button class='btn btn-xs btn-primary' onclick='devolver(" + data.codigo + ")' >Devolver</button>";
            $('td', row).eq(6).html(ver);

        }
    });

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

    $("#publicar").on("click", function () {
        frm = $("#form_empleos");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert("<strong>Se registró correctamente</strong>")
                    window.location.href = base_url + "listaprestamos";

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

function ver(id_prestamo) {

    //alert(prestamo);

    $.ajax({
        url: base_url + "librosprestamosweb/aplica",
        type: 'POST',
        data: {"id_prestamo": id_prestamo},
        success: function (msg) {



            //recorre la funcion del controlador listaprestamoscontroller
            var html = '';
            $.each(msg.prestamos, function (i, val) {
                html = html + '<tr class="success">';
                //html = html+'<td>'+val.cuota+'</td>';
                // html = html+'<td><input name="montoc[]"   type="text" value="'+val.monto+'"></td>';
                // html = html+'<td><input name="fechai[]"   type="text" class="datepicker2" value="'+val.fechai+'"></td>';
                // html = html+'<td><input name="fechaend[]" type="text" class="datepicker2" value="'+val.fechaend+'"></td>';
                html = html + '<td>' + val.titulo + '</td>';
                html = html + '<td>' + val.numero + '</td>';
                html = html + '</tr>';

            });
            //console.log(html);

            //creamos la tabla e insertamos con la funcion appesnd
            $('#tbody_libros').empty();
            $('#tbody_libros').append(html);
            $("#modalver").modal("show");

            // alert("Hola Mundo");

        }
    });
}

function devolver(id_prestamo) {
    bootbox.confirm({
        message: "<strong>¿Está seguro que desea devolver el libro?</strong>",
        buttons: {
            confirm: {
                label: 'Aceptar',
                className: 'btn-primary'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            //console.log('This was logged in the callback: ' + result);
            if (result === true) {
                $.ajax({
                    url: base_url + "librosprestamosweb/devolver",
                    type: 'POST',
                    data: {"id_prestamo": id_prestamo},
                    success: function (msg) {

                        if (msg.say == "yes") {
                            //$('#tbl_postulantes').dataTable().fnDraw();

         
                            bootbox.alert("<strong>El libro se devolvió correctamente</strong>", function () {
                                $('#tbl_prestamos').dataTable().fnDraw();
                            });

                        } else {
                            alert("error");
                        }
                    }
                });
            }
        }
    });

}



function reporte_pdf() {
    $(".errorforms").remove();
    $("#form_reporte_pdf")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_pdf").val(fecha_fin_pdf);

    $("#form_reporte_pdf").dialog("open");
}

function reporte_librosprestamosweb_pdf() {
    $(".errorforms").remove();
    if ($("#input-fecha_inicio_pdf").val() === "" || $("#input-fecha_fin_pdf").val() === "") {
        //console.log("Entra Aqui");
        if ($("#input-fecha_inicio_pdf").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
            $("#input-fecha_inicio_pdf").after(val);
        }
        if ($("#input-fecha_fin_pdf").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
            $("#input-fecha_fin_pdf").after(val);
        }
    } else {
        var fecha_inicio1 = $("#input-fecha_inicio_pdf").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_pdf").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);
        window.open(base_url + "reportes/reportelibrosprestamosweb/" + fecha_inicio + "/" + fecha_fin);
    }
}


function reporte_xls() {
    $(".errorforms").remove();
    $("#form_reporte_xls")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_xls").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_xls").val(fecha_fin_pdf);

    $("#form_reporte_xls").dialog("open");
}

function reporte_librosprestamosweb_xls() {
    $(".errorforms").remove();
    if ($("#input-fecha_inicio_xls").val() === "" || $("#input-fecha_fin_xls").val() === "") {
        //console.log("Entra Aqui");
        if ($("#input-fecha_inicio_xls").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha inicio</div>';
            $("#input-fecha_inicio_xls").after(val);
        }
        if ($("#input-fecha_fin_xls").val() === "") {
            var val = '<div class="text-danger errorforms">Ingresar fecha fin</div>';
            $("#input-fecha_fin_xls").after(val);
        }
    } else {
        var fecha_inicio1 = $("#input-fecha_inicio_xls").val();
        fecha_inicio = moment(fecha_inicio1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_incio:" + fecha_inicio);
        var fecha_fin1 = $("#input-fecha_fin_xls").val();
        fecha_fin = moment(fecha_fin1, 'DD/MM/YYYY').format('YYYY-MM-DD');
        console.log("fecha_fin:" + fecha_fin);
        window.open(base_url + "exportar/exportarlibrosprestamosweb/" + fecha_inicio + "/" + fecha_fin);
    }
}
