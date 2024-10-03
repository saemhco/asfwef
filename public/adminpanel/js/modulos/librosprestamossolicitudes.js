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
        "ajax": {"url": base_url + "librosprestamos/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "nombres", "name": "nombres"},
            {"data": "ap_paterno", "name": "ap_paterno"},
            {"data": "codigo_lector", "name": "codigo_lector"},
            {"data": "alumno", "name": "alumno"},
            {"data": "fecha_entrega", "name": "fecha_entrega"},                      
            {"data": "prestamo_id", "name": "prestamo_id"}
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

            var str = data.fecha_entrega;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0]
            //console.log(respuesta);
            $('td', row).eq(5).html(respuesta);



            if ($.trim(data.alumno) === '1') {

                //console.log(data.alumno);
                var r_alumno = "ALUMNO";
                $('td', row).eq(4).html(r_alumno);
            }

            if ($.trim(data.docente) === '1') {

                //console.log(data.alumno);
                var r_alumno = "DOCENTE";
                $('td', row).eq(4).html(r_alumno);
            }

            if ($.trim(data.publico) === '1') {

                //console.log(data.alumno);
                var r_alumno = "PUBLICO";
                $('td', row).eq(4).html(r_alumno);
            }




            //if( data.tipo_inquilino_id == "1") {  
            var ver = "";
            var confirmar = "";

            ver = "<button onclick='ver(" + data.prestamo_id + ")' class='btn btn-xs btn-success' >Ver</button> \n\
                <button class='btn btn-xs btn-primary' onclick='confirmar(" + data.prestamo_id + ")' >Confirmar</button>";
            $('td', row).eq(6).html(ver);

            //}else{
            //     $('td', row).eq(7).html('<button onclick="anadirrep('+data.id+')" class="btn btn-xs btn-info" title="añadir representante" ><i class="fa fa-user"></i></button>');
            // }
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
                if (result.say === "yes")
                {

                    bootbox.alert("<strong>Se registró correctamente</strong>")
                    window.location.href = base_url + "prestamos";


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



    //otras tablas



});


function ver(prestamo_id) {
    $.ajax({
        url: base_url + "librosprestamos/aplica",
        type: 'POST',
        data: {"prestamo_id": prestamo_id},
        success: function (msg) {



            //recorre la funcion del controlador prestamoscontroller
            var html = '';
            $.each(msg.alquileres, function (i, val) {
                html = html + '<tr>';
                //html = html+'<td>'+val.cuota+'</td>';
                // html = html+'<td><input name="montoc[]"   type="text" value="'+val.monto+'"></td>';
                // html = html+'<td><input name="fechai[]"   type="text" class="datepicker2" value="'+val.fechai+'"></td>';
                // html = html+'<td><input name="fechaend[]" type="text" class="datepicker2" value="'+val.fechaend+'"></td>';
                html = html + '<td>' + val.titulo + '</td>';
                html = html + '</tr>';

            });
            console.log(html);

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
        window.location.href = base_url + "prestamos/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}


function confirmar(prestamo_id) {

//Asignamos al input tipo hidden el valor ue esperamos del data.prestamo_id
    $('#prestamo_id').val(prestamo_id);
    $("#modalfecha").modal("show");


}


function grabar_fecha() {
    var prestamo_id = $('#prestamo_id').val();
    var fecha_devolucion = $('#input-fecha_devolucion').val();
    $.ajax({
        url: base_url + "librosprestamos/confirma",
        type: 'POST',
        data: {"prestamo_id": prestamo_id, "fecha_dev": fecha_devolucion},
        success: function (msg) {

            if (msg.say == "yes") {
                //$('#tbl_postulantes').dataTable().fnDraw();


                $("#modalfecha").modal("hide");
                //bootbox.alert("<strong>Se confirmo fecha de devolucion</strong>");
                $('#tbl_prestamos').dataTable().fnDraw();

            } else {
                alert("error");
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
                danger: {
                    label: "Cancelar",
                    className: "btn-danger"
                },
                success: {
                    label: "Aceptar",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                            url: base_url + "prestamos/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_prestamos').dataTable().fnDraw();
                                } else {

                                }
                            }
                        });
                    }
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
                //capturamos el id del check y enviamos a la funcion lectores/getAjax
                $.post(base_url + "lectores/getAjax", {id: xsmart}, function (response) {
                    $("#input-nombres").val(response.nombres);
                }, 'json');


                $("#input-lector_id").val(xsmart);
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

                var xsmart = $('input:radio[name=selrow]:checked').val();
                $.post(base_url + "libros/getAjax", {id: xsmart}, function (response) {
                    //$("#input-titulo").val(response.titulo);





                    var html = "";



                    html = html + "<tr>";
                    html = html + "<td><input type='hidden' name='libros_id[]' value='" + response.libro_id + "'>" + response.isbn + "</td>";
                    html = html + "<td>" + response.titulo + "</td>";

                    html = html + "<td><button type='button' onclick='cargacronograma(" + response.libro_id + ")' class='btn btn-xs btn-danger cargacr'><i class='fa fa-trash'></i></button></td>";
                    html = html + "</tr>";

                    $("#tbody-contratos").append(html);
                    //$("#cargacronogramabb").hide();

                }, 'json');

                $("#input-local_id").val(xsmart);
                $("#modallibros").dialog("close");

            }
        }],
    close: function () {
        $("#modallibros").dialog("close");
    }
});





//datatables libros
var oTable2 = $("#tbl_libros");
oTable2.DataTable({
    "ajax": {"url": base_url + "prestamos/datatablelibros", "type": "POST"},
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},

        {"data": "titulo", "name": "l.titulo"},
        {"data": "categoria", "name": " c.descripcion"},
        {"data": "autor", "name": "a.descripcion"}



    ],

    "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "autoWidth": true,
    "preDrawCallback": function () {
        // Initialize the responsive datatables helper once.

    }
});