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
    //usuario
    tbl_documentos = $("#tbl_documentos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestiontramitedocumentarioexterno/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "desc"]],
        'columnDefs': [
            {
                "targets": 10,
                "className": "text-center"
            }],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "id_doc", "name": "id_doc" },
            { "data": "fecha_envio", "name": "fecha_envio" },            
            { "data": "tipo_documento", "name": "tipo_documento" },
            { "data": "nro_documento", "name": "nro_documento" },
            { "data": "destinatario_personal", "name": "personal_nombre" },            
            { "data": "archivo", "name": "archivo" },            
            { "data": "estado", "name": "estado" },
            { "data": "tipo_proceso", "name": "tipo_proceso" },
            { "data": "observaciones", "name": "observaciones" }

        ],
        "columnDefs": [{
            "targets": 7,
            "data": "data.url",
            "render": function (data, type, row, meta) {

             
                    return "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/tramite_documentario/externos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";

                
            }
        }],
        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_documentos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            if (data.archivo) {
                var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/tramite_documentario/externos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
                $('td', row).eq(6).html(archivo);
            }


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-danger">ANULADO</span>';
            }
            $('td', row).eq(7).html(html_estado);


            var html_proceso = "";
            if (data.tipo_proceso === 'ENVIADO') {
                html_proceso = '<span class="label label-primary">ENVIADO</span>';
            } else if (data.tipo_proceso === 'EN PROCESO') {
                html_proceso = '<span class="label label-warning">EN PROCESO</span>';
            } else if (data.tipo_proceso === 'PENDIENTE') {
                html_proceso = '<span class="label label-warning">PENDIENTE</span>';
            } else if (data.tipo_proceso === 'EN REVISIÓN') {
                html_proceso = '<span class="label label-info">EN REVISIÓN</span>';
            } else if (data.tipo_proceso === 'APROBADO') {
                html_proceso = '<span class="label label-success">APROBADO</span>';
            } else if (data.tipo_proceso === 'RECHAZADO') {
                html_proceso = '<span class="label label-danger">RECHAZADO</span>';
            }
            $('td', row).eq(8).html(html_proceso);

           

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_documentos').dataTable().fnFilter(this.value);
                }
            });
        }
    });
    //exito datos guardados
    $("#success").dialog({
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
                window.location.href = base_url + "gestiontramitedocumentarioexterno/documentosenviados";
            }
        }]
    });


    //Publicar form
    $("#publicar").on("click", function () {
        $(".errorforms").hide();

        var fecha_envio = $("#input-fecha_actual_envio").val();
        var fecha_cargo = $("#input-fecha_actual_cargo").val();

        var hora_actual_envio = moment($("#input-hora_actual_envio").val(), "h:mm:ss A").format("HH:mm:ss");
        var hora_actual_cargo = moment($("#input-hora_actual_cargo").val(), "h:mm:ss A").format("HH:mm:ss");

        var f_e = moment(fecha_envio).format('DD/MM/YYYY ' + hora_actual_envio);
        console.log("fecha envio:" + f_e);

        var f_c = moment(fecha_cargo).format('DD/MM/YYYY ' + hora_actual_cargo);
        console.log("fecha cargo:" + f_c);

        if (f_c >= f_e) {
            console.log("Puede guardar");
            frmx = $("#form_documentos");
            var frm = new FormData(document.getElementById("form_documentos"));
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

                        $("#success").dialog("open");


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
        } else {
            console.log("Fecha invalida");
            var val = '<div class="text-danger errorforms">La fecha de cargo debe ser mayor o igual</div>';
            $("#input-fecha_actual_cargo").after(val);
        }

    });


    //valida enter
    $("#form_documentos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter




    $("#input-personal").change(function () {
        //console.log($("#datalist-personal option[value='" + $('#input-personal').val() + "']").attr('data-value'));
        var id_personal = $("#datalist-personal option[value='" + $('#input-personal').val() + "']").attr('data-value');

        if (id_personal !== undefined) {
            console.log("id es:" + id_personal);
            $("#id_personal").val(id_personal);
        } else {
            console.log("id es:" + id_personal);
            $("#id_personal").val(0);
        }
    });

    $("#input-area").change(function () {
        //console.log($("#datalist-area option[value='" + $('#input-area').val() + "']").attr('data-value'));
        var id_area = $("#datalist-area option[value='" + $('#input-area').val() + "']").attr('data-value');

        if (id_area !== undefined) {
            console.log("id es:" + id_area);
            $("#id_area").val(id_area);
        } else {
            console.log("id es:" + id_area);
            $("#id_area").val(0);
        }
    });


    $("#input-cargo").on("change", function () {
        var id_cargo = $("#input-cargo option:selected").attr("data-value");
        $("#id_cargo").val(id_cargo);
    });

 


});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_doc").val("");
    $("#form_documentos")[0].reset();

    // $.ajax({
    //     type: 'POST',
    //     url: base_url + "Gestiontramitedocumentarioexterno/agregar",
    //     dataType: 'json',
    //     success: function (response) {
    //         //console.log(response.estado);
    //         if (response.say === 'yes') {
    //             console.log("id_doc_agregar: "+response.id_doc);
    //             window.location.href = base_url + "gestiontramitedocumentarioexterno/registro/" + response.id_doc;
    //         }
    //     }
    // });
}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "gestiontramitedocumentarioexterno/registro/" + xsmart;
    } else {
        errordialogtablecuriosity();
    }
}

function eliminar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        bootbox.dialog({
            message: "<strong>¿ Desea anular este registro ?</strong>",
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
                            url: base_url + "gestiontramitedocumentarioexterno/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_documentos').dataTable().fnDraw();
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


