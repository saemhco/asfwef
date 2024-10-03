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
    tbl_condiciones1 = $("#tbl_condiciones1").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "licenciamiento1/datatableCondiciones1", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columnDefs": [
            {"targets": 3, "className": "text-center"},
            {"targets": 4, "className": "text-center"},
            {"targets": 5, "className": "text-center"}
        ],
        "columns": [

            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "codigo", "name": "codigo" },
            { "data": "nombre", "name": "nombre" },
            { "data": "nro_act_fin", "name": "nro_act_fin" },
            { "data": "nro_act_total", "name": "nro_act_total" },
            { "data": "avance", "name": "avance" },
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
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_condiciones1'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {




            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(html_estado);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_condiciones1').dataTable().fnFilter(this.value);
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
                window.location.href = base_url + "licenciamiento1/condiciones1";
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
                if (result.say === "yes") {
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



$("#input-codigo").focusout(function () {

    var codigo = $("#input-codigo").val();

    var codigo_oculto = $("#input-codigo_oculto").val();

    //alert(codigo_asignatura);

    if (codigo === '') {
        $("#codigo_vacio").dialog("open");
        CuriositySoundError();
    } else if (codigo === codigo_oculto) {

    } else {
        $.ajax({
            type: 'POST',
            url: base_url + "licenciamiento1/codigoRegistradoCondiciones1",
            data: { codigo: codigo },
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
        window.location.href = base_url + "licenciamiento1/registrocondiciones1/" + xsmart;
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

