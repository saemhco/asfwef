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

    tbl_usuario = $("#tbl_prestamos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "recursosprestamos/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[2, "asc"], [3, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

            { "data": "apellidos_nombres", "name": "apellidos_nombres" },
            { "data": "codigos", "name": "codigos" },
            { "data": "tipo_usuario", "name": "tipo_usuario" },
            { "data": "hora_entrada", "name": "hora_entrada" },
            { "data": "fecha_prestamo_recurso", "name": "fecha_prestamo_recurso" },
            { "data": "id_recurso_prestamo", "name": "id_recurso_prestamo" }

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


            //hora entrada
            var he = data.hora_entrada;
            var v_he = he.split("-05");
            var r_he = v_he[0];

            console.log(r_he);
            $('td', row).eq(4).html(r_he);


            //Fecha prestamopc
            var str = data.fecha_prestamo_recurso;
            //split igual explode php
            var res = str.split("-");
            //recorremos el array por las posiciones
            var respuesta = res[2] + '/' + res[1] + '/' + res[0];
            //console.log(respuesta);
            $('td', row).eq(5).html(respuesta);


            var ver = "";
            var confirmar = "";

            ver = "<button onclick='ver(" + data.id_recurso_prestamo + ")' class='btn btn-xs btn-warning' >Ver</i></button> \n\
                <button class='btn btn-xs btn-success' onclick='confirmar(" + data.id_recurso_prestamo + ")' >Terminar</button>";
            $('td', row).eq(6).html(ver);


        }
    });


    $("#publicar").on("click", function () {
        frm = $("#form_recursosprestamos");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes") {

                    bootbox.alert("<strong>Se registró correctamente</strong>");
                    window.location.href = base_url + "recursosprestamos";


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
//datatables recursos
var oTable2 = $("#tbl_recursos");
oTable2.DataTable({
    "ajax": { "url": base_url + "recursosprestamos/datatablerecursos", "type": "POST" },
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

        { "data": "descripcion", "name": "descripcion" },
        { "data": "modelo", "name": "modelo" },
        { "data": "color", "name": "color" },
        { "data": "serie", "name": "serie" },
        { "data": "estado", "name": "estado" }



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

        //Estado del prestamo
        if (data.estado === "A") {


            html2 = '<span class="label label-success">Disponible</span>';
        } else if (data.estado === "R") {

            html2 = '<span class="label label-warning">Disponible</span>';

        }



        $('td', row).eq(5).html(html2);
    }
});


function ver(codigo) {
    $.ajax({
        url: base_url + "recursosprestamos/aplica",
        type: 'POST',
        data: { "codigo": codigo },
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
            $('#tbody_recursos').empty();
            $('#tbody_recursos').append(html);
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


//Confirmar hora de salida
function confirmar(codigo) {
    //Asignamos al input tipo hidden el valor ue esperamos del data.prestamo_id
    $('#codigo').val(codigo);
    $('#input-hora_salida').val("");
    $("#modal_hora_salida").modal("show");

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
                            data: { "id": xsmart },
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
$("#modalusuarios").dialog({
    autoOpen: false,
    //height: "auto",
    width: "820px",
    resizable: false,
    modal: true,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Seleccionar Usuario</h4></div>",
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

            $.post(base_url + "recursosprestamos/getAjaxLectoresRecursos", { codigo: xsmart, perfil: perfil }, function (response) {
                //console.log("Nombre:"+response.nombres+" Apellidos Paterno: "+response.apellidop +" Apellidos Materno: "+response.apellidom);
                $("#input-nombres").val(response.apellidop + ' ' + response.apellidom + ' ' + response.nombres);
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
            $("#modalusuarios").dialog("close");

        }
    }],
    close: function () {
        $("#modalusuarios").dialog("close");
    }
});



//Modal de libros
$("#modalrecursos").dialog({
    autoOpen: false,
    //height: "auto",
    width: "820px",
    resizable: false,
    modal: true,
    title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Seleccionar Computadora</h4></div>",
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
            $.post(base_url + "recursos/getAjax", { id: xsmart }, function (response) {


                $("#input-descripcion").val(response.descripcion);


                $("#input-serie").val(response.serie);

                $("#input-estado").val(response.estado);

            }, 'json');

            $("#input-recurso").val(xsmart);
            $("#modalrecursos").dialog("close");

        }
    }],
    close: function () {
        $("#modalrecursos").dialog("close");
    }
});


//datatables de lectores
var oTable = $("#tbl_lectores");
oTable.DataTable({
    "ajax": { "url": base_url + "recursosprestamos/datatableusuarios", "type": "POST" },
    "processing": false,
    "serverSide": true,
    "order": [[1, "asc"]],
    "columns": [
        //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
        { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },

        { "data": "nombres", "name": "nombres" },
        { "data": "apellidop", "name": "apellidop" },
        { "data": "apellidom", "name": "apellidom" },
        { "data": "perfil", "name": "perfil" },
        { "data": "codigo", "name": "codigo" }

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
            $('td', row).eq(4).html(r_alumno);
        }

        if (data.perfil === 4) {

            //console.log(data.alumno);
            var r_alumno = "DOCENTE";
            $('td', row).eq(4).html(r_alumno);
        }

        if (data.perfil === 5) {

            //console.log(data.alumno);
            var r_alumno = "PUBLICO";
            $('td', row).eq(4).html(r_alumno);
        }

    }
});



//grabar_hora_salida
function grabar_hora_salida() {
    var codigo = $('#codigo').val();

    //alert(codigo);

    var hora_salida = $('#input-hora_salida').val();
    $.ajax({
        url: base_url + "recursosprestamos/confirma",
        type: 'POST',
        data: { "codigo": codigo, "hora_salida": hora_salida },
        success: function (msg) {

            if (msg.say == "yes") {
                //$('#tbl_postulantes').dataTable().fnDraw();


                $("#modal_hora_salida").modal("hide");
                //bootbox.alert("<strong>Se confirmo fecha de devolucion</strong>");
                $('#tbl_prestamos').dataTable().fnDraw();

            } else {
                alert("error");
            }
        }
    });

}




