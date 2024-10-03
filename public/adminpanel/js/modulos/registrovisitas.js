$(document).ready(function () {


    if (id_sede !== "") {
        carga_lugar(id_sede, id_lugar);
    }

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    tbl_web_visitas = $("#tbl_web_visitas").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registrovisitas/datatable", "type": "POST" },
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        'columnDefs': [
            {
                "targets": 8,
                "className": "text-center"
            }],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false },
            { "data": "fecha_visita", "name": "fecha_visita" },
            { "data": "hora_ingreso", "name": "hora_ingreso" },
            { "data": "hora_salida", "name": "hora_salida" },
            { "data": "visitante", "name": "visitante" },
            { "data": "area", "name": "area" },
            { "data": "personal", "name": "personal" },
            { "data": "motivo", "name": "motivo" },
            { "data": "hora_salida", "name": "hora_salida" },
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_web_visitas'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {



            console.log("id_visita: " + data.id_visita);

            ver = "<button class='btn btn-xs btn-warning' title='Hora Salida' onclick='horaSalida(" + data.id_visita + ")' ><i class='fa fa-clock-o'></button>";
            $('td', row).eq(8).html(ver);






            var estado = "";
            if (data.estado === 'A') {
                estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(9).html(estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_web_visitas').dataTable().fnFilter(this.value);
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
                window.location.href = base_url + "registrovisitas";
            }
        }]
    });


    //Publicar form
    $("#publicar").on("click", function () {
        frmx = $("#form_tbl_web_visitas");
        //var datos = $("#form_mantenimientos").serialize();
        //var datos = $("#form_docentes");
        var frm = new FormData(document.getElementById("form_tbl_web_visitas"));
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
                    //bootbox.alert("<strong>Se registró correctamente</strong>");
                    //window.location.href = base_url + "sliders";
                    $("#success").dialog("open");

                } else {
                    console.log("llegamos a la disco");
                    $(".errorforms").remove();

                    //Mostrar mensaje error del modelo
                    $.each(result, function (i, val) {
                        $("#input-" + i).focus();
                        if (i === "id_visitante") {

                            var val = '<div class="text-danger errorforms">El campo visitante es requerido</div>';
                            $("#warning-id_visitante").after(val);

                        }

                        if (i === "id_personal") {

                            var val = '<div class="text-danger errorforms">El campo personal es requerido</div>';
                            $("#warning-id_personal").after(val);

                        }

                        if (i === "id_area") {

                            var val = '<div class="text-danger errorforms">El campo area es requerido</div>';
                            $("#warning-id_area").after(val);

                        }

                        //$("#input-" + i).after(val);
                    });
                }
            }
        });
    });


    //valida enter
    $("#form_tbl_web_visitas .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter

    $('#input-id_personal').select2();

    $('#input-id_visitante').select2();


    $('#input-id_area').select2();

    $("#input-id_sede").on("change", function () {
        carga_lugar($(this).val(), 0);
    });



    $('#input-hora_ingreso').timepicker();

    $('#input-hora_salida').timepicker();


    $("#form_empresa_publico").dialog({
        open: function () {
            if ($.ui && $.ui.dialog && !$.ui.dialog.prototype._allowInteractionRemapped && $(this).closest(".ui-dialog").length) {
                if ($.ui.dialog.prototype._allowInteraction) {
                    $.ui.dialog.prototype._allowInteraction = function (e) {
                        if ($(e.target).closest('.select2-drop').length) return true;
                        return ui_dialog_interaction.apply(this, arguments);
                    };
                    $.ui.dialog.prototype._allowInteractionRemapped = true;
                }
                else {
                    $.error("You must upgrade jQuery UI or else.");
                }
            }
        },
        _allowInteraction: function (event) {
            return !!$(event.target).is(".select2-input") || this._super(event);
        },
        height: 'auto',
        autoOpen: false,
        width: "800px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Empresas Publico</h4></div>",
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


                var id_empresa = $("#input-ep-id_empresa").val();
                var id_publico = $("#input-ep-id_publico").val();


                if ($("#input-ep-id_empresa").val() === "" || $("#input-ep-id_publico").val() === "" || $("input-ep-email").val()=== "") {
                    //console.log("Entra Aqui");
                    if ($("#input-ep-id_empresa").val() === "") {
                        var val = '<div class="text-danger errorforms">El campo empresa es requerido</div>';
                        $("#input-warning_empresa").after(val);
                    }

                    if ($("#input-ep-id_publico").val() === "") {
                        var val = '<div class="text-danger errorforms">El campo publico es requerido</div>';
                        $("#input-warning_publico").after(val);
                    }

            
                    if ($("#input-ep-email").val() === "") {
                        var val = '<div class="text-danger errorforms">El campo email es requerido</div>';
                        $("#input-ep-email").after(val);
                    }
                } else {
                    $.ajax({
                        url: base_url + "registrovisitas/validaEmpresaPublico",
                        type: 'POST',
                        data: { "id_empresa": id_empresa, "id_publico": id_publico },
                        success: function (msg) {

                            if (msg.say == "yes") {

                                var val = '<div class="text-danger errorforms">La institucion y el ciudadano ya estan  registrados...</div>';
                                $("#input-warning_publico").after(val);

                            } else if (msg.say == "no") {

                                frm = $("#form_empresa_publico");
                                $.ajax({
                                    url: frm.attr("action"),
                                    type: 'POST',
                                    data: frm.serialize(),
                                    success: function (msg) {
                                        var result = msg;
                                        if (result.say === "yes") {
                                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                                window.location.href = base_url + "registrovisitas/registro";
                                            });
                                            $("#form_empresa_publico").dialog("close");
                                        } else {
                                            console.log("llegamos a la disco");
                                            $(".errorforms").remove();

                                        }
                                    }
                                });
                            }
                        }
                    });
                }








            }
        }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });


    $("#form_empresa").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Empresas</h4></div>",
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
                frm = $("#form_empresa");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                window.location.href = base_url + "registrovisitas/registro";
                            });
                            $("#form_empresa").dialog("close");
                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();
                            $.each(result, function (i, val) {
                                $("#input-e-" + i).focus();
                                $("#input-e-" + i).after(val);
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


    $("#form_publico").dialog({
        autoOpen: false,
        //height: "auto",
        width: "520px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Publico</h4></div>",
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
                frm = $("#form_publico");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            bootbox.alert("<strong>Se registró correctamente</strong>", function () {
                                window.location.href = base_url + "registrovisitas/registro";
                            });
                            $("#form_publico").dialog("close");
                        } else {
                            console.log("llegamos a la disco");
                            $(".errorforms").remove();
                            $.each(result, function (i, val) {
                                $("#input-p-" + i).focus();
                                $("#input-p-" + i).after(val);
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






    $("#form_hora_salida").dialog({
        autoOpen: false,
        //height: "auto",
        width: "400px",
        resizable: false,
        modal: true,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro Hora de Salida</h4></div>",
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
                frm = $("#form_hora_salida");
                $.ajax({
                    url: frm.attr("action"),
                    type: 'POST',
                    data: frm.serialize(),
                    success: function (msg) {
                        var result = msg;
                        if (result.say === "yes") {
                            // $("#modalnew").modal("hide");
                            $('#tbl_web_visitas').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_hora_salida").dialog("close");
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


});

function carga_lugar(id_sede, param) {

    $.post(base_url + "registrovisitas/getLugares", { pk: id_sede }, function (response) {
        var html = "";
        html = html + '<option value="">Seleccione...</option>';
        $.each(response, function (i, val) {

            if (param === 0) {

                html = html + '<option value="' + val.id_lugar + '">' + val.descripcion + '</option>';
            } else {

                if (val.id_lugar == param) {

                    html = html + '<option value="' + val.id_lugar + '" selected >' + val.descripcion + '</option>';
                } else {
                    html = html + '<option value="' + val.id_lugar + '">' + val.descripcion + '</option>';
                }
            }

        });

        $("#input-id_lugar").html(html);
    }, "json");

}

//Funcion editar
function editar() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        window.location.href = base_url + "registrovisitas/registro/" + xsmart;
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
                            url: base_url + "registrovisitas/eliminar",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_web_visitas').dataTable().fnDraw();
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



function agregar_visitante() {
    $(".errorforms").hide();


    $('#input-ep-id_empresa').select2();
    $('#input-ep-id_publico').select2();

    $("#form_empresa_publico")[0].reset();
    $("#input-ep-id_empresa_publico").val("");
    $("#form_empresa_publico")[0].reset();
    $("#form_empresa_publico").dialog("open");
}


function agregar_institucion() {
    $(".errorforms").hide();
    $("#form_empresa")[0].reset();
    $("#input-e-id_empresa").val("");
    $("#form_empresa")[0].reset();
    $("#form_empresa").dialog("open");
}

function agregar_ciudadano() {
    $(".errorforms").hide();
    $("#form_publico")[0].reset();
    $("#input-p-codigo").val("");
    $("#form_publico")[0].reset();
    $("#form_publico").dialog("open");
}


function horaSalida(id_visita) {
    $("#input-id_visita").val(id_visita);
    $.ajax({
        type: 'POST',
        url: base_url + "registrovisitas/getAjax",
        data: { id_visita: id_visita },
        dataType: 'json',
        success: function (response) {
            //var result = JSON.parse(msg);
            $.each(response, function (i, val) {

                if (i === 'hora_salida') {
                    if (val) {
                        var timeString = val;
                        var H = +timeString.substr(0, 2);
                        var h = (H % 12) || 12;
                        var ampm = H < 12 ? " AM" : " PM";
                        timeString = h + timeString.substr(2, 3) + ampm;
                        $("#input-hora_salida").val(timeString);
                    }

                }

            });
            $(".errorforms").remove();
        }, complete: function () {
            $("#form_hora_salida").dialog("open");
        }
    });
}
