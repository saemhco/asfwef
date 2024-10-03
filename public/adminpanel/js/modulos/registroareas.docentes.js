$(document).ready(function () {


    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_areas_docentes = $("#tbl_areas_docentes").DataTable({
        "stateSave": true,
        "ajax": { "url": base_url + "registroareas/datatableDocentes/" + codigo, "type": "POST" },
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
            { "data": "orden", "name": "personal_areas.orden" },
            { "data": "nombres_docentes", "name": "public.docentes.nombres" },
            { "data": "apellidop_docentes", "name": "public.docentes.apellidop" },
            { "data": "apellidom_docentes", "name": "public.docentes.apellidom" },
            { "data": "oficina", "name": "personal_areas.oficina" },
            { "data": "cargo", "name": "personal_areas.cargo" },
            { "data": "estado", "name": "personal_areas.estado" }
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_areas_docentes'), breakpointDefinition);
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



    $("#form_docentes_areas").dialog({
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
        width: $(window).width() * (($(window).width() > 1024) ? 0.9 : 0.9), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro docentes</h4></div>",
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
                //frm = $("#form_areass");  
                frmx = $("#form_docentes_areas");
                var frm = new FormData(this);

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

                            $('#tbl_areas_docentes').dataTable().fnDraw();
                            bootbox.alert("<strong>Se registró correctamente</strong>");
                            $("#form_docentes_areas").dialog("close");



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

    //valida enter
    $("#form_areas .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;
        }
    }); // fin validar enter


    $('#input-id_resolucion').select2();
    $('#input-id_contrato').select2();


});

function agregar_docente() {
    //Limpia los errores y resetea los valores de los campos
    $(".errorforms").hide();
    $("#input-id_personal_area_docentes_areas").val("");
    $("#form_docentes_areas")[0].reset();
    $('#input-id_resolucion').select2();
    $('#input-id_contrato').select2();
    $("#form_docentes_areas").dialog("open");
}
function editar_docente() {
    if ($(".selrow").is(':checked')) {
        var xsmart = $('input:radio[name=selrow]:checked').val();

        $(".form_docentes_areas").remove();
        $('#input-id_resolucion').select2();
        $('#input-id_contrato').select2();

        $.ajax({
            type: 'POST',
            url: base_url + "registroareas/getAjaxDocentesAreas",
            data: { codigo: xsmart },
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    //i(nombre del campo) y val(calor de la bd)

                    if (i === "personal") {
                        console.log(val);
                        $("#input-" + "docentes").val(val);
                    }

                    $("#input-" + i + "_docentes_areas").val(val);

                    //formateamos la fecha de inicio
                    if (i === "fecha_inicio") {
                        var f_i = val;
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_inicio_docentes_areas").val(result_fi);
                    }

                    if (i === "fecha_fin") {
                        //formateamos la fecha fin
                        var f_fin = val;
                        //console.log(f_fin);
                        var r_fin = f_fin.split(" ");
                        //console.log(r_fin[0]);
                        var res_fin = r_fin[0].split("-");
                        //console.log("Fecha de fin:"+res_fin);
                        var result_fin = res_fin[2] + '/' + res_fin[1] + '/' + res_fin[0];
                        console.log("Fecha de fin:" + result_fin);
                        $("#input-fecha_fin_docentes_areas").val(result_fin);
                    }

                    if (i === "estado") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i + "_docentes_areas").prop("checked", true);

                        }
                    }

                    if (i === "es_principal") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i + "_docentes_areas").prop("checked", true);

                        }
                    }

                    if (i === "encargatura") {

                        if (val === "A") {
                            //Usamos la propiedad prop para el check
                            //console.log("Entro aqui");
                            $("#input-" + i + "_docentes_areas").prop("checked", true);

                        }
                    }

                    if (i === "archivo") {
                        if (val === "" || val === null) {
                            var valor = '<div class="alert alert-warning fade in form_docentes_areas"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#archivo_docentes_areas_modal").after(valor);
                        } else {
                            var valor = '<div class="alert alert-success fade in form_docentes_areas">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/personal_areas/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#archivo_docentes_areas_modal").after(valor);
                        }
                    }



                    if (i === "imagen") {
                        if (val === "" || val === null) {
                            //console.log("Valor cuando esta vacio o es null:" + val);
                            var valor = '<div class="alert alert-warning fade in form_docentes_areas"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un imagen.</div>';
                            $("#imagen_docentes_areas_modal").after(valor);
                            $("#imagen_docentes_areas").html(valor);

                        } else {
                            var valor = '<div class="alert alert-success fade in form_docentes_areas">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/imagenes/personal_areas/' + val + '" >  <i class="fa-fw fa fa-image"></i></a></div>';
                            $("#imagen_docentes_areas_modal").after(valor);

                            $("#imagen_docentes_areas_collapse").attr("src", base_url + 'adminpanel/imagenes/docentes_areas/' + val);
                        }
                    }


                    if(i === 'id_resolucion'){
                        $('#input-id_resolucion').val(val).trigger('change');
                    }

                    if(i === 'id_contrato'){
                        $('#input-id_contrato').val(val).trigger('change');
                    }

                });

                $(".errorforms").remove();
            }, complete: function () {
                $("#form_docentes_areas").dialog("open");
            }
        });
    } else {
        errordialogtablecuriosity();
    }
}


function eliminar_docente() {
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
                            url: base_url + "registroareas/eliminarDocentesAreas",
                            type: 'POST',
                            data: { "id": xsmart },
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_areas_docentes').dataTable().fnDraw();
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