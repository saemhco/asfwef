$(document).ready(function () {

    //Abrimos el modal de lectores
    $("#open_modallectores").on("click", function () {
        $("#modallectores").dialog("open");
    });

    //Abrimos el modal de libros
    $("#open_modallibros").on("click", function () {
        $("#modallibros").dialog("open");
    });







    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_usuario = $("#tbl_prestamos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "librosprestamos/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "alumno", "name": "alumno" },
            { "data": "codigo_lector", "name": "codigo_lector" },
            { "data": "lector", "name": "lector" },
            { "data": "tipo", "name": "tipo" },
            { "data": "fecha_entrega", "name": "fecha_entrega" },
            { "data": "fecha_devolucion", "name": "fecha_devolucion" },
            { "data": "codigos", "name": "codigos" }

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


            //Fecha de entrega
            console.log(data.fecha_entrega);

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
            let modalidad  = "";
            switch(data.tipo){
                case 2:
                    modalidad="SALA";
                    break;
                case 3:
                    modalidad="CASA";
                    break;
                default:
                    modalidad="";
            }
            $('td', row).eq(4).html(modalidad);

            $('td', row).eq(5).html(respuesta);


            var str = data.fecha_devolucion;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0];
            //console.log(respuesta);
            $('td', row).eq(6).html(respuesta);

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
            var confirmar = "";

            ver = "<button onclick='ver(" + data.codigo + ")' class='btn btn-xs btn-success' >Ver</button> \n\
                <button class='btn btn-xs btn-primary' onclick='devolver(" + data.codigo + ")' >Devolver</button>";
            $('td', row).eq(7).html(ver);

        }
    });


    $("#publicar").on("click", function () {
        frm = $("#form_prestamos");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes") {

                    bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                        window.location.href = base_url + "librosprestamos";
                    });


                } else {

                    console.log("llegamos a la disco");
                    $(".errorforms").remove();


                    $.each(result, function (i, val) {

                        //$("#input-" + i).focus();
                        console.log(i);

                        if (i === 'codigos') {
                            var val = '<div class="text-danger errorforms">Los datos del lector son requeridos click en buscar ------------></div>';
                            $("#lector_nombres").after(val);
                        } else if (i === 'codigo') {
                            var val = '<div class="text-danger errorforms">Debe añadir al menos un libro</div>';
                            $("#error_insert_libros").html(val);
                        } else {
                            $("#input-" + i).after(val);
                        }



                    });
                }
            }
        });
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
//datatables libros
var oTable2 = $("#tbl_libros");
oTable2.DataTable({
    "ajax": { "url": base_url + "librosprestamos/datatablelibros", "type": "POST" },
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
        { "data": "codigo", "name": "l.codigo" },
        { "data": "titulo", "name": "l.titulo" },
        { "data": "numero", "name": "libros_ejemplares.numero" },
        { "data": "categoria", "name": " c.descripcion" }
    ],

    "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "autoWidth": true,
    "preDrawCallback": function () {
        // Initialize the responsive datatables helper once.

    }, "createdRow": function (row, data, index) {

        var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_libro + '" id2="' + data.id_ejemplar + '" ><i></i> </label></center>';
        $('td', row).eq(0).html(html);



    }
});


