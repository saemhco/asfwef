$(document).ready(function () {


    //lert("Hola Mundo");

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_documentos = $("#tbl_documentos").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestiontramitedocumentario/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "desc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "expediente", "name": "expediente" },
            { "data": "fecha_envio", "name": "fecha_envio" },
            { "data": "fecha_cargo", "name": "fecha_cargo" },
            { "data": "tipo_documento", "name": "tipo_documento" },
            { "data": "nro_documento", "name": "nro_documento" },
            { "data": "personal", "name": "personal" },
            { "data": "remitente_nombres", "name": "remitente_nombres" },
            { "data": "id_doc", "name": "id_doc" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_documentos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {


            // if (data.enlace) {
            //     var enlace = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + data.enlace + "' >   <i class='fa fa-link' ></i></a>";
            //     $('td', row).eq(8).html(enlace);
            // }

            // if (data.archivo) {
            //     var archivo = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/tramite_documentario/externos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            //     $('td', row).eq(9).html(archivo);
            // }

            
            var derivar = "<a role='button' class='btn btn-xs btn-success' href='" + base_url + "gestiontramitedocumentario/documentosdetalle/" + data.id_doc + "' >   <i class='fa fa-list' ></i></a>";
            $('td', row).eq(8).html(derivar);


            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(9).html(html_estado);



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
                window.location.href = base_url + "gestiontramitedocumentario/documentosrecibidos";
            }
        }]
    });


    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_documentos");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_documentos"));
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
    });


    //valida enter
    $("#form_documentos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter





    
    $('#input-id_personal_area').select2();





    $("#input-remitente_nombres").change(function () {
        //console.log($("#datalist-area option[value='" + $('#input-area').val() + "']").attr('data-value'));
        var id_remitente = $("#datalist-remitente_nombres option[value='" + $('#input-remitente_nombres').val() + "']").attr('data-value');

        if (id_remitente !== undefined) {
            console.log("id es:" + id_remitente);
            $("#id_remitente").val(id_remitente);
        } else {
            console.log("id es:" + id_remitente);
            $("#id_remitente").val(0);
        }
    });





    $("#input-id_personal").on("change", function () {
        var destinatario_personal = $("#input-id_personal option:selected").attr("data-value");
        $("#destinatario_personal").val(destinatario_personal);
    });

    $("#input-id_area").on("change", function () {
        var destinatario_area = $("#input-id_area option:selected").attr("data-value");
        $("#destinatario_area").val(destinatario_area);
    });


    $('#input-hora_actual_envio').timepicker();
    $('#input-hora_actual_cargo').timepicker();




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
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
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
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });

});

function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_doc").val("");
    $("#form_documentos")[0].reset();
}


function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "gestiontramitedocumentario/registro/" + xsmart;
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
                            url: base_url + "gestiontramitedocumentario/eliminar",
                            type: 'POST',
                            data: {"id": xsmart},
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

function reporte_pdf() {
    $(".errorforms").remove();
    $("#form_reporte_pdf")[0].reset();

    var fecha_inicio_pdf = moment().format('DD/MM/YYYY');
    $("#input-fecha_inicio_pdf").val(fecha_inicio_pdf);

    var fecha_fin_pdf = moment().add(1, 'months').format('DD/MM/YYYY');
    $("#input-fecha_fin_pdf").val(fecha_fin_pdf);

    $("#form_reporte_pdf").dialog("open");
}

function reporte_gestiontramitedocumentario_pdf() {
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
        window.open(base_url + "reportes/reportegestiontramitedocumentario/" + fecha_inicio + "/" + fecha_fin);
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

function reporte_gestiontramitedocumentario_xls() {
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
        window.open(base_url + "exportar/exportargestiontramitedocumentario/" + fecha_inicio + "/" + fecha_fin);
    }
}


