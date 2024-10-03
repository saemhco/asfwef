$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_atencionespublico = $("#tbl_atencionespublico").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionmesadeayuda/datatableAtencionesPublico", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "tipo", "name": "tipo"},
            {"data": "prioridad", "name": "prioridad"},
            {"data": "fecha_recepcion", "name": "fecha_recepcion"},
            {"data": "fecha_recepcion", "name": "fecha_recepcion"},
            {"data": "fecha_inicio", "name": "fecha_inicio"},
            {"data": "fecha_termino", "name": "fecha_termino"},
            {"data": "solucion", "name": "solucion"},
            {"data": "proceso", "name": "proceso"}
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_atencionespublico'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        "createdRow": function (row, data, index) {
            //console.log(data.estado);
            var f_r = data.fecha_recepcion;
            var f_r_split1 = f_r.split(" ");
            var f_r_split2 = f_r_split1[0].split("-");
            var fecha_recepcion = f_r_split2[2] + '/' + f_r_split2[1] + '/' + f_r_split2[0];
            $('td', row).eq(3).html(fecha_recepcion);


            //console.log(data.fecha_recepcion);
            var hora = data.fecha_recepcion;
            var hora_split1 = hora.split(" ");
            var res_hora = hora_split1[1];
            $('td', row).eq(4).html(res_hora);


            if (data.fecha_inicio !== null) {
                //console.log(data.fecha_termino);
                var f_i = data.fecha_inicio;
                var f_i_split1 = f_i.split(" ");
                var f_i_split2 = f_i_split1[0].split("-");
                var fecha_inicio = f_i_split2[2] + '/' + f_i_split2[1] + '/' + f_i_split2[0];
                $('td', row).eq(5).html(fecha_inicio);
            }


            if (data.fecha_termino !== null) {
                //console.log(data.fecha_termino);
                var f_t = data.fecha_termino;
                var f_t_split1 = f_t.split(" ");
                var f_t_split2 = f_t_split1[0].split("-");
                var fecha_termino = f_t_split2[2] + '/' + f_t_split2[1] + '/' + f_t_split2[0];
                $('td', row).eq(6).html(fecha_termino);
            }


            var proceso = "";
            if (data.proceso === 1) {
                proceso = '<span class="label label-warning">Solicitud</span>';
            } else if (data.proceso === 2) {
                proceso = '<span class="label label-success">En Proceso</span>';
            } else if (data.proceso === 3) {
                proceso = '<span class="label label-success">Finalizado</span>';
            } else if (data.proceso === 4) {
                proceso = '<span class="label label-success">Derivado</span>';
            }

            $('td', row).eq(8).html(proceso);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_atencionespublico').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );

    //valida enter
    $("#form_atencionespublico .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;

        }
    }); // fin validar enter



    //form_atencionespublico
    $("#form_atencionespublico").dialog({
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.5 : 0.5),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Registro de Atencion Público</h4></div>",
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
                    frm = $("#form_atencionespublico");
                    $.ajax({
                        url: frm.attr("action"),
                        type: 'POST',
                        data: frm.serialize(),
                        success: function (msg) {
                            var result = msg;
                            if (result.say === "yes")
                            {
                                $("#form_atencionespublico").dialog("close");
                                bootbox.alert("<strong>Se actualizo correctamente</strong>", function () {
                                    $('#tbl_atencionespublico').dataTable().fnDraw();
                                });
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


function agregar() {
    //Limpia los errores y resetea los valores de los campos
    $("#form_atencionespublico")[0].reset();
    $("#form_atencionespublico").dialog("open");
}
