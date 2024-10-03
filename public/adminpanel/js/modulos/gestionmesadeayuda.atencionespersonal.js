$(document).ready(function () {

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    tbl_atencionespersonal = $("#tbl_atencionespersonal").DataTable({
        "stateSave": true,
        "ajax": {"url": base_url + "gestionmesadeayuda/datatableAtencionesPersonal", "type": "POST"},
        "processing": false,
        "serverSide": true,
        "order": [[1, "asc"]],
        "columns": [
            //{"title":"&nbsp;","data":"item","width":"2%","searchable":false,"orderable":false},
            {"data": "actions", "name": "actions", "orderable": false, "width": "2%", "searchable": false},
            {"data": "area", "name": "area"},
            {"data": "dni", "name": "dni"},
            {"data": "publico", "name": "publico"},
            {"data": "tipo", "name": "tipo"},
            {"data": "prioridad", "name": "prioridad"},
            {"data": "fecha_recepcion", "name": "fecha_recepcion"},
            {"data": "fecha_recepcion", "name": "fecha_recepcion"},
            {"data": "fecha_inicio", "name": "fecha_inicio"},
            {"data": "fecha_termino", "name": "fecha_termino"},
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_atencionespersonal'), breakpointDefinition);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_dt_basic.respond();
        },
        "createdRow": function (row, data, index) {


            var html = '<center><label class="radio"><input type="radio" name="selrow" class="selrow" value="' + data.codigo + '" dni="' + data.dni + '" publico="' + data.publico + '" fecha_recepcion="' + data.fecha_recepcion + '" asunto="' + data.asunto + '"><i></i> </label></center>';
            $('td', row).eq(0).html(html);

            var f_r = data.fecha_recepcion;
            var f_r_split1 = f_r.split(" ");
            var f_r_split2 = f_r_split1[0].split("-");
            var fecha_recepcion = f_r_split2[2] + '/' + f_r_split2[1] + '/' + f_r_split2[0];
            $('td', row).eq(6).html(fecha_recepcion);


            //console.log(data.fecha_recepcion);
            var hora = data.fecha_recepcion;
            var hora_split1 = hora.split(" ");
            var res_hora = hora_split1[1];
            $('td', row).eq(7).html(res_hora);


            if (data.fecha_inicio !== null) {
                //console.log(data.fecha_termino);
                var f_i = data.fecha_inicio;
                var f_i_split1 = f_i.split(" ");
                var f_i_split2 = f_i_split1[0].split("-");
                var fecha_inicio = f_i_split2[2] + '/' + f_i_split2[1] + '/' + f_i_split2[0];
                $('td', row).eq(8).html(fecha_inicio);
            }


            if (data.fecha_termino !== null) {
                //console.log(data.fecha_termino);
                var f_t = data.fecha_termino;
                var f_t_split1 = f_t.split(" ");
                var f_t_split2 = f_t_split1[0].split("-");
                var fecha_termino = f_t_split2[2] + '/' + f_t_split2[1] + '/' + f_t_split2[0];
                $('td', row).eq(9).html(fecha_termino);
            }

            var proceso = "";
            if (data.proceso === 1) {
                proceso = '<span class="label label-danger">Solicitud</span>';
            } else if (data.proceso === 2) {
                proceso = '<span class="label label-warning">Proceso</span>';
            } else if (data.proceso === 3) {
                proceso = '<span class="label label-success">Finalizado</span>';
            } else if (data.proceso === 4) {
                proceso = '<span class="label label-primary">Derivado</span>';
            }
            $('td', row).eq(10).html(proceso);
        },
        initComplete: function () {
            //Busqueda al dar enter
            $('div.dataTables_filter input').unbind();
            $('div.dataTables_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    $('#tbl_atencionespersonal').dataTable().fnFilter(this.value);
                }
            });
        }
    }
    );

    //valida enter
    $("#form_atenciones_personal .input").keypress(function (e) {
        if (e.which == 13) {
            $("#graba").trigger("click");

            return false;

        }
    }); // fin validar enter



    //form_atenciones_personal
    $("#form_atenciones_personal").dialog({
        position: {my: 'top', at: 'top+50'},
        autoOpen: false,
        width: $(window).width() * (($(window).width() > 1024) ? 0.7 : 0.7),
        maxWidth: 600,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-form'></i> Asignación de personal para la atención</h4></div>",
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

                    //validation
                    $(".errorforms").remove();
                    if ($("#input-fecha_respuesta").val() === "" || $("#input-proceso option:selected").val() === "0") {

                        if ($("#input-fecha_respuesta").val() === "") {
                            var val = '<div class="text-danger errorforms"> El campo fecha es requerido</div>';
                            $("#input-fecha_respuesta").after(val);
                        }

                        if ($("#input-proceso option:selected").val() === "0") {

                            var val = '<div class="text-danger errorforms">El campo proceso es requerido</div>';
                            $("#input-proceso").after(val);
                        }


                    } else {
                        console.log("Ya puede grabar");
                        frm = $("#form_atenciones_personal");
                        $.ajax({
                            url: frm.attr("action"),
                            type: 'POST',
                            data: frm.serialize(),
                            success: function (msg) {
                                var result = msg;
                                if (result.say === "yes")
                                {
                                    // $("#modalnew").modal("hide");
                                    $('#tbl_atencionespersonal').dataTable().fnDraw();
                                    bootbox.alert("<strong>Se registró correctamente</strong>");
                                    $("#form_atenciones_personal").dialog("close");
                                } else {
                                    //console.log("llegamos a la disco");
                                    if (result.say === "no_solucion") {

                                        var val = '<div class="text-danger errorforms">Debe especificar una solución con más de 20 caracteres</div>';
                                        $("#input-solucion").after(val);

                                    } else if (result.say === "no_motivo") {

                                        var val = '<div class="text-danger errorforms">Debe especificar un motivo con más de 20 caracteres</div>';
                                        $("#input-motivo").after(val);

                                    } else {
                                        $(".errorforms").remove();

                                        $.each(result, function (i, val) {
                                            $("#input-" + i).focus();
                                            $("#input-" + i).after(val);
                                        });
                                    }


                                }
                            }
                        });
                    }
                    //fin
                }
            }],
        close: function () {
            //$("#form-" + curiosityprefix).dialog.reset();
        }
    });



    //Select region ubigeo
    $("#input-area").on("change", function () {
        //console.log("Gaaaaaaaaaaaaaaaaaaaa");
        $(".errorforms").remove();
        carga_personal($(this).val(), 0);
    });

    function carga_personal(area, param) {

        $.post(base_url + "gestionmesadeayuda/getPersonal", {area: area}, function (response) {
            var html = "";
            html = html + '<option value="0">SELECCIONE...</option>';

            $.each(response, function (i, val) {
                if (param === 0) {

                    html = html + '<option value="' + val.codigo + '" personal="' + val.apellidop + ' ' + val.apellidom + ' ' + val.nombres + '">' + val.apellidop + ' ' + val.apellidom + ' ' + val.nombres + '</option>';

                }

            });


            $("#input-personal").html(html);


        }, "json");

    }



    $('#input-proceso').on('change', function () {

        var proceso = $("#input-proceso option:selected").val();
        if (proceso !== '3') {

            $("#label_change").text("Motivo");
            $("#input-solucion").attr("id", "input-motivo");
            $("#input-motivo").attr("name", "motivo");
            $("#input-motivo").attr("placeholder", "Motivo");

        } else if (proceso === "3") {
            $("#label_change").text("Solución");
            $("#input-motivo").attr("id", "input-solucion");
            $("#input-solucion").attr("name", "solucion");
            $("#input-solucion").attr("placeholder", "Solución");
        }

    });

});