function ver(id_prestamo) {

    $.ajax({
        url: base_url + "librosprestamos/aplica",
        type: 'POST',
        data: { "id_prestamo": id_prestamo },
        success: function (msg) {



            //recorre la funcion del controlador prestamoscontroller
            var html = '';
            $.each(msg.prestamos, function (i, val) {
                html = html + '<tr>';
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



function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "librosprestamos/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
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
                    url: base_url + "librosprestamos/devolver",
                    type: 'POST',
                    data: { "id_prestamo": id_prestamo },
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

function eliminar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        bootbox.dialog({
            message: "<strong>¿ Desea Eliminar este registro ?</strong>",
            title: "Confirmar",
            buttons: {
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "librosprestamos/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_prestamos').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}

//Modal de lectores
$("#modallectores").dialog({
    autoOpen: false,
    //height: "auto",
    width: "820px",
    resizable: false,
    modal: true,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Seleccionar Lector</h4></div>",
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
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("close");
        }
    }, {
        //le agregas  "id","graba" Para validar lo del enter
        html: "<i class='fa fa-check'></i>&nbsp; Seleccionar", "id": "graba",
        "class": "btn btn-info",
        click: function () {

            var xsmart = $('input:radio[name=selrow]:checked').val();
            var perfil = $('input:radio[name=selrow]:checked').attr('pk2');

            //alert(perfil);

            //capturamos el id del check y enviamos a la funcion lectores/getAjax
            //codigo debe tener el mismo nombre en el getajax

            $.post(base_url + "librosprestamos/getAjax", { codigo: xsmart, perfil: perfil }, function (response) {
                console.log(response.lector);
                //$("#input-nombres").val(response.nombres + ' ' + response.apellidop + ' ' + response.apellidom);
                $("#input-perfil").val(response.perfil);
                $("#lector_codigos").text(response.codigo);
                $("#lector_nombres").text(response.lector);

                if (response.perfil === 3) {
                    $("#lector_perfil").text('ALUMNO');
                } else if (response.perfil === 4) {
                    $("#lector_perfil").text('DOCENTE');
                } else if (response.perfil === 5) {
                    $("#lector_perfil").text('PÚBLICO');
                }

            }, 'json');

            //Capturamos el id del lector
            $("#input-codigos").val(xsmart);
            $("#modallectores").dialog("close");

        }
    }],
    close: function () {
        $("#modallectores").dialog("close");
    }
});



//Modal de libros
$("#modallibros").dialog({
    autoOpen: false,
    //height: "auto",
    width: "820px",
    resizable: false,
    modal: true,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Seleccionar Libro</h4></div>",
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
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("close");
        }
    }, {
        //le agregas  "id","graba" Para validar lo del enter
        html: "<i class='fa fa-check'></i>&nbsp; Seleccionar", "id": "graba",
        "class": "btn btn-info",
        click: function () {

            var id1 = $('input:radio[name=selrow]:checked').val();
            var id2 = $('input:radio[name=selrow]:checked').attr('id2');

            //console.log("id_libro:"+xsmart);
            $.post(base_url + "librosprestamos/librosejemplares", { id1: id1, id2: id2 }, function (response) {

                $.each(response, function (i, val) {
                    //console.log(val.titulo);
                    $(".info").remove();
                    var html = "";
                    html = html + "<tr>";
                    html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.codigo + "</strong></td>";
                    html = html + "<td style='vertical-align: middle;text-align: center;'><strong><input type='hidden' name='libros[]' id='" + val.id_libro + "'value='" + val.id_libro +"-"+val.id_ejemplar+"'>" + val.isbn + "</strong></td>";
                    html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.titulo + "</strong></td>";
                    html = html + "<td style='vertical-align: middle;text-align: center;'><strong>" + val.numero + "</strong></td>";
                    html = html + "<td style='vertical-align: middle;text-align: center;'><button type='button' onclick='eliminarlibro($(this))' class='btn btn-xs btn-danger cargacr'><i class='fa fa-trash'></i></button></td>";
                    html = html + "</tr>";
                    $("#tbody-libros").append(html);

                });

            }, 'json');

            $("#modallibros").dialog("close");

        }
    }],
    close: function () {
        $("#modallibros").dialog("close");
    }
});


//datatables de lectores
var oTable = $("#tbl_lectores");
oTable.DataTable({
    "ajax": { "url": base_url + "librosprestamos/datatablelectores", "type": "POST" },
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
        { "data": "perfil", "name": "perfil" },
        { "data": "codigo", "name": "codigo" },
        { "data": "lector", "name": "lector" }
    ],

    "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "autoWidth": true,
    "preDrawCallback": function () {
        // Initialize the responsive datatables helper once.

    },
    "createdRow": function (row, data, index) {

        var html0 = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" pk2="' + data.perfil + '" ><i></i> </label></center>';
        $('td', row).eq(0).html(html0);


        if (data.perfil === 3) {

            //console.log(data.alumno);
            var r_alumno = "ALUMNO";
            $('td', row).eq(1).html(r_alumno);
        }

        if (data.perfil === 4) {

            //console.log(data.alumno);
            var r_alumno = "DOCENTE";
            $('td', row).eq(1).html(r_alumno);
        }

        if (data.perfil === 5) {

            //console.log(data.alumno);
            var r_alumno = "PUBLICO";
            $('td', row).eq(1).html(r_alumno);
        }

    }

});

function eliminarlibro(t) {

    t.parent().parent().remove();

}


function reporte_xls() {
    //console.log(id_personal);
    $(".errorforms").remove();
    $("#form_reporte")[0].reset();
    //$("#input-id_personal").val(id_personal);
    $("#form_reporte").dialog("open");
    //window.open(base_url + "exportar/reportegestionactividades/" + fecha_inicio + "/" + fecha_fin);

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

function reporte_librosprestamos_pdf() {
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
        window.open(base_url + "reportes/reportelibrosprestamos/" + fecha_inicio + "/" + fecha_fin);
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

function reporte_librosprestamos_xls() {
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
        window.open(base_url + "exportar/exportarlibrosprestamos/" + fecha_inicio + "/" + fecha_fin);
    }
}