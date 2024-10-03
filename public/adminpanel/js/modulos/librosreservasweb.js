$(document).ready(function () {

    //Abrimos el modal de lectores

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
        "ajax": { "url": base_url + "librosreservasweb/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "alumno", "name": "alumno" },
            { "data": "codigo_lector", "name": "codigo_lector" },
            { "data": "lector", "name": "lector" },
            { "data": "fecha_reserva", "name": "fecha_reserva" },
            { "data": "prestamo", "name": "prestamo" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_prestamos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var str = data.fecha_reserva;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0];
            //console.log(respuesta);
            $('td', row).eq(4).html(respuesta);



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




            //if( data.tipo_inquilino_id == "1") {  
            var ver = "";
            var confirmar = "";

            ver = "<button onclick='ver(" + data.prestamo + ")' class='btn btn-xs btn-success' ><i class='fa fa-book'></i></button> \n\
                <button class='btn btn-xs btn-primary' onclick='confirmar(" + data.prestamo + ")' >Confirmar</button>\n\
                <button class='btn btn-xs btn-danger' onclick='rechazar(" + data.prestamo + ")' >Rechazar</button>";
            $('td', row).eq(5).html(ver);

            //}else{
            //     $('td', row).eq(7).html('<button onclick="anadirrep('+data.id+')" class="btn btn-xs btn-info" title="añadir representante" ><i class="fa fa-user"></i></button>');
            // }
        }
    });





    //form confirmar
    $("#form_confirmar").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Asignar Fecha de Devolución</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }, {
            //le agregas  "id","graba" Para validar lo del enter
            html: "<i class='fa fa-save'></i>&nbsp; Grabar", "id": "graba",
            "class": "btn btn-info",
            click: function () {

                var date = new Date();
                var fecha_actual =  zero(date.getDate()) + "/" + zero(date.getMonth() + 1) + "/" + date.getFullYear() ;
                //alert(fecha_actual);
                var fecha_devolucion = new Date($("#input-fecha_devolucion").val());
                const fecha_a = moment(fecha_actual,'DD/MM/YYYY')
                const fecha_d = moment($("#input-fecha_devolucion").val(),'DD/MM/YYYY')

                //fecha de devolucion tiene que ser mauor a la fecha actual
                if (fecha_devolucion !== '') {
                    if (fecha_d.isSameOrAfter(fecha_a)) {

                        //console.log('se va a la validacion');


                        frm = $("#form_confirmar");
                        $.ajax({
                            url: frm.attr("action"),
                            type: 'POST',
                            data: frm.serialize(),
                            success: function (msg) {
                                var result = msg;
                                if (result.say === "yes") {
                                    $("#form_confirmar").dialog("close");
                                    bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                        $('#tbl_prestamos').dataTable().fnDraw();
                                    });
                                } else {
                                    console.log("llegamos a la disco");
                                    $(".errorforms").remove();

                                    $.each(result, function (i, val) {
                                        //$("#input-" + i).focus();
                                        $("#input-" + i).blur();
                                        $("#input-" + i).after(val);
                                    });
                                }
                            }
                        });
                    } else {
                        $(".errorforms").remove();
                        var val = '<div class="text-danger errorforms">La fecha de devolución debe ser mayor</div>';
                        $("#input-fecha_devolucion").after(val);
                    }
                } else {
                    $(".errorforms").remove();
                    var val = '<div class="text-danger errorforms">La fecha de devolución es requerido</div>';
                    $("#input-fecha_devolucion").after(val);
                }

            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

    $("#form_reporte_pdf").dialog({
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
    //form rechazar
    $("#form_rechazar").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Asignar Observacion</h4></div>",
        show: {
            effect: "slide",
            duration: 400
        },
        hide: {
            effect: "fold",
            duration: 400
        },
        buttons: [{
            html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }, {
            //le agregas  "id","graba" Para validar lo del enter
            html: "<i class='fa fa-save'></i>&nbsp; Grabar", "id": "graba",
            "class": "btn btn-info",
            click: function () {

                frm = $("#form_rechazar");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {

                            $("#form_rechazar").dialog("close");
                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                $('#tbl_prestamos').dataTable().fnDraw();
                            });
                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();

                            $.each(result, function (i, val) {
                                //$("#input-" + i).focus();
                                $("#input-" + i).blur();
                                $("#input-" + i).after(val);
                            });
                        }
                    }
                });

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


});


function ver(id_prestamo) {
    $.ajax({
        url: base_url + "librosreservasweb/ver",
        type: 'POST',
        data: { "id_prestamo": id_prestamo },
        success: function (msg) {

            //recorre la funcion del controlador prestamoscontroller             
            var html = '';
            $.each(msg.prestamos, function (i, val) {
                html = html + '<tr class="success">';
                //html = html+'<td>'+val.cuota+'</td>';
                // html = html+'<td><input name="montoc[]"   type="text" value="'+val.monto+'"></td>';
                // html = html+'<td><input name="fechai[]"   type="text" class="datepicker2" value="'+val.fechai+'"></td>';
                // html = html+'<td><input name="fechaend[]" type="text" class="datepicker2" value="'+val.fechaend+'"></td>';                 html = html + '<td>' + val.titulo + '</td>';                 html = html + '</tr>';
                html = html + '<td>' + val.titulo + '</td>';
                html = html + '<td>' + val.numero + '</td>';
                html = html + '</tr>';
            });
            console.log(html);

            //creamos la tabla e insertamos con la funcion appesnd
            $('#tbody_libros').empty();
            $('#tbody_libros').append(html);
            $("#modalver").modal("show");


        }
    });
}



function zero(n) {
    return (n > 9 ? '' : '0') + n;
}

function confirmar(prestamo) {
    //Limpia los errores y resetea los valores de los campos
    //$("#input-fecha_devolucion").blur();
    $(".errorforms").hide();
    $('#prestamo').val(prestamo);
    $("#form_confirmar")[0].reset();
    $("#form_confirmar").dialog("open");
}

function rechazar(prestamo) {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $('#prestamo_rechazado').val(prestamo);
    $("#form_rechazar")[0].reset();
    $("#form_rechazar").dialog("open");
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

function reporte_librosreservasweb_pdf() {
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
        window.open(base_url + "reportes/reportelibrosreservasweb/" + fecha_inicio + "/" + fecha_fin);
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

function reporte_librosreservasweb_xls() {
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
        window.open(base_url + "exportar/exportarlibrosreservasweb/" + fecha_inicio + "/" + fecha_fin);
    }
}