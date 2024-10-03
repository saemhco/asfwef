$(document).ready(function () {

    //alert("Hola Mundo");
    //console.log("llega: "+id_personal_areas);

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_estabilizadores = $("#tbl_estabilizadores").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "gestionrecursostic/datatableEstabilizadores/" + id_personal_areas, "type": "POST" },
        "processing": false,
        "serverSide": true,
        //Desactivamos buscador
        //"searching": false,
        //Desactivamos Show inicio
        "lengthChange": false,
        'columnDefs': [
            {
                "targets": 0,
                "className": "text-center"
            }],
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            { "data": "actions", "name": "actions", "orderable": false, "width": "5%", "searchable": false },

            { "data": "nombres", "name": "nombres" },
            { "data": "id_patrimonial", "name": "id_patrimonial" },
            { "data": "marca", "name": "marca" },
            { "data": "modelo", "name": "modelo" },
            { "data": "serie", "name": "serie" },
            { "data": "color", "name": "color" },
            { "data": "estado", "name": "estado" }],

        "dom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "language": { "url": base_url + "adminpanel/js/plugin/datatables/dataTables.Spanish.json" },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_estabilizadores'), breakpointDefinition);
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
            $('td', row).eq(7).html(html_estado);
        }
    });




    $("#form_estabilizadores").dialog({
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
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro </h4></div>",
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
                $(".errorforms").hide();

                var id_tabla = $("#input-id_tabla_estabilizadores").val();
                var id_tabla_hidden = $("#input-id_tabla_estabilizadores_hidden").val();
                var id_personal_area = $("#input-id_personal_area_estabilizadores").val();

                $.ajax({
                    url: base_url + "gestionrecursostic/getAjaxValidarEstabilizadores",
                    type: 'POST',
                    data: { id_tabla: id_tabla, id_tabla_hidden: id_tabla_hidden, id_personal_area: id_personal_area },
                    success: function (msg) {

                        if (msg.say === "existe") {

                            //console.log("No puede insertar");
                            var area = msg.area;
                            var personal = msg.personal;

                            var warning = '<div class="text-danger errorforms">Recurso ya registrado en el Area:' + area + " - Personal: " + personal + '</div>';

                            $("#input-warning_estabilizadores").after(warning);
                            //window.location.href = base_url + "formatos1/registro/" + xsmart;
                        } else if (msg.say === "editar" || msg.say === "no_existe") {

                            frm = $("#form_estabilizadores");
                            $.ajax({
                                url: frm.attr("action"),
                                type: 'POST',
                                data: frm.serialize(),
                                success: function (msg) {
                                    var result = msg;
                                    if (result.say === "yes") {

                                        $('#tbl_estabilizadores').dataTable().fnDraw();
                                        bootbox.alert("<strong>Se registró correctamente</strong>");
                                        $("#form_estabilizadores").dialog("close");
                                    } else {
                                        console.log("llegamos a la disco");
                                        $(".errorforms").remove();

                                        $.each(result, function (i, val) {
                                            $("#input-" + i).focus();
                                            $("#input-warning_estabilizadores").after(val);
                                        });
                                    }
                                }
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


    //valida enter
    $("#form_estabilizadores .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter

    //validacion select
    $("#input-id_tabla_estabilizadores").on("change", function () {

        var id_tabla = $("#input-id_tabla_estabilizadores").val();
        var id_tabla_hidden = $("#input-id_tabla_estabilizadores_hidden").val();
        var id_personal_area = $("#input-id_personal_area_estabilizadores").val();

        $.ajax({
            url: base_url + "gestionrecursostic/getAjaxValidarEstabilizadores",
            type: 'POST',
            data: { id_tabla: id_tabla, id_tabla_hidden: id_tabla_hidden, id_personal_area:id_personal_area},
            success: function (msg) {

                if (msg.say === "existe") {

                    $(".errorforms").hide();

                    var area = msg.area;
                    var personal = msg.personal;

                    var warning = '<div class="text-danger errorforms">Recurso ya registrado en el Area:' + area + " - Personal: " + personal + '</div>';
                    $("#input-warning_estabilizadores").after(warning);

                    //window.location.href = base_url + "formatos1/registro/" + xsmart;
                } else if (msg.say === "no_existe") {
                    $(".errorforms").hide();
                }
            }
        });
    });
    //fin validacion select


});

function agregar_estabilizadores() {

    //Limpia los errores y resetea los valores de los campos
    $("#input-id_personal_area_equipo_estabilizadores").val("");

    $("#input-id_tabla_estabilizadores_hidden").val("");

    $('#input-id_tabla_estabilizadores').val("");
    $('#input-id_tabla_estabilizadores').select2();
    $('#input-id_personal_area_estabilizadores').select2();
    $(".errorforms").hide();
    $("#form_estabilizadores")[0].reset();
    $("#form_estabilizadores").dialog("open");

    $("#ocultar_estabilizadores").css("display", "none");
    $( "#input-id_personal_area_estabilizadores" ).attr( "disabled", true );
    $( "#input-id_personal_area_estabilizadores_nuevo" ).attr( "disabled", false );

}


function editar_estabilizadores() {
    $(".errorforms").hide();

    $("#ocultar_estabilizadores").css("display", "block");
    $( "#input-id_personal_area_estabilizadores" ).attr( "disabled", false );
    $( "#input-id_personal_area_estabilizadores_nuevo" ).attr( "disabled", true );


    $('#input-id_tabla_estabilizadores').select2();
    $('#input-id_personal_area_estabilizadores').select2();


    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        $.ajax({
            type: 'POST',
            url: base_url + "gestionrecursostic/getAjaxUsuariosEstabilizadores",
            data: { id: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)
                    $("#input-" + i + "_estabilizadores").val(val);
                    if (i === "id_tabla") {
                        
                        $('#input-id_tabla_estabilizadores_hidden').val(val);
                        $('#input-id_tabla_estabilizadores').val(val).trigger('change');
                       
                    }

                    if(i === 'id_personal_area'){
                        $('#input-id_personal_area_estabilizadores').val(val).trigger('change');
                    }


                    if (i === "conservacion") {

                        $('#input-conservacion_estabilizadores').val(val);
                    }


                    if (i === "fecha_inicio") {
                        //formateamos la fecha de inicio
                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        if (f_i !== null) {
                            var r_f_i = f_i.split(" ");
                            //console.log(r_f_i[0]);
                            var res_f_i = r_f_i[0].split("-");
                            //console.log(res_f_i[0]);
                            var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                            //console.log("Fecha de inicio:" + result_fi);
                            $("#input-fecha_inicio_estabilizadores").val(result_fi);
                            //console.log("fecha_inicio:" + val);
                        }

                    }

                    if (i === "fecha_fin") {
                        //formateamos la fecha de inicio

                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        if (f_i !== null) {
                            var r_f_i = f_i.split(" ");
                            //console.log(r_f_i[0]);
                            var res_f_i = r_f_i[0].split("-");
                            //console.log(res_f_i[0]);
                            var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                            //console.log("Fecha de inicio:" + result_fi);
                            $("#input-fecha_fin_estabilizadores").val(result_fi);
                            //console.log("fecha_fin:" + val);

                        }

                    }

                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_estabilizadores").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar_estabilizadores() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();
        console.log(xsmart);
        bootbox.alert("<strong>Opcion no disponible...</strong>");
        // bootbox.dialog({
        //     message: "<strong>¿ Desea Eliminar este registro ?</strong>",
        //     title: "Confirmar",
        //     buttons: {
        //         danger: {
        //             label: "Cancelar",
        //             className: "btn-danger"
        //         },
        //         success: {
        //             label: "Aceptar",
        //             className: "btn-success",
        //             callback: function () {
        //                 $.ajax({
        //                     url: base_url + "gestionrecursostic/eliminarUsuariosEstabilizadores",
        //                     type: 'POST',
        //                     data: { "id": xsmart },
        //                     success: function (msg) {

        //                         if (msg.say == "yes") {
        //                             $('#tbl_estabilizadores').dataTable().fnDraw();
        //                         } else {

        //                         }
        //                     }
        //                 });
        //             }
        //         }

        //     }
        // });
    } else {
        errordialogtablecuriosity();
    }
}