function agregar() {
    if ($(".selrow").is(':checked')) {
        $("#form_atenciones_personal")[0].reset();
        var xsmart = $('input:radio[name=selrow]:checked').val();
        //consulta estado de la atencion
        $.ajax({
            type: 'POST',
            url: base_url + "gestionmesadeayuda/getAtencionesPersonal",
            data: {id: xsmart},
            dataType: 'json',
            success: function (response) {
                if (response.say === "yes") {

                    var numero_digitos = xsmart.length;

                    if (numero_digitos === 1) {
                        $("#input-codigo_atencion_text").text("000" + xsmart);
                    } else if (numero_digitos === 2) {
                        $("#input-codigo_atencion_text").text("00" + xsmart);
                    } else if (numero_digitos === 3) {
                        $("#input-codigo_atencion_text").text("0" + xsmart);
                    } else if (numero_digitos === 4) {
                        $("#input-codigo_atencion_text").text(xsmart);
                    }

                    var dni = $('input:radio[name=selrow]:checked').attr('dni');
                    var publico = $('input:radio[name=selrow]:checked').attr('publico');
                    var fecha_recepcion = $('input:radio[name=selrow]:checked').attr('fecha_recepcion');
                    var res_fecha_recepcion = fecha_recepcion.split(" ");
                    var array_2_fecha_recepcion = res_fecha_recepcion[0].split("-");

                    //console.log(array_2_fecha_recepcion);

                    var res_fecha_recepcion = array_2_fecha_recepcion[2] + '/' + array_2_fecha_recepcion[1] + '/' + array_2_fecha_recepcion[0];
                    var asunto = $('input:radio[name=selrow]:checked').attr('asunto');
                    $("#input-atencion").val(xsmart);
                    $("#input-dni").text(dni);
                    $("#input-publico").text(publico);
                    $("#input-fecha_recepcion").text(res_fecha_recepcion);
                    $("#input-asunto").text(asunto);

                    $("#form_atenciones_personal").dialog("open");


                } else if (response.say === "no") {

                    if (response.proceso === 3) {
                        bootbox.alert("<strong>Usted a finalizado la atención...</strong>");
                    } else if (response.proceso === 4) {
                        bootbox.alert("<strong>Usted a derivado la atención...</strong>");
                    }


                }
            }
        });
        //

    } else {
        errordialogtablecuriosity();
    }
}

