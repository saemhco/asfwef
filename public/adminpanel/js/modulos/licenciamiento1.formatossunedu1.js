$(document).ready(function () {


//alert(id);


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_formatos = $("#tbl_formatos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "licenciamiento1/datatableFormatossunedu1", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "codigo", "name": "codigo"},
            {"data": "nombre", "name": "nombre"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_formatos'), breakpointDefinition);
            }
        },
        "columnDefs": [
            {"width": "70px", "targets": 3}
        ],
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            var pdf = '';
            var excel = '';
            var enlace = '';

            if (String(data.archivo).length > 9) {
                console.log(data.archivo);
                var pdf = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/formatos1/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            }
            if (String(data.archivo2).length > 9) {
                var excel = "<a role='button' class='btn btn-xs btn-success' target='_BLANK' href='" + base_url + "adminpanel/archivos/formatos1/" + data.archivo2 + "' >   <i class='fa fa-file-excel-o' ></i></a>";
            }
            if (String(data.enlace).length > 9) {
                var enlace = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' id='archivo_medios' href='" + data.enlace + "'  >   <i class='fa fa-link' ></i></a>";
            }

            var html = pdf + ' ' + excel + ' ' + enlace;


            $('td', row).eq(3).html(html);

            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(4).html(html_estado);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_formatos').dataTable().fnFilter(this.value);
                }
            });
        }
    });
    //exito datos guardados
    $("#exito_formatos").dialog({
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
                    window.location.href = base_url + "licenciamiento1/formatos1";
                }
            }]
    });


    //Error asignatura
    $("#codigo_registrado").dialog({
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
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });

    $("#codigo_vacio").dialog({
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
                    //window.location.href = base_url + "registrodeencuestas/encuestas";
                }
            }]
    });


//Publicar form
    $("#publicar").on("click", function () {

        frmx = $("#form_formatos");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_formatos"));
        //datos += "&contenido=" + encodeURIComponent(editor.getData());

        //frm.append('compromiso', editor_compromiso.getData());
        //frm.append('compromiso_cooperante', editor_compromiso_cooperante.getData());

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
                    //window.location.href = base_url + "licenciamiento1";
                    $("#exito_formatos").dialog("open");
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
    //mensaje error
    $("#error_agregar").dialog({
        autoOpen: false,
        width: 320,
        resizable: false,
        modal: true,
        title: "<div class='widget-header text-warning'><h4><i class='fa fa-warning'></i> SICAP-SIGESU-WEB</h4></div>",
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
                }
            }]
    });
    //valida enter
    $("#form_formatos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter


});


//validar codigo existente colegiados
$("#input-codigo").focusout(function () {

    var codigo = $("#input-codigo").val();

    //alert(codigo_asignatura);

    if (codigo === '') {
        $("#codigo_vacio").dialog("open");
        CuriositySoundError();
    } else {
        $.ajax({
            type: 'POST',
            url: base_url + "licenciamiento1/codigoRegistradof",
            data: {codigo: codigo},
            dataType: 'json',
            success: function (response) {
                //console.log(response.estado);
                if (response.say === 'si') {

                    $("#codigo_registrado").dialog("open");
                    //CuriositySoundError();


                } else {

                }

                $(".errorforms").remove();
            }, complete: function () {
                //$("#form_curriculas").dialog("open");
                //alert('Estado:' + estado);

            }
        });
    }

});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    //$(".errorforms").hide();
    //$("#input-id_formato").val("");
    //$("#form_formatos")[0].reset();
    //$("#form_formatos").dialog("open");
    $("#error_agregar").dialog("open");
    CuriositySoundError();
}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "licenciamiento1/registrof/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {

    $("#error_agregar").dialog("open");
    CuriositySoundError();
//    if ($(".selrow").is(':checked')) {
//        var xsmart = $('input:radio[name=selrow]:checked').val();
//        bootbox.dialog({
//            message: "<strong>¿ Desea Eliminar este registro ?</strong>",
//            title: "Confirmar",
//            buttons: {
//                success: {
//                    label: "Aceptar",
//                    className: "btn-success",
//                    callback: function () {
//                        $.ajax({
//                            url: base_url + "licenciamiento1/eliminar",
//                            type: 'POST',
//                            data: {"id": xsmart},
//                            success: function (msg) {
//
//                                if (msg.say == "yes") {
//                                    $('#tbl_formatos').dataTable().fnDraw();
//                                } else {
//
//                                }
//                            }
//                        });
//                    }
//                },
//                danger: {
//                    label: "Cancelar",
//                    className: "btn-danger"
//                }
//            }
//        });
//    } else {
//        errordialogtablecuriosity();
//    }
}



function detelepdf() {
    var xsmart = id;
    bootbox.dialog({
        message: "<strong>¿ Está seguro que desea eliminar el documento ?</strong>",
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
                        url: base_url + "licenciamiento1/deletepdff",
                        type: 'POST',
                        data: {"id": xsmart},
                        success: function (msg) {

                            if (msg.say == "yes") {
                                window.location.href = base_url + "licenciamiento1/registrof/" + id;
                            } else {

                            }
                        }
                    });
                }
            }
        }
    });

}

function deleteexcel() {
    var xsmart = id;
    bootbox.dialog({
        message: "<strong>¿ Está seguro que desea eliminar el documento ?</strong>",
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
                        url: base_url + "licenciamiento1/deleteexcelf",
                        type: 'POST',
                        data: {"id": xsmart},
                        success: function (msg) {

                            if (msg.say == "yes") {
                                window.location.href = base_url + "licenciamiento1/registrof/" + id;
                            } else {

                            }
                        }
                    });
                }
            }
        }
    });

}