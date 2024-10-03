$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_planillas = $("#tbl_planillas").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroplanillas/dataTable", "type": "POST" },
        "processing": false,
        "serverSide": true,

        "order": [[2, "desc"], [3, "desc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "abrev", "name": "abrev" },
            { "data": "nombre", "name": "nombre" },
            { "data": "periodo", "name": "periodo" },
            { "data": "numero", "name": "numero" },
            { "data": "fecha_inicio", "name": "fecha_inicio" },
            { "data": "fecha_fin", "name": "fecha_fin" },
            { "data": "id_planilla", "name": "id_planilla" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_planillas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {

            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_planilla + '" id_planilla_tipo="' + data.id_planilla_tipo + '" ><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var acciones = '';
            if (data.id_planilla_tipo === 1) {

                var acciones = "<a role='button' title='Exportar a SIAF' class='btn btn-xs btn-success' target='_BLANK' href='" + base_url + "exportar/siafCas/" + data.id_planilla + "' >   <i class='fa fa-file-excel-o' ></i></a>\n\
                <a role='button' title='Exportar a AFP' class='btn btn-xs bg-color-magenta txt-color-white' target='_BLANK' href='" + base_url + "exportar/afpnetcas/" + data.id_planilla + "' >   <i class='fa fa-file-excel-o' ></i></a>\n\
                <a role='button' class='btn btn-xs btn-primary' title='Copiar Planilla' onclick='copiarplanilla(" + data.id_planilla + ")' ><i class='fa fa-arrow-left' ></i></a>\n\
                <a role='button' class='btn btn-xs btn-warning' title='Actualizar Datos Personal' onclick='actualizardatospersonal(" + data.id_planilla + ")' ><i class='fa fa-arrow-left' ></i></a>";
            } else if (data.id_planilla_tipo === 2) {

                var acciones = "<a role='button' title='Exportar a SIAF' class='btn btn-xs btn-success' target='_BLANK' href='" + base_url + "exportar/siafDocentes/" + data.id_planilla + "' >   <i class='fa fa-file-excel-o' ></i></a>\n\
                <a role='button' title='Exportar a AFP' class='btn btn-xs bg-color-magenta txt-color-white' target='_BLANK' href='" + base_url + "exportar/afpnetdocentes/" + data.id_planilla + "' >   <i class='fa fa-file-excel-o' ></i></a>\n\
                <a role='button' class='btn btn-xs btn-primary' title='Copiar Planilla' onclick='copiarplanilla(" + data.id_planilla + "," + data.id_planilla_tipo + ")' ><i class='fa fa-arrow-left' ></i></a>\n\
                <a role='button' class='btn btn-xs btn-warning' title='Actualizar Datos Docente' onclick='actualizardatospersonal(" + data.id_planilla + "," + data.id_planilla_tipo + ")' ><i class='fa fa-arrow-left' ></i></a>";

            }

            $('td', row).eq(7).html(acciones);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(8).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_planillas').dataTable().fnFilter(this.value);
                }
            });
        }
    });



    $("#btn-generar-planillas").on("click", function () {
        if ($(".selrow").is(':checked')) {
            var id_planilla = $('input:radio[name=selrow]:checked').val();
            $.ajax({
                type: 'POST',
                url: base_url + "registroplanillas/generarPlanillas",
                data: { id_planilla: id_planilla },
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
        } else {
            errordialogtablecuriosity();
        }

    });

    $("#form_proceso").dialog({
        autoOpen: false,
        //height: "auto",
        width: "800px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Proceso</h4></div>",
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

                frm = $("#form_proceso");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {

                            console.log("Llega");

                            $("#form_proceso").dialog("close");
                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                $('#tbl_planillas').dataTable().fnDraw();
                            });
                        } else {
                            console.log("llegamos a la disco");

                        }
                    }
                });

            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    $('#select-id_planilla').select2({
        dropdownParent: $('#form_proceso')
    });
})

function editar() {
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();


        //alert(xsmart);

        window.location.href = base_url + "registroplanillas/registro/" + xsmart;

    } else {
        errordialogtablecuriosity();
    }

}

function personal() {
    if ($(".selrow").is(':checked')) {



        var xsmart = $('input:radio[name=selrow]:checked').val();
        var id_planilla_tipo = $('input:radio[name=selrow]:checked').attr('id_planilla_tipo');

        if (id_planilla_tipo === '1') {

            window.location.href = base_url + "registroplanillas/planilladetallecas/" + xsmart;

        } else if (id_planilla_tipo === '2') {
            window.location.href = base_url + "registroplanillas/planilladetalledocentes/" + xsmart;

        }


    } else {
        errordialogtablecuriosity();
    }

}

function config() {
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();

        //alert(xsmart);

        window.location.href = base_url + "registroplanillas/config/" + xsmart;

    } else {
        errordialogtablecuriosity();
    }

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
                            url: base_url + "registroplanillas/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_planillas').dataTable().fnDraw();
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

function reporte_pdf() {
    //window.open(base_url + "reportes/reportegestionplanillas");

    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();
        var id_planilla_tipo = $('input:radio[name=selrow]:checked').attr('id_planilla_tipo');

        if (id_planilla_tipo === '1') {

            window.open(base_url + "reportes/planillascas/" + xsmart);


        } else if (id_planilla_tipo === '2') {


            window.open(base_url + "reportes/planillasdocentes/" + xsmart);


        }


    } else {
        errordialogtablecuriosity();
    }
}

function reporte_xls() {
    //window.open(base_url + "reportes/reportegestionplanillas");

    $(".errorforms").hide();
    if ($(".selrow").is(':checked')) {

        var xsmart = $('input:radio[name=selrow]:checked').val();
        var id_planilla_tipo = $('input:radio[name=selrow]:checked').attr('id_planilla_tipo');

        if (id_planilla_tipo === '1') {

            window.open(base_url + "exportar/planillascas/" + xsmart);


        } else if (id_planilla_tipo === '2') {


            window.open(base_url + "exportar/planillasdocentes/" + xsmart);


        }


    } else {
        errordialogtablecuriosity();
    }
}

function copiarplanilla(id_planilla) {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $('#datatable-id_planilla').val(id_planilla);
    $("#form_proceso")[0].reset();
    $("#form_proceso").dialog("open");
}


function actualizardatospersonal(id_planilla, id_planilla_tipo) {

    bootbox.dialog({
        message: "<strong>¿ Desea actualizar los datos ...?</strong>",
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
                        url: base_url + "registroplanillas/actualizarDatosPersonal",
                        type: 'POST',
                        data: { "id_planilla": id_planilla, "id_planilla_tipo": id_planilla_tipo },
                        success: function (msg) {

                            if (msg.say == "yes") {
                                bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                    $('#tbl_planillas').dataTable().fnDraw();
                                });
                            } else {
                                console.log("Error");

                            }
                        }
                    });

                }
            }

        }
    });
}