$(document).ready(function () {

    //alert(numero_tabla);
    //alert("Testing");

    if (numero_tabla !== 0) {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        tbl_tablas_maestras = $("#tbl_tablas_maestras").DataTable({
            "stateSave": true,
            "ajax": {"url": base_url + "tablasmaestras/datatable/" + numero_tabla, "type": "POST"},
            "processing": false,
            "serverSide": true,
            "order": [[1, "asc"]],
            "columns": [
                //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
                {"data": "codigo", "name": "codigo"},
                {"data": "nombres", "name": "nombres"},
                {"data": "descripcion", "name": "descripcion"},
                {"data": "estado", "name": "estado"}],
            "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_tablas_maestras'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }, "createdRow": function (row, data, index) {

                var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.numero + '" pk2="' + data.codigo + '" ><i></i> </label></center>';
                $('td', row).eq(0).html(html);

                var html_estado = "";
                if (data.estado === 'A') {
                    html_estado = '<span class="label label-success">ACTIVO</span>';
                } else if (data.estado === 'X') {
                    html_estado = '<span class="label label-warning">INACTIVO</span>';
                }
                $('td', row).eq(4).html(html_estado);

            }
        });

    } else {


        if (activa_datatable === 1) {
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            tbl_tablas_maestras = $("#tbl_tablas_maestras").DataTable({
                "stateSave": true,
                "ajax": {"url": base_url + "tablasmaestras/datatablemaestras", "type": "POST"},
                "processing": false,
                "serverSide": true,
                "order": [[1, "asc"]],
                "columns": [
                    //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
                    {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
                    {"data": "numero", "name": "numero"},
                    {"data": "nombres", "name": "nombres"},
                    {"data": "descripcion", "name": "descripcion"},
                    {"data": "estado", "name": "estado"}],
                "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                        "t" +
                        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "language": {"url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json"},
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_tablas_maestras'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic.respond();
                }, "createdRow": function (row, data, index) {

                    var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.numero + '" pk2="' + data.codigo + '" ><i></i> </label></center>';
                    $('td', row).eq(0).html(html);

                    var html_estado = "";
                    if (data.estado === 'N') {
                        html_estado = '<span class="label label-success">ACTIVO</span>';
                    } else if (data.estado === 'X') {
                        html_estado = '<span class="label label-warning">INACTIVO</span>';
                    }
                    $('td', row).eq(4).html(html_estado);

                }
            });
        }

    }




    $("#form_tablas_maestras").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro y Actualizacion</h4></div>",
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
                    frm = $("#form_tablas_maestras");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                // $("#modalnew").modal("hide");
                                $('#tbl_tablas_maestras').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_tablas_maestras").dialog("close");
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
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    //select tablas_maestras
    $("#tablas_maestras").on("change", function () {
        var numero_tabla = $(this).val();
        console.log("numero_tabla" + numero_tabla);
        window.location.href = base_url + "tablasmaestras/valores/" + numero_tabla;
    });



    $('#tablas_maestras').select2();



});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    //$(".errorforms").hide();
    //$("#input-cargo_id").val("");
    // $("#form_tablas_maestras")[0].reset();
    // $("#form_tablas_maestras").dialog("open");

    $("#form_tablas_maestras")[0].reset();
    $("#input-estado").prop("checked", true);

    var numero_tabla = $('#tablas_maestras').val();

    //alert(numero_tabla);

    $.ajax({
        type: 'POST',
        url: base_url + "tablasmaestras/getNew",
        data: {numero_tabla: numero_tabla},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {

                $("#input-numero").attr('value', $('#tablas_maestras').val());
                $("#input-codigo").attr('value', response.pk_aumenta);

            }

            $(".errorforms").remove();
        }, complete: function () {
            $("#form_tablas_maestras").dialog("open");
            //$("#form_curriculas").dialog("open");
            //alert('Estado:' + estado);

        }
    });
}


function agregar_maestra() {
    //Limpia los errores y resetea los valores de los campos
    //$(".errorforms").hide();
    //$("#input-cargo_id").val("");
    // $("#form_tablas_maestras")[0].reset();
    // $("#form_tablas_maestras").dialog("open");

    $("#form_tablas_maestras")[0].reset();
    $("#input-estado").prop("checked", true);

    //var numero_tabla = $('#tablas_maestras').val();

    //alert(numero_tabla);

    $.ajax({
        type: 'POST',
        url: base_url + "tablasmaestras/getNewMaestra",
        //data: {numero_tabla: numero_tabla},
        dataType: 'json',
        success: function (response) {
            //console.log(response.estado);
            if (response.say === 'si') {


                $("#input-numero").attr('value', response.pk_aumenta);
                $("#input-codigo").attr('value', 100);

            }

            $(".errorforms").remove();
        }, complete: function () {
            $("#form_tablas_maestras").dialog("open");
            //$("#form_curriculas").dialog("open");
            //alert('Estado:' + estado);

        }
    });
}

function editar() {

    $("#input-estado").prop("checked", false);

    if ($(".selrow").is(':checked')) {

        var numero = $('input:radio[name=selrow]:checked').val();
        var codigo = $('input:radio[name=selrow]:checked').attr('pk2');


        $.ajax({
            type: 'POST',
            url: base_url + "tablasmaestras/getAjax",
            data: {numero: numero, codigo: codigo},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);

                    if (i === "estado") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i).prop("checked", true);

                        }
                    }
                });
                $(".errorforms").remove();
            }, complete: function () {
                $("#form_tablas_maestras").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar() {
    if ($(".selrow").is(':checked')) {
        var numero = $('input:radio[name=selrow]:checked').val();
        var codigo = $('input:radio[name=selrow]:checked').attr('pk2');

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
                            url: base_url + "tablasmaestras/eliminar",
                            type: 'POST',
                            //data: {"id": xsmart},
                            data: {"numero": numero, "codigo": codigo},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_tablas_maestras').dataTable().fnDraw();
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