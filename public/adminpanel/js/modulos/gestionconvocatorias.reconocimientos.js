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
    tbl_web_publico_reconocimientos = $("#tbl_web_publico_reconocimientos").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "registropublicoreconocimientos/datatable", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "fecha_reconocimiento", "name": "fecha_reconocimiento"},
            {"data": "publico", "name": "publico"},
            {"data": "nombre", "name": "nombre"},
            {"data": "institucion", "name": "institucion"},
            {"data": "pais", "name": "pais"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_web_publico_reconocimientos'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        }, "createdRow": function (row, data, index) {




            var html2 = "<a role='button' class='btn btn-xs btn-warning' target='_BLANK' href='" + base_url + "adminpanel/archivos/publico/reconocimientos/" + data.archivo + "' >   <i class='fa fa-file-pdf-o' ></i></a>";
            $('td', row).eq(6).html(html2);



            var html_estado = "";
            if (data.estado === 'A') {
                html_estado = '<span class="label label-success">ACTIVO</span>';
            } else if (data.estado === 'X') {
                html_estado = '<span class="label label-warning">INACTIVO</span>';
            }
            $('td', row).eq(7).html(html_estado);



        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_web_publico_reconocimientos').dataTable().fnFilter(this.value);
                }
            });
        }
    });

    $("#form_tbl_web_publico_reconocimientos").dialog({
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
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7), // overcomes width:'auto' and maxWidth bug
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Experiencia</h4></div>",
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
                    $(".errorforms").remove();


                    frmx = $("#form_tbl_web_publico_reconocimientos");
                    //var frm = new FormData(this);
                    var frm = new FormData(document.getElementById("form_tbl_web_publico_reconocimientos"));
                    //frm.append('funciones', funciones.getData());

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
                                $('#tbl_web_publico_reconocimientos').dataTable().fnDraw();
                                bootbox.alert("<strong>Se registró correctamente</strong>");
                                $("#form_tbl_web_publico_reconocimientos").dialog("close");
                            } else {
                                if (result.say === "falta") {
                                    var val = '<div class="text-danger errorforms">El campo archivo es requerido</div>';
                                    $("#input-archivo").after(val);
                                } else {
                                    if (result.say === "no_formato") {
                                        var val = '<div class="text-danger errorforms">Subir archivo en formato .pdf/.jpg/.jpeg</div>';
                                        $("#input-archivo").after(val);
                                    } else {
                                        console.log("llegamos a la disco");
                                        $(".errorforms").remove();

                                        $.each(result, function (i, val) {
                                            $("#input-" + i).focus();
                                            $("#input-" + i).after(val);
                                        });
                                    }
                                }
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
    $("#form_tbl_web_publico_reconocimientos .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");
            return false;
        }
    }); // fin validar enter




});
function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $('#input-id_publico').val("");
    $('#input-id_publico').select2();
    $("#form_tbl_web_publico_reconocimientos")[0].reset();
    $(".form_tbl_web_publico_reconocimientos").remove();
    $("#input-file").attr("value", "");
    $("#input-codigo").val("");

    $("#form_tbl_web_publico_reconocimientos").dialog("open");
}

function editar() {

    $('#input-id_publico').select2();

    if ($(".selrow").is(':checked')) {
        $(".form_tbl_web_publico_reconocimientos").remove();
        $("#form_tbl_web_publico_reconocimientos")[0].reset();
        $("#input-file").attr("value", "");
        var xsmart = $('input:radio[name=selrow]:checked').val();
        
        $.ajax({
            type: 'POST',
            url: base_url + "gestionconvocatorias/getAjaxPublicoReconocimientos",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                //var result = JSON.parse(msg);
                $.each(response, function (i, val) {
                    $("#input-" + i).val(val);

                    if (i === 'id_publico') {
                        $('#input-id_publico').val(val).trigger('change');
                    }

                    if (i === "fecha_reconocimiento") {
                        //formateamos la fecha de inicio
                        var f_i = $("#input-fecha_reconocimiento").val();
                        //console.log(f_i);
                        //Split igual explode php
                        var r_f_i = f_i.split(" ");
                        //console.log(r_f_i[0]);
                        var res_f_i = r_f_i[0].split("-");
                        //console.log(res_f_i[0]);
                        var result_fi = res_f_i[2] + '/' + res_f_i[1] + '/' + res_f_i[0];
                        //console.log("Fecha de inicio:" + result_fi);
                        $("#input-fecha_reconocimiento").val(result_fi);
                    }



                    if (i === "archivo") {
                        //console.log("tiene archivo"+val);
                        if (val === "" || val === null) {

                            var valor = '<div class="alert alert-warning fade in form_tbl_web_publico_reconocimientos"><i class="fa-fw fa fa-warning"></i><strong>Pendiente</strong> Aun no ha subido un archivo.</div>';
                            $("#input-archivo").after(valor);
                        } else {
                            //
                            var valor = '<div class="alert alert-success fade in form_tbl_web_publico_reconocimientos">Click aqui para ver la imagen<a class="btn btn-ribbon" target="_BLANK" role="button" href=" ' + base_url + 'adminpanel/archivos/publico/reconocimientos/' + val + '" >  <i class="fa-fw fa fa-book"></i></a></div>';
                            $("#input-archivo").after(valor);
                        }

                        $("#input-file").attr("value", val);
                    }



                });


                $(".errorforms").remove();
            }, complete: function () {
                $("#form_tbl_web_publico_reconocimientos").dialog("open");
            }
        });
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
                            url: base_url + "gestionconvocatorias/eliminarPublicoReconocimientos",
                            type: 'POST',
                            data: {"id": xsmart},
                            success: function (msg) {

                                if (msg.say == "yes") {
                                    $('#tbl_web_publico_reconocimientos').dataTable().fnDraw();
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