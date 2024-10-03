$(document).ready(function () {
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_pacientes = $("#tbl_pacientes").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroatencionessalud/datatablepaciente/"+nro_doc, "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "id_atencion", "name": "id_atencion" },
            { "data": "fecha_atencion", "name": "fecha_atencion" },
            { "data": "nro_doc", "name": "nro_doc" },
            { "data": "apellidos_nombre", "name": "apellidos_nombre" },
            { "data": "motivo", "name": "motivo" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_pacientes'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.id_atencion + '"  nro_doc="' + data.nro_doc + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var estado = "";
            if (data.estado === 'A') {
                estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(6).html(estado);

        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_pacientes').dataTable().fnFilter(this.value);
                }
            });
        }
    });



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
                window.location.href = base_url + "registrohistoriasclinicas";
            }
        }]
    });

    $("#publicar").on("click", function () {
        frm = $("#form_historia_clinica");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                console.log(msg);
                var result = msg;
                if (result.say === "yes") {
                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "asignaturas";

                    $("#success").dialog("open");


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

    $('#input-nro_doc').on('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });


    $("#form_atencion_nuevo").dialog({
        autoOpen: false,
        //height: "auto",
        width: "450px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registrar Atencion</h4></div>",
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
            html: "<i class='fa fa-save'></i>&nbsp; Grabar", "id": "graba",
            "class": "btn btn-info",
            click: function () {

                var nro_doc = $('#input-nro_doc').val();

                if (nro_doc.length < 1 || nro_doc.length !== 8) {
                    //console.log("El nro doc no debe estar vacio y debe tener 8");
                    var val = '<div class="text-danger errorforms">El nro doc no debe estar vacio y debe tener 8 digitos</div>';
                    $("#input-nro_doc").after(val);
                } else {
                    //console.log("Inserta");
                    $.ajax({
                        url: base_url + "registroatencionessalud/saveAtencionNuevo",
                        type: 'POST',
                        data: { "nro_doc": nro_doc },
                        success: function (msg) {

                            if (msg.say == "yes") {
                                $('#tbl_atenciones').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>")
                                $("#form_atencion_nuevo").dialog("close");
                            }
                        }
                    });
                }



            }
        }],
        close: function () {
            $("#form_atencion_nuevo").dialog("close");
        }
    });



});



function agregar() {
    $(".errorforms").hide();
    $("#input-nro_doc").val("");
    $("#form_atencion_nuevo")[0].reset();
    $("#form_atencion_nuevo").dialog("open");
}

function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        var nro_doc = $('input:radio[name=selrow]:checked').attr('nro_doc');

        window.location.href = base_url + "registroatencionessalud/registro/" + xsmart + "/" + nro_doc;

    } else {
        errordialogtablecuriosity();
    }
}

function eliminar() {
    if ($(".selrow").is(':checked')) {
        var id_atencion = $('input:radio[name=selrow]:checked').val();
        var nro_doc = $('input:radio[name=selrow]:checked').attr('nro_doc');
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
                            url: base_url + "registroatencionessalud/eliminar",
                            type: 'POST',
                            data: { "id_atencion": id_atencion, "nro_doc": nro_doc },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_atenciones').dataTable().fnDraw();
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

