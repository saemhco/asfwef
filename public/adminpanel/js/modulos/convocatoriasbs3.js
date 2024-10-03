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


    tbl_convocatorias_bs = $("#tbl_convocatorias_bs").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "convocatoriasbs/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        'columnDefs': [
            {
                "targets": 5,
                "className": "text-center"
            }],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "imagen", "name": "convbs.imagen"},
            {"data": "tipo_resolucion", "name": "aco.nombres"},
            {"data": "titulo", "name": "convbs.titulo"},
            {"data": "fecha_hora", "name": "convbs.fecha_hora"},
            {"data": "estado", "name": "convbs.estado"}

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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_convocatorias_bs'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var html = "<img src='" + base_url + "adminpanel/imagenes/convocatoriasbs/" + data.imagen + "'   width='90' height='60'  />";
            $('td', row).eq(1).html(html);

            var fecha_hora = data.fecha_hora;
            //split igual explode php
            var res_fecha_hora = fecha_hora.split("-");
            //recorremos el array por las posiciones
            //var respuesta = res[2] + '-' + res[1] + '-' + res[0];
            var array_2_fecha_inicio = res_fecha_hora[2].split(" ");

            var res_fecha_hora = array_2_fecha_inicio[0] + '/' + res_fecha_hora[1] + '/' + res_fecha_hora[0];
            $('td', row).eq(4).html(res_fecha_hora);

//            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/convocatorias/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
//            $('td', row).eq(5).html(html2);


            
            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(5).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_convocatorias_bs').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    //exito datos guardados
    $("#exito_convocatoriasbs").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-success'><h4><i class='fa fa-check'></i> SICAP-SIGESU-WEB</h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [{
                html: "Aceptar",
                "class": "btn btn-success btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "convocatoriasbs";
                    //location.reload();
                }
            }]
    });

    //Error encuesta ya registrada para esa asignatura
    $("#error_tipo_vacio").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB </h4></div>",
        show: {
            effect: "highlight",
            duration: 300
        },
        hide: {
            effect: "clip",
            duration: 300
        },
        buttons: [{
                html: "Aceptar",
                "class": "btn btn-warning btn-sm ",
                click: function () {
                    $(this).dialog("close");
                    window.location.href = base_url + "convocatorias/registro";
                }
            }]
    });





//Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_convocatorias_bs");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_convocatorias_bs"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());
        //frm.append('texto_1', editor.getData());

        $.ajax({
            url: frmx.attr("action"),
            type: 'POST',
            //data: frm.serialize(),
            data: frm,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "sliders";
                    $("#exito_convocatoriasbs").dialog("open");
                    //CuriositySoundError();

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    //Mostrar mensaje error del modelo
                    $.each(result, function (i, val) {
                        $("#input-" + i).focus();
                        $("#input-" + i).after(val);
                    });
                }
            }
        });
    });


    //valida enter
    $("#form_convocatorias_bs .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


    //guardar documentos de ganador
    $("#btn-guardar-documentos").on("click", function () {

        console.log("Convocatoria: " + $("#input-convocatoria").val());

        var convocatoria = $("#input-convocatoria").val();

        $.ajax({
            type: 'POST',
            url: base_url + "convocatorias/saveDocumentosGanador",
            data: {convocatoria: convocatoria},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say === "yes") {

                    bootbox.alert("<strong>Se registró correctamente</strong>");

                }
                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_autores").dialog("open");
            }
        });

    });

    //tabla origen - tabla destino
//    $("#btn-transferencia").on("click", function () {
//        
//        console.log('@kenmack');
//        //console.log("Convocatoria: " + $("#input-id_convocatoria").val());
//
//        //ar id_convocatoria = $("#input-id_convocatoria").val();
//
//        $.ajax({
//            type: 'POST',
//            url: base_url + "convocatorias/transferencia",
//            //data: {convocatoria: id_convocatoria},
//            dataType: 'json',
//            success: function (response) {
//                //var result = JSON.parse(msg);
//                if (response.say === "yes") {
//
//                    bootbox.alert("<strong>Se registró correctamente</strong>");
//
//                }
//                $(".errorforms").remove();
//            }, complete: function () {
//                //$("#form_autores").dialog("open");
//            }
//        });
//
//    });

    $("#btn-registrar-personal").on("click", function () {

        console.log("Convocatoria: " + $("#input-id_convocatoria").val());

        var convocatoria = $("#input-convocatoria").val();

        $.ajax({
            type: 'POST',
            url: base_url + "convocatorias/saveRegistrarPersonal",
            data: {convocatoria: convocatoria},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                if (response.say === "yes") {

                    bootbox.alert("<strong>Se registró correctamente</strong>");

                }
                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_autores").dialog("open");
            }
        });

    });

});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_convocatoria").val("");
    $("#form_convocatorias_bs")[0].reset();
    $("#form_convocatorias_bs").dialog("open");
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        window.location.href = base_url + "convocatoriasbs/registro/" + xsmart;



    } else {
        errordialogtablecuriosity();
    }
}


function eliminar()
{
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
                            url: base_url + "convocatoriasbs/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_convocatorias_bs').dataTable().fnDraw();
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

//Liberar postulantes
function liberar_postulantes() {
    if ($(".selrow").is(':checked')) {
        bootbox.confirm({
            message: "<strong>¿Está seguro que desea liberar los postulantes ?</strong>",
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
                    var xsmart = $('input:radio[name=selrow]:checked').val();

                    $.ajax({
                        url: base_url + "convocatorias/liberarPostulantes",
                        type: 'POST',
                        data: {convocatoria: xsmart},
                        success: function (response) {
                            if (response.say === 'yes') {

                                $('#tbl_convocatorias_bs').dataTable().fnDraw();

                            }
                        }
                    });
                }
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


    